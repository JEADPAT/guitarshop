-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2013 at 07:02 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guitarshop`
--
CREATE DATABASE IF NOT EXISTS `guitarshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `guitarshop`;

-- --------------------------------------------------------

--
-- Table structure for table `bodies`
--

CREATE TABLE IF NOT EXISTS `bodies` (
  `body_id` int(11) NOT NULL AUTO_INCREMENT,
  `body_shape` varchar(255) DEFAULT NULL,
  `wood_id` int(11) NOT NULL,
  PRIMARY KEY (`body_id`,`wood_id`),
  KEY `fk_bodies_woods1_idx` (`wood_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bodies`
--

INSERT INTO `bodies` (`body_id`, `body_shape`, `wood_id`) VALUES
(1, 'Stratocaster', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bridges`
--

CREATE TABLE IF NOT EXISTS `bridges` (
  `bridge_id` int(11) NOT NULL AUTO_INCREMENT,
  `bridge_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bridge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bridges`
--

INSERT INTO `bridges` (`bridge_id`, `bridge_type`) VALUES
(1, 'Vintage Tremolo');

-- --------------------------------------------------------

--
-- Table structure for table `fretboards`
--

CREATE TABLE IF NOT EXISTS `fretboards` (
  `fretboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `number_of_fret` int(11) DEFAULT NULL,
  `wood_id` int(11) NOT NULL,
  PRIMARY KEY (`fretboard_id`,`wood_id`),
  KEY `fk_fretboards_woods1_idx` (`wood_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fretboards`
--

INSERT INTO `fretboards` (`fretboard_id`, `number_of_fret`, `wood_id`) VALUES
(1, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `guitars`
--

CREATE TABLE IF NOT EXISTS `guitars` (
  `guitar_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(255) DEFAULT NULL,
  `number_of_string` int(11) DEFAULT NULL,
  `made_in` varchar(255) DEFAULT NULL,
  `neck_id` int(11) NOT NULL,
  `bridge_id` int(11) NOT NULL,
  `pickup_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `body_id` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`guitar_id`,`neck_id`,`bridge_id`,`pickup_id`,`manufacturer_id`,`body_id`),
  KEY `fk_guitars_necks1_idx` (`neck_id`),
  KEY `fk_guitars_bridges1_idx` (`bridge_id`),
  KEY `fk_guitars_pickups1_idx` (`pickup_id`),
  KEY `fk_guitars_manufacturers1_idx` (`manufacturer_id`),
  KEY `fk_guitars_bodies1_idx` (`body_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `guitars`
--

INSERT INTO `guitars` (`guitar_id`, `model_name`, `number_of_string`, `made_in`, `neck_id`, `bridge_id`, `pickup_id`, `manufacturer_id`, `body_id`, `price`) VALUES
(1, 'Standard Stratocaster', 6, 'Maxico', 1, 1, 2, 1, 1, 18900);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_name`) VALUES
(1, 'Fender'),
(2, 'Gibson'),
(3, 'Ibanez'),
(4, 'PRS'),
(5, 'Schecter'),
(6, 'Squier');

-- --------------------------------------------------------

--
-- Table structure for table `necks`
--

CREATE TABLE IF NOT EXISTS `necks` (
  `neck_id` int(11) NOT NULL,
  `neck_shape` varchar(255) DEFAULT NULL,
  `wood_id` int(11) NOT NULL,
  `fretboard_id` int(11) NOT NULL,
  PRIMARY KEY (`neck_id`,`wood_id`,`fretboard_id`),
  KEY `fk_necks_woods1_idx` (`wood_id`),
  KEY `fk_necks_fretboards1_idx` (`fretboard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `necks`
--

INSERT INTO `necks` (`neck_id`, `neck_shape`, `wood_id`, `fretboard_id`) VALUES
(1, 'C', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pickups`
--

CREATE TABLE IF NOT EXISTS `pickups` (
  `pickup_id` int(11) NOT NULL AUTO_INCREMENT,
  `pickup_configuration` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pickup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pickups`
--

INSERT INTO `pickups` (`pickup_id`, `pickup_configuration`) VALUES
(1, 'S/S'),
(2, 'S/S/S'),
(3, 'S/S/H'),
(4, 'H/H'),
(5, 'H/S/H');

-- --------------------------------------------------------

--
-- Table structure for table `woods`
--

CREATE TABLE IF NOT EXISTS `woods` (
  `wood_id` int(11) NOT NULL AUTO_INCREMENT,
  `wood_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`wood_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `woods`
--

INSERT INTO `woods` (`wood_id`, `wood_name`) VALUES
(1, 'Alder'),
(2, 'Rosewood'),
(3, 'Maple');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bodies`
--
ALTER TABLE `bodies`
  ADD CONSTRAINT `fk_bodies_woods1` FOREIGN KEY (`wood_id`) REFERENCES `woods` (`wood_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fretboards`
--
ALTER TABLE `fretboards`
  ADD CONSTRAINT `fk_fretboards_woods1` FOREIGN KEY (`wood_id`) REFERENCES `woods` (`wood_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guitars`
--
ALTER TABLE `guitars`
  ADD CONSTRAINT `fk_guitars_bodies1` FOREIGN KEY (`body_id`) REFERENCES `bodies` (`body_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_guitars_bridges1` FOREIGN KEY (`bridge_id`) REFERENCES `bridges` (`bridge_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_guitars_manufacturers1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`manufacturer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_guitars_necks1` FOREIGN KEY (`neck_id`) REFERENCES `necks` (`neck_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_guitars_pickups1` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`pickup_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `necks`
--
ALTER TABLE `necks`
  ADD CONSTRAINT `fk_necks_woods1` FOREIGN KEY (`wood_id`) REFERENCES `woods` (`wood_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_necks_fretboards1` FOREIGN KEY (`fretboard_id`) REFERENCES `fretboards` (`fretboard_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
