-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2017 at 05:25 AM
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
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE `followers` (
  `follower` int(11) NOT NULL,
  `followee` int(11) NOT NULL,
  `followedindicator` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(26, 'Logo', 'This is my logo item', '../img/logo.png', '', '', '2016-11-26 15:55:07', 6, 2),
(27, 'HP Laptop', 'Processor: i5 2.5 Ghz Dual Core\r\nRam: 8 GB\r\nGraphics: Intel ', '../img/hp.jpg', '', '', '2016-11-26 15:57:48', 1, 2),
(29, 'SVG Flag', 'This the flag of St. Vincent and the Grenadines, West Indies', '../img/svgflag.png', '', '', '2016-11-27 15:21:11', 39, 2),
(30, 'Cloud Server', 'Heroku cloud server', '../img/cloudserver.jpg', '', '', '2016-11-27 22:57:00', 40, 6),
(34, 'Hydrangeas', 'Hydrangeas', '../img/Hydrangeas.jpg', '', '', '2016-11-30 13:42:30', 1, 0),
(36, 'Jellyfish', 'Jellyfish', '../img/Jellyfish.jpg', '', '', '2016-11-30 13:45:11', 1, 0),
(38, 'Nike', 'Color: Red and black\r\nSize: 12\r\nCondition: New\r\nComes with box', '../img/airjordans.jpe', '', '', '2016-11-30 19:11:47', 40, 3),
(39, 'Gucci Watch', 'This is real Gucci', '../img/gucciwatch.jpe', '', '', '2016-11-30 19:54:55', 40, 7),
(42, 'Piano Keyboard', 'Brand: Yamaha\r\nCondition: Used\r\nComes with everything', '../img/pianokeyboard.jpe', '', '', '2016-12-01 15:10:04', 1, 1),
(44, 'iPhone 6', 'Capacity: 68 GB\r\nRAM: 4 GB\r\nDisplay: Retina\r\nCondition: New', '../img/iphone.jpg', '', '', '2016-12-01 23:40:35', 1, 2),
(45, 'Gucci Belt', 'Genuine Leather,\r\nCondition: New', '../img/guccibelt.jpg', '', '', '2016-12-02 00:36:38', 1, 0),
(46, 'New Era Hat', 'Snapback\r\nColor: Black\r\nSize: 7 1/2', '../img/snapback.jpg', '', '', '2016-12-02 00:38:16', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `requestee` int(11) NOT NULL,
  `item` int(10) NOT NULL,
  `decision` tinyint(1) DEFAULT NULL,
  `timerequested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `requester`, `item2`, `requestee`, `item`, `decision`, `timerequested`) VALUES
(11, 39, 29, 6, 26, NULL, '2016-11-27 20:05:31'),
(12, 6, 25, 39, 29, NULL, '2016-11-27 20:06:06'),
(13, 39, 29, 1, 27, NULL, '2016-11-27 20:08:12'),
(15, 1, 27, 6, 25, NULL, '2016-11-27 21:34:00'),
(19, 6, 26, 39, 29, NULL, '2016-11-27 22:30:01'),
(20, 39, 29, 40, 30, NULL, '2016-11-27 22:57:45'),
(21, 40, 38, 39, 29, NULL, '2016-11-27 23:01:42'),
(26, 40, 2, 1, 1, NULL, '2016-11-30 18:56:48'),
(27, 40, 2, 40, 30, NULL, '2016-11-30 19:07:56'),
(28, 40, 30, 1, 34, NULL, '2016-11-30 19:08:16'),
(29, 1, 36, 40, 38, NULL, '2016-11-30 19:11:59'),
(30, 1, 27, 40, 39, NULL, '2016-11-30 19:55:11'),
(31, 6, 25, 1, 27, 1, '2016-11-30 20:05:31'),
(32, 6, 4, 9, 29, NULL, '2016-11-30 20:09:49'),
(33, 1, 27, 6, 26, 0, '2016-11-30 20:42:55'),
(34, 1, 1, 6, 26, NULL, '2016-11-30 20:44:16'),
(35, 6, 26, 1, 36, 1, '2016-11-30 20:47:58'),
(36, 6, 25, 2, 3, NULL, '2016-11-30 20:48:55'),
(37, 6, 4, 1, 42, 0, '2016-12-01 15:10:50'),
(38, 1, 44, 40, 39, 0, '2016-12-02 00:34:22'),
(39, 40, 38, 1, 45, 1, '2016-12-02 00:36:54'),
(40, 40, 30, 1, 46, 0, '2016-12-02 00:39:27'),
(41, 1, 34, 40, 30, NULL, '2017-02-19 01:23:09'),
(42, 2, 3, 1, 46, NULL, '2017-02-20 23:57:47'),
(43, 2, 3, 1, 45, 1, '2017-02-23 00:09:46'),
(44, 2, 3, 40, 39, NULL, '2017-02-23 00:09:56');

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
  `requestercontact` varchar(20) NOT NULL,
  `requesteecontact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trade`
--

INSERT INTO `trade` (`tradeid`, `requestid`, `tradedate`, `tradelocation`, `requestercontact`, `requesteecontact`) VALUES
(3, 28, '02/23/2017', 'foodcourt', '123456789', '987654321'),
(9, 34, '03/01/2017', 'lrcgreens', '868123456', '868987654'),
(10, 42, '02/24/2017', 'jfk', '868456789', '868654321'),
(11, 43, '02/26/2017', 'Food Court', '', '1234567');

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
  `profilepicture` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `sQuestion`, `sAnswer`, `profilepicture`) VALUES
(1, 'micmcm', 'Mickel', 'McMillan', 'mickelmcmillan@email.com', '6918950f89321712a8641620423d8c7d25951c0c', '', '', '../img/IMG_2497.JPG'),
(2, 'mikmon', 'Mikael', 'Montoute', 'mikaelmontoute@email.com', '16331e4442209ff309047eaec83430646490f038', 'sport', '2d27b62c597ec858f6e7b54e7e58525e6a95e6d8', '../img/aug 2016 010.JPG'),
(6, 'jamtart', 'Jamal', 'Winchester', 'jamalwinchester@email.com', '0942897430e12d98c4acafc63d50b91fda44ca38', '', '', NULL),
(7, 'fesean', 'Shamar', 'Culzuc', 'shamarculzac@email.com', '825cce7a7af23134328ca7a872a142337e0a07fc', '', '', ''),
(8, 'pinky', 'Justin', 'Cadougan', 'justincadougan@email.com', 'f1412f80e25ec11bef07414c2cfa8c84ce3fdf23', '', '', ''),
(9, 'kyledef', 'Kyle', 'DeFreitas', 'kyledefreitas@email.com', '7103a38d7b345ad9dc1e25dd3b7dd606f84d2c0c', '', '', ''),
(10, 'shiva', 'Shiva', 'Ramoudith', 'shiveramoudith@email.com', '848b186485107266a3807096d328690f86a22c05', '', '', ''),
(34, 'franny', 'Francis', 'Darius', 'francis@email.com', '63ab89682d9a027b1f5c91f6b0ed347ef7dc9ac7', '', '', ''),
(38, 'kieu', 'Duc', 'Kieu', 'kieu@email.com', '2c27c22226e3fc5c109ebb4cbc4c972e02bce8f8', '', '', ''),
(39, 'kyledef', 'Kyle', 'De Freitas', 'kyle@email.com', '6233de5df38c206a8bde5ae6f8be9c6949740c1f', '', '', ''),
(40, 'rastaman', 'Kadem', 'McGillivary', 'rasta@email.com', 'f9c897117a284ec37d408472be98de935b93f83f', '', '', ''),
(41, 'skittles', 'Keniesha', 'McMillan', 'skittes@gmail.com', '505643a37d5f86a3cff95f25bcdba5d577d60111', 'food', '99d5f862e5d60ade36f34cd26d0424f2badc71b6', NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `tradeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
