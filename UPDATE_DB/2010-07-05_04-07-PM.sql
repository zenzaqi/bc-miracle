CREATE OR REPLACE VIEW `vu_detail_jual_paket`
AS
   SELECT `detail_jual_paket`.`dpaket_master` AS `dpaket_master`,
          `detail_jual_paket`.`dpaket_paket` AS `dpaket_paket`,
          `paket`.`paket_nama` AS `produk_nama`,
          `kategori2`.`kategori2_nama` AS `kategori2_nama`,
          `detail_jual_paket`.`dpaket_jumlah` AS `jumlah_barang`,
          `detail_jual_paket`.`dpaket_harga` AS `harga_satuan`,
          `detail_jual_paket`.`dpaket_diskon` AS `dpaket_diskon`,
          `detail_jual_paket`.`dpaket_diskon_jenis`
             AS `diskon_jenis`,
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
          jpaket_stat_dok
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
               ON ((`detail_jual_paket`.`dpaket_paket` =
                       `paket`.`paket_id`)))
           LEFT JOIN
              `kategori2`
           ON ((`paket`.`paket_kontribusi` =
                   `kategori2`.`kategori2_id`)));

CREATE OR REPLACE VIEW `vu_trans_paket`
AS
   SELECT `master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,
          `master_jual_paket`.`jpaket_cust` AS `cust_id`,
          `master_jual_paket`.`jpaket_tanggal` AS `tanggal`,
          `vu_customer`.`cust_no` AS `cust_no`,
          `vu_customer`.`cust_member` AS `cust_member`,
          `vu_customer`.`cust_nama` AS `cust_nama`,
          `vu_customer`.`cust_kelamin` AS `cust_kelamin`,
          `vu_customer`.`cust_alamat` AS `cust_alamat`,
          `vu_customer`.`cust_kota` AS `cust_kota`,
          ifnull(`vu_total_jual_paket_group`.`jumlah_barang`, 0)
             AS `jumlah_barang`,
          ifnull(`vu_total_jual_paket_group`.`total_nilai`, 0)
             AS `total_nilai`,
          ifnull(`master_jual_paket`.`jpaket_diskon`, 0)
             AS `diskon`,
          ifnull(`master_jual_paket`.`jpaket_cashback`, 0)
             AS `cashback`,
          ifnull(`jual_kredit`.`jkredit_nilai`, 0) AS `kredit`,
          ifnull(`jual_cek`.`jcek_nilai`, 0) AS `cek`,
          ifnull(`jual_card`.`jcard_nilai`, 0) AS `card`,
          ifnull(`jual_kwitansi`.`jkwitansi_nilai`, 0)
             AS `kuintansi`,
          ifnull(`jual_transfer`.`jtransfer_nilai`, 0)
             AS `transfer`,
          ifnull(`jual_tunai`.`jtunai_nilai`, 0) AS `tunai`,
          jpaket_stat_dok
     FROM (   (   (   (   (   (   (   (   `master_jual_paket`
                                       LEFT JOIN
                                          
                                          `vu_total_jual_paket_group`
                                       ON ((`vu_total_jual_paket_group`.
                                            `dpaket_master` =
                                               
                                               `master_jual_paket`.
                                               `jpaket_id`)))
                                   LEFT JOIN
                                      `vu_customer`
                                   ON ((`master_jual_paket`.
                                        `jpaket_cust` =
                                           `vu_customer`.`cust_id`)))
                               LEFT JOIN
                                  `jual_card`
                               ON ((`jual_card`.`jcard_ref` =
                                       `master_jual_paket`.
                                       `jpaket_nobukti`)))
                           LEFT JOIN
                              `jual_cek`
                           ON ((`jual_cek`.`jcek_ref` =
                                   `master_jual_paket`.
                                   `jpaket_nobukti`)))
                       LEFT JOIN
                          `jual_kredit`
                       ON ((`jual_kredit`.`jkredit_ref` =
                               `master_jual_paket`.
                               `jpaket_nobukti`)))
                   LEFT JOIN
                      `jual_kwitansi`
                   ON ((`jual_kwitansi`.`jkwitansi_ref` =
                           `master_jual_paket`.`jpaket_nobukti`)))
               LEFT JOIN
                  `jual_transfer`
               ON ((`jual_transfer`.`jtransfer_ref` =
                       `master_jual_paket`.`jpaket_nobukti`)))
           LEFT JOIN
              `jual_tunai`
           ON ((`jual_tunai`.`jtunai_ref` =
                   `master_jual_paket`.`jpaket_nobukti`)));