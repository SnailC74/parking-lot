-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: park-lot
-- ------------------------------------------------------
-- Server version	5.6.50

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (2,'test');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;

--
-- Table structure for table `parklot`
--

DROP TABLE IF EXISTS `parklot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parklot` (
  `parklot_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` decimal(16,13) DEFAULT NULL,
  `latitude` decimal(16,13) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `park_num` int(11) DEFAULT NULL,
  `usage_begin` time DEFAULT NULL,
  `usage_end` time DEFAULT NULL,
  `weekday_usable` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`parklot_id`),
  KEY `parklot_area_area_id_fk` (`area_id`),
  CONSTRAINT `parklot_area_area_id_fk` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parklot`
--

/*!40000 ALTER TABLE `parklot` DISABLE KEYS */;
INSERT INTO `parklot` VALUES (1,'test',0.0000000000000,0.0000000000000,2,5,'09:00:00','21:00:00',''),(2,'test',0.0000000000000,0.0000000000000,2,10,'09:00:00','22:00:00',''),(3,'tets location',89.0900000000000,-0.9999999999999,2,10,'08:00:00','21:00:00',''),(4,'text',-82.4297005970410,34.2857527174938,2,12,'09:00:00','14:00:00','');
/*!40000 ALTER TABLE `parklot` ENABLE KEYS */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(4) DEFAULT '0' COMMENT '0 for normal user, 1 for admin user',
  `default_num` int(11) DEFAULT '0',
  `is_active` tinyint(4) DEFAULT '1' COMMENT '0 for disabled, 1 for active',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b','12345678',1,0,1),(2,'test','7c4a8d09ca3762af61e59520943dc26494f8941b','12345678',0,0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

--
-- Table structure for table `user_parklot`
--

DROP TABLE IF EXISTS `user_parklot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_parklot` (
  `user_parklot_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `parklot_id` int(11) DEFAULT NULL,
  `usage_begin` datetime DEFAULT NULL,
  `usage_end` datetime DEFAULT NULL,
  `is_promise` tinyint(4) DEFAULT '1' COMMENT '0 for break the contract, 1 for keep promise ',
  PRIMARY KEY (`user_parklot_id`),
  KEY `user_parklot_parklot_parklot_id_fk` (`parklot_id`),
  KEY `user_parklot_user_user_id_fk` (`user_id`),
  CONSTRAINT `user_parklot_parklot_parklot_id_fk` FOREIGN KEY (`parklot_id`) REFERENCES `parklot` (`parklot_id`),
  CONSTRAINT `user_parklot_user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_parklot`
--

/*!40000 ALTER TABLE `user_parklot` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_parklot` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-19 22:01:47
