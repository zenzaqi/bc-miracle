<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_koreksi_stok Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_koreksi_stok.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:46:19
	
*/

//class of master_koreksi_stok
class C_master_koreksi_stok extends Controller {

	//constructor
	function C_master_koreksi_stok(){
		parent::Controller();
		$this->load->model('m_master_koreksi_stok', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_koreksi_stok');
	}
	
	function get_gudang_list(){
		$result=$this->m_public_function->get_gudang_list();
		echo $result;
	}
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$gudang = (integer) (isset($_POST['gudang']) ? @$_POST['gudang'] : @$_GET['gudang']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		if($task=='detail')
			$result=$this->m_master_koreksi_stok->get_produk_detail_list($gudang, $master_id,$query,$start,$end);
		elseif($task=='list')
			$result=$this->m_master_koreksi_stok->get_produk_all_list($gudang, $selected_id, $query, $start, $end);
		elseif($task=='selected')
			$result=$this->m_master_koreksi_stok->get_produk_selected_list($gudang, $selected_id,$query,$start,$end);

		echo $result;
	}
	
	function get_satuan_list(){
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		
		if($task=='detail')
			$result=$this->m_master_koreksi_stok->get_satuan_detail_list($master_id);
		elseif($task=='produk')
			$result=$this->m_master_koreksi_stok->get_satuan_produk_list($selected_id);
		elseif($task=='selected')
			$result=$this->m_master_koreksi_stok->get_satuan_selected_list($selected_id);
			
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_koreksi_stok_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_koreksi_stok->detail_detail_koreksi_stok_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_koreksi_stok_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_koreksi_stok->detail_detail_koreksi_stok_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_koreksi_stok->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_koreksi_stok_insert(){
	//POST variable here
		$dkoreksi_id=trim(@$_POST["dkoreksi_id"]);
		$dkoreksi_master=trim(@$_POST["dkoreksi_master"]);
		$dkoreksi_produk=trim(@$_POST["dkoreksi_produk"]);
		$dkoreksi_satuan=trim(@$_POST["dkoreksi_satuan"]);
		$dkoreksi_jmlawal=trim(@$_POST["dkoreksi_jmlawal"]);
		$dkoreksi_jmlkoreksi=trim(@$_POST["dkoreksi_jmlkoreksi"]);
		$dkoreksi_jmlsaldo=trim(@$_POST["dkoreksi_jmlsaldo"]);
		$dkoreksi_ket=trim(@$_POST["dkoreksi_ket"]);
		$dkoreksi_ket=str_replace("/(<\/?)(p)([^>]*>)", "",$dkoreksi_ket);
		$dkoreksi_ket=str_replace("\\", "",$dkoreksi_ket);
		$dkoreksi_ket=str_replace("'", '"',$dkoreksi_ket);
		$result=$this->m_master_koreksi_stok->detail_detail_koreksi_stok_insert($dkoreksi_id ,$dkoreksi_master ,$dkoreksi_produk ,$dkoreksi_satuan ,$dkoreksi_jmlawal ,$dkoreksi_jmlkoreksi ,$dkoreksi_jmlsaldo ,$dkoreksi_ket );
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_koreksi_stok_list();
				break;
			case "UPDATE":
				$this->master_koreksi_stok_update();
				break;
			case "CREATE":
				$this->master_koreksi_stok_create();
				break;
			case "DELETE":
				$this->master_koreksi_stok_delete();
				break;
			case "SEARCH":
				$this->master_koreksi_stok_search();
				break;
			case "PRINT":
				$this->master_koreksi_stok_print();
				break;
			case "EXCEL":
				$this->master_koreksi_stok_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_koreksi_stok_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_koreksi_stok->master_koreksi_stok_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_koreksi_stok_update(){
		//POST variable here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace(",", ",",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$result = $this->m_master_koreksi_stok->master_koreksi_stok_update($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function master_koreksi_stok_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$result=$this->m_master_koreksi_stok->master_koreksi_stok_create($koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_koreksi_stok_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_koreksi_stok->master_koreksi_stok_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_koreksi_stok_search(){
		//POST varibale here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_koreksi_stok->master_koreksi_stok_search($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$start,$end);
		echo $result;
	}


	function master_koreksi_stok_print(){
  		//POST varibale here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_koreksi_stok->master_koreksi_stok_print($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=9;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_koreksi_stoklist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_koreksi_stok Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_koreksi_stok List'><caption>MASTER_KOREKSI_STOK</caption><thead><tr><th scope='col'>Koreksi Id</th><th scope='col'>Koreksi Gudang</th><th scope='col'>Koreksi Tanggal</th><th scope='col'>Koreksi Keterangan</th><th scope='col'>Koreksi Creator</th><th scope='col'>Koreksi Date Create</th><th scope='col'>Koreksi Update</th><th scope='col'>Koreksi Date Update</th><th scope='col'>Koreksi Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_koreksi_stok</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['koreksi_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['koreksi_gudang']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['koreksi_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['koreksi_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['koreksi_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['koreksi_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['koreksi_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['koreksi_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['koreksi_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_koreksi_stok_export_excel(){
		//POST varibale here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_koreksi_stok->master_koreksi_stok_export_excel($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$option,$filter);
		
		to_excel($query,"master_koreksi_stok"); 
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