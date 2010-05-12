ALTER TABLE `member` CHANGE `member_date_create` `member_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `voucher` ADD `voucher_acara` VARCHAR( 100 ) NULL AFTER `voucher_promo` ;