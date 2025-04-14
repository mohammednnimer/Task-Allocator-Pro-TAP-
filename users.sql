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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address_flat_house_no` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `role` enum('Manager','Project Leader','Team Member') DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address_flat_house_no`, `address_street`, `address_city`, `address_country`, `date_of_birth`, `id_number`, `email`, `telephone`, `role`, `qualification`, `skills`, `Username`, `password`, `images`) VALUES
(1000000001, 'Alice Johnson', '123', 'Main Street', 'New York', 'USA', '1985-03-15', '1234567890', 'alice.johnson@example.com', '1234567890', 'Manager', 'MBA in Business Administration', 'Leadership, Management', 'ahmad nemer', '123', '6.jpg'),
(1000000002, 'mohmad nemer', '456', 'Elm Street', 'Los Angeles', 'USA', '1990-07-10', '9876543210', 'bob.smith@example.com', '9876543210', 'Project Leader', 'BSc in Computer Science', 'Planning, Coordination', 'mohammad nemer', '123', '1.jpg'),
(1000000003, 'Charlie Davis', '789', 'Oak Street', 'Chicago', 'USA', '1992-12-25', '1122334455', 'charlie.davis@example.com', '1122334455', 'Project Leader', 'BSc in Information Systems', 'Team Management, Problem Solving', 'charlie', 'securepassword3', '2.jpg'),
(1000000004, 'Diana Evvans', '101', 'Pine Street', 'Houston', 'USA', '1988-05-18', '2233445566', 'diana.evans@example.com', '2233445566', 'Project Leader', 'MSc in Project Management', 'Leadership, Team Building', 'diana', 'securepassword4', '3.jpg'),
(1000000005, 'khaled Brown', '202', 'Cedar Street', 'Miami', 'USA', '1995-01-30', '3344556677', 'ethan.brown@example.com', '3344556677', 'Team Member', 'BSc in Engineering', 'Technical Skills, Problem Solving', 'laith', '123', '7.png'),
(1000000006, 'fares habeb', '303', 'Maple Street', 'Seattle', 'USA', '1993-08-20', '4455667788', 'fiona.green@example.com', '4455667788', 'Team Member', 'BSc in Computer Science', 'Coding, Collaboration', 'fiona', 'securepassword6', '4.jpg'),
(1000000007, 'George Harris', '404', 'Birch Street', 'Boston', 'USA', '1998-11-12', '5566778899', 'george.harris@example.com', '5566778899', 'Team Member', 'Diploma in IT', 'Testing, Communication', 'george', 'securepassword7', '5.jpg'),
(3829824275, 'Laith Nader', 'nmxmncxm', 'Ramallah', 'Ramallah', 'Palestine', '2025-01-23', '234321237834', 'mohammadnemer@gmail.com', '0569158248', 'Project Leader', 'mncx', 'nmxc', 'nemer hamma', '123321moh', 'photo.jpg'),
(5125806836, 'Laith Nader', '345', 'Ramallah', 'Ramallah', 'Palestine', '2025-01-24', '23432123', 'manmxger@maktoob.com', '8912982390', 'Manager', 'nmxcc', 'hhss', 'ahmad nem32', '12345moh1', '1.jpg'),
(6863917334, 'Laith Nader', 'nmxmncxm', 'Ramallah', 'Ramallah', 'Palestine', '2025-01-23', '234321237834', 'mohammadnemer@gmail.com', '0569158248', 'Project Leader', 'mncx', 'nmxc', 'hammm nemer', '123321moh', 'photo.jpg'),
(8232337021, 'Laith Nader', 'nmxmncxm', 'Ramallah', 'Ramallah', 'Palestine', '2025-01-23', '234321237834', 'mohammadnemer@gmail.com', '0569158248', 'Project Leader', 'mncx', 'nmxc', 'hammm nemer', '123321moh', 'photo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8232337022;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
