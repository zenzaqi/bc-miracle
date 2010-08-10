DELETE FROM jual_card
 WHERE jcard_nilai <= 0;

DELETE FROM jual_cek
 WHERE jcek_nilai <= 0;

DELETE FROM jual_kwitansi
 WHERE jkwitansi_nilai <= 0;

DELETE FROM jual_transfer
 WHERE jtransfer_nilai <= 0;

DELETE FROM jual_tunai
 WHERE jtunai_nilai <= 0;