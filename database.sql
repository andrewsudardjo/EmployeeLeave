-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version       10.11.6-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0
*/;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `leaveapp`
--

DROP TABLE IF EXISTS `leaveapp`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaveapp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `leaveapp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_genera
l_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaveapp`
--

LOCK TABLES `leaveapp` WRITE;

/*!40000 ALTER TABLE `leaveapp` DISABLE KEYS */;
INSERT INTO `leaveapp` VALUES
(8,3,'2024-05-15','2024-05-23','sick','approved'),
(9,3,'2024-05-01','2024-05-16','sick','approved'),
(10,3,'2024-05-01','2024-05-16','sick','approved'),
(11,3,'2024-05-01','2024-05-02','sick','approved'),
(12,3,'2024-05-01','2024-05-08','','approved'),
(13,3,'2024-05-08','2024-05-09','clubbing\r\n','rejected'),
(14,3,'2024-05-08','2024-05-09','clubbing\r\n','approved'),
(15,3,'2024-05-02','2024-05-16','aadadada','rejected'),
(16,3,'2024-05-01','2024-05-23','i dont know','rejected'),
(17,3,'2024-05-02','2024-05-25','clubbing','rejected'),
(18,3,'2024-01-02','2024-07-31','test2','rejected'),
(19,3,'2024-01-02','2024-07-31','test2','rejected'),
(20,3,'2024-01-02','2024-07-31','test2','rejected'),
(21,8,'2024-06-04','2024-06-06','Sick','rejected'),
(22,8,'2024-05-29','2024-05-29','','rejected'),
(23,8,'2024-05-30','2024-06-20','party','approved'),
(24,8,'2024-06-06','2024-06-29','party','approved');
/*!40000 ALTER TABLE `leaveapp` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_genera
l_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'charlie','$2y$10$9dnzrdCvQ5AoHf77o86X6efqWPhfwB9Xpv3AEtONQ8N3am4OJBhcS','adm
in'),
(2,'asu','$2y$10$m9wF5QEPF869NUeRAhrCDupjhTBXo2yzjbZ0gGhs9E.kEELqTECIG','user'),
(3,'test','$2y$10$mikMCncAHiSvAQfMaxHdvObptL0RrrMD7CQyNQVkhuEs6RfAW8vHC','user')
,
(4,'halo','$2y$10$3wPngJFMPAAuQY3c3kHb6ecOO0fwSAsFFrTbKpK6ZoFtj0Fi4Y04a','user')
,
(5,'123','$2y$10$sO0E1c0fPNKYgWWXjM4YoOtDbukcYc41wPrXqt..zdP4qGPsT0sW.','user'),
(6,'bacot','$2y$10$deZBjlkM.moxy0WCyvEzxeVpWQameb2lmbD8.6wM2j9.0jI9.mWyW','user'
),
(7,'aly','$2y$10$McxU8YQ/IP1s.Io7.cEls.Lmu.mhG01AJlyS/ZBjsnz2XcX79Xkkq','admin')
,
(8,'AndrewSudardjo','$2y$10$Fwgo7Gn0V87KynERTMZcruqwnTNdGsjcl2Q0N9fHFzItuAFZvlDn
2','user'),
(9,'test1','$2y$10$vWNquUOEOuEU6x7iSRnwhe/1x0KVwulfL4vhAY1Y6U/PW3fI./F2K','user'
);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-08 20:44:08




