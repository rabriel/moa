-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2026 at 09:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fgx_moa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Mall of the North Admin', 'mari@mallofthenorth.co.za', '$2y$10$kwHAXSvRMzqzqDvLGg2bBOhMgsM.CZl75XfJeMTZaIJ/2eL13Hhj2', 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55');

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
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2026_07_07_130500_create_players_table', 1),
(4, '2026_07_07_130600_create_stores_table', 1),
(5, '2026_07_07_130700_create_player_store_visits_table', 1),
(6, '2026_07_07_160000_create_admins_table', 1);

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
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_store_visits`
--

CREATE TABLE `player_store_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `visited_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `clue` text NOT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `slug`, `clue`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ackermans', 'ackermans', 'Need a new outfit for your Minion mission? Look for the store where the whole family can dress for less.', 1, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(2, 'Lacoste', 'lacoste', 'A stylish Minion always dresses to impress! Find the store where classic fashion and the famous crocodile make a statement.', 2, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(3, 'Spec-Savers', 'spec-savers', 'A Minion misplaced his banana because he couldn\'t see! Visit the place that helps you spot every clue clearly.', 3, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(4, 'Baby City', 'baby-city', 'Little ones need lots of love and care. Find the store with baby essentials, outfits and treasures to share.', 4, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(5, 'The Fun Company', 'the-fun-company', 'Games, excitement and lots of laughs await! Find the place where fun is the main attraction.', 5, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(6, 'Expedition North', 'expedition-north', 'Every Minion explorer needs adventure gear! Find the store that\'s ready for mountains, trails and the great outdoors.', 6, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(7, 'Coricraft', 'coricraft', 'After a busy banana hunt, a Minion needs a comfy place to relax. Find the store where beautiful furniture makes a house a home.', 7, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(8, 'Legends Barbershop', 'legends-barbershop', 'Even Minions need a fresh haircut! Find the place where great styles become legendary.', 8, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(9, 'Clicks', 'clicks', 'Need toothpaste, shampoo or a quick health fix? Find the store that has a little bit of everything.', 9, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(10, 'Lovisa', 'lovisa', 'Sparkles catch a Minion\'s eye! Find the store filled with dazzling jewellery and accessories.', 10, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(11, 'Destinations by Frasers', 'destinations-by-frasers', 'A Minion adventure awaits! Find the store where suitcases, travel bags and journey essentials help explorers pack for their next mission.', 11, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(12, 'Freedom of Movement', 'freedom-of-movement', 'For this stop, find the place where style takes the lead. From leather treasures to branded looks, they have everything you need to move freely and confidently.', 12, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(13, 'Sorbet', 'sorbet', 'It\'s time to relax and glow! Find the place where beauty treatments and pampering help you shine from head to toe.', 13, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(14, 'Old School', 'old-school', 'A true supporter needs the right gear! Find the store where fans can show their colours and wear their team pride.', 14, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(15, 'Le Creuset', 'le-creuset', 'Even Minions need to cook up something delicious! Find the store where kitchen treasures and colourful cookware bring recipes to life.', 15, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(16, 'PNA', 'pna', 'Need something to write, create or learn? Find the place where stationery, gifts and school essentials take their turn!', 16, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(17, 'Crocs', 'crocs', 'Minions love to stand out! Find the store where colourful, comfy and funky footwear brings fun to every step.', 17, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(18, 'Cell C', 'cell-c', 'Minions love to stay connected! Find the store where you can call, chat and share your banana discoveries.', 18, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(19, 'Totalsports', 'totalsports', 'Ready, set, GO! Find the store where athletes and sports fans gear up for action.', 19, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55'),
(20, 'Spur', 'spur', 'Follow the smell of burgers and family fun! A hungry Minion knows exactly where to go.', 20, 1, '2026-07-10 05:16:55', '2026-07-10 05:16:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_is_active_index` (`is_active`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `players_email_unique` (`email`),
  ADD UNIQUE KEY `players_cell_phone_unique` (`cell_phone`),
  ADD KEY `players_session_token_index` (`session_token`);

--
-- Indexes for table `player_store_visits`
--
ALTER TABLE `player_store_visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `player_store_visits_player_id_store_id_unique` (`player_id`,`store_id`),
  ADD KEY `player_store_visits_store_id_foreign` (`store_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_slug_unique` (`slug`),
  ADD KEY `stores_sort_order_index` (`sort_order`),
  ADD KEY `stores_is_active_index` (`is_active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_store_visits`
--
ALTER TABLE `player_store_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `player_store_visits`
--
ALTER TABLE `player_store_visits`
  ADD CONSTRAINT `player_store_visits_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_store_visits_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
