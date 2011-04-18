<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	
	+ Module  		: Laporan Kunjungan Controller
	+ Description	: For record controller process back-end
	+ Filename 		: c_summary_report.php
 	+ Author  		: Freddy
	
*/

//class of tindakan
class c_summary_report extends Controller {

	//constructor
	function c_summary_report(){
		parent::Controller();
		session_start();
		$this->load->model('m_summary_report', '', TRUE);
		$this->load->plugin('to_excel');
	}

	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_summary_report');
	}


	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->lap_kunjungan_list();
				break;
			case "LIST2":
				$this->lap_kunjungan_non_list();
				break;
			case "LIST3":
				$this->lap_average_list();
				break;
			/*case "UPDATE":
				$this->report_tindakan_update();
				break;
			case "CREATE":
				$this->report_tindakan_create();
				break;
			case "DELETE":
				$this->report_tindakan_delete();
				break;*/
			case "SEARCH":
				$this->summary_report_search();
				break;
			case "SEARCH2":
				$this->lap_kunjungan_search2();
				break;
			case "SEARCH3":
				$this->lap_kunjungan_search3();
				break;
			case "PRINT":
				$this->lap_kunjungan_print();
				break;
			case "GENERATE":
				$this->generate_summary_report();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function lap_kunjungan_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_summary_report->lap_kunjungan_list($query,$start,$end);
		echo $result;
	}
	
	//function fot list record
	function lap_kunjungan_non_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_summary_report->lap_kunjungan_non_list($query,$start,$end);
		echo $result;
	}
	
	function lap_average_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_summary_report->lap_average_list($query,$start,$end);
		echo $result;
	}
	
	

	//function for advanced search
	function summary_report_search(){
		//POST varibale here
		$bulan_tujuan=(isset($_POST['summary_report_bulantujuan']) ? @$_POST['summary_report_bulantujuan'] : @$_GET['summary_report_bulantujuan']);
		$tahun_tujuan=(isset($_POST['summary_report_tahuntujuan']) ? @$_POST['summary_report_tahuntujuan'] : @$_GET['summary_report_tahuntujuan']);
		$bulan_pembanding1=(isset($_POST['summary_report_bulanpembanding1']) ? @$_POST['summary_report_bulanpembanding1'] : @$_GET['summary_report_bulanpembanding1']);
		$tahun_pembanding1=(isset($_POST['summary_report_tahunpembanding1']) ? @$_POST['summary_report_tahunpembanding1'] : @$_GET['summary_report_tahunpembanding1']);
		$bulan_pembanding2=(isset($_POST['summary_report_bulanpembanding2']) ? @$_POST['summary_report_bulanpembanding2'] : @$_GET['summary_report_bulanpembanding2']);
		$tahun_pembanding2=(isset($_POST['summary_report_tahunpembanding2']) ? @$_POST['summary_report_tahunpembanding2'] : @$_GET['summary_report_tahunpembanding2']);
		/*
		$lap_kunjungan_id=trim(@$_POST["lap_kunjungan_id"]);
		if(trim(@$_POST["trawat_tglapp_start"])!="")
			$trawat_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_start"])));
		else
			$trawat_tglapp_start="";
		if(trim(@$_POST["trawat_tglapp_end"])!="")
			$trawat_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_end"])));
		else
			$trawat_tglapp_end="";
			
		$lap_kunjungan_kelamin=trim(@$_POST["lap_kunjungan_kelamin"]);
		$lap_kunjungan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_kelamin);
		$lap_kunjungan_kelamin=str_replace("'", '"',$lap_kunjungan_kelamin);
		$lap_kunjungan_member=trim(@$_POST["lap_kunjungan_member"]);
		$lap_kunjungan_member=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_member);
		$lap_kunjungan_member=str_replace("'", '"',$lap_kunjungan_member);
		$lap_kunjungan_cust=trim(@$_POST["lap_kunjungan_cust"]);
		$lap_kunjungan_cust=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_cust);
		$lap_kunjungan_cust=str_replace("'", '"',$lap_kunjungan_cust);
		$lap_kunjungan_umurstart=trim(@$_POST["lap_kunjungan_umurstart"]);
		$lap_kunjungan_umurstart=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_umurstart);
		$lap_kunjungan_umurstart=str_replace("'", '"',$lap_kunjungan_umurstart);
		$lap_kunjungan_umurend=trim(@$_POST["lap_kunjungan_umurend"]);
		$lap_kunjungan_umurend=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_umurend);
		$lap_kunjungan_umurend=str_replace("'", '"',$lap_kunjungan_umurend);
		$lap_kunjungan_tgllahir =(isset($_POST['lap_kunjungan_tgllahir']) ? @$_POST['lap_kunjungan_tgllahir'] : @$_GET['lap_kunjungan_tgllahir']);
		$lap_kunjungan_tgllahirend =(isset($_POST['lap_kunjungan_tgllahirend']) ? @$_POST['lap_kunjungan_tgllahirend'] : @$_GET['lap_kunjungan_tgllahirend']);
		$lap_kunjungan_tgllahirend=trim(@$_POST["lap_kunjungan_tgllahirend"]);
		
		//$trawat_dokter=trim(@$_POST["trawat_dokter"]);
		*/
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_summary_report->summary_report_search($bulan_tujuan, $tahun_tujuan, $bulan_pembanding1, $tahun_pembanding1, $bulan_pembanding2, $tahun_pembanding2, $start,$end);
		echo $result;
	}

	function lap_kunjungan_search2(){
		//POST varibale here
		$lap_kunjungan_id=trim(@$_POST["lap_kunjungan_id"]);
		if(trim(@$_POST["trawat_tglapp_start"])!="")
			$trawat_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_start"])));
		else
			$trawat_tglapp_start="";
		if(trim(@$_POST["trawat_tglapp_end"])!="")
			$trawat_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_end"])));
		else
			$trawat_tglapp_end="";

		$lap_kunjungan_kelamin=trim(@$_POST["lap_kunjungan_kelamin"]);
		$lap_kunjungan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_kelamin);
		$lap_kunjungan_kelamin=str_replace("'", '"',$lap_kunjungan_kelamin);
		$lap_kunjungan_member=trim(@$_POST["lap_kunjungan_member"]);
		$lap_kunjungan_member=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_member);
		$lap_kunjungan_member=str_replace("'", '"',$lap_kunjungan_member);
		$lap_kunjungan_cust=trim(@$_POST["lap_kunjungan_cust"]);
		$lap_kunjungan_cust=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_cust);
		$lap_kunjungan_cust=str_replace("'", '"',$lap_kunjungan_cust);
		$trawat_dokter=trim(@$_POST["trawat_dokter"]);
		$lap_kunjungan_umurstart=trim(@$_POST["lap_kunjungan_umurstart"]);
		$lap_kunjungan_umurstart=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_umurstart);
		$lap_kunjungan_umurstart=str_replace("'", '"',$lap_kunjungan_umurstart);
		$lap_kunjungan_umurend=trim(@$_POST["lap_kunjungan_umurend"]);
		$lap_kunjungan_umurend=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_umurend);
		$lap_kunjungan_umurend=str_replace("'", '"',$lap_kunjungan_umurend);
		$lap_kunjungan_tgllahir =(isset($_POST['lap_kunjungan_tgllahir']) ? @$_POST['lap_kunjungan_tgllahir'] : @$_GET['lap_kunjungan_tgllahir']);
		$lap_kunjungan_tgllahirend =(isset($_POST['lap_kunjungan_tgllahirend']) ? @$_POST['lap_kunjungan_tgllahirend'] : @$_GET['lap_kunjungan_tgllahirend']);
		$lap_kunjungan_tgllahirend=trim(@$_POST["lap_kunjungan_tgllahirend"]);
		
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_summary_report->lap_kunjungan_search2($lap_kunjungan_id ,$lap_kunjungan_tgllahir, $lap_kunjungan_tgllahirend,$lap_kunjungan_umurstart, $lap_kunjungan_umurend ,$trawat_tglapp_start ,$trawat_tglapp_end ,$lap_kunjungan_kelamin, $lap_kunjungan_member,$lap_kunjungan_cust, $start,$end);
		echo $result;
	}
	
	function lap_kunjungan_search3(){
		//POST varibale here
		$lap_kunjungan_id=trim(@$_POST["lap_kunjungan_id"]);
		if(trim(@$_POST["trawat_tglapp_start"])!="")
			$trawat_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_start"])));
		else
			$trawat_tglapp_start="";
		if(trim(@$_POST["trawat_tglapp_end"])!="")
			$trawat_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_end"])));
		else
			$trawat_tglapp_end="";

		$lap_kunjungan_kelamin=trim(@$_POST["lap_kunjungan_kelamin"]);
		$lap_kunjungan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_kelamin);
		$lap_kunjungan_kelamin=str_replace("'", '"',$lap_kunjungan_kelamin);
		$lap_kunjungan_member=trim(@$_POST["lap_kunjungan_member"]);
		$lap_kunjungan_member=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_member);
		$lap_kunjungan_member=str_replace("'", '"',$lap_kunjungan_member);
		$lap_kunjungan_cust=trim(@$_POST["lap_kunjungan_cust"]);
		$lap_kunjungan_cust=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_cust);
		$lap_kunjungan_cust=str_replace("'", '"',$lap_kunjungan_cust);
		$trawat_dokter=trim(@$_POST["trawat_dokter"]);
		$lap_kunjungan_umurstart=trim(@$_POST["lap_kunjungan_umurstart"]);
		$lap_kunjungan_umurstart=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_umurstart);
		$lap_kunjungan_umurstart=str_replace("'", '"',$lap_kunjungan_umurstart);
		$lap_kunjungan_umurend=trim(@$_POST["lap_kunjungan_umurend"]);
		$lap_kunjungan_umurend=str_replace("/(<\/?)(p)([^>]*>)", "",$lap_kunjungan_umurend);
		$lap_kunjungan_umurend=str_replace("'", '"',$lap_kunjungan_umurend);
		$lap_kunjungan_tgllahir =(isset($_POST['lap_kunjungan_tgllahir']) ? @$_POST['lap_kunjungan_tgllahir'] : @$_GET['lap_kunjungan_tgllahir']);
		$lap_kunjungan_tgllahirend =(isset($_POST['lap_kunjungan_tgllahirend']) ? @$_POST['lap_kunjungan_tgllahirend'] : @$_GET['lap_kunjungan_tgllahirend']);
		$lap_kunjungan_tgllahirend=trim(@$_POST["lap_kunjungan_tgllahirend"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_summary_report->lap_kunjungan_search3($lap_kunjungan_id ,$lap_kunjungan_tgllahir, $lap_kunjungan_tgllahirend,$lap_kunjungan_umurstart, $lap_kunjungan_umurend ,$trawat_tglapp_start ,$trawat_tglapp_end ,$lap_kunjungan_kelamin, $lap_kunjungan_member,$lap_kunjungan_cust, $start,$end);
		echo $result;
	}
	
	
	function lap_kunjungan_print(){
  		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$trawat_cust=trim(@$_POST["trawat_cust"]);
		$trawat_keterangan=trim(@$_POST["trawat_keterangan"]);
		$trawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$trawat_keterangan);
		$trawat_keterangan=str_replace("'", "''",$trawat_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_tindakan_medis->lap_kunjungan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("tindakanlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Tindakan Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Tindakan List'><caption>TINDAKAN</caption><thead><tr><th scope='col'>Trawat Id</th><th scope='col'>Trawat Cust</th><th scope='col'>Trawat Keterangan</th><th scope='col'>Trawat Creator</th><th scope='col'>Trawat Date Create</th><th scope='col'>Trawat Update</th><th scope='col'>Trawat Date Update</th><th scope='col'>Trawat Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
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
	function generate_summary_report(){
		//POST varibale here
		//$trawat_id=trim(@$_POST["trawat_id"]);
		//$trawat_dokter=trim(@$_POST["trawat_dokter"]);
		//$option=$_POST['currentlisting'];
		//$filter=$_POST["query"];
		
		$query = $this->m_summary_report->generate_summary_report();
		
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