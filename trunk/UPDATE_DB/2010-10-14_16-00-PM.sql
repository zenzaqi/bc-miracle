ALTER TABLE `miracledb`.`master_jual_produk` ADD INDEX `jproduk_cust_index` ( `jproduk_cust` ) ;

ALTER TABLE `miracledb`.`member` ADD INDEX `member_cust_index` ( `member_cust` ) ;

ALTER TABLE `detail_jual_produk` ADD `dproduk_set_point` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `dproduk_produk` ;

ALTER TABLE `detail_jual_rawat` CHANGE `drawat_dtrawat` `drawat_dtrawat` INT( 11 ) NOT NULL DEFAULT '0';

ALTER TABLE `detail_jual_paket` ADD `dpaket_set_point` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `dpaket_paket` ;

ALTER TABLE `detail_jual_rawat` ADD `drawat_set_point` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `drawat_rawat` ;