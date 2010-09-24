/* 
* Query untuk mengecheck Faktur-faktur yang kurang valid 
* misal: cara bayar voucher yang hilang, seharusnya terjadi hutang tapi tidak masuk di tabel piutang.
*/
SELECT master_jual_rawat.jrawat_nobukti
  ,master_jual_rawat.jrawat_cust
  ,date_format(master_jual_rawat.jrawat_tanggal,'%Y-%m-%d') AS jrawat_tanggal
  ,master_jual_rawat.jrawat_cara
  ,master_jual_rawat.jrawat_cara2
  ,master_jual_rawat.jrawat_cara3
  ,master_jual_rawat.jrawat_bayar
  ,master_jual_rawat.jrawat_totalbiaya
  ,vu_jrawat_compare_bayar_temp.total_cara_bayar
  ,master_jual_rawat.jrawat_stat_dok
  FROM master_jual_rawat, vu_jrawat_compare_bayar_temp
 WHERE master_jual_rawat.jrawat_nobukti =
          vu_jrawat_compare_bayar_temp.jrawat_nobukti
       AND vu_jrawat_compare_bayar_temp.jrawat_tanggal > '2010-06-30'
       AND vu_jrawat_compare_bayar_temp.jrawat_bayar <>
              vu_jrawat_compare_bayar_temp.total_cara_bayar
       AND master_jual_rawat.jrawat_stat_dok='Tertutup';