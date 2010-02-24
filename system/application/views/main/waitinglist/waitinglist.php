<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="datepickercontrol.css" rel="stylesheet" type="text/css">


<style>
.tableview {
	border: thin solid #FFFFFF;
}
.tableview h2 {
	background-color: #E8FFFD;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #CCCCCC;
	border-right-color: #F3F3F3;
	border-bottom-color: #CCCCCC;
	border-left-color: #F3F3F3;
	padding: 5px;
	font-size: 16px;
	margin: 0px;
}
.tableview h1{
	font-size: 18px;
	font-style: normal;
	background-color: #005791;
	border: thin solid #000033;
	color: #F2FDFF;
	text-align: center;
	margin-bottom: 0px;
	vertical-align: middle;
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	width: 120px;
}
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
	font-style: italic;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
	font-weight: bold;
}
.style6 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
.style9 {font-family: Arial, Helvetica, sans-serif; font-style: italic; }
body {
	background-image: url(logo%20kecil.jpg);
	background-repeat: no-repeat;
}
</style>
<script src="datepickercontrol.js" ></script>
<script src="searchcustomer.js"></script>
<script src="searchperawatan.js"></script>
</head>
<body >
<? include("db.php");
?>
<script language="javascript" type="text/javascript">

/*function delconfirm(idbook)
{
	if(confirm("Hapus "+ idbook +" booking?"))
	{
	document.location.href="managejadwal.php?delbooking="+idbook;
	}
	return false;
}*/

/*function bookconfirm(idbook)
{
	if(confirm("Confirm id booking no "+ idbook +" ?"))
	{
	document.location.href="managejadwal.php?confirmid="+idbook;
	}
	return false;
}*/

function viewjadwal()
{
document.location.href='managejadwal.php?status='+document.getElementById('lststatus').value;
}

function listcustomer()
{
showsearch(document.getElementById('txtcustomer').value);
}

function listperawatan()
{
showsearchperawatan(document.getElementById('txtperawatan').value);
}

</script>
<title>Waiting List</title>
<table width="100%" height="400">
<tr>
  <td height="23" ><div align="center" >
    <h2 align="center" class="style1">W A I T I N G &nbsp;&nbsp;L I S T</h2>
    </div></td>
</tr>
<tr valign="top">
<td align="center">

    <div align="center">
    <form action="waitinglist.php" method="get">
      <div align="center"></div>
      <table width="200" border="0" align="left">
        <tr>
          <td height="83" ><table width="200" border="0" align="left">
            <tr >
              <td bordercolor="#D8D8D8"><span class="style9">Tgl 
                </span>
                <input name="txtsearchtgl" type="text" id="DPC_date1" size="8"  value="<? echo date("d-m-Y"); ?>" /></td>
              <td bordercolor="#D8D8D8"><label> </label>
                  <div align="center"><span class="style9"> Dokter</span>
                      <select name="listdokter" id="listdokter">
                        <? $query=mysql_query("select * from karyawan where karyawan_jabatan=8");
	  while($data=mysql_fetch_array($query))
	  {
		  $karyawan = $data['karyawan_id'];
		  $kar_username = $data['karyawan_username'];
		  print "<option value=$karyawan>$kar_username</option>";
	  }
	  
	  ?>
                      </select>
                </div></td>
            </tr>
            <tr>
              <td height="26" colspan="2" bordercolor="#D8D8D8"><div align="center">
                <input name="submitsearchdokter" type="submit" value="Search" />
              </div></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="26">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="26">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="26">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" colspan="2"><input  type="button" value="Tampilkan Semua Data"  onclick="document.location.href='waitinglist.php'" />
                <label> </label>
                  <div align="center"></div></td>
              </tr>
          </table></td>
          </tr>
        <tr></tr>
      </table>
      </form>
      <p align="left">
        <? 
