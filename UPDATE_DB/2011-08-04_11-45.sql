ALTER TABLE `master_retur_jual_paket` ADD `rpaket_voucher` DOUBLE NOT NULL AFTER `rpaket_revised`;
ALTER TABLE `master_retur_jual_produk` ADD `rproduk_voucher` DOUBLE NOT NULL AFTER `rproduk_revised`;