-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2010 at 10:31 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

--
-- Structure for view `vu_jual_card`
--

CREATE OR REPLACE VIEW `miracledb`.`vu_jual_card` AS select `miracledb`.`jual_card`.`jcard_id` AS `jcard_id`,`miracledb`.`jual_card`.`jcard_no` AS `jcard_no`,`miracledb`.`jual_card`.`jcard_nama` AS `jcard_nama`,`miracledb`.`jual_card`.`jcard_edc` AS `jcard_edc`,`miracledb`.`jual_card`.`jcard_nilai` AS `jcard_nilai`,`miracledb`.`jual_card`.`jcard_ref` AS `jcard_ref`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota` from (`miracledb`.`jual_card` join `miracledb`.`vu_trans_union` on((`miracledb`.`jual_card`.`jcard_ref` = `vu_trans_union`.`no_bukti`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_cek`
--


CREATE OR REPLACE VIEW `miracledb`.`vu_jual_cek` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`miracledb`.`jual_cek`.`jcek_id` AS `jcek_id`,`miracledb`.`jual_cek`.`jcek_no` AS `jcek_no`,`miracledb`.`jual_cek`.`jcek_nama` AS `jcek_nama`,`miracledb`.`jual_cek`.`jcek_valid` AS `jcek_valid`,`miracledb`.`jual_cek`.`jcek_bank` AS `jcek_bank`,`miracledb`.`jual_cek`.`jcek_nilai` AS `jcek_nilai`,`miracledb`.`jual_cek`.`jcek_ref` AS `jcek_ref` from (`miracledb`.`jual_cek` join `miracledb`.`vu_trans_union` on((`vu_trans_union`.`no_bukti` = `miracledb`.`jual_cek`.`jcek_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_kredit`
--


CREATE OR REPLACE VIEW `miracledb`.`vu_jual_kredit` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`miracledb`.`jual_kredit`.`jkredit_id` AS `jkredit_id`,`miracledb`.`jual_kredit`.`jkredit_cust` AS `jkredit_cust`,`miracledb`.`jual_kredit`.`jkredit_nilai` AS `jkredit_nilai`,`miracledb`.`jual_kredit`.`jkredit_ref` AS `jkredit_ref` from (`miracledb`.`jual_kredit` join `miracledb`.`vu_trans_union` on((`vu_trans_union`.`no_bukti` = `miracledb`.`jual_kredit`.`jkredit_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_kwitansi`
--


CREATE OR REPLACE VIEW `miracledb`.`vu_jual_kwitansi` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`miracledb`.`jual_kwitansi`.`jkwitansi_id` AS `jkwitansi_id`,`miracledb`.`jual_kwitansi`.`jkwitansi_master` AS `jkwitansi_master`,`miracledb`.`jual_kwitansi`.`jkwitansi_no` AS `jkwitansi_no`,`miracledb`.`jual_kwitansi`.`jkwitansi_nilai` AS `jkwitansi_nilai`,`miracledb`.`jual_kwitansi`.`jkwitansi_ref` AS `jkwitansi_ref` from (`miracledb`.`jual_kwitansi` join `miracledb`.`vu_trans_union` on((`vu_trans_union`.`no_bukti` = `miracledb`.`jual_kwitansi`.`jkwitansi_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_transfer`
--

CREATE OR REPLACE VIEW `miracledb`.`vu_jual_transfer` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`miracledb`.`jual_transfer`.`jtransfer_id` AS `jtransfer_id`,`miracledb`.`jual_transfer`.`jtransfer_bank` AS `jtransfer_bank`,`miracledb`.`jual_transfer`.`jtransfer_nama` AS `jtransfer_nama`,`miracledb`.`jual_transfer`.`jtransfer_nilai` AS `jtransfer_nilai`,`miracledb`.`jual_transfer`.`jtransfer_ref` AS `jtransfer_ref` from (`miracledb`.`jual_transfer` join `miracledb`.`vu_trans_union` on((`vu_trans_union`.`no_bukti` = `miracledb`.`jual_transfer`.`jtransfer_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_tunai`
--

CREATE OR REPLACE VIEW `miracledb`.`vu_jual_tunai` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`miracledb`.`jual_tunai`.`jtunai_id` AS `jtunai_id`,`miracledb`.`jual_tunai`.`jtunai_nilai` AS `jtunai_nilai`,`miracledb`.`jual_tunai`.`jtunai_ref` AS `jtunai_ref` from (`miracledb`.`jual_tunai` join `miracledb`.`vu_trans_union` on((`vu_trans_union`.`no_bukti` = `miracledb`.`jual_tunai`.`jtunai_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_voucher`
--


CREATE OR REPLACE VIEW `miracledb`.`vu_jual_voucher` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`miracledb`.`voucher_terima`.`tvoucher_id` AS `tvoucher_id`,`miracledb`.`voucher_terima`.`tvoucher_ref` AS `tvoucher_ref`,`miracledb`.`voucher_terima`.`tvoucher_novoucher` AS `tvoucher_novoucher`,`miracledb`.`voucher_terima`.`tvoucher_nilai` AS `tvoucher_nilai` from (`miracledb`.`voucher_terima` join `miracledb`.`vu_trans_union` on((`vu_trans_union`.`no_bukti` = `miracledb`.`voucher_terima`.`tvoucher_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_terima_kas`
--


CREATE OR REPLACE VIEW `miracledb`.`vu_trans_terima_kas` AS select _utf8'card' AS `jenis_bayar`,`vu_jual_card`.`tanggal` AS `tanggal`,`vu_jual_card`.`cust_id` AS `cust_id`,`vu_jual_card`.`cust_no` AS `cust_no`,`vu_jual_card`.`cust_member` AS `cust_member`,`vu_jual_card`.`cust_nama` AS `cust_nama`,`vu_jual_card`.`cust_alamat` AS `cust_alamat`,`vu_jual_card`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_card`.`no_bukti` AS `no_bukti`,`vu_jual_card`.`jcard_nilai` AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `miracledb`.`vu_jual_card` union select _utf8'cek' AS `jenis_bayar`,`vu_jual_cek`.`tanggal` AS `tanggal`,`vu_jual_cek`.`cust_id` AS `cust_id`,`vu_jual_cek`.`cust_no` AS `cust_no`,`vu_jual_cek`.`cust_member` AS `cust_member`,`vu_jual_cek`.`cust_nama` AS `cust_nama`,`vu_jual_cek`.`cust_alamat` AS `cust_alamat`,`vu_jual_cek`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_cek`.`no_bukti` AS `no_bukti`,0 AS `card`,`vu_jual_cek`.`jcek_nilai` AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `miracledb`.`vu_jual_cek` union select _utf8'kredit' AS `jenis_bayar`,`vu_jual_kredit`.`tanggal` AS `tanggal`,`vu_jual_kredit`.`cust_id` AS `cust_id`,`vu_jual_kredit`.`cust_no` AS `cust_no`,`vu_jual_kredit`.`cust_member` AS `cust_member`,`vu_jual_kredit`.`cust_nama` AS `cust_nama`,`vu_jual_kredit`.`cust_alamat` AS `cust_alamat`,`vu_jual_kredit`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_kredit`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,`vu_jual_kredit`.`jkredit_nilai` AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `miracledb`.`vu_jual_kredit` union select _utf8'kwitansi' AS `jenis_bayar`,`vu_jual_kwitansi`.`tanggal` AS `tanggal`,`vu_jual_kwitansi`.`cust_id` AS `cust_id`,`vu_jual_kwitansi`.`cust_no` AS `cust_no`,`vu_jual_kwitansi`.`cust_member` AS `cust_member`,`vu_jual_kwitansi`.`cust_nama` AS `cust_nama`,`vu_jual_kwitansi`.`cust_alamat` AS `cust_alamat`,`vu_jual_kwitansi`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_kwitansi`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,`vu_jual_kwitansi`.`jkwitansi_nilai` AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `miracledb`.`vu_jual_kwitansi` union select _utf8'transfer' AS `jenis_bayar`,`vu_jual_transfer`.`tanggal` AS `tanggal`,`vu_jual_transfer`.`cust_id` AS `cust_id`,`vu_jual_transfer`.`cust_no` AS `cust_no`,`vu_jual_transfer`.`cust_member` AS `cust_member`,`vu_jual_transfer`.`cust_nama` AS `cust_nama`,`vu_jual_transfer`.`cust_alamat` AS `cust_alamat`,`vu_jual_transfer`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_transfer`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,`vu_jual_transfer`.`jtransfer_nilai` AS `transfer`,0 AS `tunai`,0 AS `voucher` from `miracledb`.`vu_jual_transfer` union select _utf8'tunai' AS `jenis_bayar`,`vu_jual_tunai`.`tanggal` AS `tanggal`,`vu_jual_tunai`.`cust_id` AS `cust_id`,`vu_jual_tunai`.`cust_no` AS `cust_no`,`vu_jual_tunai`.`cust_member` AS `cust_member`,`vu_jual_tunai`.`cust_nama` AS `cust_nama`,`vu_jual_tunai`.`cust_alamat` AS `cust_alamat`,`vu_jual_tunai`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_tunai`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,`vu_jual_tunai`.`jtunai_nilai` AS `tunai`,0 AS `voucher` from `miracledb`.`vu_jual_tunai` union select _utf8'voucher' AS `jenis_bayar`,`vu_jual_voucher`.`tanggal` AS `tanggal`,`vu_jual_voucher`.`cust_id` AS `cust_id`,`vu_jual_voucher`.`cust_no` AS `cust_no`,`vu_jual_voucher`.`cust_member` AS `cust_member`,`vu_jual_voucher`.`cust_nama` AS `cust_nama`,`vu_jual_voucher`.`cust_alamat` AS `cust_alamat`,`vu_jual_voucher`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_voucher`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,`vu_jual_voucher`.`tvoucher_nilai` AS `voucher` from `miracledb`.`vu_jual_voucher`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_union`


CREATE OR REPLACE VIEW `miracledb`.`vu_trans_union` AS select _utf8'jual_produk' AS `jenis_transaksi`,`vu_trans_produk`.`no_bukti` AS `no_bukti`,`vu_trans_produk`.`cust_id` AS `cust_id`,`vu_trans_produk`.`tanggal` AS `tanggal`,`vu_trans_produk`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_produk`.`total_nilai` AS `total_nilai`,`vu_trans_produk`.`cust_no` AS `cust_no`,`vu_trans_produk`.`cust_member` AS `cust_member`,`vu_trans_produk`.`cust_nama` AS `cust_nama`,`vu_trans_produk`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_produk`.`cust_alamat` AS `cust_alamat`,`vu_trans_produk`.`cust_kota` AS `cust_kota`,`vu_trans_produk`.`diskon` AS `diskon`,`vu_trans_produk`.`cashback` AS `cashback` from `miracledb`.`vu_trans_produk` union select _utf8'jual_rawat' AS `jenis_transaksi`,`vu_trans_rawat`.`no_bukti` AS `no_bukti`,`vu_trans_rawat`.`cust_id` AS `cust_id`,`vu_trans_rawat`.`tanggal` AS `tanggal`,`vu_trans_rawat`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_rawat`.`total_nilai` AS `total_nilai`,`vu_trans_rawat`.`cust_no` AS `cust_no`,`vu_trans_rawat`.`cust_member` AS `cust_member`,`vu_trans_rawat`.`cust_nama` AS `cust_nama`,`vu_trans_rawat`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_rawat`.`cust_alamat` AS `cust_alamat`,`vu_trans_rawat`.`cust_kota` AS `cust_kota`,`vu_trans_rawat`.`diskon` AS `diskon`,`vu_trans_rawat`.`cashback` AS `cashback` from `miracledb`.`vu_trans_rawat` union select _utf8'jual_paket' AS `jenis_transaksi`,`vu_trans_paket`.`no_bukti` AS `no_bukti`,`vu_trans_paket`.`cust_id` AS `cust_id`,`vu_trans_paket`.`tanggal` AS `tanggal`,`vu_trans_paket`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_paket`.`total_nilai` AS `total_nilai`,`vu_trans_paket`.`cust_no` AS `cust_no`,`vu_trans_paket`.`cust_member` AS `cust_member`,`vu_trans_paket`.`cust_nama` AS `cust_nama`,`vu_trans_paket`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_paket`.`cust_alamat` AS `cust_alamat`,`vu_trans_paket`.`cust_kota` AS `cust_kota`,`vu_trans_paket`.`diskon` AS `diskon`,`vu_trans_paket`.`cashback` AS `cashback` from `miracledb`.`vu_trans_paket` union select _utf8'jual_retur' AS `jenis_transaksi`,`vu_trans_retur_produk`.`no_bukti` AS `no_bukti`,`vu_trans_retur_produk`.`cust_id` AS `cust_id`,`vu_trans_retur_produk`.`tanggal` AS `tanggal`,`vu_trans_retur_produk`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_retur_produk`.`total_nilai` AS `total_nilai`,`vu_trans_retur_produk`.`cust_no` AS `cust_no`,`vu_trans_retur_produk`.`cust_member` AS `cust_member`,`vu_trans_retur_produk`.`cust_nama` AS `cust_nama`,`vu_trans_retur_produk`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_retur_produk`.`cust_alamat` AS `cust_alamat`,`vu_trans_retur_produk`.`cust_kota` AS `cust_kota`,`vu_trans_retur_produk`.`diskon` AS `diskon`,`vu_trans_retur_produk`.`cashback` AS `cashback` from `miracledb`.`vu_trans_retur_produk`;
