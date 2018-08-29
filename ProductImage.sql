-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2017 at 07:12 PM
-- Server version: 10.1.23-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a1pro_shopta_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `ProductImage`
--

CREATE TABLE `ProductImage` (
  `imgId` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `is_main_img` int(2) NOT NULL DEFAULT '0' COMMENT 'product main image "1"',
  `productImage` varchar(120) NOT NULL,
  `product_imagePath` varchar(255) NOT NULL,
  `image_upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductImage`
--

INSERT INTO `ProductImage` (`imgId`, `p_id`, `is_main_img`, `productImage`, `product_imagePath`, `image_upload_date`) VALUES
(1, 43, 1, 'Pro-2017-04-20_13:12:24-vzRtftiNMm.jpg', 'uploads/product_images/Pro-2017-04-20_13:12:24-vzRtftiNMm.jpg', '2017-04-20 13:12:24'),
(2, 43, 0, 'GalleryImage-2017-04-20_13:12:24-CZtBCSf53y.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:12:24-CZtBCSf53y.jpg', '2017-04-20 13:12:24'),
(3, 39, 1, 'Pro-2017-04-20_13:13:31-IvNwR1yYL6.jpeg', 'uploads/product_images/Pro-2017-04-20_13:13:31-IvNwR1yYL6.jpeg', '2017-04-20 13:13:33'),
(4, 39, 0, 'GalleryImage-2017-04-20_13:13:31-LiEd2pRy21.jpeg', 'uploads/product_images/GalleryImage-2017-04-20_13:13:31-LiEd2pRy21.jpeg', '2017-04-20 13:13:33'),
(5, 38, 1, 'Pro-2017-04-20_13:13:56-vnmZvWEfSI.jpg', 'uploads/product_images/Pro-2017-04-20_13:13:56-vnmZvWEfSI.jpg', '2017-04-20 13:13:56'),
(6, 38, 0, 'GalleryImage-2017-04-20_13:13:56-OzQZ2L5iK3.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:13:56-OzQZ2L5iK3.jpg', '2017-04-20 13:13:56'),
(7, 20, 1, 'Pro-2017-04-20_13:14:17-02huLNMVsy.JPG', 'uploads/product_images/Pro-2017-04-20_13:14:17-02huLNMVsy.JPG', '2017-04-20 13:14:18'),
(8, 20, 0, 'GalleryImage-2017-04-20_13:14:17-bO6V4AUIrD.JPG', 'uploads/product_images/GalleryImage-2017-04-20_13:14:17-bO6V4AUIrD.JPG', '2017-04-20 13:14:18'),
(15, 14, 1, 'Pro-2017-04-20_13:16:02-XDx4degD8q.jpg', 'uploads/product_images/Pro-2017-04-20_13:16:02-XDx4degD8q.jpg', '2017-04-20 13:16:02'),
(16, 14, 0, 'GalleryImage-2017-04-20_13:16:02-hRUXRlblKO.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:16:02-hRUXRlblKO.jpg', '2017-04-20 13:16:02'),
(17, 13, 1, 'Pro-2017-04-20_13:16:34-LroZoNBath.jpg', 'uploads/product_images/Pro-2017-04-20_13:16:34-LroZoNBath.jpg', '2017-04-20 13:16:34'),
(18, 13, 0, 'GalleryImage-2017-04-20_13:16:34-FXGWIPpDJa.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:16:34-FXGWIPpDJa.jpg', '2017-04-20 13:16:34'),
(19, 12, 1, 'Pro-2017-04-20_13:17:00-PtXN0McF8V.jpg', 'uploads/product_images/Pro-2017-04-20_13:17:00-PtXN0McF8V.jpg', '2017-04-20 13:17:00'),
(20, 12, 0, 'GalleryImage-2017-04-20_13:17:00-zIo4cAgeZk.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:17:00-zIo4cAgeZk.jpg', '2017-04-20 13:17:00'),
(21, 11, 0, 'Pro-2017-04-20_13:17:26-2TrQJNlKrk.jpg', 'uploads/product_images/Pro-2017-04-20_13:17:26-2TrQJNlKrk.jpg', '2017-04-20 13:17:26'),
(23, 9, 0, 'Pro-2017-04-20_13:17:57-WL4wuBtrJj.jpg', 'uploads/product_images/Pro-2017-04-20_13:17:57-WL4wuBtrJj.jpg', '2017-04-20 13:17:57'),
(25, 8, 0, 'Pro-2017-04-20_13:18:14-bTZZTEO1dJ.jpg', 'uploads/product_images/Pro-2017-04-20_13:18:14-bTZZTEO1dJ.jpg', '2017-04-20 13:18:15'),
(27, 7, 1, 'Pro-2017-04-20_13:18:33-rafKpbKg5y.jpg', 'uploads/product_images/Pro-2017-04-20_13:18:33-rafKpbKg5y.jpg', '2017-04-20 13:18:33'),
(28, 7, 0, 'GalleryImage-2017-04-20_13:18:33-WNRSf7CSOl.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:18:33-WNRSf7CSOl.jpg', '2017-04-20 13:18:33'),
(29, 6, 1, 'Pro-2017-04-20_13:18:55-CXOI57dBiO.jpg', 'uploads/product_images/Pro-2017-04-20_13:18:55-CXOI57dBiO.jpg', '2017-04-20 13:18:55'),
(30, 6, 0, 'GalleryImage-2017-04-20_13:18:55-GMsxnZVS1j.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:18:55-GMsxnZVS1j.jpg', '2017-04-20 13:18:55'),
(31, 2, 1, 'Pro-2017-04-20_13:19:22-3pwyEt1AjH.png', 'uploads/product_images/Pro-2017-04-20_13:19:22-3pwyEt1AjH.png', '2017-04-20 13:19:23'),
(32, 2, 0, 'GalleryImage-2017-04-20_13:19:22-byOGYBSfuv.png', 'uploads/product_images/GalleryImage-2017-04-20_13:19:22-byOGYBSfuv.png', '2017-04-20 13:19:23'),
(33, 16, 1, 'Pro-2017-04-20_13:24:03-weavDoblLt.JPG', 'uploads/product_images/Pro-2017-04-20_13:24:03-weavDoblLt.JPG', '2017-04-20 13:24:03'),
(34, 16, 0, 'GalleryImage-2017-04-20_13:24:03-bnFkc6XU0X.JPG', 'uploads/product_images/GalleryImage-2017-04-20_13:24:03-bnFkc6XU0X.JPG', '2017-04-20 13:24:03'),
(35, 17, 1, 'Pro-2017-04-20_13:34:20-6K9Flg39um.jpg', 'uploads/product_images/Pro-2017-04-20_13:34:20-6K9Flg39um.jpg', '2017-04-20 13:34:20'),
(36, 17, 0, 'GalleryImage-2017-04-20_13:34:20-3uJfuYHZrB.jpg', 'uploads/product_images/GalleryImage-2017-04-20_13:34:20-3uJfuYHZrB.jpg', '2017-04-20 13:34:20'),
(37, 15, 1, 'Pro-2017-04-24_06:45:12-ciFyiTLdhN.jpg', 'uploads/product_images/Pro-2017-04-24_06:45:12-ciFyiTLdhN.jpg', '2017-04-24 06:45:12'),
(38, 15, 0, 'GalleryImage-2017-04-24_06:45:12-YhefZdDvis.jpg', 'uploads/product_images/GalleryImage-2017-04-24_06:45:12-YhefZdDvis.jpg', '2017-04-24 06:45:12'),
(39, 11, 1, 'Pro-2017-04-24_06:45:58-UY5Hzu60rd.jpg', 'uploads/product_images/Pro-2017-04-24_06:45:58-UY5Hzu60rd.jpg', '2017-04-24 06:45:59'),
(40, 11, 0, 'GalleryImage-2017-04-24_06:45:58-6xEFLcsI2W.jpg', 'uploads/product_images/GalleryImage-2017-04-24_06:45:58-6xEFLcsI2W.jpg', '2017-04-24 06:45:59'),
(41, 9, 1, 'Pro-2017-04-24_06:46:32-OjRYf8PVqU.jpg', 'uploads/product_images/Pro-2017-04-24_06:46:32-OjRYf8PVqU.jpg', '2017-04-24 06:46:32'),
(42, 9, 0, 'GalleryImage-2017-04-24_06:46:32-MQEjJ95mmt.jpg', 'uploads/product_images/GalleryImage-2017-04-24_06:46:32-MQEjJ95mmt.jpg', '2017-04-24 06:46:32'),
(43, 8, 1, 'Pro-2017-04-24_06:47:52-QCJUKKPFHe.jpg', 'uploads/product_images/Pro-2017-04-24_06:47:52-QCJUKKPFHe.jpg', '2017-04-24 06:47:53'),
(44, 8, 0, 'GalleryImage-2017-04-24_06:47:52-TVN4nReYVq.jpg', 'uploads/product_images/GalleryImage-2017-04-24_06:47:52-TVN4nReYVq.jpg', '2017-04-24 06:47:53'),
(45, 43, 0, 'GalleryImage-2017-04-29_05:27:32-D8Zio0T8ze.jpg', 'uploads/product_images/GalleryImage-2017-04-29_05:27:32-D8Zio0T8ze.jpg', '2017-04-29 05:27:33'),
(46, 44, 1, 'Pro-2017-05-03_07:58:14-v67iNXbLW7.jpg', 'uploads/product_images/Pro-2017-05-03_07:58:14-v67iNXbLW7.jpg', '2017-05-03 07:58:15'),
(47, 45, 1, 'Pro-2017-05-03_08:35:54-XV4ndKePaT.jpg', 'uploads/product_images/Pro-2017-05-03_08:35:54-XV4ndKePaT.jpg', '2017-05-03 08:35:54'),
(48, 46, 1, 'Pro-2017-05-03_12:05:58-UeJPWkxpyp.jpg', 'uploads/product_images/Pro-2017-05-03_12:05:58-UeJPWkxpyp.jpg', '2017-05-03 12:05:58'),
(49, 47, 1, 'Pro-2017-05-03_12:33:29-Gd89jSpjVb.png', 'uploads/product_images/Pro-2017-05-03_12:33:29-Gd89jSpjVb.png', '2017-05-03 12:33:29'),
(50, 53, 1, 'Pro-2017-05-04_07:59:14-GBujw69q4p.jpg', 'uploads/product_images/Pro-2017-05-04_07:59:14-GBujw69q4p.jpg', '2017-05-04 07:59:14'),
(51, 54, 1, 'Pro-2017-05-04_09:00:52-Oy1ypiI4K1.jpg', 'uploads/product_images/Pro-2017-05-04_09:00:52-Oy1ypiI4K1.jpg', '2017-05-04 09:00:52'),
(52, 55, 1, 'Pro-2017-05-05_05:47:20-L1kknpgcYZ.jpg', 'uploads/product_images/Pro-2017-05-05_05:47:20-L1kknpgcYZ.jpg', '2017-05-05 05:47:23'),
(53, 56, 0, 'Pro-2017-05-16_12:53:05-lRItCBzXdt.jpg', 'uploads/product_images/Pro-2017-05-16_12:53:05-lRItCBzXdt.jpg', '2017-05-16 12:53:05'),
(54, 56, 1, 'Pro-2017-05-29_11:47:54-fYPriUOhDl.png', 'uploads/product_images/Pro-2017-05-29_11:47:54-fYPriUOhDl.png', '2017-05-29 11:47:55'),
(55, 57, 1, 'Pro-2017-05-29_12:25:09-MsHBFQ879T.jpg', 'uploads/product_images/Pro-2017-05-29_12:25:09-MsHBFQ879T.jpg', '2017-05-29 12:25:09'),
(56, 59, 1, 'Pro-2017-05-30_10:45:54-kkRU95K38X.jpg', 'uploads/product_images/Pro-2017-05-30_10:45:54-kkRU95K38X.jpg', '2017-05-30 10:45:54'),
(57, 60, 1, 'Pro-2017-05-31_13:18:18-TZeE6ODYqb.png', 'uploads/product_images/Pro-2017-05-31_13:18:18-TZeE6ODYqb.png', '2017-05-31 13:18:18'),
(58, 62, 1, 'Pro-2017-05-31_13:36:39-IemgO2W9tF.png', 'uploads/product_images/Pro-2017-05-31_13:36:39-IemgO2W9tF.png', '2017-05-31 13:36:40'),
(59, 62, 0, 'GalleryImage-2017-05-31_13:36:39-PmYl6las1f.png', 'uploads/product_images/GalleryImage-2017-05-31_13:36:39-PmYl6las1f.png', '2017-05-31 13:36:40'),
(60, 62, 0, 'GalleryImage-2017-05-31_13:36:39-PmYl6las1f1.png', 'uploads/product_images/GalleryImage-2017-05-31_13:36:39-PmYl6las1f1.png', '2017-05-31 13:36:40'),
(61, 62, 0, 'GalleryImage-2017-05-31_13:36:39-PmYl6las1f2.png', 'uploads/product_images/GalleryImage-2017-05-31_13:36:39-PmYl6las1f2.png', '2017-05-31 13:36:40'),
(62, 62, 0, 'GalleryImage-2017-05-31_13:36:39-PmYl6las1f3.png', 'uploads/product_images/GalleryImage-2017-05-31_13:36:39-PmYl6las1f3.png', '2017-05-31 13:36:40'),
(63, 62, 0, 'GalleryImage-2017-05-31_13:36:39-PmYl6las1f4.png', 'uploads/product_images/GalleryImage-2017-05-31_13:36:39-PmYl6las1f4.png', '2017-05-31 13:36:40'),
(64, 62, 0, 'GalleryImage-2017-05-31_13:36:39-PmYl6las1f5.png', 'uploads/product_images/GalleryImage-2017-05-31_13:36:39-PmYl6las1f5.png', '2017-05-31 13:36:41'),
(65, 63, 1, 'Pro-2017-06-01_07:17:22-8FYAEBK41R.jpg', 'uploads/product_images/Pro-2017-06-01_07:17:22-8FYAEBK41R.jpg', '2017-06-01 07:17:23'),
(66, 63, 0, 'GalleryImage-2017-06-01_07:17:19-GiUxJgJOWa.jpg', 'uploads/product_images/GalleryImage-2017-06-01_07:17:19-GiUxJgJOWa.jpg', '2017-06-01 07:17:23'),
(67, 64, 1, 'Pro-2017-06-01_12:28:15-qfdjVKaErI.png', 'uploads/product_images/Pro-2017-06-01_12:28:15-qfdjVKaErI.png', '2017-06-01 12:28:15'),
(68, 64, 0, 'GalleryImage-2017-06-01_12:28:15-jNdDumpMzc.png', 'uploads/product_images/GalleryImage-2017-06-01_12:28:15-jNdDumpMzc.png', '2017-06-01 12:28:15'),
(69, 67, 1, 'Pro-2017-06-07_11:28:17-OwrRQ6Sxvm.jpg', 'uploads/product_images/Pro-2017-06-07_11:28:17-OwrRQ6Sxvm.jpg', '2017-06-07 11:28:18'),
(70, 68, 1, 'Pro-2017-06-12_06:47:05-g9LE5kYo6U.jpg', 'uploads/product_images/Pro-2017-06-12_06:47:05-g9LE5kYo6U.jpg', '2017-06-12 06:47:05'),
(71, 68, 0, 'GalleryImage-2017-06-12_06:47:05-r5QUy56LSE.jpg', 'uploads/product_images/GalleryImage-2017-06-12_06:47:05-r5QUy56LSE.jpg', '2017-06-12 06:47:05'),
(72, 69, 1, 'Pro-2017-06-12_07:17:38-BDTxVxVoBT.jpg', 'uploads/product_images/Pro-2017-06-12_07:17:38-BDTxVxVoBT.jpg', '2017-06-12 07:17:41'),
(73, 69, 0, 'GalleryImage-2017-06-12_07:17:38-KeqeUaYTly.jpg', 'uploads/product_images/GalleryImage-2017-06-12_07:17:38-KeqeUaYTly.jpg', '2017-06-12 07:17:42'),
(74, 70, 0, 'GalleryImage-2017-06-12_07:43:53-nYTNEUbl9f.jpg', 'uploads/product_images/GalleryImage-2017-06-12_07:43:53-nYTNEUbl9f.jpg', '2017-06-12 07:43:53'),
(75, 71, 1, 'Pro-2017-06-14_12:41:10-SjrwdboSjg.png', 'uploads/product_images/Pro-2017-06-14_12:41:10-SjrwdboSjg.png', '2017-06-14 12:41:11'),
(78, 71, 0, 'GalleryImage-2017-06-14_12:42:02-Y4XvWfXmF6.png', 'uploads/product_images/GalleryImage-2017-06-14_12:42:02-Y4XvWfXmF6.png', '2017-06-14 12:42:02'),
(79, 71, 0, 'GalleryImage-2017-06-14_12:42:02-Y4XvWfXmF61.png', 'uploads/product_images/GalleryImage-2017-06-14_12:42:02-Y4XvWfXmF61.png', '2017-06-14 12:42:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ProductImage`
--
ALTER TABLE `ProductImage`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `p_id` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ProductImage`
--
ALTER TABLE `ProductImage`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
