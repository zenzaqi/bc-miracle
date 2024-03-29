<? /* 	
	+ Module  		: resep dokter Model
	+ Description	: For record model process back-end
	+ Filename 		: c_resep_dokter.php
 	+ Author  		: Fred
	
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
			
			$sql="SELECT distinct produk_id,produk_nama,produk_kode,kategori_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'";
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
/*			$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);  */
			
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
		
	function get_produk_racikan_list_by_produk_id($produk_id,$query,$start,$end){
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_produk";
			if($produk_id<>"")
				$sql.=" WHERE produk_id IN(SELECT pracikan_produk FROM produk_racikan WHERE pracikan_master='".$produk_id."')";
			
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
/*			$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit); */ 
			
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
		
	function get_produk_racikan_list($query,$start,$end){
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT dresepk_produk FROM detail_resep_dokter_kombinasi WHERE dresepk_resepmaster='$query'";
			$rs=$this->db->query($sql_dproduk);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="select * from vu_produk WHERE (produk_aktif='Aktif' and produk_racikan=1)";
		if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$sql)? " OR ":" AND ";
				foreach($rs->result() as $row_dproduk){
					
					$filter.="OR produk_id='".$row_dproduk->dresepl_produk."' ";
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
	
	function get_satuan_bydrl_list($drproduk_id,$produk_id){
		if($drproduk_id<>0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM satuan LEFT JOIN satuan_konversi ON(konversi_satuan=satuan_id) LEFT JOIN produk ON(konversi_produk=produk_id) LEFT JOIN detail_resep_dokter_lepasan ON(dresepl_produk=produk_id) LEFT JOIN resep_dokter ON(dresepl_master=resep_id) WHERE resep_id='$drproduk_id'";
		
		if($produk_id<>0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM satuan LEFT JOIN satuan_konversi ON(konversi_satuan=satuan_id) LEFT JOIN produk ON(konversi_produk=produk_id) WHERE produk_id='$produk_id'";
			
		if($drproduk_id==0 && $produk_id==0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id";
		//$sql="SELECT satuan_id,satuan_nama,satuan_kode FROM satuan";
		$query = $this->db->query($sql);
		$nbrows = $query->num_rows();
		if($nbrows>0){
			foreach($query->result() as $row){
				$arr[] = $row;
			}
			$jsonresult = json_encode($arr);
			return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
		} else {
			return '({"total":"0", "results":""})';
		}
	}

	
	function get_satuan_produk_list($selected_id){
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'";
			
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
				$sql.=" WHERE satuan_id IN(SELECT dresepl_satuan FROM detail_resep_dokter_lepasan WHERE dresepl_master='".$master_id."')";
			
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
	
			
	function get_detail_racikan_by_produk_id($id_racikan){
		$sql="select * from produk
		where produk_id ='".$id_racikan."'";
				
		$query = $this->db->query($sql);
		$nbrows = $query->num_rows();
		if($nbrows>0){
			foreach($query->result() as $row){
				$arr[] = $row;
			}
			$jsonresult = json_encode($arr);
			return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
		} else {
			return '({"total":"0", "results":""})';
		}
	}

	
	function detail_resepdokter_lepasan_list($master_id,$query,$start,$end) {
			$query = "SELECT detail_resep_dokter_lepasan.* , satuan_id, satuan_nama, produk_id, produk_nama
			FROM detail_resep_dokter_lepasan
			LEFT JOIN satuan ON (dresepl_satuan = satuan_id)
			LEFT JOIN resep_dokter ON(dresepl_master=resep_id)
			LEFT JOIN produk ON(dresepl_produk=produk_id)
			WHERE dresepl_master='".$master_id."' and dresepl_produk = produk_id and dresepl_satuan = satuan_id";
			
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
		
		
	function master_kombinasi_list($master_id,$query,$start,$end) {
			$query = "SELECT *
			FROM master_resep_kombinasi
			LEFT JOIN produk ON (rkombinasi_produk=produk_id)
			WHERE rkombinasi_master='".$master_id."' and rkombinasi_produk=produk_id";
			
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
			$query = "SELECT detail_resep_dokter_kombinasi.*, produk_id, produk_nama, produk_satuan, satuan_id, satuan_nama
			FROM detail_resep_dokter_kombinasi
			LEFT JOIN produk ON (dresepk_produk=produk_id)
			LEFT JOIN satuan ON (dresepk_satuan=satuan_nama)
			WHERE dresepk_resepmaster='".$master_id."'";
			
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
			
					$dtu_dproduk=array(
					"dresepl_id"=>$dresepl_id,
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
			
					$data = array(
						"dresepl_id"=>$dresepl_id,
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
			
			}else{
				$data = array(
					"dresepl_id"=>$dresepl_id,
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
		
		
	
	function resepdokter_master_kombinasi_insert($rkombinasi_id ,$rkombinasi_master ,$rkombinasi_produk, $rkombinasi_keterangan, $cetak, $cetak_dotmatrix, $count, $dcount){
			//if master id not capture from view then capture it from max pk from master table
			$date_now=date('d-m-Y');
			if($rkombinasi_master=="" || $rkombinasi_master==NULL || $rkombinasi_master==0){
				$rkombinasi_master=$this->get_master_id();
			}
			
			//$sql="SELECT rkombinasi_id FROM master_resep_kombinasi WHERE rkombinasi_master='$rkombinasi_master'";
			//$rs=$this->db->query($sql);
			//if($rs->num_rows()){
			//}else
			
			//{
				$data = array(
					"rkombinasi_id"=>$rkombinasi_id,
					"rkombinasi_master"=>$rkombinasi_master, 
					"rkombinasi_produk"=>$rkombinasi_produk,
					"rkombinasi_keterangan"=>$rkombinasi_keterangan,
				);
				$this->db->insert('master_resep_kombinasi', $data); 
				if($this->db->affected_rows()){
					if(($cetak==1 or $cetak_dotmatrix==1) && ($count==($dcount-1))){
						return $rkombinasi_master;
					}else if($cetak!==1 && ($count==($dcount-1))){
						return '0';
					}else if($count!==($dcount-1)){
						return '-3';
					}
					/*else if($cetak_dotmatrix==1 && ($count==($dcount-1))){
						return $rkombinasi_master;
					}*/
				}else
					return '-1';
			//}
		}
		

	function resepdokter_detail_kombinasi_insert($dresepk_id ,$dresepk_master , $dresepk_resepmaster, $dresepk_produk, $dresepk_satuan, $dresepk_jumlah, $cetak, $count, $dcount){
			//if master id not capture from view then capture it from max pk from master table
			
			if($dresepk_resepmaster=="" || $dresepk_resepmaster==NULL || $dresepk_resepmaster==0){
				$dresepk_resepmaster=$this->get_master_id();
			}

			$date_now=date('d-m-Y');
		
			//$sql="SELECT dresepk_id FROM detail_resep_dokter_kombinasi WHERE dresepk_master='$dresepk_master' AND dresepk_produk='$dresepk_produk'";
			//$rs=$this->db->query($sql);
			//if($rs->num_rows()){
			//}
			//else{
				$data = array(
					"dresepk_id"=>$dresepk_id,
					"dresepk_resepmaster"=>$dresepk_resepmaster,
					"dresepk_master"=>$dresepk_master, 
					"dresepk_produk"=>$dresepk_produk,
					"dresepk_satuan"=>$dresepk_satuan,
					"dresepk_jumlah"=>$dresepk_jumlah,
				);
				$this->db->insert('detail_resep_dokter_kombinasi', $data); 
				if($this->db->affected_rows()){
					if($cetak==1 && ($count==($dcount-1))){
						return $dresepk_resepmaster;
					}else if($cetak!==1 && ($count==($dcount-1))){
						return '0';
					}else if($count!==($dcount-1)){
						return '-3';
					}
				}else
					return '-1';
			//}
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
		
		function master_resepdokter_kombinasi_purge($master_id){
			$sql="DELETE master_resep_kombinasi FROM master_resep_kombinasi INNER JOIN produk ON(rkombinasi_produk=produk_id) WHERE rkombinasi_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		
		function detail_resepdokter_kombinasi_purge($master_id){
			$sql="DELETE detail_resep_dokter_kombinasi FROM detail_resep_dokter_kombinasi INNER JOIN produk ON(dresepk_produk=produk_id) WHERE dresepk_resepmaster='".$master_id."'";
			$result=$this->db->query($sql);
		}
		
		function detail_resepdokter_tambahan_purge($master_id){
			$sql="DELETE detail_resep_dokter_tambahan FROM detail_resep_dokter_tambahan WHERE dresept_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		
		
		//function for get list record
		function resep_dokter_list($filter,$start,$end){
			$date_now=date('Y-m-d');

			$query = "select resep_dokter.*,customer.cust_no, customer.cust_nama, karyawan.karyawan_username, karyawan.karyawan_id, karyawan.karyawan_nama, karyawan.karyawan_sip
from resep_dokter
left join customer on (customer.cust_id=resep_dokter.resep_custid)
left join karyawan on (karyawan.karyawan_id = resep_dokter.resep_dokterid)
where resep_tanggal = '".$date_now."'
";
			
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (resep_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%')";
			}

			//$query .= " WHERE date_format(resep_dokter.resep_tanggal,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
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
		
	//function for update record
	function resep_dokter_update($resep_id, $resep_nofaktur, $resep_custid , $resep_cust_manual, $resep_tanggal, $resep_dokterid, $mode_edit){
		$data=array(
		"resep_tanggal"=>$resep_tanggal,
		//"resep_custid"=>$resep_custid,
		"resep_nofaktur"=>$resep_nofaktur,
		"resep_cust_manual"=>$resep_cust_manual
		//"resep_dokterid"=>$resep_dokterid
		);

		$sql="select karyawan_id from karyawan where karyawan_id='".$resep_dokterid."'";
		$result=$this->db->query($sql);
		if($result->num_rows())
		$data["resep_dokterid"]=$resep_dokterid;
		
		$sql="select cust_id from customer where cust_id='".$resep_custid."'";
		$result=$this->db->query($sql);
		if($result->num_rows())
		$data["resep_custid"]=$resep_custid;
		
		
		$this->db->where("resep_id", $resep_id);
		$this->db->update("resep_dokter", $data);
	
		return '1';
	
	}
		
		//function for create new record
		function resep_dokter_create($resep_custid, $resep_cust_manual, $resep_dokterid, $resep_no, $resep_nofaktur, $resep_tanggal, $resep_keterangan){
			
			$pattern="RS/".date("ym")."-";
			$resep_no=$this->m_public_function->get_resep_kode('resep_dokter','resep_no',$pattern,12);
			
			//$date_now=date('d-m-Y');
			$data = array(
			"resep_custid"=>$resep_custid,
			"resep_cust_manual"=>$resep_cust_manual,
			"resep_dokterid"=>$resep_dokterid,
			"resep_no"=>$resep_no,
			"resep_nofaktur"=>$resep_nofaktur,
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
		
		//fcuntion for delete record for master and detail kombinasi
		function master_kombinasi_delete($pkid_kombinasi, $pkid_rmaster_kombinasi){
			// You could do some checkups here and return '0' or other error consts.
			if(sizeof($pkid_kombinasi)<1){
				return '0';
			} 
			// klik hanya 1 grid / 1 row saja.. 
			else if (sizeof($pkid_kombinasi) == 1){
			
				$query = "DELETE FROM master_resep_kombinasi WHERE rkombinasi_id = ".$pkid_kombinasi[0];
				$this->db->query($query);
				
				$query_detail = "DELETE FROM detail_resep_dokter_kombinasi WHERE dresepk_master = ".$pkid_rmaster_kombinasi[0];
				$this->db->query($query_detail);
			} 
			// ketika di klik dengan menahan control + klik
			else {
				$query = "DELETE FROM resep_dokter WHERE ";
				for($i = 0; $i < sizeof($pkid_kombinasi); $i++){
					$query = $query . "resep_id= ".$pkid_kombinasi[$i];
					if($i<sizeof($pkid_kombinasi)-1){
						$query = $query . " OR ";
					}     
				}
				$this->db->query($query);
			}
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		
		
		//function for advanced search record
		function resep_dokter_search($resep_cust_id ,$resep_dokter_tgl_start ,$resep_dokter_tgl_end ,$resep_dokter_id , $resep_no, $start,$end){
			//full query
			$query = "select resep_dokter.*,customer.cust_no, customer.cust_nama, karyawan.karyawan_username, karyawan.karyawan_id, karyawan.karyawan_nama, karyawan.karyawan_sip
from resep_dokter
left join customer on (customer.cust_id=resep_dokter.resep_custid)
left join karyawan on (karyawan.karyawan_id = resep_dokter.resep_dokterid)";
			
	
			if($resep_cust_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " resep_custid = '".$resep_cust_id."'";
			};
			if($resep_dokter_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " resep_dokterid = '".$resep_dokter_id."'";
			};
			if($resep_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " resep_no LIKE '%".$resep_no."%'";
			};

			if($resep_dokter_tgl_start!='' && $resep_dokter_tgl_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " resep_tanggal BETWEEN '".$resep_dokter_tgl_start."' AND '".$resep_dokter_tgl_end."'";
			}else if($resep_dokter_tgl_start!='' && $resep_dokter_tgl_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " resep_tanggal='".$resep_dokter_tgl_start."'";
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
			//$sql="SELECT resep_tanggal, cust_no, cust_nama, produk_nama, resep_no, karyawan_nama, karyawan_sip FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dresep_master=resep_id) LEFT JOIN customer ON(resep_custid=cust_id) LEFT JOIN produk ON(dresep_produk=produk_id) WHERE dresep_master='$resep_id'";
			$sql1="SELECT	resep_dokter.resep_tanggal, resep_dokter.resep_no, resep_dokter.resep_cust_manual,
							customer.cust_no, customer.cust_nama, customer.cust_alamat, 
							produk.produk_nama, 
							karyawan.karyawan_nama, karyawan.karyawan_sip,
							satuan.satuan_nama,
							detail_resep_dokter_lepasan.dresepl_jumlah, detail_resep_dokter_lepasan.dresepl_satuan
					FROM detail_resep_dokter_lepasan
						LEFT JOIN resep_dokter ON(dresepl_master=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
						LEFT JOIN produk ON(dresepl_produk=produk_id)
						LEFT JOIN satuan ON (dresepl_satuan = satuan_id)
							WHERE dresepl_master= '$resep_id'";

			$result = $this->db->query($sql1);
	
			return $result;
		
		}
		
		
		function print_paper2($resep_id){
			//$sql="SELECT resep_tanggal, cust_no, cust_nama, produk_nama, resep_no, karyawan_nama, karyawan_sip FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dresep_master=resep_id) LEFT JOIN customer ON(resep_custid=cust_id) LEFT JOIN produk ON(dresep_produk=produk_id) WHERE dresep_master='$resep_id'";
			$sql1="SELECT	resep_dokter.resep_tanggal, resep_dokter.resep_no, resep_dokter.resep_cust_manual,
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

			$sql2 = "SELECT 	resep_dokter.resep_tanggal, resep_dokter.resep_no, resep_dokter.resep_cust_manual,
								customer.cust_no, customer.cust_nama, customer.cust_alamat, 
								karyawan.karyawan_nama, karyawan.karyawan_sip,
								detail_resep_dokter_tambahan.dresept_tambahan, detail_resep_dokter_tambahan.dresept_satuan, detail_resep_dokter_tambahan.dresept_jumlah
					FROM detail_resep_dokter_tambahan
						LEFT JOIN resep_dokter ON(dresept_master=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
							WHERE dresept_master= '$resep_id'";

			//$result1 = $this->db->query($sql1);
			$result2 = $this->db->query($sql2);
			
			return $result2;
			//return $result2;

		}
		
		function print_paper_racikan($resep_id){
			//$sql="SELECT resep_tanggal, cust_no, cust_nama, produk_nama, resep_no, karyawan_nama, karyawan_sip FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dresep_master=resep_id) LEFT JOIN customer ON(resep_custid=cust_id) LEFT JOIN produk ON(dresep_produk=produk_id) WHERE dresep_master='$resep_id'";
			$sql_racikan = "select rkombinasi_keterangan as rkombinasi_keterangan from
								master_resep_kombinasi
								where rkombinasi_master = '$resep_id'";
			
			/*$sql_racikan="SELECT	
							produk.produk_nama as produk_racikan, 
							detail_resep_dokter_kombinasi.dresepk_jumlah as jumlah_racikan, detail_resep_dokter_kombinasi.dresepk_satuan as satuan_racikan
					FROM detail_resep_dokter_kombinasi
						LEFT JOIN resep_dokter ON(dresepk_resepmaster=resep_id)
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
						LEFT JOIN produk ON(dresepk_produk=produk_id)
						LEFT JOIN satuan ON (dresepk_satuan =satuan_nama)
						LEFT JOIN master_resep_kombinasi ON (dresepk_resepmaster = rkombinasi_master)
							WHERE dresepk_resepmaster = '$resep_id'";*/

			$result_racikan = $this->db->query($sql_racikan);
			
			return $result_racikan;

		}
		
		function print_paper_data($resep_id){
			$sql_data="SELECT resep_dokter.resep_tanggal AS resep_tanggal, resep_dokter.resep_no AS resep_no, resep_dokter.resep_cust_manual AS resep_cust_manual,
							customer.cust_no AS cust_no, customer.cust_nama AS cust_nama, customer.cust_alamat AS cust_alamat, 
							karyawan.karyawan_nama AS karyawan_nama, karyawan.karyawan_sip AS karyawan_sip
					FROM resep_dokter
						LEFT JOIN customer ON(resep_custid=cust_id)
						LEFT JOIN karyawan ON(resep_dokterid=karyawan_id)
						WHERE resep_id = '$resep_id'";

			$result_data = $this->db->query($sql_data);
	
			return $result_data;
		
		}
		
		
		
		
		function iklan(){
			$sql="SELECT * from iklan_today";
			$result1 = $this->db->query($sql);
			return $result1;
		}
		
		
}
?>