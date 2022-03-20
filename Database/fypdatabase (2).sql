-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2022 at 12:02 PM
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
-- Table structure for table `bannedteacher`
--

DROP TABLE IF EXISTS `bannedteacher`;
CREATE TABLE IF NOT EXISTS `bannedteacher` (
  `bannedID` int(11) NOT NULL AUTO_INCREMENT,
  `teacherID` int(11) NOT NULL,
  PRIMARY KEY (`bannedID`),
  KEY `bannedteacher_fk0` (`teacherID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banneduser`
--

DROP TABLE IF EXISTS `banneduser`;
CREATE TABLE IF NOT EXISTS `banneduser` (
  `bannedID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`bannedID`),
  KEY `banneduser_fk0` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lessonID`, `description`) VALUES
(2, 'hello everyone can you look at the homework on page 93 related to the this lesson thanks.'),
(1, '      Testing the chalkboard'),
(3, 'Update Inheritance check');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `userID`, `date`, `Title`, `description`) VALUES
(2, 2, '2022-02-20', 'Java homework help!!', 'Hi guys, I was wondering if anyone understands question 4 in the homework. Could anyone give me some help?'),
(3, 2, '2022-02-20', 'Programming project GUI??', 'Hi guys, our assignment involves creating a system using object-oriented. Currently I am working on a booking system does anyone know how to implement a GUI in Java??'),
(9, 2, '2022-03-19', 'Hello everyone', 'Can I get help with java');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`ReplyID`, `PostID`, `description`, `userID`, `replyby`) VALUES
(1, 2, 'Hi Oisin, that is a tricky question. Try having a look at the lecture slides from week 3. Hope this helps.       ', 5, 'userone'),
(3, 2, 'Thank you so much. I managed to get it working!!    ', 2, 'Oisin McNamara'),
(4, 2, 'Thats great well done!!      ', 5, 'userone'),
(5, 9, ' Of course what are you stuck on', 2, 'Oisin McNamara'),
(6, 2, '      testing', 2, 'Oisin McNamara');

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
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskID`, `taskTitle`, `taskDescription`, `teacherID`, `filePath`, `taskfilename`) VALUES
(56, 'Complete the Java task', 'yyg', '1', 'polymorphism lab.pdf', 'Staticpolymorphism');

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskstatus`
--

INSERT INTO `taskstatus` (`statusID`, `taskID`, `userID`, `status`, `filePathUser`, `feedback`, `autoFeedback`) VALUES
(33, 56, 2, 'Complete', 'Staticpolymorphism.java', 'code needs to be indented properly,\r\nclass starts with capital letter,\r\nmethods must be declared static,\r\n\r\nother than that great work ', '      ---Test 1 passed: Class file starts with Capital letter \r\n      ---Test 3 passed: All methods have a lowercase                      \r\n      ---Test 4: Pass Answer format check \r\n      ---Test 5: Pass Answer output check       \r\n      ');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `teachername`, `email`, `password`, `access`) VALUES
(1, 'Oisin McNamara', 'oisin.mcnamara@gmail.com', '$2y$10$o2KxSzTGQ7mCE8vk.nwl/O/GG7qlvFYVHktkZZ9aLVhioqzZwX/Te', 1),
(3, 'teacherAccount', 'teacher@gmail.com', '$2y$10$5uT4vuKpmtxNq8bytWkjGOTiKkOn62025.wyKqazFNxWpKHY1Yeju', 0),
(4, 'teacherAccounttwo', 'secondTeacher@gmail.com', '$2y$10$PNT.EqSPjVqTlOOX9Y63xOPkvRO9FN8jr.Bw3ACUBEpYEFZM4iTyC', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `admin`, `points`, `pointtracker`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$UQy8oHiOyxLTIxszjVuRSuoQ1Wq91ZfDpmZOOzp/p79niSLo47trC', 1, 5, 1),
(2, 'Oisin McNamara', 'oisin.mcnamara@gmail.com', '$2y$10$imolKi3NqTf73YW8vu6jNunX9sJ3yqDyuCj7my9wVsstaaRLAEJju', 0, 6, 1),
(5, 'userone', 'userone@gmail.com', '$2y$10$BwZdc4m34/4RajDuPAUQVeX3oFeYYb7P3KXbXVHzpoU8wo.CEHc1u', 0, 4, 1),
(4, 'john doh', 'john@gmail.com', '$2y$10$5x.vvdqQQngZ0TZhfcdNUexo0ZTcW1Am8WexiN5WvJ.UwCoDMQhVW', 0, 4, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
