<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_ambil_paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_ambil_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 19/Aug/2009 15:30:59
	
*/

class M_master_ambil_paket extends Model{
		
		//constructor
		function M_master_ambil_paket() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_detail_ambil_paket_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_ambil_paket where dapaket_master='".$master_id."'";
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
			$query = "SELECT max(apaket_id) as master_id from master_ambil_paket";
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
		function detail_detail_ambil_paket_purge($master_id){
			$sql="DELETE from detail_ambil_paket where dapaket_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_ambil_paket_insert($dapaket_id ,$dapaket_master ,$dapaket_nama ,$dapaket_item ,$dapaket_jenis ,$dapaket_jumlah ,$dapaket_harga ){
			//if master id not capture from view then capture it from max pk from master table
			if($dapaket_master=="" || $dapaket_master==NULL){
				$dapaket_master=$this->get_master_id();
			}
			
			$data = array(
				"dapaket_master"=>$dapaket_master, 
				"dapaket_nama"=>$dapaket_nama, 
				"dapaket_item"=>$dapaket_item, 
				"dapaket_jenis"=>$dapaket_jenis, 
				"dapaket_jumlah"=>$dapaket_jumlah, 
				"dapaket_harga"=>$dapaket_harga 
			);
			$this->db->insert('detail_ambil_paket', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_ambil_paket_list($filter,$start,$end){
			$query = "SELECT * FROM master_ambil_paket";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (apaket_id LIKE '%".addslashes($filter)."%' OR apaket_jual LIKE '%".addslashes($filter)."%' OR apaket_cust LIKE '%".addslashes($filter)."%' OR apaket_tanggal LIKE '%".addslashes($filter)."%' )";
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
		function master_ambil_paket_update($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ){
			$data = array(
				"apaket_id"=>$apaket_id, 
				"apaket_jual"=>$apaket_jual, 
				"apaket_cust"=>$apaket_cust, 
				"apaket_tanggal"=>$apaket_tanggal 
			);
			$this->db->where('apaket_id', $apaket_id);
			$this->db->update('master_ambil_paket', $data);
			
			return '1';
		}
		
		//function for create new record
		function master_ambil_paket_create($apaket_jual ,$apaket_cust ,$apaket_tanggal ){
			$data = array(
				"apaket_jual"=>$apaket_jual, 
				"apaket_cust"=>$apaket_cust, 
				"apaket_tanggal"=>$apaket_tanggal 
			);
			$this->db->insert('master_ambil_paket', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_ambil_paket_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_ambil_pakets at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_ambil_paket WHERE apaket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_ambil_paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "apaket_id= ".$pkid[$i];
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
		function master_ambil_paket_search($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ,$start,$end){
			//full query
			$query="select * from master_ambil_paket";
			
			if($apaket_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_id LIKE '%".$apaket_id."%'";
			};
			if($apaket_jual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_jual LIKE '%".$apaket_jual."%'";
			};
			if($apaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
			};
			if($apaket_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_tanggal LIKE '%".$apaket_tanggal."%'";
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
		function master_ambil_paket_print($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ,$option,$filter){
			//full query
			$query="select * from master_ambil_paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (apaket_id LIKE '%".addslashes($filter)."%' OR apaket_jual LIKE '%".addslashes($filter)."%' OR apaket_cust LIKE '%".addslashes($filter)."%' OR apaket_tanggal LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($apaket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_id LIKE '%".$apaket_id."%'";
				};
				if($apaket_jual!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_jual LIKE '%".$apaket_jual."%'";
				};
				if($apaket_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
				};
				if($apaket_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_tanggal LIKE '%".$apaket_tanggal."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_ambil_paket_export_excel($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ,$option,$filter){
			//full query
			$query="select * from master_ambil_paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (apaket_id LIKE '%".addslashes($filter)."%' OR apaket_jual LIKE '%".addslashes($filter)."%' OR apaket_cust LIKE '%".addslashes($filter)."%' OR apaket_tanggal LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($apaket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_id LIKE '%".$apaket_id."%'";
				};
				if($apaket_jual!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_jual LIKE '%".$apaket_jual."%'";
				};
				if($apaket_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
				};
				if($apaket_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " apaket_tanggal LIKE '%".$apaket_tanggal."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>