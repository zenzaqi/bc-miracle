-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2010 at 02:23 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6
--

-- --------------------------------------------------------

--
-- Table structure for table `member_setup`
--

DROP TABLE IF EXISTS `member_setup`;

CREATE TABLE IF NOT EXISTS `member_setup` (
  `setmember_id` int(11) NOT NULL auto_increment,
  `setmember_transhari` double NOT NULL,
  `setmember_pointhari` int(11) default NULL,
  `setmember_transbulan` double default NULL,
  `setmember_pointbulan` int(11) default NULL,
  `setmember_periodeaktif` int(11) default NULL,
  `setmember_periodetenggang` int(11) default NULL,
  `setmember_transtenggang` double default NULL,
  `setmember_pointtenggang` int(11) default NULL,
  `setmember_author` varchar(50) default NULL,
  `setmember_date_create` datetime default NULL,
  `setmember_update` varchar(50) default NULL,
  `setmember_date_update` datetime default NULL,
  `setmember_revised` int(11) default NULL,
  PRIMARY KEY  (`setmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `member_setup`
--

INSERT INTO `member_setup` (`setmember_id`, `setmember_transhari`, `setmember_pointhari`, `setmember_transbulan`, `setmember_pointbulan`, `setmember_periodeaktif`, `setmember_periodetenggang`, `setmember_transtenggang`, `setmember_pointtenggang`, `setmember_author`, `setmember_date_create`, `setmember_update`, `setmember_date_update`, `setmember_revised`) VALUES
(1, 200, -1, -1, 360, 90, 500000, 30, 0, NULL, NULL, 'Super Admin', '2010-04-09 12:43:16', NULL);

-- --------------------------------------------------------

CREATE OR REPLACE VIEW `vu_detail_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`asal`.`gudang_id` AS `gudang_asal_id`,`asal`.`gudang_nama` AS `gudang_asal_nama`,`asal`.`gudang_lokasi` AS `gudang_asala_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`tujuan`.`gudang_id` AS `gudang_tujuan_id`,`tujuan`.`gudang_nama` AS `gudang_tujuan_nama`,`tujuan`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`detail_mutasi`.`dmutasi_satuan` AS `dmutasi_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_nama` AS `produk_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah` from ((((((`detail_mutasi` join `master_mutasi` on((`detail_mutasi`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) join `gudang` `tujuan` on(((_utf8'' = _utf8'') and (`tujuan`.`gudang_id` = `master_mutasi`.`mutasi_tujuan`)))) join `gudang` `asal` on((`asal`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `satuan_konversi` on(((`detail_mutasi`.`dmutasi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_mutasi`.`dmutasi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_produk_satuan_default`
--

CREATE OR REPLACE VIEW `vu_produk_satuan_default` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif` from ((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) where (`satuan_konversi`.`konversi_default` = 1);

-- --------------------------------------------------------

--
-- Structure for view `vu_produk_satuan_terkecil`
--

CREATE OR REPLACE VIEW `vu_produk_satuan_terkecil` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif` from ((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) where (`satuan_konversi`.`konversi_nilai` = 1);

--
-- Structure for view `vu_stok_jual_produk`
--

CREATE OR REPLACE VIEW `vu_stok_jual_produk` AS select `master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`detail_jual_produk`.`dproduk_master` AS `dproduk_master`,`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`detail_jual_produk`.`dproduk_jumlah` AS `dproduk_jumlah`,`detail_jual_produk`.`dproduk_harga` AS `dproduk_harga`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,(`detail_jual_produk`.`dproduk_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from ((((`detail_jual_produk` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `detail_jual_produk`.`dproduk_master`))) join `satuan_konversi` on(((`detail_jual_produk`.`dproduk_satuan` = `satuan_konversi`.`konversi_satuan`) and (`detail_jual_produk`.`dproduk_produk` = `satuan_konversi`.`konversi_produk`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_koreksi`
--


CREATE OR REPLACE VIEW `vu_stok_koreksi` AS select `master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,(`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from ((((`detail_koreksi_stok` join `master_koreksi_stok` on((`detail_koreksi_stok`.`dkoreksi_master` = `master_koreksi_stok`.`koreksi_id`))) join `satuan_konversi` on(((`detail_koreksi_stok`.`dkoreksi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_koreksi_stok`.`dkoreksi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on(((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`) and (`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_pakai_cabin`
--

CREATE OR REPLACE VIEW `vu_stok_pakai_cabin` AS select `detail_pakai_cabin`.`cabin_dtrawat` AS `cabin_dtrawat`,`detail_pakai_cabin`.`cabin_rawat` AS `cabin_rawat`,`detail_pakai_cabin`.`cabin_produk` AS `cabin_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`detail_pakai_cabin`.`cabin_satuan` AS `cabin_satuan`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_pakai_cabin`.`cabin_jumlah` AS `cabin_jumlah`,`detail_pakai_cabin`.`cabin_date_create` AS `cabin_date_create`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_pakai_cabin`.`cabin_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from (((`detail_pakai_cabin` join `satuan_konversi` on(((`detail_pakai_cabin`.`cabin_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_pakai_cabin`.`cabin_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_beli`
--

CREATE OR REPLACE VIEW `vu_stok_retur_beli` AS select `master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_retur_beli`.`drbeli_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `satuan_konversi` on(((`satuan_konversi`.`konversi_produk` = `detail_retur_beli`.`drbeli_produk`) and (`detail_retur_beli`.`drbeli_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_paket`
--

CREATE OR REPLACE VIEW `vu_stok_retur_jual_paket` AS select `master_retur_jual_paket`.`rpaket_tanggal` AS `rpaket_tanggal`,`detail_retur_paket_poduk`.`drpaket_id` AS `drpaket_id`,`detail_retur_paket_poduk`.`drpaket_master` AS `drpaket_master`,`detail_retur_paket_poduk`.`drpaket_produk` AS `drpaket_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_paket_poduk`.`drpaket_satuan` AS `drpaket_satuan`,`detail_retur_paket_poduk`.`drpaket_jumlah` AS `drpaket_jumlah`,`detail_retur_paket_poduk`.`drpaket_harga` AS `drpaket_harga`,(`detail_retur_paket_poduk`.`drpaket_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default` from ((((`detail_retur_paket_poduk` join `master_retur_jual_paket` on((`detail_retur_paket_poduk`.`drpaket_master` = `master_retur_jual_paket`.`rpaket_id`))) join `satuan_konversi` on(((`detail_retur_paket_poduk`.`drpaket_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_paket_poduk`.`drpaket_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_produk`
--

CREATE OR REPLACE VIEW `vu_stok_retur_jual_produk` AS select `master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,`detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,`detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,(`detail_retur_jual_produk`.`drproduk_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default` from ((((`detail_retur_jual_produk` join `master_retur_jual_produk` on((`detail_retur_jual_produk`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) join `satuan_konversi` on(((`detail_retur_jual_produk`.`drproduk_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_jual_produk`.`drproduk_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_terima`
--

CREATE OR REPLACE VIEW `vu_stok_terima` AS select `detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan_konversi`.`konversi_id` AS `konversi_id`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_terima_beli`.`dterima_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal` from ((((`detail_terima_beli` join `satuan_konversi` on(((`detail_terima_beli`.`dterima_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_terima_beli`.`dterima_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `produk` on((`detail_terima_beli`.`dterima_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_all`
--

CREATE OR REPLACE VIEW `vu_stok_all` AS select `vu_stok_jual_produk`.`jproduk_tanggal` AS `tanggal`,`vu_stok_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_jual_produk`.`jumlah_konversi` AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_jual_produk` union select `vu_stok_pakai_cabin`.`cabin_date_create` AS `tanggal`,`vu_stok_pakai_cabin`.`produk_id` AS `produk_id`,`vu_stok_pakai_cabin`.`produk_nama` AS `produk_nama`,`vu_stok_pakai_cabin`.`satuan_id` AS `satuan_id`,`vu_stok_pakai_cabin`.`satuan_nama` AS `satuan_nama`,`vu_stok_pakai_cabin`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_pakai_cabin`.`jumlah_konversi` AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_pakai_cabin` union select `vu_stok_retur_beli`.`rbeli_tanggal` AS `tanggal`,`vu_stok_retur_beli`.`produk_id` AS `produk_id`,`vu_stok_retur_beli`.`produk_nama` AS `produk_nama`,`vu_stok_retur_beli`.`satuan_id` AS `satuan_id`,`vu_stok_retur_beli`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_beli`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,`vu_stok_retur_beli`.`jumlah_konversi` AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_beli` union select `vu_stok_retur_jual_paket`.`rpaket_tanggal` AS `tanggal`,`vu_stok_retur_jual_paket`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_paket`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_paket`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_paket`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_paket`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,`vu_stok_retur_jual_paket`.`jumlah_konversi` AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_paket` union select `vu_stok_retur_jual_produk`.`rproduk_tanggal` AS `tanggal`,`vu_stok_retur_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,`vu_stok_retur_jual_produk`.`jumlah_konversi` AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_produk` union select `vu_stok_terima`.`terima_tanggal` AS `tanggal`,`vu_stok_terima`.`produk_id` AS `produk_id`,`vu_stok_terima`.`produk_nama` AS `produk_nama`,`vu_stok_terima`.`satuan_id` AS `satuan_id`,`vu_stok_terima`.`satuan_nama` AS `satuan_nama`,`vu_stok_terima`.`konversi_default` AS `konversi_default`,`vu_stok_terima`.`jumlah_konversi` AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_terima` union select `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,`vu_stok_koreksi`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,`vu_stok_koreksi`.`jumlah_konversi` AS `jumlah_koreksi` from `vu_stok_koreksi`;

-- --------------------------------------------------------

-- Structure for view `vu_stok_all_saldo_tanggal`
--

CREATE OR REPLACE VIEW `vu_stok_all_saldo_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,sum(`vu_stok_all`.`jumlah_cabin`) AS `jumlah_cabin`,sum(`vu_stok_all`.`jumlah_koreksi`) AS `jumlah_koreksi`,((((((sum(`vu_stok_all`.`jumlah_terima`) - sum(`vu_stok_all`.`jumlah_retur_beli`)) - sum(`vu_stok_all`.`jumlah_jual`)) + sum(`vu_stok_all`.`jumlah_retur_produk`)) + sum(`vu_stok_all`.`jumlah_retur_paket`)) - sum(`vu_stok_all`.`jumlah_cabin`)) + sum(`vu_stok_all`.`jumlah_koreksi`)) AS `jumlah_saldo` from (`vu_stok_all` join `vu_produk_satuan_terkecil` on((`vu_stok_all`.`produk_id` = `vu_produk_satuan_terkecil`.`produk_id`))) group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id`,`vu_stok_all`.`produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_all_saldo`
--

CREATE OR REPLACE VIEW `vu_stok_all_saldo` AS select `a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_nama` AS `satuan_nama`,ifnull(sum(`b`.`jumlah_terima`),0) AS `jumlah_terima`,ifnull(sum(`b`.`jumlah_retur_beli`),0) AS `jumlah_retur_beli`,ifnull(sum(`b`.`jumlah_jual`),0) AS `jumlah_jual`,ifnull(sum(`b`.`jumlah_retur_produk`),0) AS `jumlah_retur_produk`,ifnull(sum(`b`.`jumlah_retur_paket`),0) AS `jumlah_retur_paket`,ifnull(sum(`b`.`jumlah_cabin`),0) AS `jumlah_cabin`,ifnull(sum(`b`.`jumlah_koreksi`),0) AS `jumlah_koreksi`,ifnull(sum(`b`.`jumlah_saldo`),0) AS `stok_saldo` from (`vu_produk_satuan_terkecil` `a` left join `vu_stok_all_saldo_tanggal` `b` on((`a`.`produk_id` = `b`.`produk_id`))) group by `a`.`produk_id`;

