DROP VIEW IF EXISTS `vu_total_isi_paket`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `vu_total_isi_paket` AS select sum(`paket_isi_perawatan`.`rpaket_jumlah`) as `total_isi_paket`, `paket_isi_perawatan`.`rpaket_master` from (`paket_isi_perawatan` INNER JOIN `paket` ON(`paket_isi_perawatan`.`rpaket_master`=`paket`.`paket_id`)) GROUP BY `paket_isi_perawatan`.`rpaket_master`;

ALTER TABLE `submaster_apaket_item` ADD `sapaket_jenis_item` ENUM( 'perawatan', 'produk' ) NOT NULL DEFAULT 'perawatan' AFTER `sapaket_item`;

ALTER TABLE `master_ambil_paket` ADD `apaket_dpaket` INT NOT NULL AFTER `apaket_id`;