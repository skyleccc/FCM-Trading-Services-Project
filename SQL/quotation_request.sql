-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2024 at 02:49 PM
-- Server version: 10.11.6-MariaDB-0+deb12u1
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fcm_trading_services`
--

-- --------------------------------------------------------

--
-- Table structure for table `quotation_request`
--

CREATE TABLE `quotation_request` (
  `requestID` int(11) NOT NULL,
  `clientName` varchar(60) NOT NULL,
  `location` varchar(255) NOT NULL,
  `siteInformation` varchar(500) NOT NULL,
  `serviceType` enum('Construction','Renovation') NOT NULL,
  `startDate` date NOT NULL,
  `completeDate` date NOT NULL,
  `projectDetails` varchar(500) NOT NULL,
  `workArea` varchar(12) NOT NULL,
  `budgetConstraint` decimal(11,2) NOT NULL,
  `specialRequests` varchar(500) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `withBlueprint` tinyint(1) NOT NULL,
  `numberOfFiles` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_request`
--

INSERT INTO `quotation_request` (`requestID`, `clientName`, `location`, `siteInformation`, `serviceType`, `startDate`, `completeDate`, `projectDetails`, `workArea`, `budgetConstraint`, `specialRequests`, `contact`, `withBlueprint`, `numberOfFiles`) VALUES
(1, 's', 's', 's', 'Construction', '2024-06-02', '2024-06-21', 's', '15', 15151.00, 's', 's', 0, 0),
(2, 'Jollibee', 'Mango', 'Intersection', 'Renovation', '2024-06-26', '2024-07-04', 'Pls Fix', '10', 15151.00, 'Help', 'maximusgamer@gmail.com', 1, 0),
(3, 'try', 'try', 'try', 'Construction', '2024-06-26', '2024-06-30', 'try', '1', 15151.00, 'try', 'try', 0, 0),
(4, 'try', 'try', 'trytry', 'Renovation', '2024-06-19', '2024-06-30', 'try', '1', 515.00, 'try', 'try', 0, NULL),
(5, 'try', 'try', 'try', 'Construction', '2024-06-26', '2024-06-30', 'try', '1', 1515.00, 'try', 'try', 1, 0),
(6, 'try', 'try', 'try', 'Construction', '2024-06-18', '2024-07-05', 'try', '1', 1.00, 'try', 'try', 1, NULL),
(7, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-30', 'try', '1', 1.00, 'try', 'try', 1, NULL),
(8, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-27', 'try', '1', 1.00, 'try', 'try', 1, NULL),
(9, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-27', 'try', '1', 1.00, 'try', 'try', 1, NULL),
(10, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-27', 'try', '1', 1.00, 'try', 'try', 1, 3),
(11, 'try', 'try', 'try', 'Construction', '2024-06-26', '2024-06-30', 'try', '1', 1.00, 'try', 'try', 1, 3),
(12, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-30', 'try', '1', 515.00, 'try', 'try', 1, 1),
(13, 'try', 'try', 'try', 'Renovation', '2024-06-19', '2024-06-26', 'try', '1', 1.00, 'try', 'try', 1, 2),
(14, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-26', 'try', '1', 1.00, 'try', 'try', 1, 2),
(15, 'try', 'try', 'try', 'Construction', '2024-06-18', '2024-06-23', 'try', '1', 1.00, '1', 'try', 1, 2),
(16, 'try', 'try', 'try', 'Construction', '2024-05-28', '2024-06-29', 'try', '1', 1.00, 'try', 'try', 1, 1),
(17, 'try', 'try', 'try', 'Construction', '2024-06-18', '2024-06-27', 'try', '1', 1.00, 'try', 'try', 1, 3),
(18, 'try', 'try', 'try', 'Construction', '2024-06-19', '2024-06-26', 'try', '51', 1.00, 'try', 'try', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quotation_request`
--
ALTER TABLE `quotation_request`
  ADD PRIMARY KEY (`requestID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quotation_request`
--
ALTER TABLE `quotation_request`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
