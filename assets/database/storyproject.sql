CREATE DATABASE IF NOT EXISTS `storyproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `storyproject`;

CREATE TABLE `searchresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `searchedterm` varchar(128) NOT NULL,
  `searchedtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for storing returned video ids related to searched results';

CREATE TABLE `videodetails` (
  `videoid` varchar(128) NOT NULL,
  `videotitle` varchar(255) DEFAULT NULL,
  `channelid` varchar(128) NOT NULL,
  `channeltitle` varchar(255) DEFAULT NULL,
  `description` text,
  `publisheddate` datetime NOT NULL,
  `thumbnailurl` varchar(255) DEFAULT NULL,
  `searchedterm` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table for Storing Video details';


ALTER TABLE `searchresults`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `searchunique` (`searchedterm`),
  ADD KEY `searched term` (`searchedterm`);

ALTER TABLE `videodetails`
  ADD PRIMARY KEY (`videoid`),
  ADD KEY `searchterm` (`searchedterm`);


ALTER TABLE `searchresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;