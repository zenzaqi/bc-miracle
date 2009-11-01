<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: buku_besar Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_buku_besar.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:51:08
	
*/

//class of buku_besar
class C_buku_besar extends Controller {

	//constructor
	function C_buku_besar(){
		parent::Controller();
		$this->load->model('m_buku_besar', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_buku_besar');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->buku_besar_list();
				break;
			case "UPDATE":
				$this->buku_besar_update();
				break;
			case "CREATE":
				$this->buku_besar_create();
				break;
			case "DELETE":
				$this->buku_besar_delete();
				break;
			case "SEARCH":
				$this->buku_besar_search();
				break;
			case "PRINT":
				$this->buku_besar_print();
				break;
			case "EXCEL":
				$this->buku_besar_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function buku_besar_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_buku_besar->buku_besar_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function buku_besar_update(){
		//POST variable here
		$buku_id=trim(@$_POST["buku_id"]);
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		$result = $this->m_buku_besar->buku_besar_update($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit      );
		echo $result;
	}
	
	//function for create new record
	function buku_besar_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		$result=$this->m_buku_besar->buku_besar_create($buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit );
		echo $result;
	}

	//function for delete selected record
	function buku_besar_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_buku_besar->buku_besar_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function buku_besar_search(){
		//POST varibale here
		$buku_id=trim(@$_POST["buku_id"]);
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_buku_besar->buku_besar_search($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$start,$end);
		echo $result;
	}


	function buku_besar_print(){
  		//POST varibale here
		$buku_id=trim(@$_POST["buku_id"]);
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_buku_besar->buku_besar_print($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=12;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("buku_besarlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Buku_besar Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Buku_besar List'><caption>BUKU_BESAR</caption><thead><tr><th scope='col'>Buku Id</th><th scope='col'>Buku Tanggal</th><th scope='col'>Buku Akun</th><th scope='col'>Buku Debet</th><th scope='col'>Buku Kredit</th><th scope='col'>Buku Saldo Debet</th><th scope='col'>Buku Saldo Kredit</th><th scope='col'>Buku Creator</th><th scope='col'>Buku Date Create</th><th scope='col'>Buku Update</th><th scope='col'>Buku Date Update</th><th scope='col'>Buku Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Buku_besar</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['buku_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['buku_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['buku_akun']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['buku_debet']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['buku_kredit']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['buku_saldo_debet']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['buku_saldo_kredit']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['buku_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['buku_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['buku_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['buku_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['buku_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function buku_besar_export_excel(){
		//POST varibale here
		$buku_id=trim(@$_POST["buku_id"]);
		$buku_tanggal=trim(@$_POST["buku_tanggal"]);
		$buku_akun=trim(@$_POST["buku_akun"]);
		$buku_debet=trim(@$_POST["buku_debet"]);
		$buku_kredit=trim(@$_POST["buku_kredit"]);
		$buku_saldo_debet=trim(@$_POST["buku_saldo_debet"]);
		$buku_saldo_kredit=trim(@$_POST["buku_saldo_kredit"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_buku_besar->buku_besar_export_excel($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter);
		
		to_excel($query,"buku_besar"); 
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