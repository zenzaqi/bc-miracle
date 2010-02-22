<?
$connstr="localhost";
$userdb="root";
$userpass="";
$conn=mysql_connect($connstr,$userdb,$userpass) or die("can't connect database");
mysql_select_db("miracledb",$conn);
?>