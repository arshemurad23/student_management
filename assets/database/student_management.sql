-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 06:57 PM
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
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee_user`
--

CREATE TABLE `fee_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `primary_name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `cpasword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_user`
--

INSERT INTO `fee_user` (`id`, `name`, `email`, `username`, `primary_name`, `img`, `pasword`, `cpasword`) VALUES
(1, 'Fee System', 'feemanagement@studentmanageent.net', 'feesystem', 'managefee', 'post-1528690670-image_fileuser_id_2.png', 'fee123', 'fee123');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `primary_name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `cpasword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `uname`, `primary_name`, `img`, `pasword`, `cpasword`) VALUES
(6, 'admin', 'admin@studentmanagement.net', 'admin', 'admin_management', 'Student-Management-System.png', 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee`
--

CREATE TABLE `student_fee` (
  `std_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `coures` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `fee_submit_date` date NOT NULL,
  `fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_fee`
--

INSERT INTO `student_fee` (`std_id`, `name`, `email`, `coures`, `class_name`, `fee_submit_date`, `fee`) VALUES
(1, 'Arsh e Murad ', 'arshemurad@gmail.com', 'dism', 'class_4', '2024-09-07', 600);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_details`
--

CREATE TABLE `teacher_details` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `primary_name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `cpasword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_details`
--

INSERT INTO `teacher_details` (`id`, `name`, `email`, `username`, `primary_name`, `img`, `pasword`, `cpasword`) VALUES
(1, 'ali khan', 'alikhan@aptechsite.net', 'Ali-Khan', 'islamiya', 'FB_IMG_1685138209205.jpg', 'ali901', 'ali901'),
(2, 'Sar Hamza', 'hamza@gmail.com', 'hamza25', 'khanschool', 'FB_IMG_1685138193491.jpg', 'hjk', 'hjk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee_user`
--
ALTER TABLE `fee_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `primary_name` (`primary_name`),
  ADD UNIQUE KEY `pasword` (`pasword`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `primary_name` (`primary_name`),
  ADD UNIQUE KEY `pasword` (`pasword`);

--
-- Indexes for table `teacher_details`
--
ALTER TABLE `teacher_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `primary_name` (`primary_name`),
  ADD UNIQUE KEY `pasword` (`pasword`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fee_user`
--
ALTER TABLE `fee_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher_details`
--
ALTER TABLE `teacher_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
