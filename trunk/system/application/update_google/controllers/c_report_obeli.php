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
class C_report_obeli extends Controller {

	//constructor
	function C_report_obeli(){
		parent::Controller();
		$this->load->model('m_report_obeli', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_obeli');
	}
	
	function get_supplier_list(){
		$result=$this->m_public_function->get_supplier_list(0,10);
		echo $result;
	}
	
	function printreport_obeli(){
  		$order_supplier=trim(@$_POST["order_supplier"]);
		$order_carabayar=trim(@$_POST["order_carabayar"]);
		$order_tglstart=trim(@$_POST["order_tglstart"]);
		$order_tglend=trim(@$_POST["order_tglend"]);
		
		
		$result = $this->m_report_obeli->printreport_obeli($order_supplier,$order_carabayar,$order_tglstart ,$order_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_obelilist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Order Pemebelian</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_obeli List'><caption>Report Order Pembelian List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>order_no</th><th scope='col'>order_supplier</th><th scope='col'>order_tanggal</th><th scope='col'>order_carabayar</th><th scope='col'>order_diskon</th><th scope='col'>order_biaya</th><th scope='col'>order_bayar</th><th scope='col'>order_keterangan</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Order Pembelian</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['order_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['order_no']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['supplier_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_tanggal']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_carabayar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_biaya']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_bayar']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['order_keterangan']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>