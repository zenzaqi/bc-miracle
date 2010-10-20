<?php
/* 	
	+ Module  		: crm_setup Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_crm_setup.php
 	+ creator 		:  Fred

	
*/

//class of member_setup
class C_crm_setup extends Controller {

	//constructor
	function C_crm_setup(){
		parent::Controller();
		session_start();
		$this->load->model('m_crm_setup', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_crm_setup');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->crm_setup_list();
				break;
			case "UPDATE":
				$this->crm_setup_update();
				break;
			case "CREATE":
				$this->crm_setup_create();
				break;

			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function crm_setup_list(){
		
		$query = isset($_POST['query']) ? @$_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? @$_POST['start'] : @$_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? @$_POST['limit'] : @$_GET['limit']);
		$result=$this->m_crm_setup->crm_setup_list($query,$start,$end);
		echo $result;
	}
	
	//function for create new record
	function crm_setup_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$setcrm_frequency_bulan1=trim(@$_POST["setcrm_frequency_bulan1"]);
		$setcrm_frequency_bulan2=trim(@$_POST["setcrm_frequency_bulan2"]);
		$setcrm_frequency_value_morethan=trim(@$_POST["setcrm_frequency_value_morethan"]);
		$setcrm_frequency_value_equal=trim(@$_POST["setcrm_frequency_value_equal"]);
		$setcrm_frequency_value_lessthan=trim(@$_POST["setcrm_frequency_value_lessthan"]);
		
		$setcrm_recency_days=trim(@$_POST["setcrm_recency_days"]);
		$setcrm_recency_value_morethan=trim(@$_POST["setcrm_recency_value_morethan"]);
		//$setcrm_recency_value_equal=trim(@$_POST["setcrm_recency_value_equal"]);
		$setcrm_recency_value_lessthan=trim(@$_POST["setcrm_recency_value_lessthan"]);
		
		$setcrm_spending_value_morethan=trim(@$_POST["setcrm_spending_value_morethan"]);
		$setcrm_spending_value_equal=trim(@$_POST["setcrm_spending_value_equal"]);
		$setcrm_spending_value_lessthan=trim(@$_POST["setcrm_spending_value_lessthan"]);
		
		$setcrm_highmargin_treatment=trim(@$_POST["setcrm_highmargin_treatment"]);
		$setcrm_highmargin_month=trim(@$_POST["setcrm_highmargin_month"]);
		$setcrm_highmargin_value_morethan=trim(@$_POST["setcrm_highmargin_value_morethan"]);
		$setcrm_highmargin_value_equal=trim(@$_POST["setcrm_highmargin_value_equal"]);
		$setcrm_highmargin_value_lessthan=trim(@$_POST["setcrm_highmargin_value_lessthan"]);
		
		$setcrm_referal_person=trim(@$_POST["setcrm_referal_person"]);
		$setcrm_referal_month=trim(@$_POST["setcrm_referal_month"]);
		$setcrm_referal_morethan=trim(@$_POST["setcrm_referal_morethan"]);
		$setcrm_referal_equal=trim(@$_POST["setcrm_referal_equal"]);
		$setcrm_referal_lessthan=trim(@$_POST["setcrm_referal_lessthan"]);
		
		$setcrm_kerewelan_high=trim(@$_POST["setcrm_kerewelan_high"]);
		$setcrm_kerewelan_normal=trim(@$_POST["setcrm_kerewelan_normal"]);
		$setcrm_kerewelan_low=trim(@$_POST["setcrm_kerewelan_low"]);
		
		$setcrm_disiplin_high=trim(@$_POST["setcrm_disiplin_high"]);
		$setcrm_disiplin_normal=trim(@$_POST["setcrm_disiplin_normal"]);
		$setcrm_disiplin_low=trim(@$_POST["setcrm_disiplin_low"]);
		
		$setcrm_treatment_month=trim(@$_POST["setcrm_treatment_month"]);
		$setcrm_treatment_nonmedis=trim(@$_POST["setcrm_treatment_nonmedis"]);
		$setcrm_treatment_medis=trim(@$_POST["setcrm_treatment_medis"]);
		$setcrm_treatment_morethan=trim(@$_POST["setcrm_treatment_morethan"]);
		$setcrm_treatment_equal=trim(@$_POST["setcrm_treatment_equal"]);
		$setcrm_treatment_lessthan=trim(@$_POST["setcrm_treatment_lessthan"]);
		
		$setcrm_author=@$_SESSION[SESSION_USERID];
		$setcrm_date_create=date(LONG_FORMATDATE);
		
		$result=$this->m_crm_setup->crm_setup_create($setcrm_frequency_bulan1, $setcrm_frequency_bulan2, $setcrm_frequency_value_morethan, $setcrm_frequency_value_equal, $setcrm_frequency_value_lessthan,
													$setcrm_recency_days, $setcrm_recency_value_morethan, $setcrm_recency_value_lessthan,
													$setcrm_spending_value_morethan, $setcrm_spending_value_equal, $setcrm_spending_value_lessthan,
													$setcrm_highmargin_treatment, $setcrm_highmargin_month, $setcrm_highmargin_value_morethan, $setcrm_highmargin_value_equal, $setcrm_highmargin_value_lessthan,
													$setcrm_referal_person, $setcrm_referal_month, $setcrm_referal_morethan, $setcrm_referal_equal, $setcrm_referal_lessthan,
													$setcrm_kerewelan_high, $setcrm_kerewelan_normal, $setcrm_kerewelan_low,
													$setcrm_disiplin_high, $setcrm_disiplin_normal, $setcrm_disiplin_low,
													$setcrm_treatment_month, $setcrm_treatment_nonmedis, $setcrm_treatment_medis, $setcrm_treatment_morethan, $setcrm_treatment_equal, $setcrm_treatment_lessthan,
													$setcrm_author, $setcrm_date_create);
		echo $result;
	}
	
	
	//function for update record
	function crm_setup_update(){
		//POST variable here
		$setcrm_id=trim(@$_POST["setcrm_id"]);
		
		$setcrm_frequency_bulan1=trim(@$_POST["setcrm_frequency_bulan1"]);
		$setcrm_frequency_bulan2=trim(@$_POST["setcrm_frequency_bulan2"]);
		$setcrm_frequency_value_morethan=trim(@$_POST["setcrm_frequency_value_morethan"]);
		$setcrm_frequency_value_equal=trim(@$_POST["setcrm_frequency_value_equal"]);
		$setcrm_frequency_value_lessthan=trim(@$_POST["setcrm_frequency_value_lessthan"]);
		
		$setcrm_recency_days=trim(@$_POST["setcrm_recency_days"]);
		$setcrm_recency_value_morethan=trim(@$_POST["setcrm_recency_value_morethan"]);
		//$setcrm_recency_value_equal=trim(@$_POST["setcrm_recency_value_equal"]);
		$setcrm_recency_value_lessthan=trim(@$_POST["setcrm_recency_value_lessthan"]);
		
		$setcrm_spending_value_morethan=trim(@$_POST["setcrm_spending_value_morethan"]);
		$setcrm_spending_value_equal=trim(@$_POST["setcrm_spending_value_equal"]);
		$setcrm_spending_value_lessthan=trim(@$_POST["setcrm_spending_value_lessthan"]);
		
		$setcrm_highmargin_treatment=trim(@$_POST["setcrm_highmargin_treatment"]);
		$setcrm_highmargin_month=trim(@$_POST["setcrm_highmargin_month"]);
		$setcrm_highmargin_value_morethan=trim(@$_POST["setcrm_highmargin_value_morethan"]);
		$setcrm_highmargin_value_equal=trim(@$_POST["setcrm_highmargin_value_equal"]);
		$setcrm_highmargin_value_lessthan=trim(@$_POST["setcrm_highmargin_value_lessthan"]);
		
		$setcrm_referal_person=trim(@$_POST["setcrm_referal_person"]);
		$setcrm_referal_month=trim(@$_POST["setcrm_referal_month"]);
		$setcrm_referal_morethan=trim(@$_POST["setcrm_referal_morethan"]);
		$setcrm_referal_equal=trim(@$_POST["setcrm_referal_equal"]);
		$setcrm_referal_lessthan=trim(@$_POST["setcrm_referal_lessthan"]);
		
		$setcrm_kerewelan_high=trim(@$_POST["setcrm_kerewelan_high"]);
		$setcrm_kerewelan_normal=trim(@$_POST["setcrm_kerewelan_normal"]);
		$setcrm_kerewelan_low=trim(@$_POST["setcrm_kerewelan_low"]);
		
		$setcrm_disiplin_high=trim(@$_POST["setcrm_disiplin_high"]);
		$setcrm_disiplin_normal=trim(@$_POST["setcrm_disiplin_normal"]);
		$setcrm_disiplin_low=trim(@$_POST["setcrm_disiplin_low"]);
		
		$setcrm_treatment_month=trim(@$_POST["setcrm_treatment_month"]);
		$setcrm_treatment_nonmedis=trim(@$_POST["setcrm_treatment_nonmedis"]);
		$setcrm_treatment_medis=trim(@$_POST["setcrm_treatment_medis"]);
		$setcrm_treatment_morethan=trim(@$_POST["setcrm_treatment_morethan"]);
		$setcrm_treatment_equal=trim(@$_POST["setcrm_treatment_equal"]);
		$setcrm_treatment_lessthan=trim(@$_POST["setcrm_treatment_lessthan"]);

		$setcrm_update=@$_SESSION[SESSION_USERID];
		$setcrm_date_update=date(LONG_FORMATDATE);
		$result = $this->m_crm_setup->crm_setup_update($setcrm_id,
													$setcrm_frequency_bulan1, $setcrm_frequency_bulan2, $setcrm_frequency_value_morethan, $setcrm_frequency_value_equal, $setcrm_frequency_value_lessthan,
													$setcrm_recency_days, $setcrm_recency_value_morethan, $setcrm_recency_value_lessthan,
													$setcrm_spending_value_morethan, $setcrm_spending_value_equal, $setcrm_spending_value_lessthan,
													$setcrm_highmargin_treatment, $setcrm_highmargin_month, $setcrm_highmargin_value_morethan, $setcrm_highmargin_value_equal, $setcrm_highmargin_value_lessthan,
													$setcrm_referal_person, $setcrm_referal_month, $setcrm_referal_morethan, $setcrm_referal_equal, $setcrm_referal_lessthan,
													$setcrm_kerewelan_high, $setcrm_kerewelan_normal, $setcrm_kerewelan_low,
													$setcrm_disiplin_high, $setcrm_disiplin_normal, $setcrm_disiplin_low,
													$setcrm_treatment_month, $setcrm_treatment_nonmedis, $setcrm_treatment_medis, $setcrm_treatment_morethan, $setcrm_treatment_equal, $setcrm_treatment_lessthan,
													$setcrm_update, $setcrm_date_update);
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
	
	
}
?>