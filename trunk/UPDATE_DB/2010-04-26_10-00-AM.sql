
-- vu_detail_terima_produk
CREATE OR REPLACE VIEW `vu_detail_terima_produk` AS select `master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah`,`detail_terima_beli`.`dterima_id` AS `dterima_id`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,`supplier`.`supplier_id` AS `supplier_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`supplier`.`supplier_akun` AS `supplier_akun`,`vu_produk`.`produk_id` AS `produk_id` from ((((`detail_terima_beli` join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_beli`.`dterima_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_beli`.`dterima_satuan` = `satuan`.`satuan_id`)));

-- vu_detail_terima_bonus

CREATE OR REPLACE VIEW `vu_detail_terima_bonus` AS select `master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_bonus`.`dtbonus_id` AS `dtbonus_id`,`detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,`detail_terima_bonus`.`dtbonus_produk` AS `dtbonus_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_terima_bonus`.`dtbonus_satuan` AS `dtbonus_satuan`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_bonus`.`dtbonus_jumlah` AS `dtbonus_jumlah`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_akun` AS `supplier_akun`,`vu_produk`.`produk_id` AS `produk_id` from ((((`detail_terima_bonus` join `master_terima_beli` on((`detail_terima_bonus`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_bonus`.`dtbonus_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_bonus`.`dtbonus_satuan` = `satuan`.`satuan_id`)));

