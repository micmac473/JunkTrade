-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 04:06 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peertrading`
--
CREATE DATABASE IF NOT EXISTS `peertrading` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `peertrading`;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE `follow` (
  `followid` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `followee` int(11) NOT NULL,
  `followdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `followindicator` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `itemid` int(11) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `itemdescription` varchar(500) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `picture2` varchar(1000) NOT NULL,
  `picture3` varchar(1000) NOT NULL,
  `uploaddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `itemname`, `itemdescription`, `picture`, `picture2`, `picture3`, `uploaddate`, `userid`, `views`) VALUES
(1, 'House', 'This is my house item', '../img/house.jpg', '', '', '2016-11-26 03:38:21', 1, 2),
(2, 'Peas', 'This is my easy peasy item', '../img/easy.png', '', '', '2016-11-26 03:38:21', 2, 5),
(3, 'Money', 'This is my money item', '../img/nomoney.png', '', '', '2016-11-26 03:38:42', 2, 2),
(4, 'Friends', 'This is my friends item', '../img/buddy.png', '', '', '2016-11-26 03:38:42', 6, 2),
(25, 'Dell XPS', 'Processor: i7 3.5 Ghz Quad Core\r\nRam: 12 GB\r\nGraphics: GeForce GTX 980', '../img/xps.png', '', '', '2016-11-26 15:54:19', 6, 4),
(26, 'Logo', 'This is my logo item', '../img/logo.png', '', '', '2016-11-26 15:55:07', 6, 3),
(27, 'HP Laptop', 'Processor: i5 2.5 Ghz Dual Core\r\nRam: 8 GB\r\nGraphics: Intel ', '../img/hp.jpg', '', '', '2016-11-26 15:57:48', 1, 2),
(29, 'SVG Flag', 'This the flag of St. Vincent and the Grenadines, West Indies', '../img/svgflag.png', '', '', '2016-11-27 15:21:11', 39, 2),
(30, 'Cloud Server', 'Heroku cloud server', '../img/cloudserver.jpg', '', '', '2016-11-27 22:57:00', 40, 6),
(34, 'Hydrangeas', 'Hydrangeas', '../img/Hydrangeas.jpg', '', '', '2016-11-30 13:42:30', 1, 0),
(36, 'Jellyfish', 'Jellyfish', '../img/Jellyfish.jpg', '', '', '2016-11-30 13:45:11', 1, 0),
(38, 'Nike', 'Color: Red and black\r\nSize: 12\r\nCondition: New\r\nComes with box', '../img/airjordans.jpe', '', '', '2016-11-30 19:11:47', 40, 3),
(39, 'Gucci Watch', 'This is real Gucci,\r\nGenuine Leather,\r\nCondition: New,\r\nColor: Black,\r\nWristband: leather,\r\nAge: 60 days,', '../img/gucciwatch.jpe', '', '', '2016-11-30 19:54:55', 40, 10),
(42, 'Piano Keyboard', 'Brand: Yamaha\r\nCondition: Used\r\nComes with everything', '../img/pianokeyboard.jpe', '', '', '2016-12-01 15:10:04', 1, 1),
(44, 'iPhone 6', 'Capacity: 68 GB\r\nRAM: 4 GB\r\nDisplay: Retina\r\nCondition: New', '../img/iphone.jpg', '', '', '2016-12-01 23:40:35', 1, 3),
(45, 'Gucci Belt', 'Genuine Leather,\r\nCondition: New', '../img/guccibelt.jpg', '', '', '2016-12-02 00:36:38', 1, 4),
(46, 'New Era Hat', 'Snapback\r\nColor: Black\r\nSize: 7 1/2', '../img/snapback.jpg', '', '', '2016-12-02 00:38:16', 1, 8),
(47, 'Galaxy Note Edge', 'Color: White,\r\nCondition: Used,\r\nAge: 2 Months,\r\nBrand: Samsung,\r\nComes with stylus, charger and case', '../img/galaxynoteedge.jpg', '', '', '2017-02-28 04:39:04', 41, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `requestercontact` varchar(20) NOT NULL,
  `requestee` int(11) NOT NULL,
  `item` int(10) NOT NULL,
  `decision` tinyint(1) DEFAULT NULL,
  `timerequested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

DROP TABLE IF EXISTS `saved`;
CREATE TABLE `saved` (
  `savedid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `itemowner` int(11) NOT NULL,
  `saveddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `savedindicator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trade`
--

DROP TABLE IF EXISTS `trade`;
CREATE TABLE `trade` (
  `tradeid` int(11) NOT NULL,
  `requestid` int(11) NOT NULL,
  `tradedate` varchar(20) NOT NULL,
  `tradelocation` varchar(100) NOT NULL,
  `suggestedlocation` varchar(100) NOT NULL,
  `locationdecision` tinyint(1) NOT NULL,
  `requestercontact` varchar(20) NOT NULL,
  `requesteecontact` varchar(20) NOT NULL,
  `requesterfeedbackrating` int(11) NOT NULL,
  `requesterfeedbackcomment` varchar(1000) NOT NULL,
  `requesterfeedbackindicator` tinyint(1) NOT NULL DEFAULT '0',
  `requesteefeedbackrating` int(11) NOT NULL,
  `requesteefeedbackcomment` varchar(1000) NOT NULL,
  `requesteefeedbackindicator` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sQuestion` varchar(100) NOT NULL,
  `sAnswer` varchar(100) NOT NULL,
  `profilepicture` varchar(1000) DEFAULT '../img/defaultPP.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `sQuestion`, `sAnswer`, `profilepicture`) VALUES
(1, 'micmcm', 'Mickel', 'McMillan', 'mickelmcmillan@email.com', '6918950f89321712a8641620423d8c7d25951c0c', '', '', NULL),
(2, 'mikmon', 'Mikael', 'Montoute', 'mikaelmontoute@email.com', '16331e4442209ff309047eaec83430646490f038', '', '2d27b62c597ec858f6e7b54e7e58525e6a95e6d8', NULL),
(6, 'jamtart', 'Jamal', 'Winchester', 'jamalwinchester@email.com', '0942897430e12d98c4acafc63d50b91fda44ca38', '', '', NULL),
(39, 'kyledef', 'Kyle', 'De Freitas', 'kyle@email.com', '6233de5df38c206a8bde5ae6f8be9c6949740c1f', '', '', NULL),
(40, 'rastaman', 'Kadem', 'McGillivary', 'rasta@email.com', 'f9c897117a284ec37d408472be98de935b93f83f', '', '', NULL),
(41, 'skittles', 'Keniesha', 'McMillan', 'skittes@gmail.com', '505643a37d5f86a3cff95f25bcdba5d577d60111', 'food', '99d5f862e5d60ade36f34cd26d0424f2badc71b6', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`followid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`savedid`);

--
-- Indexes for table `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`tradeid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `followid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `savedid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `tradeid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
