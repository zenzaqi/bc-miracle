<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_retur_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_retur_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:32
	
*/

//class of master_retur_beli
class C_master_retur_beli extends Controller {

	//constructor
	function C_master_retur_beli(){
		parent::Controller();
		$this->load->model('m_master_retur_beli', '', TRUE);
		$this->load->plugin('to_excel');
		
	}
	
	//set index
	function index(){
		$this->load->view('main/v_master_retur_beli');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_retur_beli');
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
		
		$data["data_print"]=$this->m_master_retur_beli->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);
		if($opsi=='rekap'){
				
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_retur_beli_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_rekap_retur_beli_supplier.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_retur_beli.php",$data,TRUE);break;
			}
			
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_retur_beli_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_detail_retur_beli_supplier.php",$data,TRUE);break;
				case "Produk": $print_view=$this->load->view("main/p_detail_retur_beli_produk.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_retur_beli.php",$data,TRUE);break;
			}
		}
		
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_retur_beli.html","w+");
		else
			$print_file=fopen("print/report_retur_beli.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	
	function get_terima_beli_list(){
		$result=$this->m_master_retur_beli->get_terima_beli_list();
		echo $result;
	}
	
	
	function get_terima_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_master_retur_beli->get_terima_list($query,$start,$end);
		echo $result;
	}
	
	
	function get_supplier_list(){
		$result=$this->m_public_function->get_supplier_list();
		echo $result;
	}
	
	//get master id, note: not done yet
	function get_produk_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$terima_id = (integer) (isset($_POST['terima_id']) ? @$_POST['terima_id'] : @$_GET['terima_id']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		if($task=='detail')
			$result=$this->m_master_retur_beli->get_produk_detail_list($master_id,$query,$start,$end);
		elseif($task=='list')
			$result=$this->m_master_retur_beli->get_produk_all_list($terima_id, $selected_id, $query,$start,$end);
		elseif($task=='selected')
			$result=$this->m_master_retur_beli->get_produk_selected_list($selected_id,$query,$start,$end);
		echo $result;
	}
	
	function get_satuan_list(){
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		
		if($task=='detail')
			$result=$this->m_master_retur_beli->get_satuan_detail_list($master_id);
		elseif($task=='produk')
			$result=$this->m_master_retur_beli->get_satuan_produk_list($selected_id);
		elseif($task=='selected')
			$result=$this->m_master_retur_beli->get_satuan_selected_list($selected_id);
			
		echo $result;
	}
	
	
	function get_satuan_by_produkid(){
		$dterima_master = trim(@$_POST["dterima_master"]);
		$dterima_produk = trim(@$_POST["dterima_produk"]);
		$result=$this->m_master_retur_beli->get_satuan_by_produkid($dterima_master, $dterima_produk);
		echo $result;
	}
	
	
	//for detail action
	//list detail handler action
	function  detail_detail_retur_beli_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_beli->detail_detail_retur_beli_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_retur_beli_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_master_retur_beli->detail_detail_retur_beli_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_retur_beli->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_retur_beli_insert(){
	//POST variable here
		$drbeli_id=trim(@$_POST["drbeli_id"]);
		$drbeli_master=trim(@$_POST["drbeli_master"]);
		$drbeli_produk=trim(@$_POST["drbeli_produk"]);
		$drbeli_satuan=trim(@$_POST["drbeli_satuan"]);
		$drbeli_jumlah=trim(@$_POST["drbeli_jumlah"]);
		$drbeli_harga=trim(@$_POST["drbeli_harga"]);
		$drbeli_diskon=trim(@$_POST["drbeli_diskon"]);
		$result=$this->m_master_retur_beli->detail_detail_retur_beli_insert($drbeli_id ,$drbeli_master ,$drbeli_produk ,$drbeli_satuan ,$drbeli_jumlah ,$drbeli_harga, $drbeli_diskon );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_retur_beli_list();
				break;
			case "UPDATE":
				$this->master_retur_beli_update();
				break;
			case "CREATE":
				$this->master_retur_beli_create();
				break;
			case "DELETE":
				$this->master_retur_beli_delete();
				break;
			case "SEARCH":
				$this->master_retur_beli_search();
				break;
			case "PRINT":
				$this->master_retur_beli_print();
				break;
			case "EXCEL":
				$this->master_retur_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_retur_beli_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_master_retur_beli->master_retur_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_retur_beli_update(){
		//POST variable here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace(",", ",",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		
		$rbeli_status=trim(@$_POST["rbeli_status"]);
		$rbeli_status=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_status);
		$rbeli_status=str_replace(",", ",",$rbeli_status);
		$rbeli_status=str_replace("'", '"',$rbeli_status);
		$result = $this->m_master_retur_beli->master_retur_beli_update($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan, $rbeli_status );
		echo $result;
	}
	
	//function for create new record
	function master_retur_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		
		$rbeli_status=trim(@$_POST["rbeli_status"]);
		$rbeli_status=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_status);
		$rbeli_status=str_replace("'", '"',$rbeli_status);
		$result=$this->m_master_retur_beli->master_retur_beli_create($rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan, $rbeli_status);
		echo $result;
	}

	//function for delete selected record
	function master_retur_beli_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_retur_beli->master_retur_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_retur_beli_search(){
		//POST varibale here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		
		$rbeli_status=trim(@$_POST["rbeli_status"]);
		$rbeli_status=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_status);
		$rbeli_status=str_replace("'", '"',$rbeli_status);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_retur_beli->master_retur_beli_search($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$rbeli_status, $start,$end);
		echo $result;
	}


	function master_retur_beli_print(){
  		//POST varibale here
		$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_retur_beli->master_retur_beli_print($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=7;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_retur_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Cetak Daftar Retur Pembelian</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Daftar Retur Pembelian'><caption>Daftar Retur Pembelian</caption>
			   <thead><tr>
			   		<th scope='col'>Tanggal</th>
					<th scope='col'>No. Retur</th>
					<th scope='col'>No. Penerimaan</th>
					<th scope='col'>No. Pesanan</th>
					<th scope='col'>Supplier</th>
					<th scope='col'>Jumlah Item</th>
					<th scope='col'>Total Nilai</th>
					<th scope='col'>Keterangan</th>
				</tr></thead>
					<tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Retur Pembelian</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['tanggal']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['no_bukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['no_terima']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['no_order']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['supplier_nama']);
				fwrite($file,"</td><td class='numeric'>");
				fwrite($file, number_format($data['jumlah_barang']));
				fwrite($file, "</td><td class='numeric'>");
				fwrite($file, number_format($data['total_nilai']));
				fwrite($file, "</td><td>");
				fwrite($file, $data['rbeli_keterangan']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_retur_beli_export_excel(){
		//POST varibale here
		//$rbeli_id=trim(@$_POST["rbeli_id"]);
		$rbeli_id=NULL;
		$rbeli_nobukti=trim(@$_POST["rbeli_nobukti"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_tanggal=trim(@$_POST["rbeli_tanggal"]);
		$rbeli_keterangan=trim(@$_POST["rbeli_keterangan"]);
		$rbeli_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rbeli_keterangan);
		$rbeli_keterangan=str_replace("'", '"',$rbeli_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_retur_beli->master_retur_beli_export_excel($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$option,$filter);
		
		to_excel($query,"master_retur_beli"); 
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