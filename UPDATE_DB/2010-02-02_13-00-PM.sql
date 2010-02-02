DROP TABLE IF EXISTS `submaster_jual_paket`;
CREATE TABLE IF NOT EXISTS `submaster_jual_paket` (
  `sjpaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `sjpaket_master` int(11) NOT NULL,
  `sjpaket_nobukti` varchar(30) NOT NULL,
  `sjpaket_cust` int(11) NOT NULL,
  PRIMARY KEY (`sjpaket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;