/*menambahkan field 'terima_gudang_id'untuk menyimpan id gudang*/
ALTER TABLE `master_terima_beli`  ADD COLUMN `terima_gudang_id` INT(11) NULL AFTER `terima_revised`;

/*vu_trans_terima*/
CREATE OR REPLACE VIEW `vu_trans_terima` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `no_bukti`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_status` AS `terima_status`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,ifnull(`vu_total_terima_bonus_group`.`jumlah_barang_bonus`,0) AS `jumlah_barang_bonus`,`vu_total_terima_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_terima_group`.`total_nilai` AS `total_nilai`,`master_terima_beli`.`terima_gudang_id` AS `terima_gudang_id`,`gudang`.`gudang_nama` AS `terima_gudang_nama` from (((((`master_terima_beli` join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `master_order_beli` on((`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`))) left join `vu_total_terima_bonus_group` on((`vu_total_terima_bonus_group`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `vu_total_terima_group` on((`vu_total_terima_group`.`dterima_master` = `master_terima_beli`.`terima_id`))) left join `gudang` on((`master_terima_beli`.`terima_gudang_id` = `gudang`.`gudang_id`)));

/*vu_produk_satuan_terkecil*/
CREATE OR REPLACE VIEW `vu_produk_satuan_terkecil` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_racikan` AS `produk_racikan`,`produk`.`produk_keterangan` AS `produk_keterangan`,`produk`.`produk_saldo_awal` AS `produk_saldo_awal`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`kategori2`.`kategori2_id` AS `kategori2_id`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_kelompok` AS `group_kelompok`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`master_terima_beli`.`terima_gudang_id` AS `terima_gudang_id` from (((((((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`))) left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) left join `detail_terima_beli` on((`produk`.`produk_id` = `detail_terima_beli`.`dterima_produk`))) left join `master_terima_beli` on((`master_terima_beli`.`terima_id` = `detail_terima_beli`.`dterima_master`))) where (`satuan_konversi`.`konversi_nilai` = 1);

/*vu_produk_satuan_default*/
CREATE OR REPLACE VIEW `vu_produk_satuan_default` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_racikan` AS `produk_racikan`,`produk`.`produk_keterangan_resep` AS `produk_keterangan_resep`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_keterangan` AS `produk_keterangan`,`produk`.`produk_saldo_awal` AS `produk_saldo_awal`,`produk`.`produk_nilai_saldo_awal` AS `produk_nilai_saldo_awal`,`master_terima_beli`.`terima_gudang_id` AS `terima_gudang_id` from ((((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) left join `detail_terima_beli` on((`produk`.`produk_id` = `detail_terima_beli`.`dterima_produk`))) left join `master_terima_beli` on((`master_terima_beli`.`terima_id` = `detail_terima_beli`.`dterima_master`))) where (`satuan_konversi`.`konversi_default` = 1);
