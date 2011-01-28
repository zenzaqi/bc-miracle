/*nambah cabang (MTA) pada tabel cabang*/
INSERT INTO `cabang` (`cabang_nama`, `cabang_kota`, `cabang_propinsi`, `cabang_value`, `cabang_kode`) VALUES ('Mall Taman Anggrek', 'Jakarta', 'DKI Jakarta', 19, 'MTA');
SELECT `cabang_id`, `cabang_nama`, `cabang_alamat`, `cabang_kota`, `cabang_kodepos`, `cabang_propinsi`, `cabang_keterangan`, `cabang_aktif`, `cabang_creator`, `cabang_date_create`, `cabang_update`, `cabang_date_update`, `cabang_revised`, `cabang_value`, `cabang_kode` FROM `miracledb`.`cabang` LIMIT 0, 1000;

/*nambah nilai default tabel karyawan karena nambah cabang (MTA)*/
ALTER TABLE `karyawan`  CHANGE COLUMN `karyawan_cabang2` `karyawan_cabang2` VARCHAR(30) NOT NULL DEFAULT '0000000000000000000' AFTER `karyawan_revised`;

/*nambah nilai default tabel paket karena nambah cabang (MTA)*/
ALTER TABLE `paket`  CHANGE COLUMN `paket_aktif_cabang` `paket_aktif_cabang` VARCHAR(30) NOT NULL DEFAULT '0000000000000000000' AFTER `paket_frek`;

/*nambah nilai default tabel perawatan karena nambah cabang (MTA)*/
ALTER TABLE `perawatan`  CHANGE COLUMN `rawat_aktif_cabang` `rawat_aktif_cabang` VARCHAR(30) NULL DEFAULT '0000000000000000000' AFTER `rawat_jumlah_tindakan`;

/*nambah nilai default tabel produk karena nambah cabang (MTA)*/
ALTER TABLE `produk`  CHANGE COLUMN `produk_aktif_cabang` `produk_aktif_cabang` VARCHAR(30) NULL DEFAULT '0000000000000000000' AFTER `produk_update`;