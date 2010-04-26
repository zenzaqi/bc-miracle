<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: tukar_point Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_tukar_point.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:33
	
*/

//class of tukar_point
class C_tukar_point extends Controller {

	//constructor
	function C_tukar_point(){
		parent::Controller();
		$this->load->model('m_tukar_point', '', TRUE);
		session_start();
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_tukar_point');
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function  get_voucher_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_voucher_list($query,$start,$end);
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->tukar_point_list();
				break;
			case "UPDATE":
				$this->tukar_point_update();
				break;
			case "CREATE":
				$this->tukar_point_create();
				break;
			case "DELETE":
				$this->tukar_point_delete();
				break;
			case "SEARCH":
				$this->tukar_point_search();
				break;
			case "PRINT":
				$this->tukar_point_print();
				break;
			case "EXCEL":
				$this->tukar_point_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function tukar_point_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_tukar_point->tukar_point_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function tukar_point_update(){
		//POST variable here
		$epoint_id=trim(@$_POST["epoint_id"]);
		$epoint_cust=trim(@$_POST["epoint_cust"]);
		$epoint_jumlah=trim(@$_POST["epoint_jumlah"]);
		$epoint_voucher=trim(@$_POST["epoint_voucher"]);
		$epoint_tanggal=trim(@$_POST["epoint_tanggal"]);
		$result = $this->m_tukar_point->tukar_point_update($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal);
		echo $result;
	}
	
	//function for create new record
	function tukar_point_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$epoint_cust=trim(@$_POST["epoint_cust"]);
		$epoint_jumlah=trim(@$_POST["epoint_jumlah"]);
		$epoint_voucher=trim(@$_POST["epoint_voucher"]);
		$epoint_tanggal=trim(@$_POST["epoint_tanggal"]);
		$epoint_creator=$_SESSION[SESSION_USERID];
		$epoint_date_create=date('Y-m-d');
		$result=$this->m_tukar_point->tukar_point_create($epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$epoint_creator ,$epoint_date_create);
		echo $result;
	}

	//function for delete selected record
	function tukar_point_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_tukar_point->tukar_point_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function tukar_point_search(){
		//POST varibale here
		$epoint_id=trim(@$_POST["epoint_id"]);
		$epoint_cust=trim(@$_POST["epoint_cust"]);
		$epoint_jumlah=trim(@$_POST["epoint_jumlah"]);
		$epoint_voucher=trim(@$_POST["epoint_voucher"]);
		$epoint_tanggal=trim(@$_POST["epoint_tanggal"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_tukar_point->tukar_point_search($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$start,$end);
		echo $result;
	}


	function tukar_point_print(){
  		//POST varibale here
		$epoint_id=trim(@$_POST["epoint_id"]);
		$epoint_cust=trim(@$_POST["epoint_cust"]);
		$epoint_jumlah=trim(@$_POST["epoint_jumlah"]);
		$epoint_voucher=trim(@$_POST["epoint_voucher"]);
		$epoint_tanggal=trim(@$_POST["epoint_tanggal"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_tukar_point->tukar_point_print($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("tukar_pointlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Tukar_point Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Tukar_point List'><caption>TUKAR_POINT</caption><thead><tr><th scope='col'>Epoint Id</th><th scope='col'>Epoint Cust</th><th scope='col'>Epoint Jumlah</th><th scope='col'>Epoint Voucher</th><th scope='col'>Epoint Tanggal</th><th scope='col'>Epoint Creator</th><th scope='col'>Epoint Date Create</th><th scope='col'>Epoint Update</th><th scope='col'>Epoint Date Update</th><th scope='col'>Epoint Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Tukar_point</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['epoint_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['epoint_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['epoint_jumlah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['epoint_voucher']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['epoint_tanggal']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['epoint_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['epoint_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['epoint_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['epoint_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['epoint_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function tukar_point_export_excel(){
		//POST varibale here
		$epoint_id=trim(@$_POST["epoint_id"]);
		$epoint_cust=trim(@$_POST["epoint_cust"]);
		$epoint_jumlah=trim(@$_POST["epoint_jumlah"]);
		$epoint_voucher=trim(@$_POST["epoint_voucher"]);
		$epoint_tanggal=trim(@$_POST["epoint_tanggal"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_tukar_point->tukar_point_export_excel($epoint_id ,$epoint_cust ,$epoint_jumlah ,$epoint_voucher ,$epoint_tanggal ,$option,$filter);
		
		to_excel($query,"tukar_point"); 
		echo '1';
			
	}
	
	function print_paper(){
  		//POST varibale here
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		
		
		$result = $this->m_tukar_point->print_paper($kwitansi_ref);
		$rs=$result->row();
		$result_cara_bayar = $this->m_tukar_point->cara_bayar($kwitansi_ref);
		
		$data["kwitansi_no"]=$rs->kwitansi_no;
		$data["kwitansi_tanggal"]=$rs->kwitansi_date_create;
		$data["kwitansi_customer"]=$rs->cust_no."-".$rs->cust_nama;
		$data["kwitansi_nilai"]="Rp. ".ubah_rupiah($rs->kwitansi_nilai);
		$data["kwitansi_terbilang"]=strtoupper(terbilang($rs->kwitansi_nilai))." RUPIAH";
		$data["kwitansi_keterangan"]=$rs->kwitansi_keterangan;
		$data["kwitansi_cara"]=$rs->kwitansi_cara;
		
		$viewdata=$this->load->view("main/kwitansi_formcetak",$data,TRUE);
		$file = fopen("kwitansi_paper.html",'w');
		fwrite($file, $viewdata);	
		fclose($file);
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