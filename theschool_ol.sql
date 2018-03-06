-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2018 at 09:06 AM
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
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`) VALUES
(1, 'Math 101', 'Counting', 'upload/course.png'),
(2, 'Literature 101', 'Reading', 'upload/course.png'),
(3, 'Physics 101', 'How Earth works', 'upload/course.png'),
(4, 'Chemistry 101', 'Mixing things', 'upload/course.png'),
(5, 'Psychology 101', 'How people work', 'upload/course.png'),
(6, 'Home Economics 101', 'Making things', 'upload/course.png'),
(7, 'Gym', 'Stay healthy', 'upload/course.png'),
(8, 'Biology 101', 'How everything lives', 'upload/course.png'),
(9, 'Music 101', 'Mixing sounds', 'upload/course.png'),
(10, 'Finance 101', 'Making money', 'upload/course.png');

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
(3, 1),
(3, 8),
(3, 9),
(4, 1),
(4, 2),
(5, 3),
(5, 6),
(6, 6),
(7, 4),
(7, 5),
(7, 7),
(8, 2),
(8, 7),
(9, 2),
(9, 11),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `image`) VALUES
(1, 'Kevyn', '054-7151495', 'kevyn@kevynn.net', 'upload/student.png'),
(2, 'Malachi', '054-5058743', 'malachi@mail.com', 'upload/student.png'),
(3, 'Arthur', '054-6948242', 'arthur@king.co.uk', 'upload/student.png'),
(4, 'Lucy', '054-6980941', 'lucy@narnia.com', 'upload/student.png'),
(5, 'Lesley', '054-4579028', 'lesley@durrell.com', 'upload/student.png'),
(6, 'Adelina', '054-4208103', 'adel@ina.co', 'upload/student.png'),
(7, 'Samuel', '054-9473303', 'sam@uel.com', 'upload/student.png'),
(8, 'Bernard', '054-5364296', 'bernie@ftw.com', 'upload/student.png'),
(9, 'Bethany', '054-0021393', 'bethanie@pretty.io', 'upload/student.png'),
(11, 'Lani', '054-8887777', 'lani@lani.com', 'upload/student.png');

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
  `pass` text COLLATE utf8_bin,
  `image` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `role`, `pass`, `image`) VALUES
(1, 'John Snow', '054-5555555', 'john@snow.com', 'sales', '123', 'upload/admin.png'),
(2, 'Anna Banana', '070-7770000', 'anna@theschool.com', 'owner', '456', 'upload/admin.png'),
(3, 'Elsa Frozen', '090-1234567', 'elsa@brrr.com', 'admin', '123', 'upload/admin.png'),
(4, 'aa', '070-7770000', 'aa', 'owner', 'aa', 'upload/admin.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
