<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: promo Model
	+ Description	: For record model process back-end
	+ Filename 		: c_promo.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 08:57:17
	
*/

class M_promo extends Model{
		
		//constructor
		function M_promo() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_promo_berlaku_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM promo_berlaku where bpromo_master='".$master_id."'";
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
		//end of function
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(promo_id) as master_id from promo";
			$result = $this->db->query($query);
			if($result->num_rows()){
				$data=$result->row();
				$master_id=$data->master_id;
				return $master_id;
			}else{
				return '0';
			}
		}
		//eof
		
		//purge all detail from master
		function detail_promo_berlaku_purge($master_id){
			$sql="DELETE from promo_berlaku where bpromo_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_promo_berlaku_insert($bpromo_id ,$bpromo_master ,$bpromo_produk ){
			//if master id not capture from view then capture it from max pk from master table
			if($bpromo_master=="" || $bpromo_master==NULL){
				$bpromo_master=$this->get_master_id();
			}
			
			$data = array(
				"bpromo_id"=>$bpromo_id, 
				"bpromo_master"=>$bpromo_master, 
				"bpromo_produk"=>$bpromo_produk 
			);
			$this->db->insert('promo_berlaku', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function promo_list($filter,$start,$end){
			$query = "SELECT * FROM promo";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (promo_id LIKE '%".addslashes($filter)."%' OR promo_acara LIKE '%".addslashes($filter)."%' OR promo_tempat LIKE '%".addslashes($filter)."%' OR promo_tglmulai LIKE '%".addslashes($filter)."%' OR promo_tglselesai LIKE '%".addslashes($filter)."%' OR promo_cashback LIKE '%".addslashes($filter)."%' OR promo_mincash LIKE '%".addslashes($filter)."%' OR promo_diskon LIKE '%".addslashes($filter)."%' OR promo_allproduk LIKE '%".addslashes($filter)."%' OR promo_allrawat LIKE '%".addslashes($filter)."%' )";
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
		function promo_update($promo_id ,$promo_acara ,$promo_tempat ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ){
			$data = array(
				"promo_id"=>$promo_id, 
				"promo_acara"=>$promo_acara, 
				"promo_tempat"=>$promo_tempat, 
				"promo_tglmulai"=>$promo_tglmulai, 
				"promo_tglselesai"=>$promo_tglselesai, 
				"promo_cashback"=>$promo_cashback, 
				"promo_mincash"=>$promo_mincash, 
				"promo_diskon"=>$promo_diskon, 
				"promo_allproduk"=>$promo_allproduk, 
				"promo_allrawat"=>$promo_allrawat 
			);
			$this->db->where('promo_id', $promo_id);
			$this->db->update('promo', $data);
			
			return '1';
		}
		
		//function for create new record
		function promo_create($promo_id ,$promo_acara ,$promo_tempat ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ){
			$data = array(
				"promo_id"=>$promo_id, 
				"promo_acara"=>$promo_acara, 
				"promo_tempat"=>$promo_tempat, 
				"promo_tglmulai"=>$promo_tglmulai, 
				"promo_tglselesai"=>$promo_tglselesai, 
				"promo_cashback"=>$promo_cashback, 
				"promo_mincash"=>$promo_mincash, 
				"promo_diskon"=>$promo_diskon, 
				"promo_allproduk"=>$promo_allproduk, 
				"promo_allrawat"=>$promo_allrawat 
			);
			$this->db->insert('promo', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function promo_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the promos at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM promo WHERE promo_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM promo WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "promo_id= ".$pkid[$i];
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
		function promo_search($promo_id ,$promo_acara ,$promo_tempat ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ,$start,$end){
			//full query
			$query="select * from promo";
			
			if($promo_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_id LIKE '%".$promo_id."%'";
			};
			if($promo_acara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_acara LIKE '%".$promo_acara."%'";
			};
			if($promo_tempat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_tempat LIKE '%".$promo_tempat."%'";
			};
			if($promo_tglmulai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_tglmulai LIKE '%".$promo_tglmulai."%'";
			};
			if($promo_tglselesai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_tglselesai LIKE '%".$promo_tglselesai."%'";
			};
			if($promo_cashback!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_cashback LIKE '%".$promo_cashback."%'";
			};
			if($promo_mincash!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_mincash LIKE '%".$promo_mincash."%'";
			};
			if($promo_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_diskon LIKE '%".$promo_diskon."%'";
			};
			if($promo_allproduk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_allproduk LIKE '%".$promo_allproduk."%'";
			};
			if($promo_allrawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " promo_allrawat LIKE '%".$promo_allrawat."%'";
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
		function promo_print($promo_id ,$promo_acara ,$promo_tempat ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ,$option,$filter){
			//full query
			$query="select * from promo";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (promo_id LIKE '%".addslashes($filter)."%' OR promo_acara LIKE '%".addslashes($filter)."%' OR promo_tempat LIKE '%".addslashes($filter)."%' OR promo_tglmulai LIKE '%".addslashes($filter)."%' OR promo_tglselesai LIKE '%".addslashes($filter)."%' OR promo_cashback LIKE '%".addslashes($filter)."%' OR promo_mincash LIKE '%".addslashes($filter)."%' OR promo_diskon LIKE '%".addslashes($filter)."%' OR promo_allproduk LIKE '%".addslashes($filter)."%' OR promo_allrawat LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($promo_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_id LIKE '%".$promo_id."%'";
				};
				if($promo_acara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_acara LIKE '%".$promo_acara."%'";
				};
				if($promo_tempat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_tempat LIKE '%".$promo_tempat."%'";
				};
				if($promo_tglmulai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_tglmulai LIKE '%".$promo_tglmulai."%'";
				};
				if($promo_tglselesai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_tglselesai LIKE '%".$promo_tglselesai."%'";
				};
				if($promo_cashback!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_cashback LIKE '%".$promo_cashback."%'";
				};
				if($promo_mincash!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_mincash LIKE '%".$promo_mincash."%'";
				};
				if($promo_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_diskon LIKE '%".$promo_diskon."%'";
				};
				if($promo_allproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_allproduk LIKE '%".$promo_allproduk."%'";
				};
				if($promo_allrawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_allrawat LIKE '%".$promo_allrawat."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function promo_export_excel($promo_id ,$promo_acara ,$promo_tempat ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ,$option,$filter){
			//full query
			$query="select * from promo";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (promo_id LIKE '%".addslashes($filter)."%' OR promo_acara LIKE '%".addslashes($filter)."%' OR promo_tempat LIKE '%".addslashes($filter)."%' OR promo_tglmulai LIKE '%".addslashes($filter)."%' OR promo_tglselesai LIKE '%".addslashes($filter)."%' OR promo_cashback LIKE '%".addslashes($filter)."%' OR promo_mincash LIKE '%".addslashes($filter)."%' OR promo_diskon LIKE '%".addslashes($filter)."%' OR promo_allproduk LIKE '%".addslashes($filter)."%' OR promo_allrawat LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($promo_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_id LIKE '%".$promo_id."%'";
				};
				if($promo_acara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_acara LIKE '%".$promo_acara."%'";
				};
				if($promo_tempat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_tempat LIKE '%".$promo_tempat."%'";
				};
				if($promo_tglmulai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_tglmulai LIKE '%".$promo_tglmulai."%'";
				};
				if($promo_tglselesai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_tglselesai LIKE '%".$promo_tglselesai."%'";
				};
				if($promo_cashback!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_cashback LIKE '%".$promo_cashback."%'";
				};
				if($promo_mincash!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_mincash LIKE '%".$promo_mincash."%'";
				};
				if($promo_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_diskon LIKE '%".$promo_diskon."%'";
				};
				if($promo_allproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_allproduk LIKE '%".$promo_allproduk."%'";
				};
				if($promo_allrawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " promo_allrawat LIKE '%".$promo_allrawat."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>