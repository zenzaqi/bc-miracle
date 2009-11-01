<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: konsultansi Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_konsultansi.php
 	+ Author  		: 
 	+ Created on 06/Oct/2009 08:41:02
	
*/

//class of konsultansi
class C_konsultansi extends Controller {

	//constructor
	function C_konsultansi(){
		parent::Controller();
		$this->load->model('m_konsultansi', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_konsultansi');
	}
	
	//for detail action
	//list detail handler action
	function  detail_konsul_diagnosa_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_konsultansi->detail_konsul_diagnosa_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_konsul_diagnosa_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_konsultansi->detail_konsul_diagnosa_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_konsultansi->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_konsul_diagnosa_insert(){
	//POST variable here
		$kdiagnosa_id=trim(@$_POST["kdiagnosa_id"]);
		$kdiagnosa_master=trim(@$_POST["kdiagnosa_master"]);
		$kdiagnosa_nama=trim(@$_POST["kdiagnosa_nama"]);
		$kdiganosa_keterangan=trim(@$_POST["kdiganosa_keterangan"]);
		$kdiganosa_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kdiganosa_keterangan);
		$kdiganosa_keterangan=str_replace("\\", "",$kdiganosa_keterangan);
		$kdiganosa_keterangan=str_replace("'", '"',$kdiganosa_keterangan);
		$result=$this->m_konsultansi->detail_konsul_diagnosa_insert($kdiagnosa_id ,$kdiagnosa_master ,$kdiagnosa_nama ,$kdiganosa_keterangan );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->konsultansi_list();
				break;
			case "UPDATE":
				$this->konsultansi_update();
				break;
			case "CREATE":
				$this->konsultansi_create();
				break;
			case "DELETE":
				$this->konsultansi_delete();
				break;
			case "SEARCH":
				$this->konsultansi_search();
				break;
			case "PRINT":
				$this->konsultansi_print();
				break;
			case "EXCEL":
				$this->konsultansi_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function konsultansi_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_konsultansi->konsultansi_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function konsultansi_update(){
		//POST variable here
		$konsul_id=trim(@$_POST["konsul_id"]);
		$konsul_cust=trim(@$_POST["konsul_cust"]);
		$konsul_dokter=trim(@$_POST["konsul_dokter"]);
		$konsul_tanggal=trim(@$_POST["konsul_tanggal"]);
		$konsul_keterangan=trim(@$_POST["konsul_keterangan"]);
		$konsul_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$konsul_keterangan);
		$konsul_keterangan=str_replace(",", ",",$konsul_keterangan);
		$konsul_keterangan=str_replace("'", '"',$konsul_keterangan);
		$result = $this->m_konsultansi->konsultansi_update($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function konsultansi_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$konsul_cust=trim(@$_POST["konsul_cust"]);
		$konsul_dokter=trim(@$_POST["konsul_dokter"]);
		$konsul_tanggal=trim(@$_POST["konsul_tanggal"]);
		$konsul_keterangan=trim(@$_POST["konsul_keterangan"]);
		$konsul_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$konsul_keterangan);
		$konsul_keterangan=str_replace("'", '"',$konsul_keterangan);
		$result=$this->m_konsultansi->konsultansi_create($konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan );
		echo $result;
	}

	//function for delete selected record
	function konsultansi_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_konsultansi->konsultansi_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function konsultansi_search(){
		//POST varibale here
		$konsul_id=trim(@$_POST["konsul_id"]);
		$konsul_cust=trim(@$_POST["konsul_cust"]);
		$konsul_dokter=trim(@$_POST["konsul_dokter"]);
		$konsul_tanggal=trim(@$_POST["konsul_tanggal"]);
		$konsul_keterangan=trim(@$_POST["konsul_keterangan"]);
		$konsul_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$konsul_keterangan);
		$konsul_keterangan=str_replace("'", '"',$konsul_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_konsultansi->konsultansi_search($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ,$start,$end);
		echo $result;
	}


	function konsultansi_print(){
  		//POST varibale here
		$konsul_id=trim(@$_POST["konsul_id"]);
		$konsul_cust=trim(@$_POST["konsul_cust"]);
		$konsul_dokter=trim(@$_POST["konsul_dokter"]);
		$konsul_tanggal=trim(@$_POST["konsul_tanggal"]);
		$konsul_keterangan=trim(@$_POST["konsul_keterangan"]);
		$konsul_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$konsul_keterangan);
		$konsul_keterangan=str_replace("'", '"',$konsul_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_konsultansi->konsultansi_print($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("konsultansilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Konsultansi Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Konsultansi List'><caption>KONSULTANSI</caption><thead><tr><th scope='col'>Konsul Id</th><th scope='col'>Konsul Cust</th><th scope='col'>Konsul Dokter</th><th scope='col'>Konsul Tanggal</th><th scope='col'>Konsul Keterangan</th><th scope='col'>Konsul Creator</th><th scope='col'>Konsul Date Create</th><th scope='col'>Konsul Update</th><th scope='col'>Konsul Date Update</th><th scope='col'>Konsul Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Konsultansi</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['konsul_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['konsul_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['konsul_dokter']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['konsul_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['konsul_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['konsul_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['konsul_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['konsul_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['konsul_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['konsul_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function konsultansi_export_excel(){
		//POST varibale here
		$konsul_id=trim(@$_POST["konsul_id"]);
		$konsul_cust=trim(@$_POST["konsul_cust"]);
		$konsul_dokter=trim(@$_POST["konsul_dokter"]);
		$konsul_tanggal=trim(@$_POST["konsul_tanggal"]);
		$konsul_keterangan=trim(@$_POST["konsul_keterangan"]);
		$konsul_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$konsul_keterangan);
		$konsul_keterangan=str_replace("'", '"',$konsul_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_konsultansi->konsultansi_export_excel($konsul_id ,$konsul_cust ,$konsul_dokter ,$konsul_tanggal ,$konsul_keterangan ,$option,$filter);
		
		to_excel($query,"konsultansi"); 
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