<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: resep dokter Model
	+ Description	: For record model process back-end
	+ Filename 		: c_resep_dokter.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
*/

class M_resep_dokter extends Model{
		
	//constructor
	function M_resep_dokter() {
		parent::Model();
	}
		
		
	//get master id, note : not done yet
	function get_master_id() {
		$query = "SELECT max(resep_id) as master_id from resep_dokter";
		$result = $this->db->query($query);
		if($result->num_rows()){
			$data=$result->row();
			$master_id=$data->master_id;
			return $master_id;
		}else{
			return '0';
		}
	}
	//eof
	
		function get_produk_list($query,$start,$end){
		/*$sql="SELECT produk_id,produk_kode,produk_nama,produk_kategori,produk_harga,produk_group,produk_du,produk_dm
				,kategori_nama, group_nama, satuan_kode, satuan_nama 
				FROM produk,satuan,kategori,produk_group where satuan_id=produk_satuan and kategori_id=produk_kategori
				and produk_group=group_id and produk_aktif='Aktif'";*/
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT krawat_produk FROM perawatan_konsumsi WHERE krawat_master='$query'";
			$rs=$this->db->query($sql_dproduk);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="select * from vu_produk WHERE produk_aktif='Aktif'";
		if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$sql)? " OR ":" AND ";
				foreach($rs->result() as $row_dproduk){
					
					$filter.="OR produk_id='".$row_dproduk->krawat_produk."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		}
		
		/*if($query<>"")
			$sql.=" WHERE (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%'
						 or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";*/
		
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		if($end!=0){
			$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);
		}
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
	

