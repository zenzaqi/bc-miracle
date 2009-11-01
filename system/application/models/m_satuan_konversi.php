<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: satuan_konversi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_satuan_konversi.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_satuan_konversi extends Model{
		
		//constructor
		function M_satuan_konversi() {
			parent::Model();
		}
		
		//function for get list record
		function satuan_konversi_list($filter,$start,$end){
			$query = "SELECT * FROM satuan_konversi";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (konversi_satuan LIKE '%".addslashes($filter)."%' OR konversi_produk LIKE '%".addslashes($filter)."%' OR konversi_nilai LIKE '%".addslashes($filter)."%' )";
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
		function satuan_konversi_update($konversi_satuan ,$konversi_produk ,$konversi_nilai ){
			$data = array(
				"konversi_satuan"=>$konversi_satuan,			
				"konversi_produk"=>$konversi_produk,			
				"konversi_nilai"=>$konversi_nilai			
			);
			$this->db->where('konversi_satuan,konversi_produk', $konversi_satuan,konversi_produk);
			$this->db->update('satuan_konversi', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function satuan_konversi_create($konversi_satuan ,$konversi_produk ,$konversi_nilai ){
			$data = array(
				"konversi_satuan"=>$konversi_satuan,	
				"konversi_produk"=>$konversi_produk,	
				"konversi_nilai"=>$konversi_nilai	
			);
			$this->db->insert('satuan_konversi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function satuan_konversi_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the satuan_konversis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM satuan_konversi WHERE konversi_satuan,konversi_produk = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM satuan_konversi WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "konversi_satuan,konversi_produk= ".$pkid[$i];
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
		function satuan_konversi_search($konversi_satuan ,$konversi_produk ,$konversi_nilai ,$start,$end){
			//full query
			$query="select * from satuan_konversi";
			
			if($konversi_satuan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konversi_satuan LIKE '%".$konversi_satuan."%'";
			};
			if($konversi_produk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konversi_produk LIKE '%".$konversi_produk."%'";
			};
			if($konversi_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " konversi_nilai LIKE '%".$konversi_nilai."%'";
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
		function satuan_konversi_print($konversi_satuan ,$konversi_produk ,$konversi_nilai ,$option,$filter){
			//full query
			$query="select * from satuan_konversi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (konversi_satuan LIKE '%".addslashes($filter)."%' OR konversi_produk LIKE '%".addslashes($filter)."%' OR konversi_nilai LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($konversi_satuan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konversi_satuan LIKE '%".$konversi_satuan."%'";
				};
				if($konversi_produk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konversi_produk LIKE '%".$konversi_produk."%'";
				};
				if($konversi_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konversi_nilai LIKE '%".$konversi_nilai."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function satuan_konversi_export_excel($konversi_satuan ,$konversi_produk ,$konversi_nilai ,$option,$filter){
			//full query
			$query="select * from satuan_konversi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (konversi_satuan LIKE '%".addslashes($filter)."%' OR konversi_produk LIKE '%".addslashes($filter)."%' OR konversi_nilai LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($konversi_satuan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konversi_satuan LIKE '%".$konversi_satuan."%'";
				};
				if($konversi_produk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konversi_produk LIKE '%".$konversi_produk."%'";
				};
				if($konversi_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " konversi_nilai LIKE '%".$konversi_nilai."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>