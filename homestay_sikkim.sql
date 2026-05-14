-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2025 at 09:34 AM
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
-- Database: `homestay_sikkim`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `picture` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`sr_no`, `name`, `picture`, `date`) VALUES
(4, 'Hiking', 'IMG_32681.jpeg', '2025-05-05 17:59:54'),
(5, 'Village Tour', 'IMG_63760.jpeg', '2025-05-05 17:59:54'),
(6, 'Bird Watching', 'IMG_92516.jpeg', '2025-05-05 17:59:54'),
(7, 'Organic Farming', 'IMG_87846.jpeg', '2025-05-05 17:59:54'),
(8, 'Meditation', 'IMG_35084.jpeg', '2025-05-05 17:59:54'),
(9, 'Local Cusine', 'IMG_57880.jpeg', '2025-05-05 17:59:54'),
(10, 'Experience Traditional Dresses', 'IMG_98284.jpeg', '2025-05-05 18:03:18'),
(11, 'Bon Fire', 'IMG_99474.jpeg', '2025-05-05 18:16:07'),
(12, 'Night Camping', 'IMG_93969.jpeg', '2025-05-05 18:16:30'),
(13, 'Mahakala Puja (Anytime between November to January)', 'IMG_95072.jpeg', '2025-05-05 18:16:58'),
(14, 'Hot Spring (Best time to visit November to March)', 'IMG_13164.jpeg', '2025-05-05 18:17:24'),
(18, 'Trekking', 'IMG_12874.jpeg', '2025-05-19 18:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_name` varchar(200) NOT NULL,
  `admin_pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_name`, `admin_pass`) VALUES
