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
<title>Laporan Penerimaan Kas <?php echo $periode; ?></title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Laporan Penerimaan Kas'>
	<caption>Laporan Penerimaan Kas <br/> <?php echo $periode;  ?></caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Tanggal</th>
            <th scope='col'>Tunai</th>
            <th scope='col'>Kwitansi</th>
            <th scope='col'>Kartu Kredit</th>
            <th scope='col'>Cek/Giro</th>
            <th scope='col'>Transfer</th>
            <th scope='col'>Voucher</th>
            <th scope='col'>Total Nilai</th>
        </tr>
    </thead>
	<tbody>
		<?php 
			$total_tunai=0;
			$total_kwitansi=0;
			$total_card=0;
			$total_cek=0;
			$total_transfer=0;
			$total_voucher=0;
			$total_nilai=0;
			
			$i=0; foreach($data_print as $print) { $i++; 
			$total_tunai+=$print->nilai_tunai;
			$total_kwitansi+=$print->nilai_kwitansi;
			$total_card+=$print->nilai_card;
			$total_cek+=$print->nilai_cek;
			$total_transfer+=$print->nilai_transfer;
			$total_voucher+=$print->nilai_voucher;
			$total_nilai+=($total_tunai+$total_kwitansi+$total_card+$total_cek+$total_transfer+$total_voucher)
		?>
		<tr>
        	<td><? echo $i; ?></td>
            <td><?php echo $print->tanggal; ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_tunai); ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_kwitansi); ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_card); ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_cek); ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_transfer); ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_voucher); ?></td>
            <td  class="numeric"><?php echo number_format($print->nilai_tunai+$print->nilai_card+$print->nilai_cek+$print->nilai_transfer+$print->nilai_voucher); ?></td>
       </tr>
		<?php } ?>
	</tbody>
    	<tfoot>
    	<tr>
        	<th scope='row'>Total</th>
            <td colspan='8'><?php echo count($data_print); ?> data</td>
        </tr>
        <tr>
        	<th scope='row' colspan="9">Resume</th>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Tunai (Rp)</th>
            <td class="numeric"><?php echo number_format($total_tunai); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Diskon Kwitansi (Rp)</th>
            <td class="numeric"><?php echo number_format($total_kwitansi); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Kartu Kredit (Rp)</th>
            <td class="numeric"><?php echo number_format($total_card); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Cek/Giro (Rp)</th>
            <td class="numeric"><?php echo number_format($total_cek); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Transfer (Rp)</th>
            <td class="numeric"><?php echo number_format($total_transfer); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Voucher (Rp)</th>
            <td class="numeric"><?php echo number_format($total_voucher); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Nilai (Rp)</th>
            <td class="numeric"><?php echo number_format($total_nilai); ?></td>
            <td colspan='6' class="clear">&nbsp;</td>
        </tr>
	</tfoot>
</table>
<body>
</body>
</html>