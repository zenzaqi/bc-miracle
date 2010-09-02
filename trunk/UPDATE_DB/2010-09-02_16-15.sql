/* file ini adalah duplikasi dari 2010-08-25_12-15-PM.sql, utk memperbaiki piutang customer di Laporan*/

/*--- UPDATE FIX TOTAL NILAI---*/

UPDATE master_jual_produk,
       vu_trans_produk
   SET jproduk_totalbiaya =
          (  vu_trans_produk.total_nilai
           - jproduk_cashback
           - jproduk_diskon * vu_trans_produk.total_nilai / 100)
 WHERE master_jual_produk.jproduk_nobukti = vu_trans_produk.no_bukti;

UPDATE master_jual_rawat,
       vu_trans_rawat
   SET jrawat_totalbiaya =
          (  vu_trans_rawat.total_nilai
           - jrawat_cashback
           - jrawat_diskon * vu_trans_rawat.total_nilai / 100)
 WHERE master_jual_rawat.jrawat_nobukti = vu_trans_rawat.no_bukti;

UPDATE master_jual_paket,
       vu_trans_paket
   SET jpaket_totalbiaya =
          (  vu_trans_paket.total_nilai
           - jpaket_cashback
           - jpaket_diskon * vu_trans_paket.total_nilai / 100)
 WHERE master_jual_paket.jpaket_nobukti = vu_trans_paket.no_bukti;


UPDATE master_lunas_piutang,
       master_jual_produk
   SET lpiutang_total = (jproduk_totalbiaya - jproduk_bayar),
       lpiutang_jenis_transaksi = 'jual_produk'
 WHERE lpiutang_faktur = jproduk_nobukti;

UPDATE master_lunas_piutang,
       master_jual_rawat
   SET lpiutang_total = (jrawat_totalbiaya - jrawat_bayar),
       lpiutang_jenis_transaksi = 'jual_rawat'
 WHERE lpiutang_faktur = jrawat_nobukti;

UPDATE master_lunas_piutang,
       master_jual_paket
   SET lpiutang_total = (jpaket_totalbiaya - jpaket_bayar),
       lpiutang_jenis_transaksi = 'jual_paket'
 WHERE lpiutang_faktur = jpaket_nobukti;


/*--- DELETE TRASH PIUTANG ---*/

DELETE FROM master_lunas_piutang
 WHERE lpiutang_total <= 0;

/*---- INSERT FIX PIUTANG ------*/

INSERT INTO master_lunas_piutang(lpiutang_faktur,
                                 lpiutang_cust,
                                 lpiutang_faktur_tanggal,
                                 lpiutang_total,
                                 lpiutang_jenis_transaksi,
                                 lpiutang_stat_dok)
   SELECT jproduk_nobukti,
          jproduk_cust,
          jproduk_tanggal,
          (jproduk_totalbiaya - jproduk_bayar),
          'jual_produk',
          jproduk_stat_dok
     FROM master_jual_produk
    WHERE jproduk_nobukti NOT IN
             (SELECT A.lpiutang_faktur
                FROM master_lunas_piutang A
               WHERE A.lpiutang_jenis_transaksi = 'jual_produk')
          AND (jproduk_totalbiaya - jproduk_bayar) > 0;


INSERT INTO master_lunas_piutang(lpiutang_faktur,
                                 lpiutang_cust,
                                 lpiutang_faktur_tanggal,
                                 lpiutang_total,
                                 lpiutang_jenis_transaksi,
                                 lpiutang_stat_dok)
   SELECT jrawat_nobukti,
          jrawat_cust,
          jrawat_tanggal,
          (jrawat_totalbiaya - jrawat_bayar),
          'jual_rawat',
          jrawat_stat_dok
     FROM master_jual_rawat
    WHERE jrawat_nobukti NOT IN
             (SELECT A.lpiutang_faktur
                FROM master_lunas_piutang A
               WHERE A.lpiutang_jenis_transaksi = 'jual_rawat')
          AND (jrawat_totalbiaya - jrawat_bayar) > 0;


INSERT INTO master_lunas_piutang(lpiutang_faktur,
                                 lpiutang_cust,
                                 lpiutang_faktur_tanggal,
                                 lpiutang_total,
                                 lpiutang_jenis_transaksi,
                                 lpiutang_stat_dok)
   SELECT jpaket_nobukti,
          jpaket_cust,
          jpaket_tanggal,
          (jpaket_totalbiaya - jpaket_bayar),
          'jual_paket',
          jpaket_stat_dok
     FROM master_jual_paket
    WHERE jpaket_nobukti NOT IN
             (SELECT A.lpiutang_faktur
                FROM master_lunas_piutang A
               WHERE A.lpiutang_jenis_transaksi = 'jual_paket')
          AND (jpaket_totalbiaya - jpaket_bayar) > 0;