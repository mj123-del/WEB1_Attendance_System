-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2025 at 12:32 PM
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
-- Database: `attendee`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Super Admin','Admin') NOT NULL DEFAULT 'Admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '*01A6717B58FF5C7EAFFF6CB7C96F7428EA65FE4C', 'Super Admin', '2025-05-11 08:54:16'),
(2, 'TestAdmin', '$2y$10$5jdoOWtkCF3DHeobiOqtoeVBrHNbZfEQnvyl/qR9fvcSjNYs4QA.i', 'Super Admin', '2025-05-19 04:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_log`
--

CREATE TABLE `attendance_log` (
  `attendance_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `action` enum('in','out') NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_log`
--

INSERT INTO `attendance_log` (`attendance_id`, `userId`, `action`, `timestamp`) VALUES
(2, 4, 'in', '2025-05-14 06:49:43'),
(3, 4, 'in', '2025-05-14 09:09:29'),
(4, 4, 'out', '2025-05-14 09:34:38'),
(12, 10, 'in', '2025-05-19 17:24:44'),
(13, 10, 'out', '2025-05-19 17:25:01'),
(14, 12, 'in', '2025-05-19 17:32:49'),
(15, 12, 'out', '2025-05-19 17:33:00'),
(16, 12, 'in', '2025-05-19 18:26:00'),
(17, 12, 'out', '2025-05-19 18:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `qrcode_id` int(11) NOT NULL,
  `encoded_datetime` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`qrcode_id`, `encoded_datetime`, `created_at`) VALUES
(316, 'fca1077d9a9f0dd9aa40f9b8538e310f5c64b424942f2700eb3c5d3e7babfd23', '2025-05-19 10:30:22'),
(317, '49639e760d60524b83d1586747c5e8510c245f29235a67b07f81b96e81aae337', '2025-05-19 10:31:22'),
(318, '973897e4e49197d761440bbecf7bcf262c1bd3d4037b74c8b6a280a1284cb442', '2025-05-19 10:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nameFull` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `shift` varchar(50) NOT NULL,
  `day_off` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `nameFull`, `role`, `department`, `status`, `shift`, `day_off`, `password`, `created_at`) VALUES
(4, 'bautistazherwin@gmail.com', 'Zherwin Bautista', 'Developer', 'TechComp', 'Active', '9:00AM-6:00PM', 'Sat-Sun', '$2y$10$4BmWsfM4wNBik0x39SNjeeYJw3VghroZ3HjC3Yu.quIHLKEfg0eVO', '2025-05-13 22:48:59'),
(5, 'cca@edu.ph', 'john sean', 'user', 'ICSLIS', 'Active', 'asddaaa', 'dddddddd', '$2y$10$Ti3WO2TGm/uyF3eGWmIB.O5lx5oThJ1539l.ODuG6u5bk9FGtcqYy', '2025-05-14 04:52:05'),
(10, 'zherwinTest1@gg.com', 'TestSub', 'N/A', 'N/A', 'Active', 'N/A', 'N/A', '$2y$10$IyabDMiv4VZWG3QIoC379OLfSS61mYco6SCfN3/eYpm5HORp1oneC', '2025-05-19 09:03:34'),
(12, 'test@gg.com', 'test', 'N/A', 'N/A', 'Active', 'N/A', 'N/A', '$2y$10$M8pd.e0qpWJiXDUOpO9q4uT82Ym4zDaAKXduMD/IulgmxdFPRbGDS', '2025-05-19 09:32:17'),
(13, 'present@gg.com', 'zherwin b', 'Technician', 'Tech', 'Active', '9:00Am - 5:00PM', 'Sat-Sun', '$2y$10$ffrc0DKxe/L/RrPSR5rg/eYjOck.iEGy7jPDUrN3ws4A3eJ1UFDHe', '2025-05-19 10:29:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `fk_user_id` (`userId`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`qrcode_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_log`
--
ALTER TABLE `attendance_log`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `qrcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
