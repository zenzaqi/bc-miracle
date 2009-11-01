<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: sms_code Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_sms_code.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of sms_code
class C_sms_code extends Controller {

	//constructor
	function C_sms_code(){
		parent::Controller();
		$this->load->model('m_sms_code', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_sms_code');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->sms_code_list();
				break;
			case "UPDATE":
				$this->sms_code_update();
				break;
			case "CREATE":
				$this->sms_code_create();
				break;
			case "DELETE":
				$this->sms_code_delete();
				break;
			case "SEARCH":
				$this->sms_code_search();
				break;
			case "PRINT":
				$this->sms_code_print();
				break;
			case "EXCEL":
				$this->sms_code_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function sms_code_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_sms_code->sms_code_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function sms_code_update(){
		//POST variable here
		$code_id=trim(@$_POST["code_id"]);
		$code_name=trim(@$_POST["code_name"]);
		$code_name=str_replace("/(<\/?)(p)([^>]*>)", "",$code_name);
		$code_name=str_replace("'", '"',$code_name);
		$code_query=trim(@$_POST["code_query"]);
		$code_query=str_replace("/(<\/?)(p)([^>]*>)", "",$code_query);
		$code_query=str_replace("'", '"',$code_query);
		$result = $this->m_sms_code->sms_code_update($code_id ,$code_name ,$code_query );
		echo $result;
	}
	
	//function for create new record
	function sms_code_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$code_name=trim(@$_POST["code_name"]);
		$code_name=str_replace("/(<\/?)(p)([^>]*>)", "",$code_name);
		$code_name=str_replace("'", '"',$code_name);
		$code_query=trim(@$_POST["code_query"]);
		$code_query=str_replace("/(<\/?)(p)([^>]*>)", "",$code_query);
		$code_query=str_replace("'", '"',$code_query);
		$result=$this->m_sms_code->sms_code_create($code_name ,$code_query );
		echo $result;
	}

	//function for delete selected record
	function sms_code_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_sms_code->sms_code_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function sms_code_search(){
		//POST varibale here
		$code_id=trim(@$_POST["code_id"]);
		$code_name=trim(@$_POST["code_name"]);
		$code_name=str_replace("/(<\/?)(p)([^>]*>)", "",$code_name);
		$code_name=str_replace("'", '"',$code_name);
		$code_query=trim(@$_POST["code_query"]);
		$code_query=str_replace("/(<\/?)(p)([^>]*>)", "",$code_query);
		$code_query=str_replace("'", '"',$code_query);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_sms_code->sms_code_search($code_id ,$code_name ,$code_query ,$start,$end);
		echo $result;
	}


	function sms_code_print(){
  		//POST varibale here
		$code_id=trim(@$_POST["code_id"]);
		$code_name=trim(@$_POST["code_name"]);
		$code_name=str_replace("/(<\/?)(p)([^>]*>)", "",$code_name);
		$code_name=str_replace("'", '"',$code_name);
		$code_query=trim(@$_POST["code_query"]);
		$code_query=str_replace("/(<\/?)(p)([^>]*>)", "",$code_query);
		$code_query=str_replace("'", '"',$code_query);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_sms_code->sms_code_print($code_id ,$code_name ,$code_query ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=3;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("sms_codelist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Sms_code Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Sms_code List'><caption>SMS_CODE</caption><thead><tr><th scope='col'>Code Id</th><th scope='col'>Code Name</th><th scope='col'>Code Query</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Sms_code</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['code_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['code_name']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['code_query']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function sms_code_export_excel(){
		//POST varibale here
		$code_id=trim(@$_POST["code_id"]);
		$code_name=trim(@$_POST["code_name"]);
		$code_name=str_replace("/(<\/?)(p)([^>]*>)", "",$code_name);
		$code_name=str_replace("'", '"',$code_name);
		$code_query=trim(@$_POST["code_query"]);
		$code_query=str_replace("/(<\/?)(p)([^>]*>)", "",$code_query);
		$code_query=str_replace("'", '"',$code_query);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_sms_code->sms_code_export_excel($code_id ,$code_name ,$code_query ,$option,$filter);
		
		to_excel($query,"sms_code"); 
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
	
	// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
	function codeDate ($date) {
	  $tab = explode ("-", $date);
	  $r = $tab[1]."/".$tab[2]."/".$tab[0];
	  return $r;
	}
	
}
?>