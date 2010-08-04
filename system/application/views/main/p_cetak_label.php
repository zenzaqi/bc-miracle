<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Penjualan Print
	+ Description	: For Print View
	+ Filename 		: p_rekap_jual.php
 	+ Author  		:  Isaac Irvan
 	+ Created on 01/Feb/2010 14:30:05
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Label Customer</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<body onload="window.print();">
<table border="0">
<tr><td height="10" colspan="6"></td></tr>
		<? 
			$i=1;
			$k=1;
			foreach($jumlah_result as $list => $row) 
			{
				$j=$i%2;
				if ($j==1)
				{ 
					//print "masuk $i";
					print "<tr>"; 
				}?> 
					<td width="30"></td>
					<? if ($k==5){ ?>
					<td height="130" width="300"><br><br><b><?=$row->cust_nama;?></b><br><?=$row->cust_alamat;?>.<br> <?=$row->cust_kota;?></td>
					<? } else {?>
					<td height="130" width="300"><b><?=$row->cust_nama;?></b><br><?=$row->cust_alamat;?>.<br> <?=$row->cust_kota;?></td>
					<? } ?>
					<td width="30"></td>
				<? 
				if ($j==0)
				{
					if ($k!=5)
						{ print "<tr><td height=10 colspan=6></td></tr>"; 
						  $k++;
						}
					else 
						{ $k=1;}
					print "</tr>";  
				} 
				$i++;
			}
		?>

</table>
</body>
</html>