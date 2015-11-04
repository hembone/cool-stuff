-- CREATE DATABASE  IF NOT EXISTS `fcb_tools_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
-- USE `fcb_tools_db`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: localhost    Database: fcb_tools_db
-- ------------------------------------------------------
-- Server version	5.5.38

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
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `css` blob,
  `html` blob,
  `updated_on` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `search` (`category_id`,`client_id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `global_css`
--

DROP TABLE IF EXISTS `global_css`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_css` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `css` blob,
  `updated_on` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `global_css`
--

LOCK TABLES `global_css` WRITE;
/*!40000 ALTER TABLE `global_css` DISABLE KEYS */;
INSERT INTO `global_css` VALUES (1,'Default Global CSS','/* RESET STYLES */\r\n#outlook a {padding:0;} /* Force Outlook to provide a \"view in browser\" menu link. */\r\na.outlook {color:#ffffff !important; text-decoration:underline !important;}\r\nbody{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;} \r\nh1, h2, h3, h4, h5, h6 {color: black !important;}\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {color: red !important;}\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {color: purple !important;}\r\n.ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  \r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}\r\n#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}\r\nimg {display:block; border:none; outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} \r\na img {border:none; outline:none;} \r\n.image_fix {display:block;}\r\np {margin: 1em 0;}\r\ntable td {border-collapse: collapse;}\r\ntable { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }\r\na.white{color:#ffffff !important;text-decoration:underline !important;}\r\na.whiteButton{color:#ffffff !important;text-decoration:none !important;}\r\na.blue{color:#0000ff !important;text-decoration:underline !important;}\r\na.lBlue{text-decoration:none !important;color:#057bb8 !important;}\r\n\r\n/* IMAGE CLASSES */\r\n.showHide {display:block;}\r\n.imgtwohundred {width:200px !important; height:auto;}\r\n.imgFiftyPercent {width:300px !important; height:150px;}\r\n.serviceImg {width:50px !important; height:auto; float:right}\r\n/*column lines*/\r\n*[class].lineHide{width:1px !important;display:block;}\r\n\r\n/* MAIN CLASSES */\r\n*[class].deviceWidth {width:600px !important; max-width:600px !important;}\r\n*[class].thirty {width:180px !important; max-width:180px !important;}\r\n*[class].thirtyThree {width:199px !important; max-width:199px !important;}\r\n*[class].almostThirtyThree {width:180px !important; max-width:180px !important;}\r\n*[class].fourtyFive {width:250px !important; max-width:250px !important;} \r\n*[class].almostFourtyFive {width:230px !important; max-width:230px !important;} \r\n*[class].fifty {width:300px !important; max-width:300px !important;}\r\n*[class].fiftyShrink {width:300px !important; max-width:300px !important;}\r\n*[class].almostFifty {width:280px !important; max-width:280px !important;}\r\n*[class].halfAlmostFifty {width:140px !important; max-width:140px !important;}\r\n*[class].fiftyFive {width:350px !important; max-width:350px !important;} \r\n*[class].almostFiftyFive {width:330px !important; max-width:330px !important;} \r\n*[class].halfAlmostFiftyFive {width:165px !important; max-width:165px !important;}\r\n*[class].sixtySix {width:400px !important; max-width:400px !important;}\r\n*[class].seventy {width:420px !important; max-width:420px !important;}\r\n*[class].footerFiftyFive {width:350px !important; max-width:350px !important;} \r\n*[class].footerFourtyFive {width:250px !important; max-width:250px !important;} \r\n*[class].legal {width:550px !important; max-width:550px !important;}\r\n*[class].square {height:300px !important;max-height:300px !important;}\r\n*[class].pricePoint{font-size:64px;}\r\n		\r\n@media only screen and (max-width: 598px) {\r\n	*[class].deviceWidth {width:480px !important; max-width:480px !important;}\r\n	*[class].thirty {width:144px !important; max-width:144px !important;}\r\n	*[class].thirtyThree {width:480px !important; max-width:480px !important; display:block;}\r\n	*[class].almostThirtyThree {width:320px !important; max-width:320px !important;	}\r\n	*[class].fourtyFive {width:216px !important; max-width:216px !important;} \r\n	*[class].almostFourtyFive {width:200px !important; max-width:200px !important;} \r\n	*[class].fifty {width:240px !important; max-width:240px !important;}\r\n	*[class].fiftyShrink {width:240px !important; max-width:240px !important;}\r\n	*[class].almostFifty {width:220px !important; max-width:220px !important;}\r\n	*[class].halfAlmostFifty {width:110px !important; max-width:110px !important;}\r\n	*[class].fiftyFive {width:264px !important; max-width:264px !important;} \r\n	*[class].almostFiftyFive {width:244px !important; max-width:244px !important;} \r\n	*[class].halfAlmostFiftyFive {width:122px !important; max-width:122px !important;}\r\n	*[class].sixtySix {width:320px !important; max-width:320px !important;}\r\n	*[class].seventy {width:336px !important; max-width:336px !important;}\r\n	*[class].footerFiftyFive {width:480px !important; max-width:480px !important; display:block;} \r\n	*[class].footerFourtyFive {width:480px !important; max-width:480px !important; display:block;}\r\n	*[class].legal {width:450px !important; max-width:450px !important;}\r\n	*[class].square {height:240px !important;max-height:240px !important;}\r\n	*[class].pricePoint{font-size:48px !important;}\r\n\r\n	/* SCALING HERO CTA */\r\n	*[class].hero-cta {\r\n		width: 200px !important;\r\n		max-width: 200px !important;\r\n		height: auto !important;\r\n	}\r\n	*[class].lineHide{display:none !important;}\r\n}\r\n\r\n@media only screen and (max-width: 470px) {\r\n	*[class].deviceWidth {width:320px !important; max-width:320px !important;}\r\n	*[class].thirty {width:320px !important; max-width:320px !important; display:block;}\r\n	*[class].thirtyThree {width:320px !important; max-width:320px !important; display:block;}\r\n	*[class].almostThirtyThree {width:300px !important; max-width:300px !important;}\r\n	*[class].fortyFive {width:320px !important; max-width:320px !important; display:block;} \r\n	*[class].almostFortyFive {width:300px !important; max-width:300px !important;} \r\n	*[class].fifty {width:320px !important; max-width:320px !important; display:block;}\r\n	*[class].fiftyShrink {width:160px !important; max-width:160px !important;display:block;}\r\n	*[class].almostFifty {width:300px !important; max-width:300px !important;display:block;}\r\n	*[class].halfAlmostFifty {width:150px !important; max-width:150px !important;}\r\n	*[class].fiftyFive {width:320px !important; max-width:320px !important; display:block;} \r\n	*[class].almostFiftyFive {width:300px !important; max-width:300px !important;display:block;} \r\n	*[class].halfAlmostFiftyFive {width:150px !important; max-width:150px !important;}\r\n	*[class].sixtySix {width:320px !important; max-width:320px !important; display:block;}\r\n	*[class].seventy {width:320px !important; max-width:320px !important; display:block;}\r\n	*[class].footerFiftyFive {width:320px !important; max-width:320px !important; display:block;} \r\n	*[class].footerFourtyFive {width:320px !important; max-width:320px !important; display:block;} \r\n	*[class].legal {width:300px !important; max-width:300px !important; display:block;}\r\n	*[class].square {height:320px !important;max-height:320px !important;}\r\n\r\n	/* SCALING HEADER */\r\n	*[class].imgtwohundred {width:160px !important; height:auto;}\r\n	*[class].textHeader {font-size:14px !important; padding-bottom: 14px !important; height:auto;}\r\n	*[class].rowHeader {display:none !important;}\r\n\r\n	/* SCALING HERO CTA */\r\n	*[class].hero-cta {\r\n		width: 100% !important;\r\n		max-width: 212px !important;\r\n		height: auto !important;\r\n	}\r\n	*[class].lineHide{display:none !important;}\r\n}\r\n','2015-11-04 13:59:38','2015-11-04 13:59:38');
/*!40000 ALTER TABLE `global_css` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'status','live');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookieId` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resetId` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resetExpire` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cookie_id_UNIQUE` (`cookieId`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `resetId_UNIQUE` (`resetId`),
  KEY `phone_idx` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-04 16:16:32
