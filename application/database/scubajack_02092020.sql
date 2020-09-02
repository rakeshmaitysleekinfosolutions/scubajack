-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 12:10 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scubajack`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `answer` varchar(150) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = YES, 0 = NO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `is_correct`, `created_at`, `updated_at`, `is_deleted`) VALUES
(22, 12, 'Abc', 1, '2020-08-31 08:26:10', '2020-08-31 08:43:32', '0'),
(23, 12, 'xyz', 0, '2020-08-31 08:26:10', '2020-08-31 09:52:59', '0'),
(24, 12, 'def', 0, '2020-08-31 08:26:10', '2020-08-31 13:51:13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'CREATURES BIG AND SMALL1', 'creatures-big-and-small', 1, '2020-08-21 12:41:10', '2020-08-28 07:53:26', '0'),
(2, 'test', 'tests', 0, '2020-08-24 14:13:47', '2020-08-25 11:07:02', '1'),
(3, 'ABC', 'abc', 1, '2020-08-25 09:31:21', '2020-08-25 09:55:47', '1'),
(4, 'STORY BOOKS', 'story-books', 1, '2020-08-25 11:03:02', '2020-08-25 11:06:30', '0'),
(5, 'LEARN TO READ', 'learn-to-read', 1, '2020-08-25 11:07:19', '2020-08-28 07:53:28', '0'),
(6, 'ELEMENTARY SCHOOL READING', 'elementary-school-reading', 1, '2020-08-25 11:07:46', '2020-08-28 07:53:29', '0'),
(7, 'LEARNING MODULES', 'learning-modules', 1, '2020-08-25 11:08:09', '2020-08-28 07:53:30', '0'),
(8, 'PARENTING BOOKS', 'parenting-books', 1, '2020-08-25 11:08:19', '2020-08-28 07:53:35', '0'),
(9, 'PEOPLE', 'people', 1, '2020-08-25 11:08:39', '2020-08-28 07:53:37', '0'),
(10, 'ARTS', 'arts', 1, '2020-08-25 11:08:48', '2020-08-28 07:53:38', '0'),
(11, 'PLACES', 'places', 1, '2020-08-25 11:08:59', '2020-08-28 07:53:39', '0'),
(12, 'CRYPTICS', 'cryptics', 1, '2020-08-25 11:09:08', '2020-08-28 07:53:41', '0'),
(13, 'SHAPES', 'shapes', 0, '2020-08-25 11:09:18', NULL, '0'),
(14, 'COLORS', 'colors', 0, '2020-08-25 11:09:26', NULL, '0'),
(15, 'NUMBERS', 'numbers', 0, '2020-08-25 11:09:35', NULL, '0'),
(16, 'SPANISH', 'spanish', 0, '2020-08-25 11:09:45', NULL, '0'),
(17, 'Test', 'test', 0, '2020-08-26 10:47:38', '2020-08-26 10:47:58', '1'),
(18, 'Test', 'ttsts', 0, '2020-08-26 11:36:40', '2020-08-26 11:37:18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category_description`
--

