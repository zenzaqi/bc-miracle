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
	
	function get_laporan($tgl_awal,$tgl_akhir,$periode,$group){
			
		switch($group){
			case "Tanggal": $order_by=" ORDER BY dtrawat_tglapp ASC";break;
			case "Customer": $order_by=" ORDER BY trawat_cust,dtrawat_tglapp ASC";break;
			case "Perawatan": $order_by=" ORDER BY dtrawat_perawatan,dtrawat_tglapp ASC";break;
			case "Dokter": $order_by=" ORDER BY dokter_id,dtrawat_tglapp ASC";break;
			case "Status": $order_by=" ORDER BY dtrawat_status,dtrawat_tglapp ASC";break;
			default: $order_by=" ORDER BY dtrawat_tglapp ASC";break;
		}
			
		if($periode=='all')
			$sql="SELECT *,date_format(dtrawat_tglapp,'%Y-%m-%d') as dtrawat_tglapp FROM vu_tindakan 
					WHERE (kategori_nama='Medis' OR kategori_nama ='Surgery') OR (kategori_nama='Non Medis' AND terapis_id is NULL AND dokter_id is NULL) ".$order_by;
		else if($periode=='bulan')
			$sql="SELECT *,date_format(dtrawat_tglapp,'%Y-%m-%d') as dtrawat_tglapp FROM vu_tindakan 
					WHERE ((kategori_nama='Medis' OR kategori_nama ='Surgery') OR (kategori_nama='Non Medis' AND terapis_id is NULL AND dokter_id is NULL))
					AND date_format(dtrawat_tglapp,'%Y-%m')='".$tgl_awal."' ".$order_by;
		else if($periode=='tanggal')
			$sql="SELECT *,date_format(dtrawat_tglapp,'%Y-%m-%d') as dtrawat_tglapp FROM vu_tindakan 
					WHERE  ((kategori_nama='Medis' OR kategori_nama ='Surgery') OR (kategori_nama='Non Medis' AND terapis_id is NULL AND dokter_id is NULL)) 
					AND date_format(dtrawat_tglapp,'%Y-%m-%d')>='".$tgl_awal."' 
					AND date_format(dtrawat_tglapp,'%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
		
		//$this->firephp->log($sql);
		
		$query=$this->db->query($sql);
		return $query->result();
	}
		
	function global_customer_check_paket($cust_id, $rawat_id){
		//$return_row_punya_paket = 0;
		//* Mencari kepemilikan paket berdasarkan customer_id /
		$sql_punya_paket="SELECT (dpaket_jumlah*rpaket_jumlah) AS rpaket_jumlah
				,dpaket_id
				,dpaket_master
				,dpaket_paket
				,dpaket_sisa_paket
			FROM paket_isi_perawatan
			LEFT JOIN detail_jual_paket ON(rpaket_master=dpaket_paket)
			LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id)
			LEFT JOIN pengguna_paket ON(ppaket_master=jpaket_id)
			WHERE ppaket_cust='$cust_id'
				AND rpaket_perawatan='$rawat_id'
				AND jpaket_stat_dok<>'Batal'
				AND dpaket_sisa_paket>0
			ORDER BY detail_jual_paket.dpaket_id ASC";
		
		$rs_punya_paket=$this->db->query($sql_punya_paket);
		if($rs_punya_paket->num_rows()){
			$punya_paket_rows = $rs_punya_paket->num_rows();
			$i=0;
			foreach($rs_punya_paket->result() as $row_punya_paket){
				$i++;
				$sql_check_sisa="SELECT sum(dapaket_jumlah) AS total_item_terpakai
					FROM detail_ambil_paket
					WHERE dapaket_dpaket='$row_punya_paket->dpaket_id'
						AND dapaket_jpaket='$row_punya_paket->dpaket_master'
						AND dapaket_paket='$row_punya_paket->dpaket_paket'
						AND dapaket_item='$rawat_id'
						AND dapaket_stat_dok<>'Batal'
					GROUP BY dapaket_item";
				$rs_check_sisa=$this->db->query($sql_check_sisa);
				if($rs_check_sisa->num_rows()){
					$record_check_sisa = $rs_check_sisa->row();
					if(($row_punya_paket->rpaket_jumlah > $record_check_sisa->total_item_terpakai) || (($row_punya_paket->rpaket_jumlah==0) && ($row_punya_paket->dpaket_sisa_paket > 0))){
						return $row_punya_paket;
						break;
					}else{
						if($i==$punya_paket_rows){
							return NULL;
						}
					}
					
				}else{
					return $row_punya_paket;
					break;
				}
			}
			
		}else{
			return NULL;
		}
	}
	
	function customer_check_paket($cust_id, $rawat_id){
		//$return_row_punya_paket = 0;
		//* Mencari kepemilikan paket berdasarkan customer_id /
		$sql_punya_paket="SELECT (dpaket_jumlah*rpaket_jumlah) AS rpaket_jumlah
				,dpaket_id
				,dpaket_master
				,dpaket_paket
				,dpaket_sisa_paket
			FROM paket_isi_perawatan
			LEFT JOIN detail_jual_paket ON(rpaket_master=dpaket_paket)
			LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id)
			LEFT JOIN pengguna_paket ON(ppaket_master=jpaket_id)
			WHERE ppaket_cust='$cust_id'
				AND rpaket_perawatan='$rawat_id'
				AND jpaket_cust='$cust_id'
				AND jpaket_stat_dok<>'Batal'
				AND dpaket_sisa_paket>0
			ORDER BY detail_jual_paket.dpaket_id ASC";
		
		$rs_punya_paket=$this->db->query($sql_punya_paket);
		if($rs_punya_paket->num_rows()){
			$punya_paket_rows = $rs_punya_paket->num_rows();
			$i=0;
			foreach($rs_punya_paket->result() as $row_punya_paket){
				$i++;
				$sql_check_sisa="SELECT sum(dapaket_jumlah) AS total_item_terpakai
					FROM detail_ambil_paket
					WHERE dapaket_dpaket='$row_punya_paket->dpaket_id'
						AND dapaket_jpaket='$row_punya_paket->dpaket_master'
						AND dapaket_paket='$row_punya_paket->dpaket_paket'
						AND dapaket_item='$rawat_id'
						AND dapaket_stat_dok<>'Batal'
					GROUP BY dapaket_item";
				$rs_check_sisa=$this->db->query($sql_check_sisa);
				if($rs_check_sisa->num_rows()){
					$record_check_sisa = $rs_check_sisa->row();
					if(($row_punya_paket->rpaket_jumlah > $record_check_sisa->total_item_terpakai) || (($row_punya_paket->rpaket_jumlah==0) && ($row_punya_paket->dpaket_sisa_paket > 0))){
						return $row_punya_paket;
						break;
					}else{
						if($i==$punya_paket_rows){
							$return_global_customer_check_paket = $this->global_customer_check_paket($cust_id, $rawat_id);
							return $return_global_customer_check_paket;
							//return 0;
						}
					}
					
				}else{
					return $row_punya_paket;
					break;
				}
			}
			
		}else{
			$return_global_customer_check_paket = $this->global_customer_check_paket($cust_id, $rawat_id);
			return $return_global_customer_check_paket;
			//return 0;
		}
	}
		
	function get_nonmedis_in_tmedis_list($query,$start,$end){
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dapp="SELECT distinct(dtrawat_perawatan) FROM tindakan_detail INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id) LEFT JOIN kategori ON(kategori_id=rawat_kategori) WHERE dtrawat_master='$query' AND dtrawat_petugas2='0' AND kategori_nama='Non Medis'";
			$rs=$this->db->query($sql_dapp);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="SELECT * FROM vu_perawatan WHERE kategori_nama='Non Medis' AND rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"" && is_numeric($query)==false){
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%')";
			//$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or group_nama like '%".$query."%')";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$query)? " OR ":" AND ";
				foreach($rs->result() as $row_dapp){
					
					$filter.="OR rawat_id='".$row_dapp->dtrawat_perawatan."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		}
		$sql.=" ORDER BY rawat_nama ASC";
	
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		$limit = $sql." LIMIT ".$start.",".$end;			
		//echo $limit;
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
	function detail_tindakan_detail_list($master_id,$query,$start,$end) {
		//$query = "SELECT * FROM tindakan_detail,perawatan,karyawan WHERE dtrawat_perawatan=rawat_id AND dtrawat_petugas1=karyawan_id AND dtrawat_master='".$master_id."'";
		$query="SELECT dtrawat_id
                        ,dtrawat_master
                        ,dtrawat_perawatan
                        ,dtrawat_petugas1
                        ,dtrawat_jam
                        ,dtrawat_kategori
                        ,dtrawat_status
                        ,dtrawat_keterangan
                        ,dtrawat_ambil_paket
                FROM tindakan_detail
                INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id)
                INNER JOIN karyawan ON(dtrawat_petugas1=karyawan_id)
                LEFT JOIN kategori ON(rawat_kategori=kategori_id)
                WHERE dtrawat_master='".$master_id."' AND (kategori_nama='Medis' OR kategori_nama ='Surgery')";
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
	/*function get_master_id() {
		$query = "SELECT max(trawat_id) as master_id from tindakan";
		$result = $this->db->query($query);
		if($result->num_rows()){
			$data=$result->row();
			$master_id=$data->master_id;
			return $master_id;
		}else{
			return '0';
		}
	}*/
	//eof
		
	/* DELETE db.master_jual_rawat IF jrawat_id TIDAK ADA di daftar db.detail_jual_rawat.drawat_master */
	/*function master_jual_rawat_delete($jrawat_id){
		$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$jrawat_id'";
		$rs=$this->db->query($sql);
		if(!$rs->num_rows()){
			$this->db->where('jrawat_id',$jrawat_id);
			$this->db->delete('master_jual_rawat');
		}
	}*/
	/* END delete db.master_jual_rawat */
	
	/* DELETE db.detail_jual_rawat IF jrawat_id TIDAK ADA di daftar db.detail_jual_rawat.drawat_master */
	function detail_jual_rawat_delete($dtrawat_id){
		/* 1. Delete db.detail_jual_rawat ==> where drawat_dtrawat=$dtrawat_id
		** 2. Delete db.detail_pakai_cabin ==> where cabin_dtrawat=$dtrawat_id
		** 3. Update db.appointment_detail.dapp_locked=0 ==> where dapp_id=db.tindakan_detail.dtrawat_dapp
		** 4. Update db.detail_jual_paket.dpaket_sisa_paket
		*/
		
		$sql="SELECT drawat_master, dtrawat_dapp
			FROM detail_jual_rawat
			LEFT JOIN tindakan_detail ON(drawat_dtrawat=dtrawat_id)
			WHERE drawat_dtrawat='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$record=$rs->row_array();
			$dtrawat_dapp = $record['dtrawat_dapp'];
			$drawat_master = $record['drawat_master'];
		}
		
		//Delete db.detail_pakai_cabin
		$this->db->where('cabin_dtrawat', $dtrawat_id);
		$this->db->delete('detail_pakai_cabin');
		
		//Delete db.detail_jual_rawat + db.detail_pakai_cabin
		$this->db->where('drawat_dtrawat', $dtrawat_id);
		$this->db->delete('detail_jual_rawat');
		
		//UN-Lock db.appointment_detail
		if($this->db->affected_rows()>0 && $dtrawat_dapp>0){
			$dtu_dapp=array(
			"dapp_locked"=>0
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
		}
		
		$sql_drawat = "SELECT drawat_master FROM detail_jual_rawat WHERE drawat_master='$drawat_master'";
		$rs_drawat = $this->db->query($sql_drawat);
		if($rs_drawat->num_rows()<1){
			//Delete master_jual_rawat ==> karena sudah tidak memiliki detail
			$sqld_jrawat = "DELETE FROM master_jual_rawat WHERE jrawat_id='$drawat_master'";
			$this->db->query($sqld_jrawat);
		}
		
	}
	/* eof detail_jual_rawat_delete */
	
	/* INSERT ke db.detail_jual_rawat */
	//function detail_jual_rawat_insert($cust_member, $trawat_cust_id, $dtrawat_id, $dtrawat_perawatan_id, $rawat_harga, $rawat_dm, $rawat_du, $dtrawat_dapp, $drawat_jumlah){
	function detail_jual_rawat_insert($dtrawat_id){
		/*
		1. check di master_jual_rawat, apakah customer ini pada hari sekarang sudah masuk ke Kasir
		2. JIKA customer ini sudah 'ada' di db.master_jual_rawat ==> INSERT ke db.detail_jual_rawat
		3. JIKA customer ini belum 'ada' di db.master_jual_rawat ==> INSERT ke db.master_jual_rawat AND db.detail_jual_rawat
		4. Proses insert ke db.detail_jual_rawat ini artinya status di db.tindakan_detail.status adalah ='selesai', sehingga db.appointment_detail harus di-LOCKED
		5. Karena sudah masuk Kasir, itu artinya Tindakan sudah ='selesai', sehingga standard bahan dari perawatan yg diambil harus dimasukkan ke db.detail_pakai_cabin
		*/
		$date_now=date('Y-m-d');
		
		$cust_member = 0;
		
		//Mencari Customer_ID
		$sql = "SELECT trawat_cust, dtrawat_perawatan, dtrawat_jumlah, dtrawat_dapp
			FROM tindakan_detail
			LEFT JOIN tindakan ON(dtrawat_master=trawat_id)
			WHERE dtrawat_id='$dtrawat_id'";
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$record = $rs->row_array();
			$cust_id = $record['trawat_cust'];
			$dtrawat_perawatan = $record['dtrawat_perawatan'];
			$dtrawat_jumlah = $record['dtrawat_jumlah'];
			$dtrawat_dapp = $record['dtrawat_dapp'];
			
			//Mencari Customer_Member >< db.member
			$sql = "SELECT cust_member
				FROM customer
				LEFT JOIN member ON(cust_member=member_id)";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$cust_member = $record['cust_member'];
			}
			
			//Mencari harga perawatan
			$sql = "SELECT rawat_harga, rawat_dm, rawat_du
				FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$rawat_harga = $record['rawat_harga'];
				$rawat_dm = $record['rawat_dm'];
				$rawat_du = $record['rawat_du'];
			}
		}
		
		
		if($cust_member!=0){
			$diskon_jenis="DM";
			$diskon=$rawat_dm;
		}elseif($cust_member==0){
			$diskon_jenis="DU";
			$diskon=$rawat_du;
		}
		
		$sql="SELECT jrawat_id, jrawat_nobukti
			FROM master_jual_rawat
			WHERE jrawat_cust='$cust_id'
				AND jrawat_tanggal='$date_now'
				AND jrawat_stat_dok='Terbuka'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			/* artinya: customer yang dimaksud 'sudah masuk' di db.master_jual_rawat pada hari ini
			 * maka Hanya INSERT ke db.detail_jual_rawat
			 */
			$rs_record=$rs->row_array();
			$jrawat_id=$rs_record["jrawat_id"];
			$jrawat_nobukti=$rs_record["jrawat_nobukti"];
			
			$dti_drawat=array(
			"drawat_master"=>$jrawat_id,
			"drawat_dtrawat"=>$dtrawat_id,
			"drawat_rawat"=>$dtrawat_perawatan,
			"drawat_jumlah"=>$dtrawat_jumlah,
			"drawat_harga"=>$rawat_harga,
			"drawat_diskon"=>$diskon,
			"drawat_diskon_jenis"=>$diskon_jenis,
			"drawat_creator"=>@$_SESSION[SESSION_USERID]
			);
			$this->db->insert('detail_jual_rawat', $dti_drawat);
			if($this->db->affected_rows()){
				/* Karena db.tindakan_detail.status sudah 'selesai' ==> db.appointment_detail di-LOCKED */
				// jika $dtrawat_dapp==0 ==> berarti bukan inputan dari Appointment, sehingga tidak perlu dilakukan Locked ke Appoinment
				if($dtrawat_dapp>0){
					$dtu_dapp=array(
					"dapp_locked"=>1
					);
					$this->db->where('dapp_id', $dtrawat_dapp);
					$this->db->update('appointment_detail', $dtu_dapp);
				}
				
				$this->detail_pakai_cabin_insert($dtrawat_id, $dtrawat_perawatan, $jrawat_nobukti ,$cust_id);
				return 1;
			}else{
				return 0;
			}
		}else{
			/* artinya: di db.master_jual_rawat BELUM ADA */
			/* INSERT to db.master_jual_rawat AND table.detail_jual_rawat */
			$pattern="PR/".date("ym")."-";
			$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
			$data_jrawat=array(
			"jrawat_nobukti"=>$jrawat_nobukti,
			"jrawat_cust"=>$cust_id,
			"jrawat_tanggal"=>$date_now,
			"jrawat_creator"=>@$_SESSION[SESSION_USERID]
			);
			$this->db->insert('master_jual_rawat', $data_jrawat);
			if($this->db->affected_rows()){
				/* INSERT to db.detail_jual_rawat */
				$sql="SELECT jrawat_id
					FROM master_jual_rawat
					WHERE jrawat_cust='$cust_id'
						AND jrawat_tanggal='$date_now'
						AND jrawat_stat_dok='Terbuka'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$jrawat_id=$rs_record["jrawat_id"];
					
					$dti_drawat=array(
					"drawat_master"=>$jrawat_id,
					"drawat_dtrawat"=>$dtrawat_id,
					"drawat_rawat"=>$dtrawat_perawatan,
					"drawat_jumlah"=>$dtrawat_jumlah,
					"drawat_harga"=>$rawat_harga,
					"drawat_diskon"=>$diskon,
					"drawat_diskon_jenis"=>$diskon_jenis,
					"drawat_creator"=>@$_SESSION[SESSION_USERID]
					);
					$this->db->insert('detail_jual_rawat', $dti_drawat);
					if($this->db->affected_rows()){
						/* Karena db.tindakan_detail.status sudah 'selesai' ==> db.appointment_detail di-LOCKED */
						// jika $dtrawat_dapp==0 ==> bukan inputan dari Appointment, sehingga tidak perlu update Locked di Appoinment
						if($dtrawat_dapp>0){
							$dtu_dapp=array(
							"dapp_locked"=>1
							);
							$this->db->where('dapp_id', $dtrawat_dapp);
							$this->db->update('appointment_detail', $dtu_dapp);
						}
						
						$this->detail_pakai_cabin_insert($dtrawat_id, $dtrawat_perawatan, $jrawat_nobukti ,$cust_id);
						return 1;
					
					}else{
						return 0;
					}
				}else{
					return 0;
				}
				
			}else{
				return 0;
			}
		}
	}
	
	function drawat_from_tmedis_nonmedis_list_insert($dtrawat_master){
		/* Proses INSERT to db.detail_jual_rawat WHERE db.tindakan_detail.dtrawat_id BELUM MASUK ke db.detail_jual_rawat
		 * db.tindakan_detail di-SELECT WHERE dtrawat_master=$dtrawat_master, kemudian di-INSERT to db.detail_jual_rawat secara Looping
		*/
		$date_now = date('Y-m-d');
		$datetime_now = date('Y-m-d H:i:s');
		$membership = 'not_member';
		
		//Mencari Customer_ID dari filter $dtrawat_master
		$sql_trawat_cust = "SELECT trawat_cust FROM tindakan WHERE trawat_id='$dtrawat_master'";
		$rs_trawat_cust = $this->db->query($sql_trawat_cust);
		if($rs_trawat_cust->num_rows()){
			$record_trawat_cust = $rs_trawat_cust->row_array();
			$cust_id = $record_trawat_cust['trawat_cust'];
			
			//get_member dari $cust_id
			$sql_membership = "SELECT * FROM member WHERE member_cust='".$cust_id."' AND member_valid > now() ORDER BY member_id DESC limit 1";
			$rs_membership = $this->db->query($sql_membership);
			if($rs_membership->num_rows()){
				$membership = 'member';
			}
		}
		
		/* checking db.master_jual_rawat terlebih dahulu, apakah pada hari ini customer ini telah melakukan perawatan yg belum cetak faktur ()
		 * Jika customer ini sudah masuk Kasir Penjualan Perawatan === db.master_jual_rawat ==> insert to db.detail_jual_rawat
		 * Jika customer belum masuk Kasir Penjualan Perawatan === db.master_jual_rawat ==> insert to db.master_jual_rawat + db.detail_jual_rawat
	    */
		$sql_jrawat="SELECT jrawat_id, jrawat_nobukti
			FROM master_jual_rawat
			WHERE jrawat_cust='$cust_id'
				AND jrawat_tanggal='$date_now'
				AND jrawat_stat_dok='Terbuka'";
		$rs_jrawat=$this->db->query($sql_jrawat);
		if($rs_jrawat->num_rows()){
			$record_jrawat = $rs_jrawat->row_array();
			$jrawat_id = $record_jrawat['jrawat_id'];
			
			$sql_dtrawat = "SELECT *
				FROM tindakan_detail
				WHERE dtrawat_master='".$dtrawat_master."'
					AND dtrawat_petugas1=0
					AND dtrawat_petugas2=0
					AND dtrawat_status='selesai'";
			$rs_dtrawat = $this->db->query($sql_dtrawat);
			if($rs_dtrawat->num_rows()){
				foreach($rs_dtrawat->result() as $row){
					$sql = "SELECT drawat_dtrawat FROM detail_jual_rawat WHERE drawat_dtrawat='".$row->dtrawat_id."'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						//Edit detail Tindakan Non Medis
						if($membership=='member'){
							//Customer adalah Member
							$sql_drawat = "UPDATE detail_jual_rawat, tindakan_detail, perawatan
								SET detail_jual_rawat.drawat_rawat=tindakan_detail.dtrawat_perawatan
									,detail_jual_rawat.drawat_jumlah=tindakan_detail.dtrawat_jumlah 
									,detail_jual_rawat.drawat_harga=perawatan.rawat_harga 
									,detail_jual_rawat.drawat_diskon=perawatan.rawat_dm 
									,detail_jual_rawat.drawat_update='".@$_SESSION[SESSION_USERID]."' 
									,detail_jual_rawat.drawat_date_update='".$datetime_now."' 
									,detail_jual_rawat.drawat_revised=(detail_jual_rawat.drawat_revised+1) 
								WHERE detail_jual_rawat.drawat_dtrawat=tindakan_detail.dtrawat_id
									AND tindakan_detail.dtrawat_perawatan=perawatan.rawat_id
									AND tindakan_detail.dtrawat_id='".$row->dtrawat_id."'";
						}else{
							//Customer adalah Bukan Member
							$sql_drawat = "UPDATE detail_jual_rawat, tindakan_detail, perawatan
								SET detail_jual_rawat.drawat_rawat=tindakan_detail.dtrawat_perawatan
									,detail_jual_rawat.drawat_jumlah=tindakan_detail.dtrawat_jumlah 
									,detail_jual_rawat.drawat_harga=perawatan.rawat_harga 
									,detail_jual_rawat.drawat_diskon=perawatan.rawat_du 
									,detail_jual_rawat.drawat_update='".@$_SESSION[SESSION_USERID]."' 
									,detail_jual_rawat.drawat_date_update='".$datetime_now."' 
									,detail_jual_rawat.drawat_revised=(detail_jual_rawat.drawat_revised+1) 
								WHERE detail_jual_rawat.drawat_dtrawat=tindakan_detail.dtrawat_id
									AND tindakan_detail.dtrawat_perawatan=perawatan.rawat_id
									AND tindakan_detail.dtrawat_id='".$row->dtrawat_id."'";
						}
					}else{
						//Add Baru
						if($membership=='member'){
							//Customer adalah Member
							$sql_drawat = "INSERT INTO detail_jual_rawat(drawat_master
									,drawat_dtrawat
									,drawat_rawat
									,drawat_jumlah
									,drawat_harga
									,drawat_diskon
									,drawat_diskon_jenis
									,drawat_creator)
								SELECT '".$jrawat_id."'
									,dnonmedis.dtrawat_id
									,dnonmedis.dtrawat_perawatan
									,dnonmedis.dtrawat_jumlah
									,rawat.rawat_harga
									,rawat.rawat_dm
									,'DM'
									,'".@$_SESSION[SESSION_USERID]."'
								FROM tindakan_detail AS dnonmedis
								LEFT JOIN perawatan AS rawat ON(dnonmedis.dtrawat_perawatan=rawat.rawat_id)
								WHERE dnonmedis.dtrawat_id='".$row->dtrawat_id."'";
						}else{
							//Customer adalah Bukan Member
							$sql_drawat = "INSERT INTO detail_jual_rawat(drawat_master
									,drawat_dtrawat
									,drawat_rawat
									,drawat_jumlah
									,drawat_harga
									,drawat_diskon
									,drawat_diskon_jenis
									,drawat_creator)
								SELECT '".$jrawat_id."'
									,dnonmedis.dtrawat_id
									,dnonmedis.dtrawat_perawatan
									,dnonmedis.dtrawat_jumlah
									,rawat.rawat_harga
									,rawat.rawat_du
									,'DU'
									,'".@$_SESSION[SESSION_USERID]."'
								FROM tindakan_detail AS dnonmedis
								LEFT JOIN perawatan AS rawat ON(dnonmedis.dtrawat_perawatan=rawat.rawat_id)
								WHERE dnonmedis.dtrawat_id='".$row->dtrawat_id."'";
						}
					}
					$this->db->query($sql_drawat);
				}
			}
			
			//Proses INSERT to db.detail_jual_rawat WHERE db.tindakan_detail.dtrawat_id belum masuk ke db.detail_jual_rawat.drawat_dtrawat
			/*if($membership=='member'){
				$sqli_drawat = "INSERT INTO detail_jual_rawat(drawat_master
						,drawat_dtrawat
						,drawat_rawat
						,drawat_jumlah
						,drawat_harga
						,drawat_diskon
						,drawat_diskon_jenis
						,drawat_creator)
					SELECT '".$jrawat_id."'
						,dnonmedis.dtrawat_id
						,dnonmedis.dtrawat_perawatan
						,dnonmedis.dtrawat_jumlah
						,rawat.rawat_harga
						,rawat.rawat_dm
						,'DM'
						,'".@$_SESSION[SESSION_USERID]."'
					FROM tindakan_detail AS dnonmedis
					LEFT JOIN perawatan AS rawat ON(dnonmedis.dtrawat_perawatan=rawat.rawat_id)
					WHERE dnonmedis.dtrawat_master='$dtrawat_master'
						AND dnonmedis.dtrawat_petugas1=0
						AND dnonmedis.dtrawat_petugas2=0
						AND dnonmedis.dtrawat_status='selesai'
						AND dnonmedis.dtrawat_id NOT IN (
							SELECT sub_drawat.drawat_dtrawat
							FROM detail_jual_rawat AS sub_drawat
							WHERE sub_drawat.drawat_master='".$jrawat_id."'
							)";
			}else{
				$sqli_drawat = "INSERT INTO detail_jual_rawat(drawat_master
						,drawat_dtrawat
						,drawat_rawat
						,drawat_jumlah
						,drawat_harga
						,drawat_diskon
						,drawat_diskon_jenis
						,drawat_creator)
					SELECT '".$jrawat_id."'
						,dnonmedis.dtrawat_id
						,dnonmedis.dtrawat_perawatan
						,dnonmedis.dtrawat_jumlah
						,rawat.rawat_harga
						,rawat.rawat_du
						,'DU'
						,'".@$_SESSION[SESSION_USERID]."'
					FROM tindakan_detail AS dnonmedis
					LEFT JOIN perawatan AS rawat ON(dnonmedis.dtrawat_perawatan=rawat.rawat_id)
					WHERE dnonmedis.dtrawat_master='$dtrawat_master'
						AND dnonmedis.dtrawat_petugas1=0
						AND dnonmedis.dtrawat_petugas2=0
						AND dnonmedis.dtrawat_status='selesai'
						AND dnonmedis.dtrawat_id NOT IN (
							SELECT sub_drawat.drawat_dtrawat
							FROM detail_jual_rawat AS sub_drawat
							WHERE sub_drawat.drawat_master='".$jrawat_id."'
							)";
			}*/
			//$this->db->query($sql_drawat);
			
		}else{
			//ini artinya: customer di tanggal sekarang belum ada di db.master_jual_rawat
			$pattern="PR/".date("ym")."-";
			$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
			$dti_jrawat=array(
			"jrawat_nobukti"=>$jrawat_nobukti,
			"jrawat_cust"=>$cust_id,
			"jrawat_tanggal"=>$date_now,
			"jrawat_creator"=>@$_SESSION[SESSION_USERID]
			);
			$this->db->insert('master_jual_rawat', $dti_jrawat);
			if($this->db->affected_rows()){
				//Cari jrawat_id dulu.....
				$sql_jrawat="SELECT jrawat_id, jrawat_nobukti
					FROM master_jual_rawat
					WHERE jrawat_cust='$cust_id'
						AND jrawat_tanggal='$date_now'
						AND jrawat_stat_dok='Terbuka'";
				$rs_jrawat=$this->db->query($sql_jrawat);
				if($rs_jrawat->num_rows()){
					$record_jrawat = $rs_jrawat->row_array();
					$jrawat_id = $record_jrawat['jrawat_id'];
					//Proses INSERT to db.detail_jual_rawat WHERE db.tindakan_detail.dtrawat_id belum masuk ke db.detail_jual_rawat.drawat_dtrawat
					if($membership=='member'){
						$sqli_drawat = "INSERT INTO detail_jual_rawat(drawat_master
								,drawat_dtrawat
								,drawat_rawat
								,drawat_jumlah
								,drawat_harga
								,drawat_diskon
								,drawat_diskon_jenis
								,drawat_creator)
							SELECT '".$jrawat_id."'
								,dnonmedis.dtrawat_id
								,dnonmedis.dtrawat_perawatan
								,dnonmedis.dtrawat_jumlah
								,rawat.rawat_harga
								,rawat.rawat_dm
								,'DM'
								,'".@$_SESSION[SESSION_USERID]."'
							FROM tindakan_detail AS dnonmedis
							LEFT JOIN perawatan AS rawat ON(dnonmedis.dtrawat_perawatan=rawat.rawat_id)
							WHERE dnonmedis.dtrawat_master='$dtrawat_master'
								AND dnonmedis.dtrawat_petugas1=0
								AND dnonmedis.dtrawat_petugas2=0
								AND dnonmedis.dtrawat_status='selesai'
								AND dnonmedis.dtrawat_id NOT IN (
									SELECT sub_drawat.drawat_dtrawat
									FROM detail_jual_rawat AS sub_drawat
									WHERE sub_drawat.drawat_master='".$jrawat_id."'
									)";
					}else{
						$sqli_drawat = "INSERT INTO detail_jual_rawat(drawat_master
								,drawat_dtrawat
								,drawat_rawat
								,drawat_jumlah
								,drawat_harga
								,drawat_diskon
								,drawat_diskon_jenis
								,drawat_creator)
							SELECT '".$jrawat_id."'
								,dnonmedis.dtrawat_id
								,dnonmedis.dtrawat_perawatan
								,dnonmedis.dtrawat_jumlah
								,rawat.rawat_harga
								,rawat.rawat_du
								,'DU'
								,'".@$_SESSION[SESSION_USERID]."'
							FROM tindakan_detail AS dnonmedis
							LEFT JOIN perawatan AS rawat ON(dnonmedis.dtrawat_perawatan=rawat.rawat_id)
							WHERE dnonmedis.dtrawat_master='$dtrawat_master'
								AND dnonmedis.dtrawat_petugas1=0
								AND dnonmedis.dtrawat_petugas2=0
								AND dnonmedis.dtrawat_status='selesai'
								AND dnonmedis.dtrawat_id NOT IN (
									SELECT sub_drawat.drawat_dtrawat
									FROM detail_jual_rawat AS sub_drawat
									WHERE sub_drawat.drawat_master='".$jrawat_id."'
									)";
					}
					$this->db->query($sqli_drawat);
				}
				
			}
		}
		
	}
	
	/* eof detail_jual_rawat_insert */
	
	/* UPDATE db.detail_jual_rawat */
	function detail_jual_rawat_update($dtrawat_perawatan, $dtrawat_id, $cust_member){
		/* ambil data detail dari $dtrawat_perawatan */
		$datetime_now=date('Y-m-d H:i:s');
		
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
		
		$sql="UPDATE detail_jual_rawat
			SET drawat_rawat='$dtrawat_perawatan'
				,drawat_harga='$rawat_harga'
				,drawat_diskon='$diskon'
				,drawat_diskon_jenis='$diskon_jenis'
				,drawat_update='".@$_SESSION[SESSION_USERID]."'
				,drawat_date_update='$datetime_now'
				,drawat_revised=drawat_revised+1
			WHERE drawat_dtrawat='$dtrawat_id'";
		$this->db->query($sql);
		
		/*$dtu_drawat=array(
		"drawat_rawat"=>$dtrawat_perawatan,
		"drawat_harga"=>$rawat_harga,
		"drawat_diskon"=>$diskon,
		"drawat_diskon_jenis"=>$diskon_jenis
		);
		$this->db->where('drawat_dtrawat', $dtrawat_id);
		$this->db->update('detail_jual_rawat', $dtu_drawat);*/
		if($this->db->affected_rows()){
			$this->detail_pakai_cabin_update($dtrawat_id, $dtrawat_perawatan);
		}
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
	//function detail_ambil_paket_insert($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket, $dapaket_item, $trawat_cust_id, $dtrawat_id, $dtrawat_dapp){
	function detail_ambil_paket_insert($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket, $dapaket_item, $trawat_cust_id, $dtrawat_id){
		/* dari pengambilan paket akan berakibat pada: detail_pakai_cabin, appointment_detail, detail_jual_paket.dpaket_sisa_paket
		 * # 
		*/
		
		//Mencari dtrawat_dapp ==> untuk meng-UNLOCKED db.appointment_detail
		$sql = "SELECT dtrawat_dapp
			FROM tindakan_detail
			LEFT JOIN tindakan ON(dtrawat_master=trawat_id)
			WHERE dtrawat_id='$dtrawat_id'";
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$record = $rs->row_array();
			$dtrawat_dapp = $record['dtrawat_dapp'];
		}
		
		//* Mengambil db.master_jual_paket.jpaket_nobukti ==> masukkan ke db.detail_pakai_cabin /
		$date_now = date('Y-m-d');
		$jpaket_nobukti = "";
		$sql="SELECT jpaket_nobukti FROM master_jual_paket WHERE jpaket_id='$dapaket_jpaket'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
				$record = $rs->row_array();
				$jpaket_nobukti = $record['jpaket_nobukti'];
		}
		
		$dti_dapaket=array(
		"dapaket_dpaket"=>$dapaket_dpaket,
		"dapaket_jpaket"=>$dapaket_jpaket,
		"dapaket_paket"=>$dapaket_paket,
		"dapaket_item"=>$dapaket_item,
		"dapaket_jenis_item"=>'perawatan',
		"dapaket_jumlah"=>1,
		"dapaket_cust"=>$trawat_cust_id,
		"dapaket_dtrawat"=>$dtrawat_id,
		"dapaket_tgl_ambil"=>$date_now,
		"dapaket_creator"=>@$_SESSION[SESSION_USERID]
		);
		$this->db->insert('detail_ambil_paket', $dti_dapaket);
		if($this->db->affected_rows()){
			/* me-LOCKED db.appointment_detail ==> jika $dtrawat_dapp>0 */
			if($dtrawat_dapp>0){
				$dtu_dapp=array(
				"dapp_locked"=>1
				);
				$this->db->where('dapp_id', $dtrawat_dapp);
				$this->db->update('appointment_detail', $dtu_dapp);
			}
			
			$this->total_sisa_paket_update($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket);
			
			$this->detail_pakai_cabin_insert($dtrawat_id, $dapaket_item, $jpaket_nobukti ,$trawat_cust_id);
			return 1;
			
		}else{
			return 0;
		}
	}
	/* eof detail_ambil_paket_insert */
	
	/* UPDATE db.submaster_apaket_item.sapaket_sisa_item AND db.master_ambil_paket.apaket_sisa_paket */
	function total_sisa_paket_update($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket){
		//* UPDATE db.detail_jual_paket.dpaket_sisa_paket ==> sisa paket dari paket yang dibeli akan diupdate akibat dari pengambilan paket /
		/*$sql_sisa_paket="UPDATE detail_jual_paket
			SET dpaket_sisa_paket=
				(
				SELECT ((dpaket_jumlah*paket_jmlisi)-(sum(dapaket_jumlah)))
				FROM detail_ambil_paket
				LEFT JOIN paket ON(dapaket_paket=paket_id)
				WHERE paket_id='$dapaket_paket'
					AND dapaket_dpaket='$dapaket_dpaket'
					AND dapaket_jpaket='$dapaket_jpaket'
					AND dapaket_stat_dok<>'Batal'
				GROUP BY dapaket_dpaket, dapaket_jpaket, dapaket_paket
				)
			WHERE detail_jual_paket.dpaket_id='$dapaket_dpaket'
				AND detail_jual_paket.dpaket_master='$dapaket_jpaket'
				AND detail_jual_paket.dpaket_paket='$dapaket_paket'";*/
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
		
	}
	
	/* INSERT db.detail_pakai_cabin */
	function detail_pakai_cabin_insert($cabin_dtrawat ,$cabin_rawat ,$cabin_bukti ,$cabin_cust){
		//* Mencatat pemakaian Standard Bahan dari perawatan($cabin_rawat) yang terpakai /
		$sql="SELECT krawat_produk
				,krawat_satuan
				,krawat_jumlah
				,produk_satuan
				,rawat_gudang
			FROM perawatan_konsumsi
			LEFT JOIN produk ON(krawat_produk=produk_id)
			LEFT JOIN perawatan ON(krawat_master=rawat_id)
			WHERE krawat_master='$cabin_rawat' AND produk_aktif='Aktif'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			foreach($rs->result_array() as $row){
				$dti_cabin=array(
				"cabin_dtrawat"=>$cabin_dtrawat,
				"cabin_rawat"=>$cabin_rawat,
				"cabin_produk"=>$row['krawat_produk'],
				"cabin_satuan"=>$row['produk_satuan'],
				"cabin_jumlah"=>$row['krawat_jumlah'],
				"cabin_bukti"=>$cabin_bukti,
				"cabin_gudang"=>$row['rawat_gudang'],
				"cabin_cust"=>$cabin_cust
				);
				$this->db->insert('detail_pakai_cabin', $dti_cabin);
			}
			return '1';
		}
	}
	
	/* DELETE db.detail_pakai_cabin */
	function detail_pakai_cabin_delete($cabin_dtrawat){
		$this->db->where('cabin_dtrawat', $cabin_dtrawat);
		$this->db->delete('detail_pakai_cabin');
		if($this->db->affected_rows()){
			return '1';
		}else{
			return '0';
		}
	}
	
	/* UPDATE db.detail_pakai_cabin */
	function detail_pakai_cabin_update($cabin_dtrawat, $cabin_rawat){
		$this->db->where('cabin_dtrawat', $cabin_dtrawat);
		$this->db->delete('detail_pakai_cabin');
		if($this->db->affected_rows()){
			//ambil jrawat_nobukti dan jrawat_cust from master_jual_rawat
			$sql = "SELECT jrawat_nobukti ,jrawat_cust
				FROM tindakan_detail
				LEFT JOIN detail_jual_rawat ON(drawat_dtrawat=dtrawat_id)
				LEFT JOIN master_jual_rawat ON(drawat_master=jrawat_id)
				WHERE dtrawat_id='$cabin_dtrawat'";
			$rs = $this->db->query($sql);
			if($this->db->affected_rows()){
				$record = $rs->row_array();
				$cabin_bukti = $record['jrawat_nobukti'];
				$cabin_cust = $record['jrawat_cust'];
			}
			//* Mencatat pemakaian Standard Bahan dari perawatan($cabin_rawat) yang terpakai /
			$sql="SELECT krawat_produk
					,krawat_satuan
					,krawat_jumlah
					,produk_satuan
					,rawat_gudang
				FROM perawatan_konsumsi
				LEFT JOIN produk ON(krawat_produk=produk_id)
				LEFT JOIN perawatan ON(krawat_master=rawat_id)
				WHERE krawat_master='$cabin_rawat'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				foreach($rs->result_array() as $row){
					$dti_cabin=array(
					"cabin_dtrawat"=>$cabin_dtrawat,
					"cabin_rawat"=>$cabin_rawat,
					"cabin_produk"=>$row['krawat_produk'],
					"cabin_satuan"=>$row['produk_satuan'],
					"cabin_jumlah"=>$row['krawat_jumlah'],
					"cabin_bukti"=>$cabin_bukti,
					"cabin_gudang"=>$row['rawat_gudang'],
					"cabin_cust"=>$cabin_cust
					);
					$this->db->insert('detail_pakai_cabin', $dti_cabin);
				}
				return '1';
			}
		}
	}
	
	/* INSERT ke db.detail_ambil_paket */
	function detail_ambil_paket_delete($dtrawat_id){
		/* 1. Delete db.detail_ambil_paket ==> where dapaket_dtrawat=$dtrawat_id
		** 2. Delete db.detail_pakai_cabin ==> where cabin_dtrawat=$dtrawat_id
		** 3. Update db.appointment_detail.dapp_locked=0 ==> where dapp_id=db.tindakan_detail.dtrawat_dapp
		** 4. Update db.detail_jual_paket.dpaket_sisa_paket
		*/
		
		$sql="SELECT dapaket_dpaket, dtrawat_dapp, dapaket_jpaket, dapaket_paket
			FROM detail_ambil_paket
			LEFT JOIN tindakan_detail ON(dapaket_dtrawat=dtrawat_id)
			WHERE dapaket_dtrawat='$dtrawat_id'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$record=$rs->row_array();
			$dpaket_id = $record['dapaket_dpaket'];
			$dtrawat_dapp = $record['dtrawat_dapp'];
			$dapaket_dpaket = $record['dapaket_dpaket'];
			$dapaket_jpaket = $record['dapaket_jpaket'];
			$dapaket_paket = $record['dapaket_paket'];
		}
		
		//Delete db.detail_pakai_cabin
		$this->db->where('cabin_dtrawat', $dtrawat_id);
		$this->db->delete('detail_pakai_cabin');
		
		//Delete db.detail_ambil_paket + db.detail_pakai_cabin
		$this->db->where('dapaket_dtrawat', $dtrawat_id);
		$this->db->delete('detail_ambil_paket');
		
		if($this->db->affected_rows()){
			/* meng-UNLOCK db.appointment_detail */
			if($dtrawat_dapp>0){
				$dtu_dapp=array(
				"dapp_locked"=>0
				);
				$this->db->where('dapp_id', $dtrawat_dapp);
				$this->db->update('appointment_detail', $dtu_dapp);
			}
			
			$this->total_sisa_paket_update($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket);
		}
	}
	/* eof detail_ambil_paket_delete */
	
	//purge all detail from master
	function detail_tindakan_medis_detail_purge($master_id){
		$sql="DELETE tindakan_detail FROM tindakan_detail INNER JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE (kategori_nama='Medis' OR kategori_nama ='Surgery') AND dtrawat_master='".$master_id."'";
		$result=$this->db->query($sql);
	}
	//*eof
	
	function detail_tindakan_medis_detail_insert($array_dtrawat_id
												 ,$dtrawat_master
												 ,$array_dtrawat_perawatan
												 ,$array_dtrawat_petugas1
												 ,$array_dtrawat_jamreservasi
												 ,$array_dtrawat_status
												 ,$array_dtrawat_keterangan
												 ,$dtrawat_cust ){
		/* hanya INSERT record tindakan_detail-medis yang baru */
		$date_now=date('Y-m-d');
		$datetime_now=date('Y-m-d H:i:s');
		
		$size_array = sizeof($array_dtrawat_perawatan) - 1;
		
		for($i = 0; $i < sizeof($array_dtrawat_perawatan); $i++){
			$dtrawat_id = $array_dtrawat_id[$i];
			$dtrawat_perawatan = $array_dtrawat_perawatan[$i];
			$dtrawat_petugas1 = $array_dtrawat_petugas1[$i];
			$dtrawat_jamreservasi = $array_dtrawat_jamreservasi[$i];
			$dtrawat_status = $array_dtrawat_status[$i];
			$dtrawat_keterangan = $array_dtrawat_keterangan[$i];
			
			if(is_numeric($dtrawat_id)){
				// Data sudah masuk di db.tindakan_detail, sehingga yang diperbolehkan adalah Editing dengan syarat $dtrawat_status="datang"
				$sqlu = "UPDATE tindakan_detail
					SET dtrawat_perawatan='".$dtrawat_perawatan."'
						,dtrawat_petugas1='".$dtrawat_petugas1."'
						,dtrawat_jam='".$dtrawat_jamreservasi."'
						,dtrawat_keterangan='".$dtrawat_keterangan."'
					WHERE dtrawat_id='".$dtrawat_id."'
						AND dtrawat_status<>'selesai'";
				$this->db->query($sqlu);
				if($this->db->affected_rows()>-1){
					if($i==$size_array){
						return 1;
					}
				}
				
			}else{
				//* data baru /
				if($dtrawat_petugas1==''){
					$sql = "SELECT karyawan_id FROM karyawan WHERE karyawan_no=99";
					$rs = $this->db->query($sql);
					$record = $rs->row_array();
					$dtrawat_petugas1=$record['karyawan_id'];
				}
				if($dtrawat_jamreservasi==''){
					$dtrawat_jamreservasi=date('H:i:s');
				}
				if(is_numeric($dtrawat_perawatan)){
					$dti_dtrawat=array(
					"dtrawat_master"=>$dtrawat_master,
					"dtrawat_perawatan"=>$dtrawat_perawatan,
					"dtrawat_petugas1"=>$dtrawat_petugas1,
					"dtrawat_kategori"=>'Medis',
					"dtrawat_tglapp"=>$date_now,
					"dtrawat_jam"=>$dtrawat_jamreservasi,
					"dtrawat_keterangan"=>$dtrawat_keterangan,
					"dtrawat_creator"=>@$_SESSION[SESSION_USERID]
					);
					$this->db->insert('tindakan_detail', $dti_dtrawat);
					if($this->db->affected_rows()){
						/*$bln_now=date('Y-m');
						//* meng-Counter db.report_tindakan dari Dokter yang dipilih /
						$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dtrawat_petugas1'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$data_reportt=array(
							"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
							);
							$this->db->where('reportt_karyawan_id', $dtrawat_petugas1);
							$this->db->update('report_tindakan', $data_reportt);
						}else{
							$data_reportt=array(
							"reportt_karyawan_id"=>$dtrawat_petugas1,
							"reportt_bln"=>$date_now,
							"reportt_jmltindakan"=>1
							);
							$this->db->insert('report_tindakan', $data_reportt);
						}*/
						if($i==$size_array){
							return 1;
						}
					}else{
						if($i==$size_array){
							return 1;
						}
					}
				}else{
					if($i==$size_array){
						return 1;
					}
				}
			}
			
		}
	}
		
	/* START NON-MEDIS Function */
	function dtindakan_jual_nonmedis_list($master_id,$query,$start,$end) {
		//$query = "SELECT * FROM tindakan_detail,perawatan,karyawan WHERE dtrawat_perawatan=rawat_id AND dtrawat_petugas1=karyawan_id AND dtrawat_master='".$master_id."'";
		$query="SELECT *
			FROM vu_tindakan
			WHERE dtrawat_master='".$master_id."'
				AND kategori_nama='Non Medis'
				AND dtrawat_petugas2='0'
				AND dtrawat_status<>'batal'";
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
        //* ambil dulu db.tindakan_detail.dtrawat_id berdasarkan dtrawat_master untuk digunakan men-Delete db.detail_jual_rawat jika memang sudah masuk di db.detail_jual_rawat
        //* $master_id === db.tindakan.trawat_id /
        $sql="SELECT dtrawat_id
                FROM tindakan_detail
                INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id)
                LEFT JOIN kategori ON(rawat_kategori=kategori_id)
                WHERE dtrawat_master='$master_id'
                        AND kategori_nama='Non Medis'";
        $rs=$this->db->query($sql);
        if($rs->num_rows()){
                foreach($rs->result_array() as $row){
                        $sql="DELETE FROM detail_jual_rawat WHERE drawat_dtrawat='".$row['dtrawat_id']."'";
                        $this->db->query($sql);
                }
        }
        
        //* untuk mend-DELETE tindakan-non-medis yang ada di Form Tindakan Medis */
		$sql="DELETE tindakan_detail
                FROM tindakan_detail
                INNER JOIN perawatan ON(dtrawat_perawatan=rawat_id)
                LEFT JOIN kategori ON(rawat_kategori=kategori_id)
                WHERE dtrawat_master='".$master_id."'
                        AND kategori_nama='Non Medis'
                        AND dtrawat_dapp=0
                        AND dtrawat_petugas1=0
                        AND dtrawat_petugas2=0";
		$result=$this->db->query($sql);
	}
	
	function detail_dtindakan_jual_nonmedis_insert($array_dtrawat_id
												   ,$dtrawat_master
												   ,$array_dtrawat_perawatan
												   ,$array_dtrawat_keterangan
												   ,$customer_id
												   ,$array_dtrawat_jumlah
												   ,$array_dtrawat_status){
		$date_now=date('Y-m-d');
		$datetime_now=date('Y-m-d');
		
		$size_array = sizeof($array_dtrawat_perawatan) - 1;
		
		for($i = 0; $i < sizeof($array_dtrawat_perawatan); $i++){
			$dtrawat_id = $array_dtrawat_id[$i];
			$dtrawat_perawatan = $array_dtrawat_perawatan[$i];
			$dtrawat_keterangan = $array_dtrawat_keterangan[$i];
			$dtrawat_jumlah = $array_dtrawat_jumlah[$i];
			$dtrawat_status = $array_dtrawat_status[$i];
			
			if(is_numeric($dtrawat_id)==false && is_numeric($dtrawat_perawatan)==true){
                //* record baru yg belum ada di db.tindakan_detail /
				
				//* status langsung = 'selesai' /
				$data = array(
					"dtrawat_master"=>$dtrawat_master, 
					"dtrawat_perawatan"=>$dtrawat_perawatan, 
					"dtrawat_keterangan"=>$dtrawat_keterangan,
					"dtrawat_tglapp"=>$date_now,
					"dtrawat_status"=>"selesai",
					"dtrawat_jumlah"=>$dtrawat_jumlah,
					"dtrawat_creator"=>@$_SESSION[SESSION_USERID]
				);
				$this->db->insert('tindakan_detail', $data);
				if($this->db->affected_rows()){
					if($i==$size_array){
						$this->drawat_from_tmedis_nonmedis_list_insert($dtrawat_master);
						return 1;
					}
					
				}else{
					if($i==$size_array){
						$this->drawat_from_tmedis_nonmedis_list_insert($dtrawat_master);
						return 1;
					}
				}
			}else{
				// data sudah ada di db.tindakan_detail ==> mode Edit
				if($dtrawat_status=='selesai'){
					//return 1;
					if($i==$size_array){
						$this->drawat_from_tmedis_nonmedis_list_insert($dtrawat_master);
						return 1;
					}
				}else{
					$sql = "UPDATE tindakan_detail
						SET dtrawat_keterangan='".$dtrawat_keterangan."'
							,dtrawat_jumlah='".$dtrawat_jumlah."'
							,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
							,dtrawat_date_update='".$datetime_now."'
							,dtrawat_revised=(dtrawat_revised+1)
						WHERE dtrawat_id='".$dtrawat_id."'";
					$this->db->query($sql);
					if($this->db->affected_rows()>-1){
						if($i==$size_array){
							$this->drawat_from_tmedis_nonmedis_list_insert($dtrawat_master);
							return 1;
						}
					}else{
						if($i==$size_array){
							$this->drawat_from_tmedis_nonmedis_list_insert($dtrawat_master);
							return 1;
						}
					}
				}
				
			}/*elseif(is_numeric($dtrawat_id)==true){
				//* record sudah ada di tindakan detail, disini proses editing /
				$sql="SELECT dtrawat_id
						,dtrawat_perawatan
						,dtrawat_petugas1
						,dtrawat_jam
					FROM tindakan_detail
					WHERE dtrawat_perawatan='$dtrawat_perawatan'
						AND dtrawat_petugas1='$dtrawat_petugas1'
						AND dtrawat_jam='$dtrawat_jam'
						AND dtrawat_id='$dtrawat_id'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows()){
					$data = array(
					"dtrawat_perawatan"=>$dtrawat_perawatan, 
					"dtrawat_keterangan"=>$dtrawat_keterangan
					);
					$this->db->where('dtrawat_id',$dtrawat_id);
					$this->db->update('tindakan_detail',$data);
				}
			}*/
			
		}
	}
	/* END NON-MEDIS Function */
	
	function report_tindakan_update($dokter_id_awal, $dokter_id_pengganti){
		$date_now=date('Y-m-d');
		$bln_now=date('Y-m');
		
		/* KARENA ada per-GANTI-an Dokter, 
		** maka $dtrawat_dokter_awal(dokter sebelumnya) dilakukan DE-Counter pada db.report_tindakan.reportt_jmltindakan
		*/
		$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dokter_id_awal'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$reportt_jmltindakan=$rs_record["reportt_jmltindakan"];
			//UPDATE jumlah_tindakan
			$dtu_reportt=array(
			"reportt_jmltindakan"=>$reportt_jmltindakan-1
			);
			$this->db->where('reportt_karyawan_id', $dokter_id_awal);
			$this->db->like('reportt_bln', $bln_now, 'after');
			$this->db->update('report_tindakan', $dtu_reportt);
		}
		
		//UPDATE/INSERT ke db.report_tindakan dari Dokter-Pengganti && $dapp_status=='datang'
		$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%' AND reportt_karyawan_id='$dokter_id_pengganti'";
		$rs=$this->db->query($sql);
		if($rs->num_rows()){
			$rs_record=$rs->row_array();
			$dtu_reportt=array(
			"reportt_jmltindakan"=>$rs_record["reportt_jmltindakan"]+1
			);
			$this->db->where('reportt_karyawan_id', $dokter_id_pengganti);
			$this->db->update('report_tindakan', $dtu_reportt);
		}else{
			$dti_reportt=array(
			"reportt_karyawan_id"=>$dokter_id_pengganti,
			"reportt_bln"=>$date_now,
			"reportt_jmltindakan"=>1
			);
			$this->db->insert('report_tindakan', $dti_reportt);
		}
	}
	
	//function for get list record
	function tindakan_list($filter,$start,$end){
		$date_now=date('Y-m-d');
		//$query = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
		//$query = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
		$query = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0' OR kategori_nama ='Surgery')";
		
		// For simple search
		if ($filter<>""){
			$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
			$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR dokter_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
		}
		$query.=" AND dtrawat_status='siap'";
		
		//$query2 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
		//$query2 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
		$query2 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0' OR kategori_nama ='Surgery')";
		
		// For simple search
		if ($filter<>""){
			$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
			$query2 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR dokter_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
		}
		$query2.=" AND dtrawat_status='datang'";
		
		//$query3 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
		//$query3 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
		$query3 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0' OR kategori_nama ='Surgery')";
		
		// For simple search
		if ($filter<>""){
			$query3 .=eregi("WHERE",$query3)? " AND ":" WHERE ";
			$query3 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR dokter_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
		}
		$query3.=" AND dtrawat_status='selesai'";
		
		//$query4 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
		//$query4 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
		$query4 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0' OR kategori_nama ='Surgery')";
		
		// For simple search
		if ($filter<>""){
			$query4 .=eregi("WHERE",$query4)? " AND ":" WHERE ";
			$query4 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR dokter_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
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
	function tindakan_update($trawat_id ,$trawat_keterangan){
		/* Checking db.tindakan_detail WHERE db.tindakan_detail.dtrawat_id = $dtrawat_id DAN semua Field,
		 * JIKA ada salah satu Field yang berubah maka akan di-UPDATE
		 */
		$datetime_now=date('Y-m-d H:i:s');
		$data_tindakan=array(
		"trawat_keterangan"=>$trawat_keterangan
		);
		$this->db->where("trawat_id", $trawat_id);
		$this->db->update("tindakan", $data_tindakan);
		return 1;
	}
		
		
	function tindakan_update_list($trawat_id
								,$dtrawat_id
								,$dtrawat_perawatan
								,$dtrawat_dokter
								,$dtrawat_jam
								,$dtrawat_keterangan
								,$dtrawat_ambil_paket
								,$dtrawat_status){
		
		$datetime_now = date('Y-m-d H:i:s');
		$bln_now=date('Y-m');
		
		//checking db.tindakan_detail.dtrawat_locked = 0 atau = 1 ==> jika = 0, maka bisa di-Edit; jika = 1, maka tidak bisa di-Edit ?
		$sql_check_locked = "SELECT dtrawat_locked
				,dtrawat_perawatan
				,dtrawat_petugas1
				,dtrawat_jam
				,dtrawat_keterangan
				,dtrawat_ambil_paket
				,dtrawat_status
				,trawat_cust
			FROM tindakan_detail
			LEFT JOIN tindakan ON(dtrawat_master=trawat_id)
			WHERE dtrawat_id='$dtrawat_id'";
		$rs_check_locked = $this->db->query($sql_check_locked);
		if($rs_check_locked->num_rows()){
			$record = $rs_check_locked->row_array();
			$dtrawat_locked = $record['dtrawat_locked'];
			$dtrawat_perawatan_awal = $record['dtrawat_perawatan'];
			$dtrawat_dokter_awal = $record['dtrawat_petugas1'];
			$dtrawat_jam_awal = $record['dtrawat_jam'];
			$dtrawat_keterangan_awal = $record['dtrawat_keterangan'];
			$dtrawat_ambil_paket_awal = $record['dtrawat_ambil_paket'];
			$dtrawat_status_awal = $record['dtrawat_status'];
			$trawat_cust = $record['trawat_cust'];
			
			if($dtrawat_locked==0){
				//proses Editing
				//1. Edit dtrawat_status dari ='selesai' menjadi !='selesai'
				if(($dtrawat_status_awal<>$dtrawat_status) && $dtrawat_status_awal=='selesai' && $dtrawat_status<>'selesai'){
					if($dtrawat_ambil_paket_awal=='true'){
						/* $dtrawat_ambil_paket_awal=='true' ==> ini artinya: data sebelumnya sudah masuk ke db.detail_ambil_paket, maka proses editingnya:
						** 1. Delete di db.detail_ambil_paket + Delete db.detail_pakai_cabin
						** 2. Update db.tindakan_detail.
						*/
						$this->detail_ambil_paket_delete($dtrawat_id);
						$sqlu_dtrawat = "UPDATE tindakan_detail
							SET dtrawat_status='$dtrawat_status'
								,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
								,dtrawat_date_update='$datetime_now'
								,dtrawat_revised=dtrawat_revised+1
							WHERE dtrawat_id='$dtrawat_id'";
						$this->db->query($sqlu_dtrawat);
						return '1';
					}else if($dtrawat_ambil_paket_awal=='false'){
						/* $dtrawat_ambil_paket_awal=='true' ==> ini artinya: data sebelumnya sudah masuk ke db.detail_jual_rawat, maka proses editingnya:
						** 1. Delete di db.detail_jual_rawat + Delete db.detail_pakai_cabin
						** 2. Update db.tindakan_detail.
						*/
						$this->detail_jual_rawat_delete($dtrawat_id);
						$sqlu_dtrawat = "UPDATE tindakan_detail
							SET dtrawat_status='$dtrawat_status'
								,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
								,dtrawat_date_update='$datetime_now'
								,dtrawat_revised=dtrawat_revised+1
							WHERE dtrawat_id='$dtrawat_id'";
						$this->db->query($sqlu_dtrawat);
						return '1';
					}
					
				}
				/* Mulai baris elseif ini $dtrawat_status_awal sudah dipastikan !='selesai' ==>
				** karena jika masih ='selesai' tidak bisa melakukan editing selain mengganti status
				** sehingga Update yang dilakukan hanya sebatas di db.tindakan_detail
				*/
				else if($dtrawat_status_awal<>'selesai' && $dtrawat_status_awal<>$dtrawat_status && $dtrawat_status<>'selesai'){
					//Edit status Tindakan dari !='selesai' menjadi !='selesai' yg lain
					$sqlu_dtrawat = "UPDATE tindakan_detail
						SET dtrawat_status='$dtrawat_status'
							,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
							,dtrawat_date_update='$datetime_now'
							,dtrawat_revised=dtrawat_revised+1
						WHERE dtrawat_id='$dtrawat_id'";
					$this->db->query($sqlu_dtrawat);
					return '1';
				}else if($dtrawat_status_awal<>'selesai' && is_numeric($dtrawat_perawatan) && $dtrawat_perawatan_awal<>$dtrawat_perawatan){
					//Edit perawatan ==> jika is_numeric terpenuhi, ini artinya ada perubahan perawatan
					if($dtrawat_ambil_paket_awal=='true'){
						/* Perawatan yg diubah ini harus di check: apakah si Customer memiliki paket u/ perawatan ini atau tidak?
						** jika tidak punya paket, akan keluar message: "bahwa customer tidak punya paket"
						** >>> jika tetap akan mengganti perawatan, maka checkbox ambil-paket harus dihilangkan terlebih dahulu
						** jika punya paket, maka akan update db.tindakan_detail
						*/
						//1. checking kepemilikan paket
						$sql_check_paket=$this->customer_check_paket($trawat_cust, $dtrawat_perawatan);
						if(sizeof($sql_check_paket)>0){
							/* artinya: Customer memiliki paket untuk perawatan yang dipilih
							** UPDATE db.tindakan_detail
							*/
							$sql="UPDATE tindakan_detail
								SET dtrawat_perawatan='$dtrawat_perawatan'
									,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
									,dtrawat_date_update='$datetime_now'
									,dtrawat_revised=dtrawat_revised+1
								WHERE dtrawat_id='$dtrawat_id'";
							$this->db->query($sql);
							if($this->db->affected_rows()){
								return '1';
							}else{
								return '0';
							}
							
						}else{
							return '-1';
						}
						
					}else{
						/* 
						** Mengambil perawatan satuan, maka hanya UPDATE db.tindakan_detail
						*/
						$sql="UPDATE tindakan_detail
							SET dtrawat_perawatan='$dtrawat_perawatan'
								,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
								,dtrawat_date_update='$datetime_now'
								,dtrawat_revised=dtrawat_revised+1
							WHERE dtrawat_id='$dtrawat_id'";
						$this->db->query($sql);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}
				}else if($dtrawat_status_awal<>'selesai' && is_numeric($dtrawat_dokter) && $dtrawat_dokter_awal<>$dtrawat_dokter){
					/* 
					** Edit Dokter, maka lakukan UPDATE db.tindakan_detail dan db.report_tindakan
					*/
					$sql="UPDATE tindakan_detail
						SET dtrawat_petugas1='$dtrawat_dokter'
							,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
							,dtrawat_date_update='$datetime_now'
							,dtrawat_revised=dtrawat_revised+1
						WHERE dtrawat_id='$dtrawat_id'";
					$this->db->query($sql);
					if($this->db->affected_rows()){
						$this->report_tindakan_update($dtrawat_dokter_awal, $dtrawat_dokter);
						return '1';
					}else{
						return '0';
					}
					
				}else if($dtrawat_status_awal<>'selesai' && $dtrawat_jam_awal<>$dtrawat_jam){
					/* 
					** Edit Jam App, maka lakukan UPDATE db.tindakan_detail
					*/
					$sql="UPDATE tindakan_detail
						SET dtrawat_jam='$dtrawat_jam'
							,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
							,dtrawat_date_update='$datetime_now'
							,dtrawat_revised=dtrawat_revised+1
						WHERE dtrawat_id='$dtrawat_id'";
					$this->db->query($sql);
					if($this->db->affected_rows()){
						return '1';
					}else{
						return '0';
					}
				}else if($dtrawat_status_awal<>'selesai' && $dtrawat_keterangan_awal<>$dtrawat_keterangan){
					/* 
					** Edit detail keterangan, maka lakukan UPDATE db.tindakan_detail
					*/
					$sql="UPDATE tindakan_detail
						SET dtrawat_keterangan='$dtrawat_keterangan'
							,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
							,dtrawat_date_update='$datetime_now'
							,dtrawat_revised=dtrawat_revised+1
						WHERE dtrawat_id='$dtrawat_id'";
					$this->db->query($sql);
					if($this->db->affected_rows()){
						return '1';
					}else{
						return '0';
					}
				}else if($dtrawat_status_awal<>'selesai' && $dtrawat_ambil_paket_awal<>$dtrawat_ambil_paket){
					if($dtrawat_ambil_paket_awal=='true' && $dtrawat_ambil_paket=='false'){
						/* 
						** Edit checkbox ambil-paket dari 'true' ke 'false', maka lakukan UPDATE db.tindakan_detail
						*/
						$sql="UPDATE tindakan_detail
							SET dtrawat_ambil_paket='$dtrawat_ambil_paket'
								,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
								,dtrawat_date_update='$datetime_now'
								,dtrawat_revised=dtrawat_revised+1
							WHERE dtrawat_id='$dtrawat_id'";
						$this->db->query($sql);
						if($this->db->affected_rows()){
							return '1';
						}else{
							return '0';
						}
					}else if($dtrawat_ambil_paket_awal=='false' && $dtrawat_ambil_paket=='true'){
						//1. checking kepemilikan paket, dari $trawat_cust dan $dtrawat_perawatan_awal
						$sql_check_paket=$this->customer_check_paket($trawat_cust, $dtrawat_perawatan_awal);
						if(sizeof($sql_check_paket)>0){
							/* artinya: Customer memiliki paket untuk perawatan yang dipilih
							** UPDATE db.tindakan_detail
							*/
							$sql="UPDATE tindakan_detail
								SET dtrawat_ambil_paket='$dtrawat_ambil_paket'
									,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
									,dtrawat_date_update='$datetime_now'
									,dtrawat_revised=dtrawat_revised+1
								WHERE dtrawat_id='$dtrawat_id'";
							$this->db->query($sql);
							if($this->db->affected_rows()){
								return '1';
							}else{
								return '0';
							}
						}else{
							return '-1';
						}
					}else{
						return '0';
					}
				}else if(($dtrawat_status_awal<>$dtrawat_status) && $dtrawat_status_awal<>'selesai' && $dtrawat_status=='selesai'){
					/* Perubahan status dari !='selesai' menjadi ='selesai', yg artinya: tindakan sudah 'selesai' dan masuk bagian Kasir
					 * Proses yg dilakukan:
					 * # Check $dtrawat_ambil_paket_awal
					 * >> Jika = 'false' ==> masuk Kasir Penjualan Perawatan
					 * >> Jika = 'true' ==> masuk Kasir Pengambilan Paket
					 * # Update tindakan_detail
					*/
					if($dtrawat_ambil_paket_awal=='false'){
						$result_drawat_i = $this->detail_jual_rawat_insert($dtrawat_id);
						if($result_drawat_i==1){
							$sql="UPDATE tindakan_detail
								SET dtrawat_status='$dtrawat_status'
									,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
									,dtrawat_date_update='$datetime_now'
									,dtrawat_revised=dtrawat_revised+1
								WHERE dtrawat_id='$dtrawat_id'";
							$this->db->query($sql);
							if($this->db->affected_rows()){
								return '1';
							}else{
								return '0';
							}
						}else{
							return '0';
						}
					}else if($dtrawat_ambil_paket_awal=='true'){
						/* ditujukan untuk Pengambilan Paket, tapi sebelum dimasukkan ke Pengambilan Paket harus di-check terlebih dahulu
						 * # Check kepemilikan paket untuk Customer + Perawatan yang dipilih
						 * >> Jika = Punya ==> masukkan ke Pengambilan Paket
						 * >> Jika = Tidak Punya ==> keluar message: "Customer Tidak Memiliki paket dengan perawatan yang dipilih.
						 * 		Silakan menghilangkan centang Ambil-Paket untuk dimasukkan ke Kasir Penjualan Perawatan."
						*/
						$sql_check_paket=$this->customer_check_paket($trawat_cust, $dtrawat_perawatan_awal);
						if(sizeof($sql_check_paket)>0){
							/* artinya: Customer memiliki paket untuk perawatan yang dipilih
							** UPDATE db.tindakan_detail + INSERT to db.detail_ambil_paket
							*/
							$result_dapaket_i = $this->detail_ambil_paket_insert($sql_check_paket->dpaket_id, $sql_check_paket->dpaket_master, $sql_check_paket->dpaket_paket, $dtrawat_perawatan_awal, $trawat_cust, $dtrawat_id);
							if($result_dapaket_i==1){
								$sql="UPDATE tindakan_detail
									SET dtrawat_status='$dtrawat_status'
										,dtrawat_update='".@$_SESSION[SESSION_USERID]."'
										,dtrawat_date_update='$datetime_now'
										,dtrawat_revised=dtrawat_revised+1
									WHERE dtrawat_id='$dtrawat_id'";
								$this->db->query($sql);
								if($this->db->affected_rows()){
									return '1';
								}else{
									return '0';
								}
							}else{
								return '0';
							}
						}else{
							return '-1';
						}
						
					}else{
						return '0';
					}
					
				}else{
					return '0';
				}
				
			}else{
				//data tidak bisa di-Edit, karena sudah melalui proses printing Faktur di Kasir
				return '-3';
			}
		}else{
			return '-2';
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
		function tindakan_search($trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_dokter ,$trawat_status ,$start,$end){
			//full query
			//$query="SELECT * FROM vu_tindakan WHERE kategori_nama='Medis'";
			//$query = "SELECT * FROM vu_tindakan WHERE (kategori_nama='Medis' OR dtrawat_petugas2='0')";
			//$query = "SELECT vu_tindakan_test.*, IF((vu_cust_punya_paket_test.sapaket_id AND vu_cust_punya_paket_test.sapaket_sisa_item<>0),'ada','tidak_ada') AS cust_punya_paket, vu_cust_punya_paket_test.* FROM vu_tindakan_test LEFT JOIN vu_cust_punya_paket_test ON(vu_cust_punya_paket_test.ppaket_cust=vu_tindakan_test.trawat_cust AND vu_cust_punya_paket_test.sapaket_item=vu_tindakan_test.dtrawat_perawatan AND vu_cust_punya_paket_test.sapaket_jenis_item='perawatan' AND vu_cust_punya_paket_test.sapaket_sisa_item>0) WHERE (vu_tindakan_test.kategori_nama='Medis' OR vu_tindakan_test.dtrawat_petugas2='0')";
			$query = "SELECT * FROM vu_tindakan WHERE (kategori_nama='Medis' OR kategori_nama ='Surgery')";
			
			/*if($trawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.trawat_id LIKE '%".$trawat_id."%'";
			};*/
			if($trawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.trawat_cust = '".$trawat_cust."'";
			};
			if($trawat_rawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.dtrawat_perawatan = '".$trawat_rawat."'";
			};
			if($trawat_dokter!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.dtrawat_petugas1 = '".$trawat_dokter."'";
			};
			if($trawat_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.dtrawat_status = '".$trawat_status."'";
			};
			if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan.dtrawat_tglapp='".$trawat_tglapp_start."'";
			}
			/*if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan_test.dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " vu_tindakan_test.dtrawat_tglapp='".$trawat_tglapp_start."'";
			}*/
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
		function tindakan_print($trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_dokter ,$trawat_status ,$option,$filter){
			//full query
			$query="SELECT cust_no
					,cust_nama
					,rawat_nama
					,dokter_username
					,dtrawat_jam
					,dtrawat_status
					,dtrawat_keterangan
					,dtrawat_ambil_paket
				FROM vu_tindakan
				WHERE (kategori_nama='Medis' OR kategori_nama ='Surgery')";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR dokter_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.trawat_cust = '".$trawat_cust."'";
				};
				if($trawat_rawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_perawatan = '".$trawat_rawat."'";
				};
				if($trawat_dokter!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_petugas1 = '".$trawat_dokter."'";
				};
				if($trawat_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_status = '".$trawat_status."'";
				};
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_tglapp='".$trawat_tglapp_start."'";
				}
				$result = $this->db->query($query);
			}
			return $result->result();
		}
		
		//function  for export to excel
		function tindakan_export_excel($trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_dokter ,$trawat_status ,$option,$filter){
			//full query
			$query = "SELECT cust_no AS no_cust
					,cust_nama AS customer
					,rawat_nama AS perawatan
					,dokter_username AS dokter
					,dtrawat_jam AS jam_app
					,dtrawat_status AS status
					,dtrawat_keterangan AS detail_keterangan
					,dtrawat_ambil_paket AS ambil_paket
				FROM vu_tindakan
				WHERE (kategori_nama='Medis' OR kategori_nama ='Surgery')";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR dokter_username LIKE '%".addslashes($filter)."%' OR dokter_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.trawat_cust = '".$trawat_cust."'";
				};
				if($trawat_rawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_perawatan = '".$trawat_rawat."'";
				};
				if($trawat_dokter!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_petugas1 = '".$trawat_dokter."'";
				};
				if($trawat_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_status = '".$trawat_status."'";
				};
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " vu_tindakan.dtrawat_tglapp='".$trawat_tglapp_start."'";
				}
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>