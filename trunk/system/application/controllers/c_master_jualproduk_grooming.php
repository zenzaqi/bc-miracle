<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_jualproduk_grooming Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_jualproduk_grooming.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
*/

//class of master_jualproduk_grooming
class C_master_jualproduk_grooming extends Controller {

	//constructor
	function C_master_jualproduk_grooming(){
		parent::Controller();
		$this->load->model('m_master_jualproduk_grooming', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_jualproduk_grooming');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_jual_produk');
	}
	
	function print_laporan(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$opsi=(isset($_POST['opsi']) ? @$_POST['opsi'] : @$_GET['opsi']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		$group=(isset($_POST['group']) ? @$_POST['group'] : @$_GET['group']);
		
		$data["jenis"]='Produk';
		if($periode=="all"){
			$data["periode"]="Semua Periode";
		}else if($periode=="bulan"){
			$tgl_awal=$tahun."-".$bulan;
			$data["periode"]=get_ina_month_name($bulan,'long')." ".$tahun;
		}else if($periode=="tanggal"){
			$data["periode"]="Periode ".$tgl_awal." s/d ".$tgl_akhir;
		}
		
		$data["total_item"]=$this->m_master_jualproduk_grooming->get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["total_diskon"]=$this->m_master_jualproduk_grooming->get_total_diskon($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["total_nilai"]=$this->m_master_jualproduk_grooming->get_total_nilai($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["data_print"]=$this->m_master_jualproduk_grooming->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);
			
		if($opsi=='rekap'){
			$data["total_tunai"]=$this->m_master_jualproduk_grooming->get_total_tunai($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_cek"]=$this->m_master_jualproduk_grooming->get_total_cek($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_transfer"]=$this->m_master_jualproduk_grooming->get_total_transfer($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_card"]=$this->m_master_jualproduk_grooming->get_total_card($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_kuitansi"]=$this->m_master_jualproduk_grooming->get_total_kuitansi($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_kredit"]=$this->m_master_jualproduk_grooming->get_total_kredit($tgl_awal,$tgl_akhir,$periode,$opsi);	
			
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_jual_tanggal.php",$data,TRUE);break;
				case "Customer": $print_view=$this->load->view("main/p_rekap_jual_customer.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_jual.php",$data,TRUE);break;
			}
			
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_jual_tanggal.php",$data,TRUE);break;
				case "Customer": $print_view=$this->load->view("main/p_detail_jual_customer.php",$data,TRUE);break;
				case "Produk": $print_view=$this->load->view("main/p_detail_jual_produk.php",$data,TRUE);break;
				case "Sales": $print_view=$this->load->view("main/p_detail_jual_sales.php",$data,TRUE);break;
				case "Jenis Diskon": $print_view=$this->load->view("main/p_detail_jual_diskon.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_jual.php",$data,TRUE);break;
			}
		}
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_jproduk.html","w+");
		else
			$print_file=fopen("print/report_jproduk.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	function get_konversi_list(){
		$dpgrooming_produk_id=trim(@$_POST["dpgrooming_produk_id"]);
		$result=$this->m_master_jualproduk_grooming->get_konversi_list($dpgrooming_produk_id);
		echo $result;
	}
	
	function get_bank_list(){
		$result=$this->m_public_function->get_bank_list();
		echo $result;
	}
	
		function get_allkaryawan_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_jualproduk_grooming->get_allkaryawan_list($query,$start,$end);
		echo $result;
	}
	
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_jualproduk_grooming->get_produk_list($query,$start,$end);
		echo $result;
	}
	
