ALTER TABLE `crm_setup` DROP `setcrm_recency_value_equal`;
ALTER TABLE `crm_setup`  CHANGE COLUMN `setcrm_recency_bulan` `setcrm_recency_days` FLOAT NULL DEFAULT NULL;

ALTER TABLE `crm_value` CHANGE `crmvalue_freqency` `crmvalue_frequency` FLOAT NULL DEFAULT '0';
ALTER TABLE `crm_value` ADD `crmvalue_author` VARCHAR( 50 ) NULL AFTER `crmvalue_treatment`;
ALTER TABLE `crm_value`  ADD COLUMN `crmvalue_priority` VARCHAR(10) NULL AFTER `crmvalue_treatment`;
ALTER TABLE `crm_setup`  CHANGE COLUMN `setcrm_highmargin_month` `setcrm_highmargin_days` FLOAT NULL DEFAULT NULL;
ALTER TABLE `crm_setup`  CHANGE COLUMN `setcrm_frequency_bulan1` `setcrm_frequency_count` FLOAT NULL DEFAULT NULL, CHANGE COLUMN `setcrm_frequency_bulan2` `setcrm_frequency_days` FLOAT NULL DEFAULT NULL;
ALTER TABLE `crm_setup`  CHANGE COLUMN `setcrm_referal_month` `setcrm_referal_days` FLOAT NULL DEFAULT NULL,  CHANGE COLUMN `setcrm_treatment_month` `setcrm_treatment_days` FLOAT NULL DEFAULT NULL;
