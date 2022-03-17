-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 12:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(80, 55, 0, 'Juja Gate A', 'Gachororo', '106', '10800', 'Bachelor', '2', '1', 'No', '1', 'No', 'Yes', 'A magnificent old model but well maintained 5 bedroom double storey house on 0.5 acre plot.\r\nVery spacious all en suite bedrooms.\r\nWith wooden flooring.\r\nLounge with a fire place.\r\nDining room extending to a patio.\r\nSpacious kitchen with a breakfast area.\r\nLockable garage for 2.\r\nMature garden and mature trees.\r\nPerimeter wall and electric fencing.\r\nPower back-up generator.\r\nUN/DSS security compliant.', 0, 'uploads/c2ccaa732a.jpeg', '', ''),
(82, 55, 0, 'Syokimau', 'Syokimau - Katani Rd', '12HB', '83400', 'Family', '2', '5', 'Yes', '3', 'Yes', 'Yes', 'Very spacious 5 bedroom house to let in syokimau\r\nIf you have been asking yourself where can you find a Very spacious ,executive ,well designed and comfort home to raise your family in a superb environment of syokimau, and yet price friendly then the answer is here.A place you call a home .This is a 5 Bedroom Townhouse ,all ensuite with 2 Dsq To Let In Syokimau. Located 1.1km from Mombasa road in a gated court with a common entrance and security at the gate. In the locality is Gateway Mall, SGR, JKI AIRPORT, Viraj International School, 67 hotel etc. The siting room is spacious and kingish of well designed and comfort.Is like a kings palace .', 0, 'uploads/6334716dc4.jpg', 'uploads/1e9e3504ae.jpg', 'uploads/f7f3b2aa41.jpg');

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
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`id`, `from_id`, `to_id`, `message`, `read_message`, `time`) VALUES
(2, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=\"34\">house</a> is rejected by the owner!', 0, '2019-03-12 19:57:03'),
(3, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=47\">house</a> is rejected by the owner!', 0, '2019-03-12 21:42:12'),
(4, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=35\">house</a> is accepted by the owner!', 0, '2019-03-12 21:45:11'),
(5, 53, 52, 'Your booked request for this <a href=\"housedetails.php?house_id=47\">house</a> is rejected by the owner!', 0, '2019-03-13 06:18:37'),
(7, 54, 55, 'You got a rent request for this <a href=\"housedetails.php?house_id=76\">home</a> from a tenant!', 0, '2022-03-01 19:17:19'),
(8, 55, 54, 'Your booked request for this <a href=\"housedetails.php?house_id=76\">house</a> is accepted by the owner!', 0, '2022-03-09 12:37:45'),
(9, 56, 55, 'You got a rent request for this <a href=\"housedetails.php?house_id=77\">home</a> from a tenant!', 0, '2022-03-09 12:46:38'),
(10, 55, 56, 'Your booked request for this <a href=\"housedetails.php?house_id=77\">house</a> is rejected by the owner!', 0, '2022-03-09 12:47:38'),
(11, 55, 54, 'Your booked request for this <a href=\"housedetails.php?house_id=76\">house</a> is rejected by the owner!', 0, '2022-03-14 11:22:52'),
(12, 56, 55, 'You got a rent request for this <a href=\"housedetails.php?house_id=78\">home</a> from a tenant!', 0, '2022-03-14 13:21:59'),
(13, 56, 55, 'You got a rent request for this <a href=\"housedetails.php?house_id=78\">home</a> from a tenant!', 1, '2022-03-17 22:45:12');

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
(11, 47, 52, 53),
(14, 78, 56, 55),
(15, 78, 56, 55);

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
(54, 'tenant', 'Eddy', 'Ndumia', 'fegilej797@reimondo.com', '1b6c3e5b16623d89c18dfa9a3f059421', 0, '', '', '', 0, ''),
(55, 'owner', 'Moses', 'Maina', 'e4ruthless@gmail.com', '1b6c3e5b16623d89c18dfa9a3f059421', 24656454, 'Juja Gate A', 'uploads/profile/cd10d87443.jpeg', '0759071482', 0, 'Caretaker mzuri sana'),
(56, 'tenant', 'Joy', 'Mutua', 'joy@gmail.com', 'dc4921dc02b7483b6671c7fc44e55b70', 0, '', '', '', 0, ''),
(57, 'tenant', 'James', 'Mwai', 'sidase3566@snece.com', '1b6c3e5b16623d89c18dfa9a3f059421', 0, '', '', '', 0, ''),
(58, 'owner', 'Steve', 'Muiga', 'muiga@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 39172687, 'Gachororo', 'uploads/profile/2bab2d450a.jpg', '0768519115', 0, ''),
(59, 'tenant', 'Lorenza', 'Idris', 'idris@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '', '', '', 0, '');

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_rentrequest`
--
ALTER TABLE `tbl_rentrequest`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
