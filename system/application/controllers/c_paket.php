<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: paket Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 19/Aug/2009 16:12:06
	
*/

//class of paket
class C_paket extends Controller {

	//constructor
	function C_paket(){
		parent::Controller();
		$this->load->model('m_paket', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_paket');
	}
	
	function get_satuan_list(){
		$result=$this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	function get_group_list(){
		$result=$this->m_public_function->get_group_list();
		echo $result;
	}
	
	function get_group_paket_list(){
		$result=$this->m_public_function->get_group_paket_list();
		echo $result;
	}
	
	function get_kategori_list(){
		$result=$this->m_public_function->get_kategori_produk_list();
		echo $result;
	}
	
	function get_produk_list(){
		$result=$this->m_public_function->get_produk_list();
		echo $result;
	}
	
	function get_rawat_list(){
		$result=$this->m_public_function->get_perawatan_list();
		echo $result;
	}
	
	function get_kategori_paket_list(){
		$result=$this->m_public_function->get_kategori_paket_list();
		echo $result;
	}
	
	function get_group_by_id(){
		$group_id = (integer) (isset($_POST['group_id']) ? $_POST['group_id'] : $_GET['group_id']);
		$result=$this->m_public_function->get_group_by_id($group_id);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_paket_isi_perawatan_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_paket->detail_paket_isi_perawatan_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_paket_isi_perawatan_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_paket->detail_paket_isi_perawatan_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_paket->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_paket_isi_perawatan_insert(){
	//POST variable here
		$rpaket_id=trim(@$_POST["rpaket_id"]);
		$rpaket_master=trim(@$_POST["rpaket_master"]);
		$rpaket_perawatan=trim(@$_POST["rpaket_perawatan"]);
		$rpaket_jumlah=trim(@$_POST["rpaket_jumlah"]);
		$result=$this->m_paket->detail_paket_isi_perawatan_insert($rpaket_id ,$rpaket_master ,$rpaket_perawatan ,$rpaket_jumlah );
		echo $result;
	}
	
	//DETAIL PRODUK FUNCTION
	//list detail handler action
	function  detail_paket_isi_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_paket->detail_paket_isi_produk_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_paket_isi_produk_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_paket->detail_paket_isi_produk_purge($master_id);
		echo $result;
	}
	//eof
	
	
	//add detail
	function detail_paket_isi_produk_insert(){
	//POST variable here
		$ipaket_id=trim(@$_POST["ipaket_id"]);
		$ipaket_master=trim(@$_POST["ipaket_master"]);
		$ipaket_produk=trim(@$_POST["ipaket_produk"]);
		$ipaket_jumlah=trim(@$_POST["ipaket_jumlah"]);
		$ipaket_satuan=trim(@$_POST["ipaket_satuan"]);
		$result=$this->m_paket->detail_paket_isi_produk_insert($ipaket_id ,$ipaket_master ,$ipaket_produk ,$ipaket_jumlah );
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->paket_list();
				break;
			case "UPDATE":
				$this->paket_update();
				break;
			case "CREATE":
				$this->paket_create();
				break;
			case "DELETE":
				$this->paket_delete();
				break;
			case "SEARCH":
				$this->paket_search();
				break;
			case "PRINT":
				$this->paket_print();
				break;
			case "EXCEL":
				$this->paket_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function paket_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_paket->paket_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function paket_update(){
		//POST variable here
		$paket_id=trim(@$_POST["paket_id"]);
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace(",", ",",$paket_kode);
		$paket_kode=str_replace("'", '"',$paket_kode);
		$paket_kodelama=trim(@$_POST["paket_kodelama"]);
		$paket_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kodelama);
		$paket_kodelama=str_replace(",", ",",$paket_kodelama);
		$paket_kodelama=str_replace("'", '"',$paket_kodelama);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace(",", ",",$paket_nama);
		$paket_nama=str_replace("'", '"',$paket_nama);
		$paket_group=trim(@$_POST["paket_group"]);
		$paket_keterangan=trim(@$_POST["paket_keterangan"]);
		$paket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_keterangan);
		$paket_keterangan=str_replace(",", ",",$paket_keterangan);
		$paket_keterangan=str_replace("'", '"',$paket_keterangan);
		$paket_du=trim(@$_POST["paket_du"]);
		$paket_dm=trim(@$_POST["paket_dm"]);
		$paket_point=trim(@$_POST["paket_point"]);
		$paket_harga=trim(@$_POST["paket_harga"]);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$paket_aktif=trim(@$_POST["paket_aktif"]);
		$paket_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_aktif);
		$paket_aktif=str_replace(",", ",",$paket_aktif);
		$paket_aktif=str_replace("'", '"',$paket_aktif);
		$result = $this->m_paket->paket_update($paket_id ,$paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif      );
		echo $result;
	}
	
