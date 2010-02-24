<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	background-color: #F3F3F3;
}
-->
</style></head>
<script src="searchperawatan.js">

</script>
<body onUnload="searchunload()">
<?
include_once("db.php");

if(isset($_GET['page']))
$hal=$_GET['page'];
else
$hal=0;
$perpage=30;
$jmlrow=0;
$query=mysql_query("select count(*) from perawatan where rawat_nama like '" .$_GET['rawat_nama']."%' ");
$jmlrow=mysql_fetch_row($query);


$maxhal=floor($jmlrow[0]/$perpage);
if($jmlrow[0]%$perpage>0)
$maxhal++;

$query=mysql_query("select * from perawatan where rawat_nama like '%" .$_GET['rawat_nama']."%' or rawat_kode like '%".$_GET['rawat_nama']."%' limit ".($hal*$perpage).",30");
//echo $maxhal." ".$hal;
?>
<? if($hal>0) { ?>
<a href="searchperawatan.php?rawat_nama=<? echo $_GET['rawat_nama']; ?>&page=<? echo($hal-1) ?>"> Previous page</a> | <? } ?>Page <? echo ($hal+1) ?> | <? if($maxhal>$hal) { ?><a href="searchperawatan.php?rawat_nama=<? echo $_GET['rawat_nama']; ?>&page=<? echo ($hal+1) ?>" >Next Page</a> <? } ?>
<table>
  <tr><td>&nbsp;</td>
<td>Nama Perawatan </td>
<td>Kode Perawatan</td>
</tr>
<?


while($arrtim=mysql_fetch_array($query))
{
?>

<tr><td></td><td valign="top"><a href="#" onClick="selectperawatan('<? echo $arrtim['rawat_nama'] ?>','<? echo $arrtim['rawat_id'] ?>')" ><? echo $arrtim['rawat_nama'] ?></a></td>
  <td  valign="top"><? echo $arrtim['rawat_kode'] ?></td></tr>
  
<?

}
?>
</table>
</body>
</html>
