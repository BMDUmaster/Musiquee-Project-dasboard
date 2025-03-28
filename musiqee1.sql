-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 02:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musiqee1`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_artist_models`
--

CREATE TABLE `api_artist_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `BioGraph` text NOT NULL,
  `Date` date NOT NULL,
  `Socialmedia` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Socialmedia`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_models`
--

CREATE TABLE `artist_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `BioGraph` text NOT NULL,
  `Date` date NOT NULL,
  `Socialmedia` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Socialmedia`)),
  `status` varchar(255) NOT NULL,
  `Action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `follow_up_models`
--

CREATE TABLE `follow_up_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userName` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_17_104526_create_customers_table', 1),
(6, '2025_03_06_065058_create_artist_models_table', 1),
(7, '2025_03_08_044134_create_music_table', 1),
(8, '2025_03_11_081553_create_song_modules_table', 1),
(9, '2025_03_12_093605_create_song_plays_table', 1),
(10, '2025_03_20_091935_create_song_upload_a_p_i_s_table', 1),
(11, '2025_03_21_103815_create_api_artist_models_table', 1),
(12, '2025_03_26_080804_create_userregisters_table', 1),
(13, '2025_03_26_120849_create_user_song_stores_table', 1),
(15, '2025_03_27_053441_create_follow_up_models_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `categaury_image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\userregister', 1, 'Login Token', 'a4ae7307e8a6d880d67e8970acea8e3d312d8491963767c0bc0ee9f25d3b1f4b', '[\"*\"]', '2025-03-27 02:00:47', NULL, '2025-03-27 00:21:14', '2025-03-27 02:00:47'),
(5, 'App\\Models\\userregister', 2, 'authToken', 'd3af5079ea026f0346df93527c730e2b00844a6aaa78c340aacaedb3d41c5f60', '[\"*\"]', NULL, NULL, '2025-03-27 01:41:06', '2025-03-27 01:41:06'),
(6, 'App\\Models\\userregister', 3, 'authToken', '0619f8d73142cc77764b14882651263ef3f07e2a86fc62c53946c72f26344ea0', '[\"*\"]', NULL, NULL, '2025-03-27 01:43:44', '2025-03-27 01:43:44'),
(7, 'App\\Models\\userregister', 4, 'authToken', 'c3432b31cde203a56d85c4708a053f4310dd11ecb9d8ed8ff58b966f070e2e25', '[\"*\"]', NULL, NULL, '2025-03-27 01:59:56', '2025-03-27 01:59:56'),
(8, 'App\\Models\\userregister', 5, 'authToken', 'c0d311e71cd44d309d7a95432cf72529827d234355170951e640b14a2aaea829', '[\"*\"]', NULL, NULL, '2025-03-27 02:00:31', '2025-03-27 02:00:31'),
(9, 'App\\Models\\userregister', 5, 'Login Token', 'dae45d10b1606fcbb34e149e3aa5b4d6d8fb7f51c66c412edd64148c543a953e', '[\"*\"]', '2025-03-27 05:49:54', NULL, '2025-03-27 02:06:09', '2025-03-27 05:49:54'),
(10, 'App\\Models\\userregister', 6, 'authToken', 'a949eca45b4598f2ef609d04b373e6bceb387ba7804ac3f1b348d50aa2bd3fb0', '[\"*\"]', NULL, NULL, '2025-03-27 05:10:30', '2025-03-27 05:10:30'),
(11, 'App\\Models\\userregister', 7, 'authToken', '933e718b89c6d085e3361505505d4e6bb21aaf693e689671fc0b3029ea7c75d7', '[\"*\"]', NULL, NULL, '2025-03-28 07:28:05', '2025-03-28 07:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `song_modules`
--

CREATE TABLE `song_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Song` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `song_plays`
--

CREATE TABLE `song_plays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `songname` varchar(255) NOT NULL,
  `User_ID` varchar(255) NOT NULL,
  `UploadFile` varchar(255) NOT NULL,
  `categeryID` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `song_upload_a_p_i_s`
--

CREATE TABLE `song_upload_a_p_i_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SongType` varchar(255) NOT NULL,
  `SongPath` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userregisters`
--

CREATE TABLE `userregisters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `socialLinks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`socialLinks`)),
  `role` varchar(255) NOT NULL DEFAULT 'singer',
  `profileImage` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userregisters`
--

INSERT INTO `userregisters` (`id`, `userName`, `phone`, `email`, `bio`, `socialLinks`, `role`, `profileImage`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '9140213763', NULL, NULL, 'null', 'singer', NULL, '$2y$10$9UEi07SaKrtRn0QtcRkyKObSBAdCkXAdEcsEJ8J63JAwUCKgRKBA2', 'active', '2025-03-27 00:10:13', '2025-03-27 00:10:13'),
(2, NULL, '8009636339', NULL, NULL, 'null', 'singer', NULL, '$2y$10$b1WK808KSEIKiLsCBIAvWOpQBAsL8qTx0Z.HlK4EYSkJtzUPQGK/e', 'active', '2025-03-27 01:41:06', '2025-03-27 01:41:06'),
(3, 'Pavan Kumar', '8009459046', NULL, NULL, 'null', 'singer', NULL, '$2y$10$Wg1PYvDD.nbLruoY3fFXbumAHfc07rlfz8kYiG0UKcGf96mlCdLky', 'active', '2025-03-27 01:43:44', '2025-03-27 01:43:44'),
(4, 'guru', '1234567890', 'johndoe@example.com', 'This is a short bio for testing purposes.', 'null', 'singer', 'C:\\xampp\\tmp\\php9979.tmp', '$2y$10$Wupe2UncPdThvZuDFR2cT.xssk/X.WO7KEawZAfWGT/zdBUU9Th1y', 'active', '2025-03-27 01:59:56', '2025-03-27 01:59:56'),
(5, 'hello guru', '1234567898', 'johndo@example.com', 'This is a short bio for testing purposes.', 'null', 'singer', 'C:\\xampp\\tmp\\php2649.tmp', '$2y$10$.VqusAa4ufeuy4ghenetYe1X6pdFvuOsDdlGlEk7/qAzb0yqQ0an6', 'active', '2025-03-27 02:00:31', '2025-03-27 02:00:31'),
(6, 'hello guru', '1234567897', 'johndo@example.co', 'This is a short bio for testing purposes.', 'null', 'singer', 'C:\\xampp\\tmp\\phpA36.tmp', '$2y$10$MP4AOyfmO2j94z7M3HKduuXIfjiTcGG0Yn8bjhe0zPrW8DI3i4cCS', 'active', '2025-03-27 05:10:29', '2025-03-27 05:10:29'),
(7, 'hello guru', '1234567867', 'guru@example.co', 'This is a short bio for testing purposes.', 'null', 'singer', 'C:\\xampp\\tmp\\php6E81.tmp', '$2y$10$MOBIq/OYiVBaJhbYVFCoxe2XUtvbS6SBkhX8HeEsCaeJY671WUoHm', 'active', '2025-03-28 07:28:05', '2025-03-28 07:28:05');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pavan Kumar', 'pavanku80096@gmail.com', NULL, '$2y$10$ZVqZmj7.pG7DSkauzsP7y.z3BwaDUxtn07BjcfafsT1zexJrarDGe', NULL, '2025-03-27 01:02:10', '2025-03-27 01:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_song_stores`
--

