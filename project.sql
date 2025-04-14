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
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` varchar(11) NOT NULL,
  `project_title` varchar(255) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `total_budget` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `file1_name` varchar(255) DEFAULT NULL,
  `file2_name` varchar(255) DEFAULT NULL,
  `file3_name` varchar(255) DEFAULT NULL,
  `Leaderid` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_title`, `project_description`, `customer_name`, `total_budget`, `start_date`, `end_date`, `file1_name`, `file2_name`, `file3_name`, `Leaderid`) VALUES
('1', 'Website Development', 'Developing a responsive website for the client.', 'John Doe', 15000.00, '2025-01-08', '2025-03-15', NULL, NULL, NULL, 1000000002),
('10', 'Social Media Platform', 'Building a social media platform for clients.', 'David Brown', 20000.00, '2025-02-01', '2025-06-01', NULL, NULL, NULL, 1000000002),
('2', 'Mobile App', 'Creating a cross-platform mobile application.', 'Jane Smith', 20000.00, '2025-02-01', '2025-04-30', NULL, NULL, NULL, 1000000002),
('3', 'E-commerce Platform', 'Building an online shopping platform.', 'Alice Brown', 30000.00, '2025-03-10', '2025-06-20', NULL, NULL, NULL, 1000000002),
('4', 'Cloud Migration', 'Migrating client services to a cloud platform.', 'Bob Johnson', 25000.00, '2025-04-05', '2025-07-10', NULL, NULL, NULL, 1000000002),
('5', 'Data Analytics', 'Implementing a data analytics solution for the client.', 'Charlie Davis', 18000.00, '2025-05-15', '2025-08-25', NULL, NULL, NULL, 1000000002),
('7', 'CRM Software', 'Building customer relationship management software.', 'Liam Anderson', 18000.00, '2025-05-01', '2025-09-01', NULL, NULL, NULL, NULL),
('8', 'Inventory System', 'Developing a system to manage inventory.', 'Olivia Taylor', 30000.00, '2025-04-01', '2025-08-01', NULL, NULL, NULL, NULL),
('9', 'E-learning Website', 'Creating an online education platform.', 'Emma Wilson', 25000.00, '2025-03-01', '2025-07-01', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `Leaderid` (`Leaderid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`Leaderid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
