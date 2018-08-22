SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `storyproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `storyproject`;

CREATE TABLE IF NOT EXISTS `searchresults` (
  `id` bigint(20) unsigned NOT NULL,
  `searched term` varchar(255) NOT NULL,
  `video id` varchar(128) NOT NULL,
  `resulthash` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for storing returned video ids related to searched results';

CREATE TABLE IF NOT EXISTS `video details` (
  `video id` varchar(128) NOT NULL,
  `video title` varchar(255) DEFAULT NULL,
  `channel id` varchar(128) NOT NULL,
  `channel title` varchar(255) DEFAULT NULL,
  `description` text,
  `published date` datetime(6) NOT NULL,
  `thumbnail url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for Storing Video details';


ALTER TABLE `searchresults`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_id` (`video id`),
  ADD UNIQUE KEY `result hash` (`resulthash`),
  ADD KEY `searched term` (`searched term`);

ALTER TABLE `video details`
  ADD PRIMARY KEY (`video id`);


ALTER TABLE `searchresults`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
