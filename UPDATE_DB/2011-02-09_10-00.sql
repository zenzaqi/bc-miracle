/*Mengubah size keterangan di detail_ambill_paket menjadi lebih besar*/

ALTER TABLE `detail_ambil_paket` CHANGE `dapaket_keterangan` `dapaket_keterangan` VARCHAR( 250 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL 