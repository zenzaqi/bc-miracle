drop procedure if exists pr_sms_kunj_sales;

DELIMITER $$
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
		' NM(-V M&NM):', @SalesNonMedis,
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