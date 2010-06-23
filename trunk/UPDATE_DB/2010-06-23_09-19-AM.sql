ALTER TABLE `detail_retur_paket_rawat` ADD `drpaket_jpaket` INT NOT NULL DEFAULT '0' AFTER `drpaket_master` ;

ALTER TABLE `detail_retur_paket_rawat` ADD `drpaket_dpaket` INT NOT NULL DEFAULT '0' AFTER `drpaket_jpaket` ;

ALTER TABLE `detail_ambil_paket` ADD `dapaket_keterangan` VARCHAR( 25 ) NULL DEFAULT NULL AFTER `dapaket_referal` ;