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
          ifnull(`jual_kredit`.`jkredit_nilai`, 0)
             AS `kredit`,
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
                          `jual_kredit`
                       ON ((`jual_kredit`.`jkredit_ref` =
                               `master_jual_paket`.
                               `jpaket_nobukti`)))
                   LEFT JOIN
                      `jual_kwitansi`
                   ON ((`jual_kwitansi`.`jkwitansi_ref` =
                           `master_jual_paket`.
                           `jpaket_nobukti`)))
               LEFT JOIN
                  `jual_transfer`
               ON ((`jual_transfer`.`jtransfer_ref` =
                       `master_jual_paket`.`jpaket_nobukti`)))
           LEFT JOIN
              `jual_tunai`
           ON ((`jual_tunai`.`jtunai_ref` =
                   `master_jual_paket`.`jpaket_nobukti`)));