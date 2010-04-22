CREATE TABLE IF NOT EXISTS `member_temp` (
  `membert_id` int(11) NOT NULL AUTO_INCREMENT,
  `membert_cust` int(11) NOT NULL DEFAULT '0',
  `membert_no` varchar(50) NOT NULL DEFAULT '-',
  `membert_register` date DEFAULT NULL,
  `membert_valid` date DEFAULT NULL,
  `membert_jenis` enum('perpanjangan','baru') DEFAULT 'baru',
  `membert_status` enum('Daftar','Cetak','Aktif') DEFAULT 'Daftar',
  `membert_check_daftar` enum('true','false') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`membert_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `member_setup` ADD `setmember_rp_perpoint` DOUBLE NOT NULL DEFAULT '0' AFTER `setmember_pointtenggang`;