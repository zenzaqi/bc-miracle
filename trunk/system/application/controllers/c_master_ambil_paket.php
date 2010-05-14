<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: paket Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_ambil_paket.php
 	+ Author  		: masongbee
 	+ Created on 28/Jan/2010 10:41:22
	
*/

//class of paket
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
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_ambil_paket->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_paket_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_ambil_paket->get_paket_list($query,$start,$end);
		echo $result;
	}
	
	function get_history_ambil_paket(){
		/*$dpaket_master = isset($_POST['dpaket_master']) ? $_POST['dpaket_master'] : 0;
		$dpaket_paket = isset($_POST['dpaket_paket']) ? $_POST['dpaket_paket'] : 0;*/
		$dapaket_dpaket = isset($_POST['dapaket_dpaket']) ? $_POST['dapaket_dpaket'] : 0;
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		//$result = $this->m_master_ambil_paket->get_history_ambil_paket($dpaket_master,$dpaket_paket,$start,$end);
		$result = $this->m_master_ambil_paket->get_history_ambil_paket($dapaket_dpaket,$start,$end);
		echo $result;
	}
	
	function get_isi_rawat_list(){
		//$apaket_id = isset($_POST['master_id']) ? $_POST['master_id'] : 0;
		$dapaket_dpaket = isset($_POST['dapaket_dpaket']) ? $_POST['dapaket_dpaket'] : 0;
		$dapaket_jpaket = isset($_POST['dapaket_jpaket']) ? $_POST['dapaket_jpaket'] : 0;
		$dapaket_paket = isset($_POST['dapaket_paket']) ? $_POST['dapaket_paket'] : 0;
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_ambil_paket->get_isi_rawat_list($dapaket_dpaket,$dapaket_jpaket,$dapaket_paket,$start,$end);
		echo $result;
	}
	
	function get_pengguna_paket_list(){
		$dpaket_master = isset($_POST['dpaket_master']) ? $_POST['dpaket_master'] : 0;
		$result = $this->m_master_ambil_paket->get_pengguna_paket_list($dpaket_master);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_ambil_paket_isi_perawatan_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_ambil_paket->detail_ambil_paket_isi_perawatan_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_ambil_paket_isi_perawatan_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_ambil_paket->detail_ambil_paket_isi_perawatan_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_ambil_paket->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_ambil_paket_isi_perawatan_insert(){
	//POST variable here
		/*$dapaket_master=trim(@$_POST["dapaket_master"]);
		$dapaket_sapaket=trim(@$_POST["dapaket_sapaket"]);*/
		$dapaket_dpaket=trim(@$_POST["dapaket_dpaket"]);
		$dapaket_jpaket=trim(@$_POST["dapaket_jpaket"]);
		$dapaket_paket=trim(@$_POST["dapaket_paket"]);
		$dapaket_item=trim(@$_POST["dapaket_item"]);
		$dapaket_jumlah=trim(@$_POST["dapaket_jumlah"]);
		$dapaket_cust=trim(@$_POST["dapaket_cust"]);
		$tgl_ambil=trim(@$_POST["tgl_ambil"]);
		
		$count=trim(@$_POST['count']);
		$dcount=trim(@$_POST['dcount']);
		
		$result=$this->m_master_ambil_paket->detail_ambil_paket_isi_perawatan_insert($dapaket_dpaket, $dapaket_jpaket, $dapaket_paket, $dapaket_item, $dapaket_jumlah, $dapaket_cust, $tgl_ambil, $count, $dcount);
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->ambil_paket_list();
				break;
			case "UPDATE":
				$this->ambil_paket_update();
				break;
			case "CREATE":
				$this->ambil_paket_create();
				break;
			case "DELETE":
				$this->ambil_paket_delete();
				break;
			case "SEARCH":
				$this->ambil_paket_search();
				break;
			case "PRINT":
				$this->ambil_paket_print();
				break;
			case "EXCEL":
				$this->ambil_paket_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function ambil_paket_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_ambil_paket->ambil_paket_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function ambil_paket_update(){
		//POST variable here
		$paket_id=trim(@$_POST["ambil_paket_id"]);
		$paket_kode=trim(@$_POST["ambil_paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace(",", "\,",$paket_kode);
		$paket_kode=str_replace("'", "\'",$paket_kode);
		$paket_nama=trim(@$_POST["ambil_paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace(",", "\,",$paket_nama);
		$paket_nama=str_replace("'", "\'",$paket_nama);
		$paket_expired=trim(@$_POST["ambil_paket_expired"]);
		$result = $this->m_master_ambil_paket->ambil_paket_update($paket_id ,$paket_kode ,$paket_nama ,$paket_expired );
		echo $result;
	}
	
	//function for create new record
	function ambil_paket_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", "\'",$paket_kode);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", "\'",$paket_nama);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$result=$this->m_master_ambil_paket->ambil_paket_create($paket_kode ,$paket_nama ,$paket_expired );
		echo $result;
	}

	//function for delete selected record
	function ambil_paket_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_ambil_paket->ambil_paket_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function ambil_paket_search(){
		//POST varibale here
		$apaket_faktur=trim(@$_POST["apaket_faktur"]);
		$apaket_faktur=str_replace("/(<\/?)(p)([^>]*>)", "",$apaket_faktur);
		$apaket_faktur=str_replace("'", "\'",$apaket_faktur);
		$apaket_cust=trim(@$_POST["apaket_cust"]);
		$apaket_paket=trim(@$_POST["apaket_paket"]);
		$apaket_kadaluarsa=trim(@$_POST["apaket_kadaluarsa"]);
		$apaket_kadaluarsa_akhir=trim(@$_POST["apaket_kadaluarsa_akhir"]);
		$apaket_tgl_faktur=trim(@$_POST["apaket_tgl_faktur"]);
		$apaket_tgl_faktur_akhir=trim(@$_POST["apaket_tgl_faktur_akhir"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_ambil_paket->ambil_paket_search($apaket_faktur, $apaket_cust, $apaket_paket, $apaket_kadaluarsa, $apaket_kadaluarsa_akhir, $apaket_tgl_faktur, $apaket_tgl_faktur_akhir, $start, $end);
		echo $result;
	}


	function ambil_paket_print(){
  		//POST varibale here
		$paket_id=trim(@$_POST["paket_id"]);
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", "\'",$paket_kode);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", "\'",$paket_nama);
		$paket_kodelama=trim(@$_POST["paket_kodelama"]);
		$paket_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kodelama);
		$paket_kodelama=str_replace("'", "\'",$paket_kodelama);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_ambil_paket->ambil_paket_print($paket_id ,$paket_kode ,$paket_nama ,$paket_expired ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=19;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("ambil_paketlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Paket Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Paket List'><caption>PAKET</caption><thead><tr><th scope='col'>Paket Id</th><th scope='col'>Paket Kode</th><th scope='col'>Paket Nama</th><th scope='col'>Paket Kontribusi</th><th scope='col'>Paket Kodelama</th><th scope='col'>Paket Keterangan</th><th scope='col'>Paket Du</th><th scope='col'>Paket Dm</th><th scope='col'>Paket Point</th><th scope='col'>Paket Harga</th><th scope='col'>Paket Expired</th><th scope='col'>Paket Aktif</th><th scope='col'>Paket Creator</th><th scope='col'>Paket Date Create</th><th scope='col'>Paket Update</th><th scope='col'>Paket Date Update</th><th scope='col'>Paket Revised</th><th scope='col'>Paket Jenis</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Paket</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['paket_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['paket_kode']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_expired']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['paket_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['paket_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['paket_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['paket_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function ambil_paket_export_excel(){
		//POST varibale here
		$paket_id=trim(@$_POST["paket_id"]);
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", "\'",$paket_kode);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", "\'",$paket_nama);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_ambil_paket->ambil_paket_export_excel($paket_id ,$paket_kode ,$paket_nama ,$paket_expired ,$option,$filter);
		
		to_excel($query,"paket"); 
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