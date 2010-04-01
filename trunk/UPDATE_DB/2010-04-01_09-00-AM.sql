update jual_card,vu_trans_union set jcard_transaksi=jenis_transaksi, jcard_date_create=tanggal
where jcard_ref=no_bukti;

update jual_cek,vu_trans_union set jcek_transaksi=jenis_transaksi, jcek_date_create=tanggal
where jcek_ref=no_bukti;

update jual_kredit,vu_trans_union set jkredit_transaksi=jenis_transaksi, jkredit_date_create=tanggal
where jkredit_ref=no_bukti;

update jual_transfer,vu_trans_union set jtransfer_transaksi=jenis_transaksi, jtransfer_date_create=tanggal
where jtransfer_ref=no_bukti;

update jual_tunai,vu_trans_union set jtunai_transaksi=jenis_transaksi, jtunai_date_create=tanggal
where jtunai_ref=no_bukti;

update jual_kwitansi,vu_trans_union set jkwitansi_transaksi=jenis_transaksi, jkwitansi_date_create=tanggal
where jkwitansi_ref=no_bukti;

update voucher_terima,vu_trans_union set tvoucher_transaksi=jenis_transaksi, tvoucher_date_create=tanggal
where tvoucher_ref=no_bukti;


CREATE OR REPLACE VIEW `vu_trans_terima_jual` AS select `jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,`jual_tunai`.`jtunai_date_create` AS `tanggal`,`jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_tunai` union select `jual_card`.`jcard_transaksi` AS `jenis_transaksi`,`jual_card`.`jcard_date_create` AS `tanggal`,0 AS `nilai_tunai`,`jual_card`.`jcard_nilai` AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_card` union select `jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,`jual_cek`.`jcek_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,`jual_cek`.`jcek_nilai` AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_cek` union select `jual_transfer`.`jtransfer_transaksi` AS `jenis_transaksi`,`jual_transfer`.`jtransfer_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,`jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_transfer` union select `jual_kwitansi`.`jkwitansi_transaksi` AS `jenis_transaksi`,`jual_kwitansi`.`jkwitansi_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,`jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_kwitansi` union select `voucher_terima`.`tvoucher_transaksi` AS `jenis_transaksi`,`voucher_terima`.`tvoucher_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,`voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,0 AS `nilai_kredit` from `voucher_terima` union select `jual_kredit`.`jkredit_transaksi` AS `jenis_transaksi`,`jual_kredit`.`jkredit_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,`jual_kredit`.`jkredit_nilai` AS `nilai_kredit` from `jual_kredit`;
