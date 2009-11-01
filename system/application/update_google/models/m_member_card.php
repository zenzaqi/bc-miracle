<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: member_card Model
	+ Description	: For record model process back-end
	+ Filename 		: c_member_card.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_member_card extends Model{
		
		//constructor
		function M_member_card() {
			parent::Model();
		}
		
		//function for get list record
		function member_card_list($filter,$start,$end){
			$query = "SELECT * FROM member_card";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (card_id LIKE '%".addslashes($filter)."%' OR card_no LIKE '%".addslashes($filter)."%' OR card_nama LIKE '%".addslashes($filter)."%' OR card_alamat LIKE '%".addslashes($filter)."%' OR card_nomember LIKE '%".addslashes($filter)."%' OR card_pointsaldo LIKE '%".addslashes($filter)."%' OR card_creator LIKE '%".addslashes($filter)."%' OR card_date_create LIKE '%".addslashes($filter)."%' OR card_update LIKE '%".addslashes($filter)."%' OR card_date_update LIKE '%".addslashes($filter)."%' OR card_revised LIKE '%".addslashes($filter)."%' )";
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
		function member_card_update($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$card_creator ,$card_date_create ,$card_update ,$card_date_update ,$card_revised ){
			$data = array(
				"card_id"=>$card_id,			
				"card_no"=>$card_no,			
				"card_nama"=>$card_nama,			
				"card_alamat"=>$card_alamat,			
				"card_nomember"=>$card_nomember,			
				"card_pointsaldo"=>$card_pointsaldo,			
				"card_creator"=>$card_creator,			
				"card_date_create"=>$card_date_create,			
				"card_update"=>$card_update,			
				"card_date_update"=>$card_date_update,			
				"card_revised"=>$card_revised			
			);
			$this->db->where('card_id', $card_id);
			$this->db->update('member_card', $data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function member_card_create($card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$card_creator ,$card_date_create ,$card_update ,$card_date_update ,$card_revised ){
			$data = array(
	
				"card_no"=>$card_no,	
				"card_nama"=>$card_nama,	
				"card_alamat"=>$card_alamat,	
				"card_nomember"=>$card_nomember,	
				"card_pointsaldo"=>$card_pointsaldo,	
				"card_creator"=>$card_creator,	
				"card_date_create"=>$card_date_create,	
				"card_update"=>$card_update,	
				"card_date_update"=>$card_date_update,	
				"card_revised"=>$card_revised	
			);
			$this->db->insert('member_card', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function member_card_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the member_cards at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM member_card WHERE card_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM member_card WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "card_id= ".$pkid[$i];
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
		function member_card_search($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$card_creator ,$card_date_create ,$card_update ,$card_date_update ,$card_revised ,$start,$end){
			//full query
			$query="select * from member_card";
			
			if($card_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_id LIKE '%".$card_id."%'";
			};
			if($card_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_no LIKE '%".$card_no."%'";
			};
			if($card_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_nama LIKE '%".$card_nama."%'";
			};
			if($card_alamat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_alamat LIKE '%".$card_alamat."%'";
			};
			if($card_nomember!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_nomember LIKE '%".$card_nomember."%'";
			};
			if($card_pointsaldo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_pointsaldo LIKE '%".$card_pointsaldo."%'";
			};
			if($card_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_creator LIKE '%".$card_creator."%'";
			};
			if($card_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_date_create LIKE '%".$card_date_create."%'";
			};
			if($card_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_update LIKE '%".$card_update."%'";
			};
			if($card_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_date_update LIKE '%".$card_date_update."%'";
			};
			if($card_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " card_revised LIKE '%".$card_revised."%'";
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
		function member_card_print($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$card_creator ,$card_date_create ,$card_update ,$card_date_update ,$card_revised ,$option,$filter){
			//full query
			$query="select * from member_card";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (card_id LIKE '%".addslashes($filter)."%' OR card_no LIKE '%".addslashes($filter)."%' OR card_nama LIKE '%".addslashes($filter)."%' OR card_alamat LIKE '%".addslashes($filter)."%' OR card_nomember LIKE '%".addslashes($filter)."%' OR card_pointsaldo LIKE '%".addslashes($filter)."%' OR card_creator LIKE '%".addslashes($filter)."%' OR card_date_create LIKE '%".addslashes($filter)."%' OR card_update LIKE '%".addslashes($filter)."%' OR card_date_update LIKE '%".addslashes($filter)."%' OR card_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($card_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_id LIKE '%".$card_id."%'";
				};
				if($card_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_no LIKE '%".$card_no."%'";
				};
				if($card_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_nama LIKE '%".$card_nama."%'";
				};
				if($card_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_alamat LIKE '%".$card_alamat."%'";
				};
				if($card_nomember!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_nomember LIKE '%".$card_nomember."%'";
				};
				if($card_pointsaldo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_pointsaldo LIKE '%".$card_pointsaldo."%'";
				};
				if($card_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_creator LIKE '%".$card_creator."%'";
				};
				if($card_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_date_create LIKE '%".$card_date_create."%'";
				};
				if($card_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_update LIKE '%".$card_update."%'";
				};
				if($card_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_date_update LIKE '%".$card_date_update."%'";
				};
				if($card_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_revised LIKE '%".$card_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function member_card_export_excel($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$card_creator ,$card_date_create ,$card_update ,$card_date_update ,$card_revised ,$option,$filter){
			//full query
			$query="select * from member_card";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (card_id LIKE '%".addslashes($filter)."%' OR card_no LIKE '%".addslashes($filter)."%' OR card_nama LIKE '%".addslashes($filter)."%' OR card_alamat LIKE '%".addslashes($filter)."%' OR card_nomember LIKE '%".addslashes($filter)."%' OR card_pointsaldo LIKE '%".addslashes($filter)."%' OR card_creator LIKE '%".addslashes($filter)."%' OR card_date_create LIKE '%".addslashes($filter)."%' OR card_update LIKE '%".addslashes($filter)."%' OR card_date_update LIKE '%".addslashes($filter)."%' OR card_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($card_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_id LIKE '%".$card_id."%'";
				};
				if($card_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_no LIKE '%".$card_no."%'";
				};
				if($card_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_nama LIKE '%".$card_nama."%'";
				};
				if($card_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_alamat LIKE '%".$card_alamat."%'";
				};
				if($card_nomember!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_nomember LIKE '%".$card_nomember."%'";
				};
				if($card_pointsaldo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_pointsaldo LIKE '%".$card_pointsaldo."%'";
				};
				if($card_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_creator LIKE '%".$card_creator."%'";
				};
				if($card_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_date_create LIKE '%".$card_date_create."%'";
				};
				if($card_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_update LIKE '%".$card_update."%'";
				};
				if($card_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_date_update LIKE '%".$card_date_update."%'";
				};
				if($card_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " card_revised LIKE '%".$card_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>