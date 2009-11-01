<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: anamnesa Model
	+ Description	: For record model process back-end
	+ Filename 		: c_anamnesa.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:37:33
	
*/

class M_anamnesa extends Model{
		
		//constructor
		function M_anamnesa() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_anamnesa_problem_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM anamnesa_problem where panam_master='".$master_id."'";
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
			$query = "SELECT max(anam_id) as master_id from anamnesa";
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
		function detail_anamnesa_problem_purge($master_id){
			$sql="DELETE from anamnesa_problem where panam_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_anamnesa_problem_insert($panam_id ,$panam_master ,$panam_problem ,$panam_lamaproblem ,$panam_aksiproblem ,$panam_aksiket ){
			//if master id not capture from view then capture it from max pk from master table
			if($panam_master=="" || $panam_master==NULL){
				$panam_master=$this->get_master_id();
			}
			
			$data = array(
				"panam_master"=>$panam_master, 
				"panam_problem"=>$panam_problem, 
				"panam_lamaproblem"=>$panam_lamaproblem, 
				"panam_aksiproblem"=>$panam_aksiproblem, 
				"panam_aksiket"=>$panam_aksiket 
			);
			$this->db->insert('anamnesa_problem', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function anamnesa_list($filter,$start,$end){
			$query = "SELECT * FROM anamnesa";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (anam_id LIKE '%".addslashes($filter)."%' OR anam_cust LIKE '%".addslashes($filter)."%' OR anam_tanggal LIKE '%".addslashes($filter)."%' OR anam_petugas LIKE '%".addslashes($filter)."%' OR anam_pengobatan LIKE '%".addslashes($filter)."%' OR anam_perawatan LIKE '%".addslashes($filter)."%' OR anam_terapi LIKE '%".addslashes($filter)."%' OR anam_alergi LIKE '%".addslashes($filter)."%' OR anam_obatalergi LIKE '%".addslashes($filter)."%' OR anam_efekobatalergi LIKE '%".addslashes($filter)."%' OR anam_hamil LIKE '%".addslashes($filter)."%' OR anam_kb LIKE '%".addslashes($filter)."%' OR anam_harapan LIKE '%".addslashes($filter)."%' )";
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
		function anamnesa_update($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ){
			$data = array(
				"anam_id"=>$anam_id, 
				"anam_cust"=>$anam_cust, 
				"anam_tanggal"=>$anam_tanggal, 
				"anam_petugas"=>$anam_petugas, 
				"anam_pengobatan"=>$anam_pengobatan, 
				"anam_perawatan"=>$anam_perawatan, 
				"anam_terapi"=>$anam_terapi, 
				"anam_alergi"=>$anam_alergi, 
				"anam_obatalergi"=>$anam_obatalergi, 
				"anam_efekobatalergi"=>$anam_efekobatalergi, 
				"anam_hamil"=>$anam_hamil, 
				"anam_kb"=>$anam_kb, 
				"anam_harapan"=>$anam_harapan 
			);
			$this->db->where('anam_id', $anam_id);
			$this->db->update('anamnesa', $data);
			
			return '1';
		}
		
		//function for create new record
		function anamnesa_create($anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ){
			$data = array(
				"anam_cust"=>$anam_cust, 
				"anam_tanggal"=>$anam_tanggal, 
				"anam_petugas"=>$anam_petugas, 
				"anam_pengobatan"=>$anam_pengobatan, 
				"anam_perawatan"=>$anam_perawatan, 
				"anam_terapi"=>$anam_terapi, 
				"anam_alergi"=>$anam_alergi, 
				"anam_obatalergi"=>$anam_obatalergi, 
				"anam_efekobatalergi"=>$anam_efekobatalergi, 
				"anam_hamil"=>$anam_hamil, 
				"anam_kb"=>$anam_kb, 
				"anam_harapan"=>$anam_harapan 
			);
			$this->db->insert('anamnesa', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function anamnesa_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the anamnesas at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM anamnesa WHERE anam_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM anamnesa WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "anam_id= ".$pkid[$i];
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
		function anamnesa_search($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ,$start,$end){
			//full query
			$query="select * from anamnesa";
			
			if($anam_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_id LIKE '%".$anam_id."%'";
			};
			if($anam_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_cust LIKE '%".$anam_cust."%'";
			};
			if($anam_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_tanggal LIKE '%".$anam_tanggal."%'";
			};
			if($anam_petugas!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_petugas LIKE '%".$anam_petugas."%'";
			};
			if($anam_pengobatan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_pengobatan LIKE '%".$anam_pengobatan."%'";
			};
			if($anam_perawatan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_perawatan LIKE '%".$anam_perawatan."%'";
			};
			if($anam_terapi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_terapi LIKE '%".$anam_terapi."%'";
			};
			if($anam_alergi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_alergi LIKE '%".$anam_alergi."%'";
			};
			if($anam_obatalergi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_obatalergi LIKE '%".$anam_obatalergi."%'";
			};
			if($anam_efekobatalergi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_efekobatalergi LIKE '%".$anam_efekobatalergi."%'";
			};
			if($anam_hamil!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_hamil LIKE '%".$anam_hamil."%'";
			};
			if($anam_kb!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_kb LIKE '%".$anam_kb."%'";
			};
			if($anam_harapan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " anam_harapan LIKE '%".$anam_harapan."%'";
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
		function anamnesa_print($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ,$option,$filter){
			//full query
			$query="select * from anamnesa";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (anam_id LIKE '%".addslashes($filter)."%' OR anam_cust LIKE '%".addslashes($filter)."%' OR anam_tanggal LIKE '%".addslashes($filter)."%' OR anam_petugas LIKE '%".addslashes($filter)."%' OR anam_pengobatan LIKE '%".addslashes($filter)."%' OR anam_perawatan LIKE '%".addslashes($filter)."%' OR anam_terapi LIKE '%".addslashes($filter)."%' OR anam_alergi LIKE '%".addslashes($filter)."%' OR anam_obatalergi LIKE '%".addslashes($filter)."%' OR anam_efekobatalergi LIKE '%".addslashes($filter)."%' OR anam_hamil LIKE '%".addslashes($filter)."%' OR anam_kb LIKE '%".addslashes($filter)."%' OR anam_harapan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($anam_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_id LIKE '%".$anam_id."%'";
				};
				if($anam_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_cust LIKE '%".$anam_cust."%'";
				};
				if($anam_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_tanggal LIKE '%".$anam_tanggal."%'";
				};
				if($anam_petugas!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_petugas LIKE '%".$anam_petugas."%'";
				};
				if($anam_pengobatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_pengobatan LIKE '%".$anam_pengobatan."%'";
				};
				if($anam_perawatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_perawatan LIKE '%".$anam_perawatan."%'";
				};
				if($anam_terapi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_terapi LIKE '%".$anam_terapi."%'";
				};
				if($anam_alergi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_alergi LIKE '%".$anam_alergi."%'";
				};
				if($anam_obatalergi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_obatalergi LIKE '%".$anam_obatalergi."%'";
				};
				if($anam_efekobatalergi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_efekobatalergi LIKE '%".$anam_efekobatalergi."%'";
				};
				if($anam_hamil!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_hamil LIKE '%".$anam_hamil."%'";
				};
				if($anam_kb!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_kb LIKE '%".$anam_kb."%'";
				};
				if($anam_harapan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_harapan LIKE '%".$anam_harapan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function anamnesa_export_excel($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ,$option,$filter){
			//full query
			$query="select * from anamnesa";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (anam_id LIKE '%".addslashes($filter)."%' OR anam_cust LIKE '%".addslashes($filter)."%' OR anam_tanggal LIKE '%".addslashes($filter)."%' OR anam_petugas LIKE '%".addslashes($filter)."%' OR anam_pengobatan LIKE '%".addslashes($filter)."%' OR anam_perawatan LIKE '%".addslashes($filter)."%' OR anam_terapi LIKE '%".addslashes($filter)."%' OR anam_alergi LIKE '%".addslashes($filter)."%' OR anam_obatalergi LIKE '%".addslashes($filter)."%' OR anam_efekobatalergi LIKE '%".addslashes($filter)."%' OR anam_hamil LIKE '%".addslashes($filter)."%' OR anam_kb LIKE '%".addslashes($filter)."%' OR anam_harapan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($anam_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_id LIKE '%".$anam_id."%'";
				};
				if($anam_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_cust LIKE '%".$anam_cust."%'";
				};
				if($anam_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_tanggal LIKE '%".$anam_tanggal."%'";
				};
				if($anam_petugas!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_petugas LIKE '%".$anam_petugas."%'";
				};
				if($anam_pengobatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_pengobatan LIKE '%".$anam_pengobatan."%'";
				};
				if($anam_perawatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_perawatan LIKE '%".$anam_perawatan."%'";
				};
				if($anam_terapi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_terapi LIKE '%".$anam_terapi."%'";
				};
				if($anam_alergi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_alergi LIKE '%".$anam_alergi."%'";
				};
				if($anam_obatalergi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_obatalergi LIKE '%".$anam_obatalergi."%'";
				};
				if($anam_efekobatalergi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_efekobatalergi LIKE '%".$anam_efekobatalergi."%'";
				};
				if($anam_hamil!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_hamil LIKE '%".$anam_hamil."%'";
				};
				if($anam_kb!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_kb LIKE '%".$anam_kb."%'";
				};
				if($anam_harapan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " anam_harapan LIKE '%".$anam_harapan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>