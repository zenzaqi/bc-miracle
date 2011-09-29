/*untuk keperluan MCU, ketika Edit Poin, wajib mengisikan Keterangan*/

ALTER TABLE `voucher`  ADD COLUMN `voucher_keterangan` VARCHAR(500) NULL DEFAULT NULL AFTER `voucher_cashback`;