<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: outbox Model
	+ Description	: For record model process back-end
	+ Filename 		: c_outbox.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/

class M_outbox extends Model{
		
		//constructor
		function M_outbox() {
			parent::Model();
		}
		
		//function for get list record
		function outbox_list($filter,$start,$end){
			$query =   "SELECT 
							o.*, 
							c.cust_no, c.cust_nama 
						FROM outbox o
						LEFT JOIN customer c on c.cust_id = o.outbox_cust";
			
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (outbox_id LIKE '%".addslashes($filter)."%' OR outbox_destination LIKE '%".addslashes($filter)."%' OR outbox_message LIKE '%".addslashes($filter)."%' )";
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
		function outbox_create($outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ){
			$data = array(
				"outbox_destination"=>$outbox_destination, 
				"outbox_message"=>$outbox_message, 
				"outbox_date"=>$outbox_date, 
				"outbox_creator"=>$outbox_creator, 
				"outbox_date_create"=>$outbox_date_create 
			);
			$this->db->insert('outbox', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for update record
		function outbox_update($outbox_id,$outbox_destination,$outbox_message,$outbox_date,$outbox_creator,$outbox_update,$outbox_date_update){
			$data = array(
				"outbox_destination"=>$outbox_destination, 
				"outbox_message"=>$outbox_message, 
				"outbox_date"=>$outbox_date, 
				"outbox_creator"=>$outbox_creator, 
				"outbox_update"=>$outbox_update, 
				"outbox_date_update"=>$outbox_date_update 
			);
			
			$this->db->where('outbox_id', $outbox_id);
			$this->db->update('outbox', $data);
			$sql="UPDATE outbox set outbox_revised=(outbox_revised+1) where outbox_id='".$outbox_id."'";
			$this->db->query($sql);
			return '1';
		}
		
		//fcuntion for delete record
		function outbox_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the outboxs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM outbox WHERE outbox_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM outbox WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "outbox_id= ".$pkid[$i];
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
		function outbox_search($outbox_id ,$outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ,$outbox_update ,$outbox_date_update ,$outbox_revised ,$start,$end){
			//full query
			$query="select * from outbox";
			
			if($outbox_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " outbox_id LIKE '%".$outbox_id."%'";
			};
			if($outbox_destination!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " outbox_destination LIKE '%".$outbox_destination."%'";
			};
			if($outbox_message!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " outbox_message LIKE '%".$outbox_message."%'";
			};
			if($outbox_date!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " outbox_date LIKE '%".$outbox_date."%'";
			};
			if($outbox_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " outbox_creator LIKE '%".$outbox_creator."%'";
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
		function outbox_print($outbox_id ,$outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ,$outbox_update ,$outbox_date_update ,$outbox_revised ,$option,$filter){
			//full query
			$sql="select * from outbox";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (outbox_id LIKE '%".addslashes($filter)."%' OR outbox_destination LIKE '%".addslashes($filter)."%' OR outbox_message LIKE '%".addslashes($filter)."%' OR outbox_date LIKE '%".addslashes($filter)."%' OR outbox_creator LIKE '%".addslashes($filter)."%' OR outbox_date_create LIKE '%".addslashes($filter)."%' OR outbox_update LIKE '%".addslashes($filter)."%' OR outbox_date_update LIKE '%".addslashes($filter)."%' OR outbox_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($outbox_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_id LIKE '%".$outbox_id."%'";
				};
				if($outbox_destination!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_destination LIKE '%".$outbox_destination."%'";
				};
				if($outbox_message!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_message LIKE '%".$outbox_message."%'";
				};
				if($outbox_date!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_date LIKE '%".$outbox_date."%'";
				};
				if($outbox_creator!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_creator LIKE '%".$outbox_creator."%'";
				};
				if($outbox_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_date_create LIKE '%".$outbox_date_create."%'";
				};
				if($outbox_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_update LIKE '%".$outbox_update."%'";
				};
				if($outbox_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_date_update LIKE '%".$outbox_date_update."%'";
				};
				if($outbox_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " outbox_revised LIKE '%".$outbox_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function outbox_export_excel($outbox_id ,$outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ,$outbox_update ,$outbox_date_update ,$outbox_revised ,$option,$filter){
			//full query
			$sql="select * from outbox";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (outbox_id LIKE '%".addslashes($filter)."%' OR outbox_destination LIKE '%".addslashes($filter)."%' OR outbox_message LIKE '%".addslashes($filter)."%' OR outbox_date LIKE '%".addslashes($filter)."%' OR outbox_creator LIKE '%".addslashes($filter)."%' OR outbox_date_create LIKE '%".addslashes($filter)."%' OR outbox_update LIKE '%".addslashes($filter)."%' OR outbox_date_update LIKE '%".addslashes($filter)."%' OR outbox_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($outbox_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_id LIKE '%".$outbox_id."%'";
				};
				if($outbox_destination!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_destination LIKE '%".$outbox_destination."%'";
				};
				if($outbox_message!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_message LIKE '%".$outbox_message."%'";
				};
				if($outbox_date!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_date LIKE '%".$outbox_date."%'";
				};
				if($outbox_creator!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_creator LIKE '%".$outbox_creator."%'";
				};
				if($outbox_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_date_create LIKE '%".$outbox_date_create."%'";
				};
				if($outbox_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_update LIKE '%".$outbox_update."%'";
				};
				if($outbox_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_date_update LIKE '%".$outbox_date_update."%'";
				};
				if($outbox_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " outbox_revised LIKE '%".$outbox_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>