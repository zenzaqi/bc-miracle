-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2010 at 03:01 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

TRUNCATE TABLE menus;
--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_parent`, `menu_position`, `menu_title`, `menu_link`, `menu_cat`, `menu_confirm`, `menu_leftpanel`, `menu_iconpanel`, `menu_iconmenu`) VALUES
(1, 0, 1, 'File', '', 'window', 'N', 'Y', NULL, NULL),
(2, 0, 2, 'Data Master', '', 'window', 'N', 'Y', NULL, NULL),
(3, 0, 3, 'Inventory', '', 'window', 'N', 'Y', NULL, NULL),
(4, 0, 5, 'Kasir', '', 'window', 'N', 'Y', NULL, NULL),
(28, 2, 15, 'Jabatan', '?c=c_jabatan', 'window', 'N', 'Y', 'jabatan48.png', 'jabatan16.png'),
(5, 0, 4, 'Customer Service', '', 'window', 'N', 'Y', NULL, NULL),
(7, 0, 7, 'Perawatan', '', 'window', 'N', 'Y', 'perawatan48.png', 'perawatan16.png'),
(8, 0, 8, 'Akuntansi', '', 'window', 'N', 'Y', 'akun48.png', 'akun16.png'),
(9, 0, 9, 'Laporan', '', 'window', 'N', 'Y', NULL, NULL),
(10, 0, 10, 'Help', '', 'window', 'N', 'Y', NULL, NULL),
(12, 1, 3, 'Users', '?c=c_users', 'window', 'N', 'Y', 'manajemen_users48.png', 'manajemen_users16.png'),
(13, 1, 1, 'Info Setting', '?c=c_info', 'window', 'N', 'Y', 'info_setting48.png', 'info_setting16.png'),
(14, 1, 4, 'Logout', '?c=c_login&m=logout', 'url', 'Y', 'Y', 'logout48.png', 'logout16.png'),
(15, 2, 3, 'Jenis', '?c=c_kategori', 'window', 'N', 'Y', 'kategori48.png', 'kategori16.png'),
(16, 2, 1, 'Group 1', '?c=c_produk_group', 'window', 'N', 'Y', 'group48.png', 'group16.png'),
(17, 2, 5, 'Produk', '?c=c_produk', 'window', 'N', 'Y', 'produk48.png', 'produk16.png'),
(18, 2, 6, 'Perawatan', '?c=c_perawatan', 'window', 'N', 'Y', 'perawatan48.png', 'perawatan16.png'),
(19, 2, 7, 'Paket', '?c=c_paket', 'window', 'N', 'Y', 'paket48.png', 'paket16.png'),
(20, 2, 8, 'Satuan', '?c=c_satuan', 'window', 'N', 'Y', 'satuan48.png', 'satuan16.png'),
(21, 2, 9, 'Gudang', '?c=c_gudang', 'window', 'N', 'Y', 'gudang48.png', 'gudang16.png'),
(22, 2, 16, 'Supplier', '?c=c_supplier', 'window', 'N', 'Y', 'supplier48.png', 'supplier16.png'),
(23, 2, 10, 'Peralatan Medis', '?c=c_alat', 'window', 'N', 'Y', 'alat_medis48.png', 'alat_medis16.png'),
(24, 2, 13, 'Karyawan', '?c=c_karyawan', 'window', 'N', 'Y', 'karyawan48.png', 'karyawan16.png'),
(25, 2, 17, 'Akun', '?c=c_akun', 'window', 'N', 'Y', 'akun48.png', 'akun16.png'),
(26, 2, 19, 'Rekening', '?c=c_bank', 'window', 'N', 'Y', 'bank48.png', 'bank16.png'),
(31, 3, 1, 'Order Pembelian', '?c=c_master_order_beli', 'window', 'N', 'Y', 'order_pembelian48.png', 'order_pembelian16.png'),
(32, 3, 2, 'Penerimaan Pembelian', '?c=c_master_terima_beli', 'window', 'N', 'Y', 'terima_pembelian48.png', 'terima_pembelian16.png'),
(33, 3, 3, 'Penerimaan Invoice', '?c=c_master_invoice', 'window', 'N', 'Y', 'invoice48.png', 'invoice16.png'),
(34, 3, 4, 'Retur Pembelian', '?c=c_master_retur_beli', 'window', 'N', 'Y', 'retur_pembelian48.png', 'retur_pembelian16.png'),
(35, 3, 5, 'Mutasi Barang', '?c=c_master_mutasi', 'window', 'N', 'Y', 'mutasi_barang48.png', 'mutasi_barang16.png'),
(36, 3, 6, 'Penyesuaian Stok', '?c=c_master_koreksi_stok', 'window', 'N', 'Y', 'penyesuaian_stok48.png', 'penyesuaian_stok16.png'),
(37, 4, 1, 'Penjualan Produk', '?c=c_master_jual_produk', 'window', 'N', 'Y', 'jual_produk48.png', 'jual_produk16.png'),
(38, 4, 2, 'Penjualan Perawatan', '?c=c_master_jual_rawat', 'window', 'N', 'Y', 'jual_perawatan48.png', 'jual_perawatan16.png'),
(39, 4, 3, 'Penjualan Paket', '?c=c_master_jual_paket', 'window', 'N', 'Y', 'jual_paket48.png', 'jual_paket16.png'),
(40, 4, 4, 'Retur Penjualan Produk', '?c=c_master_retur_jual_produk', 'window', 'N', 'Y', 'retur_jual_produk48.png', 'retur_jual_produk16.png'),
(41, 4, 5, 'Retur Penjualan Paket', '?c=c_master_retur_jual_paket', 'window', 'N', 'Y', 'retur_jual_paket48.png', 'retur_jual_paket16.png'),
(42, 4, 6, 'Pengambilan Paket', '?c=c_master_ambil_paket', 'window', 'N', 'Y', 'ambil_paket48.png', 'ambil_paket16.png'),
(43, 4, 7, 'Penukaran Point', '?c=c_tukar_point', 'window', 'N', 'Y', 'tukar_point48.png', 'tukar_point16.png'),
(45, 4, 9, 'Pelunasan Piutang', '?c=c_master_lunas_piutang', 'window', 'N', 'Y', 'lunas_piutang48.png', 'lunas_piutang16.png'),
(46, 4, 10, 'Kuitansi', '?c=c_cetak_kwitansi', 'window', 'N', 'Y', 'cetak_kwitansi48.png', 'cetak_kwitansi16.png'),
(47, 2, 11, 'Customer', '?c=c_customer', 'window', 'N', 'Y', 'pendaftaran_customer48.png', 'pendaftaran_customer16.png'),
(48, 5, 2, 'Aktivasi Member', '?c=c_member', 'window', 'N', 'Y', 'aktivasi_member48.png', 'aktivasi_member16.png'),
(50, 5, 3, 'Catatan Customer', '?c=c_customer_note', 'window', 'N', 'Y', 'catatan_customer48.png', 'catatan_customer16.png'),
(53, 7, 1, 'Anamnesa', '?c=c_anamnesa', 'window', 'N', 'Y', 'anamnesa48.png', 'anamnesa16.png'),
(55, 2, 14, 'Departemen', '?c=c_departemen', 'window', 'N', 'Y', 'departemen48.png', 'departemen16.png'),
(56, 8, 1, 'Jurnal Pembelian', '?c=c_jurnal_beli', 'window', 'N', 'Y', 'jurnal_pembelian48.png', 'jurnal_pembelian16.png'),
(57, 8, 2, 'Jurnal Penjualan', '?c=c_jurnal_jual', 'window', 'N', 'Y', 'jurnal_penjualan48.png', 'jurnal_penjualan16.png'),
(58, 8, 3, 'Jurnal Kas Masuk', '?c=c_jurnal_kas_terima', 'window', 'N', 'Y', 'jurnal_bank48.png', 'jurnal_bank16.png'),
(59, 8, 4, 'Jurnal Kas Keluar', '?c=c_jurnal_kas_keluar', 'window', 'N', 'Y', 'jurnal_kas48.png', 'jurnal_kas16.png'),
(60, 8, 5, 'Jurnal Umum', '?c=c_jurnal_umum', 'window', 'N', 'Y', 'jurnal_umum48.png', 'jurnal_umum16.png'),
(61, 8, 6, 'Buku Besar', '?c=c_buku_besar', 'window', 'N', 'Y', 'buku_besar48.png', 'buku_besar16.png'),
(62, 8, 7, 'Aktiva Tetap', '?c=c_aktiva_tetap', 'window', 'N', 'Y', 'aktiva_tetap48.png', 'aktiva_tetap16.png'),
(63, 8, 8, 'Laporan Laba Rugi', '?c=c_laba_rugi', 'window', 'N', 'Y', 'laporan_laba_rugi48.png', 'laporan_laba_rugi16.png'),
(64, 8, 9, 'Laporan Neraca Percobaan', '?c=c_neraca_coba', 'window', 'N', 'Y', 'laporan_neraca_coba48.png', 'laporan_neraca_coba16.png'),
(65, 8, 10, 'Laporan Neraca', '?c=c_neraca', 'window', 'N', 'Y', 'laporan_neraca48.png', 'laporan_neraca16.png'),
(67, 10, 1, 'About Us', '?c=c_about', 'window', 'N', 'Y', 'aboutus48.png', 'aboutus16.png'),
(68, 10, 2, 'User Manual', '?c=c_user_manual', 'window', 'N', 'Y', 'user_manual48.png', 'user_manual16.png'),
(69, 10, 3, 'Online Support', 'http://support.ts.co.id', 'url', 'Y', 'Y', 'online_support48.png', 'online_support16.png'),
(70, 2, 12, 'Cabang', '?c=c_cabang', 'window', 'N', 'Y', 'cabang48.png', 'cabang16.png'),
(11, 1, 2, 'User Groups', '?c=c_usergroups', 'window', 'N', 'Y', 'user_group48.png', 'user_group16.png'),
(71, 5, 7, 'Voucher', '?c=c_voucher', 'window', 'N', 'Y', NULL, NULL),
(72, 5, 8, 'Promo', '?c=c_promo', 'window', 'N', 'Y', NULL, NULL),
(73, 9, 2, 'Laporan Order Pembelian', '?c=c_report_obeli', 'window', 'N', 'Y', NULL, NULL),
(74, 9, 3, 'Laporan Penerimaan Pembelian', '?c=c_report_tbeli', 'window', 'N', 'Y', NULL, NULL),
(75, 9, 4, 'Laporan Retur Pembelian', '?c=c_report_rbeli', 'window', 'N', 'Y', NULL, NULL),
(76, 9, 5, 'Laporan Penerimaan Invoice', '?c=c_report_mutasi', 'window', 'N', 'Y', NULL, NULL),
(77, 9, 6, 'Laporan Mutasi Barang', '', 'window', 'N', 'Y', NULL, NULL),
(78, 9, 7, 'Laporan Kartu Stok', '?c=c_report_kstok', 'window', 'N', 'Y', NULL, NULL),
(79, 9, 8, 'Laporan Koreksi Stok', '', 'window', 'N', 'Y', NULL, NULL),
(80, 9, 9, 'Laporan Penjualan Produk', '?c=c_master_jual_produk&m=laporan', 'window', 'N', 'Y', NULL, NULL),
(81, 9, 10, 'Laporan Penjualan Perawatan', '?c=c_report_jrawat', 'window', 'N', 'Y', NULL, NULL),
(82, 9, 11, 'Laporan Penjualan Paket', '?c=c_report_jpaket', 'window', 'N', 'Y', NULL, NULL),
(83, 9, 12, 'Laporan Pengambilan Paket', '', 'window', 'N', 'Y', NULL, NULL),
(84, 9, 13, 'Laporan Retur Penjualan Produk', '?c=c_report_retur_jproduk', 'window', 'N', 'Y', NULL, NULL),
(95, 9, 14, 'Laporan Retur Penjualan Paket', '?c=c_report_retur_jpaket', 'window', 'N', 'Y', NULL, NULL),
(86, 9, 15, 'Laporan Penerimaan Penjualan', '', 'window', 'N', 'Y', NULL, NULL),
(87, 9, 16, 'Laporan Penerbitan Kuitansi', '', 'window', 'N', 'Y', NULL, NULL),
(88, 9, 17, 'Laporan Customer', '?c=c_report_tukar_point', 'window', 'N', 'Y', NULL, NULL),
(89, 9, 18, 'Laporan Appointment', '?c=c_report_voucher', 'window', 'N', 'Y', NULL, NULL),
(90, 9, 19, 'Laporan Member', '?c=c_report_customer', 'window', 'N', 'Y', NULL, NULL),
(91, 9, 20, 'Laporan Voucher', '', 'window', 'N', 'Y', NULL, NULL),
(92, 9, 21, 'Laporan Promo', '', 'window', 'N', 'Y', NULL, NULL),
(93, 9, 22, 'Laporan Tindakan', '', 'window', 'N', 'Y', NULL, NULL),
(94, 9, 23, 'Laporan Pennggunaan Bahan Cabin', '', 'window', 'N', 'Y', NULL, NULL),
(85, 9, 24, 'Laporan Piutang Penjualan', '', 'window', 'N', 'Y', NULL, NULL),
(30, 2, 18, 'Bank', '?c=c_bank_master', 'window', 'N', 'Y', NULL, NULL),
(27, 2, 2, 'Group 2', '?c=c_jenis', 'window', 'N', 'Y', NULL, NULL),
(366, 2, 4, 'Contribution Category', '?c=c_kategori2', 'window', 'N', 'Y', NULL, NULL),
(368, 7, 3, 'Tindakan Medis', '?c=c_tindakan_medis', 'window', 'N', 'Y', 'pemeriksaan48.png', 'pemeriksaan16.png'),
(369, 7, 4, 'Tindakan Non Medis', '?c=c_tindakan_nonmedis', 'window', 'N', 'Y', 'pemeriksaan48.png', 'pemeriksaan16.png'),
(370, 5, 1, 'Appointment', '?c=c_appointment', 'window', 'N', 'Y', NULL, NULL),
(371, 1, 5, 'Ganti Password', '?c=c_gpass', 'window', 'N', 'Y', NULL, NULL),
(372, 0, 9, 'SMS Broadcast', '', 'window', 'N', 'Y', NULL, NULL),
(373, 372, 2, 'New SMS', '?c=c_sms', 'window', 'N', 'Y', NULL, NULL),
(374, 372, 3, 'Draft', '?c=c_draft', 'window', 'N', 'Y', NULL, NULL),
(375, 372, 4, 'Inbox', '?c=c_inbox', 'window', 'N', 'Y', NULL, NULL),
(376, 372, 5, 'Outbox', '?c=c_outbox', 'window', 'N', 'Y', NULL, NULL),
(377, 372, 1, 'Phone Group', '?c=c_phonegroup', 'window', 'N', 'Y', NULL, NULL),
(378, 8, 11, 'Laporan Persediaan', '?c=c_persediaan', 'window', 'N', 'Y', NULL, NULL),
(379, 8, 12, 'Harga Pokok Penjualan (HPP)', '?c=c_hpp', 'window', 'N', 'Y', NULL, NULL),
(380, 3, 7, 'Kartu Stok', '?c=c_stok', 'window', 'N', 'Y', NULL, NULL);

-- --------------------------------------------------------
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `miracledb`.`vu_detail_jual_produk` AS select `miracledb`.`detail_jual_produk`.`dproduk_id` AS `dproduk_id`,`miracledb`.`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`miracledb`.`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`miracledb`.`detail_jual_produk`.`dproduk_jumlah` AS `jumlah_barang`,`miracledb`.`detail_jual_produk`.`dproduk_harga` AS `harga_satuan`,`miracledb`.`detail_jual_produk`.`dproduk_diskon` AS `diskon`,`miracledb`.`detail_jual_produk`.`dproduk_diskon_jenis` AS `diskon_jenis`,`miracledb`.`detail_jual_produk`.`dproduk_sales` AS `sales`,`miracledb`.`master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`miracledb`.`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`miracledb`.`customer`.`cust_id` AS `cust_id`,`miracledb`.`customer`.`cust_no` AS `cust_no`,`miracledb`.`customer`.`cust_member` AS `cust_member`,`miracledb`.`customer`.`cust_nama` AS `cust_nama`,`miracledb`.`customer`.`cust_kelamin` AS `cust_kelamin`,`miracledb`.`customer`.`cust_alamat` AS `cust_alamat`,`miracledb`.`customer`.`cust_kota` AS `cust_kota`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_du` AS `produk_du`,`vu_produk`.`produk_dm` AS `produk_dm`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_harga` AS `produk_harga`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`miracledb`.`satuan`.`satuan_nama` AS `satuan_nama`,(((`miracledb`.`detail_jual_produk`.`dproduk_harga` * `miracledb`.`detail_jual_produk`.`dproduk_diskon`) / 100) * `miracledb`.`detail_jual_produk`.`dproduk_jumlah`) AS `diskon_nilai`,((`miracledb`.`detail_jual_produk`.`dproduk_harga` * `miracledb`.`detail_jual_produk`.`dproduk_jumlah`) - (((`miracledb`.`detail_jual_produk`.`dproduk_harga` * `miracledb`.`detail_jual_produk`.`dproduk_diskon`) / 100) * `miracledb`.`detail_jual_produk`.`dproduk_jumlah`)) AS `subtotal` from ((((`miracledb`.`detail_jual_produk` join `miracledb`.`master_jual_produk` on((`miracledb`.`detail_jual_produk`.`dproduk_master` = `miracledb`.`master_jual_produk`.`jproduk_id`))) join `miracledb`.`customer` on((`miracledb`.`master_jual_produk`.`jproduk_cust` = `miracledb`.`customer`.`cust_id`))) join `miracledb`.`vu_produk` on((`vu_produk`.`produk_id` = `miracledb`.`detail_jual_produk`.`dproduk_id`))) join `miracledb`.`satuan` on((`miracledb`.`detail_jual_produk`.`dproduk_satuan` = `miracledb`.`satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_invoice_group`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `miracledb`.`vu_total_invoice_group` AS select `miracledb`.`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,sum(`miracledb`.`detail_invoice`.`dinvoice_jumlah`) AS `jumlah_barang`,sum((((`miracledb`.`detail_invoice`.`dinvoice_harga` * `miracledb`.`detail_invoice`.`dinvoice_jumlah`) * (100 - `miracledb`.`detail_invoice`.`dinvoice_diskon`)) / 100)) AS `total_nilai` from `miracledb`.`detail_invoice` group by `miracledb`.`detail_invoice`.`dinvoice_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_paket_group`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_total_jual_paket_group` AS select ifnull(sum(`miracledb`.`detail_jual_paket`.`dpaket_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`miracledb`.`detail_jual_paket`.`dpaket_harga` * `miracledb`.`detail_jual_paket`.`dpaket_jumlah`) * (100 - `miracledb`.`detail_jual_paket`.`dpaket_diskon`)) / 100)),0) AS `total_nilai`,`miracledb`.`detail_jual_paket`.`dpaket_master` AS `dpaket_master` from `miracledb`.`detail_jual_paket` group by `miracledb`.`detail_jual_paket`.`dpaket_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_produk_group`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_total_jual_produk_group` AS select ifnull(sum(`miracledb`.`detail_jual_produk`.`dproduk_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`miracledb`.`detail_jual_produk`.`dproduk_harga` * `miracledb`.`detail_jual_produk`.`dproduk_jumlah`) * (100 - `miracledb`.`detail_jual_produk`.`dproduk_diskon`)) / 100)),0) AS `total_nilai`,`miracledb`.`detail_jual_produk`.`dproduk_master` AS `dproduk_master` from `miracledb`.`detail_jual_produk` group by `miracledb`.`detail_jual_produk`.`dproduk_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_rawat_group`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_total_jual_rawat_group` AS select ifnull(sum(`miracledb`.`detail_jual_rawat`.`drawat_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`miracledb`.`detail_jual_rawat`.`drawat_harga` * `miracledb`.`detail_jual_rawat`.`drawat_jumlah`) * (100 - `miracledb`.`detail_jual_rawat`.`drawat_diskon`)) / 100)),0) AS `total_nilai`,`miracledb`.`detail_jual_rawat`.`drawat_master` AS `drawat_master` from `miracledb`.`detail_jual_rawat` group by `miracledb`.`detail_jual_rawat`.`drawat_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_paket`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_trans_paket` AS select `miracledb`.`master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,`miracledb`.`master_jual_paket`.`jpaket_cust` AS `cust_id`,`miracledb`.`master_jual_paket`.`jpaket_tanggal` AS `tanggal`,ifnull(`vu_total_jual_paket_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_paket_group`.`total_nilai`,0) AS `total_nilai`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`miracledb`.`master_jual_paket`.`jpaket_diskon`,0) AS `diskon`,ifnull(`miracledb`.`master_jual_paket`.`jpaket_cashback`,0) AS `cashback` from ((`miracledb`.`master_jual_paket` left join `miracledb`.`vu_total_jual_paket_group` on((`vu_total_jual_paket_group`.`dpaket_master` = `miracledb`.`master_jual_paket`.`jpaket_id`))) join `miracledb`.`vu_customer` on((`miracledb`.`master_jual_paket`.`jpaket_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_produk`
--
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_trans_produk` AS select `miracledb`.`master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`miracledb`.`master_jual_produk`.`jproduk_cust` AS `cust_id`,`miracledb`.`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,ifnull(`vu_total_jual_produk_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_produk_group`.`total_nilai`,0) AS `total_nilai`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`miracledb`.`master_jual_produk`.`jproduk_diskon`,0) AS `diskon`,ifnull(`miracledb`.`master_jual_produk`.`jproduk_cashback`,0) AS `cashback` from ((`miracledb`.`master_jual_produk` left join `miracledb`.`vu_total_jual_produk_group` on((`vu_total_jual_produk_group`.`dproduk_master` = `miracledb`.`master_jual_produk`.`jproduk_id`))) join `miracledb`.`vu_customer` on((`miracledb`.`master_jual_produk`.`jproduk_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_rawat`
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_trans_rawat` AS select `miracledb`.`master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,`miracledb`.`master_jual_rawat`.`jrawat_cust` AS `cust_id`,`miracledb`.`master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,ifnull(`vu_total_jual_rawat_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_rawat_group`.`total_nilai`,0) AS `total_nilai`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`miracledb`.`master_jual_rawat`.`jrawat_diskon`,0) AS `diskon`,ifnull(`miracledb`.`master_jual_rawat`.`jrawat_cashback`,0) AS `cashback` from ((`miracledb`.`master_jual_rawat` left join `miracledb`.`vu_total_jual_rawat_group` on((`vu_total_jual_rawat_group`.`drawat_master` = `miracledb`.`master_jual_rawat`.`jrawat_id`))) join `miracledb`.`vu_customer` on((`miracledb`.`master_jual_rawat`.`jrawat_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_union`
--
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `miracledb`.`vu_trans_union` AS select `vu_trans_produk`.`no_bukti` AS `no_bukti`,`vu_trans_produk`.`cust_id` AS `cust_id`,`vu_trans_produk`.`tanggal` AS `tanggal`,`vu_trans_produk`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_produk`.`total_nilai` AS `total_nilai`,`vu_trans_produk`.`cust_no` AS `cust_no`,`vu_trans_produk`.`cust_member` AS `cust_member`,`vu_trans_produk`.`cust_nama` AS `cust_nama`,`vu_trans_produk`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_produk`.`cust_alamat` AS `cust_alamat`,`vu_trans_produk`.`cust_kota` AS `cust_kota`,`vu_trans_produk`.`diskon` AS `diskon`,`vu_trans_produk`.`cashback` AS `cashback` from `miracledb`.`vu_trans_produk` union select `vu_trans_rawat`.`no_bukti` AS `no_bukti`,`vu_trans_rawat`.`cust_id` AS `cust_id`,`vu_trans_rawat`.`tanggal` AS `tanggal`,`vu_trans_rawat`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_rawat`.`total_nilai` AS `total_nilai`,`vu_trans_rawat`.`cust_no` AS `cust_no`,`vu_trans_rawat`.`cust_member` AS `cust_member`,`vu_trans_rawat`.`cust_nama` AS `cust_nama`,`vu_trans_rawat`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_rawat`.`cust_alamat` AS `cust_alamat`,`vu_trans_rawat`.`cust_kota` AS `cust_kota`,`vu_trans_rawat`.`diskon` AS `diskon`,`vu_trans_rawat`.`cashback` AS `cashback` from `miracledb`.`vu_trans_rawat` union select `vu_trans_paket`.`no_bukti` AS `no_bukti`,`vu_trans_paket`.`cust_id` AS `cust_id`,`vu_trans_paket`.`tanggal` AS `tanggal`,`vu_trans_paket`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_paket`.`total_nilai` AS `total_nilai`,`vu_trans_paket`.`cust_no` AS `cust_no`,`vu_trans_paket`.`cust_member` AS `cust_member`,`vu_trans_paket`.`cust_nama` AS `cust_nama`,`vu_trans_paket`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_paket`.`cust_alamat` AS `cust_alamat`,`vu_trans_paket`.`cust_kota` AS `cust_kota`,`vu_trans_paket`.`diskon` AS `diskon`,`vu_trans_paket`.`cashback` AS `cashback` from `miracledb`.`vu_trans_paket`;
