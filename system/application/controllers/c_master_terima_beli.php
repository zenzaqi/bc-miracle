<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: master_terima_beli Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_master_terima_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:44:15
	
*/

//class of master_terima_beli
class C_master_terima_beli extends Controller {

	//constructor
	function C_master_terima_beli(){
		parent::Controller();
		$this->load->model('m_master_terima_beli', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_master_terima_beli');
		$this->load->plugin('to_excel');
	}
	
	function laporan(){
		$this->load->view('main/v_lap_terima_beli');
	}
	
	function print_faktur(){
		
		$faktur=(isset($_POST['faktur']) ? @$_POST['faktur'] : @$_GET['faktur']);
		$opsi="faktur";
		$data["data_print"]=$this->m_master_terima_beli->get_laporan("","","",$opsi,"",$faktur);
		$print_view=$this->load->view("main/p_penerimaan_barang.php",$data,TRUE);
		
		if(!file_exists("print")){
			mkdir("print");
		}
		
		$print_file=fopen("print/master_terima_faktur.html","w+");
		
		fwrite($print_file, $print_view);
		echo '1'; 
		
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
		
		$data["data_print"]=$this->m_master_terima_beli->get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group,"");
		if($opsi=='rekap'){
				
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_rekap_terima_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_rekap_terima_supplier.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_rekap_terima.php",$data,TRUE);break;
			}
			
		}else{
			switch($group){
				case "Tanggal": $print_view=$this->load->view("main/p_detail_terima_tanggal.php",$data,TRUE);break;
				case "Supplier": $print_view=$this->load->view("main/p_detail_terima_supplier.php",$data,TRUE);break;
				case "Produk": $print_view=$this->load->view("main/p_detail_terima_produk.php",$data,TRUE);break;
				default: $print_view=$this->load->view("main/p_detail_terima.php",$data,TRUE);break;
			}
		}
		
		if(!file_exists("print")){
			mkdir("print");
		}
		if($opsi=='rekap')
			$print_file=fopen("print/report_terimabeli.html","w+");
		else
			$print_file=fopen("print/report_terimabeli.html","w+");
			
