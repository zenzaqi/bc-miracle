<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_penyesuaian_stok Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_penyesuaian_stok.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of master_penyesuaian_stok
class C_master_penyesuaian_stok extends Controller {

	//constructor
	function C_master_penyesuaian_stok(){
		parent::Controller();
		$this->load->model('m_master_penyesuaian_stok', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_penyesuaian_stok');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_penyesuaian_stok_list();
				break;
			case "UPDATE":
				$this->master_penyesuaian_stok_update();
				break;
			case "CREATE":
				$this->master_penyesuaian_stok_create();
				break;
			case "DELETE":
				$this->master_penyesuaian_stok_delete();
				break;
			case "SEARCH":
				$this->master_penyesuaian_stok_search();
				break;
			case "PRINT":
				$this->master_penyesuaian_stok_print();
				break;
			case "EXCEL":
				$this->master_penyesuaian_stok_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_penyesuaian_stok_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_master_penyesuaian_stok->master_penyesuaian_stok_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_penyesuaian_stok_update(){
		//POST variable here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$koreksi_creator=trim(@$_POST["koreksi_creator"]);
		$koreksi_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_creator);
		$koreksi_creator=str_replace("'", '"',$koreksi_creator);
		$koreksi_date_create=trim(@$_POST["koreksi_date_create"]);
		$koreksi_update=trim(@$_POST["koreksi_update"]);
		$koreksi_update=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_update);
		$koreksi_update=str_replace("'", '"',$koreksi_update);
		$koreksi_date_update=trim(@$_POST["koreksi_date_update"]);
		$koreksi_revised=trim(@$_POST["koreksi_revised"]);
		$result = $this->m_master_penyesuaian_stok->master_penyesuaian_stok_update($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised );
		echo $result;
	}
	
	//function for create new record
	function master_penyesuaian_stok_create(){
		//POST varible here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$koreksi_creator=trim(@$_POST["koreksi_creator"]);
		$koreksi_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_creator);
		$koreksi_creator=str_replace("'", '"',$koreksi_creator);
		$koreksi_date_create=trim(@$_POST["koreksi_date_create"]);
		$koreksi_update=trim(@$_POST["koreksi_update"]);
		$koreksi_update=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_update);
		$koreksi_update=str_replace("'", '"',$koreksi_update);
		$koreksi_date_update=trim(@$_POST["koreksi_date_update"]);
		$koreksi_revised=trim(@$_POST["koreksi_revised"]);
		$result=$this->m_master_penyesuaian_stok->master_penyesuaian_stok_create($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised );
		echo $result;
	}

	//function for delete selected record
	function master_penyesuaian_stok_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_penyesuaian_stok->master_penyesuaian_stok_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_penyesuaian_stok_search(){
		//POST varibale here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$koreksi_creator=trim(@$_POST["koreksi_creator"]);
		$koreksi_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_creator);
		$koreksi_creator=str_replace("'", '"',$koreksi_creator);
		$koreksi_date_create=trim(@$_POST["koreksi_date_create"]);
		$koreksi_update=trim(@$_POST["koreksi_update"]);
		$koreksi_update=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_update);
		$koreksi_update=str_replace("'", '"',$koreksi_update);
		$koreksi_date_update=trim(@$_POST["koreksi_date_update"]);
		$koreksi_revised=trim(@$_POST["koreksi_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_penyesuaian_stok->master_penyesuaian_stok_search($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ,$start,$end);
		echo $result;
	}


	function master_penyesuaian_stok_print(){
  		//POST varibale here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$koreksi_creator=trim(@$_POST["koreksi_creator"]);
		$koreksi_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_creator);
		$koreksi_creator=str_replace("'", '"',$koreksi_creator);
		$koreksi_date_create=trim(@$_POST["koreksi_date_create"]);
		$koreksi_update=trim(@$_POST["koreksi_update"]);
		$koreksi_update=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_update);
		$koreksi_update=str_replace("'", '"',$koreksi_update);
		$koreksi_date_update=trim(@$_POST["koreksi_date_update"]);
		$koreksi_revised=trim(@$_POST["koreksi_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_penyesuaian_stok->master_penyesuaian_stok_print($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=9;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_penyesuaian_stoklist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_penyesuaian_stok Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_penyesuaian_stok List'><caption>MASTER_PENYESUAIAN_STOK</caption><thead><tr><th scope='col'>Koreksi Id</th><th scope='col'>Koreksi Gudang</th><th scope='col'>Koreksi Tanggal</th><th scope='col'>Koreksi Keterangan</th><th scope='col'>Koreksi Creator</th><th scope='col'>Koreksi Date Create</th><th scope='col'>Koreksi Update</th><th scope='col'>Koreksi Date Update</th><th scope='col'>Koreksi Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_penyesuaian_stok</td></tr></tfoot><tbody>");
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
				fwrite($file,"</td><td>");
				fwrite($file, $data['koreksi_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['koreksi_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['koreksi_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['koreksi_date_update']);
				fwrite($file,"</td><td>");
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
	function master_penyesuaian_stok_export_excel(){
		//POST varibale here
		$koreksi_id=trim(@$_POST["koreksi_id"]);
		$koreksi_gudang=trim(@$_POST["koreksi_gudang"]);
		$koreksi_tanggal=trim(@$_POST["koreksi_tanggal"]);
		$koreksi_keterangan=trim(@$_POST["koreksi_keterangan"]);
		$koreksi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_keterangan);
		$koreksi_keterangan=str_replace("'", '"',$koreksi_keterangan);
		$koreksi_creator=trim(@$_POST["koreksi_creator"]);
		$koreksi_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_creator);
		$koreksi_creator=str_replace("'", '"',$koreksi_creator);
		$koreksi_date_create=trim(@$_POST["koreksi_date_create"]);
		$koreksi_update=trim(@$_POST["koreksi_update"]);
		$koreksi_update=str_replace("/(<\/?)(p)([^>]*>)", "",$koreksi_update);
		$koreksi_update=str_replace("'", '"',$koreksi_update);
		$koreksi_date_update=trim(@$_POST["koreksi_date_update"]);
		$koreksi_revised=trim(@$_POST["koreksi_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_penyesuaian_stok->master_penyesuaian_stok_export_excel($koreksi_id ,$koreksi_gudang ,$koreksi_tanggal ,$koreksi_keterangan ,$koreksi_creator ,$koreksi_date_create ,$koreksi_update ,$koreksi_date_update ,$koreksi_revised ,$option,$filter);
		
		to_excel($query,"master_penyesuaian_stok"); 
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