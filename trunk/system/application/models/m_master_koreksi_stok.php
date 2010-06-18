<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_koreksi_stok Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_koreksi_stok.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:46:19
	
*/

class M_master_koreksi_stok extends Model{
		
		//constructor
		function M_master_koreksi_stok() {
			parent::Model();
		}
		
		function get_stok_produk_selected($gudang,$produk_id){
			if($gudang==1){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode,satuan_id, satuan_nama FROM vu_stok_gudang_besar_saldo 
						WHERE produk_id='".$produk_id."'";
			}elseif($gudang==2){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode,satuan_id, satuan_nama FROM vu_stok_gudang_produk_saldo
					WHERE produk_id='".$produk_id."'";
			}else{
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode,satuan_id, satuan_nama FROM vu_stok_gudang_all";
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." gudang_id ='".$gudang."' AND produk_id='".$produk_id."'";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($nbrows<1){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,0 as jumlah_stok,satuan_kode,satuan_id, satuan_nama 
						FROM vu_produk_satuan_terkecil
						WHERE produk_id='".$produk_id."'";
				$result = $this->db->query($sql);
				$nbrows = $result->num_rows();
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
		
		
		function get_produk_selected_list($gudang,$selected_id,$query,$start,$end){
			/*if($gudang==1){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode, satuan_nama FROM vu_stok_gudang_besar_saldo";
			}elseif($gudang==2){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode, satuan_nama FROM vu_stok_gudang_produk_saldo";
			}else{
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode, satuan_nama FROM vu_stok_gudang_all";
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." gudang_id =".$gudang."";
			}*/
			$sql="SELECT distinct produk_id,produk_kode,produk_nama,satuan_kode, satuan_nama FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			if($selected_id!=="")
			{
				$selected_id=substr($selected_id,0,strlen($selected_id)-1);
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_id IN(".$selected_id.")";
			}
			/*if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
			}*/
			
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
				
		function get_produk_all_list($gudang,$selected_id,$query,$start,$end){
			
			/*if($gudang==1){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,satuan_kode, satuan_nama,satuan_id,jumlah_stok FROM vu_stok_gudang_besar_saldo";
			}elseif($gudang==2){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,satuan_kode, satuan_nama,satuan_id,jumlah_stok FROM vu_stok_gudang_produk_saldo";
			}else{
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,satuan_kode, satuan_nama,satuan_id,jumlah_stok FROM vu_stok_gudang_all";
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." gudang_id =".$gudang."";
			}
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
			}*/
			$sql="SELECT distinct produk_id,produk_kode,produk_nama,satuan_kode, satuan_nama FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
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
		
			
		function get_produk_detail_list($gudang,$master_id,$query,$start,$end){
			/*if($gudang==1){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode, satuan_nama FROM vu_stok_gudang_besar_saldo";
			}elseif($gudang==2){
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode, satuan_nama FROM vu_stok_gudang_produk_saldo";
			}else{
				$sql="SELECT distinct produk_id,produk_kode,produk_nama,jumlah_stok,satuan_kode, satuan_nama FROM vu_stok_gudang_all";
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." gudang_id =".$gudang."";
			}
			*/
			
			$sql="SELECT distinct produk_id,produk_kode,produk_nama,satuan_kode, satuan_nama FROM vu_produk_satuan_default";
			
			if($master_id<>""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ");
				$sql.=" produk_id IN(SELECT dkoreksi_produk FROM detail_koreksi_stok WHERE dkoreksi_master='".$master_id."') ORDER by produk_id ASC";
			}
			
			/*if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
			}*/
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			/*$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);  
			*/
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
		
		function get_satuan_produk_list($selected_id){
			
			$sql="SELECT satuan_id,satuan_kode,satuan_nama,konversi_nilai FROM vu_satuan_konversi WHERE produk_aktif='Aktif'";
			
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
			$sql="SELECT satuan_id,satuan_kode,satuan_nama,konversi_nilai FROM vu_satuan_konversi";
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
			$sql="SELECT satuan_id,satuan_kode,satuan_nama,konversi_nilai FROM vu_satuan_konversi";
			if($master_id<>"")
				$sql.=" WHERE satuan_id IN(SELECT dkoreksi_satuan FROM detail_koreksi_stok WHERE dkoreksi_master='".$master_id."')";
			
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
		
		//function for detail
		//get record list
		function detail_detail_koreksi_stok_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_koreksi_stok WHERE dkoreksi_master='".$master_id."' AND dkoreksi_produk<>0 ORDER by dkoreksi_produk ASC";
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
		//end of function
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(koreksi_id) as master_id from master_koreksi_stok";
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
		
		//purge all detail from master
		function detail_detail_koreksi_stok_purge($master_id){
			$sql="DELETE from detail_koreksi_stok where dkoreksi_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_koreksi_stok_insert($dkoreksi_id ,$dkoreksi_master ,$dkoreksi_produk ,$dkoreksi_satuan ,$dkoreksi_jmlawal ,$dkoreksi_jmlkoreksi ,$dkoreksi_jmlsaldo ,$dkoreksi_ket ){
			//if master id not capture from view then capture it from max pk from master table
			if($dkoreksi_master=="" || $dkoreksi_master==NULL){
				$dkoreksi_master=$this->get_master_id();
			}
			
			$data = array(
				"dkoreksi_master"=>$dkoreksi_master, 
				"dkoreksi_produk"=>$dkoreksi_produk, 
				"dkoreksi_satuan"=>$dkoreksi_satuan, 
				"dkoreksi_jmlawal"=>$dkoreksi_jmlawal, 
				"dkoreksi_jmlkoreksi"=>$dkoreksi_jmlkoreksi, 
				"dkoreksi_jmlsaldo"=>$dkoreksi_jmlsaldo, 
				"dkoreksi_ket"=>$dkoreksi_ket 
			);
			$this->db->insert('detail_koreksi_stok', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_koreksi_stok_list($filter,$start,$end){
			$query = "SELECT distinct * FROM master_koreksi_stok,gudang WHERE koreksi_gudang=gudang_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (koreksi_id LIKE '%".addslashes($filter)."%' OR koreksi_gudang LIKE '%".addslashes($filter)."%' OR koreksi_tanggal LIKE '%".addslashes($filter)."%' OR koreksi_keterangan LIKE '%".addslashes($filter)."%' )";
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
		
		//function for update record
		function master_koreksi_stok_update($koreksi_id , $koreksi_no, $koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan, $koreksi_status){
			$data = array(
				"koreksi_id"=>$koreksi_id, 
				"koreksi_no"=>$koreksi_no,
//				"koreksi_gudang"=>$koreksi_gudang, 
				"koreksi_tanggal"=>$koreksi_tanggal, 
				"koreksi_keterangan"=>$koreksi_keterangan,
				"koreksi_status"=>$koreksi_status
			);
			$sql="SELECT gudang_id FROM gudang WHERE gudang_id='".$koreksi_gudang."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["koreksi_gudang"]=$koreksi_gudang;
			
			$this->db->where('koreksi_id', $koreksi_id);
			$this->db->update('master_koreksi_stok', $data);
			
			return $koreksi_id;
		}
		
		//function for create new record
		function master_koreksi_stok_create($koreksi_no, $koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan, $koreksi_status){
			$pattern="PS/".date("ym")."-";
			$koreksi_no=$this->m_public_function->get_kode_1('master_koreksi_stok','koreksi_no',$pattern,12);
			
			$data = array(
				"koreksi_no"=>$koreksi_no,
				"koreksi_gudang"=>$koreksi_gudang, 
				"koreksi_tanggal"=>$koreksi_tanggal, 
				"koreksi_keterangan"=>$koreksi_keterangan,
				"koreksi_status"=>$koreksi_status
			);
			$this->db->insert('master_koreksi_stok', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_koreksi_stok_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_koreksi_stoks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE master_koreksi_stok,detail_koreksi_stok  
							FROM master_koreksi_stok,detail_koreksi_stok WHERE koreksi_id=dkoreksi_master AND koreksi_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE master_koreksi_stok,detail_koreksi_stok  
							FROM master_koreksi_stok,detail_koreksi_stok WHERE koreksi_id=dkoreksi_master AND (";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "koreksi_id= ".$pkid[$i];
					if($i<sizeof($pkid)-1){
						$query = $query . " OR ";
					}     
				}
				$query.=")";
				$this->db->query($query);
			}
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '0';
		}
		
		//function for advanced search record
		function master_koreksi_stok_search($koreksi_id , $koreksi_no, $koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan, $koreksi_status, $start,$end){
			//full query
			$query="SELECT distinct * FROM master_koreksi_stok,gudang WHERE koreksi_gudang=gudang_id";
			
			if($koreksi_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_id LIKE '%".$koreksi_id."%'";
			};
			
			if($koreksi_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_no LIKE '%".$koreksi_no."%'";
			};
			
			if($koreksi_gudang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_gudang LIKE '%".$koreksi_gudang."%'";
			};
			if($koreksi_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_tanggal LIKE '%".$koreksi_tanggal."%'";
			};
			if($koreksi_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_keterangan LIKE '%".$koreksi_keterangan."%'";
			};
			if($koreksi_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_status LIKE '%".$koreksi_status."%'";
			};
			
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
		function master_koreksi_stok_print($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$option,$filter){
			//full query
			$query="select * from master_koreksi_stok";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (koreksi_id LIKE '%".addslashes($filter)."%' OR koreksi_gudang LIKE '%".addslashes($filter)."%' OR koreksi_tanggal LIKE '%".addslashes($filter)."%' OR koreksi_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($koreksi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_id LIKE '%".$koreksi_id."%'";
				};
				if($koreksi_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_gudang LIKE '%".$koreksi_gudang."%'";
				};
				if($koreksi_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_tanggal LIKE '%".$koreksi_tanggal."%'";
				};
				if($koreksi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_keterangan LIKE '%".$koreksi_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_koreksi_stok_export_excel($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$option,$filter){
			//full query
			$query="select * from master_koreksi_stok";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (koreksi_id LIKE '%".addslashes($filter)."%' OR koreksi_gudang LIKE '%".addslashes($filter)."%' OR koreksi_tanggal LIKE '%".addslashes($filter)."%' OR koreksi_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($koreksi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_id LIKE '%".$koreksi_id."%'";
				};
				if($koreksi_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_gudang LIKE '%".$koreksi_gudang."%'";
				};
				if($koreksi_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_tanggal LIKE '%".$koreksi_tanggal."%'";
				};
				if($koreksi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_keterangan LIKE '%".$koreksi_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>