ALTER TABLE `master_jual_rawat` CHANGE `jrawat_bayar` `jrawat_bayar` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `master_jual_produk` CHANGE `jproduk_bayar` `jproduk_bayar` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `master_jual_paket` CHANGE `jpaket_bayar` `jpaket_bayar` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_cara` `kwitansi_cara` ENUM( 'tunai', 'card', 'cek/giro', 'transfer', 'retur' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;