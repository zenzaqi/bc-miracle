<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_paket.php
 	+ Author  		: masongbee
 	+ Created on 28/Jan/2010 10:41:22
	
*/

class M_master_ambil_paket extends Model{
		
		//constructor
		function M_master_ambil_paket() {
			parent::Model();
		}
		
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			$order_by="";
			$group_by="";
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal";$group_by=" GROUP BY tanggal";break;
				case "Customer": $order_by=" ORDER BY cust_id";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti";break;
				case "Paket": $order_by=" ORDER BY paket_kode";break;
				case "Perawatan": $order_by=" ORDER BY rawat_id";break;
				case "Perawatan Medis": $order_by="AND kategori_nama = 'Medis' ORDER BY rawat_id";break;
				case "Perawatan Non Medis": $order_by="AND kategori_nama = 'Non Medis' ORDER BY rawat_id";break;
				case "Perawatan Anti Aging": $order_by="AND kategori_nama = 'Anti Aging' ORDER BY rawat_id";break;
				case "Perawatan Surgery": $order_by="AND kategori_nama = 'Surgery' ORDER BY rawat_id";break;
				case "Perawatan Lain-Lain": $order_by="AND kategori_nama <> 'Medis' AND kategori_nama <> 'Non Medis' AND kategori_nama <> 'Surgery' AND kategori_nama <> 'Anti Aging' ORDER BY rawat_id";break;
				case "Pemakai": $order_by=" ORDER BY pemakai_nama";break;
				case "Referal": $order_by=" ORDER BY referal";break;
				default: $order_by=" ORDER BY no_bukti";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT no_bukti,tanggal,paket_nama,paket_kode,cust_id,cust_nama,cust_no,dapaket_paket,dapaket_jumlah as jumlah, harga_satuan FROM vu_detail_ambil_paket_rawat WHERE jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup'".$order_by;
				else if($periode=='bulan')
					$sql="SELECT no_bukti,tanggal,paket_nama,paket_kode,cust_id,cust_nama,cust_no,dapaket_paket,dapaket_jumlah as jumlah, harga_satuan FROM vu_detail_ambil_paket_rawat WHERE jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND  date_format(tanggal, '%Y-%m')='".$tgl_awal."' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT no_bukti,tanggal,paket_nama,paket_kode,cust_id,cust_nama,cust_no,dapaket_paket,dapaket_jumlah as jumlah, harga_satuan FROM vu_detail_ambil_paket_rawat WHERE jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND date_format(tanggal, '%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal, '%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_ambil_paket_rawat WHERE jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_ambil_paket_rawat WHERE jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND  date_format(tanggal, '%Y-%m')='".$tgl_awal."' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT distinct * FROM vu_detail_ambil_paket_rawat WHERE jpaket_stat_dok='Tertutup' AND dapaket_stat_dok='Tertutup' AND date_format(tanggal, '%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal, '%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}
			
			//echo $sql;
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
	/* UPDATE db.detail_jual_paket.dpaket_sisa_paket */
	function total_sisa_paket_update($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket){
		$sql_sisa_paket = "UPDATE detail_jual_paket
			LEFT JOIN paket ON(dpaket_paket=paket_id)
			LEFT JOIN vu_total_ambil_paket ON(vu_total_ambil_paket.dapaket_dpaket=dpaket_id 
				AND vu_total_ambil_paket.dapaket_jpaket=detail_jual_paket.dpaket_master
				AND vu_total_ambil_paket.dapaket_paket=detail_jual_paket.dpaket_paket)
			SET dpaket_sisa_paket=((dpaket_jumlah*paket_jmlisi)- IF(isnull(vu_total_ambil_paket.total_ambil_paket),0,vu_total_ambil_paket.total_ambil_paket))
			WHERE detail_jual_paket.dpaket_id='$dapaket_dpaket'
				AND detail_jual_paket.dpaket_master='$dapaket_jpaket'
				AND detail_jual_paket.dpaket_paket='$dapaket_paket'";
		$this->db->query($sql_sisa_paket);
		if($this->db->affected_rows()){
			return 1;
		}else{
			return 0;
		}
		
	}
		
		function get_referal_list($query){
			$sql=  "SELECT 
						karyawan_id,karyawan_nama,karyawan_username
					FROM karyawan 
					INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) 
					WHERE karyawan_aktif='Aktif' AND (jabatan_nama='Dokter' OR jabatan_nama='Therapist' OR jabatan_nama='Staff')";
			if($query<>"" && is_numeric($query)==false){
			$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql .= " (karyawan_username LIKE '%".addslashes($query)."%')";
			}
		
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
		
