/* CRREATE TABLE TEMP FOR GENERATE KARTU STOK */
CREATE TABLE `kartu_stok` (
  `tanggal` date NOT NULL,
  `produk_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `no_bukti` varchar(250) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `masuk` double DEFAULT '0',
  `keluar` double DEFAULT '0',
  `gudang_id` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* CREATE TABLE TEMP FOR GENERATE STOK MUTASI */

CREATE TABLE `stok_mutasi` (
  `produk_id` int(11) DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `stok_awal` double DEFAULT '0',
  `stok_masuk` double DEFAULT '0',
  `stok_keluar` double DEFAULT '0',
  `stok_akhir` double DEFAULT '0',
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `gudang_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;