<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Kwitansi</title>
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
<table width="1280px" border="0px" cellpadding="0px" cellspacing="0px">
	<tr>
		<td height="90px"><table width="1280px" height="90px" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="700px" align="center" valign="bottom"><font style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:21px; border:#000000 1px solid;"><strong>PRODUK</strong></font></td>
            <td width="580px" valign="top"><table width="580px" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="60px" align="right">Tanggal</td>
                <td width="520px">:&nbsp;<?=$jproduk_tanggal;?></td>
              </tr>
              <tr>
                <td align="right">Nama</td>
                <td>:&nbsp;<?=$cust_nama;?></td>
              </tr>
              <tr>
                <td align="right">Alamat</td>
                <td>:&nbsp;GRAHA FAMILY G-19 PULAU GOLF<!--<//?=$cust_alamat;?>--></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
	</tr>
	<tr>
	  <td height="44px"><table width="1280px" height="44px" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200px">&nbsp;</td>
          <td width="1080px" valign="bottom"><?=$jproduk_nobukti;?></td>
        </tr>
      </table></td>
  </tr>
  	<tr>
	  <td width="1280px" height="25px">&nbsp;</td>
  </tr>
	<tr>
	  <td width="1280px" height="230px" valign="top">
	  <table width="1280px" border="0" cellspacing="0" cellpadding="0">
	  	<?php 
		$i=0;
		$total=0;
		$subtotal=0;
		$total_diskon=0;
		foreach($detail_jproduk as $list => $row) { $i+=1;?>
        <tr>
          <td width="560px">&nbsp;<?=$i;?>.&nbsp;<?=$row->produk_nama;?></td>
          <td width="170px">&nbsp;<?=$row->dproduk_jumlah;?> <?=$row->satuan_nama;?></td>
          <td width="200px">&nbsp;<?=ubah_rupiah($row->dproduk_harga);?></td>
          <td width="150px">&nbsp;<?=$row->dproduk_diskon;?></td>
          <td width="200px">&nbsp;<?=ubah_rupiah(($row->dproduk_jumlah)*($row->jumlah_subtotal));?></td>
        </tr>
		<?php 
			$subtotal+=(($row->dproduk_jumlah)*($row->jumlah_subtotal));
		}
		$total=($subtotal*((100-$jproduk_diskon)/100)-$jproduk_cashback);
		$total_diskon=($subtotal*($jproduk_diskon/100));
		?>
      </table>
	  </td>
  </tr>
	<tr>
	  <td width="1280px"><table width="1280" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="180px">&nbsp;</td>
          <td width="300px"><?=$_SESSION[SESSION_USERID];?></td>
          <td width="420px">&nbsp;</td>
          <td width="180px">&nbsp;</td>
          <td width="200px"><?=ubah_rupiah($subtotal);?></td>
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
          <td><?=ubah_rupiah($total_diskon);?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><?=$jumlah_tunai;?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><?=ubah_rupiah($total);?></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
