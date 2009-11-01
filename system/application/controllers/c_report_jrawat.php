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
class C_report_jrawat extends Controller {

	//constructor
	function C_report_jrawat(){
		parent::Controller();
		$this->load->model('m_report_jrawat', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_jrawat');
	}
	
	function get_customer_list(){
		$result=$this->m_public_function->get_customer_list();
		echo $result;
	}
	
	function get_master_jrawat_list(){
		$result=$this->m_report_jrawat->get_master_jrawat_list();
		echo $result;
	}
	
	function printreport_jrawat(){
  		$jrawat_cust=trim(@$_POST["jrawat_cust"]);
		$jrawat_nobukti=trim(@$_POST["jrawat_nobukti"]);
		$jrawat_tglstart=trim(@$_POST["jrawat_tglstart"]);
		$jrawat_tglend=trim(@$_POST["jrawat_tglend"]);
		
		
		$result = $this->m_report_jrawat->printreport_jrawat($jrawat_cust,$jrawat_nobukti,$jrawat_tglstart,$jrawat_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_jrawatlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Penjualan Perawatan</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_jrawat List'><caption>Report Penjualan Perawatan List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>jrawat_nobukti</th><th scope='col'>jrawat_cust</th><th scope='col'>jrawat_tanggal</th><th scope='col'>jrawat_diskon</th><th scope='col'>jrawat_cashback</th><th scope='col'>jrawat_voucher</th><th scope='col'>jrawat_cara</th><th scope='col'>jrawat_bayar</th><th scope='col'>jrawat_keterangan</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Penjualan Perawatan</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['jrawat_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['jrawat_nobukti']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['cust_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_cashback']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_voucher']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_cara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_bayar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['jrawat_keterangan']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>