UPDATE jual_tunai,
       master_jual_produk
   SET jtunai_date_create = jproduk_tanggal
 WHERE jual_tunai.jtunai_ref = master_jual_produk.jproduk_nobukti
       AND jtunai_date_create <> jproduk_tanggal;

UPDATE jual_tunai,
       master_jual_rawat
   SET jtunai_date_create = jrawat_tanggal
 WHERE jual_tunai.jtunai_ref = master_jual_rawat.jrawat_nobukti
       AND jtunai_date_create <> jrawat_tanggal;

UPDATE jual_tunai,
       master_jual_paket
   SET jtunai_date_create = jpaket_tanggal
 WHERE jual_tunai.jtunai_ref = master_jual_paket.jpaket_nobukti
       AND jtunai_date_create <> jpaket_tanggal;

UPDATE jual_tunai,
       cetak_kwitansi
   SET jtunai_date_create = kwitansi_tanggal
 WHERE jual_tunai.jtunai_ref = cetak_kwitansi.kwitansi_no
       AND jtunai_date_create <> kwitansi_tanggal;
/*------------------------------------------------------------*/

UPDATE jual_cek,
       master_jual_produk
   SET jcek_date_create = jproduk_tanggal
 WHERE jual_cek.jcek_ref = master_jual_produk.jproduk_nobukti
       AND jcek_date_create <> jproduk_tanggal;

UPDATE jual_cek,
       master_jual_rawat
   SET jcek_date_create = jrawat_tanggal
 WHERE jual_cek.jcek_ref = master_jual_rawat.jrawat_nobukti
       AND jcek_date_create <> jrawat_tanggal;

UPDATE jual_cek,
       master_jual_paket
   SET jcek_date_create = jpaket_tanggal
 WHERE jual_cek.jcek_ref = master_jual_paket.jpaket_nobukti
       AND jcek_date_create <> jpaket_tanggal;

UPDATE jual_cek,
       cetak_kwitansi
   SET jcek_date_create = kwitansi_tanggal
 WHERE jual_cek.jcek_ref = cetak_kwitansi.kwitansi_no
       AND jcek_date_create <> kwitansi_tanggal;


/*----------------------------------------------------------- */
UPDATE jual_card,
       master_jual_produk
   SET jcard_date_create = jproduk_tanggal
 WHERE jual_card.jcard_ref = master_jual_produk.jproduk_nobukti
       AND jcard_date_create <> jproduk_tanggal;

UPDATE jual_card,
       master_jual_rawat
   SET jcard_date_create = jrawat_tanggal
 WHERE jual_card.jcard_ref = master_jual_rawat.jrawat_nobukti
       AND jcard_date_create <> jrawat_tanggal;

UPDATE jual_card,
       master_jual_paket
   SET jcard_date_create = jpaket_tanggal
 WHERE jual_card.jcard_ref = master_jual_paket.jpaket_nobukti
       AND jcard_date_create <> jpaket_tanggal;

UPDATE jual_card,
       cetak_kwitansi
   SET jcard_date_create = kwitansi_tanggal
 WHERE jual_card.jcard_ref = cetak_kwitansi.kwitansi_no
       AND jcard_date_create <> kwitansi_tanggal;
/*---------------------------------------------------------------*/

UPDATE jual_kwitansi,
       master_jual_produk
   SET jkwitansi_date_create = jproduk_tanggal
 WHERE jual_kwitansi.jkwitansi_ref = master_jual_produk.jproduk_nobukti
       AND jkwitansi_date_create <> jproduk_tanggal;

UPDATE jual_kwitansi,
       master_jual_rawat
   SET jkwitansi_date_create = jrawat_tanggal
 WHERE jual_kwitansi.jkwitansi_ref = master_jual_rawat.jrawat_nobukti
       AND jkwitansi_date_create <> jrawat_tanggal;

UPDATE jual_kwitansi,
       master_jual_paket
   SET jkwitansi_date_create = jpaket_tanggal
 WHERE jual_kwitansi.jkwitansi_ref = master_jual_paket.jpaket_nobukti
       AND jkwitansi_date_create <> jpaket_tanggal;

UPDATE jual_kwitansi,
       cetak_kwitansi
   SET jkwitansi_date_create = kwitansi_tanggal
 WHERE jual_kwitansi.jkwitansi_ref = cetak_kwitansi.kwitansi_no
       AND jkwitansi_date_create <> kwitansi_tanggal;

/*-------------------------------------------------------------*/
UPDATE jual_transfer,
       master_jual_produk
   SET jtransfer_date_create = jproduk_tanggal
 WHERE jual_transfer.jtransfer_ref = master_jual_produk.jproduk_nobukti
       AND jtransfer_date_create <> jproduk_tanggal;

UPDATE jual_transfer,
       master_jual_rawat
   SET jtransfer_date_create = jrawat_tanggal
 WHERE jual_transfer.jtransfer_ref = master_jual_rawat.jrawat_nobukti
       AND jtransfer_date_create <> jrawat_tanggal;

UPDATE jual_transfer,
       master_jual_paket
   SET jtransfer_date_create = jpaket_tanggal
 WHERE jual_transfer.jtransfer_ref = master_jual_paket.jpaket_nobukti
       AND jtransfer_date_create <> jpaket_tanggal;

UPDATE jual_transfer,
       cetak_kwitansi
   SET jtransfer_date_create = kwitansi_tanggal
 WHERE jual_transfer.jtransfer_ref = cetak_kwitansi.kwitansi_no
       AND jtransfer_date_create <> kwitansi_tanggal;
/*---------------------------------------------------------------------*/
