CREATE OR REPLACE VIEW `vu_trans_terima` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,`vu_total_terima_bonus_group`.`jumlah_barang_bonus` AS `jumlah_barang_bonus`,`vu_total_terima_group`.`jumlah_barang` AS `jumlah_barang` from ((((`master_terima_beli` join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `master_order_beli` on((`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`))) left join `vu_total_terima_bonus_group` on((`vu_total_terima_bonus_group`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `vu_total_terima_group` on((`vu_total_terima_group`.`dterima_master` = `master_terima_beli`.`terima_id`)));