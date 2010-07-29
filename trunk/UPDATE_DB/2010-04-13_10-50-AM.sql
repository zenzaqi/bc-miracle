CREATE OR REPLACE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jpaket_total_pakai` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,sum(((`submaster_apaket_item`.`sapaket_jmlisi_item` - `submaster_apaket_item`.`sapaket_sisa_item`) * `perawatan`.`rawat_harga`)) AS `jpaket_total_pakai` from (((`submaster_apaket_item` left join `master_ambil_paket` on((`submaster_apaket_item`.`sapaket_master` = `master_ambil_paket`.`apaket_id`))) left join `master_jual_paket` on((`master_ambil_paket`.`apaket_jpaket` = `master_jual_paket`.`jpaket_id`))) left join `perawatan` on((`submaster_apaket_item`.`sapaket_item` = `perawatan`.`rawat_id`))) group by `master_jual_paket`.`jpaket_id`;

CREATE OR REPLACE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_jpaket_total_bayar` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,sum(((((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100)) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`)) AS `jpaket_total_bayar` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) group by `master_jual_paket`.`jpaket_id`;