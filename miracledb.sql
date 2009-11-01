-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2009 at 09:13 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_nama` varchar(50) DEFAULT NULL,
  `voucher_jenis` enum('promo','reward') DEFAULT NULL,
  `voucher_point` int(11) DEFAULT NULL,
  `voucher_jumlah` int(11) DEFAULT NULL,
  `voucher_kadaluarsa` date DEFAULT NULL,
  `voucher_cashback` double DEFAULT NULL,
  `voucher_mincash` double DEFAULT NULL,
  `voucher_diskon` int(11) DEFAULT NULL,
  `voucher_promo` int(11) DEFAULT NULL,
  `voucher_allproduk` enum('T','Y') DEFAULT 'T',
  `voucher_allrawat` enum('T','Y') DEFAULT 'T',
  `voucher_creator` varchar(50) DEFAULT NULL,
  `voucher_date_create` datetime DEFAULT NULL,
  `voucher_update` varchar(50) DEFAULT NULL,
  `voucher_date_update` datetime DEFAULT NULL,
  `voucher_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_nama`, `voucher_jenis`, `voucher_point`, `voucher_jumlah`, `voucher_kadaluarsa`, `voucher_cashback`, `voucher_mincash`, `voucher_diskon`, `voucher_promo`, `voucher_allproduk`, `voucher_allrawat`, `voucher_creator`, `voucher_date_create`, `voucher_update`, `voucher_date_update`, `voucher_revised`) VALUES
(1, 'Test Voucher', 'promo', 0, 0, '2009-09-01', 1000, 100000, 0, 0, 'Y', 'Y', NULL, NULL, NULL, NULL, NULL),
(3, 'Test Voucher Lagi', 'reward', 100, 100, '2009-08-31', 10000, 150000, 0, 1, 'Y', 'Y', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_berlaku`
--

