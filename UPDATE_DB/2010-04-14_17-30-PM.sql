# SQL-Front 5.1  (Build 4.16)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: miracledb
# ------------------------------------------------------
# Server version 5.1.33-community

#
# Source for table iklan_today
#

DROP TABLE IF EXISTS `iklan_today`;
CREATE TABLE `iklan_today` (
  `iklantoday_id` int(11) NOT NULL AUTO_INCREMENT,
  `iklantoday_keterangan` varchar(250) NOT NULL,
  `iklantoday_tanggal` date NOT NULL,
  `iklantoday_author` varchar(50) DEFAULT NULL,
  `iklantoday_date_create` datetime DEFAULT NULL,
  `iklantoday_update` varchar(50) DEFAULT NULL,
  `iklantoday_date_update` datetime DEFAULT NULL,
  `iklantoday_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`iklantoday_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Dumping data for table iklan_today
#

LOCK TABLES `iklan_today` WRITE;
/*!40000 ALTER TABLE `iklan_today` DISABLE KEYS */;
INSERT INTO `iklan_today` VALUES (1,'Get TRIPLE POINTS for Laser & Light-based Therapy* Until 30 April 2010','2010-04-14',NULL,NULL,'hendri','2010-04-14 15:38:34',NULL);
/*!40000 ALTER TABLE `iklan_today` ENABLE KEYS */;
UNLOCK TABLES;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
