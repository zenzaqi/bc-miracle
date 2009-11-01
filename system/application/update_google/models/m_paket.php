<? 
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 19/Aug/2009 16:12:06
	
*/

class M_paket extends Model{
		
		//constructor
		function M_paket() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_paket_isi_perawatan_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM paket_isi_perawatan,perawatan where rawat_id=rpaket_perawatan  and rpaket_master='".$master_id."'";
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
		
		function get_produk_group_list(){
			$result=$this->m_public_function->get_produk_group_list();
			echo $result;
		}
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(paket_id) as master_id from paket";
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
		function detail_paket_isi_perawatan_purge($master_id){
			$sql="DELETE from paket_isi_perawatan where rpaket_master='".$master_id."'";
			$result=$this->db->query($sql);
			echo '1';
		}
		//*eof
		
		//insert detail record
		function detail_paket_isi_perawatan_insert($rpaket_id ,$rpaket_master ,$rpaket_perawatan ,$rpaket_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($rpaket_master=="" || $rpaket_master==NULL){
				$rpaket_master=$this->get_master_id();
			}
			
			$data = array(
				"rpaket_master"=>$rpaket_master, 
				"rpaket_perawatan"=>$rpaket_perawatan, 
				"rpaket_jumlah"=>$rpaket_jumlah 
			);
			$this->db->insert('paket_isi_perawatan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//DETAIL PRODUK FUNCTION
		//get record list
		function detail_paket_isi_produk_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM paket_isi_produk,produk,satuan where ipaket_produk=produk_id and ipaket_master='".$master_id."' and satuan_id=ipaket_satuan";
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
		
	
		//purge all detail from master
		function detail_paket_isi_produk_purge($master_id){
			$sql="DELETE from paket_isi_produk where ipaket_master='".$master_id."'";
			$result=$this->db->query($sql);
			echo '1';
		}
		//*eof
		
		//insert detail record
		function detail_paket_isi_produk_insert($ipaket_id ,$ipaket_master ,$ipaket_produk ,$ipaket_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($ipaket_master=="" || $ipaket_master==NULL){
				$ipaket_master=$this->get_master_id();
			}
			
			
			$data = array(
				"ipaket_master"=>$ipaket_master, 
				"ipaket_produk"=>$ipaket_produk, 
				"ipaket_jumlah"=>$ipaket_jumlah 
			);
			
			$sql="select produk_satuan from produk where produk_id='".$ipaket_produk."'";
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$result=$query->row();
				$data["ipaket_satuan"]=$result->produk_satuan;
			}
			$query->free_result();
			
			$this->db->insert('paket_isi_produk', $data); 
			//echo $this->db->last_query();
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		function get_kode($pattern){
			$result=$this->m_public_function->get_kode_1("paket","paket_kode",$pattern,4);
			return $result;
		}
		
		//function for get list record
		function paket_list($filter,$start,$end){
			$query = "SELECT * FROM paket,produk_group where paket_group=group_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_group LIKE '%".addslashes($filter)."%' OR paket_keterangan LIKE '%".addslashes($filter)."%' OR paket_du LIKE '%".addslashes($filter)."%' OR paket_dm LIKE '%".addslashes($filter)."%' OR paket_point LIKE '%".addslashes($filter)."%' OR paket_harga LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' OR paket_aktif LIKE '%".addslashes($filter)."%' )";
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
		function paket_update($paket_id ,$paket_kode, $paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ){
		if ($paket_aktif=="")
			$paket_aktif = "Aktif";
			$data = array(
				"paket_id"=>$paket_id, 
				"paket_nama"=>$paket_nama, 
				"paket_kodelama"=>$paket_kodelama, 
//				"paket_group"=>$paket_group, 
				"paket_keterangan"=>$paket_keterangan, 
//				"paket_du"=>$paket_du, 
//				"paket_dm"=>$paket_dm, 
				"paket_point"=>$paket_point, 
				"paket_harga"=>$paket_harga, 
				"paket_expired"=>$paket_expired, 
				"paket_aktif"=>$paket_aktif 
			);
			$sql="SELECT group_id,group_dupaket,group_dmpaket FROM produk_group WHERE group_id='".$paket_group."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$data["paket_group"]=$paket_group;
				$rs_sql=$rs->row();
				$data["paket_du"]=$rs_sql->group_dupaket;
				$data["paket_dm"]=$rs_sql->group_dmpaket;
			}
			
			$sql="SELECT group_id, group_kode FROM paket,produk_group WHERE group_id='".$paket_group."' AND paket.paket_group!='".$paket_group."' AND paket_id='".$paket_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql_2="SELECT paket_id,paket_kode FROM paket WHERE paket_id='".$produk_id."'";
				$rs_2=$this->db->query($sql_2);
				if($rs->num_rows()){
					$rs_sql_2=$rs_2->row();
					$data["paket_kodelama"]=$rs_sql_2->paket_kode;
				}
				
				$row=$rs->row();
				$data["paket_group"]=$paket_group;
				$data["paket_kode"]=$this->get_kode($row->group_kode);
			}
			
			$sql="SELECT paket_du FROM paket WHERE paket_du!='".$paket_du."' AND paket_id='".$paket_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["paket_du"]=$paket_du;
			
			$sql="SELECT paket_dm FROM paket WHERE paket_dm!='".$paket_dm."' AND paket_id='".$paket_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["paket_dm"]=$paket_dm;
			
			$this->db->where('paket_id', $paket_id);
			$this->db->update('paket', $data);
			
			return '1';
		}
		
		//function for create new record
		function paket_create($paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ){
		if ($paket_aktif=="")
			$paket_aktif = "Aktif";
			$data = array(
				"paket_kodelama"=>$paket_kodelama, 
				"paket_nama"=>$paket_nama, 
				"paket_group"=>$paket_group,
				"paket_keterangan"=>$paket_keterangan, 
				"paket_du"=>$paket_du, 
				"paket_dm"=>$paket_dm, 
				"paket_point"=>$paket_point, 
				"paket_harga"=>$paket_harga, 
				"paket_expired"=>$paket_expired, 
				"paket_aktif"=>$paket_aktif 
			);
			$sql="SELECT group_id, group_kode FROM produk_group WHERE group_id='".$paket_group."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$row=$rs->row();
				$data["paket_kode"]=$this->get_kode($row->group_kode);
			}
			
			$this->db->insert('paket', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function paket_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the pakets at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM paket WHERE paket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "paket_id= ".$pkid[$i];
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
		function paket_search($paket_id ,$paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ,$start,$end){
			//full query
			$query="select * from paket,produk_group where paket_group=group_id";
			
			if($paket_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_id LIKE '%".$paket_id."%'";
			};
			if($paket_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_kode LIKE '%".$paket_kode."%'";
			};
			if($paket_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_nama LIKE '%".$paket_nama."%'";
			};
			if($paket_group!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_group LIKE '%".$paket_group."%'";
			};
			if($paket_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_keterangan LIKE '%".$paket_keterangan."%'";
			};
			if($paket_du!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_du LIKE '%".$paket_du."%'";
			};
			if($paket_dm!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_dm LIKE '%".$paket_dm."%'";
			};
			if($paket_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_point LIKE '%".$paket_point."%'";
			};
			if($paket_harga!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_harga LIKE '%".$paket_harga."%'";
			};
			if($paket_expired!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_expired LIKE '%".$paket_expired."%'";
			};
			if($paket_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_aktif LIKE '%".$paket_aktif."%'";
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
		function paket_print($paket_id ,$paket_kode ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ,$option,$filter){
			//full query
			$query="select * from paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_group LIKE '%".addslashes($filter)."%' OR paket_keterangan LIKE '%".addslashes($filter)."%' OR paket_du LIKE '%".addslashes($filter)."%' OR paket_dm LIKE '%".addslashes($filter)."%' OR paket_point LIKE '%".addslashes($filter)."%' OR paket_harga LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' OR paket_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($paket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_id LIKE '%".$paket_id."%'";
				};
				if($paket_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_kode LIKE '%".$paket_kode."%'";
				};
				if($paket_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_nama LIKE '%".$paket_nama."%'";
				};
				if($paket_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_group LIKE '%".$paket_group."%'";
				};
				if($paket_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_keterangan LIKE '%".$paket_keterangan."%'";
				};
				if($paket_du!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_du LIKE '%".$paket_du."%'";
				};
				if($paket_dm!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_dm LIKE '%".$paket_dm."%'";
				};
				if($paket_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_point LIKE '%".$paket_point."%'";
				};
				if($paket_harga!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_harga LIKE '%".$paket_harga."%'";
				};
				if($paket_expired!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_expired LIKE '%".$paket_expired."%'";
				};
				if($paket_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_aktif LIKE '%".$paket_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function paket_export_excel($paket_id ,$paket_kode ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ,$option,$filter){
			//full query
			$query="select * from paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_group LIKE '%".addslashes($filter)."%' OR paket_keterangan LIKE '%".addslashes($filter)."%' OR paket_du LIKE '%".addslashes($filter)."%' OR paket_dm LIKE '%".addslashes($filter)."%' OR paket_point LIKE '%".addslashes($filter)."%' OR paket_harga LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' OR paket_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($paket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_id LIKE '%".$paket_id."%'";
				};
				if($paket_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_kode LIKE '%".$paket_kode."%'";
				};
				if($paket_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_nama LIKE '%".$paket_nama."%'";
				};
				if($paket_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_group LIKE '%".$paket_group."%'";
				};
				if($paket_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_keterangan LIKE '%".$paket_keterangan."%'";
				};
				if($paket_du!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_du LIKE '%".$paket_du."%'";
				};
				if($paket_dm!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_dm LIKE '%".$paket_dm."%'";
				};
				if($paket_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_point LIKE '%".$paket_point."%'";
				};
				if($paket_harga!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_harga LIKE '%".$paket_harga."%'";
				};
				if($paket_expired!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_expired LIKE '%".$paket_expired."%'";
				};
				if($paket_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_aktif LIKE '%".$paket_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>