--1. menambah jumlah default karyawan cabang
ALTER TABLE `karyawan`  ADD COLUMN `karyawan_cabang2` `karyawan_cabang2` VARCHAR(30) NOT NULL DEFAULT '000000000000000000' AFTER `karyawan_revised`;

--2. menambah field untuk menyimpan value cabang <u/ search>
ALTER TABLE `cabang`  ADD COLUMN `cabang_value` INT(11) NOT NULL DEFAULT '0' AFTER `cabang_revised`;

--3. menambah jumlah default paket aktif cabang
ALTER TABLE `paket`  ADD COLUMN `paket_aktif_cabang` `paket_aktif_cabang` VARCHAR(30) NOT NULL DEFAULT '000000000000000000' AFTER `paket_frek`;