<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_jual Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_jual.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:22:58
	
*/

class M_jurnal_jual extends Model{
		
		//constructor
		function M_jurnal_jual() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_jurnal_jual_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM jurnal_jual_detail where djjual_master='".$master_id."'";
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
			$query = "SELECT max(jjual_id) as master_id from jurnal_jual";
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
		function detail_jurnal_jual_detail_purge($master_id){
			$sql="DELETE from jurnal_jual_detail where djjual_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_jurnal_jual_detail_insert($djjual_id ,$djjual_master ,$djjual_keterangan ,$djjual_akun ,$djjual_nilai ){
			//if master id not capture from view then capture it from max pk from master table
			if($djjual_master=="" || $djjual_master==NULL){
				$djjual_master=$this->get_master_id();
			}
			
			$data = array(
				"djjual_master"=>$djjual_master, 
				"djjual_keterangan"=>$djjual_keterangan, 
				"djjual_akun"=>$djjual_akun, 
				"djjual_nilai"=>$djjual_nilai 
			);
			$this->db->insert('jurnal_jual_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function jurnal_jual_list($filter,$start,$end){
			$query = "SELECT * FROM jurnal_jual,akun WHERE jjual_akun=akun_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jjual_id LIKE '%".addslashes($filter)."%' OR jjual_akun LIKE '%".addslashes($filter)."%' OR jjual_tanggal LIKE '%".addslashes($filter)."%' OR jjual_keterangan LIKE '%".addslashes($filter)."%' OR jjual_nilai LIKE '%".addslashes($filter)."%' OR jjual_ref LIKE '%".addslashes($filter)."%' OR jjual_penerima LIKE '%".addslashes($filter)."%' OR jjual_posting LIKE '%".addslashes($filter)."%' OR jjual_tglposting LIKE '%".addslashes($filter)."%' )";
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
		function jurnal_jual_update($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ){
			$data = array(
				"jjual_id"=>$jjual_id, 
				"jjual_akun"=>$jjual_akun, 
				"jjual_tanggal"=>$jjual_tanggal, 
				"jjual_keterangan"=>$jjual_keterangan, 
				"jjual_nilai"=>$jjual_nilai, 
				"jjual_ref"=>$jjual_ref, 
				"jjual_penerima"=>$jjual_penerima, 
				"jjual_posting"=>$jjual_posting, 
				"jjual_tglposting"=>$jjual_tglposting 
			);
			$this->db->where('jjual_id', $jjual_id);
			$this->db->update('jurnal_jual', $data);
			
			return '1';
		}
		
		//function for create new record
		function jurnal_jual_create($jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ){
			$data = array(
				"jjual_akun"=>$jjual_akun, 
				"jjual_tanggal"=>$jjual_tanggal, 
				"jjual_keterangan"=>$jjual_keterangan, 
				"jjual_nilai"=>$jjual_nilai, 
				"jjual_ref"=>$jjual_ref, 
				"jjual_penerima"=>$jjual_penerima, 
				"jjual_posting"=>$jjual_posting, 
				"jjual_tglposting"=>$jjual_tglposting 
			);
			$this->db->insert('jurnal_jual', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jurnal_jual_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jurnal_juals at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jurnal_jual WHERE jjual_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jurnal_jual WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jjual_id= ".$pkid[$i];
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
		function jurnal_jual_search($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ,$start,$end){
			//full query
			$query="select * from jurnal_jual";
			
			if($jjual_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_id LIKE '%".$jjual_id."%'";
			};
			if($jjual_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_akun LIKE '%".$jjual_akun."%'";
			};
			if($jjual_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_tanggal LIKE '%".$jjual_tanggal."%'";
			};
			if($jjual_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_keterangan LIKE '%".$jjual_keterangan."%'";
			};
			if($jjual_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_nilai LIKE '%".$jjual_nilai."%'";
			};
			if($jjual_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_ref LIKE '%".$jjual_ref."%'";
			};
			if($jjual_penerima!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_penerima LIKE '%".$jjual_penerima."%'";
			};
			if($jjual_posting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_posting LIKE '%".$jjual_posting."%'";
			};
			if($jjual_tglposting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jjual_tglposting LIKE '%".$jjual_tglposting."%'";
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
		function jurnal_jual_print($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_jual";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jjual_id LIKE '%".addslashes($filter)."%' OR jjual_akun LIKE '%".addslashes($filter)."%' OR jjual_tanggal LIKE '%".addslashes($filter)."%' OR jjual_keterangan LIKE '%".addslashes($filter)."%' OR jjual_nilai LIKE '%".addslashes($filter)."%' OR jjual_ref LIKE '%".addslashes($filter)."%' OR jjual_penerima LIKE '%".addslashes($filter)."%' OR jjual_posting LIKE '%".addslashes($filter)."%' OR jjual_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jjual_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_id LIKE '%".$jjual_id."%'";
				};
				if($jjual_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_akun LIKE '%".$jjual_akun."%'";
				};
				if($jjual_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_tanggal LIKE '%".$jjual_tanggal."%'";
				};
				if($jjual_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_keterangan LIKE '%".$jjual_keterangan."%'";
				};
				if($jjual_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_nilai LIKE '%".$jjual_nilai."%'";
				};
				if($jjual_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_ref LIKE '%".$jjual_ref."%'";
				};
				if($jjual_penerima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_penerima LIKE '%".$jjual_penerima."%'";
				};
				if($jjual_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_posting LIKE '%".$jjual_posting."%'";
				};
				if($jjual_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_tglposting LIKE '%".$jjual_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jurnal_jual_export_excel($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_jual";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jjual_id LIKE '%".addslashes($filter)."%' OR jjual_akun LIKE '%".addslashes($filter)."%' OR jjual_tanggal LIKE '%".addslashes($filter)."%' OR jjual_keterangan LIKE '%".addslashes($filter)."%' OR jjual_nilai LIKE '%".addslashes($filter)."%' OR jjual_ref LIKE '%".addslashes($filter)."%' OR jjual_penerima LIKE '%".addslashes($filter)."%' OR jjual_posting LIKE '%".addslashes($filter)."%' OR jjual_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jjual_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_id LIKE '%".$jjual_id."%'";
				};
				if($jjual_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_akun LIKE '%".$jjual_akun."%'";
				};
				if($jjual_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_tanggal LIKE '%".$jjual_tanggal."%'";
				};
				if($jjual_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_keterangan LIKE '%".$jjual_keterangan."%'";
				};
				if($jjual_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_nilai LIKE '%".$jjual_nilai."%'";
				};
				if($jjual_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_ref LIKE '%".$jjual_ref."%'";
				};
				if($jjual_penerima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_penerima LIKE '%".$jjual_penerima."%'";
				};
				if($jjual_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_posting LIKE '%".$jjual_posting."%'";
				};
				if($jjual_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jjual_tglposting LIKE '%".$jjual_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>