
CREATE OR REPLACE VIEW `vu_detail_ambil_paket_rawat_simple` AS select (ifnull(((((((`dj`.`dpaket_harga` * (100 - `dj`.`dpaket_diskon`)) / 100) * `dj`.`dpaket_jumlah`) - (((`m`.`jpaket_diskon` * ((`dj`.`dpaket_harga` * (100 - `dj`.`dpaket_diskon`)) / 100)) * `dj`.`dpaket_jumlah`) / 100)) / `dj`.`dpaket_jumlah`) / `v1`.`isi_paket`),0) * `da`.`dapaket_jumlah`) AS `total_harga_satuan`,`m`.`jpaket_stat_dok` AS `jpaket_stat_dok`,`da`.`dapaket_tgl_ambil` AS `tanggal`,`vr`.`kategori_nama` AS `kategori_nama`,`da`.`dapaket_stat_dok` AS `dapaket_stat_dok` from ((((`detail_ambil_paket` `da` left join `master_jual_paket` `m` on((`m`.`jpaket_id` = `da`.`dapaket_jpaket`))) left join `vu_jumlah_isi_paket` `v1` on((`da`.`dapaket_paket` = `v1`.`paket_id`))) left join `detail_jual_paket` `dj` on((`da`.`dapaket_dpaket` = `dj`.`dpaket_id`))) left join `vu_perawatan` `vr` on((`vr`.`rawat_id` = `da`.`dapaket_item`)));
