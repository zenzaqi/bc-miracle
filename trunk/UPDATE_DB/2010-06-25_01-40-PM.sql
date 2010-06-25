CREATE OR REPLACE VIEW vu_stok_new
AS
   SELECT `mt`.`terima_tanggal` AS `tanggal`,
          `mt`.`terima_supplier` AS `asal`,
          1 AS `tujuan`,
          1 AS `gudang`,
          `mt`.`terima_no` AS `no_bukti`,
          'PB' AS `jenis_transaksi`,
          `mt`.`terima_status` AS `status`,
          `dt`.`dterima_produk` AS `produk`,
          `dt`.`dterima_satuan` AS `satuan`,
          `dt`.`dterima_jumlah` AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'beli' AS `keterangan`
     FROM (   `miracledb`.`detail_terima_beli` `dt`
           JOIN
              `miracledb`.`master_terima_beli` `mt`)
    WHERE (`dt`.`dterima_master` = `mt`.`terima_id`)
   UNION
   SELECT `mt`.`terima_tanggal` AS `tanggal`,
          `mt`.`terima_supplier` AS `asal`,
          1 AS `tujuan`,
          1 AS `gudang`,
          `mt`.`terima_no` AS `no_bukti`,
          'PB' AS `jenis_transaksi`,
          `mt`.`terima_status` AS `status`,
          `db`.`dtbonus_produk` AS `produk`,
          `db`.`dtbonus_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          `db`.`dtbonus_jumlah` AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'bonus' AS `keterangan`
     FROM (   `miracledb`.`detail_terima_bonus` `db`
           JOIN
              `miracledb`.`master_terima_beli` `mt`)
    WHERE (`db`.`dtbonus_master` = `mt`.`terima_id`)
   UNION
   SELECT `mr`.`rbeli_tanggal` AS `tanggal`,
          `mr`.`rbeli_supplier` AS `asal`,
          1 AS `tujuan`,
          1 AS `gudang`,
          `mr`.`rbeli_nobukti` AS `no_bukti`,
          'RB' AS `jenis_transaksi`,
          `mr`.`rbeli_status` AS `status`,
          `dr`.`drbeli_produk` AS `produk`,
          `dr`.`drbeli_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          `dr`.`drbeli_jumlah` AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'retur' AS `keterangan`
     FROM (   `miracledb`.`detail_retur_beli` `dr`
           JOIN
              `miracledb`.`master_retur_beli` `mr`)
    WHERE (`dr`.`drbeli_master` = `mr`.`rbeli_id`)
   UNION
   SELECT `mmm`.`mutasi_tanggal` AS `tanggal`,
          `mmm`.`mutasi_asal` AS `asal`,
          `mmm`.`mutasi_tujuan` AS `tujuan`,
          `mmm`.`mutasi_tujuan` AS `gudang`,
          `mmm`.`mutasi_no` AS `no_bukti`,
          'mutasi' AS `jenis_transaksi`,
          `mmm`.`mutasi_status` AS `status`,
          `dmm`.`dmutasi_produk` AS `produk`,
          `dmm`.`dmutasi_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          `dmm`.`dmutasi_jumlah` AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'mutasi masuk' AS `keterangan`
     FROM (   `miracledb`.`master_mutasi` `mmm`
           JOIN
              `miracledb`.`detail_mutasi` `dmm`)
    WHERE (`dmm`.`dmutasi_master` = `mmm`.`mutasi_id`)
   UNION
   SELECT `mmk`.`mutasi_tanggal` AS `tanggal`,
          `mmk`.`mutasi_asal` AS `asal`,
          `mmk`.`mutasi_tujuan` AS `tujuan`,
          `mmk`.`mutasi_asal` AS `gudang`,
          `mmk`.`mutasi_no` AS `no_bukti`,
          'mutasi' AS `jenis_transaksi`,
          `mmk`.`mutasi_status` AS `status`,
          `dmk`.`dmutasi_produk` AS `produk`,
          `dmk`.`dmutasi_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          `dmk`.`dmutasi_jumlah` AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'mutasi keluar' AS `keterangan`
     FROM (   `miracledb`.`master_mutasi` `mmk`
           JOIN
              `miracledb`.`detail_mutasi` `dmk`)
    WHERE (`dmk`.`dmutasi_master` = `mmk`.`mutasi_id`)
   UNION
   SELECT `mk`.`koreksi_tanggal` AS `tanggal`,
          `mk`.`koreksi_gudang` AS `asal`,
          `mk`.`koreksi_gudang` AS `tujuan`,
          `mk`.`koreksi_gudang` AS `gudang`,
          `mk`.`koreksi_no` AS `no_bukti`,
          'koreksi' AS `jenis_transaksi`,
          `mk`.`koreksi_status` AS `status`,
          `dk`.`dkoreksi_produk` AS `produk`,
          `dk`.`dkoreksi_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          `dk`.`dkoreksi_jmlkoreksi` AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'koreksi' AS `keterangan`
     FROM (   `miracledb`.`master_koreksi_stok` `mk`
           JOIN
              `miracledb`.`detail_koreksi_stok` `dk`)
    WHERE (`mk`.`koreksi_id` = `dk`.`dkoreksi_master`)
   UNION
   SELECT `mj`.`jproduk_tanggal` AS `tanggal`,
          2 AS `asal`,
          `mj`.`jproduk_cust` AS `tujuan`,
          2 AS `gudang`,
          `mj`.`jproduk_nobukti` AS `no_bukti`,
          'jual produk' AS `jenis_traksaksi`,
          `mj`.`jproduk_stat_dok` AS `status`,
          `dj`.`dproduk_produk` AS `produk`,
          `dj`.`dproduk_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          `dj`.`dproduk_jumlah` AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'customer' AS `keterangan`
     FROM (   `miracledb`.`master_jual_produk` `mj`
           JOIN
              `miracledb`.`detail_jual_produk` `dj`)
    WHERE (`dj`.`dproduk_master` = `mj`.`jproduk_id`)
   UNION
   SELECT `mjg`.`jpgrooming_tanggal` AS `tanggal`,
          2 AS `asal`,
          `mjg`.`jpgrooming_karyawan` AS `tujuan`,
          2 AS `gudang`,
          `mjg`.`jpgrooming_nobukti` AS `no_bukti`,
          'jual produk' AS `jenis_transaksi`,
          'Tertutup' AS `status`,
          `djg`.`dpgrooming_produk` AS `produk`,
          `djg`.`dpgrooming_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          `djg`.`dpgrooming_jumlah` AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'grooming' AS `keterangan`
     FROM (   `miracledb`.`master_jualproduk_grooming` `mjg`
           JOIN
              `miracledb`.`detail_jualproduk_grooming` `djg`)
    WHERE (`mjg`.`jpgrooming_id` = `djg`.`dpgrooming_master`)
   UNION
   SELECT `mrj`.`rproduk_tanggal` AS `tanggal`,
          `mrj`.`rproduk_cust` AS `asal`,
          2 AS `tujuan`,
          2 AS `gudang`,
          `mrj`.`rproduk_nobukti` AS `no_bukti`,
          'retur jual' AS `jenis_transaksi`,
          `mrj`.`rproduk_stat_dok` AS `status`,
          `drj`.`drproduk_produk` AS `produk`,
          `drj`.`drproduk_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          `drj`.`drproduk_jumlah` AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'produk retur' AS `keterangan`
     FROM (   `miracledb`.`master_retur_jual_produk` `mrj`
           JOIN
              `miracledb`.`detail_retur_jual_produk` `drj`)
    WHERE (`mrj`.`rproduk_id` = `drj`.`drproduk_master`)
   UNION
   SELECT `mrp`.`rpaket_tanggal` AS `tanggal`,
          `mrp`.`rpaket_cust` AS `asal`,
          2 AS `tujuan`,
          2 AS `gudan`,
          `mrp`.`rpaket_nobukti` AS `no_bukti`,
          'retur jual' AS `jenis_transaksi`,
          `mrp`.`rpaket_stat_dok` AS `status`,
          `drp`.`drpaket_produk` AS `produk`,
          `drp`.`drpaket_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          `drp`.`drpaket_jumlah` AS `jml_retur_paket`,
          0 AS `jml_pakai_cabin`,
          'paket retur' AS `keterangan`
     FROM (   `miracledb`.`master_retur_jual_paket` `mrp`
           JOIN
              `miracledb`.`detail_retur_paket_produk` `drp`)
    WHERE (`mrp`.`rpaket_id` = `drp`.`drpaket_master`)
   UNION
   SELECT `cb`.`cabin_date_create` AS `tanggal`,
          `cb`.`cabin_gudang` AS `asal`,
          `cb`.`cabin_gudang` AS `tujuan`,
          `cb`.`cabin_gudang` AS `gudang`,
          `cb`.`cabin_bukti` AS `no_bukti`,
          'pakai cabin' AS `jenis_transaksi`,
          'Tertutup' AS `status`,
          `cb`.`cabin_produk` AS `produk`,
          `cb`.`cabin_satuan` AS `satuan`,
          0 AS `jml_terima_barang`,
          0 AS `jml_terima_bonus`,
          0 AS `jml_retur_beli`,
          0 AS `jml_mutasi_masuk`,
          0 AS `jml_mutasi_keluar`,
          0 AS `jml_koreksi_stok`,
          0 AS `jml_jual_produk`,
          0 AS `jml_jual_grooming`,
          0 AS `jml_retur_produk`,
          0 AS `jml_retur_paket`,
          `cb`.`cabin_jumlah` AS `jml_pakai_cabin`,
          'pakai cabin' AS `keterangan`
     FROM `miracledb`.`detail_pakai_cabin` `cb`;