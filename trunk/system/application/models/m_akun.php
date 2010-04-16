<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: akun Model
	+ Description	: For record model process back-end
	+ Filename 		: c_akun.php
 	+ creator 		: 
 	+ Created on 12/Mar/2010 10:42:59
	
*/

class M_akun extends Model{
		
		//constructor
		function M_akun() {
			parent::Model();
		}
		
		//function for get list record
		function akun_list($filter,$start,$end){
			$query = "SELECT * FROM vu_akun";

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (akun_id LIKE '%".addslashes($filter)."%' OR akun_kode LIKE '%".addslashes($filter)."%' OR akun_jenis LIKE '%".addslashes($filter)."%' OR akun_parent LIKE '%".addslashes($filter)."%' OR akun_level LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' OR akun_debet LIKE '%".addslashes($filter)."%' OR akun_kredit LIKE '%".addslashes($filter)."%' OR akun_saldo LIKE '%".addslashes($filter)."%' OR akun_aktif LIKE '%".addslashes($filter)."%' OR akun_creator LIKE '%".addslashes($filter)."%' OR akun_date_create LIKE '%".addslashes($filter)."%' OR akun_update LIKE '%".addslashes($filter)."%' OR akun_date_update LIKE '%".addslashes($filter)."%' OR akun_revised LIKE '%".addslashes($filter)."%' )";
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
		
		//function for create new record
		function akun_create($akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_aktif ,$akun_creator ,$akun_date_create ){
			$data = array(
				"akun_jenis"=>$akun_jenis, 
				"akun_nama"=>$akun_nama, 
				"akun_debet"=>$akun_debet, 
				"akun_kredit"=>$akun_kredit, 
				"akun_saldo"=>$akun_saldo, 
				"akun_aktif"=>$akun_aktif, 
				"akun_creator"=>$akun_creator, 
				"akun_date_create"=>$akun_date_create 
			);
			$sql="select * from akun where akun_id='".$akun_parent."'";
			$query_akun=$this->db->query($sql);
			if($query_akun->num_rows()){
				$ds_akun=$query_akun->row();
				$data["akun_parent"]=$akun_parent;
				$data["akun_kode"]=$ds_akun->akun_kode.".".$akun_kode;
				$data["akun_jenis"]=$ds_akun->akun_jenis;
				$data["akun_level"]=$ds_akun->akun_level+1;
			}else{
				$data["akun_kode"]=$akun_kode;
				$data["akun_jenis"]=$akun_jenis;
				$data["akun_level"]=$akun_level;
			}
			
			$this->db->insert('akun', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for update record
		function akun_update($akun_id,$akun_kode,$akun_jenis,$akun_parent,$akun_level,$akun_nama,$akun_debet,$akun_kredit,$akun_saldo,$akun_aktif,$akun_update,$akun_date_update){
			$data = array(
				"akun_kode"=>$akun_kode, 
				"akun_nama"=>$akun_nama, 
				"akun_debet"=>$akun_debet, 
				"akun_kredit"=>$akun_kredit, 
				"akun_saldo"=>$akun_saldo, 
				"akun_aktif"=>$akun_aktif, 
				"akun_update"=>$akun_update, 
				"akun_date_update"=>$akun_date_update 
			);
			
			$sql="select * from akun where akun_id='".$akun_parent."'";
			$query_akun=$this->db->query($sql);
			if($query_akun->num_rows()){
				$ds_akun=$query_akun->row();
				$data["akun_parent"]=$akun_parent;
				$data["akun_kode"]=$ds_akun->akun_kode.".".$akun_kode;
				$data["akun_jenis"]=$ds_akun->akun_jenis;
				$data["akun_level"]=$ds_akun->akun_level+1;
			}else{
				$data["akun_kode"]=$akun_kode;
				$data["akun_jenis"]=$akun_jenis;
				$data["akun_level"]=$akun_level;
			}
			
			$this->db->where('akun_id', $akun_id);
			$this->db->update('akun', $data);
			$sql="UPDATE akun set akun_revised=(akun_revised+1) where akun_id='".$akun_id."'";
			$this->db->query($sql);
			return '1';
		}
		
		//fcuntion for delete record
		function akun_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the akuns at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM vu_akun WHERE akun_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM vu_akun WHERE ";
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
		function akun_search($akun_id ,$akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$start,$end){
			//full query
			$query="select * FROM vu_akun";
			
			if($akun_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_id LIKE '%".$akun_id."%'";
			};
			if($akun_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_kode LIKE '%".$akun_kode."%'";
			};
			if($akun_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_jenis LIKE '%".$akun_jenis."%'";
			};
			if($akun_parent!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_parent LIKE '%".$akun_parent."%'";
			};
			if($akun_level!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_level LIKE '%".$akun_level."%'";
			};
			if($akun_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " akun_nama LIKE '%".$akun_nama."%'";
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
		function akun_print($akun_id ,$akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter){
			//full query
			$sql="select * FROM vu_akun";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (akun_id LIKE '%".addslashes($filter)."%' OR akun_kode LIKE '%".addslashes($filter)."%' OR akun_jenis LIKE '%".addslashes($filter)."%' OR akun_parent LIKE '%".addslashes($filter)."%' OR akun_level LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' OR akun_debet LIKE '%".addslashes($filter)."%' OR akun_kredit LIKE '%".addslashes($filter)."%' OR akun_saldo LIKE '%".addslashes($filter)."%' OR akun_aktif LIKE '%".addslashes($filter)."%' OR akun_creator LIKE '%".addslashes($filter)."%' OR akun_date_create LIKE '%".addslashes($filter)."%' OR akun_update LIKE '%".addslashes($filter)."%' OR akun_date_update LIKE '%".addslashes($filter)."%' OR akun_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($akun_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_id LIKE '%".$akun_id."%'";
				};
				if($akun_kode!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_kode LIKE '%".$akun_kode."%'";
				};
				if($akun_jenis!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_jenis LIKE '%".$akun_jenis."%'";
				};
				if($akun_parent!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_parent LIKE '%".$akun_parent."%'";
				};
				if($akun_level!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_level LIKE '%".$akun_level."%'";
				};
				if($akun_nama!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_nama LIKE '%".$akun_nama."%'";
				};
				if($akun_debet!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_debet LIKE '%".$akun_debet."%'";
				};
				if($akun_kredit!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_kredit LIKE '%".$akun_kredit."%'";
				};
				if($akun_saldo!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_saldo LIKE '%".$akun_saldo."%'";
				};
				if($akun_aktif!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_aktif LIKE '%".$akun_aktif."%'";
				};
				if($akun_creator!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_creator LIKE '%".$akun_creator."%'";
				};
				if($akun_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_date_create LIKE '%".$akun_date_create."%'";
				};
				if($akun_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_update LIKE '%".$akun_update."%'";
				};
				if($akun_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_date_update LIKE '%".$akun_date_update."%'";
				};
				if($akun_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " akun_revised LIKE '%".$akun_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function akun_export_excel($akun_id ,$akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter){
			//full query
			$sql="select * FROM vu_akun";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (akun_id LIKE '%".addslashes($filter)."%' OR akun_kode LIKE '%".addslashes($filter)."%' OR akun_jenis LIKE '%".addslashes($filter)."%' OR akun_parent LIKE '%".addslashes($filter)."%' OR akun_level LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' OR akun_debet LIKE '%".addslashes($filter)."%' OR akun_kredit LIKE '%".addslashes($filter)."%' OR akun_saldo LIKE '%".addslashes($filter)."%' OR akun_aktif LIKE '%".addslashes($filter)."%' OR akun_creator LIKE '%".addslashes($filter)."%' OR akun_date_create LIKE '%".addslashes($filter)."%' OR akun_update LIKE '%".addslashes($filter)."%' OR akun_date_update LIKE '%".addslashes($filter)."%' OR akun_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($akun_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_id LIKE '%".$akun_id."%'";
				};
				if($akun_kode!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_kode LIKE '%".$akun_kode."%'";
				};
				if($akun_jenis!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_jenis LIKE '%".$akun_jenis."%'";
				};
				if($akun_parent!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_parent LIKE '%".$akun_parent."%'";
				};
				if($akun_level!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_level LIKE '%".$akun_level."%'";
				};
				if($akun_nama!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_nama LIKE '%".$akun_nama."%'";
				};
				if($akun_debet!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_debet LIKE '%".$akun_debet."%'";
				};
				if($akun_kredit!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_kredit LIKE '%".$akun_kredit."%'";
				};
				if($akun_saldo!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_saldo LIKE '%".$akun_saldo."%'";
				};
				if($akun_aktif!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_aktif LIKE '%".$akun_aktif."%'";
				};
				if($akun_creator!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_creator LIKE '%".$akun_creator."%'";
				};
				if($akun_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_date_create LIKE '%".$akun_date_create."%'";
				};
				if($akun_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_update LIKE '%".$akun_update."%'";
				};
				if($akun_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_date_update LIKE '%".$akun_date_update."%'";
				};
				if($akun_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " akun_revised LIKE '%".$akun_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>