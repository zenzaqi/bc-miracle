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
class C_report_voucher extends Controller {

	//constructor
	function C_report_voucher(){
		parent::Controller();
		$this->load->model('m_report_voucher', '', TRUE);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_report_voucher');
	}
	
	function get_promo_list(){
		$result=$this->m_report_voucher->get_promo_list();
		echo $result;
	}
	
	function printreport_voucher(){
  		$voucher_nama=trim(@$_POST["voucher_nama"]);
		$voucher_jenis=trim(@$_POST["voucher_jenis"]);
		$voucher_promo=trim(@$_POST["voucher_promo"]);
		$voucher_tglstart=trim(@$_POST["voucher_tglstart"]);
		$voucher_tglend=trim(@$_POST["voucher_tglend"]);
		
		
		$result = $this->m_report_voucher->printreport_voucher($voucher_nama,$voucher_jenis,$voucher_promo,$voucher_tglstart,$voucher_tglend);
		$nbrows=$result->num_rows();
		$totcolumn=8;
   		/* We now have our array, let's build our HTML file */
		$file = fopen("report_voucherlist.html",'w');
		fwrite($file, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Printing Voucher</title><link rel='stylesheet' type='text/css' href='assets/modules/main/css/printstyle.css'/></head>");
		fwrite($file, "<body><table summary='tbl_voucher List'><caption>Report Voucher List</caption><thead><tr><th scope='col'>Id</th><th scope='col'>voucher_nama</th><th scope='col'>voucher_jenis</th><th scope='col'>voucher_point</th><th scope='col'>voucher_jumlah</th><th scope='col'>voucher_kadaluarsa</th><th scope='col'>voucher_cashback</th><th scope='col'>voucher_mincash</th><th scope='col'>voucher_diskon</th><th scope='col'>voucher_promo</th><th scope='col'>voucher_allproduk</th><th scope='col'>voucher_allrawat</th></tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='$totcolumn'>");
		fwrite($file, $nbrows);
		fwrite($file, " => Penjualan Produk</td></tr></tfoot><tbody>");
		$i=0;
		if($nbrows>0){
			foreach($result->result_array() as $data){
				fwrite($file,'<tr');
				if($i%1==0){
					fwrite($file," class='odd'");
				}
			
				fwrite($file, "><th scope='row' id='r97'>");
				fwrite($file, $data['voucher_id']);
				fwrite($file,"</th><td>");
				fwrite($file, $data['voucher_nama']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_jenis']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_point']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_jumlah']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_kadaluarsa']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_cashback']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_mincash']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_diskon']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['promo_acara']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_allproduk']);
				fwrite($file,"</td><td>");
				fwrite($file, $data['voucher_allrawat']);
				fwrite($file, "</td></tr>");
			}
		}
		fwrite($file, "</tbody></table></body></html>");	
		fclose($file);
		echo '1';        // we are done. 

	}
}
?>