-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 06:11 PM
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
('Spices', 13, '2', 76, 'Tasty', ''),
('Wine', 14, '2', 67, 'Boozy', ''),
('Jewelry', 15, '2', 10, 'Shiny', ''),
('Sheep', 16, '3', 47, 'Woolly', ''),
('Cows', 17, '3', 37, 'Beefy', ''),
('Pigs', 18, '3', 27, 'Porky', ''),
('Chickens', 19, '3', 120, 'Feathery', ''),
('Copper Ingots', 20, '1', 205, 'Great quality', ''),
('Iron Ingots', 21, '1', 98, 'Very hard', ''),
('Tin Ingots', 22, '1', 250, 'For your casting needs!', ''),
('Bronze Ingots', 23, '1', 81, 'Pretty hard too!', ''),
('Uncut topaz', 24, '4', 4, 'Green', ''),
('Steel Ingots', 26, '1', 155, 'Extra durable', ''),
('(Better) Iron Ingots', 28, '4', 10, 'Heavier, stronger, faster, better iron ingots', ''),
('Silk', 29, '5', 470, 'Silky', ''),
('Burlap', 31, '5', 225, 'Tough', ''),
('Uncut carnelian', 33, '4', 190, 'Red', ''),
('Uncut carnelian', 34, '5', 235, '', ''),
('Cotton', 35, '4', 340, '', ''),
('Cotton', 36, '5', 288, 'Fluffy', ''),
('Wine', 37, '4', 25, '', ''),
('Uncut carnelian', 38, '2', 25, '', ''),
('Stolen Ipods', 39, '6', 200, 'They work!', ''),
('Stolen Iphones', 40, '6', 150, 'They work!', ''),
('Stolen Laptops', 41, '6', 100, 'Functional!', ''),
('Uncut topaz', 42, '2', 12, '', ''),
('Quail eggs', 43, '4C198BB6-4DE2-46E5-AE77-C7FB5FCA2DBB', 50, 'Small', '');

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
(1, 24, 14, 12, 10, '4', '2', 'Uncut topaz', 'Wine');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `UserID` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `UserID`, `isAdmin`) VALUES
('aa', 'aa@aa', 'aa', '1', 0),
('bb', 'bb@bb', 'bb', '2', 0),
('cc', 'cc@cc', 'cc', '3', 0),
('dd', 'dd@dd', 'dd', '4', 0),
('ee', 'ee@ee', 'ee', '5', 0),
('ff', 'ff@ff', 'ff', '6', 0),
('ww', 'ww@ww', '$2y$12$GyTddHq1ZL9EU4ABfFhCs.YA4bQIvQVLAfWFo0y0DqiKrAlNnah5S', '0', 0),
('xx', 'xx@xx', '$2y$12$.q..UZDTC0edL6zDXHG88uiElZb8c63.nCIKSp8WtVS3XlSaGr3ny', '3', 0),
('mm', 'mm@mm', '$2y$12$u1EPF6874HXOsYUR5aVzE.DukOzWwfZsoU4hvRdYE6mH/p3DzNUle', '4C198BB6-4DE2-46E5-AE77-C7FB5FCA2DBB', 0),
('qq', 'qq@qq', '$2y$12$.u044wYk8hLPnHwvKmAO.uN0FFfTkIcE9ahRS5l4UIyAJ28r2EOaq', 'F59BE4DC-AFC2-401E-BF36-5CCF62BC40D6', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
