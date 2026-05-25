-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2026 at 08:51 AM
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
-- Database: `Students`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL,
  `cityName` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `cityName`) VALUES
(3, 'lagos');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `languageID` int(11) NOT NULL,
  `languageName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languageID`, `languageName`) VALUES
(2, 'Spanish'),
(4, 'Yoruba');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `studentCity` int(11) DEFAULT NULL,
  `studentName` varchar(25) DEFAULT NULL,
  `studentSurname` varchar(25) DEFAULT NULL,
  `studentPhone` varchar(25) DEFAULT NULL,
  `studentEmail` varchar(255) DEFAULT NULL,
  `studentGender` enum('m','f','o') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentCity`, `studentName`, `studentSurname`, `studentPhone`, `studentEmail`, `studentGender`) VALUES
(28, NULL, 'John', 'Doe', '12345678', 'sample@gmail.com', 'f'),
(29, 3, 'jude', 'doe', '12345678', 'sample@gmail.com', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `studentslanguages`
--

CREATE TABLE `studentslanguages` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `languageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPassword`) VALUES
(11, 'Admin', '$2y$10$yvT6KLvHC.xwMaM/i8ALsegf6E6RnsI07XQRMJcBX7X3BntBUXXwa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`languageID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `studentCity` (`studentCity`);

--
-- Indexes for table `studentslanguages`
--
ALTER TABLE `studentslanguages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languageID` (`languageID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `languageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `studentslanguages`
--
ALTER TABLE `studentslanguages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`studentCity`) REFERENCES `cities` (`cityID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `studentslanguages`
--
ALTER TABLE `studentslanguages`
  ADD CONSTRAINT `studentslanguages_ibfk_1` FOREIGN KEY (`languageID`) REFERENCES `languages` (`languageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentslanguages_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
