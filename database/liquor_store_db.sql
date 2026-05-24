-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 07:40 AM
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
-- Database: `liquor_store_db`
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Beer', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(2, 'Gin', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(3, 'Rum', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(4, 'Brandy', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(5, 'Whiskey', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(6, 'Vodka', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(7, 'Wine', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(8, 'Tequila', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(9, 'Liqueur', '2026-05-18 05:04:24', '2026-05-18 05:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Juan Dela Cruz', 'juan@gmail.com', '09123456789', 'Cagayan de Oro City', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(2, 'Maria Clara', 'maria@gmail.com', '09987654321', 'Davao City', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(3, 'Pedro Santos', 'pedro@gmail.com', '09223334444', 'Cebu City', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(4, 'Ana Reyes', 'ana@gmail.com', '09334445555', 'Iligan City', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(5, 'Mark Villanueva', 'mark@gmail.com', '09445556666', 'Butuan City', '2026-05-18 05:04:24', '2026-05-18 05:04:24');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Paid','Cancelled','Delivered') DEFAULT 'Pending',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `status`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-05-10 14:20:00', 'Paid', 560.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(2, 2, '2026-05-11 09:15:00', 'Delivered', 975.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(3, 3, '2026-05-12 18:40:00', 'Pending', 260.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(4, 4, '2026-05-13 12:05:00', 'Paid', 160.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(5, 5, '2026-05-14 20:30:00', 'Cancelled', 0.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 65.00, 130.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(2, 1, 6, 1, 170.00, 170.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(3, 1, 12, 1, 260.00, 260.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(4, 2, 5, 1, 160.00, 160.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(5, 2, 2, 3, 55.00, 165.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(6, 2, 18, 1, 650.00, 650.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(7, 3, 11, 1, 260.00, 260.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(8, 4, 5, 1, 160.00, 160.00, '2026-05-18 05:04:24', '2026-05-18 05:04:24');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `volume_ml` int(11) NOT NULL,
  `alcohol_content` decimal(4,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `brand`, `description`, `volume_ml`, `alcohol_content`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Red Horse Beer', 'San Miguel', 'Strong beer with bold taste.', 500, 6.90, 65.00, 120, 'redhorse.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(2, 1, 'San Miguel Pale Pilsen', 'San Miguel', 'Classic pale lager beer.', 330, 5.00, 55.00, 150, 'smpale.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(3, 1, 'San Miguel Light', 'San Miguel', 'Light beer with smooth taste.', 330, 5.00, 50.00, 130, 'smlight.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(4, 1, 'Corona Extra', 'Corona', 'Premium Mexican lager beer.', 355, 4.50, 95.00, 80, 'corona.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(5, 2, 'Ginebra San Miguel (Gin Bilog)', 'Ginebra San Miguel', 'Popular Philippine gin.', 750, 40.00, 160.00, 100, 'ginbilog.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(6, 2, 'GSM Blue', 'Ginebra San Miguel', 'Smooth gin with mild flavor.', 750, 40.00, 170.00, 90, 'gsmblue.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(7, 2, 'Gordon\'s Gin', 'Gordon\'s', 'Premium distilled London dry gin.', 700, 37.50, 550.00, 50, 'gordons.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(8, 3, 'Tanduay Rhum White', 'Tanduay', 'Smooth white rum.', 750, 40.00, 190.00, 110, 'tanduaywhite.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(9, 3, 'Tanduay Rhum Dark', 'Tanduay', 'Dark rum with rich flavor.', 750, 40.00, 200.00, 100, 'tanduaydark.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(10, 3, 'Bacardi Superior', 'Bacardi', 'Classic white rum.', 750, 40.00, 700.00, 40, 'bacardi.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(11, 4, 'Fundador Brandy', 'Fundador', 'Popular brandy with smooth taste.', 750, 36.00, 260.00, 90, 'fundador.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(12, 4, 'Emperador Light', 'Emperador', 'Light brandy, smooth and mild.', 750, 30.00, 220.00, 100, 'emperadorlight.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(13, 4, 'Emperador Deluxe', 'Emperador', 'Deluxe brandy with strong aroma.', 750, 36.00, 320.00, 80, 'emperadordeluxe.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(14, 5, 'Jack Daniel\'s Old No. 7', 'Jack Daniel\'s', 'Tennessee whiskey.', 700, 40.00, 1500.00, 30, 'jackdaniels.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(15, 5, 'Johnnie Walker Red Label', 'Johnnie Walker', 'Blended Scotch whisky.', 750, 40.00, 1200.00, 35, 'jwred.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(16, 5, 'Chivas Regal 12 Years', 'Chivas Regal', 'Premium Scotch whisky.', 750, 40.00, 1800.00, 25, 'chivas12.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(17, 6, 'Smirnoff Vodka', 'Smirnoff', 'Premium vodka.', 750, 40.00, 650.00, 40, 'smirnoff.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(18, 6, 'Absolut Vodka', 'Absolut', 'Swedish vodka, smooth taste.', 750, 40.00, 900.00, 25, 'absolut.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(19, 7, 'Carlo Rossi Red', 'Carlo Rossi', 'Sweet red wine.', 750, 12.00, 450.00, 30, 'carlorossi.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(20, 7, 'Carlo Rossi White', 'Carlo Rossi', 'Refreshing white wine.', 750, 12.00, 450.00, 25, 'carlorossiwhite.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(21, 7, 'Barefoot Moscato', 'Barefoot', 'Sweet Moscato wine.', 750, 9.00, 600.00, 20, 'barefoot.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(22, 8, 'Jose Cuervo Especial', 'Jose Cuervo', 'Gold tequila with strong flavor.', 750, 40.00, 900.00, 20, 'cuervo.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(23, 9, 'Baileys Irish Cream', 'Baileys', 'Creamy Irish liqueur.', 750, 17.00, 1100.00, 15, 'baileys.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24'),
(24, 9, 'Jagermeister', 'Jagermeister', 'Herbal German liqueur.', 700, 35.00, 1200.00, 15, 'jager.png', '2026-05-18 05:04:24', '2026-05-18 05:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8h3CTMzc92mdwK7S23pAkZVq6RXsL59r8S4ZGpE0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.119.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekZObXl4TmlONFJpbXdvUHd6cmRNTmlLQWRXY2lkZ0hBSFlmUUJQQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779080816),
('nRWrxyF9UPKN5OjbU2wEJqyGKBSSeTj2cquZvbmY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidTd2MlFlUHBrSnlpbnNHR3pTQ1JrMDBZbnA3TWpmdWVBSVRxZWVxeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1779082630);

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
(1, 'Rueland Bantiles', 'rbantiles52@gmail.com', NULL, '$2y$12$vhnAw0T8W1O8fnO8rB12J.K6K6VzKfwvzeswi8sQo4gPJb4o4xoPy', NULL, '2026-05-17 21:19:07', '2026-05-17 21:19:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_customer` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_order` (`order_id`),
  ADD KEY `fk_items_product` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
