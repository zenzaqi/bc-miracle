/* UPDATE VIEW PERMISSIONS */
CREATE OR REPLACE VIEW `vu_permissions`
AS
   SELECT `menus`.`menu_id` AS `menu_id`,
          `menus`.`menu_parent` AS `menu_parent`,
          `menus`.`menu_kode` AS `menu_kode`,
          `menus`.`menu_position` AS `menu_position`,
          `menus`.`menu_title` AS `menu_title`,
          `menus`.`menu_link` AS `menu_link`,
          `menus`.`menu_cat` AS `menu_cat`,
          `menus`.`menu_confirm` AS `menu_confirm`,
          `menus`.`menu_leftpanel` AS `menu_leftpanel`,
          `menus`.`menu_iconpanel` AS `menu_iconpanel`,
          `menus`.`menu_iconmenu` AS `menu_iconmenu`,
          `permissions`.`perm_priv` AS `perm_priv`,
          `permissions`.`perm_group` AS `perm_group`,
          `usergroups`.`group_name` AS `group_name`,
          `usergroups`.`group_desc` AS `group_desc`,
          `usergroups`.`group_active` AS `group_active`,
          `usergroups`.`group_id` AS `group_id`,
          `permissions`.`perm_menu` AS `perm_menu`,
          (`permissions`.`perm_priv` LIKE _LATIN1 '%R%') AS `perm_read`,
          (`permissions`.`perm_priv` LIKE _LATIN1 '%C%') AS `perm_create`,
          (`permissions`.`perm_priv` LIKE _LATIN1 '%U%') AS `perm_update`,
          (`permissions`.`perm_priv` LIKE _LATIN1 '%D%') AS `perm_delete`
     FROM (   (   `menus`
               LEFT JOIN
                  `permissions`
               ON ((`permissions`.`perm_menu` = `menus`.`menu_id`)))
           LEFT JOIN
              `usergroups`
           ON ((`usergroups`.`group_id` = `permissions`.`perm_group`)));