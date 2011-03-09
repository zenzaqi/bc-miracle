CREATE TABLE `perpanjang_paket` (
`perpanjang_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`perpanjang_djpaket_id` INT( 11 ) NULL ,
`perpanjang_hari` INT( 11 ) NOT NULL ,
`perpanjang_tanggal` DATE NOT NULL ,
`perpanjang_keterangan` VARCHAR( 250 ) NOT NULL ,
`perpanjang_author` VARCHAR( 50 ) NOT NULL ,
`perpanjang_date_create` DATETIME NOT NULL ,
`perpanjang_update` VARCHAR( 50 ) NOT NULL ,
`perpanjang_date_update` DATETIME NOT NULL ,
`perpanjang_revised` INT( 11 ) NOT NULL ,
PRIMARY KEY ( `perpanjang_id` )
) ENGINE = MYISAM ;