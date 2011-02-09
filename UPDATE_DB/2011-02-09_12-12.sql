/*nambah field untuk kode akun departemen*/

ALTER TABLE `departemen`  ADD COLUMN `departemen_kode_akun` VARCHAR(11) NULL AFTER `departemen_revised`;