<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: customer Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_customer.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 16/Jul/2009 17:02:19
	
*/

//class of customer
class C_customer extends Controller {

	//constructor
	function C_customer(){
		parent::Controller();
		session_start();
		$this->load->model('m_customer', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_customer');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->customer_list();
				break;
			case "UPDATE":
				$this->customer_update();
				break;
			case "CREATE":
				$this->customer_create();
				break;
			case "DELETE":
				$this->customer_delete();
				break;
			case "SEARCH":
				$this->customer_search();
				break;
			case "PRINT":
				$this->customer_print();
				break;
			case "EXCEL":
				$this->customer_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	
	function get_profesi_list(){
		$result=$this->m_customer->get_profesi_list();
		echo $result;
	}
	
	function get_hobi_list(){
		$result=$this->m_customer->get_hobi_list();
		echo $result;
	}
	
	function get_reflain_list(){
		$result=$this->m_customer->get_reflain_list();
		echo $result;
	}
	
	function get_cabang_list(){
		$result=$this->m_public_function->get_cabang_list();
		echo $result;
	}
	
	function get_cust_member(){
		$cust_id = isset($_POST['cust_id']) ? $_POST['cust_id'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_customer->get_cust_member($cust_id,$start,$end);
		echo $result;
	}
	
	function get_cust_note(){
		$cust_id = isset($_POST['cust_id']) ? $_POST['cust_id'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_customer->get_cust_note($cust_id,$start,$end);
		echo $result;
	}
	
	function cust_note_purge(){
		$master_id = isset($_POST['master_id']) ? $_POST['master_id'] : "";
		$result=$this->m_customer->cust_note_purge($master_id);
		echo $result;
	}
	
	function cust_note_insert(){
		$note_cust = isset($_POST['note_cust']) ? $_POST['note_cust'] : "";
		$note_detail=trim(@$_POST["note_detail"]);
		$note_detail=str_replace("/(<\/?)(p)([^>]*>)", "",$note_detail);
		$note_detail=str_replace("'",'"',$note_detail);
		$result=$this->m_customer->cust_note_insert($note_cust, $note_detail);
		echo $result;
	}
	
	//function fot list record
	function customer_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_customer->customer_list($query,$start,$end);
		echo $result;
	}
	
	function get_propinsi_list(){
		
		$result=$this->m_public_function->get_propinsi_list();
		echo $result;
	}
	
	
	//function for update record
	function customer_update(){
		//POST variable here
		$cust_id=trim(@$_POST["cust_id"]);
		$cust_no=trim(@$_POST["cust_no"]);
		$cust_no=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_no);
		$cust_no=str_replace("'", '"',$cust_no);
		$cust_nama=trim(@$_POST["cust_nama"]);
		$cust_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_nama);
		$cust_nama=str_replace("'", '"',$cust_nama);
		$cust_panggilan=trim(@$_POST["cust_panggilan"]);
		$cust_panggilan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_panggilan);
		$cust_panggilan=str_replace("'", '"',$cust_panggilan);
		$cust_kelamin=trim(@$_POST["cust_kelamin"]);
		$cust_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kelamin);
		$cust_kelamin=str_replace("'", '"',$cust_kelamin);
		$cust_alamat=trim(@$_POST["cust_alamat"]);
		$cust_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat);
		$cust_alamat=str_replace("'", '"',$cust_alamat);
		$cust_kota=trim(@$_POST["cust_kota"]);
		$cust_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota);
		$cust_kota=str_replace("'", '"',$cust_kota);
		$cust_kodepos=trim(@$_POST["cust_kodepos"]);
		$cust_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos);
		$cust_kodepos=str_replace("'", '"',$cust_kodepos);
		$cust_propinsi=trim(@$_POST["cust_propinsi"]);
		$cust_propinsi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi);
		$cust_propinsi=str_replace("'", '"',$cust_propinsi);
		$cust_negara=trim(@$_POST["cust_negara"]);
		$cust_negara=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara);
		$cust_negara=str_replace("'", '"',$cust_negara);
		$cust_alamat2=trim(@$_POST["cust_alamat2"]);
		$cust_alamat2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat2);
		$cust_alamat2=str_replace("'", '"',$cust_alamat2);
		$cust_kota2=trim(@$_POST["cust_kota2"]);
		$cust_kota2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota2);
		$cust_kota2=str_replace("'", '"',$cust_kota2);
		$cust_kodepos2=trim(@$_POST["cust_kodepos2"]);
		$cust_kodepos2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos2);
		$cust_kodepos2=str_replace("'", '"',$cust_kodepos2);
		$cust_propinsi2=trim(@$_POST["cust_propinsi2"]);
		$cust_propinsi2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi2);
		$cust_propinsi2=str_replace("'", '"',$cust_propinsi2);
		$cust_negara2=trim(@$_POST["cust_negara2"]);
		$cust_negara2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara2);
		$cust_negara2=str_replace("'", '"',$cust_negara2);
		$cust_telprumah=trim(@$_POST["cust_telprumah"]);
		$cust_telprumah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah);
		$cust_telprumah=str_replace("'", '"',$cust_telprumah);
		$cust_telprumah2=trim(@$_POST["cust_telprumah2"]);
		$cust_telprumah2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah2);
		$cust_telprumah2=str_replace("'", '"',$cust_telprumah2);
		$cust_telpkantor=trim(@$_POST["cust_telpkantor"]);
		$cust_telpkantor=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telpkantor);
		$cust_telpkantor=str_replace("'", '"',$cust_telpkantor);
		$cust_hp=trim(@$_POST["cust_hp"]);
		$cust_hp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp);
		$cust_hp=str_replace("'", '"',$cust_hp);
		$cust_hp2=trim(@$_POST["cust_hp2"]);
		$cust_hp2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp2);
		$cust_hp2=str_replace("'", '"',$cust_hp2);
		$cust_hp3=trim(@$_POST["cust_hp3"]);
		$cust_hp3=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp3);
		$cust_hp3=str_replace("'", '"',$cust_hp3);
		$cust_email=trim(@$_POST["cust_email"]);
		$cust_email=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email);
		$cust_email=str_replace("'", '"',$cust_email);
		$cust_fb=trim(@$_POST["cust_fb"]);
		$cust_tweeter=trim(@$_POST["cust_tweeter"]);
		$cust_email2=trim(@$_POST["cust_email2"]);
		$cust_email2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email2);
		$cust_email2=str_replace("'", '"',$cust_email2);
		$cust_fb2=trim(@$_POST["cust_fb2"]);
		$cust_tweeter2=trim(@$_POST["cust_tweeter2"]);
		$cust_agama=trim(@$_POST["cust_agama"]);
		$cust_agama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_agama);
		$cust_agama=str_replace("'", '"',$cust_agama);
		$cust_pendidikan=trim(@$_POST["cust_pendidikan"]);
		$cust_pendidikan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_pendidikan);
		$cust_pendidikan=str_replace("'", '"',$cust_pendidikan);
		$cust_profesitxt=trim(@$_POST["cust_profesitxt"]);
		$cust_profesitxt=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_profesitxt);
		$cust_profesitxt=str_replace("'", '"',$cust_profesitxt);
		if($cust_profesitxt<>"")
			$cust_profesi=$cust_profesitxt;
		else
			$cust_profesi=$_POST["cust_profesi"];
		$cust_tmptlahir=trim(@$_POST["cust_tmptlahir"]);
		$cust_tmptlahir=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_tmptlahir);
		$cust_tmptlahir=str_replace("'", '"',$cust_tmptlahir);
		$cust_tgllahir=trim(@$_POST["cust_tgllahir"]);
		$cust_hobitxt=trim(@$_POST["cust_hobitxt"]);
		$cust_hobitxt=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hobitxt);
		$cust_hobitxt=str_replace("'", '"',$cust_hobitxt);
		if($cust_hobitxt<>"")
			$cust_hobi=$cust_hobitxt;
		else
			$cust_hobi=$_POST["cust_hobi"];
		$cust_referensi=trim(@$_POST["cust_referensi"]);
		$cust_referensi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensi);
		$cust_referensi=str_replace("'", '"',$cust_referensi);
		$cust_referensilaintxt=trim(@$_POST["cust_referensilaintxt"]);
		$cust_referensilaintxt=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensilaintxt);
		$cust_referensilaintxt=str_replace("'", '"',$cust_referensilaintxt);
		if($cust_referensilaintxt<>"")
			$cust_referensilain=$cust_referensilaintxt;
		else
			$cust_referensilain=$_POST["cust_referensilain"];
		$cust_keterangan=trim(@$_POST["cust_keterangan"]);
		$cust_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_keterangan);
		$cust_keterangan=str_replace("'", '"',$cust_keterangan);
		$cust_member=trim(@$_POST["cust_member"]);
		$cust_member=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_member);
		$cust_member=str_replace("'", '"',$cust_member);
		$cust_terdaftar=trim(@$_POST["cust_terdaftar"]);
		$cust_statusnikah=trim(@$_POST["cust_statusnikah"]);
		$cust_statusnikah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_statusnikah);
		$cust_statusnikah=str_replace("'", '"',$cust_statusnikah);
		$cust_jmlanak=trim(@$_POST["cust_jmlanak"]);
		$cust_unit=trim(@$_POST["cust_unit"]);
		$cust_unit=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_unit);
		$cust_unit=str_replace("'", '"',$cust_unit);
		$cust_aktif=trim(@$_POST["cust_aktif"]);
		$cust_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_aktif);
		$cust_aktif=str_replace("'", '"',$cust_aktif);
		$cust_creator=trim(@$_POST["cust_creator"]);
		$cust_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_creator);
		$cust_creator=str_replace("'", '"',$cust_creator);
		$cust_date_create=trim(@$_POST["cust_date_create"]);
		$cust_update=trim(@$_POST["cust_update"]);
		$cust_update=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_update);
		$cust_update=str_replace("'", '"',$cust_update);
		$cust_date_update=trim(@$_POST["cust_date_update"]);
		$cust_revised=trim(@$_POST["cust_revised"]);
		$cust_cp=trim(@$_POST["cust_cp"]);
		$cust_cp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_cp);
		$cust_cp=str_replace("'", '"',$cust_cp);
		$cust_cptelp=trim(@$_POST["cust_cptelp"]);
		$cust_cptelp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_cptelp);
		$cust_cptelp=str_replace("'", '"',$cust_cptelp);
		$result = $this->m_customer->customer_update($cust_id ,$cust_no ,$cust_nama, $cust_panggilan ,$cust_kelamin ,$cust_alamat ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara,$cust_alamat2 ,$cust_kota2 ,$cust_kodepos2 ,$cust_propinsi2 ,$cust_negara2 ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_fb ,$cust_tweeter , $cust_email2 ,$cust_fb2 ,$cust_tweeter2 ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tmptlahir ,$cust_tgllahir ,$cust_hobi ,$cust_referensi, $cust_referensilain ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah ,$cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$cust_cp ,$cust_cptelp );
		echo $result;
	}
	
	//function for create new record
	function customer_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$cust_id=trim(@$_POST["cust_id"]);
		$cust_no=trim(@$_POST["cust_no"]);
		$cust_no=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_no);
		$cust_no=str_replace("'", '"',$cust_no);
		$cust_nama=trim(@$_POST["cust_nama"]);
		$cust_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_nama);
		$cust_nama=str_replace("'", '"',$cust_nama);
		$cust_panggilan=trim(@$_POST["cust_panggilan"]);
		$cust_panggilan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_panggilan);
		$cust_panggilan=str_replace("'", '"',$cust_panggilan);
		$cust_kelamin=trim(@$_POST["cust_kelamin"]);
		$cust_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kelamin);
		$cust_kelamin=str_replace("'", '"',$cust_kelamin);
		$cust_alamat=trim(@$_POST["cust_alamat"]);
		$cust_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat);
		$cust_alamat=str_replace("'", '"',$cust_alamat);
		$cust_kota=trim(@$_POST["cust_kota"]);
		$cust_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota);
		$cust_kota=str_replace("'", '"',$cust_kota);
		$cust_kodepos=trim(@$_POST["cust_kodepos"]);
		$cust_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos);
		$cust_kodepos=str_replace("'", '"',$cust_kodepos);
		$cust_propinsi=trim(@$_POST["cust_propinsi"]);
		$cust_propinsi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi);
		$cust_propinsi=str_replace("'", '"',$cust_propinsi);
		$cust_negara=trim(@$_POST["cust_negara"]);
		$cust_negara=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara);
		$cust_negara=str_replace("'", '"',$cust_negara);
		$cust_alamat2=trim(@$_POST["cust_alamat2"]);
		$cust_alamat2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat2);
		$cust_alamat2=str_replace("'", '"',$cust_alamat2);
		$cust_kota2=trim(@$_POST["cust_kota2"]);
		$cust_kota2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota2);
		$cust_kota2=str_replace("'", '"',$cust_kota2);
		$cust_kodepos2=trim(@$_POST["cust_kodepos2"]);
		$cust_kodepos2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos2);
		$cust_kodepos2=str_replace("'", '"',$cust_kodepos2);
		$cust_propinsi2=trim(@$_POST["cust_propinsi2"]);
		$cust_propinsi2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi2);
		$cust_propinsi2=str_replace("'", '"',$cust_propinsi2);
		$cust_negara2=trim(@$_POST["cust_negara2"]);
		$cust_negara2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara2);
		$cust_negara2=str_replace("'", '"',$cust_negara2);
		$cust_telprumah=trim(@$_POST["cust_telprumah"]);
		$cust_telprumah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah);
		$cust_telprumah=str_replace("'", '"',$cust_telprumah);
		$cust_telprumah2=trim(@$_POST["cust_telprumah2"]);
		$cust_telprumah2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah2);
		$cust_telprumah2=str_replace("'", '"',$cust_telprumah2);
		$cust_telpkantor=trim(@$_POST["cust_telpkantor"]);
		$cust_telpkantor=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telpkantor);
		$cust_telpkantor=str_replace("'", '"',$cust_telpkantor);
		$cust_hp=trim(@$_POST["cust_hp"]);
		$cust_hp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp);
		$cust_hp=str_replace("'", '"',$cust_hp);
		$cust_hp2=trim(@$_POST["cust_hp2"]);
		$cust_hp2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp2);
		$cust_hp2=str_replace("'", '"',$cust_hp2);
		$cust_hp3=trim(@$_POST["cust_hp3"]);
		$cust_hp3=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp3);
		$cust_hp3=str_replace("'", '"',$cust_hp3);
		$cust_email=trim(@$_POST["cust_email"]);
		$cust_email=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email);
		$cust_email=str_replace("'", '"',$cust_email);
		$cust_fb=trim(@$_POST["cust_fb"]);
		$cust_tweeter=trim(@$_POST["cust_tweeter"]);
		$cust_email2=trim(@$_POST["cust_email2"]);
		$cust_email2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email2);
		$cust_email2=str_replace("'", '"',$cust_email2);
		$cust_fb2=trim(@$_POST["cust_fb2"]);
		$cust_tweeter2=trim(@$_POST["cust_tweeter2"]);
		$cust_agama=trim(@$_POST["cust_agama"]);
		$cust_agama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_agama);
		$cust_agama=str_replace("'", '"',$cust_agama);
		$cust_pendidikan=trim(@$_POST["cust_pendidikan"]);
		$cust_pendidikan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_pendidikan);
		$cust_pendidikan=str_replace("'", '"',$cust_pendidikan);
		$cust_profesitxt=trim(@$_POST["cust_profesitxt"]);
		$cust_profesitxt=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_profesitxt);
		$cust_profesitxt=str_replace("'", '"',$cust_profesitxt);
		if($cust_profesitxt<>"")
			$cust_profesi=$cust_profesitxt;
		else
			$cust_profesi=trim(@$_POST["cust_profesi"]);
		$cust_tmptlahir=trim(@$_POST["cust_tmptlahir"]);
		$cust_tmptlahir=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_tmptlahir);
		$cust_tmptlahir=str_replace("'", '"',$cust_tmptlahir);
		$cust_tgllahir=trim(@$_POST["cust_tgllahir"]);
		$cust_hobitxt=trim(@$_POST["cust_hobitxt"]);
		$cust_hobitxt=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hobitxt);
		$cust_hobitxt=str_replace("'", '"',$cust_hobitxt);
		if($cust_hobitxt<>"")
			$cust_hobi=$cust_hobitxt;
		else
			$cust_hobi=trim(@$_POST["cust_hobi"]);
		$cust_referensi=trim(@$_POST["cust_referensi"]);
		$cust_referensi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensi);
		$cust_referensi=str_replace("'", '"',$cust_referensi);
		$cust_referensilaintxt=trim(@$_POST["cust_referensilaintxt"]);
		$cust_referensilaintxt=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensilaintxt);
		$cust_referensilaintxt=str_replace("'", '"',$cust_referensilaintxt);
		if($cust_referensilaintxt<>"")
			$cust_referensilain=$cust_referensilaintxt;
		else
			$cust_referensilain=trim(@$_POST["cust_referensilain"]);
		$cust_keterangan=trim(@$_POST["cust_keterangan"]);
		$cust_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_keterangan);
		$cust_keterangan=str_replace("'", '"',$cust_keterangan);
		$cust_member=trim(@$_POST["cust_member"]);
		$cust_member=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_member);
		$cust_member=str_replace("'", '"',$cust_member);
		$cust_terdaftar=trim(@$_POST["cust_terdaftar"]);
		$cust_statusnikah=trim(@$_POST["cust_statusnikah"]);
		$cust_statusnikah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_statusnikah);
		$cust_statusnikah=str_replace("'", '"',$cust_statusnikah);
		$cust_jmlanak=trim(@$_POST["cust_jmlanak"]);
		$cust_unit=trim(@$_POST["cust_unit"]);
		$cust_unit=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_unit);
		$cust_unit=str_replace("'", '"',$cust_unit);
		$cust_aktif=trim(@$_POST["cust_aktif"]);
		$cust_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_aktif);
		$cust_aktif=str_replace("'", '"',$cust_aktif);
		$cust_creator=trim(@$_POST["cust_creator"]);
		$cust_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_creator);
		$cust_creator=str_replace("'", '"',$cust_creator);
		$cust_date_create=trim(@$_POST["cust_date_create"]);
		$cust_update=trim(@$_POST["cust_update"]);
		$cust_update=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_update);
		$cust_update=str_replace("'", '"',$cust_update);
		$cust_date_update=trim(@$_POST["cust_date_update"]);
		$cust_revised=trim(@$_POST["cust_revised"]);
		$cust_cp=trim(@$_POST["cust_cp"]);
		$cust_cp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_cp);
		$cust_cp=str_replace("'", '"',$cust_cp);
		$cust_cptelp=trim(@$_POST["cust_cptelp"]);
		$cust_cptelp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_cptelp);
		$cust_cptelp=str_replace("'", '"',$cust_cptelp);
		$result = $this->m_customer->customer_create($cust_no ,$cust_nama, $cust_panggilan ,$cust_kelamin ,$cust_alamat ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara,$cust_alamat2 ,$cust_kota2 ,$cust_kodepos2 ,$cust_propinsi2 ,$cust_negara2 ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_fb ,$cust_tweeter , $cust_email2 ,$cust_fb2 ,$cust_tweeter2 ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tmptlahir ,$cust_tgllahir ,$cust_hobi ,$cust_referensi, $cust_referensilain ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah ,$cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$cust_cp ,$cust_cptelp );
		echo $result;
	}

	//function for delete selected record
	function customer_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_customer->customer_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function customer_search(){
		//POST varibale here
		$cust_id=trim(@$_POST["cust_id"]);
		$cust_no=trim(@$_POST["cust_no"]);
		$cust_no=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_no);
		$cust_no=str_replace("'", '"',$cust_no);
		$cust_nama=trim(@$_POST["cust_nama"]);
		$cust_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_nama);
		$cust_nama=str_replace("'", '"',$cust_nama);
		$cust_kelamin=trim(@$_POST["cust_kelamin"]);
		$cust_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kelamin);
		$cust_kelamin=str_replace("'", '"',$cust_kelamin);
		$cust_alamat=trim(@$_POST["cust_alamat"]);
		$cust_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat);
		$cust_alamat=str_replace("'", '"',$cust_alamat);
		$cust_alamat2=trim(@$_POST["cust_alamat2"]);
		$cust_alamat2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat2);
		$cust_alamat2=str_replace("'", '"',$cust_alamat2);
		$cust_kota=trim(@$_POST["cust_kota"]);
		$cust_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota);
		$cust_kota=str_replace("'", '"',$cust_kota);
		$cust_kodepos=trim(@$_POST["cust_kodepos"]);
		$cust_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos);
		$cust_kodepos=str_replace("'", '"',$cust_kodepos);
		$cust_propinsi=trim(@$_POST["cust_propinsi"]);
		$cust_propinsi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi);
		$cust_propinsi=str_replace("'", '"',$cust_propinsi);
		$cust_negara=trim(@$_POST["cust_negara"]);
		$cust_negara=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara);
		$cust_negara=str_replace("'", '"',$cust_negara);
		$cust_telprumah=trim(@$_POST["cust_telprumah"]);
		$cust_telprumah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah);
		$cust_telprumah=str_replace("'", '"',$cust_telprumah);
		$cust_telprumah2=trim(@$_POST["cust_telprumah2"]);
		$cust_telprumah2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah2);
		$cust_telprumah2=str_replace("'", '"',$cust_telprumah2);
		$cust_telpkantor=trim(@$_POST["cust_telpkantor"]);
		$cust_telpkantor=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telpkantor);
		$cust_telpkantor=str_replace("'", '"',$cust_telpkantor);
		$cust_hp=trim(@$_POST["cust_hp"]);
		$cust_hp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp);
		$cust_hp=str_replace("'", '"',$cust_hp);
		$cust_hp2=trim(@$_POST["cust_hp2"]);
		$cust_hp2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp2);
		$cust_hp2=str_replace("'", '"',$cust_hp2);
		$cust_hp3=trim(@$_POST["cust_hp3"]);
		$cust_hp3=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp3);
		$cust_hp3=str_replace("'", '"',$cust_hp3);
		$cust_email=trim(@$_POST["cust_email"]);
		$cust_email=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email);
		$cust_email=str_replace("'", '"',$cust_email);
		$cust_agama=trim(@$_POST["cust_agama"]);
		$cust_agama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_agama);
		$cust_agama=str_replace("'", '"',$cust_agama);
		$cust_pendidikan=trim(@$_POST["cust_pendidikan"]);
		$cust_pendidikan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_pendidikan);
		$cust_pendidikan=str_replace("'", '"',$cust_pendidikan);
		$cust_profesi=trim(@$_POST["cust_profesi"]);
		$cust_profesi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_profesi);
		$cust_profesi=str_replace("'", '"',$cust_profesi);
		$cust_tgllahir=trim(@$_POST["cust_tgllahir"]);
		$cust_hobi=trim(@$_POST["cust_hobi"]);
		$cust_hobi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hobi);
		$cust_hobi=str_replace("'", '"',$cust_hobi);
		$cust_referensi=trim(@$_POST["cust_referensi"]);
		$cust_referensi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensi);
		$cust_referensi=str_replace("'", '"',$cust_referensi);
		$cust_keterangan=trim(@$_POST["cust_keterangan"]);
		$cust_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_keterangan);
		$cust_keterangan=str_replace("'", '"',$cust_keterangan);
		$cust_member=trim(@$_POST["cust_member"]);
		$cust_member=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_member);
		$cust_member=str_replace("'", '"',$cust_member);
		$cust_terdaftar=trim(@$_POST["cust_terdaftar"]);
		$cust_statusnikah=trim(@$_POST["cust_statusnikah"]);
		$cust_statusnikah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_statusnikah);
		$cust_statusnikah=str_replace("'", '"',$cust_statusnikah);
		$cust_jmlanak=trim(@$_POST["cust_jmlanak"]);
		$cust_unit=trim(@$_POST["cust_unit"]);
		$cust_unit=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_unit);
		$cust_unit=str_replace("'", '"',$cust_unit);
		$cust_aktif=trim(@$_POST["cust_aktif"]);
		$cust_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_aktif);
		$cust_aktif=str_replace("'", '"',$cust_aktif);
		$cust_creator=trim(@$_POST["cust_creator"]);
		$cust_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_creator);
		$cust_creator=str_replace("'", '"',$cust_creator);
		$cust_date_create=trim(@$_POST["cust_date_create"]);
		$cust_update=trim(@$_POST["cust_update"]);
		$cust_update=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_update);
		$cust_update=str_replace("'", '"',$cust_update);
		$cust_date_update=trim(@$_POST["cust_date_update"]);
		$cust_revised=trim(@$_POST["cust_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_customer->customer_search($cust_id ,$cust_no ,$cust_nama ,$cust_kelamin ,$cust_alamat ,$cust_alamat2 ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tgllahir ,$cust_hobi ,$cust_referensi ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah ,$cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$start,$end);
		echo $result;
	}


	function customer_print(){
  		//POST varibale here
		$cust_id=trim(@$_POST["cust_id"]);
		$cust_no=trim(@$_POST["cust_no"]);
		$cust_no=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_no);
		$cust_no=str_replace("'", '"',$cust_no);
		$cust_nama=trim(@$_POST["cust_nama"]);
		$cust_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_nama);
		$cust_nama=str_replace("'", '"',$cust_nama);
		$cust_kelamin=trim(@$_POST["cust_kelamin"]);
		$cust_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kelamin);
		$cust_kelamin=str_replace("'", '"',$cust_kelamin);
		$cust_alamat=trim(@$_POST["cust_alamat"]);
		$cust_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat);
		$cust_alamat=str_replace("'", '"',$cust_alamat);
		$cust_alamat2=trim(@$_POST["cust_alamat2"]);
		$cust_alamat2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat2);
		$cust_alamat2=str_replace("'", '"',$cust_alamat2);
		$cust_kota=trim(@$_POST["cust_kota"]);
		$cust_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota);
		$cust_kota=str_replace("'", '"',$cust_kota);
		$cust_kodepos=trim(@$_POST["cust_kodepos"]);
		$cust_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos);
		$cust_kodepos=str_replace("'", '"',$cust_kodepos);
		$cust_propinsi=trim(@$_POST["cust_propinsi"]);
		$cust_propinsi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi);
		$cust_propinsi=str_replace("'", '"',$cust_propinsi);
		$cust_negara=trim(@$_POST["cust_negara"]);
		$cust_negara=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara);
		$cust_negara=str_replace("'", '"',$cust_negara);
		$cust_telprumah=trim(@$_POST["cust_telprumah"]);
		$cust_telprumah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah);
		$cust_telprumah=str_replace("'", '"',$cust_telprumah);
		$cust_telprumah2=trim(@$_POST["cust_telprumah2"]);
		$cust_telprumah2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah2);
		$cust_telprumah2=str_replace("'", '"',$cust_telprumah2);
		$cust_telpkantor=trim(@$_POST["cust_telpkantor"]);
		$cust_telpkantor=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telpkantor);
		$cust_telpkantor=str_replace("'", '"',$cust_telpkantor);
		$cust_hp=trim(@$_POST["cust_hp"]);
		$cust_hp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp);
		$cust_hp=str_replace("'", '"',$cust_hp);
		$cust_hp2=trim(@$_POST["cust_hp2"]);
		$cust_hp2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp2);
		$cust_hp2=str_replace("'", '"',$cust_hp2);
		$cust_hp3=trim(@$_POST["cust_hp3"]);
		$cust_hp3=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp3);
		$cust_hp3=str_replace("'", '"',$cust_hp3);
		$cust_email=trim(@$_POST["cust_email"]);
		$cust_email=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email);
		$cust_email=str_replace("'", '"',$cust_email);
		$cust_agama=trim(@$_POST["cust_agama"]);
		$cust_agama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_agama);
		$cust_agama=str_replace("'", '"',$cust_agama);
		$cust_pendidikan=trim(@$_POST["cust_pendidikan"]);
		$cust_pendidikan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_pendidikan);
		$cust_pendidikan=str_replace("'", '"',$cust_pendidikan);
		$cust_profesi=trim(@$_POST["cust_profesi"]);
		$cust_profesi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_profesi);
		$cust_profesi=str_replace("'", '"',$cust_profesi);
		$cust_tgllahir=trim(@$_POST["cust_tgllahir"]);
		$cust_hobi=trim(@$_POST["cust_hobi"]);
		$cust_hobi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hobi);
		$cust_hobi=str_replace("'", '"',$cust_hobi);
		$cust_referensi=trim(@$_POST["cust_referensi"]);
		$cust_referensi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensi);
		$cust_referensi=str_replace("'", '"',$cust_referensi);
		$cust_keterangan=trim(@$_POST["cust_keterangan"]);
		$cust_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_keterangan);
		$cust_keterangan=str_replace("'", '"',$cust_keterangan);
		$cust_member=trim(@$_POST["cust_member"]);
		$cust_member=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_member);
		$cust_member=str_replace("'", '"',$cust_member);
		$cust_terdaftar=trim(@$_POST["cust_terdaftar"]);
		$cust_statusnikah=trim(@$_POST["cust_statusnikah"]);
		$cust_statusnikah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_statusnikah);
		$cust_statusnikah=str_replace("'", '"',$cust_statusnikah);
		$cust_jmlanak=trim(@$_POST["cust_jmlanak"]);
		$cust_unit=trim(@$_POST["cust_unit"]);
		$cust_unit=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_unit);
		$cust_unit=str_replace("'", '"',$cust_unit);
		$cust_aktif=trim(@$_POST["cust_aktif"]);
		$cust_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_aktif);
		$cust_aktif=str_replace("'", '"',$cust_aktif);
		$cust_creator=trim(@$_POST["cust_creator"]);
		$cust_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_creator);
		$cust_creator=str_replace("'", '"',$cust_creator);
		$cust_date_create=trim(@$_POST["cust_date_create"]);
		$cust_update=trim(@$_POST["cust_update"]);
		$cust_update=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_update);
		$cust_update=str_replace("'", '"',$cust_update);
		$cust_date_update=trim(@$_POST["cust_date_update"]);
		$cust_revised=trim(@$_POST["cust_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_customer->customer_print($cust_id ,$cust_no ,$cust_nama ,$cust_kelamin ,$cust_alamat ,$cust_alamat2 ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tgllahir ,$cust_hobi ,$cust_referensi ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah ,$cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=36;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("customerlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Customer Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Customer List'><caption>CUSTOMER</caption><thead><tr><th scope='col'>Cust Id</th><th scope='col'>Cust No</th><th scope='col'>Cust Nama</th><th scope='col'>Cust Kelamin</th><th scope='col'>Cust Alamat</th><th scope='col'>Cust Alamat2</th><th scope='col'>Cust Kota</th><th scope='col'>Cust Kodepos</th><th scope='col'>Cust Propinsi</th><th scope='col'>Cust Negara</th><th scope='col'>Cust Telprumah</th><th scope='col'>Cust Telprumah2</th><th scope='col'>Cust Telpkantor</th><th scope='col'>Cust Hp</th><th scope='col'>Cust Hp2</th><th scope='col'>Cust Hp3</th><th scope='col'>Cust Email</th><th scope='col'>Cust Agama</th><th scope='col'>Cust Pendidikan</th><th scope='col'>Cust Profesi</th><th scope='col'>Cust Tgllahir</th><th scope='col'>Cust Hobi</th><th scope='col'>Cust Referensi</th><th scope='col'>Cust Keterangan</th><th scope='col'>Cust Member</th><th scope='col'>Cust Terdaftar</th><th scope='col'>Cust Statusnikah</th><th scope='col'>Cust Jmlanak</th><th scope='col'>Cust Daftar</th><th scope='col'>Cust Unit</th><th scope='col'>Cust Aktif</th><th scope='col'>Cust Creator</th><th scope='col'>Cust Date Create</th><th scope='col'>Cust Update</th><th scope='col'>Cust Date Update</th><th scope='col'>Cust Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Customer</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['cust_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['cust_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_kelamin']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_alamat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_alamat2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_kota']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_kodepos']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_propinsi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_negara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_telprumah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_telprumah2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_telpkantor']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hp']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hp2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hp3']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_email']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_agama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_pendidikan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_profesi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_tgllahir']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hobi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_referensi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_member']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_terdaftar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_statusnikah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_jmlanak']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_unit']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_aktif']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_date_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function customer_export_excel(){
		//POST varibale here
		$cust_id=trim(@$_POST["cust_id"]);
		$cust_no=trim(@$_POST["cust_no"]);
		$cust_no=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_no);
		$cust_no=str_replace("'", '"',$cust_no);
		$cust_nama=trim(@$_POST["cust_nama"]);
		$cust_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_nama);
		$cust_nama=str_replace("'", '"',$cust_nama);
		$cust_kelamin=trim(@$_POST["cust_kelamin"]);
		$cust_kelamin=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kelamin);
		$cust_kelamin=str_replace("'", '"',$cust_kelamin);
		$cust_alamat=trim(@$_POST["cust_alamat"]);
		$cust_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat);
		$cust_alamat=str_replace("'", '"',$cust_alamat);
		$cust_alamat2=trim(@$_POST["cust_alamat2"]);
		$cust_alamat2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_alamat2);
		$cust_alamat2=str_replace("'", '"',$cust_alamat2);
		$cust_kota=trim(@$_POST["cust_kota"]);
		$cust_kota=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kota);
		$cust_kota=str_replace("'", '"',$cust_kota);
		$cust_kodepos=trim(@$_POST["cust_kodepos"]);
		$cust_kodepos=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_kodepos);
		$cust_kodepos=str_replace("'", '"',$cust_kodepos);
		$cust_propinsi=trim(@$_POST["cust_propinsi"]);
		$cust_propinsi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_propinsi);
		$cust_propinsi=str_replace("'", '"',$cust_propinsi);
		$cust_negara=trim(@$_POST["cust_negara"]);
		$cust_negara=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_negara);
		$cust_negara=str_replace("'", '"',$cust_negara);
		$cust_telprumah=trim(@$_POST["cust_telprumah"]);
		$cust_telprumah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah);
		$cust_telprumah=str_replace("'", '"',$cust_telprumah);
		$cust_telprumah2=trim(@$_POST["cust_telprumah2"]);
		$cust_telprumah2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telprumah2);
		$cust_telprumah2=str_replace("'", '"',$cust_telprumah2);
		$cust_telpkantor=trim(@$_POST["cust_telpkantor"]);
		$cust_telpkantor=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_telpkantor);
		$cust_telpkantor=str_replace("'", '"',$cust_telpkantor);
		$cust_hp=trim(@$_POST["cust_hp"]);
		$cust_hp=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp);
		$cust_hp=str_replace("'", '"',$cust_hp);
		$cust_hp2=trim(@$_POST["cust_hp2"]);
		$cust_hp2=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp2);
		$cust_hp2=str_replace("'", '"',$cust_hp2);
		$cust_hp3=trim(@$_POST["cust_hp3"]);
		$cust_hp3=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hp3);
		$cust_hp3=str_replace("'", '"',$cust_hp3);
		$cust_email=trim(@$_POST["cust_email"]);
		$cust_email=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_email);
		$cust_email=str_replace("'", '"',$cust_email);
		$cust_agama=trim(@$_POST["cust_agama"]);
		$cust_agama=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_agama);
		$cust_agama=str_replace("'", '"',$cust_agama);
		$cust_pendidikan=trim(@$_POST["cust_pendidikan"]);
		$cust_pendidikan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_pendidikan);
		$cust_pendidikan=str_replace("'", '"',$cust_pendidikan);
		$cust_profesi=trim(@$_POST["cust_profesi"]);
		$cust_profesi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_profesi);
		$cust_profesi=str_replace("'", '"',$cust_profesi);
		$cust_tgllahir=trim(@$_POST["cust_tgllahir"]);
		$cust_hobi=trim(@$_POST["cust_hobi"]);
		$cust_hobi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_hobi);
		$cust_hobi=str_replace("'", '"',$cust_hobi);
		$cust_referensi=trim(@$_POST["cust_referensi"]);
		$cust_referensi=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_referensi);
		$cust_referensi=str_replace("'", '"',$cust_referensi);
		$cust_keterangan=trim(@$_POST["cust_keterangan"]);
		$cust_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_keterangan);
		$cust_keterangan=str_replace("'", '"',$cust_keterangan);
		$cust_member=trim(@$_POST["cust_member"]);
		$cust_member=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_member);
		$cust_member=str_replace("'", '"',$cust_member);
		$cust_terdaftar=trim(@$_POST["cust_terdaftar"]);
		$cust_statusnikah=trim(@$_POST["cust_statusnikah"]);
		$cust_statusnikah=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_statusnikah);
		$cust_statusnikah=str_replace("'", '"',$cust_statusnikah);
		$cust_jmlanak=trim(@$_POST["cust_jmlanak"]);
		$cust_unit=trim(@$_POST["cust_unit"]);
		$cust_unit=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_unit);
		$cust_unit=str_replace("'", '"',$cust_unit);
		$cust_aktif=trim(@$_POST["cust_aktif"]);
		$cust_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_aktif);
		$cust_aktif=str_replace("'", '"',$cust_aktif);
		$cust_creator=trim(@$_POST["cust_creator"]);
		$cust_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_creator);
		$cust_creator=str_replace("'", '"',$cust_creator);
		$cust_date_create=trim(@$_POST["cust_date_create"]);
		$cust_update=trim(@$_POST["cust_update"]);
		$cust_update=str_replace("/(<\/?)(p)([^>]*>)", "",$cust_update);
		$cust_update=str_replace("'", '"',$cust_update);
		$cust_date_update=trim(@$_POST["cust_date_update"]);
		$cust_revised=trim(@$_POST["cust_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_customer->customer_export_excel($cust_id ,$cust_no ,$cust_nama ,$cust_kelamin ,$cust_alamat ,$cust_alamat2 ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tgllahir ,$cust_hobi ,$cust_referensi ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah ,$cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$option,$filter);
		
		to_excel($query,"customer"); 
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