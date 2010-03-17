-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2010 at 09:03 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_note`
--

DROP TABLE IF EXISTS `customer_note`;
CREATE TABLE IF NOT EXISTS `customer_note` (
  `note_id` int(11) NOT NULL auto_increment,
  `note_customer` int(11) NOT NULL,
  `note_tanggal` datetime default NULL,
  `note_detail` varchar(250) default NULL,
  `note_creator` varchar(50) default NULL,
  `note_date_create` datetime default NULL,
  `note_update` varchar(50) default NULL,
  `note_date_update` datetime default NULL,
  `note_revised` int(11) default NULL,
  PRIMARY KEY  (`note_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice`
--

DROP TABLE IF EXISTS `detail_invoice`;
CREATE TABLE IF NOT EXISTS `detail_invoice` (
  `dinvoice_id` int(11) NOT NULL auto_increment,
  `dinvoice_master` int(11) NOT NULL,
  `dinvoice_produk` int(11) NOT NULL,
  `dinvoice_satuan` int(11) default NULL,
  `dinvoice_jumlah` int(11) default NULL,
  `dinvoice_harga` double default NULL,
  `dinvoice_diskon` float default NULL,
  PRIMARY KEY  (`dinvoice_id`),
  KEY `fk_ref_order_produk_on_produk_id` (`dinvoice_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_order_beli`
--

DROP TABLE IF EXISTS `detail_order_beli`;
CREATE TABLE IF NOT EXISTS `detail_order_beli` (
  `dorder_id` int(11) NOT NULL auto_increment,
  `dorder_master` int(11) NOT NULL,
  `dorder_produk` int(11) NOT NULL,
  `dorder_satuan` int(11) default NULL,
  `dorder_jumlah` int(11) default NULL,
  `dorder_harga` double default NULL,
  `dorder_diskon` float default NULL,
  PRIMARY KEY  (`dorder_id`),
  KEY `fk_ref_order_produk_on_produk_id` (`dorder_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_terima_beli`
--

DROP TABLE IF EXISTS `detail_terima_beli`;
CREATE TABLE IF NOT EXISTS `detail_terima_beli` (
  `dterima_id` int(11) NOT NULL auto_increment,
  `dterima_master` int(11) NOT NULL,
  `dterima_produk` int(11) NOT NULL,
  `dterima_satuan` int(11) default NULL,
  `dterima_jumlah` int(11) default NULL,
  PRIMARY KEY  (`dterima_id`),
  KEY `fk_ref_terima_produk_on_produk_id` (`dterima_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_invoice`
--

DROP TABLE IF EXISTS `master_invoice`;
CREATE TABLE IF NOT EXISTS `master_invoice` (
  `invoice_id` int(11) NOT NULL auto_increment,
  `invoice_no` varchar(50) default NULL,
  `invoice_supplier` int(11) NOT NULL,
  `invoice_noterima` int(11) NOT NULL,
  `invoice_tanggal` date default NULL,
  `invoice_diskon` tinyint(4) default NULL,
  `invoice_cashback` double default NULL,
  `invoice_uangmuka` double default NULL,
  `invoice_biaya` double default NULL,
  `invoice_jatuhtempo` date default NULL,
  `invoice_penagih` varchar(50) default NULL,
  `invoice_creator` varchar(50) default NULL,
  `invoice_date_create` date default NULL,
  `invoice_update` varchar(50) default NULL,
  `invoice_date_update` date default NULL,
  `invoice_revised` int(11) default NULL,
  PRIMARY KEY  (`invoice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_order_beli`
--

DROP TABLE IF EXISTS `master_order_beli`;
CREATE TABLE IF NOT EXISTS `master_order_beli` (
  `order_id` int(11) NOT NULL auto_increment,
  `order_no` varchar(50) default NULL,
  `order_supplier` int(11) default NULL,
  `order_tanggal` date default NULL,
  `order_carabayar` enum('tunai','kredit','konsinyasi') default NULL,
  `order_diskon` tinyint(2) default NULL,
  `order_cashback` float default NULL,
  `order_biaya` double default NULL,
  `order_bayar` double default NULL,
  `order_keterangan` varchar(500) default NULL,
  `order_creator` varchar(50) default NULL,
  `order_date_create` datetime default NULL,
  `order_update` varchar(50) default NULL,
  `order_date_update` datetime default NULL,
  `order_revised` int(11) default NULL,
  PRIMARY KEY  (`order_id`),
  KEY `fk_ref_order_supplier_on_supplier_id` (`order_supplier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_terima_beli`
--

DROP TABLE IF EXISTS `master_terima_beli`;
CREATE TABLE IF NOT EXISTS `master_terima_beli` (
  `terima_id` int(11) NOT NULL auto_increment,
  `terima_no` varchar(50) default NULL,
  `terima_order` int(11) default NULL,
  `terima_supplier` int(11) default NULL,
  `terima_surat_jalan` varchar(30) default NULL,
  `terima_pengirim` varchar(30) default NULL,
  `terima_tanggal` date default NULL,
  `terima_keterangan` varchar(500) default NULL,
  `terima_creator` varchar(50) default NULL,
  `terima_date_create` datetime default NULL,
  `terima_update` varchar(50) default NULL,
  `terima_date_update` datetime default NULL,
  `terima_revised` int(11) default NULL,
  PRIMARY KEY  (`terima_id`),
  KEY `fk_ref_order_supplier_on_supplier_id` (`terima_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- VIEW DETAIL INVOICE
