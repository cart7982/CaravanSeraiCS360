-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 11:55 PM
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
('C8033AED-DDA5-4E62-9859-EF9F2663FC8D', 'mmm', '', '$2y$12$3WSg3vzl3eBViJAjo8HGLOrcRCKuBbNBY5RxXZCkEd65c4R8phhVG', 'mmm@mm'),
('B41EB4D3-DB15-46A4-9651-DC3A65F04348', 'bbb', '', '$2y$12$/0IEmJYP8nq6xd5FHbil1uQnTPAYDAR0ASG50sX1L4ySerFH0S6re', 'bbb@bb');

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
  `MessageUserID` int(11) NOT NULL,
  `Product1UserID` int(11) NOT NULL,
  `Product2UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`UserID1`, `UserID2`, `BarterMessage`, `TransactionID`, `Amount1`, `MessageID`, `Amount2`, `ProductName1`, `ProductName2`, `MessageUserID`, `Product1UserID`, `Product2UserID`) VALUES
('D30F5AB0-551C-4125-A796-B285BED7742A', '0', 'Dearrer', 2, 75, 1, 50, 'Leather Scraps', 'Steel Ingots', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mmm`
--

CREATE TABLE `mmm` (
  `UserID` varchar(255) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mmm`
--

INSERT INTO `mmm` (`UserID`, `Username`, `FirstName`, `LastName`, `Email`, `reg_date`) VALUES
('4C198BB6-4DE2-46E5-AE77-C7FB5FCA2DBB', 'mm', '', '', NULL, '2025-04-04 16:48:28');

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
('Steel Ingots', 1, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 5, 'Heavier, stronger, faster, better iron ingots', ''),
('Leather Scraps', 2, 'D30F5AB0-551C-4125-A796-B285BED7742A', 400, 'Whatever', '');

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
  `ProductName2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `ProductID1`, `ProductID2`, `Quantity1`, `Quantity2`, `UserID1`, `UserID2`, `ProductName1`, `ProductName2`) VALUES
(2, 1, 2, 24, 70, '64E721A3-70DF-40C7-97AE-0AB1DC04048F', 'D30F5AB0-551C-4125-A796-B285BED7742A', 'Steel Ingots', 'Leather Scraps');

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
('qq', 'qq@qq', '$2y$12$.u044wYk8hLPnHwvKmAO.uN0FFfTkIcE9ahRS5l4UIyAJ28r2EOaq', 'F59BE4DC-AFC2-401E-BF36-5CCF62BC40D6', '0'),
('aa', 'aa@aa', '$2y$12$3Kg7SkApC8SX2fpGDDZNQ.d5ZgYWpo7SBUXIUaf2r9O4q1GaA10Ti', '64E721A3-70DF-40C7-97AE-0AB1DC04048F', '0'),
('bb', 'bb@bb', '$2y$12$W9t.vnqyUrjLX589qYDFJOdPH.6aYdZcbrnYsjPtGYzfgss3TtXqC', 'D30F5AB0-551C-4125-A796-B285BED7742A', '0'),
('cc', 'cc@cc', '$2y$12$h/GTzCMoRIjC31CwCJVjvu.hlf5iAIYPLms4iaYx/8HKzj8iYmzJG', '7394C80B-91BF-476A-B5F1-B9433F11068F', '0'),
('dd', 'dd@dd', '$2y$12$Qd/FEIW7tzecPTWnCZzjI.E9/83vUWHhCK.AvNlILySwjIM03DAVK', '91FD0C36-27A2-4A71-A681-379378EA9485', '0'),
('ee', 'ee@ee', '$2y$12$0pD0D.AFfDyqXRBqoqcgguD6vgvPmWOlZVcUWoqyRqERUpTh1kmcu', '96CA0EDB-140A-4CE7-9E4D-84A28BC9C3BE', '0'),
('ff', 'ff@ff', '$2y$12$0.DnFrN5uoPPJvBcyItc1epi5L/R.3fkKfbdAjU6QeW6EIot17GCe', 'A993E293-153C-421F-BFEA-E8F4176A2558', '0'),
('gg', 'gg@gg', '$2y$12$c8mnAz2PrEvh4TftxGk6GOvMXdaT27b.Fz3FsaeE.YCUUdNT4Jf6.', 'EB2787A7-A30F-4426-A7E4-101A4DAC7E50', '0'),
('hh', 'hh@hh', '$2y$12$7xGOxUkAXZT8lXME34aeEuwpJz4VskRSEgTr9F2pSG0wpEbxRX026', '2D9AD0D3-2C05-45F9-A4F8-97A6B8F3CFB5', '0'),
('ii', 'ii@ii', '$2y$12$aTZGLQKiiF5Jf5JeO9qNHupZKMBIFyRDyDbaezyc.lvREfmSPzU9C', 'F3901C63-2954-4E9A-A853-17C22D811448', '0'),
('jj', 'jj@jj', '$2y$12$knwvSBh/iab3lrliwMQePuPVcpU.S/8WN61s2kvmdwUWzwojutmeK', '929E09AF-DEF6-44C9-A5B2-5978D0700633', '0'),
('kk', 'kk@kk', '$2y$12$0w5mog9O7IzMJGKAoGR8xOsblMelSeoxICjLfuHNGWUQD3bqbnoVu', '1258590D-3C53-4E4F-BD52-8156E291A5AF', '0'),
('ll', 'll@ll', '$2y$12$fnOsDKY9kvndV70Rar1hiOi.3g5BnOw4cWH3hHQPBVLVPIOCn/DQa', '81E10699-CE5A-4765-93AD-B05CF6323212', '9'),
('nn', 'nn@nn', '$2y$12$ix9xyh5z6Yu4/XVKTl.Jfectzli8es5d8HSt2kDQKycUabNGDuGAO', 'D034EB65-8828-46E5-A9ED-5C36C71DDB4D', '407'),
('oo', 'oo@oo', '$2y$12$enpKnFjMXnJDSmtwAKePl.tSsNeetwhVpoCL96hLO93vvEOnTdhmq', '25469C28-CD38-4F82-B8D7-837ED7DAC304', 'E2A4B479-8630-4154-ADCB-29F4D512F603');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bbb`
--
ALTER TABLE `bbb`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `mmm`
--
ALTER TABLE `mmm`
  ADD PRIMARY KEY (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
