<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jual_card Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jual_card.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_jual_card extends Model{
		
		//constructor
		function M_jual_card() {
			parent::Model();
		}
		
		//function for get list record
		function jual_card_list($filter,$start,$end){
			$query = "SELECT * FROM jual_card";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jcard_nobukti LIKE '%".addslashes($filter)."%' OR jcard_tanggal LIKE '%".addslashes($filter)."%' OR jcard_nama LIKE '%".addslashes($filter)."%' OR jcard_jenis LIKE '%".addslashes($filter)."%' OR jcard_no LIKE '%".addslashes($filter)."%' OR jcard_nilai LIKE '%".addslashes($filter)."%' OR jcard_trans LIKE '%".addslashes($filter)."%' OR jcard_creator LIKE '%".addslashes($filter)."%' OR jcard_date_create LIKE '%".addslashes($filter)."%' OR jcard_update LIKE '%".addslashes($filter)."%' OR jcard_date_update LIKE '%".addslashes($filter)."%' OR jcard_revised LIKE '%".addslashes($filter)."%' )";
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
		function jual_card_update($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ){
			$data = array(
				"jcard_nobukti"=>$jcard_nobukti,			
				"jcard_tanggal"=>$jcard_tanggal,			
				"jcard_nama"=>$jcard_nama,			
				"jcard_jenis"=>$jcard_jenis,			
				"jcard_no"=>$jcard_no,			
				"jcard_nilai"=>$jcard_nilai,			
				"jcard_trans"=>$jcard_trans,			
				"jcard_creator"=>$jcard_creator,			
				"jcard_date_create"=>$jcard_date_create,			
				"jcard_update"=>$jcard_update,			
				"jcard_date_update"=>$jcard_date_update,			
				"jcard_revised"=>$jcard_revised			
			);
			$this->db->where('jcard_nobukti', $jcard_nobukti);
			$this->db->update('jual_card', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function jual_card_create($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ){
			$data = array(
				"jcard_nobukti"=>$jcard_nobukti,	
				"jcard_tanggal"=>$jcard_tanggal,	
				"jcard_nama"=>$jcard_nama,	
				"jcard_jenis"=>$jcard_jenis,	
				"jcard_no"=>$jcard_no,	
				"jcard_nilai"=>$jcard_nilai,	
				"jcard_trans"=>$jcard_trans,	
				"jcard_creator"=>$jcard_creator,	
				"jcard_date_create"=>$jcard_date_create,	
				"jcard_update"=>$jcard_update,	
				"jcard_date_update"=>$jcard_date_update,	
				"jcard_revised"=>$jcard_revised	
			);
			$this->db->insert('jual_card', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function jual_card_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jual_cards at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jual_card WHERE jcard_nobukti = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jual_card WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jcard_nobukti= ".$pkid[$i];
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
		function jual_card_search($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ,$start,$end){
			//full query
			$query="select * from jual_card";
			
			if($jcard_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_nobukti LIKE '%".$jcard_nobukti."%'";
			};
			if($jcard_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_tanggal LIKE '%".$jcard_tanggal."%'";
			};
			if($jcard_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_nama LIKE '%".$jcard_nama."%'";
			};
			if($jcard_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_jenis LIKE '%".$jcard_jenis."%'";
			};
			if($jcard_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_no LIKE '%".$jcard_no."%'";
			};
			if($jcard_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_nilai LIKE '%".$jcard_nilai."%'";
			};
			if($jcard_trans!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_trans LIKE '%".$jcard_trans."%'";
			};
			if($jcard_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_creator LIKE '%".$jcard_creator."%'";
			};
			if($jcard_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_date_create LIKE '%".$jcard_date_create."%'";
			};
			if($jcard_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_update LIKE '%".$jcard_update."%'";
			};
			if($jcard_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_date_update LIKE '%".$jcard_date_update."%'";
			};
			if($jcard_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jcard_revised LIKE '%".$jcard_revised."%'";
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
		function jual_card_print($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ,$option,$filter){
			//full query
			$query="select * from jual_card";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jcard_nobukti LIKE '%".addslashes($filter)."%' OR jcard_tanggal LIKE '%".addslashes($filter)."%' OR jcard_nama LIKE '%".addslashes($filter)."%' OR jcard_jenis LIKE '%".addslashes($filter)."%' OR jcard_no LIKE '%".addslashes($filter)."%' OR jcard_nilai LIKE '%".addslashes($filter)."%' OR jcard_trans LIKE '%".addslashes($filter)."%' OR jcard_creator LIKE '%".addslashes($filter)."%' OR jcard_date_create LIKE '%".addslashes($filter)."%' OR jcard_update LIKE '%".addslashes($filter)."%' OR jcard_date_update LIKE '%".addslashes($filter)."%' OR jcard_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jcard_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_nobukti LIKE '%".$jcard_nobukti."%'";
				};
				if($jcard_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_tanggal LIKE '%".$jcard_tanggal."%'";
				};
				if($jcard_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_nama LIKE '%".$jcard_nama."%'";
				};
				if($jcard_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_jenis LIKE '%".$jcard_jenis."%'";
				};
				if($jcard_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_no LIKE '%".$jcard_no."%'";
				};
				if($jcard_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_nilai LIKE '%".$jcard_nilai."%'";
				};
				if($jcard_trans!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_trans LIKE '%".$jcard_trans."%'";
				};
				if($jcard_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_creator LIKE '%".$jcard_creator."%'";
				};
				if($jcard_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_date_create LIKE '%".$jcard_date_create."%'";
				};
				if($jcard_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_update LIKE '%".$jcard_update."%'";
				};
				if($jcard_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_date_update LIKE '%".$jcard_date_update."%'";
				};
				if($jcard_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_revised LIKE '%".$jcard_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function jual_card_export_excel($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ,$option,$filter){
			//full query
			$query="select * from jual_card";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jcard_nobukti LIKE '%".addslashes($filter)."%' OR jcard_tanggal LIKE '%".addslashes($filter)."%' OR jcard_nama LIKE '%".addslashes($filter)."%' OR jcard_jenis LIKE '%".addslashes($filter)."%' OR jcard_no LIKE '%".addslashes($filter)."%' OR jcard_nilai LIKE '%".addslashes($filter)."%' OR jcard_trans LIKE '%".addslashes($filter)."%' OR jcard_creator LIKE '%".addslashes($filter)."%' OR jcard_date_create LIKE '%".addslashes($filter)."%' OR jcard_update LIKE '%".addslashes($filter)."%' OR jcard_date_update LIKE '%".addslashes($filter)."%' OR jcard_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jcard_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_nobukti LIKE '%".$jcard_nobukti."%'";
				};
				if($jcard_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_tanggal LIKE '%".$jcard_tanggal."%'";
				};
				if($jcard_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_nama LIKE '%".$jcard_nama."%'";
				};
				if($jcard_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_jenis LIKE '%".$jcard_jenis."%'";
				};
				if($jcard_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_no LIKE '%".$jcard_no."%'";
				};
				if($jcard_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_nilai LIKE '%".$jcard_nilai."%'";
				};
				if($jcard_trans!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_trans LIKE '%".$jcard_trans."%'";
				};
				if($jcard_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_creator LIKE '%".$jcard_creator."%'";
				};
				if($jcard_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_date_create LIKE '%".$jcard_date_create."%'";
				};
				if($jcard_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_update LIKE '%".$jcard_update."%'";
				};
				if($jcard_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_date_update LIKE '%".$jcard_date_update."%'";
				};
				if($jcard_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jcard_revised LIKE '%".$jcard_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>