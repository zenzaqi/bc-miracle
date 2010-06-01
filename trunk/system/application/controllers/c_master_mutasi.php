<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_mutasi Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_mutasi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:45:23
	
*/

//class of master_mutasi
class C_master_mutasi extends Controller {

	//constructor
	function C_master_mutasi(){
		parent::Controller();
		$this->load->model('m_master_mutasi', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_mutasi');
		$this->load->plugin('to_excel');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_mutasi');
	}
	
	function print_laporan(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$opsi=(isset($_POST['opsi']) ? @$_POST['opsi'] : @$_GET['opsi']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		$group=(isset($_POST['group']) ? @$_POST['group'] : @$_GET['group']);
		
		$data["jenis"]='Produk';
		if($periode=="all"){
			$data["periode"]="Semua Periode";
		}else if($periode=="bulan"){
			$tgl_awal=$tahun."-".$bulan;
			$data["periode"]=get_ina_month_name($bulan,'long')." ".$tahun;
		}else if($periode=="tanggal"){
			$data["periode"]="Periode ".$tgl_awal." s/d ".$tgl_akhir;
		}
		
		$data["data_print"]=$this->m_master_mutasi->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);
		if($opsi=='rekap'){
				
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_mutasi_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_rekap_mutasi_supplier.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_mutasi.php",$data,TRUE);break;
			}
			
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_mutasi_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_detail_mutasi_supplier.php",$data,TRUE);break;
				case "Produk": $print_view=$this->load->view("main/p_detail_mutasi_produk.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_mutasi.php",$data,TRUE);break;
			}
		}
		
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_mutasi.html","w+");
		else
			$print_file=fopen("print/report_mutasi.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	function get_gudang_list(){
		$result=$this->m_public_function->get_gudang_list();
		echo $result;
	}
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$gudang = (integer) (isset($_POST['gudang']) ? @$_POST['gudang'] : @$_GET['gudang']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		if($task=='detail')
			$result=$this->m_master_mutasi->get_produk_detail_list($gudang, $master_id,$query,$start,$end);
		elseif($task=='list')
			$result=$this->m_master_mutasi->get_produk_all_list($gudang, $selected_id, $query, $start, $end);
		elseif($task=='selected')
			$result=$this->m_master_mutasi->get_produk_selected_list($gudang, $selected_id,$query,$start,$end);

		echo $result;
	}
	
	function get_satuan_list(){
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		
		if($task=='detail')
			$result=$this->m_master_mutasi->get_satuan_detail_list($master_id);
		elseif($task=='produk')
			$result=$this->m_master_mutasi->get_satuan_produk_list($selected_id);
		elseif($task=='selected')
			$result=$this->m_master_mutasi->get_satuan_selected_list($selected_id);
			
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_mutasi_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_mutasi->detail_detail_mutasi_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_mutasi_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_mutasi->detail_detail_mutasi_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_mutasi->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_mutasi_insert(){
	//POST variable here
		$dmutasi_id=trim(@$_POST["dmutasi_id"]);
		$dmutasi_master=trim(@$_POST["dmutasi_master"]);
		$dmutasi_produk=trim(@$_POST["dmutasi_produk"]);
		$dmutasi_satuan=trim(@$_POST["dmutasi_satuan"]);
		$dmutasi_jumlah=trim(@$_POST["dmutasi_jumlah"]);
		$result=$this->m_master_mutasi->detail_detail_mutasi_insert($dmutasi_id ,$dmutasi_master ,$dmutasi_produk ,$dmutasi_satuan ,$dmutasi_jumlah );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_mutasi_list();
				break;
			case "UPDATE":
				$this->master_mutasi_update();
				break;
			case "CREATE":
				$this->master_mutasi_create();
				break;
			case "DELETE":
				$this->master_mutasi_delete();
				break;
			case "SEARCH":
				$this->master_mutasi_search();
				break;
			case "PRINT":
				$this->master_mutasi_print();
				break;
			case "EXCEL":
				$this->master_mutasi_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_mutasi_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_mutasi->master_mutasi_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_mutasi_update(){
		//POST variable here
		$mutasi_id=trim(@$_POST["mutasi_id"]);
		$mutasi_asal=trim(@$_POST["mutasi_asal"]);
		$mutasi_tujuan=trim(@$_POST["mutasi_tujuan"]);
		$mutasi_tanggal=trim(@$_POST["mutasi_tanggal"]);
		$mutasi_keterangan=trim(@$_POST["mutasi_keterangan"]);
		$mutasi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_keterangan);
		$mutasi_keterangan=str_replace(",", ",",$mutasi_keterangan);
		$mutasi_keterangan=str_replace("'", '"',$mutasi_keterangan);
		
		$mutasi_status=trim(@$_POST["mutasi_status"]);
		$mutasi_status=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_status);
		$mutasi_status=str_replace(",", ",",$mutasi_status);
		$mutasi_status=str_replace("'", '"',$mutasi_status);
		$result = $this->m_master_mutasi->master_mutasi_update($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan, $mutasi_status);
		echo $result;
	}
	
