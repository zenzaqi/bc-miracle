CREATE OR REPLACE VIEW `vu_total_retur_jual_produk_group`
AS
   SELECT ifnull(sum(`detail_retur_jual_produk`.`drproduk_jumlah`), 0)
             AS `jumlah_barang`,
          ifnull(
             sum(
                (((`detail_retur_jual_produk`.`drproduk_harga`
                   * `detail_retur_jual_produk`.`drproduk_jumlah`)
                  * (100
                     - ifnull(`detail_retur_jual_produk`.`drproduk_diskon`,
                              0)))
                 / 100)),
             0)
             AS `total_nilai`,
          `detail_retur_jual_produk`.`drproduk_master` AS `drproduk_master`
     FROM `detail_retur_jual_produk`
   GROUP BY `detail_retur_jual_produk`.`drproduk_master`;


CREATE OR REPLACE VIEW `vu_detail_retur_jual_produk`
AS
   SELECT `detail_retur_jual_produk`.`drproduk_id` AS `drproduk_id`,
          `detail_retur_jual_produk`.`drproduk_master` AS `drproduk_master`,
          `detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,
          `detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,
          `detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,
          `detail_retur_jual_produk`.`drproduk_jumlah` AS `jumlah_barang`,
          `detail_retur_jual_produk`.`drproduk_harga` AS `drproduk_harga`,
          `detail_retur_jual_produk`.`drproduk_harga` AS `harga_satuan`,
          `detail_retur_jual_produk`.`drproduk_diskon` AS `diskon`,
          ((ifnull(`detail_retur_jual_produk`.`drproduk_diskon`, 0)
            * `detail_retur_jual_produk`.`drproduk_harga`)
           / 100)
             AS `diskon_nilai`,
          `detail_retur_jual_produk`.`drproduk_diskon_jenis`
             AS `diskon_jenis`,
          ((((100 - ifnull(`detail_retur_jual_produk`.`drproduk_diskon`, 0))
             * ifnull(`detail_retur_jual_produk`.`drproduk_harga`, 0))
            * `detail_retur_jual_produk`.`drproduk_jumlah`)
           / 100)
             AS `subtotal`,
          `master_retur_jual_produk`.`rproduk_nobukti` AS `rproduk_nobukti`,
          `master_retur_jual_produk`.`rproduk_nobukti` AS `no_bukti`,
          `master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,
          `master_retur_jual_produk`.`rproduk_tanggal` AS `tanggal`,
          `master_retur_jual_produk`.`rproduk_id` AS `rproduk_id`,
          `master_retur_jual_produk`.`rproduk_nobuktijual`
             AS `rproduk_nobuktijual`,
          `master_retur_jual_produk`.`rproduk_stat_dok` AS `rproduk_stat_dok`,
          `master_retur_jual_produk`.`rproduk_cust` AS `rproduk_cust`,
          `master_retur_jual_produk`.`rproduk_keterangan`
             AS `rproduk_keterangan`,
          `master_jual_produk`.`jproduk_nobukti` AS `no_bukti_jual`,
          `master_jual_produk`.`jproduk_tanggal` AS `tanggal_jual`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_panggilan` AS `cust_panggilan`,
          `customer`.`cust_kelamin` AS `cust_kelamin`,
          `customer`.`cust_alamat` AS `cust_alamat`,
          `customer`.`cust_kota` AS `cust_kota`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_nama` AS `produk_nama`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`
     FROM (   (   (   (   (   `master_retur_jual_produk`
                           JOIN
                              `detail_retur_jual_produk`
                           ON ((`detail_retur_jual_produk`.`drproduk_master` =
                                   `master_retur_jual_produk`.`rproduk_id`)))
                       JOIN
                          `customer`
                       ON ((`master_retur_jual_produk`.`rproduk_cust` =
                               `customer`.`cust_id`)))
                   JOIN
                      `produk`
                   ON ((`detail_retur_jual_produk`.`drproduk_produk` =
                           `produk`.`produk_id`)))
               JOIN
                  `satuan`
               ON ((`detail_retur_jual_produk`.`drproduk_satuan` =
                       `satuan`.`satuan_id`)))
           JOIN
              `master_jual_produk`
           ON ((`master_jual_produk`.`jproduk_id` =
                   `master_retur_jual_produk`.`rproduk_nobuktijual`)));

CREATE OR REPLACE VIEW `vu_trans_retur_produk`
AS
   SELECT `master_retur_jual_produk`.`rproduk_nobukti` AS `no_bukti`,
          `master_retur_jual_produk`.`rproduk_cust` AS `cust_id`,
          `master_retur_jual_produk`.`rproduk_tanggal` AS `tanggal`,
          `vu_customer`.`cust_no` AS `cust_no`,
          `vu_customer`.`cust_member` AS `cust_member`,
          `vu_customer`.`cust_nama` AS `cust_nama`,
          `vu_customer`.`cust_kelamin` AS `cust_kelamin`,
          `vu_customer`.`cust_alamat` AS `cust_alamat`,
          `vu_customer`.`cust_kota` AS `cust_kota`,
          `master_jual_produk`.`jproduk_nobukti` AS `no_bukti_jual`,
          `master_retur_jual_produk`.`rproduk_stat_dok` AS `rproduk_stat_dok`,
          `master_jual_produk`.`jproduk_tanggal` AS `tanggal_jual`,
          ifnull(`vu_total_retur_jual_produk_group`.`jumlah_barang`, 0)
             AS `jumlah_barang`,
          ifnull(`vu_total_retur_jual_produk_group`.`total_nilai`, 0)
             AS `total_nilai`,
          ifnull(`master_retur_jual_produk`.`rproduk_diskon`, 0) AS `diskon`,
          ifnull(`master_retur_jual_produk`.`rproduk_cashback`, 0)
             AS `cashback`
     FROM (   (   (   `master_retur_jual_produk`
                   LEFT JOIN
                      `vu_total_retur_jual_produk_group`
                   ON ((`vu_total_retur_jual_produk_group`.`drproduk_master` =
                           `master_retur_jual_produk`.`rproduk_id`)))
               LEFT JOIN
                  `vu_customer`
               ON ((`master_retur_jual_produk`.`rproduk_cust` =
                       `vu_customer`.`cust_id`)))
           LEFT JOIN
              `master_jual_produk`
           ON ((`master_retur_jual_produk`.`rproduk_nobuktijual` =
                   `master_jual_produk`.`jproduk_id`)));



