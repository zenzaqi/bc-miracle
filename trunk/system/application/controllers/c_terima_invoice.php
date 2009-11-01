<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: terima_invoice Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_terima_invoice.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:49:52
	
*/

//class of terima_invoice
class C_terima_invoice extends Controller {

	//constructor
	function C_terima_invoice(){
		parent::Controller();
		$this->load->model('m_terima_invoice', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_terima_invoice');
	}
	
	function get_supplier_list(){
		$result=$this->m_public_function->get_supplier_list();
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->terima_invoice_list();
				break;
			case "UPDATE":
				$this->terima_invoice_update();
				break;
			case "CREATE":
				$this->terima_invoice_create();
				break;
			case "DELETE":
				$this->terima_invoice_delete();
				break;
			case "SEARCH":
				$this->terima_invoice_search();
				break;
			case "PRINT":
				$this->terima_invoice_print();
				break;
			case "EXCEL":
				$this->terima_invoice_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function terima_invoice_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_terima_invoice->terima_invoice_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function terima_invoice_update(){
		//POST variable here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace(",", ",",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_suratjalan=trim(@$_POST["invoice_suratjalan"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$result = $this->m_terima_invoice->terima_invoice_update($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih );
		echo $result;
	}
	
	//function for create new record
	function terima_invoice_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_suratjalan=trim(@$_POST["invoice_suratjalan"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$result=$this->m_terima_invoice->terima_invoice_create($invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih );
		echo $result;
	}

	//function for delete selected record
	function terima_invoice_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_terima_invoice->terima_invoice_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function terima_invoice_search(){
		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_suratjalan=trim(@$_POST["invoice_suratjalan"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_terima_invoice->terima_invoice_search($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$start,$end);
		echo $result;
	}


	function terima_invoice_print(){
  		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_suratjalan=trim(@$_POST["invoice_suratjalan"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_terima_invoice->terima_invoice_print($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=12;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("terima_invoicelist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Terima_invoice Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Terima_invoice List'><caption>TERIMA_INVOICE</caption><thead><tr><th scope='col'>Invoice Id</th><th scope='col'>Invoice No</th><th scope='col'>Invoice Supplier</th><th scope='col'>Invoice Noorder</th><th scope='col'>Invoice Surat Jalan</th><th scope='col'>Invoice Tanggal</th><th scope='col'>Invoice Nilai</th><th scope='col'>Invoice Jatuhtempo</th><th scope='col'>Invoice Penagih</th><th scope='col'>Invoice Creator</th><th scope='col'>Invoice Date Create</th><th scope='col'>Invoice Update</th><th scope='col'>Invoice Date Update</th><th scope='col'>Invoice Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Terima_invoice</td></tr></tfoot><tbody>");
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
				fwrite($file, $data['invoice_noorder']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_suratjalan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_jatuhtempo']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['invoice_penagih']);
				fwrite($file,"</td><td>");
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
	function terima_invoice_export_excel(){
		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_suratjalan=trim(@$_POST["invoice_suratjalan"]);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$invoice_jatuhtempo=trim(@$_POST["invoice_jatuhtempo"]);
		$invoice_penagih=trim(@$_POST["invoice_penagih"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_terima_invoice->terima_invoice_export_excel($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter);
		
		to_excel($query,"terima_invoice"); 
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