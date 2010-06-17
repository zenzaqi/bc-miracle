<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: produk Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:29:05
	
*/

//class of produk
class C_produk extends Controller {

	//constructor
	function C_produk(){
		parent::Controller();
		$this->load->model('m_produk', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_produk');
	}
	
	function get_jenis_produk_list(){
		$result=$this->m_public_function->get_jenis_produk_list();
		echo $result;
	}
	
	function get_group_list(){
		$result=$this->m_public_function->get_group_list();
		echo $result;
	}
	
	function get_group_produk_list(){
		$result=$this->m_public_function->get_group_produk_list();
		echo $result;
	}
	
	function get_kategori_produk_list(){
		$result=$this->m_public_function->get_kategori_produk_list();
		echo $result;
	}
	
	function get_kontribusi_produk_list(){
		$result=$this->m_produk->get_kontribusi_produk_list();
		echo $result;
	}
	
	function get_satuan_list(){
		$result=$this->m_public_function->get_satuan_list();
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_satuan_konversi_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_produk->detail_satuan_konversi_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_satuan_konversi_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_produk->detail_satuan_konversi_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_produk->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_satuan_konversi_insert(){
	//POST variable here
		$konversi_id=trim(@$_POST["konversi_id"]);
		$konversi_produk=trim(@$_POST["konversi_produk"]);
		$konversi_satuan=trim(@$_POST["konversi_satuan"]);
		$konversi_nilai=trim(@$_POST["konversi_nilai"]);
		$konversi_default=trim(@$_POST["konversi_default"]);
		$result=$this->m_produk->detail_satuan_konversi_insert($konversi_id ,$konversi_produk ,$konversi_satuan ,$konversi_nilai ,$konversi_default);
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->produk_list();
				break;
			case "UPDATE":
				$this->produk_update();
				break;
			case "CREATE":
				$this->produk_create();
				break;
			case "DELETE":
				$this->produk_delete();
				break;
			case "SEARCH":
				$this->produk_search();
				break;
			case "PRINT":
				$this->produk_print();
				break;
			case "EXCEL":
				$this->produk_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function produk_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_produk->produk_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function produk_update(){
		//POST variable here
		$produk_id=trim(@$_POST["produk_id"]);
		$produk_kode=trim(@$_POST["produk_kode"]);
		$produk_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kode);
		$produk_kode=str_replace(",", ",",$produk_kode);
		$produk_kode=str_replace("'", '"',$produk_kode);
		$produk_kodelama=trim(@$_POST["produk_kodelama"]);
		$produk_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kodelama);
		$produk_kodelama=str_replace(",", ",",$produk_kodelama);
		$produk_kodelama=str_replace("'", "''",$produk_kodelama);
		$produk_group=trim(@$_POST["produk_group"]);
		$produk_kategori=trim(@$_POST["produk_kategori"]);
		$produk_kontribusi=trim(@$_POST["produk_kontribusi"]);
		$produk_jenis=trim(@$_POST["produk_jenis"]);
		$produk_nama=trim(@$_POST["produk_nama"]);
		$produk_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_nama);
		$produk_nama=str_replace(",", ",",$produk_nama);
		$produk_nama=str_replace("'", '"',$produk_nama);
		$produk_satuan=trim(@$_POST["produk_satuan"]);
		$produk_du=trim(@$_POST["produk_du"]);
		$produk_dm=trim(@$_POST["produk_dm"]);
		$produk_point=trim(@$_POST["produk_point"]);
		$produk_volume=trim(@$_POST["produk_volume"]);
		$produk_harga=trim(@$_POST["produk_harga"]);
		$produk_keterangan=trim(@$_POST["produk_keterangan"]);
		$produk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_keterangan);
		$produk_keterangan=str_replace("'", '"',$produk_keterangan);
		$produk_aktif=trim(@$_POST["produk_aktif"]);
		$produk_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_aktif);
		$produk_aktif=str_replace(",", ",",$produk_aktif);
		$produk_aktif=str_replace("'", '"',$produk_aktif);
		$result = $this->m_produk->produk_update($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_kontribusi ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif      );
		echo $result;
	}
	
	//function for create new record
	function produk_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$produk_kode=trim(@$_POST["produk_kode"]);
		$produk_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kode);
		$produk_kode=str_replace("'", '"',$produk_kode);
		$produk_kodelama=trim(@$_POST["produk_kodelama"]);
		$produk_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kodelama);
		$produk_kodelama=str_replace("'", "''",$produk_kodelama);
		$produk_group=trim(@$_POST["produk_group"]);
		$produk_kategori=trim(@$_POST["produk_kategori"]);
		$produk_kontribusi=trim(@$_POST["produk_kontribusi"]);
		$produk_jenis=trim(@$_POST["produk_jenis"]);
		$produk_nama=trim(@$_POST["produk_nama"]);
		$produk_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_nama);
		$produk_nama=str_replace("'", '"',$produk_nama);
		$produk_satuan=trim(@$_POST["produk_satuan"]);
		$produk_du=trim(@$_POST["produk_du"]);
		$produk_dm=trim(@$_POST["produk_dm"]);
		$produk_point=trim(@$_POST["produk_point"]);
		$produk_volume=trim(@$_POST["produk_volume"]);
		$produk_harga=trim(@$_POST["produk_harga"]);
		$produk_keterangan=trim(@$_POST["produk_keterangan"]);
		$produk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_keterangan);
		$produk_keterangan=str_replace("'", '"',$produk_keterangan);
		$produk_aktif=trim(@$_POST["produk_aktif"]);
		$produk_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_aktif);
		$produk_aktif=str_replace("'", '"',$produk_aktif);
		$result=$this->m_produk->produk_create($produk_kode, $produk_kodelama ,$produk_group ,$produk_kategori ,$produk_kontribusi ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif );
		echo $result;
	}

	//function for delete selected record
	function produk_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_produk->produk_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function produk_search(){
		//POST varibale here
		$produk_id=trim(@$_POST["produk_id"]);
		$produk_kode=trim(@$_POST["produk_kode"]);
		$produk_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kode);
		$produk_kode=str_replace("'", '"',$produk_kode);
		$produk_kodelama=trim(@$_POST["produk_kodelama"]);
		$produk_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kodelama);
		$produk_kodelama=str_replace("'", "''",$produk_kodelama);
		$produk_group=trim(@$_POST["produk_group"]);
		$produk_kategori=trim(@$_POST["produk_kategori"]);
		$produk_jenis=trim(@$_POST["produk_jenis"]);
		$produk_nama=trim(@$_POST["produk_nama"]);
		$produk_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_nama);
		$produk_nama=str_replace("'", '"',$produk_nama);
		$produk_satuan=trim(@$_POST["produk_satuan"]);
		$produk_du=trim(@$_POST["produk_du"]);
		$produk_dm=trim(@$_POST["produk_dm"]);
		$produk_point=trim(@$_POST["produk_point"]);
		$produk_kontribusi=trim(@$_POST["produk_kontribusi"]);
		$produk_volume=trim(@$_POST["produk_volume"]);
		$produk_harga=trim(@$_POST["produk_harga"]);
		$produk_keterangan=trim(@$_POST["produk_keterangan"]);
		$produk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_keterangan);
		$produk_keterangan=str_replace("'", '"',$produk_keterangan);
		$produk_aktif=trim(@$_POST["produk_aktif"]);
		$produk_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_aktif);
		$produk_aktif=str_replace("'", '"',$produk_aktif);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_produk->produk_search($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_kontribusi ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ,$start,$end);
		echo $result;
	}


	function produk_print(){
  		//POST varibale here
		$produk_id=trim(@$_POST["produk_id"]);
		$produk_kode=trim(@$_POST["produk_kode"]);
		$produk_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kode);
		$produk_kode=str_replace("'", '"',$produk_kode);
		$produk_kodelama=trim(@$_POST["produk_kodelama"]);
		$produk_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kodelama);
		$produk_kodelama=str_replace("'", "''",$produk_kodelama);
		$produk_group=trim(@$_POST["produk_group"]);
		$produk_kategori=trim(@$_POST["produk_kategori"]);
		$produk_jenis=trim(@$_POST["produk_jenis"]);
		$produk_nama=trim(@$_POST["produk_nama"]);
		$produk_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_nama);
		$produk_nama=str_replace("'", '"',$produk_nama);
		$produk_satuan=trim(@$_POST["produk_satuan"]);
		$produk_du=trim(@$_POST["produk_du"]);
		$produk_dm=trim(@$_POST["produk_dm"]);
		$produk_point=trim(@$_POST["produk_point"]);
		$produk_volume=trim(@$_POST["produk_volume"]);
		$produk_harga=trim(@$_POST["produk_harga"]);
		$produk_keterangan=trim(@$_POST["produk_keterangan"]);
		$produk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_keterangan);
		$produk_keterangan=str_replace("'", '"',$produk_keterangan);
		$produk_aktif=trim(@$_POST["produk_aktif"]);
		$produk_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_aktif);
		$produk_aktif=str_replace("'", '"',$produk_aktif);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_produk->produk_print($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=16;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("produklist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Produk Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Produk List'><caption>PRODUK</caption><thead><tr><th scope='col'>Produk Id</th><th scope='col'>Produk Kode</th><th scope='col'>Produk Kode Lama</th><th scope='col'>Produk Group</th><th scope='col'>Produk Kategori</th><th scope='col'>Produk Jenis</th><th scope='col'>Produk Nama</th><th scope='col'>Produk Satuan</th><th scope='col'>Produk Du</th><th scope='col'>Produk Dm</th><th scope='col'>Produk Point</th><th scope='col'>Produk Volume</th><th scope='col'>Produk Harga</th><th scope='col'>Produk Keterangan</th><th scope='col'>Produk Aktif</th><th scope='col'>Produk Creator</th><th scope='col'>Produk Date Create</th><th scope='col'>Produk Update</th><th scope='col'>Produk Date Update</th><th scope='col'>Poduk Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Produk</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['produk_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['produk_kode']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_kodelama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_group']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_kategori']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_jenis']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_satuan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_du']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_dm']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_point']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_volume']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_harga']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['produk_aktif']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['produk_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['produk_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['produk_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['produk_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['poduk_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function produk_export_excel(){
		//POST varibale here
		$produk_id=trim(@$_POST["produk_id"]);
		$produk_kode=trim(@$_POST["produk_kode"]);
		$produk_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kode);
		$produk_kode=str_replace("'", '"',$produk_kode);
		$produk_kodelama=trim(@$_POST["produk_kodelama"]);
		$produk_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_kodelama);
		$produk_kodelama=str_replace("'", "''",$produk_kodelama);
		$produk_group=trim(@$_POST["produk_group"]);
		$produk_kategori=trim(@$_POST["produk_kategori"]);
		$produk_jenis=trim(@$_POST["produk_jenis"]);
		$produk_nama=trim(@$_POST["produk_nama"]);
		$produk_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_nama);
		$produk_nama=str_replace("'", '"',$produk_nama);
		$produk_satuan=trim(@$_POST["produk_satuan"]);
		$produk_du=trim(@$_POST["produk_du"]);
		$produk_dm=trim(@$_POST["produk_dm"]);
		$produk_point=trim(@$_POST["produk_point"]);
		$produk_volume=trim(@$_POST["produk_volume"]);
		$produk_harga=trim(@$_POST["produk_harga"]);
		$produk_keterangan=trim(@$_POST["produk_keterangan"]);
		$produk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_keterangan);
		$produk_keterangan=str_replace("'", '"',$produk_keterangan);
		$produk_aktif=trim(@$_POST["produk_aktif"]);
		$produk_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$produk_aktif);
		$produk_aktif=str_replace("'", '"',$produk_aktif);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_produk->produk_export_excel($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ,$option,$filter);
		
		to_excel($query,"produk"); 
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