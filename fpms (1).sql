-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 08:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` varchar(3) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `fname`, `sname`, `dob`, `gender`, `phone`, `Email`, `username`, `password`) VALUES
('01', 'ivy', 'gondwe', '2023-10-04', 'F', '09987653', 'wkamtedza@gmail.com', 'ivy', '123456789'),
('02', 'winiko', 'mtedza', '2023-10-02', 'M', '0998876765', 'bit19-wkamtedza@poly.ac.mw', 'wkamtedza', 'mtedza');

-- --------------------------------------------------------

--
-- Table structure for table `player_medical_report`
--

CREATE TABLE `player_medical_report` (
  `doctor_id` varchar(3) NOT NULL,
  `player_id` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `medical_history` varchar(200) NOT NULL,
  `current_medication` varchar(200) NOT NULL,
  `examination_results` varchar(200) NOT NULL,
  `recommendation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_medical_report`
--

INSERT INTO `player_medical_report` (`doctor_id`, `player_id`, `Fname`, `dob`, `medical_history`, `current_medication`, `examination_results`, `recommendation`) VALUES
('342', '234234', 'mike', '2023-09-27', 'wertyui', 'ertyuii', 'wertyu', 'wertyui'),
('wer', 'wqertyui', 'wqertyui', '2023-10-18', '1234567890', '234567890', 'Q1E356789', 'QWETUIO');

-- --------------------------------------------------------

--
-- Table structure for table `player_physical_report`
--

CREATE TABLE `player_physical_report` (
  `player_id` varchar(3) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `height` varchar(30) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `physical_perfomance` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_physical_report`
--

INSERT INTO `player_physical_report` (`player_id`, `fname`, `dob`, `height`, `weight`, `physical_perfomance`) VALUES
('', '', '0000-00-00', '', '', ''),
('01', 'winiko', '2023-10-04', '18', '31', 'good');

-- --------------------------------------------------------

--
-- Table structure for table `player_profile`
--

CREATE TABLE `player_profile` (
  `player_id` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `player_rating`
--

CREATE TABLE `player_rating` (
  `player_id` varchar(3) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `tactical_skills` varchar(123) NOT NULL,
  `tactical_awareness` varchar(123) NOT NULL,
  `physical_fitness` varchar(100) NOT NULL,
  `commitment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_rating`
--

INSERT INTO `player_rating` (`player_id`, `fname`, `dob`, `tactical_skills`, `tactical_awareness`, `physical_fitness`, `commitment`) VALUES
('202', 'winiko', '2023-10-04', '8', '5', '6', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `player_status`
--

CREATE TABLE `player_status` (
  `player_id` varchar(3) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `fitness_level` varchar(110) NOT NULL,
  `injury_history` varchar(110) NOT NULL,
  `rest_period` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_status`
--

INSERT INTO `player_status` (`player_id`, `fname`, `dob`, `fitness_level`, `injury_history`, `rest_period`) VALUES
('', '', '0000-00-00', 'low', '', ''),
('01', 'winiko', '2023-10-05', 'medium', '2w3erty', '12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `acount_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `acount_type`) VALUES
('Admin', '1234', 'Adminstration'),
('Coach', '12345', 'Coaching'),
('Medicalpersonnel', '123456', 'medical_personnel'),
('Player', '1234567', 'Player'),
('igondwe', 'ivy', 'Adminstration');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `player_medical_report`
--
ALTER TABLE `player_medical_report`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `player_physical_report`
--
ALTER TABLE `player_physical_report`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `player_rating`
--
ALTER TABLE `player_rating`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `player_status`
--
ALTER TABLE `player_status`
  ADD PRIMARY KEY (`player_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
