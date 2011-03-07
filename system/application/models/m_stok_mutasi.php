<? 
/* 	
	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com,
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id

	+ Module  		: stok_mutasi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_stok_mutasi.php
 	+ creator 		:
 	+ Created on 09/Apr/2010 10:47:15
*/

class M_stok_mutasi extends Model{

		//constructor
		function M_stok_mutasi() {
			parent::Model();
		}

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

		function stok_mutasi_list($gudang, $produk_id, $group1_id, $opsi_produk, $opsi_satuan, $tanggal_start, $tanggal_end, $filter,
								  $start,$end,$opsi,$mutasi_jumlah){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";

			if($opsi_produk=='group1' & $group1_id!=="" & $group1_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_group='".$group1_id."' ";
			}elseif($opsi_produk=='produk' & $produk_id!=="" & $produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($mutasi_jumlah=='<'){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_group='".$group1_id."' ";
			}elseif($mutasi_jumlah=='produk'){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}

			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			$sql.=" GROUP BY produk_kode ASC";

//			$this->firephp->log($sql);
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();

			if($produk_id=="" && $opsi<>"print" ){
				$end = ($end==""?15:$end);
				$sql = $sql." LIMIT ".$start.",".$end;
			}
			
			//$this->firephp->log($sql);
			
			$result = $this->db->query($sql);
			$i=0;

			foreach($result->result() as $rowproduk){
				$data[$i]["produk_id"]=$rowproduk->produk_id;
				$data[$i]["produk_kode"]=$rowproduk->produk_kode;
				$data[$i]["produk_nama"]=$rowproduk->produk_nama;
				$data[$i]["satuan_id"]=$rowproduk->satuan_id;
				$data[$i]["satuan_kode"]=$rowproduk->satuan_kode;
				$data[$i]["satuan_nama"]=$rowproduk->satuan_nama;
				$data[$i]["jumlah_masuk"]=0;
				$data[$i]["jumlah_keluar"]=0;
				$data[$i]["jumlah_koreksi"]=0;
				$data[$i]["jumlah_stok"]=0;
			
			//STOK AWAL
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
				
				//$sql_stok_awal="";
				//$this->firephp->log($sql_stok_awal);
				
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					$data[$i]["jumlah_awal"]=$ds_stokawal->jumlah_awal;
				}else{
					$data[$i]["jumlah_awal"]=0;
				}
				
				$sqlawal="SELECT 	produk_saldo_awal*konversi_nilai as jumlah
					FROM 	produk, satuan_konversi
					WHERE 	konversi_produk=produk_id
					AND 	konversi_default=true
					AND		produk_id='".$produk_id."'
					AND 	'".$gudang."'='1'";
				$rsawal=$this->db->query($sqlawal);
				if($rsawal->num_rows()){
					$row=$rsawal->row();
					$data[$i]["jumlah_awal"]+=$row->jumlah;
				}
			
				//STOK MUTASI
				
				$sql_stok_mutasi="SELECT  
						sum(jml_terima_barang*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_terima_bonus*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_mutasi_masuk*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_retur_produk*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_retur_paket*konversi_nilai/".$rowproduk->konversi_nilai.") as jumlah_masuk,
						sum(jml_koreksi_stok*konversi_nilai/".$rowproduk->konversi_nilai.") as jumlah_koreksi,
						sum(jml_retur_beli*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_mutasi_keluar*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_jual_produk*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_jual_grooming*konversi_nilai/".$rowproduk->konversi_nilai.")
						+sum(jml_pakai_cabin*konversi_nilai/".$rowproduk->konversi_nilai.") as jumlah_keluar
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
							AND date_format(terima_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(terima_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						   AND date_format(terima_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
						    AND date_format(terima_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(rbeli_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							 AND date_format(rbeli_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(mutasi_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(mutasi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(mutasi_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(mutasi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(koreksi_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							 AND date_format(koreksi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(jproduk_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(jproduk_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(jpgrooming_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(jpgrooming_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(rproduk_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(rproduk_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
						    AND date_format(rpaket_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(rpaket_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
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
							AND date_format(cabin_date_create,'%Y-%m-%d')>='".$tanggal_start."'
							AND date_format(cabin_date_create,'%Y-%m-%d')<='".$tanggal_end."'
							AND cabin_produk='".$rowproduk->produk_id."'
							AND cabin_gudang='".$gudang."'
							) as mutasi
					GROUP BY mutasi.produk
					ORDER BY mutasi.produk";
						
				
				$rs_mutasi=$this->db->query($sql_stok_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=round($ds_mutasi->jumlah_masuk,3);
						$data[$i]["jumlah_keluar"]=round($ds_mutasi->jumlah_keluar,3);
						$data[$i]["jumlah_koreksi"]=round($ds_mutasi->jumlah_koreksi,3);
						if($data[$i]["jumlah_koreksi"]<0)
							$data[$i]["jumlah_keluar"]=round($data[$i]["jumlah_keluar"]+abs($data[$i]["jumlah_koreksi"]),3);
						else
							$data[$i]["jumlah_masuk"]=round($data[$i]["jumlah_masuk"]+abs($data[$i]["jumlah_koreksi"]),3);

						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]),3);

					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]),3);
					}
				$i++;
			}


			
			if($opsi<>"print"){
				if($nbrows>0){
	
					$jsonresult = json_encode($data);
					return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
				} else {
					return '({"total":"0", "results":""})';
				}
			}else{
				if($nbrows>0){
					return $data;
				} else {
					return 0;
				}
			}

		}


}
?>