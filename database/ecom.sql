-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 09:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `qty`, `total_price`) VALUES
(35, 4, 7, 1, 1450);

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `cart_cnt` AFTER INSERT ON `cart` FOR EACH ROW UPDATE cart_detail SET product_count = (SELECT count(user_id) FROM cart WHERE cart.user_id = cart_detail.user_id) WHERE cart_detail.user_id = new.user_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cart_cnt_update` AFTER DELETE ON `cart` FOR EACH ROW UPDATE cart_detail SET product_count = (SELECT count(user_id) FROM cart WHERE cart.user_id = cart_detail.user_id) WHERE cart_detail.user_id = old.user_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`id`, `user_id`, `product_count`) VALUES
(7, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(2, 'Ethnic', 1),
(3, 'sportswear', 1),
(4, 'casual', 1),
(5, 'Shoes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `city`, `pincode`, `total_price`, `order_status`, `payment_status`, `added_on`) VALUES
(10, 7, 'H.NO 12/12 marathahalli', 'Bengaluru', 560069, 1450, 0, 0, '2021-01-09 09:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`, `added_on`) VALUES
(11, 10, 4, 1, 1450, '2021-01-09 09:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `short_desc` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_desc` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(1, 5, 'men sneakers', 2020, 1990, 0, '1346136_Men-shoes-2018-fashion-new-arrivals-warm-winter-shoes-men-High-quality-frosted-suede-shoes-men__70277.1545975473.jpg', 'Men shoes 2019 fashion new arrivals warm winter shoes men High quality frosted suede shoes men sneakers', 'Men shoes 2018 fashion new arrivals warm winter shoes men High quality frosted suede shoes men sneakers', '', '', '', 1),
(3, 3, 'Round neck full sleeve', 599, 549, 12, '4864070_1_396_men sport.jpg', 'Sportswear Round Neck Full Sleeve Gym t-shirt for Men-Dark Grey', 'Sportswear Round Neck Full Sleeve Gym t-shirt for Men-Dark Grey', '', '', '', 1),
(4, 3, 'Nike Fleece', 1500, 1450, 70, '3915017_19NIKWTRNDSSNTLFLAPT_Ash_Green.jpg', 'Nike Sportswear Women\'s Essentials Fleece Cropped Crew', 'Nike Sportswear Women\'s Essentials Fleece Cropped Crew', '', '', '', 1),
(5, 4, 'Palazzo', 499, 289, 66, '9324182_f_casual.jpg', 'Female Casual Wear Maitri Rayon Solid Palazzo For Girls/Women\'s', 'Female Casual Wear Maitri Rayon Solid Palazzo For Girls/Women\'s', '', '', '', 1),
(6, 2, 'Silk Kurta set', 1899, 1699, 48, '1200694_men-eth.jpg', 'Designer Blue Color Art Silk Ethnic Wear Kurta Set For Mens', 'Designer Blue Color Art Silk Ethnic Wear Kurta Set For Mens', '', '', '', 1),
(7, 2, 'Net salwar kameez', 1999, 1759, 36, '6542608_suit_f.jpg', 'Ethnic Wear Designer Net Salwar Kameez In Grey Color With Embroidery', 'Ethnic Wear Designer Net Salwar Kameez In Grey Color With Embroidery', '', '', '', 1),
(8, 4, 'Cotton Printed', 499, 399, 56, '1341995_man-casual-wear.jpg', 'Cotton printed man casual wear', 'Indo Shine Industries - Offering Cotton Printed Man Casual Wear at Rs 499/piece in Noida, Uttar Pradesh. Read about company. Get contact details and ..', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `added_on`) VALUES
(7, 'Sidhant', 'ssid23@gmail.com', 'hello', '8989898989', '2021-01-09 09:12:25');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `cart_user` AFTER INSERT ON `users` FOR EACH ROW INSERT into cart_detail(user_id) SELECT id FROM users
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
