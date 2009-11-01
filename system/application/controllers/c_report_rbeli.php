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
class C_report_rbeli extends Controller {

	//constructor
	function C_report_rbeli(){
		parent::Controller();
		$this->load->model('m_report_rbeli', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_rbeli');
	}
	
	function get_terima_beli_list(){
		$result=$this->m_report_rbeli->get_terima_beli_list();
		echo $result;
	}
	
	function get_supplier_list(){
		$result=$this->m_public_function->get_supplier_list(0,10);
		echo $result;
	}
	
	function printreport_rbeli(){
  		$rbeli_supplier=trim(@$_POST["rbeli_supplier"]);
		$rbeli_terima=trim(@$_POST["rbeli_terima"]);
		$rbeli_tglstart=trim(@$_POST["rbeli_tglstart"]);
		$rbeli_tglend=trim(@$_POST["rbeli_tglend"]);
		
		
		$result = $this->m_report_rbeli->printreport_rbeli($rbeli_supplier,$rbeli_terima,$rbeli_tglstart,$rbeli_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_rbelilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Retur Pemebelian</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_rbeli List'><caption>Report Retur Pembelian List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>rbeli_terima</th><th scope='col'>rbeli_supplier</th><th scope='col'>rbeli_tanggal</th><th scope='col'>rbeli_keterangan</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Retur Pembelian</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['rbeli_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['terima_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['supplier_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rbeli_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['rbeli_keterangan']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>