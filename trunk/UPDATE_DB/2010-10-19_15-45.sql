ALTER TABLE `crm_setup` DROP `setcrm_recency_value_equal`;

ALTER TABLE `crm_value` CHANGE `crmvalue_freqency` `crmvalue_frequency` FLOAT NULL DEFAULT '0';