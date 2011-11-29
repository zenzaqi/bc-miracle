CREATE OR REPLACE VIEW `vu_paket` AS select `paket`.`paket_id` AS `paket_id`,`paket`.`paket_kode` AS `paket_kode`,`paket`.`paket_nama` AS `paket_nama`,`paket`.`paket_group` AS `paket_group`,`paket`.`paket_kontribusi` AS `paket_kontribusi`,`paket`.`paket_kodelama` AS `paket_kodelama`,`paket`.`paket_keterangan` AS `paket_keterangan`,`paket`.`paket_du` AS `paket_du`,`paket`.`paket_dm` AS `paket_dm`,`paket`.`paket_dultah` AS `paket_dultah`,`paket`.`paket_dcard` AS `paket_dcard`,`paket`.`paket_dkolega` AS `paket_dkolega`,`paket`.`paket_dkeluarga` AS `paket_dkeluarga`,`paket`.`paket_downer` AS `paket_downer`,`paket`.`paket_dgrooming` AS `paket_dgrooming`,`paket`.`paket_dwartawan` AS `paket_dwartawan`,`paket`.`paket_dstaffdokter` AS `paket_dstaffdokter`,`paket`.`paket_dstaffnondokter` AS `paket_dstaffnondokter`,`paket`.`paket_dpromo` AS `paket_dpromo`,`paket`.`paket_point` AS `paket_point`,`paket`.`paket_harga` AS `paket_harga`,`paket`.`paket_expired` AS `paket_expired`,`paket`.`paket_aktif_cabang` AS `paket_aktif_cabang`,`paket`.`paket_jmlisi` AS `paket_jmlisi`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_dupaket` AS `group_dupaket`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`produk_group`.`group_dmpaket` AS `group_dmpaket`,`produk_group`.`group_kelompok` AS `group_kelompok`,`paket`.`paket_aktif` AS `paket_aktif`,`paket`.`paket_jenis` AS `paket_jenis`,`paket`.`paket_frek` AS `paket_frek`,`paket`.`paket_harga_ki` AS `paket_harga_ki`,`paket`.`paket_harga_mdn` AS `paket_harga_mdn`,`paket`.`paket_harga_mnd` AS `paket_harga_mnd`,`paket`.`paket_harga_ygk` AS `paket_harga_ygk`,`paket`.`paket_harga_mta` AS `paket_harga_mta`,`paket`.`paket_harga_lbk` AS `paket_harga_lbk`,`paket`.`paket_harga_hr` AS `paket_harga_hr`,`paket`.`paket_harga_tp` AS `paket_harga_tp`,`paket`.`paket_harga_dps` AS `paket_harga_dps`,`paket`.`paket_harga_blpn` AS `paket_harga_blpn`,`paket`.`paket_harga_kuta` AS `paket_harga_kuta` from ((`paket` left join `produk_group` on((`paket`.`paket_group` = `produk_group`.`group_id`))) left join `kategori2` on((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`)));