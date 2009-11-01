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
class C_report_tukar_point extends Controller {

	//constructor
	function C_report_tukar_point(){
		parent::Controller();
		$this->load->model('m_report_tukar_point', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_tukar_point');
	}
	
	function get_customer_list(){
		$result=$this->m_public_function->get_customer_list();
		echo $result;
	}
	
	function printreport_tukar_point(){
  		$tukar_point_cust=trim(@$_POST["tukar_point_cust"]);
		$tukar_point_tglstart=trim(@$_POST["tukar_point_tglstart"]);
		$tukar_point_tglend=trim(@$_POST["tukar_point_tglend"]);
		
		
		$result = $this->m_report_tukar_point->printreport_tukar_point($tukar_point_cust,$tukar_point_tglstart,$tukar_point_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_tukar_pointlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Point Reward</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_tukar_point List'><caption>Report Point Reward List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>epoint_cust</th><th scope='col'>epoint_jumlah</th><th scope='col'>epoint_voucher</th><th scope='col'>epoint_tanggal</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Point Reward</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['epoint_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['cust_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['epoint_jumlah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['epoint_voucher']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['epoint_tanggal']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>