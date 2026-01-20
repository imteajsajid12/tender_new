-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2024 at 11:58 AM
-- Server version: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_db`
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
  `tenderval` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `status`, `sender`, `send_date`, `form_id`, `email`, `type`, `department`, `tenderval`) VALUES
(21, '0', ' ', '2024-11-14 10:27:31', 5, 'salmonworko12@gmail.com', 'page5', NULL, '2024-108'),
(26, '0', ' ', '2024-11-19 16:39:36', 5, 'workuyoav@gmail.com', 'page5', NULL, '2024-112'),
(27, '0', ' ', '2024-12-03 10:06:48', 5, 'nitzanp@hcarmel.org.il', 'page5', NULL, '2024-114'),
(28, '0', ' ', '2024-12-14 18:58:12', 5, 'of73ef@wll.co.il', 'page5', NULL, '2024-117');

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
  `status` text NOT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `is_cv` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps_file`
--

INSERT INTO `apps_file` (`id`, `app_dec_id`, `app_id`, `url`, `type`, `file_name`, `status`, `canceled_at`, `is_cv`) VALUES
(72, 21, 21, '6735d093a9623_1731580051_@21.pdf', 'pdf', 'form.pdf', '0', NULL, 0),
(73, 21, 21, '6735d09977a22786852640_1731580057_אישור_העסקה@סולמון_וורקו.pdf', 'no', 'סולמון_וורקו@אישור העסקה#נובמבר..pdf^^אישור העסקה', '0', NULL, 0),
(74, 21, 21, '6735d0997830b806973398_1731580057_קורות_חיים@סולמון_וורקו.pdf', 'no', 'סולמון_וורקו@קורות חיים#קורות חיים- סלומון וורקו.pdf^^קורות חיים', '0', NULL, 1),
(89, 26, 26, '673cbf4824932_1732034376_@26.pdf', 'pdf', 'form.pdf', '0', NULL, 0),
(90, 26, 26, '673cbf4de3f09405499749_1732034381_אישור_העסקה@פקאדו_וורקו.pdf', 'no', 'פקאדו_וורקו@אישור העסקה#Schema PHTLS.pdf^^אישור העסקה', '0', NULL, 0),
(91, 26, 26, '673cbf4de46b0839192820_1732034381_קורות_חיים@פקאדו_וורקו.pdf', 'no', 'פקאדו_וורקו@קורות חיים#Schema PHTLS.pdf^^קורות חיים', '0', NULL, 1),
(92, 0, 26, 'empty.txt', 'newfile', ' ^^מסמך אחר', '2', '2024-11-21 10:42:23', 0),
(93, 0, 21, 'empty.txt', 'newfile', ' ^^מסמך אחר', '2', '2024-11-21 10:43:20', 0),
(94, 27, 27, '674ed8380c14f_1733220408_@27.pdf', 'pdf', 'form.pdf', '0', NULL, 0),
(95, 27, 27, '674ed83dd0c65624850275_1733220413_אישור_העסקה@ניצן_פרנס.pdf', 'no', 'ניצן_פרנס@אישור העסקה#גגגגגג.pdf^^אישור העסקה', '0', NULL, 0),
(96, 27, 27, '674ed83dd1328013937816_1733220413_קורות_חיים@ניצן_פרנס.pdf', 'no', 'ניצן_פרנס@קורות חיים#גגגגגג.pdf^^קורות חיים', '0', NULL, 1),
(97, 28, 28, '675dd5447d389_1734202692_@28.pdf', 'pdf', 'form.pdf', '0', NULL, 0),
(98, 28, 28, '675dd54a40200720788841_1734202698_השכלה_גבוהה@אפרת_אופיר.pdf', 'no', 'תעודות - אפרת.pdf^^השכלה גבוהה', '0', NULL, 0),
(99, 28, 28, '675dd54a42186483340193_1734202698_אישור_העסקה@אפרת_אופיר.pdf', 'no', 'אפרת_אופיר@אישור העסקה#אישור מס חדש קרית ים 11.24.pdf^^אישור העסקה', '0', NULL, 0),
(100, 28, 28, '675dd54a4234a199687290_1734202698_מסמך_רלוונטי_קורסים_והשתלמויות@אפרת_אופיר.pdf', 'no', 'אפרת_אופיר@ מסמך רלוונטי (קורסים והשתלמויות)#תעודות - אפרת.pdf^^ מסמך רלוונטי (קורסים והשתלמויות)', '0', NULL, 0),
(101, 28, 28, '675dd54a42608030976393_1734202698_קורות_חיים@אפרת_אופיר.pdf', 'no', 'אפרת_אופיר@קורות חיים#אפרת אופיר קורות חיים.pdf^^קורות חיים', '0', NULL, 1);

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
(44, 26, '2024-11-21 10:42:23', 'מסמך לצירוף מסמך אחר נדחה ', 1, NULL, 0),
(45, 21, '2024-11-21 10:43:20', 'מסמך לצירוף מסמך אחר נדחה ', 1, NULL, 0),
(46, 0, '2024-11-24 08:25:03', ' מכרז מספר 2024-107 נערך על ידי ניצן פרנס', 1, '2024-107', 0),
(47, 0, '2024-11-25 10:43:26', ' מכרז מספר 2024-114 נוסף על ידי ניצן פרנס', 1, '2024-114', 0),
(48, 0, '2024-11-27 06:09:55', ' מכרז מספר 2024-114 נערך על ידי ניצן פרנס', 1, '2024-114', 0),
(49, 0, '2024-12-02 08:09:29', ' מכרז מספר 2024-115 נוסף על ידי ניצן פרנס', 1, '2024-115', 0),
(50, 0, '2024-12-02 11:59:28', ' מכרז מספר 2024-106 נערך על ידי ניצן פרנס', 1, '2024-106', 0),
(51, 0, '2024-12-03 09:31:05', ' מכרז מספר 2024-105 נערך על ידי ניצן פרנס', 1, '2024-105', 0),
(52, 0, '2024-12-03 09:51:02', ' מכרז מספר 2024-116 נוסף על ידי ניצן פרנס', 1, '2024-116', 0),
(53, 0, '2024-12-03 09:54:22', ' מכרז מספר 2024-117 נוסף על ידי ניצן פרנס', 1, '2024-117', 0),
(54, 0, '2024-12-04 06:20:19', ' מכרז מספר 2024-116 נערך על ידי ניצן פרנס', 1, '2024-116', 0),
(55, 0, '2024-12-04 06:21:14', ' מכרז מספר 2024-117 נערך על ידי ניצן פרנס', 1, '2024-117', 0);

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
(27, 21, 'metaJson', 'a:86:{s:8:\"tenderid\";s:8:\"2024-108\";s:6:\"brunch\";s:10:\"הנהלה\";s:5:\"tname\";s:11:\"אם בית\";s:9:\"firstname\";s:12:\"סולמון\";s:8:\"lastname\";s:10:\"וורקו\";s:5:\"id_tz\";s:9:\"324400498\";s:5:\"email\";s:23:\"salmonworko12@gmail.com\";s:14:\"personal_phone\";s:7:\"2318091\";s:21:\"personal_phone_select\";s:3:\"054\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:17:\"טירת כרמל\";s:15:\"personal_street\";s:16:\"ספורטאים\";s:14:\"personal_house\";s:2:\"12\";s:13:\"personal_flat\";s:1:\"5\";s:16:\"personal_zipcode\";s:7:\"3902809\";s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:12:\"exp_position\";a:9:{i:0;s:53:\"רכז בתנועת נוער לנוער בסיכון.\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2022-09-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2024-09-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:115:\"עבודה עם נוער ניהול ואירגון.\r\nהבנת הצרכים ונתינתם לכול מי שצריך.\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:32:\"עבודת ערב או אחר\"צ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:2:\"50\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:4:\"vals\";s:3:\"334\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"expp_position\";a:1:{i:0;s:153:\"ניהול של פיצריה שעבדתי בה כ5 שנים. עבודה תחת לחץ, ניהול עובדים חדשיים והתמסרות לעבודה\";}s:10:\"expp_descr\";a:1:{i:0;s:8:\"אחמש\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2017-01-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2022-11-11\";}s:13:\"expp_employee\";a:1:{i:0;s:1:\"5\";}s:10:\"expp_level\";a:1:{i:0;s:8:\"אחמש\";}s:12:\"older_worker\";s:2:\"no\";s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:8:\"edu_type\";a:1:{i:0;s:25:\"השכלה תיכונית\";}s:21:\"educ_institution_name\";N;s:21:\"educ_institution_mode\";N;s:28:\"educ_institution_years_years\";N;s:14:\"educ_last_year\";N;s:13:\"add_educ_name\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:15:\"add_educ_finish\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:13:\"add_educ_desc\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"license_exist\";s:3:\"yes\";s:9:\"car_exist\";s:3:\"yes\";s:16:\"car_license_type\";a:2:{i:0;s:12:\"אופנוע\";i:1;s:44:\"רכב עד 3.5 טון ועד 8 נוסעים\";}s:15:\"language_read_i\";s:19:\"שליטה מלאה\";s:16:\"language_write_i\";s:19:\"שליטה מלאה\";s:16:\"language_speak_i\";s:19:\"שליטה מלאה\";s:15:\"language_read_e\";s:19:\"שליטה מלאה\";s:16:\"language_write_e\";s:19:\"שליטה מלאה\";s:16:\"language_speak_e\";s:19:\"שליטה מלאה\";s:8:\"language\";a:1:{i:0;N;}s:15:\"language_write_\";a:2:{i:0;N;i:1;N;}s:15:\"language_speak_\";a:1:{i:0;N;}s:21:\"recomendations_name_z\";a:1:{i:0;N;}s:21:\"recomendations_role_z\";a:1:{i:0;N;}s:25:\"recomendations_work_place\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:22:\"recomendations_phone_z\";a:1:{i:0;N;}s:37:\"recomendations_mobile_phone1_select_z\";a:1:{i:0;s:3:\"050\";}s:21:\"recomendations_name_0\";N;s:19:\"recomendations_role\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"recomendations_phone\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:35:\"recomendations_mobile_phone1_select\";a:9:{i:0;s:3:\"050\";i:1;s:3:\"050\";i:2;s:3:\"050\";i:3;s:3:\"050\";i:4;s:3:\"050\";i:5;s:3:\"050\";i:6;s:3:\"050\";i:7;s:3:\"050\";i:8;s:3:\"050\";}s:21:\"recomendations_name_1\";N;s:21:\"recomendations_name_2\";N;s:21:\"recomendations_name_3\";N;s:21:\"recomendations_name_4\";N;s:21:\"recomendations_name_5\";N;s:21:\"recomendations_name_6\";N;s:21:\"recomendations_name_7\";N;s:21:\"recomendations_name_8\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:2:\"no\";s:10:\"form3_text\";N;s:9:\"moth_sign\";s:4602:\"data:image/png;base64,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\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(32, 26, 'metaJson', 'a:89:{s:8:\"tenderid\";s:8:\"2024-112\";s:6:\"brunch\";s:17:\"אגף חינוך\";s:5:\"tname\";s:18:\"אב בית לבי\";s:9:\"firstname\";s:10:\"פקאדו\";s:8:\"lastname\";s:10:\"וורקו\";s:5:\"id_tz\";s:9:\"324400480\";s:5:\"email\";s:19:\"workuyoav@gmail.com\";s:14:\"personal_phone\";s:7:\"0545887\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:4:\"male\";s:13:\"personal_city\";s:17:\"טירת כרמל\";s:15:\"personal_street\";s:6:\"לחי\";s:14:\"personal_house\";s:1:\"4\";s:13:\"personal_flat\";s:2:\"13\";s:16:\"personal_zipcode\";N;s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:12:\"exp_position\";a:9:{i:0;s:28:\"ניצן מותגי מזון\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2022-12-19\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2025-01-19\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:30:\"מנהל מחסן , מלגזן\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:48:\"חוסר יכולת הקשבה של ההנהלה\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:2:\"מ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"expp_position\";a:1:{i:0;N;}s:10:\"expp_descr\";a:1:{i:0;N;}s:11:\"expp_pstart\";a:1:{i:0;N;}s:11:\"expp_finish\";a:1:{i:0;N;}s:13:\"expp_employee\";a:1:{i:0;N;}s:10:\"expp_level\";a:1:{i:0;N;}s:12:\"older_worker\";s:2:\"no\";s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:8:\"edu_type\";a:1:{i:0;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";s:10:\"אריאל\";s:21:\"educ_institution_mode\";s:21:\"מנהל וכלכלה\";s:28:\"educ_institution_years_years\";s:2:\"12\";s:14:\"educ_last_year\";s:4:\"2017\";s:17:\"diploma_high_type\";a:1:{i:0;s:6:\"אין\";}s:13:\"add_educ_name\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:15:\"add_educ_finish\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:13:\"add_educ_desc\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:22:\"diploma_exist_relevant\";s:2:\"no\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"license_exist\";s:3:\"yes\";s:9:\"car_exist\";s:3:\"yes\";s:16:\"car_license_type\";a:1:{i:0;s:44:\"רכב עד 3.5 טון ועד 8 נוסעים\";}s:15:\"language_read_i\";s:19:\"שליטה מלאה\";s:16:\"language_write_i\";s:19:\"שליטה מלאה\";s:16:\"language_speak_i\";s:19:\"שליטה מלאה\";s:15:\"language_read_e\";s:21:\"שליטה חלקית\";s:16:\"language_write_e\";s:21:\"שליטה חלקית\";s:16:\"language_speak_e\";s:19:\"שליטה מלאה\";s:8:\"language\";a:2:{i:0;N;i:1;s:12:\"אמהרית\";}s:15:\"language_write_\";a:4:{i:0;N;i:1;N;i:2;s:19:\"חוסר שליטה\";i:3;s:19:\"חוסר שליטה\";}s:15:\"language_speak_\";a:2:{i:0;N;i:1;s:21:\"שליטה חלקית\";}s:21:\"recomendations_name_z\";a:1:{i:0;N;}s:21:\"recomendations_role_z\";a:1:{i:0;N;}s:25:\"recomendations_work_place\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:22:\"recomendations_phone_z\";a:1:{i:0;N;}s:37:\"recomendations_mobile_phone1_select_z\";a:1:{i:0;s:3:\"050\";}s:21:\"recomendations_name_0\";N;s:19:\"recomendations_role\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"recomendations_phone\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:35:\"recomendations_mobile_phone1_select\";a:9:{i:0;s:3:\"050\";i:1;s:3:\"050\";i:2;s:3:\"050\";i:3;s:3:\"050\";i:4;s:3:\"050\";i:5;s:3:\"050\";i:6;s:3:\"050\";i:7;s:3:\"050\";i:8;s:3:\"050\";}s:21:\"recomendations_name_1\";N;s:21:\"recomendations_name_2\";N;s:21:\"recomendations_name_3\";N;s:21:\"recomendations_name_4\";N;s:21:\"recomendations_name_5\";N;s:21:\"recomendations_name_6\";N;s:21:\"recomendations_name_7\";N;s:21:\"recomendations_name_8\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:11:\"form5_nigud\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:9:\"form3_ch2\";s:2:\"no\";s:10:\"form3_text\";N;s:9:\"moth_sign\";s:5318:\"data:image/png;base64,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\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(35, 114, 'tender_num_display', '2024-114'),
(36, 115, 'tender_num_display', '2024-115'),
(37, 116, 'tender_num_display', '2024-116'),
(38, 117, 'tender_num_display', '2024-117'),
(39, 27, 'metaJson', 'a:83:{s:8:\"tenderid\";s:8:\"2024-114\";s:6:\"brunch\";s:17:\"אגף חינוך\";s:5:\"tname\";s:47:\"מטפל/ת למעון היום בכרם מהר\";s:9:\"firstname\";s:8:\"ניצן\";s:8:\"lastname\";s:8:\"פרנס\";s:5:\"id_tz\";s:9:\"300821196\";s:5:\"email\";s:22:\"nitzanp@hcarmel.org.il\";s:14:\"personal_phone\";s:7:\"8143418\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:6:\"female\";s:13:\"personal_city\";s:6:\"fasfaf\";s:15:\"personal_street\";s:6:\"safasf\";s:14:\"personal_house\";s:3:\"333\";s:13:\"personal_flat\";s:2:\"33\";s:16:\"personal_zipcode\";N;s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:12:\"exp_position\";a:9:{i:0;s:12:\"כגעגכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2024-12-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2024-12-02\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:12:\"גכעגכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:12:\"כגעגכע\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:3:\"100\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"expp_position\";a:1:{i:0;s:12:\"גכיגכי\";}s:10:\"expp_descr\";a:1:{i:0;s:16:\"גכיגכיכג\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2024-11-12\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2024-11-12\";}s:13:\"expp_employee\";a:1:{i:0;N;}s:10:\"expp_level\";a:1:{i:0;N;}s:12:\"older_worker\";s:2:\"no\";s:8:\"last_job\";N;s:16:\"older_start_date\";N;s:14:\"older_end_date\";N;s:18:\"reason_for_leaving\";N;s:21:\"educ_institution_name\";N;s:21:\"educ_institution_mode\";N;s:28:\"educ_institution_years_years\";N;s:14:\"educ_last_year\";N;s:13:\"add_educ_name\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:15:\"add_educ_finish\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:13:\"add_educ_desc\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"license_exist\";s:2:\"no\";s:9:\"car_exist\";s:2:\"no\";s:15:\"language_read_i\";s:19:\"שליטה מלאה\";s:16:\"language_write_i\";s:19:\"שליטה מלאה\";s:16:\"language_speak_i\";s:19:\"שליטה מלאה\";s:15:\"language_read_e\";s:19:\"שליטה מלאה\";s:16:\"language_write_e\";s:19:\"שליטה מלאה\";s:16:\"language_speak_e\";s:19:\"שליטה מלאה\";s:8:\"language\";a:1:{i:0;N;}s:15:\"language_write_\";a:2:{i:0;N;i:1;N;}s:15:\"language_speak_\";a:1:{i:0;N;}s:21:\"recomendations_name_z\";a:1:{i:0;N;}s:21:\"recomendations_role_z\";a:1:{i:0;N;}s:25:\"recomendations_work_place\";a:10:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:22:\"recomendations_phone_z\";a:1:{i:0;N;}s:37:\"recomendations_mobile_phone1_select_z\";a:1:{i:0;s:3:\"050\";}s:21:\"recomendations_name_0\";N;s:19:\"recomendations_role\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"recomendations_phone\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:35:\"recomendations_mobile_phone1_select\";a:9:{i:0;s:3:\"050\";i:1;s:3:\"050\";i:2;s:3:\"050\";i:3;s:3:\"050\";i:4;s:3:\"050\";i:5;s:3:\"050\";i:6;s:3:\"050\";i:7;s:3:\"050\";i:8;s:3:\"050\";}s:21:\"recomendations_name_1\";N;s:21:\"recomendations_name_2\";N;s:21:\"recomendations_name_3\";N;s:21:\"recomendations_name_4\";N;s:21:\"recomendations_name_5\";N;s:21:\"recomendations_name_6\";N;s:21:\"recomendations_name_7\";N;s:21:\"recomendations_name_8\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:10:\"form3_text\";N;s:9:\"moth_sign\";s:2470:\"data:image/png;base64,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\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}'),
(40, 28, 'metaJson', 'a:88:{s:8:\"tenderid\";s:8:\"2024-117\";s:6:\"brunch\";s:17:\"אגף חינוך\";s:5:\"tname\";s:56:\"מנהל/ת יחידת הגיל הרך (לידה עד 3)\";s:9:\"firstname\";s:8:\"אפרת\";s:8:\"lastname\";s:10:\"אופיר\";s:5:\"id_tz\";s:9:\"025285909\";s:5:\"email\";s:16:\"of73ef@wll.co.il\";s:14:\"personal_phone\";s:7:\"5937724\";s:21:\"personal_phone_select\";s:3:\"050\";s:6:\"gender\";s:6:\"female\";s:13:\"personal_city\";s:60:\"קרית מוצקין(לקראת מעבר לפרדס חנה)\";s:15:\"personal_street\";s:17:\"עופרה חזה\";s:14:\"personal_house\";s:1:\"4\";s:13:\"personal_flat\";s:2:\"54\";s:16:\"personal_zipcode\";N;s:23:\"personal_postal_address\";s:3:\"yes\";s:6:\"postal\";N;s:12:\"exp_position\";a:9:{i:0;s:22:\"ערית קרית ים\";i:1;s:23:\"מכללת גורדון\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"expe_start\";a:9:{i:0;s:10:\"2024-07-22\";i:1;s:10:\"2018-10-01\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:10:\"exp_finish\";a:9:{i:0;s:10:\"2024-12-31\";i:1;s:10:\"2024-08-01\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_descr\";a:9:{i:0;s:89:\"מדריכה פדגוגית רשותית על כל המסגרות הפרטיות בעיר\";i:1;s:77:\"מרצה את תחום הגיל הרך בקורס מחנכות ומנהלות\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"exp_reasontocomplete\";a:9:{i:0;s:17:\"עדין עבדת\";i:1;s:17:\"סיום קורס\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:9:\"exp_scope\";a:9:{i:0;s:2:\"80\";i:1;s:11:\"30 אחוז\";i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:4:\"vals\";s:3:\"333\";s:10:\"valsstatic\";s:3:\"333\";s:13:\"expp_position\";a:1:{i:0;s:19:\"שכניה-משגב\";}s:10:\"expp_descr\";a:1:{i:0;s:37:\"מנהלת גיל רך לידה -יב\";}s:11:\"expp_pstart\";a:1:{i:0;s:10:\"2018-09-01\";}s:11:\"expp_finish\";a:1:{i:0;s:10:\"2024-08-31\";}s:13:\"expp_employee\";a:1:{i:0;s:2:\"25\";}s:10:\"expp_level\";a:1:{i:0;N;}s:12:\"older_worker\";s:3:\"yes\";s:8:\"last_job\";s:27:\"מדריכה פדגוגית\";s:16:\"older_start_date\";s:10:\"2024-07-22\";s:14:\"older_end_date\";s:10:\"2024-12-31\";s:18:\"reason_for_leaving\";N;s:13:\"still_working\";s:3:\"yes\";s:8:\"edu_type\";a:1:{i:0;s:21:\"השכלה גבוהה\";}s:21:\"educ_institution_name\";N;s:21:\"educ_institution_mode\";N;s:28:\"educ_institution_years_years\";N;s:14:\"educ_last_year\";N;s:17:\"diploma_high_type\";a:4:{i:0;s:19:\"תואר ראשון\";i:1;s:15:\"תואר שני\";i:2;N;i:3;N;}s:13:\"add_educ_name\";a:10:{i:0;s:52:\"ניהול גיל רך ברשויות מקומיות\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:15:\"add_educ_finish\";a:10:{i:0;s:10:\"2015-07-01\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:13:\"add_educ_desc\";a:10:{i:0;s:25:\"קרן שטיינמינץ\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:22:\"diploma_exist_relevant\";s:3:\"yes\";s:7:\"license\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_type\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:12:\"license_date\";a:8:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:13:\"license_exist\";s:3:\"yes\";s:9:\"car_exist\";s:3:\"yes\";s:15:\"language_read_i\";s:19:\"שליטה מלאה\";s:16:\"language_write_i\";s:19:\"שליטה מלאה\";s:16:\"language_speak_i\";s:19:\"שליטה מלאה\";s:15:\"language_read_e\";s:19:\"שליטה מלאה\";s:16:\"language_write_e\";s:19:\"שליטה מלאה\";s:16:\"language_speak_e\";s:19:\"שליטה מלאה\";s:8:\"language\";a:2:{i:0;N;i:1;s:10:\"ערבית\";}s:15:\"language_write_\";a:4:{i:0;N;i:1;N;i:2;s:19:\"שליטה מלאה\";i:3;s:19:\"שליטה מלאה\";}s:15:\"language_speak_\";a:2:{i:0;N;i:1;s:19:\"שליטה מלאה\";}s:21:\"recomendations_name_z\";a:1:{i:0;s:19:\"איציק גרסי\";}s:21:\"recomendations_role_z\";a:1:{i:0;s:28:\"מנהל ישוב שכניה\";}s:25:\"recomendations_work_place\";a:10:{i:0;s:19:\"שכניה-משגב\";i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;}s:22:\"recomendations_phone_z\";a:1:{i:0;s:7:\"2474505\";}s:37:\"recomendations_mobile_phone1_select_z\";a:1:{i:0;s:3:\"052\";}s:21:\"recomendations_name_0\";N;s:19:\"recomendations_role\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:20:\"recomendations_phone\";a:9:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;}s:35:\"recomendations_mobile_phone1_select\";a:9:{i:0;s:3:\"050\";i:1;s:3:\"050\";i:2;s:3:\"050\";i:3;s:3:\"050\";i:4;s:3:\"050\";i:5;s:3:\"050\";i:6;s:3:\"050\";i:7;s:3:\"050\";i:8;s:3:\"050\";}s:21:\"recomendations_name_1\";N;s:21:\"recomendations_name_2\";N;s:21:\"recomendations_name_3\";N;s:21:\"recomendations_name_4\";N;s:21:\"recomendations_name_5\";N;s:21:\"recomendations_name_6\";N;s:21:\"recomendations_name_7\";N;s:21:\"recomendations_name_8\";N;s:13:\"relative_name\";a:1:{i:0;N;}s:17:\"relative_distance\";a:1:{i:0;s:8:\"הורה\";}s:16:\"relative_name_d1\";a:1:{i:0;N;}s:8:\"nearness\";s:2:\"no\";s:11:\"form5_nigud\";s:2:\"no\";s:16:\"form5_nigud_text\";N;s:10:\"form3_text\";N;s:9:\"moth_sign\";s:7846:\"data:image/png;base64,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\";s:4:\"html\";s:0:\"\";s:4:\"file\";s:0:\"\";}');

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
  `rejected_status` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_decisions`
--

INSERT INTO `app_decisions` (`id`, `tenderval`, `tender_number`, `tender_body`, `tender_body_image`, `test_result`, `grade`, `is_star`, `p1_id`, `p2_id`, `p3_id`, `p5_id`, `decision_1`, `decision_1_a`, `decision_1_b`, `decision_1_comment`, `decision_2`, `decision_2_comment`, `decision_3`, `decision_3_b`, `decision_3_a`, `decision_3_comment`, `decision_4`, `decision_4_comment`, `email`, `rejected`, `applicant_name`, `generated_dec_id`, `id_tz`, `crdate`, `decision_5`, `decision_rejectedbyuser`, `decision_committee`, `has_salary`, `salary`, `accept_salary`, `selected_interview_time`, `selected_interview_place`, `approved_interview_place`, `approved_interview_time`, `last_interview_invitation_send`, `last_committee_invitation_send`, `approved_committee_time`, `is_appeared`, `committee_selected_place`, `committee_invitation_approved_time`, `2nd_invitation_rejected`, `invitation_rejected_by_user`, `rejected_status`) VALUES
(21, '2024-108', '145/2024', NULL, 'img/sin-img.jpg', NULL, NULL, 0, 0, 0, 0, 21, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'salmonworko12@gmail.com', 0, 'סולמון וורקו', NULL, '324400498', '2024-11-14 10:27:31', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(26, '2024-112', '000000', NULL, 'img/sin-img.jpg', NULL, NULL, 0, 0, 0, 0, 26, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'workuyoav@gmail.com', 0, 'פקאדו וורקו', NULL, '324400480', '2024-11-19 16:39:36', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(27, '2024-114', '183/2024', NULL, 'img/sin-img.jpg', NULL, NULL, 0, 0, 0, 0, 27, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'nitzanp@hcarmel.org.il', 0, 'ניצן פרנס', NULL, '300821196', '2024-12-03 10:06:48', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(28, '2024-117', '149/2024', NULL, 'img/sin-img.jpg', NULL, NULL, 0, 0, 0, 0, 28, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 'of73ef@wll.co.il', 0, 'אפרת אופיר', NULL, '025285909', '2024-12-14 18:58:12', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL);

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
('hdana@mam.org.il|118.179.179.232', 'i:1;', 1726392894),
('hdana@mam.org.il|118.179.179.232:timer', 'i:1726392894;', 1726392894),
('malkig@betar-illit.muni.il|118.179.179.232', 'i:1;', 1726392890),
('malkig@betar-illit.muni.il|118.179.179.232:timer', 'i:1726392890;', 1726392890),
('michale@gezer-region.muni.il|118.179.179.232', 'i:1;', 1726392897),
('michale@gezer-region.muni.il|118.179.179.232:timer', 'i:1726392897;', 1726392897);

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
-- Stand-in structure for view `sendcopy_userdecisions`
-- (See below for the actual view)
--
CREATE TABLE `sendcopy_userdecisions` (
`name` varchar(191)
,`email` varchar(191)
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
('0o6rLgqOZONAjS7clW0Qro0wzNaFEyXEq1fcJ7cC', NULL, '3.88.151.103', 'Slackbot-LinkExpanding 1.0 (+https://api.slack.com/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielBjV1g0OHB6Z0J0c2xibVZ0SHY2Y2s3RXJYUHdkVmdiSUllWW5XeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183535),
('1fR3YcnxdhmUTCgWEOIEgc5zXL5WJJX6XVAwb9lV', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidW1jbklrbm01eG5KOGNiY0pyWGtDZE1ZTXFQMWk3azA4ZUZGSWlUNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsLz9yZXN0X3JvdXRlPSUyRndwJTJGdjIlMkZ1c2VycyUyRiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734183534),
('1zl7RkIkYShwWGtBd0uhPxvk78fRrWZmzrxhfb7t', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1JhWDhWWmNhTmh4U1N6OXZ4TmxKR28xNGdnRjlFdGZtOXdZaGFoWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3NlcnZlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734183526),
('2LsDuCEEaG31lt2K97Z6d7uqZ4Fd7qmNhJcCnLMi', NULL, '77.137.75.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFI2SnY0d3h4Mm93ekNjUGRsQjdWSGh5b2FGVDRoWTlZWjFKSGFObyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODI6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3BhZ2U1P2ZpbGU9JnRlbmRlcmRpc3BsYXk9MjAyNC0xMTcmdGVuZGVyaWQ9MjAyNC0xMTciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734194556),
('5PGCPCxdYEMNJVyWAMKeCYRm7fNr6r3rvQKzitsv', NULL, '209.38.208.202', 'Mozilla/5.0 (l9scan/2.0.83e23373e2932323e23383; +https://leakix.net)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamhtWnFrdHNNTGR4cEZOYVlSd0NjUkNpUHdZUWt2cXA3a25SWFRPMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL19hbGxfZGJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183530),
('6qHt4eDmPoXOC3SzgDfc5kQhAUZBekjACEtgP03u', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1AzcnZaNXVtT2lYYTlUZGN4Q29WNjNSZ0djT2lUNk9qTkFOUUZMcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL2luZm8ucGhwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183534),
('C3deuJ1zvJCyaD9PuhPEpcgbiIOAVFjG6GDIM6VS', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHJPeGpMUjJ0SlVCSzlkRTlVYXBlYnVLblVLRFRONDZJY3FjUlpYaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL2NvbmZpZy5qc29uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183533),
('cUB0NkHdCk2GFteeuLIt20FSMBPDSbKENyy45Ork', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3JWbVNPcnRFd0ZpYUdpQVFZQW5jMEV5UGlKa0tNTmRxaHk2R3VEdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3VwbG9hZC8uRFNfU3RvcmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734183532),
('d84ZUhvBd9NyrHi9iKlwkyrs8ucekOIWcyf0RPMw', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFNXWDZTcjNFVGZhaWtUdGJ6MzRFYkpqdTlEekVqdElQYjFvVVZPbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsLy52c2NvZGUvc2Z0cC5qc29uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183527),
('FbJrFUPYNQ43r6HTL3x7tMtTBOeuOl7AT7C2PyWe', NULL, '83.229.73.8', 'Plesk (fetch_url utility)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmR6YnF0ZzUxS2hra0gzSGh6N21FallRQ0JvVHVQSlIyMU1qdVlRbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL2Nyb24vcmVzZW5kLWludml0YXRpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734213602),
('fcDm5AsHuUZ9ThlfTorM8VmyHX7FkEjjwV97075k', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3JDZFUwSldiSVB2aTk0ZFNnTXQ0UWFxZkRmOEhZR05OSmhZV1JrRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3RlbGVzY29wZS9yZXF1ZXN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734183533),
('fCyuWU05nH4u6PaSe3OPhHGDi4vJ5CFvphCLZafq', NULL, '176.34.216.103', 'Plesk screenshot bot https://support.plesk.com/hc/en-us/articles/10301006946066', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDlHUlJ1MVJHRnY3M2NNTFRPQUVLbmxYeDJ1M2hPTkZxdTNxeTlWaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734256672),
('fpZZGtbD53r6KDwdTMgvLsbP4lpyx0WT3whx0W3c', NULL, '209.38.208.202', 'Mozilla/5.0 (Linux; Android 6.0; HTC One M9 Build/MRA538802) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.1407.98 Mobile Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEJJUkV0YXJzNjNKclB0dGp1c2hMZGlYZ2lrakhzM09LSXRwWFNJVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183525),
('K92OaiXAWFQc7BmjX9FqMW58hUdTQqzYcD0LOwVv', NULL, '34.71.33.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXZsRWNrd2p4eDhwZUl2ZUloTUxYNVRTVnVacFhkZEhHUXQya2NsVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3B1YmxpYy9hcHAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734218020),
('KhULox5bmMivmOn5j9PN5yFPrr4V2tzxOQZL1QPT', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2toc0N5UFZveEo0Q3ppNkRpeVdXQmh6SHhCNENVZXl2OEZZaTNuVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL2Fib3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183528),
('mshjuXozDiNBlNICIUa8JAlvmobigAAW0CdTMZc9', NULL, '62.56.148.21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM25oVGgwZWlwSkRXWm90a2p1bUJ5UFRaQTlrVU4zUXc0eWVkUmJGNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3BhZ2U1L3N1Y2Nlc3MvMjgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734202704),
('MX7qIZ1vz3V6hafIlRlioyTpa8MUY57p1Ewjcu1c', NULL, '5.28.181.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/346.0.703268850 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTRtbFRwdDEzMkV3VExicnpWczRjUEFQUVk2NlNyYlBrdHBPd1JJZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODI6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3BhZ2U1P2ZpbGU9JnRlbmRlcmRpc3BsYXk9MjAyNC0xMTcmdGVuZGVyaWQ9MjAyNC0xMTciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734247780),
('nLJQG1pfhpLulK0irYonkA0QKMX31W6tOOXTIvb2', NULL, '34.71.33.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlI2VXZ2QTVGbURwMkZuTFQza0E5RG45N2lZUXNLd3h6VlpwUXpGaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3B1YmxpYy9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734218021),
('OZFyF4l3T83LjzYbB1L6yZHg15SGQiUV3S0c5eUK', NULL, '34.71.33.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTFxNGJiU0JmRFFSbnVaeERVUVo5YTJMUWRkdVI2anFJMTN3QWxPSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734218020),
('QUZBNoDFcT8BS7wU8cVHx2IzogJEbV7ee3N4VhaC', NULL, '209.38.208.202', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXFaQmhYdDRaNDZSRm9GSmNOdEFSblozcGg0Qk9SZ0NiQlF0ZUN2ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183522),
('STNaOmYSZaDBQDMLpwuWEfKmrJcMYIhDpyo4ZQd3', NULL, '66.249.66.1', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.108 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGE0Q1ZYR1ZDM2FGUDMwS1R6aEprR0RaMDJDUU02cGdHQXpyQUpFMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3BhZ2UyLzIwMjQtMTE2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183880),
('v4Joe1DHp7Iizuose6YMdUrbABNnYMxkBH2rUeAl', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1dQVnVYUU1hMGlyN05lQ3pCVmJ5Tkp1TUdEQUNhckhoRURYNk9VUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL2xvZ2luLmFjdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734183530),
('W04pydTzpKtyKayhrZnKGoIuv7nM95VPnUyeci3D', NULL, '77.137.75.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDdtN1prM0R2TnQ3OXdtMW0wNHdJeXU1a0ZDWnVrYzdFSDJLQkdIeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODI6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3BhZ2U1P2ZpbGU9JnRlbmRlcmRpc3BsYXk9MjAyNC0xMTcmdGVuZGVyaWQ9MjAyNC0xMTciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734195836),
('X3j1Y7YzfKbKZkofFhEFQ13kFt6gjaurHTVhAT7V', NULL, '54.198.8.21', 'Slackbot-LinkExpanding 1.0 (+https://api.slack.com/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWRqVWZsUW1ldW5qVDFjaW9MdzFyMEN3NzRoejB1R0NqVkxLYVhIaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183536),
('z1kkb8yXHqw1hLh37rQyhynLSHbu2ZuCezvjRtxy', NULL, '209.38.208.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEpQdEdjVVQwamJmdnp0V1BMMHg4cERlSDcwcVAxVm1Wd3RKUTh1ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vdGNhcm1lbC5hdXRvbWFzLmNvLmlsL3YyL19jYXRhbG9nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734183528);

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
(4, 'מועצה אזורית יואב (ליד גדרה)', 0, '{\"header_title\":{\"value\":\"\\u05de\\u05db\\u05e8\\u05d6\\u05d9 \\u05db\\u05d5\\u05d7 \\u05d0\\u05d3\\u05dd \\u05dc\\u05d1\\u05d3\\u05d9\\u05e7\\u05d4\",\"tender_form_id\":null},\"date\":{\"value\":null,\"tender_form_id\":null},\"template_name\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05e6\\u05d4 \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d9\\u05d5\\u05d0\\u05d1 (\\u05dc\\u05d9\\u05d3 \\u05d2\\u05d3\\u05e8\\u05d4)\",\"tender_form_id\":null},\"workplace_label\":{\"value\":\"\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4\",\"tender_form_id\":null},\"workplace\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05e6\\u05d4 \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d9\\u05d5\\u05d0\\u05d1 (\\u05dc\\u05d9\\u05d3 \\u05d2\\u05d3\\u05e8\\u05d4)\",\"tender_form_id\":null},\"position_label\":{\"value\":\"\\u05d4\\u05e7\\u05e3 \\u05de\\u05e9\\u05e8\\u05d4\",\"tender_form_id\":null},\"position\":{\"value\":\"100%\",\"tender_form_id\":null},\"wage_label\":{\"value\":\"\\u05e9\\u05db\\u05e8\",\"tender_form_id\":null},\"wage\":{\"value\":\"\\u05de\\u05d9\\u05e0\\u05d4\\u05dc\\u05d9 7-10\",\"tender_form_id\":null},\"subordination_label\":{\"value\":\"\\u05db\\u05e4\\u05d9\\u05e4\\u05d5\\u05ea\",\"tender_form_id\":null},\"subordination\":{\"value\":\"\\u05dc\\u05de\\u05e0\\u05d4\\u05dc \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4, \\u05de\\u05d5\\u05e0\\u05d7\\u05d4 \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05ea \\u05e2\\\"\\u05d9 \\u05e7\\u05e6\\u05d9\\u05df \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d1\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4 5\",\"tender_form_id\":\"subordinations\"},\"starting_work_label\":{\"value\":\"\\u05ea\\u05d7\\u05d9\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4\",\"tender_form_id\":null},\"starting_work\":{\"value\":\"\\u05de\\u05d9\\u05d9\\u05d3\\u05d9\",\"tender_form_id\":null},\"job_description_label\":{\"value\":\"\\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3\",\"tender_form_id\":null},\"job_description\":{\"value\":\"\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d4\\u05e9\\u05d9\\u05d9\\u05da \\u05dc\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05d0\\u05d5 \\u05de\\u05e9\\u05de\\u05e9 \\u05d0\\u05d5\\u05ea\\u05d4 \\u05d5\\u05d4\\u05e4\\u05e2\\u05dc\\u05ea\\u05d5 \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5                        \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.\",\"tender_form_id\":null},\"main_areas_of_responsibility_label\":{\"value\":\"\\u05ea\\u05d7\\u05d5\\u05de\\u05d9 \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05e2\\u05d9\\u05e7\\u05e8\\u05d9\\u05d9\\u05dd\",\"tender_form_id\":null},\"main_areas_of_responsibility\":{\"value\":\"1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.        .2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea.        .3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 .\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus_label\":{\"value\":\".1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus\":{\"value\":\"\\u05d0. \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d8\\u05d5\\u05d7\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e7\\u05e4\\u05d3\\u05d4 \\u05e2\\u05dc                        \\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d5\\u05d4\\u05d4\\u05e4\\u05e1\\u05e7\\u05d5\\u05ea \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2\\u05d5 \\u05d1\\u05d3\\u05d9\\u05df.                        \\u05d1. \\u05e0\\u05e7\\u05d9\\u05d8\\u05ea \\u05d0\\u05de\\u05e6\\u05e2\\u05d9 \\u05d6\\u05d4\\u05d9\\u05e8\\u05d5\\u05ea, \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d1\\u05d8\\u05d7\\u05ea \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd.                        \\u05d2. \\u05e7\\u05d9\\u05d5\\u05dd \\u05e1\\u05d3\\u05e8\\u05d9 \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d5\\u05d1\\u05d3\\u05d9\\u05e7\\u05d5\\u05ea \\u05dc\\u05d0\\u05d9\\u05ea\\u05d5\\u05e8 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd \\u05d7\\u05e9\\u05d5\\u05d3\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df                        \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd.                        \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea.                        \\u05d4. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d0\\u05d3\\u05d9\\u05d1 \\u05d5\\u05de\\u05e0\\u05d5\\u05de\\u05e1 \\u05dc\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd .\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings_label\":{\"value\":\".2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings\":{\"value\":\"\\u05d0. \\u05d4\\u05ea\\u05e7\\u05e0\\u05ea \\u05e9\\u05d9\\u05dc\\u05d5\\u05d8, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d5\\u05de\\u05d0\\u05d7\\u05d5\\u05e8\\u05d9 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05e2\\u05dc\\u05d9\\u05d5 \\u05db\\u05d9\\u05ea\\u05d5\\u05d1 \\u05d1\\u05d5\\u05dc\\u05d8 \\\"\\u05d4\\u05e1\\u05e2\\u05d5\\u05ea \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd\\\".                        \\u05d1. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d9\\u05e9\\u05d9\\u05d1\\u05ea \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4 \\u05d5\\u05e2\\u05dc \\u05d4\\u05d9\\u05d5\\u05ea\\u05dd \\u05d7\\u05d2\\u05d5\\u05e8\\u05d9\\u05dd \\u05d1\\u05d7\\u05d2\\u05d5\\u05e8\\u05d5\\u05ea                        \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05de\\u05e1\\u05e4\\u05e8 \\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4.                        \\u05d2. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d4\\u05de\\u05ea\\u05e8\\u05d7\\u05e9 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05d5\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05ea\\u05e0\\u05d4\\u05d2\\u05d5\\u05ea \\u05dc\\u05d0 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea\\u05d9\\u05ea.                        \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea )\\u05d1\\u05d9\\u05df \\u05d0\\u05dd \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d6\\u05e2\\u05d9\\u05e8 \\u05d0\\u05d5                        \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1) \\u05d1\\u05ea\\u05d7\\u05e0\\u05d5\\u05ea \\u05d4\\u05e1\\u05e2\\u05d4 \\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea \\u05d5\\u05de\\u05d5\\u05e1\\u05d3\\u05e8\\u05d5\\u05ea \\u05de\\u05e8\\u05d0\\u05e9, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05dc\\u05ea \\u05e4\\u05e0\\u05e1\\u05d9 \\u05d0\\u05d9\\u05ea\\u05d5\\u05ea                        \\u05de\\u05d4\\u05d1\\u05d4\\u05d1\\u05d9\\u05dd \\u05d1\\u05db\\u05dc \\u05e2\\u05ea \\u05e9\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05e4\\u05ea\\u05d5\\u05d7\\u05d5\\u05ea.                        \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05d4 \\u05db\\u05d9 \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d9\\u05e8\\u05d3\\u05d5 \\u05de\\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d5\\u05d4\\u05ea\\u05e8\\u05d7\\u05e7\\u05d5 \\u05de\\u05e0\\u05ea\\u05d9\\u05d1 \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d4\\u05de\\u05e9\\u05da                        \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4.                        \\u05d5. \\u05e1\\u05e8\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05ea\\u05d5\\u05dd \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05d5\\u05d5\\u05d3\\u05d0 \\u05e9\\u05dc\\u05d0 \\u05e0\\u05d5\\u05ea\\u05e8\\u05d5 \\u05d1\\u05d5 \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd.\",\"tender_form_id\":null},\"bus_safety_and_soundness_label\":{\"value\":\".3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"bus_safety_and_soundness\":{\"value\":\"\\u05d0. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05de\\u05e2\\u05e8\\u05db\\u05d5\\u05ea\\u05d9\\u05d5 \\u05d4\\u05d4\\u05d9\\u05d3\\u05e8\\u05d0\\u05d5\\u05dc\\u05d9\\u05d5\\u05ea \\u05d5\\u05d4\\u05de\\u05db\\u05e0\\u05d9\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd \\u05dc\\u05e4\\u05e0\\u05d9                        \\u05d4\\u05d9\\u05e6\\u05d9\\u05d0\\u05d4 \\u05dc\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d5\\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2\\u05df )\\u05db\\u05d2\\u05d5\\u05df: \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05e9\\u05de\\u05df, \\u05de\\u05d9\\u05dd, \\u05e6\\u05de\\u05d9\\u05d2\\u05d9\\u05dd, \\u05d1\\u05dc\\u05de\\u05d9\\u05dd,                        \\u05de\\u05d2\\u05d1\\u05d9\\u05dd, \\u05de\\u05e2\\u05e8\\u05db\\u05ea \\u05d4\\u05d7\\u05e9\\u05de\\u05dc \\u05d5\\u05d4\\u05d0\\u05d5\\u05e8\\u05d5\\u05ea, \\u05e4\\u05e2\\u05d5\\u05dc\\u05d5\\u05ea \\u05d4\\u05e4\\u05ea\\u05d9\\u05d7\\u05d4 \\u05d5\\u05d4\\u05e1\\u05d2\\u05d9\\u05e8\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d5\\u05db\\u05d9\\u05d5\\u05e6\\\"\\u05d1).                        \\u05d1. \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d9\\u05dd \\u05e7\\u05dc\\u05d9\\u05dd \\u05d4\\u05d3\\u05e8\\u05d5\\u05e9\\u05d9\\u05dd \\u05dc\\u05d0\\u05d7\\u05d6\\u05e7\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05d3\\u05d9\\u05d5\\u05d5\\u05d7 \\u05dc\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea                        \\u05d0\\u05d5 \\u05dc\\u05d9\\u05e7\\u05d5\\u05d9\\u05d9\\u05dd \\u05e9\\u05d4\\u05ea\\u05d2\\u05dc\\u05d5.                        \\u05d2. \\u05d4\\u05e2\\u05d1\\u05e8\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea                        \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4.                        \\u05d3. \\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05e4\\u05e8\\u05d8\\u05d9 \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea \\u05d1\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1.                        \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05d0\\u05d7\\u05e8 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d5 \\u05d1\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd                        \\u05dc\\u05e0\\u05d4\\u05dc\\u05d9\\u05dd \\u05d5\\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 .                        \\u05d5. \\u05d6\\u05d9\\u05d5\\u05d5\\u05d3 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05e2\\u05d6\\u05e8 )\\u05de\\u05d8\\u05e3, \\u05de\\u05e9\\u05d5\\u05dc\\u05e9, \\u05e2\\u05d6\\u05e8\\u05d4 \\u05e8\\u05d0\\u05e9\\u05d5\\u05e0\\u05d4, \\u05d0\\u05e4\\u05d5\\u05d3                        \\u05d6\\u05d5\\u05d4\\u05e8 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1).                        \\u05d6. \\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05ea\\u05d5\\u05e7\\u05e4\\u05dd \\u05e9\\u05dc \\u05de\\u05e1\\u05de\\u05db\\u05d9 \\u05d4\\u05e8\\u05db\\u05d1 )\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05d4\\u05e8\\u05db\\u05d1, \\u05d1\\u05d9\\u05d8\\u05d5\\u05d7 \\u05d7\\u05d5\\u05d1\\u05d4 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1( \\u05d5\\u05d4\\u05d9\\u05de\\u05e6\\u05d0\\u05d5\\u05ea\\u05dd                        \\u05d1\\u05e8\\u05db\\u05d1 \\u05d1\\u05d6\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4.                        \\u05d7. \\u05ea\\u05d3\\u05dc\\u05d5\\u05e7 \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d7\\u05e0\\u05d9\\u05d9\\u05ea\\u05d5 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05d5\\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.                        \\u05d8. \\u05e9\\u05d8\\u05d9\\u05e4\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05e0\\u05d5 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05df \\u05e1\\u05d1\\u05d9\\u05e8 \\u05de\\u05d1\\u05d7\\u05d5\\u05e5 \\u05d5\\u05d7\\u05d9\\u05d8\\u05d5\\u05d9 \\u05d0\\u05d7\\u05ea                        \\u05dc\\u05e9\\u05e0\\u05d4.                        \\u05d9. \\u05d4\\u05d7\\u05d6\\u05e8\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d1\\u05e1\\u05d9\\u05d5\\u05dd \\u05d9\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05dc\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e8\\u05d9\\u05db\\u05d5\\u05d6 \\u05e9\\u05dc \\u05e8\\u05db\\u05d1 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.        \\u05d9\\u05d0. \\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05de\\u05d3\\u05d5\\u05d9\\u05e7 \\u05d1\\u05d9\\u05d5\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea )\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1( \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd .\",\"tender_form_id\":null},\"unique_performance_characteristics_label\":{\"value\":\"\\u05de\\u05d0\\u05e4\\u05d9\\u05d9\\u05e0\\u05d9 \\u05d4\\u05e2\\u05e9\\u05d9\\u05d9\\u05d4 \\u05d4\\u05d9\\u05d9\\u05d7\\u05d5\\u05d3\\u05d9\\u05d9\\u05dd \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3:\",\"tender_form_id\":null},\"unique_performance_characteristics\":{\"value\":\"\\u05d0. \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d5\\u05dc \\u05e7\\u05d4\\u05dc \\u05d5\\u05e2\\u05dd \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d1\\u05e4\\u05e8\\u05d8.                        \\u05d1. \\u05d9\\u05d9\\u05e6\\u05d5\\u05d2\\u05d9\\u05d5\\u05ea.                        \\u05d2. \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05dc\\u05d7\\u05d9\\u05d9 \\u05d0\\u05d3\\u05dd.                        \\u05d3. \\u05e1\\u05de\\u05db\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea.                        \\u05d4. \\u05e1\\u05d3\\u05e8 \\u05d5\\u05d0\\u05e8\\u05d2\\u05d5\\u05df.                        \\u05d5. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05e2\\u05d1\\u05d5\\u05d3 \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d1\\u05dc\\u05ea\\u05d9 \\u05e9\\u05d2\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05e1\\u05d5\\u05e4\\u05d9 \\u05e9\\u05d1\\u05d5\\u05e2 \\u05d5\\u05d1\\u05d7\\u05d5\\u05dc \\u05d4\\u05de\\u05d5\\u05e2\\u05d3.                        \\u05d6. \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d0\\u05d5\\u05de\\u05e6\\u05ea \\u05d1\\u05de\\u05e6\\u05d1\\u05d9 \\u05d7\\u05d9\\u05e8\\u05d5\\u05dd \\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05d9\\u05dd \\u05d5\\u05dc\\u05d0\\u05d5\\u05de\\u05d9\\u05d9\\u05dd.                        \\u05d7. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e0\\u05d9\\u05d9\\u05d3\\u05d5\\u05ea \\u05d5\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05ea\\u05d5\\u05e7\\u05e3 )\\u05d7\\u05d5\\u05d1\\u05d4( \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05d1\\u05e6\\u05e2 \\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d1\\u05de\\u05e1\\u05d2\\u05e8\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3.                        \\u05d8. \\u05d0\\u05de\\u05d9\\u05e0\\u05d5\\u05ea \\u05d5\\u05d9\\u05d5\\u05e9\\u05e8\\u05d4.                        \\u05d9. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05d1\\u05e6\\u05d5\\u05d5\\u05ea \\u05e2\\u05dd \\u05d2\\u05d5\\u05e8\\u05de\\u05d9 \\u05e4\\u05e0\\u05d9\\u05dd \\u05d5\\u05d7\\u05d5\\u05e5.                        \\u05d9\\u05d0. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d1\\u05e9\\u05d2\\u05e8\\u05d4 \\u05d5\\u05d1\\u05d7\\u05d9\\u05e8\\u05d5\\u05dd.                        \\u05d9\\u05d1. \\u05e9\\u05dc\\u05d9\\u05d8\\u05d4 \\u05d1\\u05e9\\u05e4\\u05d4 \\u05d4\\u05e2\\u05d1\\u05e8\\u05d9\\u05ea \\u05d1\\u05e8\\u05de\\u05d4 \\u05d8\\u05d5\\u05d1\\u05d4.\",\"tender_form_id\":null},\"criminal_record_label\":{\"value\":\"\\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9:\",\"tender_form_id\":null},\"criminal_record\":{\"value\":\"\\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d5\\u05ea \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9\\u05d5\\u05ea \\u05d0\\u05d5 \\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 15 \\u05d1 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4.                        \\u2022 \\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d4 \\u05d1\\u05e2\\u05d1\\u05d9\\u05e8\\u05ea \\u05de\\u05d9\\u05df ,\\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d7\\u05d5\\u05e7 \\u05dc\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05e2\\u05e1\\u05e7\\u05d4 \\u05e9\\u05dc \\u05e2\\u05d1\\u05e8\\u05d9\\u05d9\\u05e0\\u05d9 \\u05de\\u05d9\\u05df \\u05d1\\u05de\\u05d5\\u05e1\\u05d3\\u05d5\\u05ea                        \\u05de\\u05e1\\u05d5\\u05d9\\u05de\\u05d9\\u05dd , \\u05ea\\u05e9\\u05e1\\\"\\u05d0 2001- .\",\"tender_form_id\":null},\"knowledge_and_education_1_label\":{\"value\":\"\\u05d9\\u05d3\\u05e2 \\u05d5\\u05d4\\u05e9\\u05db\\u05dc\\u05d41:\",\"tender_form_id\":null},\"knowledge_and_education_1\":{\"value\":\"12 \\u05e9\\u05e0\\u05d5\\u05ea \\u05dc\\u05d9\\u05de\\u05d5\\u05d3 \\u05d0\\u05d5 \\u05ea\\u05e2\\u05d5\\u05d3\\u05ea \\u05d1\\u05d2\\u05e8\\u05d5\\u05ea \\u05de\\u05dc\\u05d0\\u05d4.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc1\",\"edit\":\"emodal_tender_add_cond_doc1\"}},\"professional_courses_and_trainings_2_label\":{\"value\":\"\\u05e7\\u05d5\\u05e8\\u05e1\\u05d9\\u05dd \\u05d5\\u05d4\\u05db\\u05e9\\u05e8\\u05d5\\u05ea \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05d5\\u05ea:2\",\"tender_form_id\":null},\"professional_courses_and_trainings_2\":{\"value\":\"\\u05d0. \\u05e7\\u05d5\\u05e8\\u05e1 \\u05dc\\u05e0\\u05d4\\u05d2\\u05d9 \\u05e8\\u05db\\u05d1 \\u05e6\\u05d9\\u05d1\\u05d5\\u05e8\\u05d9 \\u05e9\\u05dc \\u05de\\u05e9\\u05e8\\u05d3 \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4.                        \\u05d1. \\u05d4\\u05e9\\u05ea\\u05dc\\u05de\\u05d5\\u05ea \\u05dc\\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 84 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc2\",\"edit\":\"emodal_tender_add_cond_doc2\"}},\"professional_experience_3_label\":{\"value\":\"\\u05e0\\u05e1\\u05d9\\u05d5\\u05df \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d93:\",\"tender_form_id\":null},\"professional_experience_3\":{\"value\":\"\\u05e0\\u05d3\\u05e8\\u05e9 \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05e9\\u05dc \\u05e9\\u05e0\\u05ea\\u05d9\\u05d9\\u05dd \\u05dc\\u05e4\\u05d7\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05db\\u05e0\\u05d4\\u05d2 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc3\",\"edit\":\"emodal_tender_add_cond_doc3\"}},\"additional_requirements_4_label\":{\"value\":\"\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05e0\\u05d5\\u05e1\\u05e4\\u05d5\\u05ea4:\",\"tender_form_id\":null},\"additional_requirements_4\":{\"value\":\"\\u05e0\\u05d3\\u05e8\\u05e9 \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05e9\\u05dc \\u05e9\\u05e0\\u05ea\\u05d9\\u05d9\\u05dd \\u05dc\\u05e4\\u05d7\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05db\\u05e0\\u05d4\\u05d2 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc4\",\"edit\":\"emodal_tender_add_cond_doc4\"}},\"application_requirements_label\":{\"value\":\"\\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d2\\u05e9\\u05ea \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea \\u05d7\\u05d5\\u05d1\\u05d4 \\u05dc\\u05d4\\u05d2\\u05d9\\u05e9:\",\"tender_form_id\":null},\"application_requirements\":{\"value\":\"\\u2022 \\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05d0\\u05d9\\u05e9\\u05d9 \\u05dc\\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05d4\\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05dc\\u05d7\\u05e5 \\u05db\\u05d0\\u05df                        \\u2022 \\u05e7\\u05d5\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05d9\\u05dd                        \\u2022 \\u05ea\\u05e2\\u05d5\\u05d3\\u05d5\\u05ea \\u05d4\\u05e9\\u05db\\u05dc\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e9\\u05e8\\u05d4                        \\u2022 \\u05d4\\u05de\\u05dc\\u05e6\\u05d5\\u05ea )\\u05d1\\u05de\\u05d9\\u05d3\\u05d4 \\u05d5\\u05d9\\u05e9(\",\"tender_form_id\":null},\"application_rules1_label\":{\"value\":null,\"tender_form_id\":null},\"application_rules1\":{\"value\":\"\\u05e2\\u05dc \\u05d4\\u05de\\u05e2\\u05d5\\u05e0\\u05d9\\u05d9\\u05e0\\u05d9\\u05dd.\\u05d5\\u05ea \\u05d4\\u05e2\\u05d5\\u05e0\\u05d9\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05dc\\u05d4\\u05e2\\u05d1\\u05d9\\u05e8 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05dc\\u05e2\\u05d9\\u05dc, \\u05d1\\u05d0\\u05d5\\u05e4\\u05df                    \\u05de\\u05e1\\u05d5\\u05d3\\u05e8 \\u05d5\\u05e7\\u05e8\\u05d9\\u05d0 , \\u05d5\\u05d6\\u05d0\\u05ea \\u05dc\\u05d0 \\u05d9\\u05d0\\u05d5\\u05d7\\u05e8 \\u05de\\u05d9\\u05d5\\u05dd 07\\/09\\/2024 \\u05d1\\u05d0\\u05de\\u05e6\\u05e2\\u05d5\\u05ea \\u05d4\\u05d2\\u05e9\\u05d4 \\u05dc\\u05de\\u05d9\\u05d9\\u05dc:\\r\\n\\u05dc\\u05e4\\u05e7\\u05e1 08-8500703 \\u05d0\\u05d5 \\u05d1\\u05de\\u05e1\\u05d9\\u05e8\\u05d4 \\u05d9\\u05d3\\u05e0\\u05d9\\u05ea - \\u05dc\\u05d9\\u05d3\\u05d9 \\u05dc\\u05d9\\u05dc\\u05da \\u05e4\\u05e8\\u05e1\\u05e7\\u05d5 \\u05de\\u05e0\\u05d4\\u05dc\\u05ea \\u05d4\\u05d4\\u05d5\\u05df \\u05d4\\u05d0\\u05e0\\u05d5\\u05e9\\u05d9 \\u05d1\\u05de\\u05e9\\u05e8\\u05d3\\u05d9 \\u05de\\u05d5\\u05e2\\u05e6\\u05d4                \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d7\\u05d5\\u05e3 \\u05d4\\u05db\\u05e8\\u05de\\u05dc, \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05ea \\u05d4\\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea\\r\\n\\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd.\\u05d5\\u05ea \\u05e9\\u05dc\\u05d0 \\u05d9\\u05d2\\u05d9\\u05e9\\u05d5 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05d1\\u05de\\u05dc\\u05d5\\u05d0\\u05dd \\u05db\\u05d0\\u05de\\u05d5\\u05e8 \\u05dc\\u05e2\\u05d9\\u05dc \\u05d5\\u05d1\\u05de\\u05d5\\u05e2\\u05d3 \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2,                    \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea\\u05dd.\\u05df \\u05dc\\u05d0 \\u05ea\\u05d9\\u05d1\\u05d3\\u05e7 \\u05d5\\u05d4\\u05d9\\u05d0 \\u05ea\\u05e4\\u05e1\\u05dc \\u05e2\\u05dc \\u05d4\\u05e1\\u05e3.\\r\\n\\u05db\\u05dc \\u05de\\u05e7\\u05d5\\u05dd \\u05d1\\u05d5 \\u05de\\u05e4\\u05d5\\u05e8\\u05d8 \\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05d1\\u05dc\\u05e9\\u05d5\\u05df \\u05d6\\u05db\\u05e8, \\u05d4\\u05db\\u05d5\\u05d5\\u05e0\\u05d4 \\u05d2\\u05dd \\u05dc\\u05dc\\u05e9\\u05d5\\u05df \\u05e0\\u05e7\\u05d1\\u05d4, \\u05d5\\u05db\\u05df \\u05dc\\u05d4\\u05d9\\u05e4\\u05da                \\u05d4\\u05d0\\u05e8\\u05d2\\u05d5\\u05df \\u05e0\\u05db\\u05d5\\u05df \\u05dc\\u05d1\\u05e6\\u05e2 \\u05d4\\u05ea\\u05d0\\u05de\\u05d5\\u05ea \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05e9\\u05dc\\u05d1 \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05e2\\u05d5\\u05d1\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea.                \\u05d1\\u05d5\\u05d5\\u05e2\\u05d3\\u05d4 \\u05ea\\u05d9\\u05e0\\u05ea\\u05df \\u05e2\\u05d3\\u05d9\\u05e4\\u05d5\\u05ea \\u05dc\\u05d4\\u05e2\\u05e1\\u05e7\\u05ea\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea \\u05de\\u05e9\\u05de\\u05e2\\u05d5\\u05ea\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05e1\\u05e2\\u05d9\\u05e3                9\\u05d2)\\u05d2()1( \\u05dc\\u05d7\\u05d5\\u05e7 \\u05e9\\u05d5\\u05d5\\u05d9\\u05d5\\u05df \\u05d6\\u05db\\u05d5\\u05d9\\u05d5\\u05ea \\u05dc\\u05d0\\u05e0\\u05e9\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea, \\u05ea\\u05e9\\u05e0\\\"\\u05d71998- \\u05d0\\u05e9\\u05e8 \\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05d4\\u05dd \\u05d3\\u05d5\\u05de\\u05d9\\u05dd                \\u05dc\\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd.\",\"tender_form_id\":null},\"application_rules2_label\":{\"value\":null,\"tender_form_id\":null},\"application_rules2\":{\"value\":null,\"tender_form_id\":null},\"application_rules3_label\":{\"value\":null,\"tender_form_id\":null},\"application_rules3\":{\"value\":null,\"tender_form_id\":null},\"application_rules4_label\":{\"value\":null,\"tender_form_id\":null},\"application_rules4\":{\"value\":null,\"tender_form_id\":null}}', 'template_name', '1');
INSERT INTO `templates` (`id`, `name`, `status`, `value`, `name_of_form_name`, `blade_file`) VALUES
(5, 'תבנית חדשה לבדיקה', 0, '{\"header_title\":{\"value\":\"\\u05de\\u05db\\u05e8\\u05d6 \\u05db\\\"\\u05d0 24.24 \\u05dc\\u05de\\u05e9\\u05e8\\u05ea \\u05e0\\u05d4\\u05d2\\u05d9.\\u05d5\\u05ea \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"date\":{\"value\":null,\"tender_form_id\":null},\"template_name\":{\"value\":\"\\u05ea\\u05d1\\u05e0\\u05d9\\u05ea \\u05d7\\u05d3\\u05e9\\u05d4 \\u05dc\\u05d1\\u05d3\\u05d9\\u05e7\\u05d4\",\"tender_form_id\":null},\"workplace_label\":{\"value\":\"\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4\",\"tender_form_id\":null},\"workplace\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05e6\\u05d4 \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d9\\u05d5\\u05d0\\u05d1 (\\u05dc\\u05d9\\u05d3 \\u05d2\\u05d3\\u05e8\\u05d4)100\",\"tender_form_id\":null},\"position_label\":{\"value\":\"\\u05d4\\u05e7\\u05e3 \\u05de\\u05e9\\u05e8\\u05d4\",\"tender_form_id\":null},\"position\":{\"value\":\"100\",\"tender_form_id\":null},\"wage_label\":{\"value\":\"\\u05e9\\u05db\\u05e8\",\"tender_form_id\":null},\"wage\":{\"value\":\"\\u05de\\u05d9\\u05e0\\u05d4\\u05dc\\u05d9 7-10\",\"tender_form_id\":null},\"subordination_label\":{\"value\":\"\\u05db\\u05e4\\u05d9\\u05e4\\u05d5\\u05ea\",\"tender_form_id\":null},\"subordination\":{\"value\":\"\\u05dc\\u05de\\u05e0\\u05d4\\u05dc \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4, \\u05de\\u05d5\\u05e0\\u05d7\\u05d4 \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05ea \\u05e2\\\"\\u05d9 \\u05e7\\u05e6\\u05d9\\u05df \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d1\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4 5\",\"tender_form_id\":\"subordinations\"},\"starting_work_label\":{\"value\":\"\\u05ea\\u05d7\\u05d9\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4\",\"tender_form_id\":null},\"starting_work\":{\"value\":\"\\u05de\\u05d9\\u05d9\\u05d3\\u05d9\",\"tender_form_id\":null},\"job_description_label\":{\"value\":\"\\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3\",\"tender_form_id\":null},\"job_description\":{\"value\":\"\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d4\\u05e9\\u05d9\\u05d9\\u05da \\u05dc\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05d0\\u05d5 \\u05de\\u05e9\\u05de\\u05e9 \\u05d0\\u05d5\\u05ea\\u05d4 \\u05d5\\u05d4\\u05e4\\u05e2\\u05dc\\u05ea\\u05d5 \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.\",\"tender_form_id\":null},\"main_areas_of_responsibility_label\":{\"value\":\"\\u05ea\\u05d7\\u05d5\\u05de\\u05d9 \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05e2\\u05d9\\u05e7\\u05e8\\u05d9\\u05d9\\u05dd\",\"tender_form_id\":null},\"main_areas_of_responsibility\":{\"value\":\"1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea. 2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea. .3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus_label\":{\"value\":\".1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus\":{\"value\":\"\\u05d0. \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d8\\u05d5\\u05d7\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e7\\u05e4\\u05d3\\u05d4 \\u05e2\\u05dc \\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d5\\u05d4\\u05d4\\u05e4\\u05e1\\u05e7\\u05d5\\u05ea \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2\\u05d5 \\u05d1\\u05d3\\u05d9\\u05df. \\u05d1. \\u05e0\\u05e7\\u05d9\\u05d8\\u05ea \\u05d0\\u05de\\u05e6\\u05e2\\u05d9 \\u05d6\\u05d4\\u05d9\\u05e8\\u05d5\\u05ea, \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d1\\u05d8\\u05d7\\u05ea \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd. \\u05d2. \\u05e7\\u05d9\\u05d5\\u05dd \\u05e1\\u05d3\\u05e8\\u05d9 \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d5\\u05d1\\u05d3\\u05d9\\u05e7\\u05d5\\u05ea \\u05dc\\u05d0\\u05d9\\u05ea\\u05d5\\u05e8 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd \\u05d7\\u05e9\\u05d5\\u05d3\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd. \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea. \\u05d4. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d0\\u05d3\\u05d9\\u05d1 \\u05d5\\u05de\\u05e0\\u05d5\\u05de\\u05e1 \\u05dc\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd .\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings_label\":{\"value\":\".2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings\":{\"value\":\"\\u05d0. \\u05d4\\u05ea\\u05e7\\u05e0\\u05ea \\u05e9\\u05d9\\u05dc\\u05d5\\u05d8, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d5\\u05de\\u05d0\\u05d7\\u05d5\\u05e8\\u05d9 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05e2\\u05dc\\u05d9\\u05d5 \\u05db\\u05d9\\u05ea\\u05d5\\u05d1 \\u05d1\\u05d5\\u05dc\\u05d8 \\\"\\u05d4\\u05e1\\u05e2\\u05d5\\u05ea \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd\\\". \\u05d1. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d9\\u05e9\\u05d9\\u05d1\\u05ea \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4 \\u05d5\\u05e2\\u05dc \\u05d4\\u05d9\\u05d5\\u05ea\\u05dd \\u05d7\\u05d2\\u05d5\\u05e8\\u05d9\\u05dd \\u05d1\\u05d7\\u05d2\\u05d5\\u05e8\\u05d5\\u05ea \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05de\\u05e1\\u05e4\\u05e8 \\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4. \\u05d2. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d4\\u05de\\u05ea\\u05e8\\u05d7\\u05e9 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05d5\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05ea\\u05e0\\u05d4\\u05d2\\u05d5\\u05ea \\u05dc\\u05d0 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea\\u05d9\\u05ea. \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea )\\u05d1\\u05d9\\u05df \\u05d0\\u05dd \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d6\\u05e2\\u05d9\\u05e8 \\u05d0\\u05d5 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1) \\u05d1\\u05ea\\u05d7\\u05e0\\u05d5\\u05ea \\u05d4\\u05e1\\u05e2\\u05d4 \\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea \\u05d5\\u05de\\u05d5\\u05e1\\u05d3\\u05e8\\u05d5\\u05ea \\u05de\\u05e8\\u05d0\\u05e9, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05dc\\u05ea \\u05e4\\u05e0\\u05e1\\u05d9 \\u05d0\\u05d9\\u05ea\\u05d5\\u05ea \\u05de\\u05d4\\u05d1\\u05d4\\u05d1\\u05d9\\u05dd \\u05d1\\u05db\\u05dc \\u05e2\\u05ea \\u05e9\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05e4\\u05ea\\u05d5\\u05d7\\u05d5\\u05ea. \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05d4 \\u05db\\u05d9 \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d9\\u05e8\\u05d3\\u05d5 \\u05de\\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d5\\u05d4\\u05ea\\u05e8\\u05d7\\u05e7\\u05d5 \\u05de\\u05e0\\u05ea\\u05d9\\u05d1 \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d4\\u05de\\u05e9\\u05da \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4. \\u05d5. \\u05e1\\u05e8\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05ea\\u05d5\\u05dd \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05d5\\u05d5\\u05d3\\u05d0 \\u05e9\\u05dc\\u05d0 \\u05e0\\u05d5\\u05ea\\u05e8\\u05d5 \\u05d1\\u05d5 \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd.\",\"tender_form_id\":null},\"bus_safety_and_soundness_label\":{\"value\":\".3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"bus_safety_and_soundness\":{\"value\":\"\\u05d0. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05de\\u05e2\\u05e8\\u05db\\u05d5\\u05ea\\u05d9\\u05d5 \\u05d4\\u05d4\\u05d9\\u05d3\\u05e8\\u05d0\\u05d5\\u05dc\\u05d9\\u05d5\\u05ea \\u05d5\\u05d4\\u05de\\u05db\\u05e0\\u05d9\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d4\\u05d9\\u05e6\\u05d9\\u05d0\\u05d4 \\u05dc\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d5\\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2\\u05df )\\u05db\\u05d2\\u05d5\\u05df: \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05e9\\u05de\\u05df, \\u05de\\u05d9\\u05dd, \\u05e6\\u05de\\u05d9\\u05d2\\u05d9\\u05dd, \\u05d1\\u05dc\\u05de\\u05d9\\u05dd, \\u05de\\u05d2\\u05d1\\u05d9\\u05dd, \\u05de\\u05e2\\u05e8\\u05db\\u05ea \\u05d4\\u05d7\\u05e9\\u05de\\u05dc \\u05d5\\u05d4\\u05d0\\u05d5\\u05e8\\u05d5\\u05ea, \\u05e4\\u05e2\\u05d5\\u05dc\\u05d5\\u05ea \\u05d4\\u05e4\\u05ea\\u05d9\\u05d7\\u05d4 \\u05d5\\u05d4\\u05e1\\u05d2\\u05d9\\u05e8\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d5\\u05db\\u05d9\\u05d5\\u05e6\\\"\\u05d1). \\u05d1. \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d9\\u05dd \\u05e7\\u05dc\\u05d9\\u05dd \\u05d4\\u05d3\\u05e8\\u05d5\\u05e9\\u05d9\\u05dd \\u05dc\\u05d0\\u05d7\\u05d6\\u05e7\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05d3\\u05d9\\u05d5\\u05d5\\u05d7 \\u05dc\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea \\u05d0\\u05d5 \\u05dc\\u05d9\\u05e7\\u05d5\\u05d9\\u05d9\\u05dd \\u05e9\\u05d4\\u05ea\\u05d2\\u05dc\\u05d5. \\u05d2. \\u05d4\\u05e2\\u05d1\\u05e8\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4. \\u05d3. \\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05e4\\u05e8\\u05d8\\u05d9 \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea \\u05d1\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1. \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05d0\\u05d7\\u05e8 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d5 \\u05d1\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e0\\u05d4\\u05dc\\u05d9\\u05dd \\u05d5\\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 . \\u05d5. \\u05d6\\u05d9\\u05d5\\u05d5\\u05d3 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05e2\\u05d6\\u05e8 )\\u05de\\u05d8\\u05e3, \\u05de\\u05e9\\u05d5\\u05dc\\u05e9, \\u05e2\\u05d6\\u05e8\\u05d4 \\u05e8\\u05d0\\u05e9\\u05d5\\u05e0\\u05d4, \\u05d0\\u05e4\\u05d5\\u05d3 \\u05d6\\u05d5\\u05d4\\u05e8 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1). \\u05d6. \\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05ea\\u05d5\\u05e7\\u05e4\\u05dd \\u05e9\\u05dc \\u05de\\u05e1\\u05de\\u05db\\u05d9 \\u05d4\\u05e8\\u05db\\u05d1 )\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05d4\\u05e8\\u05db\\u05d1, \\u05d1\\u05d9\\u05d8\\u05d5\\u05d7 \\u05d7\\u05d5\\u05d1\\u05d4 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1( \\u05d5\\u05d4\\u05d9\\u05de\\u05e6\\u05d0\\u05d5\\u05ea\\u05dd \\u05d1\\u05e8\\u05db\\u05d1 \\u05d1\\u05d6\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4. \\u05d7. \\u05ea\\u05d3\\u05dc\\u05d5\\u05e7 \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d7\\u05e0\\u05d9\\u05d9\\u05ea\\u05d5 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05d5\\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea. \\u05d8. \\u05e9\\u05d8\\u05d9\\u05e4\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05e0\\u05d5 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05df \\u05e1\\u05d1\\u05d9\\u05e8 \\u05de\\u05d1\\u05d7\\u05d5\\u05e5 \\u05d5\\u05d7\\u05d9\\u05d8\\u05d5\\u05d9 \\u05d0\\u05d7\\u05ea \\u05dc\\u05e9\\u05e0\\u05d4. \\u05d9. \\u05d4\\u05d7\\u05d6\\u05e8\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d1\\u05e1\\u05d9\\u05d5\\u05dd \\u05d9\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05dc\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e8\\u05d9\\u05db\\u05d5\\u05d6 \\u05e9\\u05dc \\u05e8\\u05db\\u05d1 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea. \\u05d9\\u05d0. \\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05de\\u05d3\\u05d5\\u05d9\\u05e7 \\u05d1\\u05d9\\u05d5\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea )\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1( \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd .\",\"tender_form_id\":null},\"unique_performance_characteristics_label\":{\"value\":\"\\u05de\\u05d0\\u05e4\\u05d9\\u05d9\\u05e0\\u05d9 \\u05d4\\u05e2\\u05e9\\u05d9\\u05d9\\u05d4 \\u05d4\\u05d9\\u05d9\\u05d7\\u05d5\\u05d3\\u05d9\\u05d9\\u05dd \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3:\",\"tender_form_id\":null},\"unique_performance_characteristics\":{\"value\":\"\\u05d0. \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d5\\u05dc \\u05e7\\u05d4\\u05dc \\u05d5\\u05e2\\u05dd \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d1\\u05e4\\u05e8\\u05d8. \\u05d1. \\u05d9\\u05d9\\u05e6\\u05d5\\u05d2\\u05d9\\u05d5\\u05ea. \\u05d2. \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05dc\\u05d7\\u05d9\\u05d9 \\u05d0\\u05d3\\u05dd. \\u05d3. \\u05e1\\u05de\\u05db\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea. \\u05d4. \\u05e1\\u05d3\\u05e8 \\u05d5\\u05d0\\u05e8\\u05d2\\u05d5\\u05df. \\u05d5. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05e2\\u05d1\\u05d5\\u05d3 \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d1\\u05dc\\u05ea\\u05d9 \\u05e9\\u05d2\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05e1\\u05d5\\u05e4\\u05d9 \\u05e9\\u05d1\\u05d5\\u05e2 \\u05d5\\u05d1\\u05d7\\u05d5\\u05dc \\u05d4\\u05de\\u05d5\\u05e2\\u05d3. \\u05d6. \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d0\\u05d5\\u05de\\u05e6\\u05ea \\u05d1\\u05de\\u05e6\\u05d1\\u05d9 \\u05d7\\u05d9\\u05e8\\u05d5\\u05dd \\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05d9\\u05dd \\u05d5\\u05dc\\u05d0\\u05d5\\u05de\\u05d9\\u05d9\\u05dd. \\u05d7. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e0\\u05d9\\u05d9\\u05d3\\u05d5\\u05ea \\u05d5\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05ea\\u05d5\\u05e7\\u05e3 )\\u05d7\\u05d5\\u05d1\\u05d4( \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05d1\\u05e6\\u05e2 \\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d1\\u05de\\u05e1\\u05d2\\u05e8\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3. \\u05d8. \\u05d0\\u05de\\u05d9\\u05e0\\u05d5\\u05ea \\u05d5\\u05d9\\u05d5\\u05e9\\u05e8\\u05d4. \\u05d9. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05d1\\u05e6\\u05d5\\u05d5\\u05ea \\u05e2\\u05dd \\u05d2\\u05d5\\u05e8\\u05de\\u05d9 \\u05e4\\u05e0\\u05d9\\u05dd \\u05d5\\u05d7\\u05d5\\u05e5. \\u05d9\\u05d0. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d1\\u05e9\\u05d2\\u05e8\\u05d4 \\u05d5\\u05d1\\u05d7\\u05d9\\u05e8\\u05d5\\u05dd. \\u05d9\\u05d1. \\u05e9\\u05dc\\u05d9\\u05d8\\u05d4 \\u05d1\\u05e9\\u05e4\\u05d4 \\u05d4\\u05e2\\u05d1\\u05e8\\u05d9\\u05ea \\u05d1\\u05e8\\u05de\\u05d4 \\u05d8\\u05d5\\u05d1\\u05d4.\",\"tender_form_id\":null},\"criminal_record_label\":{\"value\":\"\\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9:\",\"tender_form_id\":null},\"criminal_record\":{\"value\":\"\\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d5\\u05ea \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9\\u05d5\\u05ea \\u05d0\\u05d5 \\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 15 \\u05d1 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4. \\u2022 \\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d4 \\u05d1\\u05e2\\u05d1\\u05d9\\u05e8\\u05ea \\u05de\\u05d9\\u05df ,\\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d7\\u05d5\\u05e7 \\u05dc\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05e2\\u05e1\\u05e7\\u05d4 \\u05e9\\u05dc \\u05e2\\u05d1\\u05e8\\u05d9\\u05d9\\u05e0\\u05d9 \\u05de\\u05d9\\u05df \\u05d1\\u05de\\u05d5\\u05e1\\u05d3\\u05d5\\u05ea \\u05de\\u05e1\\u05d5\\u05d9\\u05de\\u05d9\\u05dd , \\u05ea\\u05e9\\u05e1\\\"\\u05d0 2001- .\",\"tender_form_id\":null},\"knowledge_and_education_1_label\":{\"value\":\"\\u05d9\\u05d3\\u05e2 \\u05d5\\u05d4\\u05e9\\u05db\\u05dc\\u05d41:\",\"tender_form_id\":null},\"knowledge_and_education_1\":{\"value\":\"\\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d4\\u05e9\\u05db\\u05dc\\u05d4\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc1\",\"edit\":\"emodal_tender_add_cond_doc1\"}},\"professional_courses_and_trainings_2_label\":{\"value\":\"\\u05e7\\u05d5\\u05e8\\u05e1\\u05d9\\u05dd \\u05d5\\u05d4\\u05db\\u05e9\\u05e8\\u05d5\\u05ea \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05d5\\u05ea:2\",\"tender_form_id\":null},\"professional_courses_and_trainings_2\":{\"value\":\"\\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05e7\\u05d5\\u05e8\\u05e1\\u05d9\\u05dd \\u05d5\\u05d4\\u05db\\u05e9\\u05e8\\u05d5\\u05ea \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05d5\\u05ea\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc2\",\"edit\":\"emodal_tender_add_cond_doc2\"}},\"professional_experience_3_label\":{\"value\":\"\\u05e0\\u05e1\\u05d9\\u05d5\\u05df \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d93:\",\"tender_form_id\":null},\"professional_experience_3\":{\"value\":\"\\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc3\",\"edit\":\"emodal_tender_add_cond_doc3\"}},\"additional_requirements_4_label\":{\"value\":\"\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05e0\\u05d5\\u05e1\\u05e4\\u05d5\\u05ea4:\",\"tender_form_id\":null},\"additional_requirements_4\":{\"value\":\"\\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05e0\\u05d5\\u05e1\\u05e4\\u05d5\\u05ea\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc4\",\"edit\":\"emodal_tender_add_cond_doc4\"}},\"application_requirements_label\":{\"value\":\"\\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d2\\u05e9\\u05ea \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea \\u05d7\\u05d5\\u05d1\\u05d4 \\u05dc\\u05d4\\u05d2\\u05d9\\u05e9:\",\"tender_form_id\":null},\"application_requirements\":{\"value\":\"\\u2022 \\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05d0\\u05d9\\u05e9\\u05d9 \\u05dc\\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05d4\\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05dc\\u05d7\\u05e5 \\u05db\\u05d0\\u05df \\u2022 \\u05e7\\u05d5\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05d9\\u05dd \\u2022 \\u05ea\\u05e2\\u05d5\\u05d3\\u05d5\\u05ea \\u05d4\\u05e9\\u05db\\u05dc\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e9\\u05e8\\u05d4 \\u2022 \\u05d4\\u05de\\u05dc\\u05e6\\u05d5\\u05ea )\\u05d1\\u05de\\u05d9\\u05d3\\u05d4 \\u05d5\\u05d9\\u05e9(\",\"tender_form_id\":null},\"application_rules1\":{\"value\":\"\\u05e2\\u05dc \\u05d4\\u05de\\u05e2\\u05d5\\u05e0\\u05d9\\u05d9\\u05e0\\u05d9\\u05dd.\\u05d5\\u05ea \\u05d4\\u05e2\\u05d5\\u05e0\\u05d9\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05dc\\u05d4\\u05e2\\u05d1\\u05d9\\u05e8 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05dc\\u05e2\\u05d9\\u05dc, \\u05d1\\u05d0\\u05d5\\u05e4\\u05df\\r\\n                    \\u05de\\u05e1\\u05d5\\u05d3\\u05e8 \\u05d5\\u05e7\\u05e8\\u05d9\\u05d0 , \\u05d5\\u05d6\\u05d0\\u05ea \\u05dc\\u05d0 \\u05d9\\u05d0\\u05d5\\u05d7\\u05e8 \\u05de\\u05d9\\u05d5\\u05dd 07\\/09\\/2024 \\u05d1\\u05d0\\u05de\\u05e6\\u05e2\\u05d5\\u05ea \\u05d4\\u05d2\\u05e9\\u05d4 \\u05dc\\u05de\\u05d9\\u05d9\\u05dc:\",\"tender_form_id\":null},\"application_rules2\":{\"value\":\"\\u05dc\\u05e4\\u05e7\\u05e1 08-8500703 \\u05d0\\u05d5 \\u05d1\\u05de\\u05e1\\u05d9\\u05e8\\u05d4 \\u05d9\\u05d3\\u05e0\\u05d9\\u05ea - \\u05dc\\u05d9\\u05d3\\u05d9 \\u05dc\\u05d9\\u05dc\\u05da \\u05e4\\u05e8\\u05e1\\u05e7\\u05d5 \\u05de\\u05e0\\u05d4\\u05dc\\u05ea \\u05d4\\u05d4\\u05d5\\u05df \\u05d4\\u05d0\\u05e0\\u05d5\\u05e9\\u05d9 \\u05d1\\u05de\\u05e9\\u05e8\\u05d3\\u05d9 \\u05de\\u05d5\\u05e2\\u05e6\\u05d4\\r\\n                \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d7\\u05d5\\u05e3 \\u05d4\\u05db\\u05e8\\u05de\\u05dc, \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05ea \\u05d4\\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea\",\"tender_form_id\":null},\"application_rules3\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd.\\u05d5\\u05ea \\u05e9\\u05dc\\u05d0 \\u05d9\\u05d2\\u05d9\\u05e9\\u05d5 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05d1\\u05de\\u05dc\\u05d5\\u05d0\\u05dd \\u05db\\u05d0\\u05de\\u05d5\\u05e8 \\u05dc\\u05e2\\u05d9\\u05dc \\u05d5\\u05d1\\u05de\\u05d5\\u05e2\\u05d3 \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2,\\r\\n                    \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea\\u05dd.\\u05df \\u05dc\\u05d0 \\u05ea\\u05d9\\u05d1\\u05d3\\u05e7 \\u05d5\\u05d4\\u05d9\\u05d0 \\u05ea\\u05e4\\u05e1\\u05dc \\u05e2\\u05dc \\u05d4\\u05e1\\u05e3.\",\"tender_form_id\":null},\"application_rules4\":{\"value\":\"\\u05db\\u05dc \\u05de\\u05e7\\u05d5\\u05dd \\u05d1\\u05d5 \\u05de\\u05e4\\u05d5\\u05e8\\u05d8 \\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05d1\\u05dc\\u05e9\\u05d5\\u05df \\u05d6\\u05db\\u05e8, \\u05d4\\u05db\\u05d5\\u05d5\\u05e0\\u05d4 \\u05d2\\u05dd \\u05dc\\u05dc\\u05e9\\u05d5\\u05df \\u05e0\\u05e7\\u05d1\\u05d4, \\u05d5\\u05db\\u05df \\u05dc\\u05d4\\u05d9\\u05e4\\u05da\\r\\n                \\u05d4\\u05d0\\u05e8\\u05d2\\u05d5\\u05df \\u05e0\\u05db\\u05d5\\u05df \\u05dc\\u05d1\\u05e6\\u05e2 \\u05d4\\u05ea\\u05d0\\u05de\\u05d5\\u05ea \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05e9\\u05dc\\u05d1 \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05e2\\u05d5\\u05d1\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea.\\r\\n                \\u05d1\\u05d5\\u05d5\\u05e2\\u05d3\\u05d4 \\u05ea\\u05d9\\u05e0\\u05ea\\u05df \\u05e2\\u05d3\\u05d9\\u05e4\\u05d5\\u05ea \\u05dc\\u05d4\\u05e2\\u05e1\\u05e7\\u05ea\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea \\u05de\\u05e9\\u05de\\u05e2\\u05d5\\u05ea\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05e1\\u05e2\\u05d9\\u05e3\\r\\n                9\\u05d2)\\u05d2()1( \\u05dc\\u05d7\\u05d5\\u05e7 \\u05e9\\u05d5\\u05d5\\u05d9\\u05d5\\u05df \\u05d6\\u05db\\u05d5\\u05d9\\u05d5\\u05ea \\u05dc\\u05d0\\u05e0\\u05e9\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea, \\u05ea\\u05e9\\u05e0\\\"\\u05d71998- \\u05d0\\u05e9\\u05e8 \\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05d4\\u05dd \\u05d3\\u05d5\\u05de\\u05d9\\u05dd\\r\\n                \\u05dc\\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd.\",\"tender_form_id\":null}}', 'template_name', '1');
INSERT INTO `templates` (`id`, `name`, `status`, `value`, `name_of_form_name`, `blade_file`) VALUES
(6, 'מכרז לבדיקת בוקר אחרונה', 0, '{\"header_title\":{\"value\":\"\\u05de\\u05db\\u05e8\\u05d6 \\u05db\\\"\\u05d0 24.24 \\u05dc\\u05de\\u05e9\\u05e8\\u05ea \\u05e0\\u05d4\\u05d2\\u05d9.\\u05d5\\u05ea \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"date\":{\"value\":null,\"tender_form_id\":null},\"template_name\":{\"value\":\"\\u05de\\u05db\\u05e8\\u05d6 \\u05dc\\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d1\\u05d5\\u05e7\\u05e8 \\u05d0\\u05d7\\u05e8\\u05d5\\u05e0\\u05d4\",\"tender_form_id\":null},\"workplace_label\":{\"value\":\"\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4  1001\",\"tender_form_id\":null},\"workplace\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05e6\\u05d4 \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d9\\u05d5\\u05d0\\u05d1 (\\u05dc\\u05d9\\u05d3 \\u05d2\\u05d3\\u05e8\\u05d4)10000\",\"tender_form_id\":null},\"position_label\":{\"value\":\"\\u05d4\\u05e7\\u05e3 \\u05de\\u05e9\\u05e8\\u05d4   200\",\"tender_form_id\":null},\"position\":{\"value\":\"150%\",\"tender_form_id\":null},\"wage_label\":{\"value\":\"\\u05e9\\u05db\\u05e8 333\",\"tender_form_id\":null},\"wage\":{\"value\":\"\\u05de\\u05d9\\u05e0\\u05d4\\u05dc\\u05d9 7-10\",\"tender_form_id\":null},\"subordination_label\":{\"value\":\"\\u05db\\u05e4\\u05d9\\u05e4\\u05d5\\u05ea 444\",\"tender_form_id\":null},\"subordination\":{\"value\":\"\\u05dc\\u05de\\u05e0\\u05d4\\u05dc \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4, \\u05de\\u05d5\\u05e0\\u05d7\\u05d4 \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05ea \\u05e2\\\"\\u05d9 \\u05e7\\u05e6\\u05d9\\u05df \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d1\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4 5\",\"tender_form_id\":\"subordinations\"},\"starting_work_label\":{\"value\":\"\\u05ea\\u05d7\\u05d9\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 555\",\"tender_form_id\":null},\"starting_work\":{\"value\":\"\\u05de\\u05d9\\u05d9\\u05d3\\u05d9\",\"tender_form_id\":null},\"job_description_label\":{\"value\":\"\\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 66\",\"tender_form_id\":null},\"job_description\":{\"value\":\"\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d4\\u05e9\\u05d9\\u05d9\\u05da \\u05dc\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05d0\\u05d5 \\u05de\\u05e9\\u05de\\u05e9 \\u05d0\\u05d5\\u05ea\\u05d4 \\u05d5\\u05d4\\u05e4\\u05e2\\u05dc\\u05ea\\u05d5 \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.\",\"tender_form_id\":null},\"main_areas_of_responsibility_label\":{\"value\":\"\\u05ea\\u05d7\\u05d5\\u05de\\u05d9 \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05e2\\u05d9\\u05e7\\u05e8\\u05d9\\u05d9\\u05dd\",\"tender_form_id\":null},\"main_areas_of_responsibility\":{\"value\":\"1 \\u05d4\\u05e1\\u05e2\\u05ea \\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e6\\u05e8\\u05db\\u05d9 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea.2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea. .3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus_label\":{\"value\":\"\\u05db\\u05d5\\u05ea\\u05e8\\u05ea \\u05dc\\u05d1\\u05d3\\u05d9\\u05e7\\u05d4\",\"tender_form_id\":null},\"transportation_of_passengers_by_bus\":{\"value\":\"\\u05d0. \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05d8\\u05d5\\u05d7\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e7\\u05e4\\u05d3\\u05d4 \\u05e2\\u05dc \\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d5\\u05d4\\u05d4\\u05e4\\u05e1\\u05e7\\u05d5\\u05ea \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2\\u05d5 \\u05d1\\u05d3\\u05d9\\u05df. \\u05d1. \\u05e0\\u05e7\\u05d9\\u05d8\\u05ea \\u05d0\\u05de\\u05e6\\u05e2\\u05d9 \\u05d6\\u05d4\\u05d9\\u05e8\\u05d5\\u05ea, \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d1\\u05d8\\u05d7\\u05ea \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd. \\u05d2. \\u05e7\\u05d9\\u05d5\\u05dd \\u05e1\\u05d3\\u05e8\\u05d9 \\u05d1\\u05d9\\u05d8\\u05d7\\u05d5\\u05df \\u05d5\\u05d1\\u05d3\\u05d9\\u05e7\\u05d5\\u05ea \\u05dc\\u05d0\\u05d9\\u05ea\\u05d5\\u05e8 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd \\u05d7\\u05e9\\u05d5\\u05d3\\u05d9\\u05dd, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05d4\\u05d3\\u05d9\\u05df \\u05d4\\u05e7\\u05d9\\u05d9\\u05dd. \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea. \\u05d4. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d0\\u05d3\\u05d9\\u05d1 \\u05d5\\u05de\\u05e0\\u05d5\\u05de\\u05e1 \\u05dc\\u05e0\\u05d5\\u05e1\\u05e2\\u05d9\\u05dd .\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings_label\":{\"value\":\".2 \\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05dc\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea \\u05d5\\u05dc\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05d9\\u05d5\\u05ea \\u05de\\u05d8\\u05e2\\u05dd \\u05d4\\u05de\\u05e1\\u05d2\\u05e8\\u05d5\\u05ea \\u05d4\\u05d7\\u05d9\\u05e0\\u05d5\\u05db\\u05d9\\u05d5\\u05ea\",\"tender_form_id\":null},\"transportation_of_students_to_educational_settings\":{\"value\":\"\\u05d0. \\u05d4\\u05ea\\u05e7\\u05e0\\u05ea \\u05e9\\u05d9\\u05dc\\u05d5\\u05d8, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d5\\u05de\\u05d0\\u05d7\\u05d5\\u05e8\\u05d9 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05e2\\u05dc\\u05d9\\u05d5 \\u05db\\u05d9\\u05ea\\u05d5\\u05d1 \\u05d1\\u05d5\\u05dc\\u05d8 \\\"\\u05d4\\u05e1\\u05e2\\u05d5\\u05ea \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd\\\". \\u05d1. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d9\\u05e9\\u05d9\\u05d1\\u05ea \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4 \\u05d5\\u05e2\\u05dc \\u05d4\\u05d9\\u05d5\\u05ea\\u05dd \\u05d7\\u05d2\\u05d5\\u05e8\\u05d9\\u05dd \\u05d1\\u05d7\\u05d2\\u05d5\\u05e8\\u05d5\\u05ea \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05de\\u05e1\\u05e4\\u05e8 \\u05de\\u05e7\\u05d5\\u05de\\u05d5\\u05ea \\u05d4\\u05d9\\u05e9\\u05d9\\u05d1\\u05d4. \\u05d2. \\u05e4\\u05d9\\u05e7\\u05d5\\u05d7 \\u05e2\\u05dc \\u05d4\\u05de\\u05ea\\u05e8\\u05d7\\u05e9 \\u05d1\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05d5\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05ea\\u05e0\\u05d4\\u05d2\\u05d5\\u05ea \\u05dc\\u05d0 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea\\u05d9\\u05ea. \\u05d3. \\u05d4\\u05e2\\u05dc\\u05d0\\u05d4 \\u05d5\\u05d4\\u05d5\\u05e8\\u05d3\\u05d4 \\u05e9\\u05dc \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd, \\u05e2\\u05dc \\u05e4\\u05d9 \\u05db\\u05dc\\u05dc\\u05d9 \\u05d4\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea )\\u05d1\\u05d9\\u05df \\u05d0\\u05dd \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d6\\u05e2\\u05d9\\u05e8 \\u05d0\\u05d5 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1) \\u05d1\\u05ea\\u05d7\\u05e0\\u05d5\\u05ea \\u05d4\\u05e1\\u05e2\\u05d4 \\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea \\u05d5\\u05de\\u05d5\\u05e1\\u05d3\\u05e8\\u05d5\\u05ea \\u05de\\u05e8\\u05d0\\u05e9, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05dc\\u05ea \\u05e4\\u05e0\\u05e1\\u05d9 \\u05d0\\u05d9\\u05ea\\u05d5\\u05ea \\u05de\\u05d4\\u05d1\\u05d4\\u05d1\\u05d9\\u05dd \\u05d1\\u05db\\u05dc \\u05e2\\u05ea \\u05e9\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05e4\\u05ea\\u05d5\\u05d7\\u05d5\\u05ea. \\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05d4 \\u05db\\u05d9 \\u05d4\\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d9\\u05e8\\u05d3\\u05d5 \\u05de\\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d5\\u05d4\\u05ea\\u05e8\\u05d7\\u05e7\\u05d5 \\u05de\\u05e0\\u05ea\\u05d9\\u05d1 \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4, \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d4\\u05de\\u05e9\\u05da \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4. \\u05d5. \\u05e1\\u05e8\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05ea\\u05d5\\u05dd \\u05d4\\u05d4\\u05e1\\u05e2\\u05d4, \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05d5\\u05d5\\u05d3\\u05d0 \\u05e9\\u05dc\\u05d0 \\u05e0\\u05d5\\u05ea\\u05e8\\u05d5 \\u05d1\\u05d5 \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d0\\u05d5 \\u05d7\\u05e4\\u05e6\\u05d9\\u05dd.\",\"tender_form_id\":null},\"bus_safety_and_soundness_label\":{\"value\":\".3 \\u05d8\\u05d9\\u05e4\\u05d5\\u05dc \\u05d1\\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1\",\"tender_form_id\":null},\"bus_safety_and_soundness\":{\"value\":\"\\u05d0. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05ea\\u05e7\\u05d9\\u05e0\\u05d5\\u05ea \\u05de\\u05e2\\u05e8\\u05db\\u05d5\\u05ea\\u05d9\\u05d5 \\u05d4\\u05d4\\u05d9\\u05d3\\u05e8\\u05d0\\u05d5\\u05dc\\u05d9\\u05d5\\u05ea \\u05d5\\u05d4\\u05de\\u05db\\u05e0\\u05d9\\u05d5\\u05ea \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd \\u05dc\\u05e4\\u05e0\\u05d9 \\u05d4\\u05d9\\u05e6\\u05d9\\u05d0\\u05d4 \\u05dc\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d5\\u05d1\\u05de\\u05d4\\u05dc\\u05da \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2\\u05df )\\u05db\\u05d2\\u05d5\\u05df: \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05e9\\u05de\\u05df, \\u05de\\u05d9\\u05dd, \\u05e6\\u05de\\u05d9\\u05d2\\u05d9\\u05dd, \\u05d1\\u05dc\\u05de\\u05d9\\u05dd, \\u05de\\u05d2\\u05d1\\u05d9\\u05dd, \\u05de\\u05e2\\u05e8\\u05db\\u05ea \\u05d4\\u05d7\\u05e9\\u05de\\u05dc \\u05d5\\u05d4\\u05d0\\u05d5\\u05e8\\u05d5\\u05ea, \\u05e4\\u05e2\\u05d5\\u05dc\\u05d5\\u05ea \\u05d4\\u05e4\\u05ea\\u05d9\\u05d7\\u05d4 \\u05d5\\u05d4\\u05e1\\u05d2\\u05d9\\u05e8\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d3\\u05dc\\u05ea\\u05d5\\u05ea \\u05d5\\u05db\\u05d9\\u05d5\\u05e6\\\"\\u05d1). \\u05d1. \\u05d1\\u05d9\\u05e6\\u05d5\\u05e2 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d9\\u05dd \\u05e7\\u05dc\\u05d9\\u05dd \\u05d4\\u05d3\\u05e8\\u05d5\\u05e9\\u05d9\\u05dd \\u05dc\\u05d0\\u05d7\\u05d6\\u05e7\\u05d4 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05d5\\u05d3\\u05d9\\u05d5\\u05d5\\u05d7 \\u05dc\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea \\u05d0\\u05d5 \\u05dc\\u05d9\\u05e7\\u05d5\\u05d9\\u05d9\\u05dd \\u05e9\\u05d4\\u05ea\\u05d2\\u05dc\\u05d5. \\u05d2. \\u05d4\\u05e2\\u05d1\\u05e8\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4. \\u05d3. \\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05e4\\u05e8\\u05d8\\u05d9 \\u05ea\\u05e7\\u05dc\\u05d5\\u05ea \\u05d1\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1.\\u05d4. \\u05d1\\u05d3\\u05d9\\u05e7\\u05ea \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05dc\\u05d0\\u05d7\\u05e8 \\u05ea\\u05d9\\u05e7\\u05d5\\u05e0\\u05d5 \\u05d1\\u05de\\u05d5\\u05e1\\u05da \\u05d4\\u05de\\u05d5\\u05e8\\u05e9\\u05d4 \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05e0\\u05d4\\u05dc\\u05d9\\u05dd \\u05d5\\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 . \\u05d5. \\u05d6\\u05d9\\u05d5\\u05d5\\u05d3 \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1 \\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05d1\\u05d8\\u05d9\\u05d7\\u05d5\\u05ea \\u05d5\\u05d1\\u05d0\\u05d1\\u05d9\\u05d6\\u05e8\\u05d9 \\u05e2\\u05d6\\u05e8 )\\u05de\\u05d8\\u05e3, \\u05de\\u05e9\\u05d5\\u05dc\\u05e9, \\u05e2\\u05d6\\u05e8\\u05d4 \\u05e8\\u05d0\\u05e9\\u05d5\\u05e0\\u05d4, \\u05d0\\u05e4\\u05d5\\u05d3 \\u05d6\\u05d5\\u05d4\\u05e8 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1). \\u05d6. \\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05ea\\u05d5\\u05e7\\u05e4\\u05dd \\u05e9\\u05dc \\u05de\\u05e1\\u05de\\u05db\\u05d9 \\u05d4\\u05e8\\u05db\\u05d1 )\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05d4\\u05e8\\u05db\\u05d1, \\u05d1\\u05d9\\u05d8\\u05d5\\u05d7 \\u05d7\\u05d5\\u05d1\\u05d4 \\u05d5\\u05db\\u05d9\\u05d5\\\"\\u05d1( \\u05d5\\u05d4\\u05d9\\u05de\\u05e6\\u05d0\\u05d5\\u05ea\\u05dd \\u05d1\\u05e8\\u05db\\u05d1 \\u05d1\\u05d6\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d4. \\u05d7. \\u05ea\\u05d3\\u05dc\\u05d5\\u05e7 \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d7\\u05e0\\u05d9\\u05d9\\u05ea\\u05d5 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05e0\\u05d7\\u05d9\\u05d5\\u05ea \\u05d4\\u05de\\u05de\\u05d5\\u05e0\\u05d4 \\u05d5\\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea. \\u05d8. \\u05e9\\u05d8\\u05d9\\u05e4\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d5\\u05d5\\u05d9\\u05d3\\u05d5\\u05d0 \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05e0\\u05d5 \\u05e9\\u05dc \\u05d4\\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1, \\u05dc\\u05e8\\u05d1\\u05d5\\u05ea \\u05e0\\u05d9\\u05e7\\u05d9\\u05d5\\u05df \\u05e1\\u05d1\\u05d9\\u05e8 \\u05de\\u05d1\\u05d7\\u05d5\\u05e5 \\u05d5\\u05d7\\u05d9\\u05d8\\u05d5\\u05d9 \\u05d0\\u05d7\\u05ea \\u05dc\\u05e9\\u05e0\\u05d4. \\u05d9. \\u05d4\\u05d7\\u05d6\\u05e8\\u05ea \\u05d4\\u05e8\\u05db\\u05d1 \\u05d1\\u05e1\\u05d9\\u05d5\\u05dd \\u05d9\\u05d5\\u05dd \\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05dc\\u05de\\u05e7\\u05d5\\u05dd \\u05d4\\u05e8\\u05d9\\u05db\\u05d5\\u05d6 \\u05e9\\u05dc \\u05e8\\u05db\\u05d1 \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea. \\u05d9\\u05d0. \\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05de\\u05d3\\u05d5\\u05d9\\u05e7 \\u05d1\\u05d9\\u05d5\\u05de\\u05df \\u05d4\\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea )\\u05db\\u05e8\\u05d8\\u05d9\\u05e1 \\u05d4\\u05e8\\u05db\\u05d1( \\u05e9\\u05dc \\u05d4\\u05e8\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05ea \\u05de\\u05d3\\u05d9 \\u05d9\\u05d5\\u05dd .\",\"tender_form_id\":null},\"unique_performance_characteristics_label\":{\"value\":\"\\u05de\\u05d0\\u05e4\\u05d9\\u05d9\\u05e0\\u05d9 \\u05d4\\u05e2\\u05e9\\u05d9\\u05d9\\u05d4 \\u05d4\\u05d9\\u05d9\\u05d7\\u05d5\\u05d3\\u05d9\\u05d9\\u05dd \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3:\",\"tender_form_id\":null},\"unique_performance_characteristics\":{\"value\":\"\\u05d0. \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d5\\u05dc \\u05e7\\u05d4\\u05dc \\u05d5\\u05e2\\u05dd \\u05d9\\u05dc\\u05d3\\u05d9\\u05dd \\u05d1\\u05e4\\u05e8\\u05d8. \\u05d1. \\u05d9\\u05d9\\u05e6\\u05d5\\u05d2\\u05d9\\u05d5\\u05ea. \\u05d2. \\u05d0\\u05d7\\u05e8\\u05d9\\u05d5\\u05ea \\u05dc\\u05d7\\u05d9\\u05d9 \\u05d0\\u05d3\\u05dd. \\u05d3. \\u05e1\\u05de\\u05db\\u05d5\\u05ea\\u05d9\\u05d5\\u05ea. \\u05d4. \\u05e1\\u05d3\\u05e8 \\u05d5\\u05d0\\u05e8\\u05d2\\u05d5\\u05df. \\u05d5. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05e2\\u05d1\\u05d5\\u05d3 \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d1\\u05dc\\u05ea\\u05d9 \\u05e9\\u05d2\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05e1\\u05d5\\u05e4\\u05d9 \\u05e9\\u05d1\\u05d5\\u05e2 \\u05d5\\u05d1\\u05d7\\u05d5\\u05dc \\u05d4\\u05de\\u05d5\\u05e2\\u05d3. \\u05d6. \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05de\\u05d0\\u05d5\\u05de\\u05e6\\u05ea \\u05d1\\u05de\\u05e6\\u05d1\\u05d9 \\u05d7\\u05d9\\u05e8\\u05d5\\u05dd \\u05de\\u05e7\\u05d5\\u05de\\u05d9\\u05d9\\u05dd \\u05d5\\u05dc\\u05d0\\u05d5\\u05de\\u05d9\\u05d9\\u05dd. \\u05d7. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e0\\u05d9\\u05d9\\u05d3\\u05d5\\u05ea \\u05d5\\u05e8\\u05d9\\u05e9\\u05d9\\u05d5\\u05df \\u05e0\\u05d4\\u05d9\\u05d2\\u05d4 \\u05d1\\u05ea\\u05d5\\u05e7\\u05e3 )\\u05d7\\u05d5\\u05d1\\u05d4( \\u05d5\\u05e0\\u05db\\u05d5\\u05e0\\u05d5\\u05ea \\u05dc\\u05d1\\u05e6\\u05e2 \\u05e0\\u05e1\\u05d9\\u05e2\\u05d5\\u05ea \\u05d1\\u05de\\u05e1\\u05d2\\u05e8\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3.\\u05d8. \\u05d0\\u05de\\u05d9\\u05e0\\u05d5\\u05ea \\u05d5\\u05d9\\u05d5\\u05e9\\u05e8\\u05d4. \\u05d9. \\u05d9\\u05db\\u05d5\\u05dc\\u05ea \\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05d1\\u05e6\\u05d5\\u05d5\\u05ea \\u05e2\\u05dd \\u05d2\\u05d5\\u05e8\\u05de\\u05d9 \\u05e4\\u05e0\\u05d9\\u05dd \\u05d5\\u05d7\\u05d5\\u05e5. \\u05d9\\u05d0. \\u05de\\u05ea\\u05df \\u05e9\\u05d9\\u05e8\\u05d5\\u05ea \\u05d1\\u05e9\\u05d2\\u05e8\\u05d4 \\u05d5\\u05d1\\u05d7\\u05d9\\u05e8\\u05d5\\u05dd. \\u05d9\\u05d1. \\u05e9\\u05dc\\u05d9\\u05d8\\u05d4 \\u05d1\\u05e9\\u05e4\\u05d4 \\u05d4\\u05e2\\u05d1\\u05e8\\u05d9\\u05ea \\u05d1\\u05e8\\u05de\\u05d4 \\u05d8\\u05d5\\u05d1\\u05d4.\",\"tender_form_id\":null},\"criminal_record_label\":{\"value\":\"\\u05e8\\u05d9\\u05e9\\u05d5\\u05dd \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9:\",\"tender_form_id\":null},\"criminal_record\":{\"value\":\"\\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d5\\u05ea \\u05e4\\u05dc\\u05d9\\u05dc\\u05d9\\u05d5\\u05ea \\u05d0\\u05d5 \\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05ea\\u05d9\\u05d5\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 15 \\u05d1 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4. \\u2022 \\u05d4\\u05d9\\u05e2\\u05d3\\u05e8 \\u05d4\\u05e8\\u05e9\\u05e2\\u05d4 \\u05d1\\u05e2\\u05d1\\u05d9\\u05e8\\u05ea \\u05de\\u05d9\\u05df ,\\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d7\\u05d5\\u05e7 \\u05dc\\u05de\\u05e0\\u05d9\\u05e2\\u05ea \\u05d4\\u05e2\\u05e1\\u05e7\\u05d4 \\u05e9\\u05dc \\u05e2\\u05d1\\u05e8\\u05d9\\u05d9\\u05e0\\u05d9 \\u05de\\u05d9\\u05df \\u05d1\\u05de\\u05d5\\u05e1\\u05d3\\u05d5\\u05ea \\u05de\\u05e1\\u05d5\\u05d9\\u05de\\u05d9\\u05dd , \\u05ea\\u05e9\\u05e1\\\"\\u05d0 2001- .\",\"tender_form_id\":null},\"knowledge_and_education_1_label\":{\"value\":\"\\u05d9\\u05d3\\u05e2 \\u05d5\\u05d4\\u05e9\\u05db\\u05dc\\u05d41:\",\"tender_form_id\":null},\"knowledge_and_education_1\":{\"value\":\"12 \\u05e9\\u05e0\\u05d5\\u05ea \\u05dc\\u05d9\\u05de\\u05d5\\u05d3 \\u05d0\\u05d5 \\u05ea\\u05e2\\u05d5\\u05d3\\u05ea \\u05d1\\u05d2\\u05e8\\u05d5\\u05ea \\u05de\\u05dc\\u05d0\\u05d4.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc1\",\"edit\":\"emodal_tender_add_cond_doc1\"}},\"professional_courses_and_trainings_2_label\":{\"value\":\"\\u05e7\\u05d5\\u05e8\\u05e1\\u05d9\\u05dd \\u05d5\\u05d4\\u05db\\u05e9\\u05e8\\u05d5\\u05ea \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d9\\u05d5\\u05ea:2\",\"tender_form_id\":null},\"professional_courses_and_trainings_2\":{\"value\":\"\\u05d0. \\u05e7\\u05d5\\u05e8\\u05e1 \\u05dc\\u05e0\\u05d4\\u05d2\\u05d9 \\u05e8\\u05db\\u05d1 \\u05e6\\u05d9\\u05d1\\u05d5\\u05e8\\u05d9 \\u05e9\\u05dc \\u05de\\u05e9\\u05e8\\u05d3 \\u05d4\\u05ea\\u05d7\\u05d1\\u05d5\\u05e8\\u05d4. \\u05d1. \\u05d4\\u05e9\\u05ea\\u05dc\\u05de\\u05d5\\u05ea \\u05dc\\u05d4\\u05e1\\u05e2\\u05ea \\u05ea\\u05dc\\u05de\\u05d9\\u05d3\\u05d9\\u05dd \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05ea\\u05e7\\u05e0\\u05d4 84 \\u05dc\\u05ea\\u05e7\\u05e0\\u05d5\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc2\",\"edit\":\"emodal_tender_add_cond_doc2\"}},\"professional_experience_3_label\":{\"value\":\"\\u05e0\\u05e1\\u05d9\\u05d5\\u05df \\u05de\\u05e7\\u05e6\\u05d5\\u05e2\\u05d93:\",\"tender_form_id\":null},\"professional_experience_3\":{\"value\":\"\\u05e0\\u05d3\\u05e8\\u05e9 \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05e9\\u05dc \\u05e9\\u05e0\\u05ea\\u05d9\\u05d9\\u05dd \\u05dc\\u05e4\\u05d7\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05db\\u05e0\\u05d4\\u05d2 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1.\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc3\",\"edit\":\"emodal_tender_add_cond_doc3\"}},\"additional_requirements_4_label\":{\"value\":\"\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05e0\\u05d5\\u05e1\\u05e4\\u05d5\\u05ea4:\",\"tender_form_id\":null},\"additional_requirements_4\":{\"value\":\"\\u05e0\\u05d3\\u05e8\\u05e9 \\u05e0\\u05d9\\u05e1\\u05d9\\u05d5\\u05df \\u05e9\\u05dc \\u05e9\\u05e0\\u05ea\\u05d9\\u05d9\\u05dd \\u05dc\\u05e4\\u05d7\\u05d5\\u05ea \\u05d1\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4 \\u05db\\u05e0\\u05d4\\u05d2 \\u05d0\\u05d5\\u05d8\\u05d5\\u05d1\\u05d5\\u05e1..\",\"tender_form_id\":{\"add\":\"modal_tender_add_cond_doc4\",\"edit\":\"emodal_tender_add_cond_doc4\"}},\"application_requirements_label\":{\"value\":\"\\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d2\\u05e9\\u05ea \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea \\u05d7\\u05d5\\u05d1\\u05d4 \\u05dc\\u05d4\\u05d2\\u05d9\\u05e9:\",\"tender_form_id\":null},\"application_requirements\":{\"value\":\"\\u2022 \\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05d0\\u05d9\\u05e9\\u05d9 \\u05dc\\u05de\\u05d9\\u05dc\\u05d5\\u05d9 \\u05d4\\u05e9\\u05d0\\u05dc\\u05d5\\u05df \\u05dc\\u05d7\\u05e5 \\u05db\\u05d0\\u05df \\u2022 \\u05e7\\u05d5\\u05e8\\u05d5\\u05ea \\u05d7\\u05d9\\u05d9\\u05dd \\u2022 \\u05ea\\u05e2\\u05d5\\u05d3\\u05d5\\u05ea \\u05d4\\u05e9\\u05db\\u05dc\\u05d4 \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05de\\u05e9\\u05e8\\u05d4 \\u2022 \\u05d4\\u05de\\u05dc\\u05e6\\u05d5\\u05ea )\\u05d1\\u05de\\u05d9\\u05d3\\u05d4 \\u05d5\\u05d9\\u05e9(\",\"tender_form_id\":null},\"application_rules1\":{\"value\":\"\\u05e2\\u05dc \\u05d4\\u05de\\u05e2\\u05d5\\u05e0\\u05d9\\u05d9\\u05e0\\u05d9\\u05dd.\\u05d5\\u05ea \\u05d4\\u05e2\\u05d5\\u05e0\\u05d9\\u05dd \\u05dc\\u05d3\\u05e8\\u05d9\\u05e9\\u05d5\\u05ea \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05dc\\u05d4\\u05e2\\u05d1\\u05d9\\u05e8 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05dc\\u05e2\\u05d9\\u05dc, \\u05d1\\u05d0\\u05d5\\u05e4\\u05df\\r\\n                    \\u05de\\u05e1\\u05d5\\u05d3\\u05e8 \\u05d5\\u05e7\\u05e8\\u05d9\\u05d0 , \\u05d5\\u05d6\\u05d0\\u05ea \\u05dc\\u05d0 \\u05d9\\u05d0\\u05d5\\u05d7\\u05e8 \\u05de\\u05d9\\u05d5\\u05dd 07\\/09\\/2024 \\u05d1\\u05d0\\u05de\\u05e6\\u05e2\\u05d5\\u05ea \\u05d4\\u05d2\\u05e9\\u05d4 \\u05dc\\u05de\\u05d9\\u05d9\\u05dc:\",\"tender_form_id\":null},\"application_rules2\":{\"value\":\"\\u05dc\\u05e4\\u05e7\\u05e1 08-8500703 \\u05d0\\u05d5 \\u05d1\\u05de\\u05e1\\u05d9\\u05e8\\u05d4 \\u05d9\\u05d3\\u05e0\\u05d9\\u05ea - \\u05dc\\u05d9\\u05d3\\u05d9 \\u05dc\\u05d9\\u05dc\\u05da \\u05e4\\u05e8\\u05e1\\u05e7\\u05d5 \\u05de\\u05e0\\u05d4\\u05dc\\u05ea \\u05d4\\u05d4\\u05d5\\u05df \\u05d4\\u05d0\\u05e0\\u05d5\\u05e9\\u05d9 \\u05d1\\u05de\\u05e9\\u05e8\\u05d3\\u05d9 \\u05de\\u05d5\\u05e2\\u05e6\\u05d4\\r\\n                \\u05d0\\u05d6\\u05d5\\u05e8\\u05d9\\u05ea \\u05d7\\u05d5\\u05e3 \\u05d4\\u05db\\u05e8\\u05de\\u05dc, \\u05d1\\u05e9\\u05e2\\u05d5\\u05ea \\u05d4\\u05e4\\u05e2\\u05d9\\u05dc\\u05d5\\u05ea \\u05d4\\u05e7\\u05d1\\u05d5\\u05e2\\u05d5\\u05ea\",\"tender_form_id\":null},\"application_rules3\":{\"value\":\"\\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd.\\u05d5\\u05ea \\u05e9\\u05dc\\u05d0 \\u05d9\\u05d2\\u05d9\\u05e9\\u05d5 \\u05d0\\u05ea \\u05db\\u05dc \\u05d4\\u05de\\u05e1\\u05de\\u05db\\u05d9\\u05dd \\u05d4\\u05e0\\u05d3\\u05e8\\u05e9\\u05d9\\u05dd \\u05d1\\u05de\\u05dc\\u05d5\\u05d0\\u05dd \\u05db\\u05d0\\u05de\\u05d5\\u05e8 \\u05dc\\u05e2\\u05d9\\u05dc \\u05d5\\u05d1\\u05de\\u05d5\\u05e2\\u05d3 \\u05e9\\u05e0\\u05e7\\u05d1\\u05e2,\\r\\n                    \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d5\\u05ea\\u05dd.\\u05df \\u05dc\\u05d0 \\u05ea\\u05d9\\u05d1\\u05d3\\u05e7 \\u05d5\\u05d4\\u05d9\\u05d0 \\u05ea\\u05e4\\u05e1\\u05dc \\u05e2\\u05dc \\u05d4\\u05e1\\u05e3.\",\"tender_form_id\":null},\"application_rules4\":{\"value\":\"\\u05db\\u05dc \\u05de\\u05e7\\u05d5\\u05dd \\u05d1\\u05d5 \\u05de\\u05e4\\u05d5\\u05e8\\u05d8 \\u05ea\\u05d9\\u05d0\\u05d5\\u05e8 \\u05d4\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05d1\\u05dc\\u05e9\\u05d5\\u05df \\u05d6\\u05db\\u05e8, \\u05d4\\u05db\\u05d5\\u05d5\\u05e0\\u05d4 \\u05d2\\u05dd \\u05dc\\u05dc\\u05e9\\u05d5\\u05df \\u05e0\\u05e7\\u05d1\\u05d4, \\u05d5\\u05db\\u05df \\u05dc\\u05d4\\u05d9\\u05e4\\u05da\\r\\n                \\u05d4\\u05d0\\u05e8\\u05d2\\u05d5\\u05df \\u05e0\\u05db\\u05d5\\u05df \\u05dc\\u05d1\\u05e6\\u05e2 \\u05d4\\u05ea\\u05d0\\u05de\\u05d5\\u05ea \\u05e2\\u05dc \\u05de\\u05e0\\u05ea \\u05dc\\u05e9\\u05dc\\u05d1 \\u05d1\\u05ea\\u05e4\\u05e7\\u05d9\\u05d3 \\u05e2\\u05d5\\u05d1\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea.\\r\\n                \\u05d1\\u05d5\\u05d5\\u05e2\\u05d3\\u05d4 \\u05ea\\u05d9\\u05e0\\u05ea\\u05df \\u05e2\\u05d3\\u05d9\\u05e4\\u05d5\\u05ea \\u05dc\\u05d4\\u05e2\\u05e1\\u05e7\\u05ea\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea \\u05de\\u05e9\\u05de\\u05e2\\u05d5\\u05ea\\u05d9\\u05ea, \\u05d1\\u05d4\\u05ea\\u05d0\\u05dd \\u05dc\\u05d4\\u05d5\\u05e8\\u05d0\\u05d5\\u05ea \\u05e1\\u05e2\\u05d9\\u05e3\\r\\n                9\\u05d2)\\u05d2()1( \\u05dc\\u05d7\\u05d5\\u05e7 \\u05e9\\u05d5\\u05d5\\u05d9\\u05d5\\u05df \\u05d6\\u05db\\u05d5\\u05d9\\u05d5\\u05ea \\u05dc\\u05d0\\u05e0\\u05e9\\u05d9\\u05dd \\u05e2\\u05dd \\u05de\\u05d5\\u05d2\\u05d1\\u05dc\\u05d5\\u05ea, \\u05ea\\u05e9\\u05e0\\\"\\u05d71998- \\u05d0\\u05e9\\u05e8 \\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05d4\\u05dd \\u05d3\\u05d5\\u05de\\u05d9\\u05dd\\r\\n                \\u05dc\\u05db\\u05d9\\u05e9\\u05d5\\u05e8\\u05d9\\u05dd \\u05e9\\u05dc \\u05de\\u05d5\\u05e2\\u05de\\u05d3\\u05d9\\u05dd \\u05d0\\u05d7\\u05e8\\u05d9\\u05dd.\",\"tender_form_id\":null}}', 'template_name', '1');
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
  `ttype` int(11) DEFAULT 0,
  `is_exist` tinyint(1) NOT NULL,
  `emails` text DEFAULT NULL,
  `brunch` varchar(200) DEFAULT NULL,
  `tender_type` int(11) NOT NULL,
  `tender_status` int(11) NOT NULL DEFAULT 0,
  `has_salary` tinyint(4) NOT NULL DEFAULT 0,
  `salary` int(255) NOT NULL DEFAULT 0,
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
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `template_id`, `start_date`, `finish_date`, `tname`, `generated_id`, `tender_number`, `body`, `status`, `created_date`, `stopped`, `deleted`, `conditions`, `ttype`, `is_exist`, `emails`, `brunch`, `tender_type`, `tender_status`, `has_salary`, `salary`, `additional_salary`, `note`, `job_details`, `functional_level`, `is_test_required`, `is_recommended`, `is_drushim`, `input_manager`, `job_scope`, `subordinations`, `grades_voltage`, `created_by`) VALUES
(1, NULL, '2024-09-22 09:00:00', '2024-09-28 09:00:00', 'asdas', '2024-101', '2024-101', NULL, NULL, '2024-09-22 14:57:42', 0, 1, NULL, 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, 0, 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38),
(2, NULL, '2024-09-23 09:00:00', '2024-09-28 09:00:00', 'fsdf', '2024-102', '2024-102', NULL, NULL, '2024-09-23 11:17:59', 0, 1, 'תואר אקדמי המוכר על ידי המועצה להשכלה גבוהה או שקיבל הכרה מהמחלקה להערכת תארים אקדמיים בחוץ לארץ או תעודת הנדסאי.ת או טכנאי.ת מוסמכ.ת בהתאם לסעיף 39 לחוק ההנדסאים והטכנאים המוסמכים, התשע\"ג-2012. תינתן עדיפות לבעלי.ות תואר אקדמי באחד מהתחומים הבאים: קידום נוער, חינוך בלתי פורמאלי, חינוך, מדעי ההתנהגות והחברה (יובהר כי הניסיון המקצועי שיידרש ממועמדים.ות בעלי.ות תעודת הנדסאי.ת או טכנאי.ת במכרז יידרש מספר רב יותר של שנות ניסיון מקצועי מזה הנדרש במכרז מבעל.ת תואר אקדמי).תנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!תואר אקדמי המוכר על ידי המועצה להשכלה גבוהה או שקיבל הכרה מהמחלקה להערכת תארים אקדמיים בחוץ לארץ או תעודת הנדסאי.ת או טכנאי.ת מוסמכ.ת בהתאם לסעיף 39 לחוק ההנדסאים והטכנאים המוסמכים, התשע\"ג-2012. תינתן עדיפות לבעלי.ות תואר אקדמי באחד מהתחומים הבאים: קידום נוער, חינוך בלתי פורמאלי, חינוך, מדעי ההתנהגות והחברה (יובהר כי הניסיון המקצועי שיידרש ממועמדים.ות בעלי.ות תעודת הנדסאי.ת או טכנאי.ת במכרז יידרש מספר רב יותר של שנות ניסיון מקצועי מזה הנדרש במכרז מבעל.ת תואר אקדמי).=>required', 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, 0, 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38),
(3, NULL, '2024-09-24 09:00:00', '2024-09-28 09:00:00', 'sadasd', '2024-103', '2024-103', NULL, NULL, '2024-09-24 13:07:31', 0, 1, NULL, 1, 0, NULL, 'אגף ביטחון ואכיפה', 4, 0, 0, 0, 0, NULL, '[]', '0', 0, 0, 0, NULL, NULL, NULL, NULL, 38),
(4, NULL, '2024-09-25 03:00:00', '2024-11-20 00:00:00', 'עו\"ס לחוק סדרי דין', '2024-104', '142/2024', NULL, NULL, '2024-09-25 10:33:34', 0, 0, NULL, 2, 0, NULL, 'אגף שירותים חברתיים', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '50%', 'מנהלת האגף לשירותים חברתיים וקהלתיים', 'דירוג העו\"ס - דרגה ע\"פ השכלה', 38),
(5, NULL, '2024-10-06 09:00:00', '2024-12-10 23:59:00', 'מזכיר/ה לבית הספר \'יחד\'', '2024-105', '181/2024', NULL, NULL, '2024-10-06 09:59:19', 0, 0, NULL, 2, 0, NULL, 'אגף חינוך', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת מחלקת בתי ספר יסודיים במועצה', 'דירוג: מנהלי / מח\"ר דרגה: 7-9 / 37-39', 38),
(6, NULL, '2024-10-14 09:00:00', '2024-12-18 23:59:00', 'בודק/ת בקשות להיתר ומידען/ית תכוני/ת', '2024-106', '143/2024', NULL, NULL, '2024-10-14 10:27:42', 0, 0, 'תעודת מהנדס/ת בניין או תואר באדריכלות או תעודת הנדסאי/ת אדריכלות/בנייןתנאי סףיתרון=>השכלה ודרישות מקצועיות!+!+!+!תעודת מהנדס/ת בניין או תואר באדריכלות או תעודת הנדסאי/ת אדריכלות/בניין=>not_required', 2, 0, NULL, 'אגף הנדסה', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת מחלקת רישוי', 'דירוג: הנדסאים/מהנדסים דרגה: 37-41', 38),
(7, NULL, '2024-10-15 09:00:00', '2024-12-10 23:59:00', 'רכז/ת תחזוקת אולמות ספורט למרכז מיר\"ב, שלוחת עתלית', '2024-107', '0000000', NULL, NULL, '2024-10-15 10:19:35', 0, 0, NULL, 2, 0, NULL, 'מחלקת תרבות', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'סמנכ\"לית מרכז מיר\"ב / מנהלת מחלקת הספורט / רכזת שלוחת עתלית', 'דירוג: מנהלי דרגה: 7-9', 38),
(8, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'אם בית', '2024-108', '145/2024', NULL, NULL, '2024-11-03 08:36:33', 0, 0, NULL, 2, 0, NULL, 'הנהלה', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '73%', 'מנכ\"ל המועצה', 'דירוג: מנהלי דרגה: 7-9', 38),
(9, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'רכז/ת השכלה (תוכנית היל\"ה-השכלת יסוד לימודי השלמה)', '2024-109', '144/2024', NULL, NULL, '2024-11-03 08:49:42', 0, 0, NULL, 2, 0, NULL, 'אגף חינוך', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '50%', 'מנהל/ת יחידת קידום נוער', 'דירוג: מח\"ר/חינוך חברה ונוער דרגה: 37-39/ע\"פ השכלה', 38),
(10, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'מהנדס.ת תשתיות ובינוי ליישוב עתלית- העסקה בחשבונית', '2024-110', 'דרושים/ות', NULL, NULL, '2024-11-03 08:53:04', 0, 0, NULL, 2, 0, NULL, 'אגף הנדסה', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 1, 'מהנדס המועצה', '20 שעות שבועיות', 'מהנדס המועצה', 'העסקה בחשבונית', 38),
(11, NULL, '2024-11-03 09:00:00', '2024-11-18 23:59:00', 'עו\"ס מרכז/ת נושא מניעה וטיפול באלימות במשפחה', '2024-111', 'דרושים/ות', NULL, NULL, '2024-11-03 09:17:22', 0, 0, NULL, 2, 0, NULL, 'אגף שירותים חברתיים', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 1, NULL, '75%', 'מנהלת האגף לשירותים חברתיים וקהילתיים או מי שהוסמך/ה על ידה', 'דירוג: עו\"ס     דרגה: על פי השכלה', 38),
(12, NULL, '2024-11-06 09:00:00', '2024-11-20 23:59:00', 'אב בית לבי\"ס במועצה', '2024-112', '000000', NULL, NULL, '2024-11-06 10:10:23', 0, 0, NULL, 2, 0, NULL, 'אגף חינוך', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת מחלקת בתי ספר יסודיים במועצה', 'דירוג: מנהלי דרגה: 7-9', 38),
(13, NULL, '2024-11-06 09:00:00', '2024-11-20 23:59:00', 'פקח/ית  מוניציפאלי/ית ועובד/ת כללי/ת ליישוב עתלית', '2024-113', '000000', NULL, NULL, '2024-11-06 10:14:42', 0, 0, NULL, 2, 0, NULL, 'הנהלה', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנכ\"ל עתלית', 'דירוג: מנהלי דרגה: 7-9', 38),
(14, NULL, '2024-11-25 09:00:00', '2024-12-14 23:59:00', 'מטפל/ת למעון היום בכרם מהר\"ל', '2024-114', '183/2024', NULL, NULL, '2024-11-25 10:43:26', 0, 0, NULL, 2, 0, NULL, 'אגף חינוך', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '50% / 100%', 'מנהלת היחידה לגיל הרך / מנהלת המעון', 'דירוג: מנהלי   דרגה: 7-9', 38),
(15, NULL, '2024-12-02 09:00:00', '2024-12-16 23:59:00', 'מנהל.ת אגף חדשנות ושירות', '2024-115', '0000000', NULL, NULL, '2024-12-02 08:09:29', 0, 0, NULL, 2, 0, NULL, 'הנהלה', 4, 0, 0, 0, 0, NULL, '[]', '0', 0, 0, 0, NULL, '100%', 'מנכ\"ל המועצה', 'שכר בכירים ברמת מנהל.ת אגף 70%-60% משכר מנכ\"ל, מותנה באישור משרד הפנים', 38),
(16, NULL, '2024-12-03 09:00:00', '2024-12-18 23:59:00', 'מנהל.ת מחלקת גני ילדים', '2024-116', '148/2024', NULL, NULL, '2024-12-03 09:51:02', 0, 0, NULL, 2, 0, NULL, 'אגף חינוך', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהלת אגף החינוך', 'דירוג: מנהלי/ות מחלקות חינוך דרגה: 1', 38),
(17, NULL, '2024-12-03 09:00:00', '2024-12-18 23:59:00', 'מנהל/ת יחידת הגיל הרך (לידה עד 3)', '2024-117', '149/2024', NULL, NULL, '2024-12-03 09:54:22', 0, 0, NULL, 2, 0, NULL, 'אגף חינוך', 4, 0, 0, 0, 0, NULL, NULL, '0', 0, 0, 0, NULL, '100%', 'מנהל/ת מחלקת גני ילדים', 'דירוג: חברה ונוער     דרגה: M.A/B.A', 38);

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
  `tender_id` varchar(255) NOT NULL,
  `select_dec` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(110) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(27, 'בדיקה בדיקה', 'test@test.com', '1,2,3,4,6,7', NULL, '$2y$12$FKeNJOM3.bllqSMouICCvONwfHIG37LUAv5F75Y9S58k6W64ZhV0O', NULL, '2024-04-18 06:14:18', '2024-08-27 12:33:16', '1'),
(34, 'חדש חדש', 'new@new.com', '1,2,3,4,6,7', NULL, '$2y$12$psKWIlwIu5OwfkX/3DZr9ecTHRVpNrsGQWWnwoRll82KZd.IIhHWm', NULL, '2024-08-25 05:13:25', '2024-08-25 05:13:25', '1'),
(38, 'ניצן פרנס', 'nitzanp@hcarmel.org.il', '1,2,3,4,5,6,7', NULL, '$2y$12$3TWCj9xLKNBWQanBkC42jOGDj.V/Qq8d4cx3zO3oYUePWuomovKZq', NULL, '2024-09-15 06:41:15', '2024-09-15 06:41:15', '1'),
(39, 'רון מנור', 'ronm@hcarmel.org.il', '1,2,3,4,5,6,7', NULL, '$2y$12$Vbr/sbHVLagR7y0O2oWSHeAEuQZq0D4IbmUqK3.2TN93LrkzeeiRa', NULL, '2024-09-18 01:00:18', '2024-09-18 01:00:18', '1');

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
(221, 39, 'user_role', 'משאבי אנוש');

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

-- --------------------------------------------------------

--
-- Structure for view `app_accepted`
--
DROP TABLE IF EXISTS `app_accepted`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `app_accepted`  AS SELECT count(0) AS `accepted`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE `app_decisions`.`p5_id` <> 0 AND `app_decisions`.`decision_1` * `app_decisions`.`decision_3` <> 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `app_count_pending`
--
DROP TABLE IF EXISTS `app_count_pending`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `app_count_pending`  AS SELECT count(0) AS `pendingcount`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE `app_decisions`.`p1_id` * `app_decisions`.`p2_id` * `app_decisions`.`p3_id` <> 0 AND `app_decisions`.`decision_1` * `app_decisions`.`decision_2` * `app_decisions`.`decision_3` * `app_decisions`.`decision_4` = 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `app_count_val`
--
DROP TABLE IF EXISTS `app_count_val`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `app_count_val`  AS SELECT count(0) AS `ccount`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE (`app_decisions`.`p1_id` * `app_decisions`.`p2_id` * `app_decisions`.`p3_id` OR `app_decisions`.`p5_id` <> 0) <> 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `app_decisions_ext`
--
DROP TABLE IF EXISTS `app_decisions_ext`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `app_decisions_ext`  AS SELECT `app_decisions`.`id` AS `id`, `app_decisions`.`tenderval` AS `tenderval`, `app_decisions`.`p1_id` AS `p1_id`, `app_decisions`.`p2_id` AS `p2_id`, `app_decisions`.`p3_id` AS `p3_id`, `app_decisions`.`p5_id` AS `p5_id`, `app_decisions`.`decision_1` AS `decision_1`, `app_decisions`.`decision_1_a` AS `decision_1_a`, `app_decisions`.`decision_1_b` AS `decision_1_b`, `app_decisions`.`decision_1_comment` AS `decision_1_comment`, `app_decisions`.`decision_2` AS `decision_2`, `app_decisions`.`decision_2_comment` AS `decision_2_comment`, `app_decisions`.`decision_3` AS `decision_3`, `app_decisions`.`decision_3` AS `decision_3_a`, `app_decisions`.`decision_3` AS `decision_3_b`, `app_decisions`.`decision_3_comment` AS `decision_3_comment`, `app_decisions`.`decision_4` AS `decision_4`, `app_decisions`.`decision_4_comment` AS `decision_4_comment`, `app_decisions`.`decision_committee` AS `decision_committee`, `app_decisions`.`email` AS `email`, `app_decisions`.`rejected` AS `rejected`, `app_decisions`.`applicant_name` AS `applicant_name`, `app_decisions`.`generated_dec_id` AS `generated_dec_id`, `app_decisions`.`id_tz` AS `id_tz`, `app_decisions`.`2nd_invitation_rejected` AS `2nd_invitation_rejected`, `app_decisions`.`crdate` AS `crdate`, `app_decisions`.`decision_5` AS `decision_5`, `cnf`.`ccv` AS `decision_6`, `crf`.`ccv` AS `decision_7`, `cnaf`.`ccv` AS `decision_8`, `app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`, `app_decisions`.`invitation_rejected_by_user` AS `invitation_rejected_by_user`, CASE WHEN `app_decisions`.`decision_4` + `app_decisions`.`rejected` = 2 THEN 'Rejected0' WHEN `app_decisions`.`decision_4` = 1 THEN 'Rejected' WHEN `app_decisions`.`rejected_status` = 'fr' THEN 'FinalReject' WHEN `app_decisions`.`rejected_status` = 'fd' THEN 'FailedToJoinCommittee' WHEN `app_decisions`.`invitation_rejected_by_user` = 1 THEN 'RejectedbyUser' WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 'RejUser' WHEN `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 1 THEN 'Committee' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview A' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview B' WHEN `app_decisions`.`decision_2` = 1 THEN 'Rejected due to conditions' WHEN `app_decisions`.`decision_3_a` = 1 THEN 'Accepted A' WHEN `app_decisions`.`decision_3_b` = 1 THEN 'Accepted B' WHEN `app_decisions`.`decision_3` = 1 THEN 'Accepted' WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_1_a` + `app_decisions`.`decision_1_b` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` + `app_decisions`.`decision_committee` = 0 AND `cn_touched_f`.`ccv` is null THEN 'New' WHEN `crf`.`ccv` is not null THEN 'newfiles' WHEN `cnaf`.`ccv` is not null THEN 'Waiting for files' WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 'Waiting' ELSE 'Other' END AS `status` FROM ((((`app_decisions` left join `count_newfiles` `cnf` on(`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `count_rejectedfiles` `crf` on(`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `count_notapproved` `cnaf` on(`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `count_touchedfiles` `cn_touched_f` on(`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `app_rejected`
--
DROP TABLE IF EXISTS `app_rejected`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `app_rejected`  AS SELECT count(0) AS `trejected`, `app_decisions`.`tenderval` AS `tenderval` FROM `app_decisions` WHERE `app_decisions`.`p5_id` <> 0 AND `app_decisions`.`decision_2` + `app_decisions`.`decision_4` <> 0 GROUP BY `app_decisions`.`tenderval` ;

-- --------------------------------------------------------

--
-- Structure for view `count_justaploaded`
--
DROP TABLE IF EXISTS `count_justaploaded`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `count_justaploaded`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 3 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_newfiles`
--
DROP TABLE IF EXISTS `count_newfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `count_newfiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 4 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_notapproved`
--
DROP TABLE IF EXISTS `count_notapproved`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `count_notapproved`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` <> 1 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_rejectedfiles`
--
DROP TABLE IF EXISTS `count_rejectedfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `count_rejectedfiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 2 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_touchedfiles`
--
DROP TABLE IF EXISTS `count_touchedfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `count_touchedfiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` <> 0 AND `apps_file`.`file_name` <> 'form.pdf' GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `count_zerofiles`
--
DROP TABLE IF EXISTS `count_zerofiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `count_zerofiles`  AS SELECT count(0) AS `ccv`, `apps_file`.`app_id` AS `app_id` FROM `apps_file` WHERE `apps_file`.`status` = 0 GROUP BY `apps_file`.`app_id` ;

-- --------------------------------------------------------

--
-- Structure for view `getnewids`
--
DROP TABLE IF EXISTS `getnewids`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `getnewids`  AS SELECT year(`tenders`.`created_date`) AS `year(created_date)`, concat(year(`tenders`.`created_date`),'-',max(`tenders`.`id`) + 101) AS `new` FROM `tenders` GROUP BY year(`tenders`.`created_date`) ;

-- --------------------------------------------------------

--
-- Structure for view `sendcopy_userdecisions`
--
DROP TABLE IF EXISTS `sendcopy_userdecisions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `sendcopy_userdecisions`  AS SELECT `users`.`name` AS `name`, `users`.`email` AS `email`, `user_decisions`.`decisionId` AS `decisionId`, `user_decisions`.`userId` AS `userId` FROM (`users` join `user_decisions` on(`users`.`id` = `user_decisions`.`userId`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tenders_active_files`
--
DROP TABLE IF EXISTS `tenders_active_files`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `tenders_active_files`  AS SELECT `tf`.`id` AS `id`, `tf`.`tender_id` AS `tender_id`, `tf`.`url` AS `url`, `tf`.`file_name` AS `file_name`, `tf`.`file_type` AS `file_type`, `tf`.`status` AS `status`, `tf`.`created_at` AS `created_at`, `tf`.`updated_at` AS `updated_at` FROM `tenders_files` AS `tf` WHERE `tf`.`status` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `tenders_applications`
--
DROP TABLE IF EXISTS `tenders_applications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `tenders_applications`  AS SELECT `cnf`.`ccv` AS `decision_6`, `crf`.`ccv` AS `decision_7`, `cnaf`.`ccv` AS `decision_8`, `cnzf`.`ccv` AS `decision_9`, `cn_touched_f`.`ccv` AS `decision_10`, `tenders`.`generated_id` AS `generated_id`, `tenders`.`start_date` AS `start_date`, `tenders`.`finish_date` AS `finish_date`, `tenders`.`tname` AS `tname`, `tenders`.`status` AS `status`, `tenders`.`is_test_required` AS `is_test_required`, `tenders`.`created_date` AS `created_date`, `app_decisions`.`crdate` AS `crdate`, `app_decisions`.`id` AS `id`, `app_decisions`.`id_tz` AS `id_tz`, `app_decisions`.`tenderval` AS `tenderval`, `app_decisions`.`p1_id` AS `p1_id`, `app_decisions`.`p2_id` AS `p2_id`, `app_decisions`.`p3_id` AS `p3_id`, `app_decisions`.`tender_number` AS `tender_number`, `app_decisions`.`p5_id` AS `p5_id`, `app_decisions`.`decision_1` AS `decision_1`, `app_decisions`.`decision_1_a` AS `decision_1_a`, `app_decisions`.`decision_1_b` AS `decision_1_b`, `app_decisions`.`decision_1_comment` AS `decision_1_comment`, `app_decisions`.`decision_2` AS `decision_2`, `app_decisions`.`decision_2_comment` AS `decision_2_comment`, `app_decisions`.`decision_3` AS `decision_3`, `app_decisions`.`decision_3_a` AS `decision_3_a`, `app_decisions`.`decision_3_b` AS `decision_3_b`, `app_decisions`.`test_result` AS `test_result`, `app_decisions`.`is_star` AS `is_star`, `app_decisions`.`decision_3_comment` AS `decision_3_comment`, `app_decisions`.`decision_4` AS `decision_4`, `app_decisions`.`decision_4_comment` AS `decision_4_comment`, `app_decisions`.`decision_committee` AS `decision_committee`, `app_decisions`.`decision_5` AS `decision_5`, `app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`, `app_decisions`.`email` AS `email`, `app_decisions`.`rejected` AS `rejected`, `app_decisions`.`applicant_name` AS `applicant_name`, `app_decisions`.`generated_dec_id` AS `generated_dec_id`, `app_decisions`.`invitation_rejected_by_user` AS `invitation_rejected_by_user`, CASE WHEN `app_decisions`.`decision_4` + `app_decisions`.`rejected` = 2 THEN 'Rejected0' WHEN `app_decisions`.`decision_4` = 1 THEN 'Rejected' WHEN `app_decisions`.`rejected_status` = 'fr' THEN 'FinalReject' WHEN `app_decisions`.`rejected_status` = 'fd' THEN 'FailedToJoinCommittee' WHEN `app_decisions`.`invitation_rejected_by_user` = 1 THEN 'RejectedbyUser' WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 'RejUser' WHEN `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 1 THEN 'Committee' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview A' WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview B' WHEN `app_decisions`.`decision_2` = 1 THEN 'Rejected due to conditions' WHEN `app_decisions`.`decision_3_a` = 1 THEN 'Accepted A' WHEN `app_decisions`.`decision_3_b` = 1 THEN 'Accepted B' WHEN `app_decisions`.`decision_3` = 1 THEN 'Accepted' WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_1_a` + `app_decisions`.`decision_1_b` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` + `app_decisions`.`decision_committee` = 0 AND `cn_touched_f`.`ccv` is null THEN 'New' WHEN `crf`.`ccv` is not null THEN 'newfiles' WHEN `cnaf`.`ccv` is not null THEN 'Waiting for files' WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 'Waiting' ELSE 'Other' END AS `app_status`, CASE WHEN `app_decisions`.`decision_4` + `app_decisions`.`rejected` = 2 THEN 6 WHEN `app_decisions`.`rejected_status` = 'fr' THEN 16 WHEN `app_decisions`.`rejected_status` = 'fd' THEN 17 WHEN `app_decisions`.`invitation_rejected_by_user` = 1 THEN 15 WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 7 WHEN `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` AND `app_decisions`.`decision_committee` = 1 THEN 10 WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 3 WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 11 WHEN `app_decisions`.`decision_1_a` = 1 AND `app_decisions`.`decision_1_b` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 12 WHEN `app_decisions`.`decision_4` = 1 THEN 4 WHEN `app_decisions`.`decision_3_a` = 1 THEN 13 WHEN `app_decisions`.`decision_3_b` = 1 THEN 14 WHEN `app_decisions`.`decision_3` = 1 THEN 5 WHEN `app_decisions`.`decision_2` = 1 THEN 6 WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_1_a` + `app_decisions`.`decision_1_b` + `app_decisions`.`decision_3_a` + `app_decisions`.`decision_3_b` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` + `app_decisions`.`decision_committee` = 0 AND `cn_touched_f`.`ccv` is null THEN 1 WHEN `crf`.`ccv` is not null THEN 2 WHEN `cnaf`.`ccv` is not null THEN 8 WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_1_a` <> 1 AND `app_decisions`.`decision_1_b` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 9 ELSE 0 END AS `app_statusnum` FROM (((((((`app_decisions` join `tenders` on(`tenders`.`generated_id` = `app_decisions`.`tenderval`)) left join `count_newfiles` `cnf` on(`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `count_rejectedfiles` `crf` on(`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `count_notapproved` `cnaf` on(`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `count_zerofiles` `cnzf` on(`app_decisions`.`p5_id` = `cnzf`.`app_id`)) left join `count_touchedfiles` `cn_touched_f` on(`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) left join `count_justaploaded` on(`app_decisions`.`p5_id` = `count_justaploaded`.`app_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tenders_stat`
--
DROP TABLE IF EXISTS `tenders_stat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `tenders_stat`  AS SELECT `tenders`.`id` AS `id`, `tenders`.`start_date` AS `start_date`, `tenders`.`has_salary` AS `has_salary`, `tenders`.`is_test_required` AS `is_test_required`, `tenders`.`is_recommended` AS `is_recommended`, `tenders`.`is_drushim` AS `is_drushim`, `tenders`.`ttype` AS `ttype`, `tenders`.`brunch` AS `brunch`, `tenders`.`created_by` AS `created_by`, `tenders`.`job_details` AS `job_details`, `tenders`.`functional_level` AS `functional_level`, `tenders`.`input_manager` AS `input_manager`, `tenders`.`tender_number` AS `tender_number`, `tenders`.`job_scope` AS `job_scope`, `tenders`.`subordinations` AS `subordinations`, `tenders`.`grades_voltage` AS `grades_voltage`, `tenders`.`finish_date` AS `finish_date`, `tenders`.`tname` AS `tname`, `tenders`.`template_id` AS `template_id`, `tenders`.`generated_id` AS `generated_id`, `tenders`.`status` AS `status`, `tenders`.`created_date` AS `created_date`, `tenders`.`stopped` AS `stopped`, `tenders`.`deleted` AS `deleted`, `tenders`.`conditions` AS `conditions`, `tenders`.`tender_type` AS `tender_type`, `tenders`.`tender_status` AS `tender_status`, `count`.`ccount` AS `ccount`, `pending`.`pendingcount` AS `pendingcount`, `accepted`.`accepted` AS `accepted`, `rejected`.`trejected` AS `trejected`, `tf`.`file_name` AS `tender_file_name`, `tf`.`url` AS `tender_file_url` FROM (((((`tenders` left join `app_count_val` `count` on(`count`.`tenderval` = `tenders`.`generated_id`)) left join `app_count_pending` `pending` on(`pending`.`tenderval` = `tenders`.`generated_id`)) left join `app_accepted` `accepted` on(`accepted`.`tenderval` = `tenders`.`generated_id`)) left join `app_rejected` `rejected` on(`rejected`.`tenderval` = `tenders`.`generated_id`)) left join `tenders_active_files` `tf` on(`tenders`.`id` = `tf`.`tender_id`)) WHERE `tenders`.`deleted` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `www`
--
DROP TABLE IF EXISTS `www`;

CREATE ALGORITHM=UNDEFINED DEFINER=`db_user`@`%` SQL SECURITY DEFINER VIEW `www`  AS SELECT `app_decisions`.`id` AS `id`, `app_decisions`.`tenderval` AS `tenderval`, `app_decisions`.`p1_id` AS `p1_id`, `app_decisions`.`p2_id` AS `p2_id`, `app_decisions`.`p3_id` AS `p3_id`, `app_decisions`.`p5_id` AS `p5_id`, `app_decisions`.`decision_1` AS `decision_1`, `app_decisions`.`decision_1_comment` AS `decision_1_comment`, `app_decisions`.`decision_2` AS `decision_2`, `app_decisions`.`decision_2_comment` AS `decision_2_comment`, `app_decisions`.`decision_3` AS `decision_3`, `app_decisions`.`decision_3_comment` AS `decision_3_comment`, `app_decisions`.`decision_4` AS `decision_4`, `app_decisions`.`decision_4_comment` AS `decision_4_comment`, `app_decisions`.`decision_committee` AS `decision_committee`, `app_decisions`.`email` AS `email`, `app_decisions`.`rejected` AS `rejected`, `app_decisions`.`applicant_name` AS `applicant_name`, `app_decisions`.`generated_dec_id` AS `generated_dec_id`, `app_decisions`.`id_tz` AS `id_tz`, `app_decisions`.`crdate` AS `crdate`, `app_decisions`.`decision_5` AS `decision_5`, `cnf`.`ccv` AS `decision_6`, `crf`.`ccv` AS `decision_7`, `cnaf`.`ccv` AS `decision_8`, `app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`, CASE WHEN `app_decisions`.`decision_rejectedbyuser` = 1 THEN 'RejUser' WHEN `app_decisions`.`decision_1` + `app_decisions`.`decision_2` + `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_5` = 0 AND `cn_touched_f`.`ccv` is null THEN 'New' WHEN `crf`.`ccv` is not null THEN 'newfiles' WHEN `cnaf`.`ccv` is not null THEN 'Waiting for files' WHEN `cnaf`.`ccv` is null AND `app_decisions`.`decision_1` <> 1 AND `app_decisions`.`decision_2` <> 1 THEN 'Waiting' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` + `app_decisions`.`decision_committee` = 0 THEN 'Interview' WHEN `app_decisions`.`decision_1` = 1 AND `app_decisions`.`decision_2` <> 1 AND `app_decisions`.`decision_3` + `app_decisions`.`decision_4` = 0 AND `app_decisions`.`decision_committee` = 1 THEN 'Committee' WHEN `app_decisions`.`decision_2` = 1 THEN 'Rejected due to conditions' WHEN `app_decisions`.`decision_4` = 1 THEN 'Rejected' WHEN `app_decisions`.`decision_3` = 1 THEN 'Accepted' ELSE 'Other' END AS `status` FROM ((((`app_decisions` left join `count_newfiles` `cnf` on(`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `count_rejectedfiles` `crf` on(`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `count_notapproved` `cnaf` on(`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `count_touchedfiles` `cn_touched_f` on(`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) ;

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `apps_file`
--
ALTER TABLE `apps_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `apps_logs`
--
ALTER TABLE `apps_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `apps_meta`
--
ALTER TABLE `apps_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `app_decisions`
--
ALTER TABLE `app_decisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tenders_files`
--
ALTER TABLE `tenders_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tender_decision`
--
ALTER TABLE `tender_decision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tender_protocol_maker`
--
ALTER TABLE `tender_protocol_maker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tender_user`
--
ALTER TABLE `tender_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `user_decisions`
--
ALTER TABLE `user_decisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tenders`
--
ALTER TABLE `user_tenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
