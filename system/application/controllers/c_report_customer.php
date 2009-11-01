<?php
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tbl_agenda Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_tbl_agenda.php
 	+ Author  		: 
 	+ Created on 01/May/2009 06:35:27
	
*/

//class of tbl_agenda
class C_report_customer extends Controller {

	//constructor
	function C_report_customer(){
		parent::Controller();
		$this->load->model('m_report_customer', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_customer');
	}
	
	function get_profesi_list(){
		$result=$this->m_report_customer->get_profesi_list();
		echo $result;
	}
	
	function get_hobi_list(){
		$result=$this->m_report_customer->get_hobi_list();
		echo $result;
	}
	
	function get_cabang_list(){
		$result=$this->m_public_function->get_cabang_list();
		echo $result;
	}
	
	function printreport_customer(){
		$cust_nama=trim(@$_POST["cust_nama"]);
		$cust_kelamin=trim(@$_POST["cust_kelamin"]);
		$cust_agama=trim(@$_POST["cust_agama"]);
		$cust_statusnikah=trim(@$_POST["cust_statusnikah"]);
		$cust_hobi=trim(@$_POST["cust_hobi"]);
		$cust_kota=trim(@$_POST["cust_kota"]);
		$cust_propinsi=trim(@$_POST["cust_propinsi"]);
		$cust_pendidikan=trim(@$_POST["cust_pendidikan"]);
		$cust_profesi=trim(@$_POST["cust_profesi"]);
		$cust_cabang=trim(@$_POST["cust_cabang"]);
		$cust_terdaftarstart=trim(@$_POST["cust_terdaftarstart"]);
		$cust_terdaftarend=trim(@$_POST["cust_terdaftarend"]);
		
		$result = $this->m_report_customer->printreport_customer($cust_nama, $cust_kelamin, $cust_agama, $cust_statusnikah, $cust_hobi, $cust_kota, $cust_propinsi, $cust_pendidikan, $cust_profesi, $cust_cabang, $cust_terdaftarstart, $cust_terdaftarend);
		$nbrows=$result->num_rows();
		$totcolumn=20;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_customerlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Customer</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_customer List'><caption>Report Customer List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>cust_no</th><th scope='col'>cust_nama</th><th scope='col'>cust_kelamin</th><th scope='col'>cust_alamat</th><th scope='col'>cust_alamat2</th><th scope='col'>cust_kota</th><th scope='col'>cust_kodepos</th><th scope='col'>cust_propinsi</th><th scope='col'>cust_negara</th><th scope='col'>cust_telprumah</th><th scope='col'>cust_telprumah2</th><th scope='col'>cust_telpkantor</th><th scope='col'>cust_hp</th><th scope='col'>cust_hp2</th><th scope='col'>cust_hp3</th><th scope='col'>cust_email</th><th scope='col'>cust_agama</th><th scope='col'>cust_pendidikan</th><th scope='col'>cust_profesi</th><th scope='col'>cust_tgllahir</th><th scope='col'>cust_hobi</th><th scope='col'>cust_referensi</th><th scope='col'>cust_terdaftar</th><th scope='col'>cust_statusnikah</th><th scope='col'>cust_jmlanak</th><th scope='col'>cust_unit</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Customer</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['cust_id']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_kelamin']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_alamat']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_alamat2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_kota']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_kodepos']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_propinsi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_negara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_telprumah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_telprumah2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_telpkantor']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hp']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hp2']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hp3']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_email']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_agama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_pendidikan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_profesi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_tgllahir']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_hobi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_referensi']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_terdaftar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_statusnikah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_jmlanak']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cabang_nama']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>