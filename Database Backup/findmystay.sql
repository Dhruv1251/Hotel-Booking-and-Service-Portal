-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 11:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findmystay`
--

-- --------------------------------------------------------

--
-- Table structure for table `cab_booking`
--

CREATE TABLE `cab_booking` (
  `cab_bookingid` int(10) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `vehicle_typeid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `flocation` varchar(200) NOT NULL,
  `tlocation` varchar(200) NOT NULL,
  `total_km` float(10,2) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cab_booking`
--

INSERT INTO `cab_booking` (`cab_bookingid`, `payment_id`, `vehicle_typeid`, `customer_id`, `booking_date`, `booking_time`, `flocation`, `tlocation`, `total_km`, `cost`, `status`) VALUES
(27, 157, 14, 7, '2018-03-10', '01:00:00', 'Udupi ResidencyNear Service Bus Stand Karnataka India 576101 India ,Udupi', 'Mangaluru, Karnataka, India', 47.25, 25.00, 'Active'),
(28, 158, 15, 8, '2018-04-07', '01:00:00', 'Udupi ResidencyNear Service Bus Stand Karnataka India 576101 India ,Udupi', 'Mangaluru, Karnataka, India', 47.25, 50.00, 'Active'),
(29, 169, 16, 11, '2020-07-01', '13:30:00', '2B & 2C, Jawahar Circle, near Jagatpura Rd, Jaipur, Rajasthan,Jaipur', 'Malviya Nagar, Jaipur, Rajasthan, India', 8599.53, 22.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `address`, `city`, `pincode`, `contact_no`, `email_id`, `password`, `status`) VALUES
(7, 'Raj kiran', '3rd floor, city light buildin', 'Mangalore', '274233', '7254654444', 'rajkiran123@gmail.com', 'qwer1234@', 'Active'),
(9, 'Anup', '3rd floor, city light building', 'Bangalore', '575002', '9986058114', 'anup@gmail.com', 'q1w2e3r4@', 'Active'),
(10, 'Amshuman', '3rd floor, city market, brindavan road', 'Bangalore', '698633', '7894561230', 'amshuman@gmail.com', 'A123456789@', 'Active'),
(11, 'Virat kohli', '5th cross,\r\nMalleshwaram', 'Bangalore', '575002', '7895464123', 'viratkohli@gmail.com', 'Q1w2e3r4@@', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `feedback` text NOT NULL,
  `ratings` float(10,1) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `customer_id`, `hotel_id`, `feedback`, `ratings`, `status`) VALUES
(5, 9, 5, 'Nice', 2.0, 'Active'),
(6, 9, 11, 'Looks good but poor service', 1.0, 'Active'),
(7, 9, 13, 'Awesome wounderful', 4.0, 'Active'),
(8, 9, 5, 'Thanks for everything', 4.0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `food_category_id` int(10) NOT NULL,
  `food_category` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`food_category_id`, `food_category`, `note`, `status`) VALUES
(3, 'Vegetarian', 'Vegetarian', 'Active'),
(6, 'Fast Food', 'Fast food is a type of mass-produced food designed for commercial resale and with a strong priority placed on \"speed of service\" versus other relevant factors involved in culinary science. Available in all locations.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `food_order_id` int(10) NOT NULL,
  `room_booking_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `item_cost` float(10,2) NOT NULL,
  `qty` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `payment_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`food_order_id`, `room_booking_id`, `item_id`, `customer_id`, `item_cost`, `qty`, `status`, `payment_id`) VALUES
(3, 22, 3, 9, 300.00, 3, 'Active', 30),
(4, 22, 4, 9, 500.00, 8, 'Active', 30),
(5, 22, 3, 9, 300.00, 5, 'Active', 34),
(6, 22, 4, 9, 500.00, 3, 'Active', 34),
(7, 22, 3, 9, 300.00, 6, 'Active', 35),
(8, 22, 4, 9, 500.00, 5, 'Active', 35),
(9, 22, 3, 9, 300.00, 5, 'Active', 36),
(10, 22, 4, 9, 500.00, 3, 'Active', 36),
(11, 22, 2, 9, 500.00, 3, 'Active', 37),
(12, 22, 3, 9, 300.00, 4, 'Active', 37),
(13, 23, 5, 1, 150.00, 3, 'Active', 39),
(14, 23, 3, 1, 300.00, 3, 'Active', 40),
(15, 27, 2, 1, 500.00, 2, 'Active', 54),
(16, 27, 3, 1, 300.00, 3, 'Active', 54),
(19, 22, 2, 9, 500.00, 2, 'Active', 71),
(20, 22, 3, 9, 300.00, 4, 'Active', 71),
(26, 25, 2, 6, 500.00, 5, 'Active', 110),
(27, 86, 2, 1, 500.00, 10, 'Active', 152),
(28, 86, 3, 1, 300.00, 5, 'Active', 152),
(29, 92, 7, 10, 250.00, 5, 'Active', 162),
(30, 92, 8, 10, 100.00, 2, 'Active', 162),
(31, 94, 9, 11, 40.00, 2, 'Active', 168);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `hotel_type` varchar(20) NOT NULL COMMENT '1,2,3,4,5 star',
  `hotel_description` text NOT NULL,
  `hotel_address` text NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `hotel_map` text NOT NULL,
  `hotel_pincode` varchar(10) NOT NULL,
  `hotel_policies` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `location_id`, `hotel_name`, `hotel_type`, `hotel_description`, `hotel_address`, `contactnumber`, `hotel_map`, `hotel_pincode`, `hotel_policies`, `status`) VALUES
(11, 10, 'Trident Bandra Kurla', '4 Star', 'The 5-star Trident Bandra Kurla provides an outdoor swimming pool and full spa services. Concierge services and room service are available 24 hours. On-site parking is free. Complimentary WiFi is available in all rooms.', 'C-56, G Block, Bandra Kurla Complex, Bandra, 400051 Mumbai, India', '8869532554', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.830753394297!2d72.85213951490107!3d19.071177487090676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8e94b11a821%3A0x74acefa4382dbb18!2sCall%20boy%20jobs!5e0!3m2!1sen!2sin!4v1591384562916!5m2!1sen!2sin\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', '400051', '24 hours booking', 'Active'),
(13, 13, 'The LaLiT Jaipur', '4 Star', 'Set 2 km from the airport, this high-end hotel with Haveli architecture is 12 km from the City Palace complex and the 18th-century Jantar Mantar park.', '2B & 2C, Jawahar Circle, near Jagatpura Rd, Jaipur, Rajasthan', '9414197777', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.0114323699186!2d75.80531261504333!3d26.839588683159196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db6081a2b875d%3A0xa35fd51e2719d40f!2sThe%20LaLiT%20Jaipur!5e0!3m2!1sen!2sin!4v1592866438117!5m2!1sen!2sin\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', '302017', 'Check-in time: 2:00 PM\r\nCheck-out time: 12:00 PM', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facility`
--

