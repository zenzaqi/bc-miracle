CREATE OR REPLACE VIEW `vu_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_diskon` AS `jpaket_diskon`,`master_jual_paket`.`jpaket_cashback` AS `jpaket_cashback`,`master_jual_paket`.`jpaket_cara` AS `jpaket_cara`,`master_jual_paket`.`jpaket_cara2` AS `jpaket_cara2`,`master_jual_paket`.`jpaket_cara3` AS `jpaket_cara3`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,if((`master_jual_paket`.`jpaket_totalbiaya` <> 0),`master_jual_paket`.`jpaket_totalbiaya`,((sum((`detail_jual_paket`.`dpaket_harga` * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100))) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`)) AS `jpaket_totalbiaya`,`master_jual_paket`.`jpaket_keterangan` AS `jpaket_keterangan`,`master_jual_paket`.`jpaket_stat_dok` AS `jpaket_stat_dok`,`master_jual_paket`.`jpaket_creator` AS `jpaket_creator`,`master_jual_paket`.`jpaket_date_create` AS `jpaket_date_create`,`master_jual_paket`.`jpaket_update` AS `jpaket_update`,`master_jual_paket`.`jpaket_date_update` AS `jpaket_date_update`,`master_jual_paket`.`jpaket_revised` AS `jpaket_revised` from ((`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`))) group by `detail_jual_paket`.`dpaket_master`;

CREATE OR REPLACE VIEW `vu_tindakan` AS select `tindakan`.`trawat_id` AS `trawat_id`,`tindakan`.`trawat_cust` AS `trawat_cust`,`tindakan`.`trawat_keterangan` AS `trawat_keterangan`,`tindakan`.`trawat_creator` AS `trawat_creator`,`tindakan`.`trawat_update` AS `trawat_update`,`tindakan`.`trawat_date_update` AS `trawat_date_update`,`tindakan`.`trawat_revised` AS `trawat_revised`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`tindakan_detail`.`dtrawat_id` AS `dtrawat_id`,`tindakan_detail`.`dtrawat_perawatan` AS `dtrawat_perawatan`,`tindakan_detail`.`dtrawat_jam` AS `dtrawat_jam`,`tindakan_detail`.`dtrawat_tglapp` AS `dtrawat_tglapp`,`tindakan_detail`.`dtrawat_status` AS `dtrawat_status`,`tindakan_detail`.`dtrawat_keterangan` AS `dtrawat_keterangan`,`tindakan_detail`.`dtrawat_dapp` AS `dtrawat_dapp`,`tindakan_detail`.`dtrawat_master` AS `dtrawat_master`,`tindakan_detail`.`dtrawat_petugas2` AS `dtrawat_petugas2`,`tindakan_detail`.`dtrawat_ambil_paket` AS `dtrawat_ambil_paket`,if((`tindakan_detail`.`dtrawat_locked` = 0),'Terbuka','Tertutup') AS `dtrawat_edit`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`dokter`.`karyawan_nama` AS `dokter_nama`,`dokter`.`karyawan_id` AS `dokter_id`,`dokter`.`karyawan_username` AS `dokter_username`,`terapis`.`karyawan_nama` AS `terapis_nama`,`terapis`.`karyawan_id` AS `terapis_id`,`terapis`.`karyawan_username` AS `terapis_username`,`kategori`.`kategori_nama` AS `kategori_nama`,`tindakan_detail`.`dtrawat_jumlah` AS `jumlah` from ((((((`tindakan` join `customer` on((`tindakan`.`trawat_cust` = `customer`.`cust_id`))) join `tindakan_detail` on((`tindakan_detail`.`dtrawat_master` = `tindakan`.`trawat_id`))) left join `perawatan` on((`tindakan_detail`.`dtrawat_perawatan` = `perawatan`.`rawat_id`))) left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`)));

ALTER TABLE `tindakan_detail` ADD `dtrawat_jumlah` TINYINT( 2 ) NOT NULL DEFAULT '1' AFTER `dtrawat_keterangan` ;