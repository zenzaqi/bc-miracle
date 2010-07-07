CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_stat_dok` AS `jpaket_stat_dok`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`member_no` AS `member_no`,`vu_customer`.`member_valid` AS `member_valid`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_diskon` AS `jpaket_diskon`,`master_jual_paket`.`jpaket_cashback` AS `jpaket_cashback`,`master_jual_paket`.`jpaket_cara` AS `jpaket_cara`,`master_jual_paket`.`jpaket_cara2` AS `jpaket_cara2`,`master_jual_paket`.`jpaket_cara3` AS `jpaket_cara3`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,`master_jual_paket`.`jpaket_totalbiaya` AS `jpaket_totalbiaya`,`master_jual_paket`.`jpaket_keterangan` AS `jpaket_keterangan`,`master_jual_paket`.`jpaket_creator` AS `jpaket_creator`,`master_jual_paket`.`jpaket_date_create` AS `jpaket_date_create`,`master_jual_paket`.`jpaket_update` AS `jpaket_update`,`master_jual_paket`.`jpaket_date_update` AS `jpaket_date_update`,`master_jual_paket`.`jpaket_revised` AS `jpaket_revised` from (`master_jual_paket` left join `vu_customer` on((`master_jual_paket`.`jpaket_cust` = `vu_customer`.`cust_id`)));
