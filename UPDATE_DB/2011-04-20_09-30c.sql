







-- phpMyAdmin SQL Dump
-- version 2.8.0.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 10, 2006 at 11:08 PM
-- Server version: 5.0.18
-- PHP Version: 5.1.3
-- 
-- Database: `smsd`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `daemons`
-- 
use miracle_sms;
CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `daemons`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `gammu`
-- 

CREATE TABLE `gammu` (
  `Version` integer NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `gammu`
-- 

INSERT INTO `gammu` (`Version`) VALUES (12);

-- --------------------------------------------------------

-- 
-- Table structure for table `inbox`
-- 
DROP TABLE IF EXISTS inbox;
CREATE TABLE `inbox` (
	`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`UpdatedInDB` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`ReceivingDateTime` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`Text` TEXT NOT NULL,
	`SenderNumber` VARCHAR(20) NOT NULL DEFAULT '',
	`Coding` ENUM('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
	`UDH` TEXT NOT NULL,
	`SMSCNumber` VARCHAR(20) NOT NULL DEFAULT '',
	`Class` INT(11) NOT NULL DEFAULT '-1',
	`TextDecoded` TEXT NOT NULL,
	`RecipientID` TEXT NOT NULL,
	`Processed` ENUM('false','true') NOT NULL DEFAULT 'false',
	`inbox_sender` VARCHAR(25) NULL DEFAULT NULL,
	`inbox_message` BLOB NULL,
	`inbox_date` DATETIME NULL DEFAULT NULL,
	`inbox_creator` VARCHAR(50) NULL DEFAULT NULL,
	`inbox_date_create` DATETIME NULL DEFAULT NULL,
	`inbox_update` DATETIME NULL DEFAULT NULL,
	`inbox_date_update` DATETIME NULL DEFAULT NULL,
	`inbox_revised` INT(11) NULL DEFAULT '0',
	`inbox_status` ENUM('Show','Hide','Replied') NULL DEFAULT 'Show',
	PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
ROW_FORMAT=DEFAULT
AUTO_INCREMENT=1;

-- 
-- Dumping data for table `inbox`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `outbox`
-- 
DROP TABLE IF EXISTS outbox;
CREATE TABLE `outbox` (
	`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`UpdatedInDB` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`InsertIntoDB` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`SendingDateTime` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`Text` TEXT NULL,
	`DestinationNumber` VARCHAR(20) NOT NULL DEFAULT '',
	`Coding` ENUM('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
	`UDH` TEXT NULL,
	`Class` INT(11) NULL DEFAULT '-1',
	`TextDecoded` TEXT NOT NULL,
	`MultiPart` ENUM('false','true') NULL DEFAULT 'false',
	`RelativeValidity` INT(11) NULL DEFAULT '-1',
	`SenderID` VARCHAR(255) NULL DEFAULT NULL,
	`SendingTimeOut` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00',
	`DeliveryReport` ENUM('default','yes','no') NULL DEFAULT 'default',
	`CreatorID` TEXT NOT NULL,
	`outbox_cust` INT(11) NULL DEFAULT NULL,
	`outbox_destination` VARCHAR(50) NULL DEFAULT NULL,
	`outbox_message` VARCHAR(1000) NULL DEFAULT NULL,
	`outbox_date` DATETIME NULL DEFAULT NULL,
	`outbox_status` ENUM('unsent','sent','failed') NULL DEFAULT 'unsent',
	`outbox_retry` TINYINT(4) NULL DEFAULT '0',
	`outbox_creator` VARCHAR(50) NULL DEFAULT NULL,
	`outbox_date_create` DATETIME NULL DEFAULT NULL,
	`outbox_update` VARCHAR(50) NULL DEFAULT NULL,
	`outbox_date_update` DATETIME NULL DEFAULT NULL,
	`outbox_revised` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`ID`),
	INDEX `outbox_date` (`SendingDateTime`, `SendingTimeOut`),
	INDEX `outbox_sender` (`SenderID`)
)
ENGINE=MyISAM
ROW_FORMAT=DEFAULT
AUTO_INCREMENT=1;
-- 
-- Dumping data for table `outbox`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `outbox_multipart`
-- 

CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default 'Default_No_Compression',
  `UDH` text,
  `Class` integer default '-1',
  `TextDecoded` text default NULL,
  `ID` integer unsigned NOT NULL default '0',
  `SequencePosition` integer NOT NULL default '1',
  PRIMARY KEY (`ID`, `SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `outbox_multipart`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pbk`
-- 

CREATE TABLE `pbk` (
  `ID` integer NOT NULL auto_increment,
  `GroupID` integer NOT NULL default '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `pbk`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pbk_groups`
-- 

CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` integer NOT NULL auto_increment,
  PRIMARY KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `pbk_groups`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phones`
-- 

CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL default '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL default '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL default 'no',
  `Receive` enum('yes','no') NOT NULL default 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` integer NOT NULL DEFAULT 0,
  `Signal` integer NOT NULL DEFAULT 0,
  `Sent` int NOT NULL DEFAULT 0,
  `Received` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `phones`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sentitems`
-- 
DROP TABLE IF EXISTS sentitems;
CREATE TABLE `sentitems` (
	`ID` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`UpdatedInDB` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`InsertIntoDB` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`SendingDateTime` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`DeliveryDateTime` TIMESTAMP NULL DEFAULT NULL,
	`Text` TEXT NOT NULL,
	`DestinationNumber` VARCHAR(20) NOT NULL DEFAULT '',
	`Coding` ENUM('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
	`UDH` TEXT NOT NULL,
	`SMSCNumber` VARCHAR(20) NOT NULL DEFAULT '',
	`Class` INT(11) NOT NULL DEFAULT '-1',
	`TextDecoded` TEXT NOT NULL,
	`SenderID` VARCHAR(255) NOT NULL,
	`SequencePosition` INT(11) NOT NULL DEFAULT '1',
	`Status` ENUM('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
	`StatusError` INT(11) NOT NULL DEFAULT '-1',
	`TPMR` INT(11) NOT NULL DEFAULT '-1',
	`RelativeValidity` INT(11) NOT NULL DEFAULT '-1',
	`CreatorID` TEXT NOT NULL,
	PRIMARY KEY (`ID`, `SequencePosition`),
	INDEX `sentitems_date` (`DeliveryDateTime`),
	INDEX `sentitems_tpmr` (`TPMR`),
	INDEX `sentitems_dest` (`DestinationNumber`),
	INDEX `sentitems_sender` (`SenderID`)
)
ENGINE=MyISAM
ROW_FORMAT=DEFAULT;

-- 
-- Dumping data for table `sentitems`
-- 


-- 
-- Triggers for setting default timestamps
-- 

DELIMITER //

CREATE TRIGGER inbox_timestamp BEFORE INSERT ON inbox
FOR EACH ROW
BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END;//

CREATE TRIGGER outbox_timestamp BEFORE INSERT ON outbox
FOR EACH ROW
BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END;//

CREATE TRIGGER phones_timestamp BEFORE INSERT ON phones
FOR EACH ROW
BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END;//

CREATE TRIGGER sentitems_timestamp BEFORE INSERT ON sentitems
FOR EACH ROW
BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END;//

DELIMITER ;




