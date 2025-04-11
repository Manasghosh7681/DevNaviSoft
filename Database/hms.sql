-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 04:31 PM
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
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_id` varchar(255) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bed_id`, `room_id`, `status`) VALUES
('BH1-01A', 'BH1-01', 'Vacant'),
('BH1-01B', 'BH1-01', 'Vacant'),
('BH1-01C', 'BH1-01', 'Vacant'),
('BH1-01D', 'BH1-01', 'Vacant'),
('BH1-02A', 'BH1-02', 'Vacant'),
('BH1-02B', 'BH1-02', 'Vacant'),
('BH1-02C', 'BH1-02', 'Vacant'),
('BH1-02D', 'BH1-02', 'Vacant'),
('BH1-03A', 'BH1-03', 'Vacant'),
('BH1-03B', 'BH1-03', 'Vacant'),
('BH1-03C', 'BH1-03', 'Vacant'),
('BH1-03D', 'BH1-03', 'Vacant'),
('BH1-04A', 'BH1-04', 'Vacant'),
('BH1-04B', 'BH1-04', 'Vacant'),
('BH1-04C', 'BH1-04', 'Vacant'),
('BH1-04D', 'BH1-04', 'Vacant'),
('BH1-05A', 'BH1-05', 'Vacant'),
('BH1-05B', 'BH1-05', 'Vacant'),
('BH1-05C', 'BH1-05', 'Vacant'),
('BH1-05D', 'BH1-05', 'Vacant'),
('BH1-06A', 'BH1-06', 'Vacant'),
('BH1-06B', 'BH1-06', 'Vacant'),
('BH1-06C', 'BH1-06', 'Vacant'),
('BH1-06D', 'BH1-06', 'Vacant'),
('BH1-07A', 'BH1-07', 'Vacant'),
('BH1-07B', 'BH1-07', 'Vacant'),
('BH1-07C', 'BH1-07', 'Vacant'),
('BH1-07D', 'BH1-07', 'Vacant'),
('BH1-08A', 'BH1-08', 'Vacant'),
('BH1-08B', 'BH1-08', 'Vacant'),
('BH1-08C', 'BH1-08', 'Vacant'),
('BH1-08D', 'BH1-08', 'Vacant'),
('BH1-09A', 'BH1-09', 'Vacant'),
('BH1-09B', 'BH1-09', 'Vacant'),
('BH1-09C', 'BH1-09', 'Vacant'),
('BH1-09D', 'BH1-09', 'Vacant'),
('BH1-10A', 'BH1-10', 'Vacant'),
('BH1-10B', 'BH1-10', 'Vacant'),
('BH1-10C', 'BH1-10', 'Vacant'),
('BH1-10D', 'BH1-10', 'Vacant'),
('BH1-11A', 'BH1-11', 'Vacant'),
('BH1-11B', 'BH1-11', 'Vacant'),
('BH1-11C', 'BH1-11', 'Vacant'),
('BH1-11D', 'BH1-11', 'Vacant'),
('BH1-12A', 'BH1-12', 'Vacant'),
('BH1-12B', 'BH1-12', 'Vacant'),
('BH1-12C', 'BH1-12', 'Vacant'),
('BH1-12D', 'BH1-12', 'Vacant'),
('BH1-13A', 'BH1-13', 'Vacant'),
('BH1-13B', 'BH1-13', 'Vacant'),
('BH1-13C', 'BH1-13', 'Vacant'),
('BH1-13D', 'BH1-13', 'Vacant'),
('BH1-14A', 'BH1-14', 'Vacant'),
('BH1-14B', 'BH1-14', 'Vacant'),
('BH1-14C', 'BH1-14', 'Vacant'),
('BH1-14D', 'BH1-14', 'Vacant'),
('BH1-15A', 'BH1-15', 'Vacant'),
('BH1-15B', 'BH1-15', 'Vacant'),
('BH1-15C', 'BH1-15', 'Vacant'),
('BH1-15D', 'BH1-15', 'Vacant'),
('BH1-16A', 'BH1-16', 'Vacant'),
('BH1-16B', 'BH1-16', 'Vacant'),
('BH1-16C', 'BH1-16', 'Vacant'),
('BH1-17A', 'BH1-17', 'Vacant'),
('BH1-17B', 'BH1-17', 'Vacant'),
('BH1-17C', 'BH1-17', 'Vacant'),
('BH1-18A', 'BH1-18', 'Vacant'),
('BH1-18B', 'BH1-18', 'Vacant'),
('BH1-18C', 'BH1-18', 'Vacant'),
('BH1-19A', 'BH1-19', 'Vacant'),
('BH1-19B', 'BH1-19', 'Vacant'),
('BH1-19C', 'BH1-19', 'Vacant'),
('BH1-20A', 'BH1-20', 'Vacant'),
('BH1-20B', 'BH1-20', 'Vacant'),
('BH1-20C', 'BH1-20', 'Vacant'),
('BH2-01A', 'BH2-01', 'Vacant'),
('BH2-01B', 'BH2-01', 'Vacant'),
('BH2-01C', 'BH2-01', 'Vacant'),
('BH2-01D', 'BH2-01', 'Vacant'),
('BH2-02A', 'BH2-02', 'Vacant'),
('BH2-02B', 'BH2-02', 'Vacant'),
('BH2-02C', 'BH2-02', 'Vacant'),
('BH2-02D', 'BH2-02', 'Vacant'),
('BH2-03A', 'BH2-03', 'Vacant'),
('BH2-03B', 'BH2-03', 'Vacant'),
('BH2-03C', 'BH2-03', 'Vacant'),
('BH2-03D', 'BH2-03', 'Vacant'),
('BH2-04A', 'BH2-04', 'Vacant'),
('BH2-04B', 'BH2-04', 'Vacant'),
('BH2-04C', 'BH2-04', 'Vacant'),
('BH2-04D', 'BH2-04', 'Vacant'),
('BH2-05A', 'BH2-05', 'Vacant'),
('BH2-05B', 'BH2-05', 'Vacant'),
('BH2-05C', 'BH2-05', 'Vacant'),
('BH2-05D', 'BH2-05', 'Vacant'),
('BH2-06A', 'BH2-06', 'Vacant'),
('BH2-06B', 'BH2-06', 'Vacant'),
('BH2-06C', 'BH2-06', 'Vacant'),
('BH2-06D', 'BH2-06', 'Vacant'),
('BH2-07A', 'BH2-07', 'Vacant'),
('BH2-07B', 'BH2-07', 'Vacant'),
('BH2-07C', 'BH2-07', 'Vacant'),
('BH2-07D', 'BH2-07', 'Vacant'),
('BH2-08A', 'BH2-08', 'Vacant'),
('BH2-08B', 'BH2-08', 'Vacant'),
('BH2-08C', 'BH2-08', 'Vacant'),
('BH2-08D', 'BH2-08', 'Vacant'),
('BH2-09A', 'BH2-09', 'Vacant'),
('BH2-09B', 'BH2-09', 'Vacant'),
('BH2-09C', 'BH2-09', 'Vacant'),
('BH2-09D', 'BH2-09', 'Vacant'),
('BH2-10A', 'BH2-10', 'Vacant'),
('BH2-10B', 'BH2-10', 'Vacant'),
('BH2-10C', 'BH2-10', 'Vacant'),
('BH2-10D', 'BH2-10', 'Vacant'),
('BH2-11A', 'BH2-11', 'Vacant'),
('BH2-11B', 'BH2-11', 'Vacant'),
('BH2-11C', 'BH2-11', 'Vacant'),
('BH2-11D', 'BH2-11', 'Vacant'),
('BH2-12A', 'BH2-12', 'Vacant'),
('BH2-12B', 'BH2-12', 'Vacant'),
('BH2-12C', 'BH2-12', 'Vacant'),
('BH2-12D', 'BH2-12', 'Vacant'),
('BH2-13A', 'BH2-13', 'Vacant'),
('BH2-13B', 'BH2-13', 'Vacant'),
('BH2-13C', 'BH2-13', 'Vacant'),
('BH2-13D', 'BH2-13', 'Vacant'),
('BH2-14A', 'BH2-14', 'Vacant'),
('BH2-14B', 'BH2-14', 'Vacant'),
('BH2-14C', 'BH2-14', 'Vacant'),
('BH2-14D', 'BH2-14', 'Vacant'),
('BH2-15A', 'BH2-15', 'Vacant'),
('BH2-15B', 'BH2-15', 'Vacant'),
('BH2-15C', 'BH2-15', 'Vacant'),
('BH2-15D', 'BH2-15', 'Vacant'),
('BH2-16A', 'BH2-16', 'Vacant'),
('BH2-16B', 'BH2-16', 'Vacant'),
('BH2-16C', 'BH2-16', 'Vacant'),
('BH2-17A', 'BH2-17', 'Vacant'),
('BH2-17B', 'BH2-17', 'Vacant'),
('BH2-17C', 'BH2-17', 'Vacant'),
('BH2-18A', 'BH2-18', 'Vacant'),
('BH2-18B', 'BH2-18', 'Vacant'),
('BH2-18C', 'BH2-18', 'Vacant'),
('BH2-19A', 'BH2-19', 'Vacant'),
('BH2-19B', 'BH2-19', 'Vacant'),
('BH2-19C', 'BH2-19', 'Vacant'),
('BH2-20A', 'BH2-20', 'Vacant'),
('BH2-20B', 'BH2-20', 'Vacant'),
('BH2-20C', 'BH2-20', 'Vacant'),
('BH3-01A', 'BH3-01', 'Vacant'),
('BH3-01B', 'BH3-01', 'Vacant'),
('BH3-01C', 'BH3-01', 'Vacant'),
('BH3-01D', 'BH3-01', 'Vacant'),
('BH3-02A', 'BH3-02', 'Vacant'),
('BH3-02B', 'BH3-02', 'Vacant'),
('BH3-02C', 'BH3-02', 'Vacant'),
('BH3-02D', 'BH3-02', 'Vacant'),
('BH3-03A', 'BH3-03', 'Vacant'),
('BH3-03B', 'BH3-03', 'Vacant'),
('BH3-03C', 'BH3-03', 'Vacant'),
('BH3-03D', 'BH3-03', 'Vacant'),
('BH3-04A', 'BH3-04', 'Vacant'),
('BH3-04B', 'BH3-04', 'Vacant'),
('BH3-04C', 'BH3-04', 'Vacant'),
('BH3-04D', 'BH3-04', 'Vacant'),
('BH3-05A', 'BH3-05', 'Vacant'),
('BH3-05B', 'BH3-05', 'Vacant'),
('BH3-05C', 'BH3-05', 'Vacant'),
('BH3-05D', 'BH3-05', 'Vacant'),
('BH3-06A', 'BH3-06', 'Vacant'),
('BH3-06B', 'BH3-06', 'Vacant'),
('BH3-06C', 'BH3-06', 'Vacant'),
('BH3-06D', 'BH3-06', 'Vacant'),
('BH3-07A', 'BH3-07', 'Vacant'),
('BH3-07B', 'BH3-07', 'Vacant'),
('BH3-07C', 'BH3-07', 'Vacant'),
('BH3-07D', 'BH3-07', 'Vacant'),
('BH3-08A', 'BH3-08', 'Vacant'),
('BH3-08B', 'BH3-08', 'Vacant'),
('BH3-08C', 'BH3-08', 'Vacant'),
('BH3-08D', 'BH3-08', 'Vacant'),
('BH3-09A', 'BH3-09', 'Vacant'),
('BH3-09B', 'BH3-09', 'Vacant'),
('BH3-09C', 'BH3-09', 'Vacant'),
('BH3-09D', 'BH3-09', 'Vacant'),
('BH3-10A', 'BH3-10', 'Vacant'),
('BH3-10B', 'BH3-10', 'Vacant'),
('BH3-10C', 'BH3-10', 'Vacant'),
('BH3-10D', 'BH3-10', 'Vacant'),
('BH3-11A', 'BH3-11', 'Vacant'),
('BH3-11B', 'BH3-11', 'Vacant'),
('BH3-11C', 'BH3-11', 'Vacant'),
('BH3-11D', 'BH3-11', 'Vacant'),
('BH3-12A', 'BH3-12', 'Vacant'),
('BH3-12B', 'BH3-12', 'Vacant'),
('BH3-12C', 'BH3-12', 'Vacant'),
('BH3-12D', 'BH3-12', 'Vacant'),
('BH3-13A', 'BH3-13', 'Vacant'),
('BH3-13B', 'BH3-13', 'Vacant'),
('BH3-13C', 'BH3-13', 'Vacant'),
('BH3-13D', 'BH3-13', 'Vacant'),
('BH3-14A', 'BH3-14', 'Vacant'),
('BH3-14B', 'BH3-14', 'Vacant'),
('BH3-14C', 'BH3-14', 'Vacant'),
('BH3-14D', 'BH3-14', 'Vacant'),
('BH3-15A', 'BH3-15', 'Vacant'),
('BH3-15B', 'BH3-15', 'Vacant'),
('BH3-15C', 'BH3-15', 'Vacant'),
('BH3-15D', 'BH3-15', 'Vacant'),
('BH3-16A', 'BH3-16', 'Vacant'),
('BH3-16B', 'BH3-16', 'Vacant'),
('BH3-16C', 'BH3-16', 'Vacant'),
('BH3-17A', 'BH3-17', 'Vacant'),
('BH3-17B', 'BH3-17', 'Vacant'),
('BH3-17C', 'BH3-17', 'Vacant'),
('BH3-18A', 'BH3-18', 'Vacant'),
('BH3-18B', 'BH3-18', 'Vacant'),
('BH3-18C', 'BH3-18', 'Vacant'),
('BH3-19A', 'BH3-19', 'Vacant'),
('BH3-19B', 'BH3-19', 'Vacant'),
('BH3-19C', 'BH3-19', 'Vacant'),
('BH3-20A', 'BH3-20', 'Vacant'),
('BH3-20B', 'BH3-20', 'Vacant'),
('BH3-20C', 'BH3-20', 'Vacant'),
('GH-01A', 'GH-01', 'Vacant'),
('GH-01B', 'GH-01', 'Vacant'),
('GH-01C', 'GH-01', 'Vacant'),
('GH-01D', 'GH-01', 'Vacant'),
('GH-02A', 'GH-02', 'Vacant'),
('GH-02B', 'GH-02', 'Vacant'),
('GH-02C', 'GH-02', 'Vacant'),
('GH-02D', 'GH-02', 'Vacant'),
('GH-03A', 'GH-03', 'Vacant'),
('GH-03B', 'GH-03', 'Vacant'),
('GH-03C', 'GH-03', 'Vacant'),
('GH-03D', 'GH-03', 'Vacant'),
('GH-04A', 'GH-04', 'Vacant'),
('GH-04B', 'GH-04', 'Vacant'),
('GH-04C', 'GH-04', 'Vacant'),
('GH-04D', 'GH-04', 'Vacant'),
('GH-05A', 'GH-05', 'Vacant'),
('GH-05B', 'GH-05', 'Vacant'),
('GH-05C', 'GH-05', 'Vacant'),
('GH-05D', 'GH-05', 'Vacant'),
('GH-06A', 'GH-06', 'Vacant'),
('GH-06B', 'GH-06', 'Vacant'),
('GH-06C', 'GH-06', 'Vacant'),
('GH-06D', 'GH-06', 'Vacant'),
('GH-07A', 'GH-07', 'Vacant'),
('GH-07B', 'GH-07', 'Vacant'),
('GH-07C', 'GH-07', 'Vacant'),
('GH-07D', 'GH-07', 'Vacant'),
('GH-08A', 'GH-08', 'Vacant'),
('GH-08B', 'GH-08', 'Vacant'),
('GH-08C', 'GH-08', 'Vacant'),
('GH-08D', 'GH-08', 'Vacant'),
('GH-09A', 'GH-09', 'Vacant'),
('GH-09B', 'GH-09', 'Vacant'),
('GH-09C', 'GH-09', 'Vacant'),
('GH-09D', 'GH-09', 'Vacant'),
('GH-10A', 'GH-10', 'Vacant'),
('GH-10B', 'GH-10', 'Vacant'),
('GH-10C', 'GH-10', 'Vacant'),
('GH-10D', 'GH-10', 'Vacant'),
('GH-11A', 'GH-11', 'Vacant'),
('GH-11B', 'GH-11', 'Vacant'),
('GH-11C', 'GH-11', 'Vacant'),
('GH-11D', 'GH-11', 'Vacant'),
('GH-12A', 'GH-12', 'Vacant'),
('GH-12B', 'GH-12', 'Vacant'),
('GH-12C', 'GH-12', 'Vacant'),
('GH-12D', 'GH-12', 'Vacant'),
('GH-13A', 'GH-13', 'Vacant'),
('GH-13B', 'GH-13', 'Vacant'),
('GH-13C', 'GH-13', 'Vacant'),
('GH-13D', 'GH-13', 'Vacant'),
('GH-14A', 'GH-14', 'Vacant'),
('GH-14B', 'GH-14', 'Vacant'),
('GH-14C', 'GH-14', 'Vacant'),
('GH-14D', 'GH-14', 'Vacant'),
('GH-15A', 'GH-15', 'Vacant'),
('GH-15B', 'GH-15', 'Vacant'),
('GH-15C', 'GH-15', 'Vacant'),
('GH-15D', 'GH-15', 'Vacant'),
('GH-16A', 'GH-16', 'Vacant'),
('GH-16B', 'GH-16', 'Vacant'),
('GH-16C', 'GH-16', 'Vacant'),
('GH-17A', 'GH-17', 'Vacant'),
('GH-17B', 'GH-17', 'Vacant'),
('GH-17C', 'GH-17', 'Vacant'),
('GH-18A', 'GH-18', 'Vacant'),
('GH-18B', 'GH-18', 'Vacant'),
('GH-18C', 'GH-18', 'Vacant'),
('GH-19A', 'GH-19', 'Vacant'),
('GH-19B', 'GH-19', 'Vacant'),
('GH-19C', 'GH-19', 'Vacant'),
('GH-20A', 'GH-20', 'Vacant'),
('GH-20B', 'GH-20', 'Vacant'),
('GH-20C', 'GH-20', 'Vacant');

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
(8, '23mmci79', '22-03-2025 20:46:41 PM', '2025-03-24 01:00 TO 2025-03-30 02:00', 'Home', 8093547586, 'I will go home for family function', 'Withdraw');

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

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` varchar(255) NOT NULL,
  `room_no` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `hostel_name` varchar(255) NOT NULL,
  `bed_capacity` int(11) NOT NULL,
  `availability_beds` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_no`, `room_type`, `hostel_name`, `bed_capacity`, `availability_beds`, `status`) VALUES
