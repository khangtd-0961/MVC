-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2020 at 08:51 AM
-- Server version: 5.7.30-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `QLSV3`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_code` varchar(500) NOT NULL,
  `class_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_code`, `class_name`) VALUES
(1, '1A', 'Good student class'),
(2, '2A', 'Average student class');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_code` varchar(500) NOT NULL,
  `class_code_id` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `sex` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `date_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_code`, `class_code_id`, `name`, `sex`, `address`, `date_birth`) VALUES
(138, 'fsdf', '1A', 'ereá»­', '1', 'dfsdfdsf', '2020-06-24'),
(142, 'dfsdf', '1A', 'sfsdf', '0', 'sdfsdf', '2020-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `subject_point`
--

CREATE TABLE `subject_point` (
  `id` int(11) NOT NULL,
  `code_student_id` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `points` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_point`
--

INSERT INTO `subject_point` (`id`, `code_student_id`, `subject`, `points`) VALUES
(25, 'fsdf', 'Maths', '3'),
(26, 'fsdf', 'Physical', '4'),
(27, 'fsdf', 'Chemistry', '5'),
(37, '', 'Maths', ''),
(38, '', 'Physical', ''),
(39, '', 'Chemistry', ''),
(40, 'dfsdf', 'Maths', '1'),
(41, 'dfsdf', 'Physical', '2'),
(42, 'dfsdf', 'Chemistry', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_point`
--
ALTER TABLE `subject_point`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `subject_point`
--
ALTER TABLE `subject_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
