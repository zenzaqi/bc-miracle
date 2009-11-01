<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_terima_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_terima_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:44:15
	
*/

//class of master_terima_beli
class C_master_terima_beli extends Controller {

	//constructor
	function C_master_terima_beli(){
		parent::Controller();
		$this->load->model('m_master_terima_beli', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_terima_beli');
	}
	
	function get_produk_list(){
		$result=$this->m_public_function->get_produk_list();
		echo $result;
	}
	
	function get_satuan_list(){
		$result=$this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	function get_order_beli_list(){
		$result=$this->m_master_terima_beli->get_order_beli_list();
		echo $result;
	}
	
	function get_dorder_by_orderbeli(){
		//$result=$this->m_public_function->get_produk_list();
		//echo $result;
		$order_id = trim(@$_POST["master_order_id"]);
		$result=$this->m_master_terima_beli->get_dorder_by_orderbeli($order_id);
		echo $result;
	}
	
	function get_dorder_satuan_by_produkorder(){
		$dorder_master = trim(@$_POST["master_order_id"]);
		$dorder_produk = trim(@$_POST["dorder_produk_id"]);
		$result=$this->m_master_terima_beli->get_dorder_satuan_by_produkorder($dorder_master, $dorder_produk);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_terima_bonus_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_bonus_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_terima_bonus_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_bonus_purge($master_id);
		echo $result;
	}
	//eof
	
	//add detail
	function detail_detail_terima_bonus_insert(){
	//POST variable here
		$dtbonus_id=trim(@$_POST["dtbonus_id"]);
		$dtbonus_master=trim(@$_POST["dtbonus_master"]);
		$dtbonus_produk=trim(@$_POST["dtbonus_produk"]);
		$dtbonus_satuan=trim(@$_POST["dtbonus_satuan"]);
		$dtbonus_jumlah=trim(@$_POST["dtbonus_jumlah"]);
		$result=$this->m_master_terima_beli->detail_detail_terima_bonus_insert($dtbonus_id ,$dtbonus_master ,$dtbonus_produk ,$dtbonus_satuan ,$dtbonus_jumlah );
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_terima_beli_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_beli_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_terima_beli_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_beli_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_terima_beli->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_terima_beli_insert(){
	//POST variable here
		$dterima_id=trim(@$_POST["dterima_id"]);
		$dterima_master=trim(@$_POST["dterima_master"]);
		$dterima_produk=trim(@$_POST["dterima_produk"]);
		$dterima_satuan=trim(@$_POST["dterima_satuan"]);
		$dterima_jumlah=trim(@$_POST["dterima_jumlah"]);
		$result=$this->m_master_terima_beli->detail_detail_terima_beli_insert($dterima_id ,$dterima_master ,$dterima_produk ,$dterima_satuan ,$dterima_jumlah );
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_terima_beli_list();
				break;
			case "UPDATE":
				$this->master_terima_beli_update();
				break;
			case "CREATE":
				$this->master_terima_beli_create();
				break;
			case "DELETE":
				$this->master_terima_beli_delete();
				break;
			case "SEARCH":
				$this->master_terima_beli_search();
				break;
			case "PRINT":
				$this->master_terima_beli_print();
				break;
			case "EXCEL":
				$this->master_terima_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_terima_beli_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_terima_beli->master_terima_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_terima_beli_update(){
		//POST variable here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace(",", ",",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace(",", ",",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace(",", ",",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace(",", ",",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$result = $this->m_master_terima_beli->master_terima_beli_update($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function master_terima_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$result=$this->m_master_terima_beli->master_terima_beli_create($terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_terima_beli_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_terima_beli->master_terima_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_terima_beli_search(){
		//POST varibale here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_terima_beli->master_terima_beli_search($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$start,$end);
		echo $result;
	}


	function master_terima_beli_print(){
  		//POST varibale here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_terima_beli->master_terima_beli_print($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=13;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_terima_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_terima_beli Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_terima_beli List'><caption>MASTER_TERIMA_BELI</caption><thead><tr><th scope='col'>Terima Id</th><th scope='col'>Terima No</th><th scope='col'>Terima Order</th><th scope='col'>Terima Supplier</th><th scope='col'>Terima Surat Jalan</th><th scope='col'>Terima Pengirim</th><th scope='col'>Terima Tanggal</th><th scope='col'>Terima Keterangan</th><th scope='col'>Terima Creator</th><th scope='col'>Terima Date Create</th><th scope='col'>Terima Update</th><th scope='col'>Terima Date Update</th><th scope='col'>Terima Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_terima_beli</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['terima_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['terima_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_order']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_supplier']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_surat_jalan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_pengirim']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['terima_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['terima_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['terima_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['terima_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['terima_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_terima_beli_export_excel(){
		//POST varibale here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_terima_beli->master_terima_beli_export_excel($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$option,$filter);
		
		to_excel($query,"master_terima_beli"); 
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