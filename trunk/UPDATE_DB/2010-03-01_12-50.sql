-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2010 at 12:22 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: 'miracledb'
--

-- --------------------------------------------------------

--
-- Table structure for table 'detail_retur_jual_produk'
--

DROP TABLE detail_retur_jual_produk;

CREATE TABLE IF NOT EXISTS detail_retur_jual_produk (
  drproduk_id int(11) NOT NULL auto_increment,
  drproduk_master int(11) NOT NULL,
  drproduk_produk int(11) NOT NULL,
  drproduk_satuan int(11) default NULL,
  drproduk_jumlah int(11) default NULL,
  drproduk_harga double default NULL,
  drproduk_diskon int(11) default NULL,
  drproduk_diskon_jenis varchar(255) default NULL,
  PRIMARY KEY  (drproduk_id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table 'detail_retur_jual_produk'
--


-- --------------------------------------------------------

--
-- Stand-in structure for view 'vu_detail_jual_paket'
--
CREATE TABLE IF NOT EXISTS `vu_detail_jual_paket` (
`dpaket_master` int(11)
,`dpaket_paket` int(11)
,`produk_nama` varchar(250)
,`kategori2_nama` varchar(250)
,`jumlah_barang` int(11)
,`harga_satuan` float
,`dpaket_diskon` int(11)
,`diskon_jenis` varchar(10)
,`sales` varchar(50)
,`no_bukti` varchar(30)
,`jpaket_cust` int(11)
,`cust_member` varchar(50)
,`cust_nama` varchar(50)
,`cust_no` varchar(50)
,`cust_kelamin` enum('L','P')
,`cust_alamat` varchar(250)
,`cust_kota` varchar(100)
,`produk_kode` varchar(20)
,`satuan_nama` varchar(5)
,`diskon` int(11)
,`diskon_nilai` double
,`subtotal` double
,`tanggal` date
);
-- --------------------------------------------------------


CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_detail_jual_paket AS select miracledb.detail_jual_paket.dpaket_master AS dpaket_master,miracledb.detail_jual_paket.dpaket_paket AS dpaket_paket,vu_paket.paket_nama AS produk_nama,vu_paket.kategori2_nama AS kategori2_nama,miracledb.detail_jual_paket.dpaket_jumlah AS jumlah_barang,miracledb.detail_jual_paket.dpaket_harga AS harga_satuan,miracledb.detail_jual_paket.dpaket_diskon AS dpaket_diskon,miracledb.detail_jual_paket.dpaket_diskon_jenis AS diskon_jenis,miracledb.detail_jual_paket.dpaket_sales AS sales,miracledb.master_jual_paket.jpaket_nobukti AS no_bukti,miracledb.master_jual_paket.jpaket_cust AS jpaket_cust,miracledb.customer.cust_member AS cust_member,miracledb.customer.cust_nama AS cust_nama,miracledb.customer.cust_no AS cust_no,miracledb.customer.cust_kelamin AS cust_kelamin,miracledb.customer.cust_alamat AS cust_alamat,miracledb.customer.cust_kota AS cust_kota,vu_paket.paket_kode AS produk_kode,_utf8'paket' AS satuan_nama,miracledb.detail_jual_paket.dpaket_diskon AS diskon,(((miracledb.detail_jual_paket.dpaket_harga * miracledb.detail_jual_paket.dpaket_jumlah) * miracledb.detail_jual_paket.dpaket_diskon) / 100) AS diskon_nilai,((miracledb.detail_jual_paket.dpaket_harga * miracledb.detail_jual_paket.dpaket_jumlah) - (((miracledb.detail_jual_paket.dpaket_harga * miracledb.detail_jual_paket.dpaket_jumlah) * miracledb.detail_jual_paket.dpaket_diskon) / 100)) AS subtotal,miracledb.master_jual_paket.jpaket_tanggal AS tanggal from (((miracledb.detail_jual_paket join miracledb.vu_paket on((vu_paket.paket_id = miracledb.detail_jual_paket.dpaket_paket))) join miracledb.master_jual_paket on((miracledb.detail_jual_paket.dpaket_master = miracledb.master_jual_paket.jpaket_id))) join miracledb.customer on((miracledb.master_jual_paket.jpaket_cust = miracledb.customer.cust_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_detail_jual_produk'
--

CREATE OR REPLACE  ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_detail_jual_produk AS select miracledb.detail_jual_produk.dproduk_id AS dproduk_id,miracledb.detail_jual_produk.dproduk_produk AS dproduk_produk,miracledb.detail_jual_produk.dproduk_satuan AS dproduk_satuan,miracledb.detail_jual_produk.dproduk_jumlah AS jumlah_barang,miracledb.detail_jual_produk.dproduk_harga AS harga_satuan,miracledb.detail_jual_produk.dproduk_diskon AS diskon,miracledb.detail_jual_produk.dproduk_diskon_jenis AS diskon_jenis,miracledb.detail_jual_produk.dproduk_sales AS sales,miracledb.master_jual_produk.jproduk_nobukti AS no_bukti,miracledb.master_jual_produk.jproduk_tanggal AS tanggal,miracledb.customer.cust_id AS cust_id,miracledb.customer.cust_no AS cust_no,miracledb.customer.cust_member AS cust_member,miracledb.customer.cust_nama AS cust_nama,miracledb.customer.cust_kelamin AS cust_kelamin,miracledb.customer.cust_alamat AS cust_alamat,miracledb.customer.cust_kota AS cust_kota,vu_produk.produk_kode AS produk_kode,vu_produk.produk_kategori AS produk_kategori,vu_produk.produk_kontribusi AS produk_kontribusi,vu_produk.produk_nama AS produk_nama,vu_produk.produk_satuan AS produk_satuan,vu_produk.produk_du AS produk_du,vu_produk.produk_dm AS produk_dm,vu_produk.produk_point AS produk_point,vu_produk.produk_harga AS produk_harga,vu_produk.produk_volume AS produk_volume,vu_produk.produk_jenis AS produk_jenis,miracledb.satuan.satuan_nama AS satuan_nama,(((miracledb.detail_jual_produk.dproduk_harga * miracledb.detail_jual_produk.dproduk_diskon) / 100) * miracledb.detail_jual_produk.dproduk_jumlah) AS diskon_nilai,((miracledb.detail_jual_produk.dproduk_harga * miracledb.detail_jual_produk.dproduk_jumlah) - (((miracledb.detail_jual_produk.dproduk_harga * miracledb.detail_jual_produk.dproduk_diskon) / 100) * miracledb.detail_jual_produk.dproduk_jumlah)) AS subtotal,miracledb.master_jual_produk.jproduk_id AS jproduk_id from ((((miracledb.detail_jual_produk join miracledb.master_jual_produk on((miracledb.detail_jual_produk.dproduk_master = miracledb.master_jual_produk.jproduk_id))) join miracledb.customer on((miracledb.master_jual_produk.jproduk_cust = miracledb.customer.cust_id))) join miracledb.vu_produk on((vu_produk.produk_id = miracledb.detail_jual_produk.dproduk_id))) join miracledb.satuan on((miracledb.detail_jual_produk.dproduk_satuan = miracledb.satuan.satuan_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_detail_jual_rawat'
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_detail_jual_rawat AS select miracledb.detail_jual_rawat.drawat_master AS drawat_master,miracledb.detail_jual_rawat.drawat_rawat AS drawat_rawat,vu_perawatan.rawat_nama AS produk_nama,vu_perawatan.kategori2_nama AS kategori2_nama,vu_perawatan.kategori_nama AS kategori_nama,vu_perawatan.jenis_nama AS jenis_nama,miracledb.detail_jual_rawat.drawat_jumlah AS jumlah_barang,miracledb.detail_jual_rawat.drawat_harga AS harga_satuan,miracledb.detail_jual_rawat.drawat_diskon AS drawat_diskon,miracledb.detail_jual_rawat.drawat_diskon_jenis AS diskon_jenis,miracledb.detail_jual_rawat.drawat_sales AS sales,miracledb.master_jual_rawat.jrawat_nobukti AS no_bukti,miracledb.master_jual_rawat.jrawat_cust AS jrawat_cust,miracledb.customer.cust_member AS cust_member,miracledb.customer.cust_nama AS cust_nama,miracledb.customer.cust_no AS cust_no,miracledb.customer.cust_kelamin AS cust_kelamin,miracledb.customer.cust_alamat AS cust_alamat,miracledb.customer.cust_kota AS cust_kota,vu_perawatan.rawat_kode AS produk_kode,_utf8'paket' AS satuan_nama,miracledb.detail_jual_rawat.drawat_diskon AS diskon,(((miracledb.detail_jual_rawat.drawat_harga * miracledb.detail_jual_rawat.drawat_jumlah) * miracledb.detail_jual_rawat.drawat_diskon) / 100) AS diskon_nilai,((miracledb.detail_jual_rawat.drawat_harga * miracledb.detail_jual_rawat.drawat_jumlah) - (((miracledb.detail_jual_rawat.drawat_harga * miracledb.detail_jual_rawat.drawat_jumlah) * miracledb.detail_jual_rawat.drawat_diskon) / 100)) AS subtotal,miracledb.master_jual_rawat.jrawat_tanggal AS tanggal from (((miracledb.detail_jual_rawat join miracledb.vu_perawatan on((vu_perawatan.rawat_id = miracledb.detail_jual_rawat.drawat_rawat))) join miracledb.master_jual_rawat on((miracledb.detail_jual_rawat.drawat_master = miracledb.master_jual_rawat.jrawat_id))) join miracledb.customer on((miracledb.master_jual_rawat.jrawat_cust = miracledb.customer.cust_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_detail_retur_jual_produk'
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_detail_retur_jual_produk AS select miracledb.detail_retur_jual_produk.drproduk_id AS drproduk_id,miracledb.detail_retur_jual_produk.drproduk_master AS drproduk_master,miracledb.detail_retur_jual_produk.drproduk_produk AS drproduk_produk,miracledb.detail_retur_jual_produk.drproduk_satuan AS drproduk_satuan,miracledb.detail_retur_jual_produk.drproduk_jumlah AS drproduk_jumlah,miracledb.detail_retur_jual_produk.drproduk_harga AS drproduk_harga from (miracledb.master_retur_jual_produk join miracledb.detail_retur_jual_produk on((miracledb.detail_retur_jual_produk.drproduk_master = miracledb.master_retur_jual_produk.rproduk_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_paket'
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_paket AS select miracledb.paket.paket_id AS paket_id,miracledb.paket.paket_kode AS paket_kode,miracledb.paket.paket_nama AS paket_nama,miracledb.paket.paket_group AS paket_group,miracledb.paket.paket_kontribusi AS paket_kontribusi,miracledb.paket.paket_kodelama AS paket_kodelama,miracledb.paket.paket_keterangan AS paket_keterangan,miracledb.paket.paket_du AS paket_du,miracledb.paket.paket_dm AS paket_dm,miracledb.paket.paket_point AS paket_point,miracledb.paket.paket_harga AS paket_harga,miracledb.paket.paket_expired AS paket_expired,miracledb.paket.paket_jmlisi AS paket_jmlisi,miracledb.produk_group.group_kode AS group_kode,miracledb.produk_group.group_nama AS group_nama,miracledb.produk_group.group_dupaket AS group_dupaket,miracledb.kategori2.kategori2_nama AS kategori2_nama,miracledb.kategori2.kategori2_jenis AS kategori2_jenis,miracledb.produk_group.group_dmpaket AS group_dmpaket,miracledb.produk_group.group_kelompok AS group_kelompok from ((miracledb.paket join miracledb.produk_group on((miracledb.paket.paket_group = miracledb.produk_group.group_id))) join miracledb.kategori2 on((miracledb.paket.paket_kontribusi = miracledb.kategori2.kategori2_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_perawatan'
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY INVOKER VIEW miracledb.vu_perawatan AS select miracledb.perawatan.rawat_id AS rawat_id,miracledb.perawatan.rawat_kode AS rawat_kode,miracledb.perawatan.rawat_nama AS rawat_nama,miracledb.perawatan.rawat_group AS rawat_group,miracledb.perawatan.rawat_kontribusi AS rawat_kontribusi,miracledb.perawatan.rawat_kategori AS rawat_kategori,miracledb.perawatan.rawat_jenis AS rawat_jenis,miracledb.perawatan.rawat_kodelama AS rawat_kodelama,miracledb.perawatan.rawat_keterangan AS rawat_keterangan,miracledb.perawatan.rawat_du AS rawat_du,miracledb.perawatan.rawat_dm AS rawat_dm,miracledb.perawatan.rawat_point AS rawat_point,miracledb.perawatan.rawat_harga AS rawat_harga,miracledb.perawatan.rawat_gudang AS rawat_gudang,miracledb.perawatan.rawat_aktif AS rawat_aktif,miracledb.perawatan.rawat_creator AS rawat_creator,miracledb.perawatan.rawat_date_create AS rawat_date_create,miracledb.perawatan.rawat_update AS rawat_update,miracledb.perawatan.rawat_date_update AS rawat_date_update,miracledb.perawatan.rawat_revised AS rawat_revised,miracledb.perawatan.rawat_warna AS rawat_warna,miracledb.produk_group.group_id AS group_id,miracledb.produk_group.group_kode AS group_kode,miracledb.produk_group.group_nama AS group_nama,miracledb.produk_group.group_durawat AS group_durawat,miracledb.produk_group.group_dmrawat AS group_dmrawat,miracledb.produk_group.group_kelompok AS group_kelompok,miracledb.kategori2.kategori2_id AS kategori2_id,miracledb.kategori2.kategori2_nama AS kategori2_nama,miracledb.kategori2.kategori2_jenis AS kategori2_jenis,miracledb.kategori2.kategori2_keterangan AS kategori2_keterangan,miracledb.kategori.kategori_id AS kategori_id,miracledb.kategori.kategori_nama AS kategori_nama,miracledb.kategori.kategori_jenis AS kategori_jenis,miracledb.kategori.kategori_akun AS kategori_akun,miracledb.kategori.kategori_keterangan AS kategori_keterangan,miracledb.jenis.jenis_id AS jenis_id,miracledb.jenis.jenis_kode AS jenis_kode,miracledb.jenis.jenis_nama AS jenis_nama,miracledb.jenis.jenis_kelompok AS jenis_kelompok,miracledb.jenis.jenis_keterangan AS jenis_keterangan,miracledb.gudang.gudang_id AS gudang_id,miracledb.gudang.gudang_nama AS gudang_nama,miracledb.gudang.gudang_lokasi AS gudang_lokasi,miracledb.gudang.gudang_keterangan AS gudang_keterangan from (((((miracledb.perawatan left join miracledb.produk_group on((miracledb.perawatan.rawat_group = miracledb.produk_group.group_id))) left join miracledb.kategori2 on((miracledb.perawatan.rawat_kontribusi = miracledb.kategori2.kategori2_id))) left join miracledb.kategori on((miracledb.perawatan.rawat_kategori = miracledb.kategori.kategori_id))) left join miracledb.jenis on((miracledb.perawatan.rawat_jenis = miracledb.jenis.jenis_id))) left join miracledb.gudang on((miracledb.perawatan.rawat_gudang = miracledb.gudang.gudang_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_produk'
--

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY INVOKER VIEW miracledb.vu_produk AS select miracledb.produk.produk_id AS produk_id,miracledb.produk.produk_kode AS produk_kode,miracledb.produk.produk_group AS produk_group,miracledb.produk.produk_kategori AS produk_kategori,miracledb.produk.produk_kontribusi AS produk_kontribusi,miracledb.produk.produk_nama AS produk_nama,miracledb.produk.produk_satuan AS produk_satuan,miracledb.produk.produk_du AS produk_du,miracledb.produk.produk_dm AS produk_dm,miracledb.produk.produk_point AS produk_point,miracledb.produk.produk_harga AS produk_harga,miracledb.produk.produk_volume AS produk_volume,miracledb.produk.produk_jenis AS produk_jenis,miracledb.produk.produk_kodelama AS produk_kodelama,miracledb.produk.produk_keterangan AS produk_keterangan,miracledb.produk.produk_aktif AS produk_aktif,miracledb.produk.produk_creator AS produk_creator,miracledb.produk.produk_date_create AS produk_date_create,miracledb.produk.produk_update AS produk_update,miracledb.produk.produk_date_update AS produk_date_update,miracledb.produk.poduk_revised AS poduk_revised,miracledb.produk_group.group_id AS group_id,miracledb.produk_group.group_kode AS group_kode,miracledb.produk_group.group_nama AS group_nama,miracledb.produk_group.group_duproduk AS group_duproduk,miracledb.produk_group.group_dmproduk AS group_dmproduk,miracledb.produk_group.group_kelompok AS group_kelompok,miracledb.kategori.kategori_id AS kategori_id,miracledb.kategori.kategori_nama AS kategori_nama,miracledb.kategori.kategori_jenis AS kategori_jenis,miracledb.kategori.kategori_akun AS kategori_akun,miracledb.satuan.satuan_id AS satuan_id,miracledb.satuan.satuan_kode AS satuan_kode,miracledb.satuan.satuan_nama AS satuan_nama,miracledb.jenis.jenis_id AS jenis_id,miracledb.jenis.jenis_kode AS jenis_kode,miracledb.jenis.jenis_nama AS jenis_nama,miracledb.jenis.jenis_kelompok AS jenis_kelompok,miracledb.kategori2.kategori2_id AS kategori2_id,miracledb.kategori2.kategori2_nama AS kategori2_nama,miracledb.kategori2.kategori2_jenis AS kategori2_jenis from (((((miracledb.produk left join miracledb.produk_group on((miracledb.produk.produk_group = miracledb.produk_group.group_id))) left join miracledb.kategori on((miracledb.produk_group.group_kelompok = miracledb.kategori.kategori_id))) left join miracledb.satuan on((miracledb.produk.produk_satuan = miracledb.satuan.satuan_id))) left join miracledb.jenis on((miracledb.produk.produk_jenis = miracledb.jenis.jenis_id))) left join miracledb.kategori2 on((miracledb.produk.produk_kontribusi = miracledb.kategori2.kategori2_id)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_total_retur_jual_produk_group'
--

CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_total_retur_jual_produk_group AS select ifnull(sum(miracledb.detail_retur_jual_produk.drproduk_jumlah),0) AS jumlah_barang,ifnull(sum((((miracledb.detail_retur_jual_produk.drproduk_harga * miracledb.detail_retur_jual_produk.drproduk_jumlah) * (100 - miracledb.detail_retur_jual_produk.drproduk_diskon)) / 100)),0) AS total_nilai,miracledb.detail_retur_jual_produk.drproduk_master AS drproduk_master from miracledb.detail_retur_jual_produk group by miracledb.detail_retur_jual_produk.drproduk_master;

-- --------------------------------------------------------

--
-- Structure for view 'vu_trans_paket'
--

CREATE  OR REPLACE  ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_trans_paket AS select miracledb.master_jual_paket.jpaket_nobukti AS no_bukti,miracledb.master_jual_paket.jpaket_cust AS cust_id,miracledb.master_jual_paket.jpaket_tanggal AS tanggal,vu_customer.cust_no AS cust_no,vu_customer.cust_member AS cust_member,vu_customer.cust_nama AS cust_nama,vu_customer.cust_kelamin AS cust_kelamin,vu_customer.cust_alamat AS cust_alamat,vu_customer.cust_kota AS cust_kota,ifnull(vu_total_jual_paket_group.jumlah_barang,0) AS jumlah_barang,ifnull(vu_total_jual_paket_group.total_nilai,0) AS total_nilai,ifnull(miracledb.master_jual_paket.jpaket_diskon,0) AS diskon,ifnull(miracledb.master_jual_paket.jpaket_cashback,0) AS cashback,ifnull(miracledb.jual_kredit.jkredit_nilai,0) AS kredit,ifnull(miracledb.jual_cek.jcek_nilai,0) AS cek,ifnull(miracledb.jual_card.jcard_nilai,0) AS card,ifnull(miracledb.jual_kwitansi.jkwitansi_nilai,0) AS kuintansi,ifnull(miracledb.jual_transfer.jtransfer_nilai,0) AS transfer,ifnull(miracledb.jual_tunai.jtunai_nilai,0) AS tunai from ((((((((miracledb.master_jual_paket left join miracledb.vu_total_jual_paket_group on((vu_total_jual_paket_group.dpaket_master = miracledb.master_jual_paket.jpaket_id))) left join miracledb.vu_customer on((miracledb.master_jual_paket.jpaket_cust = vu_customer.cust_id))) left join miracledb.jual_card on((miracledb.jual_card.jcard_ref = miracledb.master_jual_paket.jpaket_nobukti))) left join miracledb.jual_cek on((miracledb.jual_cek.jcek_ref = miracledb.master_jual_paket.jpaket_nobukti))) left join miracledb.jual_kredit on((miracledb.jual_kredit.jkredit_ref = miracledb.master_jual_paket.jpaket_nobukti))) left join miracledb.jual_kwitansi on((miracledb.jual_kwitansi.jkwitansi_ref = miracledb.master_jual_paket.jpaket_nobukti))) left join miracledb.jual_transfer on((miracledb.jual_transfer.jtransfer_ref = miracledb.master_jual_paket.jpaket_nobukti))) left join miracledb.jual_tunai on((miracledb.jual_tunai.jtunai_ref = miracledb.master_jual_paket.jpaket_nobukti)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_trans_produk'
--

CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_trans_produk AS select miracledb.master_jual_produk.jproduk_nobukti AS no_bukti,miracledb.master_jual_produk.jproduk_cust AS cust_id,miracledb.master_jual_produk.jproduk_tanggal AS tanggal,vu_customer.cust_no AS cust_no,vu_customer.cust_member AS cust_member,vu_customer.cust_nama AS cust_nama,vu_customer.cust_kelamin AS cust_kelamin,vu_customer.cust_alamat AS cust_alamat,vu_customer.cust_kota AS cust_kota,ifnull(vu_total_jual_produk_group.jumlah_barang,0) AS jumlah_barang,ifnull(vu_total_jual_produk_group.total_nilai,0) AS total_nilai,ifnull(miracledb.master_jual_produk.jproduk_diskon,0) AS diskon,ifnull(miracledb.master_jual_produk.jproduk_cashback,0) AS cashback,ifnull(miracledb.jual_kredit.jkredit_nilai,0) AS kredit,ifnull(miracledb.jual_cek.jcek_nilai,0) AS cek,ifnull(miracledb.jual_card.jcard_nilai,0) AS card,ifnull(miracledb.jual_kwitansi.jkwitansi_nilai,0) AS kuintansi,ifnull(miracledb.jual_transfer.jtransfer_nilai,0) AS transfer,ifnull(miracledb.jual_tunai.jtunai_nilai,0) AS tunai from ((((((((miracledb.master_jual_produk left join miracledb.vu_total_jual_produk_group on((vu_total_jual_produk_group.dproduk_master = miracledb.master_jual_produk.jproduk_id))) left join miracledb.vu_customer on((miracledb.master_jual_produk.jproduk_cust = vu_customer.cust_id))) left join miracledb.jual_card on((miracledb.jual_card.jcard_ref = miracledb.master_jual_produk.jproduk_nobukti))) left join miracledb.jual_cek on((miracledb.jual_cek.jcek_ref = miracledb.master_jual_produk.jproduk_nobukti))) left join miracledb.jual_kredit on((miracledb.jual_kredit.jkredit_ref = miracledb.master_jual_produk.jproduk_nobukti))) left join miracledb.jual_kwitansi on((miracledb.jual_kwitansi.jkwitansi_ref = miracledb.master_jual_produk.jproduk_nobukti))) left join miracledb.jual_transfer on((miracledb.jual_transfer.jtransfer_ref = miracledb.master_jual_produk.jproduk_nobukti))) left join miracledb.jual_tunai on((miracledb.jual_tunai.jtunai_ref = miracledb.master_jual_produk.jproduk_nobukti)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_trans_rawat'
--

CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_trans_rawat AS select miracledb.master_jual_rawat.jrawat_nobukti AS no_bukti,miracledb.master_jual_rawat.jrawat_cust AS cust_id,miracledb.master_jual_rawat.jrawat_tanggal AS tanggal,vu_customer.cust_no AS cust_no,vu_customer.cust_member AS cust_member,vu_customer.cust_nama AS cust_nama,vu_customer.cust_kelamin AS cust_kelamin,vu_customer.cust_alamat AS cust_alamat,vu_customer.cust_kota AS cust_kota,ifnull(vu_total_jual_rawat_group.jumlah_barang,0) AS jumlah_barang,ifnull(vu_total_jual_rawat_group.total_nilai,0) AS total_nilai,ifnull(miracledb.master_jual_rawat.jrawat_diskon,0) AS diskon,ifnull(miracledb.master_jual_rawat.jrawat_cashback,0) AS cashback,ifnull(miracledb.jual_kredit.jkredit_nilai,0) AS kredit,ifnull(miracledb.jual_cek.jcek_nilai,0) AS cek,ifnull(miracledb.jual_card.jcard_nilai,0) AS card,ifnull(miracledb.jual_kwitansi.jkwitansi_nilai,0) AS kuintansi,ifnull(miracledb.jual_transfer.jtransfer_nilai,0) AS transfer,ifnull(miracledb.jual_tunai.jtunai_nilai,0) AS tunai from ((((((((miracledb.master_jual_rawat left join miracledb.vu_total_jual_rawat_group on((vu_total_jual_rawat_group.drawat_master = miracledb.master_jual_rawat.jrawat_id))) left join miracledb.vu_customer on((miracledb.master_jual_rawat.jrawat_cust = vu_customer.cust_id))) left join miracledb.jual_card on((miracledb.jual_card.jcard_ref = miracledb.master_jual_rawat.jrawat_nobukti))) left join miracledb.jual_cek on((miracledb.jual_cek.jcek_ref = miracledb.master_jual_rawat.jrawat_nobukti))) left join miracledb.jual_kredit on((miracledb.jual_kredit.jkredit_ref = miracledb.master_jual_rawat.jrawat_nobukti))) left join miracledb.jual_kwitansi on((miracledb.jual_kwitansi.jkwitansi_ref = miracledb.master_jual_rawat.jrawat_nobukti))) left join miracledb.jual_transfer on((miracledb.jual_transfer.jtransfer_ref = miracledb.master_jual_rawat.jrawat_nobukti))) left join miracledb.jual_tunai on((miracledb.jual_tunai.jtunai_ref = miracledb.master_jual_rawat.jrawat_nobukti)));

-- --------------------------------------------------------

--
-- Structure for view 'vu_trans_retur_produk'
--

CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW miracledb.vu_trans_retur_produk AS select miracledb.master_retur_jual_produk.rproduk_nobukti AS no_bukti,miracledb.master_retur_jual_produk.rproduk_cust AS cust_id,miracledb.master_retur_jual_produk.rproduk_tanggal AS tanggal,vu_customer.cust_no AS cust_no,vu_customer.cust_member AS cust_member,vu_customer.cust_nama AS cust_nama,vu_customer.cust_kelamin AS cust_kelamin,vu_customer.cust_alamat AS cust_alamat,vu_customer.cust_kota AS cust_kota,miracledb.master_jual_produk.jproduk_nobukti AS no_bukti_jual,miracledb.master_jual_produk.jproduk_tanggal AS tanggal_jual,ifnull(vu_total_retur_jual_produk_group.jumlah_barang,0) AS jumlah_barang,ifnull(vu_total_retur_jual_produk_group.total_nilai,0) AS total_nilai,ifnull(miracledb.master_retur_jual_produk.rproduk_diskon,0) AS diskon,ifnull(miracledb.master_retur_jual_produk.rproduk_cashback,0) AS cashback from (((miracledb.master_retur_jual_produk left join miracledb.vu_total_retur_jual_produk_group on((vu_total_retur_jual_produk_group.drproduk_master = miracledb.master_retur_jual_produk.rproduk_id))) left join miracledb.vu_customer on((miracledb.master_retur_jual_produk.rproduk_cust = vu_customer.cust_id))) left join miracledb.master_jual_produk on((miracledb.master_retur_jual_produk.rproduk_nobuktijual = miracledb.master_jual_produk.jproduk_id)));
