/*----- FIX DATA KWITANSI TUNAI ----------*/
DELETE FROM jual_tunai
 WHERE jtunai_transaksi = 'jual_kwitansi';

INSERT INTO jual_tunai(jtunai_nilai,
                       jtunai_ref,
                       jtunai_transaksi,
                       jtunai_stat_dok,
                       jtunai_date_create)
   SELECT kwitansi_nilai,
          kwitansi_no,
          'jual_kwitansi',
          kwitansi_status,
          kwitansi_tanggal
     FROM cetak_kwitansi
    WHERE kwitansi_cara = 'tunai';

DELETE FROM jual_card
 WHERE jcard_transaksi = 'jual_kwitansi';

/*----- FIX DATA KWITANSI CARD ----------*/
INSERT INTO jual_card(jcard_nilai,
                      jcard_ref,
                      jcard_transaksi,
                      jcard_stat_dok,
                      jcard_date_create)
   SELECT kwitansi_nilai,
          kwitansi_no,
          'jual_kwitansi',
          kwitansi_status,
          kwitansi_tanggal
     FROM cetak_kwitansi
    WHERE kwitansi_cara = 'card';

DELETE FROM jual_cek
 WHERE jcek_transaksi = 'jual_kwitansi';

/*----- FIX DATA KWITANSI CEK ----------*/
INSERT INTO jual_cek(jcek_nilai,
                     jcek_ref,
                     jcek_transaksi,
                     jcek_stat_dok,
                     jcek_date_create)
   SELECT kwitansi_nilai,
          kwitansi_no,
          'jual_kwitansi',
          kwitansi_status,
          kwitansi_tanggal
     FROM cetak_kwitansi
    WHERE kwitansi_cara = 'cek/giro';

DELETE FROM jual_transfer
 WHERE jtransfer_transaksi = 'jual_kwitansi';

/*----- FIX DATA KWITANSI TRANSFER ----------*/
INSERT INTO jual_transfer(jtransfer_nilai,
                          jtransfer_ref,
                          jtransfer_transaksi,
                          jtransfer_stat_dok,
                          jtransfer_date_create)
   SELECT kwitansi_nilai,
          kwitansi_no,
          'jual_kwitansi',
          kwitansi_status,
          kwitansi_tanggal
     FROM cetak_kwitansi
    WHERE kwitansi_cara = 'transfer';