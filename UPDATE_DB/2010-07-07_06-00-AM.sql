DELETE FROM jual_card
 WHERE jual_card.jcard_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND jcard_transaksi = 'jual_produk';
       
DELETE FROM jual_card
 WHERE jual_card.jcard_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND jcard_transaksi = 'jual_rawat';
       
DELETE FROM jual_card
 WHERE jual_card.jcard_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND jcard_transaksi = 'jual_paket';

DELETE FROM jual_card
 WHERE jual_card.jcard_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND jcard_transaksi = 'jual_kwitansi';

DELETE FROM jual_card
 WHERE jcard_transaksi IS NULL;   


DELETE FROM jual_cek
 WHERE jual_cek.jcek_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND jcek_transaksi = 'jual_produk';
       
DELETE FROM jual_cek
 WHERE jual_cek.jcek_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND jcek_transaksi = 'jual_rawat';
       
DELETE FROM jual_cek
 WHERE jual_cek.jcek_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND jcek_transaksi = 'jual_paket';

DELETE FROM jual_cek
 WHERE jual_cek.jcek_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND jcek_transaksi = 'jual_kwitansi';

DELETE FROM jual_cek
 WHERE jcek_transaksi IS NULL;  


DELETE FROM jual_kredit
 WHERE jual_kredit.jkredit_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND jkredit_transaksi = 'jual_produk';
       
DELETE FROM jual_kredit
 WHERE jual_kredit.jkredit_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND jkredit_transaksi = 'jual_rawat';
       
DELETE FROM jual_kredit
 WHERE jual_kredit.jkredit_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND jkredit_transaksi = 'jual_paket';

DELETE FROM jual_kredit
 WHERE jual_kredit.jkredit_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND jkredit_transaksi = 'jual_kwitansi';

DELETE FROM jual_kredit
 WHERE jkredit_transaksi IS NULL;    


DELETE FROM jual_kwitansi
 WHERE jual_kwitansi.jkwitansi_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND jkwitansi_transaksi = 'jual_produk';
       
DELETE FROM jual_kwitansi
 WHERE jual_kwitansi.jkwitansi_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND jkwitansi_transaksi = 'jual_rawat';
       
DELETE FROM jual_kwitansi
 WHERE jual_kwitansi.jkwitansi_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND jkwitansi_transaksi = 'jual_paket';

DELETE FROM jual_kwitansi
 WHERE jual_kwitansi.jkwitansi_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND jkwitansi_transaksi = 'jual_kwitansi';

DELETE FROM jual_kwitansi
 WHERE jkwitansi_transaksi IS NULL;   


DELETE FROM jual_transfer
 WHERE jual_transfer.jtransfer_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND jtransfer_transaksi = 'jual_produk';
       
DELETE FROM jual_transfer
 WHERE jual_transfer.jtransfer_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND jtransfer_transaksi = 'jual_rawat';
       
DELETE FROM jual_transfer
 WHERE jual_transfer.jtransfer_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND jtransfer_transaksi = 'jual_paket';

DELETE FROM jual_transfer
 WHERE jual_transfer.jtransfer_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND jtransfer_transaksi = 'jual_kwitansi';

DELETE FROM jual_transfer
 WHERE jtransfer_transaksi IS NULL;  


DELETE FROM jual_tunai
 WHERE jual_tunai.jtunai_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND jtunai_transaksi = 'jual_produk';
       
DELETE FROM jual_tunai
 WHERE jual_tunai.jtunai_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND jtunai_transaksi = 'jual_rawat';
       
DELETE FROM jual_tunai
 WHERE jual_tunai.jtunai_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND jtunai_transaksi = 'jual_paket';

DELETE FROM jual_tunai
 WHERE jual_tunai.jtunai_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND jtunai_transaksi = 'jual_kwitansi';

DELETE FROM jual_tunai
 WHERE jtunai_transaksi IS NULL;



DELETE FROM voucher_terima
 WHERE voucher_terima.tvoucher_ref NOT IN
          (SELECT jproduk_nobukti FROM master_jual_produk)
       AND tvoucher_transaksi = 'jual_produk';
       
DELETE FROM voucher_terima
 WHERE voucher_terima.tvoucher_ref NOT IN
          (SELECT jrawat_nobukti FROM master_jual_rawat)
       AND tvoucher_transaksi = 'jual_rawat';
       
DELETE FROM voucher_terima
 WHERE voucher_terima.tvoucher_ref NOT IN
          (SELECT jpaket_nobukti FROM master_jual_paket)
       AND tvoucher_transaksi = 'jual_paket';

DELETE FROM voucher_terima
 WHERE voucher_terima.tvoucher_ref NOT IN
          (SELECT kwitansi_no FROM cetak_kwitansi)
       AND tvoucher_transaksi = 'jual_kwitansi';

DELETE FROM voucher_terima
 WHERE tvoucher_transaksi IS NULL;