--

CREATE OR REPLACE VIEW `vu_detail_invoice` AS select `supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`satuan`.`satuan_id` AS `satuan_id`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`jenis_nama` AS `jenis_nama`,((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) AS `subtotal` from (((((`detail_invoice` join `master_invoice` on((`detail_invoice`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `supplier` on((`master_invoice`.`invoice_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_invoice`.`dinvoice_produk` = `vu_produk`.`produk_id`))) join `master_terima_beli` on((`master_invoice`.`invoice_noterima` = `master_terima_beli`.`terima_id`))) join `satuan` on((`detail_invoice`.`dinvoice_satuan` = `satuan`.`satuan_id`)));

--
-- VIEW DETAIL ORDER BELI
--

CREATE OR REPLACE VIEW `vu_detail_order_beli` AS select `supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_akun` AS `supplier_akun`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`detail_order_beli`.`dorder_master` AS `dorder_master`,`detail_order_beli`.`dorder_produk` AS `dorder_produk`,`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,`detail_order_beli`.`dorder_jumlah` AS `dorder_jumlah`,`detail_order_beli`.`dorder_harga` AS `dorder_harga`,`detail_order_beli`.`dorder_diskon` AS `dorder_diskon`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`vu_produk`.`produk_kodelama` AS `produk_kodelama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`jenis_kelompok` AS `jenis_kelompok`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_diskon`) * `detail_order_beli`.`dorder_harga`) AS `diskon_nilai`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_harga`) * (100 - `detail_order_beli`.`dorder_diskon`)) AS `subtotal` from ((((`detail_order_beli` join `master_order_beli` on((`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`))) join `satuan` on((`detail_order_beli`.`dorder_satuan` = `satuan`.`satuan_id`))) join `vu_produk` on((`detail_order_beli`.`dorder_produk` = `vu_produk`.`produk_id`)));

--
-- VIEW DETAIl TERIMA BONUS
--

CREATE OR REPLACE VIEW `vu_detail_terima_bonus` AS select `master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_bonus`.`dtbonus_id` AS `dtbonus_id`,`detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,`detail_terima_bonus`.`dtbonus_produk` AS `dtbonus_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_terima_bonus`.`dtbonus_satuan` AS `dtbonus_satuan`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_bonus`.`dtbonus_jumlah` AS `dtbonus_jumlah` from ((((`detail_terima_bonus` join `master_terima_beli` on((`detail_terima_bonus`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_bonus`.`dtbonus_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_bonus`.`dtbonus_satuan` = `satuan`.`satuan_id`)));

-- 
-- VIEW DETAIL TERIMA PRODUK
--

