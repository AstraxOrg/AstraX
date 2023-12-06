-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 06:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_count` int(10) NOT NULL,
  `item_photo_path` varchar(100) NOT NULL,
  `item_price` int(30) NOT NULL,
  `item_size` varchar(30) NOT NULL,
  `item_color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_name` varchar(500) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `photo_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_name`, `item_name`, `photo_path`) VALUES
('Black', 'AstraX Dress', 'images\\Clothes\\Dresses\\blackdress.jpg'),
('Black', 'AstraX pants', 'images\\Clothes\\Pants\\blackpants.png'),
('Black', 'AstraX Shirt', 'images\\Clothes\\Shirts\\blackshirt.jpg'),
('Black', 'AstraX Shoes', 'images\\Clothes\\Shoes\\shoe1black.jpg'),
('Black', 'Cheap Shoes', 'images\\Clothes\\Shoes\\shoe2black.jpg'),
('Blue', 'AstraX Dress', 'images\\Clothes\\Dresses\\bluedress.jpg'),
('Blue', 'AstraX pants', 'images\\Clothes\\Pants\\bluepants.png'),
('Blue', 'AstraX Shirt', 'images\\Clothes\\Shirts\\blueshirt.jpg'),
('Green', 'AstraX Dress', 'images\\Clothes\\Dresses\\greendress.jpg'),
('Green', 'AstraX pants', 'images\\Clothes\\Pants\\greenpants.png'),
('green', 'AstraX Shirt', 'images\\Clothes\\Shirts\\greenshirt.jpg'),
('Magenta', 'Cheap Shoes', 'images\\Clothes\\Shoes\\shoe2magenta.jpg'),
('Red', 'AstraX Dress', 'images\\Clothes\\Dresses\\reddress.jpg'),
('Red', 'AstraX pants', 'images\\Clothes\\Pants\\redpants.png'),
('Red', 'AstraX Shirt', 'images\\Clothes\\Shirts\\redshirt.jpg'),
('Red', 'AstraX Special Boots', 'images\\Clothes\\Boots\\boots.png'),
('White', 'AstraX Shoes', 'images\\Clothes\\Shoes\\shoe1white.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `designer_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_name`, `price`, `designer_name`, `category`, `details`, `quantity`) VALUES
('AstraX Dress', 1000, 'Abd Al-Aziz', 'Dress', 'Time to look fancy.', 10),
('AstraX pants', 120, 'Ahmad', 'Pants', 'Pants that are great for sleepovers.', 10),
('AstraX Shirt', 99, 'Amer', 'Shirt', 'These shirts are everything you need in life.', 10),
('AstraX Shoes', 59, 'Raghad', 'Shoes', 'Bulletproof shoes for walking on water.', 10),
('AstraX Special Boots', 420, 'AstraX Corporation', 'Boots', 'They\'re buying you.', 10),
('Cheap Shoes', 7899, 'No one knows', 'Shoes', 'Why are you even buying these shoes?', 10);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_name` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `phonenum` varchar(14) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `firstname`, `lastname`, `dob`, `phonenum`, `address`) VALUES
('abd', 'abd@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', '', '', ''),
('sss', 'sss@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', '', '', ''),
('user', 'a@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'abd', 'arki', '2020/2/2', '0994055332', ''),
('user1', 'user1@email.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_name`,`item_name`,`item_size`,`item_color`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_name`,`item_name`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_name`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_name`,`item_name`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_name`,`item_name`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `item` (`item_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `color`
--
ALTER TABLE `color`
  ADD CONSTRAINT `color_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `item` (`item_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `item` (`item_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `item` (`item_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
