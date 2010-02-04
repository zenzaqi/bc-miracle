ALTER TABLE `voucher_terima` ADD `tvoucher_ref` VARCHAR( 50 ) NULL AFTER `tvoucher_id`;

ALTER TABLE `absensi` CHANGE `absensi_shift` `absensi_shift` ENUM( 'P', 'S', 'M', 'OFF', 'CT', 'H' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'OFF';