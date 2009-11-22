ALTER TABLE `master_jual_rawat` CHANGE `jrawat_cara` `jrawat_cara` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `master_jual_rawat` ADD `jrawat_cara2` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) NULL AFTER `jrawat_cara` ,
ADD `jrawat_cara3` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) NULL AFTER `jrawat_cara2`;
