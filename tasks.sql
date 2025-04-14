-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 12:56 PM
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
-- Database: `projectt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int(11) NOT NULL,
  `TaskName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `ProjectID` varchar(255) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Effort` int(11) DEFAULT NULL,
  `Status` enum('Pending','In Progress','Completed') DEFAULT NULL,
  `Priority` enum('Low','Medium','High') DEFAULT NULL,
  `Progress` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskID`, `TaskName`, `Description`, `ProjectID`, `StartDate`, `EndDate`, `Effort`, `Status`, `Priority`, `Progress`) VALUES
(5562, 'task10', 'task10', '10', '2025-01-09', '2025-01-24', 14, 'Pending', 'Medium', 0),
(5687, 'task2', 'task22', '1', '2025-01-09', '2025-01-16', 30, 'In Progress', 'Low', 30),
(19384, 'task8', 'task888', '1', '2025-01-03', '2025-01-24', 20, 'Pending', 'High', 0),
(37020, 'task3', 'task333', '1', '2025-01-08', '2025-01-22', 20, 'Pending', 'High', 0),
(51488, 'task9', 'task999', '1', '2025-01-02', '2025-01-24', 20, 'Pending', 'Medium', 0),
(58216, 'task7', 'task7777', '1', '2025-01-02', '2025-01-23', 20, 'Pending', 'Low', 0),
(79067, 'task6', 'task6', '1', '2025-01-02', '2025-01-23', 20, 'Pending', 'Low', 0),
(86648, 'task4', 'task1', '1', '2025-01-15', '2025-01-16', 20, 'Pending', 'Medium', 0),
(86894, 'task5', 'task55', '1', '2025-01-09', '2025-01-24', 20, 'Pending', 'Medium', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98788;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `project` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
