<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: kartu_stok Model
	+ Description	: For record model process back-end
	+ Filename 		: c_kartu_stok.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
*/

class M_kartu_stok extends Model{
		
		//constructor
		function M_kartu_stok() {
			parent::Model();
		}
		
		var $stok_awal=0;
		var $stok_masuk=0;
		var $stok_keluar=0;
		var $stok_koreksi=0;
		var $stok_akhir=0;
		
		function get_produk_list($filter,$start,$end){
			$sql="select * from vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			if($filter<>""){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="( produk_kode LIKE '%".addslashes($filter)."%' OR 
						 produk_nama LIKE '%".addslashes($filter)."%' OR 
						 satuan_kode LIKE '%".addslashes($filter)."%' OR 
						 satuan_nama LIKE '%".addslashes($filter)."%')";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$limit = $sql." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);   
			
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		function kartu_stok_awal($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end,$filter,$start,$end){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			
			$this->stok_awal=0;
			
			if($produk_id!==""&&$produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			$sql.=" LIMIT 1";
			
			$data[0]["stok_awal"]=0;
			//Stok Awal
			$sqlawal="SELECT 	produk_saldo_awal*konversi_nilai as jumlah
					FROM 	produk, satuan_konversi
					WHERE 	konversi_produk=produk_id
					AND 	konversi_default=true
					AND		produk_id='".$produk_id."'";
			$rsawal=$this->db->query($sqlawal);
			if($rsawal->num_rows()){
				$row=$rsawal->row();
				$data[0]["stok_awal"]=$row->jumlah;
			}
			
							
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();
			//$this->firephp->log('sql : '.$sql);
			//echo $sql;
			
			
			if($nbrows>0){
				$row=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$row->konversi_nilai;
				
				$i=0;
				
				$sql_stok_awal="SELECT 	sum(jml_terima_barang*".$row->konversi_nilai.")
										+sum(jml_terima_bonus*".$row->konversi_nilai.")
										-sum(jml_retur_beli*".$row->konversi_nilai.")
										-sum(jml_mutasi_keluar*".$row->konversi_nilai.")
										+sum(jml_mutasi_masuk*".$row->konversi_nilai.")
										+sum(jml_koreksi_stok*".$row->konversi_nilai.")
										-sum(jml_jual_produk*".$row->konversi_nilai.")
										-sum(jml_jual_grooming*".$row->konversi_nilai.")
										+sum(jml_retur_produk*".$row->konversi_nilai.")
										+sum(jml_retur_paket*".$row->konversi_nilai.")
										-sum(jml_pakai_cabin*".$row->konversi_nilai.")
										as jumlah_awal
								FROM	vu_stok_new
								WHERE   date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
										AND produk='".$row->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk LIMIT 1";
				$this->firephp->log('sql : '.$sql_stok_awal);
				//echo $sql_stok_awal;
				
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					$data[0]["stok_awal"]+=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$konversi,3);
				}
			}
			
			
			$jsonresult = json_encode($data);
			return '({"total":"1","results":'.$jsonresult.'})';
						
		}
		
		function kartu_stok_awal_print($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end,$option,$filter){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			
			$this->stok_awal=0;
			
			if($produk_id!==""&&$produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			$sql.=" LIMIT 1";
			
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();

			$data[0]["stok_awal"]=0;
			//Stok Awal
			$sqlawal="SELECT 	produk_saldo_awal*konversi_nilai as jumlah
					FROM 	produk, satuan_konversi
					WHERE 	konversi_produk=produk_id
					AND 	konversi_default=true
					AND		produk_id='".$produk_id."'";
			$rsawal=$this->db->query($sqlawal);
			if($rsawal->num_rows()){
				$row=$rsawal->row();
				$data[0]["stok_awal"]=$row->jumlah;
			}
			
			if($nbrows>0){
				$row=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$row->konversi_nilai;
				
				$i=0;
				
				/*$sql_stok_awal="SELECT 	sum(jml_terima_barang*".$row->konversi_nilai.")
										+sum(jml_terima_bonus*".$row->konversi_nilai.")
										-sum(jml_retur_beli*".$row->konversi_nilai.")
										-sum(jml_mutasi_keluar*".$row->konversi_nilai.")
										+sum(jml_mutasi_masuk*".$row->konversi_nilai.")
										+sum(jml_koreksi_stok*".$row->konversi_nilai.")
										-sum(jml_jual_produk*".$row->konversi_nilai.")
										-sum(jml_jual_grooming*".$row->konversi_nilai.")
										+sum(jml_retur_produk*".$row->konversi_nilai.")
										+sum(jml_retur_paket*".$row->konversi_nilai.")
										-sum(jml_pakai_cabin*".$row->konversi_nilai.")
										as jumlah_awal
								FROM	vu_stok_new
								WHERE   date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
										AND produk='".$row->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk LIMIT 1";*/
				$sql_stok_awal="SELECT ifnull( 
						 sum(jml_terima_barang*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_terima_bonus*konversi_nilai/".$rowproduk->konversi_nilai.")
						-sum(jml_retur_beli*konversi_nilai/".$rowproduk->konversi_nilai.")
						-sum(jml_mutasi_keluar*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_mutasi_masuk*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_koreksi_stok*konversi_nilai/".$rowproduk->konversi_nilai.")
						-sum(jml_jual_produk*konversi_nilai/".$rowproduk->konversi_nilai.")
						-sum(jml_jual_grooming*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_retur_produk*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_retur_paket*konversi_nilai/".$rowproduk->konversi_nilai.")
						-sum(jml_pakai_cabin*konversi_nilai/".$rowproduk->konversi_nilai."),0)
						AS jumlah_awal
						FROM (SELECT `mt`.`terima_tanggal` AS `tanggal`,
						   `mt`.`terima_supplier` AS `asal`,
						   1 AS `tujuan`,
						   1 AS `gudang`,
						   `mt`.`terima_no` AS `no_bukti`,
						   _UTF8 'PB' AS `jenis_transaksi`,
						   `mt`.`terima_status` AS `status`,
						   `dt`.`dterima_produk` AS `produk`,
						   `dt`.`dterima_satuan` AS `satuan`,
						   konversi_nilai,
						   `dt`.`dterima_jumlah` AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'beli' AS `keterangan`,
						   `dt`.`dterima_id` AS `detail_id`
					  FROM `detail_terima_beli` `dt`, `master_terima_beli` `mt`, satuan_konversi
					 WHERE     `dt`.`dterima_master` = `mt`.`terima_id`
							AND konversi_satuan = dt.dterima_satuan
							AND konversi_produk = dt.dterima_produk
							AND date_format(terima_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dterima_produk='".$rowproduk->produk_id."'
							AND 1='".$gudang."'
							AND terima_status<>'Batal' 
							
					UNION
					SELECT `mt`.`terima_tanggal` AS `tanggal`,
						   `mt`.`terima_supplier` AS `asal`,
						   1 AS `tujuan`,
						   1 AS `gudang`,
						   `mt`.`terima_no` AS `no_bukti`,
						   _UTF8 'PB' AS `jenis_transaksi`,
						   `mt`.`terima_status` AS `status`,
						   `db`.`dtbonus_produk` AS `produk`,
						   `db`.`dtbonus_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   `db`.`dtbonus_jumlah` AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'bonus' AS `keterangan`,
						   `db`.`dtbonus_id` AS `detail_id`
					  FROM `detail_terima_bonus` `db`, `master_terima_beli` `mt`, satuan_konversi
					 WHERE     `db`.`dtbonus_master` = `mt`.`terima_id`
						   AND konversi_satuan = db.dtbonus_satuan
						   AND konversi_produk = db.dtbonus_produk
						   AND date_format(terima_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dtbonus_produk='".$rowproduk->produk_id."'
							AND 1='".$gudang."'
							AND terima_status<>'Batal'
					UNION
					SELECT `mr`.`rbeli_tanggal` AS `tanggal`,
						   `mr`.`rbeli_supplier` AS `asal`,
						   1 AS `tujuan`,
						   1 AS `gudang`,
						   `mr`.`rbeli_nobukti` AS `no_bukti`,
						   _UTF8 'RB' AS `jenis_transaksi`,
						   `mr`.`rbeli_status` AS `status`,
						   `dr`.`drbeli_produk` AS `produk`,
						   `dr`.`drbeli_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   `dr`.`drbeli_jumlah` AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'retur' AS `keterangan`,
						   `dr`.`drbeli_id` AS `detail_id`
					  FROM `detail_retur_beli` `dr`, `master_retur_beli` `mr`, satuan_konversi
					 WHERE     `dr`.`drbeli_master` = `mr`.`rbeli_id`
						   AND konversi_satuan = dr.drbeli_satuan
						   AND konversi_produk = dr.drbeli_produk
						    AND date_format(rbeli_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND drbeli_produk='".$rowproduk->produk_id."'
							AND 1='".$gudang."'
							AND rbeli_status<>'Batal'
					UNION
					SELECT `mmm`.`mutasi_tanggal` AS `tanggal`,
						   `mmm`.`mutasi_asal` AS `asal`,
						   `mmm`.`mutasi_tujuan` AS `tujuan`,
						   `mmm`.`mutasi_tujuan` AS `gudang`,
						   `mmm`.`mutasi_no` AS `no_bukti`,
						   _UTF8 'mutasi' AS `jenis_transaksi`,
						   `mmm`.`mutasi_status` AS `status`,
						   `dmm`.`dmutasi_produk` AS `produk`,
						   `dmm`.`dmutasi_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   `dmm`.`dmutasi_jumlah` AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'mutasi masuk' AS `keterangan`,
						   `dmm`.`dmutasi_id` AS `detail_id`
					  FROM `master_mutasi` `mmm`, `detail_mutasi` `dmm`, satuan_konversi
					 WHERE     `dmm`.`dmutasi_master` = `mmm`.`mutasi_id`
						   AND konversi_satuan = dmm.dmutasi_satuan
						   AND konversi_produk = dmm.dmutasi_produk
						    AND date_format(mutasi_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dmutasi_produk='".$rowproduk->produk_id."'
							AND mutasi_tujuan='".$gudang."'
							AND mutasi_status<>'Batal'
					UNION
					SELECT `mmk`.`mutasi_tanggal` AS `tanggal`,
						   `mmk`.`mutasi_asal` AS `asal`,
						   `mmk`.`mutasi_tujuan` AS `tujuan`,
						   `mmk`.`mutasi_asal` AS `gudang`,
						   `mmk`.`mutasi_no` AS `no_bukti`,
						   _UTF8 'mutasi' AS `jenis_transaksi`,
						   `mmk`.`mutasi_status` AS `status`,
						   `dmk`.`dmutasi_produk` AS `produk`,
						   `dmk`.`dmutasi_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   `dmk`.`dmutasi_jumlah` AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'mutasi keluar' AS `keterangan`,
						   `dmk`.`dmutasi_id` AS `detail_id`
					  FROM `master_mutasi` `mmk`, `detail_mutasi` `dmk`, satuan_konversi
					 WHERE     `dmk`.`dmutasi_master` = `mmk`.`mutasi_id`
						   AND konversi_satuan = dmk.dmutasi_satuan
						   AND konversi_produk = dmk.dmutasi_produk
						    AND date_format(mutasi_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dmutasi_produk='".$rowproduk->produk_id."'
							AND mutasi_asal='".$gudang."'
							AND mutasi_status<>'Batal'
					UNION
					SELECT `mk`.`koreksi_tanggal` AS `tanggal`,
						   `mk`.`koreksi_gudang` AS `asal`,
						   `mk`.`koreksi_gudang` AS `tujuan`,
						   `mk`.`koreksi_gudang` AS `gudang`,
						   `mk`.`koreksi_no` AS `no_bukti`,
						   _UTF8 'koreksi' AS `jenis_transaksi`,
						   `mk`.`koreksi_status` AS `status`,
						   `dk`.`dkoreksi_produk` AS `produk`,
						   `dk`.`dkoreksi_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   `dk`.`dkoreksi_jmlkoreksi` AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'koreksi' AS `keterangan`,
						   `dk`.`dkoreksi_id` AS `detail_id`
					  FROM `master_koreksi_stok` `mk`,
						   `detail_koreksi_stok` `dk`,
						   satuan_konversi
					 WHERE     `mk`.`koreksi_id` = `dk`.`dkoreksi_master`
						   AND konversi_satuan = dk.dkoreksi_satuan
						   AND konversi_produk = dk.dkoreksi_produk
						    AND date_format(koreksi_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dkoreksi_produk='".$rowproduk->produk_id."'
							AND koreksi_gudang='".$gudang."'
							AND koreksi_status<>'Batal'
					UNION
					SELECT `mj`.`jproduk_tanggal` AS `tanggal`,
						   2 AS `asal`,
						   `mj`.`jproduk_cust` AS `tujuan`,
						   2 AS `gudang`,
						   `mj`.`jproduk_nobukti` AS `no_bukti`,
						   _UTF8 'jual produk' AS `jenis_traksaksi`,
						   `mj`.`jproduk_stat_dok` AS `status`,
						   `dj`.`dproduk_produk` AS `produk`,
						   `dj`.`dproduk_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   `dj`.`dproduk_jumlah` AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'customer' AS `keterangan`,
						   `dj`.`dproduk_id` AS `detail_id`
					  FROM `master_jual_produk` `mj`, `detail_jual_produk` `dj`, satuan_konversi
					 WHERE     `dj`.`dproduk_master` = `mj`.`jproduk_id`
						   AND konversi_satuan = dj.dproduk_satuan
						   AND konversi_produk = dj.dproduk_produk
						    AND date_format(jproduk_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dproduk_produk='".$rowproduk->produk_id."'
							AND 2='".$gudang."'
							AND jproduk_stat_dok<>'Batal'
							
					UNION
					SELECT `mjg`.`jpgrooming_tanggal` AS `tanggal`,
						   2 AS `asal`,
						   `mjg`.`jpgrooming_karyawan` AS `tujuan`,
						   2 AS `gudang`,
						   `mjg`.`jpgrooming_nobukti` AS `no_bukti`,
						   _UTF8 'jual produk' AS `jenis_transaksi`,
						   _UTF8 'Tertutup' AS `status`,
						   `djg`.`dpgrooming_produk` AS `produk`,
						   `djg`.`dpgrooming_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   `djg`.`dpgrooming_jumlah` AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'grooming' AS `keterangan`,
						   `djg`.`dpgrooming_id` AS `detail_id`
					  FROM `master_jualproduk_grooming` `mjg`,
						   `detail_jualproduk_grooming` `djg`,
						   satuan_konversi
					 WHERE     `mjg`.`jpgrooming_id` = `djg`.`dpgrooming_master`
						   AND konversi_satuan = djg.dpgrooming_satuan
						   AND konversi_produk = djg.dpgrooming_produk
						    AND date_format(jpgrooming_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND dpgrooming_produk='".$rowproduk->produk_id."'
							AND 2='".$gudang."'
					UNION
					SELECT `mrj`.`rproduk_tanggal` AS `tanggal`,
						   `mrj`.`rproduk_cust` AS `asal`,
						   2 AS `tujuan`,
						   2 AS `gudang`,
						   `mrj`.`rproduk_nobukti` AS `no_bukti`,
						   _UTF8 'retur jual' AS `jenis_transaksi`,
						   `mrj`.`rproduk_stat_dok` AS `status`,
						   `drj`.`drproduk_produk` AS `produk`,
						   `drj`.`drproduk_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   `drj`.`drproduk_jumlah` AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'produk retur' AS `keterangan`,
						   `drj`.`drproduk_id` AS `detail_id`
					  FROM `master_retur_jual_produk` `mrj`,
						   `detail_retur_jual_produk` `drj`,
						   satuan_konversi
					 WHERE     `mrj`.`rproduk_id` = `drj`.`drproduk_master`
						   AND konversi_satuan = drj.drproduk_satuan
						   AND konversi_produk = drj.drproduk_produk
						    AND date_format(rproduk_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND drproduk_produk='".$rowproduk->produk_id."'
							AND 2='".$gudang."'
							AND rproduk_stat_dok<>'Batal'
					UNION
					SELECT `mrp`.`rpaket_tanggal` AS `tanggal`,
						   `mrp`.`rpaket_cust` AS `asal`,
						   2 AS `tujuan`,
						   2 AS `gudang`,
						   `mrp`.`rpaket_nobukti` AS `no_bukti`,
						   _UTF8 'retur jual' AS `jenis_transaksi`,
						   `mrp`.`rpaket_stat_dok` AS `status`,
						   `drp`.`drpaket_produk` AS `produk`,
						   `drp`.`drpaket_satuan` AS `satuan`,
						   konversi_nilai,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   `drp`.`drpaket_jumlah` AS `jml_retur_paket`,
						   0 AS `jml_pakai_cabin`,
						   _UTF8 'paket retur' AS `keterangan`,
						   `drp`.`drpaket_id` AS `detail_id`
					  FROM `master_retur_jual_paket` `mrp`,
						   `detail_retur_paket_produk` `drp`,
						   satuan_konversi
					 WHERE     `mrp`.`rpaket_id` = `drp`.`drpaket_master`
						   AND konversi_satuan = drpaket_satuan
						   AND konversi_produk = drpaket_produk
						    AND date_format(rpaket_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							AND drpaket_produk='".$rowproduk->produk_id."'
							AND 2='".$gudang."'
							AND rpaket_stat_dok<>'Batal'
							
					UNION
					SELECT `cb`.`cabin_date_create` AS `tanggal`,
						   `cb`.`cabin_gudang` AS `asal`,
						   `cb`.`cabin_cust` AS `tujuan`,
						   `cb`.`cabin_gudang` AS `gudang`,
						   `cb`.`cabin_bukti` AS `no_bukti`,
						   _UTF8 'pakai cabin' AS `jenis_transaksi`,
						   _UTF8 'Tertutup' AS `status`,
						   `cb`.`cabin_produk` AS `produk`,
						   `cb`.`cabin_satuan` AS `satuan`,
						   konversi_satuan,
						   0 AS `jml_terima_barang`,
						   0 AS `jml_terima_bonus`,
						   0 AS `jml_retur_beli`,
						   0 AS `jml_mutasi_masuk`,
						   0 AS `jml_mutasi_keluar`,
						   0 AS `jml_koreksi_stok`,
						   0 AS `jml_jual_produk`,
						   0 AS `jml_jual_grooming`,
						   0 AS `jml_retur_produk`,
						   0 AS `jml_retur_paket`,
						   `cb`.`cabin_jumlah` AS `jml_pakai_cabin`,
						   _UTF8 'pakai cabin' AS `keterangan`,
						   `cb`.`cabin_dtrawat` AS `detail_id`
					  FROM `detail_pakai_cabin` `cb`, satuan_konversi
					 WHERE konversi_produk = cabin_produk 
					 		AND konversi_satuan = cabin_satuan
							AND date_format(cabin_date_create,'%Y-%m-%d')<'".$tanggal_start."'
							AND cabin_produk='".$rowproduk->produk_id."'
							AND cabin_gudang='".$gudang."'
							) as mutasi
					GROUP BY mutasi.produk
					ORDER BY mutasi.produk";
				//$this->firephp->log('sql : '.$sql_stok_awal);
				//echo $sql_stok_awal;
				
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					$data[0]["stok_awal"]+=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$konversi,3);
				}
			}
			
			return $data;
					
		}
		
		/*function generate_kartu_stok($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end){
			
			/* CEK SATUAN */
			/*if($opsi_satuan=='terkecil')
			{
				$sql="SELECT konversi_satuan FROM satuan_konversi 
						WHERE konversi_nilai=1
						AND konversi_produk='".$produk_id."'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$row=$rs->row();
					$current_satuan=$row->konversi_satuan;
					$current_konversi=1;
				}else{
					return 0;
					exit();
				}
				
			}else{
				
				$sql="SELECT konversi_satuan, konversi_nilai FROM satuan_konversi 
						WHERE konversi_default=true
						AND konversi_produk='".$produk_id."'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$row=$rs->row();
					$current_satuan=$row->konversi_satuan;
					$current_konversi=$row->konversi_nilai;
				}else{
					return 0;
					exit();
				}
				
			}
			
			/* GUDANG CABIN, 
				- Masuk = Terima Barang + Mutasi Masuk + Penyesuian tambah
				- Keluar = Retur Barang + Mutasi Keluar + Penyesuaian kurang
			*/
			/*if($gudang=='1'){
				//Terima Barang
				$sql="";
				
			}else{
			
			}
			
						
		}*/
		
		
		function kartu_stok_list($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end,$filter,$start,$end){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			

			if($produk_id!==""&&$produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			$sql.=" LIMIT 1";
			
			$i=0;
			
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();
			if($result->num_rows()){
				$rowproduk=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$rowproduk->konversi_nilai;
				
			
				//Pembelian -> Masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Beli dari ', supplier_nama) as keterangan, 
								jml_terima_barang*konversi_nilai+jml_terima_bonus*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,supplier
						WHERE   date_format(tanggal,'%Y-%m-%d')>=date_format('".$tanggal_start."','%Y-%m-%d')
								AND date_format(tanggal,'%Y-%m-%d')<=date_format('".$tanggal_end."','%Y-%m-%d')
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND supplier_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='PB'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowbeli){
					$data[$i]['tanggal']=$rowbeli->tanggal;
					$data[$i]['no_bukti']=$rowbeli->no_bukti;
					$data[$i]['keterangan']=$rowbeli->keterangan;
					$data[$i]['masuk']=$rowbeli->masuk*$konversi;
					$data[$i]['keluar']=$rowbeli->keluar*$konversi;
					$data[$i]['koreksi']=$rowbeli->koreksi*$konversi;					
					$i++;
				}
				
				//Retur Beli ->keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Beli dari ', supplier_nama) as keterangan, 
								0 as masuk,
								jml_retur_beli*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,supplier
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND supplier_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='RB'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrbeli){
					$data[$i]['tanggal']=$rowrbeli->tanggal;
					$data[$i]['no_bukti']=$rowrbeli->no_bukti;
					$data[$i]['keterangan']=$rowrbeli->keterangan;
					$data[$i]['masuk']=$rowrbeli->masuk*$konversi;
					$data[$i]['keluar']=$rowrbeli->keluar*$konversi;
					$data[$i]['koreksi']=$rowrbeli->koreksi*$konversi;					
					$i++;
				}
				
				//Mutasi Keluar ->keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Mutasi ke gudang ', gudang_nama) as keterangan, 
								0 as masuk,
								jml_mutasi_keluar*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,gudang
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND gudang_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='mutasi'
								AND keterangan='mutasi keluar'";
				
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowkmutasi){
					$data[$i]['tanggal']=$rowkmutasi->tanggal;
					$data[$i]['no_bukti']=$rowkmutasi->no_bukti;
					$data[$i]['keterangan']=$rowkmutasi->keterangan;
					$data[$i]['masuk']=$rowkmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowkmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowkmutasi->koreksi*$konversi;					
					$i++;
				}
				
				
				//Mutasi Masuk ->masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Mutasi dari gudang ', gudang_nama) as keterangan, 
								jml_mutasi_masuk*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,gudang
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND gudang_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='mutasi'
								AND keterangan='mutasi masuk'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowmmutasi){
					$data[$i]['tanggal']=$rowmmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmmutasi->keterangan;
					$data[$i]['masuk']=$rowmmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowmmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowmmutasi->koreksi*$konversi;					
					$i++;
				}
				
				//Koreksi ->koreksi
				$sql="SELECT 	tanggal,
								no_bukti, 
								'Koreksi stok' as keterangan, 
								0 as masuk,
								0 as keluar,
								jml_koreksi_stok*konversi_nilai as koreksi
						FROM	vu_stok_new_produk
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND status<>'Batal'
								AND jenis_transaksi='koreksi'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowmmutasi){
					$data[$i]['tanggal']=$rowmmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmmutasi->keterangan;
					
					$data[$i]['masuk']=$rowmmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowmmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowmmutasi->koreksi*$konversi;	
					if($rowmmutasi->koreksi>0)
						$data[$i]['masuk']=	abs($rowmmutasi->koreksi)*$konversi;
					else
						$data[$i]['keluar']=abs($rowmmutasi->koreksi)*$konversi;
					$i++;
				}
				
				//Penjualan produk -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Jual Produk oleh ', cust_nama) as keterangan, 
								0 as masuk,
								jml_jual_produk*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='jual produk'
								AND keterangan='customer'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowpjual){
					$data[$i]['tanggal']=$rowpjual->tanggal;
					$data[$i]['no_bukti']=$rowpjual->no_bukti;
					$data[$i]['keterangan']=$rowpjual->keterangan;
					$data[$i]['masuk']=$rowpjual->masuk*$konversi;
					$data[$i]['keluar']=$rowpjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowpjual->koreksi*$konversi;					
					$i++;
				}
				
				//Penjualan grooming -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Jual Grooming oleh ', karyawan_nama) as keterangan, 
								0 as masuk,
								jml_jual_grooming*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,karyawan
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND karyawan_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='jual produk'
								AND keterangan='grooming'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowgjual){
					$data[$i]['tanggal']=$rowgjual->tanggal;
					$data[$i]['no_bukti']=$rowgjual->no_bukti;
					$data[$i]['keterangan']=$rowgjual->keterangan;
					$data[$i]['masuk']=$rowgjual->masuk*$konversi;
					$data[$i]['keluar']=$rowgjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowgjual->koreksi*$konversi;					
					$i++;
				}
				
				
				//Retur Penjualan Produk -> masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk oleh ', cust_nama) as keterangan, 
								jml_retur_produk*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='retur jual'
								AND keterangan='produk retur'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrjual){
					$data[$i]['tanggal']=$rowrjual->tanggal;
					$data[$i]['no_bukti']=$rowrjual->no_bukti;
					$data[$i]['keterangan']=$rowrjual->keterangan;
					$data[$i]['masuk']=$rowrjual->masuk*$konversi;
					$data[$i]['keluar']=$rowrjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowrjual->koreksi*$konversi;					
					$i++;
				}
				
				//Retur Penjualan Paket -> masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk (Paket) oleh ', cust_nama) as keterangan, 
								jml_retur_paket*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='retur paket'
								AND keterangan='paket retur'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrjual){
					$data[$i]['tanggal']=$rowrjual->tanggal;
					$data[$i]['no_bukti']=$rowrjual->no_bukti;
					$data[$i]['keterangan']=$rowrjual->keterangan;
					$data[$i]['masuk']=$rowrjual->masuk*$konversi;
					$data[$i]['keluar']=$rowrjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowrjual->koreksi*$konversi;					
					$i++;
				}
				
				//Pakai cabin -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Pakai u/ Perawatan oleh ', cust_nama) as keterangan, 
								0 as masuk,
								jml_pakai_cabin*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='pakai cabin'";
				$this->firephp->log($sql);
				
				$result=$this->db->query($sql);
				foreach($result->result() as $rowcabin){
					$data[$i]['tanggal']=$rowcabin->tanggal;
					$data[$i]['no_bukti']=$rowcabin->no_bukti;
					$data[$i]['keterangan']=$rowcabin->keterangan;
					$data[$i]['masuk']=$rowcabin->masuk*$konversi;
					$data[$i]['keluar']=$rowcabin->keluar*$konversi;
					$data[$i]['koreksi']=$rowcabin->koreksi*$konversi;					
					$i++;
				}
				
			} 
			
			if($nbrows>0 && $i>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		
		
		//function for print record
		function kartu_stok_print($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end ,$option,$filter){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			

			if($produk_id!==""&&$produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			$sql.=" LIMIT 1";
			
			$i=0;
			
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();
			if($result->num_rows()){
				$rowproduk=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$rowproduk->konversi_nilai;
				
								
				//Pembelian -> Masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Beli dari ', supplier_nama) as keterangan, 
								jml_terima_barang*konversi_nilai+jml_terima_bonus*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,supplier
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND supplier_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='PB'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowbeli){
					$data[$i]['tanggal']=$rowbeli->tanggal;
					$data[$i]['no_bukti']=$rowbeli->no_bukti;
					$data[$i]['keterangan']=$rowbeli->keterangan;
					$data[$i]['masuk']=$rowbeli->masuk*$konversi;
					$data[$i]['keluar']=$rowbeli->keluar*$konversi;
					$data[$i]['koreksi']=$rowbeli->koreksi*$konversi;					
					$i++;
				}
				
				//Retur Beli ->keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Beli dari ', supplier_nama) as keterangan, 
								0 as masuk,
								jml_retur_beli*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,supplier
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND supplier_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='RB'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrbeli){
					$data[$i]['tanggal']=$rowrbeli->tanggal;
					$data[$i]['no_bukti']=$rowrbeli->no_bukti;
					$data[$i]['keterangan']=$rowrbeli->keterangan;
					$data[$i]['masuk']=$rowrbeli->masuk*$konversi;
					$data[$i]['keluar']=$rowrbeli->keluar*$konversi;
					$data[$i]['koreksi']=$rowrbeli->koreksi*$konversi;					
					$i++;
				}
				
				//Mutasi Keluar ->keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Mutasi ke gudang ', gudang_nama) as keterangan, 
								0 as masuk,
								jml_mutasi_keluar*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,gudang
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND gudang_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='mutasi'
								AND keterangan='mutasi keluar'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowkmutasi){
					$data[$i]['tanggal']=$rowkmutasi->tanggal;
					$data[$i]['no_bukti']=$rowkmutasi->no_bukti;
					$data[$i]['keterangan']=$rowkmutasi->keterangan;
					$data[$i]['masuk']=$rowkmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowkmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowkmutasi->koreksi*$konversi;					
					$i++;
				}
				//$this->firephp->log($sql);
				
				//Mutasi Masuk ->masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Mutasi dari gudang ', gudang_nama) as keterangan, 
								jml_mutasi_masuk*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,gudang
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND gudang_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='mutasi'
								AND keterangan='mutasi masuk'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowmmutasi){
					$data[$i]['tanggal']=$rowmmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmmutasi->keterangan;
					$data[$i]['masuk']=$rowmmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowmmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowmmutasi->koreksi*$konversi;					
					$i++;
				}
				
				//Koreksi ->koreksi
				$sql="SELECT 	tanggal,
								no_bukti, 
								'Koreksi stok' as keterangan, 
								0 as masuk,
								0 as keluar,
								jml_koreksi_stok*konversi_nilai as koreksi
						FROM	vu_stok_new_produk
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND status<>'Batal'
								AND jenis_transaksi='koreksi'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowmmutasi){
					$data[$i]['tanggal']=$rowmmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmmutasi->keterangan;
					
					$data[$i]['masuk']=$rowmmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowmmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowmmutasi->koreksi*$konversi;	
					if($rowmmutasi->koreksi>0)
						$data[$i]['masuk']=	abs($rowmmutasi->koreksi)*$konversi;
					else
						$data[$i]['keluar']=abs($rowmmutasi->koreksi)*$konversi;
					$i++;
				}
				
				//Penjualan produk -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Jual Produk oleh ', cust_nama) as keterangan, 
								0 as masuk,
								jml_jual_produk*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='jual produk'
								AND keterangan='customer'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowpjual){
					$data[$i]['tanggal']=$rowpjual->tanggal;
					$data[$i]['no_bukti']=$rowpjual->no_bukti;
					$data[$i]['keterangan']=$rowpjual->keterangan;
					$data[$i]['masuk']=$rowpjual->masuk*$konversi;
					$data[$i]['keluar']=$rowpjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowpjual->koreksi*$konversi;					
					$i++;
				}
				
				//Penjualan grooming -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Jual Grooming oleh ', karyawan_nama) as keterangan, 
								0 as masuk,
								jml_jual_grooming*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,karyawan
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND karyawan_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='jual produk'
								AND keterangan='grooming'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowgjual){
					$data[$i]['tanggal']=$rowgjual->tanggal;
					$data[$i]['no_bukti']=$rowgjual->no_bukti;
					$data[$i]['keterangan']=$rowgjual->keterangan;
					$data[$i]['masuk']=$rowgjual->masuk*$konversi;
					$data[$i]['keluar']=$rowgjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowgjual->koreksi*$konversi;					
					$i++;
				}
				
				
				//Retur Penjualan Produk -> masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk oleh ', cust_nama) as keterangan, 
								jml_retur_produk*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='retur jual'
								AND keterangan='produk retur'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrjual){
					$data[$i]['tanggal']=$rowrjual->tanggal;
					$data[$i]['no_bukti']=$rowrjual->no_bukti;
					$data[$i]['keterangan']=$rowrjual->keterangan;
					$data[$i]['masuk']=$rowrjual->masuk*$konversi;
					$data[$i]['keluar']=$rowrjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowrjual->koreksi*$konversi;					
					$i++;
				}
				
				//Retur Penjualan Paket -> masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk (Paket) oleh ', cust_nama) as keterangan, 
								jml_retur_paket*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='retur paket'
								AND keterangan='paket retur'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrjual){
					$data[$i]['tanggal']=$rowrjual->tanggal;
					$data[$i]['no_bukti']=$rowrjual->no_bukti;
					$data[$i]['keterangan']=$rowrjual->keterangan;
					$data[$i]['masuk']=$rowrjual->masuk*$konversi;
					$data[$i]['keluar']=$rowrjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowrjual->koreksi*$konversi;					
					$i++;
				}
				
				//Pakai cabin -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Pakai u/ Perawatan oleh ', cust_nama) as keterangan, 
								0 as masuk,
								jml_pakai_cabin*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='pakai cabin'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowcabin){
					$data[$i]['tanggal']=$rowcabin->tanggal;
					$data[$i]['no_bukti']=$rowcabin->no_bukti;
					$data[$i]['keterangan']=$rowcabin->keterangan;
					$data[$i]['masuk']=$rowcabin->masuk*$konversi;
					$data[$i]['keluar']=$rowcabin->keluar*$konversi;
					$data[$i]['koreksi']=$rowcabin->koreksi*$konversi;					
					$i++;
				}
				
			} 
			
			if($nbrows>0 && $i>0){
				return $data;
			} else {
				return 0;
			}
		}
		
		//function  for export to excel
		function kartu_stok_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from kartu_stok";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR satuan_id LIKE '%".addslashes($filter)."%' OR satuan_nama LIKE '%".addslashes($filter)."%' OR stok_saldo LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($produk_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " produk_id LIKE '%".$produk_id."%'";
				};
				if($produk_nama!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " produk_nama LIKE '%".$produk_nama."%'";
				};
				if($satuan_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " satuan_id LIKE '%".$satuan_id."%'";
				};
				if($satuan_nama!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " satuan_nama LIKE '%".$satuan_nama."%'";
				};
				if($stok_saldo!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " stok_saldo LIKE '%".$stok_saldo."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>