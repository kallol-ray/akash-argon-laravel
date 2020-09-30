-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 08:49 PM
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
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `entry_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'Tp-Link', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(2, 'Tenda', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(3, 'D-Link', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(4, 'Mikrotik', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(5, 'Xiaomi', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(6, 'Netgear', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(7, 'Huawei', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(8, 'Asus', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(9, 'Linksys', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(10, 'Belkin', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(11, 'Cisco', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL),
(12, 'TRENDnet', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `company_name`, `phone`, `address`, `entry_by`, `created_at`, `updated_at`) VALUES
(1, 'Ami Kallol', 'Kallol Corporation', '01727379068', '216, Rampura, Dhaka-1219', 'admin@argon.com', '2020-09-30 10:37:45', NULL);

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
  `qty` bigint(20) NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `product_info_id`, `barcode`, `qty`, `entry_by`, `created_at`, `updated_at`) VALUES
(1, 1, '8941193073216', 0, 'admin@argon.com', '2020-09-30 10:45:53', NULL),
(2, 2, '8941100294840', 0, 'admin@argon.com', '2020-09-30 10:45:59', NULL),
(3, 1, '89411002948401', 1, 'admin@argon.com', '2020-09-30 11:32:12', NULL),
(4, 1, '89411930732162', 1, 'admin@argon.com', '2020-09-30 11:37:01', NULL);

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
(196, '2014_10_12_000000_create_users_table', 1),
(197, '2014_10_12_100000_create_password_resets_table', 1),
(198, '2019_08_19_000000_create_failed_jobs_table', 1),
(199, '2020_08_16_105820_create_product_info_table', 1),
(200, '2020_08_16_111637_create_product_purchase_history_table', 1),
(201, '2020_08_16_120153_create_sale_info_table', 1),
(202, '2020_08_16_121127_create_sale_item_table', 1),
(203, '2020_08_16_121833_create_inventory_table', 1),
(204, '2020_08_16_122236_create_customer_table', 1),
(205, '2020_08_16_122547_create_supplier_table', 1),
(206, '2020_08_24_175539_create_purchase_order_info_table', 1),
(207, '2020_08_29_183157_create_po_info_item_table', 1),
(208, '2020_09_10_052655_create_brand_table', 1);

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
  `po_info_id` bigint(20) UNSIGNED NOT NULL,
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

--
-- Dumping data for table `po_info_item`
--

INSERT INTO `po_info_item` (`po_info_item_id`, `po_info_id`, `product_info_id`, `auto_invoice_no`, `image`, `product_qty`, `unit_price`, `unit_adnl_price`, `sale_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'POI-10001', 'default@1598295452.jpg', 50, '20.00', '32.50', '40.00', '1000.00', '2020-09-30 10:43:46', NULL),
(2, 1, 2, 'POI-10001', 'default@1598295453.jpg', 30, '30.00', '42.50', '50.00', '900.00', '2020-09-30 10:43:46', NULL);

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
(1, 'TP Link Router R8', 'No Description', '216E0', 'Tp-Link', '2020-09-30 00:00:00', 'default@1598295452.jpg', 'admin@argon.com', 'admin@argon.com', '2020-09-30 10:37:44', '2020-09-30 10:41:00'),
(2, 'Tenda Router', 'No Description', '454545', 'Tenda', '2020-09-30 16:37:45', 'default@1598295453.jpg', 'admin@argon.com', '', '2020-09-30 10:37:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_history`
--

CREATE TABLE `product_purchase_history` (
  `pp_history_id` bigint(20) UNSIGNED NOT NULL,
  `po_info_id` bigint(20) UNSIGNED NOT NULL,
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `auto_invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` tinyint(4) NOT NULL COMMENT '1=defaut and always',
  `buy_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `buy_date` date NOT NULL,
  `is_stored` tinyint(1) NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_purchase_history`
--

INSERT INTO `product_purchase_history` (`pp_history_id`, `po_info_id`, `product_info_id`, `auto_invoice_no`, `barcode`, `quantity`, `buy_price`, `sale_price`, `buy_date`, `is_stored`, `entry_by`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'POI-10001', '8941193073216', 1, '20.00', '40.00', '2020-09-30', 0, 'admin@argon.com', 'N/A', '2020-09-30 10:45:53', NULL),
(2, 1, 2, 'POI-10001', '8941100294840', 1, '30.00', '50.00', '2020-09-30', 0, 'admin@argon.com', 'N/A', '2020-09-30 10:45:59', NULL),
(3, 1, 1, 'POI-10001', '89411002948401', 1, '20.00', '40.00', '2020-09-30', 0, 'admin@argon.com', 'N/A', '2020-09-30 11:32:12', NULL),
(4, 1, 1, 'POI-10001', '89411930732162', 1, '20.00', '40.00', '2020-09-30', 0, 'admin@argon.com', 'N/A', '2020-09-30 11:37:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_info`
--

CREATE TABLE `purchase_order_info` (
  `po_info_id` bigint(20) UNSIGNED NOT NULL,
  `auto_invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_stored` tinyint(1) NOT NULL COMMENT '0=By defaut, 1=else',
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_adnl_cost` decimal(8,2) NOT NULL COMMENT 'adnl=additional',
  `supplier_adnl_cost` decimal(8,2) NOT NULL COMMENT 'adnl=additional',
  `vat_percent` decimal(8,2) NOT NULL,
  `vat_amount` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `paid_or_due` tinyint(4) NOT NULL COMMENT '0=partial payment, 1=due, 2=paid',
  `paid_amount` decimal(8,2) NOT NULL,
  `due_amount` decimal(8,2) NOT NULL,
  `sub_total` decimal(8,2) NOT NULL,
  `grand_total` decimal(8,2) NOT NULL,
  `purchased_date` date NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_info`
--

INSERT INTO `purchase_order_info` (`po_info_id`, `auto_invoice_no`, `is_stored`, `supplier_id`, `purchase_invoice_no`, `buyer_adnl_cost`, `supplier_adnl_cost`, `vat_percent`, `vat_amount`, `discount`, `paid_or_due`, `paid_amount`, `due_amount`, `sub_total`, `grand_total`, `purchased_date`, `entry_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'POI-10001', 1, 1, 'N/A', '500.00', '500.00', '5.00', '95.00', '0.00', 0, '995.00', '2000.00', '1900.00', '2995.00', '2020-09-30', 'admin@argon.com', NULL, '2020-09-30 10:43:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_info`
--

CREATE TABLE `sale_info` (
  `sale_info_id` bigint(20) UNSIGNED NOT NULL,
  `auto_sale_invoice` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `sub_total_bill` decimal(8,2) NOT NULL,
  `vat_percent` decimal(8,2) NOT NULL,
  `vat_amount` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `paid_or_due` tinyint(4) NOT NULL COMMENT '0=Partial payment, 1=Full due, 2=Full paid',
  `paid_amount` decimal(8,2) NOT NULL,
  `due_amount` decimal(8,2) NOT NULL,
  `is_delivered` tinyint(1) NOT NULL,
  `saled_date` date NOT NULL,
  `entry_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_info`
--

INSERT INTO `sale_info` (`sale_info_id`, `auto_sale_invoice`, `customer_id`, `sub_total_bill`, `vat_percent`, `vat_amount`, `discount`, `paid_or_due`, `paid_amount`, `due_amount`, `is_delivered`, `saled_date`, `entry_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'SOI-100001', 1, '90.00', '5.00', '4.50', '4.50', 0, '50.00', '40.00', 0, '2020-09-30', 'admin@argon.com', NULL, '2020-09-30 12:37:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE `sale_item` (
  `sale_item_id` bigint(20) UNSIGNED NOT NULL,
  `sale_info_id` bigint(20) UNSIGNED NOT NULL,
  `product_info_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`sale_item_id`, `sale_info_id`, `product_info_id`, `inventory_id`, `barcode`, `sale_price`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '8941193073216', '40.00', 1, '2020-09-30 12:37:48', NULL),
(2, 1, 2, 2, '8941100294840', '50.00', 1, '2020-09-30 12:37:48', NULL);

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
(1, 'Tp Link Dealer', '01727379068', '216, East Rampura, Dhaka-1219', 'No comments', '2020-09-30 16:37:44', 'Kallol Ray', '2020-09-30 10:37:44', NULL);

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
(1, 'Admin Ray', 'admin@argon.com', '2020-09-30 10:37:44', '$2y$10$muW47gFXIJNKfinirRFbmeztVWM2hdSfS0APcLCXFM7ieGufAw5KG', NULL, '2020-09-30 10:37:44', '2020-09-30 10:37:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_brand_name_unique` (`brand_name`);

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
  ADD PRIMARY KEY (`po_info_id`),
  ADD UNIQUE KEY `purchase_order_info_auto_invoice_no_unique` (`auto_invoice_no`);

--
-- Indexes for table `sale_info`
--
ALTER TABLE `sale_info`
  ADD PRIMARY KEY (`sale_info_id`),
  ADD UNIQUE KEY `sale_info_auto_sale_invoice_unique` (`auto_sale_invoice`);

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
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `po_info_item`
--
ALTER TABLE `po_info_item`
  MODIFY `po_info_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `product_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_purchase_history`
--
ALTER TABLE `product_purchase_history`
  MODIFY `pp_history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_order_info`
--
ALTER TABLE `purchase_order_info`
  MODIFY `po_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_info`
--
ALTER TABLE `sale_info`
  MODIFY `sale_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_item`
--
ALTER TABLE `sale_item`
  MODIFY `sale_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
