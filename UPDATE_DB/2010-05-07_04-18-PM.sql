DROP TABLE IF EXISTS phonegroup;

CREATE TABLE IF NOT EXISTS `phonegroup` (
  `phonegroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `phonegroup_nama` varchar(250) DEFAULT NULL,
  `phonegroup_detail` varchar(500) DEFAULT NULL,
  `phonegroup_creator` varchar(50) DEFAULT NULL,
  `phonegroup_date_create` datetime DEFAULT NULL,
  `phonegroup_update` varchar(50) DEFAULT NULL,
  `phonegroup_date_update` datetime DEFAULT NULL,
  `phonegroup_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`phonegroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS phonegrouped;

CREATE TABLE IF NOT EXISTS `phonegrouped` (
  `phonegrouped_group` int(11) NOT NULL,
  `phonegrouped_number` varchar(50) NOT NULL,
  PRIMARY KEY (`phonegrouped_group`,`phonegrouped_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE OR REPLACE VIEW `vu_phonegroup` AS select count(`phonegrouped`.`phonegrouped_number`) AS `phonegroup_jumlah`,`phonegroup`.`phonegroup_id` AS `phonegroup_id`,`phonegroup`.`phonegroup_nama` AS `phonegroup_nama`,`phonegroup`.`phonegroup_detail` AS `phonegroup_detail` from (`phonegroup` join `phonegrouped`) where (`phonegrouped`.`phonegrouped_group` = `phonegroup`.`phonegroup_id`) group by `phonegroup`.`phonegroup_id`,`phonegroup`.`phonegroup_nama`,`phonegroup`.`phonegroup_detail`;

CREATE OR REPLACE VIEW `vu_customer` AS select `customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`customer`.`cust_kodepos` AS `cust_kodepos`,`customer`.`cust_propinsi` AS `cust_propinsi`,`customer`.`cust_negara` AS `cust_negara`,`customer`.`cust_alamat2` AS `cust_alamat2`,`customer`.`cust_kota2` AS `cust_kota2`,`customer`.`cust_kodepos2` AS `cust_kodepos2`,`customer`.`cust_propinsi2` AS `cust_propinsi2`,`customer`.`cust_negara2` AS `cust_negara2`,`customer`.`cust_telprumah` AS `cust_telprumah`,`customer`.`cust_telprumah2` AS `cust_telprumah2`,`customer`.`cust_telpkantor` AS `cust_telpkantor`,`customer`.`cust_hp` AS `cust_hp`,`customer`.`cust_hp2` AS `cust_hp2`,`customer`.`cust_hp3` AS `cust_hp3`,`customer`.`cust_email` AS `cust_email`,`customer`.`cust_fb` AS `cust_fb`,`customer`.`cust_tweeter` AS `cust_tweeter`,`customer`.`cust_email2` AS `cust_email2`,`customer`.`cust_fb2` AS `cust_fb2`,`customer`.`cust_tweeter2` AS `cust_tweeter2`,`customer`.`cust_agama` AS `cust_agama`,`customer`.`cust_pendidikan` AS `cust_pendidikan`,`customer`.`cust_profesi` AS `cust_profesi`,`customer`.`cust_tmptlahir` AS `cust_tmptlahir`,`customer`.`cust_tgllahir` AS `cust_tgllahir`,(date_format(now(),_utf8'%Y') - date_format(`customer`.`cust_tgllahir`,_utf8'%Y')) AS `cust_umur`,`customer`.`cust_hobi` AS `cust_hobi`,`customer`.`cust_referensi` AS `cust_referensi`,`customer`.`cust_referensilain` AS `cust_referensilain`,`customer`.`cust_keterangan` AS `cust_keterangan`,`customer`.`cust_terdaftar` AS `cust_terdaftar`,`customer`.`cust_statusnikah` AS `cust_statusnikah`,`customer`.`cust_priority` AS `cust_priority`,`customer`.`cust_jmlanak` AS `cust_jmlanak`,`customer`.`cust_unit` AS `cust_unit`,`customer`.`cust_cp` AS `cust_cp`,`customer`.`cust_cptelp` AS `cust_cptelp`,`customer`.`cust_aktif` AS `cust_aktif`,`customer`.`cust_creator` AS `cust_creator`,`customer`.`cust_date_create` AS `cust_date_create`,`customer`.`cust_update` AS `cust_update`,`customer`.`cust_date_update` AS `cust_date_update`,`customer`.`cust_revised` AS `cust_revised`,`cust_ref`.`cust_nama` AS `cust_nama_ref`,`cabang`.`cabang_nama` AS `cabang_nama`,`cabang`.`cabang_alamat` AS `cabang_alamat` from ((`customer` left join `customer` `cust_ref` on((`customer`.`cust_referensi` = `cust_ref`.`cust_id`))) left join `cabang` on((`customer`.`cust_unit` = `cabang`.`cabang_id`)));
