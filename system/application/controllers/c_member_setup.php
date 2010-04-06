<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: member_setup Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_member_setup.php
 	+ creator 		: 
 	+ Created on 06/Apr/2010 12:55:05
	
*/

//class of member_setup
class C_member_setup extends Controller {

	//constructor
	function C_member_setup(){
		parent::Controller();
		session_start();
		$this->load->model('m_member_setup', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_member_setup');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->member_setup_list();
				break;
			case "UPDATE":
				$this->member_setup_update();
				break;
			case "CREATE":
				$this->member_setup_create();
				break;
			case "DELETE":
				$this->member_setup_delete();
				break;
			case "SEARCH":
				$this->member_setup_search();
				break;
			case "PRINT":
				$this->member_setup_print();
				break;
			case "EXCEL":
				$this->member_setup_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function member_setup_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_member_setup->member_setup_list($query,$start,$end);
		echo $result;
	}
	
	//function for create new record
	function member_setup_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$setmember_transhari=trim(@$_POST["setmember_transhari"]);
		$setmember_transbulan=trim(@$_POST["setmember_transbulan"]);
		$setmember_periodeaktif=trim(@$_POST["setmember_periodeaktif"]);
		$setmember_periodetanggang=trim(@$_POST["setmember_periodetanggang"]);
		$setmember_transharitenggang=trim(@$_POST["setmember_transharitenggang"]);
		$setmember_author=@$_SESSION[SESSION_USERID];
		$setmember_date_create=date(LONG_FORMATDATE);
		//$setmember_update=NULL;
		//$setmember_date_update=NULL;
		//$setmember_revised=0;
		$result=$this->m_member_setup->member_setup_create($setmember_transhari ,$setmember_transbulan ,$setmember_periodeaktif ,$setmember_periodetanggang ,$setmember_transharitenggang ,$setmember_author ,$setmember_date_create );
		echo $result;
	}
	
	
	//function for update record
	function member_setup_update(){
		//POST variable here
		$setmember_id=trim(@$_POST["setmember_id"]);
		$setmember_transhari=trim(@$_POST["setmember_transhari"]);
		$setmember_transbulan=trim(@$_POST["setmember_transbulan"]);
		$setmember_periodeaktif=trim(@$_POST["setmember_periodeaktif"]);
		$setmember_periodetanggang=trim(@$_POST["setmember_periodetanggang"]);
		$setmember_transharitenggang=trim(@$_POST["setmember_transharitenggang"]);
		//$setmember_author="setmember_author";
		//$setmember_date_create="setmember_date_create";
		$setmember_update=@$_SESSION[SESSION_USERID];
		$setmember_date_update=date(LONG_FORMATDATE);
		//$setmember_revised="(revised+1)";
		$result = $this->m_member_setup->member_setup_update($setmember_id,$setmember_transhari,$setmember_transbulan,$setmember_periodeaktif,$setmember_periodetanggang,$setmember_transharitenggang,$setmember_update,$setmember_date_update);
		echo $result;
	}
	
