--
-- Structure for view `vu_akun`
--
DROP VIEW IF EXISTS `vu_akun`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_akun` AS select `akun`.`akun_id` AS `akun_id`,`akun`.`akun_kode` AS `akun_kode`,`akun`.`akun_jenis` AS `akun_jenis`,`akun`.`akun_parent` AS `akun_parent`,`akun_parent`.`akun_id` AS `parent_d`,`akun_parent`.`akun_kode` AS `parent_kode`,`akun_parent`.`akun_jenis` AS `parent_jenis`,`akun_parent`.`akun_nama` AS `parent_nama`,`akun_parent`.`akun_level` AS `parent_level`,`akun`.`akun_level` AS `akun_level`,`akun`.`akun_nama` AS `akun_nama`,`akun`.`akun_debet` AS `akun_debet`,`akun`.`akun_kredit` AS `akun_kredit`,`akun`.`akun_saldo` AS `akun_saldo`,`akun`.`akun_aktif` AS `akun_aktif`,`akun`.`akun_creator` AS `akun_creator`,`akun`.`akun_date_create` AS `akun_date_create`,`akun`.`akun_update` AS `akun_update`,`akun`.`akun_date_update` AS `akun_date_update` from (`akun` left join `akun` `akun_parent` on((`akun`.`akun_parent` = `akun_parent`.`akun_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_appointment`
--
DROP VIEW IF EXISTS `vu_appointment`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_appointment` AS select `appointment`.`app_id` AS `app_id`,`appointment`.`app_tanggal` AS `app_tanggal`,`appointment`.`app_cara` AS `app_cara`,`appointment`.`app_keterangan` AS `app_keterangan`,`appointment`.`app_customer` AS `app_customer`,`appointment`.`app_creator` AS `app_creator`,`appointment`.`app_date_create` AS `app_date_create`,`appointment`.`app_update` AS `app_update`,`appointment`.`app_date_update` AS `app_date_update`,`appointment`.`app_revised` AS `app_revised`,`appointment_detail`.`dapp_id` AS `dapp_id`,`appointment_detail`.`dapp_status` AS `dapp_status`,`appointment_detail`.`dapp_tglreservasi` AS `dapp_tglreservasi`,`appointment_detail`.`dapp_jamdatang` AS `dapp_jamdatang`,`appointment_detail`.`dapp_jamreservasi` AS `dapp_jamreservasi`,`appointment_detail`.`dapp_keterangan` AS `dapp_keterangan`,`appointment_detail`.`dapp_counter` AS `dapp_counter`,`appointment_detail`.`dapp_warna_terapis` AS `dapp_warna_terapis`,`perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_warna` AS `rawat_warna`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`kategori`.`kategori_nama` AS `kategori_nama`,`karyawan_dokter`.`karyawan_nama` AS `dokter_nama`,`karyawan_dokter`.`karyawan_id` AS `dokter_id`,`karyawan_dokter`.`karyawan_username` AS `dokter_username`,`karyawan_dokter`.`karyawan_no` AS `dokter_no`,`karyawan_terapis`.`karyawan_nama` AS `terapis_nama`,`karyawan_terapis`.`karyawan_id` AS `terapis_id`,`karyawan_terapis`.`karyawan_username` AS `terapis_username`,`karyawan_terapis`.`karyawan_no` AS `terapis_no` from ((((((`appointment` join `appointment_detail` on((`appointment`.`app_id` = `appointment_detail`.`dapp_master`))) join `perawatan` on((`appointment_detail`.`dapp_perawatan` = `perawatan`.`rawat_id`))) join `customer` on((`appointment`.`app_customer` = `customer`.`cust_id`))) join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `karyawan` `karyawan_dokter` on((`appointment_detail`.`dapp_petugas` = `karyawan_dokter`.`karyawan_id`))) left join `karyawan` `karyawan_terapis` on((`appointment_detail`.`dapp_petugas2` = `karyawan_terapis`.`karyawan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_customer`
--
DROP VIEW IF EXISTS `vu_customer`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_customer` AS select `customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`member`.`member_no` AS `member_no`,`member`.`member_valid` AS `member_valid`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`customer`.`cust_kodepos` AS `cust_kodepos`,`customer`.`cust_propinsi` AS `cust_propinsi`,`customer`.`cust_negara` AS `cust_negara`,`customer`.`cust_alamat2` AS `cust_alamat2`,`customer`.`cust_kota2` AS `cust_kota2`,`customer`.`cust_kodepos2` AS `cust_kodepos2`,`customer`.`cust_propinsi2` AS `cust_propinsi2`,`customer`.`cust_negara2` AS `cust_negara2`,`customer`.`cust_telprumah` AS `cust_telprumah`,`customer`.`cust_telprumah2` AS `cust_telprumah2`,`customer`.`cust_telpkantor` AS `cust_telpkantor`,`customer`.`cust_hp` AS `cust_hp`,`customer`.`cust_hp2` AS `cust_hp2`,`customer`.`cust_hp3` AS `cust_hp3`,`customer`.`cust_email` AS `cust_email`,`customer`.`cust_fb` AS `cust_fb`,`customer`.`cust_tweeter` AS `cust_tweeter`,`customer`.`cust_email2` AS `cust_email2`,`customer`.`cust_fb2` AS `cust_fb2`,`customer`.`cust_tweeter2` AS `cust_tweeter2`,`customer`.`cust_agama` AS `cust_agama`,`customer`.`cust_pendidikan` AS `cust_pendidikan`,`customer`.`cust_profesi` AS `cust_profesi`,`customer`.`cust_tmptlahir` AS `cust_tmptlahir`,`customer`.`cust_tgllahir` AS `cust_tgllahir`,(date_format(now(),_utf8'%Y') - date_format(`customer`.`cust_tgllahir`,_utf8'%Y')) AS `cust_umur`,`customer`.`cust_hobi` AS `cust_hobi`,`customer`.`cust_referensi` AS `cust_referensi`,`customer`.`cust_referensilain` AS `cust_referensilain`,`customer`.`cust_keterangan` AS `cust_keterangan`,`customer`.`cust_terdaftar` AS `cust_terdaftar`,`customer`.`cust_statusnikah` AS `cust_statusnikah`,`customer`.`cust_priority` AS `cust_priority`,`customer`.`cust_jmlanak` AS `cust_jmlanak`,`customer`.`cust_unit` AS `cust_unit`,`customer`.`cust_cp` AS `cust_cp`,`customer`.`cust_cptelp` AS `cust_cptelp`,`customer`.`cust_aktif` AS `cust_aktif`,`customer`.`cust_point` AS `cust_point`,`customer`.`cust_creator` AS `cust_creator`,`customer`.`cust_date_create` AS `cust_date_create`,`customer`.`cust_update` AS `cust_update`,`customer`.`cust_date_update` AS `cust_date_update`,`customer`.`cust_revised` AS `cust_revised`,`cust_ref`.`cust_nama` AS `cust_nama_ref`,`cabang`.`cabang_nama` AS `cabang_nama`,`cabang`.`cabang_alamat` AS `cabang_alamat` from (((`customer` left join `customer` `cust_ref` on((`customer`.`cust_referensi` = `cust_ref`.`cust_id`))) left join `cabang` on((`customer`.`cust_unit` = `cabang`.`cabang_id`))) left join `member` on((`member`.`member_id` = `customer`.`cust_member`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_ambil_paket`
--
DROP VIEW IF EXISTS `vu_detail_ambil_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_ambil_paket` AS select `detail_ambil_paket`.`dapaket_jpaket` AS `dapaket_jpaket`,`detail_ambil_paket`.`dapaket_dpaket` AS `dapaket_dpaket`,`detail_ambil_paket`.`dapaket_paket` AS `dapaket_paket`,`detail_ambil_paket`.`dapaket_item` AS `dapaket_item`,sum(`detail_ambil_paket`.`dapaket_jumlah`) AS `total_ambil_item` from `detail_ambil_paket` group by `detail_ambil_paket`.`dapaket_item`,`detail_ambil_paket`.`dapaket_jpaket`,`detail_ambil_paket`.`dapaket_dpaket`,`detail_ambil_paket`.`dapaket_paket`;

-- --------------------------------------------------------

--
-- Structure for view `vu_produk`
--
DROP VIEW IF EXISTS `vu_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_produk` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_keterangan` AS `produk_keterangan`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_creator` AS `produk_creator`,`produk`.`produk_date_create` AS `produk_date_create`,`produk`.`produk_update` AS `produk_update`,`produk`.`produk_date_update` AS `produk_date_update`,`produk`.`poduk_revised` AS `poduk_revised`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_duproduk` AS `group_duproduk`,`produk_group`.`group_dmproduk` AS `group_dmproduk`,`produk_group`.`group_kelompok` AS `group_kelompok`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`jenis`.`jenis_id` AS `jenis_id`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`kategori2`.`kategori2_id` AS `kategori2_id`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis` from (((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_invoice`
--
DROP VIEW IF EXISTS `vu_detail_invoice`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_no` AS `no_bukti`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_tanggal` AS `tanggal`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,`detail_invoice`.`dinvoice_jumlah` AS `jumlah_barang`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,`detail_invoice`.`dinvoice_harga` AS `harga_satuan`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`detail_invoice`.`dinvoice_diskon` AS `diskon`,(((`detail_invoice`.`dinvoice_diskon` * `detail_invoice`.`dinvoice_jumlah`) * `detail_invoice`.`dinvoice_harga`) / 100) AS `diskon_nilai`,`satuan`.`satuan_id` AS `satuan_id`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`jenis_nama` AS `jenis_nama`,(((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100) AS `subtotal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_email` AS `supplier_email` from (((((`detail_invoice` join `master_invoice` on((`detail_invoice`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_produk` on((`detail_invoice`.`dinvoice_produk` = `vu_produk`.`produk_id`))) join `master_terima_beli` on((`master_invoice`.`invoice_noterima` = `master_terima_beli`.`terima_id`))) join `satuan` on((`detail_invoice`.`dinvoice_satuan` = `satuan`.`satuan_id`))) join `supplier` on((`supplier`.`supplier_id` = `master_terima_beli`.`terima_supplier`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_invoice_konversi`
--
DROP VIEW IF EXISTS `vu_detail_invoice_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_invoice_konversi` AS select `detail_invoice`.`dinvoice_id` AS `dinvoice_id`,`detail_invoice`.`dinvoice_master` AS `dinvoice_master`,`detail_invoice`.`dinvoice_produk` AS `dinvoice_produk`,`detail_invoice`.`dinvoice_satuan` AS `dinvoice_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`detail_invoice`.`dinvoice_jumlah` AS `dinvoice_jumlah`,(`satuan_konversi`.`konversi_nilai` * `detail_invoice`.`dinvoice_jumlah`) AS `jumlah_konversi`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,(`detail_invoice`.`dinvoice_harga` / `satuan_konversi`.`konversi_nilai`) AS `harga_satuan_konversi`,(((`detail_invoice`.`dinvoice_harga` / `satuan_konversi`.`konversi_nilai`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100) AS `hraga_satuan_konversi_bersih`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`satuan_konversi`.`konversi_default` AS `konversi_default` from (`satuan_konversi` join `detail_invoice` on(((`detail_invoice`.`dinvoice_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_invoice`.`dinvoice_satuan` = `satuan_konversi`.`konversi_satuan`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_jualproduk_grooming`
--
DROP VIEW IF EXISTS `vu_detail_jualproduk_grooming`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_jualproduk_grooming` AS select `detail_jualproduk_grooming`.`dpgrooming_id` AS `dpgrooming_id`,`detail_jualproduk_grooming`.`dpgrooming_master` AS `dpgrooming_master`,`detail_jualproduk_grooming`.`dpgrooming_produk` AS `dpgrooming_produk`,`detail_jualproduk_grooming`.`dpgrooming_satuan` AS `dpgrooming_satuan`,`detail_jualproduk_grooming`.`dpgrooming_jumlah` AS `jumlah_barang`,`detail_jualproduk_grooming`.`dpgrooming_harga` AS `harga_satuan`,`detail_jualproduk_grooming`.`dpgrooming_diskon` AS `diskon`,`detail_jualproduk_grooming`.`dpgrooming_diskon_jenis` AS `diskon_jenis`,`detail_jualproduk_grooming`.`dpgrooming_sales` AS `sales`,`master_jualproduk_grooming`.`jpgrooming_nobukti` AS `no_bukti`,`master_jualproduk_grooming`.`jpgrooming_tanggal` AS `tanggal`,`karyawan`.`karyawan_id` AS `karyawan_id`,`karyawan`.`karyawan_no` AS `karyawan_no`,`karyawan`.`karyawan_username` AS `karyawan_username`,`karyawan`.`karyawan_nama` AS `karyawan_nama`,`karyawan`.`karyawan_kelamin` AS `karyawan_kelamin`,`karyawan`.`karyawan_alamat` AS `karyawan_alamat`,`karyawan`.`karyawan_kota` AS `karyawan_kota`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_du` AS `produk_du`,`vu_produk`.`produk_dm` AS `produk_dm`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_harga` AS `produk_harga`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`satuan`.`satuan_nama` AS `satuan_nama`,(((`detail_jualproduk_grooming`.`dpgrooming_harga` * `detail_jualproduk_grooming`.`dpgrooming_diskon`) / 100) * `detail_jualproduk_grooming`.`dpgrooming_jumlah`) AS `diskon_nilai`,((`detail_jualproduk_grooming`.`dpgrooming_harga` * `detail_jualproduk_grooming`.`dpgrooming_jumlah`) - (((`detail_jualproduk_grooming`.`dpgrooming_harga` * `detail_jualproduk_grooming`.`dpgrooming_diskon`) / 100) * `detail_jualproduk_grooming`.`dpgrooming_jumlah`)) AS `subtotal`,`master_jualproduk_grooming`.`jpgrooming_id` AS `jproduk_id` from ((((`detail_jualproduk_grooming` join `master_jualproduk_grooming` on((`detail_jualproduk_grooming`.`dpgrooming_master` = `master_jualproduk_grooming`.`jpgrooming_id`))) join `karyawan` on((`master_jualproduk_grooming`.`jpgrooming_karyawan` = `karyawan`.`karyawan_id`))) join `vu_produk` on((`vu_produk`.`produk_id` = `detail_jualproduk_grooming`.`dpgrooming_id`))) join `satuan` on((`detail_jualproduk_grooming`.`dpgrooming_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_jual_paket`
--
DROP VIEW IF EXISTS `vu_detail_jual_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_jual_paket` AS select `detail_jual_paket`.`dpaket_master` AS `dpaket_master`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,`paket`.`paket_nama` AS `produk_nama`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`detail_jual_paket`.`dpaket_jumlah` AS `jumlah_barang`,`detail_jual_paket`.`dpaket_harga` AS `harga_satuan`,`detail_jual_paket`.`dpaket_diskon` AS `dpaket_diskon`,`detail_jual_paket`.`dpaket_diskon_jenis` AS `diskon_jenis`,`detail_jual_paket`.`dpaket_sales` AS `sales`,`master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`paket`.`paket_kode` AS `produk_kode`,_utf8'paket' AS `satuan_nama`,`detail_jual_paket`.`dpaket_diskon` AS `diskon`,(((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * `detail_jual_paket`.`dpaket_diskon`) / 100) AS `diskon_nilai`,((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) - (((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * `detail_jual_paket`.`dpaket_diskon`) / 100)) AS `subtotal`,`master_jual_paket`.`jpaket_tanggal` AS `tanggal`,`customer`.`cust_id` AS `cust_id` from ((((`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`))) left join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) left join `kategori2` on((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_jual_produk`
--
DROP VIEW IF EXISTS `vu_detail_jual_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_jual_produk` AS select `detail_jual_produk`.`dproduk_id` AS `dproduk_id`,`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`detail_jual_produk`.`dproduk_jumlah` AS `jumlah_barang`,`detail_jual_produk`.`dproduk_harga` AS `harga_satuan`,`detail_jual_produk`.`dproduk_diskon` AS `diskon`,`detail_jual_produk`.`dproduk_diskon_jenis` AS `diskon_jenis`,`karyawan`.`karyawan_username` AS `sales`,`master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan`.`satuan_nama` AS `satuan_nama`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,(((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) / 100) * `detail_jual_produk`.`dproduk_jumlah`)) AS `diskon_nilai`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,(((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_jumlah`) - (((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) / 100) * `detail_jual_produk`.`dproduk_jumlah`)) * `detail_jual_produk`.`konversi_nilai_temp`)) AS `subtotal`,`master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok` from (((((`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) left join `customer` on((`master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`))) left join `produk` on((`detail_jual_produk`.`dproduk_produk` = `produk`.`produk_id`))) left join `satuan` on((`detail_jual_produk`.`dproduk_satuan` = `satuan`.`satuan_id`))) left join `karyawan` on((`detail_jual_produk`.`dproduk_karyawan` = `karyawan`.`karyawan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_perawatan`
--
DROP VIEW IF EXISTS `vu_perawatan`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_perawatan` AS select `perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_kode` AS `rawat_kode`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_group` AS `rawat_group`,`perawatan`.`rawat_kontribusi` AS `rawat_kontribusi`,`perawatan`.`rawat_kategori` AS `rawat_kategori`,`perawatan`.`rawat_jenis` AS `rawat_jenis`,`perawatan`.`rawat_kodelama` AS `rawat_kodelama`,`perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`perawatan`.`rawat_point` AS `rawat_point`,`perawatan`.`rawat_kredit` AS `rawat_kredit`,`perawatan`.`rawat_jumlah_tindakan` AS `rawat_jumlah_tindakan`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_gudang` AS `rawat_gudang`,`perawatan`.`rawat_aktif` AS `rawat_aktif`,`perawatan`.`rawat_creator` AS `rawat_creator`,`perawatan`.`rawat_date_create` AS `rawat_date_create`,`perawatan`.`rawat_update` AS `rawat_update`,`perawatan`.`rawat_date_update` AS `rawat_date_update`,`perawatan`.`rawat_revised` AS `rawat_revised`,`perawatan`.`rawat_warna` AS `rawat_warna`,`produk_group`.`group_id` AS `group_id`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_duproduk` AS `group_duproduk`,`produk_group`.`group_dmproduk` AS `group_dmproduk`,`produk_group`.`group_durawat` AS `group_durawat`,`produk_group`.`group_dmrawat` AS `group_dmrawat`,`produk_group`.`group_dupaket` AS `group_dupaket`,`produk_group`.`group_dmpaket` AS `group_dmpaket`,`produk_group`.`group_kelompok` AS `group_kelompok`,`produk_group`.`group_keterangan` AS `group_keterangan`,`produk_group`.`group_aktif` AS `group_aktif`,`produk_group`.`group_creator` AS `group_creator`,`produk_group`.`group_date_create` AS `group_date_create`,`produk_group`.`group_update` AS `group_update`,`produk_group`.`group_date_update` AS `group_date_update`,`produk_group`.`group_revised` AS `group_revised`,`kategori2`.`kategori2_id` AS `kategori2_id`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`kategori2`.`kategori2_keterangan` AS `kategori2_keterangan`,`kategori2`.`kategori2_aktif` AS `kategori2_aktif`,`kategori2`.`kategori2_creator` AS `kategori2_creator`,`kategori2`.`kategori2_date_create` AS `kategori2_date_create`,`kategori2`.`kategori2_update` AS `kategori2_update`,`kategori2`.`kategori2_date_update` AS `kategori2_date_update`,`kategori2`.`kategori2_revised` AS `kategori2_revised`,`kategori`.`kategori_id` AS `kategori_id`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`kategori`.`kategori_keterangan` AS `kategori_keterangan`,`kategori`.`kategori_aktif` AS `kategori_aktif`,`kategori`.`kategori_creator` AS `kategori_creator`,`kategori`.`kategori_date_create` AS `kategori_date_create`,`kategori`.`kategori_update` AS `kategori_update`,`kategori`.`kategori_date_update` AS `kategori_date_update`,`kategori`.`kategori_revised` AS `kategori_revised`,`jenis`.`jenis_id` AS `jenis_id`,`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`jenis`.`jenis_keterangan` AS `jenis_keterangan`,`jenis`.`jenis_aktif` AS `jenis_aktif`,`jenis`.`jenis_creator` AS `jenis_creator`,`jenis`.`jenis_date_create` AS `jenis_date_create`,`jenis`.`jenis_update` AS `jenis_update`,`jenis`.`jenis_date_update` AS `jenis_date_update`,`jenis`.`jenis_revised` AS `jenis_revised`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi`,`gudang`.`gudang_keterangan` AS `gudang_keterangan`,`gudang`.`gudang_aktif` AS `gudang_aktif`,`gudang`.`gudang_creator` AS `gudang_creator`,`gudang`.`gudang_date_create` AS `gudang_date_create`,`gudang`.`gudang_update` AS `gudang_update`,`gudang`.`gudang_date_update` AS `gudang_date_update`,`gudang`.`gudang_revised` AS `gudang_revised` from (((((`perawatan` left join `produk_group` on((`perawatan`.`rawat_group` = `produk_group`.`group_id`))) left join `kategori2` on((`perawatan`.`rawat_kontribusi` = `kategori2`.`kategori2_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) left join `jenis` on((`perawatan`.`rawat_jenis` = `jenis`.`jenis_id`))) left join `gudang` on((`perawatan`.`rawat_gudang` = `gudang`.`gudang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_jual_rawat`
--
DROP VIEW IF EXISTS `vu_detail_jual_rawat`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_jual_rawat` AS select `detail_jual_rawat`.`drawat_master` AS `drawat_master`,`detail_jual_rawat`.`drawat_rawat` AS `drawat_rawat`,`vu_perawatan`.`rawat_nama` AS `produk_nama`,`vu_perawatan`.`kategori2_nama` AS `kategori2_nama`,`vu_perawatan`.`kategori_nama` AS `kategori_nama`,`vu_perawatan`.`jenis_nama` AS `jenis_nama`,`detail_jual_rawat`.`drawat_jumlah` AS `jumlah_barang`,`detail_jual_rawat`.`drawat_harga` AS `harga_satuan`,`detail_jual_rawat`.`drawat_diskon` AS `drawat_diskon`,`detail_jual_rawat`.`drawat_diskon_jenis` AS `diskon_jenis`,if((`tindakan_detail`.`dtrawat_petugas1` = 0),if((`tindakan_detail`.`dtrawat_petugas2` = 0),NULL,`terapis`.`karyawan_username`),`dokter`.`karyawan_username`) AS `sales`,`master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`vu_perawatan`.`rawat_kode` AS `produk_kode`,'paket' AS `satuan_nama`,`detail_jual_rawat`.`drawat_diskon` AS `diskon`,(((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) * `detail_jual_rawat`.`drawat_diskon`) / 100) AS `diskon_nilai`,((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) - (((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) * `detail_jual_rawat`.`drawat_diskon`) / 100)) AS `subtotal`,`master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,`customer`.`cust_id` AS `cust_id` from ((((((`detail_jual_rawat` join `vu_perawatan` on((`vu_perawatan`.`rawat_id` = `detail_jual_rawat`.`drawat_rawat`))) join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) join `customer` on((`master_jual_rawat`.`jrawat_cust` = `customer`.`cust_id`))) left join `tindakan_detail` on((`detail_jual_rawat`.`drawat_dtrawat` = `tindakan_detail`.`dtrawat_id`))) left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_koreksi`
--
DROP VIEW IF EXISTS `vu_detail_koreksi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_koreksi` AS select `master_koreksi_stok`.`koreksi_id` AS `koreksi_id`,`master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,`master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`master_koreksi_stok`.`koreksi_keterangan` AS `koreksi_keterangan`,`master_koreksi_stok`.`koreksi_creator` AS `koreksi_creator`,`detail_koreksi_stok`.`dkoreksi_id` AS `dkoreksi_id`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlawal` AS `dkoreksi_jmlawal`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,`detail_koreksi_stok`.`dkoreksi_jmlsaldo` AS `dkoreksi_jmlsaldo`,`detail_koreksi_stok`.`dkoreksi_ket` AS `dkoreksi_ket` from (`detail_koreksi_stok` join `master_koreksi_stok` on((`master_koreksi_stok`.`koreksi_id` = `detail_koreksi_stok`.`dkoreksi_master`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_mutasi`
--
DROP VIEW IF EXISTS `vu_detail_mutasi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`asal`.`gudang_id` AS `gudang_asal_id`,`asal`.`gudang_nama` AS `gudang_asal_nama`,`asal`.`gudang_lokasi` AS `gudang_asala_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`tujuan`.`gudang_id` AS `gudang_tujuan_id`,`tujuan`.`gudang_nama` AS `gudang_tujuan_nama`,`tujuan`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`detail_mutasi`.`dmutasi_satuan` AS `dmutasi_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_nama` AS `produk_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah` from ((((((`detail_mutasi` join `master_mutasi` on((`detail_mutasi`.`dmutasi_master` = `master_mutasi`.`mutasi_id`))) join `gudang` `tujuan` on(((_utf8'' = _utf8'') and (`tujuan`.`gudang_id` = `master_mutasi`.`mutasi_tujuan`)))) join `gudang` `asal` on((`asal`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `satuan_konversi` on(((`detail_mutasi`.`dmutasi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_mutasi`.`dmutasi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `produk` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_terima_order`
--
DROP VIEW IF EXISTS `vu_detail_terima_order`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_terima_order` AS select `mo`.`order_id` AS `master_order`,`mt`.`terima_id` AS `master_terima`,`do`.`dorder_produk` AS `produk`,`do`.`dorder_satuan` AS `satuan`,`do`.`dorder_jumlah` AS `jumlah_order`,`dt`.`dterima_jumlah` AS `jumlah_terima`,(`do`.`dorder_jumlah` - `dt`.`dterima_jumlah`) AS `jumlah_sisa`,`do`.`dorder_harga` AS `harga`,`do`.`dorder_diskon` AS `diskon` from (((`detail_order_beli` `do` join `master_order_beli` `mo`) join `detail_terima_beli` `dt`) join `master_terima_beli` `mt`) where ((`do`.`dorder_master` = `mo`.`order_id`) and (`dt`.`dterima_master` = `mt`.`terima_id`) and (`mt`.`terima_order` = `mo`.`order_id`) and (`do`.`dorder_produk` = `dt`.`dterima_produk`) and (`do`.`dorder_satuan` = `dt`.`dterima_satuan`)) union select `mo`.`order_id` AS `master_order`,-(1) AS `master_terima`,`do`.`dorder_produk` AS `produk`,`do`.`dorder_satuan` AS `satuan`,`do`.`dorder_jumlah` AS `jumlah_order`,0 AS `jumlah_terima`,`do`.`dorder_jumlah` AS `jumlah_sisa`,`do`.`dorder_harga` AS `harga`,`do`.`dorder_diskon` AS `diskon` from (`detail_order_beli` `do` join `master_order_beli` `mo`) where ((`do`.`dorder_master` = `mo`.`order_id`) and (not((`do`.`dorder_produk`,`do`.`dorder_satuan`) in (select `dt`.`dterima_produk` AS `dterima_produk`,`dt`.`dterima_satuan` AS `dterima_satuan` from (`detail_terima_beli` `dt` join `master_terima_beli` `mt`) where ((`mt`.`terima_id` = `dt`.`dterima_master`) and (`mt`.`terima_order` = `mo`.`order_id`)))))) union select -(1) AS `master_order`,`mt`.`terima_id` AS `master_terima`,`dt`.`dterima_produk` AS `produk`,`dt`.`dterima_satuan` AS `satuan`,0 AS `jumlah_order`,`dt`.`dterima_jumlah` AS `jumlah_terima`,-(`dt`.`dterima_jumlah`) AS `jumlah_sisa`,0 AS `harga`,0 AS `diskon` from (`detail_terima_beli` `dt` join `master_terima_beli` `mt`) where ((`mt`.`terima_id` = `dt`.`dterima_master`) and (not((`dt`.`dterima_produk`,`dt`.`dterima_satuan`) in (select `do`.`dorder_produk` AS `dorder_produk`,`do`.`dorder_satuan` AS `dorder_satuan` from (`master_order_beli` `mo` join `detail_order_beli` `do`) where ((`mo`.`order_id` = `do`.`dorder_master`) and (`mo`.`order_id` = `mt`.`terima_order`))))));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_order_beli`
--
DROP VIEW IF EXISTS `vu_detail_order_beli`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_order_beli` AS select `supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_akun` AS `supplier_akun`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`detail_order_beli`.`dorder_master` AS `dorder_master`,`detail_order_beli`.`dorder_produk` AS `dorder_produk`,`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,`detail_order_beli`.`dorder_jumlah` AS `jumlah_barang`,`detail_order_beli`.`dorder_harga` AS `harga_satuan`,`detail_order_beli`.`dorder_diskon` AS `diskon`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`vu_produk`.`produk_kodelama` AS `produk_kodelama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`jenis_kelompok` AS `jenis_kelompok`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_diskon`) * `detail_order_beli`.`dorder_harga`) AS `diskon_nilai`,((`detail_order_beli`.`dorder_jumlah` * `detail_order_beli`.`dorder_harga`) * (100 - `detail_order_beli`.`dorder_diskon`)) AS `subtotal`,`supplier`.`supplier_id` AS `supplier_id`,`master_order_beli`.`order_no` AS `no_bukti`,ifnull(`vu_detail_terima_order`.`jumlah_terima`,0) AS `jumlah_terima`,ifnull(`vu_detail_terima_order`.`jumlah_sisa`,0) AS `jumlah_sisa` from (((((`detail_order_beli` join `master_order_beli` on((`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`))) join `satuan` on((`detail_order_beli`.`dorder_satuan` = `satuan`.`satuan_id`))) join `vu_produk` on((`detail_order_beli`.`dorder_produk` = `vu_produk`.`produk_id`))) left join `vu_detail_terima_order` on(((`detail_order_beli`.`dorder_produk` = `vu_detail_terima_order`.`produk`) and (`detail_order_beli`.`dorder_master` = `vu_detail_terima_order`.`master_order`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_retur_beli`
--
DROP VIEW IF EXISTS `vu_detail_retur_beli`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_retur_beli` AS select `master_retur_beli`.`rbeli_nobukti` AS `no_bukti`,`master_retur_beli`.`rbeli_tanggal` AS `tanggal`,`master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_retur_beli`.`drbeli_jumlah` AS `drbeli_jumlah`,`detail_retur_beli`.`drbeli_jumlah` AS `jumlah_barang`,`detail_retur_beli`.`drbeli_harga` AS `drbeli_harga`,`detail_retur_beli`.`drbeli_diskon` AS `drbeli_diskon`,`detail_retur_beli`.`drbeli_diskon` AS `diskon`,`detail_retur_beli`.`drbeli_harga` AS `harga_satuan`,(((`detail_retur_beli`.`drbeli_diskon` * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) / 100) AS `diskon_nilai`,((((100 - `detail_retur_beli`.`drbeli_diskon`) / 100) * `detail_retur_beli`.`drbeli_harga`) * `detail_retur_beli`.`drbeli_jumlah`) AS `subtotal`,`supplier`.`supplier_akun` AS `supplier_akun` from ((((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_retur_beli`.`drbeli_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_retur_beli`.`drbeli_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_retur_jual_produk`
--
DROP VIEW IF EXISTS `vu_detail_retur_jual_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_retur_jual_produk` AS select `detail_retur_jual_produk`.`drproduk_id` AS `drproduk_id`,`detail_retur_jual_produk`.`drproduk_master` AS `drproduk_master`,`detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,`detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,`detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,`detail_retur_jual_produk`.`drproduk_harga` AS `drproduk_harga`,`master_retur_jual_produk`.`rproduk_nobukti` AS `rproduk_nobukti`,`master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,`master_retur_jual_produk`.`rproduk_id` AS `rproduk_id`,`master_retur_jual_produk`.`rproduk_nobuktijual` AS `rproduk_nobuktijual`,`master_retur_jual_produk`.`rproduk_cust` AS `rproduk_cust`,`master_retur_jual_produk`.`rproduk_keterangan` AS `rproduk_keterangan`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota` from ((`master_retur_jual_produk` join `detail_retur_jual_produk` on((`detail_retur_jual_produk`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) join `customer` on((`master_retur_jual_produk`.`rproduk_cust` = `customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_terima_produk`
--
DROP VIEW IF EXISTS `vu_detail_terima_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_terima_produk` AS select `master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah`,`detail_terima_beli`.`dterima_id` AS `dterima_id`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,`supplier`.`supplier_id` AS `supplier_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`supplier`.`supplier_akun` AS `supplier_akun`,`vu_produk`.`produk_id` AS `produk_id`,ifnull(`detail_order_beli`.`dorder_jumlah`,0) AS `jumlah_order`,ifnull(`detail_order_beli`.`dorder_harga`,0) AS `harga_satuan`,ifnull(`detail_order_beli`.`dorder_diskon`,0) AS `diskon`,ifnull((`detail_order_beli`.`dorder_harga` * `detail_terima_beli`.`dterima_jumlah`),0) AS `total_nilai`,ifnull((((`detail_order_beli`.`dorder_harga` * `detail_order_beli`.`dorder_diskon`) * `detail_terima_beli`.`dterima_jumlah`) / 100),0) AS `diskon_nilai`,ifnull((((`detail_order_beli`.`dorder_harga` * `detail_terima_beli`.`dterima_jumlah`) * (100 - `detail_order_beli`.`dorder_diskon`)) / 100),0) AS `subtotal`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`satuan`.`satuan_id` AS `satuan_id`,`supplier`.`supplier_kota` AS `supplier_kota`,`vu_produk`.`produk_volume` AS `produk_volume` from ((((((`detail_terima_beli` join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `vu_produk` on((`vu_produk`.`produk_id` = `detail_terima_beli`.`dterima_produk`))) join `satuan` on((`detail_terima_beli`.`dterima_satuan` = `satuan`.`satuan_id`))) left join `master_order_beli` on((`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`))) left join `detail_order_beli` on(((`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`) and (`detail_order_beli`.`dorder_produk` = `detail_terima_beli`.`dterima_produk`)))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_terima_bonus`
--
DROP VIEW IF EXISTS `vu_detail_terima_bonus`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_terima_bonus` AS select `master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`detail_terima_bonus`.`dtbonus_id` AS `dtbonus_id`,`detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,`detail_terima_bonus`.`dtbonus_produk` AS `dtbonus_produk`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`produk_volume` AS `produk_volume`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`detail_terima_bonus`.`dtbonus_satuan` AS `dtbonus_satuan`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`detail_terima_bonus`.`dtbonus_jumlah` AS `dtbonus_jumlah`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_akun` AS `supplier_akun`,`vu_produk`.`produk_id` AS `produk_id`,`satuan`.`satuan_id` AS `satuan_id` from ((((`detail_terima_bonus` join `master_terima_beli` on((`detail_terima_bonus`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `vu_produk` on((`detail_terima_bonus`.`dtbonus_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`detail_terima_bonus`.`dtbonus_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_terima_all`
--
DROP VIEW IF EXISTS `vu_detail_terima_all`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_terima_all` AS select `vu_detail_terima_produk`.`dterima_master` AS `master`,`vu_detail_terima_produk`.`produk_id` AS `produk_id`,`vu_detail_terima_produk`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_produk`.`terima_no` AS `no_bukti`,`vu_detail_terima_produk`.`supplier_id` AS `supplier_id`,`vu_detail_terima_produk`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_produk`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_produk`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_produk`.`produk_kode` AS `produk_kode`,`vu_detail_terima_produk`.`produk_nama` AS `produk_nama`,`vu_detail_terima_produk`.`satuan_id` AS `satuan_id`,`vu_detail_terima_produk`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_produk`.`produk_volume` AS `produk_volume`,`vu_detail_terima_produk`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_produk`.`dterima_jumlah` AS `jumlah`,`vu_detail_terima_produk`.`harga_satuan` AS `harga_satuan`,`vu_detail_terima_produk`.`diskon` AS `diskon`,`vu_detail_terima_produk`.`diskon_nilai` AS `diskon_nilai`,`vu_detail_terima_produk`.`subtotal` AS `subtotal`,`vu_detail_terima_produk`.`terima_tanggal` AS `tanggal`,_utf8'produk' AS `jenis` from `vu_detail_terima_produk` union select `vu_detail_terima_bonus`.`dtbonus_master` AS `master`,`vu_detail_terima_bonus`.`produk_id` AS `produk_id`,`vu_detail_terima_bonus`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_bonus`.`terima_no` AS `no_bukti`,`vu_detail_terima_bonus`.`supplier_id` AS `supplier_id`,`vu_detail_terima_bonus`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_bonus`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_bonus`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_bonus`.`produk_kode` AS `produk_kode`,`vu_detail_terima_bonus`.`produk_volume` AS `produk_volume`,`vu_detail_terima_bonus`.`produk_nama` AS `produk_nama`,`vu_detail_terima_bonus`.`satuan_id` AS `satuan_id`,`vu_detail_terima_bonus`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_bonus`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_bonus`.`dtbonus_jumlah` AS `jumlah`,0 AS `harga_satuan`,0 AS `diskon`,0 AS `diskon_nilai`,0 AS `subtotal`,`vu_detail_terima_bonus`.`terima_tanggal` AS `tanggal`,_utf8'bonus' AS `jenis` from `vu_detail_terima_bonus`;

-- --------------------------------------------------------

--
-- Structure for view `vu_detail_terima_konversi`
--
DROP VIEW IF EXISTS `vu_detail_terima_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_detail_terima_konversi` AS select `vu_detail_terima_all`.`master` AS `master`,`vu_detail_terima_all`.`produk_id` AS `produk_id`,`vu_detail_terima_all`.`supplier_akun` AS `supplier_akun`,`vu_detail_terima_all`.`no_bukti` AS `no_bukti`,`vu_detail_terima_all`.`supplier_id` AS `supplier_id`,`vu_detail_terima_all`.`supplier_nama` AS `supplier_nama`,`vu_detail_terima_all`.`supplier_alamat` AS `supplier_alamat`,`vu_detail_terima_all`.`supplier_kota` AS `supplier_kota`,`vu_detail_terima_all`.`produk_kode` AS `produk_kode`,`vu_detail_terima_all`.`produk_nama` AS `produk_nama`,`vu_detail_terima_all`.`satuan_id` AS `satuan_id`,`vu_detail_terima_all`.`satuan_kode` AS `satuan_kode`,`vu_detail_terima_all`.`satuan_nama` AS `satuan_nama`,`vu_detail_terima_all`.`jumlah` AS `jumlah`,`vu_detail_terima_all`.`harga_satuan` AS `harga_satuan`,`vu_detail_terima_all`.`diskon` AS `diskon`,`vu_detail_terima_all`.`diskon_nilai` AS `diskon_nilai`,`vu_detail_terima_all`.`subtotal` AS `subtotal`,`vu_detail_terima_all`.`tanggal` AS `tanggal`,`vu_detail_terima_all`.`jenis` AS `jenis`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,(`satuan_konversi`.`konversi_nilai` * `vu_detail_terima_all`.`jumlah`) AS `jumlah_konversi` from (`satuan_konversi` join `vu_detail_terima_all` on(((`vu_detail_terima_all`.`produk_id` = `satuan_konversi`.`konversi_produk`) and (`vu_detail_terima_all`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_draft`
--
DROP VIEW IF EXISTS `vu_draft`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_draft` AS select `draft`.`draft_id` AS `draft_id`,`draft`.`draft_destination` AS `draft_destination`,`draft`.`draft_message` AS `draft_message`,`draft`.`draft_date` AS `draft_date`,`draft`.`draft_creator` AS `draft_creator`,`draft`.`draft_date_create` AS `draft_date_create`,`draft`.`draft_update` AS `draft_update`,`draft`.`draft_date_update` AS `draft_date_update`,`draft`.`draft_revised` AS `draft_revised`,_utf8'Group' AS `draft_jenis`,`phonegroup`.`phonegroup_id` AS `draft_destid`,`phonegroup`.`phonegroup_nama` AS `draft_destnama` from (`draft` join `phonegroup`) where ((`draft`.`draft_destination` regexp _latin1'Group') and (substring_index(`draft`.`draft_destination`,_latin1':',-(1)) = `phonegroup`.`phonegroup_id`)) union select `draft`.`draft_id` AS `draft_id`,`draft`.`draft_destination` AS `draft_destination`,`draft`.`draft_message` AS `draft_message`,`draft`.`draft_date` AS `draft_date`,`draft`.`draft_creator` AS `draft_creator`,`draft`.`draft_date_create` AS `draft_date_create`,`draft`.`draft_update` AS `draft_update`,`draft`.`draft_date_update` AS `draft_date_update`,`draft`.`draft_revised` AS `draft_revised`,_utf8'Number' AS `draft_jenis`,substring_index(`draft`.`draft_destination`,_latin1':',-(1)) AS `draft_destid`,substring_index(`draft`.`draft_destination`,_latin1':',-(1)) AS `draft_destnama` from `draft` where (`draft`.`draft_destination` regexp _latin1'Number');

-- --------------------------------------------------------

--
-- Structure for view `vu_drbeli`
--
DROP VIEW IF EXISTS `vu_drbeli`;

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `vu_drbeli` AS select `master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `rbeli_nobukti`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`master_retur_beli`.`rbeli_keterangan` AS `rbeli_keterangan`,`master_retur_beli`.`rbeli_creator` AS `rbeli_creator`,`master_retur_beli`.`rbeli_date_create` AS `rbeli_date_create`,`master_retur_beli`.`rbeli_update` AS `rbeli_update`,`master_retur_beli`.`rbeli_date_update` AS `rbeli_date_update`,`master_retur_beli`.`rbeli_revised` AS `rbeli_revised`,`master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,`master_order_beli`.`order_id` AS `order_id`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`master_order_beli`.`order_creator` AS `order_creator`,`master_order_beli`.`order_date_create` AS `order_date_create`,`master_order_beli`.`order_update` AS `order_update`,`master_order_beli`.`order_date_update` AS `order_date_update`,`master_order_beli`.`order_revised` AS `order_revised`,`detail_order_beli`.`dorder_id` AS `dorder_id`,`detail_order_beli`.`dorder_master` AS `dorder_master`,`detail_order_beli`.`dorder_produk` AS `dorder_produk`,`detail_order_beli`.`dorder_satuan` AS `dorder_satuan`,`detail_order_beli`.`dorder_jumlah` AS `dorder_jumlah`,`detail_order_beli`.`dorder_harga` AS `dorder_harga`,`detail_order_beli`.`dorder_diskon` AS `dorder_diskon` from (((`master_retur_beli` join `master_terima_beli`) join `master_order_beli`) join `detail_order_beli`) where ((`master_retur_beli`.`rbeli_terima` = `master_terima_beli`.`terima_id`) and (`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`) and (`detail_order_beli`.`dorder_master` = `master_order_beli`.`order_id`));

-- --------------------------------------------------------

--
-- Structure for view `vu_produk_satuan_terkecil`
--
DROP VIEW IF EXISTS `vu_produk_satuan_terkecil`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_produk_satuan_terkecil` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_kodelama` AS `produk_kodelama` from ((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) where (`satuan_konversi`.`konversi_nilai` = 1);

-- --------------------------------------------------------

--
-- Structure for view `vu_total_invoice_group_konversi`
--
DROP VIEW IF EXISTS `vu_total_invoice_group_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_invoice_group_konversi` AS select `vu_detail_invoice_konversi`.`dinvoice_master` AS `dinvoice_master`,ifnull(sum(`vu_detail_invoice_konversi`.`jumlah_konversi`),0) AS `jumlah_barang`,((sum((`vu_detail_invoice_konversi`.`dinvoice_harga` * `vu_detail_invoice_konversi`.`dinvoice_jumlah`)) * (100 - `vu_detail_invoice_konversi`.`dinvoice_diskon`)) / 100) AS `total_nilai` from `vu_detail_invoice_konversi` group by `vu_detail_invoice_konversi`.`dinvoice_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_invoice_konversi`
--
DROP VIEW IF EXISTS `vu_trans_invoice_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_invoice_konversi` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `invoice_no`,`master_invoice`.`invoice_tanggal` AS `invoice_tanggal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,(`master_invoice`.`invoice_cashback` / `vu_total_invoice_group_konversi`.`jumlah_barang`) AS `potongan_satuan`,(`master_invoice`.`invoice_biaya` / `vu_total_invoice_group_konversi`.`jumlah_barang`) AS `biaya_satuan`,`vu_total_invoice_group_konversi`.`jumlah_barang` AS `jumlah_barang`,(((`vu_total_invoice_group_konversi`.`total_nilai` * `master_invoice`.`invoice_diskon`) / 100) / `vu_total_invoice_group_konversi`.`jumlah_barang`) AS `diskon_satuan` from (`master_invoice` join `vu_total_invoice_group_konversi` on((`master_invoice`.`invoice_id` = `vu_total_invoice_group_konversi`.`dinvoice_master`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_hpp_beli`
--
DROP VIEW IF EXISTS `vu_hpp_beli`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_hpp_beli` AS select `vu_trans_invoice_konversi`.`invoice_tanggal` AS `tanggal`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif` AS `satuan_aktif`,`detail_invoice`.`dinvoice_jumlah` AS `jumlah`,`detail_invoice`.`dinvoice_harga` AS `dinvoice_harga`,`detail_invoice`.`dinvoice_diskon` AS `dinvoice_diskon`,`vu_trans_invoice_konversi`.`potongan_satuan` AS `potongan_satuan`,`vu_trans_invoice_konversi`.`biaya_satuan` AS `biaya_satuan`,`vu_trans_invoice_konversi`.`diskon_satuan` AS `diskon_satuan`,(((((`detail_invoice`.`dinvoice_harga` / `satuan_konversi`.`konversi_nilai`) - `detail_invoice`.`dinvoice_diskon`) - `vu_trans_invoice_konversi`.`potongan_satuan`) - `vu_trans_invoice_konversi`.`diskon_satuan`) + `vu_trans_invoice_konversi`.`diskon_satuan`) AS `harga_beli`,(`satuan_konversi`.`konversi_nilai` * `detail_invoice`.`dinvoice_jumlah`) AS `jumlah_konversi` from (((`detail_invoice` join `satuan_konversi` on(((`detail_invoice`.`dinvoice_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_invoice`.`dinvoice_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `vu_trans_invoice_konversi` on((`vu_trans_invoice_konversi`.`invoice_id` = `detail_invoice`.`dinvoice_master`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_terima_group_konversi`
--
DROP VIEW IF EXISTS `vu_total_terima_group_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_terima_group_konversi` AS select `vu_detail_terima_konversi`.`master` AS `master`,sum(`vu_detail_terima_konversi`.`jumlah`) AS `jumlah_barang`,sum(`vu_detail_terima_konversi`.`subtotal`) AS `jumlah_nilai`,sum(`vu_detail_terima_konversi`.`konversi_nilai`) AS `jumlah_konversi` from `vu_detail_terima_konversi` group by `vu_detail_terima_konversi`.`master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_terima_konversi`
--
DROP VIEW IF EXISTS `vu_trans_terima_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_terima_konversi` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `terima_no`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_status` AS `terima_status`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,`vu_total_terima_group_konversi`.`jumlah_barang` AS `jumlah_barang`,`vu_total_terima_group_konversi`.`jumlah_nilai` AS `jumlah_nilai`,`vu_total_terima_group_konversi`.`jumlah_konversi` AS `jumlah_konversi`,`master_order_beli`.`order_cashback` AS `order_cashback`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_diskon` AS `order_diskon`,(`master_order_beli`.`order_cashback` / `vu_total_terima_group_konversi`.`jumlah_barang`) AS `potongan_satuan`,(`master_order_beli`.`order_biaya` / `vu_total_terima_group_konversi`.`jumlah_barang`) AS `biaya_satuan`,(((`vu_total_terima_group_konversi`.`jumlah_nilai` * `master_order_beli`.`order_diskon`) / 100) / `vu_total_terima_group_konversi`.`jumlah_barang`) AS `diskon_satuan` from ((`vu_total_terima_group_konversi` join `master_terima_beli` on((`vu_total_terima_group_konversi`.`master` = `master_terima_beli`.`terima_id`))) join `master_order_beli` on((`master_order_beli`.`order_id` = `master_terima_beli`.`terima_order`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_hpp_beli_terima`
--
DROP VIEW IF EXISTS `vu_hpp_beli_terima`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_hpp_beli_terima` AS select `vu_trans_terima_konversi`.`terima_status` AS `terima_status`,`vu_trans_terima_konversi`.`terima_tanggal` AS `tanggal`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif` AS `satuan_aktif`,`vu_detail_terima_all`.`jumlah` AS `jumlah`,`vu_detail_terima_all`.`harga_satuan` AS `harga_satuan`,`vu_detail_terima_all`.`diskon` AS `diskon`,`vu_trans_terima_konversi`.`potongan_satuan` AS `potongan_satuan`,`vu_trans_terima_konversi`.`biaya_satuan` AS `biaya_satuan`,`vu_trans_terima_konversi`.`diskon_satuan` AS `diskon_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,((((((`vu_detail_terima_all`.`harga_satuan` * (100 - `vu_detail_terima_all`.`diskon`)) / 100) / `satuan_konversi`.`konversi_nilai`) - `vu_trans_terima_konversi`.`potongan_satuan`) - `vu_trans_terima_konversi`.`diskon_satuan`) + `vu_trans_terima_konversi`.`diskon_satuan`) AS `harga_beli`,(`satuan_konversi`.`konversi_nilai` * `vu_detail_terima_all`.`jumlah`) AS `jumlah_konversi` from (((`vu_detail_terima_all` join `satuan_konversi` on(((`vu_detail_terima_all`.`produk_id` = `satuan_konversi`.`konversi_produk`) and (`vu_detail_terima_all`.`satuan_id` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `vu_trans_terima_konversi` on((`vu_trans_terima_konversi`.`terima_id` = `vu_detail_terima_all`.`master`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_hpp_tanggal`
--
DROP VIEW IF EXISTS `vu_hpp_tanggal`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_hpp_tanggal` AS select `master_terima_beli`.`terima_tanggal` AS `tanggal`,`master_terima_beli`.`terima_status` AS `status` from `master_terima_beli` union select `master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`master_jual_produk`.`jproduk_stat_dok` AS `status` from `master_jual_produk`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jpaket`
--
DROP VIEW IF EXISTS `vu_jpaket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`member_no` AS `member_no`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_diskon` AS `jpaket_diskon`,`master_jual_paket`.`jpaket_cashback` AS `jpaket_cashback`,`master_jual_paket`.`jpaket_cara` AS `jpaket_cara`,`master_jual_paket`.`jpaket_cara2` AS `jpaket_cara2`,`master_jual_paket`.`jpaket_cara3` AS `jpaket_cara3`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,if((`master_jual_paket`.`jpaket_totalbiaya` <> 0),`master_jual_paket`.`jpaket_totalbiaya`,((sum((`detail_jual_paket`.`dpaket_harga` * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100))) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`)) AS `jpaket_totalbiaya`,`master_jual_paket`.`jpaket_keterangan` AS `jpaket_keterangan`,`master_jual_paket`.`jpaket_stat_dok` AS `jpaket_stat_dok`,`master_jual_paket`.`jpaket_creator` AS `jpaket_creator`,`master_jual_paket`.`jpaket_date_create` AS `jpaket_date_create`,`master_jual_paket`.`jpaket_update` AS `jpaket_update`,`master_jual_paket`.`jpaket_date_update` AS `jpaket_date_update`,`master_jual_paket`.`jpaket_revised` AS `jpaket_revised` from ((`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `vu_customer` on((`master_jual_paket`.`jpaket_cust` = `vu_customer`.`cust_id`))) group by `detail_jual_paket`.`dpaket_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jpaket_totalbiaya`
--
DROP VIEW IF EXISTS `vu_jpaket_totalbiaya`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_totalbiaya` AS select `detail_jual_paket`.`dpaket_master` AS `dpaket_master`,((sum((`detail_jual_paket`.`dpaket_harga` * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100))) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`) AS `jpaket_totalbiaya` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) group by `detail_jual_paket`.`dpaket_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jpaket_total_bayar`
--
DROP VIEW IF EXISTS `vu_jpaket_total_bayar`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_total_bayar` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,sum(((((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100)) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`)) AS `jpaket_total_bayar` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) group by `master_jual_paket`.`jpaket_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jpgrooming`
--
DROP VIEW IF EXISTS `vu_jpgrooming`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpgrooming` AS select `master_jualproduk_grooming`.`jpgrooming_id` AS `jpgrooming_id`,`master_jualproduk_grooming`.`jpgrooming_nobukti` AS `jpgrooming_nobukti`,`karyawan`.`karyawan_nama` AS `karyawan_nama`,`karyawan`.`karyawan_no` AS `karyawan_no`,`master_jualproduk_grooming`.`jpgrooming_karyawan` AS `jpgrooming_karyawan`,`master_jualproduk_grooming`.`jpgrooming_tanggal` AS `jpgrooming_tanggal`,`master_jualproduk_grooming`.`jpgrooming_diskon` AS `jpgrooming_diskon`,`master_jualproduk_grooming`.`jpgrooming_cashback` AS `jpgrooming_cashback`,`master_jualproduk_grooming`.`jpgrooming_cara` AS `jpgrooming_cara`,`master_jualproduk_grooming`.`jpgrooming_cara2` AS `jpgrooming_cara2`,`master_jualproduk_grooming`.`jpgrooming_cara3` AS `jpgrooming_cara3`,`master_jualproduk_grooming`.`jpgrooming_bayar` AS `jpgrooming_bayar`,`master_jualproduk_grooming`.`jpgrooming_totalbiaya` AS `jpgrooming_totalbiaya`,`master_jualproduk_grooming`.`jpgrooming_keterangan` AS `jpgrooming_keterangan`,`master_jualproduk_grooming`.`jpgrooming_creator` AS `jpgrooming_creator`,`master_jualproduk_grooming`.`jpgrooming_date_create` AS `jpgrooming_date_create`,`master_jualproduk_grooming`.`jpgrooming_update` AS `jpgrooming_update`,`master_jualproduk_grooming`.`jpgrooming_date_update` AS `jpgrooming_date_update`,`master_jualproduk_grooming`.`jpgrooming_revised` AS `jpgrooming_revised` from (`master_jualproduk_grooming` left join `karyawan` on((`master_jualproduk_grooming`.`jpgrooming_karyawan` = `karyawan`.`karyawan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jpgrooming_totalbiaya`
--
DROP VIEW IF EXISTS `vu_jpgrooming_totalbiaya`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpgrooming_totalbiaya` AS select `detail_jualproduk_grooming`.`dpgrooming_master` AS `dpgrooming_master`,((sum((`detail_jualproduk_grooming`.`dpgrooming_harga` * ((100 - `detail_jualproduk_grooming`.`dpgrooming_diskon`) / 100))) * ((100 - `master_jualproduk_grooming`.`jpgrooming_diskon`) / 100)) - `master_jualproduk_grooming`.`jpgrooming_cashback`) AS `jpgrooming_totalbiaya` from (`detail_jualproduk_grooming` left join `master_jualproduk_grooming` on((`detail_jualproduk_grooming`.`dpgrooming_master` = `master_jualproduk_grooming`.`jpgrooming_id`))) group by `detail_jualproduk_grooming`.`dpgrooming_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jproduk`
--
DROP VIEW IF EXISTS `vu_jproduk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jproduk` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`member_no` AS `member_no`,`vu_customer`.`member_valid` AS `member_valid`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_diskon` AS `jproduk_diskon`,`master_jual_produk`.`jproduk_cashback` AS `jproduk_cashback`,`master_jual_produk`.`jproduk_cara` AS `jproduk_cara`,`master_jual_produk`.`jproduk_cara2` AS `jproduk_cara2`,`master_jual_produk`.`jproduk_cara3` AS `jproduk_cara3`,`master_jual_produk`.`jproduk_bayar` AS `jproduk_bayar`,`master_jual_produk`.`jproduk_totalbiaya` AS `jproduk_totalbiaya`,`master_jual_produk`.`jproduk_keterangan` AS `jproduk_keterangan`,`master_jual_produk`.`jproduk_creator` AS `jproduk_creator`,`master_jual_produk`.`jproduk_date_create` AS `jproduk_date_create`,`master_jual_produk`.`jproduk_update` AS `jproduk_update`,`master_jual_produk`.`jproduk_date_update` AS `jproduk_date_update`,`master_jual_produk`.`jproduk_revised` AS `jproduk_revised` from (`master_jual_produk` left join `vu_customer` on((`master_jual_produk`.`jproduk_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jproduk_totalbiaya`
--
DROP VIEW IF EXISTS `vu_jproduk_totalbiaya`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jproduk_totalbiaya` AS select `detail_jual_produk`.`dproduk_master` AS `dproduk_master`,((sum((`detail_jual_produk`.`dproduk_harga` * ((100 - `detail_jual_produk`.`dproduk_diskon`) / 100))) * ((100 - `master_jual_produk`.`jproduk_diskon`) / 100)) - `master_jual_produk`.`jproduk_cashback`) AS `jproduk_totalbiaya` from (`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) group by `detail_jual_produk`.`dproduk_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jrawat_pk`
--
DROP VIEW IF EXISTS `vu_jrawat_pk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_pk` AS select `detail_ambil_paket`.`dapaket_jpaket` AS `jrawat_id`,`master_jual_paket`.`jpaket_nobukti` AS `jrawat_nobukti`,`detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_id` AS `jrawat_cust`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,date_format(`detail_ambil_paket`.`dapaket_date_create`,'%Y-%m-%d') AS `jrawat_tanggal`,0 AS `jrawat_diskon`,0 AS `jrawat_cashback`,NULL AS `jrawat_cara`,NULL AS `jrawat_cara2`,NULL AS `jrawat_cara3`,if((substr(`master_jual_paket`.`jpaket_nobukti`,1,2) = 'PK'),0,0) AS `jrawat_totalbiaya`,0 AS `jrawat_bayar`,'' AS `jrawat_keterangan`,`master_jual_paket`.`jpaket_creator` AS `jrawat_creator`,`detail_ambil_paket`.`dapaket_date_create` AS `jrawat_date_create`,`master_jual_paket`.`jpaket_update` AS `jrawat_update`,`master_jual_paket`.`jpaket_date_update` AS `jrawat_date_update`,`master_jual_paket`.`jpaket_revised` AS `jrawat_revised`,if((substr(`master_jual_paket`.`jpaket_nobukti`,1,2) = 'PK'),'paket','') AS `keterangan_paket`,`detail_ambil_paket`.`dapaket_stat_dok` AS `dapaket_stat_dok` from (((`detail_ambil_paket` left join `detail_jual_paket` on((`detail_ambil_paket`.`dapaket_dpaket` = `detail_jual_paket`.`dpaket_id`))) left join `master_jual_paket` on((`detail_ambil_paket`.`dapaket_jpaket` = `master_jual_paket`.`jpaket_id`))) left join `customer` on((`detail_ambil_paket`.`dapaket_cust` = `customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jrawat_pr`
--
DROP VIEW IF EXISTS `vu_jrawat_pr`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_pr` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,0 AS `dpaket_id`,`master_jual_rawat`.`jrawat_stat_dok` AS `jrawat_stat_dok`,`vu_customer`.`cust_nama` AS `cust_nama`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`member_no` AS `member_no`,`vu_customer`.`member_valid` AS `member_valid`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_diskon` AS `jrawat_diskon`,`master_jual_rawat`.`jrawat_cashback` AS `jrawat_cashback`,`master_jual_rawat`.`jrawat_cara` AS `jrawat_cara`,`master_jual_rawat`.`jrawat_cara2` AS `jrawat_cara2`,`master_jual_rawat`.`jrawat_cara3` AS `jrawat_cara3`,`master_jual_rawat`.`jrawat_totalbiaya` AS `jrawat_totalbiaya`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_keterangan` AS `jrawat_keterangan`,`master_jual_rawat`.`jrawat_creator` AS `jrawat_creator`,`master_jual_rawat`.`jrawat_date_create` AS `jrawat_date_create`,`master_jual_rawat`.`jrawat_update` AS `jrawat_update`,`master_jual_rawat`.`jrawat_date_update` AS `jrawat_date_update`,`master_jual_rawat`.`jrawat_revised` AS `jrawat_revised`,if((substr(`master_jual_rawat`.`jrawat_nobukti`,1,2) = _latin1'PK'),_utf8'paket',_utf8'') AS `keterangan_paket` from (`master_jual_rawat` left join `vu_customer` on((`master_jual_rawat`.`jrawat_cust` = `vu_customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jrawat_totalbiaya`
--
DROP VIEW IF EXISTS `vu_jrawat_totalbiaya`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_totalbiaya` AS select `detail_jual_rawat`.`drawat_master` AS `drawat_master`,((sum(((`detail_jual_rawat`.`drawat_jumlah` * `detail_jual_rawat`.`drawat_harga`) * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100))) * ((100 - `master_jual_rawat`.`jrawat_diskon`) / 100)) - `master_jual_rawat`.`jrawat_cashback`) AS `jrawat_totalbiaya` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) group by `detail_jual_rawat`.`drawat_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jterapis`
--
DROP VIEW IF EXISTS `vu_jterapis`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jterapis` AS select `appointment_detail`.`dapp_petugas2` AS `terapis_id`,date_format(`appointment_detail`.`dapp_tgldatang`,_utf8'%Y-%m-%d') AS `terapis_bulan`,count(`appointment_detail`.`dapp_petugas2`) AS `terapis_count_day` from `appointment_detail` where ((`appointment_detail`.`dapp_counter` = _latin1'true') and (`appointment_detail`.`dapp_petugas2` <> 0) and (`appointment_detail`.`dapp_status` = _latin1'datang')) group by date_format(`appointment_detail`.`dapp_tgldatang`,_utf8'%Y-%m-%d'),`appointment_detail`.`dapp_petugas2`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_produk_group`
--
DROP VIEW IF EXISTS `vu_total_jual_produk_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_jual_produk_group` AS select ifnull(sum(`detail_jual_produk`.`dproduk_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_jumlah`) * (100 - `detail_jual_produk`.`dproduk_diskon`)) / 100)),0) AS `total_nilai`,`detail_jual_produk`.`dproduk_master` AS `dproduk_master` from `detail_jual_produk` group by `detail_jual_produk`.`dproduk_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_produk`
--
DROP VIEW IF EXISTS `vu_trans_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_produk` AS select `master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_cust` AS `cust_id`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`vu_total_jual_produk_group`.`jumlah_barang`,0) AS `jumlah_barang`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`vu_total_jual_produk_group`.`total_nilai`,0)) AS `total_nilai`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`master_jual_produk`.`jproduk_diskon`,0)) AS `diskon`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`master_jual_produk`.`jproduk_cashback`,0)) AS `cashback`,ifnull(`jual_kredit`.`jkredit_nilai`,0) AS `kredit`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`jual_cek`.`jcek_nilai`,0)) AS `cek`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`jual_card`.`jcard_nilai`,0)) AS `card`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`jual_kwitansi`.`jkwitansi_nilai`,0)) AS `kuintansi`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`jual_transfer`.`jtransfer_nilai`,0)) AS `transfer`,if((`master_jual_produk`.`jproduk_stat_dok` = 'Batal'),0,ifnull(`jual_tunai`.`jtunai_nilai`,0)) AS `tunai`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok` from ((((((((`master_jual_produk` left join `vu_total_jual_produk_group` on((`vu_total_jual_produk_group`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) left join `vu_customer` on((`master_jual_produk`.`jproduk_cust` = `vu_customer`.`cust_id`))) left join `jual_card` on((`jual_card`.`jcard_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_cek` on((`jual_cek`.`jcek_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_kredit` on((`jual_kredit`.`jkredit_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_kwitansi` on((`jual_kwitansi`.`jkwitansi_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_transfer` on((`jual_transfer`.`jtransfer_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `jual_tunai` on((`jual_tunai`.`jtunai_ref` = `master_jual_produk`.`jproduk_nobukti`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_rawat_group`
--
DROP VIEW IF EXISTS `vu_total_jual_rawat_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_jual_rawat_group` AS select ifnull(sum(`detail_jual_rawat`.`drawat_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) * (100 - `detail_jual_rawat`.`drawat_diskon`)) / 100)),0) AS `total_nilai`,`detail_jual_rawat`.`drawat_master` AS `drawat_master` from `detail_jual_rawat` group by `detail_jual_rawat`.`drawat_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_rawat`
--
DROP VIEW IF EXISTS `vu_trans_rawat`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_rawat` AS select `master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,`master_jual_rawat`.`jrawat_cust` AS `cust_id`,`master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`vu_total_jual_rawat_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_rawat_group`.`total_nilai`,0) AS `total_nilai`,ifnull(`master_jual_rawat`.`jrawat_diskon`,0) AS `diskon`,ifnull(`master_jual_rawat`.`jrawat_cashback`,0) AS `cashback`,ifnull(`jual_kredit`.`jkredit_nilai`,0) AS `kredit`,ifnull(`jual_cek`.`jcek_nilai`,0) AS `cek`,ifnull(`jual_card`.`jcard_nilai`,0) AS `card`,ifnull(`jual_kwitansi`.`jkwitansi_nilai`,0) AS `kuintansi`,ifnull(`jual_transfer`.`jtransfer_nilai`,0) AS `transfer`,ifnull(`jual_tunai`.`jtunai_nilai`,0) AS `tunai` from ((((((((`master_jual_rawat` left join `vu_total_jual_rawat_group` on((`vu_total_jual_rawat_group`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) left join `vu_customer` on((`master_jual_rawat`.`jrawat_cust` = `vu_customer`.`cust_id`))) left join `jual_card` on((`jual_card`.`jcard_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `jual_cek` on((`jual_cek`.`jcek_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `jual_kredit` on((`jual_kredit`.`jkredit_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `jual_kwitansi` on((`jual_kwitansi`.`jkwitansi_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `jual_transfer` on((`jual_transfer`.`jtransfer_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `jual_tunai` on((`jual_tunai`.`jtunai_ref` = `master_jual_rawat`.`jrawat_nobukti`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_jual_paket_group`
--
DROP VIEW IF EXISTS `vu_total_jual_paket_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_jual_paket_group` AS select ifnull(sum(`detail_jual_paket`.`dpaket_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_jual_paket`.`dpaket_harga` * `detail_jual_paket`.`dpaket_jumlah`) * (100 - `detail_jual_paket`.`dpaket_diskon`)) / 100)),0) AS `total_nilai`,`detail_jual_paket`.`dpaket_master` AS `dpaket_master` from `detail_jual_paket` group by `detail_jual_paket`.`dpaket_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_paket`
--
DROP VIEW IF EXISTS `vu_trans_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_paket` AS select `master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,`master_jual_paket`.`jpaket_cust` AS `cust_id`,`master_jual_paket`.`jpaket_tanggal` AS `tanggal`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,ifnull(`vu_total_jual_paket_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_jual_paket_group`.`total_nilai`,0) AS `total_nilai`,ifnull(`master_jual_paket`.`jpaket_diskon`,0) AS `diskon`,ifnull(`master_jual_paket`.`jpaket_cashback`,0) AS `cashback`,ifnull(`jual_kredit`.`jkredit_nilai`,0) AS `kredit`,ifnull(`jual_cek`.`jcek_nilai`,0) AS `cek`,ifnull(`jual_card`.`jcard_nilai`,0) AS `card`,ifnull(`jual_kwitansi`.`jkwitansi_nilai`,0) AS `kuintansi`,ifnull(`jual_transfer`.`jtransfer_nilai`,0) AS `transfer`,ifnull(`jual_tunai`.`jtunai_nilai`,0) AS `tunai` from ((((((((`master_jual_paket` left join `vu_total_jual_paket_group` on((`vu_total_jual_paket_group`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) left join `vu_customer` on((`master_jual_paket`.`jpaket_cust` = `vu_customer`.`cust_id`))) left join `jual_card` on((`jual_card`.`jcard_ref` = `master_jual_paket`.`jpaket_nobukti`))) left join `jual_cek` on((`jual_cek`.`jcek_ref` = `master_jual_paket`.`jpaket_nobukti`))) left join `jual_kredit` on((`jual_kredit`.`jkredit_ref` = `master_jual_paket`.`jpaket_nobukti`))) left join `jual_kwitansi` on((`jual_kwitansi`.`jkwitansi_ref` = `master_jual_paket`.`jpaket_nobukti`))) left join `jual_transfer` on((`jual_transfer`.`jtransfer_ref` = `master_jual_paket`.`jpaket_nobukti`))) left join `jual_tunai` on((`jual_tunai`.`jtunai_ref` = `master_jual_paket`.`jpaket_nobukti`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_retur_jual_produk_group`
--
DROP VIEW IF EXISTS `vu_total_retur_jual_produk_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_retur_jual_produk_group` AS select ifnull(sum(`detail_retur_jual_produk`.`drproduk_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_retur_jual_produk`.`drproduk_harga` * `detail_retur_jual_produk`.`drproduk_jumlah`) * (100 - `detail_retur_jual_produk`.`drproduk_diskon`)) / 100)),0) AS `total_nilai`,`detail_retur_jual_produk`.`drproduk_master` AS `drproduk_master` from `detail_retur_jual_produk` group by `detail_retur_jual_produk`.`drproduk_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_retur_produk`
--
DROP VIEW IF EXISTS `vu_trans_retur_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_retur_produk` AS select `master_retur_jual_produk`.`rproduk_nobukti` AS `no_bukti`,`master_retur_jual_produk`.`rproduk_cust` AS `cust_id`,`master_retur_jual_produk`.`rproduk_tanggal` AS `tanggal`,`vu_customer`.`cust_no` AS `cust_no`,`vu_customer`.`cust_member` AS `cust_member`,`vu_customer`.`cust_nama` AS `cust_nama`,`vu_customer`.`cust_kelamin` AS `cust_kelamin`,`vu_customer`.`cust_alamat` AS `cust_alamat`,`vu_customer`.`cust_kota` AS `cust_kota`,`master_jual_produk`.`jproduk_nobukti` AS `no_bukti_jual`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal_jual`,ifnull(`vu_total_retur_jual_produk_group`.`jumlah_barang`,0) AS `jumlah_barang`,ifnull(`vu_total_retur_jual_produk_group`.`total_nilai`,0) AS `total_nilai`,ifnull(`master_retur_jual_produk`.`rproduk_diskon`,0) AS `diskon`,ifnull(`master_retur_jual_produk`.`rproduk_cashback`,0) AS `cashback` from (((`master_retur_jual_produk` left join `vu_total_retur_jual_produk_group` on((`vu_total_retur_jual_produk_group`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) left join `vu_customer` on((`master_retur_jual_produk`.`rproduk_cust` = `vu_customer`.`cust_id`))) left join `master_jual_produk` on((`master_retur_jual_produk`.`rproduk_nobuktijual` = `master_jual_produk`.`jproduk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_union`
--
DROP VIEW IF EXISTS `vu_trans_union`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_union` AS select _utf8'jual_produk' AS `jenis_transaksi`,`vu_trans_produk`.`no_bukti` AS `no_bukti`,`vu_trans_produk`.`cust_id` AS `cust_id`,`vu_trans_produk`.`tanggal` AS `tanggal`,`vu_trans_produk`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_produk`.`total_nilai` AS `total_nilai`,`vu_trans_produk`.`cust_no` AS `cust_no`,`vu_trans_produk`.`cust_member` AS `cust_member`,`vu_trans_produk`.`cust_nama` AS `cust_nama`,`vu_trans_produk`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_produk`.`cust_alamat` AS `cust_alamat`,`vu_trans_produk`.`cust_kota` AS `cust_kota`,`vu_trans_produk`.`diskon` AS `diskon`,`vu_trans_produk`.`cashback` AS `cashback` from `vu_trans_produk` union select _utf8'jual_rawat' AS `jenis_transaksi`,`vu_trans_rawat`.`no_bukti` AS `no_bukti`,`vu_trans_rawat`.`cust_id` AS `cust_id`,`vu_trans_rawat`.`tanggal` AS `tanggal`,`vu_trans_rawat`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_rawat`.`total_nilai` AS `total_nilai`,`vu_trans_rawat`.`cust_no` AS `cust_no`,`vu_trans_rawat`.`cust_member` AS `cust_member`,`vu_trans_rawat`.`cust_nama` AS `cust_nama`,`vu_trans_rawat`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_rawat`.`cust_alamat` AS `cust_alamat`,`vu_trans_rawat`.`cust_kota` AS `cust_kota`,`vu_trans_rawat`.`diskon` AS `diskon`,`vu_trans_rawat`.`cashback` AS `cashback` from `vu_trans_rawat` union select _utf8'jual_paket' AS `jenis_transaksi`,`vu_trans_paket`.`no_bukti` AS `no_bukti`,`vu_trans_paket`.`cust_id` AS `cust_id`,`vu_trans_paket`.`tanggal` AS `tanggal`,`vu_trans_paket`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_paket`.`total_nilai` AS `total_nilai`,`vu_trans_paket`.`cust_no` AS `cust_no`,`vu_trans_paket`.`cust_member` AS `cust_member`,`vu_trans_paket`.`cust_nama` AS `cust_nama`,`vu_trans_paket`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_paket`.`cust_alamat` AS `cust_alamat`,`vu_trans_paket`.`cust_kota` AS `cust_kota`,`vu_trans_paket`.`diskon` AS `diskon`,`vu_trans_paket`.`cashback` AS `cashback` from `vu_trans_paket` union select _utf8'jual_retur' AS `jenis_transaksi`,`vu_trans_retur_produk`.`no_bukti` AS `no_bukti`,`vu_trans_retur_produk`.`cust_id` AS `cust_id`,`vu_trans_retur_produk`.`tanggal` AS `tanggal`,`vu_trans_retur_produk`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_retur_produk`.`total_nilai` AS `total_nilai`,`vu_trans_retur_produk`.`cust_no` AS `cust_no`,`vu_trans_retur_produk`.`cust_member` AS `cust_member`,`vu_trans_retur_produk`.`cust_nama` AS `cust_nama`,`vu_trans_retur_produk`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_retur_produk`.`cust_alamat` AS `cust_alamat`,`vu_trans_retur_produk`.`cust_kota` AS `cust_kota`,`vu_trans_retur_produk`.`diskon` AS `diskon`,`vu_trans_retur_produk`.`cashback` AS `cashback` from `vu_trans_retur_produk`;

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_card`
--
DROP VIEW IF EXISTS `vu_jual_card`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_card` AS select `jual_card`.`jcard_id` AS `jcard_id`,`jual_card`.`jcard_no` AS `jcard_no`,`jual_card`.`jcard_nama` AS `jcard_nama`,`jual_card`.`jcard_edc` AS `jcard_edc`,`jual_card`.`jcard_nilai` AS `jcard_nilai`,`jual_card`.`jcard_ref` AS `jcard_ref`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota` from (`jual_card` join `vu_trans_union` on((`jual_card`.`jcard_ref` = `vu_trans_union`.`no_bukti`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_cek`
--
DROP VIEW IF EXISTS `vu_jual_cek`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_cek` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`jual_cek`.`jcek_id` AS `jcek_id`,`jual_cek`.`jcek_no` AS `jcek_no`,`jual_cek`.`jcek_nama` AS `jcek_nama`,`jual_cek`.`jcek_valid` AS `jcek_valid`,`jual_cek`.`jcek_bank` AS `jcek_bank`,`jual_cek`.`jcek_nilai` AS `jcek_nilai`,`jual_cek`.`jcek_ref` AS `jcek_ref` from (`jual_cek` join `vu_trans_union` on((`vu_trans_union`.`no_bukti` = `jual_cek`.`jcek_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_kredit`
--
DROP VIEW IF EXISTS `vu_jual_kredit`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_kredit` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`jual_kredit`.`jkredit_id` AS `jkredit_id`,`jual_kredit`.`jkredit_cust` AS `jkredit_cust`,`jual_kredit`.`jkredit_nilai` AS `jkredit_nilai`,`jual_kredit`.`jkredit_ref` AS `jkredit_ref` from (`jual_kredit` join `vu_trans_union` on((`vu_trans_union`.`no_bukti` = `jual_kredit`.`jkredit_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_kwitansi`
--
DROP VIEW IF EXISTS `vu_jual_kwitansi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_kwitansi` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`jual_kwitansi`.`jkwitansi_id` AS `jkwitansi_id`,`jual_kwitansi`.`jkwitansi_master` AS `jkwitansi_master`,`jual_kwitansi`.`jkwitansi_no` AS `jkwitansi_no`,`jual_kwitansi`.`jkwitansi_nilai` AS `jkwitansi_nilai`,`jual_kwitansi`.`jkwitansi_ref` AS `jkwitansi_ref` from (`jual_kwitansi` join `vu_trans_union` on((`vu_trans_union`.`no_bukti` = `jual_kwitansi`.`jkwitansi_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_transfer`
--
DROP VIEW IF EXISTS `vu_jual_transfer`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_transfer` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`jual_transfer`.`jtransfer_id` AS `jtransfer_id`,`jual_transfer`.`jtransfer_bank` AS `jtransfer_bank`,`jual_transfer`.`jtransfer_nama` AS `jtransfer_nama`,`jual_transfer`.`jtransfer_nilai` AS `jtransfer_nilai`,`jual_transfer`.`jtransfer_ref` AS `jtransfer_ref` from (`jual_transfer` join `vu_trans_union` on((`vu_trans_union`.`no_bukti` = `jual_transfer`.`jtransfer_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_tunai`
--
DROP VIEW IF EXISTS `vu_jual_tunai`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_tunai` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`jual_tunai`.`jtunai_id` AS `jtunai_id`,`jual_tunai`.`jtunai_nilai` AS `jtunai_nilai`,`jual_tunai`.`jtunai_ref` AS `jtunai_ref` from (`jual_tunai` join `vu_trans_union` on((`vu_trans_union`.`no_bukti` = `jual_tunai`.`jtunai_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jual_voucher`
--
DROP VIEW IF EXISTS `vu_jual_voucher`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jual_voucher` AS select `vu_trans_union`.`jenis_transaksi` AS `jenis_transaksi`,`vu_trans_union`.`no_bukti` AS `no_bukti`,`vu_trans_union`.`cust_id` AS `cust_id`,`vu_trans_union`.`tanggal` AS `tanggal`,`vu_trans_union`.`jumlah_barang` AS `jumlah_barang`,`vu_trans_union`.`total_nilai` AS `total_nilai`,`vu_trans_union`.`cust_no` AS `cust_no`,`vu_trans_union`.`cust_member` AS `cust_member`,`vu_trans_union`.`cust_nama` AS `cust_nama`,`vu_trans_union`.`cust_kelamin` AS `cust_kelamin`,`vu_trans_union`.`cust_alamat` AS `cust_alamat`,`vu_trans_union`.`cust_kota` AS `cust_kota`,`vu_trans_union`.`diskon` AS `diskon`,`vu_trans_union`.`cashback` AS `cashback`,`voucher_terima`.`tvoucher_id` AS `tvoucher_id`,`voucher_terima`.`tvoucher_ref` AS `tvoucher_ref`,`voucher_terima`.`tvoucher_novoucher` AS `tvoucher_novoucher`,`voucher_terima`.`tvoucher_nilai` AS `tvoucher_nilai` from (`voucher_terima` join `vu_trans_union` on((`vu_trans_union`.`no_bukti` = `voucher_terima`.`tvoucher_ref`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_jurnal_umum`
--
DROP VIEW IF EXISTS `vu_jurnal_umum`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jurnal_umum` AS select `jurnal_umum`.`jurnal_id` AS `jurnal_id`,`jurnal_umum`.`jurnal_no` AS `jurnal_no`,`jurnal_umum`.`jurnal_tanggal` AS `jurnal_tanggal`,`jurnal_umum_detail`.`djurnal_akun` AS `djurnal_akun`,`jurnal_umum_detail`.`djurnal_detail` AS `djurnal_detail`,`jurnal_umum_detail`.`djurnal_debet` AS `djurnal_debet`,`jurnal_umum_detail`.`djurnal_kredit` AS `djurnal_kredit`,`jurnal_umum`.`jurnal_unit` AS `jurnal_unit`,`jurnal_umum`.`jurnal_author` AS `jurnal_author`,`jurnal_umum`.`jurnal_date_create` AS `jurnal_date_create`,`jurnal_umum`.`jurnal_update` AS `jurnal_update`,`jurnal_umum`.`jurnal_date_update` AS `jurnal_date_update`,`jurnal_umum`.`jurnal_post` AS `jurnal_post`,`jurnal_umum`.`jurnal_date_post` AS `jurnal_date_post`,`jurnal_umum`.`jurnal_revised` AS `jurnal_revised`,`akun`.`akun_kode` AS `akun_kode`,`akun`.`akun_jenis` AS `akun_jenis`,`akun`.`akun_parent` AS `akun_parent`,`akun`.`akun_level` AS `akun_level`,`akun`.`akun_nama` AS `akun_nama`,`akun`.`akun_debet` AS `akun_debet`,`akun`.`akun_kredit` AS `akun_kredit`,`akun`.`akun_saldo` AS `akun_saldo`,`akun`.`akun_aktif` AS `akun_aktif`,`jurnal_umum_detail`.`djurnal_id` AS `djurnal_id`,`akun`.`akun_id` AS `akun_id`,`jurnal_umum`.`jurnal_keterangan` AS `jurnal_keterangan`,`jurnal_umum`.`jurnal_noref` AS `jurnal_noref`,`jurnal_umum_detail`.`djurnal_master` AS `djurnal_master`,`jurnal_umum`.`jurnal_jenis` AS `jurnal_jenis` from ((`jurnal_umum` join `jurnal_umum_detail` on((`jurnal_umum_detail`.`djurnal_master` = `jurnal_umum`.`jurnal_id`))) join `akun` on((`jurnal_umum_detail`.`djurnal_akun` = `akun`.`akun_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_menus`
--
DROP VIEW IF EXISTS `vu_menus`;

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `vu_menus` AS select `permissions`.`perm_group` AS `perm_group`,`permissions`.`perm_menu` AS `perm_menu`,`permissions`.`perm_priv` AS `perm_priv`,`menus`.`menu_id` AS `menu_id`,`menus`.`menu_parent` AS `menu_parent`,`menus`.`menu_position` AS `menu_position`,`menus`.`menu_title` AS `menu_title`,`menus`.`menu_link` AS `menu_link`,`menus`.`menu_cat` AS `menu_cat`,`menus`.`menu_confirm` AS `menu_confirm`,`menus`.`menu_leftpanel` AS `menu_leftpanel`,`menus`.`menu_iconpanel` AS `menu_iconpanel`,`menus`.`menu_iconmenu` AS `menu_iconmenu`,`usergroups`.`group_id` AS `group_id`,`usergroups`.`group_name` AS `group_name`,`usergroups`.`group_desc` AS `group_desc`,`usergroups`.`group_active` AS `group_active` from ((`permissions` join `menus` on((`permissions`.`perm_menu` = `menus`.`menu_id`))) join `usergroups` on((`permissions`.`perm_group` = `usergroups`.`group_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_pakai_cabin`
--
DROP VIEW IF EXISTS `vu_pakai_cabin`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_pakai_cabin` AS select `detail_pakai_cabin`.`cabin_rawat` AS `cabin_rawat`,`detail_pakai_cabin`.`cabin_produk` AS `cabin_produk`,`perawatan`.`rawat_id` AS `rawat_id`,`perawatan`.`rawat_kode` AS `rawat_kode`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_group` AS `rawat_group`,`produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_kategori` AS `produk_kategori`,`detail_pakai_cabin`.`cabin_satuan` AS `cabin_satuan`,`detail_pakai_cabin`.`cabin_jumlah` AS `cabin_jumlah`,`detail_pakai_cabin`.`cabin_date_create` AS `cabin_date_create`,`detail_pakai_cabin`.`cabin_gudang` AS `cabin_gudang`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi`,`gudang`.`gudang_keterangan` AS `gudang_keterangan`,`tindakan_detail`.`dtrawat_id` AS `dtrawat_id`,`tindakan_detail`.`dtrawat_master` AS `dtrawat_master`,`detail_pakai_cabin`.`cabin_dtrawat` AS `cabin_dtrawat`,`tindakan`.`trawat_id` AS `trawat_id`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_nolama` AS `cust_nolama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_panggilan` AS `cust_panggilan`,`customer`.`cust_kelamin` AS `cust_kelamin`,`detail_pakai_cabin`.`cabin_bukti` AS `cabin_bukti`,`tindakan`.`trawat_cust` AS `trawat_cust` from ((((((`detail_pakai_cabin` join `perawatan` on((`detail_pakai_cabin`.`cabin_rawat` = `perawatan`.`rawat_id`))) join `produk` on((`produk`.`produk_id` = `detail_pakai_cabin`.`cabin_produk`))) join `gudang` on((`detail_pakai_cabin`.`cabin_gudang` = `gudang`.`gudang_id`))) join `tindakan_detail` on((`tindakan_detail`.`dtrawat_id` = `detail_pakai_cabin`.`cabin_dtrawat`))) join `tindakan` on((`tindakan`.`trawat_id` = `tindakan_detail`.`dtrawat_master`))) join `customer` on((`tindakan`.`trawat_cust` = `customer`.`cust_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_paket`
--
DROP VIEW IF EXISTS `vu_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_paket` AS select `paket`.`paket_id` AS `paket_id`,`paket`.`paket_kode` AS `paket_kode`,`paket`.`paket_nama` AS `paket_nama`,`paket`.`paket_group` AS `paket_group`,`paket`.`paket_kontribusi` AS `paket_kontribusi`,`paket`.`paket_kodelama` AS `paket_kodelama`,`paket`.`paket_keterangan` AS `paket_keterangan`,`paket`.`paket_du` AS `paket_du`,`paket`.`paket_dm` AS `paket_dm`,`paket`.`paket_point` AS `paket_point`,`paket`.`paket_harga` AS `paket_harga`,`paket`.`paket_expired` AS `paket_expired`,`paket`.`paket_jmlisi` AS `paket_jmlisi`,`produk_group`.`group_kode` AS `group_kode`,`produk_group`.`group_nama` AS `group_nama`,`produk_group`.`group_dupaket` AS `group_dupaket`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,`kategori2`.`kategori2_jenis` AS `kategori2_jenis`,`produk_group`.`group_dmpaket` AS `group_dmpaket`,`produk_group`.`group_kelompok` AS `group_kelompok` from ((`paket` join `produk_group` on((`paket`.`paket_group` = `produk_group`.`group_id`))) join `kategori2` on((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_pengguna_paket`
--
DROP VIEW IF EXISTS `vu_pengguna_paket`;

CREATE OR REPLACE ALGORITHM=MERGE SQL SECURITY INVOKER VIEW `vu_pengguna_paket` AS select `pengguna_paket`.`ppaket_cust` AS `ppaket_cust`,`paket_isi_perawatan`.`rpaket_master` AS `rpaket_master`,`detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`detail_jual_paket`.`dpaket_master` AS `dpaket_master`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,`paket_isi_perawatan`.`rpaket_perawatan` AS `rpaket_perawatan`,`paket_isi_perawatan`.`rpaket_jumlah` AS `rpaket_jumlah` from ((`detail_jual_paket` join `paket_isi_perawatan` on((`paket_isi_perawatan`.`rpaket_master` = `detail_jual_paket`.`dpaket_paket`))) left join `pengguna_paket` on((`pengguna_paket`.`ppaket_master` = `detail_jual_paket`.`dpaket_master`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_perawatan_alat`
--
DROP VIEW IF EXISTS `vu_perawatan_alat`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_perawatan_alat` AS select `vu_perawatan`.`rawat_id` AS `rawat_id`,`vu_perawatan`.`rawat_kode` AS `rawat_kode`,`vu_perawatan`.`rawat_nama` AS `rawat_nama`,`vu_perawatan`.`rawat_group` AS `rawat_group`,`vu_perawatan`.`group_nama` AS `group_nama`,`vu_perawatan`.`rawat_kategori` AS `rawat_kategori`,`vu_perawatan`.`kategori_nama` AS `kategori_nama`,`vu_perawatan`.`kategori_jenis` AS `kategori_jenis`,`vu_perawatan`.`kategori_akun` AS `kategori_akun`,`vu_perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`vu_perawatan`.`rawat_du` AS `rawat_du`,`vu_perawatan`.`rawat_dm` AS `rawat_dm`,`vu_perawatan`.`rawat_point` AS `rawat_point`,`vu_perawatan`.`rawat_harga` AS `rawat_harga`,`vu_perawatan`.`rawat_aktif` AS `rawat_aktif`,`vu_perawatan`.`rawat_gudang` AS `rawat_gudang`,`vu_perawatan`.`gudang_nama` AS `gudang_nama`,`vu_perawatan`.`gudang_lokasi` AS `gudang_lokasi`,`perawatan_alat`.`arawat_alat` AS `arawat_alat`,`perawatan_alat`.`arawat_jumlah` AS `arawat_jumlah` from (`vu_perawatan` join `perawatan_alat` on((`perawatan_alat`.`arawat_master` = `vu_perawatan`.`rawat_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_produk_konversi`
--
DROP VIEW IF EXISTS `vu_produk_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_produk_konversi` AS select `vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`kategori_jenis` AS `kategori_jenis`,`vu_produk`.`kategori_akun` AS `kategori_akun`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_satuan` AS `produk_satuan`,`vu_produk`.`satuan_nama` AS `satuan_nama`,`vu_produk`.`produk_du` AS `produk_du`,`vu_produk`.`produk_dm` AS `produk_dm`,`vu_produk`.`produk_point` AS `produk_point`,`vu_produk`.`produk_harga` AS `produk_harga`,`vu_produk`.`produk_aktif` AS `produk_aktif`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_nama` AS `satuan_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai` from ((`vu_produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `vu_produk`.`produk_id`))) join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_perawatan_konsumsi`
--
DROP VIEW IF EXISTS `vu_perawatan_konsumsi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_perawatan_konsumsi` AS select `vu_perawatan`.`rawat_id` AS `rawat_id`,`vu_perawatan`.`rawat_kode` AS `rawat_kode`,`vu_perawatan`.`rawat_nama` AS `rawat_nama`,`vu_perawatan`.`rawat_group` AS `rawat_group`,`vu_perawatan`.`group_nama` AS `group_nama`,`vu_perawatan`.`rawat_kategori` AS `rawat_kategori`,`vu_perawatan`.`kategori_nama` AS `kategori_nama`,`vu_perawatan`.`kategori_jenis` AS `kategori_jenis`,`vu_perawatan`.`kategori_akun` AS `kategori_akun`,`vu_perawatan`.`rawat_keterangan` AS `rawat_keterangan`,`vu_perawatan`.`rawat_du` AS `rawat_du`,`vu_perawatan`.`rawat_dm` AS `rawat_dm`,`vu_perawatan`.`rawat_point` AS `rawat_point`,`vu_perawatan`.`rawat_harga` AS `rawat_harga`,`vu_perawatan`.`rawat_aktif` AS `rawat_aktif`,`vu_perawatan`.`rawat_gudang` AS `rawat_gudang`,`vu_perawatan`.`gudang_nama` AS `gudang_nama`,`vu_perawatan`.`gudang_lokasi` AS `gudang_lokasi`,`vu_produk_konversi`.`produk_kode` AS `produk_kode`,`vu_produk_konversi`.`produk_nama` AS `produk_nama`,`vu_produk_konversi`.`satuan_konversi` AS `satuan_konversi`,`vu_produk_konversi`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_konversi`.`konversi_nilai` AS `konversi_nilai`,`perawatan_konsumsi`.`krawat_jumlah` AS `krawat_jumlah` from ((`vu_perawatan` join `perawatan_konsumsi` on((`perawatan_konsumsi`.`krawat_master` = `vu_perawatan`.`rawat_id`))) join `vu_produk_konversi` on(((`perawatan_konsumsi`.`krawat_produk` = `vu_produk_konversi`.`produk_id`) and (`perawatan_konsumsi`.`krawat_satuan` = `vu_produk_konversi`.`konversi_satuan`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_permissions`
--
DROP VIEW IF EXISTS `vu_permissions`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_permissions` AS select `menus`.`menu_id` AS `menu_id`,`menus`.`menu_parent` AS `menu_parent`,`menus`.`menu_position` AS `menu_position`,`menus`.`menu_title` AS `menu_title`,`menus`.`menu_link` AS `menu_link`,`menus`.`menu_cat` AS `menu_cat`,`menus`.`menu_confirm` AS `menu_confirm`,`menus`.`menu_leftpanel` AS `menu_leftpanel`,`menus`.`menu_iconpanel` AS `menu_iconpanel`,`menus`.`menu_iconmenu` AS `menu_iconmenu`,`permissions`.`perm_priv` AS `perm_priv`,`permissions`.`perm_group` AS `perm_group`,`usergroups`.`group_name` AS `group_name`,`usergroups`.`group_desc` AS `group_desc`,`usergroups`.`group_active` AS `group_active`,`usergroups`.`group_id` AS `group_id`,`permissions`.`perm_menu` AS `perm_menu`,(`permissions`.`perm_priv` like _latin1'%R%') AS `perm_read`,(`permissions`.`perm_priv` like _latin1'%C%') AS `perm_create`,(`permissions`.`perm_priv` like _latin1'%U%') AS `perm_update`,(`permissions`.`perm_priv` like _latin1'%D%') AS `perm_delete` from ((`menus` left join `permissions` on((`permissions`.`perm_menu` = `menus`.`menu_id`))) left join `usergroups` on((`usergroups`.`group_id` = `permissions`.`perm_group`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_phonegroup`
--
DROP VIEW IF EXISTS `vu_phonegroup`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_phonegroup` AS select count(`phonegrouped`.`phonegrouped_number`) AS `phonegroup_jumlah`,`phonegroup`.`phonegroup_id` AS `phonegroup_id`,`phonegroup`.`phonegroup_nama` AS `phonegroup_nama`,`phonegroup`.`phonegroup_detail` AS `phonegroup_detail` from (`phonegroup` join `phonegrouped`) where (`phonegrouped`.`phonegrouped_group` = `phonegroup`.`phonegroup_id`) group by `phonegroup`.`phonegroup_id`,`phonegroup`.`phonegroup_nama`,`phonegroup`.`phonegroup_detail`;

-- --------------------------------------------------------

--
-- Structure for view `vu_piutang_jpaket`
--
DROP VIEW IF EXISTS `vu_piutang_jpaket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jpaket` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_bayar` AS `jpaket_bayar`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_totalbiaya` AS `total_jual`,(`master_jual_paket`.`jpaket_totalbiaya` - `master_jual_paket`.`jpaket_bayar`) AS `piutang_total` from (`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) group by `master_jual_paket`.`jpaket_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_piutang_jproduk`
--
DROP VIEW IF EXISTS `vu_piutang_jproduk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jproduk` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_bayar` AS `jproduk_bayar`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_totalbiaya` AS `total_jual`,(`master_jual_produk`.`jproduk_totalbiaya` - `master_jual_produk`.`jproduk_bayar`) AS `piutang_total` from (`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) group by `master_jual_produk`.`jproduk_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_piutang_jrawat`
--
DROP VIEW IF EXISTS `vu_piutang_jrawat`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_piutang_jrawat` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_bayar` AS `jrawat_bayar`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_totalbiaya` AS `total_jual`,(`master_jual_rawat`.`jrawat_totalbiaya` - `master_jual_rawat`.`jrawat_bayar`) AS `piutang_total` from (`detail_jual_rawat` left join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) group by `master_jual_rawat`.`jrawat_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_produk_satuan_default`
--
DROP VIEW IF EXISTS `vu_produk_satuan_default`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_produk_satuan_default` AS select `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`produk`.`produk_point` AS `produk_point`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_aktif` AS `satuan_aktif`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_group` AS `produk_group`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm` from ((`produk` join `satuan_konversi` on((`satuan_konversi`.`konversi_produk` = `produk`.`produk_id`))) join `satuan` on((`satuan`.`satuan_id` = `satuan_konversi`.`konversi_satuan`))) where (`satuan_konversi`.`konversi_default` = 1);

-- --------------------------------------------------------

--
-- Structure for view `vu_report_tindakan_dokter`
--
DROP VIEW IF EXISTS `vu_report_tindakan_dokter`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_report_tindakan_dokter` AS select count(`appointment_detail`.`dapp_petugas`) AS `dokter_count`,`appointment_detail`.`dapp_petugas` AS `dokter_id`,date_format(`appointment_detail`.`dapp_tgldatang`,'%Y-%m') AS `dokter_bulan` from `appointment_detail` where ((`appointment_detail`.`dapp_petugas` <> 0) and (`appointment_detail`.`dapp_status` = 'datang')) group by date_format(`appointment_detail`.`dapp_tgldatang`,'%Y-%m'),`appointment_detail`.`dapp_petugas`;

-- --------------------------------------------------------

--
-- Structure for view `vu_report_tindakan_terapis`
--
DROP VIEW IF EXISTS `vu_report_tindakan_terapis`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_report_tindakan_terapis` AS select count(`appointment_detail`.`dapp_petugas2`) AS `terapis_count`,`appointment_detail`.`dapp_petugas2` AS `terapis_id`,date_format(`appointment_detail`.`dapp_tgldatang`,'%Y-%m') AS `terapis_bulan` from `appointment_detail` where ((`appointment_detail`.`dapp_counter` = 'true') and (`appointment_detail`.`dapp_petugas2` <> 0) and (`appointment_detail`.`dapp_status` = 'datang')) group by date_format(`appointment_detail`.`dapp_tgldatang`,'%Y-%m'),`appointment_detail`.`dapp_petugas2`;

-- --------------------------------------------------------

--
-- Structure for view `vu_satuan_konversi`
--
DROP VIEW IF EXISTS `vu_satuan_konversi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_satuan_konversi` AS select `satuan`.`satuan_id` AS `satuan_id`,`satuan_konversi`.`konversi_id` AS `konversi_id`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`vu_produk`.`produk_id` AS `produk_id`,`vu_produk`.`produk_kode` AS `produk_kode`,`vu_produk`.`produk_group` AS `produk_group`,`vu_produk`.`produk_kategori` AS `produk_kategori`,`vu_produk`.`produk_kontribusi` AS `produk_kontribusi`,`vu_produk`.`produk_nama` AS `produk_nama`,`vu_produk`.`produk_jenis` AS `produk_jenis`,`vu_produk`.`group_nama` AS `group_nama`,`vu_produk`.`kategori_nama` AS `kategori_nama`,`vu_produk`.`jenis_nama` AS `jenis_nama`,`vu_produk`.`kategori2_nama` AS `kategori2_nama`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan`.`satuan_kode` AS `satuan_kode`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`vu_produk`.`produk_aktif` AS `produk_aktif` from ((`satuan_konversi` join `satuan` on((`satuan_konversi`.`konversi_satuan` = `satuan`.`satuan_id`))) join `vu_produk` on((`satuan_konversi`.`konversi_produk` = `vu_produk`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_jual_produk`
--
DROP VIEW IF EXISTS `vu_stok_jual_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_jual_produk` AS select `master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,sum(`detail_jual_produk`.`dproduk_jumlah`) AS `dproduk_jumlah`,`detail_jual_produk`.`dproduk_harga` AS `dproduk_harga`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,sum((`detail_jual_produk`.`dproduk_jumlah` * `satuan_konversi`.`konversi_nilai`)) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`konversi_produk` AS `konversi_produk`,`vu_produk_satuan_terkecil`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif` AS `satuan_aktif`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`satuan_konversi`.`konversi_default` AS `konversi_default` from (((`detail_jual_produk` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `detail_jual_produk`.`dproduk_master`))) join `satuan_konversi` on(((`detail_jual_produk`.`dproduk_satuan` = `satuan_konversi`.`konversi_satuan`) and (`detail_jual_produk`.`dproduk_produk` = `satuan_konversi`.`konversi_produk`)))) join `vu_produk_satuan_terkecil` on((`detail_jual_produk`.`dproduk_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) group by `master_jual_produk`.`jproduk_tanggal`,`detail_jual_produk`.`dproduk_satuan`,`detail_jual_produk`.`dproduk_harga`,`satuan_konversi`.`konversi_nilai`,`vu_produk_satuan_terkecil`.`produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point`,`vu_produk_satuan_terkecil`.`konversi_satuan`,`vu_produk_satuan_terkecil`.`satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama`,`vu_produk_satuan_terkecil`.`satuan_aktif`,`vu_produk_satuan_terkecil`.`produk_id`,`satuan_konversi`.`konversi_default`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_pakai_cabin`
--
DROP VIEW IF EXISTS `vu_stok_pakai_cabin`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_pakai_cabin` AS select `detail_pakai_cabin`.`cabin_dtrawat` AS `cabin_dtrawat`,`detail_pakai_cabin`.`cabin_rawat` AS `cabin_rawat`,`detail_pakai_cabin`.`cabin_produk` AS `cabin_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`detail_pakai_cabin`.`cabin_satuan` AS `cabin_satuan`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_pakai_cabin`.`cabin_jumlah` AS `cabin_jumlah`,`detail_pakai_cabin`.`cabin_date_create` AS `cabin_date_create`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_pakai_cabin`.`cabin_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`detail_pakai_cabin`.`cabin_gudang` AS `cabin_gudang`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi` from (((`detail_pakai_cabin` join `satuan_konversi` on(((`detail_pakai_cabin`.`cabin_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_pakai_cabin`.`cabin_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `gudang` on((`detail_pakai_cabin`.`cabin_gudang` = `gudang`.`gudang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_beli`
--
DROP VIEW IF EXISTS `vu_stok_retur_beli`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_retur_beli` AS select `master_retur_beli`.`rbeli_tanggal` AS `rbeli_tanggal`,`detail_retur_beli`.`drbeli_master` AS `drbeli_master`,`detail_retur_beli`.`drbeli_id` AS `drbeli_id`,`detail_retur_beli`.`drbeli_produk` AS `drbeli_produk`,`detail_retur_beli`.`drbeli_satuan` AS `drbeli_satuan`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_retur_beli`.`drbeli_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from (((`detail_retur_beli` join `master_retur_beli` on((`detail_retur_beli`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `satuan_konversi` on(((`satuan_konversi`.`konversi_produk` = `detail_retur_beli`.`drbeli_produk`) and (`detail_retur_beli`.`drbeli_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_paket`
--
DROP VIEW IF EXISTS `vu_stok_retur_jual_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_retur_jual_paket` AS select `master_retur_jual_paket`.`rpaket_tanggal` AS `rpaket_tanggal`,`detail_retur_paket_produk`.`drpaket_id` AS `drpaket_id`,`detail_retur_paket_produk`.`drpaket_master` AS `drpaket_master`,`detail_retur_paket_produk`.`drpaket_produk` AS `drpaket_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_retur_paket_produk`.`drpaket_satuan` AS `drpaket_satuan`,`detail_retur_paket_produk`.`drpaket_jumlah` AS `drpaket_jumlah`,`detail_retur_paket_produk`.`drpaket_harga` AS `drpaket_harga`,(`detail_retur_paket_produk`.`drpaket_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from (((`detail_retur_paket_produk` join `master_retur_jual_paket` on((`detail_retur_paket_produk`.`drpaket_master` = `master_retur_jual_paket`.`rpaket_id`))) join `satuan_konversi` on(((`detail_retur_paket_produk`.`drpaket_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_paket_produk`.`drpaket_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_retur_jual_produk`
--
DROP VIEW IF EXISTS `vu_stok_retur_jual_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_retur_jual_produk` AS select `master_retur_jual_produk`.`rproduk_tanggal` AS `rproduk_tanggal`,`detail_retur_jual_produk`.`drproduk_produk` AS `drproduk_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_retur_jual_produk`.`drproduk_satuan` AS `drproduk_satuan`,`detail_retur_jual_produk`.`drproduk_jumlah` AS `drproduk_jumlah`,(`detail_retur_jual_produk`.`drproduk_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama` from (((`detail_retur_jual_produk` join `master_retur_jual_produk` on((`detail_retur_jual_produk`.`drproduk_master` = `master_retur_jual_produk`.`rproduk_id`))) join `satuan_konversi` on(((`detail_retur_jual_produk`.`drproduk_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_retur_jual_produk`.`drproduk_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_terima`
--
DROP VIEW IF EXISTS `vu_stok_terima`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_terima` AS select `detail_terima_beli`.`dterima_master` AS `dterima_master`,`detail_terima_beli`.`dterima_produk` AS `dterima_produk`,`satuan_konversi`.`konversi_id` AS `konversi_id`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`detail_terima_beli`.`dterima_satuan` AS `dterima_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,(`detail_terima_beli`.`dterima_jumlah` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`master_terima_beli`.`terima_tanggal` AS `terima_tanggal`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`detail_terima_beli`.`dterima_jumlah` AS `dterima_jumlah` from (((`detail_terima_beli` join `satuan_konversi` on(((`detail_terima_beli`.`dterima_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_terima_beli`.`dterima_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `master_terima_beli` on((`detail_terima_beli`.`dterima_master` = `master_terima_beli`.`terima_id`))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_koreksi`
--
DROP VIEW IF EXISTS `vu_stok_koreksi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_koreksi` AS select `master_koreksi_stok`.`koreksi_tanggal` AS `koreksi_tanggal`,`master_koreksi_stok`.`koreksi_gudang` AS `koreksi_gudang`,`detail_koreksi_stok`.`dkoreksi_master` AS `dkoreksi_master`,`detail_koreksi_stok`.`dkoreksi_produk` AS `dkoreksi_produk`,`satuan_konversi`.`konversi_produk` AS `konversi_produk`,`satuan_konversi`.`konversi_satuan` AS `konversi_satuan`,`satuan_konversi`.`konversi_nilai` AS `konversi_nilai`,`satuan_konversi`.`konversi_default` AS `konversi_default`,`detail_koreksi_stok`.`dkoreksi_satuan` AS `dkoreksi_satuan`,`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` AS `dkoreksi_jmlkoreksi`,(`detail_koreksi_stok`.`dkoreksi_jmlkoreksi` * `satuan_konversi`.`konversi_nilai`) AS `jumlah_konversi`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`gudang`.`gudang_id` AS `gudang_id`,`gudang`.`gudang_nama` AS `gudang_nama`,`gudang`.`gudang_lokasi` AS `gudang_lokasi` from ((((`detail_koreksi_stok` join `master_koreksi_stok` on((`detail_koreksi_stok`.`dkoreksi_master` = `master_koreksi_stok`.`koreksi_id`))) join `satuan_konversi` on(((`detail_koreksi_stok`.`dkoreksi_produk` = `satuan_konversi`.`konversi_produk`) and (`detail_koreksi_stok`.`dkoreksi_satuan` = `satuan_konversi`.`konversi_satuan`)))) join `vu_produk_satuan_terkecil` on((`satuan_konversi`.`konversi_produk` = `vu_produk_satuan_terkecil`.`produk_id`))) join `gudang` on((`master_koreksi_stok`.`koreksi_gudang` = `gudang`.`gudang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_all`
--
DROP VIEW IF EXISTS `vu_stok_all`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_all` AS select date_format(`vu_stok_jual_produk`.`jproduk_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_jual_produk`.`produk_kode` AS `produk_kode`,`vu_stok_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_jual_produk`.`satuan_kode` AS `satuan_kode`,`vu_stok_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_jual_produk`.`jumlah_konversi` AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_jual_produk` union select date_format(`vu_stok_pakai_cabin`.`cabin_date_create`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_pakai_cabin`.`produk_id` AS `produk_id`,`vu_stok_pakai_cabin`.`produk_kode` AS `produk_kode`,`vu_stok_pakai_cabin`.`produk_nama` AS `produk_nama`,`vu_stok_pakai_cabin`.`satuan_id` AS `satuan_id`,`vu_stok_pakai_cabin`.`satuan_kode` AS `satuan_kode`,`vu_stok_pakai_cabin`.`satuan_nama` AS `satuan_nama`,`vu_stok_pakai_cabin`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_pakai_cabin`.`jumlah_konversi` AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_pakai_cabin` union select date_format(`vu_stok_retur_beli`.`rbeli_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_retur_beli`.`produk_id` AS `produk_id`,`vu_stok_retur_beli`.`produk_kode` AS `produk_kode`,`vu_stok_retur_beli`.`produk_nama` AS `produk_nama`,`vu_stok_retur_beli`.`satuan_id` AS `satuan_id`,`vu_stok_retur_beli`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_beli`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_beli`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,`vu_stok_retur_beli`.`jumlah_konversi` AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_beli` union select date_format(`vu_stok_retur_jual_paket`.`rpaket_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_retur_jual_paket`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_paket`.`produk_kode` AS `produk_kode`,`vu_stok_retur_jual_paket`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_paket`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_paket`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_jual_paket`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_paket`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,`vu_stok_retur_jual_paket`.`jumlah_konversi` AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_paket` union select date_format(`vu_stok_retur_jual_produk`.`rproduk_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_retur_jual_produk`.`produk_id` AS `produk_id`,`vu_stok_retur_jual_produk`.`produk_kode` AS `produk_kode`,`vu_stok_retur_jual_produk`.`produk_nama` AS `produk_nama`,`vu_stok_retur_jual_produk`.`satuan_id` AS `satuan_id`,`vu_stok_retur_jual_produk`.`satuan_kode` AS `satuan_kode`,`vu_stok_retur_jual_produk`.`satuan_nama` AS `satuan_nama`,`vu_stok_retur_jual_produk`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,`vu_stok_retur_jual_produk`.`jumlah_konversi` AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_retur_jual_produk` union select date_format(`vu_stok_terima`.`terima_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_terima`.`produk_id` AS `produk_id`,`vu_stok_terima`.`produk_kode` AS `produk_kode`,`vu_stok_terima`.`produk_nama` AS `produk_nama`,`vu_stok_terima`.`satuan_id` AS `satuan_id`,`vu_stok_terima`.`satuan_kode` AS `satuan_kode`,`vu_stok_terima`.`satuan_nama` AS `satuan_nama`,`vu_stok_terima`.`konversi_default` AS `konversi_default`,`vu_stok_terima`.`jumlah_konversi` AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,0 AS `jumlah_koreksi` from `vu_stok_terima` union select date_format(`vu_stok_koreksi`.`koreksi_tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,`vu_stok_koreksi`.`konversi_default` AS `konversi_default`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_cabin`,`vu_stok_koreksi`.`jumlah_konversi` AS `jumlah_koreksi` from `vu_stok_koreksi`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_all_saldo_tanggal`
--
DROP VIEW IF EXISTS `vu_stok_all_saldo_tanggal`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_all_saldo_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,sum(`vu_stok_all`.`jumlah_cabin`) AS `jumlah_cabin`,sum(`vu_stok_all`.`jumlah_koreksi`) AS `jumlah_koreksi`,((((((sum(`vu_stok_all`.`jumlah_terima`) - sum(`vu_stok_all`.`jumlah_retur_beli`)) - sum(`vu_stok_all`.`jumlah_jual`)) + sum(`vu_stok_all`.`jumlah_retur_produk`)) + sum(`vu_stok_all`.`jumlah_retur_paket`)) - sum(`vu_stok_all`.`jumlah_cabin`)) + sum(`vu_stok_all`.`jumlah_koreksi`)) AS `jumlah_saldo` from (`vu_stok_all` join `vu_produk_satuan_terkecil` on((`vu_stok_all`.`produk_id` = `vu_produk_satuan_terkecil`.`produk_id`))) group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id`,`vu_stok_all`.`produk_nama`,`vu_produk_satuan_terkecil`.`satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_all_saldo`
--
DROP VIEW IF EXISTS `vu_stok_all_saldo`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_all_saldo` AS select `a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_nama` AS `satuan_nama`,ifnull(sum(`a`.`jumlah_terima`),0) AS `jumlah_terima`,ifnull(sum(`a`.`jumlah_retur_beli`),0) AS `jumlah_retur_beli`,ifnull(sum(`a`.`jumlah_jual`),0) AS `jumlah_jual`,ifnull(sum(`a`.`jumlah_retur_produk`),0) AS `jumlah_retur_produk`,ifnull(sum(`a`.`jumlah_retur_paket`),0) AS `jumlah_retur_paket`,ifnull(sum(`a`.`jumlah_cabin`),0) AS `jumlah_cabin`,ifnull(sum(`a`.`jumlah_koreksi`),0) AS `jumlah_koreksi`,ifnull(sum(`a`.`jumlah_saldo`),0) AS `stok_saldo` from `vu_stok_all_saldo_tanggal` `a` group by `a`.`produk_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_mutasi`
--
DROP VIEW IF EXISTS `vu_stok_mutasi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_mutasi` AS select `vu_detail_mutasi`.`mutasi_id` AS `mutasi_id`,`vu_detail_mutasi`.`mutasi_asal` AS `mutasi_asal`,`vu_detail_mutasi`.`gudang_asal_id` AS `gudang_asal_id`,`vu_detail_mutasi`.`gudang_asal_nama` AS `gudang_asal_nama`,`vu_detail_mutasi`.`gudang_asala_lokasi` AS `gudang_asala_lokasi`,`vu_detail_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`vu_detail_mutasi`.`gudang_tujuan_id` AS `gudang_tujuan_id`,`vu_detail_mutasi`.`gudang_tujuan_nama` AS `gudang_tujuan_nama`,`vu_detail_mutasi`.`gudang_tujuan_lokasi` AS `gudang_tujuan_lokasi`,`vu_detail_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_detail_mutasi`.`dmutasi_id` AS `dmutasi_id`,`vu_detail_mutasi`.`dmutasi_produk` AS `dmutasi_produk`,`vu_produk_satuan_terkecil`.`produk_id` AS `produk_id`,`vu_produk_satuan_terkecil`.`produk_kode` AS `produk_kode`,`vu_produk_satuan_terkecil`.`produk_nama` AS `produk_nama`,`vu_produk_satuan_terkecil`.`produk_harga` AS `produk_harga`,`vu_produk_satuan_terkecil`.`produk_volume` AS `produk_volume`,`vu_produk_satuan_terkecil`.`produk_jenis` AS `produk_jenis`,`vu_produk_satuan_terkecil`.`produk_point` AS `produk_point`,`vu_produk_satuan_terkecil`.`konversi_produk` AS `konversi_produk`,`vu_produk_satuan_terkecil`.`konversi_satuan` AS `konversi_satuan`,`vu_produk_satuan_terkecil`.`konversi_nilai` AS `konversi_nilai`,`vu_produk_satuan_terkecil`.`satuan_id` AS `satuan_id`,`vu_produk_satuan_terkecil`.`satuan_kode` AS `satuan_kode`,`vu_produk_satuan_terkecil`.`satuan_nama` AS `satuan_nama`,`vu_detail_mutasi`.`dmutasi_jumlah` AS `dmutasi_jumlah`,(`vu_detail_mutasi`.`dmutasi_jumlah` * `vu_produk_satuan_terkecil`.`konversi_nilai`) AS `jumlah_konversi` from (`vu_detail_mutasi` join `vu_produk_satuan_terkecil` on((`vu_detail_mutasi`.`dmutasi_produk` = `vu_produk_satuan_terkecil`.`produk_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_mutasi_all`
--
DROP VIEW IF EXISTS `vu_stok_mutasi_all`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_mutasi_all` AS select `a`.`mutasi_tanggal` AS `mutasi_tanggal`,`a`.`gudang_asal_id` AS `gudang_id`,`a`.`gudang_asal_nama` AS `gudang_nama`,`a`.`produk_id` AS `produk_id`,`a`.`produk_kode` AS `produk_kode`,`a`.`produk_nama` AS `produk_nama`,`a`.`satuan_id` AS `satuan_id`,`a`.`satuan_kode` AS `satuan_kode`,`a`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,`a`.`jumlah_konversi` AS `jumlah_keluar`,0 AS `jumlah_koreksi`,0 AS `jumlah_pakai` from `vu_stok_mutasi` `a` union select `b`.`mutasi_tanggal` AS `mutasi_tanggal`,`b`.`gudang_tujuan_id` AS `gudang_id`,`b`.`gudang_tujuan_nama` AS `gudang_nama`,`b`.`produk_id` AS `produk_id`,`b`.`produk_kode` AS `produk_kode`,`b`.`produk_nama` AS `produk_nama`,`b`.`satuan_id` AS `satuan_id`,`b`.`satuan_kode` AS `satuan_kode`,`b`.`satuan_nama` AS `satuan_nama`,`b`.`jumlah_konversi` AS `jumlah_masuk`,0 AS `jumlah_keluar`,0 AS `jumlah_koreksi`,0 AS `jumlah_pakai` from `vu_stok_mutasi` `b` union select `c`.`koreksi_tanggal` AS `mutasi_tanggal`,`c`.`gudang_id` AS `gudang_id`,`c`.`gudang_nama` AS `gudang_nama`,`c`.`produk_id` AS `produk_id`,`c`.`produk_kode` AS `produk_kode`,`c`.`produk_nama` AS `produk_nama`,`c`.`satuan_id` AS `satuan_id`,`c`.`satuan_kode` AS `satuan_kode`,`c`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,0 AS `jumlah_keluar`,`c`.`jumlah_konversi` AS `jumlah_koreksi`,0 AS `jumlah_pakai` from `vu_stok_koreksi` `c` union select date_format(`d`.`cabin_date_create`,_utf8'%Y-%m-%d') AS `mutasi_tanggal`,`d`.`gudang_id` AS `gudang_id`,`d`.`gudang_nama` AS `gudang_nama`,`d`.`produk_id` AS `produk_id`,`d`.`produk_kode` AS `produk_kode`,`d`.`produk_nama` AS `produk_nama`,`d`.`satuan_id` AS `satuan_id`,`d`.`satuan_kode` AS `satuan_kode`,`d`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_masuk`,0 AS `jumlah_keluar`,0 AS `jumlah_koreksi`,`d`.`jumlah_konversi` AS `jumlah_pakai` from `vu_stok_pakai_cabin` `d`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_all`
--
DROP VIEW IF EXISTS `vu_stok_gudang_all`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_gudang_all` AS select `vu_stok_mutasi_all`.`gudang_id` AS `gudang_id`,`vu_stok_mutasi_all`.`gudang_nama` AS `gudang_nama`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,(((sum(`vu_stok_mutasi_all`.`jumlah_masuk`) - sum(`vu_stok_mutasi_all`.`jumlah_keluar`)) + sum(`vu_stok_mutasi_all`.`jumlah_koreksi`)) - sum(`vu_stok_mutasi_all`.`jumlah_pakai`)) AS `jumlah_stok` from `vu_stok_mutasi_all` group by `vu_stok_mutasi_all`.`gudang_id`,`vu_stok_mutasi_all`.`gudang_nama`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_besar_tanggal`
--
DROP VIEW IF EXISTS `vu_stok_gudang_besar_tanggal`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_gudang_besar_tanggal` AS select distinct `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_terima`) AS `jumlah_terima`,sum(`vu_stok_all`.`jumlah_retur_beli`) AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` where ((`vu_stok_all`.`jumlah_terima` > 0) or (`vu_stok_all`.`jumlah_retur_beli` > 0)) group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id` union select distinct `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 1) group by `vu_stok_mutasi_all`.`mutasi_tanggal`,`vu_stok_mutasi_all`.`produk_id` union select distinct `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_terima`,0 AS `jumlah_retur_beli`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 1) group by `vu_stok_koreksi`.`koreksi_tanggal`,`vu_stok_koreksi`.`produk_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_besar_saldo`
--
DROP VIEW IF EXISTS `vu_stok_gudang_besar_saldo`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_gudang_besar_saldo` AS select `vu_stok_gudang_besar_tanggal`.`produk_id` AS `produk_id`,`vu_stok_gudang_besar_tanggal`.`produk_kode` AS `produk_kode`,`vu_stok_gudang_besar_tanggal`.`produk_nama` AS `produk_nama`,`vu_stok_gudang_besar_tanggal`.`satuan_id` AS `satuan_id`,`vu_stok_gudang_besar_tanggal`.`satuan_kode` AS `satuan_kode`,`vu_stok_gudang_besar_tanggal`.`satuan_nama` AS `satuan_nama`,((((sum(`vu_stok_gudang_besar_tanggal`.`jumlah_terima`) - sum(`vu_stok_gudang_besar_tanggal`.`jumlah_retur_beli`)) - sum(`vu_stok_gudang_besar_tanggal`.`jumlah_keluar`)) + sum(`vu_stok_gudang_besar_tanggal`.`jumlah_masuk`)) + sum(`vu_stok_gudang_besar_tanggal`.`jumlah_koreksi`)) AS `jumlah_stok` from `vu_stok_gudang_besar_tanggal` group by `vu_stok_gudang_besar_tanggal`.`produk_kode`,`vu_stok_gudang_besar_tanggal`.`produk_nama`,`vu_stok_gudang_besar_tanggal`.`satuan_id`,`vu_stok_gudang_besar_tanggal`.`satuan_kode`,`vu_stok_gudang_besar_tanggal`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_produk_tanggal`
--
DROP VIEW IF EXISTS `vu_stok_gudang_produk_tanggal`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_gudang_produk_tanggal` AS select `vu_stok_all`.`tanggal` AS `tanggal`,`vu_stok_all`.`produk_id` AS `produk_id`,`vu_stok_all`.`produk_kode` AS `produk_kode`,`vu_stok_all`.`produk_nama` AS `produk_nama`,`vu_stok_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_all`.`satuan_id` AS `satuan_id`,`vu_stok_all`.`satuan_nama` AS `satuan_nama`,sum(`vu_stok_all`.`jumlah_jual`) AS `jumlah_jual`,sum(`vu_stok_all`.`jumlah_retur_produk`) AS `jumlah_retur_produk`,sum(`vu_stok_all`.`jumlah_retur_paket`) AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_all` group by `vu_stok_all`.`tanggal`,`vu_stok_all`.`produk_id`,`vu_stok_all`.`produk_kode`,`vu_stok_all`.`produk_nama`,`vu_stok_all`.`satuan_kode`,`vu_stok_all`.`satuan_nama`,`vu_stok_all`.`satuan_id` union select `vu_stok_mutasi_all`.`mutasi_tanggal` AS `tanggal`,`vu_stok_mutasi_all`.`produk_id` AS `produk_id`,`vu_stok_mutasi_all`.`produk_kode` AS `produk_kode`,`vu_stok_mutasi_all`.`produk_nama` AS `produk_nama`,`vu_stok_mutasi_all`.`satuan_kode` AS `satuan_kode`,`vu_stok_mutasi_all`.`satuan_id` AS `satuan_id`,`vu_stok_mutasi_all`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,`vu_stok_mutasi_all`.`jumlah_keluar` AS `jumlah_keluar`,`vu_stok_mutasi_all`.`jumlah_masuk` AS `jumlah_masuk`,0 AS `jumlah_koreksi` from `vu_stok_mutasi_all` where (`vu_stok_mutasi_all`.`gudang_id` = 2) group by `vu_stok_mutasi_all`.`mutasi_tanggal`,`vu_stok_mutasi_all`.`produk_id`,`vu_stok_mutasi_all`.`produk_kode`,`vu_stok_mutasi_all`.`produk_nama`,`vu_stok_mutasi_all`.`satuan_kode`,`vu_stok_mutasi_all`.`satuan_nama`,`vu_stok_mutasi_all`.`satuan_id` union select `vu_stok_koreksi`.`koreksi_tanggal` AS `tanggal`,`vu_stok_koreksi`.`produk_id` AS `produk_id`,`vu_stok_koreksi`.`produk_kode` AS `produk_kode`,`vu_stok_koreksi`.`produk_nama` AS `produk_nama`,`vu_stok_koreksi`.`satuan_kode` AS `satuan_kode`,`vu_stok_koreksi`.`satuan_id` AS `satuan_id`,`vu_stok_koreksi`.`satuan_nama` AS `satuan_nama`,0 AS `jumlah_jual`,0 AS `jumlah_retur_produk`,0 AS `jumlah_retur_paket`,0 AS `jumlah_keluar`,0 AS `jumlah_masuk`,sum(`vu_stok_koreksi`.`jumlah_konversi`) AS `jumlah_koreksi` from `vu_stok_koreksi` where (`vu_stok_koreksi`.`koreksi_gudang` = 2) group by `vu_stok_koreksi`.`koreksi_tanggal`,`vu_stok_koreksi`.`produk_id`,`vu_stok_koreksi`.`produk_kode`,`vu_stok_koreksi`.`produk_nama`,`vu_stok_koreksi`.`satuan_kode`,`vu_stok_koreksi`.`satuan_nama`,`vu_stok_koreksi`.`satuan_id`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_gudang_produk_saldo`
--
DROP VIEW IF EXISTS `vu_stok_gudang_produk_saldo`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_gudang_produk_saldo` AS select `vu_stok_gudang_produk_tanggal`.`produk_id` AS `produk_id`,`vu_stok_gudang_produk_tanggal`.`produk_kode` AS `produk_kode`,`vu_stok_gudang_produk_tanggal`.`produk_nama` AS `produk_nama`,`vu_stok_gudang_produk_tanggal`.`satuan_id` AS `satuan_id`,`vu_stok_gudang_produk_tanggal`.`satuan_kode` AS `satuan_kode`,`vu_stok_gudang_produk_tanggal`.`satuan_nama` AS `satuan_nama`,(((((sum(`vu_stok_gudang_produk_tanggal`.`jumlah_retur_produk`) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_retur_paket`)) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_keluar`)) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_masuk`)) + sum(`vu_stok_gudang_produk_tanggal`.`jumlah_koreksi`)) - sum(`vu_stok_gudang_produk_tanggal`.`jumlah_jual`)) AS `jumlah_stok` from `vu_stok_gudang_produk_tanggal` group by `vu_stok_gudang_produk_tanggal`.`produk_kode`,`vu_stok_gudang_produk_tanggal`.`produk_nama`,`vu_stok_gudang_produk_tanggal`.`satuan_id`,`vu_stok_gudang_produk_tanggal`.`satuan_kode`,`vu_stok_gudang_produk_tanggal`.`satuan_nama`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_new`
--
DROP VIEW IF EXISTS `vu_stok_new`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_new` AS select `mt`.`terima_tanggal` AS `tanggal`,`mt`.`terima_supplier` AS `asal`,1 AS `tujuan`,1 AS `gudang`,`mt`.`terima_no` AS `no_bukti`,'PB' AS `jenis_transaksi`,`mt`.`terima_status` AS `status`,`dt`.`dterima_produk` AS `produk`,`dt`.`dterima_satuan` AS `satuan`,`dt`.`dterima_jumlah` AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_keluar`,0 AS `jml_mutasi_masuk`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'beli' AS `keterangan` from (`detail_terima_beli` `dt` join `master_terima_beli` `mt`) where (`dt`.`dterima_master` = `mt`.`terima_id`) union select `mt`.`terima_tanggal` AS `tanggal`,`mt`.`terima_supplier` AS `asal`,1 AS `tujuan`,1 AS `gudang`,`mt`.`terima_no` AS `no_bukti`,'PB' AS `jenis_transaksi`,`mt`.`terima_status` AS `status`,`db`.`dtbonus_produk` AS `produk`,`db`.`dtbonus_satuan` AS `satuan`,0 AS `jml_terima_barang`,`db`.`dtbonus_jumlah` AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_keluar`,0 AS `jml_mutasi_masuk`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'bonus' AS `keterangan` from (`detail_terima_bonus` `db` join `master_terima_beli` `mt`) where (`db`.`dtbonus_master` = `mt`.`terima_id`) union select `mr`.`rbeli_tanggal` AS `tanggal`,`mr`.`rbeli_supplier` AS `asal`,1 AS `tujuan`,1 AS `gudang`,`mr`.`rbeli_nobukti` AS `no_bukti`,'RB' AS `jenis_transaksi`,`mr`.`rbeli_status` AS `status`,`dr`.`drbeli_produk` AS `produk`,`dr`.`drbeli_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,`dr`.`drbeli_jumlah` AS `jml_retur_beli`,0 AS `jml_mutasi_keluar`,0 AS `jml_mutasi_masuk`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'retur' AS `keterangan` from (`detail_retur_beli` `dr` join `master_retur_beli` `mr`) where (`dr`.`drbeli_master` = `mr`.`rbeli_id`) union select `mmm`.`mutasi_tanggal` AS `tanggal`,`mmm`.`mutasi_asal` AS `asal`,`mmm`.`mutasi_tujuan` AS `tujuan`,`mmm`.`mutasi_tujuan` AS `gudang`,`mmm`.`mutasi_no` AS `no_bukti`,'mutasi' AS `jenis_transaksi`,`mmm`.`mutasi_status` AS `status`,`dmm`.`dmutasi_produk` AS `produk`,`dmm`.`dmutasi_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,`dmm`.`dmutasi_jumlah` AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'mutasi masuk' AS `keterangan` from (`master_mutasi` `mmm` join `detail_mutasi` `dmm`) where (`dmm`.`dmutasi_master` = `mmm`.`mutasi_id`) union select `mmk`.`mutasi_tanggal` AS `tanggal`,`mmk`.`mutasi_asal` AS `asal`,`mmk`.`mutasi_tujuan` AS `tujuan`,`mmk`.`mutasi_asal` AS `gudang`,`mmk`.`mutasi_no` AS `no_bukti`,'mutasi' AS `jenis_transaksi`,`mmk`.`mutasi_status` AS `status`,`dmk`.`dmutasi_produk` AS `produk`,`dmk`.`dmutasi_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,`dmk`.`dmutasi_jumlah` AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'mutasi keluar' AS `keterangan` from (`master_mutasi` `mmk` join `detail_mutasi` `dmk`) where (`dmk`.`dmutasi_master` = `mmk`.`mutasi_id`) union select `mk`.`koreksi_tanggal` AS `tanggal`,`mk`.`koreksi_gudang` AS `asal`,`mk`.`koreksi_gudang` AS `tujuan`,`mk`.`koreksi_gudang` AS `gudang`,`mk`.`koreksi_no` AS `no_bukti`,'koreksi' AS `jenis_transaksi`,`mk`.`koreksi_status` AS `status`,`dk`.`dkoreksi_produk` AS `produk`,`dk`.`dkoreksi_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,`dk`.`dkoreksi_jmlkoreksi` AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'koreksi' AS `keterangan` from (`master_koreksi_stok` `mk` join `detail_koreksi_stok` `dk`) where (`mk`.`koreksi_id` = `dk`.`dkoreksi_master`) union select `mj`.`jproduk_tanggal` AS `tanggal`,2 AS `asal`,`mj`.`jproduk_cust` AS `tujuan`,2 AS `gudang`,`mj`.`jproduk_nobukti` AS `no_bukti`,'jual produk' AS `jenis_traksaksi`,`mj`.`jproduk_stat_dok` AS `status`,`dj`.`dproduk_produk` AS `produk`,`dj`.`dproduk_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,`dj`.`dproduk_jumlah` AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'customer' AS `keterangan` from (`master_jual_produk` `mj` join `detail_jual_produk` `dj`) where (`dj`.`dproduk_master` = `mj`.`jproduk_id`) union select `mjg`.`jpgrooming_tanggal` AS `tanggal`,2 AS `asal`,`mjg`.`jpgrooming_karyawan` AS `tujuan`,2 AS `gudang`,`mjg`.`jpgrooming_nobukti` AS `no_bukti`,'jual produk' AS `jenis_transaksi`,'Tertutup' AS `status`,`djg`.`dpgrooming_produk` AS `produk`,`djg`.`dpgrooming_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,`djg`.`dpgrooming_jumlah` AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'grooming' AS `keterangan` from (`master_jualproduk_grooming` `mjg` join `detail_jualproduk_grooming` `djg`) where (`mjg`.`jpgrooming_id` = `djg`.`dpgrooming_master`) union select `mrj`.`rproduk_tanggal` AS `tanggal`,`mrj`.`rproduk_cust` AS `asal`,2 AS `tujuan`,2 AS `gudang`,`mrj`.`rproduk_nobukti` AS `no_bukti`,'retur jual' AS `jenis_transaksi`,`mrj`.`rproduk_stat_dok` AS `status`,`drj`.`drproduk_produk` AS `produk`,`drj`.`drproduk_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,`drj`.`drproduk_jumlah` AS `jml_retur_produk`,0 AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'produk retur' AS `keterangan` from (`master_retur_jual_produk` `mrj` join `detail_retur_jual_produk` `drj`) where (`mrj`.`rproduk_id` = `drj`.`drproduk_master`) union select `mrp`.`rpaket_tanggal` AS `tanggal`,`mrp`.`rpaket_cust` AS `asal`,2 AS `tujuan`,2 AS `gudan`,`mrp`.`rpaket_nobukti` AS `no_bukti`,'retur jual' AS `jenis_transaksi`,`mrp`.`rpaket_stat_dok` AS `status`,`drp`.`drpaket_produk` AS `produk`,`drp`.`drpaket_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,`drp`.`drpaket_jumlah` AS `jml_retur_paket`,0 AS `jml_pakai_cabin`,'paket retur' AS `keterangan` from (`master_retur_jual_paket` `mrp` join `detail_retur_paket_produk` `drp`) where (`mrp`.`rpaket_id` = `drp`.`drpaket_master`) union select `cb`.`cabin_date_create` AS `tanggal`,`cb`.`cabin_gudang` AS `asal`,`cb`.`cabin_gudang` AS `tujuan`,`cb`.`cabin_gudang` AS `gudang`,`cb`.`cabin_bukti` AS `no_bukti`,'pakai cabin' AS `jenis_transaksi`,'Tertutup' AS `status`,`cb`.`cabin_produk` AS `produk`,`cb`.`cabin_satuan` AS `satuan`,0 AS `jml_terima_barang`,0 AS `jml_terima_bonus`,0 AS `jml_retur_beli`,0 AS `jml_mutasi_masuk`,0 AS `jml_mutasi_keluar`,0 AS `jml_koreksi_stok`,0 AS `jml_jual_produk`,0 AS `jml_jual_grooming`,0 AS `jml_retur_produk`,0 AS `jml_retur_paket`,`cb`.`cabin_jumlah` AS `jml_pakai_cabin`,'pakai cabin' AS `keterangan` from `detail_pakai_cabin` `cb`;

-- --------------------------------------------------------

--
-- Structure for view `vu_stok_new_produk`
--
DROP VIEW IF EXISTS `vu_stok_new_produk`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_stok_new_produk` AS select date_format(`vt`.`tanggal`,_utf8'%Y-%m-%d') AS `tanggal`,`vt`.`asal` AS `asal`,`vt`.`tujuan` AS `tujuan`,`pd`.`produk_id` AS `produk_id`,`vt`.`gudang` AS `gudang`,`vt`.`no_bukti` AS `no_bukti`,`pd`.`produk_kode` AS `produk_kode`,`pd`.`produk_nama` AS `produk_nama`,`pd`.`produk_volume` AS `produk_volume`,`st`.`satuan_kode` AS `satuan_kode`,`st`.`satuan_nama` AS `satuan_nama`,`sk`.`konversi_nilai` AS `konversi_nilai`,`vt`.`jml_terima_barang` AS `jml_terima_barang`,`vt`.`jml_terima_bonus` AS `jml_terima_bonus`,`vt`.`jml_retur_beli` AS `jml_retur_beli`,`vt`.`jml_mutasi_masuk` AS `jml_mutasi_masuk`,`vt`.`jml_mutasi_keluar` AS `jml_mutasi_keluar`,`vt`.`jml_koreksi_stok` AS `jml_koreksi_stok`,`vt`.`jml_jual_produk` AS `jml_jual_produk`,`vt`.`jml_jual_grooming` AS `jml_jual_grooming`,`vt`.`jml_retur_produk` AS `jml_retur_produk`,`vt`.`jml_retur_paket` AS `jml_retur_paket`,`vt`.`jml_pakai_cabin` AS `jml_pakai_cabin`,`vt`.`jenis_transaksi` AS `jenis_transaksi`,`vt`.`keterangan` AS `keterangan`,`vt`.`status` AS `status` from (((`produk` `pd` join `satuan` `st`) join `satuan_konversi` `sk`) join `vu_stok_new` `vt`) where ((`sk`.`konversi_produk` = `vt`.`produk`) and (`pd`.`produk_id` = `sk`.`konversi_produk`) and (`sk`.`konversi_satuan` = `vt`.`satuan`) and (`pd`.`produk_id` = `vt`.`produk`) and (`st`.`satuan_id` = `sk`.`konversi_satuan`));

-- --------------------------------------------------------

--
-- Structure for view `vu_tindakan`
--
DROP VIEW IF EXISTS `vu_tindakan`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_tindakan` AS select `tindakan`.`trawat_id` AS `trawat_id`,`tindakan`.`trawat_cust` AS `trawat_cust`,`tindakan`.`trawat_keterangan` AS `trawat_keterangan`,`tindakan`.`trawat_creator` AS `trawat_creator`,`tindakan`.`trawat_update` AS `trawat_update`,`tindakan`.`trawat_date_update` AS `trawat_date_update`,`tindakan`.`trawat_revised` AS `trawat_revised`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`tindakan_detail`.`dtrawat_id` AS `dtrawat_id`,`tindakan_detail`.`dtrawat_perawatan` AS `dtrawat_perawatan`,`tindakan_detail`.`dtrawat_jam` AS `dtrawat_jam`,`tindakan_detail`.`dtrawat_tglapp` AS `dtrawat_tglapp`,`tindakan_detail`.`dtrawat_status` AS `dtrawat_status`,`tindakan_detail`.`dtrawat_keterangan` AS `dtrawat_keterangan`,`tindakan_detail`.`dtrawat_dapp` AS `dtrawat_dapp`,`tindakan_detail`.`dtrawat_master` AS `dtrawat_master`,`tindakan_detail`.`dtrawat_petugas2` AS `dtrawat_petugas2`,`tindakan_detail`.`dtrawat_ambil_paket` AS `dtrawat_ambil_paket`,`tindakan_detail`.`dtrawat_jumlah` AS `dtrawat_jumlah`,if((`tindakan_detail`.`dtrawat_locked` = 0),'Terbuka','Tertutup') AS `dtrawat_edit`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`dokter`.`karyawan_nama` AS `dokter_nama`,`dokter`.`karyawan_id` AS `dokter_id`,`dokter`.`karyawan_username` AS `dokter_username`,`terapis`.`karyawan_nama` AS `terapis_nama`,`terapis`.`karyawan_id` AS `terapis_id`,`terapis`.`karyawan_username` AS `terapis_username`,`kategori`.`kategori_nama` AS `kategori_nama`,`tindakan_detail`.`dtrawat_jumlah` AS `jumlah` from ((((((`tindakan` join `customer` on((`tindakan`.`trawat_cust` = `customer`.`cust_id`))) join `tindakan_detail` on((`tindakan_detail`.`dtrawat_master` = `tindakan`.`trawat_id`))) left join `perawatan` on((`tindakan_detail`.`dtrawat_perawatan` = `perawatan`.`rawat_id`))) left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`))) left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_ambil_paket`
--
DROP VIEW IF EXISTS `vu_total_ambil_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_ambil_paket` AS select `vu_detail_ambil_paket`.`dapaket_dpaket` AS `dapaket_dpaket`,`vu_detail_ambil_paket`.`dapaket_jpaket` AS `dapaket_jpaket`,`vu_detail_ambil_paket`.`dapaket_paket` AS `dapaket_paket`,sum(`vu_detail_ambil_paket`.`total_ambil_item`) AS `total_ambil_paket` from `vu_detail_ambil_paket` group by `vu_detail_ambil_paket`.`dapaket_dpaket`,`vu_detail_ambil_paket`.`dapaket_jpaket`,`vu_detail_ambil_paket`.`dapaket_paket`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_invoice_group`
--
DROP VIEW IF EXISTS `vu_total_invoice_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_invoice_group` AS select `detail_invoice`.`dinvoice_master` AS `dinvoice_master`,ifnull(sum(`detail_invoice`.`dinvoice_jumlah`),0) AS `jumlah_barang`,ifnull(sum((((`detail_invoice`.`dinvoice_harga` * `detail_invoice`.`dinvoice_jumlah`) * (100 - `detail_invoice`.`dinvoice_diskon`)) / 100)),0) AS `total_nilai` from `detail_invoice` group by `detail_invoice`.`dinvoice_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_isi_paket`
--
DROP VIEW IF EXISTS `vu_total_isi_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_isi_paket` AS select `vu_pengguna_paket`.`dpaket_id` AS `dpaket_id`,`vu_pengguna_paket`.`dpaket_master` AS `dpaket_master`,`vu_pengguna_paket`.`dpaket_paket` AS `dpaket_paket`,sum(`vu_pengguna_paket`.`rpaket_jumlah`) AS `total_isi_paket` from `vu_pengguna_paket` group by `vu_pengguna_paket`.`dpaket_id`,`vu_pengguna_paket`.`dpaket_master`,`vu_pengguna_paket`.`dpaket_paket`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_mutasi_group`
--
DROP VIEW IF EXISTS `vu_total_mutasi_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_mutasi_group` AS select `detail_mutasi`.`dmutasi_master` AS `dmutasi_master`,sum(`detail_mutasi`.`dmutasi_jumlah`) AS `jumlah_barang` from `detail_mutasi` group by `detail_mutasi`.`dmutasi_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_order_group`
--
DROP VIEW IF EXISTS `vu_total_order_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_order_group` AS select sum(`detail_order_beli`.`dorder_jumlah`) AS `jumlah_barang`,sum((((`detail_order_beli`.`dorder_harga` * `detail_order_beli`.`dorder_jumlah`) * (100 - `detail_order_beli`.`dorder_diskon`)) / 100)) AS `total_nilai`,`detail_order_beli`.`dorder_master` AS `dorder_master` from `detail_order_beli` group by `detail_order_beli`.`dorder_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_retur_beli_group`
--
DROP VIEW IF EXISTS `vu_total_retur_beli_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_retur_beli_group` AS select `detail_retur_beli`.`drbeli_master` AS `drbeli_master`,sum(`detail_retur_beli`.`drbeli_jumlah`) AS `jumlah_barang`,sum((`detail_retur_beli`.`drbeli_harga` * `detail_retur_beli`.`drbeli_jumlah`)) AS `total_nilai` from `detail_retur_beli` group by `detail_retur_beli`.`drbeli_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_sisa_item_perawatan`
--
DROP VIEW IF EXISTS `vu_total_sisa_item_perawatan`;

CREATE OR REPLACE ALGORITHM=MERGE SQL SECURITY INVOKER VIEW `vu_total_sisa_item_perawatan` AS select `vu_pengguna_paket`.`ppaket_cust` AS `ppaket_cust`,`vu_pengguna_paket`.`dpaket_id` AS `dpaket_id`,`vu_pengguna_paket`.`dpaket_master` AS `dpaket_master`,`vu_pengguna_paket`.`dpaket_paket` AS `dpaket_paket`,`vu_pengguna_paket`.`rpaket_perawatan` AS `rpaket_perawatan`,`vu_pengguna_paket`.`rpaket_jumlah` AS `rpaket_jumlah`,`vu_detail_ambil_paket`.`total_ambil_item` AS `total_ambil_item`,(`vu_pengguna_paket`.`rpaket_jumlah` - if((`vu_detail_ambil_paket`.`total_ambil_item` <> 'null'),`vu_detail_ambil_paket`.`total_ambil_item`,0)) AS `total_sisa_item` from (`vu_pengguna_paket` left join `vu_detail_ambil_paket` on(((`vu_pengguna_paket`.`dpaket_paket` = `vu_detail_ambil_paket`.`dapaket_paket`) and (`vu_pengguna_paket`.`rpaket_perawatan` = `vu_detail_ambil_paket`.`dapaket_item`))));

-- --------------------------------------------------------

--
-- Structure for view `vu_total_sisa_paket`
--
DROP VIEW IF EXISTS `vu_total_sisa_paket`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_sisa_paket` AS select `detail_jual_paket`.`dpaket_id` AS `dpaket_id`,`detail_jual_paket`.`dpaket_master` AS `dpaket_master`,`detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,((`detail_jual_paket`.`dpaket_jumlah` * `paket`.`paket_jmlisi`) - if((sum(`detail_ambil_paket`.`dapaket_jumlah`) <> 'null'),sum(`detail_ambil_paket`.`dapaket_jumlah`),0)) AS `total_sisa_paket` from ((`detail_jual_paket` left join `detail_ambil_paket` on(((`detail_ambil_paket`.`dapaket_dpaket` = `detail_jual_paket`.`dpaket_id`) and (`detail_ambil_paket`.`dapaket_stat_dok` <> 'Batal')))) left join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) group by `detail_ambil_paket`.`dapaket_dpaket`,`detail_ambil_paket`.`dapaket_jpaket`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_terima_bonus_group`
--
DROP VIEW IF EXISTS `vu_total_terima_bonus_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_terima_bonus_group` AS select `detail_terima_bonus`.`dtbonus_master` AS `dtbonus_master`,sum(`detail_terima_bonus`.`dtbonus_jumlah`) AS `jumlah_barang_bonus` from `detail_terima_bonus` group by `detail_terima_bonus`.`dtbonus_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_total_terima_group`
--
DROP VIEW IF EXISTS `vu_total_terima_group`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_total_terima_group` AS select sum(`detail_terima_beli`.`dterima_jumlah`) AS `jumlah_barang`,`detail_terima_beli`.`dterima_master` AS `dterima_master` from `detail_terima_beli` group by `detail_terima_beli`.`dterima_master`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_terima`
--
DROP VIEW IF EXISTS `vu_trans_terima`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_terima` AS select `master_terima_beli`.`terima_id` AS `terima_id`,`master_terima_beli`.`terima_no` AS `no_bukti`,`master_terima_beli`.`terima_order` AS `terima_order`,`master_order_beli`.`order_no` AS `order_no`,`master_order_beli`.`order_tanggal` AS `order_tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,`master_order_beli`.`order_diskon` AS `order_diskon`,`master_order_beli`.`order_biaya` AS `order_biaya`,`master_order_beli`.`order_bayar` AS `order_bayar`,`supplier`.`supplier_id` AS `supplier_id`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_terima_beli`.`terima_supplier` AS `terima_supplier`,`master_terima_beli`.`terima_surat_jalan` AS `terima_surat_jalan`,`master_terima_beli`.`terima_pengirim` AS `terima_pengirim`,`master_terima_beli`.`terima_tanggal` AS `tanggal`,`master_terima_beli`.`terima_keterangan` AS `terima_keterangan`,`master_terima_beli`.`terima_status` AS `terima_status`,`master_terima_beli`.`terima_creator` AS `terima_creator`,`master_terima_beli`.`terima_date_create` AS `terima_date_create`,`master_terima_beli`.`terima_update` AS `terima_update`,`master_terima_beli`.`terima_date_update` AS `terima_date_update`,`master_terima_beli`.`terima_revised` AS `terima_revised`,ifnull(`vu_total_terima_bonus_group`.`jumlah_barang_bonus`,0) AS `jumlah_barang_bonus`,`vu_total_terima_group`.`jumlah_barang` AS `jumlah_barang` from ((((`master_terima_beli` join `supplier` on((`master_terima_beli`.`terima_supplier` = `supplier`.`supplier_id`))) join `master_order_beli` on((`master_terima_beli`.`terima_order` = `master_order_beli`.`order_id`))) left join `vu_total_terima_bonus_group` on((`vu_total_terima_bonus_group`.`dtbonus_master` = `master_terima_beli`.`terima_id`))) join `vu_total_terima_group` on((`vu_total_terima_group`.`dterima_master` = `master_terima_beli`.`terima_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_invoice`
--
DROP VIEW IF EXISTS `vu_trans_invoice`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_invoice` AS select `master_invoice`.`invoice_id` AS `invoice_id`,`master_invoice`.`invoice_no` AS `no_bukti`,`master_invoice`.`invoice_no_auto` AS `no_bukti_auto`,`master_invoice`.`invoice_supplier` AS `invoice_supplier`,`master_invoice`.`invoice_noterima` AS `invoice_noterima`,`master_invoice`.`invoice_tanggal` AS `tanggal`,`master_invoice`.`invoice_jatuhtempo` AS `invoice_jatuhtempo`,`master_invoice`.`invoice_penagih` AS `invoice_penagih`,`master_invoice`.`invoice_keterangan` AS `invoice_keterangan`,`master_invoice`.`invoice_status` AS `invoice_status`,`vu_total_invoice_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_invoice_group`.`total_nilai` AS `total_nilai`,`vu_total_invoice_group`.`dinvoice_master` AS `dinvoice_master`,`vu_trans_terima`.`no_bukti` AS `terima_no`,`vu_trans_terima`.`order_no` AS `order_no`,`vu_trans_terima`.`order_tanggal` AS `order_tanggal`,`vu_trans_terima`.`order_carabayar` AS `order_carabayar`,`vu_trans_terima`.`order_diskon` AS `order_diskon`,`vu_trans_terima`.`order_biaya` AS `order_biaya`,`vu_trans_terima`.`order_bayar` AS `order_bayar`,`vu_trans_terima`.`supplier_nama` AS `supplier_nama`,`vu_trans_terima`.`supplier_alamat` AS `supplier_alamat`,`vu_trans_terima`.`supplier_kota` AS `supplier_kota`,`vu_trans_terima`.`terima_pengirim` AS `terima_pengirim`,`vu_trans_terima`.`tanggal` AS `terima_tanggal`,`master_invoice`.`invoice_diskon` AS `invoice_diskon`,`master_invoice`.`invoice_cashback` AS `invoice_cashback`,`master_invoice`.`invoice_uangmuka` AS `invoice_uangmuka`,`master_invoice`.`invoice_biaya` AS `invoice_biaya`,`vu_trans_terima`.`terima_order` AS `terima_order`,`vu_trans_terima`.`supplier_akun` AS `supplier_akun`,`vu_trans_terima`.`supplier_id` AS `supplier_id` from ((`master_invoice` join `vu_total_invoice_group` on((`vu_total_invoice_group`.`dinvoice_master` = `master_invoice`.`invoice_id`))) join `vu_trans_terima` on((`master_invoice`.`invoice_noterima` = `vu_trans_terima`.`terima_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_mutasi`
--
DROP VIEW IF EXISTS `vu_trans_mutasi`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_mutasi` AS select `master_mutasi`.`mutasi_id` AS `mutasi_id`,`master_mutasi`.`mutasi_no` AS `mutasi_no`,`master_mutasi`.`mutasi_asal` AS `mutasi_asal`,`gudang_tujuan`.`gudang_nama` AS `gudang_asal_nama`,`gudang_tujuan`.`gudang_lokasi` AS `gudang_asal_lokasi`,`master_mutasi`.`mutasi_tujuan` AS `mutasi_tujuan`,`gudang_asal`.`gudang_nama` AS `gudang_tujuan_nama`,`gudang_asal`.`gudang_lokasi` AS `gudang_tujuan_lokasi`,`master_mutasi`.`mutasi_tanggal` AS `mutasi_tanggal`,`vu_total_mutasi_group`.`jumlah_barang` AS `jumlah_barang`,`master_mutasi`.`mutasi_keterangan` AS `mutasi_keterangan`,`master_mutasi`.`mutasi_status` AS `mutasi_status`,`master_mutasi`.`mutasi_creator` AS `mutasi_creator`,`master_mutasi`.`mutasi_date_create` AS `mutasi_date_create`,`master_mutasi`.`mutasi_update` AS `mutasi_update`,`master_mutasi`.`mutasi_date_update` AS `mutasi_date_update`,`master_mutasi`.`mutasi_revised` AS `mutasi_revised` from (((`master_mutasi` join `gudang` `gudang_asal` on(((_utf8'' = _utf8'') and (`master_mutasi`.`mutasi_tujuan` = `gudang_asal`.`gudang_id`)))) join `gudang` `gudang_tujuan` on((`gudang_tujuan`.`gudang_id` = `master_mutasi`.`mutasi_asal`))) join `vu_total_mutasi_group` on((`vu_total_mutasi_group`.`dmutasi_master` = `master_mutasi`.`mutasi_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_order`
--
DROP VIEW IF EXISTS `vu_trans_order`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_order` AS select `master_order_beli`.`order_no` AS `no_bukti`,`master_order_beli`.`order_supplier` AS `order_supplier`,`master_order_beli`.`order_tanggal` AS `tanggal`,`master_order_beli`.`order_carabayar` AS `order_carabayar`,ifnull(`master_order_beli`.`order_diskon`,0) AS `order_diskon`,ifnull(`master_order_beli`.`order_biaya`,0) AS `order_biaya`,ifnull(`master_order_beli`.`order_bayar`,0) AS `order_bayar`,`master_order_beli`.`order_keterangan` AS `order_keterangan`,`master_order_beli`.`order_status` AS `order_status`,`master_order_beli`.`order_status_acc` AS `order_status_acc`,`vu_total_order_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_order_group`.`total_nilai` AS `total_nilai`,`supplier`.`supplier_kategori` AS `supplier_kategori`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`supplier`.`supplier_kodepos` AS `supplier_kodepos`,`supplier`.`supplier_propinsi` AS `supplier_propinsi`,`supplier`.`supplier_negara` AS `supplier_negara`,`supplier`.`supplier_notelp` AS `supplier_notelp`,`supplier`.`supplier_notelp2` AS `supplier_notelp2`,`supplier`.`supplier_nofax` AS `supplier_nofax`,`supplier`.`supplier_email` AS `supplier_email`,`supplier`.`supplier_website` AS `supplier_website`,`supplier`.`supplier_cp` AS `supplier_cp`,`supplier`.`supplier_contact_cp` AS `supplier_contact_cp`,`supplier`.`supplier_akun` AS `supplier_akun`,`supplier`.`supplier_keterangan` AS `supplier_keterangan`,`master_order_beli`.`order_id` AS `order_id`,ifnull(`master_order_beli`.`order_cashback`,0) AS `order_cashback`,`supplier`.`supplier_id` AS `supplier_id` from ((`master_order_beli` join `vu_total_order_group` on((`vu_total_order_group`.`dorder_master` = `master_order_beli`.`order_id`))) join `supplier` on((`master_order_beli`.`order_supplier` = `supplier`.`supplier_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_retur_beli`
--
DROP VIEW IF EXISTS `vu_trans_retur_beli`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_retur_beli` AS select `master_retur_beli`.`rbeli_id` AS `rbeli_id`,`master_retur_beli`.`rbeli_nobukti` AS `no_bukti`,`master_retur_beli`.`rbeli_supplier` AS `rbeli_supplier`,`supplier`.`supplier_nama` AS `supplier_nama`,`supplier`.`supplier_alamat` AS `supplier_alamat`,`supplier`.`supplier_kota` AS `supplier_kota`,`master_retur_beli`.`rbeli_tanggal` AS `tanggal`,`master_retur_beli`.`rbeli_keterangan` AS `rbeli_keterangan`,`master_retur_beli`.`rbeli_status` AS `rbeli_status`,`vu_total_retur_beli_group`.`jumlah_barang` AS `jumlah_barang`,`vu_total_retur_beli_group`.`total_nilai` AS `total_nilai`,`vu_trans_terima`.`terima_id` AS `terima_id`,`vu_trans_terima`.`no_bukti` AS `no_terima`,`vu_trans_terima`.`order_no` AS `no_order`,`master_retur_beli`.`rbeli_terima` AS `rbeli_terima` from (((`master_retur_beli` join `supplier` on((`master_retur_beli`.`rbeli_supplier` = `supplier`.`supplier_id`))) join `vu_total_retur_beli_group` on((`vu_total_retur_beli_group`.`drbeli_master` = `master_retur_beli`.`rbeli_id`))) join `vu_trans_terima` on((`master_retur_beli`.`rbeli_terima` = `vu_trans_terima`.`terima_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_terima_jual`
--
DROP VIEW IF EXISTS `vu_trans_terima_jual`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_terima_jual` AS select `jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,`jual_tunai`.`jtunai_date_create` AS `tanggal`,`jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_tunai` union select `jual_card`.`jcard_transaksi` AS `jenis_transaksi`,`jual_card`.`jcard_date_create` AS `tanggal`,0 AS `nilai_tunai`,`jual_card`.`jcard_nilai` AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_card` union select `jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,`jual_cek`.`jcek_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,`jual_cek`.`jcek_nilai` AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_cek` union select `jual_transfer`.`jtransfer_transaksi` AS `jenis_transaksi`,`jual_transfer`.`jtransfer_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,`jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_transfer` union select `jual_kwitansi`.`jkwitansi_transaksi` AS `jenis_transaksi`,`jual_kwitansi`.`jkwitansi_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,`jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,0 AS `nilai_voucher`,0 AS `nilai_kredit` from `jual_kwitansi` union select `voucher_terima`.`tvoucher_transaksi` AS `jenis_transaksi`,`voucher_terima`.`tvoucher_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,`voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,0 AS `nilai_kredit` from `voucher_terima` union select `jual_kredit`.`jkredit_transaksi` AS `jenis_transaksi`,`jual_kredit`.`jkredit_date_create` AS `tanggal`,0 AS `nilai_tunai`,0 AS `nilai_card`,0 AS `nilai_cek`,0 AS `nilai_transfer`,0 AS `nilai_kwitansi`,0 AS `nilai_voucher`,`jual_kredit`.`jkredit_nilai` AS `nilai_kredit` from `jual_kredit`;

-- --------------------------------------------------------

--
-- Structure for view `vu_trans_terima_kas`
--
DROP VIEW IF EXISTS `vu_trans_terima_kas`;

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_trans_terima_kas` AS select `vu_jual_card`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'card' AS `jenis_bayar`,`vu_jual_card`.`tanggal` AS `tanggal`,`vu_jual_card`.`cust_id` AS `cust_id`,`vu_jual_card`.`cust_no` AS `cust_no`,`vu_jual_card`.`cust_member` AS `cust_member`,`vu_jual_card`.`cust_nama` AS `cust_nama`,`vu_jual_card`.`cust_alamat` AS `cust_alamat`,`vu_jual_card`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_card`.`no_bukti` AS `no_bukti`,`vu_jual_card`.`jcard_nilai` AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `vu_jual_card` union select `vu_jual_cek`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'cek' AS `jenis_bayar`,`vu_jual_cek`.`tanggal` AS `tanggal`,`vu_jual_cek`.`cust_id` AS `cust_id`,`vu_jual_cek`.`cust_no` AS `cust_no`,`vu_jual_cek`.`cust_member` AS `cust_member`,`vu_jual_cek`.`cust_nama` AS `cust_nama`,`vu_jual_cek`.`cust_alamat` AS `cust_alamat`,`vu_jual_cek`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_cek`.`no_bukti` AS `no_bukti`,0 AS `card`,`vu_jual_cek`.`jcek_nilai` AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `vu_jual_cek` union select `vu_jual_kredit`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'kredit' AS `jenis_bayar`,`vu_jual_kredit`.`tanggal` AS `tanggal`,`vu_jual_kredit`.`cust_id` AS `cust_id`,`vu_jual_kredit`.`cust_no` AS `cust_no`,`vu_jual_kredit`.`cust_member` AS `cust_member`,`vu_jual_kredit`.`cust_nama` AS `cust_nama`,`vu_jual_kredit`.`cust_alamat` AS `cust_alamat`,`vu_jual_kredit`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_kredit`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,`vu_jual_kredit`.`jkredit_nilai` AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `vu_jual_kredit` union select `vu_jual_kwitansi`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'kwitansi' AS `jenis_bayar`,`vu_jual_kwitansi`.`tanggal` AS `tanggal`,`vu_jual_kwitansi`.`cust_id` AS `cust_id`,`vu_jual_kwitansi`.`cust_no` AS `cust_no`,`vu_jual_kwitansi`.`cust_member` AS `cust_member`,`vu_jual_kwitansi`.`cust_nama` AS `cust_nama`,`vu_jual_kwitansi`.`cust_alamat` AS `cust_alamat`,`vu_jual_kwitansi`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_kwitansi`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,`vu_jual_kwitansi`.`jkwitansi_nilai` AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,0 AS `voucher` from `vu_jual_kwitansi` union select `vu_jual_transfer`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'transfer' AS `jenis_bayar`,`vu_jual_transfer`.`tanggal` AS `tanggal`,`vu_jual_transfer`.`cust_id` AS `cust_id`,`vu_jual_transfer`.`cust_no` AS `cust_no`,`vu_jual_transfer`.`cust_member` AS `cust_member`,`vu_jual_transfer`.`cust_nama` AS `cust_nama`,`vu_jual_transfer`.`cust_alamat` AS `cust_alamat`,`vu_jual_transfer`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_transfer`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,`vu_jual_transfer`.`jtransfer_nilai` AS `transfer`,0 AS `tunai`,0 AS `voucher` from `vu_jual_transfer` union select `vu_jual_tunai`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'tunai' AS `jenis_bayar`,`vu_jual_tunai`.`tanggal` AS `tanggal`,`vu_jual_tunai`.`cust_id` AS `cust_id`,`vu_jual_tunai`.`cust_no` AS `cust_no`,`vu_jual_tunai`.`cust_member` AS `cust_member`,`vu_jual_tunai`.`cust_nama` AS `cust_nama`,`vu_jual_tunai`.`cust_alamat` AS `cust_alamat`,`vu_jual_tunai`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_tunai`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,`vu_jual_tunai`.`jtunai_nilai` AS `tunai`,0 AS `voucher` from `vu_jual_tunai` union select `vu_jual_voucher`.`jenis_transaksi` AS `jenis_transaksi`,_utf8'voucher' AS `jenis_bayar`,`vu_jual_voucher`.`tanggal` AS `tanggal`,`vu_jual_voucher`.`cust_id` AS `cust_id`,`vu_jual_voucher`.`cust_no` AS `cust_no`,`vu_jual_voucher`.`cust_member` AS `cust_member`,`vu_jual_voucher`.`cust_nama` AS `cust_nama`,`vu_jual_voucher`.`cust_alamat` AS `cust_alamat`,`vu_jual_voucher`.`cust_kelamin` AS `cust_kelamin`,`vu_jual_voucher`.`no_bukti` AS `no_bukti`,0 AS `card`,0 AS `cek`,0 AS `kredit`,0 AS `kwitansi`,0 AS `transfer`,0 AS `tunai`,`vu_jual_voucher`.`tvoucher_nilai` AS `voucher` from `vu_jual_voucher`;

