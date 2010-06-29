ALTER TABLE `produk` ADD `produk_saldo_awal` DOUBLE NOT NULL DEFAULT '0' AFTER `produk_aktif` ;

ALTER TABLE `produk` ADD `produk_nilai_saldo_awal` DOUBLE NOT NULL DEFAULT '0' AFTER `produk_saldo_awal` ;