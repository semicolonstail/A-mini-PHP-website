-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2018-11-06 23:20:35
-- 服务器版本： 10.1.35-MariaDB
-- PHP 版本： 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `eventinterested`
--

-- --------------------------------------------------------

--
-- 表的结构 `event`
--

CREATE TABLE `event` (
  `eventID` bigint(20) UNSIGNED NOT NULL,
  `eventLable` enum('all','music','concert','theatre','sports','family','art') NOT NULL,
  `eventCityID` int(11) NOT NULL,
  `eventName` varchar(50) NOT NULL,
  `eventSpot` varchar(50) NOT NULL,
  `eventPrice` int(5) UNSIGNED NOT NULL,
  `eventDate` datetime NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `event`
--

INSERT INTO `event` (`eventID`, `eventLable`, `eventCityID`, `eventName`, `eventSpot`, `eventPrice`, `eventDate`, `available`) VALUES
(1, 'music', 1, 'The Real Group Concert', 'Stadium', 1299, '2018-09-30 16:20:00', 0),
(2, 'concert', 3, 'Cats', 'Mercedes-Benz Arena ', 2399, '2018-10-24 19:15:00', 0),
(3, 'sports', 2, 'HV71', 'Elima', 568, '2018-09-15 14:12:00', 0),
(4, 'theatre', 4, 'Gone with the Wind', 'National Theatre', 2399, '2018-09-30 09:30:00', 0),
(5, 'family', 6, 'Disneyland', 'Disneyland', 689, '2018-11-08 19:20:00', 0),
(6, 'art', 5, 'Cycling Museum', 'National Museum', 399, '2019-04-15 08:12:00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `eventcity`
--

CREATE TABLE `eventcity` (
  `eventCityID` bigint(20) UNSIGNED NOT NULL,
  `eventCityName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `eventcity`
--

INSERT INTO `eventcity` (`eventCityID`, `eventCityName`) VALUES
(1, 'Stockholm'),
(2, 'Jonkoping'),
(3, 'London'),
(4, 'Chicago'),
(5, 'Copenhagen'),
(6, 'Paris');

-- --------------------------------------------------------

--
-- 表的结构 `event_holder`
--

CREATE TABLE `event_holder` (
  `eventID` int(11) NOT NULL,
  `holderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `event_holder`
--

INSERT INTO `event_holder` (`eventID`, `holderID`) VALUES
(1, 3),
(2, 2),
(3, 1),
(4, 2),
(5, 1),
(6, 3);

-- --------------------------------------------------------

--
-- 表的结构 `gallery`
--

CREATE TABLE `gallery` (
  `imageID` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `gallery`
--

INSERT INTO `gallery` (`imageID`, `image_name`) VALUES
(8, 'images/èµ„æº 2.png'),
(9, 'images/èµ„æº 4.png'),
(10, 'images/èµ„æº 15.png');

-- --------------------------------------------------------

--
-- 表的结构 `holder`
--

CREATE TABLE `holder` (
  `holderID` bigint(20) UNSIGNED NOT NULL,
  `holderName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `holder`
--

INSERT INTO `holder` (`holderID`, `holderName`) VALUES
(1, 'Big Borther Company'),
(2, 'Broke Girls Company'),
(3, 'Alibaba Company');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `userID` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `phone`, `address`, `password`) VALUES
(1, 'Green', 'Patrick', 'patrick@wufazhuce.com', '0723889851', 'Huskvarna 89', 'd29b8e4187db2d0fbedcafead6451550'),
(2, 'Smith', 'Dylan', 'dylan@wufazhuce.com', '0724679874', 'Viktoriavagen 66', '1f2345b10d17dbba1393b35e736123a4'),
(3, 'Williams', 'Cynthia', 'cynthia@wufazhuce.com', '0723849764', 'Ortavagen 37', '9c0e823ddd68e31db73fa7cfcd22ea7a'),
(4, 'Taylor', 'Beatrice', 'beatrice@wufazhuce.com', '0729685851', 'Ullortsbacken 77', '1430c78d4257930c64db88a9ad9f55b9'),
(5, 'Davies', 'Felix', 'felix@wufazhuce.com', '0725826493', 'Odengatan 65', '4ef20f41185da26fa5e55bbc6428bd18');

--
-- 转储表的索引
--

--
-- 表的索引 `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `eventCityID` (`eventCityID`);

--
-- 表的索引 `eventcity`
--
ALTER TABLE `eventcity`
  ADD PRIMARY KEY (`eventCityID`);

--
-- 表的索引 `event_holder`
--
ALTER TABLE `event_holder`
  ADD KEY `eventID` (`eventID`,`holderID`);

--
-- 表的索引 `gallery`
--
ALTER TABLE `gallery`
  ADD UNIQUE KEY `imageID` (`imageID`);

--
-- 表的索引 `holder`
--
ALTER TABLE `holder`
  ADD PRIMARY KEY (`holderID`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `event`
--
ALTER TABLE `event`
  MODIFY `eventID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `eventcity`
--
ALTER TABLE `eventcity`
  MODIFY `eventCityID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `gallery`
--
ALTER TABLE `gallery`
  MODIFY `imageID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `holder`
--
ALTER TABLE `holder`
  MODIFY `holderID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
