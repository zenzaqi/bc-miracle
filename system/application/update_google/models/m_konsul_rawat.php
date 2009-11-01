<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: konsul_rawat Model
	+ Description	: For record model process back-end
	+ Filename 		: c_konsul_rawat.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 01:12:06
	
*/

class M_konsul_rawat extends Model{
		
		//constructor
		function M_konsul_rawat() {
			parent::Model();
		}
		
		//function for get list record
		function konsul_rawat_list($filter,$start,$end){
			$query = "SELECT * FROM konsul_rawat";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (krawat_konsul LIKE '%".addslashes($filter)."%' OR krawat_nama LIKE '%".addslashes($filter)."%' OR krawat_jumlah LIKE '%".addslashes($filter)."%' )";
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
		function konsul_rawat_update($krawat_konsul ,$krawat_nama ,$krawat_jumlah ){
			$data = array(
				"krawat_konsul"=>$krawat_konsul,			
				"krawat_nama"=>$krawat_nama,			
				"krawat_jumlah"=>$krawat_jumlah			
			);
			$this->db->where('krawat_konsul,krawat_nama', $krawat_konsul,krawat_nama);
			$this->db->update('konsul_rawat', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function konsul_rawat_create($krawat_konsul ,$krawat_nama ,$krawat_jumlah ){
			$data = array(
				"krawat_konsul"=>$krawat_konsul,	
				"krawat_nama"=>$krawat_nama,	
				"krawat_jumlah"=>$krawat_jumlah	
			);
			$this->db->insert('konsul_rawat', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function konsul_rawat_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the konsul_rawats at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM konsul_rawat WHERE krawat_konsul,krawat_nama = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM konsul_rawat WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "krawat_konsul,krawat_nama= ".$pkid[$i];
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
		function konsul_rawat_search($krawat_konsul ,$krawat_nama ,$krawat_jumlah ,$start,$end){
			//full query
			$query="select * from konsul_rawat";
			
			if($krawat_konsul!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " krawat_konsul LIKE '%".$krawat_konsul."%'";
			};
			if($krawat_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " krawat_nama LIKE '%".$krawat_nama."%'";
			};
			if($krawat_jumlah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " krawat_jumlah LIKE '%".$krawat_jumlah."%'";
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
		function konsul_rawat_print($krawat_konsul ,$krawat_nama ,$krawat_jumlah ,$option,$filter){
			//full query
			$query="select * from konsul_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (krawat_konsul LIKE '%".addslashes($filter)."%' OR krawat_nama LIKE '%".addslashes($filter)."%' OR krawat_jumlah LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($krawat_konsul!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " krawat_konsul LIKE '%".$krawat_konsul."%'";
				};
				if($krawat_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " krawat_nama LIKE '%".$krawat_nama."%'";
				};
				if($krawat_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " krawat_jumlah LIKE '%".$krawat_jumlah."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function konsul_rawat_export_excel($krawat_konsul ,$krawat_nama ,$krawat_jumlah ,$option,$filter){
			//full query
			$query="select * from konsul_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (krawat_konsul LIKE '%".addslashes($filter)."%' OR krawat_nama LIKE '%".addslashes($filter)."%' OR krawat_jumlah LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($krawat_konsul!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " krawat_konsul LIKE '%".$krawat_konsul."%'";
				};
				if($krawat_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " krawat_nama LIKE '%".$krawat_nama."%'";
				};
				if($krawat_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " krawat_jumlah LIKE '%".$krawat_jumlah."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>