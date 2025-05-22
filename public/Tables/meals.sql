-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 07:38 PM
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
-- Database: `eatdannys`
--

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `category_id`, `name`, `description`, `prices`, `created_at`, `updated_at`) VALUES
(1, 1, 'Efo Riro with Fish', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 75}, {\"size\": \"6L\", \"price\": 135}]', NULL, NULL),
(2, 1, 'Efo Riro with Assorted', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 75}, {\"size\": \"6L\", \"price\": 135}]', NULL, NULL),
(3, 1, 'Egusi Soup', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 85}, {\"size\": \"6L\", \"price\": 155}]', NULL, NULL),
(4, 1, 'Oha Soup', '', '[{\"size\": \"2L\", \"price\": 95}, {\"size\": \"3L\", \"price\": 140}, {\"size\": \"6L\", \"price\": 260}]', NULL, NULL),
(5, 1, 'Banga Soup', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 135}, {\"size\": \"6L\", \"price\": 250}]', NULL, NULL),
(6, 1, 'Ogbono Soup', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 135}, {\"size\": \"6L\", \"price\": 250}]', NULL, NULL),
(7, 1, 'Bitter Leaf Soup', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 135}, {\"size\": \"6L\", \"price\": 250}]', NULL, NULL),
(8, 1, 'Seafood Okro', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 100}, {\"size\": \"6L\", \"price\": 190}]', NULL, NULL),
(9, 1, 'Ofada/Avamase (Red)', '', '[{\"size\": \"2L\", \"price\": 80}, {\"size\": \"3L\", \"price\": 120}, {\"size\": \"6L\", \"price\": 240}]', NULL, NULL),
(10, 1, 'Ofada/Ayamase (Green)', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 100}, {\"size\": \"6L\", \"price\": 200}]', NULL, NULL),
(11, 1, 'Cow Leg Pepper Soup', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 95}, {\"size\": \"6L\", \"price\": 180}]', NULL, NULL),
(12, 1, 'Catfish Pepper Soup', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 95}, {\"size\": \"6L\", \"price\": 180}]', NULL, NULL),
(13, 1, 'Assorted Pepper Soup', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 90}, {\"size\": \"6L\", \"price\": 175}]', NULL, NULL),
(14, 1, 'Gbegiri (Bean Soup)', '', '[{\"size\": \"2L\", \"price\": 35}, {\"size\": \"3L\", \"price\": 60}, {\"size\": \"6L\", \"price\": 95}]', NULL, NULL),
(15, 1, 'Ewedu', '', '[{\"size\": \"2L\", \"price\": 35}, {\"size\": \"3L\", \"price\": 60}, {\"size\": \"6L\", \"price\": 95}]', NULL, NULL),
(16, 1, 'Chicken Stew', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 85}, {\"size\": \"6L\", \"price\": 150}]', NULL, NULL),
(17, 1, 'Turkey Stew', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 95}, {\"size\": \"6L\", \"price\": 175}]', NULL, NULL),
(18, 1, 'Fish Stew', '', '[{\"size\": \"2L\", \"price\": 80}, {\"size\": \"3L\", \"price\": 120}, {\"size\": \"6L\", \"price\": 200}]', NULL, NULL),
(19, 1, 'Beef Stew', '', '[{\"size\": \"2L\", \"price\": 80}, {\"size\": \"3L\", \"price\": 120}, {\"size\": \"6L\", \"price\": 230}]', NULL, NULL),
(20, 1, 'Goat Meat Stew', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 130}, {\"size\": \"6L\", \"price\": 240}]', NULL, NULL),
(21, 1, 'Assorted Stew', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 110}, {\"size\": \"6L\", \"price\": 200}]', NULL, NULL),
(22, 2, 'Midi Meat Pie (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 35}]', NULL, NULL),
(23, 2, 'Puff Puff (5 Dozens - 60 Pieces)', '', '[{\"size\": \"60 pieces\", \"price\": 30}]', NULL, NULL),
(24, 2, 'Puff Puff (120 Pieces)', '', '[{\"size\": \"120 pieces\", \"price\": 60}]', NULL, NULL),
(25, 2, 'Puff Puff (240 Pieces)', '', '[{\"size\": \"240 pieces\", \"price\": 120}]', NULL, NULL),
(26, 2, 'Sausage Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 35}]', NULL, NULL),
(27, 2, 'Chicken Pie (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 40}]', NULL, NULL),
(28, 2, 'Fish Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 25}]', NULL, NULL),
(29, 2, 'Chinchin (1KG)', '', '[{\"size\": \"1KG\", \"price\": 35}]', NULL, NULL),
(30, 2, 'Corn Straw', '', '[{\"size\": \"1 Pack\", \"price\": 30}]', NULL, NULL),
(31, 2, 'Coconut Chips', '', '[{\"size\": \"1 Pack\", \"price\": 30}]', NULL, NULL),
(32, 2, 'Scotch Eggs (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 60}]', NULL, NULL),
(33, 2, 'Samosa (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 15}]', NULL, NULL),
(34, 2, 'Spring Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 15}]', NULL, NULL),
(35, 2, 'Shrimp Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 25}]', NULL, NULL),
(36, 2, 'Buns Small Tray (5 Dozens)', '', '[{\"size\": \"60 pieces\", \"price\": 50}]', NULL, NULL),
(37, 3, 'Beef Suya', '', '[{\"size\": \"Small\", \"price\": 55}, {\"size\": \"Medium\", \"price\": 100}, {\"size\": \"Large\", \"price\": 200}]', NULL, NULL),
(38, 3, 'Peppered Chicken', '', '[{\"size\": \"Small\", \"price\": 60}, {\"size\": \"Medium\", \"price\": 85}, {\"size\": \"Large\", \"price\": 120}]', NULL, NULL),
(39, 3, 'Peppered Turkey', '', '[{\"size\": \"Small\", \"price\": 75}, {\"size\": \"Medium\", \"price\": 125}, {\"size\": \"Large\", \"price\": 160}]', NULL, NULL),
(40, 3, 'Peppered Fish', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 130}]', NULL, NULL),
(41, 3, 'Peppered Beef', '', '[{\"size\": \"Small\", \"price\": 110}, {\"size\": \"Medium\", \"price\": 165}, {\"size\": \"Large\", \"price\": 230}]', NULL, NULL),
(42, 3, 'Goat Meat Asun', '', '[{\"size\": \"Small\", \"price\": 250}, {\"size\": \"Medium\", \"price\": 350}, {\"size\": \"Large\", \"price\": 500}]', NULL, NULL),
(43, 3, 'Gizzdodo', '', '[{\"size\": \"Small\", \"price\": 110}, {\"size\": \"Medium\", \"price\": 165}, {\"size\": \"Large\", \"price\": 230}]', NULL, NULL),
(44, 3, 'Gizzard Skewer', '', '[{\"size\": \"Small\", \"price\": 110}, {\"size\": \"Medium\", \"price\": 165}, {\"size\": \"Large\", \"price\": 230}]', NULL, NULL),
(45, 3, 'Fried Plantain', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 120}]', NULL, NULL),
(46, 4, 'Jollof Rice', '', '[{\"size\": \"Small\", \"price\": 40}, {\"size\": \"Medium\", \"price\": 60}, {\"size\": \"Large\", \"price\": 90}, {\"size\": \"Cooler\", \"price\": 190}]', NULL, NULL),
(47, 4, 'Asun Jollof', '', '[{\"size\": \"Small\", \"price\": 90}, {\"size\": \"Medium\", \"price\": 145}, {\"size\": \"Large\", \"price\": 250}]', NULL, NULL),
(48, 4, 'Fried Rice', '', '[{\"size\": \"Small\", \"price\": 50}, {\"size\": \"Medium\", \"price\": 75}, {\"size\": \"Large\", \"price\": 100}, {\"size\": \"Cooler\", \"price\": 250}]', NULL, NULL),
(49, 4, 'Coconut Rice', '', '[{\"size\": \"Small\", \"price\": 55}, {\"size\": \"Medium\", \"price\": 80}, {\"size\": \"Large\", \"price\": 110}, {\"size\": \"Cooler\", \"price\": 250}]', NULL, NULL),
(50, 4, 'Native Rice', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 120}, {\"size\": \"Cooler\", \"price\": 300}]', NULL, NULL),
(51, 4, 'Ofada Rice', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 120}, {\"size\": \"Cooler\", \"price\": 300}]', NULL, NULL),
(52, 4, 'Porridge (Asaro)', '', '[{\"size\": \"Small\", \"price\": 90}, {\"size\": \"Medium\", \"price\": 140}, {\"size\": \"Large\", \"price\": 180}, {\"size\": \"Cooler\", \"price\": 360}]', NULL, NULL),
(53, 4, 'Moi Moi Elewe', '', '[{\"quantity\": \"6 Pieces\", \"price\": 30}, {\"quantity\": \"12 Pieces\", \"price\": 50}, {\"quantity\": \"24 Pieces\", \"price\": 100}]', NULL, NULL),
(54, 4, 'Amala A Dozen', '', '[{\"quantity\": \"12 Pieces\", \"price\": 50}]', NULL, NULL),
(55, 4, 'Pounded Yam', '', '[{\"quantity\": \"12 Pieces\", \"price\": 45}]', NULL, NULL),
(56, 4, 'Semo A Dozen', '', '[{\"quantity\": \"12 Pieces\", \"price\": 50}]', NULL, NULL),
(57, 4, 'Eba A Dozen', '', '[{\"quantity\": \"12 Pieces\", \"price\": 45}]', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
