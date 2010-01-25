<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan Model
	+ Description	: For record model process back-end
	+ Filename 		: c_tindakan.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
*/

class M_tindakan_medis extends Model{
		
		//constructor
		function M_tindakan_medis() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_tindakan_detail_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM tindakan_detail,perawatan,karyawan WHERE dtrawat_perawatan=rawat_id AND dtrawat_petugas1=karyawan_id AND dtrawat_master='".$master_id."'";
			$query="SELECT * FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) INNER JOIN karyawan ON(dtrawat_petugas1=karyawan_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='".$master_id."' AND kategori_nama='Medis'";
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
		function detail_tindakan_medis_detail_purge($master_id){
			$sql="DELETE tindakan_detail FROM tindakan_detail INNER JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Medis' AND dtrawat_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_tindakan_medis_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jamreservasi ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan ){
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
				$rs_record=$rs->row_array();
				$dtrawat_locked=$rs_record["dtrawat_locked"];
				
				$sql="SELECT dtrawat_id FROM tindakan_detail WHERE dtrawat_perawatan='$dtrawat_perawatan' AND dtrawat_petugas1='$dtrawat_petugas1' AND dtrawat_jam='$dtrawat_jamreservasi' AND dtrawat_keterangan='$dtrawat_keterangan'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows() && $dtrawat_locked==0){
					$data=array(
					"dtrawat_perawatan"=>$dtrawat_perawatan,
					"dtrawat_petugas1"=>$dtrawat_petugas1,
					"dtrawat_jam"=>$dtrawat_jamreservasi,
					"dtrawat_keterangan"=>$dtrawat_keterangan
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
				"dtrawat_petugas1"=>$dtrawat_petugas1,
				"dtrawat_tglapp"=>$date_now,
				"dtrawat_jam"=>$dtrawat_jamreservasi,
				"dtrawat_keterangan"=>$dtrawat_keterangan
				);
				$this->db->insert('tindakan_detail', $data);
				if($this->db->affected_rows()){
					$bln_now=date('Y-m');
					/* meng-Counter db.report_tindakan dari Dokter yang dipilih */
					$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dtrawat_petugas1'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$data_reportt=array(
						"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
						);
						$this->db->where('reportt_karyawan_id', $dtrawat_petugas1);
						$this->db->update('report_tindakan', $data_reportt);
					}else if(!$rs->num_rows()){
						$data_reportt=array(
						"reportt_karyawan_id"=>$dtrawat_petugas1,
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
		
		/* START NON-MEDIS Function */
		function dtindakan_jual_nonmedis_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM tindakan_detail,perawatan,karyawan WHERE dtrawat_perawatan=rawat_id AND dtrawat_petugas1=karyawan_id AND dtrawat_master='".$master_id."'";
			$query="SELECT * FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='".$master_id."' AND kategori_nama='Non Medis' AND dtrawat_dapp='0'";
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
		
		function detail_tindakan_nonmedis_detail_purge($master_id){
			$sql="DELETE tindakan_detail FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE dtrawat_master='".$master_id."' AND kategori_nama='Non Medis'";
			$result=$this->db->query($sql);
		}
		
		function detail_dtindakan_jual_nonmedis_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_keterangan ,$customer_id ){
			//if master id not capture from view then capture it from max pk from master table
			if($dtrawat_master=="" || $dtrawat_master==NULL){
				$dtrawat_master=$this->get_master_id();
			}
			
			if(is_numeric($dtrawat_id)==false && is_numeric($dtrawat_perawatan)==true){
				$date_now=date('Y-m-d');
				$data = array(
					"dtrawat_master"=>$dtrawat_master, 
					"dtrawat_perawatan"=>$dtrawat_perawatan, 
					"dtrawat_keterangan"=>$dtrawat_keterangan,
					"dtrawat_tglapp"=>$date_now,
					"dtrawat_status"=>"selesai"
				);
				$this->db->insert('tindakan_detail', $data); 
				if($this->db->affected_rows()){
					//$sql="SELECT * FROM tindakan_detail WHERE dtrawat_master='$dtrawat_master' AND ";
					$sql="SELECT rawat_harga,rawat_dm,rawat_du FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$rawat_harga=$rs_record["rawat_harga"];
						$rawat_dm=$rs_record["rawat_dm"];
						$rawat_du=$rs_record["rawat_du"];
					}
					
					/* Chekc Customer_Member */
					$cust_member="";
					$sql="SELECT cust_member FROM customer WHERE cust_id='$customer_id'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$cust_member=$rs_record["cust_member"];
					}
					if($cust_member!=""){
						$drawat_diskon=$rawat_dm;
						$drawat_diskon_jenis="DM";
					}elseif($cust_member==""){
						$drawat_diskon=$rawat_du;
						$drawat_diskon_jenis="DU";
					}
					
					/* karena otomatis status jual_nonmedis = 'selesai', maka harus di-INSERT ke db.detail_jual_rawat */
					$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$customer_id' AND jrawat_tanggal='$date_now'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$jrawat_id=$rs_record["jrawat_id"];
						
						$data_to_drawat=array(
						"drawat_master"=>$jrawat_id,
						"drawat_rawat"=>$dtrawat_perawatan,
						"drawat_jumlah"=>1,
						"drawat_harga"=>$rawat_harga,
						"drawat_diskon"=>$drawat_diskon,
						"drawat_diskon_jenis"=>$drawat_diskon_jenis
						);
						$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id' AND drawat_rawat='$dtrawat_perawatan' AND drawat_date_create LIKE '$date_now%'";
						$rs=$this->db->query($sql);
						if(!$rs->num_rows()){
							$this->db->insert('detail_jual_rawat', $data_to_drawat);
						}
					}
				}
								
			}elseif(is_numeric($dtrawat_id)==true){
				$sql="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_petugas1,dtrawat_jam FROM tindakan_detail WHERE dtrawat_perawatan='$dtrawat_perawatan' AND dtrawat_petugas1='$dtrawat_petugas1' AND dtrawat_jam='$dtrawat_jam' AND dtrawat_id='$dtrawat_id'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows()){
					$data = array(
					"dtrawat_perawatan"=>$dtrawat_perawatan, 
					"dtrawat_keterangan"=>$dtrawat_keterangan
					);
					$this->db->where('dtrawat_id',$dtrawat_id);
					$this->db->update('tindakan_detail',$data);
				}
			}

		}
		/* END NON-MEDIS Function */
		
		//function for get list record
		function tindakan_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			//$query = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_dapp='0')";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query.=" AND dtrawat_status='siap'";
			
			//$query2 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query2 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query2 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_dapp='0')";
			
			// For simple search
			if ($filter<>""){
				$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
				$query2 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query2.=" AND dtrawat_status='datang'";
			
			//$query3 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query3 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query3 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_dapp='0')";
			
			// For simple search
			if ($filter<>""){
				$query3 .=eregi("WHERE",$query3)? " AND ":" WHERE ";
				$query3 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query3.=" AND dtrawat_status='selesai'";
			
			//$query4 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query4 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query4 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_dapp='0')";
			
			// For simple search
			if ($filter<>""){
				$query4 .=eregi("WHERE",$query4)? " AND ":" WHERE ";
				$query4 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query4.=" AND dtrawat_status='batal'";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			//$limit = $query." LIMIT ".$start.",".$end;		
			//$result = $this->db->query($limit);  
			$result2 = $this->db->query($query2);
			$nbrows2 = $result2->num_rows();
			
			$result3 = $this->db->query($query3);
			$nbrows3 = $result3->num_rows();
			
			$result4 = $this->db->query($query4);
			$nbrows4 = $result4->num_rows();
			
			if($nbrows>0 || $nbrows2>0 || $nbrows3>0 || $nbrows4>0){
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
				if($nbrows4>0){
					foreach($result4->result() as $row4){
						$arr[] = $row4;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for update record
		function tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_dokter ,$dtrawat_dokter_id ,$dtrawat_keterangan ,$dtrawat_dapp ,$mode_edit){
			/* Checking db.tindakan_detail WHERE db.tindakan_detail.dtrawat_id = $dtrawat_id DAN semua Field,
			 * JIKA ada salah satu Field yang berubah maka akan di-UPDATE
			 */ 
			$data_tindakan=array(
			"trawat_keterangan"=>$trawat_keterangan
			);
			$this->db->where("trawat_id", $trawat_id);
			$this->db->update("tindakan", $data_tindakan);
			
			if($mode_edit=="update_list"){
				$sql_check="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_status,dtrawat_petugas1,dtrawat_keterangan,dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
				$rs_check=$this->db->query($sql_check);
				if($rs_check->num_rows()){
					$rs_check_record=$rs_check->row_array();
					$dtrawat_locked=$rs_check_record["dtrawat_locked"];
					$dtrawat_perawatan_awal=$rs_check_record["dtrawat_perawatan"];
					$dtrawat_dokter_awal=$rs_check_record["dtrawat_petugas1"];
					$dtrawat_keterangan_awal=$rs_check_record["dtrawat_keterangan"];
					$dtrawat_status_awal=$rs_check_record["dtrawat_status"];
					
					$sql="SELECT rawat_id FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
					$rs=$this->db->query($sql);
					if($rs->num_rows())
						$dtrawat_perawatan=$dtrawat_perawatan;
					else 
						$dtrawat_perawatan=$dtrawat_perawatan_id;
					
					$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dtrawat_dokter'";
					$rs=$this->db->query($sql);
					if($rs->num_rows())
						$dtrawat_dokter=$dtrawat_dokter;
					else 
						$dtrawat_dokter=$dtrawat_dokter_id;
					
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
					}elseif($dtrawat_dokter_awal<>$dtrawat_dokter && $dtrawat_locked==0){ /* ada perubahan pada db.tindakan_detail.dtrawat_petugas1 */
						/* UPDATE db.tindakan_detail  */
						$data_dtindakan=array(
						"dtrawat_petugas1"=>$dtrawat_dokter
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
		function tindakan_search($trawat_id ,$trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_dokter ,$trawat_status ,$start,$end){
			//full query
			$query="SELECT trawat_id,trawat_cust,cust_nama,cust_no,dtrawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas1=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Medis'";
			
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
			if($trawat_dokter!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_petugas1 LIKE '%".$trawat_dokter."%'";
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