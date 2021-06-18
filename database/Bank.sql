-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2021 at 01:00 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `AccountNumber` varchar(10) NOT NULL,
  `AccountType` varchar(10) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `MiddleName` varchar(25) DEFAULT NULL,
  `LastName` varchar(25) NOT NULL,
  `MobileNumber` varchar(10) NOT NULL,
  `CurrentBalance` float NOT NULL,
  `EmailID` varchar(30) NOT NULL,
  `Address` text DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `CreatedOn` datetime NOT NULL,
  `LastActivity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `TransactionNumber` varchar(20) NOT NULL,
  `TransactionFrom` varchar(10) NOT NULL,
  `TransactionTo` varchar(10) NOT NULL,
  `TransactionAmount` float NOT NULL,
  `TransactionDate` datetime NOT NULL,
  `TransactionNote` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`AccountNumber`);

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`TransactionNumber`),
  ADD KEY `TransectionFrom` (`TransactionFrom`),
  ADD KEY `TransectionTo` (`TransactionTo`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD CONSTRAINT `TransectionFrom` FOREIGN KEY (`TransactionFrom`) REFERENCES `Customers` (`AccountNumber`),
  ADD CONSTRAINT `TransectionTo` FOREIGN KEY (`TransactionTo`) REFERENCES `Customers` (`AccountNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
