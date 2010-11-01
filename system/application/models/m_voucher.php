<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher Model
	+ Description	: For record model process back-end
	+ Filename 		: c_voucher.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 06:40:41
	
*/

class M_voucher extends Model{
		
		//constructor
		function M_voucher() {
			parent::Model();
		}
		
		//function for get list record
		function voucher_list($filter,$start,$end){
			$query = "SELECT * FROM voucher";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_no LIKE '%".addslashes($filter)."%' OR 
							 voucher_nama LIKE '%".addslashes($filter)."%' OR 
							 voucher_cust LIKE '%".addslashes($filter)."%' )";
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
		
		
		//fcuntion for delete record
		function voucher_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the vouchers at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM voucher WHERE voucher_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM voucher WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "voucher_id= ".$pkid[$i];
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
		function voucher_search($voucher_no ,$voucher_nama ,$voucher_cust, $voucher_point ,$voucher_kadaluarsa ,$voucher_cashback ,$start,$end){
			//full query
			$query="select * from voucher";
			
			if($voucher_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_no LIKE '%".$voucher_no."%'";
			};
			
			if($voucher_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_cust LIKE '%".$voucher_cust."%'";
			};
			
			if($voucher_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
			};

			if($voucher_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_point LIKE '%".$voucher_point."%'";
			};
			if($voucher_kadaluarsa!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
			};
			if($voucher_cashback!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_cashback LIKE '%".$voucher_cashback."%'";
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
		function voucher_print($voucher_no ,$voucher_nama , $voucher_cust, $voucher_point ,$voucher_kadaluarsa ,$voucher_cashback ,$option,$filter){
			//full query
			$query="select * from voucher";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_no LIKE '%".addslashes($filter)."%' OR 
							 voucher_nama LIKE '%".addslashes($filter)."%' OR
							 voucher_cust LIKE '%".addslashes($filter)."%')";
			} else if($option=='SEARCH'){
				if($voucher_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_no LIKE '%".$voucher_no."%'";
				};
				
				if($voucher_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_cust LIKE '%".$voucher_cust."%'";
				};
				
				if($voucher_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
				};
				if($voucher_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_point LIKE '%".$voucher_point."%'";
				};
				
				if($voucher_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
				};
				if($voucher_cashback!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_cashback LIKE '%".$voucher_cashback."%'";
				};
			}
			$result = $this->db->query($query);
			return $result;
		}
		
		//function  for export to excel
		function voucher_export_excel($voucher_no ,$voucher_nama , $voucher_cust, $voucher_point ,$voucher_kadaluarsa ,$voucher_cashback ,
									  $option,$filter){
			//full query
			$query="select * from voucher";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_no LIKE '%".addslashes($filter)."%' OR 
							 voucher_nama LIKE '%".addslashes($filter)."%' OR
							 voucher_cust LIKE '%".addslashes($filter)."%')";
			} else if($option=='SEARCH'){
				if($voucher_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_no LIKE '%".$voucher_no."%'";
				};
				
				if($voucher_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_cust LIKE '%".$voucher_cust."%'";
				};
				
				if($voucher_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
				};
				if($voucher_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_point LIKE '%".$voucher_point."%'";
				};
				
				if($voucher_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
				};
				if($voucher_cashback!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_cashback LIKE '%".$voucher_cashback."%'";
				};
			}
			$result = $this->db->query($query);
			return $result;
		}
		
}
?>