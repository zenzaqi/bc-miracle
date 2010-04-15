<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_jual_rawat Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_jual_rawat.php
 	+ Author  		: 
 	+ Created on 01/Sep/2009 23:13:09
	
*/

//class of master_jual_rawat
class C_master_jual_rawat extends Controller {

	//constructor
	function C_master_jual_rawat(){
		parent::Controller();
		session_start();
		$this->load->model('m_master_jual_rawat', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_jual_rawat');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_jual_rawat');
	}
	
	function print_laporan(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$opsi=(isset($_POST['opsi']) ? @$_POST['opsi'] : @$_GET['opsi']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		$group=(isset($_POST['group']) ? @$_POST['group'] : @$_GET['group']);
		
		$data["jenis"]='Perawatan';
		if($periode=="all"){
			$data["periode"]="Semua Periode";
		}else if($periode=="bulan"){
			$tgl_awal=$tahun."-".$bulan;
			$data["periode"]=get_ina_month_name($bulan,'long')." ".$tahun;
		}else if($periode=="tanggal"){
			$data["periode"]="Periode ".$tgl_awal." s/d ".$tgl_akhir;
		}
		
		$data["total_item"]=$this->m_master_jual_rawat->get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["total_diskon"]=$this->m_master_jual_rawat->get_total_diskon($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["total_nilai"]=$this->m_master_jual_rawat->get_total_nilai($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["data_print"]=$this->m_master_jual_rawat->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);
			
		if($opsi=='rekap'){
			$data["total_tunai"]=$this->m_master_jual_rawat->get_total_tunai($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_cek"]=$this->m_master_jual_rawat->get_total_cek($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_transfer"]=$this->m_master_jual_rawat->get_total_transfer($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_card"]=$this->m_master_jual_rawat->get_total_card($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_kuintansi"]=$this->m_master_jual_rawat->get_total_kuintansi($tgl_awal,$tgl_akhir,$periode,$opsi);
			$data["total_kredit"]=$this->m_master_jual_rawat->get_total_kredit($tgl_awal,$tgl_akhir,$periode,$opsi);
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_jual_tanggal.php",$data,TRUE);break;
				case "Customer": $print_view=$this->load->view("main/p_rekap_jual_customer.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_jual.php",$data,TRUE);break;
			}
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_jual_tanggal.php",$data,TRUE);break;
				case "Customer": $print_view=$this->load->view("main/p_detail_jual_customer.php",$data,TRUE);break;
				case "Perawatan": $print_view=$this->load->view("main/p_detail_jual_produk.php",$data,TRUE);break;
				case "Sales": $print_view=$this->load->view("main/p_detail_jual_sales.php",$data,TRUE);break;
				case "Jenis Diskon": $print_view=$this->load->view("main/p_detail_jual_diskon.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_jual.php",$data,TRUE);break;
			}
		}
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_jrawat.html","w+");
		else
			$print_file=fopen("print/report_jrawat.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	function get_bank_list(){
		$result=$this->m_public_function->get_bank_list();
		echo $result;
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_rawat_list($query,$start,$end);
		echo $result;
	}
	
	/*function get_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_jual_rawat->get_rawat_list($query,$start,$end);
		echo $result;
	}*/
	
	/*function get_cbo_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_cbo_rawat_list($query,$start,$end);
		echo $result;
	}*/
	
		
	function get_harga_rawat(){
		$rawat_id = (integer) (isset($_POST['rawat_id']) ? $_POST['rawat_id'] : $_GET['rawat_id']);
		$result = $this->m_public_function->get_harga_rawat($rawat_id);
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
		$result=$this->m_master_jual_rawat->get_voucher_list($query,$start,$end);
		echo $result;
	}
	
	function  get_kwitansi_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		//$query = isset($_POST['query']) ? $_POST['query'] : "";
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
	function  detail_detail_jual_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jual_rawat->detail_detail_jual_rawat_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_jual_rawat_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jual_rawat->detail_detail_jual_rawat_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_jual_rawat->get_master_id();
		echo $result;
	}
	//
	
	function catatan_piutang_update(){
		$drawat_master = isset($_POST['drawat_master']) ? $_POST['drawat_master'] : "";
		$result=$this->m_master_jual_rawat->catatan_piutang_update($drawat_master);
		echo $result;
	}
	
