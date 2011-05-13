CREATE OR REPLACE VIEW `vu_detail_jual_produk` AS (select `detail_jual_produk`.`dproduk_id` AS `dproduk_id`,`detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,`detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,`detail_jual_produk`.`dproduk_jumlah` AS `jumlah_barang`,`detail_jual_produk`.`dproduk_harga` AS `harga_satuan`,`detail_jual_produk`.`dproduk_diskon` AS `diskon`,if((ifnull(`detail_jual_produk`.`dproduk_diskon_jenis`,_latin1'-') = _latin1''),_latin1'-',ifnull(`detail_jual_produk`.`dproduk_diskon_jenis`,_latin1'-')) AS `diskon_jenis`,if((ifnull(`karyawan`.`karyawan_username`,_latin1'-') = _latin1''),_latin1'-',ifnull(`karyawan`.`karyawan_username`,_latin1'-')) AS `sales`,`master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,`master_jual_produk`.`jproduk_tanggal` AS `tanggal`,`master_jual_produk`.`jproduk_keterangan` AS `keterangan`,`master_jual_produk`.`jproduk_grooming` AS `jproduk_grooming`,`master_jual_produk`.`jproduk_diskon` AS `diskon_umum`,`master_jual_produk`.`jproduk_cashback` AS `voucher`,`master_jual_produk`.`jproduk_totalbiaya` AS `totalbiaya`,`master_jual_produk`.`jproduk_bayar` AS `bayar`,`customer`.`cust_id` AS `cust_id`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_kategori` AS `produk_kategori`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`produk`.`produk_nama` AS `produk_nama`,`produk`.`produk_satuan` AS `produk_satuan`,`produk`.`produk_du` AS `produk_du`,`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_volume` AS `produk_volume`,`produk`.`produk_jenis` AS `produk_jenis`,`satuan`.`satuan_nama` AS `satuan_nama`,`produk`.`produk_id` AS `produk_id`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,(((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) / 100) * `detail_jual_produk`.`dproduk_jumlah`)) AS `diskon_nilai`,if((`master_jual_produk`.`jproduk_stat_dok` = _latin1'Batal'),0,((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_jumlah`) - (((`detail_jual_produk`.`dproduk_harga` * `detail_jual_produk`.`dproduk_diskon`) * `detail_jual_produk`.`dproduk_jumlah`) / 100))) AS `subtotal`,`master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok`,`vu_sum_jual_card`.`jcard_nilai` AS `bayar_card`,`vu_sum_jual_cek`.`jcek_nilai` AS `bayar_cek`,`vu_sum_jual_kwitansi`.`jkwitansi_nilai` AS `bayar_kuitansi`,`vu_sum_jual_transfer`.`jtransfer_nilai` AS `bayar_transfer`,`vu_sum_jual_tunai`.`jtunai_nilai` AS `bayar_tunai`,cast(`master_jual_produk`.`jproduk_date_create` as time) AS `time` from ((((((((((`detail_jual_produk` left join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) left join `customer` on((`master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`))) left join `produk` on((`detail_jual_produk`.`dproduk_produk` = `produk`.`produk_id`))) left join `satuan` on((`detail_jual_produk`.`dproduk_satuan` = `satuan`.`satuan_id`))) left join `karyawan` on((`detail_jual_produk`.`dproduk_karyawan` = `karyawan`.`karyawan_id`))) left join `vu_sum_jual_card` on((`vu_sum_jual_card`.`jcard_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_cek` on((`vu_sum_jual_cek`.`jcek_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_kwitansi` on((`vu_sum_jual_kwitansi`.`jkwitansi_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_transfer` on((`vu_sum_jual_transfer`.`jtransfer_ref` = `master_jual_produk`.`jproduk_nobukti`))) left join `vu_sum_jual_tunai` on((`vu_sum_jual_tunai`.`jtunai_ref` = `master_jual_produk`.`jproduk_nobukti`))));




CREATE OR REPLACE VIEW `vu_detail_jual_rawat` AS (select `detail_jual_rawat`.`drawat_master` AS `drawat_master`,`detail_jual_rawat`.`drawat_rawat` AS `drawat_rawat`,`vu_perawatan`.`rawat_nama` AS `produk_nama`,`vu_perawatan`.`kategori2_nama` AS `kategori2_nama`,`vu_perawatan`.`kategori_nama` AS `kategori_nama`,`vu_perawatan`.`jenis_nama` AS `jenis_nama`,`detail_jual_rawat`.`drawat_jumlah` AS `jumlah_barang`,`detail_jual_rawat`.`drawat_harga` AS `harga_satuan`,`detail_jual_rawat`.`drawat_diskon` AS `drawat_diskon`,`detail_jual_rawat`.`drawat_diskon_jenis` AS `diskon_jenis`,ifnull(if((`tindakan_detail`.`dtrawat_petugas1` = 0),if((`tindakan_detail`.`dtrawat_petugas2` = 0),NULL,`terapis`.`karyawan_username`),`dokter`.`karyawan_username`),`referal_kasir`.`karyawan_username`) AS `sales`,`master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_diskon` AS `diskon_umum`,`master_jual_rawat`.`jrawat_cashback` AS `voucher`,`master_jual_rawat`.`jrawat_totalbiaya` AS `totalbiaya`,`master_jual_rawat`.`jrawat_bayar` AS `bayar`,`customer`.`cust_member` AS `cust_member`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`customer`.`cust_kelamin` AS `cust_kelamin`,`customer`.`cust_alamat` AS `cust_alamat`,`customer`.`cust_kota` AS `cust_kota`,`vu_perawatan`.`rawat_kode` AS `produk_kode`,_utf8'paket' AS `satuan_nama`,`detail_jual_rawat`.`drawat_diskon` AS `diskon`,(((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) * `detail_jual_rawat`.`drawat_diskon`) / 100) AS `diskon_nilai`,((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) - (((`detail_jual_rawat`.`drawat_harga` * `detail_jual_rawat`.`drawat_jumlah`) * `detail_jual_rawat`.`drawat_diskon`) / 100)) AS `subtotal`,`master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,`customer`.`cust_id` AS `cust_id`,`master_jual_rawat`.`jrawat_stat_dok` AS `jrawat_stat_dok`,`master_jual_rawat`.`jrawat_keterangan` AS `keterangan`,`master_jual_rawat`.`jrawat_grooming` AS `jrawat_grooming`,`vu_perawatan`.`rawat_id` AS `produk_id`,`vu_sum_jual_card`.`jcard_nilai` AS `bayar_card`,`vu_sum_jual_cek`.`jcek_nilai` AS `bayar_cek`,`vu_sum_jual_kwitansi`.`jkwitansi_nilai` AS `bayar_kuitansi`,`vu_sum_jual_transfer`.`jtransfer_nilai` AS `bayar_transfer`,`vu_sum_jual_tunai`.`jtunai_nilai` AS `bayar_tunai`,cast(`master_jual_rawat`.`jrawat_date_create` as time) AS `time` from ((((((((((((`detail_jual_rawat` join `vu_perawatan` on((`vu_perawatan`.`rawat_id` = `detail_jual_rawat`.`drawat_rawat`))) join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) join `customer` on((`master_jual_rawat`.`jrawat_cust` = `customer`.`cust_id`))) left join `tindakan_detail` on((`detail_jual_rawat`.`drawat_dtrawat` = `tindakan_detail`.`dtrawat_id`))) left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`))) left join `karyawan` `referal_kasir` on((`detail_jual_rawat`.`drawat_sales` = `referal_kasir`.`karyawan_id`))) left join `vu_sum_jual_card` on((`vu_sum_jual_card`.`jcard_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_sum_jual_cek` on((`vu_sum_jual_cek`.`jcek_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_sum_jual_kwitansi` on((`vu_sum_jual_kwitansi`.`jkwitansi_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_sum_jual_transfer` on((`vu_sum_jual_transfer`.`jtransfer_ref` = `master_jual_rawat`.`jrawat_nobukti`))) left join `vu_sum_jual_tunai` on((`vu_sum_jual_tunai`.`jtunai_ref` = `master_jual_rawat`.`jrawat_nobukti`))));




