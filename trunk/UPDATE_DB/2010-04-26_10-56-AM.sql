ALTER TABLE `tukar_point` ADD `epoint_kwitansi` INT NULL DEFAULT NULL AFTER `epoint_voucher` ;

ALTER TABLE `cetak_kwitansi` CHANGE `kwitansi_cara` `kwitansi_cara` ENUM( 'tunai', 'card', 'cek/giro', 'transfer', 'retur', 'poin' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;

ALTER TABLE `tukar_point` ADD `epoint_nobukti` VARCHAR( 15 ) NULL DEFAULT NULL AFTER `epoint_id` ;

ALTER TABLE `customer` ADD `cust_point` SMALLINT NOT NULL AFTER `cust_cptelp` ;

ALTER TABLE `detail_ambil_paket` ADD `dapaket_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `dapaket_dtrawat` ;

CREATE OR REPLACE VIEW `vu_jrawat_pk` AS select `detail_ambil_paket`.`dapaket_jpaket` AS `jrawat_id`,`master_jual_paket`.`jpaket_nobukti` AS `jrawat_nobukti`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_id` AS `jrawat_cust`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,date_format(`detail_ambil_paket`.`dapaket_date_create`,'%Y-%m-%d') AS `jrawat_tanggal`,0 AS `jrawat_diskon`,0 AS `jrawat_cashback`,NULL AS `jrawat_cara`,NULL AS `jrawat_cara2`,NULL AS `jrawat_cara3`,if((substr(`master_jual_paket`.`jpaket_nobukti`,1,2) = 'PK'),0,0) AS `jrawat_totalbiaya`,0 AS `jrawat_bayar`,'' AS `jrawat_keterangan`,`master_jual_paket`.`jpaket_creator` AS `jrawat_creator`,`detail_ambil_paket`.`dapaket_date_create` AS `jrawat_date_create`,`master_jual_paket`.`jpaket_update` AS `jrawat_update`,`master_jual_paket`.`jpaket_date_update` AS `jrawat_date_update`,`master_jual_paket`.`jpaket_revised` AS `jrawat_revised`,if((substr(`master_jual_paket`.`jpaket_nobukti`,1,2) = 'PK'),'paket','') AS `keterangan_paket`,`detail_ambil_paket`.`dapaket_stat_dok` AS `dapaket_stat_dok` from ((((`detail_ambil_paket` left join `detail_jual_paket` on((`detail_ambil_paket`.`dapaket_dpaket` = `detail_jual_paket`.`dpaket_id`))) left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `pengguna_paket` on((`pengguna_paket`.`ppaket_master` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`pengguna_paket`.`ppaket_cust` = `customer`.`cust_id`)));

CREATE OR REPLACE VIEW `vu_piutang_jproduk` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_bayar` AS `jproduk_bayar`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_totalbiaya` AS `total_jual`,(`master_jual_produk`.`jproduk_totalbiaya` - `master_jual_produk`.`jproduk_bayar`) AS `piutang_total` from (`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) group by `master_jual_produk`.`jproduk_id`;

CREATE OR REPLACE VIEW `vu_piutang_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_totalbiaya` AS `total_jual`,(`master_jual_paket`.`jpaket_totalbiaya` - `master_jual_paket`.`jpaket_bayar`) AS `piutang_total` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) group by `master_jual_paket`.`jpaket_id`;

CREATE OR REPLACE VIEW `vu_piutang_jrawat` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_totalbiaya` AS `total_jual`,(`master_jual_rawat`.`jrawat_totalbiaya` - `master_jual_rawat`.`jrawat_bayar`) AS `piutang_total` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) group by `master_jual_rawat`.`jrawat_id`;