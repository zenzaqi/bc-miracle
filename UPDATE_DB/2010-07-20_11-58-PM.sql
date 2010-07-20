ALTER TABLE master_lunas_piutang ADD lpiutang_jenis_transaksi varchar(20);
ALTER TABLE master_lunas_piutang ADD lpiutang_stat_dok ENUM('Terbuka','Tertutup','Batal') DEFAULT 'Terbuka';


INSERT INTO master_lunas_piutang(lpiutang_faktur,
                                        lpiutang_cust,
                                        lpiutang_status,
                                        lpiutang_total,
                                        lpiutang_jenis_transaksi,
                                        lpiutang_stat_dok)
   SELECT p.jproduk_nobukti,
          p.jproduk_cust,
          'piutang',
          (p.jproduk_totalbiaya - p.jproduk_bayar),
          'jual_produk',
          jproduk_stat_dok
     FROM master_jual_produk AS p
WHERE p.jproduk_totalbiaya - p.jproduk_bayar>0
AND p.jproduk_nobukti NOT IN(SELECT lpiutang_faktur FROM master_lunas_piutang);

UPDATE master_lunas_piutang,
       master_jual_produk
   SET lpiutang_total = (jproduk_totalbiaya - jproduk_bayar),
       lpiutang_jenis_transaksi = 'jual_produk',
       lpiutang_stat_dok = jproduk_stat_dok,
       lpiutang_faktur_tanggal =
          date_format(jproduk_tanggal, '%Y-%m-%d %H:%i:%s')
 WHERE master_jual_produk.jproduk_nobukti =
          master_lunas_piutang.lpiutang_faktur;




INSERT INTO master_lunas_piutang(lpiutang_faktur,
                                        lpiutang_cust,
                                        lpiutang_status,
                                        lpiutang_total,
                                        lpiutang_jenis_transaksi,
                                        lpiutang_stat_dok)
   SELECT p.jrawat_nobukti,
          p.jrawat_cust,
          'piutang',
          (p.jrawat_totalbiaya - p.jrawat_bayar),
          'jual_rawat',
          jrawat_stat_dok
     FROM master_jual_rawat AS p
WHERE p.jrawat_totalbiaya - p.jrawat_bayar>0
AND p.jrawat_nobukti NOT IN(SELECT lpiutang_faktur FROM master_lunas_piutang);

UPDATE master_lunas_piutang,
       master_jual_rawat
   SET lpiutang_total = (jrawat_totalbiaya - jrawat_bayar),
       lpiutang_jenis_transaksi = 'jual_rawat',
       lpiutang_stat_dok = jrawat_stat_dok,
       lpiutang_faktur_tanggal =
          date_format(jrawat_tanggal, '%Y-%m-%d %H:%i:%s')
 WHERE master_jual_rawat.jrawat_nobukti =
          master_lunas_piutang.lpiutang_faktur;





INSERT INTO master_lunas_piutang(lpiutang_faktur,
                                        lpiutang_cust,
                                        lpiutang_status,
                                        lpiutang_total,
                                        lpiutang_jenis_transaksi,
                                        lpiutang_stat_dok)
   SELECT p.jpaket_nobukti,
          p.jpaket_cust,
          'piutang',
          (p.jpaket_totalbiaya - p.jpaket_bayar),
          'jual_paket',
          jpaket_stat_dok
     FROM master_jual_paket AS p
WHERE p.jpaket_totalbiaya - p.jpaket_bayar>0
AND p.jpaket_nobukti NOT IN(SELECT lpiutang_faktur FROM master_lunas_piutang);

UPDATE master_lunas_piutang,
       master_jual_paket
   SET lpiutang_total = (jpaket_totalbiaya - jpaket_bayar),
       lpiutang_jenis_transaksi = 'jual_paket',
       lpiutang_stat_dok = jpaket_stat_dok,
       lpiutang_faktur_tanggal =
          date_format(jpaket_tanggal, '%Y-%m-%d %H:%i:%s')
 WHERE master_jual_paket.jpaket_nobukti =
          master_lunas_piutang.lpiutang_faktur;


