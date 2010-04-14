<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Penjualan Paket</title>
<style type="text/css">
html,body,table,tr,td{
	font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size:12px;
}
.title{
	font-size:12px;
}
</style>
</head>
<body onload="window.print();window.close()">
<table width="1240px" border="0px" cellpadding="0px" cellspacing="0px">
	<tr>
		<td height="90px"><table width="1240px" height="90px" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="700px" align="center" valign="bottom">&nbsp;</td>
            <td width="540px" valign="top"><table width="540px" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="60px" align="right">Tanggal</td>
                <td width="480px">:&nbsp;&nbsp;<?=$jpaket_tanggal;?></td>
              </tr>
			  <tr>
                <td align="right">Nomor</td>
                <td>:&nbsp;&nbsp;<?=$cust_no;?></td>
              </tr>
              <tr>
                <td align="right">Nama</td>
                <td>:&nbsp;&nbsp;<?=$cust_nama;?></td>
              </tr>
              <tr>
                <td align="right">Alamat</td>
                <td>:&nbsp;&nbsp;<?=$cust_alamat;?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
	</tr>
	<tr>
	  <td height="34px"><table width="1240px" height="34px" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200px">&nbsp;</td>
          <td width="1040px" valign="bottom"><?=$jpaket_nobukti;?></td>
        </tr>
      </table></td>
  </tr>
  	<tr>
	  <td width="1240px" height="25px">&nbsp;</td>
  </tr>
	<tr>
	  <td width="1240px" height="230px" valign="top">
	  <table width="1240px" border="0" cellspacing="0" cellpadding="0">
	  	<?php 
		$i=0;
		$total=0;
		$subtotal=0;
		$total_diskon=0;
		foreach($detail_jpaket as $list => $row) { $i+=1;?>
        <tr>
          <td width="490px">&nbsp;<?=$i;?>.&nbsp;<?=$row->paket_nama;?></td>
          <td width="150px">&nbsp;<?=$row->dpaket_jumlah;?></td>
          <td width="160px" align="right">&nbsp;<?=rupiah($row->dpaket_harga);?></td>
          <td width="170px" align="right">&nbsp;<?=$row->dpaket_diskon;?></td>
          <td width="270px" align="right">&nbsp;<?=rupiah(($row->dpaket_jumlah)*($row->jumlah_subtotal));?></td>
        </tr>
		<?php 
			$subtotal+=(($row->dpaket_jumlah)*($row->jumlah_subtotal));
		}
		$total=($subtotal*((100-$jpaket_diskon)/100)-$jpaket_cashback);
		$total_diskon=($subtotal*($jpaket_diskon/100));
		?>
      </table>
	  </td>
  </tr>
	<tr>
	  <td width="1240px"><table width="1240px" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="160px">&nbsp;</td>
          <td width="280px"><?=$_SESSION[SESSION_USERID];?></td>
          <td width="420px">&nbsp;</td>
          <td width="180px">&nbsp;</td>
          <td width="200px" align="right"><?=rupiah($subtotal);?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><?=rupiah($total_diskon);?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><?=rupiah($jumlah_tunai);?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><?=rupiah($total);?></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
