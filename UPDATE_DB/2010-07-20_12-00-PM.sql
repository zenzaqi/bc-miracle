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
          ifnull(`master_lunas_piutang`.`lpiutang_total`, 0) AS `kredit`,
          ifnull(`jual_cek`.`jcek_nilai`, 0) AS `cek`,
          ifnull(`jual_card`.`jcard_nilai`, 0) AS `card`,
          ifnull(`jual_kwitansi`.`jkwitansi_nilai`, 0)
             AS `kuitansi`,
          ifnull(`jual_transfer`.`jtransfer_nilai`, 0)
             AS `transfer`,
          ifnull(`jual_tunai`.`jtunai_nilai`, 0) AS `tunai`,
          `master_jual_rawat`.`jrawat_stat_dok`
             AS `jrawat_stat_dok`
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
                          `master_lunas_piutang`
                       ON ((`master_lunas_piutang`.`lpiutang_faktur` =
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


CREATE OR REPLACE VIEW `vu_trans_produk`
AS
   SELECT `master_jual_produk`.`jproduk_nobukti` AS `no_bukti`,
          `master_jual_produk`.`jproduk_cust` AS `cust_id`,
          `master_jual_produk`.`jproduk_tanggal` AS `tanggal`,
          `vu_customer`.`cust_no` AS `cust_no`,
          `vu_customer`.`cust_member` AS `cust_member`,
          `vu_customer`.`cust_nama` AS `cust_nama`,
          `vu_customer`.`cust_kelamin` AS `cust_kelamin`,
          `vu_customer`.`cust_alamat` AS `cust_alamat`,
          `vu_customer`.`cust_kota` AS `cust_kota`,
          ifnull(`vu_total_jual_produk_group`.`jumlah_barang`, 0)
             AS `jumlah_barang`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`vu_total_jual_produk_group`.`total_nilai`, 0))
             AS `total_nilai`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`master_jual_produk`.`jproduk_diskon`, 0))
             AS `diskon`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`master_jual_produk`.`jproduk_cashback`, 0))
             AS `cashback`,
          ifnull(`master_lunas_piutang`.`lpiutang_total`, 0) AS `kredit`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`jual_cek`.`jcek_nilai`, 0))
             AS `cek`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`jual_card`.`jcard_nilai`, 0))
             AS `card`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`jual_kwitansi`.`jkwitansi_nilai`, 0))
             AS `kuitansi`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`jual_transfer`.`jtransfer_nilai`, 0))
             AS `transfer`,
          if(
             (`master_jual_produk`.`jproduk_stat_dok` =
                 _LATIN1 'Batal'),
             0,
             ifnull(`jual_tunai`.`jtunai_nilai`, 0))
             AS `tunai`,
          `master_jual_produk`.`jproduk_stat_dok`
             AS `jproduk_stat_dok`
     FROM (   (   (   (   (   (   (   (   `master_jual_produk`
                                       LEFT JOIN
                                          
                                          `vu_total_jual_produk_group`
                                       ON ((`vu_total_jual_produk_group`.
                                            `dproduk_master` =
                                               
                                               `master_jual_produk`.
                                               `jproduk_id`)))
                                   LEFT JOIN
                                      `vu_customer`
                                   ON ((`master_jual_produk`.
                                        `jproduk_cust` =
                                           `vu_customer`.`cust_id`)))
                               LEFT JOIN
                                  `jual_card`
                               ON ((`jual_card`.`jcard_ref` =
                                       `master_jual_produk`.
                                       `jproduk_nobukti`)))
                           LEFT JOIN
                              `jual_cek`
                           ON ((`jual_cek`.`jcek_ref` =
                                   `master_jual_produk`.
                                   `jproduk_nobukti`)))
                       LEFT JOIN
                          `master_lunas_piutang`
                       ON ((`master_lunas_piutang`.`lpiutang_faktur` =
                               `master_jual_produk`.
                               `jproduk_nobukti`)))
                   LEFT JOIN
                      `jual_kwitansi`
                   ON ((`jual_kwitansi`.`jkwitansi_ref` =
                           `master_jual_produk`.`jproduk_nobukti`)))
               LEFT JOIN
                  `jual_transfer`
               ON ((`jual_transfer`.`jtransfer_ref` =
                       `master_jual_produk`.`jproduk_nobukti`)))
           LEFT JOIN
              `jual_tunai`
           ON ((`jual_tunai`.`jtunai_ref` =
                   `master_jual_produk`.`jproduk_nobukti`)));





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
          ifnull(`master_lunas_piutang`.`lpiutang_total`, 0) AS `kredit`,
          ifnull(`jual_cek`.`jcek_nilai`, 0) AS `cek`,
          ifnull(`jual_card`.`jcard_nilai`, 0) AS `card`,
          ifnull(`jual_kwitansi`.`jkwitansi_nilai`, 0)
             AS `kuitansi`,
          ifnull(`jual_transfer`.`jtransfer_nilai`, 0)
             AS `transfer`,
          ifnull(`jual_tunai`.`jtunai_nilai`, 0) AS `tunai`,
          `master_jual_paket`.`jpaket_stat_dok`
             AS `jpaket_stat_dok`
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
                          `master_lunas_piutang`
                       ON ((`master_lunas_piutang`.`lpiutang_faktur` =
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


CREATE OR REPLACE VIEW `vu_trans_terima_jual`
AS
   SELECT `jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,
          `jual_tunai`.`jtunai_date_create` AS `tanggal`,
          `jual_tunai`.`jtunai_ref` AS `no_ref`,
          `jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_tunai`.`jtunai_stat_dok` AS `stat_dok`
     FROM `jual_tunai`
   UNION
   SELECT `jual_card`.`jcard_transaksi` AS `jenis_transaksi`,
          `jual_card`.`jcard_date_create` AS `tanggal`,
          `jual_card`.`jcard_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          `jual_card`.`jcard_nilai` AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_card`.`jcard_stat_dok` AS `stat_dok`
     FROM `jual_card`
   UNION
   SELECT `jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,
          `jual_cek`.`jcek_date_create` AS `tanggal`,
          `jual_cek`.`jcek_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          `jual_cek`.`jcek_nilai` AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_cek`.`jcek_stat_dok` AS `stat_dok`
     FROM `jual_cek`
   UNION
   SELECT `jual_transfer`.`jtransfer_transaksi`
             AS `jenis_transaksi`,
          `jual_transfer`.`jtransfer_date_create` AS `tanggal`,
          `jual_transfer`.`jtransfer_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          `jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_transfer`.`jtransfer_stat_dok` AS `stat_dok`
     FROM `jual_transfer`
   UNION
   SELECT `jual_kwitansi`.`jkwitansi_transaksi`
             AS `jenis_transaksi`,
          `jual_kwitansi`.`jkwitansi_date_create` AS `tanggal`,
          `jual_kwitansi`.`jkwitansi_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          `jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_kwitansi`.`jkwitansi_stat_dok` AS `stat_dok`
     FROM `jual_kwitansi`
   UNION
   SELECT `voucher_terima`.`tvoucher_transaksi`
             AS `jenis_transaksi`,
          `voucher_terima`.`tvoucher_date_create` AS `tanggal`,
          `voucher_terima`.`tvoucher_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          `voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `voucher_terima`.`tvoucher_stat_dok` AS `stat_dok`
     FROM `voucher_terima`
   UNION
   SELECT `master_lunas_piutang`.`lpiutang_jenis_transaksi` AS `jenis_transaksi`,
          `master_lunas_piutang`.`lpiutang_faktur_tanggal` AS `tanggal`,
          `master_lunas_piutang`.`lpiutang_faktur` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          `master_lunas_piutang`.`lpiutang_total` AS `nilai_kredit`,
          `master_lunas_piutang`.`lpiutang_stat_dok` AS `stat_dok`
     FROM `master_lunas_piutang`;