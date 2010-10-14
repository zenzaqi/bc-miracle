/* Sinkronisasi POIN Kasir Paket*/
/* 
 * meng-UPDATE db.customer.cust_point dan db.master_jual_paket.jpaket_point, yang seharusnya customer tersebut mendapat POIN
*/


/* LANGKAH Sebelum Sinkronisasi POIN Kasir Paket */

/*
 * 1. Menghitung Total-Poin dari setiap FAKTUR Kasir Paket (yang Customernya sudah menjadi Member DAN status dokumen = Tertutup).
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_total_point` AS select `master_jual_paket`.`jpaket_id` AS `jpaket_id`,`master_jual_paket`.`jpaket_nobukti` AS `jpaket_nobukti`,`master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,`master_jual_paket`.`jpaket_tanggal` AS `jpaket_tanggal`,sum(floor(((((`detail_jual_paket`.`dpaket_jumlah` * `detail_jual_paket`.`dpaket_harga`) * ((100 - `detail_jual_paket`.`dpaket_diskon`) / 100)) * `paket`.`paket_point`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1)))) AS `jpaket_total_point` from (((`detail_jual_paket` join `master_jual_paket` on(((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`) and (`master_jual_paket`.`jpaket_stat_dok` = 'Tertutup')))) join `member` on(((`master_jual_paket`.`jpaket_cust` = `member`.`member_cust`) and ((`member`.`member_valid` + interval (select `member_setup`.`setmember_periodetenggang` AS `setmember_periodetenggang` from `member_setup` limit 1) day) >= `master_jual_paket`.`jpaket_tanggal`) and (`member`.`member_register` < `master_jual_paket`.`jpaket_tanggal`)))) join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) group by `detail_jual_paket`.`dpaket_master`;



/*
 * 2. Dari No.1 kita TOTAL POIN yang seharusnya didapat oleh Customer tetapi masih belum masuk ke db.customer ( yang artinya di db.master_jual_paket.jpaket_point=0 ). Transaksi yang terjadi adalah antara tanggal 15 Juli 2010 s/d 05 Okt 2010.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_cust_point_sink` AS select `vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,sum(`vu_jpaket_total_point`.`jpaket_total_point`) AS `cust_total_point` from (`vu_jpaket_total_point` join `master_jual_paket` on((`vu_jpaket_total_point`.`jpaket_id` = `master_jual_paket`.`jpaket_id`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` between '2010-07-15' and '2010-10-05') and (`master_jual_paket`.`jpaket_point` = 0)) group by `vu_jpaket_total_point`.`jpaket_cust`;



/* START: UPDATE POIN di db.customer dan db.master_jual_paket dalam KURUN WAKTU '2010-07-15' s/d '2010-10-05' */
/*
 * Pada No.2 digunakan untuk menambahkan poin ke db.customer.cust_point dalam kurun waktu '2010-07-15' s/d '2010-10-05'.
*/

/*
 * 3.A. MENAMBAHKAN POIN ke db.customer.cust_point dengan query di No.2
*/

UPDATE customer,
       vu_jpaket_cust_point_sink
   SET customer.cust_point =
          (customer.cust_point + vu_jpaket_cust_point_sink.cust_total_point)
 WHERE customer.cust_id = vu_jpaket_cust_point_sink.jpaket_cust;



/*
 * 3.B. UPDATE db.master_jual_paket.jpaket_point dalam kurun waktu '2010-07-15' s/d '2010-10-05', yang seharusnya <> 0. 
*/

UPDATE master_jual_paket,
       vu_jpaket_total_point
   SET master_jual_paket.jpaket_point =
          (vu_jpaket_total_point.jpaket_total_point)
 WHERE     master_jual_paket.jpaket_id = vu_jpaket_total_point.jpaket_id
       AND master_jual_paket.jpaket_point = 0
       AND vu_jpaket_total_point.jpaket_total_point > 0
       AND (vu_jpaket_total_point.jpaket_tanggal BETWEEN '2010-07-15'
                                                       AND '2010-10-05');

/* END */



/* START: UPDATE POIN di db.customer dan db.master_jual_paket dalam KURUN WAKTU '2010-10-06' s/d SEKARANG */

/*
 * 4.A. UPDATE db.master_jual_paket.jpaket_point = 0, dari tanggal '2010-10-06' s/d SEKARANG.
*/

UPDATE master_jual_paket
   SET jpaket_point = 0
 WHERE jpaket_tanggal >= '2010-10-06';



/*
 * 4.B. CREATE VIEW yang menampung Faktur Paket dari tanggal '2010-10-06' s/d SEKARANG dengan customer yang sudah menjadi MEMBER.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jpaket_cust_point_sink_2` AS select `vu_jpaket_total_point`.`jpaket_cust` AS `jpaket_cust`,sum(`vu_jpaket_total_point`.`jpaket_total_point`) AS `cust_total_point` from (`vu_jpaket_total_point` join `master_jual_paket` on((`vu_jpaket_total_point`.`jpaket_id` = `master_jual_paket`.`jpaket_id`))) where ((`vu_jpaket_total_point`.`jpaket_total_point` > 0) and (`vu_jpaket_total_point`.`jpaket_tanggal` >= '2010-10-06') and (`master_jual_paket`.`jpaket_point` = 0)) group by `vu_jpaket_total_point`.`jpaket_cust`;



/*
 * 4.C. MENAMBAHKAN POIN ke db.customer.cust_point dalam kurun waktu '2010-10-06' s/d SEKARANG.
*/

UPDATE customer,
       vu_jpaket_cust_point_sink_2
   SET customer.cust_point =
          (customer.cust_point + vu_jpaket_cust_point_sink_2.cust_total_point)
 WHERE customer.cust_id = vu_jpaket_cust_point_sink_2.jpaket_cust;



/*
 * 4.D. UPDATE db.master_jual_paket.jpaket_point dalam kurun waktu '2010-10-06' s/d SEKARANG, yang seharusnya <> 0. 
*/

UPDATE master_jual_paket,
       vu_jpaket_total_point
   SET master_jual_paket.jpaket_point =
          (vu_jpaket_total_point.jpaket_total_point)
 WHERE     master_jual_paket.jpaket_id = vu_jpaket_total_point.jpaket_id
       AND master_jual_paket.jpaket_point = 0
       AND vu_jpaket_total_point.jpaket_total_point > 0
       AND (vu_jpaket_total_point.jpaket_tanggal >= '2010-10-06');

/* END */


