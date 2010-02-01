<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: draft Model
	+ Description	: For record model process back-end
	+ Filename 		: c_draft.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/

class M_draft extends Model{
		
		//constructor
		function M_draft() {
			parent::Model();
		}
		
		//function for get list record
		function draft_list($filter,$start,$end){
			$query = "SELECT * FROM draft";
			
			// For simple search
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (draft_id LIKE '%".addslashes($filter)."%' OR draft_destination LIKE '%".addslashes($filter)."%' OR draft_message LIKE '%".addslashes($filter)."%' OR draft_date LIKE '%".addslashes($filter)."%' OR draft_creator LIKE '%".addslashes($filter)."%' OR draft_date_create LIKE '%".addslashes($filter)."%' OR draft_update LIKE '%".addslashes($filter)."%' OR draft_date_update LIKE '%".addslashes($filter)."%' OR draft_revised LIKE '%".addslashes($filter)."%' )";
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
		
		//function for create new record
		function draft_create($draft_destination ,$draft_message ,$draft_date ,$draft_creator ,$draft_date_create ){
			$data = array(
				"draft_destination"=>$draft_destination, 
				"draft_message"=>$draft_message, 
				"draft_date"=>$draft_date, 
				"draft_creator"=>$draft_creator, 
				"draft_date_create"=>$draft_date_create 
			);
			$this->db->insert('draft', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for update record
		function draft_update($draft_id,$draft_destination,$draft_message,$draft_date,$draft_creator,$draft_update,$draft_date_update){
			$data = array(
				"draft_destination"=>$draft_destination, 
				"draft_message"=>$draft_message, 
				"draft_date"=>$draft_date, 
				"draft_creator"=>$draft_creator, 
				"draft_update"=>$draft_update, 
				"draft_date_update"=>$draft_date_update 
			);
			
			$this->db->where('draft_id', $draft_id);
			$this->db->update('draft', $data);
			$sql="UPDATE draft set draft_revised=(draft_revised+1) where draft_id='".$draft_id."'";
			$this->db->query($sql);
			return '1';
		}
		
		//fcuntion for delete record
		function draft_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the drafts at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM draft WHERE draft_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM draft WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "draft_id= ".$pkid[$i];
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
		function draft_search($draft_id ,$draft_destination ,$draft_message ,$draft_date ,$draft_creator ,$draft_date_create ,$draft_update ,$draft_date_update ,$draft_revised ,$start,$end){
			//full query
			$query="select * from draft";
			
			if($draft_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_id LIKE '%".$draft_id."%'";
			};
			if($draft_destination!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_destination LIKE '%".$draft_destination."%'";
			};
			if($draft_message!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_message LIKE '%".$draft_message."%'";
			};
			if($draft_date!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_date LIKE '%".$draft_date."%'";
			};
			if($draft_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_creator LIKE '%".$draft_creator."%'";
			};
			if($draft_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_date_create LIKE '%".$draft_date_create."%'";
			};
			if($draft_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_update LIKE '%".$draft_update."%'";
			};
			if($draft_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_date_update LIKE '%".$draft_date_update."%'";
			};
			if($draft_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " draft_revised LIKE '%".$draft_revised."%'";
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
		function draft_print($draft_id ,$draft_destination ,$draft_message ,$draft_date ,$draft_creator ,$draft_date_create ,$draft_update ,$draft_date_update ,$draft_revised ,$option,$filter){
			//full query
			$sql="select * from draft";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (draft_id LIKE '%".addslashes($filter)."%' OR draft_destination LIKE '%".addslashes($filter)."%' OR draft_message LIKE '%".addslashes($filter)."%' OR draft_date LIKE '%".addslashes($filter)."%' OR draft_creator LIKE '%".addslashes($filter)."%' OR draft_date_create LIKE '%".addslashes($filter)."%' OR draft_update LIKE '%".addslashes($filter)."%' OR draft_date_update LIKE '%".addslashes($filter)."%' OR draft_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($draft_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_id LIKE '%".$draft_id."%'";
				};
				if($draft_destination!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_destination LIKE '%".$draft_destination."%'";
				};
				if($draft_message!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_message LIKE '%".$draft_message."%'";
				};
				if($draft_date!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_date LIKE '%".$draft_date."%'";
				};
				if($draft_creator!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_creator LIKE '%".$draft_creator."%'";
				};
				if($draft_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_date_create LIKE '%".$draft_date_create."%'";
				};
				if($draft_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_update LIKE '%".$draft_update."%'";
				};
				if($draft_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_date_update LIKE '%".$draft_date_update."%'";
				};
				if($draft_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " draft_revised LIKE '%".$draft_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function draft_export_excel($draft_id ,$draft_destination ,$draft_message ,$draft_date ,$draft_creator ,$draft_date_create ,$draft_update ,$draft_date_update ,$draft_revised ,$option,$filter){
			//full query
			$sql="select * from draft";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (draft_id LIKE '%".addslashes($filter)."%' OR draft_destination LIKE '%".addslashes($filter)."%' OR draft_message LIKE '%".addslashes($filter)."%' OR draft_date LIKE '%".addslashes($filter)."%' OR draft_creator LIKE '%".addslashes($filter)."%' OR draft_date_create LIKE '%".addslashes($filter)."%' OR draft_update LIKE '%".addslashes($filter)."%' OR draft_date_update LIKE '%".addslashes($filter)."%' OR draft_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($draft_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_id LIKE '%".$draft_id."%'";
				};
				if($draft_destination!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_destination LIKE '%".$draft_destination."%'";
				};
				if($draft_message!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_message LIKE '%".$draft_message."%'";
				};
				if($draft_date!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_date LIKE '%".$draft_date."%'";
				};
				if($draft_creator!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_creator LIKE '%".$draft_creator."%'";
				};
				if($draft_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_date_create LIKE '%".$draft_date_create."%'";
				};
				if($draft_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_update LIKE '%".$draft_update."%'";
				};
				if($draft_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_date_update LIKE '%".$draft_date_update."%'";
				};
				if($draft_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " draft_revised LIKE '%".$draft_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>