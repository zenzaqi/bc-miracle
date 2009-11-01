<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_inbox Model
	+ Description	: For record model process back-end
	+ Filename 		: c_sms_inbox.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_sms_inbox extends Model{
		
		//constructor
		function M_sms_inbox() {
			parent::Model();
		}
		
		//function for get list record
		function sms_inbox_list($filter,$start,$end){
			$query = "SELECT * FROM sms_inbox";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (isms_id LIKE '%".addslashes($filter)."%' OR isms_number LIKE '%".addslashes($filter)."%' OR isms_tanggal LIKE '%".addslashes($filter)."%' OR isms_isi LIKE '%".addslashes($filter)."%' OR isms_status LIKE '%".addslashes($filter)."%' )";
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
		function sms_inbox_update($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ){
			$data = array(
				"isms_id"=>$isms_id,			
				"isms_number"=>$isms_number,			
				"isms_tanggal"=>$isms_tanggal,			
				"isms_isi"=>$isms_isi,			
				"isms_status"=>$isms_status			
			);
			$this->db->where('isms_id', $isms_id);
			$this->db->update('sms_inbox', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function sms_inbox_create($isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ){
			$data = array(
	
				"isms_number"=>$isms_number,	
				"isms_tanggal"=>$isms_tanggal,	
				"isms_isi"=>$isms_isi,	
				"isms_status"=>$isms_status	
			);
			$this->db->insert('sms_inbox', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function sms_inbox_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the sms_inboxs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM sms_inbox WHERE isms_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM sms_inbox WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "isms_id= ".$pkid[$i];
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
		function sms_inbox_search($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ,$start,$end){
			//full query
			$query="select * from sms_inbox";
			
			if($isms_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " isms_id LIKE '%".$isms_id."%'";
			};
			if($isms_number!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " isms_number LIKE '%".$isms_number."%'";
			};
			if($isms_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " isms_tanggal LIKE '%".$isms_tanggal."%'";
			};
			if($isms_isi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " isms_isi LIKE '%".$isms_isi."%'";
			};
			if($isms_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " isms_status LIKE '%".$isms_status."%'";
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
		function sms_inbox_print($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ,$option,$filter){
			//full query
			$query="select * from sms_inbox";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (isms_id LIKE '%".addslashes($filter)."%' OR isms_number LIKE '%".addslashes($filter)."%' OR isms_tanggal LIKE '%".addslashes($filter)."%' OR isms_isi LIKE '%".addslashes($filter)."%' OR isms_status LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($isms_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_id LIKE '%".$isms_id."%'";
				};
				if($isms_number!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_number LIKE '%".$isms_number."%'";
				};
				if($isms_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_tanggal LIKE '%".$isms_tanggal."%'";
				};
				if($isms_isi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_isi LIKE '%".$isms_isi."%'";
				};
				if($isms_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_status LIKE '%".$isms_status."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function sms_inbox_export_excel($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ,$option,$filter){
			//full query
			$query="select * from sms_inbox";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (isms_id LIKE '%".addslashes($filter)."%' OR isms_number LIKE '%".addslashes($filter)."%' OR isms_tanggal LIKE '%".addslashes($filter)."%' OR isms_isi LIKE '%".addslashes($filter)."%' OR isms_status LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($isms_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_id LIKE '%".$isms_id."%'";
				};
				if($isms_number!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_number LIKE '%".$isms_number."%'";
				};
				if($isms_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_tanggal LIKE '%".$isms_tanggal."%'";
				};
				if($isms_isi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_isi LIKE '%".$isms_isi."%'";
				};
				if($isms_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " isms_status LIKE '%".$isms_status."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>