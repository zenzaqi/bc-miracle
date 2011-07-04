/*create menu baru*/
INSERT INTO `menus` (`menu_id`, `menu_kode`, `menu_parent`, `menu_position`, `menu_title`, `menu_link`, `menu_cat`, `menu_confirm`, `menu_leftpanel`, `menu_iconpanel`, `menu_iconmenu`) VALUES (433, NULL, 9, 23, 'Laporan Waktu Tunggu', '?c=c_lap_waktu_tunggu', 'window', 'N', 'Y', NULL, NULL);

INSERT INTO `permissions` (`perm_group`, `perm_menu`, `perm_priv`) VALUES (1, 433, 'RCUD');


