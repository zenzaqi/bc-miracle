/*Voucher dikurangkan ke Non Medis, bukan lagi Medis */

drop procedure if exists pr_netsales;
drop procedure if exists pr_sms_kunj_sales;


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
declare dVoucher double;

SELECT
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' 
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Medis')
	+			
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Medis')
INTO dSalesM;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Non Medis') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Non Medis')
INTO dSalesNM;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Surgery') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' 
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Surgery')
INTO dSalesS;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Anti Aging') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama = 'Anti Aging')
INTO dSalesAA;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' 
		and tanggal >= tgl_awal and tanggal <= tgl_akhir
		and kategori_nama <> 'Medis' AND kategori_nama <> 'Non Medis' AND kategori_nama <> 'Surgery' AND kategori_nama <> 'Anti Aging') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
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
	dSalesP,
	dSalesLL,
	dSalesM + (dSalesNM - dVoucher) + dSalesS + dSalesAA + dSalesP
into SalesMedis, SalesNonMedis, SalesSurgery, SalesAntiAging, SalesProduk, SalesLainLain, SalesTotal;	

END;


CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_sms_kunj_sales`(IN `pPhoneGroup` sMALLINT)
    MODIFIES SQL DATA
BEGIN

declare vTgl varchar(12);
declare dTgl date;

declare vCbgKode varchar(4);

declare vKunjTot varchar(3);
declare vKunjNM varchar(3);
declare vKunjM varchar(3);
declare vKunjS varchar(3);
declare vKunjAA varchar(3);
declare vKunjP varchar(3);

declare vSalesTot varchar(10);
declare vSalesNM varchar(10);
declare vSalesM varchar(10);
declare vSalesS varchar(10);
declare vSalesAA varchar(10);
declare vSalesLL varchar(10);
declare vSalesP varchar(10);
declare vVoucher varchar(10);

declare vMSG varchar(255);
declare vMSGNULL varchar(255);

DECLARE no_more_rows BOOLEAN;

declare vCustHP varchar(15);
declare vCustHPIT varchar(15);

declare curCustHP cursor for
	select c.cust_hp
	from miracledb_sms.phonegrouped d
	left join miracledb_sms.phonegroup p on p.phonegroup_id = d.phonegrouped_group
	left join miracledb_sms.customer c on c.cust_id = d.phonegrouped_cust
	where d.phonegrouped_group = pPhoneGroup;
	
declare curCustHPIT cursor for
	select c.cust_hp
	from miracledb_sms.phonegrouped d
	left join miracledb_sms.phonegroup p on p.phonegroup_id = d.phonegrouped_group
	left join miracledb_sms.customer c on c.cust_id = d.phonegrouped_cust
	where d.phonegrouped_group = 99;

DECLARE CONTINUE HANDLER FOR NOT FOUND	SET no_more_rows = TRUE;

select c.cabang_kode
from info i
left join cabang c on c.cabang_id = i.info_cabang
into vCbgKode;


/* variable tgl untuk pr_kunjungan */
select 
	concat("'", date_add(date_format(now(), '%Y-%m-%d'), interval -1 day), "'")
into vTgl;

/* variable tgl untuk pr_sales */
select 
	concat(date_add(date_format(now(), '%Y-%m-%d'), interval -1 day))
into dTgl;


/* Net Sales */
CALL pr_netsales(dTgl, dTgl, 'Rekap', @SalesMedis, @SalesNonMedis, @SalesSurgery, @SalesAntiAging, @SalesProduk, @SalesLainLain, @SalesTotal);

/*select @SalesMedis, @SalesNonMedis, @SalesSurgery, @SalesAntiAging, @SalesProduk, @SalesLainLain, @SalesTotal;
*/

/* Kunjungan */
CALL pr_kunjungan(vTgl, vTgl, 'Semua', 'Semua', 'Semua', '', '', '', '', 'Rekap', @KunjTglAwal, @KunjTglAkhir, @KunjMedis, @KunjNonMedis, @KunjSurgery, @KunjAntiAging, @KunjProduk, @KunjTotal);

/*select @KunjTglAwal, @KunjTglAkhir, @KunjMedis, @KunjNonMedis, @KunjSurgery, @KunjAntiAging, @KunjProduk, @KunjTotal;
*/

select
	concat(
		'MIS UPDATE: MIRACLE ', vCbgKode,
		' ', date_add(date_format(now(), '%Y-%m-%d'), interval -1 day), ', '
		'KUNJ:',	@KunjTotal, 
		' (M:', @KunjMedis, 
		' S:', @KunjSurgery, 
		' AA:', @KunjAntiAging, 
		' NM:', @KunjNonMedis, 
		' P:', @KunjProduk, '), ',
		'NET SALES: ', @SalesTotal,
		' (M:', @SalesMedis,
		' S:', @SalesSurgery,
		' AA:', @SalesAntiAging,
		' LL:', @SalesLainLain,
		' NM(-V):', @SalesNonMedis,
		' P:', @SalesProduk, ')'
	)
into vMSG;

/*select vMSG;*/

/*Jika data tidak valid (tot kunj = 0)*/

if @KunjTotal is null then

	select 0 into no_more_rows; /*karena no_more_rows telah terset = 1 (TRUE) ketika vKunjTot = null*/
	
	select concat('miracledb_', vCbgKode, ' DATA TIDAK VALID') into vMSGNULL;
	
	open curCustHPIT;
	
	the_loopIT: LOOP
	
		fetch curCustHPIT
		into vCustHPIT;
	
		IF no_more_rows THEN
	        CLOSE curCustHPIT;
	        LEAVE the_loopIT;
	    END IF;
	    
		insert into miracledb_sms.outbox(DestinationNumber, TextDecoded, CreatorID)
		select 
			vCustHPIT,	vMSGNULL, "System";
	
	end loop the_loopIT;

/*jika data valid*/

else

	open curCustHP;
	
	the_loop: LOOP
	
		fetch curCustHP
		into vCustHP;
	
		IF no_more_rows THEN
	        CLOSE curCustHP;
	        LEAVE the_loop;
	    END IF;
	
		insert into miracledb_sms.outbox(DestinationNumber, TextDecoded, CreatorID)
		select 
			vCustHP,	vMSG,	'System';
	
	end loop the_loop;

end if;

END;
DELIMITER;
