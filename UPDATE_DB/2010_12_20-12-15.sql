CREATE OR REPLACE VIEW `vu_jterapis` AS select count(`tindakan_detail`.`dtrawat_petugas2`) AS `terapis_count_day`,`tindakan_detail`.`dtrawat_petugas2` AS `terapis_id`,date_format(`tindakan_detail`.`dtrawat_date_create`,'%Y-%m-%d') AS `terapis_bulan` from ((`tindakan_detail` left join `perawatan` on((`perawatan`.`rawat_id` = `tindakan_detail`.`dtrawat_perawatan`))) left join `produk_group` on((`produk_group`.`group_id` = `perawatan`.`rawat_group`))) where (((`tindakan_detail`.`dtrawat_status` = 'selesai') or (`tindakan_detail`.`dtrawat_status` = 'datang')) and (`tindakan_detail`.`dtrawat_petugas2` <> 0) and (`produk_group`.`group_treatment_utama` = 1) and (`tindakan_detail`.`dtrawat_kategori` = 'Non Medis')) group by date_format(`tindakan_detail`.`dtrawat_date_create`,'%Y-%m-%d'),`tindakan_detail`.`dtrawat_petugas2`;

CREATE OR REPLACE VIEW `vu_report_tindakan_terapis` AS select count(`tindakan_detail`.`dtrawat_petugas2`) AS `terapis_count`,`tindakan_detail`.`dtrawat_petugas2` AS `terapis_id`,date_format(`tindakan_detail`.`dtrawat_date_create`,'%Y-%m') AS `terapis_bulan` from ((`tindakan_detail` left join `perawatan` on((`perawatan`.`rawat_id` = `tindakan_detail`.`dtrawat_perawatan`))) left join `produk_group` on((`produk_group`.`group_id` = `perawatan`.`rawat_group`))) where (((`tindakan_detail`.`dtrawat_status` = 'selesai') or (`tindakan_detail`.`dtrawat_status` = 'datang')) and (`tindakan_detail`.`dtrawat_petugas2` <> 0) and (`produk_group`.`group_treatment_utama` = 1) and (`tindakan_detail`.`dtrawat_kategori` = 'Non Medis')) group by date_format(`tindakan_detail`.`dtrawat_date_create`,'%Y-%m'),`tindakan_detail`.`dtrawat_petugas2`;