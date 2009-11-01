<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: aktiva_tetap Model
	+ Description	: For record model process back-end
	+ Filename 		: c_aktiva_tetap.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:45:57
	
*/

class M_aktiva_tetap extends Model{
		
		//constructor
		function M_aktiva_tetap() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_aktiva_tetap_depresiasi_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM aktiva_tetap_depresiasi where daktiva_master='".$master_id."'";
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
			$query = "SELECT max(aktiva_id) as master_id from aktiva_tetap";
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
		function detail_aktiva_tetap_depresiasi_purge($master_id){
			$sql="DELETE from aktiva_tetap_depresiasi where daktiva_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_aktiva_tetap_depresiasi_insert($daktiva_id ,$daktiva_master ,$daktiva_tanggal ,$daktiva_depresiasi ,$daktiva_saldo ){
			//if master id not capture from view then capture it from max pk from master table
			if($daktiva_master=="" || $daktiva_master==NULL){
				$daktiva_master=$this->get_master_id();
			}
			
			$data = array(
				"daktiva_master"=>$daktiva_master, 
				"daktiva_tanggal"=>$daktiva_tanggal, 
				"daktiva_depresiasi"=>$daktiva_depresiasi, 
				"daktiva_saldo"=>$daktiva_saldo 
			);
			$this->db->insert('aktiva_tetap_depresiasi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function aktiva_tetap_list($filter,$start,$end){
			$query = "SELECT * FROM aktiva_tetap";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (aktiva_id LIKE '%".addslashes($filter)."%' OR aktiva_akun LIKE '%".addslashes($filter)."%' OR aktiva_nama LIKE '%".addslashes($filter)."%' OR aktiva_nilai_awal LIKE '%".addslashes($filter)."%' OR aktiva_nilai_sekarang LIKE '%".addslashes($filter)."%' )";
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
		function aktiva_tetap_update($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ){
			$data = array(
				"aktiva_id"=>$aktiva_id, 
				"aktiva_akun"=>$aktiva_akun, 
				"aktiva_nama"=>$aktiva_nama, 
				"aktiva_nilai_awal"=>$aktiva_nilai_awal, 
				"aktiva_nilai_sekarang"=>$aktiva_nilai_sekarang 
			);
			$this->db->where('aktiva_id', $aktiva_id);
			$this->db->update('aktiva_tetap', $data);
			
			return '1';
		}
		
		//function for create new record
		function aktiva_tetap_create($aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ){
			$data = array(
				"aktiva_akun"=>$aktiva_akun, 
				"aktiva_nama"=>$aktiva_nama, 
				"aktiva_nilai_awal"=>$aktiva_nilai_awal, 
				"aktiva_nilai_sekarang"=>$aktiva_nilai_sekarang 
			);
			$this->db->insert('aktiva_tetap', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function aktiva_tetap_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the aktiva_tetaps at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM aktiva_tetap WHERE aktiva_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM aktiva_tetap WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "aktiva_id= ".$pkid[$i];
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
		function aktiva_tetap_search($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ,$start,$end){
			//full query
			$query="select * from aktiva_tetap";
			
			if($aktiva_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aktiva_id LIKE '%".$aktiva_id."%'";
			};
			if($aktiva_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aktiva_akun LIKE '%".$aktiva_akun."%'";
			};
			if($aktiva_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aktiva_nama LIKE '%".$aktiva_nama."%'";
			};
			if($aktiva_nilai_awal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aktiva_nilai_awal LIKE '%".$aktiva_nilai_awal."%'";
			};
			if($aktiva_nilai_sekarang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aktiva_nilai_sekarang LIKE '%".$aktiva_nilai_sekarang."%'";
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
		function aktiva_tetap_print($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ,$option,$filter){
			//full query
			$query="select * from aktiva_tetap";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (aktiva_id LIKE '%".addslashes($filter)."%' OR aktiva_akun LIKE '%".addslashes($filter)."%' OR aktiva_nama LIKE '%".addslashes($filter)."%' OR aktiva_nilai_awal LIKE '%".addslashes($filter)."%' OR aktiva_nilai_sekarang LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($aktiva_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_id LIKE '%".$aktiva_id."%'";
				};
				if($aktiva_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_akun LIKE '%".$aktiva_akun."%'";
				};
				if($aktiva_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_nama LIKE '%".$aktiva_nama."%'";
				};
				if($aktiva_nilai_awal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_nilai_awal LIKE '%".$aktiva_nilai_awal."%'";
				};
				if($aktiva_nilai_sekarang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_nilai_sekarang LIKE '%".$aktiva_nilai_sekarang."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function aktiva_tetap_export_excel($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ,$option,$filter){
			//full query
			$query="select * from aktiva_tetap";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (aktiva_id LIKE '%".addslashes($filter)."%' OR aktiva_akun LIKE '%".addslashes($filter)."%' OR aktiva_nama LIKE '%".addslashes($filter)."%' OR aktiva_nilai_awal LIKE '%".addslashes($filter)."%' OR aktiva_nilai_sekarang LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($aktiva_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_id LIKE '%".$aktiva_id."%'";
				};
				if($aktiva_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_akun LIKE '%".$aktiva_akun."%'";
				};
				if($aktiva_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_nama LIKE '%".$aktiva_nama."%'";
				};
				if($aktiva_nilai_awal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_nilai_awal LIKE '%".$aktiva_nilai_awal."%'";
				};
				if($aktiva_nilai_sekarang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aktiva_nilai_sekarang LIKE '%".$aktiva_nilai_sekarang."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>