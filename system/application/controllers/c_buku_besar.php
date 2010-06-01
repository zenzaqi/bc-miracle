<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: buku_besar Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_buku_besar.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:51:08
	
*/

//class of buku_besar
class C_buku_besar extends Controller {

	//constructor
	function C_buku_besar(){
		parent::Controller();
		$this->load->model('m_buku_besar', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_buku_besar');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->buku_besar_list();
				break;
			case "DELETE":
				$this->buku_besar_delete();
				break;
			case "SEARCH":
				$this->buku_besar_search();
				break;
			case "PRINT":
				$this->buku_besar_print();
				break;
			case "EXCEL":
				$this->buku_besar_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function buku_besar_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_buku_besar->buku_besar_list($query,$start,$end);
		echo $result;
	}

	
	//function for advanced search
	function buku_besar_search(){
		//POST varibale here
		$buku_periode=trim(@$_POST["buku_periode"]);
		$buku_tglawal=trim(@$_POST["buku_tglawal"]);
		$buku_tglakhir=trim(@$_POST["buku_tglakhir"]);
		$buku_bulan=trim(@$_POST["buku_bulan"]);
		$buku_tahun=trim(@$_POST["buku_tahun"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		
		$result = $this->m_buku_besar->buku_besar_search($buku_periode, $buku_tglawal, $buku_tglakhir, $buku_bulan, $buku_tahun, $buku_akun, $start,$end);
		echo $result;
	}


	function buku_besar_print(){
  		//POST varibale here
		$buku_id=trim(@$_POST["buku_id"]);
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function buku_besar_export_excel(){
		//POST varibale here
		$buku_id=trim(@$_POST["buku_id"]);
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_buku_besar->buku_besar_export_excel($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter);
		
		to_excel($query,"buku_besar"); 
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