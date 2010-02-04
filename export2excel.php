<?php header("Content-type: application/x-msdownload"); 
header("Content-Disposition: attachment; filename=appointment.xls"); 
echo "Tanggal Appointment	Jam Appointment	Perawatan	No Customer	Customer	Dokter Nikcname	Terapis Nickname	Status	Jam Datang	Keterangan Detail	
01/26/2010	11:00:00	CRYSTAL DIAMOND	MR003758	Mr. HENDRIK TJANDRA	dr. Fanny		datang	15:05:11
";?>