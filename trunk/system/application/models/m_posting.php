<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: posting Model
	+ Description	: For record model process back-end
	+ Filename 		: c_posting.php
 	+ Author  		: 
 	+ Created on 06/Oct/2009 08:24:57
	
*/

class M_posting extends Model{
		
		//constructor
		function M_posting() {
			parent::Model();
		}
		
		//function for get list record
		function posting_list($filter,$start,$end){
			$query = "SELECT * FROM posting";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (posting_id LIKE '%".addslashes($filter)."%' OR posting_tglmulai LIKE '%".addslashes($filter)."%' OR posting_tglselesai LIKE '%".addslashes($filter)."%' )";
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
		function posting_update($posting_id ,$posting_tglmulai ,$posting_tglselesai ){
			$data = array(
				"posting_id"=>$posting_id, 
				"posting_tglmulai"=>$posting_tglmulai, 
				"posting_tglselesai"=>$posting_tglselesai 
			);
			$this->db->where('posting_id', $posting_id);
			$this->db->update('posting', $data);
			
			return '1';
		}
		
		//function for create new record
		function posting_create($posting_tglmulai ,$posting_tglselesai ){
			$data = array(
				"posting_tglmulai"=>$posting_tglmulai, 
				"posting_tglselesai"=>$posting_tglselesai 
			);
			$this->db->insert('posting', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function posting_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the postings at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM posting WHERE posting_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM posting WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "posting_id= ".$pkid[$i];
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
		function posting_search($posting_id ,$posting_tglmulai ,$posting_tglselesai ,$start,$end){
			//full query
			$query="select * from posting";
			
			if($posting_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " posting_id LIKE '%".$posting_id."%'";
			};
			if($posting_tglmulai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " posting_tglmulai LIKE '%".$posting_tglmulai."%'";
			};
			if($posting_tglselesai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " posting_tglselesai LIKE '%".$posting_tglselesai."%'";
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
		function posting_print($posting_id ,$posting_tglmulai ,$posting_tglselesai ,$option,$filter){
			//full query
			$query="select * from posting";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (posting_id LIKE '%".addslashes($filter)."%' OR posting_tglmulai LIKE '%".addslashes($filter)."%' OR posting_tglselesai LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($posting_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " posting_id LIKE '%".$posting_id."%'";
				};
				if($posting_tglmulai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " posting_tglmulai LIKE '%".$posting_tglmulai."%'";
				};
				if($posting_tglselesai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " posting_tglselesai LIKE '%".$posting_tglselesai."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function posting_export_excel($posting_id ,$posting_tglmulai ,$posting_tglselesai ,$option,$filter){
			//full query
			$query="select * from posting";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (posting_id LIKE '%".addslashes($filter)."%' OR posting_tglmulai LIKE '%".addslashes($filter)."%' OR posting_tglselesai LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($posting_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " posting_id LIKE '%".$posting_id."%'";
				};
				if($posting_tglmulai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " posting_tglmulai LIKE '%".$posting_tglmulai."%'";
				};
				if($posting_tglselesai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " posting_tglselesai LIKE '%".$posting_tglselesai."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>