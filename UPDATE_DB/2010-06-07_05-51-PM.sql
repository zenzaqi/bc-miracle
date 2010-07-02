CREATE OR REPLACE VIEW `vu_detail_retur_jual_produk` AS select `detail_retur_jual_produk`.`drproduk_id` AS `drproduk_id`,`detail_retur_jual_produk`.`drproduk_master` AS `drproduk_master`,`detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,`detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,`detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,`detail_retur_jual_produk`.`drproduk_harga` AS `drproduk_harga`,`master_retur_jual_produk`.`rproduk_nobukti` AS `rproduk_nobukti`,`master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,`master_retur_jual_produk`.`rproduk_id` AS `rproduk_id`,`master_retur_jual_produk`.`rproduk_nobuktijual` AS `rproduk_nobuktijual`,`master_retur_jual_produk`.`rproduk_cust` AS `rproduk_cust`,`master_retur_jual_produk`.`rproduk_keterangan` AS `rproduk_keterangan`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota` from ((`master_retur_jual_produk` join `detail_retur_jual_produk` on((`detail_retur_jual_produk`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) join `customer` on((`master_retur_jual_produk`.`rproduk_cust` = `customer`.`cust_id`)));