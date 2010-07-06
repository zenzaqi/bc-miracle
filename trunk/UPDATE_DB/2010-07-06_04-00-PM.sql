UPDATE  jual_card A, 
        master_jual_produk B
SET A.jcard_date_create=B.jproduk_tanggal
WHERE A.jcard_ref=B.jproduk_nobukti;

UPDATE  jual_cek A, 
        master_jual_produk B
SET A.jcek_date_create=B.jproduk_tanggal
WHERE A.jcek_ref=B.jproduk_nobukti;

UPDATE  jual_kredit A, 
        master_jual_produk B
SET A.jkredit_date_create=B.jproduk_tanggal
WHERE A.jkredit_ref=B.jproduk_nobukti;

UPDATE  jual_kwitansi A, 
        master_jual_produk B
SET A.jkwitansi_date_create=B.jproduk_tanggal
WHERE A.jkwitansi_ref=B.jproduk_nobukti;

UPDATE  jual_transfer A, 
        master_jual_produk B
SET A.jtransfer_date_create=B.jproduk_tanggal
WHERE A.jtransfer_ref=B.jproduk_nobukti;

UPDATE  jual_tunai A, 
        master_jual_produk B
SET A.jtunai_date_create=B.jproduk_tanggal
WHERE A.jtunai_ref=B.jproduk_nobukti;

UPDATE  jual_card A, 
        master_jual_rawat B
SET A.jcard_date_create=B.jrawat_tanggal
WHERE A.jcard_ref=B.jrawat_nobukti;

UPDATE  jual_cek A, 
        master_jual_rawat B
SET A.jcek_date_create=B.jrawat_tanggal
WHERE A.jcek_ref=B.jrawat_nobukti;

UPDATE  jual_kredit A, 
        master_jual_rawat B
SET A.jkredit_date_create=B.jrawat_tanggal
WHERE A.jkredit_ref=B.jrawat_nobukti;

UPDATE  jual_kwitansi A, 
        master_jual_rawat B
SET A.jkwitansi_date_create=B.jrawat_tanggal
WHERE A.jkwitansi_ref=B.jrawat_nobukti;

UPDATE  jual_transfer A, 
        master_jual_rawat B
SET A.jtransfer_date_create=B.jrawat_tanggal
WHERE A.jtransfer_ref=B.jrawat_nobukti;

UPDATE  jual_tunai A, 
        master_jual_rawat B
SET A.jtunai_date_create=B.jrawat_tanggal
WHERE A.jtunai_ref=B.jrawat_nobukti;


UPDATE  jual_card A, 
        master_jual_paket B
SET A.jcard_date_create=B.jpaket_tanggal
WHERE A.jcard_ref=B.jpaket_nobukti;

UPDATE  jual_cek A, 
        master_jual_paket B
SET A.jcek_date_create=B.jpaket_tanggal
WHERE A.jcek_ref=B.jpaket_nobukti;

UPDATE  jual_kredit A, 
        master_jual_paket B
SET A.jkredit_date_create=B.jpaket_tanggal
WHERE A.jkredit_ref=B.jpaket_nobukti;

UPDATE  jual_kwitansi A, 
        master_jual_paket B
SET A.jkwitansi_date_create=B.jpaket_tanggal
WHERE A.jkwitansi_ref=B.jpaket_nobukti;

UPDATE  jual_transfer A, 
        master_jual_paket B
SET A.jtransfer_date_create=B.jpaket_tanggal
WHERE A.jtransfer_ref=B.jpaket_nobukti;

UPDATE  jual_tunai A, 
        master_jual_paket B
SET A.jtunai_date_create=B.jpaket_tanggal
WHERE A.jtunai_ref=B.jpaket_nobukti;

UPDATE  jual_card A, 
        cetak_kwitansi B
SET A.jcard_date_create=B.kwitansi_tanggal
WHERE A.jcard_ref=B.kwitansi_no;

UPDATE  jual_cek A, 
        cetak_kwitansi B
SET A.jcek_date_create=B.kwitansi_tanggal
WHERE A.jcek_ref=B.kwitansi_no;

UPDATE  jual_kredit A, 
        cetak_kwitansi B
SET A.jkredit_date_create=B.kwitansi_tanggal
WHERE A.jkredit_ref=B.kwitansi_no;

