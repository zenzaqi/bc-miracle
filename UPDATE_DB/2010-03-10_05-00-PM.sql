DROP VIEW `vu_total_retur_group`;

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
);

CREATE OR REPLACE VIEW `vu_detail_retur_beli` AS select `master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_beli`.`drbeli_jumlah` AS `drbeli_jumlah`,`detail_retur_beli`.`drbeli_harga` AS `drbeli_harga`,`detail_retur_beli`.`drbeli_diskon` AS `drbeli_diskon`,(((`detail_retur_beli`.`drbeli_diskon` * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) / 100) AS `diskon_nilai`,((((100 - `detail_retur_beli`.`drbeli_diskon`) / 100) * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) AS `subtotal` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_retur_beli`.`drbeli_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_retur_beli`.`drbeli_satuan` = `satuan`.`satuan_id`)));

CREATE OR REPLACE VIEW `vu_total_retur_beli_group` AS select `detail_retur_beli`.`drbeli_master` AS `drbeli_master`,sum(`detail_retur_beli`.`drbeli_jumlah`) AS `jumlah_barang`,sum((`detail_retur_beli`.`drbeli_harga` * `detail_retur_beli`.`drbeli_jumlah`)) AS `total_nilai` from `detail_retur_beli` group by `detail_retur_beli`.`drbeli_master`;
