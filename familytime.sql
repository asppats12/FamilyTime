-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2018 at 03:51 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `familytime`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `groupid`) VALUES
(4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

DROP TABLE IF EXISTS `chatmessages`;
CREATE TABLE IF NOT EXISTS `chatmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chatid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chatid` (`chatid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventlocationbridge`
--

DROP TABLE IF EXISTS `eventlocationbridge`;
CREATE TABLE IF NOT EXISTS `eventlocationbridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventid` int(11) NOT NULL,
  `locationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eventid` (`eventid`),
  KEY `locationid` (`locationid`),
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventlocationbridge`
--

INSERT INTO `eventlocationbridge` (`id`, `eventid`, `locationid`, `userid`, `groupid`) VALUES
(1, 3, 1, 1, 7),
(2, 4, 2, 1, 7),
(3, 5, 3, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `details` text,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `details`, `startdate`, `enddate`, `starttime`, `endtime`) VALUES
(3, 'Exams', 'Exams', '2018-02-11', '2018-02-12', '11:00:00', '12:00:00'),
(4, 'Party', 'Party', '2018-01-20', '2018-01-20', '20:00:00', '00:00:00'),
(5, 'Black Panther', 'Movie Time', '2018-02-01', '2018-02-01', '20:20:00', '22:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `familygroup`
--

DROP TABLE IF EXISTS `familygroup`;
CREATE TABLE IF NOT EXISTS `familygroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin` (`admin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familygroup`
--

INSERT INTO `familygroup` (`id`, `name`, `admin`) VALUES
(7, 'The Fam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `formattedaddress` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `place_id`, `name`, `lat`, `lng`, `formattedaddress`) VALUES
(1, 'ChIJCfji06w7K4gR1Ca9tLlrR-0', 'Humber College', 43.7292, -79.6049, 'Toronto, ON M9W, Canada'),
(2, 'ChIJryG3suI7K4gR8Fx4QyOOVOU', 'The International Centre', 43.7033, -79.6377, '6900 Airport Rd, Mississauga, ON L4V 1E8, Canada'),
(3, 'ChIJ6WXdCtA0K4gR5wmJfTBGe48', 'Scotiabank Theatre Toronto', 43.6489, -79.3912, '259 Richmond St W, Toronto, ON M5V 3M6, Canada');

-- --------------------------------------------------------

--
-- Table structure for table `usergroupbridge`
--

DROP TABLE IF EXISTS `usergroupbridge`;
CREATE TABLE IF NOT EXISTS `usergroupbridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `chatid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid_2` (`userid`),
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`),
  KEY `chatid` (`chatid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroupbridge`
--

INSERT INTO `usergroupbridge` (`id`, `userid`, `groupid`, `chatid`) VALUES
(3, 1, 7, 4),
(6, 2, 7, 4),
(7, 3, 7, 4),
(8, 5, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `firstname` varchar(16) DEFAULT NULL,
  `lastname` varchar(16) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `profilepicurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `dateofbirth`, `profilepicurl`) VALUES
(1, 'akshaydeeppatel@yahoo.com', 'super', 'Akshay', 'Patel', '1991-11-20', '../uploads/photos/IMG-20171005-WA0010.jpg'),
(2, 'laksh@gmail.com', 'super', 'Lakshyavir', 'Sanghera', '1990-11-02', '../uploads/photos/20638155_1597917220242774_3015343674298899465_n.jpg'),
(3, 'ushay@gmail.com', 'ushay', 'Ushay', 'Ashraf', '1990-11-02', '../uploads/photos/1920312_10153723665529992_7285050373048599432_n.jpg'),
(5, 'utsav@gmail.com', 'utsav', 'Utsav', 'Gandhi', '1993-06-20', '../uploads/photos/17505153_1720295094677572_617277760909291057_o.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `groupchat` FOREIGN KEY (`groupid`) REFERENCES `familygroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD CONSTRAINT `groupmessage` FOREIGN KEY (`chatid`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usermessage` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventlocationbridge`
--
ALTER TABLE `eventlocationbridge`
  ADD CONSTRAINT `eventlocationbridge_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventlocationbridge_ibfk_2` FOREIGN KEY (`locationid`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventlocationbridge_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventlocationbridge_ibfk_4` FOREIGN KEY (`groupid`) REFERENCES `familygroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `familygroup`
--
ALTER TABLE `familygroup`
  ADD CONSTRAINT `familygroup_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usergroupbridge`
--
ALTER TABLE `usergroupbridge`
  ADD CONSTRAINT `usergroupbridge_ibfk_1` FOREIGN KEY (`chatid`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroupbridge_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `familygroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroupbridge_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
