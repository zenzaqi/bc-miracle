/* Sinkronisasi POIN Kasir Perawatan */
/* 
 * meng-UPDATE db.customer.cust_point dan db.master_jual_rawat.jrawat_point, yang seharusnya customer tersebut mendapat POIN
*/


/* LANGKAH Sebelum Sinkronisasi POIN Kasir Perawatan */

/*
 * 1. Menghitung Total-Poin dari setiap FAKTUR Kasir Perawatan (yang Customernya sudah menjadi Member DAN status dokumen = Tertutup).
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_total_point` AS select `master_jual_rawat`.`jrawat_id` AS `jrawat_id`,`master_jual_rawat`.`jrawat_nobukti` AS `jrawat_nobukti`,`master_jual_rawat`.`jrawat_cust` AS `jrawat_cust`,`master_jual_rawat`.`jrawat_tanggal` AS `jrawat_tanggal`,sum(floor(((((`detail_jual_rawat`.`drawat_jumlah` * `detail_jual_rawat`.`drawat_harga`) * ((100 - `detail_jual_rawat`.`drawat_diskon`) / 100)) * `perawatan`.`rawat_point`) / (select `member_setup`.`setmember_point_perrp` AS `setmember_point_perrp` from `member_setup` limit 1)))) AS `jrawat_total_point` from (((`detail_jual_rawat` join `master_jual_rawat` on(((`detail_jual_rawat`.`drawat_master` = `master_jual_rawat`.`jrawat_id`) and (`master_jual_rawat`.`jrawat_stat_dok` = 'Tertutup')))) join `member` on(((`master_jual_rawat`.`jrawat_cust` = `member`.`member_cust`) and ((`member`.`member_valid` + interval (select `member_setup`.`setmember_periodetenggang` AS `setmember_periodetenggang` from `member_setup` limit 1) day) >= `master_jual_rawat`.`jrawat_tanggal`) and (`member`.`member_register` < `master_jual_rawat`.`jrawat_tanggal`)))) join `perawatan` on((`detail_jual_rawat`.`drawat_rawat` = `perawatan`.`rawat_id`))) group by `detail_jual_rawat`.`drawat_master`;


/*
 * 2. Dari No.1 kita TOTAL POIN yang seharusnya didapat oleh Customer tetapi masih belum masuk ke db.customer ( yang artinya di db.master_jual_rawat.jrawat_point=0 ). Transaksi yang terjadi adalah antara tanggal 15 Juli 2010 s/d 05 Okt 2010.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_cust_point_sink` AS select `vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,sum(`vu_jrawat_total_point`.`jrawat_total_point`) AS `cust_total_point` from (`vu_jrawat_total_point` join `master_jual_rawat` on((`vu_jrawat_total_point`.`jrawat_id` = `master_jual_rawat`.`jrawat_id`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` between '2010-07-15' and '2010-10-05') and (`master_jual_rawat`.`jrawat_point` = 0)) group by `vu_jrawat_total_point`.`jrawat_cust`;



/* START: UPDATE POIN di db.customer dan db.master_jual_rawat dalam KURUN WAKTU '2010-07-15' s/d '2010-10-05' */
/*
 * Pada No.2 digunakan untuk menambahkan poin ke db.customer.cust_point dalam kurun waktu '2010-07-15' s/d '2010-10-05'.
*/

/*
 * 3.A. MENAMBAHKAN POIN ke db.customer.cust_point dengan query di No.2
*/

UPDATE customer,
       vu_jrawat_cust_point_sink
   SET customer.cust_point =
          (customer.cust_point + vu_jrawat_cust_point_sink.cust_total_point)
 WHERE customer.cust_id = vu_jrawat_cust_point_sink.jrawat_cust;



/*
 * 3.B. UPDATE db.master_jual_rawat.jrawat_point dalam kurun waktu '2010-07-15' s/d '2010-10-05', yang seharusnya <> 0. 
*/

UPDATE master_jual_rawat,
       vu_jrawat_total_point
   SET master_jual_rawat.jrawat_point =
          (vu_jrawat_total_point.jrawat_total_point)
 WHERE     master_jual_rawat.jrawat_id = vu_jrawat_total_point.jrawat_id
       AND master_jual_rawat.jrawat_point = 0
       AND vu_jrawat_total_point.jrawat_total_point > 0
       AND (vu_jrawat_total_point.jrawat_tanggal BETWEEN '2010-07-15'
                                                       AND '2010-10-05');

/* END */



/* START: UPDATE POIN di db.customer dan db.master_jual_rawat dalam KURUN WAKTU '2010-10-06' s/d SEKARANG */

/*
 * 4.A. UPDATE db.master_jual_rawat.jrawat_point = 0, dari tanggal '2010-10-06' s/d SEKARANG.
*/

UPDATE master_jual_rawat
   SET jrawat_point = 0
 WHERE jrawat_tanggal >= '2010-10-06';



/*
 * 4.B. CREATE VIEW yang menampung Faktur Perawatan dari tanggal '2010-10-06' s/d SEKARANG dengan customer yang sudah menjadi MEMBER.
*/

CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vu_jrawat_cust_point_sink_2` AS select `vu_jrawat_total_point`.`jrawat_cust` AS `jrawat_cust`,sum(`vu_jrawat_total_point`.`jrawat_total_point`) AS `cust_total_point` from (`vu_jrawat_total_point` join `master_jual_rawat` on((`vu_jrawat_total_point`.`jrawat_id` = `master_jual_rawat`.`jrawat_id`))) where ((`vu_jrawat_total_point`.`jrawat_total_point` > 0) and (`vu_jrawat_total_point`.`jrawat_tanggal` >= '2010-10-06') and (`master_jual_rawat`.`jrawat_point` = 0)) group by `vu_jrawat_total_point`.`jrawat_cust`;



/*
 * 4.C. MENAMBAHKAN POIN ke db.customer.cust_point dalam kurun waktu '2010-10-06' s/d SEKARANG.
*/

UPDATE customer,
       vu_jrawat_cust_point_sink_2
   SET customer.cust_point =
          (customer.cust_point + vu_jrawat_cust_point_sink_2.cust_total_point)
 WHERE customer.cust_id = vu_jrawat_cust_point_sink_2.jrawat_cust;



/*
 * 4.D. UPDATE db.master_jual_rawat.jrawat_point dalam kurun waktu '2010-10-06' s/d SEKARANG, yang seharusnya <> 0. 
*/

UPDATE master_jual_rawat,
       vu_jrawat_total_point
   SET master_jual_rawat.jrawat_point =
          (vu_jrawat_total_point.jrawat_total_point)
 WHERE     master_jual_rawat.jrawat_id = vu_jrawat_total_point.jrawat_id
       AND master_jual_rawat.jrawat_point = 0
       AND vu_jrawat_total_point.jrawat_total_point > 0
       AND (vu_jrawat_total_point.jrawat_tanggal >= '2010-10-06');

/* END */



