CREATE OR REPLACE VIEW `vu_produk_satuan_default` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_racikan` AS `produk_racikan`,`produk`.`produk_keterangan_resep` AS `produk_keterangan_resep`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_keterangan` AS `produk_keterangan`,`produk`.`produk_saldo_awal` AS `produk_saldo_awal`,`produk`.`produk_nilai_saldo_awal` AS `produk_nilai_saldo_awal` from ((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) where (`satuan_konversi`.`konversi_default` = 1);

--
-- VIEW  `vu_produk_satuan_default`
-- Data: None
--

