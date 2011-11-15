ALTER TABLE `temp_netsales`  ADD COLUMN `tns_source` ENUM('MIS','Manual') NULL AFTER `tns_date_create`;

update temp_netsales
set tns_source = 'MIS';