<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: perawatan_alat Model
	+ Description	: For record model process back-end
	+ Filename 		: c_perawatan_alat.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_perawatan_alat extends Model{
		
		//constructor
		function M_perawatan_alat() {
			parent::Model();
		}
		
		//function for get list record
		function perawatan_alat_list($filter,$start,$end){
			$query = "SELECT * FROM perawatan_alat";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (aperawatan_no LIKE '%".addslashes($filter)."%' OR aperawatan_alat LIKE '%".addslashes($filter)."%' OR aperawatan_jumlah LIKE '%".addslashes($filter)."%' )";
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
		function perawatan_alat_update($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ){
			$data = array(
				"aperawatan_no"=>$aperawatan_no,			
				"aperawatan_alat"=>$aperawatan_alat,			
				"aperawatan_jumlah"=>$aperawatan_jumlah			
			);
			$this->db->where('aperawatan_no,aperawatan_alat', $aperawatan_no,aperawatan_alat);
			$this->db->update('perawatan_alat', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function perawatan_alat_create($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ){
			$data = array(
				"aperawatan_no"=>$aperawatan_no,	
				"aperawatan_alat"=>$aperawatan_alat,	
				"aperawatan_jumlah"=>$aperawatan_jumlah	
			);
			$this->db->insert('perawatan_alat', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function perawatan_alat_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the perawatan_alats at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM perawatan_alat WHERE aperawatan_no,aperawatan_alat = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM perawatan_alat WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "aperawatan_no,aperawatan_alat= ".$pkid[$i];
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
		function perawatan_alat_search($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ,$start,$end){
			//full query
			$query="select * from perawatan_alat";
			
			if($aperawatan_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aperawatan_no LIKE '%".$aperawatan_no."%'";
			};
			if($aperawatan_alat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aperawatan_alat LIKE '%".$aperawatan_alat."%'";
			};
			if($aperawatan_jumlah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " aperawatan_jumlah LIKE '%".$aperawatan_jumlah."%'";
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
		function perawatan_alat_print($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ,$option,$filter){
			//full query
			$query="select * from perawatan_alat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (aperawatan_no LIKE '%".addslashes($filter)."%' OR aperawatan_alat LIKE '%".addslashes($filter)."%' OR aperawatan_jumlah LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($aperawatan_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aperawatan_no LIKE '%".$aperawatan_no."%'";
				};
				if($aperawatan_alat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aperawatan_alat LIKE '%".$aperawatan_alat."%'";
				};
				if($aperawatan_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aperawatan_jumlah LIKE '%".$aperawatan_jumlah."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function perawatan_alat_export_excel($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ,$option,$filter){
			//full query
			$query="select * from perawatan_alat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (aperawatan_no LIKE '%".addslashes($filter)."%' OR aperawatan_alat LIKE '%".addslashes($filter)."%' OR aperawatan_jumlah LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($aperawatan_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aperawatan_no LIKE '%".$aperawatan_no."%'";
				};
				if($aperawatan_alat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aperawatan_alat LIKE '%".$aperawatan_alat."%'";
				};
				if($aperawatan_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " aperawatan_jumlah LIKE '%".$aperawatan_jumlah."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>