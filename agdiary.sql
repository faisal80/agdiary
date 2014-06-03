-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2012 at 03:05 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agdiary`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposal`
--

CREATE TABLE IF NOT EXISTS `tbl_disposal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) unsigned NOT NULL,
  `officer_id` int(10) unsigned NOT NULL,
  `disposal_date` date DEFAULT NULL,
  `disposal` text,
  PRIMARY KEY (`id`),
  KEY `tbl_disposal_FKIndex1` (`document_id`),
  KEY `tbl_disposal_FKIndex2` (`officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE IF NOT EXISTS `tbl_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_received` date NOT NULL COMMENT 'Date the document received',
  `reference_number` varchar(255) DEFAULT NULL COMMENT 'Reference Number of the document',
  `date_of_document` date DEFAULT NULL COMMENT 'Date of Document',
  `received_from` varchar(255) DEFAULT NULL COMMENT 'From whom the document is received',
  `description` text COMMENT 'Description about the document',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_documents`
--

INSERT INTO `tbl_documents` (`id`, `date_received`, `reference_number`, `date_of_document`, `received_from`, `description`) VALUES
(1, '2012-01-28', 'DG/PHA/Admn/Staff/2345', '2012-01-15', 'Provincial Housing Authority', 'Release of Rs. 30 million under ADP Scheme No. 945-55464');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marked`
--

CREATE TABLE IF NOT EXISTS `tbl_marked` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) unsigned NOT NULL COMMENT 'ID of the document received',
  `officer_id` int(10) unsigned NOT NULL COMMENT 'ID of the officer to whom the document was marked.',
  `marked_by` int(10) unsigned NOT NULL COMMENT 'ID of the officer who marked the document',
  `marked_date` date DEFAULT NULL COMMENT 'Date on which the document was marked to the officer',
  `time_limit` int(10) unsigned DEFAULT NULL COMMENT 'Time limit given by AG in terms of days.',
  PRIMARY KEY (`id`),
  KEY `marked_FKIndex1` (`document_id`),
  KEY `marked_FKIndex2` (`officer_id`),
  KEY `marked_FKIndex3` (`marked_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_officers`
--

CREATE TABLE IF NOT EXISTS `tbl_officers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT 'Title of the officers',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_officers`
--

INSERT INTO `tbl_officers` (`id`, `title`) VALUES
(1, 'Accountant General'),
(2, 'Additional Accountant General'),
(3, 'Deputy Accountant General (Admn/C&M)'),
(4, 'Deputy Accountant General (Payrolls)'),
(5, 'Deputy Accountant General (Accounts)'),
(6, 'Deputy Accountant General (Funds & Pension)'),
(7, 'Accounts Officer (Admn)'),
(8, 'Accounts Officer (Pension)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL COMMENT 'Username',
  `password` varchar(255) DEFAULT NULL COMMENT 'Password',
  `officer_id` int(10) unsigned NOT NULL COMMENT 'ID of the officer to whom user is attached',
  PRIMARY KEY (`id`),
  KEY `tbl_users_FKIndex1` (`officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `officer_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'ico', '65f034c0f853471ed478ceb34164523b', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_disposal`
--
ALTER TABLE `tbl_disposal`
  ADD CONSTRAINT `tbl_disposal_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `tbl_documents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_disposal_ibfk_2` FOREIGN KEY (`officer_id`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_marked`
--
ALTER TABLE `tbl_marked`
  ADD CONSTRAINT `tbl_marked_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `tbl_documents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_marked_ibfk_2` FOREIGN KEY (`officer_id`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_marked_ibfk_3` FOREIGN KEY (`marked_by`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`officer_id`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
