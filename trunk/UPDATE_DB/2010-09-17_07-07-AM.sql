/* mengisi db.detail_ambil_paket.dapaket_tgl_ambil = dapaket_date_create, yang mana kolom db.detail_ambil_paket.dapaket_tgl_ambil ini baru ditambahkan pada file 2010-09-17_06-52-AM.sql */
/* maka selanjutnya antar dapaket_tgl_ambil dan dapaket_date_create BISA BERBEDA */

UPDATE detail_ambil_paket
SET dapaket_tgl_ambil = (date_format(dapaket_date_create,'%Y-%m-%d'));