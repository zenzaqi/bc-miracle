<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: appointment Model
	+ Description	: For record model process back-end
	+ Filename 		: c_appointment.php
 	+ Author  		: masongbee
 	+ Created on 29/Oct/2009 13:33:53
	
*/

class M_appointment extends Model{
		
		//constructor
		function M_appointment() {
			parent::Model();
		}
		
		function get_dokter_list($query, $tgl_app="", $karyawan_jabatan){
			$bln_now=date('Y-m');
			//$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,reportt_jmltindakan FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) LEFT JOIN (SELECT * FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%') as rt ON(karyawan_id=rt.reportt_karyawan_id) WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,reportt_jmltindakan FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) LEFT JOIN vu_report_tindakan_dokter ON(vu_report_tindakan_dokter.dokter_id=karyawan.karyawan_id) WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif' AND ";
			if($query<>""){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (absensi_tgl='".addslashes($tgl_app)."')";
			}
			//echo $sql;
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
		
		function get_terapis_list($query, $tgl_app, $karyawan_jabatan){
			$this->db->where('absensi_shift',"");
			$this->db->delete('absensi');
			$date_now=date('Y-m-d');
			$bln_now=date('Y-m');
			if($tgl_app==""){
				$tgl_app=$date_now;
				$bln_filter=$bln_now;
			}elseif($tgl_app!=""){
				$bln_filter=date('Y-m', strtotime($tgl_app));
			}
			
			/* Mencari Terapis yang sudah memiliki Jadwal di db.absensi WHERE db.absensi.absensi_shift = 'P' */
			//$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,reportt_jmltindakan,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='P') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN (SELECT * FROM report_tindakan WHERE date_format(reportt_bln,'%Y-%m')='$bln_filter') as rt ON(karyawan_id=rt.reportt_karyawan_id) WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='P') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){ /* Query pada $sql akan di AND ab.absensi_tgl=$tgl_app Jika $tgl_app<>'' */
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (ab.absensi_tgl='".addslashes($tgl_app)."')";
			}
			$sql.=" ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
			
			$sql2="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='S') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql2 .=eregi("WHERE",$sql2)? " AND ":" WHERE ";
				$sql2 .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql2 .=eregi("WHERE",$sql2)? " AND ":" WHERE ";
				$sql2 .= " (ab.absensi_tgl='".addslashes($tgl_app)."')";
			}
			$sql2.=" ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
			
