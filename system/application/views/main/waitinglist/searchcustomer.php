<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	background-color: #666666;
}
-->
</style></head>
<script src="searchcustomer.js">


</script>
<body onUnload="searchunload()">
<p>
  <?
include_once("db.php");

if(isset($_GET['page']))
$hal=$_GET['page'];
else
$hal=0;
$perpage=30;
$jmlrow=0;
$query=mysql_query("select count(*) from customer where cust_nama like '" .$_GET['cust_nama']."%' ");
$jmlrow=mysql_fetch_row($query);


$maxhal=floor($jmlrow[0]/$perpage);
if($jmlrow[0]%$perpage>0)
$maxhal++;

$query=mysql_query("select * from customer where cust_nama like '" .$_GET['cust_nama']."%' limit ".($hal*$perpage).",30");
//echo $maxhal." ".$hal;
?>
  <? if($hal>0) { ?>
  <a href="searchcustomer.php?cust_nama=<? echo $_GET['cust_nama']; ?>&page=<? echo($hal-1) ?>"> Previous page</a> | 
  <? } ?>
  Page <? echo ($hal+1) ?> | 
  <? if($maxhal>$hal) { ?>
  <a href="searchcustomer.php?cust_nama=<? echo $_GET['cust_nama']; ?>&page=<? echo ($hal+1) ?>" >Next Page</a> 
  <? } ?>
</p>
<table align="left">
  <tr><td>&nbsp;</td>
<td align="center">| Nama Customer | </td>
<td align="center">| No Customer |</td>
<td align="center"> | Customer Telp Rumah |</td>
<td align="center">Customer Handphone</td>
</tr>
<?


while($arrtim=mysql_fetch_array($query))
{
?>

<tr><td></td><td valign="top"><a href="#" onClick="selectcustomer('<? echo $arrtim['cust_nama'] ?>','<? echo $arrtim['cust_id'] ?>')" ><? echo $arrtim['cust_nama'] ?></a></td>
  <td  valign="top"><? echo $arrtim['cust_no'] ?></td>
  <td align="center"><? echo $arrtim['cust_telprumah'] ?></td>
   <td align="center"><? echo $arrtim['cust_hp'] ?></td>
  </tr>
  
<?

}
?>
</table>
</body>
</html>
