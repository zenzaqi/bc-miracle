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
<title>Laporan Rekap Penjualan</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body onload="window.print();">
<table summary='Rekap Jual'>
	<caption>Laporan Rekap Penjualan</caption>
	<thead>
    	<tr>
			<th scope='col'>No</th>
        	<th scope='col'>Kode</th>
            <th scope='col'>Nama</th>           
            <th scope='col'>Total Jumlah</th>
            <th scope='col'>Sub Total</th>
            <th scope='col'>Diskon Tambahan</th>
			<th scope='col'>Grand Total</th>
        </tr>
    </thead>
	<tbody>
		<?php 
		
		$i=0; $tanggal=""; 
				$total_jumlah=0;
				$subtotal=0;
				$diskon_tambahan=0;
				$grand_total=0;
				
		foreach($jumlah_result as $print) { 
				$total_jumlah+=$print->total_jumlah;
				$subtotal+=$print->subtotal;
				//$total_diskonp+=($print->diskon*$print->total_nilai)/100;
				$diskon_tambahan+=$print->diskon_tambahan;
				$grand_total+=$print->grand_total;
				/*
				$total_bayar+=$print->total_bayar;
				$total_tunai+=$print->tunai;
				$total_cek+=$print->cek;
				$total_transfer+=$print->transfer;
				$total_kuitansi+=$print->kuitansi;
				$total_card+=$print->card;
				$total_voucher+=$print->voucher;
				$total_kredit+=$print->kredit;
				*/
				$i++; 
		
		?>
		<tr>
        	<td><? echo $i; ?></td>
            <td width="10"><?php echo $print->kode; ?></td>
            <td><?php echo $print->nama; ?></td>
			<td align="right" class="numeric"><?php echo number_format($print->total_jumlah,0,",",","); ?></td>
			<td align="right" class="numeric"><?php echo number_format($print->subtotal,0,",",","); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->diskon_tambahan,0,",",","); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print->grand_total,0,",",","); ?></td>
       </tr>
		<?php } ?>
	</tbody>
    	<tfoot>
    	<tr>
        	<td class="clear">&nbsp;</td>
			<td class="clear">&nbsp;</td>
			<td class="clear">&nbsp;</td>
			<?/*<td><?php echo count($data_print); ?> data</td>*/?>
            <td align="right" class="numeric"><b><?php echo number_format($total_jumlah,0,",",","); ?></td>
            <td align="right" class="numeric"><b><?php echo number_format($subtotal,0,",",","); ?></td>
            <td align="right" class="numeric"><b><?php echo number_format($diskon_tambahan,0,",",","); ?></td>
            <td align="right" class="numeric"><b><?php echo number_format($grand_total,0,",",","); ?></td>
        </tr>
	</tfoot>
</table>
</body>
</html>