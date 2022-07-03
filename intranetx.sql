-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2022 at 12:20 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intranetx`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `link_id` int(11) NOT NULL,
  `link_name` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `link_name`, `link`) VALUES
(1, 'google', 'https://www.google.com/'),
(2, 'facebook', 'https://www.facebook.com'),
(3, 'Youtube', 'youtube.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', 'admin'),
(1, 'gagana', '12345', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `in_time` datetime NOT NULL,
  `out_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `in_time`, `out_time`) VALUES
(1, 1, '2022-06-17 04:48:54', '2022-06-17 04:49:03'),
(2, 1, '2022-06-17 04:50:13', '2022-06-17 04:56:43'),
(3, 2, '2022-06-17 04:56:51', '2022-06-17 05:17:43'),
(4, 1, '2022-06-17 05:17:44', '2022-06-17 05:51:55'),
(5, 1, '2022-06-26 07:22:37', '2022-06-26 07:23:11'),
(6, 1, '2022-06-26 07:23:16', '2022-06-26 07:28:26'),
(9, 5, '2022-06-26 01:47:01', '2022-06-26 01:47:19'),
(11, 5, '2022-06-26 01:47:23', '2022-06-26 01:48:14'),
(12, 1, '2022-06-26 01:48:16', '2022-06-26 01:48:27'),
(17, 1, '2022-06-26 02:46:07', '2022-06-26 07:29:18'),
(19, 1, '2022-06-26 08:08:08', '2022-06-26 08:25:25'),
(20, 1, '2022-06-26 08:26:56', '2022-06-26 08:27:00'),
(21, 1, '2022-06-26 08:29:24', '2022-06-26 08:37:32'),
(22, 1, '2022-06-26 08:37:33', '2022-06-26 08:37:59'),
(23, 1, '2022-06-26 08:38:05', '2022-06-26 08:39:02'),
(24, 2, '2022-06-26 08:39:10', '2022-06-28 04:37:21'),
(25, 1, '2022-06-28 04:37:33', '2022-06-28 05:42:10'),
(26, 1, '2022-06-28 05:42:13', '2022-06-28 05:44:28'),
(27, 1, '2022-06-28 05:44:36', '2022-06-28 05:44:53'),
(28, 2, '2022-06-28 05:45:01', '2022-06-28 05:50:44'),
(29, 1, '2022-06-28 05:50:45', '2022-06-29 08:17:32'),
(30, 1, '2022-06-29 08:17:33', '2022-06-29 08:17:39'),
(31, 1, '2022-06-29 08:17:40', '2022-06-29 08:17:54'),
(32, 1, '2022-06-29 08:17:57', '2022-06-29 09:05:44'),
(33, 1, '2022-06-29 09:05:54', '2022-06-29 09:08:21'),
(34, 2, '2022-06-29 09:08:27', '2022-06-30 12:31:38'),
(35, 1, '2022-06-30 12:32:23', '2022-06-30 12:34:48'),
(36, 1, '2022-06-30 12:35:36', '2022-06-30 04:10:42'),
(37, 1, '2022-06-30 04:17:17', '2022-06-30 04:17:23'),
(38, 1, '2022-06-30 04:17:28', '2022-06-30 04:19:23'),
(39, 1, '2022-06-30 04:19:28', '2022-06-30 04:48:17'),
(40, 1, '2022-06-30 04:48:31', '2022-06-30 04:49:34'),
(41, 2, '2022-06-30 04:49:46', '2022-06-30 04:50:43'),
(42, 1, '2022-06-30 04:50:45', '2022-06-30 04:56:54'),
(43, 1, '2022-06-30 04:56:56', '2022-06-30 04:57:29'),
(45, 1, '2022-06-30 20:28:20', '2022-06-30 20:28:48'),
(46, 1, '2022-06-30 20:28:49', '2022-06-30 20:40:04'),
(47, 1, '2022-06-30 20:40:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `u_password` varchar(50) NOT NULL,
  `u_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `u_password`, `u_type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'Gagana', '1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
