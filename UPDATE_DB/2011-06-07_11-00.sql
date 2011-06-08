ALTER TABLE `produk_group` ADD `group_dultah` INT( 11 ) NULL DEFAULT NULL AFTER `group_aktif` ,
ADD `group_dcard` INT( 11 ) NULL DEFAULT NULL AFTER `group_dultah` ,
ADD `group_dkolega` INT( 11 ) NULL DEFAULT NULL AFTER `group_dcard` ,
ADD `group_dkeluarga` INT( 11 ) NULL DEFAULT NULL AFTER `group_dkolega` ,
ADD `group_downer` INT( 11 ) NULL DEFAULT NULL AFTER `group_dkeluarga` ,
ADD `group_dgrooming` INT( 11 ) NULL DEFAULT NULL AFTER `group_downer`;