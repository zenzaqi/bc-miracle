/*------------ REPLACE VIEW DETAIL RETUR BELI ----------------*/

CREATE OR REPLACE VIEW `vu_detail_retur_beli`
AS
   SELECT `master_retur_beli`.`rbeli_nobukti` AS `no_bukti`,
          `master_retur_beli`.`rbeli_tanggal` AS `tanggal`,
          `master_retur_beli`.`rbeli_id` AS `rbeli_id`,
          `master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,
          `master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,
          `master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,
          `detail_retur_beli`.`drbeli_id` AS `drbeli_id`,
          `detail_retur_beli`.`drbeli_master` AS `drbeli_master`,
          `detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,
          `vu_produk`.`produk_kode` AS `produk_kode`,
          `vu_produk`.`produk_id` AS `produk_id`,
          `vu_produk`.`produk_group` AS `produk_group`,
          `vu_produk`.`produk_nama` AS `produk_nama`,
          `vu_produk`.`group_nama` AS `group_nama`,
          `vu_produk`.`kategori_nama` AS `kategori_nama`,
          `vu_produk`.`kategori_jenis` AS `kategori_jenis`,
          `vu_produk`.`jenis_nama` AS `jenis_nama`,
          `vu_produk`.`kategori2_nama` AS `kategori2_nama`,
          `detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `detail_retur_beli`.`drbeli_jumlah` AS `drbeli_jumlah`,
          `detail_retur_beli`.`drbeli_jumlah` AS `jumlah_barang`,
          `detail_retur_beli`.`drbeli_harga` AS `drbeli_harga`,
          `detail_retur_beli`.`drbeli_diskon` AS `drbeli_diskon`,
          `detail_retur_beli`.`drbeli_diskon` AS `diskon`,
          `detail_retur_beli`.`drbeli_harga` AS `harga_satuan`,
          (((`detail_retur_beli`.`drbeli_diskon`
             * `detail_retur_beli`.`drbeli_harga`)
            * `detail_retur_beli`.`drbeli_jumlah`)
           / 100)
             AS `diskon_nilai`,
          ((((100 - `detail_retur_beli`.`drbeli_diskon`) / 100)
            * `detail_retur_beli`.`drbeli_harga`)
           * `detail_retur_beli`.`drbeli_jumlah`)
             AS `subtotal`,
          `supplier`.`supplier_akun` AS `supplier_akun`,
          `vu_trans_terima`.`no_bukti` AS `no_terima`,
          `vu_trans_terima`.`order_no` AS `no_order`,
          `vu_produk`.`produk_volume` AS `produk_volume`
     FROM (   (   (   (   (   `detail_retur_beli`
                           JOIN
                              `master_retur_beli`
                           ON ((`detail_retur_beli`.`drbeli_master` =
                                   `master_retur_beli`.`rbeli_id`)))
                       JOIN
                          `supplier`
                       ON ((`master_retur_beli`.`rbeli_supplier` =
                               `supplier`.`supplier_id`)))
                   JOIN
                      `vu_produk`
                   ON ((`detail_retur_beli`.`drbeli_produk` =
                           `vu_produk`.`produk_id`)))
               JOIN
                  `satuan`
               ON ((`detail_retur_beli`.`drbeli_satuan` =
                       `satuan`.`satuan_id`)))
           JOIN
              `vu_trans_terima`
           ON ((`master_retur_beli`.`rbeli_terima` =
                   `vu_trans_terima`.`terima_id`)));