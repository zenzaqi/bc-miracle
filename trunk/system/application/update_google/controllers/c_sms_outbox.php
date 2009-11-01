<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: sms_outbox Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_sms_outbox.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of sms_outbox
class C_sms_outbox extends Controller {

	//constructor
	function C_sms_outbox(){
		parent::Controller();
		$this->load->model('m_sms_outbox', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_sms_outbox');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->sms_outbox_list();
				break;
			case "UPDATE":
				$this->sms_outbox_update();
				break;
			case "CREATE":
				$this->sms_outbox_create();
				break;
			case "DELETE":
				$this->sms_outbox_delete();
				break;
			case "SEARCH":
				$this->sms_outbox_search();
				break;
			case "PRINT":
				$this->sms_outbox_print();
				break;
			case "EXCEL":
				$this->sms_outbox_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function sms_outbox_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_sms_outbox->sms_outbox_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function sms_outbox_update(){
		//POST variable here
		$osms_id=trim(@$_POST["osms_id"]);
		$osms_dest=trim(@$_POST["osms_dest"]);
		$osms_dest=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_dest);
		$osms_dest=str_replace("'", '"',$osms_dest);
		$osms_tanggal=trim(@$_POST["osms_tanggal"]);
		$osms_isi=trim(@$_POST["osms_isi"]);
		$osms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_isi);
		$osms_isi=str_replace("'", '"',$osms_isi);
		$osms_status=trim(@$_POST["osms_status"]);
		$osms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_status);
		$osms_status=str_replace("'", '"',$osms_status);
		$osms_kategori=trim(@$_POST["osms_kategori"]);
		$osms_kategori=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_kategori);
		$osms_kategori=str_replace("'", '"',$osms_kategori);
		$osms_ready=trim(@$_POST["osms_ready"]);
		$osms_ready=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_ready);
		$osms_ready=str_replace("'", '"',$osms_ready);
		$result = $this->m_sms_outbox->sms_outbox_update($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready );
		echo $result;
	}
	
	//function for create new record
	function sms_outbox_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$osms_dest=trim(@$_POST["osms_dest"]);
		$osms_dest=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_dest);
		$osms_dest=str_replace("'", '"',$osms_dest);
		$osms_tanggal=trim(@$_POST["osms_tanggal"]);
		$osms_isi=trim(@$_POST["osms_isi"]);
		$osms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_isi);
		$osms_isi=str_replace("'", '"',$osms_isi);
		$osms_status=trim(@$_POST["osms_status"]);
		$osms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_status);
		$osms_status=str_replace("'", '"',$osms_status);
		$osms_kategori=trim(@$_POST["osms_kategori"]);
		$osms_kategori=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_kategori);
		$osms_kategori=str_replace("'", '"',$osms_kategori);
		$osms_ready=trim(@$_POST["osms_ready"]);
		$osms_ready=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_ready);
		$osms_ready=str_replace("'", '"',$osms_ready);
		$result=$this->m_sms_outbox->sms_outbox_create($osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready );
		echo $result;
	}

	//function for delete selected record
	function sms_outbox_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_sms_outbox->sms_outbox_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function sms_outbox_search(){
		//POST varibale here
		$osms_id=trim(@$_POST["osms_id"]);
		$osms_dest=trim(@$_POST["osms_dest"]);
		$osms_dest=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_dest);
		$osms_dest=str_replace("'", '"',$osms_dest);
		$osms_tanggal=trim(@$_POST["osms_tanggal"]);
		$osms_isi=trim(@$_POST["osms_isi"]);
		$osms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_isi);
		$osms_isi=str_replace("'", '"',$osms_isi);
		$osms_status=trim(@$_POST["osms_status"]);
		$osms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_status);
		$osms_status=str_replace("'", '"',$osms_status);
		$osms_kategori=trim(@$_POST["osms_kategori"]);
		$osms_kategori=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_kategori);
		$osms_kategori=str_replace("'", '"',$osms_kategori);
		$osms_ready=trim(@$_POST["osms_ready"]);
		$osms_ready=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_ready);
		$osms_ready=str_replace("'", '"',$osms_ready);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_sms_outbox->sms_outbox_search($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ,$start,$end);
		echo $result;
	}


	function sms_outbox_print(){
  		//POST varibale here
		$osms_id=trim(@$_POST["osms_id"]);
		$osms_dest=trim(@$_POST["osms_dest"]);
		$osms_dest=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_dest);
		$osms_dest=str_replace("'", '"',$osms_dest);
		$osms_tanggal=trim(@$_POST["osms_tanggal"]);
		$osms_isi=trim(@$_POST["osms_isi"]);
		$osms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_isi);
		$osms_isi=str_replace("'", '"',$osms_isi);
		$osms_status=trim(@$_POST["osms_status"]);
		$osms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_status);
		$osms_status=str_replace("'", '"',$osms_status);
		$osms_kategori=trim(@$_POST["osms_kategori"]);
		$osms_kategori=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_kategori);
		$osms_kategori=str_replace("'", '"',$osms_kategori);
		$osms_ready=trim(@$_POST["osms_ready"]);
		$osms_ready=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_ready);
		$osms_ready=str_replace("'", '"',$osms_ready);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_sms_outbox->sms_outbox_print($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=7;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("sms_outboxlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Sms_outbox Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Sms_outbox List'><caption>SMS_OUTBOX</caption><thead><tr><th scope='col'>Osms Id</th><th scope='col'>Osms Dest</th><th scope='col'>Osms Tanggal</th><th scope='col'>Osms Isi</th><th scope='col'>Osms Status</th><th scope='col'>Osms Kategori</th><th scope='col'>Osms Ready</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Sms_outbox</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['osms_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['osms_dest']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['osms_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['osms_isi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['osms_status']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['osms_kategori']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['osms_ready']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function sms_outbox_export_excel(){
		//POST varibale here
		$osms_id=trim(@$_POST["osms_id"]);
		$osms_dest=trim(@$_POST["osms_dest"]);
		$osms_dest=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_dest);
		$osms_dest=str_replace("'", '"',$osms_dest);
		$osms_tanggal=trim(@$_POST["osms_tanggal"]);
		$osms_isi=trim(@$_POST["osms_isi"]);
		$osms_isi=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_isi);
		$osms_isi=str_replace("'", '"',$osms_isi);
		$osms_status=trim(@$_POST["osms_status"]);
		$osms_status=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_status);
		$osms_status=str_replace("'", '"',$osms_status);
		$osms_kategori=trim(@$_POST["osms_kategori"]);
		$osms_kategori=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_kategori);
		$osms_kategori=str_replace("'", '"',$osms_kategori);
		$osms_ready=trim(@$_POST["osms_ready"]);
		$osms_ready=str_replace("/(<\/?)(p)([^>]*>)", "",$osms_ready);
		$osms_ready=str_replace("'", '"',$osms_ready);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_sms_outbox->sms_outbox_export_excel($osms_id ,$osms_dest ,$osms_tanggal ,$osms_isi ,$osms_status ,$osms_kategori ,$osms_ready ,$option,$filter);
		
		to_excel($query,"sms_outbox"); 
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