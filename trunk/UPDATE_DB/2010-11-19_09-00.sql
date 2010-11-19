
CREATE TABLE IF NOT EXISTS `sr_setup` (
  `setsr_id` int(11) NOT NULL AUTO_INCREMENT,
  `setsr_cabang` int(11) NOT NULL,
  `setsr_tahun` int(11) NOT NULL,
  `setsr_jenis` enum('Kunjungan Pria','Kunjungan Wanita','Customer Lama','Customer Baru','Member Baru','Perawatan Medis','Perawatan Non Medis','Produk') NOT NULL,
  `setsr_jan` double NOT NULL,
  `setsr_feb` double NOT NULL,
  `setsr_mar` double NOT NULL,
  `setsr_apr` double NOT NULL,
  `setsr_may` double NOT NULL,
  `setsr_jun` double NOT NULL,
  `setsr_jul` double NOT NULL,
  `setsr_aug` double NOT NULL,
  `setsr_sep` double NOT NULL,
  `setsr_oct` double NOT NULL,
  `setsr_nov` double NOT NULL,
  `setsr_dec` double NOT NULL,
  `setsr_author` varchar(50) NOT NULL,
  `setsr_date_create` datetime NOT NULL,
  `setsr_update` varchar(50) NOT NULL,
  `setsr_date_update` datetime NOT NULL,
  `setsr_revised` int(11) NOT NULL,
  PRIMARY KEY (`setsr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

