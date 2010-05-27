--
-- Structure for view `vu_detail_terima_all`
--

CREATE OR REPLACE VIEW `vu_detail_terima_all` AS select `vu_detail_terima_produk`.`dterima_master` AS `master`,`vu_detail_terima_produk`.`produk_id` AS `produk_id`,`vu_detail_terima_produk`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_produk`.`terima_no` AS `no_bukti`,`vu_detail_terima_produk`.`supplier_id` AS `supplier_id`,`vu_detail_terima_produk`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_produk`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_produk`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_produk`.`produk_kode` AS `produk_kode`,`vu_detail_terima_produk`.`produk_nama` AS `produk_nama`,`vu_detail_terima_produk`.`satuan_id` AS `satuan_id`,`vu_detail_terima_produk`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_produk`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_produk`.`dterima_jumlah` AS `jumlah`,`vu_detail_terima_produk`.`harga_satuan` AS `harga_satuan`,`vu_detail_terima_produk`.`diskon` AS `diskon`,`vu_detail_terima_produk`.`diskon_nilai` AS `diskon_nilai`,`vu_detail_terima_produk`.`subtotal` AS `subtotal`,`vu_detail_terima_produk`.`terima_tanggal` AS `tanggal`,_utf8'produk' AS `jenis` from `vu_detail_terima_produk` union select `vu_detail_terima_bonus`.`dtbonus_master` AS `master`,`vu_detail_terima_bonus`.`produk_id` AS `produk_id`,`vu_detail_terima_bonus`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_bonus`.`terima_no` AS `no_bukti`,`vu_detail_terima_bonus`.`supplier_id` AS `supplier_id`,`vu_detail_terima_bonus`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_bonus`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_bonus`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_bonus`.`produk_kode` AS `produk_kode`,`vu_detail_terima_bonus`.`produk_nama` AS `produk_nama`,`vu_detail_terima_bonus`.`satuan_id` AS `satuan_id`,`vu_detail_terima_bonus`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_bonus`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_bonus`.`dtbonus_jumlah` AS `jumlah`,0 AS `harga_satuan`,0 AS `diskon`,0 AS `diskon_nilai`,0 AS `subtotal`,`vu_detail_terima_bonus`.`terima_tanggal` AS `tanggal`,_utf8'bonus' AS `jenis` from `vu_detail_terima_bonus`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_terima_konversi`
--

CREATE OR REPLACE VIEW `vu_trans_terima_konversi` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,`vu_total_terima_group_konversi`.`jumlah_barang` AS `jumlah_barang`,`vu_total_terima_group_konversi`.`jumlah_nilai` AS `jumlah_nilai`,`vu_total_terima_group_konversi`.`jumlah_konversi` AS `jumlah_konversi`,`master_order_beli`.`order_cashback` AS `order_cashback`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_diskon` AS `order_diskon`,(`master_order_beli`.`order_cashback` / `vu_total_terima_group_konversi`.`jumlah_barang`) AS `potongan_satuan`,(`master_order_beli`.`order_biaya` / `vu_total_terima_group_konversi`.`jumlah_barang`) AS `biaya_satuan`,(((`vu_total_terima_group_konversi`.`jumlah_nilai` * `master_order_beli`.`order_diskon`) / 100) / `vu_total_terima_group_konversi`.`jumlah_barang`) AS `diskon_satuan` from ((`vu_total_terima_group_konversi` join `master_terima_beli` on((`vu_total_terima_group_konversi`.`master` = `master_terima_beli`.`terima_id`))) join `master_order_beli` on((`master_order_beli`.`order_id` = `master_terima_beli`.`terima_order`)));


--
-- Structure for view `vu_hpp_beli_terima`
--

CREATE OR REPLACE VIEW `vu_hpp_beli_terima` AS select `vu_trans_terima_konversi`.`terima_tanggal` AS `tanggal`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif` AS `satuan_aktif`,`vu_detail_terima_all`.`jumlah` AS `jumlah`,`vu_detail_terima_all`.`harga_satuan` AS `harga_satuan`,`vu_detail_terima_all`.`diskon` AS `diskon`,`vu_trans_terima_konversi`.`potongan_satuan` AS `potongan_satuan`,`vu_trans_terima_konversi`.`biaya_satuan` AS `biaya_satuan`,`vu_trans_terima_konversi`.`diskon_satuan` AS `diskon_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,((((((`vu_detail_terima_all`.`harga_satuan` * (100 - `vu_detail_terima_all`.`diskon`)) / 100) / `satuan_konversi`.`konversi_nilai`) - `vu_trans_terima_konversi`.`potongan_satuan`) - `vu_trans_terima_konversi`.`diskon_satuan`) + `vu_trans_terima_konversi`.`diskon_satuan`) AS `harga_beli`,(`satuan_konversi`.`konversi_nilai` * `vu_detail_terima_all`.`jumlah`) AS `jumlah_konversi` from (((`vu_detail_terima_all` join `satuan_konversi` on(((`vu_detail_terima_all`.`produk_id` = `satuan_konversi`.`konversi_produk`) and (`vu_detail_terima_all`.`satuan_id` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `vu_trans_terima_konversi` on((`vu_trans_terima_konversi`.`terima_id` = `vu_detail_terima_all`.`master`)));

-- --------------------------------------------------------

