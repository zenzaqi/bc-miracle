/*Menambah Field mb_days ke tabel transaksi_setting, field ini akan digunakan utk settingan penguncian dokumen utk modul Mutasi Barang */
ALTER TABLE `transaksi_setting` ADD `mb_days` INT( 11 ) NULL ;
UPDATE `transaksi_setting` SET `mb_days` = '1' WHERE `transaksi_setting`.`trans_op_days` = '60' AND `transaksi_setting`.`trans_author` IS NULL AND `transaksi_setting`.`trans_date_create` IS NULL AND `transaksi_setting`.`trans_update` = 'freddy' AND `transaksi_setting`.`trans_date_update` = '2011-06-23 11:44:51' AND `transaksi_setting`.`trans_revised` =2 AND `transaksi_setting`.`mb_days` IS NULL LIMIT 1 ;