DROP TABLE IF EXISTS `submaster_apaket_item`;
CREATE TABLE IF NOT EXISTS `submaster_apaket_item` (
  `sapaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `sapaket_master` int(11) NOT NULL,
  `sapaket_item` int(11) NOT NULL,
  `sapaket_jmlisi_item` int(11) NOT NULL,
  `sapaket_sisa_item` int(11) NOT NULL,
  UNIQUE KEY `sapaket_id` (`sapaket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP VIEW IF EXISTS `vu_appointment_detail`;
DROP VIEW IF EXISTS `vu_tindakanlist`;
