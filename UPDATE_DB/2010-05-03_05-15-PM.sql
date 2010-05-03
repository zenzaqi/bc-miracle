CREATE OR REPLACE VIEW `vu_produk_satuan_default` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif`,`produk`.`produk_aktif` AS `produk_aktif` from ((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) where (`satuan_konversi`.`konversi_default` = 1);

