ALTER TABLE `master_jual_produk` ADD `jproduk_stat_dok` ENUM( 'Terbuka', 'Tertutup','Batal' ) NULL DEFAULT 'Terbuka' AFTER `jproduk_cara`;

CREATE OR REPLACE VIEW `vu_jproduk` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_diskon` AS `jproduk_diskon`,`master_jual_produk`.`jproduk_cashback` AS `jproduk_cashback`,`master_jual_produk`.`jproduk_cara` AS `jproduk_cara`,`master_jual_produk`.`jproduk_cara2` AS `jproduk_cara2`,`master_jual_produk`.`jproduk_cara3` AS `jproduk_cara3`,`master_jual_produk`.`jproduk_bayar` AS `jproduk_bayar`,`master_jual_produk`.`jproduk_totalbiaya` AS `jproduk_totalbiaya`,`master_jual_produk`.`jproduk_keterangan` AS `jproduk_keterangan`,`master_jual_produk`.`jproduk_creator` AS `jproduk_creator`,`master_jual_produk`.`jproduk_date_create` AS `jproduk_date_create`,`master_jual_produk`.`jproduk_update` AS `jproduk_update`,`master_jual_produk`.`jproduk_date_update` AS `jproduk_date_update`,`master_jual_produk`.`jproduk_revised` AS `jproduk_revised` from (`master_jual_produk` left join `customer` on((`master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`)));


