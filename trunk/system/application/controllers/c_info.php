<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: info Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_info.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of info
class C_info extends Controller {

	//constructor
	function C_info(){
		parent::Controller();
		$this->load->model('m_info', '', TRUE);
		$this->load->plugin('to_excel');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_info');
	}
	
	function get_auto_cabang(){
		$cabang_id = (integer) (isset($_POST['cabang_id']) ? $_POST['cabang_id'] : $_GET['cabang_id']);
		$result=$this->m_info->get_auto_cabang($cabang_id);
		echo $result;
	}
	
	function get_detail_info(){
		$result=$this->m_info->get_detail_info();
		echo $result;
	}
	function get_cabang_list(){
		//ID dokter pada tabel departemen adalah 8
		//$query = isset($_POST['query']) ? $_POST['query'] : "";
		//$tgl_app = isset($_POST['tgl_app']) ? $_POST['tgl_app'] : "";
		$result=$this->m_public_function->get_cabang_list();
		echo $result;
	}
	
	//event handler action
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->info_list();
				break;
			case "UPDATE":
				$this->info_update();
				break;
			case "CREATE":
				$this->info_create();
				break;
			case "DELETE":
				$this->info_delete();
				break;
			case "SEARCH":
				$this->info_search();
				break;
			case "PRINT":
				$this->info_print();
				break;
			case "EXCEL":
				$this->info_export_excel();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	//function fot list record
	function info_list(){
		
		$query = isset($_POST['query']) ? $_POST['query'] : "";
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);

