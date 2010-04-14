-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2010 at 01:09 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6


--
-- Database: `miracledb_test`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_detail_mutasi`
--

--
-- Structure for view `vu_detail_mutasi`
--

CREATE OR REPLACE VIEW `vu_detail_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`asal`.`gudang_id` AS `gudang_asal_id`,`asal`.`gudang_nama` AS `gudang_asal_nama`,`asal`.`gudang_lokasi` AS `gudang_asala_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`tujuan`.`gudang_id` AS `gudang_tujuan_id`,`tujuan`.`gudang_nama` AS `gudang_tujuan_nama`,`tujuan`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`detail_mutasi`.`dmutasi_satuan` AS `dmutasi_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_nama` AS `produk_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah` from ((((((`detail_mutasi` join `master_mutasi` on((`detail_mutasi`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) join `gudang` `tujuan` on(((_utf8'' = _utf8'') and (`tujuan`.`gudang_id` = `master_mutasi`.`mutasi_tujuan`)))) join `gudang` `asal` on((`asal`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `satuan_konversi` on(((`detail_mutasi`.`dmutasi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_mutasi`.`dmutasi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

-- --------------------------------------------------------
--
-- Structure for view `vu_total_mutasi_group`
--
DROP TABLE IF EXISTS `vu_total_mutasi_group`;

CREATE OR REPLACE VIEW `vu_total_mutasi_group` AS select `detail_mutasi`.`dmutasi_master` AS `dmutasi_master`,sum(`detail_mutasi`.`dmutasi_jumlah`) AS `jumlah_barang` from `detail_mutasi` group by `detail_mutasi`.`dmutasi_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_mutasi`
--
DROP TABLE IF EXISTS `vu_trans_mutasi`;

CREATE OR REPLACE VIEW `vu_trans_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`gudang_tujuan`.`gudang_nama` AS `gudang_asal_nama`,`gudang_tujuan`.`gudang_lokasi` AS `gudang_asal_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`gudang_asal`.`gudang_nama` AS `gudang_tujuan_nama`,`gudang_asal`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_total_mutasi_group`.`jumlah_barang` AS `jumlah_barang`,`master_mutasi`.`mutasi_keterangan` AS `mutasi_keterangan`,`master_mutasi`.`mutasi_creator` AS `mutasi_creator`,`master_mutasi`.`mutasi_date_create` AS `mutasi_date_create`,`master_mutasi`.`mutasi_update` AS `mutasi_update`,`master_mutasi`.`mutasi_date_update` AS `mutasi_date_update`,`master_mutasi`.`mutasi_revised` AS `mutasi_revised` from (((`master_mutasi` join `gudang` `gudang_asal` on(((_utf8'' = _utf8'') and (`master_mutasi`.`mutasi_tujuan` = `gudang_asal`.`gudang_id`)))) join `gudang` `gudang_tujuan` on((`gudang_tujuan`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `vu_total_mutasi_group` on((`vu_total_mutasi_group`.`dmutasi_master` = `master_mutasi`.`mutasi_id`)));
-- --------------------------------------------------------

--
-- Structure for view `vu_stok_koreksi`
--
DROP TABLE IF EXISTS `vu_stok_koreksi`;

CREATE OR REPLACE VIEW `vu_stok_koreksi` AS select `master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,(`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from ((((`detail_koreksi_stok` join `master_koreksi_stok` on((`detail_koreksi_stok`.`dkoreksi_master` = `master_koreksi_stok`.`koreksi_id`))) join `satuan_konversi` on(((`detail_koreksi_stok`.`dkoreksi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_koreksi_stok`.`dkoreksi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on(((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`) and (`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))));

-- --------------------------------------------------------------
--
-- Structure for view `vu_stok_all`
--
DROP TABLE IF EXISTS `vu_stok_all`;

