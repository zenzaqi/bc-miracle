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
class C_report_tbeli extends Controller {

	//constructor
	function C_report_tbeli(){
		parent::Controller();
		$this->load->model('m_report_tbeli', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_tbeli');
	}
	
	function get_order_beli_list(){
		$result=$this->m_report_tbeli->get_order_beli_list();
		echo $result;
	}
	
	function get_supplier_list(){
		$result=$this->m_public_function->get_supplier_list(0,10);
		echo $result;
	}
	
	function printreport_tbeli(){
  		$terima_supplier=trim(@$_POST["terima_supplier"]);
		$terima_order=trim(@$_POST["terima_order"]);
		$terima_tglstart=trim(@$_POST["terima_tglstart"]);
		$terima_tglend=trim(@$_POST["terima_tglend"]);
		
		
		$result = $this->m_report_tbeli->printreport_tbeli($terima_supplier,$terima_order,$terima_tglstart,$terima_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_tbelilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Penerimaan Pemebelian</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_tbeli List'><caption>Report Penerimaan Pembelian List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>terima_no</th><th scope='col'>terima_order</th><th scope='col'>terima_supplier</th><th scope='col'>terima_surat_jalan</th><th scope='col'>terima_pengirim</th><th scope='col'>terima_tanggal</th><th scope='col'>terima_keterangan</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Penerimaan Pembelian</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['terima_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['terima_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['supplier_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_surat_jalan']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_pengirim']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['terima_keterangan']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>