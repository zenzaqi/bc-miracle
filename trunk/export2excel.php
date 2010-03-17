<?php header("Content-type: application/x-msdownload"); 
header("Content-Disposition: attachment; filename=master_invoice.xls"); 
echo "Tanggal	No Tagihan	No Penerimaan	Supplier	Jumlah Item	Sub Total	Diskon (%)	Diskon (Rp)	Biaya	Total Nilai	Uang Muka	Sisa Tagihan	Jatuh Tempo	
03/16/2010	INV/10/03/0001	LPB/10/03/0001	CV. Jawa Jamu	19	751600	5	1000	5000	718020	500000	218020	03/16/2010
";?>