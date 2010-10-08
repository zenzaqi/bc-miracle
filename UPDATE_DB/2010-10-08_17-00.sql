-- utk keperluan resep dokter


CREATE TABLE IF NOT EXISTS `resep_dokter` (
  `resep_id` int(11) NOT NULL AUTO_INCREMENT,
  `resep_no` varchar(50) DEFAULT NULL,
  `resep_sip` varchar(50) DEFAULT NULL,
  `resep_dokterid` int(11) DEFAULT NULL,
  `resep_tanggal` date NOT NULL,
  `resep_keterangan` varchar(250) DEFAULT NULL,
  `resep_custid` int(11) DEFAULT NULL,
  `resep_creator` varchar(50) DEFAULT NULL,
  `resep_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `resep_update` varchar(50) DEFAULT NULL,
  `resep_date_update` datetime DEFAULT NULL,
  `resep_revised` int(11) DEFAULT '0',
  `resep_locked` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`resep_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `master_resep_kombinasi` (
  `rkombinasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `rkombinasi_master` int(11) NOT NULL,
  `rkombinasi_produk` int(11) NOT NULL,
  PRIMARY KEY (`rkombinasi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `detail_resep_dokter_kombinasi` (
  `dresepk_id` int(11) NOT NULL AUTO_INCREMENT,
  `dresepk_resepmaster` int(11) NOT NULL,
  `dresepk_master` int(11) NOT NULL,
  `dresepk_produk` int(11) NOT NULL,
  `dresepk_creator` varchar(50) DEFAULT NULL,
  `dresepk_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dresepk_update` varchar(50) DEFAULT NULL,
  `dresepk_date_update` datetime DEFAULT NULL,
  `dresepk_revised` int(11) DEFAULT '0',
  `dresepk_locked` int(2) NOT NULL DEFAULT '0',
  `dresepk_paket` int(11) NOT NULL,
  `dresepk_tambahan` varchar(250) DEFAULT NULL,
  `dresepk_satuan` varchar(50) NOT NULL,
  `dresepk_jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`dresepk_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;