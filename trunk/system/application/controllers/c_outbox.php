<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: outbox Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_outbox.php
 	+ creator  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/

//class of outbox
class C_outbox extends Controller {

	//constructor
	function C_outbox(){
		parent::Controller();
		$this->load->model('m_outbox', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->helper('asset');
		$this->load->view('main/v_outbox');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->outbox_list();
				break;
			case "UPDATE":
				$this->outbox_update();
				break;
			case "CREATE":
				$this->outbox_create();
				break;
			case "DELETE":
				$this->outbox_delete();
				break;
			case "SEARCH":
				$this->outbox_search();
				break;
			case "PRINT":
				$this->outbox_print();
				break;
			case "EXCEL":
				$this->outbox_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function outbox_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_outbox->outbox_list($query,$start,$end);
		echo $result;
	}
	
	//function for create new record
	function outbox_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$outbox_destination=trim(@$_POST["outbox_destination"]);
		$outbox_destination=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_destination);
		$outbox_destination=str_replace("'", "''",$outbox_destination);
		$outbox_message=trim(@$_POST["outbox_message"]);
		$outbox_message=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_message);
		$outbox_message=str_replace("'", "''",$outbox_message);
		$outbox_date=trim(@$_POST["outbox_date"]);
		$outbox_creator=@$_SESSION["userid"];
		$outbox_date_create=date('m/d/Y');
		//$outbox_update=NULL;
		//$outbox_date_update=NULL;
		//$outbox_revised=0;
		$result=$this->m_outbox->outbox_create($outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create );
		echo $result;
	}
	
	
	//function for update record
	function outbox_update(){
		//POST variable here
		$outbox_id=trim(@$_POST["outbox_id"]);
		$outbox_destination=trim(@$_POST["outbox_destination"]);
		$outbox_destination=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_destination);
		$outbox_destination=str_replace("'", "''",$outbox_destination);
		$outbox_message=trim(@$_POST["outbox_message"]);
		$outbox_message=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_message);
		$outbox_message=str_replace("'", "''",$outbox_message);
		$outbox_date=trim(@$_POST["outbox_date"]);
		//$outbox_creator="outbox_creator";
		//$outbox_date_create="outbox_date_create";
		$outbox_update=@$_SESSION["userid"];
		$outbox_date_update=date('m/d/Y');
		//$outbox_revised="(revised+1)";
		$result = $this->m_outbox->outbox_update($outbox_id,$outbox_destination,$outbox_message,$outbox_date,$outbox_update,$outbox_date_update);
		echo $result;
	}
	
	//function for delete selected record
	function outbox_delete(){
		$ids = @$_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_outbox->outbox_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function outbox_search(){
		//POST varibale here
		$outbox_id=trim(@$_POST["outbox_id"]);
		$outbox_destination=trim(@$_POST["outbox_destination"]);
		$outbox_destination=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_destination);
		$outbox_destination=str_replace("'", "''",$outbox_destination);
		$outbox_message=trim(@$_POST["outbox_message"]);
		$outbox_message=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_message);
		$outbox_message=str_replace("'", "''",$outbox_message);
		$outbox_date=trim(@$_POST["outbox_date"]);
		$outbox_creator=trim(@$_POST["outbox_creator"]);
		$outbox_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_creator);
		$outbox_creator=str_replace("'", "''",$outbox_creator);
		$outbox_date_create=trim(@$_POST["outbox_date_create"]);
		$outbox_update=trim(@$_POST["outbox_update"]);
		$outbox_update=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_update);
		$outbox_update=str_replace("'", "''",$outbox_update);
		$outbox_date_update=trim(@$_POST["outbox_date_update"]);
		$outbox_revised=trim(@$_POST["outbox_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_outbox->outbox_search($outbox_id ,$outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ,$outbox_update ,$outbox_date_update ,$outbox_revised ,$start,$end);
		echo $result;
	}


	function outbox_print(){
  		//POST varibale here
		$outbox_id=trim(@$_POST["outbox_id"]);
		$outbox_destination=trim(@$_POST["outbox_destination"]);
		$outbox_destination=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_destination);
		$outbox_destination=str_replace("'", "'",$outbox_destination);
		$outbox_message=trim(@$_POST["outbox_message"]);
		$outbox_message=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_message);
		$outbox_message=str_replace("'", "'",$outbox_message);
		$outbox_date=trim(@$_POST["outbox_date"]);
		$outbox_creator=trim(@$_POST["outbox_creator"]);
		$outbox_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_creator);
		$outbox_creator=str_replace("'", "'",$outbox_creator);
		$outbox_date_create=trim(@$_POST["outbox_date_create"]);
		$outbox_update=trim(@$_POST["outbox_update"]);
		$outbox_update=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_update);
		$outbox_update=str_replace("'", "'",$outbox_update);
		$outbox_date_update=trim(@$_POST["outbox_date_update"]);
		$outbox_revised=trim(@$_POST["outbox_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$data["data_print"] = $this->m_outbox->outbox_print($outbox_id ,$outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ,$outbox_update ,$outbox_date_update ,$outbox_revised ,$option,$filter);
		$print_view=$this->load->view("main/p_outbox.php",$data,TRUE);
		if(!file_exists("print")){
			mkdir("print");
		}
		$print_file=fopen("print/outbox_printlist.html","w+");
		fwrite($print_file, $print_view);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function outbox_export_excel(){
		//POST varibale here
		$outbox_id=trim(@$_POST["outbox_id"]);
		$outbox_destination=trim(@$_POST["outbox_destination"]);
		$outbox_destination=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_destination);
		$outbox_destination=str_replace("'", "''",$outbox_destination);
		$outbox_message=trim(@$_POST["outbox_message"]);
		$outbox_message=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_message);
		$outbox_message=str_replace("'", "''",$outbox_message);
		$outbox_date=trim(@$_POST["outbox_date"]);
		$outbox_creator=trim(@$_POST["outbox_creator"]);
		$outbox_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_creator);
		$outbox_creator=str_replace("'", "''",$outbox_creator);
		$outbox_date_create=trim(@$_POST["outbox_date_create"]);
		$outbox_update=trim(@$_POST["outbox_update"]);
		$outbox_update=str_replace("/(<\/?)(p)([^>]*>)", "",$outbox_update);
		$outbox_update=str_replace("'", "''",$outbox_update);
		$outbox_date_update=trim(@$_POST["outbox_date_update"]);
		$outbox_revised=trim(@$_POST["outbox_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_outbox->outbox_export_excel($outbox_id ,$outbox_destination ,$outbox_message ,$outbox_date ,$outbox_creator ,$outbox_date_create ,$outbox_update ,$outbox_date_update ,$outbox_revised ,$option,$filter);
		
		to_excel($query,"outbox"); 
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