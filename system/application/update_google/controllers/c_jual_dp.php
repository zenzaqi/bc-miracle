<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jual_dp Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_jual_dp.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of jual_dp
class C_jual_dp extends Controller {

	//constructor
	function C_jual_dp(){
		parent::Controller();
		$this->load->model('m_jual_dp', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_jual_dp');
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->jual_dp_list();
				break;
			case "UPDATE":
				$this->jual_dp_update();
				break;
			case "CREATE":
				$this->jual_dp_create();
				break;
			case "DELETE":
				$this->jual_dp_delete();
				break;
			case "SEARCH":
				$this->jual_dp_search();
				break;
			case "PRINT":
				$this->jual_dp_print();
				break;
			case "EXCEL":
				$this->jual_dp_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function jual_dp_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_jual_dp->jual_dp_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function jual_dp_update(){
		//POST variable here
		$dp_nobukti=trim(@$_POST["dp_nobukti"]);
		$dp_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_nobukti);
		$dp_nobukti=str_replace("'", '"',$dp_nobukti);
		$dp_tanggal=trim(@$_POST["dp_tanggal"]);
		$dp_nilai=trim(@$_POST["dp_nilai"]);
		$dp_trans=trim(@$_POST["dp_trans"]);
		$dp_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_trans);
		$dp_trans=str_replace("'", '"',$dp_trans);
		$dp_creator=trim(@$_POST["dp_creator"]);
		$dp_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_creator);
		$dp_creator=str_replace("'", '"',$dp_creator);
		$dp_date_create=trim(@$_POST["dp_date_create"]);
		$dp_update=trim(@$_POST["dp_update"]);
		$dp_update=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_update);
		$dp_update=str_replace("'", '"',$dp_update);
		$dp_date_update=trim(@$_POST["dp_date_update"]);
		$dp_revised=trim(@$_POST["dp_revised"]);
		$result = $this->m_jual_dp->jual_dp_update($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$dp_creator ,$dp_date_create ,$dp_update ,$dp_date_update ,$dp_revised );
		echo $result;
	}
	
	//function for create new record
	function jual_dp_create(){
		//POST varible here
		$dp_nobukti=trim(@$_POST["dp_nobukti"]);
		$dp_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_nobukti);
		$dp_nobukti=str_replace("'", '"',$dp_nobukti);
		$dp_tanggal=trim(@$_POST["dp_tanggal"]);
		$dp_nilai=trim(@$_POST["dp_nilai"]);
		$dp_trans=trim(@$_POST["dp_trans"]);
		$dp_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_trans);
		$dp_trans=str_replace("'", '"',$dp_trans);
		$dp_creator=trim(@$_POST["dp_creator"]);
		$dp_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_creator);
		$dp_creator=str_replace("'", '"',$dp_creator);
		$dp_date_create=trim(@$_POST["dp_date_create"]);
		$dp_update=trim(@$_POST["dp_update"]);
		$dp_update=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_update);
		$dp_update=str_replace("'", '"',$dp_update);
		$dp_date_update=trim(@$_POST["dp_date_update"]);
		$dp_revised=trim(@$_POST["dp_revised"]);
		$result=$this->m_jual_dp->jual_dp_create($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$dp_creator ,$dp_date_create ,$dp_update ,$dp_date_update ,$dp_revised );
		echo $result;
	}

	//function for delete selected record
	function jual_dp_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_jual_dp->jual_dp_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function jual_dp_search(){
		//POST varibale here
		$dp_nobukti=trim(@$_POST["dp_nobukti"]);
		$dp_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_nobukti);
		$dp_nobukti=str_replace("'", '"',$dp_nobukti);
		$dp_tanggal=trim(@$_POST["dp_tanggal"]);
		$dp_nilai=trim(@$_POST["dp_nilai"]);
		$dp_trans=trim(@$_POST["dp_trans"]);
		$dp_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_trans);
		$dp_trans=str_replace("'", '"',$dp_trans);
		$dp_creator=trim(@$_POST["dp_creator"]);
		$dp_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_creator);
		$dp_creator=str_replace("'", '"',$dp_creator);
		$dp_date_create=trim(@$_POST["dp_date_create"]);
		$dp_update=trim(@$_POST["dp_update"]);
		$dp_update=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_update);
		$dp_update=str_replace("'", '"',$dp_update);
		$dp_date_update=trim(@$_POST["dp_date_update"]);
		$dp_revised=trim(@$_POST["dp_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_jual_dp->jual_dp_search($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$dp_creator ,$dp_date_create ,$dp_update ,$dp_date_update ,$dp_revised ,$start,$end);
		echo $result;
	}


	function jual_dp_print(){
  		//POST varibale here
		$dp_nobukti=trim(@$_POST["dp_nobukti"]);
		$dp_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_nobukti);
		$dp_nobukti=str_replace("'", '"',$dp_nobukti);
		$dp_tanggal=trim(@$_POST["dp_tanggal"]);
		$dp_nilai=trim(@$_POST["dp_nilai"]);
		$dp_trans=trim(@$_POST["dp_trans"]);
		$dp_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_trans);
		$dp_trans=str_replace("'", '"',$dp_trans);
		$dp_creator=trim(@$_POST["dp_creator"]);
		$dp_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_creator);
		$dp_creator=str_replace("'", '"',$dp_creator);
		$dp_date_create=trim(@$_POST["dp_date_create"]);
		$dp_update=trim(@$_POST["dp_update"]);
		$dp_update=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_update);
		$dp_update=str_replace("'", '"',$dp_update);
		$dp_date_update=trim(@$_POST["dp_date_update"]);
		$dp_revised=trim(@$_POST["dp_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_jual_dp->jual_dp_print($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$dp_creator ,$dp_date_create ,$dp_update ,$dp_date_update ,$dp_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=9;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("jual_dplist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Jual_dp Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Jual_dp List'><caption>JUAL_DP</caption><thead><tr><th scope='col'>Dp Nobukti</th><th scope='col'>Dp Tanggal</th><th scope='col'>Dp Nilai</th><th scope='col'>Dp Trans</th><th scope='col'>Dp Creator</th><th scope='col'>Dp Date Create</th><th scope='col'>Dp Update</th><th scope='col'>Dp Date Update</th><th scope='col'>Dp Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Jual_dp</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['dp_nobukti']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['dp_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_nilai']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_trans']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_date_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['dp_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function jual_dp_export_excel(){
		//POST varibale here
		$dp_nobukti=trim(@$_POST["dp_nobukti"]);
		$dp_nobukti=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_nobukti);
		$dp_nobukti=str_replace("'", '"',$dp_nobukti);
		$dp_tanggal=trim(@$_POST["dp_tanggal"]);
		$dp_nilai=trim(@$_POST["dp_nilai"]);
		$dp_trans=trim(@$_POST["dp_trans"]);
		$dp_trans=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_trans);
		$dp_trans=str_replace("'", '"',$dp_trans);
		$dp_creator=trim(@$_POST["dp_creator"]);
		$dp_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_creator);
		$dp_creator=str_replace("'", '"',$dp_creator);
		$dp_date_create=trim(@$_POST["dp_date_create"]);
		$dp_update=trim(@$_POST["dp_update"]);
		$dp_update=str_replace("/(<\/?)(p)([^>]*>)", "",$dp_update);
		$dp_update=str_replace("'", '"',$dp_update);
		$dp_date_update=trim(@$_POST["dp_date_update"]);
		$dp_revised=trim(@$_POST["dp_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_jual_dp->jual_dp_export_excel($dp_nobukti ,$dp_tanggal ,$dp_nilai ,$dp_trans ,$dp_creator ,$dp_date_create ,$dp_update ,$dp_date_update ,$dp_revised ,$option,$filter);
		
		to_excel($query,"jual_dp"); 
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