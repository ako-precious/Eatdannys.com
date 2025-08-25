-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 04:36 PM
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
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('eatdannys_cache_1db34a3f98b161f99815ae01bc1c54f9', 'i:1;', 1753238625),
('eatdannys_cache_1db34a3f98b161f99815ae01bc1c54f9:timer', 'i:1753238625;', 1753238625),
('eatdannys_cache_6103099b3accea06ba68d5b4b3599677', 'i:1;', 1753441604),
('eatdannys_cache_6103099b3accea06ba68d5b4b3599677:timer', 'i:1753441604;', 1753441604),
('eatdannys_cache_dd9a695a05ca70ffa5ee798dda5b6eb0', 'i:1;', 1753475327),
('eatdannys_cache_dd9a695a05ca70ffa5ee798dda5b6eb0:timer', 'i:1753475327;', 1753475327),
('eatdannys_cache_ricy@mailinator.com|127.0.0.1', 'i:1;', 1753238626),
('eatdannys_cache_ricy@mailinator.com|127.0.0.1:timer', 'i:1753238626;', 1753238626);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order_type` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `order_type`, `created_at`, `updated_at`) VALUES
(1, 'Soup', 'bulk', '2025-04-29 00:53:53', '2025-04-29 00:53:53'),
(2, 'Pastries', 'bulk', '2025-04-29 00:53:53', '2025-04-29 00:53:53'),
(3, 'Grills', 'bulk', '2025-04-29 00:53:53', '2025-04-29 00:53:53'),
(4, 'Meals', 'bulk', '2025-04-29 00:53:53', '2025-04-29 00:53:53'),
(5, 'Mains', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:42:57'),
(6, 'Soups', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:40:57'),
(7, 'Lunch Special ', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:40:57'),
(8, 'Suya Sampler Platter', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:40:57'),
(9, 'Beverage', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:40:57'),
(10, 'Pastries & Dessert', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:40:57'),
(11, 'Sides & Extras', 'dine-in', '2025-07-19 01:40:57', '2025-07-19 01:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`prices`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `category_id`, `name`, `description`, `prices`, `created_at`, `updated_at`) VALUES
(1, 1, 'Efo Riro with Fish', 'Step into a world of rich, authentic flavour with our Efo Riro with Fish! 🌿🐟 This beloved Nigerian spinach stew is slow-cooked to perfection with tender fish, premium palm oil, and a vibrant blend of spices that sings with every bite. It is more than just a meal; it is a comforting embrace, a taste of tradition, and an experience your palate will thank you for. Perfect for a hearty dinner, it is ready to bring warmth and genuine West African taste to your table. Don it miss out on this soulful sensation!', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 75}, {\"size\": \"6L\", \"price\": 135}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(2, 1, 'Efo Riro with Assorted', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 75}, {\"size\": \"6L\", \"price\": 135}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(3, 1, 'Egusi Soup', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 85}, {\"size\": \"6L\", \"price\": 155}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(4, 1, 'Oha Soup', '', '[{\"size\": \"2L\", \"price\": 95}, {\"size\": \"3L\", \"price\": 140}, {\"size\": \"6L\", \"price\": 260}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(5, 1, 'Banga Soup', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 135}, {\"size\": \"6L\", \"price\": 250}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(6, 1, 'Ogbono Soup', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 135}, {\"size\": \"6L\", \"price\": 250}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(7, 1, 'Bitter Leaf Soup', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 135}, {\"size\": \"6L\", \"price\": 250}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(8, 1, 'Seafood Okro', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 100}, {\"size\": \"6L\", \"price\": 190}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(9, 1, 'Ofada/Avamase (Red)', '', '[{\"size\": \"2L\", \"price\": 80}, {\"size\": \"3L\", \"price\": 120}, {\"size\": \"6L\", \"price\": 240}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(10, 1, 'Ofada/Ayamase (Green)', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 100}, {\"size\": \"6L\", \"price\": 200}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(11, 1, 'Cow Leg Pepper Soup', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 95}, {\"size\": \"6L\", \"price\": 180}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(12, 1, 'Catfish Pepper Soup', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 95}, {\"size\": \"6L\", \"price\": 180}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(13, 1, 'Assorted Pepper Soup', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 90}, {\"size\": \"6L\", \"price\": 175}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(14, 1, 'Gbegiri (Bean Soup)', '', '[{\"size\": \"2L\", \"price\": 35}, {\"size\": \"3L\", \"price\": 60}, {\"size\": \"6L\", \"price\": 95}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(15, 1, 'Ewedu', '', '[{\"size\": \"2L\", \"price\": 35}, {\"size\": \"3L\", \"price\": 60}, {\"size\": \"6L\", \"price\": 95}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(16, 1, 'Chicken Stew', '', '[{\"size\": \"2L\", \"price\": 60}, {\"size\": \"3L\", \"price\": 85}, {\"size\": \"6L\", \"price\": 150}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(17, 1, 'Turkey Stew', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 95}, {\"size\": \"6L\", \"price\": 175}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(18, 1, 'Fish Stew', '', '[{\"size\": \"2L\", \"price\": 80}, {\"size\": \"3L\", \"price\": 120}, {\"size\": \"6L\", \"price\": 200}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(19, 1, 'Beef Stew', '', '[{\"size\": \"2L\", \"price\": 80}, {\"size\": \"3L\", \"price\": 120}, {\"size\": \"6L\", \"price\": 230}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(20, 1, 'Goat Meat Stew', '', '[{\"size\": \"2L\", \"price\": 90}, {\"size\": \"3L\", \"price\": 130}, {\"size\": \"6L\", \"price\": 240}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(21, 1, 'Assorted Stew', '', '[{\"size\": \"2L\", \"price\": 70}, {\"size\": \"3L\", \"price\": 110}, {\"size\": \"6L\", \"price\": 200}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(22, 2, 'Midi Meat Pie (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 35}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(23, 2, 'Puff Puff ', '', '[{\"size\": \"60 pieces\", \"price\": 30},{\"size\": \"120 pieces\", \"price\": 60},{\"size\": \"240 pieces\", \"price\": 120}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(24, 10, 'Puff Puff Delight', 'Piece  Soft and fluffy Nigerian-style doughnuts, served with a side of spicy pepper sauce.', '[{\"size\": \"10 pieces\", \"price\": 5}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(25, 10, 'Chin Chin Cravings', 'Crunchy sweet snack made from fried dough, perfect for munching anytime.', '[{\"size\": \"240 pieces\", \"price\": 120}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(26, 2, 'Sausage Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 35}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(27, 2, 'Chicken Pie (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 40}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(28, 2, 'Fish Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 25}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(29, 2, 'Chinchin (1KG)', '', '[{\"size\": \"1KG\", \"price\": 35}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(30, 2, 'Corn Straw', '', '[{\"size\": \"1 Pack\", \"price\": 30}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(31, 2, 'Coconut Chips', '', '[{\"size\": \"1 Pack\", \"price\": 30}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(32, 2, 'Scotch Eggs (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 60}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(33, 2, 'Samosa (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 15}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(34, 2, 'Spring Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 15}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(35, 2, 'Shrimp Rolls (12 Pieces)', '', '[{\"size\": \"12 pieces\", \"price\": 25}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(36, 2, 'Buns Small Tray (5 Dozens)', '', '[{\"size\": \"60 pieces\", \"price\": 50}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(37, 3, 'Beef Suya', '', '[{\"size\": \"Small\", \"price\": 55}, {\"size\": \"Medium\", \"price\": 100}, {\"size\": \"Large\", \"price\": 200}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(38, 3, 'Peppered Chicken', '', '[{\"size\": \"Small\", \"price\": 60}, {\"size\": \"Medium\", \"price\": 85}, {\"size\": \"Large\", \"price\": 120}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(39, 3, 'Peppered Turkey', '', '[{\"size\": \"Small\", \"price\": 75}, {\"size\": \"Medium\", \"price\": 125}, {\"size\": \"Large\", \"price\": 160}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(40, 3, 'Peppered Fish', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 130}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(41, 3, 'Peppered Beef', '', '[{\"size\": \"Small\", \"price\": 110}, {\"size\": \"Medium\", \"price\": 165}, {\"size\": \"Large\", \"price\": 230}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(42, 3, 'Goat Meat Asun', '', '[{\"size\": \"Small\", \"price\": 250}, {\"size\": \"Medium\", \"price\": 350}, {\"size\": \"Large\", \"price\": 500}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(43, 3, 'Gizzdodo', '', '[{\"size\": \"Small\", \"price\": 110}, {\"size\": \"Medium\", \"price\": 165}, {\"size\": \"Large\", \"price\": 230}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(44, 3, 'Gizzard Skewer', '', '[{\"size\": \"Small\", \"price\": 110}, {\"size\": \"Medium\", \"price\": 165}, {\"size\": \"Large\", \"price\": 230}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(45, 3, 'Fried Plantain', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 120}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(46, 4, 'Jollof Rice', '', '[{\"size\": \"Small\", \"price\": 40}, {\"size\": \"Medium\", \"price\": 60}, {\"size\": \"Large\", \"price\": 90}, {\"size\": \"Cooler\", \"price\": 190}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(47, 4, 'Asun Jollof', '', '[{\"size\": \"Small\", \"price\": 90}, {\"size\": \"Medium\", \"price\": 145}, {\"size\": \"Large\", \"price\": 250}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(48, 4, 'Fried Rice', '', '[{\"size\": \"Small\", \"price\": 50}, {\"size\": \"Medium\", \"price\": 75}, {\"size\": \"Large\", \"price\": 100}, {\"size\": \"Cooler\", \"price\": 250}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(49, 4, 'Coconut Rice', '', '[{\"size\": \"Small\", \"price\": 55}, {\"size\": \"Medium\", \"price\": 80}, {\"size\": \"Large\", \"price\": 110}, {\"size\": \"Cooler\", \"price\": 250}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(50, 4, 'Native Rice', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 120}, {\"size\": \"Cooler\", \"price\": 300}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(51, 4, 'Ofada Rice', '', '[{\"size\": \"Small\", \"price\": 65}, {\"size\": \"Medium\", \"price\": 90}, {\"size\": \"Large\", \"price\": 120}, {\"size\": \"Cooler\", \"price\": 300}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(52, 4, 'Porridge (Asaro)', '', '[{\"size\": \"Small\", \"price\": 90}, {\"size\": \"Medium\", \"price\": 140}, {\"size\": \"Large\", \"price\": 180}, {\"size\": \"Cooler\", \"price\": 360}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(53, 4, 'Moi Moi Elewe', '', '[{\"size\": \"6 Pieces\", \"price\": 30}, {\"size\": \"12 Pieces\", \"price\": 50}, {\"quantity\": \"24 Pieces\", \"price\": 100}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(54, 4, 'Amala', 'Experience the true heart of West African cuisine with our authentic Amala! This beloved staple, made from carefully processed yam flour, boasts a unique, slightly smoky flavor and a wonderfully smooth texture that is perfect for pairing with your favorite soups.\r\n\r\nWhether you are new to Nigerian delicacies or a longtime enthusiast, our Amala offers a delicious and satisfying foundation for any meal. It is easy to prepare and promises to bring the warmth and tradition of African cooking right to your table.\r\n\r\nReady to dive into a truly authentic culinary experience? Grab your pack of Amala today and get ready to enjoy a taste of home!', '[{\"size\":\"12 Pieces\",\"price\":50},{\"size\":\"1\",\"price\":1}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(55, 4, 'Pounded Yam', '', '[{\"size\": \"12 Pieces\", \"price\": 45}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(56, 4, 'Semo A Dozen', '', '[{\"size\": \"12 Pieces\", \"price\": 50}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(57, 4, 'Eba A Dozen', '', '[{\"size\": \"12 Pieces\", \"price\": 45}]', '2025-06-08 17:49:31', '2025-06-08 17:49:31'),
(58, 10, 'Bums', 'SWEET Nigerian-style doughnuts', '[{\"size\": \"10 Pieces\", \"price\": 10}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(59, 10, 'Meat Pies', 'Savory pastry filled with seasoned ground beef.', '[{\"size\": \"1 Piece\", \"price\": 3}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(60, 10, 'Samosa Sensation', 'Crispy pastry filled with seasoned ground beef or vegetables, served with tangy tamarind chutney.\r\n\r\n', '[{\"size\": \"1 Piece\", \"price\": 1.5}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(61, 10, 'Spring Rolls', 'Crispy pastry filled with vegetables or meat.\r\n', '[{\"size\": \"1 Piece\", \"price\": 1.5}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(62, 10, 'Scotch Eggs', 'Hard-boiled eggs wrapped in seasoned sausage meat and deep-fried', '[{\"size\": \"1 Piece\", \"price\": 5}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(63, 10, 'Fish Rolls', 'Flaky pastry filled with seasoned fish.', '[{\"size\": \"1 Piece\", \"price\": 3}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(64, 10, 'Fish Pies', 'Pastry filled with seasoned fish mixture', '[{\"size\": \"1 Piece\", \"price\": 5}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(65, 10, 'Sausage Rolls\r\n', 'Flaky pastry filled with seasoned sausage meat.', '[{\"size\": \"1 Pieces\", \"price\": 3}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(66, 11, 'Plantain', 'Ripe or unripe plantain slices fried to perfection, offering a sweet and savory addition to your meal.', '[{\"size\": \"1 serving\", \"price\": 3.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(67, 11, 'Moimoi Elewe', 'A traditional Nigerian steamed bean pudding, typically made with combination of beans, seasoned with spices, onions, and sometimes fish/com beef or eggs for added flavor and protein.', '[{\"size\": \"1 serving\", \"price\": 4.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(68, 11, 'Gizdodo', 'A delightful Nigerian dish made with a combination of gizzard (chicken or turkey). plantains, peppers, and onions, cooked to create a flavorful and spicy appetizer or side dish.', '[{\"size\": \"1 serving\", \"price\": 9.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(69, 11, 'Beef Offals/Assorted', 'A selection of various beef offal cuts such as tripe, liver, kidney, and heart, cooked to tender perfection and seasoned with spices for a rich and savory side dish option.', '[{\"size\": \"1 serving\", \"price\": 9.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(70, 11, 'Extra Turkey', 'Succulent pieces of turkey meat, fried or grilled to juicy perfection, providing an additional protein option to complement your meal.', '[{\"size\": \"1 serving\", \"price\": 3.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(71, 11, 'Extra Chicken', 'Tender and flavorful chicken pieces, either grilled or fried offering an extra serving of protein to satisfy your appetite.', '[{\"size\": \"1 Piece\", \"price\": 3.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(72, 11, 'Extra Fish', 'Fried fish slices, Seasoned and cooked to perfection, providing a delicious seafood option to enhance your dining experience.', '[{\"size\": \"1 Piece\", \"price\": 3.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(73, 11, 'Shrimp serving', 'A delectable serving of shrimp cooked to perfection and seasoned with complementary spices and herbs.', '[{\"size\": \"1 Piece\", \"price\": 1.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(74, 11, 'Extra Goatmeat', 'Tender and flavorful pieces of goat meat, stewed or grilled to perfection, offering a savory and hearty addition to your meal.', '[{\"size\": \"1 Piece\", \"price\": 4.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(75, 11, 'Sautéed Potatoes', 'Indulge in our mouthwatering sauteed potatoes, expertly cooked to a golden crispness and seasoned with our signature blend of herbs and spices.', '[{\"size\": \"1 serving\", \"price\": 4.50}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(76, 5, 'Jollof Rice Fiesta', 'Fragrant rice cooked in a rich tomato-based sauce, served with your choice of grilled chicken, beef stew, turkey, or fried fish', '[{\"size\": \"1 Plate\", \"price\": 16.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(77, 5, 'Fried Rice Fiesta', 'Fragrant rice cooked in Nigerian seasons and flavors, served with your choice of fried chicken, turkey, beef, or fried fish', '[{\"size\": \"1 Plate\", \"price\": 16.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(78, 5, 'Jollof Rice Trad', 'Fragrant rice cooked in a rich tomato-based sauce, served with your choice of goat meat', '[{\"size\": \"1 Plate\", \"price\": 22.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(79, 5, 'Fried Rice Trad', 'Fragrant rice cooked in Nigerian seasons and flavors, served with your choice of goat meat', '[{\"size\": \"1 Plate\", \"price\": 22.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(80, 5, 'Coconut Rice', 'Fragrant rice cooked with coconut milk and spices', '[{\"size\": \"1 Plate\", \"price\": 18.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(81, 5, 'Amala, Gbegiri, and Ewedu', 'Smooth and fluffy yam flour served with traditional green leafy soup and bean soup with your choice of assorted meat', '[{\"size\": \"1 Plate\", \"price\": 20.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(82, 5, 'Ofada Rice and Sauce', 'Rice cooked with Ofada stew, a spicy Nigerian sauce, with your choice of assorted meat', '[{\"size\": \"1 Plate\", \"price\": 25.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(83, 5, 'Native Rice/Palm-oil Rice with Orishirishi', 'Rice cooked with palm oil and assorted ingredients.', '[{\"size\": \"1 Plate\", \"price\": 25.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(84, 5, 'Yam Porridge and sauce with a serving of Fish', 'Yam cooked in a savory sauce served with fish', '[{\"size\": \"1 Plate\", \"price\": 25.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(85, 6, 'Egusi Soup Delight', 'Traditional Nigerian soup made with melon seeds, spinach, assorted meats or fish, served with pounded yam/eba or fufu', '[{\"size\": \"1 portion\", \"price\": 20.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(86, 6, 'Efo Riro (Vegetable Soup)', 'Nigerian spinach stew cooked with assorted meats or fish, served with pounded yam, eba or fufu', '[{\"size\": \"1 portion\", \"price\": 20.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(87, 6, 'Efo Riro (Vegetable Soup)', 'Nigerian spinach stew cooked with Goat meat or beef, served with pounded yam/eba or fufu', '[{\"size\": \"1 portion\", \"price\": 22.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(88, 6, 'Egusi Soup Delight', 'Traditional Nigerian soup made with melon seeds, spinach, and Goatmeat or beef, served with pounded yam/eba or fufu', '[{\"size\": \"1 portion\", \"price\": 22.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(89, 6, 'Okro Soup/Ila Alasepo', 'A traditional Nigerian dish made primarily from okra, a green vegetable known for its slimy texture when cooked. Ila alasepo is the Yoruba name for this dish, which translates to mixed okra. This dish typically includes a variety of ingredients such as meat, fish, or seafood, along with vegetables like onions, and peppers. It is often seasoned with traditional Nigerian spices and herbs, resulting in a flavorful and hearty soup, served with pounded yam/eba or fufu', '[{\"size\": \"1 portion\", \"price\": 20.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(90, 6, 'Pepper Soup Experience', 'Spicy broth simmered with your choice of beef, turkey, catfish, beef offals, or chicken, infused with aromatic spices', '[{\"size\": \"1 portion\", \"price\": 20.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(91, 6, 'Goat Pepper Soup Experience', 'Spicy broth simmered with goat meat, infused with aromatic spices', '[{\"size\": \"1 portion\", \"price\": 25.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(92, 7, 'White Rice, Beef & Sauce', 'Steamed white rice served with beef and sauce.', '[{\"size\": \"1 plate\", \"price\": 15.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(93, 7, 'Ewa Agoyin & Sauce', 'Mashed beans served with spicy sauce.', '[{\"size\": \"1 plate\", \"price\": 15.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(94, 7, 'Fried Yam, Fish & Sauce', 'Fried yam served with fish and sauce.', '[{\"size\": \"1 plate\", \"price\": 15.00}]', '2025-07-19 02:34:17', '2025-07-19 02:34:17'),
(95, 8, 'Beef Suya', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 25.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(96, 8, 'Chicken Suya', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 25.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(97, 8, 'Gizzard Suya', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 25.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(98, 8, 'Goat Meat Asun', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 30.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(99, 8, 'Beef Asun', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 25.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(100, 8, 'Grilled and spicy beef cubes', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 30.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(101, 8, 'Grilled and spicy goat meat cubes', 'Assorted skewered meats seasoned with spicy suya spice blend.', '[{\"size\": \"1 platter\", \"price\": 50.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(102, 9, 'Zoba Fusion', 'A refreshing hibiscus drink included with ginger, pine, and more flavors', '[{\"size\": \"standard\", \"price\": 4.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(103, 9, 'Chapman Cocktail', 'Our vibrant, sparkling, and utterly refreshing Nigerian classic! This delightful mix creates a sweet and tangy burst of flavor that is perfect for any occasion. It is sunshine in a glass, guaranteed to lift your spirits!', '[{\"size\": \"standard\", \"price\": 4.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(104, 9, 'Coke', 'Nothing beats the timeless taste of an ice-cold Coke. Its crisp, effervescent fizz and iconic sweet flavor provide that perfect, refreshing lift you crave.', '[{\"size\": \"standard\", \"price\": 1.50}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(105, 9, 'Pepsi', 'Reach for a Pepsi for that boldly refreshing, classic cola taste! Its lively fizz and balanced sweetness offer a satisfying burst of flavor that invigorates your senses.', '[{\"size\": \"standard\", \"price\": 1.50}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(106, 9, 'Fanta', 'Brighten your day with the fruity, zesty burst of Fanta! This delightfully bubbly orange soda delivers a sweet and tangy explosion of flavor that is both refreshing and fun.', '[{\"size\": \"standard\", \"price\": 1.50}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(107, 9, 'Vita Malt', 'Recharge and refresh with Vita Malt! This non-alcoholic malt drink is packed with wholesome goodness, offering a rich, smooth, and subtly sweet taste that nourishes and energizes.', '[{\"size\": \"standard\", \"price\": 2.50}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(108, 9, 'Amstel Malta', 'Savor the smooth, sophisticated refreshment of Amstel Malta. This premium non-alcoholic malt drink boasts a rich, slightly bitter-sweet flavor that is both invigorating and satisfying.', '[{\"size\": \"standard\", \"price\": 4.50}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(109, 9, 'Malta Guinness', 'Unleash the power of Malta Guinness! This iconic non-alcoholic malt drink is known for its distinctive rich, dark, and robust flavor. Packed with vitamins and a unique malty taste, it is a deeply satisfying and invigorating beverage.', '[{\"size\": \"standard\", \"price\": 4.50}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17'),
(110, 9, 'Vita Milk', 'Enjoy the wholesome goodness and creamy texture of Vita Milk. This delicious and nutritious beverage is a fantastic source of energy and essential nutrients, offering a smooth, refreshing taste.', '[{\"size\": \"standard\", \"price\": 5.00}]', '2025-07-19 04:34:17', '2025-07-19 04:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `meal_photos`
--

CREATE TABLE `meal_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_photos`
--

INSERT INTO `meal_photos` (`id`, `meal_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'meal_images/N88vk1CwVeFJx7BELDdaJ5EAfuBvm7kXdbtbkhWg.png', '2025-06-08 18:06:25', '2025-06-08 18:06:25'),
(2, 1, 'meal_images/vXLEpGC0Px3jDAqA6PMMZBDsl1xC3ZuYEQUt9No9.png', '2025-06-08 18:06:25', '2025-06-08 18:06:25'),
(3, 1, 'meal_images/A7Rv2F7zXCgPrym6SBcF1H2D3VtsgF0h78schivx.png', '2025-06-08 18:06:25', '2025-06-08 18:06:25'),
(4, 54, 'meal_images/VPcOy76ypGNPZtEQqazd6rkmO17IKeNtWvBehCKf.png', '2025-06-09 21:02:35', '2025-06-09 21:02:35'),
(5, 54, 'meal_images/zeFSn2wm2CMG0bhpPFPjyzKk3ZNsa39Yfu6ibEbE.png', '2025-06-09 21:02:35', '2025-06-09 21:02:35'),
(6, 54, 'meal_images/ua464VCHW1M6teyStuzRlG2y0JikFp0355XY7Asj.jpg', '2025-06-09 21:02:35', '2025-06-09 21:02:35'),
(7, 54, 'meal_images/ig1aqg1a5vpX93ti3C6apCvJTQg4Qx2hY30tLhzW.png', '2025-06-09 21:02:57', '2025-06-09 21:02:57'),
(8, 54, 'meal_images/LYmncvEwhWTkVC4011MO1DSVrmnFOT0OAcHwKGXp.png', '2025-06-09 21:02:57', '2025-06-09 21:02:57'),
(9, 54, 'meal_images/1rt4dLf37VFY0wz4CQ0WRbhP1y7m6wAztcSr2Fnc.jpg', '2025-06-09 21:02:57', '2025-06-09 21:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_26_222252_add_two_factor_columns_to_users_table', 1),
(5, '2025_04_26_222316_create_personal_access_tokens_table', 1),
(6, '2025_04_26_222319_create_teams_table', 1),
(7, '2025_04_26_222320_create_team_user_table', 1),
(8, '2025_04_26_222321_create_team_invitations_table', 1),
(9, '2025_04_28_200249_create_meals_table', 1),
(10, '2025_05_14_180158_create_orders_table', 1),
(11, '2025_05_21_184756_add_role_to_users_table', 2),
(12, '2025_06_03_032133_create_meal_photos_table', 3),
(13, '2025_05_28_162930_add_two_factor_columns_to_users_table', 4),
(14, '2025_07_19_223514_create_reservations_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`menu`)),
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `user_id`, `menu`, `address`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(4, 'cs_test_b1uNYPN3w9CZ65FQNVPjYxkmtxtKmkutlwDBCpgfoqSZyV5SBF1oi3giVM', NULL, '[{\"name\":\"Efo Riro with Assorted\",\"unit_price\":60,\"quantity\":1},{\"name\":\"Eba A Dozen\",\"unit_price\":45,\"quantity\":2},{\"name\":\"Banga Soup\",\"unit_price\":135,\"quantity\":1}]', NULL, 285.00, 'unpaid', '2025-05-21 17:01:24', '2025-05-21 17:01:24'),
(5, 'cs_test_b1U6DPbK6Bz4pzp0k0Z5vYLdLlgx7RGLxKSF7VF0EVVQEhOE5GVNTMboTz', NULL, '[{\"name\":\"Efo Riro with Assorted\",\"unit_price\":60,\"quantity\":1},{\"name\":\"Eba A Dozen\",\"unit_price\":45,\"quantity\":2},{\"name\":\"Banga Soup\",\"unit_price\":135,\"quantity\":1}]', NULL, 285.00, 'unpaid', '2025-05-21 17:01:25', '2025-05-21 17:01:25'),
(6, 'cs_test_b1L9cNGQpWjhjiDoHqp086CHI0HQqLERNv0X7MeJiJecs5zhffjukhMHaM', NULL, '[{\"name\":\"Efo Riro with Assorted\",\"unit_price\":60,\"quantity\":1},{\"name\":\"Eba A Dozen\",\"unit_price\":45,\"quantity\":2},{\"name\":\"Banga Soup\",\"unit_price\":135,\"quantity\":1}]', NULL, 285.00, 'unpaid', '2025-05-21 17:01:27', '2025-05-21 17:01:27'),
(7, 'cs_test_b1AbwQRFYc1HZkhlYrfQAxaFv5c3fYeHCEqMki0DWIAZmmVKgIXvyWtIFH', NULL, '[{\"name\":\"Efo Riro with Assorted\",\"unit_price\":60,\"quantity\":1},{\"name\":\"Eba A Dozen\",\"unit_price\":45,\"quantity\":2}]', NULL, 150.00, 'unpaid', '2025-05-21 19:35:27', '2025-05-21 19:35:27'),
(8, 'cs_test_b19SFzmNchRtaNNIP672fy0G1yt199n72NJiXbAEQ4F32cBKbkT04XeQaW', 3, '[{\"name\":\"Banga Soup\",\"unit_price\":90,\"quantity\":1},{\"name\":\"Eba A Dozen\",\"unit_price\":45,\"quantity\":1}]', '\"{\\\"city\\\":\\\"Barrie, Ontario, Canada\\\",\\\"country\\\":\\\"CA\\\",\\\"line1\\\":\\\"100 little Avenue, Barrie\\\",\\\"line2\\\":\\\"101 Apmt\\\",\\\"postal_code\\\":\\\"L0G 1W0\\\",\\\"state\\\":\\\"ON\\\"}\"', 135.00, 'paid', '2025-05-21 20:34:46', '2025-05-21 20:56:34'),
(9, 'cs_test_b16kYpc2bx223mXBgKAKlitExODwxeHyZNwuIrDrSs3Nv0mTUjZCteLVUC', NULL, '[{\"name\":\"Native Rice\",\"unit_price\":90,\"quantity\":1},{\"name\":\"Amala\",\"unit_price\":50,\"quantity\":1},{\"name\":\"Vita Milk\",\"unit_price\":5,\"quantity\":4}]', NULL, 160.00, 'unpaid', '2025-07-20 01:25:03', '2025-07-20 01:25:03'),
(10, 'cs_test_b1QNsqeTU6vkktjeXg6eRd251fgCt36FvylgHUZuPLJOmrcSnBRMd043ru', NULL, '[{\"name\":\"Native Rice\",\"unit_price\":90,\"quantity\":1},{\"name\":\"Amala\",\"unit_price\":50,\"quantity\":1},{\"name\":\"Vita Milk\",\"unit_price\":5,\"quantity\":4}]', NULL, 160.00, 'unpaid', '2025-07-20 01:25:04', '2025-07-20 01:25:04'),
(11, 'cs_test_b1YctSrJ9LvvehwZ8p98xomkclnweC2yBdSJRINxP2k0CQSyJg9VUtFpBe', NULL, '[{\"name\":\"Native Rice\",\"unit_price\":90,\"quantity\":1},{\"name\":\"Amala\",\"unit_price\":50,\"quantity\":1},{\"name\":\"Vita Milk\",\"unit_price\":5,\"quantity\":4}]', NULL, 160.00, 'unpaid', '2025-07-20 01:25:25', '2025-07-20 01:25:25'),
(12, 'cs_test_b1BvyG7PYlrLUPi2IT0ms7kwGKzqbWIECBEt9pWjHez2wGznFTscA7oDpb', NULL, '[{\"name\":\"Native Rice\",\"unit_price\":90,\"quantity\":1},{\"name\":\"Amala\",\"unit_price\":50,\"quantity\":1},{\"name\":\"Vita Milk\",\"unit_price\":5,\"quantity\":4}]', NULL, 160.00, 'unpaid', '2025-07-21 20:07:10', '2025-07-21 20:07:10'),
(13, 'cs_test_b1ny6s3vwo4npnas6McjYhqm41Ou0vvSOsH6MRfld1YmIPw4KDfCepTQ9E', 3, '[{\"name\":\"Native Rice\",\"unit_price\":90,\"quantity\":1},{\"name\":\"Amala\",\"unit_price\":50,\"quantity\":1},{\"name\":\"Vita Milk\",\"unit_price\":5,\"quantity\":4}]', '\"{\\\"city\\\":\\\"Barrie, Ontario, Canada\\\",\\\"country\\\":\\\"CA\\\",\\\"line1\\\":\\\"100 little Avenue, Barrie\\\",\\\"line2\\\":\\\"101 Apmt\\\",\\\"postal_code\\\":\\\"L0G 1W0\\\",\\\"state\\\":\\\"ON\\\"}\"', 160.00, 'paid', '2025-07-21 20:07:16', '2025-07-21 20:07:42'),
(14, 'cs_test_a1ocLnNpXCdPtofvNcjxtCzvhE7n9Rp24Vub6xSUB6fGWO0HTOmaMNmuNp', 4, '[{\"name\":\"Native Rice\",\"unit_price\":90,\"quantity\":1}]', '\"{\\\"city\\\":\\\"Barrie, Ontario, Canada\\\",\\\"country\\\":\\\"CA\\\",\\\"line1\\\":\\\"100 little Avenue, Barrie\\\",\\\"line2\\\":\\\"101 Apmt\\\",\\\"postal_code\\\":\\\"L0G 1W0\\\",\\\"state\\\":\\\"ON\\\"}\"', 90.00, 'paid', '2025-07-21 20:09:53', '2025-07-21 20:11:02'),
(15, 'cs_test_a19VePBI4o3qELTOByC1BJfbOfvvxdWf8O53RSdcLxAWwxd4MQFGH2mnNs', 5, '[{\"name\":\"Pounded Yam\",\"unit_price\":45,\"quantity\":1}]', '\"{\\\"city\\\":\\\"Barrie, Ontario, Canada\\\",\\\"country\\\":\\\"CA\\\",\\\"line1\\\":\\\"100 little Avenue, Barrie\\\",\\\"line2\\\":\\\"101 Apmt\\\",\\\"postal_code\\\":\\\"L0G 1W0\\\",\\\"state\\\":\\\"ON\\\"}\"', 45.00, 'paid', '2025-07-21 20:44:09', '2025-07-21 20:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `guests` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `date`, `time`, `guests`, `special_requests`, `created_at`, `updated_at`) VALUES
(2, 'Dolores quia hic est', 'kanoka@mailinator.com', '+1 (151) 463-6056', '2025-07-24', '09:30:00', 8, 'Nam rerum soluta tem', '2025-07-21 20:52:01', '2025-07-21 20:52:01'),
(3, 'Nihil aliquip nihil', 'gituzud@mailinator.com', '+1 (315) 549-2905', '2025-07-24', '09:00:00', 9, 'Rerum et voluptatibu', '2025-07-21 20:54:37', '2025-07-21 20:54:37'),
(4, 'Adeyemi John', 'adeyemijohn@mailinator.com', '+1 (189) 595-8279', '2025-07-23', '12:00:00', 8, 'Birthday', '2025-07-21 20:55:10', '2025-07-26 00:19:20'),
(5, 'Anim quisquam ad ass', 'jaco@mailinator.com', '+1 (374) 673-7059', '2025-07-22', '12:00:00', 2, 'm', '2025-07-21 21:36:09', '2025-07-21 21:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6LThW5JPM6SqjFIihHau5biw4yhUZxiCiqbDlIaI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFJQZ1lxZFQ2b3plY0hlbEJHOEk3QjA2blRaeFo5OEE1OWFkQ240RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlcmluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753539503),
('SFdq0ogfimBDMAl5NpyomqaAtFgzmOlxJJX3qra6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEpORnl0ZVIyVHYzRU1BUlB5ZGptSWFSdlJwU0FrWjdCR3A2YlNsZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlcmluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753540387);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test User is Team', 1, '2025-05-19 21:50:00', '2025-05-19 21:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Test User', 'test@example.com', '2025-05-19 21:49:59', '$2y$12$6K6yW3j9QamKp66eb8Q5c.9bywIL/yZFp0COmHv9pmlYPPvfqVh0i', NULL, NULL, NULL, 'bSooNosY5A', NULL, NULL, '2025-05-19 21:50:00', '2025-05-19 21:50:00', 'user'),
(3, 'Sophia Pierce', 'ricy@mailinator.com', NULL, '$2y$12$j5Kv2CBxRKEU4CAlqRJmNe8F.w5nn1xMljR7OZQ/HC1ZLBJn6VgtK', NULL, NULL, NULL, 'TJi4lR9TEh8c5L4SH8FQQdb8vncT8YBpkbva35AXkbE40D2q8Q21giyqsc5e', NULL, NULL, '2025-05-21 20:56:23', '2025-05-21 22:52:21', 'admin'),
(4, 'Another User', 'usinganotheremail@mailinator.com', NULL, '$2y$12$B9x7hSKwphSvOLAOkWayJ./lLI.yGJ6emxVZF0N7oPVr4qCLLpob2', NULL, NULL, NULL, 'LBlFA6De72LZ4qqTgflIPU1gpUqHUiDLvlpaZTLRS9cpSiCd2zEEMUe3HWBI', NULL, NULL, '2025-07-21 20:10:49', '2025-07-21 20:39:04', 'user'),
(5, 'test User', 'anotheremail@mailinator.com', NULL, '$2y$12$45.XaNxdWEReMtLhAyF/v.oCh7fbbVVWzzqJUH0EYA/5pikpd06JC', NULL, NULL, NULL, 'w3oVi4imaDdq4k63vF2yosyTuV4Q9sdkyT1HzW9LMpK8KjSVZIGJbpyrJRJs', NULL, NULL, '2025-07-21 20:45:52', '2025-07-21 20:48:20', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_category_id_foreign` (`category_id`);

--
-- Indexes for table `meal_photos`
--
ALTER TABLE `meal_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_photos_meal_id_foreign` (`meal_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_session_id_unique` (`session_id`),
  ADD KEY `user_oder` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `meal_photos`
--
ALTER TABLE `meal_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `meal_photos`
--
ALTER TABLE `meal_photos`
  ADD CONSTRAINT `meal_photos_meal_id_foreign` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_oder` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
