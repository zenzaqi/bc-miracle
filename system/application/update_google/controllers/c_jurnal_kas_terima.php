<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jurnal_kas_terima Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jurnal_kas_terima.php
 	+ Author  		: 
 	+ Created on 03/Oct/2009 13:10:15
	
*/

//class of jurnal_kas_terima
class C_jurnal_kas_terima extends Controller {

	//constructor
	function C_jurnal_kas_terima(){
		parent::Controller();
		$this->load->model('m_jurnal_kas_terima', '', TRUE);
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
		$this->load->view('main/v_jurnal_kas_terima');
	}
	
	//for detail action
	//list detail handler action
	function  detail_jurnal_kas_terima_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_kas_terima->detail_jurnal_kas_terima_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_jurnal_kas_terima_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_kas_terima->detail_jurnal_kas_terima_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_jurnal_kas_terima->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_jurnal_kas_terima_detail_insert(){
	//POST variable here
		$djmkas_id=trim(@$_POST["djmkas_id"]);
		$djmkas_master=trim(@$_POST["djmkas_master"]);
		$djmkas_akun=trim(@$_POST["djmkas_akun"]);
		$djmkas_keterangan=trim(@$_POST["djmkas_keterangan"]);
		$djmkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$djmkas_keterangan);
		$djmkas_keterangan=str_replace("\\", "",$djmkas_keterangan);
		$djmkas_keterangan=str_replace("'", '"',$djmkas_keterangan);
		$djmkas_nilai=trim(@$_POST["djmkas_nilai"]);
		$result=$this->m_jurnal_kas_terima->detail_jurnal_kas_terima_detail_insert($djmkas_id ,$djmkas_master ,$djmkas_akun ,$djmkas_keterangan ,$djmkas_nilai );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jurnal_kas_terima_list();
				break;
			case "UPDATE":
				$this->jurnal_kas_terima_update();
				break;
			case "CREATE":
				$this->jurnal_kas_terima_create();
				break;
			case "DELETE":
				$this->jurnal_kas_terima_delete();
				break;
			case "SEARCH":
				$this->jurnal_kas_terima_search();
				break;
			case "PRINT":
				$this->jurnal_kas_terima_print();
				break;
			case "EXCEL":
				$this->jurnal_kas_terima_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jurnal_kas_terima_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_jurnal_kas_terima->jurnal_kas_terima_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jurnal_kas_terima_update(){
		//POST variable here
		$jmkas_id=trim(@$_POST["jmkas_id"]);
		$jmkas_akun=trim(@$_POST["jmkas_akun"]);
		$jmkas_tanggal=trim(@$_POST["jmkas_tanggal"]);
		$jmkas_keterangan=trim(@$_POST["jmkas_keterangan"]);
		$jmkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_keterangan);
		$jmkas_keterangan=str_replace(",", ",",$jmkas_keterangan);
		$jmkas_keterangan=str_replace("'", '"',$jmkas_keterangan);
		$jmkas_nilai=trim(@$_POST["jmkas_nilai"]);
		$jmkas_asal=trim(@$_POST["jmkas_asal"]);
		$jmkas_asal=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_asal);
		$jmkas_asal=str_replace(",", ",",$jmkas_asal);
		$jmkas_asal=str_replace("'", '"',$jmkas_asal);
		$jmkas_ref=trim(@$_POST["jmkas_ref"]);
		$jmkas_posting=trim(@$_POST["jmkas_posting"]);
		$jmkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_posting);
		$jmkas_posting=str_replace(",", ",",$jmkas_posting);
		$jmkas_posting=str_replace("'", '"',$jmkas_posting);
		$jmkas_tglposting=trim(@$_POST["jmkas_tglposting"]);
		$result = $this->m_jurnal_kas_terima->jurnal_kas_terima_update($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting      );
		echo $result;
	}
	
	//function for create new record
	function jurnal_kas_terima_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$jmkas_akun=trim(@$_POST["jmkas_akun"]);
		$jmkas_tanggal=trim(@$_POST["jmkas_tanggal"]);
		$jmkas_keterangan=trim(@$_POST["jmkas_keterangan"]);
		$jmkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_keterangan);
		$jmkas_keterangan=str_replace("'", '"',$jmkas_keterangan);
		$jmkas_nilai=trim(@$_POST["jmkas_nilai"]);
		$jmkas_asal=trim(@$_POST["jmkas_asal"]);
		$jmkas_asal=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_asal);
		$jmkas_asal=str_replace("'", '"',$jmkas_asal);
		$jmkas_ref=trim(@$_POST["jmkas_ref"]);
		$jmkas_posting=trim(@$_POST["jmkas_posting"]);
		$jmkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_posting);
		$jmkas_posting=str_replace("'", '"',$jmkas_posting);
		$jmkas_tglposting=trim(@$_POST["jmkas_tglposting"]);
		$result=$this->m_jurnal_kas_terima->jurnal_kas_terima_create($jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting );
		echo $result;
	}

	//function for delete selected record
	function jurnal_kas_terima_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jurnal_kas_terima->jurnal_kas_terima_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jurnal_kas_terima_search(){
		//POST varibale here
		$jmkas_id=trim(@$_POST["jmkas_id"]);
		$jmkas_akun=trim(@$_POST["jmkas_akun"]);
		$jmkas_tanggal=trim(@$_POST["jmkas_tanggal"]);
		$jmkas_keterangan=trim(@$_POST["jmkas_keterangan"]);
		$jmkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_keterangan);
		$jmkas_keterangan=str_replace("'", '"',$jmkas_keterangan);
		$jmkas_nilai=trim(@$_POST["jmkas_nilai"]);
		$jmkas_asal=trim(@$_POST["jmkas_asal"]);
		$jmkas_asal=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_asal);
		$jmkas_asal=str_replace("'", '"',$jmkas_asal);
		$jmkas_ref=trim(@$_POST["jmkas_ref"]);
		$jmkas_posting=trim(@$_POST["jmkas_posting"]);
		$jmkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_posting);
		$jmkas_posting=str_replace("'", '"',$jmkas_posting);
		$jmkas_tglposting=trim(@$_POST["jmkas_tglposting"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jurnal_kas_terima->jurnal_kas_terima_search($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ,$start,$end);
		echo $result;
	}


	function jurnal_kas_terima_print(){
  		//POST varibale here
		$jmkas_id=trim(@$_POST["jmkas_id"]);
		$jmkas_akun=trim(@$_POST["jmkas_akun"]);
		$jmkas_tanggal=trim(@$_POST["jmkas_tanggal"]);
		$jmkas_keterangan=trim(@$_POST["jmkas_keterangan"]);
		$jmkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_keterangan);
		$jmkas_keterangan=str_replace("'", '"',$jmkas_keterangan);
		$jmkas_nilai=trim(@$_POST["jmkas_nilai"]);
		$jmkas_asal=trim(@$_POST["jmkas_asal"]);
		$jmkas_asal=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_asal);
		$jmkas_asal=str_replace("'", '"',$jmkas_asal);
		$jmkas_ref=trim(@$_POST["jmkas_ref"]);
		$jmkas_posting=trim(@$_POST["jmkas_posting"]);
		$jmkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_posting);
		$jmkas_posting=str_replace("'", '"',$jmkas_posting);
		$jmkas_tglposting=trim(@$_POST["jmkas_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jurnal_kas_terima->jurnal_kas_terima_print($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=14;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jurnal_kas_terimalist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jurnal_kas_terima Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jurnal_kas_terima List'><caption>JURNAL_KAS_TERIMA</caption><thead><tr><th scope='col'>Jmkas Id</th><th scope='col'>Jmkas Akun</th><th scope='col'>Jmkas Tanggal</th><th scope='col'>Jmkas Keterangan</th><th scope='col'>Jmkas Nilai</th><th scope='col'>Jmkas Asal</th><th scope='col'>Jmkas Ref</th><th scope='col'>Jmkas Posting</th><th scope='col'>Jmkas Tglposting</th><th scope='col'>Jmkas Creator</th><th scope='col'>Jmkas Date Create</th><th scope='col'>Jmkas Update</th><th scope='col'>Jmkas Date Update</th><th scope='col'>Jmkas Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jurnal_kas_terima</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jmkas_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jmkas_akun']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_asal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_ref']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_posting']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jmkas_tglposting']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jmkas_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jmkas_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jmkas_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jmkas_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jmkas_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jurnal_kas_terima_export_excel(){
		//POST varibale here
		$jmkas_id=trim(@$_POST["jmkas_id"]);
		$jmkas_akun=trim(@$_POST["jmkas_akun"]);
		$jmkas_tanggal=trim(@$_POST["jmkas_tanggal"]);
		$jmkas_keterangan=trim(@$_POST["jmkas_keterangan"]);
		$jmkas_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_keterangan);
		$jmkas_keterangan=str_replace("'", '"',$jmkas_keterangan);
		$jmkas_nilai=trim(@$_POST["jmkas_nilai"]);
		$jmkas_asal=trim(@$_POST["jmkas_asal"]);
		$jmkas_asal=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_asal);
		$jmkas_asal=str_replace("'", '"',$jmkas_asal);
		$jmkas_ref=trim(@$_POST["jmkas_ref"]);
		$jmkas_posting=trim(@$_POST["jmkas_posting"]);
		$jmkas_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jmkas_posting);
		$jmkas_posting=str_replace("'", '"',$jmkas_posting);
		$jmkas_tglposting=trim(@$_POST["jmkas_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jurnal_kas_terima->jurnal_kas_terima_export_excel($jmkas_id ,$jmkas_akun ,$jmkas_tanggal ,$jmkas_keterangan ,$jmkas_nilai ,$jmkas_asal ,$jmkas_ref ,$jmkas_posting ,$jmkas_tglposting ,$option,$filter);
		
		to_excel($query,"jurnal_kas_terima"); 
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