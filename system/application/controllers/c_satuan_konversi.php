<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: satuan_konversi Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_satuan_konversi.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of satuan_konversi
class C_satuan_konversi extends Controller {

	//constructor
	function C_satuan_konversi(){
		parent::Controller();
		$this->load->model('m_satuan_konversi', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_satuan_konversi');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->satuan_konversi_list();
				break;
			case "UPDATE":
				$this->satuan_konversi_update();
				break;
			case "CREATE":
				$this->satuan_konversi_create();
				break;
			case "DELETE":
				$this->satuan_konversi_delete();
				break;
			case "SEARCH":
				$this->satuan_konversi_search();
				break;
			case "PRINT":
				$this->satuan_konversi_print();
				break;
			case "EXCEL":
				$this->satuan_konversi_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function satuan_konversi_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_satuan_konversi->satuan_konversi_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function satuan_konversi_update(){
		//POST variable here
		$konversi_satuan=trim(@$_POST["konversi_satuan"]);
		$konversi_produk=trim(@$_POST["konversi_produk"]);
		$konversi_nilai=trim(@$_POST["konversi_nilai"]);
		$result = $this->m_satuan_konversi->satuan_konversi_update($konversi_satuan ,$konversi_produk ,$konversi_nilai );
		echo $result;
	}
	
	//function for create new record
	function satuan_konversi_create(){
		//POST varible here
		$konversi_satuan=trim(@$_POST["konversi_satuan"]);
		$konversi_produk=trim(@$_POST["konversi_produk"]);
		$konversi_nilai=trim(@$_POST["konversi_nilai"]);
		$result=$this->m_satuan_konversi->satuan_konversi_create($konversi_satuan ,$konversi_produk ,$konversi_nilai );
		echo $result;
	}

	//function for delete selected record
	function satuan_konversi_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_satuan_konversi->satuan_konversi_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function satuan_konversi_search(){
		//POST varibale here
		$konversi_satuan=trim(@$_POST["konversi_satuan"]);
		$konversi_produk=trim(@$_POST["konversi_produk"]);
		$konversi_nilai=trim(@$_POST["konversi_nilai"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_satuan_konversi->satuan_konversi_search($konversi_satuan ,$konversi_produk ,$konversi_nilai ,$start,$end);
		echo $result;
	}


	function satuan_konversi_print(){
  		//POST varibale here
		$konversi_satuan=trim(@$_POST["konversi_satuan"]);
		$konversi_produk=trim(@$_POST["konversi_produk"]);
		$konversi_nilai=trim(@$_POST["konversi_nilai"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_satuan_konversi->satuan_konversi_print($konversi_satuan ,$konversi_produk ,$konversi_nilai ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=3;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("satuan_konversilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Satuan_konversi Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Satuan_konversi List'><caption>SATUAN_KONVERSI</caption><thead><tr><th scope='col'>Konversi Satuan</th><th scope='col'>Konversi Produk</th><th scope='col'>Konversi Nilai</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Satuan_konversi</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['konversi_satuan']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['konversi_produk']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['konversi_nilai']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function satuan_konversi_export_excel(){
		//POST varibale here
		$konversi_satuan=trim(@$_POST["konversi_satuan"]);
		$konversi_produk=trim(@$_POST["konversi_produk"]);
		$konversi_nilai=trim(@$_POST["konversi_nilai"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_satuan_konversi->satuan_konversi_export_excel($konversi_satuan ,$konversi_produk ,$konversi_nilai ,$option,$filter);
		
		to_excel($query,"satuan_konversi"); 
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