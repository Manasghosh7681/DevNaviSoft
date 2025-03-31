-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 09:03 AM
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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sic`, `name`, `gender`, `branch`, `year`, `contact_no`, `email`, `address`, `password`) VALUES
('23adci78', 'Debasish Rout', 'Male', 'ECE', '1', 9285377101, 'debasish_rout@gmail.com', 'Badamba, Cuttack, 753001', 'Y3QocQPS'),
('23adci95', 'Suresh Sahu', 'Male', 'CSE', '1', 9772133383, 'suresh_sahu@gmail.com', 'Balianta, Jajpur, 755001', 'JLYC3FNF'),
('23aici58', 'Debasish Das', 'Male', 'M.Sc', '1', 9954016238, 'debasish_das@gmail.com', 'Banapur, Sambalpur, 768001', 'fWgMoQTo'),
('23auci65', 'Priya Tripathy', 'Female', 'CST', '1', 9115599865, 'priya_tripathy@gmail.com', 'Banapur, Puri, 752001', 'TWztlb8Y'),
('23cgci44', 'Ritu Patnaik', 'Female', 'CSE', '1', 9522772183, 'ritu_patnaik@gmail.com', 'Banapur, Berhampur, 760001', 'U02fxA8F'),
('23cuci41', 'Chandan Nayak', 'Male', 'CST', '1', 9552027322, 'chandan_nayak@gmail.com', 'Badamba, Cuttack, 753001', 'WKKcEWT4'),
('23cvci53', 'Amit Mohanty', 'Male', 'EEE', '1', 9428099758, 'amit_mohanty@gmail.com', 'Chandaka, Berhampur, 760001', 'q7qLyPAv'),
('23enci14', 'Sweta Patnaik', 'Female', 'M.Sc', '1', 9705118969, 'sweta_patnaik@gmail.com', 'Chandaka, Puri, 752001', 'n4sXh0vu'),
('23eoci69', 'Rakesh Behera', 'Male', 'MCA', '1', 9196747045, 'rakesh_behera@gmail.com', 'Banapur, Bhubaneswar, 751001', 'QG4FIUHG'),
('23fbci92', 'Smita Mishra', 'Female', 'ECE', '1', 9649386761, 'smita_mishra@gmail.com', 'Chandaka, Cuttack, 753001', 'Vbp7xUiR'),
('23fdci33', 'Sweta Nayak', 'Female', 'MCA', '1', 9163502478, 'sweta_nayak@gmail.com', 'Khaira, Angul, 759122', 'JZP8Bjs9'),
('23fsci39', 'Suresh Patnaik', 'Male', 'CST', '1', 9854695780, 'suresh_patnaik@gmail.com', 'Balianta, Bhubaneswar, 751001', '2aF3vTkD'),
('23geci53', 'Ritu Nayak', 'Female', 'CST', '1', 9995867653, 'ritu_nayak@gmail.com', 'Chandaka, Balasore, 756001', 'GWrZcprh'),
('23gjci64', 'Akash Sahu', 'Male', 'M.Sc', '1', 9301308012, 'akash_sahu@gmail.com', 'Patana, Cuttack, 753001', 'R3FiZYGT'),
('23gwci21', 'Ananya Rout', 'Female', 'EEE', '1', 9171590850, 'ananya_rout@gmail.com', 'Patana, Bhubaneswar, 751001', 'MLWVIs0Y'),
('23gxci90', 'Niharika Patnaik', 'Female', 'MCA', '1', 9247556551, 'niharika_patnaik@gmail.com', 'Banapur, Bhubaneswar, 751001', 'Lptc3lws'),
('23jjci24', 'Priya Patnaik', 'Female', 'ECE', '1', 9936205662, 'priya_patnaik@gmail.com', 'Balianta, Bhadrak, 756100', 'RJJB8V4M'),
('23joci21', 'Ananya Mohanty', 'Female', 'ECE', '1', 9660322082, 'ananya_mohanty@gmail.com', 'Badamba, Jajpur, 755001', '7d8ABcw7'),
('23khci81', 'Priya Das', 'Female', 'CSE', '1', 9705801521, 'priya_das@gmail.com', 'Badamba, Bhadrak, 756100', 'cH0J8yHP'),
('23lgci24', 'Amit Tripathy', 'Female', 'MCA', '1', 9476174796, 'amit_tripathy@gmail.com', 'Patana, Cuttack, 753001', 'IrHYyOEq'),
('23lkci83', 'Debasish Patnaik', 'Male', 'CSE', '1', 9876983200, 'debasish_patnaik@gmail.com', 'Patana, Berhampur, 760001', 'dCdRVhLm'),
('23mmci01', 'Aryan Das', 'Male', 'CSE', '1', 9876543210, 'aryan.das@email.com', 'Bhadrak, Bhubaneswar, 751001', 'Aryan@123'),
('23mmci02', 'Priti Rout', 'Female', 'ECE', '1', 8765432109, 'priya.rout@email.com', 'Jajpur, Cuttack, 753001', 'Priya@456'),
('23mmci03', 'Rahul Behera', 'Male', 'CST', '1', 7654321098, 'rahul.b@email.com', 'Kendrapara, Puri, 752001', 'Rahul@789'),
('23mmci04', 'Sneha Mishra', 'Female', 'MCA', '1', 6543210987, 'sneha.m@email.com', 'Berhampur, Ganjam, 760001', 'Sneha@321'),
('23mmci05', 'Sandeep Kar', 'Male', 'EEE', '1', 9432109876, 'sandeep.k@email.com', 'Balasore, Bhadrak, 756001', 'Sandeep@741'),
('23mmci06', 'Rituparna Nayak', 'Female', 'M.Sc', '1', 9321098765, 'ritu.n@email.com', 'Nimapada, Puri, 752101', 'Ritu@852'),
('23mmci07', 'Akash Sen', 'Male', 'CSE', '1', 9210987654, 'akash.s@email.com', 'Jaleswar, Balasore, 756002', 'Akash@963'),
('23mmci08', 'Swati Das', 'Female', 'ECE', '1', 9109876543, 'swati.d@email.com', 'Bhanjanagar, Ganjam, 761126', 'Swati@147'),
('23mmci09', 'Manas Ranjan', 'Male', 'CST', '1', 9098765432, 'manas.r@email.com', 'Sambalpur, Sambalpur, 768001', 'Manas@258'),
('23mmci10', 'Pooja Sahoo', 'Female', 'MCA', '1', 8987654321, 'pooja.s@email.com', 'Dhenkanal, Angul, 759122', 'Pooja@369'),
('23mmci11', 'Deepak Swain', 'Male', 'EEE', '1', 8876543210, 'deepak.s@email.com', 'Baripada, Mayurbhanj, 757001', 'Deepak@741'),
('23mmci12', 'Ananya Das', 'Female', 'M.Sc', '1', 8765432108, 'ananya.d@email.com', 'Jharsuguda, Jharsuguda, 768202', 'Ananya@852'),
('23mmci13', 'Alok Ranjan', 'Male', 'CSE', '1', 7654321097, 'alok.r@email.com', 'Rourkela, Sundargarh, 769001', 'Alok@963'),
('23mmci14', 'Kriti Mohapatra', 'Male', 'ECE', '1', 7543210986, 'kriti.m@email.com', 'Nayagarh, Nayagarh, 752069', 'Kriti@147'),
('23mmci15', 'Bikash Patel', 'Male', 'CST', '1', 7432109875, 'bikash.p@email.com', 'Rayagada, Rayagada, 765017', 'Bikash@258'),
('23mmci16', 'Roshni Jena', 'Female', 'MCA', '1', 7321098764, 'roshni.j@email.com', 'Kendujhar, Kendujhar, 758001', 'Roshni@369'),
('23mmci17', 'Anupam Singh', 'Male', 'EEE', '1', 7210987653, 'anupam.s@email.com', 'Balangir, Balangir, 767001', 'Anupam@741'),
('23mmci18', 'Divya Mishra', 'Female', 'M.Sc', '1', 7109876542, 'divya.m@email.com', 'Jagatsinghpur, Cuttack, 754103', 'Divya@852'),
('23mmci19', 'Satyajit Nayak', 'Male', 'CSE', '1', 7098765431, 'satyajit.n@email.com', 'Titilagarh, Balangir, 767033', 'Satyajit@963'),
('23mmci20', 'Nisha Das', 'Female', 'ECE', '1', 6987654320, 'nisha.d@email.com', 'Angul, Angul, 759122', 'Nisha@147'),
('23mmci67', 'Tanmay Patnaik', 'Male', 'M.Sc', '1', 9632470196, 'tanmay_patnaik@gmail.com', 'Jatni, Berhampur, 760001', '4KLK0cSg'),
('23noci12', 'Ritika Das', 'Male', 'MCA', '1', 9949561589, 'ritika_das@gmail.com', 'Kendrapara, Angul, 759122', '0i8NGpJN'),
('23nrci18', 'Smaranika Mohanty', 'Male', 'ECE', '1', 9681936688, 'smaranika_mohanty@gmail.com', 'Kendrapara, Cuttack, 753001', 'e8wEfNde'),
('23ouci45', 'Suchitra Sahu', 'Male', 'MCA', '1', 9746925168, 'suchitra_sahu@gmail.com', 'Badamba, Berhampur, 760001', 'NwgrFnVe'),
('23oxci66', 'Rakesh Mishra', 'Male', 'ECE', '1', 9419311773, 'rakesh_mishra@gmail.com', 'Badamba, Bhubaneswar, 751001', '6mThyBsF'),
('23puci69', 'Bikash Panda', 'Male', 'MCA', '1', 9735470288, 'bikash_panda@gmail.com', 'Chandaka, Jajpur, 755001', 'S6kPUeF8'),
('23qlci69', 'Suresh Panda', 'Male', 'EEE', '1', 9894130147, 'suresh_panda@gmail.com', 'Chandaka, Balasore, 756001', 'wPFdJwwG'),
('23rqci65', 'Soumya Ranjan Nayak', 'Male', 'EEE', '1', 9737233617, 'soumya_ranjan_nayak@gmail.com', 'Chandaka, Bhubaneswar, 751001', 'Kvs38rd6'),
('23rvci36', 'Rakesh Tripathy', 'Male', 'EEE', '1', 9235460655, 'rakesh_tripathy@gmail.com', 'Patana, Sambalpur, 768001', 'CGXx4Mao'),
('23ryci45', 'Suresh Rout', 'Male', 'EEE', '1', 9924453406, 'suresh_rout@gmail.com', 'Balianta, Sambalpur, 768001', 'DSX5B2UF'),
('23tgci41', 'Ananya Tripathy', 'Female', 'MCA', '1', 9410971170, 'ananya_tripathy@gmail.com', 'Khaira, Jajpur, 755001', 'gLt8I1hp'),
('23tmci78', 'Debasish Behera', 'Male', 'CST', '1', 9690466451, 'debasish_behera@gmail.com', 'Khaira, Puri, 752001', 'rNPb5quJ'),
('23uhci56', 'Amit Nayak', 'Male', 'CSE', '1', 9410464214, 'amit_nayak@gmail.com', 'Badamba, Berhampur, 760001', 'nmLdpkTB'),
('23vpci62', 'Chandan Mohanty', 'Male', 'CSE', '1', 9983289449, 'chandan_mohanty@gmail.com', 'Banapur, Balasore, 756001', 'iXdx7M3i'),
('23wpci66', 'Alisa Behera', 'Female', 'M.Sc', '1', 9608661741, 'alisa_behera@gmail.com', 'Banapur, Angul, 759122', 'gdT3FFt0'),
('23wsci92', 'Chandan Sahu', 'Male', 'EEE', '1', 9939453767, 'chandan_sahu@gmail.com', 'Dhenkanal, Bhubaneswar, 751001', '2gvfDnnD'),
('23wzci10', 'Subrat Senapati', 'Male', 'CST', '1', 9636631671, 'subrat_senapati@gmail.com', 'Chandaka, Berhampur, 760001', 'yOQqRIVo'),
('23zrci34', 'Suprava Sahu', 'Female', 'ECE', '1', 9251148784, 'suprava_sahu@gmail.com', 'Dhenkanal, Jajpur, 755001', 'Tpzr1Vfk'),
('23zrci71', 'Mandeep Bhatt', 'Male', 'CSE', '1', 9524409303, 'mandeep_bhatt@gmail.com', 'Jatni, Angul, 759122', 'OYM51M4g'),
('23zuci59', 'Debasish Nayak', 'Male', 'ECE', '1', 9893226947, 'debasish_nayak@gmail.com', 'Badamba, Bhadrak, 756100', 'yzGeiKdB'),
('23zuci62', 'Debasmita Prusti', 'Female', 'M.Sc', '1', 9879697513, 'debasmita_prusti@gmail.com', 'Banapur, Balasore, 756001', 'CYgZ6c2t');

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
