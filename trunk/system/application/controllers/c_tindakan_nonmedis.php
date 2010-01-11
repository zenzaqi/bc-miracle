<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: tindakan Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_tindakan_nonmedis.php
 	+ Author  		: masongbee
 	+ Created on 22/Oct/2009 19:16:47
	
*/

//class of tindakan
class C_tindakan_nonmedis extends Controller {

	//constructor
	function C_tindakan_nonmedis(){
		parent::Controller();
		$this->load->model('m_tindakan_nonmedis', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->helper('asset');
		$this->load->view('main/v_tindakan_nonmedis');
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_terapis_list(){
		//ID dokter pada tabel departemen adalah 9
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_public_function->get_petugas_list($query,$tgl_app,"Therapist");
		echo $result;
	}
	
	function get_tindakan_nonmedis_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : $_GET['query'];
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_public_function->get_tindakan_nonmedis_list($query,$start,$end);
		echo $result;
	}
	
	function get_perawatan_nonmedis_list(){
		$result=$this->m_public_function->get_perawatan_nonmedis_list();
		echo $result;
	}
	
	function get_karyawan_nonmedis_list(){
		$result=$this->m_public_function->get_karyawan_nonmedis_list();
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_tindakan_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_tindakan_nonmedis->detail_tindakan_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_tindakan_nonmedis_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_tindakan_nonmedis->detail_tindakan_nonmedis_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_tindakan_nonmedis->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_tindakan_nonmedis_detail_insert(){
	//POST variable here
		$dtrawat_id=trim(@$_POST["dtrawat_id"]);
		$dtrawat_master=trim(@$_POST["dtrawat_master"]);
		$dtrawat_perawatan=trim(@$_POST["dtrawat_perawatan"]);
		$dtrawat_petugas1=trim(@$_POST["dtrawat_petugas1"]);
		$dtrawat_petugas2=trim(@$_POST["dtrawat_petugas2"]);
		$dtrawat_jam=trim(@$_POST["dtrawat_jam"]);
		$dtrawat_jam=str_replace("/(<\/?)(p)([^>]*>)", "",$dtrawat_jam);
		$dtrawat_jam=str_replace("\\", "",$dtrawat_jam);
		$dtrawat_jam=str_replace("'", "\'",$dtrawat_jam);
		$dtrawat_kategori=trim(@$_POST["dtrawat_kategori"]);
		$dtrawat_kategori=str_replace("/(<\/?)(p)([^>]*>)", "",$dtrawat_kategori);
		$dtrawat_kategori=str_replace("\\", "",$dtrawat_kategori);
		$dtrawat_kategori=str_replace("'", "\'",$dtrawat_kategori);
		$dtrawat_status=trim(@$_POST["dtrawat_status"]);
		$dtrawat_status=str_replace("/(<\/?)(p)([^>]*>)", "",$dtrawat_status);
		$dtrawat_status=str_replace("\\", "",$dtrawat_status);
		$dtrawat_status=str_replace("'", "\'",$dtrawat_status);
		$dtrawat_keterangan=trim(@$_POST["dtrawat_keterangan"]);
		$dtrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$dtrawat_keterangan);
		$dtrawat_keterangan=str_replace("\\", "",$dtrawat_keterangan);
		$result=$this->m_tindakan_nonmedis->detail_tindakan_nonmedis_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jam ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->tindakan_list();
				break;
			case "UPDATE":
				$this->tindakan_update();
				break;
			case "CREATE":
				$this->tindakan_create();
				break;
			case "DELETE":
				$this->tindakan_delete();
				break;
			case "SEARCH":
				$this->tindakan_search();
				break;
			case "PRINT":
				$this->tindakan_print();
				break;
			case "EXCEL":
				$this->tindakan_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function tindakan_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_tindakan_nonmedis->tindakan_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function tindakan_update(){
		//POST variable here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace(",", "\,",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", "\'",$trawat_keterangan);
		$dtrawat_status=trim(@$_POST["dtrawat_status"]);
		$trawat_cust_id=trim(@$_POST["trawat_cust_id"]);
		$dtrawat_perawatan_id=trim(@$_POST["dtrawat_perawatan_id"]);
		$dtrawat_perawatan=trim(@$_POST["dtrawat_perawatan"]);
		$dtrawat_id=trim(@$_POST["dtrawat_id"]);
		$rawat_harga=trim(@$_POST["rawat_harga"]);
		$rawat_du=trim(@$_POST["rawat_du"]);
		$rawat_dm=trim(@$_POST["rawat_dm"]);
		$cust_member=trim(@$_POST["cust_member"]);
		$dtrawat_petugas2_no=trim(@$_POST["dtrawat_petugas2_no"]);
		$dtrawat_keterangan=trim(@$_POST["dtrawat_keterangan"]);
		$dtrawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$dtrawat_keterangan);
		$dtrawat_keterangan=str_replace(",", "\,",$dtrawat_keterangan);
		$result = $this->m_tindakan_nonmedis->tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_petugas2_no ,$dtrawat_keterangan);
		echo $result;
	}
	
	//function for create new record
	function tindakan_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", "\'",$trawat_keterangan);
		$result=$this->m_tindakan_nonmedis->tindakan_create($trawat_cust ,$trawat_keterangan );
		echo $result;
	}

	//function for delete selected record
	function tindakan_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_tindakan_nonmedis->tindakan_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function tindakan_search(){
		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		/*$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", "\'",$trawat_keterangan);*/
		if(trim(@$_POST["trawat_tglapp_start"])!="")
			$trawat_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_start"])));
		else
			$trawat_tglapp_start="";
		if(trim(@$_POST["trawat_tglapp_end"])!="")
			$trawat_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_end"])));
		else
			$trawat_tglapp_end="";
		$trawat_rawat=trim(@$_POST["trawat_rawat"]);
		$trawat_terapis=trim(@$_POST["trawat_terapis"]);
		$trawat_status=trim(@$_POST["trawat_status"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_tindakan_nonmedis->tindakan_search($trawat_id ,$trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_terapis ,$trawat_status ,$start,$end);
		echo $result;
	}


	function tindakan_print(){
  		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", "\'",$trawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_tindakan_nonmedis->tindakan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("tindakanlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Tindakan Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Tindakan List'><caption>TINDAKAN</caption><thead><tr><th scope='col'>Trawat Id</th><th scope='col'>Trawat Cust</th><th scope='col'>Trawat Jamdatang</th><th scope='col'>Trawat Appointment</th><th scope='col'>Trawat Keterangan</th><th scope='col'>Trawat Creator</th><th scope='col'>Trawat Date Create</th><th scope='col'>Trawat Update</th><th scope='col'>Trawat Date Update</th><th scope='col'>Trawat Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Tindakan</td></tr></tfoot><tbody>");
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
	function tindakan_export_excel(){
		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", "\'",$trawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_tindakan_nonmedis->tindakan_export_excel($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter);
		
		to_excel($query,"tindakan"); 
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