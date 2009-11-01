<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_kas_terima Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_kas_terima.php
 	+ Author  		: 
 	+ Created on 03/Oct/2009 13:10:15
	
*/

class M_jurnal_kas_terima extends Model{
		
		//constructor
		function M_jurnal_kas_terima() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_jurnal_kas_terima_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM jurnal_kas_terima_detail where djmkas_master='".$master_id."'";
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
			$query = "SELECT max(jmkas_id) as master_id from jurnal_kas_terima";
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
		function detail_jurnal_kas_terima_detail_purge($master_id){
			$sql="DELETE from jurnal_kas_terima_detail where djmkas_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_jurnal_kas_terima_detail_insert($djmkas_id ,$djmkas_master ,$djmkas_akun ,$djmkas_keterangan ,$djmkas_nilai ){
			//if master id not capture from view then capture it from max pk from master table
			if($djmkas_master=="" || $djmkas_master==NULL){
				$djmkas_master=$this->get_master_id();
			}
			
			$data = array(
				"djmkas_master"=>$djmkas_master, 
				"djmkas_akun"=>$djmkas_akun, 
				"djmkas_keterangan"=>$djmkas_keterangan, 
				"djmkas_nilai"=>$djmkas_nilai 
			);
			$this->db->insert('jurnal_kas_terima_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function jurnal_kas_terima_list($filter,$start,$end){
			$query = "SELECT * FROM jurnal_kas_terima,akun WHERE jmkas_akun=akun_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jmkas_id LIKE '%".addslashes($filter)."%' OR jmkas_akun LIKE '%".addslashes($filter)."%' OR jmkas_tanggal LIKE '%".addslashes($filter)."%' OR jmkas_keterangan LIKE '%".addslashes($filter)."%' OR jmkas_nilai LIKE '%".addslashes($filter)."%' OR jmkas_asal LIKE '%".addslashes($filter)."%' OR jmkas_ref LIKE '%".addslashes($filter)."%' OR jmkas_posting LIKE '%".addslashes($filter)."%' OR jmkas_tglposting LIKE '%".addslashes($filter)."%' )";
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
		function jurnal_kas_terima_update($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ){
			$data = array(
				"jmkas_id"=>$jmkas_id, 
				"jmkas_akun"=>$jmkas_akun, 
				"jmkas_tanggal"=>$jmkas_tanggal, 
				"jmkas_keterangan"=>$jmkas_keterangan, 
				"jmkas_nilai"=>$jmkas_nilai, 
				"jmkas_asal"=>$jmkas_asal, 
				"jmkas_ref"=>$jmkas_ref, 
				"jmkas_posting"=>$jmkas_posting, 
				"jmkas_tglposting"=>$jmkas_tglposting 
			);
			$this->db->where('jmkas_id', $jmkas_id);
			$this->db->update('jurnal_kas_terima', $data);
			
			return '1';
		}
		
		//function for create new record
		function jurnal_kas_terima_create($jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ){
			$data = array(
				"jmkas_akun"=>$jmkas_akun, 
				"jmkas_tanggal"=>$jmkas_tanggal, 
				"jmkas_keterangan"=>$jmkas_keterangan, 
				"jmkas_nilai"=>$jmkas_nilai, 
				"jmkas_asal"=>$jmkas_asal, 
				"jmkas_ref"=>$jmkas_ref, 
				"jmkas_posting"=>$jmkas_posting, 
				"jmkas_tglposting"=>$jmkas_tglposting 
			);
			$this->db->insert('jurnal_kas_terima', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jurnal_kas_terima_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jurnal_kas_terimas at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jurnal_kas_terima WHERE jmkas_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jurnal_kas_terima WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jmkas_id= ".$pkid[$i];
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
		function jurnal_kas_terima_search($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ,$start,$end){
			//full query
			$query="select * from jurnal_kas_terima";
			
			if($jmkas_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_id LIKE '%".$jmkas_id."%'";
			};
			if($jmkas_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_akun LIKE '%".$jmkas_akun."%'";
			};
			if($jmkas_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_tanggal LIKE '%".$jmkas_tanggal."%'";
			};
			if($jmkas_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_keterangan LIKE '%".$jmkas_keterangan."%'";
			};
			if($jmkas_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_nilai LIKE '%".$jmkas_nilai."%'";
			};
			if($jmkas_asal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_asal LIKE '%".$jmkas_asal."%'";
			};
			if($jmkas_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_ref LIKE '%".$jmkas_ref."%'";
			};
			if($jmkas_posting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_posting LIKE '%".$jmkas_posting."%'";
			};
			if($jmkas_tglposting!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jmkas_tglposting LIKE '%".$jmkas_tglposting."%'";
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
		function jurnal_kas_terima_print($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_kas_terima";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jmkas_id LIKE '%".addslashes($filter)."%' OR jmkas_akun LIKE '%".addslashes($filter)."%' OR jmkas_tanggal LIKE '%".addslashes($filter)."%' OR jmkas_keterangan LIKE '%".addslashes($filter)."%' OR jmkas_nilai LIKE '%".addslashes($filter)."%' OR jmkas_asal LIKE '%".addslashes($filter)."%' OR jmkas_ref LIKE '%".addslashes($filter)."%' OR jmkas_posting LIKE '%".addslashes($filter)."%' OR jmkas_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jmkas_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_id LIKE '%".$jmkas_id."%'";
				};
				if($jmkas_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_akun LIKE '%".$jmkas_akun."%'";
				};
				if($jmkas_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_tanggal LIKE '%".$jmkas_tanggal."%'";
				};
				if($jmkas_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_keterangan LIKE '%".$jmkas_keterangan."%'";
				};
				if($jmkas_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_nilai LIKE '%".$jmkas_nilai."%'";
				};
				if($jmkas_asal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_asal LIKE '%".$jmkas_asal."%'";
				};
				if($jmkas_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_ref LIKE '%".$jmkas_ref."%'";
				};
				if($jmkas_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_posting LIKE '%".$jmkas_posting."%'";
				};
				if($jmkas_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_tglposting LIKE '%".$jmkas_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jurnal_kas_terima_export_excel($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ,$option,$filter){
			//full query
			$query="select * from jurnal_kas_terima";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jmkas_id LIKE '%".addslashes($filter)."%' OR jmkas_akun LIKE '%".addslashes($filter)."%' OR jmkas_tanggal LIKE '%".addslashes($filter)."%' OR jmkas_keterangan LIKE '%".addslashes($filter)."%' OR jmkas_nilai LIKE '%".addslashes($filter)."%' OR jmkas_asal LIKE '%".addslashes($filter)."%' OR jmkas_ref LIKE '%".addslashes($filter)."%' OR jmkas_posting LIKE '%".addslashes($filter)."%' OR jmkas_tglposting LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jmkas_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_id LIKE '%".$jmkas_id."%'";
				};
				if($jmkas_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_akun LIKE '%".$jmkas_akun."%'";
				};
				if($jmkas_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_tanggal LIKE '%".$jmkas_tanggal."%'";
				};
				if($jmkas_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_keterangan LIKE '%".$jmkas_keterangan."%'";
				};
				if($jmkas_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_nilai LIKE '%".$jmkas_nilai."%'";
				};
				if($jmkas_asal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_asal LIKE '%".$jmkas_asal."%'";
				};
				if($jmkas_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_ref LIKE '%".$jmkas_ref."%'";
				};
				if($jmkas_posting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_posting LIKE '%".$jmkas_posting."%'";
				};
				if($jmkas_tglposting!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jmkas_tglposting LIKE '%".$jmkas_tglposting."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>