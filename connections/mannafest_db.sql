-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 05:20 PM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u607598273_mannafest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `user_type` varchar(40) NOT NULL,
  `vcode` varchar(40) DEFAULT NULL,
  `date_registered` date NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `birthdate` date NOT NULL,
  `address` text NOT NULL,
  `postal` int(11) DEFAULT NULL,
  `d_address` text NOT NULL,
  `cardname` text NOT NULL,
  `cardnumber` text NOT NULL,
  `cvv` int(11) NOT NULL,
  `ipaddress` text NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `name`, `lastname`, `email`, `user_type`, `vcode`, `date_registered`, `password`, `mobile_number`, `photo`, `birthdate`, `address`, `postal`, `d_address`, `cardname`, `cardnumber`, `cvv`, `ipaddress`, `status`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', NULL, '2022-01-31', 'eldwUUFNbnlSUWZEYjVrUjhrTmRBUT09', NULL, NULL, '0000-00-00', '', NULL, '', '', '', 0, '', '1'),
(24, 'Benmar', 'Sanchez', 'courier@mail.com', 'courier', NULL, '2022-10-06', 'eldwUUFNbnlSUWZEYjVrUjhrTmRBUT09', '09456517431', '', '0000-00-00', '', NULL, '', '', '', 0, '', NULL),
(56, 'Test', 'Abby', 'abby@gmail.com', 'client', NULL, '2022-12-13', 'SW5GcnNoSWlEUVpnQ0VmTGlOTE50QT09', '+639352232051', NULL, '2022-12-13', 'Southcom Village', NULL, 'Southcom Village', '', '', 0, '::1', '1'),
(59, 'Walk-in', 'Customer', 'walkin@walkin.com', 'walkin', NULL, '2023-01-05', 'N25RNHZNWkNINExELzMyeTJDMGIyQT09', '123', '', '0000-00-00', '', NULL, '', '', '', 0, '', NULL),
(60, 'Distributor', 'Distributor', 'distributor@distributor.com', 'distributor', NULL, '2023-01-10', 'Distributor', NULL, '', '0000-00-00', '', NULL, '', '', '', 0, '', NULL),
(63, 'Rexan', 'Alaban', 'courier2@mail.com', 'courier', NULL, '2023-01-16', 'eldwUUFNbnlSUWZEYjVrUjhrTmRBUT09', '09456517431', NULL, '0000-00-00', '', NULL, '', '', '', 0, '', NULL),
(64, 'Abby', 'Quintos', 'abbyq@gmail.com', 'client', NULL, '2023-02-02', 'SW5GcnNoSWlEUVpnQ0VmTGlOTE50QT09', '09456517431', NULL, '0000-00-00', '', NULL, '', '', '', 0, '', NULL),
(65, 'Rosebel', 'Sandigan', 'rosebelsandigan@gmail.com', 'client', NULL, '2023-02-05', 'bVY3ZmdzTEZSS0Zudjd2RXhWRTdQdz09', '+639175502200', NULL, '1996-08-19', 'Quintos Drive, Divisoria, Zamboanga City', NULL, 'Quintos Drive, Divisoria, Zamboanga City', '', '', 0, '2001:4455:6e3:7c00:b8c1:801a:d8a5:3803', '1');

-- --------------------------------------------------------

--
-- Table structure for table `account_ship_address`
--

