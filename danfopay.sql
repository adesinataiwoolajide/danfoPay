-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 02:16 PM
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
(1, 'default', 'created', 22, 'App\\User', 1, 'App\\User', '[]', '2019-10-03 15:05:27', '2019-10-03 15:05:27'),
(2, 'default', 'updated', 22, 'App\\User', 22, 'App\\User', '[]', '2019-10-03 15:08:59', '2019-10-03 15:08:59'),
(3, 'default', 'created', 23, 'App\\User', 21, 'App\\User', '[]', '2019-10-04 07:26:16', '2019-10-04 07:26:16'),
(4, 'default', 'created', 24, 'App\\User', 21, 'App\\User', '[]', '2019-10-04 07:30:06', '2019-10-04 07:30:06'),
(5, 'default', 'created', 25, 'App\\User', 21, 'App\\User', '[]', '2019-10-04 07:34:45', '2019-10-04 07:34:45'),
(6, 'default', 'created', 26, 'App\\User', 15, 'App\\User', '[]', '2019-10-04 07:48:32', '2019-10-04 07:48:32'),
(7, 'default', 'created', 27, 'App\\User', 1, 'App\\User', '[]', '2019-10-04 08:16:27', '2019-10-04 08:16:27'),
(8, 'default', 'created', 28, 'App\\User', 1, 'App\\User', '[]', '2019-10-04 08:17:50', '2019-10-04 08:17:50'),
(9, 'default', 'created', 29, 'App\\User', 1, 'App\\User', '[]', '2019-10-04 08:19:02', '2019-10-04 08:19:02'),
(10, 'default', 'updated', 29, 'App\\User', 29, 'App\\User', '[]', '2019-10-04 08:20:17', '2019-10-04 08:20:17'),
(11, 'default', 'updated', 23, 'App\\User', 23, 'App\\User', '[]', '2019-10-04 08:27:34', '2019-10-04 08:27:34'),
(12, 'default', 'updated', 24, 'App\\User', 24, 'App\\User', '[]', '2019-10-04 08:41:40', '2019-10-04 08:41:40'),
(13, 'default', 'updated', 25, 'App\\User', 25, 'App\\User', '[]', '2019-10-04 09:29:10', '2019-10-04 09:29:10'),
(14, 'default', 'deleted', 18, 'App\\User', 1, 'App\\User', '[]', '2019-10-04 11:00:20', '2019-10-04 11:00:20'),
(15, 'default', 'restored', 18, 'App\\User', 1, 'App\\User', '{\"name\":\"Testing\",\"email\":\"testing@gmail.com\"}', '2019-10-04 11:00:30', '2019-10-04 11:00:30'),
(16, 'default', 'updated', 28, 'App\\User', 28, 'App\\User', '[]', '2019-10-11 08:25:04', '2019-10-11 08:25:04'),
(17, 'default', 'created', 30, 'App\\User', 15, 'App\\User', '[]', '2019-10-11 10:42:56', '2019-10-11 10:42:56');

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
(1, '38160', 4, 'CUS_2g3d67ut0hylj52', '2019-10-11 10:27:53', '2019-09-30 07:33:32', NULL),
(2, '97200', 2, 'CUS_hmo71l43bg2o7lh', '2019-10-11 10:27:54', '2019-09-30 07:37:16', NULL),
(3, '7800', 5, 'CUS_ob7kyookercytfv', '2019-10-11 08:30:22', '2019-10-02 12:15:04', NULL),
(4, '1000', 3, '612D75EE82', '2019-10-02 12:15:43', '2019-10-02 12:15:43', NULL),
(5, '2500', 29, 'CUS_nn38qrbedfr5xle', '2019-10-04 08:22:24', '2019-10-04 08:22:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bulk_sms`
--

CREATE TABLE `bulk_sms` (
  `sms_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, 'Customer Three', 'customer3@gmail.com', '09072281201', '5AB1B', '2019-10-02 12:24:44', '2019-09-16 10:19:34', NULL),
(4, 'Customer Four', 'customer4@gmail.com', '09072281207', '00AEC', '2019-09-19 11:19:30', '2019-09-16 10:25:36', NULL),
(5, 'Customer 5', 'customer5@gmail.com', '09083637366', '532C5C6061', '2019-09-19 11:19:07', '2019-09-19 11:19:07', NULL),
(6, 'New Customer', 'test@gmail.com', '09084647548', '9A4139B9B6', '2019-10-02 11:17:15', '2019-10-02 11:17:15', NULL),
(7, 'Testing Customer', 'customer7@gmail.com', '08138139339', '7999EF64F7', '2019-10-04 08:19:02', '2019-10-04 08:19:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fund_transfers`
--

CREATE TABLE `fund_transfers` (
  `fund_id` bigint(20) UNSIGNED NOT NULL,
  `sender` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciever` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fund_transfers`
--

INSERT INTO `fund_transfers` (`fund_id`, `sender`, `reciever`, `amount`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, '09072281201', '08138139333', 50, '2019-09-30 07:37:16', '2019-09-30 07:37:16', NULL),
(2, '09072281201', '08138139333', 150, '2019-10-02 12:14:09', '2019-10-02 12:14:09', NULL),
(3, '09072281207', '09072281204', 1000, '2019-10-02 12:15:43', '2019-10-02 12:15:43', NULL),
(4, '08138139333', '09072281201', 200, '2019-10-02 12:19:57', '2019-10-02 12:19:57', NULL),
(5, '08138139339', '08138139333', 500, '2019-10-04 08:22:24', '2019-10-04 08:22:24', NULL),
(6, '09072281201', '08138139333', 200, '2019-10-04 11:08:05', '2019-10-04 11:08:05', NULL),
(7, '09072281201', '08138139333', 6500, '2019-10-11 10:27:54', '2019-10-11 10:27:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manifests`
--

CREATE TABLE `manifests` (
  `manifest_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `negotiation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manifests`
--

INSERT INTO `manifests` (`manifest_id`, `vehicle_id`, `amount`, `customer_id`, `updated_at`, `created_at`, `deleted_at`, `negotiation_id`) VALUES
(4, 7, '300', 3, '2019-10-09 13:27:29', '2019-10-09 13:27:29', NULL, 4),
(5, 4, '120', 3, '2019-10-11 08:28:33', '2019-10-11 08:28:33', NULL, 7),
(6, 9, '200', 4, '2019-10-11 08:30:22', '2019-10-11 08:30:22', NULL, 8);

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
(15, '2019_09_17_111120_create_fund_transfers_table', 9),
(16, '2019_09_30_091333_create_bulk_sms_table', 10),
(17, '2019_09_30_091558_add_subject_to_bulk_sms', 11),
(18, '2019_10_02_082545_add_email_to_vehicle_owners', 12),
(19, '2019_10_09_081106_create_rounds_table', 12),
(20, '2019_10_09_092829_create_negotiations_table', 12),
(21, '2019_10_09_132659_add_balance_to_rounds', 13),
(22, '2019_10_09_133409_create_manifests_table', 14),
(23, '2019_10_09_141313_add_negotiation_id_to_manifest', 15);

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
(11, 'App\\User', 9),
(11, 'App\\User', 10),
(11, 'App\\User', 11),
(11, 'App\\User', 12),
(11, 'App\\User', 13),
(11, 'App\\User', 14),
(11, 'App\\User', 15),
(11, 'App\\User', 17),
(11, 'App\\User', 19),
(11, 'App\\User', 20),
(11, 'App\\User', 21),
(11, 'App\\User', 22),
(12, 'App\\User', 9),
(12, 'App\\User', 10),
(12, 'App\\User', 11),
(12, 'App\\User', 12),
(12, 'App\\User', 13),
(12, 'App\\User', 14),
(12, 'App\\User', 15),
(12, 'App\\User', 17),
(12, 'App\\User', 19),
(12, 'App\\User', 20),
(12, 'App\\User', 21),
(12, 'App\\User', 22),
(13, 'App\\User', 9),
(13, 'App\\User', 10),
(13, 'App\\User', 11),
(13, 'App\\User', 12),
(13, 'App\\User', 13),
(13, 'App\\User', 14),
(13, 'App\\User', 15),
(13, 'App\\User', 17),
(13, 'App\\User', 19),
(13, 'App\\User', 20),
(13, 'App\\User', 21),
(13, 'App\\User', 22),
(16, 'App\\User', 9),
(16, 'App\\User', 10),
(16, 'App\\User', 11),
(16, 'App\\User', 12),
(16, 'App\\User', 13),
(16, 'App\\User', 14),
(16, 'App\\User', 15),
(16, 'App\\User', 17),
(16, 'App\\User', 19),
(16, 'App\\User', 20),
(16, 'App\\User', 21),
(16, 'App\\User', 22),
(17, 'App\\User', 9),
(17, 'App\\User', 10),
(17, 'App\\User', 11),
(17, 'App\\User', 12),
(17, 'App\\User', 13),
(17, 'App\\User', 14),
(17, 'App\\User', 15),
(17, 'App\\User', 17),
(17, 'App\\User', 19),
(17, 'App\\User', 20),
(17, 'App\\User', 21),
(17, 'App\\User', 22),
(17, 'App\\User', 23),
(17, 'App\\User', 24),
(17, 'App\\User', 25),
(17, 'App\\User', 28),
(18, 'App\\User', 9),
(18, 'App\\User', 10),
(18, 'App\\User', 11),
(18, 'App\\User', 12),
(18, 'App\\User', 13),
(18, 'App\\User', 14),
(18, 'App\\User', 15),
(18, 'App\\User', 17),
(18, 'App\\User', 19),
(18, 'App\\User', 20),
(18, 'App\\User', 21),
(18, 'App\\User', 22),
(18, 'App\\User', 23),
(18, 'App\\User', 24),
(18, 'App\\User', 25),
(18, 'App\\User', 28),
(21, 'App\\User', 2),
(21, 'App\\User', 3),
(21, 'App\\User', 4),
(21, 'App\\User', 5),
(21, 'App\\User', 6),
(21, 'App\\User', 16),
(21, 'App\\User', 29),
(22, 'App\\User', 2),
(22, 'App\\User', 3),
(22, 'App\\User', 4),
(22, 'App\\User', 5),
(22, 'App\\User', 6),
(22, 'App\\User', 16),
(22, 'App\\User', 29),
(23, 'App\\User', 2),
(23, 'App\\User', 3),
(23, 'App\\User', 4),
(23, 'App\\User', 5),
(23, 'App\\User', 6),
(23, 'App\\User', 16),
(23, 'App\\User', 29),
(24, 'App\\User', 2),
(24, 'App\\User', 3),
(24, 'App\\User', 4),
(24, 'App\\User', 5),
(24, 'App\\User', 6),
(24, 'App\\User', 16),
(24, 'App\\User', 29);

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
(2, 'App\\User', '15'),
(2, 'App\\User', '17'),
(2, 'App\\User', '19'),
(2, 'App\\User', '20'),
(2, 'App\\User', '21'),
(2, 'App\\User', '22'),
(2, 'App\\User', '27'),
(3, 'App\\User', '16'),
(3, 'App\\User', '2'),
(3, 'App\\User', '29'),
(3, 'App\\User', '3'),
(3, 'App\\User', '4'),
(3, 'App\\User', '5'),
(3, 'App\\User', '6'),
(4, 'App\\User', '23'),
(4, 'App\\User', '24'),
(4, 'App\\User', '25'),
(4, 'App\\User', '26'),
(4, 'App\\User', '28'),
(4, 'App\\User', '30');

-- --------------------------------------------------------

--
-- Table structure for table `negotiations`
--

CREATE TABLE `negotiations` (
  `negotiation_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `from_destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `negotiations`
--

INSERT INTO `negotiations` (`negotiation_id`, `vehicle_id`, `from_destination`, `to_destination`, `amount`, `status`, `customer_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 1, 'Dugbe', 'Samonda Mobil', '200', 0, 3, '2019-10-09 11:47:39', '2019-10-09 10:33:00', NULL),
(2, 5, 'Bodija Favors', 'Sango poly junction', '150', 0, 4, '2019-10-11 08:20:49', '2019-10-09 10:39:19', NULL),
(3, 4, 'Nysc Secretariat Gate', 'Oja Oba', '300', 0, 1, '2019-10-09 10:40:54', '2019-10-09 10:40:54', NULL),
(4, 7, 'Iwo Road', 'Olodo Market', '300', 3, 3, '2019-10-09 13:25:49', '2019-10-09 11:25:09', NULL),
(5, 7, 'Ojoo Market', 'Fijabi', '50', 1, 1, '2019-10-09 11:28:06', '2019-10-09 11:26:07', NULL),
(6, 1, 'Nysc Secretariat Gate', 'Ojoo Roundabout', '200', 0, 3, '2019-10-11 08:18:17', '2019-10-11 08:18:17', NULL),
(7, 9, 'Iwo Road', 'Olodo Market', '120', 1, 3, '2019-10-11 10:37:21', '2019-10-11 08:19:48', NULL),
(8, 9, 'Ologun Eru', 'Oke Itunu', '200', 1, 4, '2019-10-11 10:37:16', '2019-10-11 08:21:12', NULL),
(9, 4, 'Bodija Favors', 'Olodo Market', '50', 0, 3, '2019-10-11 10:28:32', '2019-10-11 10:28:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('administrator@gmail.com', '$2y$10$x6owNEs0Qz72Qb9SSIALRu637R3ZnrnY8G53LX253XzVDURWFnjeW', '2019-09-30 12:09:04'),
('customer2@gmail.com', '$2y$10$KDWFkVuPR4ij/e/L3.XhAOj8Juza3Fw3iwAvebJcgI/P4aMLLntDC', '2019-09-30 12:13:40'),
('customer1@gmail.com', '$2y$10$HLtuPatCy3B/cTQEbA9TF.sJUipX6tpzGq1RMcYT60B5idJIWvan2', '2019-09-30 12:41:06'),
('customer4@gmail.com', '$2y$10$XQTHY2E4A.KBrebVgYQqyOkgIsVFMdR8RH085SjPmMDDrBMdDUEuq', '2019-09-30 12:45:47'),
('customer3@gmail.com', '$2y$10$A3Gv.7/fSu8F7wvj09HmK.sZo4uZJ0GD3vIQxRfcUfeK5BOwROXPO', '2019-09-30 13:17:49');

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
(1, 'TkfdEsfpwxpZBEDI4eRQ54lrP', '50', 'NGN', 4, 'success', '2019-09-30 07:33:32', '2019-09-30 07:33:32', NULL),
(2, 'hXxUZMlmVnF7MpMu3FrgLqvYv', '150', 'NGN', 4, 'success', '2019-09-30 07:36:13', '2019-09-30 07:36:13', NULL),
(3, 't8V9xuSKKtprbIprodfYuwce6', '2000000', 'NGN', 4, 'success', '2019-10-02 12:13:45', '2019-10-02 12:13:45', NULL),
(4, 'UgQhUUWUxhJV0CoSodro4cJAb', '900000', 'NGN', 5, 'success', '2019-10-02 12:15:04', '2019-10-02 12:15:04', NULL),
(5, 'WzsUjo6d2io29Ee1WG5Vscu0P', '9000000', 'NGN', 2, 'success', '2019-10-02 12:17:27', '2019-10-02 12:17:27', NULL),
(6, 't5Q0YJoGcrJm2XPXvhCnX1fFF', '300000', 'NGN', 29, 'success', '2019-10-04 08:22:00', '2019-10-04 08:22:00', NULL),
(7, 'puA12lo70ClmdXUxyo99BZq5X', '500000', 'NGN', 4, 'success', '2019-10-04 11:06:41', '2019-10-04 11:06:41', NULL),
(8, 'Uv67yP2mezrJSYw6nRKGSYHlk', '2000000', 'NGN', 4, 'success', '2019-10-11 10:27:13', '2019-10-11 10:27:13', NULL);

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
(4, 'Operator', 'web', '2019-08-29 16:16:28', '2019-08-29 16:16:28'),
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
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `round_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `current_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`round_id`, `vehicle_id`, `current_balance`, `updated_at`, `created_at`, `deleted_at`) VALUES
(2, 7, '300', '2019-10-09 13:27:29', '2019-10-09 13:25:49', NULL),
(3, 9, '440', '2019-10-11 08:30:22', '2019-10-11 08:25:59', NULL);

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
(1, 'Adesina Taiwo Victor', 'administrator@gmail.com', '2019-04-10 14:29:39', '$2y$10$pk17qvsG/AavWn2S6Ayx6./42WqKLutbcWjERVTjn.Dhdbjhhmd6C', 'Administrator', '1', '', '2019-09-30 06:47:30', '2019-04-10 14:29:39', NULL),
(2, 'Customer 1', 'customer1@gmail.com', '2019-09-16 10:50:02', '$2y$10$OOtrbxAO/SN.4CNbWNdTqOsHU89T5pqXs0AuENzA57SpTgS3M7jGO', 'Customer', '1', NULL, '2019-10-02 12:19:19', '2019-09-16 08:15:36', NULL),
(3, 'Customer Two', 'customer2@gmail.com', '2019-09-19 08:46:32', '$2y$10$tNWh3D0xajfXO0C3eQQRGOOtIjemNriK0KzIfCQ/6IZwIRFW33qM.', 'Customer', '1', NULL, '2019-09-19 08:46:32', '2019-09-16 08:27:24', NULL),
(4, 'Customer Three', 'customer3@gmail.com', '2019-10-02 12:22:07', '$2y$10$/jcstmlW0Ju44Lju7beC9.d2VcGkzBP/c25RxtvMB37bt2V70xoc2', 'Customer', '1', NULL, '2019-10-02 12:24:44', '2019-09-16 10:19:34', NULL),
(5, 'Customer Four', 'customer4@gmail.com', '2019-09-17 08:49:23', '$2y$10$PRznlsS0oiwZGYiLIRdgTuqx1wcppxFPSKBGioar.ghrpxmUKXgim', 'Customer', '1', NULL, '2019-09-19 11:19:30', '2019-09-16 10:25:37', NULL),
(6, 'Customer 5', 'customer5@gmail.com', '2019-09-19 11:20:21', '$2y$10$N8XawlNqegP8eAhcchX/weXZln4vGpYkdJ.zBPxrBQ6QZBHt17y6u', 'Customer', '1', NULL, '2019-09-19 11:20:21', '2019-09-19 11:19:07', NULL),
(15, 'New Owner', 'owner1@gmail.com', '2019-10-02 11:09:44', '$2y$10$qP4kmncxFHxZP4rcyaIuleba8v2u.0.6nxws6xOX5LbSlg17/tM12', 'Owner', '1', NULL, '2019-10-02 11:09:44', '2019-10-02 11:04:38', NULL),
(16, 'New Customer', 'test@gmail.com', '2019-10-02 11:18:01', '$2y$10$bAjcaRX8nWt6Jf3BW6jMBuHojMI0s9O/a5.SFrcgpIdvnjSjtvJX6', 'Customer', '1', NULL, '2019-10-02 11:18:01', '2019-10-02 11:17:15', NULL),
(17, 'Goke Demmy', 'owner@gmail.com', '2019-10-02 11:22:32', '$2y$10$0Kw7OA4.6GkEtOIhQQWqXeU5IXL61fTAh.JojXQm9BsEdSHkBPa5y', 'Administrator', '1', NULL, '2019-10-02 11:22:32', '2019-10-02 11:21:50', NULL),
(18, 'Testing', 'testing@gmail.com', '2019-10-02 11:29:31', '$2y$10$fAvwd/Va9OdLW5duTPoiEO74xCBVQcHn06PvGvfmiftVeGvjXneTK', 'Administrator', '1', NULL, '2019-10-04 11:00:30', '2019-10-02 11:28:50', NULL),
(19, 'Adesina Taiwo Victor', 'vintage@gmail.com', '2019-10-02 11:31:02', '$2y$10$XlgHu91.bQW3nAAoSTKbyu2SOW4r59QDo12bQtYz3K6KA3H4tkE9a', 'Owner', '1', NULL, '2019-10-02 11:31:02', '2019-10-02 11:30:00', NULL),
(20, 'Adeola Sola', 'sola@gmail.com', '2019-10-02 12:56:19', '$2y$10$V7D9UeAKkIGqI62Z8zp56.s4o8L9SrHavAK8IKsjwzDPiO8cSgs4m', 'Owner', '1', NULL, '2019-10-02 12:56:19', '2019-10-02 12:51:42', NULL),
(21, 'Adesina Taiwo Olajide', 'tolajide75@gmail.com', '2019-10-03 13:13:23', '$2y$10$bssWkAeDQ5JzkllKGmk2q.DyuywC8zY42GvNM5aUXBdbOA0H7AVIi', 'Owner', '1', NULL, '2019-10-03 13:13:23', '2019-10-03 13:12:01', NULL),
(22, 'Goke Demmy', 'goke@gmail.com', '2019-10-03 15:08:59', '$2y$10$1tBL6zL7vk3zXFFXcKpyrOp.B7b4qreh1w3oU5tYpeu3wmdhZBDM2', 'Owner', '1', NULL, '2019-10-03 15:08:59', '2019-10-03 15:05:27', NULL),
(23, 'Operator 1', 'operator1@gmail.com', '2019-10-04 08:27:34', '$2y$10$lzZynDuk9/7mBHRZHOZGN.Knua424NM4Jbfygs..7p4KaIUPZySOW', 'Owner', '1', NULL, '2019-10-04 08:27:34', '2019-10-04 07:26:16', NULL),
(24, 'Operator 2', 'operator2@gmail.com', '2019-10-04 08:41:40', '$2y$10$tm9G1GbpZoUHuWpI9HVOAOTpFLgxmpc4lAYevj0lZhV7KHb4SIYKi', 'Operator', '1', NULL, '2019-10-04 08:41:40', '2019-10-04 07:30:06', NULL),
(25, 'Olamide Fola', 'operator3@gmail.com', '2019-10-04 09:29:10', '$2y$10$91vErqGG.kyafBltlJ07ZuQU/ivHMcgvzHFNbiyc9JDuE45ZV4bIe', 'Operator', '1', NULL, '2019-10-04 09:29:10', '2019-10-04 07:34:45', NULL),
(26, 'New Operator', 'operator4gmail.com', '2019-10-14 23:00:00', '$2y$10$v3KUaGnb6wR6pt0mF49OhuT74qafPxexfr9Fc2fHLUs0R3Vu.lW.u', 'Operator', '1', NULL, '2019-10-04 08:04:47', '2019-10-04 07:48:32', NULL),
(27, 'Owner 2', 'owner2@gmail.com', NULL, '$2y$10$aOW9jkbioF05HZ68MUNr.O7IFSRRLycWfNNsmyowUrHTMJWZw3AKG', 'Owner', '1', NULL, '2019-10-04 08:16:27', '2019-10-04 08:16:27', NULL),
(28, 'Operator 6', 'operator6@gmail.com', '2019-10-11 08:25:03', '$2y$10$Nxz6BytY8bWFm/h4SAx38edsZosrcXfx2fcaDtAniyTBK3ydXc0h6', 'Operator', '1', NULL, '2019-10-11 08:25:03', '2019-10-04 08:17:50', NULL),
(29, 'Testing Customer', 'customer7@gmail.com', '2019-10-04 08:20:17', '$2y$10$6eTYlYEzNNoORXtb2fPv0.LMQrPn.WIgshGtxLbh7Ca20jZoJkI6O', 'Customer', '1', NULL, '2019-10-04 08:20:17', '2019-10-04 08:19:02', NULL),
(30, 'Babajide Hamid', 'babajide@gmail.com', NULL, '$2y$10$ENvyBnkyz0Bf4SvOaiefjuGn7DkFGxRhmIjqSmzyCUcLl0Sc09jpG', 'Owner', '1', NULL, '2019-10-11 11:06:24', '2019-10-11 10:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `plate_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `vehicles` (`vehicle_id`, `plate_number`, `vehicle_number`, `brand`, `owner_id`, `type_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'SS 234 RGB', '8B8E38', 'TOYOTA', 4, 1, '2019-10-09 07:55:05', '2019-10-03 07:05:23', NULL),
(2, 'FF 349 KLF', 'E76CCB', 'MAZDA', 4, 2, '2019-10-09 07:54:50', '2019-10-03 07:05:32', NULL),
(3, 'FF 340 KLF', '6E1A2F', 'LEXUS', 4, 3, '2019-10-09 07:54:39', '2019-10-03 07:45:11', NULL),
(4, 'DS 305 DDD', 'BA3D2A', 'TOYOTA', 4, 2, '2019-10-09 07:54:29', '2019-10-03 07:45:26', NULL),
(5, 'JA 234 SDF', 'F73261', 'TOYOTA', 5, 1, '2019-10-09 07:54:15', '2019-10-03 14:56:06', NULL),
(6, 'DA 234 GGT', 'F75602', 'LEXUS', 5, 4, '2019-10-09 07:54:04', '2019-10-03 14:58:02', NULL),
(7, 'VD 234 JJJ', 'A7A9AF', 'HYUNDAI', 5, 3, '2019-10-09 07:53:52', '2019-10-04 07:32:55', NULL),
(8, 'DE 355 EET', 'AF71D4', 'HONDA', 2, 3, '2019-10-09 07:53:41', '2019-10-04 07:47:40', NULL),
(9, 'GG 394 JJJ', 'FE7058', 'HYUNDAI', 7, 3, '2019-10-09 07:53:22', '2019-10-04 08:17:05', NULL),
(10, 'FF 349 KLU', '02215G', 'MAZDA', 4, 2, '2019-10-09 07:53:11', '2019-10-04 11:01:54', NULL),
(11, 'SS 237 KKK', '43327F', 'HONDA', 2, 2, '2019-10-09 07:49:51', '2019-10-04 11:11:30', NULL),
(12, 'AW 31 SDS', '675E1F', 'LEXUS', 2, 1, '2019-10-11 10:39:33', '2019-10-11 10:39:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_operators`
--

CREATE TABLE `vehicle_operators` (
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_operators`
--

INSERT INTO `vehicle_operators` (`operator_id`, `name`, `email`, `phone_number`, `route`, `vehicle_id`, `owner_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Operator 1', 'operator1@gmail.com', '09084746484', 'Oke Paadi, Awolowo, Apata Ibadan', 5, 5, '2019-10-04 08:12:51', '2019-10-04 07:26:16', NULL),
(3, 'Olamide Fola', 'operator3@gmail.com', '08137438222', 'Oke Itunu, Eleyele, Ashi', 7, 5, '2019-10-04 07:34:44', '2019-10-04 07:34:44', NULL),
(4, 'New Operator S', 'operator4@gmail.com', '08173843322', 'Ladoke, Makola, Bodija', 8, 2, '2019-10-11 11:02:39', '2019-10-04 07:48:31', NULL),
(5, 'Operator 6', 'operator6@gmail.com', '08134933322', 'Oke Paadi, Awolowo, Apata', 9, 7, '2019-10-04 08:17:50', '2019-10-04 08:17:50', NULL),
(6, 'Babajide Hamid', 'babajide@gmail.com', '08083737383', 'Oke Paadi, Awolowo, Apata Ibadan', 8, 2, '2019-10-11 11:06:24', '2019-10-11 10:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_owner`
--

CREATE TABLE `vehicle_owner` (
  `owner_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `owner_number` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_owner`
--

INSERT INTO `vehicle_owner` (`owner_id`, `name`, `email`, `phone_number`, `address`, `owner_number`, `updated_at`, `created_at`, `deleted_at`) VALUES
(2, 'New Owner', 'owner1@gmail.com', '09072281221', 'Lagos', 'FE0585', '2019-10-02 11:04:38', '2019-10-02 11:04:38', NULL),
(3, 'Goke Demmy', 'owner@gmail.com', '08917474664', 'Testing', 'BE7638', '2019-10-02 11:21:50', '2019-10-02 11:21:50', NULL),
(4, 'Adeola Sola', 'sola@gmail.com', '09072281299', 'Ladoke', '360D38', '2019-10-02 12:51:42', '2019-10-02 12:51:42', NULL),
(5, 'Adesina Taiwo Olajide', 'tolajide75@gmail.com', '09072281232', 'Sotomi Street', '7873A6', '2019-10-03 13:12:01', '2019-10-03 13:12:01', NULL),
(6, 'Goke Demmy', 'goke@gmail.com', '08086868666', 'Ibadan', '30732F', '2019-10-03 15:05:27', '2019-10-03 15:05:27', NULL),
(7, 'Owner 2', 'owner2@gmail.com', '09084636383', 'Bodija Estate', '7F19E2', '2019-10-04 08:16:27', '2019-10-04 08:16:27', NULL);

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
(1, 'Bus', NULL, '2019-09-30 06:49:09', '2019-08-30 08:56:46'),
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
-- Indexes for table `bulk_sms`
--
ALTER TABLE `bulk_sms`
  ADD PRIMARY KEY (`sms_id`);

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
-- Indexes for table `manifests`
--
ALTER TABLE `manifests`
  ADD PRIMARY KEY (`manifest_id`);

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
-- Indexes for table `negotiations`
--
ALTER TABLE `negotiations`
  ADD PRIMARY KEY (`negotiation_id`);

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
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`round_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `balance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bulk_sms`
--
ALTER TABLE `bulk_sms`
  MODIFY `sms_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fund_transfers`
--
ALTER TABLE `fund_transfers`
  MODIFY `fund_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `manifests`
--
ALTER TABLE `manifests`
  MODIFY `manifest_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `negotiations`
--
ALTER TABLE `negotiations`
  MODIFY `negotiation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `round_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicle_operators`
--
ALTER TABLE `vehicle_operators`
  MODIFY `operator_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_owner`
--
ALTER TABLE `vehicle_owner`
  MODIFY `owner_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
