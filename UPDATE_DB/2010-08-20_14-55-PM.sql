/*update master_lunas_piutang.lpiutang_stat_dok='Batal' u/ pembayaran yg mestinya sudah lunas ==> menghindari mendelete*/

UPDATE master_lunas_piutang
SET master_lunas_piutang.lpiutang_stat_dok='Batal'
WHERE master_lunas_piutang.lpiutang_faktur like 'FT%' AND master_lunas_piutang.lpiutang_faktur NOT IN (
	select vu_piutang_jproduk.jproduk_nobukti FROM vu_piutang_jproduk
) AND master_lunas_piutang.lpiutang_stat_dok<>'Batal';



/*update master_lunas_piutang.lpiutang_sisa = master_lunas_piutang.lpiutang_total dimana lpiutang_sisa=NULL 
==> jika lpiutang_sisa berisi NULL maka tidak bisa dilakukan pelunasan karena tidak keluar di detail-List*/

UPDATE master_lunas_piutang
SET master_lunas_piutang.lpiutang_sisa = master_lunas_piutang.lpiutang_total
WHERE master_lunas_piutang.lpiutang_stat_dok<>'Batal'
	AND master_lunas_piutang.lpiutang_sisa is null
	AND master_lunas_piutang.lpiutang_faktur like 'FT%';
