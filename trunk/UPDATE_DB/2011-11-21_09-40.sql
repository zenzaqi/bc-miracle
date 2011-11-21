DROP PROCEDURE pr_netsales;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_netsales`(IN `tgl_awal` DATE, IN `tgl_akhir` DATE, IN `opsi` ENUM('Detail', 'Rekap'), OUT `SalesMedis` DOUBLE, OUT `SalesNonMedis` DOUBLE, OUT `SalesSurgery` DOUBLE, OUT `SalesAntiAging` DOUBLE, OUT `SalesProduk` DOUBLE, OUT `SalesLainLain` DOUBLE, OUT `SalesTotal` DOUBLE)
BEGIN
/* saat ini baru opsi Rekap yg bisa*/
/* contoh pengisian parameter tgl_awal & tgl_akhir = '2011-09-01', '2011-09-30'*/

/* procedure ini menghasilkan data pada variable OUT*/

declare dSalesTot double;
declare dSalesNM double;
declare dSalesM double;
declare dSalesS double;
declare dSalesAA double;
declare dSalesLL double;
declare dSalesP double;
declare dReturP double;
declare dVoucher double;

SELECT
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat_simple 
	WHERE 
		jrawat_stat_dok='Tertutup' 
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Medis')
	+			
	(SELECT  
		ifnull(sum(total_harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat_simple 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Medis')
INTO dSalesM;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat_simple 
	WHERE 
		jrawat_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Non Medis') 
	+
	(SELECT  
		ifnull(sum(total_harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat_simple 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Non Medis')
INTO dSalesNM;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat_simple 
	WHERE 
		jrawat_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Surgery') 
	+
	(SELECT  
		ifnull(sum(total_harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat_simple 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' 
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Surgery')
INTO dSalesS;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat_simple 
	WHERE 
		jrawat_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Anti Aging') 
	+
	(SELECT  
		ifnull(sum(total_harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat_simple 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Anti Aging')
INTO dSalesAA;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat_simple 
	WHERE 
		jrawat_stat_dok='Tertutup' 
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama <> 'Medis' AND kategori_nama <> 'Non Medis' AND kategori_nama <> 'Surgery' AND kategori_nama <> 'Anti Aging') 
	+
	(SELECT  
		ifnull(sum(total_harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat_simple 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama <> 'Medis' AND kategori_nama <> 'Non Medis' AND kategori_nama <> 'Surgery' AND kategori_nama <> 'Anti Aging')
INTO dSalesLL;

select ifnull(sum(m1.jproduk_totalbiaya), 0)
from master_jual_produk m1
where 
	m1.jproduk_stat_dok = 'Tertutup'
	and m1.jproduk_tanggal >= tgl_awal and m1.jproduk_tanggal <= tgl_akhir
into dSalesP;

select ifnull(sum(v.total_nilai), 0) from vu_trans_retur_produk v
where v.tanggal between tgl_awal and tgl_akhir
into dReturP;

select ifnull(sum(m.jrawat_cashback), 0)
from master_jual_rawat m
where 
	m.jrawat_stat_dok = 'Tertutup'
	and m.jrawat_tanggal >= tgl_awal and m.jrawat_tanggal <= tgl_akhir
into dVoucher;
				
/* menampilkan row data*/
/*select 
	tgl_awal, tgl_akhir,
	dSalesM - dVoucher as SalesMedis, 
	dSalesNM as SalesNonMedis,
	dSalesS as SalesSurgery,
	dSalesAA as SalesAntiAging,
	dSalesP as SalesProduk,
	dSalesLL as SalesLainLain,
	dSalesM + (dSalesNM - dVoucher) + dSalesS + dSalesAA + dSalesP + dSalesLL as SalesTotal;	
*/

/*mengisikan row data pada variable OUT*/
select 
	dSalesM, 
	dSalesNM - dVoucher,
	dSalesS,
	dSalesAA,
	dSalesP - dReturP,
	dSalesLL,
	dSalesM + (dSalesNM - dVoucher) + dSalesS + dSalesAA + (dSalesP - dReturP)
into SalesMedis, SalesNonMedis, SalesSurgery, SalesAntiAging, SalesProduk, SalesLainLain, SalesTotal;	

END;
DELIMITER;