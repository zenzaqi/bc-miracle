-- table untuk keperluan CRM

CREATE TABLE IF NOT EXISTS `crm_value` (
  `crmvalue_id` int(10) NOT NULL AUTO_INCREMENT,
  `crmvalue_date` datetime DEFAULT NULL,
  `crmvalue_cust` int(10) DEFAULT '0',
  `crmvalue_freqency` float DEFAULT '0',
  `crmvalue_recency` float DEFAULT '0',
  `crmvalue_spending` float DEFAULT '0',
  `crmvalue_highmargin` float DEFAULT '0',
  `crmvalue_referal` float DEFAULT '0',
  `crmvalue_kerewelan` float DEFAULT '0',
  `crmvalue_disiplin` float DEFAULT '0',
  `crmvalue_treatment` float DEFAULT '0',
  PRIMARY KEY (`crmvalue_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
