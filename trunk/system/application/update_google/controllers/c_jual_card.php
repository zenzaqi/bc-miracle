<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jual_card Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jual_card.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of jual_card
class C_jual_card extends Controller {

	//constructor
	function C_jual_card(){
		parent::Controller();
		$this->load->model('m_jual_card', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_jual_card');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jual_card_list();
				break;
			case "UPDATE":
				$this->jual_card_update();
				break;
			case "CREATE":
				$this->jual_card_create();
				break;
			case "DELETE":
				$this->jual_card_delete();
				break;
			case "SEARCH":
				$this->jual_card_search();
				break;
			case "PRINT":
				$this->jual_card_print();
				break;
			case "EXCEL":
				$this->jual_card_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jual_card_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_jual_card->jual_card_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jual_card_update(){
		//POST variable here
		$jcard_nobukti=trim(@$_POST["jcard_nobukti"]);
		$jcard_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nobukti);
		$jcard_nobukti=str_replace("'", '"',$jcard_nobukti);
		$jcard_tanggal=trim(@$_POST["jcard_tanggal"]);
		$jcard_nama=trim(@$_POST["jcard_nama"]);
		$jcard_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nama);
		$jcard_nama=str_replace("'", '"',$jcard_nama);
		$jcard_jenis=trim(@$_POST["jcard_jenis"]);
		$jcard_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_jenis);
		$jcard_jenis=str_replace("'", '"',$jcard_jenis);
		$jcard_no=trim(@$_POST["jcard_no"]);
		$jcard_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_no);
		$jcard_no=str_replace("'", '"',$jcard_no);
		$jcard_nilai=trim(@$_POST["jcard_nilai"]);
		$jcard_trans=trim(@$_POST["jcard_trans"]);
		$jcard_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_trans);
		$jcard_trans=str_replace("'", '"',$jcard_trans);
		$jcard_creator=trim(@$_POST["jcard_creator"]);
		$jcard_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_creator);
		$jcard_creator=str_replace("'", '"',$jcard_creator);
		$jcard_date_create=trim(@$_POST["jcard_date_create"]);
		$jcard_update=trim(@$_POST["jcard_update"]);
		$jcard_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_update);
		$jcard_update=str_replace("'", '"',$jcard_update);
		$jcard_date_update=trim(@$_POST["jcard_date_update"]);
		$jcard_revised=trim(@$_POST["jcard_revised"]);
		$result = $this->m_jual_card->jual_card_update($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised );
		echo $result;
	}
	
	//function for create new record
	function jual_card_create(){
		//POST varible here
		$jcard_nobukti=trim(@$_POST["jcard_nobukti"]);
		$jcard_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nobukti);
		$jcard_nobukti=str_replace("'", '"',$jcard_nobukti);
		$jcard_tanggal=trim(@$_POST["jcard_tanggal"]);
		$jcard_nama=trim(@$_POST["jcard_nama"]);
		$jcard_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nama);
		$jcard_nama=str_replace("'", '"',$jcard_nama);
		$jcard_jenis=trim(@$_POST["jcard_jenis"]);
		$jcard_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_jenis);
		$jcard_jenis=str_replace("'", '"',$jcard_jenis);
		$jcard_no=trim(@$_POST["jcard_no"]);
		$jcard_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_no);
		$jcard_no=str_replace("'", '"',$jcard_no);
		$jcard_nilai=trim(@$_POST["jcard_nilai"]);
		$jcard_trans=trim(@$_POST["jcard_trans"]);
		$jcard_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_trans);
		$jcard_trans=str_replace("'", '"',$jcard_trans);
		$jcard_creator=trim(@$_POST["jcard_creator"]);
		$jcard_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_creator);
		$jcard_creator=str_replace("'", '"',$jcard_creator);
		$jcard_date_create=trim(@$_POST["jcard_date_create"]);
		$jcard_update=trim(@$_POST["jcard_update"]);
		$jcard_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_update);
		$jcard_update=str_replace("'", '"',$jcard_update);
		$jcard_date_update=trim(@$_POST["jcard_date_update"]);
		$jcard_revised=trim(@$_POST["jcard_revised"]);
		$result=$this->m_jual_card->jual_card_create($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised );
		echo $result;
	}

	//function for delete selected record
	function jual_card_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jual_card->jual_card_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jual_card_search(){
		//POST varibale here
		$jcard_nobukti=trim(@$_POST["jcard_nobukti"]);
		$jcard_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nobukti);
		$jcard_nobukti=str_replace("'", '"',$jcard_nobukti);
		$jcard_tanggal=trim(@$_POST["jcard_tanggal"]);
		$jcard_nama=trim(@$_POST["jcard_nama"]);
		$jcard_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nama);
		$jcard_nama=str_replace("'", '"',$jcard_nama);
		$jcard_jenis=trim(@$_POST["jcard_jenis"]);
		$jcard_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_jenis);
		$jcard_jenis=str_replace("'", '"',$jcard_jenis);
		$jcard_no=trim(@$_POST["jcard_no"]);
		$jcard_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_no);
		$jcard_no=str_replace("'", '"',$jcard_no);
		$jcard_nilai=trim(@$_POST["jcard_nilai"]);
		$jcard_trans=trim(@$_POST["jcard_trans"]);
		$jcard_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_trans);
		$jcard_trans=str_replace("'", '"',$jcard_trans);
		$jcard_creator=trim(@$_POST["jcard_creator"]);
		$jcard_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_creator);
		$jcard_creator=str_replace("'", '"',$jcard_creator);
		$jcard_date_create=trim(@$_POST["jcard_date_create"]);
		$jcard_update=trim(@$_POST["jcard_update"]);
		$jcard_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_update);
		$jcard_update=str_replace("'", '"',$jcard_update);
		$jcard_date_update=trim(@$_POST["jcard_date_update"]);
		$jcard_revised=trim(@$_POST["jcard_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jual_card->jual_card_search($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ,$start,$end);
		echo $result;
	}


	function jual_card_print(){
  		//POST varibale here
		$jcard_nobukti=trim(@$_POST["jcard_nobukti"]);
		$jcard_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nobukti);
		$jcard_nobukti=str_replace("'", '"',$jcard_nobukti);
		$jcard_tanggal=trim(@$_POST["jcard_tanggal"]);
		$jcard_nama=trim(@$_POST["jcard_nama"]);
		$jcard_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nama);
		$jcard_nama=str_replace("'", '"',$jcard_nama);
		$jcard_jenis=trim(@$_POST["jcard_jenis"]);
		$jcard_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_jenis);
		$jcard_jenis=str_replace("'", '"',$jcard_jenis);
		$jcard_no=trim(@$_POST["jcard_no"]);
		$jcard_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_no);
		$jcard_no=str_replace("'", '"',$jcard_no);
		$jcard_nilai=trim(@$_POST["jcard_nilai"]);
		$jcard_trans=trim(@$_POST["jcard_trans"]);
		$jcard_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_trans);
		$jcard_trans=str_replace("'", '"',$jcard_trans);
		$jcard_creator=trim(@$_POST["jcard_creator"]);
		$jcard_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_creator);
		$jcard_creator=str_replace("'", '"',$jcard_creator);
		$jcard_date_create=trim(@$_POST["jcard_date_create"]);
		$jcard_update=trim(@$_POST["jcard_update"]);
		$jcard_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_update);
		$jcard_update=str_replace("'", '"',$jcard_update);
		$jcard_date_update=trim(@$_POST["jcard_date_update"]);
		$jcard_revised=trim(@$_POST["jcard_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jual_card->jual_card_print($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=12;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jual_cardlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jual_card Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jual_card List'><caption>JUAL_CARD</caption><thead><tr><th scope='col'>Jcard Nobukti</th><th scope='col'>Jcard Tanggal</th><th scope='col'>Jcard Nama</th><th scope='col'>Jcard Jenis</th><th scope='col'>Jcard No</th><th scope='col'>Jcard Nilai</th><th scope='col'>Jcard Trans</th><th scope='col'>Jcard Creator</th><th scope='col'>Jcard Date Create</th><th scope='col'>Jcard Update</th><th scope='col'>Jcard Date Update</th><th scope='col'>Jcard Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jual_card</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jcard_nobukti']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jcard_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_jenis']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_trans']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_date_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jcard_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jual_card_export_excel(){
		//POST varibale here
		$jcard_nobukti=trim(@$_POST["jcard_nobukti"]);
		$jcard_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nobukti);
		$jcard_nobukti=str_replace("'", '"',$jcard_nobukti);
		$jcard_tanggal=trim(@$_POST["jcard_tanggal"]);
		$jcard_nama=trim(@$_POST["jcard_nama"]);
		$jcard_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_nama);
		$jcard_nama=str_replace("'", '"',$jcard_nama);
		$jcard_jenis=trim(@$_POST["jcard_jenis"]);
		$jcard_jenis=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_jenis);
		$jcard_jenis=str_replace("'", '"',$jcard_jenis);
		$jcard_no=trim(@$_POST["jcard_no"]);
		$jcard_no=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_no);
		$jcard_no=str_replace("'", '"',$jcard_no);
		$jcard_nilai=trim(@$_POST["jcard_nilai"]);
		$jcard_trans=trim(@$_POST["jcard_trans"]);
		$jcard_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_trans);
		$jcard_trans=str_replace("'", '"',$jcard_trans);
		$jcard_creator=trim(@$_POST["jcard_creator"]);
		$jcard_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_creator);
		$jcard_creator=str_replace("'", '"',$jcard_creator);
		$jcard_date_create=trim(@$_POST["jcard_date_create"]);
		$jcard_update=trim(@$_POST["jcard_update"]);
		$jcard_update=str_replace("/(<\/?)(p)([^>]*>)", "",$jcard_update);
		$jcard_update=str_replace("'", '"',$jcard_update);
		$jcard_date_update=trim(@$_POST["jcard_date_update"]);
		$jcard_revised=trim(@$_POST["jcard_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jual_card->jual_card_export_excel($jcard_nobukti ,$jcard_tanggal ,$jcard_nama ,$jcard_jenis ,$jcard_no ,$jcard_nilai ,$jcard_trans ,$jcard_creator ,$jcard_date_create ,$jcard_update ,$jcard_date_update ,$jcard_revised ,$option,$filter);
		
		to_excel($query,"jual_card"); 
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