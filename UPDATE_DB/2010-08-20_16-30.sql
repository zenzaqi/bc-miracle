ALTER TABLE `detail_ambil_paket` ADD `dapaket_update` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `dapaket_date_create` ,
ADD `dapaket_date_update` DATETIME NULL DEFAULT NULL AFTER `dapaket_update` ,
ADD `dapaket_revised` INT( 11 ) NULL DEFAULT '0' AFTER `dapaket_date_update`;

ALTER TABLE `detail_pakai_cabin` ADD `cabin_update` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `cabin_date_create` ,
ADD `cabin_date_update` DATETIME NULL DEFAULT NULL AFTER `cabin_update` ,
ADD `cabin_revised` INT( 11 ) NULL DEFAULT '0' AFTER `cabin_date_update`;

ALTER TABLE `history_ambil_paket` ADD `hapaket_update` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `hapaket_date_create` ,
ADD `hapaket_date_update` DATETIME NULL DEFAULT NULL AFTER `hapaket_update` ,
ADD `hapaket_revised` INT( 11 ) NULL DEFAULT '0' AFTER `hapaket_date_update` ;

ALTER TABLE `pengguna_paket` ADD `ppaket_creator` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `ppaket_cust` ,
ADD `ppaket_date_create` DATETIME NULL DEFAULT NULL AFTER `ppaket_creator` ,
ADD `ppaket_update` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `ppaket_date_create` ,
ADD `ppaket_date_update` DATETIME NULL DEFAULT NULL AFTER `ppaket_update` ,
ADD `ppaket_revised` INT( 11 ) NULL DEFAULT '0' AFTER `ppaket_date_update` ;

ALTER TABLE `voucher_kupon` ADD `kvoucher_creator` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `kvoucher_cust` ,
ADD `kvoucher_date_create` DATETIME NULL DEFAULT NULL AFTER `kvoucher_creator` ,
ADD `kvoucher_update` VARCHAR( 50 ) NULL DEFAULT NULL AFTER `kvoucher_date_create` ,
ADD `kvoucher_date_update` DATETIME NULL DEFAULT NULL AFTER `kvoucher_update` ,
ADD `kvoucher_revised` INT( 11 ) NULL DEFAULT '0' AFTER `kvoucher_date_update` ;
