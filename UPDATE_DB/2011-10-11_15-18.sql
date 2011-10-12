ALTER TABLE `detail_ambil_paket`  CHANGE COLUMN `dapaket_stat_dok` `dapaket_stat_dok` ENUM('Terbuka','Tertutup','Batal','Adj','Retur') NOT NULL DEFAULT 'Terbuka' AFTER `dapaket_dtrawat`;

update detail_ambil_paket set dapaket_stat_dok = 'Retur' where dapaket_stat_dok = 'Tertutup' and dapaket_keterangan = 'retur' and dapaket_tgl_ambil >= '2011-10-01';
