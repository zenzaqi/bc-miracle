CREATE OR REPLACE VIEW vu_trans_terima_jual
AS
   SELECT `jual_tunai`.`jtunai_transaksi` AS `jenis_transaksi`,
          `jual_tunai`.`jtunai_date_create` AS `tanggal`,
          jtunai_ref AS no_ref,
          `jual_tunai`.`jtunai_nilai` AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_tunai`.`jtunai_stat_dok` AS `stat_dok`
     FROM `jual_tunai`
   UNION
   SELECT `jual_card`.`jcard_transaksi` AS `jenis_transaksi`,
          `jual_card`.`jcard_date_create` AS `tanggal`,
          jcard_ref AS no_ref,
          0 AS `nilai_tunai`,
          `jual_card`.`jcard_nilai` AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_card`.`jcard_stat_dok` AS `stat_dok`
     FROM `jual_card`
   UNION
   SELECT `jual_cek`.`jcek_transaksi` AS `jenis_transaksi`,
          `jual_cek`.`jcek_date_create` AS `tanggal`,
          jcek_ref AS no_ref,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          `jual_cek`.`jcek_nilai` AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_cek`.`jcek_stat_dok` AS `stat_dok`
     FROM `jual_cek`
   UNION
   SELECT `jual_transfer`.`jtransfer_transaksi`
             AS `jenis_transaksi`,
          `jual_transfer`.`jtransfer_date_create` AS `tanggal`,
          jtransfer_ref AS no_ref,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          `jual_transfer`.`jtransfer_nilai` AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_transfer`.`jtransfer_stat_dok` AS `stat_dok`
     FROM `jual_transfer`
   UNION
   SELECT `jual_kwitansi`.`jkwitansi_transaksi`
             AS `jenis_transaksi`,
          `jual_kwitansi`.`jkwitansi_date_create` AS `tanggal`,
          jkwitansi_ref AS no_ref,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          `jual_kwitansi`.`jkwitansi_nilai` AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `jual_kwitansi`.`jkwitansi_stat_dok` AS `stat_dok`
     FROM `jual_kwitansi`
   UNION
   SELECT `voucher_terima`.`tvoucher_transaksi`
             AS `jenis_transaksi`,
          `voucher_terima`.`tvoucher_date_create` AS `tanggal`,
          tvoucher_ref AS no_ref,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          `voucher_terima`.`tvoucher_nilai` AS `nilai_voucher`,
          0 AS `nilai_kredit`,
          `voucher_terima`.`tvoucher_stat_dok` AS `stat_dok`
     FROM `voucher_terima`
   UNION
   SELECT `jual_kredit`.`jkredit_transaksi` AS `jenis_transaksi`,
          `jual_kredit`.`jkredit_date_create` AS `tanggal`,
          jkredit_ref AS no_ref,
          0 AS `nilai_tunai`,
          0 AS `nilai_card`,
          0 AS `nilai_cek`,
          0 AS `nilai_transfer`,
          0 AS `nilai_kwitansi`,
          0 AS `nilai_voucher`,
          `jual_kredit`.`jkredit_nilai` AS `nilai_kredit`,
          `jual_kredit`.`jkredit_stat_dok` AS `stat_dok`
     FROM `jual_kredit`