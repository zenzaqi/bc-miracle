ALTER TABLE `master_ambil_paket` ADD `apaket_paket` INT( 11 ) NOT NULL AFTER `apaket_cust` ,
ADD `apaket_sisa_paket` INT( 11 ) NOT NULL DEFAULT '0' AFTER `apaket_paket`;

ALTER TABLE `detail_ambil_paket` ADD `dapaket_id` INT( 11 ) NOT NULL FIRST,  ADD `dapaket_dpaket` INT( 11 ) NOT NULL AFTER `dapaket_master`;

ALTER TABLE `miracledb`.`detail_ambil_paket` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `dapaket_id` );


ALTER TABLE `paket` ADD `paket_jmlisi` INT( 11 ) NULL DEFAULT '0' AFTER `paket_expired`;


CREATE TABLE `miracledb`.`submaster_apaket_item` (
`sapaket_id` INT( 11 ) NOT NULL ,
`sapaket_master` INT( 11 ) NOT NULL ,
`sapaket_item` INT( 11 ) NOT NULL ,
`sapaket_sisa_item` INT( 11 ) NOT NULL
) ENGINE = MYISAM ;


ALTER TABLE `perawatan_konsumsi` CHANGE `krawat_jumlah` `krawat_jumlah` FLOAT NULL DEFAULT NULL;