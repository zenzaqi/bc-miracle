ALTER TABLE `master_faktur_lunas_piutang` ADD `fpiutang_cust` INT( 11 ) NOT NULL AFTER `fpiutang_nobukti` ;

ALTER TABLE `master_faktur_lunas_piutang` ADD `fpiutang_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `fpiutang_cara` ;

ALTER TABLE `detail_lunas_piutang` ADD INDEX `dpiutang_nobukti_index` ( `dpiutang_nobukti` ) ;

ALTER TABLE `master_faktur_lunas_piutang` ADD `fpiutang_bayar` DOUBLE NOT NULL DEFAULT '0' AFTER `fpiutang_cara` ;

ALTER TABLE `master_faktur_lunas_piutang` ADD `fpiutang_keterangan` VARCHAR( 255 ) NULL DEFAULT NULL AFTER `fpiutang_bayar` ;

ALTER TABLE `master_faktur_lunas_piutang` CHANGE `fpiutang_cara` `fpiutang_cara` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_total_lunas` AS select `detail_lunas_piutang`.`dpiutang_id` AS `dpiutang_id`,`detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,`master_faktur_lunas_piutang`.`fpiutang_cust` AS `fpiutang_cust`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `total_pelunasan`,`master_faktur_lunas_piutang`.`fpiutang_stat_dok` AS `fpiutang_stat_dok` from (`detail_lunas_piutang` left join `master_faktur_lunas_piutang` on((`detail_lunas_piutang`.`dpiutang_nobukti` = `master_faktur_lunas_piutang`.`fpiutang_nobukti`))) where (`master_faktur_lunas_piutang`.`fpiutang_stat_dok` = 'Tertutup') group by `detail_lunas_piutang`.`dpiutang_master`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_total_bycust` AS select `master_lunas_piutang`.`lpiutang_cust` AS `lpiutang_cust`,sum(`master_lunas_piutang`.`lpiutang_total`) AS `lpiutang_total`,sum(`master_lunas_piutang`.`lpiutang_sisa`) AS `lpiutang_sisa` from `master_lunas_piutang` group by `master_lunas_piutang`.`lpiutang_cust`;

ALTER TABLE `detail_lunas_piutang` ADD `dpiutang_keterangan` VARCHAR( 255 ) NULL ;