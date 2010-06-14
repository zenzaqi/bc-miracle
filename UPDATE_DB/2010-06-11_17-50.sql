ALTER TABLE `customer` ADD `cust_member_since` DATE NULL AFTER `cust_member` ;

ALTER TABLE `master_retur_jual_produk` ADD `rproduk_status` ENUM( 'Terbuka', 'Tertutup','Batal' ) NULL DEFAULT 'Terbuka' AFTER `rproduk_keterangan` 