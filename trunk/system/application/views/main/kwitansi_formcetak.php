<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Kwitansi</title>
<style type="text/css">
html,body,table,tr,td{
	font-family:Geneva, Arial, Helvetica, sans-serif;
}
.title{
	font-size:12px;
}
</style>
</head>
<body onload="window.print();window.close()">
<table width="1000" border="0">
  <tr>
    <td height="65px" colspan="2" align="center" valign="bottom"><font style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:32px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KWITANSI</strong></font></td>
    <td width="21%" valign="top"><table width="100%" border="0">

      <tr>
        <td width="34%" align="right">Tanggal :</td>
        <td width="66%"><?=$kwitansi_tanggal; ?></td>
      </tr>
    </table></td>
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
    <td colspan="2">Sudah terima dari &nbsp;<strong><?=$kwitansi_customer; ?>
    </strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?=$kwitansi_no; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="13%" class="title">Banyaknya uang </td>
    <td width="66%"><strong><?=$kwitansi_terbilang; ?></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="title">Untuk pembayaran </td>
    <td><?=$kwitansi_keterangan; ?></td>
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
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td width="71%" rowspan="2"><table width="100%" border="0">
          <tr>
            <td width="6%" style="font-weight:bold">Rp. </td>
            <td width="36%" align="right" style="border:#000000 solid 1px" background="../../../../assets/images/bg_dot.gif"><?=$kwitansi_nilai; ?></td>
            <td width="58%">&nbsp;</td>
          </tr>
        </table></td>
        <td width="29%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" height="5px">
          <tr>
            <td width="5%" style="border:#000000 solid 1px"><img name="space_height" src="" width="1" height="10" alt="" />&nbsp;</td>
            <td width="20%" class="title"><img name="space_height" src="" width="1" height="10" alt="" />Tunai</td>
            <td width="5%" style="border:#000000 solid 1px"><img name="space_height" src="" width="1" height="10" alt="" />&nbsp;</td>
            <td width="20%" class="title"><img name="space_height" src="" width="1" height="10" alt="" />Card</td>
            <td width="5%" style="border:#000000 solid 1px"><img name="space_height" src="" width="1" height="10" alt="" />&nbsp;</td>
            <td width="20%" class="title"><img name="space_height" src="" width="1" height="10" alt="" />Cek/Giro</td>
            <td width="5%" style="border:#000000 solid 1px"><img name="space_height" src="" width="1" height="10" alt="" />&nbsp;</td>
            <td width="20%" class="title"><img name="space_height" src="" width="1" height="10" alt="" />Transfer</td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="border:#000000 solid 1px; font-size:11px">Note: Kwitansi ini baru dianggap sah, setelah pembayaran dengan Bilyet Cek/Giro tsb dapat diuangkan. </td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
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
</table>
</body>
</html>
