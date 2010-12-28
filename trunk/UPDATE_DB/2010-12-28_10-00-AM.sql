/* UPDATE VIEW DETAIL TERIMA BONUS */
CREATE OR REPLACE VIEW `vu_detail_terima_bonus`
AS
   SELECT `master_terima_beli`.`terima_no` AS `terima_no`,
          `master_terima_beli`.`terima_order` AS `terima_order`,
          `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `master_terima_beli`.`terima_supplier` AS `terima_supplier`,
          `master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,
          `master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,
          `master_terima_beli`.`terima_status` AS `terima_status`,
          `master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,
          `detail_terima_bonus`.`dtbonus_id` AS `dtbonus_id`,
          `detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,
          `detail_terima_bonus`.`dtbonus_produk` AS `dtbonus_produk`,
          `vu_produk`.`produk_kode` AS `produk_kode`,
          `vu_produk`.`produk_group` AS `produk_group`,
          `vu_produk`.`produk_nama` AS `produk_nama`,
          `vu_produk`.`group_nama` AS `group_nama`,
          `vu_produk`.`produk_volume` AS `produk_volume`,
          `vu_produk`.`kategori_nama` AS `kategori_nama`,
          `vu_produk`.`jenis_nama` AS `jenis_nama`,
          `vu_produk`.`kategori2_nama` AS `kategori2_nama`,
          `detail_terima_bonus`.`dtbonus_satuan` AS `dtbonus_satuan`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `detail_terima_bonus`.`dtbonus_jumlah` AS `dtbonus_jumlah`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `supplier`.`supplier_akun` AS `supplier_akun`,
          `vu_produk`.`produk_id` AS `produk_id`,
          `satuan`.`satuan_id` AS `satuan_id`
     FROM (   (   (   (   `detail_terima_bonus`
                       JOIN
                          `master_terima_beli`
                       ON ((`detail_terima_bonus`.`dtbonus_master` =
                               `master_terima_beli`.`terima_id`)))
                   JOIN
                      `supplier`
                   ON ((`master_terima_beli`.`terima_supplier` =
                           `supplier`.`supplier_id`)))
               JOIN
                  `vu_produk`
               ON ((`detail_terima_bonus`.`dtbonus_produk` =
                       `vu_produk`.`produk_id`)))
           JOIN
              `satuan`
           ON ((`detail_terima_bonus`.`dtbonus_satuan` = `satuan`.`satuan_id`)));

/*UPDATE VIEW DETAIL TERIMA PRODUK */
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

/* UPDATE VIEW TERIMA ALL */
CREATE OR REPLACE VIEW `vu_detail_terima_all`
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
     FROM `vu_detail_terima_produk`
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
     FROM `vu_detail_terima_bonus`;

/* UPDATE VIEW DETAIL TERIMA KONVERSI */
CREATE OR REPLACE VIEW `vu_detail_terima_konversi`
AS
   SELECT `vu_detail_terima_all`.`master` AS `master`,
          `vu_detail_terima_all`.`produk_id` AS `produk_id`,
          `vu_detail_terima_all`.`supplier_akun` AS `supplier_akun`,
          `vu_detail_terima_all`.`no_bukti` AS `no_bukti`,
          `vu_detail_terima_all`.`supplier_id` AS `supplier_id`,
          `vu_detail_terima_all`.`supplier_nama` AS `supplier_nama`,
          `vu_detail_terima_all`.`supplier_alamat` AS `supplier_alamat`,
          `vu_detail_terima_all`.`supplier_kota` AS `supplier_kota`,
          `vu_detail_terima_all`.`produk_kode` AS `produk_kode`,
          `vu_detail_terima_all`.`produk_nama` AS `produk_nama`,
          `vu_detail_terima_all`.`satuan_id` AS `satuan_id`,
          `vu_detail_terima_all`.`satuan_kode` AS `satuan_kode`,
          `vu_detail_terima_all`.`satuan_nama` AS `satuan_nama`,
          `vu_detail_terima_all`.`jumlah` AS `jumlah`,
          `vu_detail_terima_all`.`harga_satuan` AS `harga_satuan`,
          `vu_detail_terima_all`.`diskon` AS `diskon`,
          `vu_detail_terima_all`.`diskon_nilai` AS `diskon_nilai`,
          `vu_detail_terima_all`.`subtotal` AS `subtotal`,
          `vu_detail_terima_all`.`tanggal` AS `tanggal`,
          `vu_detail_terima_all`.`jenis` AS `jenis`,
          `satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,
          (`satuan_konversi`.`konversi_nilai`
           * `vu_detail_terima_all`.`jumlah`)
             AS `jumlah_konversi`
     FROM (   `satuan_konversi`
           JOIN
              `vu_detail_terima_all`
           ON (((`vu_detail_terima_all`.`produk_id` =
                    `satuan_konversi`.`konversi_produk`)
                AND (`vu_detail_terima_all`.`satuan_id` =
                        `satuan_konversi`.`konversi_satuan`))));

