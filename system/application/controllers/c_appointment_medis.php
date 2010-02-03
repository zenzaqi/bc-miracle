<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: appointment Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_appointment_medis.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 12:41:17
	
*/

//class of appointment
class C_appointment_medis extends Controller {

	//constructor
	function C_appointment_medis(){
		parent::Controller();
		$this->load->model('m_appointment_medis', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->helper('asset');
		$this->load->view('main/v_appointment_medis');
	}
	
	function get_customer_list(){
		$result=$this->m_public_function->get_customer_list();
		echo $result;
	}
	
	function get_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_rawat_medis_list($query,$start,$end);
		echo $result;
	}
	
	function get_dokter_list(){
		//ID dokter pada tabel departemen adalah 8
		$result=$this->m_public_function->get_petugas_list(8);
		echo $result;
	}
	
	function get_terapis_list(){
		//ID dokter pada tabel departemen adalah 9
		$result=$this->m_public_function->get_petugas_list(9);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_appointment_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_appointment_medis->detail_appointment_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_appointment_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_appointment_medis->detail_appointment_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_appointment_medis->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_appointment_detail_insert(){
	//POST variable here
		$dapp_id=trim(@$_POST["dapp_id"]);
		$dapp_master=trim(@$_POST["dapp_master"]);
		$dapp_perawatan=trim(@$_POST["dapp_perawatan"]);
		$dapp_tglreservasi=trim(@$_POST["dapp_tglreservasi"]);
		$dapp_jamreservasi=trim(@$_POST["dapp_jamreservasi"]);
		$dapp_jamreservasi=str_replace("/(<\/?)(p)([^>]*>)", "",$dapp_jamreservasi);
		$dapp_jamreservasi=str_replace("\\", "",$dapp_jamreservasi);
		$dapp_jamreservasi=str_replace("'", "''",$dapp_jamreservasi);
		$dapp_petugas=trim(@$_POST["dapp_petugas"]);
		$dapp_petugas2=trim(@$_POST["dapp_petugas2"]);
		$dapp_status=trim(@$_POST["dapp_status"]);
		$dapp_status=str_replace("/(<\/?)(p)([^>]*>)", "",$dapp_status);
		$dapp_status=str_replace("\\", "",$dapp_status);
		$dapp_status=str_replace("'", "''",$dapp_status);
		$dapp_tgldatang=trim(@$_POST["dapp_tgldatang"]);
		$dapp_jamdatang=trim(@$_POST["dapp_jamdatang"]);
		$dapp_jamdatang=str_replace("/(<\/?)(p)([^>]*>)", "",$dapp_jamdatang);
		$dapp_jamdatang=str_replace("\\", "",$dapp_jamdatang);
		$dapp_jamdatang=str_replace("'", "''",$dapp_jamdatang);
		$result=$this->m_appointment_medis->detail_appointment_detail_insert($dapp_id ,$dapp_master ,$dapp_perawatan ,$dapp_tglreservasi ,$dapp_jamreservasi ,$dapp_petugas ,$dapp_petugas2 ,$dapp_status ,$dapp_tgldatang ,$dapp_jamdatang );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->appointment_list();
				break;
			case "UPDATE":
				$this->appointment_update();
				break;
			case "CREATE":
				$this->appointment_create();
				break;
			case "DELETE":
				$this->appointment_delete();
				break;
			case "SEARCH":
				$this->appointment_search();
				break;
			case "PRINT":
				$this->appointment_print();
				break;
			case "EXCEL":
				$this->appointment_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function appointment_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_appointment_medis->appointment_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function appointment_update(){
		//POST variable here
		$app_id=trim(@$_POST["app_id"]);
		$app_customer=trim(@$_POST["app_customer"]);
		$app_tanggal=trim(@$_POST["app_tanggal"]);
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace(",", "\,",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace(",", "\,",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		$result = $this->m_appointment_medis->appointment_update($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function appointment_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$app_customer=trim(@$_POST["app_customer"]);
		$app_tanggal=trim(@$_POST["app_tanggal"]);
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		$result=$this->m_appointment_medis->appointment_create($app_customer ,$app_tanggal ,$app_cara ,$app_keterangan );
		echo $result;
	}

	//function for delete selected record
	function appointment_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_appointment_medis->appointment_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function appointment_search(){
		//POST varibale here
		$app_id=trim(@$_POST["app_id"]);
		$app_customer=trim(@$_POST["app_customer"]);
		$app_tanggal=trim(@$_POST["app_tanggal"]);
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_appointment_medis->appointment_search($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$start,$end);
		echo $result;
	}


	function appointment_print(){
  		//POST varibale here
		$app_id=trim(@$_POST["app_id"]);
		$app_customer=trim(@$_POST["app_customer"]);
		$app_tanggal=trim(@$_POST["app_tanggal"]);
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_appointment_medis->appointment_print($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("appointmentlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Appointment Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Appointment List'><caption>APPOINTMENT</caption><thead><tr><th scope='col'>App Id</th><th scope='col'>App Customer</th><th scope='col'>App Tanggal</th><th scope='col'>App Cara</th><th scope='col'>App Keterangan</th><th scope='col'>App Creator</th><th scope='col'>App Date Create</th><th scope='col'>App Update</th><th scope='col'>App Date Update</th><th scope='col'>App Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Appointment</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['app_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['app_customer']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['app_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['app_cara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['app_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['app_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['app_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['app_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['app_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['app_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function appointment_export_excel(){
		//POST varibale here
		$app_id=trim(@$_POST["app_id"]);
		$app_customer=trim(@$_POST["app_customer"]);
		$app_tanggal=trim(@$_POST["app_tanggal"]);
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_appointment_medis->appointment_export_excel($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$option,$filter);
		
		to_excel($query,"appointment"); 
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