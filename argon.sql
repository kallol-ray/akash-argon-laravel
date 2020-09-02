-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 04:52 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `argon`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` bigint(20) NOT NULL,
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
(261, '2014_10_12_000000_create_users_table', 1),
(262, '2014_10_12_100000_create_password_resets_table', 1),
(263, '2019_08_19_000000_create_failed_jobs_table', 1),
(264, '2020_08_16_105820_create_product_info_table', 1),
(265, '2020_08_16_111637_create_product_purchase_history_table', 1),
(266, '2020_08_16_120153_create_sale_info_table', 1),
(267, '2020_08_16_121127_create_sale_item_table', 1),
(268, '2020_08_16_121833_create_inventory_table', 1),
(269, '2020_08_16_122236_create_customer_table', 1),
(270, '2020_08_16_122547_create_supplier_table', 1),
(271, '2020_08_24_175539_create_purchase_order_info_table', 1),
(272, '2020_08_29_183157_create_po_info_item_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `po_info_item`
--

CREATE TABLE `po_info_item` (
  `po_info_item_id` bigint(20) UNSIGNED NOT NULL,
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `auto_invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `unit_adnl_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_entry_date` datetime NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`product_info_id`, `title`, `description`, `model`, `brand`, `info_entry_date`, `image`, `entry_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'TP Link Router R8', 'No Description', '216E0', 'TP-Link', '2020-09-01 18:57:25', 'default@1598295452.jpg', 'admin@argon.com', '', '2020-09-01 12:57:25', NULL),
(2, 'Tenda Router', 'No Description', '454545', 'Tenda', '2020-09-01 18:57:25', 'default@1598295453.jpg', 'admin@argon.com', '', '2020-09-01 12:57:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_history`
--

CREATE TABLE `product_purchase_history` (
  `pp_history_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_info_id` bigint(20) UNSIGNED NOT NULL,
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` tinyint(4) NOT NULL COMMENT '1=defaut and always',
  `buy_price` decimal(8,2) NOT NULL,
  `buy_date` date NOT NULL,
  `is_stored` tinyint(1) NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_info`
--

CREATE TABLE `purchase_order_info` (
  `po_info_id` bigint(20) UNSIGNED NOT NULL,
  `auto_invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_stored` tinyint(1) NOT NULL COMMENT '0=By defaut, 1=else',
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_adnl_cost` decimal(8,2) NOT NULL COMMENT 'adnl=additional',
  `supplier_adnl_cost` decimal(8,2) NOT NULL COMMENT 'adnl=additional',
  `vat_percent` decimal(8,2) NOT NULL,
  `vat_amount` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `paid_or_due` tinyint(4) NOT NULL COMMENT '0=partial payment, 1=due, 2=paid',
  `paid_amount` decimal(8,2) NOT NULL,
  `due_amount` decimal(8,2) NOT NULL,
  `sub_total` decimal(8,2) NOT NULL,
  `grand_total` decimal(8,2) NOT NULL,
  `purchased_date` date NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_info`
--

INSERT INTO `purchase_order_info` (`po_info_id`, `auto_invoice_no`, `is_stored`, `supplier_id`, `purchase_invoice_no`, `buyer_adnl_cost`, `supplier_adnl_cost`, `vat_percent`, `vat_amount`, `discount`, `paid_or_due`, `paid_amount`, `due_amount`, `sub_total`, `grand_total`, `purchased_date`, `entry_by`, `created_at`, `updated_at`) VALUES
(1, 'POI-100001', 0, 1, 'A012451', '50.00', '50.00', '5.00', '100.00', '100.00', 0, '5000.00', '4800.00', '10000.00', '10000.00', '2020-09-01', 'Kallol Ray', '2020-09-01 12:57:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_info`
--

CREATE TABLE `sale_info` (
  `sale_info_id` bigint(20) UNSIGNED NOT NULL,
  `customer` bigint(20) UNSIGNED NOT NULL,
  `total_bill` decimal(8,2) NOT NULL,
  `vat` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `paid_or_due` decimal(8,2) NOT NULL,
  `paid_amount` decimal(8,2) NOT NULL,
  `due_amount` decimal(8,2) NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_delivered` tinyint(1) NOT NULL,
  `saled_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE `sale_item` (
  `sale_item_id` bigint(20) UNSIGNED NOT NULL,
  `sale_info_id` bigint(20) UNSIGNED NOT NULL,
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `Entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_entry_date` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `phone`, `address`, `comments`, `supplier_entry_date`, `entry_by`, `created_at`, `updated_at`) VALUES
(1, 'Tp Link Dealer', '01727379068', '216, East Rampura, Dhaka-1219', 'No comments', '2020-09-01 18:57:25', 'Kallol Ray', '2020-09-01 12:57:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Ray', 'admin@argon.com', '2020-09-01 12:57:25', '$2y$10$BteutiFbKC6Vc6oLt5wYSuKkxzgRJEhsE7Pcn9vT.zJaQKTkCqJre', NULL, '2020-09-01 12:57:25', '2020-09-01 12:57:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD UNIQUE KEY `inventory_barcode_unique` (`barcode`);

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
-- Indexes for table `po_info_item`
--
ALTER TABLE `po_info_item`
  ADD PRIMARY KEY (`po_info_item_id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`product_info_id`);

--
-- Indexes for table `product_purchase_history`
--
ALTER TABLE `product_purchase_history`
  ADD PRIMARY KEY (`pp_history_id`),
  ADD UNIQUE KEY `product_purchase_history_barcode_unique` (`barcode`);

--
-- Indexes for table `purchase_order_info`
--
ALTER TABLE `purchase_order_info`
  ADD PRIMARY KEY (`po_info_id`);

--
-- Indexes for table `sale_info`
--
ALTER TABLE `sale_info`
  ADD PRIMARY KEY (`sale_info_id`);

--
-- Indexes for table `sale_item`
--
ALTER TABLE `sale_item`
  ADD PRIMARY KEY (`sale_item_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `po_info_item`
--
ALTER TABLE `po_info_item`
  MODIFY `po_info_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `product_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_purchase_history`
--
ALTER TABLE `product_purchase_history`
  MODIFY `pp_history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_info`
--
ALTER TABLE `purchase_order_info`
  MODIFY `po_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_info`
--
ALTER TABLE `sale_info`
  MODIFY `sale_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_item`
--
ALTER TABLE `sale_item`
  MODIFY `sale_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;