CREATE TABLE `category_description` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_description`
--

INSERT INTO `category_description` (`id`, `category_id`, `image`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `is_deleted`) VALUES
(31, 1, 'catalog/[adventuresofscubajack.com][199]Books-Home-page-1-400.jpg', '<p>CREATURES BIG AND SMALL1</p>', 'CREATURES BIG AND SMALL1', 'CREATURES BIG AND SMALL1', 'CREATURES BIG AND SMALL1', '0'),
(4, 2, 'catalog/crop.jpg', '', 'sfafsaf', '', '', '1'),
(5, 0, 'catalog/Is-Anybody-Out-There-Cover-160x200.jpg', '<p><div id=\"info\" class=\"style-scope ytd-video-primary-info-renderer\" style=\"margin: 0px; padding: 0px; border: 0px; background: rgb(249, 249, 249); display: flex; flex-direction: row; align-items: center; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; font-size: 10px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"></div></p><h1 class=\"title style-scope ytd-video-primary-info-renderer\" style=\"margin: 0px; padding: 0px; border: 0px; background: rgb(249, 249, 249); display: block; max-height: calc(2 * var(--yt-navbar-title-line-height, 2.4rem)); overflow: hidden; font-weight: 400; line-height: var(--yt-navbar-title-line-height, 2.4rem); color: var(--ytd-video-primary-info-renderer-title-color, var(--yt-spec-text-primary)); font-family: Roboto, Arial, sans-serif; font-size: var(--ytd-video-primary-info-renderer-title-font-size, var(--yt-navbar-title-font-size, inherit)); font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: ; font-variant-east-asian: ; transform: var(--ytd-video-primary-info-renderer-title-transform, none); text-shadow: var(--ytd-video-primary-info-renderer-title-text-shadow, none); font-style: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><yt-formatted-string force-default-style=\"\" class=\"style-scope ytd-video-primary-info-renderer\" style=\"word-break: break-word;\">Seven Silly Shark</yt-formatted-string></h1>', 'Seven Silly Shark', 'Seven Silly Shark\r\n', 'Seven Silly Shark\r\n', '0'),
(7, 3, 'catalog/The-Brave-little-crab-book-cover-160x200.jpg', '', 'ABC', '', '', '0'),
(33, 5, 'catalog/[adventuresofscubajack.com][191]people-2.jpg', '', 'LEARN TO READ', '', '', '0'),
(34, 6, 'catalog/[adventuresofscubajack.com][386]activity.jpg', '', 'ELEMENTARY SCHOOL READING', '', '', '0'),
(35, 7, 'catalog/[adventuresofscubajack.com][250]element.jpg', '', 'LEARNING MODULES', '', '', '0'),
(37, 8, 'catalog/[adventuresofscubajack.com][191]people-2.jpg', '', 'PARENTING BOOKS', '', '', '0'),
(38, 9, 'catalog/[adventuresofscubajack.com][191]people-2.jpg', '', 'PEOPLE', '', '', '0'),
(39, 10, 'catalog/[adventuresofscubajack.com][191]people-2.jpg', '', 'ARTS', '', '', '0'),
(40, 11, 'catalog/[adventuresofscubajack.com][196]learn-3.jpg', '', 'PLACES', '', '', '0'),
(21, 13, '', '', 'SHAPES', '', '', '0'),
(22, 14, '', '', 'COLORS', '', '', '0'),
(23, 15, '', '', 'NUMBERS', '', '', '0'),
(24, 16, '', '', 'SPANISH', '', '', '0'),
(26, 17, '', '', 'Test', '', '', '1'),
(27, 18, '', '', 'tests', '', '', '1'),
(32, 4, 'catalog/[adventuresofscubajack.com][250]element.jpg', '<h2 class=\"vc_custom_heading vc_custom_1576680391456\" style=\"text-size-adjust: none; outline: none; margin-right: 0px; margin-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border: 0px; vertical-align: baseline; clear: both; overflow-wrap: break-word; font-size: 18px; line-height: 32px; font-family: Roboto; letter-spacing: -1px; color: rgb(10, 0, 0); font-variant-ligatures: none; text-align: center; padding-top: 0px !important;\">Our Story Books are fun, engaging and kid tested in our classrooms! These beautifully illustrated stories are guaranteed to become a childhood favorite.</h2>', 'STORY BOOKS', '', '', '0'),
(41, 12, 'catalog/[adventuresofscubajack.com][386]activity.jpg', '', 'CRYPTICS', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `category_to_products`
--

CREATE TABLE `category_to_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_to_products`
--

INSERT INTO `category_to_products` (`id`, `category_id`, `product_id`, `is_deleted`) VALUES
(2, 1, 2, '0'),
(4, 1, 4, '1'),
(9, 5, 5, '0'),
(13, 4, 1, '0'),
(14, 1, 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `features_products`
--

CREATE TABLE `features_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features_products`
--

INSERT INTO `features_products` (`id`, `product_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(22, 4, '2020-08-26 11:08:15', '2020-08-26 11:10:22', '1'),
(27, 1, '2020-09-02 06:21:28', NULL, '0'),
(28, 2, '2020-09-02 06:21:28', NULL, '0'),
(29, 3, '2020-09-02 06:21:28', NULL, '0'),
(30, 5, '2020-09-02 06:21:28', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float(18,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '1 Simultaneous Stream', '1 Simultaneous Stream', 499.00, '2020-09-01 05:53:00', '2020-09-01 05:59:18', '0'),
(2, '2 Simultaneous Stream', '2 Simultaneous Stream', 500.00, '2020-09-01 06:01:37', '2020-09-01 06:01:37', '0'),
(3, 'Test', 'Test', 1000.00, '2020-09-01 06:03:45', '2020-09-01 09:33:52', '1');

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans_subscribers`
--

CREATE TABLE `membership_plans_subscribers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `membership_plan_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `plan` varchar(150) NOT NULL,
  `price` float(18,2) UNSIGNED NOT NULL,
  `beg_date` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership_plans_subscribers`
--

INSERT INTO `membership_plans_subscribers` (`id`, `user_id`, `membership_plan_id`, `type`, `plan`, `price`, `beg_date`, `end_at`, `created_at`, `is_deleted`) VALUES
(1, 1, 1, 'YEARLY', '1 Simultaneous Stream', 499.00, NULL, NULL, '2020-09-01 09:49:39', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `quiz_id` int(11) UNSIGNED DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 = Learn To READ,\r\n1 = Quizzes & Videos',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quiz_id`, `slug`, `type`, `created_at`, `status`, `updated_at`, `is_deleted`) VALUES
(1, 'The Brave Little Crab', 5, 'the-brave-little-crab', 0, '2020-09-02 06:03:28', 1, '2020-09-02 06:03:28', '0'),
(2, 'Dolphins', 5, 'dolphins', 0, '2020-09-02 05:37:32', 1, '2020-09-02 05:37:32', '0'),
(3, 'Great White Sharks', 5, 'great-white-sharks', 0, '2020-09-02 06:11:05', 1, '2020-09-02 06:11:05', '0'),
(4, 'Whale Sharks', 0, 'whale-sharks', 1, '2020-08-26 11:36:18', 1, '2020-08-26 11:36:18', '1'),
(5, 'afasgas', 0, 'afasgas', 0, '2020-08-27 07:50:25', 1, '2020-08-27 07:50:25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `products_description`
--

CREATE TABLE `products_description` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL COMMENT 'Model ID that have a image',
  `image` varchar(150) NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `is_deleted`) VALUES
(2, 2, 'catalog/Cover-300x388.jpg', '0'),
(4, 4, 'catalog/Cover-medium-300x388.jpg', '1'),
(9, 5, 'catalog/7sillysharks-160x200.jpg', '0'),
(13, 1, 'catalog/7sillysharks-160x200.jpg', '0'),
(14, 3, 'catalog/Cover-1-300x388.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `products_pdf`
--

CREATE TABLE `products_pdf` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_videos`
--

CREATE TABLE `products_videos` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_videos`
--

INSERT INTO `products_videos` (`id`, `url`, `thumb`, `product_id`, `is_deleted`) VALUES
(23, 'https://www.youtube.com/watch?v=xSDvtXRECmI', '', 2, '0'),
(27, 'https://www.youtube.com/watch?v=HKVIN6alX1w', '', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `quiz_id` int(11) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= false, 1 = true',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`, `image`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(12, 4, 'How many sharks you see in the picture below?', 'catalog/1.jpg', 1, '2020-08-31 03:06:21', '2020-08-31 09:51:31', '0'),
(13, 5, 'With some minor exceptions, all eight bear species have roughly the same appearance? ', 'catalog/2.jpg', 1, '2020-08-31 04:05:59', '2020-08-31 04:19:15', '0'),
(14, 5, 'Test', '', 1, '2020-08-31 04:22:15', '2020-08-31 07:52:51', '1');

-- --------------------------------------------------------

--
-- Table structure for table `questions_images`
--

CREATE TABLE `questions_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(4, 'Whale Sharks Quiz', 'whale-sharks-quiz', 1, '2020-08-27 08:06:44', '2020-08-27 08:13:32', '0'),
(5, 'Bears Quiz', 'bears-quiz', 1, '2020-08-31 04:04:55', '2020-08-31 04:04:55', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_description`
--
ALTER TABLE `category_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_to_products`
--
ALTER TABLE `category_to_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `features_products`
--
ALTER TABLE `features_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_plans_subscribers`
--
ALTER TABLE `membership_plans_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`membership_plan_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_description`
--
ALTER TABLE `products_description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imageable_id` (`product_id`);

--
-- Indexes for table `products_pdf`
--
ALTER TABLE `products_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products_videos`
--
ALTER TABLE `products_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`product_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `questions_images`
--
ALTER TABLE `questions_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_description`
--
ALTER TABLE `category_description`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category_to_products`
--
ALTER TABLE `category_to_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `features_products`
--
ALTER TABLE `features_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership_plans_subscribers`
--
ALTER TABLE `membership_plans_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_description`
--
ALTER TABLE `products_description`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products_pdf`
--
ALTER TABLE `products_pdf`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products_videos`
--
ALTER TABLE `products_videos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `questions_images`
--
ALTER TABLE `questions_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_to_products`
--
ALTER TABLE `category_to_products`
  ADD CONSTRAINT `category_to_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `products_description`
--
ALTER TABLE `products_description`
  ADD CONSTRAINT `products_description_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products_pdf`
--
ALTER TABLE `products_pdf`
  ADD CONSTRAINT `products_pdf_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products_videos`
--
ALTER TABLE `products_videos`
  ADD CONSTRAINT `products_videos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `questions_images`
--
ALTER TABLE `questions_images`
  ADD CONSTRAINT `questions_images_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