	//function for delete selected record
	function member_setup_delete(){
		$ids = @$_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_member_setup->member_setup_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function member_setup_search(){
		//POST varibale here
		$setmember_id=trim(@$_POST["setmember_id"]);
		$setmember_transhari=trim(@$_POST["setmember_transhari"]);
		$setmember_transbulan=trim(@$_POST["setmember_transbulan"]);
		$setmember_periodeaktif=trim(@$_POST["setmember_periodeaktif"]);
		$setmember_periodetanggang=trim(@$_POST["setmember_periodetanggang"]);
		$setmember_transharitenggang=trim(@$_POST["setmember_transharitenggang"]);
		$setmember_author=trim(@$_POST["setmember_author"]);
		$setmember_author=str_replace("/(<\/?)(p)([^>]*>)", "",$setmember_author);
		$setmember_author=str_replace("'", "''",$setmember_author);
		$setmember_date_create=trim(@$_POST["setmember_date_create"]);
		$setmember_update=trim(@$_POST["setmember_update"]);
		$setmember_update=str_replace("/(<\/?)(p)([^>]*>)", "",$setmember_update);
		$setmember_update=str_replace("'", "''",$setmember_update);
		$setmember_date_update=trim(@$_POST["setmember_date_update"]);
		$setmember_revised=trim(@$_POST["setmember_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_member_setup->member_setup_search($setmember_id ,$setmember_transhari ,$setmember_transbulan ,$setmember_periodeaktif ,$setmember_periodetanggang ,$setmember_transharitenggang ,$setmember_author ,$setmember_date_create ,$setmember_update ,$setmember_date_update ,$setmember_revised ,$start,$end);
		echo $result;
	}


	function member_setup_print(){
  		//POST varibale here
		$setmember_id=trim(@$_POST["setmember_id"]);
		$setmember_transhari=trim(@$_POST["setmember_transhari"]);
		$setmember_transbulan=trim(@$_POST["setmember_transbulan"]);
		$setmember_periodeaktif=trim(@$_POST["setmember_periodeaktif"]);
		$setmember_periodetanggang=trim(@$_POST["setmember_periodetanggang"]);
		$setmember_transharitenggang=trim(@$_POST["setmember_transharitenggang"]);
		$setmember_author=trim(@$_POST["setmember_author"]);
		$setmember_author=str_replace("/(<\/?)(p)([^>]*>)", "",$setmember_author);
		$setmember_author=str_replace("'", "'",$setmember_author);
		$setmember_date_create=trim(@$_POST["setmember_date_create"]);
		$setmember_update=trim(@$_POST["setmember_update"]);
		$setmember_update=str_replace("/(<\/?)(p)([^>]*>)", "",$setmember_update);
		$setmember_update=str_replace("'", "'",$setmember_update);
		$setmember_date_update=trim(@$_POST["setmember_date_update"]);
		$setmember_revised=trim(@$_POST["setmember_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$data["data_print"] = $this->m_member_setup->member_setup_print($setmember_id ,$setmember_transhari ,$setmember_transbulan ,$setmember_periodeaktif ,$setmember_periodetanggang ,$setmember_transharitenggang ,$setmember_author ,$setmember_date_create ,$setmember_update ,$setmember_date_update ,$setmember_revised ,$option,$filter);
		$print_view=$this->load->view("main/p_member_setup.php",$data,TRUE);
		if(!file_exists("print")){
			mkdir("print");
		}
		$print_file=fopen("print/member_setup_printlist.html","w+");
		fwrite($print_file, $print_view);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function member_setup_export_excel(){
		//POST varibale here
		$setmember_id=trim(@$_POST["setmember_id"]);
		$setmember_transhari=trim(@$_POST["setmember_transhari"]);
		$setmember_transbulan=trim(@$_POST["setmember_transbulan"]);
		$setmember_periodeaktif=trim(@$_POST["setmember_periodeaktif"]);
		$setmember_periodetanggang=trim(@$_POST["setmember_periodetanggang"]);
		$setmember_transharitenggang=trim(@$_POST["setmember_transharitenggang"]);
		$setmember_author=trim(@$_POST["setmember_author"]);
		$setmember_author=str_replace("/(<\/?)(p)([^>]*>)", "",$setmember_author);
		$setmember_author=str_replace("'", "\'",$setmember_author);
		$setmember_date_create=trim(@$_POST["setmember_date_create"]);
		$setmember_update=trim(@$_POST["setmember_update"]);
		$setmember_update=str_replace("/(<\/?)(p)([^>]*>)", "",$setmember_update);
		$setmember_update=str_replace("'", "\'",$setmember_update);
		$setmember_date_update=trim(@$_POST["setmember_date_update"]);
		$setmember_revised=trim(@$_POST["setmember_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_member_setup->member_setup_export_excel($setmember_id ,$setmember_transhari ,$setmember_transbulan ,$setmember_periodeaktif ,$setmember_periodetanggang ,$setmember_transharitenggang ,$setmember_author ,$setmember_date_create ,$setmember_update ,$setmember_date_update ,$setmember_revised ,$option,$filter);
		
		to_excel($query,"member_setup"); 
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