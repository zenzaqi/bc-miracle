/*---------- REPLACE VIEW DETAIL TERIMA PRODUK ---------------------*/

CREATE OR REPLACE VIEW `vu_detail_terima_produk`
AS
   SELECT DISTINCT
          `master_terima_beli`.`terima_order` AS `terima_order`,
          `master_terima_beli`.`terima_supplier` AS `terima_supplier`,
          `master_terima_beli`.`terima_status` AS `terima_status`,
          `master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,
          `master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,
          `master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,
          `detail_terima_beli`.`dterima_master` AS `dterima_master`,
          `detail_terima_beli`.`dterima_produk` AS `dterima_produk`,
          `vu_produk`.`produk_kode` AS `produk_kode`,
          `vu_produk`.`produk_nama` AS `produk_nama`,
          `vu_produk`.`group_nama` AS `group_nama`,
          `vu_produk`.`jenis_nama` AS `jenis_nama`,
          `vu_produk`.`kategori2_nama` AS `kategori2_nama`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah`,
          `detail_terima_beli`.`dterima_id` AS `dterima_id`,
          `detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `master_terima_beli`.`terima_no` AS `terima_no`,
          `supplier`.`supplier_akun` AS `supplier_akun`,
          `vu_produk`.`produk_id` AS `produk_id`,
          ifnull(`detail_order_beli`.`dorder_jumlah`, 0) AS `jumlah_order`,
          ifnull(`detail_order_beli`.`dorder_harga`, 0) AS `harga_satuan`,
          ifnull(`detail_order_beli`.`dorder_diskon`, 0) AS `diskon`,
          ifnull(
             (`detail_order_beli`.`dorder_harga`
              * `detail_terima_beli`.`dterima_jumlah`),
             0)
             AS `total_nilai`,
          ifnull(
             (((`detail_order_beli`.`dorder_harga`
                * `detail_order_beli`.`dorder_diskon`)
               * `detail_terima_beli`.`dterima_jumlah`)
              / 100),
             0)
             AS `diskon_nilai`,
          ifnull(
             (((`detail_order_beli`.`dorder_harga`
                * `detail_terima_beli`.`dterima_jumlah`)
               * (100 - `detail_order_beli`.`dorder_diskon`))
              / 100),
             0)
             AS `subtotal`,
          `supplier`.`supplier_kategori` AS `supplier_kategori`,
          `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `vu_produk`.`produk_volume` AS `produk_volume`
     FROM (   (   (   (   (   (   `detail_terima_beli`
                               JOIN
                                  `master_terima_beli`
                               ON ((`detail_terima_beli`.`dterima_master` =
                                       `master_terima_beli`.`terima_id`)))
                           JOIN
                              `vu_produk`
                           ON ((`vu_produk`.`produk_id` =
                                   `detail_terima_beli`.`dterima_produk`)))
                       JOIN
                          `satuan`
                       ON ((`detail_terima_beli`.`dterima_satuan` =
                               `satuan`.`satuan_id`)))
                   LEFT JOIN
                      `master_order_beli`
                   ON ((`master_terima_beli`.`terima_order` =
                           `master_order_beli`.`order_id`)))
               LEFT JOIN
                  `detail_order_beli`
               ON (((`detail_order_beli`.`dorder_master` =
                        `master_order_beli`.`order_id`)
                    AND (`detail_order_beli`.`dorder_produk` =
                            `detail_terima_beli`.`dterima_produk`))))
           JOIN
              `supplier`
           ON ((`master_terima_beli`.`terima_supplier` =
                   `supplier`.`supplier_id`)));



/*------------ REPLACE VIEW DETAIl TERIMA ORDER ---------------------*/

CREATE OR REPLACE VIEW `vu_detail_terima_order`
AS
   SELECT `mo`.`order_id` AS `master_order`,
          `mt`.`terima_id` AS `master_terima`,
          `do`.`dorder_produk` AS `produk`,
          `do`.`dorder_satuan` AS `satuan`,
          `do`.`dorder_jumlah` AS `jumlah_order`,
          `dt`.`dterima_jumlah` AS `jumlah_terima`,
          (`do`.`dorder_jumlah` - `dt`.`dterima_jumlah`) AS `jumlah_sisa`,
          `do`.`dorder_harga` AS `harga`,
          `do`.`dorder_diskon` AS `diskon`
     FROM (   (   (   `detail_order_beli` `do`
                   JOIN
                      `master_order_beli` `mo`)
               JOIN
                  `detail_terima_beli` `dt`)
           JOIN
              `master_terima_beli` `mt`)
    WHERE (    (`do`.`dorder_master` = `mo`.`order_id`)
           AND (`dt`.`dterima_master` = `mt`.`terima_id`)
           AND (`mt`.`terima_order` = `mo`.`order_id`)
           AND (`do`.`dorder_produk` = `dt`.`dterima_produk`)
           AND (`do`.`dorder_satuan` = `dt`.`dterima_satuan`))
   UNION
   SELECT `mo`.`order_id` AS `master_order`,
          0 AS `master_terima`,
          `do`.`dorder_produk` AS `produk`,
          `do`.`dorder_satuan` AS `satuan`,
          `do`.`dorder_jumlah` AS `jumlah_order`,
          0 AS `jumlah_terima`,
          `do`.`dorder_jumlah` AS `jumlah_sisa`,
          `do`.`dorder_harga` AS `harga`,
          `do`.`dorder_diskon` AS `diskon`
     FROM (   `detail_order_beli` `do`
           JOIN
              `master_order_beli` `mo`)
    WHERE ((`do`.`dorder_master` = `mo`.`order_id`)
           AND (NOT ((`do`.`dorder_produk`, `do`.`dorder_satuan`) IN
                        (SELECT `dt`.`dterima_produk` AS `dterima_produk`,
                                `dt`.`dterima_satuan` AS `dterima_satuan`
                           FROM (   `detail_terima_beli` `dt`
                                 JOIN
                                    `master_terima_beli` `mt`)
                          WHERE ((`mt`.`terima_id` = `dt`.`dterima_master`)
                                 AND (`mt`.`terima_order` = `mo`.`order_id`))))))
   UNION
   SELECT 0 AS `master_order`,
          `mt`.`terima_id` AS `master_terima`,
          `dt`.`dterima_produk` AS `produk`,
          `dt`.`dterima_satuan` AS `satuan`,
          0 AS `jumlah_order`,
          `dt`.`dterima_jumlah` AS `jumlah_terima`,
          -(`dt`.`dterima_jumlah`) AS `jumlah_sisa`,
          0 AS `harga`,
          0 AS `diskon`
     FROM (   `detail_terima_beli` `dt`
           JOIN
              `master_terima_beli` `mt`)
    WHERE ((`mt`.`terima_id` = `dt`.`dterima_master`)
           AND (NOT ((`dt`.`dterima_produk`, `dt`.`dterima_satuan`) IN
                        (SELECT `do`.`dorder_produk` AS `dorder_produk`,
                                `do`.`dorder_satuan` AS `dorder_satuan`
                           FROM (   `master_order_beli` `mo`
                                 JOIN
                                    `detail_order_beli` `do`)
                          WHERE ((`mo`.`order_id` = `do`.`dorder_master`)
                                 AND (`mo`.`order_id` = `mt`.`terima_order`))))));

