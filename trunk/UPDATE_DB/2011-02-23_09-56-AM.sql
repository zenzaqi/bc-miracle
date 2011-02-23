ALTER TABLE `master_faktur_lunas_piutang` CHANGE `fpiutang_tanggal` `fpiutang_tanggal` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `master_faktur_lunas_piutang` ADD `fpiutang_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
ADD `fpiutang_update` VARCHAR( 25 ) NULL DEFAULT NULL ,
ADD `fpiutang_date_update` DATETIME NULL DEFAULT NULL ,
ADD `fpiutang_revised` TINYINT( 2 ) NOT NULL DEFAULT '0';

ALTER TABLE `miracledb`.`master_faktur_lunas_piutang` ADD INDEX `fpiutang_nobukti_index` ( `fpiutang_nobukti` ) ;


CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jrawat` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_totalbiaya` AS `total_jual`,(`master_jual_rawat`.`jrawat_totalbiaya` - `master_jual_rawat`.`jrawat_bayar`) AS `piutang_total` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) where ((`master_jual_rawat`.`jrawat_totalbiaya` > `master_jual_rawat`.`jrawat_bayar`) and (`master_jual_rawat`.`jrawat_stat_dok` = 'Tertutup')) group by `detail_jual_rawat`.`drawat_master`;