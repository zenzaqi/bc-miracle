<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: cetak_kwitansi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_cetak_kwitansi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:03:04
	
*/

class M_cetak_kwitansi extends Model{
		
		//constructor
		function M_cetak_kwitansi() {
			parent::Model();
		}
		
		//function for get list record
		function cetak_kwitansi_list($filter,$start,$end){
			$query = "SELECT cetak_kwitansi.*,cust_nama FROM cetak_kwitansi,customer where kwitansi_cust=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kwitansi_id LIKE '%".addslashes($filter)."%' OR kwitansi_no LIKE '%".addslashes($filter)."%' OR kwitansi_cust LIKE '%".addslashes($filter)."%' OR kwitansi_ref LIKE '%".addslashes($filter)."%' OR kwitansi_nilai LIKE '%".addslashes($filter)."%' OR kwitansi_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function cetak_kwitansi_update($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan,$opsi){
			$data = array(
				"kwitansi_id"=>$kwitansi_id, 
				"kwitansi_ref"=>$kwitansi_ref, 
				"kwitansi_nilai"=>$kwitansi_nilai, 
				"kwitansi_keterangan"=>$kwitansi_keterangan 
			);
			$this->db->where('kwitansi_id', $kwitansi_id);
			$this->db->update('cetak_kwitansi', $data);
			
			if($opsi=="cetak")
					return $kwitansi_id;
				else
					return '1';
		}
		
		//function for create new record
		function cetak_kwitansi_create($kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan,$opsi){
			$pattern="KW/".date('ym')."-";
			$kwitansi_no=$this->m_public_function->get_kode_1("cetak_kwitansi","kwitansi_no",$pattern,12);
			$data = array(
				"kwitansi_no"=>$kwitansi_no, 
				"kwitansi_cust"=>$kwitansi_cust, 
				"kwitansi_ref"=>$kwitansi_ref, 
				"kwitansi_nilai"=>$kwitansi_nilai, 
				"kwitansi_keterangan"=>$kwitansi_keterangan 
			);
			$this->db->insert('cetak_kwitansi', $data); 
			if($this->db->affected_rows()){
				if($opsi=="cetak")
					return $this->db->insert_id();
				else
					return '1';
			}
			else
				return '0';
		}
		
		//fcuntion for delete record
		function cetak_kwitansi_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the cetak_kwitansis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM cetak_kwitansi WHERE kwitansi_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM cetak_kwitansi WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "kwitansi_id= ".$pkid[$i];
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
		function cetak_kwitansi_search($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$start,$end){
			//full query
			$query="select * from cetak_kwitansi";
			
			if($kwitansi_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_id LIKE '%".$kwitansi_id."%'";
			};
			if($kwitansi_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_no LIKE '%".$kwitansi_no."%'";
			};
			if($kwitansi_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_cust LIKE '%".$kwitansi_cust."%'";
			};
			if($kwitansi_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_ref LIKE '%".$kwitansi_ref."%'";
			};
			if($kwitansi_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_nilai LIKE '%".$kwitansi_nilai."%'";
			};
			if($kwitansi_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_keterangan LIKE '%".$kwitansi_keterangan."%'";
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
		
		function print_paper($kwitansi_id){
			
			$sql="select kwitansi_id,kwitansi_no,kwitansi_date_create,
					cust_no,cust_nama,kwitansi_nilai,kwitansi_keterangan from cetak_kwitansi,customer
					where kwitansi_cust=cust_id AND kwitansi_id='".$kwitansi_id."'";
			$result = $this->db->query($sql);
			return $result;
		}
		
		//function for print record
		function cetak_kwitansi_print($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$option,$filter){
			//full query
			$query="select * from cetak_kwitansi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kwitansi_id LIKE '%".addslashes($filter)."%' OR kwitansi_no LIKE '%".addslashes($filter)."%' OR kwitansi_cust LIKE '%".addslashes($filter)."%' OR kwitansi_ref LIKE '%".addslashes($filter)."%' OR kwitansi_nilai LIKE '%".addslashes($filter)."%' OR kwitansi_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($kwitansi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_id LIKE '%".$kwitansi_id."%'";
				};
				if($kwitansi_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_no LIKE '%".$kwitansi_no."%'";
				};
				if($kwitansi_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_cust LIKE '%".$kwitansi_cust."%'";
				};
				if($kwitansi_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_ref LIKE '%".$kwitansi_ref."%'";
				};
				if($kwitansi_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_nilai LIKE '%".$kwitansi_nilai."%'";
				};
				if($kwitansi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_keterangan LIKE '%".$kwitansi_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function cetak_kwitansi_export_excel($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$option,$filter){
			//full query
			$query="select * from cetak_kwitansi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kwitansi_id LIKE '%".addslashes($filter)."%' OR kwitansi_no LIKE '%".addslashes($filter)."%' OR kwitansi_cust LIKE '%".addslashes($filter)."%' OR kwitansi_ref LIKE '%".addslashes($filter)."%' OR kwitansi_nilai LIKE '%".addslashes($filter)."%' OR kwitansi_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($kwitansi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_id LIKE '%".$kwitansi_id."%'";
				};
				if($kwitansi_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_no LIKE '%".$kwitansi_no."%'";
				};
				if($kwitansi_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_cust LIKE '%".$kwitansi_cust."%'";
				};
				if($kwitansi_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_ref LIKE '%".$kwitansi_ref."%'";
				};
				if($kwitansi_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_nilai LIKE '%".$kwitansi_nilai."%'";
				};
				if($kwitansi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_keterangan LIKE '%".$kwitansi_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>