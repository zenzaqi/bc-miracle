/* pr_kunjungan & pr_netsales*/

drop procedure if exists  pr_kunjungan;
drop procedure if exists  pr_netsales;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_kunjungan`(IN `tgl_awal` VARCHAR(12), IN `tgl_akhir` VARCHAR(12), IN `cust_jns_kelamin` ENUM('L', 'P', 'Semua'), IN `cust_member` ENUM('Lama', 'Baru', 'Non Member', 'Semua'), IN `cust_baru` ENUM('Lama', 'Baru', 'Semua'), IN `tgllahir_awal` VARCHAR(12), IN `tgllahir_akhir` VARCHAR(12), IN `umur_awal` TINYINT, IN `umur_akhir` TINYINT, IN `opsi` ENUM('Rekap', 'Detail'), OUT `KunjTglAwal` VARCHAR(12), OUT `KunjTglAkhir` VARCHAR(12), OUT `KunjMedis` INT, OUT `KunjNonMedis` INT, OUT `KunjSurgery` INT, OUT `KunjAntiAging` INT, OUT `KunjProduk` INT, OUT `KunjTotal` INT)
BEGIN

/* jika opsi Rekap, maka hasil akan disimpan di variable OUT
	jika opsi Detail, maka hasil tidak disimpan di variable OUT, melainkan langsung berupa row data*/

DECLARE sql_utama VARCHAR(15000);

declare sql_cust_baru_jrawat varchar(100);
declare sql_cust_baru_dapaket varchar(100);
declare sql_cust_baru_jproduk varchar(100);

declare sql_cust_jns_kelamin varchar(100);
declare sql_cust_member varchar(100);
declare sql_cust_tgllahir varchar(100);
declare sql_cust_umur varchar(100);

declare sql_opsi varchar(100);
declare sql_tgl varchar(100);
declare sql_into varchar(200);

declare vKunjTglAwal varchar(12);

/*Query Opsi Detail atau Rekap*/
case opsi
	when 'Detail' then begin
		set sql_tgl 	= ' tgl_tindakan as tgl_awal, tgl_tindakan as tgl_akhir, '; 
		set sql_opsi 	= ' group by tgl_tindakan ';
		set sql_into	= ' ';
	end;
	else begin
		set sql_tgl 	= concat(tgl_awal, ' as tgl_awal, ', tgl_akhir, ' as tgl_akhir, '); 
		set sql_opsi 	= ' ';
		set sql_into	= ' into @KunjTglAwal, @KunjTglAkhir, @KunjMedis, @KunjNonMedis, @KunjSurgery, @KunjAntiAging, @KunjProduk, @KunjTotal ';
	end;
end case;

/* Query Customer Baru*/
case cust_baru
	when 'Baru' then begin
		set sql_cust_baru_jrawat	= ' and master_jual_rawat.jrawat_tanggal = vu_customer.cust_tglawaltrans ';
		set sql_cust_baru_dapaket	= ' and detail_ambil_paket.dapaket_tgl_ambil = vu_customer.cust_tglawaltrans ';
		set sql_cust_baru_jproduk	= ' and master_jual_produk.jproduk_tanggal = vu_customer.cust_tglawaltrans ';
	end;
	when 'Lama' then begin
		set sql_cust_baru_jrawat	= concat(' and vu_customer.cust_tglawaltrans not between ' , tgl_awal, ' and ', tgl_akhir, ' ');
		set sql_cust_baru_dapaket	= concat(' and vu_customer.cust_tglawaltrans not between ' , tgl_awal, ' and ', tgl_akhir, ' ');
		set sql_cust_baru_jproduk	= concat(' and vu_customer.cust_tglawaltrans not between ' , tgl_awal, ' and ', tgl_akhir, ' ');
	end;
	else begin
		set sql_cust_baru_jrawat	= ' ';
		set sql_cust_baru_dapaket	= ' ';
		set sql_cust_baru_jproduk	= ' ';
	end;
end case;

/* Query Jenis Kelamin*/
case cust_jns_kelamin
	when 'L' then set sql_cust_jns_kelamin	= concat(' and vu_customer.cust_kelamin = "L" ');
	when 'P' then set sql_cust_jns_kelamin	= concat(' and vu_customer.cust_kelamin = "P" ');
	else set sql_cust_jns_kelamin = ' ';
end case;

/* Query Member*/
case cust_member
	when 'Baru' then set sql_cust_member	= concat(' and vu_customer.member_register between ', tgl_awal, ' and ', tgl_akhir, ' ');
	when 'Lama' then set sql_cust_member	= concat(' and vu_customer.member_register not between ', tgl_awal, ' and ', tgl_akhir, ' ');
	when 'Non Member' then set sql_cust_member	= ' and vu_customer.cust_member = 0 ';
	else set sql_cust_member = ' ';
end case;

/*Query Tgl Lahir*/
case 
	when tgllahir_awal <> '' and tgllahir_akhir <> '' then
		set sql_cust_tgllahir = concat(' and cust_tgllahir BETWEEN ', tgllahir_awal, ' AND ', tgllahir_akhir, ' ');
	when tgllahir_awal <> '' and tgllahir_akhir = '' then
		set sql_cust_tgllahir = concat(' and cust_tgllahir >= ', tgllahir_awal, ' ');
	when tgllahir_awal = '' and tgllahir_akhir <> '' then
		set sql_cust_tgllahir = concat(' and cust_tgllahir <= ', tgllahir_akhir, ' ');
	else set sql_cust_tgllahir = ' ';
end case;

/*Query Umur*/
case 
	when umur_awal <> '' and umur_akhir <> '' then
		set sql_cust_umur = concat(' and (year(now())-year(cust_tgllahir)) BETWEEN ', umur_awal, ' AND ', umur_akhir, ' ');
	when umur_awal <> '' and umur_akhir = '' then
		set sql_cust_umur = concat(' and (year(now())-year(cust_tgllahir)) >= ', umur_awal, ' ');
	when umur_awal = '' and umur_akhir <> '' then
		set sql_cust_umur = concat(' and (year(now())-year(cust_tgllahir)) <= ', umur_akhir, ' ');
	else set sql_cust_umur = ' ';
end case;


/* Query Utama*/
SET sql_utama 	= CONCAT
('
select ',
	sql_tgl, ' 
	sum(jum_cust_medis) as KunjMedis,
	sum(jum_cust_surgery) as KunjSurgery,
	sum(jum_cust_antiaging) as KunjAntiAging,
	sum(jum_cust_nonmedis) as KunjNonMedis,
	sum(jum_cust_produk) as KunjProduk, 
	sum(jum_total) as KunjTotal
from
(

	/* MEDIS */
	(
	select 
		count(distinct temp_jum_cust_medis) as jum_cust_medis,
		jum_cust_surgery,
		jum_cust_antiaging,
		jum_cust_nonmedis,
		jum_cust_produk,
		jum_total,
		tgl_tindakan
	from
		(
		(
		select 
			master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			master_jual_rawat.jrawat_tanggal as tgl_tindakan
		from detail_jual_rawat
		left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
		left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
		left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
		where 
			perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok = "Tertutup" 
			and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0)
			and (master_jual_rawat.jrawat_tanggal between ', tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_jrawat,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		
		union
		
		(
		select 
			detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
		from detail_ambil_paket
		left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
		left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
		where 
			perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok = "Tertutup"
			and (detail_ambil_paket.dapaket_tgl_ambil between ',tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_dapaket,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		)
	as table_sum_medis
	group by tgl_tindakan
	)
	
	union
	
	/* SURGERY */
	(
	select 
		jum_cust_medis,
		count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
		jum_cust_antiaging,
		jum_cust_nonmedis,
		jum_cust_produk,
		jum_total,
		tgl_tindakan
	from
		(
		(
		select 
			0 as jum_cust_medis,
			master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			master_jual_rawat.jrawat_tanggal as tgl_tindakan
		from detail_jual_rawat
		left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
		left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
		left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
		where 
			perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok = "Tertutup" 
			and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) 
			and (master_jual_rawat.jrawat_tanggal between ', tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_jrawat,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		
		union
		
		(
		select 
			0 as jum_cust_medis,
			detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
		from detail_ambil_paket
		left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
		left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
		where 
			perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok = "Tertutup" 
			and (detail_ambil_paket.dapaket_tgl_ambil between ',tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_dapaket,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		)
	as table_sum_surgery
	group by tgl_tindakan
	)

	union

	/* ANTI AGING */
	(
	select 
		jum_cust_medis,
		jum_cust_surgery,
		count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
		jum_cust_nonmedis,
		jum_cust_produk,
		jum_total,
		tgl_tindakan
	from
		(
		(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			master_jual_rawat.jrawat_tanggal as tgl_tindakan
		from detail_jual_rawat
		left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
		left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
		left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
		where 
			perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok = "Tertutup" 
			and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) 
			and (master_jual_rawat.jrawat_tanggal between ', tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_jrawat,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		
		union
		
		(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
		from detail_ambil_paket
		left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
		left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
		where 
			perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok = "Tertutup" 
			and (detail_ambil_paket.dapaket_tgl_ambil between ',tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_dapaket,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		)
	as table_sum_antiaging
	group by tgl_tindakan
	)
	
	union
	
	/*  NON-MEDIS */
	(
	select 
		jum_cust_medis,
		jum_cust_surgery,
		jum_cust_antiaging,
		count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
		jum_cust_produk,
		jum_total,
		tgl_tindakan
	from
		(
		(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			master_jual_rawat.jrawat_tanggal as tgl_tindakan
		from detail_jual_rawat
		left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
		left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
		left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
		where 
			perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok = "Tertutup" 
			and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) 
			and (master_jual_rawat.jrawat_tanggal between ', tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_jrawat,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		
		union
		
		(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
		from detail_ambil_paket
		left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
		left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
		where 
			perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok = "Tertutup" 
			and (detail_ambil_paket.dapaket_tgl_ambil between ',tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_dapaket,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		)
	as table_sum_nonmedis
	group by tgl_tindakan
	)
	
	union
	
	/* PRODUK*/
	(
	select 
		0 as jum_cust_medis,
		0 as jum_cust_surgery,
		0 as jum_cust_antiaging,
		0 as jum_cust_nonmedis,
		count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
		0 as jum_total,
		master_jual_produk.jproduk_tanggal as tgl_tindakan
	from master_jual_produk
	left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
	where 
		master_jual_produk.jproduk_stat_dok = "Tertutup" 
		and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0)
		and (master_jual_produk.jproduk_tanggal between ',tgl_awal, ' and ', tgl_akhir, ') ',
		sql_cust_jns_kelamin,
		sql_cust_member,
		sql_cust_baru_dapaket,
		sql_cust_tgllahir,
		sql_cust_umur, ' 
	group by tgl_tindakan
	)
 	
 	union
 	
	/* TOTAL*/
	(
	select 
		jum_cust_medis,
		jum_cust_surgery,
		jum_cust_antiaging,
		jum_cust_nonmedis,
		jum_cust_produk,
		count(distinct cust) as jum_total,
		tgl_tindakan
	from	
	(
		(	
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			master_jual_rawat.jrawat_cust as cust,
			master_jual_rawat.jrawat_tanggal as tgl_tindakan
		from detail_jual_rawat
		left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
		left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
		left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
		where 
			master_jual_rawat.jrawat_stat_dok = "Tertutup" 
			and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) 
			and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) 
			and (master_jual_rawat.jrawat_tanggal between ', tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_jrawat,
			sql_cust_tgllahir,
			sql_cust_umur, ' 

		)
		
		union
		
		(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			master_jual_produk.jproduk_cust as cust,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
		where 
			master_jual_produk.jproduk_stat_dok = "Tertutup" 
			and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) 
			and (master_jual_produk.jproduk_tanggal between ',tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_dapaket,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
			
		union
		
		(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			detail_ambil_paket.dapaket_cust as cust,
			detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
		from detail_ambil_paket
		left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
		left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
		where 
			(perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) 
			and detail_ambil_paket.dapaket_stat_dok = "Tertutup" 
			and (detail_ambil_paket.dapaket_tgl_ambil between ',tgl_awal, ' and ', tgl_akhir, ') ',
			sql_cust_jns_kelamin,
			sql_cust_member,
			sql_cust_baru_dapaket,
			sql_cust_tgllahir,
			sql_cust_umur, ' 
		)
		)
	as table_union2
	group by tgl_tindakan
	)
	
)
as table_union',
sql_opsi,
sql_into
);
/*
select sql_utama;
*/

SET @sql		= sql_utama;
PREPARE s1 FROM @sql;
EXECUTE s1;
DEALLOCATE PREPARE s1;

case opsi
	when 'Rekap' then
		select @KunjTglAwal, @KunjTglAkhir, @KunjMedis, @KunjNonMedis, @KunjSurgery, @KunjAntiAging, @KunjProduk, @KunjTotal 
		into KunjTglAwal, KunjTglAkhir, KunjMedis, KunjNonMedis, KunjSurgery, KunjAntiAging, KunjProduk, KunjTotal;
end case;


END;


CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_netsales`(IN `tgl_awal` DATE, IN `tgl_akhir` DATE, IN `opsi` ENUM('Detail', 'Rekap'), OUT `SalesMedis` DOUBLE, OUT `SalesNonMedis` DOUBLE, OUT `SalesSurgery` DOUBLE, OUT `SalesAntiAging` DOUBLE, OUT `SalesProduk` DOUBLE, OUT `SalesLainLain` DOUBLE, OUT `SalesTotal` DOUBLE)
BEGIN
/* saat ini baru opsi Rekap yg bisa*/
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
	(dSalesM - dVoucher) + dSalesNM + dSalesS + dSalesAA + dSalesP + dSalesLL as SalesTotal;	
*/

/*mengisikan row data pada variable OUT*/
select 
	dSalesM - dVoucher, 
	dSalesNM,
	dSalesS,
	dSalesAA,
	dSalesP,
	dSalesLL,
	(dSalesM - dVoucher) + dSalesNM + dSalesS + dSalesAA + dSalesP
into SalesMedis, SalesNonMedis, SalesSurgery, SalesAntiAging, SalesProduk, SalesLainLain, SalesTotal;	

END;
DELIMITER;