	function get_satuan_list(){
		$result = $this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	function get_satuan_bydjproduk_list(){
		$query = (integer) (isset($_POST['query']) ? $_POST['query'] : 0);
		$produk_id = (integer) (isset($_POST['produk_id']) ? $_POST['produk_id'] : 0);
		$result = $this->m_master_jualproduk_grooming->get_satuan_bydjproduk_list($query,$produk_id);
		echo $result;
	}
	
	/*function get_satuan_byproduk_list(){
		$jpgrooming_id = (integer) (isset($_POST['jpgrooming_id']) ? $_POST['jpgrooming_id'] : 0);
		$produk_id = (integer) (isset($_POST['produk_id']) ? $_POST['produk_id'] : 0);
		$result = $this->m_master_jualproduk_grooming->get_satuan_byproduk_list($jpgrooming_id, $produk_id);
		echo $result;
	}*/
	
	function get_harga_produk(){
		$produk_id = (integer) (isset($_POST['produk_id']) ? $_POST['produk_id'] : $_GET['produk_id']);
		$result = $this->m_public_function->get_harga_produk($produk_id);
		echo $result;
	}
	
	function get_kwitansi_by_ref(){
		$ref_id = (isset($_POST['no_faktur']) ? $_POST['no_faktur'] : $_GET['no_faktur']);
		$result = $this->m_public_function->get_kwitansi_by_ref($ref_id);
		echo $result;
	}
	
	function get_cek_by_ref(){
		$ref_id = (isset($_POST['no_faktur']) ? $_POST['no_faktur'] : $_GET['no_faktur']);
		$result = $this->m_public_function->get_cek_by_ref($ref_id);
		echo $result;
	}
	
	function get_card_by_ref(){
		$ref_id = (isset($_POST['no_faktur']) ? $_POST['no_faktur'] : $_GET['no_faktur']);
		$result = $this->m_public_function->get_card_by_ref($ref_id);
		echo $result;
	}
	
	function get_transfer_by_ref(){
		$ref_id = (isset($_POST['no_faktur']) ? $_POST['no_faktur'] : $_GET['no_faktur']);
		$result = $this->m_public_function->get_transfer_by_ref($ref_id);
		echo $result;
	}
	
	function get_tunai_by_ref(){
		$ref_id = (isset($_POST['no_faktur']) ? $_POST['no_faktur'] : $_GET['no_faktur']);
		$result = $this->m_public_function->get_tunai_by_ref($ref_id);
		echo $result;
	}
	
	function get_voucher_by_ref(){
		$ref_id = (isset($_POST['no_faktur']) ? $_POST['no_faktur'] : $_GET['no_faktur']);
		$result = $this->m_public_function->get_voucher_by_ref($ref_id);
		echo $result;
	}
	
	function  get_voucher_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_jualproduk_grooming->get_voucher_list($query,$start,$end);
		echo $result;
	}
	
