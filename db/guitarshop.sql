-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2013 at 08:23 PM
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
  `body_id` int(3) NOT NULL,
  `body_shape` varchar(50) DEFAULT NULL,
  `wood_id` int(11) NOT NULL,
  PRIMARY KEY (`body_id`,`wood_id`),
  KEY `fk_bodies_woods1_idx` (`wood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bodies`
--

INSERT INTO `bodies` (`body_id`, `body_shape`, `wood_id`) VALUES
(1, 'PRS', 1),
(2, 'PRS', 3),
(3, 'PRS', 6),
(4, 'PRS', 7),
(5, 'RG', 1),
(6, 'RG', 3),
(7, 'RG', 6),
(8, 'RG', 7),
(9, 'S', 1),
(10, 'S', 3),
(11, 'S', 6),
(12, 'S', 7),
(13, 'Schecter', 1),
(14, 'Schecter', 3),
(15, 'Schecter', 6),
(16, 'Schecter', 7),
(17, 'Stratocaster', 1),
(18, 'Stratocaster', 3),
(19, 'Stratocaster', 6),
(20, 'Stratocaster', 7),
(21, 'Telecaster', 1),
(22, 'Telecaster', 3),
(23, 'Telecaster', 6),
(24, 'Telecaster', 7),
(25, 'Les paul', 1),
(26, 'Les paul', 3),
(27, 'Les paul', 6),
(28, 'Les paul', 7),
(29, 'JP', 7);

-- --------------------------------------------------------

--
-- Table structure for table `bridges`
--

CREATE TABLE IF NOT EXISTS `bridges` (
  `bridge_id` int(3) NOT NULL,
  `bridge_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bridge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bridges`
--

INSERT INTO `bridges` (`bridge_id`, `bridge_type`) VALUES
(1, 'Vintage Tremolo'),
(2, 'Fixed Tremolo'),
(3, 'Floyd Rose Tremolo');

-- --------------------------------------------------------

--
-- Table structure for table `fretboards`
--

CREATE TABLE IF NOT EXISTS `fretboards` (
  `fretboard_id` int(3) NOT NULL,
  `number_of_fret` int(3) DEFAULT NULL,
  `wood_id` int(3) NOT NULL,
  PRIMARY KEY (`fretboard_id`,`wood_id`),
  KEY `fk_fretboards_woods1_idx` (`wood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fretboards`
--

INSERT INTO `fretboards` (`fretboard_id`, `number_of_fret`, `wood_id`) VALUES
(1, 21, 3),
(2, 22, 3),
(3, 24, 3),
(4, 21, 4),
(5, 22, 4),
(6, 24, 4),
(7, 21, 2),
(8, 22, 2),
(9, 24, 2),
(10, 22, 6),
(11, 24, 6),
(12, 22, 5),
(13, 24, 5),
(14, 21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `guitars`
--

CREATE TABLE IF NOT EXISTS `guitars` (
  `guitar_id` int(5) NOT NULL,
  `model_name` varchar(200) DEFAULT NULL,
  `number_of_string` int(3) DEFAULT NULL,
  `made_in` varchar(50) DEFAULT NULL,
  `neck_id` int(3) NOT NULL,
  `bridge_id` int(3) NOT NULL,
  `pickup_id` int(3) NOT NULL,
  `manufacturer_id` int(3) NOT NULL,
  `body_id` int(3) NOT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`guitar_id`,`neck_id`,`bridge_id`,`pickup_id`,`manufacturer_id`,`body_id`),
  KEY `fk_guitars_necks1_idx` (`neck_id`),
  KEY `fk_guitars_bridges1_idx` (`bridge_id`),
  KEY `fk_guitars_pickups1_idx` (`pickup_id`),
  KEY `fk_guitars_manufacturers1_idx` (`manufacturer_id`),
  KEY `fk_guitars_bodies1_idx` (`body_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guitars`
--

INSERT INTO `guitars` (`guitar_id`, `model_name`, `number_of_string`, `made_in`, `neck_id`, `bridge_id`, `pickup_id`, `manufacturer_id`, `body_id`, `price`) VALUES
(1, 'Standard Stratocaster Mexico', 6, 'Mexico', 1, 1, 2, 1, 18, 18900),
(2, 'Standard Telecaster', 6, 'Japan', 15, 1, 2, 1, 24, 20400),
(3, 'Standard Stratocaster USA', 6, 'USA', 9, 1, 2, 1, 23, 30000),
(4, 'Standard Stratocaster Korea', 6, 'Korea', 13, 1, 2, 6, 23, 80900),
(5, 'Les Paul Signature T', 6, 'USA', 5, 2, 4, 2, 28, 16000),
(6, 'Les Paul Standard Gary Moore Tribute Lemon Burst', 6, 'USA', 6, 2, 4, 2, 27, 54000),
(7, 'Les Paul Zoot Suit Rainbow', 6, 'Japan', 10, 2, 4, 2, 28, 45000),
(8, 'LPJ', 6, 'USA', 3, 2, 4, 2, 26, 90800),
(9, 'BBM1 Ben Bruce Asking Alexandria Signature', 6, 'China', 6, 2, 4, 2, 25, 17000),
(10, 'GRG7221BK', 6, 'Mexico', 1, 1, 5, 3, 6, 50000),
(11, 'GRG170DX', 6, 'Japan', 9, 1, 5, 3, 6, 45000),
(12, 'GRG121 SP ( Limited for 2012 )', 6, 'USA', 5, 3, 5, 3, 8, 120000),
(13, 'Custom 24 ( 2013 ) Antique White', 6, 'Japan', 14, 1, 4, 4, 3, 78000),
(14, 'Custom 24 ( 2013 ) Trampas Green', 6, 'Indonesia', 10, 1, 4, 4, 3, 23000),
(15, 'Custom 24 ( 2013 ) Makena Blue', 6, 'Indonesia', 5, 1, 4, 4, 2, 45000),
(16, 'Custom 24 ( 2013 ) Fire Red Burst', 6, 'Mexico', 9, 1, 4, 4, 2, 180000),
(17, 'Bullet Strat RW', 6, 'Korea', 20, 1, 3, 1, 19, 5600),
(18, 'Stratocaster', 6, 'Indonesia', 5, 1, 2, 1, 18, 14000),
(19, 'OLARN Signature Strat Series II', 6, 'Japan', 10, 1, 2, 6, 24, 23000),
(20, 'Bullet', 6, 'Mexico', 1, 1, 2, 6, 19, 78000),
(21, 'SGR Series S-1', 6, 'Mexico', 15, 2, 4, 5, 16, 50000),
(22, 'SGR Series C-1', 6, 'USA', 2, 2, 4, 5, 16, 21000),
(23, 'SGR Series 006', 6, 'China', 1, 2, 4, 5, 15, 78000),
(24, 'Damien Platinum 6 FR', 6, 'China', 17, 3, 4, 5, 16, 23000),
(25, 'GRG7221BK', 7, 'Indonesia', 19, 3, 5, 3, 8, 9350),
(26, 'JP70', 7, 'Indonesia', 17, 1, 4, 7, 29, 24300),
(27, 'SGR-1C', 7, 'Indonesia', 4, 2, 4, 5, 16, 7600);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturer_id` int(3) NOT NULL,
  `manufacturer_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_name`) VALUES
(1, 'Fender'),
(2, 'Gibson'),
(3, 'Ibanez'),
(4, 'PRS'),
(5, 'Schecter'),
(6, 'Squier'),
(7, 'Sterling');

-- --------------------------------------------------------

--
-- Table structure for table `necks`
--

CREATE TABLE IF NOT EXISTS `necks` (
  `neck_id` int(3) NOT NULL,
  `neck_shape` varchar(50) DEFAULT NULL,
  `wood_id` int(3) NOT NULL,
  `fretboard_id` int(3) NOT NULL,
  PRIMARY KEY (`neck_id`,`wood_id`,`fretboard_id`),
  KEY `fk_necks_woods1_idx` (`wood_id`),
  KEY `fk_necks_fretboards1_idx` (`fretboard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `necks`
--

INSERT INTO `necks` (`neck_id`, `neck_shape`, `wood_id`, `fretboard_id`) VALUES
(1, 'C', 3, 1),
(2, 'C', 5, 2),
(3, 'C', 6, 11),
(4, 'D', 2, 2),
(5, 'D', 3, 9),
(6, 'D', 4, 6),
(7, 'D', 6, 2),
(8, 'Hard V', 2, 2),
(9, 'Hard V', 3, 5),
(10, 'Hard V', 4, 3),
(11, 'Hard V', 5, 5),
(12, 'Hard V', 5, 6),
(13, 'O', 2, 3),
(14, 'Soft V', 3, 3),
(15, 'Soft V', 3, 4),
(16, 'Soft V', 3, 9),
(17, 'Soft V', 4, 2),
(18, 'Soft V', 4, 14),
(19, 'V', 3, 9),
(20, 'V', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pickups`
--

CREATE TABLE IF NOT EXISTS `pickups` (
  `pickup_id` int(3) NOT NULL,
  `pickup_configuration` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`pickup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pickups`
--

INSERT INTO `pickups` (`pickup_id`, `pickup_configuration`) VALUES
(1, 'S/S'),
(2, 'S/S/S'),
(3, 'H/S/S'),
(4, 'H/H'),
(5, 'H/S/H');

-- --------------------------------------------------------

--
-- Table structure for table `woods`
--

CREATE TABLE IF NOT EXISTS `woods` (
  `wood_id` int(3) NOT NULL,
  `wood_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`wood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `woods`
--

INSERT INTO `woods` (`wood_id`, `wood_name`) VALUES
(1, 'Alder'),
(2, 'Rosewood'),
(3, 'Maple'),
(4, 'Ebony'),
(5, 'Brazilian Rosewood'),
(6, 'Mahogany'),
(7, 'Basswood');

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
  ADD CONSTRAINT `fk_necks_fretboards1` FOREIGN KEY (`fretboard_id`) REFERENCES `fretboards` (`fretboard_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_necks_woods1` FOREIGN KEY (`wood_id`) REFERENCES `woods` (`wood_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
