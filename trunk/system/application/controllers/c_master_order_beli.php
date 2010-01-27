<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_order_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_order_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:12
	
*/

//class of master_order_beli
class C_master_order_beli extends Controller {

	//constructor
	function C_master_order_beli(){
		parent::Controller();
		$this->load->model('m_master_order_beli', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_order_beli');
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_order_beli_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_order_beli->detail_detail_order_beli_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_order_beli_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_order_beli->detail_detail_order_beli_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_order_beli->get_master_id();
		echo $result;
	}
	//
	
	//get master id, note: not done yet
	function get_supplier_list(){
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_supplier_list($start,$end);
		echo $result;
	}
	//
	
	//get master id, note: not done yet
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_produk_list($query,$start,$end);
		echo $result;
	}
	//
	
	function get_satuan_list(){
		$result=$this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	//add detail
	function detail_detail_order_beli_insert(){
	//POST variable here
		$dorder_id=trim(@$_POST["dorder_id"]);
		$dorder_master=trim(@$_POST["dorder_master"]);
		$dorder_produk=trim(@$_POST["dorder_produk"]);
		$dorder_satuan=trim(@$_POST["dorder_satuan"]);
		$dorder_jumlah=trim(@$_POST["dorder_jumlah"]);
		$dorder_harga=trim(@$_POST["dorder_harga"]);
		$dorder_diskon=trim(@$_POST["dorder_diskon"]);
		$result=$this->m_master_order_beli->detail_detail_order_beli_insert($dorder_id ,$dorder_master ,$dorder_produk ,$dorder_satuan ,$dorder_jumlah ,$dorder_harga ,$dorder_diskon );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_order_beli_list();
				break;
			case "UPDATE":
				$this->master_order_beli_update();
				break;
			case "CREATE":
				$this->master_order_beli_create();
				break;
			case "DELETE":
				$this->master_order_beli_delete();
				break;
			case "SEARCH":
				$this->master_order_beli_search();
				break;
			case "PRINT":
				$this->master_order_beli_print();
				break;
			case "EXCEL":
				$this->master_order_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_order_beli_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_order_beli->master_order_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_order_beli_update(){
		//POST variable here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace(",", ",",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace(",", ",",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace(",", ",",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$result = $this->m_master_order_beli->master_order_beli_update($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function master_order_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$result=$this->m_master_order_beli->master_order_beli_create($order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_order_beli_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_order_beli->master_order_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_order_beli_search(){
		//POST varibale here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_order_beli->master_order_beli_search($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ,$start,$end);
		echo $result;
	}


	function master_order_beli_print(){
  		//POST varibale here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_order_beli->master_order_beli_print($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=14;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_order_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_order_beli Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_order_beli List'><caption>MASTER_ORDER_BELI</caption><thead><tr><th scope='col'>Order Id</th><th scope='col'>Order No</th><th scope='col'>Order Supplier</th><th scope='col'>Order Tanggal</th><th scope='col'>Order Carabayar</th><th scope='col'>Order Diskon</th><th scope='col'>Order Biaya</th><th scope='col'>Order Bayar</th><th scope='col'>Order Keterangan</th><th scope='col'>Order Creator</th><th scope='col'>Order Date Create</th><th scope='col'>Order Update</th><th scope='col'>Order Date Update</th><th scope='col'>Order Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_order_beli</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['order_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['order_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_supplier']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_carabayar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_biaya']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_bayar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['order_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['order_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['order_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['order_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['order_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_order_beli_export_excel(){
		//POST varibale here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_order_beli->master_order_beli_export_excel($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ,$option,$filter);
		
		to_excel($query,"master_order_beli"); 
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