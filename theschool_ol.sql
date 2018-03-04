-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2018 at 07:03 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theschool_ol`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `image` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`) VALUES
(1, 'Math 101', 'Counting', NULL),
(2, 'Literature 101', 'Reading', NULL),
(3, 'Physics 101', 'How Earth works', NULL),
(4, 'Chemistry 101', 'Mixing things', NULL),
(5, 'Psychology 101', 'How people work', NULL),
(6, 'Home Economics 101', 'Making things', NULL),
(7, 'Gym', 'Stay healthy', NULL),
(8, 'Biology 101', 'How everything lives', NULL),
(9, 'Music 101', 'Mixing sounds', NULL),
(10, 'Finance 101', 'Making money', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses_students`
--

INSERT INTO `courses_students` (`course_id`, `student_id`) VALUES
(1, 5),
(1, 8),
(1, 9),
(2, 3),
(2, 6),
(3, 8),
(3, 9),
(4, 1),
(4, 7),
(5, 3),
(5, 6),
(5, 7),
(5, 10),
(6, 1),
(6, 6),
(7, 4),
(7, 5),
(7, 7),
(8, 2),
(9, 2),
(9, 10),
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `image`) VALUES
(1, 'Kevyn', '054-7151493', 'kevyn@kevyn.net', NULL),
(2, 'Malachi', '054-5058743', 'malachi@mail.com', NULL),
(3, 'Arthur', '054-6948242', 'arthur@king.co.uk', NULL),
(4, 'Lucy', '054-6980941', 'lucy@narnia.com', NULL),
(5, 'Lesley', '054-4579028', 'lesley@durrell.com', NULL),
(6, 'Quintessa', '054-4208103', 'quintessa@d.co', NULL),
(7, 'Samuel', '054-9473303', 'sam@uel.com', NULL),
(8, 'Bernard', '054-5364296', 'bernie@ftw.com', NULL),
(9, 'Bethany', '054-0021393', 'bethanie@pretty.io', NULL),
(10, 'Lani', '054-8497660', 'lani@lani.la', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `role` text COLLATE utf8_bin,
  `pass` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `role`, `pass`) VALUES
(1, 'John Snow', '054-5555555', 'john@snow.com', 'sales', '123'),
(2, 'Anna Banana', '070-7770000', 'anna@theschool.com', 'owner', '456'),
(3, 'Elsa Frozen', '067-9876543', 'elsa@brrr.com', 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`course_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD CONSTRAINT `courses_students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courses_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
