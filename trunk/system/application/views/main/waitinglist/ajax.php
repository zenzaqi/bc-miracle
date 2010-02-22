<?
include("db.php");
if(isset($_POST['checkharga']))
{


$querysearch=mysql_query("select * from mastersesi where hari=".$_POST['hari']." and lapangan=".$_POST['lapangan']." and awalmain>='".$_POST['jam'].":00' and akhirmain<='".(strval($_POST["jam"])+strval($_POST["durasi"])).":00' order by awalmain,akhirmain");
$totharga=0;
			while($arrsesi=mysql_fetch_array($querysearch))
			{
			//$query=mysql_query("insert into detail_book values(".$lastidbook[0].",".$arrsesi['id_sesi'].",0)");
			$totharga+=strval($arrsesi['harga']);
			}
			echo $totharga;
			

}

if(isset($_POST['getjadwal']))
{
$echotable="<p>Lapangan ".$_POST['lapangan']."<br>Jadwal tgl ".date("d-M-Y",strtotime($_POST['tgl']))."</p><table width='200' border='1'><tr><td>Waktu</td><td>Status</td></tr>";

$query=mysql_query("select * from tbooking where tgl_book='".date("Y-m-d",strtotime($_POST['tgl']))."' and lapangan=".$_POST['lapangan']." and (((exp>='".date("Y-m-d H:i")."' or exp=null) and status_lunas=0) or status_lunas=1) order by jamawal,jamakhir");
$jamsblm="";

if(mysql_num_rows($query)>0){
		while($arrjadwal=mysql_fetch_array($query))
		{
	$jamnow=date("H:i",strtotime($arrjadwal['jamawal']))."-".date("H:i",strtotime($arrjadwal['jamakhir']));
		if($jamsblm!=$jamnow)
		{
		$jamsblm=$jamnow;
             
			$echotable.="<tr>";
                $echotable.="<td>".date("H:i",strtotime($arrjadwal['jamawal']))."-".date("H:i",strtotime($arrjadwal['jamakhir']))."</td>";
				
                $echotable.="<td>";
				if($arrjadwal['status_lunas']==0)
				{
				$echotable.="<a href=\"#\"   onclick=\"viewwaiting('".$arrjadwal['id_book']."')\">";
				}
				$echotable.=$arrjadwal['nama_pemesan'];
				
				 if($arrjadwal['status_lunas']==0) 
				  $echotable.="[Book]</a>";
				  
				  elseif($arrjadwal['status_lunas']==1) 
				   $echotable.="[Reserved]";

				$echotable.="</td>";
			 $echotable.=" </tr>";
			 }
		
		}
		}
		else
		$echotable.="<tr><td colspan=2 align='center'>Tidak ada pemesanan</td></tr>";
	$echotable.="  </table>";
        echo $echotable;
        
        
}
?>