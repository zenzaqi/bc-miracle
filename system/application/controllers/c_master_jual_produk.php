<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_jual_produk Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_jual_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
*/

//class of master_jual_produk
class C_master_jual_produk extends Controller {

	//constructor
	function C_master_jual_produk(){
		parent::Controller();
		$this->load->model('m_master_jual_produk', '', TRUE);
		$this->load->plugin('to_excel');
		$this->load->library('firephp');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_jual_produk');
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
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_produk_list($query,$start,$end);
		echo $result;
	}
	
	function get_satuan_list(){
		$result = $this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	function get_satuan_bydjproduk_list(){
		$djproduk_id = (integer) (isset($_POST['djproduk_id']) ? $_POST['djproduk_id'] : $_GET['djproduk_id']);
		$result = $this->m_public_function->get_satuan_bydjproduk_list($djproduk_id);
		echo $result;
	}
	
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
	
	function  get_voucher_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_jual_produk->get_voucher_list($query,$start,$end);
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
	function  detail_detail_jual_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jual_produk->detail_detail_jual_produk_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_jual_produk_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_jual_produk->detail_detail_jual_produk_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_jual_produk->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_jual_produk_insert(){
	//POST variable here
		$dproduk_id=trim(@$_POST["dproduk_id"]);
		$dproduk_master=trim(@$_POST["dproduk_master"]);
		$dproduk_produk=trim(@$_POST["dproduk_produk"]);
		$dproduk_satuan=trim(@$_POST["dproduk_satuan"]);
		$dproduk_jumlah=trim(@$_POST["dproduk_jumlah"]);
		$dproduk_harga=trim(@$_POST["dproduk_harga"]);
		$dproduk_subtotal_net=trim(@$_POST["dproduk_subtotal_net"]);
		$dproduk_diskon=trim(@$_POST["dproduk_diskon"]);
		$dproduk_diskon_jenis=trim(@$_POST["dproduk_diskon_jenis"]);
		$dproduk_sales=trim(@$_POST["dproduk_sales"]);
		$result=$this->m_master_jual_produk->detail_detail_jual_produk_insert($dproduk_id ,$dproduk_master ,$dproduk_produk ,$dproduk_satuan ,$dproduk_jumlah ,$dproduk_harga ,$dproduk_subtotal_net ,$dproduk_diskon,$dproduk_diskon_jenis,$dproduk_sales );
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_jual_produk_list();
				break;
			case "UPDATE":
				$this->master_jual_produk_update();
				break;
			case "CREATE":
				$this->master_jual_produk_create();
				break;
			case "DELETE":
				$this->master_jual_produk_delete();
				break;
			case "SEARCH":
				$this->master_jual_produk_search();
				break;
			case "PRINT":
				$this->master_jual_produk_print();
				break;
			case "EXCEL":
				$this->master_jual_produk_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_jual_produk_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_jual_produk->master_jual_produk_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_jual_produk_update(){
		//POST variable here
		$jproduk_id=trim(@$_POST["jproduk_id"]);
		$jproduk_nobukti=trim(@$_POST["jproduk_nobukti"]);
		$jproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_nobukti);
		$jproduk_nobukti=str_replace("'", '"',$jproduk_nobukti);
		$jproduk_cust=trim(@$_POST["jproduk_cust"]);
		$jproduk_tanggal=trim(@$_POST["jproduk_tanggal"]);
		$jproduk_diskon=trim(@$_POST["jproduk_diskon"]);
		$jproduk_cara=trim(@$_POST["jproduk_cara"]);
		$jproduk_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara);
		$jproduk_cara=str_replace("'", '"',$jproduk_cara);
		
		$jproduk_cara2=trim(@$_POST["jproduk_cara2"]);
		$jproduk_cara2=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara2);
		$jproduk_cara2=str_replace("'", '"',$jproduk_cara2);
		
