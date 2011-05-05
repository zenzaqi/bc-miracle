INSERT INTO `menus` (`menu_id`, `menu_kode`, `menu_parent`, `menu_position`, `menu_title`, `menu_link`, `menu_cat`, `menu_confirm`, `menu_leftpanel`, `menu_iconpanel`, `menu_iconmenu`) VALUES (431, 'MENU_SENT_ITEM', 372, 7, 'Sent Item', '?c=c_sent_item', 'window', 'N', 'Y', NULL, NULL);

INSERT INTO `permissions` (`perm_group`, `perm_menu`, `perm_priv`) VALUES (1, 431, 'RCUD');