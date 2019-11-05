-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2019 at 12:52 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tgu_rcpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `approver_file`
--

CREATE TABLE `approver_file` (
  `approver_id` int(11) NOT NULL,
  `approver_dept_code` varchar(50) NOT NULL,
  `approver_prmy_id` int(11) NOT NULL,
  `approver_alt_prmy_id` int(11) NOT NULL,
  `approver_sec_id` int(11) NOT NULL,
  `approver_alt_sec_id` int(11) NOT NULL,
  `approver_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approver_file`
--

INSERT INTO `approver_file` (`approver_id`, `approver_dept_code`, `approver_prmy_id`, `approver_alt_prmy_id`, `approver_sec_id`, `approver_alt_sec_id`, `approver_status`) VALUES
(1, 'AAP', 2, 4, 5, 6, 'AC'),
(2, 'AAR', 2, 0, 3, 6, 'AC'),
(3, 'ACM', 2, 0, 0, 6, 'AC'),
(4, 'AFR', 2, 0, 2, 0, 'AC'),
(5, 'ATR', 1, 0, 0, 0, 'AC'),
(6, 'ANC', 1, 0, 0, 0, 'AC'),
(7, 'ANM', 1, 0, 0, 0, 'AC'),
(8, 'AUD', 1, 0, 0, 0, 'AC'),
(9, 'BPM', 1, 0, 0, 0, 'AC'),
(10, 'EDS', 1, 0, 0, 0, 'AC'),
(11, 'EDT', 1, 0, 0, 0, 'AC'),
(12, 'HRC', 1, 0, 0, 0, 'AC'),
(13, 'HRM', 1, 0, 0, 0, 'AC'),
(14, 'ITS', 1, 4, 0, 0, 'AC'),
(15, 'KEN', 1, 0, 0, 0, 'AC'),
(16, 'LEG', 1, 0, 0, 0, 'AC'),
(17, 'LRC', 1, 0, 0, 0, 'AC'),
(18, 'LRM', 2, 0, 0, 0, 'AC'),
(19, 'LSC', 2, 0, 0, 0, 'AC'),
(20, 'LSM', 2, 0, 0, 0, 'AC'),
(21, 'MKC', 1, 0, 0, 0, 'AC'),
(22, 'MKM', 1, 0, 0, 0, 'AC'),
(23, 'OPO', 1, 0, 0, 0, 'AC'),
(24, 'OHO', 1, 0, 0, 0, 'AC'),
(25, 'OME', 2, 0, 0, 0, 'AC'),
(26, 'OVE', 7, 0, 0, 0, 'AC'),
(27, 'ONT', 0, 0, 0, 0, 'AC'),
(28, 'PCM', 0, 0, 0, 0, 'AC'),
(29, 'PHS', 0, 0, 0, 0, 'AC'),
(30, 'PQA', 0, 0, 0, 0, 'AC'),
(31, 'PAC', 0, 0, 0, 0, 'AC'),
(32, 'PCC', 0, 0, 0, 0, 'AC'),
(33, 'PCP', 0, 0, 0, 0, 'AC'),
(34, 'PCR', 0, 0, 0, 0, 'AC'),
(35, 'PHA', 0, 0, 0, 0, 'AC'),
(36, 'PLN', 0, 0, 0, 0, 'AC'),
(37, 'PO2', 0, 0, 0, 0, 'AC'),
(38, 'POH', 0, 0, 0, 0, 'AC'),
(39, 'PPO', 0, 0, 0, 0, 'AC'),
(40, 'PTG', 0, 0, 0, 0, 'AC'),
(41, 'PUC', 0, 0, 0, 0, 'AC'),
(42, 'PUM', 0, 0, 0, 0, 'AC'),
(43, 'SAL', 0, 0, 0, 0, 'AC'),
(44, 'SUP', 0, 0, 0, 0, 'AC'),
(45, 'TRY', 0, 0, 0, 0, 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `company_file`
--

CREATE TABLE `company_file` (
  `comp_id` int(11) NOT NULL,
  `comp_code` varchar(50) NOT NULL,
  `comp_name` varchar(50) NOT NULL,
  `comp_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_file`
--

INSERT INTO `company_file` (`comp_id`, `comp_code`, `comp_name`, `comp_status`) VALUES
(1, 'CAB', 'ABIATHAR CORPORATION', 'AC'),
(2, 'CAP', 'AEONPRIME LAND DEVELOPMENT CORPORATION', 'AC'),
(3, 'CCI', 'CITRINELAND CORPORATION', 'AC'),
(4, 'CEX', 'EXCEL TOWERS INCORPORATION', 'AC'),
(5, 'CID', 'INNOLAND DEVELOPMENT CORPORATION', 'AC'),
(6, 'COT', 'ONG TIAK DEVELOPMENT CORPORATION', 'AC'),
(7, 'IGC', 'INNOGROUP OF COMPANIES', 'AC'),
(8, 'CIP', 'INNOPRIME PROPERTY SERVICES', 'AC'),
(9, 'COH', 'OHMORI DEVELOPMENT CORPORATION', 'AC'),
(10, 'CTG', 'TG UNIVERSAL BUSINESS VENTURES INCORPORATION', 'AC'),
(11, 'CVE', 'VELSONS MANAGEMENT AND DEVELOPMENT CORPORATION', 'AC'),
(12, 'CIN', 'INDUCO RESOURCE CONSTRUCTION CORPORATION', 'AC'),
(13, 'CMJ', 'MJ LANDTRADE DEVELOPMENT CORPORATION', 'AC'),
(14, 'CKZ', 'TOTAL KENZO ESSENTIALS INCORPORATION', 'AC'),
(15, 'ABC', 'ABACA', 'NA'),
(16, 'CCC', 'CCCC', 'AC'),
(17, 'hah', 'HAHAHAHAHAH', 'AC'),
(18, 'SAD', 'SADSAD', 'AC'),
(19, 'xxx', 'XXXXXX', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `department_file`
--

CREATE TABLE `department_file` (
  `dept_id` int(11) NOT NULL,
  `dept_code` varchar(50) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_no_of_rcp` int(11) NOT NULL,
  `dept_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_file`
--

INSERT INTO `department_file` (`dept_id`, `dept_code`, `dept_name`, `dept_no_of_rcp`, `dept_status`) VALUES
(1, 'AAP', 'ACCOUNTING-PAYABLES', 3, 'AC'),
(2, 'AAR', 'ACCOUNTING-RECEIVABLES', 0, 'AC'),
(3, 'ACM', 'ACCOUNTING-COMPLIANCE', 0, 'AC'),
(4, 'AFR', 'ACCOUNTING-FIN REPORTS', 0, 'AC'),
(5, 'ATR', 'ACCOUNTING-TREASURY', 0, 'AC'),
(6, 'ANC', 'ANCILLARY-CEBU', 0, 'AC'),
(7, 'ANM', 'ANCILLARY-MANILA', 0, 'AC'),
(8, 'AUD', 'AUDIT', 0, 'AC'),
(9, 'BPM', 'BUSINESS PROCESS MANAGEMENT', 0, 'AC'),
(10, 'EDS', 'ENGINEERING-DESIGN', 0, 'AC'),
(11, 'EDT', 'ENGINEERING-DESIGN TECH', 0, 'AC'),
(12, 'HRC', 'HUMAN RESOURCE-CEBU', 0, 'AC'),
(13, 'HRM', 'HUMAN RESOROURCE-MANILA', 0, 'AC'),
(14, 'ITS', 'INFO TECHNOLOGY', 0, 'AC'),
(15, 'KEN', 'KENZO', 0, 'AC'),
(16, 'LEG', 'LEGAL', 0, 'AC'),
(17, 'LRC', 'LOGISTICS RESOURCE-CEBU', 0, 'AC'),
(18, 'LRM', 'LOGISTICS RESOURCE-MANILA', 0, 'AC'),
(19, 'LSC', 'LEASING-CEBU', 0, 'AC'),
(20, 'LSM', 'LEASING-MANILA', 0, 'AC'),
(21, 'MKC', 'MARKETING-CEBU', 0, 'AC'),
(22, 'MKM', 'MARKETING-MANILA', 0, 'AC'),
(23, 'OFO', 'OPERATIONS-FIT-OUTS', 0, 'AC'),
(24, 'OHO', 'OPERATIONS-HORIZONTAL', 0, 'AC'),
(25, 'OME', 'OPERATIONS-MEPF', 0, 'AC'),
(26, 'OVE', 'OPERATIONS-VERTICAL', 0, 'AC'),
(27, 'ONT', 'ONG TIAK', 0, 'AC'),
(28, 'PCM', 'PROJECT MANAGEMENT - COMMERCIAL', 0, 'AC'),
(29, 'PHS', 'PROJECT MANAGEMENT - HSE', 0, 'AC'),
(30, 'PQA', 'PROJECT MANAGEMENT - QAQC', 0, 'AC'),
(31, 'PAC', 'PMO - AEON CENTER', 0, 'AC'),
(32, 'PCC', 'PMO - CALYX CENTRE', 0, 'AC'),
(33, 'PCP', 'PMO - CAPELLA', 0, 'AC'),
(34, 'PCR', 'PMO - CALYX RESIDENCES', 0, 'AC'),
(35, 'PHA', 'PMO - HARMONIS', 0, 'AC'),
(36, 'PLN', 'PMO - LINK', 0, 'AC'),
(37, 'PO2', 'PMO - OHMORI 2', 0, 'AC'),
(38, 'POH', 'PMO - OHMORI', 0, 'AC'),
(39, 'PPO', 'PMO - POLARIS', 0, 'AC'),
(40, 'PTG', 'PMO - TGU', 0, 'AC'),
(41, 'PUC', 'PURCHASING-CEBU', 0, 'AC'),
(42, 'PUM', 'PURCHASING-MANILA', 0, 'AC'),
(43, 'SAL', 'SALES', 0, 'AC'),
(44, 'SUP', 'SUPPORT SERVICES', 0, 'AC'),
(45, 'TRY', 'TRY TRY TRY', 0, 'AC'),
(46, 'XXX', 'XXXXX', 0, 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `notification_file`
--

CREATE TABLE `notification_file` (
  `notif_id` int(11) NOT NULL,
  `rcp_no` varchar(15) NOT NULL,
  `notif_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_file`
--

INSERT INTO `notification_file` (`notif_id`, `rcp_no`, `notif_status`) VALUES
(1, 'AAP 19-0001', 'Read'),
(2, 'AAP 19-0002', 'Read'),
(3, 'AAP 19-0003', 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

CREATE TABLE `project_file` (
  `proj_id` int(11) NOT NULL,
  `proj_code` varchar(50) NOT NULL,
  `proj_name` varchar(50) NOT NULL,
  `proj_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_file`
--

INSERT INTO `project_file` (`proj_id`, `proj_code`, `proj_name`, `proj_status`) VALUES
(1, 'PAC', 'AEON CENTER', 'AC'),
(2, 'PAL', 'ALTAIRE', 'AC'),
(3, 'PAN', 'ANGELES', 'AC'),
(4, 'PCL', 'CALIPHA', 'AC'),
(5, 'PCC', 'CALYX CENTRE', 'AC'),
(6, 'PCR', 'CALYX RESIDENCES', 'AC'),
(7, 'PCP', 'CAPELLA', 'AC'),
(8, 'F01', 'FIT-OUT - SAVVY SHERPA', 'AC'),
(9, 'F02', 'FIT-OUT - FLUOR 5/F', 'AC'),
(10, 'F03', 'FIT-OUT - FLUOR 12/F', 'AC'),
(11, 'F04', 'FIT-OUT - HIKAY SM', 'AC'),
(12, '405', 'FIT-OUT - CALYX PENTHOUSE', 'AC'),
(13, 'F06', 'FIT-OUT - THE MEDIAN SHOWROOM', 'AC'),
(14, 'F07', 'FIT-OUT - MA. LUISA', 'AC'),
(15, 'F08', 'FIT-OUT - CALYX PLUG-N-PLAY', 'AC'),
(16, 'F09', 'FIT-OUT - TGU PLUG-N-PLAY', 'AC'),
(17, 'F10', 'FIT-OUT - LINK PLUG-N-PLAY', 'AC'),
(18, 'F11', 'FIT-OUT - CALCEN 1201W', 'AC'),
(19, 'F12', 'FIT-OUT - CALCEN 1901W', 'AC'),
(20, 'F13', 'FIT-OUT - CALCEN 2101W', 'AC'),
(21, 'F14', 'FIT-OUT - CALCEN 2301W', 'AC'),
(22, 'F15', 'FIT-OUT - CALCEN 2401W', 'AC'),
(23, 'F16', 'FIT-OUT - CALRES 09D', 'AC'),
(24, 'F17', 'FIT-OUT - CALRES 18LM', 'AC'),
(25, 'F18', 'FIT-OUT - CALRES 22FG', 'AC'),
(26, 'F19', 'FIT-OUT - CALRES 26A', 'AC'),
(27, 'P01', 'PLUG-N-PLAY - AEON .6F', 'AC'),
(28, 'P02', 'PLUG-N-PLAY - AEON 10F', 'AC'),
(29, 'POR', 'ORION', 'AC'),
(30, 'PSN', 'SERENIS NORTH', 'AC'),
(31, 'PSP', 'SERENIS PLAINS', 'AC'),
(32, 'PSS', 'SERENIS SOUTH', 'AC'),
(33, 'PSE', 'SERENITEA', 'AC'),
(34, 'PSU', 'SUNBURST', 'AC'),
(35, 'PTM', 'THE MEDIAN', 'AC'),
(36, 'TRY', 'TRY TRY TRY', 'AC'),
(37, 'TRY', 'TRY TRY TRY', 'AC'),
(38, 'TES', 'TESTING', 'AC'),
(39, 'sxx', 'xxx', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_approved_file`
--

CREATE TABLE `rcp_approved_file` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_date_approved` datetime NOT NULL DEFAULT current_timestamp(),
  `rcp_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_approved_file`
--

INSERT INTO `rcp_approved_file` (`rcp_id`, `rcp_no`, `rcp_date_approved`, `rcp_status`) VALUES
(1, 'AAP 19-0001', '2019-08-30 18:39:38', 'Approved'),
(2, 'AAP 19-0002', '2019-08-30 18:41:23', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_declined_file`
--

CREATE TABLE `rcp_declined_file` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_reason` varchar(100) NOT NULL,
  `rcp_date_declined` datetime NOT NULL DEFAULT current_timestamp(),
  `rcp_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_declined_file`
--

INSERT INTO `rcp_declined_file` (`rcp_id`, `rcp_no`, `rcp_reason`, `rcp_date_declined`, `rcp_status`) VALUES
(1, 'AAP 19-0003', 'HAHAH', '2019-08-30 18:42:06', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_file`
--

CREATE TABLE `rcp_file` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_employee_id` int(11) NOT NULL,
  `rcp_approver_id` int(11) NOT NULL,
  `rcp_payee` varchar(50) NOT NULL,
  `rcp_company` varchar(3) NOT NULL,
  `rcp_project` varchar(3) NOT NULL,
  `rcp_department` varchar(3) NOT NULL,
  `rcp_date_issued` date NOT NULL,
  `rcp_amount_in_words` varchar(100) NOT NULL,
  `rcp_total_amount` double NOT NULL,
  `rcp_rush` varchar(50) NOT NULL,
  `edited_by_app` varchar(3) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `rcp_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_file`
--

INSERT INTO `rcp_file` (`rcp_id`, `rcp_no`, `rcp_employee_id`, `rcp_approver_id`, `rcp_payee`, `rcp_company`, `rcp_project`, `rcp_department`, `rcp_date_issued`, `rcp_amount_in_words`, `rcp_total_amount`, `rcp_rush`, `edited_by_app`, `created_at`, `updated_at`, `rcp_status`) VALUES
(1, 'AAP 19-0001', 3, 2, 'HAH', 'CAB', 'PAC', 'AAP', '2019-08-30', 'AHAHA', 123, 'No', 'No', '2019-08-30 18:39:11', '2019-08-30 18:39:38', 'Approved'),
(2, 'AAP 19-0002', 3, 2, 'haha', 'CAB', 'PAC', 'AAP', '2019-08-30', 'haha', 123, 'No', 'No', '2019-08-30 18:39:23', '2019-08-30 18:41:23', 'Approved'),
(3, 'AAP 19-0003', 3, 2, 'haha', 'CAP', 'PAL', 'AAP', '2019-08-30', 'hah', 123, 'No', 'No', '2019-08-30 18:41:09', '2019-08-30 18:42:06', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_file_edit_history`
--

CREATE TABLE `rcp_file_edit_history` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_comp_code` varchar(3) NOT NULL,
  `rcp_proj_code` varchar(3) NOT NULL,
  `rcp_payee` varchar(50) NOT NULL,
  `rcp_amt_in_words` varchar(50) NOT NULL,
  `rcp_total_amt` double NOT NULL,
  `rcp_approver_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rcp_orig_file`
--

CREATE TABLE `rcp_orig_file` (
  `rcp_no` varchar(50) NOT NULL,
  `rcp_employee_id` int(11) NOT NULL,
  `rcp_approver_id` int(11) NOT NULL,
  `rcp_payee` varchar(50) NOT NULL,
  `rcp_company` varchar(3) NOT NULL,
  `rcp_project` varchar(3) NOT NULL,
  `rcp_department` varchar(3) NOT NULL,
  `rcp_date_issued` date NOT NULL,
  `rcp_amount_in_words` varchar(100) NOT NULL,
  `rcp_total_amount` double NOT NULL,
  `rcp_rush` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `rcp_status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_orig_file`
--

INSERT INTO `rcp_orig_file` (`rcp_no`, `rcp_employee_id`, `rcp_approver_id`, `rcp_payee`, `rcp_company`, `rcp_project`, `rcp_department`, `rcp_date_issued`, `rcp_amount_in_words`, `rcp_total_amount`, `rcp_rush`, `created_at`, `updated_at`, `rcp_status`) VALUES
('AAP 19-0001', 3, 2, 'HAH', 'CAB', 'PAC', 'AAP', '2019-08-30', 'AHAHA', 123, 'No', '2019-08-30 18:39:11', '2019-08-30 18:39:11', 'Approved'),
('AAP 19-0002', 3, 2, 'haha', 'CAB', 'PAC', 'AAP', '2019-08-30', 'haha', 123, 'No', '2019-08-30 18:39:23', '2019-08-30 18:39:23', 'Approved'),
('AAP 19-0003', 3, 2, 'haha', 'CAP', 'PAL', 'AAP', '2019-08-30', 'hah', 123, 'No', '2019-08-30 18:41:09', '2019-08-30 18:41:09', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_orig_particulars_file`
--

CREATE TABLE `rcp_orig_particulars_file` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_particulars` varchar(200) NOT NULL,
  `rcp_ref_code` varchar(50) NOT NULL,
  `rcp_amount` double NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `rcp_status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_orig_particulars_file`
--

INSERT INTO `rcp_orig_particulars_file` (`rcp_id`, `rcp_no`, `rcp_particulars`, `rcp_ref_code`, `rcp_amount`, `created_at`, `updated_at`, `rcp_status`) VALUES
(1, 'AAP 19-0001', 'HA', 'HAHA', 123, '2019-08-30 18:39:11', '2019-08-30 18:39:11', 'Approved'),
(2, 'AAP 19-0002', 'hah', 'ahah', 123, '2019-08-30 18:39:23', '2019-08-30 18:39:23', 'Approved'),
(3, 'AAP 19-0003', 'ahah', 'ah12', 123, '2019-08-30 18:41:09', '2019-08-30 18:41:09', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_particulars_edit_history`
--

CREATE TABLE `rcp_particulars_edit_history` (
  `rcp_id` int(11) NOT NULL,
  `rcp_file_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_particulars` varchar(200) NOT NULL,
  `rcp_ref_code` varchar(50) NOT NULL,
  `rcp_amount` double NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rcp_particulars_file`
--

CREATE TABLE `rcp_particulars_file` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_particulars` varchar(200) NOT NULL,
  `rcp_ref_code` varchar(50) NOT NULL,
  `rcp_amount` double NOT NULL,
  `rcp_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_particulars_file`
--

INSERT INTO `rcp_particulars_file` (`rcp_id`, `rcp_no`, `rcp_particulars`, `rcp_ref_code`, `rcp_amount`, `rcp_status`) VALUES
(1, 'AAP 19-0001', 'HA', 'HAHA', 123, 'Approved'),
(2, 'AAP 19-0002', 'hah', 'ahah', 123, 'Approved'),
(3, 'AAP 19-0003', 'ahah', 'ah12', 123, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_rush_file`
--

CREATE TABLE `rcp_rush_file` (
  `rcp_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_justification` varchar(200) NOT NULL,
  `rcp_due_date` date NOT NULL,
  `rcp_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_account_file`
--

CREATE TABLE `user_account_file` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_log_count` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_status` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account_file`
--

INSERT INTO `user_account_file` (`user_id`, `user_username`, `user_password`, `user_log_count`, `user_email`, `user_status`) VALUES
(1, 'elmar.malazarte', 'MTIzNDU2', 1, 'elmar.malazarte@innogroup.com.ph', 'AC'),
(2, 'monajoyce.huan', 'MTIzNDU2', 1, 'monajoyce.huan@innogroup.com.ph', 'AC'),
(3, 'jiezzing', 'MTIzNDU2', 1, 'jiezzing@innogroup.com.ph', 'AC'),
(4, 'franck.gerald', 'MTIzNDU2', 1, 'franck.gerald@innogroup.com.ph', 'AC'),
(5, 'jay.escopete', 'MTIzNDU2', 1, 'jay.escopete@innogroup.com.ph', 'AC'),
(6, 'mona.huan', 'MTIzNDU2', 0, 'elmar.malazarte@innogroup.com.ph', 'AC'),
(7, 'amor.dolce', 'MTIzNDU2', 1, 'elmar.malazarte@innogroup.com.ph', 'AC'),
(8, 'admin', 'MTIzNDU2', 0, 'elmar.malazarte@innogroup.com.ph', 'AC'),
(9, 'admin2', 'MTIzNDU2', 0, 'elmar.malazarte@innogroup.com.ph', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `user_file`
--

CREATE TABLE `user_file` (
  `user_id` int(11) NOT NULL,
  `user_lastname` varchar(30) NOT NULL,
  `user_firstname` varchar(30) NOT NULL,
  `user_middle_initial` varchar(1) DEFAULT NULL,
  `user_comp_code` varchar(3) NOT NULL,
  `user_dept_code` varchar(3) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_file`
--

INSERT INTO `user_file` (`user_id`, `user_lastname`, `user_firstname`, `user_middle_initial`, `user_comp_code`, `user_dept_code`, `user_type`, `user_status`) VALUES
(1, 'Malazarte', 'Elmar', '', 'IGC', 'ITS', 1, 'AC'),
(2, 'Huan', 'Mona Joyce', 'C', 'IGC', 'ITS', 3, 'AC'),
(3, 'Monilla', 'Jeffrey', 'M', 'IGC', 'ITS', 2, 'AC'),
(4, 'Dumdum', 'Franck', 'M', 'CEX', 'ITS', 4, 'AC'),
(5, 'Escopete', 'Jay', 'G', 'CID', 'AAP', 5, 'AC'),
(6, 'Huan', 'Mona Joyce', 'C', 'CID', 'AAP', 6, 'AC'),
(7, 'Dolce', 'Amor', '', 'CID', 'AAP', 3, 'AC'),
(8, 'TEST', 'TEST', 'x', 'IGC', 'AAP', 1, 'AC'),
(9, 'sad', 'sad', 'S', 'CTG', 'AAR', 1, 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_file`
--

CREATE TABLE `user_type_file` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type_file`
--

INSERT INTO `user_type_file` (`user_id`, `user_type`, `user_status`) VALUES
(1, 'Administrator', 'AC'),
(2, 'Requestor', 'AC'),
(3, 'Primary Approver', 'AC'),
(4, 'Alternate Primary Approver', 'AC'),
(5, 'Secondary Approver', 'AC'),
(6, 'Alternate Secondary Approver', 'AC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approver_file`
--
ALTER TABLE `approver_file`
  ADD PRIMARY KEY (`approver_id`);

--
-- Indexes for table `company_file`
--
ALTER TABLE `company_file`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `department_file`
--
ALTER TABLE `department_file`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `notification_file`
--
ALTER TABLE `notification_file`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `project_file`
--
ALTER TABLE `project_file`
  ADD PRIMARY KEY (`proj_id`);

--
-- Indexes for table `rcp_approved_file`
--
ALTER TABLE `rcp_approved_file`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_declined_file`
--
ALTER TABLE `rcp_declined_file`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_file`
--
ALTER TABLE `rcp_file`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_file_edit_history`
--
ALTER TABLE `rcp_file_edit_history`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_orig_file`
--
ALTER TABLE `rcp_orig_file`
  ADD PRIMARY KEY (`rcp_no`);

--
-- Indexes for table `rcp_orig_particulars_file`
--
ALTER TABLE `rcp_orig_particulars_file`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_particulars_edit_history`
--
ALTER TABLE `rcp_particulars_edit_history`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_particulars_file`
--
ALTER TABLE `rcp_particulars_file`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `rcp_rush_file`
--
ALTER TABLE `rcp_rush_file`
  ADD PRIMARY KEY (`rcp_id`);

--
-- Indexes for table `user_account_file`
--
ALTER TABLE `user_account_file`
  ADD PRIMARY KEY (`user_id`,`user_username`,`user_password`);

--
-- Indexes for table `user_file`
--
ALTER TABLE `user_file`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type_file`
--
ALTER TABLE `user_type_file`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approver_file`
--
ALTER TABLE `approver_file`
  MODIFY `approver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `company_file`
--
ALTER TABLE `company_file`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `department_file`
--
ALTER TABLE `department_file`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `notification_file`
--
ALTER TABLE `notification_file`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
  MODIFY `proj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `rcp_approved_file`
--
ALTER TABLE `rcp_approved_file`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rcp_declined_file`
--
ALTER TABLE `rcp_declined_file`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rcp_file`
--
ALTER TABLE `rcp_file`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rcp_file_edit_history`
--
ALTER TABLE `rcp_file_edit_history`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rcp_orig_particulars_file`
--
ALTER TABLE `rcp_orig_particulars_file`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rcp_particulars_edit_history`
--
ALTER TABLE `rcp_particulars_edit_history`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rcp_particulars_file`
--
ALTER TABLE `rcp_particulars_file`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rcp_rush_file`
--
ALTER TABLE `rcp_rush_file`
  MODIFY `rcp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_account_file`
--
ALTER TABLE `user_account_file`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_file`
--
ALTER TABLE `user_file`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_type_file`
--
ALTER TABLE `user_type_file`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
