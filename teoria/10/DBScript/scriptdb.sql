-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `ainet_teoria`;
CREATE DATABASE `ainet_teoria` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ainet_teoria`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `age`) VALUES
(1,	'John Doe',	43),
(2,	'Mary Jane', 29),
(3,	'Edgar Smith', 20),
(4,	'Charles Miles', 54),
(5,	'Bea Anderson',	25),
(6,	'Peter Johnson', 53),
(7,	'Sophie Marie',	20),
(8,	'Diane Rose', 32),
(9,	'Sophie Marie',	20),
(10, 'Richard Gomes', 43),
(11, 'James Clinton', 65),
(12, 'Sophie Crampbel', 19),
(13, 'Mark Zuke', 18),
(14, 'Tatian Dominguez', 78),
(15, 'Frederik Kristoyvsk', 63),
(16, 'Beatrice Zuke', 45),
(17, 'Peter Jason', 39),
(18, 'Josephine Rmmstein', 47),
(19, 'Anne Triton', 52),
(20, 'John Gomez', 51),
(21, 'Lionel Richard', 47),
(22, 'Charles Gaullez', 19);

-- 2018-03-18 18:10:32
