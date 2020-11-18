-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 06:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `aims`
--

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `icon`, `status`, `url`, `position`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Menus', 'menu-index', 'fas fa-bars', 1, 'menus', 0, NULL, '2020-09-28 01:37:44', '2020-10-14 15:25:06'),
(2, 'Create Menu', 'menu-create', 'fa fa-', 1, '#', 0, '1', '2020-09-28 01:38:31', '2020-10-14 21:44:14'),
(3, 'Update Menu', 'menu-edit', 'fa fa-', 1, '#', 0, '1', '2020-09-28 01:38:55', '2020-10-14 21:44:28'),
(4, 'Delete Menu', 'menu-delete', 'fa fa-', 1, '#', 0, '1', '2020-09-28 01:40:01', '2020-10-14 21:44:37'),
(5, 'Roles', 'roles-index', 'fa fa-check', 1, 'roles', 1, NULL, '2020-09-28 01:40:37', '2020-10-24 11:55:33'),
(6, 'Create Roles', 'roles-create', 'fa fa-', 1, '#', 0, '5', '2020-09-28 01:40:54', '2020-10-14 21:44:50'),
(7, 'Update Roles', 'roles-edit', 'fa fa-', 1, '#', 0, '5', '2020-09-28 01:41:11', '2020-10-14 21:45:15'),
(8, 'Delete Roles', 'roles-delete', 'fa fa-', 1, '#', 0, '44', '2020-09-28 01:41:38', '2020-09-28 01:41:38'),
(9, 'AIMS Customers', 'customer-index', 'fas fa-users', 1, 'customers', 2, NULL, '2020-09-26 21:55:23', '2020-10-24 11:55:33'),
(10, 'Add Customer', 'customer-create', 'fa fa-', 1, '#', 0, '1', '2020-09-26 21:56:34', '2020-09-26 21:56:34'),
(11, 'Update Customer', 'customer-edit', 'fa fa-', 1, '#', 0, '1', '2020-09-26 21:57:10', '2020-09-26 21:57:10'),
(12, 'View Customer', 'customer-view', 'fa fa-', 1, '#', 0, '1', '2020-09-26 21:57:59', '2020-09-26 21:57:59'),
(13, 'Delete Customer', 'customer-delete', 'fa fa-', 1, '#', 0, '1', '2020-09-26 22:01:15', '2020-09-26 22:01:15'),
(14, 'Our Team', 'staff-index', 'fa fa-users', 1, 'users', 3, NULL, '2020-09-26 21:59:24', '2020-10-24 11:55:33'),
(15, 'Add Team', 'staff-create', 'fa fa-', 1, '#', 0, '14', '2020-09-26 22:14:12', '2020-10-14 21:43:59'),
(16, 'Update Team', 'staff-edit', 'fa fa-', 1, '#', 0, '5', '2020-09-26 22:14:33', '2020-09-26 22:14:33'),
(17, 'Delete Team', 'staff-view', 'fa fa-', 1, '#', 0, '6', '2020-09-26 22:18:42', '2020-09-26 22:18:42'),
(18, 'View Team', 'staff-view', 'fa fa-', 1, '#', 0, '14', '2020-09-26 22:18:42', '2020-10-14 21:43:48'),
(19, 'Department', 'department-index', 'fa fa-list', 1, 'departments', 4, NULL, '2020-09-27 08:15:05', '2020-10-24 11:55:33'),
(20, 'Update Department', 'department-edit', 'fa fa-', 1, '#', 0, '10', '2020-09-27 08:16:01', '2020-09-27 08:16:01'),
(21, 'Add Department', 'department-create', 'fa fa-', 1, '#', 0, '19', '2020-09-27 08:15:41', '2020-10-14 21:43:41'),
(22, 'Delete Department', 'department-delete', 'fa fa-', 1, '#', 0, '10', '2020-09-27 08:15:41', '2020-09-27 08:15:41'),
(23, 'Designation', 'designation-index', 'fa fa-desktop', 1, 'designations', 5, NULL, '2020-09-27 08:24:28', '2020-10-24 11:55:33'),
(24, 'Add Designation', 'designation-create', 'fa fa-', 1, '#', 0, '23', '2020-09-27 08:25:00', '2020-10-14 21:43:33'),
(25, 'Update Designation', 'designation-edit', 'fa fa-', 1, '#', 0, '23', '2020-09-27 08:25:24', '2020-10-14 21:43:25'),
(26, 'Delete Designation', 'designation-delete', 'fa fa-', 1, '#', 0, '23', '2020-09-27 08:25:24', '2020-10-14 21:43:17'),
(27, 'Parameter', 'parameter-index', 'fa fa-tasks', 1, 'parameters', 6, NULL, '2020-09-27 08:26:23', '2020-10-24 11:55:33'),
(28, 'Add Parameter', 'parameter-create', 'fa fa-', 1, '#', 0, '27', '2020-09-27 08:27:04', '2020-10-14 21:42:58'),
(29, 'Update Parameter', 'parameter-edit', 'fa fa-', 1, '#', 0, '27', '2020-09-27 13:44:49', '2020-10-14 21:42:46'),
(30, 'Delete Parameter', 'parameter-edit', 'fa fa-', 1, '#', 0, '27', '2020-09-27 13:44:49', '2020-10-14 21:42:35'),
(31, 'Asset', 'asset-index', 'fa fa-industry', 1, 'assets', 7, NULL, '2020-09-27 13:46:21', '2020-10-24 11:55:33'),
(32, 'Add Asset', 'asset-create', 'fa fa-', 1, '#', 0, '31', '2020-09-27 13:46:54', '2020-10-14 21:42:11'),
(33, 'Update Asset', 'asset-edit', 'fa fa-', 1, '#', 0, '31', '2020-09-27 13:47:21', '2020-10-14 21:42:17'),
(34, 'Delete Asset', 'asset-delete', 'fa fa-', 1, '#', 0, '31', '2020-09-27 13:47:21', '2020-10-14 21:42:03'),
(35, 'Capabilities', 'capabilities-index', 'fa fa-barcode', 1, 'capabilities', 8, NULL, '2020-09-27 13:48:24', '2020-10-24 11:55:33'),
(36, 'Add Capabilities', 'capabilities-create', 'fa fa-', 1, '#', 0, '35', '2020-09-27 13:48:58', '2020-10-14 21:41:56'),
(37, 'Update Capabilities', 'capabilities-edit', 'fa fa-', 1, '#', 0, '35', '2020-09-27 14:05:30', '2020-10-14 21:41:45'),
(38, 'View Capabilities', 'capabilities-view', 'fa fa-', 1, '#', 0, '35', '2020-09-27 14:06:14', '2020-10-14 21:41:38'),
(39, 'Delete Capabilities', 'capabilities-delete', 'fa fa-', 1, '#', 0, '35', '2020-09-27 14:06:14', '2020-10-14 21:41:28'),
(40, 'Quotes', 'quote-index', 'fa fa-folder-open', 1, '/sessions', 9, NULL, '2020-10-14 21:51:05', '2020-10-24 11:55:33'),
(41, 'Add Quote', 'quote-create', 'fa fa-', 1, '#', 0, '40', '2020-10-14 22:11:23', '2020-10-14 22:11:23'),
(42, 'Update Quote', 'quote-edit', 'fa fa-', 0, '#', 0, '40', '2020-10-14 22:22:46', '2020-10-14 22:22:46'),
(43, 'View Quote', 'quote-view', 'fa fa-', 0, '#', 0, '40', '2020-10-14 22:24:22', '2020-10-14 22:24:22'),
(44, 'Quote Send to Customer', 'quote-send-to-customer', 'fa fa-', 0, '#', 0, '40', '2020-10-15 03:57:35', '2020-10-15 03:57:35'),
(45, 'Quote Print Details', 'quote-print-details', 'fa fa-', 0, '#', 0, '40', '2020-10-16 04:18:52', '2020-10-16 04:18:52'),
(46, 'Quote Accept', 'quote-accept', 'fa fa-', 0, '#', 0, '40', '2020-10-17 22:38:10', '2020-10-17 22:38:10'),
(47, 'Quote Revised', 'quote-revised', 'fa fa-', 0, '#', 0, '40', '2020-10-17 22:38:36', '2020-10-17 22:38:36'),
(48, 'Quote Close', 'quote-close', 'fa fa-', 0, '#', 0, '40', '2020-10-17 22:41:41', '2020-10-17 22:41:41'),
(49, 'Items', 'items-index', 'fa fa-tasks', 0, 'items', 10, NULL, '2020-10-17 22:42:19', '2020-10-24 11:55:33'),
(50, 'Create Items', 'items-create', 'fa fa-', 0, '#', 0, '49', '2020-10-17 22:44:04', '2020-10-17 22:44:04'),
(51, 'Update Items', 'items-update', 'fa fa-', 0, '#', 0, '49', '2020-10-17 22:44:21', '2020-10-17 22:44:21'),
(52, 'Delete Items', 'items-delete', 'fa fa-', 0, '#', 0, '49', '2020-10-17 22:45:50', '2020-10-17 22:45:50'),
(53, 'Create Not-Listed', 'items-add-non-listed', 'fa fa-', 0, '#', 0, '49', '2020-10-17 22:46:49', '2020-10-17 22:46:49'),
(54, 'Update Non-Listed', 'items-update-non-listed', 'fa fa-', 0, '#', 0, '49', '2020-10-17 22:47:49', '2020-10-17 22:47:49'),
(55, 'Pending Tech Reviews', 'pending-index', 'fa fa-spinner', 1, 'pendings', 10, NULL, '2020-10-17 22:58:24', '2020-10-24 12:05:45'),
(56, 'Store Pendings', 'pendings-store', 'fa fa-', 0, '#', 0, '55', '2020-10-17 23:22:00', '2020-10-17 23:22:00'),
(57, 'No Facility', 'pendings-no-facility', 'fa fa-', 0, '#', 0, '55', '2020-10-17 23:22:42', '2020-10-17 23:22:42'),
(58, 'All Jobs', 'jobs-index', 'fa fa-tasks', 1, 'jobs', 13, NULL, '2020-10-17 23:59:25', '2020-10-24 12:06:47'),
(59, 'View Jobs', 'jobs-view', 'fa fa-', 0, '#', 0, '58', '2020-10-18 00:14:08', '2020-10-18 00:14:08'),
(60, 'Print Jobform', 'print-jobform', 'fa fa-', 0, '#', 0, '58', '2020-10-18 00:14:52', '2020-10-18 00:14:52'),
(61, 'Awaiting Jobs', 'awaiting-index', 'fa fa-hourglass', 1, 'awaitings', 12, NULL, '2020-10-18 00:17:19', '2020-10-24 12:05:45'),
(62, 'Add Check-in Lab Items', 'checkin-store', 'fa fa-', 0, '#', 0, '61', '2020-10-18 00:37:46', '2020-10-18 00:38:01'),
(63, 'Update Check-in Lab Items', 'checkin-update', 'fa fa-', 0, '#', 0, '61', '2020-10-18 00:38:35', '2020-10-18 00:38:35'),
(64, 'Scheduling Jobs', 'scheduling-index', 'fa fa-calendar-alt', 1, 'scheduling', 14, NULL, '2020-10-18 00:41:17', '2020-10-24 12:06:47'),
(65, 'View Scheduling', 'scheduling-view', 'fa fa-', 0, '#', 0, '64', '2020-10-18 00:58:04', '2020-10-18 00:58:04'),
(66, 'Assign Lab Task (add)', 'create-lab-task-assign', 'fa fa-', 0, '#', 0, '64', '2020-10-18 01:14:40', '2020-10-18 01:14:40'),
(67, 'Assign Lab Task (update)', 'create-lab-task-assign', 'fa fa-', 0, '#', 0, '64', '2020-10-18 01:15:02', '2020-10-18 01:15:02'),
(68, 'My Tasks', 'mytask-index', 'fas fa-clock', 1, 'mytasks', 15, NULL, '2020-10-18 01:23:07', '2020-10-24 12:06:47'),
(69, 'View My Tasks', 'mytask-view', 'fa fa-', 0, '#', 0, '68', '2020-10-18 01:35:45', '2020-10-18 23:32:18'),
(70, 'Start My Task', 'start-mytask', 'fa fa-', 0, '#', 0, '68', '2020-10-18 23:29:47', '2020-10-18 23:32:56'),
(71, 'End My Task', 'end-mytask', 'fa fa-', 0, '#', 0, '68', '2020-10-18 23:30:05', '2020-10-18 23:33:06'),
(72, 'Get Certificate', 'get-certificate', 'fa fa-', 0, '#', 0, '68', '2020-10-18 23:30:36', '2020-10-18 23:30:36'),
(73, 'All Certificates', 'certificates-index', 'fa fa-file-invoice', 1, 'certificates', 16, NULL, '2020-10-20 10:50:55', '2020-10-24 12:06:47'),
(74, 'Print Certificate', 'certificates-print', 'fa fa-', 0, '#', 0, '73', '2020-10-20 23:18:42', '2020-10-20 23:18:42'),
(75, 'Gatepass', 'gatepass-index', 'fa fa-ban', 1, 'gatepass', 17, NULL, '2020-10-20 23:19:33', '2020-10-24 12:06:47'),
(76, 'Manage Jobs', 'manage-jobs-index', 'fa fa-bars', 1, 'jobs/manage', 11, NULL, '2020-10-21 10:31:51', '2020-10-24 12:06:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;
