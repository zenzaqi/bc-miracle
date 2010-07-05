CREATE OR REPLACE VIEW `vu_trans_rawat`
AS
   SELECT `master_jual_rawat`.`jrawat_nobukti` AS `no_bukti`,
          `master_jual_rawat`.`jrawat_cust` AS `cust_id`,
          `master_jual_rawat`.`jrawat_tanggal` AS `tanggal`,
          `vu_customer`.`cust_no` AS `cust_no`,
          `vu_customer`.`cust_member` AS `cust_member`,
          `vu_customer`.`cust_nama` AS `cust_nama`,
          `vu_customer`.`cust_kelamin` AS `cust_kelamin`,
          `vu_customer`.`cust_alamat` AS `cust_alamat`,
          `vu_customer`.`cust_kota` AS `cust_kota`,
          ifnull(`vu_total_jual_rawat_group`.`jumlah_barang`, 0)
             AS `jumlah_barang`,
          ifnull(`vu_total_jual_rawat_group`.`total_nilai`, 0)
             AS `total_nilai`,
          ifnull(`master_jual_rawat`.`jrawat_diskon`, 0)
             AS `diskon`,
          ifnull(`master_jual_rawat`.`jrawat_cashback`, 0)
             AS `cashback`,
          ifnull(`jual_kredit`.`jkredit_nilai`, 0) AS `kredit`,
          ifnull(`jual_cek`.`jcek_nilai`, 0) AS `cek`,
          ifnull(`jual_card`.`jcard_nilai`, 0) AS `card`,
          ifnull(`jual_kwitansi`.`jkwitansi_nilai`, 0)
             AS `kuintansi`,
          ifnull(`jual_transfer`.`jtransfer_nilai`, 0)
             AS `transfer`,
          ifnull(`jual_tunai`.`jtunai_nilai`, 0) AS `tunai`,
          jrawat_stat_dok
     FROM (   (   (   (   (   (   (   (   `master_jual_rawat`
                                       LEFT JOIN
                                          
                                          `vu_total_jual_rawat_group`
                                       ON ((`vu_total_jual_rawat_group`.
                                            `drawat_master` =
                                               
                                               `master_jual_rawat`.
                                               `jrawat_id`)))
                                   LEFT JOIN
                                      `vu_customer`
                                   ON ((`master_jual_rawat`.
                                        `jrawat_cust` =
                                           `vu_customer`.`cust_id`)))
                               LEFT JOIN
                                  `jual_card`
                               ON ((`jual_card`.`jcard_ref` =
                                       `master_jual_rawat`.
                                       `jrawat_nobukti`)))
                           LEFT JOIN
                              `jual_cek`
                           ON ((`jual_cek`.`jcek_ref` =
                                   `master_jual_rawat`.
                                   `jrawat_nobukti`)))
                       LEFT JOIN
                          `jual_kredit`
                       ON ((`jual_kredit`.`jkredit_ref` =
                               `master_jual_rawat`.
                               `jrawat_nobukti`)))
                   LEFT JOIN
                      `jual_kwitansi`
                   ON ((`jual_kwitansi`.`jkwitansi_ref` =
                           `master_jual_rawat`.`jrawat_nobukti`)))
               LEFT JOIN
                  `jual_transfer`
               ON ((`jual_transfer`.`jtransfer_ref` =
                       `master_jual_rawat`.`jrawat_nobukti`)))
           LEFT JOIN
              `jual_tunai`
           ON ((`jual_tunai`.`jtunai_ref` =
                   `master_jual_rawat`.`jrawat_nobukti`)));

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
          `detail_jual_rawat`.`drawat_diskon_jenis`
             AS `diskon_jenis`,
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
          jrawat_stat_dok
     FROM (   (   (   (   (   (   `detail_jual_rawat`
                               JOIN
                                  `vu_perawatan`
                               ON ((`vu_perawatan`.`rawat_id` =
                                       `detail_jual_rawat`.
                                       `drawat_rawat`)))
                           JOIN
                              `master_jual_rawat`
                           ON ((`detail_jual_rawat`.
                                `drawat_master` =
                                   `master_jual_rawat`.
                                   `jrawat_id`)))
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