		fwrite($print_file, $print_view);
		echo '1'; 
	}
	
	
	function get_order_beli_detail_by_order_id(){
		$orderid = isset($_POST['orderid']) ? @$_POST['orderid'] : "";
		$result=$this->m_public_function->get_order_beli_detail_by_order_id($orderid);
		echo $result;
	}
	

	function get_produk_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$order_id = isset($_POST['order_id']) ? @$_POST['order_id'] : @$_GET['order_id'];
		if($task=='detail')
			$result=$this->m_master_terima_beli->get_produk_detail_list($master_id,$query,$start,$end);
		elseif($task=='list')
			$result=$this->m_master_terima_beli->get_produk_all_list($query,$start,$end);
		elseif($task=='selected')
			$result=$this->m_master_terima_beli->get_produk_selected_list($master_id, $selected_id,$query,$start,$end);
		elseif($task=='order')
			$result=$this->m_master_terima_beli->get_produk_order_list($order_id,$query,$start,$end);
		echo $result;
	}
	
	function get_satuan_list(){
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		
		if($task=='detail')
			$result=$this->m_master_terima_beli->get_satuan_detail_list($master_id);
		elseif($task=='produk')
			$result=$this->m_master_terima_beli->get_satuan_produk_list($selected_id);
		elseif($task=='selected')
			$result=$this->m_master_terima_beli->get_satuan_selected_list($selected_id);
			
		echo $result;
	}
	
	function get_bonus_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		if($task=='detail')
			$result=$this->m_master_terima_beli->get_bonus_detail_list($master_id,$query,$start,$end);
		elseif($task=='list')
			$result=$this->m_master_terima_beli->get_produk_all_list($query,$start,$end);
		elseif($task=='selected')
			$result=$this->m_master_terima_beli->get_produk_selected_list($selected_id,$query,$start,$end);
		echo $result;
	}
	
	
	function get_order_beli_list(){
		$result=$this->m_master_terima_beli->get_order_beli_list();
		echo $result;
	}
	
	function get_order_beli_search_list(){
		$result=$this->m_master_terima_beli->get_order_beli_search_list();
		echo $result;
	}
	
	function get_produk_detail_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_terima_beli->get_produk_detail_list($master_id,$query,$start,$end);
		echo $result;
	}
	
	function get_dorder_satuan_by_produkorder(){
		$dorder_master = trim(@$_POST["master_order_id"]);
		$dorder_produk = trim(@$_POST["dorder_produk_id"]);
		$result=$this->m_master_terima_beli->get_dorder_satuan_by_produkorder($dorder_master, $dorder_produk);
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_terima_bonus_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_bonus_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_terima_bonus_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_bonus_purge($master_id);
		echo $result;
	}
	//eof
	
	//add detail
	function detail_detail_terima_bonus_insert(){
	//POST variable here
		$dtbonus_id=trim(@$_POST["dtbonus_id"]);
		$dtbonus_master=trim(@$_POST["dtbonus_master"]);
		$dtbonus_produk=trim(@$_POST["dtbonus_produk"]);
		$dtbonus_satuan=trim(@$_POST["dtbonus_satuan"]);
		$dtbonus_jumlah=trim(@$_POST["dtbonus_jumlah"]);
		$result=$this->m_master_terima_beli->detail_detail_terima_bonus_insert($dtbonus_id ,$dtbonus_master ,$dtbonus_produk ,$dtbonus_satuan ,$dtbonus_jumlah );
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_detail_terima_beli_list(){
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_beli_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_detail_terima_beli_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$result=$this->m_master_terima_beli->detail_detail_terima_beli_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_master_terima_beli->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_detail_terima_beli_insert(){
	//POST variable here
		$dterima_id=trim(@$_POST["dterima_id"]);
		$dterima_master=trim(@$_POST["dterima_master"]);
		$dterima_produk=trim(@$_POST["dterima_produk"]);
		$dterima_satuan=trim(@$_POST["dterima_satuan"]);
		$dterima_jumlah=trim(@$_POST["dterima_jumlah"]);
		$result=$this->m_master_terima_beli->detail_detail_terima_beli_insert($dterima_id ,$dterima_master ,$dterima_produk ,$dterima_satuan ,$dterima_jumlah );
		echo $result;
	}
	
	
	//event handler action
	function get_action(){
		$task = @$_POST['task'];
		switch($task){
			case "LIST":
				$this->master_terima_beli_list();
				break;
			case "UPDATE":
				$this->master_terima_beli_update();
				break;
			case "CREATE":
				$this->master_terima_beli_create();
				break;
			case "DELETE":
				$this->master_terima_beli_delete();
				break;
			case "SEARCH":
				$this->master_terima_beli_search();
				break;
			case "PRINT":
				$this->master_terima_beli_print();
				break;
			case "EXCEL":
				$this->master_terima_beli_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	function check_all_order_done(){
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		$this->m_master_terima_beli->check_all_order_done($master_id);
	}
	
	//function fot list record
	function master_terima_beli_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] :@$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_master_terima_beli->master_terima_beli_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function master_terima_beli_update(){
		//POST variable here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace(",", ",",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace(",", ",",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace(",", ",",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace(",", ",",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$terima_status=trim(@$_POST["terima_status"]);
		$terima_status=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_status);
		$terima_status=str_replace(",", ",",$terima_status);
		$terima_status=str_replace("'", '"',$terima_status);
		$result = $this->m_master_terima_beli->master_terima_beli_update($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan, $terima_status  );
		echo $result;
	}
	
	//function for create new record
	function master_terima_beli_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$terima_status=trim(@$_POST["terima_status"]);
		$terima_status=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_status);
		$terima_status=str_replace("'", '"',$terima_status);
		
		$result=$this->m_master_terima_beli->master_terima_beli_create($terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan, $terima_status);
		echo $result;
	}

	//function for delete selected record
	function master_terima_beli_delete(){
		$ids = @$_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_master_terima_beli->master_terima_beli_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function master_terima_beli_search(){
		//POST varibale here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$terima_status=trim(@$_POST["terima_status"]);
		$terima_status=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_status);
		$terima_status=str_replace("'", '"',$terima_status);
		
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result = $this->m_master_terima_beli->master_terima_beli_search($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$terima_status, $start,$end);
		echo $result;
	}


	function master_terima_beli_print(){
  		//POST varibale here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$option=@$_POST['currentlisting'];
		$filter=@$_POST["query"];
		
		$result = $this->m_master_terima_beli->master_terima_beli_print($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=7;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("master_terima_belilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Cetak Daftar Penerimaan Barang</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Daftar Penerimaan Barang'><caption>Daftar Penerimaan Barang</caption>
			   <thead><tr>
			   		<th scope='col'>Tanggal</th>
					<th scope='col'>No Penerimaan</th>
					<th scope='col'>No Pesanan</th>
					<th scope='col'>Supplier</th>
					<th scope='col'>Jumlah Item</th>
					<th scope='col'>Jumlah Item Bonus</th>
					<th scope='col'>No Surat Jalan</th>
					<th scope='col'>Pengirim</th>
				</tr></thead>
				<tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Penerimaan Barang</td></tr></tfoot><tbody>");
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
				fwrite($file, $data['order_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['supplier_nama']);
				fwrite($file,"</td><td class='numeric'>");
				fwrite($file, $data['jumlah_barang']);
				fwrite($file,"</td><td class='numeric'>");
				fwrite($file, $data['jumlah_barang_bonus']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_surat_jalan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_pengirim']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function master_terima_beli_export_excel(){
		//POST varibale here
		$terima_id=trim(@$_POST["terima_id"]);
		$terima_no=trim(@$_POST["terima_no"]);
		$terima_no=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_no);
		$terima_no=str_replace("'", '"',$terima_no);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_surat_jalan=trim(@$_POST["terima_surat_jalan"]);
		$terima_surat_jalan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_surat_jalan);
		$terima_surat_jalan=str_replace("'", '"',$terima_surat_jalan);
		$terima_pengirim=trim(@$_POST["terima_pengirim"]);
		$terima_pengirim=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_pengirim);
		$terima_pengirim=str_replace("'", '"',$terima_pengirim);
		$terima_tanggal=trim(@$_POST["terima_tanggal"]);
		$terima_keterangan=trim(@$_POST["terima_keterangan"]);
		$terima_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$terima_keterangan);
		$terima_keterangan=str_replace("'", '"',$terima_keterangan);
		$option=@$_POST['currentlisting'];
		$filter=@$_POST["query"];
		
		$query = $this->m_master_terima_beli->master_terima_beli_export_excel($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$option,$filter);
		
		to_excel($query,"master_terima_beli"); 
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