		$jproduk_cara3=trim(@$_POST["jproduk_cara3"]);
		$jproduk_cara3=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara3);
		$jproduk_cara3=str_replace("'", '"',$jproduk_cara3);
		
		$jproduk_keterangan=trim(@$_POST["jproduk_keterangan"]);
		$jproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_keterangan);
		$jproduk_keterangan=str_replace("'", '"',$jproduk_keterangan);
		$jproduk_cashback=trim($_POST["jproduk_cashback"]);
		
		//tunai
		$jproduk_tunai_nilai=trim($_POST["jproduk_tunai_nilai"]);
		//tunai-2
		$jproduk_tunai_nilai2=trim($_POST["jproduk_tunai_nilai2"]);
		//tunai-3
		$jproduk_tunai_nilai3=trim($_POST["jproduk_tunai_nilai3"]);
		//voucher
		$jproduk_voucher_no=trim($_POST["jproduk_voucher_no"]);
		$jproduk_voucher_cashback=trim($_POST["jproduk_voucher_cashback"]);
		//voucher-2
		$jproduk_voucher_no2=trim($_POST["jproduk_voucher_no2"]);
		$jproduk_voucher_cashback2=trim($_POST["jproduk_voucher_cashback2"]);
		//voucher-3
		$jproduk_voucher_no3=trim($_POST["jproduk_voucher_no3"]);
		$jproduk_voucher_cashback3=trim($_POST["jproduk_voucher_cashback3"]);
		
		//bayar
		$jproduk_bayar=trim($_POST["jproduk_bayar"]);
		$jproduk_subtotal=trim($_POST["jproduk_subtotal"]);
		$jproduk_hutang=trim($_POST["jproduk_hutang"]);
		//if($jproduk_cara=='tunai')
			//$jproduk_bayar=$jproduk_subtotal;
		//card
		$jproduk_card_nama=trim($_POST["jproduk_card_nama"]);
		$jproduk_card_edc=trim($_POST["jproduk_card_edc"]);
		$jproduk_card_no=trim($_POST["jproduk_card_no"]);
		$jproduk_card_nilai=trim($_POST["jproduk_card_nilai"]);
		//card-2
		$jproduk_card_nama2=trim($_POST["jproduk_card_nama2"]);
		$jproduk_card_edc2=trim($_POST["jproduk_card_edc2"]);
		$jproduk_card_no2=trim($_POST["jproduk_card_no2"]);
		$jproduk_card_nilai2=trim($_POST["jproduk_card_nilai2"]);
		//card-3
		$jproduk_card_nama3=trim($_POST["jproduk_card_nama3"]);
		$jproduk_card_edc3=trim($_POST["jproduk_card_edc3"]);
		$jproduk_card_no3=trim($_POST["jproduk_card_no3"]);
		$jproduk_card_nilai3=trim($_POST["jproduk_card_nilai3"]);
		//kwitansi
		$jproduk_kwitansi_no=trim($_POST["jproduk_kwitansi_no"]);
		$jproduk_kwitansi_nama=trim(@$_POST["jproduk_kwitansi_nama"]);
		$jproduk_kwitansi_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_kwitansi_nama);
		$jproduk_kwitansi_nama=str_replace("'", '"',$jproduk_kwitansi_nama);
		$jproduk_kwitansi_nilai=trim($_POST["jproduk_kwitansi_nilai"]);
		//kwitansi-2
		$jproduk_kwitansi_no2=trim($_POST["jproduk_kwitansi_no2"]);
		$jproduk_kwitansi_nama2=trim(@$_POST["jproduk_kwitansi_nama2"]);
		$jproduk_kwitansi_nama2=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_kwitansi_nama2);
		$jproduk_kwitansi_nama2=str_replace("'", '"',$jproduk_kwitansi_nama2);
		$jproduk_kwitansi_nilai2=trim($_POST["jproduk_kwitansi_nilai2"]);
		//kwitansi-3
		$jproduk_kwitansi_no3=trim($_POST["jproduk_kwitansi_no3"]);
		$jproduk_kwitansi_nama3=trim(@$_POST["jproduk_kwitansi_nama3"]);
		$jproduk_kwitansi_nama3=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_kwitansi_nama3);
		$jproduk_kwitansi_nama3=str_replace("'", '"',$jproduk_kwitansi_nama3);
		$jproduk_kwitansi_nilai3=trim($_POST["jproduk_kwitansi_nilai3"]);
		//cek
		$jproduk_cek_nama=trim($_POST["jproduk_cek_nama"]);
		$jproduk_cek_no=trim($_POST["jproduk_cek_no"]);
		$jproduk_cek_valid=trim($_POST["jproduk_cek_valid"]);
		$jproduk_cek_bank=trim($_POST["jproduk_cek_bank"]);
		$jproduk_cek_nilai=trim($_POST["jproduk_cek_nilai"]);
		//cek-2
		$jproduk_cek_nama2=trim($_POST["jproduk_cek_nama2"]);
		$jproduk_cek_no2=trim($_POST["jproduk_cek_no2"]);
		$jproduk_cek_valid2=trim($_POST["jproduk_cek_valid2"]);
		$jproduk_cek_bank2=trim($_POST["jproduk_cek_bank2"]);
		$jproduk_cek_nilai2=trim($_POST["jproduk_cek_nilai2"]);
		//cek-3
		$jproduk_cek_nama3=trim($_POST["jproduk_cek_nama3"]);
		$jproduk_cek_no3=trim($_POST["jproduk_cek_no3"]);
		$jproduk_cek_valid3=trim($_POST["jproduk_cek_valid3"]);
		$jproduk_cek_bank3=trim($_POST["jproduk_cek_bank3"]);
		$jproduk_cek_nilai3=trim($_POST["jproduk_cek_nilai3"]);
		//transfer
		$jproduk_transfer_bank=trim($_POST["jproduk_transfer_bank"]);
		$jproduk_transfer_nama=trim($_POST["jproduk_transfer_nama"]);
		$jproduk_transfer_nilai=trim($_POST["jproduk_transfer_nilai"]);
		//transfer-2
		$jproduk_transfer_bank2=trim($_POST["jproduk_transfer_bank2"]);
		$jproduk_transfer_nama2=trim($_POST["jproduk_transfer_nama2"]);
		$jproduk_transfer_nilai2=trim($_POST["jproduk_transfer_nilai2"]);
		//transfer-3
		$jproduk_transfer_bank3=trim($_POST["jproduk_transfer_bank3"]);
		$jproduk_transfer_nama3=trim($_POST["jproduk_transfer_nama3"]);
		$jproduk_transfer_nilai3=trim($_POST["jproduk_transfer_nilai3"]);
		
		
		$result = $this->m_master_jual_produk->master_jual_produk_update($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_tunai_nilai, $jproduk_tunai_nilai2, $jproduk_tunai_nilai3, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_subtotal, $jproduk_hutang, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_no, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_no2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_no3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nama, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nama2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nama3, $jproduk_transfer_nilai3);
		echo $result;
	}
	
	//function for create new record
	function master_jual_produk_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jproduk_nobukti=trim(@$_POST["jproduk_nobukti"]);
		$jproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_nobukti);
		$jproduk_nobukti=str_replace("'", '"',$jproduk_nobukti);
		$jproduk_cust=trim(@$_POST["jproduk_cust"]);
		$jproduk_tanggal=trim(@$_POST["jproduk_tanggal"]);
		$jproduk_diskon=trim(@$_POST["jproduk_diskon"]);
		$jproduk_cara=trim(@$_POST["jproduk_cara"]);
		$jproduk_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara);
		$jproduk_cara=str_replace("'", '"',$jproduk_cara);
		
		$jproduk_cara2=trim(@$_POST["jproduk_cara2"]);
		$jproduk_cara2=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara2);
		$jproduk_cara2=str_replace("'", '"',$jproduk_cara2);
		
		$jproduk_cara3=trim(@$_POST["jproduk_cara3"]);
		$jproduk_cara3=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara3);
		$jproduk_cara3=str_replace("'", '"',$jproduk_cara3);
		
		$jproduk_keterangan=trim(@$_POST["jproduk_keterangan"]);
		$jproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_keterangan);
		$jproduk_keterangan=str_replace("'", '"',$jproduk_keterangan);
		$jproduk_cashback=trim($_POST["jproduk_cashback"]);
		//$jproduk_voucher=trim($_POST["jproduk_voucher"]);
		//tunai
		$jproduk_tunai_nilai=trim($_POST["jproduk_tunai_nilai"]);
		//tunai-2
		$jproduk_tunai_nilai2=trim($_POST["jproduk_tunai_nilai2"]);
		//tunai-3
		$jproduk_tunai_nilai3=trim($_POST["jproduk_tunai_nilai3"]);
		//voucher
		$jproduk_voucher_no=trim($_POST["jproduk_voucher_no"]);
		$jproduk_voucher_cashback=trim($_POST["jproduk_voucher_cashback"]);
		//voucher-2
		$jproduk_voucher_no2=trim($_POST["jproduk_voucher_no2"]);
		$jproduk_voucher_cashback2=trim($_POST["jproduk_voucher_cashback2"]);
		//voucher-3
		$jproduk_voucher_no3=trim($_POST["jproduk_voucher_no3"]);
		$jproduk_voucher_cashback3=trim($_POST["jproduk_voucher_cashback3"]);
		//bayar
		$jproduk_bayar=trim($_POST["jproduk_bayar"]);
		$jproduk_subtotal=trim($_POST["jproduk_subtotal"]);
		$jproduk_hutang=trim($_POST["jproduk_hutang"]);
		//if($jproduk_cara=='tunai')
			//$jproduk_bayar=$jproduk_subtotal;
		//card
		$jproduk_card_nama=trim($_POST["jproduk_card_nama"]);
		$jproduk_card_edc=trim($_POST["jproduk_card_edc"]);
		$jproduk_card_no=trim($_POST["jproduk_card_no"]);
		$jproduk_card_nilai=trim($_POST["jproduk_card_nilai"]);
		//card-2
		$jproduk_card_nama2=trim($_POST["jproduk_card_nama2"]);
		$jproduk_card_edc2=trim($_POST["jproduk_card_edc2"]);
		$jproduk_card_no2=trim($_POST["jproduk_card_no2"]);
		$jproduk_card_nilai2=trim($_POST["jproduk_card_nilai2"]);
		//card-3
		$jproduk_card_nama3=trim($_POST["jproduk_card_nama3"]);
		$jproduk_card_edc3=trim($_POST["jproduk_card_edc3"]);
		$jproduk_card_no3=trim($_POST["jproduk_card_no3"]);
		$jproduk_card_nilai3=trim($_POST["jproduk_card_nilai3"]);
		//kwitansi
		$jproduk_kwitansi_no=trim($_POST["jproduk_kwitansi_no"]);
		$jproduk_kwitansi_nama=trim(@$_POST["jproduk_kwitansi_nama"]);
		$jproduk_kwitansi_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_kwitansi_nama);
		$jproduk_kwitansi_nama=str_replace("'", '"',$jproduk_kwitansi_nama);
		$jproduk_kwitansi_nilai=trim($_POST["jproduk_kwitansi_nilai"]);
		//kwitansi-2
		$jproduk_kwitansi_no2=trim($_POST["jproduk_kwitansi_no2"]);
		$jproduk_kwitansi_nama2=trim(@$_POST["jproduk_kwitansi_nama2"]);
		$jproduk_kwitansi_nama2=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_kwitansi_nama2);
		$jproduk_kwitansi_nama2=str_replace("'", '"',$jproduk_kwitansi_nama2);
		$jproduk_kwitansi_nilai2=trim($_POST["jproduk_kwitansi_nilai2"]);
		//kwitansi-3
		$jproduk_kwitansi_no3=trim($_POST["jproduk_kwitansi_no3"]);
		$jproduk_kwitansi_nama3=trim(@$_POST["jproduk_kwitansi_nama3"]);
		$jproduk_kwitansi_nama3=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_kwitansi_nama3);
		$jproduk_kwitansi_nama3=str_replace("'", '"',$jproduk_kwitansi_nama3);
		$jproduk_kwitansi_nilai3=trim($_POST["jproduk_kwitansi_nilai3"]);
		//cek
		$jproduk_cek_nama=trim($_POST["jproduk_cek_nama"]);
		$jproduk_cek_no=trim($_POST["jproduk_cek_no"]);
		$jproduk_cek_valid=trim($_POST["jproduk_cek_valid"]);
		$jproduk_cek_bank=trim($_POST["jproduk_cek_bank"]);
		$jproduk_cek_nilai=trim($_POST["jproduk_cek_nilai"]);
		//cek-2
		$jproduk_cek_nama2=trim($_POST["jproduk_cek_nama2"]);
		$jproduk_cek_no2=trim($_POST["jproduk_cek_no2"]);
		$jproduk_cek_valid2=trim($_POST["jproduk_cek_valid2"]);
		$jproduk_cek_bank2=trim($_POST["jproduk_cek_bank2"]);
		$jproduk_cek_nilai2=trim($_POST["jproduk_cek_nilai2"]);
		//cek-3
		$jproduk_cek_nama3=trim($_POST["jproduk_cek_nama3"]);
		$jproduk_cek_no3=trim($_POST["jproduk_cek_no3"]);
		$jproduk_cek_valid3=trim($_POST["jproduk_cek_valid3"]);
		$jproduk_cek_bank3=trim($_POST["jproduk_cek_bank3"]);
		$jproduk_cek_nilai3=trim($_POST["jproduk_cek_nilai3"]);
		//transfer
		$jproduk_transfer_bank=trim($_POST["jproduk_transfer_bank"]);
		$jproduk_transfer_nama=trim($_POST["jproduk_transfer_nama"]);
		$jproduk_transfer_nilai=trim($_POST["jproduk_transfer_nilai"]);
		//transfer-2
		$jproduk_transfer_bank2=trim($_POST["jproduk_transfer_bank2"]);
		$jproduk_transfer_nama2=trim($_POST["jproduk_transfer_nama2"]);
		$jproduk_transfer_nilai2=trim($_POST["jproduk_transfer_nilai2"]);
		//transfer-3
		$jproduk_transfer_bank3=trim($_POST["jproduk_transfer_bank3"]);
		$jproduk_transfer_nama3=trim($_POST["jproduk_transfer_nama3"]);
		$jproduk_transfer_nilai3=trim($_POST["jproduk_transfer_nilai3"]);
				
		$result=$this->m_master_jual_produk->master_jual_produk_create($jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_tunai_nilai, $jproduk_tunai_nilai2, $jproduk_tunai_nilai3, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_subtotal, $jproduk_hutang, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_no, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_no2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_no3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nama, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nama2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nama3, $jproduk_transfer_nilai3);
		echo $result;
	}

	//function for delete selected record
	function master_jual_produk_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_jual_produk->master_jual_produk_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_jual_produk_search(){
		//POST varibale here
		$jproduk_id=trim(@$_POST["jproduk_id"]);
		$jproduk_nobukti=trim(@$_POST["jproduk_nobukti"]);
		$jproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_nobukti);
		$jproduk_nobukti=str_replace("'", '"',$jproduk_nobukti);
		$jproduk_cust=trim(@$_POST["jproduk_cust"]);
		$jproduk_tanggal=trim(@$_POST["jproduk_tanggal"]);
		$jproduk_diskon=trim(@$_POST["jproduk_diskon"]);
		$jproduk_cara=trim(@$_POST["jproduk_cara"]);
		$jproduk_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara);
		$jproduk_cara=str_replace("'", '"',$jproduk_cara);
		$jproduk_keterangan=trim(@$_POST["jproduk_keterangan"]);
		$jproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_keterangan);
		$jproduk_keterangan=str_replace("'", '"',$jproduk_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_jual_produk->master_jual_produk_search($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$start,$end);
		echo $result;
	}


	function master_jual_produk_print(){
  		//POST varibale here
		$jproduk_id=trim(@$_POST["jproduk_id"]);
		$jproduk_nobukti=trim(@$_POST["jproduk_nobukti"]);
		$jproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_nobukti);
		$jproduk_nobukti=str_replace("'", '"',$jproduk_nobukti);
		$jproduk_cust=trim(@$_POST["jproduk_cust"]);
		$jproduk_tanggal=trim(@$_POST["jproduk_tanggal"]);
		$jproduk_diskon=trim(@$_POST["jproduk_diskon"]);
		$jproduk_cara=trim(@$_POST["jproduk_cara"]);
		$jproduk_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara);
		$jproduk_cara=str_replace("'", '"',$jproduk_cara);
		$jproduk_keterangan=trim(@$_POST["jproduk_keterangan"]);
		$jproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_keterangan);
		$jproduk_keterangan=str_replace("'", '"',$jproduk_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_jual_produk->master_jual_produk_print($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=12;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_jual_produklist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_jual_produk Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_jual_produk List'><caption>MASTER_JUAL_PRODUK</caption><thead><tr><th scope='col'>Jproduk Id</th><th scope='col'>Jproduk Nobukti</th><th scope='col'>Jproduk Cust</th><th scope='col'>Jproduk Tanggal</th><th scope='col'>Jproduk Diskon</th><th scope='col'>Jproduk Cara</th><th scope='col'>Jproduk Keterangan</th><th scope='col'>Jproduk Creator</th><th scope='col'>Jproduk Date Create</th><th scope='col'>Jproduk Update</th><th scope='col'>Jproduk Date Update</th><th scope='col'>Jproduk Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_jual_produk</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jproduk_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jproduk_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jproduk_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jproduk_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jproduk_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jproduk_cara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jproduk_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jproduk_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jproduk_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jproduk_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jproduk_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jproduk_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_jual_produk_export_excel(){
		//POST varibale here
		$jproduk_id=trim(@$_POST["jproduk_id"]);
		$jproduk_nobukti=trim(@$_POST["jproduk_nobukti"]);
		$jproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_nobukti);
		$jproduk_nobukti=str_replace("'", '"',$jproduk_nobukti);
		$jproduk_cust=trim(@$_POST["jproduk_cust"]);
		$jproduk_tanggal=trim(@$_POST["jproduk_tanggal"]);
		$jproduk_diskon=trim(@$_POST["jproduk_diskon"]);
		$jproduk_cara=trim(@$_POST["jproduk_cara"]);
		$jproduk_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_cara);
		$jproduk_cara=str_replace("'", '"',$jproduk_cara);
		$jproduk_keterangan=trim(@$_POST["jproduk_keterangan"]);
		$jproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jproduk_keterangan);
		$jproduk_keterangan=str_replace("'", '"',$jproduk_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_jual_produk->master_jual_produk_export_excel($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$option,$filter);
		
		to_excel($query,"master_jual_produk"); 
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