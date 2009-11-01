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
class C_report_mutasi extends Controller {

	//constructor
	function C_report_mutasi(){
		parent::Controller();
		$this->load->model('m_report_mutasi', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_mutasi');
	}
	
	function get_gudang_list(){
		$result=$this->m_public_function->get_gudang_list();
		echo $result;
	}
	
	function printreport_mutasi(){
  		$mutasi_asal=trim(@$_POST["mutasi_asal"]);
		$mutasi_tujuan=trim(@$_POST["mutasi_tujuan"]);
		$mutasi_tglstart=trim(@$_POST["mutasi_tglstart"]);
		$mutasi_tglend=trim(@$_POST["mutasi_tglend"]);
		
		
		$result = $this->m_report_mutasi->printreport_mutasi($mutasi_asal,$mutasi_tujuan,$mutasi_tglstart,$mutasi_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_mutasilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Mutasi Barang</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_mutasi List'><caption>Report Mutasi Barang List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>mutasi_asal</th><th scope='col'>mutasi_tujuan</th><th scope='col'>mutasi_tanggal</th><th scope='col'>mutasi_keterangan</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Mutasi Barang</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['mutasi_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['gudang_nama_asal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['gudang_nama_tujuan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['mutasi_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['mutasi_keterangan']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>