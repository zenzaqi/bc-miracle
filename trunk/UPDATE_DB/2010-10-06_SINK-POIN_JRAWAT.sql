/* Sinkronisasi POIN Kasir Perawatan */
/* 
 * meng-UPDATE db.customer.cust_point dan db.master_jual_rawat.jrawat_point, yang seharusnya customer tersebut mendapat POIN
*/


/* LANGKAH Sebelum Sinkronisasi POIN Kasir Perawatan */

/*
 * 1. Menghimpun total-poin dari setiap FAKTUR Kasir Perawatan (Member / bukan Member).
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_total_point` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,((sum((((`detail_jual_rawat`.`drawat_jumlah` * `detail_jual_rawat`.`drawat_harga`) * `perawatan`.`rawat_point`) * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100))) * ((100 - `master_jual_rawat`.`jrawat_diskon`) / 100)) - `master_jual_rawat`.`jrawat_cashback`) AS `drawat_total_nilai`,floor((((sum((((`detail_jual_rawat`.`drawat_jumlah` * `detail_jual_rawat`.`drawat_harga`) * `perawatan`.`rawat_point`) * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100))) * ((100 - `master_jual_rawat`.`jrawat_diskon`) / 100)) - `master_jual_rawat`.`jrawat_cashback`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1))) AS `jrawat_total_point` from ((`detail_jual_rawat` join `master_jual_rawat` on((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`))) join `perawatan` on((`detail_jual_rawat`.`drawat_rawat` = `perawatan`.`rawat_id`))) where ((`perawatan`.`rawat_point` > 0) and `master_jual_rawat`.`jrawat_cust`) group by `detail_jual_rawat`.`drawat_master`;



/*
 * 2. Memilah Faktur Kasir Perawatan yang customernya sudah menjadi Member ketika terjadi transaksi, dan men-TOTAL POIN yang di dapat dari tiap-tiap customer.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_cust_point_sink` AS select `vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,sum(`vu_jrawat_total_point`.`jrawat_total_point`) AS `cust_total_point` from ((`vu_jrawat_total_point` join `master_jual_rawat` on((`master_jual_rawat`.`jrawat_id` = `vu_jrawat_total_point`.`jrawat_id`))) join `member` on((`vu_jrawat_total_point`.`jrawat_cust` = `member`.`member_cust`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`master_jual_rawat`.`jrawat_point` = 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` >= '2010-07-15') and (`member`.`member_valid` > `vu_jrawat_total_point`.`jrawat_tanggal`)) group by `vu_jrawat_total_point`.`jrawat_cust`;


/*
 * 3. Menghimpun tiap-tiap Faktur yang customernya sudah menjadi Member ketika terjadi transaksi, dan seharusnya Faktur itu mendapat POIN.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_point_sink` AS select `vu_jrawat_total_point`.`jrawat_id` AS `jrawat_id`,`vu_jrawat_total_point`.`jrawat_nobukti` AS `jrawat_nobukti`,`vu_jrawat_total_point`.`jrawat_tanggal` AS `jrawat_tanggal`,`vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,`vu_jrawat_total_point`.`drawat_total_nilai` AS `drawat_total_nilai`,`vu_jrawat_total_point`.`jrawat_total_point` AS `jrawat_total_point` from ((`vu_jrawat_total_point` join `master_jual_rawat` on((`master_jual_rawat`.`jrawat_id` = `vu_jrawat_total_point`.`jrawat_id`))) join `member` on((`vu_jrawat_total_point`.`jrawat_cust` = `member`.`member_cust`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`master_jual_rawat`.`jrawat_point` = 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` >= '2010-07-15') and (`member`.`member_valid` > `vu_jrawat_total_point`.`jrawat_tanggal`)) group by `vu_jrawat_total_point`.`jrawat_id`;


/*
 * 4. Meng-UPDATE db.customer.cust_point
*/
UPDATE customer,
       vu_jrawat_cust_point_sink
   SET customer.cust_point =
          (customer.cust_point + vu_jrawat_cust_point_sink.cust_total_point)
 WHERE customer.cust_id = vu_jrawat_cust_point_sink.jrawat_cust;



/*
 * 5. Meng-UPDATE db.master_jual_rawat.jrawat_point
*/
UPDATE master_jual_rawat,
       vu_jrawat_point_sink
   SET master_jual_rawat.jrawat_point =
          vu_jrawat_point_sink.jrawat_total_point
 WHERE master_jual_rawat.jrawat_id = vu_jrawat_point_sink.jrawat_id;
