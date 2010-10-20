ALTER TABLE `detail_retur_paket_rawat` ADD `drpaket_paket` INT NOT NULL DEFAULT '0' AFTER `drpaket_dpaket` ;

ALTER TABLE `detail_retur_paket_rawat` CHANGE `drpaket_jumlah` `drpaket_jumlah_diretur` INT( 11 ) NOT NULL DEFAULT '0';

ALTER TABLE `detail_retur_paket_rawat` CHANGE `drpaket_harga` `drpaket_harga_satu` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `detail_retur_paket_rawat` ADD `drpaket_jumlah_terambil` INT NOT NULL DEFAULT '0' AFTER `drpaket_jumlah_diretur` ;

ALTER TABLE `detail_retur_paket_rawat` ADD `drpaket_rupiah_retur` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `master_retur_jual_paket` CHANGE `rpaket_date_create` `rpaket_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `master_retur_jual_paket` CHANGE `rpaket_revised` `rpaket_revised` INT( 11 ) NOT NULL DEFAULT '0';