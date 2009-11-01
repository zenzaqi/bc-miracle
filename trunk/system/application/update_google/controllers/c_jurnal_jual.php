<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jurnal_jual Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jurnal_jual.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:22:58
	
*/

//class of jurnal_jual
class C_jurnal_jual extends Controller {

	//constructor
	function C_jurnal_jual(){
		parent::Controller();
		$this->load->model('m_jurnal_jual', '', TRUE);
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
		$this->load->view('main/v_jurnal_jual');
	}
	
	//for detail action
	//list detail handler action
	function  detail_jurnal_jual_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_jual->detail_jurnal_jual_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_jurnal_jual_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_jual->detail_jurnal_jual_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_jurnal_jual->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_jurnal_jual_detail_insert(){
	//POST variable here
		$djjual_id=trim(@$_POST["djjual_id"]);
		$djjual_master=trim(@$_POST["djjual_master"]);
		$djjual_keterangan=trim(@$_POST["djjual_keterangan"]);
		$djjual_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$djjual_keterangan);
		$djjual_keterangan=str_replace("\\", "",$djjual_keterangan);
		$djjual_keterangan=str_replace("'", '"',$djjual_keterangan);
		$djjual_akun=trim(@$_POST["djjual_akun"]);
		$djjual_nilai=trim(@$_POST["djjual_nilai"]);
		$result=$this->m_jurnal_jual->detail_jurnal_jual_detail_insert($djjual_id ,$djjual_master ,$djjual_keterangan ,$djjual_akun ,$djjual_nilai );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jurnal_jual_list();
				break;
			case "UPDATE":
				$this->jurnal_jual_update();
				break;
			case "CREATE":
				$this->jurnal_jual_create();
				break;
			case "DELETE":
				$this->jurnal_jual_delete();
				break;
			case "SEARCH":
				$this->jurnal_jual_search();
				break;
			case "PRINT":
				$this->jurnal_jual_print();
				break;
			case "EXCEL":
				$this->jurnal_jual_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jurnal_jual_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_jurnal_jual->jurnal_jual_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jurnal_jual_update(){
		//POST variable here
		$jjual_id=trim(@$_POST["jjual_id"]);
		$jjual_akun=trim(@$_POST["jjual_akun"]);
		$jjual_tanggal=trim(@$_POST["jjual_tanggal"]);
		$jjual_keterangan=trim(@$_POST["jjual_keterangan"]);
		$jjual_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_keterangan);
		$jjual_keterangan=str_replace(",", ",",$jjual_keterangan);
		$jjual_keterangan=str_replace("'", '"',$jjual_keterangan);
		$jjual_nilai=trim(@$_POST["jjual_nilai"]);
		$jjual_ref=trim(@$_POST["jjual_ref"]);
		$jjual_penerima=trim(@$_POST["jjual_penerima"]);
		$jjual_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_penerima);
		$jjual_penerima=str_replace(",", ",",$jjual_penerima);
		$jjual_penerima=str_replace("'", '"',$jjual_penerima);
		$jjual_posting=trim(@$_POST["jjual_posting"]);
		$jjual_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_posting);
		$jjual_posting=str_replace(",", ",",$jjual_posting);
		$jjual_posting=str_replace("'", '"',$jjual_posting);
		$jjual_tglposting=trim(@$_POST["jjual_tglposting"]);
		$result = $this->m_jurnal_jual->jurnal_jual_update($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting      );
		echo $result;
	}
	
	//function for create new record
	function jurnal_jual_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jjual_akun=trim(@$_POST["jjual_akun"]);
		$jjual_tanggal=trim(@$_POST["jjual_tanggal"]);
		$jjual_keterangan=trim(@$_POST["jjual_keterangan"]);
		$jjual_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_keterangan);
		$jjual_keterangan=str_replace("'", '"',$jjual_keterangan);
		$jjual_nilai=trim(@$_POST["jjual_nilai"]);
		$jjual_ref=trim(@$_POST["jjual_ref"]);
		$jjual_penerima=trim(@$_POST["jjual_penerima"]);
		$jjual_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_penerima);
		$jjual_penerima=str_replace("'", '"',$jjual_penerima);
		$jjual_posting=trim(@$_POST["jjual_posting"]);
		$jjual_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_posting);
		$jjual_posting=str_replace("'", '"',$jjual_posting);
		$jjual_tglposting=trim(@$_POST["jjual_tglposting"]);
		$result=$this->m_jurnal_jual->jurnal_jual_create($jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting );
		echo $result;
	}

	//function for delete selected record
	function jurnal_jual_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jurnal_jual->jurnal_jual_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jurnal_jual_search(){
		//POST varibale here
		$jjual_id=trim(@$_POST["jjual_id"]);
		$jjual_akun=trim(@$_POST["jjual_akun"]);
		$jjual_tanggal=trim(@$_POST["jjual_tanggal"]);
		$jjual_keterangan=trim(@$_POST["jjual_keterangan"]);
		$jjual_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_keterangan);
		$jjual_keterangan=str_replace("'", '"',$jjual_keterangan);
		$jjual_nilai=trim(@$_POST["jjual_nilai"]);
		$jjual_ref=trim(@$_POST["jjual_ref"]);
		$jjual_penerima=trim(@$_POST["jjual_penerima"]);
		$jjual_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_penerima);
		$jjual_penerima=str_replace("'", '"',$jjual_penerima);
		$jjual_posting=trim(@$_POST["jjual_posting"]);
		$jjual_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_posting);
		$jjual_posting=str_replace("'", '"',$jjual_posting);
		$jjual_tglposting=trim(@$_POST["jjual_tglposting"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jurnal_jual->jurnal_jual_search($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ,$start,$end);
		echo $result;
	}


	function jurnal_jual_print(){
  		//POST varibale here
		$jjual_id=trim(@$_POST["jjual_id"]);
		$jjual_akun=trim(@$_POST["jjual_akun"]);
		$jjual_tanggal=trim(@$_POST["jjual_tanggal"]);
		$jjual_keterangan=trim(@$_POST["jjual_keterangan"]);
		$jjual_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_keterangan);
		$jjual_keterangan=str_replace("'", '"',$jjual_keterangan);
		$jjual_nilai=trim(@$_POST["jjual_nilai"]);
		$jjual_ref=trim(@$_POST["jjual_ref"]);
		$jjual_penerima=trim(@$_POST["jjual_penerima"]);
		$jjual_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_penerima);
		$jjual_penerima=str_replace("'", '"',$jjual_penerima);
		$jjual_posting=trim(@$_POST["jjual_posting"]);
		$jjual_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_posting);
		$jjual_posting=str_replace("'", '"',$jjual_posting);
		$jjual_tglposting=trim(@$_POST["jjual_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jurnal_jual->jurnal_jual_print($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=14;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jurnal_juallist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jurnal_jual Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jurnal_jual List'><caption>JURNAL_JUAL</caption><thead><tr><th scope='col'>Jjual Id</th><th scope='col'>Jjual Akun</th><th scope='col'>Jjual Tanggal</th><th scope='col'>Jjual Keterangan</th><th scope='col'>Jjual Nilai</th><th scope='col'>Jjual Ref</th><th scope='col'>Jjual Penerima</th><th scope='col'>Jjual Posting</th><th scope='col'>Jjual Tglposting</th><th scope='col'>Jjual Creator</th><th scope='col'>Jjual Date Create</th><th scope='col'>Jjual Update</th><th scope='col'>Jjual Date Update</th><th scope='col'>Jjual Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jurnal_jual</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jjual_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jjual_akun']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_ref']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_penerima']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_posting']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jjual_tglposting']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jjual_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jjual_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jjual_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jjual_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jjual_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jurnal_jual_export_excel(){
		//POST varibale here
		$jjual_id=trim(@$_POST["jjual_id"]);
		$jjual_akun=trim(@$_POST["jjual_akun"]);
		$jjual_tanggal=trim(@$_POST["jjual_tanggal"]);
		$jjual_keterangan=trim(@$_POST["jjual_keterangan"]);
		$jjual_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_keterangan);
		$jjual_keterangan=str_replace("'", '"',$jjual_keterangan);
		$jjual_nilai=trim(@$_POST["jjual_nilai"]);
		$jjual_ref=trim(@$_POST["jjual_ref"]);
		$jjual_penerima=trim(@$_POST["jjual_penerima"]);
		$jjual_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_penerima);
		$jjual_penerima=str_replace("'", '"',$jjual_penerima);
		$jjual_posting=trim(@$_POST["jjual_posting"]);
		$jjual_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jjual_posting);
		$jjual_posting=str_replace("'", '"',$jjual_posting);
		$jjual_tglposting=trim(@$_POST["jjual_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jurnal_jual->jurnal_jual_export_excel($jjual_id ,$jjual_akun ,$jjual_tanggal ,$jjual_keterangan ,$jjual_nilai ,$jjual_ref ,$jjual_penerima ,$jjual_posting ,$jjual_tglposting ,$option,$filter);
		
		to_excel($query,"jurnal_jual"); 
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