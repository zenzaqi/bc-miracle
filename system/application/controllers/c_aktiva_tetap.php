<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: aktiva_tetap Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_aktiva_tetap.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:45:57
	
*/

//class of aktiva_tetap
class C_aktiva_tetap extends Controller {

	//constructor
	function C_aktiva_tetap(){
		parent::Controller();
		$this->load->model('m_aktiva_tetap', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_aktiva_tetap');
	}
	
	//for detail action
	//list detail handler action
	function  detail_aktiva_tetap_depresiasi_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_aktiva_tetap->detail_aktiva_tetap_depresiasi_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_aktiva_tetap_depresiasi_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_aktiva_tetap->detail_aktiva_tetap_depresiasi_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_aktiva_tetap->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_aktiva_tetap_depresiasi_insert(){
	//POST variable here
		$daktiva_id=trim(@$_POST["daktiva_id"]);
		$daktiva_master=trim(@$_POST["daktiva_master"]);
		$daktiva_tanggal=trim(@$_POST["daktiva_tanggal"]);
		$daktiva_depresiasi=trim(@$_POST["daktiva_depresiasi"]);
		$daktiva_saldo=trim(@$_POST["daktiva_saldo"]);
		$result=$this->m_aktiva_tetap->detail_aktiva_tetap_depresiasi_insert($daktiva_id ,$daktiva_master ,$daktiva_tanggal ,$daktiva_depresiasi ,$daktiva_saldo );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->aktiva_tetap_list();
				break;
			case "UPDATE":
				$this->aktiva_tetap_update();
				break;
			case "CREATE":
				$this->aktiva_tetap_create();
				break;
			case "DELETE":
				$this->aktiva_tetap_delete();
				break;
			case "SEARCH":
				$this->aktiva_tetap_search();
				break;
			case "PRINT":
				$this->aktiva_tetap_print();
				break;
			case "EXCEL":
				$this->aktiva_tetap_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function aktiva_tetap_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_aktiva_tetap->aktiva_tetap_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function aktiva_tetap_update(){
		//POST variable here
		$aktiva_id=trim(@$_POST["aktiva_id"]);
		$aktiva_akun=trim(@$_POST["aktiva_akun"]);
		$aktiva_nama=trim(@$_POST["aktiva_nama"]);
		$aktiva_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$aktiva_nama);
		$aktiva_nama=str_replace(",", ",",$aktiva_nama);
		$aktiva_nama=str_replace("'", '"',$aktiva_nama);
		$aktiva_nilai_awal=trim(@$_POST["aktiva_nilai_awal"]);
		$aktiva_nilai_sekarang=trim(@$_POST["aktiva_nilai_sekarang"]);
		$result = $this->m_aktiva_tetap->aktiva_tetap_update($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang      );
		echo $result;
	}
	
	//function for create new record
	function aktiva_tetap_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$aktiva_akun=trim(@$_POST["aktiva_akun"]);
		$aktiva_nama=trim(@$_POST["aktiva_nama"]);
		$aktiva_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$aktiva_nama);
		$aktiva_nama=str_replace("'", '"',$aktiva_nama);
		$aktiva_nilai_awal=trim(@$_POST["aktiva_nilai_awal"]);
		$aktiva_nilai_sekarang=trim(@$_POST["aktiva_nilai_sekarang"]);
		$result=$this->m_aktiva_tetap->aktiva_tetap_create($aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang );
		echo $result;
	}

	//function for delete selected record
	function aktiva_tetap_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_aktiva_tetap->aktiva_tetap_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function aktiva_tetap_search(){
		//POST varibale here
		$aktiva_id=trim(@$_POST["aktiva_id"]);
		$aktiva_akun=trim(@$_POST["aktiva_akun"]);
		$aktiva_nama=trim(@$_POST["aktiva_nama"]);
		$aktiva_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$aktiva_nama);
		$aktiva_nama=str_replace("'", '"',$aktiva_nama);
		$aktiva_nilai_awal=trim(@$_POST["aktiva_nilai_awal"]);
		$aktiva_nilai_sekarang=trim(@$_POST["aktiva_nilai_sekarang"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_aktiva_tetap->aktiva_tetap_search($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ,$start,$end);
		echo $result;
	}


	function aktiva_tetap_print(){
  		//POST varibale here
		$aktiva_id=trim(@$_POST["aktiva_id"]);
		$aktiva_akun=trim(@$_POST["aktiva_akun"]);
		$aktiva_nama=trim(@$_POST["aktiva_nama"]);
		$aktiva_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$aktiva_nama);
		$aktiva_nama=str_replace("'", '"',$aktiva_nama);
		$aktiva_nilai_awal=trim(@$_POST["aktiva_nilai_awal"]);
		$aktiva_nilai_sekarang=trim(@$_POST["aktiva_nilai_sekarang"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_aktiva_tetap->aktiva_tetap_print($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("aktiva_tetaplist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Aktiva_tetap Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Aktiva_tetap List'><caption>AKTIVA_TETAP</caption><thead><tr><th scope='col'>Aktiva Id</th><th scope='col'>Aktiva Akun</th><th scope='col'>Aktiva Nama</th><th scope='col'>Aktiva Nilai Awal</th><th scope='col'>Aktiva Nilai Sekarang</th><th scope='col'>Aktiva Creator</th><th scope='col'>Aktiva Date Create</th><th scope='col'>Aktiva Update</th><th scope='col'>Aktiva Date Update</th><th scope='col'>Aktiva Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Aktiva_tetap</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['aktiva_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['aktiva_akun']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['aktiva_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['aktiva_nilai_awal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['aktiva_nilai_sekarang']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['aktiva_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['aktiva_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['aktiva_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['aktiva_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['aktiva_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function aktiva_tetap_export_excel(){
		//POST varibale here
		$aktiva_id=trim(@$_POST["aktiva_id"]);
		$aktiva_akun=trim(@$_POST["aktiva_akun"]);
		$aktiva_nama=trim(@$_POST["aktiva_nama"]);
		$aktiva_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$aktiva_nama);
		$aktiva_nama=str_replace("'", '"',$aktiva_nama);
		$aktiva_nilai_awal=trim(@$_POST["aktiva_nilai_awal"]);
		$aktiva_nilai_sekarang=trim(@$_POST["aktiva_nilai_sekarang"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_aktiva_tetap->aktiva_tetap_export_excel($aktiva_id ,$aktiva_akun ,$aktiva_nama ,$aktiva_nilai_awal ,$aktiva_nilai_sekarang ,$option,$filter);
		
		to_excel($query,"aktiva_tetap"); 
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