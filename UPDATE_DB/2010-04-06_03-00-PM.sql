CREATE TABLE IF NOT EXISTS `member_setup` (
  `setmember_id` int(11) NOT NULL auto_increment,
  `setmember_transhari` double NOT NULL,
  `setmember_transbulan` double default NULL,
  `setmember_periodeaktif` int(11) default NULL,
  `setmember_periodetanggang` int(11) default NULL,
  `setmember_transharitenggang` double default NULL,
  `setmember_author` varchar(50) default NULL,
  `setmember_date_create` datetime default NULL,
  `setmember_update` varchar(50) default NULL,
  `setmember_date_update` datetime default NULL,
  `setmember_revised` int(11) default NULL,
  PRIMARY KEY  (`setmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `member_setup`
--

INSERT INTO `member_setup` (`setmember_id`, `setmember_transhari`, `setmember_transbulan`, `setmember_periodeaktif`, `setmember_periodetanggang`, `setmember_transharitenggang`, `setmember_author`, `setmember_date_create`, `setmember_update`, `setmember_date_update`, `setmember_revised`) VALUES
(1, 2000000, 150000000, 360, 90, 500000, NULL, NULL, 'Super Admin', '2010-04-06 15:53:51', NULL);