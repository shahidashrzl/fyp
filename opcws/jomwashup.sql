-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 05:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jomwashup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `booking_id` varchar(10) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `name`, `email`, `password`, `phone`) VALUES
(19, 'Hannah Delisha', 'hannah@yahoo.com', 'h123', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id_provider` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `location` text NOT NULL,
  `city` varchar(40) DEFAULT NULL,
  `postcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id_provider`, `name`, `email`, `phone`, `username`, `password`, `location`, `city`, `postcode`) VALUES
(14, 'Aishah', 'aishah@yahoo.com', '0175475729', 'aishahlatif', 'a123', 'Sparkle Wash', 'Selangor', '40150'),
(15, 'Haziq Najwan', 'jiko@gmail.com', '0162011947', 'jiko', 'j123', 'Lot 7, WashBay', 'Bayan Lepas', '11300'),
(17, 'Amirah', 'amirah77@gmail.com', '0103648110', 'amirah_', 'a123', 'Call2Wash Sdn.Bhd', 'Sintok', '01720'),
(18, 'Syafiq Kyle', 'syaf1q@yahoo.com', '0135172308', 'syaf1q', 'syafiq123', 'Shine Station', 'Perak', '34000');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `service_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_service`, `id_provider`, `title`, `description`, `price`, `service_type`) VALUES
(48, 14, 'Advanced Washing', 'Deliver highest quality of deep interior and exterior cleaning', '25.00', 'Walk-In'),
(50, 15, 'Waxing', 'Provide additional protection on car surface with premium wax coating', '60.00', 'Doorstep'),
(53, 17, 'Body Polish', 'Provide shinier surface and glossy effect on car\'s body', '30.00', 'Doorstep'),
(54, 17, 'Body Polish', 'Provide shinier surface and glossy effect on car\'s body', '25.00', 'Walk-In'),
(55, 18, 'Normal Washing', 'Basic exterior cleaning using water, car shampoo, and a soft brush.', '10.00', 'Walk-in'),
(56, 17, 'Advanced Washing', 'Involves pre-wash assessment ensuring thorough cleaning', '20.00', 'Walk-In'),
(58, 20, 'Disinfectant', 'uses EPA-approved disinfectants to sanitize thoroughly', '35.00', 'Doorstep');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id_provider`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id_provider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
