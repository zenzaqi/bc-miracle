<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: voucher_terima Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_voucher_terima.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:52
	
*/

//class of voucher_terima
class C_voucher_terima extends Controller {

	//constructor
	function C_voucher_terima(){
		parent::Controller();
		$this->load->model('m_voucher_terima', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_voucher_terima');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->voucher_terima_list();
				break;
			case "UPDATE":
				$this->voucher_terima_update();
				break;
			case "CREATE":
				$this->voucher_terima_create();
				break;
			case "DELETE":
				$this->voucher_terima_delete();
				break;
			case "SEARCH":
				$this->voucher_terima_search();
				break;
			case "PRINT":
				$this->voucher_terima_print();
				break;
			case "EXCEL":
				$this->voucher_terima_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function voucher_terima_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_voucher_terima->voucher_terima_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function voucher_terima_update(){
		//POST variable here
		$tvoucher_id=trim(@$_POST["tvoucher_id"]);
		$tvoucher_cust=trim(@$_POST["tvoucher_cust"]);
		$tvoucher_voucher=trim(@$_POST["tvoucher_voucher"]);
		$result = $this->m_voucher_terima->voucher_terima_update($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher      );
		echo $result;
	}
	
	//function for create new record
	function voucher_terima_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$tvoucher_cust=trim(@$_POST["tvoucher_cust"]);
		$tvoucher_voucher=trim(@$_POST["tvoucher_voucher"]);
		$result=$this->m_voucher_terima->voucher_terima_create($tvoucher_cust ,$tvoucher_voucher );
		echo $result;
	}

	//function for delete selected record
	function voucher_terima_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_voucher_terima->voucher_terima_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function voucher_terima_search(){
		//POST varibale here
		$tvoucher_id=trim(@$_POST["tvoucher_id"]);
		$tvoucher_cust=trim(@$_POST["tvoucher_cust"]);
		$tvoucher_voucher=trim(@$_POST["tvoucher_voucher"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_voucher_terima->voucher_terima_search($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ,$start,$end);
		echo $result;
	}


	function voucher_terima_print(){
  		//POST varibale here
		$tvoucher_id=trim(@$_POST["tvoucher_id"]);
		$tvoucher_cust=trim(@$_POST["tvoucher_cust"]);
		$tvoucher_voucher=trim(@$_POST["tvoucher_voucher"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_voucher_terima->voucher_terima_print($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("voucher_terimalist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Voucher_terima Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Voucher_terima List'><caption>VOUCHER_TERIMA</caption><thead><tr><th scope='col'>Tvoucher Id</th><th scope='col'>Tvoucher Cust</th><th scope='col'>Tvoucher Voucher</th><th scope='col'>Tvoucher Creator</th><th scope='col'>Tvoucher Date Create</th><th scope='col'>Tvoucher Update</th><th scope='col'>Tvoucher Date Update</th><th scope='col'>Tvoucher Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Voucher_terima</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['tvoucher_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['tvoucher_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['tvoucher_voucher']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['tvoucher_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['tvoucher_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['tvoucher_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['tvoucher_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['tvoucher_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function voucher_terima_export_excel(){
		//POST varibale here
		$tvoucher_id=trim(@$_POST["tvoucher_id"]);
		$tvoucher_cust=trim(@$_POST["tvoucher_cust"]);
		$tvoucher_voucher=trim(@$_POST["tvoucher_voucher"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_voucher_terima->voucher_terima_export_excel($tvoucher_id ,$tvoucher_cust ,$tvoucher_voucher ,$option,$filter);
		
		to_excel($query,"voucher_terima"); 
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