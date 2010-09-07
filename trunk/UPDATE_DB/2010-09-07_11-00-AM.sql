CREATE OR REPLACE VIEW `vu_detail_koreksi`
AS
   SELECT `master_koreksi_stok`.`koreksi_id` AS `koreksi_id`,
          `master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,
          `gudang`.`gudang_id` AS `gudang_id`,
          `gudang`.`gudang_nama` AS `gudang_nama`,
          `gudang`.`gudang_lokasi` AS `gudang_lokasi`,
          `master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,
          `master_koreksi_stok`.`koreksi_tanggal` AS `tanggal`,
          `master_koreksi_stok`.`koreksi_status` AS `koreksi_status`,
          `detail_koreksi_stok`.`dkoreksi_id` AS `dkoreksi_id`,
          `detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,
          `detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,
          `produk`.`produk_id` AS `produk_id`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_group` AS `produk_group`,
          `produk`.`produk_nama` AS `produk_nama`,
          `produk`.`produk_volume` AS `produk_volume`,
          `detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `detail_koreksi_stok`.`dkoreksi_jmlawal` AS `dkoreksi_jmlawal`,
          `detail_koreksi_stok`.`dkoreksi_jmlkoreksi`
             AS `dkoreksi_jmlkoreksi`,
          `detail_koreksi_stok`.`dkoreksi_jmlsaldo` AS `dkoreksi_jmlsaldo`,
          `detail_koreksi_stok`.`dkoreksi_ket` AS `dkoreksi_ket`,
          `master_koreksi_stok`.`koreksi_no` AS `no_bukti`
     FROM (   (   (   (   `detail_koreksi_stok`
                       JOIN
                          `master_koreksi_stok`
                       ON ((`detail_koreksi_stok`.`dkoreksi_master` =
                               `master_koreksi_stok`.`koreksi_id`)))
                   JOIN
                      `produk`
                   ON ((`detail_koreksi_stok`.`dkoreksi_produk` =
                           `produk`.`produk_id`)))
               JOIN
                  `satuan`
               ON ((`detail_koreksi_stok`.`dkoreksi_satuan` =
                       `satuan`.`satuan_id`)))
           JOIN
              `gudang`
           ON ((`master_koreksi_stok`.`koreksi_gudang` = `gudang`.`gudang_id`)));