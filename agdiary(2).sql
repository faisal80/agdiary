-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2012 at 08:13 PM
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
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_disposal_FKIndex1` (`document_id`),
  KEY `tbl_disposal_FKIndex2` (`officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_disposal`
--

INSERT INTO `tbl_disposal` (`id`, `document_id`, `officer_id`, `disposal_date`, `disposal`, `create_time`, `create_user`, `update_time`, `update_user`) VALUES
(1, 3, 3, '2011-12-31', 'Order of Upgradation issued vide O.O No. AC(5)/345 dated: 31/12/2011', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 2, 2, '2012-03-16', 'Funds Released', '2012-03-16 17:31:07', 3, '2012-03-18 16:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE IF NOT EXISTS `tbl_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `diary_number` int(11) NOT NULL,
  `date_received` date NOT NULL COMMENT 'Date the document received',
  `reference_number` varchar(255) DEFAULT NULL COMMENT 'Reference Number of the document',
  `date_of_document` date DEFAULT NULL COMMENT 'Date of Document',
  `received_from` varchar(255) DEFAULT NULL COMMENT 'From whom the document is received',
  `description` text COMMENT 'Description about the document',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tbl_documents`
--

INSERT INTO `tbl_documents` (`id`, `diary_number`, `date_received`, `reference_number`, `date_of_document`, `received_from`, `description`, `create_time`, `create_user`, `update_time`, `update_user`) VALUES
(1, 4536, '2012-03-18', 'DG/PHA/Admn/Staff/2345', '2012-01-15', 'Provincial Housing Authority', 'Release of Rs. 30 million under ADP Scheme No. 945-55464', '0000-00-00 00:00:00', 0, '2012-03-18 14:53:45', 2),
(2, 0, '2011-12-12', 'SOE/HOUSING/4-5/2002/1234', '2011-12-10', 'Housing Department, Peshawar', 'Authorization of Funds.', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 0, '2011-12-01', 'CGA/234', '2011-12-05', 'CGA, Islamabad', 'Upgradation of posts.', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 0, '2012-03-05', 'DG/PHA/Admn/PF/Faisal/Prog/5483', '2012-03-01', 'Provincial Housing Authority', 'ACR Forms', '2012-03-09 17:50:58', 1, '2012-03-09 17:50:58', 1),
(5, 0, '2012-03-10', 'DG/PHA/Admn/PF/Faisal/Prog/548354', '2012-01-04', 'Provincial Housing Authority', 'asergbyy', '2012-03-10 13:38:43', 1, '2012-03-10 13:38:43', 1),
(7, 0, '2012-03-10', 'CGA/ISB/5', '2012-01-01', 'CGA, Islamabad', 'Most Immediate', '2012-03-10 17:40:26', 1, '2012-03-10 17:40:26', 1),
(8, 4512, '2012-03-13', 'DIG/PESH/3450', '2012-03-11', 'DIG Police, Peshawar', 'Security of AG Office', '2012-03-13 11:54:39', 1, '2012-03-13 11:54:39', 1),
(9, 4863, '2012-03-14', 'DG/PHA/Admn/PF/Faisal/Prog/5412', '2012-03-05', 'Provincial Housing Authority', 'to check', '2012-03-13 20:14:54', 1, '2012-03-13 20:14:54', 1),
(10, 4515, '2012-03-16', 'DG/PHA/Admn/PF/Faisal/Prog/5412', '2012-01-01', 'CGA, Islamabad', 'Letter 1', '2012-03-16 10:45:46', 1, '2012-03-16 10:45:46', 1),
(11, 4512, '2012-03-16', 'DG/PHA/Admn/PF/Faisal/Prog/2', '2012-01-02', 'Provincial Housing Authority', 'letter 2', '2012-03-16 10:46:25', 1, '2012-03-16 10:46:25', 1),
(12, 4512, '2012-03-16', 'DG/PHA/Admn/PF/Faisal/Prog/3', '2012-01-03', 'CGA, Islamabad', 'letter 3', '2012-03-16 10:46:59', 1, '2012-03-16 10:46:59', 1),
(13, 0, '0000-00-00', 'reference_number', '0000-00-00', 'received_from', 'description', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 1, '2012-01-01', 'CGA/ESTT/1', '2012-01-01', 'CGA, Islamabad', 'Letter 1', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1),
(15, 2, '2012-01-02', 'CGA/ESTT/2', '2012-01-02', 'CGA, Islamabad', 'Letter 2', '0000-00-00 00:00:00', 2, '0000-00-00 00:00:00', 2),
(16, 3, '2012-01-03', 'CGA/ESTT/3', '2012-01-03', 'CGA, Islamabad', 'Letter 3', '0000-00-00 00:00:00', 3, '0000-00-00 00:00:00', 3),
(17, 4, '2012-01-04', 'CGA/ESTT/4', '2012-01-04', 'CGA, Islamabad', 'Letter 4', '0000-00-00 00:00:00', 4, '0000-00-00 00:00:00', 4),
(18, 5, '2012-01-05', 'CGA/ESTT/5', '2012-01-05', 'CGA, Islamabad', 'Letter 5', '0000-00-00 00:00:00', 5, '0000-00-00 00:00:00', 5),
(19, 6, '2012-01-06', 'CGA/ESTT/6', '2012-01-06', 'CGA, Islamabad', 'Letter 6', '0000-00-00 00:00:00', 6, '0000-00-00 00:00:00', 6),
(20, 7, '2012-01-07', 'CGA/ESTT/7', '2012-01-07', 'CGA, Islamabad', 'Letter 7', '0000-00-00 00:00:00', 7, '0000-00-00 00:00:00', 7),
(21, 8, '2012-01-08', 'CGA/ESTT/8', '2012-01-08', 'CGA, Islamabad', 'Letter 8', '0000-00-00 00:00:00', 8, '0000-00-00 00:00:00', 8),
(22, 9, '2012-01-09', 'CGA/ESTT/9', '2012-01-09', 'CGA, Islamabad', 'Letter 9', '0000-00-00 00:00:00', 9, '0000-00-00 00:00:00', 9),
(23, 10, '2012-01-10', 'CGA/ESTT/10', '2012-01-10', 'CGA, Islamabad', 'Letter 10', '0000-00-00 00:00:00', 10, '0000-00-00 00:00:00', 10),
(24, 11, '2012-01-11', 'CGA/ESTT/11', '2012-01-11', 'CGA, Islamabad', 'Letter 11', '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00', 11),
(25, 12, '2012-01-12', 'CGA/ESTT/12', '2012-01-12', 'CGA, Islamabad', 'Letter 12', '0000-00-00 00:00:00', 12, '0000-00-00 00:00:00', 12),
(26, 13, '2012-01-13', 'CGA/ESTT/13', '2012-01-13', 'CGA, Islamabad', 'Letter 13', '0000-00-00 00:00:00', 13, '0000-00-00 00:00:00', 13),
(27, 14, '2012-01-14', 'CGA/ESTT/14', '2012-01-14', 'CGA, Islamabad', 'Letter 14', '0000-00-00 00:00:00', 14, '0000-00-00 00:00:00', 14),
(28, 15, '2012-01-15', 'CGA/ESTT/15', '2012-01-15', 'CGA, Islamabad', 'Letter 15', '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 15),
(29, 16, '2012-01-16', 'CGA/ESTT/16', '2012-01-16', 'CGA, Islamabad', 'Letter 16', '0000-00-00 00:00:00', 16, '0000-00-00 00:00:00', 16),
(30, 17, '2012-01-17', 'CGA/ESTT/17', '2012-01-17', 'CGA, Islamabad', 'Letter 17', '0000-00-00 00:00:00', 17, '0000-00-00 00:00:00', 17),
(31, 18, '2012-01-18', 'CGA/ESTT/18', '2012-01-18', 'CGA, Islamabad', 'Letter 18', '0000-00-00 00:00:00', 18, '0000-00-00 00:00:00', 18),
(32, 19, '2012-01-19', 'CGA/ESTT/19', '2012-01-19', 'CGA, Islamabad', 'Letter 19', '0000-00-00 00:00:00', 19, '0000-00-00 00:00:00', 19),
(33, 20, '2012-01-20', 'CGA/ESTT/20', '2012-01-20', 'CGA, Islamabad', 'Letter 20', '0000-00-00 00:00:00', 20, '0000-00-00 00:00:00', 20),
(34, 21, '2012-01-21', 'CGA/ESTT/21', '2012-01-21', 'CGA, Islamabad', 'Letter 21', '0000-00-00 00:00:00', 21, '0000-00-00 00:00:00', 21),
(35, 22, '2012-01-22', 'CGA/ESTT/22', '2012-01-22', 'CGA, Islamabad', 'Letter 22', '0000-00-00 00:00:00', 22, '0000-00-00 00:00:00', 22),
(36, 23, '2012-01-23', 'CGA/ESTT/23', '2012-01-23', 'CGA, Islamabad', 'Letter 23', '0000-00-00 00:00:00', 23, '0000-00-00 00:00:00', 23),
(37, 24, '2012-01-24', 'CGA/ESTT/24', '2012-01-24', 'CGA, Islamabad', 'Letter 24', '0000-00-00 00:00:00', 24, '0000-00-00 00:00:00', 24),
(38, 25, '2012-01-25', 'CGA/ESTT/25', '2012-01-25', 'CGA, Islamabad', 'Letter 25', '0000-00-00 00:00:00', 25, '0000-00-00 00:00:00', 25),
(39, 26, '2012-01-26', 'CGA/ESTT/26', '2012-01-26', 'CGA, Islamabad', 'Letter 26', '0000-00-00 00:00:00', 26, '0000-00-00 00:00:00', 26),
(40, 27, '2012-01-27', 'CGA/ESTT/27', '2012-01-27', 'CGA, Islamabad', 'Letter 27', '0000-00-00 00:00:00', 27, '0000-00-00 00:00:00', 27),
(41, 28, '2012-01-28', 'CGA/ESTT/28', '2012-01-28', 'CGA, Islamabad', 'Letter 28', '0000-00-00 00:00:00', 28, '0000-00-00 00:00:00', 28),
(42, 29, '2012-01-29', 'CGA/ESTT/29', '2012-01-29', 'CGA, Islamabad', 'Letter 29', '0000-00-00 00:00:00', 29, '0000-00-00 00:00:00', 29),
(43, 30, '2012-01-30', 'CGA/ESTT/30', '2012-01-30', 'CGA, Islamabad', 'Letter 30', '0000-00-00 00:00:00', 30, '0000-00-00 00:00:00', 30),
(44, 4863, '2012-03-17', 'DG/PHA/Admn/PF/Faisal/Prog/5412', '2012-03-04', 'Provincial Housing Authority', 'lkjh hkjl', '2012-03-17 17:24:09', 3, '2012-03-17 17:24:09', 3),
(45, 34345, '2012-03-17', 'CGA/ISB/5', '2012-03-06', 'CGA, Islamabad', 'asdbbaf sdfg ', '2012-03-17 17:27:28', 3, '2012-03-17 17:27:28', 3);

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `marked_FKIndex1` (`document_id`),
  KEY `marked_FKIndex2` (`officer_id`),
  KEY `marked_FKIndex3` (`marked_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_marked`
--

INSERT INTO `tbl_marked` (`id`, `document_id`, `officer_id`, `marked_by`, `marked_date`, `time_limit`, `create_time`, `create_user`, `update_time`, `update_user`) VALUES
(1, 1, 2, 1, '2012-01-28', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 2, 2, 1, '2011-12-12', 3, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 3, 3, 1, '2011-12-05', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 1, 4, 1, '2012-02-06', 0, '0000-00-00 00:00:00', 0, '2012-03-10 16:46:00', 1),
(5, 4, 3, 2, '2012-03-05', 0, '2012-03-09 17:52:09', 3, '2012-03-09 17:52:09', 3),
(6, 5, 5, 1, '2012-03-07', 0, '2012-03-10 16:47:53', 1, '2012-03-10 16:47:53', 1),
(7, 7, 3, 1, '2012-03-02', 0, '2012-03-10 17:40:49', 1, '2012-03-10 17:40:49', 1),
(9, 9, 2, 1, '2012-03-13', 0, '2012-03-13 20:15:07', 1, '2012-03-13 20:15:07', 1),
(10, 10, 2, 1, '2012-01-02', 0, '2012-03-16 11:13:28', 1, '2012-03-16 11:13:28', 1),
(11, 14, 3, 1, '2012-01-03', 0, '2012-03-16 12:11:08', 1, '2012-03-16 12:11:08', 1),
(12, 15, 4, 1, '2012-01-05', 0, '2012-03-16 12:11:30', 1, '2012-03-16 12:11:30', 1),
(13, 16, 2, 1, '2012-01-04', 0, '2012-03-16 12:12:13', 1, '2012-03-16 12:12:13', 1),
(14, 17, 2, 1, '2012-01-06', 0, '2012-03-16 12:12:35', 1, '2012-03-16 12:12:35', 1),
(15, 18, 5, 1, '2012-01-07', 0, '2012-03-16 12:13:02', 1, '2012-03-16 12:13:02', 1),
(16, 43, 2, 1, '2012-01-30', 0, '2012-03-16 12:13:45', 1, '2012-03-16 12:13:45', 1),
(17, 42, 6, 1, '2012-01-28', 0, '2012-03-16 12:14:10', 1, '2012-03-16 12:14:10', 1),
(18, 41, 2, 1, '2012-01-28', 0, '2012-03-16 12:14:27', 1, '2012-03-16 12:14:27', 1),
(19, 40, 5, 1, '2012-01-27', 0, '2012-03-16 12:14:57', 1, '2012-03-16 12:14:57', 1),
(20, 39, 3, 1, '2012-01-26', 0, '2012-03-16 12:15:22', 1, '2012-03-16 12:15:22', 1),
(21, 8, 4, 1, '2012-03-13', 0, '2012-03-16 18:39:20', 1, '2012-03-16 18:41:50', 1),
(22, 11, 4, 1, '2012-03-11', 0, '2012-03-16 18:43:44', 1, '2012-03-16 18:43:44', 1),
(23, 44, 1, 2, '2012-03-17', 0, '2012-03-17 17:26:01', 3, '2012-03-17 17:26:01', 3),
(24, 45, 1, 2, '2012-03-17', 0, '2012-03-17 17:27:36', 3, '2012-03-17 17:27:36', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_officers`
--

