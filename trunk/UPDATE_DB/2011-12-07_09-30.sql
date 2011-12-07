ALTER TABLE `welcome_msg` ADD COLUMN `welcome_menu`  int(10) NOT NULL DEFAULT 0 AFTER `welcome_group`;

ALTER TABLE `welcome_msg` MODIFY COLUMN `welcome_tglawal`  date NOT NULL AFTER `welcome_menu`;

ALTER TABLE `welcome_msg` ADD COLUMN `welcome_title`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `welcome_msg`;

ALTER TABLE `welcome_msg` ADD COLUMN `welcome_icon`  enum('INFO','WARNING','ERROR','QUESTION') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'INFO' AFTER `welcome_title`;

ALTER TABLE `welcome_msg` MODIFY COLUMN `welcome_datecreate`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `welcome_icon`;