CREATE TABLE `account_ship_address` (
  `ship_id` int(11) NOT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_ship_address`
--

INSERT INTO `account_ship_address` (`ship_id`, `contact_name`, `phone_number`, `address`, `postal_code`, `user_id`, `status`, `address_1`, `address_2`) VALUES
(22, 'Test Abby', '09456517431', 'Southcom Village', '7000', 56, 0, NULL, NULL),
(30, 'Distributor Test', '3433333', 'Brgy. Maganda, 777, Zamboanga del Sur', '7302', 56, 1, 'Brgy. Maganda', '777'),
(31, 'Distributor Test', '3433333', 'Brgy. Maganda, 232, Zamboanga City', '7302', 56, 0, 'Brgy. Maganda', '232'),
(32, 'Abby Quintos', '9456517431', 'Divisoria, Zone V, none, Zamboanga City', '7000', 64, 1, 'Divisoria, Zone V', 'none'),
(33, 'Rosebel Sandigan', '+639175502200', 'Quintos Drive, Divisoria, Zamboanga City', '7000', 65, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `itemprice` float NOT NULL,
  `total` float NOT NULL,
  `user_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category_name`, `datecreated`) VALUES
(1, 'Bread', '2023-01-12 21:22:32'),
(2, 'Biscuit', '2023-02-02 18:27:56'),
(3, 'Others', '2023-02-02 18:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `chat_acc`
--

CREATE TABLE `chat_acc` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` enum('Guest','Operator') NOT NULL,
  `secret` varchar(255) NOT NULL DEFAULT '',
  `last_seen` datetime NOT NULL,
  `status` enum('Occupied','Waiting','Idle') NOT NULL DEFAULT 'Idle'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_acc`
--

INSERT INTO `chat_acc` (`id`, `email`, `password`, `full_name`, `role`, `secret`, `last_seen`, `status`) VALUES
(1, 'operator@mail.com', '$2y$10$thE7hIJF/EJvKjmJy7hd5uH3a/BNgSUepkYoES0q80YEzi7VqWsRG', 'Operator', 'Operator', '$2y$10$lqkp9JCHT3QGvWtaiyK9AOFRI1aU9FSUXIU1iNn4f0KNtUEJOfmRW', '2023-01-31 19:47:19', 'Occupied'),
(12, 'ronaldxdale@gmail.com', '', 'Hello', 'Guest', '$2y$10$XRLT1eU5XIl.3G5WiA0EYO/XPSLWg4z61ksNoy8XzWpvXc5973sX.', '2023-01-15 20:24:32', 'Idle'),
(13, 'operator@gmail.com', '', 'rom', 'Guest', '$2y$10$DV5xpuL8xfG9LbB4PQ/pcO2IGKahPASgvERmVAhTZwWQrDHqVTmjW', '2023-01-15 20:24:57', 'Idle'),
(14, 'operator@mail.com', '', 'Distributor Distributor', 'Guest', '$2y$10$9IdxacdoIcggLT/aOyV5G.J2ZGQvKuZUtsTl7XJ7.54ZBcczTMRRG', '2023-01-31 19:45:34', 'Idle'),
(15, 'abby@gmail.com', '', 'DALE TEST', 'Guest', '$2y$10$zxcIycI6Vf9IlQ4afoNI0uy5FYvEKeY9.X9piGWYiWiZDoxpOzRea', '2023-01-31 20:04:59', 'Occupied');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `account_sender_id` int(11) NOT NULL,
  `account_receiver_id` int(11) NOT NULL,
  `submit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courier_trans`
--

CREATE TABLE `courier_trans` (
  `courier_trans_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `total_remit` varchar(255) DEFAULT NULL,
  `total_cash_onhand` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier_trans`
--

INSERT INTO `courier_trans` (`courier_trans_id`, `user_id`, `date`, `total_amount`, `total_remit`, `total_cash_onhand`) VALUES
(1, 63, '2023-02-05', '153.42', '0', '153.42'),
(2, 24, '2023-02-05', '513.2', '0', '513.2'),
(3, 24, '2023-02-06', '552.6', '0', '552.6'),
(4, 63, '2023-02-15', '253.04', '0', '253.04'),
(5, 24, '2023-02-17', '457.75', '0', '457.75');

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback`
--

CREATE TABLE `customer_feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_feedback`
--

INSERT INTO `customer_feedback` (`feedback_id`, `name`, `email`, `feedback`, `date`) VALUES
(3, 'Abby Quintos', 'abbyq@gmail.com', 'i love your products! ', '2023-02-05'),
(4, 'Mark Den', 'markden1@markkden.com', 'Good day, \r\n \r\nI contacted you some days back seeking your cooperation in a matter regarding funds worth $24 Million, I urge you to get back to me immediately. \r\nmarkden@markkden.com \r\n \r\nI await your response. \r\n \r\nThanks, \r\n \r\nMark Den', '2023-02-06'),
(5, 'Mike Kelly\r\n', 'no-replySkycle@gmail.com', 'Hi there \r\n \r\nJust checked your mannafest-app.online in MOZ and saw that you could use an authority boost. \r\n \r\nWith our service you will get a guaranteed Domain Authority score within just 3 months time. This will increase the organic visibility and stre', '2023-02-07'),
(6, 'Mike Oakman\r\n', 'no-replySkycle@gmail.com', 'If you have a local business and want to rank it on google maps in a specific area then this service is for you. \r\n \r\nGoogle Map Stacking is one of the best ways to rank your GMB in a specific mile radius. \r\n \r\nMore info: \r\nhttps://www.speed-seo.net/produ', '2023-02-09'),
(7, 'Mike Molligan\r\n', 'no-replySkycle@gmail.com', 'Howdy \r\n \r\nI have just analyzed  mannafest-app.online for the ranking keywords and saw that your website could use a push. \r\n \r\nWe will enhance your SEO metrics and ranks organically and safely, using only whitehat methods, while providing monthly reports', '2023-02-14');

-- --------------------------------------------------------

--
-- Table structure for table `distributor_details`
--

CREATE TABLE `distributor_details` (
  `dis_id` int(11) NOT NULL,
  `distributor_name` varchar(255) NOT NULL,
  `distributor_contact` varchar(255) DEFAULT NULL,
  `distributor_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor_details`
--

INSERT INTO `distributor_details` (`dis_id`, `distributor_name`, `distributor_contact`, `distributor_address`) VALUES
(1, 'Best Reach Out Sells Inc.(Ozamis Branch)', '992-2003', 'Ozamis City'),
(2, 'Best Reach Out Sells Inc.', '992-2003', 'Veterans Ave.,Zamboanga City');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `submit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `otp-sms`
--

CREATE TABLE `otp-sms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `is_valid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `p_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`p_id`, `prod_id`, `photo`) VALUES
(5, 5, 'wheat500g (wecompress.com).png'),
(6, 6, 'hotdog_buns (wecompress.com).png'),
(7, 7, 'cream_bread (wecompress.com).png'),
(8, 8, 'ube_creambread2 (wecompress.com).png'),
(9, 9, 'wheat440g (wecompress.com).png'),
(10, 10, 'burger_buns (wecompress.com).png'),
(11, 11, 'tm_200g (wecompress.com).png'),
(12, 12, 'biscocho_200g (wecompress.com).png'),
(13, 13, 'egg_cracklets200g (wecompress.com).png'),
(14, 14, 'otap_200g (wecompress.com).png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `ingredients` varchar(255) DEFAULT NULL,
  `stockAlert` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `barcode`, `name`, `description`, `cat_id`, `cost`, `price`, `datecreated`, `ingredients`, `stockAlert`) VALUES
(5, '4809014209647', 'Manna Wheat Bread 500g', '500g', 1, 48, 63.26, '2023-02-02 18:20:27', 'Flour, water, milk,', NULL),
(6, '4809014209869', 'Manna Hotdog Bun 50g', '50g', 1, 24, 28.29, '2023-02-02 18:21:08', 'Flour, water, milk,', NULL),
(7, '4809014209616', 'Manna Cream Bread 500g', '500g', 1, 46, 55.26, '2023-02-05 08:46:16', 'Flour, sugar, milk', NULL),
(8, '4809014215709', 'Manna UBE Cream Bread 440g', '440g', 1, 58, 69.82, '2023-02-05 22:46:37', 'Flour, sugar, milk', NULL),
(9, '4809014209890', 'Manna Wheat Bread 440g', '440g', 1, 50, 59.78, '2023-02-05 22:47:37', 'Flour, sugar, milk', NULL),
(10, '4809014209814', 'Manna Burger Buns 50g', '50g', 1, 24, 28.29, '2023-02-05 22:48:19', 'Flour, sugar, milk', NULL),
(11, '4809014209234', 'Manna Toasted Mamon 200g x 48', '200g x 48', 2, 66, 79.05, '2023-02-05 22:49:08', 'Flour, sugar, milk', NULL),
(12, '4809014209111', 'Manna Biscocho 200g x 48', '200g x 48', 2, 40, 47.38, '2023-02-05 22:51:22', 'Flour, sugar, milk', NULL),
(13, '4809014209425', 'Manna Cracklet 200g x 48', '200g x 48', 2, 47, 55.88, '2023-02-05 22:52:18', 'Flour, sugar, milk', NULL),
(14, '4809014209012', 'Manna Otap 200g x 48', '200g x 48', 2, 40, 48.14, '2023-02-05 22:52:50', 'Flour, sugar, milk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `production_log`
--

CREATE TABLE `production_log` (
  `log_id` int(11) NOT NULL,
  `production_code` varchar(255) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `qty_added` int(11) DEFAULT NULL,
  `qty_remaining` int(11) DEFAULT NULL,
  `prod_date` varchar(255) DEFAULT NULL,
  `exp_date` varchar(255) DEFAULT NULL,
  `price` int(255) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `production_log`
--

INSERT INTO `production_log` (`log_id`, `production_code`, `prod_id`, `qty_added`, `qty_remaining`, `prod_date`, `exp_date`, `price`, `cost`, `status`) VALUES
(25, 'P2023001', 5, 50, 50, '2023-02-08', '2023-02-11', 55, 46, 'EXPIRED'),
(26, 'P2023002', 5, 20, -15, '2023-02-08', '2023-02-11', 61, 48, 'EXPIRED'),
(27, 'P2023003', 6, 10, 10, '2023-02-08', '2023-02-08', 28, 24, 'EXPIRED'),
(28, 'P2023004', 5, 20, 20, '2023-02-11', '2023-02-14', 63, 48, 'EXPIRED'),
(29, 'P2023005', 5, 50, 35, '2023-02-17', '2023-02-23', 63, 48, 'ACTIVE'),
(30, 'P2023006', 6, 50, 35, '2023-02-17', '2023-02-23', 28, 24, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `product_quantity`
--

CREATE TABLE `product_quantity` (
  `prod_qty_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `promo_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `minvalue_toavail` float NOT NULL,
  `discount` float NOT NULL,
  `datecreated` datetime NOT NULL,
  `expiration-date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`promo_id`, `code`, `minvalue_toavail`, `discount`, `datecreated`, `expiration-date`) VALUES
(1, 'oh27z', 100, 100, '2023-01-15 23:29:27', 'No Expiry');

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE `return_product` (
  `r_id` int(11) NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_product`
--

INSERT INTO `return_product` (`r_id`, `return_id`, `prod_id`, `qty`, `total`) VALUES
(4, 3, 5, 10, 612);

-- --------------------------------------------------------

--
-- Table structure for table `return_request`
--

CREATE TABLE `return_request` (
  `return_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `selected_prod` varchar(255) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `proof_img` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `decision` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_ordered` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `reason_select` varchar(255) NOT NULL,
  `date_verdict` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `trans_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_request`
--

INSERT INTO `return_request` (`return_id`, `user_id`, `selected_prod`, `transaction_id`, `proof_img`, `reason`, `remarks`, `decision`, `status`, `date_ordered`, `payment_type`, `reason_select`, `date_verdict`, `type`, `trans_code`) VALUES
(3, 59, '5', 0, NULL, 'Good Stock', 'near expiry', NULL, 'CONFIRMED', '2023-02-09 07:04:43', 'Walkin', '', NULL, 'admin', 'M2023008');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_rating`, `user_review`, `datetime`, `user_id`, `prod_id`, `transaction_id`) VALUES
(2, 5, 'lamiiii', 1676568101, 64, 5, 1),
(3, 4, 'saraaaappp', 1676568115, 64, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `autoReceived` int(11) DEFAULT NULL,
  `minTotalOrder` int(11) DEFAULT NULL,
  `minMaxOrder` int(11) DEFAULT NULL,
  `deliveryMessage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `autoReceived`, `minTotalOrder`, `minMaxOrder`, `deliveryMessage`) VALUES
(1, 1, 250, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tempuser`
--

CREATE TABLE `tempuser` (
  `temp_id` int(11) NOT NULL,
  `ipaddress` text NOT NULL,
  `datecreated` datetime NOT NULL,
  `lastname` text NOT NULL,
  `firstname` text NOT NULL,
  `birthdate` date NOT NULL,
  `address` text NOT NULL,
  `deliveryaddr` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `postal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tempuser`
--

INSERT INTO `tempuser` (`temp_id`, `ipaddress`, `datecreated`, `lastname`, `firstname`, `birthdate`, `address`, `deliveryaddr`, `email`, `password`, `mobile_number`, `postal`) VALUES
(1, '2a02:4780:3:8::7', '2023-02-05 19:28:27', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(2, '40.77.167.248', '2023-02-05 20:17:06', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(3, '178.236.133.133', '2023-02-05 22:06:39', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(4, '110.54.201.150', '2023-02-05 22:25:09', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(5, '2001:4455:6e3:7c00:d301:538e:7f82:7199', '2023-02-05 23:26:07', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(6, '49.149.101.93', '2023-02-05 23:29:56', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(7, '2001:4455:6e3:7c00:18a0:5c82:85ba:969d', '2023-02-05 23:38:12', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(8, '139.99.131.38', '2023-02-06 00:29:02', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(9, '131.153.143.50', '2023-02-06 00:45:11', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(10, '112.198.99.55', '2023-02-06 02:23:08', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(11, '2001:fd8:2645:8b7:e4e3:5e19:7a32:6274', '2023-02-06 11:32:25', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(12, '113.142.131.55', '2023-02-06 12:20:50', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(13, '110.54.158.158', '2023-02-06 12:52:58', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(14, '110.54.158.230', '2023-02-06 12:53:28', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(15, '58.71.15.5', '2023-02-06 12:59:31', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(16, '110.54.158.205', '2023-02-06 15:24:08', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(17, '35.196.212.67', '2023-02-06 15:24:12', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(18, '37.139.53.82', '2023-02-06 16:04:07', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(19, '35.185.8.253', '2023-02-06 16:13:16', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(20, '195.78.54.31', '2023-02-06 16:22:32', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(21, '51.79.82.90', '2023-02-06 16:49:28', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(22, '2001:4455:6e3:7c00:1599:8bc:55c4:e21c', '2023-02-06 17:12:01', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(23, '34.138.199.158', '2023-02-06 17:12:51', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(24, '63.80.2.7', '2023-02-06 18:53:36', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(25, '194.163.154.32', '2023-02-07 00:03:20', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(26, '18.208.148.95', '2023-02-07 05:53:04', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(27, '196.196.53.126', '2023-02-07 10:38:01', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(28, '42.83.147.34', '2023-02-07 10:44:43', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(29, '34.219.4.64', '2023-02-07 13:21:01', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(30, '34.221.124.255', '2023-02-07 13:21:45', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(31, '54.203.81.50', '2023-02-07 13:22:30', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(32, '35.162.72.45', '2023-02-07 13:23:21', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(33, '209.141.36.112', '2023-02-07 15:08:07', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(34, '52.203.23.91', '2023-02-07 16:59:03', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(35, '216.19.204.221', '2023-02-07 20:57:18', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(36, '180.149.28.139', '2023-02-07 20:57:33', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(37, '2001:4455:6e3:7c00:95e9:83b9:31dd:1b79', '2023-02-07 21:22:58', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(38, '34.244.232.173', '2023-02-07 22:00:19', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(39, '54.229.111.240', '2023-02-08 00:51:41', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(40, '87.236.176.83', '2023-02-08 05:43:18', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(41, '193.235.141.133', '2023-02-08 08:11:03', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(42, '2001:4455:6e3:7c00:b8bb:aa38:de7d:6df7', '2023-02-08 08:48:06', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(43, '49.149.103.216', '2023-02-08 10:06:36', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(44, '110.54.202.47', '2023-02-08 16:31:19', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(45, '223.240.99.104', '2023-02-08 17:23:21', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(46, '138.246.253.15', '2023-02-08 18:29:30', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(47, '2001:4455:6e3:7c00:3948:7ba6:ffc7:5ed8', '2023-02-08 20:25:21', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(48, '2001:4455:6e3:7c00:414e:fe6a:b6ce:9f30', '2023-02-09 01:14:25', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(49, '2001:4455:6e3:7c00:2134:73fe:173f:3aac', '2023-02-09 07:01:44', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(50, '84.17.47.6', '2023-02-09 08:06:10', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(51, '131.153.142.170', '2023-02-09 10:08:32', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(52, '18.185.64.152', '2023-02-09 11:01:34', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(53, '2001:4ca0:108:42::15', '2023-02-09 11:06:15', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(54, '34.219.224.42', '2023-02-09 13:36:05', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(55, '34.220.213.67', '2023-02-09 13:36:13', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(56, '34.221.125.85', '2023-02-09 13:50:01', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(57, '216.251.130.74', '2023-02-09 17:12:31', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(58, '2001:4455:6e3:7c00:3ce7:28cd:8b0:6691', '2023-02-09 19:17:39', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(59, '14.116.157.23', '2023-02-09 21:51:19', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(60, '34.66.163.52', '2023-02-10 03:39:02', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(61, '34.173.213.56', '2023-02-10 03:39:03', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(62, '68.69.184.202', '2023-02-10 08:34:08', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(63, '2001:4455:6e3:7c00:2c69:d9d5:1be7:855e', '2023-02-10 10:41:20', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(64, '35.86.177.181', '2023-02-10 13:22:18', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(65, '54.212.51.71', '2023-02-10 13:22:37', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(66, '52.34.59.183', '2023-02-10 13:24:22', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(67, '35.90.195.162', '2023-02-10 13:26:48', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(68, '50.112.3.0', '2023-02-10 13:31:59', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(69, '2001:fd8:2666:1a21:3ca1:b7f6:a27c:4903', '2023-02-10 15:15:42', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(70, '64.226.58.32', '2023-02-10 15:16:11', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(71, '113.142.141.105', '2023-02-10 17:34:50', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(72, '87.236.176.115', '2023-02-10 23:37:58', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(73, '193.235.141.164', '2023-02-11 00:10:15', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(74, '144.217.135.196', '2023-02-11 05:07:15', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(75, '144.217.135.173', '2023-02-11 05:08:06', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(76, '2001:4455:6e3:7c00:115c:85be:977e:9fd2', '2023-02-11 09:27:23', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(77, '2405:8d40:450c:7a69:1742:1f89:b123:e6b0', '2023-02-11 12:57:47', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(78, '54.191.17.120', '2023-02-11 13:20:55', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(79, '34.213.60.90', '2023-02-11 13:21:24', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(80, '35.87.3.177', '2023-02-11 13:48:58', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(81, '2001:4455:6e3:7c00:bd03:f36f:7e3d:448c', '2023-02-11 17:46:39', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(82, '38.153.140.195', '2023-02-11 19:00:52', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(83, '64.226.60.17', '2023-02-11 19:20:53', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(84, '114.107.225.150', '2023-02-12 03:49:08', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(85, '209.146.16.4', '2023-02-12 11:23:52', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(86, '209.141.55.120', '2023-02-12 12:39:30', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(87, '18.236.91.120', '2023-02-12 13:24:22', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(88, '64.226.63.215', '2023-02-12 18:30:00', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(89, '2001:4456:e068:fc00:a811:3967:7ce2:8dcc', '2023-02-12 20:18:56', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(90, '104.244.83.55', '2023-02-12 21:03:25', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(91, '188.212.142.109', '2023-02-12 21:06:40', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(92, '103.83.81.212', '2023-02-13 06:09:39', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(93, '193.235.141.134', '2023-02-13 16:12:12', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(94, '167.94.138.47', '2023-02-13 19:39:21', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(95, '199.47.82.17', '2023-02-14 00:10:18', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(96, '130.255.166.69', '2023-02-14 06:34:31', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(97, '199.244.88.221', '2023-02-14 07:30:59', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(98, '45.128.160.176', '2023-02-14 08:11:10', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(99, '35.165.215.115', '2023-02-14 13:26:38', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(100, '18.236.138.112', '2023-02-14 13:27:06', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(101, '35.90.203.90', '2023-02-14 13:27:43', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(102, '52.12.116.147', '2023-02-14 13:28:00', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(103, '34.222.197.46', '2023-02-14 13:28:02', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(104, '2a03:94e0:ffff:185:181:60:0:189', '2023-02-14 14:21:03', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(105, '84.17.49.72', '2023-02-14 21:29:43', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(106, '34.219.177.128', '2023-02-15 13:39:03', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(107, '113.125.51.198', '2023-02-15 20:43:11', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(108, '2001:4455:6e3:7c00:a94c:616f:755c:1267', '2023-02-15 22:21:25', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(109, '193.235.141.147', '2023-02-16 07:48:48', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(110, '2a03:2880:30ff:b::face:b00c', '2023-02-16 10:09:38', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(111, '209.141.41.193', '2023-02-16 11:56:47', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(112, '35.88.97.20', '2023-02-16 13:40:24', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(113, '52.42.84.52', '2023-02-16 13:40:27', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(114, '18.237.94.222', '2023-02-16 13:40:43', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(115, '34.221.86.186', '2023-02-16 14:06:45', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(116, '113.125.140.19', '2023-02-16 18:15:22', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(117, '2001:4455:6e3:7c00:1c98:292c:9be0:ea8a', '2023-02-16 23:53:23', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(118, '66.249.71.191', '2023-02-17 03:01:11', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(119, '23.106.22.118', '2023-02-17 04:21:10', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(120, '52.167.144.76', '2023-02-17 04:47:57', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(121, '108.136.39.127', '2023-02-17 10:29:00', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(122, '35.85.143.71', '2023-02-17 13:36:24', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(123, '34.219.28.81', '2023-02-17 13:59:49', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(124, '40.77.167.174', '2023-02-17 16:00:49', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(125, '193.235.141.157', '2023-02-18 04:41:35', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(126, '111.90.141.34', '2023-02-18 10:20:14', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(127, '223.240.101.111', '2023-02-18 11:46:05', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(128, '34.216.234.90', '2023-02-18 13:23:48', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(129, '18.236.213.136', '2023-02-18 13:24:04', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(130, '35.161.204.240', '2023-02-18 13:24:28', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(131, '34.222.142.115', '2023-02-18 13:24:31', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(132, '34.215.184.102', '2023-02-18 13:25:11', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(133, '35.91.52.164', '2023-02-18 13:25:32', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(134, '34.211.244.120', '2023-02-18 13:28:33', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(135, '35.87.149.111', '2023-02-18 13:29:41', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(136, '34.220.41.154', '2023-02-18 13:30:20', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(137, '34.223.88.70', '2023-02-18 13:30:43', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(138, '52.35.34.163', '2023-02-18 13:38:31', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(139, '35.88.209.111', '2023-02-18 13:40:39', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(140, '35.91.191.76', '2023-02-18 13:40:55', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(141, '54.244.36.197', '2023-02-18 13:41:04', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(142, '34.221.81.117', '2023-02-18 13:42:23', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(143, '54.244.68.191', '2023-02-18 13:42:55', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(144, '35.92.63.135', '2023-02-18 13:50:20', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(145, '161.97.166.106', '2023-02-18 19:29:56', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(146, '87.236.176.56', '2023-02-18 19:49:02', '', '', '0000-00-00', '', '', '', '', NULL, ''),
(147, '2001:4455:6e3:7c00:a936:962:cc89:cd07', '2023-02-19 00:19:25', '', '', '0000-00-00', '', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `traffic_log`
--

CREATE TABLE `traffic_log` (
  `traffic_id` int(11) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `traffic_log`
--

INSERT INTO `traffic_log` (`traffic_id`, `device_type`, `date`) VALUES
(1, 'computer', '2023-02-05 19:28:27'),
(2, 'computer', '2023-02-05 20:17:06'),
(3, 'computer', '2023-02-05 22:06:39'),
(4, 'phone', '2023-02-05 23:29:56'),
(5, 'computer', '2023-02-05 15:34:27'),
(6, 'computer', '2023-02-05 15:37:44'),
(7, 'phone', '2023-02-05 23:38:12'),
(8, 'computer', '2023-02-05 15:39:48'),
(9, 'computer', '2023-02-05 15:41:55'),
(10, 'computer', '2023-02-05 16:11:44'),
(11, 'computer', '2023-02-06 00:29:02'),
(12, 'computer', '2023-02-06 00:45:11'),
(13, 'computer', '2023-02-06 02:23:08'),
(14, 'computer', '2023-02-05 21:38:27'),
(15, 'computer', '2023-02-05 23:20:09'),
(16, 'phone', '2023-02-06 11:32:25'),
(17, 'phone', '2023-02-06 12:20:50'),
(18, 'phone', '2023-02-06 12:52:58'),
(19, 'phone', '2023-02-06 12:53:28'),
(20, 'computer', '2023-02-06 12:59:31'),
(21, 'computer', '2023-02-06 05:14:13'),
(22, 'computer', '2023-02-06 05:17:41'),
(23, 'computer', '2023-02-06 05:20:29'),
(24, 'computer', '2023-02-06 05:50:44'),
(25, 'computer', '2023-02-06 15:24:08'),
(26, 'computer', '2023-02-06 15:24:13'),
(27, 'computer', '2023-02-06 07:46:46'),
(28, 'computer', '2023-02-06 16:04:07'),
(29, 'computer', '2023-02-06 16:22:32'),
(30, 'computer', '2023-02-06 16:49:28'),
(31, 'computer', '2023-02-06 17:12:01'),
(32, 'computer', '2023-02-06 17:12:51'),
(33, 'computer', '2023-02-06 18:53:36'),
(34, 'computer', '2023-02-06 11:28:27'),
(35, 'computer', '2023-02-06 13:43:45'),
(36, 'computer', '2023-02-07 00:03:20'),
(37, 'computer', '2023-02-06 16:03:24'),
(38, 'computer', '2023-02-06 18:53:49'),
(39, 'computer', '2023-02-07 05:53:04'),
(40, 'computer', '2023-02-07 02:35:20'),
(41, 'computer', '2023-02-07 10:38:01'),
(42, 'computer', '2023-02-07 10:44:43'),
(43, 'computer', '2023-02-07 04:51:53'),
(44, 'computer', '2023-02-07 13:21:01'),
(45, 'computer', '2023-02-07 13:21:45'),
(46, 'computer', '2023-02-07 13:22:30'),
(47, 'computer', '2023-02-07 05:22:57'),
(48, 'computer', '2023-02-07 13:23:21'),
(49, 'computer', '2023-02-07 15:08:07'),
(50, 'computer', '2023-02-07 16:59:03'),
(51, 'computer', '2023-02-07 08:59:07'),
(52, 'computer', '2023-02-07 09:55:15'),
(53, 'computer', '2023-02-07 11:28:27'),
(54, 'computer', '2023-02-07 11:53:50'),
(55, 'phone', '2023-02-07 20:57:18'),
(56, 'phone', '2023-02-07 20:57:33'),
(57, 'computer', '2023-02-07 21:22:58'),
(58, 'computer', '2023-02-07 22:00:19'),
(59, 'computer', '2023-02-08 00:51:41'),
(60, 'computer', '2023-02-08 05:43:18'),
(61, 'computer', '2023-02-07 22:20:45'),
(62, 'computer', '2023-02-08 08:11:03'),
(63, 'computer', '2023-02-08 08:48:06'),
(64, 'computer', '2023-02-08 00:52:18'),
(65, 'computer', '2023-02-08 10:06:36'),
(66, 'computer', '2023-02-08 02:15:16'),
(67, 'computer', '2023-02-08 02:15:24'),
(68, 'computer', '2023-02-08 02:17:19'),
(69, 'computer', '2023-02-08 08:11:57'),
(70, 'computer', '2023-02-08 16:31:19'),
(71, 'computer', '2023-02-08 08:40:20'),
(72, 'phone', '2023-02-08 17:23:21'),
(73, 'computer', '2023-02-08 09:26:08'),
(74, 'computer', '2023-02-08 18:29:30'),
(75, 'computer', '2023-02-08 11:28:27'),
(76, 'computer', '2023-02-08 20:25:21'),
(77, 'computer', '2023-02-08 13:11:42'),
(78, 'computer', '2023-02-09 01:14:25'),
(79, 'computer', '2023-02-08 17:39:03'),
(80, 'computer', '2023-02-09 07:01:44'),
(81, 'computer', '2023-02-09 08:06:10'),
(82, 'computer', '2023-02-09 01:05:26'),
(83, 'computer', '2023-02-09 10:08:32'),
(84, 'computer', '2023-02-09 11:01:34'),
(85, 'computer', '2023-02-09 11:06:15'),
(86, 'computer', '2023-02-09 13:36:05'),
(87, 'computer', '2023-02-09 13:36:13'),
(88, 'computer', '2023-02-09 13:50:01'),
(89, 'computer', '2023-02-09 05:50:05'),
(90, 'computer', '2023-02-09 17:12:31'),
(91, 'computer', '2023-02-09 10:44:08'),
(92, 'computer', '2023-02-09 19:17:39'),
(93, 'computer', '2023-02-09 12:21:32'),
(94, 'phone', '2023-02-09 21:51:19'),
(95, 'computer', '2023-02-09 16:08:24'),
(96, 'computer', '2023-02-09 16:14:28'),
(97, 'computer', '2023-02-09 17:39:04'),
(98, 'computer', '2023-02-09 19:33:08'),
(99, 'computer', '2023-02-10 03:39:02'),
(100, 'computer', '2023-02-10 08:34:08'),
(101, 'computer', '2023-02-10 10:41:20'),
(102, 'computer', '2023-02-10 02:43:00'),
(103, 'computer', '2023-02-10 03:42:13'),
(104, 'computer', '2023-02-10 13:22:18'),
(105, 'computer', '2023-02-10 13:22:37'),
(106, 'computer', '2023-02-10 13:24:22'),
(107, 'computer', '2023-02-10 13:26:48'),
(108, 'computer', '2023-02-10 13:31:59'),
(109, 'computer', '2023-02-10 15:15:42'),
(110, 'phone', '2023-02-10 15:16:11'),
(111, 'phone', '2023-02-10 17:34:50'),
(112, 'computer', '2023-02-10 14:52:11'),
(113, 'computer', '2023-02-10 14:54:06'),
(114, 'computer', '2023-02-10 23:37:58'),
(115, 'computer', '2023-02-11 00:10:15'),
(116, 'computer', '2023-02-10 17:39:03'),
(117, 'computer', '2023-02-10 17:58:03'),
(118, 'computer', '2023-02-11 05:07:15'),
(119, 'computer', '2023-02-10 21:07:19'),
(120, 'phone', '2023-02-10 21:07:27'),
(121, 'computer', '2023-02-11 05:08:06'),
(122, 'computer', '2023-02-11 09:27:23'),
(123, 'phone', '2023-02-11 12:57:47'),
(124, 'computer', '2023-02-11 05:00:33'),
(125, 'phone', '2023-02-11 05:02:32'),
(126, 'computer', '2023-02-11 05:03:10'),
(127, 'computer', '2023-02-11 13:20:55'),
(128, 'computer', '2023-02-11 13:21:24'),
(129, 'computer', '2023-02-11 13:48:58'),
(130, 'computer', '2023-02-11 17:46:39'),
(131, 'computer', '2023-02-11 10:01:25'),
(132, 'computer', '2023-02-11 10:10:25'),
(133, 'computer', '2023-02-11 19:00:52'),
(134, 'phone', '2023-02-11 19:20:53'),
(135, 'computer', '2023-02-11 17:39:03'),
(136, 'phone', '2023-02-12 03:49:08'),
(137, 'computer', '2023-02-11 20:35:13'),
(138, 'computer', '2023-02-12 11:23:52'),
(139, 'computer', '2023-02-12 03:23:55'),
(140, 'computer', '2023-02-12 03:25:39'),
(141, 'computer', '2023-02-12 04:39:25'),
(142, 'computer', '2023-02-12 12:39:30'),
(143, 'computer', '2023-02-12 13:24:22'),
(144, 'computer', '2023-02-12 06:27:29'),
(145, 'computer', '2023-02-12 18:30:00'),
(146, 'computer', '2023-02-12 11:19:18'),
(147, 'computer', '2023-02-12 11:20:45'),
(148, 'computer', '2023-02-12 20:18:56'),
(149, 'phone', '2023-02-12 21:03:25'),
(150, 'phone', '2023-02-12 21:06:40'),
(151, 'computer', '2023-02-12 14:12:36'),
(152, 'computer', '2023-02-12 15:03:31'),
(153, 'computer', '2023-02-12 17:39:03'),
(154, 'computer', '2023-02-13 06:09:39'),
(155, 'computer', '2023-02-13 06:10:36'),
(156, 'computer', '2023-02-13 16:12:12'),
(157, 'computer', '2023-02-13 19:39:21'),
(158, 'computer', '2023-02-13 11:39:22'),
(159, 'computer', '2023-02-14 00:10:18'),
(160, 'computer', '2023-02-13 20:29:09'),
(161, 'computer', '2023-02-14 06:34:31'),
(162, 'computer', '2023-02-14 07:30:59'),
(163, 'computer', '2023-02-14 08:11:10'),
(164, 'computer', '2023-02-14 13:26:38'),
(165, 'computer', '2023-02-14 13:27:06'),
(166, 'computer', '2023-02-14 13:27:43'),
(167, 'computer', '2023-02-14 13:28:00'),
(168, 'computer', '2023-02-14 13:28:02'),
(169, 'computer', '2023-02-14 14:21:03'),
(170, 'computer', '2023-02-14 21:29:43'),
(171, 'computer', '2023-02-14 18:30:19'),
(172, 'computer', '2023-02-14 20:29:09'),
(173, 'computer', '2023-02-15 13:39:03'),
(174, 'computer', '2023-02-15 05:39:06'),
(175, 'phone', '2023-02-15 20:43:11'),
(176, 'computer', '2023-02-15 22:21:25'),
(177, 'computer', '2023-02-15 14:24:49'),
(178, 'computer', '2023-02-15 14:25:47'),
(179, 'computer', '2023-02-15 14:27:07'),
(180, 'computer', '2023-02-15 14:33:41'),
(181, 'computer', '2023-02-15 20:29:09'),
(182, 'computer', '2023-02-16 07:48:48'),
(183, 'computer', '2023-02-16 10:09:38'),
(184, 'computer', '2023-02-16 11:56:47'),
(185, 'computer', '2023-02-16 13:40:24'),
(186, 'computer', '2023-02-16 13:40:27'),
(187, 'computer', '2023-02-16 13:40:43'),
(188, 'computer', '2023-02-16 14:06:45'),
(189, 'phone', '2023-02-16 18:15:22'),
(190, 'computer', '2023-02-16 23:53:23'),
(191, 'phone', '2023-02-16 16:59:40'),
(192, 'phone', '2023-02-16 17:00:18'),
(193, 'computer', '2023-02-17 01:18:08'),
(194, 'computer', '2023-02-17 01:19:00'),
(195, 'computer', '2023-02-17 01:21:01'),
(196, 'computer', '2023-02-17 01:22:04'),
(197, 'computer', '2023-02-17 02:12:31'),
(198, 'computer', '2023-02-17 03:01:11'),
(199, 'computer', '2023-02-17 04:21:10'),
(200, 'computer', '2023-02-17 04:29:09'),
(201, 'computer', '2023-02-17 04:47:57'),
(202, 'computer', '2023-02-17 09:17:53'),
(203, 'computer', '2023-02-17 09:21:39'),
(204, 'computer', '2023-02-17 10:29:00'),
(205, 'computer', '2023-02-17 13:36:24'),
(206, 'computer', '2023-02-17 13:59:49'),
(207, 'computer', '2023-02-17 16:00:49'),
(208, 'computer', '2023-02-18 04:29:09'),
(209, 'computer', '2023-02-18 04:41:35'),
(210, 'computer', '2023-02-18 10:20:14'),
(211, 'phone', '2023-02-18 11:46:05'),
(212, 'computer', '2023-02-18 13:23:48'),
(213, 'computer', '2023-02-18 13:24:04'),
(214, 'computer', '2023-02-18 13:24:28'),
(215, 'computer', '2023-02-18 13:24:31'),
(216, 'computer', '2023-02-18 13:25:11'),
(217, 'computer', '2023-02-18 13:25:32'),
(218, 'computer', '2023-02-18 13:28:33'),
(219, 'computer', '2023-02-18 13:29:41'),
(220, 'computer', '2023-02-18 13:30:20'),
(221, 'computer', '2023-02-18 13:30:43'),
(222, 'computer', '2023-02-18 13:38:31'),
(223, 'computer', '2023-02-18 13:40:39'),
(224, 'computer', '2023-02-18 13:40:55'),
(225, 'computer', '2023-02-18 13:41:04'),
(226, 'computer', '2023-02-18 13:42:23'),
(227, 'computer', '2023-02-18 13:42:55'),
(228, 'computer', '2023-02-18 13:43:19'),
(229, 'computer', '2023-02-18 13:50:20'),
(230, 'computer', '2023-02-18 19:29:56'),
(231, 'computer', '2023-02-18 19:49:02'),
(232, 'computer', '2023-02-19 00:19:25'),
(233, 'computer', '2023-02-19 01:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `paymentmethod` text NOT NULL,
  `datecreated` datetime NOT NULL,
  `date_delivered` datetime DEFAULT NULL,
  `date_completed` varchar(255) DEFAULT NULL,
  `photo_proof` text DEFAULT NULL,
  `status` text NOT NULL,
  `ship_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `prod_log_id` int(11) DEFAULT NULL,
  `dis_id` int(11) DEFAULT NULL,
  `delivery_rider` varchar(255) DEFAULT NULL,
  `delivery_rider_id` int(11) DEFAULT NULL,
  `trans_changes` int(11) DEFAULT NULL,
  `trans_pay` int(11) DEFAULT NULL,
  `total_purchased` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_amount` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `delivery_remarks` varchar(255) DEFAULT NULL,
  `trans_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tid`, `user_id`, `paymentmethod`, `datecreated`, `date_delivered`, `date_completed`, `photo_proof`, `status`, `ship_id`, `type`, `prod_log_id`, `dis_id`, `delivery_rider`, `delivery_rider_id`, `trans_changes`, `trans_pay`, `total_purchased`, `discount`, `total_amount`, `reason`, `delivery_remarks`, `trans_code`) VALUES
(1, 64, 'cod', '2023-02-17 01:18:54', '2023-02-17 01:20:51', NULL, 'Simple School Chalkboard Zoom Virtual Background.png', 'completed', NULL, 'online', 1, NULL, '24,Benmar Sanchez | Contact : 09456517431', 24, NULL, NULL, '457.75', 0, '457.75', NULL, 'successfully', NULL),
(2, 59, 'cash', '2023-01-26 00:20:14', NULL, NULL, NULL, 'walkin-completed', NULL, 'walkin', NULL, NULL, NULL, NULL, 1, 916, NULL, NULL, ' 915.5', NULL, NULL, 'M2023002');

-- --------------------------------------------------------

--
-- Table structure for table `trans_record`
--

CREATE TABLE `trans_record` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `disc` double DEFAULT NULL,
  `dfee` double DEFAULT NULL,
  `date_ordered` date NOT NULL,
  `total` float NOT NULL,
  `pm` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trans_record`
--

INSERT INTO `trans_record` (`order_id`, `prod_id`, `transaction_id`, `quantity`, `price`, `disc`, `dfee`, `date_ordered`, `total`, `pm`, `user_id`) VALUES
(1, 5, 1, 5, 63.26, 0, 100, '2023-02-17', 316.3, 'pending', 64),
(2, 6, 1, 5, 28.29, 0, 100, '2023-02-17', 141.45, 'pending', 64),
(3, 5, 2, 10, 63.26, NULL, NULL, '2023-01-26', 632.6, '', 59),
(4, 6, 2, 10, 28.29, NULL, NULL, '2023-01-26', 282.9, '', 59);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wish_id`, `prod_id`, `user_id`) VALUES
(1, 5, '110.54.158.230'),
(2, 5, '110.54.158.230');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `account_ship_address`
--
ALTER TABLE `account_ship_address`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chat_acc`
--
ALTER TABLE `chat_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_trans`
--
ALTER TABLE `courier_trans`
  ADD PRIMARY KEY (`courier_trans_id`);

--
-- Indexes for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `distributor_details`
--
ALTER TABLE `distributor_details`
  ADD PRIMARY KEY (`dis_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp-sms`
--
ALTER TABLE `otp-sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `production_log`
--
ALTER TABLE `production_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `product_quantity`
--
ALTER TABLE `product_quantity`
  ADD PRIMARY KEY (`prod_qty_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `return_product`
--
ALTER TABLE `return_product`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `return_request`
--
ALTER TABLE `return_request`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempuser`
--
ALTER TABLE `tempuser`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `traffic_log`
--
ALTER TABLE `traffic_log`
  ADD PRIMARY KEY (`traffic_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `trans_record`
--
ALTER TABLE `trans_record`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `account_ship_address`
--
ALTER TABLE `account_ship_address`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_acc`
--
ALTER TABLE `chat_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier_trans`
--
ALTER TABLE `courier_trans`
  MODIFY `courier_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `distributor_details`
--
ALTER TABLE `distributor_details`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp-sms`
--
ALTER TABLE `otp-sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `production_log`
--
ALTER TABLE `production_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_quantity`
--
ALTER TABLE `product_quantity`
  MODIFY `prod_qty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_product`
--
ALTER TABLE `return_product`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `return_request`
--
ALTER TABLE `return_request`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tempuser`
--
ALTER TABLE `tempuser`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `traffic_log`
--
ALTER TABLE `traffic_log`
  MODIFY `traffic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trans_record`
--
ALTER TABLE `trans_record`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_record`
--
ALTER TABLE `trans_record`
  ADD CONSTRAINT `trans_record_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_record_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
