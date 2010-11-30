ALTER TABLE `appointment_detail` ADD INDEX `dapp_master_index` ( `dapp_master` ) ;

ALTER TABLE `appointment_detail` ADD INDEX `dapp_petugas_index` ( `dapp_petugas` ) ;

ALTER TABLE `appointment_detail` ADD INDEX `dapp_petugas2_index` ( `dapp_petugas2` ) ;

ALTER TABLE `customer` ADD INDEX `cust_referensi_index` ( `cust_referensi` ) ;

ALTER TABLE `customer` ADD INDEX `cust_unit_index` ( `cust_unit` ) ;

ALTER TABLE `customer` ADD INDEX `cust_member_index` ( `cust_member` ) ;

ALTER TABLE `crm_value` ADD INDEX `crmvalue_cust_index` ( `crmvalue_cust` ) ;

ALTER TABLE `detail_jual_produk` ADD INDEX `dproduk_master_index` ( `dproduk_master` ) ;

ALTER TABLE `detail_jual_paket` ADD INDEX `dpaket_master_index` ( `dpaket_master` ) ;

ALTER TABLE `detail_jual_rawat` ADD INDEX `drawat_master_index` ( `drawat_master` ) ;