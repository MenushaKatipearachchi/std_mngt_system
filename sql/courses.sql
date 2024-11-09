-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 11:43 AM
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
(1, 'SaaS Website Development', 'Learn to build SaaS websites.', 'Development', '2024-12-04', 'uploads/672dac6859a99-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:15:04'),
(2, 'Learn UI/UX Engineering', 'UI/UX for websites.', 'UI/UX', '2024-12-03', 'uploads/672dac6fd0793-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:15:34'),
(3, 'E-commerce Website', 'Complete guide to e-commerce development.', 'Development', '2024-12-01', 'uploads/672dad57d46b3-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:19:03'),
(4, 'Blog Website Optimisation', 'Create and optimise blog websites.', 'UI/UX', '2024-12-01', 'uploads/672da663a0137-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:07:33'),
(5, 'Advanced JavaScript', 'Deep dive into JavaScript concepts and frameworks.', 'Programming', '2023-02-10', 'uploads/672dad6f7bc33-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:19:27'),
(6, 'Python for Data Science', 'Learn Python specifically for data analysis and data science applications.', 'Data Science', '2022-11-15', 'uploads/672dad7b31298-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:19:39'),
(7, 'React and Redux', 'Build dynamic and reactive web applications using React and Redux.', 'Web Development', '2023-03-05', 'uploads/672dad81e1705-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:19:45'),
(8, 'Digital Marketing Fundamentals', 'Overview of digital marketing techniques and strategies.', 'Marketing', '2023-07-21', 'uploads/672dad8ba66fa-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:19:55'),
(9, 'Machine Learning with Python', 'An introduction to machine learning techniques using Python.', 'Data Science', '2023-08-13', 'uploads/672dad66055ff-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:19:18'),
(10, 'Full-Stack Web Development', 'Learn to build complete web applications from front-end to back-end.', 'Web Development', '2023-01-28', 'uploads/672da9d6cb0ec-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:07:33'),
(11, 'Intro to Cloud Computing', 'Understanding cloud platforms and services.', 'Cloud Computing', '2023-06-10', 'uploads/672da9cec264a-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:07:33'),
(12, 'UI/UX Design Principles', 'Learn the basics of user interface and user experience design.', 'Design', '2023-04-12', 'uploads/672da9c8ec9b6-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:07:33'),
(13, 'Cybersecurity Essentials', 'Introduction to cybersecurity and common security practices.', 'Cybersecurity', '2023-09-05', 'uploads/672da658d5f96-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:07:33'),
(14, 'Mobile App Development with Flutter', 'Create cross-platform mobile applications using Flutter.', 'Mobile Development', '2023-10-20', 'uploads/672da64db6f13-c00bce58c817ec3a16945711111641d37320ae67-2240x1260.png', '2024-11-08 06:07:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
