CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_ambil_paket` AS select `detail_ambil_paket`.`dapaket_dpaket` AS `dapaket_dpaket`,`detail_ambil_paket`.`dapaket_jpaket` AS `dapaket_jpaket`,`detail_ambil_paket`.`dapaket_paket` AS `dapaket_paket`,sum(`detail_ambil_paket`.`dapaket_jumlah`) AS `total_ambil_paket` from `detail_ambil_paket` where (`detail_ambil_paket`.`dapaket_stat_dok` <> 'Batal') group by `detail_ambil_paket`.`dapaket_dpaket`;