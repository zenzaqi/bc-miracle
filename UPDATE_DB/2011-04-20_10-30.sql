select `mt`.`terima_tanggal` AS `tanggal`,`mt`.`terima_supplier` AS `asal`,1 AS `tujuan`,`mt`.`terima_gudang_id` AS `gudang`,`mt`.`terima_no` AS `no_bukti`,_utf8'PB' AS `jenis_transaksi`,`mt`.`terima_status` AS `status`,`dt`.`dterima_produk` AS `produk`,`dt`.`dterima_satuan` AS `satuan`,`dt`.`dterima_jumlah` AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'beli' AS `keterangan`,`dt`.`dterima_id` AS `detail_id` from (`detail_terima_beli` `dt` join `master_terima_beli` `mt`) where (`dt`.`dterima_master` = `mt`.`terima_id`) union select `mt`.`terima_tanggal` AS `tanggal`,`mt`.`terima_supplier` AS `asal`,1 AS `tujuan`,`mt`.`terima_gudang_id` AS `gudang`,`mt`.`terima_no` AS `no_bukti`,_utf8'PB' AS `jenis_transaksi`,`mt`.`terima_status` AS `status`,`db`.`dtbonus_produk` AS `produk`,`db`.`dtbonus_satuan` AS `satuan`,0 AS `jml_terima_barang`,`db`.`dtbonus_jumlah` AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'bonus' AS `keterangan`,`db`.`dtbonus_id` AS `detail_id` from (`detail_terima_bonus` `db` join `master_terima_beli` `mt`) where (`db`.`dtbonus_master` = `mt`.`terima_id`) union select `mr`.`rbeli_tanggal` AS `tanggal`,`mr`.`rbeli_supplier` AS `asal`,1 AS `tujuan`,1 AS `gudang`,`mr`.`rbeli_nobukti` AS `no_bukti`,_utf8'RB' AS `jenis_transaksi`,`mr`.`rbeli_status` AS `status`,`dr`.`drbeli_produk` AS `produk`,`dr`.`drbeli_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,`dr`.`drbeli_jumlah` AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'retur' AS `keterangan`,`dr`.`drbeli_id` AS `detail_id` from (`detail_retur_beli` `dr` join `master_retur_beli` `mr`) where (`dr`.`drbeli_master` = `mr`.`rbeli_id`) union select `mmm`.`mutasi_tanggal` AS `tanggal`,`mmm`.`mutasi_asal` AS `asal`,`mmm`.`mutasi_tujuan` AS `tujuan`,`mmm`.`mutasi_tujuan` AS `gudang`,`mmm`.`mutasi_no` AS `no_bukti`,_utf8'mutasi' AS `jenis_transaksi`,`mmm`.`mutasi_status` AS `status`,`dmm`.`dmutasi_produk` AS `produk`,`dmm`.`dmutasi_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,`dmm`.`dmutasi_jumlah` AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'mutasi masuk' AS `keterangan`,`dmm`.`dmutasi_id` AS `detail_id` from (`master_mutasi` `mmm` join `detail_mutasi` `dmm`) where (`dmm`.`dmutasi_master` = `mmm`.`mutasi_id`) union select `mmk`.`mutasi_tanggal` AS `tanggal`,`mmk`.`mutasi_asal` AS `asal`,`mmk`.`mutasi_tujuan` AS `tujuan`,`mmk`.`mutasi_asal` AS `gudang`,`mmk`.`mutasi_no` AS `no_bukti`,_utf8'mutasi' AS `jenis_transaksi`,`mmk`.`mutasi_status` AS `status`,`dmk`.`dmutasi_produk` AS `produk`,`dmk`.`dmutasi_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,`dmk`.`dmutasi_jumlah` AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'mutasi keluar' AS `keterangan`,`dmk`.`dmutasi_id` AS `detail_id` from (`master_mutasi` `mmk` join `detail_mutasi` `dmk`) where (`dmk`.`dmutasi_master` = `mmk`.`mutasi_id`) union select `mk`.`koreksi_tanggal` AS `tanggal`,`mk`.`koreksi_gudang` AS `asal`,`mk`.`koreksi_gudang` AS `tujuan`,`mk`.`koreksi_gudang` AS `gudang`,`mk`.`koreksi_no` AS `no_bukti`,_utf8'koreksi' AS `jenis_transaksi`,`mk`.`koreksi_status` AS `status`,`dk`.`dkoreksi_produk` AS `produk`,`dk`.`dkoreksi_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,`dk`.`dkoreksi_jmlkoreksi` AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'koreksi' AS `keterangan`,`dk`.`dkoreksi_id` AS `detail_id` from (`master_koreksi_stok` `mk` join `detail_koreksi_stok` `dk`) where (`mk`.`koreksi_id` = `dk`.`dkoreksi_master`) union select `mj`.`jproduk_tanggal` AS `tanggal`,2 AS `asal`,`mj`.`jproduk_cust` AS `tujuan`,2 AS `gudang`,`mj`.`jproduk_nobukti` AS `no_bukti`,_utf8'jual produk' AS `jenis_traksaksi`,`mj`.`jproduk_stat_dok` AS `status`,`dj`.`dproduk_produk` AS `produk`,`dj`.`dproduk_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,`dj`.`dproduk_jumlah` AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'customer' AS `keterangan`,`dj`.`dproduk_id` AS `detail_id` from (`master_jual_produk` `mj` join `detail_jual_produk` `dj`) where (`dj`.`dproduk_master` = `mj`.`jproduk_id`) union select `mjg`.`jpgrooming_tanggal` AS `tanggal`,2 AS `asal`,`mjg`.`jpgrooming_karyawan` AS `tujuan`,2 AS `gudang`,`mjg`.`jpgrooming_nobukti` AS `no_bukti`,_utf8'jual produk' AS `jenis_transaksi`,_utf8'Tertutup' AS `status`,`djg`.`dpgrooming_produk` AS `produk`,`djg`.`dpgrooming_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,`djg`.`dpgrooming_jumlah` AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'grooming' AS `keterangan`,`djg`.`dpgrooming_id` AS `detail_id` from (`master_jualproduk_grooming` `mjg` join `detail_jualproduk_grooming` `djg`) where (`mjg`.`jpgrooming_id` = `djg`.`dpgrooming_master`) union select `mrj`.`rproduk_tanggal` AS `tanggal`,`mrj`.`rproduk_cust` AS `asal`,2 AS `tujuan`,2 AS `gudang`,`mrj`.`rproduk_nobukti` AS `no_bukti`,_utf8'retur jual' AS `jenis_transaksi`,`mrj`.`rproduk_stat_dok` AS `status`,`drj`.`drproduk_produk` AS `produk`,`drj`.`drproduk_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,`drj`.`drproduk_jumlah` AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'produk retur' AS `keterangan`,`drj`.`drproduk_id` AS `detail_id` from (`master_retur_jual_produk` `mrj` join `detail_retur_jual_produk` `drj`) where (`mrj`.`rproduk_id` = `drj`.`drproduk_master`) union select `mrp`.`rpaket_tanggal` AS `tanggal`,`mrp`.`rpaket_cust` AS `asal`,2 AS `tujuan`,2 AS `gudang`,`mrp`.`rpaket_nobukti` AS `no_bukti`,_utf8'retur jual' AS `jenis_transaksi`,`mrp`.`rpaket_stat_dok` AS `status`,`drp`.`drpaket_produk` AS `produk`,`drp`.`drpaket_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,`drp`.`drpaket_jumlah` AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,_utf8'paket retur' AS `keterangan`,`drp`.`drpaket_id` AS `detail_id` from (`master_retur_jual_paket` `mrp` join `detail_retur_paket_produk` `drp`) where (`mrp`.`rpaket_id` = `drp`.`drpaket_master`) union select `cb`.`cabin_date_create` AS `tanggal`,`cb`.`cabin_gudang` AS `asal`,`cb`.`cabin_cust` AS `tujuan`,`cb`.`cabin_gudang` AS `gudang`,`cb`.`cabin_bukti` AS `no_bukti`,_utf8'pakai cabin' AS `jenis_transaksi`,_utf8'Tertutup' AS `status`,`cb`.`cabin_produk` AS `produk`,`cb`.`cabin_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,`cb`.`cabin_jumlah` AS `jml_pakai_cabin`,_utf8'pakai cabin' AS `keterangan`,`cb`.`cabin_dtrawat` AS `detail_id` from `detail_pakai_cabin` `cb`