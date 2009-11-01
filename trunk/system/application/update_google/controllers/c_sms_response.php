<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: sms_response Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_sms_response.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of sms_response
class C_sms_response extends Controller {

	//constructor
	function C_sms_response(){
		parent::Controller();
		$this->load->model('m_sms_response', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_sms_response');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->sms_response_list();
				break;
			case "UPDATE":
				$this->sms_response_update();
				break;
			case "CREATE":
				$this->sms_response_create();
				break;
			case "DELETE":
				$this->sms_response_delete();
				break;
			case "SEARCH":
				$this->sms_response_search();
				break;
			case "PRINT":
				$this->sms_response_print();
				break;
			case "EXCEL":
				$this->sms_response_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function sms_response_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_sms_response->sms_response_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function sms_response_update(){
		//POST variable here
		$response_id=trim(@$_POST["response_id"]);
		$response_receive=trim(@$_POST["response_receive"]);
		$response_receive=str_replace("/(<\/?)(p)([^>]*>)", "",$response_receive);
		$response_receive=str_replace("'", '"',$response_receive);
		$response_proccess=trim(@$_POST["response_proccess"]);
		$response_proccess=str_replace("/(<\/?)(p)([^>]*>)", "",$response_proccess);
		$response_proccess=str_replace("'", '"',$response_proccess);
		$response_reply=trim(@$_POST["response_reply"]);
		$response_reply=str_replace("/(<\/?)(p)([^>]*>)", "",$response_reply);
		$response_reply=str_replace("'", '"',$response_reply);
		$response_security=trim(@$_POST["response_security"]);
		$response_security=str_replace("/(<\/?)(p)([^>]*>)", "",$response_security);
		$response_security=str_replace("'", '"',$response_security);
		$result = $this->m_sms_response->sms_response_update($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security );
		echo $result;
	}
	
	//function for create new record
	function sms_response_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$response_receive=trim(@$_POST["response_receive"]);
		$response_receive=str_replace("/(<\/?)(p)([^>]*>)", "",$response_receive);
		$response_receive=str_replace("'", '"',$response_receive);
		$response_proccess=trim(@$_POST["response_proccess"]);
		$response_proccess=str_replace("/(<\/?)(p)([^>]*>)", "",$response_proccess);
		$response_proccess=str_replace("'", '"',$response_proccess);
		$response_reply=trim(@$_POST["response_reply"]);
		$response_reply=str_replace("/(<\/?)(p)([^>]*>)", "",$response_reply);
		$response_reply=str_replace("'", '"',$response_reply);
		$response_security=trim(@$_POST["response_security"]);
		$response_security=str_replace("/(<\/?)(p)([^>]*>)", "",$response_security);
		$response_security=str_replace("'", '"',$response_security);
		$result=$this->m_sms_response->sms_response_create($response_receive ,$response_proccess ,$response_reply ,$response_security );
		echo $result;
	}

	//function for delete selected record
	function sms_response_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_sms_response->sms_response_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function sms_response_search(){
		//POST varibale here
		$response_id=trim(@$_POST["response_id"]);
		$response_receive=trim(@$_POST["response_receive"]);
		$response_receive=str_replace("/(<\/?)(p)([^>]*>)", "",$response_receive);
		$response_receive=str_replace("'", '"',$response_receive);
		$response_proccess=trim(@$_POST["response_proccess"]);
		$response_proccess=str_replace("/(<\/?)(p)([^>]*>)", "",$response_proccess);
		$response_proccess=str_replace("'", '"',$response_proccess);
		$response_reply=trim(@$_POST["response_reply"]);
		$response_reply=str_replace("/(<\/?)(p)([^>]*>)", "",$response_reply);
		$response_reply=str_replace("'", '"',$response_reply);
		$response_security=trim(@$_POST["response_security"]);
		$response_security=str_replace("/(<\/?)(p)([^>]*>)", "",$response_security);
		$response_security=str_replace("'", '"',$response_security);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_sms_response->sms_response_search($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ,$start,$end);
		echo $result;
	}


	function sms_response_print(){
  		//POST varibale here
		$response_id=trim(@$_POST["response_id"]);
		$response_receive=trim(@$_POST["response_receive"]);
		$response_receive=str_replace("/(<\/?)(p)([^>]*>)", "",$response_receive);
		$response_receive=str_replace("'", '"',$response_receive);
		$response_proccess=trim(@$_POST["response_proccess"]);
		$response_proccess=str_replace("/(<\/?)(p)([^>]*>)", "",$response_proccess);
		$response_proccess=str_replace("'", '"',$response_proccess);
		$response_reply=trim(@$_POST["response_reply"]);
		$response_reply=str_replace("/(<\/?)(p)([^>]*>)", "",$response_reply);
		$response_reply=str_replace("'", '"',$response_reply);
		$response_security=trim(@$_POST["response_security"]);
		$response_security=str_replace("/(<\/?)(p)([^>]*>)", "",$response_security);
		$response_security=str_replace("'", '"',$response_security);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_sms_response->sms_response_print($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=5;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("sms_responselist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Sms_response Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Sms_response List'><caption>SMS_RESPONSE</caption><thead><tr><th scope='col'>Response Id</th><th scope='col'>Response Receive</th><th scope='col'>Response Proccess</th><th scope='col'>Response Reply</th><th scope='col'>Response Security</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Sms_response</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['response_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['response_receive']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['response_proccess']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['response_reply']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['response_security']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function sms_response_export_excel(){
		//POST varibale here
		$response_id=trim(@$_POST["response_id"]);
		$response_receive=trim(@$_POST["response_receive"]);
		$response_receive=str_replace("/(<\/?)(p)([^>]*>)", "",$response_receive);
		$response_receive=str_replace("'", '"',$response_receive);
		$response_proccess=trim(@$_POST["response_proccess"]);
		$response_proccess=str_replace("/(<\/?)(p)([^>]*>)", "",$response_proccess);
		$response_proccess=str_replace("'", '"',$response_proccess);
		$response_reply=trim(@$_POST["response_reply"]);
		$response_reply=str_replace("/(<\/?)(p)([^>]*>)", "",$response_reply);
		$response_reply=str_replace("'", '"',$response_reply);
		$response_security=trim(@$_POST["response_security"]);
		$response_security=str_replace("/(<\/?)(p)([^>]*>)", "",$response_security);
		$response_security=str_replace("'", '"',$response_security);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_sms_response->sms_response_export_excel($response_id ,$response_receive ,$response_proccess ,$response_reply ,$response_security ,$option,$filter);
		
		to_excel($query,"sms_response"); 
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