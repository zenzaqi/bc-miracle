-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2010 at 10:15 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6
--
-- Database: `miracledb_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `akun_id` smallint(6) NOT NULL auto_increment,
  `akun_kode` varchar(25) NOT NULL,
  `akun_jenis` enum('Hutang','Biaya','Pendapatan','Modal','Aktiva') NOT NULL default 'Aktiva',
  `akun_parent` smallint(6) default NULL,
  `akun_level` smallint(6) default NULL,
  `akun_nama` varchar(255) NOT NULL,
  `akun_debet` double default NULL,
  `akun_kredit` double default NULL,
  `akun_saldo` double default NULL,
  `akun_aktif` enum('T','Y') default 'Y',
  `akun_creator` varchar(50) default NULL,
  `akun_date_create` datetime default NULL,
  `akun_update` varchar(50) default NULL,
  `akun_date_update` datetime default NULL,
  `akun_revised` smallint(6) default NULL,
  PRIMARY KEY  (`akun_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

CREATE OR REPLACE VIEW `vu_akun` AS select `akun`.`akun_id` AS `akun_id`,`akun`.`akun_kode` AS `akun_kode`,`akun`.`akun_jenis` AS `akun_jenis`,`akun`.`akun_parent` AS `akun_parent`,`akun_parent`.`akun_id` AS `parent_d`,`akun_parent`.`akun_kode` AS `parent_kode`,`akun_parent`.`akun_jenis` AS `parent_jenis`,`akun_parent`.`akun_nama` AS `parent_nama`,`akun_parent`.`akun_level` AS `parent_level`,`akun`.`akun_level` AS `akun_level`,`akun`.`akun_nama` AS `akun_nama`,`akun`.`akun_debet` AS `akun_debet`,`akun`.`akun_kredit` AS `akun_kredit`,`akun`.`akun_saldo` AS `akun_saldo`,`akun`.`akun_aktif` AS `akun_aktif`,`akun`.`akun_creator` AS `akun_creator`,`akun`.`akun_date_create` AS `akun_date_create`,`akun`.`akun_update` AS `akun_update`,`akun`.`akun_date_update` AS `akun_date_update` from (`akun` left join `akun` `akun_parent` on((`akun`.`akun_parent` = `akun_parent`.`akun_id`)));

--
-- Structure for view `vu_detail_invoice`
--
DROP TABLE IF EXISTS `vu_detail_invoice`;

