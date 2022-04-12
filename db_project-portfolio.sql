-- Adminer 4.7.9 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `table_projects`;
CREATE TABLE `table_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2022-04-12 19:59:56

