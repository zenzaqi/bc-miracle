<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: produk_group Model
	+ Description	: For record model process back-end
	+ Filename 		: c_produk_group.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 28/Jul/2009 10:10:08
	
*/

class M_produk_group extends Model{
		
		//constructor
		function M_produk_group() {
			parent::Model();
		}
		
		//function for get list record
		function produk_group_list($filter,$start,$end){
			$query = "SELECT * FROM produk_group LEFT JOIN kategori ON group_kelompok=kategori_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (group_kode LIKE '%".addslashes($filter)."%' OR group_nama LIKE '%".addslashes($filter)."%' )";
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
		function produk_group_update($group_id ,$group_kode, $group_nama ,$group_duproduk ,$group_dmproduk ,$group_durawat ,$group_dmrawat ,$group_dupaket ,$group_dmpaket ,$group_kelompok ,$group_keterangan ,$group_aktif ,$group_creator ,$group_date_create ,$group_update ,$group_date_update ,$group_revised ){
		if ($group_aktif=="")
			$group_aktif = "Aktif";
			$data = array(
				"group_id"=>$group_id,
				"group_kode"=>$group_kode,	
				"group_nama"=>$group_nama,			
				"group_duproduk"=>$group_duproduk,			
				"group_dmproduk"=>$group_dmproduk,			
				"group_durawat"=>$group_durawat,			
				"group_dmrawat"=>$group_dmrawat,			
				"group_dupaket"=>$group_dupaket,			
				"group_dmpaket"=>$group_dmpaket,
				//"group_kelompok"=>$group_kelompok,
				"group_keterangan"=>$group_keterangan,			
				"group_aktif"=>$group_aktif,			
				"group_creator"=>$group_creator,			
				"group_date_create"=>$group_date_create,			
				"group_update"=>$group_update,			
				"group_date_update"=>$group_date_update,			
				"group_revised"=>$group_revised			
			);
			$sql="SELECT kategori_id FROM kategori WHERE kategori_id='$group_kelompok'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["group_kelompok"]=$group_kelompok;
			
			$this->db->where('group_id', $group_id);
			$this->db->update('produk_group', $data);
			
			/*if($this->db->affected_rows())
				return '1';
			else
				return '0';*/
			return '1';
		}
		
		//function for create new record
		function produk_group_create($group_kode, $group_nama ,$group_duproduk ,$group_dmproduk ,$group_durawat ,$group_dmrawat ,$group_dupaket ,$group_dmpaket ,$group_kelompok ,$group_keterangan ,$group_aktif ,$group_creator ,$group_date_create ,$group_update ,$group_date_update ,$group_revised ){
		if ($group_aktif=="")
			$group_aktif = "Aktif";
			$data = array(
				"group_kode"=>$group_kode,	
				"group_nama"=>$group_nama,	
				"group_duproduk"=>$group_duproduk,	
				"group_dmproduk"=>$group_dmproduk,	
				"group_durawat"=>$group_durawat,	
				"group_dmrawat"=>$group_dmrawat,	
				"group_dupaket"=>$group_dupaket,	
				"group_dmpaket"=>$group_dmpaket,
				"group_kelompok"=>$group_kelompok,	
				"group_keterangan"=>$group_keterangan,	
				"group_aktif"=>$group_aktif,	
				"group_creator"=>$group_creator,	
				"group_date_create"=>$group_date_create,	
				"group_update"=>$group_update,	
				"group_date_update"=>$group_date_update,	
				"group_revised"=>$group_revised	
			);
			$this->db->insert('produk_group', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function produk_group_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the produk_groups at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM produk_group WHERE group_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM produk_group WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "group_id= ".$pkid[$i];
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
		function produk_group_search($group_id, $group_kode ,$group_nama ,$group_duproduk ,$group_dmproduk ,$group_durawat ,$group_dmrawat ,$group_dupaket ,$group_dmpaket ,$group_keterangan ,$group_kelompok ,$group_aktif ,$group_creator ,$group_date_create ,$group_update ,$group_date_update ,$group_revised ,$start,$end){
			//full query
			if($group_aktif=="")
				$group_aktif="Aktif";
			$query="SELECT * FROM produk_group LEFT JOIN kategori ON group_kelompok=kategori_id";
			
			if($group_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_id LIKE '%".$group_id."%'";
			};
			if($group_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_kode = '".$group_kode."'";
			};
			if($group_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_nama LIKE '%".$group_nama."%'";
			};
			if($group_duproduk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_duproduk LIKE '%".$group_duproduk."%'";
			};
			if($group_dmproduk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_dmproduk LIKE '%".$group_dmproduk."%'";
			};
			if($group_durawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_durawat LIKE '%".$group_durawat."%'";
			};
			if($group_dmrawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_dmrawat LIKE '%".$group_dmrawat."%'";
			};
			if($group_dupaket!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_dupaket LIKE '%".$group_dupaket."%'";
			};
			if($group_dmpaket!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_dmpaket LIKE '%".$group_dmpaket."%'";
			};
			if($group_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_keterangan LIKE '%".$group_keterangan."%'";
			};
			if($group_kelompok!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_kelompok='".$group_kelompok."'";
			};
			if($group_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_aktif='".$group_aktif."'";
			};
			if($group_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_creator LIKE '%".$group_creator."%'";
			};
			if($group_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_date_create LIKE '%".$group_date_create."%'";
			};
			if($group_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_update LIKE '%".$group_update."%'";
			};
			if($group_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_date_update LIKE '%".$group_date_update."%'";
			};
			if($group_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " group_revised LIKE '%".$group_revised."%'";
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
		function produk_group_print($group_id, $group_kode ,$group_nama ,$group_duproduk ,$group_dmproduk ,$group_durawat ,$group_dmrawat ,$group_dupaket ,$group_dmpaket ,$group_keterangan ,$group_aktif ,$group_creator ,$group_date_create ,$group_update ,$group_date_update ,$group_revised ,$option,$filter){
			//full query
			$query="select * from produk_group";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (group_id LIKE '%".addslashes($filter)."%' OR group_kode LIKE '%".addslashes($filter)."%' OR group_nama LIKE '%".addslashes($filter)."%' OR group_duproduk LIKE '%".addslashes($filter)."%' OR group_dmproduk LIKE '%".addslashes($filter)."%' OR group_durawat LIKE '%".addslashes($filter)."%' OR group_dmrawat LIKE '%".addslashes($filter)."%' OR group_dupaket LIKE '%".addslashes($filter)."%' OR group_dmpaket LIKE '%".addslashes($filter)."%' OR group_keterangan LIKE '%".addslashes($filter)."%' OR group_aktif LIKE '%".addslashes($filter)."%' OR group_creator LIKE '%".addslashes($filter)."%' OR group_date_create LIKE '%".addslashes($filter)."%' OR group_update LIKE '%".addslashes($filter)."%' OR group_date_update LIKE '%".addslashes($filter)."%' OR group_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($group_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_id LIKE '%".$group_id."%'";
				};
				if($group_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_kode LIKE '%".$group_kode."%'";
				};
				if($group_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_nama LIKE '%".$group_nama."%'";
				};
				if($group_duproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_duproduk LIKE '%".$group_duproduk."%'";
				};
				if($group_dmproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dmproduk LIKE '%".$group_dmproduk."%'";
				};
				if($group_durawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_durawat LIKE '%".$group_durawat."%'";
				};
				if($group_dmrawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dmrawat LIKE '%".$group_dmrawat."%'";
				};
				if($group_dupaket!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dupaket LIKE '%".$group_dupaket."%'";
				};
				if($group_dmpaket!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dmpaket LIKE '%".$group_dmpaket."%'";
				};
				if($group_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_keterangan LIKE '%".$group_keterangan."%'";
				};
				if($group_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_aktif LIKE '%".$group_aktif."%'";
				};
				if($group_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_creator LIKE '%".$group_creator."%'";
				};
				if($group_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_date_create LIKE '%".$group_date_create."%'";
				};
				if($group_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_update LIKE '%".$group_update."%'";
				};
				if($group_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_date_update LIKE '%".$group_date_update."%'";
				};
				if($group_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_revised LIKE '%".$group_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function produk_group_export_excel($group_id, $group_kode ,$group_nama ,$group_duproduk ,$group_dmproduk ,$group_durawat ,$group_dmrawat ,$group_dupaket ,$group_dmpaket ,$group_keterangan ,$group_aktif ,$group_creator ,$group_date_create ,$group_update ,$group_date_update ,$group_revised ,$option,$filter){
			//full query
			$query="select * from produk_group";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (group_id LIKE '%".addslashes($filter)."%' OR group_kode LIKE '%".addslashes($filter)."%' OR group_nama LIKE '%".addslashes($filter)."%' OR group_duproduk LIKE '%".addslashes($filter)."%' OR group_dmproduk LIKE '%".addslashes($filter)."%' OR group_durawat LIKE '%".addslashes($filter)."%' OR group_dmrawat LIKE '%".addslashes($filter)."%' OR group_dupaket LIKE '%".addslashes($filter)."%' OR group_dmpaket LIKE '%".addslashes($filter)."%' OR group_keterangan LIKE '%".addslashes($filter)."%' OR group_aktif LIKE '%".addslashes($filter)."%' OR group_creator LIKE '%".addslashes($filter)."%' OR group_date_create LIKE '%".addslashes($filter)."%' OR group_update LIKE '%".addslashes($filter)."%' OR group_date_update LIKE '%".addslashes($filter)."%' OR group_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($group_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_id LIKE '%".$group_id."%'";
				};
				if($group_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_kode LIKE '%".$group_kode."%'";
				};
				if($group_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_nama LIKE '%".$group_nama."%'";
				};
				if($group_duproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_duproduk LIKE '%".$group_duproduk."%'";
				};
				if($group_dmproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dmproduk LIKE '%".$group_dmproduk."%'";
				};
				if($group_durawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_durawat LIKE '%".$group_durawat."%'";
				};
				if($group_dmrawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dmrawat LIKE '%".$group_dmrawat."%'";
				};
				if($group_dupaket!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dupaket LIKE '%".$group_dupaket."%'";
				};
				if($group_dmpaket!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_dmpaket LIKE '%".$group_dmpaket."%'";
				};
				if($group_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_keterangan LIKE '%".$group_keterangan."%'";
				};
				if($group_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_aktif LIKE '%".$group_aktif."%'";
				};
				if($group_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_creator LIKE '%".$group_creator."%'";
				};
				if($group_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_date_create LIKE '%".$group_date_create."%'";
				};
				if($group_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_update LIKE '%".$group_update."%'";
				};
				if($group_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_date_update LIKE '%".$group_date_update."%'";
				};
				if($group_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " group_revised LIKE '%".$group_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>