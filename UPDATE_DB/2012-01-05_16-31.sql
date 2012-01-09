/*nambah cashback_medis*/

CREATE OR REPLACE VIEW `vu_trans_produk` AS select `master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_cust` AS `cust_id`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`vu_total_jual_produk_group`.`jumlah_barang`,0) AS `jumlah_barang`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_total_jual_produk_group`.`total_nilai`,0)) AS `total_nilai`,`master_jual_produk`.`jproduk_bayar` AS `total_bayar`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`master_jual_produk`.`jproduk_diskon`,0)) AS `diskon`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`master_jual_produk`.`jproduk_cashback`,0)) AS `cashback`,0 AS `cashback_medis`,ifnull(`master_lunas_piutang`.`lpiutang_total`,0) AS `kredit`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_sum_jual_cek`.`jcek_nilai`,0)) AS `cek`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_sum_jual_card`.`jcard_nilai`,0)) AS `card`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_sum_jual_kwitansi`.`jkwitansi_nilai`,0)) AS `kuitansi`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_sum_jual_transfer`.`jtransfer_nilai`,0)) AS `transfer`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_sum_jual_tunai`.`jtunai_nilai`,0)) AS `tunai`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,ifnull(`vu_sum_jual_voucher`.`tvoucher_nilai`,0)) AS `voucher`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok` from (((((((((`master_jual_produk` left join `vu_total_jual_produk_group` on((`vu_total_jual_produk_group`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) left join `vu_customer` on((`master_jual_produk`.`jproduk_cust` = `vu_customer`.`cust_id`))) left join `vu_sum_jual_card` on((`vu_sum_jual_card`.`jcard_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_cek` on((`vu_sum_jual_cek`.`jcek_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `master_lunas_piutang` on((`master_lunas_piutang`.`lpiutang_faktur` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_kwitansi` on((`vu_sum_jual_kwitansi`.`jkwitansi_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_transfer` on((`vu_sum_jual_transfer`.`jtransfer_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_tunai` on((`vu_sum_jual_tunai`.`jtunai_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_voucher` on((`vu_sum_jual_voucher`.`tvoucher_ref` = `master_jual_produk`.`jproduk_nobukti`)));

--
-- VIEW  `vu_trans_produk`
-- Data: None
--

