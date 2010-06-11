<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: kasbank Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_kasbank_masuk.php
 	+ Author  		: Zainal, Anam
 	+ Created on 12/Mar/2010 10:45:40
	
*/

//class of kasbank
class C_kasbank_masuk extends Controller {

	//constructor
	function C_kasbank_masuk(){
		parent::Controller();
		session_start();
		$this->load->model('m_kasbank', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_kasbank_masuk');
	}
	
	//for detail action
	//list detail handler action
	function  detail_kasbank_masuk_detail_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_kasbank->detail_kasbank_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_kasbank_masuk_detail_purge(){
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
	function detail_kasbank_masuk_detail_insert(){
	//POST variable here
		$dkasbank_masuk_id=trim(@$_POST["dkasbank_masuk_id"]);
		$dkasbank_masuk_master=trim(@$_POST["dkasbank_masuk_master"]);
		$dkasbank_masuk_akun=trim(@$_POST["dkasbank_masuk_akun"]);
		$dkasbank_masuk_detail=trim(@$_POST["dkasbank_masuk_detail"]);
		$dkasbank_masuk_detail=str_replace("/(<\/?)(p)([^>]*>)", "",$dkasbank_masuk_detail);
		$dkasbank_masuk_detail=str_replace("'", "''",$dkasbank_masuk_detail);
		$dkasbank_masuk_debet=trim(@$_POST["dkasbank_masuk_debet"]);
		$dkasbank_masuk_kredit=trim(@$_POST["dkasbank_masuk_kredit"]);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_kasbank->detail_kasbank_detail_insert($master_id,$dkasbank_masuk_id ,$dkasbank_masuk_master ,$dkasbank_masuk_akun ,$dkasbank_masuk_detail ,$dkasbank_masuk_debet ,$dkasbank_masuk_kredit );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->kasbank_masuk_list();
				break;
			case "UPDATE":
				$this->kasbank_masuk_update();
				break;
			case "CREATE":
				$this->kasbank_masuk_create();
				break;
			case "DELETE":
				$this->kasbank_masuk_delete();
				break;
			case "SEARCH":
				$this->kasbank_masuk_search();
				break;
			case "PRINT":
				$this->kasbank_masuk_print();
				break;
			case "EXCEL":
				$this->kasbank_masuk_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function kasbank_masuk_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_kasbank->kasbank_list($query,$start,$end,"masuk");
		echo $result;
	}
	
	//function for create new record
	function kasbank_masuk_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$kasbank_masuk_tanggal=trim(@$_POST["kasbank_masuk_tanggal"]);
		$kasbank_masuk_nobukti=trim(@$_POST["kasbank_masuk_nobukti"]);
		$kasbank_masuk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_nobukti);
		$kasbank_masuk_nobukti=str_replace("'", "''",$kasbank_masuk_nobukti);
		$kasbank_masuk_akun=trim(@$_POST["kasbank_masuk_akun"]);
		$kasbank_masuk_terimauntuk=trim(@$_POST["kasbank_masuk_terimauntuk"]);
		$kasbank_masuk_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_terimauntuk=str_replace("'", "''",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_jenis=trim(@$_POST["kasbank_masuk_jenis"]);
		$kasbank_masuk_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_jenis);
		$kasbank_masuk_jenis=str_replace("'", "''",$kasbank_masuk_jenis);
		$kasbank_masuk_noref=trim(@$_POST["kasbank_masuk_noref"]);
		$kasbank_masuk_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_noref);
		$kasbank_masuk_noref=str_replace("'", "''",$kasbank_masuk_noref);
		$kasbank_masuk_keterangan=trim(@$_POST["kasbank_masuk_keterangan"]);
		$kasbank_masuk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_keterangan);
		$kasbank_masuk_keterangan=str_replace("'", "''",$kasbank_masuk_keterangan);
		$kasbank_masuk_author=@$_SESSION[SESSION_USERID];
		$kasbank_masuk_date_create=date(LONG_FORMATDATE);
		//$kasbank_masuk_update=NULL;
		//$kasbank_masuk_date_update=NULL;
		$kasbank_masuk_post=trim(@$_POST["kasbank_masuk_post"]);
		$kasbank_masuk_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_post);
		$kasbank_masuk_post=str_replace("'", "''",$kasbank_masuk_post);
		$kasbank_masuk_date_post=trim(@$_POST["kasbank_masuk_date_post"]);
		//$kasbank_masuk_revised=0;
		$result=$this->m_kasbank->kasbank_create($kasbank_masuk_tanggal ,$kasbank_masuk_nobukti ,$kasbank_masuk_akun ,$kasbank_masuk_terimauntuk ,$kasbank_masuk_jenis ,$kasbank_masuk_noref ,$kasbank_masuk_keterangan ,$kasbank_masuk_author ,$kasbank_masuk_date_create ,$kasbank_masuk_post, $kasbank_masuk_date_post );
		echo $result;
	}
	
	
	//function for update record
	function kasbank_masuk_update(){
		//POST variable here
		$kasbank_masuk_id=trim(@$_POST["kasbank_masuk_id"]);
		$kasbank_masuk_tanggal=trim(@$_POST["kasbank_masuk_tanggal"]);
		$kasbank_masuk_nobukti=trim(@$_POST["kasbank_masuk_nobukti"]);
		$kasbank_masuk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_nobukti);
		$kasbank_masuk_nobukti=str_replace("'", "''",$kasbank_masuk_nobukti);
		$kasbank_masuk_akun=trim(@$_POST["kasbank_masuk_akun"]);
		$kasbank_masuk_terimauntuk=trim(@$_POST["kasbank_masuk_terimauntuk"]);
		$kasbank_masuk_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_terimauntuk=str_replace("'", "''",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_jenis=trim(@$_POST["kasbank_masuk_jenis"]);
		$kasbank_masuk_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_jenis);
		$kasbank_masuk_jenis=str_replace("'", "''",$kasbank_masuk_jenis);
		$kasbank_masuk_noref=trim(@$_POST["kasbank_masuk_noref"]);
		$kasbank_masuk_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_noref);
		$kasbank_masuk_noref=str_replace("'", "''",$kasbank_masuk_noref);
		$kasbank_masuk_keterangan=trim(@$_POST["kasbank_masuk_keterangan"]);
		$kasbank_masuk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_keterangan);
		$kasbank_masuk_keterangan=str_replace("'", "''",$kasbank_masuk_keterangan);
		//$kasbank_masuk_author="kasbank_masuk_author";
		//$kasbank_masuk_date_create="kasbank_masuk_date_create";
		$kasbank_masuk_update=@$_SESSION[SESSION_USERID];
		$kasbank_masuk_date_update=date(LONG_FORMATDATE);
		$kasbank_masuk_post=trim(@$_POST["kasbank_masuk_post"]);
		$kasbank_masuk_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_post);
		$kasbank_masuk_post=str_replace("'", "''",$kasbank_masuk_post);
		$kasbank_masuk_date_post=trim(@$_POST["kasbank_masuk_date_post"]);
		//$kasbank_masuk_revised="(revised+1)";
		$result = $this->m_kasbank->kasbank_update($kasbank_masuk_id,$kasbank_masuk_tanggal,$kasbank_masuk_nobukti,$kasbank_masuk_akun,$kasbank_masuk_terimauntuk,$kasbank_masuk_jenis,$kasbank_masuk_noref,$kasbank_masuk_keterangan,$kasbank_masuk_update,$kasbank_masuk_date_update,$kasbank_masuk_post,$kasbank_masuk_date_post);
		echo $result;
	}
	
	//function for delete selected record
	function kasbank_masuk_delete(){
		$ids = @$_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_kasbank->kasbank_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function kasbank_masuk_search(){
		//POST varibale here
		$kasbank_masuk_id=trim(@$_POST["kasbank_masuk_id"]);
		$kasbank_masuk_tanggal=trim(@$_POST["kasbank_masuk_tanggal"]);
		$kasbank_masuk_nobukti=trim(@$_POST["kasbank_masuk_nobukti"]);
		$kasbank_masuk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_nobukti);
		$kasbank_masuk_nobukti=str_replace("'", "''",$kasbank_masuk_nobukti);
		$kasbank_masuk_akun=trim(@$_POST["kasbank_masuk_akun"]);
		$kasbank_masuk_terimauntuk=trim(@$_POST["kasbank_masuk_terimauntuk"]);
		$kasbank_masuk_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_terimauntuk=str_replace("'", "''",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_jenis=trim(@$_POST["kasbank_masuk_jenis"]);
		$kasbank_masuk_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_jenis);
		$kasbank_masuk_jenis=str_replace("'", "''",$kasbank_masuk_jenis);
		$kasbank_masuk_noref=trim(@$_POST["kasbank_masuk_noref"]);
		$kasbank_masuk_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_noref);
		$kasbank_masuk_noref=str_replace("'", "''",$kasbank_masuk_noref);
		$kasbank_masuk_keterangan=trim(@$_POST["kasbank_masuk_keterangan"]);
		$kasbank_masuk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_keterangan);
		$kasbank_masuk_keterangan=str_replace("'", "''",$kasbank_masuk_keterangan);
		$kasbank_masuk_author=trim(@$_POST["kasbank_masuk_author"]);
		$kasbank_masuk_author=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_author);
		$kasbank_masuk_author=str_replace("'", "''",$kasbank_masuk_author);
		$kasbank_masuk_date_create=trim(@$_POST["kasbank_masuk_date_create"]);
		$kasbank_masuk_update=trim(@$_POST["kasbank_masuk_update"]);
		$kasbank_masuk_update=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_update);
		$kasbank_masuk_update=str_replace("'", "''",$kasbank_masuk_update);
		$kasbank_masuk_date_update=trim(@$_POST["kasbank_masuk_date_update"]);
		$kasbank_masuk_post=trim(@$_POST["kasbank_masuk_post"]);
		$kasbank_masuk_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_post);
		$kasbank_masuk_post=str_replace("'", "''",$kasbank_masuk_post);
		$kasbank_masuk_date_post=trim(@$_POST["kasbank_masuk_date_post"]);
		$kasbank_masuk_revised=trim(@$_POST["kasbank_masuk_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_kasbank->kasbank_search($kasbank_masuk_id ,$kasbank_masuk_tanggal ,$kasbank_masuk_nobukti ,$kasbank_masuk_akun ,$kasbank_masuk_terimauntuk ,$kasbank_masuk_jenis ,$kasbank_masuk_noref ,$kasbank_masuk_keterangan ,$kasbank_masuk_author ,$kasbank_masuk_date_create ,$kasbank_masuk_update ,$kasbank_masuk_date_update ,$kasbank_masuk_post ,$kasbank_masuk_date_post ,$kasbank_masuk_revised ,$start,$end);
		echo $result;
	}


	function kasbank_masuk_print(){
  		//POST varibale here
		$kasbank_masuk_id=trim(@$_POST["kasbank_masuk_id"]);
		$kasbank_masuk_tanggal=trim(@$_POST["kasbank_masuk_tanggal"]);
		$kasbank_masuk_nobukti=trim(@$_POST["kasbank_masuk_nobukti"]);
		$kasbank_masuk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_nobukti);
		$kasbank_masuk_nobukti=str_replace("'", "'",$kasbank_masuk_nobukti);
		$kasbank_masuk_akun=trim(@$_POST["kasbank_masuk_akun"]);
		$kasbank_masuk_terimauntuk=trim(@$_POST["kasbank_masuk_terimauntuk"]);
		$kasbank_masuk_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_terimauntuk=str_replace("'", "'",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_jenis=trim(@$_POST["kasbank_masuk_jenis"]);
		$kasbank_masuk_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_jenis);
		$kasbank_masuk_jenis=str_replace("'", "'",$kasbank_masuk_jenis);
		$kasbank_masuk_noref=trim(@$_POST["kasbank_masuk_noref"]);
		$kasbank_masuk_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_noref);
		$kasbank_masuk_noref=str_replace("'", "'",$kasbank_masuk_noref);
		$kasbank_masuk_keterangan=trim(@$_POST["kasbank_masuk_keterangan"]);
		$kasbank_masuk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_keterangan);
		$kasbank_masuk_keterangan=str_replace("'", "'",$kasbank_masuk_keterangan);
		$kasbank_masuk_author=trim(@$_POST["kasbank_masuk_author"]);
		$kasbank_masuk_author=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_author);
		$kasbank_masuk_author=str_replace("'", "'",$kasbank_masuk_author);
		$kasbank_masuk_date_create=trim(@$_POST["kasbank_masuk_date_create"]);
		$kasbank_masuk_update=trim(@$_POST["kasbank_masuk_update"]);
		$kasbank_masuk_update=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_update);
		$kasbank_masuk_update=str_replace("'", "'",$kasbank_masuk_update);
		$kasbank_masuk_date_update=trim(@$_POST["kasbank_masuk_date_update"]);
		$kasbank_masuk_post=trim(@$_POST["kasbank_masuk_post"]);
		$kasbank_masuk_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_post);
		$kasbank_masuk_post=str_replace("'", "'",$kasbank_masuk_post);
		$kasbank_masuk_date_post=trim(@$_POST["kasbank_masuk_date_post"]);
		$kasbank_masuk_revised=trim(@$_POST["kasbank_masuk_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$data["data_print"] = $this->m_kasbank->kasbank_print($kasbank_masuk_id ,$kasbank_masuk_tanggal ,$kasbank_masuk_nobukti ,$kasbank_masuk_akun ,$kasbank_masuk_terimauntuk ,$kasbank_masuk_jenis ,$kasbank_masuk_noref ,$kasbank_masuk_keterangan ,$kasbank_masuk_author ,$kasbank_masuk_date_create ,$kasbank_masuk_update ,$kasbank_masuk_date_update ,$kasbank_masuk_post ,$kasbank_masuk_date_post ,$kasbank_masuk_revised ,$option,$filter);
		$print_view=$this->load->view("main/p_kasbank.php",$data,TRUE);
		if(!file_exists("print")){
			mkdir("print");
		}
		$print_file=fopen("print/kasbank_masuk_printlist.html","w+");
		fwrite($print_file, $print_view);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function kasbank_masuk_export_excel(){
		//POST varibale here
		$kasbank_masuk_id=trim(@$_POST["kasbank_masuk_id"]);
		$kasbank_masuk_tanggal=trim(@$_POST["kasbank_masuk_tanggal"]);
		$kasbank_masuk_nobukti=trim(@$_POST["kasbank_masuk_nobukti"]);
		$kasbank_masuk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_nobukti);
		$kasbank_masuk_nobukti=str_replace("'", "\'",$kasbank_masuk_nobukti);
		$kasbank_masuk_akun=trim(@$_POST["kasbank_masuk_akun"]);
		$kasbank_masuk_terimauntuk=trim(@$_POST["kasbank_masuk_terimauntuk"]);
		$kasbank_masuk_terimauntuk=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_terimauntuk=str_replace("'", "\'",$kasbank_masuk_terimauntuk);
		$kasbank_masuk_jenis=trim(@$_POST["kasbank_masuk_jenis"]);
		$kasbank_masuk_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_jenis);
		$kasbank_masuk_jenis=str_replace("'", "\'",$kasbank_masuk_jenis);
		$kasbank_masuk_noref=trim(@$_POST["kasbank_masuk_noref"]);
		$kasbank_masuk_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_noref);
		$kasbank_masuk_noref=str_replace("'", "\'",$kasbank_masuk_noref);
		$kasbank_masuk_keterangan=trim(@$_POST["kasbank_masuk_keterangan"]);
		$kasbank_masuk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_keterangan);
		$kasbank_masuk_keterangan=str_replace("'", "\'",$kasbank_masuk_keterangan);
		$kasbank_masuk_author=trim(@$_POST["kasbank_masuk_author"]);
		$kasbank_masuk_author=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_author);
		$kasbank_masuk_author=str_replace("'", "\'",$kasbank_masuk_author);
		$kasbank_masuk_date_create=trim(@$_POST["kasbank_masuk_date_create"]);
		$kasbank_masuk_update=trim(@$_POST["kasbank_masuk_update"]);
		$kasbank_masuk_update=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_update);
		$kasbank_masuk_update=str_replace("'", "\'",$kasbank_masuk_update);
		$kasbank_masuk_date_update=trim(@$_POST["kasbank_masuk_date_update"]);
		$kasbank_masuk_post=trim(@$_POST["kasbank_masuk_post"]);
		$kasbank_masuk_post=str_replace("/(<\/?)(p)([^>]*>)", "",$kasbank_masuk_post);
		$kasbank_masuk_post=str_replace("'", "\'",$kasbank_masuk_post);
		$kasbank_masuk_date_post=trim(@$_POST["kasbank_masuk_date_post"]);
		$kasbank_masuk_revised=trim(@$_POST["kasbank_masuk_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_kasbank->kasbank_export_excel($kasbank_masuk_id ,$kasbank_masuk_tanggal ,$kasbank_masuk_nobukti ,$kasbank_masuk_akun ,$kasbank_masuk_terimauntuk ,$kasbank_masuk_jenis ,$kasbank_masuk_noref ,$kasbank_masuk_keterangan ,$kasbank_masuk_author ,$kasbank_masuk_date_create ,$kasbank_masuk_update ,$kasbank_masuk_date_update ,$kasbank_masuk_post ,$kasbank_masuk_date_post ,$kasbank_masuk_revised ,$option,$filter);
		
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