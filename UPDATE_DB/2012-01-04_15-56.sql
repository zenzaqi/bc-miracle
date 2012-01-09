/*mengurangi dengan jrawat_cashback_medis*/

CREATE OR REPLACE VIEW `vu_jrawat_totalbiaya` AS select `detail_jual_rawat`.`drawat_master` AS `drawat_master`,(((sum(((`detail_jual_rawat`.`drawat_jumlah` * `detail_jual_rawat`.`drawat_harga`) * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100))) * ((100 - `master_jual_rawat`.`jrawat_diskon`) / 100)) - `master_jual_rawat`.`jrawat_cashback`) - `master_jual_rawat`.`jrawat_cashback_medis`) AS `jrawat_totalbiaya` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) group by `detail_jual_rawat`.`drawat_master`;

--
-- VIEW  `vu_jrawat_totalbiaya`
-- Data: None
--

