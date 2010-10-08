ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_stok_mutasi` AS 
select `vu_detail_mutasi`.`mutasi_id` AS `mutasi_id`,`vu_detail_mutasi`.`mutasi_asal` AS `mutasi_asal`,`vu_detail_mutasi`.`gudang_asal_id` AS `gudang_asal_id`,`vu_detail_mutasi`.`gudang_asal_nama` AS `gudang_asal_nama`,`vu_detail_mutasi`.`gudang_asal_lokasi` AS `gudang_asal_lokasi`,`vu_detail_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`vu_detail_mutasi`.`gudang_tujuan_id` AS `gudang_tujuan_id`,`vu_detail_mutasi`.`gudang_tujuan_nama` AS `gudang_tujuan_nama`,`vu_detail_mutasi`.`gudang_tujuan_lokasi` AS `gudang_tujuan_lokasi`,`vu_detail_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`vu_detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`konversi_produk` AS `konversi_produk`,`vu_produk_satuan_terkecil`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_satuan_terkecil`.`konversi_nilai` AS `konversi_nilai`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah`,(`vu_detail_mutasi`.`dmutasi_jumlah` * `vu_produk_satuan_terkecil`.`konversi_nilai`) AS `jumlah_konversi` from (`vu_detail_mutasi` join `vu_produk_satuan_terkecil` on((`vu_detail_mutasi`.`dmutasi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) ;
