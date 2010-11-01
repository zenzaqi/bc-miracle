ALTER TABLE `voucher`
  DROP `voucher_mincash`,
  DROP `voucher_diskon`,
  DROP `voucher_promo`,
  DROP `voucher_acara`,
  DROP `voucher_allproduk`,
  DROP `voucher_allrawat`;

ALTER TABLE `voucher` ADD `voucher_cust` VARCHAR( 30 ) NULL AFTER `voucher_nama` ;
