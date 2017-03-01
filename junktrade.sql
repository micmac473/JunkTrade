-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2017 at 02:05 AM
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

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`followid`, `follower`, `followee`, `followdate`, `followindicator`) VALUES
(1, 1, 40, '2017-02-25 03:25:23', 1),
(2, 2, 1, '2017-02-25 13:12:38', 1),
(3, 1, 39, '2017-02-27 01:55:00', 1),
(4, 41, 1, '2017-02-28 04:36:36', 1);

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
  `requestercontact` varchar(10) NOT NULL,
  `requestee` int(11) NOT NULL,
  `item` int(10) NOT NULL,
  `decision` tinyint(1) DEFAULT NULL,
  `timerequested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `requester`, `item2`, `requestercontact`, `requestee`, `item`, `decision`, `timerequested`) VALUES
(11, 39, 29, '', 6, 26, NULL, '2016-11-27 20:05:31'),
(12, 6, 25, '', 39, 29, NULL, '2016-11-27 20:06:06'),
(13, 39, 29, '', 1, 27, NULL, '2016-11-27 20:08:12'),
(15, 1, 27, '', 6, 25, NULL, '2016-11-27 21:34:00'),
(19, 6, 26, '', 39, 29, NULL, '2016-11-27 22:30:01'),
(20, 39, 29, '', 40, 30, NULL, '2016-11-27 22:57:45'),
(21, 40, 38, '', 39, 29, NULL, '2016-11-27 23:01:42'),
(26, 40, 2, '', 1, 1, NULL, '2016-11-30 18:56:48'),
(27, 40, 2, '', 40, 30, NULL, '2016-11-30 19:07:56'),
(28, 40, 30, '', 1, 34, NULL, '2016-11-30 19:08:16'),
(31, 6, 25, '', 1, 27, NULL, '2016-11-30 20:05:31'),
(32, 6, 4, '', 9, 29, NULL, '2016-11-30 20:09:49'),
(33, 1, 27, '', 6, 26, NULL, '2016-11-30 20:42:55'),
(34, 1, 1, '', 6, 26, NULL, '2016-11-30 20:44:16'),
(35, 6, 26, '', 1, 36, NULL, '2016-11-30 20:47:58'),
(36, 6, 25, '', 2, 3, NULL, '2016-11-30 20:48:55'),
(37, 6, 4, '', 1, 42, NULL, '2016-12-01 15:10:50'),
(38, 1, 44, '', 40, 39, 0, '2016-12-02 00:34:22'),
(39, 40, 38, '', 1, 45, NULL, '2016-12-02 00:36:54'),
(40, 40, 30, '', 1, 46, NULL, '2016-12-02 00:39:27'),
(41, 1, 34, '', 40, 30, NULL, '2017-02-19 01:23:09'),
(42, 2, 3, '', 1, 46, NULL, '2017-02-20 23:57:47'),
(43, 40, 30, '', 1, 46, 1, '2017-02-22 09:22:58'),
(44, 1, 45, '', 40, 39, 0, '2017-02-22 11:08:12'),
(45, 1, 42, '', 40, 39, 1, '2017-02-22 15:28:26'),
(46, 40, 38, '', 1, 44, NULL, '2017-02-22 15:38:07'),
(47, 2, 3, '', 1, 36, 1, '2017-02-22 15:43:38'),
(48, 2, 3, '', 1, 46, 1, '2017-02-22 16:10:20'),
(49, 1, 45, '', 40, 39, 0, '2017-02-25 13:39:31'),
(50, 1, 45, '8681234567', 40, 39, 1, '2017-02-25 14:03:57'),
(51, 40, 38, '8681234567', 1, 44, 1, '2017-02-25 14:30:10'),
(52, 1, 42, '8681234567', 9, 29, NULL, '2017-02-26 14:54:03'),
(56, 1, 44, '8681234567', 40, 39, 1, '2017-02-26 15:46:22'),
(58, 1, 27, '8681234567', 40, 38, NULL, '2017-02-27 12:02:50'),
(60, 41, 47, '8689999999', 1, 44, 1, '2017-02-28 04:39:25'),
(61, 1, 42, '8681234567', 40, 39, NULL, '2017-02-28 05:06:47');

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

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`savedid`, `itemid`, `userid`, `itemowner`, `saveddate`, `savedindicator`) VALUES
(1, 38, 1, 40, '2017-02-25 03:25:48', 1),
(2, 39, 1, 40, '2017-02-25 14:33:33', 1),
(3, 30, 1, 40, '2017-02-25 21:27:52', 1),
(4, 44, 41, 1, '2017-02-28 04:41:19', 1);

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
  `requesteefeedbackrating` int(11) NOT NULL,
  `requesteefeedbackcomment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trade`
--

INSERT INTO `trade` (`tradeid`, `requestid`, `tradedate`, `tradelocation`, `suggestedlocation`, `locationdecision`, `requestercontact`, `requesteecontact`, `requesterfeedbackrating`, `requesterfeedbackcomment`, `requesteefeedbackrating`, `requesteefeedbackcomment`) VALUES
(1, 48, '02/26/2017', 'DAAGA', '', 0, '', '8683781527', 0, '', 0, ''),
(2, 47, '02/09/2017', 'Student Admin', '', 0, '', '8683781527', 0, '', 0, ''),
(3, 50, '02/27/2017', 'JFK Quadrangle', '', 0, '8681234567', '8683781527', 5, 'Good!', 5, 'Mickel is kinda cool'),
(4, 45, '02/23/2017', 'JFK Quadrangle', '', 0, '', '8683781527', 0, '', 0, ''),
(5, 43, '03/02/2017', 'Bookstore', '', 0, '', '8683781527', 0, '', 0, ''),
(6, 51, '03/04/2017', 'LRC Greens', '', 0, '8681234567', '8683781527', 0, '', 0, ''),
(7, 56, '02/28/2017', 'DAAGA', '', 0, '8681234567', '8683781527', 0, '', 0, ''),
(8, 60, '03/01/2017', 'Food Court', '', 0, '8689999999', '8681111111', 0, '', 0, '');

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
  `profilepicture` varchar(1000) NOT NULL DEFAULT '../img/defaultPP.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `sQuestion`, `sAnswer`, `profilepicture`) VALUES
(1, 'micmcm', 'Mickel', 'McMillan', 'mickelmcmillan@email.com', '6918950f89321712a8641620423d8c7d25951c0c', '', '', '../img/defaultPP.jpg'),
(2, 'mikmon', 'Mikael', 'Montoute', 'mikaelmontoute@email.com', '16331e4442209ff309047eaec83430646490f038', '', '2d27b62c597ec858f6e7b54e7e58525e6a95e6d8', ''),
(6, 'jamtart', 'Jamal', 'Winchester', 'jamalwinchester@email.com', '0942897430e12d98c4acafc63d50b91fda44ca38', '', '', ''),
(7, 'fesean', 'Shamar', 'Culzuc', 'shamarculzac@email.com', '825cce7a7af23134328ca7a872a142337e0a07fc', '', '', ''),
(8, 'pinky', 'Justin', 'Cadougan', 'justincadougan@email.com', 'f1412f80e25ec11bef07414c2cfa8c84ce3fdf23', '', '', ''),
(9, 'kyledef', 'Kyle', 'DeFreitas', 'kyledefreitas@email.com', '7103a38d7b345ad9dc1e25dd3b7dd606f84d2c0c', '', '', ''),
(10, 'shiva', 'Shiva', 'Ramoudith', 'shiveramoudith@email.com', '848b186485107266a3807096d328690f86a22c05', '', '', ''),
(34, 'franny', 'Francis', 'Darius', 'francis@email.com', '63ab89682d9a027b1f5c91f6b0ed347ef7dc9ac7', '', '', ''),
(38, 'kieu', 'Duc', 'Kieu', 'kieu@email.com', '2c27c22226e3fc5c109ebb4cbc4c972e02bce8f8', '', '', ''),
(39, 'kyledef', 'Kyle', 'De Freitas', 'kyle@email.com', '6233de5df38c206a8bde5ae6f8be9c6949740c1f', '', '', ''),
(40, 'rastaman', 'Kadem', 'McGillivary', 'rasta@email.com', 'f9c897117a284ec37d408472be98de935b93f83f', '', '', '../img/download.jpe'),
(41, 'skittles', 'Keniesha', 'McMillan', 'skittes@gmail.com', '505643a37d5f86a3cff95f25bcdba5d577d60111', 'food', '99d5f862e5d60ade36f34cd26d0424f2badc71b6', '');

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
  MODIFY `followid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `savedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `tradeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
