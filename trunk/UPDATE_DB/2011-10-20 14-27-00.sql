CREATE TABLE IF NOT EXISTS `aset_grup` (
  `aset_grup_id` int(10) NOT NULL AUTO_INCREMENT,
  `aset_grup_kode` varchar(30) DEFAULT NULL,
  `aset_grup_nama` varchar(100) DEFAULT NULL,
  `aset_grup_kelas` varchar(50) DEFAULT NULL,
  `aset_grup_usia` varchar(10) DEFAULT NULL,
  `aset_grup_keterangan` varchar(500) DEFAULT NULL,
  `aset_grup_aktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `aset_grup_creator` varchar(50) DEFAULT NULL,
  `aset_grup_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `aset_grup_update` varchar(50) DEFAULT NULL,
  `aset_grup_date_update` datetime DEFAULT NULL,
  `aset_grup_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`aset_grup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
