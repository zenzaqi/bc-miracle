/*
 * SEBELUM proses update db.customer, sediakan database 'miracledb_2010-10-05' (database di tanggal '2010-10-05') dan 'miracledb' (database terbaru).
*/

/*
 * UPDATE miracledb.customer.cust_point = miracledb_2010-10-05.customer.cust_point (mengembalikan nilai cust_point ke tanggal '2010-10-05')
*/

UPDATE miracledb.customer,
       `#mysql50#miracledb_2010-10-05`.customer
   SET miracledb.customer.cust_point =
          `#mysql50#miracledb_2010-10-05`.customer.cust_point
 WHERE miracledb.customer.cust_id =
          `#mysql50#miracledb_2010-10-05`.customer.cust_id;