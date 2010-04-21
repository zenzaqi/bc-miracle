<?

class M_public_function extends Model{
	
	function M_public_function(){
		parent::Model();
	}
	
	
	function get_laporan_terima_kas($tgl_awal,$tgl_akhir,$periode,$opsi){
			$sql="";
			if($periode=='all')
				$sql="SELECT jenis_transaksi,sum(nilai_card) as nilai_card,sum(nilai_cek) as nilai_cek, sum(nilai_kredit) as nilai_kredit, sum(nilai_kwitansi) as nilai_kwitansi, sum(nilai_transfer) as nilai_transfer,sum(nilai_tunai) as nilai_tunai,sum(nilai_voucher) as nilai_voucher FROM vu_trans_terima_jual GROUP BY jenis_transaksi ORDER BY jenis_transaksi";
			else if($periode=='bulan')
				$sql="SELECT jenis_transaksi,sum(nilai_card) as nilai_card,sum(nilai_cek) as nilai_cek, sum(nilai_kredit) as nilai_kredit, sum(nilai_kwitansi) as nilai_kwitansi, sum(nilai_transfer) as nilai_transfer,sum(nilai_tunai) as nilai_tunai,sum(nilai_voucher) as nilai_voucher FROM vu_trans_terima_jual WHERE tanggal like '".$tgl_awal."%' GROUP BY  jenis_transaksi ORDER BY jenis_transaksi";
			else if($periode=='tanggal')
				$sql="SELECT jenis_transaksi,sum(nilai_card) as nilai_card,sum(nilai_cek) as nilai_cek, sum(nilai_kredit) as nilai_kredit, sum(nilai_kwitansi) as nilai_kwitansi, sum(nilai_transfer) as nilai_transfer,sum(nilai_tunai) as nilai_tunai,sum(nilai_voucher) as nilai_voucher FROM vu_trans_terima_jual WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' GROUP BY  jenis_transaksi ORDER BY jenis_transaksi";

			//echo $sql;
			$query = $this->db->query($sql);
			return $query->result();
	}
		
