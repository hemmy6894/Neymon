-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3388
-- Generation Time: Oct 04, 2018 at 06:08 PM
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
-- Database: `tea_testing`
--
create database new_database;
use new_database;
-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `Module` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `allow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`id`, `group_id`, `Module`, `link`, `allow`) VALUES
(1, 1, 10, 'View_users', 1),
(2, 1, 10, 'Create_user_group', 1),
(3, 1, 10, 'View_users_group', 1),
(4, 1, 10, 'Create_users', 1),
(5, 1, 1, 'Register_new_member', 1),
(6, 1, 1, 'View_member_group', 1),
(7, 1, 1, 'View_member_list', 1),
(8, 1, 1, 'Manage_member_group', 1),
(9, 1, 2, 'Contribution_setting', 1),
(10, 1, 2, 'Contribution_payment', 1),
(11, 1, 2, 'Contribution_transaction', 1),
(12, 1, 3, 'Create_saving_account', 1),
(13, 1, 3, 'Deposit_Withdrawal', 1),
(14, 1, 3, 'Savings_transactions', 1),
(15, 1, 4, 'Buy_shares', 1),
(16, 1, 4, 'Refund_shares', 1),
(17, 1, 4, 'Share_transaction', 1),
(18, 1, 5, 'View_loan_list', 1),
(19, 1, 5, 'Create_new_loan', 1),
(20, 1, 5, 'Evaluate_loan', 1),
(21, 1, 5, 'Approve_loan', 1),
(22, 1, 5, 'Disburse_loan', 1),
(23, 1, 5, 'Loan_repayment', 1),
(24, 1, 6, 'Manage_account_chart', 1),
(25, 1, 6, 'Manage_customer', 1),
(26, 1, 6, 'Create_sales_quote', 1),
(27, 1, 6, 'Create_sales_invoice', 1),
(28, 1, 6, 'Manage_supplier', 1),
(29, 1, 6, 'Create_purchase_orders', 1),
(30, 1, 6, 'Create_purchase_invoice', 1),
(31, 1, 6, 'Journal_entry', 1),
(32, 1, 7, 'Financial_reports', 1),
(33, 1, 7, 'Journal_transactions_report', 1),
(34, 1, 7, 'Members_reports', 1),
(35, 1, 7, 'Savings_accounts_reports', 1),
(36, 1, 7, 'Loans_reports', 1),
(37, 1, 7, 'Share_reports', 1),
(38, 1, 8, 'Create_sender_id', 1),
(39, 1, 8, 'Create_contacts_group', 1),
(40, 1, 8, 'Add_contacts', 1),
(41, 1, 8, 'Send_sms', 1),
(42, 1, 9, 'Manage_company_information', 1),
(43, 1, 9, 'Share_settings', 1),
(44, 1, 9, 'Manage_saving_account_type', 1),
(45, 1, 9, 'Contributions_setting', 1),
(46, 1, 9, 'Manage_sales_purchase_items', 1),
(47, 1, 9, 'Manage_tax_code', 1),
(48, 1, 9, 'Global_settings', 1),
(49, 1, 9, 'Manage_loan_product', 1),
(50, 1, 2, 'automatic_contribution_process', 1),
(51, 1, 5, 'automatic_repayment_process', 1),
(52, 5, 1, 'Register_new_member', 1),
(53, 5, 1, 'View_member_list', 1),
(54, 5, 1, 'Manage_member_group', 1),
(55, 5, 1, 'View_member_group', 1),
(56, 5, 2, 'Contribution_setting', 1),
(57, 5, 2, 'Contribution_payment', 1),
(58, 5, 2, 'Contribution_transaction', 1),
(59, 5, 2, 'automatic_contribution_process', 1),
(60, 5, 3, 'Create_saving_account', 1),
(61, 5, 3, 'Deposit_Withdrawal', 1),
(62, 5, 3, 'Savings_transactions', 1),
(63, 5, 4, 'Buy_shares', 1),
(64, 5, 4, 'Refund_shares', 1),
(65, 5, 4, 'Share_transaction', 1),
(66, 5, 5, 'View_loan_list', 1),
(67, 5, 5, 'Create_new_loan', 1),
(68, 5, 5, 'Evaluate_loan', 1),
(69, 5, 5, 'Approve_loan', 1),
(70, 5, 5, 'Disburse_loan', 1),
(71, 5, 5, 'Loan_repayment', 1),
(72, 5, 5, 'automatic_repayment_process', 0),
(73, 5, 6, 'Manage_account_chart', 1),
(74, 5, 6, 'Manage_customer', 0),
(75, 5, 6, 'Create_sales_quote', 0),
(76, 5, 6, 'Create_sales_invoice', 0),
(77, 5, 6, 'Manage_supplier', 0),
(78, 5, 6, 'Create_purchase_orders', 0),
(79, 5, 6, 'Create_purchase_invoice', 0),
(80, 5, 6, 'Journal_entry', 1),
(81, 5, 7, 'Financial_reports', 1),
(82, 5, 7, 'Journal_transactions_report', 1),
(83, 5, 7, 'Members_reports', 1),
(84, 5, 7, 'Savings_accounts_reports', 1),
(85, 5, 7, 'Loans_reports', 1),
(86, 5, 7, 'Share_reports', 1),
(87, 5, 8, 'Create_sender_id', 0),
(88, 5, 8, 'Create_contacts_group', 0),
(89, 5, 8, 'Add_contacts', 0),
(90, 5, 8, 'Send_sms', 0),
(91, 5, 9, 'Manage_company_information', 0),
(92, 5, 9, 'Share_settings', 0),
(93, 5, 9, 'Manage_saving_account_type', 0),
(94, 5, 9, 'Contributions_setting', 0),
(95, 5, 9, 'Manage_sales_purchase_items', 0),
(96, 5, 9, 'Manage_tax_code', 0),
(97, 5, 9, 'Global_settings', 0),
(98, 5, 9, 'Manage_loan_product', 0),
(99, 5, 10, 'View_users', 1),
(100, 5, 11, 'contribution_payment', 1),
(101, 5, 11, 'loan_repayment', 1),
(102, 7, 1, 'Register_new_member', 1),
(103, 7, 1, 'View_member_list', 1),
(104, 7, 1, 'Manage_member_group', 1),
(105, 7, 1, 'View_member_group', 1),
(106, 7, 2, 'Contribution_setting', 1),
(107, 7, 2, 'Contribution_payment', 1),
(108, 7, 2, 'Contribution_transaction', 1),
(109, 7, 2, 'automatic_contribution_process', 1),
(110, 7, 3, 'Create_saving_account', 1),
(111, 7, 3, 'Deposit_Withdrawal', 1),
(112, 7, 3, 'Savings_transactions', 1),
(113, 7, 4, 'Buy_shares', 1),
(114, 7, 4, 'Refund_shares', 1),
(115, 7, 4, 'Share_transaction', 1),
(116, 7, 5, 'View_loan_list', 1),
(117, 7, 5, 'Create_new_loan', 1),
(118, 7, 5, 'Evaluate_loan', 1),
(119, 7, 5, 'Approve_loan', 1),
(120, 7, 5, 'Disburse_loan', 1),
(121, 7, 5, 'Loan_repayment', 1),
(122, 7, 5, 'automatic_repayment_process', 1),
(123, 7, 6, 'Manage_account_chart', 1),
(124, 7, 6, 'Manage_customer', 1),
(125, 7, 6, 'Create_sales_quote', 1),
(126, 7, 6, 'Create_sales_invoice', 1),
(127, 7, 6, 'Manage_supplier', 1),
(128, 7, 6, 'Create_purchase_orders', 1),
(129, 7, 6, 'Create_purchase_invoice', 1),
(130, 7, 6, 'Journal_entry', 1),
(131, 7, 7, 'Financial_reports', 1),
(132, 7, 7, 'Journal_transactions_report', 1),
(133, 7, 7, 'Members_reports', 1),
(134, 7, 7, 'Savings_accounts_reports', 1),
(135, 7, 7, 'Loans_reports', 1),
(136, 7, 7, 'Share_reports', 1),
(137, 7, 8, 'Create_sender_id', 1),
(138, 7, 8, 'Create_contacts_group', 1),
(139, 7, 8, 'Add_contacts', 1),
(140, 7, 8, 'Send_sms', 1),
(141, 7, 9, 'Manage_company_information', 1),
(142, 7, 9, 'Share_settings', 1),
(143, 7, 9, 'Manage_saving_account_type', 1),
(144, 7, 9, 'Contributions_setting', 1),
(145, 7, 9, 'Manage_sales_purchase_items', 1),
(146, 7, 9, 'Manage_tax_code', 1),
(147, 7, 9, 'Global_settings', 1),
(148, 7, 9, 'Manage_loan_product', 1),
(149, 7, 10, 'Create_user_group', 0),
(150, 7, 10, 'View_users_group', 0),
(151, 7, 10, 'Create_users', 0),
(152, 7, 10, 'View_users', 0),
(153, 7, 11, 'contribution_payment', 1),
(154, 7, 11, 'loan_repayment', 1),
(155, 9, 1, 'View_member_group', 1),
(156, 9, 2, 'Contribution_transaction', 1),
(157, 9, 5, 'View_loan_list', 1),
(158, 9, 5, 'Evaluate_loan', 1),
(159, 9, 5, 'Approve_loan', 1),
(160, 9, 7, 'Financial_reports', 1),
(161, 9, 7, 'Journal_transactions_report', 1),
(162, 9, 7, 'Members_reports', 1),
(163, 9, 7, 'Savings_accounts_reports', 1),
(164, 9, 7, 'Loans_reports', 1),
(165, 9, 9, 'Manage_company_information', 1),
(166, 9, 9, 'Contributions_setting', 1),
(167, 9, 9, 'Manage_sales_purchase_items', 1),
(168, 9, 9, 'Manage_tax_code', 1),
(169, 9, 9, 'Global_settings', 1),
(170, 9, 9, 'Manage_loan_product', 1),
(171, 8, 1, 'Register_new_member', 1),
(172, 8, 1, 'View_member_list', 1),
(173, 8, 1, 'Manage_member_group', 1),
(174, 8, 1, 'View_member_group', 1),
(175, 8, 2, 'Contribution_setting', 1),
(176, 8, 2, 'Contribution_payment', 1),
(177, 8, 2, 'Contribution_transaction', 1),
(178, 8, 5, 'View_loan_list', 1),
(179, 8, 5, 'Create_new_loan', 1),
(180, 8, 5, 'Loan_repayment', 1),
(181, 8, 6, 'Manage_customer', 1),
(182, 8, 6, 'Create_sales_quote', 1),
(183, 8, 6, 'Create_sales_invoice', 1),
(184, 8, 6, 'Manage_supplier', 1),
(185, 8, 6, 'Create_purchase_orders', 1),
(186, 8, 6, 'Create_purchase_invoice', 1),
(187, 8, 6, 'Journal_entry', 1),
(188, 8, 7, 'Financial_reports', 1),
(189, 8, 7, 'Journal_transactions_report', 1),
(190, 8, 7, 'Members_reports', 1),
(191, 8, 7, 'Savings_accounts_reports', 1),
(192, 8, 7, 'Loans_reports', 1),
(193, 8, 7, 'Share_reports', 1),
(194, 8, 8, 'Create_sender_id', 1),
(195, 8, 8, 'Create_contacts_group', 1),
(196, 8, 8, 'Add_contacts', 1),
(197, 8, 8, 'Send_sms', 1),
(198, 8, 9, 'Contributions_setting', 1),
(199, 8, 9, 'Global_settings', 1),
(200, 8, 9, 'Manage_loan_product', 1),
(201, 8, 5, 'Evaluate_loan', 1),
(202, 8, 5, 'Approve_loan', 1),
(203, 8, 5, 'Disburse_loan', 1),
(204, 8, 9, 'Manage_saving_account_type', 1),
(205, 8, 9, 'Manage_sales_purchase_items', 1),
(206, 10, 1, 'Register_new_member', 1),
(207, 10, 1, 'Manage_member_group', 1),
(208, 10, 2, 'Contribution_payment', 1),
(209, 10, 5, 'Approve_loan', 1),
(210, 10, 7, 'Financial_reports', 1),
(211, 10, 7, 'Journal_transactions_report', 1),
(212, 10, 7, 'Members_reports', 1),
(213, 10, 7, 'Savings_accounts_reports', 1),
(214, 10, 7, 'Share_reports', 0),
(215, 10, 5, 'Disburse_loan', 0),
(216, 10, 5, 'View_loan_list', 1),
(217, 10, 7, 'Loans_reports', 1),
(218, 1, 6, 'close_open_year', 1),
(219, 4, 1, 'Register_new_member', 1),
(220, 4, 1, 'View_member_list', 1),
(221, 4, 1, 'Manage_member_group', 1),
(222, 4, 1, 'View_member_group', 1),
(223, 4, 5, 'View_loan_list', 1),
(224, 4, 5, 'Create_new_loan', 1),
(225, 4, 5, 'Evaluate_loan', 1),
(226, 4, 5, 'Approve_loan', 1),
(227, 4, 5, 'Disburse_loan', 1),
(228, 4, 5, 'Loan_repayment', 1),
(229, 4, 6, 'Manage_account_chart', 1),
(230, 4, 6, 'Manage_customer', 1),
(231, 4, 6, 'Create_sales_quote', 1),
(232, 4, 6, 'Create_sales_invoice', 1),
(233, 4, 6, 'Manage_supplier', 1),
(234, 4, 6, 'Create_purchase_orders', 1),
(235, 4, 6, 'Create_purchase_invoice', 1),
(236, 4, 6, 'Journal_entry', 1),
(237, 4, 6, 'close_open_year', 1),
(238, 4, 7, 'Financial_reports', 1),
(239, 4, 7, 'Journal_transactions_report', 1),
(240, 4, 7, 'Members_reports', 1),
(241, 4, 7, 'Loans_reports', 1),
(242, 4, 8, 'Create_sender_id', 1),
(243, 4, 8, 'Create_contacts_group', 1),
(244, 4, 8, 'Add_contacts', 1),
(245, 4, 8, 'Send_sms', 1),
(246, 4, 9, 'Manage_company_information', 1),
(247, 4, 9, 'Share_settings', 1),
(248, 4, 9, 'Manage_saving_account_type', 1),
(249, 4, 9, 'Contributions_setting', 1),
(250, 4, 9, 'Manage_sales_purchase_items', 1),
(251, 4, 9, 'Manage_tax_code', 1),
(252, 4, 9, 'Global_settings', 1),
(253, 4, 9, 'Manage_loan_product', 1),
(254, 4, 10, 'Create_user_group', 0),
(255, 4, 10, 'View_users_group', 0),
(256, 4, 10, 'Create_users', 0),
(257, 4, 10, 'View_users', 0),
(258, 4, 5, 'automatic_repayment_process', 1),
(259, 6, 1, 'Register_new_member', 1),
(260, 6, 1, 'View_member_list', 1),
(261, 6, 1, 'Manage_member_group', 1),
(262, 6, 1, 'View_member_group', 1),
(263, 6, 5, 'View_loan_list', 1),
(264, 6, 5, 'Create_new_loan', 1),
(265, 6, 5, 'Evaluate_loan', 1),
(266, 6, 5, 'Approve_loan', 1),
(267, 6, 5, 'Disburse_loan', 1),
(268, 6, 5, 'Loan_repayment', 1),
(269, 6, 5, 'automatic_repayment_process', 1),
(270, 6, 6, 'Manage_account_chart', 1),
(271, 6, 6, 'Manage_customer', 1),
(272, 6, 6, 'Create_sales_quote', 1),
(273, 6, 6, 'Create_sales_invoice', 1),
(274, 6, 6, 'Manage_supplier', 1),
(275, 6, 6, 'Create_purchase_orders', 1),
(276, 6, 6, 'Create_purchase_invoice', 1),
(277, 6, 6, 'Journal_entry', 1),
(278, 6, 6, 'close_open_year', 1),
(279, 6, 7, 'Financial_reports', 1),
(280, 6, 7, 'Journal_transactions_report', 1),
(281, 6, 7, 'Members_reports', 1),
(282, 6, 7, 'Loans_reports', 1),
(283, 6, 8, 'Create_sender_id', 1),
(284, 6, 8, 'Create_contacts_group', 1),
(285, 6, 8, 'Add_contacts', 1),
(286, 6, 8, 'Send_sms', 1),
(287, 6, 9, 'Manage_company_information', 1),
(288, 6, 9, 'Share_settings', 1),
(289, 6, 9, 'Manage_saving_account_type', 1),
(290, 6, 9, 'Contributions_setting', 1),
(291, 6, 9, 'Manage_sales_purchase_items', 1),
(292, 6, 9, 'Manage_tax_code', 1),
(293, 6, 9, 'Global_settings', 1),
(294, 6, 9, 'Manage_loan_product', 1),
(295, 6, 10, 'Create_user_group', 1),
(296, 6, 10, 'View_users_group', 1),
(297, 6, 10, 'Create_users', 1),
(298, 6, 10, 'View_users', 1),
(299, 5, 6, 'close_open_year', 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_chart`
--

