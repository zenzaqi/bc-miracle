/* 
* CHECKING total hutang di db.master_jual_rawat (alias: vu_piutang_jrawat),
* yang TIDAK SAMA DENGAN db.master_lunas_piutang 
*/
SELECT vu_piutang_jrawat.jrawat_tanggal
	,vu_piutang_jrawat.jrawat_nobukti
	,vu_piutang_jrawat.piutang_total
	,master_lunas_piutang.lpiutang_total
FROM vu_piutang_jrawat 
left join master_lunas_piutang on(lpiutang_faktur=jrawat_nobukti)
WHERE master_lunas_piutang.lpiutang_total<>vu_piutang_jrawat.piutang_total;

/* 
* UPDATE total hutang di db.master_lunas_piutang agar == db.vu_piutang_jrawat.piutang_total 
*/
UPDATE master_lunas_piutang, vu_piutang_jrawat
SET master_lunas_piutang.lpiutang_total = vu_piutang_jrawat.piutang_total
WHERE master_lunas_piutang.lpiutang_faktur = vu_piutang_jrawat.jrawat_nobukti 
	and master_lunas_piutang.lpiutang_total <> vu_piutang_jrawat.piutang_total;

/* 
* CHECKING db.master_lunas_piutang.lpiutang_faktur yang TIDAK ADA di vu_piutang_jrawat 
* ==> ini artinya pembayaran dari customer sudah lunas tp kelolosan masuk ke master_lunas_piutang
*/
SELECT *
FROM master_lunas_piutang
WHERE master_lunas_piutang.lpiutang_faktur like 'PR%' AND master_lunas_piutang.lpiutang_faktur NOT IN (
	select vu_piutang_jrawat.jrawat_nobukti FROM vu_piutang_jrawat
) AND master_lunas_piutang.lpiutang_stat_dok<>'Batal'
	AND master_lunas_piutang.lpiutang_sisa is null
ORDER BY master_lunas_piutang.lpiutang_faktur_tanggal asc;


/* 
* DELETE FROM db.master_lunas_piutang u/ pembayaran yg mestinya sudah lunas 
*/
DELETE FROM master_lunas_piutang
WHERE master_lunas_piutang.lpiutang_faktur like 'PR%' AND master_lunas_piutang.lpiutang_faktur NOT IN (
	SELECT vu_piutang_jrawat.jrawat_nobukti FROM vu_piutang_jrawat
) AND master_lunas_piutang.lpiutang_stat_dok<>'Batal';


/* 
* CHECKING db.master_lunas_piutang.lpiutang_sisa=NULL 
*/
SELECT *
FROM master_lunas_piutang
WHERE lpiutang_sisa is null
	AND lpiutang_stat_dok<>'Batal'
	AND lpiutang_faktur like 'PR%';

/* 
* UPDATE db.master_lunas_piutang.lpiutang_sisa = db.master_lunas_piutang.lpiutang_total 
* WHERE lpiutang_sisa=NULL 
* ==> jika lpiutang_sisa berisi NULL, maka tidak bisa dilakukan pelunasan 
* karena tidak keluar di detail-List Kasir Pelunasan Piutang 
*/
UPDATE master_lunas_piutang
SET master_lunas_piutang.lpiutang_sisa = master_lunas_piutang.lpiutang_total
WHERE master_lunas_piutang.lpiutang_stat_dok<>'Batal'
	AND master_lunas_piutang.lpiutang_sisa is null
	AND master_lunas_piutang.lpiutang_faktur like 'PR%';

