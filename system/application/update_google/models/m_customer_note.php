<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: customer_note Model
	+ Description	: For record model process back-end
	+ Filename 		: c_customer_note.php
 	+ Author  		: zainal. mukhlison
 	+ Created on 12/Aug/2009 11:16:45
	
*/

class M_customer_note extends Model{
		
		//constructor
		function M_customer_note() {
			parent::Model();
		}
		
		//function for get list record
		function customer_note_list($filter,$start,$end){
			$query = "SELECT * FROM customer_note,customer where note_customer=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (note_id LIKE '%".addslashes($filter)."%' OR note_customer LIKE '%".addslashes($filter)."%' OR note_tanggal LIKE '%".addslashes($filter)."%' OR note_detail LIKE '%".addslashes($filter)."%' OR note_creator LIKE '%".addslashes($filter)."%' OR note_date_create LIKE '%".addslashes($filter)."%' OR note_update LIKE '%".addslashes($filter)."%' OR note_date_update LIKE '%".addslashes($filter)."%' OR note_revised LIKE '%".addslashes($filter)."%' )";
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
		function customer_note_update($note_id ,$note_customer ,$note_tanggal ,$note_detail ,$note_creator ,$note_date_create ,$note_update ,$note_date_update ,$note_revised ){
			$data = array(
				"note_id"=>$note_id,			
				"note_detail"=>$note_detail,			
				"note_update"=>$note_update,			
				"note_date_update"=>'NOW()',			
				"note_revised"=>'(note_revised+1)'			
			);
			$this->db->where('note_id', $note_id);
			$this->db->update('customer_note', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function customer_note_create($note_customer ,$note_tanggal ,$note_detail ,$note_creator ,$note_date_create ,$note_update ,$note_date_update ,$note_revised ){
			$data = array(
	
				"note_customer"=>$note_customer,	
				"note_tanggal"=>date('Y-m-d'),	
				"note_detail"=>$note_detail,	
				"note_creator"=>$note_creator,	
				"note_date_create"=>'NOW()'
			);
			$this->db->insert('customer_note', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function customer_note_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the customer_notes at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM customer_note WHERE note_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM customer_note WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "note_id= ".$pkid[$i];
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
		function customer_note_search($note_id ,$note_customer ,$note_tanggal ,$note_detail ,$note_creator ,$note_date_create ,$note_update ,$note_date_update ,$note_revised ,$start,$end){
			//full query
			$query="select * from customer_note";
			
			if($note_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_id LIKE '%".$note_id."%'";
			};
			if($note_customer!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_customer LIKE '%".$note_customer."%'";
			};
			if($note_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_tanggal LIKE '%".$note_tanggal."%'";
			};
			if($note_detail!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_detail LIKE '%".$note_detail."%'";
			};
			if($note_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_creator LIKE '%".$note_creator."%'";
			};
			if($note_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_date_create LIKE '%".$note_date_create."%'";
			};
			if($note_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_update LIKE '%".$note_update."%'";
			};
			if($note_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_date_update LIKE '%".$note_date_update."%'";
			};
			if($note_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " note_revised LIKE '%".$note_revised."%'";
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
		function customer_note_print($note_id ,$note_customer ,$note_tanggal ,$note_detail ,$note_creator ,$note_date_create ,$note_update ,$note_date_update ,$note_revised ,$option,$filter){
			//full query
			$query="select * from customer_note";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (note_id LIKE '%".addslashes($filter)."%' OR note_customer LIKE '%".addslashes($filter)."%' OR note_tanggal LIKE '%".addslashes($filter)."%' OR note_detail LIKE '%".addslashes($filter)."%' OR note_creator LIKE '%".addslashes($filter)."%' OR note_date_create LIKE '%".addslashes($filter)."%' OR note_update LIKE '%".addslashes($filter)."%' OR note_date_update LIKE '%".addslashes($filter)."%' OR note_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($note_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_id LIKE '%".$note_id."%'";
				};
				if($note_customer!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_customer LIKE '%".$note_customer."%'";
				};
				if($note_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_tanggal LIKE '%".$note_tanggal."%'";
				};
				if($note_detail!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_detail LIKE '%".$note_detail."%'";
				};
				if($note_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_creator LIKE '%".$note_creator."%'";
				};
				if($note_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_date_create LIKE '%".$note_date_create."%'";
				};
				if($note_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_update LIKE '%".$note_update."%'";
				};
				if($note_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_date_update LIKE '%".$note_date_update."%'";
				};
				if($note_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_revised LIKE '%".$note_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function customer_note_export_excel($note_id ,$note_customer ,$note_tanggal ,$note_detail ,$note_creator ,$note_date_create ,$note_update ,$note_date_update ,$note_revised ,$option,$filter){
			//full query
			$query="select * from customer_note";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (note_id LIKE '%".addslashes($filter)."%' OR note_customer LIKE '%".addslashes($filter)."%' OR note_tanggal LIKE '%".addslashes($filter)."%' OR note_detail LIKE '%".addslashes($filter)."%' OR note_creator LIKE '%".addslashes($filter)."%' OR note_date_create LIKE '%".addslashes($filter)."%' OR note_update LIKE '%".addslashes($filter)."%' OR note_date_update LIKE '%".addslashes($filter)."%' OR note_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($note_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_id LIKE '%".$note_id."%'";
				};
				if($note_customer!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_customer LIKE '%".$note_customer."%'";
				};
				if($note_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_tanggal LIKE '%".$note_tanggal."%'";
				};
				if($note_detail!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_detail LIKE '%".$note_detail."%'";
				};
				if($note_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_creator LIKE '%".$note_creator."%'";
				};
				if($note_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_date_create LIKE '%".$note_date_create."%'";
				};
				if($note_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_update LIKE '%".$note_update."%'";
				};
				if($note_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_date_update LIKE '%".$note_date_update."%'";
				};
				if($note_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " note_revised LIKE '%".$note_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>