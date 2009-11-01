<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: konsul_rawat Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_konsul_rawat.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 01:12:06
	
*/

//class of konsul_rawat
class C_konsul_rawat extends Controller {

	//constructor
	function C_konsul_rawat(){
		parent::Controller();
		$this->load->model('m_konsul_rawat', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_konsul_rawat');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->konsul_rawat_list();
				break;
			case "UPDATE":
				$this->konsul_rawat_update();
				break;
			case "CREATE":
				$this->konsul_rawat_create();
				break;
			case "DELETE":
				$this->konsul_rawat_delete();
				break;
			case "SEARCH":
				$this->konsul_rawat_search();
				break;
			case "PRINT":
				$this->konsul_rawat_print();
				break;
			case "EXCEL":
				$this->konsul_rawat_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function konsul_rawat_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_konsul_rawat->konsul_rawat_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function konsul_rawat_update(){
		//POST variable here
		$krawat_konsul=trim(@$_POST["krawat_konsul"]);
		$krawat_nama=trim(@$_POST["krawat_nama"]);
		$krawat_jumlah=trim(@$_POST["krawat_jumlah"]);
		$result = $this->m_konsul_rawat->konsul_rawat_update($krawat_konsul ,$krawat_nama ,$krawat_jumlah );
		echo $result;
	}
	
	//function for create new record
	function konsul_rawat_create(){
		//POST varible here
		$krawat_konsul=trim(@$_POST["krawat_konsul"]);
		$krawat_nama=trim(@$_POST["krawat_nama"]);
		$krawat_jumlah=trim(@$_POST["krawat_jumlah"]);
		$result=$this->m_konsul_rawat->konsul_rawat_create($krawat_konsul ,$krawat_nama ,$krawat_jumlah );
		echo $result;
	}

	//function for delete selected record
	function konsul_rawat_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_konsul_rawat->konsul_rawat_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function konsul_rawat_search(){
		//POST varibale here
		$krawat_konsul=trim(@$_POST["krawat_konsul"]);
		$krawat_nama=trim(@$_POST["krawat_nama"]);
		$krawat_jumlah=trim(@$_POST["krawat_jumlah"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_konsul_rawat->konsul_rawat_search($krawat_konsul ,$krawat_nama ,$krawat_jumlah ,$start,$end);
		echo $result;
	}


	function konsul_rawat_print(){
  		//POST varibale here
		$krawat_konsul=trim(@$_POST["krawat_konsul"]);
		$krawat_nama=trim(@$_POST["krawat_nama"]);
		$krawat_jumlah=trim(@$_POST["krawat_jumlah"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_konsul_rawat->konsul_rawat_print($krawat_konsul ,$krawat_nama ,$krawat_jumlah ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=3;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("konsul_rawatlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Konsul_rawat Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Konsul_rawat List'><caption>KONSUL_RAWAT</caption><thead><tr><th scope='col'>Krawat Konsul</th><th scope='col'>Krawat Nama</th><th scope='col'>Krawat Jumlah</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Konsul_rawat</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['krawat_konsul']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['krawat_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['krawat_jumlah']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function konsul_rawat_export_excel(){
		//POST varibale here
		$krawat_konsul=trim(@$_POST["krawat_konsul"]);
		$krawat_nama=trim(@$_POST["krawat_nama"]);
		$krawat_jumlah=trim(@$_POST["krawat_jumlah"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_konsul_rawat->konsul_rawat_export_excel($krawat_konsul ,$krawat_nama ,$krawat_jumlah ,$option,$filter);
		
		to_excel($query,"konsul_rawat"); 
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