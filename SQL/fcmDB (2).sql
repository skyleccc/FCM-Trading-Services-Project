-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2024 at 04:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(2, 'cjakosalem', '126', '2024-06-26'),
(3, 'raleleaf', 'got7bambam', '2024-07-06');

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
(14, '21321321', 31321, '', NULL),
(15, '32131', 12312, '', NULL),
(16, '312312', 12312, '', NULL),
(17, '1231', 3213213, '', NULL),
(18, '2131232', 32131, '', NULL),
(19, '3123132131', 321312, '', NULL),
(20, 'frncis', 321312, '', NULL),
(21, 'Consolacion', 321312, '', NULL),
(22, '3123213', 12312, '', NULL);

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
(21, 'Alec Jakosalem', '321321321'),
(22, '2131321', '313'),
(23, '123131', '12321'),
(24, 'Mendero hkelde', 'dkjawndkja'),
(25, '123123', '3123123'),
(26, 'Mendero Medical Center32', 'dkjawndkja');

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
(7, 'Preparation of Materials and WFUCK', 'Prepare the things needed for the project.321321', '3213-12-31', '3213-12-31');

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
(40, 19, 21, 0, 'Roof Repair2', '313123', '3123131', '0032-03-21', '1321-12-31', 0, '31232131', 0, 0, '0131-12-31', 0, '2131231', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `numberOfFiles` int(2) DEFAULT NULL,
  `status` enum('approved','declined','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_request`
--

INSERT INTO `quotation_request` (`requestID`, `clientName`, `location`, `siteInformation`, `serviceType`, `startDate`, `completeDate`, `projectDetails`, `workArea`, `budgetConstraint`, `specialRequests`, `contact`, `withBlueprint`, `numberOfFiles`, `status`) VALUES
(6, 'reitz bayot', 'Ayala', 'OK', 'Renovation', '2024-06-17', '2024-06-27', 'ok', '1', 15.00, 'ok', 'hi@gmail.com', 0, 1, 'declined'),
(31, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1, 'approved'),
(33, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-06-17', '2024-07-06', 'GUTOM', '69', 69.00, 'PLS', 'mikey', 1, 1, 'pending'),
(34, 'TEST JOLLIBEE2', 'MCDO', 'KFC', 'Construction', '2024-06-15', '2024-07-01', 's', '6', 6.00, 's', 'hi@gmail.com', 1, 2, 'pending'),
(35, 'TEST MCDO', 'TEST', 'TEST', 'Construction', '2024-06-27', '2024-07-09', 'TEST', '69', 69.00, 'TEST', 'hi@gmail.com', 1, 2, 'pending'),
(36, 'TEST MCDO', 'TEST MCDO', 'TEST MCDO', 'Construction', '2024-06-12', '2024-07-12', 'TEST MCDO', '69', 69.00, 'TEST MCDO', 'TEST MCDO', 1, 2, 'pending'),
(37, 'Rale7269', 'Rale7269', 'Rale7269', 'Construction', '2024-06-14', '2024-06-27', 'Rale7269', '69', 69.00, 'Rale7269', 'Rale7269', 1, 3, 'pending'),
(38, 'TEST JOLLIBEE', 'MCDO', 'KFC', 'Construction', '2024-05-29', '2024-07-01', 's', '51', 51.00, 's', 'hi@gmail.com', 1, 1, 'pending'),
(39, 'hilom', 'hilom', 'hilom', 'Construction', '2024-06-19', '2024-06-27', 'hilom', '5', 4.00, 'hilom', 'hilom', 1, 2, 'pending'),
(40, 'alec', 'alec', 'alec', 'Construction', '2024-06-13', '2024-06-27', 'alec', '51', 5.00, 'alec', 'alec', 1, 0, 'pending'),
(41, 'alec', 'alec', 'alec', 'Construction', '2024-05-30', '2024-06-27', 'alec', '51', 51.00, 'alec', 'alec', 1, 1, 'pending'),
(42, 'finalpls', 'finalpls', 'finalpls', 'Construction', '2024-06-08', '2024-06-27', 'finalpls', '51', 51.00, 'finalpls', 'finalpls', 1, 2, 'pending'),
(43, 'Raleok', 'Raleok', 'Raleok', 'Construction', '2024-06-12', '2024-06-28', 'Raleok', '1', 15.00, 'Raleok', 'Raleok', 1, 1, 'pending'),
(44, 'Raleok', 'Ayala', 'KFC', 'Renovation', '2024-06-15', '2024-07-05', 's', '4141', 2412.00, 's', 'hi@gmail.com', 0, 1, 'pending'),
(45, 'Raleoks', 'Raleoks', 'Raleoks', 'Construction', '2024-06-21', '2024-07-01', 'Raleoks', '51', 51.00, '51', 'Rale7', 1, 1, 'pending'),
(46, 'Raleokss', 'Raleokss', 'Raleokss', 'Construction', '2024-07-03', '2024-07-03', 'Raleokss', '51', 51.00, 'Raleokss', 'hi@gmail.com', 1, 1, 'pending'),
(47, 'Raleokssss', 'Raleokssss', 'Raleokssss', 'Construction', '2024-06-21', '2024-06-21', 'Raleokssss', '51', 51.00, 'Raleokssss', 'Raleokssss', 1, 1, 'pending'),
(48, 'Raleokalec', 'Raleokalec', 'Raleokalec', 'Construction', '2024-06-20', '2024-07-06', 'Raleokalec', '51', 51.00, 'Raleokalec', 'Raleokalec', 1, 1, 'pending'),
(49, 'Raleokalec', 'Raleokalec', 'Raleokalec', 'Construction', '2024-06-12', '2024-06-30', 'Raleokalec', '51', 5.00, 'Raleokalec', 'Raleokalec', 1, 2, 'pending'),
(50, 'hoy', 'hoy', 'hoy', 'Construction', '2024-05-31', '2024-07-25', 'hoy', '61', 61.00, 'hoy', 'hoy', 1, 1, 'pending');

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
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `buildingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `costID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phase`
--
ALTER TABLE `phase`
  MODIFY `phaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
