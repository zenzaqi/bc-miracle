ALTER TABLE `member` CHANGE `member_status` `member_status` ENUM( 'Daftar', 'Cetak', 'Aktif' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Daftar'