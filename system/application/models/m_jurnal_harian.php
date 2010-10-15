<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_harian Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_harian.php
 	+ creator 		: 
 	+ Created on 01/Apr/2010 12:13:56
	
*/

class M_jurnal_harian extends Model{
		
		//constructor
		function M_jurnal_harian() {
			parent::Model();
		}
		
		function get_akun_list($task, $master_id, $selected_id, $filter="",$start=0,$end=15){
			$sql = "SELECT A.* from akun A
					WHERE A.akun_kode not in (
					SELECT B.akun_parent_kode FROM akun B WHERE B.akun_parent_kode is NOT NULL)";
	
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$limit = $sql." LIMIT ".$start.",".$end;			
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
	
				
		//function for get list record
		function jurnal_harian_list($filter,$start,$end){
			$query = "SELECT vu_jurnal_harian.*,date_format(tanggal,'%Y-%m-%d') as tanggal FROM vu_jurnal_harian ";

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " tanggal LIKE '%".addslashes($filter)."%' OR 
							no_jurnal LIKE '%".addslashes($filter)."%' ";
			}
			$query.=" ORDER by no_jurnal DESC";
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
		
		
		//function for advanced search record
		function jurnal_harian_search($jurnal_no ,$jurnal_tgl_awal ,$jurnal_tgl_akhir ,$start,$end){
			//full query
			$query="SELECT vu_jurnal_harian.*,date_format(tanggal,'%Y-%m-%d') as tanggal FROM vu_jurnal_harian ";
			

			if($jurnal_tgl_awal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " date_format(tanggal,'%Y-%m-%d')>='".$jurnal_tgl_awal."'";
			};
			if($jurnal_tgl_akhir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " date_format(tanggal,'%Y-%m-%d')<='".$jurnal_tgl_akhir."'";
			};
			if($jurnal_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " no_jurnal LIKE '%".$jurnal_no."%'";
			};
			
			$query.=" ORDER by no_jurnal DESC";
			
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
		function jurnal_harian_print($jurnal_no ,$jurnal_tgl_awal ,$jurnal_tgl_akhir ,$option,$filter){
			//full query
			$sql="SELECT vu_jurnal_harian.*,date_format(tanggal,'%Y-%m-%d') as tanggal FROM vu_jurnal_harian ";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (no_jurnal LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%')";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($jurnal_tgl_awal!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " date_format(tanggal,'%Y-%m-%d')>='".$jurnal_tgl_awal."'";
				};
				if($jurnal_tgl_akhir!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " date_format(tanggal,'%Y-%m-%d')<='".$jurnal_tgl_akhir."'";
				};
				if($jurnal_no!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " no_jurnal LIKE '%".$jurnal_no."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function jurnal_harian_export_excel($jurnal_no ,$jurnal_tgl_awal ,$jurnal_tgl_akhir ,$option,$filter){
			//full query
			$sql="SELECT vu_jurnal_harian.*,date_format(tanggal,'%Y-%m-%d') as tanggal FROM vu_jurnal_harian ";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (no_jurnal LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%')";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($jurnal_tgl_awal!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " date_format(tanggal,'%Y-%m-%d')>='".$jurnal_tgl_awal."'";
				};
				if($jurnal_tgl_akhir!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " date_format(tanggal,'%Y-%m-%d')<='".$jurnal_tgl_akhir."'";
				};
				if($jurnal_no!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " no_jurnal LIKE '%".$jurnal_no."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>