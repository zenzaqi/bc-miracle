ALTER TABLE `detail_ambil_paket`  CHANGE COLUMN `dapaket_stat_dok` `dapaket_stat_dok` ENUM('Terbuka','Tertutup','Batal','Adj','Retur') NOT NULL DEFAULT 'Terbuka' AFTER `dapaket_dtrawat`$$