/* UPDATE VIEW TOTAL TERIMA GROUP */
CREATE OR REPLACE VIEW `vu_total_terima_group`
AS
   SELECT sum(`vu_detail_terima_produk`.`dterima_jumlah`) AS `jumlah_barang`,
          sum(
             (((`vu_detail_terima_produk`.`harga_satuan`
                * `vu_detail_terima_produk`.`dterima_jumlah`)
               * (100 - `vu_detail_terima_produk`.`diskon`))
              / 100))
             AS `total_nilai`,
          `vu_detail_terima_produk`.`dterima_master` AS `dterima_master`
     FROM `vu_detail_terima_produk`
   GROUP BY `vu_detail_terima_produk`.`dterima_master`;

/* UPDATE VIEW TOTAL TERIMA BONUS GROUP */
CREATE OR REPLACE VIEW `vu_total_terima_bonus_group`
AS
   SELECT `detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,
          sum(`detail_terima_bonus`.`dtbonus_jumlah`)
             AS `jumlah_barang_bonus`,
          0 AS `total_nilai`
     FROM `detail_terima_bonus`
   GROUP BY `detail_terima_bonus`.`dtbonus_master`;

/* UPDATE VIEW TOTAL TERIMA GROUP KONVERSI */
CREATE OR REPLACE VIEW `vu_total_terima_group_konversi`
AS
   SELECT `vu_detail_terima_konversi`.`master` AS `master`,
          sum(`vu_detail_terima_konversi`.`jumlah`) AS `jumlah_barang`,
          sum(`vu_detail_terima_konversi`.`subtotal`) AS `jumlah_nilai`,
          sum(`vu_detail_terima_konversi`.`konversi_nilai`)
             AS `jumlah_konversi`
     FROM `vu_detail_terima_konversi`
   GROUP BY `vu_detail_terima_konversi`.`master`;

/* UPDATE VIEW TRANS TERIMA BELI */
CREATE OR REPLACE VIEW `vu_trans_terima`
AS
   SELECT `master_terima_beli`.`terima_id` AS `terima_id`,
          `master_terima_beli`.`terima_no` AS `no_bukti`,
          `master_terima_beli`.`terima_order` AS `terima_order`,
          `master_order_beli`.`order_no` AS `order_no`,
          `master_order_beli`.`order_tanggal` AS `order_tanggal`,
          `master_order_beli`.`order_carabayar` AS `order_carabayar`,
          `master_order_beli`.`order_diskon` AS `order_diskon`,
          `master_order_beli`.`order_biaya` AS `order_biaya`,
          `master_order_beli`.`order_bayar` AS `order_bayar`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `supplier`.`supplier_akun` AS `supplier_akun`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `master_terima_beli`.`terima_supplier` AS `terima_supplier`,
          `master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,
          `master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,
          `master_terima_beli`.`terima_tanggal` AS `tanggal`,
          `master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,
          `master_terima_beli`.`terima_status` AS `terima_status`,
          `master_terima_beli`.`terima_creator` AS `terima_creator`,
          `master_terima_beli`.`terima_date_create` AS `terima_date_create`,
          `master_terima_beli`.`terima_update` AS `terima_update`,
          `master_terima_beli`.`terima_date_update` AS `terima_date_update`,
          `master_terima_beli`.`terima_revised` AS `terima_revised`,
          ifnull(`vu_total_terima_bonus_group`.`jumlah_barang_bonus`, 0)
             AS `jumlah_barang_bonus`,
          `vu_total_terima_group`.`jumlah_barang` AS `jumlah_barang`,
          `vu_total_terima_group`.`total_nilai` AS `total_nilai`
     FROM (   (   (   (   `master_terima_beli`
                       JOIN
                          `supplier`
                       ON ((`master_terima_beli`.`terima_supplier` =
                               `supplier`.`supplier_id`)))
                   JOIN
                      `master_order_beli`
                   ON ((`master_terima_beli`.`terima_order` =
                           `master_order_beli`.`order_id`)))
               LEFT JOIN
                  `vu_total_terima_bonus_group`
               ON ((`vu_total_terima_bonus_group`.`dtbonus_master` =
                       `master_terima_beli`.`terima_id`)))
           JOIN
              `vu_total_terima_group`
           ON ((`vu_total_terima_group`.`dterima_master` =
                   `master_terima_beli`.`terima_id`)));

