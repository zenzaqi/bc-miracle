ALTER TABLE `customer`  ADD COLUMN `cust_profesitemp` ENUM('Pelajar / Mahasiswa', 'Ibu Rumah Tangga', 'Karyawan atau Swasta', 'Wiraswasta', 'Profesional', 'Selebritis', 'Lain-lain') NULL DEFAULT NULL AFTER `cust_revised`;

ALTER TABLE `customer`  ADD COLUMN `cust_hobitemp` ENUM('Membaca', 'Olahraga', 'Memasak', 'Travelling', 'Fotografi', 'Melukis', 'Menari', 'Lain-lain') NULL DEFAULT NULL AFTER `cust_profesitemp`;

update customer set cust_profesitemp = cust_profesi, cust_hobitemp = cust_hobi;