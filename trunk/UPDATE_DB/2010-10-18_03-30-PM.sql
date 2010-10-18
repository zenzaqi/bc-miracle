
CREATE TABLE IF NOT EXISTS `akun_setup` (
  `setup_id` int(11) NOT NULL AUTO_INCREMENT,
  `setup_periode_tahun` year(4) DEFAULT '2010',
  `setup_periode_awal` date DEFAULT NULL,
  `setup_periode_akhir` date DEFAULT NULL,
  `setup_author` varchar(50) DEFAULT NULL,
  `setup_date_create` datetime DEFAULT NULL,
  `setup_update` varchar(50) DEFAULT NULL,
  `setup_date_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `setup_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`setup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `akun_setup`
--

INSERT INTO `akun_setup` (`setup_id`, `setup_periode_tahun`, `setup_periode_awal`, `setup_periode_akhir`, `setup_author`, `setup_date_create`, `setup_update`, `setup_date_update`, `setup_revised`) VALUES
(1, 2010, '2010-01-02', '2011-01-01', NULL, NULL, 'test', '2010-10-18 14:17:42', NULL);