CREATE OR REPLACE VIEW `vu_stok_all` AS select `vu_stok_jual_produk`.`jproduk_tanggal` AS `tanggal`,`vu_stok_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_jual_produk`.`produk_kode` AS `produk_kode`,`vu_stok_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_jual_produk`.`satuan_kode` AS `satuan_kode`,`vu_stok_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_jual_produk`.`jumlah_konversi` AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_jual_produk` union select `vu_stok_pakai_cabin`.`cabin_date_create` AS `tanggal`,`vu_stok_pakai_cabin`.`produk_id` AS `produk_id`,`vu_stok_pakai_cabin`.`produk_kode` AS `produk_kode`,`vu_stok_pakai_cabin`.`produk_nama` AS `produk_nama`,`vu_stok_pakai_cabin`.`satuan_id` AS `satuan_id`,`vu_stok_pakai_cabin`.`satuan_kode` AS `satuan_kode`,`vu_stok_pakai_cabin`.`satuan_nama` AS `satuan_nama`,`vu_stok_pakai_cabin`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_pakai_cabin`.`jumlah_konversi` AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_pakai_cabin` union select `vu_stok_retur_beli`.`rbeli_tanggal` AS `tanggal`,`vu_stok_retur_beli`.`produk_id` AS `produk_id`,`vu_stok_retur_beli`.`produk_kode` AS `produk_kode`,`vu_stok_retur_beli`.`produk_nama` AS `produk_nama`,`vu_stok_retur_beli`.`satuan_id` AS `satuan_id`,`vu_stok_retur_beli`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_beli`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_beli`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,`vu_stok_retur_beli`.`jumlah_konversi` AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_beli` union select `vu_stok_retur_jual_paket`.`rpaket_tanggal` AS `tanggal`,`vu_stok_retur_jual_paket`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_paket`.`produk_kode` AS `produk_kode`,`vu_stok_retur_jual_paket`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_paket`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_paket`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_jual_paket`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_paket`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,`vu_stok_retur_jual_paket`.`jumlah_konversi` AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_paket` union select `vu_stok_retur_jual_produk`.`rproduk_tanggal` AS `tanggal`,`vu_stok_retur_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_produk`.`produk_kode` AS `produk_kode`,`vu_stok_retur_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_produk`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,`vu_stok_retur_jual_produk`.`jumlah_konversi` AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_produk` union select `vu_stok_terima`.`terima_tanggal` AS `tanggal`,`vu_stok_terima`.`produk_id` AS `produk_id`,`vu_stok_terima`.`produk_kode` AS `produk_kode`,`vu_stok_terima`.`produk_nama` AS `produk_nama`,`vu_stok_terima`.`satuan_id` AS `satuan_id`,`vu_stok_terima`.`satuan_kode` AS `satuan_kode`,`vu_stok_terima`.`satuan_nama` AS `satuan_nama`,`vu_stok_terima`.`konversi_default` AS `konversi_default`,`vu_stok_terima`.`jumlah_konversi` AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_terima` union select `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,`vu_stok_koreksi`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,`vu_stok_koreksi`.`jumlah_konversi` AS `jumlah_koreksi` from `vu_stok_koreksi`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_all_saldo_tanggal`
--
DROP TABLE IF EXISTS `vu_stok_all_saldo_tanggal`;

CREATE OR REPLACE VIEW `vu_stok_all_saldo_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,sum(`vu_stok_all`.`jumlah_cabin`) AS `jumlah_cabin`,sum(`vu_stok_all`.`jumlah_koreksi`) AS `jumlah_koreksi`,((((((sum(`vu_stok_all`.`jumlah_terima`) - sum(`vu_stok_all`.`jumlah_retur_beli`)) - sum(`vu_stok_all`.`jumlah_jual`)) + sum(`vu_stok_all`.`jumlah_retur_produk`)) + sum(`vu_stok_all`.`jumlah_retur_paket`)) - sum(`vu_stok_all`.`jumlah_cabin`)) + sum(`vu_stok_all`.`jumlah_koreksi`)) AS `jumlah_saldo` from (`vu_stok_all` join `vu_produk_satuan_terkecil` on((`vu_stok_all`.`produk_id` = `vu_produk_satuan_terkecil`.`produk_id`))) group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id`,`vu_stok_all`.`produk_nama`,`vu_produk_satuan_terkecil`.`satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_all_saldo`
--
DROP TABLE IF EXISTS `vu_stok_all_saldo`;