/* UPDATE VIEW TRANS TERIMA KONVERSI */
CREATE OR REPLACE VIEW `vu_trans_terima_konversi`
AS
   SELECT `master_terima_beli`.`terima_id` AS `terima_id`,
          `master_terima_beli`.`terima_no` AS `terima_no`,
          `master_terima_beli`.`terima_order` AS `terima_order`,
          `master_terima_beli`.`terima_supplier` AS `terima_supplier`,
          `master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,
          `master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,
          `master_terima_beli`.`terima_status` AS `terima_status`,
          `master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,
          `master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,
          `master_terima_beli`.`terima_creator` AS `terima_creator`,
          `master_terima_beli`.`terima_date_create` AS `terima_date_create`,
          `master_terima_beli`.`terima_update` AS `terima_update`,
          `master_terima_beli`.`terima_date_update` AS `terima_date_update`,
          `master_terima_beli`.`terima_revised` AS `terima_revised`,
          `vu_total_terima_group_konversi`.`jumlah_barang` AS `jumlah_barang`,
          `vu_total_terima_group_konversi`.`jumlah_nilai` AS `jumlah_nilai`,
          `vu_total_terima_group_konversi`.`jumlah_konversi`
             AS `jumlah_konversi`,
          `master_order_beli`.`order_cashback` AS `order_cashback`,
          `master_order_beli`.`order_biaya` AS `order_biaya`,
          `master_order_beli`.`order_diskon` AS `order_diskon`,
          (`master_order_beli`.`order_cashback`
           / `vu_total_terima_group_konversi`.`jumlah_barang`)
             AS `potongan_satuan`,
          (`master_order_beli`.`order_biaya`
           / `vu_total_terima_group_konversi`.`jumlah_barang`)
             AS `biaya_satuan`,
          (((`vu_total_terima_group_konversi`.`jumlah_nilai`
             * `master_order_beli`.`order_diskon`)
            / 100)
           / `vu_total_terima_group_konversi`.`jumlah_barang`)
             AS `diskon_satuan`
     FROM (   (   `vu_total_terima_group_konversi`
               JOIN
                  `master_terima_beli`
               ON ((`vu_total_terima_group_konversi`.`master` =
                       `master_terima_beli`.`terima_id`)))
           JOIN
              `master_order_beli`
           ON ((`master_order_beli`.`order_id` =
                   `master_terima_beli`.`terima_order`)));