if(isset($_GET['appointment']))
{
	$query=mysql_query("select * from waiting_list where wl_id=".$_GET['appointment']."");
	$arr=mysql_fetch_array($query);
	$temp2=$arr['karyawan_id'];
	$temp3=date("Y-m-d",strtotime($arr['wl_date']));
	
	$query=mysql_query("update waiting_list set wl_priority=wl_priority-1 where karyawan_id = ".$temp2." and wl_date = '".$temp3."'");
	$query=mysql_query("update waiting_list set wl_priority=null, wl_status='Appointment' where wl_id = ".$_GET['appointment']."");
	
}

if(isset($_GET['batal']))
{
	$query=mysql_query("select * from waiting_list where wl_id=".$_GET['batal']."");
	$arr=mysql_fetch_array($query);
	$temp=$arr['wl_priority'];
	$temp2=$arr['karyawan_id'];
	$temp3=date("Y-m-d",strtotime($arr['wl_date']));
	
	$query=mysql_query("update waiting_list set wl_priority=wl_priority-1 where wl_priority > ".$temp." and karyawan_id = ".$temp2." and  wl_date = '".$temp3."'");	
	$query=mysql_query("update waiting_list set wl_status='Batal', wl_priority=null where wl_id=".$_GET['batal']."");
}

if(isset($_GET['batal2']))
{
	$query=mysql_query("select * from waiting_list where wl_id=".$_GET['batal2']."");
	$arr=mysql_fetch_array($query);
	$temp2=$arr['karyawan_id'];
	$temp3=date("Y-m-d",strtotime($arr['wl_date']));
	
		$query=mysql_query("update waiting_list set wl_priority=wl_priority-1 where karyawan_id = ".$temp2." and wl_date = '".$temp3."' and wl_priority>0");
		$query=mysql_query("update waiting_list set wl_priority=null, wl_status='Batal' where wl_id=".$_GET['batal2']."");

}

if(isset($_GET['up']))
{
	$query=mysql_query("select * from waiting_list where wl_id=".$_GET['up']."");
	$arr=mysql_fetch_array($query);
	$temp=$arr['wl_priority'];
	$temp2=$arr['karyawan_id'];
	$temp3=date("Y-m-d",strtotime($arr['wl_date']));
	$hitung=strval($temp)-1;
	
	if($hitung>0)
	{
	$query=mysql_query("update waiting_list set wl_priority=".$temp." where wl_priority = ".$hitung." and karyawan_id = ".$temp2." and wl_date = '".$temp3."'");
	$query=mysql_query("update waiting_list set wl_priority=".$hitung." where wl_id=".$_GET['up']."");
	}
}

if(isset($_GET['down']))
{
	$query=mysql_query("select * from waiting_list where wl_id=".$_GET['down']."");
	$arr=mysql_fetch_array($query);
	$temp=$arr['wl_priority'];
	$temp2=$arr['karyawan_id'];
	$temp3=date("Y-m-d",strtotime($arr['wl_date']));
	$hitung=strval($temp)+1;
	
	$query=mysql_query("update waiting_list set wl_priority=".$temp." where wl_priority = ".$hitung." and karyawan_id = ".$temp2." and wl_date = '".$temp3."'");
	$query=mysql_query("update waiting_list set wl_priority=".$hitung." where wl_id=".$_GET['down']."");
}

?><? 
if(isset($_POST['submitwaiting']))
{

$query=mysql_query("select max(wl_priority) from waiting_list where karyawan_id =".$_POST['lstdokter']." and wl_date = '".date("Y-m-d",strtotime($_POST['txttgl']))."'");
if(mysql_num_rows($query)>0)
{
$no=mysql_fetch_row($query);
$no[0]=strval($no[0])+1;
}
else
$no[0]=1;

if(strlen($_POST['txtperawatan'])>0)
{
if(strlen($_POST['txtcustomer'])==0)
{
$_POST['txtcustomer']="-1";
}
$temp3=date("Y-m-d",strtotime($_POST['txttgl']));

mysql_query(" insert into waiting_list (wl_date, wl_status, wl_priority, wl_keterangan, karyawan_id, cust_id, rawat_id) values('".$temp3."' , 'Waiting List' , ".$no[0]." , '".$_POST['txtketerangan']."', '".$_POST['lstdokter']."' , ".$_POST['txtcustomer'].", '".$_POST['txtperawatan']."') ");

}
		else
		echo "Pilih Perawatan terlebih dahulu";

}

