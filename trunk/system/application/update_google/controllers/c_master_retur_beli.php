<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_retur_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_retur_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:32
	
*/

//class of master_retur_beli
class C_master_retur_beli extends Controller {

	//constructor
	function C_master_retur_beli(){
		parent::Controller();
		$this->load->model('m_master_retur_beli', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_retur_beli');
	}
	
	function get_terima_beli_list(){
		$result=$this->m_master_retur_beli->get_terima_beli_list();
		echo $result;
	}
	
	function get_supplier_list(){
		$result=$this->m_public_function->get_supplier_list();
		echo $result;
	}
	
	function get_drbeli_by_terimabeli(){
		$terima_id = trim(@$_POST["master_terima_id"]);
		$result=$this->m_master_retur_beli->get_drbeli_by_terimabeli($terima_id);
		echo $result;
	}
	
	function get_satuan_by_produkid(){
		$dterima_master = trim(@$_POST["dterima_master"]);
		$dterima_produk = trim(@$_POST["dterima_produk"]);
		$result=$this->m_master_retur_beli->get_satuan_by_produkid($dterima_master, $dterima_produk);
		echo $result;
	}
	
	function get_harga_on_order(){
		$dorder_master= trim(@$_POST["dorder_master"]);
		$dorder_produk= trim(@$_POST["dorder_produk"]);
		$dorder_satuan= trim(@$_POST["dorder_satuan"]);
		$result=$this->m_master_retur_beli->get_harga_on_order($dorder_master, $dorder_produk, $dorder_satuan);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_retur_beli_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_beli->detail_detail_retur_beli_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_retur_beli_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_beli->detail_detail_retur_beli_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_retur_beli->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_retur_beli_insert(){
	//POST variable here
		$drbeli_id=trim(@$_POST["drbeli_id"]);
		$drbeli_master=trim(@$_POST["drbeli_master"]);
		$drbeli_produk=trim(@$_POST["drbeli_produk"]);
		$drbeli_satuan=trim(@$_POST["drbeli_satuan"]);
		$drbeli_jumlah=trim(@$_POST["drbeli_jumlah"]);
		$drbeli_harga=trim(@$_POST["drbeli_harga"]);
		$result=$this->m_master_retur_beli->detail_detail_retur_beli_insert($drbeli_id ,$drbeli_master ,$drbeli_produk ,$drbeli_satuan ,$drbeli_jumlah ,$drbeli_harga );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_retur_beli_list();
				break;
			case "UPDATE":
				$this->master_retur_beli_update();
				break;
			case "CREATE":
				$this->master_retur_beli_create();
				break;
			case "DELETE":
				$this->master_retur_beli_delete();
				break;
			case "SEARCH":
				$this->master_retur_beli_search();
				break;
			case "PRINT":
				$this->master_retur_beli_print();
				break;
			case "EXCEL":
				$this->master_retur_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_retur_beli_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_retur_beli->master_retur_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_retur_beli_update(){
		//POST variable here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace(",", ",",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		$result = $this->m_master_retur_beli->master_retur_beli_update($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function master_retur_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		$result=$this->m_master_retur_beli->master_retur_beli_create($rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_retur_beli_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_retur_beli->master_retur_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_retur_beli_search(){
		//POST varibale here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_retur_beli->master_retur_beli_search($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$start,$end);
		echo $result;
	}


	function master_retur_beli_print(){
  		//POST varibale here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_retur_beli->master_retur_beli_print($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_retur_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_retur_beli Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_retur_beli List'><caption>MASTER_RETUR_BELI</caption><thead><tr><th scope='col'>Rbeli Id</th><th scope='col'>Rbeli Nobukti</th><th scope='col'>Rbeli Terima</th><th scope='col'>Rbeli Supplier</th><th scope='col'>Rbeli Tanggal</th><th scope='col'>Rbeli Keterangan</th><th scope='col'>Rbeli Creator</th><th scope='col'>Rbeli Date Create</th><th scope='col'>Rbeli Update</th><th scope='col'>Rbeli Date Update</th><th scope='col'>Rbeli Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_retur_beli</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['rbeli_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['rbeli_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rbeli_terima']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rbeli_supplier']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rbeli_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rbeli_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rbeli_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rbeli_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rbeli_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rbeli_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rbeli_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_retur_beli_export_excel(){
		//POST varibale here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_retur_beli->master_retur_beli_export_excel($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$option,$filter);
		
		to_excel($query,"master_retur_beli"); 
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