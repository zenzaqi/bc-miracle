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
	<caption>Laporan Rekap Penjualan <?php echo $jenis; ?><br/><?php echo $periode; ?><br/>Group By Tanggal</caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Customer</th>
            <th scope='col'>No Faktur</th>
            <th scope='col'>Diskon(%)</th>
            <th scope='col'>Diskon (Rp)</th>
            <th scope='col'>Total Item</th>
            <th scope='col'>Total Nilai (Rp)</th>
            <th scope='col'>Tunai (Rp)</th>
            <th scope='col'>Cek/Giro (Rp)</th>
            <th scope='col'>Transfer (Rp)</th>
            <th scope='col'>Kuintansi (Rp)</th>
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
            <td colspan='10' class="clear">&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Diskon (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_diskon,2,",","."); ?></td>
             <td colspan='10' class="clear">&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Nilai (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_nilai,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Tunai (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_tunai,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Cek/Giro (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_cek,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Transfer (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_transfer,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Kuintansi (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_kuintansi,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Credit Card (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_card,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
        <tr>
        	<td class="clear">&nbsp;</td>
        	<th scope='row' nowrap="nowrap">Total Kredit (Rp)</th>
            <td  nowrap="nowrap" align="right" class="numeric clear"><?php echo number_format($total_kredit,2,",","."); ?></td>
             <td colspan='10' class="clear" >&nbsp;</td>
        </tr>
	</tfoot>
	<tbody>
		<?php $i=0; $j=0; $tanggal=""; foreach($data_print as $print) { ?>
			<?php if($tanggal!==$print->tanggal) { ?>
           <tr>
                <td><b><? $j++; echo $j; ?></b></td>
                <td colspan="12"><b><?php echo $print->tanggal;?></b></td>
           </tr>
           <?php $sub_cashback=0;
					$sub_total=0;
					$sub_tunai=0;
					$sub_cek=0;
					$sub_transfer=0;
					$sub_kuintansi=0;
					$sub_card=0;
					$sub_kredit=0;
					$sub_jumlah_barang=0;
					$i=0; 
			?>
           <?php foreach($data_print as $print_list) {  ?>
           <?php if($print_list->tanggal==$print->tanggal){ $i++;
		   			$sub_cashback+=$print_list->cashback;
					$sub_jumlah_barang+=$print_list->jumlah_barang;
					$sub_total+=$print_list->total_nilai;
					$sub_tunai+=$print_list->tunai;
					$sub_cek+=$print_list->tunai;
					$sub_transfer+=$print_list->transfer;
					$sub_kuintansi+=$print_list->kuintansi;
					$sub_card+=$print_list->card;
					$sub_kredit+=$print_list->kredit;
		   ?>
            <tr>
                <td><? echo $i; ?></td>
               	<td><?php echo $print_list->cust_nama."(".$print_list->cust_no.")"; ?></td>
                <td><?php echo $print_list->no_bukti; ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->diskon,0,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->cashback,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->jumlah_barang,0,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->total_nilai,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->tunai,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->cek,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->transfer,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->kuintansi,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->card,2,",","."); ?></td>
                <td align="right" class="numeric"><?php echo number_format($print_list->kredit,2,",","."); ?></td>
           </tr>
           <?php } ?>
           <?php } ?>
           <tr>
                <td colspan="4">&nbsp;</td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_cashback,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_jumlah_barang,0,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_total,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_tunai,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_cek,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_transfer,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_kuintansi,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_card,2,",","."); ?></b></td>
                <td align="right" class="numeric"><b><?php echo number_format($sub_kredit,2,",","."); ?></b></td>
           </tr>
           <?php } $tanggal=$print->tanggal; ?>
		<?php } ?>
	</tbody>
</table>
</body>
</html>