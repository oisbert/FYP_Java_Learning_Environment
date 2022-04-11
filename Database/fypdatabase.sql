-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2022 at 02:58 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fypdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `lessonID` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  PRIMARY KEY (`lessonID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `PostID` int(255) NOT NULL AUTO_INCREMENT,
  `userID` int(255) NOT NULL,
  `date` date NOT NULL,
  `Title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`PostID`),
  KEY `Posts_fk0` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quickfeedback`
--

DROP TABLE IF EXISTS `quickfeedback`;
CREATE TABLE IF NOT EXISTS `quickfeedback` (
  `quickfeedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `quickfeedbackAdded` text NOT NULL,
  PRIMARY KEY (`quickfeedbackID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quickfeedback`
--

INSERT INTO `quickfeedback` (`quickfeedbackID`, `quickfeedbackAdded`) VALUES
(1, 'code needs to be indented properly'),
(2, 'class starts with capital letter'),
(3, 'methods must be declared static'),
(4, 'return type incorrect'),
(5, 'method invoked incorrectly'),
(6, 'return type missing'),
(8, 'methods must start with lowercase letter'),
(9, 'output not formatted correctly'),
(11, 'Methods showing wrong output'),
(14, 'Missing semi-colon');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `ReplyID` int(255) NOT NULL AUTO_INCREMENT,
  `PostID` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `replyby` varchar(255) NOT NULL,
  PRIMARY KEY (`ReplyID`),
  KEY `Reply_fk0` (`PostID`),
  KEY `Reply_fk1` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `taskID` int(255) NOT NULL AUTO_INCREMENT,
  `taskTitle` varchar(255) NOT NULL,
  `taskDescription` varchar(255) NOT NULL,
  `teacherID` varchar(255) NOT NULL,
  `filePath` varchar(255) DEFAULT NULL,
  `taskfilename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`taskID`),
  KEY `Tasks_fk0` (`teacherID`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taskstatus`
--

DROP TABLE IF EXISTS `taskstatus`;
CREATE TABLE IF NOT EXISTS `taskstatus` (
  `statusID` int(255) NOT NULL AUTO_INCREMENT,
  `taskID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `filePathUser` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `autoFeedback` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`statusID`),
  KEY `TaskStatus_fk0` (`taskID`),
  KEY `TaskStatus_fk1` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherID` int(11) NOT NULL AUTO_INCREMENT,
  `teachername` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`teacherID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `pointtracker` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
