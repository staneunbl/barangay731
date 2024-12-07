-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 11:16 AM
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
-- Database: `barangay731db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountaccesslogs_tbl`
--

CREATE TABLE `accountaccesslogs_tbl` (
  `LogID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `AccessDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `IPAddress` varchar(255) DEFAULT NULL,
  `AccessType` enum('Login','Logout') DEFAULT NULL,
  `BrowserInfo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountaccesslogs_tbl`
--

INSERT INTO `accountaccesslogs_tbl` (`LogID`, `UserID`, `RoleID`, `AccessDateTime`, `IPAddress`, `AccessType`, `BrowserInfo`) VALUES
(1, 9, 1, '2024-03-20 04:39:31', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(2, 9, 1, '2024-03-20 05:05:25', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(3, 10, 2, '2024-03-20 18:15:19', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(4, 10, 2, '2024-03-20 18:17:24', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(5, 9, 1, '2024-03-20 18:18:03', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(6, 9, 1, '2024-03-20 20:59:15', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(7, 9, 1, '2024-03-20 21:00:45', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(8, 9, 1, '2024-03-20 21:03:30', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(9, 10, 2, '2024-03-20 21:03:42', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(10, 9, 1, '2024-03-20 21:22:00', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(11, 9, 1, '2024-03-20 22:35:28', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(12, 9, 1, '2024-04-01 00:56:55', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(13, 10, 2, '2024-04-01 01:03:57', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(14, 10, 2, '2024-04-01 01:04:07', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(15, 10, 2, '2024-04-01 01:04:30', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(16, 10, 2, '2024-04-01 01:04:54', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(17, 10, 2, '2024-04-01 01:05:22', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(18, 10, 2, '2024-04-01 01:06:04', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(19, 10, 2, '2024-04-01 01:06:15', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(20, 10, 2, '2024-04-01 01:07:06', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(21, 10, 2, '2024-04-01 01:07:36', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(22, 9, 1, '2024-04-01 01:07:43', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(23, 9, 1, '2024-04-01 01:07:46', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(24, 9, 1, '2024-04-01 01:07:57', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(25, 9, 1, '2024-04-01 01:15:34', '::1', 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(26, 9, 1, '2024-04-01 01:23:30', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(27, 9, 1, '2024-04-01 17:25:00', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(28, 9, 1, '2024-04-01 17:26:16', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
(29, 9, 1, '2024-04-01 17:27:46', '::1', 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `barangaycertificate_tbl`
--

CREATE TABLE `barangaycertificate_tbl` (
  `CertificateID` int(11) NOT NULL,
  `UserID` int(255) NOT NULL,
  `CertificateNumber` varchar(255) DEFAULT '0',
  `ReferenceNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangaycertificate_tbl`
--

INSERT INTO `barangaycertificate_tbl` (`CertificateID`, `UserID`, `CertificateNumber`, `ReferenceNo`) VALUES
(1, 10, 'TBC24-10', 'B731-TBC24-01'),
(2, 10, 'TBC24-00', 'B731-TBC24-00'),
(3, 10, 'TBC24-00', 'B731-TBC24-00'),
(4, 10, 'TBC24-00', 'B731-TBC24-00'),
(5, 10, 'TBC24-00', 'B731-TBC24-00'),
(6, 10, 'TBC24-00', 'B731-TBC24-00'),
(7, 10, 'TBC24-00', 'B731-TBC24-00'),
(8, 10, 'TBC24-00', 'B731-TBC24-00'),
(9, 10, 'TBC24-00', 'B731-TBC24-00'),
(10, 10, 'TBC24-00', 'B731-TBC24-00');

-- --------------------------------------------------------

--
-- Table structure for table `barangayofficials_tbl`
--

CREATE TABLE `barangayofficials_tbl` (
  `BrgyOfficialId` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `PositionID` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL,
  `IsArchived` tinyint(1) DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangayofficials_tbl`
--

INSERT INTO `barangayofficials_tbl` (`BrgyOfficialId`, `FirstName`, `LastName`, `MiddleName`, `PositionID`, `IsActive`, `IsArchived`, `Image`) VALUES
(1, 'Jhoannna', 'Erika', '', 1, 1, 1, ''),
(2, 'Jhoannna', 'Cuizon', 'ss', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `blotterrecords_tbl`
--

CREATE TABLE `blotterrecords_tbl` (
  `BlotterID` int(11) NOT NULL,
  `CaseNumber` varchar(50) DEFAULT NULL,
  `DateFiled` date DEFAULT NULL,
  `ComplainantName` varchar(100) DEFAULT NULL,
  `RespondentName` varchar(100) DEFAULT NULL,
  `IncidentDetails` varchar(255) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `ResolutionText` varchar(255) DEFAULT NULL,
  `InvestigatingOfficer` varchar(100) DEFAULT NULL,
  `DateResolved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotterrecords_tbl`
--

INSERT INTO `blotterrecords_tbl` (`BlotterID`, `CaseNumber`, `DateFiled`, `ComplainantName`, `RespondentName`, `IncidentDetails`, `StatusID`, `ResolutionText`, `InvestigatingOfficer`, `DateResolved`) VALUES
(1, '1', '2024-04-02', 'shay', 'ayet', 'si shay kasi', 1, '0', 'jho', '0000-00-00'),
(2, '2', '2024-04-02', 'shay', 'ayet', 'si shay kasi2', 1, 'nagpatawad si ayet', 'jho', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `blotterstatus_tbl`
--

CREATE TABLE `blotterstatus_tbl` (
  `StatusID` int(11) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotterstatus_tbl`
--

INSERT INTO `blotterstatus_tbl` (`StatusID`, `StatusName`) VALUES
(1, 'Ongoing'),
(2, 'Settled'),
(3, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `brgyindigencycertificate_tbl`
--

CREATE TABLE `brgyindigencycertificate_tbl` (
  `IndigencyCertID` int(11) NOT NULL,
  `ResidentID` int(11) NOT NULL,
  `IndigencyCertNumber` varchar(255) DEFAULT '0',
  `ReferenceNo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgyindigencycertificate_tbl`
--

INSERT INTO `brgyindigencycertificate_tbl` (`IndigencyCertID`, `ResidentID`, `IndigencyCertNumber`, `ReferenceNo`) VALUES
(1, 12, 'BIC24-', 'B731-TBC24-'),
(2, 12, 'BIC24-00', 'B731-TBC24-00');

-- --------------------------------------------------------

--
-- Table structure for table `cluster_tbl`
--

CREATE TABLE `cluster_tbl` (
  `ClusterID` int(11) NOT NULL,
  `ClusterName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cluster_tbl`
--

INSERT INTO `cluster_tbl` (`ClusterID`, `ClusterName`) VALUES
(1, 'clusterOne'),
(2, 'clusterTwo'),
(3, 'clusterThree'),
(4, 'clusterFour'),
(5, 'clusterFive'),
(6, 'clusterSix'),
(7, 'clusterSeven'),
(8, 'clusterEight');

-- --------------------------------------------------------

--
-- Table structure for table `docutype_tbl`
--

CREATE TABLE `docutype_tbl` (
  `DocuTypeID` int(11) NOT NULL,
  `DocuName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docutype_tbl`
--

INSERT INTO `docutype_tbl` (`DocuTypeID`, `DocuName`) VALUES
(1, 'Barangay Certificates'),
(2, 'Barangay ID');

-- --------------------------------------------------------

--
-- Table structure for table `householdsummary_tbl`
--

CREATE TABLE `householdsummary_tbl` (
  `HouseholdSummaryID` int(11) NOT NULL,
  `HouseholdID` int(11) DEFAULT NULL,
  `HouseholdName` varchar(255) DEFAULT NULL,
  `NumOfResidents` int(11) DEFAULT NULL,
  `Male` int(11) DEFAULT NULL,
  `Female` int(11) DEFAULT NULL,
  `Senior` int(11) DEFAULT NULL,
  `Adult` int(11) DEFAULT NULL,
  `Minor` int(11) DEFAULT NULL,
  `YoungDependent` int(11) DEFAULT NULL,
  `OldDependent` int(11) DEFAULT NULL,
  `WorkingAdults` int(11) DEFAULT NULL,
  `Students` int(11) DEFAULT NULL,
  `PWD` int(11) DEFAULT NULL,
  `Widow` int(11) DEFAULT NULL,
  `SoloParent` int(11) DEFAULT NULL,
  `LiveIn` int(11) DEFAULT NULL,
  `Married` int(11) DEFAULT NULL,
  `Separated` int(11) DEFAULT NULL,
  `RegisteredVoter` int(11) DEFAULT NULL,
  `NonRegisteredVoter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `household_tbl`
--

CREATE TABLE `household_tbl` (
  `HouseholdID` int(11) NOT NULL,
  `HouseHoldNumber` int(11) NOT NULL,
  `HouseholdName` varchar(255) DEFAULT NULL,
  `ClusterId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household_tbl`
--

INSERT INTO `household_tbl` (`HouseholdID`, `HouseHoldNumber`, `HouseholdName`, `ClusterId`) VALUES
(1, 0, 'Cuizon', 1),
(2, 0, 'Nalcot', 2),
(3, 0, 'Marasigan', 3),
(4, 0, 'Test', 4),
(5, 0, 'abc', 5),
(6, 0, 'qwert', 6),
(7, 0, 'Jho', 7),
(8, 123, 'Shay', 8),
(9, 9, 'shay', 7);

-- --------------------------------------------------------

--
-- Table structure for table `positions_tbl`
--

CREATE TABLE `positions_tbl` (
  `PositionId` int(11) NOT NULL,
  `PositionName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions_tbl`
--

INSERT INTO `positions_tbl` (`PositionId`, `PositionName`) VALUES
(1, 'Barangay Captain'),
(2, 'Kagawad');

-- --------------------------------------------------------

--
-- Table structure for table `requestforsomeone_tbl`
--

CREATE TABLE `requestforsomeone_tbl` (
  `requestID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `DocuType` int(255) NOT NULL,
  `Purpose` varchar(255) NOT NULL,
  `requestFor` varchar(255) NOT NULL,
  `relationshipWith` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `requestDate` datetime NOT NULL,
  `expiryDate` date NOT NULL,
  `trackingNumber` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestforsomeone_tbl`
--

INSERT INTO `requestforsomeone_tbl` (`requestID`, `userID`, `DocuType`, `Purpose`, `requestFor`, `relationshipWith`, `firstName`, `lastName`, `middleName`, `birthday`, `requestDate`, `expiryDate`, `trackingNumber`, `Status`) VALUES
(1, 10, 1, 'try again and again', 'others', 'daughter', 'shay', 'marasigan', 'lee', '2014-12-31', '2024-04-12 14:59:23', '2024-10-12', '1-10-JIR2D1MC', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `RequestId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `ResidentID` int(11) NOT NULL,
  `DocuType` varchar(255) DEFAULT NULL,
  `RequestFor` varchar(255) NOT NULL DEFAULT 'Self',
  `RelationshipWith` varchar(255) NOT NULL DEFAULT 'Self',
  `Purpose` varchar(255) DEFAULT NULL,
  `RequestDate` datetime NOT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `TrackingNumber` varchar(255) NOT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`RequestId`, `UserId`, `ResidentID`, `DocuType`, `RequestFor`, `RelationshipWith`, `Purpose`, `RequestDate`, `ExpiryDate`, `TrackingNumber`, `Status`) VALUES
(53, 10, 12, '1', 'self', 'Self', 'hayts', '2024-04-12 15:12:44', '2024-10-12', '1-10-6ES57XCR', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `residents_tbl`
--

CREATE TABLE `residents_tbl` (
  `ResidentID` int(11) NOT NULL,
  `HouseholdID` int(11) DEFAULT NULL,
  `ClusterID` int(11) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(25) NOT NULL,
  `HouseNumber` int(11) NOT NULL,
  `StreetName` varchar(255) NOT NULL,
  `CityName` varchar(255) NOT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `PlaceOfBirth` varchar(255) DEFAULT NULL,
  `Citizenship` varchar(255) NOT NULL,
  `CivilStatus` varchar(20) DEFAULT NULL,
  `LiveIn` enum('yes','no') DEFAULT NULL,
  `PWD` enum('yes','no') DEFAULT NULL,
  `SoloParent` enum('yes','no') DEFAULT NULL,
  `Kasambahay` enum('yes','no') DEFAULT NULL,
  `Occupation` varchar(255) DEFAULT NULL,
  `Student` enum('yes','no') DEFAULT NULL,
  `RegisteredVoter` enum('yes','no') DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `IsArchived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents_tbl`
--

INSERT INTO `residents_tbl` (`ResidentID`, `HouseholdID`, `ClusterID`, `LastName`, `FirstName`, `MiddleName`, `Suffix`, `HouseNumber`, `StreetName`, `CityName`, `PostalCode`, `Gender`, `Birthday`, `Age`, `PlaceOfBirth`, `Citizenship`, `CivilStatus`, `LiveIn`, `PWD`, `SoloParent`, `Kasambahay`, `Occupation`, `Student`, `RegisteredVoter`, `Image`, `IsArchived`) VALUES
(1, NULL, 1, 'nalcute', 'teya', 'qwe', 'er', 123, 'w', 'asd', '23', 'Female', '2024-02-12', 0, 'as', '', 'Single', 'no', 'yes', 'no', 'no', 'tambay', 'no', 'yes', 'nalcute.jpg', 0),
(2, NULL, 2, 'test', 'test', 'test', 'test', 123, 'asd', 'asd', '23', 'Female', '2024-03-06', 0, 'rere', '', 'Married', 'no', 'yes', '', 'yes', 'prof', 'no', 'yes', 'test.jpg', 1),
(3, NULL, 3, 'Cuizon', 'Erika', 'Covico', '', 5372, 'Economia', 'Makati', '1234', 'Female', '2003-10-19', 20, 'malate', '', 'Single', '', '', '', '', '', 'yes', 'yes', 'Jho Cuizon.png', 0),
(4, NULL, 3, 'Rivera', 'Marian', 'Santos', '', 123, 'Pasong Tirad', 'Makati', '147', 'Female', '2005-06-07', 18, 'Manila', '', 'Married', 'yes', '', '', '', 'Actress', '', 'yes', '2.png', 1),
(5, 4, 4, 'Dantes', 'Dingdong', 'Rivera', 'II', 234, 'Saan', 'Makati', '547', 'Male', '2009-07-30', 14, 'malate', '', 'Married', '', '', '', '', 'Actor', '', '', '269778440_1863697410483398_3002646504454833086_n.jpg', 0),
(6, 5, 5, 'Bernardo', 'Kathryn', 'Chandria', '', 4567, 'asdf', 'ghjk', '89', 'Female', '2014-01-28', 0, 'ghg', '', 'Single', 'yes', 'no', 'no', 'yes', 'ghghg', 'no', 'yes', 'Red Grid UI Technology Professional Desktop Wallpaper.png', 0),
(7, 6, 6, 'Lustre', 'Nadines', 'asdf', '', 123, 'asd', 'asd', '123', 'Female', '2014-12-31', 0, 'zxc', '', 'Separated', 'yes', 'yes', 'yes', 'no', 'asd', 'no', 'no', 'Lustre_1271843_866181646740717_246798991_o.jpg', 0),
(8, NULL, 1, 'Chokoy', 'Chikay', 'Mickey', 'George', 2448, 'asf', 'asd', '12', 'Female', '2012-03-25', 0, 'as', '', 'Single', 'yes', 'no', 'yes', 'yes', 'Actor', 'yes', 'yes', 'Chokoy.jpg', 0),
(9, NULL, 7, 'Quitasol', 'Ralph', 'a', 'III', 123, 'asdf', 'asd', '123', 'Male', '2017-01-06', 7, 'asdf', '', 'Single', 'yes', 'yes', 'yes', 'yes', 'asfa', 'yes', 'yes', 'Quitasol.jpg', 0),
(10, NULL, 7, 'Oreo', 'Mickey', 'George', 'II', 123, 'fghgh', '', '', 'Male', '2014-12-31', 0, 'asd', 'Filipino', 'Single', 'yes', 'yes', 'yes', 'yes', 'boss', 'yes', 'yes', 'Oreo.jpg', 0),
(11, NULL, 4, 'Belmonte', 'Chelsea', 'ano', 'IV', 456, 'asdf', '', '', 'Female', '2011-02-04', 0, 'rere', '', 'Married', 'no', 'yes', 'no', 'no', 'tambay', 'yes', 'yes', '_661783102e9af.jpg', 0),
(12, NULL, 2, 'jho', 'asdf', 'q', 'er', 345, 'fghdfghf', '', '', 'Female', '2005-06-07', 0, 'vvcvc', 'Filipino', 'Single', 'yes', 'yes', 'yes', 'yes', 'cvcvc', 'yes', 'yes', 'jho.jpg', 0),
(13, NULL, 1, 'Belmonte', 'Chelsea', 'ano', 'jr', 12, '1st Street', '', '', 'Female', '2024-04-20', 0, 'Manila City', '', 'Single', 'no', 'no', 'no', 'no', 'Student', 'yes', 'yes', 'Belmonte.jpg', 0),
(14, NULL, 2, 'Belmonte', 'Chelsea', 'ano', 'II', 13, '2nd Street', 'Manila City', '1004', 'Female', '2024-04-17', 0, 'Manila City', '', 'Single', '', '', '', '', 'Student', 'yes', 'yes', 'Belmonte_661782c5736fc.jpg', 0),
(15, NULL, 8, 'Cruz', 'Patrick', 'Lee', 'Jr', 567, 'Quirino Street', '', '', 'Male', '2024-10-17', 0, 'Manila City', 'Filipino', 'Single', 'no', 'no', 'no', 'no', 'Student', 'yes', 'yes', 'Cruz_661cbf38efd50.jpg', 0),
(16, NULL, 1, 'try', 'try', 'try', 'try', 12, 'try', 'Manila City', '1004', 'Male', '2024-04-15', 0, 'try', 'try', 'Single', '', '', '', '', 'try', '', '', 'try_661cbfd652bc8.jpg', 1),
(17, NULL, 6, 'ulit', 'ulit', 'ulit', 'ulit', 321, 'Quezon City', 'Manila City', '1004', 'Female', '2024-04-19', 0, 'Manila City', 'ulit', 'Separated', '', '', 'yes', '', 'ulit', '', 'yes', 'ulit_661cc2e3b5cbc.jpg', 0),
(18, NULL, 7, 'nanaman', 'nanaman', 'nanaman', 'nana', 432, '7th Street', 'Manila City', '1004', 'Kulang', '2024-04-28', 0, 'Metro Manila', 'Filipino', 'Widowed', '', 'yes', '', 'yes', 'nanaman', 'yes', '', 'nanaman_661cc82cb5a9e.jpg', 0),
(19, NULL, 3, 'hay', 'hay', 'hay', 'hay', 654, '3rd Street', 'Manila City', '1004', 'Female', '2022-05-11', 1, 'Metro Manila', 'Filipino', 'Married', '', '', '', '', 'hay', '', 'yes', 'hay_661cca3ebcad9.jpg', 0),
(20, NULL, 4, 'tsk', 'tsk', 'tsk', 'stsk', 876, '9th Street', 'Manila City', '1004', 'Male', '2024-04-05', 0, 'Manila City', 'tsk', 'Single', '', '', '', 'yes', 'tsk', '', 'yes', 'tsk_661ccb2136b50.jpg', 0),
(21, NULL, 1, 'a', 'a', 'a', 'a', 1, 'a', 'Manila City', '1004', 'Male', '2024-04-11', 0, 'aa', 'a', 'Single', 'yes', '', '', '', 'a', '', 'yes', 'a_661ccc1a54fcf.jpg', 0),
(22, NULL, 1, 'bb', 'bb', 'bb', 'bb', 12, 'bb', 'Manila City', '1004', 'Male', '2024-04-06', 0, 'bb', 'bb', 'Single', '', '', 'yes', '', 'bb', '', 'yes', 'bb_661ccedcc6452.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'Constituent'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `UserID` int(11) NOT NULL,
  `ResidentID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(10) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `RegistrationDate` date DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsVerified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`UserID`, `ResidentID`, `FirstName`, `LastName`, `MiddleName`, `Suffix`, `Username`, `Password`, `Email`, `Phone`, `RegistrationDate`, `Image`, `RoleID`, `IsActive`, `IsVerified`) VALUES
(6, 0, 'teya', 'nalcute', 'test', 'testss', 'testU', '$2y$10$J82dq33vrzhnH3OkjKX9H.TjguKEkNkw0nfGV1s4gu0j8RK9e/iEe', 'teya@email.com', '09123456789', '2024-03-08', '', 2, 1, 0),
(7, 0, 'a', 'a', 'a', 'a', 'a', '$2y$10$ExWvsvfcSXYrz.PbAIZe1uVm2GxfKF6NWHKueX1IzUUIOabn8J6ZW', 'a@email.com', 'a', '2024-03-08', '', 1, 1, 0),
(8, 0, 'a', 'a', 'c', 'c', 'b', '$2y$10$yA3W/1bDrxRL2f6H1pVIwuk.Vu3tdPNWZJwK.W33gYT..tMw1EeZi', 'abc@email.com', '123', '2024-03-08', '', 2, 1, 0),
(9, 0, 'c', 'c', 'c', 'II', 'shay', '$2y$10$NV6mAjiUwlWha0WvXDk65.Ak09jr1Pp1.DeUu59IlX9sJCaqrLX2K', 'shay@email.com', '09456123', '2024-03-08', '', 1, 1, 0),
(10, 12, 'asdf', 'jho', 'q', 'er', 'jho', '$2y$10$eQZCGUZaZ8KpxFhE3o5kWuRtsf3.1r7CzEMwdsGdJu7yUeSKC/Y2W', 'Erika@email.com', '09478654', '2024-03-08', 'jho.jpg', 2, 1, 1),
(11, 0, 'test', 'test', 'test', 'II', 'test', '$2y$10$ycckb/yX8U83TRUXZ7moHOgWzHfW3ADU2pKVTTrZgCsvOcTrWadqy', 'test@email.com', '12345654', '2024-03-12', '', 2, 1, 0),
(12, 0, 'Luis', 'Miraran', 'Mercado', 'II', 'luis', '$2y$10$BTfeGEsjyMeaPRqQZ0zhGeC1rYTPv5iWNbE6K7RDcvbBWnncHhPL2', 'luis@email.com', '09143143143', '2024-03-15', '', 2, 0, 1),
(15, 9, 'Ralph', 'Quitasol', 'a', 'III', 'ralph', '$2y$10$nAfz9lb3t6e0Ew4XDRszBe3ZoCoyyBHttiHxNvsgL548kw8.X8Lne', 'r@email.com', '09123456789', '2024-04-07', 'Quitasol.jpg', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verification_tbl`
--

CREATE TABLE `verification_tbl` (
  `VerificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `Suffix` varchar(10) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_tbl`
--

INSERT INTO `verification_tbl` (`VerificationID`, `UserID`, `FirstName`, `LastName`, `MiddleName`, `Suffix`, `Username`, `Image`) VALUES
(31, 10, 'er', 'jho', 'q', 'er', 'jho', '1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountaccesslogs_tbl`
--
ALTER TABLE `accountaccesslogs_tbl`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `barangaycertificate_tbl`
--
ALTER TABLE `barangaycertificate_tbl`
  ADD PRIMARY KEY (`CertificateID`);

--
-- Indexes for table `barangayofficials_tbl`
--
ALTER TABLE `barangayofficials_tbl`
  ADD PRIMARY KEY (`BrgyOfficialId`);

--
-- Indexes for table `blotterrecords_tbl`
--
ALTER TABLE `blotterrecords_tbl`
  ADD PRIMARY KEY (`BlotterID`),
  ADD KEY `fk_BlotterRecords_StatusID` (`StatusID`);

--
-- Indexes for table `blotterstatus_tbl`
--
ALTER TABLE `blotterstatus_tbl`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `brgyindigencycertificate_tbl`
--
ALTER TABLE `brgyindigencycertificate_tbl`
  ADD PRIMARY KEY (`IndigencyCertID`);

--
-- Indexes for table `cluster_tbl`
--
ALTER TABLE `cluster_tbl`
  ADD PRIMARY KEY (`ClusterID`);

--
-- Indexes for table `docutype_tbl`
--
ALTER TABLE `docutype_tbl`
  ADD PRIMARY KEY (`DocuTypeID`);

--
-- Indexes for table `householdsummary_tbl`
--
ALTER TABLE `householdsummary_tbl`
  ADD PRIMARY KEY (`HouseholdSummaryID`),
  ADD KEY `HouseholdID` (`HouseholdID`);

--
-- Indexes for table `household_tbl`
--
ALTER TABLE `household_tbl`
  ADD PRIMARY KEY (`HouseholdID`);

--
-- Indexes for table `positions_tbl`
--
ALTER TABLE `positions_tbl`
  ADD PRIMARY KEY (`PositionId`);

--
-- Indexes for table `requestforsomeone_tbl`
--
ALTER TABLE `requestforsomeone_tbl`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`RequestId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `residents_tbl`
--
ALTER TABLE `residents_tbl`
  ADD PRIMARY KEY (`ResidentID`),
  ADD KEY `fk_Residents_tbl_ClusterID` (`ClusterID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `fk_RoleID` (`RoleID`);

--
-- Indexes for table `verification_tbl`
--
ALTER TABLE `verification_tbl`
  ADD PRIMARY KEY (`VerificationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountaccesslogs_tbl`
--
ALTER TABLE `accountaccesslogs_tbl`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `barangaycertificate_tbl`
--
ALTER TABLE `barangaycertificate_tbl`
  MODIFY `CertificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barangayofficials_tbl`
--
ALTER TABLE `barangayofficials_tbl`
  MODIFY `BrgyOfficialId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blotterrecords_tbl`
--
ALTER TABLE `blotterrecords_tbl`
  MODIFY `BlotterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blotterstatus_tbl`
--
ALTER TABLE `blotterstatus_tbl`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brgyindigencycertificate_tbl`
--
ALTER TABLE `brgyindigencycertificate_tbl`
  MODIFY `IndigencyCertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cluster_tbl`
--
ALTER TABLE `cluster_tbl`
  MODIFY `ClusterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `docutype_tbl`
--
ALTER TABLE `docutype_tbl`
  MODIFY `DocuTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `householdsummary_tbl`
--
ALTER TABLE `householdsummary_tbl`
  MODIFY `HouseholdSummaryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `household_tbl`
--
ALTER TABLE `household_tbl`
  MODIFY `HouseholdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `positions_tbl`
--
ALTER TABLE `positions_tbl`
  MODIFY `PositionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requestforsomeone_tbl`
--
ALTER TABLE `requestforsomeone_tbl`
  MODIFY `requestID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `RequestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `residents_tbl`
--
ALTER TABLE `residents_tbl`
  MODIFY `ResidentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `verification_tbl`
--
ALTER TABLE `verification_tbl`
  MODIFY `VerificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountaccesslogs_tbl`
--
ALTER TABLE `accountaccesslogs_tbl`
  ADD CONSTRAINT `accountaccesslogs_tbl_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users_tbl` (`UserID`),
  ADD CONSTRAINT `accountaccesslogs_tbl_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);

--
-- Constraints for table `blotterrecords_tbl`
--
ALTER TABLE `blotterrecords_tbl`
  ADD CONSTRAINT `fk_BlotterRecords_StatusID` FOREIGN KEY (`StatusID`) REFERENCES `blotterstatus_tbl` (`StatusID`);

--
-- Constraints for table `householdsummary_tbl`
--
ALTER TABLE `householdsummary_tbl`
  ADD CONSTRAINT `householdsummary_tbl_ibfk_1` FOREIGN KEY (`HouseholdID`) REFERENCES `household_tbl` (`HouseholdID`);

--
-- Constraints for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD CONSTRAINT `request_tbl_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users_tbl` (`UserID`);

--
-- Constraints for table `residents_tbl`
--
ALTER TABLE `residents_tbl`
  ADD CONSTRAINT `fk_Residents_tbl_ClusterID` FOREIGN KEY (`ClusterID`) REFERENCES `cluster_tbl` (`ClusterID`);

--
-- Constraints for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD CONSTRAINT `fk_RoleID` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
