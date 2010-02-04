
-- DROP unused table

DROP TABLE IF EXISTS promo_berlaku;
DROP TABLE IF EXISTS sms_code;
DROP TABLE IF EXISTS sms_outbox;
DROP TABLE IF EXISTS sms_response;
DROP TABLE IF EXISTS sms_inbox;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `promo_id` int(11) NOT NULL auto_increment,
  `promo_acara` varchar(250) default NULL,
  `promo_tempat` varchar(250) default NULL,
  `promo_keterangan` varchar(500) default NULL,
  `promo_tglmulai` date default NULL,
  `promo_tglselesai` date default NULL,
  `promo_cashback` double default NULL,
  `promo_mincash` double default NULL,
  `promo_diskon` float default NULL,
  `promo_allproduk` enum('T','Y') default 'T',
  `promo_allrawat` enum('T','Y') default 'T',
  `promo_creator` varchar(255) default NULL,
  `promo_date_create` date default NULL,
  `promo_update` varchar(255) default NULL,
  `promo_date_update` date default NULL,
  `promo_revised` int(11) default NULL,
  PRIMARY KEY  (`promo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_id`, `promo_acara`, `promo_tempat`, `promo_keterangan`, `promo_tglmulai`, `promo_tglselesai`, `promo_cashback`, `promo_mincash`, `promo_diskon`, `promo_allproduk`, `promo_allrawat`, `promo_creator`, `promo_date_create`, `promo_update`, `promo_date_update`, `promo_revised`) VALUES
(1, 'Miracle Anniversary 9th', 'Pakuwon City Mall', NULL, '2009-08-01', '2009-08-31', 25000, 500000, 0, 'Y', 'Y', NULL, NULL, NULL, NULL, NULL),
(3, 'Test saja', 'Tempat test', 'Keterangan test', '2010-02-02', '2010-02-11', 0, 0, 0, 'T', 'T', NULL, NULL, NULL, NULL, NULL),
(4, 'test saja', 'tempat test', '2010-02-04', '2010-02-19', '0000-00-00', 0, 0, 0, 'Y', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_perawatan`
--

DROP TABLE IF EXISTS `promo_perawatan`;
CREATE TABLE IF NOT EXISTS `promo_perawatan` (
  `rpromo_id` int(11) NOT NULL auto_increment,
  `rpromo_master` int(11) NOT NULL,
  `rpromo_perawatan` int(11) NOT NULL,
  PRIMARY KEY  (`rpromo_id`),
  KEY `fk_ref_isipaket_rawat_on_rawat_id` (`rpromo_perawatan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `promo_perawatan`
--

INSERT INTO `promo_perawatan` (`rpromo_id`, `rpromo_master`, `rpromo_perawatan`) VALUES
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `promo_produk`
--

DROP TABLE IF EXISTS `promo_produk`;
CREATE TABLE IF NOT EXISTS `promo_produk` (
  `ipromo_id` int(11) NOT NULL auto_increment,
  `ipromo_master` int(11) NOT NULL,
  `ipromo_produk` int(11) NOT NULL,
  PRIMARY KEY  (`ipromo_id`),
  KEY `fk_ref_isipaket_produk_on_produk_id` (`ipromo_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `promo_produk`
--

INSERT INTO `promo_produk` (`ipromo_id`, `ipromo_master`, `ipromo_produk`) VALUES
(4, 3, 17),
(3, 3, 15);