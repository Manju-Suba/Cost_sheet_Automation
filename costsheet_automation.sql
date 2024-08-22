-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 02:26 PM
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
-- Database: `costsheet_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `basics`
--

CREATE TABLE `basics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` varchar(250) NOT NULL,
  `plant` varchar(100) DEFAULT NULL,
  `Product_name` varchar(255) DEFAULT NULL,
  `Volume` float DEFAULT NULL,
  `b_volume_approval` int(11) DEFAULT 0,
  `uom` varchar(255) DEFAULT NULL,
  `case_configuration` float DEFAULT NULL,
  `b_case_approval` int(11) DEFAULT 0,
  `quantity` varchar(500) DEFAULT NULL,
  `b_quantity_approval` int(11) NOT NULL DEFAULT 0,
  `mrp_price` float DEFAULT NULL,
  `b_mrp_price_approval` int(11) NOT NULL DEFAULT 0,
  `b_retailer_margin_approval` int(11) NOT NULL DEFAULT 0,
  `b_primary_scheme_approval` int(11) NOT NULL DEFAULT 0,
  `b_rs_margin_approval` int(11) NOT NULL DEFAULT 0,
  `b_ss_margin_approval` int(11) NOT NULL DEFAULT 0,
  `distribution_value` varchar(255) NOT NULL,
  `specific_gravity` varchar(100) DEFAULT NULL,
  `total_rm_cost` varchar(100) DEFAULT NULL,
  `p_total_rm_cost_approval` int(11) NOT NULL DEFAULT 0,
  `fg_scrap` varchar(100) DEFAULT NULL,
  `fg_scrap_approval` tinyint(4) NOT NULL DEFAULT 0,
  `fg_scrap_user` int(11) DEFAULT NULL,
  `conv_cost` varchar(100) DEFAULT NULL,
  `b_conv_cost_approval` int(11) NOT NULL DEFAULT 0,
  `conv_uom` varchar(100) DEFAULT NULL,
  `convo_user` int(11) DEFAULT NULL,
  `convo_date` timestamp NULL DEFAULT NULL,
  `breakup_excel` varchar(255) DEFAULT NULL,
  `salesTax` varchar(100) DEFAULT NULL,
  `tax_user` int(11) DEFAULT NULL,
  `b_salesTax_approval` int(11) NOT NULL DEFAULT 0,
  `hsnCode` varchar(100) DEFAULT NULL,
  `damage` varchar(100) DEFAULT NULL,
  `b_damage_approval` int(11) NOT NULL DEFAULT 0,
  `logistic` varchar(100) DEFAULT NULL,
  `logistic_user` int(11) DEFAULT NULL,
  `b_logistic_approval` int(11) NOT NULL DEFAULT 0,
  `mt_csheet_approval` varchar(50) NOT NULL,
  `csheet_approval` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `product_status` varchar(100) DEFAULT NULL,
  `version` varchar(50) NOT NULL,
  `marketuser` int(11) DEFAULT NULL,
  `tax_date` timestamp NULL DEFAULT NULL,
  `logistic_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basics`
--

INSERT INTO `basics` (`id`, `pro_id`, `plant`, `Product_name`, `Volume`, `b_volume_approval`, `uom`, `case_configuration`, `b_case_approval`, `quantity`, `b_quantity_approval`, `mrp_price`, `b_mrp_price_approval`, `b_retailer_margin_approval`, `b_primary_scheme_approval`, `b_rs_margin_approval`, `b_ss_margin_approval`, `distribution_value`, `specific_gravity`, `total_rm_cost`, `p_total_rm_cost_approval`, `fg_scrap`, `fg_scrap_approval`, `fg_scrap_user`, `conv_cost`, `b_conv_cost_approval`, `conv_uom`, `convo_user`, `convo_date`, `breakup_excel`, `salesTax`, `tax_user`, `b_salesTax_approval`, `hsnCode`, `damage`, `b_damage_approval`, `logistic`, `logistic_user`, `b_logistic_approval`, `mt_csheet_approval`, `csheet_approval`, `created_at`, `updated_at`, `status`, `product_status`, `version`, `marketuser`, `tax_date`, `logistic_date`) VALUES
(1, 'PR000000001', '1', 'Cavin Milkshake', 23, 1, 'ml', 12, 1, '200', 0, 1155, 1, 1, 1, 1, 1, '2', '0.25', '7625', 0, NULL, 0, NULL, '1.2', 1, 'ml', 28, '2023-12-16 04:21:32', '12162023095132657d7324edf0aRodTep_Bug_Report.xlsx', '18', 29, 1, NULL, '0.2', 1, '1.3', 30, 1, 'Rejected', 'Approved', '2023-12-16 09:37:05', '2023-12-16 04:35:17', '3', '1', 'V1.0', 1, '2023-12-16 04:27:05', '2023-12-16 04:30:15'),
(2, 'PR000000002', '1', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 24, 0, 'ml', 24, 0, NULL, 0, 500, 0, 0, 0, 0, 0, '3', '0.97', '0', 0, NULL, 0, NULL, '13.2', 1, 'sheets', 28, '2023-12-19 06:03:51', '1219202311335165817f9f35d47rmrate_sample.xlsx', '18', 29, 0, NULL, '0.11', 0, '2.07', 30, 0, 'Pending', 'Pending', '2023-12-19 11:24:51', '2023-12-20 01:49:45', '3', '1', 'V1.0', 1, '2023-12-19 06:06:37', '2023-12-20 01:06:14'),
(3, 'PR000000003', NULL, 'BUDS&BERRIE MCDM&VNILA BDLOTION 240ML12P', 240, 0, 'ml', 12, 0, '0', 0, 400, 0, 0, 0, 0, 0, '3', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 'Pending', 'Pending', '2023-12-20 05:22:28', '2023-12-20 05:22:28', '0', '0', 'V1.0', 19, NULL, NULL),
(4, 'PR000000004', NULL, 'BUDS&BERRIE MCDM&VNILA BDLOTION 240ML12P', 240, 0, 'ml', 12, 0, NULL, 0, 240, 0, 0, 0, 0, 0, '3', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 'Pending', 'Pending', '2023-12-20 05:25:13', '2023-12-20 05:25:13', '0', '0', 'V1.0', 19, NULL, NULL),
(5, 'PR000000005', NULL, 'Fairever 9gm 480 Pcs', 9, 0, 'g', 480, 0, NULL, 0, 10, 0, 0, 0, 0, 0, '5', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 'Pending', 'Pending', '2023-12-20 05:25:50', '2023-12-20 05:25:50', '0', '0', 'V1.0', 1, NULL, NULL),
(6, 'PR000000006', '1', 'Meera Coconut Oil - Pure', 80, 1, 'ml', 12, 1, '240', 0, 3000, 1, 1, 1, 1, 1, '5', '0.65', '8.71', 0, NULL, 0, NULL, '12', 1, 'Case', 28, '2024-01-04 04:59:21', '0104202410292165968881b0a80sales_20231222T090503353Z.xlsx', '18', 29, 1, NULL, '2.1', 1, '1.5', 30, 1, 'Pending', 'Approved', '2024-01-04 09:46:28', '2024-01-05 23:40:22', '3', '1', 'V1.0', 2, '2024-01-04 04:57:55', '2024-01-04 04:58:20'),
(7, 'PR000000007', NULL, '4/1/2024', 1230, 0, 'g', 12, 0, '4500', 0, 1200, 0, 0, 0, 0, 0, '5', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 'Pending', 'Pending', '2024-01-04 09:47:23', '2024-01-04 09:47:23', '0', '0', 'V1.0', 1, NULL, NULL),
(8, 'PR000000008', '1', 'Test NEw 04-1', 50, 1, 'g', 12, 1, '500', 0, 1200, 1, 1, 1, 1, 1, '2', '1.96', '0', 0, NULL, 0, NULL, '5', 1, 'Case', 28, '2024-01-04 04:44:25', '010420241014256596850162d6cSample_TR.xlsx', '18', 29, 1, NULL, '0.2', 1, '0.1', 30, 1, 'Pending', 'Approved', '2024-01-04 10:10:53', '2024-01-04 05:59:43', '3', '1', 'V1.0', 1, '2024-01-04 04:56:21', '2024-01-04 05:00:05'),
(9, 'PR000000009', '1', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 300, 0, 'Case', 24, 0, NULL, 0, 500, 0, 0, 0, 0, 0, '3', '0.97', '10.31', 0, NULL, 0, NULL, '13.2', 0, 'Case', 28, '2024-01-24 00:04:03', '', '18', 29, 0, NULL, '0.11', 0, '2.07', 30, 0, 'Pending', 'Pending', '2024-01-22 04:20:29', '2024-01-24 00:04:03', '3', '1', 'V1.0', 1, '2024-01-23 23:33:58', '2024-01-23 23:36:34'),
(10, 'PR000000010', NULL, 'CHIK EASY 18ML 280PC', 18, 0, 'ml', 280, 0, NULL, 0, 10, 0, 0, 0, 0, 0, '5', '1.025', NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 'Pending', 'Pending', '2024-01-24 09:49:37', '2024-01-24 04:33:38', '2', '0', 'V1.0', 1, NULL, NULL),
(11, 'PR000000011', NULL, 'Testing CAVIN\'S MILKSHAKE VAN 1000ML 12P MRP.240', 1000, 0, 'Case', 12, 0, '0', 0, 240, 0, 0, 0, 0, 0, '5', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, '12', 29, 0, NULL, NULL, 0, NULL, NULL, 0, 'Pending', 'Pending', '2024-01-24 09:59:26', '2024-01-24 04:35:19', '0', '0', 'V1.0', 1, '2024-01-24 04:35:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `basics_histories`
--

CREATE TABLE `basics_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `basics_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basics_histories`
--

