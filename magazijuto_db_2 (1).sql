-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3388
-- Generation Time: Nov 05, 2018 at 07:57 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magazijuto_db_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_balance`
--

CREATE TABLE `account_balance` (
  `account_date` date NOT NULL,
  `crdb` double DEFAULT NULL,
  `mpesa` double DEFAULT NULL,
  `tpesa` double DEFAULT NULL,
  `miss` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assosiated_loan`
--

CREATE TABLE `assosiated_loan` (
  `id` int(11) NOT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loan_no` varchar(15) NOT NULL,
  `processedby` varchar(30) NOT NULL,
  `deadline` date NOT NULL,
  `loan_date` date NOT NULL,
  `payment` date DEFAULT NULL,
  `loan_amount` double NOT NULL,
  `status` varchar(15) NOT NULL,
  `payed_amont` double NOT NULL,
  `comment` text NOT NULL,
  `rate` int(11) NOT NULL,
  `rate_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `money_location` varchar(30) DEFAULT NULL,
  `activities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assosiated_loan`
--

INSERT INTO `assosiated_loan` (`id`, `transaction_time`, `loan_no`, `processedby`, `deadline`, `loan_date`, `payment`, `loan_amount`, `status`, `payed_amont`, `comment`, `rate`, `rate_amount`, `total_amount`, `money_location`, `activities`) VALUES
(4, '2018-11-04 09:01:43', 'AE1013', 'Admin', '2018-11-04', '2018-11-04', '2018-11-04', 40000, 'Confirm', 48000, 'WEB FROM 2018-11-29', 20, 8000, 48000, 'crdb', '[{\"period\":\"2018-11-04 10:32:30\",\"user\":\"Admin\",\"value\":\"created\"}]'),
(5, '2018-11-04 09:20:25', 'AE1014', 'Admin', '2018-11-04', '2018-11-04', '2018-11-04', 30000, 'Confirm', 36000, 'WEB FROM 2018-11-05', 20, 6000, 36000, 'crdb', '[{\"period\":\"2018-11-04 12:19:12\",\"user\":\"Admin\",\"value\":\"created\"}]'),
(6, '2018-11-04 09:36:11', 'AE1015', 'Admin', '2018-11-04', '2018-11-04', '2018-11-04', 60000, 'Confirm', 72000, 'WEB FROM 2018-11-04', 20, 12000, 72000, 'crdb', '[{\"period\":\"2018-11-04 12:34:40\",\"user\":\"Admin\",\"value\":\"created\"}]'),
(7, '2018-11-04 10:17:11', 'AE1016', 'Admin', '2018-11-04', '2018-11-04', '2018-11-04', 600000, 'Confirm', 720000, 'WEB FROM 2018-11-30', 20, 120000, 720000, 'crdb', '[{\"period\":\"2018-11-04 13:01:20\",\"user\":\"Admin\",\"value\":\"created\"},{\"period\":\"2018-11-04 13:03:18\",\"user\":\"Admin\",\"value\":\"created\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `balance_movement`
--

CREATE TABLE `balance_movement` (
  `id` int(11) NOT NULL,
  `move_num` varchar(10) DEFAULT NULL,
  `date_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `investor` varchar(25) DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `devident` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `comment` text,
  `status` varchar(15) DEFAULT 'not_payed',
  `activities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `balance_movement`
--

INSERT INTO `balance_movement` (`id`, `move_num`, `date_check`, `investor`, `debit`, `credit`, `devident`, `balance`, `comment`, `status`, `activities`) VALUES
(1001, 'MV1001', '2018-10-22 06:11:54', 'Amani_Nguku', 0, 188000, 0, 188000, 'comment', 'not_payed', '[{\"period\":\"2018-10-22 09:11:54\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1002, 'MV1002', '2018-10-22 07:08:36', 'Amani_Nguku', 120000, 0, 24000, 68000, 'Amekopeshwa AE1012', 'not_payed', '[{\"period\":\"2018-10-22 10:08:36\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1003, 'MV1003', '2018-10-22 12:46:10', 'Amani_Nguku', 0, 10000, 0, 78000, 'Mkopo AE1012 Umerekebishwa', 'not_payed', '[{\"period\":\"2018-10-22 15:46:11\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1004, 'MV1004', '2018-10-24 13:07:57', NULL, 0, 132000, 0, 0, 'Amelipa AE1012', 'not_payed', '[{\"period\":\"2018-10-24 16:07:58\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1005, 'MV1005', '2018-10-24 13:11:22', NULL, 0, 132000, 0, 0, 'Amelipa AE1012', 'not_payed', '[{\"period\":\"2018-10-24 16:11:22\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1006, 'MV1006', '2018-10-24 13:20:11', NULL, 0, 132000, 0, 0, 'Amelipa AE1012', 'not_payed', '[{\"period\":\"2018-10-24 16:20:11\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1007, 'MV1007', '2018-10-28 06:05:00', 'Amani_Nguku', 0, 5000000000, 0, 5000210000, 'give away', 'not_payed', '[{\"period\":\"2018-10-28 09:05:00\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1008, 'MV1008', '2018-10-28 06:46:46', 'Amani_Nguku', 0, 5000000000, 0, 10000210000, 'hhjhgjhgjhg', 'not_payed', '[{\"period\":\"2018-10-28 09:46:47\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1009, 'MV1009', '2018-10-28 06:47:08', 'Amani_Nguku', 0, 5000000000, 0, 15000210000, 'hg', 'not_payed', '[{\"period\":\"2018-10-28 09:47:08\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1010, 'MV1010', '2018-10-28 06:47:47', 'Amani_Nguku', 0, 5000000000, 0, 20000210000, 'yty', 'not_payed', '[{\"period\":\"2018-10-28 09:47:47\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1011, 'MV1011', '2018-10-28 06:48:06', 'Amani_Nguku', 5000000000, 0, 0, 15000210000, 'i', 'not_payed', '[{\"period\":\"2018-10-28 09:48:06\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1012, 'MV1012', '2018-10-28 06:48:16', 'Amani_Nguku', 5000000000, 0, 0, 10000210000, 'ii', 'not_payed', '[{\"period\":\"2018-10-28 09:48:16\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1013, 'MV1013', '2018-10-28 06:48:27', 'Amani_Nguku', 5000000000, 0, 0, 5000210000, 'ii', 'not_payed', '[{\"period\":\"2018-10-28 09:48:28\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1014, 'MV1014', '2018-10-28 06:48:41', 'Amani_Nguku', 5000000000, 0, 0, 210000, 'ii', 'not_payed', '[{\"period\":\"2018-10-28 09:48:42\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Amani_Nguku\",\"loan_no\":\"\"}}]'),
(1015, 'MV1015', '2018-10-28 08:21:52', 'Amani_Nguku', 10000, 0, 2000, 200000, 'Mkopo AE1012 Umerekebishwa', 'not_payed', '[{\"period\":\"2018-10-28 11:21:52\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1016, 'MV1016', '2018-10-30 13:23:44', 'Amani_Nguku', 0, 144000, 0, 344000, 'Amelipa AE1012', 'not_payed', '[{\"period\":\"2018-10-30 16:23:45\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1012\"}}]'),
(1017, 'MV1017', '2018-10-30 14:11:53', 'Amani_Nguku', 200000, 0, 40000, 144000, 'Amekopeshwa AE1013', 'not_payed', '[{\"period\":\"2018-10-30 17:11:53\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1018, 'MV1018', '2018-11-04 06:42:36', 'Amani_Nguku', 0, 240000, 0, 384000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 09:42:36\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1019, 'MV1019', '2018-11-04 06:50:57', 'Amani_Nguku', 0, 240000, 0, 624000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 09:50:57\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1020, 'MV1020', '2018-11-04 06:56:08', 'Amani_Nguku', 0, 240000, 0, 864000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 09:56:08\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1021, 'MV1021', '2018-11-04 07:02:42', 'Amani_Nguku', 0, 240000, 0, 1104000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 10:02:42\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1022, 'MV1022', '2018-11-04 07:30:54', 'Amani_Nguku', 0, 240000, 0, 1344000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 10:30:55\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1023, 'MV1023', '2018-11-04 07:32:30', 'Amani_Nguku', 0, 240000, 0, 1584000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 10:32:31\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1024, 'MV1024', '2018-11-04 08:51:31', 'Amani_Nguku', 0, 48000, 0, 1632000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 11:51:31\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1025, 'MV1025', '2018-11-04 09:01:43', 'Amani_Nguku', 0, 48000, 0, 1680000, 'Amelipa AE1013', 'not_payed', '[{\"period\":\"2018-11-04 12:01:44\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1013\"}}]'),
(1026, 'MV1026', '2018-11-04 09:16:28', 'Amani_Nguku', 150000, 0, 30000, 1530000, 'Amekopeshwa AE1014', 'not_payed', '[{\"period\":\"2018-11-04 12:16:28\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1014\"}}]'),
(1027, 'MV1027', '2018-11-04 09:19:13', 'Amani_Nguku', 0, 180000, 0, 1710000, 'Amelipa AE1014', 'not_payed', '[{\"period\":\"2018-11-04 12:19:13\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1014\"}}]'),
(1028, 'MV1028', '2018-11-04 09:20:25', 'Amani_Nguku', 0, 36000, 0, 1746000, 'Amelipa AE1014', 'not_payed', '[{\"period\":\"2018-11-04 12:20:26\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1014\"}}]'),
(1029, 'MV1029', '2018-11-04 09:33:42', 'Amani_Nguku', 300000, 0, 60000, 1446000, 'Amekopeshwa AE1015', 'not_payed', '[{\"period\":\"2018-11-04 12:33:42\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1015\"}}]'),
(1030, 'MV1030', '2018-11-04 09:34:41', 'Amani_Nguku', 0, 360000, 0, 1806000, 'Amelipa AE1015', 'not_payed', '[{\"period\":\"2018-11-04 12:34:41\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1015\"}}]'),
(1031, 'MV1031', '2018-11-04 09:36:11', 'Amani_Nguku', 0, 72000, 0, 1878000, 'Amelipa AE1015', 'not_payed', '[{\"period\":\"2018-11-04 12:36:11\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1015\"}}]'),
(1032, 'MV1032', '2018-11-04 09:56:48', 'Amani_Nguku', 600000, 0, 120000, 1278000, 'Amekopeshwa AE1016', 'not_payed', '[{\"period\":\"2018-11-04 12:56:49\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1016\"}}]'),
(1033, 'MV1033', '2018-11-04 10:01:20', 'Amani_Nguku', 0, 720000, 0, 1998000, 'Amelipa AE1016', 'not_payed', '[{\"period\":\"2018-11-04 13:01:20\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1016\"}}]'),
(1034, 'MV1034', '2018-11-04 10:03:19', 'Amani_Nguku', 0, 720000, 0, 2718000, 'Amelipa AE1016', 'not_payed', '[{\"period\":\"2018-11-04 13:03:19\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1016\"}}]'),
(1035, 'MV1035', '2018-11-04 10:17:11', 'Amani_Nguku', 0, 720000, 0, 3438000, 'Amelipa AE1016', 'not_payed', '[{\"period\":\"2018-11-04 13:17:11\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Admin\",\"loan_no\":\"AE1016\"}}]'),
(1036, 'MV1036', '2018-11-04 12:31:13', 'Amani_Nguku', 300000, 0, 60000, 3138000, 'Amekopeshwa AE1017', 'not_payed', '[{\"period\":\"2018-11-04 15:31:13\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Hemedi_Mshamu\",\"loan_no\":\"AE1017\"}}]'),
(1037, 'MV1037', '2018-11-04 12:33:10', 'Amani_Nguku', 10000, 0, 2000, 3128000, 'Mkopo AE1017 Umerekebishwa', 'not_payed', '[{\"period\":\"2018-11-04 15:33:10\",\"user\":\"Admin\",\"value\":{\"user\":\"Admin\",\"account\":\"Hemedi_Mshamu\",\"loan_no\":\"AE1017\"}}]');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `idbranch` varchar(30) NOT NULL,
  `branchname` text,
  `branchmanager` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`idbranch`, `branchname`, `branchmanager`) VALUES
('Head_Quarter', 'Head Quarter', 'Amani_Nguku');

-- --------------------------------------------------------

--
-- Table structure for table `capital_movement`
--

CREATE TABLE `capital_movement` (
  `capital_day` date NOT NULL DEFAULT '0000-00-00',
  `capital_fixed` double DEFAULT NULL,
  `capital_loan` double DEFAULT NULL,
  `capital_rate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capital_movement`
--

INSERT INTO `capital_movement` (`capital_day`, `capital_fixed`, `capital_loan`, `capital_rate`) VALUES
('2018-10-21', 0, 0, 0),
('2018-10-24', 0, 0, 0),
('2018-10-25', 0, 110000, 22000),
('2018-10-30', 0, 0, 0),
('2018-11-04', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `cms_id` int(11) NOT NULL,
  `cms_number` varchar(13) DEFAULT NULL,
  `cert_id` varchar(27) NOT NULL DEFAULT '0',
  `clevel` varchar(25) NOT NULL DEFAULT '0',
  `cms_for_user` varchar(20) NOT NULL,
  `receiving_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `receiving_location` varchar(40) DEFAULT NULL,
  `receiver_name` varchar(40) DEFAULT NULL,
  `receiver_deliver` varchar(40) DEFAULT NULL,
  `receiver_comment` text,
  `receiver_attachment` varchar(50) DEFAULT NULL,
  `dispatch_date` timestamp NULL DEFAULT NULL,
  `dispatch_location` varchar(40) DEFAULT NULL,
  `dispatch_name` varchar(40) DEFAULT NULL,
  `dispatch_deliver` varchar(40) DEFAULT NULL,
  `dispatch_comment` text,
  `dispatch_attachment` varchar(50) DEFAULT NULL,
  `cms_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`cms_id`, `cms_number`, `cert_id`, `clevel`, `cms_for_user`, `receiving_date`, `receiving_location`, `receiver_name`, `receiver_deliver`, `receiver_comment`, `receiver_attachment`, `dispatch_date`, `dispatch_location`, `dispatch_name`, `dispatch_deliver`, `dispatch_comment`, `dispatch_attachment`, `cms_status`) VALUES
(10011, 'CMS10011', 'ABS5676', '5', 'Admin', '2018-10-21 11:39:26', 'Golden Tulip', 'Admin Admin', 'Some one', 'I received well', '', NULL, NULL, NULL, NULL, NULL, NULL, 'present'),
(10012, 'CMS10012', 'AB6745', '5', 'Hemedi_Mshamu', '2018-11-04 12:29:46', 'Mbagla Charambe', 'Admin Admin', 'Hemedi Mshamu', 'Commenting', '', NULL, NULL, NULL, NULL, NULL, NULL, 'present');

-- --------------------------------------------------------

--
-- Table structure for table `commision`
--

CREATE TABLE `commision` (
  `idcom` int(11) NOT NULL,
  `com` int(2) DEFAULT NULL,
  `state` varchar(10) DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commision`
--

INSERT INTO `commision` (`idcom`, `com`, `state`) VALUES
(17, 20, 'on'),
(18, 10, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `commision_state`
--

CREATE TABLE `commision_state` (
  `loanno` varchar(20) NOT NULL,
  `state` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deducation`
--

CREATE TABLE `deducation` (
  `group_id` varchar(14) NOT NULL,
  `amount` double NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '1',
  `activities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deducation`
--

INSERT INTO `deducation` (`group_id`, `amount`, `deleted`, `activities`) VALUES
('admin', 5000000000, 0, '[{\"period\":\"2018-10-28 09:46:26\",\"user\":\"Admin\",\"value\":\"created\"}]'),
('chair_man', 5000000000, 0, '[{\"period\":\"2018-10-28 01:10:24\",\"user\":\"Admin\",\"value\":\"created\"},{\"period\":\"2018-10-28 09:17:54\",\"user\":\"Admin\",\"value\":\"edited\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `user`, `email`) VALUES
(1, 'INFO', 'info@amajat.com');

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE `error_log` (
  `submitted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(50) DEFAULT NULL,
  `error` text,
  `loannumber` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `error_log`
--

INSERT INTO `error_log` (`submitted_time`, `username`, `error`, `loannumber`, `state`) VALUES
('2018-10-21 11:40:24', 'Admin', 'loanno not found (get_loan_from_hq)', '', 'New'),
('2018-10-21 11:41:07', 'Admin', 'loanno not found (get_loan_from_hq)', '', 'New'),
('2018-10-21 11:41:41', 'Admin', 'loanno not found (get_loan_from_hq)', '', 'New'),
('2018-10-21 11:41:59', 'Admin', 'loanno not found (get_loan_from_hq)', '', 'New'),
('2018-10-21 11:43:14', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-21 11:43:40', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-21 11:44:07', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-21 11:45:21', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-21 11:48:02', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-22 12:42:58', 'Admin', 'Has no sufficient balance (get_loan_from_investor)', 'Amani_Nguku', 'New'),
('2018-10-30 14:00:04', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:00:29', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:00:50', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:03:34', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:06:40', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:08:38', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:10:10', 'Admin', 'loanno not found (get_loan_from_investor)', '', 'New'),
('2018-10-30 14:12:51', 'Admin', 'Has no sufficient balance (get_loan_from_investor)', 'Amani_Nguku', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `global_variables`
--

CREATE TABLE `global_variables` (
  `variable_name` varchar(40) NOT NULL,
  `variable_value` varchar(70) NOT NULL,
  `shown` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_variables`
--

INSERT INTO `global_variables` (`variable_name`, `variable_value`, `shown`) VALUES
('MAXIMUM_LOAN_AMOUNT', '25000000', 1),
('MINIMUM_AMOUNT_TO_PAY', '500000', 1),
('MINIMUM_LOAN_AMOUNT', '1000', 1),
('MINIMUM_LOAN_AMOUNT_TO_PAY_BACK', '0', 1),
('PASSWORD_CHANGE_DAY', '10', 1),
('USER_ID', 'Amani_Sadock', 0),
('VIEW_NAV', 'navigation_view_base_01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `investor_table`
--

CREATE TABLE `investor_table` (
  `investor_no` varchar(30) NOT NULL,
  `investor_amount` double DEFAULT NULL,
  `has_branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investor_table`
--

INSERT INTO `investor_table` (`investor_no`, `investor_amount`, `has_branch`) VALUES
('Amani_Nguku', 3128000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_movement`
--

CREATE TABLE `loan_movement` (
  `id` int(11) NOT NULL,
  `loan_no` varchar(10) NOT NULL,
  `loan_from` varchar(45) DEFAULT NULL,
  `loan_manager` varchar(45) DEFAULT NULL,
  `borrower` varchar(45) DEFAULT NULL,
  `commision` int(11) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `branch_borrower` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `loan_track`
--

CREATE TABLE `loan_track` (
  `id` int(11) NOT NULL,
  `loan_number` varchar(45) DEFAULT NULL,
  `date_call` timestamp NULL DEFAULT NULL,
  `date_back` timestamp NULL DEFAULT NULL,
  `comment` text,
  `activities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_track`
--

INSERT INTO `loan_track` (`id`, `loan_number`, `date_call`, `date_back`, `comment`, `activities`) VALUES
(1968, 'AE1011', '2018-10-21 11:50:04', '2018-10-27 21:00:00', 'dssdsd', ''),
(1969, 'AE1011', '2018-10-21 11:52:28', '2018-10-27 21:00:00', 'dssdsd', ''),
(1970, 'AE1011', '2018-10-21 12:07:31', '2018-10-20 21:00:00', 'hhh', ''),
(1971, 'AE1011', '2018-10-21 15:52:07', '2018-10-21 21:00:00', 'payed tommorow', ''),
(1972, 'AE1011', '2018-10-21 15:54:01', '2018-10-21 21:00:00', 'payed tommorow', ''),
(1973, 'AE1011', '2018-10-21 16:33:23', '2018-10-21 16:33:23', 'hdhshsd', ''),
(1974, 'AE1012', '2018-10-22 07:08:36', '2018-10-28 21:00:00', 'comment', ''),
(1975, 'AE1012', '2018-10-22 07:25:34', '2018-10-22 07:25:34', 'comment', ''),
(1976, 'AE1012', '2018-10-22 12:46:10', '2018-10-28 21:00:00', 'comment', ''),
(1977, 'AE1012', '2018-10-24 13:07:58', '2018-10-24 13:07:58', 'jjnjnj', ''),
(1978, 'AE1012', '2018-10-24 13:11:22', '2018-10-24 13:11:22', ',kmkk', ''),
(1979, 'AE1012', '2018-10-24 13:20:11', '2018-10-24 13:20:11', 'jbjhbj', ''),
(1980, 'AE1012', '2018-10-24 13:33:07', '2018-10-24 13:33:07', 'jbjhbj', ''),
(1981, 'AE1012', '2018-10-28 08:21:52', '2018-10-28 21:00:00', 'comment', ''),
(1982, 'AE1012', '2018-10-30 13:23:45', '2018-10-30 13:23:45', 'nfvnfvnn', ''),
(1983, 'AE1013', '2018-10-30 14:11:53', '2018-11-28 21:00:00', 'mkmkm', ''),
(1984, 'AE1013', '2018-11-04 06:42:36', '2018-11-04 06:42:36', 'loan', ''),
(1985, 'AE1013', '2018-11-04 06:50:57', '2018-11-04 06:50:57', 'lia', ''),
(1986, 'AE1013', '2018-11-04 06:56:08', '2018-11-04 06:56:08', 'mkmkkmk', ''),
(1987, 'AE1013', '2018-11-04 07:02:42', '2018-11-04 07:02:42', ',lkklklkl', ''),
(1988, 'AE1013', '2018-11-04 07:30:55', '2018-11-04 07:30:55', 'hbhbhbjjk', ''),
(1989, 'AE1013', '2018-11-04 07:32:31', '2018-11-04 07:32:31', 'difodojfds', ''),
(1990, 'AE1013', '2018-11-04 08:51:31', '2018-11-04 08:51:31', 'mmmm', ''),
(1991, 'AE1013', '2018-11-04 09:01:44', '2018-11-04 09:01:44', 'hhju', ''),
(1992, 'AE1014', '2018-11-04 09:16:28', '0000-00-00 00:00:00', 'ffff', ''),
(1993, 'AE1014', '2018-11-04 09:19:13', '2018-11-04 09:19:13', 'Webed to new', ''),
(1994, 'AE1014', '2018-11-04 09:20:26', '2018-11-04 09:20:26', 'payed', ''),
(1995, 'AE1015', '2018-11-04 09:33:42', '2018-11-03 21:00:00', 'Taken by some one', ''),
(1996, 'AE1015', '2018-11-04 09:34:41', '2018-11-04 09:34:41', 'Payed half', ''),
(1997, 'AE1015', '2018-11-04 09:36:12', '2018-11-04 09:36:12', 'Finished', ''),
(1998, 'AE1016', '2018-11-04 09:56:48', '2018-11-29 21:00:00', 'Good Customer', ''),
(1999, 'AE1016', '2018-11-04 10:01:20', '2018-11-04 10:01:20', 'only riba', ''),
(2000, 'AE1016', '2018-11-04 10:03:19', '2018-11-04 10:03:19', 'webed again', ''),
(2001, 'AE1016', '2018-11-04 10:17:11', '2018-11-04 10:17:11', '720000', ''),
(2002, 'AE1017', '2018-11-04 12:31:13', '2018-11-29 21:00:00', 'first loan', ''),
(2003, 'AE1017', '2018-11-04 12:33:10', '2018-11-29 21:00:00', 'first loan', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `loan_track_view`
-- (See below for the actual view)
--
CREATE TABLE `loan_track_view` (
`id` int(11)
,`loan_number` varchar(45)
,`date_call` timestamp
,`date_back` timestamp
,`comment` text
);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `model_name` varchar(30) NOT NULL,
  `module_link` varchar(20) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `role_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `model_name`, `module_link`, `icon`, `role_level`) VALUES
(1, 'Loan Track', 'loan_track', 'search', 1),
(2, 'User', 'user', 'user', 2),
(5, 'Report', 'report', 'book', 3),
(7, 'Problem', 'problem', 'bell', 4),
(8, 'Dashboard', 'dashboard', 'dashboard', 7),
(9, 'Loan', 'loan', 'loan', 5),
(10, 'Assessment Tab', 'cms', 'file-document', 6),
(15, 'Commission', 'loan/com.php', 'bell', 8),
(16, 'Settings', 'setting', 'cogs', 9),
(17, 'Movement', 'movement', 'move', 10);

-- --------------------------------------------------------

--
-- Table structure for table `money_location`
--

CREATE TABLE `money_location` (
  `idmoney_location` int(11) NOT NULL,
  `money_location` varchar(45) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `money_location`
--

INSERT INTO `money_location` (`idmoney_location`, `money_location`, `amount`) VALUES
(9, 'crdb', 0);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `progress_id` varchar(14) NOT NULL,
  `progress_date` date NOT NULL,
  `available_balance` double NOT NULL,
  `lending_capital` double NOT NULL,
  `total_rate` double NOT NULL,
  `mtc` double NOT NULL,
  `value_x` double NOT NULL,
  `value_y` double NOT NULL,
  `total` double NOT NULL,
  `details` text NOT NULL,
  `activities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `progress_id`, `progress_date`, `available_balance`, `lending_capital`, `total_rate`, `mtc`, `value_x`, `value_y`, `total`, `details`, `activities`) VALUES
(5, 'PN10000005', '2018-10-26', 143, 434, 434, 43, 434, 12, 1500, 'sfsddsd', '[{\"period\":\"2018-10-26 15:40:18\",\"user\":\"Admin\",\"value\":\"created\"}]'),
(6, 'PN10000006', '2018-11-04', 50000, 700000, 5000, 6000, 456, 8544, 770000, 'progress day', '[{\"period\":\"2018-11-04 15:37:56\",\"user\":\"Admin\",\"value\":\"created\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `promiss`
--

CREATE TABLE `promiss` (
  `loanno` varchar(20) NOT NULL,
  `promissdate` timestamp NULL DEFAULT NULL,
  `promisscall` timestamp NULL DEFAULT NULL,
  `promiss` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promiss`
--

INSERT INTO `promiss` (`loanno`, `promissdate`, `promisscall`, `promiss`) VALUES
('AE1011', '2018-10-21 21:00:00', '2018-10-21 15:54:01', 'payed tommorow');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `q_loan_no` varchar(45) DEFAULT NULL,
  `q_comment` text,
  `username` varchar(50) NOT NULL,
  `submit_date` date NOT NULL,
  `opened` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`id`, `q_loan_no`, `q_comment`, `username`, `submit_date`, `opened`) VALUES
(100, 'AE1012', 'comment', 'Admin', '2018-10-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `idrate` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `state` varchar(10) DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`idrate`, `rate`, `state`) VALUES
(23, 20, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `remain_commision`
--

CREATE TABLE `remain_commision` (
  `loan_no` varchar(10) NOT NULL,
  `commision` int(11) NOT NULL,
  `state` varchar(15) NOT NULL DEFAULT 'not_paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remain_commision`
--

INSERT INTO `remain_commision` (`loan_no`, `commision`, `state`) VALUES
('AE1011', 90, 'Not Payed'),
('AE1012', 90, 'Not Payed'),
('AE1013', 90, 'Not Payed'),
('AE1014', 90, 'Not Payed'),
('AE1015', 90, 'Not Payed'),
('AE1016', 90, 'Not Payed'),
('AE1017', 90, 'Not Payed');

-- --------------------------------------------------------

--
-- Table structure for table `report_daily`
--

CREATE TABLE `report_daily` (
  `id` int(11) NOT NULL,
  `daily_id` varchar(14) NOT NULL,
  `daily_date` date NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `borrower_name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `amount` double NOT NULL,
  `rate` int(11) NOT NULL,
  `loan_no` varchar(12) NOT NULL,
  `balance` double NOT NULL,
  `difference` double NOT NULL,
  `available_balance` double NOT NULL,
  `transaction_details` text NOT NULL,
  `activities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_group`
--

CREATE TABLE `role_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `group_description` varchar(30) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `default_homepage` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_group`
--

INSERT INTO `role_group` (`group_id`, `group_name`, `group_description`, `deleted`, `default_homepage`) VALUES
(1, 'chair_man', 'Chair Man', 0, 'dashboard'),
(2, 'loan_officer', 'Loan Officer', 0, 'loan'),
(3, 'branch_manager', 'Branch manager', 0, 'loan/com.php'),
(4, 'admin', 'Admin', 0, 'settings'),
(5, 'Customer', 'borrower', 0, '404.html'),
(8, 'group_a', 'Group A', 0, 'loan'),
(9, 'tracker', 'Tracker', 0, 'loan_track'),
(10, 'tracker2', 'Tracker 2', 0, 'loan_track');

-- --------------------------------------------------------

--
-- Table structure for table `sub_modules`
--

CREATE TABLE `sub_modules` (
  `sub_module_id` int(11) NOT NULL,
  `model_name` varchar(30) NOT NULL,
  `sub_model_link` varchar(30) NOT NULL,
  `module_id` int(11) NOT NULL,
  `role_level` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_modules`
--

INSERT INTO `sub_modules` (`sub_module_id`, `model_name`, `sub_model_link`, `module_id`, `role_level`, `deleted`) VALUES
(1, 'General', 'report_general', 5, 31, 0),
(2, 'Capital and Rate Value', 'report_rate', 5, 32, 0),
(3, 'Account Balance', 'report_balance', 5, 33, 0),
(7, 'Daily Report', 'report_daily', 5, 34, 0),
(8, 'Progress Report', 'report_progress', 5, 35, 0),
(12, 'Filter', 'filter', 5, 36, 0),
(16, 'Admin', 'admin', 2, 21, 0),
(17, 'Chair Man', 'chair_man', 2, 22, 0),
(18, 'Loan officer', 'loan_officer', 2, 23, 0),
(19, 'Branch Manager', 'branch_manager', 2, 24, 0),
(20, 'Customer', 'borrower', 2, 25, 0),
(22, 'Group A', 'group_a', 2, 26, 0),
(23, 'Tracker', 'tracker', 2, 27, 0),
(24, 'Tracker 2', 'tracker2', 2, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_rolers`
--

CREATE TABLE `sub_rolers` (
  `role_level` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_rolers`
--

INSERT INTO `sub_rolers` (`role_level`, `user`, `action`) VALUES
('1', 'admin', 'create'),
('1', 'admin', 'edit'),
('1', 'admin', 'view'),
('10', 'admin', 'create'),
('10', 'admin', 'edit'),
('10', 'admin', 'view'),
('21', 'admin', 'create'),
('21', 'admin', 'edit'),
('21', 'admin', 'view'),
('22', 'admin', 'create'),
('22', 'admin', 'edit'),
('22', 'admin', 'view'),
('23', 'admin', 'create'),
('23', 'admin', 'edit'),
('23', 'admin', 'view'),
('24', 'admin', 'create'),
('24', 'admin', 'edit'),
('24', 'admin', 'view'),
('25', 'admin', 'create'),
('25', 'admin', 'edit'),
('25', 'admin', 'view'),
('27', 'admin', 'create'),
('27', 'admin', 'edit'),
('27', 'admin', 'view'),
('31', 'admin', 'create'),
('31', 'admin', 'edit'),
('31', 'admin', 'view'),
('32', 'admin', 'create'),
('32', 'admin', 'edit'),
('32', 'admin', 'view'),
('33', 'admin', 'create'),
('33', 'admin', 'edit'),
('33', 'admin', 'view'),
('34', 'admin', 'create'),
('34', 'admin', 'edit'),
('34', 'admin', 'view'),
('35', 'admin', 'create'),
('35', 'admin', 'edit'),
('35', 'admin', 'view'),
('36', 'admin', 'create'),
('36', 'admin', 'edit'),
('36', 'admin', 'view'),
('4', 'admin', 'create'),
('4', 'admin', 'edit'),
('4', 'admin', 'view'),
('5', 'admin', 'accept'),
('5', 'admin', 'create'),
('5', 'admin', 'edit'),
('5', 'admin', 'pay'),
('5', 'admin', 'problem'),
('5', 'admin', 'report'),
('5', 'admin', 'track'),
('5', 'admin', 'trash'),
('5', 'admin', 'view'),
('6', 'admin', 'create'),
('6', 'admin', 'edit'),
('6', 'admin', 'view'),
('7', 'admin', 'create'),
('7', 'admin', 'edit'),
('7', 'admin', 'view'),
('7', 'chair_man', 'create'),
('7', 'chair_man', 'edit'),
('7', 'chair_man', 'view'),
('8', 'admin', 'create'),
('8', 'admin', 'edit'),
('8', 'admin', 'view'),
('8', 'chair_man', 'create'),
('8', 'chair_man', 'edit'),
('8', 'chair_man', 'view'),
('9', 'admin', 'create'),
('9', 'admin', 'edit'),
('9', 'admin', 'view');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan`
--

CREATE TABLE `tbl_loan` (
  `loanno` int(11) NOT NULL,
  `processedby` varchar(20) NOT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loan_no` varchar(7) DEFAULT NULL,
  `account_number` varchar(20) DEFAULT NULL,
  `loan_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `payment` date DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `loan_amount` double DEFAULT NULL,
  `rate_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `money_location` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comment` text,
  `payed_amont` double DEFAULT '0',
  `loan_type` varchar(20) NOT NULL DEFAULT 'normal',
  `activities` text NOT NULL,
  `movement` text NOT NULL,
  `loan_from` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_loan`
--

INSERT INTO `tbl_loan` (`loanno`, `processedby`, `transaction_time`, `loan_no`, `account_number`, `loan_date`, `deadline`, `payment`, `rate`, `loan_amount`, `rate_amount`, `total_amount`, `money_location`, `status`, `comment`, `payed_amont`, `loan_type`, `activities`, `movement`, `loan_from`) VALUES
(1011, 'Admin', '2018-10-21 11:50:03', 'AE1011', 'Admin', '2018-10-01', '2018-10-23', '2018-10-23', 20, 120000, 0, 0, 'crdb', 'Done', 'dssdsd', 144000, 'normal', '[{\"period\":\"2018-10-21 14:50:03\",\"user\":\"Admin\",\"value\":\"inserted\"},{\"period\":\"2018-10-21 14:52:28\",\"user\":\"Admin\",\"value\":\"updated to 120000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":\"HQ\"}', 'Head_Quarter'),
(1012, 'Admin', '2018-10-22 07:08:35', 'AE1012', 'Admin', '2018-10-22', '2018-10-29', '2018-10-29', 20, 120000, 24000, 144000, 'crdb', 'Done', 'comment', 144000, 'normal', '[{\"period\":\"2018-10-22 10:08:35\",\"user\":\"Admin\",\"value\":\"inserted\"},{\"period\":\"2018-10-22 15:46:10\",\"user\":\"Admin\",\"value\":\"updated to 110000\"},{\"period\":\"2018-10-28 11:21:52\",\"user\":\"Admin\",\"value\":\"updated to 120000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":\"HQ\"}', 'Head_Quarter'),
(1013, 'Admin', '2018-10-30 14:11:52', 'AE1013', 'Admin', '2018-10-30', '2018-11-29', '2018-11-29', 20, 200000, 40000, 240000, 'crdb', 'Confirm', 'mkmkm', 240000, 'normal', '[{\"period\":\"2018-10-30 17:11:52\",\"user\":\"Admin\",\"value\":\"inserted 200000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":\"HQ\"}', 'Head_Quarter'),
(1014, 'Admin', '2018-11-04 09:16:28', 'AE1014', 'Admin', '2018-11-04', '0000-00-00', '2018-11-05', 20, 150000, 30000, 180000, 'crdb', 'Done', 'ffff', 180000, 'normal', '[{\"period\":\"2018-11-04 12:16:28\",\"user\":\"Admin\",\"value\":\"inserted 150000\"},{\"period\":\"2018-11-04 12:19:12\",\"user\":\"Admin\",\"value\":\"webbed with 30000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":\"HQ\"}', 'Head_Quarter'),
(1015, 'Admin', '2018-11-04 09:33:41', 'AE1015', 'Admin', '2018-11-04', '2018-11-04', '2018-11-04', 20, 300000, 60000, 360000, 'crdb', 'Done', 'Taken by some one', 360000, 'normal', '[{\"period\":\"2018-11-04 12:33:41\",\"user\":\"Admin\",\"value\":\"inserted 300000\"},{\"period\":\"2018-11-04 12:34:40\",\"user\":\"Admin\",\"value\":\"webbed with 60000\"},{\"period\":\"2018-11-04 12:34:40\",\"user\":\"Admin\",\"value\":\"payed 360000\"},{\"period\":\"2018-11-04 12:36:11\",\"user\":\"Admin\",\"value\":\"payed 72000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":\"HQ\"}', 'Head_Quarter'),
(1016, 'Admin', '2018-11-04 09:56:48', 'AE1016', 'Admin', '2018-11-04', '2018-11-30', '2018-11-30', 20, 600000, 120000, 720000, 'crdb', 'Confirm', 'Good Customer', 720000, 'normal', '[{\"period\":\"2018-11-04 12:56:48\",\"user\":\"Admin\",\"value\":\"inserted 600000\"},{\"period\":\"2018-11-04 13:01:20\",\"user\":\"Admin\",\"value\":\"webbed with 600000\"},{\"period\":\"2018-11-04 13:01:20\",\"user\":\"Admin\",\"value\":\"payed 720000\"},{\"period\":\"2018-11-04 13:03:18\",\"user\":\"Admin\",\"value\":\"webbed with 120000\"},{\"period\":\"2018-11-04 13:03:19\",\"user\":\"Admin\",\"value\":\"payed 720000\"},{\"period\":\"2018-11-04 13:17:11\",\"user\":\"Admin\",\"value\":\"payed 720000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":\"HQ\"}', 'Head_Quarter'),
(1017, 'Admin', '2018-11-04 12:31:13', 'AE1017', 'Hemedi_Mshamu', '2018-11-04', '2018-11-30', NULL, 20, 310000, 62000, 372000, 'crdb', 'New', 'first loan', 0, 'normal', '[{\"period\":\"2018-11-04 15:31:13\",\"user\":\"Admin\",\"value\":\"inserted 300000\"},{\"period\":\"2018-11-04 15:33:09\",\"user\":\"Admin\",\"value\":\"updated to 310000\"}]', '{\"loan_from\":\"Head_Quarter\",\"loan_manager\":\"Amani_Nguku\",\"commision\":\"10\",\"state\":\"Not Payed\",\"branch_borrower\":null}', 'Head_Quarter');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `account_number` varchar(45) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phone_number` text,
  `email` varchar(100) DEFAULT NULL,
  `jobstatus` varchar(75) DEFAULT NULL,
  `jobposition` varchar(45) DEFAULT NULL,
  `branch` varchar(45) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `user_password` text NOT NULL,
  `state` varchar(11) NOT NULL DEFAULT 'offline',
  `home_details` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `activities` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`account_number`, `fullname`, `phone_number`, `email`, `jobstatus`, `jobposition`, `branch`, `role`, `user_password`, `state`, `home_details`, `description`, `activities`, `last_updated`, `update_pass`) VALUES
('Admin', 'Admin Admin', '[\"0685639653\"]', 'hmanyinja@gmail.com', 'coder', 'Coding', 'HQ', 'admin', '$2y$06$53i/1ScWRA/lYsMLYDL8ZeeLJ6pYRerO/EbXc4Omtjzrbaau5OtTy', 'online', 'Kilungule Mwisho', 'No description', '', '2018-11-04 06:28:41', 0),
('Amani_Nguku', 'Amani Nguku', '[\"0678567484\"]', 'hmanyinja@gmail.com', 'Magazijuto', 'chair man', 'HQ', 'chair_man', '$2y$06$OEpXVkqWJD9zQHo64jqTk.47Hl4ViteSwU154Zt1A1NJYWu/kRPw2', 'online', 'kigamboni', 'No description gggggg', '[{\"period\":\"2018-10-21 12:49:44\",\"user\":\"Admin\",\"value\":\"created\"},{\"period\":\"2018-10-21 12:59:59\",\"user\":\"Admin\",\"value\":\"edited 0678567484\"}]', '2018-10-21 16:45:37', 0),
('Hemedi_Mshamu', 'Hemedi Mshamu', '[\"0685639653\"]', 'hmanyinja@gmail.com', 'Neymon ICT', 'Conding Area', 'Head_Quarter', 'tracker', '$2y$06$bCFuIsQ2L3n5/OgoO51on.zuDebIn6J8tLXVyeFzjzyLQVNavc3.O', 'offline', 'Kilungule Mwisho', 'New user edited', '[{\"period\":\"2018-11-04 15:25:28\",\"user\":\"Admin\",\"value\":\"created\"},{\"period\":\"2018-11-04 15:26:03\",\"user\":\"Admin\",\"value\":\"edited 0685639653\"}]', '2018-11-04 12:26:03', 0);

-- --------------------------------------------------------

--
-- Structure for view `loan_track_view`
--
DROP TABLE IF EXISTS `loan_track_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `loan_track_view`  AS  (select `loan_track`.`id` AS `id`,`loan_track`.`loan_number` AS `loan_number`,`loan_track`.`date_call` AS `date_call`,`loan_track`.`date_back` AS `date_back`,`loan_track`.`comment` AS `comment` from `loan_track`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_balance`
--
ALTER TABLE `account_balance`
  ADD PRIMARY KEY (`account_date`);

--
-- Indexes for table `assosiated_loan`
--
ALTER TABLE `assosiated_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_movement`
--
ALTER TABLE `balance_movement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`idbranch`),
  ADD KEY `manager_idx` (`branchmanager`);

--
-- Indexes for table `capital_movement`
--
ALTER TABLE `capital_movement`
  ADD PRIMARY KEY (`capital_day`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`cms_id`);

--
-- Indexes for table `commision`
--
ALTER TABLE `commision`
  ADD PRIMARY KEY (`idcom`);

--
-- Indexes for table `commision_state`
--
ALTER TABLE `commision_state`
  ADD PRIMARY KEY (`loanno`);

--
-- Indexes for table `deducation`
--
ALTER TABLE `deducation`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`submitted_time`);

--
-- Indexes for table `global_variables`
--
ALTER TABLE `global_variables`
  ADD PRIMARY KEY (`variable_name`);

--
-- Indexes for table `investor_table`
--
ALTER TABLE `investor_table`
  ADD PRIMARY KEY (`investor_no`);

--
-- Indexes for table `loan_movement`
--
ALTER TABLE `loan_movement`
  ADD PRIMARY KEY (`id`,`loan_no`);

--
-- Indexes for table `loan_track`
--
ALTER TABLE `loan_track`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_track_idx` (`loan_number`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `money_location`
--
ALTER TABLE `money_location`
  ADD PRIMARY KEY (`idmoney_location`),
  ADD UNIQUE KEY `idx_money_location_money_location` (`money_location`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `progress_date` (`progress_date`);

--
-- Indexes for table `promiss`
--
ALTER TABLE `promiss`
  ADD PRIMARY KEY (`loanno`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_query_idx` (`q_loan_no`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`idrate`),
  ADD UNIQUE KEY `rate_UNIQUE` (`rate`);

--
-- Indexes for table `remain_commision`
--
ALTER TABLE `remain_commision`
  ADD PRIMARY KEY (`loan_no`);

--
-- Indexes for table `report_daily`
--
ALTER TABLE `report_daily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_group`
--
ALTER TABLE `role_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `sub_modules`
--
ALTER TABLE `sub_modules`
  ADD PRIMARY KEY (`sub_module_id`),
  ADD KEY `sub model` (`module_id`);

--
-- Indexes for table `sub_rolers`
--
ALTER TABLE `sub_rolers`
  ADD PRIMARY KEY (`role_level`,`user`,`action`);

--
-- Indexes for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  ADD PRIMARY KEY (`loanno`),
  ADD UNIQUE KEY `loan_no_UNIQUE` (`loan_no`),
  ADD KEY `location_idx` (`money_location`),
  ADD KEY `rating_idx` (`rate`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assosiated_loan`
--
ALTER TABLE `assosiated_loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `balance_movement`
--
ALTER TABLE `balance_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10013;

--
-- AUTO_INCREMENT for table `commision`
--
ALTER TABLE `commision`
  MODIFY `idcom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_movement`
--
ALTER TABLE `loan_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_track`
--
ALTER TABLE `loan_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2004;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `money_location`
--
ALTER TABLE `money_location`
  MODIFY `idmoney_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `idrate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `report_daily`
--
ALTER TABLE `report_daily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_group`
--
ALTER TABLE `role_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_modules`
--
ALTER TABLE `sub_modules`
  MODIFY `sub_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  MODIFY `loanno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loan_track`
--
ALTER TABLE `loan_track`
  ADD CONSTRAINT `loan_track` FOREIGN KEY (`loan_number`) REFERENCES `tbl_loan` (`loan_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `query`
--
ALTER TABLE `query`
  ADD CONSTRAINT `loan_no` FOREIGN KEY (`q_loan_no`) REFERENCES `tbl_loan` (`loan_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_modules`
--
ALTER TABLE `sub_modules`
  ADD CONSTRAINT `sub model` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  ADD CONSTRAINT `location` FOREIGN KEY (`money_location`) REFERENCES `money_location` (`money_location`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rating` FOREIGN KEY (`rate`) REFERENCES `rate` (`rate`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
