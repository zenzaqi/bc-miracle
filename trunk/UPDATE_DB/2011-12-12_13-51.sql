/*mengubah tipe data cust_hobi*/
ALTER TABLE `customer`  CHANGE COLUMN `cust_hobi` `cust_hobi` VARCHAR(30) NULL DEFAULT NULL AFTER `cust_profesitemp`