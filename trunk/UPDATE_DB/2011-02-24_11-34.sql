/*create tabel transaksi setting*/
CREATE TABLE `transaksi_setting` (  `trans_op_days` VARCHAR(11) NULL,  `trans_author` VARCHAR(50) NULL,  `trans_date_create` DATETIME NULL,  `trans_update` VARCHAR(50) NULL,  `trans_date_update` DATETIME NULL,  `trans_revised` INT(11) NOT NULL DEFAULT '0' ) COLLATE='latin1_swedish_ci' ENGINE=MyISAM ROW_FORMAT=DEFAULT;

/*tambah menu Transaksi setting pada tabel menus*/
INSERT INTO `menus` (`menu_parent`, `menu_position`, `menu_title`) VALUES (1, 6, 'Transaction Setting');
UPDATE `menus` SET `menu_link`='?c=c_transaksi_setting', `menu_leftpanel`='Y' WHERE `menu_id`=425 LIMIT 1;
UPDATE `menus` SET `menu_position`=6 WHERE `menu_id`=14 LIMIT 1;
UPDATE `menus` SET `menu_position`=4 WHERE `menu_id`=425 LIMIT 1;
UPDATE `menus` SET `menu_position`=2 WHERE `menu_id`=425 LIMIT 1;
UPDATE `menus` SET `menu_position`=4 WHERE `menu_id`=11 LIMIT 1;

INSERT INTO `permissions` (`perm_group`, `perm_menu`, `perm_priv`) VALUES (1, 425, 'RCUD');