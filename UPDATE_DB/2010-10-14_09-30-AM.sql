/*-- UPDATE PRODUK SATUAN TERKECIL--- */

CREATE OR REPLACE VIEW `vu_produk_satuan_terkecil`
AS
   SELECT `produk`.`produk_id` AS `produk_id`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_nama` AS `produk_nama`,
          `produk`.`produk_harga` AS `produk_harga`,
          `produk`.`produk_volume` AS `produk_volume`,
          `produk`.`produk_jenis` AS `produk_jenis`,
          `produk`.`produk_point` AS `produk_point`,
          `satuan_konversi`.`konversi_produk`
             AS `konversi_produk`,
          `satuan_konversi`.`konversi_satuan`
             AS `konversi_satuan`,
          `satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,
          `satuan_konversi`.`konversi_default`
             AS `konversi_default`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `satuan`.`satuan_aktif` AS `satuan_aktif`,
          `produk`.`produk_aktif` AS `produk_aktif`,
          `produk`.`produk_group` AS `produk_group`,
          `produk`.`produk_kategori` AS `produk_kategori`,
          `produk`.`produk_kontribusi` AS `produk_kontribusi`,
          `produk`.`produk_du` AS `produk_du`,
          `produk`.`produk_dm` AS `produk_dm`,
          `produk`.`produk_kodelama` AS `produk_kodelama`,
          `produk`.`produk_racikan` AS `produk_racikan`,
          `produk`.`produk_keterangan` AS `produk_keterangan`,
          `produk`.`produk_saldo_awal` AS `produk_saldo_awal`,
          `kategori2`.`kategori2_nama` AS `kategori2_nama`,
          `kategori2`.`kategori2_jenis` AS `kategori2_jenis`,
          `kategori2`.`kategori2_id` AS `kategori2_id`,
          `produk_group`.`group_id` AS `group_id`,
          `produk_group`.`group_kode` AS `group_kode`,
          `produk_group`.`group_nama` AS `group_nama`,
          `produk_group`.`group_kelompok` AS `group_kelompok`,
          `kategori`.`kategori_id` AS `kategori_id`,
          `kategori`.`kategori_nama` AS `kategori_nama`,
          `kategori`.`kategori_jenis` AS `kategori_jenis`
     FROM (   (   (   (   (   `produk`
                           JOIN
                              `satuan_konversi`
                           ON ((`satuan_konversi`.
                                `konversi_produk` =
                                   `produk`.`produk_id`)))
                       JOIN
                          `satuan`
                       ON ((`satuan`.`satuan_id` =
                               `satuan_konversi`.
                               `konversi_satuan`)))
                   LEFT JOIN
                      `kategori2`
                   ON ((`produk`.`produk_kontribusi` =
                           `kategori2`.`kategori2_id`)))
               LEFT JOIN
                  `produk_group`
               ON ((`produk`.`produk_group` =
                       `produk_group`.`group_id`)))
           LEFT JOIN
              `kategori`
           ON ((`produk_group`.`group_kelompok` =
                   `kategori`.`kategori_id`)))
    WHERE (`satuan_konversi`.`konversi_nilai` = 1);

