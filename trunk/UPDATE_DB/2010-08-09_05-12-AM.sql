CREATE OR REPLACE VIEW `vu_detail_jual_produk`
AS
   SELECT `detail_jual_produk`.`dproduk_id` AS `dproduk_id`,
          `detail_jual_produk`.`dproduk_produk` AS `dproduk_produk`,
          `detail_jual_produk`.`dproduk_satuan` AS `dproduk_satuan`,
          `detail_jual_produk`.`dproduk_jumlah` AS `jumlah_barang`,
          `detail_jual_produk`.`dproduk_harga` AS `harga_satuan`,
          `detail_jual_produk`.`dproduk_diskon` AS `diskon`,
          `detail_jual_produk`.`dproduk_diskon_jenis` AS `diskon_jenis`,
          `karyawan`.`karyawan_username` AS `sales`,
          `master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,
          `master_jual_produk`.`jproduk_tanggal` AS `tanggal`,
		  `master_jual_produk`.`jproduk_keterangan` AS `keterangan`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `customer`.`cust_kelamin` AS `cust_kelamin`,
          `customer`.`cust_alamat` AS `cust_alamat`,
          `customer`.`cust_kota` AS `cust_kota`,
          `produk`.`produk_kode` AS `produk_kode`,
          `produk`.`produk_kategori` AS `produk_kategori`,
          `produk`.`produk_kontribusi` AS `produk_kontribusi`,
          `produk`.`produk_nama` AS `produk_nama`,
          `produk`.`produk_satuan` AS `produk_satuan`,
          `produk`.`produk_du` AS `produk_du`,
          `produk`.`produk_dm` AS `produk_dm`,
          `produk`.`produk_point` AS `produk_point`,
          `produk`.`produk_harga` AS `produk_harga`,
          `produk`.`produk_volume` AS `produk_volume`,
          `produk`.`produk_jenis` AS `produk_jenis`,
          `satuan`.`satuan_nama` AS `satuan_nama`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             (((`detail_jual_produk`.`dproduk_harga`
                * `detail_jual_produk`.`dproduk_diskon`)
               / 100)
              * `detail_jual_produk`.`dproduk_jumlah`))
             AS `diskon_nilai`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ((`detail_jual_produk`.`dproduk_harga`
               * `detail_jual_produk`.`dproduk_jumlah`)
              - ((  `detail_jual_produk`.`dproduk_harga`
                  * `detail_jual_produk`.`dproduk_diskon`
                  * `detail_jual_produk`.`dproduk_jumlah`)
                 / 100)))
             AS `subtotal`,
          `master_jual_produk`.`jproduk_id` AS `jproduk_id`,
          `master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok`
     FROM (   (   (   (   (   `detail_jual_produk`
                           LEFT JOIN
                              `master_jual_produk`
                           ON ((`detail_jual_produk`.`dproduk_master` =
                                   `master_jual_produk`.`jproduk_id`)))
                       LEFT JOIN
                          `customer`
                       ON ((`master_jual_produk`.`jproduk_cust` =
                               `customer`.`cust_id`)))
                   LEFT JOIN
                      `produk`
                   ON ((`detail_jual_produk`.`dproduk_produk` =
                           `produk`.`produk_id`)))
               LEFT JOIN
                  `satuan`
               ON ((`detail_jual_produk`.`dproduk_satuan` =
                       `satuan`.`satuan_id`)))
           LEFT JOIN
              `karyawan`
           ON ((`detail_jual_produk`.`dproduk_karyawan` =
                   `karyawan`.`karyawan_id`)));