('tamudheehomestay', 'tamudhee@2025');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `adult` varchar(100) DEFAULT NULL,
  `children` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `razorpay_order_id` varchar(100) DEFAULT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` varchar(500) DEFAULT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(14, 'IMG_72395.jpg'),
(15, 'IMG_67392.jpg'),
(17, 'IMG_53005.jpg'),
(18, 'IMG_80580.jpg'),
(19, 'IMG_97280.jpg'),
(20, 'IMG_23498.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(300) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `whatsapp`, `insta`, `tw`, `iframe`) VALUES
(1, 'Borong, South Sikkim, India', 'https://maps.app.goo.gl/sP9YyMLiVWGASXRA8', '9733399162', '', 'nirkumargurung@gmail.com', 'www.fb.com', 'www.whatsapp.com', 'www.instagram.com', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3543.6761951874346!2d88.3489089!3d27.354589999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e69184052f28fd:0x7f73a3a40523d719!2sTamu Dhee Homestay!5e0!3m2!1sen!2sin!4v1745584836652!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `desc`) VALUES
(15, 'IMG_60125.svg', 'WIFI', 'Strong, stable connection throughout your room and common areas to streaming, video calls,browsing and gaming'),
(16, 'IMG_11306.svg', 'AC', 'Super chilled AC to make your body and mind feel fresh'),
(17, 'IMG_54082.svg', 'Water Heater', 'Super good water heater to heat water in winter season to give you warm bath'),
(18, 'IMG_28755.svg', 'Water Boiler', 'Water Boiler to prepare youself with tea or coffee'),
(19, 'IMG_35505.svg', 'Tv', 'Good premium Tv to enjoy your time watching shows and movies'),
(20, 'IMG_94406.svg', 'Music Speaker', 'Room music speaker to enjoy dancing and listening to good music'),
(21, 'IMG_38408.svg', 'Catering', '24/7 catering services'),
(22, 'IMG_15987.svg', 'Telephone', 'Free Telephone connection to call to your family or friend or order something'),
(23, 'IMG_52869.svg', 'Housekeeping', '24/7 housekeeping services'),
(24, 'IMG_99114.svg', 'Streaming OTT', 'OTT platform such as netflix,Amazom prime video, hulu are available');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`sr_no`, `image`, `datentime`) VALUES
(9, 'IMG_26810.jpeg', '2025-05-24 20:54:18'),
(10, 'IMG_75562.jpeg', '2025-05-24 20:54:25'),
(11, 'IMG_14048.jpeg', '2025-05-24 20:54:31'),
(12, 'IMG_73909.jpg', '2025-05-24 20:56:17'),
(13, 'IMG_81204.jpg', '2025-05-24 20:58:03'),
(14, 'IMG_16472.jpg', '2025-05-24 21:00:35'),
(15, 'IMG_57140.jpeg', '2025-05-24 21:01:42'),
(16, 'IMG_86650.jpeg', '2025-05-24 21:01:50'),
(17, 'IMG_70865.jpeg', '2025-05-24 21:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` varchar(600) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`sr_no`, `name`, `desc`, `picture`) VALUES
(1, 'Gangtok', 'Believe it or not, but resisting the alluring charm and appeal of Gangtok is almost impossible for anyone! The capital city of Sikkim, Gangtok is nestled in the Eastern Himalayas and is one of the kaleidoscopic tourist destinations in the state.', 'IMG_63823.jpg'),
(2, 'Yuksom', 'Located in the Western parts of Sikkim, Yuksom is the origin of several enthralling treks into the Himalayas or the magical Kanchenjunga. The once a capital of Sikkim, this hamlet is more known for its pristine beauty and rustic appeal.', 'IMG_21540.jpg'),
(3, 'Tsomgo Lake', 'On a visit to Gangtok, do not miss the chance to visit the Tsomgo Lake or the Changu Lake! Located only 38km from Sikkim’s capital, it lies at an altitude of 12,400ft and is one of the highest lakes in India.While the lake remains frozen during the winters, summer brings in a magical charm and appeal to Tsomgo. It is during this time of the year, the turquoise waters of the lake reflects the amazing views of the nearby peaks and the azure sky above', 'IMG_22648.jpg'),
(4, 'Nathula Pass', 'The once a part of the historic ‘Silk Road’, a visit to Nathu La is a must in any of the Sikkim travel packages. One of the highest motorable pass in the world, this amazing pass is located at a towering height of 4,310m above the sea level and connects Sikkim with Tibet.', 'IMG_37193.jpg'),
(6, 'Pelling', 'If you are an ardent fan of the captivating Himalayan Range, Pelling is the destination for you! It is from this Sikkimese town, one can have the best views of the Himalayas and the Kanchenjunga Peak, and can experience the best of their Sikkim holidays.&lt;br&gt;\r\nLocated at a height of 7,200ft above the sea, this scenic town is bestowed with several waterfalls, breath-taking views, natural beauty and adventure options like rafting, kayaking, trekking, mountain biking and several others.', 'IMG_82411.jpg'),
(7, 'Lachung', 'achung has multiple reasons to make you fall in love with it! While its location at an enthralling height of 8,610ft makes it a popular snow-destination in Sikkim, its untouched and surreal beauty makes it one of the scenic as well as charming tourist places in Sikkim.\r\n\r\nLocated in the northern part of Sikkim, this quaint mountain village is adorned by the immaculate beauty of the Lachung Chu River and is also known for the Lachung Gompa. Though this village is one of the mostly visited regions in Sikkim, it still holds an alluring charm that can hardly be found in any other destinations.', 'IMG_88969.jpg'),
(8, 'Ravangla', 'Nestled amidst the Maenam and Tendong Hills, Ravangla is among the best places to visit in Sikkim; especially in the southern part of the state. A scenic town between Gangtok and Pelling, this hill-town also hosts some of the most popular treks in Sikkim.\r\n\r\nMore popular as a paradise for the bird watchers, it is home to some of the most rare and endangered birds in the world. On a usual visit to Ravangla, you can spot dark-throated thrush, verditre flycatchers, blue whistling thrush, babblers, cuckoos and several others.', 'IMG_97440.jpg'),
(9, 'Rumtek Monastery', 'Counted amongst the largest monasteries in Sikkim, Rumtek Monastery is also one of the oldest monasteries in the state. An ode to the Buddhist cultures and traditions, this monastery is located near Gangtok and is also known as the ‘Dharma Chakra Centre’.\r\n\r\nA testimony to the Buddhist architecture and teachings, it is a perfect place to attain mental peace and know more about Buddhism. Its spiritual appeal and grandeur makes it an integral part of any Gangtok travel packages!', 'IMG_20508.jpg'),
(10, 'Namchi', 'Translated into the native Tibetan language, Namchi means the ‘top of the sky’. And on a visit to this magnificent Sikkimese city, this will be proved! Located around 92km from Gangtok and at a height of 1,675m above the sea level, it is also one of the most gorgeous cities in the state.\r\n\r\nMore than tourism, Namchi is more considered as a pilgrimage centre for the Buddhists. Amongst the important religious sites, the Namchi Monastery, Tendong Hill and Ralong Monasteries are the pre-dominant. The city also has a 108ft Lord Shiva statue and is visited a large number of Hindu devotees as well.', 'IMG_39997.jpg'),
(11, 'Zuluk', 'Touching a towering height of 10,000ft, Zuluk is one of the least discovered destinations in the entire of Sikkim. Located on the ancient ‘Silk Route’, this quaint Sikkimese village takes the pride of being a vintage point to enjoy panoramic views of the Mt Kanchenjunga.\r\n\r\nIn addition to the magical beauty of this hamlet, it is also popular among the adventure lovers as the ride to Zuluk takes them through 32 hair-pin bends.', 'IMG_38657.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(600) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(50) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `desc` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `desc`, `status`, `removed`) VALUES
(1, 'simple room2', 245, 450, 10, 9, 3, 'jkrgjfjgnfvbfmbvmbmv', 1, 0),
(2, 'Name', 22, 222, 2, 2, 22, 'bjcddbndbndncdnbfbhdfhhjfd', 1, 0),
(3, 'Deluxe Room', 27, 500, 1, 2, 3, 'jnxvchjvchhjdcnbncvbjvcbnbnvcnvc', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(86, 2, 15),
(87, 2, 16),
(88, 2, 19),
(89, 2, 20),
(90, 2, 23),
(91, 2, 24),
(131, 3, 15),
(132, 3, 16),
(133, 3, 19),
(134, 3, 20),
(135, 3, 23),
(136, 3, 24),
(137, 1, 15),
(138, 1, 16),
(139, 1, 17),
(140, 1, 18),
(141, 1, 19),
(142, 1, 20),
(143, 1, 21),
(144, 1, 23),
(145, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(18, 2, 'IMG_22200.jpeg', 1),
(19, 2, 'IMG_52324.jpeg', 0),
(21, 3, 'IMG_22782.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` longtext NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Tamudhee Homestay', 'Welcome to Tamudhee Homestay and welcome to Sikkim — designed to win your heart. Our homestay nestled in the lap of the mighty Himalayas is built with love and understated elegance, immersed in the warmth and simplicity of a second home that is close to your heart.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenum` varchar(30) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` varchar(11) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `token` varchar(64) DEFAULT NULL,
  `t_expire` datetime DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `status`, `token`, `t_expire`, `datentime`) VALUES
(8, 'Pema Tshewang Norbu', 'ptshewang505@gmail.com', '17831390', 'IMG_93936.jpeg', 'Sonamthang', '34103', '2003-03-15', '$2y$10$LJOn98jzrXYt5hLXDxVBGOB954ISDqHf.HzTdgwGVCPrtLyaRxlq.', 1, NULL, NULL, '2025-05-17 03:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_name`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
