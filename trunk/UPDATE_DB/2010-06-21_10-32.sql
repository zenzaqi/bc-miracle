CREATE OR REPLACE VIEW `vu_total_sisa_paket` AS select `detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`detail_jual_paket`.`dpaket_master` AS `dpaket_master`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,((`detail_jual_paket`.`dpaket_jumlah` * `paket`.`paket_jmlisi`) - if((sum(`detail_ambil_paket`.`dapaket_jumlah`) <> 'null'),sum(`detail_ambil_paket`.`dapaket_jumlah`),0)) AS `total_sisa_paket` from ((`detail_jual_paket` left join `detail_ambil_paket` on(((`detail_ambil_paket`.`dapaket_dpaket` = `detail_jual_paket`.`dpaket_id`) and (`detail_ambil_paket`.`dapaket_stat_dok` <> 'Batal')))) left join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) group by `detail_ambil_paket`.`dapaket_dpaket`,`detail_ambil_paket`.`dapaket_jpaket`;

ALTER TABLE `master_jual_produk` ADD `jproduk_point` TINYINT NOT NULL DEFAULT '0' AFTER `jproduk_keterangan` ;

ALTER TABLE `master_jual_paket` ADD `jpaket_point` TINYINT NOT NULL DEFAULT '0' AFTER `jpaket_keterangan` ;

ALTER TABLE `master_jual_rawat` ADD `jrawat_point` TINYINT NOT NULL DEFAULT '0' AFTER `jrawat_keterangan` ;