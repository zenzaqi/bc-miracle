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
<title>Inbox List</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Inbox List'>
	<caption>Inbox List</caption>
	<thead><tr><th scope='col'>No</th><th scope='col'>Inbox Id</th><th scope='col'>Inbox Sender</th><th scope='col'>Inbox Message</th><th scope='col'>Inbox Date</th><th scope='col'>Inbox Creator</th><th scope='col'>Inbox Date Create</th><th scope='col'>Inbox Update</th><th scope='col'>Inbox Date Update</th><th scope='col'>Inbox Revised</th></tr></thead>
	<tfoot><tr><th scope='row'>Total</th><td colspan='9'><?php echo count($data_print); ?></td></tr></tfoot>
	<tbody>
		<?php $i=0; foreach($data_print as $print) { $i++; ?>
		<tr><td><? echo $i; ?></td><td><?php echo $print->inbox_id; ?></td><td><?php echo $print->inbox_sender; ?></td><td><?php echo $print->inbox_message; ?></td><td><?php echo $print->inbox_date; ?></td><td><?php echo $print->inbox_creator; ?></td><td><?php echo $print->inbox_date_create; ?></td><td><?php echo $print->inbox_update; ?></td><td><?php echo $print->inbox_date_update; ?></td><td><?php echo $print->inbox_revised; ?></td></tr>
		<?php } ?>
	</tbody>
<body>
</body>
</html>