-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2018-09-20 23:16:14
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
  `eventID` int(15) UNSIGNED NOT NULL,
  `interestID` bigint(20) NOT NULL,
  `eventLable` enum('all','music','concert','theatre','sports','family','art') NOT NULL,
  `eventCity` enum('all','stockholm','beijing','chicago','london','paris','singapore') NOT NULL,
  `eventName` varchar(50) NOT NULL,
  `eventSpot` varchar(50) NOT NULL,
  `eventPrice` int(5) UNSIGNED NOT NULL,
  `eventDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `interest`
--

CREATE TABLE `interest` (
  `interestID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) NOT NULL,
  `listDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转储表的索引
--

--
-- 表的索引 `event`
--
ALTER TABLE `event`
  ADD KEY `eventID` (`eventID`);

--
-- 表的索引 `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`interestID`);

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
  MODIFY `eventID` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `interest`
--
ALTER TABLE `interest`
  MODIFY `interestID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
