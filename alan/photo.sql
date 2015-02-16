-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2015 at 09:47 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `user_pass` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin_login`
--


-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `date` varchar(40) NOT NULL,
  `filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `date`, `filename`) VALUES
(198, 'aaaaa', '02-16-15', 'image-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` varchar(225) NOT NULL,
  `filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `pictures`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(10) NOT NULL AUTO_INCREMENT,
  `groupid` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `loginid` varchar(75) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `firstname` varchar(75) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `lastname` varchar(75) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `pwd` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `emailpass` varchar(20) CHARACTER SET latin1 NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'Yes',
  `master` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=100005 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `groupid`, `loginid`, `firstname`, `lastname`, `pwd`, `email`, `emailpass`, `lastlogin`, `status`, `master`) VALUES
(100000, '', 'abolsh', 'Alan ', 'Bolish', '123*Password', 'abolsh@hotmail.com', '', '2015-02-16 13:31:19', 'Yes', 'No');
