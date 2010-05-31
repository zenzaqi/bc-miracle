<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: kasbank Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_kasbank_keluar.php
 	+ Author  		: Zainal, Anam
 	+ Created on 12/Mar/2010 10:45:40
	
*/

//class of kasbank
class C_kasbank_keluar extends Controller {

	//constructor
	function C_kasbank_keluar(){
		parent::Controller();
		session_start();
		$this->load->model('m_kasbank', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_kasbank_keluar');
	}
	
	//for detail action
	//list detail handler action
	function  detail_kasbank_keluar_detail_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_kasbank->detail_kasbank_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_kasbank_keluar_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_kasbank->detail_kasbank_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_kasbank->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_kasbank_keluar_detail_insert(){
	//POST variable here
		$dkasbank_keluar_id=trim(@$_POST["dkasbank_keluar_id"]);
		$dkasbank_keluar_master=trim(@$_POST["dkasbank_keluar_master"]);
		$dkasbank_keluar_akun=trim(@$_POST["dkasbank_keluar_akun"]);
		$dkasbank_keluar_detail=trim(@$_POST["dkasbank_keluar_detail"]);
		$dkasbank_keluar_detail=str_replace("/(<\/?)(p)([^>]*>)", "",$dkasbank_keluar_detail);
		$dkasbank_keluar_detail=str_replace("'", "''",$dkasbank_keluar_detail);
		$dkasbank_keluar_debet=trim(@$_POST["dkasbank_keluar_debet"]);
		$dkasbank_keluar_kredit=trim(@$_POST["dkasbank_keluar_kredit"]);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_kasbank->detail_kasbank_detail_insert($master_id,$dkasbank_keluar_id ,$dkasbank_keluar_master ,$dkasbank_keluar_akun ,$dkasbank_keluar_detail ,$dkasbank_keluar_debet ,$dkasbank_keluar_kredit );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->kasbank_keluar_list();
				break;
			case "UPDATE":
				$this->kasbank_keluar_update();
				break;
			case "CREATE":
				$this->kasbank_keluar_create();
				break;
			case "DELETE":
				$this->kasbank_keluar_delete();
				break;
			case "SEARCH":
				$this->kasbank_keluar_search();
				break;
			case "PRINT":
				$this->kasbank_keluar_print();
				break;
			case "EXCEL":
				$this->kasbank_keluar_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function kasbank_keluar_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_kasbank->kasbank_list($query,$start,$end,"keluar");
		echo $result;
	}
	
	//function for create new record
	function kasbank_keluar_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$kasbank_keluar_tanggal=trim(@$_POST["kasbank_keluar_tanggal"]);
		$kasbank_keluar_nobukti=trim(@$_POST["kasbank_keluar_nobukti"]);
		$kasbank_keluar_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_nobukti);
		$kasbank_keluar_nobukti=str_replace("'", "''",$kasbank_keluar_nobukti);
		$kasbank_keluar_akun=trim(@$_POST["kasbank_keluar_akun"]);
		$kasbank_keluar_terimauntuk=trim(@$_POST["kasbank_keluar_terimauntuk"]);
		$kasbank_keluar_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_terimauntuk=str_replace("'", "''",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_jenis=trim(@$_POST["kasbank_keluar_jenis"]);
		$kasbank_keluar_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_jenis);
		$kasbank_keluar_jenis=str_replace("'", "''",$kasbank_keluar_jenis);
		$kasbank_keluar_noref=trim(@$_POST["kasbank_keluar_noref"]);
		$kasbank_keluar_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_noref);
		$kasbank_keluar_noref=str_replace("'", "''",$kasbank_keluar_noref);
		$kasbank_keluar_keterangan=trim(@$_POST["kasbank_keluar_keterangan"]);
		$kasbank_keluar_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_keterangan);
		$kasbank_keluar_keterangan=str_replace("'", "''",$kasbank_keluar_keterangan);
		$kasbank_keluar_author=@$_SESSION[SESSION_USERID];
		$kasbank_keluar_date_create=date(LONG_FORMATDATE);
		//$kasbank_keluar_update=NULL;
		//$kasbank_keluar_date_update=NULL;
		$kasbank_keluar_post=trim(@$_POST["kasbank_keluar_post"]);
		$kasbank_keluar_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_post);
		$kasbank_keluar_post=str_replace("'", "''",$kasbank_keluar_post);
		$kasbank_keluar_date_post=trim(@$_POST["kasbank_keluar_date_post"]);
		//$kasbank_keluar_revised=0;
		$result=$this->m_kasbank->kasbank_create($kasbank_keluar_tanggal ,$kasbank_keluar_nobukti ,$kasbank_keluar_akun ,$kasbank_keluar_terimauntuk ,$kasbank_keluar_jenis ,$kasbank_keluar_noref ,$kasbank_keluar_keterangan ,$kasbank_keluar_author ,$kasbank_keluar_date_create ,$kasbank_keluar_post, $kasbank_keluar_date_post );
		echo $result;
	}
	
	
	//function for update record
	function kasbank_keluar_update(){
		//POST variable here
		$kasbank_keluar_id=trim(@$_POST["kasbank_keluar_id"]);
		$kasbank_keluar_tanggal=trim(@$_POST["kasbank_keluar_tanggal"]);
		$kasbank_keluar_nobukti=trim(@$_POST["kasbank_keluar_nobukti"]);
		$kasbank_keluar_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_nobukti);
		$kasbank_keluar_nobukti=str_replace("'", "''",$kasbank_keluar_nobukti);
		$kasbank_keluar_akun=trim(@$_POST["kasbank_keluar_akun"]);
		$kasbank_keluar_terimauntuk=trim(@$_POST["kasbank_keluar_terimauntuk"]);
		$kasbank_keluar_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_terimauntuk=str_replace("'", "''",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_jenis=trim(@$_POST["kasbank_keluar_jenis"]);
		$kasbank_keluar_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_jenis);
		$kasbank_keluar_jenis=str_replace("'", "''",$kasbank_keluar_jenis);
		$kasbank_keluar_noref=trim(@$_POST["kasbank_keluar_noref"]);
		$kasbank_keluar_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_noref);
		$kasbank_keluar_noref=str_replace("'", "''",$kasbank_keluar_noref);
		$kasbank_keluar_keterangan=trim(@$_POST["kasbank_keluar_keterangan"]);
		$kasbank_keluar_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_keterangan);
		$kasbank_keluar_keterangan=str_replace("'", "''",$kasbank_keluar_keterangan);
		//$kasbank_keluar_author="kasbank_keluar_author";
		//$kasbank_keluar_date_create="kasbank_keluar_date_create";
		$kasbank_keluar_update=@$_SESSION[SESSION_USERID];
		$kasbank_keluar_date_update=date(LONG_FORMATDATE);
		$kasbank_keluar_post=trim(@$_POST["kasbank_keluar_post"]);
		$kasbank_keluar_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_post);
		$kasbank_keluar_post=str_replace("'", "''",$kasbank_keluar_post);
		$kasbank_keluar_date_post=trim(@$_POST["kasbank_keluar_date_post"]);
		//$kasbank_keluar_revised="(revised+1)";
		$result = $this->m_kasbank->kasbank_update($kasbank_keluar_id,$kasbank_keluar_tanggal,$kasbank_keluar_nobukti,$kasbank_keluar_akun,$kasbank_keluar_terimauntuk,$kasbank_keluar_jenis,$kasbank_keluar_noref,$kasbank_keluar_keterangan,$kasbank_keluar_update,$kasbank_keluar_date_update,$kasbank_keluar_post,$kasbank_keluar_date_post);
		echo $result;
	}
	
	//function for delete selected record
	function kasbank_keluar_delete(){
		$ids = @$_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_kasbank->kasbank_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function kasbank_keluar_search(){
		//POST varibale here
		$kasbank_keluar_id=trim(@$_POST["kasbank_keluar_id"]);
		$kasbank_keluar_tanggal=trim(@$_POST["kasbank_keluar_tanggal"]);
		$kasbank_keluar_nobukti=trim(@$_POST["kasbank_keluar_nobukti"]);
		$kasbank_keluar_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_nobukti);
		$kasbank_keluar_nobukti=str_replace("'", "''",$kasbank_keluar_nobukti);
		$kasbank_keluar_akun=trim(@$_POST["kasbank_keluar_akun"]);
		$kasbank_keluar_terimauntuk=trim(@$_POST["kasbank_keluar_terimauntuk"]);
		$kasbank_keluar_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_terimauntuk=str_replace("'", "''",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_jenis=trim(@$_POST["kasbank_keluar_jenis"]);
		$kasbank_keluar_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_jenis);
		$kasbank_keluar_jenis=str_replace("'", "''",$kasbank_keluar_jenis);
		$kasbank_keluar_noref=trim(@$_POST["kasbank_keluar_noref"]);
		$kasbank_keluar_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_noref);
		$kasbank_keluar_noref=str_replace("'", "''",$kasbank_keluar_noref);
		$kasbank_keluar_keterangan=trim(@$_POST["kasbank_keluar_keterangan"]);
		$kasbank_keluar_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_keterangan);
		$kasbank_keluar_keterangan=str_replace("'", "''",$kasbank_keluar_keterangan);
		$kasbank_keluar_author=trim(@$_POST["kasbank_keluar_author"]);
		$kasbank_keluar_author=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_author);
		$kasbank_keluar_author=str_replace("'", "''",$kasbank_keluar_author);
		$kasbank_keluar_date_create=trim(@$_POST["kasbank_keluar_date_create"]);
		$kasbank_keluar_update=trim(@$_POST["kasbank_keluar_update"]);
		$kasbank_keluar_update=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_update);
		$kasbank_keluar_update=str_replace("'", "''",$kasbank_keluar_update);
		$kasbank_keluar_date_update=trim(@$_POST["kasbank_keluar_date_update"]);
		$kasbank_keluar_post=trim(@$_POST["kasbank_keluar_post"]);
		$kasbank_keluar_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_post);
		$kasbank_keluar_post=str_replace("'", "''",$kasbank_keluar_post);
		$kasbank_keluar_date_post=trim(@$_POST["kasbank_keluar_date_post"]);
		$kasbank_keluar_revised=trim(@$_POST["kasbank_keluar_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_kasbank->kasbank_search($kasbank_keluar_id ,$kasbank_keluar_tanggal ,$kasbank_keluar_nobukti ,$kasbank_keluar_akun ,$kasbank_keluar_terimauntuk ,$kasbank_keluar_jenis ,$kasbank_keluar_noref ,$kasbank_keluar_keterangan ,$kasbank_keluar_author ,$kasbank_keluar_date_create ,$kasbank_keluar_update ,$kasbank_keluar_date_update ,$kasbank_keluar_post ,$kasbank_keluar_date_post ,$kasbank_keluar_revised ,$start,$end);
		echo $result;
	}


	function kasbank_keluar_print(){
  		//POST varibale here
		$kasbank_keluar_id=trim(@$_POST["kasbank_keluar_id"]);
		$kasbank_keluar_tanggal=trim(@$_POST["kasbank_keluar_tanggal"]);
		$kasbank_keluar_nobukti=trim(@$_POST["kasbank_keluar_nobukti"]);
		$kasbank_keluar_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_nobukti);
		$kasbank_keluar_nobukti=str_replace("'", "'",$kasbank_keluar_nobukti);
		$kasbank_keluar_akun=trim(@$_POST["kasbank_keluar_akun"]);
		$kasbank_keluar_terimauntuk=trim(@$_POST["kasbank_keluar_terimauntuk"]);
		$kasbank_keluar_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_terimauntuk=str_replace("'", "'",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_jenis=trim(@$_POST["kasbank_keluar_jenis"]);
		$kasbank_keluar_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_jenis);
		$kasbank_keluar_jenis=str_replace("'", "'",$kasbank_keluar_jenis);
		$kasbank_keluar_noref=trim(@$_POST["kasbank_keluar_noref"]);
		$kasbank_keluar_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_noref);
		$kasbank_keluar_noref=str_replace("'", "'",$kasbank_keluar_noref);
		$kasbank_keluar_keterangan=trim(@$_POST["kasbank_keluar_keterangan"]);
		$kasbank_keluar_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_keterangan);
		$kasbank_keluar_keterangan=str_replace("'", "'",$kasbank_keluar_keterangan);
		$kasbank_keluar_author=trim(@$_POST["kasbank_keluar_author"]);
		$kasbank_keluar_author=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_author);
		$kasbank_keluar_author=str_replace("'", "'",$kasbank_keluar_author);
		$kasbank_keluar_date_create=trim(@$_POST["kasbank_keluar_date_create"]);
		$kasbank_keluar_update=trim(@$_POST["kasbank_keluar_update"]);
		$kasbank_keluar_update=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_update);
		$kasbank_keluar_update=str_replace("'", "'",$kasbank_keluar_update);
		$kasbank_keluar_date_update=trim(@$_POST["kasbank_keluar_date_update"]);
		$kasbank_keluar_post=trim(@$_POST["kasbank_keluar_post"]);
		$kasbank_keluar_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_post);
		$kasbank_keluar_post=str_replace("'", "'",$kasbank_keluar_post);
		$kasbank_keluar_date_post=trim(@$_POST["kasbank_keluar_date_post"]);
		$kasbank_keluar_revised=trim(@$_POST["kasbank_keluar_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$data["data_print"] = $this->m_kasbank->kasbank_print($kasbank_keluar_id ,$kasbank_keluar_tanggal ,$kasbank_keluar_nobukti ,$kasbank_keluar_akun ,$kasbank_keluar_terimauntuk ,$kasbank_keluar_jenis ,$kasbank_keluar_noref ,$kasbank_keluar_keterangan ,$kasbank_keluar_author ,$kasbank_keluar_date_create ,$kasbank_keluar_update ,$kasbank_keluar_date_update ,$kasbank_keluar_post ,$kasbank_keluar_date_post ,$kasbank_keluar_revised ,$option,$filter);
		$print_view=$this->load->view("main/p_kasbank.php",$data,TRUE);
		if(!file_exists("print")){
			mkdir("print");
		}
		$print_file=fopen("print/kasbank_keluar_printlist.html","w+");
		fwrite($print_file, $print_view);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function kasbank_keluar_export_excel(){
		//POST varibale here
		$kasbank_keluar_id=trim(@$_POST["kasbank_keluar_id"]);
		$kasbank_keluar_tanggal=trim(@$_POST["kasbank_keluar_tanggal"]);
		$kasbank_keluar_nobukti=trim(@$_POST["kasbank_keluar_nobukti"]);
		$kasbank_keluar_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_nobukti);
		$kasbank_keluar_nobukti=str_replace("'", "\'",$kasbank_keluar_nobukti);
		$kasbank_keluar_akun=trim(@$_POST["kasbank_keluar_akun"]);
		$kasbank_keluar_terimauntuk=trim(@$_POST["kasbank_keluar_terimauntuk"]);
		$kasbank_keluar_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_terimauntuk=str_replace("'", "\'",$kasbank_keluar_terimauntuk);
		$kasbank_keluar_jenis=trim(@$_POST["kasbank_keluar_jenis"]);
		$kasbank_keluar_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_jenis);
		$kasbank_keluar_jenis=str_replace("'", "\'",$kasbank_keluar_jenis);
		$kasbank_keluar_noref=trim(@$_POST["kasbank_keluar_noref"]);
		$kasbank_keluar_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_noref);
		$kasbank_keluar_noref=str_replace("'", "\'",$kasbank_keluar_noref);
		$kasbank_keluar_keterangan=trim(@$_POST["kasbank_keluar_keterangan"]);
		$kasbank_keluar_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_keterangan);
		$kasbank_keluar_keterangan=str_replace("'", "\'",$kasbank_keluar_keterangan);
		$kasbank_keluar_author=trim(@$_POST["kasbank_keluar_author"]);
		$kasbank_keluar_author=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_author);
		$kasbank_keluar_author=str_replace("'", "\'",$kasbank_keluar_author);
		$kasbank_keluar_date_create=trim(@$_POST["kasbank_keluar_date_create"]);
		$kasbank_keluar_update=trim(@$_POST["kasbank_keluar_update"]);
		$kasbank_keluar_update=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_update);
		$kasbank_keluar_update=str_replace("'", "\'",$kasbank_keluar_update);
		$kasbank_keluar_date_update=trim(@$_POST["kasbank_keluar_date_update"]);
		$kasbank_keluar_post=trim(@$_POST["kasbank_keluar_post"]);
		$kasbank_keluar_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_keluar_post);
		$kasbank_keluar_post=str_replace("'", "\'",$kasbank_keluar_post);
		$kasbank_keluar_date_post=trim(@$_POST["kasbank_keluar_date_post"]);
		$kasbank_keluar_revised=trim(@$_POST["kasbank_keluar_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_kasbank->kasbank_export_excel($kasbank_keluar_id ,$kasbank_keluar_tanggal ,$kasbank_keluar_nobukti ,$kasbank_keluar_akun ,$kasbank_keluar_terimauntuk ,$kasbank_keluar_jenis ,$kasbank_keluar_noref ,$kasbank_keluar_keterangan ,$kasbank_keluar_author ,$kasbank_keluar_date_create ,$kasbank_keluar_update ,$kasbank_keluar_date_update ,$kasbank_keluar_post ,$kasbank_keluar_date_post ,$kasbank_keluar_revised ,$option,$filter);
		
		to_excel($query,"kasbank"); 
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