CREATE OR REPLACE VIEW `vu_stok_all_saldo` AS select `a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_nama` AS `satuan_nama`,ifnull(sum(`b`.`jumlah_terima`),0) AS `jumlah_terima`,ifnull(sum(`b`.`jumlah_retur_beli`),0) AS `jumlah_retur_beli`,ifnull(sum(`b`.`jumlah_jual`),0) AS `jumlah_jual`,ifnull(sum(`b`.`jumlah_retur_produk`),0) AS `jumlah_retur_produk`,ifnull(sum(`b`.`jumlah_retur_paket`),0) AS `jumlah_retur_paket`,ifnull(sum(`b`.`jumlah_cabin`),0) AS `jumlah_cabin`,ifnull(sum(`b`.`jumlah_koreksi`),0) AS `jumlah_koreksi`,ifnull(sum(`b`.`jumlah_saldo`),0) AS `stok_saldo` from (`vu_produk_satuan_terkecil` `a` left join `vu_stok_all_saldo_tanggal` `b` on((`a`.`produk_id` = `b`.`produk_id`))) group by `a`.`produk_id`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_mutasi`
--
DROP TABLE IF EXISTS `vu_stok_mutasi`;

CREATE OR REPLACE VIEW `vu_stok_mutasi` AS select `vu_detail_mutasi`.`mutasi_id` AS `mutasi_id`,`vu_detail_mutasi`.`mutasi_asal` AS `mutasi_asal`,`vu_detail_mutasi`.`gudang_asal_id` AS `gudang_asal_id`,`vu_detail_mutasi`.`gudang_asal_nama` AS `gudang_asal_nama`,`vu_detail_mutasi`.`gudang_asala_lokasi` AS `gudang_asala_lokasi`,`vu_detail_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`vu_detail_mutasi`.`gudang_tujuan_id` AS `gudang_tujuan_id`,`vu_detail_mutasi`.`gudang_tujuan_nama` AS `gudang_tujuan_nama`,`vu_detail_mutasi`.`gudang_tujuan_lokasi` AS `gudang_tujuan_lokasi`,`vu_detail_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`vu_detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`konversi_produk` AS `konversi_produk`,`vu_produk_satuan_terkecil`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_satuan_terkecil`.`konversi_nilai` AS `konversi_nilai`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah`,(`vu_detail_mutasi`.`dmutasi_jumlah` * `vu_produk_satuan_terkecil`.`konversi_nilai`) AS `jumlah_konversi` from (`vu_detail_mutasi` join `vu_produk_satuan_terkecil` on((`vu_detail_mutasi`.`dmutasi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) where (`vu_produk_satuan_terkecil`.`konversi_nilai` = 1);

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_mutasi_all`
--
DROP TABLE IF EXISTS `vu_stok_mutasi_all`;

CREATE OR REPLACE VIEW `vu_stok_mutasi_all` AS select `a`.`mutasi_tanggal` AS `mutasi_tanggal`,`a`.`gudang_asal_id` AS `gudang_id`,`a`.`gudang_asal_nama` AS `gudang_nama`,`a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_kode` AS `satuan_kode`,`a`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,`a`.`jumlah_konversi` AS `jumlah_keluar` from `vu_stok_mutasi` `a` union select `b`.`mutasi_tanggal` AS `mutasi_tanggal`,`b`.`gudang_tujuan_id` AS `gudang_id`,`b`.`gudang_tujuan_nama` AS `gudang_nama`,`b`.`produk_id` AS `produk_id`,`b`.`produk_kode` AS `produk_kode`,`b`.`produk_nama` AS `produk_nama`,`b`.`satuan_id` AS `satuan_id`,`b`.`satuan_kode` AS `satuan_kode`,`b`.`satuan_nama` AS `satuan_nama`,`b`.`jumlah_konversi` AS `jumlah_masuk`,0 AS `jumlah_keluar` from `vu_stok_mutasi` `b`;


-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_all`
--
DROP TABLE IF EXISTS `vu_stok_gudang_all`;

CREATE OR REPLACE VIEW `vu_stok_gudang_all` AS select `vu_stok_mutasi_all`.`gudang_id` AS `gudang_id`,`vu_stok_mutasi_all`.`gudang_nama` AS `gudang_nama`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,(sum(`vu_stok_mutasi_all`.`jumlah_masuk`) - sum(`vu_stok_mutasi_all`.`jumlah_keluar`)) AS `jumlah_stok` from `vu_stok_mutasi_all` group by `vu_stok_mutasi_all`.`gudang_id`,`vu_stok_mutasi_all`.`gudang_nama`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_gudang_besar_tanggal`
--
DROP TABLE IF EXISTS `vu_stok_gudang_besar_tanggal`;

CREATE OR REPLACE VIEW `vu_stok_gudang_besar_tanggal` AS select distinct `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` where ((`vu_stok_all`.`jumlah_terima` > 0) or (`vu_stok_all`.`jumlah_retur_beli` > 0)) group by `vu_stok_all`.`tanggal` union select distinct `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 1) group by `vu_stok_mutasi_all`.`mutasi_tanggal` union select distinct `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 1) group by `vu_stok_koreksi`.`koreksi_tanggal`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_besar_saldo`
--
DROP TABLE IF EXISTS `vu_stok_gudang_besar_saldo`;

CREATE OR REPLACE VIEW `vu_stok_gudang_besar_saldo` AS select `vu_stok_gudang_besar_tanggal`.`produk_id` AS `produk_id`,`vu_stok_gudang_besar_tanggal`.`produk_kode` AS `produk_kode`,`vu_stok_gudang_besar_tanggal`.`produk_nama` AS `produk_nama`,`vu_stok_gudang_besar_tanggal`.`satuan_id` AS `satuan_id`,`vu_stok_gudang_besar_tanggal`.`satuan_kode` AS `satuan_kode`,`vu_stok_gudang_besar_tanggal`.`satuan_nama` AS `satuan_nama`,((((sum(`vu_stok_gudang_besar_tanggal`.`jumlah_terima`) - sum(`vu_stok_gudang_besar_tanggal`.`jumlah_retur_beli`)) - sum(`vu_stok_gudang_besar_tanggal`.`jumlah_keluar`)) + sum(`vu_stok_gudang_besar_tanggal`.`jumlah_masuk`)) + sum(`vu_stok_gudang_besar_tanggal`.`jumlah_koreksi`)) AS `jumlah_stok` from `vu_stok_gudang_besar_tanggal` group by `vu_stok_gudang_besar_tanggal`.`produk_kode`,`vu_stok_gudang_besar_tanggal`.`produk_nama`,`vu_stok_gudang_besar_tanggal`.`satuan_id`,`vu_stok_gudang_besar_tanggal`.`satuan_kode`,`vu_stok_gudang_besar_tanggal`.`satuan_nama`;
-- --------------------------------------------------------

--
-- Structure for view `vu_stok_jual_produk`
--
DROP TABLE IF EXISTS `vu_stok_jual_produk`;

CREATE OR REPLACE VIEW `vu_stok_jual_produk` AS select `master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`detail_jual_produk`.`dproduk_master` AS `dproduk_master`,`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`detail_jual_produk`.`dproduk_jumlah` AS `dproduk_jumlah`,`detail_jual_produk`.`dproduk_harga` AS `dproduk_harga`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,(`detail_jual_produk`.`dproduk_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from ((((`detail_jual_produk` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `detail_jual_produk`.`dproduk_master`))) join `satuan_konversi` on(((`detail_jual_produk`.`dproduk_satuan` = `satuan_konversi`.`konversi_satuan`) and (`detail_jual_produk`.`dproduk_produk` = `satuan_konversi`.`konversi_produk`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_pakai_cabin`
--
DROP TABLE IF EXISTS `vu_stok_pakai_cabin`;

CREATE OR REPLACE VIEW `vu_stok_pakai_cabin` AS select `detail_pakai_cabin`.`cabin_dtrawat` AS `cabin_dtrawat`,`detail_pakai_cabin`.`cabin_rawat` AS `cabin_rawat`,`detail_pakai_cabin`.`cabin_produk` AS `cabin_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`detail_pakai_cabin`.`cabin_satuan` AS `cabin_satuan`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_pakai_cabin`.`cabin_jumlah` AS `cabin_jumlah`,`detail_pakai_cabin`.`cabin_date_create` AS `cabin_date_create`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_pakai_cabin`.`cabin_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from (((`detail_pakai_cabin` join `satuan_konversi` on(((`detail_pakai_cabin`.`cabin_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_pakai_cabin`.`cabin_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_beli`
--
DROP TABLE IF EXISTS `vu_stok_retur_beli`;

CREATE OR REPLACE VIEW `vu_stok_retur_beli` AS select `master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_retur_beli`.`drbeli_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `satuan_konversi` on(((`satuan_konversi`.`konversi_produk` = `detail_retur_beli`.`drbeli_produk`) and (`detail_retur_beli`.`drbeli_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_paket`
--
DROP TABLE IF EXISTS `vu_stok_retur_jual_paket`;

CREATE OR REPLACE VIEW `vu_stok_retur_jual_paket` AS select `master_retur_jual_paket`.`rpaket_tanggal` AS `rpaket_tanggal`,`detail_retur_paket_poduk`.`drpaket_id` AS `drpaket_id`,`detail_retur_paket_poduk`.`drpaket_master` AS `drpaket_master`,`detail_retur_paket_poduk`.`drpaket_produk` AS `drpaket_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_paket_poduk`.`drpaket_satuan` AS `drpaket_satuan`,`detail_retur_paket_poduk`.`drpaket_jumlah` AS `drpaket_jumlah`,`detail_retur_paket_poduk`.`drpaket_harga` AS `drpaket_harga`,(`detail_retur_paket_poduk`.`drpaket_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default` from ((((`detail_retur_paket_poduk` join `master_retur_jual_paket` on((`detail_retur_paket_poduk`.`drpaket_master` = `master_retur_jual_paket`.`rpaket_id`))) join `satuan_konversi` on(((`detail_retur_paket_poduk`.`drpaket_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_paket_poduk`.`drpaket_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_produk`
--
DROP TABLE IF EXISTS `vu_stok_retur_jual_produk`;

CREATE OR REPLACE VIEW `vu_stok_retur_jual_produk` AS select `master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,`detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,`detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,(`detail_retur_jual_produk`.`drproduk_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default` from ((((`detail_retur_jual_produk` join `master_retur_jual_produk` on((`detail_retur_jual_produk`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) join `satuan_konversi` on(((`detail_retur_jual_produk`.`drproduk_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_jual_produk`.`drproduk_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_terima`
--
DROP TABLE IF EXISTS `vu_stok_terima`;

CREATE OR REPLACE VIEW `vu_stok_terima` AS select `detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_id` AS `konversi_id`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_terima_beli`.`dterima_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal` from ((((`detail_terima_beli` join `satuan_konversi` on(((`detail_terima_beli`.`dterima_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_terima_beli`.`dterima_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`detail_terima_beli`.`dterima_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`)));

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_gudang_produk_tanggal`
--
DROP TABLE IF EXISTS `vu_stok_gudang_produk_tanggal`;

CREATE OR REPLACE VIEW `vu_stok_gudang_produk_tanggal` AS select distinct `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` where ((`vu_stok_all`.`jumlah_jual` > 0) or (`vu_stok_all`.`jumlah_retur_produk` > 0) or (`vu_stok_all`.`jumlah_retur_paket` > 0)) group by `vu_stok_all`.`tanggal` union select distinct `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 2) group by `vu_stok_mutasi_all`.`mutasi_tanggal` union select distinct `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 2) group by `vu_stok_koreksi`.`koreksi_tanggal`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_gudang_produk_saldo`
--
DROP TABLE IF EXISTS `vu_stok_gudang_produk_saldo`;

CREATE OR REPLACE VIEW `vu_stok_gudang_produk_saldo` AS select `vu_stok_gudang_produk_tanggal`.`produk_id` AS `produk_id`,`vu_stok_gudang_produk_tanggal`.`produk_kode` AS `produk_kode`,`vu_stok_gudang_produk_tanggal`.`produk_nama` AS `produk_nama`,`vu_stok_gudang_produk_tanggal`.`satuan_id` AS `satuan_id`,`vu_stok_gudang_produk_tanggal`.`satuan_kode` AS `satuan_kode`,`vu_stok_gudang_produk_tanggal`.`satuan_nama` AS `satuan_nama`,(((((sum(`vu_stok_gudang_produk_tanggal`.`jumlah_retur_produk`) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_retur_paket`)) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_keluar`)) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_masuk`)) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_koreksi`)) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_jual`)) AS `jumlah_stok` from `vu_stok_gudang_produk_tanggal` group by `vu_stok_gudang_produk_tanggal`.`produk_kode`,`vu_stok_gudang_produk_tanggal`.`produk_nama`,`vu_stok_gudang_produk_tanggal`.`satuan_id`,`vu_stok_gudang_produk_tanggal`.`satuan_kode`,`vu_stok_gudang_produk_tanggal`.`satuan_nama`;

-- --------------------------------------------------------
