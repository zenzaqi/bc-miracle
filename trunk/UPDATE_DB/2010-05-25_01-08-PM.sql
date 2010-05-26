ALTER TABLE `detail_mutasi` CHANGE `dmutasi_jumlah` `dmutasi_jumlah` DOUBLE( 11, 2 ) NULL DEFAULT NULL  

ALTER TABLE `detail_koreksi_stok` CHANGE `dkoreksi_jmlawal` `dkoreksi_jmlawal` DOUBLE( 11, 2 ) NULL DEFAULT NULL
ALTER TABLE `detail_koreksi_stok` CHANGE `dkoreksi_jmlkoreksi` `dkoreksi_jmlawal` DOUBLE( 11, 2 ) NULL DEFAULT NULL  
ALTER TABLE `detail_koreksi_stok` CHANGE `dkoreksi_jmlsaldo` `dkoreksi_jmlawal` DOUBLE( 11, 2 ) NULL DEFAULT NULL 

ALTER TABLE `detail_pakai_cabin` ADD `cabin_stok` DOUBLE( 11, 2 ) NULL DEFAULT NULL  

CREATE OR REPLACE VIEW `vu_stok_pakai_cabin` AS select `detail_pakai_cabin`.`cabin_dtrawat` AS `cabin_dtrawat`,`detail_pakai_cabin`.`cabin_rawat` AS `cabin_rawat`,`detail_pakai_cabin`.`cabin_produk` AS `cabin_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`detail_pakai_cabin`.`cabin_satuan` AS `cabin_satuan`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_pakai_cabin`.`cabin_jumlah` AS `cabin_jumlah`,`detail_pakai_cabin`.`cabin_date_create` AS `cabin_date_create`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_pakai_cabin`.`cabin_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`detail_pakai_cabin`.`cabin_gudang` AS `cabin_gudang`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi` from (((`detail_pakai_cabin` join `satuan_konversi` on(((`detail_pakai_cabin`.`cabin_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_pakai_cabin`.`cabin_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `gudang` on((`detail_pakai_cabin`.`cabin_gudang` = `gudang`.`gudang_id`)));

CREATE OR REPLACE VIEW `vu_stok_mutasi_all` AS select `a`.`mutasi_tanggal` AS `mutasi_tanggal`,`a`.`gudang_asal_id` AS `gudang_id`,`a`.`gudang_asal_nama` AS `gudang_nama`,`a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_kode` AS `satuan_kode`,`a`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,`a`.`jumlah_konversi` AS `jumlah_keluar`,0 AS `jumlah_koreksi`,0 AS `jumlah_pakai` from `vu_stok_mutasi` `a` union select `b`.`mutasi_tanggal` AS `mutasi_tanggal`,`b`.`gudang_tujuan_id` AS `gudang_id`,`b`.`gudang_tujuan_nama` AS `gudang_nama`,`b`.`produk_id` AS `produk_id`,`b`.`produk_kode` AS `produk_kode`,`b`.`produk_nama` AS `produk_nama`,`b`.`satuan_id` AS `satuan_id`,`b`.`satuan_kode` AS `satuan_kode`,`b`.`satuan_nama` AS `satuan_nama`,`b`.`jumlah_konversi` AS `jumlah_masuk`,0 AS `jumlah_keluar`,0 AS `jumlah_koreksi`,0 AS `jumlah_pakai` from `vu_stok_mutasi` `b` union select `c`.`koreksi_tanggal` AS `mutasi_tanggal`,`c`.`gudang_id` AS `gudang_id`,`c`.`gudang_nama` AS `gudang_nama`,`c`.`produk_id` AS `produk_id`,`c`.`produk_kode` AS `produk_kode`,`c`.`produk_nama` AS `produk_nama`,`c`.`satuan_id` AS `satuan_id`,`c`.`satuan_kode` AS `satuan_kode`,`c`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,0 AS `jumlah_keluar`,`c`.`jumlah_konversi` AS `jumlah_koreksi`,0 AS `jumlah_pakai` from `vu_stok_koreksi` `c` union select date_format(`d`.`cabin_date_create`,_utf8'%Y-%m-%d') AS `mutasi_tanggal`,`d`.`gudang_id` AS `gudang_id`,`d`.`gudang_nama` AS `gudang_nama`,`d`.`produk_id` AS `produk_id`,`d`.`produk_kode` AS `produk_kode`,`d`.`produk_nama` AS `produk_nama`,`d`.`satuan_id` AS `satuan_id`,`d`.`satuan_kode` AS `satuan_kode`,`d`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,0 AS `jumlah_keluar`,0 AS `jumlah_koreksi`,`d`.`jumlah_konversi` AS `jumlah_pakai` from `vu_stok_pakai_cabin` `d`;

CREATE OR REPLACE VIEW `vu_stok_koreksi` AS select `master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,(`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi` from ((((`detail_koreksi_stok` join `master_koreksi_stok` on((`detail_koreksi_stok`.`dkoreksi_master` = `master_koreksi_stok`.`koreksi_id`))) join `satuan_konversi` on(((`detail_koreksi_stok`.`dkoreksi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_koreksi_stok`.`dkoreksi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `gudang` on((`master_koreksi_stok`.`koreksi_gudang` = `gudang`.`gudang_id`)));

CREATE OR REPLACE VIEW `vu_stok_gudang_besar_tanggal` AS select distinct `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` where ((`vu_stok_all`.`jumlah_terima` > 0) or (`vu_stok_all`.`jumlah_retur_beli` > 0)) group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id` union select distinct `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 1) group by `vu_stok_mutasi_all`.`mutasi_tanggal`,`vu_stok_mutasi_all`.`produk_id` union select distinct `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 1) group by `vu_stok_koreksi`.`koreksi_tanggal`,`vu_stok_koreksi`.`produk_id`;

CREATE OR REPLACE VIEW `vu_stok_gudang_produk_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id`,`vu_stok_all`.`produk_kode`,`vu_stok_all`.`produk_nama`,`vu_stok_all`.`satuan_kode`,`vu_stok_all`.`satuan_nama`,`vu_stok_all`.`satuan_id` union select `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 2) group by `vu_stok_mutasi_all`.`mutasi_tanggal`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`,`vu_stok_mutasi_all`.`satuan_id` union select `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 2) group by `vu_stok_koreksi`.`koreksi_tanggal`,`vu_stok_koreksi`.`produk_id`,`vu_stok_koreksi`.`produk_kode`,`vu_stok_koreksi`.`produk_nama`,`vu_stok_koreksi`.`satuan_kode`,`vu_stok_koreksi`.`satuan_nama`,`vu_stok_koreksi`.`satuan_id`;

CREATE OR REPLACE VIEW `vu_stok_gudang_all` AS select `vu_stok_mutasi_all`.`gudang_id` AS `gudang_id`,`vu_stok_mutasi_all`.`gudang_nama` AS `gudang_nama`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,(((sum(`vu_stok_mutasi_all`.`jumlah_masuk`) - sum(`vu_stok_mutasi_all`.`jumlah_keluar`)) + sum(`vu_stok_mutasi_all`.`jumlah_koreksi`)) - sum(`vu_stok_mutasi_all`.`jumlah_pakai`)) AS `jumlah_stok` from `vu_stok_mutasi_all` group by `vu_stok_mutasi_all`.`gudang_id`,`vu_stok_mutasi_all`.`gudang_nama`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`;

