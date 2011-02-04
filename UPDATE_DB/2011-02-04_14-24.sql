/*untuk menyisipkan '0' pada kode paket yg masih 2digit agar menjadi 3digit*/

update paket set paket_kode = insert(paket_kode,3,0,'0') where (char_length(paket_kode) = 4);

/*merapikan kode paket yang ada - nya*/
update paket set paket_kode = insert(paket_kode,3,1,'') where (substring(paket_kode,3,1) = '-') ;