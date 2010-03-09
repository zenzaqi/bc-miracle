CREATE OR REPLACE VIEW `vu_detail_terima_bonus` AS select `master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_bonus`.`dtbonus_id` AS `dtbonus_id`,`detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,`detail_terima_bonus`.`dtbonus_produk` AS `dtbonus_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_terima_bonus`.`dtbonus_satuan` AS `dtbonus_satuan`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_bonus`.`dtbonus_jumlah` AS `dtbonus_jumlah` from ((((`detail_terima_bonus` join `master_terima_beli` on((`detail_terima_bonus`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_bonus`.`dtbonus_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_bonus`.`dtbonus_satuan` = `satuan`.`satuan_id`)));

CREATE OR REPLACE VIEW `vu_detail_terima_produk` AS select `master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah`,`detail_terima_beli`.`dterima_id` AS `dterima_id`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan` from ((((`detail_terima_beli` join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_beli`.`dterima_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_beli`.`dterima_satuan` = `satuan`.`satuan_id`)));
