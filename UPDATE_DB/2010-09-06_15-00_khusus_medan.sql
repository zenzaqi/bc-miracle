/*perbaikan utk PK/1007-0111, seharusnya milik Mrs. Murni / Wen Mei (tercetak di faktur), tetapi di db menjadi milik Mrs. Jolyn Chua*/

update master_jual_paket m
set m.jpaket_cust = 90
where m.jpaket_cust = 87;

update detail_ambil_paket d
set  d.dapaket_cust = 90
where d.dapaket_cust = 87
