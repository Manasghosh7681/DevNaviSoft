-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 07:59 AM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `password`) VALUES
('admin@silicon.ac.in', 'silicon@123');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `sic` varchar(8) NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `complaint_description` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `apply_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`sic`, `complaint_type`, `complaint_description`, `file`, `status`, `apply_date`) VALUES
('23mmci79', 'electrical', 'Room fan is not working properly', 'Id card.jpg', 'Approved', '23-03-2025 10:47:53 AM'),
('23mmci85', 'plumbing', 'Bathrooms taps is broken', 'empty', 'Rejected', '23-03-2025 10:56:01 AM'),
('23mmci85', 'cleanliness', 'Since 2days our floor has not clean', 'Resume.pdf', 'Approved', '23-03-2025 10:57:30 AM'),
('23mmci85', 'room', 'Some thing problem in our room', 'empty', 'Pending', '23-03-2025 11:45:45 AM'),
('23mmci44', 'discipline', 'Ragging', 'empty', 'Pending', '23-03-2025 11:46:54 AM');

-- --------------------------------------------------------

--
-- Table structure for table `leave_request`
--

CREATE TABLE `leave_request` (
  `sno` int(11) NOT NULL,
  `sic` varchar(255) NOT NULL,
  `apply_date` varchar(255) NOT NULL,
  `leave_days` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_request`
--

INSERT INTO `leave_request` (`sno`, `sic`, `apply_date`, `leave_days`, `destination`, `contact_no`, `reason`, `status`) VALUES
(1, '22vlsi44', '20-02-2025 11:58:26 AM', '2025-02-22 11:00 TO 2025-02-28 11:00', 'Home', 8093547586, 'I will go to office', 'Withdraw'),
(5, '22vlsi44', '22-03-2025 09:59:20 AM', '2025-03-27 11:00 TO 2025-03-29 10:00', 'Puri', 8093547586, 'I will go to Puri', 'Rejected'),
(8, '23mmci79', '22-03-2025 20:46:41 PM', '2025-03-24 01:00 TO 2025-03-30 02:00', 'Home', 8093547586, 'I will go home for family function', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `notice_date` date NOT NULL,
  `notice_description` varchar(255) NOT NULL,
  `notice_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_title`, `notice_date`, `notice_description`, `notice_file`) VALUES
(2, 'Holi', '2025-03-10', 'gfdtd jfyj yjvdhhtgh', 'Assignment-11 (PHP, AJAX).docx'),
(3, 'New year', '2024-12-31', 'New Year Celebration', 'intership diary.pdf'),
(4, 'Sivaratri', '2025-02-26', 'Maha sivaratri', 'Id card.jpg'),
(5, 'Republic Day', '2025-01-26', 'Happy Republic Day', 'MyResume.pdf'),
(6, 'Independence Day', '2025-08-15', 'Happy Independence Day', 'CV Template.docx'),
(7, 'Birth Day', '2002-07-24', 'Haapy Birth Day', 'empty'),
(8, 'Zygon', '2025-02-25', 'Zygon Notice', 'empty'),
(10, 'Presentation', '2025-04-05', 'kjbiu  99ugbk', 'empty');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_request`
--
ALTER TABLE `leave_request`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_request`
--
ALTER TABLE `leave_request`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
