<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_lunas_piutang Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_lunas_piutang.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:05
	
*/

class M_master_lunas_piutang extends Model{
		
		//constructor
		function M_master_lunas_piutang() {
			parent::Model();
		}
		
		function detail_lunas_piutang_list($lpiutang_id){
			$sql="SELECT dpiutang_id, dpiutang_nobukti, date_format(dpiutang_tanggal,'%Y-%m-%d') AS dpiutang_tanggal, dpiutang_nilai FROM detail_lunas_piutang WHERE dpiutang_master='$lpiutang_id'";
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
		}
		
		function get_faktur_jual_list_bycust($cust_id){
			$sql="SELECT lpiutang_id, lpiutang_faktur, lpiutang_faktur_tanggal, lpiutang_total, lpiutang_sisa FROM master_lunas_piutang WHERE lpiutang_sisa>0";
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
		}
		
		function get_customer_list($query,$start,$end){
			/* GET Customer yang masih memiliki hutang */
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah FROM customer LEFT JOIN master_lunas_piutang ON(lpiutang_cust=cust_id) WHERE cust_aktif='Aktif' AND lpiutang_sisa>0";
			if($query<>""){
				$sql=$sql." and (cust_no like '%".$query."%' or cust_nama like '%".$query."%' or cust_telprumah like '%".$query."%' or cust_telprumah2 like '%".$query."%' or cust_telpkantor like '%".$query."%' or cust_hp like '%".$query."%' or cust_hp2 like '%".$query."%' or cust_hp3 like '%".$query."%') ";
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
		
		function form_bayar_piutang_list($cust_id) {
			$query = "SELECT * FROM master_lunas_piutang WHERE lpiutang_cust='".$cust_id."' AND lpiutang_sisa>0";
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
		
		//function for detail
		//get record list
		function detail_detail_lunas_piutang_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_lunas_piutang where dpiutang_master='".$master_id."'";
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
		//end of function
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(lpiutang_id) as master_id from master_lunas_piutang";
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
		
		function get_nofaktur_lunas_piutang() {
			$query = "SELECT max(fpiutang_nobukti) as fpiutang_nobukti FROM master_faktur_lunas_piutang";
			$result = $this->db->query($query);
			if($result->num_rows()){
				$data=$result->row();
				$fpiutang_nobukti=$data->fpiutang_nobukti;
				return $fpiutang_nobukti;
			}else{
				return '0';
			}
		}
		
		//purge all detail from master
		function detail_detail_lunas_piutang_purge($master_id){
			$sql="DELETE from detail_lunas_piutang where dpiutang_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		function sisa_piutang_update($dpiutang_master){
			$sql="SELECT (lpiutang_total - IF((sum(dpiutang_nilai))!='null',(sum(dpiutang_nilai)),0)) AS total_sisa_piutang FROM detail_lunas_piutang LEFT JOIN master_lunas_piutang ON(dpiutang_master=lpiutang_id) WHERE dpiutang_master='$dpiutang_master' GROUP BY dpiutang_master";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$lpiutang_sisa=$rs_record["total_sisa_piutang"];
				
				$dtu_lpiutang=array(
				"lpiutang_sisa"=>$lpiutang_sisa
				);
				$this->db->where('lpiutang_id', $dpiutang_master);
				$this->db->update('master_lunas_piutang', $dtu_lpiutang);
			}
		}
		
		//insert record bayar
		function form_bayar_piutang_insert($dpiutang_master ,$dpiutang_nilai ,$dpiutang_cara ,$dpiutang_tunai_nilai ,$dpiutang_card_nama ,$dpiutang_card_edc ,$dpiutang_card_no ,$dpiutang_card_nilai ,$dpiutang_cek_nama ,$dpiutang_cek_no ,$dpiutang_cek_valid ,$dpiutang_cek_bank ,$dpiutang_cek_nilai ,$dpiutang_transfer_bank ,$dpiutang_transfer_nama ,$dpiutang_transfer_nilai ,$dpiutang_nobukti, $count, $dcount){
			//$pattern="LP/".date("ym")."-";
			//$dpiutang_nobukti=$this->m_public_function->get_kode_1('detail_lunas_piutang','dpiutang_nobukti',$pattern,12);
			//$dpiutang_nobukti=$this->get_nofaktur_lunas_piutang();
			
			$this->firephp->log($dpiutang_nilai, 'dpiutang_nilai');
			if($dpiutang_nilai>0 && $dpiutang_nilai<>''){
				$data = array(
				"dpiutang_master"=>$dpiutang_master, 
				"dpiutang_nobukti"=>$dpiutang_nobukti, 
				"dpiutang_nilai"=>$dpiutang_nilai,
				"dpiutang_cara"=>$dpiutang_cara
				);
				$this->db->insert('detail_lunas_piutang', $data); 
				if($this->db->affected_rows()){
					$this->sisa_piutang_update($dpiutang_master);
					
					if($dpiutang_cara!=null || $dpiutang_cara!=''){
						if($dpiutang_cara=='card'){
							
							$data=array(
								"jcard_nama"=>$dpiutang_card_nama,
								"jcard_edc"=>$dpiutang_card_edc,
								"jcard_no"=>$dpiutang_card_no,
								"jcard_nilai"=>$dpiutang_nilai,
								"jcard_ref"=>$dpiutang_nobukti
								);
							$this->db->insert('jual_card', $data); 
						
						}else if($dpiutang_cara=='cek/giro'){
							
							/*if($dpiutang_cek_nama=="" || $dpiutang_cek_nama==NULL){
								if(is_int($dpiutang_cek_nama)){
									$sql="select cust_nama from customer where cust_id='".$dpiutang_cust."'";
									$query=$this->db->query($sql);
									if($query->num_rows()){
										$data=$query->row();
										$dpiutang_cek_nama=$data->cust_nama;
									}
								}else{
										$dpiutang_cek_nama=$dpiutang_cust;
								}
							}*/
							$data=array(
								"jcek_nama"=>$dpiutang_cek_nama,
								"jcek_no"=>$dpiutang_cek_no,
								"jcek_valid"=>$dpiutang_cek_valid,
								"jcek_bank"=>$dpiutang_cek_bank,
								"jcek_nilai"=>$dpiutang_nilai,
								"jcek_ref"=>$dpiutang_nobukti
								);
							$this->db->insert('jual_cek', $data); 
						}else if($dpiutang_cara=='transfer'){
							
							$data=array(
								"jtransfer_bank"=>$dpiutang_transfer_bank,
								"jtransfer_nama"=>$dpiutang_transfer_nama,
								"jtransfer_nilai"=>$dpiutang_nilai,
								"jtransfer_ref"=>$dpiutang_nobukti
								);
							$this->db->insert('jual_transfer', $data); 
						}else if($dpiutang_cara=='tunai'){
							
							$data=array(
								"jtunai_nilai"=>$dpiutang_nilai,
								"jtunai_ref"=>$dpiutang_nobukti
								);
							$this->db->insert('jual_tunai', $data); 
						}
					}
					if($count==($dcount-1)){
						return '1';
					}else{
						return '0';
					}
				}else
					return '-1';
			}

		}
		//end of function
		
		//insert detail record
		function detail_detail_lunas_piutang_insert($dpiutang_id ,$dpiutang_master ,$dpiutang_nohutang ,$dpiutang_nilai ){
			//if master id not capture from view then capture it from max pk from master table
			if($dpiutang_master=="" || $dpiutang_master==NULL){
				$dpiutang_master=$this->get_master_id();
			}
			
			$data = array(
				"dpiutang_master"=>$dpiutang_master, 
				"dpiutang_nohutang"=>$dpiutang_nohutang, 
				"dpiutang_nilai"=>$dpiutang_nilai 
			);
			$this->db->insert('detail_lunas_piutang', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_lunas_piutang_list($filter,$start,$end){
			$query = "SELECT * FROM master_lunas_piutang LEFT JOIN customer ON(lpiutang_cust=cust_id)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_id LIKE '%".addslashes($filter)."%' OR lpiutang_nobukti LIKE '%".addslashes($filter)."%' OR lpiutang_cust LIKE '%".addslashes($filter)."%' OR lpiutang_tanggal LIKE '%".addslashes($filter)."%' OR lpiutang_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_lunas_piutang_update($lpiutang_id ,$lpiutang_nobukti ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$piutang_cara){
			/*$data = array(
				"lpiutang_id"=>$lpiutang_id, 
				"lpiutang_nobukti"=>$lpiutang_nobukti, 
				"lpiutang_cust"=>$lpiutang_cust, 
				"lpiutang_tanggal"=>$lpiutang_tanggal, 
				"lpiutang_keterangan"=>$lpiutang_keterangan 
			);
			$this->db->where('lpiutang_id', $lpiutang_id);
			$this->db->update('master_lunas_piutang', $data);*/
			/*$pattern="LP/".date("ym")."-";
			$fpiutang_nobukti=$this->m_public_function->get_kode_1('master_faktur_lunas_piutang','fpiutang_nobukti',$pattern,12);
			
			$fpiutang_creator=$_SESSION[SESSION_USERID];
			$dti_fpiutang=array(
			"fpiutang_nobukti"=>$fpiutang_nobukti,
			"fpiutang_cara"=>$piutang_cara,
			"fpiutang_creator"=>$fpiutang_creator
			);
			$this->db->insert('master_faktur_lunas_piutang', $dti_fpiutang);*/
			$dpiutang_nobukti='';
			$pattern="LP/".date("ym")."-";
			$dpiutang_nobukti=$this->m_public_function->get_kode_1('detail_lunas_piutang','dpiutang_nobukti',$pattern,12);
			
			return $dpiutang_nobukti;
		}
		
		//function for create new record
		function master_lunas_piutang_create($lpiutang_nobukti ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ){
			$data = array(
				"lpiutang_nobukti"=>$lpiutang_nobukti, 
				"lpiutang_cust"=>$lpiutang_cust, 
				"lpiutang_tanggal"=>$lpiutang_tanggal, 
				"lpiutang_keterangan"=>$lpiutang_keterangan 
			);
			$this->db->insert('master_lunas_piutang', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_lunas_piutang_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_lunas_piutangs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_lunas_piutang WHERE lpiutang_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_lunas_piutang WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "lpiutang_id= ".$pkid[$i];
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
		function master_lunas_piutang_search($lpiutang_id ,$lpiutang_nobukti ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$start,$end){
			//full query
			$query="select * from master_lunas_piutang";
			
			if($lpiutang_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_id LIKE '%".$lpiutang_id."%'";
			};
			if($lpiutang_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_nobukti LIKE '%".$lpiutang_nobukti."%'";
			};
			if($lpiutang_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_cust LIKE '%".$lpiutang_cust."%'";
			};
			if($lpiutang_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_tanggal LIKE '%".$lpiutang_tanggal."%'";
			};
			if($lpiutang_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_keterangan LIKE '%".$lpiutang_keterangan."%'";
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
		function master_lunas_piutang_print($lpiutang_id ,$lpiutang_nobukti ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$option,$filter){
			//full query
			$query="select * from master_lunas_piutang";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_id LIKE '%".addslashes($filter)."%' OR lpiutang_nobukti LIKE '%".addslashes($filter)."%' OR lpiutang_cust LIKE '%".addslashes($filter)."%' OR lpiutang_tanggal LIKE '%".addslashes($filter)."%' OR lpiutang_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($lpiutang_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_id LIKE '%".$lpiutang_id."%'";
				};
				if($lpiutang_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_nobukti LIKE '%".$lpiutang_nobukti."%'";
				};
				if($lpiutang_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_cust LIKE '%".$lpiutang_cust."%'";
				};
				if($lpiutang_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_tanggal LIKE '%".$lpiutang_tanggal."%'";
				};
				if($lpiutang_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_keterangan LIKE '%".$lpiutang_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_lunas_piutang_export_excel($lpiutang_id ,$lpiutang_nobukti ,$lpiutang_cust ,$lpiutang_tanggal ,$lpiutang_keterangan ,$option,$filter){
			//full query
			$query="select * from master_lunas_piutang";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_id LIKE '%".addslashes($filter)."%' OR lpiutang_nobukti LIKE '%".addslashes($filter)."%' OR lpiutang_cust LIKE '%".addslashes($filter)."%' OR lpiutang_tanggal LIKE '%".addslashes($filter)."%' OR lpiutang_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($lpiutang_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_id LIKE '%".$lpiutang_id."%'";
				};
				if($lpiutang_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_nobukti LIKE '%".$lpiutang_nobukti."%'";
				};
				if($lpiutang_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_cust LIKE '%".$lpiutang_cust."%'";
				};
				if($lpiutang_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_tanggal LIKE '%".$lpiutang_tanggal."%'";
				};
				if($lpiutang_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_keterangan LIKE '%".$lpiutang_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		function print_paper($dpiutang_nobukti){
			$sql="SELECT lpiutang_faktur, date_format(dpiutang_tanggal, 'Y-m-d') AS dpiutang_tanggal, cust_nama, cust_no, cust_alamat, dpiutang_cara, dpiutang_nobukti, dpiutang_nilai FROM detail_lunas_piutang LEFT JOIN master_lunas_piutang ON(dpiutang_master=lpiutang_id) LEFT JOIN customer ON(lpiutang_cust=cust_id) WHERE dpiutang_nobukti='$dpiutang_nobukti'";
			$result = $this->db->query($sql);
			return $result;
		}
		
}
?>