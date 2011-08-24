# --------------------------------------------------------
# Host:                         localhost
# Server version:               5.1.33-community
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-08-24 08:25:39
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


# Dumping structure for procedure miracledb.pr_sms_kunj_sales
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_sms_kunj_sales`(IN `pPhoneGroup` smALLINT)
BEGIN

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

select
	total, nonmedis, medis, surgery,	antiaging, produk
from(
	select 
		date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
		sum(jum_cust_medis) as medis,
		sum(jum_cust_surgery) as surgery,
		sum(jum_cust_antiaging) as antiaging,
		sum(jum_cust_nonmedis) as nonmedis,
		sum(jum_cust_produk) as produk, 
		sum(jum_total) as total
	from(
		(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
		from(
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
			left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
			left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
			where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok = 'Tertutup' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
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
			left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
			where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok = 'Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
			)
		) as table_sum_medis
		group by tgl_tindakan
		)
	
	/* SURGERY */
	union
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
			((
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)	
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok = 'Tertutup' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok = 'Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
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
			((
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok = 'Tertutup' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok = 'Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
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
			((
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok = 'Tertutup' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok = 'Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
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
		left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
		where master_jual_produk.jproduk_stat_dok = 'Tertutup' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) 
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
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
			((	
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok = 'Tertutup'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
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
				left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
				where master_jual_produk.jproduk_stat_dok = 'Tertutup' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok = 'Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
			)	
		)as table_union2
		group by tgl_tindakan
		)

	) as table_union
	group by tgl_tindakan

) as kunjungan

into vKunjTot, vKunjNM, vKunjM, vKunjS, vKunjAA, vKunjP;
	
SELECT
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Medis')
	+			
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Medis')
INTO vSalesM;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Non Medis') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Non Medis')
INTO vSalesNM;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Surgery') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Surgery')
INTO vSalesS;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Anti Aging') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama = 'Anti Aging')
INTO vSalesAA;

SELECT	
	(SELECT  
		ifnull(sum(subtotal), 0)
	FROM vu_detail_jual_rawat 
	WHERE 
		jrawat_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama <> 'Medis' AND kategori_nama <> 'Non Medis' AND kategori_nama <> 'Surgery' AND kategori_nama <> 'Anti Aging') 
	+
	(SELECT  
		ifnull(sum(harga_satuan), 0)
	FROM vu_detail_ambil_paket_rawat 
	WHERE 
		jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND 
		date_format(tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) AND
		kategori_nama <> 'Medis' AND kategori_nama <> 'Non Medis' AND kategori_nama <> 'Surgery' AND kategori_nama <> 'Anti Aging')
INTO vSalesLL;

select sum(m1.jproduk_totalbiaya)
from master_jual_produk m1
where 
	m1.jproduk_tanggal = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day) and 
	m1.jproduk_stat_dok = 'Tertutup'
into vSalesP;

select ifnull(sum(master_jual_rawat.jrawat_cashback), 0)
from master_jual_rawat
where date_format(jrawat_tanggal, '%Y-%m-%d') = date_add(date_format(now(), '%Y-%m-%d'), interval -1 day)
and master_jual_rawat.jrawat_stat_dok = 'Tertutup'
into vVoucher;
				
select vSalesM + vSalesNM + vSalesS + vSalesAA + vSalesLL + vSalesP - vVoucher
into vSalesTot;


select
	concat(
		'MIS UPDATE: MIRACLE ', vCbgKode,
		' ', date_add(date_format(now(), '%Y-%m-%d'), interval -1 day), ', '
		'KUNJ:',	vKunjTot, 
		' (M:', vKunjM, 
		' S:', vKunjS, 
		' AA:', vKunjAA, 
		' NM:', vKunjNM, 
		' P:', vKunjP, '), ',
		'NET SALES: ', vSalesTot,
		' (M:', vSalesM,
		' S:', vSalesS,
		' AA:', vSalesAA,
		' LL:', vSalesLL,
		' NM:', vSalesNM,
		' P:', vSalesP, ')'
	)
into vMSG;

/*Jika data tidak valid (tot kunj = 0)*/

if vKunjTot is null then

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

END//
DELIMITER ;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
