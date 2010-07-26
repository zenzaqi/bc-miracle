<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Penjualan Print
	+ Description	: For Print View
	+ Filename 		: p_rekap_jual.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Detail Pengambilan Paket <?php echo $periode; ?></title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body onload="window.print();">
<table width="731" summary='Detail Jual'>
	<caption>
	Laporan Detail Pengambilan Paket<br/><?php echo $periode; ?><br/>Group By Perawatan</caption>
	<thead>
    	<tr>
        	<th width="22" scope='col'>No</th>
            <th width="250" scope='col'>Tanggal</th>
            <th width="80" scope='col'>No Faktur</th>    
            <th width="250" scope='col'>Customer</th>       
            <th width="200" scope='col'>Pemakai</th>
            <th width="250" scope='col'>Nama Paket</th>
            <th width="70" scope='col'>Jumlah</th>
            <th width="80" scope='col'>Referal</th>
        </tr>
    </thead>
	<tbody>
		<?php 	$i=0; 
				$rawat=""; 
				$total_item=0;
				$j=0;
				
		foreach($data_print as $printlist){
		
		if($rawat!==$printlist->rawat_id){
		?>
         <tr>
                <td><b><? $j++; echo $j; ?></b></td>
                <td colspan="8"><b><?php echo $printlist->rawat_nama." (".$printlist->rawat_kode.")";?></b></td>
         </tr>
        <?
				$i=0;
		foreach($data_print as $print) { 
				if($print->rawat_id==$printlist->rawat_id){ $i++;
		?>
		<tr>
        	<td><? echo $i; ?></td>
            <td ><?php echo $print->tanggal; ?></td>
            <td><?php echo $print->no_bukti; ?></td>
            <td ><?php echo $print->cust_nama."( ".$print->cust_no.")"; ?></td>
            <td ><?php echo $print->pemakai_nama; ?></td>
            <td ><?php echo $print->paket_nama; ?></td>
            <td><?php echo $print->dapaket_jumlah; ?></td>
            <td><?php echo $print->referal; ?></td>
       </tr>
		<?php }
		}
		?>
         <tr>
                <td colspan="9">&nbsp;</td>
         </tr>
        <?
		}
		$rawat=$printlist->rawat_id; 
		}
		?>
	</tbody>
    	<tfoot>
    	<tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row'>Total</th>
            <td colspan='7'><?php echo count($data_print); ?> data</td>
        </tr>
    </tfoot>
</table>
</body>
</html>