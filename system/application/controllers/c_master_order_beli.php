<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_order_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_order_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:12
*/

//class of master_order_beli
class C_master_order_beli extends Controller {

	//constructor
	function C_master_order_beli(){
		parent::Controller();
		session_start();
		$this->load->model('m_master_order_beli', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		
		$this->load->helper('asset');
		$this->load->view('main/v_master_order_beli');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_order');
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
		
		$data["data_print"]=$this->m_master_order_beli->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group);
		if($opsi=='rekap'){
				
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_order_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_rekap_order_supplier.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_order.php",$data,TRUE);break;
			}
			
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_order_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_detail_order_supplier.php",$data,TRUE);break;
				case "Produk": $print_view=$this->load->view("main/p_detail_order_produk.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_order.php",$data,TRUE);break;
			}
		}
		
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_order.html","w+");
		else
			$print_file=fopen("print/report_order.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_order_beli_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_order_beli->detail_detail_order_beli_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_order_beli_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_order_beli->detail_detail_order_beli_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_order_beli->get_master_id();
		echo $result;
	}
	//
	
	//get master id, note: not done yet
	function get_supplier_list(){
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$query=isset($_POST['query']) ? @$_POST['query'] : @$_GET['query'];
		$result=$this->m_public_function->get_supplier_list($query, $start,$end);
		echo $result;
	}
	//
	
	//get master id, note: not done yet
	function get_produk_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		if($task=='detail')
			$result=$this->m_master_order_beli->get_produk_detail_list($master_id,$query,$start,$end);
		elseif($task=='list')
			$result=$this->m_master_order_beli->get_produk_all_list($query,$start,$end);
		elseif($task=='selected')
			$result=$this->m_master_order_beli->get_produk_selected_list($master_id,$selected_id,$query,$start,$end);
		echo $result;
	}
	//
	
	function get_satuan_list(){
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		
		if($task=='detail')
			$result=$this->m_master_order_beli->get_satuan_detail_list($master_id);
		elseif($task=='produk')
			$result=$this->m_master_order_beli->get_satuan_produk_list($selected_id);
		elseif($task=='selected')
			$result=$this->m_master_order_beli->get_satuan_selected_list($selected_id);
			
		echo $result;
	}
	
	//add detail
	function detail_detail_order_beli_insert(){
	//POST variable here
		$dorder_id=trim(@$_POST["dorder_id"]);
		$dorder_master=trim(@$_POST["dorder_master"]);
		$dorder_produk=trim(@$_POST["dorder_produk"]);
		$dorder_satuan=trim(@$_POST["dorder_satuan"]);
		$dorder_jumlah=trim(@$_POST["dorder_jumlah"]);
		$dorder_harga=trim(@$_POST["dorder_harga"]);
		$dorder_diskon=trim(@$_POST["dorder_diskon"]);
		$result=$this->m_master_order_beli->detail_detail_order_beli_insert($dorder_id ,$dorder_master ,$dorder_produk ,$dorder_satuan ,$dorder_jumlah ,$dorder_harga ,$dorder_diskon );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->master_order_beli_list();
				break;
			case "UPDATE":
				$this->master_order_beli_update();
				break;
			case "CREATE":
				$this->master_order_beli_create();
				break;
			case "DELETE":
				$this->master_order_beli_delete();
				break;
			case "SEARCH":
				$this->master_order_beli_search();
				break;
			case "PRINT":
				$this->master_order_beli_print();
				break;
			case "EXCEL":
				$this->master_order_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function master_order_beli_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$result=$this->m_master_order_beli->master_order_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_order_beli_update(){
		//POST variable here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace(",", ",",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace(",", ",",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_cashback=trim(@$_POST["order_cashback"]);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace(",", ",",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$order_status=trim(@$_POST["order_status"]);
		$order_status=str_replace("/(<\/?)(p)([^>]*>)", "",$order_status);
		$order_status=str_replace(",", ",",$order_status);
		$order_status=str_replace("'", '"',$order_status);
		$order_status_acc=trim(@$_POST["order_status_acc"]);
		$order_status_acc=str_replace("/(<\/?)(p)([^>]*>)", "",$order_status_acc);
		$order_status_acc=str_replace(",", ",",$order_status_acc);
		$order_status_acc=str_replace("'", '"',$order_status_acc);
		$result = $this->m_master_order_beli->master_order_beli_update($order_id, $order_no, $order_supplier, $order_tanggal, $order_carabayar, $order_diskon, $order_cashback, $order_biaya, $order_bayar, $order_keterangan, $order_status, $order_status_acc);
		echo $result;
	}
	
	//function for create new record
	function master_order_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_cashback=trim(@$_POST["order_cashback"]);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$order_status=trim(@$_POST["order_status"]);
		$order_status=str_replace("/(<\/?)(p)([^>]*>)", "",$order_status);
		$order_status=str_replace("'", '"',$order_status);
		$order_status_acc=trim(@$_POST["order_status_acc"]);
		$order_status_acc=str_replace("/(<\/?)(p)([^>]*>)", "",$order_status_acc);
		$order_status_acc=str_replace("'", '"',$order_status_acc);
		$result=$this->m_master_order_beli->master_order_beli_create($order_no, $order_supplier, $order_tanggal, $order_carabayar, $order_diskon, $order_cashback, $order_biaya, $order_bayar, $order_keterangan, $order_status, $order_status_acc);
		echo $result;
	}

	//function for delete selected record
	function master_order_beli_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_order_beli->master_order_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_order_beli_search(){
		//POST varibale here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_tanggal_akhir=trim(@$_POST["order_tanggal_akhir"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
//		$order_diskon=trim(@$_POST["order_diskon"]);
//		$order_cashback=trim(@$_POST["order_cashback"]);
//		$order_biaya=trim(@$_POST["order_biaya"]);
//		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$order_status=trim(@$_POST["order_status"]);
		$order_status=str_replace("/(<\/?)(p)([^>]*>)", "",$order_status);
		$order_status=str_replace("'", '"',$order_status);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_master_order_beli->master_order_beli_search($order_id ,$order_no ,$order_supplier ,$order_tanggal, $order_tanggal_akhir, $order_carabayar, /*$order_diskon, $order_cashback ,$order_biaya ,$order_bayar ,*/ $order_keterangan, $order_status, $start,$end);
		echo $result;
	}


	function master_order_beli_print(){
  		//POST varibale here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_cashback=trim(@$_POST["order_cashback"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_master_order_beli->master_order_beli_print($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon,$order_cashback ,$order_biaya ,$order_bayar ,$order_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_order_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Cetak Pesanan Pembelian</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Daftar Pesanan Pembelian'><caption>Daftar Pesanan Pembelian</caption>
			   <thead>
			   <tr>
			   		<th scope='col'>Tanggal</th>
					<th scope='col'>No Pesanan</th>
					<th scope='col'>Supplier</th>
					<th scope='col'>Jumlah Item</th>
					<th scope='col'>Sub Total</th>
					<th scope='col'>Diskon (%)</th>
					<th scope='col'>Diskon (Rp)</th>
					<th scope='col'>Biaya</th>
					<th scope='col'>Total Nilai</th>
					<th scope='col'>Uang Muka</th>
					<th scope='col'>Cara Bayar</th>
				</tr>
				</thead>
				<tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Pesanan Pembelian </td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['order_tanggal']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['order_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['supplier_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jumlah_barang']);
				fwrite($file,"</td><td align='right'  class='numeric'>");
				fwrite($file, number_format($data['total_nilai']));
				fwrite($file,"</td><td align='right' class='numeric'>");
				fwrite($file, $data['order_diskon']);
				fwrite($file,"</td><td align='right' class='numeric'>");
				fwrite($file, number_format($data['order_cashback']));
				fwrite($file,"</td><td align='right' class='numeric'>");
				fwrite($file, number_format($data['order_biaya']));
				fwrite($file,"</td><td align='right' class='numeric'>");
				fwrite($file, number_format($data['total_nilai']+$data['order_biaya']-$data['order_cashback']-($data['order_diskon']*$data['total_nilai']/100)));
				fwrite($file,"</td><td align='right' class='numeric'>");
				fwrite($file, number_format($data['order_bayar']));
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_carabayar']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_order_beli_export_excel(){
		//POST varibale here
		$order_id=trim(@$_POST["order_id"]);
		$order_no=trim(@$_POST["order_no"]);
		$order_no=str_replace("/(<\/?)(p)([^>]*>)", "",$order_no);
		$order_no=str_replace("'", '"',$order_no);
		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_tanggal=trim(@$_POST["order_tanggal"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_carabayar=str_replace("/(<\/?)(p)([^>]*>)", "",$order_carabayar);
		$order_carabayar=str_replace("'", '"',$order_carabayar);
		$order_diskon=trim(@$_POST["order_diskon"]);
		$order_cashback=trim(@$_POST["order_cashback"]);
		$order_biaya=trim(@$_POST["order_biaya"]);
		$order_bayar=trim(@$_POST["order_bayar"]);
		$order_keterangan=trim(@$_POST["order_keterangan"]);
		$order_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$order_keterangan);
		$order_keterangan=str_replace("'", '"',$order_keterangan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_master_order_beli->master_order_beli_export_excel($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon, $order_cashback ,$order_biaya ,$order_bayar ,$order_keterangan ,$option,$filter);
		
		to_excel($query,"master_order_beli"); 
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