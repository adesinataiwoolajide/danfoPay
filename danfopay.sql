-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2019 at 04:54 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `danfopay`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'default', 'view profile', 1, 'App\\User', 1, 'App\\User', '{\"name\":\"Adesina Taiwo Olajide\",\"email\":\"administrator@gmail.com\"}', '2019-08-29 17:02:39', '2019-08-29 17:02:39'),
(2, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '[]', '2019-08-29 17:05:31', '2019-08-29 17:05:31'),
(3, 'default', 'created', 5, 'App\\User', 1, 'App\\User', '[]', '2019-08-30 07:17:01', '2019-08-30 07:17:01'),
(4, 'default', 'updated', 5, 'App\\User', 1, 'App\\User', '[]', '2019-08-30 07:17:39', '2019-08-30 07:17:39'),
(5, 'default', 'deleted', 5, 'App\\User', 1, 'App\\User', '[]', '2019-08-30 07:17:47', '2019-08-30 07:17:47'),
(6, 'default', 'restored', 5, 'App\\User', 1, 'App\\User', '{\"name\":\"Jeremaiah\",\"email\":\"jerry@gmail.com\"}', '2019-08-30 07:18:00', '2019-08-30 07:18:00'),
(7, 'default', 'updated', 3, 'App\\User', 3, 'App\\User', '[]', '2019-08-30 08:53:26', '2019-08-30 08:53:26'),
(8, 'default', 'updated', 2, 'App\\User', 2, 'App\\User', '[]', '2019-08-30 08:55:45', '2019-08-30 08:55:45'),
(9, 'default', 'restored', 3, 'App\\VehicleType', 1, 'App\\User', '{\"type_name\":\"Busessd\"}', '2019-08-30 09:40:56', '2019-08-30 09:40:56'),
(10, 'default', 'restored', 1, 'App\\VehicleType', 1, 'App\\User', '{\"type_name\":\"Bus\"}', '2019-08-30 09:42:54', '2019-08-30 09:42:54'),
(11, 'default', 'restored', 4, 'App\\VehicleOwner', 1, 'App\\User', '{\"owner_name\":null}', '2019-08-30 13:20:30', '2019-08-30 13:20:30'),
(12, 'default', 'created', 6, 'App\\User', 1, 'App\\User', '[]', '2019-09-10 09:37:31', '2019-09-10 09:37:31'),
(13, 'default', 'created', 7, 'App\\User', 1, 'App\\User', '[]', '2019-09-10 09:38:39', '2019-09-10 09:38:39'),
(14, 'default', 'updated', 3, 'App\\User', 1, 'App\\User', '[]', '2019-09-10 09:38:56', '2019-09-10 09:38:56'),
(15, 'default', 'deleted', 3, 'App\\User', 1, 'App\\User', '[]', '2019-09-10 09:39:03', '2019-09-10 09:39:03'),
(16, 'default', 'restored', 3, 'App\\User', 1, 'App\\User', '{\"name\":\"Samson Olamide\",\"email\":\"samson@gmail.com\"}', '2019-09-10 09:39:10', '2019-09-10 09:39:10'),
(17, 'default', 'restored', 1, 'App\\VehicleType', 1, 'App\\User', '{\"type_name\":\"Buses\"}', '2019-09-10 09:44:20', '2019-09-10 09:44:20'),
(18, 'default', 'restored', 1, 'App\\VehicleOwner', 1, 'App\\User', '{\"owner_name\":null}', '2019-09-10 09:47:45', '2019-09-10 09:47:45'),
(19, 'default', 'restored', 4, 'App\\VehicleOwner', 1, 'App\\User', '{\"owner_name\":\"Testing Owners\"}', '2019-09-10 09:49:17', '2019-09-10 09:49:17'),
(20, 'default', 'restored', 4, 'App\\VehicleOwner', 1, 'App\\User', '{\"owner_name\":\"Testing Owners\"}', '2019-09-10 09:50:18', '2019-09-10 09:50:18'),
(21, 'default', 'restored', 1, 'App\\VehicleOwner', 1, 'App\\User', '{\"owner_name\":\"Adebola Kemisola\"}', '2019-09-10 10:03:41', '2019-09-10 10:03:41'),
(22, 'default', 'created', 2, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 08:15:36', '2019-09-16 08:15:36'),
(23, 'default', 'created', 3, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 08:27:24', '2019-09-16 08:27:24'),
(24, 'default', 'deleted', 2, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 08:41:29', '2019-09-16 08:41:29'),
(25, 'default', 'deleted', 3, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 09:26:43', '2019-09-16 09:26:43'),
(26, 'default', 'deleted', 2, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 10:13:31', '2019-09-16 10:13:31'),
(27, 'default', 'deleted', 2, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 10:17:48', '2019-09-16 10:17:48'),
(28, 'default', 'deleted', 3, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 10:18:56', '2019-09-16 10:18:56'),
(29, 'default', 'created', 4, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 10:19:34', '2019-09-16 10:19:34'),
(30, 'default', 'created', 5, 'App\\User', 1, 'App\\User', '[]', '2019-09-16 10:25:37', '2019-09-16 10:25:37'),
(31, 'default', 'updated', 2, 'App\\User', 2, 'App\\User', '[]', '2019-09-16 10:50:02', '2019-09-16 10:50:02'),
(32, 'default', 'updated', 4, 'App\\User', 4, 'App\\User', '[]', '2019-09-16 11:01:09', '2019-09-16 11:01:09'),
(33, 'default', 'updated', 5, 'App\\User', 5, 'App\\User', '[]', '2019-09-17 08:49:24', '2019-09-17 08:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `balance_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`balance_id`, `total_amount`, `user_id`, `customer_code`, `updated_at`, `created_at`, `deleted_at`) VALUES
(4, '20000', 4, 'CUS_ys5ydohrh502fyg', '2019-09-17 12:48:55', '2019-09-17 08:23:54', NULL),
(5, '620000', 5, 'CUS_l684mk04yncdi80', '2019-09-17 12:47:11', '2019-09-17 09:02:26', NULL),
(8, '220000', 2, 'CUS_xu9z0gvz3amogud', '2019-09-17 13:26:03', '2019-09-17 12:47:11', NULL),
(9, '50000', 3, 'AFED8277E2', '2019-09-17 12:53:50', '2019-09-17 12:53:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `phone_number`, `customer_number`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Customer One', 'customer1@gmail.com', '08138139333', '7F3B3', '2019-09-16 10:18:29', '2019-09-16 08:15:36', NULL),
(2, 'Customer Two', 'customer2@gmail.com', '09072281204', '5CCED', '2019-09-16 10:25:45', '2019-09-16 08:27:24', NULL),
(3, 'Customer Three', 'customer3@gmail.com', '09072281201', '5AB1B', '2019-09-16 13:56:40', '2019-09-16 10:19:34', NULL),
(4, 'Customer 4', 'customer4@gmail.com', '09072281207', '00AEC', '2019-09-16 10:25:36', '2019-09-16 10:25:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fund_transfers`
--

CREATE TABLE `fund_transfers` (
  `fund_id` bigint(20) UNSIGNED NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_29_171100_create_permission_tables', 1),
(4, '2019_08_29_175403_add_deleted_at_to_users', 2),
(5, '2019_08_30_084929_create_vehicle_types_table', 2),
(6, '2019_08_30_110722_create_vehicle_owners_table', 3),
(7, '2019_08_30_110817_create_vehicle_operators_table', 4),
(8, '2019_08_30_110910_create_vehicles_table', 4),
(9, '2019_08_30_115808_add_password_to_vehicle_owner', 5),
(10, '2019_09_16_080707_create_customers_table', 6),
(11, '2019_09_16_124851_create_payments_table', 7),
(12, '2019_09_16_125156_create_balances_table', 7),
(13, '2019_09_16_131303_add_user_id_to_balances', 8),
(14, '2019_09_16_131341_add_user_id_to_payments', 8),
(15, '2019_09_17_111120_create_fund_transfers_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(21, 'App\\User', 2),
(21, 'App\\User', 4),
(21, 'App\\User', 5),
(22, 'App\\User', 2),
(22, 'App\\User', 4),
(22, 'App\\User', 5),
(23, 'App\\User', 2),
(23, 'App\\User', 4),
(23, 'App\\User', 5),
(24, 'App\\User', 2),
(24, 'App\\User', 4),
(24, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', '1'),
(3, 'App\\User', '2'),
(3, 'App\\User', '3'),
(3, 'App\\User', '4'),
(3, 'App\\User', '5');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `reference`, `amount`, `currency`, `user_id`, `status`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'acmBBNDZrC2zaOALv4GWVs3j8', '6500', 'NGN', 4, 'success', '2019-09-17 08:38:43', '2019-09-17 08:38:43', NULL),
(2, 'EPkwZtaV15X14po5qldrhiYFO', '20000', 'NGN', 4, 'success', '2019-09-17 08:40:01', '2019-09-17 08:40:01', NULL),
(3, 'vOruToK9ukT5rsh4Oiiu6ZGyc', '9000', 'NGN', 4, 'success', '2019-09-17 08:41:06', '2019-09-17 08:41:06', NULL),
(4, 'QatLY3mqgdQJFRKGj09uFESVs', '10500', 'NGN', 4, 'success', '2019-09-17 08:41:59', '2019-09-17 08:41:59', NULL),
(5, 'PF94CpAatJq7PMDdBQgSEov5J', '1000', 'NGN', 5, 'success', '2019-09-17 09:02:26', '2019-09-17 09:02:26', NULL),
(6, 'nR6qQYVgWXadgSdKvNh9D3qdy', '650000', 'NGN', 5, 'success', '2019-09-17 09:07:30', '2019-09-17 09:07:30', NULL),
(7, '0Fu7Hr742aaUjRJTmUmKR83ZZ', '1000', 'NGN', 5, 'success', '2019-09-17 09:19:33', '2019-09-17 09:19:33', NULL),
(8, 'whZLcBtDIVYNdkdnIwu7iYptN', '20000', 'NGN', 2, 'success', '2019-09-17 12:50:34', '2019-09-17 12:50:34', NULL),
(9, 'tnEsSEpa612YI8rgdy4n8z5Ns', '200000', 'NGN', 2, 'success', '2019-09-17 12:55:06', '2019-09-17 12:55:06', NULL),
(10, 'GKnxq0NPTNa0q7ewGcXUpdyYH', '20000', 'NGN', 2, 'success', '2019-09-17 13:26:03', '2019-09-17 13:26:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Add Vehicle Type', 'web', '2019-08-30 08:10:20', '2019-08-30 08:10:20'),
(2, 'Update Vehicle Type', 'web', '2019-08-30 08:16:48', '2019-08-30 08:16:48'),
(3, 'Delete Vehicle Type', 'web', '2019-08-30 08:18:48', '2019-08-30 08:18:48'),
(4, 'Edit Vehicle Type', 'web', '2019-08-30 09:05:15', '2019-08-30 09:05:15'),
(5, 'Restore Vehicle Type', 'web', '2019-08-30 09:39:07', '2019-08-30 09:39:07'),
(6, 'Add Owner', 'web', '2019-08-30 11:03:08', '2019-08-30 11:03:08'),
(7, 'Edit Owner', 'web', '2019-08-30 11:03:14', '2019-08-30 11:03:14'),
(8, 'Update Owner', 'web', '2019-08-30 11:03:26', '2019-08-30 11:03:26'),
(9, 'Delete Owner', 'web', '2019-08-30 11:03:35', '2019-08-30 11:03:35'),
(10, 'Restore Owner', 'web', '2019-08-30 11:03:44', '2019-08-30 11:03:44'),
(11, 'Add Vehicle', 'web', '2019-09-02 08:15:36', '2019-09-02 08:15:36'),
(12, 'Edit Vehicle', 'web', '2019-09-02 08:15:43', '2019-09-02 08:15:43'),
(13, 'Update Vehicle', 'web', '2019-09-02 08:15:53', '2019-09-02 08:15:53'),
(14, 'Delete Vehicle', 'web', '2019-09-02 08:16:00', '2019-09-02 08:16:00'),
(15, 'Restore Vehicle', 'web', '2019-09-02 08:16:07', '2019-09-02 08:16:07'),
(16, 'Add Operator', 'web', '2019-09-03 09:13:09', '2019-09-03 09:13:09'),
(17, 'Edit Operator', 'web', '2019-09-03 09:13:16', '2019-09-03 09:13:16'),
(18, 'Update Operator', 'web', '2019-09-03 09:13:23', '2019-09-03 09:13:23'),
(19, 'Delete Operator', 'web', '2019-09-03 09:13:32', '2019-09-03 09:13:32'),
(20, 'Restore Operator', 'web', '2019-09-03 09:13:39', '2019-09-03 09:13:39'),
(21, 'Add Customer', 'web', '2019-09-16 09:33:31', '2019-09-16 09:33:31'),
(22, 'Edit Customer', 'web', '2019-09-16 09:33:39', '2019-09-16 09:33:39'),
(23, 'Update Customer', 'web', '2019-09-16 09:33:49', '2019-09-16 09:33:49'),
(24, 'Delete Customer', 'web', '2019-09-16 09:34:05', '2019-09-16 09:34:05'),
(25, 'Restore Customer', 'web', '2019-09-16 09:34:14', '2019-09-16 09:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'web', '2019-08-29 16:16:06', '2019-08-29 16:16:06'),
(2, 'Owner', 'web', '2019-08-29 16:16:15', '2019-08-29 16:16:15'),
(3, 'Customer', 'web', '2019-08-29 16:16:23', '2019-08-29 16:16:23'),
(4, 'Driver', 'web', '2019-08-29 16:16:28', '2019-08-29 16:16:28'),
(5, 'Admin', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Adesina Taiwo', 'administrator@gmail.com', '2019-04-10 14:29:39', '$2y$10$pk17qvsG/AavWn2S6Ayx6./42WqKLutbcWjERVTjn.Dhdbjhhmd6C', 'Administrator', '1', '', '2019-08-29 17:05:30', '2019-04-10 14:29:39', NULL),
(2, 'Customer One', 'customer1@gmail.com', '2019-09-16 10:50:02', '$2y$10$XkQi6a5Jz/eGZRETpxukB.cja7y/J/hbEvm.PHALdOxlNSKG.QII6', 'Customer', '1', NULL, '2019-09-16 10:50:02', '2019-09-16 08:15:36', NULL),
(3, 'Customer Two', 'customer2@gmail.com', NULL, '$2y$10$tNWh3D0xajfXO0C3eQQRGOOtIjemNriK0KzIfCQ/6IZwIRFW33qM.', 'Customer', '1', NULL, '2019-09-16 10:25:46', '2019-09-16 08:27:24', NULL),
(4, 'Customer Three', 'customer3@gmail.com', '2019-09-16 11:01:09', '$2y$10$/jcstmlW0Ju44Lju7beC9.d2VcGkzBP/c25RxtvMB37bt2V70xoc2', 'Customer', '1', NULL, '2019-09-16 13:56:40', '2019-09-16 10:19:34', NULL),
(5, 'Customer 4', 'customer4@gmail.com', '2019-09-17 08:49:23', '$2y$10$PRznlsS0oiwZGYiLIRdgTuqx1wcppxFPSKBGioar.ghrpxmUKXgim', 'Customer', '1', NULL, '2019-09-17 08:49:23', '2019-09-16 10:25:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `plate_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `plate_number`, `brand`, `owner_id`, `type_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'SS 234 RGB', 'TOYOTA', 2, 1, '2019-09-10 11:03:39', '2019-09-10 10:06:38', NULL),
(2, 'DS 305 DDD', 'MAZDA', 1, 2, '2019-09-10 11:04:40', '2019-09-10 10:07:49', NULL),
(3, 'FF 349 KLA', 'HONDA', 1, 4, '2019-09-10 11:04:15', '2019-09-10 10:09:03', NULL),
(4, 'FF 349 KLP', 'LEXUS', 4, 3, '2019-09-10 11:05:57', '2019-09-10 11:05:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_operators`
--

CREATE TABLE `vehicle_operators` (
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` int(255) NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_operators`
--

INSERT INTO `vehicle_operators` (`operator_id`, `name`, `phone_number`, `route`, `vehicle_id`, `owner_id`, `password`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Adeola Sola', '09072281204', 'Makola, Bodija Ojoo', 1, 2, '$2y$10$8sDW3ww4z7mc3n68qXp4Euap6KDLL.5u9dCNIa57TjErvwzn2MTRi', '2019-09-10 12:02:16', '2019-09-10 12:02:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_owner`
--

CREATE TABLE `vehicle_owner` (
  `owner_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(191) NOT NULL,
  `owner_number` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_owner`
--

INSERT INTO `vehicle_owner` (`owner_id`, `name`, `phone_number`, `address`, `password`, `owner_number`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Adebola Kemisola', '09073646383', 'Favors Building Bodija Ibadan', '$2y$10$dOuUTl1X4cW.etWTX0QkTOzOF5AjKB6hNJ2G/zahp95ivP5OdUPze', '12S34F', '2019-09-10 11:06:12', '2019-09-10 11:06:12', NULL),
(2, 'Owner One', '09083636366', 'Alakija Estate Ibadan', '$2y$10$pwbdnNMROfQ23XbaA8qYc.o0lLMycc7RLM.wW8NZtdjfjbyGvSbuu', '2', '2019-09-10 12:05:04', '2019-09-10 13:05:04', NULL),
(3, 'Owner Two', '09085757442', 'Bodija Estate', '$2y$10$uVQki5PBT3DU35kyVt87Vu9mLbu/eyz927u8prRpMbLsUbKxflbOC', '341014', '2019-09-10 10:05:04', '2019-09-10 10:05:04', NULL),
(4, 'Owner Three', '08047473832', 'Kolade Avenue', '$2y$10$BF6WnhiLpl.KBVphCqs7euSzda85tBGTixC7kxAh.Pc620ti.AD6S', '4', '2019-09-10 11:52:29', '2019-09-10 12:52:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`type_id`, `type_name`, `deleted_at`, `updated_at`, `created_at`) VALUES
(1, 'Bus', NULL, '2019-09-10 09:44:36', '2019-08-30 08:56:46'),
(2, 'Cab', NULL, '2019-08-30 08:56:55', '2019-08-30 08:56:55'),
(3, 'Mini Bus', NULL, '2019-08-30 09:43:11', '2019-08-30 09:34:36'),
(4, 'Tricycle', NULL, '2019-09-10 09:59:22', '2019-09-10 09:59:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`balance_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `fund_transfers`
--
ALTER TABLE `fund_transfers`
  ADD PRIMARY KEY (`fund_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_operators`
--
ALTER TABLE `vehicle_operators`
  ADD PRIMARY KEY (`operator_id`);

--
-- Indexes for table `vehicle_owner`
--
ALTER TABLE `vehicle_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `balance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fund_transfers`
--
ALTER TABLE `fund_transfers`
  MODIFY `fund_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_operators`
--
ALTER TABLE `vehicle_operators`
  MODIFY `operator_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_owner`
--
ALTER TABLE `vehicle_owner`
  MODIFY `owner_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
