<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: akun Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_akun.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 16/Jul/2009 14:18:30
	
*/

//class of akun
class C_akun extends Controller {

	//constructor
	function C_akun(){
		parent::Controller();
		$this->load->model('m_akun', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_akun');
	}
	
	function get_akun_kode_list(){
		$result=$this->m_akun->get_akun_kode_list();
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->akun_list();
				break;
			case "UPDATE":
				$this->akun_update();
				break;
			case "CREATE":
				$this->akun_create();
				break;
			case "DELETE":
				$this->akun_delete();
				break;
			case "SEARCH":
				$this->akun_search();
				break;
			case "PRINT":
				$this->akun_print();
				break;
			case "EXCEL":
				$this->akun_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function akun_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_akun->akun_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function akun_update(){
		//POST variable here
		$akun_id=trim(@$_POST["akun_id"]);
		$akun_kode=trim(@$_POST["akun_kode"]);
		$akun_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kode);
		$akun_kode=str_replace("'", '"',$akun_kode);
		$akun_nama=trim(@$_POST["akun_nama"]);
		$akun_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_nama);
		$akun_nama=str_replace("'", '"',$akun_nama);
		$akun_parent=trim(@$_POST["akun_parent"]);
		$akun_neraca=trim(@$_POST["akun_neraca"]);
		$akun_neraca=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_neraca);
		$akun_neraca=str_replace("'", '"',$akun_neraca);
		$akun_rugilaba=trim(@$_POST["akun_rugilaba"]);
		$akun_rugilaba=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_rugilaba);
		$akun_rugilaba=str_replace("'", '"',$akun_rugilaba);
		$akun_debet=trim(@$_POST["akun_debet"]);
		$akun_debet=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_debet);
		$akun_debet=str_replace("'", '"',$akun_debet);
		$akun_kredit=trim(@$_POST["akun_kredit"]);
		$akun_kredit=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kredit);
		$akun_kredit=str_replace("'", '"',$akun_kredit);
		$akun_saldo=trim(@$_POST["akun_saldo"]);
		$akun_keterangan=trim(@$_POST["akun_keterangan"]);
		$akun_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_keterangan);
		$akun_keterangan=str_replace("'", '"',$akun_keterangan);
		$akun_aktif=trim(@$_POST["akun_aktif"]);
		$akun_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_aktif);
		$akun_aktif=str_replace("'", '"',$akun_aktif);
		$akun_creator=trim(@$_POST["akun_creator"]);
		$akun_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_creator);
		$akun_creator=str_replace("'", '"',$akun_creator);
		$akun_date_create=trim(@$_POST["akun_date_create"]);
		$akun_update=trim(@$_POST["akun_update"]);
		$akun_update=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_update);
		$akun_update=str_replace("'", '"',$akun_update);
		$akun_date_update=trim(@$_POST["akun_date_update"]);
		$akun_revised=trim(@$_POST["akun_revised"]);
		$result = $this->m_akun->akun_update($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised );
		echo $result;
	}
	
	//function for create new record
	function akun_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$akun_kode=trim(@$_POST["akun_kode"]);
		$akun_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kode);
		$akun_kode=str_replace("'", '"',$akun_kode);
		$akun_nama=trim(@$_POST["akun_nama"]);
		$akun_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_nama);
		$akun_nama=str_replace("'", '"',$akun_nama);
		$akun_parent=trim(@$_POST["akun_parent"]);
		$akun_neraca=trim(@$_POST["akun_neraca"]);
		$akun_neraca=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_neraca);
		$akun_neraca=str_replace("'", '"',$akun_neraca);
		$akun_rugilaba=trim(@$_POST["akun_rugilaba"]);
		$akun_rugilaba=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_rugilaba);
		$akun_rugilaba=str_replace("'", '"',$akun_rugilaba);
		$akun_debet=trim(@$_POST["akun_debet"]);
		$akun_debet=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_debet);
		$akun_debet=str_replace("'", '"',$akun_debet);
		$akun_kredit=trim(@$_POST["akun_kredit"]);
		$akun_kredit=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kredit);
		$akun_kredit=str_replace("'", '"',$akun_kredit);
		$akun_saldo=trim(@$_POST["akun_saldo"]);
		$akun_keterangan=trim(@$_POST["akun_keterangan"]);
		$akun_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_keterangan);
		$akun_keterangan=str_replace("'", '"',$akun_keterangan);
		$akun_aktif=trim(@$_POST["akun_aktif"]);
		$akun_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_aktif);
		$akun_aktif=str_replace("'", '"',$akun_aktif);
		$akun_creator=trim(@$_POST["akun_creator"]);
		$akun_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_creator);
		$akun_creator=str_replace("'", '"',$akun_creator);
		$akun_date_create=trim(@$_POST["akun_date_create"]);
		$akun_update=trim(@$_POST["akun_update"]);
		$akun_update=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_update);
		$akun_update=str_replace("'", '"',$akun_update);
		$akun_date_update=trim(@$_POST["akun_date_update"]);
		$akun_revised=trim(@$_POST["akun_revised"]);
		$result=$this->m_akun->akun_create($akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised );
		echo $result;
	}

	//function for delete selected record
	function akun_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_akun->akun_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function akun_search(){
		//POST varibale here
		$akun_id=trim(@$_POST["akun_id"]);
		$akun_kode=trim(@$_POST["akun_kode"]);
		$akun_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kode);
		$akun_kode=str_replace("'", '"',$akun_kode);
		$akun_nama=trim(@$_POST["akun_nama"]);
		$akun_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_nama);
		$akun_nama=str_replace("'", '"',$akun_nama);
		$akun_parent=trim(@$_POST["akun_parent"]);
		$akun_neraca=trim(@$_POST["akun_neraca"]);
		$akun_neraca=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_neraca);
		$akun_neraca=str_replace("'", '"',$akun_neraca);
		$akun_rugilaba=trim(@$_POST["akun_rugilaba"]);
		$akun_rugilaba=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_rugilaba);
		$akun_rugilaba=str_replace("'", '"',$akun_rugilaba);
		$akun_debet=trim(@$_POST["akun_debet"]);
		$akun_debet=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_debet);
		$akun_debet=str_replace("'", '"',$akun_debet);
		$akun_kredit=trim(@$_POST["akun_kredit"]);
		$akun_kredit=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kredit);
		$akun_kredit=str_replace("'", '"',$akun_kredit);
		$akun_saldo=trim(@$_POST["akun_saldo"]);
		$akun_keterangan=trim(@$_POST["akun_keterangan"]);
		$akun_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_keterangan);
		$akun_keterangan=str_replace("'", '"',$akun_keterangan);
		$akun_aktif=trim(@$_POST["akun_aktif"]);
		$akun_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_aktif);
		$akun_aktif=str_replace("'", '"',$akun_aktif);
		$akun_creator=trim(@$_POST["akun_creator"]);
		$akun_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_creator);
		$akun_creator=str_replace("'", '"',$akun_creator);
		$akun_date_create=trim(@$_POST["akun_date_create"]);
		$akun_update=trim(@$_POST["akun_update"]);
		$akun_update=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_update);
		$akun_update=str_replace("'", '"',$akun_update);
		$akun_date_update=trim(@$_POST["akun_date_update"]);
		$akun_revised=trim(@$_POST["akun_revised"]);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_akun->akun_search($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$start,$end);
		echo $result;
	}


	function akun_print(){
  		//POST varibale here
		$akun_id=trim(@$_POST["akun_id"]);
		$akun_kode=trim(@$_POST["akun_kode"]);
		$akun_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kode);
		$akun_kode=str_replace("'", '"',$akun_kode);
		$akun_nama=trim(@$_POST["akun_nama"]);
		$akun_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_nama);
		$akun_nama=str_replace("'", '"',$akun_nama);
		$akun_parent=trim(@$_POST["akun_parent"]);
		$akun_neraca=trim(@$_POST["akun_neraca"]);
		$akun_neraca=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_neraca);
		$akun_neraca=str_replace("'", '"',$akun_neraca);
		$akun_rugilaba=trim(@$_POST["akun_rugilaba"]);
		$akun_rugilaba=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_rugilaba);
		$akun_rugilaba=str_replace("'", '"',$akun_rugilaba);
		$akun_debet=trim(@$_POST["akun_debet"]);
		$akun_debet=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_debet);
		$akun_debet=str_replace("'", '"',$akun_debet);
		$akun_kredit=trim(@$_POST["akun_kredit"]);
		$akun_kredit=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kredit);
		$akun_kredit=str_replace("'", '"',$akun_kredit);
		$akun_saldo=trim(@$_POST["akun_saldo"]);
		$akun_keterangan=trim(@$_POST["akun_keterangan"]);
		$akun_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_keterangan);
		$akun_keterangan=str_replace("'", '"',$akun_keterangan);
		$akun_aktif=trim(@$_POST["akun_aktif"]);
		$akun_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_aktif);
		$akun_aktif=str_replace("'", '"',$akun_aktif);
		$akun_creator=trim(@$_POST["akun_creator"]);
		$akun_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_creator);
		$akun_creator=str_replace("'", '"',$akun_creator);
		$akun_date_create=trim(@$_POST["akun_date_create"]);
		$akun_update=trim(@$_POST["akun_update"]);
		$akun_update=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_update);
		$akun_update=str_replace("'", '"',$akun_update);
		$akun_date_update=trim(@$_POST["akun_date_update"]);
		$akun_revised=trim(@$_POST["akun_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_akun->akun_print($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=15;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("akunlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Akun Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Akun List'><caption>AKUN</caption><thead><tr><th scope='col'>Akun Id</th><th scope='col'>Akun Kode</th><th scope='col'>Akun Nama</th><th scope='col'>Akun Parent</th><th scope='col'>Akun Neraca</th><th scope='col'>Akun Rugilaba</th><th scope='col'>Akun Debet</th><th scope='col'>Akun Kredit</th><th scope='col'>Akun Saldo</th><th scope='col'>Akun Keterangan</th><th scope='col'>Akun Aktif</th><th scope='col'>Akun Creator</th><th scope='col'>Akun Date Create</th><th scope='col'>Akun Update</th><th scope='col'>Akun Date Update</th><th scope='col'>Akun Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Akun</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['akun_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['akun_kode']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_parent']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_neraca']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_rugilaba']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_debet']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_kredit']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_saldo']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_keterangan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_aktif']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_creator']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_date_create']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_date_update']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['akun_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function akun_export_excel(){
		//POST varibale here
		$akun_id=trim(@$_POST["akun_id"]);
		$akun_kode=trim(@$_POST["akun_kode"]);
		$akun_kode=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kode);
		$akun_kode=str_replace("'", '"',$akun_kode);
		$akun_nama=trim(@$_POST["akun_nama"]);
		$akun_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_nama);
		$akun_nama=str_replace("'", '"',$akun_nama);
		$akun_parent=trim(@$_POST["akun_parent"]);
		$akun_neraca=trim(@$_POST["akun_neraca"]);
		$akun_neraca=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_neraca);
		$akun_neraca=str_replace("'", '"',$akun_neraca);
		$akun_rugilaba=trim(@$_POST["akun_rugilaba"]);
		$akun_rugilaba=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_rugilaba);
		$akun_rugilaba=str_replace("'", '"',$akun_rugilaba);
		$akun_debet=trim(@$_POST["akun_debet"]);
		$akun_debet=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_debet);
		$akun_debet=str_replace("'", '"',$akun_debet);
		$akun_kredit=trim(@$_POST["akun_kredit"]);
		$akun_kredit=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_kredit);
		$akun_kredit=str_replace("'", '"',$akun_kredit);
		$akun_saldo=trim(@$_POST["akun_saldo"]);
		$akun_keterangan=trim(@$_POST["akun_keterangan"]);
		$akun_keterangan=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_keterangan);
		$akun_keterangan=str_replace("'", '"',$akun_keterangan);
		$akun_aktif=trim(@$_POST["akun_aktif"]);
		$akun_aktif=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_aktif);
		$akun_aktif=str_replace("'", '"',$akun_aktif);
		$akun_creator=trim(@$_POST["akun_creator"]);
		$akun_creator=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_creator);
		$akun_creator=str_replace("'", '"',$akun_creator);
		$akun_date_create=trim(@$_POST["akun_date_create"]);
		$akun_update=trim(@$_POST["akun_update"]);
		$akun_update=str_replace("/(<\/?)(p)([^>]*>)", "",$akun_update);
		$akun_update=str_replace("'", '"',$akun_update);
		$akun_date_update=trim(@$_POST["akun_date_update"]);
		$akun_revised=trim(@$_POST["akun_revised"]);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_akun->akun_export_excel($akun_id ,$akun_kode ,$akun_nama ,$akun_parent ,$akun_neraca ,$akun_rugilaba ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_keterangan ,$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter);
		
		to_excel($query,"akun"); 
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