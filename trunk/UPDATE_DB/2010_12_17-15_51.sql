ALTER TABLE `customer`  CHANGE COLUMN `cust_profesitemp` `cust_profesitemp` VARCHAR(255) NULL DEFAULT NULL AFTER `cust_revised`,  CHANGE COLUMN `cust_hobitemp` `cust_hobitemp` VARCHAR(255) NULL DEFAULT NULL AFTER `cust_profesitemp`;

update customer set cust_profesitemp = cust_profesi, cust_hobitemp = cust_hobi;

ALTER TABLE `customer`  CHANGE COLUMN `cust_profesi` `cust_profesi` ENUM('Pelajar / Mahasiswa', 'Ibu Rumah Tangga', 'Karyawan atau Swasta', 'Wiraswasta', 'Profesional', 'Selebritis', 'Lain-lain') NULL DEFAULT NULL AFTER `cust_revised`;

ALTER TABLE `customer` change COLUMN `cust_hobi` `cust_hobi` ENUM('Membaca', 'Olahraga', 'Memasak', 'Travelling', 'Fotografi', 'Melukis', 'Menari', 'Lain-lain') NULL DEFAULT NULL AFTER `cust_profesitemp`;
