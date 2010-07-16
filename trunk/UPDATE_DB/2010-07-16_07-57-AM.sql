ALTER TABLE `member_setup` ADD `setmember_point_perrp` DOUBLE NOT NULL DEFAULT '0' AFTER `setmember_rp_perpoint`  ;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jproduk` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_bayar` AS `jproduk_bayar`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_totalbiaya` AS `total_jual`,(`master_jual_produk`.`jproduk_totalbiaya` - `master_jual_produk`.`jproduk_bayar`) AS `piutang_total` from (`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) where (`master_jual_produk`.`jproduk_totalbiaya` > `master_jual_produk`.`jproduk_bayar`) group by `detail_jual_produk`.`dproduk_master`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_totalbiaya` AS `total_jual`,(`master_jual_paket`.`jpaket_totalbiaya` - `master_jual_paket`.`jpaket_bayar`) AS `piutang_total` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) where (`master_jual_paket`.`jpaket_totalbiaya` > `master_jual_paket`.`jpaket_bayar`) group by `detail_jual_paket`.`dpaket_master`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jrawat` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_totalbiaya` AS `total_jual`,(`master_jual_rawat`.`jrawat_totalbiaya` - `master_jual_rawat`.`jrawat_bayar`) AS `piutang_total` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) where (`master_jual_rawat`.`jrawat_totalbiaya` > `master_jual_rawat`.`jrawat_bayar`) group by `detail_jual_rawat`.`drawat_master`;