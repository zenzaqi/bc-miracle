<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tukar_point Model
	+ Description	: For record model process back-end
	+ Filename 		: c_tukar_point.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:33
	
*/

class M_tukar_point extends Model{
		
		//constructor
		function M_tukar_point() {
			parent::Model();
		}
		
		//function for get list record
		function tukar_point_list($filter,$start,$end){
			$query = "SELECT tukar_point.*,cust_nama,voucher_nama FROM tukar_point,customer,voucher_kupon,voucher where epoint_cust=cust_id and epoint_voucher=kvoucher_id and kvoucher_master=voucher_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (epoint_id LIKE '%".addslashes($filter)."%' OR epoint_cust LIKE '%".addslashes($filter)."%' OR epoint_jumlah LIKE '%".addslashes($filter)."%' OR epoint_voucher LIKE '%".addslashes($filter)."%' OR epoint_tanggal LIKE '%".addslashes($filter)."%' )";
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
		function tukar_point_update($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ){
			$data = array(
				"epoint_id"=>$epoint_id, 
				"epoint_cust"=>$epoint_cust, 
				"epoint_jumlah"=>$epoint_jumlah, 
				"epoint_voucher"=>$epoint_voucher, 
				"epoint_tanggal"=>$epoint_tanggal 
			);
			$this->db->where('epoint_id', $epoint_id);
			$this->db->update('tukar_point', $data);
			
			return '1';
		}
		
		//function for create new record
		function tukar_point_create($epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ){
			$data = array(
				"epoint_cust"=>$epoint_cust, 
				"epoint_jumlah"=>$epoint_jumlah, 
				"epoint_voucher"=>$epoint_voucher, 
				"epoint_tanggal"=>$epoint_tanggal 
			);
			$this->db->insert('tukar_point', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function tukar_point_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the tukar_points at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM tukar_point WHERE epoint_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM tukar_point WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "epoint_id= ".$pkid[$i];
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
		function tukar_point_search($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$start,$end){
			//full query
			$query="select * from tukar_point";
			
			if($epoint_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " epoint_id LIKE '%".$epoint_id."%'";
			};
			if($epoint_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " epoint_cust LIKE '%".$epoint_cust."%'";
			};
			if($epoint_jumlah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " epoint_jumlah LIKE '%".$epoint_jumlah."%'";
			};
			if($epoint_voucher!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " epoint_voucher LIKE '%".$epoint_voucher."%'";
			};
			if($epoint_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " epoint_tanggal LIKE '%".$epoint_tanggal."%'";
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
		function tukar_point_print($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$option,$filter){
			//full query
			$query="select * from tukar_point";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (epoint_id LIKE '%".addslashes($filter)."%' OR epoint_cust LIKE '%".addslashes($filter)."%' OR epoint_jumlah LIKE '%".addslashes($filter)."%' OR epoint_voucher LIKE '%".addslashes($filter)."%' OR epoint_tanggal LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($epoint_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_id LIKE '%".$epoint_id."%'";
				};
				if($epoint_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_cust LIKE '%".$epoint_cust."%'";
				};
				if($epoint_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_jumlah LIKE '%".$epoint_jumlah."%'";
				};
				if($epoint_voucher!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_voucher LIKE '%".$epoint_voucher."%'";
				};
				if($epoint_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_tanggal LIKE '%".$epoint_tanggal."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function tukar_point_export_excel($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$option,$filter){
			//full query
			$query="select * from tukar_point";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (epoint_id LIKE '%".addslashes($filter)."%' OR epoint_cust LIKE '%".addslashes($filter)."%' OR epoint_jumlah LIKE '%".addslashes($filter)."%' OR epoint_voucher LIKE '%".addslashes($filter)."%' OR epoint_tanggal LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($epoint_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_id LIKE '%".$epoint_id."%'";
				};
				if($epoint_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_cust LIKE '%".$epoint_cust."%'";
				};
				if($epoint_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_jumlah LIKE '%".$epoint_jumlah."%'";
				};
				if($epoint_voucher!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_voucher LIKE '%".$epoint_voucher."%'";
				};
				if($epoint_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " epoint_tanggal LIKE '%".$epoint_tanggal."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>