('BH1-01', 1, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-02', 2, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-03', 3, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-04', 4, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-05', 5, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-06', 6, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-07', 7, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-08', 8, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-09', 9, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-10', 10, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-11', 11, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-12', 12, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-13', 13, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-14', 14, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-15', 15, 'NON-AC', 'Boys Hostel 1', 4, 4, 'Available'),
('BH1-16', 16, 'AC', 'Boys Hostel 1', 3, 3, 'Available'),
('BH1-17', 17, 'AC', 'Boys Hostel 1', 3, 3, 'Available'),
('BH1-18', 18, 'AC', 'Boys Hostel 1', 3, 3, 'Available'),
('BH1-19', 19, 'AC', 'Boys Hostel 1', 3, 3, 'Available'),
('BH1-20', 20, 'AC', 'Boys Hostel 1', 3, 3, 'Available'),
('BH2-01', 1, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-02', 2, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-03', 3, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-04', 4, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-05', 5, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-06', 6, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-07', 7, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-08', 8, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-09', 9, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-10', 10, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-11', 11, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-12', 12, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-13', 13, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-14', 14, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-15', 15, 'NON-AC', 'Boys Hostel 2', 4, 4, 'Available'),
('BH2-16', 16, 'AC', 'Boys Hostel 2', 3, 3, 'Available'),
('BH2-17', 17, 'AC', 'Boys Hostel 2', 3, 3, 'Available'),
('BH2-18', 18, 'AC', 'Boys Hostel 2', 3, 3, 'Available'),
('BH2-19', 19, 'AC', 'Boys Hostel 2', 3, 3, 'Available'),
('BH2-20', 20, 'AC', 'Boys Hostel 2', 3, 3, 'Available'),
('BH3-01', 1, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-02', 2, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-03', 3, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-04', 4, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-05', 5, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-06', 6, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-07', 7, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-08', 8, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-09', 9, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-10', 10, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-11', 11, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-12', 12, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-13', 13, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-14', 14, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-15', 15, 'NON-AC', 'Boys Hostel 3', 4, 4, 'Available'),
('BH3-16', 16, 'AC', 'Boys Hostel 3', 3, 3, 'Available'),
('BH3-17', 17, 'AC', 'Boys Hostel 3', 3, 3, 'Available'),
('BH3-18', 18, 'AC', 'Boys Hostel 3', 3, 3, 'Available'),
('BH3-19', 19, 'AC', 'Boys Hostel 3', 3, 3, 'Available'),
('BH3-20', 20, 'AC', 'Boys Hostel 3', 3, 3, 'Available'),
('GH-01', 1, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-02', 2, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-03', 3, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-04', 4, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-05', 5, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-06', 6, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-07', 7, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-08', 8, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-09', 9, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-10', 10, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-11', 11, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-12', 12, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-13', 13, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-14', 14, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-15', 15, 'NON-AC', 'Girls Hostel', 4, 4, 'Available'),
('GH-16', 16, 'AC', 'Girls Hostel', 3, 3, 'Available'),
('GH-17', 17, 'AC', 'Girls Hostel', 3, 3, 'Available'),
('GH-18', 18, 'AC', 'Girls Hostel', 3, 3, 'Available'),
('GH-19', 19, 'AC', 'Girls Hostel', 3, 3, 'Available'),
('GH-20', 20, 'AC', 'Girls Hostel', 3, 3, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `room_allocation`
--

CREATE TABLE `room_allocation` (
  `sic` varchar(8) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `bed_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sic` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `preference_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sic`, `name`, `gender`, `branch`, `year`, `contact_no`, `email`, `address`, `password`, `preference_type`) VALUES
('23adci78', 'Debasish Rout', 'Male', 'ECE', '1', 9285377101, 'debasish_rout@gmail.com', 'Badamba, Cuttack, 753001', 'Y3QocQPS', 'NON-AC'),
('23adci95', 'Suresh Sahu', 'Male', 'CSE', '1', 9772133383, 'suresh_sahu@gmail.com', 'Balianta, Jajpur, 755001', 'JLYC3FNF', 'NON-AC'),
('23aici58', 'Debasish Das', 'Male', 'M.Sc', '1', 9954016238, 'debasish_das@gmail.com', 'Banapur, Sambalpur, 768001', 'fWgMoQTo', 'NON-AC'),
('23auci65', 'Priya Tripathy', 'Female', 'CST', '1', 9115599865, 'priya_tripathy@gmail.com', 'Banapur, Puri, 752001', 'TWztlb8Y', 'NON-AC'),
('23cgci44', 'Ritu Patnaik', 'Female', 'CSE', '1', 9522772183, 'ritu_patnaik@gmail.com', 'Banapur, Berhampur, 760001', 'U02fxA8F', 'AC'),
('23cuci41', 'Chandan Nayak', 'Male', 'CST', '1', 9552027322, 'chandan_nayak@gmail.com', 'Badamba, Cuttack, 753001', 'WKKcEWT4', 'AC'),
('23cvci53', 'Amit Mohanty', 'Male', 'EEE', '1', 9428099758, 'amit_mohanty@gmail.com', 'Chandaka, Berhampur, 760001', 'q7qLyPAv', 'NON-AC'),
('23enci14', 'Sweta Patnaik', 'Female', 'M.Sc', '1', 9705118969, 'sweta_patnaik@gmail.com', 'Chandaka, Puri, 752001', 'n4sXh0vu', 'NON-AC'),
('23eoci69', 'Rakesh Behera', 'Male', 'MCA', '1', 9196747045, 'rakesh_behera@gmail.com', 'Banapur, Bhubaneswar, 751001', 'QG4FIUHG', 'AC'),
('23fbci92', 'Smita Mishra', 'Female', 'ECE', '1', 9649386761, 'smita_mishra@gmail.com', 'Chandaka, Cuttack, 753001', 'Vbp7xUiR', 'NON-AC'),
('23fdci33', 'Sweta Nayak', 'Female', 'MCA', '1', 9163502478, 'sweta_nayak@gmail.com', 'Khaira, Angul, 759122', 'JZP8Bjs9', 'NON-AC'),
('23fsci39', 'Suresh Patnaik', 'Male', 'CST', '1', 9854695780, 'suresh_patnaik@gmail.com', 'Balianta, Bhubaneswar, 751001', '2aF3vTkD', 'AC'),
('23geci53', 'Ritu Nayak', 'Female', 'CST', '1', 9995867653, 'ritu_nayak@gmail.com', 'Chandaka, Balasore, 756001', 'GWrZcprh', 'NON-AC'),
('23gjci64', 'Akash Sahu', 'Male', 'M.Sc', '1', 9301308012, 'akash_sahu@gmail.com', 'Patana, Cuttack, 753001', 'R3FiZYGT', 'NON-AC'),
('23gwci21', 'Ananya Rout', 'Female', 'EEE', '1', 9171590850, 'ananya_rout@gmail.com', 'Patana, Bhubaneswar, 751001', 'MLWVIs0Y', 'NON-AC'),
('23gxci90', 'Niharika Patnaik', 'Female', 'MCA', '1', 9247556551, 'niharika_patnaik@gmail.com', 'Banapur, Bhubaneswar, 751001', 'Lptc3lws', 'NON-AC'),
('23jjci24', 'Priya Patnaik', 'Female', 'ECE', '1', 9936205662, 'priya_patnaik@gmail.com', 'Balianta, Bhadrak, 756100', 'RJJB8V4M', 'NON-AC'),
('23joci21', 'Ananya Mohanty', 'Female', 'ECE', '1', 9660322082, 'ananya_mohanty@gmail.com', 'Badamba, Jajpur, 755001', '7d8ABcw7', 'AC'),
('23khci81', 'Priya Das', 'Female', 'CSE', '1', 9705801521, 'priya_das@gmail.com', 'Badamba, Bhadrak, 756100', 'cH0J8yHP', 'NON-AC'),
('23lgci24', 'Amit Tripathy', 'Male', 'MCA', '1', 9476174796, 'amit_tripathy@gmail.com', 'Patana, Cuttack, 753001', 'IrHYyOEq', 'AC'),
('23lkci83', 'Debasish Patnaik', 'Male', 'CSE', '1', 9876983200, 'debasish_patnaik@gmail.com', 'Patana, Berhampur, 760001', 'dCdRVhLm', 'NON-AC'),
('23mmci01', 'Aryan Das', 'Male', 'CSE', '1', 9876543210, 'aryan.das@email.com', 'Bhadrak, Bhubaneswar, 751001', 'Aryan@123', 'NON-AC'),
('23mmci02', 'Priti Rout', 'Female', 'ECE', '1', 8765432109, 'priya.rout@email.com', 'Jajpur, Cuttack, 753001', 'Priya@456', 'NON-AC'),
('23mmci03', 'Rahul Behera', 'Male', 'CST', '1', 7654321098, 'rahul.b@email.com', 'Kendrapara, Puri, 752001', 'Rahul@789', 'NON-AC'),
('23mmci04', 'Sneha Mishra', 'Female', 'MCA', '1', 6543210987, 'sneha.m@email.com', 'Berhampur, Ganjam, 760001', 'Sneha@321', 'NON-AC'),
('23mmci05', 'Sandeep Kar', 'Male', 'EEE', '1', 9432109876, 'sandeep.k@email.com', 'Balasore, Bhadrak, 756001', 'Sandeep@741', ''),
('23mmci06', 'Rituparna Nayak', 'Female', 'M.Sc', '1', 9321098765, 'ritu.n@email.com', 'Nimapada, Puri, 752101', 'Ritu@852', ''),
('23mmci07', 'Akash Sen', 'Male', 'CSE', '1', 9210987654, 'akash.s@email.com', 'Jaleswar, Balasore, 756002', 'Akash@963', ''),
('23mmci08', 'Swati Das', 'Female', 'ECE', '1', 9109876543, 'swati.d@email.com', 'Bhanjanagar, Ganjam, 761126', 'Swati@147', ''),
('23mmci09', 'Manas Ranjan', 'Male', 'CST', '1', 9098765432, 'manas.r@email.com', 'Sambalpur, Sambalpur, 768001', 'Manas@258', ''),
('23mmci10', 'Pooja Sahoo', 'Female', 'MCA', '1', 8987654321, 'pooja.s@email.com', 'Dhenkanal, Angul, 759122', 'Pooja@369', ''),
('23mmci11', 'Deepak Swain', 'Male', 'EEE', '1', 8876543210, 'deepak.s@email.com', 'Baripada, Mayurbhanj, 757001', 'Deepak@741', ''),
('23mmci12', 'Ananya Das', 'Female', 'M.Sc', '1', 8765432108, 'ananya.d@email.com', 'Jharsuguda, Jharsuguda, 768202', 'Ananya@852', ''),
('23mmci13', 'Alok Ranjan', 'Male', 'CSE', '1', 7654321097, 'alok.r@email.com', 'Rourkela, Sundargarh, 769001', 'Alok@963', ''),
('23mmci14', 'Kriti Mohapatra', 'Male', 'ECE', '1', 7543210986, 'kriti.m@email.com', 'Nayagarh, Nayagarh, 752069', 'Kriti@147', ''),
('23mmci15', 'Bikash Patel', 'Male', 'CST', '1', 7432109875, 'bikash.p@email.com', 'Rayagada, Rayagada, 765017', 'Bikash@258', ''),
('23mmci16', 'Roshni Jena', 'Female', 'MCA', '1', 7321098764, 'roshni.j@email.com', 'Kendujhar, Kendujhar, 758001', 'Roshni@369', ''),
('23mmci17', 'Anupam Singh', 'Male', 'EEE', '1', 7210987653, 'anupam.s@email.com', 'Balangir, Balangir, 767001', 'Anupam@741', ''),
('23mmci18', 'Divya Mishra', 'Female', 'M.Sc', '1', 7109876542, 'divya.m@email.com', 'Jagatsinghpur, Cuttack, 754103', 'Divya@852', ''),
('23mmci19', 'Satyajit Nayak', 'Male', 'CSE', '1', 7098765431, 'satyajit.n@email.com', 'Titilagarh, Balangir, 767033', 'Satyajit@963', ''),
('23mmci20', 'Nisha Das', 'Female', 'ECE', '1', 6987654320, 'nisha.d@email.com', 'Angul, Angul, 759122', 'Nisha@147', ''),
('23mmci67', 'Tanmay Patnaik', 'Male', 'M.Sc', '1', 9632470196, 'tanmay_patnaik@gmail.com', 'Jatni, Berhampur, 760001', '4KLK0cSg', ''),
('23noci12', 'Ritika Das', 'Male', 'MCA', '1', 9949561589, 'ritika_das@gmail.com', 'Kendrapara, Angul, 759122', '0i8NGpJN', ''),
('23nrci18', 'Smaranika Mohanty', 'Male', 'ECE', '1', 9681936688, 'smaranika_mohanty@gmail.com', 'Kendrapara, Cuttack, 753001', 'e8wEfNde', ''),
('23ouci45', 'Suchitra Sahu', 'Male', 'MCA', '1', 9746925168, 'suchitra_sahu@gmail.com', 'Badamba, Berhampur, 760001', 'NwgrFnVe', ''),
('23oxci66', 'Rakesh Mishra', 'Male', 'ECE', '1', 9419311773, 'rakesh_mishra@gmail.com', 'Badamba, Bhubaneswar, 751001', '6mThyBsF', ''),
('23puci69', 'Bikash Panda', 'Male', 'MCA', '1', 9735470288, 'bikash_panda@gmail.com', 'Chandaka, Jajpur, 755001', 'S6kPUeF8', ''),
('23qlci69', 'Suresh Panda', 'Male', 'EEE', '1', 9894130147, 'suresh_panda@gmail.com', 'Chandaka, Balasore, 756001', 'wPFdJwwG', ''),
('23rqci65', 'Soumya Ranjan Nayak', 'Male', 'EEE', '1', 9737233617, 'soumya_ranjan_nayak@gmail.com', 'Chandaka, Bhubaneswar, 751001', 'Kvs38rd6', ''),
('23rvci36', 'Rakesh Tripathy', 'Male', 'EEE', '1', 9235460655, 'rakesh_tripathy@gmail.com', 'Patana, Sambalpur, 768001', 'CGXx4Mao', ''),
('23ryci45', 'Suresh Rout', 'Male', 'EEE', '1', 9924453406, 'suresh_rout@gmail.com', 'Balianta, Sambalpur, 768001', 'DSX5B2UF', ''),
('23tgci41', 'Ananya Tripathy', 'Female', 'MCA', '1', 9410971170, 'ananya_tripathy@gmail.com', 'Khaira, Jajpur, 755001', 'gLt8I1hp', ''),
('23tmci78', 'Debasish Behera', 'Male', 'CST', '1', 9690466451, 'debasish_behera@gmail.com', 'Khaira, Puri, 752001', 'rNPb5quJ', ''),
('23uhci56', 'Amit Nayak', 'Male', 'CSE', '1', 9410464214, 'amit_nayak@gmail.com', 'Badamba, Berhampur, 760001', 'nmLdpkTB', ''),
('23vpci62', 'Chandan Mohanty', 'Male', 'CSE', '1', 9983289449, 'chandan_mohanty@gmail.com', 'Banapur, Balasore, 756001', 'iXdx7M3i', ''),
('23wpci66', 'Alisa Behera', 'Female', 'M.Sc', '1', 9608661741, 'alisa_behera@gmail.com', 'Banapur, Angul, 759122', 'gdT3FFt0', ''),
('23wsci92', 'Chandan Sahu', 'Male', 'EEE', '1', 9939453767, 'chandan_sahu@gmail.com', 'Dhenkanal, Bhubaneswar, 751001', '2gvfDnnD', ''),
('23wzci10', 'Subrat Senapati', 'Male', 'CST', '1', 9636631671, 'subrat_senapati@gmail.com', 'Chandaka, Berhampur, 760001', 'yOQqRIVo', ''),
('23zrci34', 'Suprava Sahu', 'Female', 'ECE', '1', 9251148784, 'suprava_sahu@gmail.com', 'Dhenkanal, Jajpur, 755001', 'Tpzr1Vfk', ''),
('23zrci71', 'Mandeep Bhatt', 'Male', 'CSE', '1', 9524409303, 'mandeep_bhatt@gmail.com', 'Jatni, Angul, 759122', 'OYM51M4g', ''),
('23zuci59', 'Debasish Nayak', 'Male', 'ECE', '1', 9893226947, 'debasish_nayak@gmail.com', 'Badamba, Bhadrak, 756100', 'yzGeiKdB', ''),
('23zuci62', 'Debasmita Prusti', 'Female', 'M.Sc', '1', 9879697513, 'debasmita_prusti@gmail.com', 'Banapur, Balasore, 756001', 'CYgZ6c2t', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `fk_roomId` (`room_id`);

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_allocation`
--
ALTER TABLE `room_allocation`
  ADD KEY `fk_sic` (`sic`),
  ADD KEY `fk_room` (`room_id`),
  ADD KEY `fk_bed_id` (`bed_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contact_no` (`contact_no`);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `fk_roomId` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `room_allocation`
--
ALTER TABLE `room_allocation`
  ADD CONSTRAINT `fk_bed_id` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`bed_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sic` FOREIGN KEY (`sic`) REFERENCES `students` (`sic`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
