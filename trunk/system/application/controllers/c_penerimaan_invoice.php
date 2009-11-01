<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: penerimaan_invoice Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_penerimaan_invoice.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of penerimaan_invoice
class C_penerimaan_invoice extends Controller {

	//constructor
	function C_penerimaan_invoice(){
		parent::Controller();
		$this->load->model('m_penerimaan_invoice', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_penerimaan_invoice');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->penerimaan_invoice_list();
				break;
			case "UPDATE":
				$this->penerimaan_invoice_update();
				break;
			case "CREATE":
				$this->penerimaan_invoice_create();
				break;
			case "DELETE":
				$this->penerimaan_invoice_delete();
				break;
			case "SEARCH":
				$this->penerimaan_invoice_search();
				break;
			case "PRINT":
				$this->penerimaan_invoice_print();
				break;
			case "EXCEL":
				$this->penerimaan_invoice_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function penerimaan_invoice_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_penerimaan_invoice->penerimaan_invoice_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function penerimaan_invoice_update(){
		//POST variable here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_noorder=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_noorder);
		$invoice_noorder=str_replace("'", '"',$invoice_noorder);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$result = $this->m_penerimaan_invoice->penerimaan_invoice_update($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_tanggal ,$invoice_nilai );
		echo $result;
	}
	
	//function for create new record
	function penerimaan_invoice_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_noorder=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_noorder);
		$invoice_noorder=str_replace("'", '"',$invoice_noorder);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$result=$this->m_penerimaan_invoice->penerimaan_invoice_create($invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_tanggal ,$invoice_nilai );
		echo $result;
	}

	//function for delete selected record
	function penerimaan_invoice_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_penerimaan_invoice->penerimaan_invoice_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function penerimaan_invoice_search(){
		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_noorder=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_noorder);
		$invoice_noorder=str_replace("'", '"',$invoice_noorder);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_penerimaan_invoice->penerimaan_invoice_search($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_tanggal ,$invoice_nilai ,$start,$end);
		echo $result;
	}


	function penerimaan_invoice_print(){
  		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_noorder=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_noorder);
		$invoice_noorder=str_replace("'", '"',$invoice_noorder);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_penerimaan_invoice->penerimaan_invoice_print($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_tanggal ,$invoice_nilai ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=6;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("penerimaan_invoicelist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Penerimaan_invoice Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Penerimaan_invoice List'><caption>PENERIMAAN_INVOICE</caption><thead><tr><th scope='col'>Invoice Id</th><th scope='col'>Invoice No</th><th scope='col'>Invoice Supplier</th><th scope='col'>Invoice Noorder</th><th scope='col'>Invoice Tanggal</th><th scope='col'>Invoice Nilai</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Penerimaan_invoice</td></tr></tfoot><tbody>");
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
				fwrite($file, $data['invoice_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['invoice_nilai']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function penerimaan_invoice_export_excel(){
		//POST varibale here
		$invoice_id=trim(@$_POST["invoice_id"]);
		$invoice_no=trim(@$_POST["invoice_no"]);
		$invoice_no=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_no);
		$invoice_no=str_replace("'", '"',$invoice_no);
		$invoice_supplier=trim(@$_POST["invoice_supplier"]);
		$invoice_noorder=trim(@$_POST["invoice_noorder"]);
		$invoice_noorder=str_replace("/(<\/?)(p)([^>]*>)", "",$invoice_noorder);
		$invoice_noorder=str_replace("'", '"',$invoice_noorder);
		$invoice_tanggal=trim(@$_POST["invoice_tanggal"]);
		$invoice_nilai=trim(@$_POST["invoice_nilai"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_penerimaan_invoice->penerimaan_invoice_export_excel($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_tanggal ,$invoice_nilai ,$option,$filter);
		
		to_excel($query,"penerimaan_invoice"); 
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
	
	// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
	function codeDate ($date) {
	  $tab = explode ("-", $date);
	  $r = $tab[1]."/".$tab[2]."/".$tab[0];
	  return $r;
	}
	
}
?>