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


CREATE OR REPLACE VIEW `miracledb`.`vu_trans_terima_jual`
AS
   SELECT `miracledb`.`jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,
          `miracledb`.`jual_tunai`.`jtunai_date_create` AS `tanggal`,
          `miracledb`.`jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          jtunai_stat_dok as stat_dok
     FROM `miracledb`.`jual_tunai`
   UNION
   SELECT `miracledb`.`jual_card`.`jcard_transaksi` AS `jenis_transaksi`,
          `miracledb`.`jual_card`.`jcard_date_create` AS `tanggal`,
          0 AS `nilai_tunai`,
          `miracledb`.`jual_card`.`jcard_nilai` AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          jcard_stat_dok as stat_dok
     FROM `miracledb`.`jual_card`
   UNION
   SELECT `miracledb`.`jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,
          `miracledb`.`jual_cek`.`jcek_date_create` AS `tanggal`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          `miracledb`.`jual_cek`.`jcek_nilai` AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          jcek_stat_dok as stat_dok
     FROM `miracledb`.`jual_cek`
   UNION
   SELECT `miracledb`.`jual_transfer`.`jtransfer_transaksi`
             AS `jenis_transaksi`,
          `miracledb`.`jual_transfer`.`jtransfer_date_create` AS `tanggal`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          `miracledb`.`jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          jtransfer_stat_dok as stat_dok
     FROM `miracledb`.`jual_transfer`
   UNION
   SELECT `miracledb`.`jual_kwitansi`.`jkwitansi_transaksi`
             AS `jenis_transaksi`,
          `miracledb`.`jual_kwitansi`.`jkwitansi_date_create` AS `tanggal`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          `miracledb`.`jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          jkwitansi_stat_dok as stat_dok
     FROM `miracledb`.`jual_kwitansi`
   UNION
   SELECT `miracledb`.`voucher_terima`.`tvoucher_transaksi`
             AS `jenis_transaksi`,
          `miracledb`.`voucher_terima`.`tvoucher_date_create` AS `tanggal`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          `miracledb`.`voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          tvoucher_stat_dok as stat_dok
     FROM `miracledb`.`voucher_terima`
   UNION
   SELECT `miracledb`.`jual_kredit`.`jkredit_transaksi` AS `jenis_transaksi`,
          `miracledb`.`jual_kredit`.`jkredit_date_create` AS `tanggal`,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          `miracledb`.`jual_kredit`.`jkredit_nilai` AS `nilai_kredit`,
          jkredit_stat_dok as stat_dok
     FROM `miracledb`.`jual_kredit`;