?>
      </p>
    </div>
    <form action="waitinglist.php" method="post">
      <table width="200" border="0" align="left" style="margin-left:50px">

        <tr>
          <td><table width="200" border="0" align="left">
            <tr>
              <th colspan="5" scope="col"><div align="center" class="style2">Tambah Waiting List</div></th>
            </tr>
            <tr>
              <td><span class="style6">Tgl</span></td>
              <td><input name="txttgl" type="text" id="DPC_date2" size="14"  value="<? echo date("d-m-Y"); ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="style6">Dokter</span></td>
              <td><select name="lstdokter" id="lstdokter">
                  <? $query=mysql_query("select * from karyawan where karyawan_jabatan=8");
	  
	  while($data=mysql_fetch_array($query)){
	  
	  ?>
                  <option value="<? echo $data['karyawan_id']?>"> <? echo $data['karyawan_username'] ?></option>
                  <?
		}
		?>
              </select></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="style6">Customer</span></td>
              <td><input  type="text" id="txtcustomer" />
                  <input  name="txtcustomer" type="hidden" id="txtcustomer2" />              </td>
              <td><a href="#" class="style2" onclick="listcustomer()">Search</a></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="style6">Perawatan</td>
              <td><input type="text" id="txtperawatan" />
                  <input name="txtperawatan" type="hidden" id="txtperawatan2" />              </td>
              <td><a href="#" class="style2" onclick="listperawatan()">Search</a></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div align="left"><span class="style4">Keterangan</span></div></td>
              <td><textarea name="txtketerangan" id="txtketerangan"></textarea></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div align="left"></div></td>
              <td>
                <div align="center">
                  <input name="submitwaiting" type="submit" value="Tambah" />
                    </div></td><td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
      </table>
      <div align="left"></div>
    </form>

<div align="left">
  <p>&nbsp;    </p>
  <p>&nbsp;</p>
</div>
<div align="left">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>
<table border="1" align="left" cellpadding="4" cellspacing="0" class="tableview">
  <thead style="background-color:#00CCFF">
    <tr>
      <td align="center"> <span class="style2">Tanggal</span></td>
      <td align="center"> <span class="style2">Dokter</span></td>
      <td align="center"> <span class="style2">Customer</span></td>
      <td align="center"> <span class="style2">No.Cust</span></td>
      <td align="center"> <span class="style2">Perawatan</span></td>
      <td align="center"><span class="style2">Status</span></td>
	  <td align="center"> <span class="style2">action for status</span></td>
      <td align="center"> <span class="style2">Keterangan</span></td>
	  <td align="center"> <span class="style2">Priority</span></td>
      <td align="center"> <span class="style2">Action </span></td>
    </tr>
  </thead>
  <?
  
