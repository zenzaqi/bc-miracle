ALTER TABLE `detail_pakai_cabin` CHANGE `cabin_dtrawat` `cabin_dtrawat` INT( 11 ) NOT NULL AUTO_INCREMENT COMMENT 'Tidak dipakai lagi',
CHANGE `cabin_date_create` `cabin_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'diset bisa allow nul',
CHANGE `cabin_cust` `cabin_cust` INT( 11 ) NULL DEFAULT NULL COMMENT 'diset bisa allow null';


ALTER TABLE `detail_pakai_cabin` ADD `cabin_dapaket_id` INT( 11 ) NULL DEFAULT NULL AFTER `cabin_bukti`;