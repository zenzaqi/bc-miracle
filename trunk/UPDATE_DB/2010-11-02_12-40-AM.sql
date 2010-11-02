CREATE OR REPLACE VIEW vu_history_poin_faktur
AS
   SELECT `master_jual_paket`.`jpaket_nobukti` AS no_bukti,
          `master_jual_paket`.`jpaket_tanggal` AS tanggal,
          `master_jual_paket`.`jpaket_point` AS point,
          'Paket' AS 'jenis',
          `customer`.`cust_id` AS cust_id,
          `customer`.`cust_no` AS cust_no,
          `customer`.`cust_member` AS cust_member,
          `customer`.`cust_nama` AS cust_nama,
          `customer`.`cust_panggilan` AS cust_panggilan,
          `customer`.`cust_kelamin` AS cust_kelamin
     FROM    `master_jual_paket`
          INNER JOIN
             `customer`
          ON `master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`
   UNION
   SELECT `master_jual_produk`.`jproduk_nobukti` AS no_bukti,
          `master_jual_produk`.`jproduk_tanggal` AS tanggal,
          `master_jual_produk`.`jproduk_point` AS point,
          'Produk' AS 'jenis',
          `customer`.`cust_id` AS cust_id,
          `customer`.`cust_no` AS cust_no,
          `customer`.`cust_member` AS cust_member,
          `customer`.`cust_nama` AS cust_nama,
          `customer`.`cust_panggilan` AS cust_panggilan,
          `customer`.`cust_kelamin` AS cust_kelamin
     FROM    `master_jual_produk`
          INNER JOIN
             `customer`
          ON `master_jual_produk`.`jproduk_cust` = `customer`.`cust_id`
   UNION
   SELECT `master_jual_rawat`.`jrawat_nobukti` AS no_bukti,
          `master_jual_rawat`.`jrawat_tanggal` AS tanggal,
          `master_jual_rawat`.`jrawat_point` AS point,
          'Perawatan' AS 'jenis',
          `customer`.`cust_id` AS cust_id,
          `customer`.`cust_no` AS cust_no,
          `customer`.`cust_member` AS cust_member,
          `customer`.`cust_nama` AS cust_nama,
          `customer`.`cust_panggilan` AS cust_panggilan,
          `customer`.`cust_kelamin` AS cust_kelamin
     FROM    `master_jual_rawat`
          INNER JOIN
             `customer`
          ON `master_jual_rawat`.`jrawat_cust` = `customer`.`cust_id`