-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2023 at 11:09 PM
-- Server version: 5.7.42
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `missions_monitum`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `city`, `state`, `postal_code`, `country`, `user_id`) VALUES
(2, '123 Main St', 'Exampleville', 'Examplestate', '12345', 'Exampleland', 4),
(3, '123 Main St', 'Exampleville', 'Examplestate', '12345', 'Exampleland', 5),
(4, 'w', 'w', 'w', 'w', 'w', 6),
(5, 'k', 'k', 'k', 'k', 'k', 7),
(6, 'k', 'k', 'k', 'k', 'k', 8),
(7, '1 Dallimore Street', 'Ado', 'Ekiti', '360001', 'Nigeria', 9),
(8, 'Dallimore', 'Ado', 'Ekiti', '360001', 'NG', 10),
(9, 'Dall', 'Ado', 'Ekiti', '360001', 'NG', 11),
(10, 'Iyana', 'Ado', 'Ekiti', '360001', 'NG', 12),
(11, 'Basiri', 'Ado-Ekiti', 'Ekiti`', '360101', 'Nigeria', 13),
(14, 't', 't', 't', 't', 't', 16),
(15, 'i', 'i', 'i', 'i', 'i', 17);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_on`, `updated_on`) VALUES
(4, 'Business', 4, '2023-05-31 11:54:01', '2023-05-31 11:54:01'),
(5, 'Business', 4, '2023-05-31 11:55:08', '2023-05-31 11:55:08'),
(6, 'Business', 4, '2023-05-31 11:55:49', '2023-05-31 11:55:49'),
(23, 's', 4, '2023-06-03 02:28:08', '2023-06-03 02:28:08'),
(24, 'e', 4, '2023-06-03 03:25:26', '2023-06-03 03:25:26'),
(25, 'd', 4, '2023-06-03 03:26:35', '2023-06-03 03:26:35'),
(26, 'a', 4, '2023-06-03 03:27:14', '2023-06-03 03:27:14'),
(27, 'a', 4, '2023-06-03 03:27:59', '2023-06-03 03:27:59'),
(28, 'q', 4, '2023-06-03 03:28:36', '2023-06-03 03:28:36'),
(29, 'd', 4, '2023-06-03 03:30:25', '2023-06-03 03:30:25'),
(30, 'o', 4, '2023-06-03 03:43:11', '2023-06-03 03:43:11'),
(31, 'g', 4, '2023-06-03 03:43:44', '2023-06-03 03:43:44'),
(32, 'w', 4, '2023-06-03 03:44:17', '2023-06-03 03:44:17'),
(33, 'd', 4, '2023-06-15 23:34:18', '2023-06-15 23:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `organisation`, `department`, `phone`, `logo`, `user_id`, `created_on`, `updated_on`) VALUES
(4, '1', '$2y$12$lMynHwSk2VUj6HiUt81C3OtyxbBUEFEm8Wczkauc6k/Cq5XBPOd6C', 'Finance', 'Ade', 'Ade', 'Finance', 'Finance', 'Finance', NULL, NULL, '2023-05-31 11:41:34', '2023-05-31 11:41:34'),
(5, '2', '$2y$12$TQnwSZeTMGCu3f8xaNImNuR44J9yHAqfWIcGSnzHKK6waGIG18rW6', 'bis', 'Ade4', 'Ade5', 'Finance', 'Finance', 'Finance4', NULL, NULL, '2023-05-31 11:59:14', '2023-05-31 11:59:14'),
(6, 'w', '$2y$12$rNvEX1lzc10yA8QzxB2nTeDCBsQBDwjuhDBYasRkI/bQYV5F9Hglu', 'kkk@f.n', 'w', 'w', NULL, 'we', '111', NULL, NULL, '2023-06-02 12:58:57', '2023-06-02 12:58:57'),
(7, 'w2222', '$2y$12$ONdvkmDliG5kT29xf/t73.tDIyMq8vAY8swBic4SRfVvCEh/VxuYW', 'kolade@k.com', 'k', 'k', NULL, 'k', '12311', NULL, NULL, '2023-06-03 02:45:52', '2023-06-03 02:45:52'),
(8, 'w22222', '$2y$12$sdtce1UKdjuVztYb3YpT1OlQDbX.LM6.Xm.QvbN9Ei4C7UqdVIJDm', 'k@kola.com', 'k', 'k', NULL, 'k', '1231111', NULL, NULL, '2023-06-03 02:47:01', '2023-06-03 02:47:01'),
(9, 'hobadafidi', '$2y$12$dAndOM39/tkhPf3aOeJlROM675ZNd/9WnAlb9Av3yeZF4FzHxa9Hy', 'hoba.dafidi@gmail.com', 'David', 'Adeniyi', NULL, 'Hello', '07033072112', NULL, NULL, '2023-06-03 20:30:43', '2023-06-03 20:30:43'),
(10, 'hoba.dafidi', '$2y$12$3srRhcxTC89wQrcYMgNbdO/Ven7/6QiM.8tjswKWKYq.9RKZqX9Kq', 'monitum@gmail.com', 'David', 'King', NULL, 'Hello', '07033072113', NULL, NULL, '2023-06-03 20:48:02', '2023-06-03 20:48:02'),
(11, 'monitum', '$2y$12$rThg8CsqrEZoMvSTWCAGzusY34gsODKoFDRF2l2s8fpKKh30RrmXi', 'hoba@gmail.com', 'David', 'King', NULL, 'Hello', '07033072114', NULL, NULL, '2023-06-03 20:52:12', '2023-06-03 20:52:12'),
(12, 'hobadafidi1', '$2y$12$djFjCy.IXno93tbpBc1d5OXirNk1kWkD0vXLwlUJUcO0ankuz8oUW', 'monitum1@gmail.com', 'David', 'King', NULL, 'Tree', '07033072115', NULL, NULL, '2023-06-05 11:12:23', '2023-06-05 11:12:23'),
(13, 'akeembaba', '$2y$12$apuYV3KqYt3hDeMR8HhVZO2q7Yj/BG2oqm/OCc8W7naAAoRz2EbxW', 'akchristlife@gmail.com', 'Akeem', 'Osasona', NULL, 'Application', '08130570898', NULL, NULL, '2023-06-07 12:43:45', '2023-06-07 12:43:45'),
(16, 'ty', '$2y$12$zA8eqt8w6Yt5BMMcid/L2u3cy3UOtSxrmfywV9pf82tvwvq.gnuFm', 'ty@g.co', 'ty', 'ty', NULL, 't', '08039308400', NULL, NULL, '2023-06-13 12:34:05', '2023-06-13 12:34:05'),
(17, 'KoladeOLuwa', '$2y$12$1I95a947sn7Pj6hGUiQAFOQyFyhOoGnC02DqAOaqpuCI7DLhUT4nO', 'accolade@k.com', 'k', 'k', NULL, 'k', '999999', NULL, NULL, '2023-06-15 23:23:25', '2023-06-15 23:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `receive` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `create_client` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_client` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_client` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_client` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_user` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_user` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_user` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_user` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_subscription` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_subscription` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_subscription` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_subscription` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manage_settings` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sent_forms`
--

