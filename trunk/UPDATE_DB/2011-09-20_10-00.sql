ALTER TABLE `customer`  ADD COLUMN `cust_tglawaltrans` DATE NULL DEFAULT NULL AFTER `cust_terdaftar`;

/*script di bawah utk mengupdate cust_tglawaltrans*/

update master_jual_rawat m
left join customer c on c.cust_id = m.jrawat_cust
set c.cust_tglawaltrans = m.jrawat_tanggal
where 
	(c.cust_tglawaltrans is null or c.cust_tglawaltrans > m.jrawat_tanggal)
	and c.cust_id = m.jrawat_cust
	and m.jrawat_stat_dok = 'Tertutup';

update master_jual_produk m
left join customer c on c.cust_id = m.jproduk_cust
set c.cust_tglawaltrans = m.jproduk_tanggal
where 
	(c.cust_tglawaltrans is null or c.cust_tglawaltrans > m.jproduk_tanggal)
	and c.cust_id = m.jproduk_cust
	and m.jproduk_stat_dok = 'Tertutup';
	
/* master_jual_paket tidak dihitung kunjungan*/

update detail_ambil_paket m
left join customer c on c.cust_id = m.dapaket_cust
set c.cust_tglawaltrans = m.dapaket_tgl_ambil
where 
	(c.cust_tglawaltrans is null or c.cust_tglawaltrans > m.dapaket_tgl_ambil)
	and c.cust_id = m.dapaket_cust
	and m.dapaket_stat_dok = 'Tertutup';


/* TRIGGER*/
DROP TRIGGER `ins_cabin_ambil_paket`;
DROP TRIGGER `ins_cabin_rawat_satuan`;
	
DELIMITER $$
CREATE TRIGGER `detail_ambil_paket_ins` AFTER INSERT ON `detail_ambil_paket` FOR EACH ROW BEGIN

/* update cust_tglawaltrans */

	update customer c
	set c.cust_tglawaltrans = new.dapaket_tgl_ambil
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.dapaket_tgl_ambil)
		and c.cust_id = new.dapaket_cust
		and new.dapaket_stat_dok = 'Tertutup';
END;


CREATE TRIGGER `detail_ambil_paket_upd` AFTER UPDATE ON `detail_ambil_paket` FOR EACH ROW BEGIN 

/* ins cabin ambil paket */
IF old.dapaket_stat_dok = 'Terbuka' and new.dapaket_stat_dok = 'Tertutup' THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_dapaket_id, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_paket.jpaket_nobukti   ,detail_ambil_paket.dapaket_id   ,krawat_satuan   ,krawat_jumlah*detail_ambil_paket.dapaket_jumlah   ,rawat_gudang   ,master_jual_paket.jpaket_cust   FROM detail_ambil_paket   LEFT JOIN master_jual_paket on (master_jual_paket.jpaket_id= detail_ambil_paket.dapaket_jpaket)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_ambil_paket.dapaket_item)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE detail_ambil_paket.dapaket_id = old.dapaket_id AND produk_aktif='Aktif' ;  ELSEIF new.dapaket_stat_dok = 'Batal' or new.dapaket_stat_dok = 'Adj' THEN  delete from detail_pakai_cabin   WHERE cabin_dapaket_id = old.dapaket_id ;   END IF; 

/* update cust_tglawaltrans */

	update customer c
	set c.cust_tglawaltrans = new.dapaket_tgl_ambil
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.dapaket_tgl_ambil)
		and c.cust_id = new.dapaket_cust
		and new.dapaket_stat_dok = 'Tertutup';
END;


CREATE TRIGGER `master_jual_produk_ins` AFTER INSERT ON `master_jual_produk` FOR EACH ROW BEGIN

	/* update cust_tglawaltrans */

	update customer c
	set c.cust_tglawaltrans = new.jproduk_tanggal
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.jproduk_tanggal)
		and c.cust_id = new.jproduk_cust
		and new.jproduk_stat_dok = 'Tertutup';
END;


CREATE TRIGGER `master_jual_produk_upd` AFTER UPDATE ON `master_jual_produk` FOR EACH ROW BEGIN

	/* update cust_tglawaltrans */
	
	update customer c
	set c.cust_tglawaltrans = new.jproduk_tanggal
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.jproduk_tanggal)
		and c.cust_id = new.jproduk_cust
		and new.jproduk_stat_dok = 'Tertutup';
END;


CREATE TRIGGER `master_jual_rawat_ins` AFTER INSERT ON `master_jual_rawat` FOR EACH ROW BEGIN

/* update cust_tglawaltrans*/
	update customer c
	set c.cust_tglawaltrans = new.jrawat_tanggal
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.jrawat_tanggal)
		and c.cust_id = new.jrawat_cust
		and new.jrawat_stat_dok = 'Tertutup';
END;


CREATE TRIGGER `master_jual_rawat_upd` AFTER UPDATE ON `master_jual_rawat` FOR EACH ROW BEGIN  

