/*-- CREATE SUM VIEW JUAL TUNAI ----*/

CREATE OR REPLACE VIEW vu_sum_jual_tunai
AS
   SELECT date_format(jtunai_date_create, '%Y-%m-%d') AS jtunai_date_create,
          jtunai_transaksi,
          jtunai_ref,
          jtunai_stat_dok,
          sum(jtunai_nilai) AS jtunai_nilai
     FROM jual_tunai
   GROUP BY jtunai_ref,
            jtunai_date_create,
            jtunai_transaksi,
            jtunai_stat_dok;

/*-- CREATE SUM VIEW JUAL CARD----*/

CREATE OR REPLACE VIEW vu_sum_jual_card
AS
   SELECT date_format(jcard_date_create, '%Y-%m-%d') AS jcard_date_create,
          jcard_transaksi,
          jcard_stat_dok,
          jcard_ref,
          sum(jcard_nilai) AS jcard_nilai
     FROM jual_card
   GROUP BY jcard_ref,
            date_format(jcard_date_create, '%Y-%m-%d'),
            jcard_transaksi,
            jcard_stat_dok;

/*-- CREATE SUM VIEW JUAL CEK----*/

CREATE OR REPLACE VIEW vu_sum_jual_cek
AS
   SELECT date_format(jcek_date_create, '%Y-%m-%d') AS jcek_date_create,
          jcek_transaksi,
          jcek_stat_dok,
          jcek_ref,
          sum(jcek_nilai) AS jcek_nilai
     FROM jual_cek
   GROUP BY jcek_ref,
            date_format(jcek_date_create, '%Y-%m-%d'),
            jcek_transaksi,
            jcek_stat_dok;


/*-- CREATE SUM VIEW JUAL TRANSFER----*/

CREATE OR REPLACE VIEW vu_sum_jual_transfer
AS
   SELECT date_format(jtransfer_date_create, '%Y-%m-%d')
             AS jtransfer_date_create,
          jtransfer_transaksi,
          jtransfer_stat_dok,
          jtransfer_ref,
          sum(jtransfer_nilai) AS jtransfer_nilai
     FROM jual_transfer
   GROUP BY jtransfer_ref,
            date_format(jtransfer_date_create, '%Y-%m-%d'),
            jtransfer_transaksi,
            jtransfer_stat_dok;

/*-- CREATE SUM VIEW JUAL KWITANSI----*/

CREATE OR REPLACE VIEW vu_sum_jual_kwitansi
AS
   SELECT date_format(jkwitansi_date_create, '%Y-%m-%d')
             AS jkwitansi_date_create,
          jkwitansi_transaksi,
          jkwitansi_stat_dok,
          jkwitansi_ref,
          sum(jkwitansi_nilai) AS jkwitansi_nilai
     FROM jual_kwitansi
   GROUP BY jkwitansi_ref,
            date_format(jkwitansi_date_create, '%Y-%m-%d'),
            jkwitansi_transaksi,
            jkwitansi_stat_dok;

/*-- CREATE SUM VIEW JUAL VOUCHER----*/

CREATE OR REPLACE VIEW vu_sum_jual_voucher
AS
   SELECT date_format(tvoucher_date_create, '%Y-%m-%d')
             AS tvoucher_date_create,
          tvoucher_transaksi,
          tvoucher_stat_dok,
          tvoucher_ref,
          sum(tvoucher_nilai) AS tvoucher_nilai
     FROM voucher_terima
   GROUP BY tvoucher_ref,
            date_format(tvoucher_date_create, '%Y-%m-%d'),
            tvoucher_transaksi,
            tvoucher_stat_dok;


