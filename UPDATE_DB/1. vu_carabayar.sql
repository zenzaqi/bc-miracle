/* VIEW untuk mengetahui Total Bayar per Faktur pada setiap Cara Bayar */

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jcard_per_faktur_temp` AS select `jual_card`.`jcard_ref` AS `jcard_ref`,sum(`jual_card`.`jcard_nilai`) AS `total_jcard_nilai` from `jual_card` group by `jual_card`.`jcard_ref`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jcek_per_faktur_temp` AS select `jual_cek`.`jcek_ref` AS `jcek_ref`,sum(`jual_cek`.`jcek_nilai`) AS `total_jcek_nilai` from `jual_cek` group by `jual_cek`.`jcek_ref`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jkwitansi_per_faktur_temp` AS select `jual_kwitansi`.`jkwitansi_ref` AS `jkwitansi_ref`,sum(`jual_kwitansi`.`jkwitansi_nilai`) AS `total_jkwitansi_nilai` from `jual_kwitansi` group by `jual_kwitansi`.`jkwitansi_ref`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jtransfer_per_faktur_temp` AS select `jual_transfer`.`jtransfer_ref` AS `jtransfer_ref`,sum(`jual_transfer`.`jtransfer_nilai`) AS `total_jtransfer_nilai` from `jual_transfer` group by `jual_transfer`.`jtransfer_ref`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jtunai_per_faktur_temp` AS select `jual_tunai`.`jtunai_ref` AS `jtunai_ref`,sum(`jual_tunai`.`jtunai_nilai`) AS `total_jtunai_nilai` from `jual_tunai` group by `jual_tunai`.`jtunai_ref`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_tvoucher_per_faktur_temp` AS select `voucher_terima`.`tvoucher_ref` AS `tvoucher_ref`,sum(`voucher_terima`.`tvoucher_nilai`) AS `total_tvoucher_nilai` from `voucher_terima` group by `voucher_terima`.`tvoucher_ref`;