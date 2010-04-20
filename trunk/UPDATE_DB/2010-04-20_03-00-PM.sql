
DROP TABLE IF EXISTS draft;

CREATE TABLE IF NOT EXISTS `draft` (
  `draft_id` int(11) NOT NULL auto_increment,
  `draft_jenis` varchar(20) default NULL,
  `draft_destination` varchar(500) default NULL,
  `draft_message` blob,
  `draft_date` datetime default NULL,
  `draft_creator` varchar(50) default NULL,
  `draft_date_create` datetime default NULL,
  `draft_update` varchar(50) default NULL,
  `draft_date_update` datetime default NULL,
  `draft_revised` int(11) default NULL,
  PRIMARY KEY  (`draft_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inbox`
--

DROP TABLE IF EXISTS inbox;

CREATE TABLE IF NOT EXISTS `inbox` (
  `inbox_id` bigint(20) NOT NULL auto_increment,
  `inbox_sender` varchar(25) default NULL,
  `inbox_message` blob,
  `inbox_date` datetime default NULL,
  `inbox_creator` varchar(50) default NULL,
  `inbox_date_create` datetime default NULL,
  `inbox_update` varchar(50) default NULL,
  `inbox_date_update` datetime default NULL,
  `inbox_revised` int(11) default '0',
  PRIMARY KEY  (`inbox_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `outbox`
--

DROP TABLE IF EXISTS outbox;

CREATE TABLE IF NOT EXISTS `outbox` (
  `outbox_id` bigint(20) NOT NULL auto_increment,
  `outbox_destination` varchar(50) default NULL,
  `outbox_message` varchar(1000) default NULL,
  `outbox_date` datetime default NULL,
  `outbox_status` enum('unsent','sent') default 'unsent',
  `outbox_creator` varchar(50) default NULL,
  `outbox_date_create` datetime default NULL,
  `outbox_update` varchar(50) default NULL,
  `outbox_date_update` datetime default NULL,
  `outbox_revised` int(11) default NULL,
  PRIMARY KEY  (`outbox_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72419 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `phonegroup`
--

DROP TABLE IF EXISTS phonegroup;

CREATE TABLE IF NOT EXISTS `phonegroup` (
  `phonegroup_id` int(11) NOT NULL auto_increment,
  `phonegroup_nama` varchar(250) default NULL,
  `phonegroup_detail` varchar(500) default NULL,
  `phonegroup_creator` varchar(50) default NULL,
  `phonegroup_date_create` datetime default NULL,
  `phonegroup_update` varchar(50) default NULL,
  `phonegroup_date_update` datetime default NULL,
  `phonegroup_revised` int(11) default NULL,
  PRIMARY KEY  (`phonegroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `phonegrouped`
--

DROP TABLE IF EXISTS phonegrouped;

CREATE TABLE IF NOT EXISTS `phonegrouped` (
  `phonegrouped_group` int(11) NOT NULL,
  `phonegrouped_number` varchar(50) NOT NULL,
  PRIMARY KEY  (`phonegrouped_group`,`phonegrouped_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
