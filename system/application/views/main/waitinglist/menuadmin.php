<?
session_start();
?>
<? 

if(!isset($_SESSION["namauser"])||$_SESSION["tipeuser"]=="USER")
{die("<a href='admin.php' >You must Login first</a>");
exit();
}

?>

<link rel="stylesheet" type="text/css" href="ddsmoothmenu.css" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="ddsmoothmenu.js">

</script>

<link href="style.css" rel="stylesheet" type="text/css" />

  <table align="center" >
    <tr>
      <td width="1031"  align="center"><span class="topcaption">Menu Fantasy Futsal </span></td>
    </tr>
    <?
	if(isset($errmsgmn))
	{
	 ?>
     <div class="errmsg" id="errmsg" align="center" ><? print(base64_decode($errmsgmn)); ?></div>
     <?
	 }
	 if(isset($successmsgmn))
	{
	 ?>
    <div class="successmsg" align="center" ><? print(base64_decode($successmsgmn)); ?></div>
      <?
	 }
	 ?>
    
    <tr>
      <td> Login as <? print($_SESSION["namauser"]." (".$_SESSION["tipeuser"].")"); ?> <a href="index.php">Back</a>
      
      
      <div id="smoothmenu1" class="ddsmoothmenu">
<ul>
<li><a href="#" style="border-left: 1px solid black">User</a>
 <ul>
              
                    <li><a href="manageuser.php">Manage User</a></li>
                    <ul>
                      </ul>
                    </li>
                  </ul>
</li>
 
        <li><a href="#" >Jadwal Lapangan</a>
                  <ul>
				<li><a href="managejadwal.php">Manage Booking</a></li>
                  </ul>
          </li>
		  
              <li><a href="laporan.php" >Lihat Laporan</a>
             
              </li>
                   <li><a href="editnews.php">Manage News</a>
                  <ul>
                  </ul>
              </li>
                 <li><a href="#" >Championship</a>
                  <ul>
      <li><a href="manageturnamen.php">Manage Turnamen</a></li>
                  </ul>
              </li>
			 <li><a href="managesparing.php" >Manage Sparing</a>
                  <ul>
                  </ul>
          </li>  

              <li><a href="manageadvertising.php" >Edit Advertising</a>
                  <ul>
                  </ul>
              </li>
              <li><a href="#" >Setting</a>
              <ul>
                <li><a href="editadmin.php">Edit Account</a></li>
             <li><a href="editexp.php">Edit Expired</a></li>
               </ul>
              </li>
              <li><a href="logout.php">Logout</a></li>
</ul>
<br style="clear: left" />
</div>

      </td>
    </tr>
  </table>