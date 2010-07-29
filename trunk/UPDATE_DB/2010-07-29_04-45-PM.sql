CREATE OR REPLACE VIEW `vu_detail_kuitansi`
AS
   SELECT `cetak_kwitansi`.`kwitansi_id` AS `kwitansi_id`,
          `cetak_kwitansi`.`kwitansi_no` AS `no_bukti`,
          `cetak_kwitansi`.`kwitansi_cust` AS `kwitansi_cust`,
          `cetak_kwitansi`.`kwitansi_tanggal` AS `tanggal`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `jual_kwitansi`.`jkwitansi_id` AS `jkwitansi_id`,
          `jual_kwitansi`.`jkwitansi_master`
             AS `jkwitansi_master`,
          `cetak_kwitansi`.`kwitansi_cara` AS `cara_bayar`,
          `cetak_kwitansi`.`kwitansi_bayar` AS `total_bayar`,
          `cetak_kwitansi`.`kwitansi_nilai` AS `total_nilai`,
          `jual_kwitansi`.`jkwitansi_no` AS `jkwitansi_no`,
          ifnull(`jual_kwitansi`.`jkwitansi_nilai`, 0)
             AS `pakai_nilai`,
          `jual_kwitansi`.`jkwitansi_ref` AS `no_faktur`,
          `jual_kwitansi`.`jkwitansi_transaksi`
             AS `jenis_transaksi`,
          ifnull(`jual_kwitansi`.`jkwitansi_stat_dok`,
                 `cetak_kwitansi`.`kwitansi_status`)
             AS `jual_stat_dok`,
          `cetak_kwitansi`.`kwitansi_status` AS `stat_dok`
     FROM (   (   `cetak_kwitansi`
               LEFT JOIN
                  `jual_kwitansi`
               ON ((`cetak_kwitansi`.`kwitansi_id` =
                       `jual_kwitansi`.`jkwitansi_master`)))
           JOIN
              `customer`
           ON ((`cetak_kwitansi`.`kwitansi_cust` =
                   `customer`.`cust_id`)));



CREATE OR REPLACE VIEW .`vu_total_kuitansi_group`
AS
   SELECT .`jual_kwitansi`.`jkwitansi_master` AS `master`,
          sum(.`jual_kwitansi`.`jkwitansi_nilai`) AS `subtotal`
     FROM .`jual_kwitansi`
   GROUP BY .`jual_kwitansi`.`jkwitansi_master`;


CREATE OR REPLACE VIEW `vu_trans_kuitansi`
AS
   SELECT `cetak_kwitansi`.`kwitansi_id` AS `kwitansi_id`,
          `cetak_kwitansi`.`kwitansi_no` AS `no_bukti`,
          `cetak_kwitansi`.`kwitansi_cust` AS `kwitansi_cust`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `cetak_kwitansi`.`kwitansi_tanggal` AS `tanggal`,
          `cetak_kwitansi`.`kwitansi_ref` AS `kwitansi_ref`,
          `cetak_kwitansi`.`kwitansi_cara` AS `cara_bayar`,
          `cetak_kwitansi`.`kwitansi_bayar` AS `total_bayar`,
          `cetak_kwitansi`.`kwitansi_nilai` AS `total_nilai`,
          `cetak_kwitansi`.`kwitansi_keterangan` AS `keterangan`,
          `cetak_kwitansi`.`kwitansi_status` AS `stat_dok`,
          `cetak_kwitansi`.`no_nota` AS `no_nota`,
          ifnull(`vu_total_kuitansi_group`.`subtotal`, 0) AS `total_pakai`,
          (`cetak_kwitansi`.`kwitansi_nilai`
           - ifnull(`vu_total_kuitansi_group`.`subtotal`, 0))
             AS `total_sisa`
     FROM (   (   `cetak_kwitansi`
               JOIN
                  `customer`
               ON ((`cetak_kwitansi`.`kwitansi_cust` =
                       `customer`.`cust_id`)))
           LEFT JOIN
              `vu_total_kuitansi_group`
           ON ((`vu_total_kuitansi_group`.`master` =
                   `cetak_kwitansi`.`kwitansi_id`)));