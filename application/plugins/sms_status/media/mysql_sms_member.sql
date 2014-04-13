-- --------------------------------------------------------

--
-- Table structure for table `plugin_sms_status`
--

CREATE TABLE IF NOT EXISTS `plugin_sms_status` (
  `id` int(10) NOT NULL auto_increment,
  `status` varchar(50) NOT NULL default '0',
  `tgltrouble` datetime default NULL,
  `kdgardu` varchar(50) default NULL,
  `tegangan` varchar(50) default NULL,
  `tgltrip` datetime default NULL,
  `arus` varchar(50) default NULL,
  `trouble` varchar(50) default NULL,
  `action` varchar(50) default NULL,
  `ket` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;