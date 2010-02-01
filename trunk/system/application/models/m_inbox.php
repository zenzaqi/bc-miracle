<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: inbox Model
	+ Description	: For record model process back-end
	+ Filename 		: c_inbox.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/

class M_inbox extends Model{
		
		//constructor
		function M_inbox() {
			parent::Model();
		}
		
		//function for get list record
		function inbox_list($filter,$start,$end){
			$query = "SELECT * FROM inbox";
			
			// For simple search
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (inbox_id LIKE '%".addslashes($filter)."%' OR inbox_sender LIKE '%".addslashes($filter)."%' OR inbox_message LIKE '%".addslashes($filter)."%' OR inbox_date LIKE '%".addslashes($filter)."%' OR inbox_creator LIKE '%".addslashes($filter)."%' OR inbox_date_create LIKE '%".addslashes($filter)."%' OR inbox_update LIKE '%".addslashes($filter)."%' OR inbox_date_update LIKE '%".addslashes($filter)."%' OR inbox_revised LIKE '%".addslashes($filter)."%' )";
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
		function inbox_create($inbox_sender ,$inbox_message ,$inbox_date ,$inbox_creator ,$inbox_date_create ){
			$data = array(
				"inbox_sender"=>$inbox_sender, 
				"inbox_message"=>$inbox_message, 
				"inbox_date"=>$inbox_date, 
				"inbox_creator"=>$inbox_creator, 
				"inbox_date_create"=>$inbox_date_create 
			);
			$this->db->insert('inbox', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for update record
		function inbox_update($inbox_id,$inbox_sender,$inbox_message,$inbox_date,$inbox_creator,$inbox_update,$inbox_date_update){
			$data = array(
				"inbox_sender"=>$inbox_sender, 
				"inbox_message"=>$inbox_message, 
				"inbox_date"=>$inbox_date, 
				"inbox_creator"=>$inbox_creator, 
				"inbox_update"=>$inbox_update, 
				"inbox_date_update"=>$inbox_date_update 
			);
			
			$this->db->where('inbox_id', $inbox_id);
			$this->db->update('inbox', $data);
			$sql="UPDATE inbox set inbox_revised=(inbox_revised+1) where inbox_id='".$inbox_id."'";
			$this->db->query($sql);
			return '1';
		}
		
		//fcuntion for delete record
		function inbox_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the inboxs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM inbox WHERE inbox_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM inbox WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "inbox_id= ".$pkid[$i];
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
		function inbox_search($inbox_id ,$inbox_sender ,$inbox_message ,$inbox_date ,$inbox_creator ,$inbox_date_create ,$inbox_update ,$inbox_date_update ,$inbox_revised ,$start,$end){
			//full query
			$query="select * from inbox";
			
			if($inbox_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_id LIKE '%".$inbox_id."%'";
			};
			if($inbox_sender!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_sender LIKE '%".$inbox_sender."%'";
			};
			if($inbox_message!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_message LIKE '%".$inbox_message."%'";
			};
			if($inbox_date!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_date LIKE '%".$inbox_date."%'";
			};
			if($inbox_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_creator LIKE '%".$inbox_creator."%'";
			};
			if($inbox_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_date_create LIKE '%".$inbox_date_create."%'";
			};
			if($inbox_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_update LIKE '%".$inbox_update."%'";
			};
			if($inbox_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_date_update LIKE '%".$inbox_date_update."%'";
			};
			if($inbox_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " inbox_revised LIKE '%".$inbox_revised."%'";
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
		function inbox_print($inbox_id ,$inbox_sender ,$inbox_message ,$inbox_date ,$inbox_creator ,$inbox_date_create ,$inbox_update ,$inbox_date_update ,$inbox_revised ,$option,$filter){
			//full query
			$sql="select * from inbox";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (inbox_id LIKE '%".addslashes($filter)."%' OR inbox_sender LIKE '%".addslashes($filter)."%' OR inbox_message LIKE '%".addslashes($filter)."%' OR inbox_date LIKE '%".addslashes($filter)."%' OR inbox_creator LIKE '%".addslashes($filter)."%' OR inbox_date_create LIKE '%".addslashes($filter)."%' OR inbox_update LIKE '%".addslashes($filter)."%' OR inbox_date_update LIKE '%".addslashes($filter)."%' OR inbox_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($inbox_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_id LIKE '%".$inbox_id."%'";
				};
				if($inbox_sender!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_sender LIKE '%".$inbox_sender."%'";
				};
				if($inbox_message!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_message LIKE '%".$inbox_message."%'";
				};
				if($inbox_date!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_date LIKE '%".$inbox_date."%'";
				};
				if($inbox_creator!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_creator LIKE '%".$inbox_creator."%'";
				};
				if($inbox_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_date_create LIKE '%".$inbox_date_create."%'";
				};
				if($inbox_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_update LIKE '%".$inbox_update."%'";
				};
				if($inbox_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_date_update LIKE '%".$inbox_date_update."%'";
				};
				if($inbox_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " inbox_revised LIKE '%".$inbox_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function inbox_export_excel($inbox_id ,$inbox_sender ,$inbox_message ,$inbox_date ,$inbox_creator ,$inbox_date_create ,$inbox_update ,$inbox_date_update ,$inbox_revised ,$option,$filter){
			//full query
			$sql="select * from inbox";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (inbox_id LIKE '%".addslashes($filter)."%' OR inbox_sender LIKE '%".addslashes($filter)."%' OR inbox_message LIKE '%".addslashes($filter)."%' OR inbox_date LIKE '%".addslashes($filter)."%' OR inbox_creator LIKE '%".addslashes($filter)."%' OR inbox_date_create LIKE '%".addslashes($filter)."%' OR inbox_update LIKE '%".addslashes($filter)."%' OR inbox_date_update LIKE '%".addslashes($filter)."%' OR inbox_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($inbox_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_id LIKE '%".$inbox_id."%'";
				};
				if($inbox_sender!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_sender LIKE '%".$inbox_sender."%'";
				};
				if($inbox_message!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_message LIKE '%".$inbox_message."%'";
				};
				if($inbox_date!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_date LIKE '%".$inbox_date."%'";
				};
				if($inbox_creator!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_creator LIKE '%".$inbox_creator."%'";
				};
				if($inbox_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_date_create LIKE '%".$inbox_date_create."%'";
				};
				if($inbox_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_update LIKE '%".$inbox_update."%'";
				};
				if($inbox_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_date_update LIKE '%".$inbox_date_update."%'";
				};
				if($inbox_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " inbox_revised LIKE '%".$inbox_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>