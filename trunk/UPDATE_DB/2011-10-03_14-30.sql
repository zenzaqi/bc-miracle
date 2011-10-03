DROP TABLE IF EXISTS temp_netsales;

CREATE TABLE IF NOT EXISTS `temp_netsales` (
  `tns_id` int(10) NOT NULL AUTO_INCREMENT,
  `tns_tanggal` date NOT NULL,
  `tns_medis` double NOT NULL DEFAULT '0',
  `tns_nonmedis` double NOT NULL DEFAULT '0',
  `tns_surgery` double NOT NULL DEFAULT '0',
  `tns_antiaging` double NOT NULL DEFAULT '0',
  `tns_produk` double NOT NULL DEFAULT '0',
  `tns_lainlain` double NOT NULL DEFAULT '0',
  `tns_total` double NOT NULL DEFAULT '0',
  `tns_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tns_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='temp table, digunakan ketika melakukan gen netsales';
