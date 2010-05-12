<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jurnal_umum Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jurnal_umum.php
 	+ creator 		: 
 	+ Created on 01/Apr/2010 12:13:56
	
*/

//class of jurnal_umum
class C_jurnal_umum extends Controller {

	//constructor
	function C_jurnal_umum(){
		parent::Controller();
		session_start();
		$this->load->model('m_jurnal_umum', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_jurnal_umum');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jurnal_umum_list();
				break;
			case "UPDATE":
				$this->jurnal_umum_update();
				break;
			case "CREATE":
				$this->jurnal_umum_create();
				break;
			case "DELETE":
				$this->jurnal_umum_delete();
				break;
			case "SEARCH":
				$this->jurnal_umum_search();
				break;
			case "PRINT":
				$this->jurnal_umum_print();
				break;
			case "EXCEL":
				$this->jurnal_umum_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jurnal_umum_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_jurnal_umum->jurnal_umum_list($query,$start,$end);
		echo $result;
	}
	
	//function fot list record
	function get_detail_jurnal_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		
		$result=$this->m_jurnal_umum->get_detail_jurnal_list($task,$master_id,$query,$start,$end);
		echo $result;
	}
	
	//function fot list record
	function get_akun_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$master_id = (integer) isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_jurnal_umum->get_akun_list($task, $master_id, $selected_id,$query,$start,$end);
		echo $result;
	}
	
	function detail_jurnal_insert(){
		$jurnal_id = isset($_POST["jurnal_id"])?@$_POST["jurnal_id"]:@$_GET["jurnal_id"];
		$jurnal_master = isset($_POST["jurnal_master"])?@$_POST["jurnal_master"]:@$_GET["jurnal_master"];
		$jurnal_akun = isset($_POST["jurnal_akun"])?@$_POST["jurnal_akun"]:@$_GET["jurnal_akun"];
		$jurnal_detail = isset($_POST["jurnal_detail"])?@$_POST["jurnal_detail"]:@$_GET["jurnal_detail"];
		$jurnal_debet = isset($_POST["jurnal_debet"])?@$_POST["jurnal_debet"]:@$_GET["jurnal_debet"];
		$jurnal_kredit = isset($_POST["jurnal_kredit"])?@$_POST["jurnal_kredit"]:@$_GET["jurnal_kredit"];
		$result=$this->m_jurnal_umum->detail_jurnal_insert($jurnal_id,$jurnal_master,$jurnal_akun,$jurnal_detail, $jurnal_debet,$jurnal_kredit);
		echo $result;
	}
	
	function detail_jurnal_purge(){
		$jurnal_master = isset($_POST["jurnal_master"])?@$_POST["jurnal_master"]:@$_GET["jurnal_master"];
		$result=$this->m_jurnal_umum->detail_jurnal_purge($jurnal_master);
		echo $result;
	}
	
	//function for create new record
	function jurnal_umum_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jurnal_tanggal=trim(@$_POST["jurnal_tanggal"]);
		$jurnal_keterangan=trim(@$_POST["jurnal_keterangan"]);
		$jurnal_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_keterangan);
		$jurnal_keterangan=str_replace("'", "''",$jurnal_keterangan);
		$jurnal_noref=trim(@$_POST["jurnal_noref"]);
		$jurnal_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_noref);
		$jurnal_noref=str_replace("'", "''",$jurnal_noref);
		$jurnal_unit=trim(@$_POST["jurnal_unit"]);
		$jurnal_author=@$_SESSION[SESSION_USERID];
		$jurnal_date_create=date(LONG_FORMATDATE);
		//$jurnal_update=NULL;
		//$jurnal_date_update=NULL;
