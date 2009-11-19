ALTER TABLE `master_jual_paket` ADD `jpaket_cara2` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) NULL AFTER `jpaket_cara` ,
ADD `jpaket_cara3` ENUM( 'tunai', 'kwitansi', 'card', 'cek/giro', 'transfer', 'voucher' ) NULL AFTER `jpaket_cara2`;

DROP TABLE IF EXISTS `jual_tunai`;
CREATE TABLE IF NOT EXISTS `jual_tunai` (
  `jtunai_id` int(30) NOT NULL AUTO_INCREMENT,
  `jtunai_nilai` double DEFAULT NULL,
  `jtunai_ref` varchar(50) DEFAULT NULL,
  `jtunai_creator` varchar(50) DEFAULT NULL,
  `jtunai_date_create` datetime DEFAULT NULL,
  `jtunai_update` varchar(50) DEFAULT NULL,
  `jtunai_date_update` datetime DEFAULT NULL,
  `jtunai_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`jtunai_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `jual_cek` CHANGE `jcek_valid` `jcek_valid` DATE NULL DEFAULT NULL;

ALTER TABLE `jual_transfer` ADD `jtransfer_nama` VARCHAR( 50 ) NULL AFTER `jtransfer_bank`;

ALTER TABLE `tindakan_detail` ADD `dtrawat_dapp` INT( 11 ) NULL AFTER `dtrawat_master`;

DELETE `menus`,`permissions` FROM `menus`,`permissions` WHERE `menus`.`menu_id`=`permissions`.`perm_menu` AND `menus`.`menu_link`='?c=c_tindakan';

ALTER TABLE `tindakan_detail` CHANGE `dtrawat_status` `dtrawat_status` ENUM( 'batal', 'selesai', 'datang' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'datang';