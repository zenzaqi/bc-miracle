/* Sinkronisasi POIN Kasir Paket*/
/* 
 * meng-UPDATE db.customer.cust_point dan db.master_jual_paket.jpaket_point, yang seharusnya customer tersebut mendapat POIN
*/


/* LANGKAH Sebelum Sinkronisasi POIN Kasir Paket */

/*
 * 1. Menghimpun total-poin dari setiap FAKTUR Kasir Paket (Member / bukan Member).
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_total_point` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,((sum((((`detail_jual_paket`.`dpaket_jumlah` * `detail_jual_paket`.`dpaket_harga`) * `paket`.`paket_point`) * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100))) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`) AS `dpaket_total_nilai`,floor((((sum((((`detail_jual_paket`.`dpaket_jumlah` * `detail_jual_paket`.`dpaket_harga`) * `paket`.`paket_point`) * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100))) * ((100 - `master_jual_paket`.`jpaket_diskon`) / 100)) - `master_jual_paket`.`jpaket_cashback`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1))) AS `jpaket_total_point` from ((`detail_jual_paket` join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) where ((`paket`.`paket_point` > 0) and `master_jual_paket`.`jpaket_cust`) group by `detail_jual_paket`.`dpaket_master`;



/*
 * 2. Memilah Faktur Kasir Paket yang customernya sudah menjadi Member ketika terjadi transaksi, dan men-TOTAL POIN yang di dapat dari tiap-tiap customer.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_cust_point_sink` AS select `vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,sum(`vu_jpaket_total_point`.`jpaket_total_point`) AS `cust_total_point` from ((`vu_jpaket_total_point` join `master_jual_paket` on((`master_jual_paket`.`jpaket_id` = `vu_jpaket_total_point`.`jpaket_id`))) join `member` on((`vu_jpaket_total_point`.`jpaket_cust` = `member`.`member_cust`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`master_jual_paket`.`jpaket_point` = 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` >= '2010-07-15') and (`member`.`member_valid` > `vu_jpaket_total_point`.`jpaket_tanggal`)) group by `vu_jpaket_total_point`.`jpaket_cust`;



/*
 * 3. Menghimpun tiap-tiap Faktur yang customernya sudah menjadi Member ketika terjadi transaksi, dan seharusnya Faktur itu mendapat POIN.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_point_sink` AS select `vu_jpaket_total_point`.`jpaket_id` AS `jpaket_id`,`vu_jpaket_total_point`.`jpaket_nobukti` AS `jpaket_nobukti`,`vu_jpaket_total_point`.`jpaket_tanggal` AS `jpaket_tanggal`,`vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,`vu_jpaket_total_point`.`dpaket_total_nilai` AS `dpaket_total_nilai`,`vu_jpaket_total_point`.`jpaket_total_point` AS `jpaket_total_point` from ((`vu_jpaket_total_point` join `master_jual_paket` on((`master_jual_paket`.`jpaket_id` = `vu_jpaket_total_point`.`jpaket_id`))) join `member` on((`vu_jpaket_total_point`.`jpaket_cust` = `member`.`member_cust`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`master_jual_paket`.`jpaket_point` = 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` >= '2010-07-15') and (`member`.`member_valid` > `vu_jpaket_total_point`.`jpaket_tanggal`)) group by `vu_jpaket_total_point`.`jpaket_id`;



/*
 * 4. Meng-UPDATE db.customer.cust_point
*/
UPDATE customer,
       vu_jpaket_cust_point_sink
   SET customer.cust_point =
          (customer.cust_point + vu_jpaket_cust_point_sink.cust_total_point)
 WHERE customer.cust_id = vu_jpaket_cust_point_sink.jpaket_cust;



/*
 * 5. Meng-UPDATE db.master_jual_paket.jpaket_point
*/
UPDATE master_jual_paket,
       vu_jpaket_point_sink
   SET master_jual_paket.jpaket_point =
          vu_jpaket_point_sink.jpaket_total_point
 WHERE master_jual_paket.jpaket_id = vu_jpaket_point_sink.jpaket_id;