-- vu_detail_terima_order
CREATE OR REPLACE VIEW `vu_detail_terima_order` AS select `detail_terima_beli`.`dterima_produk` AS `dterima_produk`,sum(`detail_terima_beli`.`dterima_jumlah`) AS `jumlah_terima`,`detail_order_beli`.`dorder_master` AS `dorder_master` from ((`detail_terima_beli` join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `detail_order_beli` on(((`detail_terima_beli`.`dterima_produk` = `detail_order_beli`.`dorder_produk`) and (`master_terima_beli`.`terima_order` = `detail_order_beli`.`dorder_master`)))) group by `detail_order_beli`.`dorder_master`,`detail_terima_beli`.`dterima_produk`;

-- vu_detail_order

CREATE OR REPLACE VIEW `vu_detail_order_beli` AS select `supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_akun` AS `supplier_akun`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`detail_order_beli`.`dorder_master` AS `dorder_master`,`detail_order_beli`.`dorder_produk` AS `dorder_produk`,`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,`detail_order_beli`.`dorder_jumlah` AS `jumlah_barang`,`detail_order_beli`.`dorder_harga` AS `harga_satuan`,`detail_order_beli`.`dorder_diskon` AS `diskon`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`vu_produk`.`produk_kodelama` AS `produk_kodelama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`jenis_kelompok` AS `jenis_kelompok`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_diskon`) * `detail_order_beli`.`dorder_harga`) AS `diskon_nilai`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_harga`) * (100 - `detail_order_beli`.`dorder_diskon`)) AS `subtotal`,`supplier`.`supplier_id` AS `supplier_id`,`master_order_beli`.`order_no` AS `no_bukti`,ifnull(`vu_detail_terima_order`.`jumlah_terima`,0) AS `jumlah_terima` from (((((`detail_order_beli` join `master_order_beli` on((`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`))) join `satuan` on((`detail_order_beli`.`dorder_satuan` = `satuan`.`satuan_id`))) join `vu_produk` on((`detail_order_beli`.`dorder_produk` = `vu_produk`.`produk_id`))) left join `vu_detail_terima_order` on(((`detail_order_beli`.`dorder_produk` = `vu_detail_terima_order`.`dterima_produk`) and (`detail_order_beli`.`dorder_master` = `vu_detail_terima_order`.`dorder_master`))));

-- vu_detail_retur_beli
CREATE OR REPLACE VIEW `vu_detail_retur_beli` AS select `master_retur_beli`.`rbeli_nobukti` AS `no_bukti`,`master_retur_beli`.`rbeli_tanggal` AS `tanggal`,`master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_beli`.`drbeli_jumlah` AS `drbeli_jumlah`,`detail_retur_beli`.`drbeli_jumlah` AS `jumlah_barang`,`detail_retur_beli`.`drbeli_harga` AS `drbeli_harga`,`detail_retur_beli`.`drbeli_diskon` AS `drbeli_diskon`,`detail_retur_beli`.`drbeli_diskon` AS `diskon`,`detail_retur_beli`.`drbeli_harga` AS `harga_satuan`,(((`detail_retur_beli`.`drbeli_diskon` * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) / 100) AS `diskon_nilai`,((((100 - `detail_retur_beli`.`drbeli_diskon`) / 100) * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) AS `subtotal`,`supplier`.`supplier_akun` AS `supplier_akun` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_retur_beli`.`drbeli_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_retur_beli`.`drbeli_satuan` = `satuan`.`satuan_id`)));


-- vu_detail_terima_all

CREATE OR REPLACE VIEW `vu_detail_terima_all` AS select `vu_detail_terima_produk`.`produk_id` AS `produk_id`,`vu_detail_terima_produk`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_produk`.`terima_no` AS `no_bukti`,`vu_detail_terima_produk`.`supplier_id` AS `supplier_id`,`vu_detail_terima_produk`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_produk`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_produk`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_produk`.`produk_kode` AS `produk_kode`,`vu_detail_terima_produk`.`produk_nama` AS `produk_nama`,`vu_detail_terima_produk`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_produk`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_produk`.`dterima_jumlah` AS `jumlah`,`vu_detail_terima_produk`.`terima_tanggal` AS `tanggal`,_utf8'produk' AS `jenis` from `vu_detail_terima_produk` union select `vu_detail_terima_bonus`.`produk_id` AS `produk_id`,`vu_detail_terima_bonus`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_bonus`.`terima_no` AS `no_bukti`,`vu_detail_terima_bonus`.`supplier_id` AS `supplier_id`,`vu_detail_terima_bonus`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_bonus`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_bonus`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_bonus`.`produk_kode` AS `produk_kode`,`vu_detail_terima_bonus`.`produk_nama` AS `produk_nama`,`vu_detail_terima_bonus`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_bonus`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_bonus`.`dtbonus_jumlah` AS `jumlah`,`vu_detail_terima_bonus`.`terima_tanggal` AS `tanggal`,_utf8'bonus' AS `jenis` from `vu_detail_terima_bonus`;

-- vu_trans_order
CREATE OR REPLACE VIEW `vu_trans_order` AS select `master_order_beli`.`order_no` AS `no_bukti`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,ifnull(`master_order_beli`.`order_diskon`,0) AS `order_diskon`,ifnull(`master_order_beli`.`order_biaya`,0) AS `order_biaya`,ifnull(`master_order_beli`.`order_bayar`,0) AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`master_order_beli`.`order_status` AS `order_status`,`vu_total_order_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_order_group`.`total_nilai` AS `total_nilai`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_kodepos` AS `supplier_kodepos`,`supplier`.`supplier_propinsi` AS `supplier_propinsi`,`supplier`.`supplier_negara` AS `supplier_negara`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_notelp2` AS `supplier_notelp2`,`supplier`.`supplier_nofax` AS `supplier_nofax`,`supplier`.`supplier_email` AS `supplier_email`,`supplier`.`supplier_website` AS `supplier_website`,`supplier`.`supplier_cp` AS `supplier_cp`,`supplier`.`supplier_contact_cp` AS `supplier_contact_cp`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_keterangan` AS `supplier_keterangan`,`master_order_beli`.`order_id` AS `order_id`,ifnull(`master_order_beli`.`order_cashback`,0) AS `order_cashback`,`supplier`.`supplier_id` AS `supplier_id` from ((`master_order_beli` join `vu_total_order_group` on((`vu_total_order_group`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`)));

-- vu_trans_terima
CREATE OR REPLACE VIEW `vu_trans_terima` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `no_bukti`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,ifnull(`vu_total_terima_bonus_group`.`jumlah_barang_bonus`,0) AS `jumlah_barang_bonus`,`vu_total_terima_group`.`jumlah_barang` AS `jumlah_barang` from ((((`master_terima_beli` join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `master_order_beli` on((`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`))) left join `vu_total_terima_bonus_group` on((`vu_total_terima_bonus_group`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `vu_total_terima_group` on((`vu_total_terima_group`.`dterima_master` = `master_terima_beli`.`terima_id`)));

-- vu_trans_terima_jual
CREATE OR REPLACE DEFINER VIEW `vu_trans_terima_jual` AS select `jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,`jual_tunai`.`jtunai_date_create` AS `tanggal`,`jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_tunai` union select `jual_card`.`jcard_transaksi` AS `jenis_transaksi`,`jual_card`.`jcard_date_create` AS `tanggal`,0 AS `nilai_tunai`,`jual_card`.`jcard_nilai` AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_card` union select `jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,`jual_cek`.`jcek_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,`jual_cek`.`jcek_nilai` AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_cek` union select `jual_transfer`.`jtransfer_transaksi` AS `jenis_transaksi`,`jual_transfer`.`jtransfer_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,`jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_transfer` union select `jual_kwitansi`.`jkwitansi_transaksi` AS `jenis_transaksi`,`jual_kwitansi`.`jkwitansi_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,`jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_kwitansi` union select `voucher_terima`.`tvoucher_transaksi` AS `jenis_transaksi`,`voucher_terima`.`tvoucher_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,`voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,0 AS `nilai_kredit` from `voucher_terima` union select `jual_kredit`.`jkredit_transaksi` AS `jenis_transaksi`,`jual_kredit`.`jkredit_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,`jual_kredit`.`jkredit_nilai` AS `nilai_kredit` from `jual_kredit`;
