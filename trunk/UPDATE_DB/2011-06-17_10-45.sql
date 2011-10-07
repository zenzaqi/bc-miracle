ALTER TABLE `produk_group` ADD `group_dwartawan` INT( 11 ) NULL DEFAULT NULL AFTER `group_dgrooming` ,
ADD `group_dstaffdokter` INT( 11 ) NULL DEFAULT NULL AFTER `group_dwartawan` ,
ADD `group_dstaffnondokter` INT( 11 ) NULL DEFAULT NULL AFTER `group_dstaffdokter` ;

ALTER TABLE `produk` ADD `produk_dwartawan` INT( 11 ) NULL DEFAULT NULL AFTER `produk_dgrooming` ,
ADD `produk_dstaffdokter` INT( 11 ) NULL DEFAULT NULL AFTER `produk_dwartawan` ,
ADD `produk_dstaffnondokter` INT( 11 ) NULL DEFAULT NULL AFTER `produk_dstaffdokter`;

ALTER TABLE `perawatan` ADD `rawat_dwartawan` INT( 11 ) NULL DEFAULT NULL AFTER `rawat_dgrooming` ,
ADD `rawat_dstaffdokter` INT( 11 ) NULL DEFAULT NULL AFTER `rawat_dwartawan` ,
ADD `rawat_dstaffnondokter` INT( 11 ) NULL DEFAULT NULL AFTER `rawat_dstaffdokter`;

ALTER TABLE `paket` ADD `paket_dwartawan` INT( 11 ) NULL DEFAULT NULL AFTER `paket_dgrooming` ,
ADD `paket_dstaffdokter` INT( 11 ) NULL DEFAULT NULL AFTER `paket_dwartawan` ,
ADD `paket_dstaffnondokter` INT( 11 ) NULL DEFAULT NULL AFTER `paket_dstaffdokter`;


