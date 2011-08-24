
/*Field2 di tabel master_mutasi yang dibutuhkan utk keperluan modul Mutasi Barang Racikan */
ALTER TABLE `gudang` ADD `gudang_kode` VARCHAR( 20 ) NOT NULL AFTER `gudang_nama`;
ALTER TABLE `master_mutasi` ADD `mutasi_spb` VARCHAR( 50 ) NOT NULL AFTER `mutasi_no`;
ALTER TABLE `master_mutasi` ADD `mutasi_barang_keluar` TINYINT( 1 ) NULL DEFAULT '0' AFTER `mutasi_spb`;
ALTER TABLE `master_mutasi` ADD `mutasi_racikan` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `mutasi_barang_keluar`;

/*Create Tabel detail_mutasi_racikan */
CREATE TABLE `detail_mutasi_racikan` (
`dmracikan_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`dmracikan_mutasi_id` INT( 11 ) NOT NULL ,
`dmracikan_jenis` TINYINT( 1 ) NOT NULL ,
`dmracikan_produk` INT( 11 ) NOT NULL ,
`dmracikan_jumlah` INT( 11 ) NOT NULL ,
`dmracikan_satuan` INT( 11 ) NOT NULL ,
`dmracikan_noref` INT( 11 ) NOT NULL ,
`dmracikan_creator` VARCHAR( 50 ) NOT NULL ,
`dmracikan_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`dmracikan_update` VARCHAR( 50 ) NOT NULL ,
`dmracikan_date_update` DATETIME NOT NULL
) ENGINE = MYISAM ;

/*Penambahan dan perubahan pada tabel detail_mutasi_racikan */
ALTER TABLE `detail_mutasi_racikan` CHANGE `dmracikan_mutasi_id` `dmracikan_mutasi_id` INT( 11 ) NOT NULL COMMENT 'menyimpan primary key dari tabel master_mutasi',
CHANGE `dmracikan_jenis` `dmracikan_jenis` TINYINT( 1 ) NOT NULL COMMENT 'Keluar = 0 , Masuk = 1',
CHANGE `dmracikan_noref` `dmracikan_noref` INT( 11 ) NOT NULL COMMENT 'akan menyimpan primary key dari detail_mutasi_racikan jika dmracikan_jenis = 1';

/*Menambahan id gudang 99 ke tabel gudang, utk keperluan program/sistem yang dipakai di vu_trans_mutasi (utk menampilkan datanya, karena menggunakan JOIN id (id ga boleh kosong, sehingga dibuatlah id ini) */
INSERT INTO `gudang` (`gudang_id`, `gudang_nama`, `gudang_lokasi`, `gudang_keterangan`, `gudang_aktif`) VALUES ('99', 'Gudang Temporary', 'Temporary', 'Gudang utk keperluan Sistem', 'Aktif');

/*View vu_trans_mutasi utk keperluan Master Mutasi Racikan */
CREATE OR REPLACE VIEW `vu_trans_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_no` AS `mutasi_no`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`gudang_tujuan`.`gudang_nama` AS `gudang_asal_nama`,`gudang_tujuan`.`gudang_lokasi` AS `gudang_asal_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`gudang_asal`.`gudang_nama` AS `gudang_tujuan_nama`,`gudang_asal`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_total_mutasi_group`.`jumlah_barang` AS `jumlah_barang`,`master_mutasi`.`mutasi_keterangan` AS `mutasi_keterangan`,`master_mutasi`.`mutasi_status` AS `mutasi_status`,`master_mutasi`.`mutasi_creator` AS `mutasi_creator`,`master_mutasi`.`mutasi_date_create` AS `mutasi_date_create`,`master_mutasi`.`mutasi_update` AS `mutasi_update`,`master_mutasi`.`mutasi_date_update` AS `mutasi_date_update`,`master_mutasi`.`mutasi_revised` AS `mutasi_revised`,`master_mutasi`.`mutasi_racikan` AS `mutasi_racikan`,`master_mutasi`.`mutasi_barang_keluar` AS `mutasi_barang_keluar`,`master_mutasi`.`mutasi_spb` AS `mutasi_spb`,`detail_mutasi_racikan`.`dmracikan_jenis` AS `dmracikan_jenis` from ((((`master_mutasi` join `gudang` `gudang_asal` on(((_utf8'' = _utf8'') and (`master_mutasi`.`mutasi_tujuan` = `gudang_asal`.`gudang_id`)))) join `gudang` `gudang_tujuan` on((`gudang_tujuan`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `vu_total_mutasi_group` on((`vu_total_mutasi_group`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) left join `detail_mutasi_racikan` on((`detail_mutasi_racikan`.`dmracikan_mutasi_id` = `master_mutasi`.`mutasi_id`)));