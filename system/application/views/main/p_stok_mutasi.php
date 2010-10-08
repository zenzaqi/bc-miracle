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
<title>List Mutasi</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body onload="window.print();">
<table summary='Rekap Jual'>
	<caption>Laporan Stok Mutasi <br/> <?php echo @$gudang_nama; ?> <br/> Periode <?php echo @$periode;  ?></caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Kode</th>           
            <th scope='col'>Nama Produk</th>
            <th scope='col'>Satuan</th>
            <th scope='col'>Stok Awal</th>
			<th scope='col'>Masuk</th>
            <th scope='col'>Keluar</th>
            <th scope='col'>Stok Saldo</th>
        </tr>
    </thead>
	<tbody>
		<?php $i=0; $tanggal=""; 
				$total_awal=0;
				$total_masuk=0;
				$total_keluar=0;
				$total_saldo=0;
				
		foreach($data_print as $print) { 
				$total_awal+=$print['jumlah_awal'];	
				$total_awal+=$print['jumlah_masuk'];	
				$total_awal+=$print['jumlah_keluar'];	
				$total_awal+=$print['jumlah_saldo'];	
				$i++; 
		?>
		<tr>
        	<td><? echo $i; ?></td>
            <td width="10"><?php echo $print['produk_kode']; ?></td>
            <td><?php echo $print['produk_nama']; ?></td>
			<td><?php echo $print['satuan_nama']; ?></td>
            <td align="right" class="numeric"><?php echo number_format($print['jumlah_awal'],2); ?></td>
			<td align="right" class="numeric"><?php echo number_format($print['jumlah_masuk'],2); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print['jumlah_keluar'],2); ?></td>
            <td align="right" class="numeric"><?php echo number_format($print['jumlah_saldo'],2); ?></td>
       </tr>
		<?php } ?>
	</tbody>
    	<tfoot>
    	<tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row'>Jumlah data</th>
			<td><?php echo count($data_print); ?> data</td>
			<td align="right"><b>Grand TOTAL</b></td>
            <td align="right" class="numeric"><b><?php echo number_format($total_awal,2); ?></b></td>
            <td align="right" class="numeric"><b><?php echo number_format($total_masuk,2); ?></b></td>
            <td align="right" class="numeric"><b><?php echo number_format($total_keluar,2); ?></b></td>
            <td align="right" class="numeric"><b><?php echo number_format($total_saldo,2); ?></b></td>
        </tr>
	</tfoot>
</table>
</body>
</html>