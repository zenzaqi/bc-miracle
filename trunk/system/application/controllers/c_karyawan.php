<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: karyawan Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_karyawan.php
 	+ Author  		: Mukhlison
 	+ Created on 06/Aug/2009 17:08:43
	
*/

//class of karyawan
class C_karyawan extends Controller {

	//constructor
	function C_karyawan(){
		parent::Controller();
		$this->load->model('m_karyawan', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_karyawan');
	}
	
	function get_karyawan_jabatan_list(){
		$result=$this->m_karyawan->get_karyawan_jabatan_list();
		echo $result;
	}
	
	function get_karyawan_atasan_list(){
		$karyawan_id = trim(@$_POST["karyawan_id"]);
		
		$result=$this->m_karyawan->get_karyawan_atasan_list($karyawan_id);
		echo $result;
	}
	
	
	function get_karyawan_cabang_list(){
		$result=$this->m_karyawan->get_karyawan_cabang_list();
		echo $result;
	}
	
	function get_karyawan_departemen_list(){
		$result=$this->m_karyawan->get_karyawan_departemen_list();
		echo $result;
	}
	
	function get_karyawan_golongan_list(){
		$result=$this->m_karyawan->get_karyawan_golongan_list();
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->karyawan_list();
				break;
			case "UPDATE":
				$this->karyawan_update();
				break;
			case "CREATE":
				$this->karyawan_create();
				break;
			case "DELETE":
				$this->karyawan_delete();
				break;
			case "SEARCH":
				$this->karyawan_search();
				break;
			case "PRINT":
				$this->karyawan_print();
				break;
			case "EXCEL":
				$this->karyawan_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function karyawan_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_karyawan->karyawan_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function karyawan_update(){
		//POST variable here
		$karyawan_id=trim(@$_POST["karyawan_id"]);
		$karyawan_no=trim(@$_POST["karyawan_no"]);
		$karyawan_no=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_no);
		$karyawan_no=str_replace(",", ",",$karyawan_no);
		$karyawan_no=str_replace("'", '"',$karyawan_no);
		$karyawan_npwp=trim(@$_POST["karyawan_npwp"]);
		$karyawan_npwp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_npwp);
		$karyawan_npwp=str_replace(",", ",",$karyawan_npwp);
		$karyawan_npwp=str_replace("'", '"',$karyawan_npwp);
		$karyawan_username=trim(@$_POST["karyawan_username"]);
		$karyawan_username=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_username);
		$karyawan_username=str_replace(",", ",",$karyawan_username);
		$karyawan_username=str_replace("'", '"',$karyawan_username);
		$karyawan_nama=trim(@$_POST["karyawan_nama"]);
		$karyawan_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_nama);
		$karyawan_nama=str_replace(",", ",",$karyawan_nama);
		$karyawan_nama=str_replace("'", '"',$karyawan_nama);
		$karyawan_kelamin=trim(@$_POST["karyawan_kelamin"]);
		$karyawan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kelamin);
		$karyawan_kelamin=str_replace(",", ",",$karyawan_kelamin);
		$karyawan_kelamin=str_replace("'", '"',$karyawan_kelamin);
		$karyawan_tgllahir=trim(@$_POST["karyawan_tgllahir"]);
		$karyawan_alamat=trim(@$_POST["karyawan_alamat"]);
		$karyawan_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_alamat);
		$karyawan_alamat=str_replace(",", ",",$karyawan_alamat);
		$karyawan_alamat=str_replace("'", '"',$karyawan_alamat);
		$karyawan_kota=trim(@$_POST["karyawan_kota"]);
		$karyawan_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kota);
		$karyawan_kota=str_replace(",", ",",$karyawan_kota);
		$karyawan_kota=str_replace("'", '"',$karyawan_kota);
		$karyawan_kodepos=trim(@$_POST["karyawan_kodepos"]);
		$karyawan_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kodepos);
		$karyawan_kodepos=str_replace(",", ",",$karyawan_kodepos);
		$karyawan_kodepos=str_replace("'", '"',$karyawan_kodepos);
		$karyawan_email=trim(@$_POST["karyawan_email"]);
		$karyawan_email=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_email);
		$karyawan_email=str_replace(",", ",",$karyawan_email);
		$karyawan_email=str_replace("'", '"',$karyawan_email);
		$karyawan_emiracle=trim(@$_POST["karyawan_emiracle"]);
		$karyawan_emiracle=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_emiracle);
		$karyawan_emiracle=str_replace(",", ",",$karyawan_emiracle);
		$karyawan_emiracle=str_replace("'", '"',$karyawan_emiracle);
		$karyawan_keterangan=trim(@$_POST["karyawan_keterangan"]);
		$karyawan_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_keterangan);
		$karyawan_keterangan=str_replace(",", ",",$karyawan_keterangan);
		$karyawan_keterangan=str_replace("'", '"',$karyawan_keterangan);
		$karyawan_notelp=trim(@$_POST["karyawan_notelp"]);
		$karyawan_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp);
		$karyawan_notelp=str_replace(",", ",",$karyawan_notelp);
		$karyawan_notelp=str_replace("'", '"',$karyawan_notelp);
		$karyawan_notelp2=trim(@$_POST["karyawan_notelp2"]);
		$karyawan_notelp2=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp2);
		$karyawan_notelp2=str_replace(",", ",",$karyawan_notelp2);
		$karyawan_notelp2=str_replace("'", '"',$karyawan_notelp2);
		$karyawan_notelp3=trim(@$_POST["karyawan_notelp3"]);
		$karyawan_notelp3=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp3);
		$karyawan_notelp3=str_replace(",", ",",$karyawan_notelp3);
		$karyawan_notelp3=str_replace("'", '"',$karyawan_notelp3);
		$karyawan_notelp4=trim(@$_POST["karyawan_notelp4"]);
		$karyawan_notelp4=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp4);
		$karyawan_notelp4=str_replace(",", ",",$karyawan_notelp4);
		$karyawan_notelp4=str_replace("'", '"',$karyawan_notelp4);
		$karyawan_cabang=trim(@$_POST["karyawan_cabang"]);
		$karyawan_jabatan=trim(@$_POST["karyawan_jabatan"]);
		$karyawan_departemen=trim(@$_POST["karyawan_departemen"]);
		$karyawan_golongantxt=trim(@$_POST["karyawan_golongantxt"]);
		$karyawan_golongantxt=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_golongantxt);
		$karyawan_golongantxt=str_replace("'", '"',$karyawan_golongantxt);
		if($karyawan_golongantxt<>"")
			$karyawan_idgolongan=$karyawan_golongantxt;
		else 
			$karyawan_idgolongan=trim(@$_POST["karyawan_idgolongan"]);
		$karyawan_tglmasuk=trim(@$_POST["karyawan_tglmasuk"]);
		$karyawan_atasan=trim(@$_POST["karyawan_atasan"]);
		$karyawan_aktif=trim(@$_POST["karyawan_aktif"]);
		$karyawan_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_aktif);
		$karyawan_aktif=str_replace(",", ",",$karyawan_aktif);
		$karyawan_aktif=str_replace("'", '"',$karyawan_aktif);
		$karyawan_creator=trim(@$_POST["karyawan_creator"]);
		$karyawan_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_creator);
		$karyawan_creator=str_replace(",", ",",$karyawan_creator);
		$karyawan_creator=str_replace("'", '"',$karyawan_creator);
		$karyawan_date_create=trim(@$_POST["karyawan_date_create"]);
		$karyawan_update=trim(@$_POST["karyawan_update"]);
		$karyawan_update=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_update);
		$karyawan_update=str_replace(",", ",",$karyawan_update);
		$karyawan_update=str_replace("'", '"',$karyawan_update);
		$karyawan_date_update=trim(@$_POST["karyawan_date_update"]);
		$karyawan_revised=trim(@$_POST["karyawan_revised"]);
		$result = $this->m_karyawan->karyawan_update($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised );
		echo $result;
	}
	
	//function for create new record
	function karyawan_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$karyawan_no=trim(@$_POST["karyawan_no"]);
		$karyawan_no=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_no);
		$karyawan_no=str_replace("'", '"',$karyawan_no);
		$karyawan_npwp=trim(@$_POST["karyawan_npwp"]);
		$karyawan_npwp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_npwp);
		$karyawan_npwp=str_replace("'", '"',$karyawan_npwp);
		$karyawan_username=trim(@$_POST["karyawan_username"]);
		$karyawan_username=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_username);
		$karyawan_username=str_replace("'", '"',$karyawan_username);
		$karyawan_nama=trim(@$_POST["karyawan_nama"]);
		$karyawan_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_nama);
		$karyawan_nama=str_replace("'", '"',$karyawan_nama);
		$karyawan_kelamin=trim(@$_POST["karyawan_kelamin"]);
		$karyawan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kelamin);
		$karyawan_kelamin=str_replace("'", '"',$karyawan_kelamin);
		$karyawan_tgllahir=trim(@$_POST["karyawan_tgllahir"]);
		$karyawan_alamat=trim(@$_POST["karyawan_alamat"]);
		$karyawan_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_alamat);
		$karyawan_alamat=str_replace("'", '"',$karyawan_alamat);
		$karyawan_kota=trim(@$_POST["karyawan_kota"]);
		$karyawan_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kota);
		$karyawan_kota=str_replace("'", '"',$karyawan_kota);
		$karyawan_kodepos=trim(@$_POST["karyawan_kodepos"]);
		$karyawan_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kodepos);
		$karyawan_kodepos=str_replace("'", '"',$karyawan_kodepos);
		$karyawan_email=trim(@$_POST["karyawan_email"]);
		$karyawan_email=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_email);
		$karyawan_email=str_replace("'", '"',$karyawan_email);
		$karyawan_emiracle=trim(@$_POST["karyawan_emiracle"]);
		$karyawan_emiracle=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_emiracle);
		$karyawan_emiracle=str_replace("'", '"',$karyawan_emiracle);
		$karyawan_keterangan=trim(@$_POST["karyawan_keterangan"]);
		$karyawan_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_keterangan);
		$karyawan_keterangan=str_replace("'", '"',$karyawan_keterangan);
		$karyawan_notelp=trim(@$_POST["karyawan_notelp"]);
		$karyawan_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp);
		$karyawan_notelp=str_replace("'", '"',$karyawan_notelp);
		$karyawan_notelp2=trim(@$_POST["karyawan_notelp2"]);
		$karyawan_notelp2=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp2);
		$karyawan_notelp2=str_replace("'", '"',$karyawan_notelp2);
		$karyawan_notelp3=trim(@$_POST["karyawan_notelp3"]);
		$karyawan_notelp3=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp3);
		$karyawan_notelp3=str_replace("'", '"',$karyawan_notelp3);
		$karyawan_notelp4=trim(@$_POST["karyawan_notelp4"]);
		$karyawan_notelp4=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp4);
		$karyawan_notelp4=str_replace(",", ",",$karyawan_notelp4);
		$karyawan_notelp4=str_replace("'", '"',$karyawan_notelp4);
		$karyawan_cabang=trim(@$_POST["karyawan_cabang"]);
		$karyawan_jabatan=trim(@$_POST["karyawan_jabatan"]);
		$karyawan_departemen=trim(@$_POST["karyawan_departemen"]);
		$karyawan_golongantxt=trim(@$_POST["karyawan_golongantxt"]);
		$karyawan_golongantxt=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_golongantxt);
		$karyawan_golongantxt=str_replace("'", '"',$karyawan_golongantxt);
		if($karyawan_golongantxt<>"")
			$karyawan_idgolongan=$karyawan_golongantxt;
		else 
			$karyawan_idgolongan=trim(@$_POST["karyawan_idgolongan"]);
		$karyawan_tglmasuk=trim(@$_POST["karyawan_tglmasuk"]);
		$karyawan_atasan=trim(@$_POST["karyawan_atasan"]);
		$karyawan_aktif=trim(@$_POST["karyawan_aktif"]);
		$karyawan_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_aktif);
		$karyawan_aktif=str_replace("'", '"',$karyawan_aktif);
		$karyawan_creator=trim(@$_POST["karyawan_creator"]);
		$karyawan_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_creator);
		$karyawan_creator=str_replace("'", '"',$karyawan_creator);
		$karyawan_date_create=trim(@$_POST["karyawan_date_create"]);
		$karyawan_update=trim(@$_POST["karyawan_update"]);
		$karyawan_update=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_update);
		$karyawan_update=str_replace("'", '"',$karyawan_update);
		$karyawan_date_update=trim(@$_POST["karyawan_date_update"]);
		$karyawan_revised=trim(@$_POST["karyawan_revised"]);
		$result=$this->m_karyawan->karyawan_create($karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised );
		echo $result;
	}

	//function for delete selected record
	function karyawan_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_karyawan->karyawan_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function karyawan_search(){
		//POST varibale here
		$karyawan_id=trim(@$_POST["karyawan_id"]);
		$karyawan_no=trim(@$_POST["karyawan_no"]);
		$karyawan_no=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_no);
		$karyawan_no=str_replace("'", '"',$karyawan_no);
		$karyawan_npwp=trim(@$_POST["karyawan_npwp"]);
		$karyawan_npwp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_npwp);
		$karyawan_npwp=str_replace("'", '"',$karyawan_npwp);
		$karyawan_username=trim(@$_POST["karyawan_username"]);
		$karyawan_username=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_username);
		$karyawan_username=str_replace("'", '"',$karyawan_username);
		$karyawan_nama=trim(@$_POST["karyawan_nama"]);
		$karyawan_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_nama);
		$karyawan_nama=str_replace("'", '"',$karyawan_nama);
		$karyawan_kelamin=trim(@$_POST["karyawan_kelamin"]);
		$karyawan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kelamin);
		$karyawan_kelamin=str_replace("'", '"',$karyawan_kelamin);
		$karyawan_tgllahir=trim(@$_POST["karyawan_tgllahir"]);
		$karyawan_alamat=trim(@$_POST["karyawan_alamat"]);
		$karyawan_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_alamat);
		$karyawan_alamat=str_replace("'", '"',$karyawan_alamat);
		$karyawan_kota=trim(@$_POST["karyawan_kota"]);
		$karyawan_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kota);
		$karyawan_kota=str_replace("'", '"',$karyawan_kota);
		$karyawan_kodepos=trim(@$_POST["karyawan_kodepos"]);
		$karyawan_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kodepos);
		$karyawan_kodepos=str_replace("'", '"',$karyawan_kodepos);
		$karyawan_email=trim(@$_POST["karyawan_email"]);
		$karyawan_email=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_email);
		$karyawan_email=str_replace("'", '"',$karyawan_email);
		$karyawan_emiracle=trim(@$_POST["karyawan_emiracle"]);
		$karyawan_emiracle=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_emiracle);
		$karyawan_emiracle=str_replace("'", '"',$karyawan_emiracle);
		$karyawan_keterangan=trim(@$_POST["karyawan_keterangan"]);
		$karyawan_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_keterangan);
		$karyawan_keterangan=str_replace("'", '"',$karyawan_keterangan);
		$karyawan_notelp=trim(@$_POST["karyawan_notelp"]);
		$karyawan_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp);
		$karyawan_notelp=str_replace("'", '"',$karyawan_notelp);
		$karyawan_notelp2=trim(@$_POST["karyawan_notelp2"]);
		$karyawan_notelp2=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp2);
		$karyawan_notelp2=str_replace("'", '"',$karyawan_notelp2);
		$karyawan_notelp3=trim(@$_POST["karyawan_notelp3"]);
		$karyawan_notelp3=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp3);
		$karyawan_notelp3=str_replace("'", '"',$karyawan_notelp3);
		$karyawan_notelp4=trim(@$_POST["karyawan_notelp4"]);
		$karyawan_notelp4=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp4);
		$karyawan_notelp4=str_replace(",", ",",$karyawan_notelp4);
		$karyawan_notelp4=str_replace("'", '"',$karyawan_notelp4);
		$karyawan_cabang=trim(@$_POST["karyawan_cabang"]);
		$karyawan_jabatan=trim(@$_POST["karyawan_jabatan"]);
		$karyawan_departemen=trim(@$_POST["karyawan_departemen"]);
		$karyawan_idgolongan=trim(@$_POST["karyawan_idgolongan"]);
		$karyawan_idgolongan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_idgolongan);
		$karyawan_idgolongan=str_replace("'", '"',$karyawan_idgolongan);
		$karyawan_tglmasuk=trim(@$_POST["karyawan_tglmasuk"]);
		$karyawan_atasan=trim(@$_POST["karyawan_atasan"]);
		$karyawan_aktif=trim(@$_POST["karyawan_aktif"]);
		$karyawan_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_aktif);
		$karyawan_aktif=str_replace("'", '"',$karyawan_aktif);
		$karyawan_creator=trim(@$_POST["karyawan_creator"]);
		$karyawan_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_creator);
		$karyawan_creator=str_replace("'", '"',$karyawan_creator);
		$karyawan_date_create=trim(@$_POST["karyawan_date_create"]);
		$karyawan_update=trim(@$_POST["karyawan_update"]);
		$karyawan_update=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_update);
		$karyawan_update=str_replace("'", '"',$karyawan_update);
		$karyawan_date_update=trim(@$_POST["karyawan_date_update"]);
		$karyawan_revised=trim(@$_POST["karyawan_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_karyawan->karyawan_search($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$start,$end);
		echo $result;
	}


	function karyawan_print(){
  		//POST varibale here
		$karyawan_id=trim(@$_POST["karyawan_id"]);
		$karyawan_no=trim(@$_POST["karyawan_no"]);
		$karyawan_no=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_no);
		$karyawan_no=str_replace("'", '"',$karyawan_no);
		$karyawan_npwp=trim(@$_POST["karyawan_npwp"]);
		$karyawan_npwp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_npwp);
		$karyawan_npwp=str_replace("'", '"',$karyawan_npwp);
		$karyawan_username=trim(@$_POST["karyawan_username"]);
		$karyawan_username=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_username);
		$karyawan_username=str_replace("'", '"',$karyawan_username);
		$karyawan_nama=trim(@$_POST["karyawan_nama"]);
		$karyawan_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_nama);
		$karyawan_nama=str_replace("'", '"',$karyawan_nama);
		$karyawan_kelamin=trim(@$_POST["karyawan_kelamin"]);
		$karyawan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kelamin);
		$karyawan_kelamin=str_replace("'", '"',$karyawan_kelamin);
		$karyawan_tgllahir=trim(@$_POST["karyawan_tgllahir"]);
		$karyawan_alamat=trim(@$_POST["karyawan_alamat"]);
		$karyawan_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_alamat);
		$karyawan_alamat=str_replace("'", '"',$karyawan_alamat);
		$karyawan_kota=trim(@$_POST["karyawan_kota"]);
		$karyawan_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kota);
		$karyawan_kota=str_replace("'", '"',$karyawan_kota);
		$karyawan_kodepos=trim(@$_POST["karyawan_kodepos"]);
		$karyawan_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kodepos);
		$karyawan_kodepos=str_replace("'", '"',$karyawan_kodepos);
		$karyawan_email=trim(@$_POST["karyawan_email"]);
		$karyawan_email=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_email);
		$karyawan_email=str_replace("'", '"',$karyawan_email);
		$karyawan_emiracle=trim(@$_POST["karyawan_emiracle"]);
		$karyawan_emiracle=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_emiracle);
		$karyawan_emiracle=str_replace("'", '"',$karyawan_emiracle);
		$karyawan_keterangan=trim(@$_POST["karyawan_keterangan"]);
		$karyawan_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_keterangan);
		$karyawan_keterangan=str_replace("'", '"',$karyawan_keterangan);
		$karyawan_notelp=trim(@$_POST["karyawan_notelp"]);
		$karyawan_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp);
		$karyawan_notelp=str_replace("'", '"',$karyawan_notelp);
		$karyawan_notelp2=trim(@$_POST["karyawan_notelp2"]);
		$karyawan_notelp2=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp2);
		$karyawan_notelp2=str_replace("'", '"',$karyawan_notelp2);
		$karyawan_notelp3=trim(@$_POST["karyawan_notelp3"]);
		$karyawan_notelp3=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp3);
		$karyawan_notelp3=str_replace("'", '"',$karyawan_notelp3);
		$karyawan_notelp4=trim(@$_POST["karyawan_notelp4"]);
		$karyawan_notelp4=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp4);
		$karyawan_notelp4=str_replace(",", ",",$karyawan_notelp4);
		$karyawan_notelp4=str_replace("'", '"',$karyawan_notelp4);
		$karyawan_cabang=trim(@$_POST["karyawan_cabang"]);
		$karyawan_jabatan=trim(@$_POST["karyawan_jabatan"]);
		$karyawan_departemen=trim(@$_POST["karyawan_departemen"]);
		$karyawan_idgolongan=trim(@$_POST["karyawan_idgolongan"]);
		$karyawan_idgolongan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_idgolongan);
		$karyawan_idgolongan=str_replace("'", '"',$karyawan_idgolongan);
		$karyawan_tglmasuk=trim(@$_POST["karyawan_tglmasuk"]);
		$karyawan_atasan=trim(@$_POST["karyawan_atasan"]);
		$karyawan_aktif=trim(@$_POST["karyawan_aktif"]);
		$karyawan_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_aktif);
		$karyawan_aktif=str_replace("'", '"',$karyawan_aktif);
		$karyawan_creator=trim(@$_POST["karyawan_creator"]);
		$karyawan_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_creator);
		$karyawan_creator=str_replace("'", '"',$karyawan_creator);
		$karyawan_date_create=trim(@$_POST["karyawan_date_create"]);
		$karyawan_update=trim(@$_POST["karyawan_update"]);
		$karyawan_update=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_update);
		$karyawan_update=str_replace("'", '"',$karyawan_update);
		$karyawan_date_update=trim(@$_POST["karyawan_date_update"]);
		$karyawan_revised=trim(@$_POST["karyawan_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_karyawan->karyawan_print($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=26;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("karyawanlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Karyawan Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Karyawan List'><caption>KARYAWAN</caption><thead><tr><th scope='col'>Karyawan Id</th><th scope='col'>Karyawan No</th><th scope='col'>Karyawan Npwp</th><th scope='col'>Karyawan Username</th><th scope='col'>Karyawan Nama</th><th scope='col'>Karyawan Kelamin</th><th scope='col'>Karyawan Tgllahir</th><th scope='col'>Karyawan Alamat</th><th scope='col'>Karyawan Kota</th><th scope='col'>Karyawan Kodepos</th><th scope='col'>Karyawan Email</th><th scope='col'>Karyawan Email Miracle</th><th scope='col'>Karyawan Keterangan</th><th scope='col'>Karyawan Notelp</th><th scope='col'>Karyawan Notelp2</th><th scope='col'>Karyawan Notelp3</th><th scope='col'>Karyawan Cabang</th><th scope='col'>Karyawan Jabatan</th><th scope='col'>Karyawan Departemen</th><th scope='col'>Karyawan Golongan</th><th scope='col'>Karyawan Tglmasuk</th><th scope='col'>Karyawan Atasan</th><th scope='col'>Karyawan Aktif</th><th scope='col'>Karyawan Creator</th><th scope='col'>Karyawan Date Create</th><th scope='col'>Karyawan Update</th><th scope='col'>Karyawan Date Update</th><th scope='col'>Karyawan Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Karyawan</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['karyawan_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['karyawan_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_npwp']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_username']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_kelamin']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_tgllahir']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_alamat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_kota']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_kodepos']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_email']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_emiracle']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_notelp']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_notelp2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_notelp3']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_cabang']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_jabatan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_departemen']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_idgolongan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_tglmasuk']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_atasan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_aktif']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_date_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['karyawan_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function karyawan_export_excel(){
		//POST varibale here
		$karyawan_id=trim(@$_POST["karyawan_id"]);
		$karyawan_no=trim(@$_POST["karyawan_no"]);
		$karyawan_no=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_no);
		$karyawan_no=str_replace("'", '"',$karyawan_no);
		$karyawan_npwp=trim(@$_POST["karyawan_npwp"]);
		$karyawan_npwp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_npwp);
		$karyawan_npwp=str_replace("'", '"',$karyawan_npwp);
		$karyawan_username=trim(@$_POST["karyawan_username"]);
		$karyawan_username=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_username);
		$karyawan_username=str_replace("'", '"',$karyawan_username);
		$karyawan_nama=trim(@$_POST["karyawan_nama"]);
		$karyawan_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_nama);
		$karyawan_nama=str_replace("'", '"',$karyawan_nama);
		$karyawan_kelamin=trim(@$_POST["karyawan_kelamin"]);
		$karyawan_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kelamin);
		$karyawan_kelamin=str_replace("'", '"',$karyawan_kelamin);
		$karyawan_tgllahir=trim(@$_POST["karyawan_tgllahir"]);
		$karyawan_alamat=trim(@$_POST["karyawan_alamat"]);
		$karyawan_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_alamat);
		$karyawan_alamat=str_replace("'", '"',$karyawan_alamat);
		$karyawan_kota=trim(@$_POST["karyawan_kota"]);
		$karyawan_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kota);
		$karyawan_kota=str_replace("'", '"',$karyawan_kota);
		$karyawan_kodepos=trim(@$_POST["karyawan_kodepos"]);
		$karyawan_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_kodepos);
		$karyawan_kodepos=str_replace("'", '"',$karyawan_kodepos);
		$karyawan_email=trim(@$_POST["karyawan_email"]);
		$karyawan_email=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_email);
		$karyawan_email=str_replace("'", '"',$karyawan_email);
		$karyawan_emiracle=trim(@$_POST["karyawan_emiracle"]);
		$karyawan_emiracle=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_emiracle);
		$karyawan_emiracle=str_replace("'", '"',$karyawan_emiracle);
		$karyawan_keterangan=trim(@$_POST["karyawan_keterangan"]);
		$karyawan_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_keterangan);
		$karyawan_keterangan=str_replace("'", '"',$karyawan_keterangan);
		$karyawan_notelp=trim(@$_POST["karyawan_notelp"]);
		$karyawan_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp);
		$karyawan_notelp=str_replace("'", '"',$karyawan_notelp);
		$karyawan_notelp2=trim(@$_POST["karyawan_notelp2"]);
		$karyawan_notelp2=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp2);
		$karyawan_notelp2=str_replace("'", '"',$karyawan_notelp2);
		$karyawan_notelp3=trim(@$_POST["karyawan_notelp3"]);
		$karyawan_notelp3=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp3);
		$karyawan_notelp3=str_replace("'", '"',$karyawan_notelp3);
		$karyawan_notelp4=trim(@$_POST["karyawan_notelp4"]);
		$karyawan_notelp4=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_notelp4);
		$karyawan_notelp4=str_replace(",", ",",$karyawan_notelp4);
		$karyawan_notelp4=str_replace("'", '"',$karyawan_notelp4);
		$karyawan_cabang=trim(@$_POST["karyawan_cabang"]);
		$karyawan_jabatan=trim(@$_POST["karyawan_jabatan"]);
		$karyawan_departemen=trim(@$_POST["karyawan_departemen"]);
		$karyawan_idgolongan=trim(@$_POST["karyawan_idgolongan"]);
		$karyawan_idgolongan=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_idgolongan);
		$karyawan_idgolongan=str_replace("'", '"',$karyawan_idgolongan);
		$karyawan_tglmasuk=trim(@$_POST["karyawan_tglmasuk"]);
		$karyawan_atasan=trim(@$_POST["karyawan_atasan"]);
		$karyawan_aktif=trim(@$_POST["karyawan_aktif"]);
		$karyawan_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_aktif);
		$karyawan_aktif=str_replace("'", '"',$karyawan_aktif);
		$karyawan_creator=trim(@$_POST["karyawan_creator"]);
		$karyawan_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_creator);
		$karyawan_creator=str_replace("'", '"',$karyawan_creator);
		$karyawan_date_create=trim(@$_POST["karyawan_date_create"]);
		$karyawan_update=trim(@$_POST["karyawan_update"]);
		$karyawan_update=str_replace("/(<\/?)(p)([^>]*>)", "",$karyawan_update);
		$karyawan_update=str_replace("'", '"',$karyawan_update);
		$karyawan_date_update=trim(@$_POST["karyawan_date_update"]);
		$karyawan_revised=trim(@$_POST["karyawan_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_karyawan->karyawan_export_excel($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_idgolongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$option,$filter);
		
		to_excel($query,"karyawan"); 
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
	
	// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
	function codeDate ($date) {
	  $tab = explode ("-", $date);
	  $r = $tab[1]."/".$tab[2]."/".$tab[0];
	  return $r;
	}
	
}
?>