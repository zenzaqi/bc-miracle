<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: cetak_kwitansi Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_cetak_kwitansi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:03:04
	
*/

//class of cetak_kwitansi
class C_cetak_kwitansi extends Controller {

	//constructor
	function C_cetak_kwitansi(){
		parent::Controller();
		$this->load->model('m_cetak_kwitansi', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_cetak_kwitansi');
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_trans_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_trans_list($query,$start,$end);
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->cetak_kwitansi_list();
				break;
			case "UPDATE":
				$this->cetak_kwitansi_update();
				break;
			case "CREATE":
				$this->cetak_kwitansi_create();
				break;
			case "DELETE":
				$this->cetak_kwitansi_delete();
				break;
			case "SEARCH":
				$this->cetak_kwitansi_search();
				break;
			case "PRINT":
				$this->cetak_kwitansi_print();
				break;
			case "EXCEL":
				$this->cetak_kwitansi_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function cetak_kwitansi_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_cetak_kwitansi->cetak_kwitansi_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function cetak_kwitansi_update(){
		//POST variable here
		$kwitansi_id=trim(@$_POST["kwitansi_id"]);
		$kwitansi_no=trim(@$_POST["kwitansi_no"]);
		$kwitansi_no=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_no);
		$kwitansi_no=str_replace(",", ",",$kwitansi_no);
		$kwitansi_no=str_replace("'", '"',$kwitansi_no);
		$kwitansi_cust=trim(@$_POST["kwitansi_cust"]);
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		$kwitansi_nilai=trim(@$_POST["kwitansi_nilai"]);
		$kwitansi_keterangan=trim(@$_POST["kwitansi_keterangan"]);
		$kwitansi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_keterangan);
		$kwitansi_keterangan=str_replace(",", ",",$kwitansi_keterangan);
		$kwitansi_keterangan=str_replace("'", '"',$kwitansi_keterangan);
		$opsi=trim(@$_POST["opt"]);
		$result = $this->m_cetak_kwitansi->cetak_kwitansi_update($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan,$opsi );
		echo $result;
	}
	
	//function for create new record
	function cetak_kwitansi_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$kwitansi_no=trim(@$_POST["kwitansi_no"]);
		$kwitansi_no=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_no);
		$kwitansi_no=str_replace("'", '"',$kwitansi_no);
		$kwitansi_cust=trim(@$_POST["kwitansi_cust"]);
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		$kwitansi_nilai=trim(@$_POST["kwitansi_nilai"]);
		$kwitansi_keterangan=trim(@$_POST["kwitansi_keterangan"]);
		$kwitansi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_keterangan);
		$kwitansi_keterangan=str_replace("'", '"',$kwitansi_keterangan);
		$opsi=trim(@$_POST["opt"]);
		$result=$this->m_cetak_kwitansi->cetak_kwitansi_create($kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan,$opsi );
		echo $result;
	}

	//function for delete selected record
	function cetak_kwitansi_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_cetak_kwitansi->cetak_kwitansi_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function cetak_kwitansi_search(){
		//POST varibale here
		$kwitansi_id=trim(@$_POST["kwitansi_id"]);
		$kwitansi_no=trim(@$_POST["kwitansi_no"]);
		$kwitansi_no=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_no);
		$kwitansi_no=str_replace("'", '"',$kwitansi_no);
		$kwitansi_cust=trim(@$_POST["kwitansi_cust"]);
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		$kwitansi_nilai=trim(@$_POST["kwitansi_nilai"]);
		$kwitansi_keterangan=trim(@$_POST["kwitansi_keterangan"]);
		$kwitansi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_keterangan);
		$kwitansi_keterangan=str_replace("'", '"',$kwitansi_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_cetak_kwitansi->cetak_kwitansi_search($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$start,$end);
		echo $result;
	}


	function cetak_kwitansi_print(){
  		//POST varibale here
		$kwitansi_id=trim(@$_POST["kwitansi_id"]);
		$kwitansi_no=trim(@$_POST["kwitansi_no"]);
		$kwitansi_no=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_no);
		$kwitansi_no=str_replace("'", '"',$kwitansi_no);
		$kwitansi_cust=trim(@$_POST["kwitansi_cust"]);
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		$kwitansi_nilai=trim(@$_POST["kwitansi_nilai"]);
		$kwitansi_keterangan=trim(@$_POST["kwitansi_keterangan"]);
		$kwitansi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_keterangan);
		$kwitansi_keterangan=str_replace("'", '"',$kwitansi_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_cetak_kwitansi->cetak_kwitansi_print($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("cetak_kwitansilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Cetak_kwitansi Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Cetak_kwitansi List'><caption>CETAK_KWITANSI</caption><thead><tr><th scope='col'>Kwitansi Id</th><th scope='col'>Kwitansi No</th><th scope='col'>Kwitansi Cust</th><th scope='col'>Kwitansi Ref</th><th scope='col'>Kwitansi Nilai</th><th scope='col'>Kwitansi Keterangan</th><th scope='col'>Kwitansi Creator</th><th scope='col'>Kwitansi Date Create</th><th scope='col'>Kwitansi Update</th><th scope='col'>Kwitansi Date Update</th><th scope='col'>Kwitansi Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Cetak_kwitansi</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['kwitansi_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['kwitansi_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['kwitansi_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['kwitansi_ref']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['kwitansi_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['kwitansi_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['kwitansi_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['kwitansi_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['kwitansi_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['kwitansi_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['kwitansi_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */
	
	function print_paper(){
  		//POST varibale here
		$kwitansi_id=trim(@$_POST["kwitansi_id"]);
		
		
		$result = $this->m_cetak_kwitansi->print_paper($kwitansi_id);
		$rs=$result->row();
		$data["kwitansi_no"]=$rs->kwitansi_no;
		$data["kwitansi_tanggal"]=$rs->kwitansi_date_create;
		$data["kwitansi_customer"]=$rs->cust_no."-".$rs->cust_nama;
		$data["kwitansi_nilai"]="Rp. ".ubah_rupiah($rs->kwitansi_nilai);
		$data["kwitansi_terbilang"]=strtoupper(terbilang($rs->kwitansi_nilai))." RUPIAH";
		$data["kwitansi_keterangan"]=$rs->kwitansi_keterangan;
		
		$viewdata=$this->load->view("main/kwitansi_formcetak",$data,TRUE);
		$file = fopen("kwitansi_paper.html",'w');
		fwrite($file, $viewdata);	
		fclose($file);
		echo '1';        
	}
	
	/* Function to Export Excel document */
	function cetak_kwitansi_export_excel(){
		//POST varibale here
		$kwitansi_id=trim(@$_POST["kwitansi_id"]);
		$kwitansi_no=trim(@$_POST["kwitansi_no"]);
		$kwitansi_no=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_no);
		$kwitansi_no=str_replace("'", '"',$kwitansi_no);
		$kwitansi_cust=trim(@$_POST["kwitansi_cust"]);
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		$kwitansi_nilai=trim(@$_POST["kwitansi_nilai"]);
		$kwitansi_keterangan=trim(@$_POST["kwitansi_keterangan"]);
		$kwitansi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$kwitansi_keterangan);
		$kwitansi_keterangan=str_replace("'", '"',$kwitansi_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_cetak_kwitansi->cetak_kwitansi_export_excel($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$option,$filter);
		
		to_excel($query,"cetak_kwitansi"); 
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