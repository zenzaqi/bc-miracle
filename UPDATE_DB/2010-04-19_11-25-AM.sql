-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2010 at 12:21 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_jual_produk`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vu_detail_jual_produk` AS select `detail_jual_produk`.`dproduk_id` AS `dproduk_id`,`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`detail_jual_produk`.`dproduk_jumlah` AS `jumlah_barang`,`detail_jual_produk`.`dproduk_harga` AS `harga_satuan`,`detail_jual_produk`.`dproduk_diskon` AS `diskon`,`detail_jual_produk`.`dproduk_diskon_jenis` AS `diskon_jenis`,`karyawan`.`karyawan_username` AS `sales`,`master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_du` AS `produk_du`,`vu_produk`.`produk_dm` AS `produk_dm`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_harga` AS `produk_harga`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`satuan`.`satuan_nama` AS `satuan_nama`,(((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) / 100) * `detail_jual_produk`.`dproduk_jumlah`) AS `diskon_nilai`,((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_jumlah`) - (((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) / 100) * `detail_jual_produk`.`dproduk_jumlah`)) AS `subtotal`,`master_jual_produk`.`jproduk_id` AS `jproduk_id` from (((((`detail_jual_produk` join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) join `customer` on((`master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`))) join `vu_produk` on((`vu_produk`.`produk_id` = `detail_jual_produk`.`dproduk_id`))) join `satuan` on((`detail_jual_produk`.`dproduk_satuan` = `satuan`.`satuan_id`))) left join `karyawan` on((`detail_jual_produk`.`dproduk_karyawan` = `karyawan`.`karyawan_id`)));

--
-- VIEW  `vu_detail_jual_produk`
-- Data: None
--

