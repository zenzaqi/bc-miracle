UPDATE master_lunas_piutang, vu_piutang_jproduk
SET master_lunas_piutang.lpiutang_total = vu_piutang_jproduk.piutang_total
WHERE master_lunas_piutang.lpiutang_faktur = vu_piutang_jproduk.jproduk_nobukti 
	and master_lunas_piutang.lpiutang_total<>vu_piutang_jproduk.piutang_total;