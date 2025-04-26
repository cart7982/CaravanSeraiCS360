-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 03:12 AM
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
  `UserID` varchar(255) NOT NULL,
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
('64E721A3-70DF-40C7-97AE-0AB1DC04048F', 'aa', '', '', NULL, '2025-04-17 13:32:10'),
('7394C80B-91BF-476A-B5F1-B9433F11068F', 'cc', '', '', NULL, '2025-04-17 13:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `bbb`
--

CREATE TABLE `bbb` (
  `UserID` varchar(255) NOT NULL,
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
('91FD0C36-27A2-4A71-A681-379378EA9485', 'dd', '', '', NULL, '2025-04-17 13:33:45'),
('D30F5AB0-551C-4125-A796-B285BED7742A', 'bb', '', '', NULL, '2025-04-07 20:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` varchar(255) NOT NULL,
  `GroupName` text NOT NULL,
  `Documents` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`, `Documents`, `Password`, `Email`) VALUES
('B41EB4D3-DB15-46A4-9651-DC3A65F04348', 'bbb', '', '$2y$12$/0IEmJYP8nq6xd5FHbil1uQnTPAYDAR0ASG50sX1L4ySerFH0S6re', 'bbb@bb'),
('38FEFCE9-7909-4DFB-AB4E-0A74C3552A22', 'aaa', '', '$2y$12$8Eqj18EKkc8hYPYZOGlQgOvzgHGHsu/FGVESWAc3T564xoT/g5aUS', 'aaa@aa');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `UserID1` varchar(255) NOT NULL,
  `UserID2` varchar(255) NOT NULL,
  `BarterMessage` varchar(350) NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `Amount1` int(11) NOT NULL,
  `MessageID` int(11) NOT NULL,
  `Amount2` int(11) NOT NULL,
  `ProductName1` text NOT NULL,
  `ProductName2` text NOT NULL,
  `MessageUserID` varchar(255) NOT NULL,
  `Product1UserID` varchar(255) NOT NULL,
  `Product2UserID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductName` text NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UserID` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL,
  `ImagePath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductName`, `ProductID`, `UserID`, `Amount`, `Description`, `ImagePath`) VALUES
('Sheep', 19, '7394C80B-91BF-476A-B5F1-B9433F11068F', 411, 'Woolly', 'SheepPicture.png'),
('Iron Ingots', 20, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 455, 'Tough', 'IronIngots.png'),
('Bronze Ingots', 21, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 222, 'Pretty tough', 'BronzeIngots.png'),
('Copper Ingots', 22, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 678, 'Sturdy', 'CopperIngots.png'),
('Spices', 23, 'D30F5AB0-551C-4125-A796-B285BED7742A', 13, 'Tasty', 'Spices.png'),
('Jewelry', 25, 'D30F5AB0-551C-4125-A796-B285BED7742A', 65, 'Shiny', 'Jewelry.png'),
('Cows', 26, '7394C80B-91BF-476A-B5F1-B9433F11068F', 678, 'Beefy', 'Cows.png'),
('Chickens', 27, '7394C80B-91BF-476A-B5F1-B9433F11068F', 2133, 'Feathery', 'Chickens.png'),
('Uncut Carnelians', 28, '91FD0C36-27A2-4A71-A681-379378EA9485', 456, 'Red', 'logo_1.jpg'),
('Uncut topaz', 29, '91FD0C36-27A2-4A71-A681-379378EA9485', 432, 'Yellow', 'UncutTopaz.png'),
('Sheep', 31, '91FD0C36-27A2-4A71-A681-379378EA9485', 45, 'Woolly', 'SheepPicture.png'),
('Uncut fluorite', 32, '91FD0C36-27A2-4A71-A681-379378EA9485', 456, 'Green', 'UncutFluorite.png'),
('Chickens', 35, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 210, 'Feathery yet tasty', 'Chickens.png');

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
  `UserID1` varchar(255) NOT NULL,
  `UserID2` varchar(255) NOT NULL,
  `ProductName1` text NOT NULL,
  `ProductName2` text NOT NULL,
  `Completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `ProductID1`, `ProductID2`, `Quantity1`, `Quantity2`, `UserID1`, `UserID2`, `ProductName1`, `ProductName2`, `Completed`) VALUES
(1, 10, 7, 66, 50, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '91FD0C36-27A2-4A71-A681-379378EA9485', 'Bronze Ingots', 'Uncut topaz', 1),
(2, 19, 28, 45, 56, '7394C80B-91BF-476A-B5F1-B9433F11068F', '91FD0C36-27A2-4A71-A681-379378EA9485', 'Sheep', 'Uncut carnelian', 1),
(4, 20, 0, 55, 0, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '', 'Iron Ingots', '', 0),
(5, 21, 24, 45, 80, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 'D30F5AB0-551C-4125-A796-B285BED7742A', 'Bronze Ingots', 'Wine', 1),
(6, 21, 27, 78, 210, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '7394C80B-91BF-476A-B5F1-B9433F11068F', 'Bronze Ingots', 'Chickens', 1),
(7, 21, 0, 22, 0, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '7394C80B-91BF-476A-B5F1-B9433F11068F', 'Bronze Ingots', '', 0),
(8, 22, 0, 78, 0, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '7394C80B-91BF-476A-B5F1-B9433F11068F', 'Copper Ingots', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `UserID` varchar(255) NOT NULL,
  `AdminID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `UserID`, `AdminID`) VALUES
('aa', 'aa@aa', '$2y$12$3Kg7SkApC8SX2fpGDDZNQ.d5ZgYWpo7SBUXIUaf2r9O4q1GaA10Ti', '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '0'),
('bb', 'bb@bb', '$2y$12$W9t.vnqyUrjLX589qYDFJOdPH.6aYdZcbrnYsjPtGYzfgss3TtXqC', 'D30F5AB0-551C-4125-A796-B285BED7742A', '0'),
('cc', 'cc@cc', '$2y$12$h/GTzCMoRIjC31CwCJVjvu.hlf5iAIYPLms4iaYx/8HKzj8iYmzJG', '7394C80B-91BF-476A-B5F1-B9433F11068F', '0'),
('dd', 'dd@dd', '$2y$12$Qd/FEIW7tzecPTWnCZzjI.E9/83vUWHhCK.AvNlILySwjIM03DAVK', '91FD0C36-27A2-4A71-A681-379378EA9485', '0'),
('ee', 'ee@ee', '$2y$12$0pD0D.AFfDyqXRBqoqcgguD6vgvPmWOlZVcUWoqyRqERUpTh1kmcu', '96CA0EDB-140A-4CE7-9E4D-84A28BC9C3BE', '0'),
('kk', 'kk@kk', '$2y$12$0w5mog9O7IzMJGKAoGR8xOsblMelSeoxICjLfuHNGWUQD3bqbnoVu', '1258590D-3C53-4E4F-BD52-8156E291A5AF', '0'),
('mm', 'mm@mm', '$2y$12$u1gZCK.TNPqtNgGUAapoUeSPopKnGiphewUrzk/X0tP1FU5GBEKA6', '90284C1B-D616-436F-B09D-AA5DE32D35C4', '3CE50B35-7ACB-456A-A7DF-652B039D466F');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
