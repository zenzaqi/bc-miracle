ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_nilai` `kwitansi_nilai` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `cetak_kwitansi` ADD `kwitansi_sisa` DOUBLE NOT NULL DEFAULT '0' AFTER `kwitansi_nilai` ;