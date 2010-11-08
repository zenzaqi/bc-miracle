-- CRM

ALTER TABLE `crm_setup` ADD `setcrm_disiplin_days` FLOAT NOT NULL AFTER `setcrm_kerewelan_low` ,
ADD `setcrm_disiplin_persentase_pembatalan` FLOAT NOT NULL AFTER `setcrm_disiplin_days` ,
ADD `setcrm_disiplin_persentase_telat` FLOAT NOT NULL AFTER `setcrm_disiplin_persentase_pembatalan` ,
ADD `setcrm_disiplin_menit_telat` FLOAT NOT NULL AFTER `setcrm_disiplin_persentase_telat` ,
ADD `setcrm_disiplin_batal_value_morethan` FLOAT NOT NULL AFTER `setcrm_disiplin_menit_telat` ,
ADD `setcrm_disiplin_batal_value_lessthan` FLOAT NOT NULL AFTER `setcrm_disiplin_batal_value_morethan` ,
ADD `setcrm_disiplin_telat_value_morethan` FLOAT NOT NULL AFTER `setcrm_disiplin_batal_value_lessthan` ,
ADD `setcrm_disiplin_telat_value_lessthan` FLOAT NOT NULL AFTER `setcrm_disiplin_telat_value_morethan` ;




ALTER TABLE `crm_setup` ADD `setcrm_result_nilai_atas` FLOAT NOT NULL AFTER `setcrm_treatment_lessthan` ,
ADD `setcrm_result_nilai_bawah` FLOAT NOT NULL AFTER `setcrm_result_nilai_atas` 