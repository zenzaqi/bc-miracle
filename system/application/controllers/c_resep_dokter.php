<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: tindakan Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_tindakan_medis.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
*/

//class of tindakan
class C_resep_dokter extends Controller {

	//constructor
	function C_resep_dokter(){
		parent::Controller();
		$this->load->model('m_resep_dokter', '', TRUE);
		session_start();
		$this->load->plugin('to_excel');
		//$this->load->library('firephp');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_resep_dokter');
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_dokter_list(){
		//ID dokter pada tabel departemen adalah 8
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_public_function->get_petugas_list($query,$tgl_app,"Dokter");
		echo $result;
	}
	
	function get_terapis_list(){
		//ID dokter pada tabel departemen adalah 9
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_public_function->get_petugas_list($query,$tgl_app,"Therapist");
		echo $result;
	}
	

	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_resep_dokter->get_master_id();
		echo $result;
	}
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_resep_dokter->get_produk_list($query,$start,$end);
		echo $result;
	}
	
	function detail_resepdokter_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_resep_dokter->detail_resepdokter_list($master_id,$query,$start,$end);
		echo $result;
	}
	
	function resepdokter_detail_insert(){
		$dresep_id=trim(@$_POST["dresep_id"]);
		$dresep_master=trim(@$_POST["dresep_master"]);
		$dresep_produk=trim(@$_POST["dresep_produk"]);
		$cetak=trim(@$_POST['cetak']);
		$count=trim(@$_POST['count']);
		$dcount=trim(@$_POST['dcount']);

		$result=$this->m_resep_dokter->resepdokter_detail_insert($dresep_id ,$dresep_master ,$dresep_produk, $cetak, $count, $dcount);
		echo $result;
	}

	function detail_resepdokter_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		//$this->firephp->log($master_id,'masterer');
		$result=$this->m_resep_dokter->detail_resepdokter_purge($master_id);
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->resep_dokter_list();
				break;
			case "UPDATE":
				$this->resep_dokter_update();
				break;
			case "CREATE":
				$this->resep_dokter_create();
				break;
			case "DELETE":
				$this->resep_dokter_delete();
				break;
			case "SEARCH":
				$this->resep_dokter_search();
				break;
			case "PRINT":
				$this->resep_dokter_print();
				break;
			case "EXCEL":
				$this->resep_dokter_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function resep_dokter_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_resep_dokter->resep_dokter_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function resep_dokter_update(){
		//POST variable here
		$resep_id=trim(@$_POST["resep_id"]);
		$resep_custid=trim(@$_POST["resep_custid"]);
		$resep_no=trim(@$_POST["resep_no"]);
		$resep_no=str_replace("/(<\/?)(p)([^>]*>)", "",$resep_no);
		$resep_no=str_replace(",", "\,",$resep_no);
		$resep_no=str_replace("'", "''",$resep_no);
		
		$resep_sip=trim(@$_POST["resep_sip"]);
		$resep_sip=str_replace("/(<\/?)(p)([^>]*>)", "",$resep_sip);
		$resep_sip=str_replace(",", "\,",$resep_sip);
		$resep_sip=str_replace("'", "''",$resep_sip);
		$resep_tanggal=trim(@$_POST["resep_tanggal"]);
		$mode_edit=trim(@$_POST["mode_edit"]);
		$result = $this->m_resep_dokter->resep_dokter_update($resep_id, $resep_custid ,$resep_no, $resep_sip, $resep_tanggal, $mode_edit);
		echo $result;
	}
	
	//function for create new record
	function resep_dokter_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$resep_custid=trim(@$_POST["resep_custid"]);
		$resep_dokterid=trim(@$_POST["resep_dokterid"]);
		$resep_no=trim(@$_POST["resep_no"]);
		$resep_no=str_replace("/(<\/?)(p)([^>]*>)", "",$resep_no);
		$resep_no=str_replace("'", "''",$resep_no);
		$resep_sip=trim(@$_POST["resep_sip"]);
		$resep_sip=str_replace("/(<\/?)(p)([^>]*>)", "",$resep_sip);
		$resep_sip=str_replace("'", "''",$resep_sip);
		$resep_tanggal=trim(@$_POST["resep_tanggal"]);
		$resep_keterangan=trim(@$_POST["resep_keterangan"]);
		$resep_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$resep_keterangan);
		$resep_keterangan=str_replace("'", "''",$resep_keterangan);
		
		$result=$this->m_resep_dokter->resep_dokter_create($resep_custid, $resep_dokterid, $resep_no, $resep_sip, $resep_tanggal, $resep_keterangan);
		echo $result;
	}

	//function for delete selected record
	function resep_dokter_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_resep_dokter->resep_dokter_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function resep_dokter_search(){
		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$card_cust=trim(@$_POST["card_cust"]);
		if(trim(@$_POST["trawat_tglapp_start"])!="")
			$trawat_tglapp_start=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_start"])));
		else
			$trawat_tglapp_start="";
		if(trim(@$_POST["trawat_tglapp_end"])!="")
			$trawat_tglapp_end=date('Y-m-d', strtotime(trim(@$_POST["trawat_tglapp_end"])));
		else
			$trawat_tglapp_end="";
		$trawat_rawat=trim(@$_POST["trawat_rawat"]);
		$trawat_dokter=trim(@$_POST["trawat_dokter"]);
		$trawat_status=trim(@$_POST["trawat_status"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_resep_dokter->resep_dokter_search($trawat_id ,$card_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_dokter ,$trawat_status ,$start,$end);
		echo $result;
	}


	function resep_dokter_print(){
  		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$card_cust=trim(@$_POST["card_cust"]);
		$card_keterangan=trim(@$_POST["card_keterangan"]);
		$card_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$card_keterangan);
		$card_keterangan=str_replace("'", "''",$card_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_resep_dokter->resep_dokter_print($trawat_id ,$card_cust ,$card_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("tindakanlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Tindakan Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Tindakan List'><caption>TINDAKAN</caption><thead><tr><th scope='col'>Trawat Id</th><th scope='col'>Trawat Cust</th><th scope='col'>Trawat Keterangan</th><th scope='col'>Trawat Creator</th><th scope='col'>Trawat Date Create</th><th scope='col'>Trawat Update</th><th scope='col'>Trawat Date Update</th><th scope='col'>Trawat Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Tindakan</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['trawat_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['card_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['card_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['trawat_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function resep_dokter_export_excel(){
		//POST varibale here
		$trawat_id=trim(@$_POST["trawat_id"]);
		$card_cust=trim(@$_POST["card_cust"]);
		$card_keterangan=trim(@$_POST["card_keterangan"]);
		$card_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$card_keterangan);
		$card_keterangan=str_replace("'", "''",$card_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_resep_dokter->resep_dokter_export_excel($trawat_id ,$card_cust ,$card_keterangan ,$option,$filter);
		
		to_excel($query,"tindakan"); 
		echo '1';
			
	}
	
	
	function print_paper(){
  		//POST varibale here
		$resep_id=trim(@$_POST["resep_id"]);

		$result = $this->m_resep_dokter->print_paper($resep_id);
		$iklan = $this->m_resep_dokter->iklan();
		$rs=$result->row();
		$rsiklan=$iklan->row();
		$detail_resepdokter=$result->result();
		$data['karyawan_nama']=$rs->karyawan_nama;
		$data['karyawan_sip']=$rs->karyawan_sip;
		$data['cust_no']=$rs->cust_no;
		$data['cust_nama']=$rs->cust_nama;
		$data['cust_alamat']=$rs->cust_alamat;
		$data['iklantoday_keterangan']=$rsiklan->iklantoday_keterangan;
		$data['resep_tanggal']=date("d-m-Y",strtotime($rs->resep_tanggal));
		$data['resep_no']=$rs->resep_no;
		$data['produk_nama']=$rs->produk_nama;
		$data['detail_resepdokter']=$detail_resepdokter;
		$viewdata=$this->load->view("main/resepdokter_formcetak",$data,TRUE);
		$file = fopen("resepdokter_paper.html",'w');
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