CREATE OR REPLACE VIEW `vu_produk` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_racikan` AS `produk_racikan`,`produk`.`produk_keterangan_resep` AS `produk_keterangan_resep`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_dultah` AS `produk_dultah`,`produk`.`produk_dcard` AS `produk_dcard`,`produk`.`produk_dkolega` AS `produk_dkolega`,`produk`.`produk_dkeluarga` AS `produk_dkeluarga`,`produk`.`produk_downer` AS `produk_downer`,`produk`.`produk_dgrooming` AS `produk_dgrooming`, produk.produk_dwartawan as produk_dwartawan, produk.produk_dstaffdokter as produk_dstaffdokter, produk.produk_dstaffnondokter as produk_dstaffnondokter,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_keterangan` AS `produk_keterangan`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_creator` AS `produk_creator`,`produk`.`produk_date_create` AS `produk_date_create`,`produk`.`produk_update` AS `produk_update`,`produk`.`produk_date_update` AS `produk_date_update`,`produk`.`produk_revised` AS `produk_revised`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_treatment_utama` AS `group_treatment_utama`,`produk_group`.`group_duproduk` AS `group_duproduk`,`produk_group`.`group_dmproduk` AS `group_dmproduk`,`produk_group`.`group_kelompok` AS `group_kelompok`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`jenis`.`jenis_id` AS `jenis_id`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`kategori2`.`kategori2_id` AS `kategori2_id`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`produk`.`produk_saldo_awal` AS `produk_saldo_awal`,`produk`.`produk_nilai_saldo_awal` AS `produk_nilai_saldo_awal`,`produk`.`produk_harga_ki` AS `produk_harga_ki`,`produk`.`produk_harga_mdn` AS `produk_harga_mdn`,`produk`.`produk_harga_mnd` AS `produk_harga_mnd`,`produk`.`produk_harga_ygk` AS `produk_harga_ygk`,`produk`.`produk_harga_mta` AS `produk_harga_mta`,`produk`.`produk_harga_lbk` AS `produk_harga_lbk`,`produk`.`produk_harga_hr` AS `produk_harga_hr`,`produk`.`produk_aktif_cabang` AS `produk_aktif_cabang` from (((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)));

CREATE OR REPLACE VIEW `vu_paket` AS select `paket`.`paket_id` AS `paket_id`,`paket`.`paket_kode` AS `paket_kode`,`paket`.`paket_nama` AS `paket_nama`,`paket`.`paket_group` AS `paket_group`,`paket`.`paket_kontribusi` AS `paket_kontribusi`,`paket`.`paket_kodelama` AS `paket_kodelama`,`paket`.`paket_keterangan` AS `paket_keterangan`,`paket`.`paket_du` AS `paket_du`,`paket`.`paket_dm` AS `paket_dm`,`paket`.`paket_dultah` AS `paket_dultah`,`paket`.`paket_dcard` AS `paket_dcard`,`paket`.`paket_dkolega` AS `paket_dkolega`,`paket`.`paket_dkeluarga` AS `paket_dkeluarga`,`paket`.`paket_downer` AS `paket_downer`,`paket`.`paket_dgrooming` AS `paket_dgrooming`,`paket`.`paket_dwartawan` AS `paket_dwartawan`,`paket`.`paket_dstaffdokter` AS `paket_dstaffdokter`,`paket`.`paket_dstaffnondokter` AS `paket_dstaffnondokter`,`paket`.`paket_point` AS `paket_point`,`paket`.`paket_harga` AS `paket_harga`,`paket`.`paket_expired` AS `paket_expired`,`paket`.`paket_aktif_cabang` AS `paket_aktif_cabang`,`paket`.`paket_jmlisi` AS `paket_jmlisi`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_dupaket` AS `group_dupaket`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`produk_group`.`group_dmpaket` AS `group_dmpaket`,`produk_group`.`group_kelompok` AS `group_kelompok`,`paket`.`paket_aktif` AS `paket_aktif`,`paket`.`paket_jenis` AS `paket_jenis`,`paket`.`paket_frek` AS `paket_frek`,`paket`.`paket_harga_ki` AS `paket_harga_ki`,`paket`.`paket_harga_mdn` AS `paket_harga_mdn`,`paket`.`paket_harga_mnd` AS `paket_harga_mnd`,`paket`.`paket_harga_ygk` AS `paket_harga_ygk`,`paket`.`paket_harga_mta` AS `paket_harga_mta`,`paket`.`paket_harga_lbk` AS `paket_harga_lbk`,`paket`.`paket_harga_hr` AS `paket_harga_hr` from ((`paket` left join `produk_group` on((`paket`.`paket_group` = `produk_group`.`group_id`))) left join `kategori2` on((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`)));

CREATE OR REPLACE VIEW `vu_perawatan` AS select `perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_kode` AS `rawat_kode`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_highmargin` AS `rawat_highmargin`,`perawatan`.`rawat_group` AS `rawat_group`,`perawatan`.`rawat_kontribusi` AS `rawat_kontribusi`,`perawatan`.`rawat_kategori` AS `rawat_kategori`,`perawatan`.`rawat_jenis` AS `rawat_jenis`,`perawatan`.`rawat_kodelama` AS `rawat_kodelama`,`perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`perawatan`.`rawat_dultah` AS `rawat_dultah`,`perawatan`.`rawat_dcard` AS `rawat_dcard`,`perawatan`.`rawat_dkolega` AS `rawat_dkolega`,`perawatan`.`rawat_dkeluarga` AS `rawat_dkeluarga`,`perawatan`.`rawat_downer` AS `rawat_downer`,`perawatan`.`rawat_dgrooming` AS `rawat_dgrooming`,`perawatan`.`rawat_dwartawan` AS `rawat_dwartawan`,`perawatan`.`rawat_dstaffdokter` AS `rawat_dstaffdokter`,`perawatan`.`rawat_dstaffnondokter` AS `rawat_dstaffnondokter`,`perawatan`.`rawat_point` AS `rawat_point`,`perawatan`.`rawat_durasi` AS `rawat_durasi`,`perawatan`.`rawat_kredit` AS `rawat_kredit`,`perawatan`.`rawat_jumlah_tindakan` AS `rawat_jumlah_tindakan`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_gudang` AS `rawat_gudang`,`perawatan`.`rawat_aktif` AS `rawat_aktif`,`perawatan`.`rawat_creator` AS `rawat_creator`,`perawatan`.`rawat_date_create` AS `rawat_date_create`,`perawatan`.`rawat_update` AS `rawat_update`,`perawatan`.`rawat_date_update` AS `rawat_date_update`,`perawatan`.`rawat_revised` AS `rawat_revised`,`perawatan`.`rawat_warna` AS `rawat_warna`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_duproduk` AS `group_duproduk`,`produk_group`.`group_dmproduk` AS `group_dmproduk`,`produk_group`.`group_durawat` AS `group_durawat`,`produk_group`.`group_dmrawat` AS `group_dmrawat`,`produk_group`.`group_dupaket` AS `group_dupaket`,`produk_group`.`group_dmpaket` AS `group_dmpaket`,`produk_group`.`group_kelompok` AS `group_kelompok`,`produk_group`.`group_keterangan` AS `group_keterangan`,`produk_group`.`group_aktif` AS `group_aktif`,`produk_group`.`group_creator` AS `group_creator`,`produk_group`.`group_date_create` AS `group_date_create`,`produk_group`.`group_update` AS `group_update`,`produk_group`.`group_date_update` AS `group_date_update`,`produk_group`.`group_revised` AS `group_revised`,`kategori2`.`kategori2_id` AS `kategori2_id`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`kategori2`.`kategori2_keterangan` AS `kategori2_keterangan`,`kategori2`.`kategori2_aktif` AS `kategori2_aktif`,`kategori2`.`kategori2_creator` AS `kategori2_creator`,`kategori2`.`kategori2_date_create` AS `kategori2_date_create`,`kategori2`.`kategori2_update` AS `kategori2_update`,`kategori2`.`kategori2_date_update` AS `kategori2_date_update`,`kategori2`.`kategori2_revised` AS `kategori2_revised`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`kategori`.`kategori_keterangan` AS `kategori_keterangan`,`kategori`.`kategori_aktif` AS `kategori_aktif`,`kategori`.`kategori_creator` AS `kategori_creator`,`kategori`.`kategori_date_create` AS `kategori_date_create`,`kategori`.`kategori_update` AS `kategori_update`,`kategori`.`kategori_date_update` AS `kategori_date_update`,`kategori`.`kategori_revised` AS `kategori_revised`,`jenis`.`jenis_id` AS `jenis_id`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`jenis`.`jenis_keterangan` AS `jenis_keterangan`,`jenis`.`jenis_aktif` AS `jenis_aktif`,`jenis`.`jenis_creator` AS `jenis_creator`,`jenis`.`jenis_date_create` AS `jenis_date_create`,`jenis`.`jenis_update` AS `jenis_update`,`jenis`.`jenis_date_update` AS `jenis_date_update`,`jenis`.`jenis_revised` AS `jenis_revised`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi`,`gudang`.`gudang_keterangan` AS `gudang_keterangan`,`gudang`.`gudang_aktif` AS `gudang_aktif`,`gudang`.`gudang_creator` AS `gudang_creator`,`gudang`.`gudang_date_create` AS `gudang_date_create`,`gudang`.`gudang_update` AS `gudang_update`,`gudang`.`gudang_date_update` AS `gudang_date_update`,`gudang`.`gudang_revised` AS `gudang_revised`,`perawatan`.`rawat_harga_ki` AS `rawat_harga_ki`,`perawatan`.`rawat_harga_mdn` AS `rawat_harga_mdn`,`perawatan`.`rawat_harga_mnd` AS `rawat_harga_mnd`,`perawatan`.`rawat_harga_ygk` AS `rawat_harga_ygk`,`perawatan`.`rawat_harga_mta` AS `rawat_harga_mta`,`perawatan`.`rawat_harga_lbk` AS `rawat_harga_lbk`,`perawatan`.`rawat_harga_hr` AS `rawat_harga_hr`,`perawatan`.`rawat_aktif_cabang` AS `rawat_aktif_cabang` from (((((`perawatan` left join `produk_group` on((`perawatan`.`rawat_group` = `produk_group`.`group_id`))) left join `kategori2` on((`perawatan`.`rawat_kontribusi` = `kategori2`.`kategori2_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `jenis` on((`perawatan`.`rawat_jenis` = `jenis`.`jenis_id`))) left join `gudang` on((`perawatan`.`rawat_gudang` = `gudang`.`gudang_id`)));