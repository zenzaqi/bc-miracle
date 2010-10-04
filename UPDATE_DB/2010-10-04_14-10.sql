-- Menambahkan penanda racikan di table produk, utk membedakan apakah produk tsb termasuk produk racikan atau bukan

ALTER TABLE `produk` ADD `produk_racikan` TINYINT( 1 ) NULL DEFAULT '0' AFTER `produk_kategori`; 

/* Create Table produk_racikan */
CREATE TABLE `produk_racikan` (
`pracikan_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`pracikan_master` INT( 11 ) NOT NULL ,
`pracikan_produk` INT( 11 ) NOT NULL ,
`pracikan_satuan` INT( 11 ) NULL ,
`pracikan_jumlah` FLOAT NULL DEFAULT NULL ,
`pracikan_creator` VARCHAR( 50 ) NOT NULL ,
`pracikan_date_create` DATETIME NOT NULL ,
`pracikan_update` VARCHAR( 50 ) NOT NULL ,
`pracikan_date_update` DATETIME NOT NULL
) ENGINE = MYISAM ;

-- menambahkan produk_racikan di vu_produk

CREATE OR REPLACE VIEW `vu_produk` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_racikan` AS `produk_racikan`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_keterangan` AS `produk_keterangan`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_creator` AS `produk_creator`,`produk`.`produk_date_create` AS `produk_date_create`,`produk`.`produk_update` AS `produk_update`,`produk`.`produk_date_update` AS `produk_date_update`,`produk`.`produk_revised` AS `produk_revised`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_duproduk` AS `group_duproduk`,`produk_group`.`group_dmproduk` AS `group_dmproduk`,`produk_group`.`group_kelompok` AS `group_kelompok`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`jenis`.`jenis_id` AS `jenis_id`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`kategori2`.`kategori2_id` AS `kategori2_id`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis` from (((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)));


