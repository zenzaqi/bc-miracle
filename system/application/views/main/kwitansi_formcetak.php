<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Kwitansi</title>
</head>
<body onload="window.print()">
<table width="1000" border="0">
  <tr>
    <td colspan="2" align="center"><h1>KWITANSI</h1></td>
    <td width="21%">No: <?=$kwitansi_no; ?><br/>
    Tanggal : <?=$kwitansi_tanggal; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="13%">Terima dari</td>
    <td width="66%">: <?=$kwitansi_customer; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nilai</td>
    <td> : <?=$kwitansi_nilai; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Untuk Pembayaran</td>
    <td>: <?=$kwitansi_keterangan; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td> : <?=$kwitansi_terbilang; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%%" border="1">
      <tr>
        <td>Note: Kwitansi ini baru dianggap sah, setelah pembayaran dengan bilyet Giro/Cek tsb dapat diuangkan</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
