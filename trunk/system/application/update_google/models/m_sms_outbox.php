<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_outbox Model
	+ Description	: For record model process back-end
	+ Filename 		: c_sms_outbox.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_sms_outbox extends Model{
		
		//constructor
		function M_sms_outbox() {
			parent::Model();
		}
		
		//function for get list record
		function sms_outbox_list($filter,$start,$end){
			$query = "SELECT * FROM sms_outbox";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (osms_id LIKE '%".addslashes($filter)."%' OR osms_dest LIKE '%".addslashes($filter)."%' OR osms_tanggal LIKE '%".addslashes($filter)."%' OR osms_isi LIKE '%".addslashes($filter)."%' OR osms_status LIKE '%".addslashes($filter)."%' OR osms_kategori LIKE '%".addslashes($filter)."%' OR osms_ready LIKE '%".addslashes($filter)."%' )";
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
		function sms_outbox_update($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ){
			$data = array(
				"osms_id"=>$osms_id,			
				"osms_dest"=>$osms_dest,			
				"osms_tanggal"=>$osms_tanggal,			
				"osms_isi"=>$osms_isi,			
				"osms_status"=>$osms_status,			
				"osms_kategori"=>$osms_kategori,			
				"osms_ready"=>$osms_ready			
			);
			$this->db->where('osms_id', $osms_id);
			$this->db->update('sms_outbox', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function sms_outbox_create($osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ){
			$data = array(
	
				"osms_dest"=>$osms_dest,	
				"osms_tanggal"=>$osms_tanggal,	
				"osms_isi"=>$osms_isi,	
				"osms_status"=>$osms_status,	
				"osms_kategori"=>$osms_kategori,	
				"osms_ready"=>$osms_ready	
			);
			$this->db->insert('sms_outbox', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function sms_outbox_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the sms_outboxs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM sms_outbox WHERE osms_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM sms_outbox WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "osms_id= ".$pkid[$i];
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
		function sms_outbox_search($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ,$start,$end){
			//full query
			$query="select * from sms_outbox";
			
			if($osms_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_id LIKE '%".$osms_id."%'";
			};
			if($osms_dest!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_dest LIKE '%".$osms_dest."%'";
			};
			if($osms_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_tanggal LIKE '%".$osms_tanggal."%'";
			};
			if($osms_isi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_isi LIKE '%".$osms_isi."%'";
			};
			if($osms_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_status LIKE '%".$osms_status."%'";
			};
			if($osms_kategori!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_kategori LIKE '%".$osms_kategori."%'";
			};
			if($osms_ready!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " osms_ready LIKE '%".$osms_ready."%'";
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
		function sms_outbox_print($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ,$option,$filter){
			//full query
			$query="select * from sms_outbox";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (osms_id LIKE '%".addslashes($filter)."%' OR osms_dest LIKE '%".addslashes($filter)."%' OR osms_tanggal LIKE '%".addslashes($filter)."%' OR osms_isi LIKE '%".addslashes($filter)."%' OR osms_status LIKE '%".addslashes($filter)."%' OR osms_kategori LIKE '%".addslashes($filter)."%' OR osms_ready LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($osms_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_id LIKE '%".$osms_id."%'";
				};
				if($osms_dest!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_dest LIKE '%".$osms_dest."%'";
				};
				if($osms_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_tanggal LIKE '%".$osms_tanggal."%'";
				};
				if($osms_isi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_isi LIKE '%".$osms_isi."%'";
				};
				if($osms_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_status LIKE '%".$osms_status."%'";
				};
				if($osms_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_kategori LIKE '%".$osms_kategori."%'";
				};
				if($osms_ready!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_ready LIKE '%".$osms_ready."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function sms_outbox_export_excel($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ,$option,$filter){
			//full query
			$query="select * from sms_outbox";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (osms_id LIKE '%".addslashes($filter)."%' OR osms_dest LIKE '%".addslashes($filter)."%' OR osms_tanggal LIKE '%".addslashes($filter)."%' OR osms_isi LIKE '%".addslashes($filter)."%' OR osms_status LIKE '%".addslashes($filter)."%' OR osms_kategori LIKE '%".addslashes($filter)."%' OR osms_ready LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($osms_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_id LIKE '%".$osms_id."%'";
				};
				if($osms_dest!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_dest LIKE '%".$osms_dest."%'";
				};
				if($osms_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_tanggal LIKE '%".$osms_tanggal."%'";
				};
				if($osms_isi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_isi LIKE '%".$osms_isi."%'";
				};
				if($osms_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_status LIKE '%".$osms_status."%'";
				};
				if($osms_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_kategori LIKE '%".$osms_kategori."%'";
				};
				if($osms_ready!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " osms_ready LIKE '%".$osms_ready."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>