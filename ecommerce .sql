-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 05:54 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `ProductID`, `Total`) VALUES
(1, 1, 3, '0.00'),
(8, 1, 2, '0.00'),
(9, 1, 2, '180.00'),
(10, 1, 2, '180.00'),
(13, 1, 2, '180.00'),
(15, 1, 2, '180.00'),
(16, 1, 3, '60.00'),
(17, 1, 4, '19.99'),
(18, 3, 4, '19.99');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductPrice` decimal(10,2) NOT NULL,
  `ProductImage` varchar(50) NOT NULL,
  `ProductDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `ProductPrice`, `ProductImage`, `ProductDesc`) VALUES
(1, '\'Vices\' Varsity Jacket', '1000.00', 'Images/Varsity-Front.png', '<p> Patchwork on front </p>\r\n\r\n<p> Screen printed on the back </p>\r\n\r\n<p> Limited to 10 jackets made, all individually numbered </p>\r\n\r\n<p> Comes with unreleased signed poster (18x24) </p>\r\n\r\n<p> Please allow 12-18 weeks for production & shipping time </p>\r\n\r\n<p> (This is a pre-order and all sales are final) </p> '),
(2, '\'Vices\' Golf Jacket', '180.00', 'Images/GJacket-front.png', '<p> Chain stitched letters on front </p>\r\n\r\n<p> Screen printed on the back </p>\r\n\r\n<p> Limited to quantity of 60 made </p>\r\n\r\n<p> Please allow 8-15 weeks for production & shipping time </p>\r\n\r\n<p> (This is a pre-order and all sales are final) </p> '),
(3, '\'Vices\' 12-Inch Vinyl', '60.00', 'Images/Vices-vinyl.png', '<p> 12-inch vinyl record </p>\r\n\r\n<p> Containing the audio to \'Vices\' </p>\r\n\r\n<p> Limited to 500 vinyl records </p>\r\n\r\n<p> Please allow 6-12 weeks for production and shipping </p>\r\n\r\n<p> (This is a pre-order and all sales are final) </p> '),
(4, 'Packrunner Classic T-Shirt', '19.99', 'Images/Packrunner.png', 'Rep the top selling album of every year Packrunner! ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserType` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `UserType`) VALUES
(1, 'mike', '1234', 'customer'),
(2, 'john', '1234', 'seller'),
(3, 'mary', '1234', 'customer'),
(7, 'oisin', '1234', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `fk1` (`ProductID`),
  ADD KEY `fk2` (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
