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
				case "Customer": $order_by=" ORDER BY cust_id";break;
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
					$sql="SELECT * FROM vu_detail_jual_produk ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_jual_produk WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
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
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
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
			
			$query = "SELECT detail_jual_produk.*,master_jual_produk.jproduk_bayar,master_jual_produk.jproduk_diskon,detail_jual_produk.konversi_nilai_temp*dproduk_harga*dproduk_jumlah as dproduk_subtotal,detail_jual_produk.konversi_nilai_temp*dproduk_harga*dproduk_jumlah*((100-dproduk_diskon)/100) as dproduk_subtotal_net FROM detail_jual_produk LEFT JOIN satuan_konversi ON(dproduk_produk=konversi_produk AND dproduk_satuan=konversi_satuan) LEFT JOIN master_jual_produk ON(dproduk_master=jproduk_id) WHERE dproduk_master='".$master_id."'";
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
			$query = "SELECT max(jproduk_id) AS master_id FROM master_jual_produk";
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
		
		function catatan_piutang_update($jproduk_id){
			if($jproduk_id=="" || $jproduk_id==NULL){
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
		
		//purge all detail from master
		function detail_detail_jual_produk_purge($master_id){
			$sql="DELETE from detail_jual_produk where dproduk_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_jual_produk_insert($dproduk_id ,$dproduk_master ,$dproduk_produk ,$dproduk_satuan ,$dproduk_jumlah ,$dproduk_harga ,$dproduk_subtotal_net ,$dproduk_diskon,$dproduk_diskon_jenis,$dproduk_sales,$konversi_nilai_temp ){
			//if master id not capture from view then capture it from max pk from master table
			if($dproduk_master=="" || $dproduk_master==NULL){
				$dproduk_master=$this->get_master_id();
			}
			
			/*$sql="select produk_satuan from produk where produk_id='".$dproduk_produk."'";
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				$dproduk_satuan=$data->produk_satuan; //satuan_terkecil
			}else
				$dproduk_satuan=0;*/
				
			$data = array(
				"dproduk_master"=>$dproduk_master, 
				"dproduk_produk"=>$dproduk_produk, 
				"dproduk_satuan"=>$dproduk_satuan, 
				"dproduk_jumlah"=>$dproduk_jumlah, 
				"dproduk_harga"=>$dproduk_harga, 
				"dproduk_diskon"=>$dproduk_diskon,
				"dproduk_diskon_jenis"=>$dproduk_diskon_jenis,
				"dproduk_sales"=>$dproduk_sales,
				"konversi_nilai_temp"=>$konversi_nilai_temp
			);
			$this->db->insert('detail_jual_produk', $data); 
			if($this->db->affected_rows()){
				//$this->catatan_piutang_update($dproduk_master);
				return '1';
			}else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_jual_produk_list($filter,$start,$end){
			$query = "SELECT jproduk_id, jproduk_nobukti, cust_nama, cust_no, cust_member, jproduk_cust, jproduk_tanggal, jproduk_diskon, jproduk_cashback, jproduk_cara, jproduk_cara2, jproduk_cara3, jproduk_bayar, jproduk_keterangan, jproduk_creator, jproduk_date_create, jproduk_update, jproduk_date_update, jproduk_revised FROM (((((master_jual_produk LEFT JOIN customer ON(master_jual_produk.jproduk_cust=customer.cust_id)) LEFT JOIN jual_transfer ON(master_jual_produk.jproduk_nobukti=jual_transfer.jtransfer_ref)) LEFT JOIN jual_kwitansi ON(master_jual_produk.jproduk_nobukti=jual_kwitansi.jkwitansi_ref)) LEFT JOIN jual_card ON(master_jual_produk.jproduk_nobukti=jual_card.jcard_ref)) LEFT JOIN jual_cek ON(master_jual_produk.jproduk_nobukti=jual_cek.jcek_ref))";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_id LIKE '%".addslashes($filter)."%' OR jproduk_nobukti LIKE '%".addslashes($filter)."%' OR jproduk_cust LIKE '%".addslashes($filter)."%' OR jproduk_tanggal LIKE '%".addslashes($filter)."%' OR jproduk_diskon LIKE '%".addslashes($filter)."%' OR jproduk_cara LIKE '%".addslashes($filter)."%' OR jproduk_cara2 LIKE '%".addslashes($filter)."%' OR jproduk_cara3 LIKE '%".addslashes($filter)."%' OR jproduk_keterangan LIKE '%".addslashes($filter)."%' )";
			}
			$query .= " ORDER BY jproduk_nobukti DESC";
			
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
		function master_jual_produk_update($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_tunai_nilai, $jproduk_tunai_nilai2, $jproduk_tunai_nilai3, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_subtotal, $jproduk_hutang, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_no, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_no2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_no3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nama, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nama2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nama3, $jproduk_transfer_nilai3){
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
				}
			}
			$data = array(
				"jproduk_id"=>$jproduk_id, 
				"jproduk_nobukti"=>$jproduk_nobukti, 
				"jproduk_tanggal"=>$jproduk_tanggal, 
				"jproduk_diskon"=>$jproduk_diskon,
				"jproduk_cashback"=>$jproduk_cashback,
				"jproduk_bayar"=>$jproduk_bayar,
				"jproduk_cara"=>$jproduk_cara, 
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
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai
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
								"jcard_nilai"=>$jproduk_card_nilai
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
								"jcek_nilai"=>$jproduk_cek_nilai
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
								"jcek_nilai"=>$jproduk_cek_nilai
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
								"jtransfer_nilai"=>$jproduk_transfer_nilai
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
								"jtunai_ref"=>$jproduk_nobukti
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jproduk_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no
								);
							$this->db->where('tvoucher_ref', $jproduk_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no,
								"tvoucher_ref"=>$jproduk_nobukti
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
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai2
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
								"jcard_nilai"=>$jproduk_card_nilai2
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
								"jcek_nilai"=>$jproduk_cek_nilai
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
								"jcek_nilai"=>$jproduk_cek_nilai
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
								"jtransfer_nilai"=>$jproduk_transfer_nilai2
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
								"jtunai_nilai"=>$jproduk_tunai_nilai2
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jproduk_cara2=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no2
								);
							$this->db->where('tvoucher_ref', $jproduk_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no2,
								"tvoucher_ref"=>$jproduk_nobukti
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
								"jkwitansi_nilai"=>$jproduk_kwitansi_nilai3
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
								"jcard_nilai"=>$jproduk_hutang
								);
							$this->db->where('jcard_ref', $jproduk_nobukti);
							$this->db->update('jual_card', $data); 
						}else{
							$data=array(
								"jcard_ref"=>$jproduk_nobukti,
								"jcard_nama"=>$jproduk_card_nama3,
								"jcard_edc"=>$jproduk_card_edc3,
								"jcard_no"=>$jproduk_card_no3,
								"jcard_nilai"=>$jproduk_hutang
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
								"jcek_nilai"=>$jproduk_cek_nilai
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
								"jcek_nilai"=>$jproduk_cek_nilai
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
								"jtransfer_nilai"=>$jproduk_transfer_nilai3
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
								"jtunai_nilai"=>$jproduk_tunai_nilai3
								);
							$this->db->where('jtunai_ref', $jproduk_nobukti);
							$this->db->update('jual_tunai', $data);
						}
					}else if($jproduk_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jproduk_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no3
								);
							$this->db->where('tvoucher_ref', $jproduk_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							$data=array(
								"tvoucher_novoucher"=>$jproduk_voucher_no3,
								"tvoucher_ref"=>$jproduk_nobukti
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
		function master_jual_produk_create($jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_tunai_nilai, $jproduk_tunai_nilai2, $jproduk_tunai_nilai3, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_subtotal, $jproduk_hutang, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_no, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_no2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_no3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nama, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nama2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nama3, $jproduk_transfer_nilai3){
			
			$pattern="FT/".date("ym")."-";
			$jproduk_nobukti=$this->m_public_function->get_kode_1('master_jual_produk','jproduk_nobukti',$pattern,12);
			
			$data = array(
				"jproduk_nobukti"=>$jproduk_nobukti, 
				"jproduk_cust"=>$jproduk_cust, 
				"jproduk_tanggal"=>$jproduk_tanggal, 
				"jproduk_diskon"=>$jproduk_diskon, 
				"jproduk_cashback"=>$jproduk_cashback,
				"jproduk_bayar"=>$jproduk_bayar,
				"jproduk_cara"=>$jproduk_cara, 
				//"jproduk_cara2"=>$jproduk_cara2, 
				//"jproduk_cara3"=>$jproduk_cara3, 
				"jproduk_keterangan"=>$jproduk_keterangan 
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
							"jkwitansi_ref"=>$jproduk_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jproduk_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jproduk_card_nama,
							"jcard_edc"=>$jproduk_card_edc,
							"jcard_no"=>$jproduk_card_no,
							"jcard_nilai"=>$jproduk_card_nilai,
							"jcard_ref"=>$jproduk_nobukti
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
							"jcek_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jproduk_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jproduk_transfer_bank,
							"jtransfer_nama"=>$jproduk_transfer_nama,
							"jtransfer_nilai"=>$jproduk_transfer_nilai,
							"jtransfer_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jproduk_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jproduk_tunai_nilai,
							"jtunai_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jproduk_cara=='voucher'){
						
						$data=array(
							"tvoucher_novoucher"=>$jproduk_voucher_no,
							"tvoucher_ref"=>$jproduk_nobukti
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
							"jkwitansi_ref"=>$jproduk_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jproduk_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jproduk_card_nama2,
							"jcard_edc"=>$jproduk_card_edc2,
							"jcard_no"=>$jproduk_card_no2,
							"jcard_nilai"=>$jproduk_card_nilai2,
							"jcard_ref"=>$jproduk_nobukti
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
							"jcek_nilai"=>$jproduk_cek_nilai,
							"jcek_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jproduk_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jproduk_transfer_bank2,
							"jtransfer_nama"=>$jproduk_transfer_nama2,
							"jtransfer_nilai"=>$jproduk_transfer_nilai2,
							"jtransfer_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jproduk_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jproduk_tunai_nilai2,
							"jtunai_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jproduk_cara2=='voucher'){
						
						$data=array(
							"tvoucher_novoucher"=>$jproduk_voucher_no2,
							"tvoucher_ref"=>$jproduk_nobukti
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
							"jkwitansi_ref"=>$jproduk_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jproduk_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jproduk_card_nama3,
							"jcard_edc"=>$jproduk_card_edc3,
							"jcard_no"=>$jproduk_card_no3,
							"jcard_nilai"=>$jproduk_hutang,
							"jcard_ref"=>$jproduk_nobukti
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
							"jcek_nilai"=>$jproduk_cek_nilai,
							"jcek_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jproduk_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jproduk_transfer_bank3,
							"jtransfer_nama"=>$jproduk_transfer_nama3,
							"jtransfer_nilai"=>$jproduk_transfer_nilai3,
							"jtransfer_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jproduk_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jproduk_tunai_nilai3,
							"jtunai_ref"=>$jproduk_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jproduk_cara3=='voucher'){
						
						$data=array(
							"tvoucher_novoucher"=>$jproduk_voucher_no3,
							"tvoucher_ref"=>$jproduk_nobukti
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
		
		//function for advanced search record
		function master_jual_produk_search($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$start,$end){
			//full query
			$query="select * from master_jual_produk";
			
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
		
}
?>