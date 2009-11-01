<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: anamnesa Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_anamnesa.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:37:33
	
*/

//class of anamnesa
class C_anamnesa extends Controller {

	//constructor
	function C_anamnesa(){
		parent::Controller();
		$this->load->model('m_anamnesa', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_anamnesa');
	}
	
	//for detail action
	//list detail handler action
	function  detail_anamnesa_problem_list(){
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_anamnesa->detail_anamnesa_problem_list($master_id,$query,$start,$end);
		echo $result;
	}
	//end of handler
	
	//purge all detail
	function detail_anamnesa_problem_purge(){
		$master_id = (integer) (isset($_POST['master_id']) ? $_POST['master_id'] : $_GET['master_id']);
		$result=$this->m_anamnesa->detail_anamnesa_problem_purge($master_id);
	}
	//eof
	
	//get master id, note: not done yet
	function get_master_id(){
		$result=$this->m_anamnesa->get_master_id();
		echo $result;
	}
	//
	
	//add detail
	function detail_anamnesa_problem_insert(){
	//POST variable here
		$panam_id=trim(@$_POST["panam_id"]);
		$panam_master=trim(@$_POST["panam_master"]);
		$panam_problem=trim(@$_POST["panam_problem"]);
		$panam_problem=str_replace("/(<\/?)(p)([^>]*>)", "",$panam_problem);
		$panam_problem=str_replace("\\", "",$panam_problem);
		$panam_problem=str_replace("'", '"',$panam_problem);
		$panam_lamaproblem=trim(@$_POST["panam_lamaproblem"]);
		$panam_lamaproblem=str_replace("/(<\/?)(p)([^>]*>)", "",$panam_lamaproblem);
		$panam_lamaproblem=str_replace("\\", "",$panam_lamaproblem);
		$panam_lamaproblem=str_replace("'", '"',$panam_lamaproblem);
		$panam_aksiproblem=trim(@$_POST["panam_aksiproblem"]);
		$panam_aksiproblem=str_replace("/(<\/?)(p)([^>]*>)", "",$panam_aksiproblem);
		$panam_aksiproblem=str_replace("\\", "",$panam_aksiproblem);
		$panam_aksiproblem=str_replace("'", '"',$panam_aksiproblem);
		$panam_aksiket=trim(@$_POST["panam_aksiket"]);
		$panam_aksiket=str_replace("/(<\/?)(p)([^>]*>)", "",$panam_aksiket);
		$panam_aksiket=str_replace("\\", "",$panam_aksiket);
		$panam_aksiket=str_replace("'", '"',$panam_aksiket);
		$result=$this->m_anamnesa->detail_anamnesa_problem_insert($panam_id ,$panam_master ,$panam_problem ,$panam_lamaproblem ,$panam_aksiproblem ,$panam_aksiket );
	}
	
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->anamnesa_list();
				break;
			case "UPDATE":
				$this->anamnesa_update();
				break;
			case "CREATE":
				$this->anamnesa_create();
				break;
			case "DELETE":
				$this->anamnesa_delete();
				break;
			case "SEARCH":
				$this->anamnesa_search();
				break;
			case "PRINT":
				$this->anamnesa_print();
				break;
			case "EXCEL":
				$this->anamnesa_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function anamnesa_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result=$this->m_anamnesa->anamnesa_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function anamnesa_update(){
		//POST variable here
		$anam_id=trim(@$_POST["anam_id"]);
		$anam_cust=trim(@$_POST["anam_cust"]);
		$anam_tanggal=trim(@$_POST["anam_tanggal"]);
		$anam_petugas=trim(@$_POST["anam_petugas"]);
		$anam_pengobatan=trim(@$_POST["anam_pengobatan"]);
		$anam_pengobatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_pengobatan);
		$anam_pengobatan=str_replace(",", ",",$anam_pengobatan);
		$anam_pengobatan=str_replace("'", '"',$anam_pengobatan);
		$anam_perawatan=trim(@$_POST["anam_perawatan"]);
		$anam_perawatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_perawatan);
		$anam_perawatan=str_replace(",", ",",$anam_perawatan);
		$anam_perawatan=str_replace("'", '"',$anam_perawatan);
		$anam_terapi=trim(@$_POST["anam_terapi"]);
		$anam_terapi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_terapi);
		$anam_terapi=str_replace(",", ",",$anam_terapi);
		$anam_terapi=str_replace("'", '"',$anam_terapi);
		$anam_alergi=trim(@$_POST["anam_alergi"]);
		$anam_alergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_alergi);
		$anam_alergi=str_replace(",", ",",$anam_alergi);
		$anam_alergi=str_replace("'", '"',$anam_alergi);
		$anam_obatalergi=trim(@$_POST["anam_obatalergi"]);
		$anam_obatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_obatalergi);
		$anam_obatalergi=str_replace(",", ",",$anam_obatalergi);
		$anam_obatalergi=str_replace("'", '"',$anam_obatalergi);
		$anam_efekobatalergi=trim(@$_POST["anam_efekobatalergi"]);
		$anam_efekobatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_efekobatalergi);
		$anam_efekobatalergi=str_replace(",", ",",$anam_efekobatalergi);
		$anam_efekobatalergi=str_replace("'", '"',$anam_efekobatalergi);
		$anam_hamil=trim(@$_POST["anam_hamil"]);
		$anam_hamil=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_hamil);
		$anam_hamil=str_replace(",", ",",$anam_hamil);
		$anam_hamil=str_replace("'", '"',$anam_hamil);
		$anam_kb=trim(@$_POST["anam_kb"]);
		$anam_kb=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_kb);
		$anam_kb=str_replace(",", ",",$anam_kb);
		$anam_kb=str_replace("'", '"',$anam_kb);
		$anam_harapan=trim(@$_POST["anam_harapan"]);
		$anam_harapan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_harapan);
		$anam_harapan=str_replace(",", ",",$anam_harapan);
		$anam_harapan=str_replace("'", '"',$anam_harapan);
		$result = $this->m_anamnesa->anamnesa_update($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan      );
		echo $result;
	}
	
	//function for create new record
	function anamnesa_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$anam_cust=trim(@$_POST["anam_cust"]);
		$anam_tanggal=trim(@$_POST["anam_tanggal"]);
		$anam_petugas=trim(@$_POST["anam_petugas"]);
		$anam_pengobatan=trim(@$_POST["anam_pengobatan"]);
		$anam_pengobatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_pengobatan);
		$anam_pengobatan=str_replace("'", '"',$anam_pengobatan);
		$anam_perawatan=trim(@$_POST["anam_perawatan"]);
		$anam_perawatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_perawatan);
		$anam_perawatan=str_replace("'", '"',$anam_perawatan);
		$anam_terapi=trim(@$_POST["anam_terapi"]);
		$anam_terapi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_terapi);
		$anam_terapi=str_replace("'", '"',$anam_terapi);
		$anam_alergi=trim(@$_POST["anam_alergi"]);
		$anam_alergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_alergi);
		$anam_alergi=str_replace("'", '"',$anam_alergi);
		$anam_obatalergi=trim(@$_POST["anam_obatalergi"]);
		$anam_obatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_obatalergi);
		$anam_obatalergi=str_replace("'", '"',$anam_obatalergi);
		$anam_efekobatalergi=trim(@$_POST["anam_efekobatalergi"]);
		$anam_efekobatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_efekobatalergi);
		$anam_efekobatalergi=str_replace("'", '"',$anam_efekobatalergi);
		$anam_hamil=trim(@$_POST["anam_hamil"]);
		$anam_hamil=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_hamil);
		$anam_hamil=str_replace("'", '"',$anam_hamil);
		$anam_kb=trim(@$_POST["anam_kb"]);
		$anam_kb=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_kb);
		$anam_kb=str_replace("'", '"',$anam_kb);
		$anam_harapan=trim(@$_POST["anam_harapan"]);
		$anam_harapan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_harapan);
		$anam_harapan=str_replace("'", '"',$anam_harapan);
		$result=$this->m_anamnesa->anamnesa_create($anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan );
		echo $result;
	}

	//function for delete selected record
	function anamnesa_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_anamnesa->anamnesa_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function anamnesa_search(){
		//POST varibale here
		$anam_id=trim(@$_POST["anam_id"]);
		$anam_cust=trim(@$_POST["anam_cust"]);
		$anam_tanggal=trim(@$_POST["anam_tanggal"]);
		$anam_petugas=trim(@$_POST["anam_petugas"]);
		$anam_pengobatan=trim(@$_POST["anam_pengobatan"]);
		$anam_pengobatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_pengobatan);
		$anam_pengobatan=str_replace("'", '"',$anam_pengobatan);
		$anam_perawatan=trim(@$_POST["anam_perawatan"]);
		$anam_perawatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_perawatan);
		$anam_perawatan=str_replace("'", '"',$anam_perawatan);
		$anam_terapi=trim(@$_POST["anam_terapi"]);
		$anam_terapi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_terapi);
		$anam_terapi=str_replace("'", '"',$anam_terapi);
		$anam_alergi=trim(@$_POST["anam_alergi"]);
		$anam_alergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_alergi);
		$anam_alergi=str_replace("'", '"',$anam_alergi);
		$anam_obatalergi=trim(@$_POST["anam_obatalergi"]);
		$anam_obatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_obatalergi);
		$anam_obatalergi=str_replace("'", '"',$anam_obatalergi);
		$anam_efekobatalergi=trim(@$_POST["anam_efekobatalergi"]);
		$anam_efekobatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_efekobatalergi);
		$anam_efekobatalergi=str_replace("'", '"',$anam_efekobatalergi);
		$anam_hamil=trim(@$_POST["anam_hamil"]);
		$anam_hamil=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_hamil);
		$anam_hamil=str_replace("'", '"',$anam_hamil);
		$anam_kb=trim(@$_POST["anam_kb"]);
		$anam_kb=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_kb);
		$anam_kb=str_replace("'", '"',$anam_kb);
		$anam_harapan=trim(@$_POST["anam_harapan"]);
		$anam_harapan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_harapan);
		$anam_harapan=str_replace("'", '"',$anam_harapan);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_anamnesa->anamnesa_search($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ,$start,$end);
		echo $result;
	}


	function anamnesa_print(){
  		//POST varibale here
		$anam_id=trim(@$_POST["anam_id"]);
		$anam_cust=trim(@$_POST["anam_cust"]);
		$anam_tanggal=trim(@$_POST["anam_tanggal"]);
		$anam_petugas=trim(@$_POST["anam_petugas"]);
		$anam_pengobatan=trim(@$_POST["anam_pengobatan"]);
		$anam_pengobatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_pengobatan);
		$anam_pengobatan=str_replace("'", '"',$anam_pengobatan);
		$anam_perawatan=trim(@$_POST["anam_perawatan"]);
		$anam_perawatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_perawatan);
		$anam_perawatan=str_replace("'", '"',$anam_perawatan);
		$anam_terapi=trim(@$_POST["anam_terapi"]);
		$anam_terapi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_terapi);
		$anam_terapi=str_replace("'", '"',$anam_terapi);
		$anam_alergi=trim(@$_POST["anam_alergi"]);
		$anam_alergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_alergi);
		$anam_alergi=str_replace("'", '"',$anam_alergi);
		$anam_obatalergi=trim(@$_POST["anam_obatalergi"]);
		$anam_obatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_obatalergi);
		$anam_obatalergi=str_replace("'", '"',$anam_obatalergi);
		$anam_efekobatalergi=trim(@$_POST["anam_efekobatalergi"]);
		$anam_efekobatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_efekobatalergi);
		$anam_efekobatalergi=str_replace("'", '"',$anam_efekobatalergi);
		$anam_hamil=trim(@$_POST["anam_hamil"]);
		$anam_hamil=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_hamil);
		$anam_hamil=str_replace("'", '"',$anam_hamil);
		$anam_kb=trim(@$_POST["anam_kb"]);
		$anam_kb=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_kb);
		$anam_kb=str_replace("'", '"',$anam_kb);
		$anam_harapan=trim(@$_POST["anam_harapan"]);
		$anam_harapan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_harapan);
		$anam_harapan=str_replace("'", '"',$anam_harapan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_anamnesa->anamnesa_print($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=18;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("anamnesalist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Anamnesa Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Anamnesa List'><caption>ANAMNESA</caption><thead><tr><th scope='col'>Anam Id</th><th scope='col'>Anam Cust</th><th scope='col'>Anam Tanggal</th><th scope='col'>Anam Petugas</th><th scope='col'>Anam Pengobatan</th><th scope='col'>Anam Perawatan</th><th scope='col'>Anam Terapi</th><th scope='col'>Anam Alergi</th><th scope='col'>Anam Obatalergi</th><th scope='col'>Anam Efekobatalergi</th><th scope='col'>Anam Hamil</th><th scope='col'>Anam Kb</th><th scope='col'>Anam Harapan</th><th scope='col'>Anam Creator</th><th scope='col'>Anam Date Create</th><th scope='col'>Anam Update</th><th scope='col'>Anam Date Update</th><th scope='col'>Anam Revised</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Anamnesa</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['anam_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['anam_cust']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_petugas']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_pengobatan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_perawatan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_terapi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_alergi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_obatalergi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_efekobatalergi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_hamil']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_kb']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['anam_harapan']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['anam_creator']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['anam_date_create']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['anam_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['anam_date_update']);
				fwrite($file, "</td></tr>");
				fwrite($file, $data['anam_revised']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function anamnesa_export_excel(){
		//POST varibale here
		$anam_id=trim(@$_POST["anam_id"]);
		$anam_cust=trim(@$_POST["anam_cust"]);
		$anam_tanggal=trim(@$_POST["anam_tanggal"]);
		$anam_petugas=trim(@$_POST["anam_petugas"]);
		$anam_pengobatan=trim(@$_POST["anam_pengobatan"]);
		$anam_pengobatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_pengobatan);
		$anam_pengobatan=str_replace("'", '"',$anam_pengobatan);
		$anam_perawatan=trim(@$_POST["anam_perawatan"]);
		$anam_perawatan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_perawatan);
		$anam_perawatan=str_replace("'", '"',$anam_perawatan);
		$anam_terapi=trim(@$_POST["anam_terapi"]);
		$anam_terapi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_terapi);
		$anam_terapi=str_replace("'", '"',$anam_terapi);
		$anam_alergi=trim(@$_POST["anam_alergi"]);
		$anam_alergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_alergi);
		$anam_alergi=str_replace("'", '"',$anam_alergi);
		$anam_obatalergi=trim(@$_POST["anam_obatalergi"]);
		$anam_obatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_obatalergi);
		$anam_obatalergi=str_replace("'", '"',$anam_obatalergi);
		$anam_efekobatalergi=trim(@$_POST["anam_efekobatalergi"]);
		$anam_efekobatalergi=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_efekobatalergi);
		$anam_efekobatalergi=str_replace("'", '"',$anam_efekobatalergi);
		$anam_hamil=trim(@$_POST["anam_hamil"]);
		$anam_hamil=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_hamil);
		$anam_hamil=str_replace("'", '"',$anam_hamil);
		$anam_kb=trim(@$_POST["anam_kb"]);
		$anam_kb=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_kb);
		$anam_kb=str_replace("'", '"',$anam_kb);
		$anam_harapan=trim(@$_POST["anam_harapan"]);
		$anam_harapan=str_replace("/(<\/?)(p)([^>]*>)", "",$anam_harapan);
		$anam_harapan=str_replace("'", '"',$anam_harapan);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_anamnesa->anamnesa_export_excel($anam_id ,$anam_cust ,$anam_tanggal ,$anam_petugas ,$anam_pengobatan ,$anam_perawatan ,$anam_terapi ,$anam_alergi ,$anam_obatalergi ,$anam_efekobatalergi ,$anam_hamil ,$anam_kb ,$anam_harapan ,$option,$filter);
		
		to_excel($query,"anamnesa"); 
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