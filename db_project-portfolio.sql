-- Adminer 4.7.9 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

-- DROP TABLE IF EXISTS `table_projects`;
-- DROP TABLE IF EXISTS `table_tags`;
-- DROP TABLE IF EXISTS `intermediary_tags-to-projects`;
-- DROP TABLE IF EXISTS `table_users`;
-- DROP TABLE IF EXISTS `table_contacts`;

CREATE TABLE `table_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_thumbnail` varchar(255) NOT NULL,
  `project_status` int(11) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `table_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `intermediary_tags-to-projects` (
  `tag-to-project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`tag-to-project_id`),
  KEY `project_id` (`project_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `intermediary_tags-to-projects_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `table_projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `intermediary_tags-to-projects_ibfk_4` FOREIGN KEY (`tag_id`) REFERENCES `table_tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `user_token` varchar(255) NOT NULL,
  `user_timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_username` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_subject` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `contact_message` text NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2022-05-05 09:48:34