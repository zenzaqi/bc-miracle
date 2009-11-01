<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_code Model
	+ Description	: For record model process back-end
	+ Filename 		: c_sms_code.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_sms_code extends Model{
		
		//constructor
		function M_sms_code() {
			parent::Model();
		}
		
		//function for get list record
		function sms_code_list($filter,$start,$end){
			$query = "SELECT * FROM sms_code";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (code_id LIKE '%".addslashes($filter)."%' OR code_name LIKE '%".addslashes($filter)."%' OR code_query LIKE '%".addslashes($filter)."%' )";
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
		function sms_code_update($code_id ,$code_name ,$code_query ){
			$data = array(
				"code_id"=>$code_id,			
				"code_name"=>$code_name,			
				"code_query"=>$code_query			
			);
			$this->db->where('code_id', $code_id);
			$this->db->update('sms_code', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function sms_code_create($code_name ,$code_query ){
			$data = array(
	
				"code_name"=>$code_name,	
				"code_query"=>$code_query	
			);
			$this->db->insert('sms_code', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function sms_code_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the sms_codes at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM sms_code WHERE code_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM sms_code WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "code_id= ".$pkid[$i];
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
		function sms_code_search($code_id ,$code_name ,$code_query ,$start,$end){
			//full query
			$query="select * from sms_code";
			
			if($code_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " code_id LIKE '%".$code_id."%'";
			};
			if($code_name!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " code_name LIKE '%".$code_name."%'";
			};
			if($code_query!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " code_query LIKE '%".$code_query."%'";
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
		function sms_code_print($code_id ,$code_name ,$code_query ,$option,$filter){
			//full query
			$query="select * from sms_code";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (code_id LIKE '%".addslashes($filter)."%' OR code_name LIKE '%".addslashes($filter)."%' OR code_query LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($code_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " code_id LIKE '%".$code_id."%'";
				};
				if($code_name!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " code_name LIKE '%".$code_name."%'";
				};
				if($code_query!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " code_query LIKE '%".$code_query."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function sms_code_export_excel($code_id ,$code_name ,$code_query ,$option,$filter){
			//full query
			$query="select * from sms_code";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (code_id LIKE '%".addslashes($filter)."%' OR code_name LIKE '%".addslashes($filter)."%' OR code_query LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($code_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " code_id LIKE '%".$code_id."%'";
				};
				if($code_name!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " code_name LIKE '%".$code_name."%'";
				};
				if($code_query!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " code_query LIKE '%".$code_query."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>