//		$jurnal_post=trim(@$_POST["jurnal_post"]);
//		$jurnal_post=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_post);
//		$jurnal_post=str_replace("'", "''",$jurnal_post);
//		$jurnal_date_post=trim(@$_POST["jurnal_date_post"]);
		//$jurnal_revised=0;
		$result=$this->m_jurnal_umum->jurnal_umum_create($jurnal_tanggal ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create );
		echo $result;
	}
	
	
	//function for update record
	function jurnal_umum_update(){
		//POST variable here
		$jurnal_id=trim(@$_POST["jurnal_id"]);
		$jurnal_tanggal=trim(@$_POST["jurnal_tanggal"]);
		$jurnal_keterangan=trim(@$_POST["jurnal_keterangan"]);
		$jurnal_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_keterangan);
		$jurnal_keterangan=str_replace("'", "''",$jurnal_keterangan);
		$jurnal_noref=trim(@$_POST["jurnal_noref"]);
		$jurnal_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_noref);
		$jurnal_noref=str_replace("'", "''",$jurnal_noref);
		$jurnal_unit=trim(@$_POST["jurnal_unit"]);
		//$jurnal_author="jurnal_author";
		//$jurnal_date_create="jurnal_date_create";
		$jurnal_update=@$_SESSION[SESSION_USERID];
		$jurnal_date_update=date(LONG_FORMATDATE);
		/*$jurnal_post=trim(@$_POST["jurnal_post"]);
		$jurnal_post=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_post);
		$jurnal_post=str_replace("'", "''",$jurnal_post);
		$jurnal_date_post=trim(@$_POST["jurnal_date_post"]);
*/		//$jurnal_revised="(revised+1)";
		$result = $this->m_jurnal_umum->jurnal_umum_update($jurnal_id,$jurnal_tanggal,$jurnal_keterangan,$jurnal_noref,$jurnal_unit,$jurnal_update,$jurnal_date_update);
		echo $result;
	}
	
	//function for delete selected record
	function jurnal_umum_delete(){
		$ids = @$_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jurnal_umum->jurnal_umum_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jurnal_umum_search(){
		//POST varibale here
		$jurnal_id=trim(@$_POST["jurnal_id"]);
		$jurnal_tanggal=trim(@$_POST["jurnal_tanggal"]);
		$jurnal_akun=trim(@$_POST["jurnal_akun"]);
		$jurnal_keterangan=trim(@$_POST["jurnal_keterangan"]);
		$jurnal_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_keterangan);
		$jurnal_keterangan=str_replace("'", "''",$jurnal_keterangan);
		$jurnal_noref=trim(@$_POST["jurnal_noref"]);
		$jurnal_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_noref);
		$jurnal_noref=str_replace("'", "''",$jurnal_noref);
		$jurnal_debet=trim(@$_POST["jurnal_debet"]);
		$jurnal_kredit=trim(@$_POST["jurnal_kredit"]);
		$jurnal_unit=trim(@$_POST["jurnal_unit"]);
		$jurnal_author=trim(@$_POST["jurnal_author"]);
		$jurnal_author=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_author);
		$jurnal_author=str_replace("'", "''",$jurnal_author);
		$jurnal_date_create=trim(@$_POST["jurnal_date_create"]);
		$jurnal_update=trim(@$_POST["jurnal_update"]);
		$jurnal_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_update);
		$jurnal_update=str_replace("'", "''",$jurnal_update);
		$jurnal_date_update=trim(@$_POST["jurnal_date_update"]);
		$jurnal_post=trim(@$_POST["jurnal_post"]);
		$jurnal_post=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_post);
		$jurnal_post=str_replace("'", "''",$jurnal_post);
		$jurnal_date_post=trim(@$_POST["jurnal_date_post"]);
		$jurnal_revised=trim(@$_POST["jurnal_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jurnal_umum->jurnal_umum_search($jurnal_id ,$jurnal_tanggal ,$jurnal_akun ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_debet ,$jurnal_kredit ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ,$jurnal_update ,$jurnal_date_update ,$jurnal_post ,$jurnal_date_post ,$jurnal_revised ,$start,$end);
		echo $result;
	}


	function jurnal_umum_print(){
  		//POST varibale here
		$jurnal_id=trim(@$_POST["jurnal_id"]);
		$jurnal_tanggal=trim(@$_POST["jurnal_tanggal"]);
		$jurnal_akun=trim(@$_POST["jurnal_akun"]);
		$jurnal_keterangan=trim(@$_POST["jurnal_keterangan"]);
		$jurnal_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_keterangan);
		$jurnal_keterangan=str_replace("'", "'",$jurnal_keterangan);
		$jurnal_noref=trim(@$_POST["jurnal_noref"]);
		$jurnal_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_noref);
		$jurnal_noref=str_replace("'", "'",$jurnal_noref);
		$jurnal_debet=trim(@$_POST["jurnal_debet"]);
		$jurnal_kredit=trim(@$_POST["jurnal_kredit"]);
		$jurnal_unit=trim(@$_POST["jurnal_unit"]);
		$jurnal_author=trim(@$_POST["jurnal_author"]);
		$jurnal_author=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_author);
		$jurnal_author=str_replace("'", "'",$jurnal_author);
		$jurnal_date_create=trim(@$_POST["jurnal_date_create"]);
		$jurnal_update=trim(@$_POST["jurnal_update"]);
		$jurnal_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_update);
		$jurnal_update=str_replace("'", "'",$jurnal_update);
		$jurnal_date_update=trim(@$_POST["jurnal_date_update"]);
		$jurnal_post=trim(@$_POST["jurnal_post"]);
		$jurnal_post=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_post);
		$jurnal_post=str_replace("'", "'",$jurnal_post);
		$jurnal_date_post=trim(@$_POST["jurnal_date_post"]);
		$jurnal_revised=trim(@$_POST["jurnal_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$data["data_print"] = $this->m_jurnal_umum->jurnal_umum_print($jurnal_id ,$jurnal_tanggal ,$jurnal_akun ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_debet ,$jurnal_kredit ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ,$jurnal_update ,$jurnal_date_update ,$jurnal_post ,$jurnal_date_post ,$jurnal_revised ,$option,$filter);
		$print_view=$this->load->view("main/p_jurnal_umum.php",$data,TRUE);
		if(!file_exists("print")){
			mkdir("print");
		}
		$print_file=fopen("print/jurnal_umum_printlist.html","w+");
		fwrite($print_file, $print_view);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jurnal_umum_export_excel(){
		//POST varibale here
		$jurnal_id=trim(@$_POST["jurnal_id"]);
		$jurnal_tanggal=trim(@$_POST["jurnal_tanggal"]);
		$jurnal_akun=trim(@$_POST["jurnal_akun"]);
		$jurnal_keterangan=trim(@$_POST["jurnal_keterangan"]);
		$jurnal_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_keterangan);
		$jurnal_keterangan=str_replace("'", "\'",$jurnal_keterangan);
		$jurnal_noref=trim(@$_POST["jurnal_noref"]);
		$jurnal_noref=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_noref);
		$jurnal_noref=str_replace("'", "\'",$jurnal_noref);
		$jurnal_debet=trim(@$_POST["jurnal_debet"]);
		$jurnal_kredit=trim(@$_POST["jurnal_kredit"]);
		$jurnal_unit=trim(@$_POST["jurnal_unit"]);
		$jurnal_author=trim(@$_POST["jurnal_author"]);
		$jurnal_author=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_author);
		$jurnal_author=str_replace("'", "\'",$jurnal_author);
		$jurnal_date_create=trim(@$_POST["jurnal_date_create"]);
		$jurnal_update=trim(@$_POST["jurnal_update"]);
		$jurnal_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_update);
		$jurnal_update=str_replace("'", "\'",$jurnal_update);
		$jurnal_date_update=trim(@$_POST["jurnal_date_update"]);
		$jurnal_post=trim(@$_POST["jurnal_post"]);
		$jurnal_post=str_replace("/(<\/?)(p)([^>]*>)", "",$jurnal_post);
		$jurnal_post=str_replace("'", "\'",$jurnal_post);
		$jurnal_date_post=trim(@$_POST["jurnal_date_post"]);
		$jurnal_revised=trim(@$_POST["jurnal_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jurnal_umum->jurnal_umum_export_excel($jurnal_id ,$jurnal_tanggal ,$jurnal_akun ,$jurnal_keterangan ,$jurnal_noref ,$jurnal_debet ,$jurnal_kredit ,$jurnal_unit ,$jurnal_author ,$jurnal_date_create ,$jurnal_update ,$jurnal_date_update ,$jurnal_post ,$jurnal_date_post ,$jurnal_revised ,$option,$filter);
		
		to_excel($query,"jurnal_umum"); 
		echo '1';
			
	}
	
	// Encodes a SQL array into a JSON formated string
	function JEncode($arr){
		if (version_compare(PHP_VERSION,"5.2","<"))
		{    
			require_once("../../../../sia-pmmp/system/application/controllers/JSON.php"); //if php<5.2 need JSON class
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
			require_once("../../../../sia-pmmp/system/application/controllers/JSON.php"); //if php<5.2 need JSON class
			$json = new Services_JSON();//instantiate new json object
			$data=$json->decode($arr);  //decode the data in json format
		} else {
			$data = json_decode($arr);  //decode the data in json format
		}
		return $data;
	}
	
	
}
?>