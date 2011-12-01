/*TRIGGER utk keperluan insert pakai cabin, dimana gudang akan terisi sesuai dengan referal (departemen) yang diinputkan.. Hal ini utk mengatasi stok2an seperti ampul dan masker */

DELIMITER //
DROP trigger if exists detail_ambil_paket_upd;
CREATE TRIGGER `detail_ambil_paket_upd` AFTER UPDATE ON `detail_ambil_paket` FOR EACH ROW BEGIN 
/* ins cabin ambil paket */
/*Jika referalnya diinput kan Suster, maka cabin_gudang nya akan terinsert 4 (cabin Suster) */
IF old.dapaket_stat_dok = 'Terbuka' and new.dapaket_stat_dok = 'Tertutup' and EXISTS(select vu_karyawan.karyawan_departemen  from detail_ambil_paket
left join vu_karyawan on (vu_karyawan.karyawan_id = detail_ambil_paket.dapaket_referal)
WHERE detail_ambil_paket.dapaket_id = old.dapaket_id and vu_karyawan.karyawan_departemen = 9)
THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_dapaket_id, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_paket.jpaket_nobukti   ,detail_ambil_paket.dapaket_id   ,krawat_satuan   ,krawat_jumlah*detail_ambil_paket.dapaket_jumlah   ,4   ,master_jual_paket.jpaket_cust   FROM detail_ambil_paket   LEFT JOIN master_jual_paket on (master_jual_paket.jpaket_id= detail_ambil_paket.dapaket_jpaket)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_ambil_paket.dapaket_item)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE detail_ambil_paket.dapaket_id = old.dapaket_id AND produk_aktif='Aktif' ;  

/*Jika referalnya diinputkan Terapis, maka cabin gudangnya akan terinsert 3 (cabin terapis) */
ELSEIF old.dapaket_stat_dok = 'Terbuka' and new.dapaket_stat_dok = 'Tertutup' and EXISTS(select vu_karyawan.karyawan_departemen  from detail_ambil_paket
left join vu_karyawan on (vu_karyawan.karyawan_id = detail_ambil_paket.dapaket_referal)
WHERE detail_ambil_paket.dapaket_id = old.dapaket_id and vu_karyawan.karyawan_departemen = 10)
THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_dapaket_id, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_paket.jpaket_nobukti   ,detail_ambil_paket.dapaket_id   ,krawat_satuan   ,krawat_jumlah*detail_ambil_paket.dapaket_jumlah   ,3   ,master_jual_paket.jpaket_cust   FROM detail_ambil_paket   LEFT JOIN master_jual_paket on (master_jual_paket.jpaket_id= detail_ambil_paket.dapaket_jpaket)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_ambil_paket.dapaket_item)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE detail_ambil_paket.dapaket_id = old.dapaket_id AND produk_aktif='Aktif' ;  

/*Jika referalnya diinputkan selain suster/terapis, maka cabin gudangnya akan terinsert 2 (gudang retail) */
ELSEIF old.dapaket_stat_dok = 'Terbuka' and new.dapaket_stat_dok = 'Tertutup' and EXISTS(select vu_karyawan.karyawan_departemen  from detail_ambil_paket
left join vu_karyawan on (vu_karyawan.karyawan_id = detail_ambil_paket.dapaket_referal)
WHERE detail_ambil_paket.dapaket_id = old.dapaket_id and vu_karyawan.karyawan_departemen <> 9 and vu_karyawan.karyawan_departemen <> 10)
THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_dapaket_id, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_paket.jpaket_nobukti   ,detail_ambil_paket.dapaket_id   ,krawat_satuan   ,krawat_jumlah*detail_ambil_paket.dapaket_jumlah   ,2   ,master_jual_paket.jpaket_cust   FROM detail_ambil_paket   LEFT JOIN master_jual_paket on (master_jual_paket.jpaket_id= detail_ambil_paket.dapaket_jpaket)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_ambil_paket.dapaket_item)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE detail_ambil_paket.dapaket_id = old.dapaket_id AND produk_aktif='Aktif' ;  

/*Kondisi lain, jika faktur dibatalkan / diadjustment, maka akan menghapus pemakaian cabinnya*/
ELSEIF new.dapaket_stat_dok = 'Batal' or new.dapaket_stat_dok = 'Adj' THEN  delete from detail_pakai_cabin   WHERE cabin_dapaket_id = old.dapaket_id ;   END IF; 

/* update cust_tglawaltrans */

	update customer c
	set c.cust_tglawaltrans = new.dapaket_tgl_ambil
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.dapaket_tgl_ambil)
		and c.cust_id = new.dapaket_cust
		and new.dapaket_stat_dok = 'Tertutup';
END;



drop trigger if exists master_jual_rawat_upd;
CREATE TRIGGER `master_jual_rawat_upd` AFTER UPDATE ON `master_jual_rawat` FOR EACH ROW BEGIN  
/*INS CABIN RAWAT SATUAN*/
/*Jika referalnya diinput kan Suster, maka cabin_gudang nya akan terinsert 4 (cabin Suster) */
IF old.jrawat_stat_dok = 'Terbuka' and new.jrawat_stat_dok = 'Tertutup' 
	and (EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join vu_karyawan on (vu_karyawan.karyawan_id = detail_jual_rawat.drawat_sales)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen = 9)
			OR
			EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join tindakan_detail on (tindakan_detail.dtrawat_id = detail_jual_rawat.drawat_dtrawat)
			left join vu_karyawan on (vu_karyawan.karyawan_id = tindakan_detail.dtrawat_petugas1)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen = 9)
			OR
			EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join tindakan_detail on (tindakan_detail.dtrawat_id = detail_jual_rawat.drawat_dtrawat)
			left join vu_karyawan on (vu_karyawan.karyawan_id = tindakan_detail.dtrawat_petugas2)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen = 9)
			)
THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_rawat.jrawat_nobukti   ,krawat_satuan   ,krawat_jumlah*detail_jual_rawat.drawat_jumlah   ,4   ,master_jual_rawat.jrawat_cust   FROM detail_jual_rawat   LEFT JOIN master_jual_rawat on (master_jual_rawat.jrawat_id = detail_jual_rawat.drawat_master)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_jual_rawat.drawat_rawat)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE master_jual_rawat.jrawat_id = OLD.jrawat_id AND produk_aktif='Aktif' ;  

/*Jika referalnya diinput kan Terapis, maka cabin_gudang nya akan terinsert 3 (cabin Terapis) */
ELSEIF old.jrawat_stat_dok = 'Terbuka' and new.jrawat_stat_dok = 'Tertutup' 
	and (EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join vu_karyawan on (vu_karyawan.karyawan_id = detail_jual_rawat.drawat_sales)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen = 10)
			OR
			EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join tindakan_detail on (tindakan_detail.dtrawat_id = detail_jual_rawat.drawat_dtrawat)
			left join vu_karyawan on (vu_karyawan.karyawan_id = tindakan_detail.dtrawat_petugas1)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen = 10)
			OR
			EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join tindakan_detail on (tindakan_detail.dtrawat_id = detail_jual_rawat.drawat_dtrawat)
			left join vu_karyawan on (vu_karyawan.karyawan_id = tindakan_detail.dtrawat_petugas2)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen = 10)
			)
THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_rawat.jrawat_nobukti   ,krawat_satuan   ,krawat_jumlah*detail_jual_rawat.drawat_jumlah   ,3   ,master_jual_rawat.jrawat_cust   FROM detail_jual_rawat   LEFT JOIN master_jual_rawat on (master_jual_rawat.jrawat_id = detail_jual_rawat.drawat_master)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_jual_rawat.drawat_rawat)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE master_jual_rawat.jrawat_id = OLD.jrawat_id AND produk_aktif='Aktif' ;  

/*Jika referalnya diinput kan selain Suster/Terapis, maka cabin_gudang nya akan terinsert 2 (Gudang Retail) */
ELSEIF old.jrawat_stat_dok = 'Terbuka' and new.jrawat_stat_dok = 'Tertutup' 
	and (EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join vu_karyawan on (vu_karyawan.karyawan_id = detail_jual_rawat.drawat_sales)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen <> 10 and vu_karyawan.karyawan_departemen <> 9)
			OR
			EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join tindakan_detail on (tindakan_detail.dtrawat_id = detail_jual_rawat.drawat_dtrawat)
			left join vu_karyawan on (vu_karyawan.karyawan_id = tindakan_detail.dtrawat_petugas1)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen <> 10 and vu_karyawan.karyawan_departemen <> 9)
			OR
			EXISTS(select vu_karyawan.karyawan_departemen  from detail_jual_rawat 
			left join tindakan_detail on (tindakan_detail.dtrawat_id = detail_jual_rawat.drawat_dtrawat)
			left join vu_karyawan on (vu_karyawan.karyawan_id = tindakan_detail.dtrawat_petugas2)
			WHERE drawat_master = old.jrawat_id and vu_karyawan.karyawan_departemen <> 10 and vu_karyawan.karyawan_departemen <> 9)
			)
THEN  insert into detail_pakai_cabin (cabin_rawat, cabin_produk, cabin_bukti, cabin_satuan, cabin_jumlah, cabin_gudang, cabin_cust)  SELECT perawatan.rawat_id   ,krawat_produk   ,master_jual_rawat.jrawat_nobukti   ,krawat_satuan   ,krawat_jumlah*detail_jual_rawat.drawat_jumlah   ,2   ,master_jual_rawat.jrawat_cust   FROM detail_jual_rawat   LEFT JOIN master_jual_rawat on (master_jual_rawat.jrawat_id = detail_jual_rawat.drawat_master)   LEFT JOIN perawatan_konsumsi on (perawatan_konsumsi.krawat_master = detail_jual_rawat.drawat_rawat)   LEFT JOIN produk ON(krawat_produk=produk_id)   LEFT JOIN perawatan ON(krawat_master=rawat_id)     WHERE master_jual_rawat.jrawat_id = OLD.jrawat_id AND produk_aktif='Aktif' ;  

/*Jika status dokumennya dirubah batal / adjustment, maka akan menghapus dari tabel detail_pakai_cabin */
ELSEIF new.jrawat_stat_dok = 'Batal' THEN  delete from detail_pakai_cabin   WHERE cabin_bukti = old.jrawat_nobukti and cabin_cust = old.jrawat_cust    ;   END IF;  

/* update cust_tglawaltrans */
	update customer c
	set c.cust_tglawaltrans = new.jrawat_tanggal
	where 
		(c.cust_tglawaltrans is null or c.cust_tglawaltrans > new.jrawat_tanggal)
		and c.cust_id = new.jrawat_cust
		and new.jrawat_stat_dok = 'Tertutup';
END;



DELIMITER;