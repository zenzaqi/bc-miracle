-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2010 at 08:29 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `miracledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `crm_setup`
--

CREATE TABLE IF NOT EXISTS `crm_setup` (
  `setcrm_id` int(11) NOT NULL AUTO_INCREMENT,
  `setcrm_frequency_bulan1` int(11) DEFAULT NULL,
  `setcrm_frequency_bulan2` int(11) DEFAULT NULL,
  `setcrm_frequency_value_morethan` int(11) DEFAULT NULL,
  `setcrm_frequency_value_equal` int(11) DEFAULT NULL,
  `setcrm_frequency_value_lessthan` int(11) DEFAULT NULL,
  `setcrm_recency_bulan` int(11) DEFAULT NULL,
  `setcrm_recency_value_morethan` int(11) DEFAULT NULL,
  `setcrm_recency_value_equal` int(11) DEFAULT NULL,
  `setcrm_recency_value_lessthan` int(11) DEFAULT NULL,
  `setcrm_spending_value_morethan` int(11) DEFAULT NULL,
  `setcrm_spending_value_equal` int(11) DEFAULT NULL,
  `setcrm_spending_value_lessthan` int(11) DEFAULT NULL,
  `setcrm_highmargin_treatment` int(11) DEFAULT NULL,
  `setcrm_highmargin_month` int(11) DEFAULT NULL,
  `setcrm_highmargin_value_morethan` int(11) DEFAULT NULL,
  `setcrm_highmargin_value_equal` int(11) DEFAULT NULL,
  `setcrm_highmargin_value_lessthan` int(11) DEFAULT NULL,
  `setcrm_referal_person` int(11) DEFAULT NULL,
  `setcrm_referal_month` int(11) DEFAULT NULL,
  `setcrm_referal_morethan` int(11) DEFAULT NULL,
  `setcrm_referal_equal` int(11) DEFAULT NULL,
  `setcrm_referal_lessthan` int(11) DEFAULT NULL,
  `setcrm_kerewelan_high` int(11) DEFAULT NULL,
  `setcrm_kerewelan_normal` int(11) DEFAULT NULL,
  `setcrm_kerewelan_low` int(11) DEFAULT NULL,
  `setcrm_disiplin_high` int(11) DEFAULT NULL,
  `setcrm_disiplin_normal` int(11) DEFAULT NULL,
  `setcrm_disiplin_low` int(11) DEFAULT NULL,
  `setcrm_treatment_month` int(11) DEFAULT NULL,
  `setcrm_treatment_nonmedis` int(11) DEFAULT NULL,
  `setcrm_treatment_medis` int(11) DEFAULT NULL,
  `setcrm_treatment_morethan` int(11) DEFAULT NULL,
  `setcrm_treatment_equal` int(11) DEFAULT NULL,
  `setcrm_treatment_lessthan` int(11) DEFAULT NULL,
  `setcrm_author` varchar(50) DEFAULT NULL,
  `setcrm_date_create` datetime NOT NULL,
  `setcrm_update` varchar(50) NOT NULL,
  `setcrm_date_update` datetime NOT NULL,
  `setcrm_revised` int(11) NOT NULL,
  PRIMARY KEY (`setcrm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `crm_setup`
--

