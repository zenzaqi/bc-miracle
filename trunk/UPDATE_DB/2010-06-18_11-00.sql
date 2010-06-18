
CREATE TABLE IF NOT EXISTS `detail_resep_dokter_lepasan` (
  `dresepl_id` int(11) NOT NULL AUTO_INCREMENT,
  `dresepl_master` int(11) NOT NULL,
  `dresepl_produk` int(11) NOT NULL,
  `dresepl_creator` varchar(50) DEFAULT NULL,
  `dresepl_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dresepl_update` varchar(50) DEFAULT NULL,
  `dresepl_date_update` datetime DEFAULT NULL,
  `dresepl_revised` int(11) DEFAULT '0',
  `dresepl_locked` int(2) NOT NULL DEFAULT '0',
  `dresepl_paket` int(11) NOT NULL,
  `dresepl_tambahan` varchar(250) DEFAULT NULL,
  `dresepl_satuan` int(11) DEFAULT NULL,
  `dresepl_jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`dresepl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

INSERT INTO `detail_resep_dokter_lepasan` (`dresepl_id`, `dresepl_master`, `dresepl_produk`, `dresepl_creator`, `dresepl_date_create`, `dresepl_update`, `dresepl_date_update`, `dresepl_revised`, `dresepl_locked`, `dresepl_paket`, `dresepl_tambahan`, `dresepl_satuan`, `dresepl_jumlah`) VALUES
(56, 6, 18, NULL, '2010-06-17 14:34:30', NULL, NULL, 0, 0, 0, '', 14, 4),
(12, 7, 21, NULL, '2010-06-16 14:03:07', NULL, NULL, 0, 0, 0, '', 0, 22),
(22, 8, 22, NULL, '2010-06-16 15:11:42', NULL, NULL, 0, 0, 0, '', 0, 21),
(15, 9, 22, NULL, '2010-06-16 14:09:55', NULL, NULL, 0, 0, 0, '', 0, 12),
(13, 10, 22, NULL, '2010-06-16 14:08:08', NULL, NULL, 0, 0, 0, '', 9, 3),
(25, 11, 28, NULL, '2010-06-16 15:54:01', NULL, NULL, 0, 0, 0, '', 14, 5),
(59, 12, 23, NULL, '2010-06-17 14:34:58', NULL, NULL, 0, 0, 0, '', 14, 5),
(58, 12, 26, NULL, '2010-06-17 14:34:58', NULL, NULL, 0, 0, 0, '', 14, 2),
(55, 6, 17, NULL, '2010-06-17 14:34:30', NULL, NULL, 0, 0, 0, '', 14, 2),
(57, 6, 21, NULL, '2010-06-17 14:34:30', NULL, NULL, 0, 0, 0, '', 14, 3),
(60, 12, 25, NULL, '2010-06-17 14:34:58', NULL, NULL, 0, 0, 0, '', 14, 3),
(61, 13, 22, NULL, '2010-06-17 16:07:46', NULL, NULL, 0, 0, 0, '', 21, 54);

CREATE TABLE IF NOT EXISTS `detail_resep_dokter_tambahan` (
  `dresept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dresept_master` int(11) NOT NULL,
  `dresept_creator` varchar(50) DEFAULT NULL,
  `dresept_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dresept_update` varchar(50) DEFAULT NULL,
  `dresept_date_update` datetime DEFAULT NULL,
  `dresept_revised` int(11) DEFAULT '0',
  `dresept_locked` int(2) NOT NULL DEFAULT '0',
  `dresept_tambahan` varchar(250) DEFAULT NULL,
  `dresept_satuan` varchar(50) DEFAULT NULL,
  `dresept_jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`dresept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;


INSERT INTO `detail_resep_dokter_tambahan` (`dresept_id`, `dresept_master`, `dresept_creator`, `dresept_date_create`, `dresept_update`, `dresept_date_update`, `dresept_revised`, `dresept_locked`, `dresept_tambahan`, `dresept_satuan`, `dresept_jumlah`) VALUES
(40, 6, NULL, '2010-06-17 14:34:30', NULL, NULL, 0, 0, 'ajshdasd', 'aqdqwe', 2),
(4, 10, NULL, '2010-06-16 14:55:38', NULL, NULL, 0, 0, 'asdasd', '2', 231),
(9, 8, NULL, '2010-06-16 15:11:42', NULL, NULL, 0, 0, 'asdqweq', 'asd', 123),
(12, 11, NULL, '2010-06-16 15:54:01', NULL, NULL, 0, 0, 'asdasd', 'qweq', 12),
(42, 12, NULL, '2010-06-17 14:34:58', NULL, NULL, 0, 0, 'Obat batuk', 'Miligram', 10),
(41, 12, NULL, '2010-06-17 14:34:58', NULL, NULL, 0, 0, 'Obat Pilek', 'Miligram', 15),
(43, 13, NULL, '2010-06-17 16:07:46', NULL, NULL, 0, 0, 'wakwak', 'wakwak', 5);


ALTER TABLE `master_koreksi_stok` ADD `koreksi_no` VARCHAR( 50 ) NULL DEFAULT NULL 