			$sql3="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='M') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql3 .=eregi("WHERE",$sql3)? " AND ":" WHERE ";
				$sql3 .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql3 .=eregi("WHERE",$sql3)? " AND ":" WHERE ";
				$sql3 .= " (ab.absensi_tgl='".addslashes($tgl_app)."')";
			}
			$sql3.=" ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
			
			$sql4="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='OFF') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql4 .=eregi("WHERE",$sql4)? " AND ":" WHERE ";
				$sql4 .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql4 .=eregi("WHERE",$sql4)? " AND ":" WHERE ";
				$sql4 .= " (ab.absensi_tgl='".addslashes($tgl_app)."')";
			}
			$sql4.=" ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
			
			$sql5="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='CT') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql5 .=eregi("WHERE",$sql5)? " AND ":" WHERE ";
				$sql5 .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql5 .=eregi("WHERE",$sql5)? " AND ":" WHERE ";
				$sql5 .= " (ab.absensi_tgl='".addslashes($tgl_app)."')";
			}
			$sql5.=" ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
			
			$sql6="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE absensi_shift='H') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql6 .=eregi("WHERE",$sql6)? " AND ":" WHERE ";
				$sql6 .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
			}
			if($tgl_app<>""){
				$tgl_app = date('Y-m-d', strtotime($tgl_app));
				$sql6 .=eregi("WHERE",$sql6)? " AND ":" WHERE ";
				$sql6 .= " (ab.absensi_tgl='".addslashes($tgl_app)."')";
			}
			$sql6.=" ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
			
			
			$query = $this->db->query($sql);
			$nbrows = $query->num_rows();
			
			$query2 = $this->db->query($sql2);
			$nbrows2 = $query2->num_rows();
			
			$query3 = $this->db->query($sql3);
			$nbrows3 = $query3->num_rows();
			
			$query4 = $this->db->query($sql4);
			$nbrows4 = $query4->num_rows();
			
			$query5 = $this->db->query($sql5);
			$nbrows5 = $query5->num_rows();
			
			$query6 = $this->db->query($sql6);
			$nbrows6 = $query6->num_rows();
			
			$nbrows7=0;
			if($nbrows==0 && $nbrows2==0 && $nbrows3==0 && $nbrows4==0){
				//$sql7="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,reportt_jmltindakan,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) LEFT JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE date_format(absensi_tgl,'%Y-%m')='$bln_filter') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN (SELECT * FROM report_tindakan WHERE date_format(reportt_bln,'%Y-%m')='$bln_filter') as rt ON(karyawan_id=rt.reportt_karyawan_id) WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif' ORDER BY reportt_jmltindakan ASC";
				$sql7="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,vu_report_tindakan_terapis.terapis_count,ab.absensi_shift FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) LEFT JOIN (SELECT absensi_karyawan_id,absensi_tgl,absensi_shift FROM absensi WHERE date_format(absensi_tgl,'%Y-%m')='$bln_filter') as ab ON(karyawan.karyawan_id=ab.absensi_karyawan_id) LEFT JOIN vu_report_tindakan_terapis ON(karyawan.karyawan_id=vu_report_tindakan_terapis.terapis_id AND vu_report_tindakan_terapis.terapis_bulan='$bln_filter') WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif' ORDER BY vu_report_tindakan_terapis.terapis_count ASC";
				/*if($query<>"" && is_numeric($query)==false){
					$sql5 .=eregi("WHERE",$sql5)? " AND ":" WHERE ";
					$sql5 .= " (karyawan_nama LIKE '%".addslashes($query)."%')";
				}*/
				$query7 = $this->db->query($sql7);
				$nbrows7 = $query7->num_rows();
			}
			
			if($nbrows>0 || $nbrows2>0 || $nbrows3>0 || $nbrows4>0 || $nbrows5>0 || $nbrows6>0 || $nbrows7>0){
				if($nbrows>0){
					foreach($query->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($query2->result() as $row2){
						$arr[] = $row2;
					}
				}
				if($nbrows3>0){
					foreach($query3->result() as $row3){
						$arr[] = $row3;
					}
				}
				if($nbrows4>0){
					foreach($query4->result() as $row4){
						$arr[] = $row4;
					}
				}
				if($nbrows5>0){
					foreach($query5->result() as $row5){
						$arr[] = $row5;
					}
				}
				if($nbrows6>0){
					foreach($query6->result() as $row6){
						$arr[] = $row6;
					}
				}
				if($nbrows7>0){
					foreach($query7->result() as $row7){
						$arr[] = $row7;
					}
				}
				$nbrows=$nbrows+$nbrows2+$nbrows3+$nbrows4+$nbrows5+$nbrows6+$nbrows7;
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for detail
		//get record list detail medis
		function detail_appointment_detail_medis_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM appointment_detail WHERE dapp_master='".$master_id."'";
			$query="SELECT * FROM appointment_detail INNER JOIN perawatan ON dapp_perawatan=rawat_id INNER JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_id='2' AND dapp_master='$master_id'";
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
		//get record list detail nonmedis
		function detail_appointment_detail_nonmedis_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM appointment_detail WHERE dapp_master='".$master_id."'";
			$query="SELECT * FROM appointment_detail INNER JOIN perawatan ON dapp_perawatan=rawat_id INNER JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_id='3' AND dapp_master='$master_id'";
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
			$query = "SELECT max(app_id) as master_id from appointment";
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
		function detail_appointment_detail_purge($master_id){
			$sql="DELETE FROM appointment_detail WHERE dapp_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_appointment_detail_medis_insert($dapp_medis_id ,$dapp_medis_master ,$dapp_medis_perawatan ,$dapp_medis_tglreservasi ,$dapp_medis_jamreservasi ,$dapp_medis_petugas ,$dapp_medis_status ,$dapp_medis_tgldatang ,$dapp_medis_jamdatang ,$dapp_medis_keterangan ,$app_cara ,$app_customer ,$app_keterangan ,$dapp_user){
			/* JIKA $dapp_medis_petugas=="" ==> diisi db.karyawan.karyawan_id WHERE username="Available dr." */
			if($dapp_medis_petugas==""){
				$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_no='99'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$dapp_medis_petugas=$rs_record["karyawan_id"];
				}
			}
			
			$sql="SELECT dapp_id FROM appointment_detail WHERE dapp_id='$dapp_medis_id'";
			$rs=$this->db->query($sql);
			if(!$rs->num_rows()){
				//if master id not capture from view then capture it from max pk from master table
				if($dapp_medis_master=="" || $dapp_medis_master==NULL){
					$dapp_medis_master=$this->get_master_id();
				}
				if($dapp_medis_status=="datang" || $dapp_medis_status=="Datang"){
					$dapp_medis_tgldatang=date('Y-m-d');
					$dapp_medis_jamdatang=date('H:i:s');
				}
				
				if($app_cara=="Datang")
					$dapp_medis_keterangan="[W] ".$dapp_medis_keterangan;
				$data = array(
					"dapp_master"=>$dapp_medis_master, 
					"dapp_perawatan"=>$dapp_medis_perawatan, 
					"dapp_tglreservasi"=>$dapp_medis_tglreservasi, 
					"dapp_jamreservasi"=>$dapp_medis_jamreservasi, 
					"dapp_petugas"=>$dapp_medis_petugas, 
	//				"dapp_petugas2"=>$dapp_medis_petugas2, 
					"dapp_status"=>$dapp_medis_status, 
					"dapp_tgldatang"=>$dapp_medis_tgldatang, 
					"dapp_jamdatang"=>$dapp_medis_jamdatang,
					"dapp_keterangan"=>$dapp_medis_keterangan,
					"dapp_creator"=>$dapp_user
				);
				$this->db->insert('appointment_detail', $data); 
				if($this->db->affected_rows()){
					/* Check dan Ambil db.appointment_detail.dapp_id yang telah "barusan" ter-input */
					$sql="SELECT dapp_id FROM appointment_detail WHERE dapp_master='$dapp_medis_master' AND dapp_perawatan='$dapp_medis_perawatan' AND dapp_tglreservasi='$dapp_medis_tglreservasi'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$dapp_id=$rs_record["dapp_id"];
					}
					/* JIKA Cara Appointment = 'Walk-in' alias 'Datang', maka INSERT ke db.tindakan atau dan db.tindakan_detail */
					if($app_cara=="Datang"){
						$date_now=date('Y-m-d');
						$time_now=date('H:i:s');
						/* INSERT ke db.tindakan dan db.tindakan_detail JIKA $dapp_status=='datang' */
						$sql="SELECT trawat_id FROM tindakan WHERE trawat_cust='$app_customer' AND trawat_date_create='$date_now'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){ /* artinya: di db.tindakan telah masuk appointment = $app_customer pada trawat_date_create(tanggal-input) = $date_now */
							$rs_record=$rs->row_array();
							$dtrawat_master=$rs_record["trawat_id"]; //ambil ID dr tabel tindakan
							//Karena di db.tindakan telah ada $app_customer && trawat_date_create='$date_now', maka HANYA INSERT to db.tindakan_detail
							$data_dtindakan=array(
							"dtrawat_master"=>$dtrawat_master,
							"dtrawat_dapp"=>$dapp_id,
							"dtrawat_perawatan"=>$dapp_medis_perawatan,
							"dtrawat_petugas1"=>$dapp_medis_petugas,
							"dtrawat_jam"=>$dapp_medis_jamreservasi,
							"dtrawat_tglapp"=>$dapp_medis_tglreservasi,
							"dtrawat_keterangan"=>$dapp_medis_keterangan,
							"dtrawat_status"=>$dapp_medis_status
							);
							$sql_cek_dtindakan="SELECT dtrawat_dapp FROM tindakan_detail WHERE dtrawat_dapp='$dapp_id'";
							$rs=$this->db->query($sql_cek_dtindakan);
							if(!$rs->num_rows()){
								$this->db->insert('tindakan_detail', $data_dtindakan);
							}
						}else{ /* artinya: di db.tindakan BELUM masuk $app_customer && trawat_date_create(tanggal-input) = $date_now */
							/* INSERT to db.tindakan */
							$data_tindakan=array(
							"trawat_cust"=>$app_customer,
							"trawat_jamdatang"=>$time_now,
							//"trawat_appointment"=>$kategori_nama,
							"trawat_keterangan"=>$app_keterangan,
							"trawat_date_create"=>$date_now
							);
							$this->db->insert('tindakan', $data_tindakan);
							
							if($this->db->affected_rows()){
								/* Telah ter-insert ke db.tindakan, maka mulai INSERT db.tindakan_detail */
								$sql="SELECT trawat_id FROM tindakan WHERE trawat_cust='$app_customer' AND trawat_date_create='$date_now'";
								$rs=$this->db->query($sql);
								if($rs->num_rows()){
									$rs_record=$rs->row_array();
									$dtrawat_master=$rs_record["trawat_id"];
								}
								$data_dtindakan=array(
								"dtrawat_master"=>$dtrawat_master,
								"dtrawat_dapp"=>$dapp_id,
								"dtrawat_perawatan"=>$dapp_medis_perawatan,
								"dtrawat_petugas1"=>$dapp_medis_petugas,
								"dtrawat_jam"=>$dapp_medis_jamreservasi,
								"dtrawat_tglapp"=>$dapp_medis_tglreservasi,
								"dtrawat_keterangan"=>$dapp_medis_keterangan,
								"dtrawat_status"=>$dapp_medis_status
								);
								$this->db->insert('tindakan_detail', $data_dtindakan);
							}
						}
						//UPDATE/INSERT ke db.report_tindakan dari Dokter && $app_cara=='datang'
						$bln_now=date('Y-m');
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dapp_medis_petugas'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $dapp_medis_petugas);
							$this->db->update('report_tindakan', $data_reportt);
						}else if(!$rs->num_rows()){
							$data_reportt=array(
							"reportt_karyawan_id"=>$dapp_medis_petugas,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}
					}
					return '1';
				}else{
					return '0';
				}
			}else{
				$sql="SELECT dapp_id FROM appointment_detail WHERE dapp_id='$dapp_medis_id' AND dapp_perawatan='$dapp_medis_perawatan' AND dapp_tglreservasi='$dapp_medis_tglreservasi' AND dapp_jamreservasi='$dapp_medis_jamreservasi' AND dapp_petugas='$dapp_medis_petugas' AND dapp_keterangan='$dapp_medis_keterangan'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows()){
					$sql="SELECT dapp_locked FROM appointment_detail WHERE dapp_id='$dapp_medis_id' AND dapp_locked=0";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$data = array(
							//"dapp_master"=>$dapp_medis_master, 
							"dapp_perawatan"=>$dapp_medis_perawatan, 
							"dapp_tglreservasi"=>$dapp_medis_tglreservasi, 
							"dapp_jamreservasi"=>$dapp_medis_jamreservasi, 
							"dapp_petugas"=>$dapp_medis_petugas, 
							"dapp_keterangan"=>$dapp_medis_keterangan,
							"dapp_creator"=>$dapp_user
						);
						$this->db->where('dapp_id', $dapp_medis_id);
						$this->db->update('appointment_detail', $data); 
					}
				}
				return '1';
			}

		}
		
		function detail_appointment_detail_nonmedis_insert($dapp_nonmedis_id ,$dapp_nonmedis_master ,$dapp_nonmedis_perawatan ,$dapp_nonmedis_tglreservasi ,$dapp_nonmedis_jamreservasi ,$dapp_nonmedis_petugas2 ,$dapp_nonmedis_status ,$dapp_nonmedis_tgldatang ,$dapp_nonmedis_jamdatang ,$dapp_nonmedis_keterangan ,$dapp_nonmedis_counter ,$app_cara ,$app_customer ,$app_keterangan ,$dapp_user){
			/* JIKA $dapp_medis_petugas=="" ==> diisi db.karyawan.karyawan_id WHERE username="Available dr." */
			if($dapp_nonmedis_petugas2==""){
				$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_no='999'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$dapp_nonmedis_petugas2=$rs_record["karyawan_id"];
				}
			}
			
			$sql="SELECT dapp_id FROM appointment_detail WHERE dapp_id='$dapp_nonmedis_id'";
			$rs=$this->db->query($sql);
			if(!$rs->num_rows()){
				//if master id not capture from view then capture it from max pk from master table
				if($dapp_nonmedis_master=="" || $dapp_nonmedis_master==NULL){
					$dapp_nonmedis_master=$this->get_master_id();
				}
				if($dapp_nonmedis_status=="datang" || $dapp_nonmedis_status=="Datang"){
					$dapp_nonmedis_tgldatang=date('Y-m-d');
					$dapp_nonmedis_jamdatang=date('H:i:s');
				}
				
				if($app_cara=="Datang")
					$dapp_nonmedis_keterangan="[W] ".$dapp_nonmedis_keterangan;
				$data = array(
					"dapp_master"=>$dapp_nonmedis_master, 
					"dapp_perawatan"=>$dapp_nonmedis_perawatan, 
					"dapp_tglreservasi"=>$dapp_nonmedis_tglreservasi, 
					"dapp_jamreservasi"=>$dapp_nonmedis_jamreservasi, 
					"dapp_petugas2"=>$dapp_nonmedis_petugas2, 
	//				"dapp_petugas2"=>$dapp_medis_petugas2, 
					"dapp_status"=>$dapp_nonmedis_status, 
					"dapp_tgldatang"=>$dapp_nonmedis_tgldatang, 
					"dapp_jamdatang"=>$dapp_nonmedis_jamdatang,
					"dapp_keterangan"=>$dapp_nonmedis_keterangan,
					"dapp_counter"=>$dapp_nonmedis_counter,
					"dapp_creator"=>$dapp_user
				);
				$this->db->insert('appointment_detail', $data); 
				if($this->db->affected_rows()){
					/* Check dan Ambil db.appointment_detail.dapp_id yang telah "barusan" ter-input */
					$sql="SELECT dapp_id FROM appointment_detail WHERE dapp_master='$dapp_nonmedis_master' AND dapp_perawatan='$dapp_nonmedis_perawatan' AND dapp_tglreservasi='$dapp_nonmedis_tglreservasi'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$dapp_id=$rs_record["dapp_id"];
					}
					/* JIKA Cara Appointment = 'Walk-in' alias 'Datang', maka INSERT ke db.tindakan atau dan db.tindakan_detail */
					if($app_cara=="Datang"){
						$date_now=date('Y-m-d');
						$time_now=date('H:i:s');
						/* INSERT ke db.tindakan dan db.tindakan_detail JIKA $dapp_status=='datang' */
						$sql="SELECT trawat_id FROM tindakan WHERE trawat_cust='$app_customer' AND trawat_date_create='$date_now'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){ /* artinya: di db.tindakan telah masuk appointment = $app_customer pada trawat_date_create(tanggal-input) = $date_now */
							$rs_record=$rs->row_array();
							$dtrawat_master=$rs_record["trawat_id"]; //ambil ID dr tabel tindakan
							//Karena di db.tindakan telah ada $app_customer && trawat_date_create='$date_now', maka HANYA INSERT to db.tindakan_detail
							$data_dtindakan=array(
							"dtrawat_master"=>$dtrawat_master,
							"dtrawat_dapp"=>$dapp_id,
							"dtrawat_perawatan"=>$dapp_nonmedis_perawatan,
							"dtrawat_petugas2"=>$dapp_nonmedis_petugas2,
							"dtrawat_jam"=>$dapp_nonmedis_jamreservasi,
							"dtrawat_tglapp"=>$dapp_nonmedis_tglreservasi,
							"dtrawat_keterangan"=>$dapp_nonmedis_keterangan,
							"dtrawat_status"=>$dapp_nonmedis_status
							);
							$sql_cek_dtindakan="SELECT dtrawat_dapp FROM tindakan_detail WHERE dtrawat_dapp='$dapp_id'";
							$rs=$this->db->query($sql_cek_dtindakan);
							if(!$rs->num_rows()){
								$this->db->insert('tindakan_detail', $data_dtindakan);
							}
						}else{ /* artinya: di db.tindakan BELUM masuk $app_customer && trawat_date_create(tanggal-input) = $date_now */
							/* INSERT to db.tindakan */
							$data_tindakan=array(
							"trawat_cust"=>$app_customer,
							"trawat_jamdatang"=>$time_now,
							//"trawat_appointment"=>$kategori_nama,
							"trawat_keterangan"=>$app_keterangan,
							"trawat_date_create"=>$date_now
							);
							$this->db->insert('tindakan', $data_tindakan);
							
							if($this->db->affected_rows()){
								/* Telah ter-insert ke db.tindakan, maka mulai INSERT db.tindakan_detail */
								$sql="SELECT trawat_id FROM tindakan WHERE trawat_cust='$app_customer' AND trawat_date_create='$date_now'";
								$rs=$this->db->query($sql);
								if($rs->num_rows()){
									$rs_record=$rs->row_array();
									$dtrawat_master=$rs_record["trawat_id"];
								}
								$data_dtindakan=array(
								"dtrawat_master"=>$dtrawat_master,
								"dtrawat_dapp"=>$dapp_id,
								"dtrawat_perawatan"=>$dapp_nonmedis_perawatan,
								"dtrawat_petugas2"=>$dapp_nonmedis_petugas2,
								"dtrawat_jam"=>$dapp_nonmedis_jamreservasi,
								"dtrawat_tglapp"=>$dapp_nonmedis_tglreservasi,
								"dtrawat_keterangan"=>$dapp_nonmedis_keterangan,
								"dtrawat_status"=>$dapp_nonmedis_status
								);
								$this->db->insert('tindakan_detail', $data_dtindakan);
							}
						}
						//UPDATE/INSERT ke db.report_tindakan dari Dokter && $app_cara=='datang'
						$bln_now=date('Y-m');
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dapp_nonmedis_petugas2'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_nonmedis_counter=='true'){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $dapp_nonmedis_petugas2);
							$this->db->update('report_tindakan', $data_reportt);
						}else if(!$rs->num_rows() && $dapp_nonmedis_counter=='true'){
							$data_reportt=array(
							"reportt_karyawan_id"=>$dapp_nonmedis_petugas2,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}
					}
					return '1';
				}else{
					return '0';
				}
			}else{
				$sql="SELECT dapp_id FROM appointment_detail WHERE dapp_id='$dapp_nonmedis_id' AND dapp_perawatan='$dapp_nonmedis_perawatan' AND dapp_tglreservasi='$dapp_nonmedis_tglreservasi' AND dapp_jamreservasi='$dapp_nonmedis_jamreservasi' AND dapp_petugas='$dapp_nonmedis_petugas2' AND dapp_keterangan='$dapp_nonmedis_keterangan'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows()){
					$sql="SELECT dapp_locked FROM appointment_detail WHERE dapp_id='$dapp_nonmedis_id' AND dapp_locked=0";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$data = array(
							//"dapp_master"=>$dapp_medis_master, 
							"dapp_perawatan"=>$dapp_nonmedis_perawatan, 
							"dapp_tglreservasi"=>$dapp_nonmedis_tglreservasi, 
							"dapp_jamreservasi"=>$dapp_nonmedis_jamreservasi, 
							"dapp_petugas2"=>$dapp_nonmedis_petugas2, 
							"dapp_keterangan"=>$dapp_nonmedis_keterangan,
							"dapp_creator"=>$dapp_user
						);
						$this->db->where('dapp_id', $dapp_nonmedis_id);
						$this->db->update('appointment_detail', $data); 
					}
				}
				return '1';
			}

		}
		//end of function
		
		//function for get list record
		function appointment_list($filter,$start,$end,$tgl_app,$jenis_rawat){
			if($jenis_rawat=="")
				$jenis_rawat="Medis";
			//$query = "SELECT * FROM appointment";
			$dt=date('Y-m-d');
			$dt_six=date('Y-m-d',mktime(0,0,0,date("m"),date("d")+6,date("Y")));
			$query="SELECT * FROM vu_appointment";
			
			if($jenis_rawat=="Medis"){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .=" kategori_nama='Medis'";
				if($tgl_app!=""){
					$query .=" AND dapp_tglreservasi='$tgl_app'";
				}else{
					$query .=" AND dapp_tglreservasi >= '$dt'";
				}
				// For simple search
				if ($filter<>"" && is_numeric($filter)==false){
					$query="SELECT * FROM vu_appointment ";
					$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
					//search customer,perawatan,dokter,therapist
					$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR terapis_username LIKE '%".addslashes($filter)."%')";
				}
			}elseif($jenis_rawat=="Non Medis"){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .=" kategori_nama='Non Medis'";
				if($tgl_app!=""){
					$query .=" AND dapp_tglreservasi='$tgl_app'";
				}else{
					$query .=" AND dapp_tglreservasi >= '$dt'";
				}
				// For simple search
				if ($filter<>"" && is_numeric($filter)==false){
					$query="SELECT * FROM vu_appointment ";
					$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
					//search customer,perawatan,dokter,therapist
					$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR terapis_username LIKE '%".addslashes($filter)."%')";
				}
			}
			
			// For Pilihan Dokter pada tbar
			if ($filter<>"" && is_numeric($filter)==true){
				if($tgl_app!=""){
					$dt=date('Y-m-d', strtotime($tgl_app));
					$query="SELECT * FROM vu_appointment WHERE dapp_tglreservasi = '$dt'";
				}else{
					$query="SELECT * FROM vu_appointment WHERE dapp_tglreservasi >= '$dt'";
				}
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				//search customer,perawatan,dokter,therapist
				$query .= " (dokter_id = '".addslashes($filter)."') AND kategori_nama='Medis'";
			}
			
			// For Pilihan Tanggal Appointment di tbar dengan pilihan dokter kosong
			if($filter=="" && is_numeric($filter)==false && $tgl_app!="" && $jenis_rawat=="Medis"){
				$dt=date('Y-m-d', strtotime($tgl_app));
				$query="SELECT * FROM vu_appointment WHERE kategori_nama='Medis' AND dapp_tglreservasi = '$dt'";
			}
			
			$query.=" ORDER BY dapp_tglreservasi ASC, dapp_jamreservasi ASC";
			//echo $query;
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
		function appointment_update($app_id ,$app_customer ,$dapp_tglreservasi ,$app_cara ,$app_keterangan,$dapp_id, $dapp_status, $dokter_nama, $terapis_nama, $kategori_nama, $rawat_id, $dokter_id, $terapis_id, $dapp_jamreservasi, $cust_id, $dapp_dokter_no, $dapp_terapis_no, $dapp_dokter_ganti, $dapp_terapis_ganti, $dapp_keterangan, $dapp_locked, $dapp_counter, $app_user){
			$dapp_locked=0;
			$sql="SELECT dapp_locked FROM appointment_detail WHERE dapp_id='$dapp_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$dapp_locked=$rs_record["dapp_locked"];
			}
			/* START JIKA db.appointment_detail.dapp_locked == 0 ALIAS Tidak di-Lock */
			if($dapp_locked==0){
				$dt=date('Y-m-d H:i:s');
				$date_now=date('Y-m-d');
				$bln_now=date('Y-m');
				
				/* UPDATE ke db.appointment baik $dapp_status=='datang' atau $dapp_status!='datang'
				>> Checking di db.appointment, apakah ada Perubahan atau Tidak => jika Tidak maka Tidak Ada Updating */
				$sql="SELECT app_cara,app_keterangan,app_revised FROM appointment WHERE app_id='$app_id'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					if($rs_record["app_cara"]!=$app_cara || $rs_record["app_keterangan"]!=$app_keterangan){ /* JIKA terjadi PERUBAHAN */
						$data = array(
							//"app_id"=>$app_id, 
							//"app_customer"=>$app_customer, 
							//"app_tanggal"=>$app_tanggal, 
							"app_cara"=>$app_cara, 
							"app_keterangan"=>$app_keterangan,
							"app_update"=>$app_user,
							"app_date_update"=>$dt,
							"app_revised"=>$rs_record["app_revised"]+1
						);
						/* TIDAK ADA UPDATE Customer
						$sql_cust="SELECT cust_id FROM customer WHERE cust_id='$app_customer'";
						$rs_cust=$this->db->query($sql_cust);
						if($rs_cust->num_rows()){
							$customer_id=$app_customer;
							$data["app_customer"]=$app_customer;
						}else{
							$customer_id=$cust_id;
						}*/
						$this->db->where('app_id', $app_id);
						$this->db->update('appointment', $data);
					}
				}
				
				/* Ambil dan Tampung terlebih dahulu => nilai appointment_detail.dapp_status JIKA appointment_detail.dapp_status TIDAK SAMA DENGAN $dapp_status(Status dari VIEW.LIST apakah telah terjadi Perubahan atau Tidak) */
				//$sql_detail="SELECT dapp_status FROM appointment_detail WHERE dapp_id='$dapp_id' AND dapp_status!='$dapp_status'";
				$sql_detail="SELECT dapp_tglreservasi FROM appointment_detail WHERE dapp_id='$dapp_id'";
				$rs_detail=$this->db->query($sql_detail);
				if($rs_detail->num_rows()){
					$rs_drecord=$rs_detail->row_array();
					$dapp_tglreservasi_temp=$rs_drecord["dapp_tglreservasi"];
					//$dapp_status_temp=$rs_drecord["dapp_status"];
				}/*else{
					//$dapp_status_temp=$dapp_status;
				}*/
				
				/* JIKA $dapp_status(Status dari VIEW.LIST) BERUBAH menjadi=>'datang', maka berpengaruh ke:
				>> db.appointment_detail.dapp_status, db.appointment_detail.dapp_jamdatang
				>> db.tindakan, db.tindakan_detail
				>> db.report_tindakan.reportt_jmltindakan (Meng-Counter tindakan yang dilakukan VIEW.LIST.$dokter_id) */
				$data_dapp=array();
				if($dapp_status=="datang" && $dapp_tglreservasi_temp==$date_now){ /* VIEW.LIST.$dapp_status DIGANTI 'datang' */
					$date_now=date('Y-m-d');
					$time_now=date('H:i:s');
					$data_dapp["dapp_tgldatang"]=$date_now;
					$data_dapp["dapp_jamdatang"]=$time_now;
					$data_dapp["dapp_status"]=$dapp_status;
					
					$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_dokter_ganti'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){ /* artinya: Telah terjadi per-GANTI-an DOKTER */
						$data_dapp["dapp_petugas"]=$dapp_dokter_ganti;
						
						/* KARENA ada per-GANTI-an Dokter && $dapp_status=="datang", 
						maka $dokter_id(dokter sebelumnya) dilakukan DE-Counter pada db.report_tindakan.reportt_jmltindakan */
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dokter_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_counter=='true'){
							$rs_record=$rs->row_array();
							$reportt_jmltindakan=$rs_record["reportt_jmltindakan"];
							//UPDATE jumlah_tindakan
							$data_report_tindakan=array(
							"reportt_jmltindakan"=>$reportt_jmltindakan-1
							);
							$this->db->where('reportt_karyawan_id', $dokter_id);
							$this->db->like('reportt_bln', $bln_now, 'after');
							$this->db->update('report_tindakan', $data_report_tindakan);
						}
						
						//UPDATE/INSERT ke db.report_tindakan dari Dokter-Pengganti && $dapp_status=='datang'
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dapp_dokter_ganti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_counter=='true'){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $dapp_dokter_ganti);
							$this->db->update('report_tindakan', $data_reportt);
						}else if(!$rs->num_rows() && $dapp_counter=='true'){
							$data_reportt=array(
							"reportt_karyawan_id"=>$dapp_dokter_ganti,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}
					}elseif($dokter_id!=""){
						//UPDATE/INSERT ke db.report_tindakan dari Dokter KETIKA $dapp_status BERUBAH 'datang'
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dokter_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_counter=='true'){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $dokter_id);
							$this->db->update('report_tindakan', $data_reportt);
						}else if(!$rs->num_rows() && $dapp_counter=='true'){
							$data_reportt=array(
							"reportt_karyawan_id"=>$dokter_id,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}
					}
					
					$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_terapis_ganti'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){ /* artinya: Telah terjadi per-GANTI-an TERAPIS */
						$data_dapp["dapp_petugas2"]=$dapp_terapis_ganti;
						
						/* KARENA ada per-GANTI-an Terapis && $dapp_status=="datang", 
						maka $terapis_id(terapis sebelumnya) dilakukan DE-Counter pada db.report_tindakan.reportt_jmltindakan */
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$terapis_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_counter=='true'){
							$rs_record=$rs->row_array();
							$reportt_jmltindakan=$rs_record["reportt_jmltindakan"];
							//UPDATE jumlah_tindakan
							$data_report_tindakan=array(
							"reportt_jmltindakan"=>$reportt_jmltindakan-1
							);
							$this->db->where('reportt_karyawan_id', $terapis_id);
							$this->db->like('reportt_bln', $bln_now, 'after');
							$this->db->update('report_tindakan', $data_report_tindakan);
						}
						
						//UPDATE/INSERT ke db.report_tindakan dari Terapis-Pengganti && $dapp_status=='datang'
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dapp_terapis_ganti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_counter=='true'){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $dapp_terapis_ganti);
							$this->db->update('report_tindakan', $data_reportt);
						}else if(!$rs->num_rows() && $dapp_counter=='true'){
							$data_reportt=array(
							"reportt_karyawan_id"=>$dapp_terapis_ganti,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}
					}elseif($terapis_id!=""){
						//UPDATE/INSERT ke db.report_tindakan dari Terapis KETIKA $dapp_status BERUBAH 'datang'
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$terapis_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows() && $dapp_counter=='true'){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $terapis_id);
							$this->db->update('report_tindakan', $data_reportt);
						}else if(!$rs->num_rows() && $dapp_counter=='true'){
							$data_reportt=array(
							"reportt_karyawan_id"=>$terapis_id,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}
					}
					
					$data_dapp["dapp_tglreservasi"]=$dapp_tglreservasi;
					$data_dapp["dapp_jamreservasi"]=$dapp_jamreservasi;
					$data_dapp["dapp_keterangan"]=$dapp_keterangan;
					$data_dapp["dapp_update"]=$app_user;
					$data_dapp["dapp_date_update"]=$dt;
					$sql="SELECT dapp_revised FROM appointment_detail WHERE dapp_id='$dapp_id' AND dapp_master='$app_id'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$data_dapp["dapp_revised"]=$rs_record["dapp_revised"]+1;
					}
					$this->db->where('dapp_id',$dapp_id);
					$this->db->where('dapp_master',$app_id);
					$this->db->update('appointment_detail',$data_dapp);
					
					/* INSERT ke db.tindakan dan db.tindakan_detail JIKA $dapp_status=='datang' */
					$sql="SELECT * FROM tindakan WHERE trawat_cust='$cust_id' AND trawat_date_create='$date_now'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$dtrawat_master=$rs_record["trawat_id"]; //ambil ID dr tabel tindakan
						//Hanya INSERT to Tindakan-Detail
						$data_dtindakan=array(
						"dtrawat_master"=>$dtrawat_master,
						"dtrawat_dapp"=>$dapp_id,
						"dtrawat_perawatan"=>$rawat_id,
						"dtrawat_jam"=>$dapp_jamreservasi,
						"dtrawat_tglapp"=>$dapp_tglreservasi,
						"dtrawat_keterangan"=>$dapp_keterangan,
						"dtrawat_status"=>$dapp_status
						);
						$sql_petugas1="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_dokter_ganti'";
						$rs_petugas1=$this->db->query($sql_petugas1);
						if($rs_petugas1->num_rows())
							$data_dtindakan["dtrawat_petugas1"]=$dapp_dokter_ganti;
						else
							$data_dtindakan["dtrawat_petugas1"]=$dokter_id;
						
						$sql_petugas2="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_terapis_ganti'";
						$rs_petugas2=$this->db->query($sql_petugas2);
						if($rs_petugas2->num_rows()){
							$data_dtindakan["dtrawat_petugas2"]=$dapp_terapis_ganti;
						}else{
							$data_dtindakan["dtrawat_petugas2"]=$terapis_id;
						}
						
						$sql_cek_dtindakan="SELECT dtrawat_dapp FROM tindakan_detail WHERE dtrawat_dapp='$dapp_id'";
						$rs=$this->db->query($sql_cek_dtindakan);
						if(!$rs->num_rows()){
							$this->db->insert('tindakan_detail', $data_dtindakan);
						}
					}else{
						$data_tindakan=array(
						"trawat_cust"=>$cust_id,
						"trawat_jamdatang"=>$time_now,
						//"trawat_appointment"=>$kategori_nama,
						"trawat_keterangan"=>$app_keterangan,
						"trawat_date_create"=>$date_now
						);
						$this->db->insert('tindakan', $data_tindakan);
						if($this->db->affected_rows()){
							$sql="SELECT * FROM tindakan WHERE trawat_cust='$cust_id' AND trawat_date_create='$date_now'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$dtrawat_master=$rs_record["trawat_id"];
							}
							$data_dtindakan=array(
							"dtrawat_master"=>$dtrawat_master,
							"dtrawat_dapp"=>$dapp_id,
							"dtrawat_perawatan"=>$rawat_id,
							"dtrawat_jam"=>$dapp_jamreservasi,
							"dtrawat_tglapp"=>$dapp_tglreservasi,
							"dtrawat_keterangan"=>$dapp_keterangan,
							"dtrawat_status"=>$dapp_status
							);
							$sql_petugas1="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_dokter_ganti'";
							$rs_petugas1=$this->db->query($sql_petugas1);
							if($rs_petugas1->num_rows())
								$data_dtindakan["dtrawat_petugas1"]=$dapp_dokter_ganti;
							else
								$data_dtindakan["dtrawat_petugas1"]=$dokter_id;
							
							$sql_petugas2="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_terapis_ganti'";
							$rs_petugas2=$this->db->query($sql_petugas2);
							if($rs_petugas2->num_rows()){
								$data_dtindakan["dtrawat_petugas2"]=$dapp_terapis_ganti;
							}else{
								$data_dtindakan["dtrawat_petugas2"]=$terapis_id;
							}
							$this->db->insert('tindakan_detail', $data_dtindakan);
						}
					}
					
				}elseif($dapp_status!="datang"){ /* VIEW.LIST.$dapp_status DIGANTI SELAIN 'datang' */
					/* Menghapus Tindakan-DEtail WHERE db.tindakan_detail.dtrawat_dapp == $dapp_id(dari appointment_detail.dapp_id) */
					$this->db->where('dtrawat_dapp', $dapp_id);
					$this->db->delete('tindakan_detail');
					
					/* UPDATE db.appointment_detail */
					$data_dapp["dapp_tgldatang"]="0000-00-00";
					$data_dapp["dapp_jamdatang"]="";
					$data_dapp["dapp_status"]=$dapp_status;
					
					$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_dokter_ganti'";
					$rs=$this->db->query($sql);
					if($rs->num_rows())
						$data_dapp["dapp_petugas"]=$dapp_dokter_ganti;
					
					$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dapp_terapis_ganti'";
					$rs=$this->db->query($sql);
					if($rs->num_rows())
						$data_dapp["dapp_petugas2"]=$dapp_terapis_ganti;
					
					$data_dapp["dapp_tglreservasi"]=$dapp_tglreservasi;
					$data_dapp["dapp_jamreservasi"]=$dapp_jamreservasi;
					$data_dapp["dapp_keterangan"]=$dapp_keterangan;
					$data_dapp["dapp_update"]=$app_user;
					$data_dapp["dapp_date_update"]=$dt;
					$sql="SELECT dapp_revised FROM appointment_detail WHERE dapp_id='$dapp_id' AND dapp_master='$app_id'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$data_dapp["dapp_revised"]=$rs_record["dapp_revised"]+1;
					}
					$this->db->where('dapp_id',$dapp_id);
					$this->db->where('dapp_master',$app_id);
					$this->db->update('appointment_detail',$data_dapp);
					
					
					//decounter table.report_tindakan
					$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND (reportt_karyawan_id='$dokter_id' OR reportt_karyawan_id='$terapis_id')";
					$rs=$this->db->query($sql);
					if($rs->num_rows() && $dapp_counter=='true'){
						$rs_record=$rs->row_array();
						$reportt_jmltindakan=$rs_record["reportt_jmltindakan"];
						//UPDATE jumlah_tindakan
						$data_report_tindakan=array(
						"reportt_jmltindakan"=>$reportt_jmltindakan-1
						);
						$this->db->where('reportt_karyawan_id', $dokter_id);
						$this->db->or_where('reportt_karyawan_id', $terapis_id);
						$this->db->like('reportt_bln', $bln_now, 'after');
						$this->db->update('report_tindakan', $data_report_tindakan);
					}
				}elseif($dapp_status=="datang" && $dapp_tglreservasi_temp!=$date_now){
					return '3';
				}
				$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dokter_nama'";
				$rs=$this->db->query($sql);
				if($rs->num_rows())
					$data_dapp["dapp_petugas"]=$dokter_nama;
				
				$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$terapis_nama'";
				$rs=$this->db->query($sql);
				if($rs->num_rows())
					$data_dapp["dapp_petugas2"]=$terapis_nama;
				
				$data_dapp["dapp_tglreservasi"]=$dapp_tglreservasi;
				$data_dapp["dapp_jamreservasi"]=$dapp_jamreservasi;
				$data_dapp["dapp_keterangan"]=$dapp_keterangan;
				$data_dapp["dapp_update"]=$app_user;
				$data_dapp["dapp_date_update"]=$dt;
				$sql="SELECT dapp_revised FROM appointment_detail WHERE dapp_id='$dapp_id' AND dapp_master='$app_id'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$data_dapp["dapp_revised"]=$rs_record["dapp_revised"]+1;
				}
				$this->db->where('dapp_id',$dapp_id);
				$this->db->where('dapp_master',$app_id);
				$this->db->update('appointment_detail',$data_dapp);
				return '1';
				/* END JIKA db.appointment_detail.dapp_locked == 0 ALIAS Tidak di-Lock */
			}else{ /* JIKA db.appointment_detail.dapp_locked == 1, maka tidak bisa di-EDIT */
				return '2';
			}
			
		}
		
		//function for create new record
		function appointment_create($app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$app_cust_nama_baru ,$app_cust_telp_baru ,$app_cust_hp_baru ,$app_cust_keterangan_baru ,$app_user){
			if($app_cust_nama_baru!=""){
				if($app_cust_telp_baru=="")
					$app_cust_telp_baru='0';
				if($app_cust_hp_baru=="")
					$app_cust_hp_baru='0';
				
				if($app_cust_telp_baru!='0')
					$sql="SELECT * FROM customer WHERE cust_telprumah='$app_cust_telp_baru'";
				if($app_cust_hp_baru!='0')
					$sql="SELECT * FROM customer WHERE cust_hp='$app_cust_hp_baru'";
				if($app_cust_telp_baru!='0' && $app_cust_hp_baru!='0')
					$sql="SELECT * FROM customer WHERE cust_telprumah='$app_cust_telp_baru' AND cust_hp='$app_cust_hp_baru'";
				
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					return '2';
				}elseif($app_cust_telp_baru!='0' || $app_cust_hp_baru!='0'){
					$data_cust_baru=array(
					"cust_nama"=>$app_cust_nama_baru,
					"cust_telprumah"=>$app_cust_telp_baru,
					"cust_hp"=>$app_cust_hp_baru,
					"cust_keterangan"=>$app_cust_keterangan_baru,
					"cust_aktif"=>'Aktif'
					);
					$this->db->insert('customer', $data_cust_baru);
					if($this->db->affected_rows()){
						if($app_cust_telp_baru!='0')
							$sql="SELECT cust_id FROM customer WHERE cust_telprumah='$app_cust_telp_baru'";
						if($app_cust_hp_baru!='0')
							$sql="SELECT cust_id FROM customer WHERE cust_hp='$app_cust_hp_baru'";
						if($app_cust_telp_baru!='0' && $app_cust_hp_baru!='0')
							$sql="SELECT cust_id FROM customer WHERE cust_telprumah='$app_cust_telp_baru' AND cust_hp='$app_cust_hp_baru'";
						
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$app_customer=$rs_record["cust_id"];
						}
						
						$data = array(
							"app_customer"=>$app_customer, 
							"app_tanggal"=>$app_tanggal, 
							"app_cara"=>$app_cara, 
							"app_keterangan"=>$app_keterangan,
							"app_creator"=>$app_user
						);
						$this->db->insert('appointment', $data);
					}
				}elseif($app_cust_telp_baru=='0' && $app_cust_hp_baru=='0'){
					return '3';
				}
			}else{
				$data = array(
					"app_customer"=>$app_customer, 
					"app_tanggal"=>$app_tanggal, 
					"app_cara"=>$app_cara, 
					"app_keterangan"=>$app_keterangan,
					"app_creator"=>$app_user
				);
				$this->db->insert('appointment', $data);
			} 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
			
		}
		
		//fcuntion for delete record
		/*function appointment_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the appointments at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM appointment WHERE app_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM appointment WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "app_id= ".$pkid[$i];
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
		}*/
		
		/* Delete appointment_detail */
		function appointment_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the appointments at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$sql="SELECT dapp_master,dapp_petugas,dapp_petugas2,dapp_tglreservasi FROM appointment_detail WHERE dapp_id='$pkid[0]'";
				$rs=$this->db->query($sql);
				$rs_record=$rs->row_array();
				$temp_dapp_master[]=$rs_record["dapp_master"];
				$temp_dapp_petugas[]=$rs_record["dapp_petugas"];
				$temp_dapp_petugas2[]=$rs_record["dapp_petugas2"];
				$temp_dapp_tglreservasi[]=$rs_record["dapp_tglreservasi"];
				
				$query = "DELETE FROM appointment_detail WHERE dapp_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$sql="SELECT dapp_master,dapp_petugas,dapp_petugas2,dapp_tglreservasi FROM appointment_detail WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$sql = $sql . "dapp_id= ".$pkid[$i];
					if($i<sizeof($pkid)-1){
						$sql = $sql . " OR ";
					}
				}
				$rs=$this->db->query($sql);
				$rs_record=$rs->row_array();
				if($rs->num_rows()>0){
					foreach($rs->result_array() as $row){
						$temp_dapp_master[]=$row["dapp_master"];
						$temp_dapp_petugas[]=$row["dapp_petugas"];
						$temp_dapp_petugas2[]=$row["dapp_petugas2"];
						$temp_dapp_tglreservasi[]=$row["dapp_tglreservasi"];
					}
				}
				
				$query = "DELETE FROM appointment_detail WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "dapp_id= ".$pkid[$i];
					if($i<sizeof($pkid)-1){
						$query = $query . " OR ";
					}     
				}
				$this->db->query($query);
			}
			if($this->db->affected_rows()>0){
				for($i=0; $i<sizeof($temp_dapp_master); $i++){
					$sql="SELECT dapp_master FROM appointment_detail WHERE dapp_master='$temp_dapp_master[$i]'";
					$rs=$this->db->query($sql);
					if(!$rs->num_rows()){
						//DELETE table.appointment where app_id=$temp_dapp_master[$i]
						$this->db->where('app_id', $temp_dapp_master[$i]);
						$this->db->delete('appointment');
					}
				}
				//DeCOUNT table.report_tindakan where 
				for($i=0; $i<sizeof($temp_dapp_petugas); $i++){
					if($temp_dapp_petugas[$i]!=null){
						$check_tglreservasi=date('Y-m', strtotime($temp_dapp_tglreservasi[$i]));
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_karyawan_id='$temp_dapp_petugas[$i]' AND reportt_bln LIKE '$check_tglreservasi%'";
						$rs=$this->db->query($sql);
						$rs_record=$rs->row_array();
						if($rs->num_rows() && $rs_record["reportt_jmltindakan"]!=0){
							$data=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]-1
							);
							$this->db->where('reportt_karyawan_id', $temp_dapp_petugas[$i]);
							$this->db->like('reportt_bln', $check_tglreservasi);
							$this->db->update('report_tindakan',$data);
						}
					}
				}
				for($i=0; $i<sizeof($temp_dapp_petugas2); $i++){
					if($temp_dapp_petugas2[$i]!=null){
						$check_tglreservasi=date('Y-m', strtotime($temp_dapp_tglreservasi[$i]));
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_karyawan_id='$temp_dapp_petugas2[$i]' AND reportt_bln LIKE '$check_tglreservasi%'";
						$rs=$this->db->query($sql);
						$rs_record=$rs->row_array();
						if($rs->num_rows() && $rs_record["reportt_jmltindakan"]!=0){
							$data=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]-1
							);
							$this->db->where('reportt_karyawan_id', $temp_dapp_petugas2[$i]);
							$this->db->like('reportt_bln', $check_tglreservasi);
							$this->db->update('report_tindakan',$data);
						}
					}
				}
				return '1';
			}else
				return '0';
		}
		
		//function for advanced search record
		function appointment_search($app_id ,$app_customer ,$app_cara ,$app_kategori ,$app_dokter ,$app_terapis , $app_rawat_medis, $app_rawat_nonmedis, $app_tgl_start_reservasi, $app_tgl_end_reservasi, $app_tgl_start_app, $app_tgl_end_app, $start,$end){
			//full query
			//$query="select * from appointment";
			/*$query="SELECT app_id,app_customer,cust_nama,karyawan_dokter.karyawan_nama as dokter_nama,karyawan_terapis.karyawan_nama as terapis_nama,rawat_id,rawat_nama,kategori_nama,dapp_id,dapp_status,dapp_tglreservasi,dapp_jamdatang,app_tanggal,app_cara,app_keterangan,dapp_jamreservasi,app_creator,app_date_create,app_update,app_date_update,app_revised 
FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id)";
*/
			$dt=date('Y-m-d');
			$dt_six=date('Y-m-d',mktime(0,0,0,date("m"),date("d")+6,date("Y")));
			$query="SELECT * FROM vu_appointment";
			
			if($app_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_id LIKE '%".$app_id."%'";
			};
			if($app_customer!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_customer='".$app_customer."'";
			};
			if($app_tgl_start_reservasi!='' && $app_tgl_end_reservasi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_tanggal BETWEEN '".$app_tgl_start_reservasi."' AND '".$app_tgl_end_reservasi."'";
			}else if($app_tgl_start_reservasi!='' && $app_tgl_end_reservasi==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_tanggal='".$app_tgl_start_reservasi."'";
			}
			if($app_tgl_start_app!='' && $app_tgl_end_app!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dapp_tglreservasi BETWEEN '".$app_tgl_start_app."' AND '".$app_tgl_end_app."'";
			}else if($app_tgl_start_app!='' && $app_tgl_end_app==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dapp_tglreservasi='".$app_tgl_start_app."'";
			}
			if($app_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_cara LIKE '%".$app_cara."%'";
			};
			if($app_kategori!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kategori_nama='".$app_kategori."'";
			};
			if($app_dokter!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dokter_id='".$app_dokter."'";
			};
			if($app_terapis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terapis_id='".$app_terapis."'";
			};
			if($app_rawat_medis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_id = '".$app_rawat_medis."'";
			};
			if($app_rawat_nonmedis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_id = '".$app_rawat_nonmedis."'";
			};
			/*if($app_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_keterangan LIKE '%".$app_keterangan."%'";
			};*/
			//echo $query;
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
		function appointment_print($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$option,$filter){
			//full query
			$query="select * from appointment";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (app_id LIKE '%".addslashes($filter)."%' OR app_customer LIKE '%".addslashes($filter)."%' OR app_tanggal LIKE '%".addslashes($filter)."%' OR app_cara LIKE '%".addslashes($filter)."%' OR app_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($app_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_id LIKE '%".$app_id."%'";
				};
				if($app_customer!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_customer LIKE '%".$app_customer."%'";
				};
				if($app_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_tanggal LIKE '%".$app_tanggal."%'";
				};
				if($app_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_cara LIKE '%".$app_cara."%'";
				};
				if($app_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_keterangan LIKE '%".$app_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function appointment_export_excel($app_id ,$app_customer ,$app_cara ,$app_kategori ,$app_dokter ,$app_terapis ,$app_tgl_start_reservasi ,$app_tgl_end_reservasi ,$app_tgl_start_app ,$app_tgl_end_app ,$app_rawat_medis ,$app_rawat_nonmedis ,$option,$filter){
			
			//full query
			if($option=='LIST'){
				//$query = "SELECT * FROM appointment";
				$dt=date('Y-m-d');
				$query="SELECT dapp_tglreservasi as tanggal_appointment,dapp_jamreservasi as jam_appointment,rawat_nama as perawatan,cust_no as no_customer,cust_nama as customer,karyawan_dokter.karyawan_username as dokter_nikcname,karyawan_terapis.karyawan_username as terapis_nickname,dapp_status as status,dapp_jamdatang as jam_datang,dapp_keterangan as keterangan_detail
	FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
	inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
	left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id)
	WHERE dapp_tglreservasi >= '$dt'";
				
				// For simple search
				if ($filter<>"" && is_numeric($filter)==false){
					$query="SELECT dapp_tglreservasi as tanggal_appointment,dapp_jamreservasi as jam_appointment,rawat_nama as perawatan,cust_no as no_customer,cust_nama as customer,karyawan_dokter.karyawan_username as dokter_nikcname,karyawan_terapis.karyawan_username as terapis_nickname,dapp_status as status,dapp_jamdatang as jam_datang,dapp_keterangan as keterangan_detail
	FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
	inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
	left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id)";
					$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
					//search customer,perawatan,dokter,therapist
					$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_dokter.karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_terapis.karyawan_username LIKE '%".addslashes($filter)."%')";
				}
				
				// For Pilihan Dokter pada tbar
				if ($filter<>"" && is_numeric($filter)==true){
					$query="SELECT dapp_tglreservasi as tanggal_appointment,dapp_jamreservasi as jam_appointment,rawat_nama as perawatan,cust_no as no_customer,cust_nama as customer,karyawan_dokter.karyawan_username as dokter_nikcname,karyawan_terapis.karyawan_username as terapis_nickname,dapp_status as status,dapp_jamdatang as jam_datang,dapp_keterangan as keterangan_detail
	FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
	inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
	left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id) WHERE dapp_tglreservasi >= '$dt'";
					$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
					//search customer,perawatan,dokter,therapist
					$query .= " (karyawan_dokter.karyawan_id = '".addslashes($filter)."')";
				}
				$query.=" ORDER BY dapp_tglreservasi ASC, dapp_jamreservasi ASC";
				$result = $this->db->query($query);
				
			} else if($option=='SEARCH'){
				$dt=date('Y-m-d');
				$query="SELECT dapp_tglreservasi as tanggal_appointment,dapp_jamreservasi as jam_appointment,rawat_nama as perawatan,cust_no as no_customer,cust_nama as customer,karyawan_dokter.karyawan_username as dokter_nikcname,karyawan_terapis.karyawan_username as terapis_nickname,dapp_status as status,dapp_jamdatang as jam_datang,dapp_keterangan as keterangan_detail
	FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
	inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
	left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id)";
				
				if($app_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_id LIKE '%".$app_id."%'";
				};
				if($app_customer!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_customer='".$app_customer."'";
				};
				if($app_tgl_start_reservasi!='' && $app_tgl_end_reservasi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_tanggal BETWEEN '".$app_tgl_start_reservasi."' AND '".$app_tgl_end_reservasi."'";
				}else if($app_tgl_start_reservasi!='' && $app_tgl_end_reservasi==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_tanggal='".$app_tgl_start_reservasi."'";
				}
				if($app_tgl_start_app!='' && $app_tgl_end_app!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dapp_tglreservasi BETWEEN '".$app_tgl_start_app."' AND '".$app_tgl_end_app."'";
				}else if($app_tgl_start_app!='' && $app_tgl_end_app==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " dapp_tglreservasi='".$app_tgl_start_app."'";
				}
				if($app_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_cara LIKE '%".$app_cara."%'";
				};
				if($app_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kategori_nama='".$app_kategori."'";
				};
				if($app_dokter!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_dokter.karyawan_id='".$app_dokter."'";
				};
				if($app_terapis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_terapis.karyawan_id='".$app_terapis."'";
				};
				if($app_rawat_medis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_id = '".$app_rawat_medis."'";
				};
				if($app_rawat_nonmedis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_id = '".$app_rawat_nonmedis."'";
				};
				
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>