if(isset($_GET['appointment']) or (isset($_GET['batal']) or (isset($_GET['up']) or (isset($_GET['down']) or (isset($_GET['batal2']))))))
{
	$id_dokter = $_GET['iddokter'];
 $sql="select waiting_list.*,karyawan.karyawan_username,customer.cust_nama,customer.cust_no,perawatan.rawat_nama 
  from waiting_list,karyawan,customer,perawatan 
  where waiting_list.cust_id=customer.cust_id and waiting_list.rawat_id=perawatan.rawat_id and waiting_list.karyawan_id=karyawan.karyawan_id and waiting_list.karyawan_id = $id_dokter
  order by waiting_list.wl_date desc,waiting_list.wl_status='Waiting List' desc,waiting_list.wl_status='Appointment' desc,waiting_list.karyawan_id,waiting_list.wl_priority";
  $query=mysql_query($sql); 
 
 }
 else
 {

 	  $sql="select waiting_list.*,karyawan.karyawan_username,customer.cust_nama,customer.cust_no,perawatan.rawat_nama 
  from waiting_list,karyawan,customer,perawatan where waiting_list.cust_id=customer.cust_id and waiting_list.rawat_id=perawatan.rawat_id and waiting_list.karyawan_id=karyawan.karyawan_id 
  order by waiting_list.wl_date desc,waiting_list.wl_status='Waiting List' desc,waiting_list.wl_status='Appointment' desc,waiting_list.karyawan_id,waiting_list.wl_priority";
  $query=mysql_query($sql);
 }
 
	if(isset($_GET['submitsearchdokter']))
{
	$id_dokter = $_GET['listdokter'];
	$temp3=date("Y-m-d",strtotime($_GET['txtsearchtgl']));
 
 $sql="select waiting_list.*,karyawan.karyawan_username,customer.cust_nama,customer.cust_no,perawatan.rawat_nama 
  from waiting_list,karyawan,customer,perawatan 
  where waiting_list.cust_id=customer.cust_id and waiting_list.rawat_id=perawatan.rawat_id and waiting_list.karyawan_id=karyawan.karyawan_id and waiting_list.karyawan_id = $id_dokter and waiting_list.wl_date = '".$temp3."'
  order by waiting_list.wl_date desc,waiting_list.wl_status='Waiting List' desc,waiting_list.wl_status='Appointment' desc,waiting_list.karyawan_id,waiting_list.wl_priority";
  $query=mysql_query($sql); 
 
 }
 
  $countresult=mysql_num_rows($query);
  if($countresult=0)
  {
  	print("<td>Tidak ada Waiting List</td>");
  }
  else
  {
  	while($row=mysql_fetch_array($query))
	{
		$query2=mysql_query("select wl_priority from waiting_list where karyawan_id=".$row['karyawan_id']." and wl_date = '".date("Y-m-d",strtotime($row['wl_date']))."' order by wl_priority desc");
  		$row2=mysql_fetch_array($query2);
  		$max = $row2[0];

	print("<tr><td>".date("d-M-Y",strtotime($row['wl_date']))." </td><td>".$row['karyawan_username']." </td><td> ".$row['cust_nama']." </td> <td> ".$row['cust_no']." </td>");
	if($row['wl_status']=='Appointment')
		$color='green';
	else if($row['wl_status']=='Waiting List')
		$color='black';
	else if($row['wl_status']=='Batal')
		$color='red';
	print("<td>".$row['rawat_nama']." </td><td> <b><font color=$color>".$row['wl_status']." </font> </td> ");
	
	if($row['wl_priority']==1)
		print("<td> <a href='waitinglist.php?appointment=$row[wl_id]&iddokter=$row[karyawan_id]' >Appointment </a> | <a href='waitinglist.php?batal2=$row[wl_id]&iddokter=$row[karyawan_id]' > Batal </a> ");
	
	else if($row['wl_status']=='Waiting List')
		print(" <td><a href='waitinglist.php?batal=$row[wl_id]&iddokter=$row[karyawan_id]' > Batal </a> ");
	
	else if($row['wl_status']=='Batal')
		print("<td>");

	else if($row['wl_status']=='Appointment')
		print("<td>");
	
	print("<td> ".$row['wl_keterangan']." </td>");
	print("<td align=center> ".$row['wl_priority']." </td>");
	
	if(strval($row['wl_priority'])>1)
	print("<td> <a href='waitinglist.php?up=$row[wl_id]&iddokter=$row[karyawan_id]' > Up </a> |");
	else
	print("<td> ");

	if(strval($row['wl_priority']) <> $max and strval($row['wl_priority']) <> null)
		print(" <a href='waitinglist.php?down=$row[wl_id]&iddokter=$row[karyawan_id]' > Down </a></td>");
	else if(strval($row['wl_priority']) == null)
		print("");
	
	}
 
  }
  
  ?>
  
  
  <tr>  </tr>
</table>
<p align="left">&nbsp;</p>
<p class="style2">&nbsp;</p>
</td>
</tr>
</table>
</body>
</html>