CREATE TABLE `hotel_facility` (
  `hotel_facilityid` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_typeid` int(10) NOT NULL,
  `facility_type` varchar(100) NOT NULL,
  `facility_img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_facility`
--

INSERT INTO `hotel_facility` (`hotel_facilityid`, `hotel_id`, `room_typeid`, `facility_type`, `facility_img`, `status`) VALUES
(26, 11, 66, 'TV', '146392117881t2A6uhm4L._SX466_.jpg', 'Active'),
(27, 11, 68, 'Wifi facility', '1746968993wifi.jpg', 'Active'),
(28, 13, 70, 'TV with DTH', '1051176187tv.jpg', 'Active'),
(29, 13, 69, 'WiFi', '228191775wifi.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_image`
--

CREATE TABLE `hotel_image` (
  `hotel_imageid` int(11) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_typeid` int(10) NOT NULL,
  `hotel_image` varchar(100) NOT NULL,
  `image_description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_image`
--

INSERT INTO `hotel_image` (`hotel_imageid`, `hotel_id`, `room_typeid`, `hotel_image`, `image_description`, `status`) VALUES
(18, 11, 66, '1079352018Trident Bandra Kurla.jpg', 'Botticino restaurant serves fine wine and Italian dishes, while 022 restaurant offers an interactive sushi bar, as well as Western and Asian food. Other dining options include regional Indian food at Maya restaurant and salads at Trident Patisserie & Delicatessen.', 'Active'),
(19, 13, 69, '1850099081302210_15081213590034115203.jpg', '', 'Active'),
(20, 13, 69, '1211139822321442.jpg', 'Hotel image', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `food_category_id` int(10) NOT NULL,
  `item_description` text NOT NULL,
  `item_cost` float(10,2) NOT NULL,
  `item_img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `hotel_id`, `item_name`, `food_category_id`, `item_description`, `item_cost`, `item_img`, `status`) VALUES
(7, 11, 'Chicken biryani', 3, 'Aromatic, delicious and spicy one pot chicken biryani. This is a beginners recipe and can be made ...', 250.00, '1971359307chicken biriyani.jpg', 'Active'),
(8, 11, 'Vegetable Hakka Noodles', 3, 'Street style Hakka Noodles are easy to make at home! These spicy noodles are great for a quick meal. ', 100.00, '948005602Hakka-Noodles-1-500x375.jpg', 'Active'),
(9, 13, 'Pani puri', 6, 'Panipuri or Phuchka is a type of snack that originated in the Indian subcontinent. It consists of a round or ball-shaped, hollow puri, filled with a mixture of flavored water, tamarind chutney, chili, chaat masala, potato, onion or chickpeas.', 40.00, '1781641416pani puri.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(10) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_img` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `location_img`, `description`, `status`) VALUES
(7, 'Bangalore', '20722BB.jpg', '3rd floor', 'Active'),
(8, 'Udupi', '7397udupi.png', 'Udupi', 'Active'),
(10, 'Mumbai', '989814529Mumbai.jpg', 'Mumbai (formerly called Bombay) is a densely populated city on India’s west coast. A financial center, it\'s India\'s largest city. On the Mumbai Harbour waterfront stands the iconic Gateway of India stone arch, built by the British Raj in 1924. Offshore, nearby Elephanta Island holds ancient cave temples dedicated to the Hindu god Shiva. The city\'s also famous as the heart of the Bollywood film industry.', 'Active'),
(13, 'Jaipur', '987380165maxresdefault.jpg', 'Along with Delhi and Agra, Jaipur forms the Golden Triangle and hails as one of the most famous tourist circuits of the country. Jaipur is the capital of India’s Rajasthan state. It evokes the royal family that once ruled the region and that, in 1727, founded what is now called the Old City, or “Pink City” for its trademark building color. Visit Jaipur and Enjoy your journey.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `room_booking_id` int(10) NOT NULL,
  `spa_service_bookingid` int(10) NOT NULL,
  `food_order_id` int(10) NOT NULL,
  `cab_bookingid` int(10) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `card_holder` varchar(250) NOT NULL,
  `card_no` varchar(20) NOT NULL,
  `cvv_no` varchar(5) NOT NULL,
  `exp_date` date NOT NULL,
  `total_amt` float(10,2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `room_booking_id`, `spa_service_bookingid`, `food_order_id`, `cab_bookingid`, `payment_date`, `payment_type`, `card_holder`, `card_no`, `cvv_no`, `exp_date`, `total_amt`, `name`, `mobileno`, `note`, `status`) VALUES
(157, 10, 88, 0, 0, 0, '2020-06-05', 'Debit card', 'Romesh', '1234567890123456', '489', '2021-01-01', 4000.00, 'Akash', '7894561230', 'Kindly arrange one person to guide', 'Active'),
(158, 10, 89, 0, 0, 0, '2020-06-05', 'Debit card', 'Romesh', '1234567890123456', '489', '2021-01-01', 4000.00, 'Akash', '7894561230', 'Kindly arrange one person to guide', 'Active'),
(159, 10, 90, 0, 0, 0, '2020-06-05', 'Debit card', 'Romesh', '1234567890123456', '489', '2021-01-01', 4000.00, 'Akash', '7894561230', 'Kindly arrange one person to guide', 'Active'),
(160, 10, 91, 0, 0, 0, '2020-06-05', 'Debit card', 'Romesh', '1234567890123456', '489', '2021-01-01', 4000.00, 'Akash', '7894561230', 'Kindly arrange one person to guide', 'Active'),
(161, 10, 92, 0, 0, 0, '2020-06-05', 'Debit card', 'Romesh', '1234567890123456', '489', '2021-01-01', 4000.00, 'Akash', '7894561230', 'Kindly arrange one person to guide', 'Cancel'),
(162, 10, 92, 0, 92, 0, '2020-06-05', 'Debit card', 'Raj kiran', '1234567890123456', '154', '2021-01-01', 1450.00, '2020-06-10', '13:00', 'Ordered this food', 'Cancel'),
(163, 10, 92, 92, 0, 0, '2020-06-05', 'VISA', 'Raj krian', '1234567890123456', '158', '2021-01-01', 1900.00, '', '', '', 'Cancel'),
(164, 10, 0, 0, 0, 0, '2020-06-05', 'Savings Account', 'Peter', '1234567890123456', 'SBIN0', '0000-00-00', 2725.00, '92', '', '', 'Cancelled'),
(165, 11, 93, 0, 0, 0, '2020-06-23', 'Debit card', 'Virat', '1234568970153456', '156', '2021-01-01', 10000.00, 'Virat', '7894561230', 'Kindly arrange one person to guide us.', 'Cancel'),
(166, 11, 0, 0, 0, 0, '2020-06-23', 'Savings Account', 'Virat', '1234567890123456', 'SBIN0', '0000-00-00', 5000.00, '93', '', '', 'Cancelled'),
(167, 11, 94, 0, 0, 0, '2020-06-23', 'Debit card', 'Virat', '1234567890123456', '145', '2022-01-01', 2000.00, 'Virat', '7894561230', '', 'Active'),
(168, 11, 94, 0, 94, 0, '2020-06-23', 'Debit card', 'Virat', '1234567890134560', '158', '2021-01-01', 80.00, '2020-06-23', '13:00', 'Kindly make little spicy', 'Active'),
(169, 11, 93, 0, 0, 29, '2020-06-23', 'VISA', 'Mahir', '1234567890123456', '145', '2021-01-01', 189189.66, '', '', '', 'Active'),
(170, 11, 93, 93, 0, 0, '2020-06-23', 'VISA', 'Ram sha', '1234567890123123', '156', '2021-01-01', 90.00, '', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

CREATE TABLE `room_booking` (
  `room_booking_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_typeid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `no_ofadults` int(10) NOT NULL,
  `no_ofchildren` int(10) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `cost` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_booking`
--

INSERT INTO `room_booking` (`room_booking_id`, `hotel_id`, `room_typeid`, `customer_id`, `no_ofadults`, `no_ofchildren`, `check_in`, `check_out`, `cost`, `status`) VALUES
(22, 5, 18, 9, 4, 1, '2018-03-27 00:00:00', '2018-03-31 00:00:00', 1000.00, 'Active'),
(23, 5, 20, 1, 1, 0, '2018-03-06 00:00:00', '2018-03-06 00:00:00', 500.00, 'Active'),
(24, 5, 18, 1, 5, 0, '2018-03-06 00:00:00', '2018-03-09 00:00:00', 1000.00, 'Active'),
(25, 5, 18, 6, 3, 1, '2018-03-28 00:00:00', '2018-03-31 00:00:00', 1000.00, 'Active'),
(26, 5, 20, 7, 1, 0, '2018-03-07 00:00:00', '2018-03-07 00:00:00', 500.00, 'Active'),
(27, 5, 19, 1, 2, 2, '2018-03-07 00:00:00', '2018-03-07 00:00:00', 2000.00, 'Active'),
(28, 5, 19, 7, 2, 2, '2018-03-08 00:00:00', '2018-03-08 00:00:00', 2000.00, 'Active'),
(29, 5, 19, 7, 2, 0, '2018-03-29 00:00:00', '2018-03-31 00:00:00', 2000.00, 'Active'),
(30, 5, 18, 1, 3, 0, '2018-03-30 00:00:00', '2018-03-30 00:00:00', 1000.00, 'Active'),
(31, 5, 18, 6, 3, 0, '2018-03-09 00:00:00', '2018-03-10 00:00:00', 1000.00, 'Active'),
(32, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(33, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(34, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(35, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(36, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(37, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(38, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(39, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(40, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(41, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(42, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(43, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(44, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(45, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(46, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(47, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(48, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(49, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(50, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(51, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(52, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(53, 5, 18, 6, 5, 0, '2018-03-10 00:00:00', '2018-03-13 00:00:00', 1000.00, 'Active'),
(54, 5, 18, 1, 4, 2, '2018-03-14 00:00:00', '2018-03-14 00:00:00', 1000.00, 'Active'),
(55, 5, 18, 1, 4, 2, '2018-03-14 00:00:00', '2018-03-14 00:00:00', 1000.00, 'Active'),
(56, 5, 18, 1, 4, 2, '2018-03-14 00:00:00', '2018-03-14 00:00:00', 1000.00, 'Active'),
(57, 5, 18, 1, 4, 2, '2018-03-14 00:00:00', '2018-03-14 00:00:00', 1000.00, 'Active'),
(58, 5, 18, 1, 4, 2, '2018-03-14 00:00:00', '2018-03-14 00:00:00', 1000.00, 'Active'),
(59, 3, 3, 9, 2, 1, '2018-03-21 00:00:00', '2018-03-24 00:00:00', 2000.00, 'Active'),
(60, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(61, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(62, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(63, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(64, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(65, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(66, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(67, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(68, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(69, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(70, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(71, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(72, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(73, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(74, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(75, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(76, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(77, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(78, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(79, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(80, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(81, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(82, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(83, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(84, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(85, 3, 2, 9, 1, 0, '2018-03-21 00:00:00', '2018-03-21 00:00:00', 1000.00, 'Active'),
(86, 5, 18, 1, 5, 2, '2018-04-07 00:00:00', '2018-04-07 00:00:00', 1000.00, 'Active'),
(87, 4, 4, 1, 1, 1, '2018-04-10 00:00:00', '2018-04-10 00:00:00', 3000.00, 'Active'),
(88, 11, 66, 10, 1, 0, '2020-06-10 00:00:00', '2020-06-13 00:00:00', 1000.00, 'Active'),
(89, 11, 66, 10, 1, 0, '2020-06-10 00:00:00', '2020-06-13 00:00:00', 1000.00, 'Active'),
(90, 11, 66, 10, 1, 0, '2020-06-10 00:00:00', '2020-06-13 00:00:00', 1000.00, 'Active'),
(91, 11, 66, 10, 1, 0, '2020-06-10 00:00:00', '2020-06-13 00:00:00', 1000.00, 'Active'),
(92, 11, 66, 10, 1, 0, '2020-06-10 00:00:00', '2020-06-13 00:00:00', 1000.00, 'Active'),
(93, 13, 69, 11, 2, 1, '2020-07-01 00:00:00', '2020-07-05 00:00:00', 2000.00, 'Active'),
(94, 13, 69, 11, 3, 1, '2020-06-23 00:00:00', '2020-06-23 00:00:00', 2000.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_typeid` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_type` varchar(25) NOT NULL,
  `max_adult` int(10) NOT NULL,
  `max_children` int(10) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `no_of_room` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_typeid`, `hotel_id`, `room_type`, `max_adult`, `max_children`, `cost`, `no_of_room`, `status`) VALUES
(18, 5, 'Deluxe Rooms', 5, 2, 1000.00, 25, 'Active'),
(19, 5, 'Super Deluxe Rooms', 2, 2, 2000.00, 50, 'Active'),
(20, 5, 'Standard Rooms', 1, 0, 500.00, 100, 'Active'),
(66, 11, 'Double Room', 2, 1, 1000.00, 25, 'Active'),
(67, 11, 'Single Room', 1, 1, 250.00, 35, 'Active'),
(68, 11, 'Quin Room', 3, 1, 1500.00, 25, 'Active'),
(69, 13, 'Double Room', 3, 1, 2000.00, 25, 'Active'),
(70, 13, 'Single Room', 2, 0, 1000.00, 30, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `spa_service`
--

CREATE TABLE `spa_service` (
  `spa_serviceid` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `service_description` text NOT NULL,
  `service_images` text NOT NULL,
  `service_cost` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spa_service`
--

INSERT INTO `spa_service` (`spa_serviceid`, `hotel_id`, `service_type`, `gender`, `service_description`, `service_images`, `service_cost`, `status`) VALUES
(8, 11, 'Bridal Makeup', 'Female', 'Makeup At Home Service', '1340269669make-up-services-at-home-250x250.jpg', 1900.00, 'Active'),
(9, 13, 'Hair Cut', 'Male', 'men\'s haircuts from the classic clipper cut to the undercut with comb over. Stay ready to go with a haircut from Supercuts.', '1652816318haircut.jpg', 90.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `spa_service_booking`
--

CREATE TABLE `spa_service_booking` (
  `spa_sevice_bookingid` int(10) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `spa_serviceid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `cost` float(10,2) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spa_service_booking`
--

INSERT INTO `spa_service_booking` (`spa_sevice_bookingid`, `payment_id`, `spa_serviceid`, `customer_id`, `booking_date`, `booking_time`, `cost`, `message`, `status`) VALUES
(106, 46, 6, 1, '2018-03-06', '01:00:00', 7000.00, 'This is abc note', 'Active'),
(107, 46, 4, 1, '2018-03-07', '01:00:00', 10000.00, 'This is test note', 'Active'),
(108, 47, 4, 1, '2018-03-09', '03:00:00', 10000.00, 'Test another record', 'Active'),
(109, 47, 6, 1, '2018-03-08', '01:00:00', 7000.00, 'Test my recorc', 'Active'),
(110, 48, 4, 1, '2018-03-09', '01:00:00', 10000.00, 'This is another test note record', 'Active'),
(111, 48, 6, 1, '2018-03-07', '01:00:00', 7000.00, 'This is test note record', 'Active'),
(112, 50, 4, 6, '2018-03-29', '01:00:00', 10000.00, 'hello record', 'Active'),
(113, 50, 6, 6, '2018-03-28', '01:00:00', 7000.00, 'test record', 'Active'),
(114, 52, 4, 7, '0000-00-00', '01:00:00', 10000.00, 'hello', 'Active'),
(115, 52, 6, 7, '2018-03-07', '01:00:00', 7000.00, 'test', 'Active'),
(119, 69, 4, 9, '2018-03-27', '01:00:00', 10000.00, 'Test record', 'Active'),
(120, 69, 5, 9, '2018-03-27', '01:01:00', 500.00, 'trest', 'Active'),
(121, 73, 4, 9, '2018-03-27', '01:00:00', 10000.00, 'abc', 'Active'),
(122, 73, 6, 9, '2018-03-27', '01:00:00', 7000.00, 'test', 'Active'),
(126, 140, 4, 6, '2018-03-28', '01:00:00', 10000.00, '', 'Active'),
(127, 140, 6, 6, '2018-03-28', '01:00:00', 7000.00, '', 'Active'),
(128, 155, 4, 1, '2018-04-07', '13:00:00', 10000.00, 'gghg', 'Active'),
(129, 163, 8, 10, '2020-06-10', '13:00:00', 1900.00, 'Please Arrange expert', 'Active'),
(130, 170, 9, 11, '2020-07-01', '00:30:00', 90.00, 'Kindly arrange expert', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(10) NOT NULL,
  `staffname` varchar(25) NOT NULL,
  `stafftype` varchar(20) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `stafftype`, `loginid`, `password`, `status`) VALUES
(1, 'admin', 'Administrator', 'admin@gmail.com', 'admin', 'Active'),
(2, 'Ajay', 'Employee', 'raj@gmail.com', 'Q1w2e3r4@', 'Active'),
(3, 'Rajshekar', 'Employee', 'rajshekar123@gmail.com', '123456789123@', 'Active'),
(4, 'Sudhir', 'Employee', 'sudhir@gmail.com', 'Q1w2e3r4@', 'Active'),
(5, 'Pranay Roy', 'Employee', 'pranay123@gmail.com', 'Q1w2e3r4@', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `vehicle_typeid` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `vehicle_img` varchar(100) NOT NULL,
  `km_cost` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`vehicle_typeid`, `hotel_id`, `vehicle_type`, `vehicle_img`, `km_cost`, `status`) VALUES
(14, 11, 'Mahindra', '1053924676mahindra.jpg', 25.00, 'Active'),
(15, 11, 'Maruti vehicle', '1575381219car_rental_in_jaipur.jpg', 15.00, 'Active'),
(16, 13, 'Maruti K series', '1735572852Maruti K series.jpg', 22.00, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cab_booking`
--
ALTER TABLE `cab_booking`
  ADD PRIMARY KEY (`cab_bookingid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`food_category_id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`food_order_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `hotel_facility`
--
ALTER TABLE `hotel_facility`
  ADD PRIMARY KEY (`hotel_facilityid`);

--
-- Indexes for table `hotel_image`
--
ALTER TABLE `hotel_image`
  ADD PRIMARY KEY (`hotel_imageid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD PRIMARY KEY (`room_booking_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_typeid`);

--
-- Indexes for table `spa_service`
--
ALTER TABLE `spa_service`
  ADD PRIMARY KEY (`spa_serviceid`);

--
-- Indexes for table `spa_service_booking`
--
ALTER TABLE `spa_service_booking`
  ADD PRIMARY KEY (`spa_sevice_bookingid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD UNIQUE KEY `loginid` (`loginid`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`vehicle_typeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cab_booking`
--
ALTER TABLE `cab_booking`
  MODIFY `cab_bookingid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `food_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `food_order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hotel_facility`
--
ALTER TABLE `hotel_facility`
  MODIFY `hotel_facilityid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hotel_image`
--
ALTER TABLE `hotel_image`
  MODIFY `hotel_imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `room_booking`
--
ALTER TABLE `room_booking`
  MODIFY `room_booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `room_typeid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `spa_service`
--
ALTER TABLE `spa_service`
  MODIFY `spa_serviceid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `spa_service_booking`
--
ALTER TABLE `spa_service_booking`
  MODIFY `spa_sevice_bookingid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `vehicle_typeid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
