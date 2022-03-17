-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2019 at 02:57 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `houserent`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(252) NOT NULL,
  `username` varchar(252) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `username`, `password`) VALUES
(1, 'shakilcse25@gmail.com', 'shakilcse25', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_house`
--

CREATE TABLE `tbl_house` (
  `id` int(50) NOT NULL,
  `owner_id` int(50) NOT NULL,
  `tenant_id` int(50) NOT NULL,
  `address` text NOT NULL,
  `road_no` varchar(252) NOT NULL,
  `house_no` varchar(252) NOT NULL,
  `rental_value` varchar(50) NOT NULL,
  `house_type` varchar(50) NOT NULL,
  `floor` varchar(252) NOT NULL,
  `bedroom` varchar(50) NOT NULL,
  `dinning_room` varchar(52) NOT NULL,
  `bathroom` varchar(50) NOT NULL,
  `kitchen` varchar(52) NOT NULL,
  `balconies` varchar(52) NOT NULL,
  `description` text NOT NULL,
  `active_status` int(11) NOT NULL,
  `img_1` varchar(252) NOT NULL,
  `img_2` varchar(252) NOT NULL,
  `img_3` varchar(252) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_house`
--

INSERT INTO `tbl_house` (`id`, `owner_id`, `tenant_id`, `address`, `road_no`, `house_no`, `rental_value`, `house_type`, `floor`, `bedroom`, `dinning_room`, `bathroom`, `kitchen`, `balconies`, `description`, `active_status`, `img_1`, `img_2`, `img_3`) VALUES
(34, 53, 0, 'mirpur', '5', '12', '16000', 'Family', '4', '0', '', '0', '', '', 'la la', 0, '', '', ''),
(35, 53, 0, 'mirpur', '5', '12', '16000', 'Family', '4', '', '', '', '', '', '', 0, '', '', ''),
(38, 53, 52, 'mirpur', '6', '12', '16000', 'Family', '4', '2', 'Yes', '3', 'No', 'No', 'good', 0, 'uploads/a0919c34cb.jpg', '', 'uploads/64d5505579.jpg'),
(47, 53, 0, 'mirpur', '5', '12', '19900-25300', 'Family', '4', '2', 'Yes', '1', 'Yes', 'Yes', 'lorem ipsam dolor 2', 0, 'uploads/7d8d5f9135.jpg', 'uploads/48ee4e3170.jpg', 'uploads/f5c7fd2f48.png'),
(73, 53, 0, 'mirpur', '5', '12', '23600 -43800', 'Family', '4', '2', 'Yes', '2', 'Yes', 'Yes', 'lorem ipsam', 0, 'uploads/078fce22b5.jpg', '', ''),
(74, 53, 0, 'Uttora', '5', '12', '38200', 'Family', '4', '2', 'Yes', '2', '', 'Yes', 'lrem ipsam 2', 0, 'uploads/8fd175ab30.jpg', '', ''),
(75, 53, 0, 'motijheel', '6', '12', '23700 -29200', 'Bachelor', '7', '', 'Yes', '1', 'Yes', 'Yes', 'yes to go.', 0, 'uploads/31d01d7fd7.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id` int(50) NOT NULL,
  `from_id` int(50) NOT NULL,
  `to_id` int(50) NOT NULL,
  `message` text NOT NULL,
  `read_message` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`id`, `from_id`, `to_id`, `message`, `read_message`, `time`) VALUES
(2, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=\"34\">house</a> is rejected by the owner!', 0, '2019-03-12 19:57:03'),
(3, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=47\">house</a> is rejected by the owner!', 0, '2019-03-12 21:42:12'),
(4, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=35\">house</a> is accepted by the owner!', 0, '2019-03-12 21:45:11'),
(5, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=47\">house</a> is rejected by the owner!', 0, '2019-03-13 06:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rentrequest`
--

CREATE TABLE `tbl_rentrequest` (
  `id` int(50) NOT NULL,
  `house_id` int(50) NOT NULL,
  `tenant_id` int(50) NOT NULL,
  `owner_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rentrequest`
--

INSERT INTO `tbl_rentrequest` (`id`, `house_id`, `tenant_id`, `owner_id`) VALUES
(7, 35, 52, 53),
(10, 38, 52, 53),
(11, 47, 52, 53);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `user` enum('owner','tenant') DEFAULT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `email` varchar(52) NOT NULL,
  `password` varchar(152) NOT NULL,
  `nid` int(20) NOT NULL,
  `address` text NOT NULL,
  `pic` varchar(32) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `account` int(10) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user`, `fname`, `lname`, `email`, `password`, `nid`, `address`, `pic`, `phone_number`, `account`, `description`) VALUES
(52, 'tenant', 'arif', 'khan', 'arif@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '', '', '', 0, ''),
(53, 'owner', 'shakil', 'ahmed', 'shakil619619@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '', '', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_house`
--
ALTER TABLE `tbl_house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rentrequest`
--
ALTER TABLE `tbl_rentrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_house`
--
ALTER TABLE `tbl_house`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_rentrequest`
--
ALTER TABLE `tbl_rentrequest`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
