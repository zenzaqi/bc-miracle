-- menambahkan field Paket Standard Tetap di master paket

ALTER TABLE  `paket` ADD  `paket_standart_tetap` TINYINT( 1 ) NULL DEFAULT  '0' AFTER  `paket_nama`