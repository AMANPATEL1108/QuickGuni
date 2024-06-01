-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 02:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quickguni`
--

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `phone`, `address`, `subject`, `created_at`) VALUES
(2, 'Elon Musk', 'elon.musk@spacex.com', '+111222333', 'Florida, USA', 'MAD', '2024-02-24 16:34:01'),
(3, 'Will Smith', 'will.smith@gmail.com', '+111333555', 'California, USA', 'SP', '2024-02-24 16:34:01'),
(4, 'Bob Marley', 'bob@gmail.com', '+111555999', 'Texas, USA', 'TOC', '2024-02-24 16:34:01'),
(5, 'Cristiano Ronaldo', 'cristiano.ronaldo@gmail.com', '+32447788993', 'Manchester, England', 'AI', '2024-02-24 16:34:01'),
(6, 'Boris Johnson', 'boris.johnson@gmail.com', '+4499778855', 'London, England', 'WT', '2024-02-24 16:34:01'),
(7, 'Teacher 1', 'Teacher1@gmail.com', 'ASD', 'Ganpat1', 'ASD', '2024-02-24 16:45:43'),
(8, 'FAC1', 'faculty1@gmail.com', '1236547852', 'Guni', 'ASD', '2024-02-24 16:46:16'),
(9, 'FAC2', 'faculty2@gmail.com', '4563217890', 'guni1', 'MAD', '2024-02-24 16:54:40'),
(10, 'FAC3', 'fac3@gmail.com', '7896541236', 'MODA', 'ZXC', '2024-02-24 17:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `todo_list`
--

CREATE TABLE `todo_list` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `enrollment_number` varchar(20) NOT NULL,
  `accommodation` enum('hosteller','traveller') NOT NULL,
  `current_semester` varchar(50) NOT NULL,
  `marks_mad` int(11) NOT NULL,
  `marks_nodejs` int(11) NOT NULL,
  `marks_cn` int(11) NOT NULL,
  `marks_software_packages` int(11) NOT NULL,
  `marks_software_engi` int(11) NOT NULL,
  `join_date` date DEFAULT NULL,
  `class_batch` varchar(20) DEFAULT NULL,
  `current_degree` varchar(50) DEFAULT NULL,
  `lab_attendance_mad` int(11) DEFAULT NULL,
  `lab_attendance_nodejs` int(11) DEFAULT NULL,
  `lab_attendance_cn` int(11) DEFAULT NULL,
  `lab_attendance_software_packages` int(11) DEFAULT NULL,
  `lab_attendance_software_engi` int(11) DEFAULT NULL,
  `lec_attendance_mad` int(11) DEFAULT NULL,
  `lec_attendance_nodejs` int(11) DEFAULT NULL,
  `lec_attendance_cn` int(11) DEFAULT NULL,
  `lec_attendance_software_packages` int(11) DEFAULT NULL,
  `lec_attendance_software_engi` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `password`, `address`, `phone_number`, `enrollment_number`, `accommodation`, `current_semester`, `marks_mad`, `marks_nodejs`, `marks_cn`, `marks_software_packages`, `marks_software_engi`, `join_date`, `class_batch`, `current_degree`, `lab_attendance_mad`, `lab_attendance_nodejs`, `lab_attendance_cn`, `lab_attendance_software_packages`, `lab_attendance_software_engi`, `lec_attendance_mad`, `lec_attendance_nodejs`, `lec_attendance_cn`, `lec_attendance_software_packages`, `lec_attendance_software_engi`, `is_admin`) VALUES
(2, 'Jane', 'Smith', 'Jane Smith', 'jane@examples.com', '$2y$10$cYHw/XUPi0OGJhiAFp/e6exIuBbY/GqUqw1DQIiMn2Ly7fA6u7qfK', '456asd', '666-523', 'E2020102', 'hosteller', '1', 55, 49, 4, 5, 6, '2021-09-16', 'CSE2021', 'B.Tech', 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 0),
(3, 'Alex ', 'Johnson', 'Alex Johnson', 'alex@example.com', 'abc@123', '456asd', '555-9876', 'E2020103', 'hosteller', '2', 92, 88, 80, 85, 90, '2022-03-05', 'CSE2023', 'B.Tech', 85, 92, 78, 80, 88, 90, 85, 80, 92, 78, 0),
(4, 'Emily', 'Davis', 'Emily Davis', 'emily@example.com', 'qwerty', '345 Elm St', '555-5432', 'E2020104', 'traveller', '3', 80, 92, 88, 78, 85, '2021-12-10', 'CSE2022', 'B.Tech', 78, 90, 87, 88, 92, 78, 80, 88, 85, 90, 0),
(5, 'Michael', 'Brown', 'Michael Brown', 'michael@example.com', 'p@ssW0rd', '678 Maple St', '555-8765', 'E2020105', 'traveller', '4', 88, 78, 85, 90, 87, '2022-06-20', 'CSE2021', 'B.Tech', 92, 80, 90, 78, 85, 90, 87, 78, 92, 80, 0),
(6, 'Sarah', 'Wilson', 'Sarah Wilson', 'sarah@example.com', 'abcd1234', '890 Cedar St', '555-4321', 'E2020106', 'hosteller', '2', 90, 87, 78, 92, 80, '2022-02-28', 'CSE2023', 'B.Tech', 78, 85, 90, 87, 92, 78, 90, 92, 80, 85, 0),
(7, 'Ryan', 'Miller', 'Ryan Miller', 'ryan@example.com', 'passPass123', '123asd', '25632145', 'E2020107', 'hosteller', '3', 85, 20, 87, 78, 92, '2021-10-05', 'CSE2022', 'B.Tech', 92, 88, 80, 90, 78, 85, 90, 80, 88, 78, 0),
(8, NULL, NULL, 'Olivia Lee', 'olivia@example.com', 'leeOlivia45', '456 Banana St', '555-6543', 'E2020108', '', '4', 78, 85, 90, 87, 80, '2022-04-15', 'CSE2021', 'B.Tech', 80, 90, 78, 85, 92, 78, 85, 78, 90, 92, 0),
(16, 'Admin', 'Patel', 'Admin Patel', 'admin@gmail.com', '$2y$10$neeV5rhVD0L6.O8wMVoQa.8gXUuBCq.jFqiA02R0K4p9yDuI.O0Tm', 'Bayad', '1577878989789', 'GUNI0123547893', 'traveller', '6', 87, 89, 58, 45, 87, '2024-01-17', 'C-C1', 'IT', 25, 21, 54, 51, 14, 57, 25, 10, 45, 51, 1),
(20, 'Mitashu', 'Patel', 'Mitashu Patel', 'mj@gmail.com', '$2y$10$EvggepR3LAGtKbBBC/RfuOzzROUoI6Mx2CYTSTbulmnxEp24REDTi', 'Kapadwanj, Gujarat', '7985264897', 'E2020256', 'hosteller', '8', 78, 89, 67, 89, 56, '2024-01-24', 'C-C1', 'Information Technology', 90, 78, 58, 69, 80, 60, 48, 76, 64, 67, 1),
(21, 'Erio', 'Warner', 'Erio Warner', 'erio@gmail.com', '$2y$10$HUYYOse5zW.Bk4GhWuwjZu71tFGcuvXiGz.jPoenEDA40Ng5xAbN2', 'd', '21312323', '213231', 'hosteller', '1', 2, 32, 324, 34, 324, '0000-00-00', 'vhd', 'Information Technology', 342, 324, 324, 33, 43, 43, 44, 34, 34, 54, 0),
(22, 'Harsh', 'Patel', 'Harsh Patel', 'hj@gmail.com', '$2y$10$Tf3.V42DoNK1xhAnQ8pQAuncyZGL5jhikLNTFK7E.HdLfCcDNlP2G', 'Bayad', '1577878989789', 'GUNI012354789', 'hosteller', '25', 56, 55, 45, 25, 48, '2023-12-20', 'CSE2024', 'Doctor', 47, 58, 54, 15, 57, 74, 87, 88, 51, 25, 0),
(25, 'Suresh', 'Panchal', 'Suresh Panchal', 'suresh@g.com', '$2y$10$X4ogd0ti1ZYmIjrqda7tBu4phm062wMzRoW9bkn8XZ4.f2p0z/2LC', 'bayad', '2458558', 'Has223', 'traveller', '24', 54, 24, 21, 15, 25, '2024-01-01', 'C-C1', 'IT', 45, 57, 54, 27, 87, 457, 78, 87, 87, 47, 0),
(26, 'Sagars', 'Patel', 'Sagars Patel', 'sagar@gmail.com', '$2y$10$oLe2jsXVHW2OPXSdsiDjcOw/zx8q5NfMjEB3S6AIE06la4hFT9ZKC', 'Balasinors', '0123456881', 'GUNI01235471451', 'traveller', '61', 231, 431, 341, 451, 561, '1999-02-04', 'Bs', 'B.Techs', 761, 561, 671, 871, 501, 471, 901, 891, 231, 400, 0),
(27, 'Sachin', 'Prajapati', 'Sachin Prajapati', 'sm@gmail.com', '$2y$10$8a8wZ9gaBAGIo78ZC6ACLe79Ka04/UJUqvGj6oyBlutweSUI2Yg2C', 'bayad', '123456789', 'HI12JIo', 'hosteller', '4', 34, 67, 54, 77, 55, '1997-02-12', 'V1', 'IT', 34, 89, 56, 34, 54, 56, 345, 5674, 4564, 4654, 0),
(68, NULL, NULL, '', '', '$2y$10$xYLMiAIHEZvjBEGbGc4tLuGTbjf/8K5NvWlndnz.LjeO1VKiDxUlW', '', NULL, '', '', '', 32, 50, 44, 42, 13, NULL, NULL, NULL, 82, 76, 43, 19, 52, 18, 47, 74, 12, 37, 0),
(69, 'Faculty', 'Uvpce', 'Faculty Uvpce', 'faculty@gmail.com', '$2y$10$cnWVRkrccQrWAOLnnYCgReEi8U4yZ4Mtkh9f9L8GjDPj8XffR58nq', 'Uvpce', '4563214785', 'F063', 'traveller', '00', 0, 0, 0, 0, 0, '2024-02-08', 'F-F1', 'm-tech', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `todo_list`
--
ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
