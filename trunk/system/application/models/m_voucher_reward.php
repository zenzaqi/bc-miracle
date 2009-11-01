<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher_reward Model
	+ Description	: For record model process back-end
	+ Filename 		: c_voucher_reward.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:13:44
	
*/

class M_voucher_reward extends Model{
		
		//constructor
		function M_voucher_reward() {
			parent::Model();
		}
		
		//function for get list record
		function voucher_reward_list($filter,$start,$end){
			$query = "SELECT * FROM voucher_reward";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_id LIKE '%".addslashes($filter)."%' OR voucher_nama LIKE '%".addslashes($filter)."%' OR voucher_point LIKE '%".addslashes($filter)."%' OR voucher_jenis LIKE '%".addslashes($filter)."%' OR voucher_jumlah LIKE '%".addslashes($filter)."%' OR voucher_kadaluarsa LIKE '%".addslashes($filter)."%' )";
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
		function voucher_reward_update($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ){
			$data = array(
				"voucher_id"=>$voucher_id, 
				"voucher_nama"=>$voucher_nama, 
				"voucher_point"=>$voucher_point, 
				"voucher_jenis"=>$voucher_jenis, 
				"voucher_jumlah"=>$voucher_jumlah, 
				"voucher_kadaluarsa"=>$voucher_kadaluarsa 
			);
			$this->db->where('voucher_id', $voucher_id);
			$this->db->update('voucher_reward', $data);
			
			return '1';
		}
		
		//function for create new record
		function voucher_reward_create($voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ){
			$data = array(
				"voucher_nama"=>$voucher_nama, 
				"voucher_point"=>$voucher_point, 
				"voucher_jenis"=>$voucher_jenis, 
				"voucher_jumlah"=>$voucher_jumlah, 
				"voucher_kadaluarsa"=>$voucher_kadaluarsa 
			);
			$this->db->insert('voucher_reward', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function voucher_reward_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the voucher_rewards at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM voucher_reward WHERE voucher_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM voucher_reward WHERE ";
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
		function voucher_reward_search($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ,$start,$end){
			//full query
			$query="select * from voucher_reward";
			
			if($voucher_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_id LIKE '%".$voucher_id."%'";
			};
			if($voucher_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
			};
			if($voucher_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_point LIKE '%".$voucher_point."%'";
			};
			if($voucher_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_jenis LIKE '%".$voucher_jenis."%'";
			};
			if($voucher_jumlah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_jumlah LIKE '%".$voucher_jumlah."%'";
			};
			if($voucher_kadaluarsa!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
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
		function voucher_reward_print($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ,$option,$filter){
			//full query
			$query="select * from voucher_reward";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_id LIKE '%".addslashes($filter)."%' OR voucher_nama LIKE '%".addslashes($filter)."%' OR voucher_point LIKE '%".addslashes($filter)."%' OR voucher_jenis LIKE '%".addslashes($filter)."%' OR voucher_jumlah LIKE '%".addslashes($filter)."%' OR voucher_kadaluarsa LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($voucher_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_id LIKE '%".$voucher_id."%'";
				};
				if($voucher_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
				};
				if($voucher_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_point LIKE '%".$voucher_point."%'";
				};
				if($voucher_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jenis LIKE '%".$voucher_jenis."%'";
				};
				if($voucher_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jumlah LIKE '%".$voucher_jumlah."%'";
				};
				if($voucher_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function voucher_reward_export_excel($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ,$option,$filter){
			//full query
			$query="select * from voucher_reward";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_id LIKE '%".addslashes($filter)."%' OR voucher_nama LIKE '%".addslashes($filter)."%' OR voucher_point LIKE '%".addslashes($filter)."%' OR voucher_jenis LIKE '%".addslashes($filter)."%' OR voucher_jumlah LIKE '%".addslashes($filter)."%' OR voucher_kadaluarsa LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($voucher_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_id LIKE '%".$voucher_id."%'";
				};
				if($voucher_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
				};
				if($voucher_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_point LIKE '%".$voucher_point."%'";
				};
				if($voucher_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jenis LIKE '%".$voucher_jenis."%'";
				};
				if($voucher_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jumlah LIKE '%".$voucher_jumlah."%'";
				};
				if($voucher_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>