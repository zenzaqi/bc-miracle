<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jual_bank Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jual_bank.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_jual_bank extends Model{
		
		//constructor
		function M_jual_bank() {
			parent::Model();
		}
		
		//function for get list record
		function jual_bank_list($filter,$start,$end){
			$query = "SELECT * FROM jual_bank";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jbank_nobukti LIKE '%".addslashes($filter)."%' OR jbank_tanggal LIKE '%".addslashes($filter)."%' OR jbank_bank LIKE '%".addslashes($filter)."%' OR jbank_no LIKE '%".addslashes($filter)."%' OR jbank_nilai LIKE '%".addslashes($filter)."%' OR jbank_trans LIKE '%".addslashes($filter)."%' OR jbank_creator LIKE '%".addslashes($filter)."%' OR jbank_date_create LIKE '%".addslashes($filter)."%' OR jbank_update LIKE '%".addslashes($filter)."%' OR jbank_date_update LIKE '%".addslashes($filter)."%' OR jbank_revised LIKE '%".addslashes($filter)."%' )";
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
		function jual_bank_update($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ){
			$data = array(
				"jbank_nobukti"=>$jbank_nobukti,			
				"jbank_tanggal"=>$jbank_tanggal,			
				"jbank_bank"=>$jbank_bank,			
				"jbank_no"=>$jbank_no,			
				"jbank_nilai"=>$jbank_nilai,			
				"jbank_trans"=>$jbank_trans,			
				"jbank_creator"=>$jbank_creator,			
				"jbank_date_create"=>$jbank_date_create,			
				"jbank_update"=>$jbank_update,			
				"jbank_date_update"=>$jbank_date_update,			
				"jbank_revised"=>$jbank_revised			
			);
			$this->db->where('jbank_nobukti', $jbank_nobukti);
			$this->db->update('jual_bank', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function jual_bank_create($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ){
			$data = array(
				"jbank_nobukti"=>$jbank_nobukti,	
				"jbank_tanggal"=>$jbank_tanggal,	
				"jbank_bank"=>$jbank_bank,	
				"jbank_no"=>$jbank_no,	
				"jbank_nilai"=>$jbank_nilai,	
				"jbank_trans"=>$jbank_trans,	
				"jbank_creator"=>$jbank_creator,	
				"jbank_date_create"=>$jbank_date_create,	
				"jbank_update"=>$jbank_update,	
				"jbank_date_update"=>$jbank_date_update,	
				"jbank_revised"=>$jbank_revised	
			);
			$this->db->insert('jual_bank', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jual_bank_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jual_banks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jual_bank WHERE jbank_nobukti = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jual_bank WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jbank_nobukti= ".$pkid[$i];
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
		function jual_bank_search($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ,$start,$end){
			//full query
			$query="select * from jual_bank";
			
			if($jbank_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_nobukti LIKE '%".$jbank_nobukti."%'";
			};
			if($jbank_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_tanggal LIKE '%".$jbank_tanggal."%'";
			};
			if($jbank_bank!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_bank LIKE '%".$jbank_bank."%'";
			};
			if($jbank_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_no LIKE '%".$jbank_no."%'";
			};
			if($jbank_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_nilai LIKE '%".$jbank_nilai."%'";
			};
			if($jbank_trans!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_trans LIKE '%".$jbank_trans."%'";
			};
			if($jbank_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_creator LIKE '%".$jbank_creator."%'";
			};
			if($jbank_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_date_create LIKE '%".$jbank_date_create."%'";
			};
			if($jbank_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_update LIKE '%".$jbank_update."%'";
			};
			if($jbank_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_date_update LIKE '%".$jbank_date_update."%'";
			};
			if($jbank_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jbank_revised LIKE '%".$jbank_revised."%'";
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
		function jual_bank_print($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ,$option,$filter){
			//full query
			$query="select * from jual_bank";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jbank_nobukti LIKE '%".addslashes($filter)."%' OR jbank_tanggal LIKE '%".addslashes($filter)."%' OR jbank_bank LIKE '%".addslashes($filter)."%' OR jbank_no LIKE '%".addslashes($filter)."%' OR jbank_nilai LIKE '%".addslashes($filter)."%' OR jbank_trans LIKE '%".addslashes($filter)."%' OR jbank_creator LIKE '%".addslashes($filter)."%' OR jbank_date_create LIKE '%".addslashes($filter)."%' OR jbank_update LIKE '%".addslashes($filter)."%' OR jbank_date_update LIKE '%".addslashes($filter)."%' OR jbank_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jbank_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_nobukti LIKE '%".$jbank_nobukti."%'";
				};
				if($jbank_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_tanggal LIKE '%".$jbank_tanggal."%'";
				};
				if($jbank_bank!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_bank LIKE '%".$jbank_bank."%'";
				};
				if($jbank_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_no LIKE '%".$jbank_no."%'";
				};
				if($jbank_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_nilai LIKE '%".$jbank_nilai."%'";
				};
				if($jbank_trans!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_trans LIKE '%".$jbank_trans."%'";
				};
				if($jbank_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_creator LIKE '%".$jbank_creator."%'";
				};
				if($jbank_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_date_create LIKE '%".$jbank_date_create."%'";
				};
				if($jbank_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_update LIKE '%".$jbank_update."%'";
				};
				if($jbank_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_date_update LIKE '%".$jbank_date_update."%'";
				};
				if($jbank_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_revised LIKE '%".$jbank_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jual_bank_export_excel($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ,$option,$filter){
			//full query
			$query="select * from jual_bank";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jbank_nobukti LIKE '%".addslashes($filter)."%' OR jbank_tanggal LIKE '%".addslashes($filter)."%' OR jbank_bank LIKE '%".addslashes($filter)."%' OR jbank_no LIKE '%".addslashes($filter)."%' OR jbank_nilai LIKE '%".addslashes($filter)."%' OR jbank_trans LIKE '%".addslashes($filter)."%' OR jbank_creator LIKE '%".addslashes($filter)."%' OR jbank_date_create LIKE '%".addslashes($filter)."%' OR jbank_update LIKE '%".addslashes($filter)."%' OR jbank_date_update LIKE '%".addslashes($filter)."%' OR jbank_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jbank_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_nobukti LIKE '%".$jbank_nobukti."%'";
				};
				if($jbank_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_tanggal LIKE '%".$jbank_tanggal."%'";
				};
				if($jbank_bank!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_bank LIKE '%".$jbank_bank."%'";
				};
				if($jbank_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_no LIKE '%".$jbank_no."%'";
				};
				if($jbank_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_nilai LIKE '%".$jbank_nilai."%'";
				};
				if($jbank_trans!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_trans LIKE '%".$jbank_trans."%'";
				};
				if($jbank_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_creator LIKE '%".$jbank_creator."%'";
				};
				if($jbank_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_date_create LIKE '%".$jbank_date_create."%'";
				};
				if($jbank_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_update LIKE '%".$jbank_update."%'";
				};
				if($jbank_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_date_update LIKE '%".$jbank_date_update."%'";
				};
				if($jbank_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jbank_revised LIKE '%".$jbank_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>