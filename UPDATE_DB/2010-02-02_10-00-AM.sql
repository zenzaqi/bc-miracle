ALTER TABLE `detail_ambil_paket` CHANGE `dapaket_id` `dapaket_id` INT( 11 ) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

CREATE TABLE IF NOT EXISTS `draft` (
  `draft_id` int(11) NOT NULL auto_increment,
  `draft_destination` varchar(500) default NULL,
  `draft_message` blob,
  `draft_date` datetime default NULL,
  `draft_creator` varchar(50) default NULL,
  `draft_date_create` datetime default NULL,
  `draft_update` varchar(50) default NULL,
  `draft_date_update` datetime default NULL,
  `draft_revised` int(11) default NULL,
  PRIMARY KEY  (`draft_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `draft`
--


-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `inbox_id` bigint(20) NOT NULL auto_increment,
  `inbox_sender` varchar(25) default NULL,
  `inbox_message` blob,
  `inbox_date` datetime default NULL,
  `inbox_creator` varchar(50) default NULL,
  `inbox_date_create` datetime default NULL,
  `inbox_update` varchar(50) default NULL,
  `inbox_date_update` datetime default NULL,
  `inbox_revised` int(11) default '0',
  PRIMARY KEY  (`inbox_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `outbox_id` bigint(20) NOT NULL auto_increment,
  `outbox_destination` varchar(500) default NULL,
  `outbox_message` blob,
  `outbox_date` datetime default NULL,
  `outbox_creator` varchar(50) default NULL,
  `outbox_date_create` datetime default NULL,
  `outbox_update` varchar(50) default NULL,
  `outbox_date_update` datetime default NULL,
  `outbox_revised` int(11) default NULL,
  PRIMARY KEY  (`outbox_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `phonegroup`
--

CREATE TABLE IF NOT EXISTS `phonegroup` (
  `phonegroup_id` int(11) NOT NULL auto_increment,
  `phonegroup_nama` varchar(250) default NULL,
  `phonegroup_detail` varchar(500) default NULL,
  `phonegroup_creator` varchar(50) default NULL,
  `phonegroup_date_create` datetime default NULL,
  `phonegroup_update` varchar(50) default NULL,
  `phonegroup_date_update` datetime default NULL,
  `phonegroup_revised` int(11) default NULL,
  PRIMARY KEY  (`phonegroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `phonegroup`
--


-- --------------------------------------------------------

--
-- Table structure for table `phonegrouped`
--

CREATE TABLE IF NOT EXISTS `phonegrouped` (
  `phonegrouped_id` int(11) NOT NULL auto_increment,
  `phonegrouped_group` int(11) default NULL,
  `phonegrouped_number` varchar(50) default NULL,
  PRIMARY KEY  (`phonegrouped_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `phonegrouped`
--

--
-- Dumping data for table `menus`
--

TRUNCATE TABLE `menus`;

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
(52, 5, 6, 'SMS Broadcast', '?c=c_sms', 'window', 'N', 'Y', 'sms_broadcast48.png', 'sms_broadcast16.png'),
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
(66, 9, 1, 'Laporan', '', 'window', 'N', 'Y', NULL, NULL),
(67, 10, 1, 'About Us', '?c=c_about', 'window', 'N', 'Y', 'aboutus48.png', 'aboutus16.png'),
(68, 10, 2, 'User Manual', '?c=c_user_manual', 'window', 'N', 'Y', 'user_manual48.png', 'user_manual16.png'),
(69, 10, 3, 'Online Support', 'http://support.ts.co.id', 'url', 'Y', 'Y', 'online_support48.png', 'online_support16.png'),
(70, 2, 12, 'Cabang', '?c=c_cabang', 'window', 'N', 'Y', 'cabang48.png', 'cabang16.png'),
(11, 1, 2, 'User Groups', '?c=c_usergroups', 'window', 'N', 'Y', 'user_group48.png', 'user_group16.png'),
(71, 5, 7, 'Voucher', '?c=c_voucher', 'window', 'N', 'Y', NULL, NULL),
(72, 5, 8, 'Promo', '?c=c_promo', 'window', 'N', 'Y', NULL, NULL),
(73, 9, 2, 'Rekap Order Pembelian', '?c=c_report_obeli', 'window', 'N', 'Y', NULL, NULL),
(74, 9, 3, 'Rekap Penerimaan Pembelian', '?c=c_report_tbeli', 'window', 'N', 'Y', NULL, NULL),
(75, 9, 4, 'Rekap Retur Pembelian', '?c=c_report_rbeli', 'window', 'N', 'Y', NULL, NULL),
(76, 9, 5, 'Rekap Mutasi Barang', '?c=c_report_mutasi', 'window', 'N', 'Y', NULL, NULL),
(77, 9, 6, 'Rekap Penerimaan Invoice', '', 'window', 'N', 'Y', NULL, NULL),
(78, 9, 7, 'Rekap Koreksi Stok', '?c=c_report_kstok', 'window', 'N', 'Y', NULL, NULL),
(79, 9, 8, 'Rekap Kartu Stok', '', 'window', 'N', 'Y', NULL, NULL),
(80, 9, 9, 'Rekap Penjualan Produk', '?c=c_report_jproduk', 'window', 'N', 'Y', NULL, NULL),
(81, 9, 10, 'Rekap Penjualan Perawatan', '?c=c_report_jrawat', 'window', 'N', 'Y', NULL, NULL),
(82, 9, 11, 'Rekap Penjualan Paket', '?c=c_report_jpaket', 'window', 'N', 'Y', NULL, NULL),
(83, 9, 12, 'Rekap Pengambilan Paket', '', 'window', 'N', 'Y', NULL, NULL),
(84, 9, 13, 'Rekap Retur Penjualan Produk', '?c=c_report_retur_jproduk', 'window', 'N', 'Y', NULL, NULL),
(95, 9, 14, 'Rekap Retur Penjualan Paket', '?c=c_report_retur_jpaket', 'window', 'N', 'Y', NULL, NULL),
(86, 9, 15, 'Rekap Pelunasan Piutang', '', 'window', 'N', 'Y', NULL, NULL),
(87, 9, 16, 'Rekap Kwitansi', '', 'window', 'N', 'Y', NULL, NULL),
(88, 9, 17, 'Rekap Point Reward', '?c=c_report_tukar_point', 'window', 'N', 'Y', NULL, NULL),
(89, 9, 18, 'Rekap Voucher', '?c=c_report_voucher', 'window', 'N', 'Y', NULL, NULL),
(90, 9, 19, 'Rekap Customer', '?c=c_report_customer', 'window', 'N', 'Y', NULL, NULL),
(91, 9, 20, 'Rekap Appointment', '', 'window', 'N', 'Y', NULL, NULL),
(92, 9, 21, 'Rekap Anamnesa', '', 'window', 'N', 'Y', NULL, NULL),
(93, 9, 22, 'Rekap Tindakan Perawatan', '', 'window', 'N', 'Y', NULL, NULL),
(94, 9, 23, 'Rekap Hutang', '', 'window', 'N', 'Y', NULL, NULL),
(85, 9, 24, 'Rekap Piutang', '', 'window', 'N', 'Y', NULL, NULL),
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
