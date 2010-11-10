--utk dijoinkan dg tb voucher, supaya bisa menampilkan data cust dg cepat

ALTER TABLE `member`  ADD INDEX `member_no` (`member_no`);

-- ada voucher_tgl

ALTER TABLE `voucher`  ADD COLUMN `voucher_tgl` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `voucher_date_create`;