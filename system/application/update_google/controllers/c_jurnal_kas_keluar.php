<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jurnal_kas_keluar Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jurnal_kas_keluar.php
 	+ Author  		: 
 	+ Created on 03/Oct/2009 13:09:57
	
*/

//class of jurnal_kas_keluar
class C_jurnal_kas_keluar extends Controller {

	//constructor
	function C_jurnal_kas_keluar(){
		parent::Controller();
		$this->load->model('m_jurnal_kas_keluar', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	function get_akun_list(){
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_akun_list($start,$end);
		echo $result;
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_jurnal_kas_keluar');
	}
	
	//for detail action
	//list detail handler action
	function  detail_jurnal_kas_keluar_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_kas_keluar->detail_jurnal_kas_keluar_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_jurnal_kas_keluar_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_kas_keluar->detail_jurnal_kas_keluar_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_jurnal_kas_keluar->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_jurnal_kas_keluar_detail_insert(){
	//POST variable here
		$djkkas_id=trim(@$_POST["djkkas_id"]);
		$djkkas_master=trim(@$_POST["djkkas_master"]);
		$djkkas_akun=trim(@$_POST["djkkas_akun"]);
		$djkkas_keterangan=trim(@$_POST["djkkas_keterangan"]);
		$djkkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$djkkas_keterangan);
		$djkkas_keterangan=str_replace("\\", "",$djkkas_keterangan);
		$djkkas_keterangan=str_replace("'", '"',$djkkas_keterangan);
		$djkkas_nilai=trim(@$_POST["djkkas_nilai"]);
		$result=$this->m_jurnal_kas_keluar->detail_jurnal_kas_keluar_detail_insert($djkkas_id ,$djkkas_master ,$djkkas_akun ,$djkkas_keterangan ,$djkkas_nilai );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jurnal_kas_keluar_list();
				break;
			case "UPDATE":
				$this->jurnal_kas_keluar_update();
				break;
			case "CREATE":
				$this->jurnal_kas_keluar_create();
				break;
			case "DELETE":
				$this->jurnal_kas_keluar_delete();
				break;
			case "SEARCH":
				$this->jurnal_kas_keluar_search();
				break;
			case "PRINT":
				$this->jurnal_kas_keluar_print();
				break;
			case "EXCEL":
				$this->jurnal_kas_keluar_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jurnal_kas_keluar_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_jurnal_kas_keluar->jurnal_kas_keluar_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jurnal_kas_keluar_update(){
		//POST variable here
		$jkkas_id=trim(@$_POST["jkkas_id"]);
		$jkkas_akun=trim(@$_POST["jkkas_akun"]);
		$jkkas_tanggal=trim(@$_POST["jkkas_tanggal"]);
		$jkkas_keterangan=trim(@$_POST["jkkas_keterangan"]);
		$jkkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_keterangan);
		$jkkas_keterangan=str_replace(",", ",",$jkkas_keterangan);
		$jkkas_keterangan=str_replace("'", '"',$jkkas_keterangan);
		$jkkas_nilai=trim(@$_POST["jkkas_nilai"]);
		$jkkas_pemakai=trim(@$_POST["jkkas_pemakai"]);
		$jkkas_pemakai=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_pemakai);
		$jkkas_pemakai=str_replace(",", ",",$jkkas_pemakai);
		$jkkas_pemakai=str_replace("'", '"',$jkkas_pemakai);
		$jkkas_ref=trim(@$_POST["jkkas_ref"]);
		$jkkas_posting=trim(@$_POST["jkkas_posting"]);
		$jkkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_posting);
		$jkkas_posting=str_replace(",", ",",$jkkas_posting);
		$jkkas_posting=str_replace("'", '"',$jkkas_posting);
		$jkkas_tglposting=trim(@$_POST["jkkas_tglposting"]);
		$result = $this->m_jurnal_kas_keluar->jurnal_kas_keluar_update($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting      );
		echo $result;
	}
	
	//function for create new record
	function jurnal_kas_keluar_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jkkas_akun=trim(@$_POST["jkkas_akun"]);
		$jkkas_tanggal=trim(@$_POST["jkkas_tanggal"]);
		$jkkas_keterangan=trim(@$_POST["jkkas_keterangan"]);
		$jkkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_keterangan);
		$jkkas_keterangan=str_replace("'", '"',$jkkas_keterangan);
		$jkkas_nilai=trim(@$_POST["jkkas_nilai"]);
		$jkkas_pemakai=trim(@$_POST["jkkas_pemakai"]);
		$jkkas_pemakai=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_pemakai);
		$jkkas_pemakai=str_replace("'", '"',$jkkas_pemakai);
		$jkkas_ref=trim(@$_POST["jkkas_ref"]);
		$jkkas_posting=trim(@$_POST["jkkas_posting"]);
		$jkkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_posting);
		$jkkas_posting=str_replace("'", '"',$jkkas_posting);
		$jkkas_tglposting=trim(@$_POST["jkkas_tglposting"]);
		$result=$this->m_jurnal_kas_keluar->jurnal_kas_keluar_create($jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting );
		echo $result;
	}

	//function for delete selected record
	function jurnal_kas_keluar_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jurnal_kas_keluar->jurnal_kas_keluar_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jurnal_kas_keluar_search(){
		//POST varibale here
		$jkkas_id=trim(@$_POST["jkkas_id"]);
		$jkkas_akun=trim(@$_POST["jkkas_akun"]);
		$jkkas_tanggal=trim(@$_POST["jkkas_tanggal"]);
		$jkkas_keterangan=trim(@$_POST["jkkas_keterangan"]);
		$jkkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_keterangan);
		$jkkas_keterangan=str_replace("'", '"',$jkkas_keterangan);
		$jkkas_nilai=trim(@$_POST["jkkas_nilai"]);
		$jkkas_pemakai=trim(@$_POST["jkkas_pemakai"]);
		$jkkas_pemakai=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_pemakai);
		$jkkas_pemakai=str_replace("'", '"',$jkkas_pemakai);
		$jkkas_ref=trim(@$_POST["jkkas_ref"]);
		$jkkas_posting=trim(@$_POST["jkkas_posting"]);
		$jkkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_posting);
		$jkkas_posting=str_replace("'", '"',$jkkas_posting);
		$jkkas_tglposting=trim(@$_POST["jkkas_tglposting"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jurnal_kas_keluar->jurnal_kas_keluar_search($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ,$start,$end);
		echo $result;
	}


	function jurnal_kas_keluar_print(){
  		//POST varibale here
		$jkkas_id=trim(@$_POST["jkkas_id"]);
		$jkkas_akun=trim(@$_POST["jkkas_akun"]);
		$jkkas_tanggal=trim(@$_POST["jkkas_tanggal"]);
		$jkkas_keterangan=trim(@$_POST["jkkas_keterangan"]);
		$jkkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_keterangan);
		$jkkas_keterangan=str_replace("'", '"',$jkkas_keterangan);
		$jkkas_nilai=trim(@$_POST["jkkas_nilai"]);
		$jkkas_pemakai=trim(@$_POST["jkkas_pemakai"]);
		$jkkas_pemakai=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_pemakai);
		$jkkas_pemakai=str_replace("'", '"',$jkkas_pemakai);
		$jkkas_ref=trim(@$_POST["jkkas_ref"]);
		$jkkas_posting=trim(@$_POST["jkkas_posting"]);
		$jkkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_posting);
		$jkkas_posting=str_replace("'", '"',$jkkas_posting);
		$jkkas_tglposting=trim(@$_POST["jkkas_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jurnal_kas_keluar->jurnal_kas_keluar_print($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=14;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jurnal_kas_keluarlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jurnal_kas_keluar Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jurnal_kas_keluar List'><caption>JURNAL_KAS_KELUAR</caption><thead><tr><th scope='col'>Jkkas Id</th><th scope='col'>Jkkas Akun</th><th scope='col'>Jkkas Tanggal</th><th scope='col'>Jkkas Keterangan</th><th scope='col'>Jkkas Nilai</th><th scope='col'>Jkkas Pemakai</th><th scope='col'>Jkkas Ref</th><th scope='col'>Jkkas Posting</th><th scope='col'>Jkkas Tglposting</th><th scope='col'>Jkkas Creator</th><th scope='col'>Jkkas Date Create</th><th scope='col'>Jkkas Update</th><th scope='col'>Jkkas Date Update</th><th scope='col'>Jkkas Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jurnal_kas_keluar</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jkkas_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jkkas_akun']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_pemakai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_ref']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_posting']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jkkas_tglposting']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jkkas_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jkkas_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jkkas_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jkkas_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jkkas_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jurnal_kas_keluar_export_excel(){
		//POST varibale here
		$jkkas_id=trim(@$_POST["jkkas_id"]);
		$jkkas_akun=trim(@$_POST["jkkas_akun"]);
		$jkkas_tanggal=trim(@$_POST["jkkas_tanggal"]);
		$jkkas_keterangan=trim(@$_POST["jkkas_keterangan"]);
		$jkkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_keterangan);
		$jkkas_keterangan=str_replace("'", '"',$jkkas_keterangan);
		$jkkas_nilai=trim(@$_POST["jkkas_nilai"]);
		$jkkas_pemakai=trim(@$_POST["jkkas_pemakai"]);
		$jkkas_pemakai=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_pemakai);
		$jkkas_pemakai=str_replace("'", '"',$jkkas_pemakai);
		$jkkas_ref=trim(@$_POST["jkkas_ref"]);
		$jkkas_posting=trim(@$_POST["jkkas_posting"]);
		$jkkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jkkas_posting);
		$jkkas_posting=str_replace("'", '"',$jkkas_posting);
		$jkkas_tglposting=trim(@$_POST["jkkas_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jurnal_kas_keluar->jurnal_kas_keluar_export_excel($jkkas_id ,$jkkas_akun ,$jkkas_tanggal ,$jkkas_keterangan ,$jkkas_nilai ,$jkkas_pemakai ,$jkkas_ref ,$jkkas_posting ,$jkkas_tglposting ,$option,$filter);
		
		to_excel($query,"jurnal_kas_keluar"); 
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