/* CREATE VIEW u/ DETAIL RETUR PAKET */

CREATE OR REPLACE VIEW `vu_detail_retur_paket_rawat`
AS
   SELECT `detail_retur_paket_rawat`.`drpaket_id` AS `drpaket_id`,
          `detail_retur_paket_rawat`.`drpaket_master` AS `drpaket_master`,
          `detail_retur_paket_rawat`.`drpaket_paket` AS `drpaket_paket`,
          `detail_retur_paket_rawat`.`drpaket_jpaket` AS `drpaket_jpaket`,
          `detail_retur_paket_rawat`.`drpaket_dpaket` AS `drpaket_dpaket`,
          `detail_retur_paket_rawat`.`drpaket_rawat` AS `drpaket_rawat`,
          `detail_retur_paket_rawat`.`drpaket_jumlah_diretur`
             AS `drpaket_jumlah_diretur`,
          `detail_retur_paket_rawat`.`drpaket_jumlah_terambil`
             AS `drpaket_jumlah_terambil`,
          `detail_retur_paket_rawat`.`drpaket_harga_satu`
             AS `drpaket_harga_satu`,
          `detail_retur_paket_rawat`.`drpaket_rupiah_retur`
             AS `drpaket_rupiah_retur`,
          `master_retur_jual_paket`.`rpaket_nobukti` AS `rpaket_nobukti`,
          `master_retur_jual_paket`.`rpaket_nobukti` AS `no_bukti`,
          `master_retur_jual_paket`.`rpaket_tanggal` AS `rpaket_tanggal`,
          `master_retur_jual_paket`.`rpaket_tanggal` AS `tanggal`,
          `master_retur_jual_paket`.`rpaket_id` AS `rpaket_id`,
          `master_retur_jual_paket`.`rpaket_nobuktijual`
             AS `rpaket_nobuktijual`,
          `master_retur_jual_paket`.`rpaket_stat_dok` AS `rpaket_stat_dok`,
          `master_retur_jual_paket`.`rpaket_cust` AS `rpaket_cust`,
          `master_retur_jual_paket`.`rpaket_keterangan`
             AS `rpaket_keterangan`,
          `master_jual_paket`.`jpaket_nobukti` AS `no_bukti_jual`,
          `master_jual_paket`.`jpaket_tanggal` AS `tanggal_jual`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_panggilan` AS `cust_panggilan`,
          `customer`.`cust_kelamin` AS `cust_kelamin`,
          `customer`.`cust_alamat` AS `cust_alamat`,
          `customer`.`cust_kota` AS `cust_kota`,
          `paket`.`paket_kode` AS `paket_kode`,
          `paket`.`paket_nama` AS `paket_nama`
     FROM (   (   (   (   `master_retur_jual_paket`
                       JOIN
                          `detail_retur_paket_rawat`
                       ON ((`detail_retur_paket_rawat`.`drpaket_master` =
                               `master_retur_jual_paket`.`rpaket_id`)))
                   JOIN
                      `customer`
                   ON ((`master_retur_jual_paket`.`rpaket_cust` =
                           `customer`.`cust_id`)))
               JOIN
                  `paket`
               ON ((`detail_retur_paket_rawat`.`drpaket_paket` =
                       `paket`.`paket_id`)))
           JOIN
              `master_jual_paket`
           ON ((`master_jual_paket`.`jpaket_id` =
                   `master_retur_jual_paket`.`rpaket_nobuktijual`)))

/* VIEW u/ GROUP DETAIL RETUR PAKET */

CREATE OR REPLACE VIEW `vu_total_retur_jual_paket_group`
AS
   SELECT ifnull(sum(detail_retur_paket_rawat.`drpaket_jumlah_diretur`), 0)
             AS `drpaket_jumlah_diretur`,
          ifnull(sum(detail_retur_paket_rawat.`drpaket_jumlah_terambil`), 0)
             AS `drpaket_jumlah_terambil`,
          ifnull(sum(detail_retur_paket_rawat.`drpaket_rupiah_retur`), 0)
             AS `drpaket_rupiah_retur`,
          detail_retur_paket_rawat.`drpaket_master` AS `drpaket_master`
     FROM detail_retur_paket_rawat
   GROUP BY detail_retur_paket_rawat.`drpaket_master`;

/* VIEW u/ TRANSAKSI RETUR PAKET */
CREATE OR REPLACE VIEW `vu_trans_retur_paket`
AS
   SELECT `master_retur_jual_paket`.`rpaket_nobukti` AS `no_bukti`,
          `master_retur_jual_paket`.`rpaket_cust` AS `cust_id`,
          `master_retur_jual_paket`.`rpaket_tanggal` AS `tanggal`,
          master_retur_jual_paket.rpaket_keterangan,
          `vu_customer`.`cust_no` AS `cust_no`,
          `vu_customer`.`cust_member` AS `cust_member`,
          `vu_customer`.`cust_nama` AS `cust_nama`,
          `vu_customer`.`cust_kelamin` AS `cust_kelamin`,
          `vu_customer`.`cust_alamat` AS `cust_alamat`,
          `vu_customer`.`cust_kota` AS `cust_kota`,
          `master_jual_paket`.`jpaket_nobukti` AS `no_bukti_jual`,
          `master_retur_jual_paket`.`rpaket_stat_dok` AS `rpaket_stat_dok`,
          `master_jual_paket`.`jpaket_tanggal` AS `tanggal_jual`,
          ifnull(`vu_total_retur_jual_paket_group`.`drpaket_jumlah_diretur`,
                 0)
             AS `drpaket_jumlah_diretur`,
          ifnull(`vu_total_retur_jual_paket_group`.`drpaket_jumlah_terambil`,
                 0)
             AS `drpaket_jumlah_terambil`,
          ifnull(`vu_total_retur_jual_paket_group`.`drpaket_rupiah_retur`, 0)
             AS `drpaket_rupiah_retur`
     FROM (   (   (   `master_retur_jual_paket`
                   LEFT JOIN
                      `vu_total_retur_jual_paket_group`
                   ON ((`vu_total_retur_jual_paket_group`.`drpaket_master` =
                           `master_retur_jual_paket`.`rpaket_id`)))
               LEFT JOIN
                  `vu_customer`
               ON ((`master_retur_jual_paket`.`rpaket_cust` =
                       `vu_customer`.`cust_id`)))
           LEFT JOIN
              `master_jual_paket`
           ON ((`master_retur_jual_paket`.`rpaket_nobuktijual` =
                   `master_jual_paket`.`jpaket_id`)));