	function get_paket_list($query,$start,$end){
			$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_paket="SELECT distinct(dresep_paket) FROM detail_resep_dokter_kombinasi WHERE dresep_master='$query'";
				$rs=$this->db->query($sql_paket);
				$rs_rows=$rs->num_rows();
			}
			
//			$sql="SELECT paket_id, paket_harga, paket_kode, group_nama, kategori_nama, paket_du, paket_dm, paket_nama, paket_expired FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE kategori.kategori_jenis='paket' AND paket_aktif='Aktif'";
			$sql=  "SELECT 
						paket_id, paket_harga, paket_kode, paket_du, paket_dm, paket_nama, paket_expired 
					FROM paket 
					WHERE paket_aktif='Aktif'";

			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (paket_kode LIKE '%".addslashes($query)."%' OR paket_nama LIKE '%".addslashes($query)."%' ) ";
			}else{
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$query)? " OR ":" AND ";
					foreach($rs->result() as $row_paket){
						
						$filter.="OR paket_id='".$row_paket->dresep_paket."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}
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
	
	
	
	function having_cust_member_checking($cust_id){
		$sql="SELECT cust_member FROM customer WHERE cust_id='$cust_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$cust_member=$rs_record["cust_member"];
			return $cust_member;
		}else{
			return '';
		}
	}
	
	
	
	function get_satuan_produk_list($selected_id){
			
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'
					AND satuan_id in(SELECT distinct dterima_satuan FROM detail_terima_beli)";
			
			if($selected_id!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_id='".$selected_id."'";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
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
		
		function get_satuan_selected_list($selected_id){
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM satuan";
			if($selected_id!=="")
			{
				$selected_id=substr($selected_id,0,strlen($selected_id)-1);
				$sql.=" WHERE satuan_id IN(".$selected_id.")";
			}

			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
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
		
		function get_satuan_detail_list($master_id){
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM satuan";
			if($master_id<>"")
				$sql.=" WHERE satuan_id IN(SELECT drbeli_satuan FROM detail_retur_beli WHERE drbeli_master='".$master_id."')";
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
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
	
	
	
	
	/* INSERT ke db.history_ambil_paket */
	function history_ambil_paket_delete($dtrawat_id, $dtrawat_dapp){
		$this->db->where('hapaket_dtrawat', $dtrawat_id);
		$this->db->delete('history_ambil_paket');
		if($this->db->affected_rows()){
			/* meng-UNLOCK db.appointment_detail */
			$dtu_dapp=array(
			"dapp_locked"=>0
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
		}
	}
	/* eof history_ambil_paket_insert */
				
	function detail_resepdokter_lepasan_list($master_id,$query,$start,$end) {
			//$query="SELECT *,konversi_nilai FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dpcard_produk=konversi_produk AND dpcard_satuan=konversi_satuan) WHERE dpcard_master='".$master_id."'";     //date_format(dpcard_tanggal,'%Y-%m-%d') as dpcard_tanggal, dpcard_keterangan
			$query = "SELECT dresepl_id, dresepl_master, dresepl_produk, dresepl_tambahan, dresepl_satuan, dresepl_jumlah, satuan_nama
			FROM detail_resep_dokter_lepasan
			LEFT JOIN produk ON(dresepl_produk=produk_id)
			LEFT JOIN paket ON (dresepl_paket=paket_id)
			LEFT JOIN satuan ON (dresepl_satuan=satuan_id)
			WHERE dresepl_master='".$master_id."'";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			$limit = $query." LIMIT ".$start.",".$end;			
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
		
	function detail_resepdokter_kombinasi_list($master_id,$query,$start,$end) {
			//$query="SELECT *,konversi_nilai FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dpcard_produk=konversi_produk AND dpcard_satuan=konversi_satuan) WHERE dpcard_master='".$master_id."'";     //date_format(dpcard_tanggal,'%Y-%m-%d') as dpcard_tanggal, dpcard_keterangan
			$query = "SELECT dresepk_id, dresepk_master, dresepk_paket
			FROM detail_resep_dokter_kombinasi
			LEFT JOIN paket ON (dresepk_paket=paket_id)
			WHERE dresepk_master='".$master_id."'";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			$limit = $query." LIMIT ".$start.",".$end;			
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
		
	function detail_resepdokter_tambahan_list($master_id,$query,$start,$end) {
			//$query="SELECT *,konversi_nilai FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dpcard_produk=konversi_produk AND dpcard_satuan=konversi_satuan) WHERE dpcard_master='".$master_id."'";     //date_format(dpcard_tanggal,'%Y-%m-%d') as dpcard_tanggal, dpcard_keterangan
			$query = "SELECT dresept_id, dresept_master, dresept_tambahan, dresept_satuan, dresept_jumlah
			FROM detail_resep_dokter_tambahan
			WHERE dresept_master='".$master_id."'";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			$limit = $query." LIMIT ".$start.",".$end;			
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
		
		
	function resepdokter_detail_lepasan_insert($dresepl_id ,$dresepl_master ,$dresepl_produk, $dresepl_tambahan, $dresepl_satuan, $dresepl_jumlah, $cetak, $count, $dcount){
			//if master id not capture from view then capture it from max pk from master table
			$date_now=date('d-m-Y');
			if($dresepl_master=="" || $dresepl_master==NULL || $dresepl_master==0){
				$dresepl_master=$this->get_master_id();
			}
			
			$sql="SELECT dresepl_id FROM detail_resep_dokter_lepasan WHERE dresepl_master='$dresepl_master' AND dresepl_produk='$dresepl_produk'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				//if($dresepl_tambahan<>100){
					//* UPDATE detail_resep_dokter untuk menambahkan dproduk_jumlah, ini dikarenakan kasir memasukkan produk yg sama lebih dari satu dalam satu Faktur /
					$record = $rs->row_array();
					$dresepl_id=$record['dresepl_id'];
					$dproduk_jumlah_awal = $record['dresepl_produk'];
					$dtu_dproduk=array(
					"dresepl_produk"=>$dresepl_produk,
					"dresepl_tambahan"=>$dresepl_tambahan,
					"dresepl_satuan"=>$dresepl_satuan,
					"dresepl_jumlah"=>$dresepl_jumlah
					);
					$this->db->where('dresepl_id', $dresepl_id);
					$this->db->update('detail_resep_dokter_lepasan', $dtu_dproduk);
					if($this->db->affected_rows()){
						if($cetak==1 && ($count==($dcount-1))){
							return $dresepl_master;
						}else if($cetak!==1 && ($count==($dcount-1))){
							return '0';
						}else if($count!==($dcount-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				//}
				//else{
					$data = array(
						"dresepl_master"=>$dresepl_master, 
						"dresepl_produk"=>$dresepl_produk,
						"dresepl_tambahan"=>$dresepl_tambahan,
						"dresepl_satuan"=>$dresepl_satuan,
						"dresepl_jumlah"=>$dresepl_jumlah
					);
					$this->db->insert('detail_resep_dokter_lepasan', $data); 
					if($this->db->affected_rows()){
						if($cetak==1 && ($count==($dcount-1))){
							return $dresepl_master;
						}else if($cetak!==1 && ($count==($dcount-1))){
							return '0';
						}else if($count!==($dcount-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				//}
			}else{
				$data = array(
					"dresepl_master"=>$dresepl_master, 
					"dresepl_produk"=>$dresepl_produk, 
					"dresepl_tambahan"=>$dresepl_tambahan,
					"dresepl_satuan"=>$dresepl_satuan,
					"dresepl_jumlah"=>$dresepl_jumlah
				);
				$this->db->insert('detail_resep_dokter_lepasan', $data); 
				if($this->db->affected_rows()){
					if($cetak==1 && ($count==($dcount-1))){
						return $dresepl_master;
					}else if($cetak!==1 && ($count==($dcount-1))){
						return '0';
					}else if($count!==($dcount-1)){
						return '-3';
					}
				}else
					return '-1';
			}
		}
		
	function resepdokter_detail_kombinasi_insert($dresepk_id ,$dresepk_master ,$dresepk_paket, $cetak, $count, $dcount){
			//if master id not capture from view then capture it from max pk from master table
			$date_now=date('d-m-Y');
			if($dresepk_master=="" || $dresepk_master==NULL || $dresepk_master==0){
				$dresepk_master=$this->get_master_id();
			}
			
			$sql="SELECT dresepk_id FROM detail_resep_dokter_kombinasi WHERE dresepk_master='$dresepk_master' AND dresepk_paket='$dresepk_paket'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				/*if($dproduk_diskon<>100){
					//* UPDATE detail_resep_dokter untuk menambahkan dproduk_jumlah, ini dikarenakan kasir memasukkan produk yg sama lebih dari satu dalam satu Faktur /
					$record = $rs->row_array();
					$dresepk_id=$record['dresepk_id'];
					$dpaket_jumlah_awal = $record['dresepk_paket'];
					$dtu_dproduk=array(
					"dresepk_paket"=>$dresepk_paket
					);
					$this->db->where('dresepk_id', $dresepk_id);
					$this->db->update('detail_resep_dokter_kombinasi', $dtu_dproduk);
					if($this->db->affected_rows()){
						if($cetak==1 && ($count==($dcount-1))){
							return $dresepk_master;
						}else if($cetak!==1 && ($count==($dcount-1))){
							return '0';
						}else if($count!==($dcount-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				}else{
					$data = array(
						"dresepk_master"=>$dresepk_master, 
						"dresepk_paket"=>$dresepk_paket,
					);
					$this->db->insert('detail_resep_dokter_kombinasi', $data); 
					if($this->db->affected_rows()){
						if($cetak==1 && ($count==($dcount-1))){
							return $dresepk_master;
						}else if($cetak!==1 && ($count==($dcount-1))){
							return '0';
						}else if($count!==($dcount-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				}*/
			}else{
				$data = array(
					"dresepk_master"=>$dresepk_master, 
					"dresepk_paket"=>$dresepk_paket,
				);
				$this->db->insert('detail_resep_dokter_kombinasi', $data); 
				if($this->db->affected_rows()){
					if($cetak==1 && ($count==($dcount-1))){
						return $dresepk_master;
					}else if($cetak!==1 && ($count==($dcount-1))){
						return '0';
					}else if($count!==($dcount-1)){
						return '-3';
					}
				}else
					return '-1';
			}
		}
		
		
	function resepdokter_detail_tambahan_insert($dresept_id ,$dresept_master, $dresept_tambahan, $dresept_satuan, $dresept_jumlah, $cetak_tambahan, $count_tambahan, $dcount_tambahan){
			//if master id not capture from view then capture it from max pk from master table
			$date_now=date('d-m-Y');
			if($dresept_master=="" || $dresept_master==NULL || $dresept_master==0){
				$dresept_master=$this->get_master_id();
			}
			
			$sql="SELECT dresept_id, dresept_tambahan, dresept_master FROM detail_resep_dokter_tambahan WHERE dresept_master='$dresept_master' and dresept_tambahan='$dresept_tambahan'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				//if($dresept_tambahan<>100){
					//* UPDATE detail_resep_dokter untuk menambahkan dproduk_jumlah, ini dikarenakan kasir memasukkan produk yg sama lebih dari satu dalam satu Faktur /
					$record_tambahan = $rs->row_array();
					$dresept_id=$record_tambahan['dresept_id'];
					$dtu_tambahan=array(
					"dresept_tambahan"=>$dresept_tambahan,
					"dresept_satuan"=>$dresept_satuan,
					"dresept_jumlah"=>$dresept_jumlah
					);
					$this->db->where('dresept_id', $dresept_id);
					$this->db->update('detail_resep_dokter_tambahan', $dtu_tambahan);
					if($this->db->affected_rows()){
						if($cetak_tambahan==1 && ($count_tambahan==($dcount_tambahan-1))){
							return $dresept_master;
						}else if($cetak_tambahan!==1 && ($count_tambahan==($dcount_tambahan-1))){
							return '0';
						}else if($count_tambahan!==($dcount_tambahan-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				//}
				//else{
					$data = array(
						"dresept_master"=>$dresept_master, 
						"dresept_tambahan"=>$dresept_tambahan,
						"dresept_satuan"=>$dresept_satuan,
						"dresept_jumlah"=>$dresept_jumlah
					);
					$this->db->insert('detail_resep_dokter_tambahan', $data); 
					if($this->db->affected_rows()){
						if($cetak_tambahan==1 && ($count_tambahan==($dcount_tambahan-1))){
							return $dresept_master;
						}else if($cetak_tambahan!==1 && ($count_tambahan==($dcount_tambahan-1))){
							return '0';
						}else if($count_tambahan!==($dcount_tambahan-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				//}
			}else{
				$data = array(
					"dresept_master"=>$dresept_master, 
					"dresept_tambahan"=>$dresept_tambahan,
					"dresept_satuan"=>$dresept_satuan,
					"dresept_jumlah"=>$dresept_jumlah
				);
				$this->db->insert('detail_resep_dokter_tambahan', $data); 
				if($this->db->affected_rows()){
					if($cetak_tambahan==1 && ($count_tambahan==($dcount_tambahan-1))){
						return $dresept_master;
					}else if($cetak_tambahan!==1 && ($count_tambahan==($dcount_tambahan-1))){
						return '0';
					}else if($count_tambahan!==($dcount_tambahan-1)){
						return '-3';
					}
				}else
					return '-1';
			}
		}
		
		
		function detail_resepdokter_lepasan_purge($master_id){
			$sql="DELETE detail_resep_dokter_lepasan FROM detail_resep_dokter_lepasan INNER JOIN produk ON(dresepl_produk=produk_id) WHERE dresepl_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		
		function detail_resepdokter_kombinasi_purge($master_id){
			$sql="DELETE detail_resep_dokter_kombinasi FROM detail_resep_dokter_kombinasi INNER JOIN paket ON(dresepk_paket=paket_id) WHERE dresepk_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		
		function detail_resepdokter_tambahan_purge($master_id){
			$sql="DELETE detail_resep_dokter_tambahan FROM detail_resep_dokter_tambahan WHERE dresept_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		
		
		//function for get list record
		function resep_dokter_list($filter,$start,$end){
			$date_now=date('d-m-Y');

			$query = "select resep_dokter.*,customer.cust_no, customer.cust_nama, karyawan.karyawan_username, karyawan.karyawan_id, karyawan.karyawan_nama, karyawan.karyawan_sip
from resep_dokter
left join customer on (customer.cust_id=resep_dokter.resep_custid)
left join karyawan on (karyawan.karyawan_id = resep_dokter.resep_dokterid)";
			
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (resep_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%')";
			}

			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			//$limit = $query." LIMIT ".$start.",".$end;		
			//$result = $this->db->query($limit);  
			
			if($nbrows>0 || $nbrows2>0 || $nbrows3>0 || $nbrows4>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
	//function for update record
	function resep_dokter_update($resep_id, $resep_custid , $resep_tanggal, $resep_dokterid, $mode_edit){
		$data=array(
		"resep_tanggal"=>$resep_tanggal
		//"resep_dokterid"=>$resep_dokterid
		);

		
		//"card_dokter"=>$card_dokter
		$this->db->where("resep_id", $resep_id);
		$this->db->update("resep_dokter", $data);
		
		if($mode_edit=="update_list"){
			$sql_check="SELECT resep_id,card_keterangan, card_cust, card_dokter, card_locked FROM rekomendasi_card WHERE resep_id='$resep_id'";
			$rs_check=$this->db->query($sql_check);
			if($rs_check->num_rows()){
				$rs_check_record=$rs_check->row_array();
				$card_locked=$rs_check_record["card_locked"];
				$card_dokter_awal=$rs_check_record["card_dokter"];
				$trawat_keterangan_awal=$rs_check_record["card_keterangan"];
				
				$sql="SELECT rawat_id FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
				$rs=$this->db->query($sql);
				if($rs->num_rows())
					$dtrawat_perawatan=$dtrawat_perawatan;
				else 
					$dtrawat_perawatan=$dtrawat_perawatan_id;
				
				$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$card_dokter'";
				$rs=$this->db->query($sql);
				if($rs->num_rows())
					$card_dokter=$card_dokter;
				else 
					$card_dokter=$card_dokter_id;
				
				if($dtrawat_status_awal<>$dtrawat_status && $dtrawat_locked==0){ 
					$date_now=date('d-m-Y');
					$data_dtindakan=array(
					"dtrawat_status"=>$dtrawat_status,
					);
			
					$this->db->where("resep_id", $resep_id);
					$this->db->update("rekomendasi_card", $data_dtindakan);
					
					if($dtrawat_status_awal!='selesai' && $dtrawat_status=='selesai' && $dtrawat_ambil_paket=='true'){
						$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$dti_hapaket=array(
							"hapaket_dpaket"=>$dpaket_id,
							"hapaket_rawat"=>$rpaket_perawatan,
							"hapaket_jumlah"=>1,
							"hapaket_cust"=>$card_cust_id,
							"hapaket_dtrawat"=>$dtrawat_id
							);
							$this->db->insert('history_ambil_paket', $dti_hapaket);
							if($this->db->affected_rows()){
								/* me-LOCKED db.appointment_detail */
								$data_dapp_locked=array(
								"dapp_locked"=>1
								);
								$this->db->where('dapp_id', $dtrawat_dapp);
								$this->db->update('appointment_detail', $data_dapp_locked);
								return '1';
							}else{
								return '0';
							}
						}
					}elseif($dtrawat_status_awal=='selesai' && $dtrawat_status!='selesai' && $dtrawat_ambil_paket=='true'){
						$this->db->where('hapaket_dtrawat', $dtrawat_id);
						$this->db->delete('history_ambil_paket');
						if($this->db->affected_rows()){
							/* meng-UNLOCK db.appointment_detail */
							$data_dapp_locked=array(
							"dapp_locked"=>0
							);
							$this->db->where('dapp_id', $dtrawat_dapp);
							$this->db->update('appointment_detail', $data_dapp_locked);
							return '1';
						}else{
							return '0';
						}
					}elseif($dtrawat_status_awal=='selesai' && $dtrawat_status!='selesai' && $dtrawat_ambil_paket=='false'){
						$this->detail_jual_rawat_delete($dtrawat_id, $dtrawat_dapp);
						return '1';
					}
					return '1';
				}elseif($dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true' && $dtrawat_status_awal=='selesai'){
					$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$this->detail_jual_rawat_delete($dtrawat_id, $dtrawat_dapp);
						$this->history_ambil_paket_insert($dpaket_id, $rpaket_perawatan, $card_cust_id, $dtrawat_id, $dtrawat_dapp);
						return '1';
					}else{
						return '0';
					}
				}elseif($dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true' && $dtrawat_status_awal!='selesai'){
					$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$dtu_dtrawat=array(
						"dtrawat_ambil_paket"=>'true'
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('rekomendasi_card', $dtu_dtrawat);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}else{
						return '0';
					}
				}elseif($dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false' && $dtrawat_status_awal=='selesai'){
					$dtu_dtrawat=array(
					"dtrawat_ambil_paket"=>'false'
					);
					$this->db->where('dtrawat_id', $dtrawat_id);
					$this->db->update('rekomendasi_card', $dtu_dtrawat);
					
					$this->history_ambil_paket_delete($dtrawat_id, $dtrawat_dapp);
					return '1';
					
				}elseif($dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false' && $dtrawat_status_awal!='selesai'){
					$dtu_dtrawat=array(
					"dtrawat_ambil_paket"=>'false'
					);
					$this->db->where('resep_id', $resep_id);
					$this->db->update('rekomendasi_card', $dtu_dtrawat);
					if($this->db->affected_rows()){
						return '1';
					}else{
						return '0';
					}
					
				}elseif($dtrawat_perawatan_awal<>$dtrawat_perawatan && $dtrawat_locked==0){
					if($dtrawat_ambil_paket=='true' && $dtrawat_status=='selesai'){
						$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/* UPDATE db.tindakan_detail */
							$dtu_dtrawat=array(
							"dtrawat_perawatan"=>$dtrawat_perawatan
							);
							$this->db->where('dtrawat_id', $dtrawat_id);
							$this->db->update('rekomendasi_card', $dtu_dtrawat);
							/* UPDATE db.history_ambil_paket */
							$dtu_hapaket=array(
							"hapaket_rawat"=>$dtrawat_perawatan
							);
							$this->db->where('hapaket_dtrawat', $dtrawat_id);
							$this->db->update('history_ambil_paket', $dtu_hapaket);
							return '1';
						}else{
							return '0';
						}
					}elseif($dtrawat_ambil_paket=='true' && $dtrawat_status!='selesai'){
						$dtu_dtrawat=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('rekomendasi_card', $dtu_dtrawat);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}elseif($dtrawat_ambil_paket=='false' && $dtrawat_status=='selesai'){
						$dtu_dtrawat=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('rekomendasi_card', $dtu_dtrawat);
						return '1';
					}elseif($dtrawat_ambil_paket=='false' && $dtrawat_status!='selesai'){
						$dtu_dtrawat=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('rekomendasi_card', $dtu_dtrawat);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}
					
					return '1';
				}elseif($trawat_keterangan_awal<>$card_keterangan && $card_locked==0){
					$data_dtindakan=array(
					"card_keterangan"=>$card_keterangan
					);
					$this->db->where('resep_id', $resep_id);
					$this->db->update('rekomendasi_card',$data_dtindakan);
					return '1';
				}elseif($card_locked==1){
					return '2';
				}else{
					return '1';
				}
			}else{
				return '0';
			}
		}else{
			return '1';
		}
	}
		
		//function for create new record
		function resep_dokter_create($resep_custid, $resep_dokterid, $resep_no, $resep_tanggal, $resep_keterangan){
			
			$pattern="RS/".date("ym")."-";
			$resep_no=$this->m_public_function->get_resep_kode('resep_dokter','resep_no',$pattern,12);
			
			//$date_now=date('d-m-Y');
			$data = array(
			"resep_custid"=>$resep_custid,
			"resep_dokterid"=>$resep_dokterid,
			"resep_no"=>$resep_no,
			"resep_tanggal"=>$resep_tanggal,
			"resep_keterangan"=>$resep_keterangan
			);
		
			$this->db->insert('resep_dokter', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function resep_dokter_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM resep_dokter WHERE resep_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM resep_dokter WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "resep_id= ".$pkid[$i];
					if($i<sizeof($pkid)-1){
						$query = $query . " OR ";
					}     
				}
				$this->db->query($query);
			}
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '0';
		}
		
		//function for advanced search record
		function resep_dokter_search($trawat_id ,$card_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_dokter ,$trawat_status ,$start,$end){
			//full query
			$query = "SELECT * FROM vu_tindakan WHERE (kategori_nama='Medis' OR dtrawat_petugas2='0')";
			
			if($trawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_id LIKE '%".$trawat_id."%'";
			};
			if($card_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_cust LIKE '%".$card_cust."%'";
			};
			if($trawat_rawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_perawatan LIKE '%".$trawat_rawat."%'";
			};
			if($trawat_dokter!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_petugas1 LIKE '%".$trawat_dokter."%'";
			};
			if($trawat_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_status LIKE '%".$trawat_status."%'";
			};
			if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_tglapp='".$trawat_tglapp_start."'";
			}
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			$limit = $query." LIMIT ".$start.",".$end;		
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
		
		//function for print record
		function resep_dokter_print($trawat_id ,$card_cust ,$card_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR card_cust LIKE '%".addslashes($filter)."%' OR card_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($card_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_cust LIKE '%".$card_cust."%'";
				};
				if($card_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_keterangan LIKE '%".$card_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function resep_dokter_export_excel($trawat_id ,$card_cust ,$card_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR card_cust LIKE '%".addslashes($filter)."%' OR card_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($card_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_cust LIKE '%".$card_cust."%'";
				};
				if($card_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_keterangan LIKE '%".$card_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		
		function print_paper($resep_id){
			//$this->firephp->log($jproduk_id, "jproduk_id");
			
			//$sql="SELECT resep_tanggal, cust_no, cust_nama, produk_nama, resep_no, karyawan_nama, karyawan_sip FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dresep_master=resep_id) LEFT JOIN customer ON(resep_custid=cust_id) LEFT JOIN produk ON(dresep_produk=produk_id) WHERE dresep_master='$resep_id'";
			$sql1="SELECT	resep_dokter.resep_tanggal, resep_dokter.resep_no,
							customer.cust_no, customer.cust_nama, customer.cust_alamat, 
							produk.produk_nama, 
							karyawan.karyawan_nama, karyawan.karyawan_sip,
							satuan.satuan_nama,
							detail_resep_dokter_lepasan.dresepl_jumlah
					FROM detail_resep_dokter_lepasan
						LEFT JOIN resep_dokter ON(dresepl_master=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
						LEFT JOIN produk ON(dresepl_produk=produk_id)
						LEFT JOIN satuan ON (dresepl_satuan = satuan_id)
							WHERE dresepl_master= '$resep_id'";

			$sql2 = "SELECT 	resep_dokter.resep_tanggal, resep_dokter.resep_no,
								customer.cust_no, customer.cust_nama, customer.cust_alamat, 
								karyawan.karyawan_nama, karyawan.karyawan_sip,
								detail_resep_dokter_tambahan.dresept_tambahan, detail_resep_dokter_tambahan.dresept_satuan, detail_resep_dokter_tambahan.dresept_jumlah
					FROM detail_resep_dokter_tambahan
						LEFT JOIN resep_dokter ON(dresept_master=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
							WHERE dresept_master= '$resep_id'";

			$result = $this->db->query($sql1);
			//$result2 = $this->db->query($sql2);
			
			return $result;
			//return $result2;
			
			
		}
		
		
		function print_paper2($resep_id){
			//$this->firephp->log($jproduk_id, "jproduk_id");
			
			//$sql="SELECT resep_tanggal, cust_no, cust_nama, produk_nama, resep_no, karyawan_nama, karyawan_sip FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dresep_master=resep_id) LEFT JOIN customer ON(resep_custid=cust_id) LEFT JOIN produk ON(dresep_produk=produk_id) WHERE dresep_master='$resep_id'";
			$sql1="SELECT	resep_dokter.resep_tanggal, resep_dokter.resep_no,
							customer.cust_no, customer.cust_nama, customer.cust_alamat, 
							produk.produk_nama, 
							karyawan.karyawan_nama, karyawan.karyawan_sip,
							satuan.satuan_nama,
							detail_resep_dokter_lepasan.dresepl_jumlah
					FROM detail_resep_dokter_lepasan
						LEFT JOIN resep_dokter ON(dresepl_master=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
						LEFT JOIN produk ON(dresepl_produk=produk_id)
						LEFT JOIN satuan ON (dresepl_satuan = satuan_id)
							WHERE dresepl_master= '$resep_id'";

			$sql2 = "SELECT 	resep_dokter.resep_tanggal, resep_dokter.resep_no,
								customer.cust_no, customer.cust_nama, customer.cust_alamat, 
								karyawan.karyawan_nama, karyawan.karyawan_sip,
								detail_resep_dokter_tambahan.dresept_tambahan, detail_resep_dokter_tambahan.dresept_satuan, detail_resep_dokter_tambahan.dresept_jumlah
					FROM detail_resep_dokter_tambahan
						LEFT JOIN resep_dokter ON(dresept_master=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
							WHERE dresept_master= '$resep_id'";

			$result1 = $this->db->query($sql1);
			$result2 = $this->db->query($sql2);
			
			return $result2;
			//return $result2;
			
			
			
			
		}
		
		
		
		
		
		
		function iklan(){
			//$this->firephp->log($jproduk_id, "jproduk_id");
			$sql="SELECT * from iklan_today";
			$result1 = $this->db->query($sql);
			return $result1;
		}
		
		
}
?>