<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jurnal_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jurnal_beli.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:22:37
	
*/

//class of jurnal_beli
class C_jurnal_beli extends Controller {

	//constructor
	function C_jurnal_beli(){
		parent::Controller();
		$this->load->model('m_jurnal_beli', '', TRUE);
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
		$this->load->view('main/v_jurnal_beli');
	}
	
	//for detail action
	//list detail handler action
	function  detail_jurnal_beli_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_beli->detail_jurnal_beli_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_jurnal_beli_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_beli->detail_jurnal_beli_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_jurnal_beli->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_jurnal_beli_detail_insert(){
	//POST variable here
		$djbeli_id=trim(@$_POST["djbeli_id"]);
		$djbeli_master=trim(@$_POST["djbeli_master"]);
		$djbeli_keterangan=trim(@$_POST["djbeli_keterangan"]);
		$djbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$djbeli_keterangan);
		$djbeli_keterangan=str_replace("\\", "",$djbeli_keterangan);
		$djbeli_keterangan=str_replace("'", '"',$djbeli_keterangan);
		$djbeli_akun=trim(@$_POST["djbeli_akun"]);
		$djbeli_nilai=trim(@$_POST["djbeli_nilai"]);
		$result=$this->m_jurnal_beli->detail_jurnal_beli_detail_insert($djbeli_id ,$djbeli_master ,$djbeli_keterangan ,$djbeli_akun ,$djbeli_nilai );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jurnal_beli_list();
				break;
			case "UPDATE":
				$this->jurnal_beli_update();
				break;
			case "CREATE":
				$this->jurnal_beli_create();
				break;
			case "DELETE":
				$this->jurnal_beli_delete();
				break;
			case "SEARCH":
				$this->jurnal_beli_search();
				break;
			case "PRINT":
				$this->jurnal_beli_print();
				break;
			case "EXCEL":
				$this->jurnal_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jurnal_beli_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_jurnal_beli->jurnal_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jurnal_beli_update(){
		//POST variable here
		$jbeli_id=trim(@$_POST["jbeli_id"]);
		$jbeli_tanggal=trim(@$_POST["jbeli_tanggal"]);
		$jbeli_akun=trim(@$_POST["jbeli_akun"]);
		$jbeli_keterangan=trim(@$_POST["jbeli_keterangan"]);
		$jbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_keterangan);
		$jbeli_keterangan=str_replace(",", ",",$jbeli_keterangan);
		$jbeli_keterangan=str_replace("'", '"',$jbeli_keterangan);
		$jbeli_nilai=trim(@$_POST["jbeli_nilai"]);
		$jbeli_ref=trim(@$_POST["jbeli_ref"]);
		$jbeli_penerima=trim(@$_POST["jbeli_penerima"]);
		$jbeli_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_penerima);
		$jbeli_penerima=str_replace(",", ",",$jbeli_penerima);
		$jbeli_penerima=str_replace("'", '"',$jbeli_penerima);
		$jbeli_posting=trim(@$_POST["jbeli_posting"]);
		$jbeli_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_posting);
		$jbeli_posting=str_replace(",", ",",$jbeli_posting);
		$jbeli_posting=str_replace("'", '"',$jbeli_posting);
		$jbeli_tglposting=trim(@$_POST["jbeli_tglposting"]);
		$result = $this->m_jurnal_beli->jurnal_beli_update($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting      );
		echo $result;
	}
	
	//function for create new record
	function jurnal_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jbeli_tanggal=trim(@$_POST["jbeli_tanggal"]);
		$jbeli_akun=trim(@$_POST["jbeli_akun"]);
		$jbeli_keterangan=trim(@$_POST["jbeli_keterangan"]);
		$jbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_keterangan);
		$jbeli_keterangan=str_replace("'", '"',$jbeli_keterangan);
		$jbeli_nilai=trim(@$_POST["jbeli_nilai"]);
		$jbeli_ref=trim(@$_POST["jbeli_ref"]);
		$jbeli_penerima=trim(@$_POST["jbeli_penerima"]);
		$jbeli_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_penerima);
		$jbeli_penerima=str_replace("'", '"',$jbeli_penerima);
		$jbeli_posting=trim(@$_POST["jbeli_posting"]);
		$jbeli_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_posting);
		$jbeli_posting=str_replace("'", '"',$jbeli_posting);
		$jbeli_tglposting=trim(@$_POST["jbeli_tglposting"]);
		$result=$this->m_jurnal_beli->jurnal_beli_create($jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting );
		echo $result;
	}

	//function for delete selected record
	function jurnal_beli_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jurnal_beli->jurnal_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jurnal_beli_search(){
		//POST varibale here
		$jbeli_id=trim(@$_POST["jbeli_id"]);
		$jbeli_tanggal=trim(@$_POST["jbeli_tanggal"]);
		$jbeli_akun=trim(@$_POST["jbeli_akun"]);
		$jbeli_keterangan=trim(@$_POST["jbeli_keterangan"]);
		$jbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_keterangan);
		$jbeli_keterangan=str_replace("'", '"',$jbeli_keterangan);
		$jbeli_nilai=trim(@$_POST["jbeli_nilai"]);
		$jbeli_ref=trim(@$_POST["jbeli_ref"]);
		$jbeli_penerima=trim(@$_POST["jbeli_penerima"]);
		$jbeli_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_penerima);
		$jbeli_penerima=str_replace("'", '"',$jbeli_penerima);
		$jbeli_posting=trim(@$_POST["jbeli_posting"]);
		$jbeli_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_posting);
		$jbeli_posting=str_replace("'", '"',$jbeli_posting);
		$jbeli_tglposting=trim(@$_POST["jbeli_tglposting"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jurnal_beli->jurnal_beli_search($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ,$start,$end);
		echo $result;
	}


	function jurnal_beli_print(){
  		//POST varibale here
		$jbeli_id=trim(@$_POST["jbeli_id"]);
		$jbeli_tanggal=trim(@$_POST["jbeli_tanggal"]);
		$jbeli_akun=trim(@$_POST["jbeli_akun"]);
		$jbeli_keterangan=trim(@$_POST["jbeli_keterangan"]);
		$jbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_keterangan);
		$jbeli_keterangan=str_replace("'", '"',$jbeli_keterangan);
		$jbeli_nilai=trim(@$_POST["jbeli_nilai"]);
		$jbeli_ref=trim(@$_POST["jbeli_ref"]);
		$jbeli_penerima=trim(@$_POST["jbeli_penerima"]);
		$jbeli_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_penerima);
		$jbeli_penerima=str_replace("'", '"',$jbeli_penerima);
		$jbeli_posting=trim(@$_POST["jbeli_posting"]);
		$jbeli_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_posting);
		$jbeli_posting=str_replace("'", '"',$jbeli_posting);
		$jbeli_tglposting=trim(@$_POST["jbeli_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jurnal_beli->jurnal_beli_print($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=14;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jurnal_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jurnal_beli Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jurnal_beli List'><caption>JURNAL_BELI</caption><thead><tr><th scope='col'>Jbeli Id</th><th scope='col'>Jbeli Tanggal</th><th scope='col'>Jbeli Akun</th><th scope='col'>Jbeli Keterangan</th><th scope='col'>Jbeli Nilai</th><th scope='col'>Jbeli Ref</th><th scope='col'>Jbeli Penerima</th><th scope='col'>Jbeli Posting</th><th scope='col'>Jbeli Tglposting</th><th scope='col'>Jbeli Creator</th><th scope='col'>Jbeli Date Create</th><th scope='col'>Jbeli Update</th><th scope='col'>Jbeli Date Update</th><th scope='col'>Jbeli Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jurnal_beli</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jbeli_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jbeli_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_akun']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_ref']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_penerima']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_posting']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbeli_tglposting']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jbeli_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jbeli_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jbeli_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jbeli_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jbeli_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jurnal_beli_export_excel(){
		//POST varibale here
		$jbeli_id=trim(@$_POST["jbeli_id"]);
		$jbeli_tanggal=trim(@$_POST["jbeli_tanggal"]);
		$jbeli_akun=trim(@$_POST["jbeli_akun"]);
		$jbeli_keterangan=trim(@$_POST["jbeli_keterangan"]);
		$jbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_keterangan);
		$jbeli_keterangan=str_replace("'", '"',$jbeli_keterangan);
		$jbeli_nilai=trim(@$_POST["jbeli_nilai"]);
		$jbeli_ref=trim(@$_POST["jbeli_ref"]);
		$jbeli_penerima=trim(@$_POST["jbeli_penerima"]);
		$jbeli_penerima=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_penerima);
		$jbeli_penerima=str_replace("'", '"',$jbeli_penerima);
		$jbeli_posting=trim(@$_POST["jbeli_posting"]);
		$jbeli_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jbeli_posting);
		$jbeli_posting=str_replace("'", '"',$jbeli_posting);
		$jbeli_tglposting=trim(@$_POST["jbeli_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jurnal_beli->jurnal_beli_export_excel($jbeli_id ,$jbeli_tanggal ,$jbeli_akun ,$jbeli_keterangan ,$jbeli_nilai ,$jbeli_ref ,$jbeli_penerima ,$jbeli_posting ,$jbeli_tglposting ,$option,$filter);
		
		to_excel($query,"jurnal_beli"); 
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