-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2024 at 10:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1short_apparel`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, '1Short Apparel', 'image/brand/1short-apparel.png', 1, NULL, '2023-12-10 17:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `campaingns`
--

CREATE TABLE `campaingns` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaingns`
--

INSERT INTO `campaingns` (`id`, `title`, `start_date`, `end_date`, `image`, `discount`, `month`, `year`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(8, 'test', '2024-02-27', '2024-02-28', 'image/campaign/test.jpg', '5', 'February', '2024', 'test', '1', '2024-02-26 18:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_status` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `brand_id`, `category_name`, `home_page`, `category_slug`, `category_status`, `image`, `created_at`, `updated_at`) VALUES
(5, 4, 'Jackets', '0', 'jackets', 1, 'image/category/jackets.jpg', '2023-12-10 17:21:54', NULL),
(6, 4, 'Tank Tops', '1', 'tank-tops', 1, 'image/category/tank-tops.jpg', '2023-12-10 17:22:42', NULL),
(7, 4, 'Polo Shirts', '1', 'polo-shirts', 1, 'image/category/polo-shirts.jpg', '2023-12-10 17:23:36', NULL),
(8, 4, 'T-shart', '0', 't-shart', 1, 'image/category/t-shart.jpg', '2023-12-10 17:24:36', NULL),
(9, 4, 'Sweatshirts', '0', 'sweatshirts', 1, 'image/category/sweatshirts.jpg', '2023-12-10 17:25:16', NULL),
(10, 4, 'Dress Shirts', '0', 'dress-shirts', 1, 'image/category/dress-shirts.jpg', '2023-12-10 17:26:01', NULL),
(11, 4, 'High Viz', '0', 'high-viz', 1, 'image/category/high-viz.jpg', '2023-12-10 17:26:43', NULL),
(12, 4, 'Women\'s Shirts', '0', 'womens-shirts', 1, 'image/category/womens-shirts.jpg', '2023-12-10 17:27:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desctiption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `desctiption`, `created_at`, `updated_at`) VALUES
(1, 'Md.Afzal Hossen', 'afzalbhola07@gmail.com', '01811178307', 'Null', '2024-02-29 12:40:14', NULL),
(2, 'Md.Afzal Hossen', 'afzalbhola07@gmail.com', '01811178307', 'asdfsa', '2024-02-29 12:41:14', NULL),
(3, 'Md.Afzal Hossen', 'afzalbhola07@gmail.com', '01811178307', 'asdfa', '2024-02-29 12:41:50', NULL),
(4, 'Md.Afzal Hossen', 'afzalbhola07@gmail.com', '01811178307', 'dsafsadf', '2024-03-01 12:46:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `valid_date`, `type`, `coupon_amount`, `status`, `created_at`, `updated_at`) VALUES
(2, '12112', '2023-12-01', NULL, 501245, 1, '2023-12-04 13:27:21', '2023-12-04 13:27:21'),
(3, 'cd25', '2024-02-28', '1', 1202, 1, '2024-02-26 16:39:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_12_02_125242_create_brands_table', 2),
(10, '2023_12_03_013545_create_categories_table', 3),
(11, '2023_12_03_030937_create_sub_categories_table', 4),
(12, '2023_12_03_192403_create_seos_table', 5),
(13, '2023_12_03_204035_create_smtps_table', 6),
(14, '2023_12_03_211412_create_pages_table', 7),
(15, '2023_12_04_014702_create_website_settings_table', 8),
(16, '2023_12_04_021029_create_socials_table', 9),
(17, '2023_12_04_023452_create_products_table', 10),
(18, '2023_12_04_030115_create_warehouses_table', 11),
(19, '2023_12_04_163724_create_coupons_table', 12),
(20, '2023_12_04_181230_create_pickup_points_table', 13),
(21, '2023_12_31_223408_create_reviews_table', 14),
(22, '2024_01_28_225839_create_wishlists_table', 15),
(23, '2024_02_10_000722_create_campaingns_table', 16),
(24, '2024_02_29_173446_create_contacts_table', 17),
(25, '2024_03_27_003852_create_wereviews_table', 18),
(26, '2024_03_27_102857_create_shippings_table', 19),
(27, '2024_03_27_113336_create_pages_table', 20),
(28, '2024_03_30_211737_create_news_letters_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'afzalbhola07@gmail.com', NULL, NULL),
(2, 'afzal@gmail.com', NULL, NULL),
(3, 'admin@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `page_position` int DEFAULT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_description` text COLLATE utf8mb4_unicode_ci,
  `page_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_position`, `page_name`, `page_title`, `page_description`, `page_slug`, `page_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'page one', 'This is page one', '<p style=\"margin: 1em 0px; color: rgb(217, 217, 217); font-family: &quot;Segoe UI&quot;, &quot;Segoe UI Historic&quot;, &quot;Segoe UI Symbol&quot;, Lato, &quot;Liberation Sans&quot;, &quot;Noto Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: small; background-color: rgba(0, 0, 0, 0.7);\">Larum is a typical&nbsp;<a href=\"https://fireemblemwiki.org/wiki/Dancer\" title=\"Dancer\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\">Dancer</a>, possessing fairly high luck and speed, but poor bulk and the inability to fight back. As she will never face combat, her stats do not really matter, but an&nbsp;<a href=\"https://fireemblemwiki.org/wiki/Angelic_Robe\" class=\"mw-redirect\" title=\"Angelic Robe\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\">Angelic Robe</a>&nbsp;can be used to improve her survivability if needed. It can allow her to survive being struck by a siege tome or a ballista, for instance.</p><p style=\"margin: 1em 0px; color: rgb(217, 217, 217); font-family: &quot;Segoe UI&quot;, &quot;Segoe UI Historic&quot;, &quot;Segoe UI Symbol&quot;, Lato, &quot;Liberation Sans&quot;, &quot;Noto Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: small; background-color: rgba(0, 0, 0, 0.7);\">Larum has the ability to&nbsp;<a href=\"https://fireemblemwiki.org/wiki/Dance\" title=\"Dance\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\">dance</a>&nbsp;for player units who have already taken a turn, allowing them to move again. This is extremely useful for a variety of different situations, most notably allowing the player to easily use&nbsp;<a href=\"https://fireemblemwiki.org/wiki/Warp_(staff)\" class=\"mw-redirect\" title=\"Warp (staff)\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\">warp</a>&nbsp;more than once a turn in order to skip certain maps. The uses of a dancer are almost endless, and are only limited by the player\'s creativity. Because of the great utility Larum offers, she is overall an invaluable asset, especially when playing the game on hard mode.</p>', 'this-is-page-one', 1, '2024-03-27 05:34:50', NULL),
(2, 2, 'Page Two', 'This is page two', '<p>&lt;p style=\"margin: 1em 0px; color: rgb(217, 217, 217); font-family: &amp;quot;Segoe UI&amp;quot;, &amp;quot;Segoe UI Historic&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, Lato, &amp;quot;Liberation Sans&amp;quot;, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, sans-serif; font-size: small; background-color: rgba(0, 0, 0, 0.7);\"&gt;Larum is a typical&amp;nbsp;&lt;a href=\"https://fireemblemwiki.org/wiki/Dancer\" title=\"Dancer\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\"&gt;Dancer&lt;/a&gt;, possessing fairly high luck and speed, but poor bulk and the inability to fight back. As she will never face combat, her stats do not really matter, but an&amp;nbsp;&lt;a href=\"https://fireemblemwiki.org/wiki/Angelic_Robe\" class=\"mw-redirect\" title=\"Angelic Robe\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\"&gt;Angelic Robe&lt;/a&gt;&amp;nbsp;can be used to improve her survivability if needed. It can allow her to survive being struck by a siege tome or a ballista, for instance.&lt;/p&gt;&lt;p style=\"margin: 1em 0px; color: rgb(217, 217, 217); font-family: &amp;quot;Segoe UI&amp;quot;, &amp;quot;Segoe UI Historic&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, Lato, &amp;quot;Liberation Sans&amp;quot;, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, sans-serif; font-size: small; background-color: rgba(0, 0, 0, 0.7);\"&gt;Larum has the ability to&amp;nbsp;&lt;a href=\"https://fireemblemwiki.org/wiki/Dance\" title=\"Dance\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\"&gt;dance&lt;/a&gt;&amp;nbsp;for player units who have already taken a turn, allowing them to move again. This is extremely useful for a variety of different situations, most notably allowing the player to easily use&amp;nbsp;&lt;a href=\"https://fireemblemwiki.org/wiki/Warp_(staff)\" class=\"mw-redirect\" title=\"Warp (staff)\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(51, 170, 255);\"&gt;warp&lt;/a&gt;&amp;nbsp;more than once a turn in order to skip certain maps. The uses of a dancer are almost endless, and are only limited by the player\'s creativity. Because of the great utility Larum offers, she is overall an invaluable asset, especially when playing the game on hard mode.&lt;/p&gt;<br></p>', 'this-is-page-two', 1, '2024-03-27 05:36:16', '2024-03-27 05:36:57'),
(3, 1, 'about', 'this is a about page', '<p>this is a about page<br></p>', 'this-is-a-about-page', 1, '2024-03-30 14:03:03', NULL),
(4, 2, 'about 2', 'about 2', '<p>about 2<br></p>', 'about-2', 1, '2024-03-30 14:03:34', NULL),
(5, 1, 'Home', 'Home Page', '<h2 style=\"color: rgb(0, 0, 0); margin: 0.25em 0px; padding-top: 0.5em; padding-bottom: 0.17em; overflow: hidden; border-bottom: 1px solid rgb(162, 169, 177); font-size: 1.5em; line-height: 1.375; font-family: &quot;Linux Libertine&quot;, Georgia, Times, &quot;Source Serif Pro&quot;, serif;\"><span class=\"mw-headline\" id=\"বাল্যকাল_এবং_কর্মজীবন\">Childhood and career&nbsp;</span><span class=\"mw-editsection\" style=\"user-select: none; font-size: small; margin-left: 1em; vertical-align: baseline; line-height: 0; font-family: sans-serif; unicode-bidi: isolate; margin-right: 0px;\"><span class=\"mw-editsection-bracket\" style=\"margin-right: 0.25em; color: rgb(84, 89, 93);\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">[&nbsp;</font></font></span><a href=\"https://bn.wikipedia.org/w/index.php?title=%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8&amp;action=edit&amp;section=1\" title=\"Paragraph editing: Childhood and career\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word; text-wrap: nowrap;\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">edit</font></font></a><span class=\"mw-editsection-bracket\" style=\"margin-left: 0.25em; color: rgb(84, 89, 93);\"><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">&nbsp;]</font></font></span></span></h2><p style=\"margin: 0.5em 0px 0px; padding-bottom: 0.5em; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\"><font style=\"vertical-align: inherit;\">Adams was born&nbsp;&nbsp;</font><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%AB%E0%A6%BF%E0%A6%B2%E0%A6%BE%E0%A6%A1%E0%A7%87%E0%A6%B2%E0%A6%AB%E0%A6%BF%E0%A6%AF%E0%A6%BC%E0%A6%BE\" title=\"Philadelphia\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">in Philadelphia</a><font style=\"vertical-align: inherit;\">&nbsp;. In 1981, he&nbsp; enlisted in the Pennsylvania Regiment&nbsp;</font><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%AE%E0%A6%BE%E0%A6%B0%E0%A7%8D%E0%A6%95%E0%A6%BF%E0%A6%A8_%E0%A6%AF%E0%A7%81%E0%A6%95%E0%A7%8D%E0%A6%A4%E0%A6%B0%E0%A6%BE%E0%A6%B7%E0%A7%8D%E0%A6%9F%E0%A7%8D%E0%A6%B0%E0%A7%87%E0%A6%B0_%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A6%BE%E0%A6%AC%E0%A6%BE%E0%A6%B9%E0%A6%BF%E0%A6%A8%E0%A7%80\" class=\"mw-redirect\" title=\"United States Army\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">of the US Army</a><font style=\"vertical-align: inherit;\">&nbsp;before the minimum age for enlistment , and served there for 3 months before returning to school life.&nbsp;</font><sup id=\"cite_ref-yearbook_1-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-yearbook-1\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[1]</a></sup><font style=\"vertical-align: inherit;\">&nbsp;In 1863 when Robert E. He rejoined the army just as Lee\'s army invaded Pennsylvania and served as quartermaster until 1871.&nbsp;</font><sup id=\"cite_ref-yearbook_1-1\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-yearbook-1\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[1]&nbsp;</a></sup><sup id=\"cite_ref-nyt1901_2-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-nyt1901-2\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[2]</a></sup><font style=\"vertical-align: inherit;\">&nbsp;He then worked in business for a few years. He later studied law and established himself as a lawyer in Philadelphia in 1878.&nbsp;</font><sup id=\"cite_ref-yearbook_1-2\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-yearbook-1\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[1]</a></sup><font style=\"vertical-align: inherit;\"></font><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%A8%E0%A6%BF%E0%A6%89_%E0%A6%87%E0%A6%AF%E0%A6%BC%E0%A6%B0%E0%A7%8D%E0%A6%95_%E0%A6%B8%E0%A6%BF%E0%A6%9F%E0%A6%BF\" class=\"mw-redirect\" title=\"New York City\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">&nbsp;He then practiced law privately in the New York</a><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">&nbsp;firm of Judge Baby and Wilkes from 1883 to 1901&nbsp;</font><font style=\"vertical-align: inherit;\">as a specialist in maritime law.After Judge Baby\'s death in 1884, he became a partner in the firm and renamed it Wilkes, Adams &amp; Greene. do&nbsp;</font></font><sup id=\"cite_ref-yearbook_1-3\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-yearbook-1\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[1]&nbsp;</a></sup><sup id=\"cite_ref-nyt1901_2-1\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-nyt1901-2\" title=\"\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[2]</a></sup><font style=\"vertical-align: inherit;\">&nbsp;&nbsp;There he handled maritime law cases for the United States Supreme Court.&nbsp;</font><sup id=\"cite_ref-3\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-3\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[3]</a></sup><font style=\"vertical-align: inherit;\">&nbsp;&nbsp;Adams served as secretary of the Union League Club of New York from 1894 to 1895.&nbsp;</font><sup id=\"cite_ref-obit_4-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-obit-4\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[4]&nbsp;</a></sup><sup id=\"cite_ref-5\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-5\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[5]&nbsp;</a></sup><sup id=\"cite_ref-6\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://bn.wikipedia.org/wiki/%E0%A6%9C%E0%A6%B0%E0%A7%8D%E0%A6%9C_%E0%A6%AC%E0%A7%87%E0%A6%A5%E0%A7%81%E0%A6%A8_%E0%A6%85%E0%A7%8D%E0%A6%AF%E0%A6%BE%E0%A6%A1%E0%A6%BE%E0%A6%AE%E0%A6%B8#cite_note-6\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[6]</a></sup></p>', 'home-page', 1, '2024-03-30 15:09:58', NULL);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_points`
--

CREATE TABLE `pickup_points` (
  `id` bigint UNSIGNED NOT NULL,
  `pickup_point_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_point_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_point_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_point_phone_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pickup_points`
--

INSERT INTO `pickup_points` (`id`, `pickup_point_name`, `pickup_point_address`, `pickup_point_phone`, `pickup_point_phone_two`, `created_at`, `updated_at`) VALUES
(4, 'aaaaa', 'aaaaa', '11111', '22222', '2023-12-07 16:10:38', '2023-12-07 16:10:38'),
(5, 'asdfas', 'aaa', '12124512', '1245784512', '2023-12-07 16:19:11', '2023-12-07 16:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `subcategory_id` bigint UNSIGNED NOT NULL,
  `product_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_quantity` int DEFAULT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_purchase_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `product_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` int DEFAULT '0',
  `today_deal` int DEFAULT '0',
  `hot_new_arrivals` int DEFAULT '0',
  `hot_best_sellers` int DEFAULT '0',
  `flash_deal_id` int DEFAULT '0',
  `cash_on_delivery` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `warehouse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_point` int DEFAULT NULL,
  `product_slider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_views` int DEFAULT '0',
  `trendy` int DEFAULT '0',
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `subcategory_id`, `product_title`, `product_code`, `product_price`, `product_unit`, `product_quantity`, `discount_price`, `post_date`, `post_month`, `slug`, `images`, `thumbnail`, `product_purchase_price`, `stock_quantity`, `product_video`, `product_description`, `product_tags`, `product_color`, `product_size`, `featured`, `today_deal`, `hot_new_arrivals`, `hot_best_sellers`, `flash_deal_id`, `cash_on_delivery`, `admin_id`, `warehouse`, `pickup_point`, `product_slider`, `product_views`, `trendy`, `status`, `created_at`, `updated_at`) VALUES
(3, 4, 6, 4, 'T-shart', '22470', '500', 'Pc', 20, '400', '11-12-2023', 'December', 't-shart', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\n\nA574318\nA574317\nA574316\nA574319\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '1', 28, 0, 1, '2023-12-10 18:53:49', '2024-03-24 17:19:38'),
(4, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(5, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(6, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(7, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(8, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(9, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(10, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(11, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(12, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(13, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(14, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(15, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(16, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(17, 4, 7, 6, 'Internal Implementation Manager', '2012', '500', 'Pc', NULL, '400', '29-01-2024', 'January', 'internal-implementation-manager', 'image/product/images/internal-implementation-manager.jpg', 'image/product/thumbnail/internal-implementation-manager.jpg', '400', '500', NULL, '<p>asdfasf asdfa&nbsp;</p>', 'Omnis quasi aliquam facere esse ab alias recusandae.', 'red, black,', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B1', 5, '0', 28, 1, 1, '2024-01-28 22:19:59', '2024-03-27 03:15:51'),
(18, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(19, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(20, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, 1, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(21, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(22, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(23, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(24, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(25, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18'),
(26, 4, 6, 5, 'T-shart', '22470', '500', 'Pc', 20, '450', '11-12-2023', 'December', 't-shart dasfsaf', 'image/product/images/t-shart.jpg', 'image/product/thumbnail/t-shart.jpg', '500', '20', 'yYV2VEXMlYI', '<p>This classic cotton t-shirt is the perfect addition to your wardrobe. Made from 100% soft and durable cotton, it is designed for all-day comfort. The t-shirt features a classic fit with a ribbed crew neck and short sleeves, making it ideal for casual wear. The black color is versatile and easy to style, making it a must-have for any fashion-conscious individual. Available in sizes S to XXL, you’re sure to find the perfect fit. Whether you’re running errands, hanging out with friends, or just lounging at home, this t-shirt is sure to keep you comfortable and stylish.\r\n\r\nA574318\r\nA574317\r\nA574316\r\nA574319\r\nA574320</p>', 'Possimus explicabo iste quam.', 'red, black,blue,yello', 'S, M, Xl, XXl', 1, NULL, 1, 1, 1, 1, 1, 'B-3', 4, '0', 97, 0, 1, '2023-12-10 18:53:49', '2024-03-30 14:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `rating` int DEFAULT NULL,
  `review_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_year` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `review`, `rating`, `review_date`, `review_month`, `review_year`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'This is a nice product', 5, '02-01-2024', NULL, 2024, '2024-01-01 20:15:20', NULL),
(2, 1, 3, 'fdsafasfsa', 5, '02-01-2024', NULL, 2024, '2024-01-01 20:15:20', NULL),
(3, 1, 3, 'fdsafasfsa', 3, '02-01-2024', NULL, 2024, '2024-01-01 20:15:20', NULL),
(4, 1, 3, 'fdsafasfsa', 4, '02-01-2024', NULL, 2024, '2024-01-01 20:15:20', NULL),
(5, 1, 4, 'fgdgf', 5, '14-03-2024', 'March', 2024, '2024-03-14 12:49:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint UNSIGNED NOT NULL,
  `meta_author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `google_analytics` text COLLATE utf8mb4_unicode_ci,
  `google_verification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alexa_analytics` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `meta_author`, `meta_title`, `meta_keyword`, `meta_description`, `google_analytics`, `google_verification`, `alexa_analytics`, `created_at`, `updated_at`) VALUES
(1, '1Shot Apprel', 'Bundle Offer', 'newsportal, online, online news, online newspaper, online news, today, today news,', 'this is an online news portal website where you can easily read daily.', 'asds', 'dsafsa', 'dsafsaf', NULL, '2023-12-03 13:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smtps`
--

CREATE TABLE `smtps` (
  `id` bigint UNSIGNED NOT NULL,
  `mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtps`
--

INSERT INTO `smtps` (`id`, `mailer`, `host`, `port`, `user_name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmai', '465a', 'Supper-Admin', 'osxfzypmqygqixfh', NULL, '2023-12-03 15:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint UNSIGNED NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `facebook`, `twitter`, `youtube`, `instagram`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com', 'https://www.twitter.com', 'https://youtube.com/', 'https://instagram.com/', 'https://linkedin.com/', '2023-12-03 20:24:16', '2023-12-03 20:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory_status` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `brand_id`, `category_id`, `subcategory_name`, `subcategory_slug`, `subcategory_status`, `image`, `created_at`, `updated_at`) VALUES
(3, 4, 5, 'Men\'s Three-Season Classic Jacket', 'mens-three-season-classic-jacket', 1, 'image/subcategory/mens-three-season-classic-jacket.jpg', '2023-12-10 18:10:13', NULL),
(4, 4, 5, 'Hooded Raglan Jacket', 'hooded-raglan-jacket', 1, 'image/subcategory/hooded-raglan-jacket.jpg', '2023-12-10 18:11:36', NULL),
(5, 4, 6, 'Men\'s Muscle Tank', 'mens-muscle-tank', 1, 'image/subcategory/mens-muscle-tank.jpg', '2023-12-10 18:12:34', NULL),
(6, 4, 7, 'Men\'s Heather Colorblock Contender Polo', 'mens-heather-colorblock-contender-polo', 1, 'image/subcategory/mens-heather-colorblock-contender-polo.jpg', '2023-12-10 18:13:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supper_admin` tinyint(1) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `phone`, `supper_admin`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md.Afzal Hossen', 'Admin', 'admin@gmail.com', '01611178307', 1, 1, NULL, '$2y$10$.8b8MJoIs.DOeT0aMoz.w.LN3IvTUITCdn6.OsiwaEXNLN137J4r.', NULL, '2023-12-01 15:37:39', '2024-03-30 13:59:45'),
(2, 'asdfas', NULL, 'afzalbhola07@gmail.com', NULL, 1, NULL, NULL, '$2y$10$mpYBbGkJWOghwmLZzahVJe/X8rSwPKteHygUgmwsTcO4kJTBFl7.S', NULL, '2023-12-01 17:11:25', '2023-12-01 17:11:25'),
(3, 'dsafasfas', NULL, 'info@codeartist.com', NULL, 1, NULL, NULL, '$2y$10$7WTb6fUv21dJwjt.YSCbj.GSYx84s0CyKIjGqELgn./8271MPnLuC', NULL, '2023-12-31 12:57:25', '2023-12-31 12:57:25'),
(4, 'sadfasfa', NULL, 'afzalbasdfhola07@gmail.com', NULL, 1, NULL, NULL, '$2y$10$27MO9tmWXGuUymRiFcKDierbuvd/RdozYWnHc5ue191pGe7NkwZxa', NULL, '2023-12-31 15:06:57', '2023-12-31 15:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `warhouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warhouse_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warhouse_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warhouse_name`, `warhouse_address`, `warhouse_phone`, `created_at`, `updated_at`) VALUES
(3, 'B-3', 'Banasree Block-B, Road-5, House-21 Dhak', '018111783074', NULL, '2023-12-03 21:51:56'),
(4, 'B1', 'Banasree Block-B, Road-5, House-21 Dhaka', '01811178307', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `website_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `website_name`, `currency`, `phone_one`, `phone_two`, `main_email`, `support_email`, `logo`, `favicon`, `address`, `description`, `created_at`, `updated_at`) VALUES
(1, '1Shot Apparel', '$', '19296015392', '19296015392', '1shotapparelandgoods@gmaill.com', '1shotapparelandgoods@gmaill.com', 'image/website/logoaaaaaaaaaa.png', 'image/website/favicon/aaaaaaaaaa.gif', '90-48 Francis Lewis Blvd Queensvillage,NY11428', '<p>aaaaaaa</p>', '2024-01-28 19:40:39', '2024-01-28 19:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `wereviews`
--

CREATE TABLE `wereviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `rating` int DEFAULT NULL,
  `review_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wereviews`
--

INSERT INTO `wereviews` (`id`, `user_id`, `name`, `review`, `rating`, `review_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Supper-Admin', 'For each edition of the school, 40 PhD students are selected to attend the residential courses, selected among applicants working in civil engineering, environmental engineering, engineering geology or related fields. The School can be also attended by some Young Doctors who defended their PhD thesis in the previous 5 years.', 5, '27 , March 2024', 1, NULL, NULL),
(2, 1, 'Supper', 'For each edition of the school, 40 PhD students are selected to attend the residential courses, selected among applicants working in civil engineering, environmental engineering, engineering geology or related fields. The School can be also attended by some Young Doctors who defended their PhD thesis in the previous 5 years.', 3, '27 , March 2024', 1, NULL, NULL),
(3, 1, 'Admin', 'For each edition of the school, 40 PhD students are selected to attend the residential courses, selected among applicants working in civil engineering, environmental engineering, engineering geology or related fields. The School can be also attended by some Young Doctors who defended their PhD thesis in the previous 5 years.', 2, '27 , March 2024', 1, NULL, NULL),
(4, 1, 'Supper-Admin', 'For each edition of the school, 40 PhD students are selected to attend the residential courses, selected among applicants working in civil engineering, environmental engineering, engineering geology or related fields. The School can be also attended by some Young Doctors who defended their PhD thesis in the previous 5 years.', 1, '27 , March 2024', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `date`, `created_at`, `updated_at`) VALUES
(28, 1, 26, '30, March 2024', '2024-03-30 14:06:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaingns`
--
ALTER TABLE `campaingns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
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
-- Indexes for table `pickup_points`
--
ALTER TABLE `pickup_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_user_id_foreign` (`user_id`);

--
-- Indexes for table `smtps`
--
ALTER TABLE `smtps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_brand_id_foreign` (`brand_id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wereviews`
--
ALTER TABLE `wereviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wereviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `campaingns`
--
ALTER TABLE `campaingns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_points`
--
ALTER TABLE `pickup_points`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smtps`
--
ALTER TABLE `smtps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wereviews`
--
ALTER TABLE `wereviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wereviews`
--
ALTER TABLE `wereviews`
  ADD CONSTRAINT `wereviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
