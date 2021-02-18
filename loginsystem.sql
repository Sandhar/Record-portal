-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 03:30 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `calibration`
--

CREATE TABLE `calibration` (
  `datereceived` date DEFAULT NULL,
  `datecompleted` date DEFAULT NULL,
  `nextdue` date DEFAULT NULL,
  `cert` varchar(255) NOT NULL,
  `timestmp` timestamp NOT NULL DEFAULT current_timestamp(),
  `toolid` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calibration`
--

INSERT INTO `calibration` (`datereceived`, `datecompleted`, `nextdue`, `cert`, `timestmp`, `toolid`, `cid`) VALUES
('2021-02-09', '2021-02-10', '2021-02-18', 'upload/78357sample_certificate.png', '2021-02-08 05:35:49', 55, 12),
('2021-02-14', '2021-02-19', '2021-02-14', 'upload/435037sample_certificate.png', '2021-02-08 05:36:43', 52, 13),
('2021-02-13', '2021-02-06', '2021-02-10', 'upload/480256sample_certificate.png', '2021-02-08 07:05:59', 44, 14),
('2021-02-13', '2021-02-06', '2021-02-10', 'upload/272435sample_certificate.png', '2021-02-08 07:06:35', 44, 15),
('2021-02-13', '2021-02-06', '2021-02-10', 'upload/552457sample_certificate.png', '2021-02-08 07:06:55', 44, 16),
('2021-02-13', '2021-02-06', '2021-02-19', 'upload/945253sample_certificate.png', '2021-02-08 13:00:37', 70, 17),
('2021-02-13', '2021-02-14', '2021-02-06', 'upload/659762sample_certificate.png', '2021-02-08 13:09:27', 70, 18);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `datereceived` date DEFAULT NULL,
  `datecompleted` date DEFAULT NULL,
  `issue` longtext DEFAULT NULL,
  `fault` longtext DEFAULT NULL,
  `resolution` longtext DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `jobnumber` varchar(50) DEFAULT NULL,
  `cert` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `toolid` int(11) DEFAULT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`datereceived`, `datecompleted`, `issue`, `fault`, `resolution`, `timestamp`, `jobnumber`, `cert`, `img`, `toolid`, `sid`) VALUES
('2021-02-07', '2021-02-13', 'update 2', '2314', 'asd', '2021-02-06 02:29:08', '1234', 'upload/640076sample_report.pdf', 'download.jpg,unnamed.jpg,sample_picture.png', 44, 6),
('2021-02-05', '2021-02-12', 'one', 'two', 'fixed', '2021-02-08 07:08:38', '23412', 'upload/sample_report.pdf543645', 'sample_certificate.png,unnamed.jpg', 44, 9),
('2021-02-13', '2021-02-13', 'asd', 'wrq', 'qwe', '2021-02-08 07:34:37', '23412', 'upload/sample_report.pdf595549', 'unnamed.jpg,unnamed.jpg', 55, 10),
('2021-02-04', '2021-02-10', 'asd', 'wqeq', 'eq', '2021-02-08 14:11:22', '123', 'upload/sample_certificate.png506510', 'download.jpg,sample_picture.png', 52, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int(11) NOT NULL,
  `partnumber` varchar(50) NOT NULL,
  `serialnumber` varchar(50) NOT NULL,
  `assestnumber` varchar(50) DEFAULT NULL,
  `caldate` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `timestmp` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer` varchar(255) DEFAULT NULL,
  `usernote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `partnumber`, `serialnumber`, `assestnumber`, `caldate`, `description`, `timestmp`, `customer`, `usernote`) VALUES
(44, '123', '456', '890', '2021-02-13', 'Ken1', '2021-02-04 05:28:34', 'KENWORTH', 'note 1'),
(52, '12QD', '123ASD', '1231', '2021-02-13', 'Ken 2', '2021-02-08 02:07:36', 'KENWORTH', 'note 2'),
(53, '12AS', '123AD', '123ASD', '2021-02-12', 'Stan1', '2021-02-08 02:09:06', 'STANLEY', 'note 2'),
(55, '124', '12WEW', 'ASD23', '2021-02-07', 'STAN2', '2021-02-08 05:35:00', 'STANLEY', 'note 2'),
(56, '123as', '45sd', '12as', '2021-02-19', 'Tool 3', '2021-02-08 06:50:17', 'KENWORTH', 'note 3'),
(63, '12asd', '213asd', '123asd', '2021-02-11', 'Stan', '2021-02-08 06:55:46', 'STANLEY', 'note 3'),
(70, '123', '12341234', '789qwe', '2021-02-12', '1234', '2021-02-08 12:57:36', 'STANLEY', 'note 5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_datetime`, `type`) VALUES
(1, 'Inderpal', 'Test.one@gmail.com', '68eacb97d86f0c4621fa2b0e17cabd8c', '2021-01-25 02:09:33', 'ADMIN'),
(52, 'User1', 'User1@kenworth.com', 'af974cf3ae8a5bf92832a864766f5b6c', '2021-02-08 01:17:13', 'KENWORTH'),
(53, 'user2', 'User2@stanley.com', 'f3afd3908d92a20404d278460cce3e55', '2021-02-08 01:20:09', 'STANLEY'),
(55, 'dump', 'stan@gmail.com', '94f3b3a16d8ce064c808b16bee5003c5', '2021-02-08 07:07:55', 'STANLEY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calibration`
--
ALTER TABLE `calibration`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
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
-- AUTO_INCREMENT for table `calibration`
--
ALTER TABLE `calibration`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
