DROP TABLE IF EXISTS `master_ambil_paket`;
CREATE TABLE IF NOT EXISTS `master_ambil_paket` (
  `apaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `apaket_jpaket` int(11) NOT NULL,
  `apaket_dpaket` int(11) NOT NULL,
  `apaket_faktur` varchar(250) DEFAULT NULL,
  `apaket_faktur_tanggal` date DEFAULT NULL,
  `apaket_kadaluarsa` date NOT NULL,
  `apaket_cust` int(11) NOT NULL,
  `apaket_cust_no` varchar(50) DEFAULT NULL,
  `apaket_cust_nama` varchar(50) DEFAULT NULL,
  `apaket_paket` int(11) NOT NULL,
  `apaket_paket_kode` varchar(20) DEFAULT NULL,
  `apaket_paket_nama` varchar(250) NOT NULL,
  `apaket_paket_jumlah` int(2) DEFAULT NULL,
  `apaket_sisa_paket` int(11) NOT NULL DEFAULT '0',
  `apaket_tanggal` date DEFAULT NULL,
  `apaket_keterangan` varchar(250) DEFAULT NULL,
  `apaket_creator` varchar(50) DEFAULT NULL,
  `apaket_date_create` datetime DEFAULT NULL,
  `apaket_update` varchar(50) DEFAULT NULL,
  `apaket_date_update` datetime DEFAULT NULL,
  `apaket_revised` int(11) DEFAULT NULL,
  `kode_cust` varchar(50) NOT NULL,
  `kode_paket` varchar(50) NOT NULL,
  PRIMARY KEY (`apaket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `detail_ambil_paket`;
CREATE TABLE IF NOT EXISTS `detail_ambil_paket` (
  `dapaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `dapaket_master` int(11) NOT NULL,
  `dapaket_sapaket` int(11) NOT NULL,
  `dapaket_dpaket` int(11) NOT NULL,
  `dapaket_nama` int(11) NOT NULL,
  `dapaket_item` varchar(30) NOT NULL,
  `dapaket_jenis` enum('produk','perawatan') DEFAULT NULL,
  `dapaket_jumlah` int(11) DEFAULT NULL,
  `dapaket_harga` float DEFAULT NULL,
  `dapaket_cust` int(11) NOT NULL,
  `dapaket_dtrawat` int(11) NOT NULL,
  `dapaket_creator` varchar(50) DEFAULT NULL,
  `dapaket_date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`dapaket_id`),
  KEY `fk_ref_ambil_paket` (`dapaket_nama`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `submaster_apaket_item`;
CREATE TABLE IF NOT EXISTS `submaster_apaket_item` (
  `sapaket_id` int(11) NOT NULL AUTO_INCREMENT,
  `sapaket_master` int(11) NOT NULL,
  `sapaket_item` int(11) NOT NULL,
  `sapaket_item_nama` varchar(250) DEFAULT NULL,
  `sapaket_jenis_item` enum('perawatan','produk') NOT NULL DEFAULT 'perawatan',
  `sapaket_jmlisi_item` int(11) NOT NULL,
  `sapaket_sisa_item` int(11) NOT NULL,
  UNIQUE KEY `sapaket_id` (`sapaket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_cust_punya_paket` AS select `master_ambil_paket`.`apaket_id` AS `apaket_id`,`pengguna_paket`.`ppaket_cust` AS `ppaket_cust`,`submaster_apaket_item`.`sapaket_id` AS `sapaket_id`,`submaster_apaket_item`.`sapaket_item` AS `sapaket_item`,`submaster_apaket_item`.`sapaket_jenis_item` AS `sapaket_jenis_item`,`master_ambil_paket`.`apaket_sisa_paket` AS `apaket_sisa_paket`,`submaster_apaket_item`.`sapaket_sisa_item` AS `sapaket_sisa_item` from (`submaster_apaket_item` left join (`pengguna_paket` left join `master_ambil_paket` on((`pengguna_paket`.`ppaket_master` = `master_ambil_paket`.`apaket_jpaket`))) on((`submaster_apaket_item`.`sapaket_master` = `master_ambil_paket`.`apaket_id`)));

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_tindakan` AS select `tindakan`.`trawat_id` AS `trawat_id`,`tindakan`.`trawat_cust` AS `trawat_cust`,`tindakan`.`trawat_keterangan` AS `trawat_keterangan`,`tindakan`.`trawat_creator` AS `trawat_creator`,`tindakan`.`trawat_update` AS `trawat_update`,`tindakan`.`trawat_date_update` AS `trawat_date_update`,`tindakan`.`trawat_revised` AS `trawat_revised`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`tindakan_detail`.`dtrawat_id` AS `dtrawat_id`,`tindakan_detail`.`dtrawat_perawatan` AS `dtrawat_perawatan`,`tindakan_detail`.`dtrawat_jam` AS `dtrawat_jam`,`tindakan_detail`.`dtrawat_tglapp` AS `dtrawat_tglapp`,`tindakan_detail`.`dtrawat_status` AS `dtrawat_status`,`tindakan_detail`.`dtrawat_keterangan` AS `dtrawat_keterangan`,`tindakan_detail`.`dtrawat_dapp` AS `dtrawat_dapp`,`tindakan_detail`.`dtrawat_master` AS `dtrawat_master`,`tindakan_detail`.`dtrawat_petugas2` AS `dtrawat_petugas2`,`tindakan_detail`.`dtrawat_ambil_paket` AS `dtrawat_ambil_paket`,if((`tindakan_detail`.`dtrawat_locked` = 0),'Terbuka','Tertutup') AS `dtrawat_edit`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`dokter`.`karyawan_nama` AS `dokter_nama`,`dokter`.`karyawan_id` AS `dokter_id`,`dokter`.`karyawan_username` AS `dokter_username`,`terapis`.`karyawan_nama` AS `terapis_nama`,`terapis`.`karyawan_id` AS `terapis_id`,`terapis`.`karyawan_username` AS `terapis_username`,`kategori`.`kategori_nama` AS `kategori_nama`,if((`vu_cust_punya_paket`.`sapaket_id` and (`vu_cust_punya_paket`.`sapaket_sisa_item` <> 0)),'ada','tidak ada') AS `cust_punya_paket`,`vu_cust_punya_paket`.`apaket_id` AS `apaket_id`,`vu_cust_punya_paket`.`sapaket_id` AS `sapaket_id`,`vu_cust_punya_paket`.`sapaket_item` AS `sapaket_item`,`vu_cust_punya_paket`.`ppaket_cust` AS `ppaket_cust` from (((((((`tindakan` join `customer` on((`tindakan`.`trawat_cust` = `customer`.`cust_id`))) join `tindakan_detail` on((`tindakan_detail`.`dtrawat_master` = `tindakan`.`trawat_id`))) left join `perawatan` on((`tindakan_detail`.`dtrawat_perawatan` = `perawatan`.`rawat_id`))) left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `vu_cust_punya_paket` on(((`vu_cust_punya_paket`.`ppaket_cust` = `customer`.`cust_id`) and (`vu_cust_punya_paket`.`sapaket_item` = `tindakan_detail`.`dtrawat_perawatan`) and (`vu_cust_punya_paket`.`sapaket_jenis_item` = 'perawatan') and (`vu_cust_punya_paket`.`apaket_sisa_paket` > 0))));

DROP VIEW IF EXISTS `vu_dpaket_item_total_sisa` ,
`vu_dpaket_total_sisa_ambil` ,
`vu_dpaket_total_terambil` ,
`vu_kasir_ambil_paket_list` ,
`vu_total_isi_dpaket` ,
`vu_total_sisa_paket` ;
