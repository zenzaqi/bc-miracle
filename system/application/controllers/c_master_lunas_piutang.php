<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_lunas_piutang Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_lunas_piutang.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:05
	
*/

//class of master_lunas_piutang
class C_master_lunas_piutang extends Controller {

	//constructor
	function C_master_lunas_piutang(){
		parent::Controller();
		$this->load->model('m_master_lunas_piutang', '', TRUE);
		session_start();
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_lunas_piutang');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_piutang');
	}
	
	function print_laporan(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$opsi=(isset($_POST['opsi']) ? @$_POST['opsi'] : @$_GET['opsi']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		$group=(isset($_POST['group']) ? @$_POST['group'] : @$_GET['group']);
		
		if($periode=="all"){
			$data["periode"]="Semua Periode";
		}else if($periode=="bulan"){
			$tgl_awal=$tahun."-".$bulan;
			$data["periode"]=get_ina_month_name($bulan,'long')." ".$tahun;
		}else if($periode=="tanggal"){
			$date = substr($tgl_awal,8,2);
			$month = substr($tgl_awal,5,2);
			$year = substr($tgl_awal,0,4);
			$tgl_awal_show = $date.'-'.$month.'-'.$year;
			
			$date_akhir = substr($tgl_akhir,8,2);
			$month_akhir = substr($tgl_akhir,5,2);
			$year_akhir = substr($tgl_akhir,0,4);
			$tgl_akhir_show = $date_akhir.'-'.$month_akhir.'-'.$year_akhir;
			
			$data["periode"]="Periode : ".$tgl_awal_show." s/d ".$tgl_akhir_show.", ";
		}

		$data["data_print"]=$this->m_master_lunas_piutang->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);
		
		if(!file_exists("print")){
			mkdir("print");
		}
		
		if($opsi=='rekap'){
		
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_piutang_tanggal.php",$data,TRUE);break;
				case "Customer": $print_view=$this->load->view("main/p_rekap_piutang_customer.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_piutang.php",$data,TRUE);break;
			}
			$print_file=fopen("print/report_piutang.html","w");
			fwrite($print_file, $print_view);
			echo '1'; 
			
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_piutang_tanggal.php",$data,TRUE);break;
				case "Customer": $print_view=$this->load->view("main/p_detail_piutang_customer.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_piutang.php",$data,TRUE);break;
			}
			$print_file=fopen("print/report_piutang.html","w");
			fwrite($print_file, $print_view);
			fclose($print_file);
			echo '1'; 
		}
	}
	
	function get_bank_list(){
		$result=$this->m_public_function->get_bank_list();
		echo $result;
	}
	
	function detail_lunas_piutang_list(){
		$lpiutang_id = isset($_POST['lpiutang_id']) ? $_POST['lpiutang_id'] : "";
		$result=$this->m_master_lunas_piutang->detail_lunas_piutang_list($lpiutang_id);
		echo $result;
	}
	
	function get_faktur_jual_list_bycust(){
		$cust_id = isset($_POST['cust_id']) ? $_POST['cust_id'] : "";
		$result=$this->m_master_lunas_piutang->get_faktur_jual_list_bycust($cust_id);
		echo $result;
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_lunas_piutang->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	function  form_bayar_piutang_list(){
		$cust_id = (integer) (isset($_POST['cust_id']) ? $_POST['cust_id'] : $_GET['cust_id']);
		$result=$this->m_master_lunas_piutang->form_bayar_piutang_list($cust_id);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_lunas_piutang_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_lunas_piutang->detail_detail_lunas_piutang_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_lunas_piutang_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_lunas_piutang->detail_detail_lunas_piutang_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_lunas_piutang->get_master_id();
		echo $result;
	}
	//
	
	//add bayar
	function form_bayar_piutang_insert(){
		//POST variable here
		$dpiutang_master = $_POST['dpiutang_master']; // Get our array back and translate it :
		$array_dpiutang_master = json_decode(stripslashes($dpiutang_master));
		
		$dpiutang_nilai = $_POST['dpiutang_nilai']; // Get our array back and translate it :
		$array_dpiutang_nilai = json_decode(stripslashes($dpiutang_nilai));
		
		$dpiutang_cara=trim(@$_POST["dpiutang_cara"]);
		
		$dpiutang_card_nama=trim(@$_POST["dpiutang_card_nama"]);
		$dpiutang_card_edc=trim(@$_POST["dpiutang_card_edc"]);
		$dpiutang_card_no=trim(@$_POST["dpiutang_card_no"]);
		
		$dpiutang_cek_nama=trim(@$_POST["dpiutang_cek_nama"]);
		$dpiutang_cek_no=trim(@$_POST["dpiutang_cek_no"]);
		$dpiutang_cek_valid=trim(@$_POST["dpiutang_cek_valid"]);
		$dpiutang_cek_bank=trim(@$_POST["dpiutang_cek_bank"]);
		
		$dpiutang_transfer_bank=trim(@$_POST["dpiutang_transfer_bank"]);
		$dpiutang_transfer_nama=trim(@$_POST["dpiutang_transfer_nama"]);
		
		$dpiutang_nobukti=trim(@$_POST["dpiutang_nobukti"]);
		
		$result=$this->m_master_lunas_piutang->form_bayar_piutang_insert($array_dpiutang_master ,$array_dpiutang_nilai ,$dpiutang_cara ,$dpiutang_card_nama ,$dpiutang_card_edc ,$dpiutang_card_no ,$dpiutang_cek_nama ,$dpiutang_cek_no ,$dpiutang_cek_valid ,$dpiutang_cek_bank ,$dpiutang_transfer_bank ,$dpiutang_transfer_nama ,$dpiutang_nobukti);
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_lunas_piutang_list();
				break;
			case "UPDATE":
				$this->master_lunas_piutang_update();
				break;
			case "CREATE":
				$this->master_lunas_piutang_create();
				break;
			case "DELETE":
				$this->master_lunas_piutang_delete();
				break;
			case "SEARCH":
				$this->master_lunas_piutang_search();
				break;
			case "PRINT":
				$this->master_lunas_piutang_print();
				break;
			case "EXCEL":
				$this->master_lunas_piutang_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_lunas_piutang_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_lunas_piutang->master_lunas_piutang_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_lunas_piutang_update(){
		//POST variable here
		$lpiutang_id=trim(@$_POST["lpiutang_id"]);
		$lpiutang_no=trim(@$_POST["lpiutang_no"]);
		$lpiutang_no=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_no);
		$lpiutang_no=str_replace(",", ",",$lpiutang_no);
		$lpiutang_no=str_replace("'", '"',$lpiutang_no);
		$lpiutang_cust=trim(@$_POST["lpiutang_cust"]);
		$lpiutang_faktur_tanggal=trim(@$_POST["lpiutang_faktur_tanggal"]);
		$lpiutang_keterangan=trim(@$_POST["lpiutang_keterangan"]);
		$lpiutang_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_keterangan);
		$lpiutang_keterangan=str_replace(",", ",",$lpiutang_keterangan);
		$lpiutang_keterangan=str_replace("'", '"',$lpiutang_keterangan);
		$piutang_cara=trim(@$_POST["piutang_cara"]);
		$result = $this->m_master_lunas_piutang->master_lunas_piutang_update($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_faktur_tanggal ,$lpiutang_keterangan ,$piutang_cara);
		echo $result;
	}
	
	//function for create new record
	function master_lunas_piutang_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$lpiutang_no=trim(@$_POST["lpiutang_no"]);
		$lpiutang_no=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_no);
		$lpiutang_no=str_replace("'", '"',$lpiutang_no);
		$lpiutang_cust=trim(@$_POST["lpiutang_cust"]);
		$lpiutang_faktur_tanggal=trim(@$_POST["lpiutang_faktur_tanggal"]);
		$lpiutang_keterangan=trim(@$_POST["lpiutang_keterangan"]);
		$lpiutang_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_keterangan);
		$lpiutang_keterangan=str_replace("'", '"',$lpiutang_keterangan);
		$result=$this->m_master_lunas_piutang->master_lunas_piutang_create($lpiutang_no ,$lpiutang_cust ,$lpiutang_faktur_tanggal ,$lpiutang_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_lunas_piutang_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_lunas_piutang->master_lunas_piutang_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_lunas_piutang_search(){
		//POST varibale here
		$lpiutang_faktur_jual=trim(@$_POST["lpiutang_faktur_jual"]);
		$lpiutang_faktur_jual=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_faktur_jual);
		$lpiutang_faktur_jual=str_replace("'", '"',$lpiutang_faktur_jual);
		$lpiutang_cust=trim(@$_POST["lpiutang_cust"]);
		$lpiutang_faktur_tgl_start=trim(@$_POST["lpiutang_faktur_tgl_start"]);
		$lpiutang_faktur_tgl_akhir=trim(@$_POST["lpiutang_faktur_tgl_akhir"]);
		$lpiutang_status=trim(@$_POST["lpiutang_status"]);
		$lpiutang_status=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_status);
		$lpiutang_status=str_replace("'", '"',$lpiutang_status);
		$lpiutang_stat_dok=trim(@$_POST["lpiutang_stat_dok"]);
		$lpiutang_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_stat_dok);
		$lpiutang_stat_dok=str_replace("'", '"',$lpiutang_stat_dok);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_lunas_piutang->master_lunas_piutang_search($lpiutang_faktur_jual, $lpiutang_cust ,$lpiutang_faktur_tgl_start ,$lpiutang_faktur_tgl_akhir ,$lpiutang_status ,$lpiutang_stat_dok ,$start,$end);
		echo $result;
	}


	function master_lunas_piutang_print(){
  		//POST varibale here
		$lpiutang_id=trim(@$_POST["lpiutang_id"]);
		$lpiutang_no=trim(@$_POST["lpiutang_no"]);
		$lpiutang_no=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_no);
		$lpiutang_no=str_replace("'", '"',$lpiutang_no);
		$lpiutang_cust=trim(@$_POST["lpiutang_cust"]);
		$lpiutang_faktur_tanggal=trim(@$_POST["lpiutang_faktur_tanggal"]);
		$lpiutang_keterangan=trim(@$_POST["lpiutang_keterangan"]);
		$lpiutang_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_keterangan);
		$lpiutang_keterangan=str_replace("'", '"',$lpiutang_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_lunas_piutang->master_lunas_piutang_print($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_faktur_tanggal ,$lpiutang_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=10;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_lunas_piutanglist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_lunas_piutang Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_lunas_piutang List'><caption>MASTER_LUNAS_PIUTANG</caption><thead><tr><th scope='col'>Lpiutang Id</th><th scope='col'>Lpiutang No</th><th scope='col'>Lpiutang Cust</th><th scope='col'>Lpiutang Tanggal</th><th scope='col'>Lpiutang Keterangan</th><th scope='col'>Lpiutang Creator</th><th scope='col'>Lpiutang Date Create</th><th scope='col'>Lpiutang Update</th><th scope='col'>Lpiutang Date Update</th><th scope='col'>Lpiutang Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_lunas_piutang</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['lpiutang_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['lpiutang_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['lpiutang_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['lpiutang_faktur_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['lpiutang_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lpiutang_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lpiutang_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lpiutang_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lpiutang_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['lpiutang_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_lunas_piutang_export_excel(){
		//POST varibale here
		$lpiutang_id=trim(@$_POST["lpiutang_id"]);
		$lpiutang_no=trim(@$_POST["lpiutang_no"]);
		$lpiutang_no=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_no);
		$lpiutang_no=str_replace("'", '"',$lpiutang_no);
		$lpiutang_cust=trim(@$_POST["lpiutang_cust"]);
		$lpiutang_faktur_tanggal=trim(@$_POST["lpiutang_faktur_tanggal"]);
		$lpiutang_keterangan=trim(@$_POST["lpiutang_keterangan"]);
		$lpiutang_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$lpiutang_keterangan);
		$lpiutang_keterangan=str_replace("'", '"',$lpiutang_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_lunas_piutang->master_lunas_piutang_export_excel($lpiutang_id ,$lpiutang_no ,$lpiutang_cust ,$lpiutang_faktur_tanggal ,$lpiutang_keterangan ,$option,$filter);
		
		to_excel($query,"master_lunas_piutang"); 
		echo '1';
			
	}
	
	function print_paper(){
		$dpiutang_nobukti=trim(@$_POST["dpiutang_nobukti"]);
		
		$result = $this->m_master_lunas_piutang->print_paper($dpiutang_nobukti);
		$rs=$result->row();
		$detail_lpiutang=$result->result();
		
		$data['dpiutang_nobukti']=$rs->dpiutang_nobukti;
		$data['dpiutang_tanggal']=date('d-m-Y', strtotime($rs->dpiutang_tanggal));
		$data['cust_no']=$rs->cust_no;
		$data['cust_nama']=$rs->cust_nama;
		$data['cust_alamat']=$rs->cust_alamat;
		$data['cara_bayar']=$rs->dpiutang_cara;
		$data['detail_lpiutang']=$detail_lpiutang;
		
		$viewdata=$this->load->view("main/piutang_formcetak",$data,TRUE);
		$file = fopen("piutang_paper.html",'w');
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