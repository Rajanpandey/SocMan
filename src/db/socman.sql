-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2018 at 03:13 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socman`
--

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `serial` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`serial`, `username`, `title`, `body`, `date`, `url`, `status`) VALUES
(2, 'Pranay', 'Watchman is harassing.', 'LOTS OF', '2018-06-25 18:30:00', 'fsdfs', -1),
(3, 'Akshat', 'Too many untamed dogs in the scoiety.	', 'lkdsjfs;', '2018-06-26 08:31:49', 'efwfwe', 1),
(4, 'Ayush', 'Waste management isnt taken care by the committee!', 'dasdas', '2018-06-26 08:35:46', 'fwefwe', -1),
(6, 'Rajan', 'aaa', 'aa', '2018-06-26 08:40:04', 'azxczv', -1),
(7, 'Rajan', 'Water not coming', 'sdfasdfsd', '2018-06-26 09:10:12', 'bgfjg', 0),
(8, 'Rajan', 'Waste management isnt taken care by the committee!', 'Waste management isnt taken care by the committee!', '2018-06-26 09:11:07', 'yukyu', 0),
(9, 'Rajan', 'wate rproblem rain bla', 'dfgdg', '2018-06-26 10:24:02', '-2fwefwg', 0),
(12, 'Rajan', 'Power shutdown hrs cut for Panvel water supply', 'NAVI MUMBAI: Tata Power has reduced its weekly shut down hours at its Khopoli unit after a request by PCMC. The shutdown hours carried out on Sunday adds to the water woes of Panvel residents. Water is discharged from Tata Power plant to the Patalganga river, from which MJP draws and supplies water to Panvel.\r\nPCMC water supply committee president Nilesh Baviskar said, â€œA team led by PCMC mayor had visited the Tata Power Khopoli office in April. We had officially requested them to stop the weekly shutdown day to continue intermittent water supply through the Patalganga river. The MJP also requested the same. Finally, the number of hours of the weekly shutdown on Sunday have been reduced.â€\r\nMJP executive engineer Anil Gadge said, â€œTata Power has reduced the number hours of the shut down enforced on Sundays. Now water will continue to flow in the Patalganga river and meet our requirement.â€\r\nThe weekly shutdown at the Tata Power on Sunday reduces water flow to the Patalganga river on Monday in the down stream. The MJP draws water at Vayal village in Khalapur taluka from the Patalganga river.\r\nCurrently, MJP supplies around 16 MLD water to Panvel which is facing an acute water crisis. PCMC had requested the water resources minister to direct the power body to stop the shutdown. Initially, Tata Power objected but relented later.', '2018-06-26 10:46:15', 'power-shutdown-hrs-cut-for-panvel-water-supply', 0),
(13, 'Rajan', 'Trumpâ€™s pardons are nothing but right-wing trolling', 'NAVI MUMBAI: Tata Power has reduced its weekly shut down hours at its Khopoli unit after a request by PCMC. The shutdown hours carried out on Sunday adds to the water woes of Panvel residents. Water is discharged from Tata Power plant to the Patalganga river, from which MJP draws and supplies water to Panvel.\r\nPCMC water supply committee president Nilesh Baviskar said, â€œA team led by PCMC mayor had visited the Tata Power Khopoli office in April. We had officially requested them to stop the weekly shutdown day to continue intermittent water supply through the Patalganga river. The MJP also requested the same. Finally, the number of hours of the weekly shutdown on Sunday have been reduced.â€\r\nMJP executive engineer Anil Gadge said, â€œTata Power has reduced the number hours of the shut down enforced on Sundays. Now water will continue to flow in the Patalganga river and meet our requirement.â€\r\n\r\nThe weekly shutdown at the Tata Power on Sunday reduces water flow to the Patalganga river on Monday in the down stream. The MJP draws water at Vayal village in Khalapur taluka from the Patalganga river.\r\n\r\nCurrently, MJP supplies around 16 MLD water to Panvel which is facing an acute water crisis. PCMC had requested the water resources minister to direct the power body to stop the shutdown. Initially, Tata Power objected but relented later.', '2018-06-26 10:47:20', 'trump-s-pardons-are-nothing-but-right-wing-trolling', 0),
(14, 'Rajan', 'hi', 'hi', '2018-10-28 13:59:23', 'hi', 1),
(15, 'Rajan', 'No power since 24 hours', 'No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours No power since 24 hours', '2018-10-28 14:11:52', 'no-power-since-24-hours', -1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `serial` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`serial`, `username`, `password`) VALUES
(1, 'Rajan', 'rkp12345'),
(2, 'admin', 'admin12345'),
(3, 'Pranay', 'pranay12345'),
(4, 'Chinmay', 'chinmay12345'),
(5, 'Ujjwal', 'ujjwal12345'),
(6, 'Sachin', 'sachin12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
