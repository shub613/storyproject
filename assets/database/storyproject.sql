CREATE DATABASE IF NOT EXISTS `storyproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `storyproject`;

CREATE TABLE `searchresults` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `searchedterm` varchar(255) NOT NULL,
  `videoid` varchar(128) NOT NULL,
  `resulthash` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for storing returned video ids related to searched results';

CREATE TABLE `videodetails` (
  `videoid` varchar(128) NOT NULL,
  `videotitle` varchar(255) DEFAULT NULL,
  `channelid` varchar(128) NOT NULL,
  `channeltitle` varchar(255) DEFAULT NULL,
  `description` text,
  `publisheddate` datetime NOT NULL,
  `thumbnailurl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for Storing Video details';


ALTER TABLE `searchresults`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_id` (`videoid`),
  ADD UNIQUE KEY `result hash` (`resulthash`),
  ADD KEY `searched term` (`searchedterm`);

ALTER TABLE `videodetails`
  ADD PRIMARY KEY (`videoid`);


ALTER TABLE `searchresults`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;