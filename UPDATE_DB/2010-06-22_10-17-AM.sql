ALTER TABLE `master_retur_jual_paket` ADD `rpaket_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `rpaket_keterangan` ;

ALTER TABLE `master_retur_jual_produk` CHANGE `rproduk_status` `rproduk_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka';