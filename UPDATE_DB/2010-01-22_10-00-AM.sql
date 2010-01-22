DROP VIEW IF EXISTS `vu_tindakan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_tindakan` AS SELECT `tindakan`.`trawat_id`,`tindakan`.`trawat_cust`,`tindakan`.`trawat_keterangan`,`tindakan`.`trawat_creator`,`tindakan`.`trawat_date_create`,`tindakan`.`trawat_update`,`tindakan`.`trawat_date_update`,`tindakan`.`trawat_revised`,`customer`.`cust_nama`,`customer`.`cust_no`,`tindakan_detail`.`dtrawat_id`,`tindakan_detail`.`dtrawat_perawatan`,`tindakan_detail`.`dtrawat_jam`,`tindakan_detail`.`dtrawat_tglapp`,`tindakan_detail`.`dtrawat_status`,`tindakan_detail`.`dtrawat_keterangan`,`tindakan_detail`.`dtrawat_dapp`,`perawatan`.`rawat_nama`,`perawatan`.`rawat_harga`,`perawatan`.`rawat_du`,`perawatan`.`rawat_dm`,`karyawan`.`karyawan_nama`,`karyawan`.`karyawan_id`,`karyawan`.`karyawan_username`,`kategori`.`kategori_nama` FROM ((`tindakan` INNER JOIN `customer` ON(`tindakan`.`trawat_cust`=`customer`.`cust_id`)) INNER JOIN `tindakan_detail` ON(`tindakan_detail`.`dtrawat_master`=`tindakan`.`trawat_id`)) LEFT JOIN `perawatan` ON(`tindakan_detail`.`dtrawat_perawatan`=`perawatan`.`rawat_id`) LEFT JOIN `karyawan` ON(`tindakan_detail`.`dtrawat_petugas1`=`karyawan`.`karyawan_id`) LEFT JOIN `kategori` ON(`perawatan`.`rawat_kategori`=`kategori`.`kategori_id`);