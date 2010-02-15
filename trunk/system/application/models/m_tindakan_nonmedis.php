<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan Model
	+ Description	: For record model process back-end
	+ Filename 		: m_tindakan_nonmedis.php
 	+ Author  		: masongbee
 	+ Created on 22/Oct/2009 19:16:47
	
*/

class M_tindakan_nonmedis extends Model{
		
		//constructor
		function M_tindakan_nonmedis() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_tindakan_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM vu_tindakan WHERE dtrawat_master='".$master_id."' AND dtrawat_petugas2!='0'";
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
			$query = "SELECT max(trawat_id) as master_id from tindakan";
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
		function detail_tindakan_nonmedis_detail_purge($master_id){
			$sql="DELETE from tindakan_detail where dtrawat_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_tindakan_nonmedis_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jam ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan ,$dtrawat_ambil_paket ,$dtrawat_cust){
			$date_now=date('Y-m-d');
			//if master id not capture from view then capture it from max pk from master table
			if($dtrawat_master=="" || $dtrawat_master==NULL){
				$dtrawat_master=$this->get_master_id();
			}
			
			$sql="SELECT dtrawat_id,dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				/* artinya: data dtrawat_id ini sudah ada di db.tindakan_detail,
				maka hanya boleh dilakukan Editing dgn catatan data ini dalam kondisi UNLOCK*/
				
				/* 
				* JIKA $dtrawat_ambil_paket=true ==> Lakukan Checking di db.submaster_jual_paket,db.master_jual_paket,db.master_ambil_paket WHERE db.submaster_jual_paket.sjpaket_cust=[customer yg diupdate]
				*/
				if($dtrawat_ambil_paket=='true'){
					$sql="SELECT jpaket_nobukti, apaket_id, apaket_paket, apaket_sisa_paket FROM ((((submaster_jual_paket INNER JOIN master_jual_paket ON(sjpaket_master=jpaket_id)) INNER JOIN master_ambil_paket ON(jpaket_nobukti=apaket_faktur)) INNER JOIN paket ON(apaket_paket=paket_id)) INNER JOIN paket_isi_perawatan ON(paket_id=rpaket_master)) LEFT JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE sjpaket_cust='$dtrawat_cust' AND rpaket_perawatan='$dtrawat_perawatan' AND apaket_sisa_paket>0";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						/* Customer ini dengan perawatan yang telah dilakukan terdapat pada daftar pemilik paket yang ([total sisa paketnya] > 0) */
						/* Karena CheckBox Pengambilan Paket di-Centang, maka akan dimasukkan ke dalam Daftar Pengambilan Paket sehingga total_sisa_paket akan berkurang */
						//$this->firephp->log("punya paket");
						$rs_record=$rs->row_array();
						$apaket_sisa_paket_temp=$rs_record["apaket_sisa_paket"];
						$apaket_id_temp=$rs_record["apaket_id"];
						$data_dapaket=array(
						"dapaket_master"=>$rs_record["apaket_id"],
						"dapaket_dpaket"=>$rs_record["apaket_paket"],
						"dapaket_item"=>$dtrawat_perawatan,
						"dapaket_jumlah"=>1,
						"dapaket_cust"=>$dtrawat_cust
						);
						$apaket=1;
						$this->db->insert('detail_ambil_paket', $data_dapaket);
						if($this->db->affected_rows()){
							/* UPDATE db.master_ambil_paket.apaket_sisa_paket = -1 */
							$data_apaket=array(
							"apaket_sisa_paket"=>$apaket_sisa_paket_temp-1
							);
							$this->db->where('apaket_id', $apaket_id_temp);
							$this->db->update('master_ambil_paket', $data_apaket);
						}
					}else{
						//$this->firephp->log("tidak punya paket");
						$punya_paket=1;
					}
				}elseif($dtrawat_ambil_paket=='false'){
					$apaket=1;
					//$this->firephp->log('dtrawat_ambil_paket=false');
					
					/* artinya: membatalkan pengambilan paket */
					$sql="SELECT jpaket_nobukti, apaket_id, apaket_paket, apaket_sisa_paket FROM ((((submaster_jual_paket INNER JOIN master_jual_paket ON(sjpaket_master=jpaket_id)) INNER JOIN master_ambil_paket ON(jpaket_nobukti=apaket_faktur)) INNER JOIN paket ON(apaket_paket=paket_id)) INNER JOIN paket_isi_perawatan ON(paket_id=rpaket_master)) LEFT JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE sjpaket_cust='$dtrawat_cust' AND rpaket_perawatan='$dtrawat_perawatan'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						//$this->firephp->log("delete ambil paket");
						$rs_record=$rs->row_array();
						$apaket_sisa_paket_temp=$rs_record["apaket_sisa_paket"];
						$apaket_id_temp=$rs_record["apaket_id"];
						//$this->firephp->log($apaket_sisa_paket_temp, 'apaket_sisa_paket_temp');
						//$this->firephp->log($rs_record["apaket_id"], 'apaket_id');
						//$this->firephp->log($rs_record["apaket_paket"], 'apaket_paket');
						//$this->firephp->log($dtrawat_perawatan, 'dtrawat_perawatan');
						//$this->firephp->log($dtrawat_cust, 'dtrawat_cust');
						$this->db->where('dapaket_master', $rs_record["apaket_id"]);
						$this->db->where('dapaket_dpaket', $rs_record["apaket_paket"]);
						$this->db->where('dapaket_item', $dtrawat_perawatan);
						$this->db->where('dapaket_cust', $dtrawat_cust);
						$this->db->delete('detail_ambil_paket');
						if($this->db->affected_rows()){
							/* UPDATE db.master_ambil_paket.apaket_sisa_paket = +1 */
							$data_apaket=array(
							"apaket_sisa_paket"=>$apaket_sisa_paket_temp+1
							);
							$this->db->where('apaket_id', $apaket_id_temp);
							$this->db->update('master_ambil_paket', $data_apaket);
						}
					}
				}
				
				$rs_record=$rs->row_array();
				$dtrawat_locked=$rs_record["dtrawat_locked"];
				
				$sql="SELECT dtrawat_id FROM tindakan_detail WHERE dtrawat_perawatan='$dtrawat_perawatan' AND dtrawat_petugas2='$dtrawat_petugas2' AND dtrawat_jam='$dtrawat_jam' AND dtrawat_keterangan='$dtrawat_keterangan' AND dtrawat_ambil_paket='$dtrawat_ambil_paket'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows() && $dtrawat_locked==0){
					$data=array(
					"dtrawat_perawatan"=>$dtrawat_perawatan,
					"dtrawat_petugas2"=>$dtrawat_petugas2,
					"dtrawat_jam"=>$dtrawat_jam,
					"dtrawat_keterangan"=>$dtrawat_keterangan,
					"dtrawat_ambil_paket"=>$dtrawat_ambil_paket
					);
					$this->db->where('dtrawat_id', $dtrawat_id);
					$this->db->update('tindakan_detail', $data);
					if($this->db->affected_rows()){
						/* Checking di db.detail_jual_rawat, apakah data dtrawat_id ini telah masuk ke db.detail_jual_rawat ??
						JIKA "ada", maka lakukan Editing juga di db.detail_jual_rawat */
						$sql="SELECT drawat_dtrawat FROM detail_jual_rawat WHERE drawat_dtrawat='$dtrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
							"drawat_rawat"=>$dtrawat_perawatan
							);
							$this->db->where('drawat_dtrawat', $dtrawat_id);
							$this->db->update('detail_jual_rawat', $data);
						}
						return '1';
					}else {
						return '0';
					}
				}elseif($dtrawat_locked==1){
					return '2';
				}
			}else{
				/* artinya: data ini adalah "data baru".
				* Data Baru ini otomatis ber-status='datang', maka db.report_tindakan dari Dokter yang dipilih akan ditambahkan +1
				*/
				$data=array(
				"dtrawat_master"=>$dtrawat_master,
				"dtrawat_perawatan"=>$dtrawat_perawatan,
				"dtrawat_petugas2"=>$dtrawat_petugas2,
				"dtrawat_tglapp"=>$date_now,
				"dtrawat_jam"=>$dtrawat_jam,
				"dtrawat_keterangan"=>$dtrawat_keterangan
				);
				$this->db->insert('tindakan_detail', $data);
				if($this->db->affected_rows()){
					$bln_now=date('Y-m');
					/* meng-Counter db.report_tindakan dari Dokter yang dipilih */
					$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dtrawat_petugas2'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$data_reportt=array(
						"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
						);
						$this->db->where('reportt_karyawan_id', $dtrawat_petugas2);
						$this->db->update('report_tindakan', $data_reportt);
					}else if(!$rs->num_rows()){
						$data_reportt=array(
						"reportt_karyawan_id"=>$dtrawat_petugas2,
						"reportt_bln"=>$date_now,
						"reportt_jmltindakan"=>1
						);
						$this->db->insert('report_tindakan', $data_reportt);
					}
					return '1';
				}else {
					return '0';
				}
			}

		}
		//end of function
		
		//function for get list record
		function tindakan_list($filter,$start,$end){
			//$query = "SELECT * FROM tindakan,customer WHERE trawat_cust=cust_id AND trawat_appointment='Non Medis'";
			$date_now=date('Y-m-d');
			//$query = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			$query = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Non Medis' AND dtrawat_petugas2!='0')";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query.=" AND dtrawat_status='datang'";
			
			//$query2 = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			$query2 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Non Medis' AND dtrawat_petugas2!='0')";
			
			// For simple search
			if ($filter<>""){
				$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
				$query2 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query2.=" AND dtrawat_status='selesai'";
			
			//$query3 = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			$query3 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Non Medis' OR dtrawat_petugas2!='0')";
			
			// For simple search
			if ($filter<>""){
				$query3 .=eregi("WHERE",$query3)? " AND ":" WHERE ";
				$query3 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query3.=" AND dtrawat_status='batal'";
			
			//$query4 = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			/*$query4 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Non Medis' AND date_format(dtrawat_tglapp, '%Y-%m-%d')=date_format('$date_now', '%Y-%m-%d') AND dtrawat_dapp!='0'";
			
			// For simple search
			if ($filter<>""){
				$query4 .=eregi("WHERE",$query4)? " AND ":" WHERE ";
				$query4 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query4.=" AND dtrawat_status='batal'";*/
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			//$limit = $query." LIMIT ".$start.",".$end;		
			//$result = $this->db->query($limit);  
			$result2 = $this->db->query($query2);
			$nbrows2 = $result2->num_rows();
			
			$result3 = $this->db->query($query3);
			$nbrows3 = $result3->num_rows();
			
			/*$result4 = $this->db->query($query4);
			$nbrows4 = $result4->num_rows();*/
			
			if($nbrows>0 || $nbrows2>0 || $nbrows3>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($result2->result() as $row2){
						$arr[] = $row2;
					}
				}
				if($nbrows3>0){
					foreach($result3->result() as $row3){
						$arr[] = $row3;
					}
				}
				/*if($nbrows4>0){
					foreach($result4->result() as $row4){
						$arr[] = $row4;
					}
				}*/
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for update record
		function tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_terapis ,$dtrawat_terapis_id ,$dtrawat_keterangan ,$dtrawat_dapp ,$mode_edit){
			/* Checking db.tindakan_detail WHERE db.tindakan_detail.dtrawat_id = $dtrawat_id DAN semua Field,
			 * JIKA ada salah satu Field yang berubah maka akan di-UPDATE
			 */ 
			$data_tindakan=array(
			"trawat_keterangan"=>$trawat_keterangan
			);
			$this->db->where("trawat_id", $trawat_id);
			$this->db->update("tindakan", $data_tindakan);
			
			if($mode_edit=="update_list"){
				$sql_check="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_status,dtrawat_petugas2,dtrawat_keterangan,dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
				$rs_check=$this->db->query($sql_check);
				if($rs_check->num_rows()){
					$rs_check_record=$rs_check->row_array();
					$dtrawat_locked=$rs_check_record["dtrawat_locked"];
					$dtrawat_perawatan_awal=$rs_check_record["dtrawat_perawatan"];
					$dtrawat_terapis_awal=$rs_check_record["dtrawat_petugas2"];
					$dtrawat_keterangan_awal=$rs_check_record["dtrawat_keterangan"];
					$dtrawat_status_awal=$rs_check_record["dtrawat_status"];
					
					$sql="SELECT rawat_id FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
					$rs=$this->db->query($sql);
					if($rs->num_rows())
						$dtrawat_perawatan=$dtrawat_perawatan;
					else 
						$dtrawat_perawatan=$dtrawat_perawatan_id;
					
					$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dtrawat_terapis'";
					$rs=$this->db->query($sql);
					if($rs->num_rows())
						$dtrawat_terapis=$dtrawat_terapis;
					else 
						$dtrawat_terapis=$dtrawat_terapis_id;
					
					if($dtrawat_status_awal<>$dtrawat_status && $dtrawat_locked==0){ /* artinya: Status BErubah */
						/*artinya: Status BErubah && db.tindakan_detail is UNLOCK
						 * perubahan hanya pada STATUS di mode VIEW.LIST
						 */ 
						$date_now=date('Y-m-d');
						/*$data_tindakan=array(
						"trawat_keterangan"=>$trawat_keterangan
						);
						$this->db->where("trawat_id", $trawat_id);
						$this->db->update("tindakan", $data_tindakan);*/
						
						$data_dtindakan=array(
						"dtrawat_status"=>$dtrawat_status,
						);
						/*$sql="SELECT rawat_id FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
						$rs=$this->db->query($sql);
						if($rs->num_rows())
							$data_dtindakan["dtrawat_perawatan"]=$dtrawat_perawatan;*/
						
						$this->db->where("dtrawat_id", $dtrawat_id);
						$this->db->update("tindakan_detail", $data_dtindakan);
						
						//Jika $dtrawat_status=="selesai" --> INSERT to db.master_jual_rawat
						if($dtrawat_status=="selesai"){
							/*Checking di db.master_jual_rawat WHERE jrawat_cust=$trawat_cust_id AND jrawat_tanggal=$date_now 
							 * Jika SUDAH ADA maka INSERT hanya ke db.detail_jual_rawat
							 * Jika TIDAK ADA maka INSERT ke db.master_jual_rawat AND db.detail_jual_rawat
							 */
							
							$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								/* artinya: di db.master_jual_rawat 'sudah ada', 
								 * maka Hanya INSERT ke db.detail_jual_rawat
								 */
								$rs_record=$rs->row_array();
								$jrawat_id=$rs_record["jrawat_id"];
								if($cust_member!=""){
									$diskon_jenis="DM";
									
									$data_djrawat=array(
									"drawat_master"=>$jrawat_id,
									"drawat_dtrawat"=>$dtrawat_id,
									"drawat_rawat"=>$dtrawat_perawatan_id,
									"drawat_jumlah"=>1,
									"drawat_harga"=>$rawat_harga,
									"drawat_diskon"=>$rawat_dm,
									"drawat_diskon_jenis"=>$diskon_jenis
									);
									$this->db->insert('detail_jual_rawat', $data_djrawat);
									
									/* Checking di db.tindakan_detail WHERE tindakan_detail.dtrawat_master = $trawat_id 
									 * AND kategori = 'Non Medis',
									 * JIKA "ada" ini artinya di menu Tindakan Medis juga menjual Tindakan Non-Medis
									 */
									$sql="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_keterangan,rawat_harga,rawat_dm FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='$trawat_id' AND kategori_nama='Non Medis'";
									$rs=$this->db->query($sql);
									if($rs->num_rows()){
										/* hasilnya "ADA", maka akan ditambahkan ke db.detail_jual_rawat */
										$rs_record=$rs->row_array();
										$dtj_nonmedis_perawatan=$rs_record["dtrawat_perawatan"];
										$dtj_nonmedis_rawat_harga=$rs_record["rawat_harga"];
										$dtj_nonmedis_rawat_dm=$rs_record["rawat_dm"];
										$data_dtj_nonmedis=array(
										"drawat_master"=>$jrawat_id,
										"drawat_dtrawat"=>$dtrawat_id,
										"drawat_rawat"=>$dtj_nonmedis_perawatan,
										"drawat_jumlah"=>1,
										"drawat_harga"=>$dtj_nonmedis_rawat_harga,
										"drawat_diskon"=>$dtj_nonmedis_rawat_dm,
										"drawat_diskon_jenis"=>$diskon_jenis
										);
										$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id' AND drawat_rawat='$dtj_nonmedis_perawatan' AND drawat_date_create LIKE '$date_now%'";
										$rs=$this->db->query($sql);
										if(!$rs->num_rows()){
											$this->db->insert('detail_jual_rawat', $data_dtj_nonmedis);
										}
									}
									
									if($this->db->affected_rows()){
										/* Karena STATUS di menu tindakan sudah berubah ke 'selesai', maka db.appointment_detail di-LOCK */
										$data_dapp_locked=array(
										"dapp_locked"=>1
										);
										$this->db->where('dapp_id', $dtrawat_dapp);
										$this->db->update('appointment_detail', $data_dapp_locked);
									}
								}else if($cust_member==""){
									$diskon_jenis="DU";
									
									$data_djrawat=array(
									"drawat_master"=>$jrawat_id,
									"drawat_dtrawat"=>$dtrawat_id,
									"drawat_rawat"=>$dtrawat_perawatan_id,
									"drawat_jumlah"=>1,
									"drawat_harga"=>$rawat_harga,
									"drawat_diskon"=>$rawat_du,
									"drawat_diskon_jenis"=>$diskon_jenis
									);
									$this->db->insert('detail_jual_rawat', $data_djrawat);
									
									/* Checking di db.tindakan_detail WHERE tindakan_detail.dtrawat_master = $trawat_id 
									 * AND kategori = 'Non Medis',
									 * JIKA "ada" ini artinya di menu Tindakan Medis juga menjual Tindakan Non-Medis
									 */
									$sql="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_keterangan,rawat_harga,rawat_du FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='$trawat_id' AND kategori_nama='Non Medis'";
									$rs=$this->db->query($sql);
									if($rs->num_rows()){
										/* hasilnya "ADA", maka akan ditambahkan ke db.detail_jual_rawat */
										$rs_record=$rs->row_array();
										$dtj_nonmedis_perawatan=$rs_record["dtrawat_perawatan"];
										$dtj_nonmedis_rawat_harga=$rs_record["rawat_harga"];
										$dtj_nonmedis_rawat_du=$rs_record["rawat_du"];
										$data_dtj_nonmedis=array(
										"drawat_master"=>$jrawat_id,
										"drawat_dtrawat"=>$dtrawat_id,
										"drawat_rawat"=>$dtj_nonmedis_perawatan,
										"drawat_jumlah"=>1,
										"drawat_harga"=>$dtj_nonmedis_rawat_harga,
										"drawat_diskon"=>$dtj_nonmedis_rawat_du,
										"drawat_diskon_jenis"=>$diskon_jenis
										);
										$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id' AND drawat_rawat='$dtj_nonmedis_perawatan' AND drawat_date_create LIKE '$date_now%'";
										$rs=$this->db->query($sql);
										if(!$rs->num_rows()){
											$this->db->insert('detail_jual_rawat', $data_dtj_nonmedis);
										}
									}
									
									/* Karena STATUS di menu tindakan sudah berubah ke 'selesai', 
									 * maka db.appointment_detail di-LOCK 
									 */
									if($this->db->affected_rows()){
										$data_dapp_locked=array(
										"dapp_locked"=>1
										);
										$this->db->where('dapp_id', $dtrawat_dapp);
										$this->db->update('appointment_detail', $data_dapp_locked);
									}
								}
							}else{ /* artinya: di db.master_jual_rawat BELUM ADA */
								/* INSERT to db.master_jual_rawat AND table.detail_jual_rawat */
								$pattern="PR/".date("ym")."-";
								$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
								$data_jrawat=array(
								"jrawat_nobukti"=>$jrawat_nobukti,
								"jrawat_cust"=>$trawat_cust_id,
								"jrawat_tanggal"=>$date_now
								);
								$this->db->insert('master_jual_rawat', $data_jrawat);
								if($this->db->affected_rows()){
									/* INSERT to db.detail_jual_rawat */
									$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
									$rs=$this->db->query($sql);
									if($rs->num_rows()){
										$rs_record=$rs->row_array();
										$jrawat_id=$rs_record["jrawat_id"];
									}
									
									if($cust_member!=""){
										$diskon_jenis="DM";
										
										$data_djrawat=array(
										"drawat_master"=>$jrawat_id,
										"drawat_dtrawat"=>$dtrawat_id,
										"drawat_rawat"=>$dtrawat_perawatan_id,
										"drawat_jumlah"=>1,
										"drawat_harga"=>$rawat_harga,
										"drawat_diskon"=>$rawat_dm,
										"drawat_diskon_jenis"=>$diskon_jenis
										);
										$this->db->insert('detail_jual_rawat', $data_djrawat);
										
										/* Checking di db.tindakan_detail WHERE tindakan_detail.dtrawat_master = $trawat_id 
										 * AND kategori = 'Non Medis',
										 * JIKA "ada" ini artinya di menu Tindakan Medis juga menjual Tindakan Non-Medis
										 */
										$sql="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_keterangan,rawat_harga,rawat_dm FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='$trawat_id' AND kategori_nama='Non Medis'";
										$rs=$this->db->query($sql);
										if($rs->num_rows()){
											/* hasilnya "ADA", maka akan ditambahkan ke db.detail_jual_rawat */
											$rs_record=$rs->row_array();
											$dtj_nonmedis_perawatan=$rs_record["dtrawat_perawatan"];
											$dtj_nonmedis_rawat_harga=$rs_record["rawat_harga"];
											$dtj_nonmedis_rawat_dm=$rs_record["rawat_dm"];
											$data_dtj_nonmedis=array(
											"drawat_master"=>$jrawat_id,
											"drawat_dtrawat"=>$dtrawat_id,
											"drawat_rawat"=>$dtj_nonmedis_perawatan,
											"drawat_jumlah"=>1,
											"drawat_harga"=>$dtj_nonmedis_rawat_harga,
											"drawat_diskon"=>$dtj_nonmedis_rawat_dm,
											"drawat_diskon_jenis"=>$diskon_jenis
											);
											$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id' AND drawat_rawat='$dtj_nonmedis_perawatan' AND drawat_date_create LIKE '$date_now%'";
											$rs=$this->db->query($sql);
											if(!$rs->num_rows()){
												$this->db->insert('detail_jual_rawat', $data_dtj_nonmedis);
											}
										}
										
										if($this->db->affected_rows()){
											$data_dapp_locked=array(
											"dapp_locked"=>1
											);
											$this->db->where('dapp_id', $dtrawat_dapp);
											$this->db->update('appointment_detail', $data_dapp_locked);
										}
									}else if($cust_member==""){
										$diskon_jenis="DU";
										
										$data_djrawat=array(
										"drawat_master"=>$jrawat_id,
										"drawat_dtrawat"=>$dtrawat_id,
										"drawat_rawat"=>$dtrawat_perawatan_id,
										"drawat_jumlah"=>1,
										"drawat_harga"=>$rawat_harga,
										"drawat_diskon"=>$rawat_du,
										"drawat_diskon_jenis"=>$diskon_jenis
										);
										$this->db->insert('detail_jual_rawat', $data_djrawat);
										
										/* Checking di db.tindakan_detail WHERE tindakan_detail.dtrawat_master = $trawat_id 
										 * AND kategori = 'Non Medis',
										 * JIKA "ada" ini artinya di menu Tindakan Medis juga menjual Tindakan Non-Medis
										 */
										$sql="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_keterangan,rawat_harga,rawat_du FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='$trawat_id' AND kategori_nama='Non Medis'";
										$rs=$this->db->query($sql);
										if($rs->num_rows()){
											/* hasilnya "ADA", maka akan ditambahkan ke db.detail_jual_rawat */
											$rs_record=$rs->row_array();
											$dtj_nonmedis_perawatan=$rs_record["dtrawat_perawatan"];
											$dtj_nonmedis_rawat_harga=$rs_record["rawat_harga"];
											$dtj_nonmedis_rawat_du=$rs_record["rawat_du"];
											$data_dtj_nonmedis=array(
											"drawat_master"=>$jrawat_id,
											"drawat_dtrawat"=>$dtrawat_id,
											"drawat_rawat"=>$dtj_nonmedis_perawatan,
											"drawat_jumlah"=>1,
											"drawat_harga"=>$dtj_nonmedis_rawat_harga,
											"drawat_diskon"=>$dtj_nonmedis_rawat_du,
											"drawat_diskon_jenis"=>$diskon_jenis
											);
											$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id' AND drawat_rawat='$dtj_nonmedis_perawatan' AND drawat_date_create LIKE '$date_now%'";
											$rs=$this->db->query($sql);
											if(!$rs->num_rows()){
												$this->db->insert('detail_jual_rawat', $data_dtj_nonmedis);
											}
										}
										
										if($this->db->affected_rows()){
											$data_dapp_locked=array(
											"dapp_locked"=>1
											);
											$this->db->where('dapp_id', $dtrawat_dapp);
											$this->db->update('appointment_detail', $data_dapp_locked);
										}
									}
								}
							}
						}else{ /* $dtrawat_status <> 'selesai' DAN db.tindakan_detail.dtrawat_status masih = 0 */
							/* Check di db.master_jual_rawat, apakah ada Customer yang telah masuk ke proses Kasir HARI INI
							 * JIKA "ada" di db.master_jual_rawat, maka di cari di db.detail_jual_rawat apakah detail tindakan juga telah masuk? 
							 * JIKA TELAH MASUK dan "ada" di db.detail_jual_rawat, maka harus di-DELETE
							 * JIKA "tidak ada" di db.detail_jual_rawat, maka yang ada di db.master_jual_rawat harus di-DELETE
							 */
							$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){ /* artinya: Customer telah masuk ke proses Kasir */
								$rs_record=$rs->row_array();
								/* ambil db.master_jual_rawat.jrawat_id 
								 * Untuk dicari Detailnya pada db.detail_jual_rawat
								 */
								$rs_record_jrawat_id=$rs_record['jrawat_id']; 
								$sql="SELECT * FROM detail_jual_rawat WHERE drawat_master='$rs_record_jrawat_id' AND drawat_rawat='$dtrawat_perawatan_id'";
								$rs=$this->db->query($sql);
								if($rs->num_rows()){ /* artinya: "ada" di db.detail_jual_rawat */
									/*$this->db->where('drawat_master',$rs_record_jrawat_id);
									$this->db->where('drawat_rawat',$dtrawat_perawatan_id);
									$this->db->like('drawat_date_create',$date_now,'after');*/
									$this->db->where('drawat_dtrawat', $dtrawat_id);
									$this->db->delete('detail_jual_rawat');
									if($this->db->affected_rows()){
										/* meng-UNLOCK db.appointment_detail */
										$data_dapp_locked=array(
										"dapp_locked"=>0
										);
										$this->db->where('dapp_id', $dtrawat_dapp);
										$this->db->update('appointment_detail', $data_dapp_locked);
									}
								}
								/* pengecheckan di db.detail_jual_rawat.drawat_master = $rs_record_jrawat_id (alias db.master_jual_rawat.jrawat_id)
								 * JIKA "tidak ada" di db.detail_jual_rawat, maka akan di-DELETE di daftar db.master_jual_rawat
								 */
								$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$rs_record_jrawat_id'";
								$rs=$this->db->query($sql);
								if(!$rs->num_rows()){
									$this->db->where('jrawat_id',$rs_record_jrawat_id);
									$this->db->delete('master_jual_rawat');
									/*if($this->db->affected_rows()){
										// meng-UNLOCK db.appointment_detail 
										$data_dapp_locked=array(
										"dapp_locked"=>0
										);
										$this->db->where('dapp_id', $dtrawat_dapp);
										$this->db->update('appointment_detail', $data_dapp_locked);
									}*/
								}
							}
						}
						return '1';
					}elseif($dtrawat_perawatan_awal<>$dtrawat_perawatan && $dtrawat_locked==0){ 
						/* ada perubahan pada db.tindakan_detail.dtrawat_perawatan,
						 * maka UPDATE db.tindakan_detail
						 */
						$data_dtindakan=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail',$data_dtindakan);
						if($this->db->affected_rows()){
							/* Check di db.detail_jual_rawat
							 * JIKA data pada db.tindakan_detail telah masuk ke db.detail_jual_rawat, 
							 * maka juga ada Editing pada db.detail_jual_rawat 
							 */
							$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_dtrawat='$dtrawat_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$data_drawat_dtrawat=array(
								"drawat_rawat"=>$dtrawat_perawatan
								);
								$this->db->where('drawat_dtrawat',$dtrawat_id);
								$this->db->update('detail_jual_rawat',$data_drawat_dtrawat);
							}
						}
						return '1';
					}elseif($dtrawat_terapis_awal<>$dtrawat_terapis && $dtrawat_locked==0){ /* ada perubahan pada db.tindakan_detail.dtrawat_petugas2 */
						/* UPDATE db.tindakan_detail  */
						$data_dtindakan=array(
						"dtrawat_petugas2"=>$dtrawat_terapis
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail',$data_dtindakan);
						return '1';
					}elseif($dtrawat_keterangan_awal<>$dtrawat_keterangan && $dtrawat_locked==0){
						/* UPDATE db.tindakan_detail  */
						$data_dtindakan=array(
						"dtrawat_keterangan"=>$dtrawat_keterangan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail',$data_dtindakan);
						return '1';
					}elseif($dtrawat_locked==1){
						return '2';
					}else{
						return '1';
					}
				}else{
					return '0';
				}
			}else{
				return '1';
			}
		}
		
		//function for create new record
		function tindakan_create($trawat_cust ,$trawat_keterangan ){
			$time_now=date('H:i:s');
			$date_now=date('Y-m-d');
			$data = array(
				"trawat_cust"=>$trawat_cust, 
				"trawat_jamdatang"=>$time_now,
				"trawat_date_create"=>$date_now,
				"trawat_keterangan"=>$trawat_keterangan 
			);
			$this->db->insert('tindakan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function tindakan_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the tindakans at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM tindakan WHERE trawat_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM tindakan WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "trawat_id= ".$pkid[$i];
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
		function tindakan_search($trawat_id ,$trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_terapis ,$trawat_status ,$start,$end){
			//full query
			//$query="SELECT trawat_id,trawat_cust,cust_nama,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis'";
			$query = "SELECT * FROM vu_tindakan WHERE (kategori_nama='Non Medis' AND dtrawat_petugas2!='0')";
			
			if($trawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_id LIKE '%".$trawat_id."%'";
			};
			if($trawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
			};
			if($trawat_rawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_perawatan LIKE '%".$trawat_rawat."%'";
			};
			if($trawat_terapis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_petugas2 LIKE '%".$trawat_terapis."%'";
			};
			if($trawat_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_status LIKE '%".$trawat_status."%'";
			};
			if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_tglapp='".$trawat_tglapp_start."'";
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
		
		//function for print record
		function tindakan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function tindakan_export_excel($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>