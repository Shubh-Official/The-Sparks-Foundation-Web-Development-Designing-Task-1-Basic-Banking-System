-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2021 at 02:48 PM
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

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`AccountNumber`, `AccountType`, `FirstName`, `MiddleName`, `LastName`, `MobileNumber`, `CurrentBalance`, `EmailID`, `Address`, `Notes`, `CreatedOn`, `LastActivity`) VALUES
('TSF000001', 'SA', 'Shubh', 'Amitkumar', 'Patel', '9099989065', 151000, 'shubh@gmail.com', 'Ahmedabad, Gujarat, India', '18BCE171, CSE, ITNU', '2021-06-18 16:56:10', '2021-06-18 18:13:35'),
('TSF000002', 'SA', 'Alkaben', 'Amitkumar', 'Patel', '9426873068', 100000, 'alka@gmail.com', 'Ahmedabad, Gujarat, India', 'House Wife', '2021-06-18 16:57:12', '2021-06-18 16:57:12'),
('TSF000003', 'SA', 'Amitkumar', 'Ramanbhai', 'Patel', '9687667187', 500000, 'amit@gmail.com', 'Ahmedabad, Gujarat, India', 'Overseas Manager, Arvind Envisol Ltd.', '2021-06-18 16:58:38', '2021-06-18 16:58:38'),
('TSF000004', 'SA', 'Ramanbhai', 'Manilal', 'Patel', '9428826711', 150000, 'raman@gmail.com', 'Ahmedabad, Gujarat, India', 'Retired Senior Citizen', '2021-06-18 17:00:23', '2021-06-18 17:00:23'),
('TSF000005', 'SA', 'Jash', 'Ashokkumar', 'Patel', '7016070140', 75000, 'jash@gmail.com', 'Palanpur, Gujarat, India', '18BME046, ME, ITNU', '2021-06-18 17:02:29', '2021-06-18 17:02:29'),
('TSF000006', 'SA', 'Shivansh', 'Rajeshkumar', 'Patel', '7575078980', 50000, 'shivansh@gmail.com', 'Ahmedabad, Gujarat, India', '18BCE170, CSE, ITNU', '2021-06-18 17:04:02', '2021-06-18 17:04:02'),
('TSF000007', 'CA', 'Alpeshkumar', 'Jyantibhai', 'Patel', '9898242400', 2500000, 'alpesh@gmail.com', 'Ghandhinagar, Gujarat, India', 'Main Dealer of Bajaj Autolink Private Limited in North Gujarat', '2021-06-18 17:07:01', '2021-06-18 17:07:01'),
('TSF000008', 'SA', 'Poojan', 'Vijaykumar', 'Patel', '9157899326', 60000, 'poojan@gmail.com', 'Ahmedabad, Gujarat, India', '18BCE166, CSE, ITNU', '2021-06-18 17:10:08', '2021-06-18 17:10:08'),
('TSF000009', 'SA', 'Het', 'Nileshkumar', 'Patel', '9727897902', 125000, 'het@gmail.com', 'Kalol, Ghandhinagar, Gujarat, India', '18BCE159, CSE, ITNU', '2021-06-18 17:11:29', '2021-06-18 17:11:29'),
('TSF000010', 'SA', 'Yash', 'Anilkumar', 'Patel', '9157479553', 150000, 'yash@gmail.com', 'Ahmedabad, Gujarat, India', '18BCE175, CSE, ITNU', '2021-06-18 17:14:29', '2021-06-18 17:14:29'),
('TSF000011', 'SA', 'The', 'Sparks', 'Foundation', '9876543210', 100000, 'tsf@gmail.com', 'Singapore', '-', '2021-06-18 18:12:07', '2021-06-18 18:14:24');

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
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`TransactionNumber`, `TransactionFrom`, `TransactionTo`, `TransactionAmount`, `TransactionDate`, `TransactionNote`) VALUES
('TSF00000000000000001', 'TSF000001', 'TSF000011', 100000, '2021-06-18 18:13:35', ''),
('TSF00000000000000002', 'TSF000011', 'TSF000001', 1000, '2021-06-18 18:14:24', ''),
('TSF000001', 'TSF000001', 'TSF000001', 250000, '2021-06-18 16:56:10', 'Opening Account Balance'),
('TSF000002', 'TSF000002', 'TSF000002', 100000, '2021-06-18 16:57:12', 'Opening Account Balance'),
('TSF000003', 'TSF000003', 'TSF000003', 500000, '2021-06-18 16:58:38', 'Opening Account Balance'),
('TSF000004', 'TSF000004', 'TSF000004', 150000, '2021-06-18 17:00:23', 'Opening Account Balance'),
('TSF000005', 'TSF000005', 'TSF000005', 75000, '2021-06-18 17:02:29', 'Opening Account Balance'),
('TSF000006', 'TSF000006', 'TSF000006', 50000, '2021-06-18 17:04:02', 'Opening Account Balance'),
('TSF000007', 'TSF000007', 'TSF000007', 2500000, '2021-06-18 17:07:01', 'Opening Account Balance'),
('TSF000008', 'TSF000008', 'TSF000008', 60000, '2021-06-18 17:10:08', 'Opening Account Balance'),
('TSF000009', 'TSF000009', 'TSF000009', 125000, '2021-06-18 17:11:29', 'Opening Account Balance'),
('TSF000010', 'TSF000010', 'TSF000010', 150000, '2021-06-18 17:14:29', 'Opening Account Balance'),
('TSF000011', 'TSF000011', 'TSF000011', 1000, '2021-06-18 18:12:07', 'Opening Account Balance');

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
