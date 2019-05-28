-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 08:53 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paces3`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_tbl`
--

CREATE TABLE `access_tbl` (
  `access_id` int(11) NOT NULL,
  `access_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_tbl`
--

INSERT INTO `access_tbl` (`access_id`, `access_name`) VALUES
(1, 'ADMINISTRATOR'),
(4, 'CASHIER'),
(2, 'PRINCIPAL'),
(3, 'TEACHER');

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `account_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tuition_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `general_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `auxiliary_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `other_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `financer_name` varchar(250) NOT NULL,
  `financer_contact` varchar(50) DEFAULT NULL,
  `financer_address` text,
  `financer_relationship` varchar(50) DEFAULT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`account_id`, `student_id`, `tuition_fee`, `general_fee`, `auxiliary_fee`, `other_fee`, `discount_percentage`, `grand_total`, `financer_name`, `financer_contact`, `financer_address`, `financer_relationship`, `date_encoded`, `encoded_by`) VALUES
(1, 1, '1000.00', '1000.00', '1320.00', '230.00', '0.00', '3550.00', 'asdfasd', 'sdfasdf', '', '', '2019-02-03 21:50:13', 1),
(2, 2, '24000.00', '6000.00', '200.00', '600.00', '0.00', '30800.00', 'Test', '09499386672', 'tes', 'self', '2019-03-24 23:28:30', 1),
(3, 3, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'TEST', '09499386672', 'TEST', '', '2019-03-25 00:27:15', 1),
(4, 5, '24000.00', '6000.00', '200.00', '600.00', '0.00', '30800.00', 'TEST', '09499386672', 'TES', 'TEST', '2019-03-25 00:29:26', 1),
(5, 6, '24274.72', '6780.00', '800.00', '3230.00', '0.00', '35084.72', 'eldaa osmena', '09157142042', 'imus', 'mother', '2019-03-28 09:18:18', 1),
(6, 8, '24274.72', '6780.00', '800.00', '3230.00', '0.00', '35084.72', 'AnnaRose Francisco', '09753382361', 'tabing Ilog', 'ate', '2019-03-28 19:21:53', 1),
(7, 7, '24170.36', '6780.00', '0.00', '3230.00', '0.00', '34180.36', 'alladin', '09663658517', '', '', '2019-03-28 20:22:25', 1),
(8, 9, '24170.36', '6780.00', '0.00', '3230.00', '0.00', '34180.36', 'eldaa', '09157142042', 'cavite', '', '2019-04-02 07:26:30', 5),
(9, 10, '20802.93', '5440.00', '0.00', '6230.00', '10.00', '29225.64', 'eldaa osmena', '09157142042', 'imus', 'mother', '2019-04-14 05:05:48', 1),
(10, 11, '20802.93', '5440.00', '0.00', '6230.00', '10.00', '29225.64', 'mervin', '09157142042', 'springtown bulacan', 'father', '2019-04-14 14:15:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `advisory_tbl`
--

CREATE TABLE `advisory_tbl` (
  `advisory_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advisory_tbl`
--

INSERT INTO `advisory_tbl` (`advisory_id`, `faculty_id`, `schoolyear_id`, `gradelevel_id`, `section_id`, `date_encoded`, `encoded_by`, `date_updated`, `updated_by`, `status_id`) VALUES
(1, 1, 0, 1, 5, '2018-10-05 21:46:12', 1, '2018-10-05 21:46:12', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_status`
--

CREATE TABLE `faculty_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_status`
--

INSERT INTO `faculty_status` (`status_id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'RESIGNED');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE `faculty_tbl` (
  `faculty_id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `birthday` date DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `address` text,
  `emergency_person` varchar(200) DEFAULT NULL,
  `emergency_contact` varchar(50) DEFAULT NULL,
  `sss_no` varchar(50) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `ph_no` varchar(50) DEFAULT NULL,
  `pagibig_no` varchar(50) DEFAULT NULL,
  `prc_license` varchar(50) DEFAULT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`faculty_id`, `lastname`, `firstname`, `middlename`, `gender_id`, `designation`, `birthday`, `contact_no`, `address`, `emergency_person`, `emergency_contact`, `sss_no`, `tin_no`, `ph_no`, `pagibig_no`, `prc_license`, `date_encoded`, `encoded_by`, `date_updated`, `updated_by`, `status_id`) VALUES
(1, 'bermas', 'michael', 'bermas', 1, 'asdfa', '2018-09-27', '1234', '234', 'sadf', 'sdfas', '2342', '2343', '34', '234', '234', '2018-09-26 23:14:21', 0, '2018-09-26 23:14:21', 4, 1),
(2, 'ilaga', 'jerwin', '', 1, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '2018-09-26 23:17:11', 0, '2018-09-26 23:17:11', 0, 1),
(3, 'lascano', 'don aldrin', '', 1, '', '2018-09-07', '', '', '', '', '', '', '', '', '', '2018-09-28 20:28:56', 4, '2018-09-28 20:28:56', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gender_tbl`
--

CREATE TABLE `gender_tbl` (
  `gender_id` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender_tbl`
--

INSERT INTO `gender_tbl` (`gender_id`, `gender`) VALUES
(2, 'FEMALE'),
(1, 'MALE');

-- --------------------------------------------------------

--
-- Table structure for table `gradelevel_tbl`
--

CREATE TABLE `gradelevel_tbl` (
  `gradelevel_id` int(11) NOT NULL,
  `gradelevel_name` varchar(50) NOT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradelevel_tbl`
--

INSERT INTO `gradelevel_tbl` (`gradelevel_id`, `gradelevel_name`, `date_encoded`, `encoded_by`, `status_id`) VALUES
(1, 'Grade 1', '2018-09-25 23:17:29', 0, 1),
(2, 'Grade 2', '2018-09-25 23:17:29', 0, 1),
(3, 'Grade 3', '2018-09-25 23:17:29', 0, 1),
(4, 'Grade 4', '2018-09-25 23:17:29', 0, 1),
(5, 'Grade 5', '2018-09-25 23:17:29', 0, 1),
(6, 'Grade 6', '2018-09-25 23:17:29', 0, 1),
(7, 'Kinder', '2018-09-25 23:41:56', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade_category_percentage_tbl`
--

CREATE TABLE `grade_category_percentage_tbl` (
  `grade_percentage_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade_category_id` int(11) NOT NULL,
  `percent_value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_category_percentage_tbl`
--

INSERT INTO `grade_category_percentage_tbl` (`grade_percentage_id`, `subject_id`, `grade_category_id`, `percent_value`) VALUES
(1, 1, 1, '30.00'),
(2, 1, 2, '50.00'),
(3, 1, 3, '20.00'),
(4, 2, 1, '40.00'),
(5, 2, 2, '40.00'),
(6, 2, 3, '20.00'),
(7, 3, 1, '30.00'),
(8, 3, 2, '50.00'),
(9, 3, 3, '20.00'),
(10, 4, 1, '20.00'),
(11, 4, 2, '60.00'),
(12, 4, 3, '20.00'),
(13, 5, 1, '20.00'),
(14, 5, 2, '60.00'),
(15, 5, 3, '20.00'),
(16, 6, 1, '20.00'),
(17, 6, 2, '60.00'),
(18, 6, 3, '20.00'),
(19, 7, 1, '20.00'),
(20, 7, 2, '60.00'),
(21, 7, 3, '20.00'),
(22, 8, 1, '30.00'),
(23, 8, 2, '50.00'),
(24, 8, 3, '20.00'),
(25, 9, 1, '30.00'),
(26, 9, 2, '50.00'),
(27, 9, 3, '20.00'),
(28, 10, 1, '30.00'),
(29, 10, 2, '50.00'),
(30, 10, 3, '20.00'),
(31, 11, 1, '40.00'),
(32, 11, 2, '40.00'),
(33, 11, 3, '20.00'),
(34, 12, 1, '20.00'),
(35, 12, 2, '60.00'),
(36, 12, 3, '20.00'),
(37, 13, 1, '20.00'),
(38, 13, 2, '60.00'),
(39, 13, 3, '20.00'),
(40, 14, 1, '40.00'),
(41, 14, 2, '40.00'),
(42, 14, 3, '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `grade_category_tbl`
--

CREATE TABLE `grade_category_tbl` (
  `gradecategory_id` int(11) NOT NULL,
  `gradecategory_name` varchar(50) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `dt_updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status_id` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_category_tbl`
--

INSERT INTO `grade_category_tbl` (`gradecategory_id`, `gradecategory_name`, `dt_created`, `created_by`, `dt_updated`, `updated_by`, `status_id`) VALUES
(1, 'Written Works', '2019-03-23 12:37:48', 1, NULL, 0, 1),
(2, 'Performance Tasks', '2019-03-23 12:37:48', 1, NULL, 0, 1),
(3, 'Quarterly Assessment', '2019-03-23 12:38:12', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade_quarter_tbl`
--

CREATE TABLE `grade_quarter_tbl` (
  `grade_quarter_id` bigint(20) NOT NULL,
  `student_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quarter_id` int(11) NOT NULL,
  `initial_grade` decimal(10,2) NOT NULL,
  `final_grade` decimal(10,2) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_score_tbl`
--

CREATE TABLE `grade_score_tbl` (
  `grade_score_id` bigint(20) NOT NULL,
  `student_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quarter_id` int(11) NOT NULL,
  `grade_category_id` int(11) NOT NULL,
  `grade_category_percent` decimal(10,2) NOT NULL,
  `highest_score` decimal(10,2) NOT NULL,
  `student_score` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_transmutation_tbl`
--

CREATE TABLE `grade_transmutation_tbl` (
  `id` int(11) NOT NULL,
  `initial_grade_from` decimal(10,2) NOT NULL,
  `initial_grade_to` decimal(10,2) NOT NULL,
  `transmuted_grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_transmutation_tbl`
--

INSERT INTO `grade_transmutation_tbl` (`id`, `initial_grade_from`, `initial_grade_to`, `transmuted_grade`) VALUES
(1, '0.00', '3.99', 60),
(2, '4.00', '7.99', 61),
(3, '8.00', '11.99', 62),
(4, '12.00', '15.99', 63),
(5, '16.00', '19.99', 64),
(6, '20.00', '23.99', 65),
(7, '24.00', '27.99', 66),
(8, '28.00', '31.99', 67),
(9, '32.00', '35.99', 68),
(10, '36.00', '39.99', 69),
(11, '40.00', '43.99', 70),
(12, '44.00', '47.99', 71),
(13, '48.00', '51.99', 72),
(14, '52.00', '55.99', 73),
(15, '56.00', '59.99', 74),
(16, '60.00', '61.59', 75),
(17, '61.60', '63.19', 76),
(18, '63.20', '64.79', 77),
(19, '64.80', '66.39', 78),
(20, '66.40', '67.99', 79),
(21, '68.00', '69.59', 80),
(22, '69.60', '71.19', 81),
(23, '71.20', '72.79', 82),
(24, '72.80', '74.39', 83),
(25, '74.40', '75.99', 84),
(26, '76.00', '77.59', 85),
(27, '77.60', '79.19', 86),
(28, '79.20', '80.79', 87),
(29, '80.80', '82.39', 88),
(30, '82.40', '83.99', 89),
(31, '84.00', '85.59', 90),
(32, '85.60', '87.19', 91),
(33, '87.20', '88.79', 92),
(34, '88.80', '90.39', 93),
(35, '90.40', '91.99', 94),
(36, '92.00', '93.59', 95),
(37, '93.60', '95.19', 96),
(38, '95.20', '96.79', 97),
(39, '96.80', '98.39', 98),
(40, '98.40', '99.99', 99),
(41, '100.00', '100.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `offence_tbl`
--

CREATE TABLE `offence_tbl` (
  `offence_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `incident_date` date NOT NULL,
  `incident_type` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `comments` text,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offence_tbl`
--

INSERT INTO `offence_tbl` (`offence_id`, `student_id`, `incident_date`, `incident_type`, `description`, `comments`, `status_id`) VALUES
(1, 2, '2019-04-14', 'Attendance', 'leaving_school grounds without permission', 'the child was leaving the school', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `payment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `or_no` int(11) NOT NULL,
  `or_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remarks` text,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`payment_id`, `student_id`, `or_no`, `or_date`, `amount`, `remarks`, `date_encoded`, `encoded_by`) VALUES
(1, 1, 23432, '2019-02-03', '110.00', '', '2019-02-03 21:50:27', 1),
(2, 2, 231231, '2019-03-24', '10000.00', 'test', '2019-03-24 23:28:50', 1),
(3, 5, 3242342, '2019-03-24', '1000.00', 'TEST', '2019-03-25 00:29:36', 1),
(4, 6, 789226, '2019-03-28', '30000.00', 'down', '2019-03-28 09:20:58', 4),
(5, 8, 2147483647, '2019-03-28', '30820.00', 'paid', '2019-03-28 19:23:38', 4),
(6, 7, 45445, '2019-03-28', '212121.00', 'kbl', '2019-03-28 20:23:51', 1),
(7, 9, 4444, '2019-04-02', '20000.00', 'tuition fee', '2019-04-02 07:26:59', 5),
(8, 10, 7895, '2019-04-14', '9000.00', 'down payment', '2019-04-14 05:07:40', 4),
(9, 11, 899898989, '2019-04-14', '5900.00', 'partial pay', '2019-04-14 14:23:47', 4);

-- --------------------------------------------------------

--
-- Table structure for table `quarter_tbl`
--

CREATE TABLE `quarter_tbl` (
  `quarter_id` int(11) NOT NULL,
  `quarter_name` varchar(20) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `dt_updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status_id` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarter_tbl`
--

INSERT INTO `quarter_tbl` (`quarter_id`, `quarter_name`, `dt_created`, `created_by`, `dt_updated`, `updated_by`, `status_id`) VALUES
(1, 'FIRST QUARTER', '2019-03-24 04:31:56', 1, NULL, 0, 1),
(2, 'SECOND QUARTER', '2019-03-24 04:31:56', 1, NULL, 0, 1),
(3, 'THIRD QUARTER', '2019-03-24 04:32:18', 1, NULL, 0, 1),
(4, 'FOURTH QUARTER', '2019-03-24 04:32:18', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear_tbl`
--

CREATE TABLE `schoolyear_tbl` (
  `schoolyear_id` int(11) NOT NULL,
  `schoolyear_start` year(4) NOT NULL,
  `schoolyear_end` year(4) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyear_tbl`
--

INSERT INTO `schoolyear_tbl` (`schoolyear_id`, `schoolyear_start`, `schoolyear_end`, `status_id`) VALUES
(1, 2019, 2020, 1),
(2, 2020, 2021, 1),
(3, 2021, 2022, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_tbl`
--

CREATE TABLE `section_tbl` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_tbl`
--

INSERT INTO `section_tbl` (`section_id`, `section_name`, `gradelevel_id`, `date_encoded`, `encoded_by`, `status_id`) VALUES
(3, 'Section A', 2, '2018-09-25 22:52:11', 0, 1),
(4, 'Section B', 2, '2018-09-25 22:52:19', 0, 1),
(5, 'Section A', 1, '2018-09-27 14:59:40', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings_sms_tbl`
--

CREATE TABLE `settings_sms_tbl` (
  `sms_id` int(11) NOT NULL,
  `sms_api_code` varchar(50) NOT NULL,
  `sms_name` varchar(100) NOT NULL,
  `sms_mobile` varchar(20) NOT NULL,
  `sms_email` varchar(50) NOT NULL,
  `dt_updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_sms_tbl`
--

INSERT INTO `settings_sms_tbl` (`sms_id`, `sms_api_code`, `sms_name`, `sms_mobile`, `sms_email`, `dt_updated`, `updated_by`) VALUES
(1, 'TR-PASAY845329_D91AF', 'Pasay Adventist Church Elementary School', '09425845329', 'milcahosmena332018@gmail.com', '2019-03-23 14:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status_tbl`
--

CREATE TABLE `status_tbl` (
  `status_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_tbl`
--

INSERT INTO `status_tbl` (`status_id`, `status`) VALUES
(5, 'CANCELLED'),
(4, 'ENROLLED'),
(2, 'FOR PAYMENT'),
(3, 'PAYMENT DONE'),
(1, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `lrn_no` varchar(100) NOT NULL DEFAULT 'TEMP',
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `extname` varchar(20) DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '0' COMMENT '1-male, 2-femaie',
  `birthdate` date DEFAULT NULL,
  `birthplace` text,
  `address` text,
  `guardians_name` varchar(250) DEFAULT NULL,
  `guardians_contact` varchar(100) DEFAULT NULL,
  `last_school` varchar(200) DEFAULT NULL,
  `fathers_name` varchar(250) DEFAULT NULL,
  `fathers_occupation` varchar(250) DEFAULT NULL,
  `fathers_contact` varchar(50) DEFAULT NULL,
  `fathers_religion` varchar(100) DEFAULT NULL,
  `mothers_mname` varchar(250) DEFAULT NULL,
  `mothers_occupation` varchar(250) DEFAULT NULL,
  `mothers_contact` varchar(50) DEFAULT NULL,
  `mothers_religion` varchar(100) DEFAULT NULL,
  `grade_completed` int(11) NOT NULL DEFAULT '0',
  `gen_average` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gradelevel_id` int(11) NOT NULL DEFAULT '0',
  `section_id` int(11) NOT NULL DEFAULT '0',
  `schoolyear_id` int(11) NOT NULL DEFAULT '0',
  `date_enrolled` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `answer1` varchar(100) DEFAULT NULL,
  `answer2` varchar(100) DEFAULT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancelled_by` int(11) NOT NULL DEFAULT '0',
  `dt_cancelled` timestamp NULL DEFAULT NULL,
  `cancelled_reason` text,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `lrn_no`, `firstname`, `lastname`, `middlename`, `extname`, `gender`, `birthdate`, `birthplace`, `address`, `guardians_name`, `guardians_contact`, `last_school`, `fathers_name`, `fathers_occupation`, `fathers_contact`, `fathers_religion`, `mothers_mname`, `mothers_occupation`, `mothers_contact`, `mothers_religion`, `grade_completed`, `gen_average`, `gradelevel_id`, `section_id`, `schoolyear_id`, `date_enrolled`, `username`, `password`, `answer1`, `answer2`, `date_encoded`, `cancelled_by`, `dt_cancelled`, `cancelled_reason`, `status_id`) VALUES
(1, '', 'donato', 'donita', 'tulip', '', 1, '2019-02-03', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0.00', 1, 5, 3, '2019-02-03', 'test', '$2y$12$7dWSEmgWiSLNJBQQQbQDGebLk6jQLXkLA7/tD7uJSmsqeyaTAiora', NULL, NULL, '2019-02-03 21:49:35', 0, NULL, NULL, 4),
(2, '', 'alimbog', 'aladdin', 'lily', '', 1, '1989-12-29', 'pasay', '', 'test', '09499386672', 'Pasay Adventist Church Elementary School', 'test', 'wala', '', '', 'test', 'none', '', '', 0, '80.00', 1, 5, 1, '2019-03-24', 'jaypee', '$2y$12$Lw8cqD8XMQAHWl.CcbTKiOAcmSroc5uWmKwc2pIblZsYRTurXeMv2', NULL, NULL, '2019-03-24 23:27:51', 0, NULL, NULL, 4),
(5, '', 'miranda', 'apple', 'rose', '', 1, '1989-12-29', 'pasay', '', 'test', '09499386672', 'Pasay Adventist Church Elementary School', 'test', 'wala', '', '', 'test', 'none', '', '', 0, '80.00', 1, 4, 1, '2019-03-24', 'hindang', '$2y$12$0prjA6PuJWvkA4wM4oO/4OyQR6m6TTikBPy58SCDYZlbHh9foB8Xe', NULL, NULL, '2019-03-24 23:27:51', 0, NULL, NULL, 4),
(6, '', 'Kirkryan', 'OÃ±ate', 'OsmeÃ±a', '', 1, '2019-10-21', 'Pasig', 'Legian 1 Avocado St', 'Eldaa OsmeÃ±a', '09157142042', 'Bukandala Elementary School', 'Ryan OÃ±ate', 'I.T', '09157142042', 'Catholic', 'Elda Aranzaso', 'I.T', '09157142042', 'S.D.A', 5, '88.30', 6, 3, 1, '2019-03-28', 'Kirkryan24', '$2y$12$7VYzJqpUYu88qaH18t/svu2MSCIrSYzPetZdiNi0.3oP9UDbO7K0u', NULL, NULL, '2019-03-28 09:02:20', 0, NULL, NULL, 4),
(7, '', 'Kieffer', 'Onate', 'Osmena', '', 1, '2008-10-24', 'makati', 'Legian1 Blk16Lot10', 'eldaa onate', '09157142042', 'bucandala', '', '', '', '', '', '', '09157142042', '', 4, '89.00', 5, 3, 1, '2019-03-28', 'kieffer', '$2y$12$p7MTOMfI9LzjNdUcQ.ReF.2kyu9IB1A0f5OCUtE5pzjyZwTm3SdNq', NULL, NULL, '2019-03-28 09:16:13', 0, NULL, NULL, 4),
(8, '', 'kimberly', 'gapasita', 'berry', 'ext. ', 2, '0000-00-00', '', 'quezon city', 'Angelo De la Qua', '09753382361', 'VMC', 'jose frances', 'contruction', '', '', '', '', '', '', 5, '90.00', 6, 3, 1, '2019-03-28', 'kim1995', '$2y$12$jyNtLHFLm364ZL4dWeEE9eQw7cktKyQDHZUakaENQpmVfWj24q/gG', NULL, NULL, '2019-03-28 19:17:00', 0, NULL, NULL, 4),
(9, '', 'britney', 'spears', 'brit', '', 2, '2009-10-24', 'USA', 'legian', 'eldaa onate', '09157142042', 'BREHMS', '', '', '', '', '', '', '', '', 4, '0.00', 5, 3, 1, '2019-04-02', 'britney', '$2y$12$1iss.ov1aCWUwffCzHiStuFToXiI5whHVDYrcSMAWQpupP2UxVXOy', NULL, NULL, '2019-04-02 07:24:15', 0, NULL, NULL, 4),
(10, '', 'kael', 'onate', 'osmena', 'none', 1, '2008-10-29', 'imus', 'legian', 'eldaa onate', '0917142042', 'not appplicable', 'ryan onate', 'sales rep', '', 'roman catholic', 'eldaa onate osmena', 'Service Desk Technician', '09157142042', 'Seventh day Adventist', 0, '0.00', 7, 3, 1, '2019-04-13', 'kael', '$2y$12$ijE2EddLyNnyTtUZc77rJe6TJxel77RERUaLIc7p/FJnWJ76U1Kny', NULL, NULL, '2019-04-14 05:03:02', 0, NULL, NULL, 4),
(11, '', 'kelvin', 'laurel', 'saavedra', 'none', 1, '2009-02-05', 'caloocan', '', 'gelica saavedra', '09157142042', '', 'mervin laurel', 'supervisor', '', '', 'gelica garcia saavedra', '', '', '', 0, '0.00', 7, 3, 1, '2019-04-14', 'kelvin', '$2y$12$7n190qjhG6IzGBBoze51i.WK09/JlvSX7gLuPbR.mc6UWPd1yad7O', 'Muning', 'Mama', '2019-04-14 14:14:18', 0, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subject_category_tbl`
--

CREATE TABLE `subject_category_tbl` (
  `subject_category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_category_tbl`
--

INSERT INTO `subject_category_tbl` (`subject_category_id`, `category_name`, `added_by`, `date_added`, `status_id`) VALUES
(1, 'ACADEMIC', 1, '2019-02-10 07:34:20', 1),
(2, 'SELF HELP', 1, '2019-02-10 07:36:35', 1),
(3, 'COGNITIVE DOMAIN', 1, '2019-02-10 07:36:35', 1),
(4, 'EXPRESSIVE LANGUAGE', 1, '2019-02-10 07:36:35', 1),
(5, 'RECEPTIVE LANGUAGE DOMAIN', 1, '2019-02-10 07:36:35', 1),
(6, 'SOCIO-EMOTIONAL DOMAIN', 1, '2019-02-10 07:36:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_parent_tbl`
--

CREATE TABLE `subject_parent_tbl` (
  `subject_parent_id` int(11) NOT NULL,
  `subject_parent` varchar(100) NOT NULL,
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `dt_updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status_id` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_tbl`
--

CREATE TABLE `subject_tbl` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `subject_description` varchar(200) DEFAULT '',
  `dt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `dt_updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status_id` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_tbl`
--

INSERT INTO `subject_tbl` (`subject_id`, `subject_name`, `subject_description`, `dt_created`, `created_by`, `dt_updated`, `updated_by`, `status_id`) VALUES
(1, 'MTB', 'Mother Tongue-Base', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(2, 'MATH', 'Mathematics', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(3, 'AP', 'Araling Panlipunan', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(4, 'MUSIC', '', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(5, 'ARTS', '', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(6, 'PE', 'Physical Education', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(7, 'HEALTH', '', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(8, 'ESP', 'Edukasyon sa Pagpapaka tao', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(9, 'FILIPINO', '', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(10, 'ENGLISH', '', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(11, 'SCIENCE', '', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(12, 'EPP', 'Edukasyong Pangkalusugan', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(13, 'HE', 'Home Economics', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1),
(14, 'TLE', 'Technology and Livelihood Education', '2019-03-22 14:00:00', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_teacher`
--

CREATE TABLE `subject_teacher` (
  `id` int(11) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_teacher`
--

INSERT INTO `subject_teacher` (`id`, `gradelevel_id`, `section_id`, `subject_id`, `faculty_id`, `date_encoded`, `encoded_by`, `date_updated`, `updated_by`) VALUES
(4, 2, 4, 1, 1, '2018-09-27 20:36:51', 0, '2018-09-27 20:36:51', 0),
(5, 1, 5, 4, 3, '2018-10-05 20:14:15', 1, '2018-10-05 20:14:15', 0),
(6, 1, 5, 5, 2, '2018-10-05 20:14:32', 1, '2018-10-05 20:14:32', 0),
(10, 2, 3, 1, 1, '2018-10-13 22:29:34', 1, '2018-10-13 22:29:34', 0),
(12, 2, 3, 2, 1, '2018-10-13 22:30:24', 1, '2018-10-13 22:30:24', 0),
(15, 1, 5, 4, 1, '2018-10-13 22:38:37', 1, '2018-10-13 22:38:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tuition_tbl`
--

CREATE TABLE `tuition_tbl` (
  `id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `tuition_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `general_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `auxiliary_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `other_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date_encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `encoded_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuition_tbl`
--

INSERT INTO `tuition_tbl` (`id`, `schoolyear_id`, `gradelevel_id`, `tuition_fee`, `general_fee`, `auxiliary_fee`, `other_fee`, `date_encoded`, `encoded_by`) VALUES
(1, 1, 1, '22639.71', '6080.00', '0.00', '2230.00', '2018-09-22 13:47:30', 0),
(2, 1, 2, '22639.71', '6080.00', '0.00', '2230.00', '2018-09-22 13:47:30', 0),
(3, 1, 3, '22958.75', '6080.00', '0.00', '2230.00', '2018-09-22 13:47:30', 0),
(4, 1, 4, '23439.82', '6780.00', '0.00', '2230.00', '2018-09-22 13:47:30', 0),
(5, 1, 5, '24170.36', '6780.00', '0.00', '3230.00', '2018-09-22 13:47:30', 0),
(6, 1, 6, '24274.72', '6780.00', '800.00', '3230.00', '2018-09-22 13:47:30', 0),
(7, 1, 7, '20802.93', '5440.00', '0.00', '6230.00', '2018-09-22 13:47:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`status_id`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `password`, `access_id`, `faculty_id`, `status_id`, `created_by`, `date_created`) VALUES
(1, 'admin', '$2y$12$m/sHoo5KN.8GTszCr0Ama.euuOEQcHdWNea8Mshy0IY56rE4X43iK', 1, 1, 1, 1, '2017-12-26 00:00:00'),
(4, 'cashier', '$2y$12$H9Ca.Mgosta4nlyzKHnwoOgFIgSyh5tH6.gpP2Hmsrg2CTAEvCcoC', 4, 3, 1, 1, '2018-09-27 22:10:33'),
(5, 'principal', '$2y$12$vsosaoNBjl.VKFJde7KzsOFpzVJn6prldbDe24baLZDkbD/oCLo2S', 2, 2, 1, 1, '2018-09-27 22:11:14'),
(6, 'teacher', '$2y$12$PZRAcdmxpkQgZ4sBA1xg.O1TaawrzLAUlydYS2OEQepXSmiSncZlm', 3, 1, 1, 1, '2018-10-06 23:05:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_tbl`
--
ALTER TABLE `access_tbl`
  ADD PRIMARY KEY (`access_id`),
  ADD UNIQUE KEY `access_name` (`access_name`);

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `advisory_tbl`
--
ALTER TABLE `advisory_tbl`
  ADD PRIMARY KEY (`advisory_id`);

--
-- Indexes for table `faculty_status`
--
ALTER TABLE `faculty_status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `gender_tbl`
--
ALTER TABLE `gender_tbl`
  ADD PRIMARY KEY (`gender_id`),
  ADD UNIQUE KEY `gender` (`gender`);

--
-- Indexes for table `gradelevel_tbl`
--
ALTER TABLE `gradelevel_tbl`
  ADD PRIMARY KEY (`gradelevel_id`),
  ADD UNIQUE KEY `gradelevel_name` (`gradelevel_name`);

--
-- Indexes for table `grade_category_percentage_tbl`
--
ALTER TABLE `grade_category_percentage_tbl`
  ADD PRIMARY KEY (`grade_percentage_id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`,`grade_category_id`);

--
-- Indexes for table `grade_category_tbl`
--
ALTER TABLE `grade_category_tbl`
  ADD PRIMARY KEY (`gradecategory_id`),
  ADD UNIQUE KEY `category` (`gradecategory_name`);

--
-- Indexes for table `grade_quarter_tbl`
--
ALTER TABLE `grade_quarter_tbl`
  ADD PRIMARY KEY (`grade_quarter_id`);

--
-- Indexes for table `grade_score_tbl`
--
ALTER TABLE `grade_score_tbl`
  ADD PRIMARY KEY (`grade_score_id`);

--
-- Indexes for table `grade_transmutation_tbl`
--
ALTER TABLE `grade_transmutation_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offence_tbl`
--
ALTER TABLE `offence_tbl`
  ADD PRIMARY KEY (`offence_id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `quarter_tbl`
--
ALTER TABLE `quarter_tbl`
  ADD PRIMARY KEY (`quarter_id`),
  ADD UNIQUE KEY `quarter_name` (`quarter_name`);

--
-- Indexes for table `schoolyear_tbl`
--
ALTER TABLE `schoolyear_tbl`
  ADD PRIMARY KEY (`schoolyear_id`),
  ADD UNIQUE KEY `schoolyear_start` (`schoolyear_start`,`schoolyear_end`);

--
-- Indexes for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD PRIMARY KEY (`section_id`),
  ADD UNIQUE KEY `section_name` (`section_name`,`gradelevel_id`);

--
-- Indexes for table `settings_sms_tbl`
--
ALTER TABLE `settings_sms_tbl`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `status_tbl`
--
ALTER TABLE `status_tbl`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `subject_category_tbl`
--
ALTER TABLE `subject_category_tbl`
  ADD PRIMARY KEY (`subject_category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `subject_parent_tbl`
--
ALTER TABLE `subject_parent_tbl`
  ADD PRIMARY KEY (`subject_parent_id`),
  ADD UNIQUE KEY `subject_parent` (`subject_parent`);

--
-- Indexes for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gradelevel_id` (`gradelevel_id`,`section_id`,`subject_id`,`faculty_id`);

--
-- Indexes for table `tuition_tbl`
--
ALTER TABLE `tuition_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolyear_id` (`schoolyear_id`,`gradelevel_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_tbl`
--
ALTER TABLE `access_tbl`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `advisory_tbl`
--
ALTER TABLE `advisory_tbl`
  MODIFY `advisory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty_status`
--
ALTER TABLE `faculty_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gender_tbl`
--
ALTER TABLE `gender_tbl`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gradelevel_tbl`
--
ALTER TABLE `gradelevel_tbl`
  MODIFY `gradelevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grade_category_percentage_tbl`
--
ALTER TABLE `grade_category_percentage_tbl`
  MODIFY `grade_percentage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `grade_category_tbl`
--
ALTER TABLE `grade_category_tbl`
  MODIFY `gradecategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade_quarter_tbl`
--
ALTER TABLE `grade_quarter_tbl`
  MODIFY `grade_quarter_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_score_tbl`
--
ALTER TABLE `grade_score_tbl`
  MODIFY `grade_score_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_transmutation_tbl`
--
ALTER TABLE `grade_transmutation_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `offence_tbl`
--
ALTER TABLE `offence_tbl`
  MODIFY `offence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quarter_tbl`
--
ALTER TABLE `quarter_tbl`
  MODIFY `quarter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schoolyear_tbl`
--
ALTER TABLE `schoolyear_tbl`
  MODIFY `schoolyear_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section_tbl`
--
ALTER TABLE `section_tbl`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings_sms_tbl`
--
ALTER TABLE `settings_sms_tbl`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_tbl`
--
ALTER TABLE `status_tbl`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject_category_tbl`
--
ALTER TABLE `subject_category_tbl`
  MODIFY `subject_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject_parent_tbl`
--
ALTER TABLE `subject_parent_tbl`
  MODIFY `subject_parent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tuition_tbl`
--
ALTER TABLE `tuition_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
