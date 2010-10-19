ALTER TABLE `crm_setup` DROP `setcrm_recency_value_equal`;
ALTER TABLE `crm_setup`  CHANGE COLUMN `setcrm_recency_bulan` `setcrm_recency_days` FLOAT NULL DEFAULT NULL;

ALTER TABLE `crm_value` CHANGE `crmvalue_freqency` `crmvalue_frequency` FLOAT NULL DEFAULT '0';
ALTER TABLE `crm_value` ADD `crmvalue_author` VARCHAR( 50 ) NULL AFTER `crmvalue_treatment`;