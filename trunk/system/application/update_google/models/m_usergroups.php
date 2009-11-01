<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: usergroups Model
	+ Description	: For record model process back-end
	+ Filename 		: c_usergroups.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 17/Jul/2009 11:36:16
	
*/

class M_usergroups extends Model{
		
		//constructor
		function M_usergroups() {
			parent::Model();
		}
		
		//function for get list record
		function usergroups_list($filter,$start,$end){
			$query = "SELECT * FROM usergroups";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (group_id LIKE '%".addslashes($filter)."%' OR group_name LIKE '%".addslashes($filter)."%' OR group_desc LIKE '%".addslashes($filter)."%' OR group_active LIKE '%".addslashes($filter)."%' )";
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
		function usergroups_update($group_id ,$group_name ,$group_desc ,$group_active ){
			$data = array(		
				"group_name"=>$group_name,			
				"group_desc"=>$group_desc,			
				"group_active"=>$group_active			
			);
			$this->db->where('group_id', $group_id);
			$this->db->update('usergroups', $data);
			
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function usergroups_create($group_name ,$group_desc ,$group_active ){
			$data = array(
	
				"group_name"=>$group_name,	
				"group_desc"=>$group_desc,	
				"group_active"=>$group_active	
			);
			$this->db->insert('usergroups', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function usergroups_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the usergroupss at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM usergroups WHERE group_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM usergroups WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "group_id= ".$pkid[$i];
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
		function usergroups_search($group_id ,$group_name ,$group_desc ,$group_active ,$start,$end){
			//full query
			$query="select * from usergroups";
			
			if($group_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_id LIKE '%".$group_id."%'";
			};
			if($group_name!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_name LIKE '%".$group_name."%'";
			};
			if($group_desc!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_desc LIKE '%".$group_desc."%'";
			};
			if($group_active!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_active LIKE '%".$group_active."%'";
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
		function usergroups_print($group_id ,$group_name ,$group_desc ,$group_active ,$option,$filter){
			//full query
			$query="select * from usergroups";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (group_id LIKE '%".addslashes($filter)."%' OR group_name LIKE '%".addslashes($filter)."%' OR group_desc LIKE '%".addslashes($filter)."%' OR group_active LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($group_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_id LIKE '%".$group_id."%'";
				};
				if($group_name!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_name LIKE '%".$group_name."%'";
				};
				if($group_desc!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_desc LIKE '%".$group_desc."%'";
				};
				if($group_active!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_active LIKE '%".$group_active."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function usergroups_export_excel($group_id ,$group_name ,$group_desc ,$group_active ,$option,$filter){
			//full query
			$query="select * from usergroups";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (group_id LIKE '%".addslashes($filter)."%' OR group_name LIKE '%".addslashes($filter)."%' OR group_desc LIKE '%".addslashes($filter)."%' OR group_active LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($group_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_id LIKE '%".$group_id."%'";
				};
				if($group_name!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_name LIKE '%".$group_name."%'";
				};
				if($group_desc!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_desc LIKE '%".$group_desc."%'";
				};
				if($group_active!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_active LIKE '%".$group_active."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>