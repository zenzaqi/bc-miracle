/* Sinkronisasi POIN Kasir Produk*/
/* 
 * meng-UPDATE db.customer.cust_point dan db.master_jual_produk.jproduk_point, yang seharusnya customer tersebut mendapat POIN
*/


/* LANGKAH Sebelum Sinkronisasi POIN Kasir Produk */

/*
 * 1. Menghimpun total-poin dari setiap FAKTUR Kasir Produk (Member / bukan Member).
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jproduk_total_point` AS select `master_jual_produk`.`jproduk_id` AS `jproduk_id`,`master_jual_produk`.`jproduk_nobukti` AS `jproduk_nobukti`,`master_jual_produk`.`jproduk_tanggal` AS `jproduk_tanggal`,`master_jual_produk`.`jproduk_cust` AS `jproduk_cust`,((sum((((`detail_jual_produk`.`dproduk_jumlah` * `detail_jual_produk`.`dproduk_harga`) * `produk`.`produk_point`) * ((100 - `detail_jual_produk`.`dproduk_diskon`) / 100))) * ((100 - `master_jual_produk`.`jproduk_diskon`) / 100)) - `master_jual_produk`.`jproduk_cashback`) AS `dproduk_total_nilai`,floor((((sum((((`detail_jual_produk`.`dproduk_jumlah` * `detail_jual_produk`.`dproduk_harga`) * `produk`.`produk_point`) * ((100 - `detail_jual_produk`.`dproduk_diskon`) / 100))) * ((100 - `master_jual_produk`.`jproduk_diskon`) / 100)) - `master_jual_produk`.`jproduk_cashback`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1))) AS `jproduk_total_point` from ((`detail_jual_produk` join `master_jual_produk` on((`detail_jual_produk`.`dproduk_master` = `master_jual_produk`.`jproduk_id`))) join `produk` on((`detail_jual_produk`.`dproduk_produk` = `produk`.`produk_id`))) where ((`produk`.`produk_point` > 0) and `master_jual_produk`.`jproduk_cust`) group by `detail_jual_produk`.`dproduk_master`;



/*
 * 2. Memilah Faktur Kasir Produk yang customernya sudah menjadi Member ketika terjadi transaksi, dan men-TOTAL POIN yang di dapat dari tiap-tiap customer.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jproduk_cust_point_sink` AS select `vu_jproduk_total_point`.`jproduk_cust` AS `jproduk_cust`,sum(`vu_jproduk_total_point`.`jproduk_total_point`) AS `cust_total_point` from ((`vu_jproduk_total_point` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `vu_jproduk_total_point`.`jproduk_id`))) join `member` on((`vu_jproduk_total_point`.`jproduk_cust` = `member`.`member_cust`))) where ((`vu_jproduk_total_point`.`jproduk_total_point` > 0) and (`master_jual_produk`.`jproduk_point` = 0) and (`vu_jproduk_total_point`.`jproduk_tanggal` >= '2010-07-15') and (`member`.`member_valid` > `vu_jproduk_total_point`.`jproduk_tanggal`)) group by `vu_jproduk_total_point`.`jproduk_cust`;



/*
 * 3. Menghimpun tiap-tiap Faktur yang customernya sudah menjadi Member ketika terjadi transaksi, dan seharusnya Faktur itu mendapat POIN.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jproduk_point_sink` AS select `vu_jproduk_total_point`.`jproduk_id` AS `jproduk_id`,`vu_jproduk_total_point`.`jproduk_nobukti` AS `jproduk_nobukti`,`vu_jproduk_total_point`.`jproduk_tanggal` AS `jproduk_tanggal`,`vu_jproduk_total_point`.`jproduk_cust` AS `jproduk_cust`,`vu_jproduk_total_point`.`dproduk_total_nilai` AS `dproduk_total_nilai`,`vu_jproduk_total_point`.`jproduk_total_point` AS `jproduk_total_point` from ((`vu_jproduk_total_point` join `master_jual_produk` on((`master_jual_produk`.`jproduk_id` = `vu_jproduk_total_point`.`jproduk_id`))) join `member` on((`vu_jproduk_total_point`.`jproduk_cust` = `member`.`member_cust`))) where ((`vu_jproduk_total_point`.`jproduk_total_point` > 0) and (`master_jual_produk`.`jproduk_point` = 0) and (`vu_jproduk_total_point`.`jproduk_tanggal` >= '2010-07-15') and (`member`.`member_valid` > `vu_jproduk_total_point`.`jproduk_tanggal`)) group by `vu_jproduk_total_point`.`jproduk_id`;



/*
 * 4. Meng-UPDATE db.customer.cust_point
*/
UPDATE customer,
       vu_jproduk_cust_point_sink
   SET customer.cust_point =
          (customer.cust_point + vu_jproduk_cust_point_sink.cust_total_point)
 WHERE customer.cust_id = vu_jproduk_cust_point_sink.jproduk_cust;



/*
 * 5. Meng-UPDATE db.master_jual_produk.jproduk_point
*/
UPDATE master_jual_produk,
       vu_jproduk_point_sink
   SET master_jual_produk.jproduk_point =
          vu_jproduk_point_sink.jproduk_total_point
 WHERE master_jual_produk.jproduk_id = vu_jproduk_point_sink.jproduk_id;
