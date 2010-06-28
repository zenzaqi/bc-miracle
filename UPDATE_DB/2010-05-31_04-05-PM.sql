ALTER TABLE detail_pakai_cabin ADD cabin_bukti VARCHAR(30) AFTER `cabin_produk` ;


CREATE OR REPLACE VIEW `vu_detail_koreksi` AS select `master_koreksi_stok`.`koreksi_id` AS `koreksi_id`,`master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,`master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`master_koreksi_stok`.`koreksi_keterangan` AS `koreksi_keterangan`,`master_koreksi_stok`.`koreksi_creator` AS `koreksi_creator`,`detail_koreksi_stok`.`dkoreksi_id` AS `dkoreksi_id`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlawal` AS `dkoreksi_jmlawal`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,`detail_koreksi_stok`.`dkoreksi_jmlsaldo` AS `dkoreksi_jmlsaldo`,`detail_koreksi_stok`.`dkoreksi_ket` AS `dkoreksi_ket` from (`detail_koreksi_stok` join `master_koreksi_stok` on((`master_koreksi_stok`.`koreksi_id` = `detail_koreksi_stok`.`dkoreksi_master`)));

CREATE OR REPLACE VIEW `vu_detail_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`asal`.`gudang_id` AS `gudang_asal_id`,`asal`.`gudang_nama` AS `gudang_asal_nama`,`asal`.`gudang_lokasi` AS `gudang_asala_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`tujuan`.`gudang_id` AS `gudang_tujuan_id`,`tujuan`.`gudang_nama` AS `gudang_tujuan_nama`,`tujuan`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`detail_mutasi`.`dmutasi_satuan` AS `dmutasi_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_nama` AS `produk_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah` from ((((((`detail_mutasi` join `master_mutasi` on((`detail_mutasi`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) join `gudang` `tujuan` on(((_utf8'' = _utf8'') and (`tujuan`.`gudang_id` = `master_mutasi`.`mutasi_tujuan`)))) join `gudang` `asal` on((`asal`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `satuan_konversi` on(((`detail_mutasi`.`dmutasi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_mutasi`.`dmutasi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

CREATE OR REPLACE VIEW `vu_detail_terima_all` AS select `vu_detail_terima_produk`.`dterima_master` AS `master`,`vu_detail_terima_produk`.`produk_id` AS `produk_id`,`vu_detail_terima_produk`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_produk`.`terima_no` AS `no_bukti`,`vu_detail_terima_produk`.`supplier_id` AS `supplier_id`,`vu_detail_terima_produk`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_produk`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_produk`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_produk`.`produk_kode` AS `produk_kode`,`vu_detail_terima_produk`.`produk_nama` AS `produk_nama`,`vu_detail_terima_produk`.`satuan_id` AS `satuan_id`,`vu_detail_terima_produk`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_produk`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_produk`.`dterima_jumlah` AS `jumlah`,`vu_detail_terima_produk`.`harga_satuan` AS `harga_satuan`,`vu_detail_terima_produk`.`diskon` AS `diskon`,`vu_detail_terima_produk`.`diskon_nilai` AS `diskon_nilai`,`vu_detail_terima_produk`.`subtotal` AS `subtotal`,`vu_detail_terima_produk`.`terima_tanggal` AS `tanggal`,_utf8'produk' AS `jenis` from `vu_detail_terima_produk` union select `vu_detail_terima_bonus`.`dtbonus_master` AS `master`,`vu_detail_terima_bonus`.`produk_id` AS `produk_id`,`vu_detail_terima_bonus`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_bonus`.`terima_no` AS `no_bukti`,`vu_detail_terima_bonus`.`supplier_id` AS `supplier_id`,`vu_detail_terima_bonus`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_bonus`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_bonus`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_bonus`.`produk_kode` AS `produk_kode`,`vu_detail_terima_bonus`.`produk_nama` AS `produk_nama`,`vu_detail_terima_bonus`.`satuan_id` AS `satuan_id`,`vu_detail_terima_bonus`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_bonus`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_bonus`.`dtbonus_jumlah` AS `jumlah`,0 AS `harga_satuan`,0 AS `diskon`,0 AS `diskon_nilai`,0 AS `subtotal`,`vu_detail_terima_bonus`.`terima_tanggal` AS `tanggal`,_utf8'bonus' AS `jenis` from `vu_detail_terima_bonus`;