/*--- CREATE OR REPLACE VIEW JUAL PRODUK ----*/
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
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(`vu_total_jual_produk_group`.`total_nilai`, 0))
             AS `total_nilai`,
          `master_jual_produk`.`jproduk_bayar` AS `total_bayar`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(`master_jual_produk`.`jproduk_diskon`, 0))
             AS `diskon`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(`master_jual_produk`.`jproduk_cashback`, 0))
             AS `cashback`,
          ifnull(`master_lunas_piutang`.`lpiutang_total`, 0) AS `kredit`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(vu_sum_jual_cek.`jcek_nilai`, 0))
             AS `cek`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(vu_sum_jual_card.`jcard_nilai`, 0))
             AS `card`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(vu_sum_jual_kwitansi.`jkwitansi_nilai`, 0))
             AS `kuitansi`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(vu_sum_jual_transfer.`jtransfer_nilai`, 0))
             AS `transfer`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(vu_sum_jual_tunai.`jtunai_nilai`, 0))
             AS `tunai`,
          if((`master_jual_produk`.`jproduk_stat_dok` = _LATIN1 'Batal'),
             0,
             ifnull(`vu_sum_jual_voucher`.`tvoucher_nilai`, 0))
             AS `voucher`,
          `master_jual_produk`.`jproduk_stat_dok` AS `jproduk_stat_dok`
     FROM (   (   (   (   (   (   (   (   (   `master_jual_produk`
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
                                      vu_sum_jual_card
                                   ON ((vu_sum_jual_card.`jcard_ref` =
                                           `master_jual_produk`.
                                           `jproduk_nobukti`)))
                               LEFT JOIN
                                  vu_sum_jual_cek
                               ON ((vu_sum_jual_cek.`jcek_ref` =
                                       `master_jual_produk`.`jproduk_nobukti`)))
                           LEFT JOIN
                              `master_lunas_piutang`
                           ON ((`master_lunas_piutang`.`lpiutang_faktur` =
                                   `master_jual_produk`.`jproduk_nobukti`)))
                       LEFT JOIN
                          vu_sum_jual_kwitansi
                       ON ((vu_sum_jual_kwitansi.`jkwitansi_ref` =
                               `master_jual_produk`.`jproduk_nobukti`)))
                   LEFT JOIN
                      vu_sum_jual_transfer
                   ON ((vu_sum_jual_transfer.`jtransfer_ref` =
                           `master_jual_produk`.`jproduk_nobukti`)))
               LEFT JOIN
                  vu_sum_jual_tunai
               ON ((vu_sum_jual_tunai.`jtunai_ref` =
                       `master_jual_produk`.`jproduk_nobukti`)))
           LEFT JOIN
              `vu_sum_jual_voucher`
           ON ((`vu_sum_jual_voucher`.`tvoucher_ref` =
                   `master_jual_produk`.`jproduk_nobukti`)));

/*------------ CREATE OR REPLACE VIEW JUAL PERAWATAN -------------------------------*/
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
          `master_jual_rawat`.`jrawat_bayar` AS `total_bayar`,
          ifnull(`master_jual_rawat`.`jrawat_diskon`, 0) AS `diskon`,
          ifnull(`master_jual_rawat`.`jrawat_cashback`, 0) AS `cashback`,
          ifnull(`master_lunas_piutang`.`lpiutang_total`, 0) AS `kredit`,
          ifnull(vu_sum_jual_cek.`jcek_nilai`, 0) AS `cek`,
          ifnull(vu_sum_jual_card.`jcard_nilai`, 0) AS `card`,
          ifnull(vu_sum_jual_kwitansi.`jkwitansi_nilai`, 0) AS `kuitansi`,
          ifnull(vu_sum_jual_transfer.`jtransfer_nilai`, 0) AS `transfer`,
          ifnull(vu_sum_jual_tunai.`jtunai_nilai`, 0) AS `tunai`,
          ifnull(vu_sum_jual_voucher.`tvoucher_nilai`, 0) AS `voucher`,
          `master_jual_rawat`.`jrawat_stat_dok` AS `jrawat_stat_dok`
     FROM (   (   (   (   (   (   (   (   (   `master_jual_rawat`
                                           LEFT JOIN
                                              `vu_total_jual_rawat_group`
                                           ON ((`vu_total_jual_rawat_group`.
                                                `drawat_master` =
                                                   `master_jual_rawat`.
                                                   `jrawat_id`)))
                                       LEFT JOIN
                                          `vu_customer`
                                       ON ((`master_jual_rawat`.`jrawat_cust` =
                                               `vu_customer`.`cust_id`)))
                                   LEFT JOIN
                                      vu_sum_jual_card
                                   ON ((vu_sum_jual_card.`jcard_ref` =
                                           `master_jual_rawat`.
                                           `jrawat_nobukti`)))
                               LEFT JOIN
                                  vu_sum_jual_cek
                               ON ((vu_sum_jual_cek.`jcek_ref` =
                                       `master_jual_rawat`.`jrawat_nobukti`)))
                           LEFT JOIN
                              `master_lunas_piutang`
                           ON ((`master_lunas_piutang`.`lpiutang_faktur` =
                                   `master_jual_rawat`.`jrawat_nobukti`)))
                       LEFT JOIN
                          vu_sum_jual_kwitansi
                       ON ((vu_sum_jual_kwitansi.`jkwitansi_ref` =
                               `master_jual_rawat`.`jrawat_nobukti`)))
                   LEFT JOIN
                      vu_sum_jual_transfer
                   ON ((vu_sum_jual_transfer.`jtransfer_ref` =
                           `master_jual_rawat`.`jrawat_nobukti`)))
               LEFT JOIN
                  vu_sum_jual_tunai
               ON ((vu_sum_jual_tunai.`jtunai_ref` =
                       `master_jual_rawat`.`jrawat_nobukti`)))
           LEFT JOIN
              vu_sum_jual_voucher
           ON ((vu_sum_jual_voucher.`tvoucher_ref` =
                   `master_jual_rawat`.`jrawat_nobukti`)));

/*------------------- CREATE OR REPLACE VIEW JUAL PAKET --------------------------------*/
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
          `master_jual_paket`.`jpaket_bayar` AS `total_bayar`,
          ifnull(`master_jual_paket`.`jpaket_diskon`, 0) AS `diskon`,
          ifnull(`master_jual_paket`.`jpaket_cashback`, 0) AS `cashback`,
          ifnull(`master_lunas_piutang`.`lpiutang_total`, 0) AS `kredit`,
          ifnull(`vu_sum_jual_cek`.`jcek_nilai`, 0) AS `cek`,
          ifnull(`vu_sum_jual_card`.`jcard_nilai`, 0) AS `card`,
          ifnull(`vu_sum_jual_kwitansi`.`jkwitansi_nilai`, 0) AS `kuitansi`,
          ifnull(`vu_sum_jual_transfer`.`jtransfer_nilai`, 0) AS `transfer`,
          ifnull(`vu_sum_jual_tunai`.`jtunai_nilai`, 0) AS `tunai`,
          ifnull(`vu_sum_jual_voucher`.`tvoucher_nilai`, 0) AS `voucher`,
          `master_jual_paket`.`jpaket_stat_dok` AS `jpaket_stat_dok`
     FROM (   (   (   (   (   (   (   (   (   `master_jual_paket`
                                           LEFT JOIN
                                              `vu_total_jual_paket_group`
                                           ON ((`vu_total_jual_paket_group`.
                                                `dpaket_master` =
                                                   `master_jual_paket`.
                                                   `jpaket_id`)))
                                       LEFT JOIN
                                          `vu_customer`
                                       ON ((`master_jual_paket`.`jpaket_cust` =
                                               `vu_customer`.`cust_id`)))
                                   LEFT JOIN
                                      `vu_sum_jual_card`
                                   ON ((`vu_sum_jual_card`.`jcard_ref` =
                                           `master_jual_paket`.
                                           `jpaket_nobukti`)))
                               LEFT JOIN
                                  `vu_sum_jual_cek`
                               ON ((`vu_sum_jual_cek`.`jcek_ref` =
                                       `master_jual_paket`.`jpaket_nobukti`)))
                           LEFT JOIN
                              `master_lunas_piutang`
                           ON ((`master_lunas_piutang`.`lpiutang_faktur` =
                                   `master_jual_paket`.`jpaket_nobukti`)))
                       LEFT JOIN
                          `vu_sum_jual_kwitansi`
                       ON ((`vu_sum_jual_kwitansi`.`jkwitansi_ref` =
                               `master_jual_paket`.`jpaket_nobukti`)))
                   LEFT JOIN
                      `vu_sum_jual_transfer`
                   ON ((`vu_sum_jual_transfer`.`jtransfer_ref` =
                           `master_jual_paket`.`jpaket_nobukti`)))
               LEFT JOIN
                  `vu_sum_jual_tunai`
               ON ((`vu_sum_jual_tunai`.`jtunai_ref` =
                       `master_jual_paket`.`jpaket_nobukti`)))
           LEFT JOIN
              `vu_sum_jual_voucher`
           ON ((`vu_sum_jual_voucher`.`tvoucher_ref` =
                   `master_jual_paket`.`jpaket_nobukti`)));

/*----------------------- CREATE OR REPLACE VIEW PENERIMAAN JUAL -------------------------*/
CREATE OR REPLACE VIEW `vu_trans_terima_jual`
AS
   SELECT `vu_sum_jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,
          date_format(`vu_sum_jual_tunai`.`jtunai_date_create`, '%Y-%m-%d')
             AS `tanggal`,
          `vu_sum_jual_tunai`.`jtunai_ref` AS `no_ref`,
          `vu_sum_jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `vu_sum_jual_tunai`.`jtunai_stat_dok` AS `stat_dok`
     FROM `vu_sum_jual_tunai`
   UNION
   SELECT `vu_sum_jual_card`.`jcard_transaksi` AS `jenis_transaksi`,
          date_format(`vu_sum_jual_card`.`jcard_date_create`, '%Y-%m-%d')
             AS `tanggal`,
          `vu_sum_jual_card`.`jcard_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          `vu_sum_jual_card`.`jcard_nilai` AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `vu_sum_jual_card`.`jcard_stat_dok` AS `stat_dok`
     FROM `vu_sum_jual_card`
   UNION
   SELECT `vu_sum_jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,
          date_format(`vu_sum_jual_cek`.`jcek_date_create`, '%Y-%m-%d')
             AS `tanggal`,
          `vu_sum_jual_cek`.`jcek_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          `vu_sum_jual_cek`.`jcek_nilai` AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `vu_sum_jual_cek`.`jcek_stat_dok` AS `stat_dok`
     FROM `vu_sum_jual_cek`
   UNION
   SELECT `vu_sum_jual_transfer`.`jtransfer_transaksi` AS `jenis_transaksi`,
          date_format(`vu_sum_jual_transfer`.`jtransfer_date_create`,
                      '%Y-%m-%d')
             AS `tanggal`,
          `vu_sum_jual_transfer`.`jtransfer_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          `vu_sum_jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `vu_sum_jual_transfer`.`jtransfer_stat_dok` AS `stat_dok`
     FROM `vu_sum_jual_transfer`
   UNION
   SELECT `vu_sum_jual_kwitansi`.`jkwitansi_transaksi` AS `jenis_transaksi`,
          date_format(`vu_sum_jual_kwitansi`.`jkwitansi_date_create`,
                      '%Y-%m-%d')
             AS `tanggal`,
          `vu_sum_jual_kwitansi`.`jkwitansi_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          `vu_sum_jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `vu_sum_jual_kwitansi`.`jkwitansi_stat_dok` AS `stat_dok`
     FROM `vu_sum_jual_kwitansi`
   UNION
   SELECT `voucher_terima`.`tvoucher_transaksi` AS `jenis_transaksi`,
          date_format(`voucher_terima`.`tvoucher_date_create`, '%Y-%m-%d')
             AS `tanggal`,
          `voucher_terima`.`tvoucher_ref` AS `no_ref`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          `voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `voucher_terima`.`tvoucher_stat_dok` AS `stat_dok`
     FROM `voucher_terima`;