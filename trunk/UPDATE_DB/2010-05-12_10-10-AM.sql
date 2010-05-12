DROP TABLE IF EXISTS `jurnal_umum`;
CREATE TABLE IF NOT EXISTS `jurnal_umum` (
  `jurnal_id` int(11) NOT NULL auto_increment,
  `jurnal_no` varchar(30) default NULL,
  `jurnal_tanggal` date default NULL,
  `jurnal_keterangan` varchar(250) default NULL,
  `jurnal_noref` varchar(50) default NULL,
  `jurnal_unit` int(65) default NULL,
  `jurnal_author` varchar(50) default NULL,
  `jurnal_date_create` datetime default NULL,
  `jurnal_update` varchar(255) default NULL,
  `jurnal_date_update` datetime default NULL,
  `jurnal_post` enum('T','Y') default NULL,
  `jurnal_date_post` datetime default NULL,
  `jurnal_revised` smallint(6) default NULL,
  PRIMARY KEY  (`jurnal_id`),
  KEY `id_jurnal` (`jurnal_id`),
  KEY `ID_Unit` (`jurnal_author`),
  KEY `TransactionID` (`jurnal_noref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;


DROP TABLE IF EXISTS `jurnal_umum_detail`;
CREATE TABLE IF NOT EXISTS `jurnal_umum_detail` (
  `djurnal_id` int(11) NOT NULL auto_increment,
  `djurnal_master` int(11) default NULL,
  `djurnal_akun` int(11) default NULL,
  `djurnal_detail` varchar(100) default NULL,
  `djurnal_debet` double default NULL,
  `djurnal_kredit` double default NULL,
  PRIMARY KEY  (`djurnal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

CREATE OR REPLACE VIEW `vu_jurnal_umum` AS select `jurnal_umum`.`jurnal_id` AS `jurnal_id`,`jurnal_umum`.`jurnal_no` AS `jurnal_no`,`jurnal_umum`.`jurnal_tanggal` AS `jurnal_tanggal`,`jurnal_umum_detail`.`djurnal_akun` AS `djurnal_akun`,`jurnal_umum_detail`.`djurnal_detail` AS `djurnal_detail`,`jurnal_umum_detail`.`djurnal_debet` AS `djurnal_debet`,`jurnal_umum_detail`.`djurnal_kredit` AS `djurnal_kredit`,`jurnal_umum`.`jurnal_unit` AS `jurnal_unit`,`jurnal_umum`.`jurnal_author` AS `jurnal_author`,`jurnal_umum`.`jurnal_date_create` AS `jurnal_date_create`,`jurnal_umum`.`jurnal_update` AS `jurnal_update`,`jurnal_umum`.`jurnal_date_update` AS `jurnal_date_update`,`jurnal_umum`.`jurnal_post` AS `jurnal_post`,`jurnal_umum`.`jurnal_date_post` AS `jurnal_date_post`,`jurnal_umum`.`jurnal_revised` AS `jurnal_revised`,`akun`.`akun_kode` AS `akun_kode`,`akun`.`akun_jenis` AS `akun_jenis`,`akun`.`akun_parent` AS `akun_parent`,`akun`.`akun_level` AS `akun_level`,`akun`.`akun_nama` AS `akun_nama` from ((`jurnal_umum` join `jurnal_umum_detail` on((`jurnal_umum_detail`.`djurnal_master` = `jurnal_umum`.`jurnal_id`))) join `akun` on((`jurnal_umum_detail`.`djurnal_akun` = `akun`.`akun_id`)));
