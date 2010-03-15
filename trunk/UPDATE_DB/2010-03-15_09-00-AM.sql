ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_status` `kwitansi_status` VARCHAR( 25 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'aktif';

update cetak_kwitansi
set kwitansi_status = 'Terbuka'
where kwitansi_status = 'Aktif';

ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_status` `kwitansi_status` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Terbuka';
