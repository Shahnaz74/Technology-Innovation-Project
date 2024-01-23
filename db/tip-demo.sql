-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 07:38 PM
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
-- Database: `tip-demo`
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
(1, 'lam@example.com', 'Lam', 'Pham', '123456', '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(2, 'shahnaz@example.com', 'Shahnaz', 'Akter', '654321', '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(3, 'derek@example.com', 'Derek', 'Chan', '567890', '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(4, 'beryl@example.com', 'Hiu', 'Leung', '098765', '2023-05-09 13:02:45', '2023-05-09 13:02:45');

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
(34, 'text', 'Creator', 'creator', 'Enter Creator', 1, 10, '2023-05-09 16:32:12', '2023-05-09 16:32:12'),
(35, 'date', 'Date', 'date', 'Enter published date', 1, 10, '2023-05-09 17:18:38', '2023-05-09 17:18:38'),
(36, 'text', 'Identifier', 'identifier', 'Enter Identifier', 0, 10, '2023-05-09 17:25:27', '2023-05-09 17:25:27'),
(37, 'email', 'Relation', 'relation', 'Enter relation', 1, 10, '2023-05-09 17:27:17', '2023-05-09 17:27:17'),
(38, 'text', 'Publisher', 'publisher', 'Enter Publisher', 0, 10, '2023-05-09 17:27:17', '2023-05-09 17:27:17'),
(39, 'date', 'Date', 'date', 'Book published date', 1, 6, '2023-05-09 17:30:55', '2023-05-09 17:30:55'),
(40, 'textarea', 'Publisher', 'publisher', 'Publisher details', 1, 6, '2023-05-09 17:30:55', '2023-05-09 17:30:55'),
(41, 'textarea', 'Description', 'description', 'Provide brief discription', 0, 6, '2023-05-09 17:30:55', '2023-05-09 17:30:55'),
(42, 'text', 'Language', 'language', 'Specify Language', 0, 6, '2023-05-09 17:31:41', '2023-05-09 17:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `id` int(11) NOT NULL,
  `keyword` char(50) NOT NULL,
  `upload_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`id`, `keyword`, `upload_id`) VALUES
(1, 'keyword1', 1),
(2, 'keyword2', 1),
(3, 'keyword3', 1),
(4, 'keyword4', 2),
(5, 'keyword1', 2),
(6, 'keyword2', 2),
(7, 'keyword5', 3),
(8, 'keyword4', 3),
(9, 'keyword2', 3);

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
(1, 'Advertisement Journal', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(2, 'Advertisement Newspaper', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(3, 'Article Journal', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(4, 'Article Newspaper', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(5, 'Book Historical', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(6, 'Book Technical', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(7, 'Photograph Commercial', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(8, 'Photograph Personal', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(9, 'Sales Brochure', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(10, 'Sales Record', NULL, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(13, 'My Template', NULL, '2023-05-09 15:51:44', '2023-05-09 15:51:44');

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
  `file_name` char(50) NOT NULL,
  `file` char(50) NOT NULL,
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
(1, 'sample_file1', 'path/to/sample_file.pdf', 'Harry Potter', NULL, 'Harry Potter', '2022-01-01', NULL, 'PDF', '12345', 'English', 'Random Publishing', NULL, 'All Rights Reserved', 'https://example.com', 'Sample File', 'Harry', 'Potter', 'harry@example.com', 1, 1, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(2, 'sample_file2', 'path/to/sample_file.pdf', NULL, NULL, NULL, NULL, NULL, 'PDF', '12345', 'Mandarin', 'Random Publishing', NULL, 'All Rights Reserved', NULL, 'Sample File', 'Creator2', 'Creator2', 'creator2@example.com', 1, 2, '2023-05-09 13:02:45', '2023-05-09 13:02:45'),
(3, 'sample_file3', 'path/to/sample_file.pdf', 'Contributor3', NULL, NULL, NULL, NULL, 'PDF', '12345', NULL, NULL, NULL, 'All Rights Reserved', NULL, 'Sample File', 'Creator3', 'Creator3', 'harry@example.com', 2, 3, '2023-05-09 13:02:45', '2023-05-09 13:02:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upload_id` (`upload_id`);

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
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE `user_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fields_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`);

--
-- Constraints for table `keyword`
--
ALTER TABLE `keyword`
  ADD CONSTRAINT `keyword_ibfk_1` FOREIGN KEY (`upload_id`) REFERENCES `user_uploads` (`upload_id`);

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
