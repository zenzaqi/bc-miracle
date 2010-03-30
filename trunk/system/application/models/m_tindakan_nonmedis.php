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
	
	/* DELETE db.master_jual_rawat IF jrawat_id TIDAK ADA di daftar db.detail_jual_rawat.drawat_master */
	function master_jual_rawat_delete($jrawat_id){
		$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id'";
		$rs=$this->db->query($sql);
		if(!$rs->num_rows()){
			$this->db->where('jrawat_id',$jrawat_id);
			$this->db->delete('master_jual_rawat');
		}
	}
	/* END delete db.master_jual_rawat */
	
	/* DELETE db.detail_jual_rawat IF jrawat_id TIDAK ADA di daftar db.detail_jual_rawat.drawat_master */
	function detail_jual_rawat_delete($dtrawat_id, $dtrawat_dapp){
		/* ambil nilai $jrawat_id */
		$sql="SELECT drawat_master FROM detail_jual_rawat WHERE drawat_dtrawat='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$jrawat_id=$rs_record["drawat_master"];
			$this->db->where('drawat_dtrawat', $dtrawat_id);
			$this->db->delete('detail_jual_rawat');
			if($this->db->affected_rows()){
				$this->master_jual_rawat_delete($jrawat_id);
				
				$dtu_dapp=array(
				"dapp_locked"=>0
				);
				$this->db->where('dapp_id', $dtrawat_dapp);
				$this->db->update('appointment_detail', $dtu_dapp);
			}
		}
	}
	/* eof detail_jual_rawat_delete */
	
	/* INSERT ke db.detail_jual_rawat */
	function detail_jual_rawat_insert($trawat_id, $cust_member, $trawat_cust_id, $dtrawat_id, $dtrawat_perawatan_id, $rawat_harga, $rawat_dm, $rawat_du, $dtrawat_dapp){
		/*
		1. check di master_jual_rawat, apakah customer ini pada hari sekarang sudah masuk ke Kasir
		2. JIKA customer ini sudah 'ada' di db.master_jual_rawat ==> INSERT ke db.detail_jual_rawat
		3. JIKA customer ini belum 'ada' di db.master_jual_rawat ==> INSERT ke db.master_jual_rawat AND db.detail_jual_rawat
		4. Proses insert ke db.detail_jual_rawat ini artinya status di db.tindakan_detail.status adalah ='selesai', sehingga db.appointment_detail harus di-LOCKED
		*/
		$date_now=date('Y-m-d');
		
		if($cust_member!=""){
			$diskon_jenis="DM";
			$diskon=$rawat_dm;
		}elseif($cust_member==""){
			$diskon_jenis="DU";
			$diskon=$rawat_du;
		}
		
		$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			/* artinya: customer yang dimaksud 'sudah masuk' di db.master_jual_rawat pada hari ini
			 * maka Hanya INSERT ke db.detail_jual_rawat
			 */
			$rs_record=$rs->row_array();
			$jrawat_id=$rs_record["jrawat_id"];
			$dti_drawat=array(
			"drawat_master"=>$jrawat_id,
			"drawat_dtrawat"=>$dtrawat_id,
			"drawat_rawat"=>$dtrawat_perawatan_id,
			"drawat_jumlah"=>1,
			"drawat_harga"=>$rawat_harga,
			"drawat_diskon"=>$diskon,
			"drawat_diskon_jenis"=>$diskon_jenis
			);
			$this->db->insert('detail_jual_rawat', $dti_drawat);
			if($this->db->affected_rows()){
				/* Karena db.tindakan_detail.status sudah 'selesai' ==> db.appointment_detail di-LOCKED */
				$dtu_dapp=array(
				"dapp_locked"=>1
				);
				$this->db->where('dapp_id', $dtrawat_dapp);
				$this->db->update('appointment_detail', $dtu_dapp);
			}
		}else{ 
			/* artinya: di db.master_jual_rawat BELUM ADA */
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
				
				$dti_drawat=array(
				"drawat_master"=>$jrawat_id,
				"drawat_dtrawat"=>$dtrawat_id,
				"drawat_rawat"=>$dtrawat_perawatan_id,
				"drawat_jumlah"=>1,
				"drawat_harga"=>$rawat_harga,
				"drawat_diskon"=>$diskon,
				"drawat_diskon_jenis"=>$diskon_jenis
				);
				$this->db->insert('detail_jual_rawat', $dti_drawat);
				if($this->db->affected_rows()){
					/* Karena db.tindakan_detail.status sudah 'selesai' ==> db.appointment_detail di-LOCKED */
					$dtu_dapp=array(
					"dapp_locked"=>1
					);
					$this->db->where('dapp_id', $dtrawat_dapp);
					$this->db->update('appointment_detail', $dtu_dapp);
				}
			}
		}
	}
	/* eof detail_jual_rawat_insert */
	
	/* UPDATE db.detail_jual_rawat */
	function detail_jual_rawat_update($dtrawat_perawatan, $dtrawat_id, $cust_member){
		/* ambil data detail dari $dtrawat_perawatan */
		$sql="SELECT rawat_harga, rawat_dm, rawat_du FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$rawat_harga=$rs_record["rawat_harga"];
			if($cust_member!=""){
				$diskon_jenis="DM";
				$diskon=$rs_record["rawat_dm"];
			}elseif($cust_member==""){
				$diskon_jenis="DU";
				$diskon=$rs_record["rawat_du"];
			}
		}
		
		$dtu_drawat=array(
		"drawat_rawat"=>$dtrawat_perawatan,
		"drawat_harga"=>$rawat_harga,
		"drawat_diskon"=>$diskon,
		"drawat_diskon_jenis"=>$diskon_jenis
		);
		$this->db->where('drawat_dtrawat', $dtrawat_id);
		$this->db->update('detail_jual_rawat', $dtu_drawat);
	}
	/* eof detail_jual_rawat_update */
		
	function having_cust_member_checking($cust_id){
		$sql="SELECT cust_member FROM customer WHERE cust_id='$cust_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$cust_member=$rs_record["cust_member"];
			return $cust_member;
		}else{
			return '';
		}
	}
	
	/* INSERT ke db.detail_ambil_paket */
	function detail_ambil_paket_insert($apaket_id, $sapaket_id, $trawat_cust, $dtrawat_id, $dtrawat_dapp){
		$dti_dapaket=array(
		"dapaket_master"=>$apaket_id,
		"dapaket_sapaket"=>$sapaket_id,
		"dapaket_jumlah"=>1,
		"dapaket_cust"=>$trawat_cust,
		"dapaket_dtrawat"=>$dtrawat_id
		);
		$this->db->insert('detail_ambil_paket', $dti_dapaket);
		if($this->db->affected_rows()){
			/* me-LOCKED db.appointment_detail */
			$dtu_dapp=array(
			"dapp_locked"=>1
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
			
			/* UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'true' */
			$dtu_dtrawat=array(
			"dtrawat_ambil_paket"=>'true'
			);
			$this->db->where('dtrawat_id', $dtrawat_id);
			$this->db->update('tindakan_detail', $dtu_dtrawat);
			
			$this->total_sisa_paket_update($apaket_id, $sapaket_id);
		}
	}
	/* eof detail_ambil_paket_insert */
	
	/* UPDATE db.submaster_apaket_item.sapaket_sisa_item AND db.master_ambil_paket.apaket_sisa_paket */
	function total_sisa_paket_update($apaket_id, $sapaket_id){
		/* UPDATE db.submaster_apaket_item.sapaket_sisa_item */
		$sql_sisa_item="SELECT sapaket_id, IF((sapaket_jmlisi_item-(IF(sum(dapaket_jumlah)!='null',sum(dapaket_jumlah),0)))!='null', (sapaket_jmlisi_item-(IF(sum(dapaket_jumlah)!='null',sum(dapaket_jumlah),0))), 0) as total_sisa_item FROM submaster_apaket_item LEFT JOIN detail_ambil_paket ON(dapaket_sapaket=sapaket_id) WHERE sapaket_id='$sapaket_id' GROUP BY sapaket_id";
		$rs_sisa_item=$this->db->query($sql_sisa_item);
		if($rs_sisa_item->num_rows()){
			/* UPDATE db.submaster_apaket_item.sapaket_sisa_item */
			$rs_sisa_item_record=$rs_sisa_item->row_array();
			$total_sisa_item=$rs_sisa_item_record["total_sisa_item"];
			$dtu_sapaket=array(
			"sapaket_sisa_item"=>$total_sisa_item
			);
			$this->db->where('sapaket_id', $sapaket_id);
			$this->db->update('submaster_apaket_item', $dtu_sapaket);
			if($this->db->affected_rows()){
				/* UPDATE db.master_ambil_paket.apaket_sisa_paket */
				//$sql_sisa_paket="SELECT apaket_id, IF((apaket_paket_jumlah-(sum(dapaket_jumlah)))!='null', (apaket_paket_jumlah-(sum(dapaket_jumlah))), 0) as total_sisa_paket FROM master_ambil_paket LEFT JOIN detail_ambil_paket ON(dapaket_master=apaket_id) WHERE apaket_id='$apaket_id' GROUP BY apaket_id";
				$sql_sisa_paket="SELECT apaket_id, sum(sapaket_sisa_item) as total_sisa_paket FROM master_ambil_paket LEFT JOIN submaster_apaket_item ON(sapaket_master=apaket_id) WHERE apaket_id='$apaket_id' GROUP BY apaket_id";
				$rs_sisa_paket=$this->db->query($sql_sisa_paket);
				if($rs_sisa_paket->num_rows()){
					/* UPDATE db.master_ambil_paket.apaket_sisa_paket */
					$rs_sisa_paket_record=$rs_sisa_paket->row_array();
					$total_sisa_paket=$rs_sisa_paket_record["total_sisa_paket"];
					$dtu_apaket=array(
					"apaket_sisa_paket"=>$total_sisa_paket
					);
					$this->db->where('apaket_id', $apaket_id);
					$this->db->update('master_ambil_paket', $dtu_apaket);
				}
			}
		}
	}
	
	/* INSERT ke db.detail_ambil_paket */
	function detail_ambil_paket_delete($dtrawat_id, $dtrawat_dapp){
		$sql="SELECT dapaket_master, dapaket_sapaket FROM detail_ambil_paket WHERE dapaket_dtrawat='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$apaket_id=$rs_record["dapaket_master"];
			$sapaket_id=$rs_record["dapaket_sapaket"];
		}
		
		$this->db->where('dapaket_dtrawat', $dtrawat_id);
		$this->db->delete('detail_ambil_paket');
		if($this->db->affected_rows()){
			/* meng-UNLOCK db.appointment_detail */
			$dtu_dapp=array(
			"dapp_locked"=>0
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
			
			$this->total_sisa_paket_update($apaket_id, $sapaket_id);
		}
	}
	/* eof detail_ambil_paket_delete */
	
	//purge all detail from master
	function detail_tindakan_nonmedis_detail_purge($master_id){
		$sql="DELETE from tindakan_detail where dtrawat_master='".$master_id."'";
		$result=$this->db->query($sql);
	}
	//*eof
	
	function detail_tindakan_nonmedis_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jamreservasi ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan ,$dtrawat_ambil_paket ,$dtrawat_cust){
		/* hanya INSERT record tindakan_detail-nonmedis yang baru */
		$date_now=date('Y-m-d');
		if(!is_numeric($dtrawat_id)){
			$dti_dtrawat=array(
			"dtrawat_master"=>$dtrawat_master,
			"dtrawat_perawatan"=>$dtrawat_perawatan,
			"dtrawat_petugas2"=>$dtrawat_petugas2,
			"dtrawat_tglapp"=>$date_now,
			"dtrawat_jam"=>$dtrawat_jamreservasi,
			"dtrawat_keterangan"=>$dtrawat_keterangan
			);
			$this->db->insert('tindakan_detail', $dti_dtrawat);
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
				return 'Detail telah berhasil ditambahkan';
			}
		}
		
		$sql="SELECT dtrawat_id,dtrawat_locked,dtrawat_perawatan,dtrawat_petugas2,dtrawat_jam,dtrawat_keterangan FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$dtrawat_locked=$rs_record["dtrawat_locked"];
			$dtrawat_perawatan_awal=$rs_record["dtrawat_perawatan"];
			$dtrawat_petugas2_awal=$rs_record["dtrawat_petugas2"];
			$dtrawat_jam_awal=$rs_record["dtrawat_jam"];
			$dtrawat_keterangan_awal=$rs_record["dtrawat_keterangan"];
			/*
			# ini artinya: record detail tindakan sudah ada di db.tindakan_detail, sehingga yg bisa dilakukan adalah EDITING record detail JIKA UNLOCK
			1. Check $dtrawat_status, JIKA ='selesai' ==> sudah masuk ke Kasir, JIKA !='selesai' ==> belum masuk ke Kasir manapun
			2. JIKA $dtrawat_status='selesai' ==> check db.tindakan_detail.dtrawat_locked [1/0]
			3. JIKA db.tindakan_detail.dtrawat_locked=0 ==> BOLEH di-EDIT
			4. JIKA $dtrawat_status!='selesai' ==> silakan di-EDIT
			*/
			if($dtrawat_locked==0 && ($dtrawat_perawatan_awal<>$dtrawat_perawatan || $dtrawat_petugas2_awal<>$dtrawat_petugas2 || $dtrawat_jam_awal<>$dtrawat_jamreservasi || $dtrawat_keterangan_awal<>$dtrawat_keterangan)){
				/* ini berarti: ada field yg berubah untuk dilakukan editing */
				$dtu_dtrawat=array(
				"dtrawat_perawatan"=>$dtrawat_perawatan,
				"dtrawat_petugas2"=>$dtrawat_petugas2,
				"dtrawat_jam"=>$dtrawat_jamreservasi,
				"dtrawat_keterangan"=>$dtrawat_keterangan
				);
				$this->db->where('dtrawat_id', $dtrawat_id);
				$this->db->update('tindakan_detail', $dtu_dtrawat);
			}
		}
	}
	
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
	function tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_terapis ,$dtrawat_terapis_id ,$dtrawat_keterangan ,$dtrawat_dapp ,$dtrawat_ambil_paket ,$apaket_id ,$sapaket_id ,$sapaket_item ,$mode_edit){
		
		/* Checking db.tindakan_detail WHERE db.tindakan_detail.dtrawat_id = $dtrawat_id DAN semua Field,
		 * JIKA ada salah satu Field yang berubah maka akan di-UPDATE
		 */ 
		$data_tindakan=array(
		"trawat_keterangan"=>$trawat_keterangan
		);
		$this->db->where("trawat_id", $trawat_id);
		$this->db->update("tindakan", $data_tindakan);
		
		if($mode_edit=="update_list"){
			$sql_check="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_status,dtrawat_petugas2,dtrawat_keterangan,dtrawat_ambil_paket,dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
			$rs_check=$this->db->query($sql_check);
			if($rs_check->num_rows()){
				$rs_check_record=$rs_check->row_array();
				$dtrawat_locked=$rs_check_record["dtrawat_locked"];
				$dtrawat_perawatan_awal=$rs_check_record["dtrawat_perawatan"];
				$dtrawat_terapis_awal=$rs_check_record["dtrawat_petugas2"];
				$dtrawat_keterangan_awal=$rs_check_record["dtrawat_keterangan"];
				$dtrawat_status_awal=$rs_check_record["dtrawat_status"];
				$dtrawat_ambil_paket_awal=$rs_check_record["dtrawat_ambil_paket"];
				
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
				
				if($dtrawat_status_awal<>$dtrawat_status && $dtrawat_locked==0){ 
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
					
					
					if($dtrawat_status_awal!='selesai' && $dtrawat_status=='selesai' && $dtrawat_ambil_paket=='true'){
						/* 
						# status ['!selesai'>>'selesai']: ini artinya bahwa customer dengan perawatan yang terpilih belum masuk ke Kasir manapun dan akan dimasukkan ke Kasir.
						# kemudian checkbox "ambil paket" = 'true', maka ini berarti Customer dengan perawatan yg terpilih sudah di-check kepemilikan paketnya dan memang benar dia punya paket itu, tp untuk akurasi di-check kembali kepemilikan paketnya sebelum dimasukkan ke Kasir Pengambilan Paket:
						1. Checking kepemilikan paket => db.vu_tindakan.cust_punya_paket='ada'
						2. INSERT ke db.detail_ambil_paket
						3. UPDATE db.tindakan_detail.status = 'selesai' ==> sudah dilakukan sebelum masuk fungsi IF ini
						*/
						$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$this->detail_ambil_paket_insert($apaket_id, $sapaket_id, $trawat_cust_id, $dtrawat_id, $dtrawat_dapp);
							return '1';
						}
					}elseif($dtrawat_status_awal!='selesai' && $dtrawat_status=='selesai' && $dtrawat_ambil_paket=='false'){
						/*
						# status ['!selesai'>>'selesai']: ini artinya bahwa customer dengan perawatan yang terpilih belum masuk ke Kasir manapun dan akan dimasukkan ke Kasir.
						# kemudian checkbox "ambil paket" = 'false', maka ini berarti Customer dengan perawatan yg terpilih akan dimasukkan ke Kasir Perawatan:
						1. INSERT ke db.detail_jual_rawat
						2. UPDATE db.tindakan_detail.status = 'selesai' ==> sudah dilakukan sebelum masuk fungsi IF ini
						*/
						$this->detail_jual_rawat_insert($trawat_id, $cust_member, $trawat_cust_id, $dtrawat_id, $dtrawat_perawatan_id, $rawat_harga, $rawat_dm, $rawat_du, $dtrawat_dapp);
						return '1';
						
					}elseif($dtrawat_status_awal=='selesai' && $dtrawat_status!='selesai' && $dtrawat_ambil_paket=='true'){
						/*
						# status ['selesai'>>'!selesai']: ini artinya bahwa sebelumnya customer dengan perawatan yang terpilih ini sudah masuk ke Kasir.
						# kemudian checkbox "ambil paket" = 'true', maka ini berarti masuk ke Kasir Pengambilan Paket:
						1. DELETE dari db.detail_ambil_paket
						2. UPDATE db.tindakan_detail.status = '!selesai' ==> sudah dilakukan sebelum fungsi IF ini
						3. meng-UNLOCK db.appointment_detail.dapp_locked
						*/
						$this->detail_ambil_paket_delete($dtrawat_id, $dtrawat_dapp);
						return '1';
					}elseif($dtrawat_status_awal=='selesai' && $dtrawat_status!='selesai' && $dtrawat_ambil_paket=='false'){
						/*
						# status ['selesai'>>'!selesai']: ini artinya bahwa sebelumnya customer dengan perawatan yang terpilih ini sudah masuk ke Kasir.
						# kemudian checkbox "ambil paket" = 'false', maka ini berarti masuk ke Kasir Perawatan:
						1. DELETE dari detail_jual_paket
						2. UPDATE db.tindakan_detail.status = '!selesai' ==> sudah dilakukan sebelum fungsi IF ini
						3. meng-UNLOCK db.appointment_detail.dapp_locked
						*/
						$this->detail_jual_rawat_delete($dtrawat_id, $dtrawat_dapp);
						return '1';
					}
					return '1';
				}elseif($dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true' && $dtrawat_status_awal=='selesai'){
					/*
					# status='selesai': ini artinya bahwa customer dengan perawatan yang terpilih sudah masuk ke Kasir Perawatan.
					# kemudian checkbox "ambil paket" diganti dari [false ke true], maka ini berarti perawatan saat tindakan-perawatan ini akan diambilkan dari Paket yang dimiliki Customer sehingga secara otomatis akan memindahkan dari yg sebelumnya di Kasir Perawatan ke Kasir Pengambilan Paket:
					1. Checking kepemilikan paket => db.vu_tindakan.cust_punya_paket='ada'
					2. DELETE dari detail_jual_rawat
					3. INSERT ke db.detail_ambil_paket
					4. UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'true'
					*/
					$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$this->detail_jual_rawat_delete($dtrawat_id, $dtrawat_dapp);
						/* 3. INSERT ke db.detail_ambil_paket */
						$this->detail_ambil_paket_insert($apaket_id, $sapaket_id, $trawat_cust_id, $dtrawat_id, $dtrawat_dapp);
						return '1';
					}else{
						return '0';
					}
				}elseif($dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true' && $dtrawat_status_awal!='selesai'){
					/*
					# status='!selesai': ini artinya bahwa customer dengan perawatan yang terpilih belum masuk ke Kasir manapun.
					# kemudian checkbox "ambil paket" diganti dari [false ke true], maka ini berarti perawatan saat tindakan-perawatan ini akan diambilkan dari Paket yang dimiliki Customer ketika statusnya nanti berubah ke 'selesai':
					1. Checking kepemilikan paket => db.vu_tindakan.cust_punya_paket='ada'
					2. UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'true'
					*/
					$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$dtu_dtrawat=array(
						"dtrawat_ambil_paket"=>'true'
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail', $dtu_dtrawat);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}else{
						return '0';
					}
				}elseif($dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false' && $dtrawat_status_awal=='selesai'){
					/*
					# status='selesai' && checkbox "ambil paket" sebelumnya 'true': ini berarti customer dengan perawatan yang terpilih sudah masuk ke Kasir Pengambilan Paket.
					# kemudian checkbox "ambil paket" diganti dari [true ke false], maka ini berarti Pengambilan Paket di-Batal-kan, dan secara otomatis akan memindahkan dari yg sebelumnya di Kasir Pengambilan Paket ke Kasir Perawatan:
					1. UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'false'
					2. DELETE dari db.detail_ambil_paket
					3. INSERT ke db.detail_jual_rawat
					*/
					$dtu_dtrawat=array(
					"dtrawat_ambil_paket"=>'false'
					);
					$this->db->where('dtrawat_id', $dtrawat_id);
					$this->db->update('tindakan_detail', $dtu_dtrawat);
					
					$this->detail_ambil_paket_delete($dtrawat_id, $dtrawat_dapp);
					
					$this->detail_jual_rawat_insert($trawat_id, $cust_member, $trawat_cust_id, $dtrawat_id, $dtrawat_perawatan_id, $rawat_harga, $rawat_dm, $rawat_du, $dtrawat_dapp);
					return '1';
					
				}elseif($dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false' && $dtrawat_status_awal!='selesai'){
					/*
					# status='!selesai': ini berarti customer dengan perawatan yang terpilih belum masuk ke Kasir manapun.
					# kemudian checkbox "ambil paket" diganti dari [true ke false], maka:
					1. UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'false'
					*/
					$dtu_dtrawat=array(
					"dtrawat_ambil_paket"=>'false'
					);
					$this->db->where('dtrawat_id', $dtrawat_id);
					$this->db->update('tindakan_detail', $dtu_dtrawat);
					if($this->db->affected_rows()){
						return '1';
					}else{
						return '0';
					}
					
				}elseif($dtrawat_perawatan_awal<>$dtrawat_perawatan && $dtrawat_locked==0){
					if($dtrawat_ambil_paket=='true' && $dtrawat_status=='selesai'){
						/*
						# ini berarti tindakan perawatan ini sudah masuk ke Kasir Pengambilan Paket, maka:
						1. Checking kepemilikan paket ==> db.vu_tindakan.cust_punya_paket='ada'
						2. JIKA 'ada' ==> UPDATE db.tindakan_detail.dtrawat_perawatan <= [rawat_id pengganti = $dtrawat_perawatan], JIKA 'tidak ada' ==> message
						3. UPDATE db.detail_ambil_paket <= [rawat_id pengganti = $dtrawat_perawatan]
						*/
						$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/* UPDATE db.tindakan_detail */
							$dtu_dtrawat=array(
							"dtrawat_perawatan"=>$dtrawat_perawatan
							);
							$this->db->where('dtrawat_id', $dtrawat_id);
							$this->db->update('tindakan_detail', $dtu_dtrawat);
							/* UPDATE db.detail_ambil_paket */
							$rs_record=$rs->row_array();
							$sapaket_id=$rs_record["sapaket_id"];
							$apaket_id=$rs_record["apaket_id"];
							$dtu_hapaket=array(
							"dapaket_master"=>$apaket_id,
							"dapaket_sapaket"=>$sapaket_id
							);
							$this->db->where('dapaket_dtrawat', $dtrawat_id);
							$this->db->update('detail_ambil_paket', $dtu_hapaket);
							if($this->db->affected_rows()){
								$this->total_sisa_paket_update($apaket_id, $sapaket_id);
							}
							return '1';
						}else{
							return '0';
						}
					}elseif($dtrawat_ambil_paket=='true' && $dtrawat_status!='selesai'){
						/*
						# ini artinya tindakan perawatan ini belum masuk ke Kasir manapun:
						1. UDPATE db.tindakan_detail.dtrawat_perawatan = [rawat_id pengganti]
						*/
						$dtu_dtrawat=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail', $dtu_dtrawat);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}elseif($dtrawat_ambil_paket=='false' && $dtrawat_status=='selesai'){
						/*
						# ini artinya: dari status='selesai', perawatan sebelum diganti sudah masuk ke Kasir Perawatan.
						# untuk itu:
						1. UPDATE db.tindakan_detail.dtrawat_rawat = [rawat_id pengganti]
						2. UPDATE Kasir Perawatan WHERE db.detail_jual_rawat.drawat_dtrawat = db.tindakan_detail.dtrawat_id
						*/
						$dtu_dtrawat=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail', $dtu_dtrawat);
						
						$this->detail_jual_rawat_update($dtrawat_perawatan, $dtrawat_id, $cust_member);
						return '1';
					}elseif($dtrawat_ambil_paket=='false' && $dtrawat_status!='selesai'){
						/*
						# ini artinya: perawatan ini belum masuk ke Kasir manapun, maka: 
						1. UPDATE db.tindakan_detail.dtrawat_perawatan saja =[rawat_id pengganti]
						*/
						$dtu_dtrawat=array(
						"dtrawat_perawatan"=>$dtrawat_perawatan
						);
						$this->db->where('dtrawat_id', $dtrawat_id);
						$this->db->update('tindakan_detail', $dtu_dtrawat);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
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
					/* ada perubahan keterangan_detail */
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