-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 04, 2019 at 07:08 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

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

DROP TABLE IF EXISTS `approver_file`;
CREATE TABLE IF NOT EXISTS `approver_file` (
  `approver_id` int(11) NOT NULL AUTO_INCREMENT,
  `approver_dept_code` varchar(50) NOT NULL,
  `approver_prmy_id` int(11) NOT NULL,
  `approver_alt_prmy_id` int(11) NOT NULL,
  `approver_sec_id` int(11) NOT NULL,
  `approver_alt_sec_id` int(11) NOT NULL,
  `approver_status` varchar(50) NOT NULL,
  PRIMARY KEY (`approver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approver_file`
--

INSERT INTO `approver_file` (`approver_id`, `approver_dept_code`, `approver_prmy_id`, `approver_alt_prmy_id`, `approver_sec_id`, `approver_alt_sec_id`, `approver_status`) VALUES
(1, 'AAP', 0, 2, 5, 6, 'AC'),
(2, 'AAR', 2, 0, 3, 6, 'AC'),
(3, 'ACM', 0, 0, 0, 0, 'AC'),
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
(26, 'OVE', 0, 0, 0, 0, 'AC'),
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

DROP TABLE IF EXISTS `company_file`;
CREATE TABLE IF NOT EXISTS `company_file` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_code` varchar(50) NOT NULL,
  `comp_name` varchar(50) NOT NULL,
  `comp_status` varchar(50) NOT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
(18, 'SAD', 'SADSAD', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `department_file`
--

DROP TABLE IF EXISTS `department_file`;
CREATE TABLE IF NOT EXISTS `department_file` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(50) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_no_of_rcp` int(11) NOT NULL,
  `dept_status` varchar(50) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_file`
--

INSERT INTO `department_file` (`dept_id`, `dept_code`, `dept_name`, `dept_no_of_rcp`, `dept_status`) VALUES
(1, 'AAP', 'ACCOUNTING-PAYABLES', 4, 'AC'),
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
(45, 'TRY', 'TRY TRY TRY', 0, 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

DROP TABLE IF EXISTS `project_file`;
CREATE TABLE IF NOT EXISTS `project_file` (
  `proj_id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_code` varchar(50) NOT NULL,
  `proj_name` varchar(50) NOT NULL,
  `proj_status` varchar(50) NOT NULL,
  PRIMARY KEY (`proj_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `rcp_approved_file`;
CREATE TABLE IF NOT EXISTS `rcp_approved_file` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_date_approved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rcp_status` varchar(50) NOT NULL,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_approved_file`
--

INSERT INTO `rcp_approved_file` (`rcp_id`, `rcp_no`, `rcp_date_approved`, `rcp_status`) VALUES
(1, 'AAP 19-0001', '2019-08-04 08:34:37', 'Approved'),
(2, 'AAP 19-0003', '2019-08-04 09:21:50', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_declined_file`
--

DROP TABLE IF EXISTS `rcp_declined_file`;
CREATE TABLE IF NOT EXISTS `rcp_declined_file` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_reason` varchar(500) NOT NULL,
  `rcp_date_declined` varchar(50) NOT NULL,
  `rcp_status` varchar(50) NOT NULL,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_declined_file`
--

INSERT INTO `rcp_declined_file` (`rcp_id`, `rcp_no`, `rcp_reason`, `rcp_date_declined`, `rcp_status`) VALUES
(1, 'AAP 19-0002', 'Sorry for it was your loss', '2019-08-04 16:44:31', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_file`
--

DROP TABLE IF EXISTS `rcp_file`;
CREATE TABLE IF NOT EXISTS `rcp_file` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(15) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rcp_status` varchar(50) NOT NULL,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_file`
--

INSERT INTO `rcp_file` (`rcp_id`, `rcp_no`, `rcp_employee_id`, `rcp_approver_id`, `rcp_payee`, `rcp_company`, `rcp_project`, `rcp_department`, `rcp_date_issued`, `rcp_amount_in_words`, `rcp_total_amount`, `rcp_rush`, `edited_by_app`, `created_at`, `updated_at`, `rcp_status`) VALUES
(1, 'AAP 19-0001', 3, 2, 'Jeffrey Monilla', 'CAP', 'PAL', 'AAP', '2019-08-05', 'One million pesos', 10000000, 'No', 'Yes', '2019-08-04 08:31:56', '2019-08-04 08:32:29', 'Approved'),
(2, 'AAP 19-0002', 3, 2, 'Jeffrey Monilla', 'CAP', 'PAL', 'AAP', '2019-08-05', 'One hundred thousand pesos only', 100000, 'No', 'Yes', '2019-08-04 08:39:43', '2019-08-04 08:39:43', 'Declined'),
(3, 'AAP 19-0003', 3, 2, 'Elmar Malazarte', 'CAB', 'PAC', 'AAP', '2019-08-05', 'Twenty thousand pesos only', 20000, 'No', 'Yes', '2019-08-04 08:56:51', '2019-08-04 08:56:51', 'Approved'),
(4, 'AAP 19-0004', 3, 2, 'Mona Joyce Huan', 'CAB', 'PAC', 'AAP', '2019-08-05', 'Two hundred thousand pesos only', 200000, 'Yes', 'Yes', '2019-08-04 09:23:12', '2019-08-04 09:23:12', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_file_edit_history`
--

DROP TABLE IF EXISTS `rcp_file_edit_history`;
CREATE TABLE IF NOT EXISTS `rcp_file_edit_history` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_comp_code` varchar(3) NOT NULL,
  `rcp_proj_code` varchar(3) NOT NULL,
  `rcp_payee` varchar(50) NOT NULL,
  `rcp_amt_in_words` varchar(50) NOT NULL,
  `rcp_total_amt` double NOT NULL,
  `rcp_approver_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_file_edit_history`
--

INSERT INTO `rcp_file_edit_history` (`rcp_id`, `rcp_no`, `rcp_comp_code`, `rcp_proj_code`, `rcp_payee`, `rcp_amt_in_words`, `rcp_total_amt`, `rcp_approver_id`, `updated_at`) VALUES
(1, 'AAP 19-0001', 'CAP', 'PAL', 'Jeffrey Monilla', 'One million pesos', 10000000, 2, '2019-08-04 08:33:04'),
(2, 'AAP 19-0001', 'CAP', 'PAL', 'Jeffrey Monilla', 'One million pesos', 10000000, 2, '2019-08-04 08:33:49'),
(3, 'AAP 19-0002', 'CAB', 'PAL', 'Jeffrey Monilla', 'One hundred thousand pesos only', 100000, 2, '2019-08-04 08:43:06'),
(4, 'AAP 19-0002', 'CAP', 'PAL', 'Jeffrey Monilla', 'One hundred thousand pesos only', 100000, 2, '2019-08-04 08:43:53'),
(5, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:03:05'),
(6, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:07:47'),
(7, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:15:11'),
(8, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:16:13'),
(9, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:16:53'),
(10, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:18:56'),
(11, 'AAP 19-0003', 'CAB', 'PAC', 'Elmar Malazarte', 'Twenty thousand pesos only', 20000, 2, '2019-08-04 09:20:48'),
(12, 'AAP 19-0004', 'CAB', 'PAC', 'Mona Joyce Huan', 'Two hundred thousand pesos only', 200000, 2, '2019-08-04 09:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_orig_file`
--

DROP TABLE IF EXISTS `rcp_orig_file`;
CREATE TABLE IF NOT EXISTS `rcp_orig_file` (
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rcp_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_orig_file`
--

INSERT INTO `rcp_orig_file` (`rcp_no`, `rcp_employee_id`, `rcp_approver_id`, `rcp_payee`, `rcp_company`, `rcp_project`, `rcp_department`, `rcp_date_issued`, `rcp_amount_in_words`, `rcp_total_amount`, `rcp_rush`, `created_at`, `updated_at`) VALUES
('AAP 19-0001', 3, 2, 'Jeffrey Monilla', 'CAB', 'PAC', 'AAP', '2019-08-05', 'One million pesos', 10000000, 'No', '2019-08-04 08:31:56', '2019-08-04 08:32:29'),
('AAP 19-0002', 3, 2, 'Jeffrey Monilla', 'CAB', 'PAC', 'AAP', '2019-08-05', 'One hundred thousand pesos only', 100000, 'No', '2019-08-04 08:39:43', '2019-08-04 08:39:43'),
('AAP 19-0003', 3, 2, 'Elmar Malazarte', 'CAB', 'PAC', 'AAP', '2019-08-05', 'Twenty thousand pesos only', 20000, 'No', '2019-08-04 08:56:51', '2019-08-04 08:56:51'),
('AAP 19-0004', 3, 2, 'Mona Joyce Huan', 'CAB', 'PAC', 'AAP', '2019-08-05', 'Two hundred thousand pesos only', 200000, 'Yes', '2019-08-04 09:23:12', '2019-08-04 09:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_orig_particulars_file`
--

DROP TABLE IF EXISTS `rcp_orig_particulars_file`;
CREATE TABLE IF NOT EXISTS `rcp_orig_particulars_file` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_particulars` varchar(200) NOT NULL,
  `rcp_ref_code` varchar(50) NOT NULL,
  `rcp_amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_orig_particulars_file`
--

INSERT INTO `rcp_orig_particulars_file` (`rcp_id`, `rcp_no`, `rcp_particulars`, `rcp_ref_code`, `rcp_amount`, `created_at`, `updated_at`) VALUES
(1, 'AAP 19-0001', 'Time Machine', '123456-XXX', 10000000, '2019-08-04 08:31:56', '2019-08-04 08:32:29'),
(2, 'AAP 19-0002', 'Washing Machine', '123456-XXX', 100000, '2019-08-04 08:39:43', '2019-08-04 08:39:43'),
(3, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 08:56:51', '2019-08-04 08:56:51'),
(4, 'AAP 19-0004', 'Drawer', '123456-XXX', 200000, '2019-08-04 09:23:12', '2019-08-04 09:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_particulars_edit_history`
--

DROP TABLE IF EXISTS `rcp_particulars_edit_history`;
CREATE TABLE IF NOT EXISTS `rcp_particulars_edit_history` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_file_id` int(11) NOT NULL,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_particulars` varchar(200) NOT NULL,
  `rcp_ref_code` varchar(50) NOT NULL,
  `rcp_amount` double NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_particulars_edit_history`
--

INSERT INTO `rcp_particulars_edit_history` (`rcp_id`, `rcp_file_id`, `rcp_no`, `rcp_particulars`, `rcp_ref_code`, `rcp_amount`, `updated_at`) VALUES
(1, 1, 'AAP 19-0001', 'Time Machine', '123456-XXX', 10000000, '2019-08-04 16:33:04'),
(2, 2, 'AAP 19-0001', 'Time Machine Version 1', '123456-XXX', 10000000, '2019-08-04 16:33:49'),
(3, 3, 'AAP 19-0002', 'Washing Machine', '123456-XXX', 100000, '2019-08-04 16:43:06'),
(4, 4, 'AAP 19-0002', 'Washing Machine', '123456-XXX', 100000, '2019-08-04 16:43:53'),
(5, 5, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:03:05'),
(6, 6, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:07:47'),
(7, 7, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:15:11'),
(8, 8, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:16:13'),
(9, 9, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:16:53'),
(10, 10, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:18:56'),
(11, 11, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, '2019-08-04 17:20:48'),
(12, 12, 'AAP 19-0004', 'Drawer', '123456-XXX', 200000, '2019-08-04 17:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_particulars_file`
--

DROP TABLE IF EXISTS `rcp_particulars_file`;
CREATE TABLE IF NOT EXISTS `rcp_particulars_file` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_particulars` varchar(200) NOT NULL,
  `rcp_ref_code` varchar(50) NOT NULL,
  `rcp_amount` double NOT NULL,
  `rcp_status` varchar(50) NOT NULL,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_particulars_file`
--

INSERT INTO `rcp_particulars_file` (`rcp_id`, `rcp_no`, `rcp_particulars`, `rcp_ref_code`, `rcp_amount`, `rcp_status`) VALUES
(1, 'AAP 19-0001', 'Time Machine Version 1', '123456-XXX', 10000000, 'Approved'),
(2, 'AAP 19-0002', 'Washing Machine', '123456-XXX', 100000, 'Declined'),
(3, 'AAP 19-0003', 'Monitor', '123456-XXX', 20000, 'Approved'),
(4, 'AAP 19-0004', 'Drawer', '123456-XXX', 200000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rcp_rush_file`
--

DROP TABLE IF EXISTS `rcp_rush_file`;
CREATE TABLE IF NOT EXISTS `rcp_rush_file` (
  `rcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcp_no` varchar(50) NOT NULL,
  `rcp_justification` varchar(200) NOT NULL,
  `rcp_due_date` date NOT NULL,
  `rcp_status` varchar(50) NOT NULL,
  PRIMARY KEY (`rcp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcp_rush_file`
--

INSERT INTO `rcp_rush_file` (`rcp_id`, `rcp_no`, `rcp_justification`, `rcp_due_date`, `rcp_status`) VALUES
(1, 'AAP 19-0004', 'HAHHAHAHAHAHAHA', '2019-08-31', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_account_file`
--

DROP TABLE IF EXISTS `user_account_file`;
CREATE TABLE IF NOT EXISTS `user_account_file` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_log_count` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_status` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`,`user_username`,`user_password`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account_file`
--

INSERT INTO `user_account_file` (`user_id`, `user_username`, `user_password`, `user_log_count`, `user_email`, `user_status`) VALUES
(1, 'elmar.malazarte', 'MTIzNDU2', 1, 'elmar.malazarte@innogroup.com.ph', 'AC'),
(2, 'monajoyce.huan', 'MTIzNDU2', 1, 'elmar.malazarte@innogroup.com.ph', 'AC'),
(3, 'jiezzing', 'MTIzNDU2', 1, 'jiezzing@innogroup.com.ph', 'AC'),
(4, 'franck.gerald', 'MTIzNDU2', 1, 'franck@innogroup.com.ph', 'AC'),
(5, 'jay.escopete', 'MTIzNDU2', 1, 'jay.escopete@innogroup.com.ph', 'AC'),
(6, 'mona.huan', 'MTIzNDU2', 0, 'mona@innogroup.com.ph', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `user_file`
--

DROP TABLE IF EXISTS `user_file`;
CREATE TABLE IF NOT EXISTS `user_file` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_lastname` varchar(30) NOT NULL,
  `user_firstname` varchar(30) NOT NULL,
  `user_middle_initial` varchar(1) NOT NULL,
  `user_comp_code` varchar(3) NOT NULL,
  `user_dept_code` varchar(3) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_status` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_file`
--

INSERT INTO `user_file` (`user_id`, `user_lastname`, `user_firstname`, `user_middle_initial`, `user_comp_code`, `user_dept_code`, `user_type`, `user_status`) VALUES
(1, 'Malazarte', 'Elmar', 'M', 'IGC', 'ITS', 1, 'AC'),
(2, 'Huan', 'Mona Joyce', 'C', 'IGC', 'ITS', 3, 'AC'),
(3, 'Dumdum', 'Fritz Geraldd', 'M', 'IGC', 'ITS', 2, 'AC'),
(4, 'Dumdum', 'Franck', 'M', 'CEX', 'ITS', 4, 'AC'),
(5, 'Escopete', 'Jay', 'G', 'CID', 'AAP', 5, 'AC'),
(6, 'Huan', 'Mona Joyce', 'H', 'CID', 'AAP', 6, 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_file`
--

DROP TABLE IF EXISTS `user_type_file`;
CREATE TABLE IF NOT EXISTS `user_type_file` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  `user_status` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
