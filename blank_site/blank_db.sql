-- phpMiniAdmin dump 1.9.150108
-- Datetime: 2015-05-11 16:02:46
-- Host: 
-- Database: swarmdev_db

/*!40030 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `settings` VALUES ('1','status','live');

DROP TABLE IF EXISTS `users`;
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
  `emailOptin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smsOptin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fbAuth` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `igToken` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cookie_id_UNIQUE` (`cookieId`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `resetId_UNIQUE` (`resetId`),
  UNIQUE KEY `igToken_UNIQUE` (`igToken`),
  UNIQUE KEY `fbAuth_UNIQUE` (`fbAuth`),
  KEY `phone_idx` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;


-- phpMiniAdmin dump end