CREATE TABLE `sent_forms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_user_id` int(11) NOT NULL,
  `smtp_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `subscription_id` int(11) NOT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_ref` int(100) NOT NULL,
  `created` date NOT NULL,
  `expires` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `plan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `position`, `department`, `address`, `phone`, `facebook`, `linkedin`, `twitter`, `user_id`, `user_type_id`, `created_on`, `updated_on`) VALUES
(1, '1', '$2y$12$U03v4d6EtVyaGIwNMqSsY.QMYIWKaO4inPFRz7uarotr3aoLjx3J.', 'Finance', 'Ade', 'Ade', 'Finance', 'Finance', 'Finance', 'Finance', 'Ade', 'Ade', 'Ade', 2, NULL, '2023-05-31 17:39:49', '2023-05-31 17:39:49'),
(2, 'k', '$2y$12$GZMqK15bAbzyAtyq5JHo9OYEW3YN.dPxx33my6jotsx1l5tDiQQnm', 'Finance22', 'Ade', 'Ade', 'Finance', 'Finance', 'Finance', 'Finance3', 'Ade', 'Ade', 'Ade', 2, NULL, '2023-05-31 17:43:09', '2023-05-31 17:43:09'),
(3, '4', '$2y$12$vgYSXXJSwtHHKI6y44j/MeRTANoSASv9F/MUEoabszIdcw2sg/tDC', 'Finance4', 'Ade', 'Ade', 'Finance', 'Finance', 'Finance', 'Financ4e', 'Ade', 'Ade', 'Ade', NULL, NULL, '2023-06-02 09:03:55', '2023-06-02 09:03:55'),
(5, 'kolatest', '$2y$12$qQB.jD68/r.EEnooRgK/hOnI1n/xrH7zuM1hHqwl5YgBTsVsyJuAC', 'kolatest', 'Ade', 'Ade', 'Finance', 'Finance', 'Finance', 'kolatest', 'Ade', 'Ade', 'Ade', NULL, NULL, '2023-06-02 11:08:23', '2023-06-02 11:08:23'),
(6, 'w', '$2y$12$dlHRBnfQra5HKS9UYGopy.dmmauEx/8Q7xImDcVVDm9BMI2fbH.h2', 'kkk@f.n', 'y', 'y', 'y', 'y', 'd', '12345678902', 'https://www.facebook.com/profile', 'https://www.facebook.com/profile', 'https://www.facebook.com/profile', NULL, NULL, '2023-06-02 12:45:43', '2023-06-02 12:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_fk` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_client_fk` (`user_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `logo` (`logo`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `clients_user_fk` (`user_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forms_user_fk` (`user_id`),
  ADD KEY `forms_category_fk` (`category`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_type_fk` (`user_type_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_form_fk` (`form_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_question_fk` (`question_id`),
  ADD KEY `responses_user_fk` (`user_id`),
  ADD KEY `responses_form_fk` (`form_id`);

--
-- Indexes for table `sent_forms`
--
ALTER TABLE `sent_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logo` (`logo`),
  ADD KEY `settings_user_fk` (`default_user_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriber_subscription_fk` (`subscription_id`),
  ADD KEY `subscriber_user_fk` (`user_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sent_forms`
--
ALTER TABLE `sent_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_fk` FOREIGN KEY (`user_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `category_client_fk` FOREIGN KEY (`user_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_category_fk` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forms_user_fk` FOREIGN KEY (`user_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permission_user_type_fk` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_form_fk` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_form_fk` FOREIGN KEY (`form_id`) REFERENCES `questions` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responses_question_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responses_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_fk` FOREIGN KEY (`default_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `subscriber_subscription_fk` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriber_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
