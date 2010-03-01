<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_retur_jual_produk Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_retur_jual_produk.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:25
	
*/

//class of master_retur_jual_produk
class C_master_retur_jual_produk extends Controller {

	//constructor
	function C_master_retur_jual_produk(){
		parent::Controller();
		$this->load->model('m_master_retur_jual_produk', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_retur_jual_produk');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_retur_produk');
	}
	
	function print_laporan(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$opsi=(isset($_POST['opsi']) ? @$_POST['opsi'] : @$_GET['opsi']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		$data["jenis"]='Retur Produk';
		if($periode=="all"){
			$data["periode"]="Semua Periode";
		}else if($periode=="bulan"){
			$tgl_awal=$tahun."-".$bulan;
			$data["periode"]=get_ina_month_name($bulan,'long')." ".$tahun;
		}else if($periode=="tanggal"){
			$data["periode"]="Periode ".$tgl_awal." s/d ".$tgl_akhir;
		}
		
		$data["total_item"]=$this->m_master_retur_jual_produk->get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["total_diskon"]=$this->m_master_retur_jual_produk->get_total_diskon($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["total_nilai"]=$this->m_master_retur_jual_produk->get_total_nilai($tgl_awal,$tgl_akhir,$periode,$opsi);
		$data["data_print"]=$this->m_master_retur_jual_produk->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi);
			
		if($opsi=='rekap'){
			$print_view=$this->load->view("main/p_rekap_retur_jual.php",$data,TRUE);
		}else{
			$print_view=$this->load->view("main/p_detail_retur_jual.php",$data,TRUE);
		}
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_rproduk.html","w+");
		else
			$print_file=fopen("print/report_rproduk.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
		
	function get_jual_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_retur_jual_produk->get_jual_produk_list($query,$start,$end);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_retur_jual_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_jual_produk->detail_detail_retur_jual_produk_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_retur_jual_produk_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_jual_produk->detail_detail_retur_jual_produk_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_retur_jual_produk->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_retur_jual_produk_insert(){
	//POST variable here
		$drproduk_id=trim(@$_POST["drproduk_id"]);
		$drproduk_master=trim(@$_POST["drproduk_master"]);
		$drproduk_produk=trim(@$_POST["drproduk_produk"]);
		$drproduk_satuan=trim(@$_POST["drproduk_satuan"]);
		$drproduk_jumlah=trim(@$_POST["drproduk_jumlah"]);
		$drproduk_harga=trim(@$_POST["drproduk_harga"]);
		$result=$this->m_master_retur_jual_produk->detail_detail_retur_jual_produk_insert($drproduk_id ,$drproduk_master ,$drproduk_produk ,$drproduk_satuan ,$drproduk_jumlah ,$drproduk_harga );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_retur_jual_produk_list();
				break;
			case "UPDATE":
				$this->master_retur_jual_produk_update();
				break;
			case "CREATE":
				$this->master_retur_jual_produk_create();
				break;
			case "DELETE":
				$this->master_retur_jual_produk_delete();
				break;
			case "SEARCH":
				$this->master_retur_jual_produk_search();
				break;
			case "PRINT":
				$this->master_retur_jual_produk_print();
				break;
			case "EXCEL":
				$this->master_retur_jual_produk_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_retur_jual_produk_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_retur_jual_produk->master_retur_jual_produk_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_retur_jual_produk_update(){
		//POST variable here
		$rproduk_id=trim(@$_POST["rproduk_id"]);
		$rproduk_nobukti=trim(@$_POST["rproduk_nobukti"]);
		$rproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobukti);
		$rproduk_nobukti=str_replace(",", ",",$rproduk_nobukti);
		$rproduk_nobukti=str_replace("'", '"',$rproduk_nobukti);
		$rproduk_nobuktijual=trim(@$_POST["rproduk_nobuktijual"]);
		$rproduk_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobuktijual);
		$rproduk_nobuktijual=str_replace(",", ",",$rproduk_nobuktijual);
		$rproduk_nobuktijual=str_replace("'", '"',$rproduk_nobuktijual);
		$rproduk_cust=trim(@$_POST["rproduk_cust"]);
		$rproduk_tanggal=trim(@$_POST["rproduk_tanggal"]);
		$rproduk_keterangan=trim(@$_POST["rproduk_keterangan"]);
		$rproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_keterangan);
		$rproduk_keterangan=str_replace(",", ",",$rproduk_keterangan);
		$rproduk_keterangan=str_replace("'", '"',$rproduk_keterangan);
		$result = $this->m_master_retur_jual_produk->master_retur_jual_produk_update($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan      );
		echo $result;
	}
	
	//function for create new record
	function master_retur_jual_produk_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$rproduk_nobukti=trim(@$_POST["rproduk_nobukti"]);
		$rproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobukti);
		$rproduk_nobukti=str_replace("'", '"',$rproduk_nobukti);
		$rproduk_nobuktijual=trim(@$_POST["rproduk_nobuktijual"]);
		$rproduk_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobuktijual);
		$rproduk_nobuktijual=str_replace("'", '"',$rproduk_nobuktijual);
		$rproduk_cust=trim(@$_POST["rproduk_cust"]);
		$rproduk_tanggal=trim(@$_POST["rproduk_tanggal"]);
		$rproduk_keterangan=trim(@$_POST["rproduk_keterangan"]);
		$rproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_keterangan);
		$rproduk_keterangan=str_replace("'", '"',$rproduk_keterangan);
		$result=$this->m_master_retur_jual_produk->master_retur_jual_produk_create($rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_retur_jual_produk_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_retur_jual_produk->master_retur_jual_produk_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_retur_jual_produk_search(){
		//POST varibale here
		$rproduk_id=trim(@$_POST["rproduk_id"]);
		$rproduk_nobukti=trim(@$_POST["rproduk_nobukti"]);
		$rproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobukti);
		$rproduk_nobukti=str_replace("'", '"',$rproduk_nobukti);
		$rproduk_nobuktijual=trim(@$_POST["rproduk_nobuktijual"]);
		$rproduk_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobuktijual);
		$rproduk_nobuktijual=str_replace("'", '"',$rproduk_nobuktijual);
		$rproduk_cust=trim(@$_POST["rproduk_cust"]);
		$rproduk_tanggal=trim(@$_POST["rproduk_tanggal"]);
		$rproduk_keterangan=trim(@$_POST["rproduk_keterangan"]);
		$rproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_keterangan);
		$rproduk_keterangan=str_replace("'", '"',$rproduk_keterangan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_retur_jual_produk->master_retur_jual_produk_search($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ,$start,$end);
		echo $result;
	}


	function master_retur_jual_produk_print(){
  		//POST varibale here
		$rproduk_id=trim(@$_POST["rproduk_id"]);
		$rproduk_nobukti=trim(@$_POST["rproduk_nobukti"]);
		$rproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobukti);
		$rproduk_nobukti=str_replace("'", '"',$rproduk_nobukti);
		$rproduk_nobuktijual=trim(@$_POST["rproduk_nobuktijual"]);
		$rproduk_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobuktijual);
		$rproduk_nobuktijual=str_replace("'", '"',$rproduk_nobuktijual);
		$rproduk_cust=trim(@$_POST["rproduk_cust"]);
		$rproduk_tanggal=trim(@$_POST["rproduk_tanggal"]);
		$rproduk_keterangan=trim(@$_POST["rproduk_keterangan"]);
		$rproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_keterangan);
		$rproduk_keterangan=str_replace("'", '"',$rproduk_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_retur_jual_produk->master_retur_jual_produk_print($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_retur_jual_produklist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_retur_jual_produk Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_retur_jual_produk List'><caption>MASTER_RETUR_JUAL_PRODUK</caption><thead><tr><th scope='col'>Rproduk Id</th><th scope='col'>Rproduk Nobukti</th><th scope='col'>Rproduk Nobuktijual</th><th scope='col'>Rproduk Cust</th><th scope='col'>Rproduk Tanggal</th><th scope='col'>Rproduk Keterangan</th><th scope='col'>Rproduk Creator</th><th scope='col'>Rproduk Date Create</th><th scope='col'>Rproduk Update</th><th scope='col'>Rproduk Date Update</th><th scope='col'>Rproduk Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_retur_jual_produk</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['rproduk_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['rproduk_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rproduk_nobuktijual']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rproduk_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rproduk_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rproduk_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rproduk_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rproduk_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rproduk_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rproduk_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rproduk_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_retur_jual_produk_export_excel(){
		//POST varibale here
		$rproduk_id=trim(@$_POST["rproduk_id"]);
		$rproduk_nobukti=trim(@$_POST["rproduk_nobukti"]);
		$rproduk_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobukti);
		$rproduk_nobukti=str_replace("'", '"',$rproduk_nobukti);
		$rproduk_nobuktijual=trim(@$_POST["rproduk_nobuktijual"]);
		$rproduk_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_nobuktijual);
		$rproduk_nobuktijual=str_replace("'", '"',$rproduk_nobuktijual);
		$rproduk_cust=trim(@$_POST["rproduk_cust"]);
		$rproduk_tanggal=trim(@$_POST["rproduk_tanggal"]);
		$rproduk_keterangan=trim(@$_POST["rproduk_keterangan"]);
		$rproduk_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rproduk_keterangan);
		$rproduk_keterangan=str_replace("'", '"',$rproduk_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_retur_jual_produk->master_retur_jual_produk_export_excel($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ,$option,$filter);
		
		to_excel($query,"master_retur_jual_produk"); 
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