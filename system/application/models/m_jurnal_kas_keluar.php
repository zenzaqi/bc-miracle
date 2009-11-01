<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_kas_keluar Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_kas_keluar.php
 	+ Author  		: 
 	+ Created on 03/Oct/2009 13:09:57
	
*/

class M_jurnal_kas_keluar extends Model{
		
		//constructor
		function M_jurnal_kas_keluar() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_jurnal_kas_keluar_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM jurnal_kas_keluar_detail where djkkas_master='".$master_id."'";
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
			$query = "SELECT max(jkkas_id) as master_id from jurnal_kas_keluar";
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
		function detail_jurnal_kas_keluar_detail_purge($master_id){
			$sql="DELETE from jurnal_kas_keluar_detail where djkkas_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_jurnal_kas_keluar_detail_insert($djkkas_id ,$djkkas_master ,$djkkas_akun ,$djkkas_keterangan ,$djkkas_nilai ){
			//if master id not capture from view then capture it from max pk from master table
			if($djkkas_master=="" || $djkkas_master==NULL){
				$djkkas_master=$this->get_master_id();
			}
			
			$data = array(
				"djkkas_master"=>$djkkas_master, 
				"djkkas_akun"=>$djkkas_akun, 
				"djkkas_keterangan"=>$djkkas_keterangan, 
				"djkkas_nilai"=>$djkkas_nilai 
			);
			$this->db->insert('jurnal_kas_keluar_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function jurnal_kas_keluar_list($filter,$start,$end){
			$query = "SELECT * FROM jurnal_kas_keluar,akun WHERE jkkas_akun=akun_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jkkas_id LIKE '%".addslashes($filter)."%' OR jkkas_akun LIKE '%".addslashes($filter)."%' OR jkkas_tanggal LIKE '%".addslashes($filter)."%' OR jkkas_keterangan LIKE '%".addslashes($filter)."%' OR jkkas_nilai LIKE '%".addslashes($filter)."%' OR jkkas_pemakai LIKE '%".addslashes($filter)."%' OR jkkas_ref LIKE '%".addslashes($filter)."%' OR jkkas_posting LIKE '%".addslashes($filter)."%' OR jkkas_tglposting LIKE '%".addslashes($filter)."%' )";
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
		function jurnal_kas_keluar_update($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ){
			$data = array(
				"jkkas_id"=>$jkkas_id, 
				"jkkas_akun"=>$jkkas_akun, 
				"jkkas_tanggal"=>$jkkas_tanggal, 
				"jkkas_keterangan"=>$jkkas_keterangan, 
				"jkkas_nilai"=>$jkkas_nilai, 
				"jkkas_pemakai"=>$jkkas_pemakai, 
				"jkkas_ref"=>$jkkas_ref, 
				"jkkas_posting"=>$jkkas_posting, 
				"jkkas_tglposting"=>$jkkas_tglposting 
			);
			$this->db->where('jkkas_id', $jkkas_id);
			$this->db->update('jurnal_kas_keluar', $data);
			
			return '1';
		}
		
		//function for create new record
		function jurnal_kas_keluar_create($jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ){
			$data = array(
				"jkkas_akun"=>$jkkas_akun, 
				"jkkas_tanggal"=>$jkkas_tanggal, 
				"jkkas_keterangan"=>$jkkas_keterangan, 
				"jkkas_nilai"=>$jkkas_nilai, 
				"jkkas_pemakai"=>$jkkas_pemakai, 
				"jkkas_ref"=>$jkkas_ref, 
				"jkkas_posting"=>$jkkas_posting, 
				"jkkas_tglposting"=>$jkkas_tglposting 
			);
			$this->db->insert('jurnal_kas_keluar', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jurnal_kas_keluar_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jurnal_kas_keluars at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jurnal_kas_keluar WHERE jkkas_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jurnal_kas_keluar WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jkkas_id= ".$pkid[$i];
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
		function jurnal_kas_keluar_search($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ,$start,$end){
			//full query
			$query="select * from jurnal_kas_keluar";
			
			if($jkkas_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_id LIKE '%".$jkkas_id."%'";
			};
			if($jkkas_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_akun LIKE '%".$jkkas_akun."%'";
			};
			if($jkkas_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_tanggal LIKE '%".$jkkas_tanggal."%'";
			};
			if($jkkas_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_keterangan LIKE '%".$jkkas_keterangan."%'";
			};
			if($jkkas_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_nilai LIKE '%".$jkkas_nilai."%'";
			};
			if($jkkas_pemakai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_pemakai LIKE '%".$jkkas_pemakai."%'";
			};
			if($jkkas_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_ref LIKE '%".$jkkas_ref."%'";
			};
			if($jkkas_posting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_posting LIKE '%".$jkkas_posting."%'";
			};
			if($jkkas_tglposting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jkkas_tglposting LIKE '%".$jkkas_tglposting."%'";
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
		function jurnal_kas_keluar_print($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_kas_keluar";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jkkas_id LIKE '%".addslashes($filter)."%' OR jkkas_akun LIKE '%".addslashes($filter)."%' OR jkkas_tanggal LIKE '%".addslashes($filter)."%' OR jkkas_keterangan LIKE '%".addslashes($filter)."%' OR jkkas_nilai LIKE '%".addslashes($filter)."%' OR jkkas_pemakai LIKE '%".addslashes($filter)."%' OR jkkas_ref LIKE '%".addslashes($filter)."%' OR jkkas_posting LIKE '%".addslashes($filter)."%' OR jkkas_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jkkas_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_id LIKE '%".$jkkas_id."%'";
				};
				if($jkkas_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_akun LIKE '%".$jkkas_akun."%'";
				};
				if($jkkas_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_tanggal LIKE '%".$jkkas_tanggal."%'";
				};
				if($jkkas_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_keterangan LIKE '%".$jkkas_keterangan."%'";
				};
				if($jkkas_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_nilai LIKE '%".$jkkas_nilai."%'";
				};
				if($jkkas_pemakai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_pemakai LIKE '%".$jkkas_pemakai."%'";
				};
				if($jkkas_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_ref LIKE '%".$jkkas_ref."%'";
				};
				if($jkkas_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_posting LIKE '%".$jkkas_posting."%'";
				};
				if($jkkas_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_tglposting LIKE '%".$jkkas_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jurnal_kas_keluar_export_excel($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_kas_keluar";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jkkas_id LIKE '%".addslashes($filter)."%' OR jkkas_akun LIKE '%".addslashes($filter)."%' OR jkkas_tanggal LIKE '%".addslashes($filter)."%' OR jkkas_keterangan LIKE '%".addslashes($filter)."%' OR jkkas_nilai LIKE '%".addslashes($filter)."%' OR jkkas_pemakai LIKE '%".addslashes($filter)."%' OR jkkas_ref LIKE '%".addslashes($filter)."%' OR jkkas_posting LIKE '%".addslashes($filter)."%' OR jkkas_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jkkas_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_id LIKE '%".$jkkas_id."%'";
				};
				if($jkkas_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_akun LIKE '%".$jkkas_akun."%'";
				};
				if($jkkas_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_tanggal LIKE '%".$jkkas_tanggal."%'";
				};
				if($jkkas_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_keterangan LIKE '%".$jkkas_keterangan."%'";
				};
				if($jkkas_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_nilai LIKE '%".$jkkas_nilai."%'";
				};
				if($jkkas_pemakai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_pemakai LIKE '%".$jkkas_pemakai."%'";
				};
				if($jkkas_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_ref LIKE '%".$jkkas_ref."%'";
				};
				if($jkkas_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_posting LIKE '%".$jkkas_posting."%'";
				};
				if($jkkas_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jkkas_tglposting LIKE '%".$jkkas_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>