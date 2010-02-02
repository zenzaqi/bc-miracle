<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: phonegroup Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_phonegroup.php
 	+ creator  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/

//class of phonegroup
class C_sms extends Controller {

	//constructor
	function C_sms(){
		parent::Controller();
		session_start();
		$this->load->model('m_phonegroup', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_sms');
	}
	
	function sms_save(){
		
		$isms_nomer = (isset($_POST['isms_nomer']) ? @$_POST['isms_nomer'] : @$_GET['isms_nomer']);
		$isms_group = (isset($_POST['isms_group']) ? @$_POST['isms_group'] : @$_GET['isms_group']);
		$isms_isi = (isset($_POST['isms_isi']) ? @$_POST['isms_isi'] : @$_GET['isms_isi']);
		$isms_opsi = (isset($_POST['isms_opsi']) ? @$_POST['isms_opsi'] : @$_GET['isms_opsi']);
		$isms_task = (isset($_POST['isms_task']) ? @$_POST['isms_task'] : @$_GET['isms_task']);
		
		$result=$this->m_phonegroup->sms_save($isms_nomer,$isms_group,$isms_isi,$isms_opsi,$isms_task);
		echo $result;
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