<?php
/* 	
	+ Module  		: join_customer Controller
	+ Description	: For record controller process back-end
	+ Filename 		: c_join_customer.php
 	+ creator 		: Fred
	
*/

//class of member_setup
class C_join_customer extends Controller {

	//constructor
	function C_join_customer(){
		parent::Controller();
		session_start();
		$this->load->model('m_join_customer', '', TRUE);
	}
	
	
	function get_customer_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_public_function->get_customer_list($query,$start,$end);
		echo $result;
	}
	
	
	//set index
	function index(){
		$this->load->plugin('to_excel');
		$this->load->view('main/v_join_customer');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "UPDATE":
				$this->join_customer_update();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	
	
	//function for update record
	function join_customer_update(){
		//POST variable here
		//$iklantoday_id=trim(@$_POST["iklantoday_id"]);
		$cust_asal_id=trim(@$_POST["cust_asal_id"]);
		$cust_tujuan_id=trim(@$_POST["cust_tujuan_id"]);
		//$iklantoday_tanggal=trim(@$_POST["iklantoday_tanggal"]);
		//$iklantoday_keterangan=trim(@$_POST["iklantoday_keterangan"]);

		//$iklantoday_update=@$_SESSION[SESSION_USERID];
		//$iklantoday_date_update=date(LONG_FORMATDATE);

		$result = $this->m_join_customer->join_customer_update($cust_asal_id, $cust_tujuan_id);
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