-- field ini utk mencatat tanggal setiap proses Cetak pada Aktivasi Member

ALTER TABLE `member`  ADD COLUMN `member_tglcetak` DATE NULL AFTER `member_tglserahterima`;

update member set
	member_tglcetak = member_date_create;