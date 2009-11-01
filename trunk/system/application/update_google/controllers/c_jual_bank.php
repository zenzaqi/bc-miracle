<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jual_bank Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jual_bank.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of jual_bank
class C_jual_bank extends Controller {

	//constructor
	function C_jual_bank(){
		parent::Controller();
		$this->load->model('m_jual_bank', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_jual_bank');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jual_bank_list();
				break;
			case "UPDATE":
				$this->jual_bank_update();
				break;
			case "CREATE":
				$this->jual_bank_create();
				break;
			case "DELETE":
				$this->jual_bank_delete();
				break;
			case "SEARCH":
				$this->jual_bank_search();
				break;
			case "PRINT":
				$this->jual_bank_print();
				break;
			case "EXCEL":
				$this->jual_bank_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jual_bank_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_jual_bank->jual_bank_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jual_bank_update(){
		//POST variable here
		$jbank_nobukti=trim(@$_POST["jbank_nobukti"]);
		$jbank_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_nobukti);
		$jbank_nobukti=str_replace("'", '"',$jbank_nobukti);
		$jbank_tanggal=trim(@$_POST["jbank_tanggal"]);
		$jbank_bank=trim(@$_POST["jbank_bank"]);
		$jbank_bank=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_bank);
		$jbank_bank=str_replace("'", '"',$jbank_bank);
		$jbank_no=trim(@$_POST["jbank_no"]);
		$jbank_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_no);
		$jbank_no=str_replace("'", '"',$jbank_no);
		$jbank_nilai=trim(@$_POST["jbank_nilai"]);
		$jbank_trans=trim(@$_POST["jbank_trans"]);
		$jbank_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_trans);
		$jbank_trans=str_replace("'", '"',$jbank_trans);
		$jbank_creator=trim(@$_POST["jbank_creator"]);
		$jbank_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_creator);
		$jbank_creator=str_replace("'", '"',$jbank_creator);
		$jbank_date_create=trim(@$_POST["jbank_date_create"]);
		$jbank_update=trim(@$_POST["jbank_update"]);
		$jbank_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_update);
		$jbank_update=str_replace("'", '"',$jbank_update);
		$jbank_date_update=trim(@$_POST["jbank_date_update"]);
		$jbank_revised=trim(@$_POST["jbank_revised"]);
		$result = $this->m_jual_bank->jual_bank_update($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised );
		echo $result;
	}
	
	//function for create new record
	function jual_bank_create(){
		//POST varible here
		$jbank_nobukti=trim(@$_POST["jbank_nobukti"]);
		$jbank_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_nobukti);
		$jbank_nobukti=str_replace("'", '"',$jbank_nobukti);
		$jbank_tanggal=trim(@$_POST["jbank_tanggal"]);
		$jbank_bank=trim(@$_POST["jbank_bank"]);
		$jbank_bank=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_bank);
		$jbank_bank=str_replace("'", '"',$jbank_bank);
		$jbank_no=trim(@$_POST["jbank_no"]);
		$jbank_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_no);
		$jbank_no=str_replace("'", '"',$jbank_no);
		$jbank_nilai=trim(@$_POST["jbank_nilai"]);
		$jbank_trans=trim(@$_POST["jbank_trans"]);
		$jbank_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_trans);
		$jbank_trans=str_replace("'", '"',$jbank_trans);
		$jbank_creator=trim(@$_POST["jbank_creator"]);
		$jbank_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_creator);
		$jbank_creator=str_replace("'", '"',$jbank_creator);
		$jbank_date_create=trim(@$_POST["jbank_date_create"]);
		$jbank_update=trim(@$_POST["jbank_update"]);
		$jbank_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_update);
		$jbank_update=str_replace("'", '"',$jbank_update);
		$jbank_date_update=trim(@$_POST["jbank_date_update"]);
		$jbank_revised=trim(@$_POST["jbank_revised"]);
		$result=$this->m_jual_bank->jual_bank_create($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised );
		echo $result;
	}

	//function for delete selected record
	function jual_bank_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jual_bank->jual_bank_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jual_bank_search(){
		//POST varibale here
		$jbank_nobukti=trim(@$_POST["jbank_nobukti"]);
		$jbank_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_nobukti);
		$jbank_nobukti=str_replace("'", '"',$jbank_nobukti);
		$jbank_tanggal=trim(@$_POST["jbank_tanggal"]);
		$jbank_bank=trim(@$_POST["jbank_bank"]);
		$jbank_bank=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_bank);
		$jbank_bank=str_replace("'", '"',$jbank_bank);
		$jbank_no=trim(@$_POST["jbank_no"]);
		$jbank_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_no);
		$jbank_no=str_replace("'", '"',$jbank_no);
		$jbank_nilai=trim(@$_POST["jbank_nilai"]);
		$jbank_trans=trim(@$_POST["jbank_trans"]);
		$jbank_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_trans);
		$jbank_trans=str_replace("'", '"',$jbank_trans);
		$jbank_creator=trim(@$_POST["jbank_creator"]);
		$jbank_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_creator);
		$jbank_creator=str_replace("'", '"',$jbank_creator);
		$jbank_date_create=trim(@$_POST["jbank_date_create"]);
		$jbank_update=trim(@$_POST["jbank_update"]);
		$jbank_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_update);
		$jbank_update=str_replace("'", '"',$jbank_update);
		$jbank_date_update=trim(@$_POST["jbank_date_update"]);
		$jbank_revised=trim(@$_POST["jbank_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jual_bank->jual_bank_search($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ,$start,$end);
		echo $result;
	}


	function jual_bank_print(){
  		//POST varibale here
		$jbank_nobukti=trim(@$_POST["jbank_nobukti"]);
		$jbank_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_nobukti);
		$jbank_nobukti=str_replace("'", '"',$jbank_nobukti);
		$jbank_tanggal=trim(@$_POST["jbank_tanggal"]);
		$jbank_bank=trim(@$_POST["jbank_bank"]);
		$jbank_bank=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_bank);
		$jbank_bank=str_replace("'", '"',$jbank_bank);
		$jbank_no=trim(@$_POST["jbank_no"]);
		$jbank_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_no);
		$jbank_no=str_replace("'", '"',$jbank_no);
		$jbank_nilai=trim(@$_POST["jbank_nilai"]);
		$jbank_trans=trim(@$_POST["jbank_trans"]);
		$jbank_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_trans);
		$jbank_trans=str_replace("'", '"',$jbank_trans);
		$jbank_creator=trim(@$_POST["jbank_creator"]);
		$jbank_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_creator);
		$jbank_creator=str_replace("'", '"',$jbank_creator);
		$jbank_date_create=trim(@$_POST["jbank_date_create"]);
		$jbank_update=trim(@$_POST["jbank_update"]);
		$jbank_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_update);
		$jbank_update=str_replace("'", '"',$jbank_update);
		$jbank_date_update=trim(@$_POST["jbank_date_update"]);
		$jbank_revised=trim(@$_POST["jbank_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jual_bank->jual_bank_print($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jual_banklist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jual_bank Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jual_bank List'><caption>JUAL_BANK</caption><thead><tr><th scope='col'>Jbank Nobukti</th><th scope='col'>Jbank Tanggal</th><th scope='col'>Jbank Bank</th><th scope='col'>Jbank No</th><th scope='col'>Jbank Nilai</th><th scope='col'>Jbank Trans</th><th scope='col'>Jbank Creator</th><th scope='col'>Jbank Date Create</th><th scope='col'>Jbank Update</th><th scope='col'>Jbank Date Update</th><th scope='col'>Jbank Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jual_bank</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jbank_nobukti']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jbank_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_bank']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_trans']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_date_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jbank_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jual_bank_export_excel(){
		//POST varibale here
		$jbank_nobukti=trim(@$_POST["jbank_nobukti"]);
		$jbank_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_nobukti);
		$jbank_nobukti=str_replace("'", '"',$jbank_nobukti);
		$jbank_tanggal=trim(@$_POST["jbank_tanggal"]);
		$jbank_bank=trim(@$_POST["jbank_bank"]);
		$jbank_bank=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_bank);
		$jbank_bank=str_replace("'", '"',$jbank_bank);
		$jbank_no=trim(@$_POST["jbank_no"]);
		$jbank_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_no);
		$jbank_no=str_replace("'", '"',$jbank_no);
		$jbank_nilai=trim(@$_POST["jbank_nilai"]);
		$jbank_trans=trim(@$_POST["jbank_trans"]);
		$jbank_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_trans);
		$jbank_trans=str_replace("'", '"',$jbank_trans);
		$jbank_creator=trim(@$_POST["jbank_creator"]);
		$jbank_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_creator);
		$jbank_creator=str_replace("'", '"',$jbank_creator);
		$jbank_date_create=trim(@$_POST["jbank_date_create"]);
		$jbank_update=trim(@$_POST["jbank_update"]);
		$jbank_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jbank_update);
		$jbank_update=str_replace("'", '"',$jbank_update);
		$jbank_date_update=trim(@$_POST["jbank_date_update"]);
		$jbank_revised=trim(@$_POST["jbank_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jual_bank->jual_bank_export_excel($jbank_nobukti ,$jbank_tanggal ,$jbank_bank ,$jbank_no ,$jbank_nilai ,$jbank_trans ,$jbank_creator ,$jbank_date_create ,$jbank_update ,$jbank_date_update ,$jbank_revised ,$option,$filter);
		
		to_excel($query,"jual_bank"); 
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