	function get_order_beli_detail_by_order_id($orderid){
		$sql="SELECT * FROM vu_detail_order_beli WHERE dorder_master='".$orderid."'";
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
		$bln_now=date('Y-m');
		$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,karyawan_username,reportt_jmltindakan FROM karyawan INNER JOIN jabatan ON(karyawan_jabatan=jabatan_id) LEFT JOIN (SELECT * FROM report_tindakan WHERE reportt_bln LIKE '$bln_now%') as rt ON(karyawan_id=rt.reportt_karyawan_id) WHERE karyawan_jabatan=jabatan_id AND jabatan_nama='$karyawan_jabatan' AND karyawan_aktif='Aktif'";
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
		$sql="SELECT jkwitansi_id,kwitansi_no,jkwitansi_nilai,cust_nama FROM jual_kwitansi LEFT JOIN cetak_kwitansi ON(jkwitansi_master=kwitansi_id) LEFT JOIN customer ON(kwitansi_cust=cust_id) WHERE jkwitansi_ref='".$ref_id."'";
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
	
	function get_voucher_by_ref($ref_id){
		//$sql="SELECT tvoucher_id,tvoucher_novoucher,voucher_cashback FROM voucher_terima INNER JOIN voucher_kupon ON(tvoucher_novoucher=kvoucher_nomor) INNER JOIN voucher ON(kvoucher_master=voucher_id) WHERE tvoucher_ref='".$ref_id."'";
		$sql="SELECT tvoucher_id,tvoucher_novoucher,tvoucher_nilai FROM voucher_terima WHERE tvoucher_ref='".$ref_id."'";
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
	
	function get_kwitansi_list($query,$start=0,$end=10,$kwitansi_cust){
		$sql="SELECT kwitansi_id,kwitansi_no,kwitansi_nilai,cust_no,cust_nama,cust_tgllahir,cust_alamat, IF((kwitansi_nilai-(IF(sum(jkwitansi_nilai),sum(jkwitansi_nilai),0)))=0,kwitansi_nilai,(kwitansi_nilai-(IF(sum(jkwitansi_nilai),sum(jkwitansi_nilai),0)))) AS total_sisa FROM cetak_kwitansi LEFT JOIN jual_kwitansi ON(jkwitansi_master=kwitansi_id) LEFT JOIN customer ON(kwitansi_cust=cust_id) WHERE kwitansi_status='Terbuka'";
		if($query<>""){
			$sql=$sql." and (cust_no like '%".$query."%' or cust_nama like '%".$query."%' or cust_alamat like '%".$query."%' or kwitansi_no like '%".$query."%')";
		}
		if($kwitansi_cust<>""){
			$sql=$sql." AND kwitansi_cust='$kwitansi_cust'";
		}
		$sql.=" GROUP BY kwitansi_id";
		
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
	
	function get_nomor_member($table,$field,$pattern,$length){
		$date=date('y');
		$len_pattern=strlen($pattern);
		$len_lpad=$length-$len_pattern;
		$sql="SELECT LPAD((RIGHT(MAX(SUBSTRING(".$field.",-4)),".$len_lpad.")+1),".$len_lpad.",0) AS max_key FROM ".$table." WHERE ".$field." LIKE '".$date."%'";
		$query=$this->db->query($sql);
		if($query->num_rows()){
			$data=$query->row();
			return $pattern.$data->max_key;
			/*$data=$query->row();
			$kode=$data->max_key;
			if(is_null($kode))
			{
				$pad="";
				for($i=1;$i<$len_lpad;$i++)
					$pad.="0";
				$kode=$pattern.$pad."1";
			}
			return $kode;*/
		}else{
			$pad="";
			for($i=1;$i<$len_lpad;$i++)
				$pad.="0";
			$kode=$pattern.$pad."1";
			return $kode;
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
		$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id AND produk_id='$djproduk_id'";
		if($djproduk_id==0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id";
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
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_drawat="SELECT distinct(drawat_rawat) FROM detail_jual_rawat WHERE drawat_master='$query'";
			$rs=$this->db->query($sql_drawat);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="SELECT rawat_id,rawat_harga,rawat_kode,group_nama,kategori_nama,rawat_du,rawat_dm,rawat_nama FROM perawatan LEFT JOIN produk_group ON(rawat_group=group_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
			$sql.=" (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or kategori_nama like '%".$query."%') ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$query)? " OR ":" AND ";
				foreach($rs->result() as $row_drawat){
					
					$filter.="OR rawat_id='".$row_drawat->drawat_rawat."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
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
	
	/*function get_cbo_rawat_list($query,$start,$end){
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_drawat="SELECT distinct(drawat_rawat) FROM detail_jual_rawat WHERE drawat_master='$query'";
			$rs=$this->db->query($sql_drawat);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="SELECT rawat_id,rawat_kode,rawat_nama FROM perawatan WHERE rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
			$sql.=" (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%') ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$query)? " OR ":" AND ";
				foreach($rs->result() as $row_drawat){
					
					$filter.="OR rawat_id='".$row_drawat->drawat_rawat."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
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
	}*/
	
	function get_perawatan_list($query="",$start=0,$end=10){
		//$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm
		//		,kategori_nama, group_nama 
		//		FROM perawatan,kategori,produk_group where kategori_id=rawat_kategori
		//		and rawat_group=group_id and rawat_aktif='Aktif'";
				
		$sql="SELECT * FROM vu_perawatan";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>""){
			$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
			$sql.=" (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%')";
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
	
	//Ambil Perawatan berdasarkan kategori MEDIS
	function get_rawat_medis_list($query,$start,$end){
		/*$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm,kategori_nama, group_nama 
		FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id 
		AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Medis'";*/
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dapp="SELECT distinct(dapp_perawatan) FROM appointment_detail WHERE dapp_master='$query'";
			$rs=$this->db->query($sql_dapp);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="SELECT * FROM vu_perawatan WHERE kategori_nama='Medis' AND rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"" && is_numeric($query)==false){
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%')";
			//$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%' or group_nama like '%".$query."%')";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$query)? " OR ":" AND ";
				foreach($rs->result() as $row_dapp){
					
					$filter.="OR rawat_id='".$row_dapp->dapp_perawatan."' ";
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
	
	function get_tindakan_medis_list($query,$start,$end){
		/*$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm,kategori_nama, group_nama 
		FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id 
		AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Medis'";*/
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dapp="SELECT distinct(dtrawat_perawatan) FROM tindakan_detail WHERE dtrawat_master='$query'";
			$rs=$this->db->query($sql_dapp);
			$rs_rows=$rs->num_rows();
		}
		
		//$sql="SELECT * FROM vu_perawatan WHERE kategori_nama='Medis' AND rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		$sql="SELECT rawat_id,rawat_harga,rawat_kode,group_nama,kategori_nama,rawat_du,rawat_dm,rawat_nama FROM perawatan LEFT JOIN produk_group ON(rawat_group=group_id) LEFT JOIN kategori ON(rawat_kategori=kategori_id) WHERE kategori_nama='Medis' AND rawat_aktif='Aktif'";
		if($query<>"" && is_numeric($query)==false){
			//$this->firephp->log("YESSS");
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
		//echo $sql;
	
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
	
	function get_tindakan_nonmedis_list($query,$start,$end){
		/*$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm,kategori_nama, group_nama 
		FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id 
		AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Medis'";*/
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dapp="SELECT distinct(dtrawat_perawatan) FROM tindakan_detail WHERE dtrawat_master='$query'";
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
	
	
	function get_rawat_nonmedis_list($query,$start,$end){
		/*$sql="SELECT rawat_id,rawat_kode,rawat_nama,rawat_kategori,rawat_harga,rawat_group,rawat_du,rawat_dm,kategori_nama, group_nama 
		FROM perawatan,kategori,produk_group where rawat_kategori=kategori_id 
		AND rawat_group=group_id AND rawat_aktif='Aktif' AND kategori_nama='Non Medis'";*/
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dapp="SELECT distinct(dapp_perawatan) FROM appointment_detail WHERE dapp_master='$query'";
			$rs=$this->db->query($sql_dapp);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="SELECT * FROM vu_perawatan WHERE kategori_nama='Non Medis' AND rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
		if($query<>"" && is_numeric($query)==false){
			$sql.=" and (rawat_kode like '%".$query."%' or rawat_nama like '%".$query."%')";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$query)? " OR ":" AND ";
				foreach($rs->result() as $row_dapp){
					
					$filter.="OR rawat_id='".$row_dapp->dapp_perawatan."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		}
		$sql.=" ORDER BY rawat_nama ASC";
	
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
		if($query!=="")
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
	
	function get_user_karyawan_nolist($query,$start,$end){
		$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,jabatan_nama FROM karyawan,jabatan 
				WHERE jabatan_id=karyawan_jabatan AND karyawan_aktif='Aktif'
				AND karyawan_id NOT IN(select user_karyawan from users)";
		if($query!=="")
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
		$sql="SELECT karyawan_id,karyawan_no,karyawan_nama,jabatan_nama FROM karyawan,jabatan 
				WHERE jabatan_id=karyawan_jabatan AND karyawan_aktif='Aktif'
				AND karyawan_id IN(select user_karyawan from users)";
		if($query!=="")
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
		$sql="SELECT * FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE kategori.kategori_jenis='paket' AND paket_aktif='Aktif'";
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
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT krawat_produk FROM perawatan_konsumsi WHERE krawat_master='$query'";
			$rs=$this->db->query($sql_dproduk);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="select * from vu_produk WHERE produk_aktif='Aktif'";
		if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$sql)? " OR ":" AND ";
				foreach($rs->result() as $row_dproduk){
					
					$filter.="OR produk_id='".$row_dproduk->krawat_produk."' ";
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