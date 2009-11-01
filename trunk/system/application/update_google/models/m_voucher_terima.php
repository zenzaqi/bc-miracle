<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher_terima Model
	+ Description	: For record model process back-end
	+ Filename 		: c_voucher_terima.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:52
	
*/

class M_voucher_terima extends Model{
		
		//constructor
		function M_voucher_terima() {
			parent::Model();
		}
		
		//function for get list record
		function voucher_terima_list($filter,$start,$end){
			$query = "SELECT * FROM voucher_terima";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (tvoucher_id LIKE '%".addslashes($filter)."%' OR tvoucher_cust LIKE '%".addslashes($filter)."%' OR tvoucher_voucher LIKE '%".addslashes($filter)."%' )";
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
		function voucher_terima_update($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ){
			$data = array(
				"tvoucher_id"=>$tvoucher_id, 
				"tvoucher_cust"=>$tvoucher_cust, 
				"tvoucher_voucher"=>$tvoucher_voucher 
			);
			$this->db->where('tvoucher_id', $tvoucher_id);
			$this->db->update('voucher_terima', $data);
			
			return '1';
		}
		
		//function for create new record
		function voucher_terima_create($tvoucher_cust ,$tvoucher_voucher ){
			$data = array(
				"tvoucher_cust"=>$tvoucher_cust, 
				"tvoucher_voucher"=>$tvoucher_voucher 
			);
			$this->db->insert('voucher_terima', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function voucher_terima_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the voucher_terimas at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM voucher_terima WHERE tvoucher_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM voucher_terima WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "tvoucher_id= ".$pkid[$i];
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
		function voucher_terima_search($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ,$start,$end){
			//full query
			$query="select * from voucher_terima";
			
			if($tvoucher_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " tvoucher_id LIKE '%".$tvoucher_id."%'";
			};
			if($tvoucher_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " tvoucher_cust LIKE '%".$tvoucher_cust."%'";
			};
			if($tvoucher_voucher!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " tvoucher_voucher LIKE '%".$tvoucher_voucher."%'";
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
		function voucher_terima_print($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ,$option,$filter){
			//full query
			$query="select * from voucher_terima";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (tvoucher_id LIKE '%".addslashes($filter)."%' OR tvoucher_cust LIKE '%".addslashes($filter)."%' OR tvoucher_voucher LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($tvoucher_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tvoucher_id LIKE '%".$tvoucher_id."%'";
				};
				if($tvoucher_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tvoucher_cust LIKE '%".$tvoucher_cust."%'";
				};
				if($tvoucher_voucher!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tvoucher_voucher LIKE '%".$tvoucher_voucher."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function voucher_terima_export_excel($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ,$option,$filter){
			//full query
			$query="select * from voucher_terima";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (tvoucher_id LIKE '%".addslashes($filter)."%' OR tvoucher_cust LIKE '%".addslashes($filter)."%' OR tvoucher_voucher LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($tvoucher_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tvoucher_id LIKE '%".$tvoucher_id."%'";
				};
				if($tvoucher_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tvoucher_cust LIKE '%".$tvoucher_cust."%'";
				};
				if($tvoucher_voucher!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tvoucher_voucher LIKE '%".$tvoucher_voucher."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>