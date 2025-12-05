-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2025 at 04:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `encryption_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `encrypted_text` text NOT NULL,
  `decrypted_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `encrypted_text`, `decrypted_text`, `created_at`) VALUES
(60, 'oll', '100', '2025-11-13 07:13:29'),
(61, 'oll', '100', '2025-11-13 07:13:35'),
(62, 'AAAAAA', 'SSSSSS', '2025-11-13 07:43:30'),
(63, 'AAAAA', 'SSSSS', '2025-11-13 07:43:38'),
(64, '-', 'F', '2025-11-13 07:44:13'),
(65, '-', 'f', '2025-11-13 07:44:20'),
(66, 'o', '1', '2025-11-13 07:46:12'),
(67, 'o', '1', '2025-11-13 07:46:16'),
(68, '4r!!3 73h!2', 'hello world', '2025-11-13 23:57:45'),
(69, '4r!!3 73h!2', 'hello world', '2025-11-13 23:58:15'),
(70, '$8p$8p$8$tt$', 'nbmnbmnbnccn', '2025-11-14 01:07:23'),
(71, '43prhz3jm', 'Homerpogi', '2025-11-14 01:07:41'),
(72, ' 43prhz3jm', ' homerpogi', '2025-11-14 01:07:58'),
(73, 'back to home paje', '9stu c1 r1ik msgk', '2025-11-14 01:08:21'),
(74, '9stu co roik msjk', 'jqc3 t1 e18u iqgu', '2025-11-14 01:08:36'),
(75, ' jqc3 to eo8u iqju', ' gato c1 k1b3 8ag3', '2025-11-14 01:08:45'),
(76, '!r', 'le', '2025-11-14 01:10:46'),
(77, '43$rn', 'honey', '2025-11-14 01:21:47'),
(78, '43$rn', 'honey', '2025-11-14 01:21:55'),
(79, 'en!mr', 'kylie', '2025-11-14 13:46:17'),
(80, 'en!mr', 'kylie', '2025-11-14 14:08:28'),
(81, 'aaaa', 'ssss', '2025-11-14 14:51:30'),
(82, 'aaaa', 'ssss', '2025-11-14 14:51:37'),
(83, 't', 'c', '2025-11-14 14:59:22'),
(84, '8te', 'bck', '2025-11-14 15:08:26'),
(85, 'en!mr', 'kylie', '2025-11-14 15:29:55'),
(86, 'en!mr', 'kylie', '2025-11-14 15:30:02'),
(87, 'yyy', 'xxx', '2025-11-30 03:46:29'),
(88, 'q', 'a', '2025-11-30 03:46:49'),
(89, 'q', 'a', '2025-11-30 03:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `unique_values`
--

CREATE TABLE `unique_values` (
  `id` int(11) NOT NULL,
  `original_letter` varchar(10) NOT NULL,
  `assigned_value` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unique_values`
--

INSERT INTO `unique_values` (`id`, `original_letter`, `assigned_value`, `created_at`) VALUES
(1, 'A', 'Q', '2025-11-30 03:48:48'),
(2, 'B', '8', '2025-11-30 03:48:48'),
(3, 'C', 'T', '2025-11-30 03:48:48'),
(4, 'D', '2', '2025-11-30 03:48:48'),
(5, 'E', 'R', '2025-11-30 03:48:48'),
(6, 'F', '-', '2025-11-30 03:48:48'),
(7, 'G', 'J', '2025-11-30 03:48:48'),
(8, 'H', '4', '2025-11-30 03:48:48'),
(9, 'I', 'M', '2025-11-30 03:48:48'),
(10, 'J', '9', '2025-11-30 03:48:48'),
(11, 'K', 'E', '2025-11-30 03:48:48'),
(12, 'L', '!', '2025-11-30 03:48:48'),
(13, 'M', 'P', '2025-11-30 03:48:48'),
(14, 'N', '$', '2025-11-30 03:48:48'),
(15, 'O', '3', '2025-11-30 03:48:48'),
(16, 'P', 'Z', '2025-11-30 03:48:48'),
(17, 'Q', 'S', '2025-11-30 03:48:48'),
(18, 'R', 'H', '2025-11-30 03:48:48'),
(19, 'S', 'A', '2025-11-30 03:48:48'),
(20, 'T', 'C', '2025-11-30 03:48:48'),
(21, 'U', 'K', '2025-11-30 03:48:48'),
(22, 'V', 'X', '2025-11-30 03:48:48'),
(23, 'W', '7', '2025-11-30 03:48:48'),
(24, 'X', 'Y', '2025-11-30 03:48:48'),
(25, 'Y', 'N', '2025-11-30 03:48:48'),
(26, 'Z', '6', '2025-11-30 03:48:48'),
(27, '0', 'L', '2025-11-30 03:48:48'),
(28, '1', 'O', '2025-11-30 03:48:48'),
(29, '2', '5', '2025-11-30 03:48:48'),
(30, '3', 'U', '2025-11-30 03:48:48'),
(31, '4', 'F', '2025-11-30 03:48:48'),
(32, '5', 'D', '2025-11-30 03:48:48'),
(33, '6', 'W', '2025-11-30 03:48:48'),
(34, '7', 'V', '2025-11-30 03:48:48'),
(35, '8', 'I', '2025-11-30 03:48:48'),
(36, '9', 'B', '2025-11-30 03:48:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unique_values`
--
ALTER TABLE `unique_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `original_letter` (`original_letter`),
  ADD UNIQUE KEY `assigned_value` (`assigned_value`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `unique_values`
--
ALTER TABLE `unique_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
