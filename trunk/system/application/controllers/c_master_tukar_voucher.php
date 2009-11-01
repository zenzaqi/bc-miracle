<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_tukar_voucher Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_tukar_voucher.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of master_tukar_voucher
class C_master_tukar_voucher extends Controller {

	//constructor
	function C_master_tukar_voucher(){
		parent::Controller();
		$this->load->model('m_master_tukar_voucher', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_tukar_voucher');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_tukar_voucher_list();
				break;
			case "UPDATE":
				$this->master_tukar_voucher_update();
				break;
			case "CREATE":
				$this->master_tukar_voucher_create();
				break;
			case "DELETE":
				$this->master_tukar_voucher_delete();
				break;
			case "SEARCH":
				$this->master_tukar_voucher_search();
				break;
			case "PRINT":
				$this->master_tukar_voucher_print();
				break;
			case "EXCEL":
				$this->master_tukar_voucher_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_tukar_voucher_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_master_tukar_voucher->master_tukar_voucher_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_tukar_voucher_update(){
		//POST variable here
		$avoucher_id=trim(@$_POST["avoucher_id"]);
		$avoucher_cust=trim(@$_POST["avoucher_cust"]);
		$avoucher_tanggal=trim(@$_POST["avoucher_tanggal"]);
		$avoucher_kasir=trim(@$_POST["avoucher_kasir"]);
		$avoucher_novoucher=trim(@$_POST["avoucher_novoucher"]);
		$avoucher_novoucher=str_replace("/(<\/?)(p)([^>]*>)", "",$avoucher_novoucher);
		$avoucher_novoucher=str_replace("'", '"',$avoucher_novoucher);
		$result = $this->m_master_tukar_voucher->master_tukar_voucher_update($avoucher_id ,$avoucher_cust ,$avoucher_tanggal ,$avoucher_kasir ,$avoucher_novoucher );
		echo $result;
	}
	
	//function for create new record
	function master_tukar_voucher_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$avoucher_cust=trim(@$_POST["avoucher_cust"]);
		$avoucher_tanggal=trim(@$_POST["avoucher_tanggal"]);
		$avoucher_kasir=trim(@$_POST["avoucher_kasir"]);
		$avoucher_novoucher=trim(@$_POST["avoucher_novoucher"]);
		$avoucher_novoucher=str_replace("/(<\/?)(p)([^>]*>)", "",$avoucher_novoucher);
		$avoucher_novoucher=str_replace("'", '"',$avoucher_novoucher);
		$result=$this->m_master_tukar_voucher->master_tukar_voucher_create($avoucher_cust ,$avoucher_tanggal ,$avoucher_kasir ,$avoucher_novoucher );
		echo $result;
	}

	//function for delete selected record
	function master_tukar_voucher_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_tukar_voucher->master_tukar_voucher_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_tukar_voucher_search(){
		//POST varibale here
		$avoucher_id=trim(@$_POST["avoucher_id"]);
		$avoucher_cust=trim(@$_POST["avoucher_cust"]);
		$avoucher_tanggal=trim(@$_POST["avoucher_tanggal"]);
		$avoucher_kasir=trim(@$_POST["avoucher_kasir"]);
		$avoucher_novoucher=trim(@$_POST["avoucher_novoucher"]);
		$avoucher_novoucher=str_replace("/(<\/?)(p)([^>]*>)", "",$avoucher_novoucher);
		$avoucher_novoucher=str_replace("'", '"',$avoucher_novoucher);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_tukar_voucher->master_tukar_voucher_search($avoucher_id ,$avoucher_cust ,$avoucher_tanggal ,$avoucher_kasir ,$avoucher_novoucher ,$start,$end);
		echo $result;
	}


	function master_tukar_voucher_print(){
  		//POST varibale here
		$avoucher_id=trim(@$_POST["avoucher_id"]);
		$avoucher_cust=trim(@$_POST["avoucher_cust"]);
		$avoucher_tanggal=trim(@$_POST["avoucher_tanggal"]);
		$avoucher_kasir=trim(@$_POST["avoucher_kasir"]);
		$avoucher_novoucher=trim(@$_POST["avoucher_novoucher"]);
		$avoucher_novoucher=str_replace("/(<\/?)(p)([^>]*>)", "",$avoucher_novoucher);
		$avoucher_novoucher=str_replace("'", '"',$avoucher_novoucher);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_tukar_voucher->master_tukar_voucher_print($avoucher_id ,$avoucher_cust ,$avoucher_tanggal ,$avoucher_kasir ,$avoucher_novoucher ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=5;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_tukar_voucherlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_tukar_voucher Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_tukar_voucher List'><caption>MASTER_TUKAR_VOUCHER</caption><thead><tr><th scope='col'>Avoucher Id</th><th scope='col'>Avoucher Cust</th><th scope='col'>Avoucher Tanggal</th><th scope='col'>Avoucher Kasir</th><th scope='col'>Avoucher Novoucher</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_tukar_voucher</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['avoucher_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['avoucher_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['avoucher_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['avoucher_kasir']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['avoucher_novoucher']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_tukar_voucher_export_excel(){
		//POST varibale here
		$avoucher_id=trim(@$_POST["avoucher_id"]);
		$avoucher_cust=trim(@$_POST["avoucher_cust"]);
		$avoucher_tanggal=trim(@$_POST["avoucher_tanggal"]);
		$avoucher_kasir=trim(@$_POST["avoucher_kasir"]);
		$avoucher_novoucher=trim(@$_POST["avoucher_novoucher"]);
		$avoucher_novoucher=str_replace("/(<\/?)(p)([^>]*>)", "",$avoucher_novoucher);
		$avoucher_novoucher=str_replace("'", '"',$avoucher_novoucher);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_tukar_voucher->master_tukar_voucher_export_excel($avoucher_id ,$avoucher_cust ,$avoucher_tanggal ,$avoucher_kasir ,$avoucher_novoucher ,$option,$filter);
		
		to_excel($query,"master_tukar_voucher"); 
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