	//add detail
	function detail_detail_jual_rawat_insert(){
	//POST variable here
		$drawat_id=trim(@$_POST["drawat_id"]);
		$drawat_master=trim(@$_POST["drawat_master"]);
		$drawat_rawat=trim(@$_POST["drawat_rawat"]);
		$drawat_jumlah=trim(@$_POST["drawat_jumlah"]);
		$drawat_harga=trim(@$_POST["drawat_harga"]);
		$drawat_diskon=trim(@$_POST["drawat_diskon"]);
		$drawat_diskon_jenis=trim(@$_POST["drawat_diskon_jenis"]);
		$drawat_sales=trim(@$_POST["drawat_sales"]);
		$drawat_sales=str_replace("/(<\/?)(p)([^>]*>)", "",$drawat_sales);
		$drawat_sales=str_replace("\\", "",$drawat_sales);
		$drawat_sales=str_replace("'", '"',$drawat_sales);
		$jrawat_id=trim(@$_POST["jrawat_id"]);
		$result=$this->m_master_jual_rawat->detail_detail_jual_rawat_insert($drawat_id ,$drawat_master ,$drawat_rawat ,$drawat_jumlah ,$drawat_harga ,$drawat_diskon ,$drawat_diskon_jenis ,$drawat_sales ,$jrawat_id);
	}
	
