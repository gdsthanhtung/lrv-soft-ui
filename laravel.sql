-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2024 at 11:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_13_071259_create_cache_table', 2),
(9, '2024_09_19_013546_create_user_role_models_table', 3),
(10, '2024_09_19_013532_create_role_models_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `permission` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permission`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '[\"admin.dashboard\",\"admin.user\",\"admin.user.form\",\"admin.user.delete\",\"admin.user.change-status\",\"admin.user.change-level\",\"admin.user.save\",\"admin.role\",\"admin.role.form\",\"admin.role.delete\",\"admin.role.change-status\",\"admin.role.save\",\"admin.logout\",\"admin.login\"]', 'active', 1, 1, '2024-09-19 00:37:04', '2024-09-22 02:55:29'),
(2, 'Normal User', '[\"admin.dashboard\"]', 'active', 1, 1, '2024-09-19 05:33:18', '2024-09-22 02:55:34'),
(3, 'Moderator', '[\"admin.dashboard\"]', 'active', 1, 1, '2024-09-19 05:35:21', '2024-09-22 02:55:40'),
(4, 'HR', '[\"admin.dashboard\",\"admin.user\",\"admin.user.form\"]', 'active', 1, 1, '2024-09-20 07:05:23', '2024-09-22 02:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT '',
  `phone` bigint(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `level` char(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `phone`, `location`, `about_me`, `remember_token`, `status`, `level`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Administrator', 'admin@softui.com', '$2y$10$ZocS28VraP5sVxdm7ABElO99KF69MqYZL0oFROtF5q3nf8Uua.ioy', '240917101111219414.jpg', NULL, NULL, NULL, NULL, 'active', 'admin', '2024-09-13 00:09:21', '2024-09-22 00:39:55', 1, 1),
(8, 'Admin - Gds Thanh Tung', 'gds.thanhtung1@gmail.com', '4297f44b13955235245b2497399d7a93', '240917101121407066.jpg', NULL, NULL, NULL, NULL, 'active', 'user', '2024-09-17 00:23:44', '2024-09-17 18:24:16', 1, 1),
(9, 'gradeus222', 'gds.gradeus222@gmail.com', '4297f44b13955235245b2497399d7a93', '240918041116804263.jpg', NULL, NULL, NULL, NULL, 'active', 'user', '2024-09-17 21:11:16', '2024-09-20 03:33:42', 1, 1),
(10, 'Huỳnh Thanh Tùng', 'admin11@softui.com', '4297f44b13955235245b2497399d7a93', '240918042318154388.jpg', NULL, NULL, NULL, NULL, 'active', 'user', '2024-09-17 21:23:18', '2024-09-17 21:23:18', 1, 1),
(11, 'asd-gg-com', 'asd@gg.com', 'a06f21366cdc5b960bd710273f56c26f', '240918042417035786.jpg', NULL, NULL, NULL, NULL, 'active', 'user', '2024-09-17 21:24:17', '2024-09-17 21:24:17', 1, 1),
(12, 'kkids-ggg-cv', 'kkids@ggg.cv', 'bc0f2353648c4647274670e3ee3fd47c', '240918042457742418.jpg', NULL, NULL, NULL, NULL, 'active', 'admin', '2024-09-17 21:24:57', '2024-09-21 01:33:30', 1, 1),
(13, 'tung@gygy.ooo', 'tung@gygy.ooo', '8de1ebe5220196d6acdb486f346fe162', '240920020315846140.jpg', NULL, NULL, NULL, NULL, 'active', 'user', '2024-09-20 07:03:15', '2024-09-20 07:03:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-09-22 00:40:06', '2024-09-22 00:40:06'),
(12, 2, 1, 1, '2024-09-21 03:50:34', '2024-09-21 03:50:34'),
(12, 3, 1, 1, '2024-09-21 03:50:34', '2024-09-21 03:50:34'),
(13, 1, 1, 1, '2024-09-21 03:48:33', '2024-09-21 03:48:33'),
(13, 4, 1, 1, '2024-09-21 03:48:33', '2024-09-21 03:48:33');

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
