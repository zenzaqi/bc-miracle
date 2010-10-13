<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: kasbank Model
	+ Description	: For record model process back-end
	+ Filename 		: c_kasbank.php
 	+ Author  		: Zainal
 	+ Created on 12/Mar/2010 10:45:40
	
*/

class M_Kasbank extends Model{
		
		//constructor
		function M_Kasbank() {
			parent::Model();
		}
		
		function kasbank_reopen($kasbank_id){
			$sqlupdate="UPDATE kasbank SET kasbank_post='T' WHERE kasbank_id='".$kasbank_id."'";
			$result = $this->db->query($sqlupdate);
			if($result){
				$sqlselect="SELECT kasbank_nobukti FROM kasbank WHERE kasbank_id='".$kasbank_id."'";
				$result = $this->db->query($sqlselect);
				if($result->num_rows()){
						$rowbank=$result->row();
						$sqldelete="DELETE FROM buku_besar WHERE buku_ref='".$rowbank->kasbank_nobukti."'";
						$result = $this->db->query($sqldelete);	
						if($result){
							return '1';
						}else
							return '0';
				}else{
					return '0';
				}
			}else{
				return '0';
			}
		}
		
		
		function get_detail_akun($task,$master_id,$selected_id,$filter,$start,$end){
			$sql = "SELECT A.* from akun A,akun_map M
					WHERE A.akun_kode not in (
					SELECT B.akun_parent_kode FROM akun B WHERE B.akun_parent_kode is NOT NULL)";
			if($task=='detail'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .=" A.akun_id IN (SELECT dkasbank_akun FROM kasbank_detail WHERE dkasbank_master='".$master_id."')";
				
				$result = $this->db->query($sql);
				$nbrows = $result->num_rows();
			
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
					$jsonresult = json_encode($arr);
					return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
				} else {
					return '({"total":"0", "results":""})';
				}
			
			}else if($task=='selected'){
				if($selected_id!=="")
				{
					$selected_id=substr($selected_id,0,strlen($selected_id)-1);
					$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." A.akun_id IN(".$selected_id.")";
				}
				
				$result = $this->db->query($sql);
				$nbrows = $result->num_rows();
				
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
					$jsonresult = json_encode($arr);
					return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
				} else {
					return '({"total":"0", "results":""})';
				}
			
			}else{

				if ($filter<>""){
						$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
						$sql .= " (A.akun_kode LIKE '%".addslashes($filter)."%' OR 
								   A.akun_nama LIKE '%".addslashes($filter)."%' OR 
								   A.akun_jenis LIKE '%".addslashes($filter)."%')";
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
			
			
		}
		
		function get_akun_kasbank($filter,$start,$limit){
			
			$sql="select A.* from akun A,akun_map M
				WHERE A.akun_kode not in (
				SELECT B.akun_parent_kode FROM akun B WHERE B.akun_parent_kode is NOT NULL)
				AND A.akun_kode LIKE concat('%', M.map_akun_kode,'%')";
			if($filter!==""){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .=" (A,akun_kode like '%".$filter."%' OR  A.akun_nama like '%".$filter."%')";
			}
			$sql.=" ORDER By A.akun_kode ASC ";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$limit = $sql." LIMIT ".$start.",".$limit;			
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
		
		//function for detail
		//get record list
		function detail_kasbank_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM kasbank_detail where dkasbank_master='".$master_id."'";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
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
		
		
		//insert detail record
		function detail_kasbank_detail_insert($dkasbank_id ,$dkasbank_master ,$dkasbank_akun ,$dkasbank_detail ,$dkasbank_debet ,$dkasbank_kredit ){
				
			$query="";
		   	for($i = 0; $i < sizeof($dkasbank_akun); $i++){

				$data = array(
					"dkasbank_master"=>$dkasbank_master, 
					"dkasbank_akun"=>$dkasbank_akun[$i], 
					"dkasbank_detail"=>$dkasbank_detail[$i], 
					"dkasbank_debet"=>$dkasbank_debet[$i], 
					"dkasbank_kredit"=>$dkasbank_kredit[$i] 
				);
				
								
				if($dkasbank_id[$i]==0){
					$this->db->insert('kasbank_detail', $data); 
					
					$query = $query.$this->db->insert_id();
					if($i<sizeof($dkasbank_id)-1){
						$query = $query . ",";
					} 
					
				}else{
					$query = $query.$dkasbank_id[$i];
					if($i<sizeof($dkasbank_id)-1){
						$query = $query . ",";
					} 
					$this->db->where('dorder_id', $dkasbank_id[$i]);
					$this->db->update('kasbank_detail', $data);
				}
			}
			
			if($query<>""){
				$sql="DELETE FROM kasbank_detail WHERE  dkasbank_master='".$dkasbank_master."' AND
						dkasbank_id NOT IN (".$query.")";
				$this->db->query($sql);
			}
			
			return '1';

		}
		//end of function
		
		//function for get list record
		function kasbank_list($filter,$start,$end,$where_jenis){
			/*$where = "WHERE `kasbank`.`kasbank_jenis` = '".$where_jenis."'";*/
			$query = "SELECT * FROM vu_kasbank WHERE kasbank_jenis='".$where_jenis."'";

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kasbank_tanggal LIKE '%".addslashes($filter)."%' OR 
							 kasbank_nobukti LIKE '%".addslashes($filter)."%' OR 
							 kasbank_terimauntuk LIKE '%".addslashes($filter)."%' OR 
							 kasbank_noref LIKE '%".addslashes($filter)."%' OR 
							 akun_nama LIKE '%".addslashes($filter)."%' OR
							 akun_kode LIKE '%".addslashes($filter)."%' OR
							 kasbank_keterangan LIKE '%".addslashes($filter)."%' )";
			}
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			if($end=="") $end=15;
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
		function kasbank_create($kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,
									  $kasbank_terimauntuk ,$kasbank_jenis ,$kasbank_noref ,
									  $kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,
									  $kasbank_post, $kasbank_date_post ){
			$data = array(
				"kasbank_tanggal"=>$kasbank_tanggal, 
				"kasbank_nobukti"=>$kasbank_nobukti, 
				"kasbank_akun"=>$kasbank_akun, 
				"kasbank_terimauntuk"=>$kasbank_terimauntuk, 
				"kasbank_jenis"=>$kasbank_jenis, 
				"kasbank_noref"=>$kasbank_noref, 
				"kasbank_keterangan"=>$kasbank_keterangan, 
				"kasbank_author"=>$kasbank_author,
				"kasbank_date_create"=>$kasbank_date_create
			);
			
			
			
			$sql="SELECT kasbank_nobukti FROM kasbank WHERE kasbank_nobukti='".$kasbank_nobukti."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				return 'ER:No Jurnal sudah digunakan !';
			}else{
				$this->db->insert('kasbank', $data); 
				if($this->db->affected_rows())
					return 'OK:'.$this->db->insert_id();
				else
					return 'ER:Gagal disimpan digunakan !';
			}
			
				
		}
		
		//function for update record
		function kasbank_update($kasbank_id,$kasbank_tanggal,$kasbank_nobukti,$kasbank_akun,$kasbank_terimauntuk,
									  $kasbank_jenis,$kasbank_noref,$kasbank_keterangan,$kasbank_update,$kasbank_date_update,
									  $kasbank_post,$kasbank_date_post){
			$data = array(
				"kasbank_tanggal"=>$kasbank_tanggal, 
				"kasbank_nobukti"=>$kasbank_nobukti, 
				"kasbank_terimauntuk"=>$kasbank_terimauntuk, 
				"kasbank_jenis"=>$kasbank_jenis, 
				"kasbank_noref"=>$kasbank_noref, 
				"kasbank_keterangan"=>$kasbank_keterangan, 
				"kasbank_update"=>$kasbank_update, 
				"kasbank_date_update"=>$kasbank_date_update
			);
			
						
			$sql="SELECT akun_id FROM akun where akun_id='".$kasbank_akun."'";
			$rsA=$this->db->query($sql);
			if($rsA->num_rows()){
				$data["kasbank_akun"]=$kasbank_akun;
			}
			
			$sql="SELECT kasbank_nobukti FROM kasbank WHERE kasbank_nobukti='".$kasbank_nobukti."' AND kasbank_id<>'".$kasbank_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				return 'ER:No Jurnal sudah digunakan !';
			}else{
				$this->db->where('kasbank_id', $kasbank_id);
				$this->db->update('kasbank', $data);
				if($this->db->affected_rows()){
					$sql="UPDATE kasbank set kasbank_revised=(kasbank_revised+1) where kasbank_id='".$kasbank_id."'";
					$this->db->query($sql);
					return 'OK:'.$kasbank_id;
				}else
					return 'ER:Gagal disimpan!';
			}
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
		function kasbank_search($kasbank_id ,$kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,
									  $kasbank_jenis ,$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,
									  $kasbank_update ,$kasbank_date_update ,$kasbank_post ,$kasbank_date_post ,$kasbank_revised ,$start,$end){
			//full query
			$query = "SELECT * FROM vu_t_kasbank WHERE kasbank_jenis='".$kasbank_jenis."'";
			
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

			if($kasbank_noref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_noref LIKE '%".$kasbank_noref."%'";
			};
			if($kasbank_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kasbank_keterangan LIKE '%".$kasbank_keterangan."%'";
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
		function kasbank_print($kasbank_id ,$kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,
									 $kasbank_jenis ,$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,$kasbank_update ,
									 $kasbank_date_update ,$kasbank_post ,$kasbank_date_post ,$kasbank_revised ,$option,$filter){
			//full query
			$sql = "SELECT * FROM vu_t_kasbank WHERE kasbank_jenis='".$kasbank_jenis."'";
			
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (kasbank_tanggal LIKE '%".addslashes($filter)."%' OR 
						   kasbank_nobukti LIKE '%".addslashes($filter)."%' OR 
						   akun_kode LIKE '%".addslashes($filter)."%' OR 
						   kasbank_terimauntuk LIKE '%".addslashes($filter)."%' OR 
						   akun_nama LIKE '%".addslashes($filter)."%' OR 
						   kasbank_noref LIKE '%".addslashes($filter)."%' OR 
						   kasbank_keterangan LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){

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
				if($kasbank_noref!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_noref LIKE '%".$kasbank_noref."%'";
				};
				if($kasbank_keterangan!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " kasbank_keterangan LIKE '%".$kasbank_keterangan."%'";
				};
				/*if($kasbank_author!=''){
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
				};*/
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function kasbank_export_excel($kasbank_id ,$kasbank_tanggal ,$kasbank_nobukti ,$kasbank_akun ,$kasbank_terimauntuk ,$kasbank_jenis ,
											$kasbank_noref ,$kasbank_keterangan ,$kasbank_author ,$kasbank_date_create ,$kasbank_update ,
											$kasbank_date_update ,$kasbank_post ,$kasbank_date_post ,$kasbank_revised ,$option,$filter){
			//full query
			$sql  = "SELECT * FROM vu_t_kasbank WHERE kasbank_jenis='".$kasbank_jenis."'";
			
			if($option=='LIST'){
				$sql .= " (kasbank_tanggal LIKE '%".addslashes($filter)."%' OR 
						   kasbank_nobukti LIKE '%".addslashes($filter)."%' OR 
						   akun_kode LIKE '%".addslashes($filter)."%' OR 
						   kasbank_terimauntuk LIKE '%".addslashes($filter)."%' OR 
						   akun_nama LIKE '%".addslashes($filter)."%' OR 
						   kasbank_noref LIKE '%".addslashes($filter)."%' OR 
						   kasbank_keterangan LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){

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
				if($kasbank_noref!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_noref LIKE '%".$kasbank_noref."%'";
				};
				if($kasbank_keterangan!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " kasbank_keterangan LIKE '%".$kasbank_keterangan."%'";
				};
				/*if($kasbank_author!=''){
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
				};*/
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>