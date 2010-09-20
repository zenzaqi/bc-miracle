<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: appointment Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_appointment.php
 	+ Author  		: masongbee
 	+ Created on 29/Oct/2009 13:33:53
	
*/

//class of appointment
class C_appointment extends Controller {

	//constructor
	function C_appointment(){
		parent::Controller();
		session_start();
		$this->load->model('m_appointment', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_appointment');
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_rawat_medis_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$query = str_replace(" ", "%",$query);
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_rawat_medis_list($query,$start,$end);
		echo $result;
	}
	
	function get_rawat_nonmedis_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$query = str_replace(" ", "%",$query);
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_rawat_nonmedis_list($query,$start,$end);
		echo $result;
	}
	
	function get_dokter_list(){
		//ID dokter pada tabel departemen adalah 8
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_appointment->get_dokter_list($query,$tgl_app,"Dokter");
		echo $result;
	}
	
	function get_terapis_list(){
		//ID dokter pada tabel departemen adalah 9
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_appointment->get_terapis_list($query,$tgl_app,"Therapist");
		echo $result;
	}
	
	//for detail action
	//list detail medis handler action
	function  detail_appointment_detail_medis_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_appointment->detail_appointment_detail_medis_list($master_id,$query,$start,$end);
		echo $result;
	}
	//list detail nonmedis handler action
	function  detail_appointment_detail_nonmedis_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_appointment->detail_appointment_detail_nonmedis_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//add detail
	function detail_appointment_detail_medis_insert(){
		//POST variable here
		$dapp_medis_id = $_POST['dapp_medis_id']; // Get our array back and translate it :
		$array_dapp_medis_id = json_decode(stripslashes($dapp_medis_id));
		
		$dapp_medis_master=trim(@$_POST["dapp_medis_master"]);
		
		$dapp_medis_perawatan = $_POST['dapp_medis_perawatan']; // Get our array back and translate it :
		$array_dapp_medis_perawatan = json_decode(stripslashes($dapp_medis_perawatan));
		
		$dapp_medis_tglreservasi = $_POST['dapp_medis_tglreservasi']; // Get our array back and translate it :
		$array_dapp_medis_tglreservasi = json_decode(stripslashes($dapp_medis_tglreservasi));
		
		$dapp_medis_jamreservasi = $_POST['dapp_medis_jamreservasi']; // Get our array back and translate it :
		$array_dapp_medis_jamreservasi = json_decode(stripslashes($dapp_medis_jamreservasi));
		
		$dapp_medis_petugas = $_POST['dapp_medis_petugas']; // Get our array back and translate it :
		$array_dapp_medis_petugas = json_decode(stripslashes($dapp_medis_petugas));
		
		$dapp_medis_status = $_POST['dapp_medis_status']; // Get our array back and translate it :
		$array_dapp_medis_status = json_decode(stripslashes($dapp_medis_status));
		
		$dapp_medis_keterangan = $_POST['dapp_medis_keterangan']; // Get our array back and translate it :
		$array_dapp_medis_keterangan = json_decode(stripslashes($dapp_medis_keterangan));
		
		$app_cara=trim(@$_POST["app_cara"]);
		
		$app_customer=trim(@$_POST["app_customer"]);
		
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace("\\", "",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		
		$dapp_user=$_SESSION[SESSION_USERID];
		
		$result=$this->m_appointment->detail_appointment_detail_medis_insert($array_dapp_medis_id ,$dapp_medis_master ,$array_dapp_medis_perawatan ,$array_dapp_medis_tglreservasi ,$array_dapp_medis_jamreservasi ,$array_dapp_medis_petugas ,$array_dapp_medis_status ,$array_dapp_medis_keterangan ,$app_cara ,$app_customer ,$app_keterangan ,$dapp_user);
		echo $result;
	}
	
	function detail_appointment_detail_nonmedis_insert(){
		//POST variable here
		$dapp_nonmedis_id = $_POST['dapp_nonmedis_id']; // Get our array back and translate it :
		$array_dapp_nonmedis_id = json_decode(stripslashes($dapp_nonmedis_id));
		
		$dapp_nonmedis_master=trim(@$_POST["dapp_nonmedis_master"]);
		
		$dapp_nonmedis_perawatan = $_POST['dapp_nonmedis_perawatan']; // Get our array back and translate it :
		$array_dapp_nonmedis_perawatan = json_decode(stripslashes($dapp_nonmedis_perawatan));
		
		$dapp_nonmedis_tglreservasi = $_POST['dapp_nonmedis_tglreservasi']; // Get our array back and translate it :
		$array_dapp_nonmedis_tglreservasi = json_decode(stripslashes($dapp_nonmedis_tglreservasi));
		
		$dapp_nonmedis_jamreservasi = $_POST['dapp_nonmedis_jamreservasi']; // Get our array back and translate it :
		$array_dapp_nonmedis_jamreservasi = json_decode(stripslashes($dapp_nonmedis_jamreservasi));
		
		$dapp_nonmedis_petugas2 = $_POST['dapp_nonmedis_petugas2']; // Get our array back and translate it :
		$array_dapp_nonmedis_petugas2 = json_decode(stripslashes($dapp_nonmedis_petugas2));
		
		$dapp_nonmedis_status = $_POST['dapp_nonmedis_status']; // Get our array back and translate it :
		$array_dapp_nonmedis_status = json_decode(stripslashes($dapp_nonmedis_status));
		
		$dapp_nonmedis_keterangan = $_POST['dapp_nonmedis_keterangan']; // Get our array back and translate it :
		$array_dapp_nonmedis_keterangan = json_decode(stripslashes($dapp_nonmedis_keterangan));
		
		$dapp_nonmedis_counter = $_POST['dapp_nonmedis_counter']; // Get our array back and translate it :
		$array_dapp_nonmedis_counter = json_decode(stripslashes($dapp_nonmedis_counter));
		
		$dapp_nonmedis_warna_terapis = $_POST['dapp_nonmedis_warna_terapis']; // Get our array back and translate it :
		$array_dapp_nonmedis_warna_terapis = json_decode(stripslashes($dapp_nonmedis_warna_terapis));
		
		$app_cara=trim(@$_POST["app_cara"]);
		
		$app_customer=trim(@$_POST["app_customer"]);
		
		$app_keterangan=trim(@$_POST["app_keterangan"]);
		$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		$app_keterangan=str_replace("\\", "",$app_keterangan);
		$app_keterangan=str_replace("'", "''",$app_keterangan);
		
		$dapp_user=$_SESSION[SESSION_USERID];
		
		$result=$this->m_appointment->detail_appointment_detail_nonmedis_insert(
			$array_dapp_nonmedis_id ,
			$dapp_nonmedis_master ,
			$array_dapp_nonmedis_perawatan ,
			$array_dapp_nonmedis_tglreservasi ,
			$array_dapp_nonmedis_jamreservasi ,
			$array_dapp_nonmedis_petugas2 ,
			$array_dapp_nonmedis_status ,
			$array_dapp_nonmedis_keterangan ,
			$array_dapp_nonmedis_counter ,
			$array_dapp_nonmedis_warna_terapis ,
			$app_cara ,
			$app_customer ,
			$app_keterangan ,
			$dapp_user);
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		$mode_edit_case = @$_POST['mode_edit'];
		switch($task){
			case "LIST":
				$this->appointment_list();
				break;
			case "UPDATE":
				$this->appointment_update($mode_edit_case);
				break;
			case "CREATE":
				$this->appointment_create();
				break;
			/*case "DELETE":
				$this->appointment_delete();
				break;*/
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
		$jenis_rawat = isset($_POST['jenis_rawat']) ? $_POST['jenis_rawat'] : "";
		$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_appointment->appointment_list($query,$start,$end,$tgl_app,$jenis_rawat);
		echo $result;
	}

	//function for update record
	function appointment_update($mode_edit_case){
		//POST variable here
		if($mode_edit_case=='update_list'){
			//UPDATE db.appointment_detail selain status, dan kondisi ini bisa dipastikan status!='datang'
			$dapp_id=trim(@$_POST["dapp_id"]);
			$dapp_tglreservasi=trim(@$_POST["dapp_tglreservasi"]);
			$dapp_jamreservasi=trim(@$_POST["dapp_jamreservasi"]);
			$dokter=trim(@$_POST["dokter"]);
			$terapis=trim(@$_POST["terapis"]);
			$dapp_keterangan=trim(@$_POST["dapp_keterangan"]);
			$dapp_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$dapp_keterangan);
			$dapp_keterangan=str_replace("'", "&#39",$dapp_keterangan);
			$dapp_status=trim(@$_POST["dapp_status"]);
			$dapp_status=str_replace("/(<\/?)(p)([^>]*>)", "",$dapp_status);
			
			$app_user=$_SESSION[SESSION_USERID];
			
			$result = $this->m_appointment->appointment_update_list($dapp_id
																	,$dapp_tglreservasi
																	,$dapp_jamreservasi
																	,$dokter
																	,$terapis
																	,$dapp_keterangan
																	,$dapp_status
																	,$app_user);
			echo $result;
			
		}else if($mode_edit_case=='update_list_status'){
			$dapp_id=trim(@$_POST["dapp_id"]);
			$dapp_status=trim(@$_POST["dapp_status"]);
			$dapp_status=str_replace("/(<\/?)(p)([^>]*>)", "",$dapp_status);
			
			$app_user=$_SESSION[SESSION_USERID];
			
			$result = $this->m_appointment->appointment_update_list_status($dapp_id, $dapp_status, $app_user);
			echo $result;
			
		}else{
			$app_id=trim(@$_POST["app_id"]);
			$app_cara=trim(@$_POST["app_cara"]);
			$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
			$app_keterangan=trim(@$_POST["app_keterangan"]);
			$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
			
			$app_user=$_SESSION[SESSION_USERID];
			
			$result = $this->m_appointment->appointment_update($app_id
															   ,$app_cara
															   ,$app_keterangan
															   ,$app_user);
			echo $result;
		}
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
		
		$app_cust_nama_baru=trim(@$_POST["app_cust_nama_baru"]);
		$app_cust_nama_baru=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cust_nama_baru);
		$app_cust_nama_baru=str_replace("'", "''",$app_cust_nama_baru);
		$app_cust_telp_baru=trim(@$_POST["app_cust_telp_baru"]);
		$app_cust_telp_baru=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cust_telp_baru);
		$app_cust_telp_baru=str_replace("'", "''",$app_cust_telp_baru);
		$app_cust_hp_baru=trim(@$_POST["app_cust_hp_baru"]);
		$app_cust_hp_baru=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cust_hp_baru);
		$app_cust_hp_baru=str_replace("'", "''",$app_cust_hp_baru);
		$app_cust_keterangan_baru=trim(@$_POST["app_cust_keterangan_baru"]);
		$app_cust_keterangan_baru=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cust_keterangan_baru);
		$app_cust_keterangan_baru=str_replace("'", "''",$app_cust_keterangan_baru);
		
		$app_user=$_SESSION[SESSION_USERID];
		
		$result=$this->m_appointment->appointment_create($app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$app_cust_nama_baru ,$app_cust_telp_baru ,$app_cust_hp_baru ,$app_cust_keterangan_baru ,$app_user );
		echo $result;
	}

	//function for delete selected record
	/*function appointment_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_appointment->appointment_delete($pkid);
		echo $result;
	}*/

	//function for advanced search
	function appointment_search(){
		//POST varibale here
		$app_id=trim(@$_POST["app_id"]);
		$app_customer=trim(@$_POST["app_customer"]);
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		//$app_keterangan=trim(@$_POST["app_keterangan"]);
		//$app_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$app_keterangan);
		//$app_keterangan=str_replace("'", "''",$app_keterangan);
		$app_kategori=trim(@$_POST["app_kategori"]);
		$app_dokter=trim(@$_POST["app_dokter"]);
		$app_terapis=trim(@$_POST["app_terapis"]);
		$app_rawat_medis=trim(@$_POST["app_rawat_medis"]);
		$app_rawat_nonmedis=trim(@$_POST["app_rawat_nonmedis"]);
		if(trim(@$_POST["app_tgl_start_reservasi"])!="")
			$app_tgl_start_reservasi=date('Y-m-d', strtotime(trim(@$_POST["app_tgl_start_reservasi"])));
		else
			$app_tgl_start_reservasi="";
		if(trim(@$_POST["app_tgl_end_reservasi"])!="")
			$app_tgl_end_reservasi=date('Y-m-d', strtotime(trim(@$_POST["app_tgl_end_reservasi"])));
		else
			$app_tgl_end_reservasi="";
		if(trim(@$_POST["app_tgl_start_app"])!="")
			$app_tgl_start_app=date('Y-m-d', strtotime(trim(@$_POST["app_tgl_start_app"])));
		else
			$app_tgl_start_app="";
		if(trim(@$_POST["app_tgl_end_app"])!="")
			$app_tgl_end_app=date('Y-m-d', strtotime(trim(@$_POST["app_tgl_end_app"])));
		else
			$app_tgl_end_app="";
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_appointment->appointment_search($app_id ,$app_customer ,$app_cara ,$app_kategori, $app_dokter, $app_terapis, $app_rawat_medis, $app_rawat_nonmedis, $app_tgl_start_reservasi, $app_tgl_end_reservasi, $app_tgl_start_app, $app_tgl_end_app, $start,$end);
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
		
		$result = $this->m_appointment->appointment_print($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$option,$filter);
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
		$app_cara=trim(@$_POST["app_cara"]);
		$app_cara=str_replace("/(<\/?)(p)([^>]*>)", "",$app_cara);
		$app_cara=str_replace("'", "''",$app_cara);
		$app_kategori=trim(@$_POST["app_kategori"]);
		$app_dokter=trim(@$_POST["app_dokter"]);
		$app_terapis=trim(@$_POST["app_terapis"]);
		$app_tgl_start_reservasi=trim(@$_POST["app_tgl_start_reservasi"]);
		$app_tgl_end_reservasi=trim(@$_POST["app_tgl_end_reservasi"]);
		$app_tgl_start_app=trim(@$_POST["app_tgl_start_app"]);
		$app_tgl_end_app=trim(@$_POST["app_tgl_end_app"]);
		$app_rawat_medis=trim(@$_POST["app_rawat_medis"]);
		$app_rawat_nonmedis=trim(@$_POST["app_rawat_nonmedis"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_appointment->appointment_export_excel($app_id ,$app_customer ,$app_cara ,$app_kategori ,$app_dokter ,$app_terapis ,$app_tgl_start_reservasi ,$app_tgl_end_reservasi ,$app_tgl_start_app ,$app_tgl_end_app ,$app_rawat_medis ,$app_rawat_nonmedis ,$option,$filter);
		
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