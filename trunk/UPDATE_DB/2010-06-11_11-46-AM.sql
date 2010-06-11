ALTER TABLE `member` ADD `member_membert` INT NOT NULL DEFAULT '0' AFTER `member_cust` ;

ALTER TABLE `customer` CHANGE `cust_member` `cust_member` INT NOT NULL DEFAULT '0';