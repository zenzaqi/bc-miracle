<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jual_uang_muka Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jual_uang_muka.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_jual_uang_muka extends Model{
		
		//constructor
		function M_jual_uang_muka() {
			parent::Model();
		}
		
		//function for get list record
		function jual_uang_muka_list($filter,$start,$end){
			$query = "SELECT * FROM jual_uang_muka";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (dp_nobukti LIKE '%".addslashes($filter)."%' OR dp_tanggal LIKE '%".addslashes($filter)."%' OR dp_nilai LIKE '%".addslashes($filter)."%' OR dp_trans LIKE '%".addslashes($filter)."%' )";
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
		function jual_uang_muka_update($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ){
			$data = array(
				"dp_nobukti"=>$dp_nobukti,			
				"dp_tanggal"=>$dp_tanggal,			
				"dp_nilai"=>$dp_nilai,			
				"dp_trans"=>$dp_trans			
			);
			$this->db->where('dp_nobukti', $dp_nobukti);
			$this->db->update('jual_uang_muka', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function jual_uang_muka_create($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ){
			$data = array(
				"dp_nobukti"=>$dp_nobukti,	
				"dp_tanggal"=>$dp_tanggal,	
				"dp_nilai"=>$dp_nilai,	
				"dp_trans"=>$dp_trans	
			);
			$this->db->insert('jual_uang_muka', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jual_uang_muka_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jual_uang_mukas at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jual_uang_muka WHERE dp_nobukti = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jual_uang_muka WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "dp_nobukti= ".$pkid[$i];
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
		function jual_uang_muka_search($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$start,$end){
			//full query
			$query="select * from jual_uang_muka";
			
			if($dp_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dp_nobukti LIKE '%".$dp_nobukti."%'";
			};
			if($dp_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dp_tanggal LIKE '%".$dp_tanggal."%'";
			};
			if($dp_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dp_nilai LIKE '%".$dp_nilai."%'";
			};
			if($dp_trans!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dp_trans LIKE '%".$dp_trans."%'";
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
		function jual_uang_muka_print($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$option,$filter){
			//full query
			$query="select * from jual_uang_muka";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (dp_nobukti LIKE '%".addslashes($filter)."%' OR dp_tanggal LIKE '%".addslashes($filter)."%' OR dp_nilai LIKE '%".addslashes($filter)."%' OR dp_trans LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($dp_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_nobukti LIKE '%".$dp_nobukti."%'";
				};
				if($dp_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_tanggal LIKE '%".$dp_tanggal."%'";
				};
				if($dp_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_nilai LIKE '%".$dp_nilai."%'";
				};
				if($dp_trans!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_trans LIKE '%".$dp_trans."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jual_uang_muka_export_excel($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$option,$filter){
			//full query
			$query="select * from jual_uang_muka";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (dp_nobukti LIKE '%".addslashes($filter)."%' OR dp_tanggal LIKE '%".addslashes($filter)."%' OR dp_nilai LIKE '%".addslashes($filter)."%' OR dp_trans LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($dp_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_nobukti LIKE '%".$dp_nobukti."%'";
				};
				if($dp_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_tanggal LIKE '%".$dp_tanggal."%'";
				};
				if($dp_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_nilai LIKE '%".$dp_nilai."%'";
				};
				if($dp_trans!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dp_trans LIKE '%".$dp_trans."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>