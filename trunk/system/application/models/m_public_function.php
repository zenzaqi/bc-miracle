<?

class M_public_function extends Model{
	
	function M_public_function(){
		parent::Model();
	}
	
	function get_bank_list(){
		$sql="SELECT * FROM bank_master WHERE mbank_aktif='Aktif'";
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
	
	function get_petugas_list($query, $tgl_app="", $karyawan_jabatan){
		//$sql="SELECT karyawan_id,karyawan_no,karyawan_nama FROM karyawan WHERE karyawan_departemen='$departemen_id' AND karyawan_aktif='Aktif'";
/*		if($rawat_kategori==2)
			$departemen_id=8;
		elseif($rawat_kategori==3)
			$departemen_id=9;
		else
			$departemen_id=0;*/
		//$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,reportt_jmltindakan FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) INNER JOIN absensi ON(karyawan_no=absensi_nik) LEFT JOIN report_tindakan ON(karyawan_no=reportt_nik) WHERE karyawan_jabatan=jabatan_id AND karyawan_no=absensi_nik AND absensi_shift!='OFF' AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
		$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
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
	
	function get_jenis_perawatan_list(){
		$sql="SELECT jenis_id,jenis_nama FROM jenis WHERE jenis_kelompok='perawatan' AND jenis_aktif='Aktif'";
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
	
	function get_jenis_produk_list(){
		$sql="SELECT jenis_id,jenis_nama FROM jenis WHERE jenis_kelompok='produk' AND jenis_aktif='Aktif'";
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
	
	function get_usergroups_list(){
		$sql="SELECT group_id,group_name FROM usergroups WHERE group_active='Aktif'";
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
	
	function get_mbank_list(){
		$sql="SELECT mbank_id,mbank_nama FROM bank_master WHERE mbank_aktif='Aktif'";
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
	
	function get_propinsi_list(){
		$sql="SELECT propinsi_nama FROM propinsi";
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
	
	function get_info(){
		$sql="select * from info";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_akun_list($start,$end){
		$sql="SELECT akun_id,akun_nama,akun_kode FROM akun where akun_aktif='Aktif'";
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
	
	function get_voucher_list($query,$start,$end){
			$query = "SELECT * FROM voucher,voucher_kupon where kvoucher_master=voucher_id";
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
		
	function get_kwitansi_by_ref($ref_id){
		$sql="SELECT jkwitansi_id,jkwitansi_nama,jkwitansi_no,jkwitansi_nilai FROM jual_kwitansi where jkwitansi_ref='".$ref_id."'";
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
	
	function get_card_by_ref($ref_id){
		$sql="SELECT jcard_id,jcard_no,jcard_nama,jcard_edc,jcard_nilai FROM jual_card where jcard_ref='".$ref_id."'";
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
	
	function get_cek_by_ref($ref_id){
		$sql="SELECT jcek_id,jcek_nama,jcek_no,jcek_valid,jcek_bank,jcek_nilai FROM jual_cek where jcek_ref='".$ref_id."'";
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
	
	function get_transfer_by_ref($ref_id){
		$sql="SELECT jtransfer_id,jtransfer_bank,jtransfer_nama,jtransfer_nilai FROM jual_transfer where jtransfer_ref='".$ref_id."'";
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
	
	function get_tunai_by_ref($ref_id){
		$sql="SELECT jtunai_id,jtunai_nilai FROM jual_tunai WHERE jtunai_ref='".$ref_id."'";
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
	
	function get_transfer_paket_by_ref($ref_id){
		$sql="SELECT jtransfer_id,jtransfer_bank,jtransfer_nilai FROM jual_transfer where jtransfer_ref='".$ref_id."'";
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
	
		
	function get_harga_produk($produk_id) {
		
		$query = "SELECT produk_harga from produk where produk_id='".$produk_id."'";
		$result = $this->db->query($query);
		if($result->num_rows()){
			$data=$result->row();
			$produk_harga=$data->produk_harga;
			return $produk_harga;
		}else{
			return '0';
		}
	}
	
	function get_harga_rawat($rawat_id) {
		
		$query = "SELECT rawat_harga FROM perawatan WHERE rawat_id='".$rawat_id."'";
		$result = $this->db->query($query);
		if($result->num_rows()){
			$data=$result->row();
			$rawat_harga=$data->rawat_harga;
			return $rawat_harga;
		}else{
			return '0';
		}
	}
		
	function get_member_by_cust($member_cust){
		$sql = "SELECT * from member where member_cust='".$member_cust."' and member_status!='tidak aktif' order by member_id desc limit 1";
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
	
	function get_customer_list($query,$start,$end){
		$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah
		FROM customer where cust_aktif='Aktif'";
		if($query<>""){
			$sql=$sql." and (cust_no like '%".$query."%' or cust_nama like '%".$query."%' 
			or cust_telprumah like '%".$query."%' or cust_telprumah2 like '%".$query."%' or cust_telpkantor like '%".$query."%' 
			or cust_hp like '%".$query."%' or cust_hp2 like '%".$query."%' or cust_hp3 like '%".$query."%') ";
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
	
	function get_kwitansi_list($query,$start=0,$end=10,$kwitansi_cust){
		$sql="SELECT kwitansi_id,kwitansi_no,kwitansi_nilai,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah  
			FROM cetak_kwitansi,customer WHERE kwitansi_cust=cust_id AND cust_aktif='Aktif'";
		if($query<>""){
			$sql=$sql." and (cust_no like '%".$query."%' or cust_nama like '%".$query."%' or cust_alamat like '%".$query."%' or
					cust_telprumah like '%".$query."%' or cust_tgllahir like '%".$query."%') ";
		}
		if($kwitansi_cust<>""){
			$sql=$sql." AND kwitansi_cust='$kwitansi_cust'";
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
	
	function get_supplier_list($start,$end){
		$sql="SELECT supplier_id,supplier_nama,supplier_alamat,supplier_kota,supplier_notelp FROM supplier where supplier_aktif='Aktif'";
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
	
	
	function get_cabang_list(){
		$sql="SELECT cabang_id,cabang_nama FROM cabang where cabang_aktif='Aktif'";
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
	
	function get_kode_1($table,$field,$pattern,$length){
		$len_pattern=strlen($pattern);
		$len_lpad=$length-$len_pattern;
		$sql="select concat(left(max(".$field."),".$len_pattern."),LPAD((right(max(".$field."),".$len_lpad.")+1),".$len_lpad.",0)) as max_key from ".$table." where ".$field." like '".$pattern."%'";
		$query=$this->db->query($sql);
		if($query->num_rows()){
			$data=$query->row();
			$kode=$data->max_key;
			if(is_null($kode))
			{
				$pad="";
				for($i=1;$i<$len_lpad;$i++)
					$pad.="0";
				$kode=$pattern.$pad."1";
			}
			return $kode;
		}else{
			$pad="";
			for($i=1;$i<$len_lpad;$i++)
				$pad.="0";
			$kode=$pattern.$pad."1";
			return $kode;
		}
	}
	
	function get_kode_2($table,$field,$pattern_g,$pattern_j,$length){
		$len_pattern=strlen($pattern_g.$pattern_j);
		$len_lpad=$length-$len_pattern;
		$sql="select concat(left(max(".$field."),".$len_pattern."),LPAD((right(max(".$field."),".$len_lpad.")+1),".$len_lpad.",0)) as max_key from ".$table." where ".$field." like '".$pattern_g.$pattern_j."%'";
		$query=$this->db->query($sql);
		if($query->num_rows()){
			$data=$query->row();
			$kode=$data->max_key;
			if(is_null($kode))
			{
				$pad="";
				for($i=1;$i<$len_lpad;$i++)
					$pad.="0";
				$kode=$pattern_g.$pattern_j.$pad."1";
			}
			return $kode;
		}else{
			$pad="";
			for($i=1;$i<$len_lpad;$i++)
				$pad.="0";
			$kode=$pattern_g.$pattern_j.$pad."1";
			return $kode;
		}
	}
	
	function get_satuan_list(){
		$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM satuan where satuan_aktif='Aktif'";
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
	
	function get_satuan_bydjproduk_list($djproduk_id){
		$sql="SELECT * FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id AND produk_id='$djproduk_id'";
		if($djproduk_id==0)
			$sql="SELECT * FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id";
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
	
	function get_kategori_produk_list(){
		$sql="SELECT kategori_id,kategori_nama FROM kategori where kategori_jenis='produk' and kategori_aktif='Aktif'";
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
	
	function get_kategori_paket_list(){
		$sql="SELECT kategori_id,kategori_nama FROM kategori where kategori_jenis='paket' and kategori_aktif='Aktif'";
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
	
	function get_kategori_perawatan_list(){
		$sql="SELECT kategori_id,kategori_nama FROM kategori WHERE kategori_jenis='perawatan' and kategori_aktif='Aktif'";
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
	
	function get_kategori_list(){
		$sql="SELECT kategori_id,kategori_nama,kategori_jenis FROM kategori where kategori_aktif='Aktif'";
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
	
	function get_rawat_list($query,$start,$end){
	/*$sql="SELECT produk_id,produk_kode,produk_nama,produk_kategori,produk_harga,produk_group,produk_du,produk_dm
				,kategori_nama, group_nama, satuan_kode, satuan_nama 
				FROM produk,satuan,kategori,produk_group where satuan_id=produk_satuan and kategori_id=produk_kategori
				and produk_group=group_id and produk_aktif='Aktif'";*/
		$sql_drawat="SELECT drawat_rawat FROM detail_jual_rawat";
		$rs=$this->db->query($sql_drawat);
		$rs_rows=$rs->num_rows();
		
		$sql="SELECT * FROM vu_perawatan";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"")
			$sql.=" WHERE (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or kategori_nama like '%".$query."%') ";
		else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("WHERE",$query)? " OR ":" WHERE ";
				foreach($rs->result() as $row_drawat){
					
					$filter.="OR drawat_rawat='".$row_drawat->drawat_rawat."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		}
		
		/*if($query<>"")
			$sql.=" WHERE (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%'
						 or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";*/
		
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
	
	/*function get_perawatan_list($query="",$start=0,$end=10){
		//$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm
		//		,kategori_nama, group_nama 
		//		FROM perawatan,kategori,produk_group where kategori_id=rawat_kategori
		//		and rawat_group=group_id and rawat_aktif='Aktif'";
				
		$sql="SELECT * FROM vu_perawatan";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>""){
			$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
			$sql.=" rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%'";
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
	}*/
	
	//Ambil Perawatan berdasarkan kategori MEDIS
	function get_rawat_medis_list($query,$start,$end){
		/*$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm,kategori_nama, group_nama 
		FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id 
		AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Medis'";*/
		$sql="SELECT * FROM vu_perawatan WHERE kategori_nama='Medis'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"")
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or group_nama like '%".$query."%')";
	
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
	/*function get_rawat_medis_list($query,$start,$end){
		return $this->get_perawatan_medis_list($query,$start,$end);
	}
	
	function get_perawatan_medis_list($query,$start,$end){
		$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm
				,kategori_nama, group_nama 
				FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id
				and rawat_group=group_id and rawat_aktif='Tidak Aktif' AND kategori_nama='Medis'";
		if($query<>"")
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%')";
	
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
	}*/
	//END Ambil Perawatan berdasarkan kategori MEDIS
	
	
	function get_rawat_nonmedis_list($query,$start,$end){
		/*$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm,kategori_nama, group_nama 
		FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id 
		AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Non Medis'";*/
		$sql="SELECT * FROM vu_perawatan WHERE kategori_nama='Non Medis'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"")
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or group_nama like '%".$query."%')";
	
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
	//Ambil Perawatan berdasarkan kategori NON-MEDIS
	/*function get_rawat_nonmedis_list($query="",$start=0,$end=10){
		return $this->get_perawatan_nonmedis_list($query="",$start=0,$end=10);
	}
	
	function get_perawatan_nonmedis_list($query="",$start=0,$end=10){
		$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm
				,kategori_nama, group_nama 
				FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id
				AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Non Medis'";
		if($query<>"")
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or satuan_nama like '%".$query."%'
						 or kategori_nama like '%".$query."%' or group_nama like '%".$query."%')";
	
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
	}*/
	//END Ambil Perawatan berdasarkan kategori NON-MEDIS
	
	function get_karyawan_list($query="",$start=0,$end=10){
		$sql="select karyawan_id,karyawan_no,karyawan_nama,jabatan_nama from karyawan,jabatan where jabatan_id=karyawan_jabatan and karyawan_aktif='Aktif'";
		if($query<>"")
			$sql.=" and (karyawan_id like '%".$query."%' or karyawan_no like '%".$query."%' or karyawan_nama like '%".$query."%'
						 or jabatan_nama like '%".$query."%')";
	
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
	
	function get_user_karyawan_list($query,$start,$end){
		$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,jabatan_nama FROM karyawan,jabatan,users WHERE jabatan_id=karyawan_jabatan AND user_karyawan!=karyawan_id AND karyawan_aktif='Aktif'";
		if($query<>"")
			$sql.=" and (karyawan_id like '%".$query."%' or karyawan_no like '%".$query."%' or karyawan_nama like '%".$query."%'
						 or jabatan_nama like '%".$query."%')";
	
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
	
	function get_paket_list(){
		$sql="SELECT * FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE paket_aktif='Aktif'";
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
	
	function get_produk_group_list(){
		$sql="SELECT produk_id,produk_nama, produk_kategori,produk_group FROM produk where produk_aktif='Aktif'";
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
	
	function get_produk_rawat_list($query="",$start=0,$end=10){
			$query = "SELECT produk_kode as produk_rawat_kode, produk_nama as produk_rawat_nama, 'produk' as produk_rawat_jenis 
					FROM produk where produk_aktif='Aktif'
					UNION
					SELECT rawat_kode as produk_rawat_kode, rawat_nama as produk_rawat_nama, 'perawatan' as produk_rawat_jenis 
					FROM perawatan where rawat_aktif='Aktif'";
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
		
	function get_produk_list($query,$start,$end){
		/*$sql="SELECT produk_id,produk_kode,produk_nama,produk_kategori,produk_harga,produk_group,produk_du,produk_dm
				,kategori_nama, group_nama, satuan_kode, satuan_nama 
				FROM produk,satuan,kategori,produk_group where satuan_id=produk_satuan and kategori_id=produk_kategori
				and produk_group=group_id and produk_aktif='Aktif'";*/
		$sql_dproduk="SELECT dproduk_produk FROM detail_jual_produk";
		$rs=$this->db->query($sql_dproduk);
		$rs_rows=$rs->num_rows();
		
		$sql="select * from vu_produk";
		if($query<>"")
			$sql.=" WHERE (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%'
						 or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
		else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("WHERE",$query)? " OR ":" WHERE ";
				foreach($rs->result() as $row_dproduk){
					
					$filter.="OR dproduk_produk='".$row_dproduk->dproduk_produk."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		}
		
		/*if($query<>"")
			$sql.=" WHERE (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%'
						 or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";*/
		
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
	
	function get_trans_list($query="",$start=0,$end=10){
		/*$sql="SELECT produk_id,produk_kode,produk_nama,produk_kategori,produk_harga,produk_group,produk_du,produk_dm
				,kategori_nama, group_nama, satuan_kode, satuan_nama 
				FROM produk,satuan,kategori,produk_group where satuan_id=produk_satuan and kategori_id=produk_kategori
				and produk_group=group_id and produk_aktif='Aktif'";*/
		$sql="select * from vu_trans_union";
		if($query<>"")
			$sql.=" and (no_bukti like '%".$query."%' or cust_nama like '%".$query."%' or cust_no like '%".$query."%'
						 or cust_member like '%".$query."%') ";
						 
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
	
	function get_group_list(){
		$sql="SELECT group_id,group_nama,group_duproduk,group_dmproduk,group_durawat,group_dmrawat,group_dupaket,group_dmpaket FROM produk_group where group_aktif='Aktif'";
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
	
	function get_group_produk_list(){
		$sql="SELECT group_id,group_nama,group_duproduk,group_dmproduk,group_durawat,group_dmrawat,group_dupaket,group_dmpaket, kategori_nama,kategori_id FROM produk_group,kategori WHERE group_kelompok=kategori_id AND kategori_jenis='produk' AND group_aktif='Aktif' AND kategori_aktif='Aktif'";
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
	
	function get_group_perawatan_list(){
		$sql="SELECT group_id,group_nama,group_duproduk,group_dmproduk,group_durawat,group_dmrawat,group_dupaket,group_dmpaket, kategori_nama,kategori_id FROM produk_group,kategori WHERE group_kelompok=kategori_id AND kategori_jenis='perawatan' AND group_aktif='Aktif' AND kategori_aktif='Aktif'";
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
	
	function get_group_paket_list(){
		$sql="SELECT group_id,group_nama,group_duproduk,group_dmproduk,group_durawat,group_dmrawat,group_dupaket,group_dmpaket, kategori_nama,kategori_id 
		FROM produk_group,kategori WHERE group_kelompok=kategori_id AND kategori_jenis='paket' AND group_aktif='Aktif' AND kategori_aktif='Aktif'";
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
	
	function get_group_by_id($group_id){
		$query = "SELECT * FROM produk_group WHERE group_id='".$group_id."' and group_aktif='Aktif'";
		
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
	
	function get_gudang_list(){
		$sql="SELECT gudang_id,gudang_nama FROM gudang WHERE gudang_aktif='Aktif'";
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
	
	function get_alat_list(){
		$sql="SELECT alat_id,alat_nama,alat_jumlah FROM alat WHERE alat_aktif='Aktif'";
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
	
}

?>