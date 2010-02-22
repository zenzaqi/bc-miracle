DROP TABLE IF EXISTS `history_ambil_paket`;
CREATE TABLE IF NOT EXISTS `history_ambil_paket` (
  `hapaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `hapaket_dpaket` int(11) NOT NULL,
  `hapaket_rawat` int(11) NOT NULL,
  `hapaket_jumlah` smallint(6) DEFAULT NULL,
  `hapaket_tgl` date DEFAULT NULL,
  `hapaket_cust` int(11) NOT NULL,
  `hapaket_creator` varchar(50) DEFAULT NULL,
  `hapaket_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapaket_dtrawat` int(11) NOT NULL,
  PRIMARY KEY (`hapaket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `submaster_jual_paket`;
DROP TABLE IF EXISTS `pengguna_paket`;
CREATE TABLE IF NOT EXISTS `pengguna_paket` (
  `ppaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ppaket_master` int(11) NOT NULL,
  `ppaket_cust` int(11) NOT NULL,
  PRIMARY KEY (`ppaket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP VIEW IF EXISTS `vu_dpaket_total_sisa_ambil`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_dpaket_total_sisa_ambil` AS select `vu_dpaket_total_terambil`.`dpaket_id` AS `dpaket_id`,`vu_total_isi_dpaket`.`dpaket_paket` AS `dpaket_paket`,`vu_total_isi_dpaket`.`total_isi_dpaket` AS `total_isi_dpaket`,`vu_dpaket_total_terambil`.`dpaket_total_terambil` AS `dpaket_total_terambil`,(`vu_total_isi_dpaket`.`total_isi_dpaket` - `vu_dpaket_total_terambil`.`dpaket_total_terambil`) AS `total_sisa_dpaket` from (`vu_dpaket_total_terambil` join `vu_total_isi_dpaket` on((`vu_dpaket_total_terambil`.`dpaket_id` = `vu_total_isi_dpaket`.`dpaket_id`)));

DROP VIEW IF EXISTS `vu_total_isi_dpaket`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_total_isi_dpaket` AS select `detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,(sum(`paket_isi_perawatan`.`rpaket_jumlah`) * `detail_jual_paket`.`dpaket_jumlah`) AS `total_isi_dpaket` from ((`detail_jual_paket` join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) left join `paket_isi_perawatan` on((`paket_isi_perawatan`.`rpaket_master` = `paket`.`paket_id`))) group by `detail_jual_paket`.`dpaket_id`;

DROP VIEW IF EXISTS `vu_tindakan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_tindakan` AS select `tindakan`.`trawat_id` AS `trawat_id`,`tindakan`.`trawat_cust` AS `trawat_cust`,`tindakan`.`trawat_keterangan` AS `trawat_keterangan`,`tindakan`.`trawat_creator` AS `trawat_creator`,`tindakan`.`trawat_update` AS `trawat_update`,`tindakan`.`trawat_date_update` AS `trawat_date_update`,`tindakan`.`trawat_revised` AS `trawat_revised`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`tindakan_detail`.`dtrawat_id` AS `dtrawat_id`,`tindakan_detail`.`dtrawat_perawatan` AS `dtrawat_perawatan`,`tindakan_detail`.`dtrawat_jam` AS `dtrawat_jam`,`tindakan_detail`.`dtrawat_tglapp` AS `dtrawat_tglapp`,`tindakan_detail`.`dtrawat_status` AS `dtrawat_status`,`tindakan_detail`.`dtrawat_keterangan` AS `dtrawat_keterangan`,`tindakan_detail`.`dtrawat_dapp` AS `dtrawat_dapp`,`tindakan_detail`.`dtrawat_master` AS `dtrawat_master`,`tindakan_detail`.`dtrawat_petugas2` AS `dtrawat_petugas2`,`tindakan_detail`.`dtrawat_ambil_paket` AS `dtrawat_ambil_paket`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`dokter`.`karyawan_nama` AS `dokter_nama`,`dokter`.`karyawan_id` AS `dokter_id`,`dokter`.`karyawan_username` AS `dokter_username`,`terapis`.`karyawan_nama` AS `terapis_nama`,`terapis`.`karyawan_id` AS `terapis_id`,`terapis`.`karyawan_username` AS `terapis_username`,`kategori`.`kategori_nama` AS `kategori_nama`,if(`vu_cust_punya_paket`.`dpaket_id`,'ada','tidak ada') AS `cust_punya_paket`,`vu_cust_punya_paket`.`dpaket_id` AS `dpaket_id`,`vu_cust_punya_paket`.`rpaket_perawatan` AS `rpaket_perawatan`,`vu_cust_punya_paket`.`ppaket_cust` AS `ppaket_cust` from (((((((`tindakan` join `customer` on((`tindakan`.`trawat_cust` = `customer`.`cust_id`))) join `tindakan_detail` on((`tindakan_detail`.`dtrawat_master` = `tindakan`.`trawat_id`))) left join `perawatan` on((`tindakan_detail`.`dtrawat_perawatan` = `perawatan`.`rawat_id`))) left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `vu_cust_punya_paket` on(((`vu_cust_punya_paket`.`ppaket_cust` = `customer`.`cust_id`) and (`vu_cust_punya_paket`.`rpaket_perawatan` = `tindakan_detail`.`dtrawat_perawatan`) and (`vu_cust_punya_paket`.`total_sisa_dpaket` > 0))));

DROP VIEW IF EXISTS `vu_kasir_ambil_paket_list`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_kasir_ambil_paket_list` AS select `detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`master_jual_paket`.`jpaket_id` AS `jpaket_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_nama` AS `cust_nama`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`paket`.`paket_kode` AS `paket_kode`,`paket`.`paket_nama` AS `paket_nama`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`detail_jual_paket`.`dpaket_kadaluarsa` AS `dpaket_kadaluarsa`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,if(sum(`history_ambil_paket`.`hapaket_jumlah`),sum(`history_ambil_paket`.`hapaket_jumlah`),0) AS `dpaket_total_terambil`,`vu_total_isi_dpaket`.`total_isi_dpaket` AS `total_isi_dpaket`,(`vu_total_isi_dpaket`.`total_isi_dpaket` - if(sum(`history_ambil_paket`.`hapaket_jumlah`),sum(`history_ambil_paket`.`hapaket_jumlah`),0)) AS `total_sisa_dpaket` from (((((`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`))) left join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) left join `history_ambil_paket` on((`history_ambil_paket`.`hapaket_dpaket` = `detail_jual_paket`.`dpaket_id`))) left join `vu_total_isi_dpaket` on((`vu_total_isi_dpaket`.`dpaket_id` = `detail_jual_paket`.`dpaket_id`))) group by `detail_jual_paket`.`dpaket_id`;

DROP VIEW IF EXISTS `vu_dpaket_item_total_sisa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_dpaket_item_total_sisa` AS select `paket_isi_perawatan`.`rpaket_perawatan` AS `rpaket_perawatan`,`perawatan`.`rawat_kode` AS `rawat_kode`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_aktif` AS `rawat_aktif`,`detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,`paket`.`paket_nama` AS `paket_nama`,(`paket_isi_perawatan`.`rpaket_jumlah` * `detail_jual_paket`.`dpaket_jumlah`) AS `rpaket_jumlah`,sum(`history_ambil_paket`.`hapaket_jumlah`) AS `sum(hapaket_jumlah)`,((`paket_isi_perawatan`.`rpaket_jumlah` * `detail_jual_paket`.`dpaket_jumlah`) - if(sum(`history_ambil_paket`.`hapaket_jumlah`),sum(`history_ambil_paket`.`hapaket_jumlah`),0)) AS `total_sisa_item` from ((((`detail_jual_paket` join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) join `paket_isi_perawatan` on((`paket_isi_perawatan`.`rpaket_master` = `paket`.`paket_id`))) left join `history_ambil_paket` on(((`history_ambil_paket`.`hapaket_dpaket` = `detail_jual_paket`.`dpaket_id`) and (`history_ambil_paket`.`hapaket_rawat` = `paket_isi_perawatan`.`rpaket_perawatan`)))) left join `perawatan` on((`paket_isi_perawatan`.`rpaket_perawatan` = `perawatan`.`rawat_id`))) group by `detail_jual_paket`.`dpaket_id`,`paket_isi_perawatan`.`rpaket_perawatan`;