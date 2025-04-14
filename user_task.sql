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
-- Table structure for table `user_task`
--

CREATE TABLE `user_task` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_tasks` int(11) NOT NULL,
  `Start_Date` date DEFAULT NULL,
  `Role` enum('Developer','Designer','Tester','Analyst','Support') DEFAULT NULL,
  `Contribution` int(11) DEFAULT NULL,
  `accept` tinyint(1) DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `stute` enum('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
  `progress` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_task`
--

INSERT INTO `user_task` (`id`, `id_user`, `id_tasks`, `Start_Date`, `Role`, `Contribution`, `accept`, `End_Date`, `stute`, `progress`) VALUES
(12, 1000000005, 5687, '2025-01-14', 'Developer', 30, 1, '2025-01-14', 'Completed', 100),
(13, 1000000006, 5687, '2025-01-14', 'Support', 30, NULL, NULL, 'Pending', 0),
(14, 1000000007, 5687, '2025-01-14', 'Developer', 30, NULL, NULL, 'Pending', 0),
(15, 1000000005, 19384, '2025-01-14', 'Developer', 33, 1, NULL, 'Pending', 0),
(16, 1000000006, 19384, '2025-01-14', 'Designer', 33, 1, NULL, 'Pending', 0),
(17, 1000000007, 19384, '2025-01-14', 'Analyst', 33, NULL, NULL, 'Pending', 0),
(18, 1000000005, 37020, '2025-01-14', 'Developer', 33, 1, NULL, 'Pending', 0),
(19, 1000000005, 37020, '2025-01-16', 'Developer', 30, 1, NULL, 'Pending', 0),
(20, 1000000006, 37020, '2025-01-14', 'Developer', 33, 1, NULL, 'Pending', 0),
(21, 1000000005, 51488, '2025-01-14', 'Developer', 33, NULL, NULL, 'Pending', 0),
(22, 1000000006, 51488, '2025-01-14', 'Developer', 33, 1, NULL, 'Pending', 0),
(23, 1000000007, 51488, '2025-01-14', 'Tester', 33, NULL, NULL, 'Pending', 0),
(24, 1000000005, 58216, '2025-01-14', 'Developer', 33, 1, NULL, 'Pending', 0),
(25, 1000000006, 58216, '2025-01-14', 'Designer', 33, 1, NULL, 'Pending', 0),
(26, 1000000007, 58216, '2025-01-14', 'Analyst', 33, NULL, NULL, 'Pending', 0),
(27, 1000000005, 5687, '2025-01-14', 'Developer', 10, NULL, NULL, 'Pending', 0),
(28, 1000000007, 5562, '2025-01-14', 'Developer', 10, NULL, NULL, 'Pending', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_task`
--
ALTER TABLE `user_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tasks` (`id_tasks`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_task`
--
ALTER TABLE `user_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_task`
--
ALTER TABLE `user_task`
  ADD CONSTRAINT `user_task_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_task_ibfk_2` FOREIGN KEY (`id_tasks`) REFERENCES `tasks` (`TaskID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
