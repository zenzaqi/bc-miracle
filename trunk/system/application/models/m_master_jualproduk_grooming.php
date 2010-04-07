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

class M_master_jualproduk_grooming extends Model{
		
		//constructor
		function M_master_jualproduk_grooming() {
			parent::Model();
		}
		
		
		
			function get_allkaryawan_list($query,$start,$end){
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
		
	
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal";break;
				case "Karyawan": $order_by=" ORDER BY karyawan_id";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti";break;
				case "Produk": $order_by=" ORDER BY produk_kode";break;
				case "Sales": $order_by=" ORDER BY sales";break;
				case "Jenis Diskon": $order_by=" ORDER BY diskon_jenis";break;
				default: $order_by=" ORDER BY no_bukti";break;
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
					$sql="SELECT * FROM vu_detail_jualproduk_grooming ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_jualproduk_grooming WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_jualproduk_grooming WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}
			
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
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jualproduk_grooming";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jualproduk_grooming WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jualproduk_grooming WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jualproduk_grooming";
				else if($periode=='bulan')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jualproduk_grooming WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jualproduk_grooming WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jualproduk_grooming";
				else if($periode=='bulan')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jualproduk_grooming WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jualproduk_grooming WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
		
		function get_produk_list($query,$start,$end){
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT dpgrooming_produk FROM vu_detail_jualproduk_grooming WHERE dpgrooming_master='$query'";
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
					
					$filter.="OR produk_id='".$row_dproduk->dpgrooming_produk."' ";
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
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga
			FROM satuan
			LEFT JOIN satuan_konversi ON(konversi_satuan=satuan_id)
			LEFT JOIN produk ON(konversi_produk=produk_id)
			LEFT JOIN detail_jualproduk_grooming ON(dpgrooming_produk=produk_id)
			LEFT JOIN master_jualproduk_grooming ON(dpgrooming_master=jpgrooming_id)
			WHERE jpgrooming_id='$djproduk_id'";
		
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
	
	function get_satuan_byproduk_list($jpgrooming_id, $produk_id){
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
		}elseif($jpgrooming_id!=0 && is_numeric($jpgrooming_id)==true){
			$sql="SELECT satuan_id,satuan_nama,konversi_nilai,satuan_kode,konversi_default,produk_harga FROM produk,satuan_konversi,satuan WHERE produk_id=konversi_produk AND konversi_satuan=satuan_id AND produk_id='$jpgrooming_id'";
			if($jpgrooming_id==0)
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
		
		function get_konversi_list($dpgrooming_produk_id){
			$query = "SELECT * FROM satuan_konversi WHERE konversi_produk='$dpgrooming_produk_id'";
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
		function detail_detail_jpgrooming_list($master_id,$query,$start,$end) {
			//$query="SELECT *,konversi_nilai FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dpgrooming_produk=konversi_produk AND dpgrooming_satuan=konversi_satuan) WHERE dpgrooming_master='".$master_id."'";
			
			$query = "SELECT detail_jualproduk_grooming.*,master_jualproduk_grooming.jpgrooming_bayar,master_jualproduk_grooming.jpgrooming_diskon,detail_jualproduk_grooming.konversi_nilai_temp*dpgrooming_harga*dpgrooming_jumlah as dpgrooming_subtotal,detail_jualproduk_grooming.konversi_nilai_temp*dpgrooming_harga*dpgrooming_jumlah*((100-dpgrooming_diskon)/100) as dpgrooming_subtotal_net
			FROM detail_jualproduk_grooming LEFT JOIN satuan_konversi ON(dpgrooming_produk=konversi_produk AND dpgrooming_satuan=konversi_satuan)
			LEFT JOIN master_jualproduk_grooming ON(dpgrooming_master=jpgrooming_id)
			WHERE dpgrooming_master='".$master_id."'";
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
			$query = "SELECT max(jpgrooming_id) AS master_id FROM master_jualproduk_grooming";
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
		
		function catatan_piutang_update($jpgrooming_id){
			if($jpgrooming_id=="" || $jpgrooming_id==NULL){
				$jpgrooming_id=$this->get_master_id();
			}
			
			$sql="SELECT * FROM vu_piutang_jproduk WHERE jpgrooming_id='$jpgrooming_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$lpiutang_faktur=$rs_record["jpgrooming_nobukti"];
				$lpiutang_cust=$rs_record["jpgrooming_karyawan"];
				$lpiutang_faktur_tanggal=$rs_record["jpgrooming_tanggal"];
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
		
		//purge all detail from master
		function detail_detail_jpgrooming_purge($master_id){
			$sql="DELETE from detail_jualproduk_grooming where dpgrooming_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_jpgrooming_insert($dpgrooming_id ,$dpgrooming_master ,$dpgrooming_produk ,$dpgrooming_satuan ,$dpgrooming_jumlah ,$dpgrooming_harga ,$dpgrooming_subtotal_net ,$dpgrooming_diskon,$dpgrooming_diskon_jenis,$dpgrooming_sales,$konversi_nilai_temp ){
			//if master id not capture from view then capture it from max pk from master table
			if($dpgrooming_master=="" || $dpgrooming_master==NULL){
				$dpgrooming_master=$this->get_master_id();
			}
			
			/*$sql="select produk_satuan from produk where produk_id='".$dpgrooming_produk."'";
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				$dpgrooming_satuan=$data->produk_satuan; //satuan_terkecil
			}else
				$dpgrooming_satuan=0;*/
				
			$data = array(
				"dpgrooming_master"=>$dpgrooming_master, 
				"dpgrooming_produk"=>$dpgrooming_produk, 
				"dpgrooming_satuan"=>$dpgrooming_satuan, 
				"dpgrooming_jumlah"=>$dpgrooming_jumlah, 
				"dpgrooming_harga"=>$dpgrooming_harga, 
				"dpgrooming_diskon"=>$dpgrooming_diskon,
				"dpgrooming_diskon_jenis"=>$dpgrooming_diskon_jenis,
				"dpgrooming_sales"=>$dpgrooming_sales,
				"konversi_nilai_temp"=>$konversi_nilai_temp
			);
			$this->db->insert('detail_jualproduk_grooming', $data); 
			if($this->db->affected_rows()){
				//$this->catatan_piutang_update($dpgrooming_master);
				return '1';
			}else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_jpgrooming_list($filter,$start,$end){
			$query = "SELECT jpgrooming_id, jpgrooming_nobukti, karyawan_nama, karyawan_no, jpgrooming_karyawan, jpgrooming_tanggal, jpgrooming_diskon, jpgrooming_cashback, jpgrooming_cara, jpgrooming_cara2, jpgrooming_cara3, jpgrooming_bayar, IF(vu_jpgrooming.jpgrooming_totalbiaya!=0, vu_jpgrooming.jpgrooming_totalbiaya, vu_jpgrooming_totalbiaya.jpgrooming_totalbiaya) AS jpgrooming_totalbiaya, jpgrooming_keterangan, jpgrooming_creator, jpgrooming_date_create, jpgrooming_update, jpgrooming_date_update, jpgrooming_revised
			FROM vu_jpgrooming
			LEFT JOIN vu_jpgrooming_totalbiaya ON(vu_jpgrooming_totalbiaya.dpgrooming_master=vu_jpgrooming.jpgrooming_id)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpgrooming_id LIKE '%".addslashes($filter)."%' OR jpgrooming_nobukti LIKE '%".addslashes($filter)."%' OR jpgrooming_karyawan LIKE '%".addslashes($filter)."%' OR jpgrooming_tanggal LIKE '%".addslashes($filter)."%' OR jpgrooming_diskon LIKE '%".addslashes($filter)."%' OR jpgrooming_cara LIKE '%".addslashes($filter)."%' OR jpgroomgin_cara2 LIKE '%".addslashes($filter)."%' OR jpgrooming_cara3 LIKE '%".addslashes($filter)."%' OR jpgrooming_keterangan LIKE '%".addslashes($filter)."%' )";
			}
			$query .= " ORDER BY jpgrooming_nobukti DESC";
			$query_nbrows="SELECT jpgrooming_id FROM master_jualproduk_grooming";
			
			$result = $this->db->query($query_nbrows);
			$nbrows = $result->num_rows();
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
		function master_jpgrooming_update($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_cara2 ,$jpgrooming_cara3 ,$jpgrooming_keterangan , $jpgrooming_cashback, $jpgrooming_tunai_nilai, $jpgrooming_tunai_nilai2, $jpgrooming_tunai_nilai3, $jpgrooming_voucher_no, $jpgrooming_voucher_cashback, $jpgrooming_voucher_no2, $jpgrooming_voucher_cashback2, $jpgrooming_voucher_no3, $jpgrooming_voucher_cashback3, $jpgrooming_bayar, $jpgrooming_subtotal, $jpgrooming_total, $jpgrooming_hutang, $jpgrooming_kwitansi_no, $jpgrooming_kwitansi_nama, $jpgrooming_kwitansi_nilai, $jpgrooming_kwitansi_no2, $jpgrooming_kwitansi_nama2, $jpgrooming_kwitansi_nilai2, $jpgrooming_kwitansi_no3, $jpgrooming_kwitansi_nama3, $jpgrooming_kwitansi_nilai3, $jpgrooming_card_nama, $jpgrooming_card_edc, $jpgrooming_card_no, $jpgrooming_card_nilai, $jpgrooming_card_nama2, $jpgrooming_card_edc2, $jpgrooming_card_no2, $jpgrooming_card_nilai2, $jpgrooming_card_nama3, $jpgrooming_card_edc3, $jpgrooming_card_no3, $jpgrooming_card_nilai3, $jpgrooming_cek_nama, $jpgrooming_cek_no, $jpgrooming_cek_valid, $jpgrooming_cek_bank, $jpgrooming_cek_nilai, $jpgrooming_cek_nama2, $jpgrooming_cek_no2, $jpgrooming_cek_valid2, $jpgrooming_cek_bank2, $jpgrooming_cek_nilai2, $jpgrooming_cek_nama3, $jpgrooming_cek_no3, $jpgrooming_cek_valid3, $jpgrooming_cek_bank3, $jpgrooming_cek_nilai3, $jpgrooming_transfer_bank, $jpgrooming_transfer_nama, $jpgrooming_transfer_nilai, $jpgrooming_transfer_bank2, $jpgrooming_transfer_nama2, $jpgrooming_transfer_nilai2, $jpgrooming_transfer_bank3, $jpgrooming_transfer_nama3, $jpgrooming_transfer_nilai3){
			$sql="SELECT jpgrooming_cara, jpgrooming_cara2, jpgrooming_cara3 FROM master_jualproduk_grooming WHERE jpgrooming_id='$jpgrooming_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$jpgrooming_cara_awal=$rs_record["jpgrooming_cara"];
				$jpgrooming_cara2_awal=$rs_record["jpgrooming_cara2"];
				$jpgrooming_cara3_awal=$rs_record["jpgrooming_cara3"];
				if($jpgrooming_cara_awal<>$jpgrooming_cara){
					if($jpgrooming_cara_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
				}
				
				if($jpgrooming_cara2_awal<>$jpgrooming_cara2){
					if($jpgrooming_cara2_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara2_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara2_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara2_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara2_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
				}
				
				if($jpgrooming_cara3_awal<>$jpgrooming_cara3){
					if($jpgrooming_cara3_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara3_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara3_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara3_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
					if($jpgrooming_cara3_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jpgrooming_nobukti."'";
						$this->db->query($sql);
					}
				}
			}
			$data = array(
				"jpgrooming_id"=>$jpgrooming_id, 
				"jpgrooming_nobukti"=>$jpgrooming_nobukti, 
				"jpgrooming_tanggal"=>$jpgrooming_tanggal, 
				"jpgrooming_diskon"=>$jpgrooming_diskon,
				"jpgrooming_cashback"=>$jpgrooming_cashback,
				"jpgrooming_bayar"=>$jpgrooming_bayar,
				"jpgrooming_totalbiaya"=>$jpgrooming_total,
				"jpgrooming_cara"=>$jpgrooming_cara, 
				//"jpgrooming_cara2"=>$jpgrooming_cara2, 
				//"jpgrooming_cara3"=>$jpgrooming_cara3,
				"jpgrooming_keterangan"=>$jpgrooming_keterangan 
			);
			if($jpgrooming_cara2!=null)
				$data["jpgrooming_cara2"]=$jpgrooming_cara2;
			if($jpgrooming_cara3!=null)
				$data["jpgrooming_cara3"]=$jpgrooming_cara3;
			
			$sql="select karyawan_id from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jpgrooming_karyawan"]=$jpgrooming_karyawan;
				
			$this->db->where('jpgrooming_id', $jpgrooming_id);
			$this->db->update('master_jualproduk_grooming', $data);
			if($this->db->affected_rows() || $this->db->affected_rows()==0){
				
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);*/
				
				if($jpgrooming_cara!=null || $jpgrooming_cara!=''){
					//kwitansi
					if($jpgrooming_cara=='kwitansi'){
						if($jpgrooming_kwitansi_nama=="" || $jpgrooming_kwitansi_nama==NULL){
							if(is_int($jpgrooming_kwitansi_nama)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_kwitansi_nama=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_kwitansi_nama=$jpgrooming_karyawan;
							}
						}
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jpgrooming_kwitansi_no,
								"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai
							);
							$this->db->where('jkwitansi_ref', $jpgrooming_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jpgrooming_nobukti,
								"jkwitansi_master"=>$jpgrooming_kwitansi_no,
								"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai,
								"jkwitansi_transaksi"=>"jual_produk"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jpgrooming_cara=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jpgrooming_card_nama,
								"jcard_edc"=>$jpgrooming_card_edc,
								"jcard_no"=>$jpgrooming_card_no,
								"jcard_nilai"=>$jpgrooming_card_nilai
								);
							$this->db->where('jcard_ref', $jpgrooming_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jpgrooming_nobukti,
								"jcard_nama"=>$jpgrooming_card_nama,
								"jcard_edc"=>$jpgrooming_card_edc,
								"jcard_no"=>$jpgrooming_card_no,
								"jcard_nilai"=>$jpgrooming_card_nilai,
								"jcard_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_card', $data);
						}
					
					}else if($jpgrooming_cara=='cek/giro'){
						
						if($jpgrooming_cek_nama=="" || $jpgrooming_cek_nama==NULL){
							if(is_int($jpgrooming_cek_nama)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_cek_nama=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_cek_nama=$jpgrooming_karyawan;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jpgrooming_cek_nama,
								"jcek_no"=>$jpgrooming_cek_no,
								"jcek_valid"=>$jpgrooming_cek_valid,
								"jcek_bank"=>$jpgrooming_cek_bank,
								"jcek_nilai"=>$jpgrooming_cek_nilai,
								);
							$this->db->where('jcek_ref', $jpgrooming_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jpgrooming_nobukti,
								"jcek_nama"=>$jpgrooming_cek_nama,
								"jcek_no"=>$jpgrooming_cek_no,
								"jcek_valid"=>$jpgrooming_cek_valid,
								"jcek_bank"=>$jpgrooming_cek_bank,
								"jcek_nilai"=>$jpgrooming_cek_nilai,
								"jcek_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_cek', $data);
						}
						 
					}else if($jpgrooming_cara=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jpgrooming_transfer_bank,
								"jtransfer_nama"=>$jpgrooming_transfer_nama,
								"jtransfer_nilai"=>$jpgrooming_transfer_nilai
								);
							$this->db->where('jtransfer_ref', $jpgrooming_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jpgrooming_nobukti,
								"jtransfer_bank"=>$jpgrooming_transfer_bank,
								"jtransfer_nama"=>$jpgrooming_transfer_nama,
								"jtransfer_nilai"=>$jpgrooming_transfer_nilai,
								"jtransfer_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_transfer', $data);
						}
					}else if($jpgrooming_cara=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jpgrooming_tunai_nilai
								);
							$this->db->where('jtunai_ref', $jpgrooming_nobukti);
							$this->db->update('jual_tunai', $data);
						}else{
							$data=array(
								"jtunai_nilai"=>$jpgrooming_tunai_nilai,
								"jtunai_ref"=>$jpgrooming_nobukti,
								"jtunai_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jpgrooming_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpgrooming_voucher_no,
								"tvoucher_nilai"=>$jpgrooming_voucher_cashback
								);
							$this->db->where('tvoucher_ref', $jpgrooming_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpgrooming_voucher_no,
								"tvoucher_ref"=>$jpgrooming_nobukti,
								"tvoucher_nilai"=>$jpgrooming_voucher_cashback,
								"tvoucher_transaksi"=>"jual_produk"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($jpgrooming_cara2!=null || $jpgrooming_cara2!=''){
					//kwitansi
					if($jpgrooming_cara2=='kwitansi'){
						if($jpgrooming_kwitansi_nama2=="" || $jpgrooming_kwitansi_nama2==NULL){
							if(is_int($jpgrooming_kwitansi_nama2)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_kwitansi_nama2=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_kwitansi_nama2=$jpgrooming_karyawan;
							}
						}
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jpgrooming_kwitansi_no2,
								"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai2
							);
							$this->db->where('jkwitansi_ref', $jpgrooming_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jpgrooming_nobukti,
								"jkwitansi_master"=>$jpgrooming_kwitansi_no2,
								"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai2,
								"jkwitansi_transaksi"=>"jual_produk"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jpgrooming_cara2=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jpgrooming_card_nama2,
								"jcard_edc"=>$jpgrooming_card_edc2,
								"jcard_no"=>$jpgrooming_card_no2,
								"jcard_nilai"=>$jpgrooming_card_nilai2
								);
							$this->db->where('jcard_ref', $jpgrooming_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jpgrooming_nobukti,
								"jcard_nama"=>$jpgrooming_card_nama2,
								"jcard_edc"=>$jpgrooming_card_edc2,
								"jcard_no"=>$jpgrooming_card_no2,
								"jcard_nilai"=>$jpgrooming_card_nilai2,
								"jcard_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_card', $data);
						}
					
					}else if($jpgrooming_cara2=='cek/giro'){
						
						if($jpgrooming_cek_nama2=="" || $jpgrooming_cek_nama2==NULL){
							if(is_int($jpgrooming_cek_nama2)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_cek_nama2=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_cek_nama2=$jpgrooming_karyawan;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jpgrooming_cek_nama2,
								"jcek_no"=>$jpgrooming_cek_no2,
								"jcek_valid"=>$jpgrooming_cek_valid2,
								"jcek_bank"=>$jpgrooming_cek_bank2,
								"jcek_nilai"=>$jpgrooming_cek_nilai2
								);
							$this->db->where('jcek_ref', $jpgrooming_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jpgrooming_nobukti,
								"jcek_nama"=>$jpgrooming_cek_nama2,
								"jcek_no"=>$jpgrooming_cek_no2,
								"jcek_valid"=>$jpgrooming_cek_valid2,
								"jcek_bank"=>$jpgrooming_cek_bank2,
								"jcek_nilai"=>$jpgrooming_cek_nilai2,
								"jcek_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_cek', $data);
						}
						 
					}else if($jpgrooming_cara2=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jpgrooming_transfer_bank2,
								"jtransfer_nama"=>$jpgrooming_transfer_nama2,
								"jtransfer_nilai"=>$jpgrooming_transfer_nilai2
								);
							$this->db->where('jtransfer_ref', $jpgrooming_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jpgrooming_nobukti,
								"jtransfer_bank"=>$jpgrooming_transfer_bank2,
								"jtransfer_nama"=>$jpgrooming_transfer_nama2,
								"jtransfer_nilai"=>$jpgrooming_transfer_nilai2,
								"jtransfer_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_transfer', $data);
						}
						 
					}else if($jpgrooming_cara2=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jpgrooming_tunai_nilai2
								);
							$this->db->where('jtunai_ref', $jpgrooming_nobukti);
							$this->db->update('jual_tunai', $data); 
						}else{
							$data=array(
								"jtunai_ref"=>$jpgrooming_nobukti,
								"jtunai_nilai"=>$jpgrooming_tunai_nilai2,
								"jtunai_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jpgrooming_cara2=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpgrooming_voucher_no2,
								"tvoucher_nilai"=>$jpgrooming_voucher_cashback2
								);
							$this->db->where('tvoucher_ref', $jpgrooming_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no2'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpgrooming_voucher_no2,
								"tvoucher_ref"=>$jpgrooming_nobukti,
								"tvoucher_nilai"=>$jpgrooming_voucher_cashback2,
								"tvoucher_transaksi"=>"jual_produk"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($jpgrooming_cara3!=null || $jpgrooming_cara3!=''){
					//kwitansi
					if($jpgrooming_cara3=='kwitansi'){
						if($jpgrooming_kwitansi_nama3=="" || $jpgrooming_kwitansi_nama3==NULL){
							if(is_int($jpgrooming_kwitansi_nama3)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_kwitansi_nama3=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_kwitansi_nama3=$jpgrooming_karyawan;
							}
						}
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jpgrooming_kwitansi_no3,
								"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai3
							);
							$this->db->where('jkwitansi_ref', $jpgrooming_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jpgrooming_nobukti,
								"jkwitansi_master"=>$jpgrooming_kwitansi_no3,
								"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai3,
								"jkwitansi_transaksi"=>"jual_produk"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jpgrooming_cara3=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jpgrooming_card_nama3,
								"jcard_edc"=>$jpgrooming_card_edc3,
								"jcard_no"=>$jpgrooming_card_no3,
								"jcard_nilai"=>$jpgrooming_card_nilai3
								);
							$this->db->where('jcard_ref', $jpgrooming_nobukti);
							$this->db->update('jual_card', $data); 
						}else{
							$data=array(
								"jcard_ref"=>$jpgrooming_nobukti,
								"jcard_nama"=>$jpgrooming_card_nama3,
								"jcard_edc"=>$jpgrooming_card_edc3,
								"jcard_no"=>$jpgrooming_card_no3,
								"jcard_nilai"=>$jpgrooming_card_nilai3,
								"jcard_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_card', $data); 
						}
					
					}else if($jpgrooming_cara3=='cek/giro'){
						
						if($jpgrooming_cek_nama3=="" || $jpgrooming_cek_nama3==NULL){
							if(is_int($jpgrooming_cek_nama3)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_cek_nama3=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_cek_nama3=$jpgrooming_karyawan;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jpgrooming_cek_nama3,
								"jcek_no"=>$jpgrooming_cek_no3,
								"jcek_valid"=>$jpgrooming_cek_valid3,
								"jcek_bank"=>$jpgrooming_cek_bank3,
								"jcek_nilai"=>$jpgrooming_cek_nilai3
								);
							$this->db->where('jcek_ref', $jpgrooming_nobukti);
							$this->db->update('jual_cek', $data); 
						}else{
							$data=array(
								"jcek_ref"=>$jpgrooming_nobukti,
								"jcek_nama"=>$jpgrooming_cek_nama3,
								"jcek_no"=>$jpgrooming_cek_no3,
								"jcek_valid"=>$jpgrooming_cek_valid3,
								"jcek_bank"=>$jpgrooming_cek_bank3,
								"jcek_nilai"=>$jpgrooming_cek_nilai3,
								"jcek_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_cek', $data); 
						}
						
					}else if($jpgrooming_cara3=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jpgrooming_transfer_bank3,
								"jtransfer_nama"=>$jpgrooming_transfer_nama3,
								"jtransfer_nilai"=>$jpgrooming_transfer_nilai3
								);
							$this->db->where('jtransfer_ref', $jpgrooming_nobukti);
							$this->db->update('jual_transfer', $data); 
						}else{
							$data=array(
								"jtransfer_ref"=>$jpgrooming_nobukti,
								"jtransfer_bank"=>$jpgrooming_transfer_bank3,
								"jtransfer_nama"=>$jpgrooming_transfer_nama3,
								"jtransfer_nilai"=>$jpgrooming_transfer_nilai3,
								"jtransfer_transaksi"=>"jual_produk"
								);
							$this->db->insert('jual_transfer', $data);
						}
						
					}else if($jpgrooming_cara3=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jpgrooming_tunai_nilai3
								);
							$this->db->where('jtunai_ref', $jpgrooming_nobukti);
							$this->db->update('jual_tunai', $data); 
						}else{
							$data=array(
								"jtunai_ref"=>$jpgrooming_nobukti,
								"jtunai_nilai"=>$jpgrooming_tunai_nilai3,
								"jtunai_transaksi"=>"jual_produk"
								);
							$this->db->where('jtunai_ref', $jpgrooming_nobukti);
							$this->db->update('jual_tunai', $data);
						}
					}else if($jpgrooming_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jpgrooming_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpgrooming_voucher_no3,
								"tvoucher_nilai"=>$jpgrooming_voucher_cashback3
								);
							$this->db->where('tvoucher_ref', $jpgrooming_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no3'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpgrooming_voucher_no3,
								"tvoucher_ref"=>$jpgrooming_nobukti,
								"tvoucher_nilai"=>$jpgrooming_voucher_cashback3,
								"tvoucher_transaksi"=>"jual_produk"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				
				return '1';
			}
			else
				return '0';
		}
		
		//function for create new record
		function master_jpgrooming_create($jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_cara2 ,$jpgrooming_cara3 ,$jpgrooming_keterangan , $jpgrooming_cashback, $jpgrooming_tunai_nilai, $jpgrooming_tunai_nilai2, $jpgrooming_tunai_nilai3, $jpgrooming_voucher_no, $jpgrooming_voucher_cashback, $jpgrooming_voucher_no2, $jpgrooming_voucher_cashback2, $jpgrooming_voucher_no3, $jpgrooming_voucher_cashback3, $jpgrooming_bayar, $jpgrooming_subtotal, $jpgrooming_total, $jpgrooming_hutang, $jpgrooming_kwitansi_no, $jpgrooming_kwitansi_nama, $jpgrooming_kwitansi_nilai, $jpgrooming_kwitansi_no2, $jpgrooming_kwitansi_nama2, $jpgrooming_kwitansi_nilai2, $jpgrooming_kwitansi_no3, $jpgrooming_kwitansi_nama3, $jpgrooming_kwitansi_nilai3, $jpgrooming_card_nama, $jpgrooming_card_edc, $jpgrooming_card_no, $jpgrooming_card_nilai, $jpgrooming_card_nama2, $jpgrooming_card_edc2, $jpgrooming_card_no2, $jpgrooming_card_nilai2, $jpgrooming_card_nama3, $jpgrooming_card_edc3, $jpgrooming_card_no3, $jpgrooming_card_nilai3, $jpgrooming_cek_nama, $jpgrooming_cek_no, $jpgrooming_cek_valid, $jpgrooming_cek_bank, $jpgrooming_cek_nilai, $jpgrooming_cek_nama2, $jpgrooming_cek_no2, $jpgrooming_cek_valid2, $jpgrooming_cek_bank2, $jpgrooming_cek_nilai2, $jpgrooming_cek_nama3, $jpgrooming_cek_no3, $jpgrooming_cek_valid3, $jpgrooming_cek_bank3, $jpgrooming_cek_nilai3, $jpgrooming_transfer_bank, $jpgrooming_transfer_nama, $jpgrooming_transfer_nilai, $jpgrooming_transfer_bank2, $jpgrooming_transfer_nama2, $jpgrooming_transfer_nilai2, $jpgrooming_transfer_bank3, $jpgrooming_transfer_nama3, $jpgrooming_transfer_nilai3){
			
			$pattern="FT/".date("ym")."-";
			$jpgrooming_nobukti=$this->m_public_function->get_kode_1('master_jualproduk_grooming','jpgrooming_nobukti',$pattern,12);
			
			$data = array(
				"jpgrooming_nobukti"=>$jpgrooming_nobukti, 
				"jpgrooming_karyawan"=>$jpgrooming_karyawan, 
				"jpgrooming_tanggal"=>$jpgrooming_tanggal, 
				"jpgrooming_diskon"=>$jpgrooming_diskon, 
				"jpgrooming_cashback"=>$jpgrooming_cashback,
				"jpgrooming_bayar"=>$jpgrooming_bayar,
				"jpgrooming_totalbiaya"=>$jpgrooming_total,
				"jpgrooming_cara"=>$jpgrooming_cara, 
				//"jpgrooming_cara2"=>$jpgrooming_cara2, 
				//"jpgrooming_cara3"=>$jpgrooming_cara3, 
				"jpgrooming_keterangan"=>$jpgrooming_keterangan 
			);
			if($jpgrooming_cara2!=null)
				$data["jpgrooming_cara2"]=$jpgrooming_cara2;
			if($jpgrooming_cara3!=null)
				$data["jpgrooming_cara3"]=$jpgrooming_cara3;
			$this->db->insert('master_jualproduk_grooming', $data); 
			if($this->db->affected_rows()){
				
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jpgrooming_nobukti."'";
				$this->db->query($sql);*/
				
				if($jpgrooming_cara!=null || $jpgrooming_cara!=''){
					//kwitansi
					if($jpgrooming_cara=='kwitansi'){
						if($jpgrooming_kwitansi_nama=="" || $jpgrooming_kwitansi_nama==NULL){
							if(is_int($jpgrooming_kwitansi_nama)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_kwitansi_nama=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_kwitansi_nama=$jpgrooming_karyawan;
							}
						}
						
						$data=array(
							"jkwitansi_master"=>$jpgrooming_kwitansi_no,
							"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai,
							"jkwitansi_ref"=>$jpgrooming_nobukti,
							"jkwitansi_transaksi"=>"jual_produk"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpgrooming_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jpgrooming_card_nama,
							"jcard_edc"=>$jpgrooming_card_edc,
							"jcard_no"=>$jpgrooming_card_no,
							"jcard_nilai"=>$jpgrooming_card_nilai,
							"jcard_ref"=>$jpgrooming_nobukti,
							"jcard_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpgrooming_cara=='cek/giro'){
						
						if($jpgrooming_cek_nama=="" || $jpgrooming_cek_nama==NULL){
							if(is_int($jpgrooming_cek_nama)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_cek_nama=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_cek_nama=$jpgrooming_karyawan;
							}
						}
						$data=array(
							"jcek_nama"=>$jpgrooming_cek_nama,
							"jcek_no"=>$jpgrooming_cek_no,
							"jcek_valid"=>$jpgrooming_cek_valid,
							"jcek_bank"=>$jpgrooming_cek_bank,
							"jcek_nilai"=>$jpgrooming_cek_nilai,
							"jcek_ref"=>$jpgrooming_nobukti,
							"jcek_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpgrooming_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpgrooming_transfer_bank,
							"jtransfer_nama"=>$jpgrooming_transfer_nama,
							"jtransfer_nilai"=>$jpgrooming_transfer_nilai,
							"jtransfer_ref"=>$jpgrooming_nobukti,
							"jtransfer_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpgrooming_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpgrooming_tunai_nilai,
							"jtunai_ref"=>$jpgrooming_nobukti,
							"jtunai_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jpgrooming_cara=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jpgrooming_voucher_no,
							"tvoucher_ref"=>$jpgrooming_nobukti,
							"tvoucher_nilai"=>$jpgrooming_voucher_cashback,
							"tvoucher_transaksi"=>"jual_produk"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				if($jpgrooming_cara2!=null || $jpgrooming_cara2!=''){
					//kwitansi
					if($jpgrooming_cara2=='kwitansi'){
						if($jpgrooming_kwitansi_nama2=="" || $jpgrooming_kwitansi_nama2==NULL){
							if(is_int($jpgrooming_kwitansi_nama2)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_kwitansi_nama2=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_kwitansi_nama2=$jpgrooming_karyawan;
							}
						}
						$data=array(
							"jkwitansi_master"=>$jpgrooming_kwitansi_no2,
							"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai2,
							"jkwitansi_ref"=>$jpgrooming_nobukti,
							"jkwitansi_transaksi"=>"jual_produk"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpgrooming_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jpgrooming_card_nama2,
							"jcard_edc"=>$jpgrooming_card_edc2,
							"jcard_no"=>$jpgrooming_card_no2,
							"jcard_nilai"=>$jpgrooming_card_nilai2,
							"jcard_ref"=>$jpgrooming_nobukti,
							"jcard_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpgrooming_cara2=='cek/giro'){
						
						if($jpgrooming_cek_nama2=="" || $jpgrooming_cek_nama2==NULL){
							if(is_int($jpgrooming_cek_nama2)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_cek_nama2=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_cek_nama2=$jpgrooming_karyawan;
							}
						}
						$data=array(
							"jcek_nama"=>$jpgrooming_cek_nama2,
							"jcek_no"=>$jpgrooming_cek_no2,
							"jcek_valid"=>$jpgrooming_cek_valid2,
							"jcek_bank"=>$jpgrooming_cek_bank2,
							"jcek_nilai"=>$jpgrooming_cek_nilai2,
							"jcek_ref"=>$jpgrooming_nobukti,
							"jcek_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpgrooming_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpgrooming_transfer_bank2,
							"jtransfer_nama"=>$jpgrooming_transfer_nama2,
							"jtransfer_nilai"=>$jpgrooming_transfer_nilai2,
							"jtransfer_ref"=>$jpgrooming_nobukti,
							"jtransfer_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpgrooming_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpgrooming_tunai_nilai2,
							"jtunai_ref"=>$jpgrooming_nobukti,
							"jtunai_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jpgrooming_cara2=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no2'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jpgrooming_voucher_no2,
							"tvoucher_ref"=>$jpgrooming_nobukti,
							"tvoucher_nilai"=>$jpgrooming_voucher_cashback2,
							"tvoucher_transaksi"=>"jual_produk"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				if($jpgrooming_cara3!=null || $jpgrooming_cara3!=''){
					//kwitansi
					if($jpgrooming_cara3=='kwitansi'){
						if($jpgrooming_kwitansi_nama3=="" || $jpgrooming_kwitansi_nama3==NULL){
							if(is_int($jpgrooming_kwitansi_nama3)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_kwitansi_nama3=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_kwitansi_nama3=$jpgrooming_karyawan;
							}
						}
						$data=array(
							"jkwitansi_master"=>$jpgrooming_kwitansi_no3,
							"jkwitansi_nilai"=>$jpgrooming_kwitansi_nilai3,
							"jkwitansi_ref"=>$jpgrooming_nobukti,
							"jkwitansi_transaksi"=>"jual_produk"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpgrooming_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jpgrooming_card_nama3,
							"jcard_edc"=>$jpgrooming_card_edc3,
							"jcard_no"=>$jpgrooming_card_no3,
							"jcard_nilai"=>$jpgrooming_card_nilai3,
							"jcard_ref"=>$jpgrooming_nobukti,
							"jcard_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpgrooming_cara3=='cek/giro'){
						
						if($jpgrooming_cek_nama3=="" || $jpgrooming_cek_nama3==NULL){
							if(is_int($jpgrooming_cek_nama3)){
								$sql="select karyawan_nama from karyawan where karyawan_id='".$jpgrooming_karyawan."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpgrooming_cek_nama3=$data->karyawan_nama;
								}
							}else{
									$jpgrooming_cek_nama3=$jpgrooming_karyawan;
							}
						}
						$data=array(
							"jcek_nama"=>$jpgrooming_cek_nama3,
							"jcek_no"=>$jpgrooming_cek_no3,
							"jcek_valid"=>$jpgrooming_cek_valid3,
							"jcek_bank"=>$jpgrooming_cek_bank3,
							"jcek_nilai"=>$jpgrooming_cek_nilai3,
							"jcek_ref"=>$jpgrooming_nobukti,
							"jcek_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpgrooming_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpgrooming_transfer_bank3,
							"jtransfer_nama"=>$jpgrooming_transfer_nama3,
							"jtransfer_nilai"=>$jpgrooming_transfer_nilai3,
							"jtransfer_ref"=>$jpgrooming_nobukti,
							"jtransfer_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpgrooming_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpgrooming_tunai_nilai3,
							"jtunai_ref"=>$jpgrooming_nobukti,
							"jtunai_transaksi"=>"jual_produk"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jpgrooming_cara3=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpgrooming_voucher_no3'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jpgrooming_voucher_no3,
							"tvoucher_ref"=>$jpgrooming_nobukti,
							"tvoucher_nilai"=>$jpgrooming_voucher_cashback3,
							"tvoucher_transaksi"=>"jual_produk"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				
				return '1';
			}
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_jpgrooming_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_produks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_jualproduk_grooming WHERE jpgrooming_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_jualproduk_grooming WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jpgrooming_id= ".$pkid[$i];
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
		function master_jpgrooming_search($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_keterangan ,$start,$end){
			//full query
			$query="SELECT jpgrooming_id, jpgrooming_nobukti, karyawan_nama, karyawan_no, jpgrooming_cust, jpgrooming_tanggal, jpgrooming_diskon, jpgrooming_cashback, jpgrooming_cara, jpgrooming_cara2, jpgrooming_cara3, jpgrooming_bayar, jpgrooming_totalbiaya, jpgrooming_keterangan, jpgrooming_creator, jpgrooming_date_create, jpgrooming_update, jpgrooming_date_update, jpgrooming_revised FROM vu_jpgrooming";
			
			if($jpgrooming_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_id LIKE '%".$jpgrooming_id."%'";
			};
			if($jpgrooming_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_nobukti LIKE '%".$jpgrooming_nobukti."%'";
			};
			if($jpgrooming_karyawan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_karyawan LIKE '%".$jpgrooming_karyawan."%'";
			};
			if($jpgrooming_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_tanggal LIKE '%".$jpgrooming_tanggal."%'";
			};
			if($jpgrooming_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_diskon LIKE '%".$jpgrooming_diskon."%'";
			};
			if($jpgrooming_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_cara LIKE '%".$jpgrooming_cara."%'";
			};
			if($jpgrooming_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpgrooming_keterangan LIKE '%".$jpgrooming_keterangan."%'";
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
		function master_jpgrooming_print($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jualproduk_grooming";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpgrooming_id LIKE '%".addslashes($filter)."%' OR jpgrooming_nobukti LIKE '%".addslashes($filter)."%' OR jpgrooming_karyawan LIKE '%".addslashes($filter)."%' OR jpgrooming_tanggal LIKE '%".addslashes($filter)."%' OR jpgrooming_diskon LIKE '%".addslashes($filter)."%' OR jpgrooming_cara LIKE '%".addslashes($filter)."%' OR jpgrooming_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jpgrooming_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_id LIKE '%".$jpgrooming_id."%'";
				};
				if($jpgrooming_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_nobukti LIKE '%".$jpgrooming_nobukti."%'";
				};
				if($jpgrooming_karyawan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_karyawan LIKE '%".$jpgrooming_karyawan."%'";
				};
				if($jpgrooming_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_tanggal LIKE '%".$jpgrooming_tanggal."%'";
				};
				if($jpgrooming_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_diskon LIKE '%".$jpgrooming_diskon."%'";
				};
				if($jpgrooming_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_cara LIKE '%".$jpgrooming_cara."%'";
				};
				if($jpgrooming_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_keterangan LIKE '%".$jpgrooming_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_jpgrooming_export_excel($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jualproduk_grooming";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpgrooming_id LIKE '%".addslashes($filter)."%' OR jpgrooming_nobukti LIKE '%".addslashes($filter)."%' OR jpgrooming_karyawan LIKE '%".addslashes($filter)."%' OR jpgrooming_tanggal LIKE '%".addslashes($filter)."%' OR jpgrooming_diskon LIKE '%".addslashes($filter)."%' OR jpgrooming_cara LIKE '%".addslashes($filter)."%' OR jpgrooming_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jpgrooming_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_id LIKE '%".$jpgrooming_id."%'";
				};
				if($jpgrooming_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_nobukti LIKE '%".$jpgrooming_nobukti."%'";
				};
				if($jpgrooming_karyawan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_karyawan LIKE '%".$jpgrooming_karyawan."%'";
				};
				if($jpgrooming_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_tanggal LIKE '%".$jpgrooming_tanggal."%'";
				};
				if($jpgrooming_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_diskon LIKE '%".$jpgrooming_diskon."%'";
				};
				if($jpgrooming_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_cara LIKE '%".$jpgrooming_cara."%'";
				};
				if($jpgrooming_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpgrooming_keterangan LIKE '%".$jpgrooming_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>