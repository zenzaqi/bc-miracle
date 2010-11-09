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
		
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal ASC";break;
				case "Customer": $order_by=" ORDER BY cust_id ASC";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti ASC";break;
				default: $order_by=" ORDER BY no_bukti ASC";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT * FROM vu_trans_piutang WHERE lpiutang_stat_dok<>'Batal' ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_piutang WHERE lpiutang_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m')='".$tgl_awal."' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_piutang WHERE lpiutang_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_lunas_piutang WHERE lpiutang_stat_dok<>'Batal' ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_lunas_piutang WHERE lpiutang_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m')='".$tgl_awal."' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_lunas_piutang WHERE lpiutang_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}
			//echo $sql;
			
			$query=$this->db->query($sql);
			return $query->result();
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
		function form_bayar_piutang_insert($array_dpiutang_master ,$array_dpiutang_nilai ,$dpiutang_cara ,$dpiutang_card_nama ,$dpiutang_card_edc ,$dpiutang_card_no ,$dpiutang_cek_nama ,$dpiutang_cek_no ,$dpiutang_cek_valid ,$dpiutang_cek_bank ,$dpiutang_transfer_bank ,$dpiutang_transfer_nama ,$dpiutang_nobukti){
			//$pattern="LP/".date("ym")."-";
			//$dpiutang_nobukti=$this->m_public_function->get_kode_1('detail_lunas_piutang','dpiutang_nobukti',$pattern,12);
			//$dpiutang_nobukti=$this->get_nofaktur_lunas_piutang();
			$bayar_date_create = date('Y-m-d H:i:s');
			$jenis_transaksi = 'jual_lunas';
			$cetak = 1;
			
			$size_array = sizeof($array_dpiutang_nilai) - 1;
			
			for($i = 0; $i < sizeof($array_dpiutang_nilai); $i++){
				$dpiutang_master = $array_dpiutang_master[$i];
				$dpiutang_nilai = $array_dpiutang_nilai[$i];
				
				$data = array(
				"dpiutang_master"=>$dpiutang_master, 
				"dpiutang_nobukti"=>$dpiutang_nobukti, 
				"dpiutang_nilai"=>$dpiutang_nilai,
				"dpiutang_cara"=>$dpiutang_cara
				);
				$this->db->insert('detail_lunas_piutang', $data); 
				if($this->db->affected_rows()){
					$this->sisa_piutang_update($dpiutang_master);
					
					$sql="delete from jual_kwitansi where jkwitansi_ref='".$dpiutang_nobukti."'";
					$this->db->query($sql);
					if($this->db->affected_rows()>-1){
						$sql="delete from jual_card where jcard_ref='".$dpiutang_nobukti."'";
						$this->db->query($sql);
						if($this->db->affected_rows()>-1){
							$sql="delete from jual_cek where jcek_ref='".$dpiutang_nobukti."'";
							$this->db->query($sql);
							if($this->db->affected_rows()>-1){
								$sql="delete from jual_transfer where jtransfer_ref='".$dpiutang_nobukti."'";
								$this->db->query($sql);
								if($this->db->affected_rows()>-1){
									$sql="delete from jual_tunai where jtunai_ref='".$dpiutang_nobukti."'";
									$this->db->query($sql);
									if($this->db->affected_rows()>-1){
										if($dpiutang_cara!=null || $dpiutang_cara!=''){
											/*if($dpiutang_kwitansi_nilai<>'' && $dpiutang_kwitansi_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_kwitansi_insert($dpiutang_kwitansi_no
																								  ,$dpiutang_kwitansi_nilai
																								  ,$dpiutang_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}else*/if($dpiutang_cara=='card'){
												$result_bayar = $this->m_public_function->cara_bayar_card_insert($dpiutang_card_nama
																							  ,$dpiutang_card_edc
																							  ,$dpiutang_card_no
																							  ,$dpiutang_nilai
																							  ,$dpiutang_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($dpiutang_cara=='cek/giro'){
												$result_bayar = $this->m_public_function->cara_bayar_cek_insert($dpiutang_cek_nama
																							 ,$dpiutang_cek_no
																							 ,$dpiutang_cek_valid
																							 ,$dpiutang_cek_bank
																							 ,$dpiutang_nilai
																							 ,$dpiutang_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($dpiutang_cara=='transfer'){
												$result_bayar = $this->m_public_function->cara_bayar_transfer_insert($dpiutang_transfer_bank
																								  ,$dpiutang_transfer_nama
																								  ,$dpiutang_nilai
																								  ,$dpiutang_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($dpiutang_cara=='tunai'){
												$result_bayar = $this->m_public_function->cara_bayar_tunai_insert($dpiutang_nilai
																							   ,$dpiutang_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}
											
										}
									}
								}
							}
						}
					}
					
					if($i==$size_array){
						return '1';
					}
				}else{
					if($i==$size_array){
						return '-1';
					}
				}
			}
			
		}
		//end of function
		
		//function for get list record
		function master_lunas_piutang_list($filter,$start,$end){
			$query = "SELECT master_lunas_piutang.lpiutang_id
					,master_lunas_piutang.lpiutang_faktur
					,master_lunas_piutang.lpiutang_cust
					,master_lunas_piutang.lpiutang_faktur_tanggal
					,master_lunas_piutang.lpiutang_total
					,master_lunas_piutang.lpiutang_sisa
					,master_lunas_piutang.lpiutang_keterangan
					,master_lunas_piutang.lpiutang_status
					,master_lunas_piutang.lpiutang_stat_dok
					,customer.cust_nama
				FROM master_lunas_piutang
					LEFT JOIN customer ON(lpiutang_cust=cust_id)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_faktur LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' )";
			}
			$query .= " ORDER BY customer.cust_nama";
			
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
		function master_lunas_piutang_update($lpiutang_id ,$lpiutang_faktur ,$lpiutang_cust ,$lpiutang_faktur_tanggal ,$lpiutang_keterangan ,$piutang_cara){
			/*$data = array(
				"lpiutang_id"=>$lpiutang_id, 
				"lpiutang_faktur"=>$lpiutang_faktur, 
				"lpiutang_cust"=>$lpiutang_cust, 
				"lpiutang_faktur_tanggal"=>$lpiutang_faktur_tanggal, 
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
		function master_lunas_piutang_create($lpiutang_faktur ,$lpiutang_cust ,$lpiutang_faktur_tanggal ,$lpiutang_keterangan ){
			$data = array(
				"lpiutang_faktur"=>$lpiutang_faktur, 
				"lpiutang_cust"=>$lpiutang_cust, 
				"lpiutang_faktur_tanggal"=>$lpiutang_faktur_tanggal, 
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
		function master_lunas_piutang_search($lpiutang_faktur_jual, $lpiutang_cust ,$lpiutang_faktur_tgl_start ,$lpiutang_faktur_tgl_akhir ,$lpiutang_status ,$lpiutang_stat_dok ,$start,$end){
			//full query
			$query="SELECT master_lunas_piutang.lpiutang_id
					,master_lunas_piutang.lpiutang_faktur
					,master_lunas_piutang.lpiutang_cust
					,master_lunas_piutang.lpiutang_faktur_tanggal
					,master_lunas_piutang.lpiutang_total
					,master_lunas_piutang.lpiutang_sisa
					,master_lunas_piutang.lpiutang_keterangan
					,master_lunas_piutang.lpiutang_status
					,master_lunas_piutang.lpiutang_stat_dok
					,customer.cust_nama
				FROM master_lunas_piutang
					LEFT JOIN customer ON(lpiutang_cust=cust_id)";
			
			if($lpiutang_faktur_jual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_faktur LIKE '%".$lpiutang_faktur_jual."%'";
			};
			if($lpiutang_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_cust = '".$lpiutang_cust."'";
			};
			if($lpiutang_faktur_tgl_start<>'' && $lpiutang_faktur_tgl_akhir==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_faktur_tanggal = '".$lpiutang_faktur_tgl_start."'";
			};
			if($lpiutang_faktur_tgl_start<>'' && $lpiutang_faktur_tgl_akhir<>''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_faktur_tanggal BETWEEN '".$lpiutang_faktur_tgl_start."' AND '".$lpiutang_faktur_tgl_akhir."'";
			};
			if($lpiutang_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_status LIKE '%".$lpiutang_status."%'";
			};
			if($lpiutang_stat_dok!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " lpiutang_stat_dok LIKE '%".$lpiutang_stat_dok."%'";
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
		function master_lunas_piutang_print($lpiutang_faktur_jual
											,$lpiutang_cust
											,$lpiutang_faktur_tgl_start
											,$lpiutang_faktur_tgl_akhir
											,$lpiutang_status
											,$lpiutang_stat_dok
											,$option
											,$filter){
			//full query
			$query="SELECT master_lunas_piutang.lpiutang_faktur
					,master_lunas_piutang.lpiutang_cust
					,master_lunas_piutang.lpiutang_faktur_tanggal
					,master_lunas_piutang.lpiutang_total
					,master_lunas_piutang.lpiutang_sisa
					,master_lunas_piutang.lpiutang_keterangan
					,master_lunas_piutang.lpiutang_status
					,master_lunas_piutang.lpiutang_stat_dok
					,customer.cust_nama
				FROM master_lunas_piutang
					LEFT JOIN customer ON(lpiutang_cust=cust_id)";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_faktur LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' )";
				$query .= " ORDER BY customer.cust_nama";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($lpiutang_faktur_jual!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_faktur LIKE '%".$lpiutang_faktur_jual."%'";
				};
				if($lpiutang_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_cust = '".$lpiutang_cust."'";
				};
				if($lpiutang_faktur_tgl_start<>'' && $lpiutang_faktur_tgl_akhir==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_faktur_tanggal = '".$lpiutang_faktur_tgl_start."'";
				};
				if($lpiutang_faktur_tgl_start<>'' && $lpiutang_faktur_tgl_akhir<>''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_faktur_tanggal BETWEEN '".$lpiutang_faktur_tgl_start."' AND '".$lpiutang_faktur_tgl_akhir."'";
				};
				if($lpiutang_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_status LIKE '%".$lpiutang_status."%'";
				};
				if($lpiutang_stat_dok!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_stat_dok LIKE '%".$lpiutang_stat_dok."%'";
				};
				$query .= " ORDER BY customer.cust_nama";
				$result = $this->db->query($query);
			}
			return $result->result();
		}
		
		//function  for export to excel
		function master_lunas_piutang_export_excel($lpiutang_faktur_jual
													,$lpiutang_cust
													,$lpiutang_faktur_tgl_start
													,$lpiutang_faktur_tgl_akhir
													,$lpiutang_status
													,$lpiutang_stat_dok
													,$option
													,$filter){
			//full query
			$query="SELECT customer.cust_nama AS customer
					,master_lunas_piutang.lpiutang_faktur AS no_faktur_jual
					,master_lunas_piutang.lpiutang_faktur_tanggal AS tgl_faktur_jual
					,master_lunas_piutang.lpiutang_total AS total_piutang
					,master_lunas_piutang.lpiutang_sisa AS sisa_piutang
					,master_lunas_piutang.lpiutang_keterangan AS keterangan
					,master_lunas_piutang.lpiutang_status AS status
					,master_lunas_piutang.lpiutang_stat_dok AS stat_dok
				FROM master_lunas_piutang
					LEFT JOIN customer ON(lpiutang_cust=cust_id)";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (lpiutang_faktur LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' )";
				$query .= " ORDER BY customer.cust_nama";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($lpiutang_faktur_jual!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_faktur LIKE '%".$lpiutang_faktur_jual."%'";
				};
				if($lpiutang_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_cust = '".$lpiutang_cust."'";
				};
				if($lpiutang_faktur_tgl_start<>'' && $lpiutang_faktur_tgl_akhir==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_faktur_tanggal = '".$lpiutang_faktur_tgl_start."'";
				};
				if($lpiutang_faktur_tgl_start<>'' && $lpiutang_faktur_tgl_akhir<>''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_faktur_tanggal BETWEEN '".$lpiutang_faktur_tgl_start."' AND '".$lpiutang_faktur_tgl_akhir."'";
				};
				if($lpiutang_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_status LIKE '%".$lpiutang_status."%'";
				};
				if($lpiutang_stat_dok!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " lpiutang_stat_dok LIKE '%".$lpiutang_stat_dok."%'";
				};
				$query .= " ORDER BY customer.cust_nama";
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