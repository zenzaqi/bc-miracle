<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tbl_t_buku_besar Print
	+ Description	: For Print View
	+ Filename 		: p_tbl_t_buku_besar.php
 	+ Author  		: 
 	+ Created on 27/May/2010 16:40:49
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Laba/Rugi</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Laporan Laba/Rugi'>
	<caption>Laporan Laba/Rugi</caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Akun</th>
            <th scope='col'>Nama</th>
            <th scope='col'>Debet</th>
            <th scope='col'>Kredit</th>
       	</tr>
    </thead>
    <tbody>
    <tr>
    	<td colspan="5"><b>1. Pendapatan</b>
        </td>
    </tr>
		<?php 
		$total_debet=0;
		$total_kredit=0;
		$i=1; 
		foreach($data_print as $print) { 
			if($print["labarugi_jenis"]=="1. Pendapatan"){
				$i++; 
		?>
		<tr>
		<td><? echo $i; ?></td>
		<td><?php echo $print["labarugi_akun_kode"]; ?></td>
		<td><?php echo $print["labarugi_akun_nama"]; ?></td>
		<td align="right" class="numeric"><?php echo number_format($print["labarugi_debet"]); ?></td>
		<td align="right" class="numeric"><?php echo number_format($print["labarugi_kredit"]); ?></td>
		</tr>
		
		<?php 
		$total_kredit+=$print["labarugi_kredit"]; 
			}
		} ?>
     <tr>
    	<td colspan="3" class="numeric"><b>Jumlah</b></td>
        <td class="numeric">0</td>
        <td align="right" class="numeric"><b><?=number_format($total_kredit)?></b></td>
    </tr>
    <tr>
    	<td colspan="5"><b>2. Beban</b>
        </td>
    </tr>
		<?php 
		foreach($data_print as $print) { 
			if($print["labarugi_jenis"]=="2. Beban"){
			$i++; 
		?>
		<tr>
		<td><? echo $i; ?></td>
		<td><?php echo $print["labarugi_akun_kode"]; ?></td>
		<td><?php echo $print["labarugi_akun_nama"]; ?></td>
		<td align="right" class="numeric"><?php echo number_format($print["labarugi_debet"]); ?></td>
		<td align="right" class="numeric"><?php echo number_format($print["labarugi_kredit"]); ?></td>
		</tr>
		
		<?php 
		$total_debet+=$print["labarugi_debet"]; 
			}
		} ?>
     <tr>
    	<td colspan="3"><b>Jumlah</b></td>
        <td class="numeric">0</td>
        <td align="right" class="numeric"><b><?=number_format($total_debet)?></b></td>
    </tr>
	</tbody>
    <? $saldo=($total_kredit-$total_debet); ?>
	<tfoot>
    	<tr>
        	<td scope='row' colspan="3">Laba/Rugi Bersih</td>
            <td class="number"><b><?php if($saldo<0) echo number_format($saldo)?></b></td>
            <td class="number"><b><?php if($saldo>0) echo number_format(abs($saldo))?></b></td>
     	</tr>
    </tfoot>
	
<body>
</body>
</html>