<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: perawatan Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_perawatan.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:26:32
	
*/

//class of perawatan
class C_perawatan extends Controller {

	//constructor
	function C_perawatan(){
		parent::Controller();
		$this->load->model('m_perawatan', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_perawatan');
	}
	
	function get_jenis_perawatan_list(){
		$result=$this->m_public_function->get_jenis_perawatan_list();
		echo $result;
	}
	
	/*function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : $_GET['query'];
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_produk_list($query, $start, $end);
		echo $result;
	}*/
	
	function get_produk_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : $_GET['query'];
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_perawatan->get_produk_list($query, $start, $end);
		echo $result;
	}
	
	function get_alat_list(){
		$result=$this->m_public_function->get_alat_list();
		echo $result;
	}
	
	/*function get_satuan_list(){
		$result=$this->m_public_function->get_satuan_list();
		echo $result;
	}*/
	function get_satuan_list(){
		$task = isset($_POST['task']) ? @$_POST['task'] : @$_GET['task'];
		$selected_id = isset($_POST['selected_id']) ? @$_POST['selected_id'] : @$_GET['selected_id'];
		$master_id = (integer) (isset($_POST['master_id']) ? @$_POST['master_id'] : @$_GET['master_id']);
		
		if($task=='detail')
			$result=$this->m_perawatan->get_satuan_detail_list($master_id);
		elseif($task=='produk')
			$result=$this->m_perawatan->get_satuan_produk_list($selected_id);
		elseif($task=='selected')
			$result=$this->m_perawatan->get_satuan_selected_list($selected_id);
			
		echo $result;
	}
	
	function get_group_list(){
		$result=$this->m_public_function->get_group_list();
		echo $result;
	}
	
	function get_group_perawatan_list(){
		$result=$this->m_public_function->get_group_perawatan_list();
		echo $result;
	}
	
	function get_kategori_perawatan_list(){
		$result=$this->m_public_function->get_kategori_perawatan_list();
		echo $result;
	}
	
	function get_gudang_list(){
		$result=$this->m_public_function->get_gudang_list();
		echo $result;
	}
	
	function get_kontribusi_rawat_list(){
		$result=$this->m_perawatan->get_kontribusi_rawat_list();
		echo $result;
	}
	
