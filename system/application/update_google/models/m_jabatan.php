<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jabatan Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jabatan.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 06/Aug/2009 15:46:36
	
*/

class M_jabatan extends Model{
		
		//constructor
		function M_jabatan() {
			parent::Model();
		}
		
		//function for get list record
		function jabatan_list($filter,$start,$end){
			$query = "SELECT * FROM jabatan";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jabatan_id LIKE '%".addslashes($filter)."%' OR jabatan_nama LIKE '%".addslashes($filter)."%' OR jabatan_keterangan LIKE '%".addslashes($filter)."%' OR jabatan_aktif LIKE '%".addslashes($filter)."%' )";
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
		function jabatan_update($jabatan_id ,$jabatan_nama ,$jabatan_keterangan ,$jabatan_aktif ){
		if ($jabatan_aktif=="")
			$jabatan_aktif = "Aktif";
			$data = array(
				"jabatan_id"=>$jabatan_id,			
				"jabatan_nama"=>$jabatan_nama,			
				"jabatan_keterangan"=>$jabatan_keterangan,			
				"jabatan_aktif"=>$jabatan_aktif,			
//				"jabatan_creator"=>$jabatan_creator,			
//				"jabatan_date_create"=>$jabatan_date_create,			
//				"jabatan_update"=>$jabatan_update,			
//				"jabatan_date_update"=>$jabatan_date_update,			
//				"jabatan_revised"=>$jabatan_revised			
			);
			$this->db->where('jabatan_id', $jabatan_id);
			$this->db->update('jabatan', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function jabatan_create($jabatan_nama ,$jabatan_keterangan ,$jabatan_aktif ){
		if ($jabatan_aktif=="")
			$jabatan_aktif = "Aktif";
			$data = array(
	
				"jabatan_nama"=>$jabatan_nama,	
				"jabatan_keterangan"=>$jabatan_keterangan,	
				"jabatan_aktif"=>$jabatan_aktif,	
//				"jabatan_creator"=>$jabatan_creator,	
//				"jabatan_date_create"=>$jabatan_date_create,	
//				"jabatan_update"=>$jabatan_update,	
//				"jabatan_date_update"=>$jabatan_date_update,	
//				"jabatan_revised"=>$jabatan_revised	
			);
			$this->db->insert('jabatan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jabatan_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jabatans at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jabatan WHERE jabatan_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jabatan WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jabatan_id= ".$pkid[$i];
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
		function jabatan_search($jabatan_id ,$jabatan_nama ,$jabatan_keterangan ,$jabatan_aktif ,$start,$end){
			//full query
			$query="select * from jabatan";
			
			if($jabatan_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jabatan_id LIKE '%".$jabatan_id."%'";
			};
			if($jabatan_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jabatan_nama LIKE '%".$jabatan_nama."%'";
			};
			if($jabatan_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jabatan_keterangan LIKE '%".$jabatan_keterangan."%'";
			};
			if($jabatan_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jabatan_aktif LIKE '%".$jabatan_aktif."%'";
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
		function jabatan_print($jabatan_id ,$jabatan_nama ,$jabatan_keterangan ,$jabatan_aktif ,$option,$filter){
			//full query
			$query="select * from jabatan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jabatan_id LIKE '%".addslashes($filter)."%' OR jabatan_nama LIKE '%".addslashes($filter)."%' OR jabatan_keterangan LIKE '%".addslashes($filter)."%' OR jabatan_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jabatan_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_id LIKE '%".$jabatan_id."%'";
				};
				if($jabatan_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_nama LIKE '%".$jabatan_nama."%'";
				};
				if($jabatan_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_keterangan LIKE '%".$jabatan_keterangan."%'";
				};
				if($jabatan_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_aktif LIKE '%".$jabatan_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jabatan_export_excel($jabatan_id ,$jabatan_nama ,$jabatan_keterangan ,$jabatan_aktif ,$option,$filter){
			//full query
			$query="select * from jabatan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jabatan_id LIKE '%".addslashes($filter)."%' OR jabatan_nama LIKE '%".addslashes($filter)."%' OR jabatan_keterangan LIKE '%".addslashes($filter)."%' OR jabatan_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jabatan_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_id LIKE '%".$jabatan_id."%'";
				};
				if($jabatan_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_nama LIKE '%".$jabatan_nama."%'";
				};
				if($jabatan_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_keterangan LIKE '%".$jabatan_keterangan."%'";
				};
				if($jabatan_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jabatan_aktif LIKE '%".$jabatan_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>