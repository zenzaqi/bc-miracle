ALTER TABLE `jual_transfer` CHANGE `jtransfer_bank` `jtransfer_bank` INT( 11 ) NOT NULL;

ALTER TABLE `master_jual_produk` ADD `jproduk_cara2` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) NULL AFTER `jproduk_cara` ,
ADD `jproduk_cara3` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) NULL AFTER `jproduk_cara2`;

ALTER TABLE `master_jual_produk` CHANGE `jproduk_cara` `jproduk_cara` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;