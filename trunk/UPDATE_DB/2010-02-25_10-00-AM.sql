-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2010 at 10:38 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_produk`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vu_trans_produk` AS select `master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_cust` AS `cust_id`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`vu_total_jual_produk_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_produk_group`.`total_nilai`,0) AS `total_nilai`,ifnull(`master_jual_produk`.`jproduk_diskon`,0) AS `diskon`,ifnull(`master_jual_produk`.`jproduk_cashback`,0) AS `cashback`,ifnull(`jual_kredit`.`jkredit_nilai`,0) AS `kredit`,ifnull(`jual_cek`.`jcek_nilai`,0) AS `cek`,ifnull(`jual_card`.`jcard_nilai`,0) AS `card`,ifnull(`jual_kwitansi`.`jkwitansi_nilai`,0) AS `kuintansi`,ifnull(`jual_transfer`.`jtransfer_nilai`,0) AS `transfer`,ifnull(`jual_tunai`.`jtunai_nilai`,0) AS `tunai` from ((((((((`master_jual_produk` left join `vu_total_jual_produk_group` on((`vu_total_jual_produk_group`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) left join `vu_customer` on((`master_jual_produk`.`jproduk_cust` = `vu_customer`.`cust_id`))) left join `jual_card` on((`jual_card`.`jcard_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_cek` on((`jual_cek`.`jcek_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_kredit` on((`jual_kredit`.`jkredit_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_kwitansi` on((`jual_kwitansi`.`jkwitansi_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_transfer` on((`jual_transfer`.`jtransfer_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_tunai` on((`jual_tunai`.`jtunai_ref` = `master_jual_produk`.`jproduk_nobukti`)));

--
-- VIEW  `vu_trans_produk`
-- Data: None
--