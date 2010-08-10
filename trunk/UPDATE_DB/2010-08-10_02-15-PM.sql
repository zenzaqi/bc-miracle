CREATE OR REPLACE VIEW `vu_trans_mutasi`
AS
   SELECT `master_mutasi`.`mutasi_id` AS `mutasi_id`,
          `master_mutasi`.`mutasi_no` AS `mutasi_no`,
          `master_mutasi`.`mutasi_asal` AS `mutasi_asal`,
          `gudang_tujuan`.`gudang_nama` AS `gudang_asal_nama`,
          `gudang_tujuan`.`gudang_lokasi` AS `gudang_asal_lokasi`,
          `master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,
          `gudang_asal`.`gudang_nama` AS `gudang_tujuan_nama`,
          `gudang_asal`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,
          `master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,
          `vu_total_mutasi_group`.`jumlah_barang` AS `jumlah_barang`,
          `master_mutasi`.`mutasi_keterangan` AS `mutasi_keterangan`,
          `master_mutasi`.`mutasi_status` AS `mutasi_status`,
          `master_mutasi`.`mutasi_creator` AS `mutasi_creator`,
          `master_mutasi`.`mutasi_date_create` AS `mutasi_date_create`,
          `master_mutasi`.`mutasi_update` AS `mutasi_update`,
          `master_mutasi`.`mutasi_date_update` AS `mutasi_date_update`,
          `master_mutasi`.`mutasi_revised` AS `mutasi_revised`
     FROM (   (   (   `master_mutasi`
                   JOIN
                      `gudang` `gudang_asal`
                   ON (((_UTF8 '' = _UTF8 '')
                        AND (`master_mutasi`.`mutasi_tujuan` =
                                `gudang_asal`.`gudang_id`))))
               JOIN
                  `gudang` `gudang_tujuan`
               ON ((`gudang_tujuan`.`gudang_id` =
                       `master_mutasi`.`mutasi_asal`)))
           JOIN
              `vu_total_mutasi_group`
           ON ((`vu_total_mutasi_group`.`dmutasi_master` =
                   `master_mutasi`.`mutasi_id`)));


CREATE OR REPLACE VIEW `vu_detail_mutasi`
AS
   SELECT `master_mutasi`.`mutasi_id` AS `mutasi_id`,
          `master_mutasi`.`mutasi_asal` AS `mutasi_asal`,
          `asal`.`gudang_id` AS `gudang_asal_id`,
          `asal`.`gudang_nama` AS `gudang_asal_nama`,
          `asal`.`gudang_lokasi` AS `gudang_asal_lokasi`,
          `master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,
          `tujuan`.`gudang_id` AS `gudang_tujuan_id`,
          `tujuan`.`gudang_nama` AS `gudang_tujuan_nama`,
          `tujuan`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,
          `master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,
          `detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,
          `detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,
          `detail_mutasi`.`dmutasi_satuan` AS `dmutasi_satuan`,
          `satuan_konversi`.`konversi_produk` AS `konversi_produk`,
          `produk`.`produk_id` AS `produk_id`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_point` AS `produk_point`,
          `produk`.`produk_harga` AS `produk_harga`,
          `produk`.`produk_volume` AS `produk_volume`,
          `produk`.`produk_nama` AS `produk_nama`,
          `satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,
          `satuan_konversi`.`konversi_default` AS `konversi_default`,
          `detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah`,
          `master_mutasi`.`mutasi_status` AS `mutasi_status`,
          `master_mutasi`.`mutasi_no` AS `mutasi_no`
     FROM (   (   (   (   (   (   `detail_mutasi`
                               JOIN
                                  `master_mutasi`
                               ON ((`detail_mutasi`.`dmutasi_master` =
                                       `master_mutasi`.`mutasi_id`)))
                           JOIN
                              `gudang` `tujuan`
                           ON (((_UTF8 '' = _UTF8 '')
                                AND (`tujuan`.`gudang_id` =
                                        `master_mutasi`.`mutasi_tujuan`))))
                       JOIN
                          `gudang` `asal`
                       ON ((`asal`.`gudang_id` =
                               `master_mutasi`.`mutasi_asal`)))
                   JOIN
                      `satuan_konversi`
                   ON (((`detail_mutasi`.`dmutasi_produk` =
                            `satuan_konversi`.`konversi_produk`)
                        AND (`detail_mutasi`.`dmutasi_satuan` =
                                `satuan_konversi`.`konversi_satuan`))))
               JOIN
                  `satuan`
               ON ((`satuan_konversi`.`konversi_satuan` =
                       `satuan`.`satuan_id`)))
           JOIN
              `produk`
           ON ((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));
