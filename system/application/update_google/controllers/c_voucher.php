<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: voucher Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_voucher.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 06:40:41
	
*/

//class of voucher
class C_voucher extends Controller {

	//constructor
	function C_voucher(){
		parent::Controller();
		$this->load->model('m_voucher', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_voucher');
	}
	
	//for detail action
	//list detail handler action
	function  detail_voucher_berlaku_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_voucher->detail_voucher_berlaku_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	function get_produk_rawat_list(){
		$result=$this->m_public_function->get_produk_rawat_list();
		echo $result;
	}
	
	function get_promo_list(){
		$result=$this->m_voucher->get_promo_list();
		echo $result;
	}
	function get_voucher_kupon_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_voucher->get_voucher_kupon_list($master_id,$query,$start,$end);
		echo $result;
	}
	
	//purge all detail
	function detail_voucher_berlaku_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_voucher->detail_voucher_berlaku_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_voucher->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_voucher_berlaku_insert(){
	//POST variable here
		$bvoucher_id=trim(@$_POST["bvoucher_id"]);
		$bvoucher_master=trim(@$_POST["bvoucher_master"]);
		$bvoucher_produk=trim(@$_POST["bvoucher_produk"]);
		$bvoucher_produk=str_replace("/(<\/?)(p)([^>]*>)", "",$bvoucher_produk);
		$bvoucher_produk=str_replace("\\", "",$bvoucher_produk);
		$bvoucher_produk=str_replace("'", '"',$bvoucher_produk);
		$result=$this->m_voucher->detail_voucher_berlaku_insert($bvoucher_id ,$bvoucher_master ,$bvoucher_produk );
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->voucher_list();
				break;
			case "UPDATE":
				$this->voucher_update();
				break;
			case "CREATE":
				$this->voucher_create();
				break;
			case "DELETE":
				$this->voucher_delete();
				break;
			case "SEARCH":
				$this->voucher_search();
				break;
			case "PRINT":
				$this->voucher_print();
				break;
			case "EXCEL":
				$this->voucher_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function voucher_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_voucher->voucher_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function voucher_update(){
		//POST variable here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace(",", ",",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace(",", ",",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$voucher_cashback=trim(@$_POST["voucher_cashback"]);
		$voucher_mincash=trim(@$_POST["voucher_mincash"]);
		$voucher_diskon=trim(@$_POST["voucher_diskon"]);
		$voucher_promo=trim(@$_POST["voucher_promo"]);
		$voucher_allproduk=trim(@$_POST["voucher_allproduk"]);
		if($voucher_allproduk==true)
			$voucher_allproduk='Y';
		else
			$voucher_allproduk='T';
		$voucher_allrawat=trim(@$_POST["voucher_allrawat"]);
		if($voucher_allrawat==true)
			$voucher_allrawat='Y';
		else
			$voucher_allrawat='T';
		$result = $this->m_voucher->voucher_update($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat      );
		echo $result;
	}
	
	//function for create new record
	function voucher_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$voucher_cashback=trim(@$_POST["voucher_cashback"]);
		$voucher_mincash=trim(@$_POST["voucher_mincash"]);
		$voucher_diskon=trim(@$_POST["voucher_diskon"]);
		$voucher_promo=trim(@$_POST["voucher_promo"]);
		$voucher_allproduk=trim(@$_POST["voucher_allproduk"]);
		$voucher_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allproduk);
		$voucher_allproduk=str_replace("'", '"',$voucher_allproduk);
		$voucher_allrawat=trim(@$_POST["voucher_allrawat"]);
		$voucher_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allrawat);
		$voucher_allrawat=str_replace("'", '"',$voucher_allrawat);
		$result=$this->m_voucher->voucher_create($voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat );
		echo $result;
	}

	//function for delete selected record
	function voucher_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_voucher->voucher_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function voucher_search(){
		//POST varibale here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$voucher_cashback=trim(@$_POST["voucher_cashback"]);
		$voucher_mincash=trim(@$_POST["voucher_mincash"]);
		$voucher_diskon=trim(@$_POST["voucher_diskon"]);
		$voucher_promo=trim(@$_POST["voucher_promo"]);
		$voucher_allproduk=trim(@$_POST["voucher_allproduk"]);
		$voucher_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allproduk);
		$voucher_allproduk=str_replace("'", '"',$voucher_allproduk);
		$voucher_allrawat=trim(@$_POST["voucher_allrawat"]);
		$voucher_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allrawat);
		$voucher_allrawat=str_replace("'", '"',$voucher_allrawat);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_voucher->voucher_search($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ,$start,$end);
		echo $result;
	}


	function voucher_print(){
  		//POST varibale here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$voucher_cashback=trim(@$_POST["voucher_cashback"]);
		$voucher_mincash=trim(@$_POST["voucher_mincash"]);
		$voucher_diskon=trim(@$_POST["voucher_diskon"]);
		$voucher_promo=trim(@$_POST["voucher_promo"]);
		$voucher_allproduk=trim(@$_POST["voucher_allproduk"]);
		$voucher_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allproduk);
		$voucher_allproduk=str_replace("'", '"',$voucher_allproduk);
		$voucher_allrawat=trim(@$_POST["voucher_allrawat"]);
		$voucher_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allrawat);
		$voucher_allrawat=str_replace("'", '"',$voucher_allrawat);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_voucher->voucher_print($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=17;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("voucherlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Voucher Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Voucher List'><caption>VOUCHER</caption><thead><tr><th scope='col'>Voucher Id</th><th scope='col'>Voucher Nama</th><th scope='col'>Voucher Jenis</th><th scope='col'>Voucher Point</th><th scope='col'>Voucher Jumlah</th><th scope='col'>Voucher Kadaluarsa</th><th scope='col'>Voucher Cashback</th><th scope='col'>Voucher Mincash</th><th scope='col'>Voucher Diskon</th><th scope='col'>Voucher Promo</th><th scope='col'>Voucher Allproduk</th><th scope='col'>Voucher Allrawat</th><th scope='col'>Voucher Creator</th><th scope='col'>Voucher Date Create</th><th scope='col'>Voucher Update</th><th scope='col'>Voucher Date Update</th><th scope='col'>Voucher Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Voucher</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['voucher_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['voucher_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_jenis']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_point']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_jumlah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_kadaluarsa']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_cashback']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_mincash']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_promo']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_allproduk']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_allrawat']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function voucher_export_excel(){
		//POST varibale here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$voucher_cashback=trim(@$_POST["voucher_cashback"]);
		$voucher_mincash=trim(@$_POST["voucher_mincash"]);
		$voucher_diskon=trim(@$_POST["voucher_diskon"]);
		$voucher_promo=trim(@$_POST["voucher_promo"]);
		$voucher_allproduk=trim(@$_POST["voucher_allproduk"]);
		$voucher_allproduk=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allproduk);
		$voucher_allproduk=str_replace("'", '"',$voucher_allproduk);
		$voucher_allrawat=trim(@$_POST["voucher_allrawat"]);
		$voucher_allrawat=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_allrawat);
		$voucher_allrawat=str_replace("'", '"',$voucher_allrawat);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_voucher->voucher_export_excel($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ,$option,$filter);
		
		to_excel($query,"voucher"); 
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