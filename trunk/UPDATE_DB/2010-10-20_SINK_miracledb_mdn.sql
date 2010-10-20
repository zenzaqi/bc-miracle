CREATE TABLE `akun_setup` (
`setup_id`  int(11) NOT NULL AUTO_INCREMENT ,
`setup_periode_tahun`  year NULL DEFAULT 2010 ,
`setup_periode_awal`  date NULL DEFAULT NULL ,
`setup_periode_akhir`  date NULL DEFAULT NULL ,
`setup_author`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`setup_date_create`  datetime NULL DEFAULT NULL ,
`setup_update`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`setup_date_update`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
`setup_revised`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`setup_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0

;

ALTER TABLE `buku_besar` MODIFY COLUMN `buku_tanggal`  datetime NULL DEFAULT NULL AFTER `buku_id`;

ALTER TABLE `buku_besar` ADD COLUMN `buku_ref`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `buku_tanggal`;

ALTER TABLE `buku_besar` MODIFY COLUMN `buku_akun`  int(11) NULL DEFAULT NULL AFTER `buku_ref`;

ALTER TABLE `buku_besar` ADD COLUMN `buku_akun_kode`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `buku_akun`;

ALTER TABLE `buku_besar` MODIFY COLUMN `buku_debet`  double NULL DEFAULT NULL AFTER `buku_akun_kode`;

ALTER TABLE `buku_besar` MODIFY COLUMN `buku_kredit`  double NULL DEFAULT NULL AFTER `buku_debet`;

ALTER TABLE `buku_besar` ADD COLUMN `buku_author`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `buku_kredit`;

ALTER TABLE `buku_besar` MODIFY COLUMN `buku_date_create`  datetime NULL DEFAULT NULL AFTER `buku_author`;

ALTER TABLE `buku_besar` MODIFY COLUMN `buku_date_update`  datetime NULL DEFAULT NULL AFTER `buku_update`;

ALTER TABLE `buku_besar` DROP COLUMN `buku_saldo_debet`;

ALTER TABLE `buku_besar` DROP COLUMN `buku_saldo_kredit`;

ALTER TABLE `buku_besar` DROP COLUMN `buku_creator`;

ALTER TABLE `crm_setup` ADD COLUMN `setcrm_frequency_count`  float NULL DEFAULT NULL AFTER `setcrm_id`;

ALTER TABLE `crm_setup` ADD COLUMN `setcrm_frequency_days`  float NULL DEFAULT NULL AFTER `setcrm_frequency_count`;

ALTER TABLE `crm_setup` MODIFY COLUMN `setcrm_frequency_value_morethan`  float NULL DEFAULT NULL AFTER `setcrm_frequency_days`;

ALTER TABLE `crm_setup` ADD COLUMN `setcrm_recency_days`  float NULL DEFAULT NULL AFTER `setcrm_frequency_value_lessthan`;

ALTER TABLE `crm_setup` MODIFY COLUMN `setcrm_recency_value_morethan`  float NULL DEFAULT NULL AFTER `setcrm_recency_days`;

ALTER TABLE `crm_setup` MODIFY COLUMN `setcrm_recency_value_lessthan`  float NULL DEFAULT NULL AFTER `setcrm_recency_value_morethan`;

ALTER TABLE `crm_setup` ADD COLUMN `setcrm_highmargin_days`  float NULL DEFAULT NULL AFTER `setcrm_highmargin_treatment`;

ALTER TABLE `crm_setup` MODIFY COLUMN `setcrm_highmargin_value_morethan`  float NULL DEFAULT NULL AFTER `setcrm_highmargin_days`;

ALTER TABLE `crm_setup` ADD COLUMN `setcrm_referal_days`  float NULL DEFAULT NULL AFTER `setcrm_referal_person`;

ALTER TABLE `crm_setup` MODIFY COLUMN `setcrm_referal_morethan`  float NULL DEFAULT NULL AFTER `setcrm_referal_days`;

ALTER TABLE `crm_setup` ADD COLUMN `setcrm_treatment_days`  float NULL DEFAULT NULL AFTER `setcrm_disiplin_low`;

ALTER TABLE `crm_setup` MODIFY COLUMN `setcrm_treatment_nonmedis`  float NULL DEFAULT NULL AFTER `setcrm_treatment_days`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_frequency_bulan1`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_frequency_bulan2`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_recency_bulan`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_recency_value_equal`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_highmargin_month`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_referal_month`;

ALTER TABLE `crm_setup` DROP COLUMN `setcrm_treatment_month`;

ALTER TABLE `crm_value` ADD COLUMN `crmvalue_frequency`  float NULL DEFAULT 0 AFTER `crmvalue_cust`;

ALTER TABLE `crm_value` MODIFY COLUMN `crmvalue_recency`  float NULL DEFAULT 0 AFTER `crmvalue_frequency`;

ALTER TABLE `crm_value` ADD COLUMN `crmvalue_priority`  varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `crmvalue_treatment`;

ALTER TABLE `crm_value` ADD COLUMN `crmvalue_author`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `crmvalue_priority`;

ALTER TABLE `crm_value` DROP COLUMN `crmvalue_freqency`;

ALTER TABLE `crm_value` ROW_FORMAT=Dynamic;

ALTER TABLE `detail_ambil_paket` MODIFY COLUMN `dapaket_keterangan`  varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `dapaket_referal`;

CREATE TABLE `jurnal` (
`jurnal_id`  int(11) NOT NULL AUTO_INCREMENT ,
`jurnal_no`  varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`jurnal_tanggal`  date NULL DEFAULT NULL ,
`jurnal_keterangan`  varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`jurnal_noref`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`jurnal_unit`  int(65) NULL DEFAULT NULL ,
`jurnal_author`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`jurnal_date_create`  datetime NULL DEFAULT NULL ,
`jurnal_update`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`jurnal_date_update`  datetime NULL DEFAULT NULL ,
`jurnal_post`  enum('T','Y') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'T' ,
`jurnal_date_post`  datetime NULL DEFAULT NULL ,
`jurnal_arsip`  enum('T','Y') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'T' ,
`jurnal_revised`  smallint(6) NULL DEFAULT NULL ,
PRIMARY KEY (`jurnal_id`),
INDEX `id_jurnal` USING BTREE (`jurnal_id`) ,
INDEX `ID_Unit` USING BTREE (`jurnal_author`) ,
INDEX `TransactionID` USING BTREE (`jurnal_noref`) 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0

;

CREATE TABLE `jurnal_detail` (
`djurnal_id`  int(11) NOT NULL AUTO_INCREMENT ,
`djurnal_master`  int(11) NULL DEFAULT NULL ,
`djurnal_akun`  int(11) NULL DEFAULT NULL ,
`djurnal_detail`  varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`djurnal_debet`  double NULL DEFAULT NULL ,
`djurnal_kredit`  double NULL DEFAULT NULL ,
PRIMARY KEY (`djurnal_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0

;

ALTER TABLE `paket` MODIFY COLUMN `paket_jmlisi`  int(11) NULL DEFAULT 0 AFTER `paket_expired`;

ALTER TABLE `paket` DROP COLUMN `paket_perpanjangan`;

DROP TABLE `jurnal_umum`;

DROP TABLE `jurnal_umum_detail`;

DROP TABLE `perawatan_pusat`;

DROP TABLE `produk_pusat`;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_buku_besar`AS 
select `buku_besar`.`buku_id` AS `buku_id`,`buku_besar`.`buku_tanggal` AS `buku_tanggal`,`buku_besar`.`buku_ref` AS `buku_ref`,`buku_besar`.`buku_akun` AS `buku_akun`,`buku_besar`.`buku_debet` AS `buku_debet`,`buku_besar`.`buku_kredit` AS `buku_kredit`,`buku_besar`.`buku_author` AS `buku_author`,`buku_besar`.`buku_date_create` AS `buku_date_create`,`buku_besar`.`buku_update` AS `buku_update`,`buku_besar`.`buku_date_update` AS `buku_date_update`,`buku_besar`.`buku_revised` AS `buku_revised`,`akun`.`akun_id` AS `akun_id`,`akun`.`akun_parent_kode` AS `akun_parent_kode`,`akun`.`akun_kode` AS `akun_kode`,`akun`.`akun_jenis` AS `akun_jenis`,`akun`.`akun_parent` AS `akun_parent`,`akun`.`akun_level` AS `akun_level`,`akun`.`akun_nama` AS `akun_nama`,`akun`.`akun_debet` AS `akun_debet`,`akun`.`akun_kredit` AS `akun_kredit`,`akun`.`akun_saldo` AS `akun_saldo` from (`buku_besar` join `akun` on((`buku_besar`.`buku_akun` = `akun`.`akun_id`))) 
;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_jual_paket` AS 
select `detail_jual_paket`.`dpaket_master` AS `dpaket_master`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,`paket`.`paket_nama` AS `produk_nama`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`detail_jual_paket`.`dpaket_jumlah` AS `jumlah_barang`,`detail_jual_paket`.`dpaket_harga` AS `harga_satuan`,`detail_jual_paket`.`dpaket_diskon` AS `dpaket_diskon`,if((ifnull(`detail_jual_paket`.`dpaket_diskon_jenis`,_latin1'-') = _latin1''),_latin1'-',ifnull(`detail_jual_paket`.`dpaket_diskon_jenis`,_latin1'-')) AS `diskon_jenis`,if((ifnull(`detail_jual_paket`.`dpaket_sales`,_latin1'-') = _latin1''),_latin1'-',ifnull(`detail_jual_paket`.`dpaket_sales`,_latin1'-')) AS `sales`,`master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`paket`.`paket_kode` AS `produk_kode`,_utf8'paket' AS `satuan_nama`,`detail_jual_paket`.`dpaket_diskon` AS `diskon`,(((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * `detail_jual_paket`.`dpaket_diskon`) / 100) AS `diskon_nilai`,((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) - (((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * `detail_jual_paket`.`dpaket_diskon`) / 100)) AS `subtotal`,`master_jual_paket`.`jpaket_tanggal` AS `tanggal`,`customer`.`cust_id` AS `cust_id`,`master_jual_paket`.`jpaket_stat_dok` AS `jpaket_stat_dok`,`master_jual_paket`.`jpaket_keterangan` AS `keterangan`,`paket`.`paket_id` AS `produk_id` from ((((`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`))) left join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) left join `kategori2` on((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`))) ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_jual_produk` AS 
select `detail_jual_produk`.`dproduk_id` AS `dproduk_id`,`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`detail_jual_produk`.`dproduk_jumlah` AS `jumlah_barang`,`detail_jual_produk`.`dproduk_harga` AS `harga_satuan`,`detail_jual_produk`.`dproduk_diskon` AS `diskon`,if((ifnull(`detail_jual_produk`.`dproduk_diskon_jenis`,_latin1'-') = _latin1''),_latin1'-',ifnull(`detail_jual_produk`.`dproduk_diskon_jenis`,_latin1'-')) AS `diskon_jenis`,if((ifnull(`karyawan`.`karyawan_username`,_latin1'-') = _latin1''),_latin1'-',ifnull(`karyawan`.`karyawan_username`,_latin1'-')) AS `sales`,`master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`master_jual_produk`.`jproduk_keterangan` AS `keterangan`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan`.`satuan_nama` AS `satuan_nama`,`produk`.`produk_id` AS `produk_id`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,(((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) / 100) * `detail_jual_produk`.`dproduk_jumlah`)) AS `diskon_nilai`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_jumlah`) - (((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) * `detail_jual_produk`.`dproduk_jumlah`) / 100))) AS `subtotal`,`master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok` from (((((`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) left join `customer` on((`master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`))) left join `produk` on((`detail_jual_produk`.`dproduk_produk` = `produk`.`produk_id`))) left join `satuan` on((`detail_jual_produk`.`dproduk_satuan` = `satuan`.`satuan_id`))) left join `karyawan` on((`detail_jual_produk`.`dproduk_karyawan` = `karyawan`.`karyawan_id`))) ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_lunas_piutang` AS 
select `master_lunas_piutang`.`lpiutang_faktur` AS `no_bukti`,`master_lunas_piutang`.`lpiutang_cust` AS `lpiutang_cust`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`master_lunas_piutang`.`lpiutang_faktur_tanggal` AS `tanggal`,`master_lunas_piutang`.`lpiutang_keterangan` AS `lpiutang_keterangan`,`master_lunas_piutang`.`lpiutang_status` AS `lpiutang_status`,`master_lunas_piutang`.`lpiutang_total` AS `lpiutang_total`,`master_lunas_piutang`.`lpiutang_sisa` AS `lpiutang_sisa`,`master_lunas_piutang`.`lpiutang_jenis_transaksi` AS `lpiutang_jenis_transaksi`,`master_lunas_piutang`.`lpiutang_stat_dok` AS `lpiutang_stat_dok`,`detail_lunas_piutang`.`dpiutang_id` AS `dpiutang_id`,`detail_lunas_piutang`.`dpiutang_nobukti` AS `dpiutang_nobukti`,ifnull(`detail_lunas_piutang`.`dpiutang_nilai`,0) AS `dpiutang_nilai`,ifnull(`detail_lunas_piutang`.`dpiutang_tanggal`,_utf8'-') AS `dpiutang_tanggal`,ifnull(`detail_lunas_piutang`.`dpiutang_cara`,_latin1'-') AS `dpiutang_cara` from ((`master_lunas_piutang` left join `detail_lunas_piutang` on((`master_lunas_piutang`.`lpiutang_id` = `detail_lunas_piutang`.`dpiutang_master`))) join `customer` on((`master_lunas_piutang`.`lpiutang_cust` = `customer`.`cust_id`))) ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_piutang_card` AS 
select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_card` from `detail_lunas_piutang` where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'card') group by `detail_lunas_piutang`.`dpiutang_master` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_piutang_cek` AS 
select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_cek` from `detail_lunas_piutang` where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'cek/giro') group by `detail_lunas_piutang`.`dpiutang_master` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_piutang_transfer` AS 
select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_transfer` from `detail_lunas_piutang` where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'transfer') group by `detail_lunas_piutang`.`dpiutang_master` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_detail_piutang_tunai` AS 
select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_tunai` from `detail_lunas_piutang` where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'tunai') group by `detail_lunas_piutang`.`dpiutang_master` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_detail_retur_beli` AS 
select `master_retur_beli`.`rbeli_nobukti` AS `no_bukti`,`master_retur_beli`.`rbeli_tanggal` AS `tanggal`,`master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_beli`.`drbeli_jumlah` AS `drbeli_jumlah`,`detail_retur_beli`.`drbeli_jumlah` AS `jumlah_barang`,`detail_retur_beli`.`drbeli_harga` AS `drbeli_harga`,`detail_retur_beli`.`drbeli_diskon` AS `drbeli_diskon`,`detail_retur_beli`.`drbeli_diskon` AS `diskon`,`detail_retur_beli`.`drbeli_harga` AS `harga_satuan`,(((`detail_retur_beli`.`drbeli_diskon` * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) / 100) AS `diskon_nilai`,((((100 - `detail_retur_beli`.`drbeli_diskon`) / 100) * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) AS `subtotal`,`supplier`.`supplier_akun` AS `supplier_akun` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_retur_beli`.`drbeli_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_retur_beli`.`drbeli_satuan` = `satuan`.`satuan_id`))) ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jpaket_cust_point_sink` AS 
select `vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,sum(`vu_jpaket_total_point`.`jpaket_total_point`) AS `cust_total_point` from (`vu_jpaket_total_point` join `master_jual_paket` on((`vu_jpaket_total_point`.`jpaket_id` = `master_jual_paket`.`jpaket_id`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` between _utf8'2010-07-15' and _utf8'2010-10-05') and (`master_jual_paket`.`jpaket_point` = 0)) group by `vu_jpaket_total_point`.`jpaket_cust` ;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jpaket_cust_point_sink_2`AS 
select `vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,sum(`vu_jpaket_total_point`.`jpaket_total_point`) AS `cust_total_point` from (`vu_jpaket_total_point` join `master_jual_paket` on((`vu_jpaket_total_point`.`jpaket_id` = `master_jual_paket`.`jpaket_id`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` >= _utf8'2010-10-06') and (`master_jual_paket`.`jpaket_point` = 0)) group by `vu_jpaket_total_point`.`jpaket_cust` 
;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jpaket_point_sink` AS 
select `vu_jpaket_total_point`.`jpaket_id` AS `jpaket_id`,`vu_jpaket_total_point`.`jpaket_nobukti` AS `jpaket_nobukti`,`vu_jpaket_total_point`.`jpaket_tanggal` AS `jpaket_tanggal`,`vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,`vu_jpaket_total_point`.`dpaket_total_nilai` AS `dpaket_total_nilai`,`vu_jpaket_total_point`.`jpaket_total_point` AS `jpaket_total_point` from ((`vu_jpaket_total_point` join `master_jual_paket` on((`master_jual_paket`.`jpaket_id` = `vu_jpaket_total_point`.`jpaket_id`))) join `member` on((`vu_jpaket_total_point`.`jpaket_cust` = `member`.`member_cust`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`master_jual_paket`.`jpaket_point` = 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` >= _utf8'2010-07-15') and (`member`.`member_valid` > `vu_jpaket_total_point`.`jpaket_tanggal`)) group by `vu_jpaket_total_point`.`jpaket_id` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jpaket_total_point` AS 
select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,sum(floor(((((`detail_jual_paket`.`dpaket_jumlah` * `detail_jual_paket`.`dpaket_harga`) * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100)) * `paket`.`paket_point`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1)))) AS `jpaket_total_point` from (((`detail_jual_paket` join `master_jual_paket` on(((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`) and (`master_jual_paket`.`jpaket_stat_dok` = _latin1'Tertutup')))) join `member` on(((`master_jual_paket`.`jpaket_cust` = `member`.`member_cust`) and ((`member`.`member_valid` + interval (select `member_setup`.`setmember_periodetenggang` AS `setmember_periodetenggang` from `member_setup` limit 1) day) >= `master_jual_paket`.`jpaket_tanggal`) and (`member`.`member_register` < `master_jual_paket`.`jpaket_tanggal`)))) join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) group by `detail_jual_paket`.`dpaket_master` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jproduk_cust_point_sink` AS 
select `vu_jproduk_total_point`.`jproduk_cust` AS `jproduk_cust`,sum(`vu_jproduk_total_point`.`jproduk_total_point`) AS `cust_total_point` from (`vu_jproduk_total_point` join `master_jual_produk` on((`vu_jproduk_total_point`.`jproduk_id` = `master_jual_produk`.`jproduk_id`))) where ((`vu_jproduk_total_point`.`jproduk_total_point` > 0) and (`vu_jproduk_total_point`.`jproduk_tanggal` between _utf8'2010-07-15' and _utf8'2010-10-05') and (`master_jual_produk`.`jproduk_point` = 0)) group by `vu_jproduk_total_point`.`jproduk_cust` ;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jproduk_cust_point_sink_2`AS 
select `vu_jproduk_total_point`.`jproduk_cust` AS `jproduk_cust`,sum(`vu_jproduk_total_point`.`jproduk_total_point`) AS `cust_total_point` from (`vu_jproduk_total_point` join `master_jual_produk` on((`vu_jproduk_total_point`.`jproduk_id` = `master_jual_produk`.`jproduk_id`))) where ((`vu_jproduk_total_point`.`jproduk_total_point` > 0) and (`vu_jproduk_total_point`.`jproduk_tanggal` >= _utf8'2010-10-06') and (`master_jual_produk`.`jproduk_point` = 0)) group by `vu_jproduk_total_point`.`jproduk_cust` 
;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jproduk_point_sink` AS 
select `vu_jproduk_total_point`.`jproduk_id` AS `jproduk_id`,`vu_jproduk_total_point`.`jproduk_nobukti` AS `jproduk_nobukti`,`vu_jproduk_total_point`.`jproduk_tanggal` AS `jproduk_tanggal`,`vu_jproduk_total_point`.`jproduk_cust` AS `jproduk_cust`,`vu_jproduk_total_point`.`dproduk_total_nilai` AS `dproduk_total_nilai`,`vu_jproduk_total_point`.`jproduk_total_point` AS `jproduk_total_point` from ((`vu_jproduk_total_point` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `vu_jproduk_total_point`.`jproduk_id`))) join `member` on((`vu_jproduk_total_point`.`jproduk_cust` = `member`.`member_cust`))) where ((`vu_jproduk_total_point`.`jproduk_total_point` > 0) and (`master_jual_produk`.`jproduk_point` = 0) and (`vu_jproduk_total_point`.`jproduk_tanggal` >= _utf8'2010-07-15') and (`member`.`member_valid` > `vu_jproduk_total_point`.`jproduk_tanggal`)) group by `vu_jproduk_total_point`.`jproduk_id` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jproduk_total_point` AS 
select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,sum(floor(((((`detail_jual_produk`.`dproduk_jumlah` * `detail_jual_produk`.`dproduk_harga`) * ((100 - `detail_jual_produk`.`dproduk_diskon`) / 100)) * `produk`.`produk_point`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1)))) AS `jproduk_total_point` from (((`detail_jual_produk` join `master_jual_produk` on(((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`) and (`master_jual_produk`.`jproduk_stat_dok` = _latin1'Tertutup')))) join `member` on(((`master_jual_produk`.`jproduk_cust` = `member`.`member_cust`) and ((`member`.`member_valid` + interval (select `member_setup`.`setmember_periodetenggang` AS `setmember_periodetenggang` from `member_setup` limit 1) day) >= `master_jual_produk`.`jproduk_tanggal`) and (`member`.`member_register` < `master_jual_produk`.`jproduk_tanggal`)))) join `produk` on((`detail_jual_produk`.`dproduk_produk` = `produk`.`produk_id`))) group by `detail_jual_produk`.`dproduk_master` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jrawat_cust_point_sink` AS 
select `vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,sum(`vu_jrawat_total_point`.`jrawat_total_point`) AS `cust_total_point` from (`vu_jrawat_total_point` join `master_jual_rawat` on((`vu_jrawat_total_point`.`jrawat_id` = `master_jual_rawat`.`jrawat_id`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` between _utf8'2010-07-15' and _utf8'2010-10-05') and (`master_jual_rawat`.`jrawat_point` = 0)) group by `vu_jrawat_total_point`.`jrawat_cust` ;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jrawat_cust_point_sink_2`AS 
select `vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,sum(`vu_jrawat_total_point`.`jrawat_total_point`) AS `cust_total_point` from (`vu_jrawat_total_point` join `master_jual_rawat` on((`vu_jrawat_total_point`.`jrawat_id` = `master_jual_rawat`.`jrawat_id`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` >= _utf8'2010-10-06') and (`master_jual_rawat`.`jrawat_point` = 0)) group by `vu_jrawat_total_point`.`jrawat_cust` 
;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jrawat_point_sink` AS 
select `vu_jrawat_total_point`.`jrawat_id` AS `jrawat_id`,`vu_jrawat_total_point`.`jrawat_nobukti` AS `jrawat_nobukti`,`vu_jrawat_total_point`.`jrawat_tanggal` AS `jrawat_tanggal`,`vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,`vu_jrawat_total_point`.`drawat_total_nilai` AS `drawat_total_nilai`,`vu_jrawat_total_point`.`jrawat_total_point` AS `jrawat_total_point` from ((`vu_jrawat_total_point` join `master_jual_rawat` on((`master_jual_rawat`.`jrawat_id` = `vu_jrawat_total_point`.`jrawat_id`))) join `member` on((`vu_jrawat_total_point`.`jrawat_cust` = `member`.`member_cust`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`master_jual_rawat`.`jrawat_point` = 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` >= _utf8'2010-07-15') and (`member`.`member_valid` > `vu_jrawat_total_point`.`jrawat_tanggal`)) group by `vu_jrawat_total_point`.`jrawat_id` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY INVOKER 
VIEW `vu_jrawat_total_point` AS 
select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,sum(floor(((((`detail_jual_rawat`.`drawat_jumlah` * `detail_jual_rawat`.`drawat_harga`) * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100)) * `perawatan`.`rawat_point`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1)))) AS `jrawat_total_point` from (((`detail_jual_rawat` join `master_jual_rawat` on(((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`) and (`master_jual_rawat`.`jrawat_stat_dok` = _latin1'Tertutup')))) join `member` on(((`master_jual_rawat`.`jrawat_cust` = `member`.`member_cust`) and ((`member`.`member_valid` + interval (select `member_setup`.`setmember_periodetenggang` AS `setmember_periodetenggang` from `member_setup` limit 1) day) >= `master_jual_rawat`.`jrawat_tanggal`) and (`member`.`member_register` < `master_jual_rawat`.`jrawat_tanggal`)))) join `perawatan` on((`detail_jual_rawat`.`drawat_rawat` = `perawatan`.`rawat_id`))) group by `detail_jual_rawat`.`drawat_master` ;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_jurnal`AS 
select `jurnal`.`jurnal_id` AS `jurnal_id`,`jurnal`.`jurnal_no` AS `jurnal_no`,`jurnal`.`jurnal_tanggal` AS `jurnal_tanggal`,`jurnal_detail`.`djurnal_akun` AS `djurnal_akun`,`jurnal_detail`.`djurnal_detail` AS `djurnal_detail`,`jurnal_detail`.`djurnal_debet` AS `djurnal_debet`,`jurnal_detail`.`djurnal_kredit` AS `djurnal_kredit`,`jurnal`.`jurnal_unit` AS `jurnal_unit`,`jurnal`.`jurnal_author` AS `jurnal_author`,`jurnal`.`jurnal_date_create` AS `jurnal_date_create`,`jurnal`.`jurnal_update` AS `jurnal_update`,`jurnal`.`jurnal_date_update` AS `jurnal_date_update`,`jurnal`.`jurnal_post` AS `jurnal_post`,`jurnal`.`jurnal_date_post` AS `jurnal_date_post`,`jurnal`.`jurnal_revised` AS `jurnal_revised`,`akun`.`akun_kode` AS `akun_kode`,`akun`.`akun_jenis` AS `akun_jenis`,`akun`.`akun_parent` AS `akun_parent`,`akun`.`akun_level` AS `akun_level`,`akun`.`akun_nama` AS `akun_nama`,`jurnal_detail`.`djurnal_master` AS `djurnal_master`,`jurnal_detail`.`djurnal_id` AS `djurnal_id` from ((`jurnal` join `jurnal_detail` on((`jurnal_detail`.`djurnal_master` = `jurnal`.`jurnal_id`))) join `akun` on((`jurnal_detail`.`djurnal_akun` = `akun`.`akun_id`))) 
;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_jurnal_bank`AS 
select `vu_kasbank`.`kasbank_tanggal` AS `tanggal`,`vu_kasbank`.`kasbank_nobukti` AS `no_jurnal`,`vu_kasbank`.`kasbank_akun` AS `akun`,`vu_kasbank`.`akun_kode` AS `akun_kode`,`vu_kasbank`.`akun_nama` AS `akun_nama`,`vu_kasbank`.`kasbank_terimauntuk` AS `terimauntuk`,`vu_kasbank`.`kasbank_jenis` AS `jenis`,`vu_kasbank`.`kasbank_noref` AS `noref`,`vu_kasbank`.`kasbank_keterangan` AS `keterangan`,`vu_kasbank`.`kasbank_debet` AS `debet`,`vu_kasbank`.`kasbank_kredit` AS `kredit`,`vu_kasbank`.`kasbank_post` AS `post`,`vu_kasbank`.`kasbank_date_post` AS `post_date` from `vu_kasbank` union select `vu_kasbank_detail`.`kasbank_tanggal` AS `tanggal`,`vu_kasbank_detail`.`kasbank_nobukti` AS `no_jurnal`,`vu_kasbank_detail`.`dkasbank_akun` AS `akun`,`vu_kasbank_detail`.`akun_kode` AS `akun_kode`,`vu_kasbank_detail`.`akun_nama` AS `akun_nama`,`vu_kasbank_detail`.`kasbank_terimauntuk` AS `terimauntuk`,`vu_kasbank_detail`.`kasbank_jenis` AS `jenis`,`vu_kasbank_detail`.`kasbank_noref` AS `noref`,`vu_kasbank_detail`.`dkasbank_detail` AS `keterangan`,`vu_kasbank_detail`.`dkasbank_debet` AS `debet`,`vu_kasbank_detail`.`dkasbank_kredit` AS `kredit`,`vu_kasbank_detail`.`kasbank_post` AS `post`,`vu_kasbank_detail`.`kasbank_date_post` AS `post_date` from `vu_kasbank_detail` 
;

CREATE 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_jurnal_harian`AS 
select `vu_jurnal`.`jurnal_no` AS `no_jurnal`,`vu_jurnal`.`jurnal_tanggal` AS `tanggal`,`vu_jurnal`.`djurnal_akun` AS `akun`,`vu_jurnal`.`akun_kode` AS `akun_kode`,`vu_jurnal`.`akun_nama` AS `akun_nama`,`vu_jurnal`.`djurnal_detail` AS `keterangan`,`vu_jurnal`.`djurnal_debet` AS `debet`,`vu_jurnal`.`djurnal_kredit` AS `kredit`,`vu_jurnal`.`jurnal_post` AS `post`,`vu_jurnal`.`jurnal_date_post` AS `post_date` from `vu_jurnal` union select `vu_jurnal_bank`.`no_jurnal` AS `no_jurnal`,`vu_jurnal_bank`.`tanggal` AS `tanggal`,`vu_jurnal_bank`.`akun` AS `akun`,`vu_jurnal_bank`.`akun_kode` AS `akun_kode`,`vu_jurnal_bank`.`akun_nama` AS `akun_nama`,`vu_jurnal_bank`.`keterangan` AS `keterangan`,`vu_jurnal_bank`.`debet` AS `debet`,`vu_jurnal_bank`.`kredit` AS `kredit`,`vu_jurnal_bank`.`post` AS `post`,`vu_jurnal_bank`.`post_date` AS `post_date` from `vu_jurnal_bank` 
;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_sum_jual_card` AS 
select date_format(`jual_card`.`jcard_date_create`,_utf8'%Y-%m-%d') AS `jcard_date_create`,`jual_card`.`jcard_transaksi` AS `jcard_transaksi`,`jual_card`.`jcard_stat_dok` AS `jcard_stat_dok`,`jual_card`.`jcard_ref` AS `jcard_ref`,sum(`jual_card`.`jcard_nilai`) AS `jcard_nilai` from `jual_card` group by `jual_card`.`jcard_ref`,date_format(`jual_card`.`jcard_date_create`,_utf8'%Y-%m-%d'),`jual_card`.`jcard_transaksi`,`jual_card`.`jcard_stat_dok` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_sum_jual_cek` AS 
select date_format(`jual_cek`.`jcek_date_create`,_utf8'%Y-%m-%d') AS `jcek_date_create`,`jual_cek`.`jcek_transaksi` AS `jcek_transaksi`,`jual_cek`.`jcek_stat_dok` AS `jcek_stat_dok`,`jual_cek`.`jcek_ref` AS `jcek_ref`,sum(`jual_cek`.`jcek_nilai`) AS `jcek_nilai` from `jual_cek` group by `jual_cek`.`jcek_ref`,date_format(`jual_cek`.`jcek_date_create`,_utf8'%Y-%m-%d'),`jual_cek`.`jcek_transaksi`,`jual_cek`.`jcek_stat_dok` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_sum_jual_kwitansi` AS 
select date_format(`jual_kwitansi`.`jkwitansi_date_create`,_utf8'%Y-%m-%d') AS `jkwitansi_date_create`,`jual_kwitansi`.`jkwitansi_transaksi` AS `jkwitansi_transaksi`,`jual_kwitansi`.`jkwitansi_stat_dok` AS `jkwitansi_stat_dok`,`jual_kwitansi`.`jkwitansi_ref` AS `jkwitansi_ref`,sum(`jual_kwitansi`.`jkwitansi_nilai`) AS `jkwitansi_nilai` from `jual_kwitansi` group by `jual_kwitansi`.`jkwitansi_ref`,date_format(`jual_kwitansi`.`jkwitansi_date_create`,_utf8'%Y-%m-%d'),`jual_kwitansi`.`jkwitansi_transaksi`,`jual_kwitansi`.`jkwitansi_stat_dok` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_sum_jual_transfer` AS 
select date_format(`jual_transfer`.`jtransfer_date_create`,_utf8'%Y-%m-%d') AS `jtransfer_date_create`,`jual_transfer`.`jtransfer_transaksi` AS `jtransfer_transaksi`,`jual_transfer`.`jtransfer_stat_dok` AS `jtransfer_stat_dok`,`jual_transfer`.`jtransfer_ref` AS `jtransfer_ref`,sum(`jual_transfer`.`jtransfer_nilai`) AS `jtransfer_nilai` from `jual_transfer` group by `jual_transfer`.`jtransfer_ref`,date_format(`jual_transfer`.`jtransfer_date_create`,_utf8'%Y-%m-%d'),`jual_transfer`.`jtransfer_transaksi`,`jual_transfer`.`jtransfer_stat_dok` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_sum_jual_tunai` AS 
select date_format(`jual_tunai`.`jtunai_date_create`,_utf8'%Y-%m-%d') AS `jtunai_date_create`,`jual_tunai`.`jtunai_transaksi` AS `jtunai_transaksi`,`jual_tunai`.`jtunai_ref` AS `jtunai_ref`,`jual_tunai`.`jtunai_stat_dok` AS `jtunai_stat_dok`,sum(`jual_tunai`.`jtunai_nilai`) AS `jtunai_nilai` from `jual_tunai` group by `jual_tunai`.`jtunai_ref`,`jual_tunai`.`jtunai_date_create`,`jual_tunai`.`jtunai_transaksi`,`jual_tunai`.`jtunai_stat_dok` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_sum_jual_voucher` AS 
select date_format(`voucher_terima`.`tvoucher_date_create`,_utf8'%Y-%m-%d') AS `tvoucher_date_create`,`voucher_terima`.`tvoucher_transaksi` AS `tvoucher_transaksi`,`voucher_terima`.`tvoucher_stat_dok` AS `tvoucher_stat_dok`,`voucher_terima`.`tvoucher_ref` AS `tvoucher_ref`,sum(`voucher_terima`.`tvoucher_nilai`) AS `tvoucher_nilai` from `voucher_terima` group by `voucher_terima`.`tvoucher_ref`,date_format(`voucher_terima`.`tvoucher_date_create`,_utf8'%Y-%m-%d'),`voucher_terima`.`tvoucher_transaksi`,`voucher_terima`.`tvoucher_stat_dok` ;

ALTER 
ALGORITHM=UNDEFINED 
DEFINER=`root`@`localhost` 
SQL SECURITY DEFINER 
VIEW `vu_trans_terima_jual` AS 
select `vu_sum_jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,date_format(`vu_sum_jual_tunai`.`jtunai_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_sum_jual_tunai`.`jtunai_ref` AS `no_ref`,`vu_sum_jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit`,`vu_sum_jual_tunai`.`jtunai_stat_dok` AS `stat_dok` from `vu_sum_jual_tunai` union select `vu_sum_jual_card`.`jcard_transaksi` AS `jenis_transaksi`,date_format(`vu_sum_jual_card`.`jcard_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_sum_jual_card`.`jcard_ref` AS `no_ref`,0 AS `nilai_tunai`,`vu_sum_jual_card`.`jcard_nilai` AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit`,`vu_sum_jual_card`.`jcard_stat_dok` AS `stat_dok` from `vu_sum_jual_card` union select `vu_sum_jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,date_format(`vu_sum_jual_cek`.`jcek_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_sum_jual_cek`.`jcek_ref` AS `no_ref`,0 AS `nilai_tunai`,0 AS `nilai_card`,`vu_sum_jual_cek`.`jcek_nilai` AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit`,`vu_sum_jual_cek`.`jcek_stat_dok` AS `stat_dok` from `vu_sum_jual_cek` union select `vu_sum_jual_transfer`.`jtransfer_transaksi` AS `jenis_transaksi`,date_format(`vu_sum_jual_transfer`.`jtransfer_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_sum_jual_transfer`.`jtransfer_ref` AS `no_ref`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,`vu_sum_jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit`,`vu_sum_jual_transfer`.`jtransfer_stat_dok` AS `stat_dok` from `vu_sum_jual_transfer` union select `vu_sum_jual_kwitansi`.`jkwitansi_transaksi` AS `jenis_transaksi`,date_format(`vu_sum_jual_kwitansi`.`jkwitansi_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_sum_jual_kwitansi`.`jkwitansi_ref` AS `no_ref`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,`vu_sum_jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit`,`vu_sum_jual_kwitansi`.`jkwitansi_stat_dok` AS `stat_dok` from `vu_sum_jual_kwitansi` union select `voucher_terima`.`tvoucher_transaksi` AS `jenis_transaksi`,date_format(`voucher_terima`.`tvoucher_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`voucher_terima`.`tvoucher_ref` AS `no_ref`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,`voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,0 AS `nilai_kredit`,`voucher_terima`.`tvoucher_stat_dok` AS `stat_dok` from `voucher_terima` ;

DROP VIEW `vu_akun_map`;

DROP VIEW `vu_jurnal_umum`;

