<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: buku_besar Model
	+ Description	: For record model process back-end
	+ Filename 		: c_buku_besar.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:51:08
	
*/

class M_buku_besar extends Model{
		
		//constructor
		function M_buku_besar() {
			parent::Model();
		}
		
		//function for get list record
		function buku_besar_list($filter,$start,$end){
			$query = "SELECT * FROM buku_besar";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (buku_id LIKE '%".addslashes($filter)."%' OR buku_tanggal LIKE '%".addslashes($filter)."%' OR buku_akun LIKE '%".addslashes($filter)."%' OR buku_debet LIKE '%".addslashes($filter)."%' OR buku_kredit LIKE '%".addslashes($filter)."%' OR buku_saldo_debet LIKE '%".addslashes($filter)."%' OR buku_saldo_kredit LIKE '%".addslashes($filter)."%' )";
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
		function buku_besar_update($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ){
			$data = array(
				"buku_id"=>$buku_id, 
				"buku_tanggal"=>$buku_tanggal, 
				"buku_akun"=>$buku_akun, 
				"buku_debet"=>$buku_debet, 
				"buku_kredit"=>$buku_kredit, 
				"buku_saldo_debet"=>$buku_saldo_debet, 
				"buku_saldo_kredit"=>$buku_saldo_kredit 
			);
			$this->db->where('buku_id', $buku_id);
			$this->db->update('buku_besar', $data);
			
			return '1';
		}
		
		//function for create new record
		function buku_besar_create($buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ){
			$data = array(
				"buku_tanggal"=>$buku_tanggal, 
				"buku_akun"=>$buku_akun, 
				"buku_debet"=>$buku_debet, 
				"buku_kredit"=>$buku_kredit, 
				"buku_saldo_debet"=>$buku_saldo_debet, 
				"buku_saldo_kredit"=>$buku_saldo_kredit 
			);
			$this->db->insert('buku_besar', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function buku_besar_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the buku_besars at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM buku_besar WHERE buku_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM buku_besar WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "buku_id= ".$pkid[$i];
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
		function buku_besar_search($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$start,$end){
			//full query
			$query="select * from buku_besar";
			
			if($buku_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_id LIKE '%".$buku_id."%'";
			};
			if($buku_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_tanggal LIKE '%".$buku_tanggal."%'";
			};
			if($buku_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_akun LIKE '%".$buku_akun."%'";
			};
			if($buku_debet!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_debet LIKE '%".$buku_debet."%'";
			};
			if($buku_kredit!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_kredit LIKE '%".$buku_kredit."%'";
			};
			if($buku_saldo_debet!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_saldo_debet LIKE '%".$buku_saldo_debet."%'";
			};
			if($buku_saldo_kredit!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " buku_saldo_kredit LIKE '%".$buku_saldo_kredit."%'";
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
		function buku_besar_print($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter){
			//full query
			$query="select * from buku_besar";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (buku_id LIKE '%".addslashes($filter)."%' OR buku_tanggal LIKE '%".addslashes($filter)."%' OR buku_akun LIKE '%".addslashes($filter)."%' OR buku_debet LIKE '%".addslashes($filter)."%' OR buku_kredit LIKE '%".addslashes($filter)."%' OR buku_saldo_debet LIKE '%".addslashes($filter)."%' OR buku_saldo_kredit LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($buku_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_id LIKE '%".$buku_id."%'";
				};
				if($buku_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_tanggal LIKE '%".$buku_tanggal."%'";
				};
				if($buku_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_akun LIKE '%".$buku_akun."%'";
				};
				if($buku_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_debet LIKE '%".$buku_debet."%'";
				};
				if($buku_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_kredit LIKE '%".$buku_kredit."%'";
				};
				if($buku_saldo_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_debet LIKE '%".$buku_saldo_debet."%'";
				};
				if($buku_saldo_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_kredit LIKE '%".$buku_saldo_kredit."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function buku_besar_export_excel($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter){
			//full query
			$query="select * from buku_besar";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (buku_id LIKE '%".addslashes($filter)."%' OR buku_tanggal LIKE '%".addslashes($filter)."%' OR buku_akun LIKE '%".addslashes($filter)."%' OR buku_debet LIKE '%".addslashes($filter)."%' OR buku_kredit LIKE '%".addslashes($filter)."%' OR buku_saldo_debet LIKE '%".addslashes($filter)."%' OR buku_saldo_kredit LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($buku_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_id LIKE '%".$buku_id."%'";
				};
				if($buku_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_tanggal LIKE '%".$buku_tanggal."%'";
				};
				if($buku_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_akun LIKE '%".$buku_akun."%'";
				};
				if($buku_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_debet LIKE '%".$buku_debet."%'";
				};
				if($buku_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_kredit LIKE '%".$buku_kredit."%'";
				};
				if($buku_saldo_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_debet LIKE '%".$buku_saldo_debet."%'";
				};
				if($buku_saldo_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_kredit LIKE '%".$buku_saldo_kredit."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>