	//for detail pengambilan paket
	//list detail handler action
	function  detail_ambil_paket_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jual_rawat->detail_ambil_paket_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_jual_rawat_list();
				break;
			case "UPDATE":
				$this->master_jual_rawat_update();
				break;
			case "CREATE":
				$this->master_jual_rawat_create();
				break;
			case "DELETE":
				$this->master_jual_rawat_delete();
				break;
			case "SEARCH":
				$this->master_jual_rawat_search();
				break;
			case "PRINT":
				$this->master_jual_rawat_print();
				break;
			case "EXCEL":
				$this->master_jual_rawat_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_jual_rawat_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_jual_rawat->master_jual_rawat_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_jual_rawat_update(){
		//POST variable here
		$jrawat_id=trim(@$_POST["jrawat_id"]);
		$jrawat_nobukti=trim(@$_POST["jrawat_nobukti"]);
		$jrawat_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_nobukti);
		$jrawat_nobukti=str_replace("'", '"',$jrawat_nobukti);
		$jrawat_cust=trim(@$_POST["jrawat_cust"]);
		$jrawat_tanggal=trim(@$_POST["jrawat_tanggal"]);
		$jrawat_diskon=trim(@$_POST["jrawat_diskon"]);
		$jrawat_cara=trim(@$_POST["jrawat_cara"]);
		$jrawat_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara);
		$jrawat_cara=str_replace("'", '"',$jrawat_cara);
		
		$jrawat_cara2=trim(@$_POST["jrawat_cara2"]);
		$jrawat_cara2=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara2);
		$jrawat_cara2=str_replace("'", '"',$jrawat_cara2);
		
		$jrawat_cara3=trim(@$_POST["jrawat_cara3"]);
		$jrawat_cara3=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara3);
		$jrawat_cara3=str_replace("'", '"',$jrawat_cara3);
		
		$jrawat_keterangan=trim(@$_POST["jrawat_keterangan"]);
		$jrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_keterangan);
		$jrawat_keterangan=str_replace("'", '"',$jrawat_keterangan);
		
		$jrawat_stat_dok=trim(@$_POST["jrawat_stat_dok"]);
		$jrawat_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_stat_dok);
		$jrawat_stat_dok=str_replace("'", '"',$jrawat_stat_dok);
		
		$jrawat_cashback=trim($_POST["jrawat_cashback"]);
		
		//tunai
		$jrawat_tunai_nilai=trim($_POST["jrawat_tunai_nilai"]);
		//tunai-2
		$jrawat_tunai_nilai2=trim($_POST["jrawat_tunai_nilai2"]);
		//tunai-3
		$jrawat_tunai_nilai3=trim($_POST["jrawat_tunai_nilai3"]);
		//voucher
		$jrawat_voucher_no=trim($_POST["jrawat_voucher_no"]);
		$jrawat_voucher_cashback=trim($_POST["jrawat_voucher_cashback"]);
		//voucher-2
		$jrawat_voucher_no2=trim($_POST["jrawat_voucher_no2"]);
		$jrawat_voucher_cashback2=trim($_POST["jrawat_voucher_cashback2"]);
		//voucher-3
		$jrawat_voucher_no3=trim($_POST["jrawat_voucher_no3"]);
		$jrawat_voucher_cashback3=trim($_POST["jrawat_voucher_cashback3"]);
		
		//bayar
		$jrawat_total=trim($_POST["jrawat_total"]);
		$jrawat_bayar=trim($_POST["jrawat_bayar"]);
		$jrawat_subtotal=trim($_POST["jrawat_subtotal"]);
		$jrawat_hutang=trim($_POST["jrawat_hutang"]);
		//card
		$jrawat_card_nama=trim($_POST["jrawat_card_nama"]);
		$jrawat_card_edc=trim($_POST["jrawat_card_edc"]);
		$jrawat_card_no=trim($_POST["jrawat_card_no"]);
		$jrawat_card_nilai=trim($_POST["jrawat_card_nilai"]);
		//card-2
		$jrawat_card_nama2=trim($_POST["jrawat_card_nama2"]);
		$jrawat_card_edc2=trim($_POST["jrawat_card_edc2"]);
		$jrawat_card_no2=trim($_POST["jrawat_card_no2"]);
		$jrawat_card_nilai2=trim($_POST["jrawat_card_nilai2"]);
		//card-3
		$jrawat_card_nama3=trim($_POST["jrawat_card_nama3"]);
		$jrawat_card_edc3=trim($_POST["jrawat_card_edc3"]);
		$jrawat_card_no3=trim($_POST["jrawat_card_no3"]);
		$jrawat_card_nilai3=trim($_POST["jrawat_card_nilai3"]);
		//kwitansi
		$jrawat_kwitansi_no=trim($_POST["jrawat_kwitansi_no"]);
		$jrawat_kwitansi_nama=trim(@$_POST["jrawat_kwitansi_nama"]);
		$jrawat_kwitansi_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_kwitansi_nama);
		$jrawat_kwitansi_nama=str_replace("'", '"',$jrawat_kwitansi_nama);
		$jrawat_kwitansi_nilai=trim($_POST["jrawat_kwitansi_nilai"]);
		//kwitansi-2
		$jrawat_kwitansi_no2=trim($_POST["jrawat_kwitansi_no2"]);
		$jrawat_kwitansi_nama2=trim(@$_POST["jrawat_kwitansi_nama2"]);
		$jrawat_kwitansi_nama2=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_kwitansi_nama2);
		$jrawat_kwitansi_nama2=str_replace("'", '"',$jrawat_kwitansi_nama2);
		$jrawat_kwitansi_nilai2=trim($_POST["jrawat_kwitansi_nilai2"]);
		//kwitansi-3
		$jrawat_kwitansi_no3=trim($_POST["jrawat_kwitansi_no3"]);
		$jrawat_kwitansi_nama3=trim(@$_POST["jrawat_kwitansi_nama3"]);
		$jrawat_kwitansi_nama3=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_kwitansi_nama3);
		$jrawat_kwitansi_nama3=str_replace("'", '"',$jrawat_kwitansi_nama3);
		$jrawat_kwitansi_nilai3=trim($_POST["jrawat_kwitansi_nilai3"]);
		//cek
		$jrawat_cek_nama=trim($_POST["jrawat_cek_nama"]);
		$jrawat_cek_no=trim($_POST["jrawat_cek_no"]);
		$jrawat_cek_valid=trim($_POST["jrawat_cek_valid"]);
		$jrawat_cek_bank=trim($_POST["jrawat_cek_bank"]);
		$jrawat_cek_nilai=trim($_POST["jrawat_cek_nilai"]);
		//cek-2
		$jrawat_cek_nama2=trim($_POST["jrawat_cek_nama2"]);
		$jrawat_cek_no2=trim($_POST["jrawat_cek_no2"]);
		$jrawat_cek_valid2=trim($_POST["jrawat_cek_valid2"]);
		$jrawat_cek_bank2=trim($_POST["jrawat_cek_bank2"]);
		$jrawat_cek_nilai2=trim($_POST["jrawat_cek_nilai2"]);
		//cek-3
		$jrawat_cek_nama3=trim($_POST["jrawat_cek_nama3"]);
		$jrawat_cek_no3=trim($_POST["jrawat_cek_no3"]);
		$jrawat_cek_valid3=trim($_POST["jrawat_cek_valid3"]);
		$jrawat_cek_bank3=trim($_POST["jrawat_cek_bank3"]);
		$jrawat_cek_nilai3=trim($_POST["jrawat_cek_nilai3"]);
		//transfer
		$jrawat_transfer_bank=trim($_POST["jrawat_transfer_bank"]);
		$jrawat_transfer_nama=trim($_POST["jrawat_transfer_nama"]);
		$jrawat_transfer_nilai=trim($_POST["jrawat_transfer_nilai"]);
		//transfer-2
		$jrawat_transfer_bank2=trim($_POST["jrawat_transfer_bank2"]);
		$jrawat_transfer_nama2=trim($_POST["jrawat_transfer_nama2"]);
		$jrawat_transfer_nilai2=trim($_POST["jrawat_transfer_nilai2"]);
		//transfer-3
		$jrawat_transfer_bank3=trim($_POST["jrawat_transfer_bank3"]);
		$jrawat_transfer_nama3=trim($_POST["jrawat_transfer_nama3"]);
		$jrawat_transfer_nilai3=trim($_POST["jrawat_transfer_nilai3"]);
		
		$cetak_jrawat=trim($_POST["cetak_jrawat"]);
		
		
		$result = $this->m_master_jual_rawat->master_jual_rawat_update($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_stat_dok, $jrawat_diskon ,$jrawat_cara ,$jrawat_cara2 ,$jrawat_cara3 ,$jrawat_keterangan , $jrawat_cashback, $jrawat_tunai_nilai, $jrawat_tunai_nilai2, $jrawat_tunai_nilai3, $jrawat_voucher_no, $jrawat_voucher_cashback, $jrawat_voucher_no2, $jrawat_voucher_cashback2, $jrawat_voucher_no3, $jrawat_voucher_cashback3, $jrawat_total, $jrawat_bayar, $jrawat_subtotal, $jrawat_hutang, $jrawat_kwitansi_no, $jrawat_kwitansi_nama, $jrawat_kwitansi_nilai, $jrawat_kwitansi_no2, $jrawat_kwitansi_nama2, $jrawat_kwitansi_nilai2, $jrawat_kwitansi_no3, $jrawat_kwitansi_nama3, $jrawat_kwitansi_nilai3, $jrawat_card_nama, $jrawat_card_edc, $jrawat_card_no, $jrawat_card_nilai, $jrawat_card_nama2, $jrawat_card_edc2, $jrawat_card_no2, $jrawat_card_nilai2, $jrawat_card_nama3, $jrawat_card_edc3, $jrawat_card_no3, $jrawat_card_nilai3, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_cek_nilai, $jrawat_cek_nama2, $jrawat_cek_no2, $jrawat_cek_valid2, $jrawat_cek_bank2, $jrawat_cek_nilai2, $jrawat_cek_nama3, $jrawat_cek_no3, $jrawat_cek_valid3, $jrawat_cek_bank3, $jrawat_cek_nilai3, $jrawat_transfer_bank, $jrawat_transfer_nama, $jrawat_transfer_nilai, $jrawat_transfer_bank2, $jrawat_transfer_nama2, $jrawat_transfer_nilai2, $jrawat_transfer_bank3, $jrawat_transfer_nama3, $jrawat_transfer_nilai3 ,$cetak_jrawat);
		echo $result;
	}
	
	//function for create new record
	function master_jual_rawat_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		/*$jrawat_nobukti=trim(@$_POST["jrawat_nobukti"]);
		$jrawat_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_nobukti);
		$jrawat_nobukti=str_replace("'", '"',$jrawat_nobukti);*/
		$jrawat_cust=trim(@$_POST["jrawat_cust"]);
		$jrawat_tanggal=trim(@$_POST["jrawat_tanggal"]);
		$jrawat_diskon=trim(@$_POST["jrawat_diskon"]);
		$jrawat_cara=trim(@$_POST["jrawat_cara"]);
		$jrawat_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara);
		$jrawat_cara=str_replace("'", '"',$jrawat_cara);
		
		$jrawat_cara2=trim(@$_POST["jrawat_cara2"]);
		$jrawat_cara2=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara2);
		$jrawat_cara2=str_replace("'", '"',$jrawat_cara2);
		
		$jrawat_cara3=trim(@$_POST["jrawat_cara3"]);
		$jrawat_cara3=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara3);
		$jrawat_cara3=str_replace("'", '"',$jrawat_cara3);
		
		$jrawat_keterangan=trim(@$_POST["jrawat_keterangan"]);
		$jrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_keterangan);
		$jrawat_keterangan=str_replace("'", '"',$jrawat_keterangan);
		
		$jrawat_stat_dok=trim(@$_POST["jrawat_stat_dok"]);
		$jrawat_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_stat_dok);
		$jrawat_stat_dok=str_replace("'", '"',$jrawat_stat_dok);
		
		$jrawat_cashback=trim($_POST["jrawat_cashback"]);
		//$jrawat_voucher=trim($_POST["jrawat_voucher"]);
		//tunai
		$jrawat_tunai_nilai=trim($_POST["jrawat_tunai_nilai"]);
		//tunai-2
		$jrawat_tunai_nilai2=trim($_POST["jrawat_tunai_nilai2"]);
		//tunai-3
		$jrawat_tunai_nilai3=trim($_POST["jrawat_tunai_nilai3"]);
		//voucher
		$jrawat_voucher_no=trim($_POST["jrawat_voucher_no"]);
		$jrawat_voucher_cashback=trim($_POST["jrawat_voucher_cashback"]);
		//voucher-2
		$jrawat_voucher_no2=trim($_POST["jrawat_voucher_no2"]);
		$jrawat_voucher_cashback2=trim($_POST["jrawat_voucher_cashback2"]);
		//voucher-3
		$jrawat_voucher_no3=trim($_POST["jrawat_voucher_no3"]);
		$jrawat_voucher_cashback3=trim($_POST["jrawat_voucher_cashback3"]);
		//bayar
		$jrawat_bayar=trim($_POST["jrawat_bayar"]);
		$jrawat_subtotal=trim($_POST["jrawat_subtotal"]);
		$jrawat_hutang=trim($_POST["jrawat_hutang"]);
		//if($jrawat_cara=='tunai')
			//$jrawat_bayar=$jrawat_subtotal;
		//card
		$jrawat_card_nama=trim($_POST["jrawat_card_nama"]);
		$jrawat_card_edc=trim($_POST["jrawat_card_edc"]);
		$jrawat_card_no=trim($_POST["jrawat_card_no"]);
		$jrawat_card_nilai=trim($_POST["jrawat_card_nilai"]);
		//card-2
		$jrawat_card_nama2=trim($_POST["jrawat_card_nama2"]);
		$jrawat_card_edc2=trim($_POST["jrawat_card_edc2"]);
		$jrawat_card_no2=trim($_POST["jrawat_card_no2"]);
		$jrawat_card_nilai2=trim($_POST["jrawat_card_nilai2"]);
		//card-3
		$jrawat_card_nama3=trim($_POST["jrawat_card_nama3"]);
		$jrawat_card_edc3=trim($_POST["jrawat_card_edc3"]);
		$jrawat_card_no3=trim($_POST["jrawat_card_no3"]);
		$jrawat_card_nilai3=trim($_POST["jrawat_card_nilai3"]);
		//kwitansi
		$jrawat_kwitansi_no=trim($_POST["jrawat_kwitansi_no"]);
		$jrawat_kwitansi_nama=trim(@$_POST["jrawat_kwitansi_nama"]);
		$jrawat_kwitansi_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_kwitansi_nama);
		$jrawat_kwitansi_nama=str_replace("'", '"',$jrawat_kwitansi_nama);
		$jrawat_kwitansi_nilai=trim($_POST["jrawat_kwitansi_nilai"]);
		//kwitansi-2
		$jrawat_kwitansi_no2=trim($_POST["jrawat_kwitansi_no2"]);
		$jrawat_kwitansi_nama2=trim(@$_POST["jrawat_kwitansi_nama2"]);
		$jrawat_kwitansi_nama2=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_kwitansi_nama2);
		$jrawat_kwitansi_nama2=str_replace("'", '"',$jrawat_kwitansi_nama2);
		$jrawat_kwitansi_nilai2=trim($_POST["jrawat_kwitansi_nilai2"]);
		//kwitansi-3
		$jrawat_kwitansi_no3=trim($_POST["jrawat_kwitansi_no3"]);
		$jrawat_kwitansi_nama3=trim(@$_POST["jrawat_kwitansi_nama3"]);
		$jrawat_kwitansi_nama3=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_kwitansi_nama3);
		$jrawat_kwitansi_nama3=str_replace("'", '"',$jrawat_kwitansi_nama3);
		$jrawat_kwitansi_nilai3=trim($_POST["jrawat_kwitansi_nilai3"]);
		//cek
		$jrawat_cek_nama=trim($_POST["jrawat_cek_nama"]);
		$jrawat_cek_no=trim($_POST["jrawat_cek_no"]);
		$jrawat_cek_valid=trim($_POST["jrawat_cek_valid"]);
		$jrawat_cek_bank=trim($_POST["jrawat_cek_bank"]);
		$jrawat_cek_nilai=trim($_POST["jrawat_cek_nilai"]);
		//cek-2
		$jrawat_cek_nama2=trim($_POST["jrawat_cek_nama2"]);
		$jrawat_cek_no2=trim($_POST["jrawat_cek_no2"]);
		$jrawat_cek_valid2=trim($_POST["jrawat_cek_valid2"]);
		$jrawat_cek_bank2=trim($_POST["jrawat_cek_bank2"]);
		$jrawat_cek_nilai2=trim($_POST["jrawat_cek_nilai2"]);
		//cek-3
		$jrawat_cek_nama3=trim($_POST["jrawat_cek_nama3"]);
		$jrawat_cek_no3=trim($_POST["jrawat_cek_no3"]);
		$jrawat_cek_valid3=trim($_POST["jrawat_cek_valid3"]);
		$jrawat_cek_bank3=trim($_POST["jrawat_cek_bank3"]);
		$jrawat_cek_nilai3=trim($_POST["jrawat_cek_nilai3"]);
		//transfer
		$jrawat_transfer_bank=trim($_POST["jrawat_transfer_bank"]);
		$jrawat_transfer_nama=trim($_POST["jrawat_transfer_nama"]);
		$jrawat_transfer_nilai=trim($_POST["jrawat_transfer_nilai"]);
		//transfer-2
		$jrawat_transfer_bank2=trim($_POST["jrawat_transfer_bank2"]);
		$jrawat_transfer_nama2=trim($_POST["jrawat_transfer_nama2"]);
		$jrawat_transfer_nilai2=trim($_POST["jrawat_transfer_nilai2"]);
		//transfer-3
		$jrawat_transfer_bank3=trim($_POST["jrawat_transfer_bank3"]);
		$jrawat_transfer_nama3=trim($_POST["jrawat_transfer_nama3"]);
		$jrawat_transfer_nilai3=trim($_POST["jrawat_transfer_nilai3"]);
				
		$result=$this->m_master_jual_rawat->master_jual_rawat_create($jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_stat_dok, $jrawat_cara2 ,$jrawat_cara3 ,$jrawat_keterangan , $jrawat_cashback, $jrawat_tunai_nilai, $jrawat_tunai_nilai2, $jrawat_tunai_nilai3, $jrawat_voucher_no, $jrawat_voucher_cashback, $jrawat_voucher_no2, $jrawat_voucher_cashback2, $jrawat_voucher_no3, $jrawat_voucher_cashback3, $jrawat_bayar, $jrawat_subtotal, $jrawat_hutang, $jrawat_kwitansi_no, $jrawat_kwitansi_nama, $jrawat_kwitansi_nilai, $jrawat_kwitansi_no2, $jrawat_kwitansi_nama2, $jrawat_kwitansi_nilai2, $jrawat_kwitansi_no3, $jrawat_kwitansi_nama3, $jrawat_kwitansi_nilai3, $jrawat_card_nama, $jrawat_card_edc, $jrawat_card_no, $jrawat_card_nilai, $jrawat_card_nama2, $jrawat_card_edc2, $jrawat_card_no2, $jrawat_card_nilai2, $jrawat_card_nama3, $jrawat_card_edc3, $jrawat_card_no3, $jrawat_card_nilai3, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_cek_nilai, $jrawat_cek_nama2, $jrawat_cek_no2, $jrawat_cek_valid2, $jrawat_cek_bank2, $jrawat_cek_nilai2, $jrawat_cek_nama3, $jrawat_cek_no3, $jrawat_cek_valid3, $jrawat_cek_bank3, $jrawat_cek_nilai3, $jrawat_transfer_bank, $jrawat_transfer_nama, $jrawat_transfer_nilai, $jrawat_transfer_bank2, $jrawat_transfer_nama2, $jrawat_transfer_nilai2, $jrawat_transfer_bank3, $jrawat_transfer_nama3, $jrawat_transfer_nilai3);
		echo $result;
	}

	//function for delete selected record
	function master_jual_rawat_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_jual_rawat->master_jual_rawat_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_jual_rawat_search(){
		//POST varibale here
		$jrawat_id=trim(@$_POST["jrawat_id"]);
		$jrawat_nobukti=trim(@$_POST["jrawat_nobukti"]);
		$jrawat_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_nobukti);
		$jrawat_nobukti=str_replace("'", '"',$jrawat_nobukti);
		$jrawat_cust=trim(@$_POST["jrawat_cust"]);
		$jrawat_diskon=trim(@$_POST["jrawat_diskon"]);
		$jrawat_cashback=trim(@$_POST["jrawat_cashback"]);
		$jrawat_voucher=trim(@$_POST["jrawat_voucher"]);
		$jrawat_voucher=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_voucher);
		$jrawat_voucher=str_replace("'", '"',$jrawat_voucher);
		$jrawat_cara=trim(@$_POST["jrawat_cara"]);
		$jrawat_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara);
		$jrawat_cara=str_replace("'", '"',$jrawat_cara);
		$jrawat_bayar=trim(@$_POST["jrawat_bayar"]);
		$jrawat_keterangan=trim(@$_POST["jrawat_keterangan"]);
		$jrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_keterangan);
		$jrawat_keterangan=str_replace("'", '"',$jrawat_keterangan);
		$jrawat_stat_dok=trim(@$_POST["jrawat_stat_dok"]);
		$jrawat_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_stat_dok);
		$jrawat_stat_dok=str_replace("'", '"',$jrawat_stat_dok);
		
		$jrawat_tgl_start=trim(@$_POST["jrawat_tgl_start"]);
		$jrawat_tgl_end=trim(@$_POST["jrawat_tgl_end"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_jual_rawat->master_jual_rawat_search($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_diskon , $jrawat_stat_dok, $jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$jrawat_tgl_start ,$jrawat_tgl_end ,$start,$end);
		echo $result;
	}


	function master_jual_rawat_print(){
  		//POST varibale here
		$jrawat_id=trim(@$_POST["jrawat_id"]);
		$jrawat_nobukti=trim(@$_POST["jrawat_nobukti"]);
		$jrawat_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_nobukti);
		$jrawat_nobukti=str_replace("'", '"',$jrawat_nobukti);
		$jrawat_cust=trim(@$_POST["jrawat_cust"]);
		$jrawat_tanggal=trim(@$_POST["jrawat_tanggal"]);
		$jrawat_diskon=trim(@$_POST["jrawat_diskon"]);
		$jrawat_cashback=trim(@$_POST["jrawat_cashback"]);
		$jrawat_voucher=trim(@$_POST["jrawat_voucher"]);
		$jrawat_voucher=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_voucher);
		$jrawat_voucher=str_replace("'", '"',$jrawat_voucher);
		$jrawat_cara=trim(@$_POST["jrawat_cara"]);
		$jrawat_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara);
		$jrawat_cara=str_replace("'", '"',$jrawat_cara);
		$jrawat_bayar=trim(@$_POST["jrawat_bayar"]);
		$jrawat_keterangan=trim(@$_POST["jrawat_keterangan"]);
		$jrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_keterangan);
		$jrawat_keterangan=str_replace("'", '"',$jrawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_jual_rawat->master_jual_rawat_print($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=15;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_jual_rawatlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_jual_rawat Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_jual_rawat List'><caption>MASTER_JUAL_RAWAT</caption><thead><tr><th scope='col'>Jrawat Id</th><th scope='col'>Jrawat Nobukti</th><th scope='col'>Jrawat Cust</th><th scope='col'>Jrawat Tanggal</th><th scope='col'>Jrawat Diskon</th><th scope='col'>Jrawat Cashback</th><th scope='col'>Jrawat Voucher</th><th scope='col'>Jrawat Cara</th><th scope='col'>Jrawat Bayar</th><th scope='col'>Jrawat Keterangan</th><th scope='col'>Jrawat Creator</th><th scope='col'>Jrawat Date Create</th><th scope='col'>Jrawat Update</th><th scope='col'>Jrawat Date Update</th><th scope='col'>Jrawat Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_jual_rawat</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jrawat_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jrawat_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_cashback']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_voucher']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_cara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_bayar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jrawat_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jrawat_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jrawat_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jrawat_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jrawat_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_jual_rawat_export_excel(){
		//POST varibale here
		$jrawat_id=trim(@$_POST["jrawat_id"]);
		$jrawat_nobukti=trim(@$_POST["jrawat_nobukti"]);
		$jrawat_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_nobukti);
		$jrawat_nobukti=str_replace("'", '"',$jrawat_nobukti);
		$jrawat_cust=trim(@$_POST["jrawat_cust"]);
		$jrawat_tanggal=trim(@$_POST["jrawat_tanggal"]);
		$jrawat_diskon=trim(@$_POST["jrawat_diskon"]);
		$jrawat_cashback=trim(@$_POST["jrawat_cashback"]);
		$jrawat_voucher=trim(@$_POST["jrawat_voucher"]);
		$jrawat_voucher=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_voucher);
		$jrawat_voucher=str_replace("'", '"',$jrawat_voucher);
		$jrawat_cara=trim(@$_POST["jrawat_cara"]);
		$jrawat_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_cara);
		$jrawat_cara=str_replace("'", '"',$jrawat_cara);
		$jrawat_bayar=trim(@$_POST["jrawat_bayar"]);
		$jrawat_keterangan=trim(@$_POST["jrawat_keterangan"]);
		$jrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jrawat_keterangan);
		$jrawat_keterangan=str_replace("'", '"',$jrawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_jual_rawat->master_jual_rawat_export_excel($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$option,$filter);
		
		to_excel($query,"master_jual_rawat"); 
		echo '1';
			
	}
	
	function print_paper(){
  		//POST varibale here
		$jrawat_id=trim(@$_POST["jrawat_id"]);
		
		$result = $this->m_master_jual_rawat->print_paper($jrawat_id);
		$rs=$result->row();
		$detail_jrawat=$result->result();
		$data['jrawat_nobukti']=$rs->jrawat_nobukti;
		$data['jrawat_tanggal']=$rs->jrawat_tanggal;
		$data['cust_no']=$rs->cust_no;
		$data['cust_nama']=$rs->cust_nama;
		$data['cust_alamat']=$rs->cust_alamat;
		$data['jumlah_subtotal']=ubah_rupiah($rs->jumlah_subtotal);
		$data['jumlah_tunai']=ubah_rupiah($rs->jtunai_nilai);
		$data['jrawat_diskon']=$rs->jrawat_diskon;
		$data['jrawat_cashback']=$rs->jrawat_cashback;
		//$data['jrawat_creator']=$rs->jrawat_creator;
		//$data['jrawat_totalbiaya']=$rs->jrawat_totalbiaya;
		$data['detail_jrawat']=$detail_jrawat;
		
		$viewdata=$this->load->view("main/jrawat_formcetak",$data,TRUE);
		$file = fopen("jrawat_paper.html",'w');
		fwrite($file, $viewdata);	
		fclose($file);
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