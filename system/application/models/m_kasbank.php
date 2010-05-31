<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: kasbank Model
	+ Description	: For record model process back-end
	+ Filename 		: c_kasbank.php
 	+ Author  		: Zainal, Anam
 	+ Created on 12/Mar/2010 10:45:40
	
*/

class M_kasbank extends Model{
		
		//constructor
		function M_kasbank() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_kasbank_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM kasbank_detail where dkasbank_master='".$master_id."'";
			// $query = "SELECT
						// *
					// FROM
						// `kasbank_detail` 
						// `kasbank_detail` 
					// Left Join `tbl_m_akun` ON `kasbank_detail`.`dkasbank_akun` = `tbl_m_akun`.`akun_id`
					// WHERE
						// dkasbank_master = '".$master_id."'";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			if($start!==0){
				$limit=str_replace("SELECT","SELECT TOP $end ",$query)." WHERE dkasbank_master NOT IN (SELECT TOP $start dkasbank_akun FROM dkasbank_master)";
			}else{
				$limit=$query;
			}
			// $limit = $query." LIMIT ".$start.",".$end;			
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
		//end of function
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(kasbank_id) as master_id from kasbank";
			$result = $this->db->query($query);
			if($result->num_rows()){
				$data=$result->row();
				$master_id=$data->master_id;
				return $master_id;
			}else{
				return '0';
			}
		}
		//eof
		
		//purge all detail from master
		function detail_kasbank_detail_purge($master_id){
			$sql="DELETE from kasbank_detail where dkasbank_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_kasbank_detail_insert($master_id,$dkasbank_id ,$dkasbank_master ,$dkasbank_akun ,$dkasbank_detail ,$dkasbank_debet ,$dkasbank_kredit ){
			//if master id not capture from view then capture it from max pk from master table
			if($dkasbank_master=="" || $dkasbank_master==NULL){
				$dkasbank_master=$this->get_master_id();
			}
			
			$data = array(
				"dkasbank_master"=>$dkasbank_master, 
				"dkasbank_akun"=>$dkasbank_akun, 
				"dkasbank_detail"=>$dkasbank_detail, 
				"dkasbank_debet"=>$dkasbank_debet, 
				"dkasbank_kredit"=>$dkasbank_kredit 
			);
			$this->db->insert('kasbank_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function kasbank_list($filter,$start,$end,$where_jenis){
			$where = "WHERE `kasbank`.`kasbank_jenis` = '".$where_jenis."'";
			$query = "SELECT * FROM kasbank Left Join `tbl_m_akun` ON `kasbank`.`kasbank_akun` = `tbl_m_akun`.`akun_id` ".$where;

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kasbank_id LIKE '%".addslashes($filter)."%' OR kasbank_tanggal LIKE '%".addslashes($filter)."%' OR kasbank_nobukti LIKE '%".addslashes($filter)."%' OR kasbank_akun LIKE '%".addslashes($filter)."%' OR kasbank_terimauntuk LIKE '%".addslashes($filter)."%' OR kasbank_jenis LIKE '%".addslashes($filter)."%' OR kasbank_noref LIKE '%".addslashes($filter)."%' OR kasbank_keterangan LIKE '%".addslashes($filter)."%' OR kasbank_author LIKE '%".addslashes($filter)."%' OR kasbank_date_create LIKE '%".addslashes($filter)."%' OR kasbank_update LIKE '%".addslashes($filter)."%' OR kasbank_date_update LIKE '%".addslashes($filter)."%' OR kasbank_post LIKE '%".addslashes($filter)."%' OR kasbank_date_post LIKE '%".addslashes($filter)."%' OR kasbank_revised LIKE '%".addslashes($filter)."%' )";
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
		function kasbank_create($kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,$kasbank_jenis ,$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,$kasbank_post, $kasbank_date_post ){
			$data = array(
				"kasbank_tanggal"=>$kasbank_tanggal, 
				"kasbank_nobukti"=>$kasbank_nobukti, 
				"kasbank_akun"=>$kasbank_akun, 
				"kasbank_terimauntuk"=>$kasbank_terimauntuk, 
				"kasbank_jenis"=>$kasbank_jenis, 
				"kasbank_noref"=>$kasbank_noref, 
				"kasbank_keterangan"=>$kasbank_keterangan, 
				"kasbank_author"=>$kasbank_author, 
				"kasbank_date_create"=>$kasbank_date_create, 
				"kasbank_post"=>$kasbank_post, 
				"kasbank_date_post"=>$kasbank_date_post 
			);
			$this->db->insert('kasbank', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
			else
				return '0';
		}
		
		//function for update record
		function kasbank_update($kasbank_id,$kasbank_tanggal,$kasbank_nobukti,$kasbank_akun,$kasbank_terimauntuk,$kasbank_jenis,$kasbank_noref,$kasbank_keterangan,$kasbank_update,$kasbank_date_update,$kasbank_post,$kasbank_date_post){
			$data = array(
				"kasbank_tanggal"=>$kasbank_tanggal, 
				"kasbank_nobukti"=>$kasbank_nobukti, 
				//"kasbank_akun"=>$kasbank_akun, 
				"kasbank_terimauntuk"=>$kasbank_terimauntuk, 
				"kasbank_jenis"=>$kasbank_jenis, 
				"kasbank_noref"=>$kasbank_noref, 
				"kasbank_keterangan"=>$kasbank_keterangan, 
				"kasbank_update"=>$kasbank_update, 
				"kasbank_date_update"=>$kasbank_date_update, 
				"kasbank_post"=>$kasbank_post, 
				"kasbank_date_post"=>$kasbank_date_post 
			);
			
			$sql="SELECT akun_id FROM tbl_m_akun where akun_nama='".$kasbank_akun."'";
			$rsA=$this->db->query($sql);
			if($rsA->result() != NULL){
				foreach($rsA->result() as $akun){
					$data['kasbank_akun']=$akun->akun_id;
				}
			}else{
			$data['kasbank_akun']=$kasbank_akun;
			}
			
			
			$this->db->where('kasbank_id', $kasbank_id);
			$this->db->update('kasbank', $data);
			$sql="UPDATE kasbank set kasbank_revised=(kasbank_revised+1) where kasbank_id='".$kasbank_id."'";
			$this->db->query($sql);
			return $kasbank_id;
		}
		
		//fcuntion for delete record
		function kasbank_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the kasbanks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM kasbank WHERE kasbank_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM kasbank WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "kasbank_id= ".$pkid[$i];
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
		function kasbank_search($kasbank_id ,$kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,$kasbank_jenis ,$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,$kasbank_update ,$kasbank_date_update ,$kasbank_post ,$kasbank_date_post ,$kasbank_revised ,$start,$end){
			//full query
			$query="select * from kasbank";
			
			if($kasbank_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_id LIKE '%".$kasbank_id."%'";
			};
			if($kasbank_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_tanggal LIKE '%".$kasbank_tanggal."%'";
			};
			if($kasbank_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_nobukti LIKE '%".$kasbank_nobukti."%'";
			};
			if($kasbank_akun!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_akun LIKE '%".$kasbank_akun."%'";
			};
			if($kasbank_terimauntuk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_terimauntuk LIKE '%".$kasbank_terimauntuk."%'";
			};
			if($kasbank_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_jenis LIKE '%".$kasbank_jenis."%'";
			};
			if($kasbank_noref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_noref LIKE '%".$kasbank_noref."%'";
			};
			if($kasbank_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_keterangan LIKE '%".$kasbank_keterangan."%'";
			};
			if($kasbank_author!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_author LIKE '%".$kasbank_author."%'";
			};
			if($kasbank_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_date_create LIKE '%".$kasbank_date_create."%'";
			};
			if($kasbank_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_update LIKE '%".$kasbank_update."%'";
			};
			if($kasbank_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_date_update LIKE '%".$kasbank_date_update."%'";
			};
			if($kasbank_post!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_post LIKE '%".$kasbank_post."%'";
			};
			if($kasbank_date_post!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_date_post LIKE '%".$kasbank_date_post."%'";
			};
			if($kasbank_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_revised LIKE '%".$kasbank_revised."%'";
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
		function kasbank_print($kasbank_id ,$kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,$kasbank_jenis ,$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,$kasbank_update ,$kasbank_date_update ,$kasbank_post ,$kasbank_date_post ,$kasbank_revised ,$option,$filter){
			//full query
			$sql="select * from kasbank";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (kasbank_id LIKE '%".addslashes($filter)."%' OR kasbank_tanggal LIKE '%".addslashes($filter)."%' OR kasbank_nobukti LIKE '%".addslashes($filter)."%' OR kasbank_akun LIKE '%".addslashes($filter)."%' OR kasbank_terimauntuk LIKE '%".addslashes($filter)."%' OR kasbank_jenis LIKE '%".addslashes($filter)."%' OR kasbank_noref LIKE '%".addslashes($filter)."%' OR kasbank_keterangan LIKE '%".addslashes($filter)."%' OR kasbank_author LIKE '%".addslashes($filter)."%' OR kasbank_date_create LIKE '%".addslashes($filter)."%' OR kasbank_update LIKE '%".addslashes($filter)."%' OR kasbank_date_update LIKE '%".addslashes($filter)."%' OR kasbank_post LIKE '%".addslashes($filter)."%' OR kasbank_date_post LIKE '%".addslashes($filter)."%' OR kasbank_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($kasbank_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_id LIKE '%".$kasbank_id."%'";
				};
				if($kasbank_tanggal!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_tanggal LIKE '%".$kasbank_tanggal."%'";
				};
				if($kasbank_nobukti!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_nobukti LIKE '%".$kasbank_nobukti."%'";
				};
				if($kasbank_akun!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_akun LIKE '%".$kasbank_akun."%'";
				};
				if($kasbank_terimauntuk!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_terimauntuk LIKE '%".$kasbank_terimauntuk."%'";
				};
				if($kasbank_jenis!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_jenis LIKE '%".$kasbank_jenis."%'";
				};
				if($kasbank_noref!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_noref LIKE '%".$kasbank_noref."%'";
				};
				if($kasbank_keterangan!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_keterangan LIKE '%".$kasbank_keterangan."%'";
				};
				if($kasbank_author!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_author LIKE '%".$kasbank_author."%'";
				};
				if($kasbank_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_date_create LIKE '%".$kasbank_date_create."%'";
				};
				if($kasbank_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_update LIKE '%".$kasbank_update."%'";
				};
				if($kasbank_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_date_update LIKE '%".$kasbank_date_update."%'";
				};
				if($kasbank_post!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_post LIKE '%".$kasbank_post."%'";
				};
				if($kasbank_date_post!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_date_post LIKE '%".$kasbank_date_post."%'";
				};
				if($kasbank_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_revised LIKE '%".$kasbank_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function kasbank_export_excel($kasbank_id ,$kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,$kasbank_jenis ,$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,$kasbank_update ,$kasbank_date_update ,$kasbank_post ,$kasbank_date_post ,$kasbank_revised ,$option,$filter){
			//full query
			$sql="select * from kasbank";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (kasbank_id LIKE '%".addslashes($filter)."%' OR kasbank_tanggal LIKE '%".addslashes($filter)."%' OR kasbank_nobukti LIKE '%".addslashes($filter)."%' OR kasbank_akun LIKE '%".addslashes($filter)."%' OR kasbank_terimauntuk LIKE '%".addslashes($filter)."%' OR kasbank_jenis LIKE '%".addslashes($filter)."%' OR kasbank_noref LIKE '%".addslashes($filter)."%' OR kasbank_keterangan LIKE '%".addslashes($filter)."%' OR kasbank_author LIKE '%".addslashes($filter)."%' OR kasbank_date_create LIKE '%".addslashes($filter)."%' OR kasbank_update LIKE '%".addslashes($filter)."%' OR kasbank_date_update LIKE '%".addslashes($filter)."%' OR kasbank_post LIKE '%".addslashes($filter)."%' OR kasbank_date_post LIKE '%".addslashes($filter)."%' OR kasbank_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($kasbank_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_id LIKE '%".$kasbank_id."%'";
				};
				if($kasbank_tanggal!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_tanggal LIKE '%".$kasbank_tanggal."%'";
				};
				if($kasbank_nobukti!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_nobukti LIKE '%".$kasbank_nobukti."%'";
				};
				if($kasbank_akun!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_akun LIKE '%".$kasbank_akun."%'";
				};
				if($kasbank_terimauntuk!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_terimauntuk LIKE '%".$kasbank_terimauntuk."%'";
				};
				if($kasbank_jenis!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_jenis LIKE '%".$kasbank_jenis."%'";
				};
				if($kasbank_noref!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_noref LIKE '%".$kasbank_noref."%'";
				};
				if($kasbank_keterangan!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_keterangan LIKE '%".$kasbank_keterangan."%'";
				};
				if($kasbank_author!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_author LIKE '%".$kasbank_author."%'";
				};
				if($kasbank_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_date_create LIKE '%".$kasbank_date_create."%'";
				};
				if($kasbank_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_update LIKE '%".$kasbank_update."%'";
				};
				if($kasbank_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_date_update LIKE '%".$kasbank_date_update."%'";
				};
				if($kasbank_post!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_post LIKE '%".$kasbank_post."%'";
				};
				if($kasbank_date_post!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_date_post LIKE '%".$kasbank_date_post."%'";
				};
				if($kasbank_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_revised LIKE '%".$kasbank_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>