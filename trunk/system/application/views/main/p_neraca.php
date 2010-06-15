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
<title>Laporan Neraca</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Laporan Laba/Rugi'>
	<caption>Laporan Neraca</caption>
    <tbody>
   
		<?php 
		$total_debet=0;
		$total_kredit=0;
		$i=0; 
		$j=0;
		$akun_jenis="";
		foreach($data_print as $print) { 
			
			if($akun_jenis!==$print["akun_jenis"]){
				$j++;
		?>
         <tr>
            <td colspan="4"><b><?php echo $j.". ".$print["akun_jenis"]; ?></b>
            </td>
        </tr>
        <?php
			$sub_debet=0;
			$sub_kredit=0;
			$parent=0;
			$akun_parent=0;
		?>
        <?php foreach($data_print as $printlist) { ?>
      		
        <?php if($print["akun_jenis"]==$printlist["akun_jenis"]) { 
				$i++;	
			?>
        <?php if($print["akun_jenis"]=="Aset" && $akun_parent!==$printlist["akun_parent_id"]) { ?>
        <tr>
            <td>&nbsp;</td><td colspan="3"><b><?php echo $printlist["akun_parent"]; ?></b>
            </td>
        </tr>
        <?php } 
			$akun_parent=$printlist["akun_parent_id"];
		?>
		<tr>
		<td><? echo "-"; ?></td>
		<td><?php echo $printlist["akun_nama"]; ?></td>
		<td align="right" class="numeric"><?php echo number_format($printlist["debet"]); ?></td>
		<td align="right" class="numeric"><?php echo number_format($printlist["kredit"]); ?></td>
		</tr>
		<?php 
			$sub_debet+=$printlist["debet"];
			$sub_kredit+=$printlist["kredit"];
		}
		?>
		<?php } ?>
        <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right" class="numeric"><?php echo number_format($sub_debet); ?></td>
		<td align="right" class="numeric"><?php echo number_format($sub_kredit); ?></td>
		</tr>
        <? }
		$akun_jenis=$print["akun_jenis"];
		$i=0;
		?>
        <? } ?>
	</tbody>

	
<body>
</body>
</html>