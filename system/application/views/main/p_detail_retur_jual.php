<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Penjualan Print
	+ Description	: For Print View
	+ Filename 		: p_detail_jual.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Retur Detail Penjualan <?php echo $jenis; ?> <?php echo $periode; ?></title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body>
<table summary='Detail Retur Jual'>
	<caption>Laporan Retur Detail Penjualan <?php echo $jenis; ?><br/><?php echo $periode; ?></caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Tanggal</th>
            <th scope='col'>Nama Barang/Jasa</th>
            <th scope='col'>Satuan</th>
            <th scope='col'>Jumlah</th>
            <th scope='col'>Harga</th>
            <th scope='col'>Diskon(%)</th>
            <th scope='col'>Diskon(Rp)</th>
            <th scope='col'>Jenis Diskon</th>
            <th scope='col'>Total Nilai (Rp)</th>
        </tr>
    </thead>
	<tfoot>
    	<tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total</th>
            <td colspan='9'><?php echo count($data_print); ?> data</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' colspan="10">Summary</th>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Item</th>
            <td class="numeric clear" nowrap="nowrap"><?php echo number_format($total_item,0,",","."); ?></td>
            <td colspan="8" class="clear">&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Diskon (Rp)</th>
            <td class="numeric clear" nowrap="nowrap" ><?php echo number_format($total_diskon,2,",","."); ?></td>
            <td colspan="8" class="clear">&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Nilai (Rp)</th>
            <td class="numeric clear" nowrap="nowrap"><?php echo number_format($total_nilai,2,",","."); ?></td>
            <td colspan="8" class="clear">&nbsp;</td>
        </tr>
	</tfoot>
	<tbody>
		<?php $i=0; $tanggal=""; foreach($data_print as $print) { $i++; ?>
		<tr>
        	<td><? echo $i; ?></td>
            <td><?php echo ($print->tanggal!==$tanggal?$print->tanggal:"");$tanggal=$print->tanggal; ?></td>
            <td><?php echo $print->produk_nama."( ".$print->produk_kode.")"; ?></td>
            <td><?php echo $print->satuan_nama; ?></td>
            <td class="numeric"><?php echo number_format($print->jumlah_barang,0,",","."); ?></td>
            <td class="numeric"><?php echo number_format($print->harga_satuan,2,",","."); ?></td>
            <td class="numeric"><?php echo number_format($print->diskon,0,",","."); ?></td>
            <td class="numeric"><?php echo number_format($print->diskon_nilai,2,",","."); ?></td>
            <td class="numeric"><?php echo $print->diskon_jenis; ?></td>
            <td class="numeric"><?php echo number_format($print->subtotal,2,",","."); ?></td>
       </tr>
		<?php } ?>
	</tbody>
</table>
</body>
</html>