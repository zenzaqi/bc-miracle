-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2010 at 10:19 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

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
-- Table structure for table `outbox`
--
DROP TABLE outbox;

CREATE TABLE IF NOT EXISTS `outbox` (
  `outbox_id` bigint(20) NOT NULL auto_increment,
  `outbox_destination` varchar(500) default NULL,
  `outbox_message` blob,
  `outbox_date` datetime default NULL,
  `outbox_status` enum('unsent','sent') default 'unsent',
  `outbox_creator` varchar(50) default NULL,
  `outbox_date_create` datetime default NULL,
  `outbox_update` varchar(50) default NULL,
  `outbox_date_update` datetime default NULL,
  `outbox_revised` int(11) default NULL,
  PRIMARY KEY  (`outbox_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phonegrouped`
--
DROP TABLE phonegrouped;

CREATE TABLE IF NOT EXISTS `phonegrouped` (
  `phonegrouped_group` int(11) NOT NULL,
  `phonegrouped_number` varchar(50) NOT NULL,
  PRIMARY KEY  (`phonegrouped_group`,`phonegrouped_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure for view `vu_draft`
--

CREATE VIEW `vu_draft` AS select `draft`.`draft_id` AS `draft_id`,`draft`.`draft_destination` AS `draft_destination`,`draft`.`draft_message` AS `draft_message`,`draft`.`draft_date` AS `draft_date`,`draft`.`draft_creator` AS `draft_creator`,`draft`.`draft_date_create` AS `draft_date_create`,`draft`.`draft_update` AS `draft_update`,`draft`.`draft_date_update` AS `draft_date_update`,`draft`.`draft_revised` AS `draft_revised`,_utf8'Group' AS `draft_jenis`,`phonegroup`.`phonegroup_id` AS `draft_destid`,`phonegroup`.`phonegroup_nama` AS `draft_destnama` from (`draft` join `phonegroup`) where ((`draft`.`draft_destination` regexp _latin1'Group') and (substring_index(`draft`.`draft_destination`,_latin1':',-(1)) = `phonegroup`.`phonegroup_id`)) union select `draft`.`draft_id` AS `draft_id`,`draft`.`draft_destination` AS `draft_destination`,`draft`.`draft_message` AS `draft_message`,`draft`.`draft_date` AS `draft_date`,`draft`.`draft_creator` AS `draft_creator`,`draft`.`draft_date_create` AS `draft_date_create`,`draft`.`draft_update` AS `draft_update`,`draft`.`draft_date_update` AS `draft_date_update`,`draft`.`draft_revised` AS `draft_revised`,_utf8'Number' AS `draft_jenis`,substring_index(`draft`.`draft_destination`,_latin1':',-(1)) AS `draft_destid`,substring_index(`draft`.`draft_destination`,_latin1':',-(1)) AS `draft_destnama` from `draft` where (`draft`.`draft_destination` regexp _latin1'Number');

--
-- VIEW  `vu_draft`
-- Data: None
--

-- Structure for view `vu_phonegroup`
--

CREATE VIEW `vu_phonegroup` AS select count(`phonegrouped`.`phonegrouped_number`) AS `phonegroup_jumlah`,`phonegroup`.`phonegroup_id` AS `phonegroup_id`,`phonegroup`.`phonegroup_nama` AS `phonegroup_nama`,`phonegroup`.`phonegroup_detail` AS `phonegroup_detail` from (`phonegroup` join `phonegrouped`) where (`phonegrouped`.`phonegrouped_group` = `phonegroup`.`phonegroup_id`) group by `phonegroup`.`phonegroup_id`,`phonegroup`.`phonegroup_nama`,`phonegroup`.`phonegroup_detail`;

--
-- VIEW  `vu_phonegroup`
-- Data: None
--