UPDATE  jual_kwitansi A, 
        cetak_kwitansi B
SET A.jkwitansi_date_create=B.kwitansi_tanggal
WHERE A.jkwitansi_ref=B.kwitansi_no;

UPDATE  jual_transfer A, 
        cetak_kwitansi B
SET A.jtransfer_date_create=B.kwitansi_tanggal
WHERE A.jtransfer_ref=B.kwitansi_no;

UPDATE  jual_tunai A, 
        cetak_kwitansi B
SET A.jtunai_date_create=B.kwitansi_tanggal
WHERE A.jtunai_ref=B.kwitansi_no;


UPDATE  jual_tunai A, 
        master_jual_produk B
SET A.jtunai_transaksi='jual_produk'
WHERE A.jtunai_ref=B.jproduk_nobukti;

UPDATE  jual_tunai A, 
        master_jual_rawat B
SET A.jtunai_transaksi='jual_rawat'
WHERE A.jtunai_ref=B.jrawat_nobukti;

UPDATE  jual_tunai A, 
        master_jual_paket B
SET A.jtunai_transaksi='jual_paket'
WHERE A.jtunai_ref=B.jpaket_nobukti;

UPDATE  jual_tunai A, 
        cetak_kwitansi B
SET A.jtunai_transaksi='jual_kwitansi'
WHERE A.jtunai_ref=B.kwitansi_no;

UPDATE  jual_card A, 
        master_jual_produk B
SET A.jcard_transaksi='jual_produk'
WHERE A.jcard_ref=B.jproduk_nobukti;

UPDATE  jual_card A, 
        master_jual_rawat B
SET A.jcard_transaksi='jual_rawat'
WHERE A.jcard_ref=B.jrawat_nobukti;

UPDATE  jual_card A, 
        master_jual_paket B
SET A.jcard_transaksi='jual_paket'
WHERE A.jcard_ref=B.jpaket_nobukti;

UPDATE  jual_card A, 
        cetak_kwitansi B
SET A.jcard_transaksi='jual_kwitansi'
WHERE A.jcard_ref=B.kwitansi_no;

UPDATE  jual_cek A, 
        master_jual_produk B
SET A.jcek_transaksi='jual_produk'
WHERE A.jcek_ref=B.jproduk_nobukti;

UPDATE  jual_cek A, 
        master_jual_rawat B
SET A.jcek_transaksi='jual_rawat'
WHERE A.jcek_ref=B.jrawat_nobukti;

UPDATE  jual_cek A, 
        master_jual_paket B
SET A.jcek_transaksi='jual_paket'
WHERE A.jcek_ref=B.jpaket_nobukti;

UPDATE  jual_cek A, 
        cetak_kwitansi B
SET A.jcek_transaksi='jual_kwitansi'
WHERE A.jcek_ref=B.kwitansi_no;


UPDATE  jual_transfer A, 
        master_jual_produk B
SET A.jtransfer_transaksi='jual_produk'
WHERE A.jtransfer_ref=B.jproduk_nobukti;

UPDATE  jual_transfer A, 
        master_jual_rawat B
SET A.jtransfer_transaksi='jual_rawat'
WHERE A.jtransfer_ref=B.jrawat_nobukti;

UPDATE  jual_transfer A, 
        master_jual_paket B
SET A.jtransfer_transaksi='jual_paket'
WHERE A.jtransfer_ref=B.jpaket_nobukti;

UPDATE  jual_transfer A, 
        cetak_kwitansi B
SET A.jtransfer_transaksi='jual_kwitansi'
WHERE A.jtransfer_ref=B.kwitansi_no;


UPDATE  jual_kredit A, 
        master_jual_produk B
SET A.jkredit_transaksi='jual_produk'
WHERE A.jkredit_ref=B.jproduk_nobukti;

UPDATE  jual_kredit A, 
        master_jual_rawat B
SET A.jkredit_transaksi='jual_rawat'
WHERE A.jkredit_ref=B.jrawat_nobukti;

UPDATE  jual_kredit A, 
        master_jual_paket B
SET A.jkredit_transaksi='jual_paket'
WHERE A.jkredit_ref=B.jpaket_nobukti;

UPDATE  jual_kredit A, 
        cetak_kwitansi B
SET A.jkredit_transaksi='jual_kwitansi'
WHERE A.jkredit_ref=B.kwitansi_no;




