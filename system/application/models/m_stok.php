<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: stok Model
	+ Description	: For record model process back-end
	+ Filename 		: c_stok.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_stok extends Model{
		
		//constructor
		function M_stok() {
			parent::Model();
		}
		
		//function for get list record
		function stok_list($filter,$start,$end){
			$query = "SELECT * FROM stok";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (stok_id LIKE '%".addslashes($filter)."%' OR stok_produk LIKE '%".addslashes($filter)."%' OR stok_gudang LIKE '%".addslashes($filter)."%' OR stok_jumlah LIKE '%".addslashes($filter)."%' OR stok_date_update LIKE '%".addslashes($filter)."%' )";
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
		function stok_update($stok_id ,$stok_produk ,$stok_gudang ,$stok_jumlah ,$stok_date_update ){
			$data = array(
				"stok_id"=>$stok_id,			
				"stok_produk"=>$stok_produk,			
				"stok_gudang"=>$stok_gudang,			
				"stok_jumlah"=>$stok_jumlah,			
				"stok_date_update"=>$stok_date_update			
			);
			$this->db->where('stok_id', $stok_id);
			$this->db->update('stok', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function stok_create($stok_produk ,$stok_gudang ,$stok_jumlah ,$stok_date_update ){
			$data = array(
	
				"stok_produk"=>$stok_produk,	
				"stok_gudang"=>$stok_gudang,	
				"stok_jumlah"=>$stok_jumlah,	
				"stok_date_update"=>$stok_date_update	
			);
			$this->db->insert('stok', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function stok_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the stoks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM stok WHERE stok_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM stok WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "stok_id= ".$pkid[$i];
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
		function stok_search($stok_id ,$stok_produk ,$stok_gudang ,$stok_jumlah ,$stok_date_update ,$start,$end){
			//full query
			$query="select * from stok";
			
			if($stok_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_id LIKE '%".$stok_id."%'";
			};
			if($stok_produk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_produk LIKE '%".$stok_produk."%'";
			};
			if($stok_gudang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_gudang LIKE '%".$stok_gudang."%'";
			};
			if($stok_jumlah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_jumlah LIKE '%".$stok_jumlah."%'";
			};
			if($stok_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_date_update LIKE '%".$stok_date_update."%'";
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
		function stok_print($stok_id ,$stok_produk ,$stok_gudang ,$stok_jumlah ,$stok_date_update ,$option,$filter){
			//full query
			$query="select * from stok";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (stok_id LIKE '%".addslashes($filter)."%' OR stok_produk LIKE '%".addslashes($filter)."%' OR stok_gudang LIKE '%".addslashes($filter)."%' OR stok_jumlah LIKE '%".addslashes($filter)."%' OR stok_date_update LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($stok_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_id LIKE '%".$stok_id."%'";
				};
				if($stok_produk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_produk LIKE '%".$stok_produk."%'";
				};
				if($stok_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_gudang LIKE '%".$stok_gudang."%'";
				};
				if($stok_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_jumlah LIKE '%".$stok_jumlah."%'";
				};
				if($stok_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_date_update LIKE '%".$stok_date_update."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function stok_export_excel($stok_id ,$stok_produk ,$stok_gudang ,$stok_jumlah ,$stok_date_update ,$option,$filter){
			//full query
			$query="select * from stok";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (stok_id LIKE '%".addslashes($filter)."%' OR stok_produk LIKE '%".addslashes($filter)."%' OR stok_gudang LIKE '%".addslashes($filter)."%' OR stok_jumlah LIKE '%".addslashes($filter)."%' OR stok_date_update LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($stok_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_id LIKE '%".$stok_id."%'";
				};
				if($stok_produk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_produk LIKE '%".$stok_produk."%'";
				};
				if($stok_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_gudang LIKE '%".$stok_gudang."%'";
				};
				if($stok_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_jumlah LIKE '%".$stok_jumlah."%'";
				};
				if($stok_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " stok_date_update LIKE '%".$stok_date_update."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>