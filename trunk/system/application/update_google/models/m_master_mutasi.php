<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_mutasi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_mutasi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:45:23
	
*/

class M_master_mutasi extends Model{
		
		//constructor
		function M_master_mutasi() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_detail_mutasi_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_mutasi where dmutasi_master='".$master_id."'";
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
			$query = "SELECT max(mutasi_id) as master_id from master_mutasi";
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
		function detail_detail_mutasi_purge($master_id){
			$sql="DELETE from detail_mutasi where dmutasi_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_mutasi_insert($dmutasi_id ,$dmutasi_master ,$dmutasi_produk ,$dmutasi_satuan ,$dmutasi_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($dmutasi_master=="" || $dmutasi_master==NULL){
				$dmutasi_master=$this->get_master_id();
			}
			
			$data = array(
				"dmutasi_master"=>$dmutasi_master, 
				"dmutasi_produk"=>$dmutasi_produk, 
				"dmutasi_satuan"=>$dmutasi_satuan, 
				"dmutasi_jumlah"=>$dmutasi_jumlah 
			);
			$this->db->insert('detail_mutasi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_mutasi_list($filter,$start,$end){
			$query = "SELECT master_mutasi.*,asal.gudang_nama as gudang_nama_asal,tujuan.gudang_nama as gudang_nama_tujuan FROM master_mutasi,gudang as asal,gudang as tujuan WHERE mutasi_asal=asal.gudang_id AND mutasi_tujuan=tujuan.gudang_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (mutasi_id LIKE '%".addslashes($filter)."%' OR mutasi_asal LIKE '%".addslashes($filter)."%' OR mutasi_tujuan LIKE '%".addslashes($filter)."%' OR mutasi_tanggal LIKE '%".addslashes($filter)."%' OR mutasi_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_mutasi_update($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ){
			$data = array(
				"mutasi_id"=>$mutasi_id, 
//				"mutasi_asal"=>$mutasi_asal, 
//				"mutasi_tujuan"=>$mutasi_tujuan, 
				"mutasi_tanggal"=>$mutasi_tanggal, 
				"mutasi_keterangan"=>$mutasi_keterangan 
			);
			$sql="SELECT gudang_id FROM gudang WHERE gudang_id='".$mutasi_asal."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["mutasi_asal"]=$mutasi_asal;
			
			$sql="SELECT gudang_id FROM gudang WHERE gudang_id='".$mutasi_tujuan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["mutasi_tujuan"]=$mutasi_tujuan;
			
			$this->db->where('mutasi_id', $mutasi_id);
			$this->db->update('master_mutasi', $data);
			
			return '1';
		}
		
		//function for create new record
		function master_mutasi_create($mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ){
			$data = array(
				"mutasi_asal"=>$mutasi_asal, 
				"mutasi_tujuan"=>$mutasi_tujuan, 
				"mutasi_tanggal"=>$mutasi_tanggal, 
				"mutasi_keterangan"=>$mutasi_keterangan 
			);
			$this->db->insert('master_mutasi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_mutasi_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_mutasis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_mutasi WHERE mutasi_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_mutasi WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "mutasi_id= ".$pkid[$i];
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
		function master_mutasi_search($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ,$start,$end){
			//full query
			$query="select * from master_mutasi";
			
			if($mutasi_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_id LIKE '%".$mutasi_id."%'";
			};
			if($mutasi_asal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_asal LIKE '%".$mutasi_asal."%'";
			};
			if($mutasi_tujuan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_tujuan LIKE '%".$mutasi_tujuan."%'";
			};
			if($mutasi_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_tanggal LIKE '%".$mutasi_tanggal."%'";
			};
			if($mutasi_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_keterangan LIKE '%".$mutasi_keterangan."%'";
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
		function master_mutasi_print($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ,$option,$filter){
			//full query
			$query="select * from master_mutasi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (mutasi_id LIKE '%".addslashes($filter)."%' OR mutasi_asal LIKE '%".addslashes($filter)."%' OR mutasi_tujuan LIKE '%".addslashes($filter)."%' OR mutasi_tanggal LIKE '%".addslashes($filter)."%' OR mutasi_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($mutasi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_id LIKE '%".$mutasi_id."%'";
				};
				if($mutasi_asal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_asal LIKE '%".$mutasi_asal."%'";
				};
				if($mutasi_tujuan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_tujuan LIKE '%".$mutasi_tujuan."%'";
				};
				if($mutasi_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_tanggal LIKE '%".$mutasi_tanggal."%'";
				};
				if($mutasi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_keterangan LIKE '%".$mutasi_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_mutasi_export_excel($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ,$option,$filter){
			//full query
			$query="select * from master_mutasi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (mutasi_id LIKE '%".addslashes($filter)."%' OR mutasi_asal LIKE '%".addslashes($filter)."%' OR mutasi_tujuan LIKE '%".addslashes($filter)."%' OR mutasi_tanggal LIKE '%".addslashes($filter)."%' OR mutasi_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($mutasi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_id LIKE '%".$mutasi_id."%'";
				};
				if($mutasi_asal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_asal LIKE '%".$mutasi_asal."%'";
				};
				if($mutasi_tujuan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_tujuan LIKE '%".$mutasi_tujuan."%'";
				};
				if($mutasi_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_tanggal LIKE '%".$mutasi_tanggal."%'";
				};
				if($mutasi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " mutasi_keterangan LIKE '%".$mutasi_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>