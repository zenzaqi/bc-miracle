DROP TABLE IF EXISTS detail_retur_jual_produk;
CREATE TABLE IF NOT EXISTS detail_retur_jual_produk (
  drproduk_id int(11) NOT NULL auto_increment,
  drproduk_master int(11) NOT NULL,
  drproduk_produk int(11) NOT NULL,
  drproduk_satuan int(11) default NULL,
  drproduk_jumlah int(11) default NULL,
  drproduk_harga double default NULL,
  drproduk_diskon int(11) default NULL,
  drproduk_diskon_jenis varchar(255) default NULL,
  PRIMARY KEY  (drproduk_id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `master_retur_jual_produk`;
CREATE TABLE IF NOT EXISTS `master_retur_jual_produk` (
  `rproduk_id` int(11) NOT NULL AUTO_INCREMENT,
  `rproduk_nobukti` varchar(100) DEFAULT NULL,
  `rproduk_nobuktijual` int(100) DEFAULT NULL,
  `rproduk_cust` int(11) DEFAULT NULL,
  `rproduk_tanggal` date DEFAULT NULL,
  `rproduk_keterangan` varchar(250) DEFAULT NULL,
  `rproduk_diskon` int(11) DEFAULT NULL,
  `rproduk_cashback` int(11) DEFAULT NULL,
  `rproduk_creator` varchar(50) DEFAULT NULL,
  `rproduk_date_create` datetime DEFAULT NULL,
  `rproduk_update` varchar(50) DEFAULT NULL,
  `rproduk_date_update` datetime DEFAULT NULL,
  `rproduk_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`rproduk_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;