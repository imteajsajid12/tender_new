-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2026 at 10:43 AM
-- Server version: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_kiryat`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  `sender` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `form_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `type` varchar(250) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `tenderval` varchar(200) DEFAULT NULL,
  `encryption_key_slot` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `status`, `sender`, `send_date`, `form_id`, `email`, `type`, `department`, `tenderval`, `encryption_key_slot`) VALUES
(366, '0', ' ', '2026-01-19 15:49:15', 5, 'guy@automas.co.il', 'page5', NULL, '2026-237', NULL),
(375, '0', ' ', '2026-01-21 11:20:24', 5, 'guy@automas.co.il', 'page5', NULL, '2026-244', NULL),
(376, '0', ' ', '2026-01-21 11:54:03', 5, 'guy@automas.co.il', 'page5', NULL, '2026-244', NULL),
(377, '0', ' ', '2026-01-22 14:08:49', 5, 'guy@automas.co.il', 'page5', NULL, '2026-245', NULL),
(378, '0', ' ', '2026-01-22 14:12:32', 5, 'guy@automas.co.il', 'page5', NULL, '2026-244', NULL),
(379, '0', ' ', '2026-01-26 06:25:20', 5, 'guy@automas.co.il', 'page5', NULL, '2026-237', NULL),
(380, '0', ' ', '2026-01-26 06:34:21', 5, 'imteajsajid1@gmail.com', 'page5', NULL, '2026-244', NULL),
(381, '0', ' ', '2026-01-26 13:10:57', 5, 'guy@automas.co.il', 'page5', NULL, '2026-246', NULL),
(382, '0', ' ', '2026-01-26 13:23:50', 5, 'guy@automas.co.il', 'page5', NULL, '2026-247', NULL),
(383, '0', ' ', '2026-01-26 13:36:59', 5, 'guy@automas.co.il', 'page5', NULL, '2026-248', NULL),
(384, '0', ' ', '2026-01-26 14:36:30', 5, 'guy@automas.co.il', 'page5', NULL, '2026-248', NULL),
(396, '0', ' ', '2026-01-28 04:49:56', 5, 'eyJpdiI6IkloUkQvK1pjQjJndTJXaFQzQ2FBNVE9PSIsInZhbHVlIjoiZVM5clN2d2RWM2FVQk5mVkpsamZuSXIxOVZxa3dBM3FTRWxsc3htcjdtYz0iLCJtYWMiOiIwNDhjNTc2OTk5Mjk2MzY4NzRhMWM4N2M2MjE4N2IzNTQxZmU1ZWE5OTQ3NzVkMDVhNjE1OTU1ODk5ODJjMzhiIiwidGFnIjoiIn0=', 'page5', NULL, '2026-237', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus='),
(397, '0', ' ', '2026-01-28 07:18:43', 5, 'eyJpdiI6IjJPeG50OTVjaEl5ZVFJQ0FEM250OFE9PSIsInZhbHVlIjoiRTI3SkVBazhMdFFGRkJlZkJqeE9XVmdpVzFGcTZZa3ZHZHFSaG5aS3FCVT0iLCJtYWMiOiIwMzJjOGE1NjkyMzhlNTFmZGRkZDZjYWZiNTAzOTk3MTM1YmUxOTE0MTE3ZjFjMzJmZTRlOGFjNzJiMDllZjQ2IiwidGFnIjoiIn0=', 'page5', NULL, '2026-250', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=');

-- --------------------------------------------------------

--
-- Table structure for table `apps_file`
--

CREATE TABLE `apps_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_dec_id` int(11) NOT NULL DEFAULT 0,
  `app_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `type` text NOT NULL,
  `file_name` text NOT NULL,
  `input_field_name` varchar(255) DEFAULT NULL COMMENT 'The HTML input field name/key used for upload',
  `input_field_label` text DEFAULT NULL COMMENT 'The Hebrew label/title of the input field',
  `encryption_key_slot` varchar(255) DEFAULT NULL,
  `status` text NOT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `is_cv` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps_file`
--

INSERT INTO `apps_file` (`id`, `app_dec_id`, `app_id`, `url`, `type`, `file_name`, `input_field_name`, `input_field_label`, `encryption_key_slot`, `status`, `canceled_at`, `is_cv`) VALUES
(2038, 333, 0, 'test_68e49a9e9612c_1759812254.pdf', 'mandatory_test', 'מבחן_חובה_Doc2.pdf^^מבחן_חובה', NULL, NULL, NULL, '1', NULL, 0),
(2336, 367, 366, '696e527b51b83_1768837755_new_@366.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2337, 367, 366, '696e527b51b83_1768837755_old_@366.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2338, 367, 366, '696e5286955b1176135208_1768837766_השכלה_חובה@גכעכגע_גכעכג.pdf', 'no', 'גכעכגע_גכעכג@השכלה חובה#Doc2.pdf^^השכלה חובה^^education', 'education', 'השכלה חובה', NULL, '1', NULL, 0),
(2339, 367, 366, '696e528695f77360445148_1768837766_מקצועי_חובה@גכעכגע_גכעכג.pdf', 'no', 'גכעכגע_גכעכג@מקצועי חובה#Doc2.pdf^^מקצועי חובה^^additional_files', 'additional_files', 'מקצועי חובה', NULL, '1', NULL, 0),
(2340, 367, 366, '696e5286961e8308835264_1768837766_ניהולי_חובה@גכעכגע_גכעכג.pdf', 'no', 'גכעכגע_גכעכג@ניהולי חובה#Doc2.pdf^^ניהולי חובה^^management_experience', 'management_experience', 'ניהולי חובה', NULL, '1', NULL, 0),
(2341, 367, 366, '696e528696520549523509_1768837766_מסמך_שירות_לאומיצבאי@גכעכגע_גכעכג.pdf', 'no', 'גכעכגע_גכעכג@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2342, 367, 366, '696e528696750817703460_1768837766_אישור_העסקה@גכעכגע_גכעכג.pdf', 'no', 'גכעכגע_גכעכג@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2343, 367, 366, '696e5286969c0590542009_1768837766_קורות_חיים@גכעכגע_גכעכג.pdf', 'no', 'גכעכגע_גכעכג@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2344, 0, 366, '696e52c42e7e6_1768837828.pdf', 'pdf', 'decisionreject0.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2424, 376, 375, '6970b6785eaad_1768994424_new_@375.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2425, 376, 375, '6970b6785eaad_1768994424_old_@375.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2426, 376, 375, '6970b683bf04a385746271_1768994435_שנות_לימוד_תעודת_בגרות12@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@שנות לימוד / תעודת בגרות12#Doc2.pdf^^שנות לימוד / תעודת בגרות12^^education', 'education', 'שנות לימוד / תעודת בגרות12', NULL, '1', NULL, 0),
(2427, 376, 375, '6970b683c074d053079869_1768994435_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2428, 376, 375, '6970b683c0a28980383099_1768994435_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2429, 376, 375, '6970b683c0bf4223129062_1768994435_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2430, 376, 375, '6970b683c0db7629199021_1768994435_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2431, 0, 375, '6970b6c93dd53_1768994505.pdf', 'pdf', 'decisionapprove0a.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2432, 377, 376, '6970be5b1005c_1768996443_new_@376.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2433, 377, 376, '6970be5b1005c_1768996443_old_@376.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2434, 377, 376, '697756e2dbe20_1769428706.pdf', 'no', 'Doc2.pdf^^שנות לימוד / תעודת בגרות12', 'education', 'שנות לימוד / תעודת בגרות12', NULL, '1', '2026-01-26 11:57:59', 0),
(2435, 377, 376, '6970be664cb58257536350_1768996454_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2436, 377, 376, '6970be664cd5c685535078_1768996454_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2437, 377, 376, '6970be664ceff079274486_1768996454_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2438, 377, 376, '6970be664d0c5582627817_1768996454_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2439, 378, 377, '69722f71794d3_1769090929_new_@377.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2440, 378, 377, '69722f71794d3_1769090929_old_@377.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2441, 378, 377, '69722f7336ff2780363669_1769090931_השכלה_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@השכלה חובה#Doc2.pdf^^השכלה חובה^^education', 'education', 'השכלה חובה', NULL, '1', NULL, 0),
(2442, 378, 377, '69722f73376b0156183830_1769090931_קורסים_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורסים חובה#Doc2.pdf^^קורסים חובה^^professional_courses', 'professional_courses', 'קורסים חובה', NULL, '1', NULL, 0),
(2443, 378, 377, '69722f733791d495944975_1769090931_מקצועי_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מקצועי חובה#Doc2.pdf^^מקצועי חובה^^additional_files', 'additional_files', 'מקצועי חובה', NULL, '1', NULL, 0),
(2444, 378, 377, '69722f7337b43617400897_1769090931_נוספות_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נוספות חובה#Doc2.pdf^^נוספות חובה^^additional_requirements', 'additional_requirements', 'נוספות חובה', NULL, '1', NULL, 0),
(2445, 378, 377, '69722f7337d75386367070_1769090931_ניהולי_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@ניהולי חובה#Doc2.pdf^^ניהולי חובה^^management_experience', 'management_experience', 'ניהולי חובה', NULL, '1', '2026-01-26 08:22:03', 0),
(2446, 378, 377, '69722f733805a195725688_1769090931_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2447, 378, 377, '69722f7338293747569271_1769090931_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2448, 378, 377, '69722f733849b184463179_1769090931_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2449, 378, 377, '69722f7338699530581052_1769090931_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2450, 379, 378, '69723050424a1_1769091152_new_@378.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '0', NULL, 0),
(2451, 379, 378, '69723050424a1_1769091152_old_@378.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '0', NULL, 0),
(2452, 379, 378, '69723051ce918868780350_1769091153_שנות_לימוד_תעודת_בגרות12@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@שנות לימוד / תעודת בגרות12#Doc2.pdf^^שנות לימוד / תעודת בגרות12^^education', 'education', 'שנות לימוד / תעודת בגרות12', NULL, '0', NULL, 0),
(2453, 379, 378, '69723051cf1aa750063263_1769091153_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '0', NULL, 0),
(2454, 379, 378, '69723051cf455990895470_1769091153_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '0', NULL, 0),
(2455, 379, 378, '69723051cf67f723600110_1769091153_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '0', NULL, 1),
(2456, 0, 366, '6975b8d75b15a_1769322711.pdf', 'pdf', 'decisionapprove0a.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2457, 0, 366, '6975b8dfb5fe1_1769322719.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2458, 0, 366, '6975b8fee0f4f_1769322750.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2459, 0, 366, '6977087ad907a_1769408634.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2460, 380, 379, '697708d0c09c3_1769408720_new_@379.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2461, 380, 379, '697708d0c09c3_1769408720_old_@379.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2462, 380, 379, '697708d2789cd969196168_1769408722_השכלה_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@השכלה חובה#Doc2.pdf^^השכלה חובה^^education', 'education', 'השכלה חובה', NULL, '1', NULL, 0),
(2463, 380, 379, '697708d27915e805056140_1769408722_מקצועי_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מקצועי חובה#Doc2.pdf^^מקצועי חובה^^additional_files', 'additional_files', 'מקצועי חובה', NULL, '1', NULL, 0),
(2464, 380, 379, '697708d279365065335921_1769408722_ניהולי_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@ניהולי חובה#Doc2.pdf^^ניהולי חובה^^management_experience', 'management_experience', 'ניהולי חובה', NULL, '1', NULL, 0),
(2465, 380, 379, '697708d27959a981981347_1769408722_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2466, 380, 379, '697708d27974c545501066_1769408722_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2467, 380, 379, '697708d2798db395340636_1769408722_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2468, 380, 379, '697708d279a33147703319_1769408722_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2469, 0, 379, '697708e7af294_1769408743.pdf', 'pdf', 'decisionapprove0a.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2470, 0, 379, '697708eeb350c_1769408750.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2471, 381, 380, '69770aedca409_1769409261_new_test_e355325325@380.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '0', NULL, 0),
(2472, 381, 380, '69770aedca409_1769409261_old_test_e355325325@380.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '0', NULL, 0),
(2473, 381, 380, '69770aef8ead7298833500_1769409263_שנות_לימוד_תעודת_בגרות12@test_e355325325.pdf', 'no', 'test_e355325325@שנות לימוד / תעודת בגרות12#69c072ee-5411-4928-8f49-1ab23b156988.pdf^^שנות לימוד / תעודת בגרות12^^education', 'education', 'שנות לימוד / תעודת בגרות12', NULL, '0', NULL, 0),
(2474, 381, 380, '69770aef8f18c047392695_1769409263_קורות_חיים@test_e355325325.pdf', 'no', 'test_e355325325@קורות חיים#69c072ee-5411-4928-8f49-1ab23b156988.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '2', '2026-01-26 11:57:23', 1),
(2475, 0, 366, '69770e248d739_1769410084.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2476, 0, 366, '69771b886f832_1769413512.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2477, 0, 366, '697741ed2c34c_1769423341.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2478, 382, 381, '697767e18eecb_1769433057_new_@381.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2479, 382, 381, '697767e18eecb_1769433057_old_@381.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2480, 382, 381, '697767ed02fb6209518753_1769433069_השכלה_יתרון@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@השכלה יתרון#Doc2.pdf^^השכלה יתרון^^education', 'education', 'השכלה יתרון', NULL, '1', NULL, 0),
(2481, 382, 381, '697767ed036f2204316228_1769433069_קורסים_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורסים חובה#Doc2.pdf^^קורסים חובה^^professional_courses', 'professional_courses', 'קורסים חובה', NULL, '1', NULL, 0),
(2482, 382, 381, '697767ed03899220902704_1769433069_נוספות_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נוספות חובה#Doc2.pdf^^נוספות חובה^^additional_requirements', 'additional_requirements', 'נוספות חובה', NULL, '1', NULL, 0),
(2483, 382, 381, '697767ed03ad0288580575_1769433069_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2484, 382, 381, '697767ed03cb7870844222_1769433069_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2485, 382, 381, '697767ed03e33734220233_1769433069_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2486, 382, 381, '697767ed03f95072717255_1769433069_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2487, 0, 381, '697768a515931_1769433253.pdf', 'pdf', 'decisionapprove0a.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2488, 0, 381, '697768b04e0a8_1769433264.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2489, 383, 382, '69776ae666b03_1769433830_new_@382.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2490, 383, 382, '69776ae666b03_1769433830_old_@382.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2491, 383, 382, '69776af1ab647266011472_1769433841_השכלה_יתרון@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@השכלה יתרון#Doc2.pdf^^השכלה יתרון^^education', 'education', 'השכלה יתרון', NULL, '1', NULL, 0),
(2492, 383, 382, '69776af1abdb6369005227_1769433841_קורסים_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורסים חובה#Doc2.pdf^^קורסים חובה^^professional_courses', 'professional_courses', 'קורסים חובה', NULL, '1', NULL, 0),
(2493, 383, 382, '69776af1abfad724555836_1769433841_מקצועי_יתרון@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מקצועי יתרון#Doc2.pdf^^מקצועי יתרון^^additional_files', 'additional_files', 'מקצועי יתרון', NULL, '1', NULL, 0),
(2494, 383, 382, '69776af1ac1e1848955282_1769433841_נוספות_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נוספות חובה#Doc2.pdf^^נוספות חובה^^additional_requirements', 'additional_requirements', 'נוספות חובה', NULL, '1', NULL, 0),
(2495, 383, 382, '69776af1ac3ef620431585_1769433841_ניהולי_יתרון@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@ניהולי יתרון#Doc2.pdf^^ניהולי יתרון^^management_experience', 'management_experience', 'ניהולי יתרון', NULL, '1', NULL, 0),
(2496, 383, 382, '69776af1ac65d117477272_1769433841_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2497, 383, 382, '69776af1ac7d8482243091_1769433841_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2498, 383, 382, '69776af1ac960898200180_1769433841_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2499, 383, 382, '69776af1acaf8383269107_1769433841_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2500, 0, 382, '69776b0baf38c_1769433867.pdf', 'pdf', 'decisionapprove0a.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2501, 0, 382, '69776b14a7dae_1769433876.pdf', 'pdf', 'committee_email', NULL, NULL, NULL, '1', NULL, 0),
(2502, 384, 383, '69776dfbee0fe_1769434619_new_@383.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '0', NULL, 0),
(2503, 384, 383, '69776dfbee0fe_1769434619_old_@383.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '0', NULL, 0),
(2504, 384, 383, '69776e071c741937295893_1769434631_השכלה_חובה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@השכלה חובה#Doc2.pdf^^השכלה חובה^^education', 'education', 'השכלה חובה', NULL, '0', NULL, 0),
(2505, 384, 383, '69776e071cf1c801175108_1769434631_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '0', NULL, 0),
(2506, 384, 383, '69776e071d12d615114487_1769434631_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '0', NULL, 0),
(2507, 384, 383, '69776e071d2f8424889154_1769434631_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '0', NULL, 1),
(2508, 384, 0, 'test_697773ef0d478_1769436143.pdf', 'mandatory_test', 'מבחן_חובה_Doc2.pdf^^מבחן_חובה', NULL, NULL, NULL, '1', NULL, 0),
(2509, 385, 384, '69777bee69056_1769438190_new_@384.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2510, 385, 384, '69777bee69056_1769438190_old_@384.pdf', 'pdf', 'form.pdf', NULL, NULL, NULL, '1', NULL, 0),
(2511, 385, 384, '697789dab33ab_1769441754.pdf', 'no', 'Doc2.pdf^^השכלה חובה', 'education', 'השכלה חובה', NULL, '1', '2026-01-26 15:35:39', 0),
(2512, 385, 384, '69777bf9b178b110983716_1769438201_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2513, 385, 384, '69777bf9b198f382459544_1769438201_מסמך_שירות_לאומיצבאי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@מסמך שירות לאומי/צבאי#Doc2.pdf^^מסמך שירות לאומי/צבאי^^additional_files', 'additional_files', 'מסמך שירות לאומי/צבאי', NULL, '1', NULL, 0),
(2514, 385, 384, '69777bf9b1b52760870070_1769438201_אישור_העסקה@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@אישור העסקה#Doc2.pdf^^אישור העסקה^^professional_experience', 'professional_experience', 'אישור העסקה', NULL, '1', NULL, 0),
(2515, 385, 384, '69777bf9b1cda088038834_1769438201_נסיון_ניהולי@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@נסיון ניהולי#Doc2.pdf^^נסיון ניהולי^^management_experience', 'management_experience', 'נסיון ניהולי', NULL, '1', NULL, 0),
(2516, 385, 384, '69777bf9b1eee137137938_1769438201_קורות_חיים@עיעכי_כעיכעי.pdf', 'no', 'עיעכי_כעיכעי@קורות חיים#Doc2.pdf^^קורות חיים^^cv', 'cv', 'קורות חיים', NULL, '1', NULL, 1),
(2582, 397, 396, 'eyJpdiI6Im5Gd3E1djFzQlI2T2VSN3dIVVhkdnc9PSIsInZhbHVlIjoiUEVuSjBoN0dsK1dpNmNtclJMQ3RmcVB1c0J0blFPa1lkWU1GQkJJdU1xRmgxL0J6ZWFrNVpuc0p6Mmo0SkMrUiIsIm1hYyI6IjlhNjA3MWUxY2YxYjUwMjRlMzU2ZDY3NGNjOWMxNWMxM2NkMDk0ODI1ZGFiZDQwNzNjMDRlYmZjMDVlMTAxZDciLCJ0YWciOiIifQ==', 'pdf', 'eyJpdiI6IlJnUVNKdUQ0dUg0VkFkUUUrdXl3ZVE9PSIsInZhbHVlIjoiTk5FWnROOXJIeThLRFVPaVVib0NLdz09IiwibWFjIjoiZmJlMzQ4NDM4NGI5MjBkNWVkODdkZWZmYTQyMGRhYWYzYzNkYmQ2MGJlYjMwNTcyMjk3N2U5NzlhODBhMTRkYyIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2583, 397, 396, 'eyJpdiI6IkZaWkpMZ0NwMlZEdlUxOGI3ZnRUMXc9PSIsInZhbHVlIjoiYzVaU2ZWKyt1ZzBHd3lYbmF5dU1CRHVJcnB0MU44UVNRajk1eVJISXM5Y0pNUDFydkhDVnljaHE3WTVRZ21RWCIsIm1hYyI6IjZlNjgzMTU4MjFiOGFjZDg4ODc5NjQwMWVjZWExY2U3MjdiNzkwMTBlOWU1ODM2M2I2Yzk5MzUxNDUyODFlODIiLCJ0YWciOiIifQ==', 'pdf', 'eyJpdiI6IkVRNUtGMmFXdUIyVGNCTHI0a05xdnc9PSIsInZhbHVlIjoiNUtsSjU3RGY0OE5lbXliNDdiR3U2QT09IiwibWFjIjoiMDU3NmQ4MDk3YjViZDUwYzQwYmVkM2I4ZGZiZDRjMjUzMGNjZWE0MTY4ODM5MjA3Y2NjYzE2NjFmMjUwZmE3NSIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2584, 397, 396, 'eyJpdiI6IkQ4U05oMEJ0WVZZTFY4SUhwMTBjSnc9PSIsInZhbHVlIjoiSGRqZFhuZENOYzAwK0FNb2pUMVlSRUZwdFA5cGNLaHBCc1JXd2h5dGxnc3ZlbDdSRlp4Q0ord1RHSktQYkxQeGt5WnJHK2hhVkkrbEVGQTI3Zi9Vbi8zSnVPRGJGMVYrczdpcTN4UDJoV3M9IiwibWFjIjoiMjA4NmFiYmYwODhjODFlMDI5MmE2ODc2N2U1NTUwNjMzNDM3YWQ3ODE2ZjNjZWExZWQzYjUyOTBjOTZiN2YzNCIsInRhZyI6IiJ9', 'no', 'eyJpdiI6IjIwRms5ZnVoTlNyWjdtc1FUcmdaa3c9PSIsInZhbHVlIjoiYzVsQTJwWnhxQ1hUd0xmaENRS2kyOHJyZHRjNXVxcmNoNzdoUlh0dWNjbjd4NWZUbXluSERkYllKbG5oanowc1BUdEtBZGE0QnJVOFVaTmx4V243bmVvUkFTdTRadkR0enZUSmh0anNKSThTVDhvcFRoS0ovR0Uybk5NcmxVb0JyMVRNTlFITVRqekNUN3pKNmJ0RlcydGYxdjBmL2h6cDZXOUlvRmtjVlNwVDlEOG1jMjJlMXJMKzlVL2E4bXZ4d24yWDI4WGF6YlBoWDBZL0VDcG1adz09IiwibWFjIjoiZWMzMGVmNGFmYzNiNGYyYTNjOGI2ZjIzZTJjODVlYTdjYjA4NDFlYWMzNDBiMmIzMGI0M2ZhM2NkOTk1N2U2MSIsInRhZyI6IiJ9', 'education', 'השכלה חובה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2585, 397, 396, 'eyJpdiI6IjJkKzZBR3l1ZEYxbUVGV1pEVm9nMmc9PSIsInZhbHVlIjoiTnBHNUgxYXQreXMzd3FIb2tWR0VjTmVocWJ0c0x4STNPekFWd01vL0FkY1dXekRUK1hib3c1YU5wZXJ1eVN0WVVRTHVhY3lEUEJ3VlRmV081REFWa01XQVNNL2cycGo3eDhOVWxkVW1XcFE9IiwibWFjIjoiYjQ5OGQ5ODE5YmEwNDA5YjNmOTA2NjEwMjU3NTBiNzQ4ZjIzNzVlM2FhNGJhNTczZGUyODY3YWJiNDMwNjc3ZiIsInRhZyI6IiJ9', 'no', 'eyJpdiI6IitjNHpyRHA4dlVDVFVFbFU4eW1aanc9PSIsInZhbHVlIjoiaFNxZE9vN3NrYUo1QnZFcDVoRHA2NWc2b3pSMVUyeTdBN2R0QTZWN2c1YkxMYThQK1pNd25NU1RuZnRUUWxyRGRNV2h1SHZ1WGJPUjhRYTBROGlZbFFyR3U4alBRYXJrZCtuY25sY0xIc1A2VDcrT0FVelJOb3F5cm9MV0hqR00rcVlDYyswdEd3V2NJRmNydU1CRlQvdnQyUjJMOXpMbHJzTXpMSjlHZ2pVYnRjL2NuaVVPdGpEVTBCWlRGOHVKTTZTV0MxRFN5OSt0cFlYMHRLR3MvWUxFOWRPejlad1lUUHJvaHlHLzZCdz0iLCJtYWMiOiJmMzg5ODc4ZDdmZmE1NDJjMmZhMmQwYzZmYTViNWZiZGEyMWQ5Y2M3OTM3NTQxNTEzM2ZiYWQwYmQ4NDQwNWM0IiwidGFnIjoiIn0=', 'professional_courses', 'קורסים יתרון', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2586, 397, 396, 'eyJpdiI6IldSVDZPTjdaeGZFcDVjMThsaTlPRFE9PSIsInZhbHVlIjoiOUpDdU94d1BkbkV0Z1BOdW1ZbHFPS3lYeHJ2WUF6V2hkQzdtQzNHVkNSQ0ZSQ2NRd01LWXdib2FSZjhkQ1NaVzBMQU05RU1Fa2k2ZVRoQ0p2ZHFPOTlUUkg4NVNSQnI5ZmcrRXVCRVo2T0k9IiwibWFjIjoiMTI4MjFhMTk3OTMwNmEyMmJhYmEyMTdkZjg4MDQ1YTJjNjcxN2U5YmQ3NDI2ZjM5N2M4NzcwZTY2YjBiYWE0NSIsInRhZyI6IiJ9', 'no', 'eyJpdiI6Imlkazd2QVF4RFNxejZ6NHZWU2creXc9PSIsInZhbHVlIjoiSllhL3BrUHZhbVk0anpybm04Q1g4aHlRL2kxUUQ2ODU5bDhxaTJOdlhyNi9WZ2owTXZzKzhrcXhML3g1SjhITzBEU2tTME84bjExZHJrSVM5NjkxWXFqRXBQbnRpOGE1OC9oemtqZGJ6dkhGTGpSejJmL2hPMkhKaGxBRlNGMVdDbDlJb1Evalg4U25WUEpiSDMxekZSWGZKN1VpRXpVWmdSVUxxSWo4VU9VYm4wSnlKeHVQTkNuc01xVW9EUU5xUmFrc0Y4TVlHbWFoWXRpM0xRTFB4UT09IiwibWFjIjoiYWNjZGVjMWNkNzJiMWZmYjc0ZDlkMzM2ODdmYjE2ZTQ5YjIzYzBmZjc2ZjkwMDQ4ZjYxNDczMzM3Nzc5M2UzMiIsInRhZyI6IiJ9', 'additional_files', 'מקצועי חובה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2587, 397, 396, 'eyJpdiI6Im5EZHR1eWRxbTFUK0JWcFY1WW9iSXc9PSIsInZhbHVlIjoiMjRBcjFmRldlUFF1ZGZZNjlBZHlEdGxEaURmMHJvaUhWTnFNUzRhMjIrbnFqK1EycVdaZU5RdjluY1NLZmlMTVd4ZlRmUWZWWURkbFhMZkxZWVFvUlhPQmJZbHI2UUdnM3ViRmJINmFzVTA9IiwibWFjIjoiMzg2MWZiNWJkZTI0NjVhOGY4YjA0ODVmMDY3Y2NmNWNlOWJhYmMzMmQ5NWUwODhkMzlkZTIyYjRmMGI4Y2JmNCIsInRhZyI6IiJ9', 'no', 'eyJpdiI6Inp0NHh5V0J2aEVkeTZLa2g3RkxrbFE9PSIsInZhbHVlIjoiWEtINkxWVXdhdHR6SDFYWE90Uk0xUE5FZ2dZeGFmeGVJYXNlT3BOSFdBTlcxLzFaQStwNjhzV1NnYTRuVWlaVkQrL0gyZjdwZzVXVGxqWitDM0JuV2RpZnJSMzBZUjgwQUxtL3p4djgxR0lGMG4rOS9wdDhZdkdhY2NEUDJjS1J5UW5DK2NyOE5CQWNJZGwxa0VSZVQyaFJ4MHM1NzZuZ0xFbWNDODdkUGNBeWFzSXZCV3ZadWY2RkNhbzR0MzZzeEN5LzhPdERTb3RGQkRNanJpZUV2NE12bjFRWStqSmR6bExJNjRFWFNKUT0iLCJtYWMiOiJkYzZmNzMyNjNiMjMyNmFjOWMxYTZhNzMwNWNiNTY2Yzg5NjYwZTMwZjRiNzIyYmFlNzUyY2UxOGZjODAwMGQxIiwidGFnIjoiIn0=', 'additional_requirements', 'נוספות יתרון', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2588, 397, 396, 'eyJpdiI6Ii81UmpRUDZFUjBsVTNscXpSSThRWWc9PSIsInZhbHVlIjoieW9EcGNiUkRXdnV4UXBKbDAxNXpFZ0FGREl6RUl1V20zLzk2N0Jvck5GMU9BL0wvZFc3M2tNQlVDS21iYTA1TmplSnZCVWZucU5HNndGdmR5dkZ3TFhubUxSVHBQTEI4SW5VREhneGo1a1E9IiwibWFjIjoiMmUxM2MwYTY3Y2YxNjk5Y2FhMmE2YTVlMGI4MDk2YWJiMDczZWVjOWYxMDBhNzFmNjVmMDYwYWRhNTQ5MDAyZSIsInRhZyI6IiJ9', 'no', 'eyJpdiI6InQ0bnVSd1NFYWNLY1A3TS9WWUU5enc9PSIsInZhbHVlIjoiUThZV0lwQndPdTZBQ0o4UFZBMEVuUmF4Um40dlh0cGZtTTZKc3hENnRWbncweStZcVpLMWhGdXdGdEhtS25CNkY5Zy9NMEhrSEhSVUQzQ3ZpbUk0NGpJZlRFZGxvSlpHUVEvVHZCenhNUk5oR085ZFN1NXpMUDFicU9leVBKVWpnQ2FXeXk3WWpqdVEwK2d0ZHAzTERxTzNsT0doQnhtSGVqWHc1SE42ekErRUtCNEZZczJSOEEwOHFVdFFsMHpvVngwaW0rdEo5QVZDUFJIN2tMRXZhRHVHcy8vUzlFYVRvYThWQ3RSZ2lFcz0iLCJtYWMiOiJjNjc2Njk4NGE1NTBlNDgwYjM4YWU1MWE2MGYyZGM4M2VkNmNlODFiNDBmYzZlOWVmNGY5OTUxZmQyNDM3ZTExIiwidGFnIjoiIn0=', 'management_experience', 'ניהולי חובה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2589, 397, 396, 'eyJpdiI6InNJcU13ZEN5Qm1FcWtvMEtXNUxsZUE9PSIsInZhbHVlIjoid2F6a0tVVE01N2lnZkIvV0UwTTI5ZndESDNBRmVZTjgvemlpcnRUa2Z5NHd3amRoVEVCRXZaY1RrWmoycTA3TmloNVpDVmVnanZETkpPaE55MnJXdm9nbGk1VXBhM0M1dVRaaThqNVlSWDA9IiwibWFjIjoiODI5NzkyM2IwYTk3MzE0YjVhNTk5MTIzM2ZkODBjMGI1NDk2YzliODI0ZDJlMTEyNGRkZjJlOWQ2N2YyZjY1MSIsInRhZyI6IiJ9', 'no', 'eyJpdiI6IjlMM3ZpT1g0MXRKT3kvQzBqWWNvZFE9PSIsInZhbHVlIjoiUnZFcGlxWk9RN2NQNXN3a2pDRmFUb3BPY2NDaE1yTmRNTzhlZ01vWWpJVmhpT2VXb0VZcG0wTjhUTkQ5Y24venNVWmx6N1h4bDZWRXZrbVcyaGFoMS9YNWpnc1RXeG1ZRHRVaEIrU3hDWjB1YjgzZWJwSjdpTnh1WVd1bDFIS0JNUkkvVDR6WGh0N3dRZ3lyR0xkN1NSR0dkT2l2UjEzUHpUSWhrYmUrclltVDRoL20rYXY5dXovTFl3TTZxRzVWIiwibWFjIjoiZGNjM2VkYzlmZmViM2U0ZDY2MDJiNjc3ZGJkOWJjNDI3NjUxYjgyZmQ5ZmE0OTM4MTUwNTMxYWRiMDcwOGVmNSIsInRhZyI6IiJ9', 'cv', 'קורות חיים', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 1),
(2590, 398, 397, 'eyJpdiI6InBCYlBaTURuRTlGcEZhOUJiSEE2eEE9PSIsInZhbHVlIjoiL0FwWEc0NWk3ZDJuNFhvdS9XMXdnbDNudGhGYi94ZFNQdzE1K0pGUjZRVGwxZWdiVTdXTWx1dkdORlNjc2tNSiIsIm1hYyI6ImI4OWNhZDM5NTU5ZWU3ZDljMzA4ZDFmZmYzMDkzMjIyYWQzODcyMTkwYzgwNmM1ODNkNjYyZjdhOWNmNjM1MzUiLCJ0YWciOiIifQ==', 'pdf', 'eyJpdiI6ImlIZE9WaU0zeGtVYjY5NExMOGVaN0E9PSIsInZhbHVlIjoiN0hncVZZRVZxSU1jV21FaktXN1czQT09IiwibWFjIjoiOTc4N2ExZWM5YWJhMGM0NTllMjc4YjgwM2ViODcyYTM0YjRhOTY0MDU2OTM2NjI3ZDJiM2Y2ODE5NzBkOTY5NiIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2591, 398, 397, 'eyJpdiI6IkJUdVZpU1RIWjV2OFZiQ04zZDZuaXc9PSIsInZhbHVlIjoicitDanlCOWdWSWhUdlNrRmZ3YTlWM2FQd2s5cjNuMnhodHlpRlJJYmJ4N1RZdjJQQlJ2dWVzRDRYSDZnL0kwVyIsIm1hYyI6IjNiZGQxOTZkMWZmYTQxZDFjOWY0ZmI0MDU0MmE3YzcxZTljOTc2MmM2OGY0OGQyZTI3OTFhMmFjYWMxMTM3NDMiLCJ0YWciOiIifQ==', 'pdf', 'eyJpdiI6Ik5NOXFSZUFlNERTTkMwNXBRL3h6dGc9PSIsInZhbHVlIjoiY0lzMkcvNkhrV3ZJYVM4ajFCUkpmQT09IiwibWFjIjoiZTZhNjhjZDRjNjI0NTMyNzc1YTk5NzBkZjU3MzhkODRiOTM2ZGYzMTk3MTU0ZWMyYjFlMzRmYjc4YjQ2OGY5ZCIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2592, 398, 397, 'eyJpdiI6IkpFTDdFZnRCV1duTEtSeDRJT0NxcWc9PSIsInZhbHVlIjoiRzM2M3dOWVhmVW9DSTk5YlYwZ1BRQW1rWkpjWVN3S1JvUHFrKzkyQVFiK3ZTNk5URmJkL0x6a3B3c1RlVnZhbHVibVB0SGN2OXU0ZjVYVGZzc2UxMU5TYnFnTExxYTlsaFFEWlBHVk9xTHdSd2taNGxLbzVDamVIMEsvN2JUV1QiLCJtYWMiOiJiNmJhNjZlM2Q4NzNhMDZhNDliM2Q4ZDU0MTU4MzI5OTk5YmU3NTY0MjEzMWU5ZGQzZTVkYTE0YzA5ZTVkYjU4IiwidGFnIjoiIn0=', 'no', 'eyJpdiI6IlJSZmpoRFh1RHg5dkRCVDFFd1Z4MGc9PSIsInZhbHVlIjoiNENyRHFURGlycTY0NHAwK29XditYQ3pCNEtQRDVkeFZMelNPb2FpL3FSVzlzSjdPZEhSRWE2RFdNRWRURTVtbUNJSk4xUDB6WW8xM0xUWmxnSFFOVXo5V0wyNC94MVJmM1Jjelp5Um1MdHVMeXd5aXZkMUltaE8vK28wMWt5YWciLCJtYWMiOiIyMjFjNmZmNGQ1YjZlZmYwNzE2OTljMGVlOTNiMjQ0MDRlNmU1N2Q0MGM2Yzk4MzE3MzBjNjFlZmE5NWQyNjFiIiwidGFnIjoiIn0=', 'education', 'השכלה חובה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2593, 398, 397, 'eyJpdiI6IjVORC9yYlNjaHhaRUg4SHVURThER2c9PSIsInZhbHVlIjoiV1FmZTFoS1IwWnVDOW5GclNRUm5aYjcxOVJVT3FQVlhxL3ppekQ1bjlUK096MFpPY29iNndVdVRvcEtsQWZSTVR6a0lXclNvTDBoa1E2SDdTZHJwNG85d0hPRVhlY1Y3blVNU25hbW5hTlViSmlpZ0xUTHZET2svVVRtUDFaeVIiLCJtYWMiOiJjOWE4YzM4NWU2ZjY1OTM2NTc0ODBiNjA4ZmY3NGIzNzBhZTMzMTUzY2Q3NmY0ZGZmMWFlM2Y3ZTEwMDk2MWQ2IiwidGFnIjoiIn0=', 'no', 'eyJpdiI6ImlqdDFnUFU3Q2pBVExjM0NrMEplcWc9PSIsInZhbHVlIjoiaWNMbVJMODBNKzEzRXJ2a3N2dHFBeSs5RDU1WG5rMHhORC9KV3JHL0lGV2tKRy9WZWN5YkpCYVNIdGk2K3hOaEJzdEc4N09TQzJ6Q0JacnBvNXdNZUNkQXZ3SG82VnA4QUFGSjB0R1F0TnB2bUVrTzUvclp0RVpJZlhKZFVlaUxrWUNZUHNYOGdwZUFOaUNGS2NmMjNBPT0iLCJtYWMiOiJmYTM1MjY3MTJiZjU1MTg2NmIwODQ0MzIzYWM1MDIzOGZmNjFlY2UyM2I2Yjc2NGQ4ZTBlNjFjNjkzODNkM2M4IiwidGFnIjoiIn0=', 'additional_files', 'מקצועי יתרון', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2594, 398, 397, 'eyJpdiI6Im56amIyNWZRNFU4U2xwZGZOU2lwN1E9PSIsInZhbHVlIjoiemk3ZUJzYlMxZ1czRG1zUUlIcHBSTFN5QjJqTGZvYmsxZU4xSitkVEg1QlVuV1ZWSUNibHNna1RIdGtMWUt6REdtc28wUWJBSnY1bFBNT2FoUC9iZWJnQU9RS2crckxMS0lia29FdGl1RXpFRGxoUWlWa0JFQ2d4WWZ2aEltczciLCJtYWMiOiJkNGNjMTRhN2FhODQ4OTVhOTIzNjAyYzg5MmY5ODllODdiNDRhYjQ3ODIzOWNkNWEyZTk0MGQ1MjkyMThjYTAzIiwidGFnIjoiIn0=', 'no', 'eyJpdiI6InJXNVdPRHFhd0pUU0tibS9oaVFReWc9PSIsInZhbHVlIjoiekp3UGN0dElPSm80eDJCNklHcCtoVkhibUx4Z0xTV3NydXZIR0pIdm5pMmNRZGUvNmozcXRQQTBOTUJnVlJ2bTBPV09IRVJSZ1Zibjl5WUpCTU4xbzRWejZCdFNSOSt5dnJyNGhVWFA4QXFhTHdKOXp3MFo2UlhLSTgzTE84R0ZtbDJtcGJnbjdZcUZNZDJXZmF0Uml3PT0iLCJtYWMiOiIwYjU4ZDU1Yzk5M2YzNmE1MDcyNTJiOWRiMzVjMmNmZTU2ZjI4ODVlZjIyODQ2ZGU2ODQ5MDA1MjI5M2E4NTZiIiwidGFnIjoiIn0=', 'additional_requirements', 'נוספות חובה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2595, 398, 397, 'eyJpdiI6IklMR095YXh4eVU3cC91RDQwTXV0SGc9PSIsInZhbHVlIjoiREhCazdidzJLVCttNjNrRGs3MFIyMkpoZlcxcXdGcFNhc3FudGRNZkJhb2gxTVNSSEs1emd2cXk1cURjcFIreVExSmdneTRIT2IvYTlDdDlFc0ZsNXRyb1Y5UFlsbXZHbXJYWEpkVGljd2hrUWE0RHhNT0tNcUpOTFJqUlVucHYiLCJtYWMiOiI1YThlOWE5ZWZjMjU5YjgxNmQzZTAxZjU5MDMxOWZiNzIzMzk0OWJkYmRjYjgxODViMTAzNmIxZGRmOWZkOGIwIiwidGFnIjoiIn0=', 'no', 'eyJpdiI6Ijdmam5UNVhxdnA2UDZSQWc3WThyY3c9PSIsInZhbHVlIjoidDhSeUZROEdNQW1uNkNKU2JwbzZ1UTNodTJuUzFhMkduMlRkYWhXdDVaZW9xaTV0TTJLZHAzS0l1QUdPZDlJc3FDKzlTVDRZSWRmdVpOQjJ1RjUvdk9kOFNKRHNrM0tJMWRxWGJqMHdBTlZvRkpVY0FuOVhXUDRJcGNqNUIxRmxhMVhiT2xsSjhORlJPaEFtdGk0cHNnPT0iLCJtYWMiOiIyYzY3MDQzZTY0OWU5ODUxMTM1YmEwZGFhNTFiNTg2YjYxMThhZmUzZDU4ZDYyMDljYTJmY2NjNTUwZTQzMjlhIiwidGFnIjoiIn0=', 'management_experience', 'ניהולי חובה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2596, 398, 397, 'eyJpdiI6IjZ4ZG1jNHZlamRSRTNWcE9kOFpYaUE9PSIsInZhbHVlIjoiZkF4MkphSG5JSFNlRU9VM0Mrd20xUnlTZm0zVlpLeVpaQ2JDdWhTc0EyNEZTV0tBYTlzZm8rZ3JDVzRJRlFHNklIWlJVcGFxc0VONVcvbFRMVkx2TEpIOUMydUFWOHdRNlpBRHZRYzRicGtEdTFZS3pJZGIxMnhlTC8vTWVRckIya0RJVjc0d1RiekxnTG5lQjB3VVlnPT0iLCJtYWMiOiIxOWViMGQ2ZjUwZTBhYzk1MWRmYzNlN2RiOThiM2I2MTc1YzQ1ZmY2NGY0YjlhN2U3NmZkZTA2YTgyODc1NTUzIiwidGFnIjoiIn0=', 'no', 'eyJpdiI6ImdNZ2o0b0lHUXN0QVlzME5sbWZOSWc9PSIsInZhbHVlIjoiNEMzbThuOHU1c2JLZVZRRWNPNXJNclZyMGxWMVZKYzlGTkQ4bXRITVJSYWJqa25lZkFwTXd4RkY3aUpyMXZZSm1UZStxUTlES0hSYkhTWGRha3ZqNjlUVSt4dy9HQ1ZwVkM5YVBVWWl3ekdIdXBSWVVIMUw5bC9hRDdRc1N6Z0l4d3plbGJOQ0F2RUQrcXpZb25Ta2x4cTRJOWloL2RXWDBIR25FNXM4b1dYbjl5NHdvRXJlQzB1aEx0WFk2NDFuIiwibWFjIjoiZmJhODFlOTAzZmQzNzg4MDNjOTcyNDJmMWY0NTQ1MGZlYzViNzBjNDIwZjk2ZWY0OTNkZjBhYWM5ZTIyZDE0OCIsInRhZyI6IiJ9', 'additional_files', 'מסמך שירות לאומי/צבאי', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2597, 398, 397, 'eyJpdiI6IjN6Kzg4TWpPaWVmTVVCZUFCRHkwK3c9PSIsInZhbHVlIjoiM1ozcjZJTHE0UzUxOHpZTm90SVMxTXZtYzViSTNvRDlWWDF4Q1VTYzBtT1BGV0hkUkROZ2tPQlVPaHpCcWdqdkRpcnBOVldvcUhvMnI0bXcxbW1Qd3diR0Q4MTF1RGpLU3hSZkNzMDEwZUxIWE0wSUZnM0pobEcvY2c2VFFOeFkiLCJtYWMiOiI2ODExNTAyMzNlMThmMzc2ZjM5ZTIwM2I4YmQ3NmU4OThlMjgzMTI1MGZhM2E0OGQ4NmNiYjI2M2NkOTk5MThmIiwidGFnIjoiIn0=', 'no', 'eyJpdiI6ImFPUExYdmp4QmppalFub0RUSVFPN1E9PSIsInZhbHVlIjoiMW03UVZxdDJhdXpnN3kzeUNDRGprVmoxUEFlYnl2dWxSZ3Aydjc3OGZVcFg2OGtSSHdhUngwQmVROTJrQk1TYnJrRUtPQmRQTitxTXlpR1JObkM4ejRJZEFjY2c5L0pzSG1PbVdkUE9OMEhxVWxEVHlZeFBWT0dsVnp4cTlYR3g3cFpMd1dWUC9IQjlXbEpNaTBnTHdBPT0iLCJtYWMiOiJjZDQwMzg1NWI3ZDlkMjZmY2FiNThjZjk4ZmMzYzM4ODQ0MjExYjI4NjVjZjc0MjIyZDQ0YjUyMDFkY2U1OTE5IiwidGFnIjoiIn0=', 'professional_experience', 'אישור העסקה', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2598, 398, 397, 'eyJpdiI6Ik1zY1dKL2pGWldCcWluQWY2ZFFwK2c9PSIsInZhbHVlIjoiK3FkdEpOMlc0UWxXb1ovcTJHRlhUTURTRkNteVl3SThWbFdJcEhMdjZSekVPSWRuQXFYbHdrc1RVVTZBeXMwSlRlVm1Tb0pkL3paSUIzV0JBZnhoL2JPSjI5ai9naGwrMzgwdWhGTW1JaE5KWTUyT0pBNEdZdndsWHdGcVdBVVEiLCJtYWMiOiIzNGZjM2E3ZDI2NDliOTQ5YjYzNjUwY2YzYTQ1ZmEyNDA5YjhiZTA5Y2Y3YWVhZDA3OGMwNjU4YTI4ZmZhZTk0IiwidGFnIjoiIn0=', 'no', 'eyJpdiI6IkhUbzlYbnd0M1dGc0d4cDNJRDVhR1E9PSIsInZhbHVlIjoiVVBlYlpnOGxodmkreTlEUGdJWU9KMTl2SlpvdFNxb05lYjcvY09mVXFzOWNhYWU3MFhPUk5MK2Z1ZlRWUWQ4VHl5SXpDRWIvVElBSHJQMHpDWTQ1RDFQNXN3cVBycWttMlc3WDd0WVJqNnAxVGp3SXBrRTEyZ2grR0dQdmI2b3l0bE56T0hNV083cko2WWFXLzV6T3NRPT0iLCJtYWMiOiI2Y2Y5YWFjZGZjNmY4ZTUwZjE4NmFhMjFiNmM2MzE1YTE1YmI1OWE4OGM1MDBiMzM1MzE5YzAzMzE4ZmI2MTllIiwidGFnIjoiIn0=', 'management_experience', 'נסיון ניהולי', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2599, 398, 397, 'eyJpdiI6IlVqZFptc1h6S1N2dXc3U2RVSkREa1E9PSIsInZhbHVlIjoiaDN5SlRsYXhtNHNDTjViTDNaa0U4ZlBTMHY0Vm5HM1JHUUdZVjdvRXIvWlZDcFlSSmJSc0VYcWcyTU1XWERXOWJ2VlFOWXpaclA2Ry9tZjNsdFRDVWpQTGM0emgrUnFuUnZjUnp6UEk1NG1YYlBTcHlqSTFoek9aeGQxdHM3eVkiLCJtYWMiOiI3MGMzZDNiZDBkMzJkYmMwYTBhNjJiODIyZmI2MzYwMjIyMzM1ZjMzNDBmMDZmMzQzNmQwZjY3ZWE4ZjJjNzQxIiwidGFnIjoiIn0=', 'no', 'eyJpdiI6IkdFSDZWTGZDRFMzR1dFTitZNjR0emc9PSIsInZhbHVlIjoiVUF1NllPdmk4S0d0QnFZUXAzNnRjS05lQlMwUmVXQ3B2NmdWYm5IaFZUdTRqV21IdTdmZDVYWlVmcCtsczNiUUhIYVhYZ01zYjhmMDZZNFFuSHJ5Vm8vNzVYdi9PWDVBZWlxQURWdzBiSUE9IiwibWFjIjoiNTI3M2IzM2RjNTFlNTA4ZWJkMzkzMzhmYmI4Y2EyM2ViZjVlYzMzNWFjNmJhZTFiZjJkMzM3ZGNmOWUyNTM2ZSIsInRhZyI6IiJ9', 'cv', 'קורות חיים', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 1),
(2600, 0, 397, 'eyJpdiI6Ik5Qdk1VV25uRzlVZG1kaHFqbW5XNlE9PSIsInZhbHVlIjoiVmNwTWd5aDduVkFiMEVxRkY4Rmc1VmZtWDNhTFE0YS9qS0pzQkJRZjJZTT0iLCJtYWMiOiI3NjViOTU4YWQzMzViZDM2OWY0OWU4ZmZlZjc3MjEzMTQ0MDZkMzlmMWJkZTYxMDFjYTVjY2IzYTJkMDY5ZDBkIiwidGFnIjoiIn0=', 'pdf', 'eyJpdiI6IjFCdGdveGJCeHFoTjhQakFkT21ocmc9PSIsInZhbHVlIjoiMDdHaEtiM09keHA2dGdoNjBidytwN3cvWTJwOWlwblNYOHJOU0tuVno1ST0iLCJtYWMiOiI4ZDQ5ZDA5ZTMzYzg4ZTU4OGVjNGFmM2M1ZWU1MDI4MDQxYzg3NjFjYzM5MjJmZjY5NjQ1OGZkMDI5MDQ5ZGZjIiwidGFnIjoiIn0=', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2601, 0, 397, 'eyJpdiI6IjhFbmdGSVRtZGlHeXlaRXRxV3dHNFE9PSIsInZhbHVlIjoiUkdHQWtQSFNBdXhvRXJFZHBIRW5qYzBacEEvdE4ydHp3TGVSenRocC9XYz0iLCJtYWMiOiI3YTgyNjJmYTkwNzBlYTgzZjFmNDVhZWFlZTk5OTUyMDU4MjQ0NGFmM2EwNTYxYWNkYzZkZGQ1NGIzMmE0NWNhIiwidGFnIjoiIn0=', 'pdf', 'eyJpdiI6IkFGakduUnJYbjg1UG5KeVFlb1BwMkE9PSIsInZhbHVlIjoidkh1NFdNRTZraHlFSlFJNWI1b2l1QT09IiwibWFjIjoiYzFiNWNmNGQ0NTEzN2Y2OWI5NTNmYzdiZDIwZGIyYTNmNWM2NGVlMjk5MThmNDAzZjhlMjc0Njk2MmM0MzFkOSIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2602, 0, 397, 'eyJpdiI6Ik5xL2I1R3NnZEpDa2lWSmNaczdBc1E9PSIsInZhbHVlIjoiakVVYTFGcGtjbHBkaVNGL3FpS3pkUysrRHVxa3gzZGFMc3pDWHdTZ2JxRT0iLCJtYWMiOiJiZGZmMDUzZWI2NzRjMDFiMmZhNDI4NmQzNjg3MjAyNmY3Mzc0MzM3MjZlOGMxYWRmNzY5MTZmMmI1YjIzMGQ5IiwidGFnIjoiIn0=', 'pdf', 'eyJpdiI6IlUzU09TNFQ3b0JYSjYwNjUzbWswcHc9PSIsInZhbHVlIjoiRmo4R0x6Yzh2MXZ2WnYveHJTbWZadz09IiwibWFjIjoiODE0ZDNkZGY0NjA1MWE4MmU0NWY0Y2IxN2MyY2Q4ODBjOTRmMTkzMWIyYTg2NmEzOWQxNWU0YjhjNTBmODExZSIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2603, 0, 397, 'eyJpdiI6Ik1HQ0JqRFcvZFRQcUp3MFVDdSt2TlE9PSIsInZhbHVlIjoiR3JKcFBKZFU1N0ZxNm9lRXg1enFFSmJ6bnhhSHFHMEc4QjArZVhySlVHOD0iLCJtYWMiOiIwNjQ1Y2Y0NWZhNzc4ZDIxNjY0MGMyZTY0NTg1N2FiMWRlMmYzMzQ1ZTBjZTQwNGJiMjYyNjBiN2UxNTgzMDc1IiwidGFnIjoiIn0=', 'pdf', 'eyJpdiI6IjBTS3BZUlJLblpmYWsvRmVHbHB3M0E9PSIsInZhbHVlIjoicUFITDVBVnZ0OWVhY1JDRHJ6empWQT09IiwibWFjIjoiNjMxYzRhYjk5NmUxOGYwNDBjMDQ1YjBjZjU5OThjYjY0MGNhMDFmYmFjNzMwMmEwNTBlODIxNzFiMjk3YmJiYyIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0),
(2604, 0, 397, 'eyJpdiI6IlZjblpUek1JbmhrWlRFeGYxeGpxemc9PSIsInZhbHVlIjoiVmR6eFFLZTFHSVNrclBjYkZ3dEY5QmdHbTBQOW44ZkV3VDJNL0JKL1RWcz0iLCJtYWMiOiJjMzEzZDViZjI3NmE4OGE4YzA0NGI4MzFmZjdmZTE2YWRjYjZmZGM3MTFjMmE1YWFkNDNhZDExZDYxMjhlNTViIiwidGFnIjoiIn0=', 'pdf', 'eyJpdiI6IkowbGlMeHF3Z0psVFFEZ1RyNEE0d0E9PSIsInZhbHVlIjoidkt2QnptNDQvQTJLN1BTRmEyQVN3QT09IiwibWFjIjoiNTVhODQxNDFjNGE1ZjFmNDliZDIyYTEwYTM3Zjc5OTYyMmY1NzE4YzczMjkzZGY3N2Y0MzBkMTJiNzU5YzcyOCIsInRhZyI6IiJ9', NULL, NULL, 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=', '1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apps_logs`
--

CREATE TABLE `apps_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(11) NOT NULL,
  `l_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `tender_id` varchar(20) DEFAULT NULL,
  `is_note` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `apps_logs`
--

INSERT INTO `apps_logs` (`id`, `app_id`, `l_date`, `description`, `status`, `tender_id`, `is_note`) VALUES
(1, 0, '2024-09-22 14:57:42', ' מכרז מספר 2024-101 נוסף על ידי ניצן פרנס', 1, '2024-101', 0),
(2, 0, '2024-09-23 11:17:59', ' מכרז מספר 2024-102 נוסף על ידי ניצן פרנס', 1, '2024-102', 0),
(11, 0, '2024-09-24 13:07:31', ' מכרז מספר 2024-103 נוסף על ידי ניצן פרנס', 1, '2024-103', 0),
(12, 0, '2024-09-25 10:33:34', ' מכרז מספר 2024-104 נוסף על ידי ניצן פרנס', 1, '2024-104', 0),
(13, 0, '2024-09-29 09:42:44', ' מכרז מספר 2024-104 נערך על ידי ניצן פרנס', 1, '2024-104', 0),
(14, 0, '2024-10-06 09:59:19', ' מכרז מספר 2024-105 נוסף על ידי ניצן פרנס', 1, '2024-105', 0),
(15, 0, '2024-10-14 10:27:42', ' מכרז מספר 2024-106 נוסף על ידי ניצן פרנס', 1, '2024-106', 0),
(16, 0, '2024-10-15 09:23:48', ' מכרז מספר 2024-104 נערך על ידי ניצן פרנס', 1, '2024-104', 0),
(17, 0, '2024-10-15 10:19:35', ' מכרז מספר 2024-107 נוסף על ידי ניצן פרנס', 1, '2024-107', 0),
(18, 0, '2024-10-27 08:53:46', ' מכרז מספר 2024-107 נערך על ידי ניצן פרנס', 1, '2024-107', 0),
(19, 0, '2024-10-27 08:54:02', ' מכרז מספר 2024-104 נערך על ידי ניצן פרנס', 1, '2024-104', 0),
(20, 0, '2024-10-28 10:53:14', ' מכרז מספר 2024-106 נערך על ידי ניצן פרנס', 1, '2024-106', 0),
(21, 0, '2024-11-03 08:36:33', ' מכרז מספר 2024-108 נוסף על ידי ניצן פרנס', 1, '2024-108', 0),
(22, 0, '2024-11-03 08:37:08', ' מכרז מספר 2024-104 נערך על ידי ניצן פרנס', 1, '2024-104', 0),
(23, 0, '2024-11-03 08:49:42', ' מכרז מספר 2024-109 נוסף על ידי ניצן פרנס', 1, '2024-109', 0),
(24, 0, '2024-11-03 08:53:04', ' מכרז מספר 2024-110 נוסף על ידי ניצן פרנס', 1, '2024-110', 0),
(25, 0, '2024-11-03 09:02:53', ' מכרז מספר 2024-105 נערך על ידי ניצן פרנס', 1, '2024-105', 0),
(26, 0, '2024-11-03 09:17:22', ' מכרז מספר 2024-111 נוסף על ידי ניצן פרנס', 1, '2024-111', 0),
(27, 0, '2024-11-04 07:37:27', ' מכרז מספר 2024-110 נערך על ידי ניצן פרנס', 1, '2024-110', 0),
(28, 0, '2024-11-04 07:37:45', ' מכרז מספר 2024-108 נערך על ידי ניצן פרנס', 1, '2024-108', 0),
(29, 0, '2024-11-04 07:37:54', ' מכרז מספר 2024-111 נערך על ידי ניצן פרנס', 1, '2024-111', 0),
(30, 0, '2024-11-04 07:38:06', ' מכרז מספר 2024-109 נערך על ידי ניצן פרנס', 1, '2024-109', 0),
(31, 0, '2024-11-04 07:38:19', ' מכרז מספר 2024-105 נערך על ידי ניצן פרנס', 1, '2024-105', 0),
(32, 0, '2024-11-04 11:51:23', ' מכרז מספר 2024-104 נערך על ידי ניצן פרנס', 1, '2024-104', 0),
(33, 0, '2024-11-04 11:51:31', ' מכרז מספר 2024-107 נערך על ידי ניצן פרנס', 1, '2024-107', 0),
(34, 0, '2024-11-04 11:59:03', ' מכרז מספר 2024-107 נערך על ידי ניצן פרנס', 1, '2024-107', 0),
(35, 0, '2024-11-06 10:10:23', ' מכרז מספר 2024-112 נוסף על ידי ניצן פרנס', 1, '2024-112', 0),
(36, 0, '2024-11-06 10:14:42', ' מכרז מספר 2024-113 נוסף על ידי ניצן פרנס', 1, '2024-113', 0),
(37, 0, '2024-11-06 10:15:01', ' מכרז מספר 2024-113 נערך על ידי ניצן פרנס', 1, '2024-113', 0),
(38, 0, '2024-11-06 12:08:18', ' מכרז מספר 2024-112 נערך על ידי ניצן פרנס', 1, '2024-112', 0),
(39, 0, '2024-11-13 06:48:36', ' מכרז מספר 2024-106 נערך על ידי ניצן פרנס', 1, '2024-106', 0),
(40, 0, '2024-11-14 06:56:24', ' מכרז מספר 2024-104 התחיל על ידי ניצן פרנס', 1, '2024-104', 0),
(41, 0, '2024-11-14 06:56:27', ' מכרז מספר 2024-104 הופעל מחדש על ידי ניצן פרנס', 1, '2024-104', 0),
(42, 0, '2024-11-21 07:33:17', ' מכרז מספר 2024-106 התחיל על ידי ניצן פרנס', 1, '2024-106', 0),
(43, 0, '2024-11-21 07:33:22', ' מכרז מספר 2024-106 נעצר על ידי ניצן פרנס', 1, '2024-106', 0),
(46, 0, '2024-11-24 08:25:03', ' מכרז מספר 2024-107 נערך על ידי ניצן פרנס', 1, '2024-107', 0),
(47, 0, '2024-11-25 10:43:26', ' מכרז מספר 2024-114 נוסף על ידי ניצן פרנס', 1, '2024-114', 0),
(48, 0, '2024-11-27 06:09:55', ' מכרז מספר 2024-114 נערך על ידי ניצן פרנס', 1, '2024-114', 0),
(49, 0, '2024-12-02 08:09:29', ' מכרז מספר 2024-115 נוסף על ידי ניצן פרנס', 1, '2024-115', 0),
(50, 0, '2024-12-02 11:59:28', ' מכרז מספר 2024-106 נערך על ידי ניצן פרנס', 1, '2024-106', 0),
(51, 0, '2024-12-03 09:31:05', ' מכרז מספר 2024-105 נערך על ידי ניצן פרנס', 1, '2024-105', 0),
(52, 0, '2024-12-03 09:51:02', ' מכרז מספר 2024-116 נוסף על ידי ניצן פרנס', 1, '2024-116', 0),
(53, 0, '2024-12-03 09:54:22', ' מכרז מספר 2024-117 נוסף על ידי ניצן פרנס', 1, '2024-117', 0),
(54, 0, '2024-12-04 06:20:19', ' מכרז מספר 2024-116 נערך על ידי ניצן פרנס', 1, '2024-116', 0),
(55, 0, '2024-12-04 06:21:14', ' מכרז מספר 2024-117 נערך על ידי ניצן פרנס', 1, '2024-117', 0),
(57, 0, '2024-12-28 05:00:56', ' מכרז מספר 2024-118 נוסף על ידי בדיקה בדיקה', 1, '2024-118', 0),
(58, 0, '2024-12-28 05:01:09', ' מכרז מספר 2024-119 נוסף על ידי בדיקה בדיקה', 1, '2024-119', 0),
(59, 0, '2024-12-28 05:47:29', ' מכרז מספר 2024-120 נוסף על ידי בדיקה בדיקה', 1, '2024-120', 0),
(60, 0, '2024-12-29 08:14:25', ' מכרז מספר 2024-121 נוסף על ידי ניצן פרנס', 1, '2024-121', 0),
(61, 0, '2024-12-29 08:16:32', ' מכרז מספר 2024-121 נערך על ידי ניצן פרנס', 1, '2024-121', 0),
(62, 0, '2024-12-29 08:21:24', ' מכרז מספר 2024-121 נערך על ידי ניצן פרנס', 1, '2024-121', 0),
(63, 0, '2024-12-29 08:22:08', ' מכרז מספר 2024-121 נערך על ידי ניצן פרנס', 1, '2024-121', 0),
(71, 0, '2024-12-30 06:50:38', ' מכרז מספר 2024-122 נוסף על ידי ניצן פרנס', 1, '2024-122', 0),
(72, 0, '2025-01-13 09:14:04', ' מכרז מספר 2024-122 נערך על ידי ניצן פרנס', 1, '2024-122', 0),
(73, 0, '2025-04-24 06:39:40', ' מכרז מספר 2024-123 נוסף על ידי ניצן פרנס', 1, '2024-123', 0),
(101, 0, '2025-04-26 06:30:16', ' מכרז מספר 2025-124 נוסף על ידי ניצן פרנס', 1, '2025-124', 0),
(102, 0, '2025-04-26 06:30:33', ' מכרז מספר 2025-124 נערך על ידי ניצן פרנס', 1, '2025-124', 0),
(122, 0, '2025-04-26 18:26:20', ' מכרז מספר 2025-125 נוסף על ידי ניצן פרנס', 1, '2025-125', 0),
(147, 0, '2025-04-27 05:47:14', ' מכרז מספר 2025-126 נוסף על ידי ניצן פרנס', 1, '2025-126', 0),
(190, 0, '2025-04-27 13:12:58', ' מכרז מספר 2025-127 נוסף על ידי ניצן פרנס', 1, '2025-127', 0),
(245, 0, '2025-04-28 08:33:18', ' מכרז מספר 2025-128 נוסף על ידי ניצן פרנס', 1, '2025-128', 0),
(273, 0, '2025-04-28 16:03:44', ' מכרז מספר 2025-129 נוסף על ידי ניצן פרנס', 1, '2025-129', 0),
(290, 0, '2025-04-28 17:37:18', ' מכרז מספר 2025-130 נוסף על ידי ניצן פרנס', 1, '2025-130', 0),
(303, 0, '2025-04-28 17:54:24', ' מכרז מספר 2025-131 נוסף על ידי ניצן פרנס', 1, '2025-131', 0),
(314, 0, '2025-04-28 18:25:55', ' מכרז מספר 2025-132 נוסף על ידי ניצן פרנס', 1, '2025-132', 0),
(325, 0, '2025-04-28 18:41:32', ' מכרז מספר 2025-133 נוסף על ידי ניצן פרנס', 1, '2025-133', 0),
(338, 0, '2025-04-29 06:19:17', ' מכרז מספר 2025-134 נוסף על ידי ניצן פרנס', 1, '2025-134', 0),
(347, 0, '2025-04-29 12:56:58', ' מכרז מספר 2025-135 נוסף על ידי ניצן פרנס', 1, '2025-135', 0),
(359, 0, '2025-04-29 13:39:29', ' מכרז מספר 2025-136 נוסף על ידי ניצן פרנס', 1, '2025-136', 0),
(376, 0, '2025-04-29 14:19:48', ' מכרז מספר 2025-137 נוסף על ידי ניצן פרנס', 1, '2025-137', 0),
(401, 0, '2025-04-29 18:07:23', ' מכרז מספר 2025-138 נוסף על ידי ניצן פרנס', 1, '2025-138', 0),
(419, 0, '2025-04-29 18:13:54', ' מכרז מספר 2025-139 נוסף על ידי ניצן פרנס', 1, '2025-139', 0),
(432, 65, '2025-05-01 08:11:05', ' מסמך לצירוף חובה הושלם על ידי המועמד ', 1, NULL, 0),
(475, 0, '2025-05-01 12:51:52', ' מכרז מספר 2025-140 נוסף על ידי בדיקה בדיקה', 1, '2025-140', 0),
(480, 0, '2025-05-05 13:17:57', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(481, 0, '2025-05-05 13:39:32', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(482, 0, '2025-05-05 13:40:56', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(483, 0, '2025-05-05 13:41:49', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(484, 0, '2025-05-05 13:56:30', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(485, 0, '2025-05-05 15:42:45', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(486, 0, '2025-05-05 15:46:50', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(487, 0, '2025-05-05 15:54:48', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(488, 0, '2025-05-05 16:16:25', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(489, 0, '2025-05-05 16:23:16', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(490, 0, '2025-05-05 16:30:03', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(491, 0, '2025-05-05 16:33:52', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(492, 0, '2025-05-05 16:48:59', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(493, 0, '2025-05-05 17:10:52', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(494, 0, '2025-05-05 17:22:06', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(495, 0, '2025-05-05 17:32:00', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(496, 0, '2025-05-05 17:42:14', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(497, 0, '2025-05-05 17:44:54', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(498, 0, '2025-05-05 17:49:04', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(500, 0, '2025-05-06 00:44:17', ' מכרז מספר 2025-140 נערך על ידי בדיקה בדיקה', 1, '2025-140', 0),
(501, 0, '2025-05-06 06:18:00', ' מכרז מספר 2025-141 נוסף על ידי ניצן פרנס', 1, '2025-141', 0),
(502, 0, '2025-05-06 06:18:17', ' מכרז מספר 2025-141 נערך על ידי ניצן פרנס', 1, '2025-141', 0),
(505, 0, '2025-05-08 14:50:35', ' מכרז מספר 2025-141 נערך על ידי ניצן פרנס', 1, '2025-141', 0),
(506, 0, '2025-05-08 14:50:54', ' מכרז מספר 2025-141 נערך על ידי ניצן פרנס', 1, '2025-141', 0),
(508, 0, '2025-05-08 23:24:22', ' מכרז מספר 2025-141 נערך על ידי בדיקה בדיקה', 1, '2025-141', 0),
(509, 0, '2025-05-08 23:27:10', ' מכרז מספר 2025-141 נערך על ידי בדיקה בדיקה', 1, '2025-141', 0),
(510, 0, '2025-05-08 23:33:43', ' מכרז מספר 2025-141 נערך על ידי בדיקה בדיקה', 1, '2025-141', 0),
(511, 0, '2025-05-08 23:35:27', ' מכרז מספר 2025-141 נערך על ידי בדיקה בדיקה', 1, '2025-141', 0),
(512, 0, '2025-05-08 23:42:51', ' מכרז מספר 2025-141 נערך על ידי בדיקה בדיקה', 1, '2025-141', 0),
(513, 0, '2025-05-08 23:43:46', ' מכרז מספר 2025-141 נערך על ידי בדיקה בדיקה', 1, '2025-141', 0),
(514, 0, '2025-05-09 06:28:06', ' מכרז מספר 2025-142 נוסף על ידי ניצן פרנס', 1, '2025-142', 0),
(515, 0, '2025-05-09 06:53:47', 'הערות הערות הערות נכתב על ידי ניצן פרנס', 1, '2025-142', 1),
(516, 0, '2025-05-09 06:54:14', 'דגחכגדלחכיגדלח נכתב על ידי ניצן פרנס', 1, '2025-142', 1),
(517, 0, '2025-05-09 07:12:45', ' מכרז מספר 2025-143 נוסף על ידי ניצן פרנס', 1, '2025-143', 0),
(518, 0, '2025-05-09 07:16:58', ' מכרז מספר 2025-143 נערך על ידי ניצן פרנס', 1, '2025-143', 0),
(519, 0, '2025-05-09 07:19:18', ' מכרז מספר 2025-143 התחיל על ידי ניצן פרנס', 1, '2025-143', 0),
(520, 0, '2025-05-09 07:19:23', ' מכרז מספר 2025-143 נעצר על ידי ניצן פרנס', 1, '2025-143', 0),
(521, 0, '2025-05-09 07:25:07', ' מכרז מספר 2025-144 נוסף על ידי ניצן פרנס', 1, '2025-144', 0),
(522, 0, '2025-05-09 07:28:20', ' מכרז מספר 2025-145 נוסף על ידי ניצן פרנס', 1, '2025-145', 0),
(531, 0, '2025-05-09 17:56:44', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(532, 0, '2025-05-09 18:05:52', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(533, 0, '2025-05-09 18:39:42', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(534, 0, '2025-05-09 18:42:44', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(535, 0, '2025-05-09 18:55:21', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(536, 0, '2025-05-09 18:55:59', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(537, 0, '2025-05-09 18:57:45', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(539, 0, '2025-05-10 14:48:19', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(540, 0, '2025-05-10 14:49:34', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(541, 0, '2025-05-10 15:02:59', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(542, 0, '2025-05-10 16:21:18', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(543, 0, '2025-05-10 16:31:33', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(545, 0, '2025-05-11 01:49:39', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(546, 0, '2025-05-11 01:55:26', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(547, 0, '2025-05-11 01:56:03', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(548, 0, '2025-05-11 02:32:36', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(549, 0, '2025-05-11 03:30:39', ' מכרז מספר 2025-144 נערך על ידי בדיקה בדיקה', 1, '2025-144', 0),
(550, 0, '2025-05-11 03:33:21', ' מכרז מספר 2025-144 נערך על ידי בדיקה בדיקה', 1, '2025-144', 0),
(551, 0, '2025-05-11 03:36:14', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(552, 0, '2025-05-11 03:36:42', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(553, 0, '2025-05-11 05:09:51', ' מכרז מספר 2025-145 נערך על ידי ניצן פרנס', 1, '2025-145', 0),
(554, 0, '2025-05-11 05:10:04', ' מכרז מספר 2025-145 נערך על ידי ניצן פרנס', 1, '2025-145', 0),
(555, 0, '2025-05-11 05:14:54', ' מכרז מספר 2025-145 נערך על ידי ניצן פרנס', 1, '2025-145', 0),
(556, 0, '2025-05-11 05:21:24', ' מכרז מספר 2025-145 נערך על ידי ניצן פרנס', 1, '2025-145', 0),
(557, 0, '2025-05-11 05:22:16', ' מכרז מספר 2025-145 נערך על ידי ניצן פרנס', 1, '2025-145', 0),
(561, 0, '2025-05-12 09:37:48', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(562, 0, '2025-05-12 09:38:33', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(563, 0, '2025-05-12 09:39:29', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(564, 0, '2025-05-12 11:21:18', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(565, 0, '2025-05-12 11:24:43', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(566, 0, '2025-05-12 11:35:03', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(567, 0, '2025-05-12 11:39:50', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(568, 0, '2025-05-12 12:10:57', ' מכרז מספר 2025-145 נערך על ידי בדיקה בדיקה', 1, '2025-145', 0),
(569, 0, '2025-05-12 16:45:42', ' מכרז מספר 2025-146 נוסף על ידי בדיקה בדיקה', 1, '2025-146', 0),
(570, 0, '2025-05-12 16:53:09', ' מכרז מספר 2025-146 נערך על ידי בדיקה בדיקה', 1, '2025-146', 0),
(571, 0, '2025-05-12 17:10:33', ' מכרז מספר 2025-146 נערך על ידי בדיקה בדיקה', 1, '2025-146', 0),
(572, 0, '2025-05-12 17:14:19', ' מכרז מספר 2025-146 נערך על ידי בדיקה בדיקה', 1, '2025-146', 0),
(573, 0, '2025-05-12 17:15:14', ' מכרז מספר 2025-146 נערך על ידי בדיקה בדיקה', 1, '2025-146', 0),
(574, 0, '2025-05-12 17:17:04', ' מכרז מספר 2025-147 נוסף על ידי בדיקה בדיקה', 1, '2025-147', 0),
(575, 0, '2025-05-12 19:52:28', ' מכרז מספר 2025-148 נוסף על ידי ניצן פרנס', 1, '2025-148', 0),
(576, 0, '2025-05-12 19:52:36', ' מכרז מספר 2025-148 נערך על ידי ניצן פרנס', 1, '2025-148', 0),
(577, 0, '2025-05-12 19:53:00', ' מכרז מספר 2025-148 נערך על ידי ניצן פרנס', 1, '2025-148', 0),
(579, 0, '2025-05-13 05:09:58', ' מכרז מספר 2025-149 נוסף על ידי ניצן פרנס', 1, '2025-149', 0),
(592, 0, '2025-05-13 05:13:46', ' מכרז מספר 2025-149 נערך על ידי ניצן פרנס', 1, '2025-149', 0),
(600, 0, '2025-05-14 07:10:51', ' מכרז מספר 2025-149 נערך על ידי ניצן פרנס', 1, '2025-149', 0),
(601, 0, '2025-05-14 07:11:06', ' מכרז מספר 2025-149 נערך על ידי ניצן פרנס', 1, '2025-149', 0),
(609, 0, '2025-05-19 06:25:54', ' מכרז מספר 2025-150 נוסף על ידי ניצן פרנס', 1, '2025-150', 0),
(611, 0, '2025-05-20 05:20:39', ' מכרז מספר 2025-151 נוסף על ידי ניצן פרנס', 1, '2025-151', 0),
(625, 0, '2025-05-22 07:18:04', ' מכרז מספר 2025-151 נערך על ידי בדיקה בדיקה', 1, '2025-151', 0),
(626, 0, '2025-05-22 07:18:34', ' מכרז מספר 2025-151 נערך על ידי בדיקה בדיקה', 1, '2025-151', 0),
(627, 0, '2025-05-22 07:22:10', ' מכרז מספר 2025-151 נערך על ידי בדיקה בדיקה', 1, '2025-151', 0),
(628, 0, '2025-05-22 07:23:50', ' מכרז מספר 2025-151 נערך על ידי בדיקה בדיקה', 1, '2025-151', 0),
(629, 0, '2025-05-22 08:05:08', ' מכרז מספר 2025-152 נוסף על ידי ניצן פרנס', 1, '2025-152', 0),
(630, 0, '2025-05-22 08:05:24', ' מכרז מספר 2025-150 נערך על ידי ניצן פרנס', 1, '2025-150', 0),
(653, 0, '2025-05-31 23:59:10', ' מכרז מספר 2025-153 נוסף על ידי בדיקה בדיקה', 1, '2025-153', 0),
(658, 0, '2025-06-02 06:36:31', ' מכרז מספר 2025-152 נערך על ידי בדיקה בדיקה', 1, '2025-152', 0),
(659, 0, '2025-06-02 06:39:00', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(661, 0, '2025-06-02 13:30:44', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(663, 0, '2025-06-03 14:40:50', ' מכרז מספר 2025-152 נערך על ידי בדיקה בדיקה', 1, '2025-152', 0),
(664, 0, '2025-06-03 14:42:53', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(665, 0, '2025-06-03 14:52:41', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(667, 0, '2025-06-04 14:38:21', ' מכרז מספר 2025-154 נוסף על ידי ניצן פרנס', 1, '2025-154', 0),
(668, 0, '2025-06-04 14:39:07', ' מכרז מספר 2025-154 נערך על ידי ניצן פרנס', 1, '2025-154', 0),
(670, 0, '2025-06-05 08:26:26', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(671, 0, '2025-06-05 08:28:45', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(672, 0, '2025-06-05 08:38:01', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(673, 0, '2025-06-05 08:40:17', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(674, 0, '2025-06-05 08:41:18', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(675, 0, '2025-06-05 08:42:08', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(676, 0, '2025-06-05 08:43:35', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(677, 0, '2025-06-05 08:44:47', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(678, 0, '2025-06-05 09:24:15', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(679, 0, '2025-06-05 15:11:13', ' מכרז מספר 2025-150 נערך על ידי בדיקה בדיקה', 1, '2025-150', 0),
(683, 0, '2025-06-08 15:17:42', ' מכרז מספר 2025-155 נוסף על ידי ניצן פרנס', 1, '2025-155', 0),
(684, 0, '2025-06-08 16:46:08', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(685, 0, '2025-06-08 17:31:47', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(686, 0, '2025-06-08 17:35:47', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(687, 0, '2025-06-08 17:47:39', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(689, 0, '2025-06-09 10:10:04', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(690, 0, '2025-06-09 10:11:20', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(691, 0, '2025-06-09 10:13:30', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(692, 0, '2025-06-09 10:27:06', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(693, 0, '2025-06-09 10:34:07', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(694, 0, '2025-06-09 10:40:04', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(695, 0, '2025-06-09 10:41:51', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(696, 0, '2025-06-09 10:47:00', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(697, 0, '2025-06-09 10:50:31', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(698, 0, '2025-06-09 11:19:14', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(699, 0, '2025-06-09 11:35:17', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(700, 0, '2025-06-09 13:51:50', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(701, 0, '2025-06-09 14:03:37', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(702, 0, '2025-06-09 14:04:43', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(703, 0, '2025-06-09 14:05:49', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(704, 0, '2025-06-09 14:09:37', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(705, 0, '2025-06-09 14:13:44', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(706, 0, '2025-06-09 14:30:06', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(707, 0, '2025-06-09 14:53:27', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(708, 0, '2025-06-09 15:39:19', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(710, 0, '2025-06-10 05:19:49', ' מכרז מספר 2025-156 נוסף על ידי ניצן פרנס', 1, '2025-156', 0),
(722, 0, '2025-06-11 10:45:54', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(723, 0, '2025-06-11 10:48:00', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(724, 0, '2025-06-11 10:48:48', ' מכרז מספר 2025-153 נערך על ידי בדיקה בדיקה', 1, '2025-153', 0),
(725, 0, '2025-06-11 10:50:57', ' מכרז מספר 2025-154 נערך על ידי בדיקה בדיקה', 1, '2025-154', 0),
(736, 0, '2025-06-14 08:34:46', ' מכרז מספר 2025-157 נוסף על ידי ניצן פרנס', 1, '2025-157', 0),
(737, 0, '2025-06-14 08:35:18', ' מכרז מספר 2025-158 נוסף על ידי ניצן פרנס', 1, '2025-158', 0),
(791, 0, '2025-06-17 19:41:25', ' מכרז מספר 2025-158 נערך על ידי בדיקה בדיקה', 1, '2025-158', 0),
(793, 0, '2025-06-18 05:07:20', ' מכרז מספר 2025-159 נוסף על ידי ניצן פרנס', 1, '2025-159', 0),
(813, 0, '2025-06-18 15:59:05', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(814, 0, '2025-06-18 16:01:38', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(815, 0, '2025-06-18 16:03:38', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(816, 0, '2025-06-18 16:08:34', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(817, 0, '2025-06-18 16:08:45', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(818, 0, '2025-06-18 16:19:19', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(819, 0, '2025-06-18 19:22:46', ' מכרז מספר 2025-159 נערך על ידי ניצן פרנס', 1, '2025-159', 0),
(822, 0, '2025-06-19 07:14:49', ' מכרז מספר 2025-159 התחיל על ידי בדיקה בדיקה', 1, '2025-159', 0),
(823, 0, '2025-06-19 07:17:20', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(824, 0, '2025-06-19 07:18:20', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(825, 0, '2025-06-19 07:20:31', ' מכרז מספר 2025-159 נעצר על ידי בדיקה בדיקה', 1, '2025-159', 0),
(826, 0, '2025-06-19 07:20:52', ' מכרז מספר 2025-159 התחיל על ידי בדיקה בדיקה', 1, '2025-159', 0),
(833, 0, '2025-06-20 08:11:21', ' מכרז מספר 2025-159 נעצר על ידי בדיקה בדיקה', 1, '2025-159', 0),
(835, 0, '2025-06-21 08:16:16', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(836, 0, '2025-06-21 08:16:31', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(838, 0, '2025-06-22 05:14:40', ' מכרז מספר 2025-159 התחיל על ידי בדיקה בדיקה', 1, '2025-159', 0),
(839, 0, '2025-06-22 05:15:36', ' מכרז מספר 2025-159 נעצר על ידי בדיקה בדיקה', 1, '2025-159', 0),
(845, 0, '2025-06-26 13:52:48', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(846, 0, '2025-06-26 13:53:11', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(847, 0, '2025-06-26 13:53:46', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(848, 0, '2025-06-26 13:54:59', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(849, 0, '2025-06-26 13:55:20', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(850, 0, '2025-06-26 13:57:35', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(851, 0, '2025-06-26 14:39:27', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(852, 0, '2025-06-26 14:40:50', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(853, 0, '2025-06-26 14:41:05', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(854, 0, '2025-06-26 14:41:46', ' מכרז מספר 2025-159 התחיל על ידי בדיקה בדיקה', 1, '2025-159', 0),
(855, 0, '2025-06-26 14:41:56', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(856, 0, '2025-06-26 14:46:45', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(857, 0, '2025-06-26 14:47:56', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(858, 0, '2025-06-26 14:48:12', ' מכרז מספר 2025-159 נערך על ידי בדיקה בדיקה', 1, '2025-159', 0),
(897, 0, '2025-06-27 06:55:20', ' מכרז מספר 2025-160 נוסף על ידי בדיקה בדיקה', 1, '2025-160', 0),
(1020, 0, '2025-06-27 12:03:44', ' מכרז מספר 2025-161 נוסף על ידי בדיקה בדיקה', 1, '2025-161', 0),
(1047, 0, '2025-06-28 08:11:22', ' מכרז מספר 2025-161 נערך על ידי בדיקה בדיקה', 1, '2025-161', 0),
(1049, 0, '2025-06-29 04:23:09', ' מכרז מספר 2025-158 התחיל על ידי בדיקה בדיקה', 1, '2025-158', 0),
(1066, 0, '2025-06-30 05:21:09', ' מכרז מספר 2025-162 נוסף על ידי בדיקה בדיקה', 1, '2025-162', 0),
(1067, 0, '2025-06-30 11:52:16', ' מכרז מספר 2025-163 נוסף על ידי בדיקה בדיקה', 1, '2025-163', 0),
(1068, 0, '2025-07-01 07:03:08', ' מכרז מספר 2025-164 נוסף על ידי בדיקה בדיקה', 1, '2025-164', 0),
(1085, 0, '2025-07-01 12:21:14', ' מכרז מספר 2025-164 נערך על ידי בדיקה בדיקה', 1, '2025-164', 0),
(1099, 0, '2025-07-01 12:28:35', ' מכרז מספר 2025-164 נערך על ידי בדיקה בדיקה', 1, '2025-164', 0),
(1100, 0, '2025-07-01 12:32:35', ' מכרז מספר 2025-165 נוסף על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1101, 0, '2025-07-02 06:38:45', ' מכרז מספר 2025-165 נערך על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1102, 0, '2025-07-02 12:30:58', ' מכרז מספר 2025-165 נערך על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1103, 0, '2025-07-07 04:59:36', ' מכרז מספר 2025-165 התחיל על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1104, 0, '2025-07-07 04:59:41', ' מכרז מספר 2025-165 הופעל מחדש על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1105, 0, '2025-07-07 05:16:34', ' מכרז מספר 2025-165 נערך על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1125, 0, '2025-07-07 05:55:18', ' מכרז מספר 2025-165 התחיל על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1126, 0, '2025-07-07 12:03:12', ' מכרז מספר 2025-166 נוסף על ידי בדיקה בדיקה', 1, '2025-166', 0),
(1127, 0, '2025-07-07 12:08:15', ' מכרז מספר 2025-165 נעצר על ידי בדיקה בדיקה', 1, '2025-165', 0),
(1144, 0, '2025-07-08 07:55:03', ' מכרז מספר 2025-167 נוסף על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1145, 0, '2025-07-08 07:55:40', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1146, 0, '2025-07-08 07:55:53', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1147, 0, '2025-07-08 07:56:36', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1159, 0, '2025-07-08 10:52:19', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1160, 0, '2025-07-08 10:52:28', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1161, 0, '2025-07-08 11:37:31', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1162, 0, '2025-07-09 08:22:52', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1163, 0, '2025-07-09 09:31:18', ' מכרז מספר 2025-168 נוסף על ידי בדיקה בדיקה', 1, '2025-168', 0),
(1164, 0, '2025-07-09 10:09:57', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1165, 0, '2025-07-09 10:10:22', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1166, 0, '2025-07-09 10:11:09', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1167, 0, '2025-07-09 10:12:38', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1168, 0, '2025-07-09 10:12:49', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1169, 0, '2025-07-09 10:38:10', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1170, 0, '2025-07-09 10:38:15', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1171, 0, '2025-07-09 11:39:37', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1172, 0, '2025-07-09 11:39:51', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1173, 0, '2025-07-09 11:40:04', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1174, 0, '2025-07-09 12:00:29', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1175, 0, '2025-07-09 12:00:39', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1176, 0, '2025-07-09 12:18:33', ' מכרז מספר 2025-167 התחיל על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1177, 0, '2025-07-09 12:31:19', ' מכרז מספר 2025-167 נערך על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1178, 0, '2025-07-09 12:31:31', ' מכרז מספר 2025-167 נעצר על ידי בדיקה בדיקה', 1, '2025-167', 0),
(1179, 0, '2025-07-09 12:32:34', ' מכרז מספר 2025-169 נוסף על ידי בדיקה בדיקה', 1, '2025-169', 0),
(1180, 0, '2025-07-10 05:25:14', ' מכרז מספר 2025-170 נוסף על ידי בדיקה בדיקה', 1, '2025-170', 0),
(1189, 0, '2025-07-10 05:34:03', ' מכרז מספר 2025-170 נערך על ידי בדיקה בדיקה', 1, '2025-170', 0),
(1239, 0, '2025-07-23 13:36:28', ' מכרז מספר 2025-171 נוסף על ידי מור נחמיאס', 1, '2025-171', 0),
(1240, 0, '2025-07-24 11:50:28', ' מכרז מספר 2025-172 נוסף על ידי מור נחמיאס', 1, '2025-172', 0),
(1241, 0, '2025-07-24 11:50:41', ' מכרז מספר 2025-172 נערך על ידי מור נחמיאס', 1, '2025-172', 0),
(1242, 0, '2025-07-24 11:50:56', ' מכרז מספר 2025-172 נערך על ידי מור נחמיאס', 1, '2025-172', 0),
(1243, 0, '2025-07-24 11:51:14', ' מכרז מספר 2025-172 נערך על ידי מור נחמיאס', 1, '2025-172', 0),
(1244, 0, '2025-07-24 11:51:25', ' מכרז מספר 2025-172 נערך על ידי מור נחמיאס', 1, '2025-172', 0),
(1245, 0, '2025-07-24 11:51:55', ' מכרז מספר 2025-173 נוסף על ידי מור נחמיאס', 1, '2025-173', 0),
(1246, 0, '2025-07-24 11:52:24', ' מכרז מספר 2025-173 נערך על ידי מור נחמיאס', 1, '2025-173', 0),
(1247, 0, '2025-07-27 10:51:38', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1248, 0, '2025-07-27 10:55:14', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1249, 0, '2025-07-27 11:02:28', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1250, 0, '2025-07-27 11:21:08', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1251, 0, '2025-07-27 11:34:27', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1252, 0, '2025-07-27 11:38:47', ' מכרז מספר 2025-174 נוסף על ידי מור נחמיאס', 1, '2025-174', 0),
(1253, 0, '2025-07-27 11:39:23', ' מכרז מספר 2025-174 נערך על ידי מור נחמיאס', 1, '2025-174', 0),
(1291, 0, '2025-07-27 18:50:48', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1292, 0, '2025-07-27 18:58:07', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1293, 0, '2025-07-27 18:58:12', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1294, 0, '2025-07-27 18:58:23', ' מכרז מספר 2025-171 נערך על ידי מור נחמיאס', 1, '2025-171', 0),
(1295, 0, '2025-08-04 15:46:22', ' מכרז מספר 2025-175 נוסף על ידי מור נחמיאס', 1, '2025-175', 0),
(1296, 0, '2025-08-04 15:46:42', ' מכרז מספר 2025-175 נערך על ידי מור נחמיאס', 1, '2025-175', 0),
(1297, 0, '2025-08-04 15:46:49', ' מכרז מספר 2025-175 נערך על ידי מור נחמיאס', 1, '2025-175', 0),
(1311, 0, '2025-08-04 16:00:45', ' מכרז מספר 2025-176 נוסף על ידי מור נחמיאס', 1, '2025-176', 0),
(1315, 263, '2025-08-04 16:03:40', ' מסמך לצירוף אישור העסקה הושלם על ידי המועמד ', 1, NULL, 0),
(1325, 0, '2025-08-06 06:48:33', ' מכרז מספר 2025-177 נוסף על ידי מור נחמיאס', 1, '2025-177', 0),
(1332, 0, '2025-08-07 05:28:59', ' מכרז מספר 2025-178 נוסף על ידי מור נחמיאס', 1, '2025-178', 0),
(1333, 0, '2025-08-07 05:36:07', ' מכרז מספר 2025-178 נערך על ידי מור נחמיאס', 1, '2025-178', 0),
(1334, 0, '2025-08-07 05:51:04', ' מכרז מספר 2025-175 התחיל על ידי מור נחמיאס', 1, '2025-175', 0),
(1335, 0, '2025-08-07 05:51:13', ' מכרז מספר 2025-175 נעצר על ידי מור נחמיאס', 1, '2025-175', 0),
(1336, 0, '2025-08-07 05:54:28', ' מכרז מספר 2025-179 נוסף על ידי מור נחמיאס', 1, '2025-179', 0),
(1368, 0, '2025-08-07 06:36:22', ' מכרז מספר 2025-178 נערך על ידי מור נחמיאס', 1, '2025-178', 0),
(1369, 0, '2025-08-07 06:36:39', ' מכרז מספר 2025-178 נערך על ידי מור נחמיאס', 1, '2025-178', 0),
(1370, 0, '2025-08-07 06:48:02', ' מכרז מספר 2025-179 נערך על ידי מור נחמיאס', 1, '2025-179', 0),
(1371, 0, '2025-08-07 06:48:30', ' מכרז מספר 2025-179 נערך על ידי מור נחמיאס', 1, '2025-179', 0),
(1372, 0, '2025-08-07 08:47:20', ' מכרז מספר 2025-180 נוסף על ידי מור נחמיאס', 1, '2025-180', 0),
(1373, 0, '2025-08-07 08:47:27', ' מכרז מספר 2025-180 נערך על ידי מור נחמיאס', 1, '2025-180', 0),
(1374, 0, '2025-08-07 09:18:04', ' מכרז מספר 2025-180 נערך על ידי מור נחמיאס', 1, '2025-180', 0),
(1375, 0, '2025-08-07 09:18:35', ' מכרז מספר 2025-180 נערך על ידי מור נחמיאס', 1, '2025-180', 0),
(1382, 0, '2025-08-11 05:30:59', ' מכרז מספר 2025-181 נוסף על ידי מור נחמיאס', 1, '2025-181', 0),
(1393, 0, '2025-08-12 14:36:32', ' מכרז מספר 2025-182 נוסף על ידי מור נחמיאס', 1, '2025-182', 0),
(1394, 0, '2025-08-12 14:36:41', ' מכרז מספר 2025-182 נערך על ידי מור נחמיאס', 1, '2025-182', 0),
(1401, 0, '2025-08-12 14:44:34', ' מכרז מספר 2025-183 נוסף על ידי מור נחמיאס', 1, '2025-183', 0),
(1402, 0, '2025-08-12 14:44:42', ' מכרז מספר 2025-183 נערך על ידי מור נחמיאס', 1, '2025-183', 0),
(1412, 0, '2025-08-22 08:40:29', ' מכרז מספר 2025-184 נוסף על ידי מור נחמיאס', 1, '2025-184', 0),
(1442, 0, '2025-09-01 05:16:12', ' מכרז מספר 2025-184 נערך על ידי מור נחמיאס', 1, '2025-184', 0),
(1443, 0, '2025-09-03 08:16:30', ' מכרז מספר 2025-185 נוסף על ידי מור נחמיאס', 1, '2025-185', 0),
(1444, 0, '2025-09-03 08:16:47', ' מכרז מספר 2025-185 נערך על ידי מור נחמיאס', 1, '2025-185', 0),
(1456, 0, '2025-09-17 10:34:18', ' מכרז מספר 2025-186 נוסף על ידי מור נחמיאס', 1, '2025-186', 0),
(1457, 0, '2025-09-17 10:46:16', ' מכרז מספר 2025-186 נערך על ידי מור נחמיאס', 1, '2025-186', 0),
(1458, 0, '2025-09-17 10:46:26', ' מכרז מספר 2025-186 נערך על ידי מור נחמיאס', 1, '2025-186', 0),
(1459, 0, '2025-09-17 10:57:22', ' מכרז מספר 2025-186 נערך על ידי מור נחמיאס', 1, '2025-186', 0),
(1477, 0, '2025-09-23 10:02:02', ' מכרז מספר 2025-185 התחיל על ידי גיא ענבר', 1, '2025-185', 0),
(1478, 0, '2025-09-23 10:02:19', ' מכרז מספר 2025-185 הופעל מחדש על ידי גיא ענבר', 1, '2025-185', 0),
(1480, 0, '2025-09-25 05:17:19', ' מכרז מספר 2025-187 נוסף על ידי מור נחמיאס', 1, '2025-187', 0),
(1481, 0, '2025-09-25 05:33:01', ' מכרז מספר 2025-187 נערך על ידי מור נחמיאס', 1, '2025-187', 0),
(1494, 0, '2025-09-25 09:57:39', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1495, 0, '2025-09-25 10:48:19', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1496, 0, '2025-09-25 10:48:47', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1497, 0, '2025-09-25 10:55:35', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1498, 0, '2025-09-28 05:19:44', ' מכרז מספר 2025-188 נוסף על ידי מור נחמיאס', 1, '2025-188', 0),
(1499, 0, '2025-09-28 05:20:00', ' מכרז מספר 2025-188 נערך על ידי מור נחמיאס', 1, '2025-188', 0),
(1513, 0, '2025-09-28 05:54:33', ' מכרז מספר 2025-188 נערך על ידי מור נחמיאס', 1, '2025-188', 0),
(1514, 0, '2025-09-28 05:54:51', ' מכרז מספר 2025-188 נערך על ידי מור נחמיאס', 1, '2025-188', 0),
(1515, 0, '2025-09-30 09:27:56', ' מכרז מספר 2025-189 נוסף על ידי גיא ענבר', 1, '2025-189', 0),
(1516, 0, '2025-09-30 09:45:26', ' מכרז מספר 2025-190 נוסף על ידי גיא ענבר', 1, '2025-190', 0),
(1517, 0, '2025-09-30 09:48:27', ' מכרז מספר 2025-189 נערך על ידי גיא ענבר', 1, '2025-189', 0),
(1518, 0, '2025-09-30 10:11:50', ' מכרז מספר 2025-191 נוסף על ידי גיא ענבר', 1, '2025-191', 0),
(1519, 0, '2025-09-30 10:18:17', ' מכרז מספר 2025-192 נוסף על ידי גיא ענבר', 1, '2025-192', 0),
(1520, 0, '2025-09-30 13:00:04', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1521, 0, '2025-09-30 13:15:11', ' מכרז מספר 2025-189 נערך על ידי מור נחמיאס', 1, '2025-189', 0),
(1522, 0, '2025-09-30 13:15:19', ' מכרז מספר 2025-189 נערך על ידי מור נחמיאס', 1, '2025-189', 0),
(1523, 0, '2025-09-30 13:43:54', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1524, 0, '2025-09-30 14:34:29', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1525, 0, '2025-09-30 14:34:44', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1526, 0, '2025-09-30 14:35:21', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1527, 0, '2025-10-01 07:53:50', ' מכרז מספר 2025-187 נערך על ידי מור נחמיאס', 1, '2025-187', 0),
(1528, 0, '2025-10-01 08:09:18', ' מכרז מספר 2025-187 נערך על ידי מור נחמיאס', 1, '2025-187', 0),
(1529, 0, '2025-10-01 08:12:43', ' מכרז מספר 2025-193 נוסף על ידי מור נחמיאס', 1, '2025-193', 0),
(1530, 0, '2025-10-01 08:12:55', ' מכרז מספר 2025-193 נערך על ידי מור נחמיאס', 1, '2025-193', 0),
(1531, 0, '2025-10-01 09:00:43', ' מכרז מספר 2025-193 נערך על ידי גיא ענבר', 1, '2025-193', 0),
(1532, 0, '2025-10-01 09:23:08', ' מכרז מספר 2025-193 נערך על ידי גיא ענבר', 1, '2025-193', 0),
(1533, 0, '2025-10-01 09:23:48', ' מכרז מספר 2025-187 נערך על ידי גיא ענבר', 1, '2025-187', 0),
(1534, 0, '2025-10-02 12:48:29', ' מכרז מספר 2025-187 נערך על ידי מור נחמיאס', 1, '2025-187', 0),
(1535, 0, '2025-10-02 12:55:43', ' מכרז מספר 2025-187 נערך על ידי מור נחמיאס', 1, '2025-187', 0),
(1536, 0, '2025-10-02 12:56:19', ' מכרז מספר 2025-194 נוסף על ידי מור נחמיאס', 1, '2025-194', 0),
(1537, 0, '2025-10-02 12:56:47', ' מכרז מספר 2025-195 נוסף על ידי מור נחמיאס', 1, '2025-195', 0),
(1538, 0, '2025-10-02 12:57:04', ' מכרז מספר 2025-195 נערך על ידי מור נחמיאס', 1, '2025-195', 0),
(1539, 0, '2025-10-02 12:57:44', ' מכרז מספר 2025-196 נוסף על ידי מור נחמיאס', 1, '2025-196', 0),
(1540, 0, '2025-10-02 21:56:54', ' מכרז מספר 2025-197 נוסף על ידי גיא ענבר', 1, '2025-197', 0),
(1543, 0, '2025-10-03 09:13:44', ' מכרז מספר 2025-198 נוסף על ידי גיא ענבר', 1, '2025-198', 0),
(1544, 0, '2025-10-03 09:13:51', ' מכרז מספר 2025-198 נערך על ידי גיא ענבר', 1, '2025-198', 0),
(1545, 0, '2025-10-03 09:21:29', ' מכרז מספר 2025-199 נוסף על ידי גיא ענבר', 1, '2025-199', 0),
(1570, 0, '2025-10-03 17:56:38', ' מכרז מספר 2025-200 נוסף על ידי גיא ענבר', 1, '2025-200', 0),
(1571, 0, '2025-10-03 18:14:07', ' מכרז מספר 2025-201 נוסף על ידי גיא ענבר', 1, '2025-201', 0),
(1572, 0, '2025-10-03 18:14:29', ' מכרז מספר 2025-201 נערך על ידי גיא ענבר', 1, '2025-201', 0),
(1573, 0, '2025-10-03 18:14:46', ' מכרז מספר 2025-201 נערך על ידי גיא ענבר', 1, '2025-201', 0),
(1574, 0, '2025-10-03 18:35:13', ' מכרז מספר 2025-201 נערך על ידי גיא ענבר', 1, '2025-201', 0),
(1575, 0, '2025-10-03 19:07:25', ' מכרז מספר 2025-202 נוסף על ידי גיא ענבר', 1, '2025-202', 0),
(1576, 0, '2025-10-03 19:59:17', ' מכרז מספר 2025-202 נערך על ידי גיא ענבר', 1, '2025-202', 0),
(1577, 0, '2025-10-03 20:00:00', ' מכרז מספר 2025-202 נערך על ידי גיא ענבר', 1, '2025-202', 0),
(1578, 0, '2025-10-03 20:33:28', ' מכרז מספר 2025-202 נערך על ידי גיא ענבר', 1, '2025-202', 0),
(1579, 0, '2025-10-03 20:33:43', ' מכרז מספר 2025-202 נערך על ידי גיא ענבר', 1, '2025-202', 0),
(1580, 0, '2025-10-03 20:51:09', ' מכרז מספר 2025-202 נערך על ידי גיא ענבר', 1, '2025-202', 0),
(1622, 0, '2025-10-03 22:57:15', ' מכרז מספר 2025-203 נוסף על ידי גיא ענבר', 1, '2025-203', 0),
(1623, 0, '2025-10-03 22:57:29', ' מכרז מספר 2025-203 נערך על ידי גיא ענבר', 1, '2025-203', 0),
(1624, 0, '2025-10-03 22:57:38', ' מכרז מספר 2025-203 נערך על ידי גיא ענבר', 1, '2025-203', 0),
(1632, 0, '2025-10-04 10:24:51', ' מכרז מספר 2025-204 נוסף על ידי גיא ענבר', 1, '2025-204', 0),
(1682, 0, '2025-10-04 19:42:17', ' מכרז מספר 2025-204 נערך על ידי גיא ענבר', 1, '2025-204', 0),
(1683, 0, '2025-10-05 09:42:36', ' מכרז מספר 2025-205 נוסף על ידי גיא ענבר', 1, '2025-205', 0),
(1706, 0, '2025-10-05 09:57:33', ' מכרז מספר 2025-206 נוסף על ידי גיא ענבר', 1, '2025-206', 0),
(1741, 0, '2025-10-05 17:16:10', ' מכרז מספר 2025-206 נערך על ידי גיא ענבר', 1, '2025-206', 0),
(1764, 0, '2025-10-06 07:44:10', ' מכרז מספר 2025-207 נוסף על ידי גיא ענבר', 1, '2025-207', 0),
(1790, 0, '2025-10-06 07:50:34', ' מכרז מספר 2025-208 נוסף על ידי גיא ענבר', 1, '2025-208', 0),
(1801, 0, '2025-10-07 04:41:56', ' מכרז מספר 2025-209 נוסף על ידי גיא ענבר', 1, '2025-209', 0),
(1802, 0, '2025-10-07 04:42:08', ' מכרז מספר 2025-209 נערך על ידי גיא ענבר', 1, '2025-209', 0),
(1814, 0, '2025-10-07 05:58:36', ' מכרז מספר 2025-210 נוסף על ידי גיא ענבר', 1, '2025-210', 0),
(1815, 0, '2025-10-07 05:59:06', ' מכרז מספר 2025-210 התחיל על ידי גיא ענבר', 1, '2025-210', 0),
(1816, 0, '2025-10-07 06:05:54', ' מכרז מספר 2025-211 נוסף על ידי גיא ענבר', 1, '2025-211', 0),
(1817, 0, '2025-10-07 06:07:03', ' מכרז מספר 2025-211 נערך על ידי גיא ענבר', 1, '2025-211', 0),
(1831, 0, '2025-10-07 14:48:16', ' מכרז מספר 2025-212 נוסף על ידי גיא ענבר', 1, '2025-212', 0),
(1842, 0, '2025-10-07 14:53:03', ' מכרז מספר 2025-213 נוסף על ידי גיא ענבר', 1, '2025-213', 0),
(1853, 0, '2025-10-07 14:58:01', ' מכרז מספר 2025-214 נוסף על ידי גיא ענבר', 1, '2025-214', 0),
(1865, 0, '2025-10-08 18:27:50', ' מכרז מספר 2025-213 נערך על ידי גיא ענבר', 1, '2025-213', 0),
(1866, 0, '2025-10-08 18:35:56', ' מכרז מספר 2025-214 נערך על ידי גיא ענבר', 1, '2025-214', 0),
(1867, 0, '2025-10-09 05:48:44', ' מכרז מספר 2025-215 נוסף על ידי גיא ענבר', 1, '2025-215', 0),
(1879, 0, '2025-10-09 05:51:55', ' מכרז מספר 2025-216 נוסף על ידי גיא ענבר', 1, '2025-216', 0),
(1891, 0, '2025-11-03 06:51:13', ' מכרז מספר 2025-216 נערך על ידי גיא ענבר', 1, '2025-216', 0),
(1892, 0, '2025-11-03 07:32:28', ' מכרז מספר 2025-217 נוסף על ידי גיא ענבר', 1, '2025-217', 0),
(1893, 0, '2025-11-04 06:24:46', ' מכרז מספר 2025-218 נוסף על ידי גיא ענבר', 1, '2025-218', 0),
(1894, 0, '2025-11-04 06:25:54', ' מכרז מספר 2025-218 נערך על ידי גיא ענבר', 1, '2025-218', 0),
(1895, 0, '2025-11-04 06:54:40', ' מכרז מספר 2025-219 נוסף על ידי גיא ענבר', 1, '2025-219', 0),
(1896, 0, '2025-11-04 06:54:53', ' מכרז מספר 2025-219 נערך על ידי גיא ענבר', 1, '2025-219', 0),
(1900, 339, '2025-11-04 06:59:42', ' מסמך לצירוף השכלה חובה הושלם על ידי המועמד ', 1, NULL, 0),
(1912, 0, '2025-11-04 13:04:00', ' מכרז מספר 2025-220 נוסף על ידי גיא ענבר', 1, '2025-220', 0),
(1919, 0, '2025-11-05 05:34:13', ' מכרז מספר 2025-221 נוסף על ידי גיא ענבר', 1, '2025-221', 0),
(1927, 0, '2025-11-10 12:44:06', ' מכרז מספר 2025-222 נוסף על ידי גיא ענבר', 1, '2025-222', 0),
(1940, 0, '2025-11-18 09:25:42', ' מכרז מספר 2025-223 נוסף על ידי גיא ענבר', 1, '2025-223', 0),
(1941, 0, '2025-11-19 11:37:51', ' מכרז מספר 2025-224 נוסף על ידי גיא ענבר', 1, '2025-224', 0),
(1942, 0, '2025-12-04 10:43:26', ' מכרז מספר 2025-225 נוסף על ידי מור נחמיאס', 1, '2025-225', 0),
(1943, 346, '2025-12-04 12:33:19', 'טופס הבקשה אושר על ידי מור נחמיאס', 1, NULL, 0),
(1944, 347, '2025-12-04 12:34:28', 'מסמך לצירוף תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז אושר על ידי מור נחמיאס', 1, NULL, 0),
(1945, 347, '2025-12-04 12:34:52', 'מסמך לצירוף ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון נדחה <br>סיבת הדחייה:אישור לא תקין', 1, NULL, 0),
(1946, 347, '2025-12-04 12:35:03', 'מסמך לצירוף שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה. אושר על ידי מור נחמיאס', 1, NULL, 0),
(1947, 346, '2025-12-04 12:35:51', 'טופס הבקשה אושר על ידי מור נחמיאס', 1, NULL, 0),
(1948, 346, '2025-12-04 12:35:51', 'טופס הבקשה אושר על ידי מור נחמיאס', 1, NULL, 0),
(1949, 346, '2025-12-04 12:35:51', 'מסמך לצירוף תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז אושר על ידי מור נחמיאס', 1, NULL, 0),
(1950, 346, '2025-12-04 12:35:51', 'מסמך לצירוף ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון אושר על ידי מור נחמיאס', 1, NULL, 0),
(1951, 346, '2025-12-04 12:35:51', 'מסמך לצירוף שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה. אושר על ידי מור נחמיאס', 1, NULL, 0),
(1952, 346, '2025-12-04 12:35:51', 'מסמך לצירוף האם הינך בעל תואר ראשון? אושר על ידי מור נחמיאס', 1, NULL, 0),
(1953, 346, '2025-12-04 12:35:51', 'מסמך לצירוף האם יש לך ניסיון בניהול 2 עובדים במשך שנה? אושר על ידי מור נחמיאס', 1, NULL, 0),
(1954, 346, '2025-12-04 12:35:51', 'מסמך לצירוף האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית? אושר על ידי מור נחמיאס', 1, NULL, 0),
(1955, 346, '2025-12-04 12:35:51', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי מור נחמיאס', 1, NULL, 0),
(1956, 346, '2025-12-04 12:35:51', 'מסמך לצירוף אישור העסקה אושר על ידי מור נחמיאס', 1, NULL, 0),
(1957, 346, '2025-12-04 12:35:51', 'מסמך לצירוף קורות חיים אושר על ידי מור נחמיאס', 1, NULL, 0),
(1958, 346, '2025-12-04 12:36:50', 'נשלח למועמד אישור ציפיות שכר על ידי מור נחמיאס', 1, NULL, 0),
(1959, 347, '2025-12-04 12:41:00', ' נשלח למועמד זימון לועדת בחינה על ידי מור נחמיאס', 1, NULL, 0),
(1960, 347, '2025-12-04 12:41:03', 'נשלח למועמד זימון לועדת בחינה על ידי מור נחמיאס (זמן: 17:40-17:55)', 1, NULL, 0),
(1961, 346, '2025-12-04 12:41:03', ' נשלח למועמד זימון לועדת בחינה על ידי מור נחמיאס', 1, NULL, 0),
(1962, 346, '2025-12-04 12:41:05', 'נשלח למועמד זימון לועדת בחינה על ידי מור נחמיאס (זמן: 18:00-18:15)', 1, NULL, 0),
(1963, 0, '2025-12-09 06:16:55', ' מכרז מספר 2025-224 נערך על ידי גיא ענבר', 1, '2025-224', 0),
(1973, 0, '2025-12-09 08:42:29', ' מכרז מספר 2025-226 נוסף על ידי גיא ענבר', 1, '2025-226', 0),
(1974, 347, '2025-12-09 11:33:35', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(1975, 347, '2025-12-09 11:33:40', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(1976, 347, '2025-12-09 11:34:11', 'מועמד דחה ציפיות שכר', 1, NULL, 0),
(1977, 347, '2025-12-09 11:34:19', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(1978, 347, '2025-12-09 11:45:14', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(1979, 0, '2025-12-09 11:45:38', ' מכרז מספר 2025-225 נערך על ידי מור נחמיאס', 1, '2025-225', 0),
(1980, 0, '2025-12-09 14:51:06', ' מכרז מספר 2025-225 נערך על ידי מור נחמיאס', 1, '2025-225', 0),
(1981, 347, '2025-12-09 15:03:21', ' נשלח למועמד זימון לועדת בחינה על ידי מור נחמיאס', 1, NULL, 0),
(1982, 347, '2025-12-09 15:04:10', ' נשלח למועמד זימון לבחינה בכתב על ידי מור נחמיאס', 1, NULL, 0),
(1983, 0, '2025-12-10 09:37:43', ' מכרז מספר 2025-227 נוסף על ידי מור נחמיאס', 1, '2025-227', 0),
(1984, 0, '2025-12-10 09:38:27', ' מכרז מספר 2025-227 נערך על ידי מור נחמיאס', 1, '2025-227', 0),
(1985, 0, '2025-12-10 09:44:42', ' מכרז מספר 2025-227 נערך על ידי מור נחמיאס', 1, '2025-227', 0),
(1986, 0, '2025-12-10 09:46:13', ' מכרז מספר 2025-228 נוסף על ידי מור נחמיאס', 1, '2025-228', 0),
(1987, 0, '2025-12-14 09:59:43', ' מכרז מספר 2025-228 נערך על ידי מור נחמיאס', 1, '2025-228', 0),
(1988, 0, '2025-12-14 10:00:27', ' מכרז מספר 2025-227 נערך על ידי מור נחמיאס', 1, '2025-227', 0),
(1989, 0, '2025-12-14 10:00:43', ' מכרז מספר 2025-228 נערך על ידי מור נחמיאס', 1, '2025-228', 0),
(1990, 0, '2025-12-25 13:39:51', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(1991, 0, '2025-12-25 14:06:06', ' מכרז מספר 2025-227 נערך על ידי גיא ענבר', 1, '2025-227', 0),
(1992, 0, '2025-12-25 14:06:37', ' מכרז מספר 2025-219 נערך על ידי גיא ענבר', 1, '2025-219', 0),
(1993, 0, '2025-12-25 14:23:12', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(1994, 0, '2025-12-25 14:23:24', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(1995, 0, '2025-12-25 14:23:41', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(1996, 0, '2025-12-25 14:23:48', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(1997, 0, '2025-12-25 14:23:54', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(1998, 0, '2025-12-25 14:25:10', ' מכרז מספר 2025-229 נוסף על ידי גיא ענבר', 1, '2025-229', 0),
(2000, 0, '2025-12-29 06:50:42', ' מכרז מספר 2025-226 נערך על ידי גיא ענבר', 1, '2025-226', 0),
(2001, 0, '2025-12-29 06:51:33', ' מכרז מספר 2025-230 נוסף על ידי גיא ענבר', 1, '2025-230', 0),
(2002, 0, '2025-12-29 06:51:49', ' מכרז מספר 2025-230 נערך על ידי גיא ענבר', 1, '2025-230', 0),
(2003, 0, '2025-12-29 06:52:00', ' מכרז מספר 2025-230 נערך על ידי גיא ענבר', 1, '2025-230', 0),
(2004, 0, '2025-12-29 06:52:06', ' מכרז מספר 2025-230 נערך על ידי גיא ענבר', 1, '2025-230', 0),
(2005, 0, '2026-01-01 14:21:31', ' מכרז מספר 2025-229 נערך על ידי גיא ענבר', 1, '2025-229', 0),
(2009, 0, '2026-01-04 14:40:24', ' מכרז מספר 2025-231 נוסף על ידי גיא ענבר', 1, '2025-231', 0),
(2020, 0, '2026-01-04 14:51:06', ' מכרז מספר 2025-231 נערך על ידי גיא ענבר', 1, '2025-231', 0),
(2021, 0, '2026-01-05 09:38:46', ' מכרז מספר 2025-231 נערך על ידי גיא ענבר', 1, '2025-231', 0),
(2022, 0, '2026-01-06 06:40:14', ' מכרז מספר 2026-232 נוסף על ידי גיא ענבר', 1, '2026-232', 0),
(2036, 0, '2026-01-07 06:33:33', ' מכרז מספר 2026-233 נוסף על ידי גיא ענבר', 1, '2026-233', 0),
(2047, 0, '2026-01-07 13:01:26', ' מכרז מספר 2026-234 נוסף על ידי גיא ענבר', 1, '2026-234', 0),
(2059, 0, '2026-01-07 13:49:11', ' מכרז מספר 2026-234 נערך על ידי גיא ענבר', 1, '2026-234', 0),
(2072, 0, '2026-01-07 14:06:07', ' מכרז מספר 2026-235 נוסף על ידי גיא ענבר', 1, '2026-235', 0),
(2085, 0, '2026-01-07 14:10:44', ' מכרז מספר 2026-236 נוסף על ידי גיא ענבר', 1, '2026-236', 0),
(2097, 0, '2026-01-08 07:43:24', ' מכרז מספר 2026-237 נוסף על ידי גיא ענבר', 1, '2026-237', 0),
(2098, 0, '2026-01-08 07:43:48', ' מכרז מספר 2026-237 נערך על ידי גיא ענבר', 1, '2026-237', 0),
(2113, 367, '2026-01-19 15:50:23', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2114, 367, '2026-01-19 15:50:23', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2115, 367, '2026-01-19 15:50:23', 'מסמך לצירוף השכלה חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2116, 367, '2026-01-19 15:50:23', 'מסמך לצירוף מקצועי חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2117, 367, '2026-01-19 15:50:23', 'מסמך לצירוף ניהולי חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2118, 367, '2026-01-19 15:50:23', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2119, 367, '2026-01-19 15:50:23', 'מסמך לצירוף אישור העסקה אושר על ידי גיא ענבר', 1, NULL, 0),
(2120, 367, '2026-01-19 15:50:23', 'מסמך לצירוף קורות חיים אושר על ידי גיא ענבר', 1, NULL, 0),
(2121, 367, '2026-01-19 15:50:31', 'נשלח למועמד מכתב אי עמידה בתנאי סף על ידי גיא ענבר', 1, NULL, 0),
(2122, 0, '2026-01-20 09:09:58', ' מכרז מספר 2026-238 נוסף על ידי גיא ענבר', 1, '2026-238', 0),
(2135, 0, '2026-01-20 09:52:52', ' מכרז מספר 2026-239 נוסף על ידי מור מור', 1, '2026-239', 0),
(2146, 0, '2026-01-20 13:53:59', ' מכרז מספר 2026-239 נערך על ידי גיא ענבר', 1, '2026-239', 0),
(2147, 0, '2026-01-20 13:54:31', ' מכרז מספר 2026-240 נוסף על ידי גיא ענבר', 1, '2026-240', 0),
(2168, 0, '2026-01-20 13:59:23', ' מכרז מספר 2026-241 נוסף על ידי גיא ענבר', 1, '2026-241', 0),
(2179, 0, '2026-01-20 14:02:10', ' מכרז מספר 2026-242 נוסף על ידי גיא ענבר', 1, '2026-242', 0),
(2180, 0, '2026-01-20 14:02:19', ' מכרז מספר 2026-242 נערך על ידי גיא ענבר', 1, '2026-242', 0),
(2191, 0, '2026-01-20 14:05:18', ' מכרז מספר 2026-243 נוסף על ידי גיא ענבר', 1, '2026-243', 0),
(2216, 0, '2026-01-21 11:19:10', ' מכרז מספר 2026-244 נוסף על ידי גיא ענבר', 1, '2026-244', 0),
(2217, 376, '2026-01-21 11:21:40', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2218, 376, '2026-01-21 11:21:40', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0);
INSERT INTO `apps_logs` (`id`, `app_id`, `l_date`, `description`, `status`, `tender_id`, `is_note`) VALUES
(2219, 376, '2026-01-21 11:21:40', 'מסמך לצירוף שנות לימוד / תעודת בגרות12 אושר על ידי גיא ענבר', 1, NULL, 0),
(2220, 376, '2026-01-21 11:21:40', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2221, 376, '2026-01-21 11:21:40', 'מסמך לצירוף אישור העסקה אושר על ידי גיא ענבר', 1, NULL, 0),
(2222, 376, '2026-01-21 11:21:40', 'מסמך לצירוף נסיון ניהולי אושר על ידי גיא ענבר', 1, NULL, 0),
(2223, 376, '2026-01-21 11:21:40', 'מסמך לצירוף קורות חיים אושר על ידי גיא ענבר', 1, NULL, 0),
(2224, 376, '2026-01-21 11:21:48', 'נשלח למועמד אישור ציפיות שכר על ידי גיא ענבר', 1, NULL, 0),
(2225, 0, '2026-01-22 14:06:55', ' מכרז מספר 2026-245 נוסף על ידי גיא ענבר', 1, '2026-245', 0),
(2226, 0, '2026-01-22 14:07:08', ' מכרז מספר 2026-245 נערך על ידי גיא ענבר', 1, '2026-245', 0),
(2227, 367, '2026-01-25 06:31:54', 'נשלח למועמד אישור ציפיות שכר על ידי גיא ענבר', 1, NULL, 0),
(2228, 367, '2026-01-25 06:31:59', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2229, 367, '2026-01-25 06:32:30', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2230, 378, '2026-01-26 05:39:59', 'מסמך לצירוף eyJpdiI6ImRmUVBsc00xcW5wbDRBSWFQVjNUcFE9PSIsInZhbHVlIjoiTVdtVnFPZFp3UjE5cVVsaUUvTzdIUGZuaitzZ2lRcG13ejFBeTJPUEZOVXJZSjFZa3Jzb2MvRmFaWUx6eUljUU00Kys2VFR6TUdFWnJ5dndkRzFucWtyYW5DTHBockdFWFpmcTlhMzhJWFQ4bUZYUkxaNmZNVWxRR25QTEJmTVgrUWFJU2pwdzgydGVoQ3djUGdTdFlnPT0iLCJtYWMiOiIwMTkyYTM0MTRiMmE3YjhiMzY0N2UzZGVhMzYyNWNiN2ZjNzE5YmE0YTE3YTY4Njc3N2UwM2RiYjU3MGRmM2JjIiwidGFnIjoiIn0= אושר על ידי test', 1, NULL, 0),
(2231, 378, '2026-01-26 06:22:58', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2232, 378, '2026-01-26 06:22:58', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2233, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6ImJmbEhXR2NNSnJpSzNXNUxsK0dHQVE9PSIsInZhbHVlIjoiMW1ORmFBMFhBWGcrdHdxdXhKejBCT3RyU0VvQkpYTFlGblU2aU80Tm9XSmpLVDBNekVHY1JVMTY2L1R3NFNuL2EvMnUzMkYxckFCS3g2TERSNzRWeG42V2NRN2RtOENwLytqTkM3VThLS3MxRGZSOGJYTllzdmNueW9HdXBnUzYiLCJtYWMiOiIxNTVkODRlYWZjMTI4Njg1YjJmYzJiNjhjZGEwOTYzMjE1ZWFhZTIxM2MyNTVkODg1ODY2YzM2M2UwYzJhY2EyIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2234, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6InNmcCtLSzFBS1docXhTbS9YOEZ0c2c9PSIsInZhbHVlIjoiZkNaYy93MStMT291Vy9PSVdmSTBEWEZKVkI1U3UyYmVra1dPOC83OVBrcnRZZSsxTXBtWHhleFhLc1hWL25zNEtHNDVVbnk1cWRpYXlIZkl0bW5Qdm42TDZSUERQOE1OY29WaTBpd1Y4U1Zoak1RWStweVN5M3NkYmtQZG1JMVNWMS85d2VqalMwcW9EU0xYeHhGajFnPT0iLCJtYWMiOiI0NDI4MDI3MjJhZmUzZGUzYzgwYjhmMDFiMTcyOTM5MDY2YzJkODk2NTJiMWY0OTYzMWZiODU3MjQ0OWY2NWIxIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2235, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6IkJwSkNIajVsUmZUbXQzTjJFelFtS0E9PSIsInZhbHVlIjoiZ1B6NkhrdDRLUGFtY2tMdnRVWmljU3ZNa3lRNm9MQ1ErSW1hS2tpWWVNNlU4dGw5aGhBbFVDYWNUalB0cWt4VTA2VEREaloxLzBpaTlBVEVzYTVzQ1lkbThsVUczcFVLU00vUnBmL3dncktScmludHZXUmdqaGUwNm9BdHFBZTMiLCJtYWMiOiI1ZTA5NGFkOWNhN2QyZDdjYjM5MDdlZmMyY2ZjMmExNjQ5MjgyMWM1ZjQxYmQ5NDA4ZDEwMWI5YmU3NjY5NmE0IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2236, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6Ik1TMDRQSzZlT3NjSjFjTklPd2Vzemc9PSIsInZhbHVlIjoibnpSYUZ6TEJWZVhHZGUvNlVVWm53Z1c1Sk1WQmVkQjFCczd3Rzhqc0RCZkRsRmpQRmo1VDg4UnpES01LODdWOFIxSHBkWlZseGRTRUJ5WldPYjl5NTFsMkV5cWJkQXFoSE1KZFprS3JiY0Y3bktXWlF1dERzY0hTMFpRUTM2OW9LYVVaUUhpS28yb1d1c01kQ1BLUjlBPT0iLCJtYWMiOiI5ZTM0Zjg0ZTcwYmY4NDU2ODQwNTRmNWI4YzQ1OTA3Y2E2NWRmNTg3YmI0OGUzNTVkNGU4NzY4NjU0M2RhYzI4IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2237, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6InFkMzBLOWxSQlBKMWI1Tm52ODM0Zmc9PSIsInZhbHVlIjoiTTUxYWNaRW9laW1NWk0xZVo4SzhKRGd4VEhjQ3loMzM4ektEQUFZMm5xeWM3aVNvbVZCdTR1ZEdUemZveHg2SmNOZG1qMWYwZ255Z0RudHpVWFdhb3FOdEhXdUo3U0pVREJ2aU1HbFViRTFkS0dTaXBiRTBCV3lmcURSMlFBR0poeng4bFNQc2RhUGtOMWREbmFIWWNBPT0iLCJtYWMiOiI4ZDljZDM5YzMyZWI5YjU5NWViNTU3MWJjNjc0NjZkNDlkMDdiZTg2OWI4N2RiMjlhN2MxOTc3MjhkOTU2MzM0IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2238, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6Im9uOXpEaVJTbTM4N2d5RHZpVmlFVmc9PSIsInZhbHVlIjoiS1VsUFBOVDN1aFhHWnhpUSs0WW9qOUc0YkJtUCtuT05xanhuL2l4bXUrR2J2OE1RdFBoek5ma0FhQjRkamtqRHZIOUsvY3dQdWhkRnJQTGp5UVl0bGc2OFJoKzVGT2xyMmR2Q0RhZmRheDlJOGQxNE4wdkNqVkwrWGpPZVVOTHdNcUtqN2w4dmVxMitoanhBY003KzhwbTRtMFBWN0VkMXQwc2VJWmVxejQ3WFNiREErdVFoQTRuamtSeGR5MHhIIiwibWFjIjoiMDQ0YzllZjE3NGZkMTNmM2QzZmRiM2Y3OTgyNzUyMjQ0MTY2OWRiZDI5YmQ4MGQ3ZmYzN2RjZmUxYzAyMDRjOCIsInRhZyI6IiJ9 אושר על ידי גיא ענבר', 1, NULL, 0),
(2239, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6IjN0R3ppVWFrUTRNSHU0VVVxeHBHTnc9PSIsInZhbHVlIjoiMDhOaVgyaktvRnpEMW1XVzRFVktNSTRjeHprcyt1SkdqdEt1UGJwZDRiZmgwdFZlZUgyVU5GS1E0WVdKRWhsZUNjMXQ0YVZvQ1NTM055QmdkOFFlMDl5QjU2M2J2Q0dTbmpCVFNHOHNuTW1wNjNaRnZZeXBtL3pBbGY3M1FMa2crTUFGUzE2bzAxR1MrSkVEMWcyTlF3PT0iLCJtYWMiOiJmYjI1M2ZhZjMxNzljZjkyNGE5M2ZjYmEzODlkM2NhZmUxNmFkMjZiM2Y2MmFiOTI2ZWZiMmM3ZjExY2MyYTExIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2240, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6ImRmUVBsc00xcW5wbDRBSWFQVjNUcFE9PSIsInZhbHVlIjoiTVdtVnFPZFp3UjE5cVVsaUUvTzdIUGZuaitzZ2lRcG13ejFBeTJPUEZOVXJZSjFZa3Jzb2MvRmFaWUx6eUljUU00Kys2VFR6TUdFWnJ5dndkRzFucWtyYW5DTHBockdFWFpmcTlhMzhJWFQ4bUZYUkxaNmZNVWxRR25QTEJmTVgrUWFJU2pwdzgydGVoQ3djUGdTdFlnPT0iLCJtYWMiOiIwMTkyYTM0MTRiMmE3YjhiMzY0N2UzZGVhMzYyNWNiN2ZjNzE5YmE0YTE3YTY4Njc3N2UwM2RiYjU3MGRmM2JjIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2241, 378, '2026-01-26 06:22:58', 'מסמך לצירוף eyJpdiI6Ik1GTDZFTkRseEZQa3ZaWHJFSTBENEE9PSIsInZhbHVlIjoiVVNmN09sT25DSGV5ZmhoUGQ0cFhpTmtCNlFKQXZPNE1LTTNsR2xDOHIramYrUG5XbGpKbUpQR2FOek1jQmw3WG8rWmI1RGFQdENuOGFJNTdKaDRTRGxlTCtTOWRhRXM0bDZOQzZzcUlKMlU9IiwibWFjIjoiNjY4ZjVmZDQyOWE0NWY5YzdhZmIyOGNlN2ZkYjNmY2JiZjkyNjRlNDFjZTUyZTljOTE3MjAwNWNkMjYwZTdhMyIsInRhZyI6IiJ9 אושר על ידי גיא ענבר', 1, NULL, 0),
(2242, 367, '2026-01-26 06:23:54', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2243, 380, '2026-01-26 06:25:38', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2244, 380, '2026-01-26 06:25:38', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2245, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6IkwvNmgrUlQ0dTJOSW9rSlRGVjNaR3c9PSIsInZhbHVlIjoicHZoQTdhcG9XWExKbDJHNVZyL1dNdlFrUDd6R0Y3ck5YTnowajc4RjBVL3lsOVJVbW1ndi9mQTkvRDUzMjNPTTlWd2FyU21tTjVhU3owRkRtWTNwSkR2elNhMWR1NkxVbXFGakhWM2VxWFdVV2t0RkxXK01uM0pxRStZcU05UGMiLCJtYWMiOiI0ZjhkNTYyNjU3YWE5MDE0NjYxZTllODViMmU0ZTVkNjhjOWNhODM5OTgxY2YwMTAxZTNkOWEyMWI0NDYyN2NmIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2246, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6InVmMmRoTG1kMmxFdVhJN1RPZkxnMFE9PSIsInZhbHVlIjoieU5QMGxCNVpGZXl4WlJOdEw1MEkya0w0Z3NGenI2OVZyNUhFN1MyUWRiT3czWEN5eWk2Um5XVkVjbi9GQUk3ZThIZGhjOFJMMHNTZmtjbDlIalNlTE5XMmRKRGJ3Q2syUjlIaWFuWXZPeFRWMUcrdFhkSUZlLzVVNFY5bGltUWYiLCJtYWMiOiJiZWExNGYxMTE1NjFkOTI4YTVlMzJhODkwNjQ1ZWNmNzQzMjg1ZWIzNWJjMDUyNWQ5NTIxNjY4YmY3NzQxYzZkIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2247, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6IkNVVmNyYWl5MlpPYXRpMXR5NGFLaVE9PSIsInZhbHVlIjoiakErNzV4UjMycG0xVllub3VsbHVybmpoU3E2V1FQd0FPdnduOUE5NzN4R1UvN1JEd1NydHZKbVVJNE9jbTh1YUFqeTB1NlFEeHlxUmI4WXR1ZXlVbThWbXlIeXRBMU9SQm9OVmdGRE5ERStyUzNZWjZ6TWJWaC9LTEEzRzNsTTlONmlUTlVzUzArU2hISkNQYkNBVXNRPT0iLCJtYWMiOiI2NWQzOWY2NmFiM2NmMDFlNTY0ZTg5ZWU1ZmMyNjRlY2UxOTA5NTJjMWNiMDQ5NDk4MzI3Nzc0ZmY0NDM4ZTQ4IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2248, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6IlV4bGVFVCttSHlnNkZ1OUd5WlAvV0E9PSIsInZhbHVlIjoiNFI3NUJiK0hPSE5DQ1Y4Z2krOXZaQUJJTGRIRW4yb0dIakY0UndLaTkyV2d5SVVwbW5YWlBCaE14b1BET3Z0WHIrRnpIRDE2SllGbzMwZTdmcWdod3NSaUpYUklmVm5jMkFQMi9lOHpuZkF3YWRrSjNHQ2dQUEx2MnVnMDhJNFBWSmN6NlJMRENOVmZnZzRWQ01nMEUxazFBQlpzV051anplWEN5WUE4MnlieXRYWWUya1JLR3pFek8vQ1JGM3BzIiwibWFjIjoiYWRkZjc0MGEwNzEyNDMzMjY4NzRjMWM0NzA5Y2YxODAwMTM1M2ZjNjIwODA3ZGU4ZTJjMzAzOTk5YWJkMGRhOCIsInRhZyI6IiJ9 אושר על ידי גיא ענבר', 1, NULL, 0),
(2249, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6IjZ1QndsSzVKSkF3N1M3ZlQ0T0JTUVE9PSIsInZhbHVlIjoiQmNuekFucXpsVlE2MzRiUGJReHErazVhaFlrWnV3bUc1RU1tYkk2UEFhbncvQXU0UnFzM3hOUGduOXBqQkNybk5pTXI1bStFN1FvekdrMHhrMmZMeGtCTTFaOFNOajU2d3FHLzNwVldaM1JZM0syWUozNFNweG9OQVJtR1lieEFSajg4WEdUS1RWQ013SkRRZkt6aUxBPT0iLCJtYWMiOiJmNmU5OTgxMWVmOGIwZTUzYzI2NmRiZWE2N2E4NThlYWQwOWVhYzNhMjlhNzA4N2Y5YjRhYzg4MmZkM2M5YTczIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2250, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6ImdRYTVNMmp5Z05CSFhmT25oRmhVZWc9PSIsInZhbHVlIjoiTnFUV0RzWWczMjYzemI4dEt0SFd3QWV6UWxtRVladUkxc0NnWWk1dS9CN2hDMk5WLy82UUtjUmU4cjNIOFFXQU9ydXlITU52a0wyV3FCb3NKbTZubHhEdjZJa1pXR2dhQW9WUWVhcHF1ZU5zcW0reUV3WXk5ZXlGekNHbi8zQkdpTUtMK3FCak05UThiMzgxTHl1elFnPT0iLCJtYWMiOiJlZDM4MGVjMmQ5YzY1MzBhYmM1ZDZjMWFkNmVhYTkxMGUxOGRhOTgwZTNmZmU2YjIwNjY5ODJlNTNkOTY5NDljIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2251, 380, '2026-01-26 06:25:38', 'מסמך לצירוף eyJpdiI6Im1CTCt0S1BjUkdUcUdyS0tkYU9DOUE9PSIsInZhbHVlIjoiVklLNENsVHVCS0FFZllQMGdIOFVZVU5vNmxUays2bTcxdmU4VTV2cGczbHplMzh3WjN0SU5jWDlHQ1JURUdNZ2d0Zm91UkI4WUlScGdJeWZ2YXVIVThXMVpFWkt0ODRMUVcwOFlKWmptcjA9IiwibWFjIjoiMzBiMzcyMzdjYzg3ZTk2ODRlMjhhZjZiMmI1NDkxMDA4MTU0YzU2NjdiZDc1OTU5NDhmYWZkYTNjODcxMWExYiIsInRhZyI6IiJ9 אושר על ידי גיא ענבר', 1, NULL, 0),
(2252, 380, '2026-01-26 06:25:46', 'נשלח למועמד אישור ציפיות שכר על ידי גיא ענבר', 1, NULL, 0),
(2253, 380, '2026-01-26 06:25:50', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2254, 367, '2026-01-26 06:48:04', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2255, 367, '2026-01-26 07:45:12', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2256, 378, '2026-01-26 08:22:03', 'מסמך לצירוף ניהולי חובה נדחה <br>סיבת הדחייה:jjj', 1, NULL, 0),
(2257, 378, '2026-01-26 08:22:10', 'מסמך לצירוף eyJpdiI6InFkMzBLOWxSQlBKMWI1Tm52ODM0Zmc9PSIsInZhbHVlIjoiTTUxYWNaRW9laW1NWk0xZVo4SzhKRGd4VEhjQ3loMzM4ektEQUFZMm5xeWM3aVNvbVZCdTR1ZEdUemZveHg2SmNOZG1qMWYwZ255Z0RudHpVWFdhb3FOdEhXdUo3U0pVREJ2aU1HbFViRTFkS0dTaXBiRTBCV3lmcURSMlFBR0poeng4bFNQc2RhUGtOMWREbmFIWWNBPT0iLCJtYWMiOiI4ZDljZDM5YzMyZWI5YjU5NWViNTU3MWJjNjc0NjZkNDlkMDdiZTg2OWI4N2RiMjlhN2MxOTc3MjhkOTU2MzM0IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2258, 367, '2026-01-26 10:29:01', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2259, 381, '2026-01-26 11:57:23', 'מסמך לצירוף קורות חיים נדחה <br>סיבת הדחייה:ייי', 1, NULL, 0),
(2260, 377, '2026-01-26 11:57:59', 'מסמך לצירוף שנות לימוד / תעודת בגרות12 נדחה <br>סיבת הדחייה:עיחיעח', 1, NULL, 0),
(2261, 376, '2026-01-26 11:58:26', ' מסמך לצירוף שנות לימוד / תעודת בגרות12 הושלם על ידי המועמד ', 1, NULL, 0),
(2262, 377, '2026-01-26 11:58:34', 'מסמך לצירוף שנות לימוד / תעודת בגרות12 אושר על ידי גיא ענבר', 1, NULL, 0),
(2263, 377, '2026-01-26 11:58:40', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2264, 377, '2026-01-26 11:58:40', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2265, 377, '2026-01-26 11:58:40', 'מסמך לצירוף שנות לימוד / תעודת בגרות12 אושר על ידי גיא ענבר', 1, NULL, 0),
(2266, 377, '2026-01-26 11:58:40', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2267, 377, '2026-01-26 11:58:40', 'מסמך לצירוף אישור העסקה אושר על ידי גיא ענבר', 1, NULL, 0),
(2268, 377, '2026-01-26 11:58:40', 'מסמך לצירוף נסיון ניהולי אושר על ידי גיא ענבר', 1, NULL, 0),
(2269, 377, '2026-01-26 11:58:40', 'מסמך לצירוף קורות חיים אושר על ידי גיא ענבר', 1, NULL, 0),
(2270, 0, '2026-01-26 13:09:04', ' מכרז מספר 2026-246 נוסף על ידי גיא ענבר', 1, '2026-246', 0),
(2271, 0, '2026-01-26 13:09:19', ' מכרז מספר 2026-246 נערך על ידי גיא ענבר', 1, '2026-246', 0),
(2272, 0, '2026-01-26 13:09:33', ' מכרז מספר 2026-246 נערך על ידי גיא ענבר', 1, '2026-246', 0),
(2273, 382, '2026-01-26 13:12:47', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2274, 382, '2026-01-26 13:12:47', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2275, 382, '2026-01-26 13:12:47', 'מסמך לצירוף השכלה יתרון אושר על ידי גיא ענבר', 1, NULL, 0),
(2276, 382, '2026-01-26 13:12:47', 'מסמך לצירוף קורסים חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2277, 382, '2026-01-26 13:12:47', 'מסמך לצירוף נוספות חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2278, 382, '2026-01-26 13:12:47', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2279, 382, '2026-01-26 13:12:47', 'מסמך לצירוף אישור העסקה אושר על ידי גיא ענבר', 1, NULL, 0),
(2280, 382, '2026-01-26 13:12:47', 'מסמך לצירוף נסיון ניהולי אושר על ידי גיא ענבר', 1, NULL, 0),
(2281, 382, '2026-01-26 13:12:47', 'מסמך לצירוף קורות חיים אושר על ידי גיא ענבר', 1, NULL, 0),
(2282, 382, '2026-01-26 13:14:18', 'נשלח למועמד אישור ציפיות שכר על ידי גיא ענבר', 1, NULL, 0),
(2283, 382, '2026-01-26 13:14:24', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2284, 382, '2026-01-26 13:14:32', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(2285, 0, '2026-01-26 13:22:31', ' מכרז מספר 2026-247 נוסף על ידי גיא ענבר', 1, '2026-247', 0),
(2286, 383, '2026-01-26 13:24:20', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2287, 383, '2026-01-26 13:24:20', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2288, 383, '2026-01-26 13:24:20', 'מסמך לצירוף השכלה יתרון אושר על ידי גיא ענבר', 1, NULL, 0),
(2289, 383, '2026-01-26 13:24:20', 'מסמך לצירוף קורסים חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2290, 383, '2026-01-26 13:24:20', 'מסמך לצירוף מקצועי יתרון אושר על ידי גיא ענבר', 1, NULL, 0),
(2291, 383, '2026-01-26 13:24:20', 'מסמך לצירוף נוספות חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2292, 383, '2026-01-26 13:24:20', 'מסמך לצירוף ניהולי יתרון אושר על ידי גיא ענבר', 1, NULL, 0),
(2293, 383, '2026-01-26 13:24:20', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2294, 383, '2026-01-26 13:24:20', 'מסמך לצירוף אישור העסקה אושר על ידי גיא ענבר', 1, NULL, 0),
(2295, 383, '2026-01-26 13:24:20', 'מסמך לצירוף נסיון ניהולי אושר על ידי גיא ענבר', 1, NULL, 0),
(2296, 383, '2026-01-26 13:24:20', 'מסמך לצירוף קורות חיים אושר על ידי גיא ענבר', 1, NULL, 0),
(2297, 383, '2026-01-26 13:24:30', 'נשלח למועמד אישור ציפיות שכר על ידי גיא ענבר', 1, NULL, 0),
(2298, 383, '2026-01-26 13:24:36', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2299, 383, '2026-01-26 13:24:43', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(2300, 0, '2026-01-26 13:36:07', ' מכרז מספר 2026-248 נוסף על ידי גיא ענבר', 1, '2026-248', 0),
(2301, 385, '2026-01-26 15:35:39', 'מסמך לצירוף השכלה חובה נדחה <br>סיבת הדחייה:ךך', 1, NULL, 0),
(2302, 384, '2026-01-26 15:35:54', ' מסמך לצירוף השכלה חובה הושלם על ידי המועמד ', 1, NULL, 0),
(2303, 385, '2026-01-26 15:36:34', 'מסמך לצירוף השכלה חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2304, 385, '2026-01-26 15:36:38', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2305, 385, '2026-01-26 15:36:38', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2306, 385, '2026-01-26 15:36:38', 'מסמך לצירוף השכלה חובה אושר על ידי גיא ענבר', 1, NULL, 0),
(2307, 385, '2026-01-26 15:36:38', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2308, 385, '2026-01-26 15:36:38', 'מסמך לצירוף מסמך שירות לאומי/צבאי אושר על ידי גיא ענבר', 1, NULL, 0),
(2309, 385, '2026-01-26 15:36:38', 'מסמך לצירוף אישור העסקה אושר על ידי גיא ענבר', 1, NULL, 0),
(2310, 385, '2026-01-26 15:36:38', 'מסמך לצירוף נסיון ניהולי אושר על ידי גיא ענבר', 1, NULL, 0),
(2311, 385, '2026-01-26 15:36:38', 'מסמך לצירוף קורות חיים אושר על ידי גיא ענבר', 1, NULL, 0),
(2312, 0, '2026-01-27 16:13:45', ' מכרז מספר 2026-249 נוסף על ידי test', 1, '2026-249', 0),
(2313, 367, '2026-01-28 06:51:37', 'מועמד אישר הגעה לועדת בחינה', 1, NULL, 0),
(2314, 0, '2026-01-28 07:17:08', ' מכרז מספר 2026-250 נוסף על ידי גיא ענבר', 1, '2026-250', 0),
(2315, 398, '2026-01-28 07:19:17', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2316, 398, '2026-01-28 07:19:17', 'טופס הבקשה אושר על ידי גיא ענבר', 1, NULL, 0),
(2317, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6IlJSZmpoRFh1RHg5dkRCVDFFd1Z4MGc9PSIsInZhbHVlIjoiNENyRHFURGlycTY0NHAwK29XditYQ3pCNEtQRDVkeFZMelNPb2FpL3FSVzlzSjdPZEhSRWE2RFdNRWRURTVtbUNJSk4xUDB6WW8xM0xUWmxnSFFOVXo5V0wyNC94MVJmM1Jjelp5Um1MdHVMeXd5aXZkMUltaE8vK28wMWt5YWciLCJtYWMiOiIyMjFjNmZmNGQ1YjZlZmYwNzE2OTljMGVlOTNiMjQ0MDRlNmU1N2Q0MGM2Yzk4MzE3MzBjNjFlZmE5NWQyNjFiIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2318, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6ImlqdDFnUFU3Q2pBVExjM0NrMEplcWc9PSIsInZhbHVlIjoiaWNMbVJMODBNKzEzRXJ2a3N2dHFBeSs5RDU1WG5rMHhORC9KV3JHL0lGV2tKRy9WZWN5YkpCYVNIdGk2K3hOaEJzdEc4N09TQzJ6Q0JacnBvNXdNZUNkQXZ3SG82VnA4QUFGSjB0R1F0TnB2bUVrTzUvclp0RVpJZlhKZFVlaUxrWUNZUHNYOGdwZUFOaUNGS2NmMjNBPT0iLCJtYWMiOiJmYTM1MjY3MTJiZjU1MTg2NmIwODQ0MzIzYWM1MDIzOGZmNjFlY2UyM2I2Yjc2NGQ4ZTBlNjFjNjkzODNkM2M4IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2319, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6InJXNVdPRHFhd0pUU0tibS9oaVFReWc9PSIsInZhbHVlIjoiekp3UGN0dElPSm80eDJCNklHcCtoVkhibUx4Z0xTV3NydXZIR0pIdm5pMmNRZGUvNmozcXRQQTBOTUJnVlJ2bTBPV09IRVJSZ1Zibjl5WUpCTU4xbzRWejZCdFNSOSt5dnJyNGhVWFA4QXFhTHdKOXp3MFo2UlhLSTgzTE84R0ZtbDJtcGJnbjdZcUZNZDJXZmF0Uml3PT0iLCJtYWMiOiIwYjU4ZDU1Yzk5M2YzNmE1MDcyNTJiOWRiMzVjMmNmZTU2ZjI4ODVlZjIyODQ2ZGU2ODQ5MDA1MjI5M2E4NTZiIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2320, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6Ijdmam5UNVhxdnA2UDZSQWc3WThyY3c9PSIsInZhbHVlIjoidDhSeUZROEdNQW1uNkNKU2JwbzZ1UTNodTJuUzFhMkduMlRkYWhXdDVaZW9xaTV0TTJLZHAzS0l1QUdPZDlJc3FDKzlTVDRZSWRmdVpOQjJ1RjUvdk9kOFNKRHNrM0tJMWRxWGJqMHdBTlZvRkpVY0FuOVhXUDRJcGNqNUIxRmxhMVhiT2xsSjhORlJPaEFtdGk0cHNnPT0iLCJtYWMiOiIyYzY3MDQzZTY0OWU5ODUxMTM1YmEwZGFhNTFiNTg2YjYxMThhZmUzZDU4ZDYyMDljYTJmY2NjNTUwZTQzMjlhIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2321, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6ImdNZ2o0b0lHUXN0QVlzME5sbWZOSWc9PSIsInZhbHVlIjoiNEMzbThuOHU1c2JLZVZRRWNPNXJNclZyMGxWMVZKYzlGTkQ4bXRITVJSYWJqa25lZkFwTXd4RkY3aUpyMXZZSm1UZStxUTlES0hSYkhTWGRha3ZqNjlUVSt4dy9HQ1ZwVkM5YVBVWWl3ekdIdXBSWVVIMUw5bC9hRDdRc1N6Z0l4d3plbGJOQ0F2RUQrcXpZb25Ta2x4cTRJOWloL2RXWDBIR25FNXM4b1dYbjl5NHdvRXJlQzB1aEx0WFk2NDFuIiwibWFjIjoiZmJhODFlOTAzZmQzNzg4MDNjOTcyNDJmMWY0NTQ1MGZlYzViNzBjNDIwZjk2ZWY0OTNkZjBhYWM5ZTIyZDE0OCIsInRhZyI6IiJ9 אושר על ידי גיא ענבר', 1, NULL, 0),
(2322, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6ImFPUExYdmp4QmppalFub0RUSVFPN1E9PSIsInZhbHVlIjoiMW03UVZxdDJhdXpnN3kzeUNDRGprVmoxUEFlYnl2dWxSZ3Aydjc3OGZVcFg2OGtSSHdhUngwQmVROTJrQk1TYnJrRUtPQmRQTitxTXlpR1JObkM4ejRJZEFjY2c5L0pzSG1PbVdkUE9OMEhxVWxEVHlZeFBWT0dsVnp4cTlYR3g3cFpMd1dWUC9IQjlXbEpNaTBnTHdBPT0iLCJtYWMiOiJjZDQwMzg1NWI3ZDlkMjZmY2FiNThjZjk4ZmMzYzM4ODQ0MjExYjI4NjVjZjc0MjIyZDQ0YjUyMDFkY2U1OTE5IiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2323, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6IkhUbzlYbnd0M1dGc0d4cDNJRDVhR1E9PSIsInZhbHVlIjoiVVBlYlpnOGxodmkreTlEUGdJWU9KMTl2SlpvdFNxb05lYjcvY09mVXFzOWNhYWU3MFhPUk5MK2Z1ZlRWUWQ4VHl5SXpDRWIvVElBSHJQMHpDWTQ1RDFQNXN3cVBycWttMlc3WDd0WVJqNnAxVGp3SXBrRTEyZ2grR0dQdmI2b3l0bE56T0hNV083cko2WWFXLzV6T3NRPT0iLCJtYWMiOiI2Y2Y5YWFjZGZjNmY4ZTUwZjE4NmFhMjFiNmM2MzE1YTE1YmI1OWE4OGM1MDBiMzM1MzE5YzAzMzE4ZmI2MTllIiwidGFnIjoiIn0= אושר על ידי גיא ענבר', 1, NULL, 0),
(2324, 398, '2026-01-28 07:19:17', 'מסמך לצירוף eyJpdiI6IkdFSDZWTGZDRFMzR1dFTitZNjR0emc9PSIsInZhbHVlIjoiVUF1NllPdmk4S0d0QnFZUXAzNnRjS05lQlMwUmVXQ3B2NmdWYm5IaFZUdTRqV21IdTdmZDVYWlVmcCtsczNiUUhIYVhYZ01zYjhmMDZZNFFuSHJ5Vm8vNzVYdi9PWDVBZWlxQURWdzBiSUE9IiwibWFjIjoiNTI3M2IzM2RjNTFlNTA4ZWJkMzkzMzhmYmI4Y2EyM2ViZjVlYzMzNWFjNmJhZTFiZjJkMzM3ZGNmOWUyNTM2ZSIsInRhZyI6IiJ9 אושר על ידי גיא ענבר', 1, NULL, 0),
(2325, 398, '2026-01-28 07:23:06', 'נשלח למועמד אישור ציפיות שכר על ידי גיא ענבר', 1, NULL, 0),
(2326, 398, '2026-01-28 07:23:11', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2327, 398, '2026-01-28 07:23:52', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2328, 397, '2026-01-28 07:42:03', 'טופס הבקשה אושר על ידי test', 1, NULL, 0),
(2329, 397, '2026-01-28 07:42:06', 'טופס הבקשה אושר על ידי test', 1, NULL, 0),
(2330, 397, '2026-01-28 07:42:14', 'מסמך לצירוף eyJpdiI6IitjNHpyRHA4dlVDVFVFbFU4eW1aanc9PSIsInZhbHVlIjoiaFNxZE9vN3NrYUo1QnZFcDVoRHA2NWc2b3pSMVUyeTdBN2R0QTZWN2c1YkxMYThQK1pNd25NU1RuZnRUUWxyRGRNV2h1SHZ1WGJPUjhRYTBROGlZbFFyR3U4alBRYXJrZCtuY25sY0xIc1A2VDcrT0FVelJOb3F5cm9MV0hqR00rcVlDYyswdEd3V2NJRmNydU1CRlQvdnQyUjJMOXpMbHJzTXpMSjlHZ2pVYnRjL2NuaVVPdGpEVTBCWlRGOHVKTTZTV0MxRFN5OSt0cFlYMHRLR3MvWUxFOWRPejlad1lUUHJvaHlHLzZCdz0iLCJtYWMiOiJmMzg5ODc4ZDdmZmE1NDJjMmZhMmQwYzZmYTViNWZiZGEyMWQ5Y2M3OTM3NTQxNTEzM2ZiYWQwYmQ4NDQwNWM0IiwidGFnIjoiIn0= אושר על ידי test', 1, NULL, 0),
(2331, 397, '2026-01-28 07:42:17', 'מסמך לצירוף eyJpdiI6Inp0NHh5V0J2aEVkeTZLa2g3RkxrbFE9PSIsInZhbHVlIjoiWEtINkxWVXdhdHR6SDFYWE90Uk0xUE5FZ2dZeGFmeGVJYXNlT3BOSFdBTlcxLzFaQStwNjhzV1NnYTRuVWlaVkQrL0gyZjdwZzVXVGxqWitDM0JuV2RpZnJSMzBZUjgwQUxtL3p4djgxR0lGMG4rOS9wdDhZdkdhY2NEUDJjS1J5UW5DK2NyOE5CQWNJZGwxa0VSZVQyaFJ4MHM1NzZuZ0xFbWNDODdkUGNBeWFzSXZCV3ZadWY2RkNhbzR0MzZzeEN5LzhPdERTb3RGQkRNanJpZUV2NE12bjFRWStqSmR6bExJNjRFWFNKUT0iLCJtYWMiOiJkYzZmNzMyNjNiMjMyNmFjOWMxYTZhNzMwNWNiNTY2Yzg5NjYwZTMwZjRiNzIyYmFlNzUyY2UxOGZjODAwMGQxIiwidGFnIjoiIn0= אושר על ידי test', 1, NULL, 0),
(2332, 397, '2026-01-28 07:42:21', 'מסמך לצירוף eyJpdiI6Imlkazd2QVF4RFNxejZ6NHZWU2creXc9PSIsInZhbHVlIjoiSllhL3BrUHZhbVk0anpybm04Q1g4aHlRL2kxUUQ2ODU5bDhxaTJOdlhyNi9WZ2owTXZzKzhrcXhML3g1SjhITzBEU2tTME84bjExZHJrSVM5NjkxWXFqRXBQbnRpOGE1OC9oemtqZGJ6dkhGTGpSejJmL2hPMkhKaGxBRlNGMVdDbDlJb1Evalg4U25WUEpiSDMxekZSWGZKN1VpRXpVWmdSVUxxSWo4VU9VYm4wSnlKeHVQTkNuc01xVW9EUU5xUmFrc0Y4TVlHbWFoWXRpM0xRTFB4UT09IiwibWFjIjoiYWNjZGVjMWNkNzJiMWZmYjc0ZDlkMzM2ODdmYjE2ZTQ5YjIzYzBmZjc2ZjkwMDQ4ZjYxNDczMzM3Nzc5M2UzMiIsInRhZyI6IiJ9 אושר על ידי test', 1, NULL, 0),
(2333, 397, '2026-01-28 07:42:25', 'מסמך לצירוף eyJpdiI6InQ0bnVSd1NFYWNLY1A3TS9WWUU5enc9PSIsInZhbHVlIjoiUThZV0lwQndPdTZBQ0o4UFZBMEVuUmF4Um40dlh0cGZtTTZKc3hENnRWbncweStZcVpLMWhGdXdGdEhtS25CNkY5Zy9NMEhrSEhSVUQzQ3ZpbUk0NGpJZlRFZGxvSlpHUVEvVHZCenhNUk5oR085ZFN1NXpMUDFicU9leVBKVWpnQ2FXeXk3WWpqdVEwK2d0ZHAzTERxTzNsT0doQnhtSGVqWHc1SE42ekErRUtCNEZZczJSOEEwOHFVdFFsMHpvVngwaW0rdEo5QVZDUFJIN2tMRXZhRHVHcy8vUzlFYVRvYThWQ3RSZ2lFcz0iLCJtYWMiOiJjNjc2Njk4NGE1NTBlNDgwYjM4YWU1MWE2MGYyZGM4M2VkNmNlODFiNDBmYzZlOWVmNGY5OTUxZmQyNDM3ZTExIiwidGFnIjoiIn0= אושר על ידי test', 1, NULL, 0),
(2334, 397, '2026-01-28 07:42:29', 'מסמך לצירוף eyJpdiI6IjIwRms5ZnVoTlNyWjdtc1FUcmdaa3c9PSIsInZhbHVlIjoiYzVsQTJwWnhxQ1hUd0xmaENRS2kyOHJyZHRjNXVxcmNoNzdoUlh0dWNjbjd4NWZUbXluSERkYllKbG5oanowc1BUdEtBZGE0QnJVOFVaTmx4V243bmVvUkFTdTRadkR0enZUSmh0anNKSThTVDhvcFRoS0ovR0Uybk5NcmxVb0JyMVRNTlFITVRqekNUN3pKNmJ0RlcydGYxdjBmL2h6cDZXOUlvRmtjVlNwVDlEOG1jMjJlMXJMKzlVL2E4bXZ4d24yWDI4WGF6YlBoWDBZL0VDcG1adz09IiwibWFjIjoiZWMzMGVmNGFmYzNiNGYyYTNjOGI2ZjIzZTJjODVlYTdjYjA4NDFlYWMzNDBiMmIzMGI0M2ZhM2NkOTk1N2U2MSIsInRhZyI6IiJ9 אושר על ידי test', 1, NULL, 0),
(2335, 397, '2026-01-28 07:42:35', 'מסמך לצירוף eyJpdiI6IjlMM3ZpT1g0MXRKT3kvQzBqWWNvZFE9PSIsInZhbHVlIjoiUnZFcGlxWk9RN2NQNXN3a2pDRmFUb3BPY2NDaE1yTmRNTzhlZ01vWWpJVmhpT2VXb0VZcG0wTjhUTkQ5Y24venNVWmx6N1h4bDZWRXZrbVcyaGFoMS9YNWpnc1RXeG1ZRHRVaEIrU3hDWjB1YjgzZWJwSjdpTnh1WVd1bDFIS0JNUkkvVDR6WGh0N3dRZ3lyR0xkN1NSR0dkT2l2UjEzUHpUSWhrYmUrclltVDRoL20rYXY5dXovTFl3TTZxRzVWIiwibWFjIjoiZGNjM2VkYzlmZmViM2U0ZDY2MDJiNjc3ZGJkOWJjNDI3NjUxYjgyZmQ5ZmE0OTM4MTUwNTMxYWRiMDcwOGVmNSIsInRhZyI6IiJ9 אושר על ידי test', 1, NULL, 0),
(2336, 398, '2026-01-28 07:52:09', ' נשלח למועמד זימון לועדת בחינה על ידי גיא ענבר', 1, NULL, 0),
(2337, 398, '2026-01-28 08:04:51', ' נשלח למועמד זימון לועדת בחינה על ידי test', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apps_meta`
--

CREATE TABLE `apps_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(11) NOT NULL,
  `meta_name` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps_meta`
--

INSERT INTO `apps_meta` (`id`, `app_id`, `meta_name`, `meta_value`) VALUES
(1, 101, 'tender_num_display', '2024-101'),
(3, 102, 'tender_num_display', '2024-102'),
(12, 103, 'tender_num_display', '2024-103'),
(14, 104, 'tender_num_display', '2024-104'),
(16, 105, 'tender_num_display', '2024-105'),
(17, 106, 'tender_num_display', '2024-106'),
(18, 107, 'tender_num_display', '2024-107'),
(20, 108, 'tender_num_display', '2024-108'),
(21, 109, 'tender_num_display', '2024-109'),
(22, 110, 'tender_num_display', '2024-110'),
(23, 111, 'tender_num_display', '2024-111'),
(24, 112, 'tender_num_display', '2024-112'),
(25, 113, 'tender_num_display', '2024-113'),
(35, 114, 'tender_num_display', '2024-114'),
(36, 115, 'tender_num_display', '2024-115'),
(37, 116, 'tender_num_display', '2024-116'),
(38, 117, 'tender_num_display', '2024-117'),
(43, 118, 'tender_num_display', '2024-118'),
(44, 119, 'tender_num_display', '2024-119'),
(45, 120, 'tender_num_display', '2024-120'),
(46, 121, 'tender_num_display', '2024-121'),
(53, 122, 'tender_num_display', '2024-122'),
(55, 123, 'tender_num_display', '2024-123'),
(78, 124, 'tender_num_display', '2025-124'),
(91, 125, 'tender_num_display', '2025-125'),
(111, 126, 'tender_num_display', '2025-126'),
(151, 127, 'tender_num_display', '2025-127'),
(205, 128, 'tender_num_display', '2025-128'),
(222, 129, 'tender_num_display', '2025-129'),
(231, 130, 'tender_num_display', '2025-130'),
(241, 131, 'tender_num_display', '2025-131'),
(252, 132, 'tender_num_display', '2025-132'),
(263, 133, 'tender_num_display', '2025-133'),
(278, 134, 'tender_num_display', '2025-134'),
(281, 135, 'tender_num_display', '2025-135'),
(286, 136, 'tender_num_display', '2025-136'),
(299, 137, 'tender_num_display', '2025-137'),
(320, 138, 'tender_num_display', '2025-138'),
(333, 139, 'tender_num_display', '2025-139'),
(378, 140, 'tender_num_display', '2025-140'),
(394, 141, 'tender_num_display', '2025-141'),
(404, 142, 'tender_num_display', '2025-142'),
(405, 143, 'tender_num_display', '2025-143'),
(406, 144, 'tender_num_display', '2025-144'),
(407, 145, 'tender_num_display', '2025-145'),
(410, 69, 'test_email', '681daf2c4db64_1746775852.pdf'),
(427, 146, 'tender_num_display', '2025-146'),
(428, 147, 'tender_num_display', '2025-147'),
(429, 148, 'tender_num_display', '2025-148'),
(433, 149, 'tender_num_display', '2025-149'),
(463, 150, 'tender_num_display', '2025-150'),
(467, 151, 'tender_num_display', '2025-151'),
(482, 152, 'tender_num_display', '2025-152'),
(485, 73, 'test_email', '682edb3a24ed8_1747901242.pdf'),
(536, 153, 'tender_num_display', '2025-153'),
(549, 154, 'tender_num_display', '2025-154'),
(566, 155, 'tender_num_display', '2025-155'),
(576, 156, 'tender_num_display', '2025-156'),
(608, 157, 'tender_num_display', '2025-157'),
(609, 158, 'tender_num_display', '2025-158'),
(649, 100, 'committee', '3,1@#$#@3,2025-06-23###10:30AM###Head Office'),
(666, 102, 'committee', '@#$#@'),
(673, 103, 'committee', '1@#$#@2025-06-25###10.15AM###Leads office'),
(676, 99, 'committee', '1@#$#@2025-06-23###9:30AM###ABC head office'),
(679, 100, 'committee', '2,1@#$#@30,2025-06-23###9:00###Test'),
(683, 159, 'tender_num_display', '2025-159'),
(692, 106, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(694, 106, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(697, 106, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(699, 105, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(701, 106, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(703, 105, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(706, 106, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(708, 105, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(710, 104, 'committee', '4,3,2,1@#$#@10,3,10,תאריך###זמן###מיקום'),
(744, 58, 'committee', '@#$#@'),
(757, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(760, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(763, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(766, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(768, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(771, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(773, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(775, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(777, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(780, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(782, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(784, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(787, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(789, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(792, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(794, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(796, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(798, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(801, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(803, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(805, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(808, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(810, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(813, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(815, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(817, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(819, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(822, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(824, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(826, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(829, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(832, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(835, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(838, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(840, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(843, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(845, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(847, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(850, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(852, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(854, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(856, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(859, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(861, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(863, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(865, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(867, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(870, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(872, 104, 'committee', '4,3,2,1@#$#@,3,,######'),
(874, 103, 'committee', '4,3,2,1@#$#@,3,,######'),
(877, 105, 'committee', '4,3,2,1@#$#@,3,,######'),
(922, 105, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(924, 105, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(927, 105, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(929, 104, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(931, 105, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(933, 104, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(936, 105, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(938, 104, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(940, 103, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###15:58###מיקום'),
(941, 160, 'tender_num_display', '2025-160'),
(962, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(964, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(967, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(969, 125, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(971, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(973, 125, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(976, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(978, 125, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(980, 124, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###18:22###מיקום'),
(1005, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1007, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1010, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1012, 121, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1014, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1016, 121, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1019, 126, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1021, 121, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1023, 118, 'committee', '4,3,2,1@#$#@,,10,2025-06-27###14:43###loc'),
(1026, 104, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1028, 104, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1031, 104, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1033, 102, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1035, 104, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1037, 102, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1040, 104, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1042, 102, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1044, 66, 'committee', '4,3,2,1@#$#@,,10,2025-07-10###20:42###loc'),
(1207, 161, 'tender_num_display', '2025-161'),
(1252, 162, 'tender_num_display', '2025-162'),
(1253, 163, 'tender_num_display', '2025-163'),
(1254, 164, 'tender_num_display', '2025-164'),
(1305, 165, 'tender_num_display', '2025-165'),
(1394, 166, 'tender_num_display', '2025-166'),
(1403, 167, 'tender_num_display', '2025-167'),
(1425, 168, 'tender_num_display', '2025-168'),
(1426, 169, 'tender_num_display', '2025-169'),
(1430, 170, 'tender_num_display', '2025-170'),
(1485, 171, 'tender_num_display', '2025-171'),
(1486, 172, 'tender_num_display', '2025-172'),
(1487, 173, 'tender_num_display', '2025-173'),
(1488, 174, 'tender_num_display', '2025-174'),
(1528, 175, 'tender_num_display', '2025-175'),
(1534, 176, 'tender_num_display', '2025-176'),
(1543, 177, 'tender_num_display', '2025-177'),
(1546, 178, 'tender_num_display', '2025-178'),
(1548, 179, 'tender_num_display', '2025-179'),
(1563, 180, 'tender_num_display', '2025-180'),
(1566, 181, 'tender_num_display', '2025-181'),
(1574, 182, 'tender_num_display', '2025-182'),
(1577, 183, 'tender_num_display', '2025-183'),
(1585, 184, 'tender_num_display', '2025-184'),
(1605, 185, 'tender_num_display', '2025-185'),
(1614, 186, 'tender_num_display', '2025-186'),
(1622, 187, 'tender_num_display', '2025-187'),
(1623, 283, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-25 08:18:43'),
(1625, 284, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-25 08:39:39'),
(1633, 285, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-25 12:51:02'),
(1635, 286, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-25 13:53:28'),
(1637, 287, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-25 13:55:53'),
(1639, 288, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-25 14:14:45'),
(1641, 188, 'tender_num_display', '2025-188'),
(1642, 289, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-28 08:26:50'),
(1649, 189, 'tender_num_display', '2025-189'),
(1650, 190, 'tender_num_display', '2025-190'),
(1651, 191, 'tender_num_display', '2025-191'),
(1652, 192, 'tender_num_display', '2025-192'),
(1653, 290, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-30 13:32:21'),
(1655, 291, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-30 15:03:01'),
(1657, 292, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-09-30 15:44:00'),
(1659, 193, 'tender_num_display', '2025-193'),
(1660, 293, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 11:14:10'),
(1662, 294, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 12:28:05'),
(1664, 295, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 14:47:20'),
(1666, 296, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 17:05:52'),
(1668, 297, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 21:15:49'),
(1670, 298, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 22:12:44'),
(1672, 299, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 22:29:22'),
(1674, 300, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 22:36:00'),
(1676, 303, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 23:05:31'),
(1678, 304, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-01 23:10:42'),
(1680, 305, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-02 15:36:36'),
(1682, 194, 'tender_num_display', '2025-194'),
(1683, 195, 'tender_num_display', '2025-195'),
(1684, 196, 'tender_num_display', '2025-196'),
(1685, 197, 'tender_num_display', '2025-197'),
(1686, 306, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 01:00:25'),
(1688, 198, 'tender_num_display', '2025-198'),
(1689, 199, 'tender_num_display', '2025-199'),
(1690, 307, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 12:23:58'),
(1698, 308, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 12:47:32'),
(1705, 200, 'tender_num_display', '2025-200'),
(1706, 201, 'tender_num_display', '2025-201'),
(1707, 309, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 21:18:40'),
(1709, 202, 'tender_num_display', '2025-202'),
(1710, 310, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 22:41:52'),
(1712, 311, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 23:02:08'),
(1714, 312, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 23:17:42'),
(1716, 313, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 23:26:40'),
(1718, 314, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-03 23:39:44'),
(1729, 203, 'tender_num_display', '2025-203'),
(1730, 315, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 01:59:20'),
(1732, 316, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 02:02:15'),
(1734, 317, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 02:20:14'),
(1741, 204, 'tender_num_display', '2025-204'),
(1742, 318, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 13:26:59'),
(1749, 319, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 15:15:38'),
(1756, 320, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 15:44:56'),
(1758, 321, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-04 15:53:28'),
(1764, 205, 'tender_num_display', '2025-205'),
(1765, 322, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-05 12:44:10'),
(1776, 206, 'tender_num_display', '2025-206'),
(1777, 323, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-05 12:59:11'),
(1784, 324, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-05 14:46:35'),
(1793, 327, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-05 18:29:03'),
(1800, 328, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-05 20:18:18'),
(1807, 329, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-05 21:31:21'),
(1814, 207, 'tender_num_display', '2025-207'),
(1815, 330, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-06 10:45:47'),
(1826, 208, 'tender_num_display', '2025-208'),
(1827, 331, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-06 10:51:55'),
(1834, 209, 'tender_num_display', '2025-209'),
(1835, 332, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-07 07:43:27'),
(1842, 210, 'tender_num_display', '2025-210'),
(1843, 211, 'tender_num_display', '2025-211'),
(1844, 333, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-07 09:09:29'),
(1851, 212, 'tender_num_display', '2025-212'),
(1852, 334, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-07 17:49:30'),
(1859, 213, 'tender_num_display', '2025-213'),
(1860, 335, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-07 17:54:23'),
(1867, 214, 'tender_num_display', '2025-214'),
(1868, 336, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-07 17:59:20'),
(1875, 215, 'tender_num_display', '2025-215'),
(1876, 337, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-09 08:49:50'),
(1883, 216, 'tender_num_display', '2025-216'),
(1884, 338, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-10-09 08:53:04'),
(1891, 217, 'tender_num_display', '2025-217'),
(1892, 218, 'tender_num_display', '2025-218'),
(1893, 219, 'tender_num_display', '2025-219'),
(1894, 339, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-11-04 08:56:55'),
(1902, 220, 'tender_num_display', '2025-220'),
(1903, 340, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-11-04 15:07:14'),
(1905, 341, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-11-04 15:12:34'),
(1912, 221, 'tender_num_display', '2025-221'),
(1913, 342, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-11-05 07:37:07'),
(1915, 343, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-11-05 07:39:30'),
(1923, 222, 'tender_num_display', '2025-222'),
(1924, 344, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-11-10 14:48:09'),
(1933, 223, 'tender_num_display', '2025-223'),
(1934, 224, 'tender_num_display', '2025-224'),
(1935, 225, 'tender_num_display', '2025-225'),
(1936, 345, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-12-04 13:49:00'),
(1937, 345, 'metaJson', 'a:139:{s:8:\"tenderid\";s:8:\"2025-225\";s:6:\"brunch\";s:21:\"מחלקת קהילה\";s:5:\"tname\";s:71:\"מנהל ישובי למניעת אלימות סמים ואלכוהול\";s:4:\"vals\";s:3:\"334\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"קרינה\";s:8:\"lastname\";s:8:\"הללי\";s:11:\"oldlastname\";s:12:\"בנגייב\";s:5:\"id_tz\";s:9:\"316949064\";s:5:\"email\";s:22:\"karinahaleli@gmail.com\";s:14:\"personal_phone\";s:7:\"3932938\";s:21:\"personal_phone_select\";s:3:\"054\";s:6:\"gender\";s:6:\"female\";s:13:\"personal_city\";s:19:\"קריית ארבע\";s:15:\"personal_street\";s:21:\"יוני נתניהו\";s:14:\"personal_house\";s:4:\"1022\";s:13:\"personal_flat\";s:1:\"1\";s:16:\"personal_zipcode\";s:7:\"9010000\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2017-09-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2018-08-31\";}s:14:\"military_roles\";a:1:{i:0;s:15:\"כפר נוער\";}s:12:\"exp_position\";a:9:{i:0;s:10:\"מעהמה\";i:1;s:16:\"אואטיארט\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2022-07-04\";i:1;s:10:\"2023-01-04\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2022-12-01\";i:1;s:10:\"2024-07-10\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:12:\"מההנמה\";i:1;s:12:\"אאטארט\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:8:\"נמהמ\";i:1;s:12:\"טארטטר\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:12:\"85% משרה\";i:1;s:3:\"75%\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:36:\"מעונות אורחות חינוך\";}s:10:\"expp_descr\";a:1:{i:0;s:19:\"מנהלת מעון\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2024-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2024-06-20\";}s:13:\"expp_employee\";a:1:{i:0;s:2:\"15\";}s:10:\"expp_level\";a:1:{i:0;N;}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:8:\"edu_type\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:6:\"פרס\";i:1;s:6:\"פרס\";i:2;s:6:\"פרס\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:34:\"ייעוץ פיתוח ארגוני\";i:1;s:34:\"ייעוץ פיתוח ארגוני\";i:2;s:34:\"ייעוץ פיתוח ארגוני\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";}s:14:\"educ_last_year\";a:3:{i:0;s:4:\"2023\";i:1;s:4:\"2023\";i:2;s:4:\"2023\";}s:13:\"diploma_exist\";s:3:\"yes\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";N;s:10:\"start_date\";N;s:8:\"end_date\";N;s:15:\"study_framework\";N;s:11:\"certificate\";N;s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:21:\"שליטה חלקית\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;N;i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;N;i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;N;i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;N;i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;N;i:1;N;}s:21:\"form5_additional_text\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:11:\"form5_nigud\";s:2:\"no\";s:16:\"form5_nigud_text\";s:6:\"צממ\";s:9:\"form3_ch2\";s:2:\"no\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:6:\"ךלף\";s:9:\"form3_ch3\";s:3:\"yes\";s:9:\"moth_sign\";s:5890:\"data:image/png;base64,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\";s:12:\"condition527\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition528\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition529\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition530\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition531\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition532\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition533\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition534\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition535\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition536\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition628\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition629\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition630\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition631\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition632\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition633\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition634\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition635\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition636\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition637\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition729\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition730\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition731\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition732\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition733\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition734\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition735\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition736\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition737\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition738\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition830\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition831\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition832\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition833\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition834\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition835\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition836\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition837\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition838\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition839\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition931\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition932\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition933\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition934\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition935\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition936\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition937\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition938\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition939\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition940\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:13:\"condition1032\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1033\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1034\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1035\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1036\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1037\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1038\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1039\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1040\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1041\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(1938, 346, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-12-04 14:28:30'),
(1939, 346, 'metaJson', 'a:138:{s:8:\"tenderid\";s:8:\"2025-225\";s:6:\"brunch\";s:21:\"מחלקת קהילה\";s:5:\"tname\";s:71:\"מנהל ישובי למניעת אלימות סמים ואלכוהול\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"קרינה\";s:8:\"lastname\";s:8:\"הללי\";s:11:\"oldlastname\";s:12:\"בנגייב\";s:5:\"id_tz\";s:9:\"316949064\";s:5:\"email\";s:22:\"karinahaleli@gmail.com\";s:14:\"personal_phone\";s:7:\"3932938\";s:21:\"personal_phone_select\";s:3:\"054\";s:6:\"gender\";s:6:\"female\";s:13:\"personal_city\";s:19:\"קריית ארבע\";s:15:\"personal_street\";s:21:\"יוני נתניהו\";s:14:\"personal_house\";s:4:\"1022\";s:13:\"personal_flat\";s:1:\"1\";s:16:\"personal_zipcode\";s:7:\"9010000\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:2:{i:0;s:10:\"2017-09-01\";i:1;s:10:\"2019-10-04\";}s:16:\"military_to_date\";a:2:{i:0;s:10:\"2018-08-31\";i:1;s:10:\"2020-10-04\";}s:14:\"military_roles\";a:2:{i:0;s:15:\"כפר נוער\";i:1;s:12:\"כנכבעכ\";}s:12:\"exp_position\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"salary_accept\";s:3:\"yes\";s:13:\"expp_position\";a:1:{i:0;s:36:\"מעונות אורחות חינוך\";}s:10:\"expp_descr\";a:1:{i:0;s:19:\"מנהלת מעון\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2024-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2024-06-20\";}s:13:\"expp_employee\";a:1:{i:0;s:2:\"15\";}s:10:\"expp_level\";a:1:{i:0;N;}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:6:\"פרס\";i:1;s:6:\"פרס\";i:2;s:6:\"פרס\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:34:\"ייעוץ פיתוח ארגוני\";i:1;s:34:\"ייעוץ פיתוח ארגוני\";i:2;s:34:\"ייעוץ פיתוח ארגוני\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";}s:14:\"educ_last_year\";a:3:{i:0;s:4:\"2023\";i:1;s:4:\"2023\";i:2;s:4:\"2023\";}s:13:\"diploma_exist\";s:3:\"yes\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";N;s:10:\"start_date\";N;s:8:\"end_date\";N;s:15:\"study_framework\";N;s:11:\"certificate\";N;s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"חוסר שליטה\";i:1;s:21:\"שליטה חלקית\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;N;i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;N;i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;N;i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;N;i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;N;i:1;N;}s:21:\"form5_additional_text\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:11:\"form5_nigud\";s:2:\"no\";s:16:\"form5_nigud_text\";s:10:\"ההגהג\";s:9:\"form3_ch2\";s:2:\"no\";s:21:\"form3_disability_text\";s:16:\"ההבננכיכ\";s:19:\"form3_minority_text\";s:6:\"ךלף\";s:9:\"moth_sign\";s:3186:\"data:image/png;base64,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\";s:12:\"condition527\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition528\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition529\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition530\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition531\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition532\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition533\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition534\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition535\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition536\";s:100:\"תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז\";s:12:\"condition628\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition629\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition630\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition631\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition632\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition633\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition634\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition635\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition636\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition637\";s:308:\"ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון\";s:12:\"condition729\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition730\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition731\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition732\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition733\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition734\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition735\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition736\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition737\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition738\";s:106:\"שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.\";s:12:\"condition830\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition831\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition832\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition833\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition834\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition835\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition836\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition837\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition838\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition839\";s:43:\"האם הינך בעל תואר ראשון?\";s:12:\"condition931\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition932\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition933\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition934\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition935\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition936\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition937\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition938\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition939\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:12:\"condition940\";s:74:\"האם יש לך ניסיון בניהול 2 עובדים במשך שנה?\";s:13:\"condition1032\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1033\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1034\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1035\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1036\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1037\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1038\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1039\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1040\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:13:\"condition1041\";s:144:\"האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(1941, 346, 'email_msg', 'מייל נשלח בהצלחה'),
(1942, 347, 'committee_email', '6931815c4e6f6_1764852060.pdf'),
(1943, 347, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(1944, 347, 'committee_date', '04.12.2025'),
(1945, 347, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(1946, 347, 'committee_date', '04.12.2025'),
(1947, 346, 'committee_email', '6931815f77b21_1764852063.pdf'),
(1948, 346, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(1949, 346, 'committee_date', '04.12.2025'),
(1950, 346, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(1951, 346, 'committee_date', '04.12.2025'),
(1952, 347, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-12-09 08:18:10'),
(1955, 226, 'tender_num_display', '2025-226'),
(1956, 347, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(1957, 347, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(1958, 347, 'email_msg', 'מייל נשלח בהצלחה'),
(1959, 347, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(1960, 347, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(1961, 347, 'committee_email', '69383a39e16c8_1765292601.pdf'),
(1962, 347, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(1963, 347, 'committee_date', '04.12.2025'),
(1964, 347, 'test_email', '69383a6a3f342_1765292650.pdf'),
(1965, 347, 'email_msg_test', 'מייל זימון לבחינה בכתב נשלח בהצלחה'),
(1966, 227, 'tender_num_display', '2025-227'),
(1967, 228, 'tender_num_display', '2025-228'),
(1968, 348, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-12-14 23:27:15'),
(1970, 229, 'tender_num_display', '2025-229'),
(1971, 349, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2025-12-25 16:27:47'),
(1974, 230, 'tender_num_display', '2025-230'),
(1975, 350, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-01 16:07:36'),
(1977, 350, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:44:\"Yes or no addedThreshold conditionsAdvantage\";s:6:\"answer\";s:4:\"לא\";s:12:\"answer_value\";s:1:\"0\";s:4:\"text\";s:40:\"הערה עבור שאלת הכן ולא\";}}'),
(1978, 351, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-01 16:19:22'),
(1980, 351, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:44:\"Yes or no addedThreshold conditionsAdvantage\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:16:\"גכעכגעגכ\";}}'),
(1982, 352, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-04 11:16:23'),
(1984, 352, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:44:\"Yes or no addedThreshold conditionsAdvantage\";s:6:\"answer\";s:4:\"לא\";s:12:\"answer_value\";s:1:\"0\";s:4:\"text\";s:6:\"fghfgh\";}}'),
(1985, 353, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-04 13:29:40'),
(1987, 353, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:44:\"Yes or no addedThreshold conditionsAdvantage\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:4:\"test\";}}'),
(1988, 231, 'tender_num_display', '2025-231'),
(1989, 354, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-04 16:45:34'),
(1991, 354, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:14:\"כן או לא\";s:6:\"answer\";s:4:\"לא\";s:12:\"answer_value\";s:1:\"0\";s:4:\"text\";s:34:\"עונה על שאלה כן ולא\";}}'),
(1997, 355, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-05 12:05:12');
INSERT INTO `apps_meta` (`id`, `app_id`, `meta_name`, `meta_value`) VALUES
(1999, 355, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:25:\"שאלות כן או לא\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:25:\"הערה לכן או לא\";}}'),
(2000, 356, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-06 08:31:32'),
(2002, 356, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:25:\"שאלות כן או לא\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:25:\"הערה לכן או לא\";}}'),
(2003, 232, 'tender_num_display', '2026-232'),
(2004, 357, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-06 08:41:31'),
(2011, 233, 'tender_num_display', '2026-233'),
(2012, 358, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-07 08:34:46'),
(2019, 234, 'tender_num_display', '2026-234'),
(2020, 359, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-07 15:02:54'),
(2022, 359, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:14:\"כן או לא\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2028, 360, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-07 15:52:03'),
(2030, 360, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:14:\"כן או לא\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2036, 235, 'tender_num_display', '2026-235'),
(2037, 361, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-07 16:07:45'),
(2044, 236, 'tender_num_display', '2026-236'),
(2045, 362, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-07 16:11:57'),
(2053, 237, 'tender_num_display', '2026-237'),
(2054, 363, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-08 09:46:19'),
(2056, 363, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2062, 364, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-08 12:43:15'),
(2064, 364, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2065, 365, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-08 12:45:50'),
(2067, 365, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2068, 366, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-19 17:49:29'),
(2069, 366, 'metaJson', 'a:130:{s:8:\"tenderid\";s:8:\"2026-237\";s:6:\"brunch\";N;s:5:\"tname\";s:19:\"בדיקה חדשה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:8:\"אולי\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:12:\"גכעכגע\";s:8:\"lastname\";s:10:\"גכעכג\";s:11:\"oldlastname\";s:10:\"גכעכג\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"4564565\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיכע\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";N;s:16:\"personal_zipcode\";s:3:\"555\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2025-10-08\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2025-11-12\";}s:14:\"military_roles\";a:1:{i:0;s:17:\"תפקיד שני\";}s:12:\"exp_position\";a:9:{i:0;s:5:\"dfgfd\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-07\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:3:\"dfg\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:5:\"dfgdf\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:5:\"dfgfd\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:10:\"דרגדכ\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"דגכגדכ\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-05\";}s:13:\"expp_employee\";a:1:{i:0;s:12:\"דגכגדכ\";}s:10:\"expp_level\";a:1:{i:0;s:12:\"דגכגדכ\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:8:\"גבוה\";i:1;s:8:\"גבוה\";i:2;s:8:\"גבוה\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:8:\"גבוה\";i:1;s:8:\"גבוה\";i:2;s:8:\"גבוה\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:8:\"גבוה\";i:1;s:8:\"גבוה\";i:2;s:8:\"גבוה\";}s:14:\"educ_last_year\";a:3:{i:0;s:8:\"גבוה\";i:1;s:8:\"גבוה\";i:2;s:8:\"גבוה\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:3:\"yes\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:10:\"דגכדג\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-06\";s:15:\"study_framework\";s:6:\"גדכ\";s:11:\"certificate\";s:12:\"דגכדגכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:21:\"שליטה חלקית\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:9:\"456546546\";i:1;N;}s:21:\"form5_additional_text\";s:16:\"גכעגכעכג\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:10:\"disability\";s:21:\"form3_disability_text\";s:8:\"fghgfhgf\";s:19:\"form3_minority_text\";N;s:9:\"moth_sign\";s:2454:\"data:image/png;base64,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\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:12:\"condition628\";s:23:\"קורסים יתרון\";s:12:\"condition629\";s:23:\"קורסים יתרון\";s:12:\"condition630\";s:23:\"קורסים יתרון\";s:12:\"condition631\";s:23:\"קורסים יתרון\";s:12:\"condition632\";s:23:\"קורסים יתרון\";s:12:\"condition633\";s:23:\"קורסים יתרון\";s:12:\"condition634\";s:23:\"קורסים יתרון\";s:12:\"condition635\";s:23:\"קורסים יתרון\";s:12:\"condition636\";s:23:\"קורסים יתרון\";s:12:\"condition637\";s:23:\"קורסים יתרון\";s:12:\"condition729\";s:21:\"מקצועי חובה\";s:12:\"condition730\";s:21:\"מקצועי חובה\";s:12:\"condition731\";s:21:\"מקצועי חובה\";s:12:\"condition732\";s:21:\"מקצועי חובה\";s:12:\"condition733\";s:21:\"מקצועי חובה\";s:12:\"condition734\";s:21:\"מקצועי חובה\";s:12:\"condition735\";s:21:\"מקצועי חובה\";s:12:\"condition736\";s:21:\"מקצועי חובה\";s:12:\"condition737\";s:21:\"מקצועי חובה\";s:12:\"condition738\";s:21:\"מקצועי חובה\";s:12:\"condition830\";s:23:\"נוספות יתרון\";s:12:\"condition831\";s:23:\"נוספות יתרון\";s:12:\"condition832\";s:23:\"נוספות יתרון\";s:12:\"condition833\";s:23:\"נוספות יתרון\";s:12:\"condition834\";s:23:\"נוספות יתרון\";s:12:\"condition835\";s:23:\"נוספות יתרון\";s:12:\"condition836\";s:23:\"נוספות יתרון\";s:12:\"condition837\";s:23:\"נוספות יתרון\";s:12:\"condition838\";s:23:\"נוספות יתרון\";s:12:\"condition839\";s:23:\"נוספות יתרון\";s:12:\"condition931\";s:21:\"ניהולי חובה\";s:12:\"condition932\";s:21:\"ניהולי חובה\";s:12:\"condition933\";s:21:\"ניהולי חובה\";s:12:\"condition934\";s:21:\"ניהולי חובה\";s:12:\"condition935\";s:21:\"ניהולי חובה\";s:12:\"condition936\";s:21:\"ניהולי חובה\";s:12:\"condition937\";s:21:\"ניהולי חובה\";s:12:\"condition938\";s:21:\"ניהולי חובה\";s:12:\"condition939\";s:21:\"ניהולי חובה\";s:12:\"condition940\";s:21:\"ניהולי חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2070, 366, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2071, 367, 'email_msg', 'מייל נשלח בהצלחה'),
(2072, 238, 'tender_num_display', '2026-238'),
(2073, 367, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 11:14:33'),
(2075, 367, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:23:\"שאלות כן ולא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:24:\"תשובה לכן ולא\";}}'),
(2081, 239, 'tender_num_display', '2026-239'),
(2082, 368, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 14:33:11'),
(2084, 368, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:24:\"תשובה לכן ולא\";}}'),
(2085, 369, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 15:52:31'),
(2092, 240, 'tender_num_display', '2026-240'),
(2093, 370, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 15:55:31'),
(2105, 241, 'tender_num_display', '2026-241'),
(2106, 371, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 16:00:23'),
(2108, 371, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:12:\"גכעגכע\";}}'),
(2114, 242, 'tender_num_display', '2026-242'),
(2115, 372, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 16:04:11'),
(2117, 243, 'tender_num_display', '2026-243'),
(2118, 373, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 16:06:50'),
(2125, 374, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-20 16:22:39'),
(2132, 244, 'tender_num_display', '2026-244'),
(2133, 375, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-21 13:20:38'),
(2134, 375, 'metaJson', 'a:92:{s:8:\"tenderid\";s:8:\"2026-244\";s:6:\"brunch\";N;s:5:\"tname\";s:10:\"בדיקה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:8:\"אולי\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:5:\"43543\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:12:\"כגדכגד\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-21\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:10:\"דגכדג\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:12:\"דגכגדכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:14:\"דגכגדכד\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:8:\"edu_type\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:17:\"diploma_high_type\";a:1:{i:0;s:19:\"תואר ראשון\";}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:8:\"גכדג\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:10:\"דגכגד\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:10:\"דגכגד\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:10:\"דגכגד\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:11:\"32423432432\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";N;s:9:\"moth_sign\";s:3106:\"data:image/png;base64,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\";s:12:\"condition527\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition528\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition529\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition530\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition531\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition532\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition533\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition534\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition535\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition536\";s:45:\"שנות לימוד / תעודת בגרות12\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2135, 375, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2136, 376, 'email_msg', 'מייל נשלח בהצלחה'),
(2137, 376, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-21 13:54:17'),
(2138, 376, 'metaJson', 'a:90:{s:8:\"tenderid\";s:8:\"2026-244\";s:6:\"brunch\";N;s:5:\"tname\";s:10:\"בדיקה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:8:\"אולי\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:3:\"435\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:10:\"כעיעכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-13\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:10:\"כעיכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:10:\"כעיעכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:10:\"כיכעי\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:10:\"כעיעכ\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:10:\"כעיעכ\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:6:\"כעי\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:8:\"גכעי\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:8:\"34534435\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:12:\"כעיעכי\";s:9:\"moth_sign\";s:3482:\"data:image/png;base64,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\";s:12:\"condition527\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition528\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition529\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition530\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition531\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition532\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition533\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition534\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition535\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition536\";s:45:\"שנות לימוד / תעודת בגרות12\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2139, 376, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2140, 245, 'tender_num_display', '2026-245'),
(2141, 377, 'metaJson', 'a:132:{s:8:\"tenderid\";s:8:\"2026-245\";s:6:\"brunch\";s:19:\"אגף החינוך\";s:5:\"tname\";s:16:\"גדכגדכדג\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:8:\"אולי\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:5:\"45645\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:10:\"כגעכג\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-08\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-22\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:6:\"גכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:6:\"גכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:8:\"כעכג\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:8:\"edu_type\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:17:\"diploma_high_type\";a:1:{i:0;s:19:\"תואר ראשון\";}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:14:\"יעגכיעכ\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:10:\"כעיעכ\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:10:\"כעיעכ\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:10:\"כעיעכ\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:11:\"43543543543\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";N;s:9:\"moth_sign\";s:3426:\"data:image/png;base64,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\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:12:\"condition628\";s:21:\"קורסים חובה\";s:12:\"condition629\";s:21:\"קורסים חובה\";s:12:\"condition630\";s:21:\"קורסים חובה\";s:12:\"condition631\";s:21:\"קורסים חובה\";s:12:\"condition632\";s:21:\"קורסים חובה\";s:12:\"condition633\";s:21:\"קורסים חובה\";s:12:\"condition634\";s:21:\"קורסים חובה\";s:12:\"condition635\";s:21:\"קורסים חובה\";s:12:\"condition636\";s:21:\"קורסים חובה\";s:12:\"condition637\";s:21:\"קורסים חובה\";s:12:\"condition729\";s:21:\"מקצועי חובה\";s:12:\"condition730\";s:21:\"מקצועי חובה\";s:12:\"condition731\";s:21:\"מקצועי חובה\";s:12:\"condition732\";s:21:\"מקצועי חובה\";s:12:\"condition733\";s:21:\"מקצועי חובה\";s:12:\"condition734\";s:21:\"מקצועי חובה\";s:12:\"condition735\";s:21:\"מקצועי חובה\";s:12:\"condition736\";s:21:\"מקצועי חובה\";s:12:\"condition737\";s:21:\"מקצועי חובה\";s:12:\"condition738\";s:21:\"מקצועי חובה\";s:12:\"condition830\";s:21:\"נוספות חובה\";s:12:\"condition831\";s:21:\"נוספות חובה\";s:12:\"condition832\";s:21:\"נוספות חובה\";s:12:\"condition833\";s:21:\"נוספות חובה\";s:12:\"condition834\";s:21:\"נוספות חובה\";s:12:\"condition835\";s:21:\"נוספות חובה\";s:12:\"condition836\";s:21:\"נוספות חובה\";s:12:\"condition837\";s:21:\"נוספות חובה\";s:12:\"condition838\";s:21:\"נוספות חובה\";s:12:\"condition839\";s:21:\"נוספות חובה\";s:12:\"condition931\";s:21:\"ניהולי חובה\";s:12:\"condition932\";s:21:\"ניהולי חובה\";s:12:\"condition933\";s:21:\"ניהולי חובה\";s:12:\"condition934\";s:21:\"ניהולי חובה\";s:12:\"condition935\";s:21:\"ניהולי חובה\";s:12:\"condition936\";s:21:\"ניהולי חובה\";s:12:\"condition937\";s:21:\"ניהולי חובה\";s:12:\"condition938\";s:21:\"ניהולי חובה\";s:12:\"condition939\";s:21:\"ניהולי חובה\";s:12:\"condition940\";s:21:\"ניהולי חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2142, 377, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2143, 378, 'metaJson', 'a:90:{s:8:\"tenderid\";s:8:\"2026-244\";s:6:\"brunch\";N;s:5:\"tname\";s:10:\"בדיקה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:8:\"אולי\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:3:\"435\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:4:\"gfhf\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-22\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:3:\"fgh\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:3:\"fgh\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:6:\"fghgfh\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:5:\"ghjhg\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:5:\"ghjhg\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:5:\"ghjhg\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:3:\"ghj\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:8:\"54654645\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";N;s:9:\"moth_sign\";s:2454:\"data:image/png;base64,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\";s:12:\"condition527\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition528\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition529\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition530\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition531\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition532\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition533\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition534\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition535\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition536\";s:45:\"שנות לימוד / תעודת בגרות12\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2144, 378, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2145, 367, 'email_msg', 'מייל נשלח בהצלחה'),
(2146, 367, 'committee_email', '6975b8dfb5fe1_1769322719.pdf'),
(2147, 367, 'committee_email', '6975b8fee0f4f_1769322750.pdf'),
(2148, 367, 'committee_email', '6977087ad907a_1769408634.pdf'),
(2149, 379, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-26 08:25:25');
INSERT INTO `apps_meta` (`id`, `app_id`, `meta_name`, `meta_value`) VALUES
(2150, 379, 'metaJson', 'a:130:{s:8:\"tenderid\";s:8:\"2026-237\";s:6:\"brunch\";N;s:5:\"tname\";s:19:\"בדיקה חדשה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:8:\"אולי\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:5:\"65665\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:3:\"fgh\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-19\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:3:\"fgh\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:4:\"fghf\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:4:\"fggf\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:3:\"fgh\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:10:\"5464565465\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:5:\"fghfg\";s:9:\"moth_sign\";s:3234:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAACMCAYAAAA5kebkAAAJHklEQVR4Aeydi5njNBRGAxVAJZQAVAIl0MFCBVACdEAHQCd0AB2AzuzcWY3jOH7Jlqyzn+9I1lv/1YnkZCb7+c1/KqACDxUQkIfSmKECt5uAuApUYEIBAZkQxywVEBDXgApMKFAQkIlezVKBRhQQkEYc5TDPUUBAztHdXhtRQEAacZTDPEcBATlHd3ttRIE2AWlEXIfZvgIC0r4PnUFBBQSkoLg23b4CAtK+D51BQQUEpKC4Nt2+AgIy8KG3KpArICC5GsZVYKCAgAwE8VYFcgUEJFfDuAoMFBCQgSDeqkCugIDkapSN23qDCghIg05zyMcpICDHaW1PDSogIA06zSEfp4CAHKe1PTWogIA06LT7IZtSSgEBKaWs7V5CAQG5hBudRCkFBKSUsrZ7CQUE5BJudBKlFBCQUspepd3O5yEgnS8Apz+tgIBM62Nu5woISOcLwOlPKyAg0/qY27kCRwLyY9L6m2ReKvCiQAs/jgIEMD4kQf5IRjwFXipQvwJHAfJnkuKzZD8lA5QUeKlA/QocBUgowTELSAixSDdUgSoV2BuQf9Is2S1S8PAiHzgIOW5hDwuboQJnKrAnICz4L9Jkvk72XzIgSMHDi/JhP6RSPJ88q5OKeanAUwV2K7AnIL8PRsWzxhxQqPZL+vFXsryOsCRBvM5VYE9AWOTfpunwjJGCtytf9G+JIxGAoC5GHWwuYCPNmaQC2xXYExBGw5EpX+ikhc1Z8NTFgGSsHnmRbqgCxRXYG5AYMAsZyxd65OWgUCbS85D0eFs40qmHuauEIobFFSgFSAw8X+hDWFjsWCx4yka9CEmjHhZphHk97jUVKKLAPSBFurmx0DEWOnYb/GPBY8Dya8rDUvByUQ+jHvaS+Poj6nC0e00yUIH9FDgKkBgxCx1joWORnoffpRsMWCgbn5MQx8beCOCt5VTNSwX2VeBoQGL0LHQMSLBIH4bsEHw+ErCQz25BXZ5ReGv435RImAIvFdhXgbMAiVmw0LEpSKIssAAKwFCHdHaXL1OEMAVeKrCvAmcDErNhwceOEGmPQmAIWKiHPSprugpsUuBQQGaMlMUPKOwo2LMqgIKxswjKM7XMX6xAbYDEBFjsWMAS6VNhDgp1p8qapwKzFKgVkHzwLPYAxV0lV8Z4cQVaACREABRsKSwev0JBw8UKtARIPjlAwQKWPG8s7vFrTBXTnirQKiD5xAAFUMY+QMzLEQcULH+rmHRNBUYVuAIgMbH8A0SeVbDIG4a8WwYoHr+Gynj/ToErAZJPjF0FY2cBFCzPz+M5KNTJ84x3rsBVAcndyqLHnsECKJi7Sq5e5/EeAMldDCjYHFgCFI5jeRvGO1KgN0By1wIKBizxgM9zTF7mw+1244Eeo2yeZ7wDBXoGJHcvYAAAoAAMzyxYlGEXieNX/rcqkW94UQUEZNyxwIIBC9AACxBROv5WZcmuAmAc2TDitKM1oICAPHcSYAALoADMb6kKwLDQY1chH0tZXldSQECWe/P7VAUYgAVQMEDB2CHIw1KxtwvIKEeIvWUYqVsBAbn3D9/yeJ86ngII2BQs7DTUphy7EPGP5s/qFRCQ9y7i1f3nlMR3DKdg0QUAWMBCW+wqPKvEzrKoQQufr4CAvPfBV6+3fMcwi/31dnFAXXYLjKMVDQBLgEI+aVrlCgjIewfFYiaVBR3HI+7XGLsIMMSuQvu0iwUsa9q1zkEKCMh7ofl+YRZxpLKQI741BBQsYAEe2gcUjmHkbe3D+jsrICD3grJQAxJ2EOy+1LYU+uD4hdEXfQQs5HG/qQcr76OAgIzryCLllZ4FzCv9eKntqbQdfQEKBijsKBh523uxhdUKCMi0dCzg6RL75QIDBpiAwi4CLBzBSOd+v95saZYCAjJLpsMLAUSAAiyAwo6CkXf4gHrtUEDq9jwwYAELuwiwuKsc5DcBOUjoHboJUHguOnNX2WEq7TQhIO34KkbKc1HAAih8cXfsKpEXZa8SsnMy58PnIyCHS75rhywaLI5g/DcQwHKlZxXmx3yYF6DsKuCzxgTkmULt5LOQApR8VyH98IW1o2zsijs2t6wpAVmmVwulAQILWHjl5RWYNKyFOeRjBBCOkjx7Ec/ziscFpLjEp3YAEAEKAwGWeAeM+8rs4XCYx+FwMBoBQYXrGwsMC1hyUEi/vgIrZyggK4VruBpABCjxUN/irnKICwTkEJmr7ARQONdjnPHdVUbcJCAjonSWxNkeWGJXARTMXSUtBAFJIni9KZCDMtxVWn6r+HZ7m+KyiIAs06uX0oCC5btKy28Vr/abgKyWrpuKOShMuqvjl4Dgcm2OAoCC5btKPKdc9vglIHOWhmWGCgxBuezxS0CGrvd+iQI5KNS73PFrDiBMXFOBKQUABRs7fk3Vqz5PQKp3UXMDfARKk88pAtLc+mtmwDkoDLrJ5xQBwXVaSQUABeP4RT9NPacICC7TjlIgQBl+Sn9U/4v7ORmQxeO1wjUUyEFhRvF5CvGqTECqckd3gwEUjN8oZvKAwv8BWc0DvYDgFu1sBfLfKP47DYYHegx40u15l4Ccp709jysAFDzQ88UT/EEXuwpp46ULpwpIYYFtfrUCQMHRiwd6GglQSOf+ELsuIIfIZycHKAAQGLsK3fE2MfcY90VNQIrKa+M7KwAUOSixq+zczafmBOSTFsbaUSBA4fjFjlIMFAFpZ1E40nsFioMiIPeim9KeAsVAEZAVi8Eq1SqwOygCUq2vHdgGBcZAWfXpvIBs8IJVq1cAUOKzFAGp3l0O8AwF4tdYgGVx/+4giyWzQk8KCEhd3nY0lSkgIJU5xOHUpYCA1OUPR1OZAgJSmUMcTl0KCEhd/nA0lSkgIJU5pNxwbHmNAgKyRjXrdKOAgHTjaie6RgEBWaOadbpRQEC6cbUTXaOAgKxRzTrvFbjwnYBc2LlObbsCArJdQ1u4sAICcmHnOrXtCgjIdg1t4cIKCMiFnXuFqZ09BwE52wP2X7UCAlK1exzc2QoIyNkesP+qFRCQqt3j4M5WQEDO9oD9n6XArH4FZJZMFupVAQHp1fPOe5YCAjJLJgv1qoCA9Op55z1LAQGZJZOFelVgHSC9quW8u1NAQLpzuRNeosD/AAAA///aTn73AAAABklEQVQDADRNUCg+Z++lAAAAAElFTkSuQmCC\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:12:\"condition628\";s:23:\"קורסים יתרון\";s:12:\"condition629\";s:23:\"קורסים יתרון\";s:12:\"condition630\";s:23:\"קורסים יתרון\";s:12:\"condition631\";s:23:\"קורסים יתרון\";s:12:\"condition632\";s:23:\"קורסים יתרון\";s:12:\"condition633\";s:23:\"קורסים יתרון\";s:12:\"condition634\";s:23:\"קורסים יתרון\";s:12:\"condition635\";s:23:\"קורסים יתרון\";s:12:\"condition636\";s:23:\"קורסים יתרון\";s:12:\"condition637\";s:23:\"קורסים יתרון\";s:12:\"condition729\";s:21:\"מקצועי חובה\";s:12:\"condition730\";s:21:\"מקצועי חובה\";s:12:\"condition731\";s:21:\"מקצועי חובה\";s:12:\"condition732\";s:21:\"מקצועי חובה\";s:12:\"condition733\";s:21:\"מקצועי חובה\";s:12:\"condition734\";s:21:\"מקצועי חובה\";s:12:\"condition735\";s:21:\"מקצועי חובה\";s:12:\"condition736\";s:21:\"מקצועי חובה\";s:12:\"condition737\";s:21:\"מקצועי חובה\";s:12:\"condition738\";s:21:\"מקצועי חובה\";s:12:\"condition830\";s:23:\"נוספות יתרון\";s:12:\"condition831\";s:23:\"נוספות יתרון\";s:12:\"condition832\";s:23:\"נוספות יתרון\";s:12:\"condition833\";s:23:\"נוספות יתרון\";s:12:\"condition834\";s:23:\"נוספות יתרון\";s:12:\"condition835\";s:23:\"נוספות יתרון\";s:12:\"condition836\";s:23:\"נוספות יתרון\";s:12:\"condition837\";s:23:\"נוספות יתרון\";s:12:\"condition838\";s:23:\"נוספות יתרון\";s:12:\"condition839\";s:23:\"נוספות יתרון\";s:12:\"condition931\";s:21:\"ניהולי חובה\";s:12:\"condition932\";s:21:\"ניהולי חובה\";s:12:\"condition933\";s:21:\"ניהולי חובה\";s:12:\"condition934\";s:21:\"ניהולי חובה\";s:12:\"condition935\";s:21:\"ניהולי חובה\";s:12:\"condition936\";s:21:\"ניהולי חובה\";s:12:\"condition937\";s:21:\"ניהולי חובה\";s:12:\"condition938\";s:21:\"ניהולי חובה\";s:12:\"condition939\";s:21:\"ניהולי חובה\";s:12:\"condition940\";s:21:\"ניהולי חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2151, 379, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:8:\"אולי\";}}'),
(2152, 380, 'email_msg', 'מייל נשלח בהצלחה'),
(2153, 380, 'committee_email', '697708eeb350c_1769408750.pdf'),
(2154, 380, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-26 08:34:26'),
(2155, 380, 'metaJson', 'a:90:{s:8:\"tenderid\";s:8:\"2026-244\";s:6:\"brunch\";N;s:5:\"tname\";s:10:\"בדיקה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;s:4:\"test\";}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:4:\"test\";s:8:\"lastname\";s:10:\"e355325325\";s:11:\"oldlastname\";s:11:\"23525235235\";s:5:\"id_tz\";s:9:\"252352352\";s:5:\"email\";s:22:\"imteajsajid1@gmail.com\";s:14:\"personal_phone\";s:7:\"1234567\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:24:\"735734573457354633563467\";s:15:\"personal_street\";s:16:\"2462464326463546\";s:14:\"personal_house\";s:16:\"3423532523463426\";s:13:\"personal_flat\";s:7:\"2352352\";s:16:\"personal_zipcode\";s:10:\"3243523523\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;N;}s:16:\"military_to_date\";a:1:{i:0;N;}s:14:\"military_roles\";a:1:{i:0;N;}s:12:\"exp_position\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;N;}s:10:\"expp_descr\";a:1:{i:0;N;}s:11:\"expp_pstart\";a:1:{i:0;N;}s:11:\"expp_finish\";a:1:{i:0;N;}s:13:\"expp_employee\";a:1:{i:0;N;}s:10:\"expp_level\";a:1:{i:0;N;}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;N;i:1;N;i:2;N;}s:21:\"educ_institution_mode\";a:3:{i:0;N;i:1;N;i:2;N;}s:28:\"educ_institution_years_years\";a:3:{i:0;N;i:1;N;i:2;N;}s:14:\"educ_last_year\";a:3:{i:0;N;i:1;N;i:2;N;}s:21:\"educ_certificate_date\";a:3:{i:0;N;i:1;N;i:2;N;}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";N;s:10:\"start_date\";N;s:8:\"end_date\";N;s:15:\"study_framework\";N;s:11:\"certificate\";N;s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;N;i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;N;i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;N;i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;N;i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;N;i:1;N;}s:21:\"form5_additional_text\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:11:\"form5_nigud\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:4:\"none\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";N;s:9:\"moth_sign\";s:5374:\"data:image/png;base64,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\";s:12:\"condition527\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition528\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition529\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition530\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition531\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition532\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition533\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition534\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition535\";s:45:\"שנות לימוד / תעודת בגרות12\";s:12:\"condition536\";s:45:\"שנות לימוד / תעודת בגרות12\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2156, 380, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:4:\"test\";}}'),
(2157, 367, 'committee_email', '69770e248d739_1769410084.pdf'),
(2158, 367, 'committee_email', '69771b886f832_1769413512.pdf'),
(2160, 367, 'committee_email', '697741ed2c34c_1769423341.pdf'),
(2161, 367, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(2162, 367, 'committee_date', '25.01.2026'),
(2165, 246, 'tender_num_display', '2026-246'),
(2166, 381, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-26 15:11:12'),
(2167, 381, 'metaJson', 'a:127:{s:8:\"tenderid\";s:8:\"2026-246\";s:6:\"brunch\";N;s:5:\"tname\";s:26:\"בדיקה עם יתרון\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:8:\"34543543\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:6:\"דגכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-13\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:6:\"דגכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:6:\"דגכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:12:\"דגכגדכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:6:\"דגכ\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:6:\"דגכ\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:6:\"דגכ\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:6:\"דגכ\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:9:\"324234234\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:16:\"עכיעכיעכ\";s:9:\"moth_sign\";s:2654:\"data:image/png;base64,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\";s:12:\"condition527\";s:21:\"השכלה יתרון\";s:12:\"condition528\";s:21:\"השכלה יתרון\";s:12:\"condition529\";s:21:\"השכלה יתרון\";s:12:\"condition530\";s:21:\"השכלה יתרון\";s:12:\"condition531\";s:21:\"השכלה יתרון\";s:12:\"condition532\";s:21:\"השכלה יתרון\";s:12:\"condition533\";s:21:\"השכלה יתרון\";s:12:\"condition534\";s:21:\"השכלה יתרון\";s:12:\"condition535\";s:21:\"השכלה יתרון\";s:12:\"condition536\";s:21:\"השכלה יתרון\";s:12:\"condition628\";s:21:\"קורסים חובה\";s:12:\"condition629\";s:21:\"קורסים חובה\";s:12:\"condition630\";s:21:\"קורסים חובה\";s:12:\"condition631\";s:21:\"קורסים חובה\";s:12:\"condition632\";s:21:\"קורסים חובה\";s:12:\"condition633\";s:21:\"קורסים חובה\";s:12:\"condition634\";s:21:\"קורסים חובה\";s:12:\"condition635\";s:21:\"קורסים חובה\";s:12:\"condition636\";s:21:\"קורסים חובה\";s:12:\"condition637\";s:21:\"קורסים חובה\";s:12:\"condition729\";s:23:\"מקצועי יתרון\";s:12:\"condition730\";s:23:\"מקצועי יתרון\";s:12:\"condition731\";s:23:\"מקצועי יתרון\";s:12:\"condition732\";s:23:\"מקצועי יתרון\";s:12:\"condition733\";s:23:\"מקצועי יתרון\";s:12:\"condition734\";s:23:\"מקצועי יתרון\";s:12:\"condition735\";s:23:\"מקצועי יתרון\";s:12:\"condition736\";s:23:\"מקצועי יתרון\";s:12:\"condition737\";s:23:\"מקצועי יתרון\";s:12:\"condition738\";s:23:\"מקצועי יתרון\";s:12:\"condition830\";s:21:\"נוספות חובה\";s:12:\"condition831\";s:21:\"נוספות חובה\";s:12:\"condition832\";s:21:\"נוספות חובה\";s:12:\"condition833\";s:21:\"נוספות חובה\";s:12:\"condition834\";s:21:\"נוספות חובה\";s:12:\"condition835\";s:21:\"נוספות חובה\";s:12:\"condition836\";s:21:\"נוספות חובה\";s:12:\"condition837\";s:21:\"נוספות חובה\";s:12:\"condition838\";s:21:\"נוספות חובה\";s:12:\"condition839\";s:21:\"נוספות חובה\";s:12:\"condition931\";s:21:\"ניהול יתרון\";s:12:\"condition932\";s:21:\"ניהול יתרון\";s:12:\"condition933\";s:21:\"ניהול יתרון\";s:12:\"condition934\";s:21:\"ניהול יתרון\";s:12:\"condition935\";s:21:\"ניהול יתרון\";s:12:\"condition936\";s:21:\"ניהול יתרון\";s:12:\"condition937\";s:21:\"ניהול יתרון\";s:12:\"condition938\";s:21:\"ניהול יתרון\";s:12:\"condition939\";s:21:\"ניהול יתרון\";s:12:\"condition940\";s:21:\"ניהול יתרון\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2168, 382, 'email_msg', 'מייל נשלח בהצלחה'),
(2169, 382, 'committee_email', '697768b04e0a8_1769433264.pdf'),
(2170, 382, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(2171, 382, 'committee_date', '26.01.2026'),
(2172, 382, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(2173, 247, 'tender_num_display', '2026-247'),
(2174, 382, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-26 15:24:04'),
(2175, 382, 'metaJson', 'a:127:{s:8:\"tenderid\";s:8:\"2026-247\";s:6:\"brunch\";N;s:5:\"tname\";s:37:\"בדיקה נוספת עם יתרון\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:1:\"3\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:8:\"עכגע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-20\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:6:\"גכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:6:\"גכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:12:\"גכעכגע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:6:\"גכע\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:6:\"גכע\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:6:\"גכע\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:6:\"גכע\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:11:\"43543543543\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:12:\"גדכדגכ\";s:9:\"moth_sign\";s:3170:\"data:image/png;base64,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\";s:12:\"condition527\";s:21:\"השכלה יתרון\";s:12:\"condition528\";s:21:\"השכלה יתרון\";s:12:\"condition529\";s:21:\"השכלה יתרון\";s:12:\"condition530\";s:21:\"השכלה יתרון\";s:12:\"condition531\";s:21:\"השכלה יתרון\";s:12:\"condition532\";s:21:\"השכלה יתרון\";s:12:\"condition533\";s:21:\"השכלה יתרון\";s:12:\"condition534\";s:21:\"השכלה יתרון\";s:12:\"condition535\";s:21:\"השכלה יתרון\";s:12:\"condition536\";s:21:\"השכלה יתרון\";s:12:\"condition628\";s:21:\"קורסים חובה\";s:12:\"condition629\";s:21:\"קורסים חובה\";s:12:\"condition630\";s:21:\"קורסים חובה\";s:12:\"condition631\";s:21:\"קורסים חובה\";s:12:\"condition632\";s:21:\"קורסים חובה\";s:12:\"condition633\";s:21:\"קורסים חובה\";s:12:\"condition634\";s:21:\"קורסים חובה\";s:12:\"condition635\";s:21:\"קורסים חובה\";s:12:\"condition636\";s:21:\"קורסים חובה\";s:12:\"condition637\";s:21:\"קורסים חובה\";s:12:\"condition729\";s:23:\"מקצועי יתרון\";s:12:\"condition730\";s:23:\"מקצועי יתרון\";s:12:\"condition731\";s:23:\"מקצועי יתרון\";s:12:\"condition732\";s:23:\"מקצועי יתרון\";s:12:\"condition733\";s:23:\"מקצועי יתרון\";s:12:\"condition734\";s:23:\"מקצועי יתרון\";s:12:\"condition735\";s:23:\"מקצועי יתרון\";s:12:\"condition736\";s:23:\"מקצועי יתרון\";s:12:\"condition737\";s:23:\"מקצועי יתרון\";s:12:\"condition738\";s:23:\"מקצועי יתרון\";s:12:\"condition830\";s:21:\"נוספות חובה\";s:12:\"condition831\";s:21:\"נוספות חובה\";s:12:\"condition832\";s:21:\"נוספות חובה\";s:12:\"condition833\";s:21:\"נוספות חובה\";s:12:\"condition834\";s:21:\"נוספות חובה\";s:12:\"condition835\";s:21:\"נוספות חובה\";s:12:\"condition836\";s:21:\"נוספות חובה\";s:12:\"condition837\";s:21:\"נוספות חובה\";s:12:\"condition838\";s:21:\"נוספות חובה\";s:12:\"condition839\";s:21:\"נוספות חובה\";s:12:\"condition931\";s:23:\"ניהולי יתרון\";s:12:\"condition932\";s:23:\"ניהולי יתרון\";s:12:\"condition933\";s:23:\"ניהולי יתרון\";s:12:\"condition934\";s:23:\"ניהולי יתרון\";s:12:\"condition935\";s:23:\"ניהולי יתרון\";s:12:\"condition936\";s:23:\"ניהולי יתרון\";s:12:\"condition937\";s:23:\"ניהולי יתרון\";s:12:\"condition938\";s:23:\"ניהולי יתרון\";s:12:\"condition939\";s:23:\"ניהולי יתרון\";s:12:\"condition940\";s:23:\"ניהולי יתרון\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2176, 383, 'email_msg', 'מייל נשלח בהצלחה'),
(2177, 383, 'committee_email', '69776b14a7dae_1769433876.pdf'),
(2178, 383, 'email_msg_committee', 'מייל זימון לועדת בחינה נשלח בהצלחה'),
(2179, 383, 'committee_date', '26.01.2026'),
(2180, 383, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(2181, 248, 'tender_num_display', '2026-248'),
(2182, 383, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-26 15:37:13'),
(2183, 383, 'metaJson', 'a:87:{s:8:\"tenderid\";s:8:\"2026-248\";s:6:\"brunch\";N;s:5:\"tname\";s:24:\"בדיקה עם מבחן\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:6:\"546546\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2026-01-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-20\";}s:14:\"military_roles\";a:1:{i:0;s:16:\"כעיכעיעכ\";}s:12:\"exp_position\";a:9:{i:0;s:12:\"דגכגדכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-19\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:10:\"דגכדג\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:6:\"דגכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:10:\"דגכגד\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:12:\"כעיכעי\";i:1;s:12:\"כעיכעי\";i:2;s:12:\"כעיכעי\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:14:\"educ_last_year\";a:3:{i:0;s:10:\"כעיעכ\";i:1;s:10:\"כעיעכ\";i:2;s:10:\"כעיעכ\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:10:\"דגכגד\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:6:\"גדכ\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:6:\"דגכ\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:6:\"גדכ\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:8:\"23423432\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:10:\"דגכגד\";s:9:\"moth_sign\";s:2526:\"data:image/png;base64,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\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2184, 384, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-26 16:36:44');
INSERT INTO `apps_meta` (`id`, `app_id`, `meta_name`, `meta_value`) VALUES
(2185, 384, 'metaJson', 'a:89:{s:8:\"tenderid\";s:8:\"2026-248\";s:6:\"brunch\";N;s:5:\"tname\";s:24:\"בדיקה עם מבחן\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:4:\"4567\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:2:{i:0;s:10:\"2026-01-01\";i:1;s:10:\"2025-10-01\";}s:16:\"military_to_date\";a:2:{i:0;s:10:\"2026-01-20\";i:1;s:10:\"2026-01-19\";}s:14:\"military_roles\";a:2:{i:0;s:21:\"תפקיד ראשון\";i:1;s:17:\"תפקיד שני\";}s:12:\"exp_position\";a:9:{i:0;s:10:\"גכעגכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-22\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:6:\"גכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:6:\"גכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:10:\"כעיעכ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:8:\"edu_type\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:14:\"כעיכעי 1\";i:1;s:14:\"כעיכעי 2\";i:2;s:14:\"כעיכעי 3\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:12:\"כעיעכ 1\";i:1;s:12:\"כעיעכ 2\";i:2;s:12:\"כעיעכ 3\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:12:\"כעיעכ 1\";i:1;s:12:\"כעיעכ 2\";i:2;s:12:\"כעיעכ 3\";}s:14:\"educ_last_year\";a:3:{i:0;s:12:\"כעיעכ 1\";i:1;s:12:\"כעיעכ 2\";i:2;s:12:\"כעיעכ 3\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:3:\"yes\";s:17:\"diploma_high_type\";a:1:{i:0;s:19:\"תואר ראשון\";}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:21:\"שליטה חלקית\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:6:\"כעי\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:10:\"עיכעי\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:10:\"כעיעכ\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:10:\"כעיכע\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:8:\"45645645\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:54:\"רדיו שני עדיפות אוכלוסיה מזכה\";s:9:\"moth_sign\";s:2722:\"data:image/png;base64,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\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2187, 385, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-27 08:34:48'),
(2189, 249, 'tender_num_display', '2026-249'),
(2190, 386, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-27 18:19:01'),
(2192, 387, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-27 22:41:29'),
(2194, 387, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:0:\"\";}}'),
(2195, 388, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 05:34:35'),
(2197, 388, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:0:\"\";}}'),
(2198, 389, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 05:47:57'),
(2200, 389, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:0:\"\";}}'),
(2201, 390, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 05:56:11'),
(2203, 390, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:3:\"yes\";}}'),
(2204, 391, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 06:16:17'),
(2206, 391, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:3:\"yes\";}}'),
(2207, 392, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 06:24:06'),
(2209, 392, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:3:\"yes\";}}'),
(2210, 393, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 06:30:01'),
(2212, 393, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:3:\"yes\";}}'),
(2213, 394, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 06:36:05'),
(2215, 394, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:0:\"\";}}'),
(2216, 395, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 06:44:26'),
(2218, 395, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:0:\"\";}}'),
(2219, 396, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 06:50:00'),
(2220, 396, 'metaJson', 'a:130:{s:8:\"tenderid\";s:8:\"2026-237\";s:6:\"brunch\";N;s:5:\"tname\";s:19:\"בדיקה חדשה\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:18:\"condition_question\";a:1:{i:0;s:15:\"כן או לא?\";}s:16:\"condition_answer\";a:1:{i:0;s:1:\"1\";}s:21:\"condition_answer_text\";a:1:{i:0;N;}s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:4:\"user\";s:8:\"lastname\";s:4:\"user\";s:11:\"oldlastname\";s:7:\"ads3234\";s:5:\"id_tz\";s:9:\"234234234\";s:5:\"email\";s:22:\"imteajsajid1@gmail.com\";s:14:\"personal_phone\";s:7:\"1234256\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:6:\"female\";s:13:\"personal_city\";s:12:\"135125123523\";s:15:\"personal_street\";s:12:\"23r151325132\";s:14:\"personal_house\";s:15:\"234523423453245\";s:13:\"personal_flat\";s:12:\"342532345234\";s:16:\"personal_zipcode\";s:8:\"23453245\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;N;}s:16:\"military_to_date\";a:1:{i:0;N;}s:14:\"military_roles\";a:1:{i:0;N;}s:12:\"exp_position\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;N;}s:10:\"expp_descr\";a:1:{i:0;N;}s:11:\"expp_pstart\";a:1:{i:0;N;}s:11:\"expp_finish\";a:1:{i:0;N;}s:13:\"expp_employee\";a:1:{i:0;N;}s:10:\"expp_level\";a:1:{i:0;N;}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;N;i:1;N;i:2;N;}s:21:\"educ_institution_mode\";a:3:{i:0;N;i:1;N;i:2;N;}s:28:\"educ_institution_years_years\";a:3:{i:0;N;i:1;N;i:2;N;}s:14:\"educ_last_year\";a:3:{i:0;N;i:1;N;i:2;N;}s:21:\"educ_certificate_date\";a:3:{i:0;N;i:1;N;i:2;N;}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";N;s:10:\"start_date\";N;s:8:\"end_date\";N;s:15:\"study_framework\";N;s:11:\"certificate\";N;s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:21:\"שליטה חלקית\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:21:\"שליטה חלקית\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;N;i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;N;i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;N;i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;N;i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;N;i:1;N;}s:21:\"form5_additional_text\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:11:\"form5_nigud\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:4:\"none\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";N;s:9:\"moth_sign\";s:5642:\"data:image/png;base64,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\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:12:\"condition628\";s:23:\"קורסים יתרון\";s:12:\"condition629\";s:23:\"קורסים יתרון\";s:12:\"condition630\";s:23:\"קורסים יתרון\";s:12:\"condition631\";s:23:\"קורסים יתרון\";s:12:\"condition632\";s:23:\"קורסים יתרון\";s:12:\"condition633\";s:23:\"קורסים יתרון\";s:12:\"condition634\";s:23:\"קורסים יתרון\";s:12:\"condition635\";s:23:\"קורסים יתרון\";s:12:\"condition636\";s:23:\"קורסים יתרון\";s:12:\"condition637\";s:23:\"קורסים יתרון\";s:12:\"condition729\";s:21:\"מקצועי חובה\";s:12:\"condition730\";s:21:\"מקצועי חובה\";s:12:\"condition731\";s:21:\"מקצועי חובה\";s:12:\"condition732\";s:21:\"מקצועי חובה\";s:12:\"condition733\";s:21:\"מקצועי חובה\";s:12:\"condition734\";s:21:\"מקצועי חובה\";s:12:\"condition735\";s:21:\"מקצועי חובה\";s:12:\"condition736\";s:21:\"מקצועי חובה\";s:12:\"condition737\";s:21:\"מקצועי חובה\";s:12:\"condition738\";s:21:\"מקצועי חובה\";s:12:\"condition830\";s:23:\"נוספות יתרון\";s:12:\"condition831\";s:23:\"נוספות יתרון\";s:12:\"condition832\";s:23:\"נוספות יתרון\";s:12:\"condition833\";s:23:\"נוספות יתרון\";s:12:\"condition834\";s:23:\"נוספות יתרון\";s:12:\"condition835\";s:23:\"נוספות יתרון\";s:12:\"condition836\";s:23:\"נוספות יתרון\";s:12:\"condition837\";s:23:\"נוספות יתרון\";s:12:\"condition838\";s:23:\"נוספות יתרון\";s:12:\"condition839\";s:23:\"נוספות יתרון\";s:12:\"condition931\";s:21:\"ניהולי חובה\";s:12:\"condition932\";s:21:\"ניהולי חובה\";s:12:\"condition933\";s:21:\"ניהולי חובה\";s:12:\"condition934\";s:21:\"ניהולי חובה\";s:12:\"condition935\";s:21:\"ניהולי חובה\";s:12:\"condition936\";s:21:\"ניהולי חובה\";s:12:\"condition937\";s:21:\"ניהולי חובה\";s:12:\"condition938\";s:21:\"ניהולי חובה\";s:12:\"condition939\";s:21:\"ניהולי חובה\";s:12:\"condition940\";s:21:\"ניהולי חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2221, 396, 'yes_no_questions', 'a:1:{i:0;a:4:{s:8:\"question\";s:15:\"כן או לא?\";s:6:\"answer\";s:4:\"כן\";s:12:\"answer_value\";s:1:\"1\";s:4:\"text\";s:0:\"\";}}'),
(2222, 367, 'email_msg_committee_approve', 'מועמד אישר הגעה לועדת בחינה'),
(2223, 250, 'tender_num_display', '2026-250'),
(2224, 397, 'email_sent_page5', 'מייל עם קבצים נשלח בהצלחה בתאריך 2026-01-28 09:18:47'),
(2225, 397, 'metaJson', 'a:128:{s:8:\"tenderid\";s:8:\"2026-250\";s:6:\"brunch\";N;s:5:\"tname\";s:37:\"בדיקה חדשה יום רביעי\";s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"conditions_ok\";s:1:\"1\";s:9:\"firstname\";s:10:\"עיעכי\";s:8:\"lastname\";s:12:\"כעיכעי\";s:11:\"oldlastname\";s:12:\"כעיכעי\";s:5:\"id_tz\";s:9:\"308407139\";s:5:\"email\";s:17:\"guy@automas.co.il\";s:14:\"personal_phone\";s:7:\"3454354\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:10:\"כעיעכ\";s:15:\"personal_street\";s:10:\"כעיעכ\";s:14:\"personal_house\";s:1:\"5\";s:13:\"personal_flat\";s:2:\"55\";s:16:\"personal_zipcode\";s:5:\"56546\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:18:\"military_from_date\";a:1:{i:0;s:10:\"2025-10-01\";}s:16:\"military_to_date\";a:1:{i:0;s:10:\"2026-01-19\";}s:14:\"military_roles\";a:1:{i:0;s:17:\"תפקיד שני\";}s:12:\"exp_position\";a:9:{i:0;s:10:\"עכיכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2026-01-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2026-01-28\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:6:\"כעי\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:10:\"כעיכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:14:\"כעכגעכג\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"expp_position\";a:1:{i:0;s:12:\"עכיעכי\";}s:10:\"expp_descr\";a:1:{i:0;s:12:\"כעיעכי\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2026-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2026-01-13\";}s:13:\"expp_employee\";a:1:{i:0;s:6:\"עכי\";}s:10:\"expp_level\";a:1:{i:0;s:3:\"546\";}s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:19:\"educ_type_for_entry\";a:3:{i:0;s:25:\"השכלה תיכונית\";i:1;s:30:\"השכלה על תיכונית\";i:2;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";a:3:{i:0;s:14:\"כעיכעי 3\";i:1;s:14:\"כעיכעי 3\";i:2;s:14:\"כעיכעי 3\";}s:21:\"educ_institution_mode\";a:3:{i:0;s:12:\"כעיעכ 3\";i:1;s:12:\"כעיעכ 3\";i:2;s:12:\"כעיעכ 3\";}s:28:\"educ_institution_years_years\";a:3:{i:0;s:12:\"כעיעכ 3\";i:1;s:12:\"כעיעכ 3\";i:2;s:12:\"כעיעכ 3\";}s:14:\"educ_last_year\";a:3:{i:0;s:12:\"כעיעכ 3\";i:1;s:12:\"כעיעכ 3\";i:2;s:12:\"כעיעכ 3\";}s:21:\"educ_certificate_date\";a:3:{i:0;s:10:\"2026-01-03\";i:1;s:10:\"2026-01-03\";i:2;s:10:\"2026-01-03\";}s:13:\"diploma_exist\";s:3:\"yes\";s:17:\"diploma_high_type\";a:6:{i:0;s:19:\"תואר ראשון\";i:1;s:15:\"תואר שני\";i:2;s:19:\"תואר שלישי\";i:3;s:10:\"תעודה\";i:4;s:12:\"הנדסאי\";i:5;s:6:\"אין\";}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:11:\"course_name\";s:12:\"כעיעכי\";s:10:\"start_date\";s:10:\"2026-01-01\";s:8:\"end_date\";s:10:\"2026-01-03\";s:15:\"study_framework\";s:12:\"כעיעכי\";s:11:\"certificate\";s:10:\"כעיעכ\";s:8:\"language\";a:3:{i:0;s:10:\"עברית\";i:1;s:12:\"אנגלית\";i:2;N;}s:14:\"language_read_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_write_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:15:\"language_speak_\";a:3:{i:0;s:19:\"שליטה מלאה\";i:1;s:19:\"שליטה מלאה\";i:2;N;}s:26:\"recomendations_full_name_z\";a:2:{i:0;s:10:\"כגעגכ\";i:1;N;}s:26:\"recomendations_last_name_z\";a:2:{i:0;s:6:\"גכע\";i:1;N;}s:21:\"recomendations_role_z\";a:2:{i:0;s:6:\"גכע\";i:1;N;}s:24:\"recomendations_address_z\";a:2:{i:0;s:10:\"גכעכג\";i:1;N;}s:22:\"recomendations_phone_z\";a:2:{i:0;s:13:\"4354343543543\";i:1;N;}s:21:\"form5_additional_text\";s:12:\"כעיעכי\";s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:31:\"relative_division_department_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:8:\"minority\";s:21:\"form3_disability_text\";N;s:19:\"form3_minority_text\";s:16:\"גדכגדכגד\";s:9:\"moth_sign\";s:3618:\"data:image/png;base64,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\";s:12:\"condition527\";s:19:\"השכלה חובה\";s:12:\"condition528\";s:19:\"השכלה חובה\";s:12:\"condition529\";s:19:\"השכלה חובה\";s:12:\"condition530\";s:19:\"השכלה חובה\";s:12:\"condition531\";s:19:\"השכלה חובה\";s:12:\"condition532\";s:19:\"השכלה חובה\";s:12:\"condition533\";s:19:\"השכלה חובה\";s:12:\"condition534\";s:19:\"השכלה חובה\";s:12:\"condition535\";s:19:\"השכלה חובה\";s:12:\"condition536\";s:19:\"השכלה חובה\";s:12:\"condition628\";s:23:\"קורסים יתרון\";s:12:\"condition629\";s:23:\"קורסים יתרון\";s:12:\"condition630\";s:23:\"קורסים יתרון\";s:12:\"condition631\";s:23:\"קורסים יתרון\";s:12:\"condition632\";s:23:\"קורסים יתרון\";s:12:\"condition633\";s:23:\"קורסים יתרון\";s:12:\"condition634\";s:23:\"קורסים יתרון\";s:12:\"condition635\";s:23:\"קורסים יתרון\";s:12:\"condition636\";s:23:\"קורסים יתרון\";s:12:\"condition637\";s:23:\"קורסים יתרון\";s:12:\"condition729\";s:23:\"מקצועי יתרון\";s:12:\"condition730\";s:23:\"מקצועי יתרון\";s:12:\"condition731\";s:23:\"מקצועי יתרון\";s:12:\"condition732\";s:23:\"מקצועי יתרון\";s:12:\"condition733\";s:23:\"מקצועי יתרון\";s:12:\"condition734\";s:23:\"מקצועי יתרון\";s:12:\"condition735\";s:23:\"מקצועי יתרון\";s:12:\"condition736\";s:23:\"מקצועי יתרון\";s:12:\"condition737\";s:23:\"מקצועי יתרון\";s:12:\"condition738\";s:23:\"מקצועי יתרון\";s:12:\"condition830\";s:21:\"נוספות חובה\";s:12:\"condition831\";s:21:\"נוספות חובה\";s:12:\"condition832\";s:21:\"נוספות חובה\";s:12:\"condition833\";s:21:\"נוספות חובה\";s:12:\"condition834\";s:21:\"נוספות חובה\";s:12:\"condition835\";s:21:\"נוספות חובה\";s:12:\"condition836\";s:21:\"נוספות חובה\";s:12:\"condition837\";s:21:\"נוספות חובה\";s:12:\"condition838\";s:21:\"נוספות חובה\";s:12:\"condition839\";s:21:\"נוספות חובה\";s:12:\"condition931\";s:21:\"ניהולי חובה\";s:12:\"condition932\";s:21:\"ניהולי חובה\";s:12:\"condition933\";s:21:\"ניהולי חובה\";s:12:\"condition934\";s:21:\"ניהולי חובה\";s:12:\"condition935\";s:21:\"ניהולי חובה\";s:12:\"condition936\";s:21:\"ניהולי חובה\";s:12:\"condition937\";s:21:\"ניהולי חובה\";s:12:\"condition938\";s:21:\"ניהולי חובה\";s:12:\"condition939\";s:21:\"ניהולי חובה\";s:12:\"condition940\";s:21:\"ניהולי חובה\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(2226, 398, 'email_msg', 'מייל נשלח בהצלחה'),
(2227, 398, 'committee_email', '6979b95f2b4e7_1769584991.pdf'),
(2228, 398, 'committee_email', '6979b988d48e5_1769585032.pdf'),
(2229, 398, 'committee_email', '6979c029eba45_1769586729.pdf'),
(2230, 398, 'committee_email', '6979c323d2875_1769587491.pdf');

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_accepted`
-- (See below for the actual view)
--
CREATE TABLE `app_accepted` (
`accepted` bigint(21)
,`tenderval` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_count_pending`
-- (See below for the actual view)
--
CREATE TABLE `app_count_pending` (
`pendingcount` bigint(21)
,`tenderval` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_count_val`
-- (See below for the actual view)
--
CREATE TABLE `app_count_val` (
`ccount` bigint(21)
,`tenderval` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `app_decisions`
--

CREATE TABLE `app_decisions` (
  `id` int(11) NOT NULL,
  `tenderval` varchar(200) DEFAULT NULL,
  `tender_number` varchar(255) DEFAULT NULL,
  `tender_body` varchar(255) DEFAULT NULL,
  `tender_body_image` varchar(255) DEFAULT NULL,
  `test_result` int(11) DEFAULT NULL COMMENT 'null=no result, 0=fail,1=pass',
  `grade` varchar(255) DEFAULT NULL,
  `is_star` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `p1_id` int(11) DEFAULT 0,
  `p2_id` int(11) DEFAULT 0,
  `p3_id` int(11) DEFAULT 0,
  `p5_id` int(11) DEFAULT NULL,
  `decision_1` int(11) DEFAULT 0,
  `decision_1_a` int(11) NOT NULL DEFAULT 0,
  `decision_1_b` int(11) NOT NULL DEFAULT 0,
  `decision_1_comment` varchar(500) DEFAULT NULL,
  `decision_2` int(11) DEFAULT 0,
  `decision_2_comment` varchar(500) DEFAULT NULL,
  `decision_3` int(11) DEFAULT 0,
  `decision_3_b` int(11) NOT NULL DEFAULT 0,
  `decision_3_a` int(11) NOT NULL DEFAULT 0,
  `decision_3_comment` varchar(500) DEFAULT NULL,
  `decision_4` int(11) DEFAULT 0,
  `decision_4_comment` varchar(500) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `rejected` int(11) DEFAULT 0,
  `applicant_name` varchar(100) DEFAULT NULL,
  `generated_dec_id` int(11) DEFAULT NULL,
  `id_tz` varchar(200) DEFAULT NULL,
  `crdate` timestamp NULL DEFAULT current_timestamp(),
  `decision_5` int(11) DEFAULT 0,
  `decision_rejectedbyuser` int(11) DEFAULT 0,
  `decision_committee` int(11) DEFAULT 0,
  `has_salary` tinyint(4) DEFAULT 0,
  `salary` int(11) NOT NULL DEFAULT 0,
  `accept_salary` tinyint(4) NOT NULL DEFAULT 0,
  `selected_interview_time` varchar(255) DEFAULT NULL,
  `selected_interview_place` varchar(255) DEFAULT NULL,
  `approved_interview_place` varchar(255) DEFAULT NULL,
  `approved_interview_time` varchar(255) DEFAULT NULL,
  `last_interview_invitation_send` timestamp NULL DEFAULT NULL,
  `last_committee_invitation_send` timestamp NULL DEFAULT NULL,
  `approved_committee_time` timestamp NULL DEFAULT NULL,
  `is_appeared` tinyint(4) DEFAULT NULL,
  `committee_selected_place` varchar(255) DEFAULT NULL,
  `committee_invitation_approved_time` timestamp NULL DEFAULT NULL,
  `2nd_invitation_rejected` tinyint(2) DEFAULT 0,
  `invitation_rejected_by_user` tinyint(4) DEFAULT 0,
  `rejected_status` varchar(3) DEFAULT NULL,
  `stepback` int(1) NOT NULL DEFAULT 0,
  `additional_text` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_decisions`
--

INSERT INTO `app_decisions` (`id`, `tenderval`, `tender_number`, `tender_body`, `tender_body_image`, `test_result`, `grade`, `is_star`, `p1_id`, `p2_id`, `p3_id`, `p5_id`, `decision_1`, `decision_1_a`, `decision_1_b`, `decision_1_comment`, `decision_2`, `decision_2_comment`, `decision_3`, `decision_3_b`, `decision_3_a`, `decision_3_comment`, `decision_4`, `decision_4_comment`, `email`, `rejected`, `applicant_name`, `generated_dec_id`, `id_tz`, `crdate`, `decision_5`, `decision_rejectedbyuser`, `decision_committee`, `has_salary`, `salary`, `accept_salary`, `selected_interview_time`, `selected_interview_place`, `approved_interview_place`, `approved_interview_time`, `last_interview_invitation_send`, `last_committee_invitation_send`, `approved_committee_time`, `is_appeared`, `committee_selected_place`, `committee_invitation_approved_time`, `2nd_invitation_rejected`, `invitation_rejected_by_user`, `rejected_status`, `stepback`, `additional_text`) VALUES
(346, '2025-225', '2025-225', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 345, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'karinahaleli@gmail.com', 0, 'קרינה הללי', NULL, '316949064', '2025-12-04 11:48:40', 0, 0, 1, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-12-04 12:41:05', '2025-12-04 16:00:00', NULL, 'לשכת מנכל', NULL, 0, 0, NULL, 0, NULL),
(347, '2025-225', '2025-225', NULL, 'img/logo.png', 1, '79', 0, 0, 0, 0, 346, 0, 0, 0, NULL, 1, 'מועמד דחה צפיות שכר', 0, 0, 0, NULL, 0, NULL, 'karinahaleli@gmail.com', 0, 'קרינה הללי', NULL, '316949064', '2025-12-04 12:28:09', 0, 1, 1, 1, 0, 0, '[\"19\\/12\\/2025 08:00\"]', '[null,null,null]', NULL, NULL, '2025-12-09 15:04:10', '2025-12-09 15:03:21', '2025-12-04 15:40:00', NULL, 'לשכת מנכל', '2025-12-09 11:45:14', 1, 1, NULL, 0, NULL),
(367, '2026-237', '2026-237', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 366, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'גכעכגע גכעכג', NULL, '308407139', '2026-01-19 15:49:15', 0, 0, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-01-26 10:29:01', '2026-01-25 06:31:00', NULL, 'fgfgfg', '2026-01-28 06:51:37', 0, 0, NULL, 0, 'גכעגכעכג'),
(376, '2026-244', '2026-244', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 375, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-21 11:20:24', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 'כעיעכי'),
(377, '2026-244', '2026-244', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 376, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-21 11:54:03', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 'כעיעכי'),
(378, '2026-245', '2026-245', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 377, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-22 14:08:49', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 'כעיעכי'),
(379, '2026-244', '2026-244', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 378, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-22 14:12:32', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 'כעיעכי'),
(380, '2026-237', '2026-237', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 379, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-26 06:25:20', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-01-26 06:25:50', '2026-01-26 06:25:00', NULL, 'fggffg', NULL, 0, 0, NULL, 0, 'כעיעכי'),
(381, '2026-244', '2026-244', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 380, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'imteajsajid1@gmail.com', 0, 'test e355325325', NULL, '252352352', '2026-01-26 06:34:21', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL),
(382, '2026-246', '2026-246', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 381, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-26 13:10:57', 0, 0, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-01-26 13:14:24', '2026-01-26 13:14:00', NULL, 'דגכגדכגדכד', '2026-01-26 13:14:32', 0, 0, NULL, 0, 'כעיעכי'),
(383, '2026-247', '2026-247', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 382, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-26 13:23:50', 0, 0, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-01-26 13:24:36', '2026-01-26 13:24:00', NULL, 'כגעכגעכג', '2026-01-26 13:24:43', 0, 0, NULL, 0, 'כעיעכי'),
(384, '2026-248', '2026-248', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 383, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-26 13:36:59', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 'כעיעכי'),
(385, '2026-248', '2026-248', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 384, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-26 14:36:30', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 'כעיעכי'),
(397, '2026-237', '2026-237', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 396, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'imteajsajid1@gmail.com', 0, 'user user', NULL, '234234234', '2026-01-28 04:49:56', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL),
(398, '2026-250', '2026-250', NULL, 'img/logo.png', NULL, NULL, 0, 0, 0, 0, 397, 1, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'guy@automas.co.il', 0, 'עיעכי כעיכעי', NULL, '308407139', '2026-01-28 07:18:43', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2026-01-28 08:04:51', '2028-09-28 06:23:00', NULL, 'dffdfds', NULL, 0, 0, NULL, 0, 'כעיעכי');

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_decisions_ext`
-- (See below for the actual view)
--
CREATE TABLE `app_decisions_ext` (
`id` int(11)
,`tenderval` varchar(200)
,`p1_id` int(11)
,`p2_id` int(11)
,`p3_id` int(11)
,`p5_id` int(11)
,`decision_1` int(11)
,`decision_1_a` int(11)
,`decision_1_b` int(11)
,`decision_1_comment` varchar(500)
,`decision_2` int(11)
,`decision_2_comment` varchar(500)
,`decision_3` int(11)
,`decision_3_a` int(11)
,`decision_3_b` int(11)
,`decision_3_comment` varchar(500)
,`decision_4` int(11)
,`decision_4_comment` varchar(500)
,`decision_committee` int(11)
,`email` varchar(200)
,`rejected` int(11)
,`applicant_name` varchar(100)
,`generated_dec_id` int(11)
,`id_tz` varchar(200)
,`2nd_invitation_rejected` tinyint(2)
,`crdate` timestamp
,`decision_5` int(11)
,`decision_6` bigint(21)
,`decision_7` bigint(21)
,`decision_8` bigint(21)
,`decision_rejectedbyuser` int(11)
,`invitation_rejected_by_user` tinyint(4)
,`status` varchar(26)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_rejected`
-- (See below for the actual view)
--
CREATE TABLE `app_rejected` (
`trejected` bigint(21)
,`tenderval` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('guy@automaa.co.il|103.133.201.67', 'i:1;', 1762188086),
('guy@automaa.co.il|103.133.201.67:timer', 'i:1762188086;', 1762188086),
('guy@automas.co.il|103.185.25.209', 'i:1;', 1769421420),
('guy@automas.co.il|103.185.25.209:timer', 'i:1769421420;', 1769421420),
('test@test.co|85.130.135.82', 'i:1;', 1768994816),
('test@test.co|85.130.135.82:timer', 'i:1768994816;', 1768994816),
('test@test.com|103.205.134.11', 'i:1;', 1758433677),
('test@test.com|103.205.134.11:timer', 'i:1758433677;', 1758433677),
('test@test.com|103.205.134.8', 'i:2;', 1758394446),
('test@test.com|103.205.134.8:timer', 'i:1758394446;', 1758394446);

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
-- Stand-in structure for view `count_justaploaded`
-- (See below for the actual view)
--
CREATE TABLE `count_justaploaded` (
`ccv` bigint(21)
,`app_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_newfiles`
-- (See below for the actual view)
--
CREATE TABLE `count_newfiles` (
`ccv` bigint(21)
,`app_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_notapproved`
-- (See below for the actual view)
--
CREATE TABLE `count_notapproved` (
`ccv` bigint(21)
,`app_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_rejectedfiles`
-- (See below for the actual view)
--
CREATE TABLE `count_rejectedfiles` (
`ccv` bigint(21)
,`app_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_touchedfiles`
-- (See below for the actual view)
--
CREATE TABLE `count_touchedfiles` (
`ccv` bigint(21)
,`app_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_zerofiles`
-- (See below for the actual view)
--
CREATE TABLE `count_zerofiles` (
`ccv` bigint(21)
,`app_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `url`, `title`, `type`, `department`, `status`) VALUES
(1, 'page1', 'page1', 'מנהל החינוך - מחלקת רישום', 'page1', '\"\"', 0),
(2, 'page2', 'page2', 'מנהל החינוך - מחלקת רישום\r\n', 'page2', '\"\"', 0),
(3, 'page3', 'page3', 'מנהל החינוך - מחלקת רישום', 'page3', '\"\"', 0),
(4, 'רישום תושב חדש', 'toshav-hadash', 'מנהל החינוך - מחלקת רישום\r\n', 'nrr', 'school,childrengarden', 1),
(5, 'page5', 'page5', 'tktv.automas.co.il', 'page5', '\"\"', 1),
(6, 'zichron-devarim', 'zichron-devarim', 'עיריית רמת גן - מנהל משאבי אנוש', 'zichron-devarim', '\"\"', 1),
(7, 'protocol', 'protocol', 'עיריית רמת גן - מנהל משאבי אנוש', 'protocol', '\"\"', 1),
(8, 'אישור מכרז כ\"א', 'tender-approve', 'עיריית רמת גן - מנהל משאבי אנוש', 'hrta', 'hr', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getnewids`
-- (See below for the actual view)
--
CREATE TABLE `getnewids` (
`year(created_date)` int(4)
,`new` varchar(17)
);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_04_07_225757_create_sessions_table', 1),
(2, '2024_04_07_225935_create_cache_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otp_codes`
--

CREATE TABLE `otp_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `otp_code` varchar(10) NOT NULL,
  `purpose` varchar(50) NOT NULL DEFAULT 'login',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attempts` int(11) NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_codes`
--

INSERT INTO `otp_codes` (`id`, `user_id`, `email`, `otp_code`, `purpose`, `is_verified`, `expires_at`, `attempts`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 42, 'guy@automas.co.il', '788940', 'login', 1, '2026-01-20 00:43:06', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:33:06', '2026-01-20 00:33:41'),
(2, 42, 'guy@automas.co.il', '328423', 'login', 1, '2026-01-20 00:43:41', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:33:41', '2026-01-20 00:34:12'),
(3, 42, 'guy@automas.co.il', '236378', 'login', 1, '2026-01-20 00:44:12', 0, NULL, NULL, '2026-01-20 00:34:12', '2026-01-20 00:34:36'),
(4, 42, 'guy@automas.co.il', '597196', 'login', 1, '2026-01-20 00:44:36', 0, NULL, NULL, '2026-01-20 00:34:36', '2026-01-20 00:40:52'),
(5, 42, 'imteajsajid1@gmail.com', '306946', 'login', 1, '2026-01-20 00:50:52', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:40:52', '2026-01-20 00:41:49'),
(6, 42, 'imteajsajid1@gmail.com', '684170', 'login', 1, '2026-01-20 00:51:49', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:41:49', '2026-01-20 00:43:09'),
(7, 42, 'imteajsajid1@gmail.com', '898959', 'login', 1, '2026-01-20 00:53:09', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:43:09', '2026-01-20 00:44:25'),
(8, 42, 'imteajsajid1@gmail.com', '752417', 'login', 1, '2026-01-20 00:54:55', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:44:55', '2026-01-20 00:53:35'),
(9, 42, 'imteajsajid1@gmail.com', '977107', 'login', 1, '2026-01-20 01:03:35', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 00:53:35', '2026-01-20 00:54:07'),
(10, 42, 'imteajsajid1@gmail.com', '829572', 'login', 1, '2026-01-20 01:33:54', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 01:23:54', '2026-01-20 01:24:24'),
(11, 42, 'imteajsajid1@gmail.com', '105861', 'login', 1, '2026-01-20 05:12:08', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 05:02:08', '2026-01-20 05:04:12'),
(12, 42, 'imteajsajid1@gmail.com', '470516', 'login', 1, '2026-01-20 05:14:12', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 05:04:12', '2026-01-20 05:04:47'),
(13, 42, 'imteajsajid1@gmail.com', '149454', 'login', 1, '2026-01-20 05:14:47', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 05:04:47', '2026-01-20 05:07:17'),
(14, 42, 'imteajsajid1@gmail.com', '538308', 'login', 1, '2026-01-20 05:17:17', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 05:07:17', '2026-01-20 05:07:50'),
(15, 42, 'imteajsajid1@gmail.com', '359613', 'login', 1, '2026-01-20 05:57:14', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 05:47:14', '2026-01-20 05:51:18'),
(16, 42, 'imteajsajid1@gmail.com', '476147', 'login', 1, '2026-01-20 06:01:18', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 05:51:18', '2026-01-20 05:53:49'),
(17, 42, 'imteajsajid1@gmail.com', '483848', 'login', 1, '2026-01-20 06:27:48', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 06:17:48', '2026-01-20 06:18:11'),
(18, 42, 'imteajsajid1@gmail.com', '847417', 'login', 1, '2026-01-20 06:58:51', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 06:48:51', '2026-01-20 06:50:23'),
(19, 42, 'imteajsajid1@gmail.com', '661962', 'login', 1, '2026-01-20 07:00:23', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 06:50:23', '2026-01-20 06:56:50'),
(20, 42, 'imteajsajid1@gmail.com', '904212', 'login', 1, '2026-01-20 07:06:50', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 06:56:50', '2026-01-20 06:57:25'),
(21, 42, 'imteajsajid1@gmail.com', '729512', 'login', 1, '2026-01-20 14:02:32', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-20 13:52:32', '2026-01-20 13:53:21'),
(22, 42, 'imteajsajid1@gmail.com', '571288', 'login', 1, '2026-01-20 14:03:21', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-20 13:53:21', '2026-01-20 13:54:04'),
(23, 42, 'imteajsajid1@gmail.com', '485768', 'login', 1, '2026-01-20 14:04:04', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-20 13:54:04', '2026-01-20 13:54:57'),
(24, 42, 'imteajsajid1@gmail.com', '797745', 'login', 1, '2026-01-20 23:54:49', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-20 23:44:49', '2026-01-20 23:46:03'),
(25, 42, 'imteajsajid1@gmail.com', '387467', 'login', 1, '2026-01-20 23:59:39', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-20 23:49:39', '2026-01-20 23:50:06'),
(26, 42, 'imteajsajid1@gmail.com', '306807', 'login', 1, '2026-01-21 04:14:26', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 04:04:26', '2026-01-21 04:04:50'),
(27, 47, 'imteajsajid1@gmail.com', '958339', 'login', 1, '2026-01-21 04:40:39', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 04:30:39', '2026-01-21 04:31:09'),
(28, 42, 'guy@automas.co.il', '255177', 'login', 0, '2026-01-21 04:41:46', 0, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 04:31:46', '2026-01-21 04:31:46'),
(29, 42, 'guy@automas.co.il', '272043', 'login', 1, '2026-01-21 10:21:34', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 10:20:31', '2026-01-21 10:21:34'),
(30, 42, 'guy@automas.co.il', '557530', 'login', 0, '2026-01-21 10:31:34', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 10:21:34', '2026-01-21 10:21:34'),
(31, 42, 'guy@automas.co.il', '698512', 'login', 1, '2026-01-21 10:36:12', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 10:35:49', '2026-01-21 10:36:12'),
(32, 47, 'imteajsajid1@gmail.com', '686545', 'login', 1, '2026-01-21 10:41:00', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 10:40:28', '2026-01-21 10:41:00'),
(33, 47, 'imteajsajid1@gmail.com', '550920', 'login', 1, '2026-01-21 10:50:04', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 10:49:33', '2026-01-21 10:50:04'),
(34, 47, 'imteajsajid1@gmail.com', '870434', 'login', 1, '2026-01-21 10:57:29', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 10:57:08', '2026-01-21 10:57:29'),
(35, 47, 'imteajsajid1@gmail.com', '702899', 'login', 1, '2026-01-21 12:18:21', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 12:16:29', '2026-01-21 12:18:21'),
(36, 47, 'imteajsajid1@gmail.com', '838316', 'login', 1, '2026-01-21 12:18:42', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-21 12:18:21', '2026-01-21 12:18:42'),
(37, 47, 'imteajsajid1@gmail.com', '276999', 'login', 1, '2026-01-21 12:22:12', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 12:21:56', '2026-01-21 12:22:12'),
(38, 42, 'guy@automas.co.il', '617997', 'login', 1, '2026-01-21 15:22:42', 0, '37.131.111.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', '2026-01-21 15:19:04', '2026-01-21 15:22:42'),
(39, 42, 'guy@automas.co.il', '424821', 'login', 1, '2026-01-21 17:28:35', 0, '37.131.111.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', '2026-01-21 17:23:53', '2026-01-21 17:28:35'),
(40, 47, 'imteajsajid1@gmail.com', '805818', 'login', 1, '2026-01-22 03:53:23', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 03:53:00', '2026-01-22 03:53:23'),
(41, 42, 'guy@automas.co.il', '657150', 'login', 1, '2026-01-22 06:40:18', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 06:40:01', '2026-01-22 06:40:18'),
(42, 42, 'guy@automas.co.il', '346371', 'login', 1, '2026-01-22 07:43:49', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 07:43:29', '2026-01-22 07:43:49'),
(43, 42, 'guy@automas.co.il', '720861', 'login', 1, '2026-01-22 08:55:03', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 08:54:47', '2026-01-22 08:55:03'),
(44, 47, 'imteajsajid1@gmail.com', '337719', 'login', 1, '2026-01-22 09:09:18', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 09:08:40', '2026-01-22 09:09:18'),
(45, 47, 'imteajsajid1@gmail.com', '206906', 'login', 1, '2026-01-22 09:15:48', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 09:15:28', '2026-01-22 09:15:48'),
(46, 47, 'imteajsajid1@gmail.com', '517037', 'login', 0, '2026-01-22 09:26:03', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 09:16:03', '2026-01-22 09:16:03'),
(47, 42, 'guy@automas.co.il', '580095', 'login', 1, '2026-01-22 09:49:54', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-22 09:49:35', '2026-01-22 09:49:54'),
(48, 42, 'guy@automas.co.il', '378356', 'login', 0, '2026-01-25 05:04:04', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-25 04:54:04', '2026-01-25 04:54:04'),
(49, 42, 'guy@automas.co.il', '535049', 'login', 1, '2026-01-25 06:27:01', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-25 06:26:40', '2026-01-25 06:27:01'),
(50, 42, 'guy@automas.co.il', '405320', 'login', 0, '2026-01-25 08:41:51', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2026-01-25 08:31:51', '2026-01-25 08:31:51'),
(51, 42, 'guy@automas.co.il', '337268', 'login', 0, '2026-01-26 05:24:41', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2026-01-26 05:14:41', '2026-01-26 05:14:41'),
(52, 47, 'imteajsajid1@gmail.com', '293550', 'login', 1, '2026-01-26 05:19:50', 0, '58.145.190.237', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 05:19:26', '2026-01-26 05:19:50'),
(53, 42, 'guy@automas.co.il', '778563', 'login', 1, '2026-01-26 06:06:38', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2026-01-26 06:04:15', '2026-01-26 06:06:38'),
(54, 42, 'guy@automas.co.il', '872996', 'login', 1, '2026-01-26 06:21:19', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 06:20:57', '2026-01-26 06:21:19'),
(55, 47, 'imteajsajid1@gmail.com', '583189', 'login', 0, '2026-01-26 06:31:16', 1, '58.145.189.203', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 06:28:17', '2026-01-26 06:31:16'),
(56, 47, 'imteajsajid1@gmail.com', '602695', 'login', 1, '2026-01-26 06:32:40', 0, '58.145.189.203', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 06:32:19', '2026-01-26 06:32:40'),
(57, 47, 'imteajsajid1@gmail.com', '831463', 'login', 1, '2026-01-26 07:30:42', 0, '103.185.25.214', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 07:30:25', '2026-01-26 07:30:42'),
(58, 47, 'imteajsajid1@gmail.com', '707532', 'login', 1, '2026-01-28 03:31:35', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 03:31:10', '2026-01-28 03:31:35'),
(59, 47, 'imteajsajid1@gmail.com', '634816', 'login', 1, '2026-01-28 05:09:45', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 05:09:17', '2026-01-28 05:09:45'),
(60, 47, 'imteajsajid1@gmail.com', '895342', 'login', 1, '2026-01-28 05:16:16', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-28 05:15:55', '2026-01-28 05:16:16'),
(61, 47, 'imteajsajid1@gmail.com', '816556', 'login', 1, '2026-01-28 05:26:57', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 05:25:13', '2026-01-28 05:26:57'),
(62, 47, 'imteajsajid1@gmail.com', '244980', 'login', 1, '2026-01-28 05:27:14', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 05:26:57', '2026-01-28 05:27:14'),
(63, 47, 'imteajsajid1@gmail.com', '285561', 'login', 1, '2026-01-28 05:28:43', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 05:28:09', '2026-01-28 05:28:43'),
(64, 47, 'imteajsajid1@gmail.com', '509923', 'login', 0, '2026-01-28 05:54:20', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 05:44:20', '2026-01-28 05:44:20'),
(65, 42, 'guy@automas.co.il', '936658', 'login', 1, '2026-01-28 06:32:37', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 06:32:18', '2026-01-28 06:32:37'),
(66, 42, 'guy@automas.co.il', '316884', 'login', 1, '2026-01-28 06:36:39', 0, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 06:36:23', '2026-01-28 06:36:39'),
(67, 47, 'imteajsajid1@gmail.com', '985546', 'login', 0, '2026-01-28 07:21:52', 1, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-28 07:21:01', '2026-01-28 07:21:52'),
(68, 47, 'imteajsajid1@gmail.com', '158840', 'login', 1, '2026-01-28 07:34:23', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-28 07:30:41', '2026-01-28 07:34:23'),
(69, 47, 'imteajsajid1@gmail.com', '754324', 'login', 0, '2026-01-28 07:34:45', 1, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 07:34:23', '2026-01-28 07:34:45'),
(70, 47, 'imteajsajid1@gmail.com', '130381', 'login', 1, '2026-01-28 07:41:40', 0, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 07:41:25', '2026-01-28 07:41:40');

-- --------------------------------------------------------

--
-- Stand-in structure for view `sendcopy_userdecisions`
-- (See below for the actual view)
--
CREATE TABLE `sendcopy_userdecisions` (
`name` text
,`email` text
,`decisionId` int(11)
,`userId` int(11)
);

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
('BpcuEoLuAR8mWj7Qp3rlUzuqjBF3g6ZTwhOTrDsd', 42, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicVBpWjl1NG9iQmNza0hNTHRnRGtJMlczblhDWDdUOWpPWlNIUUk2cSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cHM6Ly9raXJ5YXQtYXJiYS5hdXRvbWFzLmNvLmlsL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9hZG1pbi90ZW5kZXJzIjt9czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY5NTgyMTgzO31zOjE4OiJ0d29mYWN0b3JfdmVyaWZpZWQiO2I6MTtzOjE5OiJ0d29mYWN0b3JfdGltZXN0YW1wIjtpOjE3Njk1ODIxOTk7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDI7fQ==', 1769589669),
('dN6mNrevyER7h8pDsqqtV2RkwUyl8MKApnDCee5l', NULL, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NDoiaHR0cHM6Ly9raXJ5YXQtYXJiYS5hdXRvbWFzLmNvLmlsLzJmYS92ZXJpZnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiTThFdHF5ZHZBekg5THFTQ3JXeEs1a1RzTGFsRm5iV2FTMTUwMW1aZyI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY5NTg1NDQxO31zOjE3OiJ0d29mYWN0b3JfdXNlcl9pZCI7aTo0NztzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM5OiJodHRwczovL2tpcnlhdC1hcmJhLmF1dG9tYXMuY28uaWwvYWRtaW4iO319', 1769585443),
('EQnlcIql7wCQNYggW4OzQwGVzHLZ6z4ukUJ3hrAa', NULL, '54.74.201.229', 'Plesk screenshot bot https://support.plesk.com/hc/en-us/articles/10301006946066', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTWdqaDc0MjBtNmFscml1alBiVllZaVZZbnhQaDM2NjdCM29YVGtIMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzk6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9hZG1pbiI7fX0=', 1769577483),
('gwc8ZHV6skcNUFtEu94dGyH6eR96AUqArwHwQEbY', NULL, '147.236.218.91', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRkNxTkpXTGJBcERjQjBPM0pYSVRzSVhJMmdXcFYybHB2aHl0RHZVQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cHM6Ly9raXJ5YXQtYXJiYS5hdXRvbWFzLmNvLmlsL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769586215),
('jgFaOs3uhNWEnOtjQyIMRhI7nvDGioEEofSfs84I', 42, '85.130.135.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiaURPblNOYm5vV003WTNBSlJOc1NLRXFiMGJPS0dUS1gxYllrcnFxdCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cHM6Ly9raXJ5YXQtYXJiYS5hdXRvbWFzLmNvLmlsL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC8yZmEvdmVyaWZ5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6Nzoic3VjY2VzcyI7fXM6MzoibmV3IjthOjA6e319czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY5NTgxOTM4O31zOjE4OiJ0d29mYWN0b3JfdmVyaWZpZWQiO2I6MTtzOjE5OiJ0d29mYWN0b3JfdGltZXN0YW1wIjtpOjE3Njk1ODE5NTc7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDI7czo3OiJzdWNjZXNzIjtzOjI1OiLXlNeq15fXkdeo16og15HXlNem15zXl9eUIjt9', 1769581958),
('lVStlak9vrhTYJk5MJldwPE3jCA1JYU52vy537Vb', NULL, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjJnREJvOU1LbGE4dW5KajNKblR5SWNxdE40V1JweXJiMksxYk1TUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODY6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9wYWdlNT9maWxlPSZ0ZW5kZXJkaXNwbGF5PTIwMjYtMjQ0JnRlbmRlcmlkPTIwMjYtMjQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769579063),
('sQVNjzTnpHv3yFsCzv20w62wCw9uqyiE9aW2Fyr5', NULL, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiQkJEamIzMkhzVHRwTzhpUno5TE1CQ3J3b2J6NWJpMDB0WEpoaDA4TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9wdWJsaWMvMmZhL3ZlcmlmeSI7fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2OTU4NTY2Mzt9czoxNzoidHdvZmFjdG9yX3VzZXJfaWQiO2k6NDc7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cHM6Ly9raXJ5YXQtYXJiYS5hdXRvbWFzLmNvLmlsL2FkbWluIjt9fQ==', 1769586060),
('Zewmby8ESPY7vNJuAabchFZUpj0upl7gybIMA52Q', NULL, '103.203.92.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cHM6Ly9raXJ5YXQtYXJiYS5hdXRvbWFzLmNvLmlsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ik1yZ1dTZ3h2dW1KaDBLakVJcXpQUjVYTGRxSzYxQUYzQ0NST2ZhQnEiO3M6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDU6Imh0dHBzOi8va2lyeWF0LWFyYmEuYXV0b21hcy5jby5pbC9hZG1pbi91c2VycyI7fX0=', 1769589616);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`value`)),
  `name_of_form_name` varchar(255) DEFAULT NULL COMMENT 'the name of input that contains template name',
  `blade_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `status`, `value`, `name_of_form_name`, `blade_file`) VALUES
(7, 'תבנית חדשה יותר לבדיקה', 0, '{\"header_title\":{\"value\":\"\\u05d7\\u05dc\\u05e7 \\u05e2\\u05dc\\u05d9\\u05d5\\u05df \\u05dc\\u05d1\\u05d3\\u05d9\\u05e7\\u05d4 \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea\\u05d9\\u05ea\",\"tender_form_id\":null},\"date\":{\"value\":\"2024-09-25\",\"tender_form_id\":null},\"template_name\":{\"value\":\"\\u05ea\\u05d1\\u05e0\\u05d9\\u05ea \\u05d7\\u05d3\\u05e9\\u05d4 \\u05d9\\u05d5\\u05ea\\u05e8 \\u05dc\\u05d1\\u05d3\\u05d9\\u05e7\\u05d4\",\"tender_form_id\":null},\"workplace_label\":{\"value\":\"\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4\",\"tender_form_id\":null},\"workplace\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05e6\\u05d4 \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d9\\u05d5\\u05d0\\u05d1 (\\u05dc\\u05d9\\u05d3 \\u05d2\\u05d3\\u05e8\\u05d4)\",\"tender_form_id\":null},\"position_label\":{\"value\":\"\\u05d4\\u05e7\\u05e3 \\u05de\\u05e9\\u05e8\\u05d4\",\"tender_form_id\":null},\"position\":{\"value\":\"100%\",\"tender_form_id\":null},\"wage_label\":{\"value\":\"\\u05e9\\u05db\\u05e8\",\"tender_form_id\":null},\"wage\":{\"value\":\"\\u05de\\u05d9\\u05e0\\u05d4\\u05dc\\u05d9 7-10\",\"tender_form_id\":null},\"subordination_label\":{\"value\":\"\\u05db\\u05e4\\u05d9\\u05e4\\u05d5\\u05ea\",\"tender_form_id\":null},\"subordination\":{\"value\":\"\\u05dc\\u05de\\u05e0\\u05d4\\u05dc \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4, \\u05de\\u05d5\\u05e0\\u05d7\\u05d4 \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05ea \\u05e2\\\"\\u05d9 \\u05e7\\u05e6\\u05d9\\u05df \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d1\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4 5\",\"tender_form_id\":\"subordinations\"},\"starting_work_label\":{\"value\":\"\\u05ea\\u05d7\\u05d9\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4\",\"tender_form_id\":null},\"starting_work\":{\"value\":\"\\u05de\\u05d9\\u05d9\\u05d3\\u05d9\",\"tender_form_id\":null},\"job_description_label\":{\"value\":\"\\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3\",\"tender_form_id\":null},\"job_description\":{\"value\":\"\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d4\\u05e9\\u05d9\\u05d9\\u05da \\u05dc\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05d0\\u05d5 \\u05de\\u05e9\\u05de\\u05e9 \\u05d0\\u05d5\\u05ea\\u05d4 \\u05d5\\u05d4\\u05e4\\u05e2\\u05dc\\u05ea\\u05d5 \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5                        \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.\",\"tender_form_id\":null},\"main_areas_of_responsibility_label\":{\"value\":\"\\u05ea\\u05d7\\u05d5\\u05de\\u05d9 \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05e2\\u05d9\\u05e7\\u05e8\\u05d9\\u05d9\\u05dd\",\"tender_form_id\":null},\"main_areas_of_responsibility\":{\"value\":\"1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.        .2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea.        .3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 .\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus_label\":{\"value\":\".1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus\":{\"value\":\"\\u05d0. \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d8\\u05d5\\u05d7\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e7\\u05e4\\u05d3\\u05d4 \\u05e2\\u05dc                        \\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d5\\u05d4\\u05d4\\u05e4\\u05e1\\u05e7\\u05d5\\u05ea \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2\\u05d5 \\u05d1\\u05d3\\u05d9\\u05df.                        \\u05d1. \\u05e0\\u05e7\\u05d9\\u05d8\\u05ea \\u05d0\\u05de\\u05e6\\u05e2\\u05d9 \\u05d6\\u05d4\\u05d9\\u05e8\\u05d5\\u05ea, \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d1\\u05d8\\u05d7\\u05ea \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd.                        \\u05d2. \\u05e7\\u05d9\\u05d5\\u05dd \\u05e1\\u05d3\\u05e8\\u05d9 \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d5\\u05d1\\u05d3\\u05d9\\u05e7\\u05d5\\u05ea \\u05dc\\u05d0\\u05d9\\u05ea\\u05d5\\u05e8 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd \\u05d7\\u05e9\\u05d5\\u05d3\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df                        \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd.                        \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea.                        \\u05d4. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d0\\u05d3\\u05d9\\u05d1 \\u05d5\\u05de\\u05e0\\u05d5\\u05de\\u05e1 \\u05dc\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd .\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings_label\":{\"value\":\".2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings\":{\"value\":\"\\u05d0. \\u05d4\\u05ea\\u05e7\\u05e0\\u05ea \\u05e9\\u05d9\\u05dc\\u05d5\\u05d8, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d5\\u05de\\u05d0\\u05d7\\u05d5\\u05e8\\u05d9 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05e2\\u05dc\\u05d9\\u05d5 \\u05db\\u05d9\\u05ea\\u05d5\\u05d1 \\u05d1\\u05d5\\u05dc\\u05d8 \\\"\\u05d4\\u05e1\\u05e2\\u05d5\\u05ea \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd\\\".                        \\u05d1. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d9\\u05e9\\u05d9\\u05d1\\u05ea \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4 \\u05d5\\u05e2\\u05dc \\u05d4\\u05d9\\u05d5\\u05ea\\u05dd \\u05d7\\u05d2\\u05d5\\u05e8\\u05d9\\u05dd \\u05d1\\u05d7\\u05d2\\u05d5\\u05e8\\u05d5\\u05ea                        \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05de\\u05e1\\u05e4\\u05e8 \\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4.                        \\u05d2. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d4\\u05de\\u05ea\\u05e8\\u05d7\\u05e9 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05d5\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05ea\\u05e0\\u05d4\\u05d2\\u05d5\\u05ea \\u05dc\\u05d0 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea\\u05d9\\u05ea.                        \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea )\\u05d1\\u05d9\\u05df \\u05d0\\u05dd \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d6\\u05e2\\u05d9\\u05e8 \\u05d0\\u05d5                        \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1) \\u05d1\\u05ea\\u05d7\\u05e0\\u05d5\\u05ea \\u05d4\\u05e1\\u05e2\\u05d4 \\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea \\u05d5\\u05de\\u05d5\\u05e1\\u05d3\\u05e8\\u05d5\\u05ea \\u05de\\u05e8\\u05d0\\u05e9, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05dc\\u05ea \\u05e4\\u05e0\\u05e1\\u05d9 \\u05d0\\u05d9\\u05ea\\u05d5\\u05ea                        \\u05de\\u05d4\\u05d1\\u05d4\\u05d1\\u05d9\\u05dd \\u05d1\\u05db\\u05dc \\u05e2\\u05ea \\u05e9\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05e4\\u05ea\\u05d5\\u05d7\\u05d5\\u05ea.                        \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05d4 \\u05db\\u05d9 \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d9\\u05e8\\u05d3\\u05d5 \\u05de\\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d5\\u05d4\\u05ea\\u05e8\\u05d7\\u05e7\\u05d5 \\u05de\\u05e0\\u05ea\\u05d9\\u05d1 \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d4\\u05de\\u05e9\\u05da                        \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4.                        \\u05d5. \\u05e1\\u05e8\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05ea\\u05d5\\u05dd \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05d5\\u05d5\\u05d3\\u05d0 \\u05e9\\u05dc\\u05d0 \\u05e0\\u05d5\\u05ea\\u05e8\\u05d5 \\u05d1\\u05d5 \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd.\",\"tender_form_id\":null},\"bus_safety_and_soundness_label\":{\"value\":\".3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"bus_safety_and_soundness\":{\"value\":\"\\u05d0. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05de\\u05e2\\u05e8\\u05db\\u05d5\\u05ea\\u05d9\\u05d5 \\u05d4\\u05d4\\u05d9\\u05d3\\u05e8\\u05d0\\u05d5\\u05dc\\u05d9\\u05d5\\u05ea \\u05d5\\u05d4\\u05de\\u05db\\u05e0\\u05d9\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd \\u05dc\\u05e4\\u05e0\\u05d9                        \\u05d4\\u05d9\\u05e6\\u05d9\\u05d0\\u05d4 \\u05dc\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d5\\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2\\u05df )\\u05db\\u05d2\\u05d5\\u05df: \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05e9\\u05de\\u05df, \\u05de\\u05d9\\u05dd, \\u05e6\\u05de\\u05d9\\u05d2\\u05d9\\u05dd, \\u05d1\\u05dc\\u05de\\u05d9\\u05dd,                        \\u05de\\u05d2\\u05d1\\u05d9\\u05dd, \\u05de\\u05e2\\u05e8\\u05db\\u05ea \\u05d4\\u05d7\\u05e9\\u05de\\u05dc \\u05d5\\u05d4\\u05d0\\u05d5\\u05e8\\u05d5\\u05ea, \\u05e4\\u05e2\\u05d5\\u05dc\\u05d5\\u05ea \\u05d4\\u05e4\\u05ea\\u05d9\\u05d7\\u05d4 \\u05d5\\u05d4\\u05e1\\u05d2\\u05d9\\u05e8\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d5\\u05db\\u05d9\\u05d5\\u05e6\\\"\\u05d1).                        \\u05d1. \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d9\\u05dd \\u05e7\\u05dc\\u05d9\\u05dd \\u05d4\\u05d3\\u05e8\\u05d5\\u05e9\\u05d9\\u05dd \\u05dc\\u05d0\\u05d7\\u05d6\\u05e7\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05d3\\u05d9\\u05d5\\u05d5\\u05d7 \\u05dc\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea                        \\u05d0\\u05d5 \\u05dc\\u05d9\\u05e7\\u05d5\\u05d9\\u05d9\\u05dd \\u05e9\\u05d4\\u05ea\\u05d2\\u05dc\\u05d5.                        \\u05d2. \\u05d4\\u05e2\\u05d1\\u05e8\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea                        \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4.                        \\u05d3. \\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05e4\\u05e8\\u05d8\\u05d9 \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea \\u05d1\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1.                        \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05d0\\u05d7\\u05e8 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d5 \\u05d1\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd                        \\u05dc\\u05e0\\u05d4\\u05dc\\u05d9\\u05dd \\u05d5\\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 .                        \\u05d5. \\u05d6\\u05d9\\u05d5\\u05d5\\u05d3 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05e2\\u05d6\\u05e8 )\\u05de\\u05d8\\u05e3, \\u05de\\u05e9\\u05d5\\u05dc\\u05e9, \\u05e2\\u05d6\\u05e8\\u05d4 \\u05e8\\u05d0\\u05e9\\u05d5\\u05e0\\u05d4, \\u05d0\\u05e4\\u05d5\\u05d3                        \\u05d6\\u05d5\\u05d4\\u05e8 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1).                        \\u05d6. \\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05ea\\u05d5\\u05e7\\u05e4\\u05dd \\u05e9\\u05dc \\u05de\\u05e1\\u05de\\u05db\\u05d9 \\u05d4\\u05e8\\u05db\\u05d1 )\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05d4\\u05e8\\u05db\\u05d1, \\u05d1\\u05d9\\u05d8\\u05d5\\u05d7 \\u05d7\\u05d5\\u05d1\\u05d4 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1( \\u05d5\\u05d4\\u05d9\\u05de\\u05e6\\u05d0\\u05d5\\u05ea\\u05dd                        \\u05d1\\u05e8\\u05db\\u05d1 \\u05d1\\u05d6\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4.                        \\u05d7. \\u05ea\\u05d3\\u05dc\\u05d5\\u05e7 \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d7\\u05e0\\u05d9\\u05d9\\u05ea\\u05d5 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05d5\\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.                        \\u05d8. \\u05e9\\u05d8\\u05d9\\u05e4\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05e0\\u05d5 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05df \\u05e1\\u05d1\\u05d9\\u05e8 \\u05de\\u05d1\\u05d7\\u05d5\\u05e5 \\u05d5\\u05d7\\u05d9\\u05d8\\u05d5\\u05d9 \\u05d0\\u05d7\\u05ea                        \\u05dc\\u05e9\\u05e0\\u05d4.                        \\u05d9. \\u05d4\\u05d7\\u05d6\\u05e8\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d1\\u05e1\\u05d9\\u05d5\\u05dd \\u05d9\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05dc\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e8\\u05d9\\u05db\\u05d5\\u05d6 \\u05e9\\u05dc \\u05e8\\u05db\\u05d1 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.        \\u05d9\\u05d0. \\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05de\\u05d3\\u05d5\\u05d9\\u05e7 \\u05d1\\u05d9\\u05d5\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea )\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1( \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd .\",\"tender_form_id\":null},\"unique_performance_characteristics_label\":{\"value\":\"\\u05de\\u05d0\\u05e4\\u05d9\\u05d9\\u05e0\\u05d9 \\u05d4\\u05e2\\u05e9\\u05d9\\u05d9\\u05d4 \\u05d4\\u05d9\\u05d9\\u05d7\\u05d5\\u05d3\\u05d9\\u05d9\\u05dd \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3:\",\"tender_form_id\":null},\"unique_performance_characteristics\":{\"value\":\"\\u05d0. \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d5\\u05dc \\u05e7\\u05d4\\u05dc \\u05d5\\u05e2\\u05dd \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d1\\u05e4\\u05e8\\u05d8.                        \\u05d1. \\u05d9\\u05d9\\u05e6\\u05d5\\u05d2\\u05d9\\u05d5\\u05ea.                        \\u05d2. \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05dc\\u05d7\\u05d9\\u05d9 \\u05d0\\u05d3\\u05dd.                        \\u05d3. \\u05e1\\u05de\\u05db\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea.                        \\u05d4. \\u05e1\\u05d3\\u05e8 \\u05d5\\u05d0\\u05e8\\u05d2\\u05d5\\u05df.                        \\u05d5. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05e2\\u05d1\\u05d5\\u05d3 \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d1\\u05dc\\u05ea\\u05d9 \\u05e9\\u05d2\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05e1\\u05d5\\u05e4\\u05d9 \\u05e9\\u05d1\\u05d5\\u05e2 \\u05d5\\u05d1\\u05d7\\u05d5\\u05dc \\u05d4\\u05de\\u05d5\\u05e2\\u05d3.                        \\u05d6. \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d0\\u05d5\\u05de\\u05e6\\u05ea \\u05d1\\u05de\\u05e6\\u05d1\\u05d9 \\u05d7\\u05d9\\u05e8\\u05d5\\u05dd \\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05d9\\u05dd \\u05d5\\u05dc\\u05d0\\u05d5\\u05de\\u05d9\\u05d9\\u05dd.                        \\u05d7. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e0\\u05d9\\u05d9\\u05d3\\u05d5\\u05ea \\u05d5\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05ea\\u05d5\\u05e7\\u05e3 )\\u05d7\\u05d5\\u05d1\\u05d4( \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05d1\\u05e6\\u05e2 \\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d1\\u05de\\u05e1\\u05d2\\u05e8\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3.                        \\u05d8. \\u05d0\\u05de\\u05d9\\u05e0\\u05d5\\u05ea \\u05d5\\u05d9\\u05d5\\u05e9\\u05e8\\u05d4.                        \\u05d9. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05d1\\u05e6\\u05d5\\u05d5\\u05ea \\u05e2\\u05dd \\u05d2\\u05d5\\u05e8\\u05de\\u05d9 \\u05e4\\u05e0\\u05d9\\u05dd \\u05d5\\u05d7\\u05d5\\u05e5.                        \\u05d9\\u05d0. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d1\\u05e9\\u05d2\\u05e8\\u05d4 \\u05d5\\u05d1\\u05d7\\u05d9\\u05e8\\u05d5\\u05dd.                        \\u05d9\\u05d1. \\u05e9\\u05dc\\u05d9\\u05d8\\u05d4 \\u05d1\\u05e9\\u05e4\\u05d4 \\u05d4\\u05e2\\u05d1\\u05e8\\u05d9\\u05ea \\u05d1\\u05e8\\u05de\\u05d4 \\u05d8\\u05d5\\u05d1\\u05d4.\",\"tender_form_id\":null},\"criminal_record_label\":{\"value\":\"\\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9:\",\"tender_form_id\":null},\"criminal_record\":{\"value\":\"\\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d5\\u05ea \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9\\u05d5\\u05ea \\u05d0\\u05d5 \\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 15 \\u05d1 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4.                        \\u2022 \\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d4 \\u05d1\\u05e2\\u05d1\\u05d9\\u05e8\\u05ea \\u05de\\u05d9\\u05df ,\\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d7\\u05d5\\u05e7 \\u05dc\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05e2\\u05e1\\u05e7\\u05d4 \\u05e9\\u05dc \\u05e2\\u05d1\\u05e8\\u05d9\\u05d9\\u05e0\\u05d9 \\u05de\\u05d9\\u05df \\u05d1\\u05de\\u05d5\\u05e1\\u05d3\\u05d5\\u05ea                        \\u05de\\u05e1\\u05d5\\u05d9\\u05de\\u05d9\\u05dd , \\u05ea\\u05e9\\u05e1\\\"\\u05d0 2001- .\",\"tender_form_id\":null},\"knowledge_and_education_1_label\":{\"value\":\"\\u05d9\\u05d3\\u05e2 \\u05d5\\u05d4\\u05e9\\u05db\\u05dc\\u05d41:\",\"tender_form_id\":null},\"knowledge_and_education_1\":{\"value\":\"12 \\u05e9\\u05e0\\u05d5\\u05ea \\u05dc\\u05d9\\u05de\\u05d5\\u05d3 \\u05d0\\u05d5 \\u05ea\\u05e2\\u05d5\\u05d3\\u05ea \\u05d1\\u05d2\\u05e8\\u05d5\\u05ea \\u05de\\u05dc\\u05d0\\u05d4.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc1\",\"edit\":\"emodal_tender_add_cond_doc1\"}},\"professional_courses_and_trainings_2_label\":{\"value\":\"\\u05e7\\u05d5\\u05e8\\u05e1\\u05d9\\u05dd \\u05d5\\u05d4\\u05db\\u05e9\\u05e8\\u05d5\\u05ea \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05d5\\u05ea:2\",\"tender_form_id\":null},\"professional_courses_and_trainings_2\":{\"value\":\"\\u05d0. \\u05e7\\u05d5\\u05e8\\u05e1 \\u05dc\\u05e0\\u05d4\\u05d2\\u05d9 \\u05e8\\u05db\\u05d1 \\u05e6\\u05d9\\u05d1\\u05d5\\u05e8\\u05d9 \\u05e9\\u05dc \\u05de\\u05e9\\u05e8\\u05d3 \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4.                        \\u05d1. \\u05d4\\u05e9\\u05ea\\u05dc\\u05de\\u05d5\\u05ea \\u05dc\\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 84 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc2\",\"edit\":\"emodal_tender_add_cond_doc2\"}},\"professional_experience_3_label\":{\"value\":\"\\u05e0\\u05e1\\u05d9\\u05d5\\u05df \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d93:\",\"tender_form_id\":null},\"professional_experience_3\":{\"value\":\"\\u05e0\\u05d3\\u05e8\\u05e9 \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05e9\\u05dc \\u05e9\\u05e0\\u05ea\\u05d9\\u05d9\\u05dd \\u05dc\\u05e4\\u05d7\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05db\\u05e0\\u05d4\\u05d2 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc3\",\"edit\":\"emodal_tender_add_cond_doc3\"}},\"additional_requirements_4_label\":{\"value\":\"\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05e0\\u05d5\\u05e1\\u05e4\\u05d5\\u05ea4:\",\"tender_form_id\":null},\"additional_requirements_4\":{\"value\":\"\\u05e0\\u05d3\\u05e8\\u05e9 \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05e9\\u05dc \\u05e9\\u05e0\\u05ea\\u05d9\\u05d9\\u05dd \\u05dc\\u05e4\\u05d7\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05db\\u05e0\\u05d4\\u05d2 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc4\",\"edit\":\"emodal_tender_add_cond_doc4\"}},\"application_requirements_label\":{\"value\":\"\\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d2\\u05e9\\u05ea \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea \\u05d7\\u05d5\\u05d1\\u05d4 \\u05dc\\u05d4\\u05d2\\u05d9\\u05e9:\",\"tender_form_id\":null},\"application_requirements\":{\"value\":\"\\u2022 \\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05d0\\u05d9\\u05e9\\u05d9 \\u05dc\\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05d4\\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05dc\\u05d7\\u05e5 \\u05db\\u05d0\\u05df                        \\u2022 \\u05e7\\u05d5\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05d9\\u05dd                        \\u2022 \\u05ea\\u05e2\\u05d5\\u05d3\\u05d5\\u05ea \\u05d4\\u05e9\\u05db\\u05dc\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e9\\u05e8\\u05d4                        \\u2022 \\u05d4\\u05de\\u05dc\\u05e6\\u05d5\\u05ea )\\u05d1\\u05de\\u05d9\\u05d3\\u05d4 \\u05d5\\u05d9\\u05e9(\",\"tender_form_id\":null},\"application_rules1\":{\"value\":\"\\u05e2\\u05dc \\u05d4\\u05de\\u05e2\\u05d5\\u05e0\\u05d9\\u05d9\\u05e0\\u05d9\\u05dd.\\u05d5\\u05ea \\u05d4\\u05e2\\u05d5\\u05e0\\u05d9\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05dc\\u05d4\\u05e2\\u05d1\\u05d9\\u05e8 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05dc\\u05e2\\u05d9\\u05dc, \\u05d1\\u05d0\\u05d5\\u05e4\\u05df\\r\\n                    \\u05de\\u05e1\\u05d5\\u05d3\\u05e8 \\u05d5\\u05e7\\u05e8\\u05d9\\u05d0 , \\u05d5\\u05d6\\u05d0\\u05ea \\u05dc\\u05d0 \\u05d9\\u05d0\\u05d5\\u05d7\\u05e8 \\u05de\\u05d9\\u05d5\\u05dd 07\\/09\\/2024 \\u05d1\\u05d0\\u05de\\u05e6\\u05e2\\u05d5\\u05ea \\u05d4\\u05d2\\u05e9\\u05d4 \\u05dc\\u05de\\u05d9\\u05d9\\u05dc:\",\"tender_form_id\":null},\"application_rules2\":{\"value\":\"\\u05dc\\u05e4\\u05e7\\u05e1 08-8500703 \\u05d0\\u05d5 \\u05d1\\u05de\\u05e1\\u05d9\\u05e8\\u05d4 \\u05d9\\u05d3\\u05e0\\u05d9\\u05ea - \\u05dc\\u05d9\\u05d3\\u05d9 \\u05dc\\u05d9\\u05dc\\u05da \\u05e4\\u05e8\\u05e1\\u05e7\\u05d5 \\u05de\\u05e0\\u05d4\\u05dc\\u05ea \\u05d4\\u05d4\\u05d5\\u05df \\u05d4\\u05d0\\u05e0\\u05d5\\u05e9\\u05d9 \\u05d1\\u05de\\u05e9\\u05e8\\u05d3\\u05d9 \\u05de\\u05d5\\u05e2\\u05e6\\u05d4\\r\\n                \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d7\\u05d5\\u05e3 \\u05d4\\u05db\\u05e8\\u05de\\u05dc, \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05ea \\u05d4\\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea\",\"tender_form_id\":null},\"application_rules3\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd.\\u05d5\\u05ea \\u05e9\\u05dc\\u05d0 \\u05d9\\u05d2\\u05d9\\u05e9\\u05d5 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05d1\\u05de\\u05dc\\u05d5\\u05d0\\u05dd \\u05db\\u05d0\\u05de\\u05d5\\u05e8 \\u05dc\\u05e2\\u05d9\\u05dc \\u05d5\\u05d1\\u05de\\u05d5\\u05e2\\u05d3 \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2,\\r\\n                    \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea\\u05dd.\\u05df \\u05dc\\u05d0 \\u05ea\\u05d9\\u05d1\\u05d3\\u05e7 \\u05d5\\u05d4\\u05d9\\u05d0 \\u05ea\\u05e4\\u05e1\\u05dc \\u05e2\\u05dc \\u05d4\\u05e1\\u05e3.\",\"tender_form_id\":null},\"application_rules4\":{\"value\":\"\\u05db\\u05dc \\u05de\\u05e7\\u05d5\\u05dd \\u05d1\\u05d5 \\u05de\\u05e4\\u05d5\\u05e8\\u05d8 \\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05d1\\u05dc\\u05e9\\u05d5\\u05df \\u05d6\\u05db\\u05e8, \\u05d4\\u05db\\u05d5\\u05d5\\u05e0\\u05d4 \\u05d2\\u05dd \\u05dc\\u05dc\\u05e9\\u05d5\\u05df \\u05e0\\u05e7\\u05d1\\u05d4, \\u05d5\\u05db\\u05df \\u05dc\\u05d4\\u05d9\\u05e4\\u05da\\r\\n                \\u05d4\\u05d0\\u05e8\\u05d2\\u05d5\\u05df \\u05e0\\u05db\\u05d5\\u05df \\u05dc\\u05d1\\u05e6\\u05e2 \\u05d4\\u05ea\\u05d0\\u05de\\u05d5\\u05ea \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05e9\\u05dc\\u05d1 \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05e2\\u05d5\\u05d1\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea.\\r\\n                \\u05d1\\u05d5\\u05d5\\u05e2\\u05d3\\u05d4 \\u05ea\\u05d9\\u05e0\\u05ea\\u05df \\u05e2\\u05d3\\u05d9\\u05e4\\u05d5\\u05ea \\u05dc\\u05d4\\u05e2\\u05e1\\u05e7\\u05ea\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea \\u05de\\u05e9\\u05de\\u05e2\\u05d5\\u05ea\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05e1\\u05e2\\u05d9\\u05e3\\r\\n                9\\u05d2)\\u05d2()1( \\u05dc\\u05d7\\u05d5\\u05e7 \\u05e9\\u05d5\\u05d5\\u05d9\\u05d5\\u05df \\u05d6\\u05db\\u05d5\\u05d9\\u05d5\\u05ea \\u05dc\\u05d0\\u05e0\\u05e9\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea, \\u05ea\\u05e9\\u05e0\\\"\\u05d71998- \\u05d0\\u05e9\\u05e8 \\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05d4\\u05dd \\u05d3\\u05d5\\u05de\\u05d9\\u05dd\\r\\n                \\u05dc\\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd.\",\"tender_form_id\":null}}', 'template_name', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `id` int(11) NOT NULL,
  `template_id` int(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `tname` varchar(200) DEFAULT NULL,
  `generated_id` varchar(10) DEFAULT NULL,
  `tender_number` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `stopped` int(11) DEFAULT 0,
  `deleted` int(11) DEFAULT 0,
  `conditions` text DEFAULT NULL,
  `qualifications` text NOT NULL,
  `ttype` int(11) DEFAULT 0,
  `is_exist` tinyint(1) NOT NULL,
  `emails` text DEFAULT NULL,
  `brunch` varchar(200) DEFAULT NULL,
  `tender_type` int(11) NOT NULL,
  `tender_status` int(11) NOT NULL DEFAULT 0,
  `has_salary` tinyint(4) NOT NULL DEFAULT 0,
  `salary` varchar(255) NOT NULL DEFAULT '0',
  `additional_salary` int(255) NOT NULL DEFAULT 0,
  `note` longtext DEFAULT NULL,
  `job_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `functional_level` varchar(255) NOT NULL DEFAULT '0',
  `is_test_required` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `is_recommended` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `is_drushim` tinyint(4) NOT NULL DEFAULT 0,
  `input_manager` varchar(255) DEFAULT NULL,
  `job_scope` varchar(255) DEFAULT NULL,
  `subordinations` varchar(255) DEFAULT NULL,
  `grades_voltage` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_protocol` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=no, 1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `template_id`, `start_date`, `finish_date`, `tname`, `generated_id`, `tender_number`, `body`, `status`, `created_date`, `stopped`, `deleted`, `conditions`, `qualifications`, `ttype`, `is_exist`, `emails`, `brunch`, `tender_type`, `tender_status`, `has_salary`, `salary`, `additional_salary`, `note`, `job_details`, `functional_level`, `is_test_required`, `is_recommended`, `is_drushim`, `input_manager`, `job_scope`, `subordinations`, `grades_voltage`, `created_by`, `is_protocol`) VALUES
(1, NULL, '2024-09-22 09:00:00', '2024-09-28 09:00:00', 'asdas', '2024-101', '2024-101', NULL, NULL, '2024-09-22 14:57:42', 0, 1, NULL, '', 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(2, NULL, '2024-09-23 09:00:00', '2024-09-28 09:00:00', 'fsdf', '2024-102', '2024-102', NULL, NULL, '2024-09-23 11:17:59', 0, 1, 'תואר אקדמי המוכר על ידי המועצה להשכלה גבוהה או שקיבל הכרה מהמחלקה להערכת תארים אקדמיים בחוץ לארץ או תעודת הנדסאי.ת או טכנאי.ת מוסמכ.ת בהתאם לסעיף 39 לחוק ההנדסאים והטכנאים המוסמכים, התשע\"ג-2012. תינתן עדיפות לבעלי.ות תואר אקדמי באחד מהתחומים הבאים: קידום נוער, חינוך בלתי פורמאלי, חינוך, מדעי ההתנהגות והחברה (יובהר כי הניסיון המקצועי שיידרש ממועמדים.ות בעלי.ות תעודת הנדסאי.ת או טכנאי.ת במכרז יידרש מספר רב יותר של שנות ניסיון מקצועי מזה הנדרש במכרז מבעל.ת תואר אקדמי).תנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!תואר אקדמי המוכר על ידי המועצה להשכלה גבוהה או שקיבל הכרה מהמחלקה להערכת תארים אקדמיים בחוץ לארץ או תעודת הנדסאי.ת או טכנאי.ת מוסמכ.ת בהתאם לסעיף 39 לחוק ההנדסאים והטכנאים המוסמכים, התשע\"ג-2012. תינתן עדיפות לבעלי.ות תואר אקדמי באחד מהתחומים הבאים: קידום נוער, חינוך בלתי פורמאלי, חינוך, מדעי ההתנהגות והחברה (יובהר כי הניסיון המקצועי שיידרש ממועמדים.ות בעלי.ות תעודת הנדסאי.ת או טכנאי.ת במכרז יידרש מספר רב יותר של שנות ניסיון מקצועי מזה הנדרש במכרז מבעל.ת תואר אקדמי).=>required', '', 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(3, NULL, '2024-09-24 09:00:00', '2024-09-28 09:00:00', 'sadasd', '2024-103', '2024-103', NULL, NULL, '2024-09-24 13:07:31', 0, 1, NULL, '', 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(4, NULL, '2024-09-25 03:00:00', '2024-11-20 00:00:00', 'עו\"ס לחוק סדרי דין', '2024-104', '142/2024', NULL, NULL, '2024-09-25 10:33:34', 0, 1, NULL, '', 2, 0, NULL, 'אגף שירותים חברתיים', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '50%', 'מנהלת האגף לשירותים חברתיים וקהלתיים', 'דירוג העו\"ס - דרגה ע\"פ השכלה', 38, 1),
(5, NULL, '2024-10-06 09:00:00', '2024-12-10 23:59:00', 'מזכיר/ה לבית הספר \'יחד\'', '2024-105', '181/2024', NULL, NULL, '2024-10-06 09:59:19', 0, 1, NULL, '', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת מחלקת בתי ספר יסודיים במועצה', 'דירוג: מנהלי / מח\"ר דרגה: 7-9 / 37-39', 38, 1),
(6, NULL, '2024-10-14 09:00:00', '2024-12-18 23:59:00', 'בודק/ת בקשות להיתר ומידען/ית תכוני/ת', '2024-106', '143/2024', NULL, NULL, '2024-10-14 10:27:42', 0, 1, 'תעודת מהנדס/ת בניין או תואר באדריכלות או תעודת הנדסאי/ת אדריכלות/בנייןתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!תעודת מהנדס/ת בניין או תואר באדריכלות או תעודת הנדסאי/ת אדריכלות/בניין=>not_required', '', 2, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת מחלקת רישוי', 'דירוג: הנדסאים/מהנדסים דרגה: 37-41', 38, 1),
(7, NULL, '2024-10-15 09:00:00', '2024-12-10 23:59:00', 'רכז/ת תחזוקת אולמות ספורט למרכז מיר\"ב, שלוחת עתלית', '2024-107', '0000000', NULL, NULL, '2024-10-15 10:19:35', 0, 1, NULL, '', 2, 0, NULL, 'מחלקת תרבות', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'סמנכ\"לית מרכז מיר\"ב / מנהלת מחלקת הספורט / רכזת שלוחת עתלית', 'דירוג: מנהלי דרגה: 7-9', 38, 1),
(8, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'אם בית', '2024-108', '145/2024', NULL, NULL, '2024-11-03 08:36:33', 0, 1, NULL, '', 2, 0, NULL, 'הנהלה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '73%', 'מנכ\"ל המועצה', 'דירוג: מנהלי דרגה: 7-9', 38, 1),
(9, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'רכז/ת השכלה (תוכנית היל\"ה-השכלת יסוד לימודי השלמה)', '2024-109', '144/2024', NULL, NULL, '2024-11-03 08:49:42', 0, 1, NULL, '', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '50%', 'מנהל/ת יחידת קידום נוער', 'דירוג: מח\"ר/חינוך חברה ונוער דרגה: 37-39/ע\"פ השכלה', 38, 1),
(10, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'מהנדס.ת תשתיות ובינוי ליישוב עתלית- העסקה בחשבונית', '2024-110', 'דרושים/ות', NULL, NULL, '2024-11-03 08:53:04', 0, 1, NULL, '', 2, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 1, 'מהנדס המועצה', '20 שעות שבועיות', 'מהנדס המועצה', 'העסקה בחשבונית', 38, 1),
(11, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'עו\"ס מרכז/ת נושא מניעה וטיפול באלימות במשפחה', '2024-111', 'דרושים/ות', NULL, NULL, '2024-11-03 09:17:22', 0, 1, NULL, '', 2, 0, NULL, 'אגף שירותים חברתיים', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 1, NULL, '75%', 'מנהלת האגף לשירותים חברתיים וקהילתיים או מי שהוסמך/ה על ידה', 'דירוג: עו\"ס     דרגה: על פי השכלה', 38, 1),
(12, NULL, '2024-11-06 09:00:00', '2024-11-20 23:59:00', 'אב בית לבי\"ס במועצה', '2024-112', '000000', NULL, NULL, '2024-11-06 10:10:23', 0, 1, NULL, '', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת מחלקת בתי ספר יסודיים במועצה', 'דירוג: מנהלי דרגה: 7-9', 38, 1),
(13, NULL, '2024-11-06 09:00:00', '2024-11-20 23:59:00', 'פקח/ית  מוניציפאלי/ית ועובד/ת כללי/ת ליישוב עתלית', '2024-113', '000000', NULL, NULL, '2024-11-06 10:14:42', 0, 1, NULL, '', 2, 0, NULL, 'הנהלה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנכ\"ל עתלית', 'דירוג: מנהלי דרגה: 7-9', 38, 1),
(14, NULL, '2024-11-25 09:00:00', '2024-12-14 23:59:00', 'מטפל/ת למעון היום בכרם מהר\"ל', '2024-114', '183/2024', NULL, NULL, '2024-11-25 10:43:26', 0, 1, NULL, '', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '50% / 100%', 'מנהלת היחידה לגיל הרך / מנהלת המעון', 'דירוג: מנהלי   דרגה: 7-9', 38, 1),
(15, NULL, '2024-12-02 09:00:00', '2024-12-16 23:59:00', 'מנהל.ת אגף חדשנות ושירות', '2024-115', '0000000', NULL, NULL, '2024-12-02 08:09:29', 0, 1, NULL, '', 2, 0, NULL, 'הנהלה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, '100%', 'מנכ\"ל המועצה', 'שכר בכירים ברמת מנהל.ת אגף 70%-60% משכר מנכ\"ל, מותנה באישור משרד הפנים', 38, 1),
(16, NULL, '2024-12-03 09:00:00', '2024-12-18 23:59:00', 'מנהל.ת מחלקת גני ילדים', '2024-116', '148/2024', NULL, NULL, '2024-12-03 09:51:02', 0, 1, NULL, '', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת אגף החינוך', 'דירוג: מנהלי/ות מחלקות חינוך דרגה: 1', 38, 1),
(17, NULL, '2024-12-03 09:00:00', '2024-12-18 23:59:00', 'מנהל/ת יחידת הגיל הרך (לידה עד 3)', '2024-117', '149/2024', NULL, NULL, '2024-12-03 09:54:22', 0, 1, NULL, '', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהל/ת מחלקת גני ילדים', 'דירוג: חברה ונוער     דרגה: M.A/B.A', 38, 1),
(18, NULL, '2024-12-28 09:00:00', '2024-12-28 09:00:00', 'dev test', '2024-118', '2024-118', NULL, NULL, '2024-12-28 05:00:56', 0, 1, NULL, '', 3, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 27, 1),
(19, NULL, '2024-12-28 09:00:00', '2024-12-28 09:00:00', 'dev test', '2024-119', '2024-119', NULL, NULL, '2024-12-28 05:01:09', 0, 1, NULL, '', 3, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 27, 1),
(20, NULL, '2024-12-28 09:00:00', '2025-01-27 09:00:00', 'testtender1', '2024-120', '2024-120', NULL, NULL, '2024-12-28 05:47:26', 0, 1, NULL, '', 3, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', NULL, 27, 1),
(21, NULL, '2024-12-29 09:00:00', '2024-12-31 09:00:00', 'בדיקה', '2024-121', '2024-121', NULL, NULL, '2024-12-29 08:14:25', 0, 1, 'זכדגשדתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!זכדגשד=>required', '', 3, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, 'בדיקה', 38, 1),
(22, NULL, '2024-12-30 09:00:00', '2025-01-30 00:00:00', 'בדיקה ניצן', '2024-122', '000000000', NULL, NULL, '2024-12-30 06:50:38', 0, 1, NULL, '', 3, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(23, NULL, '2025-04-24 09:00:00', '2025-04-30 09:00:00', 'בדיקה', '2024-123', '2024-123', NULL, NULL, '2025-04-24 06:39:40', 0, 1, 'sdasdsaתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!sdasdsa=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(24, NULL, '2025-04-30 09:00:00', '2025-04-30 09:00:00', 'sdsd', '2025-124', '2025-124', NULL, NULL, '2025-04-26 06:30:16', 0, 1, 'asdsaתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!asdsa=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(25, NULL, '2025-04-26 09:00:00', '2025-05-31 09:00:00', 'בדיקה', '2025-125', '2025-125', NULL, NULL, '2025-04-26 18:26:20', 0, 1, 'שדגדשגתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!שדגדשג=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(26, NULL, '2025-04-27 09:00:00', '2025-05-31 09:00:00', 'בדיקה נוספת', '2025-126', '2025-126', NULL, NULL, '2025-04-27 05:47:14', 0, 1, 'דשגדשתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!דשגדש=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(27, NULL, '2025-04-27 09:00:00', '2025-05-31 09:00:00', 'בדיקת ראשון', '2025-127', '2025-127', NULL, NULL, '2025-04-27 13:12:58', 0, 1, 'השכלהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(28, NULL, '2025-04-28 09:00:00', '2025-05-28 09:00:00', 'בדיקה שני', '2025-128', '2025-128', NULL, NULL, '2025-04-28 08:33:18', 0, 1, 'ךלדחכךלתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!ךלדחכךל=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(29, NULL, '2025-04-28 09:00:00', '2025-05-31 09:00:00', 'בדיקה שלישי', '2025-129', '2025-129', NULL, NULL, '2025-04-28 16:03:44', 0, 1, NULL, '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(30, NULL, '2025-04-28 09:00:00', '2025-05-28 09:00:00', 'בדיקה רביעית', '2025-130', '2025-130', NULL, NULL, '2025-04-28 17:37:18', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(31, NULL, '2025-04-28 09:00:00', '2025-05-28 09:00:00', 'בדיקה חמישית', '2025-131', '2025-131', NULL, NULL, '2025-04-28 17:54:24', 0, 1, NULL, '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(32, NULL, '2025-04-28 09:00:00', '2025-05-28 09:00:00', 'בדיקה שישית', '2025-132', '2025-132', NULL, NULL, '2025-04-28 18:25:55', 0, 1, NULL, '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(33, NULL, '2025-04-28 09:00:00', '2025-04-30 09:00:00', 'בדיקה שביעית', '2025-133', '2025-133', NULL, NULL, '2025-04-28 18:41:32', 0, 1, NULL, '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(34, NULL, '2025-04-29 09:00:00', '2025-05-28 09:00:00', 'בדיקה שמינית', '2025-134', '2025-134', NULL, NULL, '2025-04-29 06:19:17', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(35, NULL, '2025-04-29 09:00:00', '2025-05-29 09:00:00', 'בדיקה תשיעית', '2025-135', '2025-135', NULL, NULL, '2025-04-29 12:56:58', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(36, NULL, '2025-04-29 09:00:00', '2025-05-29 09:00:00', 'בדיקה עשירית', '2025-136', '2025-136', NULL, NULL, '2025-04-29 13:39:29', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(37, NULL, '2025-04-29 09:00:00', '2025-05-27 09:00:00', 'בדיקה 11', '2025-137', '2025-137', NULL, NULL, '2025-04-29 14:19:48', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(38, NULL, '2025-04-29 09:00:00', '2025-05-30 09:00:00', 'בדיקה 12', '2025-138', '2025-138', NULL, NULL, '2025-04-29 18:07:23', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(39, NULL, '2025-04-29 09:00:00', '2025-05-29 09:00:00', 'בדיקה אחרונה', '2025-139', '2025-139', NULL, NULL, '2025-04-29 18:13:54', 0, 1, 'חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!חובה=>required!+!+!+!יתרוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!יתרון=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(40, NULL, '2025-05-01 09:00:00', '2025-05-01 09:00:00', NULL, '2025-140', '2025-140', NULL, NULL, '2025-05-01 12:51:52', 0, 1, '5תנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!5=>not_required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 1),
(41, NULL, '2025-05-06 09:00:00', '2025-05-31 09:00:00', 'מכרזי חדש לבדיקה', '2025-141', '2025-141', NULL, NULL, '2025-05-06 06:18:00', 0, 1, 'Nuwanתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!Nuwan=>required!+!+!+!Chamaraתנאי סףיתרון=>ניסיון מקצועי!+!+!+!Chamara=>', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(42, NULL, '2025-05-09 09:00:00', '2025-05-30 09:00:00', 'בדיקה', '2025-142', '2025-142', NULL, NULL, '2025-05-09 06:28:06', 0, 1, 'שדגדשגתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!שדגדשג=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(43, NULL, '2025-05-09 09:00:00', '2025-05-30 09:00:00', 'בדיקת שישי', '2025-143', '2025-143', NULL, NULL, '2025-05-09 07:12:45', 0, 1, 'תעודת השכלהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!תעודת השכלה=>required', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(44, NULL, '2025-05-09 09:00:00', '2025-05-30 09:00:00', 'בדיקת שישי', '2025-144', '2025-144', NULL, NULL, '2025-05-09 07:25:07', 0, 1, 'תעודת השכלהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!תעודת השכלה=>required!+!+!+!Chamaraתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!Chamara=>no!+!+!+!Nuwanתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!Nuwan=>no', '', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(45, NULL, '2025-05-09 09:00:00', '2025-05-30 09:00:00', 'קררק\'\'רק', '2025-145', '2025-145', NULL, NULL, '2025-05-09 07:28:20', 0, 1, 'אישור עבודה 3 שנים בעבודה בלוגיסטיקהתנאי סףיתרון=>ניסיון מקצועי!+!+!+!אישור עבודה 3 שנים בעבודה בלוגיסטיקה=>required', '5#$$#Chamara#$$##$$#Saman', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(46, NULL, '2025-05-12 09:00:00', '2025-05-12 09:00:00', NULL, '2025-146', '2025-146', NULL, NULL, '2025-05-12 16:45:42', 0, 1, NULL, '6#$$#Saman#$$##$$#Kumara', 1, 0, NULL, NULL, 4, 3, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 1),
(47, NULL, '2025-05-12 09:00:00', '2025-05-12 09:00:00', NULL, '2025-147', '2025-147', NULL, NULL, '2025-05-12 17:17:04', 0, 1, NULL, '5#$$##$$#Kamal#$$#', 1, 0, NULL, NULL, 4, 1, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 1),
(48, NULL, '2025-05-12 09:00:00', '2025-05-30 09:00:00', 'dasds', '2025-148', '2025-148', NULL, NULL, '2025-05-12 19:52:28', 0, 1, 'bmnbmnתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!bmnbmn=>no!+!+!+!mjhjkhkתנאי סףיתרון=>ניסיון מקצועי!+!+!+!mjhjkhk=>required', 'xzcxzcxcxzxzcxc#$$##$$##$$#', 1, 0, NULL, NULL, 4, 4, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(49, NULL, '2025-05-13 09:00:00', '2025-05-31 09:00:00', 'מכרזי לבדיקה', '2025-149', '2025-149', NULL, NULL, '2025-05-13 05:09:58', 0, 1, '* אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy) * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד *במקרים חריגים שלא ניתן להגיש אישור מעסיק יש לפנות למחלקת ההון האנושי במספר: 029969538תנאי סףיתרון=>ניסיון מקצועי!+!+!+!* אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy)  * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד *במקרים חריגים שלא ניתן להגיש אישור מעסיק יש לפנות למחלקת ההון האנושי במספר: 029969538=>required', '#$$##$$##$$#', 1, 0, NULL, NULL, 4, 4, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(50, NULL, '2025-05-19 09:00:00', '2025-06-06 09:00:00', 'test', '2025-150', '2025-150', NULL, NULL, '2025-05-19 06:25:54', 0, 1, '?Test questionתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!?Test question=>no', '#$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 4, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(51, NULL, '2025-05-20 09:00:00', '2025-05-29 09:00:00', 'דשגשד', '2025-151', '2025-151', NULL, NULL, '2025-05-20 05:20:39', 0, 1, 'Chamaraתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!Chamara=>no', '4#$$##$$##$$#dsadsa#$$#Saman', 1, 0, NULL, 'אגף חדש לבדיקה', 4, 4, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(52, NULL, '2025-05-22 09:00:00', '2025-05-31 09:00:00', 'asdasdsa', '2025-152', '2025-152', NULL, NULL, '2025-05-22 08:05:08', 0, 1, 'Check color תנאי סףיתרון=>ניסיון מקצועי!+!+!+!Check color =>required!+!+!+!Check adddressתנאי סףיתרון=>ניסיון מקצועי!+!+!+!Check adddress=>not_required!+!+!+!Check your cvתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!Check your cv=>not_required!+!+!+!Ask any questionתנאי סףיתרון=>ניסיון ניהול!+!+!+!Ask any question=>not_required', '#$$##$$##$$##$$#', 2, 0, NULL, NULL, 4, 1, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(53, NULL, '2025-06-01 09:00:00', '2025-06-17 09:00:00', 'ABC', '2025-153', '2025-153', NULL, NULL, '2025-05-31 23:59:10', 0, 1, '4תנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!4=>not_required!+!+!+!?Check computer courseתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!?Check computer course=>not_required!+!+!+!Test question 05=>שאלות כן ולא!+!+!+!Test question 05=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף מערכות מידע ומחשוב', 4, 2, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', NULL, 40, 1),
(54, NULL, '2025-06-04 09:00:00', '2025-06-25 09:00:00', 'sdfdsfdsfd1211', '2025-154', '2025-154', NULL, NULL, '2025-06-04 14:38:21', 0, 1, 'Primary educationתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!Primary education=>no!+!+!+!HR managementתנאי סףיתרון=>ניסיון ניהול!+!+!+!HR management=>no!+!+!+!question 01=>שאלות כן ולא!+!+!+!question 01=>no!+!+!+!question 02=>שאלות כן ולא!+!+!+!question 02=>no!+!+!+!question 03=>שאלות כן ולא!+!+!+!question 03=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(55, NULL, '2025-06-08 09:00:00', '2025-06-30 09:00:00', 'tender test 1', '2025-155', '2025-155', NULL, NULL, '2025-06-08 15:17:42', 0, 1, 'file 1Threshold conditionsadvantage=>Education and professional requirements!+!+!+!=>not_required!+!+!+!file 2Threshold conditionsadvantage=>Professional courses and training!+!+!+!=>not_required!+!+!+!file 3Threshold conditionsadvantage=>Professional experience!+!+!+!=>not_required!+!+!+!file 4Threshold conditionsadvantageI confirm that I meet these requirements.=>Additional requirements!+!+!+!=>no!+!+!+!file 5Threshold conditionsadvantage=>Management experience!+!+!+!=>cond_or!+!+!+!file 6Threshold conditionsadvantage=>Yes and no questions!+!+!+!=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 1, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(56, NULL, '2025-06-10 09:00:00', '2025-06-30 09:00:00', 'בדיקה', '2025-156', '2025-156', NULL, NULL, '2025-06-10 05:19:49', 0, 1, 'השכלה חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה חובה=>required!+!+!+!קורסים ניסיוןתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!קורסים ניסיון=>not_required!+!+!+!ניסיון חובהתנאי סףיתרון=>ניסיון מקצועי!+!+!+!ניסיון חובה=>required!+!+!+!דרישות נוספו יתרוןתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!דרישות נוספו יתרון=>not_required!+!+!+!ניסיון ניהולי חובהתנאי סףיתרון=>ניסיון ניהול!+!+!+!ניסיון ניהולי חובה=>required!+!+!+!האם אוהב כדורגל?תנאי סףיתרון=>שאלות כן ולא!+!+!+!האם אוהב כדורגל?=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 3, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 38, 1),
(57, NULL, '2025-06-14 09:00:00', '2025-06-26 09:00:00', 'sdfsdfd32424', '2025-157', '2025-157', NULL, NULL, '2025-06-14 08:34:46', 0, 1, NULL, '#$$##$$##$$##$$##$$#sdfdsfdsf', 1, 0, NULL, NULL, 4, 3, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(58, NULL, '2025-06-14 09:00:00', '2025-06-30 09:00:00', 'fddfdfsd', '2025-158', '2025-158', NULL, NULL, '2025-06-14 08:35:18', 1, 1, 'sdfdsfdsfdsתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!sdfdsfdsfds=>not_required!+!+!+!sdfdsfsdתנאי סףיתרון=>ניסיון ניהול!+!+!+!sdfdsfsd=>required!+!+!+!sdfsdfds=>שאלות כן ולא!+!+!+!sdfsdfds=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 1, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 1),
(59, NULL, '2025-06-18 09:00:00', '2025-06-30 09:00:00', 'בדיקה', '2025-159', '2025-159', NULL, NULL, '2025-06-18 05:07:20', 1, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 2, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38, 0),
(60, NULL, '2025-06-27 09:00:00', '2025-06-30 09:00:00', 'sdsadasds', '2025-160', '2025-160', NULL, NULL, '2025-06-27 06:55:20', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 0),
(61, NULL, '2025-06-27 09:00:00', '2025-07-08 09:00:00', 'ewrew', '2025-161', '2025-161', NULL, NULL, '2025-06-27 12:03:44', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 1),
(62, NULL, '2025-06-30 09:00:00', '2025-07-30 09:00:00', 'sfsdf', '2025-162', '2025-162', NULL, NULL, '2025-06-30 05:21:09', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 0),
(63, NULL, '2025-06-30 09:00:00', '2025-07-30 09:00:00', 'gfgdfgdf121212', '2025-163', '2025-163', NULL, NULL, '2025-06-30 11:52:16', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 0),
(64, NULL, '2025-07-01 09:00:00', '2025-07-30 09:00:00', 'יחיד', '2025-164', '2025-164', NULL, NULL, '2025-07-01 07:03:08', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 40, 1),
(65, NULL, '2025-07-01 09:00:00', '2025-07-31 09:00:00', 'cshev', '2025-165', '2025-165', NULL, NULL, '2025-07-01 12:32:35', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 1, NULL, NULL, NULL, NULL, 40, 1),
(66, NULL, '2025-07-07 09:00:00', '2025-07-31 09:00:00', 'בדיקה', '2025-166', '2025-166', NULL, NULL, '2025-07-07 12:03:12', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 1),
(67, NULL, '2025-07-08 09:00:00', '2025-07-31 09:00:00', 'בדיקה חדשה', '2025-167', '2025-167', NULL, NULL, '2025-07-08 07:55:03', 0, 1, 'Management experienceThreshold conditionsadvantage=>Management experience!+!+!+!=>required!+!+!+!Are you or not?=>Yes and no questions!+!+!+!=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 40, 1),
(68, 7, '2025-07-09 09:00:00', '2025-07-09 09:00:00', 'Test', '2025-168', '2025-168', NULL, NULL, '2025-07-09 09:31:18', 0, 1, NULL, '12 שנות לימוד או תעודת בגרות מלאה.#$$#א. קורס לנהגי רכב ציבורי של משרד התחבורה.                        ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$##$$#', 1, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', NULL, 40, 0),
(69, NULL, '2025-07-09 09:00:00', '2025-07-31 09:00:00', 'בדיקה חדשה נוספת', '2025-169', '2025-169', NULL, NULL, '2025-07-09 12:32:34', 0, 1, 'השכלה חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה חובה=>required!+!+!+!האם אתה כן או לא?=>שאלות כן ולא!+!+!+!האם אתה כן או לא?=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 40, 1),
(70, NULL, '2025-07-10 09:00:00', '2025-07-31 09:00:00', 'בדיקה', '2025-170', '2025-170', NULL, NULL, '2025-07-10 05:25:14', 0, 1, 'השכלה לבדיקהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה לבדיקה=>required!+!+!+!ניהולי לבדיקהתנאי סףיתרון=>ניסיון ניהול!+!+!+!ניהולי לבדיקה=>not_required!+!+!+!כן או לא?=>שאלות כן ולא!+!+!+!כן או לא?=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף קשרי קהילה', 4, 3, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגה', 40, 1),
(71, NULL, '2025-07-23 09:00:00', '2025-07-31 00:00:00', 'ניסיון למחיקה - מור', '2025-171', '96', NULL, NULL, '2025-07-23 13:36:26', 0, 1, '• תואר (B.A) במדעי הרוח/מדעי החברהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!•	תואר (B.A) במדעי הרוח/מדעי החברה=>no!+!+!+!• ניסיון מקצועי: ניסיון כמורה בכיר/מנהל בית ספר עם ניסיון של 3-5 שנות הוראה או כעובד סוציאלי בעל ניסיון דומה ברשות מקומית כלשהי או במוסד ציבורי מוכר. תנאי סףיתרון=>ניסיון מקצועי!+!+!+!•	ניסיון מקצועי: ניסיון כמורה בכיר/מנהל בית ספר עם ניסיון של 3-5 שנות הוראה או כעובד סוציאלי בעל ניסיון דומה ברשות מקומית כלשהי או במוסד ציבורי מוכר.  =>required!+!+!+!אישור ניסיון מקצועי/ניהולי תקין: * אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy) * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד *במקרים חריגים שלא ניתן להגיש אישור מעסיק יש לפנות למחלקת ההון האנושי במספר: 029969538תנאי סףיתרון=>ניסיון מקצועי!+!+!+!אישור ניסיון מקצועי/ניהולי תקין: * אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy)  * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד *במקרים חריגים שלא ניתן להגיש אישור מעסיק יש לפנות למחלקת ההון האנושי במספר: 029969538=>not_required!+!+!+!מועמד יקר שים לב! אישור ניסיון מקצועי/ניהולי תקין: * אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy) * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקידתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!מועמד יקר שים לב! אישור ניסיון מקצועי/ניהולי תקין: * אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy)  * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד=>not_required!+!+!+!אישור ניסיון מקצועי/ניהולי תקין: * אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy) * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד *במקרים חריגים שלא ניתן להגיש אישור מעסיק יש לפנות למחלקת ההון האנושי במספר: 029969538תנאי סףיתרון=>ניסיון ניהול!+!+!+!אישור ניסיון מקצועי/ניהולי תקין: * אישור ממקום העבודה חתום ע\"י מקום העבודה * מתאריך (dd/mm/yyyy) עד תאריך (dd/mm/yyyy)  * פירוט היקף המשרה * תיאור תמציתי של תוכן התפקיד *במקרים חריגים שלא ניתן להגיש אישור מעסיק יש לפנות למחלקת ההון האנושי במספר: 029969538=>not_required!+!+!+!2 שנים בניהול 2 עובדים לפחותתנאי סףיתרון=>ניסיון ניהול!+!+!+!2 שנים בניהול 2 עובדים לפחות=>required!+!+!+!האם הנך בעל תואר אקדמאי ?=>שאלות כן ולא!+!+!+!האם הנך בעל תואר אקדמאי ?=>no!+!+!+!האם יש לך את הניסיון המקצועי הנדרש?=>שאלות כן ולא!+!+!+!האם יש לך את הניסיון המקצועי הנדרש?=>no', '3#$$##$$##$$##$$##$$#', 2, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 1, 0, 'יותם סלע', '85% - 100%', 'למנהל אגף שפ\"ע', 'חינוך חברה ונוער', 41, 1),
(72, NULL, '2025-07-24 06:00:00', '2025-07-31 09:00:00', 'בדיקה', '2025-172', '123-12', NULL, NULL, '2025-07-24 11:50:28', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף דוברות', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 0),
(73, NULL, '2025-07-24 09:00:00', '2025-08-31 09:00:00', 'כעיכעיכ', '2025-173', '321-654', NULL, NULL, '2025-07-24 11:51:55', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(74, NULL, '2025-07-27 09:00:00', '2025-07-31 09:00:00', 'בדיקה', '2025-174', '2025-174', NULL, NULL, '2025-07-27 11:38:47', 0, 1, 'בדיקה 1תנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!בדיקה 1=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(75, NULL, '2025-08-04 03:00:00', '2025-08-31 09:00:00', 'בדיקה', '2025-175', '2025-175', NULL, NULL, '2025-08-04 15:46:22', 0, 1, 'כעיעכתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!כעיעכ=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף התנועה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(76, NULL, '2025-08-04 09:00:00', '2025-08-31 09:00:00', 'sdsdfd', '2025-176', '2025-176', NULL, NULL, '2025-08-04 16:00:45', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(77, NULL, '2025-08-04 09:00:00', '2025-08-31 09:00:00', 'sdsdfd', '2025-177', '2025-177', NULL, NULL, '2025-08-06 06:48:33', 0, 1, 'gfhfghfgתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!gfhfghfg=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(78, NULL, '2025-08-07 09:00:00', '2025-08-21 09:00:00', 'שם המכרז לבדיקה', '2025-178', '110', NULL, NULL, '2025-08-07 05:28:59', 0, 1, '1 תואר ראשון ודברים נוספיםתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!1 תואר ראשון ודברים נוספים=>required!+!+!+!שאלה כן ולא לדוגמא?=>שאלות כן ולא!+!+!+!שאלה כן ולא לדוגמא?=>no', '#$$##$$##$$##$$##$$#', 2, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'יותם סלע', '70% - 80%', 'כפיפות למנהל אגף חינוך', 'דרגת המשרה: 7 - 9 מינהלי', 41, 1),
(79, NULL, '2025-08-07 09:00:00', '2025-08-21 09:00:00', 'שם המכרז לבדיקה שכפול!!', '2025-179', '2025-179', NULL, NULL, '2025-08-07 05:54:28', 0, 1, '1 תואר ראשון ודברים נוספיםתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!1 תואר ראשון ודברים נוספים=>required!+!+!+!שאלה כן ולא לדוגמא?=>שאלות כן ולא!+!+!+!שאלה כן ולא לדוגמא?=>no', '#$$##$$##$$##$$##$$#', 2, 0, NULL, NULL, 4, 4, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'יותם סלע', '70% - 80%', 'כפיפות למנהל אגף חינוך', 'דרגת המשרה: 7 - 9 מינהלי', 41, 1),
(80, NULL, '2025-08-07 09:00:00', '2025-08-31 09:00:00', 'fghgfhfg', '2025-180', '2025-180', NULL, NULL, '2025-08-07 08:47:20', 0, 1, 'fghgfhgfgfתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!fghgfhgfgf=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 1, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(81, NULL, '2025-08-11 09:00:00', '2025-08-31 09:00:00', 'מכרז לבדיקה', '2025-181', '2025-181', NULL, NULL, '2025-08-11 05:30:59', 0, 1, '12 שנות לימודתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!12 שנות לימוד=>required!+!+!+!קורסתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!קורס=>not_required', '#$$##$$##$$##$$##$$#', 2, 0, NULL, 'אגף חדש לבדיקה', 4, 4, 0, '0', 0, NULL, '[]', '0', 0, 1, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגה', 41, 1),
(82, NULL, '2025-08-12 09:00:00', '2025-08-31 09:00:00', 'בדיקה חדשה', '2025-182', '2025-182', NULL, NULL, '2025-08-12 14:36:32', 0, 1, 'השכלהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה=>required!+!+!+!גכעכגעעתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!גכעכגעע=>not_required!+!+!+!גכעכגעכגכג=>שאלות כן ולא!+!+!+!גכעכגעכגכג=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(83, NULL, '2025-08-12 09:00:00', '2025-08-31 09:00:00', 'dfgfd', '2025-183', '2025-183', NULL, NULL, '2025-08-12 14:44:34', 0, 1, 'dgdfgתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!dgdfg=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 3, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(84, NULL, '2025-08-22 09:00:00', '2025-09-30 00:00:00', 'בדיקה חדש', '2025-184', '2025-184', NULL, NULL, '2025-08-22 08:40:29', 0, 1, 'השכלהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה=>required!+!+!+!קורסתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!קורס=>not_required!+!+!+!כן או לא?=>שאלות כן ולא!+!+!+!כן או לא?=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 1, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(85, NULL, '2025-09-03 09:00:00', '2025-09-30 09:00:00', 'מכרז לבדיקה', '2025-185', '2025-185', NULL, NULL, '2025-09-03 08:16:30', 0, 1, '12 שנות לימודתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!12 שנות לימוד=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף דוברות', 4, 2, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(86, NULL, '2025-09-17 03:00:00', '2025-09-18 13:00:00', 'מזכירת מחלקת השירות הפסיכולוגי', '2025-186', '2025-115', NULL, NULL, '2025-09-17 10:34:18', 0, 1, '12 שנות לימודתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!12 שנות לימוד=>required!+!+!+!האם סיימת 12 שנות לימוד?=>שאלות כן ולא!+!+!+!האם סיימת 12 שנות לימוד?=>no', '#$$##$$##$$##$$##$$#', 3, 0, NULL, 'אגף חינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהלת השפ\"ח - רננה שלו', '50%', 'מנהלת השפ\"ח - רננה שלו', 'דרגת המשרה: 6 - 8 מינהלי', 41, 1),
(87, NULL, '2025-09-25 09:00:00', '2025-10-31 09:00:00', 'מכרז לבדיקה', '2025-187', '2025-187', NULL, NULL, '2025-09-25 05:17:19', 0, 1, 'Compulsory educationThreshold conditionsadvantage=>Education and professional requirements!+!+!+!=>required!+!+!+!test1Threshold conditionsadvantage=>Education and professional requirements!+!+!+!=>required!+!+!+!Advantage coursesThreshold conditionsadvantage=>Professional courses and training!+!+!+!=>not_required!+!+!+!Professional experience requiredThreshold conditionsadvantage=>Professional experience!+!+!+!=>required!+!+!+!Additional requirements AdvantageThreshold conditionsadvantageI confirm that I meet these requirements.=>Additional requirements!+!+!+!=>not_required!+!+!+!Management experience requiredThreshold conditionsadvantage=>Management experience!+!+!+!=>not_required', '#$$#test2#$$#test3#$$#רישום פלילי - היעדר הרשעה פלילית והיעדר רישום על עברות מין#$$#ניסיון של ניהול צוות עובדים#$$#test4', 1, 0, NULL, NULL, 4, 0, 1, '22222', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 41, 1),
(88, NULL, '2025-09-28 09:00:00', '2025-09-28 09:00:00', 'מכרז לבדיקה חדשה', '2025-188', '2025-188', NULL, NULL, '2025-09-28 05:19:44', 0, 1, 'השכלה חובהתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!השכלה חובה=>required!+!+!+!קורסים לא חובהתנאי סףיתרון=>קורסים והכשרות מקצועיות!+!+!+!קורסים לא חובה=>not_required!+!+!+!מקצועי חובהתנאי סףיתרון=>ניסיון מקצועי!+!+!+!מקצועי חובה=>required!+!+!+!נוספות לא חובהתנאי סףיתרוןמאשר/ת שהנני עומד/ת בדרישות אלה=>דרישות נוספות!+!+!+!נוספות לא חובה=>not_required!+!+!+!ניהולי חובהתנאי סףיתרון=>ניסיון ניהול!+!+!+!ניהולי חובה=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 1, 'בין 2 ל 3', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 41, 1),
(89, 7, '2025-09-30 09:00:00', '2025-10-30 09:00:00', 'Test from Developer', '2025-189', '2025-189', NULL, NULL, '2025-09-30 09:27:56', 0, 1, 'Education requierementThreshold conditionsadvantage=>Education and professional requirements!+!+!+!=>required!+!+!+!Profetional RequirementThreshold conditionsadvantage=>Professional courses and training!+!+!+!=>required!+!+!+!Professional ExpirenceThreshold conditionsadvantage=>Professional experience!+!+!+!=>required!+!+!+!Additional RequiremntThreshold conditionsadvantageI confirm that I meet these requirements.=>Additional requirements!+!+!+!=>no!+!+!+!Management ExpirenceThreshold conditionsadvantage=>Management experience!+!+!+!=>not_required!+!+!+!Yes And No Question=>Yes and no questions!+!+!+!=>no', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 1, 0, 'Management', 'Scope', 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', 'Job Rank', 42, 1),
(90, 7, '2025-09-30 09:00:00', '2025-09-30 09:00:00', 'Test from Developer', '2025-190', '2025-190', NULL, NULL, '2025-09-30 09:45:26', 0, 1, NULL, '12 שנות לימוד או תעודת בגרות מלאה.#$$#א. קורס לנהגי רכב ציבורי של משרד התחבורה.                        ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$##$$#', 1, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', NULL, 42, 0),
(91, 7, '2025-09-30 09:00:00', '2025-09-30 09:00:00', 'Test from Developer', '2025-191', '2025-191', NULL, NULL, '2025-09-30 10:11:48', 0, 1, NULL, '12 שנות לימוד או תעודת בגרות מלאה.#$$#א. קורס לנהגי רכב ציבורי של משרד התחבורה.                        ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$##$$#', 1, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', NULL, 42, 0),
(92, 7, '2025-09-30 09:00:00', '2025-09-30 09:00:00', 'Test from Developer', '2025-192', '2025-192', NULL, NULL, '2025-09-30 10:18:15', 0, 1, NULL, '12 שנות לימוד או תעודת בגרות מלאה.#$$#א. קורס לנהגי רכב ציבורי של משרד התחבורה.                        ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$##$$#', 3, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 1, NULL, NULL, 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', NULL, 42, 0),
(93, NULL, '2025-10-01 09:00:00', '2025-10-30 09:00:00', 'dfgfd', '2025-193', '2025-193', NULL, NULL, '2025-10-01 08:12:43', 0, 1, 'Professional courses and trainingThreshold conditionsadvantage=>Professional courses and training!+!+!+!=>not_required!+!+!+!Professional experienceThreshold conditionsadvantage=>Professional experience!+!+!+!=>not_required!+!+!+!Additional requirementsThreshold conditionsadvantageI confirm that I meet these requirements.=>Additional requirements!+!+!+!=>not_required!+!+!+!Management experienceThreshold conditionsadvantage=>Management experience!+!+!+!=>not_required!+!+!+!yes=>Yes and no questions!+!+!+!=>no', 'שנות לימוד / תעודת בגרות12#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(94, NULL, '2025-10-02 09:00:00', '2025-10-30 09:00:00', NULL, '2025-194', '2025-194', NULL, NULL, '2025-10-02 12:56:19', 0, 1, 'test1Threshold conditionsadvantage=>Education and professional requirements!+!+!+!=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 0),
(95, NULL, '2025-10-02 09:00:00', '2025-10-31 09:00:00', 'dfgfdgfdgdf', '2025-195', '2025-195', NULL, NULL, '2025-10-02 12:56:47', 0, 1, 'testThreshold conditionsadvantage=>Education and professional requirements!+!+!+!=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(96, NULL, '2025-10-02 09:00:00', '2025-10-31 09:00:00', 'test1test', '2025-196', '2025-196', NULL, NULL, '2025-10-02 12:57:44', 0, 1, 'test1Threshold conditionsadvantage=>Education and professional requirements!+!+!+!=>required', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 41, 1),
(97, NULL, '2025-10-03 09:00:00', '2025-10-15 09:00:00', 'Test from Developer', '2025-197', '2025-197', NULL, NULL, '2025-10-02 21:56:54', 0, 1, 'Test1=>not_required!+!+!+!Test3=>required', 'Test1#$$#Test2#$$#Test3#$$#Test4#$$#Test5#$$#Yes', 1, 0, NULL, 'אגף חדש לבדיקה', 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(98, NULL, '2025-10-03 09:00:00', '2025-10-31 09:00:00', 'test1test1', '2025-198', '2025-198', NULL, NULL, '2025-10-03 09:13:44', 0, 1, 'tes1Threshold conditionsadvantage=>required', 'tes1#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(99, NULL, '2025-10-03 09:00:00', '2025-10-31 09:00:00', 'בדיקה', '2025-199', '2025-199', NULL, NULL, '2025-10-03 09:21:29', 0, 1, 'השכלה חובה=>required!+!+!+!קורסים ניסיון=>not_required!+!+!+!מקצועי חובה=>required!+!+!+!נוספות ניסיון=>not_required', 'השכלה חובה#$$#קורסים ניסיון#$$#מקצועי חובה#$$#נוספות ניסיון#$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(100, NULL, '2025-10-03 09:00:00', '2025-10-15 09:00:00', 'Test from Developer', '2025-200', '2025-200', NULL, NULL, '2025-10-03 17:56:38', 0, 1, 'Test1=>required!+!+!+!Test3=>not_required', '#$$#Test2#$$##$$#Test4#$$#Test5#$$#Test6', 1, 0, NULL, 'אגף חדש לבדיקה', 4, 0, 1, '1200', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(101, NULL, '2025-10-04 09:00:00', '2025-10-15 09:00:00', 'Test from Developer', '2025-201', '2025-201', NULL, NULL, '2025-10-03 18:14:07', 0, 1, 'Test1=>required[doc1]!+!+!+!Test2=>not_required[doc2]!+!+!+!Test3=>not_required[doc3]', '#$$##$$##$$#Test4#$$#Test5#$$#Test6', 1, 0, NULL, 'אגף חדש לבדיקה', 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(102, NULL, '2025-10-04 09:00:00', '2025-10-15 09:00:00', 'Hello Test', '2025-202', '2025-202', NULL, NULL, '2025-10-03 19:07:25', 0, 1, 'Test1=>required[doc1]!+!+!+!test3=>not_required[doc3]', '#$$#test2#$$##$$#Test4#$$#Test5#$$#Test6', 1, 0, NULL, 'אגף חדש לבדיקה', 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(103, NULL, '2025-10-04 09:00:00', '2025-10-15 09:00:00', 'New Development test', '2025-203', '2025-203', NULL, NULL, '2025-10-03 22:57:15', 0, 1, 'Need File!=>not_required[doc1]!+!+!+!Required file=>required[doc3]', '#$$#Test#$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(104, NULL, '2025-10-04 09:00:00', '2025-10-31 09:00:00', 'מכרז נוסף לבדיקה', '2025-204', '2025-204', NULL, NULL, '2025-10-04 10:24:51', 0, 1, 'קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]!+!+!+!ניהולי חובה=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(105, NULL, '2025-10-05 09:00:00', '2025-10-31 09:00:00', 'מכרז חדש לבדיקה', '2025-205', '2025-205', NULL, NULL, '2025-10-05 09:42:36', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]!+!+!+!ניהולי חובה=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(106, NULL, '2025-10-05 09:00:00', '2025-10-31 09:00:00', 'נוסף נוסף', '2025-206', '2025-206', NULL, NULL, '2025-10-05 09:57:33', 0, 1, 'כעיעכי=>required[doc2]!+!+!+!כעיכעיכעיכ=>required[doc3]!+!+!+!כעיכעיכעיע=>required[doc4]!+!+!+!כעיכעיכעי=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(107, NULL, '2025-10-06 09:00:00', '2025-10-31 09:00:00', 'נוסף חדש לבדיקה', '2025-207', '2025-207', NULL, NULL, '2025-10-06 07:44:10', 0, 1, 'קורסים חובה=>required[doc2]!+!+!+!מקצועי יתרון=>not_required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהול יתרון=>not_required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(108, NULL, '2025-10-06 09:00:00', '2025-10-31 09:00:00', 'נוסף חדש יותר', '2025-208', '2025-208', NULL, NULL, '2025-10-06 07:50:34', 0, 1, 'נוספות חובה=>required[doc4]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(109, NULL, '2025-10-07 09:00:00', '2025-10-31 09:00:00', 'בדיקה נוספת', '2025-209', '2025-209', NULL, NULL, '2025-10-07 04:41:56', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!ניהול יתרון=>not_required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(110, NULL, '2025-10-07 09:00:00', '2025-10-15 09:00:00', 'New Development test', '2025-210', '2025-210', NULL, NULL, '2025-10-07 05:58:36', 1, 1, 'Test1Threshold conditionsadvantage=>not_required[doc1]!+!+!+!Test2Threshold conditionsadvantage=>required[doc2]!+!+!+!Test4Threshold conditionsadvantageI confirm that I meet these requirements.=>required[doc4]!+!+!+!Test5Threshold conditionsadvantage=>required[doc5]', '#$$##$$#Test3#$$##$$##$$#yest', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(111, NULL, '2025-10-07 09:00:00', '2025-10-15 09:00:00', 'New Development test', '2025-211', '2025-211', NULL, NULL, '2025-10-07 06:05:54', 0, 1, 'Educational!!=>not_required[doc1]!+!+!+!Additional !!=>required[doc3]!+!+!+!Additional Requirement=>required[doc4]!+!+!+!Expirence Management=>not_required[doc5]', '#$$#Professional !!#$$##$$##$$##$$#tttttt', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(112, NULL, '2025-10-07 09:00:00', '2025-10-31 09:00:00', 'בודק', '2025-212', '2025-212', NULL, NULL, '2025-10-07 14:48:16', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!ניהול יתרון=>not_required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(113, NULL, '2025-10-07 09:00:00', '2025-10-31 09:00:00', 'בודק נוסף', '2025-213', '2025-213', NULL, NULL, '2025-10-07 14:53:03', 0, 1, 'מקצועי חובה=>required[doc2]!+!+!+!נוספות יתרון=>not_required[doc4]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(114, NULL, '2025-10-07 09:00:00', '2025-10-31 09:00:00', 'בודק נוסף וחדש', '2025-214', '2025-214', NULL, NULL, '2025-10-07 14:58:01', 0, 1, 'מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(115, NULL, '2025-10-09 09:00:00', '2025-10-31 09:00:00', 'חדש', '2025-215', '2025-215', NULL, NULL, '2025-10-09 05:48:44', 0, 1, 'ניסיון מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(116, NULL, '2025-10-09 09:00:00', '2025-11-27 00:00:00', 'חדש נוסף', '2025-216', '2025-216', NULL, NULL, '2025-10-09 05:51:55', 0, 1, 'Professional requiredThreshold conditionsadvantage=>required[doc3]!+!+!+!Additional advantageThreshold conditionsadvantageI confirm that I meet these requirements.=>not_required[doc4]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(117, NULL, '2025-11-03 09:00:00', '2025-11-03 09:00:00', NULL, '2025-217', '2025-217', NULL, NULL, '2025-11-03 07:32:28', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 1, NULL, NULL, NULL, NULL, 42, 0),
(118, NULL, '2025-11-04 06:30:00', '2025-11-30 09:00:00', 'מכרז לבדיקה', '2025-218', '2025-218', NULL, NULL, '2025-11-04 06:24:46', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 42, 0),
(119, NULL, '2025-11-04 06:00:00', '2025-12-31 00:00:00', 'מכרז לבדיקה', '2025-219', '2025-219', NULL, NULL, '2025-11-04 06:54:40', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 1, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 42, 1),
(120, NULL, '2025-11-06 09:00:00', '2025-11-17 09:00:00', 'Testing', '2025-220', '2025-220', NULL, NULL, '2025-11-04 13:03:58', 0, 1, NULL, '12 שנות לימוד או תעודת בגרות מלאה.#$$#א. קורס לנהגי רכב ציבורי של משרד התחבורה. ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס..#$$##$$#', 3, 0, NULL, 'אגף התנועה', 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 1, 0, 'manager', 'scope', 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', 'job rank and  ranking', 42, 1);
INSERT INTO `tenders` (`id`, `template_id`, `start_date`, `finish_date`, `tname`, `generated_id`, `tender_number`, `body`, `status`, `created_date`, `stopped`, `deleted`, `conditions`, `qualifications`, `ttype`, `is_exist`, `emails`, `brunch`, `tender_type`, `tender_status`, `has_salary`, `salary`, `additional_salary`, `note`, `job_details`, `functional_level`, `is_test_required`, `is_recommended`, `is_drushim`, `input_manager`, `job_scope`, `subordinations`, `grades_voltage`, `created_by`, `is_protocol`) VALUES
(121, NULL, '2025-11-05 09:00:00', '2025-11-05 09:00:00', 'Faysal Test', '2025-221', '2025-221', NULL, NULL, '2025-11-05 05:34:11', 0, 1, NULL, '12 שנות לימוד או תעודת בגרות מלאה.#$$#א. קורס לנהגי רכב ציבורי של משרד התחבורה. ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.#$$#נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס..#$$##$$#', 2, 0, NULL, 'אגף הנדסה', 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 1, 0, NULL, 'Test Scped', 'למנהל התחבורה, מונחה מקצועית ע\"י קצין בטיחות בתעבורה 5', 'Job Ranking name', 42, 1),
(122, NULL, '2025-11-10 09:00:00', '2025-11-24 09:00:00', 'מכרז לבדיקה', '2025-222', '2025-222', NULL, NULL, '2025-11-10 12:44:06', 0, 1, 'דרישת השכלה=>required[doc1]', '#$$##$$##$$##$$##$$#', 3, 0, NULL, 'אגף החינוך', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 1, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה', 42, 1),
(123, NULL, '2025-11-18 09:00:00', '2025-11-27 09:00:00', 'בדיקה', '2025-223', '2025-223', NULL, NULL, '2025-11-18 09:25:42', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(124, NULL, '2025-11-19 09:00:00', '2025-12-31 00:00:00', 'מכרז לבדיקה', '2025-224', '2025-224', NULL, NULL, '2025-11-19 11:37:51', 0, 1, '12 שנות לימוד=>required[doc1]!+!+!+!שאלת כן ולא?=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'מחלקת הון אנושי', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגה', 42, 1),
(125, NULL, '2025-12-04 09:00:00', '2025-12-10 00:00:00', 'מנהל ישובי למניעת אלימות סמים ואלכוהול', '2025-225', '2025-225', NULL, NULL, '2025-12-04 10:43:23', 0, 0, 'תואר ראשון ממוסד אקדמי / השכלה חלופית בהתאם לנוסח המכרז=>required[doc1]!+!+!+!ניסיון בהובלת פרויקטים חברתיים חינוכיים או בעבודה קהילתית. עבור בעל תואר אקדמי או השכלה תורנית: 1 שנת ניסיון. עבור הנדסאי רשום: 2 שנות ניסיון. עבור טכנאי רשום: 3 שנות ניסיון=>not_required[doc3]!+!+!+!שנה אחת לפחות בניהול של שני עובדים מקצועיים בכפיפות ישירה.=>required[doc5]!+!+!+!האם הינך בעל תואר ראשון?=>no[doc6]!+!+!+!האם יש לך ניסיון בניהול 2 עובדים במשך שנה?=>no[doc6]!+!+!+!האם הינך בעל ניסיון מקצועי בהובלת פרויקטים קהילתיים חברתיים או בעבודה קהילתית?=>no[doc6]', '#$$##$$##$$##$$##$$#', 3, 0, NULL, 'מחלקת קהילה', 4, 0, 1, '7500-8500 ברוטו', 0, NULL, NULL, '0', 1, 0, 0, 'רעות רוזנפלד', '75%-100%', 'מנהלת מחלקת קהילה', 'חינוך חברה ונוער', 41, 1),
(126, NULL, '2025-12-09 09:00:00', '2025-12-31 09:00:00', 'בדיקה', '2025-226', '2025-226', NULL, NULL, '2025-12-09 08:42:29', 0, 1, 'Is it yes or no?Threshold conditionsAdvantage=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(127, NULL, '2025-12-10 09:00:00', '2025-12-31 00:00:00', 'מנהל תוכנית מחוברים- בדיקה', '2025-227', '2025-227', NULL, NULL, '2025-12-10 09:37:43', 0, 1, 'שנות לימוד / תעודת בגרות12=>required[doc1]!+!+!+!בעלי ניסיון עם תכניות לנוער עולה, בעדיפות תכניות לנוער עולה=>not_required[doc3]!+!+!+!הכרות/ ניסיון עם תכניות לנוער עולה=>not_required[doc3]!+!+!+!בעלי מכוונות חברתית גבוהה=>not_required[doc4]!+!+!+!יכולת לעבודה בצוות מונחה.=>not_required[doc4]!+!+!+!עבודה בשעות לא שגרתיות במוקדי רחוב שונים.=>not_required[doc4]!+!+!+!עדיפות לבעלי ניסיון ולימודים רלוונטיים, ניסיון בהדרכת נוער עולה ו/או נוער מתגודד ו/או בתפקידי פיקודי.=>not_required[doc4]!+!+!+!מוכנות לעבודה בשעות עבודה גמישות וסופי שבוע=>not_required[doc4]', '#$$##$$##$$##$$##$$#', 3, 0, NULL, 'מחלקת קהילה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'רעות רוזנפלד', '75%-100%', 'מנהלת מחלקת קהילה', 'חינוך נוער חברה וקהילה', 41, 1),
(128, NULL, '2025-12-10 09:00:00', '2025-12-15 23:30:00', 'מדריך תוכנית מחוברים- בדיקה', '2025-228', '2025-228', NULL, NULL, '2025-12-10 09:46:13', 0, 1, 'שנות לימוד / תעודת בגרות12=>required[doc1]!+!+!+!בעלי ניסיון עם תכניות לנוער עולה, בעדיפות תכניות לנוער עולה=>not_required[doc3]!+!+!+!הכרות/ ניסיון עם תכניות לנוער עולה=>not_required[doc3]!+!+!+!בעלי מכוונות חברתית גבוהה=>not_required[doc4]!+!+!+!יכולת לעבודה בצוות מונחה.=>not_required[doc4]!+!+!+!עבודה בשעות לא שגרתיות במוקדי רחוב שונים.=>not_required[doc4]!+!+!+!עדיפות לבעלי ניסיון ולימודים רלוונטיים, ניסיון בהדרכת נוער עולה ו/או נוער מתגודד ו/או בתפקידי פיקודי.=>not_required[doc4]!+!+!+!מוכנות לעבודה בשעות עבודה גמישות וסופי שבוע=>not_required[doc4]', 'שנות לימוד / תעודת בגרות12#$$##$$##$$##$$##$$#', 3, 0, NULL, 'מחלקת קהילה', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'רעות רוזנפלד', '60%-75%', 'מנהלת מחלקת קהילה', 'חינוך נוער חברה וקהילה', 41, 1),
(129, NULL, '2025-12-25 09:00:00', '2026-01-31 00:00:00', 'בדיקה', '2025-229', '2025-229', NULL, NULL, '2025-12-25 14:25:10', 0, 1, NULL, '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(130, NULL, '2025-12-29 09:00:00', '2026-01-29 09:00:00', 'נוסף לבדיקה', '2025-230', '2025-230', NULL, NULL, '2025-12-29 06:51:33', 0, 1, 'Yes or no addedThreshold conditionsAdvantage=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(131, NULL, '2026-01-04 09:00:00', '2026-01-26 09:00:00', 'מכרז חדש ונוסף', '2025-231', '2025-231', NULL, NULL, '2026-01-04 14:40:24', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!ניסיון מקצועי חובה=>required[doc3]!+!+!+!שאלות כן או לא=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה', 42, 1),
(132, NULL, '2026-01-06 09:00:00', '2026-01-28 09:00:00', 'חדש נוסף לבדיקה', '2026-232', '2026-232', NULL, NULL, '2026-01-06 06:40:14', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]!+!+!+!ניהולי חובה=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(133, NULL, '2026-01-07 09:00:00', '2026-01-30 09:00:00', 'נוסף', '2026-233', '2026-233', NULL, NULL, '2026-01-07 06:33:33', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!מקצועי חובה=>required[doc3]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(134, NULL, '2026-01-07 09:00:00', '2026-01-31 09:00:00', 'חדש נוסף', '2026-234', '2026-234', NULL, NULL, '2026-01-07 13:01:26', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!כן או לא=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(135, NULL, '2026-01-07 09:00:00', '2026-01-27 09:00:00', 'עוד אחד', '2026-235', '2026-235', NULL, NULL, '2026-01-07 14:06:07', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהולי חובה=>required[doc5]', '#$$##$$##$$##$$##$$#כן או לא', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(136, NULL, '2026-01-07 09:00:00', '2026-01-28 09:00:00', 'עוד אחד נוסף', '2026-236', '2026-236', NULL, NULL, '2026-01-07 14:10:44', 0, 1, 'השכלה חובה=>required[doc1]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(137, NULL, '2026-01-08 09:00:00', '2026-01-31 09:00:00', 'בדיקה חדשה', '2026-237', '2026-237', NULL, NULL, '2026-01-08 07:43:24', 0, 0, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]!+!+!+!ניהולי חובה=>required[doc5]!+!+!+!כן או לא?=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(138, NULL, '2026-01-20 09:00:00', '2026-01-31 09:00:00', 'מכרז לבדיקה', '2026-238', '2026-238', NULL, NULL, '2026-01-20 09:09:58', 0, 1, '12 שנות לימוד=>required[doc1]!+!+!+!תוכן מסמך=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!מקצועי חובה שני=>required[doc3]!+!+!+!שאלות כן ולא?=>no[doc6]', '#$$##$$##$$##$$##$$#', 3, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת משרה', 42, 1),
(139, NULL, '2026-01-20 09:00:00', '2026-01-30 23:30:00', 'רבש\"ץ', '2026-239', '2026-239', NULL, NULL, '2026-01-20 09:52:52', 0, 1, 'שנות לימוד / תעודת בגרות12=>required[doc1]!+!+!+!רובאי 03 ומעלה=>not_required[doc4]!+!+!+!פרופיל 72 ומעלה=>not_required[doc4]!+!+!+!ניסיון של פיקוד בצבא=>not_required[doc5]', '#$$##$$##$$##$$##$$#', 2, 0, NULL, 'מחלקת ביטחון', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 1, 'משה בוטביה', '100%', 'מנהל מחלקת ביטחון', NULL, 41, 1),
(140, NULL, '2026-01-20 09:00:00', '2026-01-30 23:30:00', 'רבש\"ץ 2', '2026-240', '2026-240', NULL, NULL, '2026-01-20 13:54:31', 0, 1, 'שנות לימוד / תעודת בגרות12=>required[doc1]!+!+!+!רובאי 03 ומעלה=>not_required[doc4]!+!+!+!פרופיל 72 ומעלה=>not_required[doc4]!+!+!+!ניסיון של פיקוד בצבא=>not_required[doc5]', '#$$##$$##$$##$$##$$#', 2, 0, NULL, 'מחלקת ביטחון', 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, 'משה בוטביה', '100%', 'מנהל מחלקת ביטחון', NULL, 42, 1),
(141, NULL, '2026-01-08 09:00:00', '2026-01-31 09:00:00', 'בדיקה חדשה 2', '2026-241', '2026-241', NULL, NULL, '2026-01-20 13:59:23', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]!+!+!+!ניהולי חובה=>required[doc5]!+!+!+!כן או לא?=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(142, NULL, '2026-01-20 09:00:00', '2026-01-31 09:00:00', 'כגעכגעגכ', '2026-242', '2026-242', NULL, NULL, '2026-01-20 14:02:10', 0, 1, 'השכלה חובה=>required[doc1]!+!+!+!קורסים חובה=>required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהולי חובה=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(143, NULL, '2026-01-20 09:00:00', '2026-01-31 09:00:00', 'גדכגדכגד', '2026-243', '2026-243', NULL, NULL, '2026-01-20 14:05:18', 0, 1, 'השכלה חבוה=>required[doc1]!+!+!+!מקצועי יתרון=>not_required[doc3]!+!+!+!נוספות יתרון=>not_required[doc4]!+!+!+!ניהול חובה=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(144, NULL, '2026-01-21 09:00:00', '2026-01-31 09:00:00', 'בדיקה', '2026-244', '2026-244', NULL, NULL, '2026-01-21 11:19:10', 0, 0, 'שנות לימוד / תעודת בגרות12=>required[doc1]!+!+!+!כן או לא?=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(145, NULL, '2026-01-22 09:00:00', '2026-01-31 09:00:00', 'גדכגדכדג', '2026-245', '2026-245', NULL, NULL, '2026-01-22 14:06:55', 0, 0, 'השכלה חובה=>required[doc1]!+!+!+!קורסים חובה=>required[doc2]!+!+!+!מקצועי חובה=>required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהולי חובה=>required[doc5]!+!+!+!כן או לא?=>no[doc6]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, 'אגף החינוך', 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, 'מנהל', 'היקף', 'כפיפות', 'דרגת המשרה ודירוגה', 42, 1),
(146, NULL, '2026-01-26 09:00:00', '2026-01-31 09:00:00', 'בדיקה עם יתרון', '2026-246', '2026-246', NULL, NULL, '2026-01-26 13:09:04', 0, 0, 'השכלה יתרון=>not_required[doc1]!+!+!+!קורסים חובה=>required[doc2]!+!+!+!מקצועי יתרון=>not_required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהול יתרון=>not_required[doc5]', '#$$##$$##$$##$$##$$#כן או לא?', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, NULL, '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(147, NULL, '2026-01-26 09:00:00', '2026-01-31 09:00:00', 'בדיקה נוספת עם יתרון', '2026-247', '2026-247', NULL, NULL, '2026-01-26 13:22:31', 0, 0, 'השכלה יתרון=>not_required[doc1]!+!+!+!קורסים חובה=>required[doc2]!+!+!+!מקצועי יתרון=>not_required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהולי יתרון=>not_required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(148, NULL, '2026-01-26 09:00:00', '2026-01-31 09:00:00', 'בדיקה עם מבחן', '2026-248', '2026-248', NULL, NULL, '2026-01-26 13:36:07', 0, 0, 'השכלה חובה=>required[doc1]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 1, 0, 0, NULL, NULL, NULL, NULL, 42, 1),
(149, NULL, '2026-01-27 09:00:00', '2026-01-27 09:00:00', NULL, '2026-249', '2026-249', NULL, NULL, '2026-01-27 16:13:45', 0, 1, 'שנות לימוד / תעודת בגרות12=>required[doc1]', '#$$#adsfdas#$$#ניסיון של#$$#רישום פלילי - היעדר הרשעה פלילית והיעדר רישום על עברות מין#$$#ניסיון של ניהול צוות עובדים#$$#sadfsaasd', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 47, 1),
(150, NULL, '2026-01-28 09:00:00', '2026-02-28 09:00:00', 'בדיקה חדשה יום רביעי', '2026-250', '2026-250', NULL, NULL, '2026-01-28 07:17:08', 0, 0, 'השכלה חובה=>required[doc1]!+!+!+!קורסים יתרון=>not_required[doc2]!+!+!+!מקצועי יתרון=>not_required[doc3]!+!+!+!נוספות חובה=>required[doc4]!+!+!+!ניהולי חובה=>required[doc5]', '#$$##$$##$$##$$##$$#', 1, 0, NULL, NULL, 4, 0, 0, '0', 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 42, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tenders_active_files`
-- (See below for the actual view)
--
CREATE TABLE `tenders_active_files` (
`id` int(11)
,`tender_id` int(11)
,`url` text
,`file_name` text
,`file_type` text
,`status` int(11)
,`created_at` timestamp
,`updated_at` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tenders_applications`
-- (See below for the actual view)
--
CREATE TABLE `tenders_applications` (
`decision_6` bigint(21)
,`decision_7` bigint(21)
,`decision_8` bigint(21)
,`decision_9` bigint(21)
,`decision_10` bigint(21)
,`generated_id` varchar(10)
,`start_date` datetime
,`finish_date` datetime
,`tname` varchar(200)
,`status` int(11)
,`is_test_required` tinyint(4)
,`created_date` timestamp
,`crdate` timestamp
,`id` int(11)
,`id_tz` varchar(200)
,`tenderval` varchar(200)
,`p1_id` int(11)
,`p2_id` int(11)
,`p3_id` int(11)
,`tender_number` varchar(255)
,`p5_id` int(11)
,`decision_1` int(11)
,`decision_1_a` int(11)
,`decision_1_b` int(11)
,`decision_1_comment` varchar(500)
,`decision_2` int(11)
,`decision_2_comment` varchar(500)
,`decision_3` int(11)
,`decision_3_a` int(11)
,`decision_3_b` int(11)
,`test_result` int(11)
,`is_star` tinyint(1)
,`decision_3_comment` varchar(500)
,`decision_4` int(11)
,`decision_4_comment` varchar(500)
,`decision_committee` int(11)
,`decision_5` int(11)
,`decision_rejectedbyuser` int(11)
,`email` varchar(200)
,`rejected` int(11)
,`applicant_name` varchar(100)
,`generated_dec_id` int(11)
,`invitation_rejected_by_user` tinyint(4)
,`app_status` varchar(26)
,`app_statusnum` int(2)
);

-- --------------------------------------------------------

--
-- Table structure for table `tenders_files`
--

CREATE TABLE `tenders_files` (
  `id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `file_name` text NOT NULL,
  `file_type` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tenders_files`
--

INSERT INTO `tenders_files` (`id`, `tender_id`, `url`, `file_name`, `file_type`, `status`, `created_at`, `updated_at`) VALUES
(2, 71, 'upload/מנהל רווחה חינוכית + סגן מנהל אגף.pdf', 'מנהל רווחה חינוכית + סגן מנהל אגף.pdf', 'application/pdf', 1, '2025-07-27 10:54:30', '2025-07-27 13:54:30');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tenders_stat`
-- (See below for the actual view)
--
CREATE TABLE `tenders_stat` (
`id` int(11)
,`start_date` datetime
,`has_salary` tinyint(4)
,`is_test_required` tinyint(4)
,`is_recommended` tinyint(4)
,`is_drushim` tinyint(4)
,`ttype` int(11)
,`brunch` varchar(200)
,`created_by` int(11)
,`job_details` longtext
,`functional_level` varchar(255)
,`input_manager` varchar(255)
,`tender_number` varchar(255)
,`job_scope` varchar(255)
,`subordinations` varchar(255)
,`grades_voltage` varchar(255)
,`finish_date` datetime
,`tname` varchar(200)
,`template_id` int(255)
,`generated_id` varchar(10)
,`status` int(11)
,`created_date` timestamp
,`stopped` int(11)
,`deleted` int(11)
,`conditions` text
,`tender_type` int(11)
,`tender_status` int(11)
,`ccount` bigint(21)
,`pendingcount` bigint(21)
,`accepted` bigint(21)
,`trejected` bigint(21)
,`tender_file_name` text
,`tender_file_url` text
);

-- --------------------------------------------------------

--
-- Table structure for table `tender_decision`
--

CREATE TABLE `tender_decision` (
  `id` int(11) NOT NULL,
  `decision_on` longtext DEFAULT NULL,
  `suitable_pos` longtext DEFAULT NULL,
  `proposed_pos` longtext DEFAULT NULL,
  `second_pos` longtext DEFAULT NULL,
  `third_pos` longtext DEFAULT NULL,
  `title_pos` varchar(150) NOT NULL,
  `tender_id` varchar(255) NOT NULL,
  `select_dec` varchar(255) DEFAULT NULL,
  `family_relation` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tender_decision`
--

INSERT INTO `tender_decision` (`id`, `decision_on`, `suitable_pos`, `proposed_pos`, `second_pos`, `third_pos`, `title_pos`, `tender_id`, `select_dec`, `family_relation`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 'dsfdsfdsfdsfdsdsfds', '2025-185', '[]', NULL),
(2, 'test', NULL, 'test', 'test', NULL, 'test', '2025-184', '[\"1\",\"2\",\"3\"]', NULL),
(3, NULL, NULL, NULL, NULL, NULL, 'egrthyjui', '2025-187', '[]', NULL),
(4, 'test', NULL, 'test', 'test', 'test', 'test', '2026-234', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 'no'),
(5, NULL, NULL, NULL, 'sdfdsfdsfsd', 'עגכעכגעגכע', 'כגעכגעכגעג', '2026-237', '[\"5\"]', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tender_protocol_maker`
--

CREATE TABLE `tender_protocol_maker` (
  `id` int(11) NOT NULL,
  `tender_id` varchar(255) NOT NULL,
  `decision_maker` longtext NOT NULL,
  `signature` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tender_protocol_maker`
--

INSERT INTO `tender_protocol_maker` (`id`, `tender_id`, `decision_maker`, `signature`) VALUES
(1, '2025-145', 'חבר וועדה ראשון - גזרבר', NULL),
(2, '2025-164', 'חבר וועדה', NULL),
(3, '2025-167', 'חבר וועדה לבדיקה', NULL),
(4, '2025-170', 'חבר ועדה ראושן', NULL),
(5, '2025-171', 'מנכ\"ל המועצה - מר אביב דורות בן ארי', NULL),
(6, '2025-171', 'יועצת לקידום מעמד האישה - גב\' רעות רוזנפלד - צופה', NULL),
(7, '2025-171', 'מנהל אגף חינוך - מר יותם סלע', NULL),
(8, '2025-171', 'נציג ציבור - מר שולי שמעון', NULL),
(9, '2025-171', 'נציגת ועד עובדים - גב\' אילנה אברהמי', NULL),
(10, '2025-178', 'שם חבר ועדה ראשון', NULL),
(11, '2025-178', 'חבר ועדה יוסי', NULL),
(12, '2025-178', 'חבר ועדה אבי', NULL),
(13, '2025-181', 'חבר ועדה לבדיקה', NULL),
(14, '2025-184', 'test', NULL),
(15, '2025-185', 'test person', 'data:image/png;base64,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'),
(16, '2025-187', 'חבר ועדה ראשון לבדיקה', NULL),
(17, '2025-188', 'שם חבר הוועדה', NULL),
(18, '2025-205', 'ק׳רק׳רק׳רק׳', NULL),
(19, '2025-219', 'jcr ugsv kcshev', NULL),
(20, '2025-222', 'חבר וועדה ראשון לבדיקה', NULL),
(21, '2025-225', 'אילנה אברהמי - נציגת ועד עובדים', NULL),
(22, '2025-225', 'מור נחמיאס - מנהלת הון אנושי', NULL),
(23, '2025-225', 'רעות רוזנפלד - מנהלת תחום קהילה', NULL),
(24, '2025-225', 'שולי שמעון - נציג ציבור', NULL),
(25, '2026-238', 'חבר ועדה ראשון', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_user`
--

CREATE TABLE `tender_user` (
  `id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tender_user`
--

INSERT INTO `tender_user` (`id`, `tender_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 20, 34, '2024-12-28 05:47:26', NULL),
(2, 71, 41, '2025-07-23 13:36:26', NULL),
(3, 91, 45, '2025-09-30 10:11:48', NULL),
(4, 92, 45, '2025-09-30 10:18:15', NULL),
(5, 120, 42, '2025-11-04 13:03:58', NULL),
(6, 121, 42, '2025-11-05 05:34:11', NULL),
(7, 125, 43, '2025-12-04 10:43:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `role` varchar(110) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  `encryption_key_slot` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `encryption_key_slot`) VALUES
(41, 'eyJpdiI6Ii93TlJleFNBNTZESUhSUWp0MDNLRlE9PSIsInZhbHVlIjoiMURWdG1tVXR1ZStxNnk1UGt2MjN0aW5STG5BQjhZc0JkYzViaEdraEtrMD0iLCJtYWMiOiI1ZGExY2E5ZjI0M2NmN2Y0MzA1MjUzYWFmYzVhNGRjN2Q1OWE5ZWIwN2Q5ODBmNTdiNDYwNTU5OTI1NGY0Mzg4IiwidGFnIjoiIn0=', 'eyJpdiI6InRkNWh3MGhaRjNqMlZvbEdJSUdNNnc9PSIsInZhbHVlIjoiWXA3SnFiRzNFVytDRVVzTlZwNWxIOXVQOU4yRXFvUUdPRlpjbXpxemJTUT0iLCJtYWMiOiJkMWNlZGVhZTM5Y2Y1NmVlNWQ5NDM5ZjA0YWI5OTkwZjYyNzE0N2QwM2I2ZTRmNGIwNTcxYWQzOTAyNDFhODFhIiwidGFnIjoiIn0=', '1,2,3,4,5,6,7', NULL, '$2y$12$KGMMZQKsol3LEgDIjpUiZO3c1H0j08gnQ4cwVKfy6FuJrjrNOtM4i', NULL, '2025-07-14 23:41:15', '2025-07-14 23:41:15', '1', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus='),
(42, 'eyJpdiI6ImR6UDFabGVOd2toWU1wVFZSU255V1E9PSIsInZhbHVlIjoiYmE5ZUFxZnYyYkc1U0FmTXVUTjV5UT09IiwibWFjIjoiMTE2YzQ4MjA4ZjhlOGM0YjA1MTQ5MmVjOWVlYjFhMjBhNWM3ZDUwMDZmNDIxM2U3MGU4ZmQ1MGIwMjE4M2JmNiIsInRhZyI6IiJ9', 'eyJpdiI6ImtTTnZEelRFUE45eEg1TUtnWmdxeEE9PSIsInZhbHVlIjoiNkV5LzlEQWY2R2puTXEvV0d5MU1KWUZSdER2Y2lvQVVYVzhmdytzczRoRT0iLCJtYWMiOiJmNGYzNTE5YjQ1YjRjZDM2ODdjZTFhMWQ2NDAzOGE3ZmVjNmFjYzIwODM3YWFjMTdiODEyNmI0ZTNjOTM4Yjg3IiwidGFnIjoiIn0=', '1,2,3,4,5,6,7', NULL, '$2y$12$JvoVSWZtk2kKrlAI4XDTGOzrz.70qm5fb17kbAaMLE6450CWkhviK', NULL, '2025-08-07 08:55:07', '2025-08-07 08:55:07', '1', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus='),
(43, 'eyJpdiI6IjZjZFJuUG5JSEduUmEwSGlVNVJQUUE9PSIsInZhbHVlIjoiVy8zd1dnRkxDNVdFNERXVUllcHJZVFVCTmQ3T0FYQTdkTTJzSEZENEVKRT0iLCJtYWMiOiI3MGJmZjJmNjFkNTk4MDUzYzM0OWUzOTg5NWZlMDcyNTFjOWRhODQ5ZjI0MzkzODljZDc4MzI5MmIyNjA4Y2NkIiwidGFnIjoiIn0=', 'eyJpdiI6IjBDNzIyWjRxVHFvYkRLak1MakZxcnc9PSIsInZhbHVlIjoidDB1NDdHZjZPUlRJSkt2bSt2d1BWeFUyQXpVN2x6OUovOXZEcnB5elBkST0iLCJtYWMiOiJlYmRkZWZhMjNkOGQyN2YxMDNhMDhlNTViNmU2NGU5OWMyY2E2ZWNhZDY0MTIxYzA1ZDFlMTU2NDhmMmVjNzAxIiwidGFnIjoiIn0=', '1,2,3,4,5,6,7', NULL, '$2y$12$cHJtexANhh6LYkQpTbJo3OFtiVSJcn4/LLG9si8LatJNXHql9oZ.S', NULL, '2025-09-11 01:10:11', '2026-01-27 14:28:20', '1', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus='),
(44, 'eyJpdiI6IktoY3Urd2paNm5jYVdYdTJ2SFlPdGc9PSIsInZhbHVlIjoicFdWTlQ4YWtpYnUvMUZsSnM2aVBhcTI3NGRoVmx5M0JQWjArRlZFdExMaz0iLCJtYWMiOiIwYmQzYjg2NzM3NzgyYmMxM2VhOWYwZWZlZTBlZjhlMTAxODA5YTI2ODQ1MTVmZDQ0ZWJkY2U5MzU0OWYzYTcyIiwidGFnIjoiIn0=', 'eyJpdiI6ImZvVlRrWUhjU0FodWVQRy9INVJ4QUE9PSIsInZhbHVlIjoieHkyR0dON3poWWpTZXVXYmhqSnFjNWFnWUdXNUNEWTZqNVUzdGhZV01Idz0iLCJtYWMiOiJkMTFiNWQ3NGYyODRmOTA5MGJjNjMzZjMzM2Y2MjljYzhjNjA3ZGVkNzJlZDAwYjQyODI5N2JiNGViOGE0YmRhIiwidGFnIjoiIn0=', '1,2,3,4,5,6,7', NULL, '$2y$12$xEtUC70wzh/RM/JNS4TIJena4QOGRU6oAHy02Phm.ni1U6xVJSJTi', NULL, '2025-09-11 01:12:11', '2025-09-11 01:12:11', '1', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus='),
(47, 'eyJpdiI6ImJERjc4RjVlem55cmFoVXlDbXJCdXc9PSIsInZhbHVlIjoib1MxN1RmbENld3A2SjMxSmNaQTd0Zz09IiwibWFjIjoiZWVmZjdkMjgwZGZkMDI0NWUxODhlMTQ1YWJkZjYwNGYyNDViOGVmNGMxNGFkZjQ2OGVhNDljODI3OWJlZDhiNiIsInRhZyI6IiJ9', 'eyJpdiI6ImxTbCtXRk9JcU50ZUNHTkdhcXVObEE9PSIsInZhbHVlIjoiRmxHVjBoemJtZHJ3R3Yya0tsdm8wNHhjaW1jYkp1UTg3U2FFWm9nMHg1UT0iLCJtYWMiOiIzYTkyNGM3MmZiMDMwODY4MjlhYjA2MjQwZTVjNWFkOGZjMTNkMWQ0OGMyZTkzZTA3MzAyZDdkMmMwN2M2ZDA2IiwidGFnIjoiIn0=', '1,2,3,4,5,6,7', NULL, '$2y$12$JvoVSWZtk2kKrlAI4XDTGOzrz.70qm5fb17kbAaMLE6450CWkhviK', NULL, '2025-08-07 08:55:07', '2026-01-27 14:28:20', '1', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus='),
(48, 'eyJpdiI6InRmZEtEWDFpZU42YmF0THFhNGd1WHc9PSIsInZhbHVlIjoiWmxoOHdoM1E1R2VJbSs5RFRERmZxQT09IiwibWFjIjoiNjNhYTkwMGU1NDE2NDUwYWM5ZDNkZGNkMDRmN2Q4NTQ0ZDQ5YmViOTNhNWMwMGFmYzE4OThjNWY2Njc3OGI2OSIsInRhZyI6IiJ9', 'eyJpdiI6IlR0S1FhMmJQZW5GcENVeUxmd01YUGc9PSIsInZhbHVlIjoib21iZTgvbGxJempZcTFqNFZsN3hSK1NWSldQTE9BL0ZrRVhldTZiTzFaOD0iLCJtYWMiOiI0ZjMzY2UxNmFlM2NiNWIyYWU1YTg5ZjhkMGZiYTIzM2UxZDQ1MzNkMWI2NmIzMzUyMTc0YzFmZmM4ZTk5MTgwIiwidGFnIjoiIn0=', '1,2,3,4,5,6,7', NULL, '$2y$12$JvoVSWZtk2kKrlAI4XDTGOzrz.70qm5fb17kbAaMLE6450CWkhviK', NULL, '2026-01-22 01:44:22', '2026-01-22 01:44:22', '1', 'base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=');

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

CREATE TABLE `users_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_meta`
--

INSERT INTO `users_meta` (`id`, `user_id`, `meta_name`, `meta_value`) VALUES
(198, 28, 'department', 'education'),
(199, 28, 'user_role', 'משאבי אנוש'),
(200, 29, 'department', 'education'),
(201, 29, 'user_role', 'user'),
(202, 30, 'department', 'education'),
(203, 30, 'user_role', '1,2,3,4,5,6,7,8'),
(204, 31, 'department', 'education'),
(205, 31, 'user_role', 'new1'),
(206, 32, 'department', 'education'),
(207, 32, 'user_role', 'system user'),
(208, 33, 'department', 'education'),
(209, 33, 'user_role', '1,2,3,4,5,6,7,8'),
(210, 34, 'department', 'education'),
(211, 34, 'user_role', 'חדש'),
(212, 35, 'department', 'education'),
(213, 35, 'user_role', 'משאבי אנוש'),
(214, 36, 'department', 'education'),
(215, 36, 'user_role', 'משאבי אנוש'),
(216, 37, 'department', 'education'),
(217, 37, 'user_role', 'משאבי אנוש'),
(218, 38, 'department', 'education'),
(219, 38, 'user_role', 'משאבי אנוש'),
(220, 39, 'department', 'education'),
(221, 39, 'user_role', 'משאבי אנוש'),
(222, 40, 'department', 'education'),
(223, 40, 'user_role', 'בדיקה'),
(224, 41, 'department', 'education'),
(225, 41, 'user_role', 'משאבי אנוש'),
(226, 42, 'department', 'education'),
(227, 42, 'user_role', 'בודק'),
(228, 43, 'department', 'education'),
(229, 43, 'user_role', 'משאבי אנוש'),
(230, 44, 'department', 'education'),
(231, 44, 'user_role', 'משאבי אנוש'),
(232, 45, 'user_role', 'משאבי אנוש');

-- --------------------------------------------------------

--
-- Table structure for table `user_decisions`
--

CREATE TABLE `user_decisions` (
  `id` int(11) NOT NULL,
  `decisionId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tenders`
--

CREATE TABLE `user_tenders` (
  `id` int(11) NOT NULL,
  `tenderId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_tenders`
--

INSERT INTO `user_tenders` (`id`, `tenderId`, `userId`) VALUES
(1, 20, 34),
(2, 71, 41),
(3, 91, 45),
(4, 92, 45),
(5, 120, 42),
(6, 121, 42),
(7, 125, 43);

-- --------------------------------------------------------

--
-- Stand-in structure for view `www`
-- (See below for the actual view)
--
CREATE TABLE `www` (
`id` int(11)
,`tenderval` varchar(200)
,`p1_id` int(11)
,`p2_id` int(11)
,`p3_id` int(11)
,`p5_id` int(11)
,`decision_1` int(11)
,`decision_1_comment` varchar(500)
,`decision_2` int(11)
,`decision_2_comment` varchar(500)
,`decision_3` int(11)
,`decision_3_comment` varchar(500)
,`decision_4` int(11)
,`decision_4_comment` varchar(500)
,`decision_committee` int(11)
,`email` varchar(200)
,`rejected` int(11)
,`applicant_name` varchar(100)
,`generated_dec_id` int(11)
,`id_tz` varchar(200)
,`crdate` timestamp
,`decision_5` int(11)
,`decision_6` bigint(21)
,`decision_7` bigint(21)
,`decision_8` bigint(21)
,`decision_rejectedbyuser` int(11)
,`status` varchar(26)
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_file`
--
ALTER TABLE `apps_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_id` (`app_id`);

--
-- Indexes for table `apps_logs`
--
ALTER TABLE `apps_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_meta`
--
ALTER TABLE `apps_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_id` (`app_id`);

--
-- Indexes for table `app_decisions`
--
ALTER TABLE `app_decisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_codes`
--
ALTER TABLE `otp_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otp_codes_user_id_purpose_index` (`user_id`,`purpose`),
  ADD KEY `otp_codes_email_otp_code_index` (`email`,`otp_code`),
  ADD KEY `otp_codes_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenders_generated_id_uindex` (`generated_id`),
  ADD KEY `generated_id` (`generated_id`),
  ADD KEY `generated_id_2` (`generated_id`);

--
-- Indexes for table `tenders_files`
--
ALTER TABLE `tenders_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_decision`
--
ALTER TABLE `tender_decision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_protocol_maker`
--
ALTER TABLE `tender_protocol_maker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_user`
--
ALTER TABLE `tender_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_decisions`
--
ALTER TABLE `user_decisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tenders`
--
ALTER TABLE `user_tenders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=398;

--
-- AUTO_INCREMENT for table `apps_file`
--
ALTER TABLE `apps_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2605;

--
-- AUTO_INCREMENT for table `apps_logs`
--
ALTER TABLE `apps_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2338;

--
-- AUTO_INCREMENT for table `apps_meta`
--
ALTER TABLE `apps_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2231;

--
-- AUTO_INCREMENT for table `app_decisions`
--
ALTER TABLE `app_decisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=399;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `otp_codes`
--
ALTER TABLE `otp_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `tenders_files`
--
ALTER TABLE `tenders_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tender_decision`
--
ALTER TABLE `tender_decision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tender_protocol_maker`
--
ALTER TABLE `tender_protocol_maker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tender_user`
--
ALTER TABLE `tender_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `user_decisions`
--
ALTER TABLE `user_decisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tenders`
--
ALTER TABLE `user_tenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- --------------------------------------------------------

--
-- Structure for view `app_accepted`
--
DROP TABLE IF EXISTS `app_accepted`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_accepted`  AS SELECT count(0) AS `accepted`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE `app_decisions`.`p5_id` <> 0 AND `app_decisions`.`decision_1` * `app_decisions`.`decision_3` <> 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `app_count_pending`
--
DROP TABLE IF EXISTS `app_count_pending`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_count_pending`  AS SELECT count(0) AS `pendingcount`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE `app_decisions`.`p1_id` * `app_decisions`.`p2_id` * `app_decisions`.`p3_id` <> 0 AND `app_decisions`.`decision_1` * `app_decisions`.`decision_2` * `app_decisions`.`decision_3` * `app_decisions`.`decision_4` = 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `app_count_val`
--
DROP TABLE IF EXISTS `app_count_val`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_count_val`  AS SELECT count(0) AS `ccount`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE (`app_decisions`.`p1_id` * `app_decisions`.`p2_id` * `app_decisions`.`p3_id` OR `app_decisions`.`p5_id` <> 0) <> 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `app_decisions_ext`
--
DROP TABLE IF EXISTS `app_decisions_ext`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_decisions_ext`  AS SELECT `app_decisions`.`id` AS `id`, `app_decisions`.`tenderval` AS `tenderval`, `app_decisions`.`p1_id` AS `p1_id`, `app_decisions`.`p2_id` AS `p2_id`, `app_decisions`.`p3_id` AS `p3_id`, `app_decisions`.`p5_id` AS `p5_id`, `app_decisions`.`decision_1` AS `decision_1`, `app_decisions`.`decision_1_a` AS `decision_1_a`, `app_decisions`.`decision_1_b` AS `decision_1_b`, `app_decisions`.`decision_1_comment` AS `decision_1_comment`, `app_decisions`.`decision_2` AS `decision_2`, `app_decisions`.`decision_2_comment` AS `decision_2_comment`, `app_decisions`.`decision_3` AS `decision_3`, `app_decisions`.`decision_3` AS `decision_3_a`, `app_decisions`.`decision_3` AS `decision_3_b`, `app_decisions`.`decision_3_comment` AS `decision_3_comment`, `app_decisions`.`decision_4` AS `decision_4`, `app_decisions`.`decision_4_comment` AS `decision_4_comment`, `app_decisions`.`decision_committee` AS `decision_committee`, `app_decisions`.`email` AS `email`, `app_decisions`.`rejected` AS `rejected`, `app_decisions`.`applicant_name` AS `applicant_name`, `app_decisions`.`generated_dec_id` AS `generated_dec_id`, `app_decisions`.`id_tz` AS `id_tz`, `app_decisions`.`2nd_invitation_rejected` AS `2nd_invitation_rejected`, `app_decisions`.`crdate` AS `crdate`, `app_decisions`.`decision_5` AS `decision_5`, `cnf`.`ccv` AS `decision_6`, `crf`.`ccv` AS `decision_7`, `cnaf`.`ccv` AS `decision_8`, `app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`, `app_decisions`.`invitation_rejected_by_user` AS `invitation_rejected_by_user`, CASE WHEN `app_decisions`.`decision_4` + `app_decisions`.`rejected` = 2 THEN 'Rejected0' WHEN `app_decisions`.`decision_4` = 1 THEN 'Rejected' WHEN `app_decisions`.`rejected_status` = 'fr' THEN 'FinalReject' WHEN `app_decisions`.`rejected_status` = 'fd' THEN 'FailedToJoinCommittee' WHEN `app_decisions`.`invitation_rejected_by_user` = 1 THEN 'RejectedbyUser' WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 'RejUser' WHEN `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 1 THEN 'Committee' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview A' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview B' WHEN `app_decisions`.`decision_2` = 1 THEN 'Rejected due to conditions' WHEN `app_decisions`.`decision_3_a` = 1 THEN 'Accepted A' WHEN `app_decisions`.`decision_3_b` = 1 THEN 'Accepted B' WHEN `app_decisions`.`decision_3` = 1 THEN 'Accepted' WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_1_a` + `app_decisions`.`decision_1_b` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` + `app_decisions`.`decision_committee` = 0 AND `cn_touched_f`.`ccv` is null THEN 'New' WHEN `crf`.`ccv` is not null THEN 'newfiles' WHEN `cnaf`.`ccv` is not null THEN 'Waiting for files' WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 'Waiting' ELSE 'Other' END AS `status` FROM ((((`app_decisions` left join `count_newfiles` `cnf` on(`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `count_rejectedfiles` `crf` on(`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `count_notapproved` `cnaf` on(`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `count_touchedfiles` `cn_touched_f` on(`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `app_rejected`
--
DROP TABLE IF EXISTS `app_rejected`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_rejected`  AS SELECT count(0) AS `trejected`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE `app_decisions`.`p5_id` <> 0 AND `app_decisions`.`decision_2` + `app_decisions`.`decision_4` <> 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `count_justaploaded`
--
DROP TABLE IF EXISTS `count_justaploaded`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_justaploaded`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 3 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_newfiles`
--
DROP TABLE IF EXISTS `count_newfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_newfiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 4 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_notapproved`
--
DROP TABLE IF EXISTS `count_notapproved`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_notapproved`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` <> 1 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_rejectedfiles`
--
DROP TABLE IF EXISTS `count_rejectedfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_rejectedfiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 2 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_touchedfiles`
--
DROP TABLE IF EXISTS `count_touchedfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_touchedfiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` <> 0 AND `apps_file`.`file_name` <> 'form.pdf' GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_zerofiles`
--
DROP TABLE IF EXISTS `count_zerofiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_zerofiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 0 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `getnewids`
--
DROP TABLE IF EXISTS `getnewids`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getnewids`  AS SELECT year(`tenders`.`created_date`) AS `year(created_date)`, concat(year(`tenders`.`created_date`),'-',max(`tenders`.`id`) + 101) AS `new` FROM `tenders` GROUP BY year(`tenders`.`created_date`) ;

-- --------------------------------------------------------

--
-- Structure for view `sendcopy_userdecisions`
--
DROP TABLE IF EXISTS `sendcopy_userdecisions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sendcopy_userdecisions`  AS SELECT `users`.`name` AS `name`, `users`.`email` AS `email`, `user_decisions`.`decisionId` AS `decisionId`, `user_decisions`.`userId` AS `userId` FROM (`users` join `user_decisions` on(`users`.`id` = `user_decisions`.`userId`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tenders_active_files`
--
DROP TABLE IF EXISTS `tenders_active_files`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tenders_active_files`  AS SELECT `tf`.`id` AS `id`, `tf`.`tender_id` AS `tender_id`, `tf`.`url` AS `url`, `tf`.`file_name` AS `file_name`, `tf`.`file_type` AS `file_type`, `tf`.`status` AS `status`, `tf`.`created_at` AS `created_at`, `tf`.`updated_at` AS `updated_at` FROM `tenders_files` AS `tf` WHERE `tf`.`status` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `tenders_applications`
--
DROP TABLE IF EXISTS `tenders_applications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tenders_applications`  AS SELECT `cnf`.`ccv` AS `decision_6`, `crf`.`ccv` AS `decision_7`, `cnaf`.`ccv` AS `decision_8`, `cnzf`.`ccv` AS `decision_9`, `cn_touched_f`.`ccv` AS `decision_10`, `tenders`.`generated_id` AS `generated_id`, `tenders`.`start_date` AS `start_date`, `tenders`.`finish_date` AS `finish_date`, `tenders`.`tname` AS `tname`, `tenders`.`status` AS `status`, `tenders`.`is_test_required` AS `is_test_required`, `tenders`.`created_date` AS `created_date`, `app_decisions`.`crdate` AS `crdate`, `app_decisions`.`id` AS `id`, `app_decisions`.`id_tz` AS `id_tz`, `app_decisions`.`tenderval` AS `tenderval`, `app_decisions`.`p1_id` AS `p1_id`, `app_decisions`.`p2_id` AS `p2_id`, `app_decisions`.`p3_id` AS `p3_id`, `app_decisions`.`tender_number` AS `tender_number`, `app_decisions`.`p5_id` AS `p5_id`, `app_decisions`.`decision_1` AS `decision_1`, `app_decisions`.`decision_1_a` AS `decision_1_a`, `app_decisions`.`decision_1_b` AS `decision_1_b`, `app_decisions`.`decision_1_comment` AS `decision_1_comment`, `app_decisions`.`decision_2` AS `decision_2`, `app_decisions`.`decision_2_comment` AS `decision_2_comment`, `app_decisions`.`decision_3` AS `decision_3`, `app_decisions`.`decision_3_a` AS `decision_3_a`, `app_decisions`.`decision_3_b` AS `decision_3_b`, `app_decisions`.`test_result` AS `test_result`, `app_decisions`.`is_star` AS `is_star`, `app_decisions`.`decision_3_comment` AS `decision_3_comment`, `app_decisions`.`decision_4` AS `decision_4`, `app_decisions`.`decision_4_comment` AS `decision_4_comment`, `app_decisions`.`decision_committee` AS `decision_committee`, `app_decisions`.`decision_5` AS `decision_5`, `app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`, `app_decisions`.`email` AS `email`, `app_decisions`.`rejected` AS `rejected`, `app_decisions`.`applicant_name` AS `applicant_name`, `app_decisions`.`generated_dec_id` AS `generated_dec_id`, `app_decisions`.`invitation_rejected_by_user` AS `invitation_rejected_by_user`, CASE WHEN `app_decisions`.`decision_4` + `app_decisions`.`rejected` = 2 THEN 'Rejected0' WHEN `app_decisions`.`decision_4` = 1 THEN 'Rejected' WHEN `app_decisions`.`rejected_status` = 'fr' THEN 'FinalReject' WHEN `app_decisions`.`rejected_status` = 'fd' THEN 'FailedToJoinCommittee' WHEN `app_decisions`.`invitation_rejected_by_user` = 1 THEN 'RejectedbyUser' WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 'RejUser' WHEN `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 1 THEN 'Committee' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview A' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview B' WHEN `app_decisions`.`decision_2` = 1 THEN 'Rejected due to conditions' WHEN `app_decisions`.`decision_3_a` = 1 THEN 'Accepted A' WHEN `app_decisions`.`decision_3_b` = 1 THEN 'Accepted B' WHEN `app_decisions`.`decision_3` = 1 THEN 'Accepted' WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_1_a` + `app_decisions`.`decision_1_b` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` + `app_decisions`.`decision_committee` = 0 AND `cn_touched_f`.`ccv` is null THEN 'New' WHEN `crf`.`ccv` is not null THEN 'newfiles' WHEN `cnaf`.`ccv` is not null THEN 'Waiting for files' WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 'Waiting' ELSE 'Other' END AS `app_status`, CASE WHEN `app_decisions`.`decision_4` + `app_decisions`.`rejected` = 2 THEN 6 WHEN `app_decisions`.`rejected_status` = 'fr' THEN 16 WHEN `app_decisions`.`rejected_status` = 'fd' THEN 17 WHEN `app_decisions`.`invitation_rejected_by_user` = 1 THEN 15 WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 7 WHEN `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` AND `app_decisions`.`decision_committee` = 1 THEN 10 WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 3 WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 11 WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 12 WHEN `app_decisions`.`decision_4` = 1 THEN 4 WHEN `app_decisions`.`decision_3_a` = 1 THEN 13 WHEN `app_decisions`.`decision_3_b` = 1 THEN 14 WHEN `app_decisions`.`decision_3` = 1 THEN 5 WHEN `app_decisions`.`decision_2` = 1 THEN 6 WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_1_a` + `app_decisions`.`decision_1_b` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` + `app_decisions`.`decision_committee` = 0 AND `cn_touched_f`.`ccv` is null THEN 1 WHEN `crf`.`ccv` is not null THEN 2 WHEN `cnaf`.`ccv` is not null THEN 8 WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 9 ELSE 0 END AS `app_statusnum` FROM (((((((`app_decisions` join `tenders` on(`tenders`.`generated_id` = `app_decisions`.`tenderval`)) left join `count_newfiles` `cnf` on(`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `count_rejectedfiles` `crf` on(`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `count_notapproved` `cnaf` on(`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `count_zerofiles` `cnzf` on(`app_decisions`.`p5_id` = `cnzf`.`app_id`)) left join `count_touchedfiles` `cn_touched_f` on(`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) left join `count_justaploaded` on(`app_decisions`.`p5_id` = `count_justaploaded`.`app_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tenders_stat`
--
DROP TABLE IF EXISTS `tenders_stat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tenders_stat`  AS SELECT `tenders`.`id` AS `id`, `tenders`.`start_date` AS `start_date`, `tenders`.`has_salary` AS `has_salary`, `tenders`.`is_test_required` AS `is_test_required`, `tenders`.`is_recommended` AS `is_recommended`, `tenders`.`is_drushim` AS `is_drushim`, `tenders`.`ttype` AS `ttype`, `tenders`.`brunch` AS `brunch`, `tenders`.`created_by` AS `created_by`, `tenders`.`job_details` AS `job_details`, `tenders`.`functional_level` AS `functional_level`, `tenders`.`input_manager` AS `input_manager`, `tenders`.`tender_number` AS `tender_number`, `tenders`.`job_scope` AS `job_scope`, `tenders`.`subordinations` AS `subordinations`, `tenders`.`grades_voltage` AS `grades_voltage`, `tenders`.`finish_date` AS `finish_date`, `tenders`.`tname` AS `tname`, `tenders`.`template_id` AS `template_id`, `tenders`.`generated_id` AS `generated_id`, `tenders`.`status` AS `status`, `tenders`.`created_date` AS `created_date`, `tenders`.`stopped` AS `stopped`, `tenders`.`deleted` AS `deleted`, `tenders`.`conditions` AS `conditions`, `tenders`.`tender_type` AS `tender_type`, `tenders`.`tender_status` AS `tender_status`, `count`.`ccount` AS `ccount`, `pending`.`pendingcount` AS `pendingcount`, `accepted`.`accepted` AS `accepted`, `rejected`.`trejected` AS `trejected`, `tf`.`file_name` AS `tender_file_name`, `tf`.`url` AS `tender_file_url` FROM (((((`tenders` left join `app_count_val` `count` on(`count`.`tenderval` = `tenders`.`generated_id`)) left join `app_count_pending` `pending` on(`pending`.`tenderval` = `tenders`.`generated_id`)) left join `app_accepted` `accepted` on(`accepted`.`tenderval` = `tenders`.`generated_id`)) left join `app_rejected` `rejected` on(`rejected`.`tenderval` = `tenders`.`generated_id`)) left join `tenders_active_files` `tf` on(`tenders`.`id` = `tf`.`tender_id`)) WHERE `tenders`.`deleted` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `www`
--
DROP TABLE IF EXISTS `www`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `www`  AS SELECT `app_decisions`.`id` AS `id`, `app_decisions`.`tenderval` AS `tenderval`, `app_decisions`.`p1_id` AS `p1_id`, `app_decisions`.`p2_id` AS `p2_id`, `app_decisions`.`p3_id` AS `p3_id`, `app_decisions`.`p5_id` AS `p5_id`, `app_decisions`.`decision_1` AS `decision_1`, `app_decisions`.`decision_1_comment` AS `decision_1_comment`, `app_decisions`.`decision_2` AS `decision_2`, `app_decisions`.`decision_2_comment` AS `decision_2_comment`, `app_decisions`.`decision_3` AS `decision_3`, `app_decisions`.`decision_3_comment` AS `decision_3_comment`, `app_decisions`.`decision_4` AS `decision_4`, `app_decisions`.`decision_4_comment` AS `decision_4_comment`, `app_decisions`.`decision_committee` AS `decision_committee`, `app_decisions`.`email` AS `email`, `app_decisions`.`rejected` AS `rejected`, `app_decisions`.`applicant_name` AS `applicant_name`, `app_decisions`.`generated_dec_id` AS `generated_dec_id`, `app_decisions`.`id_tz` AS `id_tz`, `app_decisions`.`crdate` AS `crdate`, `app_decisions`.`decision_5` AS `decision_5`, `cnf`.`ccv` AS `decision_6`, `crf`.`ccv` AS `decision_7`, `cnaf`.`ccv` AS `decision_8`, `app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`, CASE WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 'RejUser' WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` = 0 AND `cn_touched_f`.`ccv` is null THEN 'New' WHEN `crf`.`ccv` is not null THEN 'newfiles' WHEN `cnaf`.`ccv` is not null THEN 'Waiting for files' WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 'Waiting' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` = 0 AND `app_decisions`.`decision_committee` = 1 THEN 'Committee' WHEN `app_decisions`.`decision_2` = 1 THEN 'Rejected due to conditions' WHEN `app_decisions`.`decision_4` = 1 THEN 'Rejected' WHEN `app_decisions`.`decision_3` = 1 THEN 'Accepted' ELSE 'Other' END AS `status` FROM ((((`app_decisions` left join `count_newfiles` `cnf` on(`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `count_rejectedfiles` `crf` on(`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `count_notapproved` `cnaf` on(`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `count_touchedfiles` `cn_touched_f` on(`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
