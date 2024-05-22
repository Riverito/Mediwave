-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 08:31 PM
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
-- Database: `mediwave`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `idItem` varchar(10) NOT NULL,
  `nameItem` varchar(255) NOT NULL,
  `descriptionItem` text DEFAULT NULL,
  `countItem` int(11) NOT NULL DEFAULT 0,
  `last_incoming` datetime DEFAULT NULL,
  `last_outgoing` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_adjustments`
--

CREATE TABLE `inventory_adjustments` (
  `adjustmentId` varchar(10) DEFAULT NULL,
  `itemId` varchar(10) DEFAULT NULL,
  `adjustmentAmount` int(11) DEFAULT NULL,
  `adjustmentReason` varchar(255) DEFAULT NULL,
  `adjustmentDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `userId` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrador'),
(2, 'Doctor'),
(3, 'Enfermero');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsuario` varchar(10) NOT NULL,
  `usersName` varchar(50) DEFAULT NULL,
  `usersPwd` varchar(255) DEFAULT NULL,
  `userApellido` varchar(50) DEFAULT NULL,
  `userCd` varchar(20) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userRol` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsuario`, `usersName`, `usersPwd`, `userApellido`, `userCd`, `userEmail`, `userRol`) VALUES
('cwCmzz', 'Greyvin', '$2y$10$KeLefu09taaRmyWQewBLSOQwKPsLebCdJ7ctOq1TehFa1eSXzrbje', 'dd', '28046954', 'greyvinp2az@gmail.com', 3),
('j6jDRz', 'Samuel', '$2y$10$NaAqp1E53/SSOChlwcyaTe4uevPHKDu4wBkTa4nDvwZ8RnZrWsx1K', 'Romano', '25444444', 'greyvinpaz@gmail.comm', 2),
('MeTVTh', 'Romano', '$2y$10$k9rmYZHBAxYuLKJbZSwp4.oT4zrCX2CMPo72fN6p/QxsPhswd2tsq', 'Rivero', '12312312', 'greyvinpaz@gmail.com', 3),
('WrGS41', 'Joven', '$2y$10$zd3P24ZzVCwl/vlWOzZ7IuZ2F8alUCbydnnPVtMXlAdHG7pgaieou', 'Jose', '24789456', 'greyvin@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`idItem`);

--
-- Indexes for table `inventory_adjustments`
--
ALTER TABLE `inventory_adjustments`
  ADD KEY `itemId` (`itemId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userCd` (`userCd`),
  ADD KEY `userRol` (`userRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_adjustments`
--
ALTER TABLE `inventory_adjustments`
  ADD CONSTRAINT `inventory_adjustments_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `inventory` (`idItem`),
  ADD CONSTRAINT `inventory_adjustments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`idUsuario`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userRol`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
