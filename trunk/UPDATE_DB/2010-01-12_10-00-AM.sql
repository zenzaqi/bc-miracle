ALTER TABLE `tindakan_detail` ADD `dtrawat_keterangan` VARCHAR( 250 ) NULL AFTER `dtrawat_tglapp`;

DROP VIEW IF EXISTS `vu_produk`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_produk` AS select * from ((((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`))) left join `detail_jual_produk` on((`produk`.`produk_id` = `detail_jual_produk`.`dproduk_produk`)));