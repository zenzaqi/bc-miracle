DROP VIEW `vu_member`;

ALTER TABLE `master_retur_jual_produk` CHANGE `rproduk_date_create` `rproduk_date_create`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;