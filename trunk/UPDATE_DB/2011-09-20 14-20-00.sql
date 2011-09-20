UPDATE `menus` SET `menu_title` = 'Go to Help Desk',
`menu_link` = '?c=c_helpdesk' WHERE `menus`.`menu_id` =383 LIMIT 1 ;

INSERT INTO `menus` (
`menu_id` ,
`menu_kode` ,
`menu_parent` ,
`menu_position` ,
`menu_title` ,
`menu_link` ,
`menu_cat` ,
`menu_confirm` ,
`menu_leftpanel` ,
`menu_iconpanel` ,
`menu_iconmenu`
)
VALUES (
NULL , NULL , '382', '2', 'Help Desk', '?c=c_permintaan_it', 'window', 'N', 'Y', NULL , NULL
);