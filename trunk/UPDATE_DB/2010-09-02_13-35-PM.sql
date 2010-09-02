/*update db.cetak_kwitansi.kwitansi_sisa = nilai dari kwitansi dikurangi dengan jumlah total di db.jual_kwitansi*/

UPDATE cetak_kwitansi, (select sum(jkwitansi_nilai) as total_kwitansi, jkwitansi_master 
	from jual_kwitansi where jkwitansi_master<>0 and jkwitansi_stat_dok<>'Batal' group by jkwitansi_master) as vu_kw
SET kwitansi_sisa=(kwitansi_nilai - vu_kw.total_kwitansi)
WHERE vu_kw.jkwitansi_master=kwitansi_id;


/*mengisi db.cetak_kwitansi.kwitansi_sisa = db.cetak_kwitansi.kwitansi_nilai dimana kwitansi_id tidak ada pada db.jual_kwitansi*/

UPDATE cetak_kwitansi
SET kwitansi_sisa=kwitansi_nilai
WHERE kwitansi_id not in (select jkwitansi_master from jual_kwitansi);
