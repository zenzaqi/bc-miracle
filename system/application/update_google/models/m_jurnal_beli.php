<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_beli Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_beli.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:22:37
	
*/

class M_jurnal_beli extends Model{
		
		//constructor
		function M_jurnal_beli() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_jurnal_beli_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM jurnal_beli_detail where djbeli_master='".$master_id."'";
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
			$query = "SELECT max(jbeli_id) as master_id from jurnal_beli";
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
		function detail_jurnal_beli_detail_purge($master_id){
			$sql="DELETE from jurnal_beli_detail where djbeli_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_jurnal_beli_detail_insert($djbeli_id ,$djbeli_master ,$djbeli_keterangan ,$djbeli_akun ,$djbeli_nilai ){
			//if master id not capture from view then capture it from max pk from master table
			if($djbeli_master=="" || $djbeli_master==NULL){
				$djbeli_master=$this->get_master_id();
			}
			
			$data = array(
				"djbeli_master"=>$djbeli_master, 
				"djbeli_keterangan"=>$djbeli_keterangan, 
				"djbeli_akun"=>$djbeli_akun, 
				"djbeli_nilai"=>$djbeli_nilai 
			);
			$this->db->insert('jurnal_beli_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function jurnal_beli_list($filter,$start,$end){
			$query = "SELECT * FROM jurnal_beli,akun WHERE jbeli_akun=akun_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jbeli_id LIKE '%".addslashes($filter)."%' OR jbeli_tanggal LIKE '%".addslashes($filter)."%' OR jbeli_akun LIKE '%".addslashes($filter)."%' OR jbeli_keterangan LIKE '%".addslashes($filter)."%' OR jbeli_nilai LIKE '%".addslashes($filter)."%' OR jbeli_ref LIKE '%".addslashes($filter)."%' OR jbeli_penerima LIKE '%".addslashes($filter)."%' OR jbeli_posting LIKE '%".addslashes($filter)."%' OR jbeli_tglposting LIKE '%".addslashes($filter)."%' )";
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
		function jurnal_beli_update($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ){
			$data = array(
				"jbeli_id"=>$jbeli_id, 
				"jbeli_tanggal"=>$jbeli_tanggal, 
				"jbeli_akun"=>$jbeli_akun, 
				"jbeli_keterangan"=>$jbeli_keterangan, 
				"jbeli_nilai"=>$jbeli_nilai, 
				"jbeli_ref"=>$jbeli_ref, 
				"jbeli_penerima"=>$jbeli_penerima, 
				"jbeli_posting"=>$jbeli_posting, 
				"jbeli_tglposting"=>$jbeli_tglposting 
			);
			$this->db->where('jbeli_id', $jbeli_id);
			$this->db->update('jurnal_beli', $data);
			
			return '1';
		}
		
		//function for create new record
		function jurnal_beli_create($jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ){
			$data = array(
				"jbeli_tanggal"=>$jbeli_tanggal, 
				"jbeli_akun"=>$jbeli_akun, 
				"jbeli_keterangan"=>$jbeli_keterangan, 
				"jbeli_nilai"=>$jbeli_nilai, 
				"jbeli_ref"=>$jbeli_ref, 
				"jbeli_penerima"=>$jbeli_penerima, 
				"jbeli_posting"=>$jbeli_posting, 
				"jbeli_tglposting"=>$jbeli_tglposting 
			);
			$this->db->insert('jurnal_beli', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jurnal_beli_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jurnal_belis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jurnal_beli WHERE jbeli_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jurnal_beli WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jbeli_id= ".$pkid[$i];
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
		function jurnal_beli_search($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ,$start,$end){
			//full query
			$query="select * from jurnal_beli";
			
			if($jbeli_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_id LIKE '%".$jbeli_id."%'";
			};
			if($jbeli_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_tanggal LIKE '%".$jbeli_tanggal."%'";
			};
			if($jbeli_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_akun LIKE '%".$jbeli_akun."%'";
			};
			if($jbeli_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_keterangan LIKE '%".$jbeli_keterangan."%'";
			};
			if($jbeli_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_nilai LIKE '%".$jbeli_nilai."%'";
			};
			if($jbeli_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_ref LIKE '%".$jbeli_ref."%'";
			};
			if($jbeli_penerima!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_penerima LIKE '%".$jbeli_penerima."%'";
			};
			if($jbeli_posting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_posting LIKE '%".$jbeli_posting."%'";
			};
			if($jbeli_tglposting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbeli_tglposting LIKE '%".$jbeli_tglposting."%'";
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
		function jurnal_beli_print($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_beli";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jbeli_id LIKE '%".addslashes($filter)."%' OR jbeli_tanggal LIKE '%".addslashes($filter)."%' OR jbeli_akun LIKE '%".addslashes($filter)."%' OR jbeli_keterangan LIKE '%".addslashes($filter)."%' OR jbeli_nilai LIKE '%".addslashes($filter)."%' OR jbeli_ref LIKE '%".addslashes($filter)."%' OR jbeli_penerima LIKE '%".addslashes($filter)."%' OR jbeli_posting LIKE '%".addslashes($filter)."%' OR jbeli_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jbeli_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_id LIKE '%".$jbeli_id."%'";
				};
				if($jbeli_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_tanggal LIKE '%".$jbeli_tanggal."%'";
				};
				if($jbeli_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_akun LIKE '%".$jbeli_akun."%'";
				};
				if($jbeli_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_keterangan LIKE '%".$jbeli_keterangan."%'";
				};
				if($jbeli_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_nilai LIKE '%".$jbeli_nilai."%'";
				};
				if($jbeli_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_ref LIKE '%".$jbeli_ref."%'";
				};
				if($jbeli_penerima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_penerima LIKE '%".$jbeli_penerima."%'";
				};
				if($jbeli_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_posting LIKE '%".$jbeli_posting."%'";
				};
				if($jbeli_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_tglposting LIKE '%".$jbeli_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jurnal_beli_export_excel($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_beli";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jbeli_id LIKE '%".addslashes($filter)."%' OR jbeli_tanggal LIKE '%".addslashes($filter)."%' OR jbeli_akun LIKE '%".addslashes($filter)."%' OR jbeli_keterangan LIKE '%".addslashes($filter)."%' OR jbeli_nilai LIKE '%".addslashes($filter)."%' OR jbeli_ref LIKE '%".addslashes($filter)."%' OR jbeli_penerima LIKE '%".addslashes($filter)."%' OR jbeli_posting LIKE '%".addslashes($filter)."%' OR jbeli_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jbeli_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_id LIKE '%".$jbeli_id."%'";
				};
				if($jbeli_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_tanggal LIKE '%".$jbeli_tanggal."%'";
				};
				if($jbeli_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_akun LIKE '%".$jbeli_akun."%'";
				};
				if($jbeli_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_keterangan LIKE '%".$jbeli_keterangan."%'";
				};
				if($jbeli_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_nilai LIKE '%".$jbeli_nilai."%'";
				};
				if($jbeli_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_ref LIKE '%".$jbeli_ref."%'";
				};
				if($jbeli_penerima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_penerima LIKE '%".$jbeli_penerima."%'";
				};
				if($jbeli_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_posting LIKE '%".$jbeli_posting."%'";
				};
				if($jbeli_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbeli_tglposting LIKE '%".$jbeli_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>