UPDATE  jual_card A, 
        master_jual_produk B
SET A.jcard_stat_dok=B.jproduk_stat_dok
WHERE A.jcard_ref=B.jproduk_nobukti;

UPDATE  jual_cek A, 
        master_jual_produk B
SET A.jcek_stat_dok=B.jproduk_stat_dok
WHERE A.jcek_ref=B.jproduk_nobukti;

UPDATE  jual_kredit A, 
        master_jual_produk B
SET A.jkredit_stat_dok=B.jproduk_stat_dok
WHERE A.jkredit_ref=B.jproduk_nobukti;

UPDATE  jual_kwitansi A, 
        master_jual_produk B
SET A.jkwitansi_stat_dok=B.jproduk_stat_dok
WHERE A.jkwitansi_ref=B.jproduk_nobukti;

UPDATE  jual_transfer A, 
        master_jual_produk B
SET A.jtransfer_stat_dok=B.jproduk_stat_dok
WHERE A.jtransfer_ref=B.jproduk_nobukti;

UPDATE  jual_tunai A, 
        master_jual_produk B
SET A.jtunai_stat_dok=B.jproduk_stat_dok
WHERE A.jtunai_ref=B.jproduk_nobukti;

UPDATE  jual_card A, 
        master_jual_rawat B
SET A.jcard_stat_dok=B.jrawat_stat_dok
WHERE A.jcard_ref=B.jrawat_nobukti;

UPDATE  jual_cek A, 
        master_jual_rawat B
SET A.jcek_stat_dok=B.jrawat_stat_dok
WHERE A.jcek_ref=B.jrawat_nobukti;

UPDATE  jual_kredit A, 
        master_jual_rawat B
SET A.jkredit_stat_dok=B.jrawat_stat_dok
WHERE A.jkredit_ref=B.jrawat_nobukti;

UPDATE  jual_kwitansi A, 
        master_jual_rawat B
SET A.jkwitansi_stat_dok=B.jrawat_stat_dok
WHERE A.jkwitansi_ref=B.jrawat_nobukti;

UPDATE  jual_transfer A, 
        master_jual_rawat B
SET A.jtransfer_stat_dok=B.jrawat_stat_dok
WHERE A.jtransfer_ref=B.jrawat_nobukti;

UPDATE  jual_tunai A, 
        master_jual_rawat B
SET A.jtunai_stat_dok=B.jrawat_stat_dok
WHERE A.jtunai_ref=B.jrawat_nobukti;


UPDATE  jual_card A, 
        master_jual_paket B
SET A.jcard_stat_dok=B.jpaket_stat_dok
WHERE A.jcard_ref=B.jpaket_nobukti;

UPDATE  jual_cek A, 
        master_jual_paket B
SET A.jcek_stat_dok=B.jpaket_stat_dok
WHERE A.jcek_ref=B.jpaket_nobukti;

UPDATE  jual_kredit A, 
        master_jual_paket B
SET A.jkredit_stat_dok=B.jpaket_stat_dok
WHERE A.jkredit_ref=B.jpaket_nobukti;

UPDATE  jual_kwitansi A, 
        master_jual_paket B
SET A.jkwitansi_stat_dok=B.jpaket_stat_dok
WHERE A.jkwitansi_ref=B.jpaket_nobukti;

UPDATE  jual_transfer A, 
        master_jual_paket B
SET A.jtransfer_stat_dok=B.jpaket_stat_dok
WHERE A.jtransfer_ref=B.jpaket_nobukti;

UPDATE  jual_tunai A, 
        master_jual_paket B
SET A.jtunai_stat_dok=B.jpaket_stat_dok
WHERE A.jtunai_ref=B.jpaket_nobukti;

UPDATE  jual_card A, 
        cetak_kwitansi B
SET A.jcard_stat_dok=B.kwitansi_status
WHERE A.jcard_ref=B.kwitansi_no;

UPDATE  jual_cek A, 
        cetak_kwitansi B
SET A.jcek_stat_dok=B.kwitansi_status
WHERE A.jcek_ref=B.kwitansi_no;

UPDATE  jual_kredit A, 
        cetak_kwitansi B
SET A.jkredit_stat_dok=B.kwitansi_status
WHERE A.jkredit_ref=B.kwitansi_no;

UPDATE  jual_kwitansi A, 
        cetak_kwitansi B
SET A.jkwitansi_stat_dok=B.kwitansi_status
WHERE A.jkwitansi_ref=B.kwitansi_no;

UPDATE  jual_transfer A, 
        cetak_kwitansi B
SET A.jtransfer_stat_dok=B.kwitansi_status
WHERE A.jtransfer_ref=B.kwitansi_no;