ALTER TABLE `master_jual_rawat` CHANGE `jrawat_status` `jrawat_status` ENUM( 'pending', 'cetak', 'batal' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'pending';

ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_status` `kwitansi_status` ENUM( 'Aktif', 'Tidak Aktif' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Aktif';