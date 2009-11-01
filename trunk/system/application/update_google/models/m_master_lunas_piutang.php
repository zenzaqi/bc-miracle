<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_lunas_piutang Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_lunas_piutang.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:05
	
*/

class M_master_lunas_piutang extends Model{
		
		//constructor
		function M_master_lunas_piutang() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_detail_lunas_piutang_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_lunas_piutang where dpiutang_master='".$master_id."'";
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
			$query = "SELECT max(lpiutang_id) as master_id from master_lunas_piutang";
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
		function detail_detail_lunas_piutang_purge($master_id){
			$sql="DELETE from detail_lunas_piutang where dpiutang_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_lunas_piutang_insert($dpiutang_id ,$dpiutang_master ,$dpiutang_nohutang ,$dpiutang_nilai ){
			//if master id not capture from view then capture it from max pk from master table
			if($dpiutang_master=="" || $dpiutang_master==NULL){
				$dpiutang_master=$this->get_master_id();
			}
			
			$data = array(
				"dpiutang_master"=>$dpiutang_master, 
				"dpiutang_nohutang"=>$dpiutang_nohutang, 
				"dpiutang_nilai"=>$dpiutang_nilai 
			);
			$this->db->insert('detail_lunas_piutang', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_lunas_piutang_list($filter,$start,$end){
			$query = "SELECT * FROM master_lunas_piutang";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_id LIKE '%".addslashes($filter)."%' OR lpiutang_no LIKE '%".addslashes($filter)."%' OR lpiutang_cust LIKE '%".addslashes($filter)."%' OR lpiutang_tanggal LIKE '%".addslashes($filter)."%' OR lpiutang_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_lunas_piutang_update($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ){
			$data = array(
				"lpiutang_id"=>$lpiutang_id, 
				"lpiutang_no"=>$lpiutang_no, 
				"lpiutang_cust"=>$lpiutang_cust, 
				"lpiutang_tanggal"=>$lpiutang_tanggal, 
				"lpiutang_keterangan"=>$lpiutang_keterangan 
			);
			$this->db->where('lpiutang_id', $lpiutang_id);
			$this->db->update('master_lunas_piutang', $data);
			
			return '1';
		}
		
		//function for create new record
		function master_lunas_piutang_create($lpiutang_no ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ){
			$data = array(
				"lpiutang_no"=>$lpiutang_no, 
				"lpiutang_cust"=>$lpiutang_cust, 
				"lpiutang_tanggal"=>$lpiutang_tanggal, 
				"lpiutang_keterangan"=>$lpiutang_keterangan 
			);
			$this->db->insert('master_lunas_piutang', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_lunas_piutang_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_lunas_piutangs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_lunas_piutang WHERE lpiutang_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_lunas_piutang WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "lpiutang_id= ".$pkid[$i];
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
		function master_lunas_piutang_search($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$start,$end){
			//full query
			$query="select * from master_lunas_piutang";
			
			if($lpiutang_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_id LIKE '%".$lpiutang_id."%'";
			};
			if($lpiutang_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_no LIKE '%".$lpiutang_no."%'";
			};
			if($lpiutang_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_cust LIKE '%".$lpiutang_cust."%'";
			};
			if($lpiutang_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_tanggal LIKE '%".$lpiutang_tanggal."%'";
			};
			if($lpiutang_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_keterangan LIKE '%".$lpiutang_keterangan."%'";
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
		function master_lunas_piutang_print($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$option,$filter){
			//full query
			$query="select * from master_lunas_piutang";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_id LIKE '%".addslashes($filter)."%' OR lpiutang_no LIKE '%".addslashes($filter)."%' OR lpiutang_cust LIKE '%".addslashes($filter)."%' OR lpiutang_tanggal LIKE '%".addslashes($filter)."%' OR lpiutang_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($lpiutang_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_id LIKE '%".$lpiutang_id."%'";
				};
				if($lpiutang_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_no LIKE '%".$lpiutang_no."%'";
				};
				if($lpiutang_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_cust LIKE '%".$lpiutang_cust."%'";
				};
				if($lpiutang_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_tanggal LIKE '%".$lpiutang_tanggal."%'";
				};
				if($lpiutang_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_keterangan LIKE '%".$lpiutang_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_lunas_piutang_export_excel($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$option,$filter){
			//full query
			$query="select * from master_lunas_piutang";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_id LIKE '%".addslashes($filter)."%' OR lpiutang_no LIKE '%".addslashes($filter)."%' OR lpiutang_cust LIKE '%".addslashes($filter)."%' OR lpiutang_tanggal LIKE '%".addslashes($filter)."%' OR lpiutang_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($lpiutang_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_id LIKE '%".$lpiutang_id."%'";
				};
				if($lpiutang_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_no LIKE '%".$lpiutang_no."%'";
				};
				if($lpiutang_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_cust LIKE '%".$lpiutang_cust."%'";
				};
				if($lpiutang_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_tanggal LIKE '%".$lpiutang_tanggal."%'";
				};
				if($lpiutang_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_keterangan LIKE '%".$lpiutang_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>