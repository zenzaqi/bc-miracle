CREATE TABLE `trial_balance` (
  `akun_id` int(11) DEFAULT NULL,
  `akun_kode` varchar(50) DEFAULT NULL,
  `akun_nama` varchar(250) DEFAULT NULL,
  `akun_jenis` varchar(6) DEFAULT NULL,
  `akun_saldo` varchar(6) DEFAULT NULL,
  `akun_debet` double DEFAULT NULL,
  `akun_kredit` double DEFAULT NULL,
  `akun_awal` double DEFAULT NULL,
  `akun_awal_jenis` varchar(6) DEFAULT NULL,
  `akun_akhir` double DEFAULT NULL,
  `akun_akhir_jenis` varchar(6) DEFAULT NULL,
  `akun_periode_awal` date DEFAULT NULL,
  `akun_periode_akhir` date DEFAULT NULL,
  `akun_generate_date` date DEFAULT NULL,
  KEY `tb_index_1` (`akun_id`),
  KEY `tb_index_2` (`akun_kode`),
  KEY `tb_index_3` (`akun_periode_awal`,`akun_periode_akhir`)
);