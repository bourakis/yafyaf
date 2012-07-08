-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2012 at 06:34 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yaf_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE IF NOT EXISTS `Accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`id`, `timestamp`, `username`, `password`, `email`, `fname`, `lname`, `dob`, `tel`) VALUES
(1, NULL, 'admin', '21342', 'add@boo.com', 'Andreas', 'Bourakis', '1908-03-03 00:00:00', '21342');

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Categories_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Categories_Categories1` (`Categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`id`, `Categories_id`, `name`) VALUES
(1, 1, 'Root');

-- --------------------------------------------------------

--
-- Table structure for table `Languages`
--

CREATE TABLE IF NOT EXISTS `Languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prefix` varchar(3) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Languages`
--

INSERT INTO `Languages` (`id`, `prefix`, `language`) VALUES
(1, 'GR', 'Greek'),
(2, 'EN', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `Options`
--

CREATE TABLE IF NOT EXISTS `Options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(75) DEFAULT NULL,
  `option_value` varchar(245) DEFAULT NULL,
  `autoload` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Options`
--


-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE IF NOT EXISTS `Posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Accounts_id` bigint(20) unsigned NOT NULL,
  `Languages_id` int(10) unsigned NOT NULL,
  `Categories_id` int(10) unsigned NOT NULL,
  `creation_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_timestamp` timestamp NULL DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `text` text,
  `publish` int(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=Pending\n2=Hidden\n3=Publish\n',
  `readings` int(11) DEFAULT NULL,
  `password` varchar(85) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Posts_Languages1` (`Languages_id`),
  KEY `fk_Posts_Accounts1` (`Accounts_id`),
  KEY `fk_Posts_Categories1` (`Categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`id`, `Accounts_id`, `Languages_id`, `Categories_id`, `creation_timestamp`, `update_timestamp`, `title`, `text`, `publish`, `status`, `readings`, `password`) VALUES
(1, 1, 1, 1, NULL, NULL, 'Hello World', 'This is a test post. ', 1, 1, NULL, NULL),
(2, 1, 1, 1, NULL, NULL, 'Test Post', 'Another test post for yaf framework.', 1, 1, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Categories`
--
ALTER TABLE `Categories`
  ADD CONSTRAINT `fk_Categories_Categories1` FOREIGN KEY (`Categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `fk_Posts_Accounts1` FOREIGN KEY (`Accounts_id`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Posts_Categories1` FOREIGN KEY (`Categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Posts_Languages1` FOREIGN KEY (`Languages_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
