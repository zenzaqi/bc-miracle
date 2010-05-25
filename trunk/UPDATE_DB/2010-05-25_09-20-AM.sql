DROP TABLE IF EXISTS `detail_koreksi_stok`;
CREATE TABLE IF NOT EXISTS `detail_koreksi_stok` (
  `dkoreksi_id` int(11) NOT NULL auto_increment,
  `dkoreksi_master` int(11) NOT NULL,
  `dkoreksi_produk` int(11) NOT NULL,
  `dkoreksi_satuan` int(11) default NULL,
  `dkoreksi_jmlawal` double(11,0) default NULL,
  `dkoreksi_jmlkoreksi` double(11,0) default NULL,
  `dkoreksi_jmlsaldo` double(11,0) default NULL,
  `dkoreksi_ket` varchar(250) default NULL,
  PRIMARY KEY  (`dkoreksi_id`),
  KEY `fk_ref_koreksi_stok` (`dkoreksi_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;