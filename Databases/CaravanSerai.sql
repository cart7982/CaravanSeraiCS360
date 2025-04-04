-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 01:30 AM
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
-- Database: `caravanserai`
--

-- --------------------------------------------------------

--
-- Table structure for table `aaa`
--

CREATE TABLE `aaa` (
  `UserID` int(6) UNSIGNED NOT NULL,
  `Username` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aaa`
--

INSERT INTO `aaa` (`UserID`, `Username`, `FirstName`, `LastName`, `Email`, `reg_date`) VALUES
(1, 'aa', '', '', NULL, '2025-03-17 10:52:35'),
(4, 'dd', '', '', NULL, '2025-03-17 13:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `bbb`
--

CREATE TABLE `bbb` (
  `UserID` int(6) UNSIGNED NOT NULL,
  `Username` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bbb`
--

INSERT INTO `bbb` (`UserID`, `Username`, `FirstName`, `LastName`, `Email`, `reg_date`) VALUES
(2, 'bb', '', '', NULL, '2025-03-24 21:42:17'),
(5, 'ee', '', '', NULL, '2025-03-24 21:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` int(11) NOT NULL,
  `GroupName` text NOT NULL,
  `Documents` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`, `Documents`, `Password`, `Email`) VALUES
(1, 'aaa', '', 'aaa', 'aaa@aaa'),
(2, 'bbb', '', 'bbb', 'bbb@bbb');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `UserID1` int(11) NOT NULL,
  `UserID2` int(11) NOT NULL,
  `BarterMessage` varchar(350) NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `Amount1` int(11) NOT NULL,
  `MessageID` int(11) NOT NULL,
  `Amount2` int(11) NOT NULL,
  `ProductName1` text NOT NULL,
  `ProductName2` text NOT NULL,
  `MessageUserID` int(11) NOT NULL,
  `Product1UserID` int(11) NOT NULL,
  `Product2UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductName` text NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductName`, `ProductID`, `UserID`, `Amount`, `Description`) VALUES
('Spices', 13, 2, 76, 'Tasty'),
('Wine', 14, 2, 67, 'Boozy'),
('Jewelry', 15, 2, 10, 'Shiny'),
('Sheep', 16, 3, 47, 'Woolly'),
('Cows', 17, 3, 37, 'Beefy'),
('Pigs', 18, 3, 27, 'Porky'),
('Chickens', 19, 3, 120, 'Feathery'),
('Copper Ingots', 20, 1, 205, 'Great quality'),
('Iron Ingots', 21, 1, 98, 'Very hard'),
('Tin Ingots', 22, 1, 250, 'For your casting needs!'),
('Bronze Ingots', 23, 1, 81, 'Pretty hard too!'),
('Uncut topaz', 24, 4, 4, 'Green'),
('Steel Ingots', 26, 1, 155, 'Extra durable'),
('(Better) Iron Ingots', 28, 4, 10, 'Heavier, stronger, faster, better iron ingots'),
('Silk', 29, 5, 470, 'Silky'),
('Burlap', 31, 5, 225, 'Tough'),
('Uncut carnelian', 33, 4, 190, 'Red'),
('Uncut carnelian', 34, 5, 235, ''),
('Cotton', 35, 4, 340, ''),
('Cotton', 36, 5, 288, 'Fluffy'),
('Wine', 37, 4, 25, ''),
('Uncut carnelian', 38, 2, 25, ''),
('Stolen Ipods', 39, 6, 200, 'They work!'),
('Stolen Iphones', 40, 6, 150, 'They work!'),
('Stolen Laptops', 41, 6, 100, 'Functional!'),
('Uncut topaz', 42, 2, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `ProductID1` int(11) NOT NULL,
  `ProductID2` int(11) NOT NULL,
  `Quantity1` int(11) NOT NULL,
  `Quantity2` int(11) NOT NULL,
  `UserID1` int(11) NOT NULL,
  `UserID2` int(11) NOT NULL,
  `ProductName1` text NOT NULL,
  `ProductName2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `ProductID1`, `ProductID2`, `Quantity1`, `Quantity2`, `UserID1`, `UserID2`, `ProductName1`, `ProductName2`) VALUES
(1, 24, 14, 12, 10, 4, 2, 'Uncut topaz', 'Wine');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `UserID`) VALUES
('aa', 'aa@aa', 'aa', 1),
('bb', 'bb@bb', 'bb', 2),
('cc', 'cc@cc', 'cc', 3),
('dd', 'dd@dd', 'dd', 4),
('ee', 'ee@ee', 'ee', 5),
('ff', 'ff@ff', 'ff', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aaa`
--
ALTER TABLE `aaa`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `bbb`
--
ALTER TABLE `bbb`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aaa`
--
ALTER TABLE `aaa`
  MODIFY `UserID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bbb`
--
ALTER TABLE `bbb`
  MODIFY `UserID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
