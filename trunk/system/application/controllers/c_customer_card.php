<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: customer_card Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_customer_card.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of customer_card
class C_customer_card extends Controller {

	//constructor
	function C_customer_card(){
		parent::Controller();
		$this->load->model('m_customer_card', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_customer_card');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->customer_card_list();
				break;
			case "UPDATE":
				$this->customer_card_update();
				break;
			case "CREATE":
				$this->customer_card_create();
				break;
			case "DELETE":
				$this->customer_card_delete();
				break;
			case "SEARCH":
				$this->customer_card_search();
				break;
			case "PRINT":
				$this->customer_card_print();
				break;
			case "EXCEL":
				$this->customer_card_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function customer_card_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_customer_card->customer_card_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function customer_card_update(){
		//POST variable here
		$card_id=trim(@$_POST["card_id"]);
		$card_no=trim(@$_POST["card_no"]);
		$card_no=str_replace("/(<\/?)(p)([^>]*>)", "",$card_no);
		$card_no=str_replace("'", '"',$card_no);
		$card_nama=trim(@$_POST["card_nama"]);
		$card_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nama);
		$card_nama=str_replace("'", '"',$card_nama);
		$card_alamat=trim(@$_POST["card_alamat"]);
		$card_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$card_alamat);
		$card_alamat=str_replace("'", '"',$card_alamat);
		$card_nomember=trim(@$_POST["card_nomember"]);
		$card_nomember=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nomember);
		$card_nomember=str_replace("'", '"',$card_nomember);
		$card_pointsaldo=trim(@$_POST["card_pointsaldo"]);
		$result = $this->m_customer_card->customer_card_update($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo );
		echo $result;
	}
	
	//function for create new record
	function customer_card_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$card_no=trim(@$_POST["card_no"]);
		$card_no=str_replace("/(<\/?)(p)([^>]*>)", "",$card_no);
		$card_no=str_replace("'", '"',$card_no);
		$card_nama=trim(@$_POST["card_nama"]);
		$card_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nama);
		$card_nama=str_replace("'", '"',$card_nama);
		$card_alamat=trim(@$_POST["card_alamat"]);
		$card_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$card_alamat);
		$card_alamat=str_replace("'", '"',$card_alamat);
		$card_nomember=trim(@$_POST["card_nomember"]);
		$card_nomember=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nomember);
		$card_nomember=str_replace("'", '"',$card_nomember);
		$card_pointsaldo=trim(@$_POST["card_pointsaldo"]);
		$result=$this->m_customer_card->customer_card_create($card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo );
		echo $result;
	}

	//function for delete selected record
	function customer_card_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_customer_card->customer_card_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function customer_card_search(){
		//POST varibale here
		$card_id=trim(@$_POST["card_id"]);
		$card_no=trim(@$_POST["card_no"]);
		$card_no=str_replace("/(<\/?)(p)([^>]*>)", "",$card_no);
		$card_no=str_replace("'", '"',$card_no);
		$card_nama=trim(@$_POST["card_nama"]);
		$card_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nama);
		$card_nama=str_replace("'", '"',$card_nama);
		$card_alamat=trim(@$_POST["card_alamat"]);
		$card_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$card_alamat);
		$card_alamat=str_replace("'", '"',$card_alamat);
		$card_nomember=trim(@$_POST["card_nomember"]);
		$card_nomember=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nomember);
		$card_nomember=str_replace("'", '"',$card_nomember);
		$card_pointsaldo=trim(@$_POST["card_pointsaldo"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_customer_card->customer_card_search($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$start,$end);
		echo $result;
	}


	function customer_card_print(){
  		//POST varibale here
		$card_id=trim(@$_POST["card_id"]);
		$card_no=trim(@$_POST["card_no"]);
		$card_no=str_replace("/(<\/?)(p)([^>]*>)", "",$card_no);
		$card_no=str_replace("'", '"',$card_no);
		$card_nama=trim(@$_POST["card_nama"]);
		$card_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nama);
		$card_nama=str_replace("'", '"',$card_nama);
		$card_alamat=trim(@$_POST["card_alamat"]);
		$card_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$card_alamat);
		$card_alamat=str_replace("'", '"',$card_alamat);
		$card_nomember=trim(@$_POST["card_nomember"]);
		$card_nomember=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nomember);
		$card_nomember=str_replace("'", '"',$card_nomember);
		$card_pointsaldo=trim(@$_POST["card_pointsaldo"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_customer_card->customer_card_print($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=6;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("customer_cardlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Customer_card Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Customer_card List'><caption>CUSTOMER_CARD</caption><thead><tr><th scope='col'>Card Id</th><th scope='col'>Card No</th><th scope='col'>Card Nama</th><th scope='col'>Card Alamat</th><th scope='col'>Card Nomember</th><th scope='col'>Card Pointsaldo</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Customer_card</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['card_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['card_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['card_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['card_alamat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['card_nomember']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['card_pointsaldo']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function customer_card_export_excel(){
		//POST varibale here
		$card_id=trim(@$_POST["card_id"]);
		$card_no=trim(@$_POST["card_no"]);
		$card_no=str_replace("/(<\/?)(p)([^>]*>)", "",$card_no);
		$card_no=str_replace("'", '"',$card_no);
		$card_nama=trim(@$_POST["card_nama"]);
		$card_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nama);
		$card_nama=str_replace("'", '"',$card_nama);
		$card_alamat=trim(@$_POST["card_alamat"]);
		$card_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$card_alamat);
		$card_alamat=str_replace("'", '"',$card_alamat);
		$card_nomember=trim(@$_POST["card_nomember"]);
		$card_nomember=str_replace("/(<\/?)(p)([^>]*>)", "",$card_nomember);
		$card_nomember=str_replace("'", '"',$card_nomember);
		$card_pointsaldo=trim(@$_POST["card_pointsaldo"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_customer_card->customer_card_export_excel($card_id ,$card_no ,$card_nama ,$card_alamat ,$card_nomember ,$card_pointsaldo ,$option,$filter);
		
		to_excel($query,"customer_card"); 
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