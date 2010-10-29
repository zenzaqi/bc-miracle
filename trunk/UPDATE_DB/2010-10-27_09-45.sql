ALTER TABLE  `resep_dokter` ADD  `resep_cust_manual` VARCHAR( 100 ) NOT NULL AFTER  `resep_custid`;


ALTER TABLE `resep_dokter` ADD `resep_nofaktur` VARCHAR( 30 ) NOT NULL AFTER `resep_no`;


ALTER TABLE `customer` ADD `cust_fretfulness` ENUM( 'High', 'Medium', 'Low' ) NULL DEFAULT NULL AFTER `cust_aktif`;