INSERT INTO `basics_histories` (`id`, `basics_id`, `product_id`, `description`, `value`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '1', 'PR000000001', 'Volume', '240', 'fv=23', '2023-12-16 04:31:42', '2023-12-16 04:31:42'),
(2, '9', 'PR000000009', 'conv_cost', '316.8', 'cc', '2024-01-24 00:02:46', '2024-01-24 00:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `dist_channels`
--

CREATE TABLE `dist_channels` (
  `id` int(11) NOT NULL,
  `dist_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dist_channels`
--

INSERT INTO `dist_channels` (`id`, `dist_name`, `created_at`, `updated_at`) VALUES
(2, 'MT', NULL, NULL),
(3, 'Ecom', NULL, NULL),
(4, 'IS', NULL, NULL),
(5, 'GT', '2023-09-04 02:13:54', '2023-09-04 02:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division`, `description`, `created_at`, `updated_at`) VALUES
(1, 'dfdfcn', 'dd', '2024-04-26 02:14:14', '2024-04-26 04:23:59'),
(2, 'ccc', 'sd', '2024-04-26 03:52:07', '2024-04-26 03:52:07'),
(3, 'sdsd', 'sdsd', '2024-04-26 04:20:32', '2024-04-26 04:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `epd_cost_updaion_histories`
--

CREATE TABLE `epd_cost_updaion_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epd_id` varchar(20) NOT NULL,
  `cost_type` varchar(25) NOT NULL,
  `previous_cost` varchar(25) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `epd_pm_cost_details`
--

CREATE TABLE `epd_pm_cost_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epro_id` varchar(50) NOT NULL,
  `plant` varchar(50) NOT NULL,
  `in_mat_desc` varchar(250) NOT NULL,
  `fin_mat_desc` varchar(250) NOT NULL,
  `bom_qty` varchar(50) NOT NULL,
  `meeht` varchar(25) NOT NULL,
  `rate` varchar(25) NOT NULL,
  `cost` varchar(25) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epd_pm_cost_details`
--

INSERT INTO `epd_pm_cost_details` (`id`, `epro_id`, `plant`, `in_mat_desc`, `fin_mat_desc`, `bom_qty`, `meeht`, `rate`, `cost`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2', 'PYM2', 'OVER CAP PETTIRATI AIR FRESHNER 250ML', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '24.12', 'ST', '4.06', '97.93', '3', '2024-05-14 06:53:56', '2024-05-14 06:53:56'),
(2, '2', 'PYM2', 'PREFORM BUNDLING SLEEVE SUR BACTOV 250ML', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '24.24', 'ST', '4.05', '98.17', '3', '2024-05-14 06:53:56', '2024-05-14 06:53:56'),
(3, '2', 'PYM2', 'PUMP BACTOV SURFACE DISINFECTANT 250ML', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '24.12', 'ST', '3.64', '87.8', '3', '2024-05-14 06:53:56', '2024-05-14 06:53:56'),
(4, '2', 'PYM2', 'BOPP TAPE - 48MM - CKPL PRINTED', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '0.017', 'ST', '34.94', '12.00', '3', '2024-05-14 06:53:56', '2024-05-15 01:36:34'),
(5, '2', 'PYM2', 'CFC PETTIRATI AIR FRESHNER 250MLX24PC', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '1.005', 'ST', '22.9', '23.01', '3', '2024-05-14 06:53:56', '2024-05-14 06:53:56'),
(6, '2', 'PYM2', 'CAN PETTIRATI AIR FRESHNER 250ML', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '24.24', 'ST', '22.01', '533.52', '3', '2024-05-14 06:53:56', '2024-05-14 06:53:56'),
(7, '2', 'PYM2', 'SHRNK SLVE FLORL PETTIRATI AIRFRSH 250ML', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '24.24', 'ST', '54.51', '1321.32', '3', '2024-05-14 06:53:56', '2024-05-14 06:53:56'),
(14, '9', 'TNC6', 'SPRAYPAINT BOTTLE BUD&BURIES WHITE 300M', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '12.06', 'ST', '9.77', '117.83', '3', '2024-05-15 04:27:12', '2024-05-15 04:27:12'),
(15, '9', 'TNC6', 'PUMP W CLIP BLK BUDS&BURRIES 300ML', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '12.06', 'ST', '9.66', '116.5', '3', '2024-05-15 04:27:12', '2024-05-15 04:27:12'),
(16, '9', 'TNC6', 'LAB B & B GINGER VETIVER SHAMPOO 300ML', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '12.06', 'ST', '9.51', '114.69', '3', '2024-05-15 04:27:12', '2024-05-15 04:27:12'),
(17, '9', 'TNC6', 'CFC BUDS&BURRIES SHAMPOO 300MLX12PC', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '1', 'ST', '38.97', '38.97', '3', '2024-05-15 04:27:12', '2024-05-15 04:27:12'),
(18, '9', 'TNC6', 'BOPP TAPE - 48MM - CKPL - PRINTED', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '0.014', 'ST', '29', '2.41', '3', '2024-05-15 04:27:12', '2024-05-15 04:28:26'),
(19, '9', 'TNC6', 'STICKER FOR QR CODE 100MM*40MM', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '1.002', 'ST', '0.19', '1.19', '3', '2024-05-15 04:27:12', '2024-05-15 04:28:26'),
(20, '9', 'TNC6', 'RIBBON FOR QR CODE 105mmW*300M L N', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '', 'ROL', '406.36', '2.0', '3', '2024-05-15 04:27:12', '2024-05-15 04:28:26'),
(21, '9', 'TNC6', 'CRYOVAC SHRINK FILM 14 INCH ROLL', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '1.825', 'M', '3.84', '7.01', '3', '2024-05-15 04:27:12', '2024-05-15 04:27:12'),
(22, '10', 'TNC6', 'JAR RAGA PROF DETAN CREAM 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '12.06', 'ST', '12.48', '150.51', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(23, '10', 'TNC6', 'CAP RAGA PROF DETAN CREAM 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '12.06', 'ST', '9.13', '110.11', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(24, '10', 'TNC6', 'WAD RAAGA HAIRSPA CREME BATH 750ML/DETAN', 'RAAGA DE TAN CREME 500GM 12PCS', '12.06', 'ST', '1.72', '20.74', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(25, '10', 'TNC6', 'FR LABELSAMEONBACKPANNELRAGAPRODETAN500G', 'RAAGA DE TAN CREME 500GM 12PCS', '24.12', 'ST', '1.35', '32.56', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(26, '10', 'TNC6', 'SIDE LABEL 1 RAGA PROF DETAN CREAM 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '12.06', 'ST', '0.65', '7.84', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(27, '10', 'TNC6', 'SIDE LABEL 2 RAGA PROF DETAN CREAM 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '12.06', 'ST', '0.65', '7.84', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(28, '10', 'TNC6', 'CFC RAGA PROF DETAN 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '1', 'ST', '29.5', '29.5', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(29, '10', 'TNC6', 'HSPFOR RAGA PROF DETAN 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '3', 'ST', '3.02', '9.06', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(30, '10', 'TNC6', 'HONEYCOMB PARTITION RAGA PROF DETAN 500G', 'RAAGA DE TAN CREME 500GM 12PCS', '2', 'ST', '4.91', '9.82', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(31, '10', 'TNC6', 'BOPP TAPE - 48MM - CKPL - PRINTED', 'RAAGA DE TAN CREME 500GM 12PCS', '0.02', 'ST', '29', '0.58', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(32, '10', 'TNC6', 'STICKER FOR QR CODE 100MM*40MM', 'RAAGA DE TAN CREME 500GM 12PCS', '1.002', 'ST', '0.19', '0.19', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53'),
(33, '10', 'TNC6', 'RIBBON FOR QR CODE 105mmW*300M L N', 'RAAGA DE TAN CREME 500GM 12PCS', '', 'ROL', '406.36', '0.06', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `epd_primary_locations`
--

CREATE TABLE `epd_primary_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` varchar(255) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `retailer_margin` varchar(255) NOT NULL,
  `retail_margin_approval` varchar(20) DEFAULT NULL,
  `primary_scheme` varchar(255) NOT NULL,
  `prim_scheme_approval` varchar(20) DEFAULT NULL,
  `rs_margin` varchar(255) NOT NULL,
  `rsm_approval` varchar(20) DEFAULT NULL,
  `ss_margin` varchar(255) NOT NULL,
  `ssmargin_approval` varchar(20) DEFAULT NULL,
  `freight` varchar(255) NOT NULL,
  `p_cost_approval` varchar(5) DEFAULT NULL,
  `freightuser` varchar(255) DEFAULT NULL,
  `freightdate` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epd_primary_locations`
--

INSERT INTO `epd_primary_locations` (`id`, `pro_id`, `from_location`, `to_location`, `retailer_margin`, `retail_margin_approval`, `primary_scheme`, `prim_scheme_approval`, `rs_margin`, `rsm_approval`, `ss_margin`, `ssmargin_approval`, `freight`, `p_cost_approval`, `freightuser`, `freightdate`, `created_at`, `updated_at`) VALUES
(1, 'EP000000001', '3', '22', '0.4', NULL, '1.2', NULL, '1.6', NULL, '0.3', NULL, '0.3', '0', '24', '2023-12-16 04:47:22', '2023-12-16 04:46:08', '2023-12-16 04:47:22'),
(2, 'EP000000001', '3', '25', '0.8', NULL, '6.7', NULL, '0.7', NULL, '1.4', NULL, '1.4', '0', '24', '2023-12-16 04:47:22', '2023-12-16 04:46:08', '2023-12-16 04:47:22'),
(3, 'EP000000002', '10', '34', '30', NULL, '0', NULL, '0', NULL, '0', NULL, '50', '0', '24', '2024-01-24 03:53:43', '2024-01-24 03:38:48', '2024-01-24 03:53:43'),
(4, 'EP000000003', '20', '22', '12', NULL, '0', NULL, '6', NULL, '0', NULL, '29.13', '1', '24', '2024-01-24 03:51:56', '2024-01-24 03:44:58', '2024-01-24 06:05:58'),
(5, 'EP000000004', '8', '22', '10', '1', '3', '1', '6', '1', '0', '1', '2.5', '1', '24', '2024-01-24 06:23:38', '2024-01-24 06:19:19', '2024-05-07 06:23:25'),
(6, 'EP000000005', '16', '33', '0.5', NULL, '2.6', NULL, '7.1', NULL, '1.5', NULL, '', NULL, NULL, NULL, '2024-05-09 03:53:53', '2024-05-09 03:53:53'),
(7, 'EP000000006', '16', '33', '0.5', NULL, '2.6', NULL, '7.1', NULL, '1.5', NULL, '23', '0', '8', '2024-05-09 04:54:07', '2024-05-09 03:54:26', '2024-05-09 04:54:07'),
(8, 'EP000000007', '16', '36', '0.2', '1', '2.5', '1', '4.0', '1', '0.5', '1', '13.6', '1', '8', '2024-05-09 23:14:05', '2024-05-09 22:58:46', '2024-05-09 23:56:31'),
(9, 'EP000000007', '6', '30', '0.2', '1', '2.4', '1', '7.1', '1', '0.6', '1', '24.1', '1', '8', '2024-05-09 23:14:05', '2024-05-09 22:58:46', '2024-05-09 23:56:31'),
(10, 'EP000000008', '8', '31', '0.2', NULL, '3.5', NULL, '9.0', NULL, '1.5', NULL, '10', '0', '8', '2024-05-15 02:24:40', '2024-05-15 02:05:59', '2024-05-15 02:24:40'),
(11, 'EP000000008', '9', '34', '0.65', NULL, '3.2', NULL, '5.5', NULL, '2.0', NULL, '45', '0', '8', '2024-05-15 02:24:40', '2024-05-15 02:05:59', '2024-05-15 02:24:40'),
(12, 'EP000000009', '14', '36', '0.5', NULL, '2.02', NULL, '2.02', NULL, '0.5', NULL, '1.3', '0', '8', '2024-05-15 03:52:05', '2024-05-15 03:50:04', '2024-05-15 03:52:05'),
(13, 'EP000000009', '1', '31', '0.2', NULL, '1.07', NULL, '5.02', NULL, '0.55', NULL, '15', '0', '8', '2024-05-15 03:52:05', '2024-05-15 03:50:04', '2024-05-15 03:52:05'),
(14, 'EP000000010', '9', '34', '0.2', NULL, '3.21', NULL, '5.0', NULL, '0.5', NULL, '10', '0', '8', '2024-05-15 05:25:14', '2024-05-15 05:22:31', '2024-05-15 05:25:14'),
(15, 'EP000000010', '7', '32', '0.2', NULL, '5.02', NULL, '8.02', NULL, '0.2', NULL, '15', '0', '8', '2024-05-15 05:25:14', '2024-05-15 05:22:31', '2024-05-15 05:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `epd_reject_histories`
--

CREATE TABLE `epd_reject_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epro_id` varchar(10) NOT NULL,
  `location` varchar(250) DEFAULT NULL,
  `column_name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epd_reject_histories`
--

INSERT INTO `epd_reject_histories` (`id`, `epro_id`, `location`, `column_name`, `value`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '4', NULL, 'pieces_per_case', '180', 'fdd', '2024-05-05 23:39:36', '2024-05-05 23:39:36'),
(2, '4', NULL, 'specific_gravity', '15', 'over limit', '2024-05-06 01:13:48', '2024-05-06 01:13:48'),
(3, '7', NULL, 'specific_gravity', '1.22', 'checking purpose', '2024-05-09 23:30:10', '2024-05-09 23:30:10'),
(4, '7', NULL, 'salesTax', '17', 'tax', '2024-05-09 23:52:30', '2024-05-09 23:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `epd_r_m_cost_details`
--

CREATE TABLE `epd_r_m_cost_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epro_id` varchar(50) NOT NULL,
  `plant` varchar(50) NOT NULL,
  `in_mat_desc` varchar(250) NOT NULL,
  `fin_mat_desc` varchar(250) NOT NULL,
  `bom_qty` varchar(50) NOT NULL,
  `meeht` varchar(25) NOT NULL,
  `rate` varchar(25) NOT NULL,
  `cost` varchar(25) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epd_r_m_cost_details`
--

INSERT INTO `epd_r_m_cost_details` (`id`, `epro_id`, `plant`, `in_mat_desc`, `fin_mat_desc`, `bom_qty`, `meeht`, `rate`, `cost`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2', 'PYM2', 'PETTIRATI PET AIRFRESHNER FLORAL BULK', 'PETTIRATI PET AIRFRESHNR FLORAL 250M 24P', '4.462', 'KG', '123.35', '550.41', '3', '2024-05-14 06:52:56', '2024-05-14 06:52:56'),
(3, '9', 'TNC6', 'BUDS&BERRIES GINGER VETIVER SHAM BULK', 'BUDS&BERRIES GINGER VETIVER SH 300ML 12P', '3.791', 'KG', '181.28', '687.31', '3', '2024-05-15 04:27:12', '2024-05-15 04:27:12'),
(4, '10', 'TNC6', 'RAAGA DETAN CREME', 'RAAGA DE TAN CREME 500GM 12PCS', '6.103', 'KG', '113.58', '693.21', '3', '2024-05-15 05:29:53', '2024-05-15 05:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `epd_secondary_locations`
--

CREATE TABLE `epd_secondary_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epro_id` varchar(25) NOT NULL,
  `from_location` varchar(10) NOT NULL,
  `to_location` varchar(10) NOT NULL,
  `freight` varchar(10) NOT NULL,
  `s_cost_approval` varchar(10) DEFAULT NULL,
  `freightsuser` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epd_secondary_locations`
--

INSERT INTO `epd_secondary_locations` (`id`, `epro_id`, `from_location`, `to_location`, `freight`, `s_cost_approval`, `freightsuser`, `created_at`, `updated_at`) VALUES
(1, 'EP000000001', '22', '40', '23', '0', '24', '2023-12-16 04:46:08', '2023-12-16 04:47:28'),
(2, 'EP000000002', '34', '68', '50', '0', '24', '2024-01-24 03:38:48', '2024-01-24 03:53:54'),
(3, 'EP000000003', '22', '40', '20', '0', '24', '2024-01-24 03:44:58', '2024-01-24 03:51:28'),
(4, 'EP000000004', '22', '40', '2', '1', '24', '2024-01-24 06:19:19', '2024-05-07 06:23:27'),
(5, 'EP000000001', '25', '41', '21', '0', '24', '2023-12-16 04:46:08', '2023-12-16 04:47:28'),
(6, 'EP000000005', '33', '51', '', NULL, NULL, '2024-05-09 03:53:53', '2024-05-09 03:53:53'),
(7, 'EP000000006', '33', '51', '10.3', '0', '8', '2024-05-09 03:54:26', '2024-05-09 04:55:49'),
(8, 'EP000000007', '36', '52', '162.0', '1', '8', '2024-05-09 22:58:46', '2024-05-09 23:56:34'),
(9, 'EP000000007', '30', '54', '254', '1', '8', '2024-05-09 22:58:46', '2024-05-09 23:56:34'),
(10, 'EP000000008', '31', '50', '14', '0', '8', '2024-05-15 02:05:59', '2024-05-15 02:24:55'),
(11, 'EP000000008', '34', '49', '32', '0', '8', '2024-05-15 02:05:59', '2024-05-15 02:24:55'),
(12, 'EP000000009', '36', '55', '10', '0', '8', '2024-05-15 03:50:04', '2024-05-15 03:51:51'),
(13, 'EP000000009', '31', '48', '12', '0', '8', '2024-05-15 03:50:04', '2024-05-15 03:51:51'),
(14, 'EP000000010', '34', '51', '12', '0', '8', '2024-05-15 05:22:31', '2024-05-15 05:25:32'),
(15, 'EP000000010', '32', '54', '16', '0', '8', '2024-05-15 05:22:31', '2024-05-15 05:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `existing_products`
--

CREATE TABLE `existing_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epro_id` varchar(20) NOT NULL,
  `division` varchar(50) DEFAULT NULL,
  `material_code` varchar(50) NOT NULL,
  `pieces_per_case` varchar(10) NOT NULL,
  `noofpcs_approval` varchar(20) NOT NULL,
  `distribution_channel` varchar(50) DEFAULT NULL,
  `mrp_piece` varchar(10) DEFAULT NULL,
  `salesTax` varchar(5) DEFAULT NULL,
  `hsnCode` varchar(10) DEFAULT NULL,
  `tax_approval` varchar(20) DEFAULT NULL,
  `taxuser` varchar(10) DEFAULT NULL,
  `taxdate` timestamp NULL DEFAULT NULL,
  `damage` varchar(10) NOT NULL,
  `damage_approval` varchar(20) DEFAULT NULL,
  `logistic` varchar(10) NOT NULL,
  `logistic_approval` varchar(20) DEFAULT NULL,
  `damageuser` varchar(10) DEFAULT NULL,
  `damagedate` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `mt_exsheet_approval` varchar(20) NOT NULL,
  `excsheet_approval` varchar(20) NOT NULL,
  `marketuser` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `material_type` varchar(220) DEFAULT NULL,
  `material_name` varchar(220) DEFAULT NULL,
  `fill_volume` varchar(20) DEFAULT NULL,
  `plant` varchar(20) DEFAULT NULL,
  `rmcost` varchar(50) DEFAULT NULL,
  `rmscrap` varchar(50) DEFAULT NULL,
  `pmcost` varchar(50) DEFAULT NULL,
  `pmscrap` varchar(50) DEFAULT NULL,
  `conv_cost` varchar(50) DEFAULT NULL,
  `mrp` varchar(50) DEFAULT NULL,
  `specific_gravity` varchar(10) NOT NULL DEFAULT '0',
  `gravity_approval` varchar(10) NOT NULL DEFAULT 'pending',
  `gravity_user` varchar(20) DEFAULT NULL,
  `gravity_date` timestamp NULL DEFAULT NULL,
  `rmcost_verified` varchar(20) NOT NULL DEFAULT 'not yet',
  `pmcost_verified` varchar(20) NOT NULL DEFAULT 'not yet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `existing_products`
--

INSERT INTO `existing_products` (`id`, `epro_id`, `division`, `material_code`, `pieces_per_case`, `noofpcs_approval`, `distribution_channel`, `mrp_piece`, `salesTax`, `hsnCode`, `tax_approval`, `taxuser`, `taxdate`, `damage`, `damage_approval`, `logistic`, `logistic_approval`, `damageuser`, `damagedate`, `status`, `mt_exsheet_approval`, `excsheet_approval`, `marketuser`, `created_at`, `updated_at`, `material_type`, `material_name`, `fill_volume`, `plant`, `rmcost`, `rmscrap`, `pmcost`, `pmscrap`, `conv_cost`, `mrp`, `specific_gravity`, `gravity_approval`, `gravity_user`, `gravity_date`, `rmcost_verified`, `pmcost_verified`) VALUES
(1, 'EP000000001', '', 'GM0080YBC01R', '10', 'pending', NULL, NULL, '18', NULL, 'pending', '29', '2023-12-16 04:46:53', '2.1', 'pending', '1.5', 'pending', '30', '2023-12-16 04:48:02', '0', 'pending', 'pending', '8', '2023-12-16 10:16:08', '2024-05-03 06:22:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.36', 'approved', NULL, NULL, 'not yet', 'not yet'),
(2, 'EP000000002', '', 'PRAF0250FRL01R', '24', 'pending', NULL, NULL, '18', NULL, 'pending', '29', '2024-01-24 03:50:42', '1', 'pending', '2', 'pending', '30', '2024-01-24 03:59:27', '0', 'pending', 'pending', '1', '2024-01-24 09:08:48', '2024-05-15 01:36:34', 'ZFG', NULL, NULL, 'PYM2', '0', NULL, '2173.75', NULL, '0', NULL, '2', 'pending', '2', '2024-05-03 00:36:33', 'verified', 'verified'),
(3, 'EP000000003', '', 'CE0015BLK01R', '144', 'pending', NULL, NULL, '18', NULL, 'pending', '29', '2024-01-24 03:57:57', '2', 'approved', '1.2', 'approved', '30', '2024-01-24 04:03:52', '0', 'pending', 'pending', '1', '2024-01-24 09:14:58', '2024-05-08 06:33:26', 'ZFG', NULL, NULL, 'UKM1', '322.65', NULL, '311.48', NULL, '0', NULL, '1', 'pending', NULL, NULL, 'verified', 'verified'),
(4, 'EP000000004', '', 'KH0050HWP02R', '180', 'approved', NULL, '10', '18', NULL, 'approved', '29', '2024-01-24 06:28:25', '2', 'approved', '1.2', 'approved', '30', '2024-01-24 06:29:26', '0', 'pending', 'approved', '1', '2024-01-24 11:49:19', '2024-05-08 12:07:51', 'ZFG', 'FINISHED KARTHIKA HERBAL POWDER', '50GM', 'PYC1', '349.66', '1.5', '252.07', '2', '147.6', '1800', '1.02', 'approved', '2', '2024-05-06 01:27:14', 'verified', 'verified'),
(5, 'EP000000005', '2', 'RD0500DET01R', '10', 'pending', '4', NULL, '', '', 'pending', NULL, NULL, '', NULL, '', NULL, NULL, NULL, '1', 'pending', 'pending', '1', '2024-05-09 09:23:53', '2024-05-10 04:31:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'pending', NULL, NULL, 'not yet', 'not yet'),
(6, 'EP000000006', '2', 'RD0500DET01R', '10', 'pending', '4', NULL, '13', NULL, 'pending', '6', '2024-05-09 04:50:24', '12', 'pending', '26', 'pending', '9', '2024-05-09 05:27:45', '0', 'pending', 'pending', '1', '2024-05-09 09:24:26', '2024-05-09 06:39:35', 'ZFG', NULL, NULL, 'PYM1', '660.03', NULL, '356.13', NULL, '0', NULL, '2', 'pending', '2', '2024-05-09 06:39:35', 'verified', 'verified'),
(7, 'EP000000007', '3', 'BBBL0240MV01R', '12', 'approved', '5', '400', '16', '35DFF54G', 'approved', '6', '2024-05-09 23:53:30', '13', 'approved', '28', 'approved', '9', '2024-05-09 23:20:31', '0', 'approved', 'approved', '1', '2024-05-10 04:28:46', '2024-05-10 00:03:31', 'ZFG', 'BUDS&BERRIE MCDM&VNILA BDLOTION BULK', '240ML', 'TNC6', '754.02', '3', '747.2', '2.9', '147.91', '4800', '1.3', 'approved', '2', '2024-05-09 23:30:37', 'verified', 'verified'),
(8, 'EP000000008', '2', 'CS0005EGW09S', '10', 'pending', '3', NULL, '18', 'SFFS5656', 'pending', '6', '2024-05-15 02:22:20', '10', 'pending', '12', 'pending', '9', '2024-05-15 02:32:20', '0', 'pending', 'pending', '1', '2024-05-15 07:35:59', '2024-05-15 02:32:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', 'pending', '2', '2024-05-15 02:20:08', 'not yet', 'not yet'),
(9, 'EP000000009', '1', 'BB0300GV01R', '15', 'pending', '4', NULL, '18', 'RHE875G7', 'pending', '6', '2024-05-15 03:52:38', '10.3', 'pending', '15.45', 'pending', '9', '2024-05-15 03:54:02', '0', 'pending', 'pending', '1', '2024-05-15 09:20:04', '2024-05-16 08:43:35', 'ZFG', NULL, NULL, 'TNC6', '687.31', NULL, '400.6', NULL, '204.45', NULL, '2.03', 'pending', '2', '2024-05-15 03:51:20', 'verified', 'verified'),
(10, 'EP000000010', '3', 'RD0500DET01R', '10', 'pending', '5', NULL, '13', 'hgf', 'pending', '6', '2024-05-15 05:24:31', '0.3', 'pending', '1.31', 'pending', '9', '2024-05-15 05:26:38', '0', 'pending', 'pending', '1', '2024-05-15 10:52:31', '2024-05-15 05:29:53', 'ZFG', NULL, NULL, 'TNC6', '693.21', NULL, '378.81', NULL, '226.32', NULL, '10', 'pending', '2', '2024-05-15 05:23:51', 'verified', 'not yet');

-- --------------------------------------------------------

--
-- Table structure for table `exists_history`
--

CREATE TABLE `exists_history` (
  `id` int(11) NOT NULL,
  `basics_id` varchar(50) NOT NULL,
  `material_code` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ex_med_requests`
--

CREATE TABLE `ex_med_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epro_id` varchar(255) NOT NULL,
  `material_code` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `approve_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `location_masters`
--

CREATE TABLE `location_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_masters`
--

INSERT INTO `location_masters` (`id`, `type`, `location`, `created_at`, `updated_at`) VALUES
(1, 'primary_from', 'ASC1-HAR HAR FOODS AND BEVERAGES', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(2, 'primary_from', 'ASM1-ASSAM-GOALPARA MANUFACTURING', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(3, 'primary_from', 'GUT1-Bhiwandi Depot Potato Sales', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(4, 'primary_from', 'HRT1-CKPL Bikano Sales', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(5, 'primary_from', 'MHC1-Kolhapur-GHODAWAT FOODS', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(6, 'primary_from', 'MHC2-BHIWANDI CONVERSION', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(7, 'primary_from', 'MHM1-BHIWANDI MANUFACTURING', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(8, 'primary_from', 'PYC1-PONDY CONVERSION ROHIT', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(9, 'primary_from', 'PYM1-PONDY MANUFACTURING 1', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(10, 'primary_from', 'PYM2-PONDY MANUFACTURING 2 - DEO', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(11, 'primary_from', 'TNC5-THAIYUR ROHIT CONVERSION', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(12, 'primary_from', 'TNC6-TINDIVANAM KRALZ FAIR CONV', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(13, 'primary_from', 'TNC7-VELAPPANCHAVADI VIKAARTE FOODS', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(14, 'primary_from', 'TNCB-DA TPU DINDIGUL SPS CHILL CTR', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(15, 'primary_from', 'TNCC-DA TPU POLLACHI SRI HARI FARM', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(16, 'primary_from', 'TNCG-VIKARAVANDI-ASIAN BEVERAGE', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(17, 'primary_from', 'TNM1-ERODE MANUFACTURING', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(18, 'primary_from', 'TNM3-KANCIPURAM MANUFACTURING', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(19, 'primary_from', 'UKC1-TPU COOL COSMETICS', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(20, 'primary_from', 'UKM1-HARIDWAR MANUFACTURING', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(21, 'primary_from', 'TNC1-Plant-Periyampatti (FD)', '2023-10-28 01:34:52', '2023-10-28 01:34:52'),
(22, 'primary_to', 'APD1-VIJAYAWADA DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(23, 'primary_to', 'ASD1-ASSAM DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(24, 'primary_to', 'BRD1-PATNA DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(25, 'primary_to', 'CGD1-RAIPUR DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(26, 'primary_to', 'GJD1-AHMEDABAD DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(27, 'primary_to', 'KAD1-BENGALURU DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(28, 'primary_to', 'MHD1-MUMBAI DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(29, 'primary_to', 'MHD2-NAGPUR DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(30, 'primary_to', 'MPD1-INDORE DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(31, 'primary_to', 'ODD1-CUTTACK DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(32, 'primary_to', 'PBD1-ZIRAKPUR DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(33, 'primary_to', 'RJD1-JAIPUR DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(34, 'primary_to', 'TND1-CHENNAI DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(35, 'primary_to', 'TSD1-SECUNDERABAD DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(36, 'primary_to', 'UPD1-GHAZIABAD DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(37, 'primary_to', 'UPD2-LUCKNOW DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(38, 'primary_to', 'UPD3-KANPUR DEPOT', '2023-10-28 01:36:47', '2023-10-28 01:36:47'),
(39, 'primary_to', 'WBD1-KOLKATA DEPOT', '2023-10-28 01:36:47', '2023-10-28 05:18:18'),
(40, 'secondary_to', 'Andhra Pradesh', '2023-10-28 02:29:26', '2023-10-28 05:21:00'),
(41, 'secondary_to', 'Arunachal Pradesh', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(42, 'secondary_to', 'Assam', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(43, 'secondary_to', 'Bihar', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(44, 'secondary_to', 'Chhattisgarh', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(45, 'secondary_to', 'Goa', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(46, 'secondary_to', 'Gujarat', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(47, 'secondary_to', 'Haryana', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(48, 'secondary_to', 'Himachal Pradesh', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(49, 'secondary_to', 'Jammu and Kashmir', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(50, 'secondary_to', 'Jharkhand', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(51, 'secondary_to', 'Karnataka', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(52, 'secondary_to', 'Kerala', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(53, 'secondary_to', 'Madhya Pradesh', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(54, 'secondary_to', 'Maharashtra', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(55, 'secondary_to', 'Manipur', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(56, 'secondary_to', 'Meghalaya', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(57, 'secondary_to', 'Mizoram', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(58, 'secondary_to', 'Nagaland', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(59, 'secondary_to', 'Orissa', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(60, 'secondary_to', 'Punjab', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(61, 'secondary_to', 'Rajasthan', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(62, 'secondary_to', 'Sikkim', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(63, 'secondary_to', 'Tamil Nadu', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(64, 'secondary_to', 'Tripura', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(65, 'secondary_to', 'Uttarakhand', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(66, 'secondary_to', 'Uttar Pradesh', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(67, 'secondary_to', 'West Bengal', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(68, 'secondary_to', 'Tamil Nadu', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(69, 'secondary_to', 'Tripura', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(70, 'secondary_to', 'Andaman and Nicobar Islands', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(71, 'secondary_to', 'Chandigarh', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(72, 'secondary_to', 'Dadra and Nagar Haveli', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(73, 'secondary_to', 'Daman and Diu', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(74, 'secondary_to', 'Delhi', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(75, 'secondary_to', 'Lakshadweep', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(76, 'secondary_to', 'Pondicherry', '2023-10-28 02:29:26', '2023-10-28 02:29:26'),
(77, 'primary_from', 'TNC09', '2023-10-28 04:49:49', '2023-10-28 05:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `med_requests`
--

CREATE TABLE `med_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `approve_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `med_requests`
--

INSERT INTO `med_requests` (`id`, `pro_id`, `product_name`, `version`, `amount`, `remarks`, `approve_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PR000000005', 'Cavin\'s Milkshake', 'V1.0', '2403', 'fdgdfgd', 'approved', '0', '2023-06-03 04:22:50', '2023-06-03 08:59:38'),
(2, 'PR000000028', 'Spinz Talc - Exotic', 'V1.0', '200000', 'Import RM', 'approved', '0', '2023-06-27 04:44:38', '2023-06-26 23:14:57'),
(3, 'PR000000032', 'Sprite', 'V1.0', '500000', 'RM Purchase', 'approved', '0', '2023-06-28 09:43:28', '2023-06-28 04:14:17'),
(4, 'PR000000022', 'MILK TEA', 'V1.0', '200000', 'New NPD Product', 'approved', '0', '2023-09-11 08:57:22', '2023-09-11 03:28:04'),
(5, 'PR000000024', 'Milkshake', 'V1.0', '1200', 'test', 'approved', '0', '2023-09-21 10:17:11', '2024-02-12 03:47:10');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_04_20_095732_create_users_table', 1),
(5, '2023_04_20_101841_create_basics_table', 2),
(6, '2023_04_21_070323_create_rm_costs_table', 3),
(7, '2023_04_22_053817_add_status_to_basics_table', 4),
(8, '2023_05_02_051311_create_uoms_table', 5),
(9, '2023_05_05_120144_create_product__materials_table', 6),
(10, '2023_06_02_120101_create_med_requests_table', 7),
(11, '2023_06_03_092744_create_ex_med_requests_table', 8),
(14, '2023_08_18_093629_add_column_to_basics', 9),
(15, '2023_08_18_095744_add_column_to_product__materials', 10),
(16, '2023_08_18_100854_add_column_to_primary_locations', 11),
(17, '2023_08_18_100416_add_column_to_rm_costs', 12),
(18, '2023_08_24_065122_add_column_to_locations', 13),
(19, '2023_08_24_070955_add_column_to_dist_channels', 14),
(20, '2024_05_08_055040_create_epd_cost_updaion_histories_table', 15),
(21, '2024_05_08_063754_create_epd_cost_updaion_histories_table', 16),
(23, '2024_05_14_121144_create_epd_pm_cost_details_table', 18),
(24, '2024_05_14_113712_create_epd_r_m_cost_details_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `moq_histories`
--

CREATE TABLE `moq_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moq_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `moq` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TNC6', '2023-11-26 23:07:26', '2023-11-26 23:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `primary_locations`
--

CREATE TABLE `primary_locations` (
  `id` int(11) NOT NULL,
  `pro_id` varchar(255) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `retailer_margin` varchar(20) DEFAULT NULL,
  `rs_margin` varchar(20) DEFAULT NULL,
  `ss_margin` varchar(20) DEFAULT NULL,
  `primary_scheme` varchar(20) DEFAULT NULL,
  `freight_user` int(11) DEFAULT NULL,
  `p_cost_approval` int(11) NOT NULL DEFAULT 0,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `freight_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `primary_locations`
--

INSERT INTO `primary_locations` (`id`, `pro_id`, `from_location`, `to_location`, `cost`, `retailer_margin`, `rs_margin`, `ss_margin`, `primary_scheme`, `freight_user`, `p_cost_approval`, `updated_at`, `created_at`, `freight_date`) VALUES
(1, 'PR000000001', '1', '22', '1.5', '1.2', '1.3', '0.6', '0.2', 24, 1, '2023-12-16 10:02:07', '2023-12-16 09:37:05', '2023-12-16 04:25:56'),
(2, 'PR000000001', '3', '23', '1.6', '0.0', '6.7', '7.2', '0.7', 24, 1, '2023-12-16 10:02:07', '2023-12-16 09:37:05', '2023-12-16 04:25:56'),
(3, 'PR000000002', '12', '23', '2.66', '22', '0', '0', '0', 24, 0, '2023-12-19 11:46:28', '2023-12-19 11:24:51', '2023-12-19 06:16:28'),
(4, 'PR000000003', '12', '34', NULL, '23', '0', '0', '70', NULL, 0, '2023-12-20 05:22:28', '2023-12-20 05:22:28', NULL),
(5, 'PR000000004', '12', '34', NULL, '23', '0', '0', '70', NULL, 0, '2023-12-20 05:25:13', '2023-12-20 05:25:13', NULL),
(6, 'PR000000005', '2', '27', NULL, '10', '6', '0', '5', NULL, 0, '2023-12-20 05:25:50', '2023-12-20 05:25:50', NULL),
(7, 'PR000000006', '6', '25', '14', '0.5', '0.5', '1.2', '1.4', 24, 1, '2024-01-06 05:10:16', '2024-01-04 09:46:28', '2024-01-04 04:17:26'),
(8, 'PR000000006', '11', '28', '15', '1.31', '8.6', '0.0', '0.8', 24, 1, '2024-01-06 05:10:16', '2024-01-04 09:46:28', '2024-01-04 04:17:26'),
(9, 'PR000000007', '7', '24', NULL, '1', '0.2', '0.2', '1', NULL, 0, '2024-01-04 09:47:23', '2024-01-04 09:47:23', NULL),
(10, 'PR000000007', '5', '23', NULL, '1', '0.3', '0.3', '2', NULL, 0, '2024-01-04 09:47:23', '2024-01-04 09:47:23', NULL),
(11, 'PR000000008', '1', '22', '5', '0.2', '7.0', '0.6', '2.7', 24, 1, '2024-01-04 11:29:10', '2024-01-04 10:10:53', '2024-01-04 04:42:39'),
(12, 'PR000000008', '15', '33', '10', '0.3', '8.0', '0.7', '2.8', 24, 1, '2024-01-04 11:29:10', '2024-01-04 10:10:53', '2024-01-04 04:42:39'),
(13, 'PR000000009', '12', '36', '211.2', '22', '0', '0', '0', 24, 0, '2024-01-22 04:22:40', '2024-01-22 04:20:29', '2024-01-21 22:52:40'),
(14, 'PR000000010', '20', '22', '53.82', '12', '6', '0', '0', 24, 0, '2024-01-24 09:53:05', '2024-01-24 09:49:37', '2024-01-24 04:23:05'),
(15, 'PR000000011', '17', '34', '0', '10', '6', '0', '15', 24, 0, '2024-01-24 10:06:33', '2024-01-24 09:59:26', '2024-01-24 04:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `primary_location_histories`
--

CREATE TABLE `primary_location_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product__materials`
--

CREATE TABLE `product__materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `product_details` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `uom` varchar(50) DEFAULT NULL,
  `p_quantity_approval` int(11) NOT NULL DEFAULT 0,
  `MOQ` varchar(255) DEFAULT NULL,
  `p_moq_approval` varchar(110) NOT NULL DEFAULT '0',
  `vendor` varchar(255) DEFAULT NULL,
  `basic` varchar(255) DEFAULT NULL,
  `freight` varchar(255) DEFAULT NULL,
  `scrap` varchar(100) DEFAULT NULL,
  `scrap_user` int(11) DEFAULT NULL,
  `p_scrap_approval` int(11) NOT NULL DEFAULT 0,
  `pm_cost` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `package_user` int(11) DEFAULT NULL,
  `package_date` timestamp NULL DEFAULT NULL,
  `pm_user` int(11) DEFAULT NULL,
  `pm_date` timestamp NULL DEFAULT NULL,
  `moq_remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__materials`
--

INSERT INTO `product__materials` (`id`, `product_id`, `version`, `material`, `product_details`, `specification`, `quantity`, `uom`, `p_quantity_approval`, `MOQ`, `p_moq_approval`, `vendor`, `basic`, `freight`, `scrap`, `scrap_user`, `p_scrap_approval`, `pm_cost`, `created_at`, `updated_at`, `package_user`, `package_date`, `pm_user`, `pm_date`, `moq_remarks`) VALUES
(1, 'PR000000001', NULL, 'Label', 'test', 'test2', '100', 'ml', 0, '[\"1000 nos\"]', '[\"1\"]', '[\"Plastroplack\"]', '[\"1.0\"]', '[\"1.2\"]', '8', 28, 0, '[\"224.40\"]', '2023-12-16 04:22:47', '2023-12-16 04:32:04', 26, '2023-12-16 04:22:47', 27, '2023-12-16 04:24:10', NULL),
(2, 'PR000000001', NULL, 'HDPE', 'teat3', 'test4', '80', 'ml', 0, '[\"2000nos\"]', '[\"1\"]', '[\"xyz\"]', '[\"1.4\"]', '[\"1.3\"]', '0.1', 28, 0, '[\"216.22\"]', '2023-12-16 04:22:47', '2023-12-16 04:32:05', 26, '2023-12-16 04:22:47', 27, '2023-12-16 04:24:10', NULL),
(3, 'PR000000002', NULL, 'Container', 'Container', 'Container', '24', 'Nos', 0, '[\"0\"]', '[\"1\"]', '[\"A\"]', '[\"12\"]', '[\"1\"]', '2', 28, 0, '[\"318.24\"]', '2023-12-19 06:28:03', '2023-12-20 01:49:18', 26, '2023-12-19 06:28:03', 27, '2023-12-20 01:04:42', NULL),
(4, 'PR000000002', NULL, 'Pump', 'Pump', 'Pump', '24', 'Nos', 0, '[\"0\"]', '[\"1\"]', '[\"B\"]', '[\"10\"]', '[\"1\"]', '2', 28, 0, '[\"269.28\"]', '2023-12-19 06:28:03', '2023-12-20 01:49:11', 26, '2023-12-19 06:28:03', 27, '2023-12-20 01:04:42', NULL),
(5, 'PR000000002', NULL, 'Label', 'Label', 'Label', '24', 'Nos', 0, '[\"0\"]', '[\"1\"]', '[\"C\"]', '[\"10\"]', '[\"1\"]', '2', 28, 0, '[\"269.28\"]', '2023-12-19 06:28:03', '2023-12-20 01:49:08', 26, '2023-12-19 06:28:03', 27, '2023-12-20 01:04:42', NULL),
(6, 'PR000000002', NULL, 'Shrink Sleeve', 'Shrink Sleeve', 'Shrink Sleeve', '24', 'Nos', 0, '[\"0\"]', '[\"1\"]', '[\"D\"]', '[\"2\"]', '[\"1\"]', '2', 28, 0, '[\"73.44\"]', '2023-12-19 06:28:03', '2023-12-20 01:49:06', 26, '2023-12-19 06:28:03', 27, '2023-12-20 01:04:42', NULL),
(7, 'PR000000002', NULL, 'CFC', 'CFC', 'CFC', '1', 'Nos', 0, '[\"0\"]', '[\"1\"]', '[\"E\"]', '[\"67\"]', '[\"0\"]', '2', 28, 0, '[\"68.34\"]', '2023-12-19 06:28:03', '2023-12-20 01:49:03', 26, '2023-12-19 06:28:03', 27, '2023-12-20 01:04:42', NULL),
(8, 'PR000000002', NULL, 'Tape', 'Tape', 'Tape', '2', 'Nos', 0, '[\"0\"]', '[\"1\"]', '[\"F\"]', '[\"0.4801\"]', '[\"0\"]', '2', 28, 0, '[\"0.98\"]', '2023-12-19 06:28:03', '2023-12-20 01:49:02', 26, '2023-12-19 06:28:03', 27, '2023-12-20 01:04:42', NULL),
(9, 'PR000000006', NULL, 'Label', 'test', 'test', '30', 'sheets', 0, '[\"100 nos\",\"2000 nos\"]', '[\"1\",\"1\"]', '[\"xyz\",\"var\"]', '[\"2\",\"1\"]', '[\"1\",\"1\"]', '2', 28, 0, '[\"91.80\",\"61.20\"]', '2024-01-04 04:55:01', '2024-01-05 23:40:17', 26, '2024-01-04 04:55:01', 27, '2024-01-04 04:57:02', NULL),
(10, 'PR000000008', NULL, 'Label', 'Label Details', 'PM SPEC', '5', 'g', 0, '[\"0\"]', '[\"1\"]', '[\"Check\"]', '[\"5\"]', '[\"2\"]', '0.5', 26, 0, '[\"0\"]', '2024-01-04 04:58:13', '2024-01-04 05:59:05', 26, '2024-01-04 04:58:13', 27, '2024-01-04 04:59:48', NULL),
(11, 'PR000000009', NULL, 'Container', 'Container', 'Container', '1', 'Nos', 0, '[\"0\"]', '[\"0\"]', '[\"a\"]', '[\"318.2\"]', '[\"0\"]', '0', 28, 0, '[\"318.20\"]', '2024-01-23 23:18:26', '2024-01-23 23:30:33', 26, '2024-01-23 23:18:26', 27, '2024-01-23 23:30:33', NULL),
(12, 'PR000000009', NULL, 'Pump', 'Pump', 'Pump', '1', 'Nos', 0, '[\"0\"]', '[\"0\"]', '[\"b\"]', '[\"269.3\"]', '[\"0\"]', '0', 28, 0, '[\"269.30\"]', '2024-01-23 23:18:26', '2024-01-23 23:30:33', 26, '2024-01-23 23:18:26', 27, '2024-01-23 23:30:33', NULL),
(13, 'PR000000009', NULL, 'Label', 'Label', 'Label', '1', 'Nos', 0, '[\"0\"]', '[\"0\"]', '[\"c\"]', '[\"269.3\"]', '[\"0\"]', '0', 28, 0, '[\"269.30\"]', '2024-01-23 23:18:26', '2024-01-23 23:30:33', 26, '2024-01-23 23:18:26', 27, '2024-01-23 23:30:33', NULL),
(14, 'PR000000009', NULL, 'Shrink Sleeve', 'Shrink Sleeve', 'Shrink Sleeve', '1', 'Nos', 0, '[\"0\"]', '[\"0\"]', '[\"d\"]', '[\"73.4\"]', '[\"0\"]', '0', 28, 0, '[\"73.40\"]', '2024-01-23 23:18:26', '2024-01-23 23:30:33', 26, '2024-01-23 23:18:26', 27, '2024-01-23 23:30:33', NULL),
(15, 'PR000000009', NULL, 'CFC', 'CFC', 'CFC', '1', 'Nos', 0, '[\"0\"]', '[\"0\"]', '[\"e\"]', '[\"68.3\"]', '[\"0\"]', '0', 28, 0, '[\"68.30\"]', '2024-01-23 23:18:26', '2024-01-23 23:30:33', 26, '2024-01-23 23:18:26', 27, '2024-01-23 23:30:33', NULL),
(16, 'PR000000009', NULL, 'Tape', 'Tape', 'Tape', '1', 'Nos', 0, '[\"0\"]', '[\"0\"]', '[\"f\"]', '[\"1.0\"]', '[\"0\"]', '0', 28, 0, '[\"1.00\"]', '2024-01-23 23:18:26', '2024-01-23 23:30:33', 26, '2024-01-23 23:18:26', 27, '2024-01-23 23:30:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rm_costs`
--

CREATE TABLE `rm_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `b_id` varchar(250) DEFAULT NULL,
  `Product_id` varchar(255) NOT NULL,
  `sapcode` varchar(200) DEFAULT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Ingredient` varchar(255) DEFAULT NULL,
  `Icomposition` varchar(100) DEFAULT NULL,
  `scrap` varchar(100) DEFAULT NULL,
  `p_scrap_approval` int(11) NOT NULL DEFAULT 0,
  `scrap_user` varchar(255) DEFAULT NULL,
  `rm_user` int(11) DEFAULT NULL,
  `purchase_user` int(11) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `inscrap` varchar(150) DEFAULT NULL,
  `mcost` varchar(150) DEFAULT NULL,
  `qty` varchar(250) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rm_costs`
--

INSERT INTO `rm_costs` (`id`, `version`, `b_id`, `Product_id`, `sapcode`, `Product_name`, `Ingredient`, `Icomposition`, `scrap`, `p_scrap_approval`, `scrap_user`, `rm_user`, `purchase_user`, `rate`, `inscrap`, `mcost`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '1', 'PR000000001', '4001245', 'Cavin Milkshake', 'SEA SILT (DEAD SEA MUD )', NULL, '1', 1, '28', 25, 27, '952.00', NULL, NULL, '1', NULL, '2023-12-16 04:11:23', '2023-12-16 04:32:03'),
(2, NULL, '1', 'PR000000001', NULL, 'Cavin Milkshake', 'TEST', NULL, '1', 1, '28', 25, 27, '12', NULL, NULL, '1', NULL, '2023-12-16 04:11:23', '2023-12-16 04:32:03'),
(3, NULL, '1', 'PR000000001', NULL, 'Cavin Milkshake', 'Banana', NULL, '1.2', 1, '28', 25, 27, '12', NULL, NULL, '2', NULL, '2023-12-16 04:11:23', '2023-12-16 04:32:03'),
(4, NULL, '2', 'PR000000002', '4002577', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Neelicert FD&C Brown 11452', NULL, '1', 0, '25', 25, 27, '3450.00', NULL, NULL, '0.04', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(5, NULL, '2', 'PR000000002', '4001919', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Fragrance Eve\'s Paradise', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '40', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(6, NULL, '2', 'PR000000002', '4001897', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ZEMEA PROPANEDIOL', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(7, NULL, '2', 'PR000000002', '4001893', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Avocado oil', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '1', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(8, NULL, '2', 'PR000000002', '4001952', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ARMOCARE VGH 70', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(9, NULL, '2', 'PR000000002', '4001895', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'PLANTASIL 4V', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(10, NULL, '2', 'PR000000002', '4001886', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Phytocell Tec Goji', NULL, '1', 0, '25', 25, 27, '172000.00', NULL, NULL, '0.01', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(11, NULL, '2', 'PR000000002', '4001891', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Abyssinian oil', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '1', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(12, NULL, '2', 'PR000000002', '4001745', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(13, NULL, '2', 'PR000000002', '4001745', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(14, NULL, '2', 'PR000000002', '4001429', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Genadvance life', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '125', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(15, NULL, '2', 'PR000000002', '4001745', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(16, NULL, '2', 'PR000000002', '4001611', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Apple cider Vinegar', NULL, '1', 0, '25', 25, 27, '77.73', NULL, NULL, '10', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(17, NULL, '2', 'PR000000002', '4001528', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'WACKER BELSIL DMDM 6090', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '300', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(18, NULL, '2', 'PR000000002', '4000515', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CRODAMOL SE', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(19, NULL, '2', 'PR000000002', '4000431', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'VITAMIN E ACETATE - RA', NULL, '1', 0, '25', 25, 27, '1600.00', NULL, NULL, '10', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(20, NULL, '2', 'PR000000002', '4000274', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'LACTIC ACID', NULL, '1', 0, '25', 25, 27, '196.00', NULL, NULL, '43', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(21, NULL, '2', 'PR000000002', '4000668', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'EUXYL PE 9010', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(22, NULL, '2', 'PR000000002', '4000268', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'BEHENYL TMC 85 (INCROQUAT TMC)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(23, NULL, '2', 'PR000000002', '4000381', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DL PANTHENOL - RA', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(24, NULL, '2', 'PR000000002', '4000189', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ALLANTOIN', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '5', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(25, NULL, '2', 'PR000000002', '4000257', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DC FLUID 200 -350 / DMC 350', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '200', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(26, NULL, '2', 'PR000000002', '4000267', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'SAPDA (INCROMINE SD) / ARMOCARE APA 18V', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '125', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(27, NULL, '2', 'PR000000002', '4000261', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CTAC (GENAMIN/CARSOQUAT CT-429)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '175', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(28, NULL, '2', 'PR000000002', '4000183', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'HYDROVANCE', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(29, NULL, '2', 'PR000000002', '4000182', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CETOSTEARYL ALCOHOL C1618(CSA)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '500', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(30, NULL, '2', 'PR000000002', '4000158', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CIBA FAST H LIQUID', NULL, '1', 0, '25', 25, 27, '7140.00', NULL, NULL, '10', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(31, NULL, '2', 'PR000000002', '4000114', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'OCTYL METHOXY CINNAMATE (OMC)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(32, NULL, '2', 'PR000000002', '4000155', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DC RED 33 - CI 17200', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '0.003', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(33, NULL, '2', 'PR000000002', '4000120', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'GLYCERINE', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '300', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(34, NULL, '2', 'PR000000002', '4000108', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'test', NULL, '1', 0, '25', 25, 27, '0', NULL, NULL, '7819', NULL, '2023-12-19 05:59:44', '2023-12-20 01:53:15'),
(35, NULL, '2', 'PR000000002', '4000097', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DISODIUM EDTA', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '10', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(36, NULL, '2', 'PR000000002', '4000096', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'BUTYLATED HYDROXY TOULENE', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '1', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(37, NULL, '2', 'PR000000002', '4002577', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Neelicert FD&C Brown 11452', NULL, '1', 0, '25', 25, 27, '3450.00', NULL, NULL, '0.04', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(38, NULL, '2', 'PR000000002', '4001952', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ARMOCARE VGH 70', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(39, NULL, '2', 'PR000000002', '4001919', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Fragrance Eve\'s Paradise', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '40', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(40, NULL, '2', 'PR000000002', '4001897', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ZEMEA PROPANEDIOL', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(41, NULL, '2', 'PR000000002', '4001895', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'PLANTASIL 4V', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(42, NULL, '2', 'PR000000002', '4001893', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Avocado oil', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '1', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(43, NULL, '2', 'PR000000002', '4001891', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Abyssinian oil', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '1', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(44, NULL, '2', 'PR000000002', '4001886', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Phytocell Tec Goji', NULL, '1', 0, '25', 25, 27, '172000.00', NULL, NULL, '0.01', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(45, NULL, '2', 'PR000000002', '4001611', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Apple cider Vinegar', NULL, '0', 0, '25', 25, 27, '77.73', NULL, NULL, '10', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(46, NULL, '2', 'PR000000002', '4001745', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(47, NULL, '2', 'PR000000002', '4001745', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(48, NULL, '2', 'PR000000002', '4001745', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(49, NULL, '2', 'PR000000002', '4001528', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'WACKER BELSIL DMDM 6090', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '300', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(50, NULL, '2', 'PR000000002', '4001429', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Genadvance life', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '125', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(51, NULL, '2', 'PR000000002', '4000668', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'EUXYL PE 9010', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(52, NULL, '2', 'PR000000002', '4000515', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CRODAMOL SE', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(53, NULL, '2', 'PR000000002', '4000431', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'VITAMIN E ACETATE - RA', NULL, '1', 0, '25', 25, 27, '1600.00', NULL, NULL, '10', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(54, NULL, '2', 'PR000000002', '4000274', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'LACTIC ACID', NULL, '1', 0, '25', 25, 27, '196.00', NULL, NULL, '43', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(55, NULL, '2', 'PR000000002', '4000267', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'SAPDA (INCROMINE SD) / ARMOCARE APA 18V', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '125', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(56, NULL, '2', 'PR000000002', '4000381', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DL PANTHENOL - RA', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(57, NULL, '2', 'PR000000002', '4000268', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'BEHENYL TMC 85 (INCROQUAT TMC)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '50', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(58, NULL, '2', 'PR000000002', '4000261', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CTAC (GENAMIN/CARSOQUAT CT-429)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '175', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(59, NULL, '2', 'PR000000002', '4000257', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DC FLUID 200 -350 / DMC 350', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '200', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(60, NULL, '2', 'PR000000002', '4000183', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'HYDROVANCE', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '25', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(61, NULL, '2', 'PR000000002', '4000158', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CIBA FAST H LIQUID', NULL, '1', 0, '25', 25, 27, '7140.00', NULL, NULL, '10', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(62, NULL, '2', 'PR000000002', '4000189', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ALLANTOIN', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '5', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(63, NULL, '2', 'PR000000002', '4000182', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CETOSTEARYL ALCOHOL C1618(CSA)', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '500', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(64, NULL, '2', 'PR000000002', '4000155', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DC RED 33 - CI 17200', NULL, '1', 0, '25', 25, 27, '0.00', NULL, NULL, '0.003', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(65, NULL, '2', 'PR000000002', '4000108', 'B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'test', NULL, '1', 0, '25', 25, 27, '0', NULL, NULL, '7819', NULL, '2023-12-19 05:59:45', '2023-12-20 01:53:15'),
(66, NULL, '8', 'PR000000008', '4001952', 'Test NEw 04-1', 'ARMOCARE VGH 70', NULL, '27.38', 1, '25', 25, 27, '0.00', '340.56', '0.00', '12', NULL, '2024-01-04 04:52:07', '2024-01-04 05:58:52'),
(67, NULL, '6', 'PR000000006', '4001245', 'Meera Coconut Oil - Pure', 'SEA SILT (DEAD SEA MUD )', NULL, '1', 1, '28', 25, 27, '0.00', '20', '0', '10', NULL, '2024-01-04 04:52:50', '2024-01-05 23:40:13'),
(68, NULL, '6', 'PR000000006', NULL, 'Meera Coconut Oil - Pure', 'Coconut oil', NULL, '3', 1, '28', 25, 27, '12', '800', '9600', '200', NULL, '2024-01-04 04:52:50', '2024-01-05 23:40:13'),
(69, NULL, '6', 'PR000000006', NULL, 'Meera Coconut Oil - Pure', 'Triglyceride', NULL, '1.2', 1, '28', 25, 27, '45', '44.00', '1980.00', '20', NULL, '2024-01-04 04:52:50', '2024-01-05 23:40:13'),
(70, NULL, '9', 'PR000000009', '4002577', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Neelicert FD&C Brown 11452', NULL, '0', 0, '28', 25, 27, '3450.00', '0.04', '138.00', '0.04', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(71, NULL, '9', 'PR000000009', '4001952', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ARMOCARE VGH 70', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(72, NULL, '9', 'PR000000009', '4001895', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'PLANTASIL 4V', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(73, NULL, '9', 'PR000000009', '4001897', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ZEMEA PROPANEDIOL', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(74, NULL, '9', 'PR000000009', '4001919', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Fragrance Eve\'s Paradise', NULL, '0', 0, '28', 25, 27, '0.00', '40.00', '0.00', '40', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(75, NULL, '9', 'PR000000009', '4001893', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Avocado oil', NULL, '0', 0, '28', 25, 27, '0.00', '1.00', '0.00', '1', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(76, NULL, '9', 'PR000000009', '4001891', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Abyssinian oil', NULL, '0', 0, '28', 25, 27, '0.00', '1.00', '0.00', '1', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(77, NULL, '9', 'PR000000009', '4001611', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Apple cider Vinegar', NULL, '0', 0, '28', 25, 27, '77.73', '10.00', '777.30', '10', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(78, NULL, '9', 'PR000000009', '4001745', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'STRUCTURE PQ37', NULL, '0', 0, '28', 25, 27, '0.00', '50.00', '0.00', '50', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(79, NULL, '9', 'PR000000009', '4001886', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Phytocell Tec Goji', NULL, '0', 0, '28', 25, 27, '172000.00', '0.01', '1720.00', '0.01', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(80, NULL, '9', 'PR000000009', '4001528', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'WACKER BELSIL DMDM 6090', NULL, '0', 0, '28', 25, 27, '0.00', '300.00', '0.00', '300', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(81, NULL, '9', 'PR000000009', '4001429', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'Genadvance life', NULL, '0', 0, '28', 25, 27, '0.00', '125.00', '0.00', '125', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(82, NULL, '9', 'PR000000009', '4000668', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'EUXYL PE 9010', NULL, '0', 0, '28', 25, 27, '0.00', '50.00', '0.00', '50', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(83, NULL, '9', 'PR000000009', '4000515', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CRODAMOL SE', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(84, NULL, '9', 'PR000000009', '4000431', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'VITAMIN E ACETATE - RA', NULL, '0', 0, '28', 25, 27, '1600.00', '10.00', '16000.00', '10', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(85, NULL, '9', 'PR000000009', '4000381', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DL PANTHENOL - RA', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(86, NULL, '9', 'PR000000009', '4000274', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'LACTIC ACID', NULL, '0', 0, '28', 25, 27, '196.00', '43.00', '8428.00', '43', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(87, NULL, '9', 'PR000000009', '4000268', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'BEHENYL TMC 85 (INCROQUAT TMC)', NULL, '0', 0, '28', 25, 27, '0.00', '50.00', '0.00', '50', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(88, NULL, '9', 'PR000000009', '4000267', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'SAPDA (INCROMINE SD) / ARMOCARE APA 18V', NULL, '0', 0, '28', 25, 27, '0.00', '125.00', '0.00', '125', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(89, NULL, '9', 'PR000000009', '4000261', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CTAC (GENAMIN/CARSOQUAT CT-429)', NULL, '0', 0, '28', 25, 27, '0.00', '175.00', '0.00', '175', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(90, NULL, '9', 'PR000000009', '4000257', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DC FLUID 200 -350 / DMC 350', NULL, '0', 0, '28', 25, 27, '0.00', '200.00', '0.00', '200', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(91, NULL, '9', 'PR000000009', '4000189', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'ALLANTOIN', NULL, '0', 0, '28', 25, 27, '0.00', '5.00', '0.00', '5', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(92, NULL, '9', 'PR000000009', '4000183', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'HYDROVANCE', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(93, NULL, '9', 'PR000000009', '4000182', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CETOSTEARYL ALCOHOL C1618(CSA)', NULL, '0', 0, '28', 25, 27, '0.00', '500.00', '0.00', '500', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(94, NULL, '9', 'PR000000009', '4000158', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'CIBA FAST H LIQUID', NULL, '0', 0, '28', 25, 27, '7140.00', '10.00', '71400.00', '10', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(95, NULL, '9', 'PR000000009', '4000155', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DC RED 33 - CI 17200', NULL, '0', 0, '28', 25, 27, '0.00', '0.00', '0.00', '0.003', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(96, NULL, '9', 'PR000000009', '4000120', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'GLYCERINE', NULL, '0', 0, '28', 25, 27, '0.00', '300.00', '0.00', '300', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(97, NULL, '9', 'PR000000009', '4000108', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DM WATER', NULL, '0', 0, '28', 25, 27, '1', '7819.00', '7819.00', '7819', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(98, NULL, '9', 'PR000000009', '4000114', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'OCTYL METHOXY CINNAMATE (OMC)', NULL, '0', 0, '28', 25, 27, '0.00', '25.00', '0.00', '25', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(99, NULL, '9', 'PR000000009', '4000097', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'DISODIUM EDTA', NULL, '0', 0, '28', 25, 27, '0.00', '10.00', '0.00', '10', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(100, NULL, '9', 'PR000000009', '4000096', 'Testing Ec-B&B HR CONDIT APPLECIDER GOJI 300ML 24PC', 'BUTYLATED HYDROXY TOULENE', NULL, '0', 0, '28', 25, 27, '0.00', '1.00', '0.00', '1', NULL, '2024-01-21 23:03:28', '2024-01-24 00:00:01'),
(101, NULL, '10', 'PR000000010', '4000198', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '5', '0', '5', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(102, NULL, '10', 'PR000000010', '4000481', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '2.25', '0', '2.25', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(103, NULL, '10', 'PR000000010', '4000325', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.8', '0', '0.8', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(104, NULL, '10', 'PR000000010', '4000102', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.7', '0', '0.7', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(105, NULL, '10', 'PR000000010', '4000227', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '1', '0', '1', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(106, NULL, '10', 'PR000000010', '4000165', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.5', '0', '0.5', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(107, NULL, '10', 'PR000000010', '4000450', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '1', '0', '1', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(108, NULL, '10', 'PR000000010', '4002509', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '1', '0', '1', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(109, NULL, '10', 'PR000000010', '4002873', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.1', '0', '0.1', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(110, NULL, '10', 'PR000000010', '4000105', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.25', '0', '0.25', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(111, NULL, '10', 'PR000000010', '4000108', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '87.4', '0', '87.4', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(112, NULL, '10', 'PR000000010', '4000145', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '2', '0', '2', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(113, NULL, '10', 'PR000000010', '4000180', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.5', '0', '0.5', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(114, NULL, '10', 'PR000000010', '4000177', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '14.86', '0', '14.86', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(115, NULL, '10', 'PR000000010', '4000241', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '1.5', '0', '1.5', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(116, NULL, '10', 'PR000000010', '4000287', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.1', '0', '0.1', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(117, NULL, '10', 'PR000000010', '4000310', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '6.5', '0', '6.5', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(118, NULL, '10', 'PR000000010', '4000373', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '12', '0', '12', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(119, NULL, '10', 'PR000000010', '4000198', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '0.05', '0', '0.05', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38'),
(120, NULL, '10', 'PR000000010', '4000108', 'CHIK EASY 18ML 280PC', NULL, NULL, '0', 0, '25', 25, NULL, NULL, '62.49', '0', '62.49', NULL, '2024-01-24 04:33:38', '2024-01-24 04:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `rm_cost_histories`
--

CREATE TABLE `rm_cost_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rm_costs_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `scrap` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rm_cost_histories`
--

INSERT INTO `rm_cost_histories` (`id`, `rm_costs_id`, `product_id`, `scrap`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '4', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(2, '5', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(3, '6', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(4, '7', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(5, '8', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(6, '9', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(7, '10', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(8, '11', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(9, '12', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(10, '13', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(11, '14', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(12, '15', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(13, '16', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(14, '17', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(15, '18', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(16, '19', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(17, '20', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(18, '21', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(19, '22', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(20, '23', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(21, '24', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(22, '25', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(23, '26', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(24, '27', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(25, '28', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(26, '29', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(27, '30', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(28, '31', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(29, '32', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(30, '33', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(31, '34', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(32, '35', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(33, '36', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(34, '37', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(35, '38', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(36, '39', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(37, '40', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(38, '41', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(39, '42', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(40, '43', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(41, '44', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(42, '45', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(43, '46', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(44, '47', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(45, '48', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(46, '49', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(47, '50', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(48, '51', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(49, '52', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(50, '53', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(51, '54', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(52, '55', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(53, '56', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(54, '57', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(55, '58', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(56, '59', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(57, '60', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(58, '61', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(59, '62', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(60, '63', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(61, '64', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(62, '65', 'PR000000002', '0', 'Qty wrong', '2023-12-20 01:32:54', '2023-12-20 01:32:54'),
(63, '4', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(64, '5', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(65, '6', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(66, '7', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(67, '8', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(68, '9', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(69, '10', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(70, '11', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(71, '12', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(72, '13', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(73, '14', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(74, '15', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(75, '16', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(76, '17', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(77, '18', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(78, '19', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(79, '20', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(80, '21', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(81, '22', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(82, '23', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(83, '24', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(84, '25', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(85, '26', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(86, '27', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(87, '28', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(88, '29', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(89, '30', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(90, '31', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(91, '32', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(92, '33', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(93, '34', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(94, '35', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(95, '36', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(96, '37', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:10', '2023-12-20 01:52:10'),
(97, '38', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(98, '39', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(99, '40', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(100, '41', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(101, '42', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(102, '43', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(103, '44', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(104, '45', 'PR000000002', '0', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(105, '46', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(106, '47', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(107, '48', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(108, '49', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(109, '50', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(110, '51', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(111, '52', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(112, '53', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(113, '54', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(114, '55', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(115, '56', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(116, '57', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(117, '58', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(118, '59', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(119, '60', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(120, '61', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(121, '62', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(122, '63', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(123, '64', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(124, '65', 'PR000000002', '1', 'WRONG RM', '2023-12-20 01:52:11', '2023-12-20 01:52:11'),
(125, '70', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(126, '71', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(127, '72', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(128, '73', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(129, '74', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(130, '75', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(131, '76', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(132, '77', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(133, '78', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(134, '79', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(135, '80', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(136, '81', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(137, '82', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(138, '83', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(139, '84', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(140, '85', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(141, '86', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(142, '87', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(143, '88', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(144, '89', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(145, '90', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(146, '91', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(147, '92', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(148, '93', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(149, '94', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(150, '95', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(151, '96', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(152, '97', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:07', '2024-01-23 23:49:07'),
(153, '98', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:08', '2024-01-23 23:49:08'),
(154, '99', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:08', '2024-01-23 23:49:08'),
(155, '100', 'PR000000009', '0', 'specif gravity', '2024-01-23 23:49:08', '2024-01-23 23:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_locations`
--

CREATE TABLE `secondary_locations` (
  `id` int(11) NOT NULL,
  `pro_id` varchar(255) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `freight_user` int(11) DEFAULT NULL,
  `s_cost_approval` tinyint(4) NOT NULL DEFAULT 0,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `freight_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `secondary_locations`
--

INSERT INTO `secondary_locations` (`id`, `pro_id`, `from_location`, `to_location`, `cost`, `freight_user`, `s_cost_approval`, `updated_at`, `created_at`, `freight_date`) VALUES
(1, 'PR000000006', '25', '49', '23', 24, 1, '2024-01-06 05:10:19', '2024-01-04 09:46:28', '2024-01-04 04:17:37'),
(2, 'PR000000006', '28', '48', '23', 24, 1, '2024-01-06 05:10:19', '2024-01-04 09:46:28', '2024-01-04 04:17:37'),
(3, 'PR000000007', '24', '55', NULL, NULL, 0, '2024-01-04 09:47:23', '2024-01-04 09:47:23', NULL),
(4, 'PR000000007', '23', '55', NULL, NULL, 0, '2024-01-04 09:47:23', '2024-01-04 09:47:23', NULL),
(5, 'PR000000008', '22', '48', '100', 24, 1, '2024-01-04 11:29:11', '2024-01-04 10:10:53', '2024-01-04 04:42:56'),
(6, 'PR000000008', '33', '53', '75', 24, 1, '2024-01-04 11:29:11', '2024-01-04 10:10:53', '2024-01-04 04:42:56'),
(7, 'PR000000009', '36', '76', '1402.4', 24, 0, '2024-01-22 04:22:59', '2024-01-22 04:20:29', '2024-01-21 22:52:59'),
(8, 'PR000000010', '22', '40', '49.97', 24, 0, '2024-01-24 09:54:23', '2024-01-24 09:49:37', '2024-01-24 04:24:23'),
(9, 'PR000000011', '34', '63', '30.53', 24, 0, '2024-01-24 10:06:47', '2024-01-24 09:59:26', '2024-01-24 04:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_location_histories`
--

CREATE TABLE `secondary_location_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uoms`
--

CREATE TABLE `uoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uom_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uoms`
--

INSERT INTO `uoms` (`id`, `uom_name`, `created_at`, `updated_at`) VALUES
(11, 'g', '2023-05-03 03:47:44', '2023-05-03 06:34:25'),
(12, 'ml', '2023-05-03 03:48:01', '2023-05-03 05:21:20'),
(21, 'sheets', '2023-09-04 03:07:33', '2023-09-04 03:07:33'),
(22, 'Case', '2024-01-04 04:03:55', '2024-01-04 04:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `multirole` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Userid`, `name`, `email`, `role`, `multirole`, `password`, `created_at`, `updated_at`) VALUES
(1, 9001, 'market', 'Marketing@test.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2023-11-22 06:18:25'),
(2, 9002, 'research', 'katija.a@hepl.com', 'R&D', '[\"R&D\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-04-20 11:21:06', '2023-12-05 05:04:28'),
(3, 9003, 'rm purchasr', 'vanisri.m@hepl.com', 'PM Purchase', '[\"PM Purchase\",\"RM Purchase\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2024-05-16 03:14:09'),
(5, 9004, 'operations', 'emayavarman.e@hepl.com', 'operations', '[\"operations\",\"RM Purchase\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2023-12-05 04:51:14'),
(6, 9005, 'tax', 'manju.s@hepl.com', 'Tax', '[\"Tax\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2023-12-05 04:51:27'),
(7, 9006, 'packing', 'divya.k@hepl.com', 'Packing', '[\"Packing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2023-12-05 04:51:58'),
(8, 9007, 'logistic', 'marieswari.v@hepl.com', 'Logistic', '[\"Logistic\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2023-12-05 04:51:48'),
(9, 9008, 'finance', 'kathija.a@hepl.com', 'Finance', '[\"Finance\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-02 11:12:55', '2023-12-05 04:52:16'),
(10, 9009, 'MED', 'med@test.com', 'MED', '[\"MED\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-06-01 18:30:00', '2023-11-22 06:19:59'),
(11, 9010, 'pmpurchase', 'vanisri1.m@test.com', 'PM Purchase', '[\"PM Purchase\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-08-08 12:30:00', '2023-11-23 08:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `users_bk`
--

CREATE TABLE `users_bk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `multirole` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_bk`
--

INSERT INTO `users_bk` (`id`, `Userid`, `name`, `email`, `role`, `multirole`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'Monoj Rabha', 'monoj.s@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:24:30'),
(2, 2, 'Riddhima', 'riddhima@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:24:30'),
(3, 3, 'Harinarayanan', 'harinarayanp@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:02'),
(4, 4, 'Poulomi', 'poulomim@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(5, 5, 'Sahdhashiva', 'sahdhashiva@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(6, 6, 'Prem', 'prem.s@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(7, 7, 'Ramanathan', 'ramanathank@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(8, 8, 'Riyanka', 'riyanka@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(9, 9, 'Karthiban', 'karthiban@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(10, 10, 'Sharmathi', 'sharmathip@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(11, 11, 'Sahil', 'sahilsambyal@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(12, 12, 'Heena', 'heenah@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(13, 13, 'Aishwarya\r\n', 'aishwarya@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:33:08'),
(14, 14, 'Radhika', 'radhika.r@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(15, 15, 'Rahul', 'rahul.k@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(16, 16, 'Cathy Jose', 'cathyjose@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(17, 17, 'Christina Susan Thomas', 'christinathomas@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(18, 18, 'Khushal Singh', 'khushals@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(19, 19, 'Nikita Gupta', 'nikitagupta@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(20, 20, 'Vishnu', 'vishnuruban@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(21, 21, 'Ajay', 'ajayak@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(22, 22, 'Sukanya', 'sukanyak@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(23, 23, 'Venkatesh', 'venkatesh.m@cavinkare.com', 'Marketing', '[\"Marketing\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(24, 24, 'Mohan Kumar S', 'mohankumar.s@cavinkare.com', 'Logistic', '[\"Logistic\"]\r\n', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(25, 25, 'Sridhar Rajam', 'sridhar.r@cavinkare.com', 'R&D', '[\"R&D\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(26, 26, 'Nishant Kumar', 'nishanth.s@cavinkare.com', 'Packaging', '[\"Packaging\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(27, 27, 'Sivaraj TP', 'sivarajtp@cavinkare.com', 'PM Purchase', '[\"PM Purchase\",\"RM Purchase\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2024-01-24 03:49:28'),
(28, 28, 'Ravishankar N', 'ravishankarn@cavinkare.com', 'operations', '[\"operations\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:27:06'),
(29, 29, 'Niteesh Kowsal', 'niteeshk@cavinkare.com', 'Tax', '[\"Tax\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2023-11-28 07:51:46'),
(30, 30, 'AM Karthikeyan', 'karthikeyan.am@hepl.com', 'Finance', '[\"Finance\"]', '$2y$10$AG1Apxh9tTatK434WLptP.mVrqzZAdi8qEZDoV2C.NDP2uDYssG.y', '2023-11-28 07:24:30', '2024-01-24 01:07:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basics`
--
ALTER TABLE `basics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basics_histories`
--
ALTER TABLE `basics_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dist_channels`
--
ALTER TABLE `dist_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epd_cost_updaion_histories`
--
ALTER TABLE `epd_cost_updaion_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epd_pm_cost_details`
--
ALTER TABLE `epd_pm_cost_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epd_primary_locations`
--
ALTER TABLE `epd_primary_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epd_reject_histories`
--
ALTER TABLE `epd_reject_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epd_r_m_cost_details`
--
ALTER TABLE `epd_r_m_cost_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epd_secondary_locations`
--
ALTER TABLE `epd_secondary_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `existing_products`
--
ALTER TABLE `existing_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exists_history`
--
ALTER TABLE `exists_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ex_med_requests`
--
ALTER TABLE `ex_med_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `location_masters`
--
ALTER TABLE `location_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `med_requests`
--
ALTER TABLE `med_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moq_histories`
--
ALTER TABLE `moq_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plants_name_unique` (`name`);

--
-- Indexes for table `primary_locations`
--
ALTER TABLE `primary_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `primary_location_histories`
--
ALTER TABLE `primary_location_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product__materials`
--
ALTER TABLE `product__materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rm_costs`
--
ALTER TABLE `rm_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rm_cost_histories`
--
ALTER TABLE `rm_cost_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secondary_locations`
--
ALTER TABLE `secondary_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secondary_location_histories`
--
ALTER TABLE `secondary_location_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uoms`
--
ALTER TABLE `uoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_bk`
--
ALTER TABLE `users_bk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basics`
--
ALTER TABLE `basics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `basics_histories`
--
ALTER TABLE `basics_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dist_channels`
--
ALTER TABLE `dist_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `epd_cost_updaion_histories`
--
ALTER TABLE `epd_cost_updaion_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `epd_pm_cost_details`
--
ALTER TABLE `epd_pm_cost_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `epd_primary_locations`
--
ALTER TABLE `epd_primary_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `epd_reject_histories`
--
ALTER TABLE `epd_reject_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `epd_r_m_cost_details`
--
ALTER TABLE `epd_r_m_cost_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `epd_secondary_locations`
--
ALTER TABLE `epd_secondary_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `existing_products`
--
ALTER TABLE `existing_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exists_history`
--
ALTER TABLE `exists_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ex_med_requests`
--
ALTER TABLE `ex_med_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_masters`
--
ALTER TABLE `location_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `med_requests`
--
ALTER TABLE `med_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `moq_histories`
--
ALTER TABLE `moq_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `primary_locations`
--
ALTER TABLE `primary_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `primary_location_histories`
--
ALTER TABLE `primary_location_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product__materials`
--
ALTER TABLE `product__materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rm_costs`
--
ALTER TABLE `rm_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `rm_cost_histories`
--
ALTER TABLE `rm_cost_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `secondary_locations`
--
ALTER TABLE `secondary_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `secondary_location_histories`
--
ALTER TABLE `secondary_location_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uoms`
--
ALTER TABLE `uoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_bk`
--
ALTER TABLE `users_bk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
