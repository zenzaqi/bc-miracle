/*---------- VIEW PRODUK ---------------------*/

CREATE OR REPLACE VIEW `vu_produk`
AS
   SELECT `produk`.`produk_id` AS `produk_id`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_group` AS `produk_group`,
          `produk`.`produk_kategori` AS `produk_kategori`,
          `produk`.`produk_kontribusi` AS `produk_kontribusi`,
          `produk`.`produk_nama` AS `produk_nama`,
          `produk`.`produk_satuan` AS `produk_satuan`,
          `produk`.`produk_du` AS `produk_du`,
          `produk`.`produk_dm` AS `produk_dm`,
          `produk`.`produk_point` AS `produk_point`,
          `produk`.`produk_harga` AS `produk_harga`,
          `produk`.`produk_volume` AS `produk_volume`,
          `produk`.`produk_jenis` AS `produk_jenis`,
          `produk`.`produk_kodelama` AS `produk_kodelama`,
          `produk`.`produk_keterangan` AS `produk_keterangan`,
          `produk`.`produk_aktif` AS `produk_aktif`,
          `produk`.`produk_creator` AS `produk_creator`,
          `produk`.`produk_date_create` AS `produk_date_create`,
          `produk`.`produk_update` AS `produk_update`,
          `produk`.`produk_date_update` AS `produk_date_update`,
          `produk`.`produk_revised` AS `produk_revised`,
          `produk_group`.`group_id` AS `group_id`,
          `produk_group`.`group_kode` AS `group_kode`,
          `produk_group`.`group_nama` AS `group_nama`,
          `produk_group`.`group_duproduk` AS `group_duproduk`,
          `produk_group`.`group_dmproduk` AS `group_dmproduk`,
          `produk_group`.`group_kelompok` AS `group_kelompok`,
          `kategori`.`kategori_id` AS `kategori_id`,
          `kategori`.`kategori_nama` AS `kategori_nama`,
          `kategori`.`kategori_jenis` AS `kategori_jenis`,
          `kategori`.`kategori_akun` AS `kategori_akun`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `jenis`.`jenis_id` AS `jenis_id`,
          `jenis`.`jenis_kode` AS `jenis_kode`,
          `jenis`.`jenis_nama` AS `jenis_nama`,
          `jenis`.`jenis_kelompok` AS `jenis_kelompok`,
          `kategori2`.`kategori2_id` AS `kategori2_id`,
          `kategori2`.`kategori2_nama` AS `kategori2_nama`,
          `kategori2`.`kategori2_jenis` AS `kategori2_jenis`,
          `produk`.`produk_saldo_awal` AS `produk_saldo_awal`,
          `produk`.`produk_nilai_saldo_awal` AS `produk_nilai_saldo_awal`
     FROM (   (   (   (   (   `produk`
                           LEFT JOIN
                              `produk_group`
                           ON ((`produk`.`produk_group` =
                                   `produk_group`.`group_id`)))
                       LEFT JOIN
                          `kategori`
                       ON ((`produk_group`.`group_kelompok` =
                               `kategori`.`kategori_id`)))
                   LEFT JOIN
                      `satuan`
                   ON ((`produk`.`produk_satuan` = `satuan`.`satuan_id`)))
               LEFT JOIN
                  `jenis`
               ON ((`produk`.`produk_jenis` = `jenis`.`jenis_id`)))
           LEFT JOIN
              `kategori2`
           ON ((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)));

/*----------- VIEW DETAIL ORDER ------------------------------*/
CREATE OR REPLACE VIEW `vu_detail_order_beli`
AS
   SELECT `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `supplier`.`supplier_akun` AS `supplier_akun`,
          `master_order_beli`.`order_supplier` AS `order_supplier`,
          `master_order_beli`.`order_tanggal` AS `tanggal`,
          `master_order_beli`.`order_carabayar` AS `order_carabayar`,
          `master_order_beli`.`order_diskon` AS `order_diskon`,
          `master_order_beli`.`order_biaya` AS `order_biaya`,
          `master_order_beli`.`order_bayar` AS `order_bayar`,
          `master_order_beli`.`order_keterangan` AS `order_keterangan`,
          `detail_order_beli`.`dorder_id` AS `dorder_id`,
          `detail_order_beli`.`dorder_master` AS `dorder_master`,
          `detail_order_beli`.`dorder_produk` AS `dorder_produk`,
          `detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,
          `detail_order_beli`.`dorder_jumlah` AS `jumlah_barang`,
          `detail_order_beli`.`dorder_harga` AS `harga_satuan`,
          `detail_order_beli`.`dorder_diskon` AS `diskon`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `vu_produk`.`produk_kode` AS `produk_kode`,
          `vu_produk`.`produk_group` AS `produk_group`,
          `vu_produk`.`produk_kategori` AS `produk_kategori`,
          `vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,
          `vu_produk`.`produk_nama` AS `produk_nama`,
          `vu_produk`.`produk_satuan` AS `produk_satuan`,
          `vu_produk`.`produk_volume` AS `produk_volume`,
          `vu_produk`.`produk_jenis` AS `produk_jenis`,
          `vu_produk`.`produk_kodelama` AS `produk_kodelama`,
          `vu_produk`.`group_nama` AS `group_nama`,
          `vu_produk`.`kategori_nama` AS `kategori_nama`,
          `vu_produk`.`kategori_jenis` AS `kategori_jenis`,
          `vu_produk`.`jenis_nama` AS `jenis_nama`,
          `vu_produk`.`jenis_kelompok` AS `jenis_kelompok`,
          `vu_produk`.`kategori2_nama` AS `kategori2_nama`,
          ((`detail_order_beli`.`dorder_jumlah`
            * `detail_order_beli`.`dorder_diskon`)
           * `detail_order_beli`.`dorder_harga`)
             AS `diskon_nilai`,
          ((`detail_order_beli`.`dorder_jumlah`
            * `detail_order_beli`.`dorder_harga`)
           * (100 - `detail_order_beli`.`dorder_diskon`))
             AS `subtotal`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `master_order_beli`.`order_no` AS `no_bukti`,
          ifnull(`vu_detail_terima_order`.`jumlah_terima`, 0)
             AS `jumlah_terima`,
          ifnull(`vu_detail_terima_order`.`jumlah_sisa`, 0) AS `jumlah_sisa`,
          `master_order_beli`.`order_status` AS `order_status`
     FROM (   (   (   (   (   `detail_order_beli`
                           JOIN
                              `master_order_beli`
                           ON ((`detail_order_beli`.`dorder_master` =
                                   `master_order_beli`.`order_id`)))
                       JOIN
                          `supplier`
                       ON ((`master_order_beli`.`order_supplier` =
                               `supplier`.`supplier_id`)))
                   JOIN
                      `satuan`
                   ON ((`detail_order_beli`.`dorder_satuan` =
                           `satuan`.`satuan_id`)))
               JOIN
                  `vu_produk`
               ON ((`detail_order_beli`.`dorder_produk` =
                       `vu_produk`.`produk_id`)))
           JOIN
              `vu_detail_terima_order`
           ON (((`detail_order_beli`.`dorder_produk` =
                    `vu_detail_terima_order`.`produk`)
                AND (`detail_order_beli`.`dorder_master` =
                        `vu_detail_terima_order`.`master_order`)
                AND (`detail_order_beli`.`dorder_satuan` =
                        `vu_detail_terima_order`.`satuan`))));

/*------------- MASTER AKUN ----------------------*/

CREATE TABLE IF NOT EXISTS `akun` (
  `akun_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `akun_parent_kode` varchar(50) DEFAULT NULL,
  `akun_kode` varchar(50) DEFAULT NULL,
  `akun_jenis` varchar(255) DEFAULT NULL,
  `akun_parent` smallint(6) DEFAULT NULL,
  `akun_level` smallint(6) DEFAULT NULL,
  `akun_nama` varchar(255) NOT NULL,
  `akun_debet` double DEFAULT NULL,
  `akun_kredit` double DEFAULT NULL,
  `akun_saldo` enum('Debet','Kredit') DEFAULT NULL,
  `akun_aktif` enum('T','Y') DEFAULT 'Y',
  `akun_creator` varchar(50) DEFAULT NULL,
  `akun_date_create` datetime DEFAULT NULL,
  `akun_update` varchar(50) DEFAULT NULL,
  `akun_date_update` datetime DEFAULT NULL,
  `akun_revised` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`akun_id`),
  KEY `kode_akun` (`akun_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