CREATE TABLE `account_chart` (
  `id` bigint(20) NOT NULL,
  `account` bigint(20) NOT NULL,
  `account_type` bigint(20) NOT NULL,
  `sub_account_type` bigint(20) NOT NULL,
  `account_parent` bigint(20) NOT NULL,
  `is_header` int(11) NOT NULL DEFAULT '0' COMMENT 'Header not used to record transaction',
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `edit` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_chart`
--

INSERT INTO `account_chart` (`id`, `account`, `account_type`, `sub_account_type`, `account_parent`, `is_header`, `name`, `description`, `path`, `createdon`, `createdby`, `PIN`, `edit`) VALUES
(1, 1010001, 10, 1, 0, 0, 'CRDB BANK - AZIKIWE BRANCH', 'CRDB Bank Azikiwe Branch', '', '2015-08-23 14:30:58', 1, 100, 0),
(2, 1050001, 10, 5, 0, 0, 'Accounts Receivable', '', '', '2015-08-23 14:30:58', 1, 100, 0),
(3, 4000001, 40, 0, 0, 0, 'Registration Fees', '', '', '2015-08-23 14:30:58', 1, 100, 0),
(4, 3000001, 30, 0, 0, 0, 'Capital Accounts', '', '', '2015-08-23 14:30:58', 1, 100, 0),
(5, 3000002, 30, 0, 0, 0, 'Retained Earnings', '', '', '2015-08-23 14:30:58', 1, 100, 0),
(6, 1020001, 10, 2, 0, 0, 'Cash in Hand', 'Cash in Hand', '', '2015-08-23 14:30:58', 1, 100, 0),
(7, 2010001, 20, 1, 0, 0, 'Tax Payable', 'Tax payable', '', '2015-08-23 14:30:58', 1, 100, 0),
(8, 2010002, 20, 1, 0, 0, 'Account Payable', '', '', '2015-08-23 14:30:58', 1, 100, 0),
(9, 4000002, 40, 0, 0, 0, 'Loan Processing fee', 'Loan Processing fee', '', '2015-08-23 14:30:58', 1, 100, 0),
(14, 1050002, 10, 5, 0, 0, 'Provision for Doubtful', 'Allowance for Doubtful Accounts', '', '2015-08-25 16:20:33', 2, 100, 0),
(15, 1050003, 10, 5, 0, 0, 'Interest Receivable', '', '', '2015-09-09 20:42:50', 2, 100, 0),
(19, 4000010, 40, 0, 0, 0, 'Interest Income - Institutional Loan', 'Interest on Institutional Loan', '', '2015-09-10 03:35:25', 2, 100, 1),
(20, 4000011, 40, 0, 0, 0, 'Penalty on Loan Account', 'Penalty on  Loan Account', '', '2015-09-10 03:35:37', 2, 100, 1),
(21, 1030011, 10, 1, 0, 0, 'CRDB BANK - KIJITONYAMA BRANCH', 'CRDB Bank  Kijitonyama Branch', '', '2015-09-11 12:44:08', 2, 100, 1),
(22, 1030012, 10, 3, 0, 0, 'LOAN PORTIFOLIO - LOAN ACCOUNT', 'LOAN PORTIFOLIO ACCOUNT', '', '2015-09-15 13:39:55', 3, 100, 1),
(27, 3000011, 30, 0, 0, 0, 'Grant Capital', 'Grant', '', '2015-10-23 08:04:05', 3, 100, 1),
(28, 3000012, 30, 0, 0, 0, 'Profit for a Year', 'Current Year Profit', '', '2015-10-23 08:06:23', 3, 100, 1),
(53, 1030013, 10, 3, 0, 0, 'LOAN PREPAYMENT ACCOUNT', 'Balance For Next Installment', '', '2016-01-08 10:18:11', 1, 100, 1),
(56, 5000028, 50, 0, 0, 0, 'Depreciation', '', '', '2016-01-18 10:09:41', 3, 100, 1),
(57, 2010016, 20, 1, 0, 0, 'Provition for Depreciation', '', '', '2016-01-18 10:10:41', 3, 100, 1),
(58, 4000014, 40, 0, 0, 0, 'Interest Income -TEA Staff Loan', 'Interest income on TEA Staff loan', '', '2016-01-19 07:43:24', 3, 100, 1),
(59, 4000015, 40, 0, 0, 0, 'Interest Income - Other Loans', 'Interest Income on Other loans', '', '2016-01-19 07:44:34', 3, 100, 1),
(67, 5000033, 50, 0, 0, 0, 'Bad Debt', '', '', '2016-03-07 13:42:58', 1, 100, 1),
(68, 2010018, 20, 1, 0, 0, 'Provision For Doubtful', '', '', '2016-03-07 13:43:29', 1, 100, 1),
(70, 5000035, 10, 1, 0, 0, 'BANK CHARGES', 'BANK CHARGES', '', '2016-05-13 13:44:56', 3, 100, 1),
(75, 1030016, 10, 3, 0, 0, 'INTEREST RECEIVABLE - TEA STAFF LOAN', 'Interest Receivable On TEA Staff Loan', '', '2016-08-09 12:50:47', 1, 100, 1),
(76, 1030017, 10, 3, 0, 0, 'INTEREST RECEIVABLE - INSTITUTIONAL LOAN', 'Interest Receivable On Institutional Loan', '', '2016-08-09 12:51:23', 1, 100, 1),
(77, 1030018, 10, 3, 0, 0, 'INTEREST RECEIVABLE - OTHER LOAN', 'Interest Receivable On Other Loan', '', '2016-08-09 12:51:56', 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_chart_default`
--

CREATE TABLE `account_chart_default` (
  `id` bigint(20) NOT NULL,
  `account` bigint(20) NOT NULL,
  `account_type` bigint(20) NOT NULL,
  `sub_account_type` bigint(20) NOT NULL,
  `account_parent` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_chart_default`
--

INSERT INTO `account_chart_default` (`id`, `account`, `account_type`, `sub_account_type`, `account_parent`, `name`, `description`) VALUES
(1, 1010001, 10, 1, 0, 'Bank Account', 'Bank Account'),
(2, 1010002, 10, 1, 0, 'Accounts Receivable', ''),
(3, 4000001, 40, 0, 0, 'Registration Fees', ''),
(4, 3000001, 30, 0, 0, 'Capital Accounts', ''),
(5, 3000002, 30, 0, 0, 'Retained Earnings', ''),
(6, 1010003, 10, 1, 0, 'Cash on Hand', 'Cash'),
(8, 2010001, 20, 1, 0, 'Tax Payable', 'Tax payable'),
(14, 2010002, 20, 1, 0, 'Account Payable', ''),
(17, 4000002, 40, 0, 0, 'Loan Processing fee', 'Loan Processing fee');

-- --------------------------------------------------------

--
-- Table structure for table `account_inc`
--

CREATE TABLE `account_inc` (
  `id` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `accounttype` bigint(20) NOT NULL,
  `sub_account` int(11) NOT NULL,
  `last_account` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_inc`
--

INSERT INTO `account_inc` (`id`, `PIN`, `accounttype`, `sub_account`, `last_account`) VALUES
(1, 100, 10, 1, 10),
(3, 100, 10, 5, 11),
(4, 100, 20, 1, 19),
(5, 100, 20, 2, 10),
(6, 100, 30, 0, 13),
(7, 100, 40, 0, 16),
(8, 100, 50, 0, 40),
(9, 100, 10, 3, 19),
(10, 100, 10, 2, 10),
(11, 100, 10, 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `id` int(11) NOT NULL,
  `account` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `startwith` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`id`, `account`, `name`, `description`, `startwith`) VALUES
(1, 10, 'Asset', 'Asset', 10),
(2, 20, 'Liability', 'Liability', 20),
(3, 30, 'Equity', 'Equity', 30),
(4, 40, 'Income', 'Revenue', 40),
(5, 50, 'Expenses', 'Expenses', 50);

-- --------------------------------------------------------

--
-- Table structure for table `account_type_sub`
--

CREATE TABLE `account_type_sub` (
  `id` bigint(20) NOT NULL,
  `accounttype` int(11) NOT NULL,
  `sub_account` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `startwith` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type_sub`
--

INSERT INTO `account_type_sub` (`id`, `accounttype`, `sub_account`, `name`, `description`, `startwith`) VALUES
(2, 10, 4, 'Fixed Assets', 'Fixed Assets', 104),
(3, 10, 5, 'Other Assets', 'Other Assets', 105),
(4, 20, 1, 'Current Liabilities', 'Current Liabilities', 201),
(5, 20, 2, 'Long term Liabilities', 'Long term Liabilities', 202),
(6, 30, 0, 'Equity', 'Equity', 300),
(7, 40, 0, 'Income', 'Income', 400),
(8, 50, 0, 'Expenses', 'Expenses', 500),
(9, 10, 3, 'Loan Portifolio', 'Loan Portifolio', 103),
(10, 10, 2, 'Cash in Hand', 'Cash in Hand', 102),
(11, 10, 1, 'Bank Accounts', 'Bank Accounts', 101);

-- --------------------------------------------------------

--
-- Table structure for table `auto_inc`
--

CREATE TABLE `auto_inc` (
  `id` int(11) NOT NULL,
  `PID` bigint(20) NOT NULL COMMENT 'System Member ID',
  `GID` bigint(20) NOT NULL COMMENT 'Member Group ID',
  `saving` bigint(20) NOT NULL COMMENT 'Member saving account',
  `saving_type` bigint(20) NOT NULL COMMENT 'Saving account type',
  `account_chart` bigint(20) NOT NULL COMMENT 'account chart information',
  `loan` bigint(20) NOT NULL COMMENT 'Used as loan ID',
  `customreceipt` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auto_inc`
--

INSERT INTO `auto_inc` (`id`, `PID`, `GID`, `saving`, `saving_type`, `account_chart`, `loan`, `customreceipt`) VALUES
(1, 1000009, 102, 1000000, 2000, 100000, 1000012, 10007);

-- --------------------------------------------------------

--
-- Table structure for table `balance_nature`
--

CREATE TABLE `balance_nature` (
  `id` int(11) NOT NULL,
  `account` bigint(20) NOT NULL,
  `name` varchar(2) NOT NULL,
  `value` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance_nature`
--

INSERT INTO `balance_nature` (`id`, `account`, `name`, `value`) VALUES
(1, 1000000, 'CR', '-'),
(2, 1000000, 'DR', '+'),
(3, 2000000, 'CR', '+'),
(4, 2000000, 'DR', '-'),
(5, 3000000, 'CR', '+'),
(6, 3000000, 'DR', '-'),
(7, 4000000, 'CR', '+'),
(8, 4000000, 'DR', '-'),
(9, 5000000, 'CR', '-'),
(10, 5000000, 'DR', '+');

-- --------------------------------------------------------

--
-- Table structure for table `cardtype`
--

CREATE TABLE `cardtype` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cardtype`
--

INSERT INTO `cardtype` (`id`, `name`) VALUES
(2, 'Customer'),
(3, 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `client_inc`
--

CREATE TABLE `client_inc` (
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_inc`
--

INSERT INTO `client_inc` (`PIN`) VALUES
(101);

-- --------------------------------------------------------

--
-- Table structure for table `companyinfo`
--

CREATE TABLE `companyinfo` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `box` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(300) NOT NULL DEFAULT 'logo_dvi.png',
  `sms_token` varchar(200) NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PIN` bigint(20) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `landline` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companyinfo`
--

INSERT INTO `companyinfo` (`id`, `name`, `box`, `address`, `mobile`, `fax`, `email`, `logo`, `sms_token`, `createdby`, `createdon`, `PIN`, `reseller_id`, `landline`, `website`, `currency`) VALUES
(1, 'TANZANIA EDUCATION AUTHORITY', '34578 Dar es Salaam', 'Kambarage Road,  Plot No.717/3, Mikocheni Area', '255222775438', '255222775516', 'info@tea.or.tz', '1471830309teainnerlogo1.png', '', 1, '2015-08-23 14:30:58', 100, 2, '', 'http://amif.co.tz', 'TZS');

-- --------------------------------------------------------

--
-- Table structure for table `contribution_global`
--

CREATE TABLE `contribution_global` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `overdue_amount` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contribution_settings`
--

CREATE TABLE `contribution_settings` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `contribute_source` int(11) NOT NULL,
  `amount` double NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contribution_source`
--

CREATE TABLE `contribution_source` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contribution_source`
--

INSERT INTO `contribution_source` (`id`, `name`, `description`) VALUES
(1, 'CASH', ''),
(2, 'SALARY', ''),
(3, 'BANK DEPOSIT', ''),
(4, 'CHEQUE', '');

-- --------------------------------------------------------

--
-- Table structure for table `contribution_transaction`
--

CREATE TABLE `contribution_transaction` (
  `id` bigint(20) NOT NULL,
  `receipt` varchar(100) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `paymethod` varchar(50) NOT NULL,
  `cheque_num` varchar(40) NOT NULL,
  `amount` double NOT NULL,
  `trans_type` varchar(2) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `system_comment` varchar(100) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `previous_balance` double NOT NULL,
  `auto` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `sms_sent` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `customerid` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `additional` text NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`) VALUES
(1, 'Company'),
(2, 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `general_journal`
--

CREATE TABLE `general_journal` (
  `id` bigint(20) NOT NULL,
  `entryid` int(11) NOT NULL,
  `account` bigint(20) NOT NULL,
  `account_type` bigint(20) NOT NULL,
  `sub_account_type` bigint(20) NOT NULL,
  `entrydate` date NOT NULL,
  `description` text NOT NULL,
  `credit` double NOT NULL,
  `debit` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_journal_entry`
--

CREATE TABLE `general_journal_entry` (
  `id` bigint(20) NOT NULL,
  `entrydate` date NOT NULL,
  `description` text NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger`
--

CREATE TABLE `general_ledger` (
  `id` bigint(20) NOT NULL,
  `entryid` varchar(50) NOT NULL,
  `refferenceID` varchar(50) NOT NULL,
  `journalID` int(11) NOT NULL,
  `date` date NOT NULL,
  `account` bigint(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `credit` double NOT NULL,
  `debit` double NOT NULL,
  `linkto` varchar(100) NOT NULL,
  `fromtable` varchar(50) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `customerid` varchar(50) NOT NULL,
  `supplierid` varchar(50) NOT NULL,
  `balance` double NOT NULL,
  `account_type` int(11) NOT NULL,
  `sub_account_type` bigint(20) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '1',
  `invoiceid` int(11) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `classfication` int(11) NOT NULL,
  `loan_installno` int(11) NOT NULL,
  `classfication_reverse` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  `open_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_ledger`
--

INSERT INTO `general_ledger` (`id`, `entryid`, `refferenceID`, `journalID`, `date`, `account`, `description`, `credit`, `debit`, `linkto`, `fromtable`, `PID`, `member_id`, `customerid`, `supplierid`, `balance`, `account_type`, `sub_account_type`, `paid`, `invoiceid`, `LID`, `PIN`, `classfication`, `loan_installno`, `classfication_reverse`, `year`, `open_balance`) VALUES
(1, '2', '', 4, '2004-07-01', 1010001, 'Loan Disbursed', 318309226, 0, 'loan_contract.LID', 'loan_contract', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(2, '2', '', 4, '2004-07-01', 1030012, 'Loan Disbursed', 0, 318309226, 'loan_contract.LID', 'loan_contract', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(3, '3', '1', 4, '2006-10-11', 1030017, 'Interest For October, 2006', 0, 42399280, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(4, '3', '1', 4, '2006-10-11', 4000010, 'Interest For October, 2006', 42399280, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 40, 0, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(5, '3', '1', 4, '2006-10-11', 3000002, 'Interest For October, 2006', 42399280, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 30, 0, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(6, '4', '2', 4, '2007-10-11', 1030017, 'Interest For October, 2007', 0, 28266186.67, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(7, '4', '2', 4, '2007-10-11', 4000010, 'Interest For October, 2007', 28266186.67, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 40, 0, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(8, '4', '2', 4, '2007-10-11', 3000002, 'Interest For October, 2007', 28266186.67, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 30, 0, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(9, '5', '3', 4, '2008-10-11', 1030017, 'Interest For October, 2008', 0, 14133093.33, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(10, '5', '3', 4, '2008-10-11', 4000010, 'Interest For October, 2008', 14133093.33, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 40, 0, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(11, '5', '3', 4, '2008-10-11', 3000002, 'Interest For October, 2008', 14133093.33, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000001, '100001', '', '', 0, 30, 0, 0, 0, 'LN1000001', 100, 0, 0, 0, '2004/2005', 0),
(12, '6', '', 0, '2005-07-01', 1010001, 'Opening Balance', 318309226, 0, '', '', 0, '', '', '', 0, 10, 1, 1, 0, '', 100, 0, 0, 0, '2005/2006', 1),
(13, '6', '', 0, '2005-07-01', 1030012, 'Opening Balance', 0, 318309226, '', '', 0, '', '', '', 0, 10, 3, 1, 0, '', 100, 0, 0, 0, '2005/2006', 1),
(14, '7', '', 4, '2005-10-27', 1010001, 'Loan Disbursed', 98794241.5, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(15, '7', '', 4, '2005-10-27', 1030012, 'Loan Disbursed', 0, 98794241.5, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(16, '8', '', 4, '2005-11-02', 1010001, 'Loan Disbursed', 67200000, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(17, '8', '', 4, '2005-11-02', 1030012, 'Loan Disbursed', 0, 67200000, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(18, '9', '', 4, '2005-12-30', 1010001, 'Loan Disbursed', 100266325.01, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(19, '9', '', 4, '2005-12-30', 1030012, 'Loan Disbursed', 0, 100266325.01, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(20, '10', '', 4, '2006-01-26', 1010001, 'Loan Disbursed', 84346275.43, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(21, '10', '', 4, '2006-01-26', 1030012, 'Loan Disbursed', 0, 84346275.43, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(22, '11', '', 4, '2006-02-27', 1010001, 'Loan Disbursed', 20452233.14, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(23, '11', '', 4, '2006-02-27', 1030012, 'Loan Disbursed', 0, 20452233.14, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(24, '12', '', 4, '2006-03-13', 1010001, 'Loan Disbursed', 63252974.98, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(25, '12', '', 4, '2006-03-13', 1030012, 'Loan Disbursed', 0, 63252974.98, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(26, '13', '', 4, '2006-05-08', 1010001, 'Loan Disbursed', 27083785.24, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(27, '13', '', 4, '2006-05-08', 1030012, 'Loan Disbursed', 0, 27083785.24, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(28, '14', '', 4, '2006-06-12', 1010001, 'Loan Disbursed', 52121332.61, 0, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 1, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(29, '14', '', 4, '2006-06-12', 1030012, 'Loan Disbursed', 0, 52121332.61, 'loan_contract.LID', 'loan_contract', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2005/2006', 0),
(30, '15', '1', 2, '2016-11-29', 4000002, 'Loan Processing Fee ', 50000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000003, '100003', '', '', 0, 40, 0, 1, 0, 'LN1000003', 100, 0, 0, 0, '2005/2006', 0),
(31, '15', '1', 2, '2016-11-29', 3000002, 'Loan Processing Fee ', 50000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000003, '100003', '', '', 0, 30, 0, 1, 0, 'LN1000003', 100, 0, 0, 0, '2005/2006', 0),
(32, '15', '1', 2, '2016-11-29', 1020001, 'Loan Processing Fee ', 0, 50000, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000003, '100003', '', '', 0, 10, 2, 1, 0, 'LN1000003', 100, 0, 0, 0, '2005/2006', 0),
(33, '16', '', 4, '2005-11-30', 1010001, 'Loan Disbursed', 188909083, 0, 'loan_contract.LID', 'loan_contract', 1000003, '100003', '', '', 0, 10, 1, 0, 0, 'LN1000003', 100, 0, 0, 0, '2005/2006', 0),
(34, '16', '', 4, '2005-11-30', 1030012, 'Loan Disbursed', 0, 188909083, 'loan_contract.LID', 'loan_contract', 1000003, '100003', '', '', 0, 10, 3, 0, 0, 'LN1000003', 100, 0, 0, 0, '2005/2006', 0),
(35, '17', '2', 2, '2017-04-24', 4000002, 'Loan Processing Fee ', 25000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000005, 'OUT001', '', '', 0, 40, 0, 1, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(36, '17', '2', 2, '2017-04-24', 3000002, 'Loan Processing Fee ', 25000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000005, 'OUT001', '', '', 0, 30, 0, 1, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(37, '17', '2', 2, '2017-04-24', 1020001, 'Loan Processing Fee ', 0, 25000, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000005, 'OUT001', '', '', 0, 10, 2, 1, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(38, '18', '', 4, '2016-01-01', 1010001, 'Loan Disbursed', 250000000, 0, 'loan_contract.LID', 'loan_contract', 1000005, 'OUT001', '', '', 0, 10, 1, 0, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(39, '18', '', 4, '2016-01-01', 1030012, 'Loan Disbursed', 0, 250000000, 'loan_contract.LID', 'loan_contract', 1000005, 'OUT001', '', '', 0, 10, 3, 0, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(40, '19', '1', 4, '2017-04-24', 1030011, 'Balance For The Next Installment M', 0, 65000000, 'loan_balance_carry.id', 'loan_balance_carry', 1000005, 'OUT001', '', '', 0, 10, 1, 0, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(41, '19', '1', 4, '2017-04-24', 1030013, 'Balance For The Next Installment M', 65000000, 0, 'loan_balance_carry.id', 'loan_balance_carry', 1000005, 'OUT001', '', '', 0, 10, 3, 0, 0, 'LN1000004', 100, 0, 0, 0, '2005/2006', 0),
(42, '20', '3', 2, '2017-04-24', 4000002, 'Loan Processing Fee ', 25000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000001, '100001', '', '', 0, 40, 0, 1, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(43, '20', '3', 2, '2017-04-24', 3000002, 'Loan Processing Fee ', 25000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000001, '100001', '', '', 0, 30, 0, 1, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(44, '20', '3', 2, '2017-04-24', 1020001, 'Loan Processing Fee ', 0, 25000, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000001, '100001', '', '', 0, 10, 2, 1, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(45, '21', '', 4, '2016-02-01', 1010001, 'Loan Disbursed', 1718447655, 0, 'loan_contract.LID', 'loan_contract', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(46, '21', '', 4, '2016-02-01', 1030012, 'Loan Disbursed', 0, 1718447655, 'loan_contract.LID', 'loan_contract', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(47, '22', '2', 4, '2017-03-02', 1030011, 'Balance For The Next Installment M', 0, 446796390, 'loan_balance_carry.id', 'loan_balance_carry', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(48, '22', '2', 4, '2017-03-02', 1030013, 'Balance For The Next Installment M', 446796390, 0, 'loan_balance_carry.id', 'loan_balance_carry', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(49, '23', '', 4, '2017-04-27', 1010001, 'Loan Disbursed', 3000000000, 0, 'loan_contract.LID', 'loan_contract', 1000004, '100004', '', '', 0, 10, 1, 0, 0, 'LN1000006', 100, 0, 0, 0, '2005/2006', 0),
(50, '23', '', 4, '2017-04-27', 1030012, 'Loan Disbursed', 0, 3000000000, 'loan_contract.LID', 'loan_contract', 1000004, '100004', '', '', 0, 10, 3, 0, 0, 'LN1000006', 100, 0, 0, 0, '2005/2006', 0),
(51, '24', '2', 4, '2017-04-27', 1010001, 'Balance For The Next Installment M', 0, 3000000, 'loan_balance_carry.id', 'loan_balance_carry', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(52, '24', '2', 4, '2017-04-27', 1030013, 'Balance For The Next Installment M', 3000000, 0, 'loan_balance_carry.id', 'loan_balance_carry', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000005', 100, 0, 0, 0, '2005/2006', 0),
(53, '25', '1', 4, '2017-04-27', 1010001, 'Loan Repayment', 0, 100000000, 'loan_contract_repayment.id', 'loan_contract_repayment', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000001', 100, 0, 0, 0, '2005/2006', 0),
(54, '25', '1', 4, '2017-04-27', 1030017, 'Loan Repayment Interest', 42399280, 0, 'loan_contract_repayment.id', 'loan_contract_repayment', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2005/2006', 0),
(55, '25', '1', 4, '2017-04-27', 1030012, 'Loan Repayment Principle', 57600720, 0, 'loan_contract_repayment.id', 'loan_contract_repayment', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2005/2006', 0),
(56, '26', '4', 2, '2017-05-17', 4000002, 'Loan Processing Fee ', 10000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000005, 'OUT001', '', '', 0, 40, 0, 1, 0, 'LN1000008', 100, 0, 0, 0, '2005/2006', 0),
(57, '26', '4', 2, '2017-05-17', 3000002, 'Loan Processing Fee ', 10000, 0, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000005, 'OUT001', '', '', 0, 30, 0, 1, 0, 'LN1000008', 100, 0, 0, 0, '2005/2006', 0),
(58, '26', '4', 2, '2017-05-17', 1020001, 'Loan Processing Fee ', 0, 10000, 'loanprocessing_fee.id', 'loanprocessing_fee', 1000005, 'OUT001', '', '', 0, 10, 2, 1, 0, 'LN1000008', 100, 0, 0, 0, '2005/2006', 0),
(59, '28', '4', 4, '2006-09-16', 1030017, 'Interest For September, 2006', 0, 72000000, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2006/2007', 0),
(60, '28', '4', 4, '2006-09-16', 4000010, 'Interest For September, 2006', 72000000, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000002, '100002', '', '', 0, 40, 0, 0, 0, 'LN1000002', 100, 0, 0, 0, '2006/2007', 0),
(61, '28', '4', 4, '2006-09-16', 3000002, 'Interest For September, 2006', 72000000, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000002, '100002', '', '', 0, 30, 0, 0, 0, 'LN1000002', 100, 0, 0, 0, '2006/2007', 0),
(62, '29', '9', 4, '2007-01-03', 1030017, 'Interest For January, 2007', 0, 103106859.3, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000003, '100003', '', '', 0, 10, 3, 0, 0, 'LN1000003', 100, 0, 0, 0, '2006/2007', 0),
(63, '29', '9', 4, '2007-01-03', 4000010, 'Interest For January, 2007', 103106859.3, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000003, '100003', '', '', 0, 40, 0, 0, 0, 'LN1000003', 100, 0, 0, 0, '2006/2007', 0),
(64, '29', '9', 4, '2007-01-03', 3000002, 'Interest For January, 2007', 103106859.3, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000003, '100003', '', '', 0, 30, 0, 0, 0, 'LN1000003', 100, 0, 0, 0, '2006/2007', 0),
(65, '30', '', 4, '2016-12-07', 1010001, 'Loan Disbursed', 100000000, 0, 'loan_contract.LID', 'loan_contract', 1000006, 'BUNGE001', '', '', 0, 10, 1, 0, 0, 'LN1000009', 100, 0, 0, 0, '2006/2007', 0),
(66, '30', '', 4, '2016-12-07', 1030012, 'Loan Disbursed', 0, 100000000, 'loan_contract.LID', 'loan_contract', 1000006, 'BUNGE001', '', '', 0, 10, 3, 0, 0, 'LN1000009', 100, 0, 0, 0, '2006/2007', 0),
(67, '31', '3', 4, '2017-06-08', 1030011, 'Balance For The Next Installment M', 0, 21000000, 'loan_balance_carry.id', 'loan_balance_carry', 1000006, 'BUNGE001', '', '', 0, 10, 1, 0, 0, 'LN1000009', 100, 0, 0, 0, '2006/2007', 0),
(68, '31', '3', 4, '2017-06-08', 1030013, 'Balance For The Next Installment M', 21000000, 0, 'loan_balance_carry.id', 'loan_balance_carry', 1000006, 'BUNGE001', '', '', 0, 10, 3, 0, 0, 'LN1000009', 100, 0, 0, 0, '2006/2007', 0),
(69, '33', '5', 4, '2007-09-16', 1030017, 'Interest For September, 2007', 0, 57600000, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000002, '100002', '', '', 0, 10, 3, 0, 0, 'LN1000002', 100, 0, 0, 0, '2007/2008', 0),
(70, '33', '5', 4, '2007-09-16', 4000010, 'Interest For September, 2007', 57600000, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000002, '100002', '', '', 0, 40, 0, 0, 0, 'LN1000002', 100, 0, 0, 0, '2007/2008', 0),
(71, '33', '5', 4, '2007-09-16', 3000002, 'Interest For September, 2007', 57600000, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000002, '100002', '', '', 0, 30, 0, 0, 0, 'LN1000002', 100, 0, 0, 0, '2007/2008', 0),
(72, '34', '10', 4, '2008-01-03', 1030017, 'Interest For January, 2008', 0, 82485487.44, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000003, '100003', '', '', 0, 10, 3, 0, 0, 'LN1000003', 100, 0, 0, 0, '2007/2008', 0),
(73, '34', '10', 4, '2008-01-03', 4000010, 'Interest For January, 2008', 82485487.44, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000003, '100003', '', '', 0, 40, 0, 0, 0, 'LN1000003', 100, 0, 0, 0, '2007/2008', 0),
(74, '34', '10', 4, '2008-01-03', 3000002, 'Interest For January, 2008', 82485487.44, 0, 'loan_contract_repayment_unearned.id', 'loan_contract_repayment_unearned', 1000003, '100003', '', '', 0, 30, 0, 0, 0, 'LN1000003', 100, 0, 0, 0, '2007/2008', 0),
(75, '35', '', 4, '2011-11-01', 1010001, 'Loan Disbursed', 53486400, 0, 'loan_contract.LID', 'loan_contract', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000011', 100, 0, 0, 0, '2007/2008', 0),
(76, '35', '', 4, '2011-11-01', 1030013, 'Loan Disbursed', 0, 53486400, 'loan_contract.LID', 'loan_contract', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000011', 100, 0, 0, 0, '2007/2008', 0),
(77, '36', '2', 4, '2007-06-20', 1010001, 'Loan Repayment', 0, 200000000, 'loan_contract_repayment.id', 'loan_contract_repayment', 1000001, '100001', '', '', 0, 10, 1, 0, 0, 'LN1000001', 100, 0, 0, 0, '2007/2008', 0),
(78, '36', '2', 4, '2007-06-20', 1030012, 'Loan Repayment Principle', 200000000, 0, 'loan_contract_repayment.id', 'loan_contract_repayment', 1000001, '100001', '', '', 0, 10, 3, 0, 0, 'LN1000001', 100, 0, 0, 0, '2007/2008', 0),
(79, '37', '1', 2, '2018-09-18', 4000001, 'Member Registration', 700000, 0, 'member_registrationfee.PID', 'member_registrationfee', 1000008, 'ERT7899', '', '', 0, 40, 0, 1, 0, '', 100, 0, 0, 0, '', 0),
(80, '37', '1', 2, '2018-09-18', 3000002, 'Member Registration', 700000, 0, 'member_registrationfee.PID', 'member_registrationfee', 1000008, 'ERT7899', '', '', 0, 30, 0, 1, 0, '', 100, 0, 0, 0, '', 0),
(81, '37', '1', 2, '2018-09-18', 1010001, 'Member Registration', 0, 700000, 'member_registrationfee.PID', 'member_registrationfee', 1000008, 'ERT7899', '', '', 0, 10, 1, 1, 0, '', 100, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger_entry`
--

CREATE TABLE `general_ledger_entry` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_ledger_entry`
--

INSERT INTO `general_ledger_entry` (`id`, `date`, `PIN`) VALUES
(1, '2016-11-01', 0),
(2, '2004-07-01', 100),
(3, '2016-11-01', 100),
(4, '2016-11-01', 100),
(5, '2016-11-01', 100),
(6, '2016-11-01', 0),
(7, '2005-10-27', 100),
(8, '2005-11-02', 100),
(9, '2005-12-30', 100),
(10, '2006-01-26', 100),
(11, '2006-02-27', 100),
(12, '2006-03-13', 100),
(13, '2006-05-08', 100),
(14, '2006-06-12', 100),
(15, '2016-11-29', 0),
(16, '2005-11-30', 100),
(17, '2017-04-24', 0),
(18, '2016-01-01', 100),
(19, '2017-04-24', 100),
(20, '2017-04-24', 0),
(21, '2016-02-01', 100),
(22, '2017-03-02', 100),
(23, '2017-04-27', 100),
(24, '2017-04-27', 100),
(25, '2017-04-27', 100),
(26, '2017-05-17', 0),
(27, '2017-05-23', 0),
(28, '2006-09-16', 100),
(29, '2007-01-03', 100),
(30, '2016-12-07', 100),
(31, '2017-06-08', 100),
(32, '2017-07-14', 0),
(33, '2007-09-16', 100),
(34, '2008-01-03', 100),
(35, '2011-11-01', 100),
(36, '2007-06-20', 100),
(37, '2018-09-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `global_setting`
--

CREATE TABLE `global_setting` (
  `id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `is_number` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_setting`
--

INSERT INTO `global_setting` (`id`, `key`, `text`, `is_number`, `PIN`) VALUES
(1, 'SALES_QUOTE_NOTE', '', 0, 100),
(2, 'REGISTRATION_FEE', '', 1, 100),
(3, 'SALES_INVOICE_NOTE', '', 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `global_setting_default`
--

CREATE TABLE `global_setting_default` (
  `id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `is_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_setting_default`
--

INSERT INTO `global_setting_default` (`id`, `key`, `text`, `is_number`) VALUES
(1, 'SALES_QUOTE_NOTE', '', 0),
(2, 'REGISTRATION_FEE', '', 1),
(3, 'SALES_INVOICE_NOTE', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `PIN`) VALUES
(1, 'admin', 'Administrator', 0),
(3, 'Members', 'Members', 0),
(4, 'Administrator', 'Administrator', 100),
(5, 'Loan_Officer', 'Loan Officer', 100),
(6, 'Super_Users', 'Access to all System Functionalities', 100),
(7, 'Finance_Director', 'Director of Finance', 100);

-- --------------------------------------------------------

--
-- Table structure for table `invoicetype`
--

CREATE TABLE `invoicetype` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicetype`
--

INSERT INTO `invoicetype` (`id`, `name`) VALUES
(1, 'Sales'),
(2, 'Purchase');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_purchase_transaction`
--

CREATE TABLE `invoice_payment_purchase_transaction` (
  `id` bigint(20) NOT NULL,
  `paydate` date NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `supplierid` varchar(50) NOT NULL,
  `trans_type` varchar(2) NOT NULL DEFAULT 'CR',
  `paymethod` varchar(50) NOT NULL,
  `cheque_num` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `comment` text NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `previous_balance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_transaction`
--

CREATE TABLE `invoice_payment_transaction` (
  `id` bigint(20) NOT NULL,
  `paydate` date NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `customerid` varchar(50) NOT NULL,
  `trans_type` varchar(2) NOT NULL DEFAULT 'CR',
  `paymethod` varchar(50) NOT NULL,
  `cheque_num` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `comment` text NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `previous_balance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `account` bigint(20) NOT NULL,
  `taxcode` varchar(50) NOT NULL,
  `invoicetype` int(11) NOT NULL COMMENT '1= Sales, 2= Purchases',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` bigint(20) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `type`) VALUES
(1, 'Sales Invoice'),
(2, 'Member Registration'),
(3, 'Received Money'),
(4, 'Loan Receivable'),
(5, 'Journal Entries / General Journal'),
(6, 'Purchase Invoice');

-- --------------------------------------------------------

--
-- Table structure for table `loanprocessing_fee`
--

CREATE TABLE `loanprocessing_fee` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `LID` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(3) NOT NULL DEFAULT 'CR',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` bigint(20) NOT NULL,
  `PIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loanprocessing_fee`
--

INSERT INTO `loanprocessing_fee` (`id`, `PID`, `member_id`, `LID`, `amount`, `type`, `createdon`, `createdby`, `PIN`) VALUES
(1, 1000003, '100003', 'LN1000003', 50000, 'CR', '2016-11-29 09:58:12', 2, 100),
(2, 1000005, 'OUT001', 'LN1000004', 25000, 'CR', '2017-04-24 12:30:13', 2, 100),
(3, 1000001, '100001', 'LN1000005', 25000, 'CR', '2017-04-24 12:58:47', 2, 100),
(4, 1000005, 'OUT001', 'LN1000008', 10000, 'CR', '2017-05-17 08:33:55', 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_balance_carry`
--

CREATE TABLE `loan_balance_carry` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `balance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_balance_carry`
--

INSERT INTO `loan_balance_carry` (`id`, `LID`, `balance`, `PIN`) VALUES
(1, 'LN1000004', 65000000, 100),
(2, 'LN1000005', 449796390, 100),
(3, 'LN1000009', 21000000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract`
--

CREATE TABLE `loan_contract` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `product_type` int(11) NOT NULL,
  `rate` double NOT NULL,
  `interval` int(11) NOT NULL,
  `penalt_percent` double NOT NULL,
  `basic_amount` double NOT NULL,
  `number_istallment` int(11) NOT NULL,
  `pay_source` varchar(50) NOT NULL,
  `applicationdate` date NOT NULL,
  `monthly_income` double NOT NULL,
  `loan_purpose` text NOT NULL,
  `installment_amount` double NOT NULL,
  `total_interest_amount` double NOT NULL,
  `total_loan` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `edit` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = New, 1= Evaluated, 2 = Rejected, 3 = Evaluate & Need changes, 4 = Accepted,  5= Closed',
  `evaluated` varchar(50) NOT NULL,
  `approval` int(11) NOT NULL,
  `disburse` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL,
  `loan_principle_account` varchar(50) NOT NULL,
  `multiple_disburse_status` int(11) NOT NULL COMMENT '0=undisbursed, 1=partial disbursed, 2=complete disbursed',
  `loan_applied` double NOT NULL,
  `push_to_evaluation` int(11) NOT NULL COMMENT '0 = unpushed, 1 = pushed for evaluation',
  `grace_period` int(11) NOT NULL,
  `grace_period_unit` varchar(250) NOT NULL,
  `is_existing_loan` int(1) NOT NULL DEFAULT '0',
  `original_amount` double DEFAULT NULL,
  `original_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract`
--

INSERT INTO `loan_contract` (`id`, `LID`, `PID`, `member_id`, `product_type`, `rate`, `interval`, `penalt_percent`, `basic_amount`, `number_istallment`, `pay_source`, `applicationdate`, `monthly_income`, `loan_purpose`, `installment_amount`, `total_interest_amount`, `total_loan`, `createdon`, `createdby`, `edit`, `status`, `evaluated`, `approval`, `disburse`, `PIN`, `loan_principle_account`, `multiple_disburse_status`, `loan_applied`, `push_to_evaluation`, `grace_period`, `grace_period_unit`, `is_existing_loan`, `original_amount`, `original_date`) VALUES
(1, 'LN1000001', 1000001, '100001', 7, 4, 3, 0, 1059982000, 3, 'CHEQUE', '2004-10-11', 0, 'RE MODELLING OF DAR CAMPUS', 0, 84798560, 1144780560, '2016-11-01 09:01:07', 2, 1, 4, '1', 4, 1, 100, '1030012', 1, 1059982000, 1, 0, '', 0, NULL, NULL),
(2, 'LN1000002', 1000002, '100002', 7, 6, 3, 0, 1200000000, 5, 'CHEQUE', '2005-09-16', 0, 'CONSTRUCTION OF HOSTEL', 0, 216000000, 1416000000, '2016-11-01 09:45:37', 2, 1, 4, '1', 4, 1, 100, '1030012', 1, 1200000000, 1, 0, '', 0, NULL, NULL),
(3, 'LN1000003', 1000003, '100003', 7, 6, 3, 0, 1718447655, 5, 'CHEQUE', '2005-01-01', 0, 'Construction of  lecture theatres', 0, 309320577.9, 2027768232.9, '2016-11-29 09:58:12', 2, 1, 4, '1', 4, 1, 100, '1030012', 1, 1718447655, 1, 0, '', 0, NULL, NULL),
(4, 'LN1000004', 1000005, 'OUT001', 7, 6, 3, 0, 250000000, 5, 'BANK DEPOSIT', '2015-08-05', 0, 'Loan for construction of Lecturer theater.', 0, 45000000, 295000000, '2017-04-24 12:30:13', 2, 1, 4, '1', 4, 1, 100, '1030012', 2, 250000000, 1, 0, '', 0, NULL, NULL),
(5, 'LN1000005', 1000001, '100001', 7, 6, 3, 3, 1718447655, 5, 'BANK DEPOSIT', '2016-07-04', 0, 'LOAN', 0, 309320577.9, 2027768232.9, '2017-04-24 12:58:47', 2, 1, 4, '1', 4, 1, 100, '1030012', 2, 1718447655, 1, 0, '', 0, NULL, NULL),
(6, 'LN1000006', 1000004, '100004', 7, 6, 3, 0, 3000000000, 5, 'BANK DEPOSIT', '2017-04-27', 0, 'fff', 0, 540000000, 3540000000, '2017-04-27 09:30:43', 2, 1, 4, '1', 4, 1, 100, '1030012', 2, 3000000000, 1, 0, '', 0, NULL, NULL),
(7, 'LN1000008', 1000005, 'OUT001', 5, 6, 1, 0, 70000000, 7, 'CASH', '2017-05-17', 0, 'loan', 10200997.49, 1406982.41, 71406982.41, '2017-05-17 08:33:55', 1, 0, 0, '', 0, 0, 100, '', 0, 100000000, 0, 1, 'days', 1, 100000000, '2017-05-17'),
(8, 'LN1000009', 1000006, 'BUNGE001', 7, 6, 3, 0, 100000000, 6, 'BANK DEPOSIT', '2013-12-01', 0, 'Loan balance for Bunge primary school.', 0, 21000000, 121000000, '2017-06-08 10:32:35', 2, 1, 4, '1', 4, 1, 100, '1030012', 2, 100000000, 1, 0, '', 1, 400000000, '2014-01-01'),
(9, 'LN1000010', 1000007, 'AB/152/2016/01', 7, 4, 3, 0, 34097556, 4, 'BANK DEPOSIT', '2011-11-30', 0, 'EXISTING LOAN', 0, 3409755.6, 37507311.6, '2017-07-14 08:47:49', 2, 0, 0, '', 0, 0, 100, '', 0, 100000000, 0, 0, 'years', 1, 100000000, '2011-11-30'),
(10, 'LN1000011', 1000001, '100001', 7, 0, 3, 0, 53486400, 4, 'CHEQUE', '2013-11-12', 0, 'Existing loan', 0, 0, 53486400, '2017-07-14 09:02:13', 2, 1, 4, '1', 4, 1, 100, '1030013', 2, 53486400, 1, 0, '', 1, 100000000, '2013-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_approve`
--

CREATE TABLE `loan_contract_approve` (
  `id` int(11) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_approve`
--

INSERT INTO `loan_contract_approve` (`id`, `LID`, `status`, `comment`, `createdby`, `createdon`, `PIN`) VALUES
(1, 'LN1000001', '4', 'LOAN APPROVED ', 2, '2016-11-01 09:05:27', 100),
(2, 'LN1000002', '4', 'LOAN APPROVED', 2, '2016-11-01 09:46:34', 100),
(3, 'LN1000003', '4', ' Loan has been approved ', 14, '2016-11-29 10:01:48', 100),
(4, 'LN1000004', '4', ' Approved by award committee', 2, '2017-04-24 12:32:20', 100),
(5, 'LN1000005', '4', ' Approved', 2, '2017-04-24 13:43:22', 100),
(6, 'LN1000006', '4', ' d', 2, '2017-04-27 09:33:06', 100),
(7, 'LN1000009', '4', ' Approved', 2, '2017-06-08 10:35:18', 100),
(8, 'LN1000011', '4', '  Approved', 2, '2017-07-14 08:58:32', 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_business`
--

CREATE TABLE `loan_contract_business` (
  `id` bigint(20) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `business_name` text NOT NULL,
  `business_location` text NOT NULL,
  `business_type` varchar(300) NOT NULL,
  `location_since` text NOT NULL,
  `business_since` varchar(300) NOT NULL,
  `is_tz_citizen` int(11) NOT NULL,
  `is_owner` int(11) NOT NULL,
  `is_operate` int(11) NOT NULL,
  `exercising_activity` int(11) NOT NULL,
  `activity_past6month` int(11) NOT NULL,
  `relative_employee` int(11) NOT NULL,
  `employee_name` varchar(400) NOT NULL,
  `is_government_institution` int(11) NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_declaration`
--

CREATE TABLE `loan_contract_declaration` (
  `id` int(11) NOT NULL,
  `LID` varchar(100) NOT NULL,
  `declaration` text NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_declaration`
--

INSERT INTO `loan_contract_declaration` (`id`, `LID`, `declaration`, `PIN`) VALUES
(1, 'LN1000005', 'Collateral submitted by Mzumbe is registered title.', 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_disburse`
--

CREATE TABLE `loan_contract_disburse` (
  `id` int(11) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `disbursedate` date NOT NULL,
  `disburseamount` double NOT NULL,
  `comment` text NOT NULL,
  `paymethod` varchar(250) NOT NULL,
  `cheque_no` varchar(250) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_disburse`
--

INSERT INTO `loan_contract_disburse` (`id`, `LID`, `disbursedate`, `disburseamount`, `comment`, `paymethod`, `cheque_no`, `createdby`, `createdon`, `PIN`) VALUES
(1, 'LN1000001', '2004-07-01', 318309226, 'CERTIFICATE 1', 'CHEQUE', '001', 2, '2016-11-01 09:09:44', 100),
(2, 'LN1000002', '2005-10-27', 98794241.5, ' CERTIFICATE 1', 'CHEQUE', '372932', 2, '2016-11-01 09:48:53', 100),
(3, 'LN1000002', '2005-11-02', 67200000, ' CERTIFICATE 2', 'CHEQUE', '372941', 2, '2016-11-01 09:50:54', 100),
(4, 'LN1000002', '2005-12-30', 100266325.01, ' CERTIFICATE 3', 'CHEQUE', '445252', 2, '2016-11-01 09:52:55', 100),
(5, 'LN1000002', '2006-01-26', 84346275.43, ' CERTIFICATE 4', 'CHEQUE', '445276', 2, '2016-11-01 10:03:18', 100),
(6, 'LN1000002', '2006-02-27', 20452233.14, ' CERTIFICATE 5', 'CHEQUE', '445293', 2, '2016-11-01 10:05:18', 100),
(7, 'LN1000002', '2006-03-13', 63252974.98, ' CERTIFICATE 6', 'CHEQUE', '445310', 2, '2016-11-01 10:12:14', 100),
(8, 'LN1000002', '2006-05-08', 27083785.24, ' CERTIFICATE 7', 'CHEQUE', '445348', 2, '2016-11-01 10:15:48', 100),
(9, 'LN1000002', '2006-06-12', 52121332.61, ' CERTIFICATE 8', 'CHEQUE', '445364', 2, '2016-11-01 10:22:45', 100),
(10, 'LN1000003', '2005-11-30', 188909083, ' Certificate no 1  ', '', '', 14, '2016-11-29 10:07:33', 100),
(11, 'LN1000004', '2016-01-01', 250000000, ' Disbursed by first installment', 'BANK DEPOSIT', '', 2, '2017-04-24 12:35:04', 100),
(12, 'LN1000005', '2016-02-01', 1718447655, ' disbursed all amount', 'BANK DEPOSIT', '', 2, '2017-04-24 13:44:44', 100),
(13, 'LN1000006', '2017-04-27', 3000000000, ' www', 'BANK DEPOSIT', '', 2, '2017-04-27 09:34:07', 100),
(14, 'LN1000009', '2016-12-07', 100000000, ' Disbursed.', 'BANK DEPOSIT', '', 2, '2017-06-08 10:37:02', 100),
(15, 'LN1000011', '2011-11-01', 53486400, ' loan disbursed.', 'CASH', '', 2, '2017-07-14 09:14:29', 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_evaluation`
--

CREATE TABLE `loan_contract_evaluation` (
  `id` int(11) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_evaluation`
--

INSERT INTO `loan_contract_evaluation` (`id`, `LID`, `status`, `comment`, `createdby`, `createdon`, `PIN`) VALUES
(1, 'LN1000001', '1', ' LOAN IS VIABLE', 2, '2016-11-01 09:04:01', 100),
(2, 'LN1000002', '1', ' LOAN IS VIABLE', 2, '2016-11-01 09:46:11', 100),
(3, 'LN1000003', '1', 'The Loan is economically Viable', 14, '2016-11-29 10:01:14', 100),
(4, 'LN1000004', '1', ' Evaluated', 2, '2017-04-24 12:31:41', 100),
(5, 'LN1000005', '1', ' evaluated', 2, '2017-04-24 13:43:00', 100),
(6, 'LN1000006', '1', ' dd', 2, '2017-04-27 09:32:35', 100),
(7, 'LN1000009', '1', ' Evaluated ', 2, '2017-06-08 10:34:54', 100),
(8, 'LN1000011', '1', ' Evaluated successfully', 2, '2017-07-14 08:57:37', 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_guarantor`
--

CREATE TABLE `loan_contract_guarantor` (
  `id` int(11) NOT NULL,
  `LID` varchar(100) NOT NULL,
  `name` varchar(400) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `declaration` text NOT NULL,
  `relationship` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `request` int(11) NOT NULL,
  `request_status` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_repayment`
--

CREATE TABLE `loan_contract_repayment` (
  `id` bigint(20) NOT NULL,
  `receipt` varchar(100) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `installment` int(11) NOT NULL,
  `amount` double NOT NULL,
  `penalt` double NOT NULL,
  `paydate` date NOT NULL,
  `interest` double NOT NULL,
  `duedate` date NOT NULL,
  `principle` double NOT NULL,
  `balance` double NOT NULL,
  `penalty_months` int(11) NOT NULL,
  `iliyobaki` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_repayment`
--

INSERT INTO `loan_contract_repayment` (`id`, `receipt`, `LID`, `installment`, `amount`, `penalt`, `paydate`, `interest`, `duedate`, `principle`, `balance`, `penalty_months`, `iliyobaki`, `createdon`, `createdby`, `month`, `PIN`) VALUES
(1, 'FUY632200001', 'LN1000001', 1, 100000000, 0, '2017-04-27', 42399280, '2006-10-11', 57600720, 1044780560, 0, 0, '2017-04-27 09:56:29', 2, '', 100),
(2, '5ZMD1G300001', 'LN1000001', 1, 200000000, 0, '2007-06-20', 0, '2006-10-11', 200000000, 844780560, 0, 0, '2017-07-14 09:25:49', 2, '', 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_repayment_schedule`
--

CREATE TABLE `loan_contract_repayment_schedule` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `installment_number` int(11) NOT NULL,
  `repaydate` date NOT NULL,
  `repayamount` double NOT NULL,
  `interest` double NOT NULL,
  `principle` double NOT NULL,
  `balance` double NOT NULL,
  `status` int(11) NOT NULL,
  `write_off` int(11) NOT NULL,
  `sms_sent` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `provision_last` date NOT NULL,
  `unearned` int(11) NOT NULL,
  `insufficient_paid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_repayment_schedule`
--

INSERT INTO `loan_contract_repayment_schedule` (`id`, `LID`, `installment_number`, `repaydate`, `repayamount`, `interest`, `principle`, `balance`, `status`, `write_off`, `sms_sent`, `month`, `PIN`, `provision_last`, `unearned`, `insufficient_paid`) VALUES
(1, 'LN1000001', 1, '2006-10-11', 395726613.33, 42399280, 353327333.33, 749053946.67, 0, 0, 0, '200610', 100, '0000-00-00', 1, 300000000),
(2, 'LN1000001', 2, '2007-10-11', 381593520, 28266186.67, 353327333.33, 367460426.67, 0, 0, 0, '200710', 100, '0000-00-00', 1, 0),
(3, 'LN1000001', 3, '2008-10-11', 367460426.66, 14133093.33, 353327333.33, 0.01, 0, 0, 0, '200810', 100, '0000-00-00', 1, 0),
(4, 'LN1000002', 1, '2006-09-16', 312000000, 72000000, 240000000, 1104000000, 0, 0, 0, '200609', 100, '0000-00-00', 1, 0),
(5, 'LN1000002', 2, '2007-09-16', 297600000, 57600000, 240000000, 806400000, 0, 0, 0, '200709', 100, '0000-00-00', 1, 0),
(6, 'LN1000002', 3, '2008-09-16', 283200000, 43200000, 240000000, 523200000, 0, 0, 0, '200809', 100, '0000-00-00', 0, 0),
(7, 'LN1000002', 4, '2009-09-16', 268800000, 28800000, 240000000, 254400000, 0, 0, 0, '200909', 100, '0000-00-00', 0, 0),
(8, 'LN1000002', 5, '2010-09-16', 254400000, 14400000, 240000000, 0, 0, 0, 0, '201009', 100, '0000-00-00', 0, 0),
(9, 'LN1000003', 1, '2007-01-03', 446796390.3, 103106859.3, 343689531, 1580971842.6, 0, 0, 0, '200701', 100, '0000-00-00', 1, 0),
(10, 'LN1000003', 2, '2008-01-03', 426175018.44, 82485487.44, 343689531, 1154796824.16, 0, 0, 0, '200801', 100, '0000-00-00', 1, 0),
(11, 'LN1000003', 3, '2009-01-03', 405553646.58, 61864115.58, 343689531, 749243177.58, 0, 0, 0, '200901', 100, '0000-00-00', 0, 0),
(12, 'LN1000003', 4, '2010-01-03', 384932274.72, 41242743.72, 343689531, 364310902.86, 0, 0, 0, '201001', 100, '0000-00-00', 0, 0),
(13, 'LN1000003', 5, '2011-01-03', 364310902.86, 20621371.86, 343689531, 0, 0, 0, 0, '201101', 100, '0000-00-00', 0, 0),
(14, 'LN1000004', 1, '2017-04-30', 65000000, 15000000, 50000000, 230000000, 0, 0, 0, '201704', 100, '0000-00-00', 0, 0),
(15, 'LN1000004', 2, '2018-04-30', 62000000, 12000000, 50000000, 168000000, 0, 0, 0, '201804', 100, '0000-00-00', 0, 0),
(16, 'LN1000004', 3, '2019-04-30', 59000000, 9000000, 50000000, 109000000, 0, 0, 0, '201904', 100, '0000-00-00', 0, 0),
(17, 'LN1000004', 4, '2020-04-30', 56000000, 6000000, 50000000, 53000000, 0, 0, 0, '202004', 100, '0000-00-00', 0, 0),
(18, 'LN1000004', 5, '2021-04-30', 53000000, 3000000, 50000000, 0, 0, 0, 0, '202104', 100, '0000-00-00', 0, 0),
(19, 'LN1000005', 1, '2017-03-01', 446796390.3, 103106859.3, 343689531, 1580971842.6, 0, 0, 0, '201703', 100, '0000-00-00', 0, 0),
(20, 'LN1000005', 2, '2018-03-01', 426175018.44, 82485487.44, 343689531, 1154796824.16, 0, 0, 0, '201803', 100, '0000-00-00', 0, 0),
(21, 'LN1000005', 3, '2019-03-01', 405553646.58, 61864115.58, 343689531, 749243177.58, 0, 0, 0, '201903', 100, '0000-00-00', 0, 0),
(22, 'LN1000005', 4, '2020-03-01', 384932274.72, 41242743.72, 343689531, 364310902.86, 0, 0, 0, '202003', 100, '0000-00-00', 0, 0),
(23, 'LN1000005', 5, '2021-03-01', 364310902.86, 20621371.86, 343689531, 0, 0, 0, 0, '202103', 100, '0000-00-00', 0, 0),
(24, 'LN1000006', 1, '2017-04-27', 780000000, 180000000, 600000000, 2760000000, 0, 0, 0, '201704', 100, '0000-00-00', 0, 0),
(25, 'LN1000006', 2, '2018-04-27', 744000000, 144000000, 600000000, 2016000000, 0, 0, 0, '201804', 100, '0000-00-00', 0, 0),
(26, 'LN1000006', 3, '2019-04-27', 708000000, 108000000, 600000000, 1308000000, 0, 0, 0, '201904', 100, '0000-00-00', 0, 0),
(27, 'LN1000006', 4, '2020-04-27', 672000000, 72000000, 600000000, 636000000, 0, 0, 0, '202004', 100, '0000-00-00', 0, 0),
(28, 'LN1000006', 5, '2021-04-27', 636000000, 36000000, 600000000, 0, 0, 0, 0, '202104', 100, '0000-00-00', 0, 0),
(29, 'LN1000009', 1, '2017-06-08', 22666666.67, 6000000, 16666666.67, 98333333.33, 0, 0, 0, '201706', 100, '0000-00-00', 0, 0),
(30, 'LN1000009', 2, '2018-06-08', 21666666.67, 5000000, 16666666.67, 76666666.66, 0, 0, 0, '201806', 100, '0000-00-00', 0, 0),
(31, 'LN1000009', 3, '2019-06-08', 20666666.67, 4000000, 16666666.67, 55999999.99, 0, 0, 0, '201906', 100, '0000-00-00', 0, 0),
(32, 'LN1000009', 4, '2020-06-08', 19666666.67, 3000000, 16666666.67, 36333333.32, 0, 0, 0, '202006', 100, '0000-00-00', 0, 0),
(33, 'LN1000009', 5, '2021-06-08', 18666666.67, 2000000, 16666666.67, 17666666.65, 0, 0, 0, '202106', 100, '0000-00-00', 0, 0),
(34, 'LN1000009', 6, '2022-06-08', 17666666.67, 1000000, 16666666.67, 0, 0, 0, 0, '202206', 100, '0000-00-00', 0, 0),
(35, 'LN1000011', 1, '2012-07-01', 13371600, 0, 13371600, 40114800, 0, 0, 0, '201207', 100, '0000-00-00', 0, 0),
(36, 'LN1000011', 2, '2013-07-01', 13371600, 0, 13371600, 26743200, 0, 0, 0, '201307', 100, '0000-00-00', 0, 0),
(37, 'LN1000011', 3, '2014-07-01', 13371600, 0, 13371600, 13371600, 0, 0, 0, '201407', 100, '0000-00-00', 0, 0),
(38, 'LN1000011', 4, '2015-07-01', 13371600, 0, 13371600, 0, 0, 0, 0, '201507', 100, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_repayment_unearned`
--

CREATE TABLE `loan_contract_repayment_unearned` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `installment_number` int(11) NOT NULL,
  `repaydate` date NOT NULL,
  `repayamount` double NOT NULL,
  `interest` double NOT NULL,
  `principle` double NOT NULL,
  `balance` double NOT NULL,
  `status` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `earned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_repayment_unearned`
--

INSERT INTO `loan_contract_repayment_unearned` (`id`, `LID`, `installment_number`, `repaydate`, `repayamount`, `interest`, `principle`, `balance`, `status`, `PIN`, `earned`) VALUES
(1, 'LN1000001', 1, '2006-10-11', 395726613.33, 42399280, 353327333.33, 749053946.67, 0, 100, 0),
(2, 'LN1000001', 2, '2007-10-11', 381593520, 28266186.67, 353327333.33, 367460426.67, 0, 100, 0),
(3, 'LN1000001', 3, '2008-10-11', 367460426.66, 14133093.33, 353327333.33, 0.01, 0, 100, 0),
(4, 'LN1000002', 1, '2006-09-16', 312000000, 72000000, 240000000, 1104000000, 0, 100, 0),
(5, 'LN1000002', 2, '2007-09-16', 297600000, 57600000, 240000000, 806400000, 0, 100, 0),
(9, 'LN1000003', 1, '2007-01-03', 446796390.3, 103106859.3, 343689531, 1580971842.6, 0, 100, 0),
(10, 'LN1000003', 2, '2008-01-03', 426175018.44, 82485487.44, 343689531, 1154796824.16, 0, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract_supportdoc`
--

CREATE TABLE `loan_contract_supportdoc` (
  `id` int(11) NOT NULL,
  `LID` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `file` varchar(200) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_contract_supportdoc`
--

INSERT INTO `loan_contract_supportdoc` (`id`, `LID`, `comment`, `file`, `PIN`) VALUES
(1, 'LN1000005', 'copy of title', '149303887019ic.pdf', 100);

-- --------------------------------------------------------

--
-- Table structure for table `loan_interest_method`
--

CREATE TABLE `loan_interest_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_interest_method`
--

INSERT INTO `loan_interest_method` (`id`, `name`) VALUES
(1, 'Reducing Method'),
(2, 'Flat Interest Method');

-- --------------------------------------------------------

--
-- Table structure for table `loan_interval`
--

CREATE TABLE `loan_interval` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_interval`
--

INSERT INTO `loan_interval` (`id`, `name`, `description`) VALUES
(1, 'Monthly', 'Month(s)'),
(2, 'Weekly', 'Week(s)'),
(3, 'Yearly', 'Year(s)');

-- --------------------------------------------------------

--
-- Table structure for table `loan_penalt_method`
--

CREATE TABLE `loan_penalt_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_penalt_method`
--

INSERT INTO `loan_penalt_method` (`id`, `name`) VALUES
(1, 'Once On Principle'),
(2, 'Once on Principle & Interest'),
(3, 'Customized (AMIF)');

-- --------------------------------------------------------

--
-- Table structure for table `loan_product`
--

CREATE TABLE `loan_product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `interval` int(11) NOT NULL,
  `interest_rate` double NOT NULL,
  `interest_method` int(11) NOT NULL,
  `penalt_method` int(11) NOT NULL,
  `penalt_percentage` double NOT NULL,
  `maxmum_time` double NOT NULL,
  `loan_security_share_min` int(11) NOT NULL,
  `loan_security_contribution_min` double NOT NULL,
  `loan_security_saving_minimum` double NOT NULL,
  `loan_security_contribution_times` int(11) NOT NULL,
  `loan_principle_account` bigint(20) NOT NULL,
  `loan_interest_account` bigint(20) NOT NULL,
  `loan_penalt_account` bigint(20) NOT NULL,
  `loan_prepayment_account` bigint(20) NOT NULL,
  `loan_interest_receivable_account` bigint(20) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `warning_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_product`
--

INSERT INTO `loan_product` (`id`, `name`, `description`, `interval`, `interest_rate`, `interest_method`, `penalt_method`, `penalt_percentage`, `maxmum_time`, `loan_security_share_min`, `loan_security_contribution_min`, `loan_security_saving_minimum`, `loan_security_contribution_times`, `loan_principle_account`, `loan_interest_account`, `loan_penalt_account`, `loan_prepayment_account`, `loan_interest_receivable_account`, `PIN`, `warning_day`) VALUES
(4, 'TEA STAFF LOAN', 'TEA STAFF LOAN', 1, 3, 2, 1, 0, 72, 0, 0, 0, 0, 0, 4000014, 4000011, 1030013, 1030016, 100, 0),
(5, 'INSTITUTIONAL LOAN MONTHLY', 'INSTITUTIONAL LOAN MONTHLY', 1, 6, 1, 1, 0, 72, 0, 0, 0, 0, 0, 4000010, 4000011, 1030013, 1030017, 100, 0),
(6, 'OTHER LOAN', 'OTHER LOAN', 1, 6, 1, 1, 0, 0, 0, 0, 0, 0, 0, 4000015, 4000011, 1030013, 1030018, 100, 0),
(7, 'INSTITUTIONAL LOAN YEARLY', 'INSTITUTIONAL LOAN YEARLY', 3, 6, 1, 1, 0, 10, 0, 0, 0, 0, 0, 4000010, 4000011, 1030013, 1030017, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayment_receipt`
--

CREATE TABLE `loan_repayment_receipt` (
  `id` bigint(20) NOT NULL,
  `receipt` varchar(100) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `installment` int(11) NOT NULL,
  `amount` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `affect_loan` int(11) NOT NULL DEFAULT '0',
  `paydate` date NOT NULL,
  `month` varchar(20) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `customer_receipt` varchar(20) NOT NULL,
  `paymethod` varchar(250) NOT NULL,
  `cheque_no` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_repayment_receipt`
--

INSERT INTO `loan_repayment_receipt` (`id`, `receipt`, `LID`, `installment`, `amount`, `createdon`, `createdby`, `affect_loan`, `paydate`, `month`, `PIN`, `customer_receipt`, `paymethod`, `cheque_no`) VALUES
(1, '000000000001', 'LN1000004', 0, 65000000, '2017-04-24 12:44:20', 2, 0, '2017-04-24', '', 100, 'TEA/10001', 'BANK DEPOSIT', ''),
(2, 'UA2XOO000001', 'LN1000005', 0, 446796390, '2017-04-24 13:47:18', 2, 0, '2017-03-02', '', 100, 'TEA/10002', 'BANK DEPOSIT', ''),
(3, 'E2N4ED100001', 'LN1000005', 0, 3000000, '2017-04-27 09:54:43', 2, 0, '2017-04-27', '', 100, 'TEA/10003', 'BANK DEPOSIT', ''),
(4, 'FUY632200001', 'LN1000001', 1, 100000000, '2017-04-27 09:56:29', 2, 1, '2017-04-27', '', 100, 'TEA/10004', 'BANK DEPOSIT', ''),
(5, 'KPMW0R200001', 'LN1000009', 0, 21000000, '2017-06-08 10:41:02', 2, 0, '2017-06-08', '', 100, 'TEA/10005', 'BANK DEPOSIT', ''),
(6, '5ZMD1G300001', 'LN1000001', 1, 200000000, '2017-07-14 09:25:49', 2, 1, '2007-06-20', '', 100, 'TEA/10006', 'BANK DEPOSIT', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan_security`
--

CREATE TABLE `loan_security` (
  `id` int(11) NOT NULL,
  `loanID` bigint(20) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_status`
--

CREATE TABLE `loan_status` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_status`
--

INSERT INTO `loan_status` (`id`, `code`, `name`) VALUES
(1, 0, 'New Loan'),
(2, 1, 'Evaluated'),
(3, 2, 'Rejected'),
(4, 3, 'Need Changes'),
(5, 4, 'Accepted'),
(6, 5, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL COMMENT 'System Member id',
  `member_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` char(20) NOT NULL,
  `maritalstatus` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `joiningdate` date NOT NULL DEFAULT '2015-01-01',
  `type_id` varchar(255) NOT NULL,
  `type_id_number` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'avatar.gif',
  `status` int(11) NOT NULL DEFAULT '1',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `formstatus` int(11) NOT NULL DEFAULT '1',
  `PIN` bigint(20) NOT NULL,
  `category` varchar(250) NOT NULL,
  `TIN` varchar(250) NOT NULL,
  `incorporation_certificate` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `PID`, `member_id`, `firstname`, `middlename`, `lastname`, `gender`, `maritalstatus`, `dob`, `joiningdate`, `type_id`, `type_id_number`, `photo`, `status`, `createdon`, `createdby`, `formstatus`, `PIN`, `category`, `TIN`, `incorporation_certificate`) VALUES
(1, 1000001, '100001', 'MZUMBE UNIVERSITY', NULL, '', '', '', '2001-11-01', '2004-04-01', '', '', 'avatar.gif', 1, '2016-11-01 08:55:01', 2, 1, 100, 'Company', 'NOT APPLICABLE', 'NOT APPLICABLE'),
(2, 1000002, '100002', 'HUBERT KAIRUKI MEMORIAL UNIVERSITY', NULL, '', '', '', '2005-10-01', '2005-10-01', '', '', 'avatar.gif', 1, '2016-11-01 09:43:29', 2, 1, 100, 'Company', 'NOT APPLICABLE', 'NOT APPLICABLE'),
(3, 1000003, '100003', 'UNIVERSITY OF DAR ES SALAAM', NULL, '', '', '', '2005-01-01', '2005-01-01', '', '', 'avatar.gif', 1, '2016-11-29 09:30:02', 14, 1, 100, 'Company', 'XXX', '01012005'),
(4, 1000004, '100004', 'THE OPEN UNIVERSITY OF TANZANIA', NULL, '', '', '', '2005-01-01', '2005-01-01', '', '', 'avatar.gif', 1, '2016-11-29 09:54:05', 2, 1, 100, 'Company', 'Z', '01012005'),
(5, 1000005, 'OUT001', 'Open University Tanzania', NULL, '', '', '', '2005-04-04', '2006-04-01', '', '', 'avatar.gif', 1, '2017-04-24 12:13:11', 2, 2, 100, 'Company', '1234567', '7654321'),
(6, 1000006, 'BUNGE001', 'BUNGE PRIMARY SCHOOL', NULL, '', '', '', '2016-10-03', '2017-06-07', '', '', 'avatar.gif', 1, '2017-06-08 10:27:52', 2, 2, 100, 'Company', '1234567', '7654321'),
(7, 1000007, 'AB/152/2016/01', 'OPEN UNIVERSITY OF TANZANIA', NULL, '', '', '', '2003-10-01', '2004-10-01', '', '', 'avatar.gif', 1, '2017-07-14 07:52:33', 2, 1, 100, 'Company', '1102', '00333'),
(8, 1000008, 'ERT7899', 'Neymon Investment LMT', NULL, '', '', '', '2018-09-03', '2018-10-02', 'NID', '67889899998', '1537264317_2.jpg', 1, '2018-09-18 09:51:57', 2, 1, 100, 'Company', 'XXXXX', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `members_account`
--

CREATE TABLE `members_account` (
  `id` bigint(20) NOT NULL,
  `account` bigint(20) NOT NULL,
  `RFID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `account_cat` bigint(20) NOT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `virtual_balance` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `tablename` varchar(100) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members_contact`
--

CREATE TABLE `members_contact` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `phone1` varchar(50) NOT NULL COMMENT 'Primary contact',
  `phone2` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `postaladdress` varchar(200) NOT NULL,
  `physicaladdress` varchar(500) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `fax` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_contact`
--

INSERT INTO `members_contact` (`id`, `PID`, `phone1`, `phone2`, `email`, `postaladdress`, `physicaladdress`, `createdon`, `createdby`, `PIN`, `fax`) VALUES
(1, 1000005, '255222775468', '', '', '', '', '2017-04-24 12:14:03', 2, 100, ''),
(2, 1000006, '255222775468', '', '', '', '', '2017-06-08 10:28:38', 2, 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `members_contribution`
--

CREATE TABLE `members_contribution` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `balance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members_grouplist`
--

CREATE TABLE `members_grouplist` (
  `id` int(11) NOT NULL,
  `GID` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_grouplist`
--

INSERT INTO `members_grouplist` (`id`, `GID`, `name`, `description`, `createdon`, `createdby`, `PIN`) VALUES
(1, 101, 'Hemedi Group', 'bv h,hj', '2018-09-18 09:50:00', 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `members_groups`
--

CREATE TABLE `members_groups` (
  `id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `GID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdby` bigint(20) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members_nextkin`
--

CREATE TABLE `members_nextkin` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `relationship` varchar(200) NOT NULL,
  `physicaladdress` varchar(500) NOT NULL,
  `postaladdress` varchar(500) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members_share`
--

CREATE TABLE `members_share` (
  `id` bigint(20) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `totalshare` int(11) NOT NULL,
  `remainbalance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member_registrationfee`
--

CREATE TABLE `member_registrationfee` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `credit` double NOT NULL,
  `debit` double NOT NULL,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_registrationfee`
--

INSERT INTO `member_registrationfee` (`id`, `date`, `PID`, `member_id`, `credit`, `debit`, `createdby`, `PIN`) VALUES
(1, '2018-09-18', 1000008, 'ERT7899', 700000, 0, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_code`
--

CREATE TABLE `mobile_code` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile_code`
--

INSERT INTO `mobile_code` (`id`, `name`) VALUES
(1, 255),
(2, 254);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_notification`
--

CREATE TABLE `mobile_notification` (
  `id` int(11) NOT NULL,
  `group` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `Name`) VALUES
(1, 'Client Registration'),
(5, 'Loan Management'),
(6, 'Finance'),
(7, 'Reports'),
(8, 'Messaging'),
(9, 'Settings'),
(10, 'Manage Users');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmenthod`
--

CREATE TABLE `paymentmenthod` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmenthod`
--

INSERT INTO `paymentmenthod` (`id`, `name`) VALUES
(1, 'CASH'),
(2, 'CHEQUE'),
(3, 'M-PESA'),
(4, 'TIGO PESA'),
(5, 'BANK DEPOSIT'),
(6, 'OTHERS');

-- --------------------------------------------------------

--
-- Table structure for table `provision_baddebt_transaction`
--

CREATE TABLE `provision_baddebt_transaction` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `classfication` int(11) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `days` int(11) NOT NULL,
  `provision_rate` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provision_rate`
--

CREATE TABLE `provision_rate` (
  `id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `rate` double NOT NULL,
  `range` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provision_rate`
--

INSERT INTO `provision_rate` (`id`, `days`, `class`, `rate`, `range`) VALUES
(1, 0, 'CURRENT', 0, '0 - 30'),
(2, 31, 'ESPECIALLY MENTIONED', 5, '31 - 60'),
(3, 61, 'SUBSTANDARD', 10, '61 - 90'),
(4, 91, 'DOUBTFUL', 50, '91 - 180'),
(5, 181, 'LOSS', 100, '181 - Above');

-- --------------------------------------------------------

--
-- Table structure for table `provision_rateold`
--

CREATE TABLE `provision_rateold` (
  `id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provision_rateold`
--

INSERT INTO `provision_rateold` (`id`, `days`, `class`, `rate`) VALUES
(1, 0, 'CURRENT', 1),
(2, 6, 'ESPECIALLY MENTIONED', 5),
(3, 31, 'SUBSTANDARD', 25),
(4, 61, 'DOUBTFUL', 50),
(5, 91, 'LOSS', 100);

-- --------------------------------------------------------

--
-- Table structure for table `provision_rate_run`
--

CREATE TABLE `provision_rate_run` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `last_provision` int(11) NOT NULL,
  `last_date` date NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provision_rate_run`
--

INSERT INTO `provision_rate_run` (`id`, `LID`, `last_provision`, `last_date`, `createdon`) VALUES
(1, 'LN1000001', 0, '2006-10-12', '2016-11-01 09:09:44'),
(2, 'LN1000002', 0, '2006-09-17', '2016-11-01 09:48:53'),
(3, 'LN1000003', 0, '2007-01-04', '2016-11-29 10:07:33'),
(4, 'LN1000004', 0, '2017-05-01', '2017-04-24 12:35:04'),
(5, 'LN1000005', 0, '2017-03-02', '2017-04-24 13:44:44'),
(6, 'LN1000006', 0, '2017-04-28', '2017-04-27 09:34:07'),
(7, 'LN1000009', 0, '2017-06-09', '2017-06-08 10:37:02'),
(8, 'LN1000011', 0, '2012-07-02', '2017-07-14 09:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `provision_rate_status`
--

CREATE TABLE `provision_rate_status` (
  `id` bigint(20) NOT NULL,
  `LID` varchar(50) NOT NULL,
  `classfication` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice`
--

CREATE TABLE `purchase_invoice` (
  `id` bigint(20) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `supplierid` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `summary` text NOT NULL,
  `notes` text NOT NULL,
  `totalamount` double NOT NULL,
  `totalamounttax` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `balance` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `ledger_entry` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_item`
--

CREATE TABLE `purchase_invoice_item` (
  `id` bigint(20) NOT NULL,
  `invoiceid` bigint(20) NOT NULL,
  `itemcode` varchar(50) NOT NULL,
  `account` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `amount` double NOT NULL,
  `taxcode` varchar(50) NOT NULL,
  `tax_included` int(11) NOT NULL DEFAULT '0',
  `taxamount` double NOT NULL,
  `balance` double NOT NULL,
  `round_off` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` bigint(20) NOT NULL,
  `issue_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `supplierid` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `summary` text NOT NULL,
  `notes` text NOT NULL,
  `authorizedby` varchar(100) NOT NULL,
  `totalamount` double NOT NULL,
  `totalamounttax` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `copy_to_invoice` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_item`
--

CREATE TABLE `purchase_order_item` (
  `id` bigint(20) NOT NULL,
  `orderid` bigint(20) NOT NULL,
  `itemcode` varchar(50) NOT NULL,
  `account` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `amount` double NOT NULL,
  `taxcode` varchar(50) NOT NULL,
  `tax_included` int(11) NOT NULL DEFAULT '0',
  `taxamount` double NOT NULL,
  `round_off` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_table`
--

CREATE TABLE `report_table` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `description` text NOT NULL,
  `page` varchar(5) NOT NULL DEFAULT 'A4',
  `comparefromdate` varchar(50) NOT NULL,
  `comparetodate` varchar(50) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `account` varchar(250) DEFAULT NULL,
  `year` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_table`
--

INSERT INTO `report_table` (`id`, `link`, `fromdate`, `todate`, `description`, `page`, `comparefromdate`, `comparetodate`, `PIN`, `account`, `year`) VALUES
(1, 1, '2016-04-12', '2016-10-12', 'gl', 'A4-L', '', '', 100, 'ALL', '2016'),
(2, 5, '2016-10-12', '0000-00-00', 'bl', 'A4-L', '', '', 100, NULL, '2016'),
(3, 4, '2016-05-12', '2016-10-12', 'in', 'A4-L', '', '', 100, NULL, '2016'),
(4, 3, '2004-07-01', '2005-06-30', 'tb', 'A4-L', '', '', 100, NULL, '2004/2005'),
(5, 3, '2005-07-01', '2006-06-30', 'TR', 'A4', '', '', 100, NULL, '2005/2006'),
(6, 5, '2017-04-27', '0000-00-00', 'jkk', 'A4-L', '', '', 100, NULL, '2005/2006');

-- --------------------------------------------------------

--
-- Table structure for table `report_table_contribution`
--

CREATE TABLE `report_table_contribution` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `description` text NOT NULL,
  `page` varchar(5) NOT NULL DEFAULT 'A4',
  `user` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_table_journal`
--

CREATE TABLE `report_table_journal` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `description` text NOT NULL,
  `page` varchar(10) NOT NULL DEFAULT 'A4',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_table_journal`
--

INSERT INTO `report_table_journal` (`id`, `link`, `fromdate`, `todate`, `description`, `page`, `PIN`) VALUES
(1, 4, '2016-07-04', '2017-04-24', 'd', 'A4', 100);

-- --------------------------------------------------------

--
-- Table structure for table `report_table_loan`
--

CREATE TABLE `report_table_loan` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `description` text NOT NULL,
  `page` varchar(5) NOT NULL DEFAULT 'A4',
  `custom` text NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_table_loan`
--

INSERT INTO `report_table_loan` (`id`, `link`, `fromdate`, `todate`, `description`, `page`, `custom`, `PIN`) VALUES
(3, 2, '2016-10-12', '2016-10-12', 'lb', 'A4-L', '', 100),
(4, 3, '2004-12-01', '2016-11-01', 'Interest Paid', 'A4', '', 100),
(5, 1, '2005-04-24', '2017-04-24', 'LOAN LIST', 'A4', '', 100),
(6, 1, '2013-01-01', '2017-06-08', 'dfdsv', 'A4-L', '', 100),
(7, 3, '2016-09-30', '2017-04-27', 'fdff', 'A4-L', '', 100),
(8, 2, '2016-11-01', '2016-11-01', 'rfff', 'A4-L', '', 100),
(9, 2, '2017-04-28', '2017-04-28', 'bb', 'A4-L', '', 100),
(10, 5, '2018-09-19', '2018-09-26', 'jjjjj', 'A4', '', 100);

-- --------------------------------------------------------

--
-- Table structure for table `report_table_member`
--

CREATE TABLE `report_table_member` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `viewall` int(11) NOT NULL DEFAULT '0',
  `column` text NOT NULL,
  `description` text NOT NULL,
  `page` varchar(10) NOT NULL DEFAULT 'A4',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_table_saving`
--

CREATE TABLE `report_table_saving` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `description` text NOT NULL,
  `page` varchar(5) NOT NULL DEFAULT 'A4',
  `account_type` varchar(50) NOT NULL,
  `user` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_table_share`
--

CREATE TABLE `report_table_share` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `description` text NOT NULL,
  `page` varchar(5) NOT NULL DEFAULT 'A4',
  `user` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reseller_account`
--

CREATE TABLE `reseller_account` (
  `id` int(11) NOT NULL,
  `is_super` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `company` text NOT NULL,
  `createdby` int(11) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reseller_account`
--

INSERT INTO `reseller_account` (`id`, `is_super`, `firstname`, `address`, `company`, `createdby`, `lastname`, `mobile`, `email`, `createdon`) VALUES
(2, 1, 'Miltone', 'Mikochen Street', 'DATAVISION INTERNATIONAL LTD', 0, 'Urassa', '255712765538', 'miltoneurassa@yahoo.com', '2015-02-01 09:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `Module_id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `Module_id`, `Name`) VALUES
(1, 1, 'Register_new_member'),
(2, 1, 'View_member_list'),
(3, 1, 'Manage_member_group'),
(4, 1, 'View_member_group'),
(7, 2, 'Contribution_transaction'),
(8, 3, 'Create_saving_account'),
(9, 3, 'Deposit_Withdrawal'),
(10, 3, 'Savings_transactions'),
(11, 4, 'Buy_shares'),
(12, 4, 'Refund_shares'),
(13, 4, 'Share_transaction'),
(14, 5, 'View_loan_list'),
(15, 5, 'Create_new_loan'),
(16, 5, 'Evaluate_loan'),
(17, 5, 'Approve_loan'),
(18, 5, 'Disburse_loan'),
(19, 5, 'Loan_repayment'),
(20, 6, 'Manage_account_chart'),
(21, 6, 'Manage_customer'),
(22, 6, 'Create_sales_quote'),
(23, 6, 'Create_sales_invoice'),
(24, 6, 'Manage_supplier'),
(25, 6, 'Create_purchase_orders'),
(26, 6, 'Create_purchase_invoice'),
(27, 6, 'Journal_entry'),
(28, 7, 'Financial_reports'),
(29, 7, 'Journal_transactions_report'),
(30, 7, 'Members_reports'),
(32, 7, 'Loans_reports'),
(34, 8, 'Create_sender_id'),
(35, 8, 'Create_contacts_group'),
(36, 8, 'Add_contacts'),
(37, 8, 'Send_sms'),
(38, 9, 'Manage_company_information'),
(39, 9, 'Share_settings'),
(40, 9, 'Manage_saving_account_type'),
(41, 9, 'Contributions_setting'),
(42, 9, 'Manage_sales_purchase_items'),
(43, 9, 'Manage_tax_code'),
(44, 9, 'Global_settings'),
(45, 9, 'Manage_loan_product'),
(46, 10, 'Create_user_group'),
(47, 10, 'View_users_group'),
(48, 10, 'Create_users'),
(49, 10, 'View_users'),
(50, 11, 'contribution_payment'),
(51, 11, 'loan_repayment'),
(52, 2, 'automatic_contribution_process'),
(53, 5, 'automatic_repayment_process'),
(54, 6, 'close_open_year');

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice`
--

CREATE TABLE `sales_invoice` (
  `id` bigint(20) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `customerid` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `summary` text NOT NULL,
  `notes` text NOT NULL,
  `totalamount` double NOT NULL,
  `totalamounttax` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `balance` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `ledger_entry` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice_item`
--

CREATE TABLE `sales_invoice_item` (
  `id` bigint(20) NOT NULL,
  `invoiceid` bigint(20) NOT NULL,
  `itemcode` varchar(50) NOT NULL,
  `account` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `amount` double NOT NULL,
  `taxcode` varchar(50) NOT NULL,
  `tax_included` int(11) NOT NULL DEFAULT '0',
  `taxamount` double NOT NULL,
  `round_off` int(11) NOT NULL DEFAULT '0',
  `balance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote`
--

CREATE TABLE `sales_quote` (
  `id` bigint(20) NOT NULL,
  `issue_date` date NOT NULL,
  `customerid` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `summary` text NOT NULL,
  `notes` text NOT NULL,
  `totalamount` double NOT NULL,
  `totalamounttax` double NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `copy_to_invoice` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote_item`
--

CREATE TABLE `sales_quote_item` (
  `id` bigint(20) NOT NULL,
  `quoteid` bigint(20) NOT NULL,
  `itemcode` varchar(50) NOT NULL,
  `account` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `amount` double NOT NULL,
  `taxcode` varchar(50) NOT NULL,
  `tax_included` int(11) NOT NULL DEFAULT '0',
  `taxamount` double NOT NULL,
  `round_off` int(11) NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `savings_transaction`
--

CREATE TABLE `savings_transaction` (
  `id` bigint(20) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `account` bigint(20) NOT NULL,
  `account_cat` bigint(20) NOT NULL,
  `trans_type` varchar(2) NOT NULL,
  `paymethod` varchar(50) NOT NULL,
  `cheque_num` varchar(50) NOT NULL DEFAULT '',
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` double NOT NULL,
  `previous_balance` double NOT NULL,
  `comment` text NOT NULL,
  `system_comment` varchar(50) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saving_account_type`
--

CREATE TABLE `saving_account_type` (
  `id` int(11) NOT NULL,
  `account` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `min_amount` double NOT NULL,
  `month_fee` double NOT NULL,
  `max_withdrawal` varchar(50) NOT NULL,
  `min_deposit` varchar(50) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share_setting`
--

CREATE TABLE `share_setting` (
  `id` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `min_share` int(11) NOT NULL,
  `max_share` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share_transaction`
--

CREATE TABLE `share_transaction` (
  `id` bigint(20) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `PID` bigint(20) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `paymethod` varchar(50) NOT NULL,
  `cheque_num` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `trans_type` varchar(2) NOT NULL,
  `comment` text NOT NULL,
  `system_comment` varchar(200) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `transfer_from_to_PID` bigint(20) NOT NULL,
  `previous_share` int(11) NOT NULL,
  `cost_per_share` bigint(20) NOT NULL,
  `share_no` int(11) NOT NULL,
  `previous_balance` double NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_contact`
--

CREATE TABLE `sms_contact` (
  `id` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_contact_group`
--

CREATE TABLE `sms_contact_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_senderid`
--

CREATE TABLE `sms_senderid` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_sent`
--

CREATE TABLE `sms_sent` (
  `id` bigint(20) NOT NULL,
  `message_id` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `delivery_status` varchar(200) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `email` varchar(250) NOT NULL,
  `media` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) NOT NULL,
  `supplierid` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `additional` text NOT NULL,
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxcode`
--

CREATE TABLE `taxcode` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `rate` double NOT NULL DEFAULT '0',
  `PIN` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxcode`
--

INSERT INTO `taxcode` (`id`, `code`, `description`, `rate`, `PIN`) VALUES
(1, 'VAT', 'Value Added Tax', 18, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `MID` varchar(100) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `oldpass` varchar(100) NOT NULL,
  `sms_sent` int(11) NOT NULL,
  `reseller` int(11) NOT NULL,
  `super_user` int(11) NOT NULL,
  `reffid` int(11) NOT NULL,
  `refftable` varchar(100) NOT NULL,
  `defaultpass` varchar(200) NOT NULL,
  `PIN` bigint(20) NOT NULL,
  `is_client_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `MID`, `member_id`, `oldpass`, `sms_sent`, `reseller`, `super_user`, `reffid`, `refftable`, `defaultpass`, `PIN`, `is_client_admin`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1485338464, 1, 'Administrator', 'Adminstrator', 'DATAVISION INTERNATIONAL LTD', '255712765538', '', '', '', 0, 0, 0, 2, 'reseller_account', '', 100, 1),
(2, '127.0.0.1', 'info@tea.or.tz', '$2y$08$ziXF5cFTaJkBKagbvijdDOGbnA3ugFjIdsFly502s3VhwWDJfYelm', NULL, 'info@tea.or.tz', NULL, NULL, NULL, NULL, 1440340258, 1537265199, 1, 'Emmanuel', 'Shirima', 'TANZANIA EDUCATION AUTHORITY', '255712765538', '', '', '', 0, 0, 0, 1, 'client_account', 'S2000001', 100, 1),
(12, '192.168.5.40', '100001', '$2y$08$2S3gTASy9ALuoA19Fvq6/enH6wkaYJQhwew5Pe5qtmZg0VAq6CwXe', NULL, '100001', NULL, NULL, NULL, NULL, 1477990501, NULL, 1, 'MZUMBE UNIVERSITY', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '1', '100001', '1001', 0, 0, 0, 0, '', '', 100, 0),
(13, '192.168.5.40', '100002', '$2y$08$sw6KWOCEi3/CjcF/mtsEEuuEPwURgnFwCKX9sw08T5hV29FC5lZwW', NULL, '100002', NULL, NULL, NULL, NULL, 1477993409, NULL, 1, 'HUBERT KAIRUKI MEMORIAL UNIVERSITY', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '2', '100002', '2001', 0, 0, 0, 0, '', '', 100, 0),
(14, '192.168.5.95', 'mjuma', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'mjuma@tea.or.tz', 'bea8fafebad64e940649370357508d05f37b624e', NULL, NULL, NULL, 1478002963, 1481780145, 0, 'Moshy', 'Juma', NULL, '255255255784432701', '', '', '', 0, 0, 0, 0, '', '', 100, 0),
(15, '192.168.5.105', '100003', '$2y$08$PEiT0AI8cSBpY699c9.VH.dcA8qIxLNAO855VrLt8M/eehM3q3Z.2', NULL, '100003', NULL, NULL, NULL, NULL, 1480411802, NULL, 1, 'UNIVERSITY OF DAR ES SALAAM', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '3', '100003', '3001', 0, 0, 0, 0, '', '', 100, 0),
(16, '192.168.5.105', '100004', '$2y$08$Q0JQCYQict3nVwk12NeTL.0ApO9A0T6ASxLwnLFrKIgr4VJt1KXiC', NULL, '100004', NULL, NULL, NULL, NULL, 1480413245, NULL, 1, 'THE OPEN UNIVERSITY OF TANZANIA', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '4', '100004', '4001', 0, 0, 0, 0, '', '', 100, 0),
(17, '192.168.5.95', 'OUT001', '$2y$08$SSleMEhRhL.nnzqagMd5d.ifOr2zEbhzYHF7jUYT9CiuIS6Dz26vG', NULL, 'OUT001', NULL, NULL, NULL, NULL, 1493035991, NULL, 1, 'Open University Tanzania', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '5', 'OUT001', '5001', 0, 0, 0, 0, '', '', 100, 0),
(18, '192.168.5.67', 'rmajwala', '$2y$08$SYaX.DCxO8q9h1sqsXf/vuF9ZeKBrey8wyj4wizibIRVu6H9T8/hG', NULL, 'rmajwala@tea.or.tz', NULL, NULL, NULL, NULL, 1496733109, 1496734214, 1, 'Rogers', 'Majwala', NULL, '255255255222775468', '', '', '', 0, 0, 0, 0, '', '', 100, 0),
(19, '192.168.5.67', 'mkaombwe', '$2y$08$OGDN7/Srf46nbWd/uN8iceILdMjUU3FCge24E4jw428E3UbUagZFm', NULL, 'mkaombwe@tea.or.tz', NULL, NULL, NULL, NULL, 1496733214, NULL, 1, 'Mathew', 'Kaombwe', NULL, '255255255222775468', '', '', '', 0, 0, 0, 0, '', '', 100, 0),
(20, '192.168.5.67', 'asilim', '$2y$08$6NDUXWUprPHMgUYKS71.0eRkOL4tbOM8AfAyN3rKualE4o4TfBza.', NULL, 'asilim@tea.or.tz', NULL, NULL, NULL, NULL, 1496736008, 1501743141, 1, 'Arafa', 'Silim', NULL, '255255222775468', '', '', '', 0, 0, 0, 0, '', '', 100, 0),
(21, '192.168.5.67', 'BUNGE001', '$2y$08$IUYK5jMelGzockYPzVMWHuSB7dl.z1Vl/am/6vPWYJKlp2csbLjzu', NULL, 'BUNGE001', NULL, NULL, NULL, NULL, 1496917672, NULL, 1, 'BUNGE PRIMARY SCHOOL', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '6', 'BUNGE001', '6001', 0, 0, 0, 0, '', '', 100, 0),
(22, '192.168.5.54', 'AB/152/2016/01', '$2y$08$EUgjEObJvzUQAql4jSPfP.l4e315D7Ye9TWTwh5r2TCgzRASM8N4S', NULL, 'AB/152/2016/01', NULL, NULL, NULL, NULL, 1500018753, NULL, 1, 'OPEN UNIVERSITY OF TANZANIA', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '7', 'AB/152/2016/01', '7001', 0, 0, 0, 0, '', '', 100, 0),
(23, '192.168.5.54', 'fmrutu', '$2y$08$321W8kX1qYugpNVqb4wmP.3aavLY0PB0N/OVzniADlmqFZfv7f2re', NULL, 'fmrutu@tea.or.tz', NULL, NULL, NULL, NULL, 1500025899, NULL, 1, 'Fatuma', 'Mrutu', NULL, '255255222775468', '', '', '', 0, 0, 0, 0, '', '', 100, 0),
(24, '192.168.10.111', 'ERT7899', '$2y$08$/UcJuiKLPFVmuD7Q0/9FFetYsquj3p8EGUA04K/.w0RPHiGvVjFeS', NULL, 'ERT7899', NULL, NULL, NULL, NULL, 1537264319, NULL, 1, 'Neymon Investment LMT', NULL, 'TANZANIA EDUCATION AUTHORITY', NULL, '8', 'ERT7899', '8001', 0, 0, 0, 0, '', '', 100, 0),
(25, '192.168.10.111', 'Hemmy', '$2y$08$Cq0Orp.1ByGE8TKG7CUVlOlZzY6qZTaVVFKblhA2tnsrUr78q6IbW', NULL, 'hmanyinja@gmail.com', NULL, NULL, NULL, NULL, 1537265290, NULL, 1, 'Hemedi', 'Mshamu', NULL, '255685639653', '', '', '', 0, 0, 0, 0, '', '', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(12, 12, 3),
(13, 13, 3),
(14, 14, 7),
(15, 15, 3),
(16, 16, 3),
(17, 17, 3),
(18, 18, 5),
(19, 19, 5),
(20, 20, 5),
(21, 21, 3),
(22, 22, 3),
(23, 23, 5),
(24, 24, 3),
(25, 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `closed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `year`, `status`, `closed`) VALUES
(1, '2004/2005', 0, 0),
(2, '2005/2006', 0, 0),
(3, '2006/2007', 0, 0),
(4, '2007/2008', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_chart`
--
ALTER TABLE `account_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_chart_default`
--
ALTER TABLE `account_chart_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_inc`
--
ALTER TABLE `account_inc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_type_sub`
--
ALTER TABLE `account_type_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_inc`
--
ALTER TABLE `auto_inc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_nature`
--
ALTER TABLE `balance_nature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cardtype`
--
ALTER TABLE `cardtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyinfo`
--
ALTER TABLE `companyinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribution_global`
--
ALTER TABLE `contribution_global`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribution_settings`
--
ALTER TABLE `contribution_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribution_source`
--
ALTER TABLE `contribution_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribution_transaction`
--
ALTER TABLE `contribution_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_journal`
--
ALTER TABLE `general_journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_journal_entry`
--
ALTER TABLE `general_journal_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_ledger_entry`
--
ALTER TABLE `general_ledger_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_setting`
--
ALTER TABLE `global_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_setting_default`
--
ALTER TABLE `global_setting_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicetype`
--
ALTER TABLE `invoicetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payment_purchase_transaction`
--
ALTER TABLE `invoice_payment_purchase_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payment_transaction`
--
ALTER TABLE `invoice_payment_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loanprocessing_fee`
--
ALTER TABLE `loanprocessing_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_balance_carry`
--
ALTER TABLE `loan_balance_carry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract`
--
ALTER TABLE `loan_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_approve`
--
ALTER TABLE `loan_contract_approve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_business`
--
ALTER TABLE `loan_contract_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_declaration`
--
ALTER TABLE `loan_contract_declaration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_disburse`
--
ALTER TABLE `loan_contract_disburse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_evaluation`
--
ALTER TABLE `loan_contract_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_guarantor`
--
ALTER TABLE `loan_contract_guarantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_repayment`
--
ALTER TABLE `loan_contract_repayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_repayment_schedule`
--
ALTER TABLE `loan_contract_repayment_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_repayment_unearned`
--
ALTER TABLE `loan_contract_repayment_unearned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_contract_supportdoc`
--
ALTER TABLE `loan_contract_supportdoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_interest_method`
--
ALTER TABLE `loan_interest_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_interval`
--
ALTER TABLE `loan_interval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_penalt_method`
--
ALTER TABLE `loan_penalt_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_product`
--
ALTER TABLE `loan_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_repayment_receipt`
--
ALTER TABLE `loan_repayment_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_security`
--
ALTER TABLE `loan_security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_status`
--
ALTER TABLE `loan_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_account`
--
ALTER TABLE `members_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_contact`
--
ALTER TABLE `members_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_contribution`
--
ALTER TABLE `members_contribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_grouplist`
--
ALTER TABLE `members_grouplist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_groups`
--
ALTER TABLE `members_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_nextkin`
--
ALTER TABLE `members_nextkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_share`
--
ALTER TABLE `members_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_registrationfee`
--
ALTER TABLE `member_registrationfee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_code`
--
ALTER TABLE `mobile_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_notification`
--
ALTER TABLE `mobile_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmenthod`
--
ALTER TABLE `paymentmenthod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provision_baddebt_transaction`
--
ALTER TABLE `provision_baddebt_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provision_rate`
--
ALTER TABLE `provision_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provision_rateold`
--
ALTER TABLE `provision_rateold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provision_rate_run`
--
ALTER TABLE `provision_rate_run`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provision_rate_status`
--
ALTER TABLE `provision_rate_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoice_item`
--
ALTER TABLE `purchase_invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table`
--
ALTER TABLE `report_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table_contribution`
--
ALTER TABLE `report_table_contribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table_journal`
--
ALTER TABLE `report_table_journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table_loan`
--
ALTER TABLE `report_table_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table_member`
--
ALTER TABLE `report_table_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table_saving`
--
ALTER TABLE `report_table_saving`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_table_share`
--
ALTER TABLE `report_table_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseller_account`
--
ALTER TABLE `reseller_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_invoice_item`
--
ALTER TABLE `sales_invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_quote`
--
ALTER TABLE `sales_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_quote_item`
--
ALTER TABLE `sales_quote_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savings_transaction`
--
ALTER TABLE `savings_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saving_account_type`
--
ALTER TABLE `saving_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_setting`
--
ALTER TABLE `share_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_transaction`
--
ALTER TABLE `share_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_contact`
--
ALTER TABLE `sms_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_contact_group`
--
ALTER TABLE `sms_contact_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_senderid`
--
ALTER TABLE `sms_senderid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_sent`
--
ALTER TABLE `sms_sent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxcode`
--
ALTER TABLE `taxcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `account_chart`
--
ALTER TABLE `account_chart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `account_chart_default`
--
ALTER TABLE `account_chart_default`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `account_inc`
--
ALTER TABLE `account_inc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_type_sub`
--
ALTER TABLE `account_type_sub`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `auto_inc`
--
ALTER TABLE `auto_inc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balance_nature`
--
ALTER TABLE `balance_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cardtype`
--
ALTER TABLE `cardtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companyinfo`
--
ALTER TABLE `companyinfo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contribution_global`
--
ALTER TABLE `contribution_global`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contribution_settings`
--
ALTER TABLE `contribution_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contribution_source`
--
ALTER TABLE `contribution_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contribution_transaction`
--
ALTER TABLE `contribution_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_journal`
--
ALTER TABLE `general_journal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_journal_entry`
--
ALTER TABLE `general_journal_entry`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `general_ledger_entry`
--
ALTER TABLE `general_ledger_entry`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `global_setting`
--
ALTER TABLE `global_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `global_setting_default`
--
ALTER TABLE `global_setting_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoicetype`
--
ALTER TABLE `invoicetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_payment_purchase_transaction`
--
ALTER TABLE `invoice_payment_purchase_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_payment_transaction`
--
ALTER TABLE `invoice_payment_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loanprocessing_fee`
--
ALTER TABLE `loanprocessing_fee`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_balance_carry`
--
ALTER TABLE `loan_balance_carry`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_contract`
--
ALTER TABLE `loan_contract`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_contract_approve`
--
ALTER TABLE `loan_contract_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_contract_business`
--
ALTER TABLE `loan_contract_business`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_contract_declaration`
--
ALTER TABLE `loan_contract_declaration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_contract_disburse`
--
ALTER TABLE `loan_contract_disburse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loan_contract_evaluation`
--
ALTER TABLE `loan_contract_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_contract_guarantor`
--
ALTER TABLE `loan_contract_guarantor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_contract_repayment`
--
ALTER TABLE `loan_contract_repayment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_contract_repayment_schedule`
--
ALTER TABLE `loan_contract_repayment_schedule`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `loan_contract_repayment_unearned`
--
ALTER TABLE `loan_contract_repayment_unearned`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_contract_supportdoc`
--
ALTER TABLE `loan_contract_supportdoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_interest_method`
--
ALTER TABLE `loan_interest_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_interval`
--
ALTER TABLE `loan_interval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_penalt_method`
--
ALTER TABLE `loan_penalt_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_product`
--
ALTER TABLE `loan_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan_repayment_receipt`
--
ALTER TABLE `loan_repayment_receipt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan_security`
--
ALTER TABLE `loan_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_status`
--
ALTER TABLE `loan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `members_account`
--
ALTER TABLE `members_account`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_contact`
--
ALTER TABLE `members_contact`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members_contribution`
--
ALTER TABLE `members_contribution`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_grouplist`
--
ALTER TABLE `members_grouplist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members_groups`
--
ALTER TABLE `members_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_nextkin`
--
ALTER TABLE `members_nextkin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_share`
--
ALTER TABLE `members_share`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_registrationfee`
--
ALTER TABLE `member_registrationfee`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobile_code`
--
ALTER TABLE `mobile_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mobile_notification`
--
ALTER TABLE `mobile_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paymentmenthod`
--
ALTER TABLE `paymentmenthod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provision_baddebt_transaction`
--
ALTER TABLE `provision_baddebt_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provision_rate`
--
ALTER TABLE `provision_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `provision_rateold`
--
ALTER TABLE `provision_rateold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `provision_rate_run`
--
ALTER TABLE `provision_rate_run`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `provision_rate_status`
--
ALTER TABLE `provision_rate_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoice_item`
--
ALTER TABLE `purchase_invoice_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_table`
--
ALTER TABLE `report_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report_table_contribution`
--
ALTER TABLE `report_table_contribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_table_journal`
--
ALTER TABLE `report_table_journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_table_loan`
--
ALTER TABLE `report_table_loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report_table_member`
--
ALTER TABLE `report_table_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_table_saving`
--
ALTER TABLE `report_table_saving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_table_share`
--
ALTER TABLE `report_table_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reseller_account`
--
ALTER TABLE `reseller_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_invoice_item`
--
ALTER TABLE `sales_invoice_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_quote`
--
ALTER TABLE `sales_quote`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_quote_item`
--
ALTER TABLE `sales_quote_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `savings_transaction`
--
ALTER TABLE `savings_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saving_account_type`
--
ALTER TABLE `saving_account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `share_setting`
--
ALTER TABLE `share_setting`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `share_transaction`
--
ALTER TABLE `share_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_contact`
--
ALTER TABLE `sms_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_contact_group`
--
ALTER TABLE `sms_contact_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_senderid`
--
ALTER TABLE `sms_senderid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_sent`
--
ALTER TABLE `sms_sent`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxcode`
--
ALTER TABLE `taxcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
