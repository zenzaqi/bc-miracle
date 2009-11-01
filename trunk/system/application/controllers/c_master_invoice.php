<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_invoice Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_invoice.php
 	+ Author  		: 
 	+ Created on 13/Oct/2009 15:51:36
	
*/

//class of master_invoice
class C_master_invoice extends Controller {

	//constructor
	function C_master_invoice(){
		parent::Controller();
		$this->load->model('m_master_invoice', '', TRUE);
	}
	
	function get_satuan_list(){
		$result=$this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	function get_produk_list(){
		$result=$this->m_public_function->get_produk_list();
		echo $result;
	}
	
	function get_tbeli_list(){
		$result=$this->m_master_invoice->get_tbeli_list();
		echo $result;
	}
	
	function get_dtbeli_list(){
		$dterima_master = (integer) (isset($_POST['master']) ? $_POST['master'] : $_GET['master']);
		$result=$this->m_master_invoice->get_dtbeli_list($dterima_master);
		echo $result;
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->helper('asset');
		$this->load->view('main/v_master_invoice');
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_invoice_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_invoice->detail_detail_invoice_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_invoice_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_invoice->detail_detail_invoice_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_invoice->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_invoice_insert(){
	//POST variable here
		$dinvoice_id=trim(@$_POST["dinvoice_id"]);
		$dinvoice_master=trim(@$_POST["dinvoice_master"]);
		$dinvoice_produk=trim(@$_POST["dinvoice_produk"]);
		$dinvoice_satuan=trim(@$_POST["dinvoice_satuan"]);
		$dinvoice_jumlah=trim(@$_POST["dinvoice_jumlah"]);
		$dinvoice_harga=trim(@$_POST["dinvoice_harga"]);
		$dinvoice_diskon=trim(@$_POST["dinvoice_diskon"]);
		$result=$this->m_master_invoice->detail_detail_invoice_insert($dinvoice_id ,$dinvoice_master ,$dinvoice_produk ,$dinvoice_satuan ,$dinvoice_jumlah ,$dinvoice_harga ,$dinvoice_diskon );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_invoice_list();
				break;
			case "UPDATE":
				$this->master_invoice_update();
				break;
			case "CREATE":
				$this->master_invoice_create();
				break;
			case "DELETE":
				$this->master_invoice_delete();
				break;
			case "SEARCH":
				$this->master_invoice_search();
				break;
			case "PRINT":
				$this->master_invoice_print();
				break;
			case "EXCEL":
				$this->master_invoice_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_invoice_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_invoice->master_invoice_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_invoice_update(){
		//POST variable here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace(",", ",",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noterima=trim(@$_POST["invoice_noterima"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$invoice_penagih=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_penagih);
		$invoice_penagih=str_replace(",", ",",$invoice_penagih);
		$invoice_penagih=str_replace("'", '"',$invoice_penagih);
		$result = $this->m_master_invoice->master_invoice_update($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih      );
		echo $result;
	}
	
	//function for create new record
	function master_invoice_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noterima=trim(@$_POST["invoice_noterima"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$invoice_penagih=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_penagih);
		$invoice_penagih=str_replace("'", '"',$invoice_penagih);
		$result=$this->m_master_invoice->master_invoice_create($invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih );
		echo $result;
	}

	//function for delete selected record
	function master_invoice_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_invoice->master_invoice_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_invoice_search(){
		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noterima=trim(@$_POST["invoice_noterima"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$invoice_penagih=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_penagih);
		$invoice_penagih=str_replace("'", '"',$invoice_penagih);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_invoice->master_invoice_search($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$start,$end);
		echo $result;
	}


	function master_invoice_print(){
  		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noterima=trim(@$_POST["invoice_noterima"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$invoice_penagih=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_penagih);
		$invoice_penagih=str_replace("'", '"',$invoice_penagih);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_invoice->master_invoice_print($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=13;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_invoicelist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_invoice Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_invoice List'><caption>MASTER_INVOICE</caption><thead><tr><th scope='col'>Invoice Id</th><th scope='col'>Invoice No</th><th scope='col'>Invoice Supplier</th><th scope='col'>Invoice Noterima</th><th scope='col'>Invoice Tanggal</th><th scope='col'>Invoice Nilai</th><th scope='col'>Invoice Jatuhtempo</th><th scope='col'>Invoice Penagih</th><th scope='col'>Invoice Creator</th><th scope='col'>Invoice Date Create</th><th scope='col'>Invoice Update</th><th scope='col'>Invoice Date Update</th><th scope='col'>Invoice Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_invoice</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['invoice_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['invoice_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_supplier']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_noterima']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_jatuhtempo']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_penagih']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['invoice_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['invoice_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['invoice_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['invoice_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['invoice_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_invoice_export_excel(){
		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noterima=trim(@$_POST["invoice_noterima"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$invoice_penagih=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_penagih);
		$invoice_penagih=str_replace("'", '"',$invoice_penagih);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_invoice->master_invoice_export_excel($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter);
		
		to_excel($query,"master_invoice"); 
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