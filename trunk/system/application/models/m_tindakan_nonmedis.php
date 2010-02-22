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
		
	/* Checking kepemilikan Paket, dengan parameter:
	* 1. id_customer pengguna paket 
	* 2. id_perawatan dari perawatan yang telah dilakukan pada Tindakan Perawatan
	* 3. dengan syarat sisa perawatan masih >0
	*/
	/*function having_rpaket_checking($sjpaket_cust, $rpaket_perawatan){
		$sql="SELECT jpaket_nobukti, apaket_id, apaket_paket, apaket_sisa_paket FROM ((((submaster_jual_paket INNER JOIN master_jual_paket ON(sjpaket_master=jpaket_id)) INNER JOIN master_ambil_paket ON(jpaket_nobukti=apaket_faktur)) INNER JOIN paket ON(apaket_paket=paket_id)) INNER JOIN paket_isi_perawatan ON(paket_id=rpaket_master)) LEFT JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE sjpaket_cust='$sjpaket_cust' AND rpaket_perawatan='$rpaket_perawatan' AND apaket_sisa_paket>0 LIMIT 1";
		$rs=$this->db->query($sql);
		return $rs;
	}*/
	/* eof having_rpaket_checking */
	
	/* DELETE db.detail_ambil_paket yang otomatis akan UPDATE db.submaster_apaket_item.sapaket_sisa_item = +1 */
	/*function dapaket_sapaket_du($dapaket_dtrawat){
		$sql="UPDATE submaster_apaket_item INNER JOIN detail_ambil_paket ON(submaster_apaket_item.sapaket_master=detail_ambil_paket.dapaket_master AND submaster_apaket_item.sapaket_item=detail_ambil_paket.dapaket_item AND submaster_apaket_item.sapaket_jenis_item='perawatan') SET sapaket_sisa_item =((submaster_apaket_item.sapaket_sisa_item)+1) WHERE detail_ambil_paket.dapaket_dtrawat='$dapaket_dtrawat'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$this->db->where('dapaket_dtrawat',$dapaket_dtrawat);
			$this->db->delete('detail_ambil_paket');
		}
	}*/
	/* eof dapaket_sapaket_du */
	
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
	
	/* INSERT to Kasir Perawatan */
	function kasir_jual_rawat_i($jrawat_cust,$dtrawat_perawatan,$dtrawat_id){
		
		/*Checking di db.master_jual_rawat WHERE jrawat_cust=$trawat_cust_id AND jrawat_tanggal=$date_now 
		 * Jika SUDAH ADA maka INSERT hanya ke db.detail_jual_rawat
		 * Jika TIDAK ADA maka INSERT ke db.master_jual_rawat AND db.detail_jual_rawat
		 */
		$date_now=date('Y-m-d');
		
		$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$jrawat_cust' AND jrawat_tanggal='$date_now'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			/* artinya: di db.master_jual_rawat 'sudah ada', 
			 * maka Hanya INSERT ke db.detail_jual_rawat
			 */
			$rs_record=$rs->row_array();
			$jrawat_id=$rs_record["jrawat_id"];
			
			$sql="SELECT rawat_harga, rawat_dm, rawat_du FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$rawat_harga=$rs_record["rawat_harga"];
				$rawat_dm=$rs_record["rawat_dm"];
				$rawat_du=$rs_record["rawat_du"];
			}
			
			$cust_member=$this->having_cust_member_checking($jrawat_cust);
			if($cust_member!=""){
				$diskon_jenis="DM";
				
				$data_djrawat=array(
				"drawat_master"=>$jrawat_id,
				"drawat_dtrawat"=>$dtrawat_id,
				"drawat_rawat"=>$dtrawat_perawatan,
				"drawat_jumlah"=>1,
				"drawat_harga"=>$rawat_harga,
				"drawat_diskon"=>$rawat_dm,
				"drawat_diskon_jenis"=>$diskon_jenis
				);
				$this->db->insert('detail_jual_rawat', $data_djrawat);
				
			}else if($cust_member==""){
				$diskon_jenis="DU";
				
				$data_djrawat=array(
				"drawat_master"=>$jrawat_id,
				"drawat_dtrawat"=>$dtrawat_id,
				"drawat_rawat"=>$dtrawat_perawatan,
				"drawat_jumlah"=>1,
				"drawat_harga"=>$rawat_harga,
				"drawat_diskon"=>$rawat_du,
				"drawat_diskon_jenis"=>$diskon_jenis
				);
				$this->db->insert('detail_jual_rawat', $data_djrawat);
				
			}
		}else{ 
			/* artinya: di db.master_jual_rawat BELUM ADA */
			/* INSERT to db.master_jual_rawat AND table.detail_jual_rawat */
			$pattern="PR/".date("ym")."-";
			$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
			$data_jrawat=array(
			"jrawat_nobukti"=>$jrawat_nobukti,
			"jrawat_cust"=>$jrawat_cust,
			"jrawat_tanggal"=>$date_now
			);
			$this->db->insert('master_jual_rawat', $data_jrawat);
			if($this->db->affected_rows()){
				/* INSERT to db.detail_jual_rawat */
				$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$jrawat_cust' AND jrawat_tanggal='$date_now'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$jrawat_id=$rs_record["jrawat_id"];
				}
				
				$sql="SELECT rawat_harga, rawat_dm, rawat_du FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$rawat_harga=$rs_record["rawat_harga"];
					$rawat_dm=$rs_record["rawat_dm"];
					$rawat_du=$rs_record["rawat_du"];
				}
				
				$cust_member=$this->having_cust_member_checking($jrawat_cust);
				if($cust_member!=""){
					$diskon_jenis="DM";
					
					$data_djrawat=array(
					"drawat_master"=>$jrawat_id,
					"drawat_dtrawat"=>$dtrawat_id,
					"drawat_rawat"=>$dtrawat_perawatan,
					"drawat_jumlah"=>1,
					"drawat_harga"=>$rawat_harga,
					"drawat_diskon"=>$rawat_dm,
					"drawat_diskon_jenis"=>$diskon_jenis
					);
					$this->db->insert('detail_jual_rawat', $data_djrawat);
					
				}else if($cust_member==""){
					$diskon_jenis="DU";
					
					$data_djrawat=array(
					"drawat_master"=>$jrawat_id,
					"drawat_dtrawat"=>$dtrawat_id,
					"drawat_rawat"=>$dtrawat_perawatan,
					"drawat_jumlah"=>1,
					"drawat_harga"=>$rawat_harga,
					"drawat_diskon"=>$rawat_du,
					"drawat_diskon_jenis"=>$diskon_jenis
					);
					$this->db->insert('detail_jual_rawat', $data_djrawat);
				}
			}
		}
	
	}
	/* eof kasir_jual_rawat_i */
	
	/* INSERT to Kasir Pengambilan Paket */
	function kasir_ambil_paket_i($apaket_id, $apaket_paket, $dtrawat_perawatan, $dtrawat_cust, $dtrawat_id){
		/* sebelum insert ke db.detail_ambil_paket, tampung dulu db.submaster_apaket_item.sapaket_sisa_item */
		$sql="SELECT sapaket_sisa_item FROM submaster_apaket_item WHERE sapaket_master='$apaket_id' AND sapaket_item='$dtrawat_perawatan' AND sapaket_jenis_item='perawatan'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$sapaket_sisa_item_temp=$rs_record["sapaket_sisa_item"];
		}
		
		$dti_dapaket=array(
		"dapaket_master"=>$apaket_id,
		"dapaket_dpaket"=>$apaket_paket,
		"dapaket_item"=>$dtrawat_perawatan,
		"dapaket_jumlah"=>1,
		"dapaket_cust"=>$dtrawat_cust,
		"dapaket_dtrawat"=>$dtrawat_id
		);
		$this->db->insert('detail_ambil_paket', $dti_dapaket);
		if($this->db->affected_rows()){
			/* UPDATE db.master_ambil_paket.apaket_sisa_paket = -1 */
			$dtu_sapaket=array(
			"sapaket_sisa_item"=>$sapaket_sisa_item_temp-1
			);
			$this->db->where('sapaket_master', $apaket_id);
			$this->db->where('sapaket_item', $dtrawat_perawatan);
			$this->db->where('sapaket_jenis_item', 'perawatan');
			$this->db->update('submaster_apaket_item', $dtu_sapaket);
			if($this->db->affected_rows()){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	/* eof kasir_ambil_paket_i*/
	
	/* INSERT ke db.history_ambil_paket */
	function history_ambil_paket_insert($dpaket_id, $rpaket_perawatan, $trawat_cust, $dtrawat_id, $dtrawat_dapp){
		$dti_hapaket=array(
		"hapaket_dpaket"=>$dpaket_id,
		"hapaket_rawat"=>$rpaket_perawatan,
		"hapaket_jumlah"=>1,
		"hapaket_cust"=>$trawat_cust,
		"hapaket_dtrawat"=>$dtrawat_id
		);
		$this->db->insert('history_ambil_paket', $dti_hapaket);
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
		}
	}
	/* eof history_ambil_paket_insert */
	
	/* INSERT ke db.history_ambil_paket */
	function history_ambil_paket_delete($dtrawat_id, $dtrawat_dapp){
		$this->db->where('hapaket_dtrawat', $dtrawat_id);
		$this->db->delete('history_ambil_paket');
		if($this->db->affected_rows()){
			/* meng-UNLOCK db.appointment_detail */
			$dtu_dapp=array(
			"dapp_locked"=>0
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
		}
	}
	/* eof history_ambil_paket_insert */
		
	//purge all detail from master
	function detail_tindakan_nonmedis_detail_purge($master_id){
		$sql="DELETE from tindakan_detail where dtrawat_master='".$master_id."'";
		$result=$this->db->query($sql);
	}
	//*eof
	
	function detail_tindakan_nonmedis_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jamreservasi ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan ,$dtrawat_ambil_paket ,$dtrawat_cust){
		/* hanya INSERT record tindakan_detail-medis yang baru */
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
	}
	
	//insert detail record
	function detail_tindakan_nonmedis_detail_insert_temp($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jam ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan ,$dtrawat_ambil_paket ,$dtrawat_cust){
		/* Check Centang checkbox ambil paket 'false'>>'true' atau 'true'>>'false' */
		/* Untuk mengetahui kondisi awal dari db.tindakan_detail.dtrawat_ambil_paket */
		$sql="SELECT dtrawat_ambil_paket FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$dtrawat_ambil_paket_awal=$rs_record["dtrawat_ambil_paket"];
		}
		
		$dtrawat_locked=0;
		$sql="SELECT dtrawat_id,dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			/* ini artinya: detail tindakan medis pada Form-Edit sudah masuk dalam db.tindakan_detail, sehingga akan dilakukan editing JIKA record db.tindakan_detail ini UNLOCK */
			$rs_record=$rs->row_array();
			$dtrawat_locked=$rs_record["dtrawat_locked"];
			
			if($dtrawat_status=='selesai' && $dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true' && $dtrawat_locked==0){
				/* boleh dilakukan editing karena belum terjadi transaksi di Kasir */
				/* ini artinya: telah masuk ke tagihan Kasir Perawatan */
				/* Checking kepemilikan paket akibat $dtrawat_ambil_paket=='true'(di-centang) */
				$having_rpaket = $this->having_rpaket_checking($dtrawat_cust, $dtrawat_perawatan);
				if($having_rpaket->num_rows()){
					/* 1. DELETE dari Kasir Perawatan */
					/* sebelum men-DELETE db.detail_jual_rawat, ambil terlebih dahulu db.detail_jual_rawat.drawat_master ==> untuk men-DELETE master_jual_rawat JIKA jrawat_id sudah tidak ada dalam daftar db.detail_jual_rawat */
					$sql="SELECT drawat_master FROM detail_jual_rawat WHERE drawat_dtrawat='$dtrawat_id'";
					$rs=$this->db->query($sql);
					$rs_record=$rs->row_array();
					$jrawat_id_temp=$rs_record["drawat_master"];
					
					$this->db->where('drawat_dtrawat',$dtrawat_id);
					$this->db->delete('detail_jual_rawat');
					if($this->db->affected_rows()){
						/* DELETE master_jual_rawat JIKA tidak punya detail di db.detail_jual_rawat */
						$this->master_jual_rawat_delete($jrawat_id_temp);
					}
					
					/* 2. INSERT ke Kasir Pengambilan Paket */
					$having_rpaket_record=$having_rpaket->row();
					
					$apaket_id_temp=$having_rpaket_record->apaket_id;
					$apaket_paket_temp=$having_rpaket_record->apaket_paket;
					$this->history_ambil_paket_insert($dpaket_id, $rpaket_perawatan, $trawat_cust_id, $dtrawat_id, $dtrawat_dapp);
					return 'Detail telah berhasil ditambahkan';
				}else{
					return "Maaf, Customer ini tidak memiliki paket dari perawatan yang dipilih";
				}
			}elseif($dtrawat_status!='selesai' && $dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true' && $dtrawat_locked==0){
				/* ini artinya: tindakan perawatan ini belum masuk ke Kasir manapun, karena masuk ke Kasir JIKA $dtrawat_status='selesai' */
				$having_rpaket = $this->having_rpaket_checking($dtrawat_cust, $dtrawat_perawatan);
				//$rs_having_rpaket = $having_rpaket->result();
				if($having_rpaket->num_rows()){
					/* UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'true' */
					$dtu_dtrawat=array(
					"dtrawat_ambil_paket"=>'true'
					);
					$this->db->where('dtrawat_id',$dtrawat_id);
					$this->db->update('tindakan_detail',$dtu_dtrawat);
					return 'success';
				}else{
					/* Customer dan Perawatan yang dipilih tidak terdapat dalam kepemilikan Paket */
					return "Maaf, ada satu atau lebih perawatan yang tidak terdapat dalam kepemilikan paket";
				}
			}elseif($dtrawat_status=='selesai' && $dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false' && $dtrawat_locked==0){
				/* ini artinya: Customer dengan detail perawatan ini telah masuk ke Kasir Pengambilan Paket */
				/* 1. DELETE data pada list Pengambilan Paket */
				$this->history_ambil_paket_delete($dtrawat_id, $dtrawat_dapp);
				
				/* 2. INSERT ke tagihan Kasir Perawatan */
				$this->detail_jual_rawat_insert($trawat_id, $cust_member, $trawat_cust_id, $dtrawat_id, $dtrawat_perawatan_id, $rawat_harga, $rawat_dm, $rawat_du, $dtrawat_dapp);
			}elseif($dtrawat_status!='selesai' && $dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false' && $dtrawat_locked==0){
				/* ini artinya: data belum masuk ke Kasir manapun, dan hanya perlu dilakukan update db.tindakan_detail.dtrawat_ambil_paket = 'false' */
				$dtu_dtrawat=array(
				"dtrawat_ambil_paket"=>'false'
				);
				$this->db->where('dtrawat_id',$dtrawat_id);
				$this->db->update('tindakan_detail',$dtu_dtrawat);
				return 'success';
			}
			
		}else{
			/* artinya: data ini adalah "data baru".
			* Data Baru ini otomatis ber-status='datang', maka db.report_tindakan dari Dokter yang dipilih akan ditambahkan +1
			*/
			/* 
			* JIKA $dtrawat_ambil_paket=true ==> Lakukan Checking di db.submaster_jual_paket,db.master_jual_paket,db.master_ambil_paket WHERE db.submaster_jual_paket.sjpaket_cust=[customer yg diupdate]
			*/
			return 'Maaf, Insert detail tindakan perawatan baru masih belum bisa';
			/*if($dtrawat_ambil_paket=='true'){
				
			}elseif($dtrawat_ambil_paket=='false'){
				$dti_dtrawat=array(
				"dtrawat_master"=>
				"dtrawat_perawatan"=>
				"dtrawat_petugas1"=>
				"dtrawat_jam"=>
				);
				return 'Maaf, Customer ini tidak memiliki paket dengan perawatan yang dipilih';
			}*/
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
	function tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_terapis ,$dtrawat_terapis_id ,$dtrawat_keterangan ,$dtrawat_dapp ,$dtrawat_ambil_paket ,$dpaket_id ,$rpaket_perawatan ,$mode_edit){
		
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
						2. INSERT ke db.history_ambil_paket
						3. UPDATE db.tindakan_detail.status = 'selesai' ==> sudah dilakukan sebelum masuk fungsi IF ini
						*/
						$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$dti_hapaket=array(
							"hapaket_dpaket"=>$dpaket_id,
							"hapaket_rawat"=>$rpaket_perawatan,
							"hapaket_jumlah"=>1,
							"hapaket_cust"=>$trawat_cust_id,
							"hapaket_dtrawat"=>$dtrawat_id
							);
							$this->db->insert('history_ambil_paket', $dti_hapaket);
							if($this->db->affected_rows()){
								/* me-LOCKED db.appointment_detail */
								$data_dapp_locked=array(
								"dapp_locked"=>1
								);
								$this->db->where('dapp_id', $dtrawat_dapp);
								$this->db->update('appointment_detail', $data_dapp_locked);
								return '1';
							}else{
								return '0';
							}
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
						1. DELETE dari db.history_ambil_paket
						2. UPDATE db.tindakan_detail.status = '!selesai' ==> sudah dilakukan sebelum fungsi IF ini
						3. meng-UNLOCK db.appointment_detail.dapp_locked
						*/
						$this->db->where('hapaket_dtrawat', $dtrawat_id);
						$this->db->delete('history_ambil_paket');
						if($this->db->affected_rows()){
							/* meng-UNLOCK db.appointment_detail */
							$data_dapp_locked=array(
							"dapp_locked"=>0
							);
							$this->db->where('dapp_id', $dtrawat_dapp);
							$this->db->update('appointment_detail', $data_dapp_locked);
							return '1';
						}else{
							return '0';
						}
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
					3. INSERT ke db.history_ambil_paket
					4. UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'true'
					*/
					$sql="SELECT cust_punya_paket FROM vu_tindakan WHERE dtrawat_id='$dtrawat_id' AND cust_punya_paket='ada'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$this->detail_jual_rawat_delete($dtrawat_id, $dtrawat_dapp);
						$this->history_ambil_paket_insert($dpaket_id, $rpaket_perawatan, $trawat_cust_id, $dtrawat_id, $dtrawat_dapp);
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
					2. DELETE dari db.history_ambil_paket
					3. INSERT ke db.detail_jual_rawat
					*/
					$dtu_dtrawat=array(
					"dtrawat_ambil_paket"=>'false'
					);
					$this->db->where('dtrawat_id', $dtrawat_id);
					$this->db->update('tindakan_detail', $dtu_dtrawat);
					
					$this->history_ambil_paket_delete($dtrawat_id, $dtrawat_dapp);
					
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
						3. UPDATE db.history_ambil_paket.hapaket_rawat <= [rawat_id pengganti = $dtrawat_perawatan]
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
							/* UPDATE db.history_ambil_paket */
							$dtu_hapaket=array(
							"hapaket_rawat"=>$dtrawat_perawatan
							);
							$this->db->where('hapaket_dtrawat', $dtrawat_id);
							$this->db->update('history_ambil_paket', $dtu_hapaket);
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