	//function for create new record
	function paket_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", '"',$paket_kode);
		$paket_kodelama=trim(@$_POST["paket_kodelama"]);
		$paket_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kodelama);
		$paket_kodelama=str_replace("'", '"',$paket_kodelama);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", '"',$paket_nama);
		$paket_group=trim(@$_POST["paket_group"]);
		$paket_keterangan=trim(@$_POST["paket_keterangan"]);
		$paket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_keterangan);
		$paket_keterangan=str_replace("'", '"',$paket_keterangan);
		$paket_du=trim(@$_POST["paket_du"]);
		$paket_dm=trim(@$_POST["paket_dm"]);
		$paket_point=trim(@$_POST["paket_point"]);
		$paket_harga=trim(@$_POST["paket_harga"]);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$paket_aktif=trim(@$_POST["paket_aktif"]);
		$paket_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_aktif);
		$paket_aktif=str_replace("'", '"',$paket_aktif);
		$result=$this->m_paket->paket_create($paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif );
		echo $result;
	}

	//function for delete selected record
	function paket_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_paket->paket_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function paket_search(){
		//POST varibale here
		$paket_id=trim(@$_POST["paket_id"]);
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", '"',$paket_kode);
		$paket_kodelama=trim(@$_POST["paket_kodelama"]);
		$paket_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kodelama);
		$paket_kodelama=str_replace("'", '"',$paket_kodelama);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", '"',$paket_nama);
		$paket_group=trim(@$_POST["paket_group"]);
		$paket_keterangan=trim(@$_POST["paket_keterangan"]);
		$paket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_keterangan);
		$paket_keterangan=str_replace("'", '"',$paket_keterangan);
		$paket_du=trim(@$_POST["paket_du"]);
		$paket_dm=trim(@$_POST["paket_dm"]);
		$paket_point=trim(@$_POST["paket_point"]);
		$paket_harga=trim(@$_POST["paket_harga"]);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$paket_aktif=trim(@$_POST["paket_aktif"]);
		$paket_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_aktif);
		$paket_aktif=str_replace("'", '"',$paket_aktif);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_paket->paket_search($paket_id ,$paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ,$start,$end);
		echo $result;
	}


	function paket_print(){
  		//POST varibale here
		$paket_id=trim(@$_POST["paket_id"]);
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", '"',$paket_kode);
		$paket_kodelama=trim(@$_POST["paket_kodelama"]);
		$paket_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kodelama);
		$paket_kodelama=str_replace("'", '"',$paket_kodelama);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", '"',$paket_nama);
		$paket_group=trim(@$_POST["paket_group"]);
		$paket_keterangan=trim(@$_POST["paket_keterangan"]);
		$paket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_keterangan);
		$paket_keterangan=str_replace("'", '"',$paket_keterangan);
		$paket_du=trim(@$_POST["paket_du"]);
		$paket_dm=trim(@$_POST["paket_dm"]);
		$paket_point=trim(@$_POST["paket_point"]);
		$paket_harga=trim(@$_POST["paket_harga"]);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$paket_aktif=trim(@$_POST["paket_aktif"]);
		$paket_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_aktif);
		$paket_aktif=str_replace("'", '"',$paket_aktif);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_paket->paket_print($paket_id ,$paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=16;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("paketlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Paket Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Paket List'><caption>PAKET</caption><thead><tr><th scope='col'>Paket Id</th><th scope='col'>Paket Kode</th><th scope='col'>Paket Kode Lama</th><th scope='col'>Paket Nama</th><th scope='col'>Paket Group</th><th scope='col'>Paket Keterangan</th><th scope='col'>Paket Du</th><th scope='col'>Paket Dm</th><th scope='col'>Paket Point</th><th scope='col'>Paket Harga</th><th scope='col'>Paket Expired</th><th scope='col'>Paket Aktif</th><th scope='col'>Paket Creator</th><th scope='col'>Paket Date Create</th><th scope='col'>Paket Update</th><th scope='col'>Paket Date Update</th><th scope='col'>Paket Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
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
				fwrite($file, $data['paket_kodelama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_group']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_du']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_dm']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_point']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_harga']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_expired']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['paket_aktif']);
				fwrite($file, "</td></tr>");
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
	function paket_export_excel(){
		//POST varibale here
		$paket_id=trim(@$_POST["paket_id"]);
		$paket_kode=trim(@$_POST["paket_kode"]);
		$paket_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kode);
		$paket_kode=str_replace("'", '"',$paket_kode);
		$paket_kodelama=trim(@$_POST["paket_kodelama"]);
		$paket_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_kodelama);
		$paket_kodelama=str_replace("'", '"',$paket_kodelama);
		$paket_nama=trim(@$_POST["paket_nama"]);
		$paket_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_nama);
		$paket_nama=str_replace("'", '"',$paket_nama);
		$paket_group=trim(@$_POST["paket_group"]);
		$paket_keterangan=trim(@$_POST["paket_keterangan"]);
		$paket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_keterangan);
		$paket_keterangan=str_replace("'", '"',$paket_keterangan);
		$paket_du=trim(@$_POST["paket_du"]);
		$paket_dm=trim(@$_POST["paket_dm"]);
		$paket_point=trim(@$_POST["paket_point"]);
		$paket_harga=trim(@$_POST["paket_harga"]);
		$paket_expired=trim(@$_POST["paket_expired"]);
		$paket_aktif=trim(@$_POST["paket_aktif"]);
		$paket_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$paket_aktif);
		$paket_aktif=str_replace("'", '"',$paket_aktif);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_paket->paket_export_excel($paket_id ,$paket_kode ,$paket_kodelama ,$paket_nama ,$paket_group ,$paket_keterangan ,$paket_du ,$paket_dm ,$paket_point ,$paket_harga ,$paket_expired ,$paket_aktif ,$option,$filter);
		
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