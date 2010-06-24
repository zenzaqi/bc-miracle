CREATE OR REPLACE VIEW vu_detail_terima_order
AS
SELECT mo.order_id AS master_order,
       mt.terima_id as master_terima,
       do.dorder_produk AS produk,
       do.dorder_satuan AS satuan,
       do.dorder_jumlah AS jumlah_order,
       dt.dterima_jumlah AS jumlah_terima,
       do.dorder_jumlah - dt.dterima_jumlah AS jumlah_sisa,
       do.dorder_harga as harga,
       do.dorder_diskon as diskon
  FROM detail_order_beli do,
       master_order_beli mo,
       detail_terima_beli dt,
       master_terima_beli mt
 WHERE     do.dorder_master = mo.order_id
       AND dt.dterima_master = mt.terima_id
       AND mt.terima_order = mo.order_id
       AND do.dorder_produk = dt.dterima_produk
       AND do.dorder_satuan = dt.dterima_satuan

union

SELECT mo.order_id AS master_order,
       -1 as master_terima,
       do.dorder_produk AS produk,
       do.dorder_satuan AS satuan,
       do.dorder_jumlah AS jumlah_order,
       0 AS jumlah_terima,
       do.dorder_jumlah AS jumlah_sisa,
       do.dorder_harga as harga,
       do.dorder_diskon as diskon
  FROM detail_order_beli do, master_order_beli mo
 WHERE do.dorder_master = mo.order_id
       AND (do.dorder_produk, do.dorder_satuan) NOT IN
              (SELECT dt.dterima_produk, dt.dterima_satuan
                 FROM detail_terima_beli dt, master_terima_beli mt
                WHERE mt.terima_id = dt.dterima_master
                      AND mt.terima_order = mo.order_id)

union

SELECT -1 as master_order,
       mt.terima_id as master_terima,
       dt.dterima_produk AS produk,
       dt.dterima_satuan AS satuan,
       0 AS jumlah_order,
       dt.dterima_jumlah AS jumlah_terima,
       -dt.dterima_jumlah AS jumlah_sisa,
       0 as harga,
       0 as diskon
  FROM detail_terima_beli dt, master_terima_beli mt
 WHERE mt.terima_id = dt.dterima_master
       AND (dt.dterima_produk, dt.dterima_satuan) NOT IN
              (SELECT do.dorder_produk, do.dorder_satuan
                 FROM master_order_beli mo, detail_order_beli do
                WHERE mo.order_id = do.dorder_master
                      AND mo.order_id = mt.terima_order);


CREATE OR REPLACE VIEW vu_detail_order_beli
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
       ifnull(`vu_detail_terima_order`.`jumlah_terima`, 0) AS `jumlah_terima`,
       ifnull(`vu_detail_terima_order`.`jumlah_sisa`, 0) AS `jumlah_sisa`
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
        LEFT JOIN
           `vu_detail_terima_order`
        ON (((`detail_order_beli`.`dorder_produk` =
                 `vu_detail_terima_order`.`produk`)
             AND (`detail_order_beli`.`dorder_master` =
                     `vu_detail_terima_order`.`master_order`))));

CREATE OR REPLACE VIEW `vu_detail_invoice` AS SELECT `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_no` AS `no_bukti`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_tanggal` AS `tanggal`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,`detail_invoice`.`dinvoice_jumlah` AS `jumlah_barang`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,`detail_invoice`.`dinvoice_harga` AS `harga_satuan`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`detail_invoice`.`dinvoice_diskon` AS `diskon`,(((`detail_invoice`.`dinvoice_diskon` * `detail_invoice`.`dinvoice_jumlah`) * `detail_invoice`.`dinvoice_harga`) / 100) AS `diskon_nilai`,`satuan`.`satuan_id` AS `satuan_id`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`jenis_nama` AS `jenis_nama`,(((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100) AS `subtotal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_email` AS `supplier_email` FROM (((((`detail_invoice` JOIN `master_invoice` ON((`detail_invoice`.`dinvoice_master` = `master_invoice`.`invoice_id`))) JOIN `vu_produk` ON((`detail_invoice`.`dinvoice_produk` = `vu_produk`.`produk_id`))) JOIN `master_terima_beli` ON((`master_invoice`.`invoice_noterima` = `master_terima_beli`.`terima_id`))) JOIN `satuan` ON((`detail_invoice`.`dinvoice_satuan` = `satuan`.`satuan_id`))) JOIN `supplier` ON((`supplier`.`supplier_id` = `master_terima_beli`.`terima_supplier`)));
