CREATE OR REPLACE `vu_detail_order_beli` AS select `supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_akun` AS `supplier_akun`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`detail_order_beli`.`dorder_master` AS `dorder_master`,`detail_order_beli`.`dorder_produk` AS `dorder_produk`,`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,`detail_order_beli`.`dorder_jumlah` AS `jumlah_barang`,`detail_order_beli`.`dorder_harga` AS `harga_satuan`,`detail_order_beli`.`dorder_diskon` AS `diskon`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`vu_produk`.`produk_kodelama` AS `produk_kodelama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`jenis_kelompok` AS `jenis_kelompok`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_diskon`) * `detail_order_beli`.`dorder_harga`) AS `diskon_nilai`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_harga`) * (100 - `detail_order_beli`.`dorder_diskon`)) AS `subtotal`,`supplier`.`supplier_id` AS `supplier_id`,`master_order_beli`.`order_no` AS `no_bukti` from ((((`detail_order_beli` join `master_order_beli` on((`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`))) join `satuan` on((`detail_order_beli`.`dorder_satuan` = `satuan`.`satuan_id`))) join `vu_produk` on((`detail_order_beli`.`dorder_produk` = `vu_produk`.`produk_id`)));


CREATE OR REPLACE VIEW `vu_trans_order` AS select `master_order_beli`.`order_no` AS `no_bukti`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,ifnull(`master_order_beli`.`order_diskon`,0) AS `order_diskon`,ifnull(`master_order_beli`.`order_biaya`,0) AS `order_biaya`,ifnull(`master_order_beli`.`order_bayar`,0) AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`vu_total_order_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_order_group`.`total_nilai` AS `total_nilai`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_kodepos` AS `supplier_kodepos`,`supplier`.`supplier_propinsi` AS `supplier_propinsi`,`supplier`.`supplier_negara` AS `supplier_negara`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_notelp2` AS `supplier_notelp2`,`supplier`.`supplier_nofax` AS `supplier_nofax`,`supplier`.`supplier_email` AS `supplier_email`,`supplier`.`supplier_website` AS `supplier_website`,`supplier`.`supplier_cp` AS `supplier_cp`,`supplier`.`supplier_contact_cp` AS `supplier_contact_cp`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_keterangan` AS `supplier_keterangan`,`master_order_beli`.`order_id` AS `order_id`,ifnull(`master_order_beli`.`order_cashback`,0) AS `order_cashback`,`supplier`.`supplier_id` AS `supplier_id` from ((`master_order_beli` join `vu_total_order_group` on((`vu_total_order_group`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`)))