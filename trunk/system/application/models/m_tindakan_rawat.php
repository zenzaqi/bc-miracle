<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan_rawat Model
	+ Description	: For record model process back-end
	+ Filename 		: c_tindakan_rawat.php
 	+ Author  		: 
 	+ Created on 02/Sep/2009 12:35:55
	
*/

class M_tindakan_rawat extends Model{
		
		//constructor
		function M_tindakan_rawat() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_tindakan_rawat_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM tindakan_rawat_detail where dtrawat_master='".$master_id."'";
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
			$query = "SELECT max(trawat_id) as master_id from tindakan_rawat";
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
		function detail_tindakan_rawat_detail_purge($master_id){
			$sql="DELETE from tindakan_rawat_detail where dtrawat_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_tindakan_rawat_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_status ){
			//if master id not capture from view then capture it from max pk from master table
			if($dtrawat_master=="" || $dtrawat_master==NULL){
				$dtrawat_master=$this->get_master_id();
			}
			
			$data = array(
				"dtrawat_master"=>$dtrawat_master, 
				"dtrawat_perawatan"=>$dtrawat_perawatan, 
				"dtrawat_status"=>$dtrawat_status 
			);
			$this->db->insert('tindakan_rawat_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function tindakan_rawat_list($filter,$start,$end){
			$query = "SELECT * from vu_tindakan";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_petugas LIKE '%".addslashes($filter)."%' OR trawat_petugas2 LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function tindakan_rawat_update($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ){
			$data = array(
				"trawat_id"=>$trawat_id, 
				"trawat_cust"=>$trawat_cust, 
				"trawat_petugas"=>$trawat_petugas, 
				"trawat_petugas2"=>$trawat_petugas2, 
				"trawat_keterangan"=>$trawat_keterangan 
			);
			$this->db->where('trawat_id', $trawat_id);
			$this->db->update('tindakan_rawat', $data);
			
			return '1';
		}
		
		//function for create new record
		function tindakan_rawat_create($trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ){
			$data = array(
				"trawat_cust"=>$trawat_cust, 
				"trawat_petugas"=>$trawat_petugas, 
				"trawat_petugas2"=>$trawat_petugas2, 
				"trawat_keterangan"=>$trawat_keterangan 
			);
			$this->db->insert('tindakan_rawat', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function tindakan_rawat_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the tindakan_rawats at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM tindakan_rawat WHERE trawat_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM tindakan_rawat WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "trawat_id= ".$pkid[$i];
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
		function tindakan_rawat_search($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ,$start,$end){
			//full query
			$query="select * from tindakan_rawat";
			
			if($trawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_id LIKE '%".$trawat_id."%'";
			};
			if($trawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
			};
			if($trawat_petugas!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_petugas LIKE '%".$trawat_petugas."%'";
			};
			if($trawat_petugas2!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_petugas2 LIKE '%".$trawat_petugas2."%'";
			};
			if($trawat_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
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
		function tindakan_rawat_print($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_petugas LIKE '%".addslashes($filter)."%' OR trawat_petugas2 LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_petugas!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_petugas LIKE '%".$trawat_petugas."%'";
				};
				if($trawat_petugas2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_petugas2 LIKE '%".$trawat_petugas2."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function tindakan_rawat_export_excel($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_petugas LIKE '%".addslashes($filter)."%' OR trawat_petugas2 LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_petugas!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_petugas LIKE '%".$trawat_petugas."%'";
				};
				if($trawat_petugas2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_petugas2 LIKE '%".$trawat_petugas2."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>