		$result=$this->m_info->info_list($query,$start,$end);
		echo $result;
	}

	//function for update record
	function info_update(){
		//POST variable here
		$info_id=trim(@$_POST["info_id"]);
		$info_nama=trim(@$_POST["info_nama"]);
		$info_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nama);
		$info_nama=str_replace("'", '"',$info_nama);
		$info_alamat=trim(@$_POST["info_alamat"]);
		$info_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$info_alamat);
		$info_alamat=str_replace("'", '"',$info_alamat);
		$info_notelp=trim(@$_POST["info_notelp"]);
		$info_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$info_notelp);
		$info_notelp=str_replace("'", '"',$info_notelp);
		$info_nofax=trim(@$_POST["info_nofax"]);
		$info_nofax=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nofax);
		$info_nofax=str_replace("'", '"',$info_nofax);
		$info_email=trim(@$_POST["info_email"]);
		$info_email=str_replace("/(<\/?)(p)([^>]*>)", "",$info_email);
		$info_email=str_replace("'", '"',$info_email);
		$info_website=trim(@$_POST["info_website"]);
		$info_website=str_replace("/(<\/?)(p)([^>]*>)", "",$info_website);
		$info_website=str_replace("'", '"',$info_website);
		$info_slogan=trim(@$_POST["info_slogan"]);
		$info_slogan=str_replace("/(<\/?)(p)([^>]*>)", "",$info_slogan);
		$info_slogan=str_replace("'", '"',$info_slogan);
		$info_cabang=trim(@$_POST["info_cabang"]);
		$result = $this->m_info->info_update($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan, $info_cabang);
		echo $result;
	}
	
	//function for create new record
	function info_create(){
		//POST varible here
		//auto increment, don't accept anything from form values
		$info_nama=trim(@$_POST["info_nama"]);
		$info_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nama);
		$info_nama=str_replace("'", '"',$info_nama);
		$info_alamat=trim(@$_POST["info_alamat"]);
		$info_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$info_alamat);
		$info_alamat=str_replace("'", '"',$info_alamat);
		$info_notelp=trim(@$_POST["info_notelp"]);
		$info_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$info_notelp);
		$info_notelp=str_replace("'", '"',$info_notelp);
		$info_nofax=trim(@$_POST["info_nofax"]);
		$info_nofax=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nofax);
		$info_nofax=str_replace("'", '"',$info_nofax);
		$info_email=trim(@$_POST["info_email"]);
		$info_email=str_replace("/(<\/?)(p)([^>]*>)", "",$info_email);
		$info_email=str_replace("'", '"',$info_email);
		$info_website=trim(@$_POST["info_website"]);
		$info_website=str_replace("/(<\/?)(p)([^>]*>)", "",$info_website);
		$info_website=str_replace("'", '"',$info_website);
		$info_slogan=trim(@$_POST["info_slogan"]);
		$info_slogan=str_replace("/(<\/?)(p)([^>]*>)", "",$info_slogan);
		$info_slogan=str_replace("'", '"',$info_slogan);
		$info_logo=trim(@$_POST["info_logo"]);
		$info_logo=str_replace("/(<\/?)(p)([^>]*>)", "",$info_logo);
		$info_logo=str_replace("'", '"',$info_logo);
		$info_icon=trim(@$_POST["info_icon"]);
		$info_icon=str_replace("/(<\/?)(p)([^>]*>)", "",$info_icon);
		$info_icon=str_replace("'", '"',$info_icon);
		$info_background=trim(@$_POST["info_background"]);
		$info_background=str_replace("/(<\/?)(p)([^>]*>)", "",$info_background);
		$info_background=str_replace("'", '"',$info_background);
		$info_theme=trim(@$_POST["info_theme"]);
		$info_theme=str_replace("/(<\/?)(p)([^>]*>)", "",$info_theme);
		$info_theme=str_replace("'", '"',$info_theme);
		$result=$this->m_info->info_create($info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme );
		echo $result;
	}

	//function for delete selected record
	function info_delete(){
		$ids = $_POST['ids']; // Get our array back and translate it :
		$pkid = json_decode(stripslashes($ids));
		$result=$this->m_info->info_delete($pkid);
		echo $result;
	}

	//function for advanced search
	function info_search(){
		//POST varibale here
		$info_id=trim(@$_POST["info_id"]);
		$info_nama=trim(@$_POST["info_nama"]);
		$info_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nama);
		$info_nama=str_replace("'", '"',$info_nama);
		$info_alamat=trim(@$_POST["info_alamat"]);
		$info_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$info_alamat);
		$info_alamat=str_replace("'", '"',$info_alamat);
		$info_notelp=trim(@$_POST["info_notelp"]);
		$info_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$info_notelp);
		$info_notelp=str_replace("'", '"',$info_notelp);
		$info_nofax=trim(@$_POST["info_nofax"]);
		$info_nofax=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nofax);
		$info_nofax=str_replace("'", '"',$info_nofax);
		$info_email=trim(@$_POST["info_email"]);
		$info_email=str_replace("/(<\/?)(p)([^>]*>)", "",$info_email);
		$info_email=str_replace("'", '"',$info_email);
		$info_website=trim(@$_POST["info_website"]);
		$info_website=str_replace("/(<\/?)(p)([^>]*>)", "",$info_website);
		$info_website=str_replace("'", '"',$info_website);
		$info_slogan=trim(@$_POST["info_slogan"]);
		$info_slogan=str_replace("/(<\/?)(p)([^>]*>)", "",$info_slogan);
		$info_slogan=str_replace("'", '"',$info_slogan);
		$info_logo=trim(@$_POST["info_logo"]);
		$info_logo=str_replace("/(<\/?)(p)([^>]*>)", "",$info_logo);
		$info_logo=str_replace("'", '"',$info_logo);
		$info_icon=trim(@$_POST["info_icon"]);
		$info_icon=str_replace("/(<\/?)(p)([^>]*>)", "",$info_icon);
		$info_icon=str_replace("'", '"',$info_icon);
		$info_background=trim(@$_POST["info_background"]);
		$info_background=str_replace("/(<\/?)(p)([^>]*>)", "",$info_background);
		$info_background=str_replace("'", '"',$info_background);
		$info_theme=trim(@$_POST["info_theme"]);
		$info_theme=str_replace("/(<\/?)(p)([^>]*>)", "",$info_theme);
		$info_theme=str_replace("'", '"',$info_theme);
		
		$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
		$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
		$result = $this->m_info->info_search($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ,$start,$end);
		echo $result;
	}


	function info_print(){
  		//POST varibale here
		$info_id=trim(@$_POST["info_id"]);
		$info_nama=trim(@$_POST["info_nama"]);
		$info_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nama);
		$info_nama=str_replace("'", '"',$info_nama);
		$info_alamat=trim(@$_POST["info_alamat"]);
		$info_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$info_alamat);
		$info_alamat=str_replace("'", '"',$info_alamat);
		$info_notelp=trim(@$_POST["info_notelp"]);
		$info_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$info_notelp);
		$info_notelp=str_replace("'", '"',$info_notelp);
		$info_nofax=trim(@$_POST["info_nofax"]);
		$info_nofax=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nofax);
		$info_nofax=str_replace("'", '"',$info_nofax);
		$info_email=trim(@$_POST["info_email"]);
		$info_email=str_replace("/(<\/?)(p)([^>]*>)", "",$info_email);
		$info_email=str_replace("'", '"',$info_email);
		$info_website=trim(@$_POST["info_website"]);
		$info_website=str_replace("/(<\/?)(p)([^>]*>)", "",$info_website);
		$info_website=str_replace("'", '"',$info_website);
		$info_slogan=trim(@$_POST["info_slogan"]);
		$info_slogan=str_replace("/(<\/?)(p)([^>]*>)", "",$info_slogan);
		$info_slogan=str_replace("'", '"',$info_slogan);
		$info_logo=trim(@$_POST["info_logo"]);
		$info_logo=str_replace("/(<\/?)(p)([^>]*>)", "",$info_logo);
		$info_logo=str_replace("'", '"',$info_logo);
		$info_icon=trim(@$_POST["info_icon"]);
		$info_icon=str_replace("/(<\/?)(p)([^>]*>)", "",$info_icon);
		$info_icon=str_replace("'", '"',$info_icon);
		$info_background=trim(@$_POST["info_background"]);
		$info_background=str_replace("/(<\/?)(p)([^>]*>)", "",$info_background);
		$info_background=str_replace("'", '"',$info_background);
		$info_theme=trim(@$_POST["info_theme"]);
		$info_theme=str_replace("/(<\/?)(p)([^>]*>)", "",$info_theme);
		$info_theme=str_replace("'", '"',$info_theme);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$result = $this->m_info->info_print($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ,$option,$filter);
		$nbrows=$result->num_rows();
		$totcolumn=12;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("infolist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing the Info Grid</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='Info List'><caption>INFO</caption><thead><tr><th scope='col'>Info Id</th><th scope='col'>Info Nama</th><th scope='col'>Info Alamat</th><th scope='col'>Info Notelp</th><th scope='col'>Info Nofax</th><th scope='col'>Info Email</th><th scope='col'>Info Website</th><th scope='col'>Info Slogan</th><th scope='col'>Info Logo</th><th scope='col'>Info Icon</th><th scope='col'>Info Background</th><th scope='col'>Info Theme</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " Info</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['info_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['info_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_alamat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_notelp']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_nofax']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_email']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_website']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_slogan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_logo']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_icon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_background']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['info_theme']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        
	}
	/* End Of Function */

	/* Function to Export Excel document */
	function info_export_excel(){
		//POST varibale here
		$info_id=trim(@$_POST["info_id"]);
		$info_nama=trim(@$_POST["info_nama"]);
		$info_nama=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nama);
		$info_nama=str_replace("'", '"',$info_nama);
		$info_alamat=trim(@$_POST["info_alamat"]);
		$info_alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$info_alamat);
		$info_alamat=str_replace("'", '"',$info_alamat);
		$info_notelp=trim(@$_POST["info_notelp"]);
		$info_notelp=str_replace("/(<\/?)(p)([^>]*>)", "",$info_notelp);
		$info_notelp=str_replace("'", '"',$info_notelp);
		$info_nofax=trim(@$_POST["info_nofax"]);
		$info_nofax=str_replace("/(<\/?)(p)([^>]*>)", "",$info_nofax);
		$info_nofax=str_replace("'", '"',$info_nofax);
		$info_email=trim(@$_POST["info_email"]);
		$info_email=str_replace("/(<\/?)(p)([^>]*>)", "",$info_email);
		$info_email=str_replace("'", '"',$info_email);
		$info_website=trim(@$_POST["info_website"]);
		$info_website=str_replace("/(<\/?)(p)([^>]*>)", "",$info_website);
		$info_website=str_replace("'", '"',$info_website);
		$info_slogan=trim(@$_POST["info_slogan"]);
		$info_slogan=str_replace("/(<\/?)(p)([^>]*>)", "",$info_slogan);
		$info_slogan=str_replace("'", '"',$info_slogan);
		$info_logo=trim(@$_POST["info_logo"]);
		$info_logo=str_replace("/(<\/?)(p)([^>]*>)", "",$info_logo);
		$info_logo=str_replace("'", '"',$info_logo);
		$info_icon=trim(@$_POST["info_icon"]);
		$info_icon=str_replace("/(<\/?)(p)([^>]*>)", "",$info_icon);
		$info_icon=str_replace("'", '"',$info_icon);
		$info_background=trim(@$_POST["info_background"]);
		$info_background=str_replace("/(<\/?)(p)([^>]*>)", "",$info_background);
		$info_background=str_replace("'", '"',$info_background);
		$info_theme=trim(@$_POST["info_theme"]);
		$info_theme=str_replace("/(<\/?)(p)([^>]*>)", "",$info_theme);
		$info_theme=str_replace("'", '"',$info_theme);
		$option=$_POST['currentlisting'];
		$filter=$_POST["query"];
		
		$query = $this->m_info->info_export_excel($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ,$option,$filter);
		
		to_excel($query,"info"); 
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