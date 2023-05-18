-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 06:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `email` char(50) NOT NULL,
  `first_name` char(50) NOT NULL,
  `last_name` char(50) NOT NULL,
  `password` char(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email`, `first_name`, `last_name`, `password`, `created`, `updated`) VALUES
(1, 'lam@example.com', 'Lam', 'Pham', '123456', '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(2, 'shahnaz@example.com', 'Shahnaz', 'Akter', '654321', '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(3, 'derek@example.com', 'Derek', 'Chan', '567890', '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(4, 'beryl@example.com', 'Hiu', 'Leung', '098765', '2023-05-10 01:42:56', '2023-05-10 01:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `type` char(50) NOT NULL,
  `title` char(50) NOT NULL,
  `name` char(50) NOT NULL,
  `placeholder` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`field_id`, `type`, `title`, `name`, `placeholder`) VALUES
(1, 'text', 'Contributor', 'contributor', 'Enter the name of the contributor'),
(2, 'text', 'Coverage', 'coverage', 'Enter the spatial or temporal topic of the resourc'),
(3, 'text', 'Creator', 'creator', 'Enter the name of the creator'),
(4, 'date', 'Date', 'date', 'Enter the date associated with the resource'),
(5, 'textarea', 'Description', 'description', 'Enter an account of the resource'),
(6, 'text', 'Format', 'format', 'Enter the file format or physical medium of the re'),
(7, 'text', 'Identifier', 'identifier', 'Enter an unambiguous reference to the resource'),
(8, 'text', 'Language', 'language', 'Enter the language of the resource'),
(9, 'text', 'Publisher', 'publisher', 'Enter the name of the publisher'),
(10, 'text', 'Relation', 'relation', 'Enter a related resource'),
(11, 'textarea', 'Rights', 'rights', 'Enter information about rights held in and over th'),
(12, 'text', 'Source', 'source', 'Enter a related resource from which the described'),
(13, 'text', 'Subject', 'subject', 'Enter the topic of the resource'),
(14, 'text', 'Title', 'title', 'Enter a name given to the resource'),
(15, 'text', 'Type', 'type', 'Enter the nature or genre of the resource');

-- --------------------------------------------------------

--
-- Table structure for table `fields_in_template`
--

CREATE TABLE `fields_in_template` (
  `fit_id` int(11) NOT NULL,
  `is_required` tinyint(1) NOT NULL,
  `template_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fields_in_template`
--

INSERT INTO `fields_in_template` (`fit_id`, `is_required`, `template_id`, `field_id`, `created`, `updated`) VALUES
(16, 1, 1, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(17, 0, 1, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(18, 0, 1, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(19, 0, 1, 2, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(20, 1, 1, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(21, 0, 1, 6, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(22, 0, 1, 1, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(23, 0, 1, 12, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(24, 0, 1, 8, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(25, 0, 1, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(26, 1, 2, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(27, 0, 2, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(28, 0, 2, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(29, 0, 2, 2, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(30, 1, 2, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(31, 0, 2, 6, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(32, 0, 2, 1, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(33, 0, 2, 12, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(34, 0, 2, 8, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(35, 0, 2, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(36, 0, 3, 12, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(37, 1, 3, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(38, 1, 3, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(39, 0, 3, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(40, 0, 3, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(41, 0, 3, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(42, 0, 3, 8, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(43, 1, 3, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(44, 0, 3, 6, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(45, 0, 4, 12, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(46, 1, 4, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(47, 1, 4, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(48, 0, 4, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(49, 0, 4, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(50, 0, 4, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(51, 0, 4, 8, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(52, 1, 4, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(53, 0, 4, 6, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(54, 1, 5, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(55, 1, 5, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(56, 1, 5, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(57, 0, 5, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(58, 0, 5, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(59, 0, 5, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(60, 1, 6, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(61, 1, 6, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(62, 1, 6, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(63, 0, 6, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(64, 0, 6, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(65, 0, 6, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(66, 1, 7, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(67, 1, 7, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(68, 1, 7, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(69, 0, 7, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(70, 0, 7, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(71, 0, 7, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(72, 1, 8, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(73, 1, 8, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(74, 1, 8, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(75, 0, 8, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(76, 0, 8, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(77, 0, 8, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(78, 1, 9, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(79, 1, 9, 3, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(80, 1, 9, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(81, 0, 9, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(82, 0, 9, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(83, 0, 9, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(84, 1, 10, 13, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(85, 0, 10, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(86, 0, 10, 7, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(87, 0, 10, 2, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(88, 1, 10, 4, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(89, 0, 10, 6, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(90, 0, 10, 1, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(91, 0, 10, 12, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(92, 1, 10, 9, '2023-05-13 06:34:34', '2023-05-13 06:34:34'),
(93, 0, 10, 5, '2023-05-13 06:34:34', '2023-05-13 06:34:34');
(100, 1, 14, 3, '2023-05-18 02:20:01', '2023-05-18 02:20:01'),

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `keyword_id` int(11) NOT NULL,
  `keyword` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`keyword_id`, `keyword`) VALUES
(10, 'LR1'),
(11, 'LR2'),
(12, 'P3'),
(13, 'P4'),
(14, 'P6'),
(15, 'Range Rover');

-- --------------------------------------------------------

--
-- Table structure for table `keyword_upload`
--

CREATE TABLE `keyword_upload` (
  `keyword_upload_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keyword_upload`
--

INSERT INTO `keyword_upload` (`keyword_upload_id`, `upload_id`, `keyword_id`) VALUES
(8, 11, 10),
(9, 12, 10),
(10, 13, 10),
(11, 14, 10),
(12, 21, 10),
(13, 22, 10),
(14, 23, 10),
(15, 24, 10),
(16, 25, 10),
(17, 26, 10),
(18, 35, 10),
(19, 36, 10),
(20, 27, 11),
(21, 28, 11),
(22, 37, 11),
(25, 15, 12),
(26, 29, 12),
(27, 6, 13),
(28, 7, 13),
(29, 8, 13),
(30, 16, 13),
(31, 17, 13),
(32, 18, 13),
(33, 30, 13),
(34, 9, 14),
(35, 10, 14),
(36, 19, 14),
(37, 20, 14),
(38, 31, 14),
(39, 32, 14),
(40, 33, 14),
(41, 34, 14),
(42, 38, 15),
(43, 39, 15),
(72, 5, 12),
(89, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `template_id` int(11) NOT NULL,
  `template_name` char(50) NOT NULL,
  `template_icon` char(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `template_name`, `template_icon`, `created`, `updated`) VALUES
(1, 'Advertisement Journal', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(2, 'Advertisement Newspaper', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(3, 'Article Journal', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(4, 'Article Newspaper', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(5, 'Book Historical', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(6, 'Book Technical', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(7, 'Photograph Commercial', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(8, 'Photograph Personal', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(9, 'Sales Brochure', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56'),
(10, 'Sales Record', NULL, '2023-05-10 01:42:56', '2023-05-10 01:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `upload_status`
--

CREATE TABLE `upload_status` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upload_status`
--

INSERT INTO `upload_status` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'published'),
(3, 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE `user_uploads` (
  `upload_id` int(11) NOT NULL,
  `file_name` char(200) NOT NULL,
  `file` char(200) NOT NULL,
  `contributor` char(200) DEFAULT NULL,
  `coverage` char(200) DEFAULT NULL,
  `creator` char(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `format` char(200) DEFAULT NULL,
  `identifier` char(200) DEFAULT NULL,
  `language` char(200) DEFAULT NULL,
  `publisher` char(200) DEFAULT NULL,
  `relation` char(200) DEFAULT NULL,
  `rights` char(200) DEFAULT NULL,
  `source` char(200) DEFAULT NULL,
  `title` char(200) DEFAULT NULL,
  `first_name` char(50) NOT NULL,
  `last_name` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `upload_status` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_uploads`
--

INSERT INTO `user_uploads` (`upload_id`, `file_name`, `file`, `contributor`, `coverage`, `creator`, `date`, `description`, `format`, `identifier`, `language`, `publisher`, `relation`, `rights`, `source`, `title`, `first_name`, `last_name`, `email`, `upload_status`, `template_id`, `created`, `updated`) VALUES
(4, 'http://localhost/Technology-innovation/client-records/AJ_P3_IntroducingTheRoverSixtyAndSeventyFive_TheMotor_18Feb1948_p20.jpg', 'http://localhost/Technology-innovation/client-records/AJ_P3_IntroducingTheRoverSixtyAndSeventyFive_TheMotor_18Feb1948_p20.jpg', NULL, NULL, NULL, '1948-02-18', NULL, 'JPG', 'p20', 'English', 'The Motor', NULL, NULL, NULL, 'Introducing The Rover Sixty And Seventy Five', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 3, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(5, 'http://localhost/Technology-innovation/client-records/AJ_P3_TopMechanicalQuality_TheMotor_11May1949_p26.jpg', 'http://localhost/Technology-innovation/client-records/AJ_P3_TopMechanicalQuality_TheMotor_11May1949_p26.jpg', NULL, NULL, NULL, '1949-05-11', NULL, 'JPG', 'p26', 'English', 'The Motor', NULL, NULL, NULL, 'Top Mechanical Quality', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 3, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(6, 'AJ_P4_ItsAReliefToDriveARover_TheMotor_24Aug1955_p43.jpg', 'http://localhost/Technology-innovation/client-records/AJ_P4_ItsAReliefToDriveARover_TheMotor_24Aug1955_p43.jpg', NULL, NULL, NULL, '1955-08-24', NULL, 'JPG', 'p43', 'English', 'The Motor', NULL, NULL, NULL, 'It’s a Relief To Drive A Rover', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(7, 'AJ_P4_OneOfBritainsFineCars_TheMotor_24Oct1951_p58.jpg', 'http://localhost/Technology-innovation/client-records/AJ_P4_OneOfBritainsFineCars_TheMotor_24Oct1951_p58.jpg', NULL, NULL, NULL, '1951-10-24', NULL, 'JPG', 'p58', 'English', 'The Motor', NULL, NULL, NULL, 'One Of Britains Fine Cars', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(8, 'AJ_P4_RoverWorthGoesDeep_TheMotor_1Jul1953_p37.jpg', 'http://localhost/Technology-innovation/client-records/AJ_P4_RoverWorthGoesDeep_TheMotor_1Jul1953_p37.jpg', NULL, NULL, NULL, '1953-07-01', NULL, 'JPG', 'p37', 'English', 'The Motor', NULL, NULL, NULL, 'Rover Worth Goes Deep', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(9, 'AJ_P6_1965AlpineRallyAchievementForRover2000_Motor_7Aug1965.jpg', 'http://localhost/Technology-innovation/client-records/AJ_P6_1965AlpineRallyAchievementForRover2000_Motor_7Aug1965.jpg', NULL, NULL, NULL, '1965-08-07', NULL, 'JPG', NULL, 'English', 'The Motor', NULL, NULL, NULL, '1965 Alpine Rally Achievement For Rover 2000', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(10, 'AJ_P6_ThisCarsGotGutsEnoughToTalkAboutSafety_Autocar_29Oct1965.docx', 'http://localhost/Technology-innovation/client-records/AJ_P6_ThisCarsGotGutsEnoughToTalkAboutSafety_Autocar_29Oct1965.docx', NULL, NULL, NULL, '1965-10-29', NULL, 'DOCX', 'p30', 'English', 'Autocar', NULL, NULL, NULL, 'This Cars Got Guts Enough To Talk About Safety', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 1, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(11, 'AN_LR1_4WheelDriveMakesLandRoverARealUtility_WeeklyTimes_18Oct1950p40_nla.news-article224929271.2.pdf', 'http://localhost/Technology-innovation/client-records/AN_LR1_4WheelDriveMakesLandRoverARealUtility_WeeklyTimes_18Oct1950p40_nla.news-article224929271.2.pdf', 'National Library of Australia', 'Melbourne, VIC', NULL, '1950-10-18', NULL, 'PDF', 'p40', 'English', 'Weekly Times', NULL, NULL, 'http://nla.gov.au/nla.news-article224929271', '4 Wheel Drive Makes Land Rover A Real Utility', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 2, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(12, 'AN_LR1_LetLandRoverSaveYouMoney_Argus_18Nov1950p48_nla.news-article23027775.2.pdf', 'http://localhost/Technology-innovation/client-records/AN_LR1_LetLandRoverSaveYouMoney_Argus_18Nov1950p48_nla.news-article23027775.2.pdf', 'National Library of Australia', 'Melbourne, VIC', NULL, '1950-10-18', NULL, 'PDF', 'p48', 'English', 'Argus', NULL, NULL, 'http://nla.gov.au/nla.news-article23027775', 'Let Land Rover Save You Money', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 2, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(13, 'AN_LR1_TheFarmersBestFriendIsHisLandRover_Argus_23Dec1950p28_nla.news-article23020942.3.pdf', 'http://localhost/Technology-innovation/client-records/AN_LR1_TheFarmersBestFriendIsHisLandRover_Argus_23Dec1950p28_nla.news-article23020942.3.pdf', 'National Library of Australia', 'Melbourne, VIC', NULL, '1950-12-23', NULL, 'PDF', 'p28', 'English', 'Argus', NULL, NULL, 'http://nla.gov.au/nla.news-article23020942\r\n', 'The Farmers Best Friend Is His Land Rover', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 2, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(14, 'AN_LR1_TheWomanOnTheLandFindsAFriendInLandRover_Age_30Dec1950p3_nla.news-article206407392.3.pdf', 'http://localhost/Technology-innovation/client-records/AN_LR1_TheWomanOnTheLandFindsAFriendInLandRover_Age_30Dec1950p3_nla.news-article206407392.3.pdf', 'National Library of Australia', 'Melbourne, VIC', NULL, '1950-12-30', NULL, 'PDF', 'p93', 'English', 'The Age', NULL, NULL, 'http://nla.gov.au/nla.news-article206407392', 'The Woman On The Land Finds A Friend In Land Rover', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 2, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(15, 'AN_P3_RoverOneOfBritainsFineCarsNowMadeFiner_Age_11Apr1949p4_nla.news-article206082571.3_.pdf', 'http://localhost/Technology-innovation/client-records/AN_P3_RoverOneOfBritainsFineCarsNowMadeFiner_Age_11Apr1949p4_nla.news-article206082571.3_.pdf', 'National Library of Australia', 'Melbourne, VIC', NULL, '1949-04-11', NULL, 'PDF', 'p4', 'English', 'The Age', NULL, NULL, 'http://nla.gov.au/nla.news-article206082571', 'Rover One Of Britain\'s Fine Cars Now Made Finer', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 2, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(16, 'AN_P4_adamerica.jpg', 'http://localhost/Technology-innovation/client-records/AN_P4_adamerica.jpg', NULL, 'Melbourne, VIC', NULL, '1952-10-18', NULL, 'JPG', 'p19', 'English', 'The Herald', NULL, NULL, NULL, 'America Praises Rover 75', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 4, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(17, 'AN_P4_adegent.jpg', 'http://localhost/Technology-innovation/client-records/AN_P4_adegent.jpg', NULL, 'Melbourne, VIC', NULL, '1953-06-01', NULL, 'JPG', 'p23', 'English', 'The Sun News', NULL, NULL, NULL, 'Rover 75 A Masterpiece of Traditional Craftsmanship', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 4, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(18, 'AN_P5_IntroducingTheAllNewRoverV8_TheSydneyMorningHerald_13Feb1969_p6.docx', 'http://localhost/Technology-innovation/client-records/AN_P5_IntroducingTheAllNewRoverV8_TheSydneyMorningHerald_13Feb1969_p6.docx', NULL, 'Sydney, NSW', NULL, '1969-02-13', NULL, 'DOCX', 'p6', 'English', 'The Sydney Morning Herald', NULL, NULL, NULL, 'Introducing The All New Rover V8', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 4, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(19, 'AN_P6_SydneyMorningHerald_21Jun1971.docx', 'http://localhost/Technology-innovation/client-records/AN_P6_SydneyMorningHerald_21Jun1971.docx', NULL, 'Sydney, NSW', NULL, '1971-06-21', NULL, 'DOCX', NULL, 'English', NULL, NULL, NULL, NULL, 'To Chase The Glowing Hours With Flying Feet', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 4, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(20, 'AN_P6_TheRover2000_Elegance_SydneyMorniongHerald_19May1969.docx', 'http://localhost/Technology-innovation/client-records/AN_P6_TheRover2000_Elegance_SydneyMorniongHerald_19May1969.docx', NULL, 'Sydney, NSW', NULL, '1969-05-19', NULL, 'DOCX', NULL, 'English', 'The Sydney Morning Herald', NULL, NULL, NULL, 'The Rover 2000 Elegance', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 4, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(21, 'PC_1950_LR1_SLV_Cumming_OE585_Land Rover towing farm machibnery 1_FL15616809.jpg', 'http://localhost/Technology-innovation/client-records/PC_1950_LR1_SLV_Cumming_OE585_Land Rover towing farm machibnery 1_FL15616809.jpg', NULL, 'Cumming', NULL, '1950-01-01', NULL, 'JPG', NULL, NULL, 'State Library Victoria', NULL, NULL, NULL, 'Land Rover Towing Farm Machinery 1', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(22, 'PC_1950_LR1_SLV_Cumming_OE5856_Land Rovertowing farm machinery 2_FL15656112.jpg', 'http://localhost/Technology-innovation/client-records/PC_1950_LR1_SLV_Cumming_OE5856_Land Rovertowing farm machinery 2_FL15656112.jpg', NULL, 'Cumming', NULL, '1950-01-01', NULL, 'JPG', NULL, NULL, 'State Library Victoria', NULL, NULL, NULL, 'Land Rover Towing Farm Machinery 2', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(23, 'PC_LR1_1963_Herald and Weekly Times_HTZ00x_DB announcer Don Kinsey is back from a month-long trip through the outback to Darwin by Land Rover_FL16460331.jpg', 'http://localhost/Technology-innovation/client-records/PC_LR1_1963_Herald and Weekly Times_HTZ00x_DB announcer Don Kinsey is back from a month-long trip through the outback to Darwin by Land Rover_FL16', NULL, NULL, NULL, '1963-01-01', NULL, 'JPG', NULL, NULL, 'Herald and Weekly Times', NULL, NULL, NULL, 'DB Announcer Don Kinsey Is Back from a Month-Long Trip Through the Outback to Darwin by Land Rover', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(24, 'PC_LR1_LAND ROVER CO_lrfirstanniversary1949.jpg', 'http://localhost/Technology-innovation/client-records/PC_LR1_LAND ROVER CO_lrfirstanniversary1949.jpg', NULL, NULL, NULL, '1949-01-01', NULL, 'JPG', NULL, NULL, 'Land Rover Co', NULL, NULL, NULL, 'LR First Anniversary', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(25, 'PC_LR1_LAND ROVER CO_lrserieslaunchamsterdam1948.jpg', 'http://localhost/Technology-innovation/client-records/PC_LR1_LAND ROVER CO_lrserieslaunchamsterdam1948.jpg', NULL, NULL, NULL, '1948-01-01', NULL, 'JPG', NULL, NULL, 'Land Rover Co', NULL, NULL, NULL, 'LR Series Launch Amsterdam', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(26, 'PC_LR1_LAND ROVER CO_lrseriessolihullhistoricproduction1950s.jpg', 'http://localhost/Technology-innovation/client-records/PC_LR1_LAND ROVER CO_lrseriessolihullhistoricproduction1950s.jpg', NULL, NULL, NULL, '1950-01-01', NULL, 'JPG', NULL, NULL, 'Land Rover Co', NULL, NULL, NULL, 'LR Series Solihull Historic Production', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(27, 'PC_LR2_1963_SLV_Victoria. State Rivers and Water Supply Commission_MZH248_Land Rover Utility_FL16158824.jpg', 'http://localhost/Technology-innovation/client-records/PC_LR2_1963_SLV_Victoria. State Rivers and Water Supply Commission_MZH248_Land Rover Utility_FL16158824.jpg', NULL, 'VIC', NULL, '1963-01-01', NULL, 'JPG', NULL, NULL, 'State Library Victoria', NULL, NULL, NULL, 'State Rivers and Water Supply Commission', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(28, 'PC_LR2_1971_SLV_Herald and Weekly Times_Malcolm Douglas and David Oldmeadow preparing for their film trip around Austalia in a Land Rover_FL17252337.jpg', 'http://localhost/Technology-innovation/client-records/PC_LR2_1971_SLV_Herald and Weekly Times_Malcolm Douglas and David Oldmeadow preparing for their film trip around Austalia in a Land Rover_FL172523', 'State Library Victoria', 'VIC', NULL, '1971-01-01', NULL, 'JPG', NULL, NULL, 'Herald and Weekly Times', NULL, NULL, NULL, 'Malcolm Douglas and David Oldmeadow Preparing for Their Film Trip Around Australia in a Land Rover', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(29, 'PC_P3_BritishMotorHeritage_1947-ROVER-60.75-6LIGHT-SALOON.jpg', 'http://localhost/Technology-innovation/client-records/PC_P3_BritishMotorHeritage_1947-ROVER-60.75-6LIGHT-SALOON.jpg', NULL, NULL, NULL, '1947-01-01', NULL, 'JPG', NULL, NULL, 'British Motor Heritage', NULL, NULL, NULL, 'Rover 60 75 6Light Saloon', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(30, 'PC_P4_BritishMotorHeritage_1960-ROVER-100.jpg', 'http://localhost/Technology-innovation/client-records/PC_P4_BritishMotorHeritage_1960-ROVER-100.jpg', NULL, NULL, NULL, '1960-01-01', NULL, 'JPG', NULL, NULL, 'British Motor Heritage', NULL, NULL, NULL, 'Rover 100', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(31, 'PC_P6_BritishMotorHeritage_1964-ROVER-P6-2000.jpg', 'http://localhost/Technology-innovation/client-records/PC_P6_BritishMotorHeritage_1964-ROVER-P6-2000.jpg', NULL, NULL, NULL, '1964-01-01', NULL, 'JPG', NULL, NULL, 'British Motor Heritage', NULL, NULL, NULL, 'Rover P6 2000', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(32, 'PC_P6_BritishMotorHeritage_1971-ROVER-P6-2000TC.jpg', 'http://localhost/Technology-innovation/client-records/PC_P6_BritishMotorHeritage_1971-ROVER-P6-2000TC.jpg', NULL, NULL, NULL, '1971-01-01', NULL, 'JPG', NULL, NULL, 'British Motor Heritage', NULL, NULL, NULL, 'Rover P6 2000TC', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(33, 'PC_P6_Rover3500S_RoverCompany_1971.docx', 'http://localhost/Technology-innovation/client-records/PC_P6_Rover3500S_RoverCompany_1971.docx', NULL, NULL, NULL, '1971-01-01', NULL, 'DOCX', NULL, NULL, 'Rover Company', NULL, NULL, NULL, 'Rover 3500S', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(34, 'PC_P6_ThreeThousandFive_RoverCompany_1968.docx', 'http://localhost/Technology-innovation/client-records/PC_P6_ThreeThousandFive_RoverCompany_1968.docx', NULL, NULL, NULL, '1968-01-01', NULL, 'DOCX', NULL, NULL, 'Rover Company', NULL, NULL, NULL, 'Three Thousand Five', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 7, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(35, 'SB_LR1_Land Rover_BR Series I_1948-SW.pdf', 'http://localhost/Technology-innovation/client-records/SB_LR1_Land Rover_BR Series I_1948-SW.pdf', NULL, NULL, NULL, '1948-01-01', NULL, 'PDF', NULL, 'English', NULL, NULL, NULL, NULL, 'BR Series I Station Wagon', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 9, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(36, 'SB_LR1_Land-Rover-80-Inch-Regent-Motors-Brochure-1949-PDF.pdf', 'http://localhost/Technology-innovation/client-records/SB_LR1_Land-Rover-80-Inch-Regent-Motors-Brochure-1949-PDF.pdf', NULL, NULL, NULL, '1949-01-01', NULL, 'PDF', NULL, 'English', 'Regent Motors', NULL, NULL, NULL, '80 Inch Regent Motors Brochure', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 9, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(37, 'SB_LR2_Land Rover_US Series II_1964.pdf', 'http://localhost/Technology-innovation/client-records/SB_LR2_Land Rover_US Series II_1964.pdf', NULL, 'United States', NULL, '1964-01-01', NULL, 'PDF', NULL, 'English', NULL, NULL, NULL, NULL, 'US Series II', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 9, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(38, 'SB_RR_5-range-rover-brochure-australia-may-1982.pdf', 'http://localhost/Technology-innovation/client-records/SB_RR_5-range-rover-brochure-australia-may-1982.pdf', NULL, 'Australia', NULL, '1982-05-01', NULL, 'PDF', NULL, 'English', NULL, NULL, NULL, NULL, 'RR5 Range Rover Brochure', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 9, '2023-05-10 06:41:04', '2023-05-10 06:41:04'),
(39, 'SB_RR_6-range-rover-brochure-australia-1-3-1987.pdf', 'http://localhost/Technology-innovation/client-records/SB_RR_6-range-rover-brochure-australia-1-3-1987.pdf', NULL, 'Australia', NULL, '1987-01-01', NULL, 'PDF', NULL, 'English', NULL, NULL, NULL, NULL, 'RR6 Range Rover Brochure', 'RCCA', 'Admin', 'secretary.rcca@gmail.com', 2, 9, '2023-05-10 06:41:04', '2023-05-10 06:41:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `fields_in_template`
--
ALTER TABLE `fields_in_template`
  ADD PRIMARY KEY (`fit_id`),
  ADD KEY `template_id` (`template_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`keyword_id`);

--
-- Indexes for table `keyword_upload`
--
ALTER TABLE `keyword_upload`
  ADD PRIMARY KEY (`keyword_upload_id`),
  ADD KEY `upload_id` (`upload_id`),
  ADD KEY `keyword_id` (`keyword_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `upload_status`
--
ALTER TABLE `upload_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_uploads`
--
ALTER TABLE `user_uploads`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `upload_status` (`upload_status`),
  ADD KEY `template_id` (`template_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fields_in_template`
--
ALTER TABLE `fields_in_template`
  MODIFY `fit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `keyword_upload`
--
ALTER TABLE `keyword_upload`
  MODIFY `keyword_upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE `user_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fields_in_template`
--
ALTER TABLE `fields_in_template`
  ADD CONSTRAINT `fields_in_template_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`template_id`),
  ADD CONSTRAINT `fields_in_template_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`field_id`);

--
-- Constraints for table `keyword_upload`
--
ALTER TABLE `keyword_upload`
  ADD CONSTRAINT `keyword_upload_ibfk_1` FOREIGN KEY (`upload_id`) REFERENCES `user_uploads` (`upload_id`),
  ADD CONSTRAINT `keyword_upload_ibfk_2` FOREIGN KEY (`keyword_id`) REFERENCES `keyword` (`keyword_id`);

--
-- Constraints for table `user_uploads`
--
ALTER TABLE `user_uploads`
  ADD CONSTRAINT `user_uploads_ibfk_1` FOREIGN KEY (`upload_status`) REFERENCES `upload_status` (`id`),
  ADD CONSTRAINT `user_uploads_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `template` (`template_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
