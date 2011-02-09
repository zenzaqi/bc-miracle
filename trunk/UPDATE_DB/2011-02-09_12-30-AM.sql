/* UPDATE VIEW DETAIL ORDER */
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
           * `detail_order_beli`.`dorder_harga`)/100
             AS `diskon_nilai`,
          ((`detail_order_beli`.`dorder_jumlah`
            * `detail_order_beli`.`dorder_harga`)
           * (100 - `detail_order_beli`.`dorder_diskon`))/100
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