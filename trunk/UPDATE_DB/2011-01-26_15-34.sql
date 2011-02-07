/*nambah cabang (MTA) pada tabel cabang*/
INSERT INTO `cabang` (`cabang_nama`, `cabang_kota`, `cabang_propinsi`, `cabang_value`, `cabang_kode`) VALUES ('Mall Taman Anggrek', 'Jakarta', 'DKI Jakarta', 19, 'MTA');

/*nambah nilai default tabel karyawan karena nambah cabang (MTA)*/
ALTER TABLE `karyawan`  CHANGE COLUMN `karyawan_cabang2` VARCHAR(30) NOT NULL DEFAULT '0000000000000000000' AFTER `karyawan_revised`;

/*nambah nilai default tabel paket karena nambah cabang (MTA)*/
ALTER TABLE `paket`  CHANGE COLUMN `paket_aktif_cabang` VARCHAR(30) NOT NULL DEFAULT '0000000000000000000' AFTER `paket_frek`;

/*nambah nilai default tabel perawatan karena nambah cabang (MTA)*/
ALTER TABLE `perawatan`  CHANGE COLUMN `rawat_aktif_cabang` VARCHAR(30) NULL DEFAULT '0000000000000000000' AFTER `rawat_jumlah_tindakan`;

/*nambah nilai default tabel produk karena nambah cabang (MTA)*/
ALTER TABLE `produk`  CHANGE COLUMN `produk_aktif_cabang` VARCHAR(30) NULL DEFAULT '0000000000000000000' AFTER `produk_update`;

