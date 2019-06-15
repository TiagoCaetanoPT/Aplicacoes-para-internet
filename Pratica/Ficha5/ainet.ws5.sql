-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `ainet_p5`;
CREATE DATABASE `ainet_p5` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ainet_p5`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` tinyint(4) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `remember_token` (`remember_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `registered_at`, `type`) VALUES
(1, 'Ainet Administrator',  'ainet@ipleiria.pt', '$2y$10$fN7/pMMVuN7dQ0HOGH.3R.OxqW9E08ranx5UqP9c4z5RtsevQsOU6', '2015-04-17 22:41:46',  0);

-- 2015-04-18 00:17:35
