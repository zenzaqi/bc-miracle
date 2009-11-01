<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: sms_inbox Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_sms_inbox.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of sms_inbox
class C_sms_inbox extends Controller {

	//constructor
	function C_sms_inbox(){
		parent::Controller();
		$this->load->model('m_sms_inbox', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_sms_inbox');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->sms_inbox_list();
				break;
			case "UPDATE":
				$this->sms_inbox_update();
				break;
			case "CREATE":
				$this->sms_inbox_create();
				break;
			case "DELETE":
				$this->sms_inbox_delete();
				break;
			case "SEARCH":
				$this->sms_inbox_search();
				break;
			case "PRINT":
				$this->sms_inbox_print();
				break;
			case "EXCEL":
				$this->sms_inbox_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function sms_inbox_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_sms_inbox->sms_inbox_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function sms_inbox_update(){
		//POST variable here
		$isms_id=trim(@$_POST["isms_id"]);
		$isms_number=trim(@$_POST["isms_number"]);
		$isms_number=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_number);
		$isms_number=str_replace("'", '"',$isms_number);
		$isms_tanggal=trim(@$_POST["isms_tanggal"]);
		$isms_isi=trim(@$_POST["isms_isi"]);
		$isms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_isi);
		$isms_isi=str_replace("'", '"',$isms_isi);
		$isms_status=trim(@$_POST["isms_status"]);
		$isms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_status);
		$isms_status=str_replace("'", '"',$isms_status);
		$result = $this->m_sms_inbox->sms_inbox_update($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status );
		echo $result;
	}
	
	//function for create new record
	function sms_inbox_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$isms_number=trim(@$_POST["isms_number"]);
		$isms_number=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_number);
		$isms_number=str_replace("'", '"',$isms_number);
		$isms_tanggal=trim(@$_POST["isms_tanggal"]);
		$isms_isi=trim(@$_POST["isms_isi"]);
		$isms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_isi);
		$isms_isi=str_replace("'", '"',$isms_isi);
		$isms_status=trim(@$_POST["isms_status"]);
		$isms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_status);
		$isms_status=str_replace("'", '"',$isms_status);
		$result=$this->m_sms_inbox->sms_inbox_create($isms_number ,$isms_tanggal ,$isms_isi ,$isms_status );
		echo $result;
	}

	//function for delete selected record
	function sms_inbox_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_sms_inbox->sms_inbox_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function sms_inbox_search(){
		//POST varibale here
		$isms_id=trim(@$_POST["isms_id"]);
		$isms_number=trim(@$_POST["isms_number"]);
		$isms_number=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_number);
		$isms_number=str_replace("'", '"',$isms_number);
		$isms_tanggal=trim(@$_POST["isms_tanggal"]);
		$isms_isi=trim(@$_POST["isms_isi"]);
		$isms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_isi);
		$isms_isi=str_replace("'", '"',$isms_isi);
		$isms_status=trim(@$_POST["isms_status"]);
		$isms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_status);
		$isms_status=str_replace("'", '"',$isms_status);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_sms_inbox->sms_inbox_search($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ,$start,$end);
		echo $result;
	}


	function sms_inbox_print(){
  		//POST varibale here
		$isms_id=trim(@$_POST["isms_id"]);
		$isms_number=trim(@$_POST["isms_number"]);
		$isms_number=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_number);
		$isms_number=str_replace("'", '"',$isms_number);
		$isms_tanggal=trim(@$_POST["isms_tanggal"]);
		$isms_isi=trim(@$_POST["isms_isi"]);
		$isms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_isi);
		$isms_isi=str_replace("'", '"',$isms_isi);
		$isms_status=trim(@$_POST["isms_status"]);
		$isms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_status);
		$isms_status=str_replace("'", '"',$isms_status);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_sms_inbox->sms_inbox_print($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=5;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("sms_inboxlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Sms_inbox Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Sms_inbox List'><caption>SMS_INBOX</caption><thead><tr><th scope='col'>Isms Id</th><th scope='col'>Isms Number</th><th scope='col'>Isms Tanggal</th><th scope='col'>Isms Isi</th><th scope='col'>Isms Status</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Sms_inbox</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['isms_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['isms_number']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['isms_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['isms_isi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['isms_status']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function sms_inbox_export_excel(){
		//POST varibale here
		$isms_id=trim(@$_POST["isms_id"]);
		$isms_number=trim(@$_POST["isms_number"]);
		$isms_number=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_number);
		$isms_number=str_replace("'", '"',$isms_number);
		$isms_tanggal=trim(@$_POST["isms_tanggal"]);
		$isms_isi=trim(@$_POST["isms_isi"]);
		$isms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_isi);
		$isms_isi=str_replace("'", '"',$isms_isi);
		$isms_status=trim(@$_POST["isms_status"]);
		$isms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$isms_status);
		$isms_status=str_replace("'", '"',$isms_status);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_sms_inbox->sms_inbox_export_excel($isms_id ,$isms_number ,$isms_tanggal ,$isms_isi ,$isms_status ,$option,$filter);
		
		to_excel($query,"sms_inbox"); 
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