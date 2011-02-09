/*nambah field akun_departemen pada tabel akun*/

ALTER TABLE `akun`  ADD COLUMN `akun_departemen` INT(11) NULL DEFAULT NULL AFTER `akun_revised`;