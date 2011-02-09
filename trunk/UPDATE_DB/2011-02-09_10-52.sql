/*menambah field untuk kode cabang akun*/
ALTER TABLE `cabang`  ADD COLUMN `cabang_kode_akun` VARCHAR(11) NOT NULL AFTER `cabang_kode`;