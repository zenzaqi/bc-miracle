/* PERBAIKAN TABEL BUKU BESAR */
ALTER TABLE `buku_besar` ADD `buku_arsip` ENUM( 'Y', 'T' ) NOT NULL DEFAULT 'T' AFTER `buku_kredit` ;