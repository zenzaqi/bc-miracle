<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_produk Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_jual_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
*/

class M_master_jual_produk extends Model{
		
		//constructor
		function M_master_jual_produk() {
			parent::Model();
		}
		
	
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal";break;
				case "Customer": $order_by=" ORDER BY cust_nama ASC";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti";break;
				case "Produk": $order_by=" ORDER BY produk_kode";break;
				case "Sales": $order_by=" ORDER BY sales";break;
				case "Jenis Diskon": $order_by=" ORDER BY diskon_jenis";break;
				default: $order_by=" ORDER BY no_bukti ASC";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT * FROM vu_trans_produk ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_jual_produk ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_jual_produk WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}
			//echo $sql;
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi){
			$sql="";
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_item;
			}else
				return "";
		}
		
		function get_total_diskon($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_diskon;
			}else
				return "";
		}
		
		function get_total_nilai($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_nilai;
			}else
				return "";
		}
		
		function get_total_cek($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_cek;
			}else
				return "";
		}
		
		function get_total_tunai($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_tunai;
			}else
				return "";
		}
		
		function get_total_transfer($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_transfer;
			}else
				return "";
		}
		
		function get_total_card($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_card;
			}else
				return "";
		}
		
		function get_total_kredit($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kredit;
			}else
				return "";
		}
		
		function get_total_kuintansi($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kuintansi;
			}else
				return "";
		}
		
		function get_reveral_list($query,$start,$end){
		$sql="SELECT karyawan_id,karyawan_no,karyawan_username,karyawan_nama,karyawan_tgllahir,karyawan_alamat
		FROM karyawan where karyawan_aktif='Aktif'";
		if($query<>""){
			$sql=$sql." and (karyawan_no like '%".$query."%' or karyawan_nama like '%".$query."%') ";
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
		
		
		
	function get_produk_list($query,$start,$end){
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT dproduk_produk FROM detail_jual_produk WHERE dproduk_master='$query'";
			$rs=$this->db->query($sql_dproduk);
			$rs_rows=$rs->num_rows();
		}
		
		$sql="select * from vu_produk WHERE produk_aktif='Aktif'";
		if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' ) ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$sql)? " OR ":" AND ";
				foreach($rs->result() as $row_dproduk){
					
					$filter.="OR produk_id='".$row_dproduk->dproduk_produk."' ";
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
	
	function get_satuan_bydjproduk_list($djproduk_id,$produk_id){
		if($djproduk_id<>0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM satuan LEFT JOIN satuan_konversi ON(konversi_satuan=satuan_id) LEFT JOIN produk ON(konversi_produk=produk_id) LEFT JOIN detail_jual_produk ON(dproduk_produk=produk_id) LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) WHERE jproduk_id='$djproduk_id'";
		
		if($produk_id<>0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM satuan LEFT JOIN satuan_konversi ON(konversi_satuan=satuan_id) LEFT JOIN produk ON(konversi_produk=produk_id) WHERE produk_id='$produk_id'";
			
		if($djproduk_id==0 && $produk_id==0)
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id";
		//$sql="SELECT satuan_id,satuan_nama,satuan_kode FROM satuan";
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
	
	function get_satuan_byproduk_list($jproduk_id, $produk_id){
		$rs_rows=0;
		
		if($produk_id!=0 && is_numeric($produk_id)==true){
			$sql="SELECT satuan_id, satuan_nama, konversi_nilai, satuan_kode, konversi_default, produk_harga FROM satuan_konversi LEFT JOIN produk ON(konversi_produk=produk_id) LEFT JOIN satuan ON(konversi_satuan=satuan_id) WHERE konversi_produk='$produk_id'";
			$rs=$this->db->query($sql);
			$rs_rows=$rs->num_rows();
			if($produk_id<>"" && is_numeric($produk_id)==false){
				$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql.=" (satuan_nama like '%".$produk_id."%' or satuan_kode like '%".$produk_id."%') ";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			/*if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}*/
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}elseif($jproduk_id!=0 && is_numeric($jproduk_id)==true){
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id AND produk_id='$jproduk_id'";
			if($jproduk_id==0)
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
		
	}
		
		function get_konversi_list($dproduk_produk_id){
			$query = "SELECT * FROM satuan_konversi WHERE konversi_produk='$dproduk_produk_id'";
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
		
		//function for detail
		//get record list
		function detail_detail_jual_produk_list($master_id,$query,$start,$end) {
			//$query="SELECT *,konversi_nilai FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dproduk_produk=konversi_produk AND dproduk_satuan=konversi_satuan) WHERE dproduk_master='".$master_id."'";
			
			$query = "SELECT detail_jual_produk.*,master_jual_produk.jproduk_bayar,master_jual_produk.jproduk_diskon,dproduk_harga*dproduk_jumlah as dproduk_subtotal,dproduk_harga*dproduk_jumlah*((100-dproduk_diskon)/100) as dproduk_subtotal_net, produk_point, produk_harga AS produk_harga_default FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dproduk_produk=konversi_produk AND dproduk_satuan=konversi_satuan) LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) LEFT JOIN produk ON(dproduk_produk=produk_id) WHERE dproduk_master='".$master_id."'";
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
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(jproduk_id) AS master_id FROM master_jual_produk WHERE jproduk_creator='".$_SESSION[SESSION_USERID]."'";
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
		
		function get_rupiah_per_point(){
			$query = "SELECT setmember_rp_perpoint FROM member_setup LIMIT 1";
			$result = $this->db->query($query);
			if($result->num_rows()){
				$data=$result->row();
				$setmember_rp_perpoint=$data->setmember_rp_perpoint;
				return $setmember_rp_perpoint;
			}else{
				return 0;
			}
		}
		
		function catatan_piutang_update($jproduk_id){
			if($jproduk_id=="" || $jproduk_id==NULL || $jproduk_id==0){
				$jproduk_id=$this->get_master_id();
			}
			
			$sql="SELECT * FROM vu_piutang_jproduk WHERE jproduk_id='$jproduk_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$lpiutang_faktur=$rs_record["jproduk_nobukti"];
				$lpiutang_cust=$rs_record["jproduk_cust"];
				$lpiutang_faktur_tanggal=$rs_record["jproduk_tanggal"];
				$lpiutang_total=$rs_record["piutang_total"];
				/* ini artinya: No.Faktur Penjualan Produk ini masih BELUM LUNAS */
				/* untuk itu, No.Faktur ini akan dimasukkan ke db.master_lunas_piutang sebagai daftar yang harus ditagihkan ke Customer */
				
				/* Checking terlebih dahulu ke db.master_lunas_piutang WHERE =$lpiutang_faktur:
				* JIKA 'ada' ==> Lakukan UPDATE db.master_lunas_piutang
				* JIKA 'tidak ada' ==> Lakukan INSERT db.master_lunas_piutang
				*/
				$sql="SELECT * FROM master_lunas_piutang WHERE lpiutang_faktur='$lpiutang_faktur'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					/* UPDATE db.master_lunas_piutang */
					$dtu_lpiutang=array(
					"lpiutang_cust"=>$lpiutang_cust,
					"lpiutang_total"=>lpiutang_total,
					"lpiutang_sisa"=>lpiutang_total
					);
					$this->db->where('lpiutang_faktur', $lpiutang_faktur);
					$this->db->update('master_lunas_piutang', $dtu_lpiutang);
				}else{
					/* INSERT db.master_lunas_piutang */
					$dti_lpiutang=array(
					"lpiutang_faktur"=>$lpiutang_faktur,
					"lpiutang_cust"=>$lpiutang_cust,
					"lpiutang_faktur_tanggal"=>$lpiutang_faktur_tanggal,
					"lpiutang_total"=>$lpiutang_total,
					"lpiutang_sisa"=>$lpiutang_total
					);
					$this->db->insert('master_lunas_piutang', $dti_lpiutang);
				}
			}
		}
		
		function member_point_update($dproduk_master){
			$date_now=date('Y-m-d');
			$sql="SELECT jproduk_cust FROM master_jual_produk WHERE jproduk_id='$dproduk_master'";
			$rs=$this->db->query($sql);
			$record=$rs->row_array();
			$jproduk_cust=$record['jproduk_cust'];
			
			$sql="SELECT member_id FROM member WHERE member_cust='$jproduk_cust' AND (member_valid >= '$date_now')";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql="SELECT setmember_rp_perpoint FROM member_setup LIMIT 1";
				$rs=$this->db->query($sql);
				$record=$rs->row_array();
				$setmember_rp_perpoint=$record['setmember_rp_perpoint'];
				
				$sql="SELECT dproduk_jumlah, dproduk_harga, dproduk_diskon, produk_point, jproduk_diskon, jproduk_cashback FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) LEFT JOIN produk ON(dproduk_produk=produk_id) WHERE dproduk_master='$dproduk_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$one_record = $rs->row();
					$jproduk_cashback = $one_record->jproduk_cashback;
					$jproduk_diskon = $one_record->jproduk_diskon;
					$jumlah_rupiah = 0;
					$jumlah_point = 0;
					foreach($rs->result() as $row){
						//$jumlah_point += ($row->dproduk_jumlah) * ($row->produk_point) * (floor(($row->dproduk_harga)/$setmember_rp_perpoint));
						$jumlah_rupiah += ($row->dproduk_jumlah) * ($row->produk_point) * ($row->dproduk_harga) * ((100 - $row->dproduk_diskon)/100);
					}
					$jumlah_rupiah -= $jproduk_cashback;
					if($setmember_rp_perpoint<>0){
						$jumlah_point = floor($jumlah_rupiah/$setmember_rp_perpoint);
					}
					$sql_cust_u = "UPDATE customer SET cust_point = (cust_point + $jumlah_point) WHERE cust_id='$jproduk_cust'";
					$this->db->query($sql_cust_u);
					
					$dtu_jproduk=array(
					"jproduk_point"=>$jumlah_point
					);
					$this->db->where('jproduk_id', $dproduk_master);
					$this->db->update('master_jual_produk', $dtu_jproduk);
				}
			}
		}
		
		function member_point_delete($dproduk_master){
			$date_now=date('Y-m-d');
			
			$sql="SELECT jproduk_cust FROM master_jual_produk WHERE jproduk_id='$dproduk_master'";
			$rs=$this->db->query($sql);
			$record=$rs->row_array();
			$jproduk_cust=$record['jproduk_cust'];
			
			$sql="SELECT member_id FROM member WHERE member_cust='$jproduk_cust' AND (member_valid >= '$date_now')";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql="SELECT setmember_rp_perpoint FROM member_setup LIMIT 1";
				$rs=$this->db->query($sql);
				$record=$rs->row_array();
				$setmember_rp_perpoint=$record['setmember_rp_perpoint'];
				
				$sql="SELECT dproduk_jumlah, dproduk_harga, produk_point, dproduk_diskon, jproduk_diskon, jproduk_cashback FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) LEFT JOIN produk ON(dproduk_produk=produk_id) WHERE dproduk_master='$dproduk_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$one_record = $rs->row();
					$jproduk_cashback = $one_record->jproduk_cashback;
					$jproduk_diskon = $one_record->jproduk_diskon;
					$jumlah_rupiah = 0;
					$jumlah_point = 0;
					foreach($rs->result() as $row){
						//$jumlah_point += ($row->dproduk_jumlah) * ($row->produk_point) * (floor(($row->dproduk_harga)/$setmember_rp_perpoint));
						$jumlah_rupiah += ($row->dproduk_jumlah) * ($row->produk_point) * ($row->dproduk_harga) * ((100 - $row->dproduk_diskon)/100);
					}
					$jumlah_rupiah -= $jproduk_cashback;
					if($setmember_rp_perpoint<>0){
						$jumlah_point = floor($jumlah_rupiah/$setmember_rp_perpoint);
					}
					$sql="UPDATE customer SET cust_point = (cust_point - $jumlah_point) WHERE cust_id='$jproduk_cust'";
					$this->db->query($sql);
					return 1;
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}
		
		function member_point_batal($jproduk_id){
			$sql = "SELECT jproduk_point, jproduk_cust FROM master_jual_produk WHERE jproduk_id='$jproduk_id'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$jproduk_point = $record['jproduk_point'];
				$jproduk_cust = $record['jproduk_cust'];
				$sql="UPDATE customer SET cust_point = (cust_point - $jproduk_point) WHERE cust_id='$jproduk_cust'";
				$this->db->query($sql);
			}
		}
		
		function membership_insert($jproduk_id){
			$date_now=date('Y-m-d');
			$this->db->where('membert_register <', $date_now);
			$this->db->delete('member_temp');
			
			$sql="SELECT setmember_transhari, setmember_periodeaktif, setmember_periodetenggang, setmember_transtenggang FROM member_setup LIMIT 1";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$min_trans_member_baru=$rs_record['setmember_transhari'];
				$periode_tenggang=$rs_record['setmember_periodetenggang'];
				$min_trans_tenggang=$rs_record['setmember_transtenggang'];
				$periode_aktif=$rs_record['setmember_periodeaktif'];
			}
			
			$sql="SELECT jproduk_cust FROM master_jual_produk WHERE jproduk_id='$jproduk_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$cust_id = $rs_record['jproduk_cust'];
				
				$jproduk_total_trans=0;
				$jpaket_total_trans=0;
				$jrawat_total_trans=0;
				$cust_total_trans_now=0;
				
				$trans_jproduk = "SELECT sum(jproduk_totalbiaya) AS jproduk_total_trans FROM master_jual_produk WHERE jproduk_cust='$cust_id' AND jproduk_tanggal='$date_now' AND jproduk_stat_dok='Tertutup' GROUP BY jproduk_cust";
				$rs_trans_jproduk=$this->db->query($trans_jproduk);
				if($rs_trans_jproduk->num_rows()){
					$rs_trans_jproduk_record=$rs_trans_jproduk->row_array();
					$jproduk_total_trans=$rs_trans_jproduk_record['jproduk_total_trans'];
				}
				
				$trans_jpaket = "SELECT sum(jpaket_totalbiaya) AS jpaket_total_trans FROM master_jual_paket WHERE jpaket_cust='$cust_id' AND jpaket_tanggal='$date_now' AND jpaket_stat_dok='Tertutup' GROUP BY jpaket_cust";
				$rs_trans_jpaket=$this->db->query($trans_jpaket);
				if($rs_trans_jpaket->num_rows()){
					$rs_trans_jpaket_record=$rs_trans_jpaket->row_array();
					$jpaket_total_trans=$rs_trans_jpaket_record['jpaket_total_trans'];
				}
				
				$trans_jrawat = "SELECT sum(jrawat_totalbiaya) AS jrawat_total_trans FROM master_jual_rawat WHERE jrawat_cust='$cust_id' AND jrawat_tanggal='$date_now' AND jrawat_stat_dok='Tertutup' GROUP BY jrawat_cust";
				$rs_trans_jrawat=$this->db->query($trans_jrawat);
				if($rs_trans_jrawat->num_rows()){
					$rs_trans_jrawat_record=$rs_trans_jrawat->row_array();
					$jrawat_total_trans=$rs_trans_jrawat_record['jrawat_total_trans'];
				}
				
				$cust_total_trans_now = $jproduk_total_trans + $jpaket_total_trans + $jrawat_total_trans;
				
				$sql="SELECT member_cust, member_valid, member_no FROM member WHERE member_cust='$cust_id'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					//* artinya: customer sudah menjadi MEMBER.
					//* untuk itu: check tanggal member_valid /
					$rs_record=$rs->row_array();
					$member_cust=$rs_record['member_cust'];
					$member_valid=$rs_record['member_valid'];
					$member_no=$rs_record['member_no'];
					
					$akhir_tenggang=date('Y-m-d', strtotime("$member_valid +$periode_tenggang days"));
					
					if(($member_valid < $date_now) && ($member_valid < $akhir_tenggang)){
						//* kartu member masuk masa tenggang /
						//* untuk itu: check total_transaksi si customer di hari ini /
						
						$set_member_valid = date('Y-m-d', strtotime("$date_now +$periode_aktif days"));
						
						if($cust_total_trans_now >= $min_trans_tenggang){
							//* Perpanjangan kartu member /
							$sql = "SELECT membert_id FROM member_temp WHERE membert_cust='$cust_id'";
							$rs = $this->db->query($sql);
							if(!($rs->num_rows())){
								$dti_membert=array(
								"membert_cust"=>$cust_id,
								"membert_no"=>$member_no,
								"membert_register"=>$date_now,
								"membert_valid"=>$set_member_valid,
								"membert_jenis"=>'perpanjangan',
								"membert_status"=>'Daftar'
								);
								$this->db->insert('member_temp', $dti_membert);
							}
						}else{
							//* message: kartu member customer ini sementara tidak bisa digunakan, karena sudah masuk masa tenggang /
							//* deleting customer pada db.member_temp (yang mungkin sebelumnya dimasukkan), dikarenakan ada pembatalan transaksi sehingga $cust_total_trans_now tidak memenuhi syarat /
							$this->db->where('membert_cust', $cust_id);
							$this->db->delete('member_temp');
						}
					}else{
						//* check tanggal member_valid, apakah member_valid > $date_now ? /
						//* JIKA 'YA': kartu member customer ini masih Aktif ==> NO ACTION/
						//* JIKA 'TIDAK': kartu member sudah hangus ==> message: kartu member customer ini sudah tidak bisa digunakan lagi karena kartu sudah hangus.
						if($member_valid > $date_now){
							//* NO ACTION /
						}else{
							//* message: kartu member customer ini sudah tidak bisa digunakan lagi karena kartu sudah hangus.
						}
					}
				}else{
					//* artinya: customer belum pernah menjadi MEMBER (belum masuk ke db.member). /
					//* untuk itu: check total_transaksi si customer di hari ini dan bandingkan dengan db.member_setup.setmember_transhari /
					if($cust_total_trans_now >= $min_trans_member_baru){
						//* Pendaftaran MEMBER BARU /
						$set_member_valid = date('Y-m-d', strtotime("$date_now +$periode_aktif days"));
						
						$sql = "SELECT membert_id FROM member_temp WHERE membert_cust='$cust_id'";
						$rs = $this->db->query($sql);
						if(!($rs->num_rows())){
							$dti_membert=array(
							"membert_cust"=>$cust_id,
							"membert_register"=>$date_now,
							"membert_valid"=>$set_member_valid,
							"membert_jenis"=>'baru',
							"membert_status"=>'Daftar'
							);
							$this->db->insert('member_temp', $dti_membert);
						}
					}else{
						//* Syarat menjadi MEMBER belum terpenuhi /
						//* deleting di db.member_temp (jika sebelumnya sudah diinsert), karena melakukan pembatalan transaksi sehingga total transaksi hari ini tidak memenuhi syarat menjadi member /
						$this->db->where('membert_cust', $cust_id);
						$this->db->delete('member_temp');
					}
				}
			}
		}
		
		function stat_dok_tertutup_update($jproduk_id){
			//* status dokumen menjadi tertutup setelah Faktur selesai di-cetak /
			$sql="UPDATE master_jual_produk SET jproduk_stat_dok='Tertutup' WHERE jproduk_id='$jproduk_id'";
			$this->db->query($sql);
		}
		
		//purge all detail from master
		function detail_detail_jual_produk_purge($master_id){
			//* Mengurangi point di db.customer.cust_point /
			$result_point_delete = $this->member_point_delete($master_id);
			if($result_point_delete==1){
				$sql="DELETE from detail_jual_produk where dproduk_master='".$master_id."'";
				//$result=$this->db->query($sql);
				$this->db->query($sql);
			}
		}
		//*eof
		
		//insert detail record
		function detail_detail_jual_produk_insert($array_dproduk_id ,$dproduk_master ,$array_dproduk_karyawan, $array_dproduk_produk ,$array_dproduk_satuan ,$array_dproduk_jumlah ,$array_dproduk_harga ,$array_dproduk_subtotal_net ,$array_dproduk_diskon ,$array_dproduk_diskon_jenis ,$array_dproduk_sales ,$cetak){
			$date_now=date('Y-m-d');
			//if master id not capture from view then capture it from max pk from master table
			if($dproduk_master=="" || $dproduk_master==NULL || $dproduk_master==0){
				$dproduk_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_dproduk_produk) - 1;
			
			for($i = 0; $i < sizeof($array_dproduk_produk); $i++){
				$dproduk_id = $array_dproduk_id[$i];
				$dproduk_karyawan = $array_dproduk_karyawan[$i];
				$dproduk_produk = $array_dproduk_produk[$i];
				$dproduk_satuan = $array_dproduk_satuan[$i];
				$dproduk_jumlah = $array_dproduk_jumlah[$i];
				$dproduk_harga = $array_dproduk_harga[$i];
				$dproduk_subtotal_net = $array_dproduk_subtotal_net[$i];
				$dproduk_diskon = $array_dproduk_diskon[$i];
				$dproduk_diskon_jenis = $array_dproduk_diskon_jenis[$i];
				$dproduk_sales = $array_dproduk_sales[$i];
				
				if(is_numeric($dproduk_id)){
					//* artinya: detail produk ini sudah diinsertkan ke db.detail_jual_produk /
					if($cetak==1 && $i==$size_array){
						$this->stat_dok_tertutup_update($dproduk_master);
						$this->member_point_update($dproduk_master);
						$this->membership_insert($dproduk_master);
						return $dproduk_master;
					}else if($cetak<>1 && $i==$size_array){
						return '0';
					}
				}else{
					//* artinya: detail produk ini adalah penambahan detail baru /
					$dti_jproduk = array(
						"dproduk_master"=>$dproduk_master, 
						"dproduk_produk"=>$dproduk_produk, 
						"dproduk_karyawan"=>$dproduk_karyawan,
						"dproduk_satuan"=>$dproduk_satuan, 
						"dproduk_jumlah"=>$dproduk_jumlah, 
						"dproduk_harga"=>$dproduk_harga, 
						"dproduk_diskon"=>$dproduk_diskon,
						"dproduk_diskon_jenis"=>$dproduk_diskon_jenis,
						"dproduk_sales"=>$dproduk_sales
					);
					$this->db->insert('detail_jual_produk', $dti_jproduk);
					if($this->db->affected_rows()){
						if($cetak==1 && $i==$size_array){
							$this->stat_dok_tertutup_update($dproduk_master);
							$this->member_point_update($dproduk_master);
							$this->membership_insert($dproduk_master);
							return $dproduk_master;
						}else if($cetak<>1 && $i==$size_array){
							return '0';
						}
					}else{
						return '-1';
					}
				}
				
			}
			
			/*$sql="SELECT dproduk_id, dproduk_jumlah FROM detail_jual_produk WHERE dproduk_master='$dproduk_master' AND dproduk_produk='$dproduk_produk' AND dproduk_diskon_jenis<>'Bonus'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				if($dproduk_diskon_jenis<>'Bonus'){
					//* UPDATE detail_jual_produk untuk menambahkan dproduk_jumlah, ini dikarenakan kasir memasukkan produk yg sama lebih dari satu dalam satu Faktur /
					$record = $rs->row_array();
					$dproduk_id=$record['dproduk_id'];
					$dproduk_jumlah_awal = $record['dproduk_jumlah'];
					$dproduk_jumlah += $dproduk_jumlah_awal;
					
					$dtu_dproduk=array(
					"dproduk_jumlah"=>$dproduk_jumlah
					);
					$this->db->where('dproduk_id', $dproduk_id);
					$this->db->update('detail_jual_produk', $dtu_dproduk);
					if($this->db->affected_rows()){
						if($cetak==1 && ($count==($dcount-1))){
							$this->member_point_update($dproduk_master);
							$this->membership_insert($dproduk_master);
							$this->stat_dok_tertutup_update($dproduk_master);
							return $dproduk_master;
						}else if($cetak!==1 && ($count==($dcount-1))){
							return '0';
						}else if($count!==($dcount-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				}else if($dproduk_diskon_jenis=='Bonus'){
					$data = array(
						"dproduk_master"=>$dproduk_master, 
						"dproduk_produk"=>$dproduk_produk, 
						"dproduk_karyawan"=>$dproduk_karyawan,
						"dproduk_satuan"=>$dproduk_satuan, 
						"dproduk_jumlah"=>$dproduk_jumlah, 
						"dproduk_harga"=>$dproduk_harga, 
						"dproduk_diskon"=>$dproduk_diskon,
						"dproduk_diskon_jenis"=>$dproduk_diskon_jenis,
						"dproduk_sales"=>$dproduk_sales,
						//"konversi_nilai_temp"=>$konversi_nilai_temp
					);
					$this->db->insert('detail_jual_produk', $data); 
					if($this->db->affected_rows()){
						if($cetak==1 && ($count==($dcount-1))){
							$this->member_point_update($dproduk_master);
							$this->membership_insert($dproduk_master);
							$this->stat_dok_tertutup_update($dproduk_master);
							return $dproduk_master;
						}else if($cetak!==1 && ($count==($dcount-1))){
							return '0';
						}else if($count!==($dcount-1)){
							return '-3';
						}
					}else{
						return '-1';
					}
				}
			}else{
				$data = array(
					"dproduk_master"=>$dproduk_master, 
					"dproduk_produk"=>$dproduk_produk, 
					"dproduk_karyawan"=>$dproduk_karyawan,
					"dproduk_satuan"=>$dproduk_satuan, 
					"dproduk_jumlah"=>$dproduk_jumlah, 
					"dproduk_harga"=>$dproduk_harga, 
					"dproduk_diskon"=>$dproduk_diskon,
					"dproduk_diskon_jenis"=>$dproduk_diskon_jenis,
					"dproduk_sales"=>$dproduk_sales,
					//"konversi_nilai_temp"=>$konversi_nilai_temp
				);
				$this->db->insert('detail_jual_produk', $data); 
				if($this->db->affected_rows()){
					if($cetak==1 && ($count==($dcount-1))){
						$this->member_point_update($dproduk_master);
						$this->membership_insert($dproduk_master);
						$this->stat_dok_tertutup_update($dproduk_master);
						return $dproduk_master;
					}else if($cetak!==1 && ($count==($dcount-1))){
						return '0';
					}else if($count!==($dcount-1)){
						return '-3';
					}
				}else
					return '-1';
			}*/

		}
		//end of function
		
		//function for get list record
		function master_jual_produk_list($filter,$start,$end){
			$date_now=date('Y-m-d');

			$query = "SELECT jproduk_id, jproduk_nobukti, cust_nama, cust_no, cust_member, member_no,member_valid, jproduk_cust, jproduk_tanggal, jproduk_diskon, jproduk_cashback, jproduk_cara, jproduk_cara2, jproduk_cara3, jproduk_bayar, IF(vu_jproduk.jproduk_totalbiaya!=0, vu_jproduk.jproduk_totalbiaya, vu_jproduk_totalbiaya.jproduk_totalbiaya) AS jproduk_totalbiaya, jproduk_keterangan, jproduk_stat_dok, jproduk_creator, jproduk_date_create, jproduk_update, jproduk_date_update, jproduk_revised, jproduk_stat_dok FROM vu_jproduk LEFT JOIN vu_jproduk_totalbiaya ON(vu_jproduk_totalbiaya.dproduk_master=vu_jproduk.jproduk_id)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_nobukti LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' )";
			}
			//normal LIST by Hendri
			else {
				$query .= eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " date_format(jproduk_date_create,'%Y-%m-%d')='$date_now'";
			}
			
			$query .= " ORDER BY jproduk_nobukti DESC";
			
			$query_nbrows="SELECT jproduk_id FROM master_jual_produk LEFT JOIN customer ON(jproduk_cust=cust_id)";
			// For simple search
			if ($filter<>""){
				$query_nbrows .=eregi("WHERE",$query_nbrows)? " AND ":" WHERE ";
				$query_nbrows .= " (jproduk_nobukti LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' )";
			}
			else {
				$query_nbrows .= eregi("WHERE",$query_nbrows)? " AND ":" WHERE ";
				$query_nbrows .= " date_format(jproduk_date_create,'%Y-%m-%d')='$date_now'";
			}
			
			$result2 = $this->db->query($query_nbrows);
			$nbrows = $result2->num_rows();
			//$result = $this->db->query($query);
			//$nbrows = $result->num_rows();
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
		function master_jual_produk_update($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal , $jproduk_stat_dok, $jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_tunai_nilai, $jproduk_tunai_nilai2, $jproduk_tunai_nilai3, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_subtotal, $jproduk_total, $jproduk_hutang, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_no, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_no2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_no3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nama, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nama2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nama3, $jproduk_transfer_nilai3){
			if ($jproduk_stat_dok=="")
				$jproduk_stat_dok = "Terbuka";
			
			$sql="SELECT jproduk_cara, jproduk_cara2, jproduk_cara3 FROM master_jual_produk WHERE jproduk_id='$jproduk_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$jproduk_cara_awal=$rs_record["jproduk_cara"];
				$jproduk_cara2_awal=$rs_record["jproduk_cara2"];
				$jproduk_cara3_awal=$rs_record["jproduk_cara3"];
				if($jproduk_cara_awal<>$jproduk_cara){
					if($jproduk_cara_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara_awal=="voucher"){
						$sql="delete from voucher_terima where tvoucher_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
				}
				
				if($jproduk_cara2_awal<>$jproduk_cara2){
					if($jproduk_cara2_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara2_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara2_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara2_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara2_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara2_awal=="voucher"){
						$sql="delete from voucher_terima where tvoucher_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
				}
				
				if($jproduk_cara3_awal<>$jproduk_cara3){
					if($jproduk_cara3_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara3_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara3_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara3_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara3_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
					if($jproduk_cara3_awal=="voucher"){
						$sql="delete from voucher_terima where tvoucher_ref='".$jproduk_nobukti."'";
						$this->db->query($sql);
					}
				}
			}
			$data = array(
				//"jproduk_id"=>$jproduk_id, 
				"jproduk_nobukti"=>$jproduk_nobukti, 
				"jproduk_tanggal"=>$jproduk_tanggal, 
				"jproduk_diskon"=>$jproduk_diskon,
				"jproduk_cashback"=>$jproduk_cashback,
				"jproduk_bayar"=>$jproduk_bayar,
				"jproduk_totalbiaya"=>$jproduk_total,
				"jproduk_cara"=>$jproduk_cara, 
				"jproduk_stat_dok"=>$jproduk_stat_dok,
				//"jproduk_cara2"=>$jproduk_cara2, 
				//"jproduk_cara3"=>$jproduk_cara3,
				"jproduk_keterangan"=>$jproduk_keterangan 
			);
			if($jproduk_cara2!=null)
				$data["jproduk_cara2"]=$jproduk_cara2;
			if($jproduk_cara3!=null)
				$data["jproduk_cara3"]=$jproduk_cara3;
			
			$sql="select cust_id from customer where cust_id='".$jproduk_cust."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jproduk_cust"]=$jproduk_cust;
				
			$this->db->where('jproduk_id', $jproduk_id);
			$this->db->update('master_jual_produk', $data);
			if($this->db->affected_rows() || $this->db->affected_rows()==0){
				
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);*/
				
				if($jproduk_cara!=null || $jproduk_cara!=''){
					//kwitansi
					if($jproduk_cara=='kwitansi'){
						if($jproduk_kwitansi_nama=="" || $jproduk_kwitansi_nama==NULL){
							if(is_int($jproduk_kwitansi_nama)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_kwitansi_nama=$data->cust_nama;
								}
							}else{
									$jproduk_kwitansi_nama=$jproduk_cust;
							}
						}
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jproduk_kwitansi_no,
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai
							);
							$this->db->where('jkwitansi_ref', $jproduk_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jproduk_nobukti,
								"jkwitansi_master"=>$jproduk_kwitansi_no,
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai,
								"jkwitansi_transaksi"=>"jual_produk"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jproduk_cara=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jproduk_card_nama,
								"jcard_edc"=>$jproduk_card_edc,
								"jcard_no"=>$jproduk_card_no,
								"jcard_nilai"=>$jproduk_card_nilai
								);
							$this->db->where('jcard_ref', $jproduk_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jproduk_nobukti,
								"jcard_nama"=>$jproduk_card_nama,
								"jcard_edc"=>$jproduk_card_edc,
								"jcard_no"=>$jproduk_card_no,
								"jcard_nilai"=>$jproduk_card_nilai,
								"jcard_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_card', $data);
						}
					
					}else if($jproduk_cara=='cek/giro'){
						
						if($jproduk_cek_nama=="" || $jproduk_cek_nama==NULL){
							if(is_int($jproduk_cek_nama)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_cek_nama=$data->cust_nama;
								}
							}else{
									$jproduk_cek_nama=$jproduk_cust;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jproduk_cek_nama,
								"jcek_no"=>$jproduk_cek_no,
								"jcek_valid"=>$jproduk_cek_valid,
								"jcek_bank"=>$jproduk_cek_bank,
								"jcek_nilai"=>$jproduk_cek_nilai,
								);
							$this->db->where('jcek_ref', $jproduk_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jproduk_nobukti,
								"jcek_nama"=>$jproduk_cek_nama,
								"jcek_no"=>$jproduk_cek_no,
								"jcek_valid"=>$jproduk_cek_valid,
								"jcek_bank"=>$jproduk_cek_bank,
								"jcek_nilai"=>$jproduk_cek_nilai,
								"jcek_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_cek', $data);
						}
						 
					}else if($jproduk_cara=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jproduk_transfer_bank,
								"jtransfer_nama"=>$jproduk_transfer_nama,
								"jtransfer_nilai"=>$jproduk_transfer_nilai
								);
							$this->db->where('jtransfer_ref', $jproduk_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jproduk_nobukti,
								"jtransfer_bank"=>$jproduk_transfer_bank,
								"jtransfer_nama"=>$jproduk_transfer_nama,
								"jtransfer_nilai"=>$jproduk_transfer_nilai,
								"jtransfer_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_transfer', $data);
						}
					}else if($jproduk_cara=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jproduk_tunai_nilai
								);
							$this->db->where('jtunai_ref', $jproduk_nobukti);
							$this->db->update('jual_tunai', $data);
						}else{
							$data=array(
								"jtunai_nilai"=>$jproduk_tunai_nilai,
								"jtunai_ref"=>$jproduk_nobukti,
								"jtunai_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jproduk_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no,
								"tvoucher_nilai"=>$jproduk_voucher_cashback
								);
							$this->db->where('tvoucher_ref', $jproduk_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no,
								"tvoucher_ref"=>$jproduk_nobukti,
								"tvoucher_nilai"=>$jproduk_voucher_cashback,
								"tvoucher_transaksi"=>"jual_produk"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($jproduk_cara2!=null || $jproduk_cara2!=''){
					//kwitansi
					if($jproduk_cara2=='kwitansi'){
						if($jproduk_kwitansi_nama2=="" || $jproduk_kwitansi_nama2==NULL){
							if(is_int($jproduk_kwitansi_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_kwitansi_nama2=$data->cust_nama;
								}
							}else{
									$jproduk_kwitansi_nama2=$jproduk_cust;
							}
						}
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jproduk_kwitansi_no2,
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai2
							);
							$this->db->where('jkwitansi_ref', $jproduk_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jproduk_nobukti,
								"jkwitansi_master"=>$jproduk_kwitansi_no2,
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai2,
								"jkwitansi_transaksi"=>"jual_produk"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jproduk_cara2=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jproduk_card_nama2,
								"jcard_edc"=>$jproduk_card_edc2,
								"jcard_no"=>$jproduk_card_no2,
								"jcard_nilai"=>$jproduk_card_nilai2
								);
							$this->db->where('jcard_ref', $jproduk_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jproduk_nobukti,
								"jcard_nama"=>$jproduk_card_nama2,
								"jcard_edc"=>$jproduk_card_edc2,
								"jcard_no"=>$jproduk_card_no2,
								"jcard_nilai"=>$jproduk_card_nilai2,
								"jcard_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_card', $data);
						}
					
					}else if($jproduk_cara2=='cek/giro'){
						
						if($jproduk_cek_nama2=="" || $jproduk_cek_nama2==NULL){
							if(is_int($jproduk_cek_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_cek_nama2=$data->cust_nama;
								}
							}else{
									$jproduk_cek_nama2=$jproduk_cust;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jproduk_cek_nama2,
								"jcek_no"=>$jproduk_cek_no2,
								"jcek_valid"=>$jproduk_cek_valid2,
								"jcek_bank"=>$jproduk_cek_bank2,
								"jcek_nilai"=>$jproduk_cek_nilai2
								);
							$this->db->where('jcek_ref', $jproduk_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jproduk_nobukti,
								"jcek_nama"=>$jproduk_cek_nama2,
								"jcek_no"=>$jproduk_cek_no2,
								"jcek_valid"=>$jproduk_cek_valid2,
								"jcek_bank"=>$jproduk_cek_bank2,
								"jcek_nilai"=>$jproduk_cek_nilai2,
								"jcek_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_cek', $data);
						}
						 
					}else if($jproduk_cara2=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jproduk_transfer_bank2,
								"jtransfer_nama"=>$jproduk_transfer_nama2,
								"jtransfer_nilai"=>$jproduk_transfer_nilai2
								);
							$this->db->where('jtransfer_ref', $jproduk_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jproduk_nobukti,
								"jtransfer_bank"=>$jproduk_transfer_bank2,
								"jtransfer_nama"=>$jproduk_transfer_nama2,
								"jtransfer_nilai"=>$jproduk_transfer_nilai2,
								"jtransfer_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_transfer', $data);
						}
						 
					}else if($jproduk_cara2=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jproduk_tunai_nilai2
								);
							$this->db->where('jtunai_ref', $jproduk_nobukti);
							$this->db->update('jual_tunai', $data); 
						}else{
							$data=array(
								"jtunai_ref"=>$jproduk_nobukti,
								"jtunai_nilai"=>$jproduk_tunai_nilai2,
								"jtunai_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jproduk_cara2=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no2,
								"tvoucher_nilai"=>$jproduk_voucher_cashback2
								);
							$this->db->where('tvoucher_ref', $jproduk_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no2'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no2,
								"tvoucher_ref"=>$jproduk_nobukti,
								"tvoucher_nilai"=>$jproduk_voucher_cashback2,
								"tvoucher_transaksi"=>"jual_produk"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($jproduk_cara3!=null || $jproduk_cara3!=''){
					//kwitansi
					if($jproduk_cara3=='kwitansi'){
						if($jproduk_kwitansi_nama3=="" || $jproduk_kwitansi_nama3==NULL){
							if(is_int($jproduk_kwitansi_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_kwitansi_nama3=$data->cust_nama;
								}
							}else{
									$jproduk_kwitansi_nama3=$jproduk_cust;
							}
						}
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jproduk_kwitansi_no3,
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai3
							);
							$this->db->where('jkwitansi_ref', $jproduk_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jproduk_nobukti,
								"jkwitansi_master"=>$jproduk_kwitansi_no3,
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai3,
								"jkwitansi_transaksi"=>"jual_produk"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jproduk_cara3=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jproduk_card_nama3,
								"jcard_edc"=>$jproduk_card_edc3,
								"jcard_no"=>$jproduk_card_no3,
								"jcard_nilai"=>$jproduk_card_nilai3
								);
							$this->db->where('jcard_ref', $jproduk_nobukti);
							$this->db->update('jual_card', $data); 
						}else{
							$data=array(
								"jcard_ref"=>$jproduk_nobukti,
								"jcard_nama"=>$jproduk_card_nama3,
								"jcard_edc"=>$jproduk_card_edc3,
								"jcard_no"=>$jproduk_card_no3,
								"jcard_nilai"=>$jproduk_card_nilai3,
								"jcard_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_card', $data); 
						}
					
					}else if($jproduk_cara3=='cek/giro'){
						
						if($jproduk_cek_nama3=="" || $jproduk_cek_nama3==NULL){
							if(is_int($jproduk_cek_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_cek_nama3=$data->cust_nama;
								}
							}else{
									$jproduk_cek_nama3=$jproduk_cust;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jproduk_cek_nama3,
								"jcek_no"=>$jproduk_cek_no3,
								"jcek_valid"=>$jproduk_cek_valid3,
								"jcek_bank"=>$jproduk_cek_bank3,
								"jcek_nilai"=>$jproduk_cek_nilai3
								);
							$this->db->where('jcek_ref', $jproduk_nobukti);
							$this->db->update('jual_cek', $data); 
						}else{
							$data=array(
								"jcek_ref"=>$jproduk_nobukti,
								"jcek_nama"=>$jproduk_cek_nama3,
								"jcek_no"=>$jproduk_cek_no3,
								"jcek_valid"=>$jproduk_cek_valid3,
								"jcek_bank"=>$jproduk_cek_bank3,
								"jcek_nilai"=>$jproduk_cek_nilai3,
								"jcek_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_cek', $data); 
						}
						
					}else if($jproduk_cara3=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jproduk_transfer_bank3,
								"jtransfer_nama"=>$jproduk_transfer_nama3,
								"jtransfer_nilai"=>$jproduk_transfer_nilai3
								);
							$this->db->where('jtransfer_ref', $jproduk_nobukti);
							$this->db->update('jual_transfer', $data); 
						}else{
							$data=array(
								"jtransfer_ref"=>$jproduk_nobukti,
								"jtransfer_bank"=>$jproduk_transfer_bank3,
								"jtransfer_nama"=>$jproduk_transfer_nama3,
								"jtransfer_nilai"=>$jproduk_transfer_nilai3,
								"jtransfer_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_transfer', $data);
						}
						
					}else if($jproduk_cara3=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jproduk_tunai_nilai3
								);
							$this->db->where('jtunai_ref', $jproduk_nobukti);
							$this->db->update('jual_tunai', $data); 
						}else{
							$data=array(
								"jtunai_ref"=>$jproduk_nobukti,
								"jtunai_nilai"=>$jproduk_tunai_nilai3,
								"jtunai_transaksi"=>"jual_produk"
								);
							$this->db->where('jtunai_ref', $jproduk_nobukti);
							$this->db->update('jual_tunai', $data);
						}
					}else if($jproduk_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no3,
								"tvoucher_nilai"=>$jproduk_voucher_cashback3
								);
							$this->db->where('tvoucher_ref', $jproduk_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no3'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no3,
								"tvoucher_ref"=>$jproduk_nobukti,
								"tvoucher_nilai"=>$jproduk_voucher_cashback3,
								"tvoucher_transaksi"=>"jual_produk"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				
				return '0';
			}
			else
				return '-1';
		}
		
		//function for create new record
		function master_jual_produk_create($jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_stat_dok, $jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_tunai_nilai, $jproduk_tunai_nilai2, $jproduk_tunai_nilai3, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_subtotal, $jproduk_total, $jproduk_hutang, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_no, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_no2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_no3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nama, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nama2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nama3, $jproduk_transfer_nilai3){
			
			$pattern="FT/".date("ym")."-";
			$jproduk_nobukti=$this->m_public_function->get_kode_1('master_jual_produk','jproduk_nobukti',$pattern,12);
			if ($jproduk_stat_dok=="")
				$jproduk_stat_dok = "Terbuka";
			
			
			$data = array(
				"jproduk_nobukti"=>$jproduk_nobukti, 
				"jproduk_cust"=>$jproduk_cust, 
				"jproduk_tanggal"=>$jproduk_tanggal, 
				"jproduk_diskon"=>$jproduk_diskon, 
				"jproduk_cashback"=>$jproduk_cashback,
				"jproduk_bayar"=>$jproduk_bayar,
				"jproduk_totalbiaya"=>$jproduk_total,
				"jproduk_cara"=>$jproduk_cara,
				"jproduk_stat_dok"=>$jproduk_stat_dok,
				//"jproduk_cara2"=>$jproduk_cara2, 
				//"jproduk_cara3"=>$jproduk_cara3, 
				"jproduk_keterangan"=>$jproduk_keterangan,
				"jproduk_creator"=>$_SESSION[SESSION_USERID]
			);
			if($jproduk_cara2!=null)
				$data["jproduk_cara2"]=$jproduk_cara2;
			if($jproduk_cara3!=null)
				$data["jproduk_cara3"]=$jproduk_cara3;
			$this->db->insert('master_jual_produk', $data); 
			if($this->db->affected_rows()){
				
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);*/
				
				if($jproduk_cara!=null || $jproduk_cara!=''){
					//kwitansi
					if($jproduk_cara=='kwitansi'){
						if($jproduk_kwitansi_nama=="" || $jproduk_kwitansi_nama==NULL){
							if(is_int($jproduk_kwitansi_nama)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_kwitansi_nama=$data->cust_nama;
								}
							}else{
									$jproduk_kwitansi_nama=$jproduk_cust;
							}
						}
						
						$data=array(
							"jkwitansi_master"=>$jproduk_kwitansi_no,
							"jkwitansi_nilai"=>$jproduk_kwitansi_nilai,
							"jkwitansi_ref"=>$jproduk_nobukti,
							"jkwitansi_transaksi"=>"jual_produk"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jproduk_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jproduk_card_nama,
							"jcard_edc"=>$jproduk_card_edc,
							"jcard_no"=>$jproduk_card_no,
							"jcard_nilai"=>$jproduk_card_nilai,
							"jcard_ref"=>$jproduk_nobukti,
							"jcard_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jproduk_cara=='cek/giro'){
						
						if($jproduk_cek_nama=="" || $jproduk_cek_nama==NULL){
							if(is_int($jproduk_cek_nama)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_cek_nama=$data->cust_nama;
								}
							}else{
									$jproduk_cek_nama=$jproduk_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jproduk_cek_nama,
							"jcek_no"=>$jproduk_cek_no,
							"jcek_valid"=>$jproduk_cek_valid,
							"jcek_bank"=>$jproduk_cek_bank,
							"jcek_nilai"=>$jproduk_cek_nilai,
							"jcek_ref"=>$jproduk_nobukti,
							"jcek_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jproduk_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jproduk_transfer_bank,
							"jtransfer_nama"=>$jproduk_transfer_nama,
							"jtransfer_nilai"=>$jproduk_transfer_nilai,
							"jtransfer_ref"=>$jproduk_nobukti,
							"jtransfer_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jproduk_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jproduk_tunai_nilai,
							"jtunai_ref"=>$jproduk_nobukti,
							"jtunai_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jproduk_cara=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jproduk_voucher_no,
							"tvoucher_ref"=>$jproduk_nobukti,
							"tvoucher_nilai"=>$jproduk_voucher_cashback,
							"tvoucher_transaksi"=>"jual_produk"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				if($jproduk_cara2!=null || $jproduk_cara2!=''){
					//kwitansi
					if($jproduk_cara2=='kwitansi'){
						if($jproduk_kwitansi_nama2=="" || $jproduk_kwitansi_nama2==NULL){
							if(is_int($jproduk_kwitansi_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_kwitansi_nama2=$data->cust_nama;
								}
							}else{
									$jproduk_kwitansi_nama2=$jproduk_cust;
							}
						}
						$data=array(
							"jkwitansi_master"=>$jproduk_kwitansi_no2,
							"jkwitansi_nilai"=>$jproduk_kwitansi_nilai2,
							"jkwitansi_ref"=>$jproduk_nobukti,
							"jkwitansi_transaksi"=>"jual_produk"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jproduk_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jproduk_card_nama2,
							"jcard_edc"=>$jproduk_card_edc2,
							"jcard_no"=>$jproduk_card_no2,
							"jcard_nilai"=>$jproduk_card_nilai2,
							"jcard_ref"=>$jproduk_nobukti,
							"jcard_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jproduk_cara2=='cek/giro'){
						
						if($jproduk_cek_nama2=="" || $jproduk_cek_nama2==NULL){
							if(is_int($jproduk_cek_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_cek_nama2=$data->cust_nama;
								}
							}else{
									$jproduk_cek_nama2=$jproduk_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jproduk_cek_nama2,
							"jcek_no"=>$jproduk_cek_no2,
							"jcek_valid"=>$jproduk_cek_valid2,
							"jcek_bank"=>$jproduk_cek_bank2,
							"jcek_nilai"=>$jproduk_cek_nilai2,
							"jcek_ref"=>$jproduk_nobukti,
							"jcek_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jproduk_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jproduk_transfer_bank2,
							"jtransfer_nama"=>$jproduk_transfer_nama2,
							"jtransfer_nilai"=>$jproduk_transfer_nilai2,
							"jtransfer_ref"=>$jproduk_nobukti,
							"jtransfer_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jproduk_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jproduk_tunai_nilai2,
							"jtunai_ref"=>$jproduk_nobukti,
							"jtunai_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jproduk_cara2=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no2'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jproduk_voucher_no2,
							"tvoucher_ref"=>$jproduk_nobukti,
							"tvoucher_nilai"=>$jproduk_voucher_cashback2,
							"tvoucher_transaksi"=>"jual_produk"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				if($jproduk_cara3!=null || $jproduk_cara3!=''){
					//kwitansi
					if($jproduk_cara3=='kwitansi'){
						if($jproduk_kwitansi_nama3=="" || $jproduk_kwitansi_nama3==NULL){
							if(is_int($jproduk_kwitansi_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_kwitansi_nama3=$data->cust_nama;
								}
							}else{
									$jproduk_kwitansi_nama3=$jproduk_cust;
							}
						}
						$data=array(
							"jkwitansi_master"=>$jproduk_kwitansi_no3,
							"jkwitansi_nilai"=>$jproduk_kwitansi_nilai3,
							"jkwitansi_ref"=>$jproduk_nobukti,
							"jkwitansi_transaksi"=>"jual_produk"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jproduk_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jproduk_card_nama3,
							"jcard_edc"=>$jproduk_card_edc3,
							"jcard_no"=>$jproduk_card_no3,
							"jcard_nilai"=>$jproduk_card_nilai3,
							"jcard_ref"=>$jproduk_nobukti,
							"jcard_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jproduk_cara3=='cek/giro'){
						
						if($jproduk_cek_nama3=="" || $jproduk_cek_nama3==NULL){
							if(is_int($jproduk_cek_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jproduk_cek_nama3=$data->cust_nama;
								}
							}else{
									$jproduk_cek_nama3=$jproduk_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jproduk_cek_nama3,
							"jcek_no"=>$jproduk_cek_no3,
							"jcek_valid"=>$jproduk_cek_valid3,
							"jcek_bank"=>$jproduk_cek_bank3,
							"jcek_nilai"=>$jproduk_cek_nilai3,
							"jcek_ref"=>$jproduk_nobukti,
							"jcek_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jproduk_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jproduk_transfer_bank3,
							"jtransfer_nama"=>$jproduk_transfer_nama3,
							"jtransfer_nilai"=>$jproduk_transfer_nilai3,
							"jtransfer_ref"=>$jproduk_nobukti,
							"jtransfer_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jproduk_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jproduk_tunai_nilai3,
							"jtunai_ref"=>$jproduk_nobukti,
							"jtunai_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jproduk_cara3=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jproduk_voucher_no3'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jproduk_voucher_no3,
							"tvoucher_ref"=>$jproduk_nobukti,
							"tvoucher_nilai"=>$jproduk_voucher_cashback3,
							"tvoucher_transaksi"=>"jual_produk"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				
				return '0';
			}
			else
				return '-1';
		}
		
		//fcuntion for delete record
		function master_jual_produk_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_produks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_jual_produk WHERE jproduk_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_jual_produk WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jproduk_id= ".$pkid[$i];
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
		
		function master_jual_produk_batal($jproduk_id){
			$date_now = date('Y-m-d');
			$dtu_jproduk=array(
			"jproduk_stat_dok"=>'Batal'
			);
			$this->db->where('jproduk_id', $jproduk_id);
			$this->db->where('jproduk_tanggal', $date_now);
			$this->db->update('master_jual_produk', $dtu_jproduk);
			if($this->db->affected_rows()){
				//* udpating db.customer.cust_point ==> proses mengurangi jumlah poin (dikurangi dengan db.master_jual_produk.jproduk_point yg sudah dimasukkan ketika cetak faktur), karena dilakukan pembatalan /
				$this->member_point_batal($jproduk_id);
				$this->membership_insert($jproduk_id);
				return '1';
			}else{
				return '0';
			}
		}
		
		//function for advanced search record
		function master_jual_produk_search($jproduk_id, $jproduk_nobukti, $jproduk_cust, $jproduk_tanggal, $jproduk_tanggal_akhir, $jproduk_diskon, $jproduk_cara, $jproduk_keterangan, $jproduk_stat_dok, $start, $end){
			//full query
			//$query="SELECT jproduk_id, jproduk_nobukti, cust_nama, cust_no, cust_member, member_no, jproduk_cust, jproduk_tanggal, jproduk_diskon, jproduk_cashback, jproduk_cara, jproduk_cara2, jproduk_cara3, jproduk_bayar, jproduk_totalbiaya, jproduk_keterangan, jproduk_creator, jproduk_date_create, jproduk_update, jproduk_date_update, jproduk_revised, jproduk_stat_dok FROM vu_jproduk";
			$query = "SELECT jproduk_id
					,jproduk_nobukti
					,cust_nama
					,cust_no
					,cust_member
					,member_no
					,member_valid
					,jproduk_cust
					,jproduk_tanggal
					,jproduk_diskon
					,jproduk_cashback
					,jproduk_cara
					,jproduk_cara2
					,jproduk_cara3
					,jproduk_bayar
					,IF(vu_jproduk.jproduk_totalbiaya!=0, vu_jproduk.jproduk_totalbiaya, vu_jproduk_totalbiaya.jproduk_totalbiaya) AS jproduk_totalbiaya
					,jproduk_keterangan
					,jproduk_stat_dok
					,jproduk_creator
					,jproduk_date_create
					,jproduk_update
					,jproduk_date_update
					,jproduk_revised
					,jproduk_stat_dok
				FROM vu_jproduk
				LEFT JOIN vu_jproduk_totalbiaya ON(vu_jproduk_totalbiaya.dproduk_master=vu_jproduk.jproduk_id)";
			
			if($jproduk_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_id LIKE '%".$jproduk_id."%'";
			};
			if($jproduk_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_nobukti LIKE '%".$jproduk_nobukti."%'";
			};
			if($jproduk_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_cust = '".$jproduk_cust."'";
			};
			if($jproduk_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_tanggal >= '".$jproduk_tanggal."'";
			};
			if($jproduk_tanggal_akhir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_tanggal <= '".$jproduk_tanggal_akhir."'";
			};
/*			if($jproduk_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_diskon LIKE '%".$jproduk_diskon."%'";
			};
*/			if($jproduk_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_cara LIKE '%".$jproduk_cara."%'";
			};
			if($jproduk_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_keterangan LIKE '%".$jproduk_keterangan."%'";
			};
			if($jproduk_stat_dok!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_stat_dok LIKE '%".$jproduk_stat_dok."%'";
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
		function master_jual_produk_print($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_id LIKE '%".addslashes($filter)."%' OR jproduk_nobukti LIKE '%".addslashes($filter)."%' OR jproduk_cust LIKE '%".addslashes($filter)."%' OR jproduk_tanggal LIKE '%".addslashes($filter)."%' OR jproduk_diskon LIKE '%".addslashes($filter)."%' OR jproduk_cara LIKE '%".addslashes($filter)."%' OR jproduk_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jproduk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_id LIKE '%".$jproduk_id."%'";
				};
				if($jproduk_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_nobukti LIKE '%".$jproduk_nobukti."%'";
				};
				if($jproduk_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cust LIKE '%".$jproduk_cust."%'";
				};
				if($jproduk_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_tanggal LIKE '%".$jproduk_tanggal."%'";
				};
				if($jproduk_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_diskon LIKE '%".$jproduk_diskon."%'";
				};
				if($jproduk_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cara LIKE '%".$jproduk_cara."%'";
				};
				if($jproduk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_keterangan LIKE '%".$jproduk_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_jual_produk_export_excel($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_id LIKE '%".addslashes($filter)."%' OR jproduk_nobukti LIKE '%".addslashes($filter)."%' OR jproduk_cust LIKE '%".addslashes($filter)."%' OR jproduk_tanggal LIKE '%".addslashes($filter)."%' OR jproduk_diskon LIKE '%".addslashes($filter)."%' OR jproduk_cara LIKE '%".addslashes($filter)."%' OR jproduk_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jproduk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_id LIKE '%".$jproduk_id."%'";
				};
				if($jproduk_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_nobukti LIKE '%".$jproduk_nobukti."%'";
				};
				if($jproduk_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cust LIKE '%".$jproduk_cust."%'";
				};
				if($jproduk_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_tanggal LIKE '%".$jproduk_tanggal."%'";
				};
				if($jproduk_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_diskon LIKE '%".$jproduk_diskon."%'";
				};
				if($jproduk_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cara LIKE '%".$jproduk_cara."%'";
				};
				if($jproduk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_keterangan LIKE '%".$jproduk_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		function print_paper($jproduk_id){
			//$sql="SELECT jproduk_tanggal, cust_no, cust_nama, cust_alamat, jproduk_nobukti, produk_nama, dproduk_jumlah, satuan_nama, dproduk_harga, dproduk_diskon, (dproduk_harga*((100-dproduk_diskon)/100)) AS jumlah_subtotal, jproduk_creator, jtunai_nilai, jproduk_diskon, jproduk_cashback FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) LEFT JOIN customer ON(jproduk_cust=cust_id) LEFT JOIN produk ON(dproduk_produk=produk_id) LEFT JOIN satuan ON(dproduk_satuan=satuan_id) LEFT JOIN jual_tunai ON(jtunai_ref=jproduk_nobukti) WHERE dproduk_master='$jproduk_id'";
			$sql="SELECT jproduk_tanggal, cust_no, cust_nama, cust_alamat, jproduk_nobukti, produk_nama, dproduk_jumlah, satuan_nama, dproduk_harga, dproduk_diskon, (dproduk_harga*((100-dproduk_diskon)/100)) AS jumlah_subtotal, jproduk_creator, jproduk_diskon, jproduk_cashback, jproduk_bayar FROM detail_jual_produk LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) LEFT JOIN customer ON(jproduk_cust=cust_id) LEFT JOIN produk ON(dproduk_produk=produk_id) LEFT JOIN satuan ON(dproduk_satuan=satuan_id) WHERE dproduk_master='$jproduk_id' ORDER BY dproduk_diskon ASC";
			$result = $this->db->query($sql);
			return $result;
		}
		
		function cara_bayar($jproduk_id){
			$sql="SELECT jproduk_nobukti, jproduk_cara FROM master_jual_produk WHERE jproduk_id='$jproduk_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jproduk_cara !== NULL || $record->jproduk_cara !== '')){
					if($record->jproduk_cara == 'tunai'){
						$sql="SELECT jproduk_nobukti, jproduk_cara, jtunai_nilai AS bayar_nilai FROM master_jual_produk LEFT JOIN jual_tunai ON(jtunai_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara == 'kwitansi'){
						$sql="SELECT jproduk_nobukti, jproduk_cara, jkwitansi_nilai AS bayar_nilai FROM master_jual_produk LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara == 'card'){
						$sql="SELECT jproduk_nobukti, jproduk_cara, jcard_nilai AS bayar_nilai FROM master_jual_produk LEFT JOIN jual_card ON(jcard_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara == 'cek/giro'){
						$sql="SELECT jproduk_nobukti, jproduk_cara, jcek_nilai AS bayar_nilai FROM master_jual_produk LEFT JOIN jual_cek ON(jcek_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara == 'transfer'){
						$sql="SELECT jproduk_nobukti, jproduk_cara, jtransfer_nilai AS bayar_nilai FROM master_jual_produk LEFT JOIN jual_transfer ON(jtransfer_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara == 'voucher'){
						$sql="SELECT jproduk_nobukti, jproduk_cara, tvoucher_nilai AS bayar_nilai FROM master_jual_produk LEFT JOIN voucher_terima ON(tvoucher_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}
				}else{
					return '';
				}
			}else{
				return '';
			}
		}
		
		function cara_bayar2($jproduk_id){
			$sql="SELECT jproduk_nobukti, jproduk_cara2 FROM master_jual_produk WHERE jproduk_id='$jproduk_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jproduk_cara2 !== NULL || $record->jproduk_cara2 !== '')){
					if($record->jproduk_cara2 == 'tunai'){
						$sql="SELECT jproduk_nobukti, jproduk_cara2, jtunai_nilai AS bayar2_nilai FROM master_jual_produk LEFT JOIN jual_tunai ON(jtunai_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jproduk_cara2 == 'kwitansi'){
						$sql="SELECT jproduk_nobukti, jproduk_cara2, jkwitansi_nilai AS bayar2_nilai FROM master_jual_produk LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jproduk_cara2 == 'card'){
						$sql="SELECT jproduk_nobukti, jproduk_cara2, jcard_nilai AS bayar2_nilai FROM master_jual_produk LEFT JOIN jual_card ON(jcard_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jproduk_cara2 == 'cek/giro'){
						$sql="SELECT jproduk_nobukti, jproduk_cara2, jcek_nilai AS bayar2_nilai FROM master_jual_produk LEFT JOIN jual_cek ON(jcek_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jproduk_cara2 == 'transfer'){
						$sql="SELECT jproduk_nobukti, jproduk_cara2, jtransfer_nilai AS bayar2_nilai FROM master_jual_produk LEFT JOIN jual_transfer ON(jtransfer_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jproduk_cara2 == 'voucher'){
						$sql="SELECT jproduk_nobukti, jproduk_cara2, tvoucher_nilai AS bayar2_nilai FROM master_jual_produk LEFT JOIN voucher_terima ON(tvoucher_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}
				}else{
					return NULL;
				}
			}else{
				return NULL;
			}
		}
		
		function cara_bayar3($jproduk_id){
			$sql="SELECT jproduk_nobukti, jproduk_cara3 FROM master_jual_produk WHERE jproduk_id='$jproduk_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jproduk_cara3 !== NULL || $record->jproduk_cara3 !== '')){
					if($record->jproduk_cara3 == 'tunai'){
						$sql="SELECT jproduk_nobukti, jproduk_cara3, jtunai_nilai AS bayar3_nilai FROM master_jual_produk LEFT JOIN jual_tunai ON(jtunai_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara3 == 'kwitansi'){
						$sql="SELECT jproduk_nobukti, jproduk_cara3, jkwitansi_nilai AS bayar3_nilai FROM master_jual_produk LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara3 == 'card'){
						$sql="SELECT jproduk_nobukti, jproduk_cara3, jcard_nilai AS bayar3_nilai FROM master_jual_produk LEFT JOIN jual_card ON(jcard_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara3 == 'cek/giro'){
						$sql="SELECT jproduk_nobukti, jproduk_cara3, jcek_nilai AS bayar3_nilai FROM master_jual_produk LEFT JOIN jual_cek ON(jcek_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara3 == 'transfer'){
						$sql="SELECT jproduk_nobukti, jproduk_cara3, jtransfer_nilai AS bayar3_nilai FROM master_jual_produk LEFT JOIN jual_transfer ON(jtransfer_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jproduk_cara3 == 'voucher'){
						$sql="SELECT jproduk_nobukti, jproduk_cara3, tvoucher_nilai AS bayar3_nilai FROM master_jual_produk LEFT JOIN voucher_terima ON(tvoucher_ref=jproduk_nobukti) WHERE jproduk_id='$jproduk_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}
				}else{
					return '';
				}
			}else{
				return '';
			}
		}
		
		function iklan(){
			$sql="SELECT * from iklan_today";
			$result = $this->db->query($sql);
			return $result;
		}
		
		
		
}
?>