CREATE OR REPLACE VIEW `vu_detail_terima_produk` AS select `master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah`,`detail_terima_beli`.`dterima_id` AS `dterima_id`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan` from ((((`detail_terima_beli` join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_beli`.`dterima_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_beli`.`dterima_satuan` = `satuan`.`satuan_id`)));

--
-- VIEW SATUAN KONVERSI
--

CREATE OR REPLACE VIEW `vu_satuan_konversi` AS select `satuan`.`satuan_id` AS `satuan_id`,`satuan_konversi`.`konversi_id` AS `konversi_id`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`vu_produk`.`produk_aktif` AS `produk_aktif` from ((`satuan_konversi` join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `vu_produk` on((`satuan_konversi`.`konversi_produk` = `vu_produk`.`produk_id`)));

-- 
-- VIEW TRANS INVOICE
--

CREATE OR REPLACE VIEW `vu_trans_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `no_bukti`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_invoice`.`invoice_tanggal` AS `tanggal`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`vu_total_invoice_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_invoice_group`.`total_nilai` AS `total_nilai`,`vu_total_invoice_group`.`dinvoice_master` AS `dinvoice_master`,`vu_trans_terima`.`no_bukti` AS `terima_no`,`vu_trans_terima`.`order_no` AS `order_no`,`vu_trans_terima`.`order_tanggal` AS `order_tanggal`,`vu_trans_terima`.`order_carabayar` AS `order_carabayar`,`vu_trans_terima`.`order_diskon` AS `order_diskon`,`vu_trans_terima`.`order_biaya` AS `order_biaya`,`vu_trans_terima`.`order_bayar` AS `order_bayar`,`vu_trans_terima`.`supplier_nama` AS `supplier_nama`,`vu_trans_terima`.`supplier_alamat` AS `supplier_alamat`,`vu_trans_terima`.`supplier_kota` AS `supplier_kota`,`vu_trans_terima`.`terima_pengirim` AS `terima_pengirim`,`vu_trans_terima`.`tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`vu_trans_terima`.`terima_order` AS `terima_order` from ((`master_invoice` join `vu_total_invoice_group` on((`vu_total_invoice_group`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_trans_terima` on((`master_invoice`.`invoice_noterima` = `vu_trans_terima`.`terima_id`)));

--
-- VIEW TRANS ORDER BELI
--

CREATE OR REPLACE VIEW `vu_trans_order` AS select `master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,ifnull(`master_order_beli`.`order_diskon`,0) AS `order_diskon`,ifnull(`master_order_beli`.`order_biaya`,0) AS `order_biaya`,ifnull(`master_order_beli`.`order_bayar`,0) AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`vu_total_order_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_order_group`.`total_nilai` AS `total_nilai`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_kodepos` AS `supplier_kodepos`,`supplier`.`supplier_propinsi` AS `supplier_propinsi`,`supplier`.`supplier_negara` AS `supplier_negara`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_notelp2` AS `supplier_notelp2`,`supplier`.`supplier_nofax` AS `supplier_nofax`,`supplier`.`supplier_email` AS `supplier_email`,`supplier`.`supplier_website` AS `supplier_website`,`supplier`.`supplier_cp` AS `supplier_cp`,`supplier`.`supplier_contact_cp` AS `supplier_contact_cp`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_keterangan` AS `supplier_keterangan`,`master_order_beli`.`order_id` AS `order_id`,ifnull(`master_order_beli`.`order_cashback`,0) AS `order_cashback` from ((`master_order_beli` join `vu_total_order_group` on((`vu_total_order_group`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`)));

--
-- VIEW TRANS TERIMA
--

CREATE OR REPLACE VIEW `vu_trans_terima` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `no_bukti`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,`vu_total_terima_bonus_group`.`jumlah_barang_bonus` AS `jumlah_barang_bonus`,`vu_total_terima_group`.`jumlah_barang` AS `jumlah_barang` from ((((`master_terima_beli` join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `master_order_beli` on((`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`))) left join `vu_total_terima_bonus_group` on((`vu_total_terima_bonus_group`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `vu_total_terima_group` on((`vu_total_terima_group`.`dterima_master` = `master_terima_beli`.`terima_id`)));


