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
<title>Laporan Laba/Rugi <?php echo $periode; ?></title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Laporan Laba/Rugi '>
	<caption>Laporan Laba/Rugi  <br/> <?php echo $periode;  ?></caption>
	<thead>
    	<tr>
        	<th scope='col'>No</th>
            <th scope='col'>Kode</th>
            <th scope='col'>Akun</th>
            <th scope='col'>Debet</th>
            <th scope='col'>Kredit</th>
            <th scope='col'>Debet s/d bulan lalu</th>
            <th scope='col'>Kredit s/d bulan lalu</th>
        </tr>
    </thead>
	<tbody>
    	<tr>
        	<td>1.</td>
            <td colspan="6"><b>Pendapatan</b></td>
       </tr>
    	<?
			$i=0;
			$pend_debet=0;
			$pend_kredit=0;
			$pend_debet_lalu=0;
			$pend_kredit_lalu=0;
			foreach($pendapatan as $rowp){
				$i++;
		?>
        <tr>
            <td  class="numeric"><?php echo number_format($i); ?></td>
            <td  class="numeric"><?php echo number_format($rowp->akun_kode); ?></td>
            <td  class="numeric"><?php echo number_format($rowp->akun_nama); ?></td>
            <td  class="numeric"><?php echo number_format($rowp->debet); ?></td>
            <td  class="numeric"><?php echo number_format($rowp->kredit); ?></td>
            <td  class="numeric"><?php echo number_format($rowp->debet_lalu); ?></td>
            <td  class="numeric"><?php echo number_format($rowp->kredit_lalu); ?></td>
       </tr>
       <?
	   		$pend_debet+=$rowp->debet;
			$pend_kredit+=$rowp->kredit;
			$pend_debet_lalu+=$rowp->debet_lalu;
			$pend_kredit_lalu+=$rowp->kredit_lalu;
		}
	   ?>
       <tr>
        	<td>2.</td>
            <td colspan="6"><b>Beban</b></td>
       </tr>
       <?
			$i=0;
			$beban_debet=0;
			$beban_kredit=0;
			$beban_debet_lalu=0;
			$beban_kredit_lalu=0;
			foreach($beban as $rowb){
				$i++;
		?>
        <tr>
            <td  class="numeric"><?php echo number_format($i); ?></td>
            <td  class="numeric"><?php echo number_format($rowb->akun_kode); ?></td>
            <td  class="numeric"><?php echo number_format($rowb->akun_nama); ?></td>
            <td  class="numeric"><?php echo number_format($rowb->debet); ?></td>
            <td  class="numeric"><?php echo number_format($rowb->kredit); ?></td>
            <td  class="numeric"><?php echo number_format($rowb->debet_lalu); ?></td>
            <td  class="numeric"><?php echo number_format($rowb->kredit_lalu); ?></td>
       </tr>
       <?
	   		$beban_debet+=$rowb->debet;
			$beban_kredit+=$rowb->kredit;
			$beban_debet_lalu+=$rowb->debet_lalu;
			$beban_kredit_lalu+=$rowb->kredit_lalu;
		}
	   ?>
	</tbody>
    	<tfoot>
        <tr>
        	<th scope='row' colspan="7">Resume</th>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Debet (Rp)</th>
            <td class="numeric"><?php echo number_format($pend_debet+$beban_debet); ?></td>
            <td colspan='4' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Kredit (Rp)</th>
            <td class="numeric"><?php echo number_format($pend_kredit+$beban_kredit); ?></td>
            <td colspan='4' class="clear">&nbsp;</td>
        </tr>
       <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Debet Bulan Lalu (Rp)</th>
            <td class="numeric"><?php echo number_format($pend_debet_lalu+$beban_debet_lalu); ?></td>
            <td colspan='4' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Kredit Bulan Lalu (Rp)</th>
            <td class="numeric"><?php echo number_format($pend_kredit_lalu+$beban_kredit_lalu); ?></td>
            <td colspan='4' class="clear">&nbsp;</td>
        </tr>
        <tr><td class="clear">&nbsp;</td>
        	<th scope='row'>Total Saldo (Rp)</th>
            <td class="numeric"><?php echo number_format($total_tunai); ?></td>
            <td colspan='4' class="clear">&nbsp;</td>
        </tr>
	</tfoot>
</table>
<body>
</body>
</html>