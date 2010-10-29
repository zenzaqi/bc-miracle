ALTER TABLE `promo`
  DROP `promo_cashback`,
  DROP `promo_mincash`;

ALTER TABLE `promo` CHANGE `promo_allproduk` `promo_allproduk` ENUM( 'T', 'Y' ) NOT NULL DEFAULT 'T';
ALTER TABLE `promo` CHANGE `promo_allrawat` `promo_allrawat` ENUM( 'T', 'Y' ) NOT NULL DEFAULT 'T' ;