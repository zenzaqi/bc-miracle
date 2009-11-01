<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_umum Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_umum.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:25:17
	
*/

class M_jurnal_umum extends Model{
		
		//constructor
		function M_jurnal_umum() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_jurnal_umum_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM jurnal_umum_detail where djumum_master='".$master_id."'";
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
			$query = "SELECT max(jumum_id) as master_id from jurnal_umum";
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
		function detail_jurnal_umum_detail_purge($master_id){
			$sql="DELETE from jurnal_umum_detail where djumum_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_jurnal_umum_detail_insert($djumum_id ,$djumum_master ,$djumum_akun ,$djumum_keterangan ,$djumum_debet ,$djumum_kredit ){
			//if master id not capture from view then capture it from max pk from master table
			if($djumum_master=="" || $djumum_master==NULL){
				$djumum_master=$this->get_master_id();
			}
			
			$data = array(
				"djumum_id"=>$djumum_id, 
				"djumum_master"=>$djumum_master, 
				"djumum_akun"=>$djumum_akun, 
				"djumum_keterangan"=>$djumum_keterangan, 
				"djumum_debet"=>$djumum_debet, 
				"djumum_kredit"=>$djumum_kredit 
			);
			$this->db->insert('jurnal_umum_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function jurnal_umum_list($filter,$start,$end){
			$query = "SELECT * FROM jurnal_umum";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jumum_id LIKE '%".addslashes($filter)."%' OR jumum_tanggal LIKE '%".addslashes($filter)."%' OR jumum_pengguna LIKE '%".addslashes($filter)."%' OR jumum_keterangan LIKE '%".addslashes($filter)."%' OR jumum_posting LIKE '%".addslashes($filter)."%' OR jumum_tglposting LIKE '%".addslashes($filter)."%' )";
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
		function jurnal_umum_update($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ){
			$data = array(
				"jumum_id"=>$jumum_id, 
				"jumum_tanggal"=>$jumum_tanggal, 
				"jumum_pengguna"=>$jumum_pengguna, 
				"jumum_keterangan"=>$jumum_keterangan, 
				"jumum_posting"=>$jumum_posting, 
				"jumum_tglposting"=>$jumum_tglposting 
			);
			$this->db->where('jumum_id', $jumum_id);
			$this->db->update('jurnal_umum', $data);
			
			return '1';
		}
		
		//function for create new record
		function jurnal_umum_create($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ){
			$data = array(
				"jumum_id"=>$jumum_id, 
				"jumum_tanggal"=>$jumum_tanggal, 
				"jumum_pengguna"=>$jumum_pengguna, 
				"jumum_keterangan"=>$jumum_keterangan, 
				"jumum_posting"=>$jumum_posting, 
				"jumum_tglposting"=>$jumum_tglposting 
			);
			$this->db->insert('jurnal_umum', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jurnal_umum_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jurnal_umums at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jurnal_umum WHERE jumum_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jurnal_umum WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jumum_id= ".$pkid[$i];
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
		function jurnal_umum_search($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ,$start,$end){
			//full query
			$query="select * from jurnal_umum";
			
			if($jumum_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jumum_id LIKE '%".$jumum_id."%'";
			};
			if($jumum_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jumum_tanggal LIKE '%".$jumum_tanggal."%'";
			};
			if($jumum_pengguna!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jumum_pengguna LIKE '%".$jumum_pengguna."%'";
			};
			if($jumum_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jumum_keterangan LIKE '%".$jumum_keterangan."%'";
			};
			if($jumum_posting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jumum_posting LIKE '%".$jumum_posting."%'";
			};
			if($jumum_tglposting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jumum_tglposting LIKE '%".$jumum_tglposting."%'";
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
		function jurnal_umum_print($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_umum";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jumum_id LIKE '%".addslashes($filter)."%' OR jumum_tanggal LIKE '%".addslashes($filter)."%' OR jumum_pengguna LIKE '%".addslashes($filter)."%' OR jumum_keterangan LIKE '%".addslashes($filter)."%' OR jumum_posting LIKE '%".addslashes($filter)."%' OR jumum_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jumum_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_id LIKE '%".$jumum_id."%'";
				};
				if($jumum_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_tanggal LIKE '%".$jumum_tanggal."%'";
				};
				if($jumum_pengguna!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_pengguna LIKE '%".$jumum_pengguna."%'";
				};
				if($jumum_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_keterangan LIKE '%".$jumum_keterangan."%'";
				};
				if($jumum_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_posting LIKE '%".$jumum_posting."%'";
				};
				if($jumum_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_tglposting LIKE '%".$jumum_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jurnal_umum_export_excel($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_umum";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jumum_id LIKE '%".addslashes($filter)."%' OR jumum_tanggal LIKE '%".addslashes($filter)."%' OR jumum_pengguna LIKE '%".addslashes($filter)."%' OR jumum_keterangan LIKE '%".addslashes($filter)."%' OR jumum_posting LIKE '%".addslashes($filter)."%' OR jumum_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jumum_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_id LIKE '%".$jumum_id."%'";
				};
				if($jumum_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_tanggal LIKE '%".$jumum_tanggal."%'";
				};
				if($jumum_pengguna!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_pengguna LIKE '%".$jumum_pengguna."%'";
				};
				if($jumum_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_keterangan LIKE '%".$jumum_keterangan."%'";
				};
				if($jumum_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_posting LIKE '%".$jumum_posting."%'";
				};
				if($jumum_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jumum_tglposting LIKE '%".$jumum_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>