-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: infinite
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `infinite`
--

/*!40000 DROP DATABASE IF EXISTS `infinite`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `infinite` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `infinite`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `age` int(3) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (14,'spitfire','Sai','Yang','sai.yang@developers.com','M',38,'CLASSIFIED: TOP SECRET','$2y$10$ZmMyYjMyNDlkZmZkMjQwMeyTtv16yh2YoQZe3i7NlwvNWmwQMhI0O'),(15,'austintoddj','Todd','Austin','austin.todd.j@gmail.com','M',27,'Never stop imagining.','$2y$10$NzdlZDNjOTVjOGU0MWUxNOR0EYiT1lCdYRFh9xA0.5Wz2f/cvxKeq'),(16,'admin','Super','User','admin@sandbox.dev','M',0,'The \"root\" account is the most privileged account on a Unix system. This account gives you the ability to carry out all facets of system administration, including adding accounts.','$2y$10$MzljMWQ4NzRjODFjZTUxZeTsavxuOzr3MnDmbS53xHwaYwEdO8c7W'),(17,'arod12','Aaron','Rodgers','a.rodgers@packers.com','M',34,'I attended the University of California at Berkeley, where I was a star player for two years before being drafted by the Green Bay Packers in 2005. In 2011, I led the team to a Superbowl victory.','$2y$10$OGI1YzM0NzgxZWE4NjliM.Fwy6WXOWOr42CcMnnTqZx6LhE6rtXk2'),(19,'bigrigtrailer','Optimus','Prime','optimus.prime@nest.gov','M',897,'Optimus Prime is the awe-inspiring leader of the Autobot forces. Selfless and endlessly courageous, he is the complete opposite of his mortal enemy Megatron. Autobots, rollout!','$2y$10$YzY3ODBkY2Q3MGU3ZTk2YuVPMKdRP5IpiK8VDfV6C//ahYob9/wLW'),(20,'carebear672','Carrie','Underwood','carrie672@gmail.com','F',30,'My victory at the 2005 American Idol competition has been considered the show\'s first upset. Many pundits thought she would be bested by runner-up Bo Bice.','$2y$10$MTI4ZDQwNzBjNTViZWM2MuZ.lZBZ9Oacvp8XPEoCMghrNcYZcFS8q'),(21,'reaperkiller','John','Shepard','john.shepard@alliance.net','M',33,'It\'s hard enough fighting a war. But it\'s worse knowing no matter how hard you try, you can\'t save them all. If I can\'t save them, you can be damn sure I\'ll avenge them.','$2y$10$ZGJmNGNhZGIxZjRmYWUyMu87tGMY9wwPd20hXzRNAU/LaeXuH02ti'),(23,'chalsey','Catherine','Halsey','catherine.halsey@section3.oni','F',49,'My work saved the human race. I served as a scientific adviser for the Office of Naval Intelligence from 2515 to 2522, when I was made chief scientist.','$2y$10$ZjM4YjE5MmIxYTBmMmU2YOI17EdOLPZ4CVS8r0HKLA//9y.fq0cm6'),(24,'kperr13','Katy','Perry','katy.perry@capitolmusicgroup.com','F',30,'Katheryn Elizabeth \"Katy\" Hudson, better known by her stage name Katy Perry, had limited exposure to secular music during her childhood and pursued a career in gospel music as a teenager. ','$2y$10$NDNhYmVhMzU2ZTkxZjBkNO3AbuqDc2.83j.tD0FwUCGVa/9dA4Mwq');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,1,'Our Mission',1,1,'<p>Our company mission has always been...</p>'),(2,1,'Our History',2,1,'Founded in 2014 by one enterprising developer...  More recently...'),(3,2,'Consultation',1,1,'Our websites have to be seen to be believed...'),(4,2,'Collaboration',2,1,'They say that big things come in small packages...'),(5,3,'Apps',1,1,'We love to help other people imagine the impossible...'),(6,3,'Websites',2,1,'We can certify any website, not just our own...'),(7,6,'Commercial',1,1,'These are the big businesses.'),(8,6,'Private',2,1,'These are the small businesses.'),(10,1,'Contact Us',3,1,'<form>\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p>If you have any questions about Infinite, simply fill in the form below and submit it. You\'ll recieve a reply as soon as possible! <strong>For support questions, please use the <a>forums</a>.</strong></p>\r\n<div class=\"form-group\"><label for=\"email\">Email</label> <span class=\"red-star\">*</span> <input id=\"email\" class=\"form-control\" type=\"email\" /></div>\r\n<div class=\"form-group\"><label for=\"exampleInputPassword1\">Subject</label> <span class=\"red-star\">*</span> <input id=\"subject\" class=\"form-control\" type=\"text\" /></div>\r\n<div class=\"form-group\"><label for=\"message\">Message</label> <span class=\"red-star\">*</span> <textarea id=\"message\" class=\"form-control\" name=\"message\" rows=\"5\"></textarea></div>\r\n<button class=\"btn btn-default\" type=\"submit\">Send</button></div>\r\n<div class=\"col-md-6\">SpryMedia is a web-development company based in central Scotland, specialising in data access for the web. At the core of SpryMedia is the DataTables software package and its extensions.<br /><br /> Originally conceived in 2008 DataTables has evolved at the same rapid rate as the rest of the web to become one of the most used table display and manipulation libraries on the web.<br /><br /> Providing powerful, easy to use and delightful to develop with software is what drives SpryMedia as a business and individually.</div>\r\n</div>\r\n</form><hr />\r\n<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7098.94326104394!2d78.0430654485247!3d27.172909818538997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1385710909804\" width=\"100%\" height=\"300\" frameborder=\"0\"></iframe></p>'),(11,6,'Residential',3,1,'<p>These are the residential customers.</p>');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'About Us',1,1),(2,'Our Services',2,1),(3,'Our Products',3,1),(6,'Clients',4,1);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-12 15:36:56
