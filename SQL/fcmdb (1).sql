-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 04:29 PM
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
-- Database: `fcmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userID` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dateCreated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userID`, `username`, `password`, `dateCreated`) VALUES
(1, 'jantonio', '123456', '2024-06-26'),
(2, 'cjakosalem', '126', '2024-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `buildingID` int(11) NOT NULL,
  `buildingaddress` varchar(255) DEFAULT NULL,
  `workArea` int(8) DEFAULT NULL,
  `blueprint` varchar(100) DEFAULT NULL,
  `numFilesAttached` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingID`, `buildingaddress`, `workArea`, `blueprint`, `numFilesAttached`) VALUES
(3, 'tipolo', 200, '', NULL),
(4, 'Cambaro, Mandaue City, Cebu', 100, '', NULL),
(5, '312', 321321, '', NULL),
(6, '321312', 3213, '', NULL),
(7, 'test', NULL, NULL, NULL),
(8, '1321321', 3213213, '', NULL),
(9, '4213', 321, '', NULL),
(10, '32132', 213213, '', NULL),
(11, 'dwjndknwaknd', 3213213, '', NULL),
(12, '3213', 213123, '', NULL),
(13, '3213213', 213213, '', NULL),
(14, '21321321', 31321, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientID` int(11) NOT NULL,
  `clientName` varchar(60) DEFAULT NULL,
  `clientContact` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `clientName`, `clientContact`) VALUES
(4, 'francisraleabrenica', '09275880544'),
(5, 'Louisa Camacho', '09271435700'),
(6, '3213123', '312321'),
(7, 'test', '312313'),
(8, NULL, NULL),
(9, 'Louisa', '3213213'),
(10, 'tes123', '321'),
(11, '321jcnsa', '321321'),
(12, 'deathnote', 'dkjawndkja'),
(13, 'raleleaf', '21e13213'),
(14, 'post malone', 'kj321knkcsa'),
(15, 'Louisah', '3213213'),
(16, 'deathnotewow', 'dkjawndkja'),
(17, 'LouisaXRALE', '3213213'),
(18, 'Jollibee Carcar', '3213213'),
(19, 'Mendero Medical Center', 'dkjawndkja'),
(20, 'testtest', '21e13213'),
(21, 'Alec Jakosalem', '321321321');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `costID` int(11) NOT NULL,
  `costCategory` varchar(60) NOT NULL,
  `costItemDesc` varchar(500) NOT NULL,
  `costItemPrice` int(11) NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phase`
--

CREATE TABLE `phase` (
  `phaseID` int(11) NOT NULL,
  `phaseTitle` varchar(60) NOT NULL,
  `phaseDescription` varchar(500) NOT NULL,
  `expectedFinishDate` date NOT NULL,
  `actualFinishDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phase`
--

INSERT INTO `phase` (`phaseID`, `phaseTitle`, `phaseDescription`, `expectedFinishDate`, `actualFinishDate`) VALUES
(1, 'Roof Repair', 'repairing of the roof', '2024-07-09', '2024-07-24'),
(5, 'Preparing of Materials', 'Prepare roof, equipments, etc.', '0213-02-13', '0031-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `buildingID` int(11) NOT NULL,
  `quotationID` int(11) NOT NULL DEFAULT 0,
  `projectName` varchar(100) NOT NULL,
  `projectType` varchar(30) NOT NULL DEFAULT '0',
  `projectDetails` varchar(500) NOT NULL,
  `startDate` date DEFAULT current_timestamp(),
  `deadlineDate` date DEFAULT current_timestamp(),
  `budgetConstraint` int(11) NOT NULL DEFAULT 0,
  `specialRequests` varchar(500) DEFAULT NULL,
  `dateFiled` int(11) DEFAULT 0,
  `isComplete` tinyint(1) NOT NULL DEFAULT 0,
  `completionDate` date DEFAULT current_timestamp(),
  `progressRate` int(5) NOT NULL DEFAULT 0,
  `projectScope` varchar(100) NOT NULL,
  `clientname` varchar(100) DEFAULT NULL,
  `buildingname` varchar(100) DEFAULT NULL,
  `buildingaddress` varchar(200) DEFAULT NULL,
  `workarea` int(10) DEFAULT NULL,
  `blueprint` varchar(500) DEFAULT NULL,
  `phaseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectID`, `clientID`, `buildingID`, `quotationID`, `projectName`, `projectType`, `projectDetails`, `startDate`, `deadlineDate`, `budgetConstraint`, `specialRequests`, `dateFiled`, `isComplete`, `completionDate`, `progressRate`, `projectScope`, `clientname`, `buildingname`, `buildingaddress`, `workarea`, `blueprint`, `phaseID`) VALUES
(23, 18, 8, 0, 'Fix Comfort Room', '321321', '5321erds', '0231-01-31', '0032-03-12', 0, '33213', 0, 0, '0023-12-31', 0, '21321321', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 19, 11, 0, 'Roof Repair', 'dkjwankd', 'jkdnwkad', '0131-12-31', '0032-12-31', 0, 'dwnadkjwa', 0, 0, '0003-12-31', 0, 'ljdak', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 20, 12, 0, 'testest', '3213', '1232131', '0321-03-21', '0003-03-12', 0, '32131', 0, 0, '0321-03-21', 0, '21321321', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 21, 14, 0, 'Rebuilding of Office', '13213', '3213', '0013-12-31', '3231-12-21', 0, '321321', 0, 0, '0321-03-21', 0, '32132', NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 'Rale', 'Ayala', 'OK', 'Renovation', '2024-06-25', '2024-06-30', 'Yea', '51', 9500.00, 'Hi', 'hi@gmail.com', 0, 1),
(2, 'Rale2', 'Ayala', 'OK', 'Renovation', '2024-06-25', '2024-06-30', 'Yea', '51', 9500.00, 'Hi', 'hi@gmail.com', 0, 1),
(3, 'Rale3', 'Ayala', 'OK', 'Renovation', '2024-06-25', '2024-06-30', 'Yea', '51', 9500.00, 'Hi', 'hi@gmail.com', 1, 1),
(4, 'Rale4', 'Ayala', 'OK', 'Renovation', '2024-06-25', '2024-06-30', 'Yea', '51', 9500.00, 'Hi', 'hi@gmail.com', 1, 1),
(5, 'Rale4', 'Ayala', 'OK', 'Renovation', '2024-06-25', '2024-06-30', 'Yea', '51', 9500.00, 'Hi', 'hi@gmail.com', 0, 2),
(6, 'Rale5', 'Ayala', 'OK', 'Renovation', '2024-06-17', '2024-06-27', 'ok', '1', 15.00, 'ok', 'hi@gmail.com', 0, 1),
(7, 'Rale6', 'Ayala', 'OK', 'Renovation', '2024-06-25', '2024-06-30', 's', '1', 12.00, 's', 's', 0, 0),
(8, 'Rale7', 'Rale7', 'Rale7', 'Construction', '2024-06-24', '2024-06-30', 'Rale7', '4', 15.00, 'Rale7', 'Rale7', 1, 1),
(9, 'Rale7', 'Rale7', 'Rale7', 'Construction', '2024-06-24', '2024-06-30', 'Rale7', '4', 15.00, 'Rale7', 'Rale7', 0, 0),
(10, 'Rale7', 'Rale7', 'Rale7', 'Construction', '2024-06-24', '2024-06-30', 'Rale7', '4', 15.00, 'Rale7', 'Rale7', 0, 0),
(11, 'Rale10', 'Ayala', 'OKS', 'Construction', '2024-06-19', '2024-06-30', 'OK', '1', 15.00, 'OK', 'OK', 0, 0),
(12, 'Rale11', 'Ayala', 'OKS', 'Construction', '2024-06-19', '2024-06-30', 'OK', '1', 15.00, 'OK', 'OK', 0, 0),
(13, 'Rale71', 'Rale71', 'Rale71', 'Renovation', '2024-06-26', '2024-06-29', 'Rale71', '1', 15.00, 'Rale71', 'Rale71', 0, 0),
(14, 'Rale72', 'Rale72', 'Rale72', 'Construction', '2024-06-21', '2024-06-30', 'Rale72', '1', 15.00, 'Rale72', 'Rale72', 0, 0),
(15, 'Rale72Rale72', 'Rale72', 'Rale72', 'Renovation', '2024-06-08', '2024-06-27', 'Rale72', '1', 15.00, 'Rale72Rale72', 'Rale72', 0, 0),
(16, 'Rale72Rale72', 'Rale72', 'Rale72', 'Renovation', '2024-06-08', '2024-06-27', 'Rale72', '1', 15.00, 'Rale72Rale72', 'Rale72', 0, 0),
(17, 'Rale72Rale72', 'Rale72', 'Rale72', 'Renovation', '2024-06-08', '2024-06-27', 'Rale72', '1', 15.00, 'Rale72Rale72', 'Rale72', 0, 0),
(18, 'Rale72', 'Rale72Rale72Rale72', 'Rale72', 'Renovation', '2024-06-26', '2024-06-27', 'Rale72', '51', 51.00, 'Rale72', 'Rale72', 0, 0),
(19, 'Rale72', 'Rale72Rale72Rale72', 'Rale72', 'Renovation', '2024-06-26', '2024-06-27', 'Rale72', '51', 51.00, 'Rale72', 'Rale72', 0, 0),
(20, 'Rale72', 'Rale72Rale72Rale72', 'Rale72', 'Renovation', '2024-06-26', '2024-06-27', 'Rale72', '51', 51.00, 'Rale72', 'Rale72', 0, 0),
(21, 'Rale72', 'Rale72Rale72Rale72', 'Rale72', 'Renovation', '2024-06-26', '2024-06-27', 'Rale72', '51', 51.00, 'Rale72', 'Rale72', 0, 0),
(22, 'ral1', 'ral1', 'ral1', 'Construction', '2024-06-15', '2024-06-27', 'ral1', '1', 15.00, 'ral1', 'ral1', 0, 0),
(23, 'Rale7214', 'Rale721', 'Rale721', 'Construction', '2024-05-29', '2024-06-27', 'Rale721', '721', 5155.00, 'Rale721', 'Rale721', 0, 0),
(24, 'Rale7251', 'Rale7251', 'Rale7251', 'Construction', '2024-06-08', '2024-06-27', 'Rale7251', '9', 987.00, 'Rale7251', 'Rale7251', 0, 0),
(25, 'Rale7290', 'Rale7290', 'Rale7290', 'Construction', '2024-06-07', '2024-06-27', 'Rale7290', '6', 6161.00, 'Rale7290', 'Rale7290', 1, 2),
(26, 'Rale69', 'Rale69', 'Rale69Rale69', 'Construction', '2024-06-04', '2024-07-02', 'Rale69', '69', 69.00, 'Rale69Rale69', 'Rale69Rale69', 0, 0),
(27, 'Rale69', 'Rale69', 'Rale69Rale69', 'Construction', '2024-06-04', '2024-07-02', 'Rale69', '69', 69.00, 'Rale69Rale69', 'Rale69Rale69', 1, 1),
(28, 's', 's', 's', 'Construction', '2024-06-08', '2024-06-27', 's', '1', 1.00, 's', 's', 0, 0),
(29, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1),
(30, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1),
(31, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1),
(32, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1),
(33, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1),
(34, 'TEST JOLLIBEE2', 'MCDO', 'KFC', 'Construction', '2024-06-15', '2024-07-01', 's', '6', 6.00, 's', 'hi@gmail.com', 1, 2),
(35, 'TEST MCDO', 'TEST', 'TEST', 'Construction', '2024-06-27', '2024-07-09', 'TEST', '69', 69.00, 'TEST', 'hi@gmail.com', 1, 2),
(36, 'TEST MCDO', 'TEST MCDO', 'TEST MCDO', 'Construction', '2024-06-12', '2024-07-12', 'TEST MCDO', '69', 69.00, 'TEST MCDO', 'TEST MCDO', 1, 2),
(37, 'Rale7269', 'Rale7269', 'Rale7269', 'Construction', '2024-06-14', '2024-06-27', 'Rale7269', '69', 69.00, 'Rale7269', 'Rale7269', 1, 3),
(38, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-05-29', '2024-07-01', 's', '51', 51.00, 's', 'hi@gmail.com', 1, 1),
(39, 'hilom', 'hilom', 'hilom', 'Construction', '2024-06-19', '2024-06-27', 'hilom', '5', 4.00, 'hilom', 'hilom', 1, 2),
(40, 'alec', 'alec', 'alec', 'Construction', '2024-06-13', '2024-06-27', 'alec', '51', 5.00, 'alec', 'alec', 1, 0),
(41, 'alec', 'alec', 'alec', 'Construction', '2024-05-30', '2024-06-27', 'alec', '51', 51.00, 'alec', 'alec', 1, 1),
(42, 'finalpls', 'finalpls', 'finalpls', 'Construction', '2024-06-08', '2024-06-27', 'finalpls', '51', 51.00, 'finalpls', 'finalpls', 1, 2),
(43, 'Raleok', 'Raleok', 'Raleok', 'Construction', '2024-06-12', '2024-06-28', 'Raleok', '1', 15.00, 'Raleok', 'Raleok', 1, 1),
(44, 'Raleok', 'Ayala', 'KFC', 'Renovation', '2024-06-15', '2024-07-05', 's', '4141', 2412.00, 's', 'hi@gmail.com', 0, 1),
(45, 'Raleoks', 'Raleoks', 'Raleoks', 'Construction', '2024-06-21', '2024-07-01', 'Raleoks', '51', 51.00, '51', 'Rale7', 1, 1),
(46, 'Raleokss', 'Raleokss', 'Raleokss', 'Construction', '2024-07-03', '2024-07-03', 'Raleokss', '51', 51.00, 'Raleokss', 'hi@gmail.com', 1, 1),
(47, 'Raleokssss', 'Raleokssss', 'Raleokssss', 'Construction', '2024-06-21', '2024-06-21', 'Raleokssss', '51', 51.00, 'Raleokssss', 'Raleokssss', 1, 1),
(48, 'Raleokalec', 'Raleokalec', 'Raleokalec', 'Construction', '2024-06-20', '2024-07-06', 'Raleokalec', '51', 51.00, 'Raleokalec', 'Raleokalec', 1, 1),
(49, 'Raleokalec', 'Raleokalec', 'Raleokalec', 'Construction', '2024-06-12', '2024-06-30', 'Raleokalec', '51', 5.00, 'Raleokalec', 'Raleokalec', 1, 2),
(50, 'hoy', 'hoy', 'hoy', 'Construction', '2024-05-31', '2024-07-25', 'hoy', '61', 61.00, 'hoy', 'hoy', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`buildingID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientID`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`costID`);

--
-- Indexes for table `phase`
--
ALTER TABLE `phase`
  ADD PRIMARY KEY (`phaseID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `fk_clientid` (`clientID`),
  ADD KEY `fk_phaseID` (`phaseID`);

--
-- Indexes for table `quotation_request`
--
ALTER TABLE `quotation_request`
  ADD PRIMARY KEY (`requestID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `buildingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `costID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phase`
--
ALTER TABLE `phase`
  MODIFY `phaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `quotation_request`
--
ALTER TABLE `quotation_request`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_clientid` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`),
  ADD CONSTRAINT `fk_phaseID` FOREIGN KEY (`phaseID`) REFERENCES `phase` (`phaseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
