CREATE OR REPLACE VIEW `vu_jrawat_pk` AS select `detail_ambil_paket`.`dapaket_jpaket` AS `jrawat_id`,`master_jual_paket`.`jpaket_nobukti` AS `jrawat_nobukti`,`detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_id` AS `jrawat_cust`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,date_format(`detail_ambil_paket`.`dapaket_date_create`,'%Y-%m-%d') AS `jrawat_tanggal`,0 AS `jrawat_diskon`,0 AS `jrawat_cashback`,NULL AS `jrawat_cara`,NULL AS `jrawat_cara2`,NULL AS `jrawat_cara3`,if((substr(`master_jual_paket`.`jpaket_nobukti`,1,2) = 'PK'),0,0) AS `jrawat_totalbiaya`,0 AS `jrawat_bayar`,'' AS `jrawat_keterangan`,`master_jual_paket`.`jpaket_creator` AS `jrawat_creator`,`detail_ambil_paket`.`dapaket_date_create` AS `jrawat_date_create`,`master_jual_paket`.`jpaket_update` AS `jrawat_update`,`master_jual_paket`.`jpaket_date_update` AS `jrawat_date_update`,`master_jual_paket`.`jpaket_revised` AS `jrawat_revised`,if((substr(`master_jual_paket`.`jpaket_nobukti`,1,2) = 'PK'),'paket','') AS `keterangan_paket`,`detail_ambil_paket`.`dapaket_stat_dok` AS `dapaket_stat_dok` from (((`detail_ambil_paket` left join `detail_jual_paket` on((`detail_ambil_paket`.`dapaket_dpaket` = `detail_jual_paket`.`dpaket_id`))) left join `master_jual_paket` on((`detail_ambil_paket`.`dapaket_jpaket` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`detail_ambil_paket`.`dapaket_cust` = `customer`.`cust_id`)));

CREATE OR REPLACE VIEW `vu_jrawat_pr` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,0 AS `dpaket_id`,`master_jual_rawat`.`jrawat_stat_dok` AS `jrawat_stat_dok`,`customer`.`cust_nama` AS `cust_nama`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_diskon` AS `jrawat_diskon`,`master_jual_rawat`.`jrawat_cashback` AS `jrawat_cashback`,`master_jual_rawat`.`jrawat_cara` AS `jrawat_cara`,`master_jual_rawat`.`jrawat_cara2` AS `jrawat_cara2`,`master_jual_rawat`.`jrawat_cara3` AS `jrawat_cara3`,`master_jual_rawat`.`jrawat_totalbiaya` AS `jrawat_totalbiaya`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_keterangan` AS `jrawat_keterangan`,`master_jual_rawat`.`jrawat_creator` AS `jrawat_creator`,`master_jual_rawat`.`jrawat_date_create` AS `jrawat_date_create`,`master_jual_rawat`.`jrawat_update` AS `jrawat_update`,`master_jual_rawat`.`jrawat_date_update` AS `jrawat_date_update`,`master_jual_rawat`.`jrawat_revised` AS `jrawat_revised`,if((substr(`master_jual_rawat`.`jrawat_nobukti`,1,2) = _latin1'PK'),_utf8'paket',_utf8'') AS `keterangan_paket` from (`master_jual_rawat` left join `customer` on((`master_jual_rawat`.`jrawat_cust` = `customer`.`cust_id`)));