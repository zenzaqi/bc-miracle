<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: perawatan_alat Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_perawatan_alat.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of perawatan_alat
class C_perawatan_alat extends Controller {

	//constructor
	function C_perawatan_alat(){
		parent::Controller();
		$this->load->model('m_perawatan_alat', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_perawatan_alat');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->perawatan_alat_list();
				break;
			case "UPDATE":
				$this->perawatan_alat_update();
				break;
			case "CREATE":
				$this->perawatan_alat_create();
				break;
			case "DELETE":
				$this->perawatan_alat_delete();
				break;
			case "SEARCH":
				$this->perawatan_alat_search();
				break;
			case "PRINT":
				$this->perawatan_alat_print();
				break;
			case "EXCEL":
				$this->perawatan_alat_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function perawatan_alat_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_perawatan_alat->perawatan_alat_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function perawatan_alat_update(){
		//POST variable here
		$aperawatan_no=trim(@$_POST["aperawatan_no"]);
		$aperawatan_alat=trim(@$_POST["aperawatan_alat"]);
		$aperawatan_jumlah=trim(@$_POST["aperawatan_jumlah"]);
		$result = $this->m_perawatan_alat->perawatan_alat_update($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah );
		echo $result;
	}
	
	//function for create new record
	function perawatan_alat_create(){
		//POST varible here
		$aperawatan_no=trim(@$_POST["aperawatan_no"]);
		$aperawatan_alat=trim(@$_POST["aperawatan_alat"]);
		$aperawatan_jumlah=trim(@$_POST["aperawatan_jumlah"]);
		$result=$this->m_perawatan_alat->perawatan_alat_create($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah );
		echo $result;
	}

	//function for delete selected record
	function perawatan_alat_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_perawatan_alat->perawatan_alat_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function perawatan_alat_search(){
		//POST varibale here
		$aperawatan_no=trim(@$_POST["aperawatan_no"]);
		$aperawatan_alat=trim(@$_POST["aperawatan_alat"]);
		$aperawatan_jumlah=trim(@$_POST["aperawatan_jumlah"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_perawatan_alat->perawatan_alat_search($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ,$start,$end);
		echo $result;
	}


	function perawatan_alat_print(){
  		//POST varibale here
		$aperawatan_no=trim(@$_POST["aperawatan_no"]);
		$aperawatan_alat=trim(@$_POST["aperawatan_alat"]);
		$aperawatan_jumlah=trim(@$_POST["aperawatan_jumlah"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_perawatan_alat->perawatan_alat_print($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=3;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("perawatan_alatlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Perawatan_alat Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Perawatan_alat List'><caption>PERAWATAN_ALAT</caption><thead><tr><th scope='col'>Aperawatan No</th><th scope='col'>Aperawatan Alat</th><th scope='col'>Aperawatan Jumlah</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Perawatan_alat</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['aperawatan_no']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['aperawatan_alat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['aperawatan_jumlah']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function perawatan_alat_export_excel(){
		//POST varibale here
		$aperawatan_no=trim(@$_POST["aperawatan_no"]);
		$aperawatan_alat=trim(@$_POST["aperawatan_alat"]);
		$aperawatan_jumlah=trim(@$_POST["aperawatan_jumlah"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_perawatan_alat->perawatan_alat_export_excel($aperawatan_no ,$aperawatan_alat ,$aperawatan_jumlah ,$option,$filter);
		
		to_excel($query,"perawatan_alat"); 
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