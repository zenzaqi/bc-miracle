ALTER TABLE `customer` CHANGE `cust_fretfulness` `cust_fretfulness` ENUM( 'High', 'Medium', 'Low' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Medium';


UPDATE `customer` set `cust_fretfulness` = 'Medium';