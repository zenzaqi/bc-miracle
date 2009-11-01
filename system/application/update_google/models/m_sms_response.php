<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_response Model
	+ Description	: For record model process back-end
	+ Filename 		: c_sms_response.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_sms_response extends Model{
		
		//constructor
		function M_sms_response() {
			parent::Model();
		}
		
		//function for get list record
		function sms_response_list($filter,$start,$end){
			$query = "SELECT * FROM sms_response";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (response_id LIKE '%".addslashes($filter)."%' OR response_receive LIKE '%".addslashes($filter)."%' OR response_proccess LIKE '%".addslashes($filter)."%' OR response_reply LIKE '%".addslashes($filter)."%' OR response_security LIKE '%".addslashes($filter)."%' )";
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
		function sms_response_update($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ){
			$data = array(
				"response_id"=>$response_id,			
				"response_receive"=>$response_receive,			
				"response_proccess"=>$response_proccess,			
				"response_reply"=>$response_reply,			
				"response_security"=>$response_security			
			);
			$this->db->where('response_id', $response_id);
			$this->db->update('sms_response', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function sms_response_create($response_receive ,$response_proccess ,$response_reply ,$response_security ){
			$data = array(
	
				"response_receive"=>$response_receive,	
				"response_proccess"=>$response_proccess,	
				"response_reply"=>$response_reply,	
				"response_security"=>$response_security	
			);
			$this->db->insert('sms_response', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function sms_response_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the sms_responses at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM sms_response WHERE response_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM sms_response WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "response_id= ".$pkid[$i];
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
		function sms_response_search($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ,$start,$end){
			//full query
			$query="select * from sms_response";
			
			if($response_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " response_id LIKE '%".$response_id."%'";
			};
			if($response_receive!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " response_receive LIKE '%".$response_receive."%'";
			};
			if($response_proccess!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " response_proccess LIKE '%".$response_proccess."%'";
			};
			if($response_reply!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " response_reply LIKE '%".$response_reply."%'";
			};
			if($response_security!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " response_security LIKE '%".$response_security."%'";
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
		function sms_response_print($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ,$option,$filter){
			//full query
			$query="select * from sms_response";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (response_id LIKE '%".addslashes($filter)."%' OR response_receive LIKE '%".addslashes($filter)."%' OR response_proccess LIKE '%".addslashes($filter)."%' OR response_reply LIKE '%".addslashes($filter)."%' OR response_security LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($response_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_id LIKE '%".$response_id."%'";
				};
				if($response_receive!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_receive LIKE '%".$response_receive."%'";
				};
				if($response_proccess!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_proccess LIKE '%".$response_proccess."%'";
				};
				if($response_reply!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_reply LIKE '%".$response_reply."%'";
				};
				if($response_security!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_security LIKE '%".$response_security."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function sms_response_export_excel($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ,$option,$filter){
			//full query
			$query="select * from sms_response";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (response_id LIKE '%".addslashes($filter)."%' OR response_receive LIKE '%".addslashes($filter)."%' OR response_proccess LIKE '%".addslashes($filter)."%' OR response_reply LIKE '%".addslashes($filter)."%' OR response_security LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($response_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_id LIKE '%".$response_id."%'";
				};
				if($response_receive!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_receive LIKE '%".$response_receive."%'";
				};
				if($response_proccess!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_proccess LIKE '%".$response_proccess."%'";
				};
				if($response_reply!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_reply LIKE '%".$response_reply."%'";
				};
				if($response_security!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " response_security LIKE '%".$response_security."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>