		function get_paket_list($query,$start,$end){
			/*$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_paket="SELECT distinct(dpaket_paket) FROM detail_jual_paket WHERE dpaket_master='$query'";
				$rs=$this->db->query($sql_paket);
				$rs_rows=$rs->num_rows();
			}*/
			
			$sql="SELECT paket_id, paket_kode, group_nama, paket_nama FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE kategori.kategori_jenis='paket' AND paket_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (paket_kode LIKE '%".addslashes($query)."%' OR paket_nama LIKE '%".addslashes($query)."%' ) ";
			}/*else{
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$query)? " OR ":" AND ";
					foreach($rs->result() as $row_paket){
						
						$filter.="OR paket_id='".$row_paket->dpaket_paket."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}
			}*/
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}
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
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah FROM customer WHERE cust_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (cust_nama like '%".$query."%' ) ";
			}
			
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}
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
		
		function get_pengguna_paket_list($dpaket_master){
			$query = "SELECT cust_id, cust_nama, cust_no, cust_tgllahir, cust_alamat, cust_telprumah FROM pengguna_paket LEFT JOIN customer ON(ppaket_cust=cust_id) LEFT JOIN master_jual_paket ON(ppaket_master=jpaket_id AND ppaket_cust=jpaket_cust) WHERE ppaket_master='$dpaket_master'";
			
			//$query2 = "SELECT cust_id, cust_nama, cust_no, cust_tgllahir, cust_alamat, cust_telprumah FROM pengguna_paket LEFT JOIN customer ON(ppaket_cust=cust_id) LEFT JOIN master_jual_paket ON(ppaket_master=jpaket_id AND ppaket_cust<>jpaket_cust) WHERE ppaket_master='$jpaket_id'";
			//echo $query."<br />";
			//echo $query2;
			
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			//$result2 = $this->db->query($query2);
			//$nbrows2 = $result2->num_rows();
			
			//$nbrows=0;
			//$nbrows2=0;
			
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				/*if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($result2->result() as $row2){
						$arr[] = $row2;
					}
				}
				$nbrows=$nbrows+$nbrows2;*/
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		function get_history_ambil_paket($dapaket_dpaket,$start,$end){
			/* Ambil dari db.detail_ambil_paket */
			/*$query_backup_byhendri =   "SELECT 
							pr.rawat_nama, 
							d.dapaket_jumlah, 
							c.cust_nama,
							date_format(d.tgl_ambil, '%Y-%m-%d') as tgl_ambil
						FROM detail_ambil_paket d
						LEFT JOIN submaster_apaket_item s ON ( d.dapaket_sapaket= s.sapaket_id ) 
						LEFT JOIN perawatan pr ON ( s.sapaket_item = pr.rawat_id ) 
						LEFT JOIN customer c ON ( d.dapaket_cust = c.cust_id )
						WHERE dapaket_master='$apaket_id'
						ORDER BY tgl_ambil"; //by hendri*/
			
			//$query = "SELECT date_format(dapaket_date_create, '%Y-%m-%d') AS tgl_ambil, rawat_nama, dapaket_jumlah, cust_nama FROM detail_ambil_paket LEFT JOIN master_ambil_paket ON(dapaket_master=apaket_id) LEFT JOIN perawatan ON(apaket_item=rawat_id) LEFT JOIN customer ON(dapaket_cust=cust_id) WHERE apaket_jpaket='$dpaket_master' AND apaket_paket='$dpaket_paket' ORDER BY dapaket_date_create";
			
			/*$query = "SELECT dapaket_id
					,date_format(dapaket_date_create, '%Y-%m-%d') AS tgl_ambil
					,rawat_nama
					,dapaket_jumlah
					,cust_nama
					,IF((isnull(terapis.karyawan_username) AND isnull(dokter.karyawan_username)),referal.karyawan_username,IF((dtrawat_petugas1=0),IF((dtrawat_petugas2=0),NULL,terapis.karyawan_username),dokter.karyawan_username)) AS referal
					,dapaket_stat_dok
				FROM detail_ambil_paket
				LEFT JOIN perawatan ON(dapaket_item=rawat_id)
				LEFT JOIN customer ON(dapaket_cust=cust_id)
				LEFT JOIN tindakan_detail ON(dapaket_dtrawat=dtrawat_id)
				LEFT JOIN karyawan AS dokter ON(dtrawat_petugas1=dokter.karyawan_id)
                LEFT JOIN karyawan AS terapis ON(dtrawat_petugas2=terapis.karyawan_id)
				LEFT JOIN karyawan AS referal ON(dapaket_referal=referal.karyawan_id)
				WHERE dapaket_dpaket='$dapaket_dpaket'
				ORDER BY dapaket_date_create DESC";*/
			$query = "SELECT dapaket_id
					,dapaket_tgl_ambil AS tgl_ambil
					,rawat_nama
					,dapaket_jumlah
					,cust_nama
					,dapaket_keterangan
					,IF((isnull(terapis.karyawan_username) AND isnull(dokter.karyawan_username)),referal.karyawan_username,IF((dtrawat_petugas1=0),IF((dtrawat_petugas2=0),NULL,terapis.karyawan_username),dokter.karyawan_username)) AS referal
					,dapaket_stat_dok
				FROM detail_ambil_paket
				LEFT JOIN perawatan ON(dapaket_item=rawat_id)
				LEFT JOIN customer ON(dapaket_cust=cust_id)
				LEFT JOIN tindakan_detail ON(dapaket_dtrawat=dtrawat_id)
				LEFT JOIN karyawan AS dokter ON(dtrawat_petugas1=dokter.karyawan_id)
                LEFT JOIN karyawan AS terapis ON(dtrawat_petugas2=terapis.karyawan_id)
				LEFT JOIN karyawan AS referal ON(dapaket_referal=referal.karyawan_id)
				WHERE dapaket_dpaket='$dapaket_dpaket'
				ORDER BY dapaket_tgl_ambil DESC";
			
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
		
		function get_daftar_pemakai_paket($dpaket_master,$start,$end){
			$query = "select customer.cust_nama, customer.cust_alamat, customer.cust_no, customer.cust_id
						from pengguna_paket
						left join detail_jual_paket on (detail_jual_paket.dpaket_master = pengguna_paket.ppaket_master)
						left join customer on (customer.cust_id = pengguna_paket.ppaket_cust)
					where ppaket_master = '$dpaket_master'
					group by customer.cust_nama";
			
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

		//Ambil Perawatan berdasarkan db.paket_isi_perawatan.rpaket_perawatan yang dihasilkan dari (db.paket_isi_perawatan.rpaket_master = paket.paket_id)
		function get_isi_rawat_list($dapaket_dpaket,$dapaket_jpaket,$dapaket_paket,$start,$end){
			$rs_rows=0;
			if(is_numeric($dapaket_dpaket)==true AND is_numeric($dapaket_jpaket)==true AND is_numeric($dapaket_paket)==true){
				/*$sql_rpaket="SELECT distinct(rpaket_perawatan) FROM paket_isi_perawatan WHERE rpaket_master='$paket_id'";
				$rs=$this->db->query($sql_rpaket);
				$rs_rows=$rs->num_rows();*/
				
				//$sql_backup_20100404 = "SELECT sapaket_id, rawat_id,rawat_kode,rawat_nama,sapaket_sisa_item FROM submaster_apaket_item LEFT JOIN perawatan ON(sapaket_item=rawat_id) WHERE sapaket_jenis_item='perawatan' AND sapaket_master='$apaket_id' AND (rawat_aktif='Aktif' OR rawat_aktif='Tidak Aktif')";
				
				/*if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$paket_id)? " OR ":" AND ";
					foreach($rs->result() as $row_rpaket){
						
						$filter.="OR rpaket_perawatan='".$row_rpaket->rpaket_perawatan."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}*/
				
				//$sql_backup20100405="SELECT apaket_id, rawat_id, rawat_kode, rawat_nama, apaket_sisa_item FROM master_ambil_paket LEFT JOIN perawatan ON(apaket_item=rawat_id) WHERE apaket_jpaket='$apaket_jpaket' AND apaket_paket='$apaket_paket'";
				$sql="SELECT rawat_id, rawat_kode, rawat_nama FROM paket_isi_perawatan LEFT JOIN paket ON(rpaket_master=paket_id) LEFT JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE rpaket_master='$dapaket_paket'";
				
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
		
		//function for detail
		//get record list
		function detail_ambil_paket_isi_perawatan_list($master_id,$query,$start,$end) {
			$query = "SELECT rpaket_id,rpaket_perawatan,rpaket_jumlah FROM paket_isi_perawatan WHERE rpaket_master='".$master_id."'";
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
			$query = "SELECT max(paket_id) as master_id from paket";
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
		function detail_ambil_paket_isi_perawatan_purge($master_id){
			$sql="DELETE from paket_isi_perawatan where rpaket_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		
		//insert detail record
		function detail_ambil_paket_isi_perawatan_insert($dapaket_dpaket
														 ,$dapaket_jpaket
														 ,$dapaket_paket
														 ,$dapaket_item
														 ,$dapaket_jumlah
														 ,$dapaket_cust
														 ,$tgl_ambil
														 ,$keterangan
														 ,$dapaket_referal
														 ,$count
														 ,$dcount){
			$nilai_return='0';
			//* Check apakah sisa_item dari $dapaket_item tsb masih memiliki sisa ? /
			$sql_punya_paket="SELECT (dpaket_jumlah*rpaket_jumlah) AS rpaket_jumlah
					,dpaket_id
					,dpaket_master
					,dpaket_paket
					,dpaket_sisa_paket
				FROM paket_isi_perawatan
					LEFT JOIN detail_jual_paket ON(rpaket_master=dpaket_paket)
					LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id)
				WHERE dpaket_id='$dapaket_dpaket'
					AND rpaket_perawatan='$dapaket_item'";
			$rs_punya_paket=$this->db->query($sql_punya_paket);
			if($rs_punya_paket->num_rows()){
				$punya_paket_rows = $rs_punya_paket->num_rows();
				
				$i=0;
				foreach($rs_punya_paket->result() as $row_punya_paket){
					$i++;
					$sql_paket_terpakai="SELECT sum(dapaket_jumlah) AS total_item_terpakai
						FROM detail_ambil_paket
						WHERE dapaket_dpaket='$row_punya_paket->dpaket_id'
							AND dapaket_stat_dok<>'Batal'
						GROUP BY dapaket_dpaket";
					$rs_paket_terpakai=$this->db->query($sql_paket_terpakai);
					if($rs_paket_terpakai->num_rows()){
						$record_paket_terpakai = $rs_paket_terpakai->row();
						if((($row_punya_paket->rpaket_jumlah > $record_paket_terpakai->total_item_terpakai) && ($row_punya_paket->dpaket_sisa_paket >= $dapaket_jumlah)) || (($row_punya_paket->rpaket_jumlah==0) && ($row_punya_paket->dpaket_sisa_paket >= $dapaket_jumlah))){
							//return $row_punya_paket;
							//* INSERT ke db.detail_ambil_paket sebagai History Pengambilan Paket /
							$dti_dapaket=array(
							"dapaket_dpaket"=>$dapaket_dpaket,
							"dapaket_jpaket"=>$dapaket_jpaket,
							"dapaket_paket"=>$dapaket_paket,
							"dapaket_item"=>$dapaket_item,
							"dapaket_jenis_item"=>'perawatan',
							"dapaket_jumlah"=>$dapaket_jumlah,
							"dapaket_cust"=>$dapaket_cust,
							"dapaket_creator"=>@$_SESSION[SESSION_USERID],
							"dapaket_tgl_ambil"=>$tgl_ambil,
							"dapaket_referal"=>$dapaket_referal,
							"dapaket_keterangan"=>$keterangan
							);
							$this->db->insert('detail_ambil_paket', $dti_dapaket);
							
							if($this->db->affected_rows()){
								//* UPDATE db.detail_jual_paket.dpaket_sisa_paket ==> sisa paket dari paket yang dibeli akan diupdate akibat dari pengambilan paket /
								$dpaket_sisa_update = $this->total_sisa_paket_update($dapaket_dpaket ,$dapaket_jpaket ,$dapaket_paket);
								if($dpaket_sisa_update==1){
									$nilai_return='1';
									break;
								}else{
									$nilai_return='0';
									break;
								}
								
							}else{
								$nilai_return='0';
								break;
							}
						}else{
							if($i==$punya_paket_rows){
								$nilai_return='0';
								break;
							}
						}
						
					}else{
					
					if(($row_punya_paket->dpaket_sisa_paket >= $dapaket_jumlah) || (($row_punya_paket->rpaket_jumlah==0) && ($row_punya_paket->dpaket_sisa_paket >= $dapaket_jumlah)))
					{
						//return $row_punya_paket;
						//* INSERT ke db.detail_ambil_paket sebagai History Pengambilan Paket /
						$dti_dapaket=array(
						"dapaket_dpaket"=>$dapaket_dpaket,
						"dapaket_jpaket"=>$dapaket_jpaket,
						"dapaket_paket"=>$dapaket_paket,
						"dapaket_item"=>$dapaket_item,
						"dapaket_jenis_item"=>'perawatan',
						"dapaket_jumlah"=>$dapaket_jumlah,
						"dapaket_cust"=>$dapaket_cust,
						"dapaket_creator"=>@$_SESSION[SESSION_USERID],
						"dapaket_tgl_ambil"=>$tgl_ambil,
						"dapaket_referal"=>$dapaket_referal,
						"dapaket_keterangan"=>$keterangan
						);
						$this->db->insert('detail_ambil_paket', $dti_dapaket);
						
						if($this->db->affected_rows()){
							//* UPDATE db.detail_jual_paket.dpaket_sisa_paket ==> sisa paket dari paket yang dibeli akan diupdate akibat dari pengambilan paket /
							$dpaket_sisa_update = $this->total_sisa_paket_update($dapaket_dpaket ,$dapaket_jpaket ,$dapaket_paket);
							if($dpaket_sisa_update==1){
								$nilai_return='1';
								break;
							}else{
								$nilai_return='0';
								break;
							}
							
						}else{
							$nilai_return='0';
							break;
						}
						
						
					}
					else 
					{
						$nilai_return='0';
						break;
					}

					}
				}
				if($count==($dcount-1)){
					return $nilai_return;
				}
			}else{
				return '-1';
			}

		}
		//end of function
		
		//function for get list record
		function ambil_paket_list($filter,$start,$end){
			/* Untuk menampilkan ke View.LIST = {Customer, No.Faktur Penjualan Paket, Tanggal Pembelian, Tanggal Expired Paket, Nama Paket } */
			//$query = "SELECT customer.cust_id, customer.cust_nama, customer.cust_no, master_jual_paket.jpaket_id, master_jual_paket.jpaket_nobukti, master_jual_paket.jpaket_tanggal, detail_jual_paket.dpaket_id, detail_jual_paket.dpaket_kadaluarsa, paket.paket_id, paket.paket_nama, paket.paket_kode, master_ambil_paket.apaket_sisa_paket, master_ambil_paket.apaket_id FROM master_ambil_paket INNER JOIN detail_jual_paket ON(dpaket_id=apaket_dpaket) LEFT JOIN master_jual_paket ON(jpaket_id=dpaket_master) LEFT JOIN customer ON(cust_id=jpaket_cust) LEFT JOIN paket ON(paket_id=dpaket_paket)";
			//$query = "SELECT * FROM vu_kasir_ambil_paket_list";
			/*$query =   "SELECT
							apaket_id, apaket_jpaket, apaket_faktur, apaket_faktur_tanggal, apaket_kadaluarsa, apaket_cust, 
							apaket_paket, 
							apaket_paket_jumlah, apaket_sisa_paket ,
							c.cust_no, c.cust_nama, p.paket_kode, p.paket_nama
						FROM master_ambil_paket m
						LEFT OUTER JOIN customer c on c.cust_id = m.apaket_cust
						LEFT OUTER JOIN paket p on p.paket_id = m.apaket_paket
						WHERE apaket_sisa_paket >= 0 AND apaket_faktur_tanggal >= '2007-01-01'"; //by hendri*/
			$query = "SELECT dpaket_master
					,dpaket_paket
					,cust_id
					,cust_no
					,cust_nama
					,jpaket_tanggal
					,jpaket_nobukti
					,paket_kode
					,paket_nama
					,dpaket_id
					,dpaket_jumlah
					,dpaket_sisa_paket
					,dpaket_kadaluarsa 
				FROM detail_jual_paket 
				LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) 
				LEFT JOIN customer ON(jpaket_cust=cust_id) 
				LEFT JOIN paket ON(dpaket_paket=paket_id) 
				WHERE dpaket_sisa_paket > 0
					AND date_add(date_format(dpaket_kadaluarsa,'%Y-%m-%d'), interval 365 day) >= date_format(now(),'%Y-%m-%d')
					AND jpaket_stat_dok='Tertutup' ";

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%'
					OR cust_no LIKE '%".addslashes($filter)."%'
					OR paket_kode LIKE '%".addslashes($filter)."%'
					OR paket_nama LIKE '%".addslashes($filter)."%'
					OR jpaket_nobukti LIKE '%".addslashes($filter)."%')";
			}

			$query .= " ORDER BY jpaket_nobukti DESC";
			
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
		function ambil_paket_update($paket_id ,$paket_kode ,$paket_nama ,$paket_expired ){
			/* Check di db.master_ambil_paket apakah No.Faktur Penjualan Paket && Paket_ID telah ada di db.master_ambil_paket ? */
			/*$data = array(
				"paket_id"=>$paket_id, 
				"paket_kode"=>$paket_kode, 
				"paket_nama"=>$paket_nama, 
				"paket_expired"=>$paket_expired
			);
			$this->db->where('paket_id', $paket_id);
			$this->db->update('paket', $data);*/
			
			return '1';
		}
		
		//function for create new record
		function ambil_paket_create($paket_kode ,$paket_nama ,$paket_expired ){
			$data = array(
				"paket_kode"=>$paket_kode, 
				"paket_nama"=>$paket_nama, 
				"paket_expired"=>$paket_expired
			);
			$this->db->insert('paket', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function ambil_paket_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the pakets at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM paket WHERE paket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "paket_id= ".$pkid[$i];
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

		
		
		/* Pengecekan Dokumen untuk membatalkan paket yang sudah terambil*/ 
		function pengecekan_dokumen_untuk_batal($tanggal_pengecekan){
			
		$date = date('Y-m-d');
			//$date_1 = '01';
			//$date_2 = '02';
			$date_3 = '03';
			$month = substr($tanggal_pengecekan[0],5,2);
			$year = substr($tanggal_pengecekan[0],0,4);
			$begin=mktime(0,0,0,$month,1,$year);
			$nextmonth=strtotime("+1month",$begin);
			
			$month_next = substr(date("Y-m-d",$nextmonth),5,2);
			$year_next = substr(date("Y-m-d",$nextmonth),0,4);
			
			//$tanggal_1 = $year_next.'-'.$month_next.'-'.$date_1;
			//$tanggal_2 = $year_next.'-'.$month_next.'-'.$date_2;
			$tanggal_3 = $year_next.'-'.$month_next.'-'.$date_3;
            $datetime_now = date('Y-m-d H:i:s');
     
			if ($date <= $tanggal_3 || $tanggal_pengecekan[0] == $date)
			{
				return '1';
			}
			else
			{
				return '0';
			}
		
		}
		
		function ambil_paket_status_adj($dapaket_id){
			$sql = "SELECT dapaket_dpaket ,dapaket_jpaket ,dapaket_paket FROM detail_ambil_paket WHERE dapaket_id='".$dapaket_id[0]."'";
			$rs = $this->db->query($sql);
			$datetime_now = date('Y-m-d H:i:s');
			
			if($rs->num_rows()){
				$record = $rs->row_array();
				$dapaket_dpaket = $record['dapaket_dpaket'];
				$dapaket_jpaket = $record['dapaket_jpaket'];
				$dapaket_paket = $record['dapaket_paket'];
				
				//Mengubah status pengambilan paket menjadi Adj/
				if (sizeof($dapaket_id) == 1){
					$query = "UPDATE detail_ambil_paket 
								SET dapaket_stat_dok='Adj',
									dapaket_date_update='".$datetime_now."',
									dapaket_update='".@$_SESSION[SESSION_USERID]."',
									dapaket_revised=(dapaket_revised+1)
						WHERE dapaket_id = ".$dapaket_id[0];
					$this->db->query($query);
					if($this->db->affected_rows()>0){
						$dpaket_sisa_update = $this->total_sisa_paket_update($dapaket_dpaket ,$dapaket_jpaket ,$dapaket_paket);
						if($dpaket_sisa_update==1){
							return '1';
						}else{
							return '0';
						}
					}
					else
						return '0';
				
				}
			
				else{
					return '0';
				}
			}
			else{
				return '0';
			}
			
				
				
		}

	
		function ambil_paket_batal($dapaket_id){
			$sql = "SELECT dapaket_dpaket ,dapaket_jpaket ,dapaket_paket FROM detail_ambil_paket WHERE dapaket_id='".$dapaket_id[0]."'";
			$rs = $this->db->query($sql);
			$datetime_now = date('Y-m-d H:i:s');

			if($rs->num_rows()){
				$record = $rs->row_array();
				$dapaket_dpaket = $record['dapaket_dpaket'];
				$dapaket_jpaket = $record['dapaket_jpaket'];
				$dapaket_paket = $record['dapaket_paket'];
				
				//Membatalkan satu pengambilan paket /
				if (sizeof($dapaket_id) == 1){
					$query = "UPDATE detail_ambil_paket 
								SET dapaket_stat_dok='Batal',
									dapaket_date_update='".$datetime_now."',
									dapaket_update='".@$_SESSION[SESSION_USERID]."',
									dapaket_revised=(dapaket_revised+1)
						WHERE dapaket_id = ".$dapaket_id[0];
						//DATE_ADD(date_format(dapaket_date_create, '%Y-%m-%d'),INTERVAL 40 DAY)>date_format(now(), '%Y-%m-%d') 
					$this->db->query($query);
					if($this->db->affected_rows()>0){
						$dpaket_sisa_update = $this->total_sisa_paket_update($dapaket_dpaket ,$dapaket_jpaket ,$dapaket_paket);
						if($dpaket_sisa_update==1){
							return '1';
						}else{
							return '0';
						}
						
					}else
						return '0';
				}else{
					return '0';
				}
			}else{
				return '0';
			}
			
		}
		
		//function for advanced search record
		function ambil_paket_search($apaket_faktur, $apaket_cust, $apaket_paket, $apaket_kadaluarsa, $apaket_kadaluarsa_akhir, $apaket_tgl_faktur, $apaket_tgl_faktur_akhir, $apaket_sisa, $start, $end){
			//full query
			//$query="select * from paket";
			//$query = "SELECT apaket_id, apaket_jpaket, apaket_faktur, apaket_faktur_tanggal, apaket_kadaluarsa, apaket_cust, apaket_cust_no, apaket_cust_nama, apaket_paket, apaket_paket_kode, apaket_paket_nama, apaket_paket_jumlah, apaket_sisa_paket FROM master_ambil_paket";
//			$query =   "SELECT 
//							apaket_id, apaket_jpaket, apaket_faktur, apaket_faktur_tanggal, apaket_kadaluarsa, apaket_cust, 
//							/*apaket_cust_no, apaket_cust_nama, */ 
//							apaket_paket, 
//							/*apaket_paket_kode, apaket_paket_nama, */ 
//							apaket_paket_jumlah, apaket_sisa_paket , 
//							c.cust_no, c.cust_nama, p.paket_kode, p.paket_nama 
//						FROM master_ambil_paket m 
//						LEFT OUTER JOIN customer c on c.cust_id = m.apaket_cust 
//						LEFT OUTER JOIN paket p on p.paket_id = m.apaket_paket ";

			$query =   "SELECT 
							dpaket_master, dpaket_paket, 
							cust_id, cust_no, cust_nama, 
							jpaket_tanggal, jpaket_nobukti, 
							paket_kode, paket_nama, 
							dpaket_id, dpaket_jumlah, dpaket_sisa_paket, dpaket_kadaluarsa 
						FROM detail_jual_paket 
						LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) 
						LEFT JOIN customer ON(jpaket_cust=cust_id) 
						LEFT JOIN paket ON(dpaket_paket=paket_id)
						WHERE jpaket_stat_dok='Tertutup'";
			
			if($apaket_faktur!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				//$query.= " apaket_faktur LIKE '%".$apaket_faktur."%'";
				$query.= " jpaket_nobukti LIKE '%".$apaket_faktur."%'";
			};
			if($apaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				//$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
				$query.= " cust_id = '".$apaket_cust."'";
			};
			if($apaket_paket!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				//$query.= " apaket_paket LIKE '%".$apaket_paket."%'";
				$query.= " paket_id = '".$apaket_paket."'";
			};
			
			if($apaket_sisa=='1'){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " detail_jual_paket.dpaket_sisa_paket > 0 ";	
			};
			
			if($apaket_sisa=='0'){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " detail_jual_paket.dpaket_sisa_paket >= 0 ";	
			};
			
			if($apaket_sisa=='Sisa 0'){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " detail_jual_paket.dpaket_sisa_paket = 0 ";	
			};
			
			
			if($apaket_kadaluarsa!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				//$query.= " date_format(apaket_kadaluarsa,'%Y-%m-%d')='$apaket_kadaluarsa'";
				$query.= " date_format(dpaket_kadaluarsa,'%Y-%m-%d') >= '$apaket_kadaluarsa'";
			};
			if($apaket_kadaluarsa_akhir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " date_format(dpaket_kadaluarsa,'%Y-%m-%d') <= '$apaket_kadaluarsa_akhir'";
			};
			if($apaket_tgl_faktur!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " date_format(jpaket_tanggal,'%Y-%m-%d') >= '$apaket_tgl_faktur'";
			};
			if($apaket_tgl_faktur_akhir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " date_format(jpaket_tanggal,'%Y-%m-%d') <= '$apaket_tgl_faktur_akhir'";
			};
			
			$query .= " ORDER BY jpaket_nobukti DESC";

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
		function ambil_paket_print($apaket_faktur
									,$apaket_cust
									,$apaket_paket
									,$apaket_kadaluarsa
									,$apaket_kadaluarsa_akhir
									,$apaket_tgl_faktur
									,$apaket_tgl_faktur_akhir
									,$apaket_sisa
									,$option
									,$filter){
			//full query
			if($option=='LIST'){
				$query = "SELECT cust_no AS no_cust
						,cust_nama AS customer
						,jpaket_tanggal AS tanggal_faktur
						,jpaket_nobukti AS no_faktur
						,paket_kode AS kode_paket
						,paket_nama AS nama_paket
						,dpaket_sisa_paket AS sisa
						,dpaket_kadaluarsa AS tgl_kadaluarsa
					FROM detail_jual_paket 
					LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) 
					LEFT JOIN customer ON(jpaket_cust=cust_id) 
					LEFT JOIN paket ON(dpaket_paket=paket_id) 
					WHERE dpaket_sisa_paket >= 0
						AND date_add(date_format(dpaket_kadaluarsa,'%Y-%m-%d'), interval 365 day) >= date_format(now(),'%Y-%m-%d')
						AND jpaket_stat_dok='Tertutup' ";
						
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR jpaket_nobukti LIKE '%".addslashes($filter)."%')";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				$query = "SELECT cust_no AS no_cust
						,cust_nama AS customer
						,jpaket_tanggal AS tanggal_faktur
						,jpaket_nobukti AS no_faktur
						,paket_kode AS kode_paket
						,paket_nama AS nama_paket
						,dpaket_sisa_paket AS sisa
						,dpaket_kadaluarsa AS tgl_kadaluarsa
					FROM detail_jual_paket 
					LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) 
					LEFT JOIN customer ON(jpaket_cust=cust_id) 
					LEFT JOIN paket ON(dpaket_paket=paket_id)
					WHERE jpaket_stat_dok='Tertutup'";
					
				if($apaket_faktur!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " apaket_faktur LIKE '%".$apaket_faktur."%'";
					$query.= " jpaket_nobukti LIKE '%".$apaket_faktur."%'";
				};
				if($apaket_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
					$query.= " cust_id = '".$apaket_cust."'";
				};
				if($apaket_paket!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " apaket_paket LIKE '%".$apaket_paket."%'";
					$query.= " paket_id = '".$apaket_paket."'";
				};
				
				if($apaket_sisa=='1'){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " detail_jual_paket.dpaket_sisa_paket > 0 ";	
				};
				
				if($apaket_sisa=='0'){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " detail_jual_paket.dpaket_sisa_paket >= 0 ";	
				};
				
				if($apaket_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " date_format(apaket_kadaluarsa,'%Y-%m-%d')='$apaket_kadaluarsa'";
					$query.= " date_format(dpaket_kadaluarsa,'%Y-%m-%d') >= '$apaket_kadaluarsa'";
				};
				if($apaket_kadaluarsa_akhir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " date_format(dpaket_kadaluarsa,'%Y-%m-%d') <= '$apaket_kadaluarsa_akhir'";
				};
				if($apaket_tgl_faktur!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " date_format(jpaket_tanggal,'%Y-%m-%d') >= '$apaket_tgl_faktur'";
				};
				if($apaket_tgl_faktur_akhir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " date_format(jpaket_tanggal,'%Y-%m-%d') <= '$apaket_tgl_faktur_akhir'";
				};
				$result = $this->db->query($query);
			}
			return $result->result();
		}
		
		//function  for export to excel
		function ambil_paket_export_excel($apaket_faktur
										,$apaket_cust
										,$apaket_paket
										,$apaket_kadaluarsa
										,$apaket_kadaluarsa_akhir
										,$apaket_tgl_faktur
										,$apaket_tgl_faktur_akhir
										,$apaket_sisa
										,$option
										,$filter){
			//full query
			if($option=='LIST'){
				$query = "SELECT cust_no AS no_cust
						,cust_nama AS customer
						,jpaket_tanggal AS tanggal_faktur
						,jpaket_nobukti AS no_faktur
						,paket_kode AS kode_paket
						,paket_nama AS nama_paket
						,dpaket_sisa_paket AS sisa
						,dpaket_kadaluarsa AS tgl_kadaluarsa
					FROM detail_jual_paket 
					LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) 
					LEFT JOIN customer ON(jpaket_cust=cust_id) 
					LEFT JOIN paket ON(dpaket_paket=paket_id) 
					WHERE dpaket_sisa_paket >= 0
						AND date_add(date_format(dpaket_kadaluarsa,'%Y-%m-%d'), interval 365 day) >= date_format(now(),'%Y-%m-%d')
						AND jpaket_stat_dok='Tertutup' ";
						
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR jpaket_nobukti LIKE '%".addslashes($filter)."%')";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				$query = "SELECT cust_no AS no_cust
						,cust_nama AS customer
						,jpaket_tanggal AS tanggal_faktur
						,jpaket_nobukti AS no_faktur
						,paket_kode AS kode_paket
						,paket_nama AS nama_paket
						,dpaket_sisa_paket AS sisa
						,dpaket_kadaluarsa AS tgl_kadaluarsa
					FROM detail_jual_paket 
					LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) 
					LEFT JOIN customer ON(jpaket_cust=cust_id) 
					LEFT JOIN paket ON(dpaket_paket=paket_id)
					WHERE jpaket_stat_dok='Tertutup'";
					
				if($apaket_faktur!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " apaket_faktur LIKE '%".$apaket_faktur."%'";
					$query.= " jpaket_nobukti LIKE '%".$apaket_faktur."%'";
				};
				if($apaket_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
					$query.= " cust_id = '".$apaket_cust."'";
				};
				if($apaket_paket!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " apaket_paket LIKE '%".$apaket_paket."%'";
					$query.= " paket_id = '".$apaket_paket."'";
				};
				
				if($apaket_sisa=='1'){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " detail_jual_paket.dpaket_sisa_paket > 0 ";	
				};
				
				if($apaket_sisa=='0'){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " detail_jual_paket.dpaket_sisa_paket >= 0 ";	
				};
				
				if($apaket_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					//$query.= " date_format(apaket_kadaluarsa,'%Y-%m-%d')='$apaket_kadaluarsa'";
					$query.= " date_format(dpaket_kadaluarsa,'%Y-%m-%d') >= '$apaket_kadaluarsa'";
				};
				if($apaket_kadaluarsa_akhir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " date_format(dpaket_kadaluarsa,'%Y-%m-%d') <= '$apaket_kadaluarsa_akhir'";
				};
				if($apaket_tgl_faktur!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " date_format(jpaket_tanggal,'%Y-%m-%d') >= '$apaket_tgl_faktur'";
				};
				if($apaket_tgl_faktur_akhir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " date_format(jpaket_tanggal,'%Y-%m-%d') <= '$apaket_tgl_faktur_akhir'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>