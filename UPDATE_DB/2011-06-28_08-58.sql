UPDATE `miracledb`.`menus` SET `menu_title` = 'Help Desk' WHERE `menus`.`menu_id` =383 LIMIT 1 ;

CREATE TABLE IF NOT EXISTS `permintaan_it_catatan` (
  `dcatatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `dcatatan_tanggal` datetime NOT NULL,
  `dcatatan_master` int(11) NOT NULL,
  `dcatatan_user` varchar(50) NOT NULL,
  `dcatatan_isi` varchar(500) NOT NULL,
  `dcatatan_creator` varchar(50) NOT NULL,
  `dcatatan_date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dcatatan_update` varchar(50) NOT NULL,
  `dcatatan_date_update` datetime NOT NULL,
  `dcatatan_revised` int(11) NOT NULL,
  PRIMARY KEY (`dcatatan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE `permintaan_it` CHANGE `permintaan_status` `permintaan_status` ENUM( 'Baru', 'Dalam Proses', 'Ditunda', 'Selesai', 'Ditolak' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `permintaan_it` CHANGE `permintaan_type` `permintaan_type` ENUM( 'MIS','Basic Software','Other Equipment','Computers' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `permintaan_it` ADD `permintaan_type2` VARCHAR( 30 ) NOT NULL AFTER `permintaan_type` ,
ADD `permintaan_type3` VARCHAR( 50 ) NOT NULL AFTER `permintaan_type2`;