CREATE OR REPLACE VIEW `vu_detail_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`satuan`.`satuan_id` AS `satuan_id`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`jenis_nama` AS `jenis_nama`,((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) AS `subtotal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_email` AS `supplier_email` from (((((`detail_invoice` join `master_invoice` on((`detail_invoice`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_produk` on((`detail_invoice`.`dinvoice_produk` = `vu_produk`.`produk_id`))) join `master_terima_beli` on((`master_invoice`.`invoice_noterima` = `master_terima_beli`.`terima_id`))) join `satuan` on((`detail_invoice`.`dinvoice_satuan` = `satuan`.`satuan_id`))) join `supplier` on((`supplier`.`supplier_id` = `master_terima_beli`.`terima_supplier`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_invoice_konversi`
--
DROP TABLE IF EXISTS `vu_detail_invoice_konversi`;

CREATE OR REPLACE VIEW `vu_detail_invoice_konversi` AS select `detail_invoice`.`dinvoice_id` AS `dinvoice_id`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,(`satuan_konversi`.`konversi_nilai` * `detail_invoice`.`dinvoice_jumlah`) AS `jumlah_konversi`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,(`detail_invoice`.`dinvoice_harga` / `satuan_konversi`.`konversi_nilai`) AS `harga_satuan_konversi`,(((`detail_invoice`.`dinvoice_harga` / `satuan_konversi`.`konversi_nilai`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100) AS `hraga_satuan_konversi_bersih`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`satuan_konversi`.`konversi_default` AS `konversi_default` from (`satuan_konversi` join `detail_invoice` on(((`detail_invoice`.`dinvoice_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_invoice`.`dinvoice_satuan` = `satuan_konversi`.`konversi_satuan`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_mutasi`
--
DROP TABLE IF EXISTS `vu_detail_mutasi`;

CREATE OR REPLACE VIEW `vu_detail_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`asal`.`gudang_id` AS `gudang_asal_id`,`asal`.`gudang_nama` AS `gudang_asal_nama`,`asal`.`gudang_lokasi` AS `gudang_asala_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`tujuan`.`gudang_id` AS `gudang_tujuan_id`,`tujuan`.`gudang_nama` AS `gudang_tujuan_nama`,`tujuan`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`detail_mutasi`.`dmutasi_satuan` AS `dmutasi_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_nama` AS `produk_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah` from ((((((`detail_mutasi` join `master_mutasi` on((`detail_mutasi`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) join `gudang` `tujuan` on(((_utf8'' = _utf8'') and (`tujuan`.`gudang_id` = `master_mutasi`.`mutasi_tujuan`)))) join `gudang` `asal` on((`asal`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `satuan_konversi` on(((`detail_mutasi`.`dmutasi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_mutasi`.`dmutasi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_mutasi_group`
--

CREATE OR REPLACE VIEW `vu_total_mutasi_group` AS select `detail_mutasi`.`dmutasi_master` AS `dmutasi_master`,sum(`detail_mutasi`.`dmutasi_jumlah`) AS `jumlah_barang` from `detail_mutasi` group by `detail_mutasi`.`dmutasi_master`;

--


--
-- Structure for view `vu_trans_mutasi`
--
DROP TABLE IF EXISTS `vu_trans_mutasi`;

CREATE OR REPLACE VIEW `vu_trans_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`gudang_tujuan`.`gudang_nama` AS `gudang_asal_nama`,`gudang_tujuan`.`gudang_lokasi` AS `gudang_asal_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`gudang_asal`.`gudang_nama` AS `gudang_tujuan_nama`,`gudang_asal`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_total_mutasi_group`.`jumlah_barang` AS `jumlah_barang`,`master_mutasi`.`mutasi_keterangan` AS `mutasi_keterangan`,`master_mutasi`.`mutasi_creator` AS `mutasi_creator`,`master_mutasi`.`mutasi_date_create` AS `mutasi_date_create`,`master_mutasi`.`mutasi_update` AS `mutasi_update`,`master_mutasi`.`mutasi_date_update` AS `mutasi_date_update`,`master_mutasi`.`mutasi_revised` AS `mutasi_revised` from (((`master_mutasi` join `gudang` `gudang_asal` on(((_utf8'' = _utf8'') and (`master_mutasi`.`mutasi_tujuan` = `gudang_asal`.`gudang_id`)))) join `gudang` `gudang_tujuan` on((`gudang_tujuan`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `vu_total_mutasi_group` on((`vu_total_mutasi_group`.`dmutasi_master` = `master_mutasi`.`mutasi_id`)));



--
-- Structure for view `vu_stok_jual_produk`
--
DROP TABLE IF EXISTS `vu_stok_jual_produk`;

CREATE OR REPLACE VIEW `vu_stok_jual_produk` AS select `master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,sum(`detail_jual_produk`.`dproduk_jumlah`) AS `dproduk_jumlah`,`detail_jual_produk`.`dproduk_harga` AS `dproduk_harga`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,sum((`detail_jual_produk`.`dproduk_jumlah` * `satuan_konversi`.`konversi_nilai`)) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`konversi_produk` AS `konversi_produk`,`vu_produk_satuan_terkecil`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif` AS `satuan_aktif`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`satuan_konversi`.`konversi_default` AS `konversi_default` from (((`detail_jual_produk` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `detail_jual_produk`.`dproduk_master`))) join `satuan_konversi` on(((`detail_jual_produk`.`dproduk_satuan` = `satuan_konversi`.`konversi_satuan`) and (`detail_jual_produk`.`dproduk_produk` = `satuan_konversi`.`konversi_produk`)))) join `vu_produk_satuan_terkecil` on((`detail_jual_produk`.`dproduk_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) group by `master_jual_produk`.`jproduk_tanggal`,`detail_jual_produk`.`dproduk_satuan`,`detail_jual_produk`.`dproduk_harga`,`satuan_konversi`.`konversi_nilai`,`vu_produk_satuan_terkecil`.`produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point`,`vu_produk_satuan_terkecil`.`konversi_satuan`,`vu_produk_satuan_terkecil`.`satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif`,`vu_produk_satuan_terkecil`.`produk_id`,`satuan_konversi`.`konversi_default`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_koreksi`
--
DROP TABLE IF EXISTS `vu_stok_koreksi`;

CREATE OR REPLACE VIEW `vu_stok_koreksi` AS select `master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,(`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi` from ((((`detail_koreksi_stok` join `master_koreksi_stok` on((`detail_koreksi_stok`.`dkoreksi_master` = `master_koreksi_stok`.`koreksi_id`))) join `satuan_konversi` on(((`detail_koreksi_stok`.`dkoreksi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_koreksi_stok`.`dkoreksi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `gudang` on((`master_koreksi_stok`.`koreksi_gudang` = `gudang`.`gudang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_mutasi`
--
DROP TABLE IF EXISTS `vu_stok_mutasi`;

CREATE OR REPLACE VIEW `vu_stok_mutasi` AS select `vu_detail_mutasi`.`mutasi_id` AS `mutasi_id`,`vu_detail_mutasi`.`mutasi_asal` AS `mutasi_asal`,`vu_detail_mutasi`.`gudang_asal_id` AS `gudang_asal_id`,`vu_detail_mutasi`.`gudang_asal_nama` AS `gudang_asal_nama`,`vu_detail_mutasi`.`gudang_asala_lokasi` AS `gudang_asala_lokasi`,`vu_detail_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`vu_detail_mutasi`.`gudang_tujuan_id` AS `gudang_tujuan_id`,`vu_detail_mutasi`.`gudang_tujuan_nama` AS `gudang_tujuan_nama`,`vu_detail_mutasi`.`gudang_tujuan_lokasi` AS `gudang_tujuan_lokasi`,`vu_detail_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`vu_detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`konversi_produk` AS `konversi_produk`,`vu_produk_satuan_terkecil`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_satuan_terkecil`.`konversi_nilai` AS `konversi_nilai`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah`,(`vu_detail_mutasi`.`dmutasi_jumlah` * `vu_produk_satuan_terkecil`.`konversi_nilai`) AS `jumlah_konversi` from (`vu_detail_mutasi` join `vu_produk_satuan_terkecil` on((`vu_detail_mutasi`.`dmutasi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_mutasi_all`
--
DROP TABLE IF EXISTS `vu_stok_mutasi_all`;

CREATE OR REPLACE VIEW `vu_stok_mutasi_all` AS select `a`.`mutasi_tanggal` AS `mutasi_tanggal`,`a`.`gudang_asal_id` AS `gudang_id`,`a`.`gudang_asal_nama` AS `gudang_nama`,`a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_kode` AS `satuan_kode`,`a`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,`a`.`jumlah_konversi` AS `jumlah_keluar`,0 AS `jumlah_koreksi` from `vu_stok_mutasi` `a` union select `b`.`mutasi_tanggal` AS `mutasi_tanggal`,`b`.`gudang_tujuan_id` AS `gudang_id`,`b`.`gudang_tujuan_nama` AS `gudang_nama`,`b`.`produk_id` AS `produk_id`,`b`.`produk_kode` AS `produk_kode`,`b`.`produk_nama` AS `produk_nama`,`b`.`satuan_id` AS `satuan_id`,`b`.`satuan_kode` AS `satuan_kode`,`b`.`satuan_nama` AS `satuan_nama`,`b`.`jumlah_konversi` AS `jumlah_masuk`,0 AS `jumlah_keluar`,0 AS `jumlah_koreksi` from `vu_stok_mutasi` `b` union select `c`.`koreksi_tanggal` AS `koreksi_tanggal`,`c`.`gudang_id` AS `gudang_id`,`c`.`gudang_nama` AS `gudang_nama`,`c`.`produk_id` AS `produk_id`,`c`.`produk_kode` AS `produk_kode`,`c`.`produk_nama` AS `produk_nama`,`c`.`satuan_id` AS `satuan_id`,`c`.`satuan_kode` AS `satuan_kode`,`c`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,0 AS `jumlah_keluar`,`c`.`jumlah_konversi` AS `jumlah_konversi` from `vu_stok_koreksi` `c`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_pakai_cabin`
--
DROP TABLE IF EXISTS `vu_stok_pakai_cabin`;

CREATE OR REPLACE VIEW `vu_stok_pakai_cabin` AS select `detail_pakai_cabin`.`cabin_dtrawat` AS `cabin_dtrawat`,`detail_pakai_cabin`.`cabin_rawat` AS `cabin_rawat`,`detail_pakai_cabin`.`cabin_produk` AS `cabin_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`detail_pakai_cabin`.`cabin_satuan` AS `cabin_satuan`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_pakai_cabin`.`cabin_jumlah` AS `cabin_jumlah`,`detail_pakai_cabin`.`cabin_date_create` AS `cabin_date_create`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_pakai_cabin`.`cabin_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from ((`detail_pakai_cabin` join `satuan_konversi` on(((`detail_pakai_cabin`.`cabin_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_pakai_cabin`.`cabin_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_beli`
--
DROP TABLE IF EXISTS `vu_stok_retur_beli`;

CREATE OR REPLACE VIEW `vu_stok_retur_beli` AS select `master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_retur_beli`.`drbeli_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from (((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `satuan_konversi` on(((`satuan_konversi`.`konversi_produk` = `detail_retur_beli`.`drbeli_produk`) and (`detail_retur_beli`.`drbeli_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_paket`
--
DROP TABLE IF EXISTS `vu_stok_retur_jual_paket`;

CREATE OR REPLACE VIEW `vu_stok_retur_jual_paket` AS select `master_retur_jual_paket`.`rpaket_tanggal` AS `rpaket_tanggal`,`detail_retur_paket_poduk`.`drpaket_id` AS `drpaket_id`,`detail_retur_paket_poduk`.`drpaket_master` AS `drpaket_master`,`detail_retur_paket_poduk`.`drpaket_produk` AS `drpaket_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_retur_paket_poduk`.`drpaket_satuan` AS `drpaket_satuan`,`detail_retur_paket_poduk`.`drpaket_jumlah` AS `drpaket_jumlah`,`detail_retur_paket_poduk`.`drpaket_harga` AS `drpaket_harga`,(`detail_retur_paket_poduk`.`drpaket_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from (((`detail_retur_paket_poduk` join `master_retur_jual_paket` on((`detail_retur_paket_poduk`.`drpaket_master` = `master_retur_jual_paket`.`rpaket_id`))) join `satuan_konversi` on(((`detail_retur_paket_poduk`.`drpaket_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_paket_poduk`.`drpaket_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_produk`
--
DROP TABLE IF EXISTS `vu_stok_retur_jual_produk`;

CREATE OR REPLACE VIEW `vu_stok_retur_jual_produk` AS select `master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,`detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,`detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,(`detail_retur_jual_produk`.`drproduk_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from (((`detail_retur_jual_produk` join `master_retur_jual_produk` on((`detail_retur_jual_produk`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) join `satuan_konversi` on(((`detail_retur_jual_produk`.`drproduk_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_jual_produk`.`drproduk_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_terima`
--
DROP TABLE IF EXISTS `vu_stok_terima`;

CREATE OR REPLACE VIEW `vu_stok_terima` AS select `detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`satuan_konversi`.`konversi_id` AS `konversi_id`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_terima_beli`.`dterima_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah` from (((`detail_terima_beli` join `satuan_konversi` on(((`detail_terima_beli`.`dterima_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_terima_beli`.`dterima_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_all`
--
DROP TABLE IF EXISTS `vu_stok_all`;

CREATE OR REPLACE VIEW `vu_stok_all` AS select date_format(`vu_stok_jual_produk`.`jproduk_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_jual_produk`.`produk_kode` AS `produk_kode`,`vu_stok_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_jual_produk`.`satuan_kode` AS `satuan_kode`,`vu_stok_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_jual_produk`.`jumlah_konversi` AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_jual_produk` union select date_format(`vu_stok_pakai_cabin`.`cabin_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_pakai_cabin`.`produk_id` AS `produk_id`,`vu_stok_pakai_cabin`.`produk_kode` AS `produk_kode`,`vu_stok_pakai_cabin`.`produk_nama` AS `produk_nama`,`vu_stok_pakai_cabin`.`satuan_id` AS `satuan_id`,`vu_stok_pakai_cabin`.`satuan_kode` AS `satuan_kode`,`vu_stok_pakai_cabin`.`satuan_nama` AS `satuan_nama`,`vu_stok_pakai_cabin`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_pakai_cabin`.`jumlah_konversi` AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_pakai_cabin` union select date_format(`vu_stok_retur_beli`.`rbeli_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_retur_beli`.`produk_id` AS `produk_id`,`vu_stok_retur_beli`.`produk_kode` AS `produk_kode`,`vu_stok_retur_beli`.`produk_nama` AS `produk_nama`,`vu_stok_retur_beli`.`satuan_id` AS `satuan_id`,`vu_stok_retur_beli`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_beli`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_beli`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,`vu_stok_retur_beli`.`jumlah_konversi` AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_beli` union select date_format(`vu_stok_retur_jual_paket`.`rpaket_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_retur_jual_paket`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_paket`.`produk_kode` AS `produk_kode`,`vu_stok_retur_jual_paket`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_paket`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_paket`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_jual_paket`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_paket`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,`vu_stok_retur_jual_paket`.`jumlah_konversi` AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_paket` union select date_format(`vu_stok_retur_jual_produk`.`rproduk_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_retur_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_produk`.`produk_kode` AS `produk_kode`,`vu_stok_retur_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_produk`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,`vu_stok_retur_jual_produk`.`jumlah_konversi` AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_produk` union select date_format(`vu_stok_terima`.`terima_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_terima`.`produk_id` AS `produk_id`,`vu_stok_terima`.`produk_kode` AS `produk_kode`,`vu_stok_terima`.`produk_nama` AS `produk_nama`,`vu_stok_terima`.`satuan_id` AS `satuan_id`,`vu_stok_terima`.`satuan_kode` AS `satuan_kode`,`vu_stok_terima`.`satuan_nama` AS `satuan_nama`,`vu_stok_terima`.`konversi_default` AS `konversi_default`,`vu_stok_terima`.`jumlah_konversi` AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_terima` union select date_format(`vu_stok_koreksi`.`koreksi_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,`vu_stok_koreksi`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,`vu_stok_koreksi`.`jumlah_konversi` AS `jumlah_koreksi` from `vu_stok_koreksi`;

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

CREATE OR REPLACE VIEW `vu_stok_all_saldo` AS select `a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_nama` AS `satuan_nama`,ifnull(sum(`a`.`jumlah_terima`),0) AS `jumlah_terima`,ifnull(sum(`a`.`jumlah_retur_beli`),0) AS `jumlah_retur_beli`,ifnull(sum(`a`.`jumlah_jual`),0) AS `jumlah_jual`,ifnull(sum(`a`.`jumlah_retur_produk`),0) AS `jumlah_retur_produk`,ifnull(sum(`a`.`jumlah_retur_paket`),0) AS `jumlah_retur_paket`,ifnull(sum(`a`.`jumlah_cabin`),0) AS `jumlah_cabin`,ifnull(sum(`a`.`jumlah_koreksi`),0) AS `jumlah_koreksi`,ifnull(sum(`a`.`jumlah_saldo`),0) AS `stok_saldo` from `vu_stok_all_saldo_tanggal` `a` group by `a`.`produk_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_all`
--
DROP TABLE IF EXISTS `vu_stok_gudang_all`;

CREATE OR REPLACE VIEW `vu_stok_gudang_all` AS select `vu_stok_mutasi_all`.`gudang_id` AS `gudang_id`,`vu_stok_mutasi_all`.`gudang_nama` AS `gudang_nama`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,((sum(`vu_stok_mutasi_all`.`jumlah_masuk`) - sum(`vu_stok_mutasi_all`.`jumlah_keluar`)) + sum(`vu_stok_mutasi_all`.`jumlah_koreksi`)) AS `jumlah_stok` from `vu_stok_mutasi_all` group by `vu_stok_mutasi_all`.`gudang_id`,`vu_stok_mutasi_all`.`gudang_nama`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_besar_tanggal`
--
DROP TABLE IF EXISTS `vu_stok_gudang_besar_tanggal`;

CREATE OR REPLACE VIEW `vu_stok_gudang_besar_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` where ((`vu_stok_all`.`jumlah_terima` > 0) or (`vu_stok_all`.`jumlah_retur_beli` > 0)) group by `vu_stok_all`.`tanggal` union select distinct `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 1) group by `vu_stok_mutasi_all`.`mutasi_tanggal` union select distinct `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 1) group by `vu_stok_koreksi`.`koreksi_tanggal`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_besar_saldo`
--
DROP TABLE IF EXISTS `vu_stok_gudang_besar_saldo`;

CREATE OR REPLACE VIEW `vu_stok_gudang_besar_saldo` AS select `vu_stok_gudang_besar_tanggal`.`produk_id` AS `produk_id`,`vu_stok_gudang_besar_tanggal`.`produk_kode` AS `produk_kode`,`vu_stok_gudang_besar_tanggal`.`produk_nama` AS `produk_nama`,`vu_stok_gudang_besar_tanggal`.`satuan_id` AS `satuan_id`,`vu_stok_gudang_besar_tanggal`.`satuan_kode` AS `satuan_kode`,`vu_stok_gudang_besar_tanggal`.`satuan_nama` AS `satuan_nama`,((((sum(`vu_stok_gudang_besar_tanggal`.`jumlah_terima`) - sum(`vu_stok_gudang_besar_tanggal`.`jumlah_retur_beli`)) - sum(`vu_stok_gudang_besar_tanggal`.`jumlah_keluar`)) + sum(`vu_stok_gudang_besar_tanggal`.`jumlah_masuk`)) + sum(`vu_stok_gudang_besar_tanggal`.`jumlah_koreksi`)) AS `jumlah_stok` from `vu_stok_gudang_besar_tanggal` group by `vu_stok_gudang_besar_tanggal`.`produk_kode`,`vu_stok_gudang_besar_tanggal`.`produk_nama`,`vu_stok_gudang_besar_tanggal`.`satuan_id`,`vu_stok_gudang_besar_tanggal`.`satuan_kode`,`vu_stok_gudang_besar_tanggal`.`satuan_nama`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_gudang_produk_tanggal`
--
DROP TABLE IF EXISTS `vu_stok_gudang_produk_tanggal`;

CREATE OR REPLACE VIEW `vu_stok_gudang_produk_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id`,`vu_stok_all`.`produk_kode`,`vu_stok_all`.`produk_nama`,`vu_stok_all`.`satuan_kode`,`vu_stok_all`.`satuan_nama`,`vu_stok_all`.`satuan_id` union select `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 2) group by `vu_stok_mutasi_all`.`mutasi_tanggal`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`,`vu_stok_mutasi_all`.`satuan_id` union select `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 2) group by `vu_stok_koreksi`.`koreksi_tanggal`,`vu_stok_koreksi`.`produk_id`,`vu_stok_koreksi`.`produk_kode`,`vu_stok_koreksi`.`produk_nama`,`vu_stok_koreksi`.`satuan_kode`,`vu_stok_koreksi`.`satuan_nama`,`vu_stok_koreksi`.`satuan_id`;

-- --------------------------------------------------------
--
-- Structure for view `vu_stok_gudang_produk_saldo`
--
DROP TABLE IF EXISTS `vu_stok_gudang_produk_saldo`;

CREATE OR REPLACE VIEW `vu_stok_gudang_produk_saldo` AS select `vu_stok_gudang_produk_tanggal`.`produk_id` AS `produk_id`,`vu_stok_gudang_produk_tanggal`.`produk_kode` AS `produk_kode`,`vu_stok_gudang_produk_tanggal`.`produk_nama` AS `produk_nama`,`vu_stok_gudang_produk_tanggal`.`satuan_id` AS `satuan_id`,`vu_stok_gudang_produk_tanggal`.`satuan_kode` AS `satuan_kode`,`vu_stok_gudang_produk_tanggal`.`satuan_nama` AS `satuan_nama`,(((((sum(`vu_stok_gudang_produk_tanggal`.`jumlah_retur_produk`) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_retur_paket`)) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_keluar`)) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_masuk`)) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_koreksi`)) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_jual`)) AS `jumlah_stok` from `vu_stok_gudang_produk_tanggal` group by `vu_stok_gudang_produk_tanggal`.`produk_kode`,`vu_stok_gudang_produk_tanggal`.`produk_nama`,`vu_stok_gudang_produk_tanggal`.`satuan_id`,`vu_stok_gudang_produk_tanggal`.`satuan_kode`,`vu_stok_gudang_produk_tanggal`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_invoice_group`
--
DROP TABLE IF EXISTS `vu_total_invoice_group`;

CREATE  OR REPLACE VIEW `vu_total_invoice_group` AS select `detail_invoice`.`dinvoice_master` AS `dinvoice_master`,ifnull(sum(`detail_invoice`.`dinvoice_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100)),0) AS `total_nilai` from `detail_invoice` group by `detail_invoice`.`dinvoice_master`;

-- --------------------------------------------------------
--
-- Structure for view `vu_total_invoice_group_konversi`
--
DROP TABLE IF EXISTS `vu_total_invoice_group_konversi`;

CREATE OR REPLACE VIEW `vu_total_invoice_group_konversi` AS select `vu_detail_invoice_konversi`.`dinvoice_master` AS `dinvoice_master`,ifnull(sum(`vu_detail_invoice_konversi`.`jumlah_konversi`),0) AS `jumlah_barang`,((sum((`vu_detail_invoice_konversi`.`dinvoice_harga` * `vu_detail_invoice_konversi`.`dinvoice_jumlah`)) * (100 - `vu_detail_invoice_konversi`.`dinvoice_diskon`)) / 100) AS `total_nilai` from `vu_detail_invoice_konversi` group by `vu_detail_invoice_konversi`.`dinvoice_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_invoice`
--
DROP TABLE IF EXISTS `vu_trans_invoice`;

CREATE OR REPLACE VIEW `vu_trans_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `no_bukti`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_invoice`.`invoice_tanggal` AS `tanggal`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`vu_total_invoice_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_invoice_group`.`total_nilai` AS `total_nilai`,`vu_total_invoice_group`.`dinvoice_master` AS `dinvoice_master`,`vu_trans_terima`.`no_bukti` AS `terima_no`,`vu_trans_terima`.`order_no` AS `order_no`,`vu_trans_terima`.`order_tanggal` AS `order_tanggal`,`vu_trans_terima`.`order_carabayar` AS `order_carabayar`,`vu_trans_terima`.`order_diskon` AS `order_diskon`,`vu_trans_terima`.`order_biaya` AS `order_biaya`,`vu_trans_terima`.`order_bayar` AS `order_bayar`,`vu_trans_terima`.`supplier_nama` AS `supplier_nama`,`vu_trans_terima`.`supplier_alamat` AS `supplier_alamat`,`vu_trans_terima`.`supplier_kota` AS `supplier_kota`,`vu_trans_terima`.`terima_pengirim` AS `terima_pengirim`,`vu_trans_terima`.`tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`vu_trans_terima`.`terima_order` AS `terima_order` from ((`master_invoice` join `vu_total_invoice_group` on((`vu_total_invoice_group`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_trans_terima` on((`master_invoice`.`invoice_noterima` = `vu_trans_terima`.`terima_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_invoice_konversi`
--
DROP TABLE IF EXISTS `vu_trans_invoice_konversi`;

CREATE OR REPLACE VIEW `vu_trans_invoice_konversi` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,(`master_invoice`.`invoice_cashback` / `vu_total_invoice_group_konversi`.`jumlah_barang`) AS `potongan_satuan`,(`master_invoice`.`invoice_biaya` / `vu_total_invoice_group_konversi`.`jumlah_barang`) AS `biaya_satuan`,`vu_total_invoice_group_konversi`.`jumlah_barang` AS `jumlah_barang`,(((`vu_total_invoice_group_konversi`.`total_nilai` * `master_invoice`.`invoice_diskon`) / 100) / `vu_total_invoice_group_konversi`.`jumlah_barang`) AS `diskon_satuan` from (`master_invoice` join `vu_total_invoice_group_konversi` on((`master_invoice`.`invoice_id` = `vu_total_invoice_group_konversi`.`dinvoice_master`)));

-- --------------------------------------------------------

