-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 08:08 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `aid` int(11) NOT NULL,
  `type` varchar(140) NOT NULL,
  `name` varchar(150) NOT NULL,
  `color` varchar(50) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`aid`, `type`, `name`, `color`, `weight`, `image`) VALUES
(24, 'cat', 'cat', 'white', '2kg', 'cat.jpg'),
(25, 'dog', 'lufy', 'white', '7kg', 'dog.jpg'),
(26, 'cat', 'cmon', 'white', '5', 'cats2.jpg'),
(27, 'cat', 'sier', 'gray', '3kg', 'caats.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` varchar(140) NOT NULL,
  `creditcardno` int(11) NOT NULL,
  `donationamount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `uid`, `aid`, `status`, `creditcardno`, `donationamount`) VALUES
(26, 10, 24, 'Approved', 456, 500),
(27, 10, 25, 'Pending', 521, 200);

-- --------------------------------------------------------

--
-- Table structure for table `count`
--

CREATE TABLE `count` (
  `counts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `count`
--

INSERT INTO `count` (`counts`) VALUES
(826);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `fid` int(11) NOT NULL,
  `qa` text NOT NULL,
  `qa_type` varchar(180) NOT NULL,
  `parent` int(11) NOT NULL,
  `fuid` int(11) NOT NULL,
  `fdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`fid`, `qa`, `qa_type`, `parent`, `fuid`, `fdate`) VALUES
(24, 'Where is sas located?\r\n', 'question', 0, 10, '2018-04-13'),
(25, 'SAS is located at Kathmandu \r\n', 'answer', 24, 10, '2018-04-13'),
(26, 'What does SAS do?', 'question', 0, 10, '2018-04-13'),
(27, 'SAS aims to provide sheltering to animlas', 'answer', 26, 10, '2018-04-13'),
(28, 'SAS provides shelters to different animals.\r\n', 'answer', 26, 10, '2018-04-13'),
(29, 'Can we book animlas?', 'question', 0, 10, '2018-04-13'),
(30, 'Yes you can book animal clicking book button avilable after sucessful login \r\n', 'answer', 29, 10, '2018-04-13'),
(31, 'IS donation facility avilable?\r\n', 'question', 0, 10, '2018-04-13'),
(32, 'SAS is located at sukedhara kathmandu', 'answer', 24, 10, '2018-04-21'),
(33, 'yes you can book animals\r\n', 'answer', 29, 10, '2018-04-21'),
(34, 'SAS protect different animals providing shelter', 'answer', 26, 10, '2018-04-21'),
(35, 'Animals can be booked easily ', 'answer', 29, 10, '2018-04-21'),
(36, 'Yes donation facility is avilable', 'answer', 31, 10, '2018-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(140) NOT NULL,
  `email` varchar(140) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `postalcode` int(11) NOT NULL,
  `username` varchar(140) NOT NULL,
  `password` varchar(150) NOT NULL,
  `type` varchar(100) NOT NULL,
  `registereddate` varchar(140) NOT NULL,
  `lastlogin` varchar(140) NOT NULL,
  `pet` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `dob`, `address`, `postalcode`, `username`, `password`, `type`, `registereddate`, `lastlogin`, `pet`) VALUES
(1, 'admin', 'dibashghimire14@gmail.com', '2004-03-21', 'santinagar', 114, 'admin', '$2y$10$9MEDiEcuRX7LsSyYrAsM1e/KtNsYrsDSMWoIhfER8/xdhSUWdfAaq', 'admin', '0000-00-00', '2018-04-22 07:23:33', 'cat'),
(10, 'dibash', 'dibash@mail.com', '2002-03-20', 'itahri', 228, 'dibash', '$2y$10$ztNjb1G05WQqxXdsQ1.eieaGyVCxnzkEkjJD0BdFLnBxors.WMYk2', 'user', '2018-03-25 10:43:37', '2018-04-22 07:23:23', 'sheep'),
(11, 'sujan', 'sujanbaral34@yahoo.com', '2018-04-17', 'santinagar', 25, 'sujan', '$2y$10$TacVnbLgtXnu3VXYpFST5eE2AXhoeFotoOJ685ixg5oWxAR1UADgC', 'user', '2018-04-17 15:46:32', '2018-04-17 15:46:32', 'dog');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
