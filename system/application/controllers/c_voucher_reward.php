<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: voucher_reward Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_voucher_reward.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:13:44
	
*/

//class of voucher_reward
class C_voucher_reward extends Controller {

	//constructor
	function C_voucher_reward(){
		parent::Controller();
		$this->load->model('m_voucher_reward', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_voucher_reward');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->voucher_reward_list();
				break;
			case "UPDATE":
				$this->voucher_reward_update();
				break;
			case "CREATE":
				$this->voucher_reward_create();
				break;
			case "DELETE":
				$this->voucher_reward_delete();
				break;
			case "SEARCH":
				$this->voucher_reward_search();
				break;
			case "PRINT":
				$this->voucher_reward_print();
				break;
			case "EXCEL":
				$this->voucher_reward_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function voucher_reward_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_voucher_reward->voucher_reward_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function voucher_reward_update(){
		//POST variable here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace(",", ",",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace(",", ",",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$result = $this->m_voucher_reward->voucher_reward_update($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa      );
		echo $result;
	}
	
	//function for create new record
	function voucher_reward_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$result=$this->m_voucher_reward->voucher_reward_create($voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa );
		echo $result;
	}

	//function for delete selected record
	function voucher_reward_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_voucher_reward->voucher_reward_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function voucher_reward_search(){
		//POST varibale here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_voucher_reward->voucher_reward_search($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ,$start,$end);
		echo $result;
	}


	function voucher_reward_print(){
  		//POST varibale here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_voucher_reward->voucher_reward_print($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=11;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("voucher_rewardlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Voucher_reward Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Voucher_reward List'><caption>VOUCHER_REWARD</caption><thead><tr><th scope='col'>Voucher Id</th><th scope='col'>Voucher Nama</th><th scope='col'>Voucher Point</th><th scope='col'>Voucher Jenis</th><th scope='col'>Voucher Jumlah</th><th scope='col'>Voucher Kadaluarsa</th><th scope='col'>Voucher Creator</th><th scope='col'>Voucher Date Create</th><th scope='col'>Voucher Update</th><th scope='col'>Voucher Date Update</th><th scope='col'>Voucher Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Voucher_reward</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['voucher_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['voucher_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_point']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_jenis']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_jumlah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_kadaluarsa']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['voucher_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function voucher_reward_export_excel(){
		//POST varibale here
		$voucher_id=trim(@$_POST["voucher_id"]);
		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_nama);
		$voucher_nama=str_replace("'", '"',$voucher_nama);
		$voucher_point=trim(@$_POST["voucher_point"]);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$voucher_jenis);
		$voucher_jenis=str_replace("'", '"',$voucher_jenis);
		$voucher_jumlah=trim(@$_POST["voucher_jumlah"]);
		$voucher_kadaluarsa=trim(@$_POST["voucher_kadaluarsa"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_voucher_reward->voucher_reward_export_excel($voucher_id ,$voucher_nama ,$voucher_point ,$voucher_jenis ,$voucher_jumlah ,$voucher_kadaluarsa ,$option,$filter);
		
		to_excel($query,"voucher_reward"); 
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