CREATE TABLE `user_song_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_artist_models`
--
ALTER TABLE `api_artist_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_models`
--
ALTER TABLE `artist_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follow_up_models`
--
ALTER TABLE `follow_up_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follow_up_models_user_id_foreign` (`user_id`),
  ADD KEY `follow_up_models_follower_id_foreign` (`follower_id`),
  ADD KEY `follow_up_models_following_id_foreign` (`following_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `song_modules`
--
ALTER TABLE `song_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_plays`
--
ALTER TABLE `song_plays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_upload_a_p_i_s`
--
ALTER TABLE `song_upload_a_p_i_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregisters`
--
ALTER TABLE `userregisters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userregisters_phone_unique` (`phone`),
  ADD UNIQUE KEY `userregisters_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_song_stores`
--
ALTER TABLE `user_song_stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_song_stores_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_artist_models`
--
ALTER TABLE `api_artist_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_models`
--
ALTER TABLE `artist_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_up_models`
--
ALTER TABLE `follow_up_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `song_modules`
--
ALTER TABLE `song_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `song_plays`
--
ALTER TABLE `song_plays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `song_upload_a_p_i_s`
--
ALTER TABLE `song_upload_a_p_i_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userregisters`
--
ALTER TABLE `userregisters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_song_stores`
--
ALTER TABLE `user_song_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow_up_models`
--
ALTER TABLE `follow_up_models`
  ADD CONSTRAINT `follow_up_models_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `userregisters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_up_models_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `userregisters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_up_models_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `userregisters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_song_stores`
--
ALTER TABLE `user_song_stores`
  ADD CONSTRAINT `user_song_stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `userregisters` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
