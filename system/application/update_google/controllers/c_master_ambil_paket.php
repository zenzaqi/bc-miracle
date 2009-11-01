<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_ambil_paket Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_ambil_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 19/Aug/2009 15:30:59
	
*/

//class of master_ambil_paket
class C_master_ambil_paket extends Controller {

	//constructor
	function C_master_ambil_paket(){
		parent::Controller();
		$this->load->model('m_master_ambil_paket', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_ambil_paket');
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_ambil_paket_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_ambil_paket->detail_detail_ambil_paket_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_ambil_paket_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_ambil_paket->detail_detail_ambil_paket_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_ambil_paket->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_ambil_paket_insert(){
	//POST variable here
		$dapaket_id=trim(@$_POST["dapaket_id"]);
		$dapaket_master=trim(@$_POST["dapaket_master"]);
		$dapaket_nama=trim(@$_POST["dapaket_nama"]);
		$dapaket_item=trim(@$_POST["dapaket_item"]);
		$dapaket_item=str_replace("/(<\/?)(p)([^>]*>)", "",$dapaket_item);
		$dapaket_item=str_replace("\\", "",$dapaket_item);
		$dapaket_item=str_replace("'", '"',$dapaket_item);
		$dapaket_jenis=trim(@$_POST["dapaket_jenis"]);
		$dapaket_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$dapaket_jenis);
		$dapaket_jenis=str_replace("\\", "",$dapaket_jenis);
		$dapaket_jenis=str_replace("'", '"',$dapaket_jenis);
		$dapaket_jumlah=trim(@$_POST["dapaket_jumlah"]);
		$dapaket_harga=trim(@$_POST["dapaket_harga"]);
		$result=$this->m_master_ambil_paket->detail_detail_ambil_paket_insert($dapaket_id ,$dapaket_master ,$dapaket_nama ,$dapaket_item ,$dapaket_jenis ,$dapaket_jumlah ,$dapaket_harga );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_ambil_paket_list();
				break;
			case "UPDATE":
				$this->master_ambil_paket_update();
				break;
			case "CREATE":
				$this->master_ambil_paket_create();
				break;
			case "DELETE":
				$this->master_ambil_paket_delete();
				break;
			case "SEARCH":
				$this->master_ambil_paket_search();
				break;
			case "PRINT":
				$this->master_ambil_paket_print();
				break;
			case "EXCEL":
				$this->master_ambil_paket_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_ambil_paket_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_ambil_paket->master_ambil_paket_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_ambil_paket_update(){
		//POST variable here
		$apaket_id=trim(@$_POST["apaket_id"]);
		$apaket_jual=trim(@$_POST["apaket_jual"]);
		$apaket_cust=trim(@$_POST["apaket_cust"]);
		$apaket_tanggal=trim(@$_POST["apaket_tanggal"]);
		$result = $this->m_master_ambil_paket->master_ambil_paket_update($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal      );
		echo $result;
	}
	
	//function for create new record
	function master_ambil_paket_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$apaket_jual=trim(@$_POST["apaket_jual"]);
		$apaket_cust=trim(@$_POST["apaket_cust"]);
		$apaket_tanggal=trim(@$_POST["apaket_tanggal"]);
		$result=$this->m_master_ambil_paket->master_ambil_paket_create($apaket_jual ,$apaket_cust ,$apaket_tanggal );
		echo $result;
	}

	//function for delete selected record
	function master_ambil_paket_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_ambil_paket->master_ambil_paket_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_ambil_paket_search(){
		//POST varibale here
		$apaket_id=trim(@$_POST["apaket_id"]);
		$apaket_jual=trim(@$_POST["apaket_jual"]);
		$apaket_cust=trim(@$_POST["apaket_cust"]);
		$apaket_tanggal=trim(@$_POST["apaket_tanggal"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_ambil_paket->master_ambil_paket_search($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ,$start,$end);
		echo $result;
	}


	function master_ambil_paket_print(){
  		//POST varibale here
		$apaket_id=trim(@$_POST["apaket_id"]);
		$apaket_jual=trim(@$_POST["apaket_jual"]);
		$apaket_cust=trim(@$_POST["apaket_cust"]);
		$apaket_tanggal=trim(@$_POST["apaket_tanggal"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_ambil_paket->master_ambil_paket_print($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=9;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_ambil_paketlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_ambil_paket Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_ambil_paket List'><caption>MASTER_AMBIL_PAKET</caption><thead><tr><th scope='col'>Apaket Id</th><th scope='col'>Apaket Jual</th><th scope='col'>Apaket Cust</th><th scope='col'>Apaket Tanggal</th><th scope='col'>Apaket Creator</th><th scope='col'>Apaket Date Create</th><th scope='col'>Apaket Update</th><th scope='col'>Apaket Date Update</th><th scope='col'>Apaket Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_ambil_paket</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['apaket_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['apaket_jual']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['apaket_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['apaket_tanggal']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['apaket_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['apaket_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['apaket_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['apaket_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['apaket_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_ambil_paket_export_excel(){
		//POST varibale here
		$apaket_id=trim(@$_POST["apaket_id"]);
		$apaket_jual=trim(@$_POST["apaket_jual"]);
		$apaket_cust=trim(@$_POST["apaket_cust"]);
		$apaket_tanggal=trim(@$_POST["apaket_tanggal"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_ambil_paket->master_ambil_paket_export_excel($apaket_id ,$apaket_jual ,$apaket_cust ,$apaket_tanggal ,$option,$filter);
		
		to_excel($query,"master_ambil_paket"); 
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