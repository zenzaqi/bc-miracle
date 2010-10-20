<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_retur_jual_paket Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_retur_jual_paket.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:56
	
*/

//class of master_retur_jual_paket
class C_master_retur_jual_paket extends Controller {

	//constructor
	function C_master_retur_jual_paket(){
		parent::Controller();
		$this->load->model('m_master_retur_jual_paket', '', TRUE);
		session_start();
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_retur_jual_paket');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_retur_paket');
	}
	
	function print_laporan(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$opsi=(isset($_POST['opsi']) ? @$_POST['opsi'] : @$_GET['opsi']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		$group=(isset($_POST['group']) ? @$_POST['group'] : @$_GET['group']);
		
		$data["jenis"]='Retur Produk';
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
		
		$data["data_print"]=$this->m_master_retur_jual_paket->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);

		switch($group){
			case "Tanggal": $print_view=$this->load->view("main/p_rekap_retur_jual_tanggal.php",$data,TRUE);break;
			case "No Faktur Jual": $print_view=$this->load->view("main/p_rekap_retur_jual_faktur_jual.php",$data,TRUE);break;
			case "Customer": $print_view=$this->load->view("main/p_rekap_retur_jual_customer.php",$data,TRUE);break;
			default: $print_view=$this->load->view("main/p_rekap_retur_jual.php",$data,TRUE);break;
		}
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_rpaket.html","w+");
		else
			$print_file=fopen("print/report_rpaket.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	function get_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_retur_jual_paket->get_rawat_list($query,$start,$end);
		echo $result;
	}
	
	function get_dpaket_byjpaket_list(){
		$jpaket_id = isset($_POST['jpaket_id']) ? $_POST['jpaket_id'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$mode=trim(@$_POST["mode"]);
		$result = $this->m_master_retur_jual_paket->get_dpaket_byjpaket_list($mode,$jpaket_id,$start,$end);
		echo $result;
	}
	
	function get_retur_rawat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_retur_jual_paket->get_retur_rawat_list($query,$start,$end);
		echo $result;
	}
	
	function get_jual_paket_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_retur_jual_paket->get_jual_paket_list($query,$start,$end);
		echo $result;
	}
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	
	/* START Detail Retur tokwitansi */
	//list detail handler action
	function  drpaket_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_jual_paket->drpaket_list($master_id,$query);
		echo $result;
	}
	//end of handler
	
	function drpaket_tokwitansi_list(){
		$rpaket_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_jual_paket->drpaket_tokwitansi_list($rpaket_id);
		echo $result;
	}
	
	//purge all detail
	function detail_retur_paket_tokwitansi_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_jual_paket->detail_retur_paket_tokwitansi_purge($master_id);
	}
	//eof
	//add detail
	function detail_retur_paket_tokwitansi_insert(){
		//POST variable here
		/*$drpaket_id=trim(@$_POST["drpaket_id"]);
		$drpaket_master=trim(@$_POST["drpaket_master"]);
		$drpaket_rawat=trim(@$_POST["drpaket_rawat"]);
		$drpaket_jumlah=trim(@$_POST["drpaket_jumlah"]);
		$drpaket_harga=trim(@$_POST["drpaket_harga"]);*/
		//$drpaket_master=trim(@$_POST["drpaket_master"]);
		//$result=$this->m_master_retur_jual_paket->detail_retur_paket_tokwitansi_insert($drpaket_id ,$drpaket_master ,$drpaket_rawat ,$drpaket_jumlah ,$drpaket_harga );
		$drpaket_id = $_POST['drpaket_id']; // Get our array back and translate it :
		$array_drpaket_id = json_decode(stripslashes($drpaket_id));
		
		$drpaket_master = trim(@$_POST["drpaket_master"]);
		
		$drpaket_jpaket = trim(@$_POST["drpaket_jpaket"]);
		
		$drpaket_cust = trim(@$_POST["drpaket_cust"]);
		
		$drpaket_dpaket = $_POST['drpaket_dpaket']; // Get our array back and translate it :
		$array_drpaket_dpaket = json_decode(stripslashes($drpaket_dpaket));
		
		$drpaket_paket = $_POST['drpaket_paket']; // Get our array back and translate it :
		$array_drpaket_paket = json_decode(stripslashes($drpaket_paket));
		
		$drpaket_jumlah_terambil = $_POST['drpaket_jumlah_terambil']; // Get our array back and translate it :
		$array_drpaket_jumlah_terambil = json_decode(stripslashes($drpaket_jumlah_terambil));
		
		$drpaket_harga_satu = $_POST['drpaket_harga_satu']; // Get our array back and translate it :
		$array_drpaket_harga_satu = json_decode(stripslashes($drpaket_harga_satu));
		
		$drpaket_jumlah_diretur = $_POST['drpaket_jumlah_diretur']; // Get our array back and translate it :
		$array_drpaket_jumlah_diretur = json_decode(stripslashes($drpaket_jumlah_diretur));
		
		$drpaket_rupiah_retur = $_POST['drpaket_rupiah_retur']; // Get our array back and translate it :
		$array_drpaket_rupiah_retur = json_decode(stripslashes($drpaket_rupiah_retur));
		
		$drpaket_tanggal = trim(@$_POST["drpaket_tanggal"]);
		
		$result=$this->m_master_retur_jual_paket->detail_retur_paket_tokwitansi_insert($array_drpaket_id
																					   ,$drpaket_master
																					   ,$drpaket_jpaket
																					   ,$drpaket_cust
																					   ,$array_drpaket_dpaket
																					   ,$array_drpaket_paket
																					   ,$array_drpaket_jumlah_terambil
																					   ,$array_drpaket_harga_satu
																					   ,$array_drpaket_jumlah_diretur
																					   ,$array_drpaket_rupiah_retur
																					   ,$drpaket_tanggal);
		echo $result;
	}
	/* END Detail Retur tokwitansi*/
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_retur_jual_paket->get_master_id();
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_retur_jual_paket_list();
				break;
			case "UPDATE":
				$this->master_retur_jual_paket_update();
				break;
			case "CREATE":
				$this->master_retur_jual_paket_create();
				break;
			case "DELETE":
				$this->master_retur_jual_paket_delete();
				break;
			case "SEARCH":
				$this->master_retur_jual_paket_search();
				break;
			case "PRINT":
				$this->master_retur_jual_paket_print();
				break;
			case "EXCEL":
				$this->master_retur_jual_paket_export_excel();
				break;
			case "BATAL":
				$this->master_retur_jual_paket_batal();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_retur_jual_paket_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_retur_jual_paket->master_retur_jual_paket_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_retur_jual_paket_update(){
		//POST variable here
		$rpaket_id=trim(@$_POST["rpaket_id"]);
		$rpaket_nobukti=trim(@$_POST["rpaket_nobukti"]);
		$rpaket_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobukti);
		$rpaket_nobukti=str_replace(",", ",",$rpaket_nobukti);
		$rpaket_nobukti=str_replace("'", '"',$rpaket_nobukti);
		$rpaket_nobuktijual=trim(@$_POST["rpaket_nobuktijual"]);
		$rpaket_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobuktijual);
		$rpaket_nobuktijual=str_replace(",", ",",$rpaket_nobuktijual);
		$rpaket_nobuktijual=str_replace("'", '"',$rpaket_nobuktijual);
		$rpaket_cust=trim(@$_POST["rpaket_cust"]);
		$rpaket_tanggal=trim(@$_POST["rpaket_tanggal"]);
		$rpaket_keterangan=trim(@$_POST["rpaket_keterangan"]);
		$rpaket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_keterangan);
		$rpaket_keterangan=str_replace(",", ",",$rpaket_keterangan);
		$rpaket_keterangan=str_replace("'", '"',$rpaket_keterangan);
		
		$rpaket_stat_dok=trim(@$_POST["rpaket_stat_dok"]);
		$rpaket_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_stat_dok);
		$rpaket_stat_dok=str_replace(",", ",",$rpaket_stat_dok);
		$rpaket_stat_dok=str_replace("'", '"',$rpaket_stat_dok);
		
		$result = $this->m_master_retur_jual_paket->master_retur_jual_paket_update($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan, $rpaket_stat_dok );
		echo $result;
	}
	
	//function for create new record
	function master_retur_jual_paket_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$rpaket_nobukti=trim(@$_POST["rpaket_nobukti"]);
		$rpaket_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobukti);
		$rpaket_nobukti=str_replace("'", '"',$rpaket_nobukti);
		$rpaket_nobuktijual=trim(@$_POST["rpaket_nobuktijual"]);
		$rpaket_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobuktijual);
		$rpaket_nobuktijual=str_replace("'", '"',$rpaket_nobuktijual);
		$rpaket_cust=trim(@$_POST["rpaket_cust"]);
		$rpaket_tanggal=trim(@$_POST["rpaket_tanggal"]);
		$rpaket_keterangan=trim(@$_POST["rpaket_keterangan"]);
		$rpaket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_keterangan);
		$rpaket_keterangan=str_replace("'", '"',$rpaket_keterangan);
		
		$rpaket_stat_dok=trim(@$_POST["rpaket_stat_dok"]);
		$rpaket_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_stat_dok);
		$rpaket_stat_dok=str_replace("'", '"',$rpaket_stat_dok);
		
		$rpaket_kwitansi_nilai=trim(@$_POST["rpaket_kwitansi_nilai"]);
		$rpaket_kwitansi_keterangan=trim(@$_POST["rpaket_kwitansi_keterangan"]);
		$rpaket_kwitansi_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_kwitansi_keterangan);
		$rpaket_kwitansi_keterangan=str_replace("'", '"',$rpaket_kwitansi_keterangan);
		$result=$this->m_master_retur_jual_paket->master_retur_jual_paket_create($rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$rpaket_stat_dok, $rpaket_kwitansi_nilai ,$rpaket_kwitansi_keterangan );
		echo $result;
	}

	//function for delete selected record
	function master_retur_jual_paket_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_retur_jual_paket->master_retur_jual_paket_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_retur_jual_paket_search(){
		//POST varibale here
		$rpaket_id=trim(@$_POST["rpaket_id"]);
		$rpaket_nobukti=trim(@$_POST["rpaket_nobukti"]);
		$rpaket_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobukti);
		$rpaket_nobukti=str_replace("'", '"',$rpaket_nobukti);
		$rpaket_nobuktijual=trim(@$_POST["rpaket_nobuktijual"]);
		$rpaket_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobuktijual);
		$rpaket_nobuktijual=str_replace("'", '"',$rpaket_nobuktijual);
		$rpaket_cust=trim(@$_POST["rpaket_cust"]);
		$rpaket_tanggal=trim(@$_POST["rpaket_tanggal"]);
		$rpaket_tanggal_akhir=trim(@$_POST["rpaket_tanggal_akhir"]);
		$rpaket_keterangan=trim(@$_POST["rpaket_keterangan"]);
		$rpaket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_keterangan);
		$rpaket_keterangan=str_replace("'", '"',$rpaket_keterangan);
		
		$rpaket_stat_dok=trim(@$_POST["rpaket_stat_dok"]);
		$rpaket_stat_dok=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_stat_dok);
		$rpaket_stat_dok=str_replace("'", '"',$rpaket_stat_dok);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_retur_jual_paket->master_retur_jual_paket_search($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_tanggal_akhir, $rpaket_keterangan ,$rpaket_stat_dok, $start,$end);
		echo $result;
	}


	function master_retur_jual_paket_print(){
  		//POST varibale here
		$rpaket_id=trim(@$_POST["rpaket_id"]);
		$rpaket_nobukti=trim(@$_POST["rpaket_nobukti"]);
		$rpaket_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobukti);
		$rpaket_nobukti=str_replace("'", '"',$rpaket_nobukti);
		$rpaket_nobuktijual=trim(@$_POST["rpaket_nobuktijual"]);
		$rpaket_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobuktijual);
		$rpaket_nobuktijual=str_replace("'", '"',$rpaket_nobuktijual);
		$rpaket_cust=trim(@$_POST["rpaket_cust"]);
		$rpaket_tanggal=trim(@$_POST["rpaket_tanggal"]);
		$rpaket_keterangan=trim(@$_POST["rpaket_keterangan"]);
		$rpaket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_keterangan);
		$rpaket_keterangan=str_replace("'", '"',$rpaket_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_retur_jual_paket->master_retur_jual_paket_print($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_retur_jual_paketlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Master_retur_jual_paket Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Master_retur_jual_paket List'><caption>MASTER_RETUR_JUAL_PAKET</caption><thead><tr><th scope='col'>Rpaket Id</th><th scope='col'>Rpaket Nobukti</th><th scope='col'>Rpaket Nobuktijual</th><th scope='col'>Rpaket Cust</th><th scope='col'>Rpaket Tanggal</th><th scope='col'>Rpaket Keterangan</th><th scope='col'>Rpaket Creator</th><th scope='col'>Rpaket Date Create</th><th scope='col'>Rpaket Update</th><th scope='col'>Rpaket Date Update</th><th scope='col'>Rpaket Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Master_retur_jual_paket</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['rpaket_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['rpaket_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rpaket_nobuktijual']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rpaket_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rpaket_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rpaket_keterangan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rpaket_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rpaket_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rpaket_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rpaket_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rpaket_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_retur_jual_paket_export_excel(){
		//POST varibale here
		$rpaket_id=trim(@$_POST["rpaket_id"]);
		$rpaket_nobukti=trim(@$_POST["rpaket_nobukti"]);
		$rpaket_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobukti);
		$rpaket_nobukti=str_replace("'", '"',$rpaket_nobukti);
		$rpaket_nobuktijual=trim(@$_POST["rpaket_nobuktijual"]);
		$rpaket_nobuktijual=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_nobuktijual);
		$rpaket_nobuktijual=str_replace("'", '"',$rpaket_nobuktijual);
		$rpaket_cust=trim(@$_POST["rpaket_cust"]);
		$rpaket_tanggal=trim(@$_POST["rpaket_tanggal"]);
		$rpaket_keterangan=trim(@$_POST["rpaket_keterangan"]);
		$rpaket_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rpaket_keterangan);
		$rpaket_keterangan=str_replace("'", '"',$rpaket_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_retur_jual_paket->master_retur_jual_paket_export_excel($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$option,$filter);
		
		to_excel($query,"master_retur_jual_paket"); 
		echo '1';
			
	}
	
	function master_retur_jual_paket_batal(){
		$rpaket_id=trim($_POST["rpaket_id"]);
		$result=$this->m_master_retur_jual_paket->master_retur_jual_paket_batal($rpaket_id);
		echo $result;
	}
	
	function print_paper(){
  		//POST varibale here
		$kwitansi_ref=trim(@$_POST["kwitansi_ref"]);
		
		
		$result = $this->m_master_retur_jual_paket->print_paper($kwitansi_ref);
		$rs=$result->row();
		$result_cara_bayar = $this->m_master_retur_jual_paket->cara_bayar($kwitansi_ref);
		
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