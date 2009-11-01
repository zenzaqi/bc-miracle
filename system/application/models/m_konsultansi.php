<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: konsultansi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_konsultansi.php
 	+ Author  		: 
 	+ Created on 06/Oct/2009 08:41:02
	
*/

class M_konsultansi extends Model{
		
		//constructor
		function M_konsultansi() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_konsul_diagnosa_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM konsul_diagnosa where kdiagnosa_master='".$master_id."'";
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
			$query = "SELECT max(konsul_id) as master_id from konsultansi";
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
		function detail_konsul_diagnosa_purge($master_id){
			$sql="DELETE from konsul_diagnosa where kdiagnosa_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_konsul_diagnosa_insert($kdiagnosa_id ,$kdiagnosa_master ,$kdiagnosa_nama ,$kdiganosa_keterangan ){
			//if master id not capture from view then capture it from max pk from master table
			if($kdiagnosa_master=="" || $kdiagnosa_master==NULL){
				$kdiagnosa_master=$this->get_master_id();
			}
			
			$data = array(
				"kdiagnosa_master"=>$kdiagnosa_master, 
				"kdiagnosa_nama"=>$kdiagnosa_nama, 
				"kdiganosa_keterangan"=>$kdiganosa_keterangan 
			);
			$this->db->insert('konsul_diagnosa', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function konsultansi_list($filter,$start,$end){
			$query = "SELECT * FROM konsultansi";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (konsul_id LIKE '%".addslashes($filter)."%' OR konsul_cust LIKE '%".addslashes($filter)."%' OR konsul_dokter LIKE '%".addslashes($filter)."%' OR konsul_tanggal LIKE '%".addslashes($filter)."%' OR konsul_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function konsultansi_update($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ){
			$data = array(
				"konsul_id"=>$konsul_id, 
				"konsul_cust"=>$konsul_cust, 
				"konsul_dokter"=>$konsul_dokter, 
				"konsul_tanggal"=>$konsul_tanggal, 
				"konsul_keterangan"=>$konsul_keterangan 
			);
			$this->db->where('konsul_id', $konsul_id);
			$this->db->update('konsultansi', $data);
			
			return '1';
		}
		
		//function for create new record
		function konsultansi_create($konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ){
			$data = array(
				"konsul_cust"=>$konsul_cust, 
				"konsul_dokter"=>$konsul_dokter, 
				"konsul_tanggal"=>$konsul_tanggal, 
				"konsul_keterangan"=>$konsul_keterangan 
			);
			$this->db->insert('konsultansi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function konsultansi_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the konsultansis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM konsultansi WHERE konsul_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM konsultansi WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "konsul_id= ".$pkid[$i];
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
		function konsultansi_search($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ,$start,$end){
			//full query
			$query="select * from konsultansi";
			
			if($konsul_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konsul_id LIKE '%".$konsul_id."%'";
			};
			if($konsul_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konsul_cust LIKE '%".$konsul_cust."%'";
			};
			if($konsul_dokter!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konsul_dokter LIKE '%".$konsul_dokter."%'";
			};
			if($konsul_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konsul_tanggal LIKE '%".$konsul_tanggal."%'";
			};
			if($konsul_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konsul_keterangan LIKE '%".$konsul_keterangan."%'";
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
		function konsultansi_print($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ,$option,$filter){
			//full query
			$query="select * from konsultansi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (konsul_id LIKE '%".addslashes($filter)."%' OR konsul_cust LIKE '%".addslashes($filter)."%' OR konsul_dokter LIKE '%".addslashes($filter)."%' OR konsul_tanggal LIKE '%".addslashes($filter)."%' OR konsul_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($konsul_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_id LIKE '%".$konsul_id."%'";
				};
				if($konsul_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_cust LIKE '%".$konsul_cust."%'";
				};
				if($konsul_dokter!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_dokter LIKE '%".$konsul_dokter."%'";
				};
				if($konsul_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_tanggal LIKE '%".$konsul_tanggal."%'";
				};
				if($konsul_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_keterangan LIKE '%".$konsul_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function konsultansi_export_excel($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ,$option,$filter){
			//full query
			$query="select * from konsultansi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (konsul_id LIKE '%".addslashes($filter)."%' OR konsul_cust LIKE '%".addslashes($filter)."%' OR konsul_dokter LIKE '%".addslashes($filter)."%' OR konsul_tanggal LIKE '%".addslashes($filter)."%' OR konsul_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($konsul_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_id LIKE '%".$konsul_id."%'";
				};
				if($konsul_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_cust LIKE '%".$konsul_cust."%'";
				};
				if($konsul_dokter!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_dokter LIKE '%".$konsul_dokter."%'";
				};
				if($konsul_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_tanggal LIKE '%".$konsul_tanggal."%'";
				};
				if($konsul_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konsul_keterangan LIKE '%".$konsul_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>