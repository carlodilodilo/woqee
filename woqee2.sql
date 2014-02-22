-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2014 at 06:32 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `woqee2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_company` int(11) DEFAULT NULL,
  `a_email` varchar(250) DEFAULT NULL,
  `a_password` varchar(250) DEFAULT NULL,
  `a_fname` varchar(250) DEFAULT NULL,
  `a_mname` varchar(250) DEFAULT NULL,
  `a_lname` varchar(250) DEFAULT NULL,
  `a_photo` varchar(250) DEFAULT NULL,
  `a_type` tinyint(4) DEFAULT NULL,
  `a_added` datetime DEFAULT NULL,
  `a_dateupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `TBL_UNIQUE` (`a_email`,`a_type`,`a_company`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`a_id`, `a_company`, `a_email`, `a_password`, `a_fname`, `a_mname`, `a_lname`, `a_photo`, `a_type`, `a_added`, `a_dateupdated`) VALUES
(1, 1, 'sample@sample.com', '5e8ff9bf55ba3508199d22e984129be6', 'First', 'Middle', 'Last', 'sample.gif', 1, '2013-12-19 00:00:00', '2013-12-19 08:00:00'),
(32, 1, 'sample2@sample.com', '5e8ff9bf55ba3508199d22e984129be6', 'First', 'Middle', 'Last', NULL, 3, '2014-01-07 01:16:01', '2014-01-07 09:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `admins_type`
--

CREATE TABLE IF NOT EXISTS `admins_type` (
  `at_type` int(11) NOT NULL AUTO_INCREMENT,
  `at_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`at_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admins_type`
--

INSERT INTO `admins_type` (`at_type`, `at_desc`) VALUES
(1, 'Company Administrator'),
(2, 'Company Officer'),
(3, 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_desc` varchar(250) NOT NULL,
  `c_dateadded` date NOT NULL,
  `c_dateupdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `c_desc`, `c_dateadded`, `c_dateupdated`) VALUES
(1, 'Pascual Laboratories', '2013-12-21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_aid` int(11) NOT NULL,
  `d_photo` varchar(250) DEFAULT NULL,
  `d_bday` date DEFAULT NULL,
  `d_added` datetime DEFAULT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `d_aid`, `d_photo`, `d_bday`, `d_added`) VALUES
(2, 32, NULL, '1996-01-05', '2014-01-08 01:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_details`
--

CREATE TABLE IF NOT EXISTS `doctors_details` (
  `dd_id` int(11) NOT NULL AUTO_INCREMENT,
  `dd_premed` varchar(255) NOT NULL,
  `dd_medicine` varchar(255) NOT NULL,
  `dd_residency` varchar(255) NOT NULL,
  `dd_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `dd_did` int(11) NOT NULL,
  PRIMARY KEY (`dd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `doctors_details`
--

INSERT INTO `doctors_details` (`dd_id`, `dd_premed`, `dd_medicine`, `dd_residency`, `dd_updated`, `dd_did`) VALUES
(1, '', '', '', '2014-01-08 09:16:48', 0),
(2, '', '', '', '2014-01-08 09:17:04', 0),
(3, '', '', '', '2014-01-08 09:17:29', 0),
(4, '', '', '', '2014-01-08 09:17:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_registrations`
--

CREATE TABLE IF NOT EXISTS `doctors_registrations` (
  `dr_id` int(11) NOT NULL AUTO_INCREMENT,
  `dr_aid` int(11) DEFAULT NULL,
  `dr_email` varchar(250) NOT NULL,
  `dr_status` enum('pending','active') NOT NULL DEFAULT 'pending',
  `dr_company` int(11) NOT NULL,
  `dr_company_admin` int(11) DEFAULT NULL,
  `dr_link` text,
  `dr_dateadded` date NOT NULL,
  `dr_dateupdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `doctors_registrations`
--

INSERT INTO `doctors_registrations` (`dr_id`, `dr_aid`, `dr_email`, `dr_status`, `dr_company`, `dr_company_admin`, `dr_link`, `dr_dateadded`, `dr_dateupdated`) VALUES
(1, 32, 'sample2@sample.com', 'active', 1, 1, 'c2FtcGxlMkBzYW1wbGUuY29tfDE=', '2014-01-07', '2014-01-07 09:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_specializations`
--

CREATE TABLE IF NOT EXISTS `doctors_specializations` (
  `ds_did` int(11) NOT NULL,
  `ds_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors_specializations`
--

INSERT INTO `doctors_specializations` (`ds_did`, `ds_desc`) VALUES
(1, 'Spec1'),
(1, 'Spec2'),
(1, 'Spec3'),
(2, 'Spec1'),
(2, 'Spec2');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_status`
--

CREATE TABLE IF NOT EXISTS `doctors_status` (
  `dsid` int(11) NOT NULL AUTO_INCREMENT,
  `dsdesc` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`dsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_dateadded` datetime NOT NULL,
  `e_company` int(11) NOT NULL,
  `e_name` varchar(250) NOT NULL,
  `e_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `e_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `e_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`e_id`, `e_dateadded`, `e_company`, `e_name`, `e_date`, `e_start`, `e_end`) VALUES
(1, '2013-12-26 19:27:49', 1, 'Sample Event', '2013-12-27 08:00:00', '2013-12-27 08:20:00', '2013-12-27 09:00:00'),
(2, '2013-12-26 19:33:48', 1, 'Sample Event 2', '2013-12-28 08:00:00', '2013-12-27 08:20:00', '2013-12-27 09:00:00'),
(4, '2013-12-29 02:43:06', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(5, '2013-12-29 02:43:27', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(6, '2013-12-29 03:00:50', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(7, '2013-12-29 03:02:20', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(8, '2013-12-29 03:02:22', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(9, '2013-12-29 03:09:52', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(10, '2013-12-29 03:11:50', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(11, '2013-12-29 13:53:21', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(12, '2013-12-29 13:55:39', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(13, '2013-12-29 13:56:14', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(14, '2013-12-29 13:56:24', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(15, '2013-12-29 13:56:32', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(16, '2013-12-29 13:57:56', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(17, '2013-12-29 13:58:10', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(18, '2013-12-29 13:58:14', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(19, '2013-12-29 14:03:30', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(20, '2013-12-29 14:03:38', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(21, '2013-12-29 14:03:59', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(22, '2013-12-29 14:04:03', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00'),
(23, '2013-12-29 14:05:44', 1, '0', '1970-01-01 09:00:00', '1970-01-01 09:00:00', '1970-01-01 09:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
