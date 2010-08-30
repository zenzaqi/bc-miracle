/*--------------- CREATE VIEW DETAIL LUNAS PIUTANG -----------------*/

CREATE OR REPLACE VIEW `vu_detail_lunas_piutang`
AS
   SELECT `master_lunas_piutang`.`lpiutang_faktur` AS `no_bukti`,
          `master_lunas_piutang`.`lpiutang_cust` AS `lpiutang_cust`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `master_lunas_piutang`.`lpiutang_faktur_tanggal` AS `tanggal`,
          `master_lunas_piutang`.`lpiutang_keterangan`
             AS `lpiutang_keterangan`,
          `master_lunas_piutang`.`lpiutang_status` AS `lpiutang_status`,
          `master_lunas_piutang`.`lpiutang_total` AS `lpiutang_total`,
          `master_lunas_piutang`.`lpiutang_sisa` AS `lpiutang_sisa`,
          `master_lunas_piutang`.`lpiutang_jenis_transaksi`
             AS `lpiutang_jenis_transaksi`,
          `master_lunas_piutang`.`lpiutang_stat_dok` AS `lpiutang_stat_dok`,
          `detail_lunas_piutang`.`dpiutang_id` AS `dpiutang_id`,
          `detail_lunas_piutang`.`dpiutang_nobukti` AS `dpiutang_nobukti`,
          ifnull(`detail_lunas_piutang`.`dpiutang_nilai`, 0)
             AS `dpiutang_nilai`,
          ifnull(`detail_lunas_piutang`.`dpiutang_tanggal`,'-') AS `dpiutang_tanggal`,
          ifnull(`detail_lunas_piutang`.`dpiutang_cara`,'-') AS `dpiutang_cara`
     FROM (   (   `master_lunas_piutang`
               LEFT JOIN
                  `detail_lunas_piutang`
               ON ((`master_lunas_piutang`.`lpiutang_id` =
                       `detail_lunas_piutang`.`dpiutang_master`)))
           JOIN
              `customer`
           ON ((`master_lunas_piutang`.`lpiutang_cust` = `customer`.`cust_id`)));


/*----------- CREATE OR REPLACE VIEW DETAIL PIUTANG CARD ---------------*/
CREATE OR REPLACE VIEW `vu_detail_piutang_card`
AS
   SELECT `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,
          sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_card`
     FROM `detail_lunas_piutang`
    WHERE (`detail_lunas_piutang`.`dpiutang_cara` = 'card')
   GROUP BY `detail_lunas_piutang`.`dpiutang_master`;


/*----------- CREATE OR REPLACE VIEW DETAIL PIUTANG CEK ---------------*/
CREATE OR REPLACE VIEW `vu_detail_piutang_cek`
AS
   SELECT `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,
          sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_cek`
     FROM `detail_lunas_piutang`
    WHERE (`detail_lunas_piutang`.`dpiutang_cara` = 'cek/giro')
   GROUP BY `detail_lunas_piutang`.`dpiutang_master`;


/*----------- CREATE OR REPLACE VIEW DETAIL PIUTANG TUNAI ---------------*/
CREATE OR REPLACE VIEW `vu_detail_piutang_tunai`
AS
   SELECT `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,
          sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_tunai`
     FROM `detail_lunas_piutang`
    WHERE (`detail_lunas_piutang`.`dpiutang_cara` = 'tunai')
   GROUP BY `detail_lunas_piutang`.`dpiutang_master`;


/*----------- CREATE OR REPLACE VIEW DETAIL PIUTANG TRANSFER ---------------*/
CREATE OR REPLACE VIEW `vu_detail_piutang_transfer`
AS
   SELECT `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,
          sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_transfer`
     FROM `detail_lunas_piutang`
    WHERE (`detail_lunas_piutang`.`dpiutang_cara` = 'transfer')
   GROUP BY `detail_lunas_piutang`.`dpiutang_master`;


/*----------------- CREATE VIEW TRANS PIUTANG  -------------------------*/
CREATE OR REPLACE VIEW `vu_trans_piutang`
AS
   SELECT `master_lunas_piutang`.`lpiutang_id` AS `lpiutang_id`,
          `master_lunas_piutang`.`lpiutang_faktur` AS `no_bukti`,
          `master_lunas_piutang`.`lpiutang_cust` AS `lpiutang_cust`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_id` AS `cust_id`,
          `customer`.`cust_member` AS `cust_member`,
          `customer`.`cust_nama` AS `cust_nama`,
          `master_lunas_piutang`.`lpiutang_faktur_tanggal` AS `tanggal`,
          `master_lunas_piutang`.`lpiutang_keterangan`
             AS `lpiutang_keterangan`,
          `master_lunas_piutang`.`lpiutang_status` AS `lpiutang_status`,
          `master_lunas_piutang`.`lpiutang_total` AS `lpiutang_total`,
          `master_lunas_piutang`.`lpiutang_sisa` AS `lpiutang_sisa`,
          `master_lunas_piutang`.`lpiutang_jenis_transaksi`
             AS `lpiutang_jenis_transaksi`,
          `master_lunas_piutang`.`lpiutang_stat_dok` AS `lpiutang_stat_dok`,
          ifnull(`vu_detail_piutang_tunai`.`piutang_tunai`, 0)
             AS `piutang_tunai`,
          ifnull(`vu_detail_piutang_card`.`piutang_card`, 0)
             AS `piutang_card`,
          ifnull(`vu_detail_piutang_cek`.`piutang_cek`, 0) AS `piutang_cek`,
          ifnull(`vu_detail_piutang_transfer`.`piutang_transfer`, 0)
             AS `piutang_transfer`
     FROM (   (   (   (   (   `master_lunas_piutang`
                           JOIN
                              `customer`
                           ON ((`master_lunas_piutang`.`lpiutang_cust` =
                                   `customer`.`cust_id`)))
                       LEFT JOIN
                          `vu_detail_piutang_tunai`
                       ON ((`master_lunas_piutang`.`lpiutang_id` =
                               `vu_detail_piutang_tunai`.`dpiutang_master`)))
                   LEFT JOIN
                      `vu_detail_piutang_card`
                   ON ((`master_lunas_piutang`.`lpiutang_id` =
                           `vu_detail_piutang_card`.`dpiutang_master`)))
               LEFT JOIN
                  `vu_detail_piutang_cek`
               ON ((`master_lunas_piutang`.`lpiutang_id` =
                       `vu_detail_piutang_cek`.`dpiutang_master`)))
           LEFT JOIN
              `vu_detail_piutang_transfer`
           ON ((`master_lunas_piutang`.`lpiutang_id` =
                   `vu_detail_piutang_transfer`.`dpiutang_master`)));


