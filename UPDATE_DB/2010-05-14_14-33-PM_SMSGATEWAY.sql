CREATE DATABASE `smsd` ;

DROP TABLE IF EXISTS `daemons`;
CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `gammu`;
CREATE TABLE `gammu` (
  `Version` integer NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `gammu` (`Version`) VALUES (10);

DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL default '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL default '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL default '',
  `Class` integer NOT NULL default '-1',
  `TextDecoded` varchar(160) NOT NULL default '',
  `ID` integer unsigned NOT NULL auto_increment,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL default 'false',
  PRIMARY KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `outbox`;
CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL default '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL default '0000-00-00 00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL default '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') default '8bit',
  `UDH` text,
  `Class` integer default '-1',
  `TextDecoded` varchar(160) NOT NULL default '',
  `ID` integer unsigned NOT NULL auto_increment,
  `MultiPart` enum('false','true') default 'false',
  `RelativeValidity` integer default '-1',
  `SenderID` varchar(255),
  `SendingTimeOut` timestamp NULL default '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') default 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE INDEX outbox_date ON outbox(SendingDateTime, SendingTimeOut);
CREATE INDEX outbox_sender ON outbox(SenderID);

DROP TABLE IF EXISTS `outbox_multipart`;
CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') default '8bit',
  `UDH` text,
  `Class` integer default '-1',
  `TextDecoded` varchar(160) default NULL,
  `ID` integer unsigned NOT NULL default '0',
  `SequencePosition` integer NOT NULL default '1',
  PRIMARY KEY (`ID`, `SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pbk`;
CREATE TABLE `pbk` (
  `GroupID` integer NOT NULL default '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pbk_groups`;
CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` integer NOT NULL auto_increment,
  PRIMARY KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `phones`;
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

DROP TABLE IF EXISTS `sentitems`;
CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL default '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL default '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL default '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default '8bit',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL default '',
  `Class` integer NOT NULL default '-1',
  `TextDecoded` varchar(160) NOT NULL default '',
  `ID` integer unsigned NOT NULL default '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` integer NOT NULL default '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL default 'SendingOK',
  `StatusError` integer NOT NULL default '-1',
  `TPMR` integer NOT NULL default '-1',
  `RelativeValidity` integer NOT NULL default '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`, `SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE INDEX sentitems_date ON sentitems(DeliveryDateTime);
CREATE INDEX sentitems_tpmr ON sentitems(TPMR);
CREATE INDEX sentitems_dest ON sentitems(DestinationNumber);
CREATE INDEX sentitems_sender ON sentitems(SenderID);

