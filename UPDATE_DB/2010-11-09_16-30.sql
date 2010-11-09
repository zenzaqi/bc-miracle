-- tambahan field High Margin di Master Perawatan

ALTER TABLE `perawatan` ADD `rawat_highmargin` TINYINT NULL DEFAULT '0' AFTER `rawat_nama`;




CREATE OR REPLACE VIEW `vu_perawatan` AS select `perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_kode` AS `rawat_kode`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_highmargin` AS `rawat_highmargin`,`perawatan`.`rawat_group` AS `rawat_group`,`perawatan`.`rawat_kontribusi` AS `rawat_kontribusi`,`perawatan`.`rawat_kategori` AS `rawat_kategori`,`perawatan`.`rawat_jenis` AS `rawat_jenis`,`perawatan`.`rawat_kodelama` AS `rawat_kodelama`,`perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`perawatan`.`rawat_point` AS `rawat_point`,`perawatan`.`rawat_kredit` AS `rawat_kredit`,`perawatan`.`rawat_jumlah_tindakan` AS `rawat_jumlah_tindakan`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_gudang` AS `rawat_gudang`,`perawatan`.`rawat_aktif` AS `rawat_aktif`,`perawatan`.`rawat_creator` AS `rawat_creator`,`perawatan`.`rawat_date_create` AS `rawat_date_create`,`perawatan`.`rawat_update` AS `rawat_update`,`perawatan`.`rawat_date_update` AS `rawat_date_update`,`perawatan`.`rawat_revised` AS `rawat_revised`,`perawatan`.`rawat_warna` AS `rawat_warna`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_duproduk` AS `group_duproduk`,`produk_group`.`group_dmproduk` AS `group_dmproduk`,`produk_group`.`group_durawat` AS `group_durawat`,`produk_group`.`group_dmrawat` AS `group_dmrawat`,`produk_group`.`group_dupaket` AS `group_dupaket`,`produk_group`.`group_dmpaket` AS `group_dmpaket`,`produk_group`.`group_kelompok` AS `group_kelompok`,`produk_group`.`group_keterangan` AS `group_keterangan`,`produk_group`.`group_aktif` AS `group_aktif`,`produk_group`.`group_creator` AS `group_creator`,`produk_group`.`group_date_create` AS `group_date_create`,`produk_group`.`group_update` AS `group_update`,`produk_group`.`group_date_update` AS `group_date_update`,`produk_group`.`group_revised` AS `group_revised`,`kategori2`.`kategori2_id` AS `kategori2_id`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`kategori2`.`kategori2_keterangan` AS `kategori2_keterangan`,`kategori2`.`kategori2_aktif` AS `kategori2_aktif`,`kategori2`.`kategori2_creator` AS `kategori2_creator`,`kategori2`.`kategori2_date_create` AS `kategori2_date_create`,`kategori2`.`kategori2_update` AS `kategori2_update`,`kategori2`.`kategori2_date_update` AS `kategori2_date_update`,`kategori2`.`kategori2_revised` AS `kategori2_revised`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`kategori`.`kategori_keterangan` AS `kategori_keterangan`,`kategori`.`kategori_aktif` AS `kategori_aktif`,`kategori`.`kategori_creator` AS `kategori_creator`,`kategori`.`kategori_date_create` AS `kategori_date_create`,`kategori`.`kategori_update` AS `kategori_update`,`kategori`.`kategori_date_update` AS `kategori_date_update`,`kategori`.`kategori_revised` AS `kategori_revised`,`jenis`.`jenis_id` AS `jenis_id`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`jenis`.`jenis_keterangan` AS `jenis_keterangan`,`jenis`.`jenis_aktif` AS `jenis_aktif`,`jenis`.`jenis_creator` AS `jenis_creator`,`jenis`.`jenis_date_create` AS `jenis_date_create`,`jenis`.`jenis_update` AS `jenis_update`,`jenis`.`jenis_date_update` AS `jenis_date_update`,`jenis`.`jenis_revised` AS `jenis_revised`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi`,`gudang`.`gudang_keterangan` AS `gudang_keterangan`,`gudang`.`gudang_aktif` AS `gudang_aktif`,`gudang`.`gudang_creator` AS `gudang_creator`,`gudang`.`gudang_date_create` AS `gudang_date_create`,`gudang`.`gudang_update` AS `gudang_update`,`gudang`.`gudang_date_update` AS `gudang_date_update`,`gudang`.`gudang_revised` AS `gudang_revised` from (((((`perawatan` left join `produk_group` on((`perawatan`.`rawat_group` = `produk_group`.`group_id`))) left join `kategori2` on((`perawatan`.`rawat_kontribusi` = `kategori2`.`kategori2_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `jenis` on((`perawatan`.`rawat_jenis` = `jenis`.`jenis_id`))) left join `gudang` on((`perawatan`.`rawat_gudang` = `gudang`.`gudang_id`)));
