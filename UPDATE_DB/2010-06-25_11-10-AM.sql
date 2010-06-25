CREATE OR REPLACE VIEW `miracledb`.`vu_total_terima_group_konversi`
AS
   SELECT `vu_detail_terima_konversi`.`master` AS `master`,
          sum(`vu_detail_terima_konversi`.`jumlah`) AS `jumlah_barang`,
          sum(`vu_detail_terima_konversi`.`subtotal`) AS `jumlah_nilai`,
          sum(`vu_detail_terima_konversi`.`konversi_nilai`)
             AS `jumlah_konversi`
     FROM `miracledb`.`vu_detail_terima_konversi`
   GROUP BY `vu_detail_terima_konversi`.`master`;



CREATE OR REPLACE VIEW `miracledb`.`vu_trans_terima_konversi`
AS
   SELECT `miracledb`.`master_terima_beli`.`terima_id` AS `terima_id`,
          `miracledb`.`master_terima_beli`.`terima_no` AS `terima_no`,
          `miracledb`.`master_terima_beli`.`terima_order` AS `terima_order`,
          `miracledb`.`master_terima_beli`.`terima_supplier`
             AS `terima_supplier`,
          `miracledb`.`master_terima_beli`.`terima_surat_jalan`
             AS `terima_surat_jalan`,
          `miracledb`.`master_terima_beli`.`terima_pengirim`
             AS `terima_pengirim`,
          `miracledb`.`master_terima_beli`.`terima_status` AS `terima_status`,
          `miracledb`.`master_terima_beli`.`terima_tanggal`
             AS `terima_tanggal`,
          `miracledb`.`master_terima_beli`.`terima_keterangan`
             AS `terima_keterangan`,
          `miracledb`.`master_terima_beli`.`terima_creator`
             AS `terima_creator`,
          `miracledb`.`master_terima_beli`.`terima_date_create`
             AS `terima_date_create`,
          `miracledb`.`master_terima_beli`.`terima_update` AS `terima_update`,
          `miracledb`.`master_terima_beli`.`terima_date_update`
             AS `terima_date_update`,
          `miracledb`.`master_terima_beli`.`terima_revised`
             AS `terima_revised`,
          `vu_total_terima_group_konversi`.`jumlah_barang` AS `jumlah_barang`,
          `vu_total_terima_group_konversi`.`jumlah_nilai` AS `jumlah_nilai`,
          `vu_total_terima_group_konversi`.`jumlah_konversi`
             AS `jumlah_konversi`,
          `miracledb`.`master_order_beli`.`order_cashback`
             AS `order_cashback`,
          `miracledb`.`master_order_beli`.`order_biaya` AS `order_biaya`,
          `miracledb`.`master_order_beli`.`order_diskon` AS `order_diskon`,
          (`miracledb`.`master_order_beli`.`order_cashback`
           / `vu_total_terima_group_konversi`.`jumlah_barang`)
             AS `potongan_satuan`,
          (`miracledb`.`master_order_beli`.`order_biaya`
           / `vu_total_terima_group_konversi`.`jumlah_barang`)
             AS `biaya_satuan`,
          (((`vu_total_terima_group_konversi`.`jumlah_nilai`
             * `miracledb`.`master_order_beli`.`order_diskon`)
            / 100)
           / `vu_total_terima_group_konversi`.`jumlah_barang`)
             AS `diskon_satuan`
     FROM (   (   `miracledb`.`vu_total_terima_group_konversi`
               JOIN
                  `miracledb`.`master_terima_beli`
               ON ((`vu_total_terima_group_konversi`.`master` =
                       `miracledb`.`master_terima_beli`.`terima_id`)))
           JOIN
              `miracledb`.`master_order_beli`
           ON ((`miracledb`.`master_order_beli`.`order_id` =
                   `miracledb`.`master_terima_beli`.`terima_order`)));

CREATE OR REPLACE VIEW `miracledb`.`vu_hpp_tanggal`
AS
   SELECT `miracledb`.`master_terima_beli`.`terima_tanggal` AS `tanggal`,
          `miracledb`.`master_terima_beli`.`terima_status` AS `status`
     FROM `miracledb`.`master_terima_beli`
   UNION
   SELECT `miracledb`.`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,
          `miracledb`.`master_jual_produk`.`jproduk_stat_dok` AS `status`
     FROM `miracledb`.`master_jual_produk`;


CREATE OR REPLACE VIEW `miracledb`.`vu_hpp_beli_terima`
AS
   SELECT `vu_trans_terima_konversi`.`terima_status` AS `terima_status`,
          `vu_trans_terima_konversi`.`terima_tanggal` AS `tanggal`,
          `vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,
          `vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,
          `vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,
          `vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,
          `vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,
          `vu_produk_satuan_terkecil`.`satuan_aktif` AS `satuan_aktif`,
          `vu_detail_terima_all`.`jumlah` AS `jumlah`,
          `vu_detail_terima_all`.`harga_satuan` AS `harga_satuan`,
          `vu_detail_terima_all`.`diskon` AS `diskon`,
          `vu_trans_terima_konversi`.`potongan_satuan` AS `potongan_satuan`,
          `vu_trans_terima_konversi`.`biaya_satuan` AS `biaya_satuan`,
          `vu_trans_terima_konversi`.`diskon_satuan` AS `diskon_satuan`,
          `miracledb`.`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,
          ((((((`vu_detail_terima_all`.`harga_satuan`
                * (100 - `vu_detail_terima_all`.`diskon`))
               / 100)
              / `miracledb`.`satuan_konversi`.`konversi_nilai`)
             - `vu_trans_terima_konversi`.`potongan_satuan`)
            - `vu_trans_terima_konversi`.`diskon_satuan`)
           + `vu_trans_terima_konversi`.`diskon_satuan`)
             AS `harga_beli`,
          (`miracledb`.`satuan_konversi`.`konversi_nilai`
           * `vu_detail_terima_all`.`jumlah`)
             AS `jumlah_konversi`
     FROM (   (   (   `miracledb`.`vu_detail_terima_all`
                   JOIN
                      `miracledb`.`satuan_konversi`
                   ON (((`vu_detail_terima_all`.`produk_id` =
                            `miracledb`.`satuan_konversi`.`konversi_produk`)
                        AND (`vu_detail_terima_all`.`satuan_id` =
                                `miracledb`.`satuan_konversi`.
                                `konversi_satuan`))))
               JOIN
                  `miracledb`.`vu_produk_satuan_terkecil`
               ON ((`miracledb`.`satuan_konversi`.`konversi_produk` =
                       `vu_produk_satuan_terkecil`.`produk_id`)))
           JOIN
              `miracledb`.`vu_trans_terima_konversi`
           ON ((`vu_trans_terima_konversi`.`terima_id` =
                   `vu_detail_terima_all`.`master`)));