CREATE OR REPLACE VIEW `vu_total_kuitansi_group` AS select `jual_kwitansi`.`jkwitansi_master` AS `master`,sum(`jual_kwitansi`.`jkwitansi_nilai`) AS `subtotal` from `jual_kwitansi` where (`jual_kwitansi`.`jkwitansi_stat_dok` <> 'Batal') group by `jual_kwitansi`.`jkwitansi_master`;