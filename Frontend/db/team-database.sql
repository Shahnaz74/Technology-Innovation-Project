-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 02:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team-database`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email`, `first_name`, `last_name`, `password`, `created`, `updated`) VALUES
(1, 'lam@example.com', 'Lam', 'Pham', '123456', '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(2, 'shahnaz@example.com', 'Shahnaz', 'Akter', '654321', '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(3, 'derek@example.com', 'Derek', 'Chan', '567890', '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(4, 'beryl@example.com', 'Hiu', 'Leung', '098765', '2023-05-12 11:39:52', '2023-05-12 11:39:52');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `type` char(50) NOT NULL,
  `title` char(50) NOT NULL,
  `name` char(50) NOT NULL,
  `placeholder` char(50) NOT NULL,
  `is_required` tinyint(1) NOT NULL,
  `template_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `type`, `title`, `name`, `placeholder`, `is_required`, `template_id`, `created`, `updated`) VALUES
(1, 'text', 'Source', 'source', 'Enter the source', 1, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(2, 'text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 2, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(3, 'text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(4, 'text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 4, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(6, 'text', 'Creator', 'creator', 'Enter the name of the creator', 1, 2, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(7, 'date', 'Date', 'date', 'Enter the date associated with the resource', 0, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(8, 'textarea', 'Description', 'description', 'Enter an account of the resource', 1, 2, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(9, 'text', 'Format', 'format', 'Enter the file format or physical medium of the re', 0, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(10, 'text', 'Identifier', 'identifier', 'Enter an unambiguous reference to the resource', 1, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(11, 'textarea', 'Language', 'language', 'Define language', 0, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(12, 'text', 'Publisher', 'publisher', 'Enter the name of the publisher', 1, 4, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(13, 'text', 'Relation', 'relation', 'Enter a related resource', 0, 4, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(14, 'textarea', 'Rights', 'rights', 'Enter information about rights held in and over th', 0, 5, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(15, 'text', 'Source', 'source', 'Enter a related resource from which the described', 0, 5, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(16, 'textarea', 'Subject', 'subject', 'Enter the topic of the resource', 0, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(17, 'text', 'Title', 'title', 'Enter a name given to the resource', 1, 6, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(18, 'text', 'Type', 'type', 'Enter the nature or genre of the resource', 1, 6, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(33, 'text', 'Coverage', 'coverage', 'Enter Coverage', 1, 10, '2023-05-09 16:32:12', '2023-05-09 16:32:12'),
(34, 'text', 'Creator', 'creator', 'Enter Creators', 0, 10, '2023-05-09 16:32:12', '2023-05-09 16:32:12'),
(35, 'date', 'Date', 'date', 'Enter published date', 1, 10, '2023-05-09 17:18:38', '2023-05-09 17:18:38'),
(36, 'text', 'Identifier', 'identifier', 'Enter Identifier', 0, 10, '2023-05-09 17:25:27', '2023-05-09 17:25:27'),
(37, 'email', 'Relation', 'relation', 'Enter relation', 1, 10, '2023-05-09 17:27:17', '2023-05-09 17:27:17'),
(38, 'text', 'Publisher', 'publisher', 'Enter Publishers', 1, 10, '2023-05-09 17:27:17', '2023-05-09 17:27:17'),
(39, 'date', 'Date', 'date', 'Book published date', 1, 6, '2023-05-09 17:30:55', '2023-05-09 17:30:55'),
(40, 'textarea', 'Publisher', 'publisher', 'Publisher details', 1, 6, '2023-05-09 17:30:55', '2023-05-09 17:30:55'),
(41, 'textarea', 'Description', 'description', 'Provide brief discription', 0, 6, '2023-05-09 17:30:55', '2023-05-09 17:30:55'),
(42, 'text', 'Language', 'language', 'Specify Language', 0, 6, '2023-05-09 17:31:41', '2023-05-09 17:31:41');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fields_in_template`
--

INSERT INTO `fields_in_template` (`fit_id`, `is_required`, `template_id`, `field_id`, `created`, `updated`) VALUES
(1, 0, 1, 1, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(2, 0, 1, 3, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(3, 0, 1, 5, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(4, 1, 1, 6, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(5, 1, 1, 10, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(6, 1, 2, 2, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(7, 0, 2, 3, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(8, 1, 2, 4, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(9, 0, 3, 1, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(10, 1, 3, 3, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(11, 0, 3, 5, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(12, 1, 4, 4, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(13, 1, 4, 6, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(14, 1, 5, 9, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(15, 0, 6, 15, '2023-05-12 11:39:52', '2023-05-12 11:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `keyword_id` int(11) NOT NULL,
  `keyword` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`keyword_id`, `keyword`) VALUES
(1, 'keyword1'),
(2, 'keyword2'),
(3, 'keyword3'),
(4, 'keyword4'),
(5, 'keyword5'),
(6, 'keyword6'),
(7, 'keyword7'),
(8, 'keyword8'),
(9, 'keyword9');

-- --------------------------------------------------------

--
-- Table structure for table `keyword_upload`
--

CREATE TABLE `keyword_upload` (
  `keyword_upload_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keyword_upload`
--

INSERT INTO `keyword_upload` (`keyword_upload_id`, `upload_id`, `keyword_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 5),
(4, 2, 6),
(5, 2, 7),
(6, 3, 3),
(7, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `template_name` char(50) NOT NULL,
  `template_icon` char(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `template_name`, `template_icon`, `created`, `updated`) VALUES
(1, 'Advertisement Journal', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(2, 'Advertisement Newspaper', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(3, 'Article Journal', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(4, 'Article Newspaper', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(5, 'Book Historical', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(6, 'Book Technical', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(7, 'Photograph Commercial', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(8, 'Photograph Personal', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(9, 'Sales Brochure', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(10, 'Sales Record', NULL, '2023-05-12 11:39:52', '2023-05-12 11:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `upload_status`
--

CREATE TABLE `upload_status` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `description` char(200) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_uploads`
--

INSERT INTO `user_uploads` (`upload_id`, `file_name`, `file`, `contributor`, `coverage`, `creator`, `date`, `description`, `format`, `identifier`, `language`, `publisher`, `relation`, `rights`, `source`, `title`, `first_name`, `last_name`, `email`, `upload_status`, `template_id`, `created`, `updated`) VALUES
(1, 'sample_file1', 'path/to/sample_file.pdf', 'Harry Potter', NULL, 'Harry Potter', '2022-01-01', NULL, 'PDF', '12345', 'English', 'Random Publishing', NULL, 'All Rights Reserved', 'https://example.com', 'Sample File', 'Harry', 'Potter', 'harry@example.com', 1, 1, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(2, 'sample_file2', 'path/to/sample_file.pdf', NULL, NULL, NULL, NULL, NULL, 'PDF', '12345', 'Mandarin', 'Random Publishing', NULL, 'All Rights Reserved', NULL, 'Sample File', 'Creator2', 'Creator2', 'creator2@example.com', 1, 2, '2023-05-12 11:39:52', '2023-05-12 11:39:52'),
(3, 'sample_file3', 'path/to/sample_file.pdf', 'Contributor3', NULL, NULL, NULL, NULL, 'PDF', '12345', NULL, NULL, NULL, 'All Rights Reserved', NULL, 'Sample File', 'Creator3', 'Creator3', 'harry@example.com', 2, 3, '2023-05-12 11:39:52', '2023-05-12 11:39:52');

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
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_id` (`template_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `fields_in_template`
--
ALTER TABLE `fields_in_template`
  MODIFY `fit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `keyword_upload`
--
ALTER TABLE `keyword_upload`
  MODIFY `keyword_upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE `user_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fields_in_template`
--
ALTER TABLE `fields_in_template`
  ADD CONSTRAINT `fields_in_template_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`),
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
  ADD CONSTRAINT `user_uploads_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
