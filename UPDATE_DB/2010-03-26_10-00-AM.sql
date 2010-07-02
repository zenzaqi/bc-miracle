ALTER TABLE `master_jual_paket` ADD `jpaket_totalbiaya` DOUBLE NOT NULL DEFAULT '0' AFTER `jpaket_bayar`,
CHANGE `jpaket_diskon` `jpaket_diskon` FLOAT NOT NULL DEFAULT '0',
CHANGE `jpaket_cashback` `jpaket_cashback` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `detail_jual_paket` CHANGE `dpaket_diskon` `dpaket_diskon` INT( 11 ) NOT NULL DEFAULT '0';

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_diskon` AS `jpaket_diskon`,`master_jual_paket`.`jpaket_cashback` AS `jpaket_cashback`,`master_jual_paket`.`jpaket_cara` AS `jpaket_cara`,`master_jual_paket`.`jpaket_cara2` AS `jpaket_cara2`,`master_jual_paket`.`jpaket_cara3` AS `jpaket_cara3`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,`master_jual_paket`.`jpaket_totalbiaya` AS `jpaket_totalbiaya`,`master_jual_paket`.`jpaket_keterangan` AS `jpaket_keterangan`,`master_jual_paket`.`jpaket_creator` AS `jpaket_creator`,`master_jual_paket`.`jpaket_date_create` AS `jpaket_date_create`,`master_jual_paket`.`jpaket_update` AS `jpaket_update`,`master_jual_paket`.`jpaket_date_update` AS `jpaket_date_update`,`master_jual_paket`.`jpaket_revised` AS `jpaket_revised` from (`master_jual_paket` left join `customer` on((`master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`)));

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jpaket_totalbiaya` AS select `detail_jual_paket`.`dpaket_master` AS `dpaket_master`,((sum((`detail_jual_paket`.`dpaket_harga` * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100))) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`) AS `jpaket_totalbiaya` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) group by `detail_jual_paket`.`dpaket_master`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jproduk` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_diskon` AS `jproduk_diskon`,`master_jual_produk`.`jproduk_cashback` AS `jproduk_cashback`,`master_jual_produk`.`jproduk_cara` AS `jproduk_cara`,`master_jual_produk`.`jproduk_cara2` AS `jproduk_cara2`,`master_jual_produk`.`jproduk_cara3` AS `jproduk_cara3`,`master_jual_produk`.`jproduk_bayar` AS `jproduk_bayar`,`master_jual_produk`.`jproduk_totalbiaya` AS `jproduk_totalbiaya`,`master_jual_produk`.`jproduk_keterangan` AS `jproduk_keterangan`,`master_jual_produk`.`jproduk_creator` AS `jproduk_creator`,`master_jual_produk`.`jproduk_date_create` AS `jproduk_date_create`,`master_jual_produk`.`jproduk_update` AS `jproduk_update`,`master_jual_produk`.`jproduk_date_update` AS `jproduk_date_update`,`master_jual_produk`.`jproduk_revised` AS `jproduk_revised` from (`master_jual_produk` left join `customer` on((`master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`)));

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jproduk_totalbiaya` AS select `detail_jual_produk`.`dproduk_master` AS `dproduk_master`,((sum((`detail_jual_produk`.`dproduk_harga` * ((100 - `detail_jual_produk`.`dproduk_diskon`) / 100))) * ((100 - `master_jual_produk`.`jproduk_diskon`) / 100)) - `master_jual_produk`.`jproduk_cashback`) AS `jproduk_totalbiaya` from (`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) group by `detail_jual_produk`.`dproduk_master`;

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jrawat_pr` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`customer`.`cust_nama` AS `cust_nama`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_diskon` AS `jrawat_diskon`,`master_jual_rawat`.`jrawat_cashback` AS `jrawat_cashback`,`master_jual_rawat`.`jrawat_cara` AS `jrawat_cara`,`master_jual_rawat`.`jrawat_cara2` AS `jrawat_cara2`,`master_jual_rawat`.`jrawat_cara3` AS `jrawat_cara3`,`master_jual_rawat`.`jrawat_totalbiaya` AS `jrawat_totalbiaya`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_keterangan` AS `jrawat_keterangan`,`master_jual_rawat`.`jrawat_creator` AS `jrawat_creator`,`master_jual_rawat`.`jrawat_date_create` AS `jrawat_date_create`,`master_jual_rawat`.`jrawat_update` AS `jrawat_update`,`master_jual_rawat`.`jrawat_date_update` AS `jrawat_date_update`,`master_jual_rawat`.`jrawat_revised` AS `jrawat_revised`,if((substr(`master_jual_rawat`.`jrawat_nobukti`,1,2) = 'PK'),'paket','') AS `keterangan_paket` from (`master_jual_rawat` left join `customer` on((`master_jual_rawat`.`jrawat_cust` = `customer`.`cust_id`)));

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jrawat_totalbiaya` AS select `detail_jual_rawat`.`drawat_master` AS `drawat_master`,((sum((`detail_jual_rawat`.`drawat_harga` * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100))) * ((100 - `master_jual_rawat`.`jrawat_diskon`) / 100)) - `master_jual_rawat`.`jrawat_cashback`) AS `jrawat_totalbiaya` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) group by `detail_jual_rawat`.`drawat_master`;

ALTER TABLE `master_jual_produk` CHANGE `jproduk_diskon` `jproduk_diskon` INT( 11 ) NOT NULL DEFAULT '0',
CHANGE `jproduk_cashback` `jproduk_cashback` DOUBLE NOT NULL DEFAULT '0';

ALTER TABLE `master_jual_paket` CHANGE `jpaket_diskon` `jpaket_diskon` INT( 11 ) NOT NULL DEFAULT '0';

ALTER TABLE `detail_jual_produk` CHANGE `dproduk_diskon` `dproduk_diskon` INT( 11 ) NOT NULL DEFAULT '0';