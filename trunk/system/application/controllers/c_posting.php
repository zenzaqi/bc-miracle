<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: posting Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_posting.php
 	+ Author  		: 
 	+ Created on 06/Oct/2009 08:24:57
	
*/

//class of posting
class C_posting extends Controller {

	//constructor
	function C_posting(){
		parent::Controller();
		$this->load->model('m_posting', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->helper('asset');
		$this->load->view('main/v_posting');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->posting_list();
				break;
			case "UPDATE":
				$this->posting_update();
				break;
			case "CREATE":
				$this->posting_create();
				break;
			case "DELETE":
				$this->posting_delete();
				break;
			case "SEARCH":
				$this->posting_search();
				break;
			case "PRINT":
				$this->posting_print();
				break;
			case "EXCEL":
				$this->posting_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function posting_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_posting->posting_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function posting_update(){
		//POST variable here
		$posting_id=trim(@$_POST["posting_id"]);
		$posting_tglmulai=trim(@$_POST["posting_tglmulai"]);
		$posting_tglselesai=trim(@$_POST["posting_tglselesai"]);
		$result = $this->m_posting->posting_update($posting_id ,$posting_tglmulai ,$posting_tglselesai      );
		echo $result;
	}
	
	//function for create new record
	function posting_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$posting_tglmulai=trim(@$_POST["posting_tglmulai"]);
		$posting_tglselesai=trim(@$_POST["posting_tglselesai"]);
		$result=$this->m_posting->posting_create($posting_tglmulai ,$posting_tglselesai );
		echo $result;
	}

	//function for delete selected record
	function posting_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_posting->posting_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function posting_search(){
		//POST varibale here
		$posting_id=trim(@$_POST["posting_id"]);
		$posting_tglmulai=trim(@$_POST["posting_tglmulai"]);
		$posting_tglselesai=trim(@$_POST["posting_tglselesai"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_posting->posting_search($posting_id ,$posting_tglmulai ,$posting_tglselesai ,$start,$end);
		echo $result;
	}


	function posting_print(){
  		//POST varibale here
		$posting_id=trim(@$_POST["posting_id"]);
		$posting_tglmulai=trim(@$_POST["posting_tglmulai"]);
		$posting_tglselesai=trim(@$_POST["posting_tglselesai"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_posting->posting_print($posting_id ,$posting_tglmulai ,$posting_tglselesai ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("postinglist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Posting Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Posting List'><caption>POSTING</caption><thead><tr><th scope='col'>Posting Id</th><th scope='col'>Posting Tglmulai</th><th scope='col'>Posting Tglselesai</th><th scope='col'>Posting Creator</th><th scope='col'>Posting Date Create</th><th scope='col'>Posting Update</th><th scope='col'>Posting Date Update</th><th scope='col'>Posting Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Posting</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['posting_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['posting_tglmulai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['posting_tglselesai']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['posting_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['posting_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['posting_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['posting_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['posting_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function posting_export_excel(){
		//POST varibale here
		$posting_id=trim(@$_POST["posting_id"]);
		$posting_tglmulai=trim(@$_POST["posting_tglmulai"]);
		$posting_tglselesai=trim(@$_POST["posting_tglselesai"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_posting->posting_export_excel($posting_id ,$posting_tglmulai ,$posting_tglselesai ,$option,$filter);
		
		to_excel($query,"posting"); 
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