<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: akun Model
	+ Description	: For record model process back-end
	+ Filename 		: c_akun.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 16/Jul/2009 14:18:30
	
*/

class M_akun extends Model{
		
		//constructor
		function M_akun() {
			parent::Model();
		}
		
		function get_akun_kode_list(){
			$sql="SELECT distinct akun_nama,akun_id FROM akun WHERE akun_kode<>''";
			$query = $this->db->query($sql);
			$nbrows = $query->num_rows();
			if($nbrows>0){
				foreach($query->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for get list record
		function akun_list($filter,$start,$end){
			$query = "SELECT akun.*,akun_parent.akun_nama as nama_parent FROM akun LEFT OUTER JOIN akun as akun_parent ON akun.akun_parent=akun_parent.akun_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (akun_kode LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' )";
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
		function akun_update($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ){
			if ($akun_aktif=="")
				$akun_aktif = "Aktif";
			$data = array(
				"akun_id"=>$akun_id,			
				"akun_kode"=>$akun_kode,			
				"akun_nama"=>$akun_nama,			
				"akun_neraca"=>$akun_neraca,			
				"akun_rugilaba"=>$akun_rugilaba,			
				"akun_debet"=>$akun_debet,			
				"akun_kredit"=>$akun_kredit,			
				"akun_saldo"=>$akun_saldo,			
				"akun_keterangan"=>$akun_keterangan,
				"akun_aktif"=>$akun_aktif,			
				"akun_creator"=>$akun_creator,			
				"akun_date_create"=>$akun_date_create,			
				"akun_update"=>$akun_update,			
				"akun_date_update"=>$akun_date_update,			
				"akun_revised"=>$akun_revised			
			);
			$sql="SELECT akun_id FROM akun WHERE akun_id='".$akun_parent."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["akun_parent"]=$akun_parent;
			
			$this->db->where('akun_id', $akun_id);
			$this->db->update('akun', $data);
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function akun_create($akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ){
			if ($akun_aktif=="")
				$akun_aktif = "Aktif";
			$data = array(
	
				"akun_kode"=>$akun_kode,	
				"akun_nama"=>$akun_nama,	
				"akun_parent"=>$akun_parent,	
				"akun_neraca"=>$akun_neraca,	
				"akun_rugilaba"=>$akun_rugilaba,	
				"akun_debet"=>$akun_debet,	
				"akun_kredit"=>$akun_kredit,	
				"akun_saldo"=>$akun_saldo,	
				"akun_keterangan"=>$akun_keterangan,	
				"akun_aktif"=>$akun_aktif,	
				"akun_creator"=>$akun_creator,	
				"akun_date_create"=>$akun_date_create,	
				"akun_update"=>$akun_update,	
				"akun_date_update"=>$akun_date_update,	
				"akun_revised"=>$akun_revised	
			);
			$this->db->insert('akun', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function akun_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the akuns at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM akun WHERE akun_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM akun WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "akun_id= ".$pkid[$i];
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
		function akun_search($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$start,$end){
			if ($akun_aktif=="")
				$akun_aktif = "Aktif";
			//full query
			$query="select * from akun";
			
			if($akun_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_id LIKE '%".$akun_id."%'";
			};
			if($akun_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_kode LIKE '%".$akun_kode."%'";
			};
			if($akun_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_nama LIKE '%".$akun_nama."%'";
			};
			if($akun_parent!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_parent LIKE '%".$akun_parent."%'";
			};
			if($akun_neraca!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_neraca LIKE '%".$akun_neraca."%'";
			};
			if($akun_rugilaba!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_rugilaba LIKE '%".$akun_rugilaba."%'";
			};
			if($akun_debet!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_debet LIKE '%".$akun_debet."%'";
			};
			if($akun_kredit!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_kredit LIKE '%".$akun_kredit."%'";
			};
			if($akun_saldo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_saldo LIKE '%".$akun_saldo."%'";
			};
			if($akun_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_keterangan LIKE '%".$akun_keterangan."%'";
			};
			if($akun_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_aktif LIKE '%".$akun_aktif."%'";
			};
			if($akun_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_creator LIKE '%".$akun_creator."%'";
			};
			if($akun_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_date_create LIKE '%".$akun_date_create."%'";
			};
			if($akun_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_update LIKE '%".$akun_update."%'";
			};
			if($akun_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_date_update LIKE '%".$akun_date_update."%'";
			};
			if($akun_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_revised LIKE '%".$akun_revised."%'";
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
		function akun_print($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter){
			//full query
			$query="select * from akun";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (akun_id LIKE '%".addslashes($filter)."%' OR akun_kode LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' OR akun_parent LIKE '%".addslashes($filter)."%' OR akun_neraca LIKE '%".addslashes($filter)."%' OR akun_rugilaba LIKE '%".addslashes($filter)."%' OR akun_debet LIKE '%".addslashes($filter)."%' OR akun_kredit LIKE '%".addslashes($filter)."%' OR akun_saldo LIKE '%".addslashes($filter)."%' OR akun_keterangan LIKE '%".addslashes($filter)."%' OR akun_aktif LIKE '%".addslashes($filter)."%' OR akun_creator LIKE '%".addslashes($filter)."%' OR akun_date_create LIKE '%".addslashes($filter)."%' OR akun_update LIKE '%".addslashes($filter)."%' OR akun_date_update LIKE '%".addslashes($filter)."%' OR akun_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($akun_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_id LIKE '%".$akun_id."%'";
				};
				if($akun_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_kode LIKE '%".$akun_kode."%'";
				};
				if($akun_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_nama LIKE '%".$akun_nama."%'";
				};
				if($akun_parent!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_parent LIKE '%".$akun_parent."%'";
				};
				if($akun_neraca!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_neraca LIKE '%".$akun_neraca."%'";
				};
				if($akun_rugilaba!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_rugilaba LIKE '%".$akun_rugilaba."%'";
				};
				if($akun_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_debet LIKE '%".$akun_debet."%'";
				};
				if($akun_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_kredit LIKE '%".$akun_kredit."%'";
				};
				if($akun_saldo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_saldo LIKE '%".$akun_saldo."%'";
				};
				if($akun_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_keterangan LIKE '%".$akun_keterangan."%'";
				};
				if($akun_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_aktif LIKE '%".$akun_aktif."%'";
				};
				if($akun_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_creator LIKE '%".$akun_creator."%'";
				};
				if($akun_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_date_create LIKE '%".$akun_date_create."%'";
				};
				if($akun_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_update LIKE '%".$akun_update."%'";
				};
				if($akun_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_date_update LIKE '%".$akun_date_update."%'";
				};
				if($akun_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_revised LIKE '%".$akun_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function akun_export_excel($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter){
			//full query
			$query="select * from akun";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (akun_id LIKE '%".addslashes($filter)."%' OR akun_kode LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' OR akun_parent LIKE '%".addslashes($filter)."%' OR akun_neraca LIKE '%".addslashes($filter)."%' OR akun_rugilaba LIKE '%".addslashes($filter)."%' OR akun_debet LIKE '%".addslashes($filter)."%' OR akun_kredit LIKE '%".addslashes($filter)."%' OR akun_saldo LIKE '%".addslashes($filter)."%' OR akun_keterangan LIKE '%".addslashes($filter)."%' OR akun_aktif LIKE '%".addslashes($filter)."%' OR akun_creator LIKE '%".addslashes($filter)."%' OR akun_date_create LIKE '%".addslashes($filter)."%' OR akun_update LIKE '%".addslashes($filter)."%' OR akun_date_update LIKE '%".addslashes($filter)."%' OR akun_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($akun_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_id LIKE '%".$akun_id."%'";
				};
				if($akun_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_kode LIKE '%".$akun_kode."%'";
				};
				if($akun_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_nama LIKE '%".$akun_nama."%'";
				};
				if($akun_parent!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_parent LIKE '%".$akun_parent."%'";
				};
				if($akun_neraca!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_neraca LIKE '%".$akun_neraca."%'";
				};
				if($akun_rugilaba!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_rugilaba LIKE '%".$akun_rugilaba."%'";
				};
				if($akun_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_debet LIKE '%".$akun_debet."%'";
				};
				if($akun_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_kredit LIKE '%".$akun_kredit."%'";
				};
				if($akun_saldo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_saldo LIKE '%".$akun_saldo."%'";
				};
				if($akun_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_keterangan LIKE '%".$akun_keterangan."%'";
				};
				if($akun_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_aktif LIKE '%".$akun_aktif."%'";
				};
				if($akun_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_creator LIKE '%".$akun_creator."%'";
				};
				if($akun_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_date_create LIKE '%".$akun_date_create."%'";
				};
				if($akun_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_update LIKE '%".$akun_update."%'";
				};
				if($akun_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_date_update LIKE '%".$akun_date_update."%'";
				};
				if($akun_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " akun_revised LIKE '%".$akun_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>