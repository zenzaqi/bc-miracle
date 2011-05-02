CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_sum_jual_card` AS select date_format(`jual_card`.`jcard_date_create`,'%Y-%m-%d') AS `jcard_date_create`,`jual_card`.`jcard_transaksi` AS `jcard_transaksi`,`jual_card`.`jcard_stat_dok` AS `jcard_stat_dok`,`jual_card`.`jcard_ref` AS `jcard_ref`,sum(`jual_card`.`jcard_nilai`) AS `jcard_nilai` from `jual_card` group by date_format(`jual_card`.`jcard_date_create`,'%Y-%m-%d'),`jual_card`.`jcard_transaksi`,`jual_card`.`jcard_ref`,`jual_card`.`jcard_stat_dok`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_sum_jual_cek` AS select date_format(`jual_cek`.`jcek_date_create`,'%Y-%m-%d') AS `jcek_date_create`,`jual_cek`.`jcek_transaksi` AS `jcek_transaksi`,`jual_cek`.`jcek_stat_dok` AS `jcek_stat_dok`,`jual_cek`.`jcek_ref` AS `jcek_ref`,sum(`jual_cek`.`jcek_nilai`) AS `jcek_nilai` from `jual_cek` group by date_format(`jual_cek`.`jcek_date_create`,'%Y-%m-%d'),`jual_cek`.`jcek_transaksi`,`jual_cek`.`jcek_ref`,`jual_cek`.`jcek_stat_dok`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_sum_jual_kwitansi` AS select date_format(`jual_kwitansi`.`jkwitansi_date_create`,'%Y-%m-%d') AS `jkwitansi_date_create`,`jual_kwitansi`.`jkwitansi_transaksi` AS `jkwitansi_transaksi`,`jual_kwitansi`.`jkwitansi_stat_dok` AS `jkwitansi_stat_dok`,`jual_kwitansi`.`jkwitansi_ref` AS `jkwitansi_ref`,sum(`jual_kwitansi`.`jkwitansi_nilai`) AS `jkwitansi_nilai` from `jual_kwitansi` group by date_format(`jual_kwitansi`.`jkwitansi_date_create`,'%Y-%m-%d'),`jual_kwitansi`.`jkwitansi_transaksi`,`jual_kwitansi`.`jkwitansi_ref`,`jual_kwitansi`.`jkwitansi_stat_dok`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_sum_jual_transfer` AS select date_format(`jual_transfer`.`jtransfer_date_create`,'%Y-%m-%d') AS `jtransfer_date_create`,`jual_transfer`.`jtransfer_transaksi` AS `jtransfer_transaksi`,`jual_transfer`.`jtransfer_stat_dok` AS `jtransfer_stat_dok`,`jual_transfer`.`jtransfer_ref` AS `jtransfer_ref`,sum(`jual_transfer`.`jtransfer_nilai`) AS `jtransfer_nilai` from `jual_transfer` group by date_format(`jual_transfer`.`jtransfer_date_create`,'%Y-%m-%d'),`jual_transfer`.`jtransfer_transaksi`,`jual_transfer`.`jtransfer_ref`,`jual_transfer`.`jtransfer_stat_dok`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_sum_jual_tunai` AS select date_format(`jual_tunai`.`jtunai_date_create`,'%Y-%m-%d') AS `jtunai_date_create`,`jual_tunai`.`jtunai_transaksi` AS `jtunai_transaksi`,`jual_tunai`.`jtunai_ref` AS `jtunai_ref`,`jual_tunai`.`jtunai_stat_dok` AS `jtunai_stat_dok`,sum(`jual_tunai`.`jtunai_nilai`) AS `jtunai_nilai` from `jual_tunai` group by date_format(`jual_tunai`.`jtunai_date_create`,'%Y-%m-%d'),`jual_tunai`.`jtunai_transaksi`,`jual_tunai`.`jtunai_ref`,`jual_tunai`.`jtunai_stat_dok`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_sum_jual_voucher` AS select date_format(`voucher_terima`.`tvoucher_date_create`,'%Y-%m-%d') AS `tvoucher_date_create`,`voucher_terima`.`tvoucher_transaksi` AS `tvoucher_transaksi`,`voucher_terima`.`tvoucher_stat_dok` AS `tvoucher_stat_dok`,`voucher_terima`.`tvoucher_ref` AS `tvoucher_ref`,sum(`voucher_terima`.`tvoucher_nilai`) AS `tvoucher_nilai` from `voucher_terima` group by date_format(`voucher_terima`.`tvoucher_date_create`,'%Y-%m-%d'),`voucher_terima`.`tvoucher_transaksi`,`voucher_terima`.`tvoucher_ref`,`voucher_terima`.`tvoucher_stat_dok`;