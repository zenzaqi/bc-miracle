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
<title>Laporan Rekap Penjualan <?php echo $jenis; ?> <?php echo $periode; ?></title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body onload="window.print();">
<table summary='Rekap Jual'>
	<caption>Laporan Rekap Penjualan <?php echo $jenis; ?><br/><?php echo $periode; ?>Group By No. Faktur</caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>No Faktur</th>           
            <th scope='col'>Tanggal</th>
            <th scope='col'>Customer</th>
            <th scope='col'>Diskon(%)</th>
            <th scope='col'>Diskon (Rp)</th>
            <th scope='col'>Total Item</th>
            <th scope='col'>Total Nilai (Rp)</th>
            <th scope='col'>Tunai (Rp)</th>
            <th scope='col'>Cek/Giro (Rp)</th>
            <th scope='col'>Transfer (Rp)</th>
            <th scope='col'>Kuitansi (Rp)</th>
            <th scope='col'>Credit Card (Rp)</th>
            <th scope='col'>Kredit (Rp)</th>
        </tr>
    </thead>
	<tfoot>
    	<tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row'>Total</th>
            <td colspan='12'><?php echo count($data_print); ?> data</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' colspan="13">Summary</th>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Item</th>
            <td nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_item,0,",","."); ?></td>
            <td colspan='11' class="clear">&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Diskon (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_diskon,2,",","."); ?></td>
             <td colspan='11' class="clear">&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Nilai (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_nilai,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Tunai (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_tunai,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Cek/Giro (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_cek,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Transfer (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_transfer,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Kuitansi (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_kuitansi,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Credit Card (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_card,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Kredit (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_kredit,2,",","."); ?></td>
             <td colspan='11' class="clear" >&nbsp;</td>
        </tr>
	</tfoot>
	<tbody>
		<?php $i=0; $tanggal=""; foreach($data_print as $print) { $i++; ?>
		<tr>
        	<td><? echo $i; ?></td>
            <td><?php echo $print->no_bukti; ?></td>
            <td><?php echo $print->tanggal; ?></td>
            <td><?php echo $print->cust_nama." (".$print->cust_no.")"; ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->diskon,0,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->cashback,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->jumlah_barang,0,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->total_nilai,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->tunai,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->cek,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->transfer,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->kuitansi,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->card,2,",","."); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->kredit,2,",","."); ?></td>
       </tr>
		<?php } ?>
	</tbody>
</table>
</body>
</html>