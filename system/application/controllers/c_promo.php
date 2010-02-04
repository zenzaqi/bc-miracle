<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: promo Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_promo.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 08:57:17
	
*/

//class of promo
class C_promo extends Controller {

	//constructor
	function C_promo(){
		parent::Controller();
		$this->load->model('m_promo', '', TRUE);
		
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->helper('asset');
		$this->load->view('main/v_promo');
	}
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_promo->get_produk_list($query, $start, $end);
		echo $result;
	}
	
	function get_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_promo->get_rawat_list($query,$start,$end);
		echo $result;
	}
	
	function detail_promo_perawatan_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_promo->detail_promo_perawatan_list($master_id,$query,$start,$end);
		echo $result;
	}
	
	function detail_promo_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_promo->detail_promo_produk_list($master_id,$query,$start,$end);
		echo $result;
	}
	
	//for detail action
	
	
	//list detail handler action
	function  detail_promo_berlaku_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_promo->detail_promo_berlaku_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_promo_produk_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_promo->detail_promo_produk_purge($master_id);
	}
	
	function detail_promo_perawatan_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_promo->detail_promo_perawatan_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_promo->get_master_id();
		echo $result;
	}
	//
	function get_produk_rawat_list(){
		$result=$this->m_public_function->get_produk_rawat_list();
		echo $result;
	}
	
	//add detail
	function detail_promo_produk_insert(){
	//POST variable here
		$ipromo_id=trim(@$_POST["ipromo_id"]);
		$ipromo_master=trim(@$_POST["ipromo_master"]);
		$ipromo_produk=trim(@$_POST["ipromo_produk"]);
		$result=$this->m_promo->detail_promo_produk_insert($ipromo_id,$ipromo_master ,$ipromo_produk );
	}
	
	function detail_promo_perawatan_insert(){
	//POST variable here
		$rpromo_id=trim(@$_POST["rpromo_id"]);
		$rpromo_master=trim(@$_POST["rpromo_master"]);
		$rpromo_perawatan=trim(@$_POST["rpromo_perawatan"]);
		$result=$this->m_promo->detail_promo_perawatan_insert($rpromo_id,$rpromo_master ,$rpromo_perawatan );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->promo_list();
				break;
			case "UPDATE":
				$this->promo_update();
				break;
			case "CREATE":
				$this->promo_create();
				break;
			case "DELETE":
				$this->promo_delete();
				break;
			case "SEARCH":
				$this->promo_search();
				break;
			case "PRINT":
				$this->promo_print();
				break;
			case "EXCEL":
				$this->promo_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function promo_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_promo->promo_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function promo_update(){
		//POST variable here
		$promo_id=trim(@$_POST["promo_id"]);
		$promo_acara=trim(@$_POST["promo_acara"]);
		$promo_acara=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_acara);
		$promo_acara=str_replace(",", ",",$promo_acara);
		$promo_acara=str_replace("'", '"',$promo_acara);
		$promo_tempat=trim(@$_POST["promo_tempat"]);
		$promo_tempat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_tempat);
		$promo_tempat=str_replace(",", ",",$promo_tempat);
		$promo_tempat=str_replace("'", '"',$promo_tempat);
		$promo_keterangan=trim(@$_POST["promo_keterangan"]);
		$promo_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_keterangan);
		$promo_keterangan=str_replace(",", ",",$promo_keterangan);
		$promo_keterangan=str_replace("'", '"',$promo_keterangan);
		$promo_tglmulai=trim(@$_POST["promo_tglmulai"]);
		$promo_tglselesai=trim(@$_POST["promo_tglselesai"]);
		$promo_cashback=trim(@$_POST["promo_cashback"]);
		$promo_mincash=trim(@$_POST["promo_mincash"]);
		$promo_diskon=trim(@$_POST["promo_diskon"]);
		$promo_allproduk=trim(@$_POST["promo_allproduk"]);
		$promo_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allproduk);
		$promo_allproduk=str_replace(",", ",",$promo_allproduk);
		$promo_allproduk=str_replace("'", '"',$promo_allproduk);
		$promo_allrawat=trim(@$_POST["promo_allrawat"]);
		$promo_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allrawat);
		$promo_allrawat=str_replace(",", ",",$promo_allrawat);
		$promo_allrawat=str_replace("'", '"',$promo_allrawat);
		$result = $this->m_promo->promo_update($promo_id ,$promo_acara ,$promo_tempat, $promo_keterangan ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat      );
		echo $result;
	}
	
	//function for create new record
	function promo_create(){
		//POST varible here
		$promo_id=trim(@$_POST["promo_id"]);
		$promo_acara=trim(@$_POST["promo_acara"]);
		$promo_acara=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_acara);
		$promo_acara=str_replace("'", '"',$promo_acara);
		$promo_tempat=trim(@$_POST["promo_tempat"]);
		$promo_tempat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_tempat);
		$promo_tempat=str_replace("'", '"',$promo_tempat);
		$promo_keterangan=trim(@$_POST["promo_keterangan"]);
		$promo_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_keterangan);
		$promo_keterangan=str_replace(",", ",",$promo_keterangan);
		$promo_keterangan=str_replace("'", '"',$promo_keterangan);
		$promo_tglmulai=trim(@$_POST["promo_tglmulai"]);
		$promo_tglselesai=trim(@$_POST["promo_tglselesai"]);
		$promo_cashback=trim(@$_POST["promo_cashback"]);
		$promo_mincash=trim(@$_POST["promo_mincash"]);
		$promo_diskon=trim(@$_POST["promo_diskon"]);
		$promo_allproduk=trim(@$_POST["promo_allproduk"]);
		$promo_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allproduk);
		$promo_allproduk=str_replace("'", '"',$promo_allproduk);
		$promo_allrawat=trim(@$_POST["promo_allrawat"]);
		$promo_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allrawat);
		$promo_allrawat=str_replace("'", '"',$promo_allrawat);
		$result=$this->m_promo->promo_create($promo_id ,$promo_acara ,$promo_tempat, $promo_keterangan ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat );
		echo $result;
	}

	//function for delete selected record
	function promo_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_promo->promo_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function promo_search(){
		//POST varibale here
		$promo_id=trim(@$_POST["promo_id"]);
		$promo_acara=trim(@$_POST["promo_acara"]);
		$promo_acara=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_acara);
		$promo_acara=str_replace("'", '"',$promo_acara);
		$promo_tempat=trim(@$_POST["promo_tempat"]);
		$promo_tempat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_tempat);
		$promo_tempat=str_replace("'", '"',$promo_tempat);
		$promo_keterangan=trim(@$_POST["promo_keterangan"]);
		$promo_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_keterangan);
		$promo_keterangan=str_replace(",", ",",$promo_keterangan);
		$promo_keterangan=str_replace("'", '"',$promo_keterangan);
		$promo_tglmulai=trim(@$_POST["promo_tglmulai"]);
		$promo_tglselesai=trim(@$_POST["promo_tglselesai"]);
		$promo_cashback=trim(@$_POST["promo_cashback"]);
		$promo_mincash=trim(@$_POST["promo_mincash"]);
		$promo_diskon=trim(@$_POST["promo_diskon"]);
		$promo_allproduk=trim(@$_POST["promo_allproduk"]);
		$promo_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allproduk);
		$promo_allproduk=str_replace("'", '"',$promo_allproduk);
		$promo_allrawat=trim(@$_POST["promo_allrawat"]);
		$promo_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allrawat);
		$promo_allrawat=str_replace("'", '"',$promo_allrawat);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_promo->promo_search($promo_id ,$promo_acara ,$promo_tempat, $promo_keterangan ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ,$start,$end);
		echo $result;
	}


	function promo_print(){
  		//POST varibale here
		$promo_id=trim(@$_POST["promo_id"]);
		$promo_acara=trim(@$_POST["promo_acara"]);
		$promo_acara=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_acara);
		$promo_acara=str_replace("'", '"',$promo_acara);
		$promo_tempat=trim(@$_POST["promo_tempat"]);
		$promo_tempat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_tempat);
		$promo_tempat=str_replace("'", '"',$promo_tempat);
		$promo_keterangan=trim(@$_POST["promo_keterangan"]);
		$promo_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_keterangan);
		$promo_keterangan=str_replace(",", ",",$promo_keterangan);
		$promo_keterangan=str_replace("'", '"',$promo_keterangan);
		$promo_tglmulai=trim(@$_POST["promo_tglmulai"]);
		$promo_tglselesai=trim(@$_POST["promo_tglselesai"]);
		$promo_cashback=trim(@$_POST["promo_cashback"]);
		$promo_mincash=trim(@$_POST["promo_mincash"]);
		$promo_diskon=trim(@$_POST["promo_diskon"]);
		$promo_allproduk=trim(@$_POST["promo_allproduk"]);
		$promo_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allproduk);
		$promo_allproduk=str_replace("'", '"',$promo_allproduk);
		$promo_allrawat=trim(@$_POST["promo_allrawat"]);
		$promo_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allrawat);
		$promo_allrawat=str_replace("'", '"',$promo_allrawat);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_promo->promo_print($promo_id ,$promo_acara ,$promo_tempat, $promo_keterangan ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=15;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("promolist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Promo Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Promo List'><caption>PROMO</caption><thead><tr><th scope='col'>Promo Id</th><th scope='col'>Promo Acara</th><th scope='col'>Promo Tempat</th><th scope='col'>Promo Tglmulai</th><th scope='col'>Promo Tglselesai</th><th scope='col'>Promo Cashback</th><th scope='col'>Promo Mincash</th><th scope='col'>Promo Diskon</th><th scope='col'>Promo Allproduk</th><th scope='col'>Promo Allrawat</th><th scope='col'>Promo Creator</th><th scope='col'>Promo Date Create</th><th scope='col'>Promo Update</th><th scope='col'>Promo Date Update</th><th scope='col'>Promo Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Promo</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['promo_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['promo_acara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_tempat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_tglmulai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_tglselesai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_cashback']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_mincash']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_allproduk']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_allrawat']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['promo_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['promo_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['promo_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['promo_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['promo_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function promo_export_excel(){
		//POST varibale here
		$promo_id=trim(@$_POST["promo_id"]);
		$promo_acara=trim(@$_POST["promo_acara"]);
		$promo_acara=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_acara);
		$promo_acara=str_replace("'", '"',$promo_acara);
		$promo_tempat=trim(@$_POST["promo_tempat"]);
		$promo_tempat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_tempat);
		$promo_tempat=str_replace("'", '"',$promo_tempat);
		$promo_keterangan=trim(@$_POST["promo_keterangan"]);
		$promo_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_keterangan);
		$promo_keterangan=str_replace(",", ",",$promo_keterangan);
		$promo_keterangan=str_replace("'", '"',$promo_keterangan);
		$promo_tglmulai=trim(@$_POST["promo_tglmulai"]);
		$promo_tglselesai=trim(@$_POST["promo_tglselesai"]);
		$promo_cashback=trim(@$_POST["promo_cashback"]);
		$promo_mincash=trim(@$_POST["promo_mincash"]);
		$promo_diskon=trim(@$_POST["promo_diskon"]);
		$promo_allproduk=trim(@$_POST["promo_allproduk"]);
		$promo_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allproduk);
		$promo_allproduk=str_replace("'", '"',$promo_allproduk);
		$promo_allrawat=trim(@$_POST["promo_allrawat"]);
		$promo_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$promo_allrawat);
		$promo_allrawat=str_replace("'", '"',$promo_allrawat);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_promo->promo_export_excel($promo_id ,$promo_acara ,$promo_tempat, $promo_keterangan ,$promo_tglmulai ,$promo_tglselesai ,$promo_cashback ,$promo_mincash ,$promo_diskon ,$promo_allproduk ,$promo_allrawat ,$option,$filter);
		
		to_excel($query,"promo"); 
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