-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql302.byetcluster.com
-- Generation Time: Oct 03, 2022 at 03:51 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32620882_bookfest`
--

-- --------------------------------------------------------

--
-- Table structure for table `ANNOUNCEMENT`
--

CREATE TABLE `ANNOUNCEMENT` (
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `content` varchar(1023) CHARACTER SET utf8mb4 NOT NULL,
  `time` datetime NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ANNOUNCEMENT`
--

INSERT INTO `ANNOUNCEMENT` (`email`, `content`, `time`, `link`, `state`) VALUES
('tranphuc8a@gmail.com', 'Welcom to Bookfest', '2022-09-14 00:00:00', '#', 'unread'),
('tranphuc8b@gmail.com', 'Welcom to Bookfest', '2022-09-14 00:00:00', '#', 'unread'),
('tranphuc8c@gmail.com', 'Welcom to Bookfest', '2022-09-14 00:00:00', '#', 'unread'),
('tranphuc8d@gmail.com', 'Welcom to Bookfest', '2022-09-14 00:00:00', '#', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `BOOK`
--

CREATE TABLE `BOOK` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cost` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `sell` int(11) NOT NULL,
  `time` datetime DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BOOK`
--

INSERT INTO `BOOK` (`id`, `email`, `cost`, `quantity`, `sell`, `time`, `state`) VALUES
(1, 'tranphuc8b@gmail.com', 100000, 10, 5, '2022-09-14 00:00:00', 'OK'),
(2, 'tranphuc8b@gmail.com', 300000, 12, 2, '2022-09-26 15:23:37', 'OK'),
(3, 'tranphuc8b@gmail.com', 133000, 32, 3, '2022-09-26 15:34:15', 'OK'),
(4, 'phuc.tv194139@sis.hust.edu.vn', 200000, 30, 3, '2022-09-29 22:55:36', 'OK');

-- --------------------------------------------------------

--
-- Table structure for table `BOOK_COMMENT`
--

CREATE TABLE `BOOK_COMMENT` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `star` int(11) NOT NULL,
  `content` varchar(1023) CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BOOK_COMMENT`
--

INSERT INTO `BOOK_COMMENT` (`id`, `productid`, `email`, `star`, `content`, `time`) VALUES
(1, 3, 'tranphuc8b@gmail.com', 3, 'Đây là đánh giá đầu tiên', '2022-09-29 14:11:45'),
(3, 3, 'tranphuc8b@gmail.com', 4, '', '2022-09-29 14:12:57'),
(4, 3, 'tranphuc8b@gmail.com', 4, '', '2022-09-29 14:19:03'),
(6, 3, 'tranphuc8b@gmail.com', 4, '', '2022-09-29 14:22:10'),
(9, 3, 'tranphuc8c@gmail.com', 4, 'Sản phẩm tốt', '2022-09-29 22:51:23'),
(10, 4, 'tranphuc8c@gmail.com', 5, 'Sản phẩm tốt', '2022-10-02 14:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `BOOK_IMAGE`
--

CREATE TABLE `BOOK_IMAGE` (
  `id` int(11) NOT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `BOOK_IMAGE`
--

INSERT INTO `BOOK_IMAGE` (`id`, `image1`, `image2`, `image3`, `image4`, `image5`) VALUES
(2, 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/tranphuc8b@gmail_combook2image0.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/tranphuc8b@gmail_combook2image1.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg'),
(3, 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg'),
(1, 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/tranphuc8b@gmail_combook1image0.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest/image/404.jpg'),
(4, 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/phuc_tv194139@sis_hust_edu_vnbook4image0.jpg', 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/phuc_tv194139@sis_hust_edu_vnbook4image1.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `BOOK_INFO`
--

CREATE TABLE `BOOK_INFO` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `publisher` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `detail` varchar(9999) CHARACTER SET utf8 DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BOOK_INFO`
--

INSERT INTO `BOOK_INFO` (`id`, `name`, `author`, `pages`, `publisher`, `detail`, `avatar`) VALUES
(1, 'Hai ngày một đêm', 'Đông Tây Promotion', 0, 'VieOn VieChannel', 'CHương trình trải nghiệm thực tế', 'https://upload.wikimedia.org/wikipedia/commons/0/06/2N1DVN.webp'),
(2, 'NN lập trình C++', 'Stroustrup', 0, 'Bách Khoa', 'Hello Bách Khoa', 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/tranphuc8b@gmail_combook2avatar.jpg'),
(3, 'Tốt nghiệp 2022', 'Vương Thiên Nhất', 0, 'Thiên Thiên Tượng Kỳ', 'Cuốn sách này rất hay', 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/tranphuc8b@gmail_combook3avatar.jpg'),
(4, 'Thiên thiên tượng kỳ', 'Vương Thiên Nhất', 32, 'Hàng không', 'Đây là một sản phẩm tốt', 'http://tranphuc8a.epizy.com/prj1/Bookfest//uploads/phuc_tv194139@sis_hust_edu_vnbook4avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `CART`
--

CREATE TABLE `CART` (
  `email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CART`
--

INSERT INTO `CART` (`email`, `id`, `quantity`, `time`) VALUES
('tranphuc8c@gmail.com', 2, 9, '2022-09-29 14:31:33'),
('tranphuc8c@gmail.com', 1, 2, '2022-09-29 14:32:44'),
('tranphuc8c@gmail.com', 3, 1, '2022-09-29 14:32:50'),
('tranphuc8c@gmail.com', 4, 3, '2022-10-02 14:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `CHAT`
--

CREATE TABLE `CHAT` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CHAT`
--

INSERT INTO `CHAT` (`id`, `name`, `time`) VALUES
(1, 'Phúc chat', '2022-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `CHAT_USER`
--

CREATE TABLE `CHAT_USER` (
  `idChat` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role` varchar(255) CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CHAT_USER`
--

INSERT INTO `CHAT_USER` (`idChat`, `email`, `role`, `time`) VALUES
(1, 'tranphuc8a@gmail.com', 'admin', '2022-09-14 00:00:00'),
(1, 'tranphuc8b@gmail.com', 'memeber', '2022-09-14 00:00:00'),
(1, 'tranphuc8c@gmail.com', 'memeber', '2022-09-14 00:00:00'),
(1, 'tranphuc8d@gmail.com', 'memeber', '2022-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `CODE`
--

CREATE TABLE `CODE` (
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CODE`
--

INSERT INTO `CODE` (`email`, `code`, `time`) VALUES
('phuc.tv194139@sis.hust.edu.vn', 'f018aa579cef0da21e4b34bfea548895', '2022-09-19 17:52:23'),
('tranvanphuc2k1@gmail.com', '2c46dcee0a177589265b15e0a8bedeab', '2022-09-21 16:44:57'),
('trantrungthiep13022000@gmail.com', 'ee5229a18607ac50aa77a6227cbd0c20', '2022-09-23 17:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `FRIEND`
--

CREATE TABLE `FRIEND` (
  `email1` varchar(255) NOT NULL,
  `email2` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FRIEND`
--

INSERT INTO `FRIEND` (`email1`, `email2`, `time`) VALUES
('tranphuc8a@gmail.com', 'tranphuc8b@gmail.com', '2022-09-14 00:00:00'),
('tranphuc8a@gmail.com', 'tranphuc8c@gmail.com', '2022-09-14 00:00:00'),
('tranphuc8a@gmail.com', 'tranphuc8d@gmail.com', '2022-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `LOGIN`
--

CREATE TABLE `LOGIN` (
  `email` varchar(255) NOT NULL,
  `tokenid` varchar(255) NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LOGIN`
--

INSERT INTO `LOGIN` (`email`, `tokenid`, `time`) VALUES
('phuc.tv194139@sis.hust.edu.vn', 'd0890fd7bae099428e2c8b3ce934259f', '2022-09-29 22:53:12'),
('tranphuc8a@gmail.com', '850b26fc7409b67ad1eef8a993096893', '2022-09-25 02:07:35'),
('trantrungthiep13022000@gmail.com', '3c39be1a15c30f4bccb726bec1c61b22', '2022-09-23 17:30:26'),
('tranphuc8c@gmail.com', '0179b202a9d198eb3d3009e84fffab5b', '2022-10-02 15:02:25'),
('tranphuc8b@gmail.com', '80adaea67607dc32bda56d287795c62a', '2022-09-29 14:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `idChat` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` varchar(1023) CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MESSAGE`
--

INSERT INTO `MESSAGE` (`idChat`, `email`, `content`, `time`) VALUES
(1, 'tranphuc8a@gmail.com', 'Alo mọi người', '2022-09-14 00:00:00'),
(1, 'tranphuc8a@gmail.com', 'Alo mọi người', '2022-09-14 00:00:00'),
(1, 'tranphuc8b@gmail.com', 'Alo mọi người', '2022-09-14 00:00:00'),
(1, 'tranphuc8d@gmail.com', 'Alo mọi người', '2022-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `PROFILE`
--

CREATE TABLE `PROFILE` (
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `detail` varchar(1023) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PROFILE`
--

INSERT INTO `PROFILE` (`email`, `name`, `avatar`, `phone`, `dob`, `detail`) VALUES
('tranphuc8a@gmail.com', 'Trần Văn Phúc', NULL, '0965074220', '2001-04-22', 'Đệp trâi'),
('tranphuc8b@gmail.com', 'Trần Trung Thiệp', NULL, '0965074220', '2001-04-22', 'Đệp trâi'),
('tranphuc8c@gmail.com', 'Trần Thành Long', NULL, '0965074220', '2001-04-22', 'Đệp trâi'),
('tranphuc8d@gmail.com', 'Trịnh Đức Tiệp', NULL, '0965074220', '2001-04-22', 'Đệp trâi'),
('phuc.tv194139@sis.hust.edu.vn', 'Trần Văn Phúc', NULL, '0965074220', '2022-09-22', ''),
('trantrungthiep13022000@gmail.com', 'Thiep', NULL, '0966400752', '2000-02-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `RECEIPT`
--

CREATE TABLE `RECEIPT` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double NOT NULL,
  `buyemail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sellemail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `during` int(11) NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `RECEIPT`
--

INSERT INTO `RECEIPT` (`id`, `productid`, `quantity`, `cost`, `buyemail`, `sellemail`, `address`, `message`, `time`, `during`, `state`) VALUES
(1, 3, 4, 532000, 'tranphuc8c@gmail.com', 'tranphuc8b@gmail.com', 'Bùi Cẩm Xá Mỹ Hào Hưng Yên', 'Lấy cuốn mày xanh', '2022-10-02 14:50:54', 0, 'submitted'),
(2, 4, 3, 600000, 'tranphuc8c@gmail.com', 'phuc.tv194139@sis.hust.edu.vn', '', '', '2022-10-02 14:41:55', 0, 'not_submitted');

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `email` varchar(255) CHARACTER SET ascii NOT NULL,
  `hashmk` varchar(255) CHARACTER SET ascii NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`email`, `hashmk`, `role`, `state`, `time`) VALUES
('tranphuc8a@gmail.com', 'admin', 'admin', 'normal', '2022-09-14 00:00:00'),
('tranphuc8b@gmail.com', 'admin', 'provider', 'normal', '2022-09-14 00:00:00'),
('tranphuc8c@gmail.com', 'admin', 'customer', 'normal', '2022-09-14 00:00:00'),
('tranphuc8d@gmail.com', 'admin', 'customer', 'block', '2022-09-14 00:00:00'),
('phuc.tv194139@sis.hust.edu.vn', 'admin', 'provider', 'normal', '2022-09-19 00:00:00'),
('trantrungthiep13022000@gmail.com', '123', 'customer', 'normal', '2022-09-21 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ANNOUNCEMENT`
--
ALTER TABLE `ANNOUNCEMENT`
  ADD KEY `fk5` (`email`(250));

--
-- Indexes for table `BOOK`
--
ALTER TABLE `BOOK`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk6` (`email`);

--
-- Indexes for table `BOOK_COMMENT`
--
ALTER TABLE `BOOK_COMMENT`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk9` (`productid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `BOOK_IMAGE`
--
ALTER TABLE `BOOK_IMAGE`
  ADD KEY `fk8` (`id`);

--
-- Indexes for table `BOOK_INFO`
--
ALTER TABLE `BOOK_INFO`
  ADD KEY `fk7` (`id`);

--
-- Indexes for table `CART`
--
ALTER TABLE `CART`
  ADD KEY `fk13` (`email`),
  ADD KEY `idbook` (`id`);

--
-- Indexes for table `CHAT`
--
ALTER TABLE `CHAT`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CHAT_USER`
--
ALTER TABLE `CHAT_USER`
  ADD PRIMARY KEY (`idChat`,`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `CODE`
--
ALTER TABLE `CODE`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `FRIEND`
--
ALTER TABLE `FRIEND`
  ADD PRIMARY KEY (`email1`,`email2`),
  ADD KEY `email2` (`email2`);

--
-- Indexes for table `LOGIN`
--
ALTER TABLE `LOGIN`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD KEY `fk4` (`idChat`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `PROFILE`
--
ALTER TABLE `PROFILE`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `RECEIPT`
--
ALTER TABLE `RECEIPT`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk10` (`productid`),
  ADD KEY `buyemail` (`buyemail`(250)),
  ADD KEY `sellemail` (`sellemail`(250));

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BOOK`
--
ALTER TABLE `BOOK`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `BOOK_COMMENT`
--
ALTER TABLE `BOOK_COMMENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `CHAT`
--
ALTER TABLE `CHAT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `RECEIPT`
--
ALTER TABLE `RECEIPT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
