-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 06:47 PM
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
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`) VALUES
(0, 'admin', 'a123'),
(1, 'admin', 'a123');

-- --------------------------------------------------------

--
-- Table structure for table `delivers`
--

CREATE TABLE `delivers` (
  `patient_id` int(11) NOT NULL,
  `blood_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivers`
--

INSERT INTO `delivers` (`patient_id`, `blood_id`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(11) NOT NULL,
  `doc_name` varchar(20) DEFAULT NULL,
  `doc_phoneno` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `doc_name`, `doc_phoneno`) VALUES
(44, 'Hari', '23456'),
(45, 'rekha', '32456'),
(46, 'Mahesh', '87654');

-- --------------------------------------------------------

--
-- Table structure for table `donate`
--

CREATE TABLE `donate` (
  `blood_id` int(11) NOT NULL,
  `bloodtype` varchar(10) DEFAULT NULL,
  `bloodbank_name` varchar(20) DEFAULT NULL,
  `bloodbank_address` varchar(40) DEFAULT NULL,
  `donor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donate`
--

INSERT INTO `donate` (`blood_id`, `bloodtype`, `bloodbank_name`, `bloodbank_address`, `donor_id`) VALUES
(6, 'a+', 'Father Mullers', 'Kankanady', NULL),
(19, 'a+', 'KMC', 'Attavar', NULL),
(20, 'b+', 'Father Mullers', 'Kankanady', NULL),
(21, 'o+', 'AJ', 'Kuntikana', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `phone_no` varchar(10) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `doc_name` varchar(20) DEFAULT NULL,
  `doc_phoneno` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `name`, `address`, `dob`, `weight`, `phone_no`, `gender`, `doc_name`, `doc_phoneno`) VALUES
(45, 'Megha', 'Bangalore', '2000-08-14', '45', '88377474', 'F', 'rekha', '32456'),
(46, 'Riya', 'Mumbai', '1997-02-11', '56', '23456', 'F', 'Mahesh', '87654');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(20) DEFAULT NULL,
  `patient_address` varchar(40) DEFAULT NULL,
  `patient_mobile` varchar(10) DEFAULT NULL,
  `hospital_address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `patient_address`, `patient_mobile`, `hospital_address`) VALUES
(11, 'Rohan', 'Bangalore', '34567', 'Bangalore'),
(12, 'Janvi', 'Mumbai', '34567', 'Chennai'),
(13, 'Khushi', 'Kerala', '46382', 'Kochi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivers`
--
ALTER TABLE `delivers`
  ADD KEY `test` (`patient_id`),
  ADD KEY `test2` (`blood_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`blood_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `donate`
--
ALTER TABLE `donate`
  MODIFY `blood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivers`
--
ALTER TABLE `delivers`
  ADD CONSTRAINT `test2` FOREIGN KEY (`blood_id`) REFERENCES `donate` (`blood_id`);

--
-- Constraints for table `donate`
--
ALTER TABLE `donate`
  ADD CONSTRAINT `donor_id` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
