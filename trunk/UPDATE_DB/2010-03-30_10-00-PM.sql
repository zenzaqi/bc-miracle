ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_revised` `kwitansi_revised` INT( 11 ) NOT NULL DEFAULT '0';

ALTER TABLE `cetak_kwitansi` ADD `kwitansi_bayar` DOUBLE NOT NULL DEFAULT '0' AFTER `kwitansi_cara` ;