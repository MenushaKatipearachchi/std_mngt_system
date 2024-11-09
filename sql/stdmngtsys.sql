-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 05:07 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stdmngtsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent') DEFAULT 'present'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `date`, `status`) VALUES
(3, 9, '2024-11-08', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `category` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `category`, `date`, `image_path`, `last_modified`) VALUES
(1, 'SaaS Website Development', 'Learn to build SaaS websites.', 'Development', '2024-12-04', 'uploads/672f88434716a-IMG-20241109-WA0006.jpg', '2024-11-09 16:05:23'),
(2, 'Learn UI/UX Engineering', 'UI/UX for websites.', 'UI/UX', '2024-12-03', 'uploads/672f842126374-IMG-20241109-WA0002.jpg', '2024-11-09 15:47:45'),
(3, 'E-commerce Website', 'Complete guide to e-commerce development.', 'Development', '2024-12-01', 'uploads/672f884cebaed-e-commerce-img.avif', '2024-11-09 16:05:32'),
(4, 'Blog Website Optimisation', 'Create and optimise blog websites.', 'UI/UX', '2024-12-01', 'uploads/672f852d961f2-IMG-20241109-WA0009.jpg', '2024-11-09 15:52:13'),
(5, 'Advanced JavaScript', 'Deep dive into JavaScript concepts and frameworks.', 'Programming', '2023-02-10', 'uploads/672f84a69647e-IMG-20241109-WA0011.jpg', '2024-11-09 15:49:58'),
(6, 'Python for Data Science', 'Learn Python specifically for data analysis and data science applications.', 'Data Science', '2022-11-15', 'uploads/672f84e93c176-IMG-20241109-WA0012.jpg', '2024-11-09 15:51:05'),
(7, 'React and Redux', 'Build dynamic and reactive web applications using React and Redux.', 'Web Development', '2023-03-05', 'uploads/672f85ddce6d5-IMG-20241109-WA0013.jpg', '2024-11-09 15:55:09'),
(8, 'Digital Marketing Fundamentals', 'Overview of digital marketing techniques and strategies.', 'Marketing', '2023-07-21', 'uploads/672f844463236-IMG-20241109-WA0014.jpg', '2024-11-09 15:48:20'),
(9, 'Machine Learning with Python', 'An introduction to machine learning techniques using Python.', 'Data Science', '2023-08-13', 'uploads/672f84f265828-IMG-20241109-WA0003.jpg', '2024-11-09 15:51:14'),
(10, 'Full-Stack Web Development', 'Learn to build complete web applications from front-end to back-end.', 'Web Development', '2023-01-28', 'uploads/672f85a5b32d4-IMG-20241109-WA0010.jpg', '2024-11-09 15:54:13'),
(11, 'Intro to Cloud Computing', 'Understanding cloud platforms and services.', 'Cloud Computing', '2023-06-10', 'uploads/672f858855d6f-IMG-20241109-WA0008.jpg', '2024-11-09 15:53:44'),
(12, 'UI/UX Design Principles', 'Learn the basics of user interface and user experience design.', 'Design', '2023-04-12', 'uploads/672f855f87307-IMG-20241109-WA0005.jpg', '2024-11-09 15:53:03'),
(13, 'Cybersecurity Essentials', 'Introduction to cybersecurity and common security practices.', 'Cybersecurity', '2023-09-05', 'uploads/672f853c3fdf5-IMG-20241109-WA0007.jpg', '2024-11-09 15:52:28'),
(14, 'Mobile App Development with Flutter', 'Create cross-platform mobile applications using Flutter.', 'Mobile Development', '2023-10-20', 'uploads/672f856fb5756-IMG-20241109-WA0004.jpg', '2024-11-09 15:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `enrollment_date`, `status`) VALUES
(14, 7, 1, '2024-11-07 19:58:46', 'approved'),
(15, 7, 2, '2024-11-07 20:25:19', 'approved'),
(16, 7, 3, '2024-11-07 20:47:04', 'rejected'),
(20, 7, 4, '2024-11-08 05:58:21', 'rejected'),
(21, 7, 7, '2024-11-08 08:17:50', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_image`) VALUES
(7, 'admin', 'admin@gmail.com', '$2a$12$ABdBpySbff6QCbX1cwz39OftAoimAIGBzxT9r71BHRdP8KSE5zEQq', 'admin/uploads/profile/1150589.jpg'),
(9, 'test', 'test@gmail.com', '$2y$10$jn08cTXCNRbzB5QrWIqDZOAyruMnReCdjILF7MZmdgoyg6Ih5BiK2', NULL),
(10, 'test2', 'test2@gmail.com', '$2y$10$K1N03eecErkE/LnxSmULheIikOJFvcohsHGRtGbVP9ArJdOf293H.', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