	//for detail action
	//list detail handler action
	function  detail_perawatan_konsumsi_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_perawatan->detail_perawatan_konsumsi_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//list detail handler action
	function  detail_perawatan_alat_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_perawatan->detail_perawatan_alat_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_perawatan_konsumsi_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_perawatan->detail_perawatan_konsumsi_purge($master_id);
		echo $result;
	}
	//eof
	
	//purge all detail
	function detail_perawatan_alat_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_perawatan->detail_perawatan_alat_purge($master_id);
		echo $result;
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_perawatan->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_perawatan_konsumsi_insert(){
	//POST variable here
		$krawat_id=trim(@$_POST["krawat_id"]);
		$krawat_master=trim(@$_POST["krawat_master"]);
		$krawat_produk=trim(@$_POST["krawat_produk"]);
		$krawat_satuan=trim(@$_POST["krawat_satuan"]);
		$krawat_jumlah=trim(@$_POST["krawat_jumlah"]);
		$result=$this->m_perawatan->detail_perawatan_konsumsi_insert($krawat_id ,$krawat_master ,$krawat_produk ,$krawat_satuan ,$krawat_jumlah );
		echo $result;
	}
	
	//add detail
	function detail_perawatan_alat_insert(){
	//POST variable here
		$arawat_id=trim(@$_POST["arawat_id"]);
		$arawat_master=trim(@$_POST["arawat_master"]);
		$arawat_alat=trim(@$_POST["arawat_alat"]);
		$arawat_jumlah=trim(@$_POST["arawat_jumlah"]);
		$result=$this->m_perawatan->detail_perawatan_alat_insert($arawat_id ,$arawat_master ,$arawat_alat,$arawat_jumlah );
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->perawatan_list();
				break;
			case "UPDATE":
				$this->perawatan_update();
				break;
			case "CREATE":
				$this->perawatan_create();
				break;
			case "DELETE":
				$this->perawatan_delete();
				break;
			case "SEARCH":
				$this->perawatan_search();
				break;
			case "PRINT":
				$this->perawatan_print();
				break;
			case "EXCEL":
				$this->perawatan_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function perawatan_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$query = str_replace(" ", "%",$query);
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_perawatan->perawatan_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function perawatan_update(){
		//POST variable here
		$rawat_id=trim(@$_POST["rawat_id"]);
		$rawat_kode=trim(@$_POST["rawat_kode"]);
		$rawat_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kode);
		$rawat_kode=str_replace(",", ",",$rawat_kode);
		$rawat_kode=str_replace("'", '"',$rawat_kode);
		$rawat_kodelama=trim(@$_POST["rawat_kodelama"]);
		$rawat_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kodelama);
		$rawat_kodelama=str_replace(",", ",",$rawat_kodelama);
		$rawat_kodelama=str_replace("'", '"',$rawat_kodelama);
		$rawat_nama=trim(@$_POST["rawat_nama"]);
		$rawat_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_nama);
		$rawat_nama=str_replace(",", ",",$rawat_nama);
		$rawat_nama=str_replace("'", '"',$rawat_nama);
		$rawat_group=trim(@$_POST["rawat_group"]);
		$rawat_kategori=trim(@$_POST["rawat_kategori"]);
		$rawat_kontribusi=trim(@$_POST["rawat_kontribusi"]);
		$rawat_jenis=trim(@$_POST["rawat_jenis"]);
		$rawat_keterangan=trim(@$_POST["rawat_keterangan"]);
		$rawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_keterangan);
		$rawat_keterangan=str_replace(",", ",",$rawat_keterangan);
		$rawat_keterangan=str_replace("'", '"',$rawat_keterangan);
		$rawat_du=trim(@$_POST["rawat_du"]);
		$rawat_dm=trim(@$_POST["rawat_dm"]);
		$rawat_point=trim(@$_POST["rawat_point"]);
		$rawat_kredit=trim(@$_POST["rawat_kredit"]);
		$rawat_jumlah_tindakan=trim(@$_POST["rawat_jumlah_tindakan"]);
		$rawat_harga=trim(@$_POST["rawat_harga"]);
		$rawat_gudang=trim(@$_POST["rawat_gudang"]);
		$rawat_aktif=trim(@$_POST["rawat_aktif"]);
		$rawat_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_aktif);
		$rawat_aktif=str_replace(",", ",",$rawat_aktif);
		$rawat_aktif=str_replace("'", '"',$rawat_aktif);
		$result = $this->m_perawatan->perawatan_update($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori, $rawat_kontribusi ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point , $rawat_kredit, $rawat_jumlah_tindakan, $rawat_harga ,$rawat_gudang ,$rawat_aktif      );
		echo $result;
	}
	
	//function for create new record
	function perawatan_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$rawat_kode=trim(@$_POST["rawat_kode"]);
		$rawat_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kode);
		$rawat_kode=str_replace("'", '"',$rawat_kode);
		$rawat_kodelama=trim(@$_POST["rawat_kodelama"]);
		$rawat_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kodelama);
		$rawat_kodelama=str_replace("'", '"',$rawat_kodelama);
		$rawat_nama=trim(@$_POST["rawat_nama"]);
		$rawat_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_nama);
		$rawat_nama=str_replace("'", '"',$rawat_nama);
		$rawat_group=trim(@$_POST["rawat_group"]);
		$rawat_kategori=trim(@$_POST["rawat_kategori"]);
		$rawat_kontribusi=trim(@$_POST["rawat_kontribusi"]);
		$rawat_jenis=trim(@$_POST["rawat_jenis"]);
		$rawat_keterangan=trim(@$_POST["rawat_keterangan"]);
		$rawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_keterangan);
		$rawat_keterangan=str_replace("'", '"',$rawat_keterangan);
		$rawat_du=trim(@$_POST["rawat_du"]);
		$rawat_dm=trim(@$_POST["rawat_dm"]);
		$rawat_point=trim(@$_POST["rawat_point"]);
		$rawat_kredit=trim(@$_POST["rawat_kredit"]);
		$rawat_jumlah_tindakan=trim(@$_POST["rawat_jumlah_tindakan"]);
		$rawat_harga=trim(@$_POST["rawat_harga"]);
		$rawat_gudang=trim(@$_POST["rawat_gudang"]);
		$rawat_aktif=trim(@$_POST["rawat_aktif"]);
		$rawat_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_aktif);
		$rawat_aktif=str_replace("'", '"',$rawat_aktif);
		$result=$this->m_perawatan->perawatan_create($rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori, $rawat_kontribusi ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point, $rawat_kredit, $rawat_jumlah_tindakan, $rawat_harga ,$rawat_gudang ,$rawat_aktif );
		echo $result;
	}

	//function for delete selected record
	function perawatan_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_perawatan->perawatan_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function perawatan_search(){
		//POST varibale here
		$rawat_id=trim(@$_POST["rawat_id"]);
		$rawat_kode=trim(@$_POST["rawat_kode"]);
		$rawat_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kode);
		$rawat_kode=str_replace("'", '"',$rawat_kode);
		$rawat_kodelama=trim(@$_POST["rawat_kodelama"]);
		$rawat_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kodelama);
		$rawat_kodelama=str_replace("'", '"',$rawat_kodelama);
		$rawat_nama=trim(@$_POST["rawat_nama"]);
		$rawat_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_nama);
		$rawat_nama=str_replace("'", '"',$rawat_nama);
		$rawat_group=trim(@$_POST["rawat_group"]);
		$rawat_kategori=trim(@$_POST["rawat_kategori"]);
		$rawat_jenis=trim(@$_POST["rawat_jenis"]);
		$rawat_keterangan=trim(@$_POST["rawat_keterangan"]);
		$rawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_keterangan);
		$rawat_keterangan=str_replace("'", '"',$rawat_keterangan);
		$rawat_du=trim(@$_POST["rawat_du"]);
		$rawat_dm=trim(@$_POST["rawat_dm"]);
		$rawat_point=trim(@$_POST["rawat_point"]);
		$rawat_kredit=trim(@$_POST["rawat_kredit"]);
		$rawat_jumlah_tindakan=trim(@$_POST["rawat_jumlah_tindakan"]);
		$rawat_harga=trim(@$_POST["rawat_harga"]);
		$rawat_gudang=trim(@$_POST["rawat_gudang"]);
		$rawat_aktif=trim(@$_POST["rawat_aktif"]);
		$rawat_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_aktif);
		$rawat_aktif=str_replace("'", '"',$rawat_aktif);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_perawatan->perawatan_search($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point , $rawat_kredit, $rawat_jumlah_tindakan, $rawat_harga ,$rawat_gudang ,$rawat_aktif ,$start,$end);
		echo $result;
	}


	function perawatan_print(){
  		//POST varibale here
		$rawat_id=trim(@$_POST["rawat_id"]);
		$rawat_kode=trim(@$_POST["rawat_kode"]);
		$rawat_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kode);
		$rawat_kode=str_replace("'", '"',$rawat_kode);
		$rawat_kodelama=trim(@$_POST["rawat_kodelama"]);
		$rawat_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kodelama);
		$rawat_kodelama=str_replace("'", '"',$rawat_kodelama);
		$rawat_nama=trim(@$_POST["rawat_nama"]);
		$rawat_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_nama);
		$rawat_nama=str_replace("'", '"',$rawat_nama);
		$rawat_group=trim(@$_POST["rawat_group"]);
		$rawat_kategori=trim(@$_POST["rawat_kategori"]);
		$rawat_jenis=trim(@$_POST["rawat_jenis"]);
		$rawat_keterangan=trim(@$_POST["rawat_keterangan"]);
		$rawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_keterangan);
		$rawat_keterangan=str_replace("'", '"',$rawat_keterangan);
		$rawat_du=trim(@$_POST["rawat_du"]);
		$rawat_dm=trim(@$_POST["rawat_dm"]);
		$rawat_point=trim(@$_POST["rawat_point"]);
		$rawat_kredit=trim(@$_POST["rawat_kredit"]);
		$rawat_jumlah_tindakan=trim(@$_POST["rawat_jumlah_tindakan"]);
		$rawat_harga=trim(@$_POST["rawat_harga"]);
		$rawat_gudang=trim(@$_POST["rawat_gudang"]);
		$rawat_aktif=trim(@$_POST["rawat_aktif"]);
		$rawat_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_aktif);
		$rawat_aktif=str_replace("'", '"',$rawat_aktif);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_perawatan->perawatan_print($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_kredit, $rawat_jumlah_tindakan, $rawat_harga ,$rawat_gudang ,$rawat_aktif ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=17;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("perawatanlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Perawatan Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Perawatan List'><caption>PERAWATAN</caption><thead><tr><th scope='col'>Rawat Id</th><th scope='col'>Rawat Kode</th><th scope='col'>Rawat Kode Lama</th><th scope='col'>Rawat Nama</th><th scope='col'>Rawat Group</th><th scope='col'>Rawat Kategori</th><th scope='col'>Rawat Jenis</th><th scope='col'>Rawat Keterangan</th><th scope='col'>Rawat Du</th><th scope='col'>Rawat Dm</th><th scope='col'>Rawat Point</th><th scope='col'>Rawat Harga</th><th scope='col'>Rawat Gudang</th><th scope='col'>Rawat Aktif</th><th scope='col'>Rawat Creator</th><th scope='col'>Rawat Date Create</th><th scope='col'>Rawat Update</th><th scope='col'>Rawat Date Update</th><th scope='col'>Rawat Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Perawatan</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['rawat_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['rawat_kode']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_kodelama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_group']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_kategori']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_jenis']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_du']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_dm']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_point']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_kredit']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_jumlah_tindakan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_harga']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_gudang']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rawat_aktif']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rawat_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rawat_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rawat_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rawat_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['rawat_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function perawatan_export_excel(){
		//POST varibale here
		$rawat_id=trim(@$_POST["rawat_id"]);
		$rawat_kode=trim(@$_POST["rawat_kode"]);
		$rawat_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kode);
		$rawat_kode=str_replace("'", '"',$rawat_kode);
		$rawat_kodelama=trim(@$_POST["rawat_kodelama"]);
		$rawat_kodelama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_kodelama);
		$rawat_kodelama=str_replace("'", '"',$rawat_kodelama);
		$rawat_nama=trim(@$_POST["rawat_nama"]);
		$rawat_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_nama);
		$rawat_nama=str_replace("'", '"',$rawat_nama);
		$rawat_group=trim(@$_POST["rawat_group"]);
		$rawat_kategori=trim(@$_POST["rawat_kategori"]);
		$rawat_jenis=trim(@$_POST["rawat_jenis"]);
		$rawat_keterangan=trim(@$_POST["rawat_keterangan"]);
		$rawat_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_keterangan);
		$rawat_keterangan=str_replace("'", '"',$rawat_keterangan);
		$rawat_du=trim(@$_POST["rawat_du"]);
		$rawat_dm=trim(@$_POST["rawat_dm"]);
		$rawat_point=trim(@$_POST["rawat_point"]);
		$rawat_kredit=trim(@$_POST["rawat_kredit"]);
		$rawat_jumlah_tindakan=trim(@$_POST["rawat_jumlah_tindakan"]);
		$rawat_harga=trim(@$_POST["rawat_harga"]);
		$rawat_gudang=trim(@$_POST["rawat_gudang"]);
		$rawat_aktif=trim(@$_POST["rawat_aktif"]);
		$rawat_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$rawat_aktif);
		$rawat_aktif=str_replace("'", '"',$rawat_aktif);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_perawatan->perawatan_export_excel($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_kredit, $rawat_jumlah_tindakan, $rawat_harga ,$rawat_gudang ,$rawat_aktif ,$option,$filter);
		
		to_excel($query,"perawatan"); 
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