	//function for create new record
	function master_mutasi_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$mutasi_asal=trim(@$_POST["mutasi_asal"]);
		$mutasi_tujuan=trim(@$_POST["mutasi_tujuan"]);
		$mutasi_tanggal=trim(@$_POST["mutasi_tanggal"]);
		$mutasi_keterangan=trim(@$_POST["mutasi_keterangan"]);
		$mutasi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_keterangan);
		$mutasi_keterangan=str_replace("'", '"',$mutasi_keterangan);
		
		$mutasi_status=trim(@$_POST["mutasi_status"]);
		$mutasi_status=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_status);
		$mutasi_status=str_replace("'", '"',$mutasi_status);
		$result=$this->m_master_mutasi->master_mutasi_create($mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan, $mutasi_status );
		echo $result;
	}

	//function for delete selected record
	function master_mutasi_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_mutasi->master_mutasi_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_mutasi_search(){
		//POST varibale here
		$mutasi_id=trim(@$_POST["mutasi_id"]);
		$mutasi_asal=trim(@$_POST["mutasi_asal"]);
		$mutasi_tujuan=trim(@$_POST["mutasi_tujuan"]);
		$mutasi_tanggal=trim(@$_POST["mutasi_tanggal"]);
		$mutasi_keterangan=trim(@$_POST["mutasi_keterangan"]);
		$mutasi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_keterangan);
		$mutasi_keterangan=str_replace("'", '"',$mutasi_keterangan);
		
		$mutasi_status=trim(@$_POST["mutasi_status"]);
		$mutasi_status=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_status);
		$mutasi_status=str_replace("'", '"',$mutasi_status);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_mutasi->master_mutasi_search($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ,$mutasi_status, $start,$end);
		echo $result;
	}


	function master_mutasi_print(){
  		//POST varibale here
		$mutasi_id=trim(@$_POST["mutasi_id"]);
		$mutasi_asal=trim(@$_POST["mutasi_asal"]);
		$mutasi_tujuan=trim(@$_POST["mutasi_tujuan"]);
		$mutasi_tanggal=trim(@$_POST["mutasi_tanggal"]);
		$mutasi_keterangan=trim(@$_POST["mutasi_keterangan"]);
		$mutasi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_keterangan);
		$mutasi_keterangan=str_replace("'", '"',$mutasi_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_mutasi->master_mutasi_print($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_mutasilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_mutasi Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_mutasi List'><caption>MASTER_MUTASI</caption><thead><tr><th scope='col'>Mutasi Id</th><th scope='col'>Mutasi Asal</th><th scope='col'>Mutasi Tujuan</th><th scope='col'>Mutasi Tanggal</th><th scope='col'>Mutasi Keterangan</th><th scope='col'>Mutasi Creator</th><th scope='col'>Mutasi Date Create</th><th scope='col'>Mutasi Update</th><th scope='col'>Mutasi Date Update</th><th scope='col'>Mutasi Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_mutasi</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['mutasi_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['mutasi_asal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['mutasi_tujuan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['mutasi_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['mutasi_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['mutasi_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['mutasi_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['mutasi_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['mutasi_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['mutasi_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_mutasi_export_excel(){
		//POST varibale here
		$mutasi_id=trim(@$_POST["mutasi_id"]);
		$mutasi_asal=trim(@$_POST["mutasi_asal"]);
		$mutasi_tujuan=trim(@$_POST["mutasi_tujuan"]);
		$mutasi_tanggal=trim(@$_POST["mutasi_tanggal"]);
		$mutasi_keterangan=trim(@$_POST["mutasi_keterangan"]);
		$mutasi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$mutasi_keterangan);
		$mutasi_keterangan=str_replace("'", '"',$mutasi_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_mutasi->master_mutasi_export_excel($mutasi_id ,$mutasi_asal ,$mutasi_tujuan ,$mutasi_tanggal ,$mutasi_keterangan ,$option,$filter);
		
		to_excel($query,"master_mutasi"); 
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