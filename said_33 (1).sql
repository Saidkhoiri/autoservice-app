-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 04:38 AM
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
-- Database: `said_33`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `technician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `vehicle_brand` varchar(255) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `service_type_id`, `technician_id`, `booking_date`, `booking_time`, `vehicle_number`, `vehicle_brand`, `vehicle_model`, `notes`, `status`, `total_price`, `created_at`, `updated_at`) VALUES
(363, 11, 1, 2, '2025-10-24', '20:24:00', 'AB 1234 CD', 'Suzuki', 'Ninja', 'Oli perlu diganti', 'completed', 150000.00, '2025-10-23 06:27:09', '2025-10-23 06:30:17'),
(364, 11, 2, 1, '2025-10-25', '19:46:00', 'B 9626 TTS', 'Honda', 'Beat', 'Ganti kapas rem', 'pending', 80000.00, '2025-10-23 06:28:43', '2025-10-24 05:46:52'),
(367, 12, 4, 1, '2025-10-26', '10:02:00', 'B 5037 OLR', 'Kawasaki', 'PCX', 'Servise transmisi', 'confirmed', 200000.00, '2025-10-24 19:04:43', '2025-10-24 19:05:17'),
(368, 13, 6, 3, '2025-10-28', '16:10:00', 'B 9548 GES', 'Honda', 'GSX-R', 'AC tidak dinginn', 'completed', 250000.00, '2025-10-24 19:10:21', '2025-10-24 19:11:06'),
(369, 13, 1, 2, '2025-10-29', '13:17:00', 'B 1843 OVJ', 'Honda', 'Vario', 'Rem kurang responsif', 'completed', 150000.00, '2025-10-24 19:22:32', '2025-10-24 19:30:59');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_31_073926_create_roles_table', 1),
(6, '2025_08_31_073936_create_service_types_table', 1),
(7, '2025_08_31_073945_create_technicians_table', 1),
(8, '2025_08_31_073955_create_bookings_table', 1),
(9, '2025_08_31_074018_create_reviews_table', 1),
(10, '2025_08_31_075125_add_role_id_to_users_table', 1);

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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `user_id`, `rating`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(54, 363, 11, 5, 'Service selesai tepat waktu', 1, '2025-10-23 06:31:52', '2025-10-24 19:21:11'),
(55, 368, 13, 4, 'Service selesai tepat waktu', 0, '2025-10-24 19:12:21', '2025-10-24 19:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'customer', 'Pelanggan', 'Pelanggan yang dapat melakukan booking dan melihat status pesanan', '2025-09-09 04:51:44', '2025-09-09 04:51:44'),
(2, 'admin', 'Admin Bengkel', 'Admin yang mengelola jadwal booking, teknisi, dan daftar jasa', '2025-09-09 04:51:44', '2025-09-09 04:51:44'),
(3, 'owner', 'Pemilik Bengkel', 'Pemilik yang memiliki akses penuh termasuk laporan pendapatan', '2025-09-09 04:51:44', '2025-09-09 04:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `name`, `description`, `price`, `duration_minutes`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ganti Oli Mesin', 'Penggantian oli mesin dengan oli berkualitas tinggi', 150000.00, 30, 1, '2025-09-09 04:51:44', '2025-10-23 03:32:02'),
(2, 'Ganti Oli Gardan', 'Penggantian oli gardan untuk performa optimal', 80000.00, 20, 1, '2025-09-09 04:51:44', '2025-09-09 04:51:44'),
(3, 'Ganti Filter Udara', 'Penggantian filter udara untuk efisiensi bahan bakar', 50000.00, 15, 1, '2025-09-09 04:51:44', '2025-09-09 04:51:44'),
(4, 'Tune Up', 'Penyetelan mesin untuk performa optimal', 200000.00, 60, 1, '2025-09-09 04:51:44', '2025-09-09 04:51:44'),
(5, 'Ganti Kampas Rem', 'Penggantian kampas rem depan dan belakang', 300000.00, 90, 1, '2025-09-09 04:51:44', '2025-09-09 04:51:44'),
(6, 'Service AC', 'Pembersihan dan pengisian freon AC', 250000.00, 120, 1, '2025-09-09 04:51:44', '2025-09-09 04:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `specialization` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `name`, `phone`, `specialization`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Aldi Pratama', '081234567890', 'Spesialis mesin dan transmisi', 1, '2025-09-09 04:51:45', '2025-09-09 05:06:39'),
(2, 'Budi Santoso', '081234567891', 'Spesialis kelistrikan dan AC', 1, '2025-09-09 04:51:45', '2025-09-09 04:51:45'),
(3, 'Candra Wijaya', '081234567892', 'Spesialis rem dan suspensi', 1, '2025-09-09 04:51:45', '2025-09-09 04:51:45'),
(4, 'Dedi Kurniawan', '081234567893', 'Spesialis tune up dan service berkala', 1, '2025-09-09 04:51:45', '2025-09-09 04:51:45');

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
  `password_plain` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `password_plain`, `remember_token`, `created_at`, `updated_at`, `role_id`, `phone`, `address`, `is_active`) VALUES
(1, 'Admin Bengkel', 'admin@demo.com', NULL, '$2y$10$hkL0VJWhhOjrBiJLoNv8DO4N69.5OFw0EAqti2FR1RNdkf6sLm3Vq', NULL, NULL, '2025-09-09 04:51:44', '2025-09-09 04:51:44', 2, '081234567890', 'Jl. Bengkel No. 1, Jakarta', 1),
(2, 'Pemilik Bengkel', 'owner@demo.com', NULL, '$2y$10$Yz.C9/IHyEDPkppopegECuUyAcfV7wn.GKTcLuOr2YDcSTOEdpK2q', NULL, NULL, '2025-09-09 04:51:44', '2025-09-09 04:51:44', 3, '081234567891', 'Jl. Bengkel No. 1, Jakarta', 1),
(3, 'Pelanggan Demo', 'customer@demo.com', NULL, '$2y$10$LVlbfDkw3IxDB8lsr01.UevkQQZ41otlKv2pWa4OBjwWNA3RpLl4i', NULL, NULL, '2025-09-09 04:51:45', '2025-09-09 04:51:45', 1, '081234567892', 'Jl. Pelanggan No. 1, Jakarta', 1),
(11, 'Archen', 'aydinn@gmail.com', NULL, '$2y$10$1gqPCiDJkFjGLsr6xZER5.US5JKBZtMN4jIPq4igLgZNIjkZVk4D.', NULL, NULL, '2025-10-23 06:24:10', '2025-10-24 05:36:39', 1, '053253295744', 'Solo', 1),
(12, 'Narapit', 'klepon@gmail.com', NULL, '$2y$10$0xUPBE7Zfv1wzye7kNP9A.uMHle1eKC0aMtQyyKOvqXp4F8atoCIm', NULL, NULL, '2025-10-24 19:00:31', '2025-10-24 19:00:31', 1, '081234567890', 'Solo', 1),
(13, 'Natachai', 'nata@gmail.com', NULL, '$2y$10$6xs.tU0Lavg6Abc1dGjiXuNQ7.is.Vk9oy1p/Np3Fnv1j4ZEY3vni', NULL, NULL, '2025-10-24 19:08:03', '2025-10-24 19:08:03', 1, '085712345678', 'Semarang', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_service_type_id_foreign` (`service_type_id`),
  ADD KEY `bookings_technician_id_foreign` (`technician_id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_booking_id_foreign` (`booking_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

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
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
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
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