/*-------------------- REPLACE VIEW DETAIL TERIMA ALL --------- */

CREATE OR REPLACE VIEW `miracledb`.`vu_detail_terima_all`
AS
   SELECT `vu_detail_terima_produk`.`dterima_master` AS `master`,
          `vu_detail_terima_produk`.`produk_id` AS `produk_id`,
          `vu_detail_terima_produk`.`supplier_akun` AS `supplier_akun`,
          `vu_detail_terima_produk`.`terima_no` AS `no_bukti`,
          `vu_detail_terima_produk`.`supplier_id` AS `supplier_id`,
          `vu_detail_terima_produk`.`supplier_nama` AS `supplier_nama`,
          `vu_detail_terima_produk`.`supplier_alamat` AS `supplier_alamat`,
          `vu_detail_terima_produk`.`supplier_kota` AS `supplier_kota`,
          `vu_detail_terima_produk`.`produk_kode` AS `produk_kode`,
          `vu_detail_terima_produk`.`produk_nama` AS `produk_nama`,
          `vu_detail_terima_produk`.`satuan_id` AS `satuan_id`,
          `vu_detail_terima_produk`.`satuan_kode` AS `satuan_kode`,
          `vu_detail_terima_produk`.`produk_volume` AS `produk_volume`,
          `vu_detail_terima_produk`.`satuan_nama` AS `satuan_nama`,
          `vu_detail_terima_produk`.`dterima_jumlah` AS `jumlah`,
          `vu_detail_terima_produk`.`harga_satuan` AS `harga_satuan`,
          `vu_detail_terima_produk`.`diskon` AS `diskon`,
          `vu_detail_terima_produk`.`diskon_nilai` AS `diskon_nilai`,
          `vu_detail_terima_produk`.`subtotal` AS `subtotal`,
          `vu_detail_terima_produk`.`terima_tanggal` AS `tanggal`,
          _UTF8 'produk' AS `jenis`,
          `vu_detail_terima_produk`.`terima_surat_jalan`
             AS `terima_surat_jalan`,
          `vu_detail_terima_produk`.`terima_status` AS `terima_status`
     FROM `miracledb`.`vu_detail_terima_produk`
   UNION
   SELECT `vu_detail_terima_bonus`.`dtbonus_master` AS `master`,
          `vu_detail_terima_bonus`.`produk_id` AS `produk_id`,
          `vu_detail_terima_bonus`.`supplier_akun` AS `supplier_akun`,
          `vu_detail_terima_bonus`.`terima_no` AS `no_bukti`,
          `vu_detail_terima_bonus`.`supplier_id` AS `supplier_id`,
          `vu_detail_terima_bonus`.`supplier_nama` AS `supplier_nama`,
          `vu_detail_terima_bonus`.`supplier_alamat` AS `supplier_alamat`,
          `vu_detail_terima_bonus`.`supplier_kota` AS `supplier_kota`,
          `vu_detail_terima_bonus`.`produk_kode` AS `produk_kode`,
          `vu_detail_terima_bonus`.`produk_nama` AS `produk_nama`,
          `vu_detail_terima_bonus`.`satuan_id` AS `satuan_id`,
          `vu_detail_terima_bonus`.`satuan_kode` AS `satuan_kode`,
          `vu_detail_terima_bonus`.`produk_volume` AS `produk_volume`,
          `vu_detail_terima_bonus`.`satuan_nama` AS `satuan_nama`,
          `vu_detail_terima_bonus`.`dtbonus_jumlah` AS `jumlah`,
          0 AS `harga_satuan`,
          0 AS `diskon`,
          0 AS `diskon_nilai`,
          0 AS `subtotal`,
          `vu_detail_terima_bonus`.`terima_tanggal` AS `tanggal`,
          _UTF8 'bonus' AS `jenis`,
          `vu_detail_terima_bonus`.`terima_surat_jalan`
             AS `terima_surat_jalan`,
          `vu_detail_terima_bonus`.`terima_status` AS `terima_status`
     FROM `miracledb`.`vu_detail_terima_bonus`;