CREATE TABLE IF NOT EXISTS `tbl_officers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT 'Title of the officers',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_officers`
--

INSERT INTO `tbl_officers` (`id`, `title`, `create_time`, `create_user`, `update_time`, `update_user`) VALUES
(1, 'Accountant General', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'Additional Accountant General', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'Deputy Accountant General (Admn/C&M)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'Deputy Accountant General (Payrolls)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 'Deputy Accountant General (Accounts)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 'Deputy Accountant General (Funds & Pension)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 'Accounts Officer (Admn)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 'Accounts Officer (Pension)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL COMMENT 'Username',
  `password` varchar(255) DEFAULT NULL COMMENT 'Password',
  `officer_id` int(10) unsigned NOT NULL COMMENT 'ID of the officer to whom user is attached',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_users_FKIndex1` (`officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `officer_id`, `create_time`, `create_user`, `update_time`, `update_user`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'ag', '4e42f7dd43ecbfe104de58610557c5ba', 1, '0000-00-00 00:00:00', 0, '2012-03-17 18:50:44', 3),
(3, 'ico', '65f034c0f853471ed478ceb34164523b', 1, '2012-03-09 17:49:52', 1, '2012-03-17 18:51:04', 3),
(4, 'aag', '32ee8ad114363edfb0b9389f79409245', 2, '2012-03-17 18:51:27', 3, '2012-03-17 18:51:27', 3),
(5, 'dagadmin', '710645d52f63f396f8297c181187b775', 3, '2012-03-17 20:31:11', 1, '2012-03-17 20:31:11', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_disposal`
--
ALTER TABLE `tbl_disposal`
  ADD CONSTRAINT `tbl_disposal_ibfk_3` FOREIGN KEY (`document_id`) REFERENCES `tbl_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_disposal_ibfk_4` FOREIGN KEY (`officer_id`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_marked`
--
ALTER TABLE `tbl_marked`
  ADD CONSTRAINT `tbl_marked_ibfk_4` FOREIGN KEY (`document_id`) REFERENCES `tbl_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_marked_ibfk_5` FOREIGN KEY (`officer_id`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_marked_ibfk_6` FOREIGN KEY (`marked_by`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`officer_id`) REFERENCES `tbl_officers` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