CREATE TABLE IF NOT EXISTS `voucher_berlaku` (
  `bvoucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `bvoucher_master` int(11) DEFAULT NULL,
  `bvoucher_produk` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`bvoucher_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `voucher_berlaku`
--

INSERT INTO `voucher_berlaku` (`bvoucher_id`, `bvoucher_master`, `bvoucher_produk`) VALUES
(13, 1, 'G0909'),
(15, 3, 'G0909');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_kupon`
--

CREATE TABLE IF NOT EXISTS `voucher_kupon` (
  `kvoucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `kvoucher_master` int(11) DEFAULT NULL,
  `kvoucher_nomor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kvoucher_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `voucher_kupon`
--

INSERT INTO `voucher_kupon` (`kvoucher_id`, `kvoucher_master`, `kvoucher_nomor`) VALUES
(1, 3, 'MVO0000001'),
(2, 3, 'MVO0000002'),
(3, 3, 'MVO0000003'),
(4, 3, 'MVO0000004'),
(5, 3, 'MVO0000005'),
(6, 3, 'MVO0000006'),
(7, 3, 'MVO0000007'),
(8, 3, 'MVO0000008'),
(9, 3, 'MVO0000009'),
(10, 3, 'MVO0000010'),
(11, 3, 'MVO0000011'),
(12, 3, 'MVO0000012'),
(13, 3, 'MVO0000013'),
(14, 3, 'MVO0000014'),
(15, 3, 'MVO0000015'),
(16, 3, 'MVO0000016'),
(17, 3, 'MVO0000017'),
(18, 3, 'MVO0000018'),
(19, 3, 'MVO0000019'),
(20, 3, 'MVO0000020'),
(21, 3, 'MVO0000021'),
(22, 3, 'MVO0000022'),
(23, 3, 'MVO0000023'),
(24, 3, 'MVO0000024'),
(25, 3, 'MVO0000025'),
(26, 3, 'MVO0000026'),
(27, 3, 'MVO0000027'),
(28, 3, 'MVO0000028'),
(29, 3, 'MVO0000029'),
(30, 3, 'MVO0000030'),
(31, 3, 'MVO0000031'),
(32, 3, 'MVO0000032'),
(33, 3, 'MVO0000033'),
(34, 3, 'MVO0000034'),
(35, 3, 'MVO0000035'),
(36, 3, 'MVO0000036'),
(37, 3, 'MVO0000037'),
(38, 3, 'MVO0000038'),
(39, 3, 'MVO0000039'),
(40, 3, 'MVO0000040'),
(41, 3, 'MVO0000041'),
(42, 3, 'MVO0000042'),
(43, 3, 'MVO0000043'),
(44, 3, 'MVO0000044'),
(45, 3, 'MVO0000045'),
(46, 3, 'MVO0000046'),
(47, 3, 'MVO0000047'),
(48, 3, 'MVO0000048'),
(49, 3, 'MVO0000049'),
(50, 3, 'MVO0000050'),
(51, 3, 'MVO0000051'),
(52, 3, 'MVO0000052'),
(53, 3, 'MVO0000053'),
(54, 3, 'MVO0000054'),
(55, 3, 'MVO0000055'),
(56, 3, 'MVO0000056'),
(57, 3, 'MVO0000057'),
(58, 3, 'MVO0000058'),
(59, 3, 'MVO0000059'),
(60, 3, 'MVO0000060'),
(61, 3, 'MVO0000061'),
(62, 3, 'MVO0000062'),
(63, 3, 'MVO0000063'),
(64, 3, 'MVO0000064'),
(65, 3, 'MVO0000065'),
(66, 3, 'MVO0000066'),
(67, 3, 'MVO0000067'),
(68, 3, 'MVO0000068'),
(69, 3, 'MVO0000069'),
(70, 3, 'MVO0000070'),
(71, 3, 'MVO0000071'),
(72, 3, 'MVO0000072'),
(73, 3, 'MVO0000073'),
(74, 3, 'MVO0000074'),
(75, 3, 'MVO0000075'),
(76, 3, 'MVO0000076'),
(77, 3, 'MVO0000077'),
(78, 3, 'MVO0000078'),
(79, 3, 'MVO0000079'),
(80, 3, 'MVO0000080'),
(81, 3, 'MVO0000081'),
(82, 3, 'MVO0000082'),
(83, 3, 'MVO0000083'),
(84, 3, 'MVO0000084'),
(85, 3, 'MVO0000085'),
(86, 3, 'MVO0000086'),
(87, 3, 'MVO0000087'),
(88, 3, 'MVO0000088'),
(89, 3, 'MVO0000089'),
(90, 3, 'MVO0000090'),
(91, 3, 'MVO0000091'),
(92, 3, 'MVO0000092'),
(93, 3, 'MVO0000093'),
(94, 3, 'MVO0000094'),
(95, 3, 'MVO0000095'),
(96, 3, 'MVO0000096'),
(97, 3, 'MVO0000097'),
(98, 3, 'MVO0000098'),
(99, 3, 'MVO0000099'),
(100, 3, 'MVO0000100');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_terima`
--

CREATE TABLE IF NOT EXISTS `voucher_terima` (
  `tvoucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `tvoucher_cust` int(11) DEFAULT NULL,
  `tvoucher_novoucher` varchar(50) DEFAULT NULL,
  `tvoucher_creator` varchar(50) DEFAULT NULL,
  `tvoucher_date_create` datetime DEFAULT NULL,
  `tvoucher_update` varchar(50) DEFAULT NULL,
  `tvoucher_date_update` datetime DEFAULT NULL,
  `tvoucher_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`tvoucher_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `voucher_terima`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_appointment_detail`
--
CREATE TABLE IF NOT EXISTS `vu_appointment_detail` (
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_customer`
--
CREATE TABLE IF NOT EXISTS `vu_customer` (
`cust_id` int(11)
,`cust_no` varchar(50)
,`cust_member` varchar(50)
,`cust_nama` varchar(50)
,`cust_panggilan` varchar(50)
,`cust_kelamin` enum('L','P')
,`cust_alamat` varchar(250)
,`cust_kota` varchar(100)
,`cust_kodepos` varchar(5)
,`cust_propinsi` varchar(100)
,`cust_negara` varchar(100)
,`cust_alamat2` varchar(250)
,`cust_kota2` varchar(150)
,`cust_kodepos2` varchar(5)
,`cust_propinsi2` varchar(100)
,`cust_negara2` varchar(100)
,`cust_telprumah` varchar(30)
,`cust_telprumah2` varchar(30)
,`cust_telpkantor` varchar(100)
,`cust_hp` varchar(25)
,`cust_hp2` varchar(25)
,`cust_hp3` varchar(25)
,`cust_email` varchar(100)
,`cust_email2` varchar(100)
,`cust_agama` varchar(50)
,`cust_pendidikan` varchar(50)
,`cust_profesi` varchar(100)
,`cust_tgllahir` date
,`cust_hobi` varchar(500)
,`cust_referensi` int(250)
,`cust_referensilain` varchar(250)
,`cust_keterangan` varchar(500)
,`cust_terdaftar` date
,`cust_statusnikah` enum('menikah','belum menikah')
,`cust_jmlanak` int(11)
,`cust_unit` int(11)
,`cust_aktif` enum('Aktif','Tidak Aktif')
,`cust_creator` varchar(50)
,`cust_date_create` datetime
,`cust_update` varchar(50)
,`cust_date_update` datetime
,`cust_revised` int(11)
,`cust_nama_ref` varchar(50)
,`cabang_nama` varchar(250)
,`cabang_alamat` varchar(250)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_drbeli`
--
CREATE TABLE IF NOT EXISTS `vu_drbeli` (
`rbeli_id` int(11)
,`rbeli_nobukti` varchar(100)
,`rbeli_terima` int(11)
,`rbeli_supplier` int(11)
,`rbeli_tanggal` date
,`rbeli_keterangan` varchar(500)
,`rbeli_creator` varchar(50)
,`rbeli_date_create` datetime
,`rbeli_update` varchar(50)
,`rbeli_date_update` datetime
,`rbeli_revised` int(11)
,`terima_id` int(11)
,`terima_no` varchar(50)
,`terima_order` int(11)
,`terima_supplier` int(11)
,`terima_surat_jalan` varchar(30)
,`terima_pengirim` varchar(30)
,`terima_tanggal` date
,`terima_keterangan` varchar(500)
,`terima_creator` varchar(50)
,`terima_date_create` datetime
,`terima_update` varchar(50)
,`terima_date_update` datetime
,`terima_revised` int(11)
,`order_id` int(11)
,`order_no` varchar(50)
,`order_supplier` int(11)
,`order_tanggal` date
,`order_carabayar` enum('tunai','kredit','konsinyasi')
,`order_diskon` float
,`order_biaya` double
,`order_bayar` double
,`order_keterangan` varchar(500)
,`order_creator` varchar(50)
,`order_date_create` datetime
,`order_update` varchar(50)
,`order_date_update` datetime
,`order_revised` int(11)
,`dorder_id` int(11)
,`dorder_master` int(11)
,`dorder_produk` int(11)
,`dorder_satuan` int(11)
,`dorder_jumlah` int(11)
,`dorder_harga` double
,`dorder_diskon` float
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_menus`
--
CREATE TABLE IF NOT EXISTS `vu_menus` (
`menu_id` int(11)
,`menu_parent` int(11)
,`menu_position` int(11)
,`menu_title` varchar(250)
,`menu_link` varchar(250)
,`menu_cat` enum('window','url')
,`menu_confirm` enum('Y','N')
,`menu_leftpanel` enum('N','Y')
,`menu_iconpanel` varchar(50)
,`menu_iconmenu` varchar(50)
,`perm_priv` varchar(5)
,`group_id` int(11)
,`group_name` varchar(50)
,`group_desc` varchar(250)
,`group_active` enum('Aktif','Tidak Aktif')
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_paket`
--
CREATE TABLE IF NOT EXISTS `vu_paket` (
`jpaket_nobukti` varchar(30)
,`jpaket_cust` int(11)
,`jpaket_tanggal` date
,`jpaket_diskon` float
,`jpaket_cashback` double
,`dpaket_master` int(11)
,`dpaket_paket` int(11)
,`dpaket_kadaluarsa` date
,`dpaket_jumlah` int(11)
,`dpaket_harga` float
,`dpaket_diskon` int(11)
,`dpaket_diskon_jenis` varchar(10)
,`dpaket_sales` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_perawatan`
--
CREATE TABLE IF NOT EXISTS `vu_perawatan` (
`rawat_id` int(11)
,`rawat_kode` varchar(20)
,`rawat_nama` varchar(250)
,`rawat_group` int(11)
,`group_nama` varchar(250)
,`rawat_kategori` int(11)
,`kategori_nama` varchar(250)
,`kategori_jenis` enum('produk','perawatan')
,`kategori_akun` int(11)
,`rawat_keterangan` varchar(250)
,`rawat_du` int(11)
,`rawat_dm` int(11)
,`rawat_point` int(11)
,`rawat_harga` double
,`rawat_aktif` enum('Aktif','Tidak Aktif')
,`rawat_gudang` int(11)
,`gudang_nama` varchar(250)
,`gudang_lokasi` varchar(250)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_perawatan_alat`
--
CREATE TABLE IF NOT EXISTS `vu_perawatan_alat` (
`rawat_id` int(11)
,`rawat_kode` varchar(20)
,`rawat_nama` varchar(250)
,`rawat_group` int(11)
,`group_nama` varchar(250)
,`rawat_kategori` int(11)
,`kategori_nama` varchar(250)
,`kategori_jenis` enum('produk','perawatan')
,`kategori_akun` int(11)
,`rawat_keterangan` varchar(250)
,`rawat_du` int(11)
,`rawat_dm` int(11)
,`rawat_point` int(11)
,`rawat_harga` double
,`rawat_aktif` enum('Aktif','Tidak Aktif')
,`rawat_gudang` int(11)
,`gudang_nama` varchar(250)
,`gudang_lokasi` varchar(250)
,`arawat_alat` int(11)
,`arawat_jumlah` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_perawatan_konsumsi`
--
CREATE TABLE IF NOT EXISTS `vu_perawatan_konsumsi` (
`rawat_id` int(11)
,`rawat_kode` varchar(20)
,`rawat_nama` varchar(250)
,`rawat_group` int(11)
,`group_nama` varchar(250)
,`rawat_kategori` int(11)
,`kategori_nama` varchar(250)
,`kategori_jenis` enum('produk','perawatan')
,`kategori_akun` int(11)
,`rawat_keterangan` varchar(250)
,`rawat_du` int(11)
,`rawat_dm` int(11)
,`rawat_point` int(11)
,`rawat_harga` double
,`rawat_aktif` enum('Aktif','Tidak Aktif')
,`rawat_gudang` int(11)
,`gudang_nama` varchar(250)
,`gudang_lokasi` varchar(250)
,`produk_kode` varchar(20)
,`produk_nama` varchar(250)
,`satuan_konversi` varchar(250)
,`konversi_satuan` int(11)
,`konversi_nilai` float(11,0)
,`krawat_jumlah` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_produk`
--
CREATE TABLE IF NOT EXISTS `vu_produk` (
`produk_id` int(11)
,`produk_kode` varchar(20)
,`produk_group` int(11)
,`group_nama` varchar(250)
,`produk_kategori` int(11)
,`kategori_nama` varchar(250)
,`kategori_jenis` enum('produk','perawatan')
,`kategori_akun` int(11)
,`produk_nama` varchar(250)
,`produk_satuan` int(11)
,`satuan_nama` varchar(250)
,`produk_du` int(11)
,`produk_dm` int(11)
,`produk_point` int(11)
,`produk_harga` double
,`produk_aktif` enum('Aktif','Tidak Aktif')
,`produk_jenis` int(11)
,`jenis_kode` varchar(10)
,`jenis_nama` varchar(250)
,`jenis_kelompok` enum('perawatan','produk')
,`produk_kontribusi` int(11)
,`kategori2_nama` varchar(250)
,`kategori2_jenis` enum('produk','perawatan')
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_produk_konversi`
--
CREATE TABLE IF NOT EXISTS `vu_produk_konversi` (
`produk_id` int(11)
,`produk_kode` varchar(20)
,`produk_group` int(11)
,`group_nama` varchar(250)
,`produk_kategori` int(11)
,`kategori_nama` varchar(250)
,`kategori_jenis` enum('produk','perawatan')
,`kategori_akun` int(11)
,`produk_nama` varchar(250)
,`produk_satuan` int(11)
,`satuan_nama` varchar(250)
,`produk_du` int(11)
,`produk_dm` int(11)
,`produk_point` int(11)
,`produk_harga` double
,`produk_aktif` enum('Aktif','Tidak Aktif')
,`konversi_satuan` int(11)
,`satuan_konversi` varchar(250)
,`konversi_nilai` float(11,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_tindakan`
--
CREATE TABLE IF NOT EXISTS `vu_tindakan` (
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_tindakanlist`
--
CREATE TABLE IF NOT EXISTS `vu_tindakanlist` (
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_invoice_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_invoice_group` (
`dinvoice_master` int(11)
,`jumlah_barang` decimal(32,0)
,`total_nilai` double
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_jual_paket_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_jual_paket_group` (
`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`dpaket_master` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_jual_produk_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_jual_produk_group` (
`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`dproduk_master` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_jual_rawat_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_jual_rawat_group` (
`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`drawat_master` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_order_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_order_group` (
`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`dorder_master` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_retur_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_retur_group` (
`drbeli_master` int(11)
,`jumlah_barang` decimal(32,0)
,`total_nilai` double
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_terima_bonus_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_terima_bonus_group` (
`dtbonus_master` int(11)
,`jumlah_barang_bonus` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_total_terima_group`
--
CREATE TABLE IF NOT EXISTS `vu_total_terima_group` (
`jumlah_barang` decimal(32,0)
,`dterima_master` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_trans_paket`
--
CREATE TABLE IF NOT EXISTS `vu_trans_paket` (
`no_bukti` varchar(30)
,`cust_id` int(11)
,`tanggal` date
,`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`cust_no` varchar(50)
,`cust_member` varchar(50)
,`cust_nama` varchar(50)
,`cust_kelamin` enum('L','P')
,`cust_alamat` varchar(250)
,`cust_kota` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_trans_produk`
--
CREATE TABLE IF NOT EXISTS `vu_trans_produk` (
`no_bukti` varchar(30)
,`cust_id` int(11)
,`tanggal` date
,`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`cust_no` varchar(50)
,`cust_member` varchar(50)
,`cust_nama` varchar(50)
,`cust_kelamin` enum('L','P')
,`cust_alamat` varchar(250)
,`cust_kota` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_trans_rawat`
--
CREATE TABLE IF NOT EXISTS `vu_trans_rawat` (
`no_bukti` varchar(30)
,`cust_id` int(11)
,`tanggal` date
,`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`cust_no` varchar(50)
,`cust_member` varchar(50)
,`cust_nama` varchar(50)
,`cust_kelamin` enum('L','P')
,`cust_alamat` varchar(250)
,`cust_kota` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vu_trans_union`
--
CREATE TABLE IF NOT EXISTS `vu_trans_union` (
`no_bukti` varchar(30)
,`cust_id` int(11)
,`tanggal` date
,`jumlah_barang` decimal(32,0)
,`total_nilai` double
,`cust_no` varchar(50)
,`cust_member` varchar(50)
,`cust_nama` varchar(50)
,`cust_kelamin` varchar(1)
,`cust_alamat` varchar(250)
,`cust_kota` varchar(100)
);
-- --------------------------------------------------------

--
-- Structure for view `vu_appointment_detail`
--
DROP TABLE IF EXISTS `vu_appointment_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_appointment_detail` AS select `appointment`.`app_customer` AS `app_customer`,`appointment`.`app_tanggal` AS `app_tanggal`,`appointment`.`app_cara` AS `app_cara`,`appointment_detail`.`dapp_id` AS `dapp_id`,`appointment_detail`.`dapp_perawatan` AS `dapp_perawatan`,`miracledb`.`appointment_detail`.`dapp_reservasi` AS `dapp_reservasi`,`miracledb`.`appointment_detail`.`dapp_jam` AS `dapp_jam`,`miracledb`.`appointment_detail`.`dapp_tenaga` AS `dapp_tenaga`,`miracledb`.`appointment_detail`.`dapp_tenaga2` AS `dapp_tenaga2`,`miracledb`.`appointment_detail`.`dapp_status` AS `dapp_status` from (`appointment` join `appointment_detail` on((`miracledb`.`appointment`.`app_id` = `miracledb`.`appointment_detail`.`dapp_master`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_customer`
--
DROP TABLE IF EXISTS `vu_customer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `vu_customer` AS select `customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`customer`.`cust_kodepos` AS `cust_kodepos`,`customer`.`cust_propinsi` AS `cust_propinsi`,`customer`.`cust_negara` AS `cust_negara`,`customer`.`cust_alamat2` AS `cust_alamat2`,`customer`.`cust_kota2` AS `cust_kota2`,`customer`.`cust_kodepos2` AS `cust_kodepos2`,`customer`.`cust_propinsi2` AS `cust_propinsi2`,`customer`.`cust_negara2` AS `cust_negara2`,`customer`.`cust_telprumah` AS `cust_telprumah`,`customer`.`cust_telprumah2` AS `cust_telprumah2`,`customer`.`cust_telpkantor` AS `cust_telpkantor`,`customer`.`cust_hp` AS `cust_hp`,`customer`.`cust_hp2` AS `cust_hp2`,`customer`.`cust_hp3` AS `cust_hp3`,`customer`.`cust_email` AS `cust_email`,`customer`.`cust_email2` AS `cust_email2`,`customer`.`cust_agama` AS `cust_agama`,`customer`.`cust_pendidikan` AS `cust_pendidikan`,`customer`.`cust_profesi` AS `cust_profesi`,`customer`.`cust_tgllahir` AS `cust_tgllahir`,`customer`.`cust_hobi` AS `cust_hobi`,`customer`.`cust_referensi` AS `cust_referensi`,`customer`.`cust_referensilain` AS `cust_referensilain`,`customer`.`cust_keterangan` AS `cust_keterangan`,`customer`.`cust_terdaftar` AS `cust_terdaftar`,`customer`.`cust_statusnikah` AS `cust_statusnikah`,`customer`.`cust_jmlanak` AS `cust_jmlanak`,`customer`.`cust_unit` AS `cust_unit`,`customer`.`cust_aktif` AS `cust_aktif`,`customer`.`cust_creator` AS `cust_creator`,`customer`.`cust_date_create` AS `cust_date_create`,`customer`.`cust_update` AS `cust_update`,`customer`.`cust_date_update` AS `cust_date_update`,`customer`.`cust_revised` AS `cust_revised`,`cust_ref`.`cust_nama` AS `cust_nama_ref`,`cabang`.`cabang_nama` AS `cabang_nama`,`cabang`.`cabang_alamat` AS `cabang_alamat` from ((`customer` left join `customer` `cust_ref` on((`customer`.`cust_referensi` = `cust_ref`.`cust_id`))) left join `cabang` on((`customer`.`cust_unit` = `cabang`.`cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_drbeli`
--
DROP TABLE IF EXISTS `vu_drbeli`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_drbeli` AS select `master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`master_retur_beli`.`rbeli_keterangan` AS `rbeli_keterangan`,`master_retur_beli`.`rbeli_creator` AS `rbeli_creator`,`master_retur_beli`.`rbeli_date_create` AS `rbeli_date_create`,`master_retur_beli`.`rbeli_update` AS `rbeli_update`,`master_retur_beli`.`rbeli_date_update` AS `rbeli_date_update`,`master_retur_beli`.`rbeli_revised` AS `rbeli_revised`,`master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,`master_order_beli`.`order_id` AS `order_id`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`master_order_beli`.`order_creator` AS `order_creator`,`master_order_beli`.`order_date_create` AS `order_date_create`,`master_order_beli`.`order_update` AS `order_update`,`master_order_beli`.`order_date_update` AS `order_date_update`,`master_order_beli`.`order_revised` AS `order_revised`,`detail_order_beli`.`dorder_id` AS `dorder_id`,`detail_order_beli`.`dorder_master` AS `dorder_master`,`detail_order_beli`.`dorder_produk` AS `dorder_produk`,`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,`detail_order_beli`.`dorder_jumlah` AS `dorder_jumlah`,`detail_order_beli`.`dorder_harga` AS `dorder_harga`,`detail_order_beli`.`dorder_diskon` AS `dorder_diskon` from (((`master_retur_beli` join `master_terima_beli`) join `master_order_beli`) join `detail_order_beli`) where ((`master_retur_beli`.`rbeli_terima` = `master_terima_beli`.`terima_id`) and (`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`) and (`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`));

-- --------------------------------------------------------

--
-- Structure for view `vu_menus`
--
DROP TABLE IF EXISTS `vu_menus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_menus` AS select `menus`.`menu_id` AS `menu_id`,`menus`.`menu_parent` AS `menu_parent`,`menus`.`menu_position` AS `menu_position`,`menus`.`menu_title` AS `menu_title`,`menus`.`menu_link` AS `menu_link`,`menus`.`menu_cat` AS `menu_cat`,`menus`.`menu_confirm` AS `menu_confirm`,`menus`.`menu_leftpanel` AS `menu_leftpanel`,`menus`.`menu_iconpanel` AS `menu_iconpanel`,`menus`.`menu_iconmenu` AS `menu_iconmenu`,`permissions`.`perm_priv` AS `perm_priv`,`usergroups`.`group_id` AS `group_id`,`usergroups`.`group_name` AS `group_name`,`usergroups`.`group_desc` AS `group_desc`,`usergroups`.`group_active` AS `group_active` from ((`permissions` join `menus` on((`permissions`.`perm_menu` = `menus`.`menu_id`))) join `usergroups` on((`permissions`.`perm_group` = `usergroups`.`group_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_paket`
--
DROP TABLE IF EXISTS `vu_paket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_paket` AS select `master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_diskon` AS `jpaket_diskon`,`master_jual_paket`.`jpaket_cashback` AS `jpaket_cashback`,`detail_jual_paket`.`dpaket_master` AS `dpaket_master`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,`detail_jual_paket`.`dpaket_kadaluarsa` AS `dpaket_kadaluarsa`,`detail_jual_paket`.`dpaket_jumlah` AS `dpaket_jumlah`,`detail_jual_paket`.`dpaket_harga` AS `dpaket_harga`,`detail_jual_paket`.`dpaket_diskon` AS `dpaket_diskon`,`detail_jual_paket`.`dpaket_diskon_jenis` AS `dpaket_diskon_jenis`,`detail_jual_paket`.`dpaket_sales` AS `dpaket_sales` from (`master_jual_paket` join `detail_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_perawatan`
--
DROP TABLE IF EXISTS `vu_perawatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_perawatan` AS select `perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_kode` AS `rawat_kode`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_group` AS `rawat_group`,`produk_group`.`group_nama` AS `group_nama`,`perawatan`.`rawat_kategori` AS `rawat_kategori`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`perawatan`.`rawat_point` AS `rawat_point`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_aktif` AS `rawat_aktif`,`perawatan`.`rawat_gudang` AS `rawat_gudang`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi` from (((`perawatan` join `produk_group` on((`perawatan`.`rawat_group` = `produk_group`.`group_id`))) join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) join `gudang` on((`perawatan`.`rawat_gudang` = `gudang`.`gudang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_perawatan_alat`
--
DROP TABLE IF EXISTS `vu_perawatan_alat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_perawatan_alat` AS select `vu_perawatan`.`rawat_id` AS `rawat_id`,`vu_perawatan`.`rawat_kode` AS `rawat_kode`,`vu_perawatan`.`rawat_nama` AS `rawat_nama`,`vu_perawatan`.`rawat_group` AS `rawat_group`,`vu_perawatan`.`group_nama` AS `group_nama`,`vu_perawatan`.`rawat_kategori` AS `rawat_kategori`,`vu_perawatan`.`kategori_nama` AS `kategori_nama`,`vu_perawatan`.`kategori_jenis` AS `kategori_jenis`,`vu_perawatan`.`kategori_akun` AS `kategori_akun`,`vu_perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`vu_perawatan`.`rawat_du` AS `rawat_du`,`vu_perawatan`.`rawat_dm` AS `rawat_dm`,`vu_perawatan`.`rawat_point` AS `rawat_point`,`vu_perawatan`.`rawat_harga` AS `rawat_harga`,`vu_perawatan`.`rawat_aktif` AS `rawat_aktif`,`vu_perawatan`.`rawat_gudang` AS `rawat_gudang`,`vu_perawatan`.`gudang_nama` AS `gudang_nama`,`vu_perawatan`.`gudang_lokasi` AS `gudang_lokasi`,`perawatan_alat`.`arawat_alat` AS `arawat_alat`,`perawatan_alat`.`arawat_jumlah` AS `arawat_jumlah` from (`vu_perawatan` join `perawatan_alat` on((`perawatan_alat`.`arawat_master` = `vu_perawatan`.`rawat_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_perawatan_konsumsi`
--
DROP TABLE IF EXISTS `vu_perawatan_konsumsi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_perawatan_konsumsi` AS select `vu_perawatan`.`rawat_id` AS `rawat_id`,`vu_perawatan`.`rawat_kode` AS `rawat_kode`,`vu_perawatan`.`rawat_nama` AS `rawat_nama`,`vu_perawatan`.`rawat_group` AS `rawat_group`,`vu_perawatan`.`group_nama` AS `group_nama`,`vu_perawatan`.`rawat_kategori` AS `rawat_kategori`,`vu_perawatan`.`kategori_nama` AS `kategori_nama`,`vu_perawatan`.`kategori_jenis` AS `kategori_jenis`,`vu_perawatan`.`kategori_akun` AS `kategori_akun`,`vu_perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`vu_perawatan`.`rawat_du` AS `rawat_du`,`vu_perawatan`.`rawat_dm` AS `rawat_dm`,`vu_perawatan`.`rawat_point` AS `rawat_point`,`vu_perawatan`.`rawat_harga` AS `rawat_harga`,`vu_perawatan`.`rawat_aktif` AS `rawat_aktif`,`vu_perawatan`.`rawat_gudang` AS `rawat_gudang`,`vu_perawatan`.`gudang_nama` AS `gudang_nama`,`vu_perawatan`.`gudang_lokasi` AS `gudang_lokasi`,`vu_produk_konversi`.`produk_kode` AS `produk_kode`,`vu_produk_konversi`.`produk_nama` AS `produk_nama`,`vu_produk_konversi`.`satuan_konversi` AS `satuan_konversi`,`vu_produk_konversi`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_konversi`.`konversi_nilai` AS `konversi_nilai`,`perawatan_konsumsi`.`krawat_jumlah` AS `krawat_jumlah` from ((`vu_perawatan` join `perawatan_konsumsi` on((`perawatan_konsumsi`.`krawat_master` = `vu_perawatan`.`rawat_id`))) join `vu_produk_konversi` on(((`perawatan_konsumsi`.`krawat_produk` = `vu_produk_konversi`.`produk_id`) and (`perawatan_konsumsi`.`krawat_satuan` = `vu_produk_konversi`.`konversi_satuan`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_produk`
--
DROP TABLE IF EXISTS `vu_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_produk` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_group` AS `produk_group`,`produk_group`.`group_nama` AS `group_nama`,`produk`.`produk_kategori` AS `produk_kategori`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_jenis` AS `produk_jenis`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis` from (((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk`.`produk_kategori` = `kategori`.`kategori_id`))) left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_produk_konversi`
--
DROP TABLE IF EXISTS `vu_produk_konversi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_produk_konversi` AS select `vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`kategori_akun` AS `kategori_akun`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`satuan_nama` AS `satuan_nama`,`vu_produk`.`produk_du` AS `produk_du`,`vu_produk`.`produk_dm` AS `produk_dm`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_harga` AS `produk_harga`,`vu_produk`.`produk_aktif` AS `produk_aktif`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_nama` AS `satuan_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai` from ((`vu_produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_tindakan`
--
DROP TABLE IF EXISTS `vu_tindakan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_tindakan` AS select `miracledb`.`tindakan_rawat`.`trawat_id` AS `trawat_id`,`miracledb`.`tindakan_rawat`.`trawat_cust` AS `trawat_cust`,`miracledb`.`customer`.`cust_nama` AS `cust_nama`,`miracledb`.`tindakan_rawat`.`trawat_petugas` AS `trawat_petugas`,`miracledb`.`tindakan_rawat`.`trawat_petugas2` AS `trawat_petugas2`,`miracledb`.`tindakan_rawat`.`trawat_keterangan` AS `trawat_keterangan`,`miracledb`.`tindakan_rawat`.`trawat_creator` AS `trawat_creator`,`miracledb`.`tindakan_rawat`.`trawat_date_create` AS `trawat_date_create`,`miracledb`.`tindakan_rawat`.`trawat_update` AS `trawat_update`,`miracledb`.`tindakan_rawat`.`trawat_date_update` AS `trawat_date_update`,`petugas1`.`karyawan_nama` AS `petugas_nama1`,`petugas2`.`karyawan_nama` AS `petugas_nama2` from (((`tindakan_rawat` join `customer` on((`miracledb`.`tindakan_rawat`.`trawat_cust` = `miracledb`.`customer`.`cust_id`))) left join `karyawan` `petugas1` on((('' = '') and (`miracledb`.`tindakan_rawat`.`trawat_petugas` = `petugas1`.`karyawan_id`)))) left join `karyawan` `petugas2` on((`miracledb`.`tindakan_rawat`.`trawat_petugas2` = `petugas2`.`karyawan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_tindakanlist`
--
DROP TABLE IF EXISTS `vu_tindakanlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_tindakanlist` AS select `tindakan`.`trawat_id` AS `trawat_id`,`tindakan`.`trawat_cust` AS `trawat_cust`,`miracledb`.`tindakan`.`trawat_perawatan` AS `trawat_perawatan`,`miracledb`.`tindakan`.`trawat_jam` AS `trawat_jam`,`miracledb`.`tindakan`.`trawat_petugas` AS `trawat_petugas`,`miracledb`.`tindakan`.`trawat_petugas2` AS `trawat_petugas2` from `tindakan`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_invoice_group`
--
DROP TABLE IF EXISTS `vu_total_invoice_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_invoice_group` AS select `detail_invoice`.`dinvoice_master` AS `dinvoice_master`,sum(`detail_invoice`.`dinvoice_jumlah`) AS `jumlah_barang`,sum((((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100)) AS `total_nilai` from `detail_invoice` group by `detail_invoice`.`dinvoice_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_paket_group`
--
DROP TABLE IF EXISTS `vu_total_jual_paket_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_jual_paket_group` AS select ifnull(sum(`detail_jual_paket`.`dpaket_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * (100 - `detail_jual_paket`.`dpaket_diskon`)) / 100)),0) AS `total_nilai`,`detail_jual_paket`.`dpaket_master` AS `dpaket_master` from `detail_jual_paket` group by `detail_jual_paket`.`dpaket_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_produk_group`
--
DROP TABLE IF EXISTS `vu_total_jual_produk_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_jual_produk_group` AS select ifnull(sum(`detail_jual_produk`.`dproduk_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_jumlah`) * (100 - `detail_jual_produk`.`dproduk_diskon`)) / 100)),0) AS `total_nilai`,`detail_jual_produk`.`dproduk_master` AS `dproduk_master` from `detail_jual_produk` group by `detail_jual_produk`.`dproduk_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_rawat_group`
--
DROP TABLE IF EXISTS `vu_total_jual_rawat_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_jual_rawat_group` AS select ifnull(sum(`detail_jual_rawat`.`drawat_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) * (100 - `detail_jual_rawat`.`drawat_diskon`)) / 100)),0) AS `total_nilai`,`detail_jual_rawat`.`drawat_master` AS `drawat_master` from `detail_jual_rawat` group by `detail_jual_rawat`.`drawat_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_order_group`
--
DROP TABLE IF EXISTS `vu_total_order_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `vu_total_order_group` AS select sum(`detail_order_beli`.`dorder_jumlah`) AS `jumlah_barang`,sum((((`detail_order_beli`.`dorder_harga` * `detail_order_beli`.`dorder_jumlah`) * (100 - `detail_order_beli`.`dorder_diskon`)) / 100)) AS `total_nilai`,`detail_order_beli`.`dorder_master` AS `dorder_master` from `detail_order_beli` group by `detail_order_beli`.`dorder_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_retur_group`
--
DROP TABLE IF EXISTS `vu_total_retur_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_retur_group` AS select `detail_retur_beli`.`drbeli_master` AS `drbeli_master`,sum(`detail_retur_beli`.`drbeli_jumlah`) AS `jumlah_barang`,sum((`detail_retur_beli`.`drbeli_harga` * `detail_retur_beli`.`drbeli_jumlah`)) AS `total_nilai` from `detail_retur_beli` group by `detail_retur_beli`.`drbeli_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_terima_bonus_group`
--
DROP TABLE IF EXISTS `vu_total_terima_bonus_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_terima_bonus_group` AS select `detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,sum(`detail_terima_bonus`.`dtbonus_jumlah`) AS `jumlah_barang_bonus` from `detail_terima_bonus` group by `detail_terima_bonus`.`dtbonus_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_terima_group`
--
DROP TABLE IF EXISTS `vu_total_terima_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_total_terima_group` AS select sum(`detail_terima_beli`.`dterima_jumlah`) AS `jumlah_barang`,`detail_terima_beli`.`dterima_master` AS `dterima_master` from `detail_terima_beli` group by `detail_terima_beli`.`dterima_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_paket`
--
DROP TABLE IF EXISTS `vu_trans_paket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_trans_paket` AS select `master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,`master_jual_paket`.`jpaket_cust` AS `cust_id`,`master_jual_paket`.`jpaket_tanggal` AS `tanggal`,ifnull(`vu_total_jual_paket_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_paket_group`.`total_nilai`,0) AS `total_nilai`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota` from ((`master_jual_paket` left join `vu_total_jual_paket_group` on((`vu_total_jual_paket_group`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) join `vu_customer` on((`master_jual_paket`.`jpaket_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_produk`
--
DROP TABLE IF EXISTS `vu_trans_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_trans_produk` AS select `master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_cust` AS `cust_id`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,ifnull(`vu_total_jual_produk_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_produk_group`.`total_nilai`,0) AS `total_nilai`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota` from ((`master_jual_produk` left join `vu_total_jual_produk_group` on((`vu_total_jual_produk_group`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) join `vu_customer` on((`master_jual_produk`.`jproduk_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_rawat`
--
DROP TABLE IF EXISTS `vu_trans_rawat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_trans_rawat` AS select `master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,`master_jual_rawat`.`jrawat_cust` AS `cust_id`,`master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,ifnull(`vu_total_jual_rawat_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_rawat_group`.`total_nilai`,0) AS `total_nilai`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota` from ((`master_jual_rawat` left join `vu_total_jual_rawat_group` on((`vu_total_jual_rawat_group`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) join `vu_customer` on((`master_jual_rawat`.`jrawat_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_union`
--
DROP TABLE IF EXISTS `vu_trans_union`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vu_trans_union` AS select `vu_trans_produk`.`no_bukti` AS `no_bukti`,`vu_trans_produk`.`cust_id` AS `cust_id`,`vu_trans_produk`.`tanggal` AS `tanggal`,`vu_trans_produk`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_produk`.`total_nilai` AS `total_nilai`,`vu_trans_produk`.`cust_no` AS `cust_no`,`vu_trans_produk`.`cust_member` AS `cust_member`,`vu_trans_produk`.`cust_nama` AS `cust_nama`,`vu_trans_produk`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_produk`.`cust_alamat` AS `cust_alamat`,`vu_trans_produk`.`cust_kota` AS `cust_kota` from `vu_trans_produk` union select `vu_trans_rawat`.`no_bukti` AS `no_bukti`,`vu_trans_rawat`.`cust_id` AS `cust_id`,`vu_trans_rawat`.`tanggal` AS `tanggal`,`vu_trans_rawat`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_rawat`.`total_nilai` AS `total_nilai`,`vu_trans_rawat`.`cust_no` AS `cust_no`,`vu_trans_rawat`.`cust_member` AS `cust_member`,`vu_trans_rawat`.`cust_nama` AS `cust_nama`,`vu_trans_rawat`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_rawat`.`cust_alamat` AS `cust_alamat`,`vu_trans_rawat`.`cust_kota` AS `cust_kota` from `vu_trans_rawat` union select `vu_trans_paket`.`no_bukti` AS `no_bukti`,`vu_trans_paket`.`cust_id` AS `cust_id`,`vu_trans_paket`.`tanggal` AS `tanggal`,`vu_trans_paket`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_paket`.`total_nilai` AS `total_nilai`,`vu_trans_paket`.`cust_no` AS `cust_no`,`vu_trans_paket`.`cust_member` AS `cust_member`,`vu_trans_paket`.`cust_nama` AS `cust_nama`,`vu_trans_paket`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_paket`.`cust_alamat` AS `cust_alamat`,`vu_trans_paket`.`cust_kota` AS `cust_kota` from `vu_trans_paket`;
