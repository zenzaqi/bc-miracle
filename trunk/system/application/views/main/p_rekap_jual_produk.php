<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: phonegroup Print
	+ Description	: For Print View
	+ Filename 		: p_phonegroup.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Rekap Penjualan Produk Periode <?php echo $tgl_mulai." s/d ".$tgl_akhir; ?> Group By Produk</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body onload="window.print()">
<table summary='Rekap Jual'>
	<caption>Laporan Rekap Penjualan <?php echo $jenis; ?><br/><?php echo $periode; ?> <br/>Group By Produk</caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Tanggal</th>
            <th scope='col'>No Faktur</th>
            <th scope='col'>Customer</th>
            <th scope='col'>Diskon(%)</th>
            <th scope='col'>Diskon (Rp)</th>
            <th scope='col'>Total Item</th>
            <th scope='col'>Total Nilai</th>
        </tr>
    </thead>
	<tfoot>
    	<tr>
        	<th scope='row'>Total</th>
            <td colspan='7'><?php echo count($data_print); ?> data</td>
        </tr>
        <tr>
        	<th scope='row' colspan="8">Resume</th>
        </tr>
        <tr>
        	<th scope='row'>Total Item</th>
            <td colspan='7'><?php echo $total_item; ?></td>
        </tr>
        <tr>
        	<th scope='row'>Diskon (Rp)</th>
            <td colspan='7'><?php echo $total_diskon; ?></td>
        </tr>
        <tr>
        	<th scope='row'>Total Nilai</th>
            <td colspan='7'><?php echo $total_nilai; ?></td>
        </tr>
	</tfoot>
	<tbody>
		<?php $i=0; foreach($data_print as $print) { $i++; ?>
		<tr>
        	<td><? echo $i; ?></td>
            <td><?php echo $print->tanggal; ?></td>
            <td><?php echo $print->no_bukti; ?></td>
            <td><?php echo $print->cust_nama." (".$cust_no.")"; ?></td>
            <td><?php echo $print->diskon; ?></td>
            <td><?php echo $print->cashback; ?></td>
            <td><?php echo $print->jumlah_barang; ?></td>
            <td><?php echo $print->total_nilai; ?></td>
       </tr>
		<?php } ?>
	</tbody>
</body>
</html>