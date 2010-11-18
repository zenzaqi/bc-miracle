<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: stok_mutasi Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_stok_mutasi.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
	
*/

//class of stok_mutasi
class C_stok_mutasi extends Controller {

	//constructor
	function C_stok_mutasi(){
		parent::Controller();
		session_start();
		$this->load->model('m_stok_mutasi', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_stok_mutasi');
	}
	
	//event handler action
	function get_action(){
		$task = isset($_POST['task'])?@$_POST['task']:@$_GET['task'];
		switch($task){
			case "LIST":
				$this->stok_mutasi_list();
				break;
			case "SEARCH":
				$this->stok_mutasi_list();
				break;
			case "PRINT":
				$this->stok_mutasi_print();
				break;
			case "EXCEL":
				$this->stok_mutasi_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function stok_mutasi_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : @$_GET['query'];
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$produk_id = (integer) (isset($_POST['produk_id']) ? @$_POST['produk_id'] : @$_GET['produk_id']);
		$group1_id = (integer) (isset($_POST['group1_id']) ? @$_POST['group1_id'] : @$_GET['group1_id']);
		$tanggal_start =(isset($_POST['tanggal_start']) ? @$_POST['tanggal_start'] : @$_GET['tanggal_start']);
		$tanggal_end = (isset($_POST['tanggal_end']) ? @$_POST['tanggal_end'] : @$_GET['tanggal_end']);
		$opsi_satuan = (isset($_POST['opsi_satuan']) ? @$_POST['opsi_satuan'] : @$_GET['opsi_satuan']);
		$opsi_produk = (isset($_POST['opsi_produk']) ? @$_POST['opsi_produk'] : @$_GET['opsi_produk']);
		$gudang = (isset($_POST['gudang']) ? @$_POST['gudang'] : @$_GET['gudang']);
		
		$result=$this->m_stok_mutasi->stok_mutasi_list($gudang, $produk_id, $group1_id, $opsi_produk, $opsi_satuan, $tanggal_start,
													   $tanggal_end,$query,$start,$end,"list");
		echo $result;
	}
	
	
	function get_group1_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : @$_GET['query'];
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
			
		$result=$this->m_public_function->get_group1_list($query,$start,$end);
		echo $result;
	}
	
	
	function stok_mutasi_print(){
  		//POST varibale here
		$produk_id = (integer) (isset($_POST['produk_id']) ? @$_POST['produk_id'] : @$_GET['produk_id']);
		$group1_id = (integer) (isset($_POST['group1_id']) ? @$_POST['group1_id'] : @$_GET['group1_id']);
		$tanggal_start =(isset($_POST['tanggal_start']) ? @$_POST['tanggal_start'] : @$_GET['tanggal_start']);
		$tanggal_end = (isset($_POST['tanggal_end']) ? @$_POST['tanggal_end'] : @$_GET['tanggal_end']);
		$opsi_satuan = (isset($_POST['opsi_satuan']) ? @$_POST['opsi_satuan'] : @$_GET['opsi_satuan']);
		$opsi_produk = (isset($_POST['opsi_produk']) ? @$_POST['opsi_produk'] : @$_GET['opsi_produk']);
		$gudang = (isset($_POST['gudang']) ? @$_POST['gudang'] : @$_GET['gudang']);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
/*		$data["data_print"] = $this->m_stok_mutasi->stok_mutasi_print($gudang, $produk_id, $group1_id, $opsi_produk, $opsi_satuan, $tanggal_start,
																	  $tanggal_end,$option,$filter);*/
		$result=$this->m_stok_mutasi->stok_mutasi_list($gudang, $produk_id, $group1_id, $opsi_produk, $opsi_satuan, $tanggal_start,
													   $tanggal_end,$query,$start,$end,"print");
		
		$print_view=$this->load->view("main/p_stok_mutasi.php",$data,TRUE);
		if(!file_exists("print")){
			mkdir("print");
		}
		$print_file=fopen("print/stok_mutasi_printlist.html","w+");
		fwrite($print_file, $print_view);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function stok_mutasi_export_excel(){
		//POST varibale here
		$produk_id=trim(@$_POST["produk_id"]);
		$produk_nama=trim(@$_POST["produk_nama"]);
		$produk_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_nama);
		$produk_nama=str_replace("'", "\'",$produk_nama);
		$satuan_id=trim(@$_POST["satuan_id"]);
		$satuan_nama=trim(@$_POST["satuan_nama"]);
		$satuan_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$satuan_nama);
		$satuan_nama=str_replace("'", "\'",$satuan_nama);
		$stok_saldo=trim(@$_POST["stok_saldo"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_stok_mutasi->stok_mutasi_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter);
		
		to_excel($query,"stok_mutasi"); 
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
	
	
}
?>