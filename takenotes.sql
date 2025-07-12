-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 05:10 PM
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
-- Database: `takenotes`
--

-- --------------------------------------------------------

--
-- Table structure for table `anand`
--

CREATE TABLE `anand` (
  `sno` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` text NOT NULL,
  `tstamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notenestusers`
--

CREATE TABLE `notenestusers` (
  `uno` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notenestusers`
--

INSERT INTO `notenestusers` (`uno`, `username`, `email`, `password`, `date`) VALUES
(16, 'sumanta', 'spaul938286@gmail.com', 'NzFhY2poUmJZck9mK2M0RlR3QWRNZz09OjpjAw5epttnUEnvAJEullEc', '2024-11-29'),
(21, 'pb', 'pb1234@gmail.com', 'Z3U5dXo4RVViVXprQVFiZUgvMGc1QT09Ojp8l866YeFumaJUoxCZsRsv', '2024-11-30'),
(22, 'pritee', 'pritee@gmail.com', 'WXRGN0RiL09nU24rMHNjVkZZMkpsZz09OjpLVrSxhQy+n7o3SDJ6bxzT', '2024-12-01'),
(23, 'sumit', 'sumit@gmail.com', 'U244YmEwd0tJcDllbHhOQmRnOXhWZz09OjrwAzh0wWrHJHJYSkLUeGEI', '2024-12-01'),
(27, 'anand', 'anand@gmail.com', 'dWM1TGNJSUVRZ1Y4amp0dkNBS0sydz09OjoPENipfGao2V6at0VlE4us', '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `pb`
--

CREATE TABLE `pb` (
  `sno` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` text NOT NULL,
  `tstamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pb`
--

INSERT INTO `pb` (`sno`, `title`, `des`, `tstamp`) VALUES
(99, 'date of birth', '21/12/1900', '2024-11-30 15:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `pritee`
--

CREATE TABLE `pritee` (
  `sno` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` text NOT NULL,
  `tstamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pritee`
--

INSERT INTO `pritee` (`sno`, `title`, `des`, `tstamp`) VALUES
(99, 'Sumanta Paul', 'tmsl student', '2024-12-01 12:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `sumanta`
--

CREATE TABLE `sumanta` (
  `sno` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` text NOT NULL,
  `tstamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sumanta`
--

INSERT INTO `sumanta` (`sno`, `title`, `des`, `tstamp`) VALUES
(99, 'Sumanta Paul', 'Techno Main Salt Lake, 2nd year student.', '2024-12-01 01:48:54'),
(100, 'Roll', '13071023044', '2024-12-01 01:49:13'),
(101, 'Department', 'MCA3', '2024-12-01 12:21:39'),
(102, 'Address', 'Bantul, Bagnan, Howrah.', '2024-12-01 01:50:07'),
(103, 'Minor Project', 'Project group 11', '2024-12-01 01:51:38'),
(104, 'Quick Notes', ' Capture your thoughts instantly.', '2024-12-01 01:53:48'),
(105, ' Idea Vault', ' Secure your brilliant ideas here.', '2024-12-01 01:54:06'),
(106, 'Daily Journal', 'Record your everyday moments effortlessly', '2024-12-01 01:54:32'),
(107, 'Work Tasks', 'Stay on top of your to-do list.', '2024-12-01 01:54:48'),
(108, ' Recipe Keeper', 'Save and organize your favorite recipes.', '2024-12-01 01:55:18'),
(109, 'Meeting Minutes', ' Keep track of important meeting notes.', '2024-12-01 01:55:35'),
(110, 'Study Planner', 'Organize your study materials effectively.', '2024-12-01 01:55:51'),
(111, ' Personal Diary', 'A safe space for your private entries.', '2024-12-01 01:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `sumit`
--

CREATE TABLE `sumit` (
  `sno` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` text NOT NULL,
  `tstamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sumit`
--

INSERT INTO `sumit` (`sno`, `title`, `des`, `tstamp`) VALUES
(99, 'sumit', 'tmsl student 2nd', '2024-12-01 12:50:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anand`
--
ALTER TABLE `anand`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `notenestusers`
--
ALTER TABLE `notenestusers`
  ADD PRIMARY KEY (`uno`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `pb`
--
ALTER TABLE `pb`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `pritee`
--
ALTER TABLE `pritee`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `sumanta`
--
ALTER TABLE `sumanta`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `sumit`
--
ALTER TABLE `sumit`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anand`
--
ALTER TABLE `anand`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `notenestusers`
--
ALTER TABLE `notenestusers`
  MODIFY `uno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pb`
--
ALTER TABLE `pb`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pritee`
--
ALTER TABLE `pritee`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `sumanta`
--
ALTER TABLE `sumanta`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `sumit`
--
ALTER TABLE `sumit`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
