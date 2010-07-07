ALTER TABLE `voucher_terima` CHANGE `tvoucher_date_create`  `tvoucher_date_create`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `voucher_terima` ADD `tvoucher_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `tvoucher_nilai` ;

ALTER TABLE `jual_card` ADD `jcard_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `jcard_status` ;

ALTER TABLE `jual_cek` ADD `jcek_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `jcek_status` ;

ALTER TABLE `jual_kredit` ADD `jkredit_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `jkredit_status` ;

ALTER TABLE `jual_kwitansi` ADD `jkwitansi_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `jkwitansi_transaksi` ;

ALTER TABLE `jual_transfer` ADD `jtransfer_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `jtransfer_status` ;

ALTER TABLE `jual_tunai` ADD `jtunai_stat_dok` ENUM( 'Terbuka', 'Tertutup', 'Batal' ) NOT NULL DEFAULT 'Terbuka' AFTER `jtunai_transaksi` ;