INSERT INTO `adminmenus` (`id`, `menutitle`, `slug`, `parentid`, `showinnav`, `setasdefault`, `iconclass`, `urllink`, `displayorder`, `mselect`, `status`, `created_at`, `updated_at`) VALUES
(633, 'Suggestions Box', 'suggestion-index', NULL, 1, NULL, 'fa fa-question-circle', '/', 0, NULL, 1, '2020-10-27 07:00:00', '2020-10-27 07:00:00'),
(634, 'My Suggestions', 'my-suggestions-index', 633, 1, NULL, NULL, '/my-suggestions', 0, NULL, 1, '2020-10-27 07:00:00', '2020-10-27 07:00:00'),
(635, 'Create MySuggestion', 'create-my-suggestions', 633, NULL, NULL, NULL, '#', 0, NULL, 1, '2020-10-27 07:00:00', '2020-10-27 07:00:00'),
(636, 'Edit MySuggestion', 'edit-my-suggestions', 633, NULL, NULL, NULL, '#', 0, NULL, 1, '2020-10-27 07:00:00', '2020-10-27 07:00:00'),
(637, 'Delete MySuggestions', 'delete-my-suggestions', 633, NULL, NULL, NULL, '#', 0, NULL, 1, '2020-10-27 07:00:00', '2020-10-27 07:00:00'),
(638, 'All Suggestions', 'all-suggestions-index', 633, 1, NULL, NULL, 'all-suggestions', 0, NULL, 1, '2020-10-28 07:00:00', '2020-10-28 07:00:00'),
(639, 'Show My Suggestion', 'show-my-suggestions', 633, NULL, NULL, NULL, '#', 0, NULL, 1, '2020-10-28 07:00:00', '2020-10-28 07:00:00'),
(640, 'Show all suggestions', 'show-all-suggestions', 633, NULL, NULL, NULL, '#', 0, NULL, 1, '2020-10-28 07:00:00', '2020-10-28 07:00:00'),
(641, 'Show All messages in Navigation Message to Owner', 'show-all-message-to-owner', NULL, NULL, NULL, NULL, '#', 0, NULL, 1, '2020-10-28 07:00:00', '2020-10-28 07:00:00');




-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2020 at 08:59 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `suggestionboxcomments`
--

CREATE TABLE `suggestionboxcomments` (
  `id` int(11) NOT NULL,
  `suggestion_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suggestionsbox`
--

CREATE TABLE `suggestionsbox` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suggestions_comments_assets`
--

CREATE TABLE `suggestions_comments_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `comments_id` int(11) DEFAULT NULL,
  `files` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suggestionboxcomments`
--
ALTER TABLE `suggestionboxcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestionsbox`
--
ALTER TABLE `suggestionsbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestions_comments_assets`
--
ALTER TABLE `suggestions_comments_assets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suggestionboxcomments`
--
ALTER TABLE `suggestionboxcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggestionsbox`
--
ALTER TABLE `suggestionsbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggestions_comments_assets`
--
ALTER TABLE `suggestions_comments_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





CREATE TABLE `message_to_owner` (
  `id` int(11) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message_to_owner`
--
ALTER TABLE `message_to_owner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message_to_owner`
--
ALTER TABLE `message_to_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



INSERT INTO `preferences` (`id`, `option`, `description`, `value`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(43, 'sendmessagestomrimranzaibowner', 'Send message to owner and others will be in this with comma separated ID\'s', '1', 1, 1, '2020-10-29 01:27:36', '2020-10-29 01:27:36');
