/*menambah field untuk menyimpan nominal voucher dan no.voucher medis pd master jual rawat dan jual paket*/

ALTER TABLE `master_jual_rawat`  ADD COLUMN `jrawat_cashback_medis` DOUBLE NOT NULL DEFAULT '0' AFTER `jrawat_cashback`,  ADD COLUMN `jrawat_ket_disk_medis` VARCHAR(250) NOT NULL AFTER `jrawat_ket_disk`;

ALTER TABLE `master_jual_paket`  ADD COLUMN `jpaket_cashback_medis` DOUBLE NOT NULL DEFAULT '0' AFTER `jpaket_cashback`,  ADD COLUMN `jpaket_ket_disk_medis` VARCHAR(250) NOT NULL AFTER `jpaket_ket_disk`;
