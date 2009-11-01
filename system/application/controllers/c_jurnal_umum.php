<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jurnal_umum Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jurnal_umum.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:25:17
	
*/

//class of jurnal_umum
class C_jurnal_umum extends Controller {

	//constructor
	function C_jurnal_umum(){
		parent::Controller();
		$this->load->model('m_jurnal_umum', '', TRUE);
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
		$this->load->view('main/v_jurnal_umum');
	}
	
	//for detail action
	//list detail handler action
	function  detail_jurnal_umum_detail_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_umum->detail_jurnal_umum_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_jurnal_umum_detail_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_jurnal_umum->detail_jurnal_umum_detail_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_jurnal_umum->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_jurnal_umum_detail_insert(){
	//POST variable here
		$djumum_id=trim(@$_POST["djumum_id"]);
		$djumum_master=trim(@$_POST["djumum_master"]);
		$djumum_akun=trim(@$_POST["djumum_akun"]);
		$djumum_keterangan=trim(@$_POST["djumum_keterangan"]);
		$djumum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$djumum_keterangan);
		$djumum_keterangan=str_replace("\\", "",$djumum_keterangan);
		$djumum_keterangan=str_replace("'", '"',$djumum_keterangan);
		$djumum_debet=trim(@$_POST["djumum_debet"]);
		$djumum_kredit=trim(@$_POST["djumum_kredit"]);
		$result=$this->m_jurnal_umum->detail_jurnal_umum_detail_insert($djumum_id ,$djumum_master ,$djumum_akun ,$djumum_keterangan ,$djumum_debet ,$djumum_kredit );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jurnal_umum_list();
				break;
			case "UPDATE":
				$this->jurnal_umum_update();
				break;
			case "CREATE":
				$this->jurnal_umum_create();
				break;
			case "DELETE":
				$this->jurnal_umum_delete();
				break;
			case "SEARCH":
				$this->jurnal_umum_search();
				break;
			case "PRINT":
				$this->jurnal_umum_print();
				break;
			case "EXCEL":
				$this->jurnal_umum_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jurnal_umum_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_jurnal_umum->jurnal_umum_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jurnal_umum_update(){
		//POST variable here
		$jumum_id=trim(@$_POST["jumum_id"]);
		$jumum_tanggal=trim(@$_POST["jumum_tanggal"]);
		$jumum_pengguna=trim(@$_POST["jumum_pengguna"]);
		$jumum_pengguna=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_pengguna);
		$jumum_pengguna=str_replace(",", ",",$jumum_pengguna);
		$jumum_pengguna=str_replace("'", '"',$jumum_pengguna);
		$jumum_keterangan=trim(@$_POST["jumum_keterangan"]);
		$jumum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_keterangan);
		$jumum_keterangan=str_replace(",", ",",$jumum_keterangan);
		$jumum_keterangan=str_replace("'", '"',$jumum_keterangan);
		$jumum_posting=trim(@$_POST["jumum_posting"]);
		$jumum_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_posting);
		$jumum_posting=str_replace(",", ",",$jumum_posting);
		$jumum_posting=str_replace("'", '"',$jumum_posting);
		$jumum_tglposting=trim(@$_POST["jumum_tglposting"]);
		$result = $this->m_jurnal_umum->jurnal_umum_update($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting      );
		echo $result;
	}
	
	//function for create new record
	function jurnal_umum_create(){
		//POST varible here
		$jumum_id=trim(@$_POST["jumum_id"]);
		$jumum_tanggal=trim(@$_POST["jumum_tanggal"]);
		$jumum_pengguna=trim(@$_POST["jumum_pengguna"]);
		$jumum_pengguna=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_pengguna);
		$jumum_pengguna=str_replace("'", '"',$jumum_pengguna);
		$jumum_keterangan=trim(@$_POST["jumum_keterangan"]);
		$jumum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_keterangan);
		$jumum_keterangan=str_replace("'", '"',$jumum_keterangan);
		$jumum_posting=trim(@$_POST["jumum_posting"]);
		$jumum_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_posting);
		$jumum_posting=str_replace("'", '"',$jumum_posting);
		$jumum_tglposting=trim(@$_POST["jumum_tglposting"]);
		$result=$this->m_jurnal_umum->jurnal_umum_create($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting );
		echo $result;
	}

	//function for delete selected record
	function jurnal_umum_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jurnal_umum->jurnal_umum_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jurnal_umum_search(){
		//POST varibale here
		$jumum_id=trim(@$_POST["jumum_id"]);
		$jumum_tanggal=trim(@$_POST["jumum_tanggal"]);
		$jumum_pengguna=trim(@$_POST["jumum_pengguna"]);
		$jumum_pengguna=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_pengguna);
		$jumum_pengguna=str_replace("'", '"',$jumum_pengguna);
		$jumum_keterangan=trim(@$_POST["jumum_keterangan"]);
		$jumum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_keterangan);
		$jumum_keterangan=str_replace("'", '"',$jumum_keterangan);
		$jumum_posting=trim(@$_POST["jumum_posting"]);
		$jumum_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_posting);
		$jumum_posting=str_replace("'", '"',$jumum_posting);
		$jumum_tglposting=trim(@$_POST["jumum_tglposting"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jurnal_umum->jurnal_umum_search($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ,$start,$end);
		echo $result;
	}


	function jurnal_umum_print(){
  		//POST varibale here
		$jumum_id=trim(@$_POST["jumum_id"]);
		$jumum_tanggal=trim(@$_POST["jumum_tanggal"]);
		$jumum_pengguna=trim(@$_POST["jumum_pengguna"]);
		$jumum_pengguna=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_pengguna);
		$jumum_pengguna=str_replace("'", '"',$jumum_pengguna);
		$jumum_keterangan=trim(@$_POST["jumum_keterangan"]);
		$jumum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_keterangan);
		$jumum_keterangan=str_replace("'", '"',$jumum_keterangan);
		$jumum_posting=trim(@$_POST["jumum_posting"]);
		$jumum_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_posting);
		$jumum_posting=str_replace("'", '"',$jumum_posting);
		$jumum_tglposting=trim(@$_POST["jumum_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jurnal_umum->jurnal_umum_print($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jurnal_umumlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jurnal_umum Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jurnal_umum List'><caption>JURNAL_UMUM</caption><thead><tr><th scope='col'>Jumum Id</th><th scope='col'>Jumum Tanggal</th><th scope='col'>Jumum Pengguna</th><th scope='col'>Jumum Keterangan</th><th scope='col'>Jumum Posting</th><th scope='col'>Jumum Tglposting</th><th scope='col'>Jumum Creator</th><th scope='col'>Jumum Date Create</th><th scope='col'>Jumum Update</th><th scope='col'>Jumum Date Update</th><th scope='col'>Jumum Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jurnal_umum</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jumum_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jumum_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jumum_pengguna']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jumum_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jumum_posting']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jumum_tglposting']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jumum_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jumum_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jumum_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jumum_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['jumum_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jurnal_umum_export_excel(){
		//POST varibale here
		$jumum_id=trim(@$_POST["jumum_id"]);
		$jumum_tanggal=trim(@$_POST["jumum_tanggal"]);
		$jumum_pengguna=trim(@$_POST["jumum_pengguna"]);
		$jumum_pengguna=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_pengguna);
		$jumum_pengguna=str_replace("'", '"',$jumum_pengguna);
		$jumum_keterangan=trim(@$_POST["jumum_keterangan"]);
		$jumum_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_keterangan);
		$jumum_keterangan=str_replace("'", '"',$jumum_keterangan);
		$jumum_posting=trim(@$_POST["jumum_posting"]);
		$jumum_posting=str_replace("/(<\/?)(p)([^>]*>)", "",$jumum_posting);
		$jumum_posting=str_replace("'", '"',$jumum_posting);
		$jumum_tglposting=trim(@$_POST["jumum_tglposting"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jurnal_umum->jurnal_umum_export_excel($jumum_id ,$jumum_tanggal ,$jumum_pengguna ,$jumum_keterangan ,$jumum_posting ,$jumum_tglposting ,$option,$filter);
		
		to_excel($query,"jurnal_umum"); 
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