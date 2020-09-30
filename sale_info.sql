-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 02:29 PM
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
(1, 'SOI-100001', 1, '140.00', '5.00', '7.00', '7.00', 0, '40.00', '100.00', 0, '2020-09-26', 'admin@argon.com', NULL, '2020-09-26 02:55:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sale_info`
--
ALTER TABLE `sale_info`
  ADD PRIMARY KEY (`sale_info_id`),
  ADD UNIQUE KEY `sale_info_auto_sale_invoice_unique` (`auto_sale_invoice`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sale_info`
--
ALTER TABLE `sale_info`
  MODIFY `sale_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
