/* UPDATE VIEW VU_DETAIL_RETUR_BELI */
CREATE OR REPLACE VIEW `vu_detail_retur_beli`
AS
   SELECT `vu_trans_retur_beli`.`no_bukti` AS `no_bukti`,
          `vu_trans_retur_beli`.`no_order` AS `no_order`,
          `vu_trans_retur_beli`.`no_terima` AS `no_terima`,
          `vu_trans_retur_beli`.`tanggal` AS `tanggal`,
          `vu_trans_retur_beli`.`rbeli_id` AS `rbeli_id`,
          `vu_trans_retur_beli`.`rbeli_terima` AS `rbeli_terima`,
          `vu_trans_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `detail_retur_beli`.`drbeli_id` AS `drbeli_id`,
          `detail_retur_beli`.`drbeli_master` AS `drbeli_master`,
          `detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,
          `vu_produk`.`produk_kode` AS `produk_kode`,
          `vu_produk`.`produk_id` AS `produk_id`,
          `vu_produk`.`produk_group` AS `produk_group`,
          `vu_produk`.`produk_nama` AS `produk_nama`,
          `vu_produk`.`produk_volume` AS `produk_volume`,
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
          `supplier`.`supplier_akun` AS `supplier_akun`
     FROM (   (   (   (   `detail_retur_beli`
                       JOIN
                          `vu_trans_retur_beli`
                       ON ((`detail_retur_beli`.`drbeli_master` =
                               `vu_trans_retur_beli`.`rbeli_id`)))
                   JOIN
                      `supplier`
                   ON ((`vu_trans_retur_beli`.`rbeli_supplier` =
                           `supplier`.`supplier_id`)))
               JOIN
                  `vu_produk`
               ON ((`detail_retur_beli`.`drbeli_produk` =
                       `vu_produk`.`produk_id`)))
           JOIN
              `satuan`
           ON ((`detail_retur_beli`.`drbeli_satuan` = `satuan`.`satuan_id`)));

/* UPDATE VIEW RETUR INVOICE */
CREATE OR REPLACE VIEW `vu_detail_invoice`
AS
   SELECT `master_invoice`.`invoice_id` AS `invoice_id`,
          `master_invoice`.`invoice_no` AS `invoice_no`,
          `master_invoice`.`invoice_no` AS `no_bukti`,
          `master_invoice`.`invoice_no_auto` AS `no_bukti_auto`,
          `master_invoice`.`invoice_supplier` AS `invoice_supplier`,
          `master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,
          `master_invoice`.`invoice_tanggal` AS `tanggal`,
          `master_invoice`.`invoice_noterima` AS `invoice_noterima`,
          `master_terima_beli`.`terima_no` AS `terima_no`,
          `master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,
          `master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,
          `master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,
          `master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,
          `master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,
          `master_invoice`.`invoice_penagih` AS `invoice_penagih`,
          `detail_invoice`.`dinvoice_master` AS `dinvoice_master`,
          `detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,
          `vu_produk`.`produk_kode` AS `produk_kode`,
          `vu_produk`.`produk_nama` AS `produk_nama`,
          `vu_produk`.`produk_point` AS `produk_point`,
          `vu_produk`.`produk_volume` AS `produk_volume`,
          `vu_produk`.`kategori_nama` AS `kategori_nama`,
          `vu_produk`.`kategori2_nama` AS `kategori2_nama`,
          `detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,
          `detail_invoice`.`dinvoice_jumlah` AS `jumlah_barang`,
          `detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,
          `detail_invoice`.`dinvoice_harga` AS `harga_satuan`,
          `detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,
          `detail_invoice`.`dinvoice_diskon` AS `diskon`,
          (((`detail_invoice`.`dinvoice_diskon`
             * `detail_invoice`.`dinvoice_jumlah`)
            * `detail_invoice`.`dinvoice_harga`)
           / 100)
             AS `diskon_nilai`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `vu_produk`.`produk_id` AS `produk_id`,
          `vu_produk`.`jenis_nama` AS `jenis_nama`,
          (((`detail_invoice`.`dinvoice_harga`
             * `detail_invoice`.`dinvoice_jumlah`)
            * (100 - `detail_invoice`.`dinvoice_diskon`))
           / 100)
             AS `subtotal`,
          `master_invoice`.`invoice_diskon` AS `invoice_diskon`,
          `master_invoice`.`invoice_cashback` AS `invoice_cashback`,
          `master_invoice`.`invoice_biaya` AS `invoice_biaya`,
          `supplier`.`supplier_id` AS `supplier_id`,
          `supplier`.`supplier_akun` AS `supplier_akun`,
          `supplier`.`supplier_kategori` AS `supplier_kategori`,
          `supplier`.`supplier_nama` AS `supplier_nama`,
          `supplier`.`supplier_alamat` AS `supplier_alamat`,
          `supplier`.`supplier_kota` AS `supplier_kota`,
          `supplier`.`supplier_notelp` AS `supplier_notelp`,
          `supplier`.`supplier_email` AS `supplier_email`,
          `master_invoice`.`invoice_status` AS `invoice_status`
     FROM (   (   (   (   (   `detail_invoice`
                           JOIN
                              `master_invoice`
                           ON ((`detail_invoice`.`dinvoice_master` =
                                   `master_invoice`.`invoice_id`)))
                       JOIN
                          `vu_produk`
                       ON ((`detail_invoice`.`dinvoice_produk` =
                               `vu_produk`.`produk_id`)))
                   JOIN
                      `master_terima_beli`
                   ON ((`master_invoice`.`invoice_noterima` =
                           `master_terima_beli`.`terima_id`)))
               JOIN
                  `satuan`
               ON ((`detail_invoice`.`dinvoice_satuan` = `satuan`.`satuan_id`)))
           JOIN
              `supplier`
           ON ((`supplier`.`supplier_id` =
                   `master_terima_beli`.`terima_supplier`)));
