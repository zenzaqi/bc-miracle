<?php
/* 	
	+ Module  		: Report Tindakan Dokter Controller
	+ Description	: For record controller process back-end
	+ Filename 		: c_lap_jum_tindakan_terapis.php
 	+ Author  		: Fred

	
*/

//class of tindakan
class C_lap_jum_tindakan_terapis extends Controller {

	//constructor
	function C_lap_jum_tindakan_terapis(){
		parent::Controller();
		$this->load->model('m_lap_jum_tindakan_terapis', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_lap_jum_tindakan_terapis');
	}
	
	function get_terapis_list(){
		//ID dokter pada tabel departemen adalah 8
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		//$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_lap_jum_tindakan_terapis->get_terapis_list($query);
		echo $result;
	}


	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->lap_jum_tindakan_terapis_list();
				break;
			case "LIST2":
				$this->lap_jum_tindakan_terapis_list2();
				break;
			/*case "UPDATE":
				$this->lap_jum_tindakan_terapis_update();
				break;
			case "CREATE":
				$this->lap_jum_tindakan_terapis_create();
				break;
			case "DELETE":
				$this->lap_jum_tindakan_terapis_delete();
				break;*/
			case "SEARCH":
				$this->lap_jum_tindakan_terapis_search();
				break;
			case "SEARCH2":
				$this->lap_jum_tindakan_terapis_search2();
				break;
			case "PRINT":
				$this->lap_jum_tindakan_terapis_print();
				break;
			case "EXCEL":
				$this->lap_jum_tindakan_terapis_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function lap_jum_tindakan_terapis_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_lap_jum_tindakan_terapis->lap_jum_tindakan_terapis_list($query,$start,$end);
		echo $result;
	}
	
	//function fot list record
	function lap_jum_tindakan_terapis_list2(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_lap_jum_tindakan_terapis->lap_jum_tindakan_terapis_list2($query,$start,$end);
		echo $result;
	}

	//function for advanced search
	function lap_jum_tindakan_terapis_search(){
		//POST varibale here
		$lap_jum_tindakan_terapis_id=trim(@$_POST["lap_jum_tindakan_terapis_id"]);
		if(trim(@$_POST["lapjum_tglapp_start"])!="")
			$lapjum_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["lapjum_tglapp_start"])));
		else
			$lapjum_tglapp_start="";
			
		if(trim(@$_POST["lapjum_tglapp_end"])!="")
			$lapjum_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["lapjum_tglapp_end"])));
		else
			$lapjum_tglapp_end="";

		$terapis_id=trim(@$_POST["terapis_id"]);
		$lapjum_groupby=trim(@$_POST["lapjum_groupby"]);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		
		$tgl_awal=$tahun."-".$bulan;
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_lap_jum_tindakan_terapis->lap_jum_tindakan_terapis_search($tgl_awal,$periode,$lap_jum_tindakan_terapis_id ,$lapjum_tglapp_start ,$lapjum_tglapp_end ,$terapis_id ,$lapjum_groupby, $start,$end);
		echo $result;
	}

	function lap_jum_tindakan_terapis_search2(){
		//POST varibale here
		$lap_jum_tindakan_terapis_id=trim(@$_POST["lap_jum_tindakan_terapis_id"]);
		if(trim(@$_POST["lapjum_tglapp_start"])!="")
			$lapjum_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["lapjum_tglapp_start"])));
		else
			$lapjum_tglapp_start="";
		if(trim(@$_POST["lapjum_tglapp_end"])!="")
			$lapjum_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["lapjum_tglapp_end"])));
		else
			$lapjum_tglapp_end="";

		$terapis_id=trim(@$_POST["terapis_id"]);
		$lapjum_groupby=trim(@$_POST["lapjum_groupby"]);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		
		$tgl_awal=$tahun."-".$bulan;
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_lap_jum_tindakan_terapis->lap_jum_tindakan_terapis_search2($tgl_awal,$periode,$lap_jum_tindakan_terapis_id ,$lapjum_tglapp_start ,$lapjum_tglapp_end ,$terapis_id ,$lapjum_groupby, $start,$end);
		echo $result;
	}
	
	function lap_jum_tindakan_terapis_print(){
  		//POST varibale here
		$lapjum_id=trim(@$_POST["lapjum_id"]);
		$lapjum_cust=trim(@$_POST["lapjum_cust"]);
		$lapjum_keterangan=trim(@$_POST["lapjum_keterangan"]);
		$lapjum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$lapjum_keterangan);
		$lapjum_keterangan=str_replace("'", "''",$lapjum_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_tindakan_medis->lap_jum_tindakan_terapis_print($lapjum_id ,$lapjum_cust ,$lapjum_keterangan ,$option,$filter);
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
				fwrite($file, $data['lapjum_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['lapjum_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['lapjum_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lapjum_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lapjum_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lapjum_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lapjum_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lapjum_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function lap_jum_tindakan_terapis_export_excel(){
		//POST varibale here
		$lapjum_id=trim(@$_POST["lapjum_id"]);
		if(trim(@$_POST["lapjum_tglapp_start"])!="")
			$lapjum_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["lapjum_tglapp_start"])));
		else
			$lapjum_tglapp_start="";
		if(trim(@$_POST["lapjum_tglapp_end"])!="")
			$lapjum_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["lapjum_tglapp_end"])));
		else
			$lapjum_tglapp_end="";

		$terapis_id=trim(@$_POST["terapis_id"]);
		$lapjum_groupby=trim(@$_POST["lapjum_groupby"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		
		$tgl_awal=$tahun."-".$bulan;
		
		$query = $this->m_lap_jum_tindakan_terapis->lap_jum_tindakan_terapis_export_excel($tgl_awal,$periode,$lapjum_id ,$terapis_id , $lapjum_tglapp_start, $lapjum_tglapp_end,
																							$lapjum_groupby, $option,$filter);
		$this->load->plugin('to_excel');
		to_excel($query,"Report_Tindakan_Terapis"); 
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