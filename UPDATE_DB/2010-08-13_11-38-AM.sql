/*------------ DETAIL KOREKSI --------------*/

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



/*-------------- TOTAL GROUP KOREKSI ----------------*/

CREATE OR REPLACE VIEW `vu_total_koreksi_group`
AS
   SELECT `detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,
          sum(`detail_koreksi_stok`.`dkoreksi_jmlawal`) AS `jumlah_awal`,
          sum(`detail_koreksi_stok`.`dkoreksi_jmlkoreksi`)
             AS `jumlah_koreksi`,
          sum(`detail_koreksi_stok`.`dkoreksi_jmlsaldo`) AS `jumlah_saldo`
     FROM `detail_koreksi_stok`
   GROUP BY `detail_koreksi_stok`.`dkoreksi_master`;

/*------------ MASTER TRANS KOREKSI ------------ */

CREATE OR REPLACE VIEW `vu_trans_koreksi`
AS
   SELECT `master_koreksi_stok`.`koreksi_id` AS `koreksi_id`,
          `master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,
          `master_koreksi_stok`.`koreksi_tanggal` AS `tanggal`,
          `master_koreksi_stok`.`koreksi_keterangan` AS `koreksi_keterangan`,
          `master_koreksi_stok`.`koreksi_status` AS `koreksi_status`,
          `master_koreksi_stok`.`koreksi_creator` AS `koreksi_creator`,
          `master_koreksi_stok`.`koreksi_date_create`
             AS `koreksi_date_create`,
          `master_koreksi_stok`.`koreksi_update` AS `koreksi_update`,
          `master_koreksi_stok`.`koreksi_date_update`
             AS `koreksi_date_update`,
          `master_koreksi_stok`.`koreksi_revised` AS `koreksi_revised`,
          `master_koreksi_stok`.`koreksi_no` AS `no_bukti`,
          `vu_total_koreksi_group`.`jumlah_awal` AS `jumlah_awal`,
          `vu_total_koreksi_group`.`jumlah_koreksi` AS `jumlah_koreksi`,
          `vu_total_koreksi_group`.`jumlah_saldo` AS `jumlah_saldo`,
          `gudang`.`gudang_nama` AS `gudang_nama`,
          `gudang`.`gudang_lokasi` AS `gudang_lokasi`,
          `gudang`.`gudang_keterangan` AS `gudang_keterangan`,
          `gudang`.`gudang_id` AS `gudang_id`
     FROM (   (   `master_koreksi_stok`
               JOIN
                  `gudang`
               ON ((`gudang`.`gudang_id` =
                       `master_koreksi_stok`.`koreksi_gudang`)))
           JOIN
              `vu_total_koreksi_group`
           ON ((`master_koreksi_stok`.`koreksi_id` =
                   `vu_total_koreksi_group`.`dkoreksi_master`)));