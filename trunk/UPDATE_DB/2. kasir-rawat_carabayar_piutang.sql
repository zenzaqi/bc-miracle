/* 
* VIEW untuk mem-BANDING-kan antara db.master_jual_rawat.jrawat_bayar (Total Bayar) 
* v db.master_lunas_piutang.lpiutang_total (Total Hutang) 
* v db.master_jual_rawat.jrawat_totalbiaya (Total Transaksi) 
* v Total-Cara-Bayar (hasil dari penjumlahan total pembayaran di setiap Cara Bayar untuk Faktur yg sama) 
*/
CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_compare_bayar_temp` AS select `master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,ifnull(`master_lunas_piutang`.`lpiutang_total`,0) AS `lpiutang_total`,`master_jual_rawat`.`jrawat_totalbiaya` AS `jrawat_totalbiaya`,(((((ifnull(`vu_jcard_per_faktur_temp`.`total_jcard_nilai`,0) + ifnull(`vu_jcek_per_faktur_temp`.`total_jcek_nilai`,0)) + ifnull(`vu_jkwitansi_per_faktur_temp`.`total_jkwitansi_nilai`,0)) + ifnull(`vu_jtransfer_per_faktur_temp`.`total_jtransfer_nilai`,0)) + ifnull(`vu_jtunai_per_faktur_temp`.`total_jtunai_nilai`,0)) + ifnull(`vu_tvoucher_per_faktur_temp`.`total_tvoucher_nilai`,0)) AS `total_cara_bayar` from (((((((`master_jual_rawat` left join `vu_jcard_per_faktur_temp` on((`vu_jcard_per_faktur_temp`.`jcard_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_jcek_per_faktur_temp` on((`vu_jcek_per_faktur_temp`.`jcek_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_jkwitansi_per_faktur_temp` on((`vu_jkwitansi_per_faktur_temp`.`jkwitansi_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_jtransfer_per_faktur_temp` on((`vu_jtransfer_per_faktur_temp`.`jtransfer_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_jtunai_per_faktur_temp` on((`vu_jtunai_per_faktur_temp`.`jtunai_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_tvoucher_per_faktur_temp` on((`vu_tvoucher_per_faktur_temp`.`tvoucher_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `master_lunas_piutang` on((`master_lunas_piutang`.`lpiutang_faktur` = `master_jual_rawat`.`jrawat_nobukti`)));


/* START: db.master_jual_rawat.jrawat_bayar=0 ==> yang benar db.master_jual_rawat.jrawat_bayar = db.master_jual_rawat.jrawat_totalbiaya alias LUNAS */

/* 
* Menampung data transaksi Kasir Perawatan yang seharusnya Sudah LUNAS 
* tetapi db.master_jual_rawat.jrawat_bayar masih = 0
* ==> yang akan digunakan untuk proses Update db.master_jual_rawat.jrawat_bayar 
*/
CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_bayar_nol_temp` AS select `vu_jrawat_compare_bayar_temp`.`jrawat_tanggal` AS `jrawat_tanggal`,`vu_jrawat_compare_bayar_temp`.`jrawat_nobukti` AS `jrawat_nobukti`,`vu_jrawat_compare_bayar_temp`.`jrawat_bayar` AS `jrawat_bayar`,`vu_jrawat_compare_bayar_temp`.`lpiutang_total` AS `lpiutang_total`,`vu_jrawat_compare_bayar_temp`.`jrawat_totalbiaya` AS `jrawat_totalbiaya`,`vu_jrawat_compare_bayar_temp`.`total_cara_bayar` AS `total_cara_bayar` from `vu_jrawat_compare_bayar_temp` where ((`vu_jrawat_compare_bayar_temp`.`total_cara_bayar` = `vu_jrawat_compare_bayar_temp`.`jrawat_totalbiaya`) and (`vu_jrawat_compare_bayar_temp`.`jrawat_bayar` = 0) and (`vu_jrawat_compare_bayar_temp`.`lpiutang_total` <> 0));

/* 
* UPDATE db.master_jual_rawat.jrawat_bayar yang seharusnya sudah LUNAS 
*/
UPDATE master_jual_rawat, vu_jrawat_bayar_nol_temp
SET master_jual_rawat.jrawat_bayar = vu_jrawat_bayar_nol_temp.total_cara_bayar
WHERE master_jual_rawat.jrawat_nobukti = vu_jrawat_bayar_nol_temp.jrawat_nobukti;

/* END: db.master_jual_rawat.jrawat_bayar=0 ==> yang benar db.master_jual_rawat.jrawat_bayar = db.master_jual_rawat.jrawat_totalbiaya alias LUNAS */