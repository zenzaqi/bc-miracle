<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_umum Model
	+ Description	: For record model process back-end
	+ Filename 		: c_jurnal_umum.php
 	+ creator 		: 
 	+ Created on 01/Apr/2010 12:13:56
	
*/

class M_jurnal_umum extends Model{
		
		//constructor
		function M_jurnal_umum() {
			parent::Model();
		}
		
		function get_akun_list($task, $master_id, $selected_id, $filter="",$start=0,$end=15){
			$sql = "SELECT * from tbl_m_akun";
			if($task=='detail'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .=" akun_id IN (SELECT djurnal_akun FROM jurnal_umum_detail WHERE djurnal_master='".$master_id."')";
			}else if($task=='selected'){
				if($selected_id!=="")
				{
					$selected_id=substr($selected_id,0,strlen($selected_id)-1);
					$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." akun_id IN(".$selected_id.")";
				}
			}
			
			if ($filter<>""){
					$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
					$sql .= " (akun_id LIKE '%".addslashes($filter)."%' OR akun_kode LIKE '%".addslashes($filter)."%' OR akun_nama LIKE '%".addslashes($filter)."%' OR akun_jenis LIKE '%".addslashes($filter)."%')";
			}
				
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
	
		function get_detail_jurnal_list($task,$master_id,$query,$start,$end){
			
			$query="SELECT * from jurnal_umum_detail WHERE djurnal_master='".$master_id."'";
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
		
		//function for get list record
		function jurnal_umum_list($filter,$start,$end){
			$query = "SELECT * FROM vu_t_jurnal";

			// For simple search
/*			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jurnal_id LIKE '%".addslashes($filter)."%' OR jurnal_tanggal LIKE '%".addslashes($filter)."%' OR jurnal_akun LIKE '%".addslashes($filter)."%' OR jurnal_keterangan LIKE '%".addslashes($filter)."%' OR jurnal_noref LIKE '%".addslashes($filter)."%' OR jurnal_debet LIKE '%".addslashes($filter)."%' OR jurnal_kredit LIKE '%".addslashes($filter)."%' OR jurnal_unit LIKE '%".addslashes($filter)."%' OR jurnal_author LIKE '%".addslashes($filter)."%' OR jurnal_date_create LIKE '%".addslashes($filter)."%' OR jurnal_update LIKE '%".addslashes($filter)."%' OR jurnal_date_update LIKE '%".addslashes($filter)."%' OR jurnal_post LIKE '%".addslashes($filter)."%' OR jurnal_date_post LIKE '%".addslashes($filter)."%' OR jurnal_revised LIKE '%".addslashes($filter)."%' )";
			}*/
			
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
		
		function detail_jurnal_purge($jurnal_master){
			$sql="DELETE from jurnal_umum,jurnal_umum_detail WHERE jurnal_id=djurnal_master AND jurnal_id='".$jurnal_master."'";
			$this->db->query($sql);
			return '1';
		}
		
		function detail_jurnal_insert($jurnal_id,$jurnal_master,$jurnal_akun, $jurnal_detail, $jurnal_debet,$jurnal_kredit){
			$data = array(
				"djurnal_master"=>$jurnal_master, 
				"djurnal_akun"=>$jurnal_akun, 
				"djurnal_detail"=>$jurnal_detail,
				"djurnal_debet"=>$jurnal_debet, 
				"djurnal_kredit"=>$jurnal_kredit
			);
			$this->db->insert('jurnal_umum_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//function for create new record
		function jurnal_umum_create($jurnal_tanggal ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ){
			$data = array(
				"jurnal_tanggal"=>$jurnal_tanggal, 
				"jurnal_keterangan"=>$jurnal_keterangan, 
				"jurnal_noref"=>$jurnal_noref, 
				"jurnal_unit"=>$jurnal_unit, 
				"jurnal_author"=>$jurnal_author, 
				"jurnal_date_create"=>$jurnal_date_create
			);
			$this->db->insert('jurnal_umum', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
			else
				return '0';
		}
		
		//function for update record
		function jurnal_umum_update($jurnal_id,$jurnal_tanggal,$jurnal_keterangan,$jurnal_noref,$jurnal_unit,$jurnal_update,$jurnal_date_update){
			$data = array(
				"jurnal_tanggal"=>$jurnal_tanggal, 
				"jurnal_keterangan"=>$jurnal_keterangan, 
				"jurnal_noref"=>$jurnal_noref, 
				"jurnal_unit"=>$jurnal_unit, 
				"jurnal_update"=>$jurnal_update, 
				"jurnal_date_update"=>$jurnal_date_update 
			);
			
			$this->db->where('jurnal_id', $jurnal_id);
			$this->db->update('jurnal_umum', $data);
			$sql="UPDATE jurnal_umum set jurnal_revised=(jurnal_revised+1) where jurnal_id='".$jurnal_id."'";
			$this->db->query($sql);
			return $jurnal_id;
		}
		
		//fcuntion for delete record
		function jurnal_umum_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the jurnal_umums at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM jurnal_umum WHERE jurnal_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM jurnal_umum WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jurnal_id= ".$pkid[$i];
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
		function jurnal_umum_search($jurnal_id ,$jurnal_tanggal ,$jurnal_akun ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_debet ,$jurnal_kredit ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ,$jurnal_update ,$jurnal_date_update ,$jurnal_post ,$jurnal_date_post ,$jurnal_revised ,$start,$end){
			//full query
			$query="select * from jurnal_umum";
			
			if($jurnal_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_id LIKE '%".$jurnal_id."%'";
			};
			if($jurnal_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_tanggal LIKE '%".$jurnal_tanggal."%'";
			};
			if($jurnal_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_akun LIKE '%".$jurnal_akun."%'";
			};
			if($jurnal_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_keterangan LIKE '%".$jurnal_keterangan."%'";
			};
			if($jurnal_noref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_noref LIKE '%".$jurnal_noref."%'";
			};
			if($jurnal_debet!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_debet LIKE '%".$jurnal_debet."%'";
			};
			if($jurnal_kredit!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_kredit LIKE '%".$jurnal_kredit."%'";
			};
			if($jurnal_unit!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_unit LIKE '%".$jurnal_unit."%'";
			};
			if($jurnal_author!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_author LIKE '%".$jurnal_author."%'";
			};
			if($jurnal_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_date_create LIKE '%".$jurnal_date_create."%'";
			};
			if($jurnal_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_update LIKE '%".$jurnal_update."%'";
			};
			if($jurnal_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_date_update LIKE '%".$jurnal_date_update."%'";
			};
			if($jurnal_post!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_post LIKE '%".$jurnal_post."%'";
			};
			if($jurnal_date_post!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_date_post LIKE '%".$jurnal_date_post."%'";
			};
			if($jurnal_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jurnal_revised LIKE '%".$jurnal_revised."%'";
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
		function jurnal_umum_print($jurnal_id ,$jurnal_tanggal ,$jurnal_akun ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_debet ,$jurnal_kredit ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ,$jurnal_update ,$jurnal_date_update ,$jurnal_post ,$jurnal_date_post ,$jurnal_revised ,$option,$filter){
			//full query
			$sql="select * from jurnal_umum";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (jurnal_id LIKE '%".addslashes($filter)."%' OR jurnal_tanggal LIKE '%".addslashes($filter)."%' OR jurnal_akun LIKE '%".addslashes($filter)."%' OR jurnal_keterangan LIKE '%".addslashes($filter)."%' OR jurnal_noref LIKE '%".addslashes($filter)."%' OR jurnal_debet LIKE '%".addslashes($filter)."%' OR jurnal_kredit LIKE '%".addslashes($filter)."%' OR jurnal_unit LIKE '%".addslashes($filter)."%' OR jurnal_author LIKE '%".addslashes($filter)."%' OR jurnal_date_create LIKE '%".addslashes($filter)."%' OR jurnal_update LIKE '%".addslashes($filter)."%' OR jurnal_date_update LIKE '%".addslashes($filter)."%' OR jurnal_post LIKE '%".addslashes($filter)."%' OR jurnal_date_post LIKE '%".addslashes($filter)."%' OR jurnal_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($jurnal_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_id LIKE '%".$jurnal_id."%'";
				};
				if($jurnal_tanggal!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_tanggal LIKE '%".$jurnal_tanggal."%'";
				};
				if($jurnal_akun!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_akun LIKE '%".$jurnal_akun."%'";
				};
				if($jurnal_keterangan!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_keterangan LIKE '%".$jurnal_keterangan."%'";
				};
				if($jurnal_noref!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_noref LIKE '%".$jurnal_noref."%'";
				};
				if($jurnal_debet!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_debet LIKE '%".$jurnal_debet."%'";
				};
				if($jurnal_kredit!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_kredit LIKE '%".$jurnal_kredit."%'";
				};
				if($jurnal_unit!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_unit LIKE '%".$jurnal_unit."%'";
				};
				if($jurnal_author!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_author LIKE '%".$jurnal_author."%'";
				};
				if($jurnal_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_date_create LIKE '%".$jurnal_date_create."%'";
				};
				if($jurnal_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_update LIKE '%".$jurnal_update."%'";
				};
				if($jurnal_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_date_update LIKE '%".$jurnal_date_update."%'";
				};
				if($jurnal_post!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_post LIKE '%".$jurnal_post."%'";
				};
				if($jurnal_date_post!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_date_post LIKE '%".$jurnal_date_post."%'";
				};
				if($jurnal_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " jurnal_revised LIKE '%".$jurnal_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function jurnal_umum_export_excel($jurnal_id ,$jurnal_tanggal ,$jurnal_akun ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_debet ,$jurnal_kredit ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ,$jurnal_update ,$jurnal_date_update ,$jurnal_post ,$jurnal_date_post ,$jurnal_revised ,$option,$filter){
			//full query
			$sql="select * from jurnal_umum";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (jurnal_id LIKE '%".addslashes($filter)."%' OR jurnal_tanggal LIKE '%".addslashes($filter)."%' OR jurnal_akun LIKE '%".addslashes($filter)."%' OR jurnal_keterangan LIKE '%".addslashes($filter)."%' OR jurnal_noref LIKE '%".addslashes($filter)."%' OR jurnal_debet LIKE '%".addslashes($filter)."%' OR jurnal_kredit LIKE '%".addslashes($filter)."%' OR jurnal_unit LIKE '%".addslashes($filter)."%' OR jurnal_author LIKE '%".addslashes($filter)."%' OR jurnal_date_create LIKE '%".addslashes($filter)."%' OR jurnal_update LIKE '%".addslashes($filter)."%' OR jurnal_date_update LIKE '%".addslashes($filter)."%' OR jurnal_post LIKE '%".addslashes($filter)."%' OR jurnal_date_post LIKE '%".addslashes($filter)."%' OR jurnal_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($jurnal_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_id LIKE '%".$jurnal_id."%'";
				};
				if($jurnal_tanggal!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_tanggal LIKE '%".$jurnal_tanggal."%'";
				};
				if($jurnal_akun!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_akun LIKE '%".$jurnal_akun."%'";
				};
				if($jurnal_keterangan!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_keterangan LIKE '%".$jurnal_keterangan."%'";
				};
				if($jurnal_noref!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_noref LIKE '%".$jurnal_noref."%'";
				};
				if($jurnal_debet!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_debet LIKE '%".$jurnal_debet."%'";
				};
				if($jurnal_kredit!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_kredit LIKE '%".$jurnal_kredit."%'";
				};
				if($jurnal_unit!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_unit LIKE '%".$jurnal_unit."%'";
				};
				if($jurnal_author!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_author LIKE '%".$jurnal_author."%'";
				};
				if($jurnal_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_date_create LIKE '%".$jurnal_date_create."%'";
				};
				if($jurnal_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_update LIKE '%".$jurnal_update."%'";
				};
				if($jurnal_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_date_update LIKE '%".$jurnal_date_update."%'";
				};
				if($jurnal_post!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_post LIKE '%".$jurnal_post."%'";
				};
				if($jurnal_date_post!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_date_post LIKE '%".$jurnal_date_post."%'";
				};
				if($jurnal_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " jurnal_revised LIKE '%".$jurnal_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>