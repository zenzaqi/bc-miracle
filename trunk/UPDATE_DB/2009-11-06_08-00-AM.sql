ALTER TABLE `customer` ADD `cust_tmptlahir` VARCHAR( 100 ) NULL AFTER `cust_profesi`;

DROP VIEW IF EXISTS `vu_customer`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `vu_customer` AS select `customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`customer`.`cust_kodepos` AS `cust_kodepos`,`customer`.`cust_propinsi` AS `cust_propinsi`,`customer`.`cust_negara` AS `cust_negara`,`customer`.`cust_alamat2` AS `cust_alamat2`,`customer`.`cust_kota2` AS `cust_kota2`,`customer`.`cust_kodepos2` AS `cust_kodepos2`,`customer`.`cust_propinsi2` AS `cust_propinsi2`,`customer`.`cust_negara2` AS `cust_negara2`,`customer`.`cust_telprumah` AS `cust_telprumah`,`customer`.`cust_telprumah2` AS `cust_telprumah2`,`customer`.`cust_telpkantor` AS `cust_telpkantor`,`customer`.`cust_hp` AS `cust_hp`,`customer`.`cust_hp2` AS `cust_hp2`,`customer`.`cust_hp3` AS `cust_hp3`,`customer`.`cust_email` AS `cust_email`,`customer`.`cust_fb` AS `cust_fb`,`customer`.`cust_tweeter` AS `cust_tweeter`,`customer`.`cust_email2` AS `cust_email2`,`customer`.`cust_fb2` AS `cust_fb2`,`customer`.`cust_tweeter2` AS `cust_tweeter2`,`customer`.`cust_agama` AS `cust_agama`,`customer`.`cust_pendidikan` AS `cust_pendidikan`,`customer`.`cust_profesi` AS `cust_profesi`,`customer`.`cust_tmptlahir` AS `cust_tmptlahir`,`customer`.`cust_tgllahir` AS `cust_tgllahir`,`customer`.`cust_hobi` AS `cust_hobi`,`customer`.`cust_referensi` AS `cust_referensi`,`customer`.`cust_referensilain` AS `cust_referensilain`,`customer`.`cust_keterangan` AS `cust_keterangan`,`customer`.`cust_terdaftar` AS `cust_terdaftar`,`customer`.`cust_statusnikah` AS `cust_statusnikah`,`customer`.`cust_jmlanak` AS `cust_jmlanak`,`customer`.`cust_unit` AS `cust_unit`,`customer`.`cust_cp` AS `cust_cp`,`customer`.`cust_cptelp` AS `cust_cptelp`,`customer`.`cust_aktif` AS `cust_aktif`,`customer`.`cust_creator` AS `cust_creator`,`customer`.`cust_date_create` AS `cust_date_create`,`customer`.`cust_update` AS `cust_update`,`customer`.`cust_date_update` AS `cust_date_update`,`customer`.`cust_revised` AS `cust_revised`,`cust_ref`.`cust_nama` AS `cust_nama_ref`,`cabang`.`cabang_nama` AS `cabang_nama`,`cabang`.`cabang_alamat` AS `cabang_alamat` from ((`customer` left join `customer` `cust_ref` on((`customer`.`cust_referensi` = `cust_ref`.`cust_id`))) left join `cabang` on((`customer`.`cust_unit` = `cabang`.`cabang_id`)));