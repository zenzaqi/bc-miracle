/* UPDATE VIEW PAKET */
CREATE OR REPLACE VIEW `vu_paket`
AS
   SELECT `paket`.`paket_id` AS `paket_id`,
          `paket`.`paket_kode` AS `paket_kode`,
          `paket`.`paket_nama` AS `paket_nama`,
          `paket`.`paket_group` AS `paket_group`,
          `paket`.`paket_kontribusi` AS `paket_kontribusi`,
          `paket`.`paket_kodelama` AS `paket_kodelama`,
          `paket`.`paket_keterangan` AS `paket_keterangan`,
          `paket`.`paket_du` AS `paket_du`,
          `paket`.`paket_dm` AS `paket_dm`,
          `paket`.`paket_point` AS `paket_point`,
          `paket`.`paket_harga` AS `paket_harga`,
          `paket`.`paket_expired` AS `paket_expired`,
          `paket`.`paket_jmlisi` AS `paket_jmlisi`,
          `produk_group`.`group_kode` AS `group_kode`,
          `produk_group`.`group_nama` AS `group_nama`,
          `produk_group`.`group_dupaket` AS `group_dupaket`,
          `kategori2`.`kategori2_nama` AS `kategori2_nama`,
          `kategori2`.`kategori2_jenis` AS `kategori2_jenis`,
          `produk_group`.`group_dmpaket` AS `group_dmpaket`,
          `produk_group`.`group_kelompok` AS `group_kelompok`,
          `paket`.`paket_aktif` AS `paket_aktif`,
          `paket`.`paket_standart_tetap` AS `paket_standart_tetap`,
          `paket`.`paket_jenis` AS `paket_jenis`,
          `paket`.`paket_frek` AS `paket_frek`
     FROM (   (   `paket`
               LEFT JOIN
                  `produk_group`
               ON ((`paket`.`paket_group` = `produk_group`.`group_id`)))
           LEFT JOIN
              `kategori2`
           ON ((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`)));

/* UPDATE TABEL AKUN MAP */
ALTER TABLE `akun_map` CHANGE `map_aktif` `map_aktif` ENUM( 'Aktif', 'Tidak Aktif' ) NOT NULL DEFAULT 'Aktif'

/* ALTER VIEW PRODUK SATUAN DEFAULT */
CREATE OR REPLACE VIEW `vu_produk_satuan_default`
AS
   SELECT `produk`.`produk_id` AS `produk_id`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_nama` AS `produk_nama`,
          `produk`.`produk_harga` AS `produk_harga`,
          `produk`.`produk_volume` AS `produk_volume`,
          `produk`.`produk_jenis` AS `produk_jenis`,
          `produk`.`produk_point` AS `produk_point`,
          `satuan_konversi`.`konversi_produk` AS `konversi_produk`,
          `satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,
          `satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,
          `satuan_konversi`.`konversi_default` AS `konversi_default`,
          `satuan`.`satuan_id` AS `satuan_id`,
          `satuan`.`satuan_kode` AS `satuan_kode`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          `satuan`.`satuan_aktif` AS `satuan_aktif`,
          `produk`.`produk_aktif` AS `produk_aktif`,
          `produk`.`produk_group` AS `produk_group`,
          `produk`.`produk_kategori` AS `produk_kategori`,
          `produk`.`produk_kontribusi` AS `produk_kontribusi`,
          `produk`.`produk_kodelama` AS `produk_kodelama`,
          `produk`.`produk_du` AS `produk_du`,
          `produk`.`produk_dm` AS `produk_dm`,
          `produk`.`produk_racikan` AS `produk_racikan`,
          `produk`.`produk_keterangan_resep` AS `produk_keterangan_resep`,
          `produk`.`produk_satuan` AS `produk_satuan`,
          `produk`.`produk_keterangan` AS `produk_keterangan`,
          `produk`.`produk_saldo_awal` AS `produk_saldo_awal`,
          `produk`.`produk_nilai_saldo_awal` AS `produk_nilai_saldo_awal`
     FROM (   (   `produk`
               JOIN
                  `satuan_konversi`
               ON ((`satuan_konversi`.`konversi_produk` =
                       `produk`.`produk_id`)))
           JOIN
              `satuan`
           ON ((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`)))
    WHERE (`satuan_konversi`.`konversi_default` = 1); 