	function  get_kwitansi_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		//$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		//$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$start=0;
		$end=10;
		$kwitansi_cust=trim(@$_POST["kwitansi_cust"]);
		$result=$this->m_public_function->get_kwitansi_list($query,$start,$end,$kwitansi_cust);
		echo $result;
	}
	
	function get_member_by_cust(){
		$member_cust = (integer) (isset($_POST['member_cust']) ? $_POST['member_cust'] : $_GET['member_cust']);
		$result=$this->m_public_function->get_member_by_cust($member_cust);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_jpgrooming_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jualproduk_grooming->detail_detail_jpgrooming_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_jpgrooming_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jualproduk_grooming->detail_detail_jpgrooming_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_jualproduk_grooming->get_master_id();
		echo $result;
	}
	//
	
	function catatan_piutang_update(){
		$dpgrooming_master = isset($_POST['dpgrooming_master']) ? $_POST['dpgrooming_master'] : "";
		$result=$this->m_master_jualproduk_grooming->catatan_piutang_update($dpgrooming_master);
		echo $result;
	}
	
	//add detail
	function detail_detail_jpgrooming_insert(){
	//POST variable here
		$dpgrooming_id=trim(@$_POST["dpgrooming_id"]);
		$dpgrooming_master=trim(@$_POST["dpgrooming_master"]);
		$dpgrooming_produk=trim(@$_POST["dpgrooming_produk"]);
		$dpgrooming_satuan=trim(@$_POST["dpgrooming_satuan"]);
		$dpgrooming_jumlah=trim(@$_POST["dpgrooming_jumlah"]);
		$dpgrooming_harga=trim(@$_POST["dpgrooming_harga"]);
		$dpgrooming_subtotal_net=trim(@$_POST["dpgrooming_subtotal_net"]);
		$dpgrooming_diskon=trim(@$_POST["dpgrooming_diskon"]);
		$dpgrooming_diskon_jenis=trim(@$_POST["dpgrooming_diskon_jenis"]);
		$dpgrooming_sales=trim(@$_POST["dpgrooming_sales"]);
		$konversi_nilai_temp=trim(@$_POST["konversi_nilai_temp"]);
		$result=$this->m_master_jualproduk_grooming->detail_detail_jpgrooming_insert($dpgrooming_id ,$dpgrooming_master ,$dpgrooming_produk ,$dpgrooming_satuan ,$dpgrooming_jumlah ,$dpgrooming_harga ,$dpgrooming_subtotal_net ,$dpgrooming_diskon,$dpgrooming_diskon_jenis,$dpgrooming_sales,$konversi_nilai_temp );
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_jpgrooming_list();
				break;
			case "UPDATE":
				$this->master_jpgrooming_update();
				break;
			case "CREATE":
				$this->master_jpgrooming_create();
				break;
			case "DELETE":
				$this->master_jpgrooming_delete();
				break;
			case "SEARCH":
				$this->master_jpgrooming_search();
				break;
			case "PRINT":
				$this->master_jpgrooming_print();
				break;
			case "EXCEL":
				$this->master_jpgrooming_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_jpgrooming_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_jualproduk_grooming->master_jpgrooming_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_jpgrooming_update(){
		//POST variable here
		$jpgrooming_id=trim(@$_POST["jpgrooming_id"]);
		$jpgrooming_nobukti=trim(@$_POST["jpgrooming_nobukti"]);
		$jpgrooming_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_nobukti);
		$jpgrooming_nobukti=str_replace("'", '"',$jpgrooming_nobukti);
		$jpgrooming_karyawan=trim(@$_POST["jpgrooming_karyawan"]);
		$jpgrooming_tanggal=trim(@$_POST["jpgrooming_tanggal"]);
		$jpgrooming_diskon=trim(@$_POST["jpgrooming_diskon"]);
		$jpgrooming_cara=trim(@$_POST["jpgrooming_cara"]);
		$jpgrooming_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara);
		$jpgrooming_cara=str_replace("'", '"',$jpgrooming_cara);
		
		$jpgrooming_cara2=trim(@$_POST["jpgrooming_cara2"]);
		$jpgrooming_cara2=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara2);
		$jpgrooming_cara2=str_replace("'", '"',$jpgrooming_cara2);
		
		$jpgrooming_cara3=trim(@$_POST["jpgrooming_cara3"]);
		$jpgrooming_cara3=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara3);
		$jpgrooming_cara3=str_replace("'", '"',$jpgrooming_cara3);
		
		$jpgrooming_keterangan=trim(@$_POST["jpgrooming_keterangan"]);
		$jpgrooming_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_keterangan);
		$jpgrooming_keterangan=str_replace("'", '"',$jpgrooming_keterangan);
		$jpgrooming_cashback=trim($_POST["jpgrooming_cashback"]);
		
		//tunai
		$jpgrooming_tunai_nilai=trim($_POST["jpgrooming_tunai_nilai"]);
		//tunai-2
		$jpgrooming_tunai_nilai2=trim($_POST["jpgrooming_tunai_nilai2"]);
		//tunai-3
		$jpgrooming_tunai_nilai3=trim($_POST["jpgrooming_tunai_nilai3"]);
		//voucher
		$jpgrooming_voucher_no=trim($_POST["jpgrooming_voucher_no"]);
		$jpgrooming_voucher_cashback=trim($_POST["jpgrooming_voucher_cashback"]);
		//voucher-2
		$jpgrooming_voucher_no2=trim($_POST["jpgrooming_voucher_no2"]);
		$jpgrooming_voucher_cashback2=trim($_POST["jpgrooming_voucher_cashback2"]);
		//voucher-3
		$jpgrooming_voucher_no3=trim($_POST["jpgrooming_voucher_no3"]);
		$jpgrooming_voucher_cashback3=trim($_POST["jpgrooming_voucher_cashback3"]);
		
		//bayar
		$jpgrooming_bayar=trim($_POST["jpgrooming_bayar"]);
		$jpgrooming_subtotal=trim($_POST["jpgrooming_subtotal"]);
		$jpgrooming_total=trim($_POST["jpgrooming_total"]);
		$jpgrooming_hutang=trim($_POST["jpgrooming_hutang"]);
		//if($jpgrooming_cara=='tunai')
			//$jpgrooming_bayar=$jpgrooming_subtotal;
		//card
		$jpgrooming_card_nama=trim($_POST["jpgrooming_card_nama"]);
		$jpgrooming_card_edc=trim($_POST["jpgrooming_card_edc"]);
		$jpgrooming_card_no=trim($_POST["jpgrooming_card_no"]);
		$jpgrooming_card_nilai=trim($_POST["jpgrooming_card_nilai"]);
		//card-2
		$jpgrooming_card_nama2=trim($_POST["jpgrooming_card_nama2"]);
		$jpgrooming_card_edc2=trim($_POST["jpgrooming_card_edc2"]);
		$jpgrooming_card_no2=trim($_POST["jpgrooming_card_no2"]);
		$jpgrooming_card_nilai2=trim($_POST["jpgrooming_card_nilai2"]);
		//card-3
		$jpgrooming_card_nama3=trim($_POST["jpgrooming_card_nama3"]);
		$jpgrooming_card_edc3=trim($_POST["jpgrooming_card_edc3"]);
		$jpgrooming_card_no3=trim($_POST["jpgrooming_card_no3"]);
		$jpgrooming_card_nilai3=trim($_POST["jpgrooming_card_nilai3"]);
		//kwitansi
		$jpgrooming_kwitansi_no=trim($_POST["jpgrooming_kwitansi_no"]);
		$jpgrooming_kwitansi_nama=trim(@$_POST["jpgrooming_kwitansi_nama"]);
		$jpgrooming_kwitansi_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_kwitansi_nama);
		$jpgrooming_kwitansi_nama=str_replace("'", '"',$jpgrooming_kwitansi_nama);
		$jpgrooming_kwitansi_nilai=trim($_POST["jpgrooming_kwitansi_nilai"]);
		//kwitansi-2
		$jpgrooming_kwitansi_no2=trim($_POST["jpgrooming_kwitansi_no2"]);
		$jpgrooming_kwitansi_nama2=trim(@$_POST["jpgrooming_kwitansi_nama2"]);
		$jpgrooming_kwitansi_nama2=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_kwitansi_nama2);
		$jpgrooming_kwitansi_nama2=str_replace("'", '"',$jpgrooming_kwitansi_nama2);
		$jpgrooming_kwitansi_nilai2=trim($_POST["jpgrooming_kwitansi_nilai2"]);
		//kwitansi-3
		$jpgrooming_kwitansi_no3=trim($_POST["jpgrooming_kwitansi_no3"]);
		$jpgrooming_kwitansi_nama3=trim(@$_POST["jpgrooming_kwitansi_nama3"]);
		$jpgrooming_kwitansi_nama3=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_kwitansi_nama3);
		$jpgrooming_kwitansi_nama3=str_replace("'", '"',$jpgrooming_kwitansi_nama3);
		$jpgrooming_kwitansi_nilai3=trim($_POST["jpgrooming_kwitansi_nilai3"]);
		//cek
		$jpgrooming_cek_nama=trim($_POST["jpgrooming_cek_nama"]);
		$jpgrooming_cek_no=trim($_POST["jpgrooming_cek_no"]);
		$jpgrooming_cek_valid=trim($_POST["jpgrooming_cek_valid"]);
		$jpgrooming_cek_bank=trim($_POST["jpgrooming_cek_bank"]);
		$jpgrooming_cek_nilai=trim($_POST["jpgrooming_cek_nilai"]);
		//cek-2
		$jpgrooming_cek_nama2=trim($_POST["jpgrooming_cek_nama2"]);
		$jpgrooming_cek_no2=trim($_POST["jpgrooming_cek_no2"]);
		$jpgrooming_cek_valid2=trim($_POST["jpgrooming_cek_valid2"]);
		$jpgrooming_cek_bank2=trim($_POST["jpgrooming_cek_bank2"]);
		$jpgrooming_cek_nilai2=trim($_POST["jpgrooming_cek_nilai2"]);
		//cek-3
		$jpgrooming_cek_nama3=trim($_POST["jpgrooming_cek_nama3"]);
		$jpgrooming_cek_no3=trim($_POST["jpgrooming_cek_no3"]);
		$jpgrooming_cek_valid3=trim($_POST["jpgrooming_cek_valid3"]);
		$jpgrooming_cek_bank3=trim($_POST["jpgrooming_cek_bank3"]);
		$jpgrooming_cek_nilai3=trim($_POST["jpgrooming_cek_nilai3"]);
		//transfer
		$jpgrooming_transfer_bank=trim($_POST["jpgrooming_transfer_bank"]);
		$jpgrooming_transfer_nama=trim($_POST["jpgrooming_transfer_nama"]);
		$jpgrooming_transfer_nilai=trim($_POST["jpgrooming_transfer_nilai"]);
		//transfer-2
		$jpgrooming_transfer_bank2=trim($_POST["jpgrooming_transfer_bank2"]);
		$jpgrooming_transfer_nama2=trim($_POST["jpgrooming_transfer_nama2"]);
		$jpgrooming_transfer_nilai2=trim($_POST["jpgrooming_transfer_nilai2"]);
		//transfer-3
		$jpgrooming_transfer_bank3=trim($_POST["jpgrooming_transfer_bank3"]);
		$jpgrooming_transfer_nama3=trim($_POST["jpgrooming_transfer_nama3"]);
		$jpgrooming_transfer_nilai3=trim($_POST["jpgrooming_transfer_nilai3"]);
		
		
		$result = $this->m_master_jualproduk_grooming->master_jpgrooming_update($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_cara2 ,$jpgrooming_cara3 ,$jpgrooming_keterangan , $jpgrooming_cashback, $jpgrooming_tunai_nilai, $jpgrooming_tunai_nilai2, $jpgrooming_tunai_nilai3, $jpgrooming_voucher_no, $jpgrooming_voucher_cashback, $jpgrooming_voucher_no2, $jpgrooming_voucher_cashback2, $jpgrooming_voucher_no3, $jpgrooming_voucher_cashback3, $jpgrooming_bayar, $jpgrooming_subtotal, $jpgrooming_total, $jpgrooming_hutang, $jpgrooming_kwitansi_no, $jpgrooming_kwitansi_nama, $jpgrooming_kwitansi_nilai, $jpgrooming_kwitansi_no2, $jpgrooming_kwitansi_nama2, $jpgrooming_kwitansi_nilai2, $jpgrooming_kwitansi_no3, $jpgrooming_kwitansi_nama3, $jpgrooming_kwitansi_nilai3, $jpgrooming_card_nama, $jpgrooming_card_edc, $jpgrooming_card_no, $jpgrooming_card_nilai, $jpgrooming_card_nama2, $jpgrooming_card_edc2, $jpgrooming_card_no2, $jpgrooming_card_nilai2, $jpgrooming_card_nama3, $jpgrooming_card_edc3, $jpgrooming_card_no3, $jpgrooming_card_nilai3, $jpgrooming_cek_nama, $jpgrooming_cek_no, $jpgrooming_cek_valid, $jpgrooming_cek_bank, $jpgrooming_cek_nilai, $jpgrooming_cek_nama2, $jpgrooming_cek_no2, $jpgrooming_cek_valid2, $jpgrooming_cek_bank2, $jpgrooming_cek_nilai2, $jpgrooming_cek_nama3, $jpgrooming_cek_no3, $jpgrooming_cek_valid3, $jpgrooming_cek_bank3, $jpgrooming_cek_nilai3, $jpgrooming_transfer_bank, $jpgrooming_transfer_nama, $jpgrooming_transfer_nilai, $jpgrooming_transfer_bank2, $jpgrooming_transfer_nama2, $jpgrooming_transfer_nilai2, $jpgrooming_transfer_bank3, $jpgrooming_transfer_nama3, $jpgrooming_transfer_nilai3);
		echo $result;
	}
	
	//function for create new record
	function master_jpgrooming_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jpgrooming_nobukti=trim(@$_POST["jpgrooming_nobukti"]);
		$jpgrooming_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_nobukti);
		$jpgrooming_nobukti=str_replace("'", '"',$jpgrooming_nobukti);
		$jpgrooming_karyawan=trim(@$_POST["jpgrooming_karyawan"]);
		$jpgrooming_tanggal=trim(@$_POST["jpgrooming_tanggal"]);
		$jpgrooming_diskon=trim(@$_POST["jpgrooming_diskon"]);
		$jpgrooming_cara=trim(@$_POST["jpgrooming_cara"]);
		$jpgrooming_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara);
		$jpgrooming_cara=str_replace("'", '"',$jpgrooming_cara);
		
		$jpgrooming_cara2=trim(@$_POST["jpgrooming_cara2"]);
		$jpgrooming_cara2=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara2);
		$jpgrooming_cara2=str_replace("'", '"',$jpgrooming_cara2);
		
		$jpgrooming_cara3=trim(@$_POST["jpgrooming_cara3"]);
		$jpgrooming_cara3=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara3);
		$jpgrooming_cara3=str_replace("'", '"',$jpgrooming_cara3);
		
		$jpgrooming_keterangan=trim(@$_POST["jpgrooming_keterangan"]);
		$jpgrooming_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_keterangan);
		$jpgrooming_keterangan=str_replace("'", '"',$jpgrooming_keterangan);
		$jpgrooming_cashback=trim($_POST["jpgrooming_cashback"]);
		//$jpgrooming_voucher=trim($_POST["jpgrooming_voucher"]);
		//tunai
		$jpgrooming_tunai_nilai=trim($_POST["jpgrooming_tunai_nilai"]);
		//tunai-2
		$jpgrooming_tunai_nilai2=trim($_POST["jpgrooming_tunai_nilai2"]);
		//tunai-3
		$jpgrooming_tunai_nilai3=trim($_POST["jpgrooming_tunai_nilai3"]);
		//voucher
		$jpgrooming_voucher_no=trim($_POST["jpgrooming_voucher_no"]);
		$jpgrooming_voucher_cashback=trim($_POST["jpgrooming_voucher_cashback"]);
		//voucher-2
		$jpgrooming_voucher_no2=trim($_POST["jpgrooming_voucher_no2"]);
		$jpgrooming_voucher_cashback2=trim($_POST["jpgrooming_voucher_cashback2"]);
		//voucher-3
		$jpgrooming_voucher_no3=trim($_POST["jpgrooming_voucher_no3"]);
		$jpgrooming_voucher_cashback3=trim($_POST["jpgrooming_voucher_cashback3"]);
		//bayar
		$jpgrooming_bayar=trim($_POST["jpgrooming_bayar"]);
		$jpgrooming_subtotal=trim($_POST["jpgrooming_subtotal"]);
		$jpgrooming_total=trim($_POST["jpgrooming_total"]);
		$jpgrooming_hutang=trim($_POST["jpgrooming_hutang"]);
		//if($jpgrooming_cara=='tunai')
			//$jpgrooming_bayar=$jpgrooming_subtotal;
		//card
		$jpgrooming_card_nama=trim($_POST["jpgrooming_card_nama"]);
		$jpgrooming_card_edc=trim($_POST["jpgrooming_card_edc"]);
		$jpgrooming_card_no=trim($_POST["jpgrooming_card_no"]);
		$jpgrooming_card_nilai=trim($_POST["jpgrooming_card_nilai"]);
		//card-2
		$jpgrooming_card_nama2=trim($_POST["jpgrooming_card_nama2"]);
		$jpgrooming_card_edc2=trim($_POST["jpgrooming_card_edc2"]);
		$jpgrooming_card_no2=trim($_POST["jpgrooming_card_no2"]);
		$jpgrooming_card_nilai2=trim($_POST["jpgrooming_card_nilai2"]);
		//card-3
		$jpgrooming_card_nama3=trim($_POST["jpgrooming_card_nama3"]);
		$jpgrooming_card_edc3=trim($_POST["jpgrooming_card_edc3"]);
		$jpgrooming_card_no3=trim($_POST["jpgrooming_card_no3"]);
		$jpgrooming_card_nilai3=trim($_POST["jpgrooming_card_nilai3"]);
		//kwitansi
		$jpgrooming_kwitansi_no=trim($_POST["jpgrooming_kwitansi_no"]);
		$jpgrooming_kwitansi_nama=trim(@$_POST["jpgrooming_kwitansi_nama"]);
		$jpgrooming_kwitansi_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_kwitansi_nama);
		$jpgrooming_kwitansi_nama=str_replace("'", '"',$jpgrooming_kwitansi_nama);
		$jpgrooming_kwitansi_nilai=trim($_POST["jpgrooming_kwitansi_nilai"]);
		//kwitansi-2
		$jpgrooming_kwitansi_no2=trim($_POST["jpgrooming_kwitansi_no2"]);
		$jpgrooming_kwitansi_nama2=trim(@$_POST["jpgrooming_kwitansi_nama2"]);
		$jpgrooming_kwitansi_nama2=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_kwitansi_nama2);
		$jpgrooming_kwitansi_nama2=str_replace("'", '"',$jpgrooming_kwitansi_nama2);
		$jpgrooming_kwitansi_nilai2=trim($_POST["jpgrooming_kwitansi_nilai2"]);
		//kwitansi-3
		$jpgrooming_kwitansi_no3=trim($_POST["jpgrooming_kwitansi_no3"]);
		$jpgrooming_kwitansi_nama3=trim(@$_POST["jpgrooming_kwitansi_nama3"]);
		$jpgrooming_kwitansi_nama3=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_kwitansi_nama3);
		$jpgrooming_kwitansi_nama3=str_replace("'", '"',$jpgrooming_kwitansi_nama3);
		$jpgrooming_kwitansi_nilai3=trim($_POST["jpgrooming_kwitansi_nilai3"]);
		//cek
		$jpgrooming_cek_nama=trim($_POST["jpgrooming_cek_nama"]);
		$jpgrooming_cek_no=trim($_POST["jpgrooming_cek_no"]);
		$jpgrooming_cek_valid=trim($_POST["jpgrooming_cek_valid"]);
		$jpgrooming_cek_bank=trim($_POST["jpgrooming_cek_bank"]);
		$jpgrooming_cek_nilai=trim($_POST["jpgrooming_cek_nilai"]);
		//cek-2
		$jpgrooming_cek_nama2=trim($_POST["jpgrooming_cek_nama2"]);
		$jpgrooming_cek_no2=trim($_POST["jpgrooming_cek_no2"]);
		$jpgrooming_cek_valid2=trim($_POST["jpgrooming_cek_valid2"]);
		$jpgrooming_cek_bank2=trim($_POST["jpgrooming_cek_bank2"]);
		$jpgrooming_cek_nilai2=trim($_POST["jpgrooming_cek_nilai2"]);
		//cek-3
		$jpgrooming_cek_nama3=trim($_POST["jpgrooming_cek_nama3"]);
		$jpgrooming_cek_no3=trim($_POST["jpgrooming_cek_no3"]);
		$jpgrooming_cek_valid3=trim($_POST["jpgrooming_cek_valid3"]);
		$jpgrooming_cek_bank3=trim($_POST["jpgrooming_cek_bank3"]);
		$jpgrooming_cek_nilai3=trim($_POST["jpgrooming_cek_nilai3"]);
		//transfer
		$jpgrooming_transfer_bank=trim($_POST["jpgrooming_transfer_bank"]);
		$jpgrooming_transfer_nama=trim($_POST["jpgrooming_transfer_nama"]);
		$jpgrooming_transfer_nilai=trim($_POST["jpgrooming_transfer_nilai"]);
		//transfer-2
		$jpgrooming_transfer_bank2=trim($_POST["jpgrooming_transfer_bank2"]);
		$jpgrooming_transfer_nama2=trim($_POST["jpgrooming_transfer_nama2"]);
		$jpgrooming_transfer_nilai2=trim($_POST["jpgrooming_transfer_nilai2"]);
		//transfer-3
		$jpgrooming_transfer_bank3=trim($_POST["jpgrooming_transfer_bank3"]);
		$jpgrooming_transfer_nama3=trim($_POST["jpgrooming_transfer_nama3"]);
		$jpgrooming_transfer_nilai3=trim($_POST["jpgrooming_transfer_nilai3"]);
				
		$result=$this->m_master_jualproduk_grooming->master_jpgrooming_create($jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_cara2 ,$jpgrooming_cara3 ,$jpgrooming_keterangan , $jpgrooming_cashback, $jpgrooming_tunai_nilai, $jpgrooming_tunai_nilai2, $jpgrooming_tunai_nilai3, $jpgrooming_voucher_no, $jpgrooming_voucher_cashback, $jpgrooming_voucher_no2, $jpgrooming_voucher_cashback2, $jpgrooming_voucher_no3, $jpgrooming_voucher_cashback3, $jpgrooming_bayar, $jpgrooming_subtotal, $jpgrooming_total, $jpgrooming_hutang, $jpgrooming_kwitansi_no, $jpgrooming_kwitansi_nama, $jpgrooming_kwitansi_nilai, $jpgrooming_kwitansi_no2, $jpgrooming_kwitansi_nama2, $jpgrooming_kwitansi_nilai2, $jpgrooming_kwitansi_no3, $jpgrooming_kwitansi_nama3, $jpgrooming_kwitansi_nilai3, $jpgrooming_card_nama, $jpgrooming_card_edc, $jpgrooming_card_no, $jpgrooming_card_nilai, $jpgrooming_card_nama2, $jpgrooming_card_edc2, $jpgrooming_card_no2, $jpgrooming_card_nilai2, $jpgrooming_card_nama3, $jpgrooming_card_edc3, $jpgrooming_card_no3, $jpgrooming_card_nilai3, $jpgrooming_cek_nama, $jpgrooming_cek_no, $jpgrooming_cek_valid, $jpgrooming_cek_bank, $jpgrooming_cek_nilai, $jpgrooming_cek_nama2, $jpgrooming_cek_no2, $jpgrooming_cek_valid2, $jpgrooming_cek_bank2, $jpgrooming_cek_nilai2, $jpgrooming_cek_nama3, $jpgrooming_cek_no3, $jpgrooming_cek_valid3, $jpgrooming_cek_bank3, $jpgrooming_cek_nilai3, $jpgrooming_transfer_bank, $jpgrooming_transfer_nama, $jpgrooming_transfer_nilai, $jpgrooming_transfer_bank2, $jpgrooming_transfer_nama2, $jpgrooming_transfer_nilai2, $jpgrooming_transfer_bank3, $jpgrooming_transfer_nama3, $jpgrooming_transfer_nilai3);
		echo $result;
	}

	//function for delete selected record
	function master_jpgrooming_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_jualproduk_grooming->master_jpgrooming_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_jpgrooming_search(){
		//POST varibale here
		$jpgrooming_id=trim(@$_POST["jpgrooming_id"]);
		$jpgrooming_nobukti=trim(@$_POST["jpgrooming_nobukti"]);
		$jpgrooming_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_nobukti);
		$jpgrooming_nobukti=str_replace("'", '"',$jpgrooming_nobukti);
		$jpgrooming_karyawan=trim(@$_POST["jpgrooming_karyawan"]);
		$jpgrooming_tanggal=trim(@$_POST["jpgrooming_tanggal"]);
		$jpgrooming_diskon=trim(@$_POST["jpgrooming_diskon"]);
		$jpgrooming_cara=trim(@$_POST["jpgrooming_cara"]);
		$jpgrooming_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara);
		$jpgrooming_cara=str_replace("'", '"',$jpgrooming_cara);
		$jpgrooming_keterangan=trim(@$_POST["jpgrooming_keterangan"]);
		$jpgrooming_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_keterangan);
		$jpgrooming_keterangan=str_replace("'", '"',$jpgrooming_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_jualproduk_grooming->master_jpgrooming_search($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_keterangan ,$start,$end);
		echo $result;
	}


	function master_jpgrooming_print(){
  		//POST varibale here
		$jpgrooming_id=trim(@$_POST["jpgrooming_id"]);
		$jpgrooming_nobukti=trim(@$_POST["jpgrooming_nobukti"]);
		$jpgrooming_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_nobukti);
		$jpgrooming_nobukti=str_replace("'", '"',$jpgrooming_nobukti);
		$jpgrooming_karyawan=trim(@$_POST["jpgrooming_karyawan"]);
		$jpgrooming_tanggal=trim(@$_POST["jpgrooming_tanggal"]);
		$jpgrooming_diskon=trim(@$_POST["jpgrooming_diskon"]);
		$jpgrooming_cara=trim(@$_POST["jpgrooming_cara"]);
		$jpgrooming_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara);
		$jpgrooming_cara=str_replace("'", '"',$jpgrooming_cara);
		$jpgrooming_keterangan=trim(@$_POST["jpgrooming_keterangan"]);
		$jpgrooming_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_keterangan);
		$jpgrooming_keterangan=str_replace("'", '"',$jpgrooming_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_jualproduk_grooming->master_jpgrooming_print($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=12;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_jualproduk_groominglist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the master_jualproduk_grooming Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='master_jpgrooming List'><caption>master_jualproduk_grooming</caption><thead><tr><th scope='col'>Jproduk Id</th><th scope='col'>Jproduk Nobukti</th><th scope='col'>Jproduk Cust</th><th scope='col'>Jproduk Tanggal</th><th scope='col'>Jproduk Diskon</th><th scope='col'>Jproduk Cara</th><th scope='col'>Jproduk Keterangan</th><th scope='col'>Jproduk Creator</th><th scope='col'>Jproduk Date Create</th><th scope='col'>Jproduk Update</th><th scope='col'>Jproduk Date Update</th><th scope='col'>Jproduk Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " master_jualproduk_grooming</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jpgrooming_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jpgrooming_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jpgrooming_karyawan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jpgrooming_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jpgrooming_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jpgrooming_cara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jpgrooming_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jpgrooming_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jpgrooming_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jpgrooming_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jpgrooming_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jpgrooming_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_jpgrooming_export_excel(){
		//POST varibale here
		$jpgrooming_id=trim(@$_POST["jpgrooming_id"]);
		$jpgrooming_nobukti=trim(@$_POST["jpgrooming_nobukti"]);
		$jpgrooming_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_nobukti);
		$jpgrooming_nobukti=str_replace("'", '"',$jpgrooming_nobukti);
		$jpgrooming_karyawan=trim(@$_POST["jpgrooming_karyawan"]);
		$jpgrooming_tanggal=trim(@$_POST["jpgrooming_tanggal"]);
		$jpgrooming_diskon=trim(@$_POST["jpgrooming_diskon"]);
		$jpgrooming_cara=trim(@$_POST["jpgrooming_cara"]);
		$jpgrooming_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_cara);
		$jpgrooming_cara=str_replace("'", '"',$jpgrooming_cara);
		$jpgrooming_keterangan=trim(@$_POST["jpgrooming_keterangan"]);
		$jpgrooming_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jpgrooming_keterangan);
		$jpgrooming_keterangan=str_replace("'", '"',$jpgrooming_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_jualproduk_grooming->master_jpgrooming_export_excel($jpgrooming_id ,$jpgrooming_nobukti ,$jpgrooming_karyawan ,$jpgrooming_tanggal ,$jpgrooming_diskon ,$jpgrooming_cara ,$jpgrooming_keterangan ,$option,$filter);
		
		to_excel($query,"master_jualproduk_grooming"); 
		echo '1';
			
	}
	
	// Encodes a SQL array into a JSON formated string
	function JEncode($arr){
		if (version_compare(PHP_VERSION,"5.2","<"))
		{    
			require_once("./JSON.php"); //if php<5.2 need JSON class
			$json = new Services_JSON();//instantiate new json object
			$data=$json->encode($arr);  //encode the data in json format
		} else {
			$data = json_encode($arr);  //encode the data in json format
		}
		return $data;
	}
	
	// Decode a SQL array into a JSON formated string
	function JDecode($arr){
		if (version_compare(PHP_VERSION,"5.2","<"))
		{    
			require_once("./JSON.php"); //if php<5.2 need JSON class
			$json = new Services_JSON();//instantiate new json object
			$data=$json->decode($arr);  //decode the data in json format
		} else {
			$data = json_decode($arr);  //decode the data in json format
		}
		return $data;
	}
	
	// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
	function codeDate ($date) {
	  $tab = explode ("-", $date);
	  $r = $tab[1]."/".$tab[2]."/".$tab[0];
	  return $r;
	}
	
}
?>