/*INS CABIN RAWAT SATUAN*/
IF old.jrawat_stat_dok = 'Terbuka' and new.jrawat_stat_dok = 'Tertutup' THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_rawat.jrawat_nobukti   ,krawat_satuan   ,krawat_jumlah*detail_jual_rawat.drawat_jumlah   ,rawat_gudang   ,master_jual_rawat.jrawat_cust   FROM detail_jual_rawat   LEFT JOIN master_jual_rawat on (master_jual_rawat.jrawat_id = detail_jual_rawat.drawat_master)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_jual_rawat.drawat_rawat)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE master_jual_rawat.jrawat_id = OLD.jrawat_id AND produk_aktif='Aktif' ;  ELSEIF new.jrawat_stat_dok = 'Batal' THEN  delete from detail_pakai_cabin   WHERE cabin_bukti = old.jrawat_nobukti and cabin_cust = old.jrawat_cust    ;   END IF;  

/* update cust_tglawaltrans */
	update customer c
	set c.cust_tglawaltrans = new.jrawat_tanggal
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.jrawat_tanggal)
		and c.cust_id = new.jrawat_cust
		and new.jrawat_stat_dok = 'Tertutup';
END;
DELIMITER ;


/* VIEW */

CREATE OR REPLACE VIEW `vu_customer` AS select `customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`member`.`member_no` AS `member_no`,`member`.`member_register` AS `member_register`,`member`.`member_valid` AS `member_valid`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_title` AS `cust_title`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`customer`.`cust_kodepos` AS `cust_kodepos`,`customer`.`cust_propinsi` AS `cust_propinsi`,`customer`.`cust_negara` AS `cust_negara`,`customer`.`cust_alamat2` AS `cust_alamat2`,`customer`.`cust_kota2` AS `cust_kota2`,`customer`.`cust_kodepos2` AS `cust_kodepos2`,`customer`.`cust_propinsi2` AS `cust_propinsi2`,`customer`.`cust_negara2` AS `cust_negara2`,`customer`.`cust_telprumah` AS `cust_telprumah`,`customer`.`cust_telprumah2` AS `cust_telprumah2`,`customer`.`cust_telpkantor` AS `cust_telpkantor`,`customer`.`cust_hp` AS `cust_hp`,`customer`.`cust_hp2` AS `cust_hp2`,`customer`.`cust_hp3` AS `cust_hp3`,`customer`.`cust_email` AS `cust_email`,`customer`.`cust_fb` AS `cust_fb`,`customer`.`cust_tweeter` AS `cust_tweeter`,`customer`.`cust_email2` AS `cust_email2`,`customer`.`cust_fb2` AS `cust_fb2`,`customer`.`cust_tweeter2` AS `cust_tweeter2`,`customer`.`cust_agama` AS `cust_agama`,`customer`.`cust_pendidikan` AS `cust_pendidikan`,`customer`.`cust_profesi` AS `cust_profesi`,`customer`.`cust_tmptlahir` AS `cust_tmptlahir`,`customer`.`cust_tgllahir` AS `cust_tgllahir`,(date_format(now(),_utf8'%Y') - date_format(`customer`.`cust_tgllahir`,_utf8'%Y')) AS `cust_umur`,`customer`.`cust_hobi` AS `cust_hobi`,`customer`.`cust_referensi` AS `cust_referensi`,`customer`.`cust_referensilain` AS `cust_referensilain`,`customer`.`cust_keterangan` AS `cust_keterangan`,`customer`.`cust_terdaftar` AS `cust_terdaftar`,`customer`.`cust_statusnikah` AS `cust_statusnikah`,`customer`.`cust_jmlanak` AS `cust_jmlanak`,`customer`.`cust_unit` AS `cust_unit`,`customer`.`cust_cp` AS `cust_cp`,`customer`.`cust_cptelp` AS `cust_cptelp`,`customer`.`cust_aktif` AS `cust_aktif`,`customer`.`cust_fretfulness` AS `cust_fretfulness`,`customer`.`cust_point` AS `cust_point`,`customer`.`cust_creator` AS `cust_creator`,`customer`.`cust_date_create` AS `cust_date_create`,`customer`.`cust_update` AS `cust_update`,`customer`.`cust_date_update` AS `cust_date_update`,`customer`.`cust_revised` AS `cust_revised`,`cust_ref`.`cust_nama` AS `cust_nama_ref`,`cabang`.`cabang_nama` AS `cabang_nama`,`cabang`.`cabang_alamat` AS `cabang_alamat`,`customer`.`cust_crm_value` AS `cust_crm_value`,`crm_value`.`crmvalue_date` AS `crmvalue_date`,`crm_value`.`crmvalue_total` AS `crmvalue_total`,`crm_value`.`crmvalue_priority` AS `cust_priority`,`customer`.`cust_bb` AS `cust_bb`,`customer`.`cust_tglawaltrans` AS `cust_tglawaltrans` from ((((`customer` left join `customer` `cust_ref` on((`customer`.`cust_referensi` = `cust_ref`.`cust_id`))) left join `cabang` on((`customer`.`cust_unit` = `cabang`.`cabang_id`))) left join `member` on((`member`.`member_id` = `customer`.`cust_member`))) left join `crm_value` on((`customer`.`cust_crm_value` = `crm_value`.`crmvalue_id`)));

