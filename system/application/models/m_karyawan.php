<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: karyawan Model
	+ Description	: For record model process back-end
	+ Filename 		: c_karyawan.php
 	+ Author  		: Mukhlison
 	+ Created on 06/Aug/2009 17:08:43
	
*/

class M_karyawan extends Model{
		
		//constructor
		function M_karyawan() {
			parent::Model();
		}
		
		function get_karyawan_atasan_list($karyawan_id, $query){
			$sql="SELECT karyawan_id,karyawan_nama FROM karyawan where karyawan_aktif='Aktif'";
			
			if($karyawan_id<>0){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (karyawan_id!='".addslashes($karyawan_id)."')";
			}
			
			if($query!=="") {
			$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (karyawan_id like '%".$query."%' or karyawan_no like '%".$query."%' or karyawan_nama like '%".$query."%')";
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
		
		function get_karyawan_jabatan_list(){
			$sql="SELECT jabatan_id,jabatan_nama FROM jabatan where jabatan_aktif='Aktif';";
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
		
		function get_karyawan_bank_list(){
			$sql="SELECT mbank_id, mbank_nama FROM bank_master where mbank_aktif='Aktif';";
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
		
		function get_karyawan_cabang_list(){
			$sql="SELECT cabang_value,cabang_nama,cabang_id FROM cabang where cabang_aktif='Aktif'";
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
		
		function get_karyawan_departemen_list(){
			$sql="SELECT departemen_id,departemen_nama FROM departemen where departemen_aktif='Aktif'";
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
		
		function get_karyawan_golongan_list(){
			//$sql="SELECT distinct karyawan_golongan FROM karyawan WHERE karyawan_golongan<>''";
			$sql="select distinct nama_golongan, id_golongan from golongan where nama_golongan <>''";
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
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(karyawan_id) as master_id from karyawan";
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
		
		// STATUS KARYAWAN
		//function for detail
		//get record list
		function detail_status_karyawan_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_status where kstatus_master='".$master_id."' order by kstatus_tglakhir ASC";

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
		
		//insert detail record
		function detail_status_karyawan_insert($array_kstatus_id ,$kstatus_master ,$array_kstatus_karyawan, $array_kstatus_tglawal, $array_kstatus_tglakhir, $array_kstatus_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kstatus_master=="" || $kstatus_master==NULL || $kstatus_master==0){
				$kstatus_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_kstatus_tglawal) - 1;
			
			for($i = 0; $i < sizeof($array_kstatus_tglawal); $i++){
				$kstatus_id = $array_kstatus_id[$i];
				$kstatus_master = $kstatus_master;
				$kstatus_karyawan = $array_kstatus_karyawan[$i];
				$kstatus_tglawal = $array_kstatus_tglawal[$i];
				$kstatus_tglakhir = $array_kstatus_tglakhir[$i];
				$kstatus_keterangan = $array_kstatus_keterangan[$i];
				
				$sql = "SELECT kstatus_id
						,kstatus_revised
					FROM karyawan_status
					WHERE kstatus_id='".$kstatus_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kstatus = array(
						"kstatus_master"=>$kstatus_master,
						"kstatus_karyawan"=>$kstatus_karyawan,
						"kstatus_tglawal"=>$kstatus_tglawal,
						"kstatus_tglakhir"=>$kstatus_tglakhir,
						"kstatus_keterangan"=>$kstatus_keterangan,
						//"dcatatan_revised"=>$dcatatan_revised+1
					);
					$this->db->where('kstatus_id', $kstatus_id);
					$this->db->update('karyawan_status', $dtu_kstatus); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_status set kstatus_revised=(kstatus_revised+1) WHERE kstatus_id='".$kstatus_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kstatus_master"=>$kstatus_master,
						"kstatus_karyawan"=>$kstatus_karyawan,
						"kstatus_tglawal"=>$kstatus_tglawal,
						"kstatus_tglakhir"=>$kstatus_tglakhir,
						"kstatus_keterangan"=>$kstatus_keterangan,
					);
					$this->db->insert('karyawan_status', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_status_karyawan
        function detail_status_karyawan_delete($kstatus_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_status WHERE kstatus_id = ".$kstatus_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF STATUS KARYAWAN
		
		// JABATAN
		function detail_jabatan_list ($master_id,$query,$start,$end){
			$query = "SELECT 
					karyawan_jabatan.*, departemen.departemen_nama AS departemen_nama,
					jabatan.jabatan_nama AS jabatan_nama,
					golongan.nama_golongan AS golongan_nama,
					karyawan.karyawan_nama AS atasan_nama
					FROM karyawan_jabatan	
					LEFT JOIN departemen ON departemen.departemen_nama = karyawan_jabatan.kjabatan_departemen
					LEFT JOIN jabatan ON jabatan.jabatan_id = karyawan_jabatan.kjabatan_jabatan
					LEFT JOIN golongan ON golongan.id_golongan = karyawan_jabatan.kjabatan_golongan
					LEFT JOIN karyawan ON karyawan.karyawan_id = karyawan_jabatan.kjabatan_atasan 
					WHERE kjabatan_master='".$master_id."'
					ORDER BY karyawan_jabatan.kjabatan_tglakhir ASC";

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
		
		//insert detail record
		function detail_jabatan_insert($array_djabatan_id ,$djabatan_master ,$array_djabatan_departemen, $array_djabatan_jabatan, $array_djabatan_golongan, 
		$array_djabatan_pph21, $array_djabatan_atasan, $array_djabatan_tglawal, $array_djabatan_tglakhir, $array_djabatan_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($djabatan_master=="" || $djabatan_master==NULL || $djabatan_master==0){
				$djabatan_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_djabatan_departemen) - 1;
			
			for($i = 0; $i < sizeof($array_djabatan_departemen); $i++){
				$djabatan_id			= $array_djabatan_id[$i]; 
				$djabatan_master		= $djabatan_master;
				$djabatan_departemen	= $array_djabatan_departemen[$i];
				$djabatan_jabatan		= $array_djabatan_jabatan[$i];
				$djabatan_golongan		= $array_djabatan_golongan[$i];
				$djabatan_pph21			= $array_djabatan_pph21[$i];
				$djabatan_atasan		= $array_djabatan_atasan[$i];
				$djabatan_tglawal		= $array_djabatan_tglawal[$i];
				$djabatan_tglakhir		= $array_djabatan_tglakhir[$i];
				$djabatan_keterangan	= $array_djabatan_keterangan[$i];
				
				$sql = "SELECT kjabatan_id
						,kjabatan_revised
					FROM karyawan_jabatan
					WHERE kjabatan_id='".$djabatan_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kjabatan = array(
						"kjabatan_master"=>$djabatan_master,
						"kjabatan_departemen"=>$djabatan_departemen,
						"kjabatan_jabatan"=>$djabatan_jabatan,
						"kjabatan_golongan"=>$djabatan_golongan,
						"kjabatan_pph21"=>$djabatan_pph21,
						"kjabatan_atasan"=>$djabatan_atasan,
						"kjabatan_tglawal"=>$djabatan_tglawal,
						"kjabatan_tglakhir"=>$djabatan_tglakhir,
						"kjabatan_keterangan"=>$djabatan_keterangan,
					);
					$this->db->where('kjabatan_id', $djabatan_id);
					$this->db->update('karyawan_jabatan', $dtu_kjabatan); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_jabatan set kjabatan_revised=(kjabatan_revised+1) WHERE kjabatan_id='".$djabatan_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kjabatan_master"=>$djabatan_master,
						"kjabatan_departemen"=>$djabatan_departemen,
						"kjabatan_jabatan"=>$djabatan_jabatan,
						"kjabatan_golongan"=>$djabatan_golongan,
						"kjabatan_pph21"=>$djabatan_pph21,
						"kjabatan_atasan"=>$djabatan_atasan,
						"kjabatan_tglawal"=>$djabatan_tglawal,
						"kjabatan_tglakhir"=>$djabatan_tglakhir,
						"kjabatan_keterangan"=>$djabatan_keterangan,
						"kjabatan_revised"=>0,
					);
					$this->db->insert('karyawan_jabatan', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_jabatan_karyawan
        function detail_jabatan_delete($kstatus_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_jabatan WHERE kjabatan_id = ".$kjabatan_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		//EOF JABATAN
		
		// PENDIDIKAN
		//function for detail
		//get record list
		function detail_pendidikan_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_pendidikan where kpendidikan_master='".$master_id."' ORDER BY kpendidikan_thnselesai ASC";

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
		
		//insert detail record
		function detail_pendidikan_insert($array_kpendidikan_id ,$kpendidikan_master ,$array_kpendidikan_pendidikan, $array_kpendidikan_sekolah, $array_kpendidikan_jurusan, $array_kpendidikan_thnmasuk, $array_kpendidikan_thnselesai, $array_kpendidikan_wisuda, $array_kpendidikan_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kpendidikan_master=="" || $kpendidikan_master==NULL || $kpendidikan_master==0){
				$kpendidikan_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_kpendidikan_pendidikan) - 1;
			for($i = 0; $i < sizeof($array_kpendidikan_pendidikan); $i++){
				$kpendidikan_id = $array_kpendidikan_id[$i];
				$kpendidikan_master = $kpendidikan_master;
				$kpendidikan_pendidikan = $array_kpendidikan_pendidikan[$i];
				$kpendidikan_sekolah = $array_kpendidikan_sekolah[$i];
				$kpendidikan_jurusan = $array_kpendidikan_jurusan[$i];
				$kpendidikan_thnmasuk = $array_kpendidikan_thnmasuk[$i];
				$kpendidikan_thnselesai = $array_kpendidikan_thnselesai[$i];
				$kpendidikan_wisuda = $array_kpendidikan_wisuda[$i];
				$kpendidikan_keterangan = $array_kpendidikan_keterangan[$i];
				
				$sql = "SELECT kpendidikan_id
						,kpendidikan_revised
					FROM karyawan_pendidikan
					WHERE kpendidikan_id='".$kpendidikan_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kpendidikan = array(
						"kpendidikan_master"=>$kpendidikan_master,
						"kpendidikan_pendidikan"=>$kpendidikan_pendidikan,
						"kpendidikan_sekolah"=>$kpendidikan_sekolah,
						"kpendidikan_jurusan"=>$kpendidikan_jurusan,
						"kpendidikan_thnmasuk"=>$kpendidikan_thnmasuk,
						"kpendidikan_thnselesai"=>$kpendidikan_thnselesai,
						"kpendidikan_wisuda"=>$kpendidikan_wisuda,
						"kpendidikan_keterangan"=>$kpendidikan_keterangan,

						//"dcatatan_revised"=>$dcatatan_revised+1
					);
					$this->db->where('kpendidikan_id', $kpendidikan_id);
					$this->db->update('karyawan_pendidikan', $dtu_kpendidikan); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_pendidikan set kpendidikan_revised=(kpendidikan_revised+1) WHERE kpendidikan_id='".$kpendidikan_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kpendidikan_master"=>$kpendidikan_master,
						"kpendidikan_pendidikan"=>$kpendidikan_pendidikan,
						"kpendidikan_sekolah"=>$kpendidikan_sekolah,
						"kpendidikan_jurusan"=>$kpendidikan_jurusan,
						"kpendidikan_thnmasuk"=>$kpendidikan_thnmasuk,
						"kpendidikan_thnselesai"=>$kpendidikan_thnselesai,
						"kpendidikan_wisuda"=>$kpendidikan_wisuda,
						"kpendidikan_keterangan"=>$kpendidikan_keterangan,
					);
					$this->db->insert('karyawan_pendidikan', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_pendidikan
        function detail_pendidikan_delete($kpendidikan_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_pendidikan WHERE kpendidikan_id = ".$kpendidikan_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF PENDIDIKAN
		
		// KELUARGA
		//function for detail
		//get record list
		function detail_keluarga_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_keluarga where kkeluarga_master='".$master_id."'";

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
		
		//insert detail record
		function detail_keluarga_insert($array_kkeluarga_id ,$kkeluarga_master ,$array_kkeluarga_nama, $array_kkeluarga_hubungan, $array_kkeluarga_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kkeluarga_master=="" || $kkeluarga_master==NULL || $kkeluarga_master==0){
				$kkeluarga_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_kkeluarga_nama) - 1;
			for($i = 0; $i < sizeof($array_kkeluarga_nama); $i++){
				$kkeluarga_id = $array_kkeluarga_id[$i];
				$kkeluarga_master = $kkeluarga_master;
				$kkeluarga_nama = $array_kkeluarga_nama[$i];
				$kkeluarga_hubungan = $array_kkeluarga_hubungan[$i];
				$kkeluarga_keterangan = $array_kkeluarga_keterangan[$i];

				$sql = "SELECT kkeluarga_id
						,kkeluarga_revised
					FROM karyawan_keluarga
					WHERE kkeluarga_id='".$kkeluarga_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kkeluarga = array(
						"kkeluarga_master"=>$kkeluarga_master,
						"kkeluarga_nama"=>$kkeluarga_nama,
						"kkeluarga_hubungan"=>$kkeluarga_hubungan,
						"kkeluarga_keterangan"=>$kkeluarga_keterangan
					);
					$this->db->where('kkeluarga_id', $kkeluarga_id);
					$this->db->update('karyawan_keluarga', $dtu_kkeluarga); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_keluarga set kkeluarga_revised=(kkeluarga_revised+1) WHERE kkeluarga_id='".$kkeluarga_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kkeluarga_master"=>$kkeluarga_master,
						"kkeluarga_nama"=>$kkeluarga_nama,
						"kkeluarga_hubungan"=>$kkeluarga_hubungan,
						"kkeluarga_keterangan"=>$kkeluarga_keterangan
					);
					$this->db->insert('karyawan_keluarga', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_keluarga
        function detail_keluarga_delete($kkeluarga_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_keluarga WHERE kkeluarga_id = ".$kkeluarga_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF KELUARGA
		
		// CUTI
		//function for detail
		//get record list
		function detail_cuti_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_cuti where kcuti_master='".$master_id."' ORDER BY kcuti_tglakhir ASC";

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
		
		//insert detail record
		function detail_cuti_insert($array_kcuti_id, $kcuti_master, $array_kcuti_jenis ,$array_kcuti_tglawal, $array_kcuti_tglakhir, $array_kcuti_jmlhari, $array_kcuti_tglpengajuan, $array_kcuti_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kcuti_master=="" || $kcuti_master==NULL || $kcuti_master==0){
				$kcuti_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_kcuti_jenis) - 1;
			for($i = 0; $i < sizeof($array_kcuti_jenis); $i++){
				$kcuti_id = $array_kcuti_id[$i];
				$kcuti_master = $kcuti_master;
				$kcuti_jenis = $array_kcuti_jenis[$i];
				$kcuti_tglawal = $array_kcuti_tglawal[$i];
				$kcuti_tglakhir = $array_kcuti_tglakhir[$i];
				$kcuti_jmlhari = $array_kcuti_jmlhari[$i];
				$kcuti_tglpengajuan = $array_kcuti_tglpengajuan[$i];
				$kcuti_keterangan = $array_kcuti_keterangan[$i];

				$sql = "SELECT kcuti_id
						,kcuti_revised
					FROM karyawan_cuti
					WHERE kcuti_id='".$kcuti_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kcuti = array(
						"kcuti_master"=>$kcuti_master,
						"kcuti_jenis"=>$kcuti_jenis,
						"kcuti_tglawal"=>$kcuti_tglawal,
						"kcuti_tglakhir"=>$kcuti_tglakhir,
						"kcuti_jmlhari"=>$kcuti_jmlhari,
						"kcuti_tglpengajuan"=>$kcuti_tglpengajuan,
						"kcuti_keterangan"=>$kcuti_keterangan
					);
					$this->db->where('kcuti_id', $kcuti_id);
					$this->db->update('karyawan_cuti', $dtu_kcuti); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_cuti set kcuti_revised=(kcuti_revised+1) WHERE kcuti_id='".$kcuti_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kcuti_master"=>$kcuti_master,
						"kcuti_jenis"=>$kcuti_jenis,
						"kcuti_tglawal"=>$kcuti_tglawal,
						"kcuti_tglakhir"=>$kcuti_tglakhir,
						"kcuti_jmlhari"=>$kcuti_jmlhari,
						"kcuti_tglpengajuan"=>$kcuti_tglpengajuan,
						"kcuti_keterangan"=>$kcuti_keterangan
					);
					$this->db->insert('karyawan_cuti', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_cuti
        function detail_cuti_delete($kcuti_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_cuti WHERE kcuti_id = ".$kcuti_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF CUTI
		
		// GANTIOFF
		//function for detail
		//get record list
		function detail_gantioff_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_gantioff where kgantioff_master='".$master_id."' ORDER BY kgantioff_tglakhir";

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
		
		//insert detail record
		function detail_gantioff_insert($array_kgantioff_id , $kgantioff_master, $array_kgantioff_jenis ,$array_kgantioff_tglawal, $array_kgantioff_tglakhir, $array_kgantioff_jmlhari, $array_kgantioff_tglgantiawal, $array_kgantioff_tglgantiakhir, $array_kgantioff_tglpengajuan, $array_kgantioff_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kgantioff_master=="" || $kgantioff_master==NULL || $kgantioff_master==0){
				$kgantioff_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_kgantioff_jenis) - 1;
			for($i = 0; $i < sizeof($array_kgantioff_jenis); $i++){
				$kgantioff_id = $array_kgantioff_id[$i];
				$kgantioff_master = $kgantioff_master;
				$kgantioff_jenis = 'Ganti Off';
				$kgantioff_tglawal = $array_kgantioff_tglawal[$i];
				$kgantioff_tglakhir = $array_kgantioff_tglakhir[$i];
				$kgantioff_jmlhari = $array_kgantioff_jmlhari[$i];
				$kgantioff_tglgantiawal = $array_kgantioff_tglgantiawal[$i];
				$kgantioff_tglgantiakhir = $array_kgantioff_tglgantiakhir[$i];
				$kgantioff_tglpengajuan = $array_kgantioff_tglpengajuan[$i];
				$kgantioff_keterangan = $array_kgantioff_keterangan[$i];

				$sql = "SELECT kgantioff_id
						,kgantioff_revised
					FROM karyawan_gantioff
					WHERE kgantioff_id='".$kgantioff_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kgantioff = array(
						"kgantioff_master"=>$kgantioff_master,
						"kgantioff_jenis"=>$kgantioff_jenis,
						"kgantioff_tglawal"=>$kgantioff_tglawal,
						"kgantioff_tglakhir"=>$kgantioff_tglakhir,
						"kgantioff_jmlhari"=>$kgantioff_jmlhari,
						"kgantioff_tglgantiawal"=>$kgantioff_tglgantiawal,
						"kgantioff_tglgantiakhir"=>$kgantioff_tglgantiakhir,
						"kgantioff_tglpengajuan"=>$kgantioff_tglpengajuan,
						"kgantioff_keterangan"=>$kgantioff_keterangan
					);
					$this->db->where('kgantioff_id', $kgantioff_id);
					$this->db->update('karyawan_gantioff', $dtu_kgantioff); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_gantioff set kgantioff_revised=(kgantioff_revised+1) WHERE kgantioff_id='".$kgantioff_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kgantioff_master"=>$kgantioff_master,
						"kgantioff_jenis"=>$kgantioff_jenis,
						"kgantioff_tglawal"=>$kgantioff_tglawal,
						"kgantioff_tglakhir"=>$kgantioff_tglakhir,
						"kgantioff_jmlhari"=>$kgantioff_jmlhari,
						"kgantioff_tglgantiawal"=>$kgantioff_tglgantiawal,
						"kgantioff_tglgantiakhir"=>$kgantioff_tglgantiakhir,
						"kgantioff_tglpengajuan"=>$kgantioff_tglpengajuan,
						"kgantioff_keterangan"=>$kgantioff_keterangan
					);
					$this->db->insert('karyawan_gantioff', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_gantioff
        function detail_gantioff_delete($kgantioff_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_gantioff WHERE kgantioff_id = ".$kgantioff_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF GANTIOFF
		
		// MEDICAL
		//function for detail
		//get record list
		function detail_medical_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_medical where kmedical_master='".$master_id."' ORDER BY kmedical_tglpengajuan ASC";

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
		
		//insert detail record
		function detail_medical_insert($array_kmedical_id , $kmedical_master, $array_kmedical_tujuan ,$array_kmedical_jenis_rawat, $array_kmedical_jenis_klaim, $array_kmedical_jumlah, $array_kmedical_total, $array_kmedical_tglpengajuan, $array_kmedical_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kmedical_master=="" || $kmedical_master==NULL || $kmedical_master==0){
				$kmedical_master=$this->get_master_id();
			}

			for($i = 0; $i < sizeof($array_kmedical_tujuan); $i++){
				$kmedical_id = $array_kmedical_id[$i];
				$kmedical_master = $kmedical_master;
				$kmedical_tujuan = $array_kmedical_tujuan[$i];
				$kmedical_jenis_rawat = $array_kmedical_jenis_rawat[$i];
				$kmedical_jenis_klaim = $array_kmedical_jenis_klaim[$i];
				$kmedical_jumlah = $array_kmedical_jumlah[$i];
				$kmedical_total = $array_kmedical_total[$i];
				$kmedical_tglpengajuan = $array_kmedical_tglpengajuan[$i];
				$kmedical_keterangan = $array_kmedical_keterangan[$i];

				$sql = "SELECT kmedical_id
						,kmedical_revised
					FROM karyawan_medical
					WHERE kmedical_id='".$kmedical_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kmedical = array(
						"kmedical_master"=>$kmedical_master,
						"kmedical_tujuan"=>$kmedical_tujuan,
						"kmedical_jenis_rawat"=>$kmedical_jenis_rawat,
						"kmedical_jenis_klaim"=>$kmedical_jenis_klaim,
						"kmedical_jumlah"=>$kmedical_jumlah,
						"kmedical_total"=>$kmedical_total,
						"kmedical_tglpengajuan"=>$kmedical_tglpengajuan,
						"kmedical_keterangan"=>$kmedical_keterangan
					);
					$this->db->where('kmedical_id', $kmedical_id);
					$this->db->update('karyawan_medical', $dtu_kmedical); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_medical set kmedical_revised=(kmedical_revised+1) WHERE kmedical_id='".$kmedical_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kmedical_master"=>$kmedical_master,
						"kmedical_tujuan"=>$kmedical_tujuan,
						"kmedical_jenis_rawat"=>$kmedical_jenis_rawat,
						"kmedical_jenis_klaim"=>$kmedical_jenis_klaim,
						"kmedical_jumlah"=>$kmedical_jumlah,
						"kmedical_total"=>$kmedical_total,
						"kmedical_tglpengajuan"=>$kmedical_tglpengajuan,
						"kmedical_keterangan"=>$kmedical_keterangan
					);
					$this->db->insert('karyawan_medical', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_medical
        function detail_medical_delete($kmedical_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_medical WHERE kmedical_id = ".$kmedical_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF MEDICAL
		
		// FASILITAS
		//function for detail
		//get record list
		function detail_fasilitas_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM karyawan_fasilitas where kfasilitas_master='".$master_id."' ORDER BY kfasilitas_tglserahterima ASC";

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
		
		//insert detail record
		function detail_fasilitas_insert($array_kfasilitas_id ,$kfasilitas_master ,$array_kfasilitas_item, $array_kfasilitas_tglserahterima, $array_kfasilitas_keterangan){
			//$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($kfasilitas_master=="" || $kfasilitas_master==NULL || $kfasilitas_master==0){
				$kfasilitas_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_kfasilitas_item) - 1;
			for($i = 0; $i < sizeof($array_kfasilitas_item); $i++){
				$kfasilitas_id = $array_kfasilitas_id[$i];
				$kfasilitas_master = $kfasilitas_master;
				$kfasilitas_item = $array_kfasilitas_item[$i];
				$kfasilitas_tglserahterima = $array_kfasilitas_tglserahterima[$i];
				$kfasilitas_keterangan = $array_kfasilitas_keterangan[$i];

				$sql = "SELECT kfasilitas_id
						,kfasilitas_revised
					FROM karyawan_fasilitas
					WHERE kfasilitas_id='".$kfasilitas_id."'";
				$rs = $this->db->query($sql);
				
				if($rs->num_rows()){
				// jika datanya sudah ada maka update saja
					$dtu_kfasilitas = array(
						"kfasilitas_master"=>$kfasilitas_master,
						"kfasilitas_item"=>$kfasilitas_item,
						"kfasilitas_tglserahterima"=>$kfasilitas_tglserahterima,
						"kfasilitas_keterangan"=>$kfasilitas_keterangan
					);
					$this->db->where('kfasilitas_id', $kfasilitas_id);
					$this->db->update('karyawan_fasilitas', $dtu_kfasilitas); 
					if($this->db->affected_rows()){
						$sql="UPDATE karyawan_fasilitas set kfasilitas_revised=(kfasilitas_revised+1) WHERE kfasilitas_id='".$kfasilitas_id."'";
						$this->db->query($sql);
					}
				} else {
					$data = array(
						"kfasilitas_master"=>$kfasilitas_master,
						"kfasilitas_item"=>$kfasilitas_item,
						"kfasilitas_tglserahterima"=>$kfasilitas_tglserahterima,
						"kfasilitas_keterangan"=>$kfasilitas_keterangan
					);
					$this->db->insert('karyawan_fasilitas', $data); 
					
				}
					
				}
				return '1';
		}
		//end of function
		
		//Delete detail_fasilitas
        function detail_fasilitas_delete($kfasilitas_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$query = "DELETE FROM karyawan_fasilitas WHERE kfasilitas_id = ".$kfasilitas_id;
			$this->db->query($query);
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '-1';
		}
		// EOF FASILITAS
		
		//function for get list record
		function karyawan_list($filter,$start,$end){
			//$query = "SELECT * FROM karyawan,departemen,cabang,jabatan,golongan where karyawan_departemen=departemen_id and karyawan_cabang=cabang_id and karyawan_jabatan=jabatan_id and karyawan_idgolongan=id_karyawan_golongan";
			$query = "SELECT karyawan.*, departemen.*, cabang.*, jabatan.jabatan_nama, bank_master.mbank_nama as karyawan_bank_nama, golongan.* FROM karyawan
						left join departemen on (departemen.departemen_id=karyawan.karyawan_departemen)
						left join cabang on (cabang.cabang_id=karyawan.karyawan_cabang)
						left join jabatan on (jabatan.jabatan_id=karyawan.karyawan_jabatan)
						left join golongan on (golongan.id_golongan=karyawan.karyawan_idgolongan)
						left join bank_master on (bank_master.mbank_id = karyawan.karyawan_bank)";
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan_no = '".addslashes($filter)."' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR jabatan_nama LIKE '%".addslashes($filter)."%' OR departemen_nama LIKE '%".addslashes($filter)."%' )";
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
		function karyawan_update($karyawan_id ,$karyawan_no, $karyawan_noktp, $karyawan_alamatktp, $karyawan_agama, $karyawan_bank, $karyawan_bankcabang, $karyawan_norekening, $karyawan_atasnama, $karyawan_atasnama, $karyawan_jamsostek, $karyawan_sip, $karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin , $karyawan_marriage,  $karyawan_jmlanak, $karyawan_tgllahir ,$karyawan_tmplahir, $karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang, $karyawan_tglmasuk, $karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised, $karyawan_cab_th ,$karyawan_cab_ki ,$karyawan_cab_hr ,$karyawan_cab_tp ,$karyawan_cab_dps ,$karyawan_cab_jkt ,$karyawan_cab_mta ,$karyawan_cab_blpn ,$karyawan_cab_kuta ,$karyawan_cab_btm ,$karyawan_cab_mks ,$karyawan_cab_mdn ,$karyawan_cab_lbk ,$karyawan_cab_mnd ,$karyawan_cab_ygk, $karyawan_cab_mlg ,$karyawan_cab_corp ,$karyawan_cab_maa,$karyawan_cab_mg ){
				
		if($karyawan_cab_th=='true')
			$th="1";
		if($karyawan_cab_th=='false')
			$th="0";	
			
		if($karyawan_cab_ki=='true')
			$ki="1";
		if($karyawan_cab_ki=='false')
			$ki="0";			

		if($karyawan_cab_hr=='true')
			$hr="1";
		if($karyawan_cab_hr=='false')
			$hr="0";	
			
		if($karyawan_cab_tp=='true')
			$tp="1";
		if($karyawan_cab_tp=='false')
			$tp="0";	
			
		if($karyawan_cab_dps=='true')
			$dps="1";
		if($karyawan_cab_dps=='false')
			$dps="0";	
			
		if($karyawan_cab_jkt=='true')
			$jkt="1";
		if($karyawan_cab_jkt=='false')
			$jkt="0";	
		
		if($karyawan_cab_mta=='true')
			$mta="1";
		if($karyawan_cab_mta=='false')
			$mta="0";
			
		if($karyawan_cab_blpn=='true')
			$blpn="1";
		if($karyawan_cab_blpn=='false')
			$blpn="0";	
			
		if($karyawan_cab_kuta=='true')
			$kuta="1";
		if($karyawan_cab_kuta=='false')
			$kuta="0";	
			
		if($karyawan_cab_btm=='true')
			$btm="1";
		if($karyawan_cab_btm=='false')
			$btm="0";	
			
		if($karyawan_cab_mks=='true')
			$mks="1";
		if($karyawan_cab_mks=='false')
			$mks="0";	
			
		if($karyawan_cab_mdn=='true')
			$mdn="1";
		if($karyawan_cab_mdn=='false')
			$mdn="0";	
			
		if($karyawan_cab_lbk=='true')
			$lbk="1";
		if($karyawan_cab_lbk=='false')
			$lbk="0";	
			
		if($karyawan_cab_mnd=='true')
			$mnd="1";
		if($karyawan_cab_mnd=='false')
			$mnd="0";	
			
		if($karyawan_cab_ygk=='true')
			$ygk="1";
		if($karyawan_cab_ygk=='false')
			$ygk="0";	
			
		if($karyawan_cab_mlg=='true')
			$mlg="1";
		if($karyawan_cab_mlg=='false')
			$mlg="0";	
			
		if($karyawan_cab_corp=='true')
			$corp="1";
		if($karyawan_cab_corp=='false')
			$corp="0";	
			
		if($karyawan_cab_maa=='true')
			$maa="1";
		if($karyawan_cab_maa=='false')
			$maa="0";	
			
		if($karyawan_cab_mg=='true')
			$mg="1";
		if($karyawan_cab_mg=='false')
			$mg="0";	
			
		$temp_cabang=$th.$ki.$hr.$tp.$dps.$jkt.$mta.$blpn.$kuta.$btm.$mks.$mdn.$lbk.$mnd.$ygk.$mlg.$corp.$maa.$mg;
		
		//autogenerate NIK
		if($karyawan_no=="")
		{	
			if(is_numeric($karyawan_cabang))
				{$sql_cabang_kode = "SELECT c.cabang_kode FROM cabang c, karyawan k WHERE c.cabang_id = ".$karyawan_cabang;}
			else
			{	$sql_cabang_kode = "SELECT c.cabang_kode FROM cabang c, karyawan k WHERE c.cabang_nama = '".$karyawan_cabang."'";}
			
			$a_cabang_kode = $this->db->query($sql_cabang_kode);
			if($a_cabang_kode->num_rows()>0){
				$record = $a_cabang_kode->row_array();
				$cabang_kode = $record['cabang_kode'];
			}		
			$karyawan_tglmasuk_pattern=strtotime($karyawan_tglmasuk);
			$pattern=$cabang_kode."/".date("ym",$karyawan_tglmasuk_pattern)."-";
			$panjang = strlen($cabang_kode);
			$pjg = 11;		
			if ($panjang==4)
				$pjg = 13;
			else if ($panjang==3)
				$pjg = 12;		
			
			$karyawan_no=$this->m_public_function->get_nik_karyawan('karyawan','karyawan_no',$pattern,$pjg);
		}//end of autogenerate NIK
	
		if ($karyawan_aktif=="")
			$karyawan_aktif = "Aktif";

			
			$data = array(
				"karyawan_id"=>$karyawan_id,
				"karyawan_no"=>$karyawan_no,
				"karyawan_sip"=>$karyawan_sip,
				"karyawan_ktp"=>$karyawan_noktp,
				"karyawan_alamat_ktp"=>$karyawan_alamatktp,
				"karyawan_agama"=>$karyawan_agama,
				//"karyawan_bank"=>$karyawan_bank,
				"karyawan_bank_cabang"=>$karyawan_bankcabang,
				"karyawan_rekening"=>$karyawan_norekening,
				"karyawan_atasnama"=>$karyawan_atasnama,
				"karyawan_jamsostek"=>$karyawan_jamsostek,
				"karyawan_npwp"=>$karyawan_npwp,			
				"karyawan_username"=>$karyawan_username,			
				"karyawan_nama"=>$karyawan_nama,			
				"karyawan_kelamin"=>$karyawan_kelamin,
				//"karyawan_pph21"=>$karyawan_pph21,
				"karyawan_marriage"=>$karyawan_marriage,
				"karyawan_jmlanak"=>$karyawan_jmlanak,
				"karyawan_tgllahir"=>$karyawan_tgllahir,
				"karyawan_tmplahir"=>$karyawan_tmplahir,
				"karyawan_alamat"=>$karyawan_alamat,			
				"karyawan_kota"=>$karyawan_kota,			
				"karyawan_kodepos"=>$karyawan_kodepos,			
				"karyawan_email"=>$karyawan_email,
				"karyawan_emiracle"=>$karyawan_emiracle,
				"karyawan_keterangan"=>$karyawan_keterangan,
				"karyawan_notelp"=>$karyawan_notelp,			
				"karyawan_notelp2"=>$karyawan_notelp2,			
				"karyawan_notelp3"=>$karyawan_notelp3,
				"karyawan_notelp4"=>$karyawan_notelp4,
				//"karyawan_idgolongan"=>$karyawan_idgolongan,
				"karyawan_tglmasuk"=>$karyawan_tglmasuk,			
				//"karyawan_atasan"=>$karyawan_atasan,			
				"karyawan_aktif"=>$karyawan_aktif,			
				// "karyawan_creator"=>$karyawan_creator,			
				// "karyawan_date_create"=>$karyawan_date_create,			
				"karyawan_update"=>$_SESSION[SESSION_USERID],	
				"karyawan_cabang2"=>$temp_cabang,				
				"karyawan_date_update"=>date('Y-m-d H:i:s')		
				// "karyawan_revised"=>$karyawan_revised			
			);
			
			$sql="SELECT cabang_id FROM cabang WHERE cabang_id='".$karyawan_cabang."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_cabang"]=$karyawan_cabang;
				
			$sql="SELECT mbank_id FROM bank_master WHERE mbank_id='".$karyawan_bank."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_bank"]=$karyawan_bank;
			/*
			$sql="SELECT jabatan_id FROM jabatan WHERE jabatan_id='".$karyawan_jabatan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_jabatan"]=$karyawan_jabatan;
			
			$sql="SELECT departemen_id FROM departemen WHERE departemen_id='".$karyawan_departemen."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_departemen"]=$karyawan_departemen;
				
			$sql="SELECT id_golongan FROM golongan WHERE id_golongan='".$karyawan_idgolongan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_idgolongan"]=$karyawan_idgolongan;	
				

			$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='".$karyawan_atasan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_atasan"]=$karyawan_atasan;
			*/
			$this->db->where('karyawan_id', $karyawan_id);
			$this->db->update('karyawan', $data);
			if($this->db->affected_rows()){
				$sql="UPDATE karyawan set karyawan_revised=(karyawan_revised+1) WHERE karyawan_id='".$karyawan_id."'";
				$this->db->query($sql);
			}
			return '1';
		}
		
		//function for create new record
		/*
		function karyawan_create($karyawan_no ,$karyawan_sip, $karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_pph21 ,$karyawan_marriage ,$karyawan_tgllahir ,$karyawan_tmplahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_tgl_batas ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised, $karyawan_cab_th ,$karyawan_cab_ki ,$karyawan_cab_hr ,$karyawan_cab_tp ,$karyawan_cab_dps ,$karyawan_cab_jkt ,$karyawan_cab_mta ,$karyawan_cab_blpn ,$karyawan_cab_kuta ,$karyawan_cab_btm ,$karyawan_cab_mks ,$karyawan_cab_mdn ,$karyawan_cab_lbk ,$karyawan_cab_mnd ,$karyawan_cab_ygk, $karyawan_cab_mlg ,$karyawan_cab_corp ,$karyawan_cab_maa,$karyawan_cab_mg,$cabang_date_create ){
		*/
		function karyawan_create($karyawan_no, $karyawan_noktp, $karyawan_alamatktp, $karyawan_agama, $karyawan_bank, $karyawan_bankcabang, $karyawan_norekening, $karyawan_atasnama, $karyawan_jamsostek, $karyawan_sip, $karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_marriage, $karyawan_jmlanak, $karyawan_tgllahir, $karyawan_tglmasuk, $karyawan_tmplahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang, $karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised, $karyawan_cab_th ,$karyawan_cab_ki ,$karyawan_cab_hr ,$karyawan_cab_tp ,$karyawan_cab_dps ,$karyawan_cab_jkt ,$karyawan_cab_mta ,$karyawan_cab_blpn ,$karyawan_cab_kuta ,$karyawan_cab_btm ,$karyawan_cab_mks ,$karyawan_cab_mdn ,$karyawan_cab_lbk ,$karyawan_cab_mnd ,$karyawan_cab_ygk, $karyawan_cab_mlg ,$karyawan_cab_corp ,$karyawan_cab_maa,$karyawan_cab_mg,$cabang_date_create){
		if($karyawan_cab_th=='true')
			$th="1";
		if($karyawan_cab_th=='false')
			$th="0";	
			
		if($karyawan_cab_ki=='true')
			$ki="1";
		if($karyawan_cab_ki=='false')
			$ki="0";			

		if($karyawan_cab_hr=='true')
			$hr="1";
		if($karyawan_cab_hr=='false')
			$hr="0";	
			
		if($karyawan_cab_tp=='true')
			$tp="1";
		if($karyawan_cab_tp=='false')
			$tp="0";	
			
		if($karyawan_cab_dps=='true')
			$dps="1";
		if($karyawan_cab_dps=='false')
			$dps="0";	
			
		if($karyawan_cab_jkt=='true')
			$jkt="1";
		if($karyawan_cab_jkt=='false')
			$jkt="0";	
		
		if($karyawan_cab_mta=='true')
			$mta="1";
		if($karyawan_cab_mta=='false')
			$mta="0";	
			
		if($karyawan_cab_blpn=='true')
			$blpn="1";
		if($karyawan_cab_blpn=='false')
			$blpn="0";	
			
		if($karyawan_cab_kuta=='true')
			$kuta="1";
		if($karyawan_cab_kuta=='false')
			$kuta="0";	
			
		if($karyawan_cab_btm=='true')
			$btm="1";
		if($karyawan_cab_btm=='false')
			$btm="0";	
			
		if($karyawan_cab_mks=='true')
			$mks="1";
		if($karyawan_cab_mks=='false')
			$mks="0";	
			
		if($karyawan_cab_mdn=='true')
			$mdn="1";
		if($karyawan_cab_mdn=='false')
			$mdn="0";	
			
		if($karyawan_cab_lbk=='true')
			$lbk="1";
		if($karyawan_cab_lbk=='false')
			$lbk="0";	
			
		if($karyawan_cab_mnd=='true')
			$mnd="1";
		if($karyawan_cab_mnd=='false')
			$mnd="0";	
			
		if($karyawan_cab_ygk=='true')
			$ygk="1";
		if($karyawan_cab_ygk=='false')
			$ygk="0";	

		if($karyawan_cab_mlg=='true')
			$mlg="1";
		if($karyawan_cab_mlg=='false')
			$mlg="0";	
			
		if($karyawan_cab_corp=='true')
			$corp="1";
		if($karyawan_cab_corp=='false')
			$corp="0";	
			
		if($karyawan_cab_maa=='true')
			$maa="1";
		if($karyawan_cab_maa=='false')
			$maa="0";	
			
		if($karyawan_cab_mg=='true')
			$mg="1";
		if($karyawan_cab_mg=='false')
			$mg="0";			
		
		$temp_cabang=$th.$ki.$hr.$tp.$dps.$jkt.$mta.$blpn.$kuta.$btm.$mks.$mdn.$lbk.$mnd.$ygk.$mlg.$corp.$maa.$mg;	
		
		//autogenerate NIK
		$sql_cabang_kode = "SELECT c.cabang_kode FROM cabang c, karyawan k WHERE c.cabang_id = ".$karyawan_cabang;
		$a_cabang_kode = $this->db->query($sql_cabang_kode);
		if($a_cabang_kode->num_rows()>0){
			$record = $a_cabang_kode->row_array();
			$cabang_kode = $record['cabang_kode'];
		}		
		$karyawan_tglmasuk_pattern=strtotime($karyawan_tglmasuk);
		$pattern=$cabang_kode."/".date("ym",$karyawan_tglmasuk_pattern)."-";
		$panjang = strlen($cabang_kode);
		$pjg = 11;		
		if ($panjang==4)
			$pjg = 13;
		else if ($panjang==3)
			$pjg = 12;		
		$karyawan_no=$this->m_public_function->get_nik_karyawan('karyawan','karyawan_no',$pattern,$pjg);
		//end of autogenerate NIK
		
		if ($karyawan_aktif=="")
			$karyawan_aktif = "Aktif";
			$data = array(
	
				"karyawan_no"=>$karyawan_no,
				"karyawan_sip"=>$karyawan_sip,
				"karyawan_ktp"=>$karyawan_noktp,
				"karyawan_alamat_ktp"=>$karyawan_alamatktp,
				"karyawan_agama"=>$karyawan_agama,
				"karyawan_bank"=>$karyawan_bank,
				"karyawan_bank_cabang"=>$karyawan_bankcabang,
				"karyawan_rekening"=>$karyawan_norekening,
				"karyawan_atasnama"=>$karyawan_atasnama,
				"karyawan_jamsostek"=>$karyawan_jamsostek,
				"karyawan_npwp"=>$karyawan_npwp,	
				"karyawan_username"=>$karyawan_username,	
				"karyawan_nama"=>$karyawan_nama,	
				"karyawan_kelamin"=>$karyawan_kelamin,	
				//"karyawan_pph21"=>$karyawan_pph21,
				"karyawan_marriage"=>$karyawan_marriage,
				"karyawan_jmlanak"=>$karyawan_jmlanak,
				"karyawan_tgllahir"=>$karyawan_tgllahir,
				"karyawan_tmplahir"=>$karyawan_tmplahir,	
				"karyawan_alamat"=>$karyawan_alamat,	
				"karyawan_kota"=>$karyawan_kota,	
				"karyawan_kodepos"=>$karyawan_kodepos,	
				"karyawan_email"=>$karyawan_email,	
				"karyawan_emiracle"=>$karyawan_emiracle,	
				"karyawan_keterangan"=>$karyawan_keterangan,	
				"karyawan_notelp"=>$karyawan_notelp,	
				"karyawan_notelp2"=>$karyawan_notelp2,	
				"karyawan_notelp3"=>$karyawan_notelp3,	
				"karyawan_notelp4"=>$karyawan_notelp4,
				"karyawan_cabang"=>$karyawan_cabang,	
				//"karyawan_jabatan"=>$karyawan_jabatan,	
				//"karyawan_departemen"=>$karyawan_departemen,	
				//"karyawan_idgolongan"=>$karyawan_idgolongan,	
				"karyawan_tglmasuk"=>$karyawan_tglmasuk,
				//"karyawan_tgl_batas"=>$karyawan_tgl_batas,
				//"karyawan_atasan"=>$karyawan_atasan,	
				"karyawan_aktif"=>$karyawan_aktif,	
				"karyawan_creator"=>$_SESSION[SESSION_USERID],			
				"karyawan_date_create"=>date('Y-m-d H:i:s'),		
				"karyawan_update"=>$karyawan_update,	
				"karyawan_date_update"=>$karyawan_date_update,
				"karyawan_cabang2"=>$temp_cabang,				
				"karyawan_revised"=>'0'	
			);
			$this->db->insert('karyawan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function karyawan_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the karyawans at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM karyawan WHERE karyawan_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM karyawan WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "karyawan_id= ".$pkid[$i];
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
		function karyawan_search($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$start,$end){
			//full query
			if($karyawan_aktif=="")
				$karyawan_aktif="Aktif";
			$query="select karyawan.*, departemen.*, cabang.*, jabatan.jabatan_nama, golongan.*
				from karyawan
				left join departemen on (departemen.departemen_id=karyawan.karyawan_departemen)
				left join cabang on (cabang.cabang_id=karyawan.karyawan_cabang)
				left join jabatan on (jabatan.jabatan_id=karyawan.karyawan_jabatan)
				left join golongan on (golongan.id_golongan=karyawan.karyawan_idgolongan)
			";
			
			if($karyawan_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_id LIKE '%".$karyawan_id."%'";
			};
			if($karyawan_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_no LIKE '%".$karyawan_no."%'";
			};
			if($karyawan_npwp!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_npwp LIKE '%".$karyawan_npwp."%'";
			};
			if($karyawan_username!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_username LIKE '%".$karyawan_username."%'";
			};
			if($karyawan_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_nama LIKE '%".$karyawan_nama."%'";
			};
			if($karyawan_kelamin!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_kelamin LIKE '%".$karyawan_kelamin."%'";
			};
			if($karyawan_tgllahir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_tgllahir LIKE '%".$karyawan_tgllahir."%'";
			};
			if($karyawan_alamat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_alamat LIKE '%".$karyawan_alamat."%'";
			};
			if($karyawan_kota!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_kota LIKE '%".$karyawan_kota."%'";
			};
			if($karyawan_kodepos!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_kodepos LIKE '%".$karyawan_kodepos."%'";
			};
			if($karyawan_email!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_email LIKE '%".$karyawan_email."%'";
			};
			if($karyawan_emiracle!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_emiracle LIKE '%".$karyawan_emiracle."%'";
			};
			if($karyawan_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_keterangan LIKE '%".$karyawan_keterangan."%'";
			};
			if($karyawan_notelp!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp LIKE '%".$karyawan_notelp."%'";
			};
			if($karyawan_notelp2!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp2 LIKE '%".$karyawan_notelp2."%'";
			};
			if($karyawan_notelp3!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp3 LIKE '%".$karyawan_notelp3."%'";
			};
			if($karyawan_notelp4!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp4 LIKE '%".$karyawan_notelp4."%'";
			};
			if($karyawan_cabang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_cabang = '".$karyawan_cabang."'";
			};
			if($karyawan_jabatan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_jabatan = '".$karyawan_jabatan."'";
			};
			if($karyawan_departemen!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_departemen LIKE '%".$karyawan_departemen."%'";
			};
			if($karyawan_idgolongan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_idgolongan LIKE '%".$karyawan_idgolongan."%'";
			};
			if($karyawan_tglmasuk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_tglmasuk LIKE '%".$karyawan_tglmasuk."%'";
			};
			if($karyawan_atasan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_atasan LIKE '%".$karyawan_atasan."%'";
			};
			if($karyawan_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_aktif='".$karyawan_aktif."'";
			};
			if($karyawan_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_creator LIKE '%".$karyawan_creator."%'";
			};
			if($karyawan_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_date_create LIKE '%".$karyawan_date_create."%'";
			};
			if($karyawan_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_update LIKE '%".$karyawan_update."%'";
			};
			if($karyawan_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_date_update LIKE '%".$karyawan_date_update."%'";
			};
			if($karyawan_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_revised LIKE '%".$karyawan_revised."%'";
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
		function karyawan_print($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$option,$filter){
			//full query
			$query="select * from karyawan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan_id LIKE '%".addslashes($filter)."%' OR karyawan_no LIKE '%".addslashes($filter)."%' OR karyawan_npwp LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR karyawan_kelamin LIKE '%".addslashes($filter)."%' OR karyawan_tgllahir LIKE '%".addslashes($filter)."%' OR karyawan_alamat LIKE '%".addslashes($filter)."%' OR karyawan_kota LIKE '%".addslashes($filter)."%' OR karyawan_kodepos LIKE '%".addslashes($filter)."%' OR karyawan_email LIKE '%".addslashes($filter)."%' OR karyawan_emiracle LIKE '%".addslashes($filter)."%' OR karyawan_keterangan LIKE '%".addslashes($filter)."%' OR karyawan_notelp LIKE '%".addslashes($filter)."%' OR karyawan_notelp2 LIKE '%".addslashes($filter)."%' OR karyawan_notelp3 LIKE '%".addslashes($filter)."%' OR karyawan_notelp4 LIKE '%".addslashes($filter)."%' OR karyawan_cabang LIKE '%".addslashes($filter)."%' OR karyawan_jabatan LIKE '%".addslashes($filter)."%' OR karyawan_departemen LIKE '%".addslashes($filter)."%' OR karyawan_idgolongan LIKE '%".addslashes($filter)."%' OR karyawan_tglmasuk LIKE '%".addslashes($filter)."%' OR karyawan_atasan LIKE '%".addslashes($filter)."%' OR karyawan_aktif LIKE '%".addslashes($filter)."%' OR karyawan_creator LIKE '%".addslashes($filter)."%' OR karyawan_date_create LIKE '%".addslashes($filter)."%' OR karyawan_update LIKE '%".addslashes($filter)."%' OR karyawan_date_update LIKE '%".addslashes($filter)."%' OR karyawan_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($karyawan_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_id LIKE '%".$karyawan_id."%'";
				};
				if($karyawan_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_no LIKE '%".$karyawan_no."%'";
				};
				if($karyawan_npwp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_npwp LIKE '%".$karyawan_npwp."%'";
				};
				if($karyawan_username!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_username LIKE '%".$karyawan_username."%'";
				};
				if($karyawan_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_nama LIKE '%".$karyawan_nama."%'";
				};
				if($karyawan_kelamin!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kelamin LIKE '%".$karyawan_kelamin."%'";
				};
				if($karyawan_tgllahir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tgllahir LIKE '%".$karyawan_tgllahir."%'";
				};
				if($karyawan_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_alamat LIKE '%".$karyawan_alamat."%'";
				};
				if($karyawan_kota!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kota LIKE '%".$karyawan_kota."%'";
				};
				if($karyawan_kodepos!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kodepos LIKE '%".$karyawan_kodepos."%'";
				};
				if($karyawan_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_email LIKE '%".$karyawan_email."%'";
				};
				if($karyawan_emiracle!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_emiracle LIKE '%".$karyawan_emiracle."%'";
				};
				if($karyawan_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_keterangan LIKE '%".$karyawan_keterangan."%'";
				};
				if($karyawan_notelp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp LIKE '%".$karyawan_notelp."%'";
				};
				if($karyawan_notelp2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp2 LIKE '%".$karyawan_notelp2."%'";
				};
				if($karyawan_notelp3!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp3 LIKE '%".$karyawan_notelp3."%'";
				};
				if($karyawan_notelp4!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp4 LIKE '%".$karyawan_notelp4."%'";
				};
				if($karyawan_cabang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_cabang LIKE '%".$karyawan_cabang."%'";
				};
				if($karyawan_jabatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_jabatan LIKE '%".$karyawan_jabatan."%'";
				};
				if($karyawan_departemen!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_departemen LIKE '%".$karyawan_departemen."%'";
				};
				if($karyawan_idgolongan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_idgolongan LIKE '%".$karyawan_idgolongan."%'";
				};
				if($karyawan_tglmasuk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tglmasuk LIKE '%".$karyawan_tglmasuk."%'";
				};
				if($karyawan_atasan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_atasan LIKE '%".$karyawan_atasan."%'";
				};
				if($karyawan_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_aktif LIKE '%".$karyawan_aktif."%'";
				};
				if($karyawan_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_creator LIKE '%".$karyawan_creator."%'";
				};
				if($karyawan_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_create LIKE '%".$karyawan_date_create."%'";
				};
				if($karyawan_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_update LIKE '%".$karyawan_update."%'";
				};
				if($karyawan_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_update LIKE '%".$karyawan_date_update."%'";
				};
				if($karyawan_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_revised LIKE '%".$karyawan_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function karyawan_export_excel($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$option,$filter){
			//full query if(produk_kodelama='','-',ifnull(produk_kodelama,'-'))
			$query="select if(karyawan_no='','-',ifnull(karyawan_no,'-')) AS NIK,
							if(karyawan_username='','-',ifnull(karyawan_username,'-')) AS Nickname,
							if(karyawan_nama='','-',ifnull(karyawan_nama,'-')) AS nama_lengkap,
							if(karyawan_kelamin='','-',ifnull(karyawan_kelamin,'-')) AS 'L/P',
							if(karyawan_marriage='','-',ifnull(karyawan_marriage,'-')) as menikah,
							if(karyawan_tgllahir='','-',ifnull(karyawan_tgllahir,'-')) AS tgl_lahir,
							if(karyawan_tmplahir='','-',ifnull(karyawan_tmplahir,'-')) AS tempat_lahir,
							if(karyawan_alamat='','-',ifnull(karyawan_alamat,'-')) AS alamat,
							if(karyawan_kota='','-',ifnull(karyawan_kota,'-')) AS kota,
							if(karyawan_notelp='','-',ifnull(karyawan_notelp,'-')) AS no_telp_rmh,
							if(karyawan_notelp2='','-',ifnull(karyawan_notelp2,'-')) AS ponsel_1,
							if(karyawan_departemen='','-',ifnull(karyawan_departemen,'-')) AS departemen,
							if(karyawan_aktif='','-',ifnull(karyawan_aktif,'-')) AS aktif
					from karyawan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan_id LIKE '%".addslashes($filter)."%' OR karyawan_no LIKE '%".addslashes($filter)."%' OR karyawan_npwp LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR karyawan_kelamin LIKE '%".addslashes($filter)."%' OR karyawan_tgllahir LIKE '%".addslashes($filter)."%' OR karyawan_alamat LIKE '%".addslashes($filter)."%' OR karyawan_kota LIKE '%".addslashes($filter)."%' OR karyawan_kodepos LIKE '%".addslashes($filter)."%' OR karyawan_email LIKE '%".addslashes($filter)."%' OR karyawan_emiracle LIKE '%".addslashes($filter)."%' OR karyawan_keterangan LIKE '%".addslashes($filter)."%' OR karyawan_notelp LIKE '%".addslashes($filter)."%' OR karyawan_notelp2 LIKE '%".addslashes($filter)."%' OR karyawan_notelp3 LIKE '%".addslashes($filter)."%' OR karyawan_notelp4 LIKE '%".addslashes($filter)."%' OR karyawan_cabang LIKE '%".addslashes($filter)."%' OR karyawan_jabatan LIKE '%".addslashes($filter)."%' OR karyawan_departemen LIKE '%".addslashes($filter)."%' OR karyawan_idgolongan LIKE '%".addslashes($filter)."%' OR karyawan_tglmasuk LIKE '%".addslashes($filter)."%' OR karyawan_atasan LIKE '%".addslashes($filter)."%' OR karyawan_aktif LIKE '%".addslashes($filter)."%' OR karyawan_creator LIKE '%".addslashes($filter)."%' OR karyawan_date_create LIKE '%".addslashes($filter)."%' OR karyawan_update LIKE '%".addslashes($filter)."%' OR karyawan_date_update LIKE '%".addslashes($filter)."%' OR karyawan_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($karyawan_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_id LIKE '%".$karyawan_id."%'";
				};
				if($karyawan_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_no LIKE '%".$karyawan_no."%'";
				};
				if($karyawan_npwp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_npwp LIKE '%".$karyawan_npwp."%'";
				};
				if($karyawan_username!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_username LIKE '%".$karyawan_username."%'";
				};
				if($karyawan_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_nama LIKE '%".$karyawan_nama."%'";
				};
				if($karyawan_kelamin!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kelamin LIKE '%".$karyawan_kelamin."%'";
				};
				if($karyawan_tgllahir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tgllahir LIKE '%".$karyawan_tgllahir."%'";
				};
				if($karyawan_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_alamat LIKE '%".$karyawan_alamat."%'";
				};
				if($karyawan_kota!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kota LIKE '%".$karyawan_kota."%'";
				};
				if($karyawan_kodepos!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kodepos LIKE '%".$karyawan_kodepos."%'";
				};
				if($karyawan_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_email LIKE '%".$karyawan_email."%'";
				};
				if($karyawan_emiracle!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_emiracle LIKE '%".$karyawan_emiracle."%'";
				};
				if($karyawan_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_keterangan LIKE '%".$karyawan_keterangan."%'";
				};
				if($karyawan_notelp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp LIKE '%".$karyawan_notelp."%'";
				};
				if($karyawan_notelp2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp2 LIKE '%".$karyawan_notelp2."%'";
				};
				if($karyawan_notelp3!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp3 LIKE '%".$karyawan_notelp3."%'";
				};
				if($karyawan_notelp4!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp4 LIKE '%".$karyawan_notelp4."%'";
				};
				if($karyawan_cabang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_cabang LIKE '%".$karyawan_cabang."%'";
				};
				if($karyawan_jabatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_jabatan LIKE '%".$karyawan_jabatan."%'";
				};
				if($karyawan_departemen!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_departemen LIKE '%".$karyawan_departemen."%'";
				};
				if($karyawan_idgolongan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_idgolongan LIKE '%".$karyawan_idgolongan."%'";
				};
				if($karyawan_tglmasuk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tglmasuk LIKE '%".$karyawan_tglmasuk."%'";
				};
				if($karyawan_atasan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_atasan LIKE '%".$karyawan_atasan."%'";
				};
				if($karyawan_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_aktif LIKE '%".$karyawan_aktif."%'";
				};
				if($karyawan_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_creator LIKE '%".$karyawan_creator."%'";
				};
				if($karyawan_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_create LIKE '%".$karyawan_date_create."%'";
				};
				if($karyawan_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_update LIKE '%".$karyawan_update."%'";
				};
				if($karyawan_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_update LIKE '%".$karyawan_date_update."%'";
				};
				if($karyawan_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_revised LIKE '%".$karyawan_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>