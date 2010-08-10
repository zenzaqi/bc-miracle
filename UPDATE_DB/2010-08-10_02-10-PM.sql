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
          produk_id,
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
              - (((`detail_jual_produk`.`dproduk_harga`
                   * `detail_jual_produk`.`dproduk_diskon`)
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


CREATE OR REPLACE VIEW `vu_detail_jual_rawat`
AS
   SELECT `detail_jual_rawat`.`drawat_master` AS `drawat_master`,
          `detail_jual_rawat`.`drawat_rawat` AS `drawat_rawat`,
          `vu_perawatan`.`rawat_nama` AS `produk_nama`,
          `vu_perawatan`.`kategori2_nama` AS `kategori2_nama`,
          `vu_perawatan`.`kategori_nama` AS `kategori_nama`,
          `vu_perawatan`.`jenis_nama` AS `jenis_nama`,
          `detail_jual_rawat`.`drawat_jumlah` AS `jumlah_barang`,
          `detail_jual_rawat`.`drawat_harga` AS `harga_satuan`,
          `detail_jual_rawat`.`drawat_diskon` AS `drawat_diskon`,
          `detail_jual_rawat`.`drawat_diskon_jenis` AS `diskon_jenis`,
          if(
             (`tindakan_detail`.`dtrawat_petugas1` = 0),
             if((`tindakan_detail`.`dtrawat_petugas2` = 0),
                NULL,
                `terapis`.`karyawan_username`),
             `dokter`.`karyawan_username`)
             AS `sales`,
          `master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,
          `master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_kelamin` AS `cust_kelamin`,
          `customer`.`cust_alamat` AS `cust_alamat`,
          `customer`.`cust_kota` AS `cust_kota`,
          `vu_perawatan`.`rawat_kode` AS `produk_kode`,
          _UTF8 'paket' AS `satuan_nama`,
          `detail_jual_rawat`.`drawat_diskon` AS `diskon`,
          (((`detail_jual_rawat`.`drawat_harga`
             * `detail_jual_rawat`.`drawat_jumlah`)
            * `detail_jual_rawat`.`drawat_diskon`)
           / 100)
             AS `diskon_nilai`,
          ((`detail_jual_rawat`.`drawat_harga`
            * `detail_jual_rawat`.`drawat_jumlah`)
           - (((`detail_jual_rawat`.`drawat_harga`
                * `detail_jual_rawat`.`drawat_jumlah`)
               * `detail_jual_rawat`.`drawat_diskon`)
              / 100))
             AS `subtotal`,
          `master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,
          `customer`.`cust_id` AS `cust_id`,
          `master_jual_rawat`.`jrawat_stat_dok` AS `jrawat_stat_dok`,
          `master_jual_rawat`.`jrawat_keterangan` AS `keterangan`,
          rawat_id AS produk_id
     FROM (   (   (   (   (   (   `detail_jual_rawat`
                               JOIN
                                  `vu_perawatan`
                               ON ((`vu_perawatan`.`rawat_id` =
                                       `detail_jual_rawat`.`drawat_rawat`)))
                           JOIN
                              `master_jual_rawat`
                           ON ((`detail_jual_rawat`.`drawat_master` =
                                   `master_jual_rawat`.`jrawat_id`)))
                       JOIN
                          `customer`
                       ON ((`master_jual_rawat`.`jrawat_cust` =
                               `customer`.`cust_id`)))
                   LEFT JOIN
                      `tindakan_detail`
                   ON ((`detail_jual_rawat`.`drawat_dtrawat` =
                           `tindakan_detail`.`dtrawat_id`)))
               LEFT JOIN
                  `karyawan` `dokter`
               ON ((`tindakan_detail`.`dtrawat_petugas1` =
                       `dokter`.`karyawan_id`)))
           LEFT JOIN
              `karyawan` `terapis`
           ON ((`tindakan_detail`.`dtrawat_petugas2` =
                   `terapis`.`karyawan_id`)));



CREATE OR REPLACE VIEW `vu_detail_jual_paket`
AS
   SELECT `detail_jual_paket`.`dpaket_master` AS `dpaket_master`,
          `detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,
          `paket`.`paket_nama` AS `produk_nama`,
          `kategori2`.`kategori2_nama` AS `kategori2_nama`,
          `detail_jual_paket`.`dpaket_jumlah` AS `jumlah_barang`,
          `detail_jual_paket`.`dpaket_harga` AS `harga_satuan`,
          `detail_jual_paket`.`dpaket_diskon` AS `dpaket_diskon`,
          `detail_jual_paket`.`dpaket_diskon_jenis` AS `diskon_jenis`,
          `detail_jual_paket`.`dpaket_sales` AS `sales`,
          `master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,
          `master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_kelamin` AS `cust_kelamin`,
          `customer`.`cust_alamat` AS `cust_alamat`,
          `customer`.`cust_kota` AS `cust_kota`,
          `paket`.`paket_kode` AS `produk_kode`,
          _UTF8 'paket' AS `satuan_nama`,
          `detail_jual_paket`.`dpaket_diskon` AS `diskon`,
          (((`detail_jual_paket`.`dpaket_harga`
             * `detail_jual_paket`.`dpaket_jumlah`)
            * `detail_jual_paket`.`dpaket_diskon`)
           / 100)
             AS `diskon_nilai`,
          ((`detail_jual_paket`.`dpaket_harga`
            * `detail_jual_paket`.`dpaket_jumlah`)
           - (((`detail_jual_paket`.`dpaket_harga`
                * `detail_jual_paket`.`dpaket_jumlah`)
               * `detail_jual_paket`.`dpaket_diskon`)
              / 100))
             AS `subtotal`,
          `master_jual_paket`.`jpaket_tanggal` AS `tanggal`,
          `customer`.`cust_id` AS `cust_id`,
          `master_jual_paket`.`jpaket_stat_dok` AS `jpaket_stat_dok`,
          `master_jual_paket`.`jpaket_keterangan` AS `keterangan`,
          paket_id AS produk_id
     FROM (   (   (   (   `detail_jual_paket`
                       LEFT JOIN
                          `master_jual_paket`
                       ON ((`detail_jual_paket`.`dpaket_master` =
                               `master_jual_paket`.`jpaket_id`)))
                   LEFT JOIN
                      `customer`
                   ON ((`master_jual_paket`.`jpaket_cust` =
                           `customer`.`cust_id`)))
               LEFT JOIN
                  `paket`
               ON ((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`)))
           LEFT JOIN
              `kategori2`
           ON ((`paket`.`paket_kontribusi` = `kategori2`.`kategori2_id`)));
