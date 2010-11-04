--utk keperluan CRM

ALTER TABLE `customer` CHANGE `cust_fretfulness` `cust_fretfulness` ENUM( 'High', 'Medium', 'Low', 'Undefined' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Medium';

update customer c
set c.cust_fretfulness = 'Undefined';