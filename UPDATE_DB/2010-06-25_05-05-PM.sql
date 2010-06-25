CREATE OR REPLACE VIEW `miracledb`.`vu_detail_order_beli`
AS
   SELECT `miracledb`.`supplier`.`supplier_nama` AS `supplier_nama`,
          `miracledb`.`supplier`.`supplier_alamat` AS `supplier_alamat`,
          `miracledb`.`supplier`.`supplier_kota` AS `supplier_kota`,
          `miracledb`.`supplier`.`supplier_akun` AS `supplier_akun`,
          `miracledb`.`master_order_beli`.`order_supplier`
             AS `order_supplier`,
          `miracledb`.`master_order_beli`.`order_tanggal` AS `tanggal`,
          `miracledb`.`master_order_beli`.`order_carabayar`
             AS `order_carabayar`,
          `miracledb`.`master_order_beli`.`order_diskon` AS `order_diskon`,
          `miracledb`.`master_order_beli`.`order_biaya` AS `order_biaya`,
          `miracledb`.`master_order_beli`.`order_bayar` AS `order_bayar`,
          `miracledb`.`master_order_beli`.`order_keterangan`
             AS `order_keterangan`,
          `miracledb`.`detail_order_beli`.`dorder_master` AS `dorder_master`,
          `miracledb`.`detail_order_beli`.`dorder_produk` AS `dorder_produk`,
          `miracledb`.`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,
          `miracledb`.`detail_order_beli`.`dorder_jumlah` AS `jumlah_barang`,
          `miracledb`.`detail_order_beli`.`dorder_harga` AS `harga_satuan`,
          `miracledb`.`detail_order_beli`.`dorder_diskon` AS `diskon`,
          `miracledb`.`satuan`.`satuan_id` AS `satuan_id`,
          `miracledb`.`satuan`.`satuan_kode` AS `satuan_kode`,
          `miracledb`.`satuan`.`satuan_nama` AS `satuan_nama`,
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
          ((`miracledb`.`detail_order_beli`.`dorder_jumlah`
            * `miracledb`.`detail_order_beli`.`dorder_diskon`)
           * `miracledb`.`detail_order_beli`.`dorder_harga`)
             AS `diskon_nilai`,
          ((`miracledb`.`detail_order_beli`.`dorder_jumlah`
            * `miracledb`.`detail_order_beli`.`dorder_harga`)
           * (100 - `miracledb`.`detail_order_beli`.`dorder_diskon`))
             AS `subtotal`,
          `miracledb`.`supplier`.`supplier_id` AS `supplier_id`,
          `miracledb`.`master_order_beli`.`order_no` AS `no_bukti`,
          ifnull(`vu_detail_terima_order`.`jumlah_terima`, 0)
             AS `jumlah_terima`,
          ifnull(`vu_detail_terima_order`.`jumlah_sisa`, 0) AS `jumlah_sisa`
     FROM (   (   (   (   (   `miracledb`.`detail_order_beli`
                           JOIN
                              `miracledb`.`master_order_beli`
                           ON ((`miracledb`.`detail_order_beli`.
                                `dorder_master` =
                                   `miracledb`.`master_order_beli`.`order_id`)))
                       JOIN
                          `miracledb`.`supplier`
                       ON ((`miracledb`.`master_order_beli`.`order_supplier` =
                               `miracledb`.`supplier`.`supplier_id`)))
                   JOIN
                      `miracledb`.`satuan`
                   ON ((`miracledb`.`detail_order_beli`.`dorder_satuan` =
                           `miracledb`.`satuan`.`satuan_id`)))
               JOIN
                  `miracledb`.`vu_produk`
               ON ((`miracledb`.`detail_order_beli`.`dorder_produk` =
                       `vu_produk`.`produk_id`)))
           JOIN
              `miracledb`.`vu_detail_terima_order`
           ON (((`miracledb`.`detail_order_beli`.`dorder_produk` =
                    `vu_detail_terima_order`.`produk`
                 AND detail_order_beli.dorder_satuan =
                        vu_detail_terima_order.satuan)
                AND (`miracledb`.`detail_order_beli`.`dorder_master` =
                        `vu_detail_terima_order`.`master_order`))));