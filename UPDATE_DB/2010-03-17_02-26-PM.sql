--
-- Table structure for table `detail_retur_beli`
--

DROP TABLE IF EXISTS `detail_retur_beli`;
CREATE TABLE IF NOT EXISTS `detail_retur_beli` (
  `drbeli_id` int(11) NOT NULL auto_increment,
  `drbeli_master` int(11) NOT NULL,
  `drbeli_produk` int(11) NOT NULL,
  `drbeli_satuan` int(11) default NULL,
  `drbeli_jumlah` int(11) default NULL,
  `drbeli_harga` double default NULL,
  `drbeli_diskon` tinyint(4) default NULL,
  PRIMARY KEY  (`drbeli_id`),
  KEY `fk_ref_retur_beli_produk` (`drbeli_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


--
-- Table structure for table `master_retur_beli`
--

DROP TABLE IF EXISTS `master_retur_beli`;
CREATE TABLE IF NOT EXISTS `master_retur_beli` (
  `rbeli_id` int(11) NOT NULL auto_increment,
  `rbeli_nobukti` varchar(100) default NULL,
  `rbeli_invoice` int(11) default NULL,
  `rbeli_terima` int(11) default NULL,
  `rbeli_supplier` int(11) default NULL,
  `rbeli_tanggal` date default NULL,
  `rbeli_keterangan` varchar(500) default NULL,
  `rbeli_creator` varchar(50) default NULL,
  `rbeli_date_create` datetime default NULL,
  `rbeli_update` varchar(50) default NULL,
  `rbeli_date_update` datetime default NULL,
  `rbeli_revised` int(11) default NULL,
  PRIMARY KEY  (`rbeli_id`),
  KEY `fk_ref_retur_beli_terima` (`rbeli_terima`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Structure for view `vu_detail_invoice`
--

CREATE OR REPLACE VIEW `vu_detail_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`satuan`.`satuan_id` AS `satuan_id`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`jenis_nama` AS `jenis_nama`,((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) AS `subtotal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_email` AS `supplier_email` from (((((`detail_invoice` join `master_invoice` on((`detail_invoice`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_produk` on((`detail_invoice`.`dinvoice_produk` = `vu_produk`.`produk_id`))) join `master_terima_beli` on((`master_invoice`.`invoice_noterima` = `master_terima_beli`.`terima_id`))) join `satuan` on((`detail_invoice`.`dinvoice_satuan` = `satuan`.`satuan_id`))) join `supplier` on((`supplier`.`supplier_id` = `master_terima_beli`.`terima_supplier`)));

--
-- Structure for view `vu_trans_invoice`
--

CREATE OR REPLACE VIEW `vu_trans_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `no_bukti`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_invoice`.`invoice_tanggal` AS `tanggal`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`vu_total_invoice_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_invoice_group`.`total_nilai` AS `total_nilai`,`vu_total_invoice_group`.`dinvoice_master` AS `dinvoice_master`,`vu_trans_terima`.`no_bukti` AS `terima_no`,`vu_trans_terima`.`order_no` AS `order_no`,`vu_trans_terima`.`order_tanggal` AS `order_tanggal`,`vu_trans_terima`.`order_carabayar` AS `order_carabayar`,`vu_trans_terima`.`order_diskon` AS `order_diskon`,`vu_trans_terima`.`order_biaya` AS `order_biaya`,`vu_trans_terima`.`order_bayar` AS `order_bayar`,`vu_trans_terima`.`supplier_nama` AS `supplier_nama`,`vu_trans_terima`.`supplier_alamat` AS `supplier_alamat`,`vu_trans_terima`.`supplier_kota` AS `supplier_kota`,`vu_trans_terima`.`terima_pengirim` AS `terima_pengirim`,`vu_trans_terima`.`tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`vu_trans_terima`.`terima_order` AS `terima_order` from ((`master_invoice` join `vu_total_invoice_group` on((`vu_total_invoice_group`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_trans_terima` on((`master_invoice`.`invoice_noterima` = `vu_trans_terima`.`terima_id`)));

--
-- Structure for view `vu_detail_retur_beli`
--

CREATE OR REPLACE VIEW `vu_detail_retur_beli` AS select `master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_beli`.`drbeli_jumlah` AS `drbeli_jumlah`,`detail_retur_beli`.`drbeli_harga` AS `drbeli_harga`,`detail_retur_beli`.`drbeli_diskon` AS `drbeli_diskon`,(((`detail_retur_beli`.`drbeli_diskon` * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) / 100) AS `diskon_nilai`,((((100 - `detail_retur_beli`.`drbeli_diskon`) / 100) * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) AS `subtotal` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_retur_beli`.`drbeli_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_retur_beli`.`drbeli_satuan` = `satuan`.`satuan_id`)));

CREATE OR REPLACE VIEW `vu_trans_retur_beli` AS select `master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `no_bukti`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `tanggal`,`master_retur_beli`.`rbeli_keterangan` AS `rbeli_keterangan`,`vu_total_retur_beli_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_retur_beli_group`.`total_nilai` AS `total_nilai`,`vu_trans_terima`.`terima_id` AS `terima_id`,`vu_trans_terima`.`no_bukti` AS `no_terima`,`vu_trans_terima`.`order_no` AS `no_order`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima` from (((`master_retur_beli` join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_total_retur_beli_group` on((`vu_total_retur_beli_group`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `vu_trans_terima` on((`master_retur_beli`.`rbeli_terima` = `vu_trans_terima`.`terima_id`)));

