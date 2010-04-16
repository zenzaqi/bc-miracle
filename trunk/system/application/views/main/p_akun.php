<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tbl_m_akun Print
	+ Description	: For Print View
	+ Filename 		: p_tbl_m_akun.php
 	+ Author  		: Zainal, Anam
 	+ Created on 12/Mar/2010 10:42:59
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tbl M Akun List</title>
<link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/>
</head>
<table summary='Tbl M Akun List'>
	<caption>Tbl M Akun List</caption>
	<thead><tr><th scope='col'>No</th><th scope='col'>Akun Id</th><th scope='col'>Akun Kode</th><th scope='col'>Akun Jenis</th><th scope='col'>Akun Parent</th><th scope='col'>Akun Level</th><th scope='col'>Akun Nama</th><th scope='col'>Akun Debet</th><th scope='col'>Akun Kredit</th><th scope='col'>Akun Saldo</th><th scope='col'>Akun Aktif</th><th scope='col'>Akun Creator</th><th scope='col'>Akun Date Create</th><th scope='col'>Akun Update</th><th scope='col'>Akun Date Update</th><th scope='col'>Akun Revised</th></tr></thead>
	<tfoot><tr><th scope='row'>Total</th><td colspan='15'><?php echo count($data_print); ?></td></tr></tfoot>
	<tbody>
		<?php $i=0; foreach($data_print as $print) { $i++; ?>
		<tr><td><? echo $i; ?></td><td><?php echo $print->akun_id; ?></td><td><?php echo $print->akun_kode; ?></td><td><?php echo $print->akun_jenis; ?></td><td><?php echo $print->akun_parent; ?></td><td><?php echo $print->akun_level; ?></td><td><?php echo $print->akun_nama; ?></td><td><?php echo $print->akun_debet; ?></td><td><?php echo $print->akun_kredit; ?></td><td><?php echo $print->akun_saldo; ?></td><td><?php echo $print->akun_aktif; ?></td><td><?php echo $print->akun_creator; ?></td><td><?php echo $print->akun_date_create; ?></td><td><?php echo $print->akun_update; ?></td><td><?php echo $print->akun_date_update; ?></td><td><?php echo $print->akun_revised; ?></td></tr>
		<?php } ?>
	</tbody>
<body>
</body>
</html>