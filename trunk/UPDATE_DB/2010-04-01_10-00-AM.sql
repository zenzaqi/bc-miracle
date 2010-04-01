ALTER TABLE `jual_card` ADD `jcard_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `jcard_ref` ;

ALTER TABLE `jual_cek` ADD `jcek_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `jcek_ref` ;

ALTER TABLE `jual_kredit` ADD `jkredit_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `jkredit_ref` ;

ALTER TABLE `jual_kwitansi` ADD `jkwitansi_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `jkwitansi_ref` ;

ALTER TABLE `jual_transfer` ADD `jtransfer_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `jtransfer_ref` ;

ALTER TABLE `jual_tunai` ADD `jtunai_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `jtunai_ref` ;

ALTER TABLE `voucher_terima` ADD `tvoucher_transaksi` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `tvoucher_ref` ;