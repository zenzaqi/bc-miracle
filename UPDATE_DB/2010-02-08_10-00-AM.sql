DROP VIEW IF EXISTS `vu_appointment`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_appointment` AS select `appointment`.`app_id` AS `app_id`,`appointment`.`app_tanggal` AS `app_tanggal`,`appointment`.`app_cara` AS `app_cara`,`appointment`.`app_keterangan` AS `app_keterangan`,`appointment`.`app_creator` AS `app_creator`,`appointment`.`app_date_create` AS `app_date_create`,`appointment`.`app_update` AS `app_update`,`appointment`.`app_date_update` AS `app_date_update`,`appointment`.`app_revised` AS `app_revised`,`appointment_detail`.`dapp_id` AS `dapp_id`,`appointment_detail`.`dapp_status` AS `dapp_status`,`appointment_detail`.`dapp_tglreservasi` AS `dapp_tglreservasi`,`appointment_detail`.`dapp_jamdatang` AS `dapp_jamdatang`,`appointment_detail`.`dapp_jamreservasi` AS `dapp_jamreservasi`,`appointment_detail`.`dapp_keterangan` AS `dapp_keterangan`,`perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_warna` AS `rawat_warna`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`kategori`.`kategori_nama` AS `kategori_nama`,`karyawan_dokter`.`karyawan_nama` AS `dokter_nama`,`karyawan_dokter`.`karyawan_id` AS `dokter_id`,`karyawan_dokter`.`karyawan_username` AS `dokter_username`,`karyawan_dokter`.`karyawan_no` AS `dokter_no`,`karyawan_terapis`.`karyawan_nama` AS `terapis_nama`,`karyawan_terapis`.`karyawan_id` AS `terapis_id`,`karyawan_terapis`.`karyawan_username` AS `terapis_username`,`karyawan_terapis`.`karyawan_no` AS `terapis_no` from ((((((`appointment` join `appointment_detail` on((`appointment`.`app_id` = `appointment_detail`.`dapp_master`))) join `perawatan` on((`appointment_detail`.`dapp_perawatan` = `perawatan`.`rawat_id`))) join `customer` on((`appointment`.`app_customer` = `customer`.`cust_id`))) join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `karyawan` `karyawan_dokter` on((`appointment_detail`.`dapp_petugas` = `karyawan_dokter`.`karyawan_id`))) left join `karyawan` `karyawan_terapis` on((`appointment_detail`.`dapp_petugas2` = `karyawan_terapis`.`karyawan_id`)));