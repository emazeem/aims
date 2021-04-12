-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 12:14 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aims`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_level_fours`
--

CREATE TABLE `acc_level_fours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code1` int(11) NOT NULL,
  `code2` int(11) NOT NULL,
  `code3` int(11) NOT NULL,
  `code4` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_code` char(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_level_ones`
--

CREATE TABLE `acc_level_ones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code1` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_level_threes`
--

CREATE TABLE `acc_level_threes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code1` int(11) NOT NULL,
  `code2` int(11) NOT NULL,
  `code3` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_level_twos`
--

CREATE TABLE `acc_level_twos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code1` int(11) NOT NULL,
  `code2` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\Department', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Testing Purposes\",\"head\":3},\"old\":{\"name\":\"Nothings\",\"head\":3}}', '2021-01-22 15:05:38', '2021-01-22 15:05:38'),
(2, 'default', 'updated', 'App\\Models\\Department', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"New Department\",\"head\":1},\"old\":{\"name\":\"we\",\"head\":1}}', '2021-01-22 15:06:43', '2021-01-22 15:06:43'),
(3, 'default', 'created', 'App\\Models\\Department', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"New Department\",\"head\":1}}', '2021-01-22 15:11:15', '2021-01-22 15:11:15'),
(4, 'default', 'updated', 'App\\Models\\Designation', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"department_id\":3,\"name\":\"Calibration Managers\",\"created_at\":\"2020-12-21T23:39:23.000000Z\",\"updated_at\":\"2021-01-22T15:23:37.000000Z\"},\"old\":{\"department_id\":3,\"name\":\"Calibration Manager\",\"created_at\":\"2020-12-21T23:39:23.000000Z\",\"updated_at\":\"2020-12-21T23:39:23.000000Z\"}}', '2021-01-22 15:23:37', '2021-01-22 15:23:37'),
(5, 'default', 'updated', 'App\\Models\\Designation', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Software Developer\"},\"old\":{\"name\":\"Senior Software Developer\"}}', '2021-01-22 15:25:07', '2021-01-22 15:25:07'),
(6, 'default', 'updated', 'App\\Models\\Asset', 213, 'App\\Models\\User', 1, '{\"attributes\":{\"location\":\"lab1\",\"due\":\"1901-01-01\"},\"old\":{\"location\":\"AIMS Cal Lab1\",\"due\":\"1900-01-01\"}}', '2021-01-22 15:35:07', '2021-01-22 15:35:07'),
(7, 'default', 'created', 'App\\Models\\Attendance', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-01-22\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"21:32:42\",\"check_out\":\"21:32:42\",\"day\":\"Fri\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-01-22 16:32:42', '2021-01-22 16:32:42'),
(8, 'default', 'updated', 'App\\Models\\Menu', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":2}}', '2021-01-23 06:59:46', '2021-01-23 06:59:46'),
(9, 'default', 'updated', 'App\\Models\\Menu', 92, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":5}}', '2021-01-23 06:59:55', '2021-01-23 06:59:55'),
(10, 'default', 'updated', 'App\\Models\\Menu', 93, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":3},\"old\":{\"position\":7}}', '2021-01-23 07:00:08', '2021-01-23 07:00:08'),
(11, 'default', 'updated', 'App\\Models\\Menu', 138, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":4},\"old\":{\"position\":9}}', '2021-01-23 07:00:26', '2021-01-23 07:00:26'),
(12, 'default', 'updated', 'App\\Models\\Menu', 95, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":5},\"old\":{\"position\":10}}', '2021-01-23 07:00:38', '2021-01-23 07:00:38'),
(13, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":6},\"old\":{\"position\":11}}', '2021-01-23 07:00:48', '2021-01-23 07:00:48'),
(14, 'default', 'updated', 'App\\Models\\Menu', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":7},\"old\":{\"position\":12}}', '2021-01-23 07:01:00', '2021-01-23 07:01:00'),
(15, 'default', 'updated', 'App\\Models\\Menu', 68, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":8},\"old\":{\"position\":15}}', '2021-01-23 07:01:18', '2021-01-23 07:01:18'),
(16, 'default', 'updated', 'App\\Models\\Menu', 139, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":9},\"old\":{\"position\":100}}', '2021-01-23 07:01:33', '2021-01-23 07:01:33'),
(17, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":11},\"old\":{\"position\":101}}', '2021-01-23 07:01:50', '2021-01-23 07:01:50'),
(18, 'default', 'updated', 'App\\Models\\Menu', 131, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":12},\"old\":{\"position\":106}}', '2021-01-23 07:02:04', '2021-01-23 07:02:04'),
(19, 'default', 'updated', 'App\\Models\\Menu', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":13},\"old\":{\"position\":7}}', '2021-01-23 07:02:44', '2021-01-23 07:02:44'),
(20, 'default', 'updated', 'App\\Models\\Customer', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhamad Asif Javed,Miss Nitasha Naseer,Khalil ur Rehman\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Muhamad Asif Javed\",\"updated_at\":\"2020-11-25T20:06:39.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(21, 'default', 'updated', 'App\\Models\\Customer', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr. Adnan,Moin Ul Haq,Adnan Siddiqui\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr. Adnan\",\"updated_at\":\"2020-10-23T22:18:02.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(22, 'default', 'updated', 'App\\Models\\Customer', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Ilyas,Mr.Tanveer\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Ilyas\",\"updated_at\":\"2020-10-22T22:17:04.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(23, 'default', 'updated', 'App\\Models\\Customer', 1006, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Nabeel Ahmed,Mr.Rab nawaz\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Nabeel Ahmed\",\"updated_at\":\"2020-11-01T04:32:22.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(24, 'default', 'updated', 'App\\Models\\Customer', 1008, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Ms Arooj Fatima,Ms.Javaria Ali,Shahid Mehmod Din\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Ms Arooj Fatima\",\"updated_at\":\"2020-10-18T10:18:06.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(25, 'default', 'updated', 'App\\Models\\Customer', 1010, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Salma Khalid,Ms.Aqsa Khalid\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Salma Khalid\",\"updated_at\":\"2020-10-23T22:45:32.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(26, 'default', 'updated', 'App\\Models\\Customer', 1014, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Irtaza Gillani,Mehfooz Ur Rehman,Wasif Ali Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Irtaza Gillani\",\"updated_at\":\"2020-10-19T22:24:53.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(27, 'default', 'updated', 'App\\Models\\Customer', 1016, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"M.Wasif,Irfan Hameed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"M.Wasif\",\"updated_at\":\"2020-10-23T22:13:49.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(28, 'default', 'updated', 'App\\Models\\Customer', 1018, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mazher Mahmod Khalid,Sadiq Usmani\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mazher Mahmod Khalid\",\"updated_at\":\"2020-10-25T22:31:07.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(29, 'default', 'updated', 'App\\Models\\Customer', 1020, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"M.Salman,Inzamam Raja,Mr.Usman\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"M.Salman\",\"updated_at\":\"2020-10-18T12:28:38.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(30, 'default', 'updated', 'App\\Models\\Customer', 1023, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shahid Hussain,Raheela Arshad,Farooq Sami\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Shahid Hussain\",\"updated_at\":\"2020-10-23T22:42:04.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(31, 'default', 'updated', 'App\\Models\\Customer', 1033, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Amna Rafiq,Tahir Iqbal,Mr Mansoor\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Amna Rafiq\",\"updated_at\":\"2020-10-18T12:05:43.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(32, 'default', 'updated', 'App\\Models\\Customer', 1034, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"M.Wajid,Irfan Amanat,Mr.Abdullah\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"M.Wajid\",\"updated_at\":\"2020-10-26T22:39:04.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(33, 'default', 'updated', 'App\\Models\\Customer', 1041, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Sarhan Ikhlaq,M.Kaleem\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Sarhan Ikhlaq\",\"updated_at\":\"2020-10-23T22:16:11.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(34, 'default', 'updated', 'App\\Models\\Customer', 1046, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mohsin Siddique,Mazhar Mahmod Khalid\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mohsin Siddique\",\"updated_at\":\"2020-10-16T12:07:37.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(35, 'default', 'updated', 'App\\Models\\Customer', 1049, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"M.Shahzad Ahmed,Masood Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"M.Shahzad Ahmed\",\"updated_at\":\"2020-12-08T16:47:32.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(36, 'default', 'updated', 'App\\Models\\Customer', 1051, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Khurram Javed,Komal Sajid\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Khurram Javed\",\"updated_at\":\"2020-10-16T22:28:47.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(37, 'default', 'updated', 'App\\Models\\Customer', 1057, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shakeel Ahmed,Mohsin Hanif\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Shakeel Ahmed\",\"updated_at\":\"2020-10-18T10:21:55.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(38, 'default', 'updated', 'App\\Models\\Customer', 1063, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shahid Javed,M.Naveed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Shahid Javed\",\"updated_at\":\"2020-10-23T22:02:53.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(39, 'default', 'updated', 'App\\Models\\Customer', 1064, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Khayyam Hussain,Mr.Rajab\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Khayyam Hussain\",\"updated_at\":\"2020-10-26T23:00:01.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(40, 'default', 'updated', 'App\\Models\\Customer', 1072, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Abu Zar,Ahsan Raza\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Abu Zar\",\"updated_at\":\"2020-10-25T22:55:33.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(41, 'default', 'updated', 'App\\Models\\Customer', 1075, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr Farooq Ahmed,Usman Tariq\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr Farooq Ahmed\",\"updated_at\":\"2020-10-23T22:46:50.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(42, 'default', 'updated', 'App\\Models\\Customer', 1076, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Zahid Mehmood,Abdul Rehman\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Zahid Mehmood\",\"updated_at\":\"2020-10-25T22:04:51.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(43, 'default', 'updated', 'App\\Models\\Customer', 1078, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Syed Inayat Ali Shah,Saira Tariq\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Syed Inayat Ali Shah\",\"updated_at\":\"2020-10-23T21:56:51.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(44, 'default', 'updated', 'App\\Models\\Customer', 1080, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Ghulam Murtaza,Muhammad Naeem\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Ghulam Murtaza\",\"updated_at\":\"2020-10-28T22:49:52.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(45, 'default', 'updated', 'App\\Models\\Customer', 1081, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shamsuddin,Mr.Ahmed Jawad Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Shamsuddin\",\"updated_at\":\"2020-10-16T22:23:47.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(46, 'default', 'updated', 'App\\Models\\Customer', 1083, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Asif,Mr.Ali Raza\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Asif\",\"updated_at\":\"2020-10-25T22:26:09.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(47, 'default', 'updated', 'App\\Models\\Customer', 1091, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Sarhan Akhlaq,Tassadaq Hussain\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Sarhan Akhlaq\",\"updated_at\":\"2020-10-17T07:44:01.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(48, 'default', 'updated', 'App\\Models\\Customer', 1093, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Imtiaz Mehmood,Haider Ali\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Imtiaz Mehmood\",\"updated_at\":\"2020-10-18T10:00:01.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(49, 'default', 'updated', 'App\\Models\\Customer', 1098, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Ali Mir,Shahbaz Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Ali Mir\",\"updated_at\":\"2020-10-23T22:24:21.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(50, 'default', 'updated', 'App\\Models\\Customer', 1099, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Khalid,Waseem Dilawar\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Khalid\",\"updated_at\":\"2020-10-23T22:39:39.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(51, 'default', 'updated', 'App\\Models\\Customer', 1104, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Irfan Amanat,Taimoor Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Irfan Amanat\",\"updated_at\":\"2020-10-26T22:44:48.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(52, 'default', 'updated', 'App\\Models\\Customer', 1108, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Dr.Shoaib,Dr.Nazia Aslam\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Dr.Shoaib\",\"updated_at\":\"2020-10-19T22:27:54.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(53, 'default', 'updated', 'App\\Models\\Customer', 1111, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Jasim Hassan(MCME),Mr.Venus Fernadez\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Jasim Hassan(MCME)\",\"updated_at\":\"2020-10-26T22:29:06.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(54, 'default', 'updated', 'App\\Models\\Customer', 1116, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Zafar Mahmood,Malik Rehan Ahmed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Zafar Mahmood\",\"updated_at\":\"2020-10-22T22:26:24.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(55, 'default', 'updated', 'App\\Models\\Customer', 1117, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Zaka Niazi,Saeed Akbaar,Shahid Munir\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Zaka Niazi\",\"updated_at\":\"2020-10-25T22:45:55.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(56, 'default', 'updated', 'App\\Models\\Customer', 1123, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Chemist,Bukhtiar Mazher\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Chemist\",\"updated_at\":\"2020-10-28T22:51:44.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(57, 'default', 'updated', 'App\\Models\\Customer', 1133, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Mr.Talha Qudussi,Mr.Qadussi\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Mr.Talha Qudussi\",\"updated_at\":\"2020-10-25T22:32:29.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(58, 'default', 'updated', 'App\\Models\\Customer', 1145, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Furqan Shaukat,Zeeshan Rasheed,Maheen Manzoor\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Furqan Shaukat\",\"updated_at\":\"2020-12-06T18:59:27.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(59, 'default', 'updated', 'App\\Models\\Customer', 1146, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Altaf Hussain,Shaukat Ali,Naseer Malik\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Altaf Hussain\",\"updated_at\":\"2020-12-06T18:54:19.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(60, 'default', 'updated', 'App\\Models\\Customer', 1147, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Qamar Mehdi,Saba Nazir,Muhammad Azhar\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Qamar Mehdi\",\"updated_at\":\"2020-12-06T18:45:20.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(61, 'default', 'updated', 'App\\Models\\Customer', 1149, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Ramiz Ahmed,Ramiz Ahmed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Ramiz Ahmed\",\"updated_at\":\"2020-12-06T18:38:54.000000Z\"}}', '2021-01-23 09:01:08', '2021-01-23 09:01:08'),
(62, 'default', 'updated', 'App\\Models\\Customer', 1150, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Tasleem Hussain,Omer Baig,Shahid Mehmood\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"},\"old\":{\"prin_name_1\":\"Tasleem Hussain\",\"updated_at\":\"2020-12-06T18:35:59.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(63, 'default', 'updated', 'App\\Models\\Customer', 1151, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Sohail Bashir,Faisal Shabbir\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Sohail Bashir\",\"updated_at\":\"2020-12-06T18:30:36.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(64, 'default', 'updated', 'App\\Models\\Customer', 1155, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Atiq,Masood Haider\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Atiq\",\"updated_at\":\"2020-12-06T18:05:14.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(65, 'default', 'updated', 'App\\Models\\Customer', 1156, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Adeel Ahmed,Majid Mehmood\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Adeel Ahmed\",\"updated_at\":\"2020-12-06T18:03:07.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(66, 'default', 'updated', 'App\\Models\\Customer', 1158, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Inayat Ullah,Ahmed Raza\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Inayat Ullah\",\"updated_at\":\"2020-12-06T17:14:33.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(67, 'default', 'updated', 'App\\Models\\Customer', 1159, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Maqsood-ul-Hassan,Saqib Raza\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Maqsood-ul-Hassan\",\"updated_at\":\"2021-01-10T01:50:20.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(68, 'default', 'updated', 'App\\Models\\Customer', 1160, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Aqsa Akhtar,Arooj Bukhat,Dr. Nabeel\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Aqsa Akhtar\",\"updated_at\":\"2020-12-06T17:06:17.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(69, 'default', 'updated', 'App\\Models\\Customer', 1161, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Khuda e Nazar,Kashif Khan,Manzoor Hussain\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Khuda e Nazar\",\"updated_at\":\"2020-12-04T20:33:43.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(70, 'default', 'updated', 'App\\Models\\Customer', 1162, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Sajeel Zulifqar,Muhammad Kalim Khan\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Sajeel Zulifqar\",\"updated_at\":\"2020-12-04T20:29:58.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(71, 'default', 'updated', 'App\\Models\\Customer', 1163, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Salma Khalid,Asif Iqbal\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Salma Khalid\",\"updated_at\":\"2020-12-04T20:25:10.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(72, 'default', 'updated', 'App\\Models\\Customer', 1164, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Adnan Hussain,Dr. Zeeshiar Husnain,Muhammad Haris\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Adnan Hussain\",\"updated_at\":\"2020-12-04T20:20:02.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(73, 'default', 'updated', 'App\\Models\\Customer', 1165, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Ejaz Ahmed,Muhammad Basit Azeem\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Ejaz Ahmed\",\"updated_at\":\"2020-12-04T20:14:23.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(74, 'default', 'updated', 'App\\Models\\Customer', 1168, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Ahmed,Muhammad Ahmed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Ahmed\",\"updated_at\":\"2020-12-04T20:07:09.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(75, 'default', 'updated', 'App\\Models\\Customer', 1174, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Nadeem Akram,Muhammad Mansha\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Nadeem Akram\",\"updated_at\":\"2020-11-01T01:57:41.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(76, 'default', 'updated', 'App\\Models\\Customer', 1175, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Ijaz,Haq Nawaz,Mansoor Ahmed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Ijaz\",\"updated_at\":\"2020-12-02T20:32:44.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(77, 'default', 'updated', 'App\\Models\\Customer', 1176, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Zafar Mahmood,Riaz Hussain,Malik Rehan Ahmed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Zafar Mahmood\",\"updated_at\":\"2020-12-02T20:29:13.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(78, 'default', 'updated', 'App\\Models\\Customer', 1177, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shizwan Shaukat,Khalid Mehmood\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Shizwan Shaukat\",\"updated_at\":\"2020-12-02T20:10:39.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(79, 'default', 'updated', 'App\\Models\\Customer', 1178, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Waseem Afzal,Akhtar Ali,Engr. Naeem Ahmed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Waseem Afzal\",\"updated_at\":\"2020-12-02T20:00:42.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(80, 'default', 'updated', 'App\\Models\\Customer', 1179, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Khalid,Faisal Siddiqui,Naeem Sb\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Khalid\",\"updated_at\":\"2020-12-02T19:55:19.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(81, 'default', 'updated', 'App\\Models\\Customer', 1181, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Syed Farjad Hussain,Muhammad Omer\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Syed Farjad Hussain\",\"updated_at\":\"2020-12-02T19:47:23.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(82, 'default', 'updated', 'App\\Models\\Customer', 1182, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Izhar Ahmed Awan,Mohsin Naeem\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Izhar Ahmed Awan\",\"updated_at\":\"2020-12-02T19:44:32.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(83, 'default', 'updated', 'App\\Models\\Customer', 1183, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"M.Kashif,Shahid Rafiq,Amir Sultan Rana\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"M.Kashif\",\"updated_at\":\"2020-12-02T19:41:50.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(84, 'default', 'updated', 'App\\Models\\Customer', 1185, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Ammar Shakeel,Azhar Ali Hashmat,M. Ibrahim Sabir\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Ammar Shakeel\",\"updated_at\":\"2020-12-02T19:37:23.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(85, 'default', 'updated', 'App\\Models\\Customer', 1186, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shafqat Ullah,Mr. Azher Uddin Khan,Nasir Mehmood\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Shafqat Ullah\",\"updated_at\":\"2020-12-02T19:33:59.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(86, 'default', 'updated', 'App\\Models\\Customer', 1187, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Asif Iqbal,Salma Khalid,Fawad Iqbal\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Asif Iqbal\",\"updated_at\":\"2020-12-02T19:22:49.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(87, 'default', 'updated', 'App\\Models\\Customer', 1188, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Dr. Irfan,Muhammad Asif,Ayyaz Ashraf\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Dr. Irfan\",\"updated_at\":\"2020-12-02T19:10:27.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(88, 'default', 'updated', 'App\\Models\\Customer', 1189, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Syed Kazim Ali,Nadim Abrar\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Syed Kazim Ali\",\"updated_at\":\"2020-12-01T18:23:01.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(89, 'default', 'updated', 'App\\Models\\Customer', 1190, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shahid Mehmood,Muhammad Hafeez\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Shahid Mehmood\",\"updated_at\":\"2020-12-01T18:03:29.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(90, 'default', 'updated', 'App\\Models\\Customer', 1191, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Adeel Afzal,Mumtaz Ur Rehman,Nohman Mahmud\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Adeel Afzal\",\"updated_at\":\"2021-01-10T01:33:58.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(91, 'default', 'updated', 'App\\Models\\Customer', 1192, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Zia ur Rehman,Sadia Abrar\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Zia ur Rehman\",\"updated_at\":\"2020-11-26T18:37:41.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(92, 'default', 'updated', 'App\\Models\\Customer', 1193, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Asim Chief Engineer,Rameez Hassan\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Asim Chief Engineer\",\"updated_at\":\"2021-01-14T04:01:37.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(93, 'default', 'updated', 'App\\Models\\Customer', 1195, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Abid Ali Shah,Haris Rana HR,Tariq Javeed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Abid Ali Shah\",\"updated_at\":\"2020-11-25T20:27:26.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(94, 'default', 'updated', 'App\\Models\\Customer', 1196, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Sarfraz Ahmed,Sajid Habib\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Sarfraz Ahmed\",\"updated_at\":\"2020-11-25T20:24:08.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(95, 'default', 'updated', 'App\\Models\\Customer', 1198, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Waseem Afzal,Amir Zafar,Muhammad Saeed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Waseem Afzal\",\"updated_at\":\"2020-11-25T20:19:23.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(96, 'default', 'updated', 'App\\Models\\Customer', 1199, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Shizwan Shaukat,Khalid Javeed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Shizwan Shaukat\",\"updated_at\":\"2020-11-25T20:15:15.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(97, 'default', 'updated', 'App\\Models\\Customer', 1200, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_1\":\"Muhammad Shafique,Ijaz Hussain\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"},\"old\":{\"prin_name_1\":\"Muhammad Shafique\",\"updated_at\":\"2020-11-25T20:12:32.000000Z\"}}', '2021-01-23 09:01:09', '2021-01-23 09:01:09'),
(98, 'default', 'updated', 'App\\Models\\Customer', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Miss Nitasha Naseer\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(99, 'default', 'updated', 'App\\Models\\Customer', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Moin Ul Haq\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(100, 'default', 'updated', 'App\\Models\\Customer', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Tanveer\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(101, 'default', 'updated', 'App\\Models\\Customer', 1006, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Rab nawaz\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(102, 'default', 'updated', 'App\\Models\\Customer', 1008, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Ms.Javaria Ali\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(103, 'default', 'updated', 'App\\Models\\Customer', 1010, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Ms.Aqsa Khalid\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(104, 'default', 'updated', 'App\\Models\\Customer', 1014, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mehfooz Ur Rehman\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(105, 'default', 'updated', 'App\\Models\\Customer', 1016, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Irfan Hameed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(106, 'default', 'updated', 'App\\Models\\Customer', 1018, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Sadiq Usmani\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(107, 'default', 'updated', 'App\\Models\\Customer', 1020, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Inzamam Raja\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(108, 'default', 'updated', 'App\\Models\\Customer', 1023, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Raheela Arshad\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(109, 'default', 'updated', 'App\\Models\\Customer', 1033, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Tahir Iqbal\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(110, 'default', 'updated', 'App\\Models\\Customer', 1034, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Irfan Amanat\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(111, 'default', 'updated', 'App\\Models\\Customer', 1041, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"M.Kaleem\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(112, 'default', 'updated', 'App\\Models\\Customer', 1046, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mazhar Mahmod Khalid\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(113, 'default', 'updated', 'App\\Models\\Customer', 1049, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Masood Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(114, 'default', 'updated', 'App\\Models\\Customer', 1051, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Komal Sajid\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(115, 'default', 'updated', 'App\\Models\\Customer', 1057, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mohsin Hanif\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(116, 'default', 'updated', 'App\\Models\\Customer', 1063, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"M.Naveed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(117, 'default', 'updated', 'App\\Models\\Customer', 1064, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Rajab\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(118, 'default', 'updated', 'App\\Models\\Customer', 1072, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Ahsan Raza\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(119, 'default', 'updated', 'App\\Models\\Customer', 1075, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Usman Tariq\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(120, 'default', 'updated', 'App\\Models\\Customer', 1076, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Abdul Rehman\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(121, 'default', 'updated', 'App\\Models\\Customer', 1078, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Saira Tariq\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(122, 'default', 'updated', 'App\\Models\\Customer', 1080, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Naeem\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(123, 'default', 'updated', 'App\\Models\\Customer', 1081, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Ahmed Jawad Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(124, 'default', 'updated', 'App\\Models\\Customer', 1083, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Ali Raza\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(125, 'default', 'updated', 'App\\Models\\Customer', 1091, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Tassadaq Hussain\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(126, 'default', 'updated', 'App\\Models\\Customer', 1093, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Haider Ali\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(127, 'default', 'updated', 'App\\Models\\Customer', 1098, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Shahbaz Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(128, 'default', 'updated', 'App\\Models\\Customer', 1099, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Waseem Dilawar\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(129, 'default', 'updated', 'App\\Models\\Customer', 1104, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Taimoor Khan\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(130, 'default', 'updated', 'App\\Models\\Customer', 1108, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Dr.Nazia Aslam\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(131, 'default', 'updated', 'App\\Models\\Customer', 1111, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Venus Fernadez\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(132, 'default', 'updated', 'App\\Models\\Customer', 1116, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Malik Rehan Ahmed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(133, 'default', 'updated', 'App\\Models\\Customer', 1117, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Saeed Akbaar\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(134, 'default', 'updated', 'App\\Models\\Customer', 1123, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Bukhtiar Mazher\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(135, 'default', 'updated', 'App\\Models\\Customer', 1133, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr.Qadussi\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(136, 'default', 'updated', 'App\\Models\\Customer', 1145, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Zeeshan Rasheed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(137, 'default', 'updated', 'App\\Models\\Customer', 1146, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Shaukat Ali\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(138, 'default', 'updated', 'App\\Models\\Customer', 1147, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Saba Nazir\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(139, 'default', 'updated', 'App\\Models\\Customer', 1149, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Ramiz Ahmed\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(140, 'default', 'updated', 'App\\Models\\Customer', 1150, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Omer Baig\",\"updated_at\":\"2021-01-23T09:01:08.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(141, 'default', 'updated', 'App\\Models\\Customer', 1151, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Faisal Shabbir\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(142, 'default', 'updated', 'App\\Models\\Customer', 1155, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Masood Haider\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(143, 'default', 'updated', 'App\\Models\\Customer', 1156, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Majid Mehmood\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(144, 'default', 'updated', 'App\\Models\\Customer', 1158, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Ahmed Raza\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(145, 'default', 'updated', 'App\\Models\\Customer', 1159, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Saqib Raza\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(146, 'default', 'updated', 'App\\Models\\Customer', 1160, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Arooj Bukhat\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(147, 'default', 'updated', 'App\\Models\\Customer', 1161, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Kashif Khan\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(148, 'default', 'updated', 'App\\Models\\Customer', 1162, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Kalim Khan\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(149, 'default', 'updated', 'App\\Models\\Customer', 1163, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Asif Iqbal\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(150, 'default', 'updated', 'App\\Models\\Customer', 1164, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Dr. Zeeshiar Husnain\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(151, 'default', 'updated', 'App\\Models\\Customer', 1165, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Basit Azeem\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(152, 'default', 'updated', 'App\\Models\\Customer', 1168, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Ahmed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(153, 'default', 'updated', 'App\\Models\\Customer', 1174, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Mansha\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(154, 'default', 'updated', 'App\\Models\\Customer', 1175, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Haq Nawaz\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(155, 'default', 'updated', 'App\\Models\\Customer', 1176, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Riaz Hussain\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(156, 'default', 'updated', 'App\\Models\\Customer', 1177, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Khalid Mehmood\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(157, 'default', 'updated', 'App\\Models\\Customer', 1178, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Akhtar Ali\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(158, 'default', 'updated', 'App\\Models\\Customer', 1179, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Faisal Siddiqui\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(159, 'default', 'updated', 'App\\Models\\Customer', 1181, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Omer\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(160, 'default', 'updated', 'App\\Models\\Customer', 1182, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mohsin Naeem\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(161, 'default', 'updated', 'App\\Models\\Customer', 1183, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Shahid Rafiq\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(162, 'default', 'updated', 'App\\Models\\Customer', 1185, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Azhar Ali Hashmat\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(163, 'default', 'updated', 'App\\Models\\Customer', 1186, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mr. Azher Uddin Khan\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(164, 'default', 'updated', 'App\\Models\\Customer', 1187, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Salma Khalid\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(165, 'default', 'updated', 'App\\Models\\Customer', 1188, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Asif\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(166, 'default', 'updated', 'App\\Models\\Customer', 1189, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Nadim Abrar\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(167, 'default', 'updated', 'App\\Models\\Customer', 1190, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Muhammad Hafeez\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:54', '2021-01-23 09:01:54'),
(168, 'default', 'updated', 'App\\Models\\Customer', 1191, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:54.000000Z\"},\"old\":{\"prin_name_2\":\"Mumtaz Ur Rehman\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(169, 'default', 'updated', 'App\\Models\\Customer', 1192, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Sadia Abrar\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(170, 'default', 'updated', 'App\\Models\\Customer', 1193, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Rameez Hassan\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(171, 'default', 'updated', 'App\\Models\\Customer', 1195, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Haris Rana HR\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(172, 'default', 'updated', 'App\\Models\\Customer', 1196, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Sajid Habib\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(173, 'default', 'updated', 'App\\Models\\Customer', 1198, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Amir Zafar\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(174, 'default', 'updated', 'App\\Models\\Customer', 1199, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Khalid Javeed\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(175, 'default', 'updated', 'App\\Models\\Customer', 1200, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_name_2\":null,\"updated_at\":\"2021-01-23T09:01:55.000000Z\"},\"old\":{\"prin_name_2\":\"Ijaz Hussain\",\"updated_at\":\"2021-01-23T09:01:09.000000Z\"}}', '2021-01-23 09:01:55', '2021-01-23 09:01:55'),
(176, 'default', 'updated', 'App\\Models\\Customer', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"asif.javed@pepsico.com,natasha.naseer@pepsico.com,khalilur.Rehman@pepsico.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"asif.javed@pepsico.com\",\"prin_email_2\":\"natasha.naseer@pepsico.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(177, 'default', 'updated', 'App\\Models\\Customer', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"null,Moin.ulHaque@sgs.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"null\",\"prin_email_2\":\"Moin.ulHaque@sgs.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(178, 'default', 'updated', 'App\\Models\\Customer', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Null,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Null\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(179, 'default', 'updated', 'App\\Models\\Customer', 1006, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"anabeel@sprint-pk.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"anabeel@sprint-pk.com\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(180, 'default', 'updated', 'App\\Models\\Customer', 1008, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Null,javaria@interloop.com.pk,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Null\",\"prin_email_2\":\"javaria@interloop.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(181, 'default', 'updated', 'App\\Models\\Customer', 1010, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"quality@gel-intl.org,GEL Pakistan <info@gel-inti.org>\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"quality@gel-intl.org\",\"prin_email_2\":\"GEL Pakistan <info@gel-inti.org>\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(182, 'default', 'updated', 'App\\Models\\Customer', 1014, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,qam@shaigan.com,Wasif Ali Khan procurement.local@shaigan.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"qam@shaigan.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(183, 'default', 'updated', 'App\\Models\\Customer', 1016, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Muhammad.Wasif@pepsico.com,irfan.hameed@pepsico.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Muhammad.Wasif@pepsico.com\",\"prin_email_2\":\"irfan.hameed@pepsico.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(184, 'default', 'updated', 'App\\Models\\Customer', 1018, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,vipflt@brain.net.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"vipflt@brain.net.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(185, 'default', 'updated', 'App\\Models\\Customer', 1020, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"salmannoor104@gmail.com,inzimam.raja@outlook.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"salmannoor104@gmail.com\",\"prin_email_2\":\"inzimam.raja@outlook.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(186, 'default', 'updated', 'App\\Models\\Customer', 1023, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"shahid.hussain@phlp-lab.com,raheelaarshad@primehealthlaboratories.com,shahiod.hussain@phip-lab.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"shahid.hussain@phlp-lab.com\",\"prin_email_2\":\"raheelaarshad@primehealthlaboratories.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(187, 'default', 'updated', 'App\\Models\\Customer', 1033, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"amna.rafique@pk.nestle.com,Tahir.Iqbal1@PK.nestle.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"amna.rafique@pk.nestle.com\",\"prin_email_2\":\"Tahir.Iqbal1@PK.nestle.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(188, 'default', 'updated', 'App\\Models\\Customer', 1034, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,irfan.amanat@genetics_Pharmaceuticals.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"irfan.amanat@genetics_Pharmaceuticals.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(189, 'default', 'updated', 'App\\Models\\Customer', 1041, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"sarhan.akhlaq@qarshi.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"sarhan.akhlaq@qarshi.com\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(190, 'default', 'updated', 'App\\Models\\Customer', 1049, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"qamanager-am5@artisticmilliners.com,masood-chem-eng@artisticmilliners\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"qamanager-am5@artisticmilliners.com\",\"prin_email_2\":\"masood-chem-eng@artisticmilliners\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(191, 'default', 'updated', 'App\\Models\\Customer', 1051, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"kjaved@coca-cola.com,ksajid@coca-cola.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"kjaved@coca-cola.com\",\"prin_email_2\":\"ksajid@coca-cola.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(192, 'default', 'updated', 'App\\Models\\Customer', 1057, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"mohsin.hanif@mpcl.com.pk,mohsin.hanif@mpcl.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"mohsin.hanif@mpcl.com.pk\",\"prin_email_2\":\"mohsin.hanif@mpcl.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(193, 'default', 'updated', 'App\\Models\\Customer', 1063, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"mshahid@nishatmills.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"mshahid@nishatmills.com\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(194, 'default', 'updated', 'App\\Models\\Customer', 1064, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"khayyamhussain@bunnysltd.com,khayyamhussain@bunnysltd.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"khayyamhussain@bunnysltd.com\",\"prin_email_2\":\"khayyamhussain@bunnysltd.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(195, 'default', 'updated', 'App\\Models\\Customer', 1072, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"gabuzar3@gmail.com,hybridstore123@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"gabuzar3@gmail.com\",\"prin_email_2\":\"hybridstore123@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(196, 'default', 'updated', 'App\\Models\\Customer', 1075, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Farooq.Ahmed@kohinoormills.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Farooq.Ahmed@kohinoormills.com\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(197, 'default', 'updated', 'App\\Models\\Customer', 1076, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"info@pdtrc.com.pk,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"info@pdtrc.com.pk\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(198, 'default', 'updated', 'App\\Models\\Customer', 1078, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"SyedInayatAli.Shah@frieslandcampina,Saira.Tariq@frieslandcampina.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"SyedInayatAli.Shah@frieslandcampina\",\"prin_email_2\":\"Saira.Tariq@frieslandcampina.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(199, 'default', 'updated', 'App\\Models\\Customer', 1080, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"naeembahriavipflight@hotmail.com,naeembahriavipflights@hotmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"naeembahriavipflight@hotmail.com\",\"prin_email_2\":\"naeembahriavipflights@hotmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(200, 'default', 'updated', 'App\\Models\\Customer', 1081, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(201, 'default', 'updated', 'App\\Models\\Customer', 1083, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"NIll,crestex@ctm.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"NIll\",\"prin_email_2\":\"crestex@ctm.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(202, 'default', 'updated', 'App\\Models\\Customer', 1091, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"sarhan.akhlaq@qarashi.com,mbl@qarashi.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"sarhan.akhlaq@qarashi.com\",\"prin_email_2\":\"mbl@qarashi.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(203, 'default', 'updated', 'App\\Models\\Customer', 1093, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"m_imtiaz@ppl.com.pk,BuHaider@ppl.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"m_imtiaz@ppl.com.pk\",\"prin_email_2\":\"BuHaider@ppl.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(204, 'default', 'updated', 'App\\Models\\Customer', 1098, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,Khan.shahbaz@pharmaceuticals.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"Khan.shahbaz@pharmaceuticals.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(205, 'default', 'updated', 'App\\Models\\Customer', 1099, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"khalid@pdhlabs.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"khalid@pdhlabs.com\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(206, 'default', 'updated', 'App\\Models\\Customer', 1104, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"irfan.amanat@genetics_pharmaceuticals.com,Taimoor.Khan@genetics_pharmaceuticals\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"irfan.amanat@genetics_pharmaceuticals.com\",\"prin_email_2\":\"Taimoor.Khan@genetics_pharmaceuticals\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(207, 'default', 'updated', 'App\\Models\\Customer', 1108, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,nazia.aslam@herbion.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"nazia.aslam@herbion.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(208, 'default', 'updated', 'App\\Models\\Customer', 1111, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"jasim.hassan@emirates.com,Nill\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"jasim.hassan@emirates.com\",\"prin_email_2\":\"Nill\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(209, 'default', 'updated', 'App\\Models\\Customer', 1116, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,ffl.planning@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"ffl.planning@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(210, 'default', 'updated', 'App\\Models\\Customer', 1117, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,zaka Niazi<zaka_ravian@yahoo.com>,shahidmunir@chashmasugarmills.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"zaka Niazi<zaka_ravian@yahoo.com>\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(211, 'default', 'updated', 'App\\Models\\Customer', 1123, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"chemistwasalhr@gmail.com,bakhtiarmazher@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"chemistwasalhr@gmail.com\",\"prin_email_2\":\"bakhtiarmazher@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(212, 'default', 'updated', 'App\\Models\\Customer', 1133, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"taha@hse.com.pk,taha@hse.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"taha@hse.com.pk\",\"prin_email_2\":\"taha@hse.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(213, 'default', 'updated', 'App\\Models\\Customer', 1145, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"furqan.shaukat@inspectest.com,zeeshan.rasheed@inspectest.com.pk,Maheen.Manzoor@inspectest.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"furqan.shaukat@inspectest.com\",\"prin_email_2\":\"zeeshan.rasheed@inspectest.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(214, 'default', 'updated', 'App\\Models\\Customer', 1146, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"labdhk@engro.com,shali@engroo.com,namalik@engroo.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"labdhk@engro.com\",\"prin_email_2\":\"shali@engroo.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(215, 'default', 'updated', 'App\\Models\\Customer', 1147, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"mqamar91@gmail.com,sabanazir.shah@gmail.com,mazhar@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"mqamar91@gmail.com\",\"prin_email_2\":\"sabanazir.shah@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(216, 'default', 'updated', 'App\\Models\\Customer', 1149, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"ramiz60711@gmail.com,nfo@transfab.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"ramiz60711@gmail.com\",\"prin_email_2\":\"nfo@transfab.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(217, 'default', 'updated', 'App\\Models\\Customer', 1150, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"info@tariqglass.com,info@tariqglass.com,shahid@tariqglass.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"info@tariqglass.com\",\"prin_email_2\":\"info@tariqglass.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(218, 'default', 'updated', 'App\\Models\\Customer', 1151, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"sbrain@gmail.com,faisalshabbir1025@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"sbrain@gmail.com\",\"prin_email_2\":\"faisalshabbir1025@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(219, 'default', 'updated', 'App\\Models\\Customer', 1155, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"qctf.pk@mtechintl.com,masood@mtechintl.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"qctf.pk@mtechintl.com\",\"prin_email_2\":\"masood@mtechintl.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(220, 'default', 'updated', 'App\\Models\\Customer', 1156, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"adeelahmed3008@gmail.com,majid@nes.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"adeelahmed3008@gmail.com\",\"prin_email_2\":\"majid@nes.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(221, 'default', 'updated', 'App\\Models\\Customer', 1158, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"qa.procon@mastertex.com,qc03.procon@mastertex.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"qa.procon@mastertex.com\",\"prin_email_2\":\"qc03.procon@mastertex.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(222, 'default', 'updated', 'App\\Models\\Customer', 1159, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"accounts@3wsystems.com,saqib@3wsystems.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"accounts@3wsystems.com\",\"prin_email_2\":\"saqib@3wsystems.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(223, 'default', 'updated', 'App\\Models\\Customer', 1160, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"aqsa.akhtar@safasumt.com,urooj.bakht@umt.edu.pk,\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"aqsa.akhtar@safasumt.com\",\"prin_email_2\":\"urooj.bakht@umt.edu.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(224, 'default', 'updated', 'App\\Models\\Customer', 1161, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"oclad208b@gmail.com,cae.79ec@gmail.com,\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"oclad208b@gmail.com\",\"prin_email_2\":\"cae.79ec@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(225, 'default', 'updated', 'App\\Models\\Customer', 1162, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"hvsclabibd@ntdc.com.pk,hvsclabfsd@ntdc.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"hvsclabibd@ntdc.com.pk\",\"prin_email_2\":\"hvsclabfsd@ntdc.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(226, 'default', 'updated', 'App\\Models\\Customer', 1163, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"quality@gel-intl.org,info@gel-intl.org\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"quality@gel-intl.org\",\"prin_email_2\":\"info@gel-intl.org\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(227, 'default', 'updated', 'App\\Models\\Customer', 1164, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"H_Adnan@ppl.com.pk,h_zeeshair@ppl.com.pk,M_Haris@ppl.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"H_Adnan@ppl.com.pk\",\"prin_email_2\":\"h_zeeshair@ppl.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(228, 'default', 'updated', 'App\\Models\\Customer', 1165, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"ejaz.ahmed@interloop.com.pk,basit.azeem@interloop.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"ejaz.ahmed@interloop.com.pk\",\"prin_email_2\":\"basit.azeem@interloop.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(229, 'default', 'updated', 'App\\Models\\Customer', 1168, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"aeronautical2010@gmail.com,muhammad.ahmed@etihad.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"aeronautical2010@gmail.com\",\"prin_email_2\":\"muhammad.ahmed@etihad.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(230, 'default', 'updated', 'App\\Models\\Customer', 1174, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"nadeem@eespak.com,mansha@eespak.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"nadeem@eespak.com\",\"prin_email_2\":\"mansha@eespak.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(231, 'default', 'updated', 'App\\Models\\Customer', 1175, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"m.ijaz@icsp.com.pk,haq.nawaz@icsp.com.pk,mansoor.ahmed@ics.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"m.ijaz@icsp.com.pk\",\"prin_email_2\":\"haq.nawaz@icsp.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(232, 'default', 'updated', 'App\\Models\\Customer', 1176, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"Nill,pflmfg.skeeper@fatima-group.com,rehan.ahmad@fatima-group.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"Nill\",\"prin_email_2\":\"pflmfg.skeeper@fatima-group.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(233, 'default', 'updated', 'App\\Models\\Customer', 1178, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"purchase.officer@ajcengg.pk,akhtar@ajcengg.pk,engr.naeem@ajcengg.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"purchase.officer@ajcengg.pk\",\"prin_email_2\":\"akhtar@ajcengg.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(234, 'default', 'updated', 'App\\Models\\Customer', 1179, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"khalid@hse.com.pk,faisal@hse.com.pk,naeem@hse.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"khalid@hse.com.pk\",\"prin_email_2\":\"faisal@hse.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(235, 'default', 'updated', 'App\\Models\\Customer', 1181, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"kashif.elahi@hotmail.com,mrmalik30@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:58.000000Z\"},\"old\":{\"prin_email_1\":\"kashif.elahi@hotmail.com\",\"prin_email_2\":\"mrmalik30@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:58', '2021-01-23 09:02:58'),
(236, 'default', 'updated', 'App\\Models\\Customer', 1182, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"izhar.ahmed@starcofans.com,mohsin.naeem@starcofans.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"izhar.ahmed@starcofans.com\",\"prin_email_2\":\"mohsin.naeem@starcofans.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(237, 'default', 'updated', 'App\\Models\\Customer', 1183, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"m.kashif414@gmail.com,shahid.rafique@transfopower.net,amir.sultan@transfopower.net\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"m.kashif414@gmail.com\",\"prin_email_2\":\"shahid.rafique@transfopower.net\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(238, 'default', 'updated', 'App\\Models\\Customer', 1185, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"ammar@stylersintl.com,azharhashmat@stylersintl.com,compliance@stylersintl.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"ammar@stylersintl.com\",\"prin_email_2\":\"azharhashmat@stylersintl.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(239, 'default', 'updated', 'App\\Models\\Customer', 1186, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"necnorth@nec.com.pk,necnorth@nec.com.pk,\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"necnorth@nec.com.pk\",\"prin_email_2\":\"necnorth@nec.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(240, 'default', 'updated', 'App\\Models\\Customer', 1187, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"info@gel-intl.org,quality@gel-intl.org,fawad@gel.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"info@gel-intl.org\",\"prin_email_2\":\"quality@gel-intl.org\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(241, 'default', 'updated', 'App\\Models\\Customer', 1188, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"irfan.ashiq@pfsa.gop.pk,pmusdi@gmail.com,pmusdi@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"irfan.ashiq@pfsa.gop.pk\",\"prin_email_2\":\"pmusdi@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(242, 'default', 'updated', 'App\\Models\\Customer', 1189, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"kazim.syed@cspl.com.pk,nadimibr@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"kazim.syed@cspl.com.pk\",\"prin_email_2\":\"nadimibr@gmail.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(243, 'default', 'updated', 'App\\Models\\Customer', 1190, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"shahid.mehmood@treetbike.com,muhammad.hafeez@treetbike.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"shahid.mehmood@treetbike.com\",\"prin_email_2\":\"muhammad.hafeez@treetbike.com\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(244, 'default', 'updated', 'App\\Models\\Customer', 1191, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"adeel.afzal@bestway.com.pk,electricalmcl@bestway.com.pk,qcmcl@bestway.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"adeel.afzal@bestway.com.pk\",\"prin_email_2\":\"electricalmcl@bestway.com.pk\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(245, 'default', 'updated', 'App\\Models\\Customer', 1192, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"zia4944@gmail.com,sadiaabrar11@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"zia4944@gmail.com\",\"prin_email_2\":\"sadiaabrar11@gmail.com\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(246, 'default', 'updated', 'App\\Models\\Customer', 1193, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"airborneengineering123@gmail.com,airborneengineering123@gmail.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"airborneengineering123@gmail.com\",\"prin_email_2\":\"airborneengineering123@gmail.com\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(247, 'default', 'updated', 'App\\Models\\Customer', 1195, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"abid-ali@centurypaper.com.pk,haris-rana@centurypaper.com.pk,bxp-qas@centurypaper.com.pk\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"abid-ali@centurypaper.com.pk\",\"prin_email_2\":\"haris-rana@centurypaper.com.pk\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(248, 'default', 'updated', 'App\\Models\\Customer', 1196, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"sarfraz.ahmad@dgcement.com,shabib@dgcement.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"sarfraz.ahmad@dgcement.com\",\"prin_email_2\":\"shabib@dgcement.com\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(249, 'default', 'updated', 'App\\Models\\Customer', 1198, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"purchase.officer@ajcengg.pk,azafar@ajceng.pk,m.saeed@ajcengg.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"purchase.officer@ajcengg.pk\",\"prin_email_2\":\"azafar@ajceng.pk\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(250, 'default', 'updated', 'App\\Models\\Customer', 1199, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_email_1\":\"shizwan.eplm061@gmail.com,elmetec@elmetecgroup.com\",\"prin_email_2\":null,\"updated_at\":\"2021-01-23T09:02:59.000000Z\"},\"old\":{\"prin_email_1\":\"shizwan.eplm061@gmail.com\",\"prin_email_2\":\"elmetec@elmetecgroup.com\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:02:59', '2021-01-23 09:02:59'),
(251, 'default', 'updated', 'App\\Models\\Customer', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-8116826,0301-0141196,03011126073\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-8116826\",\"prin_phone_2\":\"0301-0141196\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(252, 'default', 'updated', 'App\\Models\\Customer', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"03128203793,0322-8219035,0300-2600766\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"03128203793\",\"prin_phone_2\":\"0322-8219035\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(253, 'default', 'updated', 'App\\Models\\Customer', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0308-8885895,0333-4400306\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0308-8885895\",\"prin_phone_2\":\"0333-4400306\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(254, 'default', 'updated', 'App\\Models\\Customer', 1006, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-4017657,0300-8581631\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-4017657\",\"prin_phone_2\":\"0300-8581631\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(255, 'default', 'updated', 'App\\Models\\Customer', 1008, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"041-4360400,0303-7770256,0303-7110097\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"041-4360400\",\"prin_phone_2\":\"0303-7770256\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(256, 'default', 'updated', 'App\\Models\\Customer', 1010, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"+92-423-6681281,0301-6831909\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"+92-423-6681281\",\"prin_phone_2\":\"0301-6831909\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(257, 'default', 'updated', 'App\\Models\\Customer', 1014, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0303-5879861,0333-5302078,92-5133060-4(EXT:140)\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0303-5879861\",\"prin_phone_2\":\"0333-5302078\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(258, 'default', 'updated', 'App\\Models\\Customer', 1016, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0306-5346007,0303-6626500\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0306-5346007\",\"prin_phone_2\":\"0303-6626500\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(259, 'default', 'updated', 'App\\Models\\Customer', 1018, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"042-99220155,0300-4633979\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"042-99220155\",\"prin_phone_2\":\"0300-4633979\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(260, 'default', 'updated', 'App\\Models\\Customer', 1020, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0343-1497285,0323-1491929,0308-4442674\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0343-1497285\",\"prin_phone_2\":\"0323-1491929\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(261, 'default', 'updated', 'App\\Models\\Customer', 1023, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0333-0598136,051-8445004,0333-0598136\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0333-0598136\",\"prin_phone_2\":\"051-8445004\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(262, 'default', 'updated', 'App\\Models\\Customer', 1033, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0323-4321991,0321-4472734,0301-4699475\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0323-4321991\",\"prin_phone_2\":\"0321-4472734\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(263, 'default', 'updated', 'App\\Models\\Customer', 1034, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"03000222859,03000222390,0308-2221675\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"03000222859\",\"prin_phone_2\":\"03000222390\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(264, 'default', 'updated', 'App\\Models\\Customer', 1041, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0345-5871290,0345-5915360\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0345-5871290\",\"prin_phone_2\":\"0345-5915360\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(265, 'default', 'updated', 'App\\Models\\Customer', 1046, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0323-5060706,042-99220155\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0323-5060706\",\"prin_phone_2\":\"042-99220155\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(266, 'default', 'updated', 'App\\Models\\Customer', 1049, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0321-8290160,0321-82046651\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0321-8290160\",\"prin_phone_2\":\"0321-82046651\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(267, 'default', 'updated', 'App\\Models\\Customer', 1051, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-4018052,0309-8880505\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-4018052\",\"prin_phone_2\":\"0309-8880505\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(268, 'default', 'updated', 'App\\Models\\Customer', 1057, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-3612171,0332-0966326\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-3612171\",\"prin_phone_2\":\"0332-0966326\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(269, 'default', 'updated', 'App\\Models\\Customer', 1063, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-7255623,0300-4597776\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-7255623\",\"prin_phone_2\":\"0300-4597776\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(270, 'default', 'updated', 'App\\Models\\Customer', 1064, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-4820346,0336-4851971\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-4820346\",\"prin_phone_2\":\"0336-4851971\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(271, 'default', 'updated', 'App\\Models\\Customer', 1072, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0322-4256920,03054415173\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0322-4256920\",\"prin_phone_2\":\"03054415173\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(272, 'default', 'updated', 'App\\Models\\Customer', 1075, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0333-4998812,0333-4998854\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0333-4998812\",\"prin_phone_2\":\"0333-4998854\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(273, 'default', 'updated', 'App\\Models\\Customer', 1076, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0320-0840818,0320-0840695\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0320-0840818\",\"prin_phone_2\":\"0320-0840695\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(274, 'default', 'updated', 'App\\Models\\Customer', 1078, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-3544612,0304-0542426\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-3544612\",\"prin_phone_2\":\"0304-0542426\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(275, 'default', 'updated', 'App\\Models\\Customer', 1080, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0345-6216425,0334-0518852\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0345-6216425\",\"prin_phone_2\":\"0334-0518852\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(276, 'default', 'updated', 'App\\Models\\Customer', 1081, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-4370626,0334-4238867\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-4370626\",\"prin_phone_2\":\"0334-4238867\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(277, 'default', 'updated', 'App\\Models\\Customer', 1083, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-7403040,+92-41-111-105-105\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-7403040\",\"prin_phone_2\":\"+92-41-111-105-105\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(278, 'default', 'updated', 'App\\Models\\Customer', 1091, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"345-5871290,0345-9641116\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"345-5871290\",\"prin_phone_2\":\"0345-9641116\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(279, 'default', 'updated', 'App\\Models\\Customer', 1093, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"+92-3056611771,92-347-8365299\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"+92-3056611771\",\"prin_phone_2\":\"92-347-8365299\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(280, 'default', 'updated', 'App\\Models\\Customer', 1098, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0322-6869927,0322-8554042\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0322-6869927\",\"prin_phone_2\":\"0322-8554042\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(281, 'default', 'updated', 'App\\Models\\Customer', 1099, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0309-5553044,0323-5422576\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0309-5553044\",\"prin_phone_2\":\"0323-5422576\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(282, 'default', 'updated', 'App\\Models\\Customer', 1104, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-0222390,03247784778\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-0222390\",\"prin_phone_2\":\"03247784778\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(283, 'default', 'updated', 'App\\Models\\Customer', 1108, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0324-8288923,0321-8255353\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0324-8288923\",\"prin_phone_2\":\"0321-8255353\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(284, 'default', 'updated', 'App\\Models\\Customer', 1111, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"+971-50-676-7578,97142182395\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"+971-50-676-7578\",\"prin_phone_2\":\"97142182395\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(285, 'default', 'updated', 'App\\Models\\Customer', 1116, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-3730665,0302-8131265\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-3730665\",\"prin_phone_2\":\"0302-8131265\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(286, 'default', 'updated', 'App\\Models\\Customer', 1117, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0331-6095842,0331-6095842,0300-7734457\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0331-6095842\",\"prin_phone_2\":\"0331-6095842\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(287, 'default', 'updated', 'App\\Models\\Customer', 1123, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"042-37151369,0337-7809607\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"042-37151369\",\"prin_phone_2\":\"0337-7809607\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(288, 'default', 'updated', 'App\\Models\\Customer', 1133, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-3000347,0300-3000347\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-3000347\",\"prin_phone_2\":\"0300-3000347\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(289, 'default', 'updated', 'App\\Models\\Customer', 1145, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0321 848507,0321 8476720,0320 858 5334\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0321 848507\",\"prin_phone_2\":\"0321 8476720\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(290, 'default', 'updated', 'App\\Models\\Customer', 1146, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300 3198890,0333 7253758,0334 2545617\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300 3198890\",\"prin_phone_2\":\"0333 7253758\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(291, 'default', 'updated', 'App\\Models\\Customer', 1147, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0346 5314818,0322 5077527,0314 7365208\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0346 5314818\",\"prin_phone_2\":\"0322 5077527\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(292, 'default', 'updated', 'App\\Models\\Customer', 1149, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300 4900632,+92-42-36580379\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300 4900632\",\"prin_phone_2\":\"+92-42-36580379\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(293, 'default', 'updated', 'App\\Models\\Customer', 1150, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0308 5533778,0321 4466017\",\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0308 5533778\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(294, 'default', 'updated', 'App\\Models\\Customer', 1151, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"03219480378,+923008588232,3334898800\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"03219480378\",\"prin_phone_2\":\"+923008588232,3334898800\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(295, 'default', 'updated', 'App\\Models\\Customer', 1156, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0347 2249974,0321-2453581\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0347 2249974\",\"prin_phone_2\":\"0321-2453581\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(296, 'default', 'updated', 'App\\Models\\Customer', 1158, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0320 8585010,0316-9991918\\/0332-6626190\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0320 8585010\",\"prin_phone_2\":\"0316-9991918\\/0332-6626190\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(297, 'default', 'updated', 'App\\Models\\Customer', 1159, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0345 4003581,03009742608\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0345 4003581\",\"prin_phone_2\":\"03009742608\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(298, 'default', 'updated', 'App\\Models\\Customer', 1160, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"042 35968907 Ext. 2855,0323 4223010,0333 4353699\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"042 35968907 Ext. 2855\",\"prin_phone_2\":\"0323 4223010\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(299, 'default', 'updated', 'App\\Models\\Customer', 1161, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0320 9319897,0320 9319899,0305 8264929\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0320 9319897\",\"prin_phone_2\":\"0320 9319899\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(300, 'default', 'updated', 'App\\Models\\Customer', 1162, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300 5232151,0335-7402534\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300 5232151\",\"prin_phone_2\":\"0335-7402534\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(301, 'default', 'updated', 'App\\Models\\Customer', 1163, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0323 8473962,0345 4586958\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0323 8473962\",\"prin_phone_2\":\"0345 4586958\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(302, 'default', 'updated', 'App\\Models\\Customer', 1164, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"023 5813 062,+92 323 382 4172,0333-7838013\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"023 5813 062\",\"prin_phone_2\":\"+92 323 382 4172\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(303, 'default', 'updated', 'App\\Models\\Customer', 1165, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0301 8656965,+92 345 7683388, Ext: 6714\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0301 8656965\",\"prin_phone_2\":\"+92 345 7683388, Ext: 6714\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(304, 'default', 'updated', 'App\\Models\\Customer', 1168, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0333 6496070,+92 333 6496070\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0333 6496070\",\"prin_phone_2\":\"+92 333 6496070\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(305, 'default', 'updated', 'App\\Models\\Customer', 1175, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300 7364979,0300 6207989,300-7882561\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300 7364979\",\"prin_phone_2\":\"0300 6207989\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(306, 'default', 'updated', 'App\\Models\\Customer', 1176, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0333-7801340,0300 6336154,0302 8731265\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0333-7801340\",\"prin_phone_2\":\"0300 6336154\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(307, 'default', 'updated', 'App\\Models\\Customer', 1177, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"+92-42-3540-1771-75,0300 8191164\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"+92-42-3540-1771-75\",\"prin_phone_2\":\"0300 8191164\",\"updated_at\":\"2021-01-23T09:01:54.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(308, 'default', 'updated', 'App\\Models\\Customer', 1178, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0333-7356233,0300 8409114,0322 4979177\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0333-7356233\",\"prin_phone_2\":\"0300 8409114\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(309, 'default', 'updated', 'App\\Models\\Customer', 1179, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0322-8404846,0300 4893016\",\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0322-8404846\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(310, 'default', 'updated', 'App\\Models\\Customer', 1181, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0320-4791050,0344 4413331\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0320-4791050\",\"prin_phone_2\":\"0344 4413331\",\"updated_at\":\"2021-01-23T09:02:58.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(311, 'default', 'updated', 'App\\Models\\Customer', 1182, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0301-8720329,0323 7447277\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0301-8720329\",\"prin_phone_2\":\"0323 7447277\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(312, 'default', 'updated', 'App\\Models\\Customer', 1183, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0321-7684402,0346 4083193\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0321-7684402\",\"prin_phone_2\":\"0346 4083193\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(313, 'default', 'updated', 'App\\Models\\Customer', 1185, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0334-4595230,0300 7769965,03234438648, 03334569058\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0334-4595230\",\"prin_phone_2\":\"0300 7769965\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(314, 'default', 'updated', 'App\\Models\\Customer', 1186, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300 94820298,0300-8454061\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300 94820298\",\"prin_phone_2\":\"0300-8454061\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(315, 'default', 'updated', 'App\\Models\\Customer', 1187, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"042-36670097,0323 8473962,0300-0771340\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"042-36670097\",\"prin_phone_2\":\"0323 8473962\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(316, 'default', 'updated', 'App\\Models\\Customer', 1188, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0300-4167630,03218936855,03351715217\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0300-4167630\",\"prin_phone_2\":\"03218936855\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(317, 'default', 'updated', 'App\\Models\\Customer', 1191, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0310-3339298,+92 317 7700274,+92   322 5001998\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0310-3339298\",\"prin_phone_2\":\"+92 317 7700274\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(318, 'default', 'updated', 'App\\Models\\Customer', 1195, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"03364851732,0300 4000436,03113991041\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"03364851732\",\"prin_phone_2\":\"0300 4000436\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(319, 'default', 'updated', 'App\\Models\\Customer', 1196, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0323-7015907,03214099180\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0323-7015907\",\"prin_phone_2\":\"03214099180\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(320, 'default', 'updated', 'App\\Models\\Customer', 1198, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0333 7356233,0300 8416632,03004023449\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0333 7356233\",\"prin_phone_2\":\"0300 8416632\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(321, 'default', 'updated', 'App\\Models\\Customer', 1199, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"035401771,0300 8191164\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"035401771\",\"prin_phone_2\":\"0300 8191164\",\"updated_at\":\"2021-01-23T09:02:59.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(322, 'default', 'updated', 'App\\Models\\Customer', 1200, 'App\\Models\\User', 1, '{\"attributes\":{\"prin_phone_1\":\"0335 6111206,0304 0049025\",\"prin_phone_2\":null,\"updated_at\":\"2021-01-23T09:04:56.000000Z\"},\"old\":{\"prin_phone_1\":\"0335 6111206\",\"prin_phone_2\":\"0304 0049025\",\"updated_at\":\"2021-01-23T09:01:55.000000Z\"}}', '2021-01-23 09:04:56', '2021-01-23 09:04:56'),
(323, 'default', 'updated', 'App\\Models\\Attendance', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-01-23\",\"check_out\":\"19:01:44\",\"worked_hours\":43,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"21:32:42\",\"worked_hours\":0,\"status\":0}}', '2021-01-23 14:01:45', '2021-01-23 14:01:45'),
(324, 'default', 'created', 'App\\Models\\Attendance', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-01-23\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"19:06:49\",\"check_out\":\"19:06:49\",\"day\":\"Sat\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-01-23 14:06:49', '2021-01-23 14:06:49'),
(325, 'default', 'created', 'App\\Models\\Customer', 1212, 'App\\Models\\User', 1, '{\"attributes\":{\"reg_name\":\"Name of Customer\",\"ntn\":\"8904123\",\"region\":\"2\",\"address\":\"physical address\",\"credit_limit\":0,\"customer_type\":\"cash\",\"pay_terms\":\"against delivery\",\"prin_name_1\":null,\"prin_phone_1\":null,\"prin_email_1\":null,\"prin_name_2\":null,\"prin_phone_2\":null,\"prin_email_2\":null,\"prin_name_3\":null,\"prin_phone_3\":null,\"prin_email_3\":null,\"pur_name\":\"pur1\",\"pur_phone\":\"phon1,phone1\",\"pur_email\":\"email\",\"acc_name\":\"name1acc\",\"acc_phone\":\"accphonr,accphone\",\"acc_email\":\"email\",\"deleted_at\":null,\"created_at\":\"2021-01-23T15:10:31.000000Z\",\"updated_at\":\"2021-01-23T15:10:31.000000Z\"}}', '2021-01-23 15:10:31', '2021-01-23 15:10:31'),
(326, 'default', 'created', 'App\\Models\\Customer', 1213, 'App\\Models\\User', 1, '{\"attributes\":{\"reg_name\":\"Name\",\"ntn\":\"9023501\",\"region\":\"2\",\"address\":\"physical address\",\"credit_limit\":0,\"customer_type\":\"cash\",\"pay_terms\":\"advance\",\"prin_name_1\":null,\"prin_phone_1\":null,\"prin_email_1\":null,\"prin_name_2\":null,\"prin_phone_2\":null,\"prin_email_2\":null,\"prin_name_3\":null,\"prin_phone_3\":null,\"prin_email_3\":null,\"pur_name\":null,\"pur_phone\":null,\"pur_email\":null,\"acc_name\":null,\"acc_phone\":null,\"acc_email\":null,\"deleted_at\":null,\"created_at\":\"2021-01-23T15:11:11.000000Z\",\"updated_at\":\"2021-01-23T15:11:11.000000Z\"}}', '2021-01-23 15:11:11', '2021-01-23 15:11:11'),
(327, 'default', 'created', 'App\\Models\\Customer', 1214, 'App\\Models\\User', 1, '{\"attributes\":{\"reg_name\":\"name\",\"ntn\":\"920349\",\"region\":\"2\",\"address\":\"physical\",\"credit_limit\":0,\"customer_type\":\"cash\",\"pay_terms\":\"advance\",\"prin_name_1\":null,\"prin_phone_1\":null,\"prin_email_1\":null,\"prin_name_2\":null,\"prin_phone_2\":null,\"prin_email_2\":null,\"prin_name_3\":null,\"prin_phone_3\":null,\"prin_email_3\":null,\"pur_name\":null,\"pur_phone\":null,\"pur_email\":null,\"acc_name\":null,\"acc_phone\":null,\"acc_email\":null,\"deleted_at\":null,\"created_at\":\"2021-01-23T15:19:14.000000Z\",\"updated_at\":\"2021-01-23T15:19:14.000000Z\"}}', '2021-01-23 15:19:14', '2021-01-23 15:19:14'),
(328, 'default', 'created', 'App\\Models\\Customer', 1215, 'App\\Models\\User', 1, '{\"attributes\":{\"reg_name\":\"name\",\"ntn\":\"ntn\",\"region\":\"2\",\"address\":\"physical address\",\"credit_limit\":0,\"customer_type\":\"cash\",\"pay_terms\":\"advance\",\"prin_name_1\":null,\"prin_phone_1\":null,\"prin_email_1\":null,\"prin_name_2\":null,\"prin_phone_2\":null,\"prin_email_2\":null,\"prin_name_3\":null,\"prin_phone_3\":null,\"prin_email_3\":null,\"pur_name\":null,\"pur_phone\":null,\"pur_email\":null,\"acc_name\":null,\"acc_phone\":null,\"acc_email\":null,\"deleted_at\":null,\"created_at\":\"2021-01-23T16:24:56.000000Z\",\"updated_at\":\"2021-01-23T16:24:56.000000Z\"}}', '2021-01-23 16:24:56', '2021-01-23 16:24:56'),
(329, 'default', 'created', 'App\\Models\\Customer', 1216, 'App\\Models\\User', 1, '{\"attributes\":{\"reg_name\":\"name\",\"ntn\":\"ntn\",\"region\":\"2\",\"address\":\"address\",\"credit_limit\":0,\"customer_type\":\"cash\",\"pay_terms\":\"against delivery\",\"prin_name_1\":null,\"prin_phone_1\":null,\"prin_email_1\":null,\"prin_name_2\":null,\"prin_phone_2\":null,\"prin_email_2\":null,\"prin_name_3\":null,\"prin_phone_3\":null,\"prin_email_3\":null,\"pur_name\":\"name\",\"pur_phone\":\"phone,phone2\",\"pur_email\":\"email\",\"acc_name\":\"name\",\"acc_phone\":\"phone,phone2\",\"acc_email\":\"email\",\"deleted_at\":null,\"created_at\":\"2021-01-23T16:43:44.000000Z\",\"updated_at\":\"2021-01-23T16:43:44.000000Z\"}}', '2021-01-23 16:43:44', '2021-01-23 16:43:44'),
(330, 'default', 'updated', 'App\\Models\\Attendance', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-01-24\",\"check_out\":\"10:51:43\",\"worked_hours\":34,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"19:06:49\",\"worked_hours\":0,\"status\":0}}', '2021-01-24 05:51:43', '2021-01-24 05:51:43'),
(331, 'default', 'created', 'App\\Models\\Attendance', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-01-24\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:51:52\",\"check_out\":\"10:51:52\",\"day\":\"Sun\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-01-24 05:51:52', '2021-01-24 05:51:52'),
(332, 'default', 'updated', 'App\\Models\\Attendance', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-01-24\",\"check_out\":\"10:52:03\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:51:52\",\"worked_hours\":0,\"status\":0}}', '2021-01-24 05:52:03', '2021-01-24 05:52:03'),
(333, 'default', 'created', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1159,\"type\":null,\"rfq_mode\":\"whatsapp\",\"rfq_mode_details\":\"93040647306\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Saqib Raza\",\"revision\":0}}', '2021-01-24 06:31:03', '2021-01-24 06:31:03'),
(334, 'default', 'created', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":1,\"capability\":1,\"not_available\":null,\"location\":\"site\",\"accredited\":\"yes\",\"range\":\"84~12880\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-01-24 06:31:20', '2021-01-24 06:31:20'),
(335, 'default', 'created', 'App\\Models\\Item', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":2,\"capability\":10,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"1~1000\",\"price\":2000,\"quantity\":1,\"rf_checks\":null}}', '2021-01-24 06:31:29', '2021-01-24 06:31:29'),
(336, 'default', 'created', 'App\\Models\\Item', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":3,\"capability\":206,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"140\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-01-24 06:31:39', '2021-01-24 06:31:39'),
(337, 'default', 'created', 'App\\Models\\Item', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":5,\"capability\":226,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"0~1100\",\"price\":2000,\"quantity\":1,\"rf_checks\":null}}', '2021-01-24 06:31:51', '2021-01-24 06:31:51'),
(338, 'default', 'updated', 'App\\Models\\Menu', 40, 'App\\Models\\User', 1, '{\"attributes\":{\"slug\":\"generate-requests-index\",\"url\":\"generate-requests\"},\"old\":{\"slug\":\"quote-index\",\"url\":\"\\/quotes\"}}', '2021-01-24 06:37:19', '2021-01-24 06:37:19'),
(339, 'default', 'created', 'App\\Models\\Menu', 154, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Generate Quotes\",\"slug\":\"quotes-index\",\"icon\":\"fa fa-\",\"status\":1,\"url\":\"quotes\",\"position\":126,\"parent_id\":\"138\",\"has_child\":1}}', '2021-01-24 06:37:56', '2021-01-24 06:37:56'),
(340, 'default', 'updated', 'App\\Models\\Role', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quotes-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"},\"old\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,quote-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"}}', '2021-01-24 06:40:03', '2021-01-24 06:40:03'),
(341, 'default', 'updated', 'App\\Models\\Menu', 154, 'App\\Models\\User', 1, '{\"attributes\":{\"slug\":\"quote-index\"},\"old\":{\"slug\":\"quotes-index\"}}', '2021-01-24 06:43:15', '2021-01-24 06:43:15'),
(342, 'default', 'updated', 'App\\Models\\Role', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"},\"old\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quotes-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"}}', '2021-01-24 06:44:36', '2021-01-24 06:44:36'),
(343, 'default', 'created', 'App\\Models\\Quotes', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1184,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"email@gmail.com\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Junaid Baig\",\"revision\":0}}', '2021-01-24 06:51:30', '2021-01-24 06:51:30'),
(344, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-01-24 06:54:42', '2021-01-24 06:54:42'),
(345, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-01-24 07:04:28', '2021-01-24 07:04:28'),
(346, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":3920},\"old\":{\"price\":4000}}', '2021-01-24 07:08:53', '2021-01-24 07:08:53'),
(347, 'default', 'updated', 'App\\Models\\Item', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":1960},\"old\":{\"price\":2000}}', '2021-01-24 07:08:53', '2021-01-24 07:08:53'),
(348, 'default', 'updated', 'App\\Models\\Item', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":2940},\"old\":{\"price\":3000}}', '2021-01-24 07:08:53', '2021-01-24 07:08:53'),
(349, 'default', 'updated', 'App\\Models\\Item', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":1960},\"old\":{\"price\":2000}}', '2021-01-24 07:08:53', '2021-01-24 07:08:53'),
(350, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2},\"old\":{\"status\":1}}', '2021-01-24 07:14:10', '2021-01-24 07:14:10'),
(351, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"SPLIT\",\"status\":3},\"old\":{\"type\":null,\"status\":2}}', '2021-01-24 07:14:49', '2021-01-24 07:14:49'),
(352, 'default', 'created', 'App\\Models\\Attendance', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-01-25\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:10:27\",\"check_out\":\"10:10:27\",\"day\":\"Mon\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-01-25 05:10:27', '2021-01-25 05:10:27'),
(353, 'default', 'updated', 'App\\Models\\Attendance', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-01-25\",\"check_out\":\"10:10:33\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:10:27\",\"worked_hours\":0,\"status\":0}}', '2021-01-25 05:10:33', '2021-01-25 05:10:33'),
(354, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-24T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-25T09:29:25.000000Z\",\"updated_at\":\"2021-01-25T09:29:25.000000Z\"}}', '2021-01-25 09:29:25', '2021-01-25 09:29:25'),
(355, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1250121\"},\"old\":{\"customize_id\":null}}', '2021-01-25 09:29:25', '2021-01-25 09:29:25'),
(356, 'default', 'created', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":1,\"code3\":1,\"acc_code\":\"\",\"title\":\"TEST FUEL\"}}', '2021-01-25 09:50:31', '2021-01-25 09:50:31'),
(357, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-01-25 09:50:31', '2021-01-25 09:50:31'),
(358, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"010101002\"},\"old\":{\"acc_code\":\"\"}}', '2021-01-25 09:50:31', '2021-01-25 09:50:31'),
(359, 'default', 'created', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-24T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-25T09:54:12.000000Z\",\"updated_at\":\"2021-01-25T09:54:12.000000Z\"}}', '2021-01-25 09:54:12', '2021-01-25 09:54:12'),
(360, 'default', 'updated', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2250121\"},\"old\":{\"customize_id\":null}}', '2021-01-25 09:54:12', '2021-01-25 09:54:12'),
(361, 'default', 'created', 'App\\Models\\Attendance', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-01-27\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"08:26:21\",\"check_out\":\"08:26:21\",\"day\":\"Wed\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-01-27 03:26:21', '2021-01-27 03:26:21'),
(362, 'default', 'updated', 'App\\Models\\Attendance', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-01-27\",\"check_out\":\"08:26:31\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"08:26:21\",\"worked_hours\":0,\"status\":0}}', '2021-01-27 03:26:31', '2021-01-27 03:26:31'),
(363, 'default', 'created', 'App\\Models\\Department', 14, NULL, NULL, '{\"attributes\":{\"name\":\"Command \",\"head\":1}}', '2021-01-27 03:33:28', '2021-01-27 03:33:28'),
(364, 'default', 'created', 'App\\Models\\Department', 15, NULL, NULL, '{\"attributes\":{\"name\":\"Command \",\"head\":1}}', '2021-01-27 04:53:00', '2021-01-27 04:53:00'),
(365, 'default', 'created', 'App\\Models\\Attendance', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-01-28\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"11:41:21\",\"check_out\":\"11:41:21\",\"day\":\"Thu\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-01-28 06:41:21', '2021-01-28 06:41:21'),
(366, 'default', 'updated', 'App\\Models\\Attendance', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-01-28\",\"check_out\":\"11:41:30\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"11:41:21\",\"worked_hours\":0,\"status\":0}}', '2021-01-28 06:41:30', '2021-01-28 06:41:30'),
(367, 'default', 'created', 'App\\Models\\AccLevelOne', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Testing\"}}', '2021-01-28 13:38:40', '2021-01-28 13:38:40'),
(368, 'default', 'updated', 'App\\Models\\AccLevelOne', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-28 13:38:40', '2021-01-28 13:38:40'),
(369, 'default', 'created', 'App\\Models\\AccLevelOne', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Testitn\"}}', '2021-01-28 13:38:58', '2021-01-28 13:38:58'),
(370, 'default', 'updated', 'App\\Models\\AccLevelOne', 8, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-28 13:38:58', '2021-01-28 13:38:58'),
(371, 'default', 'created', 'App\\Models\\Menu', 155, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"General Journal\",\"slug\":\"journal-index\",\"icon\":\"fa fa-\",\"status\":1,\"url\":\"journal\",\"position\":4,\"parent_id\":\"97\",\"has_child\":1}}', '2021-01-28 13:44:53', '2021-01-28 13:44:53'),
(372, 'default', 'updated', 'App\\Models\\Role', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"},\"old\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"}}', '2021-01-28 14:00:04', '2021-01-28 14:00:04'),
(373, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-27T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-28T15:47:22.000000Z\",\"updated_at\":\"2021-01-28T15:47:22.000000Z\"}}', '2021-01-28 15:47:22', '2021-01-28 15:47:22'),
(374, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1280121\"},\"old\":{\"customize_id\":null}}', '2021-01-28 15:47:22', '2021-01-28 15:47:22'),
(375, 'default', 'created', 'App\\Models\\AccLevelOne', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Expenses\"}}', '2021-01-29 12:35:15', '2021-01-29 12:35:15'),
(376, 'default', 'updated', 'App\\Models\\AccLevelOne', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:35:15', '2021-01-29 12:35:15'),
(377, 'default', 'created', 'App\\Models\\AccLevelOne', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Revenue\"}}', '2021-01-29 12:35:32', '2021-01-29 12:35:32'),
(378, 'default', 'updated', 'App\\Models\\AccLevelOne', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:35:32', '2021-01-29 12:35:32'),
(379, 'default', 'created', 'App\\Models\\AccLevelOne', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Equity \\/ Capital\"}}', '2021-01-29 12:35:42', '2021-01-29 12:35:42'),
(380, 'default', 'updated', 'App\\Models\\AccLevelOne', 3, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:35:42', '2021-01-29 12:35:42'),
(381, 'default', 'created', 'App\\Models\\AccLevelOne', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Liabilities\"}}', '2021-01-29 12:35:50', '2021-01-29 12:35:50'),
(382, 'default', 'updated', 'App\\Models\\AccLevelOne', 4, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:35:50', '2021-01-29 12:35:50'),
(383, 'default', 'created', 'App\\Models\\AccLevelOne', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Assets\"}}', '2021-01-29 12:36:22', '2021-01-29 12:36:22'),
(384, 'default', 'updated', 'App\\Models\\AccLevelOne', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:36:22', '2021-01-29 12:36:22'),
(385, 'default', 'created', 'App\\Models\\AccLevelTwo', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"title\":\"Current Assets\"}}', '2021-01-29 12:36:52', '2021-01-29 12:36:52'),
(386, 'default', 'updated', 'App\\Models\\AccLevelTwo', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:36:52', '2021-01-29 12:36:52'),
(387, 'default', 'created', 'App\\Models\\AccLevelTwo', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"title\":\"Non Current \\/ Fixed Assets\"}}', '2021-01-29 12:37:15', '2021-01-29 12:37:15'),
(388, 'default', 'updated', 'App\\Models\\AccLevelTwo', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:37:15', '2021-01-29 12:37:15'),
(389, 'default', 'created', 'App\\Models\\AccLevelTwo', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"title\":\"Fuel\"}}', '2021-01-29 12:44:46', '2021-01-29 12:44:46'),
(390, 'default', 'updated', 'App\\Models\\AccLevelTwo', 3, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:44:46', '2021-01-29 12:44:46'),
(391, 'default', 'created', 'App\\Models\\AccLevelTwo', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"title\":\"Transport\"}}', '2021-01-29 12:44:58', '2021-01-29 12:44:58'),
(392, 'default', 'updated', 'App\\Models\\AccLevelTwo', 4, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:44:58', '2021-01-29 12:44:58'),
(393, 'default', 'created', 'App\\Models\\AccLevelTwo', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"title\":\"Food\"}}', '2021-01-29 12:45:10', '2021-01-29 12:45:10'),
(394, 'default', 'updated', 'App\\Models\\AccLevelTwo', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:45:10', '2021-01-29 12:45:10'),
(395, 'default', 'created', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"title\":\"Building\"}}', '2021-01-29 12:48:49', '2021-01-29 12:48:49'),
(396, 'default', 'updated', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:48:49', '2021-01-29 12:48:49'),
(397, 'default', 'created', 'App\\Models\\AccLevelThree', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":3,\"title\":\"LEA-4580\"}}', '2021-01-29 12:49:20', '2021-01-29 12:49:20'),
(398, 'default', 'updated', 'App\\Models\\AccLevelThree', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:49:20', '2021-01-29 12:49:20'),
(399, 'default', 'created', 'App\\Models\\AccLevelThree', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":3,\"title\":\"FDK 5590\"}}', '2021-01-29 12:49:44', '2021-01-29 12:49:44'),
(400, 'default', 'updated', 'App\\Models\\AccLevelThree', 3, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:49:44', '2021-01-29 12:49:44'),
(401, 'default', 'created', 'App\\Models\\AccLevelThree', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":5,\"title\":\"Ali Haider\"}}', '2021-01-29 12:50:23', '2021-01-29 12:50:23'),
(402, 'default', 'updated', 'App\\Models\\AccLevelThree', 4, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:50:23', '2021-01-29 12:50:23'),
(403, 'default', 'created', 'App\\Models\\AccLevelThree', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":5,\"title\":\"Ahmad\"}}', '2021-01-29 12:50:37', '2021-01-29 12:50:37'),
(404, 'default', 'updated', 'App\\Models\\AccLevelThree', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-01-29 12:50:37', '2021-01-29 12:50:37'),
(405, 'default', 'updated', 'App\\Models\\AccLevelOne', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Expenses.\"},\"old\":{\"title\":\"Expenses\"}}', '2021-01-29 13:01:12', '2021-01-29 13:01:12'),
(406, 'default', 'updated', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":3,\"title\":\"Dinner\"},\"old\":{\"code1\":5,\"code2\":2,\"title\":\"Building\"}}', '2021-01-29 13:25:05', '2021-01-29 13:25:05'),
(407, 'default', 'updated', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Dinners\"},\"old\":{\"title\":\"Dinner\"}}', '2021-01-29 13:25:13', '2021-01-29 13:25:13');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(408, 'default', 'updated', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"RPD 4943\"},\"old\":{\"title\":\"Dinners\"}}', '2021-01-29 13:29:04', '2021-01-29 13:29:04'),
(409, 'default', 'created', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":3,\"code3\":1,\"acc_code\":\"\",\"title\":\"Imran\"}}', '2021-01-29 16:34:33', '2021-01-29 16:34:33'),
(410, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-01-29 16:34:33', '2021-01-29 16:34:33'),
(411, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10101000\"},\"old\":{\"acc_code\":\"\"}}', '2021-01-29 16:34:33', '2021-01-29 16:34:33'),
(412, 'default', 'created', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":3,\"code3\":2,\"acc_code\":\"\",\"title\":\"Nawaz\"}}', '2021-01-29 16:34:47', '2021-01-29 16:34:47'),
(413, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-01-29 16:34:47', '2021-01-29 16:34:47'),
(414, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10102000\"},\"old\":{\"acc_code\":\"\"}}', '2021-01-29 16:34:47', '2021-01-29 16:34:47'),
(415, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Imran.\"},\"old\":{\"title\":\"Imran\"}}', '2021-01-29 16:38:42', '2021-01-29 16:38:42'),
(416, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T16:45:55.000000Z\",\"updated_at\":\"2021-01-29T16:45:55.000000Z\"}}', '2021-01-29 16:45:55', '2021-01-29 16:45:55'),
(417, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 16:45:55', '2021-01-29 16:45:55'),
(418, 'default', 'created', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T16:49:32.000000Z\",\"updated_at\":\"2021-01-29T16:49:32.000000Z\"}}', '2021-01-29 16:49:32', '2021-01-29 16:49:32'),
(419, 'default', 'updated', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 16:49:32', '2021-01-29 16:49:32'),
(420, 'default', 'created', 'App\\Models\\Voucher', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T16:50:00.000000Z\",\"updated_at\":\"2021-01-29T16:50:00.000000Z\"}}', '2021-01-29 16:50:00', '2021-01-29 16:50:00'),
(421, 'default', 'updated', 'App\\Models\\Voucher', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"3290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 16:50:00', '2021-01-29 16:50:00'),
(422, 'default', 'created', 'App\\Models\\Voucher', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-12-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T16:51:53.000000Z\",\"updated_at\":\"2021-01-29T16:51:53.000000Z\"}}', '2021-01-29 16:51:53', '2021-01-29 16:51:53'),
(423, 'default', 'updated', 'App\\Models\\Voucher', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"4290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 16:51:53', '2021-01-29 16:51:53'),
(424, 'default', 'created', 'App\\Models\\Voucher', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T16:58:09.000000Z\",\"updated_at\":\"2021-01-29T16:58:09.000000Z\"}}', '2021-01-29 16:58:09', '2021-01-29 16:58:09'),
(425, 'default', 'updated', 'App\\Models\\Voucher', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"5290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 16:58:09', '2021-01-29 16:58:09'),
(426, 'default', 'created', 'App\\Models\\Voucher', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T16:58:27.000000Z\",\"updated_at\":\"2021-01-29T16:58:27.000000Z\"}}', '2021-01-29 16:58:27', '2021-01-29 16:58:27'),
(427, 'default', 'updated', 'App\\Models\\Voucher', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"6290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 16:58:27', '2021-01-29 16:58:27'),
(428, 'default', 'created', 'App\\Models\\Voucher', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T17:00:53.000000Z\",\"updated_at\":\"2021-01-29T17:00:53.000000Z\"}}', '2021-01-29 17:00:53', '2021-01-29 17:00:53'),
(429, 'default', 'updated', 'App\\Models\\Voucher', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"7290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 17:00:53', '2021-01-29 17:00:53'),
(430, 'default', 'created', 'App\\Models\\Voucher', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T17:01:29.000000Z\",\"updated_at\":\"2021-01-29T17:01:29.000000Z\"}}', '2021-01-29 17:01:29', '2021-01-29 17:01:29'),
(431, 'default', 'updated', 'App\\Models\\Voucher', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"8290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 17:01:29', '2021-01-29 17:01:29'),
(432, 'default', 'created', 'App\\Models\\Voucher', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-28T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-29T17:02:43.000000Z\",\"updated_at\":\"2021-01-29T17:02:43.000000Z\"}}', '2021-01-29 17:02:43', '2021-01-29 17:02:43'),
(433, 'default', 'updated', 'App\\Models\\Voucher', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"9290121\"},\"old\":{\"customize_id\":null}}', '2021-01-29 17:02:43', '2021-01-29 17:02:43'),
(434, 'default', 'created', 'App\\Models\\Voucher', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-29T19:00:00.000000Z\",\"v_type\":\"purchase\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-30T05:08:21.000000Z\",\"updated_at\":\"2021-01-30T05:08:21.000000Z\"}}', '2021-01-30 05:08:21', '2021-01-30 05:08:21'),
(435, 'default', 'updated', 'App\\Models\\Voucher', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"10300121\"},\"old\":{\"customize_id\":null}}', '2021-01-30 05:08:21', '2021-01-30 05:08:21'),
(436, 'default', 'created', 'App\\Models\\Voucher', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-29T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-30T05:21:13.000000Z\",\"updated_at\":\"2021-01-30T05:21:13.000000Z\"}}', '2021-01-30 05:21:13', '2021-01-30 05:21:13'),
(437, 'default', 'updated', 'App\\Models\\Voucher', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"11300121\"},\"old\":{\"customize_id\":null}}', '2021-01-30 05:21:13', '2021-01-30 05:21:13'),
(438, 'default', 'created', 'App\\Models\\Voucher', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-29T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-01-30T05:21:48.000000Z\",\"updated_at\":\"2021-01-30T05:21:48.000000Z\"}}', '2021-01-30 05:21:48', '2021-01-30 05:21:48'),
(439, 'default', 'updated', 'App\\Models\\Voucher', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"12300121\"},\"old\":{\"customize_id\":null}}', '2021-01-30 05:21:48', '2021-01-30 05:21:48'),
(440, 'default', 'created', 'App\\Models\\Job', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-01-30 07:20:05', '2021-01-30 07:20:05'),
(441, 'default', 'created', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":1,\"item_id\":1,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-01-30 07:20:05', '2021-01-30 07:20:05'),
(442, 'default', 'created', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":1,\"item_id\":2,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-01-30 07:20:05', '2021-01-30 07:20:05'),
(443, 'default', 'created', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":1,\"item_id\":3,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-01-30 07:20:05', '2021-01-30 07:20:05'),
(444, 'default', 'created', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1,\"item_id\":4,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-01-30 07:20:05', '2021-01-30 07:20:05'),
(445, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"3450\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-01-30 07:21:17', '2021-01-30 07:21:17'),
(446, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-01-30\",\"end\":\"2021-01-30\",\"assign_user\":1,\"assign_assets\":\"1,211\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-01-30 07:22:01', '2021-01-30 07:22:01'),
(447, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-01-30\",\"end\":\"2021-02-06\",\"group_users\":\"1\",\"group_assets\":\"1\"},\"old\":{\"start\":null,\"end\":null,\"group_users\":null,\"group_assets\":null}}', '2021-01-30 07:25:55', '2021-01-30 07:25:55'),
(448, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-01-30\",\"end\":\"2021-02-06\",\"group_users\":\"1\",\"group_assets\":\"1\"},\"old\":{\"start\":null,\"end\":null,\"group_users\":null,\"group_assets\":null}}', '2021-01-30 07:25:55', '2021-01-30 07:25:55'),
(449, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-01-30\",\"end\":\"2021-02-06\",\"group_users\":\"1\",\"group_assets\":\"1\"},\"old\":{\"start\":null,\"end\":null,\"group_users\":null,\"group_assets\":null}}', '2021-01-30 07:25:55', '2021-01-30 07:25:55'),
(450, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-01-30 13:21:30\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-01-30 08:21:30', '2021-01-30 08:21:30'),
(451, 'default', 'updated', 'App\\Models\\Menu', 94, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-01 08:22:52', '2021-02-01 08:22:52'),
(452, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-01 08:23:54', '2021-02-01 08:23:54'),
(453, 'default', 'updated', 'App\\Models\\Menu', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":12},\"old\":{\"position\":0}}', '2021-02-01 08:26:03', '2021-02-01 08:26:03'),
(454, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":4},\"old\":{\"position\":1}}', '2021-02-01 08:31:50', '2021-02-01 08:31:50'),
(455, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":5},\"old\":{\"position\":0}}', '2021-02-01 08:34:24', '2021-02-01 08:34:24'),
(456, 'default', 'updated', 'App\\Models\\Menu', 94, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":0}}', '2021-02-01 08:43:37', '2021-02-01 08:43:37'),
(457, 'default', 'updated', 'App\\Models\\Menu', 94, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-01 08:45:28', '2021-02-01 08:45:28'),
(458, 'default', 'updated', 'App\\Models\\Menu', 92, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":0}}', '2021-02-01 08:45:36', '2021-02-01 08:45:36'),
(459, 'default', 'updated', 'App\\Models\\Menu', 93, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":3},\"old\":{\"position\":0}}', '2021-02-01 08:45:40', '2021-02-01 08:45:40'),
(460, 'default', 'updated', 'App\\Models\\Menu', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":4},\"old\":{\"position\":0}}', '2021-02-01 08:45:44', '2021-02-01 08:45:44'),
(461, 'default', 'updated', 'App\\Models\\Menu', 138, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":5},\"old\":{\"position\":0}}', '2021-02-01 08:45:52', '2021-02-01 08:45:52'),
(462, 'default', 'updated', 'App\\Models\\Menu', 95, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":6},\"old\":{\"position\":0}}', '2021-02-01 08:45:56', '2021-02-01 08:45:56'),
(463, 'default', 'updated', 'App\\Models\\Menu', 68, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":7},\"old\":{\"position\":0}}', '2021-02-01 08:46:00', '2021-02-01 08:46:00'),
(464, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":8},\"old\":{\"position\":0}}', '2021-02-01 08:46:03', '2021-02-01 08:46:03'),
(465, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":9},\"old\":{\"position\":0}}', '2021-02-01 08:46:07', '2021-02-01 08:46:07'),
(466, 'default', 'updated', 'App\\Models\\Menu', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":10},\"old\":{\"position\":0}}', '2021-02-01 08:46:10', '2021-02-01 08:46:10'),
(467, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":11},\"old\":{\"position\":9}}', '2021-02-01 08:46:14', '2021-02-01 08:46:14'),
(468, 'default', 'updated', 'App\\Models\\Menu', 139, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":12},\"old\":{\"position\":0}}', '2021-02-01 08:46:49', '2021-02-01 08:46:49'),
(469, 'default', 'updated', 'App\\Models\\Menu', 131, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":13},\"old\":{\"position\":0}}', '2021-02-01 08:47:07', '2021-02-01 08:47:07'),
(470, 'default', 'updated', 'App\\Models\\Menu', 94, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":1}}', '2021-02-01 08:58:31', '2021-02-01 08:58:31'),
(471, 'default', 'updated', 'App\\Models\\Menu', 131, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":13}}', '2021-02-01 08:59:01', '2021-02-01 08:59:01'),
(472, 'default', 'updated', 'App\\Models\\Menu', 131, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":9},\"old\":{\"position\":0}}', '2021-02-01 09:00:16', '2021-02-01 09:00:16'),
(473, 'default', 'updated', 'App\\Models\\Menu', 94, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-01 09:00:18', '2021-02-01 09:00:18'),
(474, 'default', 'updated', 'App\\Models\\Menu', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":4}}', '2021-02-01 09:00:48', '2021-02-01 09:00:48'),
(475, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":11}}', '2021-02-01 09:01:03', '2021-02-01 09:01:03'),
(476, 'default', 'updated', 'App\\Models\\Menu', 92, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":2}}', '2021-02-01 09:11:25', '2021-02-01 09:11:25'),
(477, 'default', 'updated', 'App\\Models\\Menu', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":10}}', '2021-02-01 09:11:29', '2021-02-01 09:11:29'),
(478, 'default', 'updated', 'App\\Models\\Menu', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":0}}', '2021-02-01 09:11:35', '2021-02-01 09:11:35'),
(479, 'default', 'updated', 'App\\Models\\Menu', 92, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":4},\"old\":{\"position\":0}}', '2021-02-01 09:14:49', '2021-02-01 09:14:49'),
(480, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":8}}', '2021-02-01 09:15:01', '2021-02-01 09:15:01'),
(481, 'default', 'updated', 'App\\Models\\Menu', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":10},\"old\":{\"position\":0}}', '2021-02-01 09:15:05', '2021-02-01 09:15:05'),
(482, 'default', 'updated', 'App\\Models\\Menu', 97, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":8},\"old\":{\"position\":0}}', '2021-02-01 09:15:14', '2021-02-01 09:15:14'),
(483, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":11},\"old\":{\"position\":0}}', '2021-02-01 09:15:17', '2021-02-01 09:15:17'),
(484, 'default', 'updated', 'App\\Models\\Menu', 139, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":12}}', '2021-02-01 09:21:04', '2021-02-01 09:21:04'),
(485, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":11}}', '2021-02-01 09:21:06', '2021-02-01 09:21:06'),
(486, 'default', 'updated', 'App\\Models\\Menu', 139, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":11},\"old\":{\"position\":0}}', '2021-02-01 09:21:14', '2021-02-01 09:21:14'),
(487, 'default', 'updated', 'App\\Models\\Menu', 126, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":12},\"old\":{\"position\":0}}', '2021-02-01 09:21:17', '2021-02-01 09:21:17'),
(488, 'default', 'updated', 'App\\Models\\Menu', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":0}}', '2021-02-01 09:30:13', '2021-02-01 09:30:13'),
(489, 'default', 'updated', 'App\\Models\\Menu', 122, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-01 09:30:17', '2021-02-01 09:30:17'),
(490, 'default', 'updated', 'App\\Models\\Menu', 88, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":3},\"old\":{\"position\":0}}', '2021-02-01 09:30:20', '2021-02-01 09:30:20'),
(491, 'default', 'updated', 'App\\Models\\Menu', 86, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":4},\"old\":{\"position\":0}}', '2021-02-01 09:30:23', '2021-02-01 09:30:23'),
(492, 'default', 'updated', 'App\\Models\\Menu', 87, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":5},\"old\":{\"position\":0}}', '2021-02-01 09:30:25', '2021-02-01 09:30:25'),
(493, 'default', 'updated', 'App\\Models\\Menu', 84, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":6},\"old\":{\"position\":0}}', '2021-02-01 09:30:28', '2021-02-01 09:30:28'),
(494, 'default', 'updated', 'App\\Models\\Menu', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":7},\"old\":{\"position\":0}}', '2021-02-01 09:30:31', '2021-02-01 09:30:31'),
(495, 'default', 'updated', 'App\\Models\\Menu', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":2}}', '2021-02-01 09:30:43', '2021-02-01 09:30:43'),
(496, 'default', 'updated', 'App\\Models\\Menu', 88, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":3}}', '2021-02-01 09:31:16', '2021-02-01 09:31:16'),
(497, 'default', 'updated', 'App\\Models\\Menu', 122, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":12},\"old\":{\"position\":1}}', '2021-02-01 09:31:52', '2021-02-01 09:31:52'),
(498, 'default', 'updated', 'App\\Models\\Menu', 87, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":0},\"old\":{\"position\":5}}', '2021-02-01 09:33:05', '2021-02-01 09:33:05'),
(499, 'default', 'updated', 'App\\Models\\Menu', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":12},\"old\":{\"position\":0}}', '2021-02-01 09:33:14', '2021-02-01 09:33:14'),
(500, 'default', 'updated', 'App\\Models\\Menu', 86, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":87},\"old\":{\"position\":4}}', '2021-02-01 09:34:13', '2021-02-01 09:34:13'),
(501, 'default', 'updated', 'App\\Models\\Menu', 86, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":11},\"old\":{\"position\":87}}', '2021-02-01 09:35:10', '2021-02-01 09:35:10'),
(502, 'default', 'updated', 'App\\Models\\Menu', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":12}}', '2021-02-01 09:35:20', '2021-02-01 09:35:20'),
(503, 'default', 'updated', 'App\\Models\\Menu', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":7}}', '2021-02-01 09:35:23', '2021-02-01 09:35:23'),
(504, 'default', 'updated', 'App\\Models\\Menu', 84, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":3},\"old\":{\"position\":6}}', '2021-02-01 09:35:30', '2021-02-01 09:35:30'),
(505, 'default', 'updated', 'App\\Models\\Menu', 87, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":4},\"old\":{\"position\":0}}', '2021-02-01 09:35:33', '2021-02-01 09:35:33'),
(506, 'default', 'updated', 'App\\Models\\Menu', 88, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":5},\"old\":{\"position\":2}}', '2021-02-01 09:35:36', '2021-02-01 09:35:36'),
(507, 'default', 'updated', 'App\\Models\\Menu', 122, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":6},\"old\":{\"position\":12}}', '2021-02-01 09:35:42', '2021-02-01 09:35:42'),
(508, 'default', 'updated', 'App\\Models\\Menu', 86, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":7},\"old\":{\"position\":11}}', '2021-02-01 09:35:57', '2021-02-01 09:35:57'),
(509, 'default', 'updated', 'App\\Models\\Menu', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-01 09:37:26', '2021-02-01 09:37:26'),
(510, 'default', 'created', 'App\\Models\\Requisition', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"requisition_designation\":6,\"reason\":\"Software Developer Required\",\"qualification\":\"BS Software Engineer\",\"special_skills\":\"Graphics Designing\",\"initiated_by\":1,\"time_frame\":\"two-week\",\"hrd_review\":\"internal-re-adjustment\",\"approved_by\":null,\"remarks\":\"Remarks\"}}', '2021-02-02 06:01:15', '2021-02-02 06:01:15'),
(511, 'default', 'created', 'App\\Models\\Interviewappraisal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"fname\":\"Muhammad\",\"lname\":\"Azeem\",\"age\":22,\"basic_qualification\":\"Matriculation\",\"basic_qualification_duration\":2,\"highest_qualification\":\"BS Software Engineering\",\"highest_qualification_duration\":4,\"bu_for_candidate\":\"consultancy-services\",\"relevant_experience\":\"Web Designing\",\"total_experience\":\"2\",\"last_salary\":\"25000\",\"desired_salary\":\"45000\",\"personal_traits\":\"{\\\"education\\\":\\\"4\\\",\\\"computer_literacy\\\":\\\"2\\\",\\\"intelligence\\\":\\\"1\\\",\\\"experience_related_to_the_job_interviewed_for\\\":\\\"4\\\",\\\"experience_related_to_the_other_lines_of_company_business\\\":\\\"4\\\",\\\"job_knowledge_skills\\\":\\\"3\\\",\\\"personality\\\":\\\"0\\\",\\\"communication_skills\\\":\\\"5\\\",\\\"development_potential_motivation\\\":\\\"4\\\",\\\"personal_aptitude_related_to_the_job_interviewed_for\\\":\\\"5\\\"}\",\"suitable_for_other_department\":7,\"evaluator\":1}}', '2021-02-02 06:44:20', '2021-02-02 06:44:20'),
(512, 'default', 'created', 'App\\Models\\Empcontract', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"appraisal_id\":1,\"termination_period\":\"one-year\",\"probation_applicable\":1,\"probation_period\":\"three-months\",\"designations\":12,\"place_of_work\":\"Al-Meezan Industrial Metrology Services (AIMS), Lahore, Pakistan\",\"salary\":40000,\"allowances\":\"na\",\"cnic\":\"331012-191203894-1\",\"representative\":0,\"commencement\":\"2021-02-01T19:00:00.000000Z\",\"status\":0,\"signature\":null,\"hr_user_id\":null,\"joining\":null,\"o_area\":\"\",\"remarks\":\"\"}}', '2021-02-02 07:00:17', '2021-02-02 07:00:17'),
(513, 'default', 'updated', 'App\\Models\\Empcontract', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1,\"signature\":\"1612249348-aims-business-card.JPG\",\"hr_user_id\":1,\"joining\":\"2021-02-01T19:00:00.000000Z\"},\"old\":{\"status\":0,\"signature\":null,\"hr_user_id\":null,\"joining\":null}}', '2021-02-02 07:02:28', '2021-02-02 07:02:28'),
(514, 'default', 'updated', 'App\\Models\\Empcontract', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"o_area\":\"{\\\"introduction-to-key-personnel\\\":1,\\\"facility-and-operations-familiarization\\\":1,\\\"review-of-safety-regulations\\\":1,\\\"disciplinary-instructions\\\":1,\\\"conduct-with-clients-and-colleagues\\\":1,\\\"company-organization-chart\\\":1,\\\"function-of-different-departments\\\":1,\\\"individual-responsibility-and-understanding-of-quality-policy\\\":1,\\\"companys-quality-assurance-manual-and-AIMS-standard-or-procedures\\\":1,\\\"contractual-obligations-of-personnel\\\":1}\",\"remarks\":\"remarks\"},\"old\":{\"status\":1,\"o_area\":\"\",\"remarks\":\"\"}}', '2021-02-02 07:02:55', '2021-02-02 07:02:55'),
(515, 'default', 'created', 'App\\Models\\LeaveApplication', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"appraisal_id\":1,\"nature_of_leave\":\"casual-leave\",\"type_of_leave\":0,\"type_time\":null,\"from\":\"2021-01-01T19:00:00.000000Z\",\"to\":\"2021-02-01T19:00:00.000000Z\",\"reason\":\"Reason\",\"address_contact\":\"Address 03803242\",\"head_id\":1,\"head_recommendation_status\":null,\"head_recommendation_date\":null,\"head_remarks\":null,\"ceo_id\":1,\"ceo_recommendation_status\":null,\"ceo_recommendation_date\":null,\"ceo_remarks\":null}}', '2021-02-02 07:31:37', '2021-02-02 07:31:37'),
(516, 'default', 'updated', 'App\\Models\\LeaveApplication', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"head_recommendation_status\":1,\"head_recommendation_date\":\"2021-02-02\"},\"old\":{\"head_recommendation_status\":null,\"head_recommendation_date\":null}}', '2021-02-02 07:37:12', '2021-02-02 07:37:12'),
(517, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-02-02\",\"end\":\"2021-02-02\",\"group_assets\":\"34\"},\"old\":{\"start\":\"2021-01-30\",\"end\":\"2021-02-06\",\"group_assets\":\"1\"}}', '2021-02-02 08:54:56', '2021-02-02 08:54:56'),
(518, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-02-02\",\"end\":\"2021-02-02\",\"group_assets\":\"34\"},\"old\":{\"start\":\"2021-01-30\",\"end\":\"2021-02-06\",\"group_assets\":\"1\"}}', '2021-02-02 08:54:56', '2021-02-02 08:54:56'),
(519, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-02-02\",\"end\":\"2021-02-02\",\"group_assets\":\"34\"},\"old\":{\"start\":\"2021-01-30\",\"end\":\"2021-02-06\",\"group_assets\":\"1\"}}', '2021-02-02 08:54:56', '2021-02-02 08:54:56'),
(520, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"274893\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":2},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1}}', '2021-02-02 09:04:12', '2021-02-02 09:04:12'),
(521, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-02 14:04:18\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-02 09:04:18', '2021-02-02 09:04:18'),
(522, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.4\",\"accuracy\":\"0.1\",\"range\":\"10-100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-02 09:05:25', '2021-02-02 09:05:25'),
(523, 'default', 'created', 'App\\Models\\Item', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 01\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 07:50:18', '2021-02-03 07:50:18'),
(524, 'default', 'created', 'App\\Models\\Item', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 2\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 07:50:28', '2021-02-03 07:50:28'),
(525, 'default', 'created', 'App\\Models\\Item', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 3\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 07:50:39', '2021-02-03 07:50:39'),
(526, 'default', 'created', 'App\\Models\\Item', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 4\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 07:52:15', '2021-02-03 07:52:15'),
(527, 'default', 'updated', 'App\\Models\\Item', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"not_available\":\"non listed 1\"},\"old\":{\"not_available\":\"non listed 01\"}}', '2021-02-03 07:55:17', '2021-02-03 07:55:17'),
(528, 'default', 'created', 'App\\Models\\Item', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":0,\"parameter\":1,\"capability\":1,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"84~12880\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:12:04', '2021-02-03 08:12:04'),
(529, 'default', 'created', 'App\\Models\\Item', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":0,\"parameter\":1,\"capability\":1,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"84~12880\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:36:43', '2021-02-03 08:36:43'),
(530, 'default', 'created', 'App\\Models\\Item', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":0,\"parameter\":1,\"capability\":1,\"not_available\":null,\"location\":\"site\",\"accredited\":\"yes\",\"range\":\"84~12880\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:38:19', '2021-02-03 08:38:19'),
(531, 'default', 'created', 'App\\Models\\Item', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":0,\"parameter\":1,\"capability\":1,\"not_available\":null,\"location\":\"site\",\"accredited\":\"yes\",\"range\":\"84~12880\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:38:42', '2021-02-03 08:38:42'),
(532, 'default', 'created', 'App\\Models\\Item', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":0,\"parameter\":1,\"capability\":1,\"not_available\":null,\"location\":\"site\",\"accredited\":\"yes\",\"range\":\"84~12880\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:39:12', '2021-02-03 08:39:12'),
(533, 'default', 'updated', 'App\\Models\\Quotes', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"BOTH\"},\"old\":{\"type\":null}}', '2021-02-03 08:39:12', '2021-02-03 08:39:12'),
(534, 'default', 'created', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1037,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"RFQ Mode Details\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Shafqat Butt\",\"revision\":0}}', '2021-02-03 08:46:57', '2021-02-03 08:46:57'),
(535, 'default', 'created', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 01\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:47:46', '2021-02-03 08:47:46'),
(536, 'default', 'created', 'App\\Models\\Item', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 02\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:47:57', '2021-02-03 08:47:57'),
(537, 'default', 'created', 'App\\Models\\Item', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 03\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:48:08', '2021-02-03 08:48:08'),
(538, 'default', 'created', 'App\\Models\\Item', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":3,\"capability\":172,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"13~26\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:48:24', '2021-02-03 08:48:24'),
(539, 'default', 'created', 'App\\Models\\Item', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":3,\"capability\":172,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"13~26\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:49:02', '2021-02-03 08:49:02'),
(540, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"SITE\"},\"old\":{\"type\":null}}', '2021-02-03 08:49:02', '2021-02-03 08:49:02'),
(541, 'default', 'created', 'App\\Models\\Item', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":5,\"capability\":251,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"1~40\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:50:28', '2021-02-03 08:50:28'),
(542, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":\"SITE\"}}', '2021-02-03 08:50:28', '2021-02-03 08:50:28'),
(543, 'default', 'created', 'App\\Models\\Item', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":7,\"capability\":283,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0.001~20\",\"price\":2500,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 08:50:54', '2021-02-03 08:50:54'),
(544, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"BOTH\"},\"old\":{\"type\":\"LAB\"}}', '2021-02-03 08:50:54', '2021-02-03 08:50:54'),
(545, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"1,1,1\"},\"old\":{\"rf_checks\":null}}', '2021-02-03 09:33:08', '2021-02-03 09:33:08'),
(546, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"0,1,1\"},\"old\":{\"rf_checks\":\"1,1,1\"}}', '2021-02-03 09:42:13', '2021-02-03 09:42:13'),
(547, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"0,0,0\"},\"old\":{\"rf_checks\":\"0,1,1\"}}', '2021-02-03 09:42:38', '2021-02-03 09:42:38'),
(548, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"1,1,1\"},\"old\":{\"rf_checks\":\"0,0,0\"}}', '2021-02-03 09:47:18', '2021-02-03 09:47:18'),
(549, 'default', 'updated', 'App\\Models\\Item', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"1,0,1\"},\"old\":{\"rf_checks\":null}}', '2021-02-03 09:47:29', '2021-02-03 09:47:29'),
(550, 'default', 'updated', 'App\\Models\\Item', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"0,0,0\"},\"old\":{\"rf_checks\":null}}', '2021-02-03 09:47:34', '2021-02-03 09:47:34'),
(551, 'default', 'created', 'App\\Models\\Item', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"non listed 04\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 09:47:55', '2021-02-03 09:47:55'),
(552, 'default', 'created', 'App\\Models\\Capabilities', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"non listed 01\",\"parameter\":1,\"procedure\":1,\"range\":\"10~1000\",\"price\":10000,\"accuracy\":\"0.2\",\"unit\":\"1\",\"remarks\":\"remarks\",\"location\":\"site\",\"accredited\":\"on\"}}', '2021-02-03 09:59:46', '2021-02-03 09:59:46'),
(553, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"parameter\":1,\"capability\":1002,\"range\":\"10~1000\",\"price\":10000},\"old\":{\"status\":1,\"parameter\":0,\"capability\":0,\"range\":\"0\",\"price\":0}}', '2021-02-03 09:59:46', '2021-02-03 09:59:46'),
(554, 'default', 'updated', 'App\\Models\\Item', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-02-03 10:04:35', '2021-02-03 10:04:35'),
(555, 'default', 'created', 'App\\Models\\Nofacility', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"capability\":\"non listed 02\",\"item_id\":2}}', '2021-02-03 10:04:35', '2021-02-03 10:04:35'),
(556, 'default', 'updated', 'App\\Models\\Item', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"0,1,1\"},\"old\":{\"rf_checks\":null}}', '2021-02-03 10:30:42', '2021-02-03 10:30:42'),
(557, 'default', 'updated', 'App\\Models\\Item', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"rf_checks\":\"1,1,0\"},\"old\":{\"rf_checks\":\"0,1,1\"}}', '2021-02-03 10:31:54', '2021-02-03 10:31:54'),
(558, 'default', 'updated', 'App\\Models\\Item', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-02-03 10:33:18', '2021-02-03 10:33:18'),
(559, 'default', 'created', 'App\\Models\\Nofacility', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"capability\":\"non listed 04\",\"item_id\":8}}', '2021-02-03 10:33:18', '2021-02-03 10:33:18'),
(560, 'default', 'updated', 'App\\Models\\Item', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-02-03 10:36:50', '2021-02-03 10:36:50'),
(561, 'default', 'created', 'App\\Models\\Nofacility', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"capability\":\"non listed 03\",\"item_id\":3}}', '2021-02-03 10:36:50', '2021-02-03 10:36:50'),
(562, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-03 10:37:00', '2021-02-03 10:37:00'),
(563, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":9500},\"old\":{\"price\":10000}}', '2021-02-03 10:38:17', '2021-02-03 10:38:17'),
(564, 'default', 'updated', 'App\\Models\\Item', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":3800},\"old\":{\"price\":4000}}', '2021-02-03 10:38:17', '2021-02-03 10:38:17'),
(565, 'default', 'updated', 'App\\Models\\Item', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":2375},\"old\":{\"price\":2500}}', '2021-02-03 10:38:17', '2021-02-03 10:38:17'),
(566, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":9025},\"old\":{\"price\":9500}}', '2021-02-03 10:39:19', '2021-02-03 10:39:19'),
(567, 'default', 'updated', 'App\\Models\\Item', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":3610},\"old\":{\"price\":3800}}', '2021-02-03 10:39:19', '2021-02-03 10:39:19'),
(568, 'default', 'updated', 'App\\Models\\Item', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":2256},\"old\":{\"price\":2375}}', '2021-02-03 10:39:19', '2021-02-03 10:39:19'),
(569, 'default', 'updated', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":8574},\"old\":{\"price\":9025}}', '2021-02-03 10:39:35', '2021-02-03 10:39:35'),
(570, 'default', 'updated', 'App\\Models\\Item', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":3430},\"old\":{\"price\":3610}}', '2021-02-03 10:39:35', '2021-02-03 10:39:35'),
(571, 'default', 'updated', 'App\\Models\\Item', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"price\":2143},\"old\":{\"price\":2256}}', '2021-02-03 10:39:35', '2021-02-03 10:39:35'),
(572, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"revision\":1},\"old\":{\"revision\":0}}', '2021-02-03 10:39:35', '2021-02-03 10:39:35'),
(573, 'default', 'updated', 'App\\Models\\Customer', 1037, 'App\\Models\\User', 1, '{\"attributes\":{\"pur_name\":\"purchaser\",\"pur_phone\":\"0301298043-\",\"pur_email\":\"purchaser@gmail.com\",\"updated_at\":\"2021-02-03T10:40:09.000000Z\"},\"old\":{\"pur_name\":null,\"pur_phone\":null,\"pur_email\":null,\"updated_at\":\"2020-10-13T11:57:40.000000Z\"}}', '2021-02-03 10:40:09', '2021-02-03 10:40:09'),
(574, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"SPLIT\",\"status\":3},\"old\":{\"type\":\"BOTH\",\"status\":1}}', '2021-02-03 10:40:26', '2021-02-03 10:40:26'),
(575, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"approval_mode\":\"By PO\",\"approval_mode_details\":\"PO - 980343\",\"approval_date\":\"2021-02-03\"},\"old\":{\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null}}', '2021-02-03 10:40:38', '2021-02-03 10:40:38'),
(576, 'default', 'created', 'App\\Models\\Quotes', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1184,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"details\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Junaid Baig\",\"revision\":0}}', '2021-02-03 11:17:01', '2021-02-03 11:17:01'),
(577, 'default', 'created', 'App\\Models\\Item', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":2,\"status\":0,\"parameter\":1,\"capability\":3,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"no\",\"range\":\"10~110\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-03 11:17:16', '2021-02-03 11:17:16'),
(578, 'default', 'updated', 'App\\Models\\Quotes', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-02-03 11:17:16', '2021-02-03 11:17:16'),
(579, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"turnaround\":\"10\",\"remarks\":\"My remarks will be listed here\"},\"old\":{\"turnaround\":null,\"remarks\":null}}', '2021-02-03 11:19:34', '2021-02-03 11:19:34'),
(580, 'default', 'created', 'App\\Models\\Job', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-02-03 11:38:44', '2021-02-03 11:38:44'),
(581, 'default', 'created', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":2,\"item_id\":1,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-03 11:38:44', '2021-02-03 11:38:44'),
(582, 'default', 'created', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":2,\"item_id\":6,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-03 11:38:44', '2021-02-03 11:38:44'),
(583, 'default', 'created', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":2,\"item_id\":7,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-03 11:38:44', '2021-02-03 11:38:44'),
(584, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"eq\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-03 12:02:33', '2021-02-03 12:02:33'),
(585, 'default', 'created', 'App\\Models\\Attendance', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-04\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"08:51:38\",\"check_out\":\"08:51:38\",\"day\":\"Thu\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-04 03:51:38', '2021-02-04 03:51:38'),
(586, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-04 03:57:57', '2021-02-04 03:57:57'),
(587, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2},\"old\":{\"status\":1}}', '2021-02-04 03:58:15', '2021-02-04 03:58:15'),
(588, 'default', 'deleted', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1037,\"type\":\"SPLIT\",\"rfq_mode\":\"email\",\"rfq_mode_details\":\"RFQ Mode Details\",\"approval_mode\":\"By PO\",\"approval_mode_details\":\"PO - 980343\",\"approval_date\":\"2021-02-03\",\"status\":2,\"turnaround\":\"10\",\"remarks\":\"My remarks will be listed here\",\"tm\":2,\"principal\":\"Shafqat Butt\",\"revision\":1}}', '2021-02-04 05:11:35', '2021-02-04 05:11:35'),
(589, 'default', 'created', 'App\\Models\\Quotes', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1193,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"\\/.as\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Muhammad Asim Chief Engineer\",\"revision\":0}}', '2021-02-04 05:31:17', '2021-02-04 05:31:17'),
(590, 'default', 'created', 'App\\Models\\Item', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"01\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-04 05:31:30', '2021-02-04 05:31:30'),
(591, 'default', 'deleted', 'App\\Models\\Item', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"01\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-04 05:31:47', '2021-02-04 05:31:47'),
(592, 'default', 'created', 'App\\Models\\Item', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":0,\"parameter\":10,\"capability\":306,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0.1~220\",\"price\":2500,\"quantity\":1,\"rf_checks\":null}}', '2021-02-04 05:31:56', '2021-02-04 05:31:56'),
(593, 'default', 'updated', 'App\\Models\\Quotes', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"SITE\"},\"old\":{\"type\":null}}', '2021-02-04 05:31:56', '2021-02-04 05:31:56');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(594, 'default', 'created', 'App\\Models\\Item', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"2930\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-04 05:32:12', '2021-02-04 05:32:12'),
(595, 'default', 'deleted', 'App\\Models\\Item', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"2930\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":1,\"rf_checks\":null}}', '2021-02-04 05:33:17', '2021-02-04 05:33:17'),
(596, 'default', 'created', 'App\\Models\\Item', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"89302\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":3,\"rf_checks\":null}}', '2021-02-04 05:33:29', '2021-02-04 05:33:29'),
(597, 'default', 'deleted', 'App\\Models\\Item', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":3,\"status\":1,\"parameter\":0,\"capability\":0,\"not_available\":\"89302\",\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0\",\"price\":0,\"quantity\":3,\"rf_checks\":null}}', '2021-02-04 05:33:45', '2021-02-04 05:33:45'),
(598, 'default', 'updated', 'App\\Models\\Quotes', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-04 05:33:53', '2021-02-04 05:33:53'),
(599, 'default', 'updated', 'App\\Models\\Quotes', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2},\"old\":{\"status\":1}}', '2021-02-04 06:10:48', '2021-02-04 06:10:48'),
(600, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-03T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-04T10:19:16.000000Z\",\"updated_at\":\"2021-02-04T10:19:16.000000Z\"}}', '2021-02-04 10:19:16', '2021-02-04 10:19:16'),
(601, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1040221\"},\"old\":{\"customize_id\":null}}', '2021-02-04 10:19:16', '2021-02-04 10:19:16'),
(602, 'default', 'created', 'App\\Models\\Journal', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":21,\"customize_id\":\"\",\"date\":\"2021-02-04\",\"type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"narration\",\"dr\":3000,\"cr\":null}}', '2021-02-04 10:19:16', '2021-02-04 10:19:16'),
(603, 'default', 'updated', 'App\\Models\\Journal', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"21040221\",\"date\":\"2021-02-04\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-03T19:00:00.000000Z\"}}', '2021-02-04 10:19:16', '2021-02-04 10:19:16'),
(604, 'default', 'created', 'App\\Models\\Journal', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":22,\"customize_id\":\"\",\"date\":\"2021-02-04\",\"type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10102000\",\"narration\":\"narration\",\"dr\":null,\"cr\":3000}}', '2021-02-04 10:19:17', '2021-02-04 10:19:17'),
(605, 'default', 'updated', 'App\\Models\\Journal', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"22040221\",\"date\":\"2021-02-04\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-03T19:00:00.000000Z\"}}', '2021-02-04 10:19:17', '2021-02-04 10:19:17'),
(606, 'default', 'created', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1184,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"emi@gmail.com\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":null,\"principal\":\"Junaid Baig\",\"revision\":0}}', '2021-02-04 11:07:46', '2021-02-04 11:07:46'),
(607, 'default', 'created', 'App\\Models\\Item', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":1,\"capability\":4,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"10~110\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-04 11:07:59', '2021-02-04 11:07:59'),
(608, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"SITE\"},\"old\":{\"type\":null}}', '2021-02-04 11:07:59', '2021-02-04 11:07:59'),
(609, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-04 11:08:08', '2021-02-04 11:08:08'),
(610, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2},\"old\":{\"status\":1}}', '2021-02-04 11:08:18', '2021-02-04 11:08:18'),
(611, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":2}}', '2021-02-04 11:08:26', '2021-02-04 11:08:26'),
(612, 'default', 'created', 'App\\Models\\Job', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-02-04 11:08:45', '2021-02-04 11:08:45'),
(613, 'default', 'created', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":1000,\"item_id\":1000,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-04 11:08:45', '2021-02-04 11:08:45'),
(614, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-02-04\",\"end\":\"2021-02-04\",\"group_users\":\"1\",\"group_assets\":\"2,3\"},\"old\":{\"start\":null,\"end\":null,\"group_users\":null,\"group_assets\":null}}', '2021-02-04 11:09:18', '2021-02-04 11:09:18'),
(615, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"37829\",\"serial\":\"jkl\",\"model\":\".lfew\",\"make\":\",mew\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":2},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1}}', '2021-02-04 11:09:37', '2021-02-04 11:09:37'),
(616, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-04 16:09:42\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-04 11:09:42', '2021-02-04 11:09:42'),
(617, 'default', 'updated', 'App\\Models\\Attendance', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-05\",\"check_out\":\"19:52:36\",\"worked_hours\":43,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"08:51:38\",\"worked_hours\":0,\"status\":0}}', '2021-02-05 14:52:36', '2021-02-05 14:52:36'),
(618, 'default', 'created', 'App\\Models\\Attendance', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-05\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"19:52:46\",\"check_out\":\"19:52:46\",\"day\":\"Fri\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-05 14:52:46', '2021-02-05 14:52:46'),
(619, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"v_date\":\"2021-02-04T19:00:00.000000Z\",\"updated_at\":\"2021-02-05T14:53:47.000000Z\"},\"old\":{\"v_date\":\"2021-02-03T19:00:00.000000Z\",\"updated_at\":\"2021-02-04T10:19:16.000000Z\"}}', '2021-02-05 14:53:47', '2021-02-05 14:53:47'),
(620, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1050221\"},\"old\":{\"customize_id\":\"1040221\"}}', '2021-02-05 14:53:47', '2021-02-05 14:53:47'),
(621, 'default', 'created', 'App\\Models\\Journal', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":23,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"narration\",\"dr\":3000,\"cr\":null}}', '2021-02-05 14:53:47', '2021-02-05 14:53:47'),
(622, 'default', 'updated', 'App\\Models\\Journal', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"23050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 14:53:47', '2021-02-05 14:53:47'),
(623, 'default', 'created', 'App\\Models\\Journal', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":24,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10102000\",\"narration\":\"narration\",\"dr\":null,\"cr\":3000}}', '2021-02-05 14:53:47', '2021-02-05 14:53:47'),
(624, 'default', 'updated', 'App\\Models\\Journal', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"24050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 14:53:47', '2021-02-05 14:53:47'),
(625, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-04T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-05T15:03:28.000000Z\",\"updated_at\":\"2021-02-05T15:03:28.000000Z\"}}', '2021-02-05 15:03:28', '2021-02-05 15:03:28'),
(626, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1050221\"},\"old\":{\"customize_id\":null}}', '2021-02-05 15:03:28', '2021-02-05 15:03:28'),
(627, 'default', 'created', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"narration\",\"dr\":30000,\"cr\":null}}', '2021-02-05 15:03:28', '2021-02-05 15:03:28'),
(628, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:03:28', '2021-02-05 15:03:28'),
(629, 'default', 'created', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10102000\",\"narration\":\"narration\",\"dr\":null,\"cr\":30000}}', '2021-02-05 15:03:28', '2021-02-05 15:03:28'),
(630, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:03:28', '2021-02-05 15:03:28'),
(631, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10102000\",\"cr\":40000},\"old\":{\"acc_code\":\"10101000\",\"cr\":null}}', '2021-02-05 15:12:59', '2021-02-05 15:12:59'),
(632, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":40000},\"old\":{\"cr\":30000}}', '2021-02-05 15:12:59', '2021-02-05 15:12:59'),
(633, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-04T19:00:00.000000Z\",\"v_type\":\"purchase\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-05T15:14:48.000000Z\",\"updated_at\":\"2021-02-05T15:14:48.000000Z\"}}', '2021-02-05 15:14:48', '2021-02-05 15:14:48'),
(634, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1050221\"},\"old\":{\"customize_id\":null}}', '2021-02-05 15:14:48', '2021-02-05 15:14:48'),
(635, 'default', 'created', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"purchase\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"narration\",\"dr\":30000,\"cr\":null}}', '2021-02-05 15:14:48', '2021-02-05 15:14:48'),
(636, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:14:48', '2021-02-05 15:14:48'),
(637, 'default', 'created', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"purchase\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10102000\",\"narration\":\"narration\",\"dr\":null,\"cr\":30000}}', '2021-02-05 15:14:48', '2021-02-05 15:14:48'),
(638, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:14:48', '2021-02-05 15:14:48'),
(639, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10102000\",\"cr\":30000},\"old\":{\"acc_code\":\"10101000\",\"cr\":null}}', '2021-02-05 15:15:23', '2021-02-05 15:15:23'),
(640, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:15:23', '2021-02-05 15:15:23'),
(641, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:15:52', '2021-02-05 15:15:52'),
(642, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:15:52', '2021-02-05 15:15:52'),
(643, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":4000},\"old\":{\"cr\":30000}}', '2021-02-05 15:16:07', '2021-02-05 15:16:07'),
(644, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":4000},\"old\":{\"cr\":30000}}', '2021-02-05 15:16:07', '2021-02-05 15:16:07'),
(645, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10101000\",\"dr\":4000},\"old\":{\"acc_code\":\"10102000\",\"dr\":30000}}', '2021-02-05 15:24:14', '2021-02-05 15:24:14'),
(646, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:24:14', '2021-02-05 15:24:14'),
(647, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:24:26', '2021-02-05 15:24:26'),
(648, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"dr\":4000},\"old\":{\"dr\":null}}', '2021-02-05 15:24:26', '2021-02-05 15:24:26'),
(649, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:24:26', '2021-02-05 15:24:26'),
(650, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:24:26', '2021-02-05 15:24:26'),
(651, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":4000},\"old\":{\"cr\":null}}', '2021-02-05 15:27:39', '2021-02-05 15:27:39'),
(652, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"dr\":4000},\"old\":{\"dr\":null}}', '2021-02-05 15:27:39', '2021-02-05 15:27:39'),
(653, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"dr\":4000},\"old\":{\"dr\":null}}', '2021-02-05 15:28:01', '2021-02-05 15:28:01'),
(654, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":4000},\"old\":{\"cr\":null}}', '2021-02-05 15:28:01', '2021-02-05 15:28:01'),
(655, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"dr\":5000},\"old\":{\"dr\":4000}}', '2021-02-05 15:29:30', '2021-02-05 15:29:30'),
(656, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":5000},\"old\":{\"cr\":4000}}', '2021-02-05 15:29:30', '2021-02-05 15:29:30'),
(657, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:29:51', '2021-02-05 15:29:51'),
(658, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:29:51', '2021-02-05 15:29:51'),
(659, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":null},\"old\":{\"cr\":4000}}', '2021-02-05 15:30:28', '2021-02-05 15:30:28'),
(660, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"dr\":null},\"old\":{\"dr\":4000}}', '2021-02-05 15:30:28', '2021-02-05 15:30:28'),
(661, 'default', 'created', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-04T19:00:00.000000Z\",\"v_type\":\"cash-receipt\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-05T15:33:08.000000Z\",\"updated_at\":\"2021-02-05T15:33:08.000000Z\"}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(662, 'default', 'updated', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2050221\"},\"old\":{\"customize_id\":null}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(663, 'default', 'created', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":3,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-receipt\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10102000\",\"narration\":\"narration\",\"dr\":10000,\"cr\":null}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(664, 'default', 'updated', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"3050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(665, 'default', 'created', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":4,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-receipt\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"narratno\",\"dr\":null,\"cr\":5000}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(666, 'default', 'updated', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"4050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(667, 'default', 'created', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":5,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-receipt\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"mnarrion\",\"dr\":null,\"cr\":2000}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(668, 'default', 'updated', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"5050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(669, 'default', 'created', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":6,\"customize_id\":\"\",\"date\":\"2021-02-05\",\"type\":\"cash-receipt\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10101000\",\"narration\":\"naron\",\"dr\":null,\"cr\":3000}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(670, 'default', 'updated', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"6050221\",\"date\":\"2021-02-05\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-04T19:00:00.000000Z\"}}', '2021-02-05 15:33:08', '2021-02-05 15:33:08'),
(671, 'default', 'updated', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-05 15:33:56', '2021-02-05 15:33:56'),
(672, 'default', 'updated', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":4000},\"old\":{\"cr\":5000}}', '2021-02-05 15:33:56', '2021-02-05 15:33:56'),
(673, 'default', 'updated', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":4000},\"old\":{\"cr\":2000}}', '2021-02-05 15:33:56', '2021-02-05 15:33:56'),
(674, 'default', 'updated', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":2000},\"old\":{\"cr\":3000}}', '2021-02-05 15:33:56', '2021-02-05 15:33:56'),
(675, 'default', 'updated', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"dr\":5000},\"old\":{\"dr\":10000}}', '2021-02-05 15:34:18', '2021-02-05 15:34:18'),
(676, 'default', 'updated', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":2000},\"old\":{\"cr\":4000}}', '2021-02-05 15:34:18', '2021-02-05 15:34:18'),
(677, 'default', 'updated', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":2000},\"old\":{\"cr\":4000}}', '2021-02-05 15:34:18', '2021-02-05 15:34:18'),
(678, 'default', 'updated', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"cr\":1000},\"old\":{\"cr\":2000}}', '2021-02-05 15:34:18', '2021-02-05 15:34:18'),
(679, 'default', 'updated', 'App\\Models\\Attendance', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-06\",\"check_out\":\"09:18:58\",\"worked_hours\":33,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"19:52:46\",\"worked_hours\":0,\"status\":0}}', '2021-02-06 04:18:58', '2021-02-06 04:18:58'),
(680, 'default', 'created', 'App\\Models\\Attendance', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-06\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"09:19:05\",\"check_out\":\"09:19:05\",\"day\":\"Sat\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-06 04:19:05', '2021-02-06 04:19:05'),
(681, 'default', 'updated', 'App\\Models\\Attendance', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-06\",\"check_out\":\"09:19:14\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"09:19:05\",\"worked_hours\":0,\"status\":0}}', '2021-02-06 04:19:14', '2021-02-06 04:19:14'),
(682, 'default', 'created', 'App\\Models\\Attendance', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-06\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:19:24\",\"check_out\":\"10:19:24\",\"day\":\"Sat\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-06 05:19:24', '2021-02-06 05:19:24'),
(683, 'default', 'updated', 'App\\Models\\Attendance', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-06\",\"check_out\":\"10:20:17\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:19:24\",\"worked_hours\":0,\"status\":0}}', '2021-02-06 05:20:17', '2021-02-06 05:20:17'),
(684, 'default', 'created', 'App\\Models\\Attendance', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-06\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:24:04\",\"check_out\":\"10:24:04\",\"day\":\"Sat\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-06 05:24:04', '2021-02-06 05:24:04'),
(685, 'default', 'updated', 'App\\Models\\Attendance', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-06\",\"check_out\":\"10:25:22\",\"worked_hours\":34,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:24:04\",\"worked_hours\":0,\"status\":0}}', '2021-02-06 05:25:22', '2021-02-06 05:25:22'),
(686, 'default', 'created', 'App\\Models\\Attendance', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-06\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:25:30\",\"check_out\":\"10:25:30\",\"day\":\"Sat\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-06 05:25:30', '2021-02-06 05:25:30'),
(687, 'default', 'updated', 'App\\Models\\Attendance', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-06\",\"check_out\":\"10:25:38\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:25:30\",\"worked_hours\":0,\"status\":0}}', '2021-02-06 05:25:38', '2021-02-06 05:25:38'),
(688, 'default', 'updated', 'App\\Models\\Attendance', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out\":\"10:26:20\",\"status\":1},\"old\":{\"check_out\":\"10:25:38\",\"status\":0}}', '2021-02-06 05:26:20', '2021-02-06 05:26:20'),
(689, 'default', 'created', 'App\\Models\\Attendance', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-08\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"20:40:49\",\"check_out\":\"20:40:49\",\"day\":\"Mon\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-08 15:40:49', '2021-02-08 15:40:49'),
(690, 'default', 'updated', 'App\\Models\\Attendance', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-08\",\"check_out\":\"20:40:54\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"20:40:49\",\"worked_hours\":0,\"status\":0}}', '2021-02-08 15:40:54', '2021-02-08 15:40:54'),
(691, 'default', 'created', 'App\\Models\\Purchaseindent', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"location\":\"AIMS Cal Lab Lahore\",\"department\":3,\"indent_by\":1,\"checked_by\":1,\"approved_by\":1,\"indent_type\":\"capital\",\"deliver_to\":\"5\",\"status\":0,\"required\":\"2021-02-08\"}}', '2021-02-08 15:41:33', '2021-02-08 15:41:33'),
(692, 'default', 'created', 'App\\Models\\Purchaseindentitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"indent_id\":3,\"item_code\":\"code-1\",\"item_description\":\"description\",\"ref_code\":\"code\",\"unit\":\"ea\",\"last_six_months_consumption\":\"10\",\"current_stock\":\"10\",\"qty\":\"200\",\"purpose\":\"purposr\",\"title\":\"tile\",\"status\":0}}', '2021-02-08 15:42:52', '2021-02-08 15:42:52'),
(693, 'default', 'created', 'App\\Models\\Purchaseindent', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"location\":\"AIMS Cal Lab Lahore\",\"department\":1,\"indent_by\":1,\"checked_by\":1,\"approved_by\":1,\"indent_type\":\"normal\",\"deliver_to\":\"1\",\"status\":0,\"required\":\"2021-02-08\"}}', '2021-02-08 15:44:03', '2021-02-08 15:44:03'),
(694, 'default', 'updated', 'App\\Models\\Purchaseindentitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2},\"old\":{\"status\":0}}', '2021-02-08 15:50:25', '2021-02-08 15:50:25'),
(695, 'default', 'updated', 'App\\Models\\Purchaseindentitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":2}}', '2021-02-08 15:50:45', '2021-02-08 15:50:45'),
(696, 'default', 'created', 'App\\Models\\Materialreceiving', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"purchase_indent_item_id\":\"3\",\"received_from\":\"em azeem\",\"purchase_type\":\"local\",\"physical_check\":1,\"meet_specifications\":1,\"unit\":\"ea\",\"qty\":10,\"specifications\":\"1\",\"status\":0}}', '2021-02-08 15:51:27', '2021-02-08 15:51:27'),
(697, 'default', 'created', 'App\\Models\\AccLevelTwo', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"title\":\"Current Assets\"}}', '2021-02-16 04:56:42', '2021-02-16 04:56:42'),
(698, 'default', 'updated', 'App\\Models\\AccLevelTwo', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:56:42', '2021-02-16 04:56:42'),
(699, 'default', 'created', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":1,\"title\":\"Cash Balance\"}}', '2021-02-16 04:57:10', '2021-02-16 04:57:10'),
(700, 'default', 'updated', 'App\\Models\\AccLevelThree', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:57:10', '2021-02-16 04:57:10'),
(701, 'default', 'created', 'App\\Models\\AccLevelThree', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":1,\"title\":\"Bank Balance\"}}', '2021-02-16 04:57:24', '2021-02-16 04:57:24'),
(702, 'default', 'updated', 'App\\Models\\AccLevelThree', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:57:24', '2021-02-16 04:57:24'),
(703, 'default', 'created', 'App\\Models\\AccLevelThree', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":1,\"title\":\"Account Receivables\"}}', '2021-02-16 04:57:43', '2021-02-16 04:57:43'),
(704, 'default', 'updated', 'App\\Models\\AccLevelThree', 3, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:57:43', '2021-02-16 04:57:43'),
(705, 'default', 'created', 'App\\Models\\AccLevelThree', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":1,\"title\":\"Advance\"}}', '2021-02-16 04:58:01', '2021-02-16 04:58:01'),
(706, 'default', 'updated', 'App\\Models\\AccLevelThree', 4, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:58:01', '2021-02-16 04:58:01'),
(707, 'default', 'created', 'App\\Models\\AccLevelThree', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":1,\"title\":\"Deposits\"}}', '2021-02-16 04:58:16', '2021-02-16 04:58:16'),
(708, 'default', 'updated', 'App\\Models\\AccLevelThree', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:58:16', '2021-02-16 04:58:16'),
(709, 'default', 'created', 'App\\Models\\AccLevelTwo', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"title\":\"Non-current \\/ Fixed Assets\"}}', '2021-02-16 04:58:42', '2021-02-16 04:58:42'),
(710, 'default', 'updated', 'App\\Models\\AccLevelTwo', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:58:42', '2021-02-16 04:58:42'),
(711, 'default', 'created', 'App\\Models\\AccLevelThree', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"title\":\"Land & Building\"}}', '2021-02-16 04:59:02', '2021-02-16 04:59:02'),
(712, 'default', 'updated', 'App\\Models\\AccLevelThree', 6, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:59:02', '2021-02-16 04:59:02'),
(713, 'default', 'created', 'App\\Models\\AccLevelThree', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"title\":\"Equipments\"}}', '2021-02-16 04:59:17', '2021-02-16 04:59:17'),
(714, 'default', 'updated', 'App\\Models\\AccLevelThree', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:59:17', '2021-02-16 04:59:17'),
(715, 'default', 'created', 'App\\Models\\AccLevelThree', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"title\":\"Office Equipments\"}}', '2021-02-16 04:59:36', '2021-02-16 04:59:36'),
(716, 'default', 'updated', 'App\\Models\\AccLevelThree', 8, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:59:36', '2021-02-16 04:59:36'),
(717, 'default', 'created', 'App\\Models\\AccLevelThree', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"title\":\"Furniture\"}}', '2021-02-16 04:59:59', '2021-02-16 04:59:59'),
(718, 'default', 'updated', 'App\\Models\\AccLevelThree', 9, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 04:59:59', '2021-02-16 04:59:59'),
(719, 'default', 'created', 'App\\Models\\AccLevelThree', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"title\":\"Vehicles\"}}', '2021-02-16 05:00:12', '2021-02-16 05:00:12'),
(720, 'default', 'updated', 'App\\Models\\AccLevelThree', 10, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:00:12', '2021-02-16 05:00:12'),
(721, 'default', 'created', 'App\\Models\\AccLevelTwo', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"title\":\"Other\"}}', '2021-02-16 05:00:38', '2021-02-16 05:00:38'),
(722, 'default', 'updated', 'App\\Models\\AccLevelTwo', 3, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:00:38', '2021-02-16 05:00:38'),
(723, 'default', 'created', 'App\\Models\\AccLevelThree', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":3,\"title\":\"Goodwill\"}}', '2021-02-16 05:00:55', '2021-02-16 05:00:55'),
(724, 'default', 'updated', 'App\\Models\\AccLevelThree', 11, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:00:55', '2021-02-16 05:00:55'),
(725, 'default', 'created', 'App\\Models\\AccLevelTwo', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"title\":\"Current \\/ Short Term Liabilities\"}}', '2021-02-16 05:02:03', '2021-02-16 05:02:03'),
(726, 'default', 'updated', 'App\\Models\\AccLevelTwo', 4, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:02:03', '2021-02-16 05:02:03'),
(727, 'default', 'created', 'App\\Models\\AccLevelThree', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"code2\":4,\"title\":\"Accounts Payables\"}}', '2021-02-16 05:02:27', '2021-02-16 05:02:27'),
(728, 'default', 'updated', 'App\\Models\\AccLevelThree', 12, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:02:27', '2021-02-16 05:02:27'),
(729, 'default', 'created', 'App\\Models\\AccLevelThree', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"code2\":4,\"title\":\"Accrued Expenses\"}}', '2021-02-16 05:02:56', '2021-02-16 05:02:56'),
(730, 'default', 'updated', 'App\\Models\\AccLevelThree', 13, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:02:56', '2021-02-16 05:02:56'),
(731, 'default', 'created', 'App\\Models\\AccLevelThree', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"code2\":4,\"title\":\"Short Term Loans\"}}', '2021-02-16 05:03:12', '2021-02-16 05:03:12'),
(732, 'default', 'updated', 'App\\Models\\AccLevelThree', 14, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:03:12', '2021-02-16 05:03:12'),
(733, 'default', 'created', 'App\\Models\\AccLevelThree', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"code2\":4,\"title\":\"Taxes Payables\"}}', '2021-02-16 05:03:28', '2021-02-16 05:03:28'),
(734, 'default', 'updated', 'App\\Models\\AccLevelThree', 15, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:03:28', '2021-02-16 05:03:28'),
(735, 'default', 'created', 'App\\Models\\AccLevelTwo', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"title\":\"Non Current \\/ Long Term Laibilities\"}}', '2021-02-16 05:04:23', '2021-02-16 05:04:23'),
(736, 'default', 'updated', 'App\\Models\\AccLevelTwo', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:04:23', '2021-02-16 05:04:23'),
(737, 'default', 'created', 'App\\Models\\AccLevelThree', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"code2\":5,\"title\":\"Long Term Loans\"}}', '2021-02-16 05:04:49', '2021-02-16 05:04:49'),
(738, 'default', 'updated', 'App\\Models\\AccLevelThree', 16, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:04:49', '2021-02-16 05:04:49'),
(739, 'default', 'created', 'App\\Models\\AccLevelThree', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":4,\"code2\":5,\"title\":\"Mortgages\"}}', '2021-02-16 05:05:14', '2021-02-16 05:05:14'),
(740, 'default', 'updated', 'App\\Models\\AccLevelThree', 17, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:05:14', '2021-02-16 05:05:14'),
(741, 'default', 'created', 'App\\Models\\AccLevelTwo', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":3,\"title\":\"Equity - Money invested in\"}}', '2021-02-16 05:06:09', '2021-02-16 05:06:09'),
(742, 'default', 'updated', 'App\\Models\\AccLevelTwo', 6, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:06:09', '2021-02-16 05:06:09'),
(743, 'default', 'created', 'App\\Models\\AccLevelTwo', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":3,\"title\":\"Drawings - Money taken out\"}}', '2021-02-16 05:06:42', '2021-02-16 05:06:42'),
(744, 'default', 'updated', 'App\\Models\\AccLevelTwo', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:06:42', '2021-02-16 05:06:42'),
(745, 'default', 'created', 'App\\Models\\AccLevelTwo', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":3,\"title\":\"Retained Earnings - Accumulated Profit \\/ Loss\"}}', '2021-02-16 05:07:16', '2021-02-16 05:07:16'),
(746, 'default', 'updated', 'App\\Models\\AccLevelTwo', 8, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:07:16', '2021-02-16 05:07:16'),
(747, 'default', 'created', 'App\\Models\\AccLevelTwo', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"title\":\"Operating Revenues\"}}', '2021-02-16 05:08:09', '2021-02-16 05:08:09'),
(748, 'default', 'updated', 'App\\Models\\AccLevelTwo', 9, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:08:09', '2021-02-16 05:08:09'),
(749, 'default', 'created', 'App\\Models\\AccLevelTwo', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"title\":\"Non Operating Revenues\"}}', '2021-02-16 05:08:22', '2021-02-16 05:08:22'),
(750, 'default', 'updated', 'App\\Models\\AccLevelTwo', 10, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:08:22', '2021-02-16 05:08:22'),
(751, 'default', 'created', 'App\\Models\\AccLevelThree', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"title\":\"Product Sales\"}}', '2021-02-16 05:08:48', '2021-02-16 05:08:48'),
(752, 'default', 'updated', 'App\\Models\\AccLevelThree', 18, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:08:48', '2021-02-16 05:08:48'),
(753, 'default', 'created', 'App\\Models\\AccLevelThree', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"title\":\"Services Sale\"}}', '2021-02-16 05:09:04', '2021-02-16 05:09:04'),
(754, 'default', 'updated', 'App\\Models\\AccLevelThree', 19, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:09:04', '2021-02-16 05:09:04'),
(755, 'default', 'created', 'App\\Models\\AccLevelThree', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"title\":\"Discount to Customers\"}}', '2021-02-16 05:09:23', '2021-02-16 05:09:23'),
(756, 'default', 'updated', 'App\\Models\\AccLevelThree', 20, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:09:23', '2021-02-16 05:09:23'),
(757, 'default', 'created', 'App\\Models\\AccLevelThree', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"title\":\"Sales Returns\"}}', '2021-02-16 05:09:56', '2021-02-16 05:09:56'),
(758, 'default', 'updated', 'App\\Models\\AccLevelThree', 21, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:09:56', '2021-02-16 05:09:56'),
(759, 'default', 'created', 'App\\Models\\AccLevelThree', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":10,\"title\":\"Dividend Income\"}}', '2021-02-16 05:10:16', '2021-02-16 05:10:16'),
(760, 'default', 'updated', 'App\\Models\\AccLevelThree', 22, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:10:16', '2021-02-16 05:10:16'),
(761, 'default', 'created', 'App\\Models\\AccLevelThree', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":10,\"title\":\"Interest Income\"}}', '2021-02-16 05:10:31', '2021-02-16 05:10:31'),
(762, 'default', 'updated', 'App\\Models\\AccLevelThree', 23, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:10:31', '2021-02-16 05:10:31'),
(763, 'default', 'created', 'App\\Models\\AccLevelThree', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":10,\"title\":\"Insurance Reimbursements\"}}', '2021-02-16 05:11:11', '2021-02-16 05:11:11'),
(764, 'default', 'updated', 'App\\Models\\AccLevelThree', 24, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:11:11', '2021-02-16 05:11:11'),
(765, 'default', 'created', 'App\\Models\\AccLevelThree', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":10,\"title\":\"Proceeds from Disposal of Fixed Assets\"}}', '2021-02-16 05:11:48', '2021-02-16 05:11:48'),
(766, 'default', 'updated', 'App\\Models\\AccLevelThree', 25, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:11:48', '2021-02-16 05:11:48'),
(767, 'default', 'created', 'App\\Models\\AccLevelThree', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":10,\"title\":\"Exchange Gains\"}}', '2021-02-16 05:12:07', '2021-02-16 05:12:07'),
(768, 'default', 'updated', 'App\\Models\\AccLevelThree', 26, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:12:07', '2021-02-16 05:12:07'),
(769, 'default', 'created', 'App\\Models\\AccLevelTwo', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"title\":\"Operating Expenses\"}}', '2021-02-16 05:12:49', '2021-02-16 05:12:49'),
(770, 'default', 'updated', 'App\\Models\\AccLevelTwo', 11, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:12:49', '2021-02-16 05:12:49'),
(771, 'default', 'created', 'App\\Models\\AccLevelThree', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"title\":\"COGS\"}}', '2021-02-16 05:13:25', '2021-02-16 05:13:25'),
(772, 'default', 'updated', 'App\\Models\\AccLevelThree', 27, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:13:25', '2021-02-16 05:13:25'),
(773, 'default', 'created', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":27,\"acc_code\":\"\",\"title\":\"Cost of Material\"}}', '2021-02-16 05:13:54', '2021-02-16 05:13:54'),
(774, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:13:54', '2021-02-16 05:13:54'),
(775, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10127000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:13:54', '2021-02-16 05:13:54'),
(776, 'default', 'created', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":27,\"acc_code\":\"\",\"title\":\"Cost of Labor\"}}', '2021-02-16 05:14:10', '2021-02-16 05:14:10'),
(777, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:14:10', '2021-02-16 05:14:10'),
(778, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10127000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:14:10', '2021-02-16 05:14:10'),
(779, 'default', 'created', 'App\\Models\\Chartofaccount', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":27,\"acc_code\":\"\",\"title\":\"Shipping & Delivery Charges\"}}', '2021-02-16 05:14:38', '2021-02-16 05:14:38'),
(780, 'default', 'updated', 'App\\Models\\Chartofaccount', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:14:38', '2021-02-16 05:14:38'),
(781, 'default', 'updated', 'App\\Models\\Chartofaccount', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10127000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:14:38', '2021-02-16 05:14:38'),
(782, 'default', 'created', 'App\\Models\\Chartofaccount', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":27,\"acc_code\":\"\",\"title\":\"Subcontractor Payments\"}}', '2021-02-16 05:14:59', '2021-02-16 05:14:59'),
(783, 'default', 'updated', 'App\\Models\\Chartofaccount', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:14:59', '2021-02-16 05:14:59'),
(784, 'default', 'updated', 'App\\Models\\Chartofaccount', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10127000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:14:59', '2021-02-16 05:14:59'),
(785, 'default', 'created', 'App\\Models\\AccLevelThree', 28, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"title\":\"Selling Expenses\"}}', '2021-02-16 05:15:24', '2021-02-16 05:15:24'),
(786, 'default', 'updated', 'App\\Models\\AccLevelThree', 28, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:15:24', '2021-02-16 05:15:24'),
(787, 'default', 'created', 'App\\Models\\Chartofaccount', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":28,\"acc_code\":\"\",\"title\":\"Marketing Cost\"}}', '2021-02-16 05:15:44', '2021-02-16 05:15:44'),
(788, 'default', 'updated', 'App\\Models\\Chartofaccount', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:15:44', '2021-02-16 05:15:44'),
(789, 'default', 'updated', 'App\\Models\\Chartofaccount', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10128000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:15:44', '2021-02-16 05:15:44'),
(790, 'default', 'created', 'App\\Models\\Chartofaccount', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":28,\"acc_code\":\"\",\"title\":\"Selling Cost\"}}', '2021-02-16 05:15:56', '2021-02-16 05:15:56'),
(791, 'default', 'updated', 'App\\Models\\Chartofaccount', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:15:56', '2021-02-16 05:15:56'),
(792, 'default', 'updated', 'App\\Models\\Chartofaccount', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10128000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:15:56', '2021-02-16 05:15:56'),
(793, 'default', 'created', 'App\\Models\\AccLevelThree', 29, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"title\":\"General & Administration Expenses\"}}', '2021-02-16 05:16:36', '2021-02-16 05:16:36'),
(794, 'default', 'updated', 'App\\Models\\AccLevelThree', 29, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:16:36', '2021-02-16 05:16:36'),
(795, 'default', 'created', 'App\\Models\\Chartofaccount', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":29,\"acc_code\":\"\",\"title\":\"Staff Salaries\"}}', '2021-02-16 05:16:55', '2021-02-16 05:16:55'),
(796, 'default', 'updated', 'App\\Models\\Chartofaccount', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:16:55', '2021-02-16 05:16:55'),
(797, 'default', 'updated', 'App\\Models\\Chartofaccount', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10129000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:16:55', '2021-02-16 05:16:55'),
(798, 'default', 'created', 'App\\Models\\Chartofaccount', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":29,\"acc_code\":\"\",\"title\":\"Utilities\"}}', '2021-02-16 05:17:12', '2021-02-16 05:17:12'),
(799, 'default', 'updated', 'App\\Models\\Chartofaccount', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:17:12', '2021-02-16 05:17:12'),
(800, 'default', 'updated', 'App\\Models\\Chartofaccount', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10129000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:17:12', '2021-02-16 05:17:12'),
(801, 'default', 'created', 'App\\Models\\Chartofaccount', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":29,\"acc_code\":\"\",\"title\":\"Office Rent\"}}', '2021-02-16 05:17:32', '2021-02-16 05:17:32'),
(802, 'default', 'updated', 'App\\Models\\Chartofaccount', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:17:32', '2021-02-16 05:17:32'),
(803, 'default', 'updated', 'App\\Models\\Chartofaccount', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10129000\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:17:32', '2021-02-16 05:17:32'),
(804, 'default', 'created', 'App\\Models\\Chartofaccount', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":29,\"acc_code\":\"\",\"title\":\"Travelling\"}}', '2021-02-16 05:17:51', '2021-02-16 05:17:51'),
(805, 'default', 'updated', 'App\\Models\\Chartofaccount', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"\"},\"old\":{\"acc_code\":null}}', '2021-02-16 05:17:51', '2021-02-16 05:17:51'),
(806, 'default', 'updated', 'App\\Models\\Chartofaccount', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"10129001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 05:17:51', '2021-02-16 05:17:51'),
(807, 'default', 'created', 'App\\Models\\AccLevelTwo', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"title\":\"Non operating Expenses (Other)\"}}', '2021-02-16 05:18:47', '2021-02-16 05:18:47'),
(808, 'default', 'updated', 'App\\Models\\AccLevelTwo', 12, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:18:47', '2021-02-16 05:18:47'),
(809, 'default', 'created', 'App\\Models\\AccLevelThree', 30, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":12,\"title\":\"Interest Expenses\"}}', '2021-02-16 05:19:02', '2021-02-16 05:19:02'),
(810, 'default', 'updated', 'App\\Models\\AccLevelThree', 30, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:19:02', '2021-02-16 05:19:02');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(811, 'default', 'created', 'App\\Models\\AccLevelThree', 31, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"title\":\"Exchange Losses\"}}', '2021-02-16 05:19:19', '2021-02-16 05:19:19'),
(812, 'default', 'updated', 'App\\Models\\AccLevelThree', 31, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:19:19', '2021-02-16 05:19:19'),
(813, 'default', 'created', 'App\\Models\\AccLevelThree', 32, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"title\":\"Loss on Disposal of Fixed Assets\"}}', '2021-02-16 05:19:43', '2021-02-16 05:19:43'),
(814, 'default', 'updated', 'App\\Models\\AccLevelThree', 32, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 05:19:43', '2021-02-16 05:19:43'),
(815, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T05:31:14.000000Z\",\"updated_at\":\"2021-02-16T05:31:14.000000Z\"}}', '2021-02-16 05:31:14', '2021-02-16 05:31:14'),
(816, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 05:31:14', '2021-02-16 05:31:14'),
(817, 'default', 'created', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10129001\",\"narration\":\"Mr Shehzad & Mr. Azeem\",\"dr\":5000,\"cr\":null}}', '2021-02-16 05:31:14', '2021-02-16 05:31:14'),
(818, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 05:31:14', '2021-02-16 05:31:14'),
(819, 'default', 'created', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10129001\",\"narration\":\"Mr. Ahmad\",\"dr\":null,\"cr\":5000}}', '2021-02-16 05:31:14', '2021-02-16 05:31:14'),
(820, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 05:31:14', '2021-02-16 05:31:14'),
(821, 'default', 'created', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-01-15T19:00:00.000000Z\",\"v_type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T05:31:53.000000Z\",\"updated_at\":\"2021-02-16T05:31:53.000000Z\"}}', '2021-02-16 05:31:53', '2021-02-16 05:31:53'),
(822, 'default', 'updated', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 05:31:53', '2021-02-16 05:31:53'),
(823, 'default', 'created', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":3,\"customize_id\":\"\",\"date\":\"2021-01-16\",\"type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10129001\",\"narration\":\"Mr Shehzad\",\"dr\":null,\"cr\":15000}}', '2021-02-16 05:31:53', '2021-02-16 05:31:53'),
(824, 'default', 'updated', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"3160221\",\"date\":\"2021-01-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-01-15T19:00:00.000000Z\"}}', '2021-02-16 05:31:53', '2021-02-16 05:31:53'),
(825, 'default', 'created', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":4,\"customize_id\":\"\",\"date\":\"2021-01-16\",\"type\":\"journal\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10129000\",\"narration\":\"Mr. Imtiaz\",\"dr\":15000,\"cr\":null}}', '2021-02-16 05:31:53', '2021-02-16 05:31:53'),
(826, 'default', 'updated', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"4160221\",\"date\":\"2021-01-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-01-15T19:00:00.000000Z\"}}', '2021-02-16 05:31:53', '2021-02-16 05:31:53'),
(827, 'default', 'updated', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"updated_at\":\"2021-02-16T06:20:24.000000Z\"},\"old\":{\"v_date\":\"2021-01-15T19:00:00.000000Z\",\"updated_at\":\"2021-02-16T05:31:53.000000Z\"}}', '2021-02-16 06:20:24', '2021-02-16 06:20:24'),
(828, 'default', 'updated', 'App\\Models\\Journal', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"date\":\"2021-02-16\"},\"old\":{\"date\":\"2021-01-16\"}}', '2021-02-16 06:20:24', '2021-02-16 06:20:24'),
(829, 'default', 'updated', 'App\\Models\\Journal', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"date\":\"2021-02-16\"},\"old\":{\"date\":\"2021-01-16\"}}', '2021-02-16 06:20:24', '2021-02-16 06:20:24'),
(830, 'default', 'updated', 'App\\Models\\Journal', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 06:21:00', '2021-02-16 06:21:00'),
(831, 'default', 'updated', 'App\\Models\\Journal', 2, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 06:21:00', '2021-02-16 06:21:00'),
(832, 'default', 'created', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"sale\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T06:29:14.000000Z\",\"updated_at\":\"2021-02-16T06:29:14.000000Z\"}}', '2021-02-16 06:29:14', '2021-02-16 06:29:14'),
(833, 'default', 'updated', 'App\\Models\\Voucher', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"1160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 06:29:14', '2021-02-16 06:29:14'),
(834, 'default', 'created', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":5,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"sale voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10129000\",\"narration\":\"#Muhammad Azeem\",\"dr\":100000,\"cr\":null}}', '2021-02-16 06:29:14', '2021-02-16 06:29:14'),
(835, 'default', 'updated', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"5160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 06:29:14', '2021-02-16 06:29:14'),
(836, 'default', 'created', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":6,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"sale voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"10129000\",\"narration\":\"# INV # 923\",\"dr\":null,\"cr\":100000}}', '2021-02-16 06:29:14', '2021-02-16 06:29:14'),
(837, 'default', 'updated', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"6160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 06:29:14', '2021-02-16 06:29:14'),
(838, 'default', 'updated', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 06:29:42', '2021-02-16 06:29:42'),
(839, 'default', 'updated', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 06:29:42', '2021-02-16 06:29:42'),
(840, 'default', 'updated', 'App\\Models\\Journal', 5, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 06:30:59', '2021-02-16 06:30:59'),
(841, 'default', 'updated', 'App\\Models\\Journal', 6, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-16 06:30:59', '2021-02-16 06:30:59'),
(842, 'default', 'created', 'App\\Models\\Chartofaccount', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":1,\"code3\":1,\"acc_code\":\"\",\"title\":\"Muhammad Azeem\"}}', '2021-02-16 06:36:38', '2021-02-16 06:36:38'),
(843, 'default', 'updated', 'App\\Models\\Chartofaccount', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"501010011\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 06:36:38', '2021-02-16 06:36:38'),
(844, 'default', 'created', 'App\\Models\\Chartofaccount', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":7,\"acc_code\":\"\",\"title\":\"Spectrophotometer\"}}', '2021-02-16 06:54:22', '2021-02-16 06:54:22'),
(845, 'default', 'created', 'App\\Models\\Chartofaccount', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":7,\"acc_code\":\"\",\"title\":\"Spectrophotometer\"}}', '2021-02-16 06:54:35', '2021-02-16 06:54:35'),
(846, 'default', 'created', 'App\\Models\\Chartofaccount', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Chair\"}}', '2021-02-16 06:55:23', '2021-02-16 06:55:23'),
(847, 'default', 'updated', 'App\\Models\\Chartofaccount', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502090002\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 06:55:23', '2021-02-16 06:55:23'),
(848, 'default', 'created', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Chair\"}}', '2021-02-16 06:56:32', '2021-02-16 06:56:32'),
(849, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502090002\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 06:56:32', '2021-02-16 06:56:32'),
(850, 'default', 'created', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Table\"}}', '2021-02-16 06:57:09', '2021-02-16 06:57:09'),
(851, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502090003\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 06:57:09', '2021-02-16 06:57:09'),
(852, 'default', 'created', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Chairs\"}}', '2021-02-16 06:58:37', '2021-02-16 06:58:37'),
(853, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502092\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 06:58:37', '2021-02-16 06:58:37'),
(854, 'default', 'created', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Table\"}}', '2021-02-16 06:58:50', '2021-02-16 06:58:50'),
(855, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502093\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 06:58:50', '2021-02-16 06:58:50'),
(856, 'default', 'created', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Table\"}}', '2021-02-16 07:00:48', '2021-02-16 07:00:48'),
(857, 'default', 'updated', 'App\\Models\\Chartofaccount', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502090001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 07:00:48', '2021-02-16 07:00:48'),
(858, 'default', 'created', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":9,\"acc_code\":\"\",\"title\":\"Windows\"}}', '2021-02-16 07:01:19', '2021-02-16 07:01:19'),
(859, 'default', 'updated', 'App\\Models\\Chartofaccount', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502090002\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 07:01:19', '2021-02-16 07:01:19'),
(860, 'default', 'created', 'App\\Models\\Chartofaccount', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":8,\"acc_code\":\"\",\"title\":\"Stapler\"}}', '2021-02-16 07:01:41', '2021-02-16 07:01:41'),
(861, 'default', 'updated', 'App\\Models\\Chartofaccount', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502080001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 07:01:41', '2021-02-16 07:01:41'),
(862, 'default', 'created', 'App\\Models\\Chartofaccount', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":10,\"acc_code\":\"\",\"title\":\"GRK 9012\"}}', '2021-02-16 07:02:11', '2021-02-16 07:02:11'),
(863, 'default', 'updated', 'App\\Models\\Chartofaccount', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502100001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 07:02:11', '2021-02-16 07:02:11'),
(864, 'default', 'created', 'App\\Models\\Chartofaccount', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"code2\":2,\"code3\":10,\"acc_code\":\"\",\"title\":\"FDK 5580\"}}', '2021-02-16 07:02:57', '2021-02-16 07:02:57'),
(865, 'default', 'updated', 'App\\Models\\Chartofaccount', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"502100002\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 07:02:57', '2021-02-16 07:02:57'),
(866, 'default', 'created', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T08:24:07.000000Z\",\"updated_at\":\"2021-02-16T08:24:07.000000Z\"}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(867, 'default', 'updated', 'App\\Models\\Voucher', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"2160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(868, 'default', 'created', 'App\\Models\\Journal', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":7,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"502080001\",\"narration\":\"INV # 897243\",\"dr\":3000,\"cr\":null}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(869, 'default', 'updated', 'App\\Models\\Journal', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"7160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(870, 'default', 'created', 'App\\Models\\Journal', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":8,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"502100001\",\"narration\":\"INV # 283122\",\"dr\":null,\"cr\":4000}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(871, 'default', 'updated', 'App\\Models\\Journal', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"8160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(872, 'default', 'created', 'App\\Models\\Journal', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":9,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"502090001\",\"narration\":\"INV # 830942\",\"dr\":1000,\"cr\":null}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(873, 'default', 'updated', 'App\\Models\\Journal', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"9160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 08:24:07', '2021-02-16 08:24:07'),
(874, 'default', 'created', 'App\\Models\\Voucher', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T08:24:57.000000Z\",\"updated_at\":\"2021-02-16T08:24:57.000000Z\"}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(875, 'default', 'updated', 'App\\Models\\Voucher', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"3160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(876, 'default', 'created', 'App\\Models\\Journal', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":10,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"502100002\",\"narration\":\"INV # 897243\",\"dr\":60000,\"cr\":null}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(877, 'default', 'updated', 'App\\Models\\Journal', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"10160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(878, 'default', 'created', 'App\\Models\\Journal', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":11,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"502080001\",\"narration\":\"INV # 283122\",\"dr\":null,\"cr\":80000}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(879, 'default', 'updated', 'App\\Models\\Journal', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"11160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(880, 'default', 'created', 'App\\Models\\Journal', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":12,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"502100002\",\"narration\":\"INV # 830942\",\"dr\":20000,\"cr\":null}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(881, 'default', 'updated', 'App\\Models\\Journal', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"12160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 08:24:57', '2021-02-16 08:24:57'),
(882, 'default', 'created', 'App\\Models\\Chartofaccount', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"code3\":19,\"acc_code\":\"\",\"title\":\"Shaigan Pharma\"}}', '2021-02-16 14:46:23', '2021-02-16 14:46:23'),
(883, 'default', 'updated', 'App\\Models\\Chartofaccount', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"201190001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 14:46:23', '2021-02-16 14:46:23'),
(884, 'default', 'created', 'App\\Models\\Chartofaccount', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"code3\":19,\"acc_code\":\"\",\"title\":\"Morinaga\"}}', '2021-02-16 14:46:47', '2021-02-16 14:46:47'),
(885, 'default', 'updated', 'App\\Models\\Chartofaccount', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"201190002\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 14:46:47', '2021-02-16 14:46:47'),
(886, 'default', 'created', 'App\\Models\\Chartofaccount', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":2,\"code2\":9,\"code3\":19,\"acc_code\":\"\",\"title\":\"Intertek Ltd\"}}', '2021-02-16 14:47:02', '2021-02-16 14:47:02'),
(887, 'default', 'updated', 'App\\Models\\Chartofaccount', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"201190003\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 14:47:02', '2021-02-16 14:47:02'),
(888, 'default', 'created', 'App\\Models\\Chartofaccount', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":11,\"code3\":29,\"acc_code\":\"\",\"title\":\"Fuel\"}}', '2021-02-16 14:47:54', '2021-02-16 14:47:54'),
(889, 'default', 'updated', 'App\\Models\\Chartofaccount', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"101290001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 14:47:54', '2021-02-16 14:47:54'),
(890, 'default', 'created', 'App\\Models\\Voucher', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T14:49:51.000000Z\",\"updated_at\":\"2021-02-16T14:49:51.000000Z\"}}', '2021-02-16 14:49:51', '2021-02-16 14:49:51'),
(891, 'default', 'updated', 'App\\Models\\Voucher', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"4160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 14:49:51', '2021-02-16 14:49:51'),
(892, 'default', 'created', 'App\\Models\\Journal', 131, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":131,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"201190003\",\"narration\":\"INV # 89634\",\"dr\":50000,\"cr\":null}}', '2021-02-16 14:49:51', '2021-02-16 14:49:51'),
(893, 'default', 'updated', 'App\\Models\\Journal', 131, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"131160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 14:49:51', '2021-02-16 14:49:51'),
(894, 'default', 'created', 'App\\Models\\Journal', 132, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":132,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"201190002\",\"narration\":\"INV # 89634342\",\"dr\":null,\"cr\":50000}}', '2021-02-16 14:49:51', '2021-02-16 14:49:51'),
(895, 'default', 'updated', 'App\\Models\\Journal', 132, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"132160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 14:49:51', '2021-02-16 14:49:51'),
(896, 'default', 'created', 'App\\Models\\Voucher', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"cash-payment\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T14:50:08.000000Z\",\"updated_at\":\"2021-02-16T14:50:08.000000Z\"}}', '2021-02-16 14:50:08', '2021-02-16 14:50:08'),
(897, 'default', 'updated', 'App\\Models\\Voucher', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"5160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 14:50:08', '2021-02-16 14:50:08'),
(898, 'default', 'created', 'App\\Models\\Journal', 133, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":133,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"101290001\",\"narration\":\"INV # 89634\",\"dr\":10000,\"cr\":null}}', '2021-02-16 14:50:08', '2021-02-16 14:50:08'),
(899, 'default', 'updated', 'App\\Models\\Journal', 133, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"133160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 14:50:08', '2021-02-16 14:50:08'),
(900, 'default', 'created', 'App\\Models\\Journal', 134, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":134,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"cash-payment voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"201190003\",\"narration\":\"INV # 89634342\",\"dr\":null,\"cr\":10000}}', '2021-02-16 14:50:08', '2021-02-16 14:50:08'),
(901, 'default', 'updated', 'App\\Models\\Journal', 134, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"134160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 14:50:08', '2021-02-16 14:50:08'),
(902, 'default', 'created', 'App\\Models\\Chartofaccount', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":1,\"code2\":12,\"code3\":30,\"acc_code\":\"\",\"title\":\"Testing\"}}', '2021-02-16 14:55:54', '2021-02-16 14:55:54'),
(903, 'default', 'updated', 'App\\Models\\Chartofaccount', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"acc_code\":\"102300001\"},\"old\":{\"acc_code\":\"\"}}', '2021-02-16 14:55:54', '2021-02-16 14:55:54'),
(904, 'default', 'created', 'App\\Models\\Voucher', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"\",\"v_date\":\"2021-02-15T19:00:00.000000Z\",\"v_type\":\"bank-receipt\",\"created_by\":1,\"updated_by\":1,\"created_at\":\"2021-02-16T14:56:16.000000Z\",\"updated_at\":\"2021-02-16T14:56:16.000000Z\"}}', '2021-02-16 14:56:16', '2021-02-16 14:56:16'),
(905, 'default', 'updated', 'App\\Models\\Voucher', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"6160221\"},\"old\":{\"customize_id\":null}}', '2021-02-16 14:56:16', '2021-02-16 14:56:16'),
(906, 'default', 'created', 'App\\Models\\Journal', 147, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":147,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"bank-receipt voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"201190003\",\"narration\":\"testimg\",\"dr\":30000,\"cr\":null}}', '2021-02-16 14:56:16', '2021-02-16 14:56:16'),
(907, 'default', 'updated', 'App\\Models\\Journal', 147, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"147160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 14:56:16', '2021-02-16 14:56:16'),
(908, 'default', 'created', 'App\\Models\\Journal', 148, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":148,\"customize_id\":\"\",\"date\":\"2021-02-16\",\"type\":\"bank-receipt voucher\",\"created_by\":1,\"updated_by\":1,\"acc_code\":\"102300001\",\"narration\":\"anekr\",\"dr\":null,\"cr\":30000}}', '2021-02-16 14:56:16', '2021-02-16 14:56:16'),
(909, 'default', 'updated', 'App\\Models\\Journal', 148, 'App\\Models\\User', 1, '{\"attributes\":{\"customize_id\":\"148160221\",\"date\":\"2021-02-16\"},\"old\":{\"customize_id\":null,\"date\":\"2021-02-15T19:00:00.000000Z\"}}', '2021-02-16 14:56:16', '2021-02-16 14:56:16'),
(910, 'default', 'created', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1159,\"type\":null,\"rfq_mode\":\"whatsapp\",\"rfq_mode_details\":\"030019310123\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Saqib Raza\",\"revision\":0}}', '2021-02-17 09:13:45', '2021-02-17 09:13:45'),
(911, 'default', 'created', 'App\\Models\\Item', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":27,\"capability\":863,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"-20~650\",\"price\":6000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-17 09:14:08', '2021-02-17 09:14:08'),
(912, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-02-17 09:14:08', '2021-02-17 09:14:08'),
(913, 'default', 'created', 'App\\Models\\Item', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1,\"status\":0,\"parameter\":6,\"capability\":266,\"not_available\":null,\"location\":\"site\",\"accredited\":\"no\",\"range\":\"0~1500\",\"price\":15000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-17 09:14:37', '2021-02-17 09:14:37'),
(914, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"BOTH\"},\"old\":{\"type\":\"LAB\"}}', '2021-02-17 09:14:37', '2021-02-17 09:14:37'),
(915, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-17 09:14:55', '2021-02-17 09:14:55'),
(916, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2},\"old\":{\"status\":1}}', '2021-02-17 09:15:08', '2021-02-17 09:15:08'),
(917, 'default', 'updated', 'App\\Models\\Quotes', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"SPLIT\",\"status\":3},\"old\":{\"type\":\"BOTH\",\"status\":2}}', '2021-02-17 09:15:16', '2021-02-17 09:15:16'),
(918, 'default', 'updated', 'App\\Models\\Menu', 58, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":1},\"old\":{\"position\":0}}', '2021-02-17 09:16:22', '2021-02-17 09:16:22'),
(919, 'default', 'updated', 'App\\Models\\Menu', 64, 'App\\Models\\User', 1, '{\"attributes\":{\"position\":2},\"old\":{\"position\":0}}', '2021-02-17 09:16:33', '2021-02-17 09:16:33'),
(920, 'default', 'created', 'App\\Models\\Job', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-02-17 09:16:50', '2021-02-17 09:16:50'),
(921, 'default', 'created', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1,\"item_id\":1,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-17 09:16:50', '2021-02-17 09:16:50'),
(922, 'default', 'created', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":1,\"job_id\":1,\"item_id\":2,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-17 09:16:50', '2021-02-17 09:16:50'),
(923, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"start\":\"2021-02-17\",\"end\":\"2021-02-18\",\"group_users\":\"1\",\"group_assets\":\"34\"},\"old\":{\"start\":null,\"end\":null,\"group_users\":null,\"group_assets\":null}}', '2021-02-17 09:17:31', '2021-02-17 09:17:31'),
(924, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"eq\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-17 09:18:01', '2021-02-17 09:18:01'),
(925, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-17\",\"end\":\"2021-02-18\",\"assign_user\":1,\"assign_assets\":\"33\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-17 09:18:58', '2021-02-17 09:18:58'),
(926, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-17 14:21:10\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-17 09:21:10', '2021-02-17 09:21:10'),
(927, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.3\",\"accuracy\":\"0.1\",\"range\":\"10-100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-17 09:23:26', '2021-02-17 09:23:26'),
(928, 'default', 'created', 'App\\Models\\Preference', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":null,\"category\":\"Calculators\",\"slug\":null,\"value\":null}}', '2021-02-17 09:49:05', '2021-02-17 09:49:05'),
(929, 'default', 'created', 'App\\Models\\Preference', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"General Calculator\",\"category\":\"18\",\"slug\":\"general-calculator\",\"value\":\"0\"}}', '2021-02-17 09:49:35', '2021-02-17 09:49:35'),
(930, 'default', 'created', 'App\\Models\\Preference', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Balance Calculator\",\"category\":\"18\",\"slug\":\"balance-calculator\",\"value\":\"0\"}}', '2021-02-17 09:50:12', '2021-02-17 09:50:12'),
(931, 'default', 'updated', 'App\\Models\\Preference', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"slug\":\"calculators\"},\"old\":{\"slug\":null}}', '2021-02-17 09:53:54', '2021-02-17 09:53:54'),
(932, 'default', 'created', 'App\\Models\\Capabilities', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"testing\",\"parameter\":1,\"procedure\":1,\"range\":\"10-100\",\"price\":1000,\"accuracy\":\"2000\",\"unit\":\"1\",\"remarks\":\"remarks\",\"location\":\"site\",\"accredited\":\"no\"}}', '2021-02-17 10:13:35', '2021-02-17 10:13:35'),
(933, 'default', 'created', 'App\\Models\\Capabilities', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"name\",\"parameter\":1,\"procedure\":1,\"range\":\"1\",\"price\":1,\"accuracy\":\"1\",\"unit\":\"1\",\"remarks\":\"1\",\"location\":\"site\",\"accredited\":\"yes\"}}', '2021-02-17 10:15:55', '2021-02-17 10:15:55'),
(934, 'default', 'updated', 'App\\Models\\Capabilities', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"5\"},\"old\":{\"unit\":\"uS\\/cm\"}}', '2021-02-17 10:19:26', '2021-02-17 10:19:26'),
(935, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"10928034\",\"serial\":\"derial\",\"model\":\"mowl\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":2},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":1}}', '2021-02-17 10:25:37', '2021-02-17 10:25:37'),
(936, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-17 15:25:44\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-17 10:25:44', '2021-02-17 10:25:44'),
(937, 'default', 'updated', 'App\\Models\\Capabilities', 266, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"38\",\"accredited\":\"yes\"},\"old\":{\"unit\":\"kN\",\"accredited\":\"no\"}}', '2021-02-17 10:26:36', '2021-02-17 10:26:36'),
(938, 'default', 'updated', 'App\\Models\\Preference', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"category\":\"AIMS LABS\",\"slug\":\"aims-labs\"},\"old\":{\"category\":\"AIMS Labs\",\"slug\":null}}', '2021-02-17 10:51:33', '2021-02-17 10:51:33'),
(939, 'default', 'created', 'App\\Models\\Attendance', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-18\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"09:13:38\",\"check_out\":\"09:13:38\",\"day\":\"Thu\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-18 04:13:38', '2021-02-18 04:13:38'),
(940, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-18\",\"assign_assets\":\"34,31\"},\"old\":{\"status\":1,\"start\":\"2021-02-17\",\"assign_assets\":\"33\"}}', '2021-02-18 04:24:47', '2021-02-18 04:24:47'),
(941, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-18 09:25:13\"},\"old\":{\"status\":2,\"started_at\":\"2021-02-17 14:21:10\"}}', '2021-02-18 04:25:13', '2021-02-18 04:25:13'),
(942, 'default', 'updated', 'App\\Models\\Preference', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Lab 02\"},\"old\":{\"name\":\"Lab # 02\"}}', '2021-02-18 04:33:42', '2021-02-18 04:33:42'),
(943, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"range\":\"10-100,10-100\"},\"old\":{\"range\":\"10-100\"}}', '2021-02-18 05:00:13', '2021-02-18 05:00:13'),
(944, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.1\",\"accuracy\":\"0.5\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-18 07:44:26', '2021-02-18 07:44:26'),
(945, 'default', 'created', 'App\\Models\\Preference', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":null,\"category\":\"Channels\",\"slug\":\"channels\",\"value\":null}}', '2021-02-19 06:45:49', '2021-02-19 06:45:49'),
(946, 'default', 'created', 'App\\Models\\Preference', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Incubator Calculator\",\"category\":\"18\",\"slug\":\"incubator-calculator\",\"value\":\"0\"}}', '2021-02-21 14:11:47', '2021-02-21 14:11:47'),
(947, 'default', 'updated', 'App\\Models\\Capabilities', 863, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"1\"},\"old\":{\"unit\":\"?C\"}}', '2021-02-21 14:13:55', '2021-02-21 14:13:55'),
(948, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-21\",\"end\":\"2021-02-21\",\"assign_assets\":\"73\"},\"old\":{\"status\":1,\"start\":\"2021-02-18\",\"end\":\"2021-02-18\",\"assign_assets\":\"34,31\"}}', '2021-02-21 14:16:21', '2021-02-21 14:16:21'),
(949, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-21 19:18:32\"},\"old\":{\"status\":2,\"started_at\":\"2021-02-18 09:25:13\"}}', '2021-02-21 14:18:32', '2021-02-21 14:18:32'),
(950, 'default', 'created', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1055,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"email@gmail.com\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Muhammad Adil Ghani\",\"revision\":0}}', '2021-02-21 15:09:32', '2021-02-21 15:09:32'),
(951, 'default', 'created', 'App\\Models\\Item', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":27,\"capability\":863,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"-20~650\",\"price\":6000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-21 15:11:35', '2021-02-21 15:11:35'),
(952, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-02-21 15:11:35', '2021-02-21 15:11:35'),
(953, 'default', 'created', 'App\\Models\\Item', 1001, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":27,\"capability\":907,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"35~650\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-21 15:12:01', '2021-02-21 15:12:01'),
(954, 'default', 'created', 'App\\Models\\Item', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":3,\"capability\":207,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"no\",\"range\":\"50\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-21 15:12:28', '2021-02-21 15:12:28'),
(955, 'default', 'created', 'App\\Models\\Item', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":6,\"capability\":271,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"no\",\"range\":\"50~15000\",\"price\":8000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-21 15:14:23', '2021-02-21 15:14:23'),
(956, 'default', 'created', 'App\\Models\\Item', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":3,\"capability\":187,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"no\",\"range\":\"49\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-21 15:14:41', '2021-02-21 15:14:41'),
(957, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-21 15:15:15', '2021-02-21 15:15:15'),
(958, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-02-21 15:16:04', '2021-02-21 15:16:04'),
(959, 'default', 'created', 'App\\Models\\Job', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(960, 'default', 'created', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1000,\"item_id\":1000,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(961, 'default', 'created', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1000,\"item_id\":1001,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(962, 'default', 'created', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1000,\"item_id\":1002,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(963, 'default', 'created', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1000,\"item_id\":1003,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(964, 'default', 'created', 'App\\Models\\Jobitem', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1000,\"item_id\":1004,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(965, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment 1\",\"serial\":\"serial1\",\"model\":\"model1\",\"make\":\"make1\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-21 15:17:07', '2021-02-21 15:17:07'),
(966, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment2\",\"serial\":\"serial2\",\"model\":\"model2\",\"make\":\"make2\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-21 15:17:28', '2021-02-21 15:17:28'),
(967, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment3\",\"serial\":\"serial3\",\"model\":\"model3\",\"make\":\"make3\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-21 15:17:48', '2021-02-21 15:17:48'),
(968, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-21 15:18:01', '2021-02-21 15:18:01'),
(969, 'default', 'updated', 'App\\Models\\Jobitem', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment5\",\"serial\":\"serial5\",\"model\":\"model5\",\"make\":\"make5\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-21 15:18:20', '2021-02-21 15:18:20'),
(970, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-21\",\"end\":\"2021-02-21\",\"assign_user\":1,\"assign_assets\":\"34\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-21 15:47:16', '2021-02-21 15:47:16'),
(971, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-21 20:50:06\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-21 15:50:06', '2021-02-21 15:50:06'),
(972, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"50\",\"accuracy\":\"50\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-21 16:03:46', '2021-02-21 16:03:46'),
(973, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-21\",\"end\":\"2021-02-21\",\"assign_user\":1,\"assign_assets\":\"26\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-21 16:32:13', '2021-02-21 16:32:13'),
(974, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-21 21:32:23\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-21 16:32:23', '2021-02-21 16:32:23'),
(975, 'default', 'updated', 'App\\Models\\Jobitem', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.1\",\"accuracy\":\"0.5\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-21 16:36:21', '2021-02-21 16:36:21'),
(976, 'default', 'created', 'App\\Models\\AccLevelTwo', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"code1\":5,\"title\":\"Current Assets\"}}', '2021-02-22 05:07:47', '2021-02-22 05:07:47'),
(977, 'default', 'updated', 'App\\Models\\AccLevelTwo', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-22 05:07:47', '2021-02-22 05:07:47'),
(978, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-22\",\"end\":\"2021-02-22\",\"assign_user\":1,\"assign_assets\":\"93\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-22 10:08:15', '2021-02-22 10:08:15'),
(979, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-22 15:08:28\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-22 10:08:28', '2021-02-22 10:08:28'),
(980, 'default', 'updated', 'App\\Models\\Capabilities', 207, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"1\"},\"old\":{\"unit\":\"mm\"}}', '2021-02-22 10:11:45', '2021-02-22 10:11:45'),
(981, 'default', 'updated', 'App\\Models\\Jobitem', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.1\",\"accuracy\":\"0.5\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-22 10:13:20', '2021-02-22 10:13:20'),
(982, 'default', 'updated', 'App\\Models\\Capabilities', 863, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-22 10:48:24', '2021-02-22 10:48:24'),
(983, 'default', 'updated', 'App\\Models\\Jobitem', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.1\",\"accuracy\":\"0.3\"},\"old\":{\"resolution\":\"50\",\"accuracy\":\"50\"}}', '2021-02-22 11:10:29', '2021-02-22 11:10:29'),
(984, 'default', 'updated', 'App\\Models\\Unit', 4, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-22 11:57:24', '2021-02-22 11:57:24'),
(985, 'default', 'updated', 'App\\Models\\Capabilities', 907, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"1\"},\"old\":{\"unit\":\"?C\"}}', '2021-02-22 12:41:48', '2021-02-22 12:41:48'),
(986, 'default', 'updated', 'App\\Models\\Capabilities', 907, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-22 12:46:12', '2021-02-22 12:46:12'),
(987, 'default', 'updated', 'App\\Models\\Unit', 38, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-22 14:44:11', '2021-02-22 14:44:11'),
(988, 'default', 'updated', 'App\\Models\\Capabilities', 207, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-22 15:07:03', '2021-02-22 15:07:03'),
(989, 'default', 'updated', 'App\\Models\\Preference', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Has Channels\",\"category\":\"21\",\"slug\":\"has-channels\",\"value\":\"73,30\"},\"old\":{\"name\":null,\"category\":\"Channels\",\"slug\":\"channels\",\"value\":null}}', '2021-02-23 12:45:46', '2021-02-23 12:45:46'),
(990, 'default', 'created', 'App\\Models\\Managereference', 754, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"-20.1\",\"ref\":\"-20.12\",\"error\":\"0.02\",\"uncertainty\":\"0.34\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(991, 'default', 'created', 'App\\Models\\Managereference', 755, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"-10.3\",\"ref\":\"-10.5\",\"error\":\"0.2\",\"uncertainty\":\"0.34\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(992, 'default', 'created', 'App\\Models\\Managereference', 756, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"-1.0\",\"ref\":\"-0.3\",\"error\":\"-0.7\",\"uncertainty\":\"0.34\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(993, 'default', 'created', 'App\\Models\\Managereference', 757, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"23.5\",\"ref\":\"25.01\",\"error\":\"-1.51\",\"uncertainty\":\"0.34\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(994, 'default', 'created', 'App\\Models\\Managereference', 758, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"48.5\",\"ref\":\"50.06\",\"error\":\"-1.56\",\"uncertainty\":\"0.52\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(995, 'default', 'created', 'App\\Models\\Managereference', 759, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"98.3\",\"ref\":\"99.95\",\"error\":\"-1.65\",\"uncertainty\":\"0.52\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(996, 'default', 'created', 'App\\Models\\Managereference', 760, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"149.7\",\"ref\":\"149.84\",\"error\":\"-0.14000000000001\",\"uncertainty\":\"0.52\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(997, 'default', 'created', 'App\\Models\\Managereference', 761, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"201.1\",\"ref\":\"199.9\",\"error\":\"1.2\",\"uncertainty\":\"0.91\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(998, 'default', 'created', 'App\\Models\\Managereference', 762, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"252.7\",\"ref\":\"249.98\",\"error\":\"2.72\",\"uncertainty\":\"0.91\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(999, 'default', 'created', 'App\\Models\\Managereference', 763, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"303.6\",\"ref\":\"300.02\",\"error\":\"3.58\",\"uncertainty\":\"0.91\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(1000, 'default', 'created', 'App\\Models\\Managereference', 764, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":27,\"asset\":30,\"unit\":1,\"uuc\":\"355.1\",\"ref\":\"350\",\"error\":\"5.1\",\"uncertainty\":\"0.91\"}}', '2021-02-23 12:59:21', '2021-02-23 12:59:21'),
(1001, 'default', 'created', 'App\\Models\\Uncertainty', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty Due to repeatability of indication of UUC (u6)\",\"slug\":\"uncertainty-due-to-repeatability-of-indication-of-uuc-u6\",\"formula\":\"\\u03b4T ind \\/ \\u221a11\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-23 14:37:12', '2021-02-23 14:37:12'),
(1002, 'default', 'created', 'App\\Models\\Uncertainty', 28, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty Due to Temp Inhomogenity   of UUC (u7)\",\"slug\":\"uncertainty-due-to-temp-inhomogenity-of-uuc-u7\",\"formula\":\"\\u03b4T inhom \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-23 14:37:57', '2021-02-23 14:37:57'),
(1003, 'default', 'created', 'App\\Models\\Uncertainty', 29, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty Due to Temp Instability of UUC (u8)\",\"slug\":\"uncertainty-due-to-temp-instability-of-uuc-u8\",\"formula\":\"\\u03b4Tinstab \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-23 14:38:50', '2021-02-23 14:38:50'),
(1004, 'default', 'created', 'App\\Models\\Uncertainty', 30, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty Due to Radiation Effect (u9)\",\"slug\":\"uncertainty-due-to-radiation-effect-u9\",\"formula\":\"\\u03b4Tradiation \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-23 14:39:41', '2021-02-23 14:39:41'),
(1005, 'default', 'created', 'App\\Models\\Uncertainty', 31, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty Due to Loading Effect (u10)\",\"slug\":\"uncertainty-due-to-loading-effect-u10\",\"formula\":\"\\u03b4Tload \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-23 14:40:39', '2021-02-23 14:40:39'),
(1006, 'default', 'created', 'App\\Models\\Procedure', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"DKD-R 5-7\",\"uncertainties\":\"uncertainty-type-a,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-resolution-of-std,uncertainty-due-to-repeatability-of-indication-of-uuc-u6,uncertainty-due-to-temp-inhomogenity-of-uuc-u7,uncertainty-due-to-temp-instability-of-uuc-u8,uncertainty-due-to-radiation-effect-u9,uncertainty-due-to-loading-effect-u10\",\"description\":\"Calibration of Climatic Chambers\"}}', '2021-02-23 14:45:32', '2021-02-23 14:45:32'),
(1007, 'default', 'updated', 'App\\Models\\Capabilities', 207, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":15},\"old\":{\"procedure\":1}}', '2021-02-23 14:47:12', '2021-02-23 14:47:12'),
(1008, 'default', 'updated', 'App\\Models\\Procedure', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-resolution-of-std,uncertainty-due-to-repeatability-of-indication-of-uuc-u6,uncertainty-due-to-temp-inhomogenity-of-uuc-u7,uncertainty-due-to-temp-instability-of-uuc-u8,uncertainty-due-to-radiation-effect-u9,uncertainty-due-to-loading-effect-u10\"},\"old\":{\"uncertainties\":\"uncertainty-type-a,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-resolution-of-std,uncertainty-due-to-repeatability-of-indication-of-uuc-u6,uncertainty-due-to-temp-inhomogenity-of-uuc-u7,uncertainty-due-to-temp-instability-of-uuc-u8,uncertainty-due-to-radiation-effect-u9,uncertainty-due-to-loading-effect-u10\"}}', '2021-02-24 12:36:29', '2021-02-24 12:36:29'),
(1009, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-25\",\"end\":\"2021-02-25\",\"assign_user\":1,\"assign_assets\":\"37\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-25 06:03:49', '2021-02-25 06:03:49'),
(1010, 'default', 'created', 'App\\Models\\Uncertainty', 32, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of Source Emissivity From X2.4.5 of ASTM E2847 (u4)\",\"slug\":\"uncertainty-of-source-emissivity-from-x2-4-5-of-astm-e2847-u4\",\"formula\":\"dT e \\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 06:07:12', '2021-02-25 06:07:12'),
(1011, 'default', 'created', 'App\\Models\\Uncertainty', 33, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty of  Reflected Ambient Radiation From X2.13 of ASTM E2847 (u5)\\\"\",\"slug\":\"uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5\",\"formula\":\"dTReflect \\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 06:07:41', '2021-02-25 06:07:41'),
(1012, 'default', 'created', 'App\\Models\\Uncertainty', 34, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty of Source Heat Exchange (X1.1 table in ASTM E2847)  (u6)\\\"\",\"slug\":\"uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6\",\"formula\":\"dTheat exch\\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 06:08:00', '2021-02-25 06:08:00'),
(1013, 'default', 'created', 'App\\Models\\Uncertainty', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty Due to Source Stability From Manual of Source  (u7)\\\"\",\"slug\":\"uncertainty-due-to-source-stability-from-manual-of-source-u7\",\"formula\":\"dTstab \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 06:08:16', '2021-02-25 06:08:16'),
(1014, 'default', 'created', 'App\\Models\\Uncertainty', 36, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty Due to Source Uniformity From Manual of Source  (u8)\\\"\",\"slug\":\"uncertainty-due-to-source-uniformity-from-manual-of-source-u8\",\"formula\":\"dTuniform \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 06:08:51', '2021-02-25 06:08:51'),
(1015, 'default', 'created', 'App\\Models\\Procedure', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"ASTM E2847-11\",\"uncertainties\":\"standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5,uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6,uncertainty-due-to-source-stability-from-manual-of-source-u7,uncertainty-due-to-source-uniformity-from-manual-of-source-u8\",\"description\":\"International Standard Procedure for Calibration of IR Thermometer\"}}', '2021-02-25 06:13:10', '2021-02-25 06:13:10'),
(1016, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-25 11:17:55\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-25 06:17:55', '2021-02-25 06:17:55'),
(1017, 'default', 'updated', 'App\\Models\\Capabilities', 271, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":16,\"unit\":\"1\"},\"old\":{\"procedure\":1,\"unit\":\"lbs\"}}', '2021-02-25 06:20:37', '2021-02-25 06:20:37'),
(1018, 'default', 'updated', 'App\\Models\\Jobitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.01\",\"accuracy\":\"0.5\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-25 06:21:11', '2021-02-25 06:21:11'),
(1019, 'default', 'updated', 'App\\Models\\Procedure', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-of-source-emissivity-from-x2-4-5-of-astm-e2847-u4,uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5,uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6,uncertainty-due-to-source-stability-from-manual-of-source-u7,uncertainty-due-to-source-uniformity-from-manual-of-source-u8\"},\"old\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5,uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6,uncertainty-due-to-source-stability-from-manual-of-source-u7,uncertainty-due-to-source-uniformity-from-manual-of-source-u8\"}}', '2021-02-25 07:21:56', '2021-02-25 07:21:56'),
(1020, 'default', 'created', 'App\\Models\\Procedure', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"ASTM E77\",\"uncertainties\":\"standard-deviation,uncertainty-type-a\",\"description\":\"Standard Test Method for Inspection and Verification of Thermometers\"}}', '2021-02-25 10:04:55', '2021-02-25 10:04:55'),
(1021, 'default', 'created', 'App\\Models\\Uncertainty', 37, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty Due to spatial in-homogeniety of bath (u5)\\\"\",\"slug\":\"uncertainty-due-to-spatial-in-homogeniety-of-bath-u5\",\"formula\":\"dTAx-hom \\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 10:05:45', '2021-02-25 10:05:45'),
(1022, 'default', 'created', 'App\\Models\\Uncertainty', 38, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty Due to Loading Effect (LIG)\",\"slug\":\"uncertainty-due-to-loading-effect-lig\",\"formula\":\"dTload \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 10:07:23', '2021-02-25 10:07:23'),
(1023, 'default', 'created', 'App\\Models\\Uncertainty', 39, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty Due to Stability with time (u8)\\\"\",\"slug\":\"uncertainty-due-to-stability-with-time-u8\",\"formula\":\"dTstab\\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 10:07:55', '2021-02-25 10:07:55'),
(1024, 'default', 'created', 'App\\Models\\Uncertainty', 40, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"\\\"Uncertainty Due to parallex of indication of UUC  (u10)\\\"\",\"slug\":\"uncertainty-due-to-parallex-of-indication-of-uuc-u10\",\"formula\":\"dTparallex \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-02-25 10:08:21', '2021-02-25 10:08:21'),
(1025, 'default', 'updated', 'App\\Models\\Procedure', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-spatial-in-homogeniety-of-bath-u5,uncertainty-due-to-loading-effect-lig,uncertainty-due-to-stability-with-time-u8,uncertainty-due-to-parallex-of-indication-of-uuc-u10\"},\"old\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a\"}}', '2021-02-25 10:10:10', '2021-02-25 10:10:10'),
(1026, 'default', 'updated', 'App\\Models\\Jobitem', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-25\",\"end\":\"2021-02-25\",\"assign_user\":1,\"assign_assets\":\"33\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-25 10:11:12', '2021-02-25 10:11:12'),
(1027, 'default', 'updated', 'App\\Models\\Jobitem', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-25 15:11:21\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-25 10:11:21', '2021-02-25 10:11:21'),
(1028, 'default', 'updated', 'App\\Models\\Jobitem', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.4\",\"accuracy\":\"0.1\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-02-25 10:11:45', '2021-02-25 10:11:45'),
(1029, 'default', 'updated', 'App\\Models\\Capabilities', 187, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":17,\"unit\":\"1\"},\"old\":{\"procedure\":1,\"unit\":\"mm\"}}', '2021-02-25 10:12:51', '2021-02-25 10:12:51'),
(1030, 'default', 'updated', 'App\\Models\\Attendance', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-26\",\"check_out\":\"09:30:33\",\"worked_hours\":201,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"09:13:38\",\"worked_hours\":0,\"status\":0}}', '2021-02-26 04:30:33', '2021-02-26 04:30:33'),
(1031, 'default', 'created', 'App\\Models\\Attendance', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-02-26\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"09:30:40\",\"check_out\":\"09:30:40\",\"day\":\"Fri\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-02-26 04:30:40', '2021-02-26 04:30:40'),
(1032, 'default', 'updated', 'App\\Models\\Attendance', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-02-26\",\"check_out\":\"09:30:46\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"09:30:40\",\"worked_hours\":0,\"status\":0}}', '2021-02-26 04:30:46', '2021-02-26 04:30:46'),
(1033, 'default', 'created', 'App\\Models\\Purchaseindent', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"location\":\"AIMS Cal Lab Lahore\",\"department\":1,\"indent_by\":1,\"checked_by\":1,\"approved_by\":1,\"indent_type\":\"capital\",\"deliver_to\":\"1\",\"status\":0,\"required\":\"2021-02-26\"}}', '2021-02-26 04:37:07', '2021-02-26 04:37:07'),
(1034, 'default', 'created', 'App\\Models\\Purchaseindentitem', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"indent_id\":5,\"item_code\":\"item\",\"item_description\":\"desccription\",\"ref_code\":\"refercne\",\"unit\":\"ea\",\"last_six_months_consumption\":\"12\",\"current_stock\":\"2\",\"qty\":\"11\",\"purpose\":\"purpose\",\"title\":\"title\",\"status\":0}}', '2021-02-26 04:37:41', '2021-02-26 04:37:41'),
(1035, 'default', 'created', 'App\\Models\\Item', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1000,\"status\":0,\"parameter\":31,\"capability\":954,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"100\",\"price\":6000,\"quantity\":1,\"rf_checks\":null}}', '2021-02-26 13:00:38', '2021-02-26 13:00:38'),
(1036, 'default', 'updated', 'App\\Models\\Quotes', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-02-26 13:00:51', '2021-02-26 13:00:51'),
(1037, 'default', 'created', 'App\\Models\\Job', 1001, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-02-26 13:01:15', '2021-02-26 13:01:15'),
(1038, 'default', 'created', 'App\\Models\\Jobitem', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1001,\"item_id\":1005,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-02-26 13:01:15', '2021-02-26 13:01:15'),
(1039, 'default', 'updated', 'App\\Models\\Jobitem', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"eq2380\",\"serial\":\"127894\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-02-26 13:02:01', '2021-02-26 13:02:01'),
(1040, 'default', 'updated', 'App\\Models\\Jobitem', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-02-26\",\"end\":\"2021-02-26\",\"assign_user\":1,\"assign_assets\":\"93,101,78\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-02-26 13:03:12', '2021-02-26 13:03:12'),
(1041, 'default', 'updated', 'App\\Models\\Jobitem', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-02-26 18:03:24\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-02-26 13:03:24', '2021-02-26 13:03:24'),
(1042, 'default', 'created', 'App\\Models\\Unit', 39, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":31,\"unit\":\"mL\"}}', '2021-02-26 13:07:03', '2021-02-26 13:07:03'),
(1043, 'default', 'updated', 'App\\Models\\Capabilities', 954, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"39\"},\"old\":{\"unit\":\"mL\"}}', '2021-02-26 13:09:37', '2021-02-26 13:09:37'),
(1044, 'default', 'created', 'App\\Models\\Procedure', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"ASTM E542-01\",\"uncertainties\":\"standard-deviation\",\"description\":\"Calibration of Volumetric Apparatus using Gravimetric Method\"}}', '2021-02-26 13:17:54', '2021-02-26 13:17:54'),
(1045, 'default', 'updated', 'App\\Models\\Capabilities', 954, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":18},\"old\":{\"procedure\":1}}', '2021-02-26 13:18:53', '2021-02-26 13:18:53'),
(1046, 'default', 'created', 'App\\Models\\Preference', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Volume Calculator\",\"category\":\"18\",\"slug\":\"volume-calculator\",\"value\":\"volume-caculator\"}}', '2021-02-26 13:22:37', '2021-02-26 13:22:37'),
(1047, 'default', 'updated', 'App\\Models\\Capabilities', 954, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-02-26 13:24:45', '2021-02-26 13:24:45'),
(1048, 'default', 'created', 'App\\Models\\Attendance', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-03-22\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"11:48:41\",\"check_out\":\"11:48:41\",\"day\":\"Mon\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-03-22 06:48:41', '2021-03-22 06:48:41'),
(1049, 'default', 'updated', 'App\\Models\\Jobitem', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.2\",\"accuracy\":\"0.1\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-03-22 06:52:08', '2021-03-22 06:52:08'),
(1050, 'default', 'updated', 'App\\Models\\Customer', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"updated_at\":\"2021-03-22T10:51:40.000000Z\"},\"old\":{\"updated_at\":\"2020-10-12T09:26:59.000000Z\"}}', '2021-03-22 10:51:40', '2021-03-22 10:51:40'),
(1051, 'default', 'updated', 'App\\Models\\Customer', 1000, 'App\\Models\\User', 1, '{\"attributes\":{\"pur_phone\":\"03016236150,\",\"updated_at\":\"2021-03-22T10:54:38.000000Z\"},\"old\":{\"pur_phone\":\"03016236150-\",\"updated_at\":\"2021-01-23T09:04:56.000000Z\"}}', '2021-03-22 10:54:38', '2021-03-22 10:54:38'),
(1052, 'default', 'created', 'App\\Models\\Menu', 156, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Inventory\",\"slug\":\"inventory\",\"icon\":\"fa fa-\",\"status\":1,\"url\":\"#\",\"position\":11,\"parent_id\":null,\"has_child\":1}}', '2021-03-22 11:20:25', '2021-03-22 11:20:25'),
(1053, 'default', 'updated', 'App\\Models\\Menu', 156, 'App\\Models\\User', 1, '{\"attributes\":{\"slug\":\"inventory-index\"},\"old\":{\"slug\":\"inventory\"}}', '2021-03-22 11:20:42', '2021-03-22 11:20:42'),
(1054, 'default', 'updated', 'App\\Models\\Menu', 156, 'App\\Models\\User', 1, '{\"attributes\":{\"icon\":\"fa fa-houzz\"},\"old\":{\"icon\":\"fa fa-\"}}', '2021-03-22 11:21:09', '2021-03-22 11:21:09'),
(1055, 'default', 'updated', 'App\\Models\\Role', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,staff-index,calibration-management,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,add-procedure,update-procedure,create-asset-group,update-asset-group,parameter-index,capabilities-index,manage-reference-index,units-index,uncertainties-index,asset-groups,procedure-index,dashboard-index,manage-jobs,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,jobs-index,scheduling-index,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index,inventory-index\"},\"old\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-index,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,calibration-management,parameter-index,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-index,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,manage-reference-index,procedure-index,units-index,uncertainties-index,add-procedure,update-procedure,asset-groups,create-asset-group,update-asset-group,dashboard-index,manage-jobs,jobs-index,scheduling-index,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index\"}}', '2021-03-22 11:21:30', '2021-03-22 11:21:30'),
(1056, 'default', 'created', 'App\\Models\\Menu', 157, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Inventory Categories\",\"slug\":\"inventory-categories-index\",\"icon\":\"fa fa-\",\"status\":1,\"url\":\"inventory-categories-index\",\"position\":0,\"parent_id\":\"156\",\"has_child\":1}}', '2021-03-22 11:23:21', '2021-03-22 11:23:21'),
(1057, 'default', 'updated', 'App\\Models\\Role', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,staff-index,calibration-management,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,add-procedure,update-procedure,create-asset-group,update-asset-group,parameter-index,capabilities-index,manage-reference-index,units-index,uncertainties-index,asset-groups,procedure-index,dashboard-index,manage-jobs,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,jobs-index,scheduling-index,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index,inventory-index,inventory-categories-index\"},\"old\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,staff-index,calibration-management,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,add-procedure,update-procedure,create-asset-group,update-asset-group,parameter-index,capabilities-index,manage-reference-index,units-index,uncertainties-index,asset-groups,procedure-index,dashboard-index,manage-jobs,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,jobs-index,scheduling-index,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index,inventory-index\"}}', '2021-03-22 11:23:38', '2021-03-22 11:23:38'),
(1058, 'default', 'updated', 'App\\Models\\Menu', 157, 'App\\Models\\User', 1, '{\"attributes\":{\"url\":\"inventory-categories\"},\"old\":{\"url\":\"inventory-categories-index\"}}', '2021-03-22 11:28:58', '2021-03-22 11:28:58'),
(1059, 'default', 'created', 'App\\Models\\Menu', 158, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Inventories\",\"slug\":\"inventories-index\",\"icon\":\"fa fa-\",\"status\":1,\"url\":\"inventories\",\"position\":0,\"parent_id\":\"156\",\"has_child\":1}}', '2021-03-22 12:07:28', '2021-03-22 12:07:28'),
(1060, 'default', 'updated', 'App\\Models\\Role', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,staff-index,calibration-management,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,add-procedure,update-procedure,create-asset-group,update-asset-group,parameter-index,capabilities-index,manage-reference-index,units-index,uncertainties-index,asset-groups,procedure-index,dashboard-index,manage-jobs,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,jobs-index,scheduling-index,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index,inventory-index,inventory-categories-index,inventories-index\"},\"old\":{\"permissions\":\"customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,staff-index,calibration-management,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,add-procedure,update-procedure,create-asset-group,update-asset-group,parameter-index,capabilities-index,manage-reference-index,units-index,uncertainties-index,asset-groups,procedure-index,dashboard-index,manage-jobs,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,jobs-index,scheduling-index,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index,inventory-index,inventory-categories-index\"}}', '2021-03-22 12:08:30', '2021-03-22 12:08:30'),
(1061, 'default', 'updated', 'App\\Models\\Attendance', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-03-22\",\"check_out\":\"18:06:48\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"11:48:41\",\"worked_hours\":0,\"status\":0}}', '2021-03-22 13:06:48', '2021-03-22 13:06:48'),
(1062, 'default', 'created', 'App\\Models\\Attendance', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-03-24\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:26:57\",\"check_out\":\"10:26:57\",\"day\":\"Wed\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-03-24 05:26:57', '2021-03-24 05:26:57'),
(1063, 'default', 'updated', 'App\\Models\\Attendance', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-03-24\",\"check_out\":\"14:06:15\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:26:57\",\"worked_hours\":0,\"status\":0}}', '2021-03-24 09:06:15', '2021-03-24 09:06:15'),
(1064, 'default', 'created', 'App\\Models\\Uncertainty', 41, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Combined Uncertainty of Standard (uB1)\",\"slug\":\"relative-combined-uncertainty-of-standard-ub1\",\"formula\":\"UC from cal certificate\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:55:42', '2021-03-25 07:55:42'),
(1065, 'default', 'created', 'App\\Models\\Uncertainty', 42, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Combined Uncertainty of Balance    (uB2)\",\"slug\":\"relative-combined-uncertainty-of-balance-ub2\",\"formula\":\"UC from cal certificate\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:55:55', '2021-03-25 07:55:55'),
(1066, 'default', 'created', 'App\\Models\\Uncertainty', 43, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Combined Uncertainty Thermometer   (uB3)\",\"slug\":\"relative-combined-uncertainty-thermometer-ub3\",\"formula\":\"UC from cal certificate\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:56:09', '2021-03-25 07:56:09'),
(1067, 'default', 'created', 'App\\Models\\Uncertainty', 44, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty Due to resolution of UUC    (uB4)\",\"slug\":\"relative-uncertainty-due-to-resolution-of-uuc-ub4\",\"formula\":\"(Res \\/ 2) \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:56:19', '2021-03-25 07:56:19'),
(1068, 'default', 'created', 'App\\Models\\Uncertainty', 45, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative  Uncertainty due to Drift of the Std Balance (uB5)\",\"slug\":\"relative-uncertainty-due-to-drift-of-the-std-balance-ub5\",\"formula\":\"U \\/ \\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:56:30', '2021-03-25 07:56:30'),
(1069, 'default', 'created', 'App\\Models\\Uncertainty', 46, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty due to temp drift of water (uB6)\",\"slug\":\"relative-uncertainty-due-to-temp-drift-of-water-ub6\",\"formula\":\"\\u03b1Vo(Tlab - Tref) \\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:56:50', '2021-03-25 07:56:50'),
(1070, 'default', 'created', 'App\\Models\\Uncertainty', 47, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty due to Tolerance  of UUC (uB7)\",\"slug\":\"relative-uncertainty-due-to-tolerance-of-uuc-ub7\",\"formula\":\"Accuracy \\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:57:02', '2021-03-25 07:57:02'),
(1071, 'default', 'created', 'App\\Models\\Uncertainty', 48, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty due Density ofAair (uB8)\",\"slug\":\"relative-uncertainty-due-density-ofaair-ub8\",\"formula\":\"5x10-7\\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:57:13', '2021-03-25 07:57:13'),
(1072, 'default', 'created', 'App\\Models\\Uncertainty', 49, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty due to Water Density \\\"Tanaka\'s value\\\" (uB9)\",\"slug\":\"relative-uncertainty-due-to-water-density-tanaka-s-value-ub9\",\"formula\":\"1.3 x 10-6\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:57:27', '2021-03-25 07:57:27'),
(1073, 'default', 'created', 'App\\Models\\Uncertainty', 50, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty due to Reading of Meniscus (uB10)\",\"slug\":\"relative-uncertainty-due-to-reading-of-meniscus-ub10\",\"formula\":\"Res\\/2 \\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:57:38', '2021-03-25 07:57:38'),
(1074, 'default', 'created', 'App\\Models\\Uncertainty', 51, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Relative Uncertainty due to Thermal expansion coefficient of UUC (uB11)\",\"slug\":\"relative-uncertainty-due-to-thermal-expansion-coefficient-of-uuc-ub11\",\"formula\":\"5x10-7\\/\\u221a3\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-03-25 07:57:49', '2021-03-25 07:57:49'),
(1075, 'default', 'updated', 'App\\Models\\Procedure', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"standard-deviation,relative-combined-uncertainty-of-standard-ub1,relative-combined-uncertainty-of-balance-ub2,relative-combined-uncertainty-thermometer-ub3,relative-uncertainty-due-to-resolution-of-uuc-ub4,relative-uncertainty-due-to-drift-of-the-std-balance-ub5,relative-uncertainty-due-to-temp-drift-of-water-ub6,relative-uncertainty-due-to-tolerance-of-uuc-ub7,relative-uncertainty-due-density-ofaair-ub8,relative-uncertainty-due-to-water-density-tanaka-s-value-ub9,relative-uncertainty-due-to-reading-of-meniscus-ub10,relative-uncertainty-due-to-thermal-expansion-coefficient-of-uuc-ub11\"},\"old\":{\"uncertainties\":\"standard-deviation\"}}', '2021-03-25 07:59:59', '2021-03-25 07:59:59'),
(1076, 'default', 'created', 'App\\Models\\Managereference', 765, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"asset\":180,\"unit\":0,\"uuc\":\"100\",\"ref\":\"0.98972\",\"error\":\"99.01028\",\"uncertainty\":\"0.06\"}}', '2021-03-26 07:03:38', '2021-03-26 07:03:38'),
(1077, 'default', 'created', 'App\\Models\\Managereference', 766, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"asset\":180,\"unit\":0,\"uuc\":\"200\",\"ref\":\"0.9785\",\"error\":\"199.0215\",\"uncertainty\":\"0.06\"}}', '2021-03-26 07:04:36', '2021-03-26 07:04:36'),
(1078, 'default', 'deleted', 'App\\Models\\Managereference', 766, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"asset\":180,\"unit\":10,\"uuc\":\"200\",\"ref\":\"0.9785\",\"error\":\"199.0215\",\"uncertainty\":\"0.06\"}}', '2021-03-26 07:13:13', '2021-03-26 07:13:13'),
(1079, 'default', 'created', 'App\\Models\\Managereference', 767, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"asset\":180,\"unit\":10,\"uuc\":\"200\",\"ref\":\"0.9785\",\"error\":\"199.0215\",\"uncertainty\":\"0.06\"}}', '2021-03-26 07:13:13', '2021-03-26 07:13:13'),
(1080, 'default', 'deleted', 'App\\Models\\Managereference', 767, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"asset\":180,\"unit\":10,\"uuc\":\"200\",\"ref\":\"0.9785\",\"error\":\"199.0215\",\"uncertainty\":\"0.06\"}}', '2021-03-26 07:14:02', '2021-03-26 07:14:02'),
(1081, 'default', 'created', 'App\\Models\\Managereference', 768, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"asset\":180,\"unit\":10,\"uuc\":\"200\",\"ref\":\"0.9785\",\"error\":\"199.0215\",\"uncertainty\":\"0.06\"}}', '2021-03-26 07:14:02', '2021-03-26 07:14:02'),
(1082, 'default', 'created', 'App\\Models\\Unit', 40, 'App\\Models\\User', 1, '{\"attributes\":{\"parameter\":19,\"unit\":\"nm\"}}', '2021-03-26 07:25:42', '2021-03-26 07:25:42'),
(1083, 'default', 'created', 'App\\Models\\Quotes', 1001, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1131,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"ensm@gmail.com\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Masood Khan\",\"revision\":0}}', '2021-03-26 09:21:51', '2021-03-26 09:21:51'),
(1084, 'default', 'created', 'App\\Models\\Item', 1006, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1001,\"status\":0,\"parameter\":19,\"capability\":808,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"0~100\",\"price\":4000,\"quantity\":1,\"rf_checks\":null}}', '2021-03-26 09:23:38', '2021-03-26 09:23:38'),
(1085, 'default', 'updated', 'App\\Models\\Quotes', 1001, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-03-26 09:23:38', '2021-03-26 09:23:38'),
(1086, 'default', 'updated', 'App\\Models\\Quotes', 1001, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-03-26 09:23:58', '2021-03-26 09:23:58'),
(1087, 'default', 'updated', 'App\\Models\\Quotes', 1001, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-03-26 09:24:24', '2021-03-26 09:24:24'),
(1088, 'default', 'created', 'App\\Models\\Job', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-03-26 09:25:02', '2021-03-26 09:25:02'),
(1089, 'default', 'created', 'App\\Models\\Jobitem', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1002,\"item_id\":1006,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-03-26 09:25:02', '2021-03-26 09:25:02'),
(1090, 'default', 'updated', 'App\\Models\\Jobitem', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"eq1\",\"serial\":\"serail\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-03-26 09:25:32', '2021-03-26 09:25:32'),
(1091, 'default', 'updated', 'App\\Models\\Jobitem', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-03-26\",\"end\":\"2021-03-26\",\"assign_user\":1,\"assign_assets\":\"180\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-03-26 09:26:08', '2021-03-26 09:26:08'),
(1092, 'default', 'updated', 'App\\Models\\Jobitem', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-03-26 14:26:20\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-03-26 09:26:20', '2021-03-26 09:26:20'),
(1093, 'default', 'updated', 'App\\Models\\Jobitem', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.01,0.02,0.03\",\"accuracy\":\"0.1\",\"range\":\"10,100-11,110-12,120\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-03-26 11:01:14', '2021-03-26 11:01:14'),
(1094, 'default', 'created', 'App\\Models\\Preference', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Spectrophotometer Calculator\",\"category\":\"18\",\"slug\":\"spectrophotometer-calculator\",\"value\":\"spectrophotometer-calculator\"}}', '2021-03-26 11:14:03', '2021-03-26 11:14:03'),
(1095, 'default', 'updated', 'App\\Models\\Capabilities', 808, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"40\"},\"old\":{\"unit\":\"D\"}}', '2021-03-26 11:14:42', '2021-03-26 11:14:42'),
(1096, 'default', 'created', 'App\\Models\\Procedure', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"AS TG4\",\"uncertainties\":\"standard-deviation,uncertainty-type-a\",\"description\":\"Calibration Procedure For UV\\/Vis Spectrophotometer\"}}', '2021-03-26 11:16:58', '2021-03-26 11:16:58'),
(1097, 'default', 'updated', 'App\\Models\\Capabilities', 808, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":19},\"old\":{\"procedure\":1}}', '2021-03-26 11:17:50', '2021-03-26 11:17:50'),
(1098, 'default', 'created', 'App\\Models\\Attendance', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-03-26\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"16:19:38\",\"check_out\":\"16:19:38\",\"day\":\"Fri\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-03-26 11:19:38', '2021-03-26 11:19:38'),
(1099, 'default', 'updated', 'App\\Models\\Attendance', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-03-26\",\"check_out\":\"16:19:45\",\"worked_hours\":5,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"16:19:38\",\"worked_hours\":0,\"status\":0}}', '2021-03-26 11:19:45', '2021-03-26 11:19:45'),
(1100, 'default', 'updated', 'App\\Models\\Jobitem', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.4,0.5,0.6\",\"accuracy\":\"0.9,0.9,0.9\",\"range\":\"0.1,0.1-0.1,0.2-0.2,0.4\"},\"old\":{\"resolution\":\"0.01,0.02,0.03\",\"accuracy\":\"0.1\",\"range\":\"10,100-11,110-12,120\"}}', '2021-04-01 14:41:23', '2021-04-01 14:41:23'),
(1101, 'default', 'created', 'App\\Models\\Attendance', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-04-02\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"15:43:14\",\"check_out\":\"15:43:14\",\"day\":\"Fri\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-04-02 10:43:14', '2021-04-02 10:43:14'),
(1102, 'default', 'created', 'App\\Models\\Quotes', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1120,\"type\":null,\"rfq_mode\":\"walk-in\",\"rfq_mode_details\":\"+98032840211\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Aleem Butt\",\"revision\":0}}', '2021-04-02 12:53:36', '2021-04-02 12:53:36'),
(1103, 'default', 'created', 'App\\Models\\Item', 1007, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1002,\"status\":0,\"parameter\":3,\"capability\":18,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"0~1000\",\"price\":6000,\"quantity\":1,\"rf_checks\":null}}', '2021-04-02 12:55:43', '2021-04-02 12:55:43'),
(1104, 'default', 'updated', 'App\\Models\\Quotes', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-04-02 12:55:43', '2021-04-02 12:55:43'),
(1105, 'default', 'updated', 'App\\Models\\Quotes', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-04-02 12:55:57', '2021-04-02 12:55:57'),
(1106, 'default', 'updated', 'App\\Models\\Quotes', 1002, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-04-02 12:56:11', '2021-04-02 12:56:11');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(1107, 'default', 'created', 'App\\Models\\Job', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-04-02 12:56:29', '2021-04-02 12:56:29'),
(1108, 'default', 'created', 'App\\Models\\Jobitem', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1003,\"item_id\":1007,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-04-02 12:56:29', '2021-04-02 12:56:29'),
(1109, 'default', 'updated', 'App\\Models\\Jobitem', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"eq01\",\"serial\":\"serail\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-04-02 12:56:55', '2021-04-02 12:56:55'),
(1110, 'default', 'updated', 'App\\Models\\Jobitem', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-04-02\",\"end\":\"2021-04-02\",\"assign_user\":1,\"assign_assets\":\"140\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-04-02 12:57:52', '2021-04-02 12:57:52'),
(1111, 'default', 'updated', 'App\\Models\\Jobitem', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-04-02 17:58:10\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-04-02 12:58:10', '2021-04-02 12:58:10'),
(1112, 'default', 'created', 'App\\Models\\Procedure', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"umLTM SOP 6\",\"uncertainties\":\"standard-deviation,uncertainty-type-a\",\"description\":\"SOP for Calibration of Vernier Caliper\"}}', '2021-04-02 13:00:41', '2021-04-02 13:00:41'),
(1113, 'default', 'created', 'App\\Models\\Preference', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Vernier Caliper Calculator\",\"category\":\"18\",\"slug\":\"vernier-caliper-calculator\",\"value\":\"0\"}}', '2021-04-02 13:02:57', '2021-04-02 13:02:57'),
(1114, 'default', 'updated', 'App\\Models\\Capabilities', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"52\"},\"old\":{\"unit\":\"mm\"}}', '2021-04-02 13:04:08', '2021-04-02 13:04:08'),
(1115, 'default', 'updated', 'App\\Models\\Jobitem', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.01\",\"accuracy\":\"0.02\",\"range\":\"1,1000\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-04-02 13:34:46', '2021-04-02 13:34:46'),
(1116, 'default', 'updated', 'App\\Models\\Capabilities', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":20},\"old\":{\"procedure\":1}}', '2021-04-09 04:50:22', '2021-04-09 04:50:22'),
(1117, 'default', 'created', 'App\\Models\\Uncertainty', 52, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of Repeatability(ua)\",\"slug\":\"uncertainty-of-repeatability-ua\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:27:23', '2021-04-09 05:27:23'),
(1118, 'default', 'updated', 'App\\Models\\Procedure', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a,uncertainty-of-repeatability-ua\"},\"old\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a\"}}', '2021-04-09 05:27:44', '2021-04-09 05:27:44'),
(1119, 'default', 'created', 'App\\Models\\Uncertainty', 53, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of Reading of the Result (max permissible error of UUC) u (li) 1mm for digital or 2 mm for classical\",\"slug\":\"uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:28:18', '2021-04-09 05:28:18'),
(1120, 'default', 'created', 'App\\Models\\Uncertainty', 54, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of Thermal Expansion Coefficient   u ( \\u03b1 m)\",\"slug\":\"uncertainty-of-thermal-expansion-coefficient-u-a-m\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:28:35', '2021-04-09 05:28:35'),
(1121, 'default', 'created', 'App\\Models\\Uncertainty', 55, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of Guage Block Temp Difference   u (\\u03b8e)\",\"slug\":\"uncertainty-of-guage-block-temp-difference-u-the\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:28:48', '2021-04-09 05:28:48'),
(1122, 'default', 'created', 'App\\Models\\Uncertainty', 56, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of Temp diff b\\/w ref and UUC  u (d \\u03b8)\",\"slug\":\"uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:29:04', '2021-04-09 05:29:04'),
(1123, 'default', 'created', 'App\\Models\\Uncertainty', 57, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of calibration of standard   u (le)\",\"slug\":\"uncertainty-of-calibration-of-standard-u-le\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:29:17', '2021-04-09 05:29:17'),
(1124, 'default', 'created', 'App\\Models\\Uncertainty', 58, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertainty of  thermal expansion co-efficient difference  u (d\\u03b1)\",\"slug\":\"uncertainty-of-thermal-expansion-co-efficient-difference-u-da\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:29:30', '2021-04-09 05:29:30'),
(1125, 'default', 'created', 'App\\Models\\Uncertainty', 59, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Uncertaintyof assumed difference b\\/w deformations caused by measurement force u (dF)\",\"slug\":\"uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df\",\"formula\":\"null\",\"coefficient_of_sensitivity\":1,\"distribution\":\"Rectangular\"}}', '2021-04-09 05:29:46', '2021-04-09 05:29:46'),
(1126, 'default', 'updated', 'App\\Models\\Procedure', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"standard-deviation,uncertainty-due-to-resolution-of-uuc,uncertainty-of-repeatability-ua,uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical,uncertainty-of-thermal-expansion-coefficient-u-a-m,uncertainty-of-guage-block-temp-difference-u-the,uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th,uncertainty-of-calibration-of-standard-u-le,uncertainty-of-thermal-expansion-co-efficient-difference-u-da,uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df\"},\"old\":{\"uncertainties\":\"standard-deviation,uncertainty-type-a,uncertainty-of-repeatability-ua\"}}', '2021-04-09 05:30:37', '2021-04-09 05:30:37'),
(1127, 'default', 'updated', 'App\\Models\\Procedure', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"uncertainties\":\"uncertainty-due-to-resolution-of-uuc,uncertainty-of-repeatability-ua,uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical,uncertainty-of-thermal-expansion-coefficient-u-a-m,uncertainty-of-guage-block-temp-difference-u-the,uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th,uncertainty-of-calibration-of-standard-u-le,uncertainty-of-thermal-expansion-co-efficient-difference-u-da,uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df\"},\"old\":{\"uncertainties\":\"standard-deviation,uncertainty-due-to-resolution-of-uuc,uncertainty-of-repeatability-ua,uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical,uncertainty-of-thermal-expansion-coefficient-u-a-m,uncertainty-of-guage-block-temp-difference-u-the,uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th,uncertainty-of-calibration-of-standard-u-le,uncertainty-of-thermal-expansion-co-efficient-difference-u-da,uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df\"}}', '2021-04-09 05:33:21', '2021-04-09 05:33:21'),
(1128, 'default', 'created', 'App\\Models\\Quotes', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1191,\"type\":null,\"rfq_mode\":\"whatsapp\",\"rfq_mode_details\":\"+93948598223\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Adeel Afzal\",\"revision\":0}}', '2021-04-09 09:40:18', '2021-04-09 09:40:18'),
(1129, 'default', 'created', 'App\\Models\\Item', 1008, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1003,\"status\":0,\"parameter\":3,\"capability\":25,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"no\",\"range\":\"10~25\",\"price\":2500,\"quantity\":1,\"rf_checks\":null}}', '2021-04-09 09:48:40', '2021-04-09 09:48:40'),
(1130, 'default', 'updated', 'App\\Models\\Quotes', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-04-09 09:48:40', '2021-04-09 09:48:40'),
(1131, 'default', 'updated', 'App\\Models\\Quotes', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-04-09 09:49:05', '2021-04-09 09:49:05'),
(1132, 'default', 'updated', 'App\\Models\\Quotes', 1003, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-04-09 09:49:34', '2021-04-09 09:49:34'),
(1133, 'default', 'created', 'App\\Models\\Job', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-04-09 09:49:51', '2021-04-09 09:49:51'),
(1134, 'default', 'created', 'App\\Models\\Jobitem', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1004,\"item_id\":1008,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-04-09 09:49:51', '2021-04-09 09:49:51'),
(1135, 'default', 'updated', 'App\\Models\\Jobitem', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment ID\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-04-09 09:52:35', '2021-04-09 09:52:35'),
(1136, 'default', 'updated', 'App\\Models\\Jobitem', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-04-09\",\"end\":\"2021-04-09\",\"assign_user\":1,\"assign_assets\":\"140\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-04-09 09:52:56', '2021-04-09 09:52:56'),
(1137, 'default', 'updated', 'App\\Models\\Jobitem', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-04-09 14:53:09\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-04-09 09:53:09', '2021-04-09 09:53:09'),
(1138, 'default', 'created', 'App\\Models\\Preference', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Micrometer Calculator\",\"category\":\"18\",\"slug\":\"micrometer-calculator\",\"value\":\"0\"}}', '2021-04-09 09:55:41', '2021-04-09 09:55:41'),
(1139, 'default', 'updated', 'App\\Models\\Capabilities', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"52\"},\"old\":{\"unit\":\"mm\"}}', '2021-04-09 09:57:27', '2021-04-09 09:57:27'),
(1140, 'default', 'updated', 'App\\Models\\Jobitem', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.3\",\"accuracy\":\"0.4\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-04-09 10:21:56', '2021-04-09 10:21:56'),
(1141, 'default', 'created', 'App\\Models\\Preference', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Dial Gauge Calculator\",\"category\":\"18\",\"slug\":\"dial-gauge-calculator\",\"value\":\"0\"}}', '2021-04-09 11:51:34', '2021-04-09 11:51:34'),
(1142, 'default', 'updated', 'App\\Models\\Capabilities', 211, 'App\\Models\\User', 1, '{\"attributes\":{\"unit\":\"49\"},\"old\":{\"unit\":\"mm\"}}', '2021-04-09 11:52:46', '2021-04-09 11:52:46'),
(1143, 'default', 'created', 'App\\Models\\Procedure', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"umLTM SOP 5\",\"uncertainties\":\"standard-deviation,uncertainty-of-repeatability-ua,uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical,uncertainty-of-thermal-expansion-coefficient-u-a-m,uncertainty-of-guage-block-temp-difference-u-the,uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th,uncertainty-of-calibration-of-standard-u-le,uncertainty-of-thermal-expansion-co-efficient-difference-u-da,uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df\",\"description\":\"SOP for Calibration of Micrometers\"}}', '2021-04-09 11:55:23', '2021-04-09 11:55:23'),
(1144, 'default', 'updated', 'App\\Models\\Capabilities', 211, 'App\\Models\\User', 1, '{\"attributes\":{\"procedure\":21},\"old\":{\"procedure\":1}}', '2021-04-09 11:56:05', '2021-04-09 11:56:05'),
(1145, 'default', 'created', 'App\\Models\\Quotes', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1155,\"type\":null,\"rfq_mode\":\"email\",\"rfq_mode_details\":\"email@gmail.com\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Masood Haider\",\"revision\":0}}', '2021-04-09 11:56:30', '2021-04-09 11:56:30'),
(1146, 'default', 'created', 'App\\Models\\Item', 1009, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1004,\"status\":0,\"parameter\":3,\"capability\":211,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"1~10\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-04-09 11:56:46', '2021-04-09 11:56:46'),
(1147, 'default', 'updated', 'App\\Models\\Quotes', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-04-09 11:56:46', '2021-04-09 11:56:46'),
(1148, 'default', 'updated', 'App\\Models\\Quotes', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-04-09 11:56:55', '2021-04-09 11:56:55'),
(1149, 'default', 'updated', 'App\\Models\\Quotes', 1004, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-04-09 11:57:10', '2021-04-09 11:57:10'),
(1150, 'default', 'created', 'App\\Models\\Job', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-04-09 11:57:32', '2021-04-09 11:57:32'),
(1151, 'default', 'created', 'App\\Models\\Jobitem', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1005,\"item_id\":1009,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-04-09 11:57:32', '2021-04-09 11:57:32'),
(1152, 'default', 'updated', 'App\\Models\\Jobitem', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"equipment\",\"serial\":\"serial\",\"model\":\"model\",\"make\":\"make\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-04-09 11:57:55', '2021-04-09 11:57:55'),
(1153, 'default', 'updated', 'App\\Models\\Jobitem', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-04-09\",\"end\":\"2021-04-09\",\"assign_user\":1,\"assign_assets\":\"125\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-04-09 11:59:39', '2021-04-09 11:59:39'),
(1154, 'default', 'updated', 'App\\Models\\Jobitem', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-04-09 16:59:49\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-04-09 11:59:49', '2021-04-09 11:59:49'),
(1155, 'default', 'updated', 'App\\Models\\Jobitem', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.01\",\"accuracy\":\"0.3\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-04-09 12:06:01', '2021-04-09 12:06:01'),
(1156, 'default', 'updated', 'App\\Models\\Attendance', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-04-10\",\"check_out\":\"10:17:26\",\"worked_hours\":202,\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"15:43:14\",\"worked_hours\":0,\"status\":0}}', '2021-04-10 05:17:26', '2021-04-10 05:17:26'),
(1157, 'default', 'created', 'App\\Models\\Attendance', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-04-10\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"10:17:42\",\"check_out\":\"10:17:42\",\"day\":\"Sat\",\"worked_hours\":0,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-04-10 05:17:42', '2021-04-10 05:17:42'),
(1158, 'default', 'updated', 'App\\Models\\Attendance', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-04-10\",\"check_out\":\"10:34:51\",\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"10:17:42\",\"status\":0}}', '2021-04-10 05:34:51', '2021-04-10 05:34:51'),
(1159, 'default', 'updated', 'App\\Models\\User', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-04-10 10:02:25', '2021-04-10 10:02:25'),
(1160, 'default', 'updated', 'App\\Models\\User', 1, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', '2021-04-10 10:31:02', '2021-04-10 10:31:02'),
(1161, 'default', 'created', 'App\\Models\\Quotes', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"customer_id\":1046,\"type\":null,\"rfq_mode\":\"walk-in\",\"rfq_mode_details\":\"emazeem_ +9302938490\",\"approval_mode\":null,\"approval_mode_details\":null,\"approval_date\":null,\"status\":0,\"turnaround\":null,\"remarks\":null,\"tm\":2,\"principal\":\"Mohsin Siddique\",\"revision\":0}}', '2021-04-10 12:38:08', '2021-04-10 12:38:08'),
(1162, 'default', 'created', 'App\\Models\\Item', 1010, 'App\\Models\\User', 1, '{\"attributes\":{\"quote_id\":1005,\"status\":0,\"parameter\":27,\"capability\":907,\"not_available\":null,\"location\":\"lab\",\"accredited\":\"yes\",\"range\":\"35~650\",\"price\":3000,\"quantity\":1,\"rf_checks\":null}}', '2021-04-10 12:38:32', '2021-04-10 12:38:32'),
(1163, 'default', 'updated', 'App\\Models\\Quotes', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":\"LAB\"},\"old\":{\"type\":null}}', '2021-04-10 12:38:32', '2021-04-10 12:38:32'),
(1164, 'default', 'updated', 'App\\Models\\Quotes', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":1},\"old\":{\"status\":0}}', '2021-04-10 12:38:42', '2021-04-10 12:38:42'),
(1165, 'default', 'updated', 'App\\Models\\Quotes', 1005, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3},\"old\":{\"status\":1}}', '2021-04-10 12:38:56', '2021-04-10 12:38:56'),
(1166, 'default', 'created', 'App\\Models\\Job', 1006, 'App\\Models\\User', 1, '{\"attributes\":{\"quotes_id\":null,\"status\":0}}', '2021-04-10 12:39:12', '2021-04-10 12:39:12'),
(1167, 'default', 'created', 'App\\Models\\Jobitem', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"type\":0,\"job_id\":1006,\"item_id\":1010,\"eq_id\":null,\"serial\":null,\"resolution\":null,\"accuracy\":null,\"range\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0,\"start\":null,\"end\":null,\"started_at\":null,\"ended_at\":null,\"assign_user\":null,\"assign_assets\":null,\"group_users\":null,\"group_assets\":null,\"certificate\":null}}', '2021-04-10 12:39:12', '2021-04-10 12:39:12'),
(1168, 'default', 'updated', 'App\\Models\\Jobitem', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"eq_id\":\"eq_\",\"serial\":\"seria_\",\"model\":\"mode_\",\"make\":\"mak_\",\"accessories\":\"NILL\",\"visual_inspection\":\"OK\",\"status\":1},\"old\":{\"eq_id\":null,\"serial\":null,\"model\":null,\"make\":null,\"accessories\":null,\"visual_inspection\":null,\"status\":0}}', '2021-04-10 12:39:39', '2021-04-10 12:39:39'),
(1169, 'default', 'updated', 'App\\Models\\Jobitem', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":2,\"start\":\"2021-04-10\",\"end\":\"2021-04-12\",\"assign_user\":1,\"assign_assets\":\"26\"},\"old\":{\"status\":1,\"start\":null,\"end\":null,\"assign_user\":null,\"assign_assets\":null}}', '2021-04-10 12:41:50', '2021-04-10 12:41:50'),
(1170, 'default', 'updated', 'App\\Models\\Jobitem', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":3,\"started_at\":\"2021-04-10 17:42:04\"},\"old\":{\"status\":2,\"started_at\":null}}', '2021-04-10 12:42:04', '2021-04-10 12:42:04'),
(1171, 'default', 'updated', 'App\\Models\\Jobitem', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"resolution\":\"0.03\",\"accuracy\":\"0.1\",\"range\":\"10,100\"},\"old\":{\"resolution\":null,\"accuracy\":null,\"range\":null}}', '2021-04-10 12:48:17', '2021-04-10 12:48:17'),
(1172, 'default', 'created', 'App\\Models\\Attendance', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"check_in_date\":\"2021-04-12\",\"check_out_date\":\"0000-00-00\",\"check_in\":\"13:11:15\",\"check_out\":\"13:11:15\",\"day\":\"Mon\",\"worked_hours\":null,\"status\":0,\"leave_id\":null,\"remarks\":\"Present manual marked by user\"}}', '2021-04-12 08:11:15', '2021-04-12 08:11:15'),
(1173, 'default', 'updated', 'App\\Models\\Attendance', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"check_out_date\":\"2021-04-12\",\"check_out\":\"13:11:22\",\"status\":1},\"old\":{\"check_out_date\":\"0000-00-00\",\"check_out\":\"13:11:15\",\"status\":0}}', '2021-04-12 08:11:22', '2021-04-12 08:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `assetgroups`
--

CREATE TABLE `assetgroups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assetgroups`
--

INSERT INTO `assetgroups` (`id`, `parameter`, `name`, `created_at`, `updated_at`) VALUES
(1, 17, 'Pressure Gauge', '2020-12-10 11:41:24', '2020-12-10 11:41:24'),
(2, 17, 'Pressure Pump', '2020-12-10 11:47:22', '2020-12-10 11:47:22'),
(3, 27, 'Touch Probe', '2020-12-10 11:50:35', '2020-12-10 11:50:35'),
(4, 27, 'Thermometer with probe', '2020-12-10 12:02:01', '2020-12-10 12:02:01'),
(5, 27, 'Thermohygrometer', '2020-12-10 12:10:59', '2020-12-10 12:10:59'),
(6, 27, 'Hygro Thermometer', '2020-12-10 12:11:54', '2020-12-10 18:48:22'),
(7, 27, 'Dry Block Calibrator', '2020-12-10 12:17:29', '2020-12-10 12:17:29'),
(8, 27, 'Wireless Temperature Data logger', '2020-12-10 12:23:58', '2020-12-10 12:23:58'),
(9, 27, 'Temperature & Humidity data logger', '2020-12-10 12:33:19', '2020-12-10 12:33:19'),
(10, 27, 'Temperature Data Bucket', '2020-12-10 12:48:34', '2020-12-10 12:48:34'),
(11, 27, 'Temperature Data Bath', '2020-12-10 12:51:43', '2020-12-10 12:51:43'),
(12, 27, 'IR Calibrator', '2020-12-10 13:02:51', '2020-12-10 13:02:51'),
(13, 13, 'Weight Box', '2020-12-10 19:00:25', '2020-12-10 19:00:25'),
(14, 13, 'Dead Weight 2kg', '2020-12-10 19:04:01', '2020-12-10 19:04:01'),
(15, 13, 'Dead weight 10kg', '2020-12-10 19:05:09', '2020-12-10 19:05:09'),
(16, 13, 'Dead Weight 20kg', '2020-12-10 19:06:37', '2020-12-10 19:06:37'),
(17, 13, 'Precision Weighing Scale', '2020-12-10 19:10:09', '2020-12-10 19:10:09'),
(18, 13, 'Weighing Scale', '2020-12-10 19:10:58', '2020-12-10 19:10:58'),
(19, 6, 'Torque Testing', '2020-12-11 11:31:30', '2020-12-11 11:31:30'),
(20, 6, 'Load Cell', '2020-12-11 11:33:09', '2020-12-11 11:33:09'),
(21, 6, 'Push Pull Gauge', '2020-12-11 11:34:22', '2020-12-11 11:34:22'),
(22, 3, 'Gauge Block', '2020-12-11 11:38:58', '2020-12-11 11:38:58'),
(23, 3, 'Vernier Caliper', '2020-12-11 11:40:06', '2020-12-11 11:40:06'),
(24, 3, 'Dial Indicator', '2020-12-11 11:41:16', '2020-12-11 11:41:16'),
(25, 3, 'Measuring Tape', '2020-12-11 11:43:24', '2020-12-11 11:43:24'),
(26, 3, 'Depth Tape', '2020-12-11 11:44:13', '2020-12-11 11:44:13'),
(27, 29, 'Stop Watch', '2020-12-11 11:48:58', '2020-12-11 11:48:58'),
(28, 5, 'Multimeter', '2020-12-11 11:50:26', '2020-12-11 11:50:26'),
(29, 21, 'Tachometer', '2020-12-11 11:59:23', '2020-12-11 11:59:23'),
(30, 10, 'Lux Meter', '2020-12-11 12:02:21', '2020-12-11 12:02:21'),
(31, 31, 'Proving Tank', '2020-12-11 12:04:30', '2020-12-11 12:04:30'),
(32, 31, 'Measuring Cylinder', '2020-12-11 12:05:28', '2020-12-11 12:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 1,
  `make` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `range` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resolution` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `accuracy` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_no` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_no` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traceability` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due` date NOT NULL,
  `calibration_interval` int(11) NOT NULL,
  `commissioned` date NOT NULL,
  `calibration` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `code`, `parameter`, `group_id`, `make`, `model`, `range`, `resolution`, `status`, `accuracy`, `certificate_no`, `serial_no`, `traceability`, `location`, `image`, `due`, `calibration_interval`, `commissioned`, `calibration`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dead Weight Tester', 'P-001', 17, 2, 'Buddenberg', 'BGH1200', '1200 bar', '0.0001', 0, '0.01%', 'l0675/R*1', '489 N', 'NPSL Pakistan', 'AIMS L2', 'default.jpg', '2022-11-04', 1, '2017-01-20', '2019-11-05', NULL, NULL, '2020-12-10 18:39:43'),
(2, 'Digital Pressure Gauge', 'P-002', 17, 1, 'Crystal', 'XP2i', '1000 bar', '0.01', 0, '0.03%', 'AIMS/INT/CC/20/0060', '680352', 'AIMS Cal Lab 2', 'AIMS L2', 'default.jpg', '2021-06-22', 1, '2016-11-01', '2020-06-23', NULL, NULL, '2020-12-10 18:37:13'),
(3, 'Digital Pressure Gauge', 'P-003', 17, 1, 'Crystal', 'XP2i', '500 psi', '0.01', 0, '0.03%', 'AIMS/INT/CC/20/0009', '651388', 'AIMS Cal Lab 2', 'AIMS L2', 'default.jpg', '2021-02-14', 1, '2016-11-01', '2020-02-15', NULL, NULL, '2020-12-10 18:37:13'),
(4, 'Digital Pressure Gauge', 'P-004', 17, 1, 'Crystal', 'XP2i', '2 bar', '0.0001', 0, '0.03%', '20081511', '350589', 'APF PAC Kamra', 'AIMS L2', 'default.jpg', '2021-08-06', 1, '2016-11-20', '2020-08-12', NULL, NULL, '2020-12-10 18:37:13'),
(5, 'Digital Pressure Calibrator', 'P-005', 17, 2, 'Druck', 'DPI610IS', '20 bar', '0.01', 0, '0.03%', 'Out of Services Delivered to BME Dubai for repair. (02-09-2020)', '61014990', 'Out of Services Delivered to BME Dubai for repair. (02-09-2020)', 'AIMS L2', 'default.jpg', '1900-01-02', 1, '2016-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(6, 'Digital Manometer', 'P-006', 17, 0, 'ETI Instruments', 'ETI 8205', '135 InH2O', '0.1', 0, '0.25%', 'AIMS/INT/CC/20/0021', '9102325', '', 'AIMS L2', 'default.jpg', '2021-03-18', 1, '2020-03-18', '2020-03-19', NULL, NULL, NULL),
(7, 'Hydraulic Pressure Pump', 'P-007', 17, 2, 'SI Instruments', 'HTP1', '700 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', '232901', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-02', 1, '2016-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(8, 'Pneumatic/ Hydraulic Pressure Pump', 'P-008', 17, 2, 'Druck', 'P411', '600 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', '14928', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-02', 1, '2016-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(9, 'Pneumatic Pressure Pump', 'P-009', 17, 2, 'SIKA', 'TP1', '20 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', '196130', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-02', 1, '2016-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(10, 'Low Pressure Pump', 'P-010', 17, 2, 'WIKA', 'CPP7', '7 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', '2198103', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-02', 1, '2016-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(11, 'Digital Pressure Indicator', 'P-011', 17, 1, 'Ametek Jofra', 'APC10KGINDG', '700 bar', '0.01', 0, '0.03%', 'AIMS/INT/CC/20/0008', '9804285', 'NPL UK', 'AIMS L2', 'default.jpg', '2021-02-11', 1, '2016-11-20', '2020-09-23', NULL, NULL, '2020-12-10 18:37:13'),
(12, 'High Volume Pressure Pump', 'P-012', 17, 2, 'Vimex', 'P141', '700 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'C 1506C', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-01', 1, '2016-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(13, 'Pressure Data Logger', 'P-013', 17, 0, 'Madgetech', 'PR140', '4 barA', '0.0001', 0, '0.025', 'AIMS/INT/CC/20/0078', 'Q24686', 'CAC China', 'AIMS L2', 'default.jpg', '2020-07-24', 1, '2017-03-15', '2020-09-23', NULL, NULL, NULL),
(14, 'Pneumatic / Hydraulic Pressure Pump', 'P-014', 17, 2, 'Druck', 'PV411', '600 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', '10389', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-01', 1, '2019-11-20', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(15, 'Test Pressure Gauge 6\" Dial 10 bar', 'P-015', 17, 1, 'NOVAFIMA', 'Cu Be 25', '10 bar', '0.05', 0, '0.25%', 'AIMS/INT/CC/20/0018', '560412', 'NPL UK', 'AIMS L2', 'default.jpg', '2021-03-08', 1, '2017-03-25', '2020-03-09', NULL, NULL, '2020-12-10 18:37:13'),
(16, 'Hydrotest Pressure Pump', 'P-016', 17, 2, 'Hydratron', 'AZ-1', '70 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'NIL', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-01', 1, '2019-07-01', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(17, 'Test Pressure Gauge 6\" Dial 400 bar', 'P-017', 17, 1, 'NOVAFIMA', 'Cu Be 25', '400 bar', '2', 0, '0.25%', 'AIMS/INT/CC/20/0027', '8-51725', 'NPSL PK', 'AIMS L2', 'default.jpg', '2021-03-17', 1, '2017-03-25', '2020-03-18', NULL, NULL, '2020-12-10 18:37:13'),
(18, 'Test Pressure Gauge 4\" Dial', 'P-018', 17, 1, 'WIKA', '600 psi', '600 psi', '2', 0, '0.25%', 'AIMS/INT/CC/20/0010', 'NIL', 'NPL UK', 'AIMS L2', 'default.jpg', '2021-03-03', 1, '2017-03-25', '2020-03-04', NULL, NULL, '2020-12-10 18:37:13'),
(19, 'Test Pressure Gauge 6\" Dial 250 bar', 'P-019', 17, 1, 'NOVAFIMA', 'Cu Be 25', '250 bar', '0.5', 0, '0.25%', 'AIMS/INT/CC/20/0028', '8-71174', 'NPSL PK', 'AIMS L2', 'default.jpg', '2021-03-17', 1, '2017-03-25', '2020-03-18', NULL, NULL, '2020-12-10 18:37:13'),
(20, 'Digital Pressure Gauge', 'P-020', 17, 1, 'Additel', '680', '70 bar', '0.001', 0, '0.05%', 'AIMS/INT/CC/20/0061', '218161700', 'NPSL PK', 'AIMS L2', 'default.jpg', '2021-06-22', 1, '2017-08-19', '2020-06-23', NULL, NULL, '2020-12-10 18:37:13'),
(21, 'Hydrostatic Pressure Pump', 'P-021', 17, 2, 'Hydratron', 'AZ-1', '400 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'NIL', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-01', 1, '2019-07-01', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(22, 'Test Bench for Pressure Safety Valve', 'P-022', 17, 0, 'Local', '6\" Flange Size', '600 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'NIL', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS L2', 'default.jpg', '1900-01-01', 1, '2018-09-01', '1900-01-01', NULL, NULL, NULL),
(23, 'Pressure and Flow Meter', 'P-023', 17, 0, 'CEM Taimwan', 'DT-8920', '5 kPa', '0.001', 0, '0.05%', 'TCSL-19-2257', 'NIL', 'NPL, UK', 'AIMS L2', 'default.jpg', '2020-10-07', 1, '2018-08-25', '2019-12-08', NULL, NULL, NULL),
(24, 'Hydraulic Pressure Pump', 'P-024', 17, 2, 'Ametek M & F', 'Ametek', '1000 bar', 'NR', 0, 'NR', '#REF!', '#REF!', '#REF!', '#REF!', 'default.jpg', '1900-01-01', 1, '2019-12-01', '0000-00-00', NULL, NULL, '2020-12-10 18:39:43'),
(25, 'Vacuum Pump', 'P-025', 17, 2, 'Welch', '1400 M', '-0.999 bar', 'NR', 0, 'NR', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', '145712', 'Pressure Generating Source without indication, Hence no calibration possible (Required)', 'AIMS Cal Lab 2', 'default.jpg', '1900-01-01', 1, '2019-07-01', '1900-01-01', NULL, NULL, '2020-12-10 18:39:43'),
(26, 'Digital Thermometer with Standard Probe', 'T-001', 27, 4, 'WIKA', 'CTR2000+CPT5000', '650 C', '0.001', 0, '0.1', 'CU-600009919', '033269-02/652-S/9217-1/1216-01', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-06-24', 1, '2017-05-30', '2019-06-25', NULL, NULL, '2020-12-10 18:44:11'),
(27, 'Digital Thermometer with RTD Probe', 'T-002', 27, 4, 'AZ Inst.', '8822', '300 C', '0.01', 0, '0.15', 'AIMS/INT/CC/20/0007', '1030001', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-02-13', 1, '2016-11-01', '2020-02-14', NULL, NULL, '2020-12-10 18:44:11'),
(28, 'Type K (2 mm) Thermocouple with Beamax MC3', 'T-003', 27, 4, 'Local', '2 mm SS', '300 C', '0.01', 0, '0.5', 'AIMS/INT/CC/20/0019', '--', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-02-13', 1, '2016-11-01', '2020-02-14', NULL, NULL, '2020-12-10 18:44:11'),
(29, 'Type K (2 mm) Thermocouple with Beamax MC3', 'T-003A', 27, 0, 'Local', '2 mm SS', '300 C', '0.01', 0, '0.5', 'AIMS/INT/CC/20/0020', '--', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-02-13', 1, '2016-11-01', '2020-02-14', NULL, NULL, NULL),
(30, 'Temperature Data Logger with K Type Probes', 'T-004', 27, 10, 'Fluke', '2625A', '350 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0090', '8485013', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-11-04', 1, '2016-11-20', '2020-10-23', NULL, NULL, '2020-12-10 18:55:20'),
(31, 'RTD Calibrator with RTD Probe', 'T-005', 27, 4, 'Fluke', '712', '300 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0077', '7926089', 'NPL UK', 'AIMS L1', 'default.jpg', '2020-09-23', 1, '2016-11-20', '2020-09-21', NULL, NULL, '2020-12-10 18:44:11'),
(32, 'Digital Thermometer with K Type Touch Probe', 'T-006', 27, 3, 'Fluke', '52 II', '350 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0082', '8722005', 'NPL UK', 'AIMS L1', 'default.jpg', '2020-10-07', 1, '2017-03-23', '2020-10-05', NULL, NULL, '2020-12-10 18:41:21'),
(33, 'Dry Blcok Calibrator', 'T-007', 27, 7, 'Jofra', 'ATC155B', '150 C', '0.01', 0, '0.1', 'AIMS/INT/CC/20/0044', '501734-00014', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-04-17', 1, '2016-11-01', '2020-04-18', NULL, NULL, '2020-12-10 18:49:52'),
(34, 'Dry Blcok Calibrator', 'T-008', 27, 7, 'Fluke', '5961T', '120 C', '0.1', 0, '0.3', 'AIMS/INT/CC/20/0022', '--', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-03-27', 1, '2019-11-01', '2020-03-28', NULL, NULL, '2020-12-10 18:49:52'),
(35, 'Temperature Bath', 'T-009', 27, 11, 'ISO Tech', '2140B', '95 C', '0.1', 0, '0.2', 'AIMS/INT/CC/20/0023', '20746/1', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-03-29', 1, '2019-11-01', '2020-03-30', NULL, NULL, '2020-12-10 18:56:41'),
(36, 'Hi Temprature IR Thermometer', 'T-010', 27, 12, 'Fluke', '572-2', '900 C', '0.1', 0, '3', 'AIMS/INT/CC/20/0001', 'NIL', 'NIST USA', 'AIMS L1', 'default.jpg', '2020-12-30', 1, '2016-11-01', '2020-01-01', NULL, NULL, '2020-12-10 18:57:38'),
(37, 'IR Calibrator', 'T-012', 27, 12, 'WIKA', 'KX7N', '500 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0087', '160400019', 'NPL UK', 'AIMS L1', 'default.jpg', '2020-10-08', 1, '2017-05-15', '2020-10-05', NULL, NULL, '2020-12-10 18:57:38'),
(38, 'Digital Thermohygrometer', 'T-013', 27, 5, 'China', 'NIL', '50C, 70 % RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0073', '87799', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-08-30', 1, '2016-11-20', '2020-08-31', NULL, NULL, '2020-12-10 18:47:04'),
(39, 'Digital Thermohygrometer', 'T-014', 27, 5, 'Schem Tech', 'SCT-THYG-PEN-4', '50C, 70 % RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0074', '1504091', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-08-30', 1, '2016-11-20', '2020-08-31', NULL, NULL, '2020-12-10 18:47:04'),
(40, 'Type K Thermocouple (3 mm X 100 mm) with Fluke 51 II', 'T-015', 27, 4, 'Fluke', '52 II', '120 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0045', '16080071', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-04-17', 1, '2017-01-20', '2020-04-18', NULL, NULL, '2020-12-10 18:44:11'),
(41, 'Type K Thermocouple (6 mm) with Fluke 51 II', 'T-015A', 27, 4, 'RM & C', 'TANGA 025', '650 C', '0.1', 0, '2', 'AIMS/INT/CC/20/0046', 'T1365110145', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-04-21', 1, '2017-01-20', '2020-04-22', NULL, NULL, '2020-12-10 18:44:11'),
(42, 'Wire Less Temperature Data Logger', 'T-016', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025769', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(43, 'Wire Less Temperature Data Logger', 'T-017', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025893', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(44, 'Wire Less Temperature Data Logger', 'T-018', 27, 8, 'Madgetech', 'HiTemp140', '140 C', '0.01', 0, '0.1', 'AIMS/INT/CC/20/0049A', 'R08074', 'NIST USA', 'AIMS L1', 'default.jpg', '2020-07-17', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(45, 'Wire Less Temperature Data Logger', 'T-019', 27, 8, 'Madgetech', 'HiTemp140', '140 C', '0.01', 0, '0.1', 'AIMS/INT/CC/20/0049A', 'R08064', 'NIST USA', 'AIMS L1', 'default.jpg', '2020-07-17', 1, '2019-09-17', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(46, 'Wire Less Temperature Data Logger', 'T-020', 27, 8, 'Madgetech', 'HiTemp140', '140 C', '0.01', 0, '0.1', 'AIMS/INT/CC/20/0049A', 'R08079', 'NIST USA', 'AIMS L1', 'default.jpg', '2020-07-17', 1, '2019-09-17', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(47, 'Wire Less Temperature Data Logger', 'T-021', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025790', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2019-09-17', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(48, 'Wire Less Temperature Data Logger', 'T-022', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025886', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(49, 'Wire Less Temperature Data Logger', 'T-023', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025885', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(50, 'Wire Less Temperature Data Logger', 'T-024', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025816', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(51, 'Wire Less Temperature Data Logger', 'T-025', 27, 8, 'Lascar Elects.', 'EL-USB-1-PRO', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0049A', '10025789', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-05-26', 1, '2017-02-20', '2020-05-27', NULL, NULL, '2020-12-10 18:51:45'),
(52, 'S Type Thermocouple with MC Process Calibrator', 'T-027', 27, 4, 'Germany', '8 mm X 300 mm', '1700 C', '0.01', 0, '1.5', '--', '-', '-', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, '2020-12-10 18:44:11'),
(53, 'Touch Probe Thermometer', 'T-028', 27, 3, 'E.T.I. Ltd', 'Therma 1', '150 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0012', 'D08380082', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-03-06', 1, '2017-03-22', '2020-03-07', NULL, NULL, '2020-12-10 18:41:21'),
(54, 'Dry Blcok Calibrator', 'T-034', 27, 7, 'Fluke', '9102S', '120 C', '0.1', 0, '0.5', 'AIMS/INT/CC/20/0024', '9102S', 'NPL UK', 'AIMS L1', 'default.jpg', '2021-03-07', 1, '2017-04-02', '2020-03-28', NULL, NULL, '2020-12-10 18:49:52'),
(55, 'Thermohygrometer', 'T-035', 27, 5, 'Extech', '445703', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0072', '7071901', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-08-30', 1, '2017-07-30', '2020-08-31', NULL, NULL, '2020-12-10 18:47:04'),
(56, 'Dry Blcok Calibrator', 'T-036', 27, 7, 'Hart Scientific', '9140', '350 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0043', 'A53630', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-04-16', 1, '2017-11-25', '2020-04-17', NULL, NULL, '2020-12-10 18:49:52'),
(57, 'Dry Blcok Calibrator', 'T-043', 27, 7, 'Jofra', 'ITC-650A', '650 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0095', '514261-00069', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-12-12', 1, '2018-12-10', '2020-11-16', NULL, NULL, '2020-12-10 18:49:52'),
(58, 'Thermohygro Data Logger', 'T-044', 27, 9, 'CEM Taiwan', 'DT-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180409257', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(59, 'Thermohygro Data Logger', 'T-045', 27, 9, 'Standard Taiwan', 'ST-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180502800', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(60, 'Thermohygro Data Logger', 'T-046', 27, 9, 'CEM Taiwan', 'DT-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180409230', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(61, 'Thermohygro Data Logger', 'T-047', 27, 9, 'CEM Taiwan', 'DT-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180305378', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(62, 'Thermohygro Data Logger', 'T-048', 27, 9, 'CEM Taiwan', 'DT-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180409226', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(63, 'Thermohygro Data Logger', 'T-049', 27, 9, 'Standard Taiwan', 'ST-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180305387', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(64, 'Thermohygro Data Logger', 'T-050', 27, 9, 'Standard Taiwan', 'ST-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180305377', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(65, 'Thermohygro Data Logger', 'T-051', 27, 9, 'Standard Taiwan', 'ST-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180305396', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(66, 'Thermohygro Data Logger', 'T-052', 27, 9, 'Standard Taiwan', 'ST-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180409224', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(67, 'Thermohygro Data Logger', 'T-053', 27, 9, 'Standard Taiwan', 'ST-172', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0067', '180305354', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-07-07', 1, '2018-12-20', '2020-07-28', NULL, NULL, '2020-12-10 18:53:56'),
(68, 'Digital Thermometer with K Type 3mm Probe', 'T-061', 27, 4, 'Fluke', '52 II', '1000 C', '0.1', 0, '3', 'AIMS/INT/CC/20/0058', '12360059', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-04-03', 1, '2019-01-10', '2020-03-05', NULL, NULL, '2020-12-10 18:44:11'),
(69, 'Hygro- Thermometer', 'T-062', 23, 6, 'Extech', 'RH210', '50 C, 70% RH', '0.1', 0, '1', 'AIMS/INT/CC/20/0006', 'A.041244', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2021-01-21', 1, '2019-02-02', '2020-01-22', NULL, NULL, '2020-12-10 18:48:39'),
(70, 'Wire Less Temperature Data Logger', 'T-063', 27, 8, 'DICKSON', 'HT300', '120 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0007-A', '15314014', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-02-05', 1, '2019-02-05', '2020-02-06', NULL, NULL, '2020-12-10 18:51:45'),
(71, 'Wire Less Temperature Data Logger', 'T-064', 27, 8, 'DICKSON', 'HT300', '120 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0007-A', '16187578', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-02-05', 1, '2019-02-05', '2020-02-06', NULL, NULL, '2020-12-10 18:51:45'),
(72, 'Wire Less Temperature Data Logger', 'T-065', 27, 8, 'DICKSON', 'HT300', '120 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0007-A', '16187579', 'DCL Dubai', 'AIMS L1', 'default.jpg', '2020-02-05', 1, '2019-02-05', '2020-02-06', NULL, NULL, '2020-12-10 18:51:45'),
(73, 'Temperature Recorder', 'T-066', 27, 10, 'Lutron', 'BTM-4208SD', '350 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0055', 'I.443487', 'NPL UK', 'AIMS Cal Lab1', 'default.jpg', '2021-06-18', 1, '2019-04-01', '2020-06-18', NULL, NULL, '2020-12-10 18:55:20'),
(74, 'Hot and Cold Bath', 'T-068', 27, 11, 'PCSIR CDLE', 'ESM-4900', '200 C', '0.1', 0, '1', 'Temperature Generating Source, Hence no calibration is required', '--', 'Temperature Generating Source, Hence no calibration is required', 'AIMS Cal Lab1', 'default.jpg', '1900-01-01', 1, '2019-10-09', '1900-01-01', NULL, NULL, '2020-12-10 18:56:41'),
(75, 'K-Type Temp Probe DMM', 'T-069', 27, 4, 'Fluke', '179', '100 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0056', '-', 'DCL Dubai', 'AIMS Cal Lab1', 'default.jpg', '2021-06-21', 1, '2019-04-18', '2020-05-04', NULL, NULL, '2020-12-10 18:44:11'),
(76, 'K-Type Temp Probe DMM', 'T-069A', 27, 4, 'Fluke', '179', '100 C', '0.1', 0, '1', 'AIMS/INT/CC/20/0056', '-', 'DCL Dubai', 'AIMS Cal Lab1', 'default.jpg', '2021-06-21', 1, '2019-04-18', '2020-05-04', NULL, NULL, '2020-12-10 18:44:11'),
(77, 'Mini Bath Hot and Cold', 'T-070', 27, 11, 'Azbil', 'SDC15', '30 C', '0.1', 0, '1', 'Temperature Generating Source, Hence no calibration is required', '--', 'Temperature Generating Source, Hence no calibration is required', 'AIMS Cal Lab1', 'default.jpg', '2020-10-11', 1, '2019-10-09', '0000-00-00', NULL, NULL, '2020-12-10 18:56:41'),
(78, 'Digital Thermometer with RTD Probe', 'T-071', 27, 4, 'Testo', '735', '300 C', '0.01', 0, '1', 'AIMS/INT/CC/20/0096', '61916767', 'NPL UK', 'AIMS Cal Lab1', 'default.jpg', '2020-11-18', 1, '2019-11-11', '2020-11-16', NULL, NULL, '2020-12-10 18:44:11'),
(79, 'Digital Thermohygrometer', 'T-072', 27, 5, 'TFA', '30.5011', '55 C, 80%RH', '0.1', 0, '1', 'PSC/SRF/19/TH/0591-01', '20192801', 'NPL UAE', 'AIMS Cal Lab1', 'default.jpg', '2020-10-26', 1, '2019-11-11', '2019-10-28', NULL, NULL, '2020-12-10 18:47:04'),
(80, 'Digital Thermohygrometer', 'T-073', 27, 5, 'TFA', '30.5011', '55 C, 80%RH', '0.1', 0, '1', 'PSC/SRF/19/TH/0591-02', '20192802', 'NPL UAE', 'AIMS Cal Lab1', 'default.jpg', '2020-10-26', 1, '2019-11-11', '2019-10-28', NULL, NULL, '2020-12-10 18:47:04'),
(81, 'Digital Thermohygrometer', 'T-074', 27, 5, 'TFA', '30.5011', '55 C, 80%RH', '0.1', 0, '1', 'PSC/SRF/19/TH/0591-03', '20192803', 'NPL UAE', 'AIMS Cal Lab1', 'default.jpg', '2020-10-26', 1, '2019-11-11', '2019-10-28', NULL, NULL, '2020-12-10 18:47:04'),
(82, 'Digital Thermohygrometer Barometer', 'T-075', 23, 6, 'Extech', 'SD700', '50C, 80% RH', '0.1', 0, '1', 'PSC/SRF/19/TH/0711-01', 'A.100704', 'DCL, UAE', 'AIMS Cal Lab1', 'default.jpg', '2021-09-04', 1, '2019-12-30', '2019-12-25', NULL, NULL, '2020-12-10 18:48:39'),
(83, 'Mini Data Logger', 'T-076', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37325186', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(84, 'Mini Data Logger', 'T-077', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37325213', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(85, 'Mini Data Logger', 'T-078', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37325216', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(86, 'Mini Data Logger', 'T-079', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37335228', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(87, 'Mini Data Logger', 'T-080', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37336319', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(88, 'Mini Data Logger', 'T-081', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37336341', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(89, 'Mini Data Logger', 'T-082', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37336344', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(90, 'Mini Data Logger', 'T-083', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37337497', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(91, 'Mini Data Logger', 'T-084', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37337730', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(92, 'Mini Data Logger', 'T-085', 23, 9, 'Testo', '174H', '99%', '0.1', 0, '1', 'AIMS/INT/CC/20/0066', '37337758', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-07-24', 1, '2020-07-24', '2020-07-25', NULL, NULL, '2020-12-10 18:53:56'),
(93, 'Precision Weight Set', 'M-001', 13, 13, 'Ohaus', 'F1 Class', '1000 g', '0.001', 0, 'F1 Class', 'AIMS/INT/CC/20/0083', '1603313', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-10-07', 1, '2016-11-01', '2020-10-05', NULL, NULL, '2020-12-10 19:00:25'),
(94, 'Precision Mass 1 Kg', 'M-002', 13, 0, 'Adler Inst. UK', '1 Kg F1 Class', '1 kg', 'NR', 0, 'F1 Class', 'CL-666(M-116)2020', '1607825', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-11-01', '2020-09-23', NULL, NULL, NULL),
(95, 'Precision Mass 2 Kg', 'M-003', 13, 14, 'Adler Inst. UK', '2 Kg F1 Class', '2 kg', 'NR', 0, 'F1 Class', 'CL-666(M-117)2020', '1607832', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-11-01', '2020-09-23', NULL, NULL, '2020-12-10 19:04:01'),
(96, 'Precision Mass 2 Kg', 'M-004', 13, 14, 'Adler Inst. UK', '2 Kg F1 Class', '2 kg', 'NR', 0, 'F1 Class', 'CL-666(M-118)2020', '1607836', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-11-01', '2020-09-23', NULL, NULL, '2020-12-10 19:04:01'),
(97, 'Precision Mass 5 Kg', 'M-005', 13, 0, 'Adler Inst. UK', '5 Kg F1 Class', '5 kg', 'NR', 0, 'F1 Class', 'CL-666(M-119)2020', '1517113', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-11-01', '2020-09-23', NULL, NULL, NULL),
(98, 'Precision Mass 10 Kg', 'M-006', 13, 15, 'Adler Inst. UK', '10 Kg F1 Class', '10 kg', 'NR', 0, 'F1 Class', 'EWML/CERT/2009/01 5-01', '1517116', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-11-01', '2020-09-10', NULL, NULL, '2020-12-10 19:05:09'),
(99, 'Precision Mass 20 Kg', 'M-007', 13, 16, 'Adler Inst. UK', '20 Kg F1 Class', '20 kg', 'NR', 0, 'F1 Class', 'EWML/CERT/2009/01 5-03', '1626393', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-12-28', '2020-09-10', NULL, NULL, '2020-12-10 19:08:10'),
(100, 'Precision Mass 20 Kg', 'M-008', 13, 16, 'Adler Inst. UK', '20 Kg F1 Class', '20 kg', 'NR', 0, 'F1 Class', 'EWML/CERT/2009/01 5-02', '1626453', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-14', 1, '2016-12-28', '2020-09-10', NULL, NULL, '2020-12-10 19:08:10'),
(101, 'Weighing Balance Semi Micro', 'M-009', 13, 17, 'Radwag', 'AS 60/220 R2', '220 g', '0.00001', 0, 'Class I', 'AIMS/INT/CC/20/0013', '503388', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-03-06', 1, '2016-12-28', '2020-03-07', NULL, NULL, '2020-12-10 19:10:09'),
(102, 'Precision Weighing Scale', 'M-010', 13, 17, 'Radwag', 'PS 4500/R2', '4500 g', '0.01', 0, 'Class II', 'AIMS/INT/CC/20/0014', '519049', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-03-06', 1, '2016-11-20', '2020-03-07', NULL, NULL, '2020-12-10 19:10:09'),
(103, 'Precision Weighing Scale', 'M-011', 13, 17, 'Radwag', 'APP 35/R2', '35000 g', '0.1', 0, 'Class II', 'AIMS/INT/CC/20/0015', '520010', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-03-06', 1, '2016-12-28', '2020-03-07', NULL, NULL, '2020-12-10 19:10:09'),
(104, 'M1 Class Weight 20 Kg', 'M-012~21', 13, 16, 'Crown Mill', 'CEW', '20 kg', 'NR', 0, 'M1 Class', 'AIMS/INT/CC/19/0080', 'NIL', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-11-28', 1, '2017-01-20', '2019-11-29', NULL, NULL, '2020-12-10 19:08:10'),
(105, 'Weighing Scale 100 Kg', 'M-022', 13, 18, 'Maxtech', 'D 272', '100 kg', '0.001', 0, 'Class II', 'AIMS/INT/CC/20/0016', 'J203779', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-03-03', 1, '2017-09-09', '2020-03-04', NULL, NULL, '2020-12-10 19:10:58'),
(106, 'Standard Mass Set F2 Class', 'M-023', 13, 13, 'China', '5mg ~ 5 kg', '10 kg', '0.001', 0, 'F2 Class', 'AIMS/INT/CC/20/0092', '--', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-10-09', 1, '2017-10-20', '2020-10-07', NULL, NULL, '2020-12-10 19:00:25'),
(107, 'M1 Class Weight 20 Kg', 'M-024~073', 13, 16, 'SFW Multan', '20 kg M1 Class', '20 kg', 'NR', 0, 'M1 Class', 'AIMS/INT/CC/19/0074', '--', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-11-28', 1, '2017-10-20', '2019-11-29', NULL, NULL, '2020-12-10 19:08:10'),
(108, 'M1 Class Weight 10 Kg', 'M-074', 13, 15, 'SFW Multan', '10 kg M1 Class', '10 kg', 'NR', 0, 'M1 Class', 'AIMS/INT/CC/19/0081', '--', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-11-28', 1, '2017-10-20', '2019-11-29', NULL, NULL, '2020-12-10 19:05:09'),
(109, 'M1 Class Weight 20 Kg', 'M-075', 13, 16, 'Adler Inst. UK', '20 kg M1 Class', '20 kg', 'NR', 0, 'M1 Class', 'AIMS/INT/CC/20/0054', '--', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-11-28', 1, '2017-10-20', '2020-06-15', NULL, NULL, '2020-12-10 19:08:10'),
(110, 'Precision Weight Set', 'M-076', 13, 13, 'FUYUE', 'E2 Class', '1000 g', '0.001', 0, 'E2 Class', 'MMC-2020-427', '18DB03', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-09-06', 1, '2018-05-17', '2020-09-09', NULL, NULL, '2020-12-10 19:00:25'),
(111, 'Disk Weights Set', 'M-077', 13, 0, 'Local', 'M1', '200 kg', '1', 0, 'M1 Class', 'AIMS/INT/CC/20/0042', 'A ~ EE', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-04-14', 1, '2018-05-25', '2020-04-15', NULL, NULL, NULL),
(112, 'M1 Class Standard Weight', 'M-078', 13, 16, 'Adler Inst. UK', '20 kg M1 Class', '20 kg', 'NR', 0, 'M1 Class', 'AIMS/INT/CC/20/0017', 'M19A202-01', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-01-21', 1, '2019-02-02', '2020-01-22', NULL, NULL, '2020-12-10 19:08:10'),
(113, 'Weighing Scale', 'M-079', 13, 18, 'Cardinal', '180UK', '2000 kg', '0.01', 0, '0.2', 'AIMS/INT/CC/20/0015', '520010', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-07-07', 1, '2016-12-28', '2020-03-07', NULL, NULL, '2020-12-10 19:10:58'),
(114, 'Pro Test Torque Tranducer', 'TQ-001', 28, 19, 'Norbar', '43220', '1500 Nm', '0.1', 0, '1', 'AIMS/INT/CC/20/0038', '65279', 'DCL, Dubai,\nNPSL, Pak', 'AIMS Cal Lab 2', 'default.jpg', '2020-03-26', 1, '2016-11-01', '2020-03-26', NULL, NULL, '2020-12-11 11:31:30'),
(115, 'Toque Testing Bar (small)', 'TQ-002', 28, 0, 'Local', '300 mm', '300 mm', 'NR', 0, '0.1', 'AIMS/INT/CC/19/0052', 'Misc', 'NPL UK', 'AIMS Cal Lab 2', 'default.jpg', '2020-07-23', 1, '2018-06-12', '2019-07-26', NULL, NULL, NULL),
(116, 'Toque Testing Bar (long)', 'TQ-003', 28, 0, 'Local', '1000 mm', '1000 mm', 'NR', 0, '0.3', 'CC-9778', 'Misc', 'SIRIM Malaysia & KRISS Korea', 'AIMS Cal Lab 2', 'default.jpg', '2020-02-23', 1, '2018-08-17', '2019-02-25', NULL, NULL, NULL),
(117, 'Torque Wrench Calibrator', 'TQ-004', 28, 19, 'TOHNICHI', 'DOT100 N', '100 Nm', '0.5', 0, '0.5', 'Not Commisioned yet ( not in use)', '--', 'Not Commisioned yet ( not in use)', 'AIMS Cal Lab 2', 'default.jpg', '2021-03-31', 1, '0000-00-00', '1900-01-01', NULL, NULL, '2020-12-11 11:31:30'),
(118, 'Torque Wrench Calibrator', 'TQ-005', 28, 19, 'TOHNICHI', 'DOT300N', '300 Nm', '1', 0, '1', 'Not Commisioned yet ( not in use)', '--', 'Not Commisioned yet ( not in use)', 'AIMS Cal Lab 2', 'default.jpg', '2021-03-31', 1, '0000-00-00', '1900-01-01', NULL, NULL, '2020-12-11 11:31:30'),
(119, 'Load Cell With Digital Indicator', 'F-001', 6, 20, 'PT Global', 'HCC180t+PT200X', '180000 kg', '1', 0, '10', '200108.3.1', 'H2086315', 'PTB Germany', 'AIMS Cal Lab 2', 'default.jpg', '2018-10-24', 1, '2016-11-01', '2020-01-08', NULL, NULL, '2020-12-11 11:33:09'),
(120, 'Tensile Load Cell', 'F-002', 6, 20, 'MARINI', 'TSC2', '300 kg', '0.01', 0, '0.2', '171030.6.4', '307737', 'PTB Germany', 'AIMS Cal Lab 2', 'default.jpg', '2021-10-01', 1, '2016-11-01', '2017-10-30', NULL, NULL, '2020-12-11 11:33:09'),
(121, 'Push Pull Gauge', 'F-003', 6, 21, 'IMADA', '0~10 Kg', '10 kg', '0.01', 0, '0.01', 'AIMS/INT/CC/18/00021', '136386', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2018-10-24', 1, '2017-04-12', '2018-04-07', NULL, NULL, '2020-12-11 11:34:22'),
(122, 'Tensile Load Cell 50 Ton', 'F-004', 6, 20, 'Dynafor', '0909 00L', '50000 kg', '20', 0, '20', 'CED/STC/196', '--', 'NPL UK', 'AIMS Cal Lab 2', 'default.jpg', '2018-10-24', 1, '2017-12-01', '2020-09-21', NULL, NULL, '2020-12-11 11:33:09'),
(123, 'Tensile Load Cell 0.5 Ton with Indicator', 'F-005', 6, 20, 'Measurement General', 'M02/H31A 500', '4900 N', '0.1', 0, '1', 'AIMS/INT/CC/19/0050', 'QZ032990', 'DCL UAE', 'AIMS Cal Lab 2', 'default.jpg', '2020-05-04', 1, '2018-03-10', '2019-07-27', NULL, NULL, '2020-12-11 11:33:09'),
(124, 'Digital Force Indicator', 'F-008', 6, 21, 'SHIPMO', 'FGE-100X', '50 Kg', '0.01', 0, '0.1', 'AIMS/INT/CC/20/0049', 'Z9513J565', 'DCL UAE', 'AIMS Cal Lab 2', 'default.jpg', '2021-05-03', 1, '2019-04-19', '2020-05-04', NULL, NULL, '2020-12-11 11:34:22'),
(125, 'Gauge Block Set', 'D-001', 3, 22, 'Vertex', 'VGB-103-0', '500 mm', '0.5', 0, '0 Grade', 'D-7/27/2019', '30451', 'NPSL, PK', 'AIMS Cal Lab 2', 'default.jpg', '2021-05-07', 1, '2016-11-20', '2019-08-06', NULL, NULL, '2020-12-11 11:38:58'),
(126, 'Steel Rule', 'D-002', 3, 25, 'Mitutoyo', '182-309', '1000 mm', '0.5', 0, '0.5', 'CC-9779', '16-1807-01', 'SIRIM Malaysia & KRISS Korea', 'AIMS Cal Lab 2', 'default.jpg', '2021-01-15', 1, '2016-11-20', '2019-02-15', NULL, NULL, '2020-12-11 11:43:24'),
(127, 'Digital Vernier Caliper', 'D-003', 3, 23, 'Insize', '1112-300', '300 mm', '0.01', 0, '0.02', 'AIMS/INT/CC/20/0002', '709153008', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-12-30', 1, '2016-01-01', '2020-01-01', NULL, NULL, '2020-12-11 11:40:06'),
(128, 'Outside Micrometer', 'D-004', 3, 0, 'Mitutoyo', '103-137', '25 mm', '0.001', 0, '0.002', 'AIMS/INT/CC/20/0093', '26051991', 'NPSL PK, NPL IND', 'AIMS Cal Lab 2', 'default.jpg', '2020-11-21', 1, '2016-01-01', '2020-11-16', NULL, NULL, NULL),
(129, 'Dial Indicator', 'D-005', 3, 24, 'Mitutoyo', '2109S-10', '1 mm', '0.001', 0, '0.002', 'AIMS/INT/CC/20/0003', 'PVS370', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-12-30', 1, '2016-01-01', '2020-01-01', NULL, NULL, '2020-12-11 11:41:16'),
(130, 'Dial Indicator', 'D-006', 3, 24, 'Mitutoyo', '2052FE', '30 mm', '0.01', 0, '0.02', 'AIMS/INT/CC/20/0004', 'CKE235', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2020-12-30', 1, '2016-01-01', '2020-01-01', NULL, NULL, '2020-12-11 11:41:16'),
(131, 'Laser Distance Meter', 'D-007', 3, 26, 'Schem Tech', 'SCT-108.002.19', '50 m', '0.001', 0, '0.002', 'MSL-Cert-Int/20/001999', '150601445', 'METAS', 'AIMS Cal Lab 2', 'default.jpg', '2020-09-01', 1, '2016-11-01', '2020-09-05', NULL, NULL, '2020-12-11 11:44:13'),
(132, 'Steel Measuring Tape', 'D-008', 3, 25, 'MPT', 'MHE01003-5M', '5 m', '0.001', 0, '0.002', 'AIMS/INT/CC/20/0034', 'NIL', 'METAS', 'AIMS Cal Lab 2', 'default.jpg', '2020-04-06', 1, '2017-02-20', '2020-04-07', NULL, NULL, '2020-12-11 11:43:24'),
(133, 'Optical Flate Set', 'D-009', 3, 0, 'INSIZE', '4184-41A', '25 mm', 'NR', 0, 'NR', 'Calibration not Required as there is no indication available on the disks.', '16100048', 'Calibration not Required as there is no indication available on the disks.', 'AIMS Cal Lab 2', 'default.jpg', '1900-01-01', 1, '2017-02-20', '1900-01-01', NULL, NULL, NULL),
(134, 'Micrometer Stand', 'D-010', 3, 0, 'INSIZE', 'NIL', 'NR', 'NR', 0, 'NR', 'Stand for Holding of Micrometer, No indication hence no calibration is required.', 'NIL', 'Stand for Holding of Micrometer, No indication hence no calibration is required.', 'AIMS Cal Lab 2', 'default.jpg', '1900-01-01', 1, '2016-11-20', '1900-01-01', NULL, NULL, NULL),
(135, 'Measuring Tap', 'D-011', 3, 25, 'LICOTA', 'AMP-25019YA', '5 m', '0.001', 0, '0.002', 'AIMS/INT/CC/20/0005', 'NIL', 'NPL UK', 'AIMS Cal Lab 2', 'default.jpg', '2020-04-06', 1, '2018-12-26', '2019-12-27', NULL, NULL, '2020-12-11 11:43:24'),
(136, 'Dial Gauge Stand', 'D-012', 3, 0, 'INSIZE', '6862-1002', 'NR', 'NR', 0, 'NR', 'Stand for Holding of Dial Indicators, No indication hence no calibration is required.', '1305141192', 'Stand for Holding of Dial Indicators, No indication hence no calibration is required.', 'AIMS Cal Lab 2', 'default.jpg', '1900-01-01', 1, '2017-03-31', '1900-01-01', NULL, NULL, NULL),
(137, 'Metal Test Card', 'D-013', 3, 0, 'Local', '? 1.5 mm', '1.5 mm', 'NR', 0, 'NR', 'AIMS/INT/CC/20/0035', 'NIL', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2021-04-07', 1, '2017-05-03', '2020-04-08', NULL, NULL, NULL),
(138, 'Monochromatic Light Box', 'D-014', 3, 0, 'Local', 'NIL', '575 nm', 'NR', 0, 'NR', '121584', 'NIL', 'NPL UK', 'AIMS Cal Lab 2', 'default.jpg', '2023-01-04', 1, '2018-01-20', '2018-01-05', NULL, NULL, NULL),
(139, 'Mic Check Gauge Block Set', 'D-015', 3, 22, 'Insize', 'NA', '150 mm', '2.5', 0, '0.05', 'QSI/3553/19/12', '170019', 'NPL India', 'AIMS Cal Lab 2', 'default.jpg', '2021-12-18', 1, '2017-11-05', '2019-12-19', NULL, NULL, '2020-12-11 11:38:58'),
(140, 'Caliper Check Gague Block Set', 'D-016', 3, 22, 'Insize', 'NIL', '750 mm', '30', 0, '0.05', 'QSI/3552/19/12', '170005', 'NPL India', 'AIMS Cal Lab 2', 'default.jpg', '2021-12-18', 1, '2017-11-05', '2019-12-19', NULL, NULL, '2020-12-11 11:38:58'),
(141, 'Pick Glass', 'D-017', 3, 0, 'China', 'NIL', '25 mm', '1', 0, '0.05', 'AIMS/INT/CC/19/0053', 'Nil', 'NPL Uk', 'AIMS Cal Lab 2', 'default.jpg', '2020-07-25', 1, '2018-06-30', '2019-07-26', NULL, NULL, NULL),
(142, 'Vernier Caliper', 'D-018', 3, 23, 'Insize', '100 CM', '1000 mm', '0.2', 0, '0.5', 'AIMS/INT/CC/20/0069', '826110015', 'NPSL PK, NPL IND', 'AIMS Cal Lab 2', 'default.jpg', '2020-07-25', 1, '2018-08-27', '2020-08-23', NULL, NULL, '2020-12-11 11:40:06'),
(143, 'Alignment Kit for Dissolution Apparatus', 'D-020', 3, 0, 'Pakistan', 'AKD', '25 mm', '0.001', 0, '1', 'AIMS/INT/CC/20/0048', '-', 'NPSL PK', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-21', 1, '2019-06-01', '2020-04-04', NULL, NULL, NULL),
(144, 'Step Gauge Wedge', 'D-021', 3, 0, 'INSIZE', 'Grade 2', '10 mm', '1', 0, '0.01', 'AIMS/INT/CC/20/0039', '140-18/CS', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2021-05-21', 1, '2020-03-19', '2020-04-06', NULL, NULL, NULL),
(145, 'Depth Measuring Tap', 'D-022', 3, 26, 'BMI', '30', '30 meter', '0.001', 0, '0.01', 'AIMS/INT/CC/20/0005', 'NIL', 'NPL UK', 'AIMS Cal Lab 2', 'default.jpg', '2021-07-14', 1, '2018-12-26', '2019-12-27', NULL, NULL, '2020-12-11 11:44:13'),
(146, 'Digital Vernier Caliper', 'D-023', 3, 23, 'INSIZE', '1108-150', '150 mm', '0.01', 0, '0.01', 'AIMS/INT/CC/20/0002', '709153008', 'NPSL PK', 'AIMS Cal Lab 2', 'default.jpg', '2021-10-07', 1, '2016-01-01', '2020-01-01', NULL, NULL, '2020-12-11 11:40:06'),
(147, 'Multifunction Calibrator', 'E-001', 5, 0, 'Time Electronics', '5025', '1000V, 1000Amp, 2 Gohm', '0.00001', 0, '5.00%', '20101913', '1401J16', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-11-03', 1, '2016-01-20', '2020-10-14', NULL, NULL, NULL),
(148, 'Digital Multimeter', 'E-002', 5, 28, 'Agilent', '34401A', '1000V, 3Amps, 100 Mohm', '0.000001', 0, '0.025', '20081512', 'US-36117779', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-08-09', 1, '2016-11-01', '2020-08-10', NULL, NULL, '2020-12-11 11:50:26'),
(149, 'Insulation Resistance Box', 'E-003', 5, 0, 'Meggar', 'CB101', '10000 Mohm', '10 Mohm', 0, '0.25', '20081514', '101555549', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-08-09', 1, '2016-11-20', '2020-08-10', NULL, NULL, NULL),
(150, 'Process Calibrator', 'E-004', 5, 0, 'Beamax', 'MC3', 'Misc.', '0.01', 0, '0.025', 'AIMS/INT/CC/20/0094', '30328554', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-11-02', 1, '2016-11-01', '2020-11-16', NULL, NULL, NULL),
(151, 'Digital Clamp Meter', 'E-005', 5, 0, 'Fluke', '352', '2000 Amps', '0.01', 0, '0.05', 'AIMS/INT/CC/20/0011', '25730031', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-06', 1, '2016-11-20', '2020-02-20', NULL, NULL, NULL),
(152, 'Digital Multimeter', 'E-007', 5, 28, 'Fluke', '179', '1000V, 10Amp, 10Mohm', '0.001', 0, '0.05', 'AIMS/INT/CC/20/0081', '25350026', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-09-23', 1, '2016-11-20', '2020-09-21', NULL, NULL, '2020-12-11 11:50:26'),
(153, 'DC Volt Power Supply', 'E-008', 5, 0, 'XANTREX', 'XHR 100-6', '100 V, 6 Amps', '0.01', 0, '0.05', 'AIMS/INT/CC/20/0064', '64525', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-04-23', 1, '2017-05-01', '2020-04-24', NULL, NULL, NULL),
(154, 'HART Communicator', 'E-009', 5, 0, 'Emerson', '475', '4 to 20 mAmps', '0.01', 0, '0.05', 'AIMS/INT/CC/20/0085', '11138665', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-09-23', 1, '2016-11-20', '2020-09-24', NULL, NULL, NULL),
(155, 'Loop Calibrator', 'E-010', 5, 0, 'Druck', 'UPS II', '30 V, 24 mAmps', '0.01', 0, '0.05', 'AIMS/INT/CC/19/0084', '--', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-12-28', 1, '2016-11-20', '2019-12-30', NULL, NULL, NULL),
(156, 'Decade Resistance Box', 'E-011', 5, 0, 'ED Laboratory', 'RU-610A', '100 kOhm', '0.0001', 0, '0.05', '20081513', 'E00000 071356', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-08-10', 1, '2019-10-10', '2020-08-11', NULL, NULL, NULL),
(157, 'Decade Inductance Box', 'E-012', 5, 0, 'Genetron', 'DIB-14', '10 H', '0.0001', 0, '0.25', 'TCSL-20-2717', 'NIL', 'NPL UK', 'AIMS Cal Lab 1', 'default.jpg', '2021-09-11', 1, '2016-11-01', '2020-09-12', NULL, NULL, NULL),
(158, 'Milli Ohm Meter', 'E-014', 5, 0, 'HOIKI', '3227', '300 Ohm', '0.00001', 0, '0.25', 'AIMS/INT/CC/19/0062', '30312447', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-09-25', 1, '2016-11-01', '2019-09-26', NULL, NULL, NULL),
(159, 'Earth Hi Tester Analogue', 'E-015', 5, 0, 'HOIKI', '3151', '1150 Ohm', '0.01', 0, '0.25', 'AIMS/INT/CC/20/0036', '20601414', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2019-04-09', 1, '2017-04-15', '2020-04-07', NULL, NULL, NULL),
(160, 'Digital Stop Watch', 'E-016', 29, 27, 'Casio', 'HS-80TW', '86400 S', '0.0001', 0, '0.025', '20/000898', '512Q03R', 'PTB Germany', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-08', 1, '2016-11-20', '2020-03-09', NULL, NULL, '2020-12-11 11:48:58'),
(161, 'Insulation Resistance Tester', 'E-020', 5, 0, 'Kyoritsu', '3005A', '10 Gohm', '0.001', 0, '0.05', 'AIMS/INT/CC/20/0071', '1392283', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-08-17', 1, '2017-01-07', '2020-08-17', NULL, NULL, NULL),
(162, 'Hi Volt Multimeter', 'E-021', 5, 28, 'Vitrek Corp.', '4700', '10 kV', '0.0001', 0, '0.05', '2020DW02330064', '25316', 'NIM China', 'AIMS Cal Lab 1', 'default.jpg', '2021-04-15', 1, '2017-05-25', '2020-05-19', NULL, NULL, '2020-12-11 11:50:26'),
(163, 'Precision High Voltage Divider', 'E-022', 5, 0, 'Vitrek Corp.', 'HVL-150', '150 kV', '0.001', 0, '0.05', '2020DW02330101', '25317', 'NIM China', 'AIMS Cal Lab 1', 'default.jpg', '2021-04-15', 1, '2017-05-25', '2020-05-19', NULL, NULL, NULL),
(164, 'Digital Multimeter', 'E-025', 5, 28, 'Extech', '560A', '1000V, 10Amp, 10Mhm', '0.0001', 0, '0.5', 'AIMS/INT/CC/20/0059', '161030226', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-06-30', 1, '2017-06-30', '2020-06-22', NULL, NULL, '2020-12-11 11:50:26'),
(165, 'Digital Stop Watch', 'E-026', 29, 27, 'Casio', 'HS-80TW', '86400 S', '0.0001', 0, '0.025', '20/000899', '709Q04R', 'PTB Germany', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-08', 1, '2018-03-29', '2020-03-09', NULL, NULL, '2020-12-11 11:48:58'),
(166, 'Digital Stop Watch', 'E-027', 29, 27, 'Casio', 'HS-80TW', '86400 S', '0.0001', 0, '0.025', '20/000897', '709Q11R', 'PTB Germany', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-08', 1, '2018-03-29', '2020-03-09', NULL, NULL, '2020-12-11 11:48:58'),
(167, 'Function Generator', 'E-028', 5, 0, 'Rigol', 'DG1022Y', '25 MHz', '0.000001', 0, '0.025', '1903519', 'DG1D200100062', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-25', 1, '2018-08-02', '2019-03-28', NULL, NULL, NULL),
(168, 'Frequency Counter', 'E-029', 5, 0, 'BK Precision', '1856D', '3.5 GHz', '0.0000001', 0, '0.025', '1903520', '332E18196', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-03-25', 1, '2018-11-10', '2019-03-28', NULL, NULL, NULL),
(169, 'Process Calibrator', 'E-031', 5, 0, 'Beamax', 'MC3', '20 mAmp', '0.1', 0, '1', '20101912', '30328397', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-10-14', 1, '2020-08-15', '2020-10-15', NULL, NULL, NULL),
(170, 'Soud Level Calibrator', 'ITS-001', 26, 0, 'Quest', 'QC-10', '114 dB', '0.01', 0, '0.025', '20/001998', 'QIB070167', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2021-09-01', 1, '2016-11-20', '2020-09-05', NULL, NULL, NULL),
(171, 'Sound Level Meter', 'ITS-002', 26, 0, 'Quest', '2200', '150 dB', '0.01', 0, '0.25', 'AIMS/INT/CC/20/0052', 'KOB070015', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2021-06-18', 1, '2016-11-20', '2020-06-15', NULL, NULL, NULL),
(172, 'Digital Techometer', 'ITS-003', 21, 29, 'PROVA', 'RM-1500', '99999 RPM', '0.1', 0, '0.01', 'AIMS/INT/CC/20/0053', '16200228', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-06-18', 1, '2016-11-20', '2020-06-15', NULL, NULL, '2020-12-11 11:59:23'),
(173, 'Digital Anemometer', 'ITS-004', 7, 0, 'PROVA', 'AVM-05', '100 m/S', '0.01', 0, '0.25', '20/002001', '15080820', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2021-09-03', 1, '2016-11-20', '2020-09-05', NULL, NULL, NULL),
(174, 'Lux Meter', 'ITS-005', 10, 30, 'Smart Sensor', 'AR813A', '10000 Lux', '1', 0, '1', '20/001997', '624884', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2021-09-03', 1, '2018-09-10', '2020-09-05', NULL, NULL, '2020-12-11 12:02:21'),
(175, 'Digital Guass Meter', 'ITS-006', 15, 0, 'TES', '1393', '2.0 G', '0.0001', 0, '1', '171030.6.7', '150507045', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2022-10-01', 1, '2016-11-01', '2020-10-03', NULL, NULL, NULL),
(176, 'Vibration Meter', 'ITS-007', 32, 0, 'Lutron', 'VB-8200', '200 m/S', '0.1 m/S', 0, '1', '171030.6.8', 'Q554177', 'PTB Germany', 'AIMS Cal Lab 1', 'default.jpg', '2022-10-25', 1, '2016-11-01', '2017-10-30', NULL, NULL, NULL),
(177, 'Hardness Test Block', 'ITS-008', 9, 0, 'NWR', 'MPA', '44 HRC', '0.1 HRC', 0, '1', '171030.6.9', 'AO92703260', 'NPL UK', 'AIMS Cal Lab 1', 'default.jpg', '2022-10-25', 1, '2016-11-01', '2017-10-29', NULL, NULL, NULL),
(178, 'pH Buffer Solutions', 'ITS-009', 18, 0, 'HANNA', 'HI70004C HI70007C HI70010C', '4.01 7.01 10.01', '0.01', 0, '0.01', 'COA', '1036                       0253                   3848', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '0000-00-00', '1900-01-01', NULL, NULL, NULL),
(179, 'Conductivity Solution', 'ITS-010', 1, 0, 'HANNA', 'HI7033L HI70031CHI70030C', '84uS/cm 1413uS/cm 12880uS/cm', '1 uS/cm 5uS/cm 50uS/cm', 0, '1 5 50', 'COA', '3591                   3276                       9782', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '0000-00-00', '1900-01-01', NULL, NULL, NULL),
(180, 'Spectronic Standard Kit', 'ITS-011', 19, 0, 'EMC Lab', '666-S095', '254~635 nm', '0.1 nm', 0, '0.1', 'CC004889', 'H12N22N32N42', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2022-10-09', 1, '2017-03-31', '2017-10-23', NULL, NULL, NULL),
(181, 'Viscosity Standard Solution', 'ITS-012', 11, 0, 'Paragon Scientific', 'S200 N44 N1000', '566.0 cP 92.04cP 4069cP', '0.01', 0, '0.1', '---', 'NIL', 'NPL UK', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '0000-00-00', '1900-01-01', NULL, NULL, NULL),
(182, 'Zero Oxygen Solution', 'ITS-013', 4, 0, 'HANNA', 'HI7040L', '0', '0.1', 0, '0.1', '7', 'S0057/17', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '2020-01-15', '1900-01-01', NULL, NULL, NULL),
(183, 'Caffine Standard Substance', 'ITS-014', 19, 0, 'edQm', 'Y0000787', '275 nm', '1', 0, '1', '200-362-1', 'NIL', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '2017-10-15', '1900-01-01', NULL, NULL, NULL),
(184, 'Turbidity Solution', 'ITS-015', 30, 0, 'HANNA', 'HI93703-10', '10 FTU', '0.01', 0, '0.2', 'Consumed', '7636                   7572                        7109', 'Consumed', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '0000-00-00', '1900-01-01', NULL, NULL, NULL),
(185, 'Anemometer Hot Wire', 'ITS-016', 7, 0, 'Benetech', 'GM8903', '30 m/S', '0.001', 0, '0.005', '20/002000', 'GC-2339018', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2021-09-20', 1, '2018-03-10', '2020-09-05', NULL, NULL, NULL),
(186, 'Nitrogen Dioxyide NO2', 'ITS-017', 8, 0, 'Bristol Gases', '90837', '500 ppm', 'NR', 0, '2', 'Consumed', 'C829405', 'Consumed', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '2018-03-11', '1900-01-01', NULL, NULL, NULL),
(187, 'Multi Gas Mixture', 'ITS-018', 8, 0, 'Bristol Gases', 'Multi Gas', '25ppm, 100ppm, 50%, 18%', 'NR', 0, '5', 'B230419-B6', 'C837460', 'UAE', 'AIMS Cal Lab 1', 'default.jpg', '2021-02-03', 1, '2019-04-30', '2019-04-23', NULL, NULL, NULL),
(188, 'Carbon Dioxide CO2', 'ITS-019', 8, 0, 'Bristol Gases', 'NRCBG-0451', '100 ppm', 'NR', 0, '2', 'B261117-D1', 'CG15040', 'UAE', 'AIMS Cal Lab 1', 'default.jpg', '2020-11-16', 1, '2018-03-11', '2017-11-26', NULL, NULL, NULL),
(189, '100 ppm Nitrogen Oxyide NO', 'ITS-020', 8, 0, 'Bristol Gases', 'NO', '100 ppm', 'NR', 0, '2', 'Consumed', 'C145176', 'Consumed', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '2018-03-11', '1900-01-01', NULL, NULL, NULL),
(190, '10 ppm Sulfur Dioxyide SO2', 'ITS-021', 8, 0, 'Bristol Gases', 'SO2', '10 ppm', 'NR', 0, '5', 'Consumed', 'C145132', 'Consumed', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '2018-03-11', '1900-01-01', NULL, NULL, NULL);
INSERT INTO `assets` (`id`, `name`, `code`, `parameter`, `group_id`, `make`, `model`, `range`, `resolution`, `status`, `accuracy`, `certificate_no`, `serial_no`, `traceability`, `location`, `image`, `due`, `calibration_interval`, `commissioned`, `calibration`, `deleted_at`, `created_at`, `updated_at`) VALUES
(191, 'Optical Tachometer', 'ITS-022', 21, 29, 'Lutron', 'DT-2234C', '99999 RPM', '1', 0, '1', 'AIMS/INT/CC/20/0047', 'S213344', 'PMEL,APF KAMRA', 'AIMS Cal Lab 1', 'default.jpg', '2021-04-23', 1, '2018-03-30', '2020-03-28', NULL, NULL, '2020-12-11 11:59:23'),
(192, 'Lux Level Meter', 'ITS-024', 10, 30, 'Scichem Tech', 'SCT-Lucky', '10000', '1', 0, '1', 'AIMS/INT/CC/20/0086', '11541', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2020-08-27', 1, '2018-05-04', '2020-08-27', NULL, NULL, '2020-12-11 12:02:21'),
(193, 'UV-Visible Spectrometer', 'ITS-025', 19, 0, 'Rayleigh', 'UV-2601', '635 nm', '1', 0, '1', 'AIMS/INT/CC/20/0037', '14400403', 'NIST, USA', 'AIMS Cal Lab 1', 'default.jpg', '2021-04-13', 1, '2018-03-30', '2020-04-10', NULL, NULL, NULL),
(194, 'Foil Set Scale', 'ITS-026', 3, 0, 'Elecometer', 'T99022255-1', '1500 um', 'NR', 0, '1', '18040831', '-', 'DCL Dubai', 'AIMS Cal Lab 1', 'default.jpg', '2021-04-26', 1, '2019-05-04', '2019-04-27', NULL, NULL, NULL),
(195, 'pH/Conductivity Meter', 'ITS-028', 18, 0, 'NALCO', 'PC 450', '14 pH, 12880 uS/cm', '1', 0, '1', 'AIMS/INT/CC/20/0091', '2531024', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2020-08-03', 1, '2019-07-20', '2020-10-20', NULL, NULL, NULL),
(196, 'UV Light Meter', 'ITS-029', 10, 0, 'Extech', 'UV510', '20 mW/cm2', '0.01', 0, '1', '20/002003', 'Q009005', 'NIST USA', 'AIMS Cal Lab 1', 'default.jpg', '2020-09-05', 1, '2019-09-17', '2020-09-05', NULL, NULL, NULL),
(197, 'Tachometer Optical', 'ITS-030', 21, 29, 'Lutron', 'DT-2234C', '99999', '1', 0, '1', 'AIMS/INT/CC/20/0088', 'S259880', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-11-18', 1, '2019-11-11', '2020-10-22', NULL, NULL, '2020-12-11 11:59:23'),
(198, 'Tachometer Optical', 'ITS-031', 21, 29, 'Lutron', 'DT-2234C', '99999', '1', 0, '1', 'AIMS/INT/CC/20/0089', 'S268456', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2020-11-18', 1, '2019-11-11', '2020-10-22', NULL, NULL, '2020-12-11 11:59:23'),
(199, 'Calcium Chloride', 'ITS-035', 19, 0, 'Riedel-deHan', '2Hydrate', '1000 ppm', 'NR', 0, '1', '-', '29574', '-', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL),
(200, 'Potassium Chloride', 'ITS-036', 19, 0, 'Sigma Aldrich', 'RTECS', '1000 ppm', 'NR', 0, '1', '-', 'TS8050000', '-', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL),
(201, 'Sodium Chloride', 'ITS-037', 19, 0, 'Sigma Aldrich', '13423', '1000 ppm', 'NR', 0, '1', '-', '80650', '-', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL),
(202, 'Volume Cylinder', 'V-001', 31, 32, 'Borosilicate', '2000', '2000 ml', '20', 0, '1', 'AIMS/INT/CC/20/0076', 'NIL', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-09-02', 1, '2017-01-21', '2020-09-04', NULL, NULL, '2020-12-11 12:05:28'),
(203, 'Volume Cylinder', 'V-002', 31, 32, 'Pyrex Iwaki', '1000', '1000 ml', '10', 0, '1', 'AIMS/INT/CC/19/0044', 'NIL', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2020-07-22', 1, '2017-01-21', '2019-07-23', NULL, NULL, '2020-12-11 12:05:28'),
(204, 'Volume Proving Tank', 'V-028', 31, 31, 'Pakistan', '50', '50 Liter', '0.0012', 0, '0.01', 'AIMS/INT/CC/20/0050', 'NIL', 'DCL, Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-06-01', 1, '2018-03-15', '2020-06-02', NULL, NULL, '2020-12-11 12:04:30'),
(205, 'Volume Proving Tank', 'V-029', 31, 31, 'Pakistan', '20', '20 Liter', '0.001', 0, '1', 'AIMS/INT/CC/20/0030', 'NIL', 'DCL, Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-03-31', 1, '2018-08-08', '2020-04-01', NULL, NULL, '2020-12-11 12:04:30'),
(206, 'Ultrasonic Flow Meter', 'V-030', 7, 0, 'GFlow', 'TDS 100F', '100000 Liter/Hour', '0.01', 0, '2', 'MSL-Cert-Intl/19/00756', '16090110', 'UME Turkey', 'AIMS Cal Lab 2', 'default.jpg', '2021-12-10', 1, '2018-09-10', '2019-12-11', NULL, NULL, NULL),
(207, 'Rota Flow Meter', 'V-031', 7, 0, 'Dwyer', 'VFA-6-BV', '30 SCFH', '0.5', 0, '1', '18040830', 'T328', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2021-04-26', 1, '2019-05-04', '2019-04-27', NULL, NULL, NULL),
(208, 'Rota Flow Meter', 'V-074', 7, 0, 'SHO-RATE', '1335', '10 LPM', '0.01', 0, '1', '18040830', 'T328', 'DCL Dubai', 'AIMS Cal Lab 2', 'default.jpg', '2022-03-22', 1, '2019-05-04', '2019-04-27', NULL, NULL, NULL),
(209, 'Electrical Safety Analyzer', 'ME-001', 35, 0, 'Bio-Tek', '601 PRO', '250 Volt', '0.1', 0, '1', 'AIMS/INT/CC/20/0048-A', 'ISA601PROUKPK', 'CAC China', 'AIMS Cal Lab 1', 'default.jpg', '2021-01-31', 1, '2019-05-30', '2020-05-28', NULL, NULL, NULL),
(210, 'Ultrasonic Thickness Gauge', 'ND-001', 33, 0, 'K & M', 'KT-500 DL', '100 mm', '0.01', 0, '0.1', '-', '-', '-', '-', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL),
(211, 'Coating Thickness Meter', 'ND-002', 33, 0, 'DeFlesko', 'Positector200', '1000 um', '1', 0, '1', '-', '-', '-', '-', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL),
(212, 'AC Contour Probe', 'ND-003', 33, 0, 'Parker Research Corp.', 'B 300', '10 kg', 'NR', 0, '1', '-', '-', '-', '-', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL),
(213, 'Humidity Chamber', 'HUM-002', 23, 0, 'PCSIR CDLE', 'HDC-L72/18', '90%', '0.1', 0, '2', '-', '-', '-', 'lab1', 'default.jpg', '1901-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, '2021-01-22 15:35:07'),
(214, 'Tacho Generator', 'ITS-005', 21, 0, 'PUMA', '10000', '10000 RPM', '1', 0, '1', '-', '-', '-', 'AIMS Cal Lab 1', 'default.jpg', '1900-01-01', 1, '1900-01-01', '1900-01-01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assetspecifications`
--

CREATE TABLE `assetspecifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `leave_id` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `check_in_date`, `check_out_date`, `check_in`, `check_out`, `day`, `status`, `leave_id`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 1, '2021-02-05', '2021-02-06', '10:24:04', '10:25:22', 'Sat', 1, NULL, 'Present manual marked by user', '2021-02-06 05:24:04', '2021-02-06 05:25:22'),
(3, 1, '2021-02-06', '2021-02-06', '10:25:30', '10:26:20', 'Sat', 1, NULL, 'Present manual marked by user', '2021-02-06 05:25:30', '2021-02-06 05:26:20'),
(4, 1, '2021-02-08', '2021-02-08', '20:40:49', '20:40:54', 'Mon', 1, NULL, 'Present manual marked by user', '2021-02-08 15:40:49', '2021-02-08 15:40:54'),
(5, 1, '2021-02-18', '2021-02-26', '09:13:38', '09:30:33', 'Thu', 1, NULL, 'Present manual marked by user', '2021-02-18 04:13:38', '2021-02-26 04:30:33'),
(6, 1, '2021-02-26', '2021-02-26', '09:30:40', '09:30:46', 'Fri', 1, NULL, 'Present manual marked by user', '2021-02-26 04:30:40', '2021-02-26 04:30:46'),
(7, 1, '2021-03-22', '2021-03-22', '11:48:41', '18:06:48', 'Mon', 1, NULL, 'Present manual marked by user', '2021-03-22 06:48:41', '2021-03-22 13:06:48'),
(8, 1, '2021-03-24', '2021-03-24', '10:26:57', '14:06:15', 'Wed', 1, NULL, 'Present manual marked by user', '2021-03-24 05:26:57', '2021-03-24 09:06:15'),
(9, 1, '2021-03-26', '2021-03-26', '16:19:38', '16:19:45', 'Fri', 1, NULL, 'Present manual marked by user', '2021-03-26 11:19:38', '2021-03-26 11:19:45'),
(10, 1, '2021-04-02', '2021-04-10', '15:43:14', '10:17:26', 'Fri', 1, NULL, 'Present manual marked by user', '2021-04-02 10:43:14', '2021-04-10 05:17:26'),
(11, 1, '2021-04-10', '2021-04-10', '05:26:23', '10:34:51', 'Sat', 1, NULL, 'Present manual marked by user', '2021-04-10 05:17:42', '2021-04-10 05:34:51'),
(12, 1, '2021-04-12', '2021-04-12', '13:11:15', '13:11:22', 'Mon', 1, NULL, 'Present manual marked by user', '2021-04-12 08:11:15', '2021-04-12 08:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `balancedataentries`
--

CREATE TABLE `balancedataentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_mass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calculatorentries`
--

CREATE TABLE `calculatorentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `start_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_humidity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_humidity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `before_offset` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `after_offset` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_atmospheric_pressure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_atmospheric_pressure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repeatability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuc_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calibrated_by` int(11) DEFAULT NULL,
  `tolerance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_values` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_values` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reproducibility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `baseline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_parallelism` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zero_error` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measuring_faces` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuc_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calculatorentries`
--

INSERT INTO `calculatorentries` (`id`, `job_type_id`, `asset_id`, `start_temp`, `end_temp`, `start_humidity`, `end_humidity`, `location`, `fixed_type`, `before_offset`, `after_offset`, `start_atmospheric_pressure`, `end_atmospheric_pressure`, `pan_position`, `repeatability`, `uuc_temp`, `ref_temp`, `calibrated_by`, `tolerance`, `class`, `balance_id`, `balance_values`, `temp_id`, `temp_values`, `noise`, `reproducibility`, `stability`, `baseline`, `anti_parallelism`, `zero_error`, `measuring_faces`, `uuc_type`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, '30', '31', '40', '41', 'Lab 01', NULL, '1', '0', NULL, NULL, NULL, NULL, '23,24', '25,26', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"vernier_jaw\":\"29\",\"between_1\":\"29.5\",\"center\":\"29.9\",\"between_2\":\"30.4\",\"fixed_jaw\":\"30\"}', '0,0', NULL, 'digital', '2021-04-02 03:34:46', '2021-04-02 03:34:46'),
(2, 9, NULL, '39', '40', '40', '41', 'Lab 01', NULL, '0', '1', NULL, NULL, NULL, NULL, '0.4,0.5', '0.3,0.3', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0,1', '{\"p_spindle\":\"0.2\",\"p_anvil\":\"0.1\",\"f_spindle\":\"0.4\",\"f_anvil\":\"0.3\"}', 'digital', '2021-04-09 05:21:56', '2021-04-09 05:21:56'),
(3, 10, NULL, '30', '31', '40', '41', 'Lab 03', NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-09 12:06:01', '2021-04-09 12:06:01'),
(4, 1, NULL, '24', '25', '30', '31', 'Lab 04', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-10 12:36:50', '2021-04-10 12:36:50'),
(5, 11, NULL, '30', '31', '40', '41', 'Lab 03', 'UUC', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-10 12:48:17', '2021-04-10 12:56:43'),
(6, 2, NULL, '30', '40', '40', '41', 'Lab 01', NULL, '0', '0', '30', '32', '{\"center1\":\"5\",\"center2\":\"5\",\"front\":\"5\",\"left\":\"5\",\"right\":\"5\",\"weight\":\"5\",\"rare\":\"5\"}', '100,100,100,100,100,100,100,100,100,100', '0.5,0.5,0.5', '0.5,0.5,0.5', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-10 13:04:58', '2021-04-10 13:04:58'),
(7, 3, NULL, '30', '31', '40', '41', 'Lab 02', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-11 05:50:23', '2021-04-11 05:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

CREATE TABLE `capabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter` int(11) NOT NULL,
  `procedure` int(11) NOT NULL,
  `calculator` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT 'general-calculator',
  `range` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `accuracy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accredited` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`id`, `name`, `parameter`, `procedure`, `calculator`, `range`, `price`, `accuracy`, `unit`, `remarks`, `location`, `accredited`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Conductivity Meter', 1, 1, 'balance-calculator', '84~12880', 4000, '0.1', '5', 'NA', 'site', 'yes', NULL, NULL, '2021-02-17 10:19:26'),
(2, 'TDS Meter', 1, 1, 'general-calculator', '1380', 4000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(3, 'Metal Conductivity', 1, 1, 'general-calculator', '10~110', 4000, '0.1', '% IACS', 'NA', 'lab', 'no', NULL, NULL, NULL),
(4, 'Iron Meter', 1, 1, 'general-calculator', '10~110', 4000, '0.1', '% IACS', 'NA', 'site', 'no', NULL, NULL, NULL),
(5, 'Tap Density', 2, 1, 'general-calculator', '1~1000', 2000, '0.1', 'No', 'NA', 'lab', 'no', NULL, NULL, NULL),
(6, 'Colony Count', 2, 1, 'general-calculator', '1~1000', 2000, '0.1', 'No', 'NA', 'site', 'no', NULL, NULL, NULL),
(7, 'Lea Winder Yarn', 2, 1, 'general-calculator', '1~1000', 2000, '0.1', 'No', 'NA', 'lab', 'no', NULL, NULL, NULL),
(8, 'Black  Board Winder', 2, 1, 'general-calculator', '1~1000', 2000, '0.1', 'No', 'NA', 'site', 'no', NULL, NULL, NULL),
(9, 'Needle Detecting Machine', 2, 1, 'general-calculator', '1~1000', 2000, '0.1', 'No', 'NA', 'lab', 'no', NULL, NULL, NULL),
(10, 'Bar Code Scanner', 2, 1, 'general-calculator', '1~1000', 2000, '0.1', 'No', 'NA', 'site', 'no', NULL, NULL, NULL),
(11, 'Steel Rule 12 Inch', 3, 1, 'general-calculator', '0~300', 800, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(12, 'Steel Rule 24 Inch', 3, 1, 'general-calculator', '0~600', 1000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(13, 'Steel Rule 39 Inch', 3, 1, 'general-calculator', '0~1000', 1250, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(14, 'Measuring Tape 5 Meter', 3, 1, 'general-calculator', '0~500', 1000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(15, 'Measuring Tape 30 Meter', 3, 1, 'general-calculator', '0~3000', 2000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(16, 'Venier Caliper', 3, 1, 'general-calculator', '0~300', 2000, '0.1', 'mm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(17, 'Venier Caliper', 3, 1, 'general-calculator', '0~600', 4000, '0.1', 'mm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(18, 'Venier Caliper', 3, 20, 'vernier-caliper-calculator', '0~1000', 6000, '0.1', '52', 'NA', 'site', 'yes', NULL, NULL, '2021-04-09 04:50:21'),
(19, 'Depth Gauge', 3, 1, 'general-calculator', '0~300', 2000, '0.1', 'mm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(20, 'Height Gauge', 3, 1, 'general-calculator', '0~500', 4000, '0.1', 'mm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(21, 'Outside Micrometer', 3, 1, 'general-calculator', '0~25', 2500, '0.1', 'mm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(22, 'Outside Micrometer', 3, 1, 'general-calculator', '25~50', 3000, '0.1', 'mm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(23, 'Outside Micrometer with Setting Rods', 3, 1, 'general-calculator', '0~300', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(24, 'Outside Micrometer with Setting Rods', 3, 1, 'general-calculator', '0~600', 7500, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(25, 'Inside Micrometer', 3, 1, 'micrometer-calculator', '10~25', 2500, '0.1', '52', 'NA', 'lab', 'no', NULL, NULL, '2021-04-09 09:57:27'),
(26, 'Inside Micrometer with Setting Rods', 3, 1, 'general-calculator', '25~300', 4000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(27, 'Dial Indicator', 3, 1, 'general-calculator', '0~50', 2500, '0.1', 'mm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(28, 'Feeler Gauges', 3, 1, 'general-calculator', '0.5~2.0', 2500, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(29, 'Bevel Protractor', 3, 1, 'general-calculator', '0~90', 2500, '0.1', 'Deg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(30, 'Bubble Level', 3, 1, 'general-calculator', '0~2', 2000, '0.1', '\"', 'NA', 'site', 'no', NULL, NULL, NULL),
(31, 'Ultrasonic Thickness Meter', 3, 1, 'general-calculator', '0~50', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(32, 'Coating Thickness Gauge', 3, 1, 'general-calculator', '0~10', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(33, 'GSM Cutter ', 3, 1, 'general-calculator', '112.7', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(34, 'Tensile Strength Cutting Template Length & Width', 3, 1, 'general-calculator', '250 x 100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(35, 'Sizing Template', 3, 1, 'general-calculator', '100~610', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(36, 'Pick Glass', 3, 1, 'general-calculator', '1', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(37, 'Dip Rod', 3, 1, 'general-calculator', '50~300', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(38, 'Sieves Hole Size', 3, 1, 'general-calculator', '0.15~1.8', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(39, 'Radius Gauge', 3, 1, 'general-calculator', '25', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(40, 'Web Deflection Gauge', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(41, 'Weld Pit Gauge', 3, 1, 'general-calculator', '', 3000, '0.1', '', 'NA', 'lab', 'no', NULL, NULL, NULL),
(42, 'Surface Profile Gauge', 3, 1, 'general-calculator', '1', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(43, 'Thickness Gauges', 3, 1, 'general-calculator', '10', 3000, '0.1', 'mm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(44, 'GSM Cutting Plate Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(45, 'GSM Cutting Plate Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(46, 'Trouser Shaped Cutting Template Length', 3, 1, 'general-calculator', '200', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(47, 'Trouser Shaped Cutting Template Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(48, 'Trouser Shaped Cutting Template Tear Cutt Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(49, 'Dimensional Stability Template Length', 3, 1, 'general-calculator', '24', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(50, 'Dimensional Stability Template Width', 3, 1, 'general-calculator', '24', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(51, 'Shrinkage Template Cut to Cut Length', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(52, 'Shrinkage Template Length', 3, 1, 'general-calculator', '500', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(53, 'Shrinkage Template Width', 3, 1, 'general-calculator', '500', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(54, 'Shrinkage Template Shrink', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(55, 'Shrinkage Template Stretch', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(56, 'Template For ISO Color Fastness Length', 3, 1, 'general-calculator', '118', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(57, 'Template For ISO Color Fastness Width', 3, 1, 'general-calculator', '65', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(58, 'Chlorine Senstivity Template Length', 3, 1, 'general-calculator', '10', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(59, 'Chlorine Senstivity Template Width', 3, 1, 'general-calculator', '10', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(60, 'Template For ISO Color Fastness Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(61, 'Template For ISO Color Fastness width', 3, 1, 'general-calculator', '40', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(62, 'Acrylic Template Index to 100', 3, 1, 'general-calculator', '100', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(63, 'Acrylic Template Index to 152.5', 3, 1, 'general-calculator', '152.5', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(64, 'Template For Torque Cut to Cut Length', 3, 1, 'general-calculator', '10', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(65, 'Template For Torque  Length', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(66, 'Template For Torque  Width', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(67, 'Template Of Tear Length', 3, 1, 'general-calculator', '10', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(68, 'Template Of Tear Width', 3, 1, 'general-calculator', '6.3', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(69, 'Template For Washing Length', 3, 1, 'general-calculator', '15', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(70, 'Template For Washing Width', 3, 1, 'general-calculator', '5', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(71, 'Template Plastic Ici Pilling Length', 3, 1, 'general-calculator', '125', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(72, 'Template Plastic Ici Pilling Width', 3, 1, 'general-calculator', '125', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(73, 'Seam Slippage Template Cut to Cut Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(74, 'Seam Slippage Template Length', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(75, 'Seam Slippage Template Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(76, 'Template Of Water Repllonoy Length', 3, 1, 'general-calculator', '8', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(77, 'Template Of Water Repllonoy Width', 3, 1, 'general-calculator', '8', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(78, 'Template Of Spray Tester Length', 3, 1, 'general-calculator', '7', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(79, 'Template Of Spray Tester Width', 3, 1, 'general-calculator', '7', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(80, 'Template Of Soil Release Length', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(81, 'Template Of Soil Release Width', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(82, 'Template Of Tensile Length', 3, 1, 'general-calculator', '150', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(83, 'Template Of Tensile Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(84, 'Template of Change In Skewness Length', 3, 1, 'general-calculator', '26', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(85, 'Template of Change In Skewness Width', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(86, 'Acrylic Template Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(87, 'Acrylic Template Width', 3, 1, 'general-calculator', '20', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(88, 'Acrylic Template Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(89, 'Acrylic Template Width', 3, 1, 'general-calculator', '25', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(90, 'Shrinkage Template Cut to Cut Length', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(91, 'Shrinkage Template Length', 3, 1, 'general-calculator', '500', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(92, 'Shrinkage Template Width', 3, 1, 'general-calculator', '500', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(93, 'Shrinkage Template Length', 3, 1, 'general-calculator', '24', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(94, 'Shrinkage Template Width', 3, 1, 'general-calculator', '24', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(95, 'Tensile Template Length', 3, 1, 'general-calculator', '8', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(96, 'Tensile Template Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(97, 'Tear Template Length', 3, 1, 'general-calculator', '75', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(98, 'Tear Template Width', 3, 1, 'general-calculator', '102', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(99, 'Tear Template Slit Width', 3, 1, 'general-calculator', '12', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(100, 'Tear Template Slit Height', 3, 1, 'general-calculator', '12', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(101, 'AATCC Shrinkage Template Shrinkage', 3, 1, 'general-calculator', '18', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(102, 'AATCC Shrinkage Template Stretch', 3, 1, 'general-calculator', '18', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(103, 'Shrinkage Template Shrinkage', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(104, 'Shrinkage Template Stretch', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(105, 'Tensile Template Length', 3, 1, 'general-calculator', '6', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(106, 'Tensile Template Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(107, 'Shrinkage Template Length', 3, 1, 'general-calculator', '24', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(108, 'Shrinkage Template Width', 3, 1, 'general-calculator', '27', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(109, 'Shrinkage Template Length', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(110, 'Shrinkage Template Width', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(111, 'Tensile Specimen Template Length', 3, 1, 'general-calculator', '6', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(112, 'Tensile Specimen Template Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(113, 'Tear Template Length', 3, 1, 'general-calculator', '102', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(114, 'Tear Template Width', 3, 1, 'general-calculator', '76', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(115, 'Tensile Specimen Template Length', 3, 1, 'general-calculator', '6', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(116, 'Tensile Specimen Template Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(117, 'Template Length', 3, 1, 'general-calculator', '5', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(118, 'Template Width', 3, 1, 'general-calculator', '5', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(119, 'Skew Change Template Length', 3, 1, 'general-calculator', '250', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(120, 'Skew Change Template Width', 3, 1, 'general-calculator', '250', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(121, 'Tensile Specimen Template Length', 3, 1, 'general-calculator', '8', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(122, 'Tensile Specimen Template Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(123, 'Tumble Pilling Length', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(124, 'Tumble Pilling Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(125, 'Smoothness Template Length', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(126, 'Smoothness Template Width', 3, 1, 'general-calculator', '15', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(127, 'Stretch Recovery Template Length', 3, 1, 'general-calculator', '455', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(128, 'Stretch Recovery Template Width', 3, 1, 'general-calculator', '60', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(129, 'Template For Tear Length', 3, 1, 'general-calculator', '200', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(130, 'Template For Tear Width', 3, 1, 'general-calculator', '75', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(131, 'Template For Stiffness Length', 3, 1, 'general-calculator', '204', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(132, 'Template For Stiffness Width', 3, 1, 'general-calculator', '102', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(133, 'Template For Crocking Length', 3, 1, 'general-calculator', '150', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(134, 'Template For Crocking Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(135, 'Template For Tear Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(136, 'Template For Tear Width', 3, 1, 'general-calculator', '63', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(137, 'Template For Tensile Length', 3, 1, 'general-calculator', '150', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(138, 'Template For Tensile Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(139, 'Template For Laundring Length', 3, 1, 'general-calculator', '150', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(140, 'Template For Laundring Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(141, 'Template For Rubbing Length', 3, 1, 'general-calculator', '140', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(142, 'Template For Rubbing Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(143, 'Template For Ozone Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(144, 'Template For Ozone Width', 3, 1, 'general-calculator', '60', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(145, 'Template For Perspiration Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(146, 'Template For Perspiration Width', 3, 1, 'general-calculator', '40', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(147, 'Volume Rod', 3, 1, 'general-calculator', '0~72000', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(148, 'Torque Bar Short Length', 3, 1, 'general-calculator', '301', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(149, 'Abrasion Resistance Sample Cutter', 3, 1, 'general-calculator', '38', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(150, 'Puncture Resistance Press Knife Height', 3, 1, 'general-calculator', '32', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(151, 'Puncture Resistance Press Knife Diameter', 3, 1, 'general-calculator', '40', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(152, 'Crock Test Length', 3, 1, 'general-calculator', '190', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(153, 'Crock Test Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(154, 'Single Edge Tear Resistance Cutting Template Tear Cutt Length', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(155, 'Single Edge Tear Resistance Cutting Template Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(156, 'Single Edge Tear Resistance Cutting Template Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(157, 'Dextrity Rod Length', 3, 1, 'general-calculator', '40', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(158, 'Dextrity Rod Diameter', 3, 1, 'general-calculator', '5~11', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(159, 'Tensile Strength Length', 3, 1, 'general-calculator', '200', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(160, 'Tensile Strength Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(161, 'AATC Perspiration Length', 3, 1, 'general-calculator', '60', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(162, 'AATC Perspiration Width', 3, 1, 'general-calculator', '60', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(163, 'Control Sample Height (Step # 1)', 3, 1, 'general-calculator', '20', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(164, 'Control Sample Height (Step # 2)', 3, 1, 'general-calculator', '30', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(165, 'Control Sample Height (Step # 3)', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(166, 'Control Sample Diameter (Step # 1)', 3, 1, 'general-calculator', '40', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(167, 'Control Sample Diameter (Step # 2)', 3, 1, 'general-calculator', '75', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(168, 'Control Sample Diameter (Step # 3)', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(169, 'ID Gauge', 3, 1, 'general-calculator', '8~150', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(170, '3 Points Caliper', 3, 1, 'general-calculator', '5~10', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(171, '3 Points Caliper', 3, 1, 'general-calculator', '8~15', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(172, '3 Points Caliper', 3, 1, 'general-calculator', '13~26', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(173, 'ROD Gauge', 3, 1, 'general-calculator', '1~11', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(174, 'Drift', 3, 1, 'general-calculator', '2.225~2.785', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(175, 'Female Cap Gauge', 3, 1, 'general-calculator', '3.785', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(176, 'Female Cap Gauge', 3, 1, 'general-calculator', '4.657', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(177, 'Female Cap Gauge', 3, 1, 'general-calculator', '6.033', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(178, 'Single Tear Length', 3, 1, 'general-calculator', '200', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(179, 'Single Tear Width', 3, 1, 'general-calculator', '50', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(180, 'Single Tear Cut Points Length', 3, 1, 'general-calculator', '25~100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(181, 'Abrasion Sample Cutter Diameter', 3, 1, 'general-calculator', '37', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(182, 'Pilling Sample Cutter Diameter', 3, 1, 'general-calculator', '140', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(183, 'Shrinkage Scale Cut to Cut Length', 3, 1, 'general-calculator', '457', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(184, 'Shrinkage Scale Index to Center Length', 3, 1, 'general-calculator', '253', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(185, 'Shrinkage Scale Width', 3, 1, 'general-calculator', '78.7', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(186, 'Embroidery Wooden Frame', 3, 1, 'general-calculator', '6', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(187, 'Aluminum Spray Nozzle Length', 3, 17, 'general-calculator', '49', 3000, '0.1', '1', 'NA', 'lab', 'no', NULL, NULL, '2021-02-25 10:12:51'),
(188, 'Aluminum Spray Nozzle Diameter', 3, 1, 'general-calculator', '37', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(189, 'Aluminum Spray Nozzle Hole Size', 3, 1, 'general-calculator', '0.86', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(190, 'Square Set Long Side Length', 3, 1, 'general-calculator', '100~330', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(191, 'Square Set Sort Side Length', 3, 1, 'general-calculator', '100~290', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(192, 'Square Set Sort Side Angle', 3, 1, 'general-calculator', '10~180', 3000, '0.1', '?', 'NA', 'site', 'no', NULL, NULL, NULL),
(193, 'Shirnkage Ruler Cut to Cut Length', 3, 1, 'general-calculator', '350', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(194, 'Shirnkage Ruler Index to Center Length', 3, 1, 'general-calculator', '250', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(195, 'Shirnkage Ruler Width', 3, 1, 'general-calculator', '60', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(196, 'Sizzing Needle Length', 3, 1, 'general-calculator', '3.71', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(197, 'Sizzing Needle Diameter', 3, 1, 'general-calculator', '228.94', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(198, 'Seam Slippage Length', 3, 1, 'general-calculator', '400', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(199, 'Seam Slippage Width', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(200, 'Seam Slippage Length', 3, 1, 'general-calculator', '14', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(201, 'Seam Slippage Width', 3, 1, 'general-calculator', '4', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(202, 'C.F To Laundring Length', 3, 1, 'general-calculator', '6', 3000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(203, 'C.F To Laundring Width', 3, 1, 'general-calculator', '2', 3000, '0.1', 'inch', 'NA', 'lab', 'no', NULL, NULL, NULL),
(204, 'C.F to Water Perspiration Length', 3, 1, 'general-calculator', '100', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(205, 'C.F to Water Perspiration Width', 3, 1, 'general-calculator', '40', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(206, 'C.F to Crocking Length', 3, 1, 'general-calculator', '140', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(207, 'C.F to Crocking Width', 3, 15, 'incubator-calculator', '50', 3000, '0.1', '1', 'NA', 'lab', 'no', NULL, NULL, '2021-02-23 14:47:12'),
(208, 'C.F to Light Length', 3, 1, 'general-calculator', '120', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(209, 'C.F to Light Width', 3, 1, 'general-calculator', '70', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(210, 'Test Sieves (Hole Size)', 3, 1, 'general-calculator', '0.15~1.18', 3000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(211, 'Dial Gauge', 3, 21, 'dial-gauge-calculator', '1~10', 3000, '0.1', '49', 'NA', 'lab', 'yes', NULL, NULL, '2021-04-09 11:56:05'),
(212, 'Pick Counter', 3, 1, 'general-calculator', '128', 3000, '0.1', 'Thread/inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(213, 'Mixing Vessel', 3, 1, 'general-calculator', '0~72000', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(214, 'Digital Length Counter Meter', 3, 1, 'general-calculator', '0~100', 3000, '0.1', 'm', 'NA', 'site', 'no', NULL, NULL, NULL),
(215, 'Fabric Measuring and Inspection Machine', 3, 1, 'general-calculator', '0~500', 3000, '0.1', 'm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(216, 'GSM Cutter ', 3, 1, 'general-calculator', '112', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(217, 'Steel Rule', 3, 1, 'general-calculator', '30', 3000, '0.1', 'cm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(218, 'Steel Rule', 3, 1, 'general-calculator', '100', 3000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(219, 'Web Deflection Gauge', 3, 1, 'general-calculator', '0~3', 3000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(220, 'Bevel Protractor', 3, 1, 'general-calculator', '12~180', 3000, '0.1', '?', 'NA', 'site', 'no', NULL, NULL, NULL),
(221, 'Height Gauge', 3, 1, 'general-calculator', '0~600', 3000, '0.1', 'mm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(222, 'DO Meter', 4, 1, 'general-calculator', '0~20', 6000, '0.1', '%', 'NA', 'site', 'no', NULL, NULL, NULL),
(223, 'Voltmeter AC/DC', 5, 1, 'general-calculator', '0~1000', 1500, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(224, 'Hi Voltage Test Bench', 5, 1, 'general-calculator', '1~150', 15000, '0.1', 'kV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(225, 'Hi Voltage Stick', 5, 1, 'general-calculator', '1~150', 15000, '0.1', 'kV', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(226, 'Ampere Meter', 5, 1, 'general-calculator', '0~1100', 2000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(227, 'Resistance Meter', 5, 1, 'general-calculator', '0~10', 2500, '0.1', 'Mohm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(228, 'Resistance Box', 5, 1, 'general-calculator', '0~100', 2500, '0.1', 'K?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(229, 'Insulation Resistance Meter', 5, 1, 'general-calculator', '1~10000', 4500, '0.1', 'Mohm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(230, 'Insulation Resistor', 5, 1, 'general-calculator', '0~1000', 4500, '0.1', 'M?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(231, 'Capacitance Meter', 5, 1, 'general-calculator', '1~10000', 2500, '0.1', '?F', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(232, 'Capacitance Box', 5, 1, 'general-calculator', '0.0001~100', 2500, '0.1', '?F', 'NA', 'site', 'yes', NULL, NULL, NULL),
(233, 'Inductance Meter', 5, 1, 'general-calculator', '100~10000000', 3500, '0.1', '?H', 'NA', 'lab', 'no', NULL, NULL, NULL),
(234, 'Inductance Box', 5, 1, 'general-calculator', '0~1000', 3500, '0.1', '?H', 'NA', 'site', 'no', NULL, NULL, NULL),
(235, 'Frequency Counter', 5, 1, 'general-calculator', '0.001~3.5E9', 5000, '0.1', 'Hz', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(236, 'Frequency Generator', 5, 1, 'general-calculator', '0.001~3.5E9', 7500, '0.1', 'Hz', 'NA', 'site', 'yes', NULL, NULL, NULL),
(237, 'Power Meter/Analyzer', 5, 1, 'general-calculator', '100~20000', 3000, '0.1', 'W', 'NA', 'lab', 'no', NULL, NULL, NULL),
(238, 'Energy Meter/Analyzer', 5, 1, 'general-calculator', '0.1~200', 4000, '0.1', 'kWH', 'NA', 'site', 'no', NULL, NULL, NULL),
(239, 'Insulation Resistance Tester (@250V, 500V, 1000V)', 5, 1, 'general-calculator', '0~1000', 4000, '0.1', 'M?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(240, 'Oil Insulation Breakdown Tester', 5, 1, 'general-calculator', '0~80', 4000, '0.1', 'KV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(241, 'RTD Meter/Calibrator', 5, 1, 'general-calculator', '-200~850', 4000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(242, 'Thermocouple Meter/Calibrator', 5, 1, 'general-calculator', '-200~1600', 4000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(243, 'Temperature Controller', 5, 1, 'general-calculator', '-200~1600', 4000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(244, 'Turns Ratio Meter', 5, 1, 'general-calculator', '2.4~1000', 4000, '0.1', 'Ratio', 'NA', 'site', 'no', NULL, NULL, NULL),
(245, 'Mega Ohm Meter', 5, 1, 'general-calculator', '10~10000', 4000, '0.1', 'M?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(246, 'High Voltage Test Bench', 5, 1, 'general-calculator', '1~35', 4000, '0.1', 'kV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(247, 'Micro-Ohm Meter', 5, 1, 'general-calculator', '0.1~6000', 4000, '0.1', '?', 'NA', 'lab', 'no', NULL, NULL, NULL),
(248, 'Core Tester   (G Type, S Type)', 5, 1, 'general-calculator', '0.73~5.60', 4000, '0.1', 'W/Kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(249, 'Decade Resistance Box', 5, 1, 'general-calculator', '1~1000', 4000, '0.1', '?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(250, 'Non-Destructive Insulation Tester (DC Voltage)', 5, 1, 'general-calculator', '1~10', 4000, '0.1', 'kV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(251, 'AC High Voltage Source', 5, 1, 'general-calculator', '1~40', 4000, '0.1', 'kV', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(252, 'Di-Electric Oil Tester   (AC Voltage)', 5, 1, 'general-calculator', '1~30', 4000, '0.1', 'kV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(253, 'Insulation Testing Machine   (AC Voltage)', 5, 1, 'general-calculator', '1~20', 4000, '0.1', 'kV', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(254, 'Glove Testing Machine   (AC Voltage)', 5, 1, 'general-calculator', '1~20', 4000, '0.1', 'kV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(255, 'Grounding Resistance Measuring Instrument', 5, 1, 'general-calculator', '0~1000', 4000, '0.1', '?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(256, 'Insulation Tester', 5, 1, 'general-calculator', '10', 4000, '0.1', 'G?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(257, 'Oil Dielectric Test Set   (DC High Voltage)', 5, 1, 'general-calculator', '1~100', 4000, '0.1', 'kV', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(258, 'Breakdown Tester   (DC High Voltage)', 5, 1, 'general-calculator', '1~30', 4000, '0.1', 'kV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(259, 'Voltage Calibration Meter   (DC High Voltage)', 5, 1, 'general-calculator', '10~60', 4000, '0.1', 'kV', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(260, 'Spring Scales', 6, 1, 'general-calculator', '0.5~100', 3000, '0.1', 'kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(261, 'Force Gauges', 6, 1, 'general-calculator', '0.5~100', 3000, '0.1', 'kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(262, 'Load Cells', 6, 1, 'general-calculator', '0~300', 4500, '0.1', 'kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(263, 'Cable Tensio Meters', 6, 1, 'general-calculator', '0~500', 4500, '0.1', 'Lbs', 'NA', 'lab', 'no', NULL, NULL, NULL),
(264, 'Tensile Testing Machine', 6, 1, 'general-calculator', '0~5000', 8000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(265, 'Box Compression Tester', 6, 1, 'general-calculator', '0~1000', 8000, '0.1', 'kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(266, 'Compression Strength Testing Machine', 6, 1, 'balance-calculator', '0~1500', 15000, '0.1', '38', 'NA', 'site', 'yes', NULL, NULL, '2021-02-17 10:26:36'),
(267, 'Weight Indicator', 6, 1, 'general-calculator', '100~80000', 15000, '0.1', 'Lbs', 'NA', 'lab', 'no', NULL, NULL, NULL),
(268, 'Hydraulic Jacks Base Plate', 6, 1, 'general-calculator', '0~5', 5000, '0.1', 'Ton', 'NA', 'site', 'no', NULL, NULL, NULL),
(269, 'Hydraulic Jacks Tri Pod', 6, 1, 'general-calculator', '0~10', 8000, '0.1', 'Ton', 'NA', 'lab', 'no', NULL, NULL, NULL),
(270, 'Yarn Tension Meter', 6, 1, 'general-calculator', '10~100', 8000, '0.1', 'lbs', 'NA', 'site', 'no', NULL, NULL, NULL),
(271, 'Dynamometers', 6, 16, 'general-calculator', '50~15000', 8000, '0.1', '1', 'NA', 'lab', 'no', NULL, NULL, '2021-02-25 06:20:37'),
(272, 'Cable Tensiometer', 6, 1, 'general-calculator', '20~100', 8000, '0.1', 'lbs', 'NA', 'site', 'no', NULL, NULL, NULL),
(273, 'Impact Tester', 6, 1, 'general-calculator', '1~13', 8000, '0.1', 'in.lbs', 'NA', 'lab', 'no', NULL, NULL, NULL),
(274, 'Push Pull Gauge', 6, 1, 'general-calculator', '0~20', 8000, '0.1', 'kg/f', 'NA', 'site', 'no', NULL, NULL, NULL),
(275, 'Over Head Load Crane', 6, 1, 'general-calculator', '1', 8000, '0.1', 'Ton', 'NA', 'lab', 'no', NULL, NULL, NULL),
(276, 'Zhegiang Stacker', 6, 1, 'general-calculator', '1.6', 8000, '0.1', 'Ton', 'NA', 'site', 'no', NULL, NULL, NULL),
(277, 'Zhegiang Stacker', 6, 1, 'general-calculator', '1', 8000, '0.1', 'Ton', 'NA', 'lab', 'no', NULL, NULL, NULL),
(278, 'Tensile Testing Machine', 6, 1, 'general-calculator', '10~540', 8000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(279, 'Hydraulic Jack Tri-Pod', 6, 1, 'general-calculator', '0~11', 8000, '0.1', 'Ton', 'NA', 'lab', 'no', NULL, NULL, NULL),
(280, 'Anemometers', 7, 1, 'general-calculator', '0.001~20', 2500, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(281, 'Rota Meters', 7, 1, 'general-calculator', '', 0, '0.1', '', 'NA', 'lab', 'no', NULL, NULL, NULL),
(282, 'Wind Speed Meters', 7, 1, 'general-calculator', '0.001~20', 2500, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(283, 'Bio Safety Cabinets', 7, 1, 'general-calculator', '0.001~20', 2500, '0.1', 'm/Sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(284, 'Fume Hoods', 7, 1, 'general-calculator', '0.001~20', 2500, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(285, 'Air Samplers', 7, 1, 'general-calculator', '0.001~20', 2500, '0.1', 'm/Sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(286, 'Meters PD', 7, 1, 'general-calculator', '10~1000', 10000, '0.1', 'LPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(287, 'Meters MAG', 7, 1, 'general-calculator', '10~1000', 12000, '0.1', 'LPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(288, 'Meters Ultrasonic', 7, 1, 'general-calculator', '10~1000', 12000, '0.1', 'LPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(289, 'Meter Turbine', 7, 1, 'general-calculator', '10~1000', 12000, '0.1', 'LPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(290, 'Micro Biological Air Sampler', 7, 1, 'general-calculator', '100~1000', 12000, '0.1', 'Ltr', 'NA', 'site', 'no', NULL, NULL, NULL),
(291, 'Flow Meter', 7, 1, 'general-calculator', '2~20', 12000, '0.1', 'm3/h', 'NA', 'lab', 'no', NULL, NULL, NULL),
(292, 'CO Meter', 8, 1, 'general-calculator', '100', 1000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(293, 'H2S Meter', 8, 1, 'general-calculator', '25', 1000, '0.1', 'ppm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(294, 'LEL Methane', 8, 1, 'general-calculator', '50', 1000, '0.1', '%', 'NA', 'site', 'no', NULL, NULL, NULL),
(295, 'Oxygen Meter', 8, 1, 'general-calculator', '18', 1000, '0.1', '%', 'NA', 'lab', 'no', NULL, NULL, NULL),
(296, 'NO', 8, 1, 'general-calculator', '100', 1000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(297, 'NO2', 8, 1, 'general-calculator', '100', 1000, '0.1', 'ppm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(298, 'SO2', 8, 1, 'general-calculator', '10', 1000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(299, 'CO2', 8, 1, 'general-calculator', '100', 1000, '0.1', 'pmm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(300, 'Multigas Detector', 8, 1, 'general-calculator', '20~100', 1000, '0.1', '% / ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(301, 'Hardness Tester Metal', 9, 1, 'general-calculator', '40', 3000, '0.1', 'HRC', 'NA', 'lab', 'no', NULL, NULL, NULL),
(302, 'Rubber Hardness Tester A, D', 9, 1, 'general-calculator', '0~100', 4000, '0.1', 'Shore', 'NA', 'site', 'no', NULL, NULL, NULL),
(303, 'Durometer A, D', 9, 1, 'general-calculator', '0~100', 4000, '0.1', 'D', 'NA', 'lab', 'no', NULL, NULL, NULL),
(304, 'Durometer', 9, 1, 'general-calculator', '0~80', 0, '0.1', 'Shore A', 'NA', 'site', 'no', NULL, NULL, NULL),
(305, 'Lux Meter', 10, 1, 'general-calculator', '0~1000', 2500, '0.1', 'Lux', 'NA', 'lab', 'no', NULL, NULL, NULL),
(306, 'Lux Survey', 10, 1, 'general-calculator', '0.1~220', 2500, '0.1', 'Lux', 'NA', 'site', 'no', NULL, NULL, NULL),
(307, 'UV Light Meter', 10, 1, 'general-calculator', '0~20', 2500, '0.1', 'mW/CM2', 'NA', 'lab', 'no', NULL, NULL, NULL),
(308, 'UV Light ', 10, 1, 'general-calculator', '0.1~20', 2500, '0.1', 'mW/CM2', 'NA', 'site', 'no', NULL, NULL, NULL),
(309, 'Viscosity Apparatus', 11, 1, 'general-calculator', '71~2464', 8000, '0.1', 'cP', 'NA', 'lab', 'no', NULL, NULL, NULL),
(310, 'Viscosity Meter', 11, 1, 'general-calculator', '71~2464', 8000, '0.1', 'cP', 'NA', 'site', 'no', NULL, NULL, NULL),
(311, 'Dip Rod', 12, 1, 'general-calculator', '0.001~20', 3000, '0.1', 'm/Sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(312, 'Glass Gauge ', 12, 1, 'general-calculator', '0.001~20', 3000, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(313, 'Electronic Indicator', 12, 1, 'general-calculator', '0.001~20', 3000, '0.1', 'm/Sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(314, 'Transmitter', 12, 1, 'general-calculator', '0.001~20', 3000, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(315, 'Dead Weights Set 23 Piece', 13, 1, 'general-calculator', '0.001~200', 8050, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(316, 'Dead Weights Set 24 Piece', 13, 1, 'general-calculator', '0.001~500', 8400, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(317, 'Dead Weights Piece', 13, 1, 'general-calculator', '1~5', 850, '0.1', 'kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(318, 'Dead Weights Piece', 13, 1, 'general-calculator', '10~20', 1500, '0.1', 'kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(319, 'Dead Weights Piece', 13, 1, 'general-calculator', '50', 2000, '0.1', 'kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(320, 'Semi Micro Weighing Scale', 13, 1, 'general-calculator', '0.001~60', 3500, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(321, 'Analytical Weighing Scale', 13, 1, 'general-calculator', '0.001~220', 3500, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(322, 'Precision Weighing Scale', 13, 1, 'general-calculator', '0.01~650', 4000, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(323, 'Top Loading Weighing Scale', 13, 1, 'general-calculator', '1~15000', 4500, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(324, 'Plateform Weighing Scale', 13, 1, 'general-calculator', '0.1~200', 6000, '0.1', 'kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(325, 'Plateform Weighing Scale', 13, 1, 'general-calculator', '0.1~500', 8000, '0.1', 'kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(326, 'Plateform Weighing Scale', 13, 1, 'general-calculator', '0.5~1000', 12500, '0.1', 'kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(327, 'Weighing Bridge', 13, 1, 'general-calculator', '5~20000', 30000, '0.1', 'kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(328, 'Weighing Bridge', 13, 1, 'general-calculator', '5~100000', 50000, '0.1', 'kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(329, 'Spring Scales', 13, 1, 'general-calculator', '0.5~100', 3000, '0.1', 'kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(330, 'Batch Plant Chemical Scale', 13, 1, 'general-calculator', '0~50', 400, '0.1', 'kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(331, 'Batch Plant Water Scale', 13, 1, 'general-calculator', '0~500', 8000, '0.1', 'Kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(332, 'Batch Plant Cement Scale', 13, 1, 'general-calculator', '0~500', 8000, '0.1', 'Kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(333, 'Batch Plant Aggregate Scale', 13, 1, 'general-calculator', '0~2000', 20000, '0.1', 'Kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(334, 'Weighing Scale', 13, 1, 'general-calculator', '0.2~5', 20000, '0.1', 'Kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(335, 'Weighing Scale', 13, 1, 'general-calculator', '0.1~6', 20000, '0.1', 'Kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(336, 'Weighing Scale', 13, 1, 'general-calculator', '0.1~10', 20000, '0.1', 'Kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(337, 'Weighing Scale', 13, 1, 'general-calculator', '0.5~20', 20000, '0.1', 'Kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(338, 'Weighing Scale', 13, 1, 'general-calculator', '0.5~30', 20000, '0.1', 'Kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(339, 'Weighing Scale', 13, 1, 'general-calculator', '0.5~40', 20000, '0.1', 'Kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(340, 'Plateform Scale', 13, 1, 'general-calculator', '20~2000', 20000, '0.1', 'Kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(341, 'Weighing Indicator', 13, 1, 'general-calculator', '20~6000', 20000, '0.1', 'Kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(342, 'Weighing Indicator', 13, 1, 'general-calculator', '500~10000', 20000, '0.1', 'Kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(343, 'Weighing Indicator', 13, 1, 'general-calculator', '1000~12500', 20000, '0.1', 'Kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(344, 'Weighing Indicator', 13, 1, 'general-calculator', '2500~23000', 20000, '0.1', 'Kg', 'NA', 'site', 'no', NULL, NULL, NULL),
(345, 'Dumble Weights', 13, 1, 'general-calculator', '5000~15000', 20000, '0.1', 'g', 'NA', 'lab', 'no', NULL, NULL, NULL),
(346, 'Wrinkle Recovery Tester', 13, 1, 'general-calculator', '0.2~2', 20000, '0.1', 'kg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(347, 'Multimeter Volt DC', 14, 1, 'general-calculator', 'DC 0~1000 ', 1000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(348, 'Multimeter Volt AC', 14, 1, 'general-calculator', 'AC 0~1000 ', 1000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(349, 'Multimeter Amps DC', 14, 1, 'general-calculator', 'DC 0~10 ', 1000, '0.1', 'A', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(350, 'Multimeter Amps AC', 14, 1, 'general-calculator', 'AC 0~10', 1000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(351, 'Multimeter Resistance', 14, 1, 'general-calculator', '0~50 M', 1000, '0.1', 'Ohm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(352, 'Digital Multimeter Volt DC', 14, 1, 'general-calculator', 'DC 0~1000 ', 1000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(353, 'Digital Multimeter Volt AC', 14, 1, 'general-calculator', 'AC 0~1000 ', 1000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(354, 'Digital Multimeter Amps DC', 14, 1, 'general-calculator', 'DC 0~10 ', 1000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(355, 'Digital Multimeter Amps AC', 14, 1, 'general-calculator', 'AC 0~10', 1000, '0.1', 'A', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(356, 'Digital Multimeter Volt DC', 14, 1, 'general-calculator', '0~50 M', 1000, '0.1', 'Ohm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(357, 'Digital Multimeter Temperature', 14, 1, 'general-calculator', '-10~150', 1000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(358, 'Digtal Multimeter Capcitance', 14, 1, 'general-calculator', '0.001~1', 1000, '0.1', '?F', 'NA', 'site', 'yes', NULL, NULL, NULL),
(359, 'Digital Clamp Meter Volt DC', 14, 1, 'general-calculator', 'DC 0~1000 ', 1000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(360, 'Digital Clamp Meter Volt AC', 14, 1, 'general-calculator', 'AC 0~1000 ', 1000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(361, 'Digital Clamp Meter Amps DC', 14, 1, 'general-calculator', 'DC 0~800', 1000, '0.1', 'A', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(362, 'Digital Clamp Meter Amps AC', 14, 1, 'general-calculator', 'AC 0~800', 1000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(363, 'Digital Clamp Meter Resistance', 14, 1, 'general-calculator', '0~50 M', 1000, '0.1', 'Ohm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(364, 'Battery Charging Analyzer DC Volt', 14, 1, 'general-calculator', '0~50', 1000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(365, 'Battery Charging Analyzer DC Amps', 14, 1, 'general-calculator', '0~51', 1000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(366, 'Battery Charging Analyzer Time', 14, 1, 'general-calculator', '0~52', 1000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(367, 'Digital Power Supply DC Volt', 14, 1, 'general-calculator', '0~53', 1000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(368, 'Digital Power Supply DC Amps', 14, 1, 'general-calculator', '0~54', 1000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(369, 'Digital Earth Testers Resistance', 14, 1, 'general-calculator', '0.1~2000', 1000, '0.1', 'Ohm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(370, 'Digtal Earth Tester AC Volt', 14, 1, 'general-calculator', '10~200', 1000, '0.1', 'AC V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(371, 'Injection Source   (Voltage)', 14, 1, 'general-calculator', '0~1000', 6000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(372, 'Injection Source   (Current)', 14, 1, 'general-calculator', '0~100', 2000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(373, 'RTD Loop Calibrator DC Current', 14, 1, 'general-calculator', '4~22', 2000, '0.1', 'mA', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(374, 'RTD Loop Calibrator Resistance Source Mode', 14, 1, 'general-calculator', '0~4000', 2000, '0.1', '?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(375, 'RTD Loop Calibrator Resistance Measure Mode', 14, 1, 'general-calculator', '0~4000', 2000, '0.1', 'K?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(376, 'RTD Loop Calibrator Temperature Source Mode', 14, 1, 'general-calculator', '-200~790', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(377, 'RTD Loop Calibrator Temperature Measure Mode', 14, 1, 'general-calculator', '-200~800', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(378, 'Loop Calibrator Source Mode', 14, 1, 'general-calculator', '0~22', 2000, '0.1', 'mA', 'NA', 'site', 'yes', NULL, NULL, NULL),
(379, 'Loop Calibrator Measure Mode', 14, 1, 'general-calculator', '0~50', 2000, '0.1', 'mA', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(380, 'Process Calibrator mV Source', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'mV', 'NA', 'site', 'yes', NULL, NULL, NULL),
(381, 'Process Calibrator Volt DC Source', 14, 1, 'general-calculator', '0~24', 2000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(382, 'Process Calibrator mAmps Source', 14, 1, 'general-calculator', '0~22', 2000, '0.1', 'mA', 'NA', 'site', 'yes', NULL, NULL, NULL),
(383, 'Process Calibrator Resistance Source', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'k?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(384, 'Process Calibrator TC Source Type J, K, S, T', 14, 1, 'general-calculator', '-200~1600', 2000, '0.1', 'TC', 'NA', 'site', 'yes', NULL, NULL, NULL),
(385, 'Process Calibrator RTD Source Pt100, 385', 14, 1, 'general-calculator', '-200~850', 2000, '0.1', 'RTD', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(386, 'Process Calibrator Frequency Source', 14, 1, 'general-calculator', '50', 2000, '0.1', 'MHz', 'NA', 'site', 'yes', NULL, NULL, NULL),
(387, 'Process Calibrator mV Measure', 14, 1, 'general-calculator', '0~50', 2000, '0.1', 'mV', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(388, 'Process Calibrator Volt DC Voltage Measure', 14, 1, 'general-calculator', '0~300', 2000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(389, 'Process Calibrator Volt AC Measure', 14, 1, 'general-calculator', '1~300', 2000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(390, 'Process Calibrator mAmps Measure', 14, 1, 'general-calculator', '24', 2000, '0.1', 'mA', 'NA', 'site', 'yes', NULL, NULL, NULL),
(391, 'Process Calibrator Resistance Measure', 14, 1, 'general-calculator', '40~1000', 2000, '0.1', '?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(392, 'Process Calibrator TC Measure Type J, K, S, T', 14, 1, 'general-calculator', '-200~1600', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(393, 'Process Calibrator RTD Measure Pt100, 385', 14, 1, 'general-calculator', '-200~850', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL);
INSERT INTO `capabilities` (`id`, `name`, `parameter`, `procedure`, `calculator`, `range`, `price`, `accuracy`, `unit`, `remarks`, `location`, `accredited`, `deleted_at`, `created_at`, `updated_at`) VALUES
(394, 'Process Calibrator Frequency Measure', 14, 1, 'general-calculator', '0~50', 2000, '0.1', 'kHz', 'NA', 'site', 'yes', NULL, NULL, NULL),
(395, 'HPLC Flow Rate', 14, 1, 'general-calculator', '0.5~3', 2000, '0.1', 'mL/min', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(396, 'HPLC Column Oven Temperature', 14, 1, 'general-calculator', '25~65', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(397, 'HPLC Auto Sampler Temperature', 14, 1, 'general-calculator', '5~25', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(398, 'HPLC auto sampler accuracy of volume drawn', 14, 1, 'general-calculator', '10~50', 2000, '0.1', '?L', 'NA', 'site', 'no', NULL, NULL, NULL),
(399, 'HPLC Detector Response System Suitability', 14, 1, 'general-calculator', '200', 2000, '0.1', 'ppm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(400, 'HPLC Detector Response linearity w.r.t. Caffeine Concentration', 14, 1, 'general-calculator', '120~200', 2000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(401, 'HPLC Detector Response linearity w.r.t. volume drawn', 14, 1, 'general-calculator', '10 ?L to 50 ?L', 2000, '0.1', '?L', 'NA', 'lab', 'no', NULL, NULL, NULL),
(402, 'Dissolution Apparatus Temperature', 14, 1, 'general-calculator', '36~38', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(403, 'Dissolution Apparatus Timer', 14, 1, 'general-calculator', '300~3600', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(404, 'Dissolution Apparatus Spindle Speed', 14, 1, 'general-calculator', '30~100', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(405, 'Dissolution Apparatus Wobbling', 14, 1, 'general-calculator', '25', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(406, 'Disintegration Apparatus Stroke Per Minute', 14, 1, 'general-calculator', '30', 2000, '0.1', 'SPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(407, 'Disintegration Apparatus Bath Temp.', 14, 1, 'general-calculator', '37~38', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(408, 'Disintegration Apparatus Time', 14, 1, 'general-calculator', '30~120', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(409, 'Tablet Hardness Tester Thickness', 14, 1, 'general-calculator', '1~10', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(410, 'Tablet Hardness Tester Diameter', 14, 1, 'general-calculator', '1~10', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(411, 'Tablet Hardness Tester Force', 14, 1, 'general-calculator', '600~1300', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(412, 'Viscometer Spindle RPM', 14, 1, 'general-calculator', '5~100', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(413, 'Viscometer Spindle Timer', 14, 1, 'general-calculator', '60~300', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(414, 'Viscometer Viscosity ', 14, 1, 'general-calculator', '70~2650', 2000, '0.1', 'Cp', 'NA', 'site', 'no', NULL, NULL, NULL),
(415, 'Autoclave Temp Mapping', 14, 1, 'general-calculator', '121', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(416, 'Autoclave Temp Pressure Measurement', 14, 1, 'general-calculator', '15', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(417, 'Autoclave PSV', 14, 1, 'general-calculator', '10', 2000, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(418, 'Autoclave Temp Switch', 14, 1, 'general-calculator', '0~120', 2000, '0.1', '?C', 'NA', 'site', 'no', NULL, NULL, NULL),
(419, 'Laminar Flow Cabinet Flow Rate', 14, 1, 'general-calculator', '0.1~1', 2000, '0.1', 'm/s', 'NA', 'lab', 'no', NULL, NULL, NULL),
(420, 'Laminar Flow Cabinet Lux Measurement', 14, 1, 'general-calculator', '500~1000', 2000, '0.1', 'LUX', 'NA', 'site', 'no', NULL, NULL, NULL),
(421, 'Laminar Flow Cabinet DOP Test', 14, 1, 'general-calculator', '500~1001', 2000, '0.1', 'LUX', 'NA', 'lab', 'no', NULL, NULL, NULL),
(422, 'Denco Air Conditionair Temp', 14, 1, 'general-calculator', '18~25', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(423, 'Denco Air Conditionair %RH', 14, 1, 'general-calculator', '40~60', 2000, '0.1', '%RH', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(424, 'Thermohygrograph Temp', 14, 1, 'general-calculator', '20~30', 2000, '0.1', '?C', 'NA', 'site', 'no', NULL, NULL, NULL),
(425, 'Thermohygrograph %RH', 14, 1, 'general-calculator', '30~70', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(426, 'Whirling Hygromete Temp', 14, 1, 'general-calculator', '20~30', 2000, '0.1', '?C', 'NA', 'site', 'no', NULL, NULL, NULL),
(427, 'Whirling Hygromete %RH', 14, 1, 'general-calculator', '30~70', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(428, 'Fade-ometer CI 3000 Chamber Temp', 14, 1, 'general-calculator', '30~50', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(429, 'Fade-ometer CI 3000 Chamber %RH', 14, 1, 'general-calculator', '30~70', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(430, 'Fade-ometer CI 3000 Black Panel Temp', 14, 1, 'general-calculator', '30~71', 2000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(431, 'Fade-ometer CI 3000 UV Light Intensity', 14, 1, 'general-calculator', '30~72', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(432, 'Washer Whirlpool Agitator Speed   (Normal)', 14, 1, 'general-calculator', '86', 2000, '0.1', 'SPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(433, 'Washer Whirlpool Agitator Speed   (Delicate)', 14, 1, 'general-calculator', '27', 2000, '0.1', 'SPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(434, 'Washer Whirlpool Washing Time   (Normal)', 14, 1, 'general-calculator', '16', 2000, '0.1', 'min', 'NA', 'site', 'no', NULL, NULL, NULL),
(435, 'Washer Whirlpool Washing Time   (Delicate)', 14, 1, 'general-calculator', '8.5', 2000, '0.1', 'min', 'NA', 'lab', 'no', NULL, NULL, NULL),
(436, 'Washer Whirlpool Spin Speed   (Normal)', 14, 1, 'general-calculator', '660', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(437, 'Washer Whirlpool Spin Speed   (Delicate)', 14, 1, 'general-calculator', '500', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(438, 'Washer Whirlpool Final Spin Time   (Normal)', 14, 1, 'general-calculator', '5', 2000, '0.1', 'min', 'NA', 'site', 'no', NULL, NULL, NULL),
(439, 'Washer Whirlpool Final Spin Time   (Delicate)', 14, 1, 'general-calculator', '5', 2000, '0.1', 'min', 'NA', 'lab', 'no', NULL, NULL, NULL),
(440, 'Washer Whirlpool Water Level Verification', 14, 1, 'general-calculator', '100~200', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(441, 'Washer Whirlpool Wash Tub Temperature (Regular Warm)', 14, 1, 'general-calculator', '30', 2000, '0.1', '?C', 'NA', 'lab', 'no', NULL, NULL, NULL),
(442, 'Washer Whirlpool Washing Time', 14, 1, 'general-calculator', '1200', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(443, 'Washer Whirlpool Agitation Speed', 14, 1, 'general-calculator', '72', 2000, '0.1', 'SPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(444, 'Washer Whirlpool Spin Time', 14, 1, 'general-calculator', '720', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(445, 'LEF Laundrometere Temp', 14, 1, 'general-calculator', '40~80', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(446, 'LEF Laundrometere RPM', 14, 1, 'general-calculator', '30~40', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(447, 'LEF Laundrometere Timer', 14, 1, 'general-calculator', '1800~3600', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(448, 'Wascator Volume / Water Level', 14, 1, 'general-calculator', '50~200', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(449, 'Wascator Temperature', 14, 1, 'general-calculator', '30~60', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(450, 'Wascator RPM', 14, 1, 'general-calculator', '35~1500', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(451, 'Wascator Time', 14, 1, 'general-calculator', '60~900', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(452, 'Tumble Dryer Temp', 14, 1, 'general-calculator', '30~40', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(453, 'Tumble Dryer RPM', 14, 1, 'general-calculator', '60', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(454, 'Tumble Dryer Time', 14, 1, 'general-calculator', '900~1200', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(455, 'Elmendrof Tear Tester Pressure Gauge', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(456, 'Elmendrof Tear Tester Cut Length', 14, 1, 'general-calculator', '20', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(457, 'Elmendrof Tear Tester Counter Weights (No. 260-6400, 12800-50)', 14, 1, 'general-calculator', '0.96~1.74', 2000, '0.1', 'kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(458, 'Elmendrof Tear Tester Tear with Basic Pendulum Weight - (6400 gmf)', 14, 1, 'general-calculator', '0', 2000, '0.1', '%', 'NA', 'site', 'yes', NULL, NULL, NULL),
(459, 'Elmendrof Tear Tester Check Verification With Counter Weight - (6400 gmf)', 14, 1, 'general-calculator', '50', 2000, '0.1', '%', 'NA', 'lab', 'no', NULL, NULL, NULL),
(460, 'Elmendrof Tear Tester Basic Pendulum with (Weight - 12800 gmf)', 14, 1, 'general-calculator', '0', 2000, '0.1', '%', 'NA', 'site', 'yes', NULL, NULL, NULL),
(461, 'Elmendrof Tear Tester Check Verification with (Weight - 12800 gmf)', 14, 1, 'general-calculator', '50', 2000, '0.1', '%', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(462, 'Crock Meter Finger Diameter', 14, 1, 'general-calculator', '16', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(463, 'Crock Meter Stroke Length', 14, 1, 'general-calculator', '104', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(464, 'Crock Meter Counter Operation for (10 Counts)', 14, 1, 'general-calculator', '10', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(465, 'Crock Meter Force', 14, 1, 'general-calculator', '9', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(466, 'Stifness Tester Pressure Gauge', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(467, 'Stifness Tester Plunger Dia', 14, 1, 'general-calculator', '25.4', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(468, 'Stifness Tester Orifice Dia', 14, 1, 'general-calculator', '38', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(469, 'Stifness Tester Plunger Force', 14, 1, 'general-calculator', '5~40', 2000, '0.1', 'kg', 'NA', 'lab', 'no', NULL, NULL, NULL),
(470, 'Stifness Tester Strock Time', 14, 1, 'general-calculator', '1.7', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(471, 'Verivide Light Box Visible Light (Incanda)', 14, 1, 'general-calculator', '771', 2000, '0.1', 'LUX', 'NA', 'lab', 'no', NULL, NULL, NULL),
(472, 'Verivide Light Box Visible Light (Daylight)', 14, 1, 'general-calculator', '1120', 2000, '0.1', 'LUX', 'NA', 'site', 'no', NULL, NULL, NULL),
(473, 'Verivide Light Box Visible Light (CWF-F02)', 14, 1, 'general-calculator', '1289', 2000, '0.1', 'LUX', 'NA', 'lab', 'no', NULL, NULL, NULL),
(474, 'Verivide Light Box Visible Light (TL-84)', 14, 1, 'general-calculator', '1288', 2000, '0.1', 'LUX', 'NA', 'site', 'no', NULL, NULL, NULL),
(475, 'Verivide Light Box Visible Light (UL-3000)', 14, 1, 'general-calculator', '1328', 2000, '0.1', 'LUX', 'NA', 'lab', 'no', NULL, NULL, NULL),
(476, 'Verivide Light Box Time Interval', 14, 1, 'general-calculator', '6~3600', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(477, 'Verivide Light Box Angle of Viewing Wedge', 14, 1, 'general-calculator', '45', 2000, '0.1', '?', 'NA', 'lab', 'no', NULL, NULL, NULL),
(478, 'Universal Wear Tester Weight', 14, 1, 'general-calculator', '0.5~2', 2000, '0.1', 'lbs', 'NA', 'site', 'yes', NULL, NULL, NULL),
(479, 'Universal Wear Tester Stroke', 14, 1, 'general-calculator', '115', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(480, 'Universal Wear Tester Flex Bar Length', 14, 1, 'general-calculator', '11.2', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(481, 'Universal Wear Tester Flex Bar Thickness', 14, 1, 'general-calculator', '1.6', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(482, 'ICI Pilling Snagging Tester Box Length  (Left + Right)', 14, 1, 'general-calculator', '230', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(483, 'ICI Pilling Snagging Tester Box Width  (Left + Right)', 14, 1, 'general-calculator', '230', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(484, 'ICI Pilling Snagging Tester Box Depth  (Left + Right)', 14, 1, 'general-calculator', '236', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(485, 'ICI Pilling Snagging Tester RPM', 14, 1, 'general-calculator', '60', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(486, 'Random Tumble Pilling Tester Diameter  (Left + Right)', 14, 1, 'general-calculator', '143', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(487, 'Random Tumble Pilling Tester Depth  (Left + Right)', 14, 1, 'general-calculator', '152', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(488, 'Random Tumble Pilling Tester Time Interval', 14, 1, 'general-calculator', '1800', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(489, 'Ozone Test Chamber Timer', 14, 1, 'general-calculator', '10800', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(490, 'Ozone Test Chamber UV Light Intensity', 14, 1, 'general-calculator', '0.045~0.090', 2000, '0.1', 'mW/cm2', 'NA', 'site', 'no', NULL, NULL, NULL),
(491, 'Laboratory Wringer Padder Press (Weights)', 14, 1, 'general-calculator', '0.5~2', 2000, '0.1', 'lbs', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(492, 'Laboratory Wringer Padder RPM', 14, 1, 'general-calculator', '10', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(493, 'AATCC Perspiration Tester Weights', 14, 1, 'general-calculator', '915~4225', 2000, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(494, 'AATCC Perspiration Tester Frame', 14, 1, 'general-calculator', '920', 2000, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(495, 'AATCC Perspiration Tester Weight Plates Length', 14, 1, 'general-calculator', '115', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(496, 'AATCC Perspiration Tester Weight Plate Width', 14, 1, 'general-calculator', '60', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(497, 'ISO Perspiration Tester Weight', 14, 1, 'general-calculator', '4.54', 2000, '0.1', 'kg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(498, 'ISO Perspiration Tester Plates Length', 14, 1, 'general-calculator', '115', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(499, 'ISO Perspiration Tester Plates Width', 14, 1, 'general-calculator', '60', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(500, 'Stretch Recovery Board Scale Length', 14, 1, 'general-calculator', '10~500', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(501, 'Stretch Recovery Board Hanger Weights', 14, 1, 'general-calculator', '1360', 2000, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(502, 'Wise Shaker RPM', 14, 1, 'general-calculator', '20~70', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(503, 'Wise Shaker Timer', 14, 1, 'general-calculator', '1800~9000', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(504, 'Abrasion Tester Thread Weights', 14, 1, 'general-calculator', '250~750', 2000, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(505, 'Abrasion Tester Thread No. of Strokes', 14, 1, 'general-calculator', '30~60', 2000, '0.1', 'SPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(506, 'Universal Strength Tester Force', 14, 1, 'general-calculator', '9.7~2500', 2000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(507, 'Universal Strength Tester Speed @ 100 mm/min', 14, 1, 'general-calculator', '60~120', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(508, 'Universal Strength Tester Pressure', 14, 1, 'general-calculator', '5~16', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(509, 'Universal Strength Tester Clamp Grip Length', 14, 1, 'general-calculator', '26~51', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(510, 'Universal Strength Tester Clamp Grip Width', 14, 1, 'general-calculator', '38~40', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(511, 'Martindale Pilling/Abrasion Tester Rotaional Speed (Left Pivot + Right Pivot)', 14, 1, 'general-calculator', '47', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(512, 'Martindale Pilling/Abrasion Tester Rotaional Speed (Center Pivot)', 14, 1, 'general-calculator', '45', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(513, 'Lissajous Figure 1', 14, 1, 'general-calculator', '24', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(514, 'Lissajous Figure 2', 14, 1, 'general-calculator', '60', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(515, 'Weights (9 KPa + 12 KPa)', 14, 1, 'general-calculator', '150~2500', 2000, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(516, 'Abrassion & Pilling Dimensions', 14, 1, 'general-calculator', '7~127', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(517, 'Time for 16 Revolutions', 14, 1, 'general-calculator', '19.8', 2000, '0.1', 'sec', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(518, 'Parallelism of Plate and Abrading Table', 14, 1, 'general-calculator', '101.45~101.60', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(519, 'Wrap Reel Turn Counts', 14, 1, 'general-calculator', '80', 2000, '0.1', 'Counts', 'NA', 'lab', 'no', NULL, NULL, NULL),
(520, 'Wrap Reel Wheel Length in One Cycle', 14, 1, 'general-calculator', '1.5', 2000, '0.1', 'Yards', 'NA', 'site', 'no', NULL, NULL, NULL),
(521, 'Burst Strength Tester Orifice Dia', 14, 1, 'general-calculator', '2.5', 2000, '0.1', 'Yards', 'NA', 'lab', 'no', NULL, NULL, NULL),
(522, 'Burst Strength Tester Burst Pressure', 14, 1, 'general-calculator', '3.5', 2000, '0.1', 'Yards', 'NA', 'site', 'no', NULL, NULL, NULL),
(523, 'Falmability Test Chamber Time', 14, 1, 'general-calculator', '4.5', 2000, '0.1', 'Yards', 'NA', 'lab', 'no', NULL, NULL, NULL),
(524, 'Falmability Test Chamber Angle', 14, 1, 'general-calculator', '5.5', 2000, '0.1', 'Yards', 'NA', 'site', 'no', NULL, NULL, NULL),
(525, 'Falmability Test Chamber Temperature', 14, 1, 'general-calculator', '6.5', 2000, '0.1', 'Yards', 'NA', 'lab', 'no', NULL, NULL, NULL),
(526, 'Spray Rating Tester Nozzle Diameter', 14, 1, 'general-calculator', '37', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(527, 'Distance From Nozzle to Center of Specimen', 14, 1, 'general-calculator', '150', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(528, 'Height of The Funnel Including Nozzle', 14, 1, 'general-calculator', '194', 2000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(529, 'Time to Dispense 250 mL.', 14, 1, 'general-calculator', '28', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(530, 'Kinematic Viscometer RPM', 14, 1, 'general-calculator', '1465', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(531, 'Kinematic Viscometer Temperature', 14, 1, 'general-calculator', '40', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(532, 'Kinematic Viscometer Time', 14, 1, 'general-calculator', '30~1800', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(533, 'Yarn Lea Winder Counts', 14, 1, 'general-calculator', '80', 2000, '0.1', 'Count', 'NA', 'lab', 'no', NULL, NULL, NULL),
(534, 'Yarn Lea Winder Dia', 14, 1, 'general-calculator', '54', 2000, '0.1', 'inch', 'NA', 'site', 'no', NULL, NULL, NULL),
(535, 'Blade Cut Tester Cut Length', 14, 1, 'general-calculator', '50', 2000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(536, 'Blade Cut Tester Speed Operation', 14, 1, 'general-calculator', '25', 2000, '0.1', 'mm/s', 'NA', 'site', 'no', NULL, NULL, NULL),
(537, 'Blade Cut Tester Downward Force   (510g ? 9g)', 14, 1, 'general-calculator', '5', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(538, 'Bursting Cracking Tester Speed', 14, 1, 'general-calculator', '6', 2000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(539, 'Bursting Cracking Tester Ring Size', 14, 1, 'general-calculator', '7', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(540, 'Peel Off Strength Force', 14, 1, 'general-calculator', '8', 2000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(541, 'Peel Off Strength Dimension', 14, 1, 'general-calculator', '9', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(542, 'DIN Abrasion Tester Speed', 14, 1, 'general-calculator', '10', 2000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(543, 'DIN Abrasion Tester Weight', 14, 1, 'general-calculator', '11', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(544, 'DIN Abrasion Tester Dimension', 14, 1, 'general-calculator', '12', 2000, '0.1', 'N', 'NA', 'site', 'no', NULL, NULL, NULL),
(545, 'UV Vis Spectrophotometer Stray Radiation Energy @ (220~400 nm)', 14, 1, 'general-calculator', '13', 2000, '0.1', 'N', 'NA', 'lab', 'no', NULL, NULL, NULL),
(546, 'Wavelength Accuracy', 14, 1, 'general-calculator', '279.3~637.6', 2000, '0.1', 'nm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(547, 'Transmittance (Linearity) @ (440~635 nm)', 14, 1, 'general-calculator', '2~60', 2000, '0.1', '%T', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(548, 'Absorbance (Linearity) @ (440~635 nm)', 14, 1, 'general-calculator', '0~2', 2000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(549, 'Baseline Accuracy @ (440~635 nm)', 14, 1, 'general-calculator', '0', 2000, '0.1', 'A', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(550, 'Blister Machine Temp Controller   (Upper Forming)', 14, 1, 'general-calculator', '100~150', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(551, 'Blister Machine Temp Controller   (Lower Forming)', 14, 1, 'general-calculator', '100~150', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(552, 'Blister Machine Temp Controller   (Heat Seal)', 14, 1, 'general-calculator', '150~180', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(553, 'Blister Machine Main Pressure', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(554, 'Blister Machine Forming Pressure', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'Bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(555, 'Blister Machine Sealing Pressure', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'Bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(556, 'Double Cone Mixer RPM', 14, 1, 'general-calculator', '10~60', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(557, 'Double Cone Mixer Timer', 14, 1, 'general-calculator', '60~2700', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(558, 'Digital Clamp Meter DC Current', 14, 1, 'general-calculator', '1~800', 2000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(559, 'Digital Clamp Meter AC Current', 14, 1, 'general-calculator', '1~800', 2000, '0.1', 'A', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(560, 'Digital Clamp Meter DC Voltage', 14, 1, 'general-calculator', '1~600', 2000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(561, 'Digital Clamp Meter AC Voltage', 14, 1, 'general-calculator', '1~600', 2000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(562, 'Digital Clamp Meter Resistance', 14, 1, 'general-calculator', '1~10000000', 2000, '0.1', '?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(563, 'Digital Clamp Meter Capacitance', 14, 1, 'general-calculator', '0.05~1', 2000, '0.1', '?F', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(564, 'Digital Clamp Meter Frequency', 14, 1, 'general-calculator', '10~1000', 2000, '0.1', 'Hz', 'NA', 'site', 'yes', NULL, NULL, NULL),
(565, 'CVC Labelling Machine Pressure', 14, 1, 'general-calculator', '0~15', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(566, 'CVC Labelling Machine Temperature', 14, 1, 'general-calculator', '50~150', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(567, 'Homogenizer RPM', 14, 1, 'general-calculator', '600~3000', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(568, 'Homogenizer Timer', 14, 1, 'general-calculator', '60~1800', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(569, 'Moisture Analyzer Temperature', 14, 1, 'general-calculator', '50~120', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(570, 'Moisture Analyzer Mass', 14, 1, 'general-calculator', '0.01~120', 2000, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(571, 'Moisture Analyzer Time', 14, 1, 'general-calculator', '600', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(572, 'Steam Jacketed Kettle Temp', 14, 1, 'general-calculator', '0~300', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(573, 'Steam Jacketed Kettle Pressure', 14, 1, 'general-calculator', '0~15', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(574, 'Steam Jacketed Kettle PSV', 14, 1, 'general-calculator', '0~5', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(575, 'Steam Jacketed Kettle RPM', 14, 1, 'general-calculator', '30~1000', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(576, 'pH Meter ', 14, 1, 'general-calculator', '4.01~7.01', 2000, '0.1', 'pH', 'NA', 'site', 'yes', NULL, NULL, NULL),
(577, 'pH Meter Temperature', 14, 1, 'general-calculator', '20~30', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(578, 'Tube Filling Machine PG', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(579, 'Tube Filling Machine TC', 14, 1, 'general-calculator', '0~100', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(580, 'Fluid Bed Dryer Timer', 14, 1, 'general-calculator', '300~3600', 2000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(581, 'Fluid Bed Dryer Material Temperature', 14, 1, 'general-calculator', '40~100', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(582, 'Fluid Bed Dryer Outlet Temperature', 14, 1, 'general-calculator', '40~100', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(583, 'Fluid Bed Dryer Steam Pressure', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(584, 'Fluid Bed Dryer Air Pressure', 14, 1, 'general-calculator', '0~1', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(585, 'Fluid Bed Dryer Air Pressure', 14, 1, 'general-calculator', '0~1', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(586, 'Capsule Filling Machine RPM', 14, 1, 'general-calculator', '10~100', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(587, 'Capsule Filling Machine Volt', 14, 1, 'general-calculator', '0~300', 2000, '0.1', 'V', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(588, 'Capsule Filling Machine Amps', 14, 1, 'general-calculator', '0~50', 2000, '0.1', 'A', 'NA', 'site', 'yes', NULL, NULL, NULL),
(589, 'AutoClave Temperature', 14, 1, 'general-calculator', '121', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(590, 'AutoClave Pressure', 14, 1, 'general-calculator', '1.5', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(591, 'Coater China/Thai RPM', 14, 1, 'general-calculator', '6~60', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(592, 'Coater China/Thai Temperature', 14, 1, 'general-calculator', '40~100', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(593, 'Conductivity Meter Conductivity', 14, 1, 'general-calculator', '84~12870', 2000, '0.1', '?S', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(594, 'Conductivity Meter Temperature', 14, 1, 'general-calculator', '25~30', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(595, 'Air Storage Tanks Temp', 14, 1, 'general-calculator', '0~150', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(596, 'Air Storage Tanks Pressure', 14, 1, 'general-calculator', '0~25', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(597, 'Production Machine Timer', 14, 1, 'general-calculator', '60~3600', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(598, 'Production Machine TC', 14, 1, 'general-calculator', '0~150', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(599, 'Production Machine PG', 14, 1, 'general-calculator', '0~15', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(600, 'Production Machine RPM', 14, 1, 'general-calculator', '10~60', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(601, 'High Shear Wet Mixer Chopper', 14, 1, 'general-calculator', '300~700', 2000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(602, 'High Shear Wet Mixer Agitator', 14, 1, 'general-calculator', '20~100', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(603, 'High Shear Wet Mixer Time', 14, 1, 'general-calculator', '300~900', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(604, 'Stability Chamber Temp mapping', 14, 1, 'general-calculator', '15~40', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(605, 'Stability Chamber %RH mapping', 14, 1, 'general-calculator', '30~75', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(606, 'Skerman Ointment Mixer TC', 14, 1, 'general-calculator', '0~100', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(607, 'Skerman Ointment Mixer PG', 14, 1, 'general-calculator', '0~10', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(608, 'Skerman Ointment Mixer RPM', 14, 1, 'general-calculator', '10~60', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(609, 'Steam Boiler Temperature', 14, 1, 'general-calculator', '0~400', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(610, 'Steam Boiler Pressure', 14, 1, 'general-calculator', '0~25', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(611, 'Sachet Filling Machine Temperature Gauge', 14, 1, 'general-calculator', '0~250', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(612, 'Sachet Filling Machine Counter', 14, 1, 'general-calculator', '30~50', 2000, '0.1', 'Counts/Min', 'NA', 'site', 'no', NULL, NULL, NULL),
(613, 'Gerber Machine Temp', 14, 1, 'general-calculator', '40~70', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(614, 'Gerber Machine RPM', 14, 1, 'general-calculator', '60~1200', 2000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(615, 'Kjheldal Digestor Temp', 14, 1, 'general-calculator', '200~500', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(616, 'Kjheldal Digestor Volume', 14, 1, 'general-calculator', '50~200', 2000, '0.1', 'mL', 'NA', 'site', 'no', NULL, NULL, NULL),
(617, 'Fusing Machine Temperature', 14, 1, 'general-calculator', '50~201', 2000, '0.1', 'mL', 'NA', 'lab', 'no', NULL, NULL, NULL),
(618, 'Fusing Machine Pressure', 14, 1, 'general-calculator', '50~202', 2000, '0.1', 'mL', 'NA', 'site', 'no', NULL, NULL, NULL),
(619, 'Surface Acquisition System Pressure', 14, 1, 'general-calculator', '0~350', 2000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(620, 'Surface Acquisition System Temperature', 14, 1, 'general-calculator', '0~100', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(621, 'Weather Station Temperature (Inside + Outside)', 14, 1, 'general-calculator', '10~30', 2000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(622, 'Weather Station Humidity', 14, 1, 'general-calculator', '30~70', 2000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(623, 'Weather Station Atmospheric Pressure', 14, 1, 'general-calculator', '1013 ? 20', 2000, '0.1', 'hPa', 'NA', 'lab', 'no', NULL, NULL, NULL),
(624, 'Weaterh Station (Dew Point / Rain Gauge)', 14, 1, 'general-calculator', '5~25', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(625, 'Weather Station Wind Velosity', 14, 1, 'general-calculator', '0~20', 2000, '0.1', 'km/h', 'NA', 'lab', 'no', NULL, NULL, NULL),
(626, 'Machine Condition Advisor Touch Temp', 14, 1, 'general-calculator', '0~21', 2000, '0.1', 'km/h', 'NA', 'site', 'no', NULL, NULL, NULL),
(627, 'Machine Condition Advisor IR Temp', 14, 1, 'general-calculator', '0~22', 2000, '0.1', 'km/h', 'NA', 'lab', 'no', NULL, NULL, NULL),
(628, 'Machine Condition Advisor Vibration', 14, 1, 'general-calculator', '0~23', 2000, '0.1', 'km/h', 'NA', 'site', 'no', NULL, NULL, NULL),
(629, 'Machine Condition Advisor RPM', 14, 1, 'general-calculator', '0~24', 2000, '0.1', 'km/h', 'NA', 'lab', 'no', NULL, NULL, NULL),
(630, 'COD Reactor Temperature', 14, 1, 'general-calculator', '100~150', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(631, 'COD Reactor Pressure', 14, 1, 'general-calculator', '60~7200', 2000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(632, 'Ion Selectivity Electrode pH', 14, 1, 'general-calculator', '4~10', 2000, '0.1', 'pH', 'NA', 'site', 'yes', NULL, NULL, NULL),
(633, 'Ion Selectivity Electrode Conductivity', 14, 1, 'general-calculator', '1413', 2000, '0.1', '?S', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(634, 'Ion Selectivity Electrode Temperature', 14, 1, 'general-calculator', '20~30', 2000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(635, 'Stability Chamber Temperature', 14, 1, 'general-calculator', '20~40', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(636, 'Stability Chamber Humidity', 14, 1, 'general-calculator', '30~70', 5000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(637, 'Legger Presser Tempeature', 14, 1, 'general-calculator', '50~250', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(638, 'Legger Presser Pressure', 14, 1, 'general-calculator', '0~10', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(639, 'Legger Presser Time', 14, 1, 'general-calculator', '18', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(640, 'COD Reactor Temperature', 14, 1, 'general-calculator', '50~150', 5000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(641, 'COD Reactor Time', 14, 1, 'general-calculator', '600~7200', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(642, 'Kalix Tube Filling & Sealing Machine Pressure', 14, 1, 'general-calculator', '0~4', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(643, 'Kalix Tube Filling & Sealing Machine Temperature', 14, 1, 'general-calculator', '40~300', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(644, 'Centrifuge Machine RPM', 14, 1, 'general-calculator', '50~5000', 5000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(645, 'Centrifuge Machine Time', 14, 1, 'general-calculator', '300~3600', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(646, 'Dissolution Test Apparatus RPM', 14, 1, 'general-calculator', '30~100', 5000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(647, 'Dissolution Test Apparatus External Temperature', 14, 1, 'general-calculator', '36~38', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(648, 'Dissolution Test Apparatus Internal Temperature', 14, 1, 'general-calculator', '36~38', 5000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(649, 'Dissolution Test Apparatus Internal Time', 14, 1, 'general-calculator', '300~3600', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(650, 'Multigas Detector Oxygen (O2)', 14, 1, 'general-calculator', '20', 5000, '0.1', '%', 'NA', 'site', 'no', NULL, NULL, NULL),
(651, 'Multigas Detector Methene (LEL)', 14, 1, 'general-calculator', '50', 5000, '0.1', '%', 'NA', 'lab', 'no', NULL, NULL, NULL),
(652, 'Multigas Detector Carbon Monoxide (CO)', 14, 1, 'general-calculator', '100', 5000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(653, 'Multigas Detector Hydrogen Sulfide (H2S)', 14, 1, 'general-calculator', '25', 5000, '0.1', 'ppm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(654, 'Friability Test Apparatus RPM', 14, 1, 'general-calculator', '25', 5000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(655, 'Friability Test Apparatus Time', 14, 1, 'general-calculator', '240', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(656, 'Tap Density Meter Count', 14, 1, 'general-calculator', '500', 5000, '0.1', 'Count', 'NA', 'site', 'no', NULL, NULL, NULL),
(657, 'Tap Density Meter Time', 14, 1, 'general-calculator', '100', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(658, 'Viscometer Meter Viscosity', 14, 1, 'general-calculator', '70~2650', 5000, '0.1', 'Cp', 'NA', 'site', 'no', NULL, NULL, NULL),
(659, 'Viscometer Meter RPM', 14, 1, 'general-calculator', '5~100', 5000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(660, 'Viscometer Meter Time', 14, 1, 'general-calculator', '60~300', 5000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(661, 'Viscometer Meter Temperature', 14, 1, 'general-calculator', '20~30', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(662, 'Insulation Tester Resistance', 14, 1, 'general-calculator', '10M?~1G?', 5000, '0.1', '?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(663, 'Insulation Tester AC Voltage', 14, 1, 'general-calculator', '100~600', 5000, '0.1', 'AC Volt', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(664, 'Insulation Tester DC Voltage', 14, 1, 'general-calculator', '100~600', 5000, '0.1', 'DC Volt', 'NA', 'site', 'yes', NULL, NULL, NULL),
(665, 'ICI Pilling & Snagging Tester Length Left', 14, 1, 'general-calculator', '230', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(666, 'ICI Pilling & Snagging Tester Length Right', 14, 1, 'general-calculator', '230', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(667, 'ICI Pilling & Snagging Tester Width Left', 14, 1, 'general-calculator', '230', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(668, 'ICI Pilling & Snagging Tester Width Right', 14, 1, 'general-calculator', '230', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(669, 'ICI Pilling & Snagging Tester Depth Left', 14, 1, 'general-calculator', '236', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(670, 'ICI Pilling & Snagging Tester Depth Right', 14, 1, 'general-calculator', '236', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(671, 'ICI Pilling & Snagging Tester RPM', 14, 1, 'general-calculator', '60', 5000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(672, 'Random Tumble Pilling Tester Diameter', 14, 1, 'general-calculator', '143', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(673, 'Random Tumble Pilling Tester Depth', 14, 1, 'general-calculator', '152', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(674, 'Random Tumble Pilling Tester Time', 14, 1, 'general-calculator', '1800', 5000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(675, 'Bio Safety Cabinet Air Velosity', 14, 1, 'general-calculator', '0.1~3', 5000, '0.1', 'm/s', 'NA', 'lab', 'no', NULL, NULL, NULL),
(676, 'Bio Safety Cabinet LUX', 14, 1, 'general-calculator', '250~350', 5000, '0.1', 'LUX', 'NA', 'site', 'no', NULL, NULL, NULL),
(677, 'Bio Safety Cabinet UV Light', 14, 1, 'general-calculator', '0.01~0.02', 5000, '0.1', 'mW/cm2', 'NA', 'lab', 'no', NULL, NULL, NULL),
(678, 'Bio Safety Cabinet Dimension', 14, 1, 'general-calculator', '60~100', 5000, '0.1', 'cm', 'NA', 'site', 'no', NULL, NULL, NULL),
(679, 'RTD Loop Calibrator DC Current', 14, 1, 'general-calculator', '4~22', 5000, '0.1', 'mA', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(680, 'RTD Loop Calibrator Resistance (Source Mode)', 14, 1, 'general-calculator', '0~4000', 5000, '0.1', '?', 'NA', 'site', 'yes', NULL, NULL, NULL),
(681, 'RTD Loop Calibrator Resistance (Measure Mode)', 14, 1, 'general-calculator', '0~4000', 5000, '0.1', 'k?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(682, 'RTD Loop Calibrator Resistance (Source Mode)', 14, 1, 'general-calculator', '-200~800', 5000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(683, 'RTD Loop Calibrator Resistance (Measure Mode)', 14, 1, 'general-calculator', '-200~800', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(684, 'Whirling Psychrometer Dry Bulb', 14, 1, 'general-calculator', '20~50', 5000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(685, 'Whirling Psychrometer Wet Bulb', 14, 1, 'general-calculator', '20~50', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(686, 'Friability Tester RPM', 14, 1, 'general-calculator', '25', 5000, '0.1', 'RPM', 'NA', 'site', 'yes', NULL, NULL, NULL),
(687, 'Friability Tester Time', 14, 1, 'general-calculator', '240', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(688, 'High Shear Wet Mixer Speed', 14, 1, 'general-calculator', '10~60', 5000, '0.1', 'RPM', 'NA', 'site', 'yes', NULL, NULL, NULL),
(689, 'High Shear Wet Mixer Time', 14, 1, 'general-calculator', '600~1800', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(690, 'Penetrometer Needle Stem Length', 14, 1, 'general-calculator', '38', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(691, 'Penetrometer Main Needle Length', 14, 1, 'general-calculator', '36', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(692, 'Penetrometer Needle Tip (Taper)', 14, 1, 'general-calculator', '5.6', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(693, 'Penetrometer Needle Stem Thickness', 14, 1, 'general-calculator', '3.17', 5000, '0.1', 'mm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(694, 'Penetrometer Tip Thickness', 14, 1, 'general-calculator', '0.15', 5000, '0.1', 'mm', 'NA', 'site', 'no', NULL, NULL, NULL),
(695, 'Penetrometer Disk Weight', 14, 1, 'general-calculator', '50~100', 5000, '0.1', 'g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(696, 'Penetrometer Needle Weight', 14, 1, 'general-calculator', '2.52', 5000, '0.1', 'g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(697, 'Earth Tester Resistance Measurement', 14, 1, 'general-calculator', '0~2000', 5000, '0.1', '?', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(698, 'Earth Tester AC Volt @ 50Hz Measurement', 14, 1, 'general-calculator', '0~190', 5000, '0.1', 'V', 'NA', 'site', 'yes', NULL, NULL, NULL),
(699, 'Washing Tank Temperature', 14, 1, 'general-calculator', '0~160', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(700, 'Washing Tank Speed', 14, 1, 'general-calculator', '100~200', 5000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(701, 'Washing Tank Time', 14, 1, 'general-calculator', '300~600', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(702, 'Tumble Dryer Temperature', 14, 1, 'general-calculator', '0~100', 5000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(703, 'Tumble Dryer Speed', 14, 1, 'general-calculator', '20~40', 5000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(704, 'Tumble Dryer Time', 14, 1, 'general-calculator', '300~600', 5000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(705, 'Centrifuge Speed', 14, 1, 'general-calculator', '500~2000', 5000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(706, 'Centrifuge Time', 14, 1, 'general-calculator', '600~3600', 5000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(707, 'Barometer Temperature', 14, 1, 'general-calculator', '15~40', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(708, 'Barometer Humidity', 14, 1, 'general-calculator', '30~70', 5000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(709, 'Barometer Pressure', 14, 1, 'general-calculator', '980~1033', 5000, '0.1', 'hPa', 'NA', 'lab', 'no', NULL, NULL, NULL),
(710, 'Oven Temperature', 14, 1, 'general-calculator', '50~300', 5000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(711, 'Oven Time', 14, 1, 'general-calculator', '600~10800', 5000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(712, 'Gerber Machine RPM', 14, 1, 'general-calculator', '1100', 5000, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(713, 'Gerber Machine Temperature', 14, 1, 'general-calculator', '65', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(714, 'Gerber Machine Time', 14, 1, 'general-calculator', '300~900', 5000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(715, 'Double Cone Mixer Speed', 14, 1, 'general-calculator', '10~30', 5000, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(716, 'Double Cone Mixer Time', 14, 1, 'general-calculator', '60~3600', 5000, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(717, 'Gauss Meter', 15, 1, 'general-calculator', 'DC 0~1000 ', 1000, '0.1', 'V', 'NA', 'lab', 'no', NULL, NULL, NULL),
(718, 'Metal Detector Portable', 15, 1, 'general-calculator', 'AC 0~1000 ', 1000, '0.1', 'V', 'NA', 'site', 'no', NULL, NULL, NULL),
(719, 'Metal Detecting Machine', 15, 1, 'general-calculator', 'DC 0~10 ', 1000, '0.1', 'A', 'NA', 'lab', 'no', NULL, NULL, NULL),
(720, 'Magnetic Trap', 15, 1, 'general-calculator', 'AC 0~10', 1000, '0.1', 'A', 'NA', 'site', 'no', NULL, NULL, NULL),
(721, 'Cable / Pipe Locator', 15, 1, 'general-calculator', '0~50 M', 1000, '0.1', 'Ohm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(722, 'Magnetic Yoke', 15, 1, 'general-calculator', '10', 1000, '0.1', 'kg ', 'NA', 'site', 'no', NULL, NULL, NULL),
(723, 'Iron Loss Tester', 15, 1, 'general-calculator', '0.5~1.9', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(724, 'Material Storage Rack', 16, 1, 'general-calculator', '0.5~1.10', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(725, 'Over Head Load Crane', 16, 1, 'general-calculator', '0.5~1.11', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(726, 'Shackle', 16, 1, 'general-calculator', '0.5~1.12', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(727, 'Wire Sling', 16, 1, 'general-calculator', '0.5~1.13', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(728, 'Storage Vessel', 16, 1, 'general-calculator', '0.5~1.14', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(729, 'Man Basket', 16, 1, 'general-calculator', '0.5~1.15', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(730, 'Fork Lifter', 16, 1, 'general-calculator', '0.5~1.16', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(731, 'Safty Harness with Lanyard', 16, 1, 'general-calculator', '0.5~1.17', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(732, 'Fall Protection Rope', 16, 1, 'general-calculator', '0.5~1.18', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(733, 'Cargo Lift', 16, 1, 'general-calculator', '0.5~1.19', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(734, 'Distillate Water Tank   (3 Ton)', 16, 1, 'general-calculator', '0.5~1.20', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(735, 'Weekly Water   (70 Ton)', 16, 1, 'general-calculator', '0.5~1.21', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(736, 'Hot Water Tank   (27 Ton)', 16, 1, 'general-calculator', '0.5~1.22', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(737, 'Recovery Tank   (35 Ton)', 16, 1, 'general-calculator', '0.5~1.23', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(738, 'Caustic Tank   (35 Ton)', 16, 1, 'general-calculator', '0.5~1.24', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(739, 'Weekly Tank   (50 Ton)', 16, 1, 'general-calculator', '0.5~1.25', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(740, 'Condensate Tank   (9 Ton)', 16, 1, 'general-calculator', '0.5~1.26', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(741, 'Wire Rope Sling', 16, 1, 'general-calculator', '0.5~1.27', 1000, '0.1', 'T', 'NA', 'lab', 'no', NULL, NULL, NULL),
(742, 'Chain Block', 16, 1, 'general-calculator', '0.5~1.28', 1000, '0.1', 'T', 'NA', 'site', 'no', NULL, NULL, NULL),
(743, 'Gauge Analogue', 17, 1, 'general-calculator', '-1.0~20.0 ', 1500, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(744, 'Gauge Analogue', 17, 1, 'general-calculator', '0~700', 2000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(745, 'Gauge Analogue', 17, 1, 'general-calculator', '0~1200', 2500, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(746, 'Gauge Analogue', 17, 1, 'general-calculator', '0~1700', 4500, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(747, 'Gauge Test ', 17, 1, 'general-calculator', '-1.0~20.0 ', 2500, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(748, 'Gauge Test ', 17, 1, 'general-calculator', '0~700', 3500, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(749, 'Gauge Test ', 17, 1, 'general-calculator', '0~1200', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(750, 'Gauge Test ', 17, 1, 'general-calculator', '0~1700', 7500, '0.1', 'bar', 'NA', 'site', 'no', NULL, NULL, NULL),
(751, 'Gauge Digital ', 17, 1, 'general-calculator', '-1.0~20.0 ', 3000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(752, 'Gauge Digital ', 17, 1, 'general-calculator', '0~700', 4000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(753, 'Gauge Digital ', 17, 1, 'general-calculator', '0~1200', 6000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(754, 'Gauge Digital ', 17, 1, 'general-calculator', '0~1700', 8000, '0.1', 'bar', 'NA', 'site', 'no', NULL, NULL, NULL),
(755, 'Transducer', 17, 1, 'general-calculator', '-1~700 ', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(756, 'Transmitter', 17, 1, 'general-calculator', '-1~700 ', 7500, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(757, 'Pressure Switch', 17, 1, 'general-calculator', '-1~700 ', 4000, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(758, 'Control Valve', 17, 1, 'general-calculator', '2', 15000, '0.1', 'bar', 'NA', 'site', 'no', NULL, NULL, NULL),
(759, 'Relief Valve  ? 6 \" Dia', 17, 1, 'general-calculator', '0 ~ 400 ', 6000, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(760, 'Relief Valve  ? 12 \" Dia', 17, 1, 'general-calculator', '0~ 100', 10000, '0.1', 'bar', 'NA', 'site', 'no', NULL, NULL, NULL),
(761, 'Manometers', 17, 1, 'general-calculator', '-1 ~ 3 ', 1000, '0.1', 'InchH2O', 'NA', 'lab', 'no', NULL, NULL, NULL),
(762, 'Guage Magnihelic', 17, 1, 'general-calculator', '-1 ~ 3 ', 1000, '0.1', 'InchH2O', 'NA', 'site', 'no', NULL, NULL, NULL),
(763, 'Chart Recorder 2 Pen', 17, 1, 'general-calculator', '-1~700 ', 8000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(764, 'Chart Recorder 2 Pen', 17, 1, 'general-calculator', '0~1200', 12000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(765, 'Hydro Testing', 17, 1, 'general-calculator', '0~400', 7500, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(766, 'Calibrator Digital', 17, 1, 'general-calculator', '-1.0~20.0 ', 6000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL);
INSERT INTO `capabilities` (`id`, `name`, `parameter`, `procedure`, `calculator`, `range`, `price`, `accuracy`, `unit`, `remarks`, `location`, `accredited`, `deleted_at`, `created_at`, `updated_at`) VALUES
(767, 'Piston Gauges', 17, 1, 'general-calculator', '0~700', 18000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(768, 'Dead Weights Tester', 17, 1, 'general-calculator', '0~1200', 30000, '0.1', 'bar', 'NA', 'site', 'no', NULL, NULL, NULL),
(769, 'Baro Meter', 17, 1, 'general-calculator', '800~1100', 3000, '0.1', 'mbar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(770, 'Weight Indicators', 17, 1, 'general-calculator', '0~700', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(771, 'Torque Indicators', 17, 1, 'general-calculator', '0~700', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(772, 'Video Jet Printer', 17, 1, 'general-calculator', '0~10', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(773, 'Pressure Meter', 17, 1, 'general-calculator', '0~20', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(774, 'Pressure Gauge', 17, 1, 'general-calculator', '0~100', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(775, 'Vacuum Gauge', 17, 1, 'general-calculator', '0~-1', 5000, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(776, 'Pressure Gauge', 17, 1, 'general-calculator', '0~14', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(777, 'Vacuum Pump', 17, 1, 'general-calculator', '0~-1', 5000, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(778, 'Pressure Gauge', 17, 1, 'general-calculator', '0~2.4', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(779, 'Pressure Gauge', 17, 1, 'general-calculator', '0~16', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(780, 'Leak Test Apparatus', 17, 1, 'general-calculator', '0~-1', 5000, '0.1', 'bar', 'NA', 'site', 'no', NULL, NULL, NULL),
(781, 'Pressure Gauge', 17, 1, 'general-calculator', '0~345', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(782, 'Pressure Gauge', 17, 1, 'general-calculator', '0~1100', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(783, 'Pressure Gauge', 17, 1, 'general-calculator', '0~1034', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(784, 'Pressure Transmitter', 17, 1, 'general-calculator', '0~10', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(785, 'Pressure Sensor', 17, 1, 'general-calculator', '930~1050', 5000, '0.1', 'mbar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(786, 'Differential Pressure Sensor', 17, 1, 'general-calculator', '0~5', 5000, '0.1', 'mbar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(787, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~1.6', 5000, '0.1', 'Kg/cm2', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(788, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~10', 5000, '0.1', 'Kg/cm2', 'NA', 'site', 'yes', NULL, NULL, NULL),
(789, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~25', 5000, '0.1', 'Kg/cm2', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(790, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~60', 5000, '0.1', 'Kg/cm2', 'NA', 'site', 'yes', NULL, NULL, NULL),
(791, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~100', 5000, '0.1', 'Kg/cm2', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(792, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~250', 5000, '0.1', 'Kg/cm2', 'NA', 'site', 'yes', NULL, NULL, NULL),
(793, 'Test Pressure Gauge', 17, 1, 'general-calculator', '0~400', 5000, '0.1', 'Kg/cm2', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(794, 'Pressure Gauge', 17, 1, 'general-calculator', '0~700', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(795, 'Pressure Relief Valve', 17, 1, 'general-calculator', '10', 5000, '0.1', 'bar', 'NA', 'lab', 'no', NULL, NULL, NULL),
(796, 'Weight Indicator', 17, 1, 'general-calculator', '0~1000', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(797, 'Pressure Gauge', 17, 1, 'general-calculator', '0~1200', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(798, 'Air Compressor', 17, 1, 'general-calculator', '12', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(799, 'Pressure Gauge', 17, 1, 'general-calculator', '0~250', 5000, '0.1', 'bar', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(800, 'Pressure Gauge', 17, 1, 'general-calculator', '0~1', 5000, '0.1', 'bar', 'NA', 'site', 'yes', NULL, NULL, NULL),
(801, 'Flow Transmitter', 17, 1, 'general-calculator', '0~4000', 5000, '0.1', 'mmH2O', 'NA', 'lab', 'no', NULL, NULL, NULL),
(802, 'Tyre Pressure Gauge', 17, 1, 'general-calculator', '0~150', 5000, '0.1', 'psi', 'NA', 'site', 'yes', NULL, NULL, NULL),
(803, 'BP Apparatus', 17, 1, 'general-calculator', '0~300', 5000, '0.1', 'mmHg', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(804, 'Digital BP Apparatus', 17, 1, 'general-calculator', '0~210', 5000, '0.1', 'mmHg', 'NA', 'site', 'yes', NULL, NULL, NULL),
(805, 'pH Meter', 18, 1, 'general-calculator', '4~10', 4000, '0.1', 'pH', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(806, 'ORP Meter', 18, 1, 'general-calculator', '470', 4000, '0.1', 'mV', 'NA', 'site', 'no', NULL, NULL, NULL),
(807, 'Photometer', 19, 1, 'general-calculator', '40', 3000, '0.1', 'HRC', 'NA', 'lab', 'no', NULL, NULL, NULL),
(808, 'Spectrophotometer UV/Vis', 19, 19, 'spectrophotometer-calculator', '0~100', 4000, '0.1', '40', 'NA', 'site', 'yes', NULL, NULL, '2021-03-26 11:17:50'),
(809, 'Colori Meter', 19, 1, 'general-calculator', '0~100', 4000, '0.1', 'D', 'NA', 'lab', 'no', NULL, NULL, NULL),
(810, 'Flame Photometer (Sodium & Potassium Ion)', 19, 1, 'general-calculator', '5~15', 4000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(811, 'Whitness Meter', 19, 1, 'general-calculator', '5~16', 4000, '0.1', 'ppm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(812, 'Gloss Meter', 19, 1, 'general-calculator', '5~17', 4000, '0.1', 'ppm', 'NA', 'site', 'no', NULL, NULL, NULL),
(813, 'Tintometer', 19, 1, 'general-calculator', '5~18', 4000, '0.1', 'ppm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(814, 'Multiparameter Bench Photometer', 19, 1, 'general-calculator', '5~18', 4000, '0.1', '', 'NA', 'site', 'no', NULL, NULL, NULL),
(815, 'Polarimeter', 20, 1, 'general-calculator', '-180? to 180?', 4000, '0.1', 'Deg Specific Rotation', 'NA', 'lab', 'no', NULL, NULL, NULL),
(816, 'Polarimeter', 20, 1, 'general-calculator', '0 to 180?', 4000, '0.1', 'Deg Optical Rotation', 'NA', 'site', 'no', NULL, NULL, NULL),
(817, 'Polarimeter', 20, 1, 'general-calculator', '20 to 30', 4000, '0.1', '?C', 'NA', 'lab', 'no', NULL, NULL, NULL),
(818, 'Tachometer Optical', 21, 1, 'general-calculator', '0.1~99999', 2500, '0.1', 'RPM', 'NA', 'site', 'yes', NULL, NULL, NULL),
(819, 'Tachometer Contact', 21, 1, 'general-calculator', '0.1~10000', 2500, '0.1', 'RPM', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(820, 'Stroboscope', 21, 1, 'general-calculator', '0.1~99999', 2500, '0.1', 'RPM', 'NA', 'site', 'yes', NULL, NULL, NULL),
(821, 'Tachometer Reed ', 21, 1, 'general-calculator', '1~300', 2500, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(822, 'Centrifuge Machine', 21, 1, 'general-calculator', '0.1~5000', 2500, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(823, 'Motor', 21, 1, 'general-calculator', '0.1~10000', 2500, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(824, 'Batch Counter', 21, 1, 'general-calculator', '10~100', 2500, '0.1', 'Counts', 'NA', 'site', 'no', NULL, NULL, NULL),
(825, 'Cube Mixer', 21, 1, 'general-calculator', '6~16', 2500, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(826, 'Oscillating Granulator', 21, 1, 'general-calculator', '10~60', 2500, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(827, 'Cursher Machine', 21, 1, 'general-calculator', '500~3600', 2500, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(828, 'Vortex Mixer', 21, 1, 'general-calculator', '100~3000', 2500, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(829, 'Centrigugal Machine', 21, 1, 'general-calculator', '500~5000', 2500, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(830, 'Optical Tachometer', 21, 1, 'general-calculator', '50~30000', 2500, '0.1', 'RPM', 'NA', 'site', 'yes', NULL, NULL, NULL),
(831, 'Hydro Spinner', 21, 1, 'general-calculator', '100~750', 2500, '0.1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, NULL),
(832, 'Digital Inductive Timing Light', 21, 1, 'general-calculator', '100~6000', 2500, '0.1', 'RPM', 'NA', 'site', 'no', NULL, NULL, NULL),
(833, 'Refrectometer', 22, 1, 'general-calculator', '0~1.333', 4000, '0.1', 'Ratio', 'NA', 'lab', 'no', NULL, NULL, NULL),
(834, 'Refrectometer', 22, 1, 'general-calculator', '5% to 26%', 0, '0.1', '% Brix', 'NA', 'site', 'no', NULL, NULL, NULL),
(835, 'Hygrometer Whirling', 23, 1, 'general-calculator', '20~70', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(836, 'Hygrometer Graph', 23, 1, 'general-calculator', '20~70', 2000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(837, 'Dew Point Meter', 23, 1, 'general-calculator', '20~70', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(838, 'Stability Chambers', 23, 1, 'general-calculator', '20~70', 2000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(839, 'Dry Wet Hygrometer', 23, 1, 'general-calculator', '20~70', 2000, '0.1', '%RH', 'NA', 'lab', 'no', NULL, NULL, NULL),
(840, 'Whirling Psychrometer', 23, 1, 'general-calculator', '1~60', 2000, '0.1', '%RH', 'NA', 'site', 'no', NULL, NULL, NULL),
(841, 'Density Meters', 24, 1, 'general-calculator', '1~1000', 1500, '0.1', 'KG/CM3', 'NA', 'lab', 'no', NULL, NULL, NULL),
(842, 'Hydrometers', 24, 1, 'general-calculator', '0.60~1.50', 2500, '0.1', 'Ratio', 'NA', 'site', 'no', NULL, NULL, NULL),
(843, 'Baum Meter', 24, 1, 'general-calculator', '0~70', 2500, '0.1', 'B?', 'NA', 'lab', 'no', NULL, NULL, NULL),
(844, 'Hydrometer', 24, 1, 'general-calculator', '0.7~1', 2500, '0.1', 'g/mL', 'NA', 'site', 'no', NULL, NULL, NULL),
(845, 'Fluid Density Balance', 24, 1, 'general-calculator', '6~22', 2500, '0.1', 'lb/gal', 'NA', 'lab', 'no', NULL, NULL, NULL),
(846, 'Hydrometer', 24, 1, 'general-calculator', '0.5~1.2', 2500, '0.1', 'g/mL', 'NA', 'site', 'no', NULL, NULL, NULL),
(847, 'Hydrometer', 24, 1, 'general-calculator', '1.0~1.2', 2500, '0.1', 'g/mL', 'NA', 'lab', 'no', NULL, NULL, NULL),
(848, 'Odometer', 25, 1, 'general-calculator', '0.1~220', 2500, '0.1', 'kM/H', 'NA', 'site', 'no', NULL, NULL, NULL),
(849, 'Speed Gun', 25, 1, 'general-calculator', '0.1~220', 2500, '0.1', 'kM/H', 'NA', 'lab', 'no', NULL, NULL, NULL),
(850, 'Air Speed Indicator', 25, 1, 'general-calculator', '0.1~750', 2500, '0.1', 'kM/H', 'NA', 'site', 'no', NULL, NULL, NULL),
(851, 'Wind Speed', 25, 1, 'general-calculator', '0.1~20', 2500, '0.1', 'm/Sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(852, 'Anemometer Vane', 25, 1, 'general-calculator', '0.1~20', 2500, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(853, 'Anemometer Hot Wire', 25, 1, 'general-calculator', '0.1~20', 2500, '0.1', 'm/Sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(854, 'Hot Wire Anemometer', 25, 1, 'general-calculator', '0.1~20', 0, '0.1', 'm/Sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(855, 'Sound Level Meter', 26, 1, 'general-calculator', '20~114', 2500, '0.1', 'dB', 'NA', 'lab', 'no', NULL, NULL, NULL),
(856, 'Sound Level Calibrator', 26, 1, 'general-calculator', '20~114', 2500, '0.1', 'dB', 'NA', 'site', 'no', NULL, NULL, NULL),
(857, 'Noise Survey', 26, 1, 'general-calculator', '20~114', 2500, '0.1', 'dB', 'NA', 'lab', 'no', NULL, NULL, NULL),
(858, 'Liquid in Glass Thermometer', 27, 1, 'general-calculator', '-20~400', 2500, '0.1', '?C', 'NA', 'site', 'no', NULL, NULL, NULL),
(859, 'Thermometer Mechanical', 27, 1, 'general-calculator', '-20~650', 2500, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(860, 'Thermal Resistance Detector', 27, 1, 'general-calculator', '-20~650', 4000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(861, 'Thermcouple J, K, T', 27, 1, 'general-calculator', '-20~650', 4000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(862, 'Thermcouple R & S', 27, 1, 'general-calculator', '300~1700', 8500, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(863, 'Digital Thermometer', 27, 1, 'general-calculator', '-20~650', 6000, '0.1', '1', 'NA', 'lab', 'yes', NULL, NULL, '2021-02-22 10:48:24'),
(864, 'IR Thermometer', 27, 1, 'general-calculator', '-20~650', 4500, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(865, 'IR Thermometer High Range', 27, 1, 'general-calculator', '300~2500', 8000, '0.1', '?C', 'NA', 'lab', 'no', NULL, NULL, NULL),
(866, 'Temperature Controller', 27, 1, 'general-calculator', '-200~1200', 4500, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(867, 'Chart Recorder 2 Pen', 27, 1, 'general-calculator', '-20~650', 6000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(868, 'Chart Recorder 6 Pen', 27, 1, 'general-calculator', '-20~650', 10000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(869, 'Chart Recorder 12 Pen', 27, 1, 'general-calculator', '-20~650', 15000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(870, 'Data Logger 2 Channel', 27, 1, 'general-calculator', '-20~650', 6000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(871, 'Data Logger 6 Channel', 27, 1, 'general-calculator', '-20~650', 10000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(872, 'Data Logger 12 Channel', 27, 1, 'general-calculator', '-20~650', 15000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(873, 'Thermohygrometer', 27, 1, 'general-calculator', '-20 ~ 50', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, '2020-11-26 16:33:23'),
(874, 'Data Logger', 27, 1, 'general-calculator', '-20 ~ 50         ', 3000, '0.1', '?C                         ', 'NA', 'site', 'yes', NULL, NULL, NULL),
(875, 'Bath', 27, 1, 'general-calculator', '-20~650', 4000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(876, 'Hot Plate', 27, 1, 'general-calculator', '-20~650', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(877, 'Dry Block Calibrator', 27, 1, 'general-calculator', '-20~650', 7500, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(878, 'Melting Point Apparatus', 27, 1, 'general-calculator', '50~300', 0, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(879, 'Incubator', 27, 1, 'general-calculator', '-20~650', 6000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(880, 'Oven', 27, 1, 'general-calculator', '-20~650', 6000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(881, 'Furnace', 27, 1, 'general-calculator', '300~1200', 5000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(882, 'Refrigrator', 27, 1, 'general-calculator', '-20~20', 6000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(883, 'Switch', 27, 1, 'general-calculator', '-20~650', 4000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(884, 'Transmitter', 27, 1, 'general-calculator', '-20~650', 6500, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(885, 'Hygrometer Whirling', 27, 1, 'general-calculator', '0~50', 3000, '0.1', '?C', 'NA', 'lab', 'no', NULL, NULL, NULL),
(886, 'Hygrometer Graph', 27, 1, 'general-calculator', '0~50', 3000, '0.1', '?C', 'NA', 'site', 'no', NULL, NULL, NULL),
(887, 'Dew Point Meter', 27, 1, 'general-calculator', '0~50', 3000, '0.1', '?C', 'NA', 'lab', 'no', NULL, NULL, NULL),
(888, 'Water Bath', 27, 1, 'general-calculator', '30~95', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(889, 'Dry Heat Sterlizer', 27, 1, 'general-calculator', '100~300', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(890, 'BOD Incubator', 27, 1, 'general-calculator', '20~40', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(891, 'Vissichiller Refrigerator', 27, 1, 'general-calculator', '2~8', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(892, 'Rotavapor Water bath', 27, 1, 'general-calculator', '40~60', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(893, 'Digestor', 27, 1, 'general-calculator', '50~500', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(894, 'Dry Block Heater', 27, 1, 'general-calculator', '40~100', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(895, 'Electric Furnace', 27, 1, 'general-calculator', '300~1000', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(896, 'Dry & Wet Thermometer', 27, 1, 'general-calculator', '15~50', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(897, 'Dry Block Calibrator', 27, 1, 'general-calculator', '50~350', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(898, 'Temperature Gauge', 27, 1, 'general-calculator', '0~200', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(899, 'RTD', 27, 1, 'general-calculator', '20~100', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(900, 'AutoClave Sensors', 27, 1, 'general-calculator', '100~130', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(901, 'Water Bath', 27, 1, 'general-calculator', '30~105', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(902, 'Melt Flow Index', 27, 1, 'general-calculator', 'Amb~200', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(903, 'RTD Calibrator', 27, 1, 'general-calculator', '-20~300', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(904, 'Air Aging Oven', 27, 1, 'general-calculator', '50~150', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(905, 'Heavy Duty Oven', 27, 1, 'general-calculator', '50~200', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(906, 'Caravell Chiller', 27, 1, 'general-calculator', '2~8', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(907, 'Dry Block Calibrator', 27, 1, 'balance-calculator', '35~650', 3000, '0.1', '1', 'NA', 'lab', 'yes', NULL, NULL, '2021-02-22 12:46:12'),
(908, 'Thermocouples Measurement & Source', 27, 1, 'general-calculator', '-200~1600', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(909, 'Filled System Dial Thermometer', 27, 1, 'general-calculator', '0~600', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(910, 'Filled System Dial Thermometer', 27, 1, 'general-calculator', '0~350', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(911, 'Filled System Dial Thermometer', 27, 1, 'general-calculator', '0~500', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(912, 'Hot Plate', 27, 1, 'general-calculator', '50~350', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(913, 'Dial Thermometer', 27, 1, 'general-calculator', '0~600', 3000, '0.1', '?C', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(914, 'Melting Point Apparatus', 27, 1, 'general-calculator', '50~300', 3000, '0.1', '?C', 'NA', 'site', 'yes', NULL, NULL, NULL),
(915, 'Watch', 28, 1, 'general-calculator', '1~10', 2500, '0.1', 'Nm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(916, 'Screw Driver', 28, 1, 'general-calculator', '1~20', 3000, '0.1', 'Nm', 'NA', 'site', 'no', NULL, NULL, NULL),
(917, 'Wrenches', 28, 1, 'general-calculator', '10~100', 3500, '0.1', 'Nm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(918, 'Wrenches', 28, 1, 'general-calculator', '30~300', 4500, '0.1', 'Nm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(919, 'Wrenches', 28, 1, 'general-calculator', '300~600', 5000, '0.1', 'Nm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(920, 'Wrenches', 28, 1, 'general-calculator', '600~1200', 6000, '0.1', 'Nm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(921, 'Indicator/Meter', 28, 1, 'general-calculator', '10~100', 4000, '0.1', 'Nm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(922, 'Tong Gauge', 28, 1, 'general-calculator', '200~20000', 10000, '0.1', 'Ft/Lbs', 'NA', 'site', 'yes', NULL, NULL, NULL),
(923, 'Torque Wrench Testers', 28, 1, 'general-calculator', '10~400', 7500, '0.1', 'Nm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(924, 'Torque Wrench Testers', 28, 1, 'general-calculator', '30~1500', 12000, '0.1', 'Nm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(925, 'Bottle Cap Torque Testers', 28, 1, 'general-calculator', '5~25', 12000, '0.1', 'Nm', 'NA', 'lab', 'no', NULL, NULL, NULL),
(926, 'Torque Wrench', 28, 1, 'general-calculator', '8~55', 12000, '0.1', 'Nm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(927, 'Torque Wrench', 28, 1, 'general-calculator', '20~100', 12000, '0.1', 'Nm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(928, 'Torque Wrench', 28, 1, 'general-calculator', '80~400', 12000, '0.1', 'Nm', 'NA', 'site', 'yes', NULL, NULL, NULL),
(929, 'Torque Wrench', 28, 1, 'general-calculator', '160~800', 12000, '0.1', 'Nm', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(930, 'Timer', 29, 1, 'general-calculator', '0~300', 800, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(931, 'Stop Watch', 29, 1, 'general-calculator', '0~600', 1000, '0.1', 'sec', 'NA', 'lab', 'no', NULL, NULL, NULL),
(932, 'Master Timer', 29, 1, 'general-calculator', '0~3600', 0, '0.1', 'sec', 'NA', 'site', 'no', NULL, NULL, NULL),
(933, 'Turbidity Meter', 30, 1, 'general-calculator', '0~2000', 8500, '0.1', 'NTU', 'NA', 'lab', 'no', NULL, NULL, NULL),
(934, 'Turbidity Meter', 30, 1, 'general-calculator', '0~200', 8500, '0.1', 'NTU', 'NA', 'site', 'no', NULL, NULL, NULL),
(935, 'Flask', 31, 1, 'general-calculator', '10~1000', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(936, 'Measuring Cylinders', 31, 1, 'general-calculator', '10~1000', 1500, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(937, 'Measuring Cylinders', 31, 1, 'general-calculator', '10~2000', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(938, 'Beakers', 31, 1, 'general-calculator', '10~1000', 1200, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(939, 'Density Bottles', 31, 1, 'general-calculator', '1~100', 1000, '0.1', 'mL/g', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(940, 'Picnometers', 31, 1, 'general-calculator', '1~100', 1000, '0.1', 'mL/g', 'NA', 'site', 'yes', NULL, NULL, NULL),
(941, 'Micro Pipette', 31, 1, 'general-calculator', '0~1000', 2500, '0.1', '?L', 'NA', 'lab', 'no', NULL, NULL, NULL),
(942, 'Glass Pipettes', 31, 1, 'general-calculator', '0~100', 1500, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(943, 'Glass Burettes', 31, 1, 'general-calculator', '0~100', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(944, 'Auto Dispensor', 31, 1, 'general-calculator', '0~100', 1500, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(945, 'Fuel Dispensor', 31, 1, 'general-calculator', '1~50', 6000, '0.1', 'Litre', 'NA', 'lab', 'no', NULL, NULL, NULL),
(946, 'Mixing Vessels', 31, 1, 'general-calculator', '50~400', 6000, '0.1', 'Litre', 'NA', 'site', 'no', NULL, NULL, NULL),
(947, 'Volume Syringe', 31, 1, 'general-calculator', '1~5', 6000, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(948, 'Auto Measure', 31, 1, 'general-calculator', '1', 6000, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(949, 'Pipettor', 31, 1, 'general-calculator', '100~1000', 6000, '0.1', '?L', 'NA', 'lab', 'no', NULL, NULL, NULL),
(950, 'Picnometer', 31, 1, 'general-calculator', '100', 6000, '0.1', 'cm3', 'NA', 'site', 'yes', NULL, NULL, NULL),
(951, 'Fuel Dispensor', 31, 1, 'general-calculator', '1~5', 6000, '0.1', 'Litre', 'NA', 'lab', 'no', NULL, NULL, NULL),
(952, 'Picnometer', 31, 1, 'general-calculator', '25', 6000, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(953, 'Mixing Vessel', 31, 1, 'general-calculator', '50~300', 6000, '0.1', 'Ltr', 'NA', 'lab', 'no', NULL, NULL, NULL),
(954, 'Nassler Cylinder', 31, 18, 'volume-calculator', '100', 6000, '0.1', '39', 'NA', 'site', 'yes', NULL, NULL, '2021-02-26 13:24:45'),
(955, 'Specific Gravity Bottle', 31, 1, 'general-calculator', '25', 6000, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(956, 'Measuring Cylinder', 31, 1, 'general-calculator', '5', 6000, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(957, 'Measuring Cylinder', 31, 1, 'general-calculator', '10', 6000, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(958, 'Measuring Cylinder', 31, 1, 'general-calculator', '25', 6000, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(959, 'Measuring Cylinder', 31, 1, 'general-calculator', '50', 6000, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(960, 'Measuring Cylinder', 31, 1, 'general-calculator', '100', 6000, '0.1', 'mL', 'NA', 'site', 'yes', NULL, NULL, NULL),
(961, 'Measuring Cylinder', 31, 1, 'general-calculator', '250', 6000, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, NULL),
(962, 'Measuring Cylinder', 31, 1, 'general-calculator', '500', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-11-17 16:56:30'),
(963, 'Measuring Cylinder', 31, 1, 'general-calculator', '1000', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-11-17 16:55:12'),
(964, 'Volumetrc Flask', 31, 1, 'general-calculator', '10', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 08:02:50'),
(965, 'Volumetrc Flask', 31, 1, 'general-calculator', '20', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 08:00:09'),
(966, 'Volumetrc Flask', 31, 1, 'general-calculator', '25', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 07:56:55'),
(967, 'Volumetrc Flask', 31, 1, 'general-calculator', '50', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 07:53:36'),
(968, 'Volumetrc Flask', 31, 1, 'general-calculator', '100', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 07:52:32'),
(969, 'Volumetrc Flask', 31, 1, 'general-calculator', '250', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 07:44:58'),
(970, 'Volumetrc Flask', 31, 1, 'general-calculator', '500', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 07:40:41'),
(971, 'Volumetrc Flask', 31, 1, 'general-calculator', '1000', 1200, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 07:09:04'),
(972, 'Volumetrc Flask', 31, 1, 'general-calculator', '2000', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-11-17 16:58:22'),
(973, 'Measuring Pipette', 31, 1, 'general-calculator', '1', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:46:44'),
(974, 'Measuring Pipette', 31, 1, 'general-calculator', '2', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:46:12'),
(975, 'Measuring Pipette', 31, 1, 'general-calculator', '5', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:45:45'),
(976, 'Measuring Pipette', 31, 1, 'general-calculator', '10', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:45:17'),
(977, 'Measuring Pipette', 31, 1, 'general-calculator', '20', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:44:29'),
(978, 'Measuring Pipette', 31, 1, 'general-calculator', '25', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:43:50'),
(979, 'Bulb Pipette', 31, 1, 'general-calculator', '1', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:42:56'),
(980, 'Bulb Pipette', 31, 1, 'general-calculator', '2', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:42:27'),
(981, 'Bulb Pipette', 31, 1, 'general-calculator', '5', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:25:31'),
(982, 'Bulb Pipette', 31, 1, 'general-calculator', '10', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:24:59'),
(983, 'Bulb Pipette', 31, 1, 'general-calculator', '20', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:24:31'),
(984, 'Bulb Pipette', 31, 1, 'general-calculator', '25', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:23:54'),
(985, 'Bulb Pipette', 31, 1, 'general-calculator', '50', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:21:03'),
(986, 'Micro Pipette', 31, 1, 'general-calculator', '0~1000', 2000, '0.1', 'uL', 'NA', 'lab', 'no', NULL, NULL, '2020-10-24 06:16:06'),
(987, 'Digital Auto Dispensor', 31, 1, 'general-calculator', '100', 2000, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:11:51'),
(988, 'Micro Biological Air Sampler', 7, 1, 'general-calculator', '100 LPM', 4000, '0.1', 'LPM', 'NA', 'lab', 'no', NULL, NULL, '2020-10-24 06:08:26'),
(989, 'Digital Titrator', 31, 1, 'general-calculator', '10', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:04:54'),
(990, 'Specific Gravity Flask', 24, 1, 'general-calculator', '100', 1500, '0.1', 'mL', 'NA', 'lab', 'yes', NULL, NULL, '2020-10-24 06:02:03'),
(991, 'Vibration Meter', 32, 1, 'general-calculator', '200 mm/sec', 4000, '0.1', 'mm/sec', 'NA', 'lab', 'no', NULL, NULL, '2020-10-24 05:59:28'),
(992, 'Velocity Pickup', 32, 1, 'general-calculator', '200 mm/sec', 4000, '0.1', 'mm/sec', 'NA', 'lab', 'no', NULL, NULL, '2020-10-24 05:37:48'),
(993, 'Sieve Shaker', 32, 1, 'general-calculator', '25 mm @ 280 RPM', 6000, '0.1', 'mm & RPM', 'NA', 'lab', 'no', NULL, NULL, '2020-10-24 05:32:38'),
(994, 'Vibrators', 32, 1, 'general-calculator', '100 mm/Sec', 2500, '0.1', 'mm/Sec', 'NA', 'site', 'no', NULL, NULL, '2020-10-24 05:25:19'),
(995, 'Magnetic Stirer', 21, 1, 'general-calculator', '500', 2500, '1', 'RPM', 'NA', 'lab', 'no', NULL, NULL, '2020-10-24 05:20:34'),
(997, 'Coordinate Measuring Machine', 3, 1, 'general-calculator', '0~1000', 10000, '0.05', 'mm', 'Can be calibrated with Gauge Blocks Dim 001 and 25 Sphere Ball', 'site', 'no', NULL, '2020-10-11 07:14:12', '2020-10-24 05:13:04'),
(998, 'Air Particle Counter', 7, 1, 'general-calculator', '0', 3000, '3', 'Count', 'Only Zero Calibration with 0 Cal Filter Kit.', 'lab', 'no', NULL, '2020-10-20 08:15:29', '2020-11-17 15:44:46'),
(999, 'FTIR Spectrophotometer', 19, 1, 'general-calculator', '0.05~1', 8000, '0.02', '38', 'Calibration by Polysterene Films', 'site', 'no', NULL, '2020-12-06 17:31:38', '2021-01-04 08:09:03'),
(1000, 'Misc 5', 1, 1, 'general-calculator', '10-1000', 3000, '0.2', 'pkr', 'remarks', 'site', 'on', NULL, '2021-01-04 08:38:53', '2021-01-04 08:38:53'),
(1001, 'non listed accept', 1, 1, 'general-calculator', '20~100', 2300, '0.1', '1', 'remarks', 'site', 'on', NULL, '2021-01-10 06:21:44', '2021-01-10 06:21:44'),
(1002, 'non listed 01', 1, 1, 'general-calculator', '10~1000', 10000, '0.2', '1', 'remarks', 'site', 'on', NULL, '2021-02-03 09:59:46', '2021-02-03 09:59:46'),
(1003, 'testing', 1, 1, 'general-calculator', '10-100', 1000, '2000', '1', 'remarks', 'site', 'no', NULL, '2021-02-17 10:13:35', '2021-02-17 10:13:35'),
(1004, 'name', 1, 1, 'general-calculator', '1', 1, '1', '1', '1', 'site', 'yes', NULL, '2021-02-17 10:15:55', '2021-02-17 10:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `clauses`
--

CREATE TABLE `clauses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sop_id` int(11) NOT NULL,
  `title` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clauses`
--

INSERT INTO `clauses` (`id`, `sop_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Purpose', '<p><strong>1.0&nbsp;&nbsp;&nbsp; Purpose</strong></p>\r\n\r\n<p style=\"margin-left:27.0pt;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Management at AIMS believe that personnel education, training, experience and skill feeds into the requisite competence, which is cornerstone of validity and reliability of test and calibration results generated by a Lab.</p>\r\n\r\n<p style=\"margin-left:27.0pt;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This procedure addresses all aspects of personnel management, which are required to maintain requisite staff competency levels to cope with contracted requirements of our customers and regulatory bodies as defined in ISO/IEC 17025 standard.</p>', '2020-12-16 07:53:34', '2020-12-16 07:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `columns`
--

CREATE TABLE `columns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assets` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reg_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ntn` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_limit` int(11) NOT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_terms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prin_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prin_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prin_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pur_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pur_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pur_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `reg_name`, `ntn`, `region`, `address`, `credit_limit`, `customer_type`, `pay_terms`, `prin_name`, `prin_phone`, `prin_email`, `pur_name`, `pur_phone`, `pur_email`, `acc_name`, `acc_phone`, `acc_email`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1000, 'Pepsi-Cola International Ltd.', '0711631-4', '2', 'Plot no 413, Sunder Industrial Estate, Raiwand Road, Lahore', 0, 'credit', '60 days', 'Muhamad Asif Javed,Miss Nitasha Naseer,Khalil ur Rehman', '0300-8116826,0301-0141196,03011126073', 'asif.javed@pepsico.com,natasha.naseer@pepsico.com,khalilur.Rehman@pepsico.com', 'Khalid', '03016236150,', 'khalid@pepsico.com.pk', NULL, NULL, NULL, NULL, '2020-10-12 09:18:32', '2021-03-22 10:54:38'),
(1001, 'Million Classic Cable Ltd.', '7448506-1', '2', '35 Km,Raiwand Road,Opposite Sunder Estate,Gate No 3,Lahore', 0, 'credit', '30 days', 'Daniyal tariq', '0320-3070550', 'daniyal@millionclassic.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:23:03', '2020-10-12 09:23:03'),
(1002, 'Velosci Integrity&Safety Pakistan Ltd.', 'Null', '2', '207-A ,P Block,Gulbarg-III Lahore', 0, 'credit', '30 days', 'Junaid Hussain,,', '0333-5052730,,', 'junaid.hussain@velosiaims.com.pk,,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:26:59', '2021-03-22 10:51:40'),
(1003, 'SGS Pakistan Limited', '0712048-6', '2', 'H-3/3 Sector-5 korangi industrial area, karachi', 0, 'credit', '30 days', 'Mr. Adnan,Moin Ul Haq,Adnan Siddiqui', '03128203793,0322-8219035,0300-2600766', 'null,Moin.ulHaque@sgs.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:33:10', '2021-01-23 09:04:56'),
(1004, 'VIP Flight(Fixed Wing Air Craft)', '9023800-1', '2', 'Government of the Punjab,Lahore Int\'1 Airport(Old Terminal)', 0, 'credit', '30 days', 'Faheem Sattar', '0333-4270619', 'vipflt@brain.net.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:38:32', '2020-10-12 09:38:32'),
(1005, 'Pak Elektron LTD.', '2011386-2', '2', '14-Km,Ferozpur Road,Lahore.', 0, 'credit', '30 days', 'Mr.Ilyas,Mr.Tanveer', '0308-8885895,0333-4400306', 'Null,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:40:53', '2021-01-23 09:04:56'),
(1006, 'Sprint Oil and Gas Services', '2209880-1', '2', 'Plot No.5-B,Sector I 10/3 Islamabad, Pakistan', 0, 'credit', '30 days', 'Nabeel Ahmed,Mr.Rab nawaz', '0300-4017657,0300-8581631', 'anabeel@sprint-pk.com,Nill', 'Khalid Hussain', '0301 6236150-', 'khalid@pepsico.com.pk', NULL, NULL, NULL, NULL, '2020-10-12 09:44:11', '2021-01-23 09:04:56'),
(1007, 'Doctor Hospital Medical Center', '1490774-7', '2', '152 G-1 Canal Bank,Johar Town,Lahore.', 0, 'credit', '30 days', 'Zubair Ahmed', '0311-1419614', 'zubairahmedamss@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:47:03', '2020-10-12 09:47:03'),
(1008, 'Interloop Limited', '0688555-1', '2', '1-km,Khurrianwala-Jaranwala Road,Khurrianwala,Faisalabad.', 0, 'credit', '30 days', 'Ms Arooj Fatima,Ms.Javaria Ali,Shahid Mehmod Din', '041-4360400,0303-7770256,0303-7110097', 'Null,javaria@interloop.com.pk,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:49:41', '2021-01-23 09:04:56'),
(1009, 'Healthtek LTD.', '!733200-1', '2', 'Plot No 14,Sector 19,Korangi Industrial Area ,Karachi', 0, 'credit', '30 days', 'Ahmed Baig', '0321-2128947', 'Null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:52:03', '2020-10-12 09:52:03'),
(1010, 'Global ECO Lab', '1179090-3', '2', '2nd& 3rd floor,4-5 Commercial Area,Cavalry Ground,Lahore Cantt.', 0, 'credit', '30 days', 'Salma Khalid,Ms.Aqsa Khalid', '+92-423-6681281,0301-6831909', 'quality@gel-intl.org,GEL Pakistan <info@gel-inti.org>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:55:36', '2021-01-23 09:04:56'),
(1011, 'Punjab Food Authority', '9021314-2', '2', 'Muslim Town Lahore', 0, 'credit', '30 days', 'Ayyaz Khurram', '0330-1423157', 'Ayyaz.Khurram@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:57:55', '2020-10-12 09:57:55'),
(1012, 'Punjab Food Authority', '9021314-2', '2', 'Muslim Town Lahore', 0, 'credit', '30 days', 'Ayyaz Khurram', '0330-1423157', 'Ayyaz.Khurram@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 09:57:56', '2020-10-12 09:57:56'),
(1013, 'National Transmission and Despatch Compony LTD.', '2952212-9', '2', 'Cheif Engineer HV & SC Lab NTDC Rawat', 0, 'credit', '30 days', 'Sajeel Zulfiqar', '0335-7401285', 'hvsclabfsd@ntdc.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 10:01:51', '2020-10-12 10:01:51'),
(1014, 'Shaigan Pharmaceuticls LTD.', '0712088-5', '2', '14 km,Adyala Road Rawalpindi.', 0, 'credit', '30 days', 'Irtaza Gillani,Mehfooz Ur Rehman,Wasif Ali Khan', '0303-5879861,0333-5302078,92-5133060-4(EXT:140)', 'Nill,qam@shaigan.com,Wasif Ali Khan procurement.local@shaigan.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 11:46:01', '2021-01-23 09:04:56'),
(1015, 'TICS LTD.', '3330259-6', '2', '90 Westwood Colony,Raiwand Road,Thokar Niazbaig,Lahore', 0, 'credit', '30 days', 'Irfan Latif', '0333-4898334', 'bd@tics.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 11:49:24', '2020-10-12 11:49:24'),
(1016, 'Pepsi-Cola International LTD.', '0711631-4', '2', 'Plot 57/58,Phase IV,Hattar Industrial Estate,Haripur', 0, 'credit', '30 days', 'M.Wasif,Irfan Hameed', '0306-5346007,0303-6626500', 'Muhammad.Wasif@pepsico.com,irfan.hameed@pepsico.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 11:53:42', '2021-01-23 09:04:56'),
(1017, 'Total Nutrition LTD.', '3815099-9', '2', '19-Km,OFF Ferozpur Road,Behind Glaxo Factory,Kam Road,lahore', 0, 'credit', '30 days', 'Ammara Ashraf', '03000458493', 'ammara@mehta.pk', 'testing', NULL, 'testing', NULL, NULL, NULL, NULL, '2020-10-12 11:57:06', '2020-12-03 12:04:49'),
(1018, 'Aviation Flight VIP Flight Complex', '9023800-1', '2', 'Old Terminal Airport Lahore', 0, 'credit', '30 days', 'Mazher Mahmod Khalid,Sadiq Usmani', '042-99220155,0300-4633979', 'Nill,vipflt@brain.net.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:02:41', '2021-01-23 09:04:56'),
(1019, 'PEPSI-COLA INTERNATIONAL LTD.', '0711631-4', '2', '37-C-1,Gulberg III,Lahore', 0, 'credit', '30 days', 'Sohaib Ghouri', '0302-8503067', 'Sohaib.Ghouri@pepsico.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:08:08', '2020-10-12 12:08:08'),
(1020, 'Mega Transformer', '3415767-7', '2', '4-Km,Mian Manga Raiwand Road,Talab Saray,lahore.', 0, 'credit', '30 days', 'M.Salman,Inzamam Raja,Mr.Usman', '0343-1497285,0323-1491929,0308-4442674', 'salmannoor104@gmail.com,inzimam.raja@outlook.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:12:54', '2021-01-23 09:04:56'),
(1021, 'Ravi Green ENGG.LTD.', '2727810-7', '2', '20th KM Raiwand Road Lahore.', 0, 'credit', '30 days', 'Nill', '0300-4207384', 'invoice@ravigreen.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:16:44', '2020-10-12 12:16:44'),
(1022, 'Highnoon Laboratories LTD', '1419491-7', '2', '17.5km,Multan Road,Lahore', 0, 'credit', '30 days', 'Idrees Khalid', '0345-4015250', 'Idress@highnoon.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:22:41', '2020-10-12 12:22:41'),
(1023, 'Prime Health LTD', '7170273-0', '2', 'Mezzanine Floor,Royal Plaza,Fazal-e-Haq Road Blue Area Islamabad', 0, 'credit', '30 days', 'Shahid Hussain,Raheela Arshad,Farooq Sami', '0333-0598136,051-8445004,0333-0598136', 'shahid.hussain@phlp-lab.com,raheelaarshad@primehealthlaboratories.com,shahiod.hussain@phip-lab.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:26:18', '2021-01-23 09:04:56'),
(1024, 'Curexa Health LTD.', '4433272-6', '2', 'Plot# 517,Sunder Industrial Estate,Lahore', 0, 'credit', '30 days', 'Jamil Mahmood', '0333-4058205', 'jamil.mahmood@highnoon.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:29:51', '2020-10-12 12:29:51'),
(1025, 'Ghani Auto Mobile Industrial Ltd.', '2027078-0', '2', '49 Km(From Lahore),Multan Road,Phool Nagar,Kasur', 0, 'credit', '30 days', 'Mr.Zubair', '0321-8496349', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:33:08', '2020-10-12 12:33:08'),
(1026, 'CHT Pakistan LTD.', '2463668-1', '2', 'Plot#54-B,Sunder Industrial Estate,Lahore', 0, 'credit', '30 days', 'Mr.Mudasar', '0301-8443293', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-12 12:36:12', '2020-10-12 12:36:12'),
(1027, 'Indus Pharma', '0710697-1', '2', 'Sector 27,Landhi Town,Karachi.', 0, 'credit', '30 days', 'M.Umair', '03452343661', 'muhammad.umair@indus-pharma.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:11:53', '2020-10-13 11:11:53'),
(1028, 'Metropole Laboratories LTD.', '6425279-8', '2', 'Crescent Arcade,G-8 Islamabad', 0, 'credit', '30 days', 'Rabbyya Kausar', '0514577810', 'rabyya@futurescientific.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:15:20', '2020-10-13 11:15:20'),
(1029, 'Siddique Son\'s Transformer LTD.', '7540542-0', '2', '41-km Ferozpur Road,Opp Mustafabad Sports Stadium,Mustafabad,Kasur', 0, 'credit', '30 days', 'Aftab ul Haq', '0336-443337', 'aftabulhaq062@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:22:32', '2020-10-13 11:22:32'),
(1030, 'Bureau Veritas Pakistan', '2891848-7', '2', 'Plot#37,1st Floor,Somia Ehsan Plaza,Lahore', 0, 'credit', '30 days', 'Shahrukh Khawaja', '042-35122101-06', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:26:24', '2020-10-13 11:26:24'),
(1031, 'Soil Bacteriologist,Ayub Agricultural Research Institute', '9020504-9', '2', 'Jhang Road,Faisalabad', 0, 'credit', '30 days', 'Dr.Saleem Akhtar', '0333-6500845', 'sbaarifsd@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:29:56', '2020-10-13 11:29:56'),
(1032, 'Haleeb Foods LTD.', '1207069-6', '2', '62-Km Multan Road Lahore.', 0, 'credit', '30 days', 'Shoaib Ghaffar', '0302-8440168', 'Shoaib.Ghaffar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:33:22', '2020-10-13 11:33:22'),
(1033, 'Nestle Pakistan Limited Kabir wala.', '0225862-5', '2', 'Accounts Payable Section,308 Upper Mall,Lahore,Pakistan.', 0, 'credit', '30 days', 'Amna Rafiq,Tahir Iqbal,Mr Mansoor', '0323-4321991,0321-4472734,0301-4699475', 'amna.rafique@pk.nestle.com,Tahir.Iqbal1@PK.nestle.com,Nill', 'Mr.Afzal', NULL, 'Nill', NULL, NULL, NULL, NULL, '2020-10-13 11:38:22', '2021-01-23 09:04:56'),
(1034, 'Genetics Healthcare.', '4317551-1', '2', '539-A,Sunder Industrial Estate,Lahore Pakistan.', 0, 'credit', '30 days', 'M.Wajid,Irfan Amanat,Mr.Abdullah', '03000222859,03000222390,0308-2221675', 'Nill,irfan.amanat@genetics_Pharmaceuticals.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:45:58', '2021-01-23 09:04:56'),
(1035, 'National Institute of Electronics', '9013702-7', '2', 'Plot#17,Street 6,Sector H-9/1,Islamabad', 0, 'credit', '30 days', 'Abdullah Tariq', '0346-5040956', 'abdullahtariq352@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:50:15', '2020-10-13 11:50:15'),
(1036, 'HNR Compony LTD.', '1263333-1', '2', '19.5 Km,Raiwand Road,Lahore-Pakistan', 0, 'credit', '30 days', 'Abid Ishaq', '0322-6529967', 'm.abid@haier.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 11:54:29', '2020-10-13 11:54:29'),
(1037, 'U.S Denim', '2239122-3', '2', '3-KM,Defence/Raiwand Road,Lahore.', 0, 'credit', '30 days', 'Shafqat Butt', '0321-6650327', 'shafqat.ali@usdenimmills.com', 'purchaser', '0301298043-', 'purchaser@gmail.com', NULL, NULL, NULL, NULL, '2020-10-13 11:57:40', '2021-02-03 10:40:09'),
(1038, 'Drugs Testing Laboratory Lahore.', '9020841-6', '2', 'P&SHD,GOVT.of Punjab,1-Birdwood Road,Lahore-54000', 0, 'credit', '30 days', 'Shaheen Iqbal', '0323-4100549', 'directordtl.lhr@punjab.gov.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:00:58', '2020-10-13 12:00:58'),
(1039, 'Mari Petroleum Compont LTD', '1414673-8', '2', 'Kalabagh Field', 0, 'credit', '30 days', 'Nabigh Zafar', '0349-0139002', 'Nabigh.Zafar@mpcl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:02:57', '2020-10-13 12:02:57'),
(1040, 'Remington Pharma.', '1772367-1', '2', '18 Km,Multan Road,Lahore', 0, 'credit', '30 days', 'Suleman Nazir', '0303-9565085', 'snazir2@remingtonpharma.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:06:17', '2020-10-13 12:06:17'),
(1041, 'Qarshi Research International LTD.', '1531398-7', '2', 'Plot 56/1-4,Phase 3 Industrial Estate Hattar,Distt Haripur,Pakistan.', 0, 'credit', '30 days', 'Mr.Sarhan Ikhlaq,M.Kaleem', '0345-5871290,0345-5915360', 'sarhan.akhlaq@qarshi.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:09:41', '2021-01-23 09:04:56'),
(1042, 'Green Crescent Environmental Consultant LTD.', '7131884-5', '2', '112C E/1 Gulbarg III Lahore', 0, 'credit', '30 days', 'Rashid Maqbool', '0322-4100912', 'manageroperation@gcee.ae', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:15:02', '2020-10-13 12:15:02'),
(1043, 'Pharmagen LTD.', '0786323-3', '2', 'Kot Nabi Bukhsh Wala,34-Km Ferozpur Road,Lahore', 0, 'credit', '30 days', 'Dr.Sarfraz Ahmed', '0300-8463472', 'sarfraz.ahmed@pharmagen.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:19:45', '2020-10-25 22:46:41'),
(1044, 'NIZAM SONS (PRIVATE) LIMITED', '1000743-1', '2', 'Harrar Wazirabad Road Near SUZUKI show Room Sialkot', 0, 'credit', '30 days', 'M.Mohsin', '0345-6700389', 'mohsin.bashir@nizamsons.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 12:25:24', '2020-10-31 03:40:25'),
(1045, 'Sky Power LTD.', '3954492-3', '2', 'Plot No.4536,Race Course Road,Near Halloki Satation,Halloki,Lahore,Punjab,Pakistan', 0, 'credit', '30 days', 'Hafeez ur Rehman', '0092-3228700839', 'hafeez381381@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 21:53:54', '2020-10-13 21:53:54'),
(1046, 'Aviation Engineering Solution Ltd.', '7103228-5', '2', 'Flat no.AF-04,Block A,Midcity Appartment Service Islamabad.', 0, 'credit', '30 days', 'Mohsin Siddique,Mazhar Mahmod Khalid', '0323-5060706,042-99220155', 'mmsiddique95@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 21:57:09', '2021-01-23 09:04:56'),
(1047, 'Sami Pharmaceuticals LTD.', '0711973-9', '2', 'F-95,Off Hub River Rd,Sindh Industrial Trading Estate,Karachi', 0, 'credit', '30 days', 'Mr.Qeyamuddin', '0331-2495136', 'procurement@samikhi.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 22:00:44', '2020-10-13 22:00:44'),
(1048, 'Bureau Veritas Pakistan', '2891848-7', '2', 'Plot No 21,Sector 30,Korangi Industrial Area,OFF Surgeon Faiz Khan Road,Karachi.', 0, 'credit', '30 days', 'Nudrat Amir', '0301-2329182', 'nudrat.amir@bureauveritas.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 22:04:51', '2020-10-13 22:04:51'),
(1049, 'Artistic Milliners Ltd.', '2645727-0', '2', 'Plot 10,11,14,15,104,Deh kanto tappo Landhi,Bin Qasim Town Karachi.', 0, 'credit', '30 days', 'M.Shahzad Ahmed,Masood Khan', '0321-8290160,0321-82046651', 'qamanager-am5@artisticmilliners.com,masood-chem-eng@artisticmilliners', 'Riaz', NULL, 'lakeview4402@gmail.com', NULL, NULL, NULL, NULL, '2020-10-13 22:08:15', '2021-01-23 09:04:56'),
(1050, 'Squd Energy LTD.', '2725780-7', '2', '3rd Floor.22 East Plaza.Jinnah Avenue Blue Area,Islamabad.', 0, 'credit', '30 days', 'Tahir Javed', '03005557456', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 22:10:43', '2020-10-13 22:10:43'),
(1051, 'Coca-Cola Export Corportion.', '0224152-8', '2', '33 Km Raiwand Road Lahore.', 0, 'credit', '30 days', 'Khurram Javed,Komal Sajid', '0300-4018052,0309-8880505', 'kjaved@coca-cola.com,ksajid@coca-cola.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 22:12:57', '2021-01-23 09:04:56'),
(1052, 'Mari Petroleum Pakistan Compony', '1414673-8', '2', '21,Mauve Area,3RD Road,G-10/4,PO Box 1614,Islamabad.', 0, 'credit', '30 days', 'Shahid Abbas', '0345-3720957', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-13 22:15:47', '2020-10-13 22:15:47'),
(1053, 'Schazoo Zaka LTD.', '2251963-7', '2', 'kalawala,Zaka-Ur Rehman Estate,plot#1,20-Km,Lahore-Jaranwala.', 0, 'credit', '30 days', 'M.Awais', '0322-8888443', 'supplychain@schazoozaka.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:03:15', '2020-10-14 11:03:15'),
(1054, 'Master Engineering Compony', '2144125-1', '2', 'Kacha Jail Road Chungi Amar Sadhu Kot Lakhpat Lahore', 0, 'credit', '30 days', 'Atif Saleem', 'Nill', 'leaderklp@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:08:44', '2020-10-14 11:08:44'),
(1055, 'Nishat Dying and Finishing Mills Unit-35', '2180652-7', '2', '5 Km Nishat Avenue,22-KM Off Ferozpur Road Lahore', 0, 'credit', '30 days', 'Muhammad Adil Ghani', '042-35260041-50', 'adilghani@nishatmills.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:11:52', '2020-10-14 11:11:52'),
(1056, 'Maple Leaf Cement Factory Ltd.', '0786576-7', '2', '42-Lawerence Road,Lahore', 0, 'credit', '30 days', 'Zeeshan Anwar', '0300-0308725', 'zeeshan.anwar@kmlg.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:13:59', '2020-10-14 11:13:59'),
(1057, 'Mari Patroleum Compony LTD.', '1414673-8', '2', '12-Km off Shakardar,Distt.Kohat Near Village Kamarsar.', 0, 'credit', '30 days', 'Shakeel Ahmed,Mohsin Hanif', '0300-3612171,0332-0966326', 'mohsin.hanif@mpcl.com.pk,mohsin.hanif@mpcl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:17:33', '2021-01-23 09:04:56'),
(1058, 'Evolution Pharmaceuticals', '7277859-0', '2', 'Plot#27,Street# S-3,RCCI,Rawat Islamabad', 0, 'credit', '30 days', 'Dr Lubna Iqbal', '051-4499159-62', 'dr.lubna@evolutionpharmaceuticals.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:21:03', '2020-10-14 11:21:03'),
(1059, 'Azhar Corporation LTD.', '0659958-3', '2', 'Sargodha Road,Faisalabad', 0, 'credit', '30 days', 'Mr Ashraf Gandhi', '041-8811117', 'info@acpl.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:23:33', '2020-10-14 11:23:33'),
(1060, 'Berger Paints LTD', '0700095-2', '2', '28-Km Multan Road,Lahore', 0, 'credit', '30 days', 'Farzooq Arshad', '042-38102771-75Ext:354', 'farzooq.aeshad@berger.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:26:00', '2020-10-14 11:26:00'),
(1061, 'Hi Tek Pvt LTD.', '3029153-4', '2', 'House,H # No.1,Service Lane,Quaid-e-Azam Interchange,Ring Road Lahore', 0, 'credit', '30 days', 'M.Kashif Hussain', '0301-8438290', 'kashif@hitek.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:29:32', '2020-10-14 11:29:32'),
(1062, 'Water,Environment Laboratories&Consultancy Services.', '7476146-8', '2', '29-D,Punjab University Town II,Khayaban-e-Jinnah,Lahore', 0, 'credit', '30 days', 'M.Waseem', '0314-5183739', 'info@welcos.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:33:41', '2020-10-14 11:33:41'),
(1063, 'Nishat Mills Limited', '2180652-7', '2', '5 Km Nishat Avenue,22 Km,Off Ferozpur Road,Lahore', 0, 'credit', '30 days', 'Shahid Javed,M.Naveed', '0300-7255623,0300-4597776', 'mshahid@nishatmills.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:36:46', '2021-01-23 09:04:56'),
(1064, 'Bunny,s Limited.', '0452482-9', '2', 'Kot Lakhpat Lahore.', 0, 'credit', '30 days', 'Khayyam Hussain,Mr.Rajab', '0300-4820346,0336-4851971', 'khayyamhussain@bunnysltd.com,khayyamhussain@bunnysltd.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:40:07', '2021-01-23 09:04:56'),
(1065, 'Pan Power International', '2723546-7', '2', '11-Km,Syed Arshad Ali Road,Off Multan Road(Near Zainibacomplex)Lahore', 0, 'credit', '30 days', 'Umair Rizvi', '0302-4865657', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:44:30', '2020-10-14 11:44:30'),
(1066, 'Pakistan Oil Fields Limited', '0657658-3', '2', 'Morgh,Pakistan', 0, 'credit', '30 days', 'Fazal Ullah', '0333-9265048', 'materials@pakoil.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:47:35', '2020-10-14 11:47:35'),
(1067, 'Dynatic Pakistan Ltd.', '0712649-2', '2', 'Plot#710,Sunder Industrial Estate,Lahore', 0, 'credit', '30 days', 'Mujahid Hussain', '0321-7327347', 'mujahidhussain@dynatispakistan.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:52:00', '2020-10-14 11:52:00'),
(1068, 'Honda Atlas Car Limited', '0829237-0', '2', '43 KM,Multan Road Manga Mandi,Lahore', 0, 'credit', '30 days', 'Khurram Shahzad', '03134523166', 'khurram@honda.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:54:55', '2020-10-14 11:54:55'),
(1069, 'Reets International Lahore', '1989632-8', '2', '140-B,New Muslim Town,Lahore', 0, 'credit', '30 days', 'Waris Ali', '0300-4652685', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 11:56:45', '2020-10-14 11:56:45'),
(1070, 'Zyng LTD', '3758457-0 (Momin Ali Khan)', '2', 'Excelien Beverages UC Bahar,Tehsil Fateh Jang Dist Attock', 0, 'credit', '30 days', 'Mr.Nouman', '0311-8501411', 'nominoman1411@gmail.com', 'purchase', NULL, 'email@gmail.com', NULL, NULL, NULL, NULL, '2020-10-14 12:02:22', '2020-12-09 12:22:40'),
(1071, 'Nishat Mills LTD.', '2180652-7', '2', 'Yarn Dyeing Unit 10,Nishat Mills NishatAbad Faislabad', 0, 'credit', '30 days', 'Shahid Majeed', '0300-4346661', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 12:05:32', '2020-10-14 12:05:32'),
(1072, 'Hybrid Technics.', '1297576-1', '2', 'F9.Walton Airport,Lahore', 0, 'credit', '30 days', 'Abu Zar,Ahsan Raza', '0322-4256920,03054415173', 'gabuzar3@gmail.com,hybridstore123@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 12:07:59', '2021-01-23 09:04:56'),
(1073, 'Intertek Pakistan', '1475637-4', '2', 'House#465/GIII,Mian Boulevard,Near Khokhar Chowk,Johar Town Lahore', 0, 'credit', '30 days', 'M.Abbas', '0304-2225353', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 12:14:20', '2020-10-14 12:14:20'),
(1074, 'CCL Pharmaceuticals LTD.', '1264416-1', '2', '62 Quaid-e-Azam Industrial Estate,Kot Lakhpat,Lahore', 0, 'credit', '30 days', 'M.Faiz', '0302-5551196', 'muhammad.faiz@cclpharma.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:28:27', '2020-10-16 11:28:27'),
(1075, 'Kohinoor Mills Limited', '0658184-6', '2', '8-Km Manga Raiwand Road Distt.Kasur', 0, 'credit', '30 days', 'Mr Farooq Ahmed,Usman Tariq', '0333-4998812,0333-4998854', 'Farooq.Ahmed@kohinoormills.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:31:10', '2021-01-23 09:04:56'),
(1076, 'Pakistan Drug Testing and research center', '1962954-7', '2', 'Sunder Industrial Estate Raiwand Road lahore', 0, 'credit', '30 days', 'Zahid Mehmood,Abdul Rehman', '0320-0840818,0320-0840695', 'info@pdtrc.com.pk,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:34:38', '2021-01-23 09:04:56'),
(1077, 'PPl Gambat South', '0711545-8', '2', 'Gambat South Gas Processing Plant 1', 0, 'credit', '30 days', 'Arshad Jamal', '+92-235823049', 'muha_ali@ppl.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:39:08', '2020-10-16 11:39:08'),
(1078, 'Friesland Campina Engro Pakistan LTD.', '2285414-2', '2', 'Near Sukkhar Barrage Rohri Distt Sukkur,Sindh', 0, 'credit', '30 days', 'Syed Inayat Ali Shah,Saira Tariq', '0300-3544612,0304-0542426', 'SyedInayatAli.Shah@frieslandcampina,Saira.Tariq@frieslandcampina.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:42:08', '2021-01-23 09:04:56'),
(1079, 'GRIT LTD.', '4240415-7', '2', '3.5 Km Jillani Bridge,Off Defence Road Lahore', 0, 'credit', '30 days', 'M.Adnan Qamar', '0343-0557779', 'r.adnan@gritlimited.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:45:14', '2020-10-16 11:45:14'),
(1080, 'Kingcrete Associats(Fixed Wings)', '1418598-9', '2', 'Bahria Town,Tufail Road,Lahore', 0, 'credit', '30 days', 'Ghulam Murtaza,Muhammad Naeem', '0345-6216425,0334-0518852', 'naeembahriavipflight@hotmail.com,naeembahriavipflights@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:47:57', '2021-01-23 09:04:56'),
(1081, 'Sui Northern Gas Pipeline LTD.', '0801137-7', '2', '113/14-Quaid-e-Azam Industrial Estate Central Meter Shop Kot Lakhpat,Lahore', 0, 'credit', '30 days', 'Shamsuddin,Mr.Ahmed Jawad Khan', '0300-4370626,0334-4238867', 'Nill,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:50:46', '2021-01-23 09:04:56'),
(1082, 'Wimits Pharmaceuticals LTD', '3646773-1', '2', '129 Sunder Industrial Estate,Lahore', 0, 'credit', '30 days', 'shamsuddin', '0300-4370626', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:54:50', '2020-10-16 11:54:50'),
(1083, 'Crescent textile Mills LTD', '0710140-6', '2', 'Sargodha Road Faisalabad', 0, 'credit', '30 days', 'Mr.Asif,Mr.Ali Raza', '0300-7403040,+92-41-111-105-105', 'NIll,crestex@ctm.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 11:57:52', '2021-01-23 09:04:56'),
(1084, 'Sitara Peroxide Limited', '1950980-4', '2', '26 Km Sheikhpura Road,Faisalabad', 0, 'credit', '30 days', 'Aftab Ahmed', '0333-6579141', 'aftabahmed@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 12:04:04', '2020-10-16 12:04:04'),
(1085, 'TUV Austria Bureau of Inspection&Certification', '1523253-7', '2', '43/2 Main Gulberg,Lahore,Punjab', 0, 'credit', '30 days', 'M.Waseem', '0302-8457994', 'ine.coordinator@tuvat.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 22:22:05', '2020-10-16 22:22:05'),
(1086, 'Fauji Foods Limited.', '0786271-7', '2', 'Sargodha Road,Bhalwal', 0, 'credit', '30 days', 'Muhammad Muzamil', '03005633560', 'muhammad.muzamil@faujifoods.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 22:26:22', '2020-10-16 22:26:22'),
(1087, 'Phoenix Aviation LTD.', '1551151-7', '2', 'Associated House,Seven Egerton Road,Lahore 54000', 0, 'credit', '30 days', 'Khalid Khan (CE)', '42-36628565', 'khalid236@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 22:34:05', '2020-10-16 22:34:05'),
(1088, 'Next Pharmaceuticals Products Ltd.', '3372086-1', '2', 'Plot# 44 A&B Sunder Industrial Estate,Lahore', 0, 'credit', '30 days', 'Muhammad Ishfaq', '034235293630-4', 'm.ishfaq@nextpharco.com', 'Nasir Mehmood', 'Nill', NULL, NULL, NULL, NULL, NULL, '2020-10-16 22:37:37', '2020-10-28 22:44:37'),
(1089, 'Danas Pharmaceuticals', '2107255-8', '2', 'Plot#312,Industrial Triangle Kahuta Road,Islamabad', 0, 'credit', '30 days', 'Muhammad Naeem', '0300-5159983', 'gmqualityoperations@danaspharma.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 22:41:46', '2020-10-16 22:41:46'),
(1090, 'Synergy Elektrik LTD.', '3556535-7', '2', '16.5 Km Lahore-Sheikhupura Road Javed Nagar,Mominpur Road.', 0, 'credit', '30 days', 'Awais Zafar', '0301-4823324', 'awaiszafar@synergyelectrik.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 22:48:43', '2020-10-16 22:48:43'),
(1091, 'Qarashi Research International', '1531398-5', '2', 'Plot No. 56/1-4, Phase 3, Industrial Estate Hattar, Distt. Haripur KPK', 0, 'credit', '30 days', 'Sarhan Akhlaq,Tassadaq Hussain', '345-5871290,0345-9641116', 'sarhan.akhlaq@qarashi.com,mbl@qarashi.com', NULL, NULL, NULL, 'Amir Hussain', '0995-111-200-300, 617273  (Ext. 346)', 'amir.hussain@qarashi.com', NULL, '2020-10-17 07:44:01', '2021-01-23 09:04:56'),
(1092, 'Farm Eco', '1358922-9', '2', '44-B Industrial Estate Multan.', 0, 'cash', 'advance', 'Muhammad Salman', '0333-5556381', 'sunny_eco@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-17 08:12:13', '2020-10-17 08:12:13'),
(1093, 'Pakistan Petroleum Limited', '0711545-8', '2', 'Adhi Oil Field,Doltala,Rawalpindi,Pakistan', 0, 'credit', '30 days', 'Mr.Imtiaz Mehmood,Haider Ali', '+92-3056611771,92-347-8365299', 'm_imtiaz@ppl.com.pk,BuHaider@ppl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 09:56:40', '2021-01-23 09:04:56'),
(1094, 'Director General Agricultural Chemist.', '9020504-9', '2', 'Raiwand,Lahore', 0, 'credit', '30 days', 'Dr Shahid Javaid', '042-5394499', 'referencelab@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 10:02:30', '2020-10-18 10:02:30'),
(1095, 'Darson Industries', '0305386-5', '2', 'GT Road Wazirabad Distt.Gujranwala-Pakistan', 0, 'credit', '30 days', 'Mirza Husnain', '0302-9384846', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 10:04:26', '2020-10-18 10:04:26'),
(1096, 'Soil and Water Testing Lab Bhawalpur', '9020504-9', '2', 'Near Gulburg Road Model Town-A,Bhawalpur', 0, 'credit', '30 days', 'M.Ashraf', '+92-62-9255218', 'agri.chemistbwl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 10:11:21', '2020-10-18 10:11:21'),
(1097, 'Crescent Bahuman LTD.', '0710138-4', '2', 'Lahore-Sargodha Road,Bahuman,District Hafizabad', 0, 'credit', '30 days', 'Wasim Qaiser', '0300-7403340', 'wasimqa@ecrescent.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 10:25:18', '2020-10-18 10:25:18'),
(1098, 'Pacific Pharmaceutical LTD.', '1503992-7', '2', '30 Km Multan Road Lahore', 0, 'credit', '30 days', 'Mr.Ali Mir,Shahbaz Khan', '0322-6869927,0322-8554042', 'Nill,Khan.shahbaz@pharmaceuticals.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 10:27:50', '2021-01-23 09:04:56'),
(1099, 'PDH Laboratories', '1318039-8', '2', '9.5Km Sheikhpura Road,Lahore.', 0, 'credit', '30 days', 'Muhammad Khalid,Waseem Dilawar', '0309-5553044,0323-5422576', 'khalid@pdhlabs.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 10:30:09', '2021-01-23 09:04:56'),
(1100, 'Air Eagle Aviation Acedemy', '0657636-2', '2', 'T-98,Near Punjab VIP Flight Complex,Old Terminal Allama Iqbal Int.Airport,Cantt', 0, 'credit', '30 days', 'Mr.Zulfiqar', '0322-2565574', 'cheifengineer@aireagle.edu.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:19:30', '2020-10-18 11:19:30'),
(1101, 'Indus Home Limited', '2681448-0', '2', '2.5Km off Manga Raiwand Road,Manga Mandi Lahore', 0, 'credit', '30 days', 'Mr.Hassan', '042-35384570', 'm.hassan@indus-home.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:26:10', '2020-10-18 11:26:10'),
(1102, 'Readygo(Pvt)LTD.', '7363312-7', '2', 'Khanpur Canal,Sheikhupura.', 0, 'credit', '30 days', 'Mr.M.Akmal', '0333-6886212', 'akmal@asiafeed.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:29:27', '2020-10-18 11:29:27'),
(1103, 'Intertek Pakistan', '1475637-4', '2', 'Plot No 1-5/11-A,Sector-5,Korangi Industrial Area,Karachi.', 0, 'credit', '30 days', 'Muqadas Jabeen', '0333-3794323', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:34:58', '2020-10-18 11:34:58'),
(1104, 'Genetics Pharmaceuticals', '2139710-4', '2', '539-A Sunder Industrial Estate,Lahore', 0, 'credit', '30 days', 'Irfan Amanat,Taimoor Khan', '0300-0222390,03247784778', 'irfan.amanat@genetics_pharmaceuticals.com,Taimoor.Khan@genetics_pharmaceuticals', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:39:50', '2021-01-23 09:04:56'),
(1105, 'ICI Pakistan', '0710672-6', '2', '45 Km Off Multan Road Lahore', 0, 'credit', '30 days', 'Ghazanfar Mahmood', '0303-7772734', 'ghazanfar.mahmood@ici.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:49:56', '2020-10-18 11:49:56'),
(1106, 'Enviromental Service Pakistan', '7384297-4', '2', 'Office No.731,Block-2,Sector:D-1,Township,Lahore', 0, 'credit', '30 days', 'Imran Malik', '0333-7237238', 'imran@espak.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 11:56:13', '2020-10-18 11:56:13'),
(1107, 'National Transmission and Dispatch Compony Ltd.', '2952212-9', '2', 'Steam Power Station,Nishatabad Faisalabad', 0, 'credit', '30 days', 'Mr.Kaleem Khan', '0335-7402534', 'hvsclab@ntdc.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 12:02:46', '2020-10-18 12:02:46'),
(1108, 'Herbion Pakistan LTD.', '0823835-9', '2', 'Plot#553 ,Sunder Industrial Estate,Lahore.', 0, 'credit', '30 days', 'Dr.Shoaib,Dr.Nazia Aslam', '0324-8288923,0321-8255353', 'Nill,nazia.aslam@herbion.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 12:11:41', '2021-01-23 09:04:56'),
(1109, 'Drug Testing Laboratory Rawalpindi', '9021625-7', '2', 'Hayyal Shareef,Dhamial Road,Bank Colony,Rawalpindi', 0, 'credit', '30 days', 'Saqib Sohail', '0345-6803427', 'procurement.dtlrwp@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-18 12:25:03', '2020-10-18 12:25:03'),
(1111, 'Emirates Airline Engineering', '7322733-0', '2', 'Emirates Airline, P.O Box 686 Dubai, UAE.', 0, 'credit', '30 days', 'Mr.Jasim Hassan(MCME),Mr.Venus Fernadez', '+971-50-676-7578,97142182395', 'jasim.hassan@emirates.com,Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-19 22:15:59', '2021-01-23 09:04:56'),
(1112, 'Pacific Pharmaceuticals (Pvt.) Ltd.', '1503992-7', '2', 'Plot#384,Sunder Industrial Estate,Lahore.', 0, 'credit', '30 days', 'Khurram Sheraz', '0302-5554849', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-19 22:19:00', '2020-10-23 22:22:07'),
(1113, 'Agri Force Chemicals', '1689341-1', '2', 'Plot # 217-218, Industrial Estate Phase-II, Multan.', 0, 'credit', '30 days', 'M.Tariq', '0300-4104551', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-19 22:30:52', '2020-10-20 06:30:16'),
(1114, 'Exin Chemicals Corporation', '1133874-1', '2', 'Plot # 33-B, Industrial Estate Phase-II, Multan.', 0, 'credit', '30 days', 'Azhar Iqbal', '0300-2020574', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-19 22:33:18', '2020-10-20 06:28:57'),
(1115, 'Hammad Engg. Company (Pvt.) Ltd.', '2970007-8', '2', '19-Km, Multan Road, Lahore.', 0, 'credit', '30 days', 'Shahid Nadeem', '0300-8391756', 'lab@hammadengineering.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-19 22:37:08', '2020-10-20 06:04:27'),
(1116, 'Fatima Fertilizer Compony Limited', '1791532-5', '2', 'E-110,Khayaban-e-Jinnah Lahore Cantt', 0, 'credit', '30 days', 'Zafar Mahmood,Malik Rehan Ahmed', '0300-3730665,0302-8131265', 'Nill,ffl.planning@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-22 22:15:43', '2021-01-23 09:04:56'),
(1117, 'Chashma Sugar Mills Limited', '1158077-1', '2', '2km Ramak,Dera Ismail Khan.', 0, 'credit', '30 days', 'Mr.Zaka Niazi,Saeed Akbaar,Shahid Munir', '0331-6095842,0331-6095842,0300-7734457', 'Nill,zaka Niazi<zaka_ravian@yahoo.com>,shahidmunir@chashmasugarmills.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-22 22:20:12', '2021-01-23 09:04:56'),
(1118, 'PharmaSOL(Pvt)LTD.', '3584039-7', '2', 'Plot#549,Sunder Industrial Estate,Lahore.', 0, 'credit', '30 days', 'Mr.Irfan', '0300-0541249', 'qcm@pharmasol.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-22 22:24:52', '2020-10-22 22:24:52'),
(1119, 'Allied Rental Modaraba', '2709800-1', '2', '16-Km Multan Road,Lahore', 0, 'credit', '30 days', 'Saboor Khan', '0320-8771888', 'saboor.khanaesl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-22 22:29:32', '2020-10-22 22:29:32'),
(1120, 'Asian Calibration Services', '5272157-2', '2', 'Jehlum Block green Fort 2,Lahore,Punjab,Pakistan', 0, 'credit', '30 days', 'Aleem Butt', '0321-4260133', 'aleem.butt@asiancon.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-22 22:32:36', '2020-10-22 22:32:36'),
(1121, 'MI Corporation', '4342255-1', '2', '44-II,Industrial Estate,Phase-II,Multan', 0, 'credit', '30 days', 'Souman Ahmed', '0303-6600146', 'souman.ahmed@live.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:00:41', '2020-10-23 22:00:41'),
(1122, 'Biostar Chemicals', '7140846-3', '2', '1.5-Km,Khanewal Road,Vehari', 0, 'credit', '30 days', 'Abdul Qadeer', '0333-6273344', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:05:04', '2020-10-23 22:05:04'),
(1123, 'WASA Water Testing Laboratory Lahore', '9020019-3', '2', 'Main out Fall Road,lahore', 0, 'credit', '30 days', 'Chemist,Bukhtiar Mazher', '042-37151369,0337-7809607', 'chemistwasalhr@gmail.com,bakhtiarmazher@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:28:42', '2021-01-23 09:04:56'),
(1124, 'Pepsico Snacks Plant Multan', '0711631-1', '2', 'Plot#149,Multan Road Industrial Estate-II,Multan', 0, 'credit', '30 days', 'Shohaib Ghouri', '0302-8503067', 'Shoaib.Ghouri@pepsico.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:31:56', '2020-10-23 22:31:56'),
(1125, 'Sui Northern Gas Pipeline Limited', '0801137-7', '2', 'Gas House,21 kashmir Road,Lahore.', 0, 'credit', '30 days', 'Asma Maqbool', '0336-4477101', 'asma.maqbool@sngpl.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:34:56', '2020-10-23 22:34:56'),
(1126, 'National Clearing Compony of pakistan Limited', '1333864-1', '2', '9th Floor,Bahria Complex III Building,M.T Khan Road,Karachi', 0, 'credit', '30 days', 'M.Tahir Bashir', '0300-3347046', 'tahir@nccpl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:38:37', '2020-10-23 22:38:37'),
(1127, 'First Treet Manufacturing Modaraba', '2551646-9', '2', '72-B Industrial Area Kot lakhpat', 0, 'credit', '30 days', 'Ali Waqas', '+92-111-187-338', 'ali.waqas@treetonline.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:49:58', '2020-10-23 22:49:58'),
(1128, 'Drug Testing laboratory.', '9020841-6', '2', '1-birdwood Road,Lahore-54000', 0, 'credit', '30 days', 'Miss Aisha Khadija', '0323-4538531', 'aishakhadija.dtl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:54:01', '2020-10-23 22:54:01'),
(1129, 'Water,Enviromental Laboratories&Consultancy Services', '7476146-8', '2', '29-D,Punjab University Town-II,Khayaban-e-Jinnah,Lahore', 0, 'credit', '30 days', 'Bilal Manzoor', '0341-4567271', 'info@welcos.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-23 22:59:02', '2020-10-23 22:59:02'),
(1130, 'Future Scientific', '2979549-4', '2', 'Opposite Street No 4,Main Road Shaheeen Town,Rawalpindi', 0, 'cash', 'advance', 'Mr.Adeel Ahsan', '0320-0552851', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:08:30', '2020-10-25 22:08:30'),
(1131, 'Artistic Milliners', '2645727-0', '2', 'Plot 4&8 Sector 25,Korangi Industrial Area,Karachi.', 0, 'credit', '30 days', 'Masood Khan', '0321-8204651', 'masood-chem-eng@artisticmilliners.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:13:06', '2020-10-25 22:13:06'),
(1132, 'Naveena Exports Limited', '0676615-3', '2', 'Plot#1,Sector-28,Korangi Industrial Area Karachi.', 0, 'credit', '30 days', 'Namara Khalid', '(92-91)35123104-8', 'mto.lab@naveenagroup.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:15:31', '2020-10-25 22:15:31'),
(1133, 'HSE Services.', '1330725-8', '2', '2nd Floor,Plot No 6/4,Sector 24,Shan Chowrangi,Korangi Industrial Area Karachi.', 0, 'credit', '30 days', 'Mr.Talha Qudussi,Mr.Qadussi', '0300-3000347,0300-3000347', 'taha@hse.com.pk,taha@hse.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:18:01', '2021-01-23 09:04:56'),
(1134, 'Ercon Industries LTD.', '7249207-4', '2', '22-Km off Ferozpur Road,Rohi Nala,Lahore', 0, 'credit', '30 days', 'Engr.Adil Tariq', '0335-5110593', 'ecronpk@ecronme.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:21:30', '2020-10-25 22:21:30'),
(1135, 'Mari Petroleum Compony LTD.', '1414673-8', '2', 'Zarghun Gas Field,Balochistan.', 0, 'credit', '30 days', 'Shahid Abbas', '0345-3720957', 'Shahid.Abbas@mpcl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:24:25', '2020-10-25 22:24:25'),
(1136, 'FrieslandCampina Engro Pakistan Limited.', '2285414-2', '2', '8Km,Pakpattan Road,Sahiwal', 0, 'credit', '30 days', 'Hafiz Usman', '0301-3491961', 'HafizUsman.Ali@frieslandcampina.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:28:55', '2020-10-25 22:28:55'),
(1137, 'Radiant Medical LTD', '2218935-1', '2', '6-Sher Shah Block,New Garden Town,lahore', 0, 'credit', '30 days', 'Naeem Iqbal', '0310-7775400', 'sm@radiantmedical.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:36:15', '2020-10-25 22:36:15'),
(1138, 'Chanar Sugar Mills.', '0225970-2', '2', 'Chak 407 GB,Tehsil Tandianwala,District Faisalabad.', 0, 'credit', '30 days', 'M.Zaid', '041-3412102-103 ext 709', 'zaid@channarsuger.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:40:25', '2020-10-25 22:40:25'),
(1139, 'AHY Plastic Industries LTD.', '3155223-4', '2', 'Kahna Kacha Road,Lahore', 0, 'credit', '30 days', 'M.Kashif', '0333-0421543', 'Nill', 'Mr. Kashif', NULL, 'kashif@ahy.com.pk', NULL, NULL, NULL, NULL, '2020-10-25 22:42:31', '2020-12-06 15:30:21'),
(1140, 'Fatima Fedrtiizer Compony Limited.', '1791532-5', '2', 'Mukhtar Garh,Sadiqabad,District Rahim Yar khan', 0, 'credit', '30 days', 'Mr.Ali Hassan', '068-5951000', 'ffl.planning@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:50:03', '2020-10-25 22:50:03'),
(1141, 'Sui Northern Gas Pipe Lines Lahore', '0801137-7', '2', '150-Industrial Area Kot Lukhpat Lahore.', 0, 'credit', '30 days', 'Hasnat Ahmed', '0334-6559859', 'muhammad.hasnaat@sngpl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:52:54', '2020-10-25 22:52:54'),
(1142, 'Pakistan Textile Testing Foundation', '2204660-7', '2', '1st Floor, PTEA house, 30/7 Civil Lines Faisalabad', 0, 'credit', '30 days', 'Syed Tahir Zaidi', '0300-0201927', 'TahirZaidi<qm@pttflab.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-25 22:59:53', '2020-10-25 22:59:53'),
(1143, 'Gohar Textile Mills (Pvt) Ltd.', '1410980-8', '2', '3-KM, Chak Jhumra Road, Khurrianwala, Faisalabad.', 0, 'credit', '30 days', 'Muhammad Safdar', '0300-6694285', 'safdar@gohartextile.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 02:50:09', '2020-10-26 02:50:09'),
(1144, 'Gohar Textile Mills (Pvt) Ltd.', '1410980-8', '2', '3-KM, Chak Jhumra Road, Khurrianwala, Faisalabad.', 0, 'credit', '30 days', 'Muhammad Safdar', '0300-6694285', 'safdar@gohartextile.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 02:50:11', '2020-10-26 02:50:11'),
(1145, 'Inspectest (Pvt) Ltd.', '1273922-7', '2', '18 kM, Ferozpur Road Lahore', 0, 'credit', '30 days', 'Furqan Shaukat,Zeeshan Rasheed,Maheen Manzoor', '0321 848507,0321 8476720,0320 858 5334', 'furqan.shaukat@inspectest.com,zeeshan.rasheed@inspectest.com.pk,Maheen.Manzoor@inspectest.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 02:53:59', '2021-01-23 09:04:56'),
(1146, 'Engro Fertilizers Limited', '3378860-0', '2', 'Dharki, Distt. Ghotki Sindh.', 0, 'credit', '30 days', 'Altaf Hussain,Shaukat Ali,Naseer Malik', '0300 3198890,0333 7253758,0334 2545617', 'labdhk@engro.com,shali@engroo.com,namalik@engroo.com', 'Shahid Ansari', NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 02:58:58', '2021-01-23 09:04:56'),
(1147, 'Hydrocarbon Development Institute Pakistan', '2281526-7', '2', 'Plot # 18, Street # 6, H-9/1, Islamabad', 0, 'credit', '30 days', 'Qamar Mehdi,Saba Nazir,Muhammad Azhar', '0346 5314818,0322 5077527,0314 7365208', 'mqamar91@gmail.com,sabanazir.shah@gmail.com,mazhar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 03:14:26', '2021-01-23 09:04:56'),
(1148, 'Solehre Brothers Industries', '1417877-1', '2', '12-KM Daska Road, near Mahabat Khan Petrol Pump, Sialkot', 0, 'credit', '30 days', 'Ammar Haider', '0333 8333449', 'info@solehre.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 03:17:12', '2020-10-26 03:17:12'),
(1149, 'Trans Fab', '7300606-4', '2', '19-K.M G.T. Road, Umar Khan Road, Manawan Town, Bata Pur, Lahore', 0, 'credit', '30 days', 'Ramiz Ahmed,Ramiz Ahmed', '0300 4900632,+92-42-36580379', 'ramiz60711@gmail.com,nfo@transfab.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 03:46:14', '2021-01-23 09:04:56'),
(1150, 'Tariq Glass Industries Limited', '1881583-9', '2', '33 kM Sheikhupura Lahore Road Sheikhupura.', 0, 'credit', '30 days', 'Tasleem Hussain,Omer Baig,Shahid Mehmood', '0308 5533778,0321 4466017', 'info@tariqglass.com,info@tariqglass.com,shahid@tariqglass.com', 'Arjumand Mehmood', NULL, 'procurement@tariqglass.com', NULL, NULL, NULL, NULL, '2020-10-26 03:51:19', '2021-01-23 09:04:56'),
(1151, 'STANDPHARM PAKISTAN (PVT) LTD', '0786077-3', '2', '20-Km Ferozpur Road Lahore\r\nLahore', 0, 'credit', '30 days', 'Sohail Bashir,Faisal Shabbir', '03219480378,+923008588232,3334898800', 'sbrain@gmail.com,faisalshabbir1025@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 03:55:00', '2021-01-23 09:04:56'),
(1152, 'World Over Engineering (Pvt) Ltd.', '4221650-8', '2', '20-KM, FEROZEPUR ROAD, 6-KM OFF, RAMAY TEXTILE MILLS, LAHORE. Punjab 54000', 0, 'credit', '30 days', 'Muhammad Atif', '0301 4900495', 'atif.chem.engr@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 03:57:57', '2020-10-26 03:57:57'),
(1153, 'Fresenius Medical Care Pakistan (Pvt) Ltd.', '2810801-9', '2', '27 C, First Floor, TAMC Medical Complex MM Alam Road Gulberg III, Lahore', 0, 'credit', '30 days', 'Muhammad Afsar', '0301 8413991', 'muhammad.afsar@fmc-asia.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:02:37', '2020-10-26 04:02:37'),
(1154, 'Punjab Forensic Science Agency', '9020284-7', '2', 'Old Multan Road, Thokar Niaz Baig, Lahore 54500, Pakistan', 0, 'credit', '30 days', 'Dr. Muhammad Irfan Ashiq', '300 4167 630', 'irfan.ashiq@pfsa.gov.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:08:13', '2020-10-26 04:08:13'),
(1155, 'M-TECH (Multi Technology) Pvt. Limited', '1999292-7', '2', '22 Km, Off Ferozepur Road,\r\nP.O Box 53100, Lahore, Pakistan', 0, 'credit', '30 days', 'Muhammad Atiq,Masood Haider', '0300 9401486', 'qctf.pk@mtechintl.com,masood@mtechintl.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:16:31', '2021-01-23 09:02:58'),
(1156, 'Noor Engineering Services (Pvt) Ltd.', '0860386-3', '2', 'DSU 32/3 & 32/10 Bin Qasim Karachi.', 0, 'credit', '30 days', 'Adeel Ahmed,Majid Mehmood', '0347 2249974,0321-2453581', 'adeelahmed3008@gmail.com,majid@nes.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:20:28', '2021-01-23 09:04:56'),
(1157, 'Descon Engineering Limited', '0803526-1', '2', '18 kM Ferozpur Road Lahore', 0, 'credit', '30 days', 'Mian Abdul Ghaffar', '0300 4934996', 'Mian.Abdul.Ghaffar@descon.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:26:49', '2020-10-26 04:26:49'),
(1158, 'Procon Engineering (Pvt.) Ltd', '0711733-7', '2', '3 kM off Raiwind Road, Manga Mandi Road Kasur', 0, 'credit', '30 days', 'Inayat Ullah,Ahmed Raza', '0320 8585010,0316-9991918/0332-6626190', 'qa.procon@mastertex.com,qc03.procon@mastertex.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:30:38', '2021-01-23 09:04:56'),
(1159, '3W Systems (Pvt) Ltd.', '2530493-3', '2', 'House No. 37, GCP Housing Society Lahore Pakistan.', 0, 'credit', '30 days', 'Maqsood-ul-Hassan,Saqib Raza', '0345 4003581,03009742608', 'accounts@3wsystems.com,saqib@3wsystems.com', 'Saqib Raza', '0301-1212122-0301-1212212', 'saqib@3wsystems.com', NULL, NULL, NULL, NULL, '2020-10-26 04:47:32', '2021-01-23 09:04:56'),
(1160, 'University of Management and Technology (SFAS)', '1957278-6', '2', 'Block C-II, Johar Town Lahore', 0, 'cash', 'advance', 'Aqsa Akhtar,Arooj Bukhat,Dr. Nabeel', '042 35968907 Ext. 2855,0323 4223010,0333 4353699', 'aqsa.akhtar@safasumt.com,urooj.bakht@umt.edu.pk,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:56:00', '2021-01-23 09:04:56'),
(1161, 'VIP Flight 50 Aviation Wing', '802538-0', '2', '50 Aviation Squadron MOI, Kahlid Base Quetta Baluchistan.', 0, 'credit', '30 days', 'Khuda e Nazar,Kashif Khan,Manzoor Hussain', '0320 9319897,0320 9319899,0305 8264929', 'oclad208b@gmail.com,cae.79ec@gmail.com,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 04:59:47', '2021-01-23 09:04:56'),
(1162, 'National Transmission and Dispatch Center (HVSC Lab Fsd)', '2952212-9', '2', 'RTL Faisalabad', 0, 'credit', '30 days', 'Sajeel Zulifqar,Muhammad Kalim Khan', '0300 5232151,0335-7402534', 'hvsclabibd@ntdc.com.pk,hvsclabfsd@ntdc.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 05:04:46', '2021-01-23 09:04:56'),
(1163, 'Global ECO Lab Lahore', '1179090-3', '2', '2nd & 3rd Floors, 4-5 Commercial Area,\r\nCavalry Ground, Lahore Cantt. Pakistan', 0, 'cash', 'against delivery', 'Salma Khalid,Asif Iqbal', '0323 8473962,0345 4586958', 'quality@gel-intl.org,info@gel-intl.org', NULL, NULL, NULL, 'Ghyasuddin', NULL, 'info@gel-intl.org', NULL, '2020-10-26 05:14:14', '2021-01-23 09:04:56'),
(1164, 'Pakistan Petroleum Limited', '0711545-8', '2', 'Gambat South Gas Processing Facility', 0, 'credit', '30 days', 'Adnan Hussain,Dr. Zeeshiar Husnain,Muhammad Haris', '023 5813 062,+92 323 382 4172,0333-7838013', 'H_Adnan@ppl.com.pk,h_zeeshair@ppl.com.pk,M_Haris@ppl.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 05:29:41', '2021-01-23 09:04:56'),
(1165, 'Interloop (Pvt) Ltd. HD3', '0688555-1', '2', 'Denim Division 8 KM Manga Raiwind road Manga Mandi', 0, 'credit', '30 days', 'Ejaz Ahmed,Muhammad Basit Azeem', '0301 8656965,+92 345 7683388, Ext: 6714', 'ejaz.ahmed@interloop.com.pk,basit.azeem@interloop.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 05:39:07', '2021-01-23 09:04:56'),
(1166, 'Blaze Farms (SMC) Pvt Ltd.', '4261873-8', '2', 'Badian Road Lahore', 0, 'cash', 'advance', 'Muhammad Abu Bakar', '0320 9999688', 'abubakar@blazefarms.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 05:53:43', '2020-10-26 05:53:43'),
(1167, 'Blaze Farms (SMC) Pvt Ltd.', '4261873-8', '2', 'Badian Road Lahore', 0, 'cash', 'advance', 'Muhammad Abu Bakar', '0320 9999688', 'abubakar@blazefarms.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 05:53:44', '2020-10-26 05:53:44'),
(1168, 'Etihad Sugar Mills Ltd.', '2599825-7', '2', 'Hangar No. 01, Allama Iqbal Intl Airport Lahore.', 0, 'credit', '30 days', 'Muhammad Ahmed,Muhammad Ahmed', '0333 6496070,+92 333 6496070', 'aeronautical2010@gmail.com,muhammad.ahmed@etihad.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 06:03:00', '2021-01-23 09:04:56'),
(1169, 'Rice Research Institute', '9020000-4', '2', '17 kM GT Raod, Kala Shah Kaku Lahore', 0, 'credit', '30 days', 'Mohsin Ali', '0305 9302526', 'mohsin.rri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 07:20:38', '2020-10-26 07:20:38');
INSERT INTO `customers` (`id`, `reg_name`, `ntn`, `region`, `address`, `credit_limit`, `customer_type`, `pay_terms`, `prin_name`, `prin_phone`, `prin_email`, `pur_name`, `pur_phone`, `pur_email`, `acc_name`, `acc_phone`, `acc_email`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1170, 'Axis Pharmaceuticals', '3157253-7', '2', '3-B, Value Addition City, 1.5km\r\nKhurrianwala-Sahianwala Road, Faisalabad-Pakistan', 0, 'credit', '30 days', 'Zulifqar Ali', '0301 8247929', 'mzulifqar.ahmad@axispharmaceuticals.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 07:39:33', '2020-10-26 07:39:33'),
(1171, 'Environmental Services Pakistan', '7384297-4', '2', 'House No. 731, Block B, Sector D-1, Township, Lahore.', 0, 'credit', '30 days', 'Imran Malik', '0333 7237238', 'imran@espak.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 07:44:11', '2020-10-26 07:44:11'),
(1172, 'PITMEAM PCSIR Lahore', '9013714-7', '2', 'PCSIR Complex Lahore', 0, 'credit', '30 days', 'Muhammad Irfan', '042 99231798', 'pitmaem.lhr@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 07:46:21', '2020-10-26 07:46:21'),
(1173, 'APC & I Center PCSIR Lahore', '9013714-7', '2', 'PCSIR Complex Lahore', 0, 'credit', '30 days', 'Khalid Rasheed', '0321 4083769', 'khalid.rasheed@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 07:49:43', '2020-11-01 02:00:11'),
(1174, 'Extreme Engineering Solution (Pvt) Ltd.', '3611138-4', '2', 'Plot No. 5-B, Sector I 10/3, Islamabad Pakistan', 0, 'credit', '30 days', 'Nadeem Akram,Muhammad Mansha', '0322 4647458', 'nadeem@eespak.com,mansha@eespak.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 07:52:59', '2021-01-23 09:02:58'),
(1175, 'ICS PAKISTAN (PVT) LIMITED', '4095906-6', '2', '2-KM KLP Road near Industrial Estate, Sadiqabad, Distt: Rahim Yar Khan', 0, 'credit', '30 days', 'Muhammad Ijaz,Haq Nawaz,Mansoor Ahmed', '0300 7364979,0300 6207989,300-7882561', 'm.ijaz@icsp.com.pk,haq.nawaz@icsp.com.pk,mansoor.ahmed@ics.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 08:01:39', '2021-01-23 09:04:56'),
(1176, 'Pakarab Fertilizer Limited', '0786750-6', '2', 'Khenwal Road Multan', 0, 'credit', '30 days', 'Zafar Mahmood,Riaz Hussain,Malik Rehan Ahmed', '0333-7801340,0300 6336154,0302 8731265', 'Nill,pflmfg.skeeper@fatima-group.com,rehan.ahmad@fatima-group.com', 'Farhat Malik', NULL, 'pfl.contracts@fatima-group.com', NULL, NULL, NULL, NULL, '2020-10-26 22:21:16', '2021-01-23 09:04:56'),
(1177, 'Elemetec Ltd.', '1021045-8', '2', '19 Km,Ferozpur Road Lahore', 0, 'credit', '30 days', 'Shizwan Shaukat,Khalid Mehmood', '+92-42-3540-1771-75,0300 8191164', 'shizwan.emlm061@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:24:23', '2021-01-23 09:04:56'),
(1178, 'AJC Engineering (Pvt) Ltd', '1323958-9', '2', '86-D, DHA, Phase-12, EME Sector, Commercial Area, Multan Rd, Lahore', 0, 'credit', '30 days', 'Waseem Afzal,Akhtar Ali,Engr. Naeem Ahmed', '0333-7356233,0300 8409114,0322 4979177', 'purchase.officer@ajcengg.pk,akhtar@ajcengg.pk,engr.naeem@ajcengg.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:27:33', '2021-01-23 09:04:56'),
(1179, 'HSE Services Lahore', '1330725-8', '2', '1-B, 47th Commercial Area, Cavalry Ground Lahore', 0, 'credit', '30 days', 'Muhammad Khalid,Faisal Siddiqui,Naeem Sb', '0322-8404846,0300 4893016', 'khalid@hse.com.pk,faisal@hse.com.pk,naeem@hse.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:34:02', '2021-01-23 09:04:56'),
(1180, 'City Super Motorcycle', '2803183-7', '2', 'Mehmood Booti Interchange, Main Service of Ring Road, Astana Saifiya Lakho Dair Lahore-Pakistan.', 0, 'credit', '30 days', 'Maqsood-ul-Haq', '03334998464', 'CitySuper44@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:37:17', '2020-10-31 08:22:08'),
(1181, 'Nuts & Legemes Co.', '3804447-1', '2', '90-91, Muzzamil Town, Multan Road Chung Lahore.', 0, 'credit', '30 days', 'Syed Farjad Hussain,Muhammad Omer', '0320-4791050,0344 4413331', 'kashif.elahi@hotmail.com,mrmalik30@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:42:42', '2021-01-23 09:04:56'),
(1182, 'Starco Fans', '3203457-1', '2', '183-C Small Industries Estate G.T Road Gujrat-Pakistan', 0, 'credit', '30 days', 'Izhar Ahmed Awan,Mohsin Naeem', '0301-8720329,0323 7447277', 'izhar.ahmed@starcofans.com,mohsin.naeem@starcofans.com', NULL, NULL, NULL, 'Hassan Raza', NULL, NULL, NULL, '2020-10-26 22:47:30', '2021-01-23 09:04:56'),
(1183, 'Transfopower Industries (Pvt.) Limited', '0786364-7', '2', '2km, Katar Bund Road, Off. Multan Road, Thokar Niaz Beg, Lahore', 0, 'credit', '30 days', 'M.Kashif,Shahid Rafiq,Amir Sultan Rana', '0321-7684402,0346 4083193', 'm.kashif414@gmail.com,shahid.rafique@transfopower.net,amir.sultan@transfopower.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:50:32', '2021-01-23 09:04:56'),
(1184, '4 AIJJ Traders', '7320036-2', '2', 'Old Chungi No.08, L.M.Q road Multan Pakistan.', 0, 'credit', '30 days', 'Junaid Baig', '324464724', 'junaid.baig@4ajj.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:55:16', '2021-01-10 22:51:39'),
(1185, 'Stylers International LTD.', '0786387-0', '2', '20 Km Ferozepur Road, Glaxo Town Lahore Pakistan', 0, 'credit', '30 days', 'Ammar Shakeel,Azhar Ali Hashmat,M. Ibrahim Sabir', '0334-4595230,0300 7769965,03234438648, 03334569058', 'ammar@stylersintl.com,azharhashmat@stylersintl.com,compliance@stylersintl.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-26 22:58:50', '2021-01-23 09:04:56'),
(1186, 'NEC Consultant Pvt LTD.', '2602336-9', '2', 'Perfect site Plot # 18, 22Km Off Ferozepur Road, Near  GajJu Matta, Lahore.', 0, 'credit', '30 days', 'Shafqat Ullah,Mr. Azher Uddin Khan,Nasir Mehmood', '0300 94820298,0300-8454061', 'necnorth@nec.com.pk,necnorth@nec.com.pk,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 22:42:52', '2021-01-23 09:04:56'),
(1187, 'Global Environmental Lab', '1179090-3', '2', '2nd and 3rd Floor, 4 & 5 Commercial Area, Main Cavalry Ground, Lahore', 0, 'credit', '30 days', 'Asif Iqbal,Salma Khalid,Fawad Iqbal', '042-36670097,0323 8473962,0300-0771340', 'info@gel-intl.org,quality@gel-intl.org,fawad@gel.com.pk', NULL, NULL, NULL, 'Ghyasudin', '042-36670097, 36670098', 'info@gel-intl.org', NULL, '2020-10-28 22:48:16', '2021-01-23 09:04:56'),
(1188, 'Punjab Forensic Science Agency', '9020284-7', '2', 'Old Multan Road, Thokar Niaz Baig, Lahore 54500, Pakistan.', 0, 'credit', '30 days', 'Dr. Irfan,Muhammad Asif,Ayyaz Ashraf', '0300-4167630,03218936855,03351715217', 'irfan.ashiq@pfsa.gop.pk,pmusdi@gmail.com,pmusdi@gmail.com', NULL, NULL, NULL, 'Sajid Hussain', NULL, NULL, NULL, '2020-10-28 22:55:58', '2021-01-23 09:04:56'),
(1189, 'CLEANING SOLUTIONS (PRIVATE) LIMITED', '4052683-6', '2', 'PLOT # 21 & 42, INDUSTRIAL ESTATE, PHASE-II, Multan Cantt. Sher Shah Town', 0, 'credit', '30 days', 'Syed Kazim Ali,Nadim Abrar', '0308-8883562', 'kazim.syed@cspl.com.pk,nadimibr@gmail.com', NULL, NULL, NULL, 'Nadeem Ahmed', NULL, NULL, NULL, '2020-10-28 22:58:21', '2021-01-23 09:02:59'),
(1190, 'First Treet Manufacturing Modaraba', '2551646-9', '2', '72-B Industrial Area Kot Lakhpat Lahore Pakistan', 0, 'credit', '30 days', 'Shahid Mehmood,Muhammad Hafeez', '0321-8857250', 'shahid.mehmood@treetbike.com,muhammad.hafeez@treetbike.com', 'Muneeb Najam Butt', '+92 (42)111 187 338 EXT:613', 'muneeb.najam@treetonline.com', NULL, NULL, NULL, NULL, '2020-10-28 23:00:51', '2021-01-23 09:02:59'),
(1191, 'Bestway Cement LTD.', '0656656-1', '2', '12 km, Taxila – Haripur Road, Farooqia, Tehsil & Distt. Haripur | KPK, Pakistan.', 0, 'cash', 'advance', 'Adeel Afzal,Mumtaz Ur Rehman,Nohman Mahmud', '0310-3339298,+92 317 7700274,+92   322 5001998', 'adeel.afzal@bestway.com.pk,electricalmcl@bestway.com.pk,qcmcl@bestway.com.pk', 'Purchaser', '03040647307-03010893452', 'email@gmail.com', 'Azfar Nadeem', '051 2654856', 'azfar.nadeem@bestway.com', NULL, '2020-10-28 23:03:53', '2021-01-23 09:04:56'),
(1192, 'Sunrise Pharmaceuticals', '3803561-8', '2', 'Plot No. 594-A, Sunder Industrial Estate, Raiwind Road Lahore', 0, 'cash', 'against delivery', 'Zia ur Rehman,Sadia Abrar', '0332 4210465', 'zia4944@gmail.com,sadiaabrar11@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 02:51:44', '2021-01-23 09:02:59'),
(1193, 'Air Borne Aviation', '4138104-1', '2', '10F- Walton Aerodrome, Gulberg III, Lahore.', 0, 'cash', 'against delivery', 'Muhammad Asim Chief Engineer,Rameez Hassan', '0335 6238883', 'airborneengineering123@gmail.com,airborneengineering123@gmail.com', 'name', '0300-0301', 'emaail@gmail.com', NULL, NULL, NULL, NULL, '2020-10-31 02:56:47', '2021-01-23 09:02:59'),
(1194, 'Pakistan Drugs Testing and Research Center', '1962954-7', '2', 'Sunder Industrial Estate, Raiwind Road Lahore', 0, 'credit', '30 days', 'Zahid Masood', '0322 4536718', 'zahidmasood13@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 03:06:44', '2020-10-31 03:06:44'),
(1195, 'Century Paper & Boards Mills Pakistan', '0710009-4', '2', '62 kM, Lahore Multan Highway, Bhai Pheru Distt. Kasur.', 0, 'credit', '30 days', 'Abid Ali Shah,Haris Rana HR,Tariq Javeed', '03364851732,0300 4000436,03113991041', 'abid-ali@centurypaper.com.pk,haris-rana@centurypaper.com.pk,bxp-qas@centurypaper.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 03:10:57', '2021-01-23 09:04:56'),
(1196, 'DG Cement (Pvt) Ltd.', '1213275-6', '2', '12- kM, Choa Saiden Shah-Kallar Kahar Road Distt. Chakwal', 0, 'credit', '30 days', 'Sarfraz Ahmed,Sajid Habib', '0323-7015907,03214099180', 'sarfraz.ahmad@dgcement.com,shabib@dgcement.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 03:18:20', '2021-01-23 09:04:56'),
(1197, 'FOUR BROTHERS AGRI SERVICES PAKISTAN', '3279043-7', '2', 'Rohi Nala Rd, Lahore, Punjab 54000', 0, 'credit', '30 days', 'Javed Iqbal', '0320 0500165', 'j.iqbal@4bgroup.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 03:34:16', '2020-11-25 20:21:52'),
(1198, 'AJC Engineering (Pvt) Ltd', '1323958-9', '2', '86-D, DHA Phase-12, EME Sector, Commercial Area, Multan Road, Lahore', 0, 'credit', '30 days', 'Waseem Afzal,Amir Zafar,Muhammad Saeed', '0333 7356233,0300 8416632,03004023449', 'purchase.officer@ajcengg.pk,azafar@ajceng.pk,m.saeed@ajcengg.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 05:11:41', '2021-01-23 09:04:56'),
(1199, 'ELMETEC (PRIVATE) LIMITED', '1021045-8', '2', '19-KM, FEROZEPUR ROAD, NEAR GLAXO FACTORY, Lahore Nishter Town', 0, 'credit', '30 days', 'Shizwan Shaukat,Khalid Javeed', '035401771,0300 8191164', 'shizwan.eplm061@gmail.com,elmetec@elmetecgroup.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 05:55:17', '2021-01-23 09:04:56'),
(1200, 'Volka Foods International Limited', '7324134-6', '2', '3 kM Bahawalpur bypass, Bahawalpur Road Multan.', 0, 'credit', '30 days', 'Muhammad Shafique,Ijaz Hussain', '0335 6111206,0304 0049025', 'm.shafiq@visionpackaging.com.pk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 06:51:57', '2021-01-23 09:04:56'),
(1201, 'Skyways Aviation Pvt. Ltd', '7583948-8', '2', 'Etihad Sugar Mills Hanger No. 1, Hajj Terminal, Allama Iqbal Airport Lahore.', 0, 'credit', '30 days', 'Muhammad Ahmed', '0333 6496070', 'aeronautical2010@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-31 07:02:57', '2020-10-31 07:32:12'),
(1210, 'Testing Customer', '-023401-2034-11344', '2', 'physical address', 0, 'cash', 'advance', 'principal', '0301920304', 'principal@gmail.com', 'purchase', NULL, 'purchase@gmail.com', 'Acc', '03012345678', 'acc@gmail.com', '2020-12-23 03:17:09', '2020-12-19 02:21:30', '2020-12-23 03:17:09'),
(1211, 'Haji Sheikh Noor ud Din & Sons Pvt Ltd', '0688328-1', '2', '4km, Kahna Kaacha Road, Ferozpur Road, Lahore', 0, 'credit', '30 days', 'Rana Umer', '03164711375', 'rana.umer@hsnds.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-22 03:25:20', '2020-12-22 03:25:20'),
(1212, 'Name of Customer', '8904123', '2', 'physical address', 0, 'cash', 'against delivery', 'prin1,prin2,prin3', 'phon1,phon2,prin3', 'email,email2,email3', 'pur1', 'phon1,phone1', 'email', 'name1acc', 'accphonr,accphone', 'email', NULL, '2021-01-23 15:10:31', '2021-01-23 15:10:31'),
(1213, 'Name', '9023501', '2', 'physical address', 0, 'cash', 'advance', ',,', ',,', ',,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-23 15:11:11', '2021-01-23 15:11:11'),
(1214, 'name', '920349', '2', 'physical', 0, 'cash', 'advance', 'name,,', ',,', ',,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-23 15:19:14', '2021-01-23 15:19:14'),
(1215, 'name', 'ntn', '2', 'physical address', 0, 'cash', 'advance', 'name,,', 'phone,,', 'email,,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-23 16:24:56', '2021-01-23 16:24:56'),
(1216, 'name', 'ntn', '2', 'address', 0, 'cash', 'against delivery', 'name,name,name', 'email,phone,phone', 'phone,email,email', 'name', 'phone,phone2', 'email', 'name', 'phone,phone2', 'email', NULL, '2021-01-23 16:43:44', '2021-01-23 16:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `head`, `created_at`, `updated_at`) VALUES
(1, 'General Administration', 1, '2020-09-25 00:19:50', '2020-10-11 02:51:35'),
(2, 'Marketing & Proposal', 1, '2020-09-25 13:15:36', '2020-09-25 13:15:36'),
(3, 'Technical Management', 1, '2020-09-25 13:15:53', '2020-09-25 13:15:53'),
(4, 'Purchase Sales & Store', 1, '2020-09-25 13:16:10', '2020-10-11 02:52:18'),
(5, 'Quality Assurance and Control', 1, '2020-09-25 13:16:33', '2020-10-11 02:52:47'),
(6, 'Finance and Accounting', 1, '2020-09-25 13:16:45', '2020-10-11 02:53:10'),
(7, 'Software Department', 1, '2020-12-21 23:10:36', '2020-12-21 23:10:36'),
(8, 'Store & Purchase', 1, '2021-01-14 10:13:17', '2021-01-14 10:13:17'),
(9, 'Testing Log', 1, '2021-01-22 10:32:48', '2021-01-22 10:32:48'),
(10, 'Testing Purposes', 3, '2021-01-22 10:41:39', '2021-01-22 15:05:38'),
(11, 'ewe', 2, '2021-01-22 10:43:21', '2021-01-22 10:43:21'),
(12, 'New Department', 1, '2021-01-22 10:43:32', '2021-01-22 15:06:43'),
(13, 'New Department', 1, '2021-01-22 15:11:15', '2021-01-22 15:11:15'),
(14, 'Command ', 1, '2021-01-27 03:33:28', '2021-01-27 03:33:28'),
(15, 'Command ', 1, '2021-01-27 04:53:00', '2021-01-27 04:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `department_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chief Executive Officer', '2020-10-11 03:01:39', '2020-10-11 03:01:39'),
(2, 1, 'General Manager', '2020-10-11 03:01:54', '2020-10-11 03:01:54'),
(3, 1, 'Admin Officer', '2020-10-11 03:02:20', '2020-10-11 03:02:20'),
(4, 1, 'HR Executive', '2020-10-11 03:02:35', '2020-10-11 03:02:35'),
(5, 2, 'Marketing Executive', '2020-10-11 03:03:11', '2020-10-11 03:03:11'),
(6, 2, 'Proposal Officer', '2020-10-11 03:03:28', '2020-10-11 03:03:28'),
(7, 3, 'Technical Manager', '2020-10-11 03:03:50', '2020-10-11 03:03:50'),
(8, 3, 'Lab Incharge', '2020-10-11 03:04:33', '2020-10-11 03:04:33'),
(9, 3, 'Calibration, Inspection and Testing Engineer', '2020-10-11 03:05:52', '2020-10-11 03:05:52'),
(10, 3, 'Calibration Technician', '2020-10-11 03:06:22', '2020-10-11 03:06:22'),
(11, 4, 'Purchase Officer', '2020-10-11 03:07:45', '2020-10-11 03:07:45'),
(12, 4, 'Sales Executive', '2020-10-11 03:08:03', '2020-10-11 03:08:03'),
(13, 4, 'Incharge Stores', '2020-10-11 03:08:32', '2020-10-11 03:08:32'),
(14, 5, 'Manager QA/QC', '2020-10-11 03:09:44', '2020-10-11 03:09:44'),
(15, 6, 'Manager Finance', '2020-10-11 03:10:19', '2020-10-11 03:10:19'),
(16, 6, 'Accounting Officer', '2020-10-11 03:10:38', '2020-10-11 03:10:38'),
(17, 7, 'Software Developer', '2020-12-21 23:11:03', '2021-01-22 15:25:07'),
(18, 3, 'Calibration Managers', '2020-12-21 23:39:23', '2021-01-22 15:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `dialgauge_entries`
--

CREATE TABLE `dialgauge_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empcontracts`
--

CREATE TABLE `empcontracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` int(11) NOT NULL,
  `termination_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `probation_applicable` int(11) NOT NULL,
  `probation_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designations` int(11) NOT NULL,
  `place_of_work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `allowances` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representative` int(11) NOT NULL,
  `commencement` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hr_user_id` int(11) DEFAULT NULL,
  `joining` date DEFAULT NULL,
  `o_area` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orientator` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empcontracts`
--

INSERT INTO `empcontracts` (`id`, `appraisal_id`, `termination_period`, `probation_applicable`, `probation_period`, `designations`, `place_of_work`, `salary`, `allowances`, `cnic`, `representative`, `commencement`, `status`, `signature`, `hr_user_id`, `joining`, `o_area`, `remarks`, `orientator`, `created_at`, `updated_at`) VALUES
(1, 1, 'one-year', 1, 'three-months', 12, 'Al-Meezan Industrial Metrology Services (AIMS), Lahore, Pakistan', 40000, 'na', '331012-191203894-1', 0, '2021-02-02', 2, '1612249348-aims-business-card.JPG', 1, '2021-02-02', '{\"introduction-to-key-personnel\":1,\"facility-and-operations-familiarization\":1,\"review-of-safety-regulations\":1,\"disciplinary-instructions\":1,\"conduct-with-clients-and-colleagues\":1,\"company-organization-chart\":1,\"function-of-different-departments\":1,\"individual-responsibility-and-understanding-of-quality-policy\":1,\"companys-quality-assurance-manual-and-AIMS-standard-or-procedures\":1,\"contractual-obligations-of-personnel\":1}', 'remarks', 3, '2021-02-02 07:00:17', '2021-02-02 07:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formsandformats`
--

CREATE TABLE `formsandformats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sops` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue` date DEFAULT NULL,
  `reviewed_on` date DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_of_storage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formsandformats`
--

INSERT INTO `formsandformats` (`id`, `name`, `sops`, `parent_id`, `doc_no`, `rev_no`, `issue_no`, `file`, `issue`, `reviewed_on`, `reviewed_by`, `status`, `location`, `mode_of_storage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'AIMS-HR-SOP-01 Personal Management', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-25 02:42:09', '2020-12-25 02:42:09'),
(3, NULL, NULL, '2', 'AIMS-HR-01', '05', '05', '25-12-201608734994-default_avatar_male.jpg', '2020-12-25', '2020-12-25', 1, 0, 'QEA', 'soft-copy', NULL, '2020-12-25 02:42:43', '2020-12-25 02:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `generaldataentries`
--

CREATE TABLE `generaldataentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `fixed_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generaldataentries`
--

INSERT INTO `generaldataentries` (`id`, `parent_id`, `x1`, `x2`, `x3`, `x4`, `x5`, `x6`, `asset_id`, `unit`, `fixed_value`, `data`, `created_at`, `updated_at`) VALUES
(1, 5, '10.1', '10.2', '10.3', '10.4', '10.4', NULL, 26, 1, '10', '{\"id\":1,\"final-error\":-0.27811606689203927,\"standard-deviation\":0.1303840481040534,\"uncertainty-type-a\":0.058309518948453196,\"combined-uncertainty-of-standard\":0.015,\"uncertainty-due-to-resolution-of-uuc\":0.008660254037844387,\"uncertainty-due-to-accuracy-of-uuc\":0.05773502691896258,\"drift-of-the-standard\":0.017320508075688773,\"uncertainty-due-to-offset-of-uuc\":0,\"uncertainty-due-to-hysteresis-uuc\":-0.009622504486494241,\"uncertainty-due-to-drift-in-temperature\":0,\"uncertainty-due-to-resolution-of-std\":0,\"uncertainty-due-to-temperature-stability-of-chamber\":0,\"uncertainty-due-to-function-generator\":0,\"uncertainty-of-standard-obtained-from-cert-of-ph-buffer\":0,\"combined-uncertainty\":0.08617381229773903,\"expanded-uncertainty\":0.17234762459547806}', '2021-04-10 12:56:43', '2021-04-10 12:56:43'),
(2, 5, '20.1', '20.3', '20.3', '20.4', '20.4', NULL, 26, 1, '20', '{\"id\":2,\"final-error\":-0.29978970814746475,\"standard-deviation\":0.12247448713915775,\"uncertainty-type-a\":0.05477225575051609,\"combined-uncertainty-of-standard\":0.015,\"uncertainty-due-to-resolution-of-uuc\":0.008660254037844387,\"uncertainty-due-to-accuracy-of-uuc\":0.05773502691896258,\"drift-of-the-standard\":0.017320508075688773,\"uncertainty-due-to-offset-of-uuc\":0,\"uncertainty-due-to-hysteresis-uuc\":-0.024056261216234068,\"uncertainty-due-to-drift-in-temperature\":0,\"uncertainty-due-to-resolution-of-std\":0,\"uncertainty-due-to-temperature-stability-of-chamber\":0,\"uncertainty-due-to-function-generator\":0,\"uncertainty-of-standard-obtained-from-cert-of-ph-buffer\":0,\"combined-uncertainty\":0.08667200838238932,\"expanded-uncertainty\":0.17334401676477865}', '2021-04-10 12:56:43', '2021-04-10 12:56:43'),
(3, 6, '40', '41', '42', '42', NULL, NULL, 0, 0, '372', NULL, '2021-04-10 13:58:42', '2021-04-10 13:58:42'),
(4, 6, '201', '202', '200.3', '201.4', NULL, NULL, 0, 0, '375', NULL, '2021-04-11 05:54:56', '2021-04-11 05:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `incubatordataentries`
--

CREATE TABLE `incubatordataentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `set_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuc_indication` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incubatordataentries`
--

INSERT INTO `incubatordataentries` (`id`, `parent_id`, `x1`, `x2`, `x3`, `asset_id`, `unit`, `set_value`, `uuc_indication`, `data`, `channel`, `created_at`, `updated_at`) VALUES
(5, 4, '58.4', '58.3', '58.3', 30, 1, '60', '60', '{\"id\":5,\"final-error\":-3.244437751004014,\"standard-deviation\":0.05773502691896339,\"uncertainty-type-a\":0.033333333333333805,\"combined-uncertainty-of-standard\":0.26,\"uncertainty-due-to-resolution-of-uuc\":0.02886751345948129,\"combined-uncertainty\":1.091801263967028,\"expanded-uncertainty\":2.183602527934056,\"uncertainty-due-to-repeatability-of-indication-of-uuc-u6\":2.183602527934056,\"uncertainty-due-to-temp-instability-of-uuc-u8\":2.183602527934056,\"uncertainty-due-to-radiation-effect-u9\":2.183602527934056,\"uncertainty-due-to-loading-effect-u10\":2.183602527934056}', 9, '2021-02-23 14:20:29', '2021-02-24 12:40:34'),
(6, 4, '88.8', '89', '88.9', 30, 1, '90', '90', '{\"id\":6,\"final-error\":-2.733012048192748,\"standard-deviation\":0.10000000000000142,\"uncertainty-type-a\":0.0577350269189634,\"combined-uncertainty-of-standard\":0.26,\"uncertainty-due-to-resolution-of-uuc\":0.02886751345948129,\"combined-uncertainty\":1.091801263967028,\"expanded-uncertainty\":2.183602527934056,\"uncertainty-due-to-repeatability-of-indication-of-uuc-u6\":2.183602527934056,\"uncertainty-due-to-temp-instability-of-uuc-u8\":2.183602527934056,\"uncertainty-due-to-radiation-effect-u9\":2.183602527934056,\"uncertainty-due-to-loading-effect-u10\":2.183602527934056}', 9, '2021-02-23 14:20:29', '2021-02-24 12:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `incubatormappings`
--

CREATE TABLE `incubatormappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `time_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_6` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_7` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_8` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_9` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_10` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuc_reading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incubatormappings`
--

INSERT INTO `incubatormappings` (`id`, `parent_id`, `time_interval`, `channel_1`, `channel_2`, `channel_3`, `channel_4`, `channel_5`, `channel_6`, `channel_7`, `channel_8`, `channel_9`, `channel_10`, `uuc_reading`, `data`, `created_at`, `updated_at`) VALUES
(1, 4, '1', '40.20', '40.61', '40.55', '40.36', '40.40', '40.35', '40.43', '40.53', '40.46', '40.91', '40.99', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(2, 4, '2', '40.28', '40.32', '40.92', '40.12', '40.74', '40.76', '40.48', '40.79', '40.78', '40.85', '40.14', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(3, 4, '3', '40.68', '40.12', '40.81', '40.27', '40.75', '40.80', '40.84', '40.82', '40.80', '40.91', '40.34', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(4, 4, '4', '40.23', '40.57', '40.25', '40.54', '40.65', '40.14', '40.25', '40.24', '40.28', '40.99', '40.91', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(5, 4, '5', '40.68', '40.23', '40.14', '40.42', '40.37', '40.91', '40.42', '40.43', '40.29', '40.10', '40.52', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(6, 4, '6', '40.79', '40.65', '40.26', '40.76', '40.71', '40.64', '40.27', '40.43', '40.36', '40.43', '40.86', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(7, 4, '7', '40.46', '40.35', '40.47', '40.47', '40.17', '40.24', '40.60', '40.46', '40.92', '40.96', '40.62', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(8, 4, '8', '40.83', '40.89', '40.56', '40.29', '40.48', '40.98', '40.74', '40.57', '40.86', '40.25', '40.28', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(9, 4, '9', '40.62', '40.65', '40.24', '40.15', '40.62', '40.12', '40.66', '40.27', '40.67', '40.81', '40.81', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(10, 4, '10', '40.74', '40.82', '40.67', '40.86', '40.25', '40.26', '40.62', '40.28', '40.19', '40.33', '40.42', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(11, 4, '11', '40.95', '40.32', '40.33', '40.96', '40.29', '40.76', '40.13', '40.38', '40.65', '40.48', '40.66', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(12, 4, '12', '40.31', '40.60', '40.83', '40.25', '40.32', '40.18', '40.41', '40.91', '40.93', '40.32', '40.29', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(13, 4, '13', '40.45', '40.83', '40.67', '40.57', '40.10', '40.45', '40.52', '40.35', '40.55', '40.81', '40.62', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(14, 4, '14', '40.64', '40.49', '40.58', '40.98', '40.76', '40.99', '40.69', '40.83', '40.50', '40.84', '40.66', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(15, 4, '15', '40.64', '40.17', '40.46', '40.93', '40.51', '40.84', '40.75', '40.15', '40.81', '40.60', '40.11', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(16, 4, '16', '40.45', '40.63', '40.92', '40.44', '40.88', '40.21', '40.44', '40.15', '40.17', '40.49', '40.25', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(17, 4, '17', '40.10', '40.98', '40.50', '40.61', '40.43', '40.53', '40.17', '40.42', '40.16', '40.10', '40.18', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(18, 4, '18', '40.11', '40.51', '40.46', '40.33', '40.98', '40.14', '40.17', '40.75', '40.16', '40.15', '40.64', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(19, 4, '19', '40.87', '40.35', '40.76', '40.81', '40.94', '40.96', '40.75', '40.32', '40.96', '40.44', '40.32', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(20, 4, '20', '40.18', '40.35', '40.10', '40.28', '40.41', '40.52', '40.67', '40.92', '40.63', '40.11', '40.49', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(21, 4, '21', '40.14', '40.91', '40.96', '40.53', '40.33', '40.56', '40.95', '40.37', '40.18', '40.12', '40.64', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(22, 4, '22', '40.91', '40.17', '40.42', '40.37', '40.11', '40.81', '40.51', '40.41', '40.78', '40.39', '40.62', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(23, 4, '23', '40.27', '40.65', '40.34', '40.71', '40.71', '40.46', '40.58', '40.84', '40.52', '40.78', '40.71', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(24, 4, '24', '40.56', '40.19', '40.90', '40.74', '40.63', '40.32', '40.93', '40.44', '40.73', '40.12', '40.22', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(25, 4, '25', '40.64', '40.44', '40.94', '40.80', '40.62', '40.12', '40.83', '40.42', '40.32', '40.30', '40.95', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(26, 4, '26', '40.54', '40.65', '40.60', '40.69', '40.12', '40.48', '40.20', '40.95', '40.34', '40.77', '40.98', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(27, 4, '27', '40.39', '40.42', '40.30', '40.23', '40.47', '40.21', '40.51', '40.29', '40.90', '40.94', '40.67', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(28, 4, '28', '40.37', '40.91', '40.38', '40.55', '40.86', '40.31', '40.52', '40.12', '40.74', '40.65', '40.56', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(29, 4, '29', '40.32', '40.83', '40.80', '40.45', '40.83', '40.12', '40.94', '40.13', '40.10', '40.94', '40.98', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(30, 4, '30', '40.10', '40.78', '40.20', '40.52', '40.55', '40.74', '40.48', '40.13', '40.57', '40.80', '40.51', NULL, '2021-02-24 07:22:55', '2021-02-24 07:22:55'),
(31, 4, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '{\"start_time\":\"08:09\",\"end_time\":\"08:09\",\"normal\":\"9\",\"black\":\"10\"}', '2021-02-24 09:01:28', '2021-02-24 09:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `intermediatechecksofassets`
--

CREATE TABLE `intermediatechecksofassets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_under_test_id` int(11) DEFAULT NULL,
  `check_reference_id` int(11) DEFAULT NULL,
  `reference_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measured_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intermediatechecksofassets`
--

INSERT INTO `intermediatechecksofassets` (`id`, `equipment_under_test_id`, `check_reference_id`, `reference_value`, `measured_value`, `created_at`, `updated_at`) VALUES
(9, 1, 2, '100', '100.2,100.2,100.4,100.1,100.6,100.9,100.8,100.7,100.5,100.3', '2020-12-22 08:33:46', '2020-12-22 08:33:46'),
(10, 1, 2, '100', '100.2,100.9,100.1,100.5', '2020-12-22 08:49:15', '2020-12-22 08:49:15'),
(11, 1, 2, '100', '100,100,100,100', '2020-12-22 09:36:04', '2020-12-22 09:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `interviewappraisals`
--

CREATE TABLE `interviewappraisals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `basic_qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_qualification_duration` int(11) NOT NULL,
  `highest_qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `highest_qualification_duration` int(11) NOT NULL,
  `bu_for_candidate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relevant_experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desired_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_traits` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `suitable_for_other_department` int(11) NOT NULL,
  `evaluator` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviewappraisals`
--

INSERT INTO `interviewappraisals` (`id`, `fname`, `lname`, `age`, `basic_qualification`, `basic_qualification_duration`, `highest_qualification`, `highest_qualification_duration`, `bu_for_candidate`, `relevant_experience`, `total_experience`, `last_salary`, `desired_salary`, `personal_traits`, `suitable_for_other_department`, `evaluator`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad', 'Azeem', 22, 'Matriculation', 2, 'BS Software Engineering', 4, 'consultancy-services', 'Web Designing', '2', '25000', '45000', '{\"education\":\"4\",\"computer_literacy\":\"2\",\"intelligence\":\"1\",\"experience_related_to_the_job_interviewed_for\":\"4\",\"experience_related_to_the_other_lines_of_company_business\":\"4\",\"job_knowledge_skills\":\"3\",\"personality\":\"0\",\"communication_skills\":\"5\",\"development_potential_motivation\":\"4\",\"personal_aptitude_related_to_the_job_interviewed_for\":\"5\"}', 7, 1, '2021-02-02 06:44:20', '2021-02-02 06:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `depreciation` int(11) NOT NULL,
  `depreciation_times` int(11) NOT NULL,
  `depreciation_max` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `title`, `category_id`, `department_id`, `status`, `consumable`, `price`, `model`, `description`, `user_id`, `depreciation`, `depreciation_times`, `depreciation_max`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Corolla', 2, 1, '1', 'on', '1950000', '2019', 'On Installments', 1, 0, 0, 0, NULL, '2021-03-22 15:35:59', '2021-03-22 15:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `inventories_quantity`
--

CREATE TABLE `inventories_quantity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories_quantity`
--

INSERT INTO `inventories_quantity` (`id`, `inventory_id`, `serial_no`, `quantity_type`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'CorollaEED2', 'IN', 1, '0', NULL, '2021-03-22 15:31:41', '2021-03-22 15:31:41'),
(2, 2, 'CorollaA74C', 'IN', 1, '0', NULL, '2021-03-22 15:31:41', '2021-03-22 15:31:41'),
(3, 1, 'Corolla7500', 'IN', 1, '0', NULL, '2021-03-22 15:35:59', '2021-03-22 15:35:59'),
(4, 1, 'Corolla026F', 'IN', 1, '0', NULL, '2021-03-22 15:35:59', '2021-03-22 15:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `inventorycategories`
--

CREATE TABLE `inventorycategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventorycategories`
--

INSERT INTO `inventorycategories` (`id`, `category_name`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Stationery', 'Active', 1, NULL, '2021-03-22 13:18:52', '2021-03-22 13:18:52'),
(2, 'Vehicles', 'Active', 1, NULL, '2021-03-22 13:19:03', '2021-03-22 13:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `invoicing_ledgers`
--

CREATE TABLE `invoicing_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_charges` int(11) NOT NULL,
  `service_tax_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'PRA SRB etc',
  `service_tax_percent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_tax_amount` int(11) NOT NULL,
  `income_tax_percent` int(11) NOT NULL COMMENT 'SRO budget like 3%',
  `income_tax_amount` int(11) NOT NULL,
  `service_tax_deducted` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'by aims or at source',
  `income_tax_deducted` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'by aims or at source',
  `net_receivable` int(11) NOT NULL,
  `srb_type` int(11) DEFAULT NULL COMMENT '0 if pays 100% 20% if he pays 80%',
  `confirmed_by_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'invoice confirmed by',
  `confirmed_by_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` date NOT NULL,
  `invoice_no` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `parameter` int(11) NOT NULL,
  `capability` int(11) NOT NULL,
  `not_available` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accredited` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `range` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rf_checks` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `quote_id`, `status`, `parameter`, `capability`, `not_available`, `location`, `accredited`, `range`, `price`, `quantity`, `rf_checks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1000, 1000, 0, 27, 863, NULL, 'lab', 'yes', '-20~650', 6000, 1, NULL, NULL, '2021-02-21 15:11:35', '2021-02-21 15:11:35'),
(1001, 1000, 0, 27, 907, NULL, 'lab', 'yes', '35~650', 3000, 1, NULL, NULL, '2021-02-21 15:12:01', '2021-02-21 15:12:01'),
(1002, 1000, 0, 3, 207, NULL, 'lab', 'no', '50', 3000, 1, NULL, NULL, '2021-02-21 15:12:28', '2021-02-21 15:12:28'),
(1003, 1000, 0, 6, 271, NULL, 'lab', 'no', '50~15000', 8000, 1, NULL, NULL, '2021-02-21 15:14:23', '2021-02-21 15:14:23'),
(1004, 1000, 0, 3, 187, NULL, 'lab', 'no', '49', 3000, 1, NULL, NULL, '2021-02-21 15:14:41', '2021-02-21 15:14:41'),
(1005, 1000, 0, 31, 954, NULL, 'lab', 'yes', '100', 6000, 1, NULL, NULL, '2021-02-26 13:00:38', '2021-02-26 13:00:38'),
(1006, 1001, 0, 19, 808, NULL, 'lab', 'yes', '0~100', 4000, 1, NULL, NULL, '2021-03-26 09:23:38', '2021-03-26 09:23:38'),
(1007, 1002, 0, 3, 18, NULL, 'lab', 'yes', '0~1000', 6000, 1, NULL, NULL, '2021-04-02 12:55:43', '2021-04-02 12:55:43'),
(1008, 1003, 0, 3, 25, NULL, 'lab', 'no', '10~25', 2500, 1, NULL, NULL, '2021-04-09 09:48:40', '2021-04-09 09:48:40'),
(1009, 1004, 0, 3, 211, NULL, 'lab', 'yes', '1~10', 3000, 1, NULL, NULL, '2021-04-09 11:56:46', '2021-04-09 11:56:46'),
(1010, 1005, 0, 27, 906, NULL, 'lab', 'yes', '35~650', 3000, 1, NULL, NULL, '2021-04-10 12:38:32', '2021-04-10 12:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobitems`
--

CREATE TABLE `jobitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT 'lab-0/site-1',
  `job_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `eq_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accuracy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `range` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visual_inspection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `assign_user` int(11) DEFAULT NULL,
  `assign_assets` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_users` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_assets` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobitems`
--

INSERT INTO `jobitems` (`id`, `type`, `job_id`, `item_id`, `eq_id`, `serial`, `resolution`, `accuracy`, `range`, `model`, `make`, `accessories`, `visual_inspection`, `status`, `start`, `end`, `started_at`, `ended_at`, `assign_user`, `assign_assets`, `group_users`, `group_assets`, `certificate`, `created_at`, `updated_at`) VALUES
(1, 0, 1000, 1000, 'equipment 1', 'serial1', '0.1', '0.3', '10,100', 'model1', 'make1', 'NILL', 'OK', 3, '2021-02-21', '2021-02-21', '2021-02-21 20:50:06', NULL, 1, '34,35', NULL, NULL, NULL, '2021-02-21 15:16:31', '2021-02-22 11:10:29'),
(2, 0, 1000, 1001, 'equipment2', 'serial2', '0.1', '0.5', '10,100', 'model2', 'make2', 'NILL', 'OK', 3, '2021-02-21', '2021-02-21', '2021-02-21 21:32:23', NULL, 1, '93', NULL, NULL, NULL, '2021-02-21 15:16:31', '2021-02-21 16:36:21'),
(3, 0, 1000, 1002, 'equipment3', 'serial3', '0.1', '0.5', '10,100', 'model3', 'make3', 'NILL', 'OK', 3, '2021-02-22', '2021-02-22', '2021-02-22 15:08:28', NULL, 1, '30', NULL, NULL, NULL, '2021-02-21 15:16:31', '2021-02-22 10:13:20'),
(4, 0, 1000, 1003, 'equipment', 'serial', '0.01', '0.5', '10,100', 'model', 'make', 'NILL', 'OK', 3, '2021-02-25', '2021-02-25', '2021-02-25 11:17:55', NULL, 1, '37', NULL, NULL, NULL, '2021-02-21 15:16:31', '2021-02-25 06:21:11'),
(5, 0, 1000, 1004, 'equipment5', 'serial5', '0.4', '0.1', '10,100', 'model5', 'make5', 'NILL', 'OK', 3, '2021-02-25', '2021-02-25', '2021-02-25 15:11:21', NULL, 1, '33', NULL, NULL, NULL, '2021-02-21 15:16:31', '2021-02-25 10:11:45'),
(6, 0, 1001, 1005, 'eq2380', '127894', '0.2', '0.1', '10,100', 'model', 'make', 'NILL', 'OK', 3, '2021-02-26', '2021-02-26', '2021-02-26 18:03:24', NULL, 1, '93,101,78', NULL, NULL, NULL, '2021-02-26 13:01:15', '2021-03-22 06:52:08'),
(7, 0, 1002, 1006, 'eq1', 'serail', '0.4,0.5,0.6', '0.9,0.9,0.9', '0.1,0.1-0.1,0.2-0.2,0.4', 'model', 'make', 'NILL', 'OK', 3, '2021-03-26', '2021-03-26', '2021-03-26 14:26:20', NULL, 1, '180', NULL, NULL, NULL, '2021-03-26 09:25:02', '2021-04-01 14:41:23'),
(8, 0, 1003, 1007, 'eq01', 'serail', '0.01', '0.02', '1,1000', 'model', 'make', 'NILL', 'OK', 3, '2021-04-02', '2021-04-02', '2021-04-02 17:58:10', NULL, 1, '140', NULL, NULL, NULL, '2021-04-02 12:56:29', '2021-04-02 13:34:46'),
(9, 0, 1004, 1008, 'equipment ID', 'serial', '0.3', '0.4', '10,100', 'model', 'make', 'NILL', 'OK', 3, '2021-04-09', '2021-04-09', '2021-04-09 14:53:09', NULL, 1, '140', NULL, NULL, NULL, '2021-04-09 09:49:51', '2021-04-09 10:21:56'),
(10, 0, 1005, 1009, 'equipment', 'serial', '0.01', '0.3', '10,100', 'model', 'make', 'NILL', 'OK', 3, '2021-04-09', '2021-04-09', '2021-04-09 16:59:49', NULL, 1, '125', NULL, NULL, NULL, '2021-04-09 11:57:32', '2021-04-09 12:06:01'),
(11, 0, 1006, 1010, 'eq_', 'seria_', '0.03', '0.1', '10,100', 'mode_', 'mak_', 'NILL', 'OK', 3, '2021-04-10', '2021-04-12', '2021-04-10 17:42:04', NULL, 1, '26', NULL, NULL, NULL, '2021-04-10 12:39:12', '2021-04-10 12:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `quote_id`, `status`, `created_at`, `updated_at`) VALUES
(1000, 1000, 0, '2021-02-21 15:16:31', '2021-02-21 15:16:31'),
(1001, 1000, 0, '2021-02-26 13:01:15', '2021-02-26 13:01:15'),
(1002, 1001, 0, '2021-03-26 09:25:02', '2021-03-26 09:25:02'),
(1003, 1002, 0, '2021-04-02 12:56:29', '2021-04-02 12:56:29'),
(1004, 1003, 0, '2021-04-09 09:49:51', '2021-04-09 09:49:51'),
(1005, 1004, 0, '2021-04-09 11:57:32', '2021-04-09 11:57:32'),
(1006, 1005, 0, '2021-04-10 12:39:12', '2021-04-10 12:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customize_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `acc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dr` int(11) DEFAULT NULL,
  `cr` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appraisal_id` int(11) NOT NULL,
  `nature_of_leave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_leave` int(11) NOT NULL,
  `type_time` int(11) DEFAULT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `head_recommendation_status` int(11) DEFAULT NULL,
  `head_recommendation_date` date DEFAULT NULL,
  `head_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceo_id` int(11) DEFAULT NULL,
  `ceo_recommendation_status` int(11) DEFAULT NULL,
  `ceo_recommendation_date` date DEFAULT NULL,
  `ceo_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `appraisal_id`, `nature_of_leave`, `type_of_leave`, `type_time`, `from`, `to`, `reason`, `address_contact`, `head_id`, `head_recommendation_status`, `head_recommendation_date`, `head_remarks`, `ceo_id`, `ceo_recommendation_status`, `ceo_recommendation_date`, `ceo_remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 'casual-leave', 0, NULL, '2021-01-14', '2021-01-14', 'Urgent piece of work', 'NML 030407495032', 1, 1, '2021-01-14', NULL, 1, NULL, NULL, NULL, '2021-01-14 10:52:56', '2021-01-14 11:08:08'),
(2, 1, 'casual-leave', 0, NULL, '2021-01-02', '2021-02-02', 'Reason', 'Address 03803242', 1, 1, '2021-02-02', NULL, 1, NULL, NULL, NULL, '2021-02-02 07:31:37', '2021-02-02 07:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `ligentries`
--

CREATE TABLE `ligentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noofdiv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `k_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ligentries`
--

INSERT INTO `ligentries` (`id`, `parent_id`, `x1`, `x2`, `uuc`, `noofdiv`, `k_value`, `asset_id`, `unit`, `data`, `created_at`, `updated_at`) VALUES
(1, 6, '100.1', '100.2', '100', '50', 'mercury', 33, 1, NULL, '2021-02-25 11:02:21', '2021-02-25 11:02:21'),
(2, 6, '140.2', '140.9', '140', '60', 'mercury', 33, 1, NULL, '2021-02-25 11:02:21', '2021-02-25 11:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `managereferences`
--

CREATE TABLE `managereferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter` int(11) NOT NULL,
  `asset` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `uuc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `error` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uncertainty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `managereferences`
--

INSERT INTO `managereferences` (`id`, `parameter`, `asset`, `unit`, `uuc`, `ref`, `error`, `uncertainty`, `channel`, `created_at`, `updated_at`) VALUES
(2, 27, 78, 1, '-19.77', '0.19', '-19.96', '0.22', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(3, 27, 78, 1, '-9.75', '0.19', '-9.94', '0.22', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(4, 27, 78, 1, '0.25', '0.27', '-0.02', '0.22', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(5, 27, 78, 1, '24.90', '0.01', '24.89', '0.22', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(6, 27, 78, 1, '49.75', '-0.09', '49.84', '0.22', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(7, 27, 78, 1, '99.50', '-0.33', '99.83', '0.22', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(8, 27, 78, 1, '149.75', '0.03', '149.72', '0.26', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(9, 27, 78, 1, '200.00', '0.05', '199.95', '0.92', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(10, 27, 78, 1, '249.95', '-0.15', '250.1', '0.92', NULL, '2020-12-23 08:09:13', '2020-12-23 08:09:13'),
(11, 27, 27, 1, '-19.54', '-19.837', '0.297', '0.08', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(12, 27, 27, 1, '-9.54', '-9.865', '0.325', '0.08', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(13, 27, 27, 1, '0.42', '0.044', '0.376', '0.08', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(14, 27, 27, 1, '20.39', '19.994', '0.396', '0.08', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(15, 27, 27, 1, '50.46', '49.992', '0.468', '0.08', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(16, 27, 27, 1, '100.40', '99.769', '0.631', '0.08', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(17, 27, 27, 1, '150.56', '149.810', '0.75', '0.23', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(18, 27, 27, 1, '199.97', '199.053', '0.917', '0.23', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(19, 27, 27, 1, '250.06', '249.057', '1.003', '0.23', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(20, 27, 27, 1, '300.22', '298.840', '1.3800000000001', '0.26', NULL, '2020-12-23 08:37:51', '2020-12-23 08:37:51'),
(21, 27, 33, 1, '-20.00', '-20.118', '0.118', '0.17', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(22, 27, 33, 1, '-10.00', '-10.052', '0.052', '0.17', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(23, 27, 33, 1, '0.00', '-0.027', '0.027', '0.17', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(24, 27, 33, 1, '10.00', '9.985', '0.015000000000001', '0.17', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(25, 27, 33, 1, '20.00', '19.995', '0.004999999999999', '0.17', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(26, 27, 33, 1, '40.00', '40.040', '-0.039999999999999', '0.17', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(27, 27, 33, 1, '60.00', '60.077', '-0.076999999999998', '0.31', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(28, 27, 33, 1, '80.00', '80.198', '-0.19799999999999', '0.31', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(29, 27, 33, 1, '100.00', '99.953', '0.046999999999997', '0.31', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(30, 27, 33, 1, '120.00', '119.708', '0.292', '0.31', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(31, 27, 33, 1, '140.00', '139.873', '0.12700000000001', '0.31', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(32, 27, 33, 1, '150.00', '149.844', '0.15600000000001', '0.31', NULL, '2020-12-23 08:56:55', '2020-12-23 08:56:55'),
(33, 27, 57, 1, '25.00', '25.109', '-0.109', '0.17', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(34, 27, 57, 1, '50.00', '50.073', '-0.073', '0.17', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(35, 27, 57, 1, '100.00', '100.015', '-0.015000000000001', '0.31', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(36, 27, 57, 1, '150.00', '149.996', '0.0039999999999907', '0.31', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(37, 27, 57, 1, '200.00', '199.996', '0.0039999999999907', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(38, 27, 57, 1, '250.00', '249.987', '0.013000000000005', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(39, 27, 57, 1, '300.00', '300.021', '-0.021000000000015', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(40, 27, 57, 1, '350.00', '350.007', '-0.007000000000005', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(41, 27, 57, 1, '400.00', '400.070', '-0.069999999999993', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(42, 27, 57, 1, '450.00', '450.115', '-0.11500000000001', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(43, 27, 57, 1, '500.00', '500.168', '-0.16800000000001', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(44, 27, 57, 1, '550.00', '550.120', '-0.12', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(45, 27, 57, 1, '600.00', '600.017', '-0.017000000000053', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(46, 27, 57, 1, '650.00', '649.733', '0.26700000000005', '0.28', NULL, '2020-12-23 09:04:05', '2020-12-23 09:04:05'),
(47, 27, 78, 1, '-19.77', '-20.12', '0.35', '0.33', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(48, 27, 78, 1, '-9.75', '-10.05', '0.3', '0.33', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(49, 27, 78, 1, '0.25', '-0.03', '0.28', '0.33', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(50, 27, 78, 1, '24.90', '25.01', '-0.11', '0.33', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(51, 27, 78, 1, '49.75', '50.06', '-0.31', '0.52', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(52, 27, 78, 1, '99.50', '99.95', '-0.45', '0.52', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(53, 27, 78, 1, '149.75', '149.84', '-0.090000000000003', '0.52', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(54, 27, 78, 1, '200.00', '199.99', '0.0099999999999909', '0.91', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(55, 27, 78, 1, '249.95', '249.98', '-0.030000000000001', '0.91', NULL, '2020-12-23 09:08:34', '2020-12-23 09:08:34'),
(56, 27, 26, 1, '-40.014', '-40.0012', '-0.012800000000006', '0.03', NULL, '2020-12-24 06:37:23', '2020-12-24 06:37:23'),
(57, 27, 26, 1, '0.006', '0.0024', '0.0036', '0.03', NULL, '2020-12-24 06:37:23', '2020-12-24 06:37:23'),
(58, 27, 26, 1, '99.988', '100.0011', '-0.013099999999994', '0.03', NULL, '2020-12-24 06:37:23', '2020-12-24 06:37:23'),
(59, 27, 26, 1, '640.120', '640.0018', '0.1182', '0.15', NULL, '2020-12-24 06:37:23', '2020-12-24 06:37:23'),
(60, 27, 28, 1, '1.12', '-0.02', '1.14', '0.2', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(61, 27, 28, 1, '10.59', '9.92', '0.67', '0.2', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(62, 27, 28, 1, '20.23', '19.90', '0.33', '0.2', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(63, 27, 28, 1, '49.53', '49.84', '-0.31', '0.2', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(64, 27, 28, 1, '99.37', '99.83', '-0.45999999999999', '0.2', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(65, 27, 28, 1, '150.25', '149.72', '0.53', '0.3', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(66, 27, 28, 1, '200.20', '198.69', '1.51', '0.8', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(67, 27, 28, 1, '250.10', '248.56', '1.54', '0.8', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(68, 27, 28, 1, '300.00', '298.42', '1.58', '0.8', NULL, '2020-12-24 06:46:48', '2020-12-24 06:46:48'),
(69, 27, 29, 1, '1.31', '-0.02', '1.33', '0.2', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(70, 27, 29, 1, '10.72', '9.92', '0.8', '0.2', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(71, 27, 29, 1, '20.23', '19.90', '0.33', '0.2', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(72, 27, 29, 1, '49.36', '49.84', '-0.48', '0.2', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(73, 27, 29, 1, '98.60', '99.83', '-1.23', '0.2', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(74, 27, 29, 1, '149.12', '149.72', '-0.59999999999999', '0.3', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(75, 27, 29, 1, '198.79', '198.69', '0.099999999999994', '0.8', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(76, 27, 29, 1, '248.46', '248.56', '-0.099999999999994', '0.8', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(77, 27, 29, 1, '298.29', '298.42', '-0.13', '0.8', NULL, '2020-12-24 07:22:03', '2020-12-24 07:22:03'),
(78, 17, 1, 6, '5', '5.00', '0', '0.005', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(79, 17, 1, 6, '10', '10.00', '0', '0.005', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(80, 17, 1, 6, '50', '49.96', '0.039999999999999', '0.09', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(81, 17, 1, 6, '150', '149.98', '0.02000000000001', '0.10', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(82, 17, 1, 6, '200', '199.99', '0.0099999999999909', '0.10', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(83, 17, 1, 6, '250', '250.05', '-0.050000000000011', '0.10', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(84, 17, 1, 6, '300', '300.06', '-0.060000000000002', '0.10', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(85, 17, 1, 6, '350', '350.07', '-0.069999999999993', '0.11', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(86, 17, 1, 6, '400', '400.09', '-0.089999999999975', '0.11', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(87, 17, 1, 6, '450', '450.09', '-0.089999999999975', '0.12', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(88, 17, 1, 6, '500', '500.19', '-0.19', '0.12', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(89, 17, 1, 6, '600', '600.17', '-0.16999999999996', '0.13', NULL, '2020-12-24 07:29:55', '2020-12-24 07:29:55'),
(90, 27, 31, 1, '-19.6', '-20.12', '0.52', '0.34', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(91, 27, 31, 1, '-9.7', '-10.05', '0.35', '0.34', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(92, 27, 31, 1, '0.2', '-0.03', '0.23', '0.34', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(93, 27, 31, 1, '24.8', '25.01', '-0.21', '0.34', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(94, 27, 31, 1, '50.1', '50.06', '0.039999999999999', '0.52', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(95, 27, 31, 1, '99.7', '99.95', '-0.25', '0.52', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(96, 27, 31, 1, '149.6', '149.84', '-0.24000000000001', '0.52', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(97, 27, 31, 1, '198.6', '199.99', '-1.39', '0.91', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(98, 27, 31, 1, '298.7', '300.02', '-1.32', '0.91', NULL, '2020-12-24 07:35:37', '2020-12-24 07:35:37'),
(99, 17, 2, 6, '0.00', '0.0000', '0', '0.010', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(100, 17, 2, 6, '125.87', '124.8360', '1.034', '0.020', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(101, 17, 2, 6, '249.72', '249.6728', '0.047200000000004', '0.030', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(102, 17, 2, 6, '374.55', '374.5059', '0.044100000000014', '0.040', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(103, 17, 2, 6, '499.39', '499.3407', '0.04929999999996', '0.050', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(104, 17, 2, 6, '624.21', '624.1659', '0.044100000000071', '0.050', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(105, 17, 2, 6, '749.04', '748.9883', '0.051699999999983', '0.050', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(106, 17, 2, 6, '873.89', '873.8093', '0.080699999999979', '0.060', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(107, 17, 2, 6, '1000.14', '1000.0288', '0.11119999999994', '0.090', NULL, '2020-12-24 07:37:33', '2020-12-24 07:37:33'),
(108, 27, 32, 1, '20.6', '20.00', '0.6', '0.34', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(109, 27, 32, 1, '49.7', '50.06', '-0.36', '0.52', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(110, 27, 32, 1, '100.0', '99.95', '0.049999999999997', '0.52', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(111, 27, 32, 1, '152.5', '149.84', '2.66', '0.52', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(112, 27, 32, 1, '201.5', '199.99', '1.51', '0.92', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(113, 27, 32, 1, '298.8', '300.02', '-1.22', '0.91', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(114, 27, 32, 1, '348.8', '350.00', '-1.2', '0.92', NULL, '2020-12-24 07:42:21', '2020-12-24 07:42:21'),
(121, 17, 3, 10, '-12.99', '-13.0000', '0.0099999999999998', '0.01', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(122, 17, 3, 10, '-9.94', '-10.0000', '0.06', '0.01', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(123, 17, 3, 10, '-4.91', '-5.0000', '0.09', '0.01', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(124, 17, 3, 10, '0.00', '0.0000', '0', '0.01', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(125, 17, 3, 10, '59.94', '59.9605', '-0.020500000000006', '0.01', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(126, 17, 3, 10, '120.03', '120.0764', '-0.046400000000006', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(127, 17, 3, 10, '170.98', '180.0472', '-9.0672', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(128, 17, 3, 10, '239.94', '180.0472', '59.8928', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(129, 17, 3, 10, '299.91', '299.9888', '-0.078800000000001', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(130, 17, 3, 10, '359.83', '359.9585', '-0.12850000000003', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(131, 17, 3, 10, '419.93', '420.0709', '-0.14089999999999', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(132, 17, 3, 10, '499.97', '500.1084', '-0.13839999999999', '0.20', NULL, '2020-12-24 08:12:17', '2020-12-24 08:12:17'),
(133, 27, 34, 1, '-10.0', '-10.047', '0.047000000000001', '0.17', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(134, 27, 34, 1, '0.0', '-0.008', '0.008', '0.17', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(135, 27, 34, 1, '20.0', '20.026', '-0.026', '0.17', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(136, 27, 34, 1, '40.0', '40.023', '-0.023000000000003', '0.17', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(137, 27, 34, 1, '60.0', '60.070', '-0.07', '0.31', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(138, 27, 34, 1, '80.0', '80.098', '-0.097999999999999', '0.31', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(139, 27, 34, 1, '100.0', '99.958', '0.042000000000002', '0.31', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(140, 27, 34, 1, '120.0', '119.962', '0.037999999999997', '0.31', NULL, '2020-12-24 08:33:35', '2020-12-24 08:33:35'),
(141, 17, 4, 10, '5.000', '5.000', '0', '0.001', NULL, '2020-12-24 08:34:55', '2020-12-24 08:34:55'),
(142, 17, 4, 10, '10.000', '9.999', '0.00099999999999945', '0.001', NULL, '2020-12-24 08:34:55', '2020-12-24 08:34:55'),
(143, 17, 4, 10, '15.000', '14.999', '0.00099999999999945', '0.001', NULL, '2020-12-24 08:34:55', '2020-12-24 08:34:55'),
(144, 17, 4, 10, '20.000', '19.999', '0.0010000000000012', '0.001', NULL, '2020-12-24 08:34:55', '2020-12-24 08:34:55'),
(145, 17, 4, 10, '25.000', '24.999', '0.0010000000000012', '0.002', NULL, '2020-12-24 08:34:55', '2020-12-24 08:34:55'),
(146, 17, 6, 17, '-110.0', '109.18', '-219.18', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(147, 17, 6, 17, '-90.0', '-90.32', '0.31999999999999', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(148, 17, 6, 17, '-45.0', '-44.57', '-0.43', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(149, 17, 6, 17, '0.0', '0.01', '-0.01', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(150, 17, 6, 17, '45.0', '44.78', '0.22', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(151, 17, 6, 17, '90.0', '89.52', '0.48', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(152, 17, 6, 17, '135.0', '134.35', '0.65000000000001', '0.1', NULL, '2020-12-24 08:39:40', '2020-12-24 08:39:40'),
(153, 17, 11, 6, '0.00', '0.0000', '0', '0.006', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(154, 17, 11, 6, '49.99', '50.0065', '-0.016500000000001', '0.014', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(155, 17, 11, 6, '100.05', '100.0714', '-0.0214', '0.014', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(156, 17, 11, 6, '200.05', '199.9487', '0.10130000000001', '0.046', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(157, 17, 11, 6, '300.05', '300.0202', '0.029800000000023', '0.046', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(158, 17, 11, 6, '400.05', '399.8913', '0.15870000000001', '0.046', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(159, 17, 11, 6, '499.88', '499.7591', '0.12090000000001', '0.046', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(160, 17, 11, 6, '599.97', '599.8236', '0.14639999999997', '0.071', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(161, 17, 11, 6, '700.05', '699.8865', '0.1635', '0.071', NULL, '2020-12-24 10:14:46', '2020-12-24 10:14:46'),
(162, 17, 13, 6, '0.2000', '0.1949', '0.0051', '0.0010', NULL, '2020-12-24 10:17:53', '2020-12-24 10:17:53'),
(163, 17, 13, 6, '0.4000', '0.4945', '-0.0945', '0.0010', NULL, '2020-12-24 10:17:53', '2020-12-24 10:17:53'),
(164, 17, 13, 6, '1.0000', '0.9944', '0.0056', '0.0010', NULL, '2020-12-24 10:17:53', '2020-12-24 10:17:53'),
(165, 17, 13, 6, '1.5000', '1.4947', '0.0053000000000001', '0.0010', NULL, '2020-12-24 10:17:53', '2020-12-24 10:17:53'),
(166, 17, 13, 6, '2.0000', '1.9959', '0.0041', '0.0010', NULL, '2020-12-24 10:17:53', '2020-12-24 10:17:53'),
(167, 17, 13, 6, '3.0000', '2.9987', '0.0013000000000001', '0.0010', NULL, '2020-12-24 10:17:53', '2020-12-24 10:17:53'),
(168, 17, 15, 6, '0.00', '0.000', '0', '0.001', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(169, 17, 15, 6, '1.00', '1.113', '-0.113', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(170, 17, 15, 6, '2.00', '2.111', '-0.111', '0.3', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(171, 17, 15, 6, '3.00', '3.117', '-0.117', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(172, 17, 15, 6, '4.00', '4.110', '-0.11', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(173, 17, 15, 6, '5.00', '5.098', '-0.098', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(174, 17, 15, 6, '6.00', '6.106', '-0.106', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(175, 17, 15, 6, '7.00', '7.074', '-0.074', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(176, 17, 15, 6, '8.00', '8.075', '-0.074999999999999', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(177, 17, 15, 6, '9.00', '9.060', '-0.06', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(178, 17, 15, 6, '10.00', '10.044', '-0.044', '0.03', NULL, '2020-12-24 10:21:24', '2020-12-24 10:21:24'),
(179, 17, 17, 6, '0', '0.000', '0', '1.2', NULL, '2020-12-24 10:23:18', '2020-12-24 10:23:18'),
(180, 17, 17, 6, '80', '80.090', '-0.090000000000003', '1.2', NULL, '2020-12-24 10:23:18', '2020-12-24 10:23:18'),
(181, 17, 17, 6, '160', '159.990', '0.0099999999999909', '1.2', NULL, '2020-12-24 10:23:18', '2020-12-24 10:23:18'),
(182, 17, 17, 6, '240', '240.970', '-0.97', '1.2', NULL, '2020-12-24 10:23:18', '2020-12-24 10:23:18'),
(183, 17, 17, 6, '322', '319.990', '2.01', '1.2', NULL, '2020-12-24 10:23:18', '2020-12-24 10:23:18'),
(184, 17, 17, 6, '400', '398.070', '1.93', '1.2', NULL, '2020-12-24 10:23:18', '2020-12-24 10:23:18'),
(185, 17, 18, 10, '0.0', '0.00', '0', '0.1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(186, 17, 18, 10, '50', '50.17', '-0.17', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(187, 17, 18, 10, '100', '100.48', '-0.48', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(188, 17, 18, 10, '200', '200.67', '-0.66999999999999', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(189, 17, 18, 10, '300', '300.60', '-0.60000000000002', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(190, 17, 18, 10, '400', '401.18', '-1.18', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(191, 17, 18, 10, '500', '502.52', '-2.52', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(192, 17, 18, 10, '600', '602.60', '-2.6', '1', NULL, '2020-12-24 10:26:19', '2020-12-24 10:26:19'),
(195, 17, 19, 6, '0.0', '0.000', '0', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(196, 17, 19, 6, '31.0', '31.980', '-0.98', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(197, 17, 19, 6, '62.0', '61.920', '0.079999999999998', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(198, 17, 19, 6, '93.0', '92.480', '0.52', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(199, 17, 19, 6, '124.0', '123.840', '0.16', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(200, 17, 19, 6, '155.0', '155.000', '0', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(201, 17, 19, 6, '186.0', '185.960', '0.039999999999992', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(202, 17, 19, 6, '217.0', '216.920', '0.080000000000013', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(203, 17, 19, 6, '250.0', '249.880', '0.12', '0.29', NULL, '2020-12-24 10:31:35', '2020-12-24 10:31:35'),
(204, 17, 20, 6, '0.000', '0.0000', '0', '0.001', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(205, 17, 20, 6, '8.987', '8.9896', '-0.0025999999999993', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(206, 17, 20, 6, '17.973', '17.9782', '-0.0052000000000021', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(207, 17, 20, 6, '26.961', '26.9668', '-0.0058000000000007', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(208, 17, 20, 6, '35.949', '35.9553', '-0.0063000000000031', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(209, 17, 20, 6, '44.936', '44.9440', '-0.0080000000000027', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(210, 17, 20, 6, '53.920', '53.9325', '-0.012499999999996', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(211, 17, 20, 6, '62.910', '62.9194', '-0.0094000000000065', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(212, 17, 20, 6, '69.899', '69.9088', '-0.0097999999999985', '0.014', NULL, '2020-12-24 10:36:19', '2020-12-24 10:36:19'),
(213, 17, 23, 12, '0', '0', '0', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(214, 17, 23, 12, '50', '50', '0', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(215, 17, 23, 12, '100', '100', '0', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(216, 17, 23, 12, '500', '500', '0', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(217, 17, 23, 12, '1000', '999', '1', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(218, 17, 23, 12, '2000', '1997', '3', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(219, 17, 23, 12, '2500', '2494', '6', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(220, 17, 23, 12, '3000', '2992', '8', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(221, 17, 23, 12, '4000', '3991', '9', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(222, 17, 23, 12, '5000', '4989', '11', '2', NULL, '2020-12-24 10:39:54', '2020-12-24 10:39:54'),
(224, 27, 35, 1, '11.2', '10.99', '0.21', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(225, 27, 35, 1, '15.0', '15.04', '-0.039999999999999', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(226, 27, 35, 1, '20.0', '19.99', '0.010000000000002', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(227, 27, 35, 1, '25.0', '25.04', '-0.039999999999999', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(228, 27, 35, 1, '40.0', '40.00', '0', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(229, 27, 35, 1, '60.0', '60.19', '-0.19', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(230, 27, 35, 1, '95.0', '95.16', '-0.16', '0.34', NULL, '2020-12-24 13:44:06', '2020-12-24 13:44:06'),
(231, 27, 36, 1, '51.7', '50.52', '1.18', '1.21', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(232, 27, 36, 1, '101.8', '100.94', '0.86', '2.13', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(233, 27, 36, 1, '151.0', '151.11', '-0.11000000000001', '2.13', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(234, 27, 36, 1, '199.1', '201.28', '-2.18', '2.13', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(235, 27, 36, 1, '248.8', '251.34', '-2.54', '2.13', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(236, 27, 36, 1, '298.6', '301.95', '-3.35', '2.13', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(237, 27, 36, 1, '398.9', '402.60', '-3.7', '2.14', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(238, 27, 36, 1, '496.0', '502.72', '-6.72', '2.13', NULL, '2020-12-24 13:48:01', '2020-12-24 13:48:01'),
(239, 27, 37, 1, '50.0', '50.52', '-0.52', '0.77', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(240, 27, 37, 1, '100.0', '100.94', '-0.94', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(241, 27, 37, 1, '150.0', '151.11', '-1.11', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(242, 27, 37, 1, '200.0', '201.28', '-1.28', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(243, 27, 37, 1, '250.0', '251.34', '-1.34', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(244, 27, 37, 1, '300.0', '301.95', '-1.95', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(245, 27, 37, 1, '350.0', '352.43', '-2.43', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(246, 27, 37, 1, '400.0', '402.60', '-2.6', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(247, 27, 37, 1, '450.0', '452.70', '-2.7', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(248, 27, 37, 1, '500.0', '502.72', '-2.72', '1.38', NULL, '2020-12-24 13:51:39', '2020-12-24 13:51:39'),
(249, 27, 40, 1, '-18.0', '-20.119', '2.119', '0.08', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(250, 27, 40, 1, '-8.5', '-10.052', '1.552', '0.10', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(251, 27, 40, 1, '1.0', '-0.027', '1.027', '0.08', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(252, 27, 40, 1, '10.8', '9.986', '0.814', '0.10', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(253, 27, 40, 1, '20.3', '19.995', '0.305', '0.8', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(254, 27, 40, 1, '39.7', '40.040', '-0.34', '0.8', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(255, 27, 40, 1, '59.2', '60.077', '-0.877', '0.8', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(256, 27, 40, 1, '78.9', '80.197', '-1.297', '0.10', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(257, 27, 40, 1, '98.6', '99.958', '-1.358', '0.10', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(258, 27, 40, 1, '118.5', '119.902', '-1.402', '0.27', NULL, '2020-12-24 13:58:08', '2020-12-24 13:58:08'),
(259, 27, 41, 1, '30.0', '30.10', '-0.1', '0.5', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(260, 27, 41, 1, '49.4', '50.07', '-0.67', '0.5', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(261, 27, 41, 1, '98.7', '100.02', '-1.32', '0.5', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(262, 27, 41, 1, '200.2', '199.99', '0.20999999999998', '0.4', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(263, 27, 41, 1, '299.3', '300.02', '-0.71999999999997', '0.4', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(264, 27, 41, 1, '398.6', '400.04', '-1.44', '0.5', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(265, 27, 41, 1, '498.6', '500.17', '-1.57', '0.5', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(266, 27, 41, 1, '599.5', '600.02', '-0.51999999999998', '0.4', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(267, 27, 41, 1, '649.3', '649.73', '-0.43000000000006', '0.4', NULL, '2020-12-24 14:01:16', '2020-12-24 14:01:16'),
(268, 27, 44, 1, '-18.61', '-20.12', '1.51', '0.26', NULL, '2020-12-24 14:34:48', '2020-12-24 14:34:48'),
(269, 27, 44, 1, '0.69', '-0.03', '0.72', '0.26', NULL, '2020-12-24 14:34:48', '2020-12-24 14:34:48'),
(270, 27, 44, 1, '49.48', '50.06', '-0.58000000000001', '0.47', NULL, '2020-12-24 14:34:48', '2020-12-24 14:34:48'),
(271, 27, 44, 1, '-18.61', '-20.12', '1.51', '0.26', NULL, '2020-12-24 14:35:20', '2020-12-24 14:35:20'),
(272, 27, 44, 1, '0.69', '-0.03', '0.72', '0.26', NULL, '2020-12-24 14:35:20', '2020-12-24 14:35:20'),
(273, 27, 44, 1, '49.48', '50.06', '-0.58000000000001', '0.47', NULL, '2020-12-24 14:35:20', '2020-12-24 14:35:20'),
(274, 27, 44, 1, '98.73', '99.95', '-1.22', '0.47', NULL, '2020-12-24 14:35:20', '2020-12-24 14:35:20'),
(275, 27, 44, 1, '123.38', '124.75', '-1.37', '0.47', NULL, '2020-12-24 14:35:20', '2020-12-24 14:35:20'),
(276, 27, 45, 1, '-18.58', '-20.12', '1.54', '0.26', NULL, '2020-12-24 14:36:55', '2020-12-24 14:36:55'),
(277, 27, 45, 1, '0.57', '-0.03', '0.6', '0.26', NULL, '2020-12-24 14:36:55', '2020-12-24 14:36:55'),
(278, 27, 45, 1, '49.59', '50.06', '-0.47', '0.47', NULL, '2020-12-24 14:36:55', '2020-12-24 14:36:55'),
(279, 27, 45, 1, '99.06', '99.95', '-0.89', '0.47', NULL, '2020-12-24 14:36:55', '2020-12-24 14:36:55'),
(280, 27, 45, 1, '123.97', '124.75', '-0.78', '0.47', NULL, '2020-12-24 14:36:55', '2020-12-24 14:36:55'),
(281, 27, 46, 1, '-18.58', '-20.12', '1.54', '0.26', NULL, '2020-12-24 14:38:21', '2020-12-24 14:38:21'),
(282, 27, 46, 1, '0.66', '-0.03', '0.69', '0.26', NULL, '2020-12-24 14:38:21', '2020-12-24 14:38:21'),
(283, 27, 46, 1, '49.57', '50.06', '-0.49', '0.47', NULL, '2020-12-24 14:38:21', '2020-12-24 14:38:21'),
(284, 27, 46, 1, '98.05', '99.95', '-1.9', '0.47', NULL, '2020-12-24 14:38:21', '2020-12-24 14:38:21'),
(285, 27, 46, 1, '123.98', '124.75', '-0.77', '0.47', NULL, '2020-12-24 14:38:21', '2020-12-24 14:38:21'),
(286, 27, 53, 1, '-19.1', '-19.96', '0.86', '0.1', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(287, 27, 53, 1, '-9.2', '-9.94', '0.74', '0.1', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(288, 27, 53, 1, '0.1', '-0.02', '0.12', '0.1', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(289, 27, 53, 1, '20.5', '19.90', '0.6', '0.1', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(290, 27, 53, 1, '50.7', '49.84', '0.86', '0.1', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(291, 27, 53, 1, '102.3', '99.83', '2.47', '0.1', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(292, 27, 53, 1, '152.4', '149.72', '2.68', '0.2', NULL, '2020-12-26 07:00:23', '2020-12-26 07:00:23'),
(293, 27, 54, 1, '-8.0', '-7.495', '-0.505', '0.17', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(294, 27, 54, 1, '0.0', '0.504', '-0.504', '0.17', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(295, 27, 54, 1, '10.0', '10.105', '-0.105', '0.17', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(296, 27, 54, 1, '25.0', '25.256', '-0.256', '0.17', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(297, 27, 54, 1, '40.0', '40.107', '-0.107', '0.17', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(298, 27, 54, 1, '55.0', '54.959', '0.040999999999997', '0.17', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(299, 27, 54, 1, '70.0', '69.860', '0.14', '0.31', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(300, 27, 54, 1, '100.0', '99.613', '0.387', '0.31', NULL, '2020-12-26 07:10:26', '2020-12-26 07:10:26'),
(301, 27, 56, 1, '35.0', '35.082', '-0.082000000000001', '0.2', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(302, 27, 56, 1, '60.0', '59.906', '0.094000000000001', '0.2', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(303, 27, 56, 1, '80.0', '79.764', '0.236', '0.2', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(304, 27, 56, 1, '100.0', '99.640', '0.36', '0.2', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(305, 27, 56, 1, '120.0', '119.506', '0.494', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(306, 27, 56, 1, '140.0', '139.395', '0.60499999999999', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(307, 27, 56, 1, '160.0', '159.474', '0.52600000000001', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(308, 27, 56, 1, '180.0', '179.333', '0.667', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(309, 27, 56, 1, '200.0', '199.315', '0.685', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(310, 27, 56, 1, '250.0', '249.202', '0.798', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(311, 27, 56, 1, '300.0', '299.011', '0.98899999999998', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(312, 27, 56, 1, '350.0', '348.687', '1.313', '0.3', NULL, '2020-12-26 07:18:34', '2020-12-26 07:18:34'),
(313, 27, 68, 1, '49.6', '50.07', '-0.47', '0.50', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(314, 27, 68, 1, '99.5', '100.02', '-0.52', '0.50', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(315, 27, 68, 1, '201.3', '199.99', '1.31', '0.50', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(316, 27, 68, 1, '301.3', '300.02', '1.28', '0.50', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(317, 27, 68, 1, '401.3', '400.04', '1.26', '0.50', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(318, 27, 68, 1, '502.4', '500.17', '2.23', '0.90', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(319, 27, 68, 1, '603.0', '600.08', '2.92', '0.90', NULL, '2020-12-26 07:25:19', '2020-12-26 07:25:19'),
(320, 27, 75, 1, '-9.0', '-9.578', '0.578', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(321, 27, 75, 1, '0.7', '0.220', '0.48', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(322, 27, 75, 1, '10.3', '10.020', '0.28', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(323, 27, 75, 1, '19.7', '19.994', '-0.294', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(324, 27, 75, 1, '40.1', '40.007', '0.093000000000004', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(325, 27, 75, 1, '59.9', '59.991', '-0.091000000000001', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(326, 27, 75, 1, '79.6', '79.815', '-0.215', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(327, 27, 75, 1, '99.6', '99.845', '-0.245', '0.10', NULL, '2020-12-26 08:46:35', '2020-12-26 08:46:35'),
(328, 27, 76, 1, '-11.06', '-10.05', '-1.01', '0.33', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(329, 27, 76, 1, '-1.48', '-0.03', '-1.45', '0.33', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(330, 27, 76, 1, '9.03', '9.99', '-0.96', '0.33', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(331, 27, 76, 1, '18.43', '20.00', '-1.57', '0.33', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(332, 27, 76, 1, '38.73', '40.04', '-1.31', '0.33', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(333, 27, 76, 1, '59.05', '60.08', '-1.03', '0.52', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(334, 27, 76, 1, '79.30', '80.20', '-0.90000000000001', '0.52', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(335, 27, 76, 1, '99.07', '99.95', '-0.88000000000001', '0.52', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(336, 27, 76, 1, '119.75', '119.71', '0.040000000000006', '0.52', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(337, 27, 76, 1, '149.24', '149.84', '-0.59999999999999', '0.52', NULL, '2020-12-26 08:51:32', '2020-12-26 08:51:32'),
(338, 27, 77, 1, '20.0', '19.59', '0.41', '0.3', NULL, '2020-12-26 08:52:58', '2020-12-26 08:52:58'),
(339, 27, 77, 1, '25.0', '24.59', '0.41', '0.3', NULL, '2020-12-26 08:52:58', '2020-12-26 08:52:58'),
(340, 27, 77, 1, '30.0', '29.60', '0.4', '0.3', NULL, '2020-12-26 08:52:58', '2020-12-26 08:52:58'),
(341, 26, 170, 47, '114.0', '114.0', '0', '0.06', NULL, '2020-12-26 08:59:11', '2020-12-26 08:59:11'),
(342, 26, 171, 47, '113.9', '114.0', '-0.099999999999994', '0.10', NULL, '2020-12-26 08:59:53', '2020-12-26 08:59:53'),
(343, 21, 172, 48, '0.00', '0.000', '0', '0.010', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(344, 21, 172, 48, '100.20', '100.001', '0.199', '0.010', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(345, 21, 172, 48, '1000.2', '1000.01', '0.19000000000005', '0.10', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(346, 21, 172, 48, '1999.8', '2000.02', '-0.22000000000003', '0.10', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(347, 21, 172, 48, '4999.8', '5000.04', '-0.23999999999978', '0.10', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(348, 21, 172, 48, '10002', '10000.1', '1.8999999999996', '1.0', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(349, 21, 172, 48, '25002', '25000.2', '1.7999999999993', '1.0', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(350, 21, 172, 48, '50000', '50000.4', '-0.40000000000146', '1.0', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(351, 21, 172, 48, '74998', '75000.6', '-2.6000000000058', '3.0', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(352, 21, 172, 48, '99960', '99960.8', '-0.80000000000291', '3.0', NULL, '2020-12-26 09:04:53', '2020-12-26 09:04:53'),
(353, 13, 93, 36, '0.00101', '0.001002', '8.0E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(354, 13, 93, 36, '0.00201', '0.002002', '8.0000000000002E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(355, 13, 93, 36, '0.00201', '0.002002', '8.0000000000002E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(356, 13, 93, 36, '0.00500', '0.005001', '-1.0000000000001E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(357, 13, 93, 36, '0.01000', '0.010003', '-2.9999999999995E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(358, 13, 93, 36, '0.02001', '0.020007', '2.9999999999995E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(359, 13, 93, 36, '0.02001', '0.020006', '4.0000000000005E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(360, 13, 93, 36, '0.05000', '0.050000', '0', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(361, 13, 93, 36, '0.10001', '0.100005', '5.000000000005E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(362, 13, 93, 36, '0.20000', '0.200002', '-2.000000000002E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(363, 13, 93, 36, '0.20001', '0.200004', '6.000000000006E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(364, 13, 93, 36, '0.50002', '0.500016', '4.000000000004E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(365, 13, 93, 36, '1.00000', '0.999999', '1.0000000000288E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(366, 13, 93, 36, '2.00003', '2.000009', '2.1000000000271E-5', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(367, 13, 93, 36, '2.00001', '2.000008', '2.0000000002796E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(368, 13, 93, 36, '5.00003', '5.000022', '7.9999999993419E-6', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(369, 13, 93, 36, '10.00003', '10.000016', '1.4000000000181E-5', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(370, 13, 93, 36, '19.99997', '20.000000', '-2.9999999998864E-5', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(371, 13, 93, 36, '19.99997', '20.000008', '-3.7999999999982E-5', '0.000060', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(372, 13, 93, 36, '50.00013', '50.000021', '0.00010900000000191', '0.000070', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(373, 13, 93, 36, '100.0002', '100.00006', '0.00014000000000181', '0.000030', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(374, 13, 93, 36, '200.0003', '200.00020', '0.00010000000000332', '0.000030', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(375, 13, 93, 36, '200.0003', '200.00024', '6.0000000019045E-5', '0.000030', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(376, 13, 93, 36, '500.01', '500.00055', '0.0094500000000153', '0.020', NULL, '2020-12-26 10:25:44', '2020-12-26 10:25:44'),
(377, 13, 94, 36, '1000.003', '1000', '0.0030000000000427', '0.007', NULL, '2020-12-26 10:27:33', '2020-12-26 10:27:33'),
(378, 13, 95, 36, '2000.002', '2000', '0.0019999999999527', '0.008', NULL, '2020-12-26 10:28:19', '2020-12-26 10:28:19'),
(379, 13, 96, 36, '2000.000', '2000', '0', '0.008', NULL, '2020-12-26 10:29:21', '2020-12-26 10:29:21'),
(380, 13, 97, 36, '4999.992', '5000', '-0.0079999999998108', '0.009', NULL, '2020-12-26 10:30:23', '2020-12-26 10:30:23'),
(381, 13, 98, 36, '10000.026', '10000', '0.02599999999984', '0.011', NULL, '2020-12-26 10:32:11', '2020-12-26 10:32:11'),
(382, 13, 99, 36, '20000.031', '20000', '0.03099999999904', '0.045', NULL, '2020-12-26 10:34:07', '2020-12-26 10:34:07'),
(383, 13, 100, 36, '20000.031', '20000', '0.03099999999904', '0.045', NULL, '2020-12-26 10:35:42', '2020-12-26 10:35:42'),
(384, 13, 101, 36, '0.0010', '0.00100', '0', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(385, 13, 101, 36, '0.0100', '0.0100', '0', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(386, 13, 101, 36, '0.0200', '0.02001', '-9.9999999999996E-6', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(387, 13, 101, 36, '0.0500', '0.05000', '0', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(388, 13, 101, 36, '0.1000', '0.10001', '-9.9999999999961E-6', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(389, 13, 101, 36, '0.2000', '0.20000', '0', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(390, 13, 101, 36, '0.5001', '0.50001', '9.0000000000034E-5', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(391, 13, 101, 36, '1.0000', '1.00001', '-1.0000000000066E-5', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(392, 13, 101, 36, '10.0001', '10.00001', '9.0000000000146E-5', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(393, 13, 101, 36, '20.0004', '20.00001', '0.00038999999999945', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(394, 13, 101, 36, '50.0005', '50.00002', '0.00048000000000314', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(395, 13, 101, 36, '100.0008', '100.00004', '0.00075999999999965', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(396, 13, 101, 36, '200.0011', '200.00018', '0.0009200000000078', '0.0003', NULL, '2020-12-26 12:11:20', '2020-12-26 12:11:20'),
(397, 13, 102, 36, '0.50', '0.5000', '0', '0.01', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(398, 13, 102, 36, '50.00', '50.0000', '0', '0.01', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(399, 13, 102, 36, '100.00', '100.0000', '0', '0.01', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(400, 13, 102, 36, '200.00', '200.0002', '-0.00020000000000664', '0.01', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(401, 13, 102, 36, '500.00', '500.0005', '-0.00049999999998818', '0.01', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(402, 13, 102, 36, '1000.01', '999.9995', '0.010499999999979', '0.01', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(403, 13, 102, 36, '1999.99', '2000.0039', '-0.013899999999921', '0.02', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(404, 13, 102, 36, '2999.96', '3000.0034', '-0.04340000000002', '0.02', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(405, 13, 102, 36, '3999.91', '4000.0071', '-0.097099999999955', '0.02', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(406, 13, 102, 36, '4499.88', '4500.0076', '-0.1275999999998', '0.02', NULL, '2020-12-26 12:25:43', '2020-12-26 12:25:43'),
(411, 13, 103, 36, '500.0', '500.000', '0', '0.1', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(412, 13, 103, 36, '1000.0', '1000.000', '0', '0.1', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(413, 13, 103, 36, '5000.0', '4999.985', '0.015000000000327', '0.3', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(414, 13, 103, 36, '9999.9', '10000.022', '-0.12200000000121', '0.3', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(415, 13, 103, 36, '19999.5', '20000.036', '-0.53600000000006', '0.3', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(416, 13, 103, 36, '29998.4', '30000.057', '-1.6569999999992', '0.3', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(417, 13, 103, 36, '34997.7', '35000.043', '-2.3430000000008', '0.3', NULL, '2020-12-26 12:36:32', '2020-12-26 12:36:32'),
(418, 13, 104, 36, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-26 12:37:29', '2020-12-26 12:37:29'),
(419, 13, 215, 36, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-26 12:38:22', '2020-12-26 12:38:22'),
(420, 13, 223, 36, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 12:39:02', '2020-12-26 12:39:02'),
(421, 13, 217, 36, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 12:39:53', '2020-12-26 12:39:53'),
(422, 13, 216, 36, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 12:41:18', '2020-12-26 12:41:18'),
(423, 13, 218, 36, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 12:41:58', '2020-12-26 12:41:58'),
(424, 13, 219, 36, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-26 12:42:46', '2020-12-26 12:42:46'),
(425, 13, 220, 36, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-26 12:43:25', '2020-12-26 12:43:25'),
(426, 13, 221, 36, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 12:45:27', '2020-12-26 12:45:27'),
(427, 13, 222, 36, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-26 12:46:00', '2020-12-26 12:46:00'),
(428, 13, 105, 36, '5.002', '5.0001', '0.0019', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(429, 13, 105, 36, '10.002', '10.0001', '0.0019000000000009', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(430, 13, 105, 36, '20.002', '20.0003', '0.0016999999999996', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(431, 13, 105, 36, '40.004', '40.0008', '0.0031999999999996', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(432, 13, 105, 36, '60.005', '60.0011', '0.0039000000000016', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(433, 13, 105, 36, '80.006', '80.0011', '0.0049000000000063', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(434, 13, 105, 36, '100.005', '100.0014', '0.0035999999999916', '0.002', NULL, '2020-12-26 12:48:42', '2020-12-26 12:48:42'),
(435, 28, 114, 40, '55.2', '55.10', '0.1', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(436, 28, 114, 40, '60.1', '59.99', '0.11', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(437, 28, 114, 40, '64.9', '64.88', '0.02000000000001', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(438, 28, 114, 40, '74.7', '74.67', '0.030000000000001', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(439, 28, 114, 40, '104.1', '104.02', '0.079999999999998', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(440, 28, 114, 40, '153.0', '152.96', '0.039999999999992', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(441, 28, 114, 40, '250.8', '250.84', '-0.039999999999992', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(442, 28, 114, 40, '348.7', '348.77', '-0.069999999999993', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(443, 28, 114, 40, '446.4', '446.69', '-0.29000000000002', '0.21', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(444, 28, 114, 40, '544.1', '544.61', '-0.50999999999999', '0.21', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(445, 28, 114, 40, '642.0', '642.55', '-0.54999999999995', '0.21', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(446, 28, 114, 40, '740.0', '740.47', '-0.47000000000003', '0.40', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(447, 28, 114, 40, '857.6', '857.93', '-0.32999999999993', '0.12', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(448, 28, 114, 40, '936.0', '936.21', '-0.21000000000004', '0.21', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(449, 28, 114, 40, '1034.7', '1034.02', '0.68000000000006', '0.31', NULL, '2020-12-26 13:01:00', '2020-12-26 13:01:00'),
(452, 28, 115, 49, '301', '301.20', '-0.19999999999999', '0.08', NULL, '2020-12-26 13:08:15', '2020-12-26 13:08:15'),
(453, 28, 116, 49, '999.7', '1000', '-0.29999999999995', '0.02', NULL, '2020-12-26 13:08:42', '2020-12-26 13:08:42'),
(454, 13, 106, 36, '0.00106', '0.001002', '5.8E-5', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(455, 13, 106, 36, '0.00200', '0.002002', '-1.9999999999998E-6', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(456, 13, 106, 36, '0.00216', '0.002002', '0.000158', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(457, 13, 106, 36, '0.00511', '0.005001', '0.000109', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(458, 13, 106, 36, '0.01003', '0.010003', '2.7000000000001E-5', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(459, 13, 106, 36, '0.02012', '0.020007', '0.000113', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(460, 13, 106, 36, '0.01998', '0.020006', '-2.5999999999998E-5', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(461, 13, 106, 36, '0.05008', '0.050000', '7.9999999999997E-5', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(462, 13, 106, 36, '0.10005', '0.100005', '4.5000000000003E-5', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(463, 13, 106, 36, '0.19905', '0.200002', '-0.00095200000000001', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(464, 13, 106, 36, '0.19982', '0.200004', '-0.00018399999999999', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(465, 13, 106, 36, '0.49990', '0.500016', '-0.000116', '0.000060', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(466, 13, 106, 36, '0.99993', '0.999999', '-6.8999999999986E-5', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(467, 13, 106, 36, '1.99977', '2.000009', '-0.00023899999999988', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00');
INSERT INTO `managereferences` (`id`, `parameter`, `asset`, `unit`, `uuc`, `ref`, `error`, `uncertainty`, `channel`, `created_at`, `updated_at`) VALUES
(468, 13, 106, 36, '2.00043', '2.000008', '0.00042200000000037', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(469, 13, 106, 36, '5.00020', '5.000022', '0.00017800000000001', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(470, 13, 106, 36, '10.00008', '10.000016', '6.4000000000064E-5', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(471, 13, 106, 36, '19.99917', '20.000008', '-0.00083800000000167', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(472, 13, 106, 36, '49.99842', '50.000021', '-0.0016009999999937', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(473, 13, 106, 36, '100.0010', '100.00006', '0.00093999999999994', '0.00010', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(474, 13, 106, 36, '199.9987', '200.00020', '-0.001499999999993', '0.00020', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(475, 13, 106, 36, '199.9993', '200.00024', '-0.00093999999998573', '0.00020', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(476, 13, 106, 36, '500.01', '500.00055', '0.0094500000000153', '0.020', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(477, 13, 106, 36, '1000.02', '1000.0030', '0.016999999999939', '0.020', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(478, 13, 106, 36, '2000.01', '2000.0020', '0.0080000000000382', 'o.020', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(479, 13, 106, 36, '2000.01', '2000.0000', '0.0099999999999909', '0.020', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(480, 13, 106, 36, '5000.0', '4999.9920', '0.0079999999998108', '0.1', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(481, 13, 106, 36, '19.99992', '20.000000', '-8.0000000000524E-5', '0.000070', NULL, '2020-12-26 13:43:00', '2020-12-26 13:43:00'),
(482, 13, 107, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 13:57:32', '2020-12-26 13:57:32'),
(483, 13, 224, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 13:58:01', '2020-12-26 13:58:01'),
(484, 13, 225, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 13:58:38', '2020-12-26 13:58:38'),
(485, 13, 226, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 13:59:01', '2020-12-26 13:59:01'),
(486, 13, 227, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 14:01:36', '2020-12-26 14:01:36'),
(487, 13, 228, 38, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-26 14:01:48', '2020-12-26 14:01:48'),
(488, 13, 229, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 14:02:00', '2020-12-26 14:02:00'),
(489, 13, 230, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-26 14:02:22', '2020-12-26 14:02:22'),
(490, 13, 231, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 14:02:35', '2020-12-26 14:02:35'),
(491, 13, 232, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-26 14:02:45', '2020-12-26 14:02:45'),
(492, 13, 233, 38, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-26 14:04:40', '2020-12-26 14:04:40'),
(493, 13, 234, 38, '20.0002', '20.0000', '0.00019999999999953', '0.0001', NULL, '2020-12-26 14:04:51', '2020-12-26 14:04:51'),
(494, 13, 235, 38, '20.0006', '20.0000', '0.0005999999999986', '0.0001', NULL, '2020-12-26 14:05:03', '2020-12-26 14:05:03'),
(495, 13, 236, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-26 14:05:16', '2020-12-26 14:05:16'),
(496, 13, 237, 38, '20.0006', '20.0000', '0.0005999999999986', '0.0001', NULL, '2020-12-26 14:05:30', '2020-12-26 14:05:30'),
(497, 13, 238, 38, '19.9999', '20.0000', '-9.9999999999767E-5', '0.0001', NULL, '2020-12-26 14:05:57', '2020-12-26 14:05:57'),
(501, 13, 254, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-26 14:12:43', '2020-12-26 14:12:43'),
(502, 13, 239, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 14:12:55', '2020-12-26 14:12:55'),
(503, 13, 240, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 14:13:12', '2020-12-26 14:13:12'),
(504, 13, 251, 38, '20.0006', '20.0000', '0.0005999999999986', '0.0001', NULL, '2020-12-26 14:15:08', '2020-12-26 14:15:08'),
(505, 13, 252, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 14:16:05', '2020-12-26 14:16:05'),
(506, 13, 253, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-26 14:17:19', '2020-12-26 14:17:19'),
(507, 27, 38, 1, '20.1', '19.8', '0.3', '0.47', NULL, '2020-12-28 15:52:03', '2020-12-28 15:52:03'),
(508, 27, 38, 1, '29.9', '29.5', '0.4', '0.59', NULL, '2020-12-28 15:52:03', '2020-12-28 15:52:03'),
(509, 27, 38, 1, '39.7', '39.6', '0.1', '0.59', NULL, '2020-12-28 15:52:03', '2020-12-28 15:52:03'),
(517, 3, 125, 50, '500.21', '500', '0.20999999999998', '0.16', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(518, 3, 125, 50, '1000.10', '1000', '0.10000000000002', '0.16', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(519, 3, 125, 50, '1999.88', '2000', '-0.11999999999989', '0.16', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(520, 3, 125, 50, '4999.77', '5000', '-0.22999999999956', '0.18', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(521, 3, 125, 50, '9999.93', '10000', '-0.069999999999709', '0.016', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(522, 3, 125, 50, '19999.92', '20000', '-0.080000000001746', '0.16', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(523, 3, 125, 50, '24999.82', '25000', '-0.18000000000029', '0.17', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(524, 3, 125, 50, '49999.85', '50000', '-0.15000000000146', '0.17', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(525, 3, 125, 50, '75000.12', '75000', '0.11999999999534', '0.16', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(526, 3, 125, 50, '100000.05', '100000', '0.05000000000291', '0.16', NULL, '2020-12-30 07:02:03', '2020-12-30 07:02:03'),
(527, 3, 126, 51, '10', '10.0000', '0', '0.0053', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(528, 3, 126, 51, '20', '20.0017', '-0.0016999999999996', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(529, 3, 126, 51, '30', '30.0017', '-0.0016999999999996', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(530, 3, 126, 51, '40', '40.0050', '-0.0050000000000026', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(531, 3, 126, 51, '50', '50.0033', '-0.003300000000003', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(532, 3, 126, 51, '60', '60.0033', '-0.003300000000003', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(533, 3, 126, 51, '70', '70.0017', '-0.0016999999999996', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(534, 3, 126, 51, '80', '80.0017', '-0.0016999999999996', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(535, 3, 126, 51, '90', '90.0033', '-0.0032999999999959', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(536, 3, 126, 51, '100', '100.000', '0', '0.0063', NULL, '2020-12-30 07:16:21', '2020-12-30 07:16:21'),
(537, 13, 241, 38, '20.0002', '20.0000', '0.00019999999999953', '0.0001', NULL, '2020-12-30 07:17:53', '2020-12-30 07:17:53'),
(538, 13, 242, 38, '20.000', '20.0000', '0', '0.0001', NULL, '2020-12-30 07:21:53', '2020-12-30 07:21:53'),
(539, 13, 243, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-30 07:22:53', '2020-12-30 07:22:53'),
(540, 3, 127, 52, '0.00', '0.000', '0', '0.009', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(541, 3, 127, 52, '25.00', '25.001', '-0.0010000000000012', '0.009', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(542, 3, 127, 52, '41.30', '41.301', '-0.0010000000000048', '0.009', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(543, 3, 127, 52, '131.41', '131.402', '0.0080000000000098', '0.011', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(544, 3, 127, 52, '243.51', '243.505', '0.0049999999999955', '0.011', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(545, 3, 127, 52, '281.21', '281.205', '0.0049999999999955', '0.011', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(546, 3, 127, 52, '296.21', '296.206', '0.0039999999999623', '0.011', NULL, '2020-12-30 07:24:17', '2020-12-30 07:24:17'),
(547, 13, 244, 38, '19.9999', '20.0000', '-9.9999999999767E-5', '0.0001', NULL, '2020-12-30 07:28:08', '2020-12-30 07:28:08'),
(548, 13, 245, 38, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-30 07:29:33', '2020-12-30 07:29:33'),
(549, 13, 246, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-30 07:30:53', '2020-12-30 07:30:53'),
(550, 13, 247, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-30 07:31:54', '2020-12-30 07:31:54'),
(551, 13, 272, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-30 07:32:56', '2020-12-30 07:32:56'),
(552, 13, 248, 38, '20.0006', '20.0000', '0.0005999999999986', '0.0001', NULL, '2020-12-30 07:33:42', '2020-12-30 07:33:42'),
(553, 13, 249, 38, '20.0002', '20.0000', '0.00019999999999953', '0.0001', NULL, '2020-12-30 07:34:31', '2020-12-30 07:34:31'),
(554, 13, 250, 38, '20.0006', '20.0000', '0.0005999999999986', '0.0001', NULL, '2020-12-30 07:35:08', '2020-12-30 07:35:08'),
(555, 13, 255, 38, '20.0000', '20.0000', '0', '0.0001', NULL, '2020-12-30 07:35:47', '2020-12-30 07:35:47'),
(556, 13, 256, 38, '20.0000', '20.0000', '0', '0.0001', NULL, '2020-12-30 07:36:59', '2020-12-30 07:36:59'),
(557, 13, 257, 38, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-30 07:38:39', '2020-12-30 07:38:39'),
(558, 13, 258, 36, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-30 07:39:38', '2020-12-30 07:39:38'),
(559, 13, 259, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-30 07:40:11', '2020-12-30 07:40:11'),
(560, 13, 260, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-30 07:41:14', '2020-12-30 07:41:14'),
(561, 13, 261, 38, '20.0003', '20.0000', '0.0002999999999993', '0.0001', NULL, '2020-12-30 07:44:35', '2020-12-30 07:44:35'),
(562, 13, 262, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-30 07:45:16', '2020-12-30 07:45:16'),
(563, 13, 263, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-30 07:46:12', '2020-12-30 07:46:12'),
(564, 13, 264, 38, '20.0001', '20.0000', '9.9999999999767E-5', '0.0001', NULL, '2020-12-30 07:46:44', '2020-12-30 07:46:44'),
(565, 13, 265, 38, '20.0007', '20.0000', '0.00069999999999837', '0.0001', NULL, '2020-12-30 07:47:44', '2020-12-30 07:47:44'),
(566, 13, 266, 38, '20.0007', '20.0000', '0.00069999999999837', '0.0001', NULL, '2020-12-30 07:48:18', '2020-12-30 07:48:18'),
(567, 13, 267, 38, '20.0005', '20.0000', '0.00049999999999883', '0.0001', NULL, '2020-12-30 07:48:53', '2020-12-30 07:48:53'),
(568, 13, 268, 38, '20.0000', '20.0000', '0', '0.0001', NULL, '2020-12-30 07:49:22', '2020-12-30 07:49:22'),
(569, 13, 269, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-30 07:50:44', '2020-12-30 07:50:44'),
(570, 3, 128, 52, '0', '0', '0', '0.006', NULL, '2020-12-30 07:51:08', '2020-12-30 07:51:08'),
(571, 3, 128, 52, '2.5', '2.5', '0', '0.006', NULL, '2020-12-30 07:51:08', '2020-12-30 07:51:08'),
(572, 3, 128, 52, '5', '5.0002', '-0.00020000000000042', '0.006', NULL, '2020-12-30 07:51:08', '2020-12-30 07:51:08'),
(573, 3, 128, 52, '7', '7', '0', '0.006', NULL, '2020-12-30 07:51:08', '2020-12-30 07:51:08'),
(574, 13, 270, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-30 07:51:11', '2020-12-30 07:51:11'),
(575, 13, 271, 38, '20.0000', '20.0000', '0', '0.0001', NULL, '2020-12-30 07:52:23', '2020-12-30 07:52:23'),
(576, 3, 128, 52, '2.5', '2.5', '0', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(577, 3, 128, 52, '5', '5.0002', '-0.00020000000000042', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(578, 3, 128, 52, '7', '7', '0', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(579, 3, 128, 52, '10', '10.0001', '-9.9999999999767E-5', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(580, 3, 128, 52, '12', '12.0003', '-0.0002999999999993', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(581, 3, 128, 52, '15', '15', '0', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(582, 3, 128, 52, '17', '17', '0', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(583, 3, 128, 52, '20', '20.0001', '-9.9999999999767E-5', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(584, 3, 128, 52, '22', '22.0001', '-9.9999999999767E-5', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(585, 3, 128, 52, '25', '25.0002', '-0.00019999999999953', '0.006', NULL, '2020-12-30 08:00:05', '2020-12-30 08:00:05'),
(586, 3, 129, 52, '0', '0', '0', '0.010', NULL, '2020-12-30 08:02:30', '2020-12-30 08:02:30'),
(587, 3, 129, 52, '0.1', '0.1', '0', '0.010', NULL, '2020-12-30 08:02:30', '2020-12-30 08:02:30'),
(588, 3, 129, 52, '0.2', '0.2', '0', '0.010', NULL, '2020-12-30 08:02:30', '2020-12-30 08:02:30'),
(589, 3, 129, 52, '0.5', '0.5', '0', '0.010', NULL, '2020-12-30 08:02:30', '2020-12-30 08:02:30'),
(590, 3, 129, 52, '0.7', '0.7', '0', '0.010', NULL, '2020-12-30 08:02:30', '2020-12-30 08:02:30'),
(591, 3, 129, 52, '1', '1', '0', '0.010', NULL, '2020-12-30 08:02:30', '2020-12-30 08:02:30'),
(592, 3, 130, 52, '0', '0', '0', '0.010', NULL, '2020-12-30 08:04:13', '2020-12-30 08:04:13'),
(593, 3, 130, 52, '1', '1', '0', '0.010', NULL, '2020-12-30 08:04:13', '2020-12-30 08:04:13'),
(594, 3, 130, 52, '5', '5', '0', '0.010', NULL, '2020-12-30 08:04:13', '2020-12-30 08:04:13'),
(595, 3, 130, 52, '10', '10', '0', '0.010', NULL, '2020-12-30 08:04:13', '2020-12-30 08:04:13'),
(596, 3, 130, 52, '20', '20.001', '-0.0010000000000012', '0.010', NULL, '2020-12-30 08:04:13', '2020-12-30 08:04:13'),
(597, 3, 130, 52, '30', '30.001', '-0.0010000000000012', '0.010', NULL, '2020-12-30 08:04:13', '2020-12-30 08:04:13'),
(598, 3, 131, 53, '0', '0', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(599, 3, 131, 53, '1', '1', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(600, 3, 131, 53, '2', '2', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(601, 3, 131, 53, '5', '5', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(602, 3, 131, 53, '10', '10', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(603, 3, 131, 53, '15', '15', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(604, 3, 131, 53, '20', '20', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(605, 3, 131, 53, '25', '25', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(606, 3, 131, 53, '30', '30', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(607, 3, 131, 53, '35', '35', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(608, 3, 131, 53, '40', '40', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(609, 3, 131, 53, '45', '45', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(610, 3, 131, 53, '50', '50', '0', '0.001', NULL, '2020-12-30 08:10:34', '2020-12-30 08:10:34'),
(611, 13, 109, 38, '20.0001', '20', '9.9999999999767E-5', '0.0001', NULL, '2020-12-30 08:12:13', '2020-12-30 08:12:13'),
(612, 13, 110, 37, '1', '1.0021', '-0.0021', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(613, 13, 110, 37, '2', '2.0021', '-0.0021', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(614, 13, 110, 37, '2', '2.0022', '-0.0022000000000002', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(615, 13, 110, 37, '5', '5.0013', '-0.0012999999999996', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(616, 13, 110, 37, '10', '10.0028', '-0.0028000000000006', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(617, 13, 110, 37, '20', '20.0072', '-0.007200000000001', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(618, 13, 110, 37, '20', '20.0058', '-0.0058000000000007', '0.003', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(619, 13, 110, 37, '50', '49.9995', '0.00050000000000239', '0.004', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(620, 13, 110, 37, '100', '100.0054', '-0.0053999999999945', '0.005', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(621, 13, 110, 37, '200', '200.0015', '-0.001499999999993', '0.006', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(622, 13, 110, 37, '200', '200.0040', '-0.0039999999999907', '0.006', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(623, 13, 110, 37, '500', '500.0158', '-0.015800000000013', '0.008', NULL, '2020-12-30 08:17:18', '2020-12-30 08:17:18'),
(624, 13, 110, 36, '1', '0.9999992', '8.00000000023E-7', '0.010', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(625, 13, 110, 36, '2', '2.0000094', '-9.4000000001593E-6', '0.012', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(626, 13, 110, 36, '2', '2.0000078', '-7.8000000001133E-6', '0.016', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(627, 13, 110, 36, '5', '5.0000222', '-2.2200000000083E-5', '0.016', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(628, 13, 110, 36, '10', '10.000016', '-1.600000000046E-5', '0.020', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(629, 13, 110, 36, '20', '20.000002', '-1.9999999985032E-6', '0.025', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(630, 13, 110, 36, '20', '20.000008', '-8.0000000011182E-6', '0.025', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(631, 13, 110, 36, '50', '50.000021', '-2.0999999996718E-5', '0.03', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(632, 13, 110, 36, '100', '100.000063', '-6.299999999726E-5', '0.05', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(633, 13, 110, 36, '200', '200.00020', '-0.00020000000000664', '0.10', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(634, 13, 110, 36, '200', '200.00024', '-0.00023999999999091', '0.10', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(635, 13, 110, 36, '500', '500.00055', '-0.00054999999997563', '0.25', NULL, '2020-12-30 08:21:02', '2020-12-30 08:21:02'),
(636, 13, 112, 38, '20.0004', '20.0000', '0.00039999999999907', '0.0001', NULL, '2020-12-30 08:22:59', '2020-12-30 08:22:59'),
(637, 13, 113, 38, '100', '100.002', '-0.0019999999999953', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(638, 13, 113, 38, '200', '200.003', '-0.0029999999999859', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(639, 13, 113, 38, '300', '300.003', '-0.0029999999999859', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(640, 13, 113, 38, '400', '400.005', '-0.0049999999999955', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(641, 13, 113, 38, '600.1', '600.009', '0.091000000000008', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(642, 13, 113, 38, '800.2', '800.012', '0.1880000000001', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(643, 13, 113, 38, '1000.4', '1000.015', '0.38499999999999', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(644, 13, 113, 38, '1200.1', '1200.017', '0.082999999999856', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(645, 13, 113, 38, '1600.2', '1600.022', '0.17800000000011', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(646, 13, 113, 38, '1900.2', '1900.025', '0.17499999999995', '0.12', NULL, '2020-12-30 08:25:16', '2020-12-30 08:25:16'),
(647, 3, 132, 51, '0', '0', '0', '0.06', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(648, 3, 132, 51, '50', '50', '0', '0.06', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(649, 3, 132, 51, '100', '100', '0', '0.06', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(650, 3, 132, 51, '200', '200', '0', '0.12', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(651, 3, 132, 51, '300', '300', '0', '0.12', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(652, 3, 132, 51, '400', '400', '0', '0.12', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(653, 3, 132, 51, '500', '500', '0', '0.12', NULL, '2020-12-30 08:29:22', '2020-12-30 08:29:22'),
(654, 3, 135, 51, '0', '0', '0', '0.12', NULL, '2020-12-30 08:30:46', '2020-12-30 08:30:46'),
(655, 3, 135, 51, '100', '100', '0', '0.12', NULL, '2020-12-30 08:30:46', '2020-12-30 08:30:46'),
(656, 3, 135, 51, '200', '200', '0', '0.12', NULL, '2020-12-30 08:30:46', '2020-12-30 08:30:46'),
(657, 3, 135, 51, '300', '300', '0', '0.12', NULL, '2020-12-30 08:30:46', '2020-12-30 08:30:46'),
(658, 3, 135, 51, '400', '400', '0', '0.12', NULL, '2020-12-30 08:30:46', '2020-12-30 08:30:46'),
(659, 3, 135, 51, '500', '500', '0', '0.12', NULL, '2020-12-30 08:30:46', '2020-12-30 08:30:46'),
(660, 3, 137, 52, '1.5', '1.50', '0', '0.02', NULL, '2020-12-30 08:31:17', '2020-12-30 08:31:17'),
(672, 5, 147, 21, '100.000', '100.0081', '-0.0080999999999989', '0.0042', NULL, '2020-12-30 12:51:44', '2020-12-30 12:51:44'),
(673, 5, 147, 21, '10.0000', '9.99963', '0.0003700000000002', '0.00031', NULL, '2020-12-30 12:51:44', '2020-12-30 12:51:44'),
(674, 5, 147, 21, '1', '0.999931', '6.8999999999986E-5', '0.000031', NULL, '2020-12-30 12:51:44', '2020-12-30 12:51:44'),
(675, 5, 147, 21, '900', '899.033', '0.96699999999998', '0.051', NULL, '2020-12-30 12:51:44', '2020-12-30 12:51:44'),
(676, 5, 147, 20, '100', '99.9665', '0.033500000000004', '0.0038', NULL, '2020-12-30 12:53:42', '2020-12-30 12:53:42'),
(677, 5, 147, 18, '100', '99.97492', '0.025080000000003', '0.00018', NULL, '2020-12-30 13:11:43', '2020-12-30 13:11:43'),
(678, 5, 147, 19, '1', '0.9999765', '2.3499999999954E-5', '0.0000023', NULL, '2020-12-30 13:12:56', '2020-12-30 13:12:56'),
(679, 5, 147, 19, '10.0000', '9.999848', '0.00015199999999993', '0.000010', NULL, '2020-12-30 13:15:27', '2020-12-30 13:15:27'),
(680, 5, 147, 19, '100.0000', '100.0025', '-0.0024999999999977', '0.0002', NULL, '2020-12-30 13:16:48', '2020-12-30 13:16:48'),
(681, 5, 147, 19, '900', '900.0217', '-0.02170000000001', '0.002', NULL, '2020-12-30 13:17:41', '2020-12-30 13:17:41'),
(682, 5, 147, 22, '100', '100.00871', '-0.0087099999999936', '0.00069', NULL, '2020-12-30 13:19:55', '2020-12-30 13:19:55'),
(683, 5, 147, 23, '1', '1.000036', '-3.5999999999925E-5', '0.000007', NULL, '2020-12-30 13:21:28', '2020-12-30 13:21:28'),
(684, 5, 147, 23, '10', '10.000962', '-0.00096199999999946', '0.000047', NULL, '2020-12-30 13:23:21', '2020-12-30 13:23:21'),
(685, 5, 147, 23, '100', '99.99788', '0.002120000000005', '0.00056', NULL, '2020-12-30 13:23:21', '2020-12-30 13:23:21'),
(686, 5, 147, 24, '1', '0.9999796', '2.0400000000032E-5', '0.0000168', NULL, '2020-12-30 13:25:20', '2020-12-30 13:25:20'),
(687, 5, 147, 24, '10', '9.999571', '0.00042900000000046', '0.000621', NULL, '2020-12-30 13:25:20', '2020-12-30 13:25:20'),
(688, 5, 147, 25, '1', '0.999922', '7.8000000000022E-5', '0.000060', NULL, '2020-12-30 13:28:42', '2020-12-30 13:28:42'),
(689, 5, 147, 25, '10', '10.00003', '-3.0000000000641E-5', '0.00054', NULL, '2020-12-30 13:28:42', '2020-12-30 13:28:42'),
(690, 5, 147, 25, '100', '99.9929', '0.0070999999999941', '0.0072', NULL, '2020-12-30 13:28:42', '2020-12-30 13:28:42'),
(691, 5, 147, 26, '1', '1.000357', '-0.00035699999999994', '0.000109', NULL, '2020-12-31 15:09:49', '2020-12-31 15:09:49'),
(692, 5, 147, 26, '10', '10.01803', '-0.01803', '0.00013', NULL, '2020-12-31 15:09:49', '2020-12-31 15:09:49'),
(693, 5, 147, 27, '10', '10.066995', '-0.066995', '0.000518', NULL, '2020-12-31 15:20:25', '2020-12-31 15:20:25'),
(694, 5, 147, 27, '100', '100.06729', '-0.06729', '0.00068', NULL, '2020-12-31 15:20:25', '2020-12-31 15:20:25'),
(695, 5, 147, 28, '1', '1.0000352', '-3.5199999999902E-5', '0.0000083', NULL, '2020-12-31 15:22:37', '2020-12-31 15:22:37'),
(696, 5, 147, 28, '10', '9.999949', '5.0999999999135E-5', '0.000553', NULL, '2020-12-31 15:22:37', '2020-12-31 15:22:37'),
(697, 5, 147, 28, '100', '99.99848', '0.0015199999999993', '0.00122', NULL, '2020-12-31 15:22:37', '2020-12-31 15:22:37'),
(698, 5, 147, 29, '1', '1.000211', '-0.00021099999999996', '0.0000174', NULL, '2020-12-31 15:23:40', '2020-12-31 15:23:40'),
(699, 5, 147, 29, '10', '10.001937', '-0.0019369999999999', '0.000161', NULL, '2020-12-31 15:24:44', '2020-12-31 15:24:44'),
(700, 5, 147, 29, '100', '100.02512', '-0.025120000000001', '0.00177', NULL, '2020-12-31 15:24:44', '2020-12-31 15:24:44'),
(701, 5, 147, 30, '1', '1.0317112', '-0.0317112', '0.0005052', NULL, '2020-12-31 15:25:26', '2020-12-31 15:25:26'),
(702, 5, 147, 32, '1', '1.000001', '-9.9999999991773E-7', '0.0000013', NULL, '2020-12-31 15:27:00', '2020-12-31 15:27:00'),
(703, 5, 147, 32, '10', '10.00001', '-9.9999999996214E-6', '0.000013', NULL, '2020-12-31 15:27:00', '2020-12-31 15:27:00'),
(704, 5, 147, 33, '1.0277', '1.02794', '-0.00024000000000002', '0.2071', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(705, 5, 147, 33, '9.992', '9.994', '-0.0019999999999989', '0.002', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(706, 5, 147, 33, '19.924', '19.938', '-0.013999999999999', '0.002', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(707, 5, 147, 33, '49.955', '49.984', '-0.029000000000003', '0.002', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(708, 5, 147, 33, '100.06', '100.12', '-0.060000000000002', '0.03', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(709, 5, 147, 33, '200', '200.12', '-0.12', '0.026', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(710, 5, 147, 33, '502.84', '503.08', '-0.24000000000001', '0.03', NULL, '2020-12-31 15:34:32', '2020-12-31 15:34:32'),
(711, 5, 147, 34, '1.0038', '1.0041', '-0.00029999999999997', '0.0008', NULL, '2020-12-31 15:35:10', '2020-12-31 15:35:10'),
(712, 5, 147, 35, '100', '99.9923', '0.0076999999999998', '0.0708', NULL, '2020-12-31 15:38:45', '2020-12-31 15:38:45'),
(713, 5, 147, 55, '0', '0', '0', '0.08', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(714, 5, 147, 55, '100', '100.1', '-0.099999999999994', '0.14', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(715, 5, 147, 55, '200', '200.3', '-0.30000000000001', '0.2', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(716, 5, 147, 55, '300', '300.0', '0', '0.11', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(717, 5, 147, 55, '400', '400.0', '0', '0.2', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(718, 5, 147, 55, '500', '499.7', '0.30000000000001', '0.2', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(719, 5, 147, 55, '600', '599.7', '0.29999999999995', '0.2', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(720, 5, 147, 55, '700', '700.5', '-0.5', '0.15', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(721, 5, 147, 55, '800', '800', '0', '0.11', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(722, 5, 147, 55, '900', '899.6', '0.39999999999998', '0.2', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(723, 5, 147, 55, '1000', '1000', '0', '1', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(724, 5, 147, 55, '1100', '1100', '0', '1', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(725, 5, 147, 55, '1200', '1201', '-1', '1.4', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(726, 5, 147, 55, '1300', '1301', '-1', '1.3', NULL, '2020-12-31 15:47:42', '2020-12-31 15:47:42'),
(727, 27, 38, 1, '20.1', '19.8', '0.3', '0.47', NULL, '2021-01-05 09:47:25', '2021-01-05 09:47:25'),
(728, 27, 38, 1, '29.9', '29.5', '0.4', '0.59', NULL, '2021-01-05 09:47:25', '2021-01-05 09:47:25'),
(729, 27, 38, 1, '39.7', '39.6', '0.1', '0.59', NULL, '2021-01-05 09:47:25', '2021-01-05 09:47:25'),
(730, 13, 111, 36, '500.01', '500.0005', '0.0095000000000027', '0.02', NULL, '2021-01-05 12:59:48', '2021-01-05 12:59:48'),
(731, 13, 273, 36, '1000.01', '999.9995', '0.010499999999979', '0.02', NULL, '2021-01-05 13:01:02', '2021-01-05 13:01:02'),
(732, 13, 274, 36, '2000.01', '2000.0039', '0.0061000000000604', '0.02', NULL, '2021-01-05 13:01:58', '2021-01-05 13:01:58'),
(733, 13, 275, 36, '2000.01', '2000.0032', '0.0067999999998847', '0.02', NULL, '2021-01-05 13:02:55', '2021-01-05 13:02:55'),
(734, 13, 276, 36, '5000.6', '5999.9852', '-999.3852', '0.1', NULL, '2021-01-05 13:03:52', '2021-01-05 13:03:52'),
(735, 13, 284, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:04:53', '2021-01-05 13:04:53'),
(736, 13, 277, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:06:56', '2021-01-05 13:06:56'),
(737, 13, 278, 36, '10000.4', '10000.0217', '0.37830000000031', '0.1', NULL, '2021-01-05 13:07:52', '2021-01-05 13:07:52'),
(738, 13, 279, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:08:22', '2021-01-05 13:08:22'),
(739, 13, 280, 36, '10000.6', '10000.0217', '0.57830000000104', '0.1', NULL, '2021-01-05 13:22:55', '2021-01-05 13:22:55'),
(740, 13, 281, 36, '10000.3', '10000.0217', '0.27829999999994', '0.1', NULL, '2021-01-05 13:23:24', '2021-01-05 13:23:24'),
(741, 13, 282, 36, '10000.6', '10000.0217', '0.57830000000104', '0.1', NULL, '2021-01-05 13:23:59', '2021-01-05 13:23:59'),
(742, 13, 283, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:24:38', '2021-01-05 13:24:38'),
(743, 13, 285, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:25:11', '2021-01-05 13:25:11'),
(744, 13, 286, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:25:54', '2021-01-05 13:25:54'),
(745, 13, 287, 36, '10000.1', '10000.0217', '0.078300000001036', '0.1', NULL, '2021-01-05 13:26:30', '2021-01-05 13:26:30'),
(746, 13, 288, 36, '10000.6', '10000.0217', '0.57830000000104', '0.1', NULL, '2021-01-05 13:27:01', '2021-01-05 13:27:01'),
(747, 13, 289, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:27:39', '2021-01-05 13:27:39'),
(748, 13, 290, 36, '10000.5', '10000.0217', '0.47830000000067', '0.1', NULL, '2021-01-05 13:28:08', '2021-01-05 13:28:08'),
(749, 13, 291, 36, '9999.9', '10000.0217', '-0.12169999999969', '0.1', NULL, '2021-01-05 13:29:08', '2021-01-05 13:29:08'),
(750, 13, 292, 36, '9999.8', '10000.0217', '-0.22170000000006', '0.1', NULL, '2021-01-05 13:29:37', '2021-01-05 13:29:37'),
(751, 13, 293, 36, '10000.1', '10000.0217', '0.078300000001036', '0.1', NULL, '2021-01-05 13:30:15', '2021-01-05 13:30:15'),
(752, 13, 294, 36, '10000.1', '10000.0217', '0.078300000001036', '0.1', NULL, '2021-01-05 13:30:46', '2021-01-05 13:30:46'),
(753, 13, 295, 36, '9999.7', '10000.0217', '-0.3216999999986', '0.1', NULL, '2021-01-05 13:31:22', '2021-01-05 13:31:22'),
(808, 19, 180, 57, '254', '1.6455', '252.3545', '0.0002', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(809, 19, 180, 57, '254', '2.2712', '251.7288', '0.0012', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(810, 19, 180, 57, '275', '19.8286', '255.1714', '0.0018', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(811, 19, 180, 57, '275', '0.7029', '274.2971', '0.0001', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(812, 19, 180, 57, '440', '54.201', '385.799', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(813, 19, 180, 57, '465', '57.413', '407.587', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(814, 19, 180, 57, '546', '55.980', '490.02', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(815, 19, 180, 57, '590', '51.172', '538.828', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(816, 19, 180, 57, '546.1', '55.980', '490.12', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(817, 19, 180, 57, '635', '50.820', '584.18', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(818, 19, 180, 57, '440', '0.2661', '439.7339', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(819, 19, 180, 57, '465', '0.2410', '464.759', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(820, 19, 180, 57, '546.1', '0.2522', '545.8478', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(821, 19, 180, 57, '590', '0.2941', '589.7059', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(822, 19, 180, 57, '635', '0.2941', '634.7059', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(823, 19, 180, 57, '440', '28.770', '411.23', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(824, 19, 180, 57, '465', '32.281', '432.719', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(825, 19, 180, 57, '546.1', '31.410', '514.69', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(826, 19, 180, 57, '590', '28.051', '561.949', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(827, 19, 180, 57, '635', '28.972', '606.028', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(828, 19, 180, 57, '440', '0.5410', '439.459', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(829, 19, 180, 57, '465', '0.4911', '464.5089', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(830, 19, 180, 57, '546.1', '0.5032', '545.5968', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(831, 19, 180, 57, '590', '0.5521', '589.4479', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(832, 19, 180, 57, '635', '0.5381', '634.4619', '0.0026', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(833, 19, 180, 57, '440', '8.091', '431.909', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(834, 19, 180, 57, '465', '9.890', '455.11', '0.004', 'H1', '2021-03-26 17:15:23', '2021-03-26 17:15:23'),
(835, 19, 180, 58, '546.1', '9.932', '536.168', '0.004', 'N4', '2021-03-26 17:15:54', '2021-03-26 17:15:54'),
(836, 19, 180, 58, '590', '8.570', '581.43', '0.004', 'N4', '2021-03-26 17:16:44', '2021-03-26 17:16:44'),
(837, 19, 180, 58, '635', '9.422', '625.578', '0.004', 'N4', '2021-03-26 17:17:30', '2021-03-26 17:17:30'),
(838, 19, 180, 57, '440', '1.0921', '438.9079', '0.0026', 'N4', '2021-03-26 17:18:27', '2021-03-26 17:18:27'),
(839, 19, 180, 57, '465', '1.0052', '463.9948', '0.0026', 'N4', '2021-03-26 17:18:55', '2021-03-26 17:18:55'),
(840, 19, 180, 57, '546.1', '1.0031', '545.0969', '0.0026', 'N4', '2021-03-26 17:19:26', '2021-03-26 17:19:26'),
(841, 19, 180, 57, '590', '1.0673', '588.9327', '0.0026', 'N4', '2021-03-26 17:22:03', '2021-03-26 17:22:03'),
(842, 19, 180, 57, '635', '1.0260', '633.974', '0.0026', 'N4', '2021-03-26 17:22:39', '2021-03-26 17:22:39'),
(843, 19, 180, 56, '279.3', '279.32', '-0.019999999999982', '0.05', 'H1', '2021-03-26 17:30:04', '2021-03-26 17:30:04'),
(844, 19, 180, 56, '360.8', '360.85', '-0.050000000000011', '0.05', 'H1', '2021-03-26 17:30:49', '2021-03-26 17:30:49'),
(845, 19, 180, 56, '453.5', '453.58', '-0.079999999999984', '0.05', 'H1', '2021-03-26 17:31:53', '2021-03-26 17:31:53'),
(846, 19, 180, 56, '536.4', '536.42', '-0.019999999999982', '0.05', 'H1', '2021-03-26 17:33:39', '2021-03-26 17:33:39'),
(847, 19, 180, 56, '637.6', '637.67', '-0.069999999999936', '0.05', 'H1', '2021-03-26 17:34:16', '2021-03-26 17:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `massreferences`
--

CREATE TABLE `massreferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `density` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expanded_uncertainty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradient_temp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `massreferences`
--

INSERT INTO `massreferences` (`id`, `parent_id`, `density`, `expanded_uncertainty`, `volume`, `gradient_temp`, `created_at`, `updated_at`) VALUES
(2, 372, '8000', '140', '0.00000625', '0.01,0.02,0.03,0.05,0.06,0.08,0.11,0.14', '2021-02-19 10:39:59', '2021-02-19 10:43:05'),
(4, 369, '8000', '0.02', '0.00000125', '0.01,0.01,0.02,0.03,0.03,0.030,0.05,0.06', '2021-02-19 10:56:42', '2021-02-19 10:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `materialreceivings`
--

CREATE TABLE `materialreceivings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_indent_item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_check` int(11) NOT NULL,
  `meet_specifications` int(11) NOT NULL,
  `unit` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `specifications` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materialreceivings`
--

INSERT INTO `materialreceivings` (`id`, `purchase_indent_item_id`, `received_from`, `purchase_type`, `physical_check`, `meet_specifications`, `unit`, `qty`, `specifications`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 'US Automation', 'local', 1, 0, 'ea', 2, '', 0, '2020-12-19 07:51:08', '2020-12-19 09:45:20'),
(2, '2', 'US Automation', 'local', 1, 1, 'box', 2, '2', 0, '2020-12-19 07:56:19', '2020-12-19 07:56:19'),
(3, '3', 'em azeem', 'local', 1, 1, 'ea', 10, '1', 0, '2021-02-08 15:51:27', '2021-02-08 15:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `position` int(11) NOT NULL DEFAULT 0,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_child` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `icon`, `status`, `url`, `position`, `parent_id`, `has_child`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Menus', 'menu-index', 'fas fa-bars', 1, 'menus', 0, '82', 1, NULL, '2020-09-28 21:37:44', '2020-12-04 20:01:29'),
(2, 'Create Menu', 'menu-create', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-09-28 21:38:31', '2020-12-04 23:11:45'),
(3, 'Update Menu', 'menu-edit', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-09-28 21:38:55', '2020-12-04 23:11:22'),
(4, 'Delete Menu', 'menu-delete', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-09-28 21:40:01', '2020-12-04 23:11:59'),
(5, 'Roles', 'roles-index', 'fa fa-check', 1, 'roles', 0, '82', 1, NULL, '2020-09-28 21:40:37', '2020-12-04 20:01:40'),
(6, 'Create Roles', 'roles-create', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-09-28 21:40:54', '2020-12-04 20:28:24'),
(7, 'Update Roles', 'roles-edit', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-09-28 21:41:11', '2020-12-05 00:37:49'),
(8, 'Delete Roles', 'roles-delete', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-09-28 21:41:38', '2020-12-05 00:37:22'),
(9, 'Customer Management', 'customer-index', 'fa fa-users', 1, 'customers', 2, NULL, 0, NULL, '2020-09-27 17:55:23', '2021-02-01 09:11:35'),
(10, 'Add Customer', 'customer-create', 'fa fa-', 1, '#', 0, '9', 0, NULL, '2020-09-27 17:56:34', '2020-12-04 23:19:34'),
(11, 'Update Customer', 'customer-edit', 'fa fa-', 1, '#', 0, '9', 0, NULL, '2020-09-27 17:57:10', '2020-10-27 01:31:16'),
(12, 'View Customer', 'customer-view', 'fa fa-', 1, '#', 0, '9', 0, NULL, '2020-09-27 17:57:59', '2020-10-27 01:30:41'),
(13, 'Delete Customer', 'customer-delete', 'fa fa-', 1, '#', 0, '9', 0, NULL, '2020-09-27 18:01:15', '2020-10-27 01:30:27'),
(14, 'Our Team', 'staff-index', 'fa fa-users', 1, 'users', 1, '92', 1, NULL, '2020-09-27 17:59:24', '2021-02-01 09:37:26'),
(15, 'Add Team', 'staff-create', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-09-27 18:14:12', '2020-12-04 23:35:36'),
(16, 'Update Team', 'staff-edit', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-09-27 18:14:33', '2020-12-04 23:36:40'),
(17, 'Delete Team', 'staff-view', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-09-27 18:18:42', '2020-12-04 23:37:10'),
(18, 'View Team', 'staff-view', 'fa fa-', 1, '#', 0, '14', 0, NULL, '2020-09-27 18:18:42', '2020-10-15 17:43:48'),
(19, 'Department', 'department-index', 'fa fa-list', 1, 'departments', 0, '92', 1, NULL, '2020-09-28 04:15:05', '2020-12-04 19:25:38'),
(20, 'Update Department', 'department-edit', 'fa fa-', 1, '#', 0, '10', 0, NULL, '2020-09-28 04:16:01', '2020-09-28 04:16:01'),
(21, 'Add Department', 'department-create', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-09-28 04:15:41', '2020-12-05 00:40:39'),
(22, 'Delete Department', 'department-delete', 'fa fa-', 1, '#', 0, '10', 0, NULL, '2020-09-28 04:15:41', '2020-09-28 04:15:41'),
(23, 'Designation', 'designation-index', 'fa fa-desktop', 1, 'designations', 0, '92', 1, NULL, '2020-09-28 04:24:28', '2020-12-04 20:02:26'),
(24, 'Add Designation', 'designation-create', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-09-28 04:25:00', '2020-12-05 00:39:48'),
(25, 'Update Designation', 'designation-edit', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-09-28 04:25:24', '2020-12-05 00:40:18'),
(26, 'Delete Designation', 'designation-delete', 'fa fa-', 1, '#', 0, '23', 0, NULL, '2020-09-28 04:25:24', '2020-10-15 17:43:17'),
(27, 'Parameter', 'parameter-index', 'fa fa-tasks', 1, 'parameters', 1, '93', 1, NULL, '2020-09-28 04:26:23', '2021-02-01 09:35:20'),
(28, 'Add Parameter', 'parameter-create', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 04:27:04', '2020-12-05 01:09:09'),
(29, 'Update Parameter', 'parameter-edit', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 09:44:49', '2020-12-05 01:09:23'),
(30, 'Delete Parameter', 'parameter-delete', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 09:44:49', '2020-12-05 01:10:42'),
(31, 'Asset', 'asset-index', 'fa fa-industry', 1, 'assets', 0, '93', 1, NULL, '2020-09-28 09:46:21', '2020-12-04 20:09:37'),
(32, 'Add Asset', 'asset-create', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 09:46:54', '2020-12-05 01:09:57'),
(33, 'Update Asset', 'asset-edit', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 09:47:21', '2020-12-05 01:11:23'),
(34, 'Delete Asset', 'asset-delete', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 09:47:21', '2020-12-05 01:11:43'),
(35, 'Capabilities', 'capabilities-index', 'fa fa-barcode', 1, 'capabilities', 2, '93', 1, NULL, '2020-09-28 09:48:24', '2021-02-01 09:35:23'),
(36, 'Add Capabilities', 'capabilities-create', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 09:48:58', '2020-12-05 01:13:14'),
(37, 'Update Capabilities', 'capabilities-edit', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 10:05:30', '2020-12-05 01:13:27'),
(38, 'View Capabilities', 'capabilities-view', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 10:06:14', '2020-12-05 01:13:39'),
(39, 'Delete Capabilities', 'capabilities-delete', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-09-28 10:06:14', '2020-12-05 01:13:54'),
(40, 'Generate Requests', 'generate-requests-index', 'fa fa-folder-open', 1, 'generate-requests', 0, '138', 1, NULL, '2020-10-15 17:51:05', '2021-01-24 13:37:19'),
(41, 'Add Quote', 'quote-create', 'fa fa-', 1, '#', 0, '138', 0, NULL, '2020-10-15 18:11:23', '2020-10-15 18:11:23'),
(42, 'Update Quote', 'quote-edit', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-15 18:22:46', '2020-10-15 18:22:46'),
(43, 'View Quote', 'quote-view', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-15 18:24:22', '2020-10-15 18:24:22'),
(44, 'Quote Send to Customer', 'quote-send-to-customer', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-15 23:57:35', '2020-10-15 23:57:35'),
(45, 'Quote Print Details', 'quote-print-details', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-17 00:18:52', '2020-10-17 00:18:52'),
(46, 'Quote Accept', 'quote-accept', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-18 18:38:10', '2020-10-18 18:38:10'),
(47, 'Quote Revised', 'quote-revised', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-18 18:38:36', '2020-10-18 18:38:36'),
(48, 'Quote Close', 'quote-close', 'fa fa-', 0, '#', 0, '138', 0, NULL, '2020-10-18 18:41:41', '2020-10-18 18:41:41'),
(49, 'Items', 'items-index', 'fa fa-tasks', 0, 'items', 0, NULL, 0, NULL, '2020-10-18 18:42:19', '2020-10-25 07:55:33'),
(50, 'Create Items', 'items-create', 'fa fa-', 0, '#', 0, '49', 0, NULL, '2020-10-18 18:44:04', '2020-10-18 18:44:04'),
(51, 'Update Items', 'items-update', 'fa fa-', 0, '#', 0, '49', 0, NULL, '2020-10-18 18:44:21', '2020-10-18 18:44:21'),
(52, 'Delete Items', 'items-delete', 'fa fa-', 0, '#', 0, '49', 0, NULL, '2020-10-18 18:45:50', '2020-10-18 18:45:50'),
(53, 'Create Not-Listed', 'items-add-non-listed', 'fa fa-', 0, '#', 0, '49', 0, NULL, '2020-10-18 18:46:49', '2020-10-18 18:46:49'),
(54, 'Update Non-Listed', 'items-update-non-listed', 'fa fa-', 0, '#', 0, '49', 0, NULL, '2020-10-18 18:47:49', '2020-10-18 18:47:49'),
(55, 'Request Review', 'pending-index', 'fa fa-spinner', 1, 'pendings', 0, '138', 1, NULL, '2020-10-18 18:58:24', '2021-01-10 13:07:28'),
(56, 'Store Pendings', 'pendings-store', 'fa fa-', 0, '#', 0, '55', 0, NULL, '2020-10-18 19:22:00', '2020-10-18 19:22:00'),
(57, 'No Facility', 'pendings-no-facility', 'fa fa-', 1, 'no-facility', 0, '138', 1, NULL, '2020-10-18 19:22:42', '2021-01-10 18:42:03'),
(58, 'All Jobs', 'jobs-index', 'fa fa-tasks', 1, 'jobs', 1, '95', 1, NULL, '2020-10-18 19:59:25', '2021-02-17 09:16:22'),
(59, 'View Jobs', 'jobs-view', 'fa fa-', 0, '#', 0, '58', 0, NULL, '2020-10-18 20:14:08', '2020-10-18 20:14:08'),
(60, 'Print Jobform', 'print-jobform', 'fa fa-', 0, '#', 0, '58', 0, NULL, '2020-10-18 20:14:52', '2020-10-18 20:14:52'),
(62, 'Add Check-in Lab Items', 'checkin-store', 'fa fa-', 0, '#', 0, '61', 0, NULL, '2020-10-18 20:37:46', '2020-10-18 20:38:01'),
(64, 'Scheduling Jobs', 'scheduling-index', 'fa fa-calendar-alt', 1, 'scheduling', 2, '95', 1, NULL, '2020-10-18 20:41:17', '2021-02-17 09:16:33'),
(65, 'View Scheduling', 'scheduling-view', 'fa fa-', 0, '#', 0, '64', 0, NULL, '2020-10-18 20:58:04', '2020-10-18 20:58:04'),
(66, 'Assign Lab Task (add)', 'create-lab-task-assign', 'fa fa-', 0, '#', 0, '64', 0, NULL, '2020-10-18 21:14:40', '2020-10-18 21:14:40'),
(67, 'Assign Lab Task (update)', 'create-lab-task-assign', 'fa fa-', 0, '#', 0, '64', 0, NULL, '2020-10-18 21:15:02', '2020-10-18 21:15:02'),
(68, 'My Tasks', 'mytask-index', 'fa fa-clock-o', 1, 'mytasks', 7, NULL, 0, NULL, '2020-10-18 21:23:07', '2021-02-01 08:46:00'),
(69, 'View My Tasks', 'mytask-view', 'fa fa-', 0, '#', 0, '68', 0, NULL, '2020-10-18 21:35:45', '2020-10-19 19:32:18'),
(70, 'Start My Task', 'start-mytask', 'fa fa-', 0, '#', 0, '68', 0, NULL, '2020-10-19 19:29:47', '2020-10-19 19:32:56'),
(71, 'End My Task', 'end-mytask', 'fa fa-', 0, '#', 0, '68', 0, NULL, '2020-10-19 19:30:05', '2020-10-19 19:33:06'),
(72, 'Get Certificate', 'get-certificate', 'fa fa-', 0, '#', 0, '68', 0, NULL, '2020-10-19 19:30:36', '2020-10-19 19:30:36'),
(73, 'All Certificates', 'certificates-index', 'fa fa-file', 1, 'certificates', 0, NULL, 0, '2021-01-10 13:16:22', '2020-10-21 06:50:55', '2021-01-10 13:16:22'),
(74, 'Print Certificate', 'certificates-print', 'fa fa-', 0, '#', 0, '73', 0, NULL, '2020-10-21 19:18:42', '2020-10-21 19:18:42'),
(75, 'Gatepass', 'gatepass-index', 'fa fa-ban', 1, 'gatepass', 0, NULL, 0, '2020-11-03 18:54:33', '2020-10-21 19:19:33', '2020-11-03 18:54:33'),
(76, 'Generate Jobs', 'manage-jobs-index', 'fa fa-bars', 1, 'jobs/manage', 0, '95', 1, NULL, '2020-10-22 06:31:51', '2020-12-05 00:38:24'),
(77, 'Edit Department', 'department-edit', 'fa fa-', 1, '#', 0, '92', 0, NULL, '2020-10-27 01:32:24', '2020-12-05 00:39:11'),
(78, 'Invoicing Ledger', 'invoicing-ledger-index', 'fa fa-dollar-sign', 1, 'invoicing-ledger', 0, '97', 1, NULL, '2020-10-28 00:14:55', '2020-12-04 22:31:50'),
(80, 'Add Jobs', 'jobs-create', 'fa fa-', 0, '#', 0, '76', 0, NULL, '2020-10-28 19:51:02', '2020-10-28 19:51:02'),
(81, 'Delete Jobs', 'jobs-delete', 'fa fa-', 0, '#', 0, '76', 0, NULL, '2020-10-28 19:51:26', '2020-10-28 19:51:26'),
(82, 'Settings', 'settings-index', 'fa fa-cogs', 1, 'settings', 10, NULL, 1, NULL, '2020-10-28 19:57:19', '2021-02-01 09:15:05'),
(83, 'Manage Expenses', 'expenses-index', 'fa fa-money-bill-alt', 1, 'expenses', 0, '97', 1, '2021-01-22 13:11:08', '2020-11-02 05:14:45', '2021-01-22 13:11:08'),
(84, 'Manage Ref. Data', 'manage-reference-index', 'fa fa-globe', 1, 'manage-reference', 3, '93', 1, NULL, '2020-11-03 18:50:47', '2021-02-01 09:35:30'),
(86, 'Procedure', 'procedure-index', 'fa fa-recycle', 1, 'procedures', 7, '93', 1, NULL, '2020-11-11 01:16:28', '2021-02-01 09:35:57'),
(87, 'Manage Units', 'units-index', 'fa fa-hourglass', 1, 'units', 4, '93', 1, NULL, '2020-11-12 16:17:38', '2021-02-01 09:35:33'),
(88, 'Manage Uncertainties', 'uncertainties-index', 'fa fa-question-circle', 1, 'uncertainties', 5, '93', 1, NULL, '2020-11-12 16:21:14', '2021-02-01 09:35:36'),
(89, 'Column', 'column-index', 'fa fa-columns', 1, 'columns', 0, '93', 1, '2021-01-19 00:05:43', '2020-11-13 18:30:40', '2021-01-19 00:05:43'),
(91, 'testin', 'testing-index', 'fa fa-', 0, '#', 0, '1', 0, '2020-12-04 19:21:17', '2020-12-04 18:21:16', '2020-12-04 19:21:17'),
(92, 'Staff', 'staff-details', 'fa fa-user', 1, '#', 4, NULL, 1, NULL, '2020-12-04 19:21:59', '2021-02-01 09:14:49'),
(93, 'Cal Management', 'calibration-management', 'fa fa-tasks', 1, '#', 3, NULL, 1, NULL, '2020-12-04 20:07:59', '2021-02-01 08:45:40'),
(94, 'Dashboard', 'dashboard-index', 'fa fa-tachometer', 1, '/', 1, NULL, 0, NULL, '2020-12-04 20:25:07', '2021-02-01 09:00:18'),
(95, 'Manage Jobs', 'manage-jobs', 'fa fa-tasks', 1, '#', 6, NULL, 1, NULL, '2020-12-04 20:31:11', '2021-02-01 08:45:56'),
(96, 'Expense Categories', 'expense-categories', 'fa fa-list-alt', 1, 'expenses_categories', 0, '97', 1, '2021-01-22 13:10:59', '2020-12-04 21:05:22', '2021-01-22 13:10:59'),
(97, 'Finance & Accounts', 'finance-accounts', 'fa  fa-dollar', 1, '#', 8, NULL, 1, NULL, '2020-12-04 21:08:28', '2021-02-01 09:15:14'),
(98, 'Create Expense Category', 'create-expense-category', 'fa fa-`', 1, '#', 0, '97', 0, '2021-01-22 13:11:23', '2020-12-05 00:48:37', '2021-01-22 13:11:23'),
(99, 'Update Expense Category', 'update-expense-category', 'fa fa-', 1, '#', 0, '97', 0, '2021-01-22 13:11:31', '2020-12-05 00:49:21', '2021-01-22 13:11:31'),
(100, 'Create Units', 'create-units', 'fa fa-', 1, '#', 0, '87', 0, NULL, '2020-12-05 01:02:52', '2020-12-05 01:02:52'),
(101, 'Update Units', 'update-units', 'fa fa-', 1, '#', 0, '87', 0, NULL, '2020-12-05 01:03:13', '2020-12-05 01:03:38'),
(102, 'Add Uncertainties', 'add-uncertainties', 'fa fa-', 1, '#', 0, '88', 0, NULL, '2020-12-05 01:05:43', '2020-12-05 01:05:43'),
(103, 'Update Uncetainties', 'update-uncertainties', 'fa fa-', 1, '#', 0, '88', 0, NULL, '2020-12-05 01:06:11', '2020-12-05 01:06:11'),
(104, 'Add Column', 'column-create', 'fa fa-', 1, '#', 0, '89', 0, '2021-01-19 00:05:33', '2020-12-05 01:16:02', '2021-01-19 00:05:33'),
(105, 'Update Column', 'update-column', 'fa fa-', 1, '#', 0, '89', 0, '2021-01-19 00:05:24', '2020-12-05 01:16:27', '2021-01-19 00:05:24'),
(106, 'Add Procedure', 'add-procedure', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-12-05 01:20:27', '2020-12-05 01:20:27'),
(107, 'Update Procedure', 'update-procedure', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-12-05 01:21:00', '2020-12-05 01:21:00'),
(108, 'Create Reference', 'create-reference', 'fa fa-', 1, '#', 0, '84', 0, NULL, '2020-12-05 01:41:00', '2020-12-05 01:41:00'),
(109, 'Update Reference Data', 'update-reference', 'fa fa-', 1, '#', 0, '84', 0, NULL, '2020-12-05 01:41:38', '2020-12-05 01:41:38'),
(110, 'Add Pending Review', 'add-pending', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:44:59', '2020-12-05 01:44:59'),
(111, 'Print Pending Tech. Review', 'print-pending-tech-review', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:45:37', '2020-12-05 01:45:37'),
(112, 'Create Job', 'create-job', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:46:42', '2020-12-05 01:46:42'),
(113, 'Delete Job', 'delete-job', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:46:59', '2020-12-05 01:48:03'),
(114, 'Add Receiving Eq', 'add-recieving', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:49:01', '2020-12-05 01:49:01'),
(115, 'Update Receiving Eq', 'update-receiving', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:49:32', '2020-12-05 01:49:32'),
(116, 'Create Scheduling Job', 'create-scheduling', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:50:07', '2020-12-05 01:50:07'),
(117, 'Edit Scheduling Job', 'edit-scheduling', 'fa fa-', 1, '#', 0, '95', 0, NULL, '2020-12-05 01:50:42', '2020-12-05 01:50:42'),
(118, 'Add Expenses', 'add-expenses', 'fa fa-', 1, '#', 0, '97', 0, '2021-01-22 13:11:39', '2020-12-05 01:52:17', '2021-01-22 13:11:39'),
(119, 'Update Expenses', 'update-expense', 'fa fa-', 1, '#', 0, '97', 0, '2021-01-22 13:11:46', '2020-12-05 01:52:41', '2021-01-22 13:11:46'),
(120, 'Add Job Invoice Receiving', 'add-job-invoice-receiving', 'fa fa-', 1, '#', 0, '97', 0, NULL, '2020-12-05 01:54:19', '2020-12-05 01:54:19'),
(121, 'Update Job Invoice Receiving', 'update-job-invoice-receiving', 'fa fa-', 1, '#', 0, '97', 0, NULL, '2020-12-05 01:54:57', '2020-12-05 01:54:57'),
(122, 'Asset Groups', 'asset-groups', 'fa fa-link', 1, 'asset/groups', 6, '93', 1, NULL, '2020-12-09 02:32:58', '2021-02-01 09:35:42'),
(123, 'Create Asset Group', 'create-asset-group', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-12-09 03:18:48', '2020-12-09 03:18:48'),
(124, 'Update Asset Group', 'update-asset-group', 'fa fa-', 1, '#', 0, '93', 0, NULL, '2020-12-09 03:19:14', '2020-12-09 03:19:14'),
(125, 'Update Asset Group', 'update-asset-group', 'fa fa-', 1, '#', 0, '93', 0, '2020-12-09 03:19:25', '2020-12-09 03:19:14', '2020-12-09 03:19:25'),
(126, 'Document Control', 'document-control', 'fa fa-file', 1, '#', 12, NULL, 1, NULL, '2020-12-13 23:00:51', '2021-02-01 09:21:17'),
(127, 'SOP', 'sop-index', 'fa fa-', 1, 'sop', 0, '126', 1, NULL, '2020-12-14 00:58:50', '2020-12-14 00:58:50'),
(128, 'Create SOP', 'create-sop', 'fa fa-', 1, '#', 0, '126', 0, NULL, '2020-12-14 01:01:44', '2020-12-14 01:02:27'),
(129, 'Update SOP', 'update-sop', 'fa fa-', 1, '#', 0, '126', 0, NULL, '2020-12-14 01:02:13', '2020-12-14 01:02:13'),
(130, 'Forms & Formats', 'forms-index', 'fa fa-file', 1, 'forms', 0, '126', 1, NULL, '2020-12-16 18:47:51', '2020-12-17 11:52:54'),
(131, 'Purchase Module', 'purchase', 'fa fa-paper-plane', 1, '#', 9, NULL, 1, NULL, '2020-12-18 12:55:39', '2021-02-01 09:00:16'),
(132, 'Purchase Indent', 'indent-index', 'fa fa-', 1, 'purchase_indent', 0, '131', 1, NULL, '2020-12-18 13:41:31', '2020-12-18 13:49:37'),
(133, 'Preferences', 'preferences-index', 'fa fa-preferences', 1, 'preferences', 0, '82', 1, NULL, '2020-12-19 08:59:06', '2020-12-19 08:59:06'),
(134, 'Add Preference', 'add-preference', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-12-19 09:02:07', '2020-12-19 09:02:07'),
(135, 'Update Preference', 'update-preference', 'fa fa-', 1, '#', 0, '82', 0, NULL, '2020-12-19 09:02:24', '2020-12-19 09:02:24'),
(136, 'Material Receivings', 'material-receiving-index', 'fa fa-', 1, 'material_receiving', 0, '131', 1, NULL, '2020-12-19 13:05:37', '2020-12-19 13:14:35'),
(137, 'Capabilities Group', 'capabilities-group-index', 'fa fa-', 1, 'capabilities/group', 0, '93', 1, '2021-01-19 00:06:32', '2021-01-10 11:02:08', '2021-01-19 00:06:32'),
(138, 'Request Management', 'rfq', 'fa fa-folder', 1, '#', 5, NULL, 1, NULL, '2021-01-10 13:03:35', '2021-02-01 08:45:52'),
(139, 'HR Management', 'hr-index', 'fa fa-users', 1, '#', 11, NULL, 1, NULL, '2021-01-11 13:55:04', '2021-02-01 09:21:14'),
(140, 'Requisition', 'requisition-index', 'fa fa-', 1, 'requisition', 0, '139', 1, NULL, '2021-01-12 10:03:35', '2021-01-12 10:03:35'),
(141, 'Interview Appraisal', 'interview-appraisal-index', 'fa fa-', 1, 'interview-appraisal', 0, '139', 1, NULL, '2021-01-12 12:06:34', '2021-01-12 12:06:34'),
(142, 'Employee Contract', 'emp-contract-index', 'fa fa-', 1, 'emp_contract', 0, '139', 1, NULL, '2021-01-12 17:17:58', '2021-01-12 17:17:58'),
(143, 'Employee Joining', 'emp-joining-index', 'fa fa-', 1, 'emp_joining', 0, '139', 1, NULL, '2021-01-13 08:45:00', '2021-01-13 08:45:00'),
(144, 'Employee Orientation', 'employee-orientation-index', 'fa fa-', 1, 'emp_orientation', 0, '139', 1, NULL, '2021-01-13 15:45:08', '2021-01-13 15:45:32'),
(145, 'Leave Application', 'leave-application-index', 'fa fa-', 1, 'leave-application', 0, '139', 1, NULL, '2021-01-14 13:34:32', '2021-01-14 13:34:32'),
(146, 'Acc Level One', 'acc-level-one-index', 'fa fa-', 1, 'acc_level_one', 0, '97', 1, NULL, '2021-01-16 14:46:30', '2021-01-22 13:04:01'),
(147, 'Acc Level Two', 'acc-level-two-index', 'fa fa-', 1, 'acc_level_two', 0, '97', 1, NULL, '2021-01-16 15:41:35', '2021-01-22 13:03:51'),
(148, 'Acc Level Three', 'acc-level-three-index', 'fa fa-', 1, 'acc_level_three', 0, '97', 1, NULL, '2021-01-16 16:17:30', '2021-01-22 13:03:38'),
(149, 'Chart of Account', 'acc-level-four-index', 'fa fa-', 1, 'acc_level_four', 0, '97', 1, NULL, '2021-01-16 16:50:11', '2021-01-17 00:51:51'),
(150, 'Vouchers', 'vouchers-index', 'fa fa-', 1, 'vouchers', 0, '97', 1, NULL, '2021-01-22 13:04:39', '2021-01-22 13:04:39'),
(153, 'Activity Log', 'activity-log-index', 'fa fa-', 1, 'activity-log', 0, '82', 1, NULL, '2021-01-22 19:34:51', '2021-01-22 19:34:51'),
(154, 'Generate Quotes', 'quote-index', 'fa fa-', 1, 'quotes', 0, '138', 1, NULL, '2021-01-24 13:37:56', '2021-01-24 13:43:15'),
(155, 'General Journal', 'journal-index', 'fa fa-', 1, 'journal', 0, '97', 1, NULL, '2021-01-28 13:44:53', '2021-01-28 13:44:53'),
(156, 'Inventory', 'inventory-index', 'fa fa-houzz', 1, '#', 11, NULL, 1, NULL, '2021-03-22 11:20:25', '2021-03-22 11:21:09'),
(157, 'Inventory Categories', 'inventory-categories-index', 'fa fa-', 1, 'inventory-categories', 0, '156', 1, NULL, '2021-03-22 11:23:21', '2021-03-22 11:28:58'),
(158, 'Inventories', 'inventories-index', 'fa fa-', 1, 'inventories', 0, '156', 1, NULL, '2021-03-22 12:07:28', '2021-03-22 12:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `micrometer_entries`
--

CREATE TABLE `micrometer_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2021_01_07_074202_create_activity_log_table', 1),
(5, '2021_01_10_074742_create_capabilitiesgroups_table', 1),
(7, '2021_01_11_034346_create_quoterevisionlogs_table', 2),
(10, '2020_11_02_113407_create_quotes_table', 3),
(13, '2021_01_12_061422_create_requisition_table', 4),
(15, '2021_01_12_065828_create_requisitions_table', 5),
(19, '2021_01_12_081201_create_interviewappraisals_table', 6),
(29, '2021_01_12_131559_create_empcontracts_table', 6),
(31, '2021_01_14_093643_create_leave_applications_table', 7),
(41, '2021_01_14_123128_create_attendances_table', 8),
(43, '2021_01_16_103716_create_acc_level_ones_table', 9),
(44, '2021_01_16_114723_create_acc_level_twos_table', 10),
(45, '2021_01_16_121823_create_acc_level_threes_table', 11),
(46, '2021_01_16_125230_create_acc_level_fours_table', 12),
(54, '2021_01_22_091310_create_vouchers_table', 13),
(55, '2021_01_22_095529_create_voucherdetails_table', 13),
(56, '2021_01_28_184710_create_journals_table', 13),
(61, '2021_02_19_121027_create_massreferences_table', 16),
(63, '2021_02_17_211826_create_balancedataentries_table', 18),
(67, '2021_02_17_215156_create_generaldataentries_table', 20),
(70, '2021_02_23_170007_create_incubatordataentries_table', 21),
(73, '2021_02_24_094955_create_incubatormappings_table', 22),
(74, '2021_02_25_155255_create_ligentries_table', 23),
(77, '2021_03_22_144430_create_volumeentries_table', 25),
(80, '2021_03_22_162516_create_inventorycateogries_table', 26),
(82, '2021_03_22_173116_create_inventories_quantity_table', 27),
(85, '2021_03_22_172119_create_inventories_table', 28),
(86, '2021_03_25_094006_create_zvalues_table', 29),
(87, '2021_03_26_162749_create_spectrophotometerentries_table', 30),
(91, '2021_04_02_192033_create_vernierentries_table', 32),
(93, '2021_04_09_152540_create_micrometer_entries_table', 34),
(94, '2021_02_17_215222_create_calculatorentries_table', 35),
(95, '2021_04_09_163322_create_dialgauge_entries_table', 36);

-- --------------------------------------------------------

--
-- Table structure for table `nofacilities`
--

CREATE TABLE `nofacilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `capability` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nofacilities`
--

INSERT INTO `nofacilities` (`id`, `capability`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 'non listed 02', 2, '2021-02-03 10:04:35', '2021-02-03 10:04:35'),
(2, 'non listed 04', 8, '2021-02-03 10:33:18', '2021-02-03 10:33:18'),
(3, 'non listed 03', 3, '2021-02-03 10:36:50', '2021-02-03 10:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0a101fc7-810d-405e-8dd8-84b2b35e7c2c', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 2, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1214\"}}', NULL, '2021-01-23 15:19:14', '2021-01-23 15:19:14'),
('15becb71-3547-4db2-a1bd-9392063522ce', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 1, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( Name of Customer ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1212\"}}', NULL, '2021-01-23 15:10:32', '2021-01-23 15:10:32'),
('2150c8e4-fac1-4903-94c7-93db0f0e85ac', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 2, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1216\"}}', NULL, '2021-01-23 16:43:44', '2021-01-23 16:43:44'),
('6fbf910d-0271-4e9c-81bd-b7abbfee452e', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 1, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( Name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1213\"}}', '2021-02-01 11:42:59', '2021-01-23 15:11:11', '2021-02-01 11:42:59'),
('70cdd554-11f7-49e7-90b9-40d7b5b76359', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 2, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1215\"}}', NULL, '2021-01-23 16:24:56', '2021-01-23 16:24:56'),
('83e87e2c-e648-4459-aede-2b2c217c86ba', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 2, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( Name of Customer ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1212\"}}', NULL, '2021-01-23 15:10:32', '2021-01-23 15:10:32'),
('b4209fc3-2aad-4972-84f4-0cb904eb6eb7', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 1, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1216\"}}', '2021-01-25 10:12:27', '2021-01-23 16:43:44', '2021-01-25 10:12:27'),
('b552a149-ad63-4e11-b6a0-543457301997', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 1, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1215\"}}', '2021-04-12 08:54:57', '2021-01-23 16:24:56', '2021-04-12 08:54:57'),
('bc22549c-bd5c-454e-b120-ccc6b47b7373', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 1, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1214\"}}', NULL, '2021-01-23 15:19:14', '2021-01-23 15:19:14'),
('ff2fe45a-6a71-4bc2-b901-266de56b8b8e', 'App\\Notifications\\CustomerNotification', 'App\\Models\\User', 2, '{\"data\":{\"title\":\"New customer added\",\"by\":1,\"body\":\"A new customer ( Name ) has been added.\",\"redirectURL\":\"\\/customers\\/view\\/1213\"}}', NULL, '2021-01-23 15:11:11', '2021-01-23 15:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'Conductivity / TDS', NULL, NULL, '2020-10-19 09:09:43'),
(2, 'Count Turn / Event', NULL, NULL, '2020-10-19 09:10:43'),
(3, 'Dimension', NULL, NULL, NULL),
(4, 'Diss Oxygen', NULL, NULL, NULL),
(5, 'Electrical', NULL, NULL, NULL),
(6, 'Force', NULL, NULL, NULL),
(7, 'Flow Fluids', NULL, NULL, NULL),
(8, 'Gas Detection', NULL, NULL, NULL),
(9, 'Hardness Metal / Rubber / Concrete', NULL, NULL, '2020-10-19 09:11:24'),
(10, 'Illuminance', NULL, NULL, NULL),
(11, 'Kin Viscosity', NULL, NULL, NULL),
(12, 'Level Liquid', NULL, NULL, NULL),
(13, 'Mass Weighing', NULL, NULL, NULL),
(14, 'Multi Parameter', NULL, NULL, NULL),
(15, 'Magnetic Flux Density', NULL, NULL, NULL),
(16, 'NDT & Inspection', NULL, NULL, NULL),
(17, 'Pressure', NULL, NULL, NULL),
(18, 'pH Scale', NULL, NULL, NULL),
(19, 'Photometry', NULL, NULL, NULL),
(20, 'Polarization Angle', NULL, NULL, NULL),
(21, 'RPM', NULL, NULL, NULL),
(22, 'Refrective Index', NULL, NULL, NULL),
(23, 'Humidity', NULL, NULL, '2020-10-11 03:46:18'),
(24, 'Spgt Density', NULL, NULL, NULL),
(25, 'Speed', NULL, NULL, NULL),
(26, 'Sound Level', NULL, NULL, NULL),
(27, 'Temperature', NULL, NULL, '2020-10-24 04:55:52'),
(28, 'Torque', NULL, NULL, NULL),
(29, 'Time', NULL, NULL, NULL),
(30, 'Tubidity', NULL, NULL, NULL),
(31, 'Volume', NULL, NULL, NULL),
(32, 'Vibration', NULL, NULL, NULL),
(33, 'Inspection', NULL, '2020-10-19 08:13:02', '2020-10-19 08:13:02'),
(34, 'Volume', NULL, '2020-10-22 23:03:12', '2020-10-22 23:03:12'),
(35, 'Bio Medical', NULL, '2020-10-23 00:30:06', '2020-10-23 00:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('aims@lims.com', '$2y$10$KjFYEyAcEhdgaPbU.RXzc.twVJ5tMqIbpcqzGetgHFy87Dkci4SF6', '2020-12-24 12:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `category`, `name`, `slug`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Sales Taxes', NULL, NULL, NULL, '2020-12-19 00:19:31', '2020-12-19 00:19:31'),
(2, '1', 'PRA', 'pra', '16', '2020-12-19 00:48:37', '2020-12-19 00:48:37'),
(3, 'Income Tax', NULL, NULL, NULL, '2020-12-19 00:58:38', '2020-12-19 01:04:09'),
(4, '1', 'SRB', 'srb', '13', '2020-12-19 01:04:32', '2020-12-19 01:04:32'),
(5, '3', 'Income Tax', 'income-tax', '3', '2020-12-21 02:46:26', '2020-12-21 02:46:26'),
(9, 'AIMS LABS', NULL, 'aims-labs', NULL, '2020-12-26 06:41:55', '2021-02-17 10:51:33'),
(10, '9', 'Lab 01', 'lab-01', '18,28,30,70', '2020-12-26 06:43:53', '2020-12-26 06:51:48'),
(11, '9', 'Lab 02', 'lab-02', '18,28,30,70', '2020-12-26 06:54:43', '2021-02-18 04:33:42'),
(12, '9', 'Lab 03', 'lab-03', '20,24,30,70', '2020-12-26 06:55:04', '2020-12-26 06:55:04'),
(13, '9', 'Lab 04', 'lab-04', '20,24,30,70', '2020-12-26 06:55:26', '2020-12-26 06:55:26'),
(14, 'Nature of Leaves', NULL, NULL, NULL, '2021-01-14 05:31:12', '2021-01-14 05:31:12'),
(15, '14', 'Casual Leave', 'casual-leave', '12', '2021-01-14 05:31:38', '2021-01-14 05:31:38'),
(16, '14', 'Annual Leave', 'annual-leave', '18', '2021-01-14 05:31:59', '2021-01-14 05:31:59'),
(17, '14', 'Medical Leave', 'medical-leave', '10', '2021-01-14 05:32:23', '2021-01-14 05:32:23'),
(18, 'Calculators', NULL, 'calculators', NULL, '2021-02-17 09:49:05', '2021-02-17 09:53:54'),
(19, '18', 'General Calculator', 'general-calculator', '0', '2021-02-17 09:49:35', '2021-02-17 09:49:35'),
(20, '18', 'Balance Calculator', 'balance-calculator', '0', '2021-02-17 09:50:12', '2021-02-17 09:50:12'),
(21, '21', 'Has Channels', 'has-channels', '73,30', '2021-02-19 06:45:48', '2021-02-23 12:45:46'),
(22, '18', 'Incubator Calculator', 'incubator-calculator', '0', '2021-02-21 14:11:47', '2021-02-21 14:11:47'),
(23, '18', 'Volume Calculator', 'volume-calculator', 'volume-caculator', '2021-02-26 13:22:37', '2021-02-26 13:22:37'),
(24, '18', 'Spectrophotometer Calculator', 'spectrophotometer-calculator', 'spectrophotometer-calculator', '2021-03-26 11:14:03', '2021-03-26 11:14:03'),
(25, '18', 'Vernier Caliper Calculator', 'vernier-caliper-calculator', '0', '2021-04-02 13:02:57', '2021-04-02 13:02:57'),
(26, '18', 'Micrometer Calculator', 'micrometer-calculator', '0', '2021-04-09 09:55:41', '2021-04-09 09:55:41'),
(27, '18', 'Dial Gauge Calculator', 'dial-gauge-calculator', '0', '2021-04-09 11:51:34', '2021-04-09 11:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `preventivechecklists`
--

CREATE TABLE `preventivechecklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `tasktodo` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preventivemaintenancerecords`
--

CREATE TABLE `preventivemaintenancerecords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` int(11) NOT NULL,
  `checked` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unchecked` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breakdown_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corrective_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performed_by` int(11) NOT NULL,
  `lab_in_charge` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uncertainties` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`id`, `name`, `uncertainties`, `description`, `created_at`, `updated_at`) VALUES
(1, 'DKD-R-5-1', 'standard-deviation,uncertainty-type-a,uncertainty-due-to-accuracy-of-uuc,uncertainty-due-to-resolution-of-uuc,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-hysteresis-uuc,combined-uncertainty-of-standard', 'Euramet cg-11', '2020-12-07 08:44:12', '2020-12-08 07:14:48'),
(2, 'ASTM E74-13a', 'standard-deviation,uncertainty-type-a,uncertainty-due-to-resolution-of-uuc,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-hysteresis-uuc,combined-uncertainty-of-standard,uncertainty-due-to-drift-in-temperature', 'Calibration Procedure For Force Measuring Instruments', '2020-12-07 09:43:42', '2020-12-07 09:44:56'),
(3, 'IMEKO 22 TC3 :2014', 'standard-deviation,uncertainty-type-a,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-hysteresis-uuc,combined-uncertainty-of-standard,uncertainty-due-to-drift-in-temperature,uncertainty-due-to-resolution-of-std', 'Calibration of Torque Wrenches', '2020-12-07 14:03:07', '2020-12-07 14:03:49'),
(4, 'Euramet cg-13', 'standard-deviation,uncertainty-type-a,uncertainty-due-to-accuracy-of-uuc,uncertainty-due-to-resolution-of-uuc,drift-of-the-standard,combined-uncertainty-of-standard,uncertainty-due-to-temperature-stability-of-chamber', 'International Standard Procedure for Calibration of Temperature Block Calibrators', '2020-12-08 07:54:14', '2020-12-08 07:57:48'),
(5, 'DMS 2010: 2010', 'standard-deviation,uncertainty-type-a,uncertainty-due-to-accuracy-of-uuc,uncertainty-due-to-resolution-of-uuc,drift-of-the-standard,combined-uncertainty-of-standard,uncertainty-due-to-temperature-stability-of-chamber', 'SOP for Calibration of Furnaces', '2020-12-08 08:45:11', '2020-12-08 08:46:11'),
(6, 'BS EN 13190', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-hysteresis-uuc,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc', 'SOP for Calibration of Dial Thermometers / Temperature Gauges', '2020-12-08 08:53:38', '2020-12-08 08:53:38'),
(7, 'SOP-MS-C T08', 'standard-deviation,uncertainty-type-a,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc', 'Calibration Method for Thermohygrometer', '2020-12-08 09:00:38', '2020-12-08 09:00:38'),
(8, 'AIMS/TM/LCP/E-01', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc,uncertainty-due-to-drift-in-temperature', 'Calibration of V, I, R, H & C', '2020-12-08 09:15:17', '2020-12-08 09:15:17'),
(9, 'AIMS/TM/LCP/E-02', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc,uncertainty-due-to-function-generator', 'Calibration of Instruments related to RPM Measurement', '2020-12-08 09:27:27', '2020-12-08 09:28:30'),
(10, 'Ops Manual', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-offset-of-uuc,uncertainty-due-to-hysteresis-uuc,uncertainty-due-to-resolution-of-uuc', 'Operation and Verification of Hardness Tester', '2020-12-08 09:34:51', '2020-12-08 09:34:51'),
(11, 'AIMS/TM/LCP/ITS-01', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc,uncertainty-due-to-temperature-stability-of-chamber', 'Calibration Procedure For Annemometers', '2020-12-08 09:42:02', '2020-12-08 09:42:02'),
(12, 'TM/LCP/ITS-015', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,uncertainty-due-to-resolution-of-uuc', 'Calibration of Multigas Detector/Analyzer', '2020-12-08 09:46:45', '2020-12-08 09:46:45'),
(13, 'AIMS-TM-LCP-ITS-13', 'standard-deviation,uncertainty-type-a,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc,uncertainty-of-standard-obtained-from-cert-of-ph-buffer,uncertainty-due-to-temp-drift-of-ph-value-from-25-0c', 'Calibration procedure for turbidity meter', '2020-12-08 09:50:33', '2020-12-08 10:35:40'),
(14, 'AS TG4', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-accuracy-of-uuc', 'Calibration Procedure For UV/Vis Spectrophotometer', '2020-12-08 10:37:32', '2020-12-08 10:37:32'),
(15, 'DKD-R 5-7', 'standard-deviation,uncertainty-type-a,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-resolution-of-std,uncertainty-due-to-repeatability-of-indication-of-uuc-u6,uncertainty-due-to-temp-inhomogenity-of-uuc-u7,uncertainty-due-to-temp-instability-of-uuc-u8,uncertainty-due-to-radiation-effect-u9,uncertainty-due-to-loading-effect-u10', 'Calibration of Climatic Chambers', '2021-02-23 14:45:32', '2021-02-24 12:36:29'),
(16, 'ASTM E2847-11', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-of-source-emissivity-from-x2-4-5-of-astm-e2847-u4,uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5,uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6,uncertainty-due-to-source-stability-from-manual-of-source-u7,uncertainty-due-to-source-uniformity-from-manual-of-source-u8', 'International Standard Procedure for Calibration of IR Thermometer', '2021-02-25 06:13:10', '2021-02-25 07:21:56'),
(17, 'ASTM E77', 'standard-deviation,uncertainty-type-a,combined-uncertainty-of-standard,drift-of-the-standard,uncertainty-due-to-resolution-of-uuc,uncertainty-due-to-spatial-in-homogeniety-of-bath-u5,uncertainty-due-to-loading-effect-lig,uncertainty-due-to-stability-with-time-u8,uncertainty-due-to-parallex-of-indication-of-uuc-u10', 'Standard Test Method for Inspection and Verification of Thermometers', '2021-02-25 10:04:55', '2021-02-25 10:10:10'),
(18, 'ASTM E542-01', 'standard-deviation,relative-combined-uncertainty-of-standard-ub1,relative-combined-uncertainty-of-balance-ub2,relative-combined-uncertainty-thermometer-ub3,relative-uncertainty-due-to-resolution-of-uuc-ub4,relative-uncertainty-due-to-drift-of-the-std-balance-ub5,relative-uncertainty-due-to-temp-drift-of-water-ub6,relative-uncertainty-due-to-tolerance-of-uuc-ub7,relative-uncertainty-due-density-ofaair-ub8,relative-uncertainty-due-to-water-density-tanaka-s-value-ub9,relative-uncertainty-due-to-reading-of-meniscus-ub10,relative-uncertainty-due-to-thermal-expansion-coefficient-of-uuc-ub11', 'Calibration of Volumetric Apparatus using Gravimetric Method', '2021-02-26 13:17:54', '2021-03-25 07:59:59'),
(19, 'AS TG4', 'standard-deviation,uncertainty-type-a', 'Calibration Procedure For UV/Vis Spectrophotometer', '2021-03-26 11:16:58', '2021-03-26 11:16:58'),
(20, 'umLTM SOP 6', 'uncertainty-due-to-resolution-of-uuc,uncertainty-of-repeatability-ua,uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical,uncertainty-of-thermal-expansion-coefficient-u-a-m,uncertainty-of-guage-block-temp-difference-u-the,uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th,uncertainty-of-calibration-of-standard-u-le,uncertainty-of-thermal-expansion-co-efficient-difference-u-da,uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df', 'SOP for Calibration of Vernier Caliper', '2021-04-02 13:00:41', '2021-04-09 05:33:21'),
(21, 'umLTM SOP 5', 'standard-deviation,uncertainty-of-repeatability-ua,uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical,uncertainty-of-thermal-expansion-coefficient-u-a-m,uncertainty-of-guage-block-temp-difference-u-the,uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th,uncertainty-of-calibration-of-standard-u-le,uncertainty-of-thermal-expansion-co-efficient-difference-u-da,uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df', 'SOP for Calibration of Micrometers', '2021-04-09 11:55:23', '2021-04-09 11:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseindentitems`
--

CREATE TABLE `purchaseindentitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `indent_id` int(11) NOT NULL,
  `item_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_six_months_consumption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchaseindentitems`
--

INSERT INTO `purchaseindentitems` (`id`, `indent_id`, `item_code`, `item_description`, `ref_code`, `unit`, `last_six_months_consumption`, `current_stock`, `qty`, `purpose`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'item code', 'description', 'reference code', 'ea', '100 Sache', '10', '3', 'purpose', 'title', 2, '2020-12-18 08:56:24', '2020-12-23 11:02:22'),
(2, 1, 'item code', 'description items', 'reference codes', 'dozen', 'last 6 months consumption', '5', '3', 'purposes', 'titles', 0, '2020-12-18 09:26:26', '2020-12-22 03:12:39'),
(3, 3, 'code-1', 'description', 'code', 'ea', '10', '10', '200', 'purposr', 'tile', 3, '2021-02-08 15:42:52', '2021-02-08 15:50:45'),
(4, 5, 'item', 'desccription', 'refercne', 'ea', '12', '2', '11', 'purpose', 'title', 0, '2021-02-26 04:37:41', '2021-02-26 04:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseindents`
--

CREATE TABLE `purchaseindents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` int(11) NOT NULL,
  `indent_by` int(11) NOT NULL,
  `checked_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `indent_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliver_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `required` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchaseindents`
--

INSERT INTO `purchaseindents` (`id`, `location`, `department`, `indent_by`, `checked_by`, `approved_by`, `indent_type`, `deliver_to`, `status`, `required`, `created_at`, `updated_at`) VALUES
(1, 'AIMS Cal Lab Lahore', 2, 1, 1, 1, 'capital', '3', 2, '2020-12-18', '2020-12-18 06:58:25', '2020-12-18 06:58:25'),
(3, 'AIMS Cal Lab Lahore', 3, 1, 1, 1, 'capital', '5', 0, '2021-02-08', '2021-02-08 15:41:33', '2021-02-08 15:41:33'),
(4, 'AIMS Cal Lab Lahore', 1, 1, 1, 1, 'normal', '1', 0, '2021-02-08', '2021-02-08 15:44:03', '2021-02-08 15:44:03'),
(5, 'AIMS Cal Lab Lahore', 1, 1, 1, 1, 'capital', '1', 0, '2021-02-26', '2021-02-26 04:37:07', '2021-02-26 04:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `quoterevisionlogs`
--

CREATE TABLE `quoterevisionlogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `type` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_mode` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_mode_details` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_mode` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_mode_details` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `turnaround` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder` int(11) NOT NULL DEFAULT 0,
  `tm` int(11) DEFAULT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` int(11) NOT NULL DEFAULT 0,
  `sendtocustomer_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `customer_id`, `type`, `rfq_mode`, `rfq_mode_details`, `approval_mode`, `approval_mode_details`, `approval_date`, `status`, `turnaround`, `remarks`, `reminder`, `tm`, `principal`, `revision`, `sendtocustomer_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1000, 1055, 'LAB', 'email', 'email@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, 0, 2, 'Muhammad Adil Ghani', 0, NULL, NULL, '2021-02-21 15:09:32', '2021-02-26 13:00:51'),
(1001, 1131, 'LAB', 'email', 'ensm@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, 0, 2, 'Masood Khan', 0, NULL, NULL, '2021-03-26 09:21:51', '2021-03-26 09:24:24'),
(1002, 1120, 'LAB', 'walk-in', '+98032840211', NULL, NULL, NULL, 3, NULL, NULL, 0, 2, 'Aleem Butt', 0, NULL, NULL, '2021-04-02 12:53:36', '2021-04-02 12:56:11'),
(1003, 1191, 'LAB', 'whatsapp', '+93948598223', NULL, NULL, NULL, 3, NULL, NULL, 0, 2, 'Adeel Afzal', 0, NULL, NULL, '2021-04-09 09:40:18', '2021-04-09 09:49:34'),
(1004, 1155, 'LAB', 'email', 'email@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, 0, 2, 'Masood Haider', 0, NULL, NULL, '2021-04-09 11:56:30', '2021-04-09 11:57:10'),
(1005, 1046, 'LAB', 'walk-in', 'emazeem_ +9302938490', NULL, NULL, NULL, 3, NULL, NULL, 0, 2, 'Mohsin Siddique', 0, NULL, NULL, '2021-04-10 12:38:08', '2021-04-10 12:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_ledgers`
--

CREATE TABLE `receiving_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `payment_way` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_designation` int(11) NOT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_skills` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initiated_by` int(11) NOT NULL,
  `time_frame` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hrd_review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `requisition_designation`, `reason`, `qualification`, `special_skills`, `initiated_by`, `time_frame`, `hrd_review`, `approved_by`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 6, 'Software Developer Required', 'BS Software Engineer', 'Graphics Designing', 1, 'two-week', 'internal-re-adjustment', NULL, 'Remarks', '2021-02-02 06:01:15', '2021-02-02 06:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'customer-index,customer-create,customer-edit,customer-view,customer-delete,items-index,items-create,items-update,items-delete,items-add-non-listed,items-update-non-listed,mytask-index,mytask-view,start-mytask,end-mytask,get-certificate,settings-index,menu-index,menu-create,menu-edit,menu-delete,roles-index,roles-create,roles-edit,roles-delete,preferences-index,activity-log-index,staff-details,staff-create,staff-edit,staff-view,department-index,department-create,designation-index,designation-create,designation-edit,department-edit,staff-index,calibration-management,parameter-create,parameter-edit,parameter-delete,asset-index,asset-create,asset-edit,asset-delete,capabilities-create,capabilities-edit,capabilities-view,capabilities-delete,add-procedure,update-procedure,create-asset-group,update-asset-group,parameter-index,capabilities-index,manage-reference-index,units-index,uncertainties-index,asset-groups,procedure-index,dashboard-index,manage-jobs,manage-jobs-index,add-pending,print-pending-tech-review,create-job,delete-job,add-recieving,update-receiving,create-scheduling,edit-scheduling,jobs-index,scheduling-index,finance-accounts,invoicing-ledger-index,add-job-invoice-receiving,update-job-invoice-receiving,acc-level-one-index,acc-level-two-index,acc-level-three-index,acc-level-four-index,vouchers-index,journal-index,document-control,sop-index,create-sop,update-sop,forms-index,purchase,indent-index,material-receiving-index,rfq,generate-requests-index,quote-create,quote-edit,quote-view,quote-send-to-customer,quote-print-details,quote-accept,quote-revised,quote-close,pending-index,pendings-no-facility,quote-index,hr-index,requisition-index,interview-appraisal-index,emp-contract-index,emp-joining-index,employee-orientation-index,leave-application-index,inventory-index,inventory-categories-index,inventories-index', NULL, '2020-09-27 19:44:39', '2021-03-22 12:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `sops`
--

CREATE TABLE `sops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_no` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_no` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_no` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue` date DEFAULT NULL,
  `reviewed_on` date DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `location` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_of_storage` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sops`
--

INSERT INTO `sops` (`id`, `name`, `parent_id`, `issue_no`, `rev_no`, `doc_no`, `file`, `issue`, `reviewed_on`, `reviewed_by`, `status`, `location`, `mode_of_storage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'AIMS-HR-SOP-01 Personal Management', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-26 07:41:35', '2020-12-26 07:41:35'),
(2, NULL, '1', '01', '02', 'AIMS-HR-01', '1608986590-1608734994-default_avatar_male.jpg', '2020-12-26', '2020-12-26', 2, 1, 'QE', 'soft-copy', NULL, '2020-12-26 07:42:00', '2020-12-26 07:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `spectrophotometerentries`
--

CREATE TABLE `spectrophotometerentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuc_wavelength` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filtertype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spectrophotometerentries`
--

INSERT INTO `spectrophotometerentries` (`id`, `parent_id`, `x1`, `x2`, `x3`, `uuc_wavelength`, `filtertype`, `asset_id`, `unit`, `data`, `created_at`, `updated_at`) VALUES
(5, '2', '10.1', '10.2', '10.3', '440', 'N3', 180, 58, NULL, '2021-04-02 06:33:46', '2021-04-02 06:33:46'),
(6, '2', '10.1', '10.2', '10.3', '440', 'N3', 180, 58, NULL, '2021-04-02 06:35:06', '2021-04-02 06:35:06'),
(7, '2', '10.1', '10.2', '10.3', '440', 'N3', 180, 58, NULL, '2021-04-02 06:35:49', '2021-04-02 06:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `capabilities` int(11) NOT NULL,
  `parameter` int(11) NOT NULL,
  `optional_assets` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uncertainties`
--

CREATE TABLE `uncertainties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formula` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coefficient_of_sensitivity` int(11) NOT NULL,
  `distribution` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uncertainties`
--

INSERT INTO `uncertainties` (`id`, `name`, `slug`, `formula`, `coefficient_of_sensitivity`, `distribution`, `created_at`, `updated_at`) VALUES
(1, 'Standard Deviation', 'standard-deviation', '<p>&radic;[ &sum;(x - mean)2&nbsp;/ (N - 1) ]</p>', 1, 'null', '2020-11-12 02:12:19', '2020-12-24 09:14:01'),
(2, 'Uncertainty Type A', 'uncertainty-type-a', '<p>SD/&radic;5</p>', 0, 'Normal (K=1)', '2020-11-12 00:38:50', '2020-12-23 07:21:06'),
(3, 'Combined Uncertainty of Standard', 'combined-uncertainty-of-standard', '<p>Uc&nbsp;from cal&nbsp; certificate</p>', 1, 'Normal (K=1)', '2020-12-07 09:17:42', '2020-12-23 07:27:25'),
(5, 'Drift of the Standard', 'drift-of-the-standard', '', 0, '', '2020-11-12 02:15:25', '2020-11-12 02:15:25'),
(6, 'Uncertainty due to Offset of UUC', 'uncertainty-due-to-offset-of-uuc', '', 0, '', '2020-11-12 02:15:53', '2020-11-12 02:15:53'),
(7, 'Uncertainty due to Hysteresis UUC', 'uncertainty-due-to-hysteresis-uuc', '', 0, '', '2020-11-12 02:16:21', '2020-11-12 02:17:19'),
(8, 'Uncertainty due to resolution of UUC', 'uncertainty-due-to-resolution-of-uuc', '<p>(Res/2)&radic;3</p>', 1, 'Rectangular', '2020-11-12 02:38:26', '2020-12-23 07:59:56'),
(9, 'Uncertainty due to Accuracy of UUC', 'uncertainty-due-to-accuracy-of-uuc', '', 0, '', '2020-12-03 13:38:54', '2020-12-03 13:38:54'),
(20, 'Uncertainty due to Drift in Temperature', 'uncertainty-due-to-drift-in-temperature', '', 0, '', '2020-12-07 09:44:30', '2020-12-07 09:44:30'),
(21, 'Uncertainty Due to resolution of Std', 'uncertainty-due-to-resolution-of-std', '', 0, '', '2020-12-07 14:03:35', '2020-12-07 14:03:35'),
(22, 'Uncertainty due to Temperature Stability of Chamber', 'uncertainty-due-to-temperature-stability-of-chamber', '', 0, '', '2020-12-08 07:54:54', '2020-12-08 07:54:54'),
(23, 'Uncertainty due to Function Generator', 'uncertainty-due-to-function-generator', '', 0, '', '2020-12-08 09:28:16', '2020-12-08 09:28:16'),
(24, 'Uncertainty of Standard Obtained from Cert of pH Buffer', 'uncertainty-of-standard-obtained-from-cert-of-ph-buffer', '', 0, '', '2020-12-08 09:54:05', '2020-12-08 09:54:05'),
(25, 'Uncertainty Due to Temp Drift of pH Value from 25 °C', 'uncertainty-due-to-temp-drift-of-ph-value-from-25-0c', '<pre>\r\n&lt;div class=&quot;col-8 text-center custom-bottom-border px-5&quot; style=&quot;height: 40px&quot;&gt;\r\n</pre>', 0, 'Norml', '2020-12-08 09:54:23', '2020-12-24 09:14:29'),
(27, 'Uncertainty Due to repeatability of indication of UUC (u6)', 'uncertainty-due-to-repeatability-of-indication-of-uuc-u6', 'δT ind / √11', 1, 'Rectangular', '2021-02-23 14:37:12', '2021-02-23 14:37:12'),
(28, 'Uncertainty Due to Temp Inhomogenity   of UUC (u7)', 'uncertainty-due-to-temp-inhomogenity-of-uuc-u7', 'δT inhom / √3', 1, 'Rectangular', '2021-02-23 14:37:57', '2021-02-23 14:37:57'),
(29, 'Uncertainty Due to Temp Instability of UUC (u8)', 'uncertainty-due-to-temp-instability-of-uuc-u8', 'δTinstab / √3', 1, 'Rectangular', '2021-02-23 14:38:50', '2021-02-23 14:38:50'),
(30, 'Uncertainty Due to Radiation Effect (u9)', 'uncertainty-due-to-radiation-effect-u9', 'δTradiation / √3', 1, 'Rectangular', '2021-02-23 14:39:41', '2021-02-23 14:39:41'),
(31, 'Uncertainty Due to Loading Effect (u10)', 'uncertainty-due-to-loading-effect-u10', 'δTload / √3', 1, 'Rectangular', '2021-02-23 14:40:39', '2021-02-23 14:40:39'),
(32, 'Uncertainty of Source Emissivity From X2.4.5 of ASTM E2847 (u4)', 'uncertainty-of-source-emissivity-from-x2-4-5-of-astm-e2847-u4', 'dT e /√3', 1, 'Rectangular', '2021-02-25 06:07:12', '2021-02-25 06:07:12'),
(33, '\"Uncertainty of  Reflected Ambient Radiation From X2.13 of ASTM E2847 (u5)\"', 'uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5', 'dTReflect /√3', 1, 'Rectangular', '2021-02-25 06:07:41', '2021-02-25 06:07:41'),
(34, '\"Uncertainty of Source Heat Exchange (X1.1 table in ASTM E2847)  (u6)\"', 'uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6', 'dTheat exch/ √3', 1, 'Rectangular', '2021-02-25 06:08:00', '2021-02-25 06:08:00'),
(35, '\"Uncertainty Due to Source Stability From Manual of Source  (u7)\"', 'uncertainty-due-to-source-stability-from-manual-of-source-u7', 'dTstab / √3', 1, 'Rectangular', '2021-02-25 06:08:16', '2021-02-25 06:08:16'),
(36, '\"Uncertainty Due to Source Uniformity From Manual of Source  (u8)\"', 'uncertainty-due-to-source-uniformity-from-manual-of-source-u8', 'dTuniform / √3', 1, 'Rectangular', '2021-02-25 06:08:51', '2021-02-25 06:08:51'),
(37, '\"Uncertainty Due to spatial in-homogeniety of bath (u5)\"', 'uncertainty-due-to-spatial-in-homogeniety-of-bath-u5', 'dTAx-hom /√3', 1, 'Rectangular', '2021-02-25 10:05:45', '2021-02-25 10:05:45'),
(38, 'Uncertainty Due to Loading Effect (LIG)', 'uncertainty-due-to-loading-effect-lig', 'dTload / √3', 1, 'Rectangular', '2021-02-25 10:07:23', '2021-02-25 10:07:23'),
(39, '\"Uncertainty Due to Stability with time (u8)\"', 'uncertainty-due-to-stability-with-time-u8', 'dTstab/ √3', 1, 'Rectangular', '2021-02-25 10:07:55', '2021-02-25 10:07:55'),
(40, '\"Uncertainty Due to parallex of indication of UUC  (u10)\"', 'uncertainty-due-to-parallex-of-indication-of-uuc-u10', 'dTparallex / √3', 1, 'Rectangular', '2021-02-25 10:08:21', '2021-02-25 10:08:21'),
(41, 'Relative Combined Uncertainty of Standard (uB1)', 'relative-combined-uncertainty-of-standard-ub1', 'UC from cal certificate', 1, 'Rectangular', '2021-03-25 07:55:42', '2021-03-25 07:55:42'),
(42, 'Relative Combined Uncertainty of Balance    (uB2)', 'relative-combined-uncertainty-of-balance-ub2', 'UC from cal certificate', 1, 'Rectangular', '2021-03-25 07:55:55', '2021-03-25 07:55:55'),
(43, 'Relative Combined Uncertainty Thermometer   (uB3)', 'relative-combined-uncertainty-thermometer-ub3', 'UC from cal certificate', 1, 'Rectangular', '2021-03-25 07:56:09', '2021-03-25 07:56:09'),
(44, 'Relative Uncertainty Due to resolution of UUC    (uB4)', 'relative-uncertainty-due-to-resolution-of-uuc-ub4', '(Res / 2) / √3', 1, 'Rectangular', '2021-03-25 07:56:19', '2021-03-25 07:56:19'),
(45, 'Relative  Uncertainty due to Drift of the Std Balance (uB5)', 'relative-uncertainty-due-to-drift-of-the-std-balance-ub5', 'U / √3', 1, 'Rectangular', '2021-03-25 07:56:30', '2021-03-25 07:56:30'),
(46, 'Relative Uncertainty due to temp drift of water (uB6)', 'relative-uncertainty-due-to-temp-drift-of-water-ub6', 'αVo(Tlab - Tref) /√3', 1, 'Rectangular', '2021-03-25 07:56:50', '2021-03-25 07:56:50'),
(47, 'Relative Uncertainty due to Tolerance  of UUC (uB7)', 'relative-uncertainty-due-to-tolerance-of-uuc-ub7', 'Accuracy /√3', 1, 'Rectangular', '2021-03-25 07:57:02', '2021-03-25 07:57:02'),
(48, 'Relative Uncertainty due Density ofAair (uB8)', 'relative-uncertainty-due-density-ofaair-ub8', '5x10-7/√3', 1, 'Rectangular', '2021-03-25 07:57:13', '2021-03-25 07:57:13'),
(49, 'Relative Uncertainty due to Water Density \"Tanaka\'s value\" (uB9)', 'relative-uncertainty-due-to-water-density-tanaka-s-value-ub9', '1.3 x 10-6', 1, 'Rectangular', '2021-03-25 07:57:27', '2021-03-25 07:57:27'),
(50, 'Relative Uncertainty due to Reading of Meniscus (uB10)', 'relative-uncertainty-due-to-reading-of-meniscus-ub10', 'Res/2 /√3', 1, 'Rectangular', '2021-03-25 07:57:38', '2021-03-25 07:57:38'),
(51, 'Relative Uncertainty due to Thermal expansion coefficient of UUC (uB11)', 'relative-uncertainty-due-to-thermal-expansion-coefficient-of-uuc-ub11', '5x10-7/√3', 1, 'Rectangular', '2021-03-25 07:57:49', '2021-03-25 07:57:49'),
(52, 'Uncertainty of Repeatability(ua)', 'uncertainty-of-repeatability-ua', 'null', 1, 'Rectangular', '2021-04-09 05:27:23', '2021-04-09 05:27:23'),
(53, 'Uncertainty of Reading of the Result (max permissible error of UUC) u (li) 1mm for digital or 2 mm for classical', 'uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical', 'null', 1, 'Rectangular', '2021-04-09 05:28:18', '2021-04-09 05:28:18'),
(54, 'Uncertainty of Thermal Expansion Coefficient   u ( α m)', 'uncertainty-of-thermal-expansion-coefficient-u-a-m', 'null', 1, 'Rectangular', '2021-04-09 05:28:35', '2021-04-09 05:28:35'),
(55, 'Uncertainty of Guage Block Temp Difference   u (θe)', 'uncertainty-of-guage-block-temp-difference-u-the', 'null', 1, 'Rectangular', '2021-04-09 05:28:48', '2021-04-09 05:28:48'),
(56, 'Uncertainty of Temp diff b/w ref and UUC  u (d θ)', 'uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th', 'null', 1, 'Rectangular', '2021-04-09 05:29:04', '2021-04-09 05:29:04'),
(57, 'Uncertainty of calibration of standard   u (le)', 'uncertainty-of-calibration-of-standard-u-le', 'null', 1, 'Rectangular', '2021-04-09 05:29:17', '2021-04-09 05:29:17'),
(58, 'Uncertainty of  thermal expansion co-efficient difference  u (dα)', 'uncertainty-of-thermal-expansion-co-efficient-difference-u-da', 'null', 1, 'Rectangular', '2021-04-09 05:29:30', '2021-04-09 05:29:30'),
(59, 'Uncertaintyof assumed difference b/w deformations caused by measurement force u (dF)', 'uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df', 'null', 1, 'Rectangular', '2021-04-09 05:29:46', '2021-04-09 05:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_` int(11) DEFAULT NULL,
  `factor_multiply` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factor_add` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `parameter`, `unit`, `primary_`, `factor_multiply`, `factor_add`, `created_at`, `updated_at`) VALUES
(1, 27, '°C', NULL, '0', '0', '2020-12-03 07:30:17', '2020-12-24 07:33:41'),
(2, 6, 'KgF', NULL, '0', '0', '2020-12-08 12:38:05', '2020-12-08 12:38:05'),
(3, 6, 'N', NULL, '0', '0', '2020-12-08 12:38:41', '2020-12-08 12:38:41'),
(4, 27, 'K', NULL, '0', '0', '2020-12-11 07:07:32', '2020-12-11 07:07:32'),
(5, 1, 'µS/cm', NULL, '0', '0', '2020-12-11 14:08:48', '2020-12-11 14:33:22'),
(6, 17, 'Bar', NULL, '0', '0', '2020-12-11 14:28:32', '2020-12-11 14:28:32'),
(7, 17, 'hPa', NULL, '0', '0', '2020-12-11 14:28:48', '2020-12-11 14:28:48'),
(8, 17, 'kPa', NULL, '0', '0', '2020-12-11 14:29:15', '2020-12-11 14:29:15'),
(9, 17, 'Mpa', NULL, '0', '0', '2020-12-11 14:29:27', '2020-12-11 14:29:27'),
(10, 17, 'psi', NULL, '0', '0', '2020-12-11 14:29:38', '2020-12-11 14:29:38'),
(11, 17, 'mBar', NULL, '0', '0', '2020-12-11 14:30:15', '2020-12-11 14:30:15'),
(12, 17, 'Pa', NULL, '0', '0', '2020-12-11 14:31:04', '2020-12-11 14:31:04'),
(13, 17, 'Kg/cm2', NULL, '0', '0', '2020-12-11 14:31:32', '2020-12-11 14:31:32'),
(14, 17, 'mmHg', NULL, '0', '0', '2020-12-11 14:31:50', '2020-12-11 14:31:50'),
(15, 17, 'inHg', NULL, '0', '0', '2020-12-11 14:32:04', '2020-12-11 14:32:04'),
(16, 17, 'mmH2O', NULL, '0', '0', '2020-12-11 14:32:28', '2020-12-11 14:32:28'),
(17, 17, 'inH2O', NULL, '0', '0', '2020-12-11 14:32:46', '2020-12-11 14:32:46'),
(18, 5, 'mV(DC)', NULL, '0', '0', '2020-12-14 06:49:25', '2020-12-14 06:49:25'),
(19, 5, 'V(DC)', NULL, '0', '0', '2020-12-14 06:49:49', '2020-12-14 06:49:49'),
(20, 5, 'mV(AC @ 50 Hz', NULL, '0', '0', '2020-12-14 06:50:39', '2020-12-14 06:50:39'),
(21, 5, 'V(AC @ 50 Hz)', NULL, '0', '0', '2020-12-14 06:51:17', '2020-12-14 06:51:17'),
(22, 5, 'µA (DC I)', NULL, '0', '0', '2020-12-14 06:52:35', '2020-12-14 06:52:35'),
(23, 5, 'mA (DC I)', NULL, '0', '0', '2020-12-14 06:53:10', '2020-12-14 06:53:10'),
(24, 5, 'A (DC I)', NULL, '0', '0', '2020-12-14 06:53:51', '2020-12-14 06:53:51'),
(25, 5, 'mA (AC I @ 50Hz)', NULL, '0', '0', '2020-12-14 07:00:50', '2020-12-14 07:00:50'),
(26, 5, 'A (AC I @ 50Hz)', NULL, '0', '0', '2020-12-14 07:01:26', '2020-12-14 07:01:26'),
(27, 5, 'Ω', NULL, '0', '0', '2020-12-14 07:02:03', '2020-12-14 07:02:03'),
(28, 5, 'kΩ', NULL, '0', '0', '2020-12-14 07:02:33', '2020-12-14 07:02:33'),
(29, 5, 'MΩ', NULL, '0', '0', '2020-12-14 07:02:52', '2020-12-14 07:02:52'),
(30, 5, 'GΩ', NULL, '0', '0', '2020-12-14 07:03:30', '2020-12-14 07:03:30'),
(31, 5, 'Hz', NULL, '0', '0', '2020-12-14 07:04:25', '2020-12-14 07:04:25'),
(32, 5, 'MHz', NULL, '0', '0', '2020-12-14 07:04:39', '2020-12-14 07:04:39'),
(33, 5, 'nF', NULL, '0', '0', '2020-12-14 07:04:58', '2020-12-14 07:04:58'),
(34, 5, 'µF', NULL, '0', '0', '2020-12-14 07:05:16', '2020-12-14 07:05:16'),
(35, 5, 'µA (AC I @ 50Hz)', NULL, '0', '0', '2020-12-14 07:08:03', '2020-12-14 07:08:03'),
(36, 13, 'g', NULL, '0', '0', '2020-12-14 07:14:48', '2020-12-14 07:14:48'),
(37, 13, 'mg', NULL, '0', '0', '2020-12-14 07:15:03', '2020-12-14 07:15:03'),
(38, 13, 'kg', NULL, '0', '0', '2020-12-14 07:15:16', '2020-12-14 07:15:16'),
(39, 27, '°F', NULL, '0', '0', '2020-12-24 07:39:43', '2020-12-24 07:39:43'),
(40, 28, 'Nm', NULL, '0', '0', '2020-12-25 15:59:38', '2020-12-25 15:59:38'),
(41, 28, 'lb.ft', NULL, '0', '0', '2020-12-25 16:00:25', '2020-12-25 16:00:25'),
(42, 28, 'lb.in', NULL, '0', '0', '2020-12-25 16:01:03', '2020-12-25 16:01:03'),
(43, 1, 'mS', NULL, '0', '0', '2020-12-25 16:09:32', '2020-12-25 16:09:32'),
(44, 1, 'ppm', NULL, '0', '0', '2020-12-25 16:09:52', '2020-12-25 16:09:52'),
(45, 1, 'ppt', NULL, '0', '0', '2020-12-25 16:10:08', '2020-12-25 16:10:08'),
(46, 18, 'pH', NULL, '0', '0', '2020-12-25 16:18:19', '2020-12-25 16:18:19'),
(47, 26, 'dB', NULL, '0', '0', '2020-12-26 08:58:01', '2020-12-26 08:58:01'),
(48, 21, 'RPM', NULL, '0', '0', '2020-12-26 09:00:47', '2020-12-26 09:00:47'),
(49, 28, 'mm', NULL, '0', '0', '2020-12-26 13:03:24', '2020-12-26 13:03:24'),
(50, 3, 'μm', NULL, '0', '0', '2020-12-30 06:44:42', '2020-12-30 06:44:42'),
(51, 3, 'cm', NULL, '0', '0', '2020-12-30 07:03:23', '2020-12-30 07:03:23'),
(52, 3, 'mm', NULL, '0', '0', '2020-12-30 07:19:52', '2020-12-30 07:19:52'),
(53, 3, 'm', NULL, '0', '0', '2020-12-30 08:05:48', '2020-12-30 08:05:48'),
(54, 5, 'kHz', NULL, '0', '0', '2020-12-31 15:37:08', '2020-12-31 15:37:08'),
(55, 5, '°C', NULL, '0', '0', '2020-12-31 15:39:11', '2020-12-31 15:39:11'),
(56, 19, 'nm', NULL, '1', '0', '2021-03-26 14:19:39', '2021-03-26 14:19:39'),
(57, 19, 'A', NULL, '1', '0', '2021-03-26 14:20:25', '2021-03-26 14:20:25'),
(58, 19, '%T', NULL, '1', '0', '2021-03-26 14:20:46', '2021-03-26 14:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `joining` date NOT NULL,
  `signature` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `designation`, `department`, `fname`, `lname`, `father_name`, `cv`, `profile`, `phone`, `cnic`, `address`, `email`, `email_verified_at`, `password`, `dob`, `joining`, `signature`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 5, 'Muhammad', 'Azeem', 'Mansab Ali', NULL, '1610276586.png', '03040647306', '33100-1231231-7', 'Nishat Mills Faisalabad', 'aims@lims.com', NULL, '$2y$10$1h2sLu0zZXFVFzyuuhF3we.D.Y55ZwjOIC36JYbTZHiITWy3ASH2.', '1998-08-13', '2020-07-13', '1610288579-1280px-Signature_of_Azim_Premji.svg.png', 'vxOunVm1mR4YlolTomAyHadCd69cdu0x31HF8tmtPCDFOEKu1iHqNE5SnNM5', NULL, '2021-01-10 09:22:59'),
(2, 1, 8, 3, 'Riaz', 'Ahmad', 'Khushi Muhammad', '1608816889-1608734994-default_avatar_male.jpg', '1602331350Chrysanthemum.jpg', '03115176548', '42401-7450240-1', 'House No 115-A, Al Hafiz Town, 80 Ft Road, Maraghzar Colony, Lahore', 'tm@aimscal.com', NULL, '$2y$10$Wv/G3upk9wwwbPJZ.yYRDObFk4iguuS0mzJA62plFPjX15Ta0n7.W', '1975-05-03', '2017-09-23', '1608816889-1608734994-default_avatar_male.jpg', NULL, '2020-10-10 01:58:13', '2020-12-24 08:34:49'),
(3, 2, 6, 2, 'Imtiaz', 'Ahmed', 'Ghulam Hussain', NULL, NULL, '+923016236150', '38403-6480748-5', 'House No. 324, Block R3, Johar Town Lahore', 'imtiazpaki@gmail.com', NULL, '$2y$10$Wv/G3upk9wwwbPJZ.yYRDObFk4iguuS0mzJA62plFPjX15Ta0n7.W', '1972-04-04', '2016-02-10', '', 'Wua5Qwn6vVXRvfoYJ0eZA6gLY0Il9RiZw6kxaG83ShEj5Vu885U6XuSnscZ9', '2020-10-10 03:35:24', '2020-10-10 03:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `vernierentries`
--

CREATE TABLE `vernierentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vernierentries`
--

INSERT INTO `vernierentries` (`id`, `parent_id`, `x1`, `x2`, `x3`, `ref`, `asset_id`, `unit`, `data`, `created_at`, `updated_at`) VALUES
(1, '1', '10.1', '10.2', '10.3', '10', 140, 52, NULL, '2021-04-02 14:38:13', '2021-04-02 14:38:13'),
(2, '1', '20.1', '20.2', '20.3', '20', 140, 52, NULL, '2021-04-02 14:38:13', '2021-04-02 14:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `volumeentries`
--

CREATE TABLE `volumeentries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `x1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `uuc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volumeentries`
--

INSERT INTO `volumeentries` (`id`, `parent_id`, `x1`, `x2`, `x3`, `y1`, `y2`, `y3`, `asset_id`, `unit`, `uuc`, `data`, `created_at`, `updated_at`) VALUES
(4, 1, '42.12', '42.13', '42.11', '290.10', '290.08', '290.09', 101, 36, '250', NULL, '2021-03-25 04:12:55', '2021-03-25 04:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `voucherdetails`
--

CREATE TABLE `voucherdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `v_id` int(11) NOT NULL,
  `acc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dr` double(8,2) DEFAULT NULL,
  `cr` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customize_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_date` date NOT NULL,
  `v_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zvalues`
--

CREATE TABLE `zvalues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atm_pressure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `z_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zvalues`
--

INSERT INTO `zvalues` (`id`, `class`, `atm_pressure`, `temperature`, `z_value`, `created_at`, `updated_at`) VALUES
(1, 'A', '987', '15', '1.00201', '2021-03-25 04:47:50', '2021-03-25 04:47:50'),
(2, 'A', '987', '16', '1.00215', '2021-03-25 04:48:11', '2021-03-25 04:48:11'),
(3, 'A', '987', '17', '1.0023', '2021-03-25 04:48:23', '2021-03-25 04:48:23'),
(4, 'A', '987', '18', '1.00247', '2021-03-25 04:48:35', '2021-03-25 04:48:35'),
(5, 'A', '987', '19', '1.00265', '2021-03-25 04:49:44', '2021-03-25 04:49:44'),
(6, 'A', '987', '20', '1.00284', '2021-03-25 04:49:57', '2021-03-25 04:49:57'),
(7, 'A', '987', '21', '1.00304', '2021-03-25 04:50:18', '2021-03-25 04:50:18'),
(8, 'A', '987', '22', '1.00324', '2021-03-25 04:50:32', '2021-03-25 04:50:32'),
(9, 'A', '987', '23', '1.00346', '2021-03-25 04:50:46', '2021-03-25 04:50:46'),
(10, 'A', '987', '24', '1.0037', '2021-03-25 04:50:55', '2021-03-25 04:50:55'),
(11, 'A', '987', '25', '1.00393', '2021-03-25 04:51:06', '2021-03-25 04:51:06'),
(12, 'A', '987', '26', '1.00418', '2021-03-25 05:04:17', '2021-03-25 05:04:17'),
(13, 'A', '987', '27', '1.00444', '2021-03-25 05:04:34', '2021-03-25 05:04:34'),
(14, 'A', '987', '28', '1.00471', '2021-03-25 05:04:47', '2021-03-25 05:04:47'),
(15, 'A', '1013', '15', '1.00204', '2021-03-25 05:05:33', '2021-03-25 05:05:33'),
(16, 'A', '1013', '16', '1.00218', '2021-03-25 05:05:43', '2021-03-25 05:05:43'),
(17, 'A', '1013', '17', '1.00233', '2021-03-25 05:05:55', '2021-03-25 05:05:55'),
(18, 'A', '1013', '18', '1.0025', '2021-03-25 05:06:08', '2021-03-25 05:06:08'),
(19, 'A', '1013', '19', '1.00268', '2021-03-25 05:06:52', '2021-03-25 05:06:52'),
(20, 'A', '1013', '20', '1.00286', '2021-03-25 05:08:10', '2021-03-25 05:08:10'),
(21, 'A', '1013', '21', '1.00306', '2021-03-25 05:08:33', '2021-03-25 05:08:33'),
(22, 'A', '1013', '22', '1.00327', '2021-03-25 05:08:49', '2021-03-25 05:08:49'),
(23, 'A', '1013', '23', '1.00349', '2021-03-25 05:09:15', '2021-03-25 05:09:15'),
(24, 'A', '1013', '25', '1.00396', '2021-03-25 05:10:55', '2021-03-25 05:10:55'),
(25, 'A', '1013', '26', '1.00421', '2021-03-25 05:11:20', '2021-03-25 05:11:20'),
(26, 'A', '1013', '27', '1.00447', '2021-03-25 05:11:32', '2021-03-25 05:11:32'),
(27, 'A', '1013', '28', '1.00474', '2021-03-25 05:12:09', '2021-03-25 05:12:09'),
(28, 'B', '987', '15', '1.00204', '2021-03-25 05:13:30', '2021-03-25 05:13:30'),
(29, 'B', '987', '16', '1.00217', '2021-03-25 05:13:45', '2021-03-25 05:13:45'),
(30, 'B', '987', '17', '1.00232', '2021-03-25 05:16:28', '2021-03-25 05:16:28'),
(31, 'B', '987', '18', '1.00248', '2021-03-25 05:16:48', '2021-03-25 05:16:48'),
(32, 'B', '987', '19', '1.00266\r\n', '2021-03-25 05:17:21', '2021-03-25 05:17:21'),
(33, 'B', '987', '20', '1.00284', '2021-03-25 05:18:44', '2021-03-25 05:18:44'),
(34, 'B', '987', '21', '1.00303', '2021-03-25 05:19:00', '2021-03-25 05:19:00'),
(35, 'B', '987', '22', '1.00324', '2021-03-25 05:19:10', '2021-03-25 05:19:10'),
(36, 'B', '987', '23', '1.00345', '2021-03-25 05:19:21', '2021-03-25 05:19:21'),
(37, 'B', '987', '24', '1.00367', '2021-03-25 05:19:39', '2021-03-25 05:19:39'),
(38, 'B', '987', '25', '1.00391', '2021-03-25 05:19:54', '2021-03-25 05:19:54'),
(39, 'B', '987', '26', '1.00415', '2021-03-25 05:20:09', '2021-03-25 05:20:09'),
(40, 'B', '987', '27', '1.00441', '2021-03-25 05:20:28', '2021-03-25 05:20:28'),
(41, 'B', '1013', '15', '1.00206', '2021-03-25 05:22:19', '2021-03-25 05:22:19'),
(42, 'B', '1013', '16', '1.0022', '2021-03-25 05:22:37', '2021-03-25 05:22:37'),
(44, 'B', '1013', '17', '1.00235', '2021-03-25 05:23:20', '2021-03-25 05:23:20'),
(45, 'B', '1013', '18', '1.00251', '2021-03-25 05:24:26', '2021-03-25 05:24:26'),
(46, 'B', '1013', '19', '1.00268\r\n', '2021-03-25 05:24:35', '2021-03-25 05:24:35'),
(47, 'B', '1013', '20', '1.00286\r\n', '2021-03-25 05:24:47', '2021-03-25 05:24:47'),
(48, 'B', '1013', '21', '1.00306', '2021-03-25 05:26:15', '2021-03-25 05:26:15'),
(49, 'B', '1013', '22', '1.00326', '2021-03-25 05:26:39', '2021-03-25 05:26:39'),
(50, 'B', '1013', '23', '1.00348', '2021-03-25 05:26:56', '2021-03-25 05:26:56'),
(51, 'B', '1013', '24', '1.0037', '2021-03-25 05:27:11', '2021-03-25 05:27:11'),
(52, 'B', '1013', '25', '1.00393', '2021-03-25 05:28:32', '2021-03-25 05:28:32'),
(53, 'B', '1013', '26', '1.00418', '2021-03-25 05:28:57', '2021-03-25 05:28:57'),
(54, 'B', '1013', '27', '1.00444', '2021-03-25 05:29:10', '2021-03-25 05:29:10'),
(55, 'B', '1013', '28', '1.0047', '2021-03-25 05:29:21', '2021-03-25 05:29:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_level_fours`
--
ALTER TABLE `acc_level_fours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_level_ones`
--
ALTER TABLE `acc_level_ones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_level_threes`
--
ALTER TABLE `acc_level_threes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_level_twos`
--
ALTER TABLE `acc_level_twos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `assetgroups`
--
ALTER TABLE `assetgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetspecifications`
--
ALTER TABLE `assetspecifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balancedataentries`
--
ALTER TABLE `balancedataentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calculatorentries`
--
ALTER TABLE `calculatorentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capabilities`
--
ALTER TABLE `capabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clauses`
--
ALTER TABLE `clauses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `columns`
--
ALTER TABLE `columns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dialgauge_entries`
--
ALTER TABLE `dialgauge_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empcontracts`
--
ALTER TABLE `empcontracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formsandformats`
--
ALTER TABLE `formsandformats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generaldataentries`
--
ALTER TABLE `generaldataentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incubatordataentries`
--
ALTER TABLE `incubatordataentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incubatormappings`
--
ALTER TABLE `incubatormappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intermediatechecksofassets`
--
ALTER TABLE `intermediatechecksofassets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interviewappraisals`
--
ALTER TABLE `interviewappraisals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories_quantity`
--
ALTER TABLE `inventories_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorycategories`
--
ALTER TABLE `inventorycategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicing_ledgers`
--
ALTER TABLE `invoicing_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobitems`
--
ALTER TABLE `jobitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ligentries`
--
ALTER TABLE `ligentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managereferences`
--
ALTER TABLE `managereferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `massreferences`
--
ALTER TABLE `massreferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialreceivings`
--
ALTER TABLE `materialreceivings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `micrometer_entries`
--
ALTER TABLE `micrometer_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nofacilities`
--
ALTER TABLE `nofacilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`(191),`notifiable_id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preventivechecklists`
--
ALTER TABLE `preventivechecklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preventivemaintenancerecords`
--
ALTER TABLE `preventivemaintenancerecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseindentitems`
--
ALTER TABLE `purchaseindentitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseindents`
--
ALTER TABLE `purchaseindents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quoterevisionlogs`
--
ALTER TABLE `quoterevisionlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_ledgers`
--
ALTER TABLE `receiving_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sops`
--
ALTER TABLE `sops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spectrophotometerentries`
--
ALTER TABLE `spectrophotometerentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uncertainties`
--
ALTER TABLE `uncertainties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vernierentries`
--
ALTER TABLE `vernierentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volumeentries`
--
ALTER TABLE `volumeentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucherdetails`
--
ALTER TABLE `voucherdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvalues`
--
ALTER TABLE `zvalues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_level_fours`
--
ALTER TABLE `acc_level_fours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_level_ones`
--
ALTER TABLE `acc_level_ones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_level_threes`
--
ALTER TABLE `acc_level_threes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_level_twos`
--
ALTER TABLE `acc_level_twos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1174;

--
-- AUTO_INCREMENT for table `assetgroups`
--
ALTER TABLE `assetgroups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `balancedataentries`
--
ALTER TABLE `balancedataentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calculatorentries`
--
ALTER TABLE `calculatorentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `capabilities`
--
ALTER TABLE `capabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `clauses`
--
ALTER TABLE `clauses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1217;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dialgauge_entries`
--
ALTER TABLE `dialgauge_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empcontracts`
--
ALTER TABLE `empcontracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `formsandformats`
--
ALTER TABLE `formsandformats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `generaldataentries`
--
ALTER TABLE `generaldataentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `incubatordataentries`
--
ALTER TABLE `incubatordataentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `incubatormappings`
--
ALTER TABLE `incubatormappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `intermediatechecksofassets`
--
ALTER TABLE `intermediatechecksofassets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `interviewappraisals`
--
ALTER TABLE `interviewappraisals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventories_quantity`
--
ALTER TABLE `inventories_quantity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventorycategories`
--
ALTER TABLE `inventorycategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoicing_ledgers`
--
ALTER TABLE `invoicing_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `jobitems`
--
ALTER TABLE `jobitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ligentries`
--
ALTER TABLE `ligentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `managereferences`
--
ALTER TABLE `managereferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=848;

--
-- AUTO_INCREMENT for table `massreferences`
--
ALTER TABLE `massreferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materialreceivings`
--
ALTER TABLE `materialreceivings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `micrometer_entries`
--
ALTER TABLE `micrometer_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `nofacilities`
--
ALTER TABLE `nofacilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `preventivechecklists`
--
ALTER TABLE `preventivechecklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preventivemaintenancerecords`
--
ALTER TABLE `preventivemaintenancerecords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `purchaseindentitems`
--
ALTER TABLE `purchaseindentitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaseindents`
--
ALTER TABLE `purchaseindents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quoterevisionlogs`
--
ALTER TABLE `quoterevisionlogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sops`
--
ALTER TABLE `sops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spectrophotometerentries`
--
ALTER TABLE `spectrophotometerentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uncertainties`
--
ALTER TABLE `uncertainties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vernierentries`
--
ALTER TABLE `vernierentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `volumeentries`
--
ALTER TABLE `volumeentries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voucherdetails`
--
ALTER TABLE `voucherdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zvalues`
--
ALTER TABLE `zvalues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
