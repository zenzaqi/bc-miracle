ALTER TABLE `appointment` CHANGE `app_revised` `app_revised` INT( 11 ) NULL DEFAULT '0';
ALTER TABLE `appointment` CHANGE `app_date_create` `app_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `appointment_detail` ADD `dapp_creator` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dapp_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
ADD `dapp_update` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dapp_date_update` DATETIME NULL DEFAULT NULL ,
ADD `dapp_revised` INT( 11 ) NULL DEFAULT '0';

ALTER TABLE `tindakan` CHANGE `trawat_revised` `trawat_revised` INT( 11 ) NULL DEFAULT '0';
ALTER TABLE `tindakan` CHANGE `trawat_date_create` `trawat_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `tindakan_detail` ADD `dtrawat_creator` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dtrawat_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
ADD `dtrawat_update` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dtrawat_date_update` DATETIME NULL DEFAULT NULL ,
ADD `dtrawat_revised` INT( 11 ) NULL DEFAULT '0';

ALTER TABLE `master_jual_produk` CHANGE `jproduk_revised` `jproduk_revised` INT( 11 ) NULL DEFAULT '0';
ALTER TABLE `master_jual_produk` CHANGE `jproduk_date_create` `jproduk_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `detail_jual_produk` ADD `dproduk_creator` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dproduk_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
ADD `dproduk_update` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dproduk_date_update` DATETIME NULL DEFAULT NULL ,
ADD `dproduk_revised` INT( 11 ) NULL DEFAULT '0';

ALTER TABLE `master_jual_rawat` CHANGE `jrawat_revised` `jrawat_revised` INT( 11 ) NULL DEFAULT '0';
ALTER TABLE `master_jual_rawat` CHANGE `jrawat_date_create` `jrawat_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `detail_jual_rawat` ADD `drawat_creator` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `drawat_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
ADD `drawat_update` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `drawat_date_update` DATETIME NULL DEFAULT NULL ,
ADD `drawat_revised` INT( 11 ) NULL DEFAULT '0';

ALTER TABLE `master_jual_paket` CHANGE `jpaket_revised` `jpaket_revised` INT( 11 ) NULL DEFAULT '0';
ALTER TABLE `master_jual_paket` CHANGE `jpaket_date_create` `jpaket_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `detail_jual_paket` ADD `dpaket_creator` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dpaket_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
ADD `dpaket_update` VARCHAR( 50 ) NULL DEFAULT NULL ,
ADD `dpaket_date_update` DATETIME NULL DEFAULT NULL ,
ADD `dpaket_revised` INT( 11 ) NULL DEFAULT '0';