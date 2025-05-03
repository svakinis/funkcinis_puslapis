-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 06:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `title`, `comment_text`, `location`, `created_at`, `ip_address`) VALUES
(3, 2, 'abc', 'abcde', 'adc', '2025-05-03 14:06:46', '::1'),
(4, 1, 'baba', 'maba', 'gaba', '2025-05-03 15:42:36', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `success` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `timestamp`, `success`, `ip_address`) VALUES
(1, 2, '2025-05-03 14:00:37', 1, '::1'),
(2, 1, '2025-05-03 14:02:42', 1, '::1'),
(3, 1, '2025-05-03 14:05:41', 1, '::1'),
(4, 2, '2025-05-03 14:06:21', 1, '::1'),
(5, 1, '2025-05-03 14:16:31', 1, '::1'),
(6, 1, '2025-05-03 14:16:59', 1, '::1'),
(7, 1, '2025-05-03 14:20:03', 1, '::1'),
(8, 1, '2025-05-03 14:24:49', 1, '::1'),
(9, 1, '2025-05-03 14:25:05', 1, '::1'),
(10, 1, '2025-05-03 15:10:38', 1, '::1'),
(11, 2, '2025-05-03 15:12:53', 1, '::1'),
(12, 1, '2025-05-03 15:13:09', 1, '::1'),
(13, 2, '2025-05-03 15:14:23', 1, '::1'),
(14, 2, '2025-05-03 15:16:01', 1, '::1'),
(15, 1, '2025-05-03 15:16:09', 1, '::1'),
(16, 1, '2025-05-03 15:16:21', 1, '::1'),
(17, 1, '2025-05-03 15:17:07', 1, '::1'),
(18, 1, '2025-05-03 15:19:02', 1, '::1'),
(19, 1, '2025-05-03 15:19:07', 1, '::1'),
(20, 1, '2025-05-03 15:25:35', 1, '::1'),
(21, 1, '2025-05-03 15:30:40', 1, '::1'),
(22, 1, '2025-05-03 15:32:36', 1, '::1'),
(23, 1, '2025-05-03 15:33:08', 1, '::1'),
(24, 1, '2025-05-03 15:35:20', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'testuser', 'Test', 'User', 'testuser@example.com', '$2y$10$B/O8SjOFte2UlqPD64dU/uzBoBvyfo5JimioDx4CiTxC1FGi/S7xm', '2025-05-03 11:54:54'),
(2, 'ainiux', 'ainis', 'pipyne', 'pipyneainis@gmail.com', '$2y$10$xx7NkWBwjG6P8BnCbTDYtOtFFElKhyT.QDX9fCsIKrJNOap3vvtkW', '2025-05-03 13:57:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
