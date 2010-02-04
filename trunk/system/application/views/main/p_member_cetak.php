<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: inbox Print
	+ Description	: For Print View
	+ Filename 		: p_inbox.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kartu Member Cetak</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Inbox List'>
	<caption>Kartu Member Cetak</caption>
	<thead><tr><th scope='col'>No</th><th scope='col'>Nama Member</th><th scope='col'>Nomor Member</th><th scope='col'>Register</th><th scope='col'>Valid</th><th scope='col'>Jenis</th></tr></thead>
	<tfoot><tr><th scope='row'>Total</th><td colspan='5'><?php echo count($data_print); ?></td></tr></tfoot>
	<tbody>
		<?php $i=0; foreach($data_print as $print) { $i++; ?>
		<tr><td><? echo $i; ?></td><td><?php echo $print->member_nama; ?></td><td><?php echo $print->member_no ?></td><td><?php echo $print->member_register; ?></td><td><?php echo $print->member_valid; ?></td><td><?php echo $print->member_jenis; ?></td></tr>
		<?php } ?>
	</tbody>
<body>
</body>
</html>