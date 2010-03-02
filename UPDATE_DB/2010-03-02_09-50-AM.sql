-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2010 at 09:49 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_retur_jual_produk`
--
DROP TABLE `master_retur_jual_produk`;

CREATE TABLE IF NOT EXISTS `master_retur_jual_produk` (
  `rproduk_id` int(11) NOT NULL auto_increment,
  `rproduk_nobukti` varchar(100) default NULL,
  `rproduk_nobuktijual` int(100) default NULL,
  `rproduk_cust` int(11) default NULL,
  `rproduk_tanggal` date default NULL,
  `rproduk_keterangan` varchar(250) default NULL,
  `rproduk_diskon` int(11) default NULL,
  `rproduk_cashback` int(11) default NULL,
  `rproduk_creator` varchar(50) default NULL,
  `rproduk_date_create` datetime default NULL,
  `rproduk_update` varchar(50) default NULL,
  `rproduk_date_update` datetime default NULL,
  `rproduk_revised` int(11) default NULL,
  PRIMARY KEY  (`rproduk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `master_retur_jual_produk`
--

INSERT INTO `master_retur_jual_produk` (`rproduk_id`, `rproduk_nobukti`, `rproduk_nobuktijual`, `rproduk_cust`, `rproduk_tanggal`, `rproduk_keterangan`, `rproduk_diskon`, `rproduk_cashback`, `rproduk_creator`, `rproduk_date_create`, `rproduk_update`, `rproduk_date_update`, `rproduk_revised`) VALUES
(3, '15632', 2, 1, '2009-09-03', 'fdsfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
