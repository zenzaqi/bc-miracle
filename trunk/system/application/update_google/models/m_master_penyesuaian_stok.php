<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_penyesuaian_stok Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_penyesuaian_stok.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_master_penyesuaian_stok extends Model{
		
		//constructor
		function M_master_penyesuaian_stok() {
			parent::Model();
		}
		
		//function for get list record
		function master_penyesuaian_stok_list($filter,$start,$end){
			$query = "SELECT * FROM master_penyesuaian_stok";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (koreksi_id LIKE '%".addslashes($filter)."%' OR koreksi_gudang LIKE '%".addslashes($filter)."%' OR koreksi_tanggal LIKE '%".addslashes($filter)."%' OR koreksi_keterangan LIKE '%".addslashes($filter)."%' OR koreksi_creator LIKE '%".addslashes($filter)."%' OR koreksi_date_create LIKE '%".addslashes($filter)."%' OR koreksi_update LIKE '%".addslashes($filter)."%' OR koreksi_date_update LIKE '%".addslashes($filter)."%' OR koreksi_revised LIKE '%".addslashes($filter)."%' )";
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
		function master_penyesuaian_stok_update($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ){
			$data = array(
				"koreksi_id"=>$koreksi_id,			
				"koreksi_gudang"=>$koreksi_gudang,			
				"koreksi_tanggal"=>$koreksi_tanggal,			
				"koreksi_keterangan"=>$koreksi_keterangan,			
				"koreksi_creator"=>$koreksi_creator,			
				"koreksi_date_create"=>$koreksi_date_create,			
				"koreksi_update"=>$koreksi_update,			
				"koreksi_date_update"=>$koreksi_date_update,			
				"koreksi_revised"=>$koreksi_revised			
			);
			$this->db->where('koreksi_id', $koreksi_id);
			$this->db->update('master_penyesuaian_stok', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function master_penyesuaian_stok_create($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ){
			$data = array(
				"koreksi_id"=>$koreksi_id,	
				"koreksi_gudang"=>$koreksi_gudang,	
				"koreksi_tanggal"=>$koreksi_tanggal,	
				"koreksi_keterangan"=>$koreksi_keterangan,	
				"koreksi_creator"=>$koreksi_creator,	
				"koreksi_date_create"=>$koreksi_date_create,	
				"koreksi_update"=>$koreksi_update,	
				"koreksi_date_update"=>$koreksi_date_update,	
				"koreksi_revised"=>$koreksi_revised	
			);
			$this->db->insert('master_penyesuaian_stok', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_penyesuaian_stok_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_penyesuaian_stoks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_penyesuaian_stok WHERE koreksi_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_penyesuaian_stok WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "koreksi_id= ".$pkid[$i];
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
		function master_penyesuaian_stok_search($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ,$start,$end){
			//full query
			$query="select * from master_penyesuaian_stok";
			
			if($koreksi_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_id LIKE '%".$koreksi_id."%'";
			};
			if($koreksi_gudang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_gudang LIKE '%".$koreksi_gudang."%'";
			};
			if($koreksi_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_tanggal LIKE '%".$koreksi_tanggal."%'";
			};
			if($koreksi_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_keterangan LIKE '%".$koreksi_keterangan."%'";
			};
			if($koreksi_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_creator LIKE '%".$koreksi_creator."%'";
			};
			if($koreksi_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_date_create LIKE '%".$koreksi_date_create."%'";
			};
			if($koreksi_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_update LIKE '%".$koreksi_update."%'";
			};
			if($koreksi_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_date_update LIKE '%".$koreksi_date_update."%'";
			};
			if($koreksi_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " koreksi_revised LIKE '%".$koreksi_revised."%'";
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
		function master_penyesuaian_stok_print($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ,$option,$filter){
			//full query
			$query="select * from master_penyesuaian_stok";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (koreksi_id LIKE '%".addslashes($filter)."%' OR koreksi_gudang LIKE '%".addslashes($filter)."%' OR koreksi_tanggal LIKE '%".addslashes($filter)."%' OR koreksi_keterangan LIKE '%".addslashes($filter)."%' OR koreksi_creator LIKE '%".addslashes($filter)."%' OR koreksi_date_create LIKE '%".addslashes($filter)."%' OR koreksi_update LIKE '%".addslashes($filter)."%' OR koreksi_date_update LIKE '%".addslashes($filter)."%' OR koreksi_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($koreksi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_id LIKE '%".$koreksi_id."%'";
				};
				if($koreksi_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_gudang LIKE '%".$koreksi_gudang."%'";
				};
				if($koreksi_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_tanggal LIKE '%".$koreksi_tanggal."%'";
				};
				if($koreksi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_keterangan LIKE '%".$koreksi_keterangan."%'";
				};
				if($koreksi_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_creator LIKE '%".$koreksi_creator."%'";
				};
				if($koreksi_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_date_create LIKE '%".$koreksi_date_create."%'";
				};
				if($koreksi_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_update LIKE '%".$koreksi_update."%'";
				};
				if($koreksi_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_date_update LIKE '%".$koreksi_date_update."%'";
				};
				if($koreksi_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_revised LIKE '%".$koreksi_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_penyesuaian_stok_export_excel($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ,$option,$filter){
			//full query
			$query="select * from master_penyesuaian_stok";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (koreksi_id LIKE '%".addslashes($filter)."%' OR koreksi_gudang LIKE '%".addslashes($filter)."%' OR koreksi_tanggal LIKE '%".addslashes($filter)."%' OR koreksi_keterangan LIKE '%".addslashes($filter)."%' OR koreksi_creator LIKE '%".addslashes($filter)."%' OR koreksi_date_create LIKE '%".addslashes($filter)."%' OR koreksi_update LIKE '%".addslashes($filter)."%' OR koreksi_date_update LIKE '%".addslashes($filter)."%' OR koreksi_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($koreksi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_id LIKE '%".$koreksi_id."%'";
				};
				if($koreksi_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_gudang LIKE '%".$koreksi_gudang."%'";
				};
				if($koreksi_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_tanggal LIKE '%".$koreksi_tanggal."%'";
				};
				if($koreksi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_keterangan LIKE '%".$koreksi_keterangan."%'";
				};
				if($koreksi_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_creator LIKE '%".$koreksi_creator."%'";
				};
				if($koreksi_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_date_create LIKE '%".$koreksi_date_create."%'";
				};
				if($koreksi_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_update LIKE '%".$koreksi_update."%'";
				};
				if($koreksi_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_date_update LIKE '%".$koreksi_date_update."%'";
				};
				if($koreksi_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " koreksi_revised LIKE '%".$koreksi_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>