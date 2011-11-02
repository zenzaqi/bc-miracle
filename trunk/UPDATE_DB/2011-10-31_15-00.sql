/*Creat table Kategori Barang Keluar, table ini berfungsi untuk menyimpan master dari jenis2 kategori barang keluar.. Seperti "Promosi", "Franchise", "Barang Rusak", "DLL" */

CREATE TABLE `kategori_barang_keluar` (
`kbk_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`kbk_nama` VARCHAR( 250 ) NOT NULL ,
`kbk_keterangan` VARCHAR( 250 ) NOT NULL ,
`kbk_aktif` VARCHAR( 25 ) NOT NULL DEFAULT 'Aktif',
`kbk_creator` VARCHAR( 50 ) NOT NULL ,
`kbk_date_create` DATETIME NOT NULL ,
`kbk_update` VARCHAR( 50 ) NOT NULL ,
`kbk_date_update` DATETIME NOT NULL ,
`kbk__revised` INT( 11 ) NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE `master_mutasi` ADD `mutasi_kategori_barang_keluar` INT( 11 ) NULL AFTER `mutasi_barang_keluar` ;

CREATE OR REPLACE VIEW `vu_trans_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_no` AS `mutasi_no`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,if((`gudang_tujuan`.`gudang_nama` = 'Gudang Temporary'),' ',`gudang_tujuan`.`gudang_nama`) AS `gudang_asal_nama`,`gudang_tujuan`.`gudang_lokasi` AS `gudang_asal_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,if((`gudang_asal`.`gudang_nama` = 'Gudang Temporary'),' ',`gudang_asal`.`gudang_nama`) AS `gudang_tujuan_nama`,`gudang_asal`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_total_mutasi_group`.`jumlah_barang` AS `jumlah_barang`,`master_mutasi`.`mutasi_keterangan` AS `mutasi_keterangan`,`master_mutasi`.`mutasi_status` AS `mutasi_status`,`master_mutasi`.`mutasi_creator` AS `mutasi_creator`,`master_mutasi`.`mutasi_date_create` AS `mutasi_date_create`,`master_mutasi`.`mutasi_update` AS `mutasi_update`,`master_mutasi`.`mutasi_date_update` AS `mutasi_date_update`,`master_mutasi`.`mutasi_revised` AS `mutasi_revised`,`master_mutasi`.`mutasi_racikan` AS `mutasi_racikan`,`master_mutasi`.`mutasi_barang_keluar` AS `mutasi_barang_keluar`,`master_mutasi`.`mutasi_spb` AS `mutasi_spb`,`detail_mutasi_racikan`.`dmracikan_jenis` AS `dmracikan_jenis`,`master_mutasi`.`mutasi_status_terima` AS `mutasi_status_terima`,`master_mutasi`.`mutasi_kategori_barang_keluar` AS `mutasi_kategori_barang_keluar`,`kategori_barang_keluar`.`kbk_nama` AS `kbk_nama` from (((((`master_mutasi` join `gudang` `gudang_asal` on(((_utf8'' = _utf8'') and (`master_mutasi`.`mutasi_tujuan` = `gudang_asal`.`gudang_id`)))) join `gudang` `gudang_tujuan` on((`gudang_tujuan`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `vu_total_mutasi_group` on((`vu_total_mutasi_group`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) left join `detail_mutasi_racikan` on((`detail_mutasi_racikan`.`dmracikan_mutasi_id` = `master_mutasi`.`mutasi_id`))) left join `kategori_barang_keluar` on((`master_mutasi`.`mutasi_kategori_barang_keluar` = `kategori_barang_keluar`.`kbk_id`)));
