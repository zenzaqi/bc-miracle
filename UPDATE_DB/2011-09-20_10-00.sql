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

CREATE TABLE `vu_customer` (
	`cust_id` INT(11) NOT NULL DEFAULT '0',
	`cust_no` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_member` INT(11) NOT NULL DEFAULT '0',
	`member_no` VARCHAR(50) NULL DEFAULT '-' COLLATE 'latin1_swedish_ci',
	`member_register` DATE NULL DEFAULT NULL,
	`member_valid` DATE NULL DEFAULT NULL,
	`cust_nama` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_title` ENUM('MR.','MRS.','MS.') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_panggilan` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_kelamin` ENUM('L','P') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_alamat` VARCHAR(250) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_kota` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_kodepos` VARCHAR(5) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_propinsi` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_negara` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_alamat2` VARCHAR(250) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_kota2` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_kodepos2` VARCHAR(5) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_propinsi2` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_negara2` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_telprumah` VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_telprumah2` VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_telpkantor` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_hp` VARCHAR(25) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_hp2` VARCHAR(25) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_hp3` VARCHAR(25) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_fb` TINYINT(1) NULL DEFAULT '0',
	`cust_tweeter` TINYINT(1) NULL DEFAULT '0',
	`cust_email2` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_fb2` TINYINT(1) NULL DEFAULT '0',
	`cust_tweeter2` TINYINT(1) NULL DEFAULT '0',
	`cust_agama` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_pendidikan` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_profesi` ENUM('Pelajar / Mahasiswa','Ibu Rumah Tangga','Karyawan / Swasta','Wiraswasta','Profesional','Selebritis','Lain-lain') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_tmptlahir` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_tgllahir` DATE NULL DEFAULT NULL,
	`cust_umur` DOUBLE(17,0) NULL DEFAULT NULL,
	`cust_hobi` ENUM('Membaca','Olahraga','Memasak','Travelling','Fotografi','Melukis','Menari','Lain-lain') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_referensi` INT(250) NULL DEFAULT NULL,
	`cust_referensilain` ENUM('Lewat','Billboard','Keluarga','Teman','Dokter klinik','Miracle cabang lain','Staff','Event','Koran','Brosur','Majalah','Senam','Radio','Lain-lain') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_keterangan` VARCHAR(500) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_terdaftar` DATE NULL DEFAULT NULL,
	`cust_statusnikah` ENUM('menikah','belum menikah') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_jmlanak` INT(11) NULL DEFAULT NULL,
	`cust_unit` INT(11) NULL DEFAULT NULL,
	`cust_cp` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_cptelp` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_aktif` ENUM('Aktif','Tidak Aktif') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_fretfulness` ENUM('High','Medium','Low','Undefined') NULL DEFAULT 'Medium' COLLATE 'latin1_swedish_ci',
	`cust_point` SMALLINT(6) NOT NULL DEFAULT '0',
	`cust_creator` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_date_create` DATETIME NULL DEFAULT NULL,
	`cust_update` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_date_update` DATETIME NULL DEFAULT NULL,
	`cust_revised` INT(11) NOT NULL DEFAULT '0',
	`cust_nama_ref` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cabang_nama` VARCHAR(250) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cabang_alamat` VARCHAR(250) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_crm_value` INT(11) NULL DEFAULT '0' COMMENT 'field ini adalah merujuk ke crm_value.crm_value_id',
	`crmvalue_date` DATETIME NULL DEFAULT NULL,
	`crmvalue_total` DECIMAL(3,1) NULL DEFAULT NULL,
	`cust_priority` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_bb` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cust_tglawaltrans` DATE NULL DEFAULT NULL
) ENGINE=MyISAM;

