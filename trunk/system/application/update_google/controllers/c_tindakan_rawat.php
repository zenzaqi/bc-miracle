<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: tindakan_rawat Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_tindakan_rawat.php
 	+ Author  		: 
 	+ Created on 02/Sep/2009 12:35:55
	
*/

//class of tindakan_rawat
class C_tindakan_rawat extends Controller {

	//constructor
	function C_tindakan_rawat(){
		parent::Controller();
		$this->load->model('m_tindakan_rawat', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_tindakan_rawat');
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_rawat_list($query,$start,$end);
		echo $result;
	}
	
	function get_karyawan_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_karyawan_list($query,$start,$end);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_tindakan_rawat_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_tindakan_rawat->detail_tindakan_rawat_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_tindakan_rawat_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_tindakan_rawat->detail_tindakan_rawat_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_tindakan_rawat->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_tindakan_rawat_detail_insert(){
	//POST variable here
		$dtrawat_id=trim(@$_POST["dtrawat_id"]);
		$dtrawat_master=trim(@$_POST["dtrawat_master"]);
		$dtrawat_perawatan=trim(@$_POST["dtrawat_perawatan"]);
		$dtrawat_status=trim(@$_POST["dtrawat_status"]);
		$dtrawat_status=str_replace("/(<\/?)(p)([^>]*>)", "",$dtrawat_status);
		$dtrawat_status=str_replace("\\", "",$dtrawat_status);
		$dtrawat_status=str_replace("'", '"',$dtrawat_status);
		$result=$this->m_tindakan_rawat->detail_tindakan_rawat_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_status );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->tindakan_rawat_list();
				break;
			case "UPDATE":
				$this->tindakan_rawat_update();
				break;
			case "CREATE":
				$this->tindakan_rawat_create();
				break;
			case "DELETE":
				$this->tindakan_rawat_delete();
				break;
			case "SEARCH":
				$this->tindakan_rawat_search();
				break;
			case "PRINT":
				$this->tindakan_rawat_print();
				break;
			case "EXCEL":
				$this->tindakan_rawat_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function tindakan_rawat_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_tindakan_rawat->tindakan_rawat_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function tindakan_rawat_update(){
		//POST variable here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_petugas=trim(@$_POST["trawat_petugas"]);
		$trawat_petugas2=trim(@$_POST["trawat_petugas2"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace(",", ",",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", '"',$trawat_keterangan);
		$result = $this->m_tindakan_rawat->tindakan_rawat_update($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function tindakan_rawat_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_petugas=trim(@$_POST["trawat_petugas"]);
		$trawat_petugas2=trim(@$_POST["trawat_petugas2"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", '"',$trawat_keterangan);
		$result=$this->m_tindakan_rawat->tindakan_rawat_create($trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan );
		echo $result;
	}

	//function for delete selected record
	function tindakan_rawat_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_tindakan_rawat->tindakan_rawat_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function tindakan_rawat_search(){
		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_petugas=trim(@$_POST["trawat_petugas"]);
		$trawat_petugas2=trim(@$_POST["trawat_petugas2"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", '"',$trawat_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_tindakan_rawat->tindakan_rawat_search($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ,$start,$end);
		echo $result;
	}


	function tindakan_rawat_print(){
  		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_petugas=trim(@$_POST["trawat_petugas"]);
		$trawat_petugas2=trim(@$_POST["trawat_petugas2"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", '"',$trawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_tindakan_rawat->tindakan_rawat_print($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("tindakan_rawatlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Tindakan_rawat Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Tindakan_rawat List'><caption>TINDAKAN_RAWAT</caption><thead><tr><th scope='col'>Trawat Id</th><th scope='col'>Trawat Cust</th><th scope='col'>Trawat Petugas</th><th scope='col'>Trawat Petugas2</th><th scope='col'>Trawat Keterangan</th><th scope='col'>Trawat Creator</th><th scope='col'>Trawat Date Create</th><th scope='col'>Trawat Update</th><th scope='col'>Trawat Date Update</th><th scope='col'>Trawat Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Tindakan_rawat</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['trawat_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['trawat_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['trawat_petugas']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['trawat_petugas2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['trawat_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function tindakan_rawat_export_excel(){
		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_petugas=trim(@$_POST["trawat_petugas"]);
		$trawat_petugas2=trim(@$_POST["trawat_petugas2"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", '"',$trawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_tindakan_rawat->tindakan_rawat_export_excel($trawat_id ,$trawat_cust ,$trawat_petugas ,$trawat_petugas2 ,$trawat_keterangan ,$option,$filter);
		
		to_excel($query,"tindakan_rawat"); 
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