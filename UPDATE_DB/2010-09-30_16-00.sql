--utk dokumen yg timbul hutang, dimana seharusnya tidak ada hutang
--contoh THAMRIN, PR/1009-1022: 

DELETE FROM master_lunas_piutang
WHERE master_lunas_piutang.lpiutang_faktur like 'PR%' AND master_lunas_piutang.lpiutang_faktur NOT IN (
	SELECT vu_piutang_jrawat.jrawat_nobukti FROM vu_piutang_jrawat
) AND master_lunas_piutang.lpiutang_stat_dok<>'Batal';

--utk dokumen yg cara bayarnya hilang
--utk kasus ini yg hilang adalah Cara Bayar Cek / Giro

INSERT INTO jual_cek (
  jcek_ref
  ,jcek_transaksi
  ,jcek_no
  ,jcek_nama
  ,jcek_nilai
  ,jcek_stat_dok
  ,jcek_date_create
)
SELECT master_jual_rawat.jrawat_nobukti
  ,'jual_rawat'
  ,''
  ,''
  ,3400000
  ,'Tertutup'
  ,master_jual_rawat.jrawat_date_create
FROM master_jual_rawat
WHERE master_jual_rawat.jrawat_nobukti='PR/1009-1164';