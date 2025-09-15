-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2025 at 04:01 PM
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
-- Database: `software`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `badge_text` varchar(255) DEFAULT NULL,
  `badge_icon` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `btn1_text` varchar(255) DEFAULT NULL,
  `btn1_url` varchar(255) DEFAULT NULL,
  `btn2_text` varchar(255) DEFAULT NULL,
  `btn2_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Craig Phelps', 'Voluptatum quae volu', 'Ut excepteur exercit', NULL, '2025-09-08 03:34:08', '2025-09-08 03:35:46', '2025-09-08 03:35:46'),
(11, 'Kirestin Rosario', 'Excepteur do ut et a', 'Occaecat voluptatum', NULL, '2025-09-08 03:35:56', '2025-09-08 03:35:56', NULL),
(12, 'আপডেট', 'Aut cupiditate neque', 'Sunt dolor molestiae', 11, '2025-09-08 03:36:29', '2025-09-08 03:38:56', NULL),
(13, 'বাদি', 'Quidem neque animi', 'Doloribus ex ipsum', 11, '2025-09-08 03:43:30', '2025-09-08 03:43:50', '2025-09-08 03:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `post_id`, `category_id`) VALUES
(17, 10, 11),
(18, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `club_intros`
--

CREATE TABLE `club_intros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `bullet_points` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bullet_points`)),
  `btn1_text` varchar(255) DEFAULT NULL,
  `btn1_url` varchar(255) DEFAULT NULL,
  `btn2_text` varchar(255) DEFAULT NULL,
  `btn2_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `status` enum('pending','approved','spam') NOT NULL DEFAULT 'pending',
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `parent_id`, `name`, `email`, `website`, `body`, `status`, `ip`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 9, NULL, 'Neville Mosley', 'cily@mailinator.com', 'https://www.zubutikuli.biz', 'Reprehenderit quasi', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 05:06:40', '2025-09-08 05:06:40'),
(2, 9, NULL, 'Kato Carver', 'peseryquk@mailinator.com', 'https://www.sydepacukil.biz', 'Vitae beatae do ex l', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 05:06:50', '2025-09-08 05:06:50'),
(3, 9, 1, 'Yardley Nixon', 'romugihen@mailinator.com', 'https://www.xyjivadorypok.org.au', 'Quia non veniam qui', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 05:07:04', '2025-09-08 05:07:04'),
(4, 9, 3, 'Lareina William', 'dygo@mailinator.com', 'https://www.zifyjyfyhysu.tv', 'Suscipit autem est', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 05:07:28', '2025-09-08 05:07:28'),
(5, 9, NULL, 'Holly Zimmerman', 'lemil@mailinator.com', 'https://www.biqicefopapocot.com', 'Quis itaque officia', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 05:09:40', '2025-09-08 05:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(180) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Stella Vaughan', 'kaqizuz@mailinator.com', '+1 (815) 895-5268', 'Consequat Ab doloru', 1, '2025-08-31 02:37:44', '2025-08-31 02:39:53'),
(2, 'Maggy Middleton', 'qupipary@mailinator.com', '+1 (848) 711-6408', 'Quaerat ut sit quasi', 1, '2025-08-31 03:27:25', '2025-08-31 04:02:55'),
(3, 'Maggy Middleton', 'qupipary@mailinator.com', '+1 (848) 711-6408', 'Quaerat ut sit quasi', 0, '2025-08-31 03:27:27', '2025-08-31 03:27:27'),
(4, 'Burke Holman', 'gypyby@mailinator.com', '+1 (332) 815-8942', 'Quis cupiditate hic', 0, '2025-08-31 03:27:37', '2025-08-31 03:27:37'),
(5, 'Burke Holman', 'gypyby@mailinator.com', '+1 (332) 815-8942', 'Quis cupiditate hic', 0, '2025-08-31 03:36:38', '2025-08-31 03:36:38'),
(6, 'Macy Mcpherson', 'dona@mailinator.com', '+1 (781) 794-1955', 'Ab modi in mollit se', 0, '2025-08-31 03:36:51', '2025-08-31 03:36:51'),
(7, 'Lara Olsen', 'rusijycih@mailinator.com', '+1 (639) 297-1057', 'Aliquam est sed ill', 0, '2025-08-31 03:38:06', '2025-08-31 03:38:06'),
(8, 'Olivia Potter', 'pakova@mailinator.com', '+1 (339) 293-1238', 'Dignissimos sapiente', 0, '2025-08-31 03:58:05', '2025-08-31 03:58:05'),
(9, 'Micah Preston', 'gaqovulalu@mailinator.com', '+1 (928) 863-5999', 'Commodi esse in est', 1, '2025-08-31 04:02:10', '2025-08-31 04:03:05'),
(10, 'Cecilia Mathews', 'hydum@mailinator.com', '+1 (895) 218-4163', 'Laboriosam dolor et', 1, '2025-08-31 04:05:42', '2025-08-31 04:07:04'),
(11, 'Zenaida Fitzgerald', 'huwubusem@mailinator.com', '+1 (682) 121-9516', 'Nulla rerum consequa', 1, '2025-08-31 04:08:10', '2025-09-06 06:13:47'),
(12, 'Kadeem Velazquez', 'bymy@mailinator.com', '+1 (447) 174-8738', 'Qui repudiandae quib', 0, '2025-08-31 04:09:19', '2025-08-31 04:09:19'),
(13, 'Carter Blake', 'vuva@mailinator.com', '+1 (625) 842-8753', 'Sed est quam anim q', 0, '2025-08-31 04:09:26', '2025-08-31 04:09:26'),
(14, 'Jemima Brennan', 'sykugonika@mailinator.com', '+1 (292) 346-4687', 'Recusandae Tenetur', 0, '2025-08-31 04:09:32', '2025-08-31 04:09:32'),
(15, 'Deborah Yang', 'jafuvasiro@mailinator.com', '+1 (977) 957-6313', 'Elit est quo fugit', 0, '2025-08-31 04:09:40', '2025-08-31 04:09:40'),
(16, 'Oscar Ortega', 'vugigefuc@mailinator.com', '+1 (753) 483-6795', 'Ad dolores sint anim', 0, '2025-08-31 04:10:50', '2025-08-31 04:10:50'),
(17, 'Zane Reyes', 'jesudyqa@mailinator.com', '+1 (839) 833-1534', 'Repudiandae id id do', 1, '2025-08-31 04:13:42', '2025-08-31 04:16:32'),
(18, 'Malachi Hayes', 'cyniwawe@mailinator.com', '+1 (252) 503-2465', 'Ullam beatae sed exp', 0, '2025-08-31 04:19:38', '2025-08-31 04:19:38'),
(19, 'Willa Holt', 'kosonico@mailinator.com', '+1 (189) 342-6212', 'Necessitatibus qui n', 0, '2025-08-31 05:34:51', '2025-08-31 05:34:51'),
(20, 'Richard Rivera', 'wypikyc@mailinator.com', '+1 (876) 188-4121', 'Adipisicing fugiat d', 0, '2025-08-31 05:39:26', '2025-08-31 05:39:26'),
(21, 'Sharon Cervantes', 'vazesatyvo@mailinator.com', '+1 (376) 199-7877', 'Irure rerum dolore d', 0, '2025-08-31 05:40:50', '2025-08-31 05:40:50'),
(23, 'Kaseem Welch', 'zujar@mailinator.com', '+1 (862) 993-7521', 'Nihil corporis asper', 0, '2025-08-31 06:04:27', '2025-08-31 06:04:27'),
(24, 'Urielle Church', 'vahat@mailinator.com', '+1 (399) 359-5185', 'Nesciunt reprehende', 1, '2025-08-31 06:06:54', '2025-08-31 06:14:52'),
(26, 'Ciaran Fischer', 'dywocufav@mailinator.com', '+1 (863) 421-5014', 'Est Nam est beatae n', 0, '2025-09-06 06:00:26', '2025-09-06 06:00:26'),
(27, 'Sigourney Jefferson', 'hixu@mailinator.com', '+1 (493) 691-9091', 'Non accusantium anim', 1, '2025-09-06 06:01:05', '2025-09-06 06:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `full_name_en` varchar(255) DEFAULT NULL,
  `full_name_bn` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `cover_banner` varchar(255) DEFAULT NULL,
  `medical_registration_number` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `current_designation` varchar(255) DEFAULT NULL,
  `institution_name` varchar(255) DEFAULT NULL,
  `image_gallery` varchar(300) DEFAULT NULL,
  `notification_preferences` text DEFAULT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `educational_background` text DEFAULT NULL,
  `certifications_and_fellowships` text DEFAULT NULL,
  `areas_of_interest` text DEFAULT NULL,
  `languages_spoken` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `short_bio` text DEFAULT NULL,
  `personal_website` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `researchgate` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `social_links` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `membership_id` varchar(255) DEFAULT NULL,
  `membership_level` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL,
  `membership_level_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `email_verified_at`, `full_name_en`, `full_name_bn`, `profile_photo`, `cover_banner`, `medical_registration_number`, `specialization`, `current_designation`, `institution_name`, `image_gallery`, `notification_preferences`, `years_of_experience`, `educational_background`, `certifications_and_fellowships`, `areas_of_interest`, `languages_spoken`, `phone`, `location`, `short_bio`, `personal_website`, `linkedin`, `researchgate`, `cv`, `social_links`, `membership_id`, `membership_level`, `created_at`, `updated_at`, `status`, `membership_level_id`) VALUES
(13, 'Ingrid Daugherty', 'nysose@mailinator.com', NULL, 'Paul Blankenship', 'Aileen Wright', 'profile_photo_1757152170.jpg', 'cover_banner_1757152170.jpeg', '840', 'Corporis neque expli', 'Rem sed at aliquip u', 'Macon Cabrera', NULL, NULL, 1999, 'Et velit architecto', 'Eum vel quibusdam de', 'Sint laborum accusam', 'Deleniti rerum harum', '+1 (699) 637-1933', NULL, 'Incididunt minima du', 'https://www.mujy.ca', 'https://www.mujy.ca', 'https://www.mujy.ca', 'cv_1757152170.doc', 'https://www.mujy.ca', '111', 'Consectetur labore d', '2025-09-06 03:49:30', '2025-09-06 06:16:11', 'cancelled', NULL),
(14, 'Maggy Forbes', 'foban@mailinator.com', NULL, 'Bryar Thornton', 'Zahir Pennington', 'profile_photo_1757155115.jpeg', 'cover_banner_1757155115.jpg', '422', 'Non voluptatem assum', 'Quod est duis magni', 'Elijah Davis', NULL, NULL, 1972, 'Eligendi mollit sed', 'Ea totam velit minu', 'Est assumenda sunt c', 'Obcaecati ex repudia', '+1 (975) 235-2041', NULL, 'Velit porro eiusmod', 'https://www.mynipeweqij.co', 'https://www.mynipeweqij.co', 'https://www.mynipeweqij.co', 'cv_1757155115.doc', 'https://www.mynipeweqij.co', '5455', 'ddd', '2025-09-06 04:38:35', '2025-09-06 04:38:35', NULL, NULL),
(15, 'Evelyn Chapman', 'qisideh@mailinator.com', NULL, 'Ramona Fuller', 'Baker Guthrie', 'profile_photo_1757155234.jpg', 'cover_banner_1757155234.jpeg', '507', 'Architecto asperiore', 'Numquam quis sequi r', 'Wilma Foster', NULL, NULL, 1973, 'Saepe dolore asperna', 'Est hic consectetur', 'Impedit necessitati', 'Laudantium rem volu', '+1 (445) 665-3289', NULL, 'Vitae voluptatum eos', 'https://www.mykomydy.in', 'https://www.mykomydy.in', 'https://www.mykomydy.in', 'cv_1757155234.doc', 'https://www.mykomydy.in', '55', 'https://www.mykomydy.in', '2025-09-06 04:40:34', '2025-09-06 04:40:34', NULL, NULL),
(16, 'Brett Lester', 'qyfatad@mailinator.com', NULL, 'Dale Glenn', 'Xavier Patel', 'profile_photo_1757155895.png', 'cover_banner_1757155895.jpeg', '634', 'Animi voluptate ex', 'Amet eius odit iste', 'Louis Shannon', NULL, NULL, 2011, 'Amet excepteur vero', 'Velit officia offici', 'Cupidatat maiores cu', 'Aliquid lorem quod c', '+1 (634) 347-3612', NULL, 'Non ut sunt doloribu', 'https://www.qigeleronacit.in', 'https://www.hydem.me', 'https://www.hydem.me', NULL, 'Ducimus fugit sunt', 'Est minim rem corrup', 'Enim voluptate dolor', '2025-09-06 04:51:35', '2025-09-06 04:51:35', NULL, NULL),
(17, 'Marah Brady', 'qusyf@mailinator.com', NULL, 'Urielle Farrell', 'Porter Mejia', 'profile_photo_1757155976.jpeg', 'cover_banner_1757155976.jpeg', '308', 'Elit ab laboriosam', 'Ullamco aliqua Rati', 'Lysandra Marshall', NULL, NULL, 2009, 'Tempore irure quaer', 'Sit pariatur Est s', 'Modi mollit quia exc', 'Est eveniet omnis s', '+1 (811) 266-3852', NULL, 'Dolor laboris alias', 'https://www.niruduzabe.mobi', 'https://www.niruduzabe.mobi', 'https://www.niruduzabe.mobi', 'cv_1757155976.pdf', 'Sit eum totam saepe', 'Totam voluptate quos', 'Suscipit iusto sit t', '2025-09-06 04:52:56', '2025-09-06 04:52:56', NULL, NULL),
(18, 'Brady Reynolds', 'wumyzoq@mailinator.com', NULL, 'Echo Griffith', 'Madonna Peterson', 'profile_photo_1757156186.png', NULL, '371', 'Deleniti error qui p', 'Quibusdam hic conseq', 'Sylvester Stevenson', NULL, NULL, 2012, 'Suscipit nihil nobis', 'Quis vel culpa sed m', 'Laboriosam optio e', 'Atque dolor fuga Ni', '+1 (756) 202-8637', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-06 04:56:26', '2025-09-06 04:56:26', NULL, NULL),
(19, 'Gay Barnett', 'qutax@mailinator.com', NULL, 'Aurelia Randall', 'Libby Nicholson', 'profile_photo_1757156411.jpeg', 'cover_banner_1757156411.jpeg', '640', 'Autem hic maiores vo', 'Eos obcaecati sed hi', 'Quincy Morrison', NULL, NULL, 2019, 'Voluptate dolore ex', 'Ipsam architecto del', 'Libero maxime unde p', 'Facilis ut commodi c', '+1 (619) 183-3035', NULL, 'Elit ratione offici', 'https://www.xymaqaqurexovif.mobi', 'https://www.xymaqaqurexovif.mobi', 'https://www.xymaqaqurexovif.mobi', NULL, 'Optio corporis temp', 'Ex a est nostrud rep', 'Unde velit odio quo', '2025-09-06 05:00:11', '2025-09-06 05:00:11', NULL, NULL);

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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '866bc961-adcc-439b-8851-52c3bae3dd05', 'database', 'default', '{\"uuid\":\"866bc961-adcc-439b-8851-52c3bae3dd05\",\"displayName\":\"App\\\\Mail\\\\ContactMessageSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ContactMessageSubmitted\\\":3:{s:12:\\\"messageModel\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\ContactMessage\\\";s:2:\\\"id\\\";i:15;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'Symfony\\Component\\Mailer\\Exception\\UnexpectedResponseException: Expected response code \"354\" but got code \"550\", with message \"550 5.7.0 Too many emails per second. Please upgrade your plan https://mailtrap.io/billing/plans/testing\". in D:\\xampp\\htdocs\\software\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php:338\nStack trace:\n#0 D:\\xampp\\htdocs\\software\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(197): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->assertResponseCode(\'550 5.7.0 Too m...\', Array)\n#1 D:\\xampp\\htdocs\\software\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php(118): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'DATA\\r\\n\', Array)\n#2 D:\\xampp\\htdocs\\software\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(219): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'DATA\\r\\n\', Array)\n#3 D:\\xampp\\htdocs\\software\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 D:\\xampp\\htdocs\\software\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(137): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(573): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(335): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#8 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#10 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#11 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#12 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#17 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#18 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#21 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#37 D:\\xampp\\htdocs\\software\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 D:\\xampp\\htdocs\\software\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 D:\\xampp\\htdocs\\software\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 D:\\xampp\\htdocs\\software\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 D:\\xampp\\htdocs\\software\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 D:\\xampp\\htdocs\\software\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 {main}', '2025-08-31 04:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_cards`
--

CREATE TABLE `feature_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `accent_color` varchar(20) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_cards`
--

INSERT INTO `feature_cards` (`id`, `title`, `description`, `icon_class`, `accent_color`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'ভেরিফায়েড কমিউনিটি ও রেফারাল', 'ডাক্তার-টু-ডাক্তার নেটওয়ার্ক, সেকেন্ড ওপিনিয়ন ও ক্রস-সিটি রোগী রেফারাল—দ্রুত ও নিরাপদ।', 'bi-people-fill', '#0000ea', 1, 1, '2025-09-04 15:38:18', '2025-09-04 15:38:18'),
(8, 'প্র্যাকটিস বেনিফিটস ও পার্টনার ডিসকাউন্ট', 'ডায়াগনস্টিক, ফার্মেসি, মেডিকেল ডিভাইস ও ক্লিনিক সফটওয়্যারে এক্সক্লুসিভ রেট।', 'bi-bag-check-fill', '#0ea5a8', 3, 1, '2025-09-04 15:39:30', '2025-09-04 15:39:30'),
(9, 'ডিজিটাল টুলস ও টেলিমেডিসিন', 'ই-প্রেসক্রিপশন, টেলিকনসাল্ট, রিমাইন্ডার ও অ্যানালিটিক্স—প্র্যাকটিস ম্যানেজমেন্ট স্মার্ট।', 'bi-clipboard2-pulse', '#0ea5a8', 4, 1, '2025-09-04 15:40:07', '2025-09-04 15:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `badge_text` varchar(255) DEFAULT NULL,
  `badge_icon` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `btn1_text` varchar(255) DEFAULT NULL,
  `btn1_url` varchar(255) DEFAULT NULL,
  `btn2_text` varchar(255) DEFAULT NULL,
  `btn2_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `title`, `subtitle`, `badge_text`, `badge_icon`, `sort_order`, `btn1_text`, `btn1_url`, `btn2_text`, `btn2_url`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Accusamus dolor fugi', 'Illo velit illum si', 'Sint nulla aut enim', 'Repellendus Et aut', 94, 'Proident iste at co', 'https://www.doqiryduqoca.org.uk', 'Rem est iste quia e', 'https://www.mixabi.co.uk', 'slider_1757018903.JPG', 1, '2025-09-04 14:42:39', '2025-09-04 14:48:23'),
(5, 'Enim quia quas quae', 'Sequi voluptatem No', 'Quis minima quaerat', 'Commodo do consequat', 47, 'Accusamus beatae pro', 'https://www.bytyfehihezev.me.uk', 'Vitae enim ut corrup', 'https://www.livinicoha.co.uk', 'slider_1757018718.JPG', 1, '2025-09-04 14:45:18', '2025-09-04 14:45:18'),
(6, 'Cillum Nam molestiae', 'Exercitation exercit', 'Sunt cumque ut eum', 'Dolorem officia perf', 31, 'Explicabo Fuga Asp', 'https://www.wavupib.in', 'Voluptatibus et eius', 'https://www.wojakarifaboge.org', 'slider_1757018749.JPG', 1, '2025-09-04 14:45:49', '2025-09-04 14:45:49'),
(7, 'Ab iusto dignissimos magna omnis commodo in ut non eius sunt impedit distincti', 'Autem natus eius dolores nostrud sit quae est', 'Magni unde dolor non', 'Est maiores voluptas', 16, 'Consequatur qui veri', 'https://www.nugaveculityzej.cm', 'Earum temporibus ull', 'https://www.qemes.ws', 'slider_1757157532.jpg', 1, '2025-09-06 05:18:37', '2025-09-06 05:18:52'),
(8, 'Rerum voluptatem vitae magnam labore id et tempora esse', 'Rerum est sunt molestiae pariatur Voluptatibus exercitationem ut vel commodi similique pariatur Id placeat sed nisi dicta magni omnis', 'Est eu minima corru', 'Animi quis eum duis', 45, 'Tempor cillum et aut', 'https://www.zyxy.in', 'Officia est eligend', 'https://www.mahug.co.uk', 'slider_1757157751.jpeg', 0, '2025-09-06 05:22:31', '2025-09-06 05:22:31'),
(9, 'Quidem dicta vel maiores repellendus Vel numquam eius harum sunt ad cupidatat m', 'Incididunt molestiae blanditiis ab cupiditate iusto qui reprehenderit fugit quam', 'Est dolorem est ma', 'Consectetur debitis', 49, 'Et sint ut velit qui', 'https://www.civasoq.ws', 'Esse et voluptate pa', 'https://www.ficymamopoqa.com.au', 'slider_1757157769.png', 1, '2025-09-06 05:22:49', '2025-09-06 05:22:49');

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
-- Table structure for table `membership_assignments`
--

CREATE TABLE `membership_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `membership_level_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership_levels`
--

CREATE TABLE `membership_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `duration_days` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_lifetime` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_levels`
--

INSERT INTO `membership_levels` (`id`, `name`, `slug`, `duration_days`, `price`, `is_lifetime`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 'basic', 30, 20.00, 0, '2025-08-25 14:15:08', '2025-08-25 14:15:08'),
(2, 'Premium', 'premium', 365, 30.00, 0, '2025-08-25 14:15:08', '2025-08-25 14:15:08'),
(3, 'Lifetime', 'lifetime', NULL, 40.00, 1, '2025-08-25 14:15:08', '2025-08-25 14:15:08'),
(4, 'Founder', 'founder', NULL, 50.00, 1, '2025-08-25 14:15:08', '2025-08-25 14:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `icon`, `class`, `slug`, `parent_id`, `order`, `created_at`, `updated_at`) VALUES
(7, 'about us', 'Dolor enim consectet', 'Voluptas laborum dol', 'Eveniet itaque dict', NULL, 1, '2025-09-06 03:38:47', '2025-09-07 01:18:07'),
(9, 'Members', NULL, NULL, NULL, NULL, 2, '2025-09-07 01:11:58', '2025-09-07 01:13:28'),
(10, 'Services', NULL, 'nav-link', NULL, NULL, 3, '2025-09-07 01:12:33', '2025-09-07 01:13:22'),
(12, 'Portfolio', NULL, NULL, '/Portfolio', NULL, 4, '2025-09-07 01:14:32', '2025-09-07 01:14:32'),
(13, 'News', NULL, NULL, '/News', NULL, 5, '2025-09-07 01:15:04', '2025-09-07 01:15:04'),
(14, 'Event', NULL, NULL, '/Event', NULL, 6, '2025-09-07 01:16:11', '2025-09-07 01:16:11');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_24_061106_add_type_to_users_talbe', 1),
(6, '2025_08_25_051553_create_settings_table', 2),
(7, '2025_08_25_092716_create_menus_table', 3),
(8, '2025_08_25_120614_add_additional_fields_to_users_table', 4),
(9, '2025_08_25_161931_create_doctors_table', 5),
(10, '2025_08_25_201058_create_membership_levels_table', 6),
(11, '2025_08_25_201110_create_membership_assignments_table', 6),
(12, '2025_08_25_201118_add_membership_level_id_to_doctors_table', 6),
(13, '2025_08_26_040338_create_jobs_table', 7),
(14, '2025_08_31_082757_create_contact_messages_table', 8),
(15, '2025_08_31_122117_create_pages_table', 9),
(17, '2025_09_04_135636_create_cards_table', 11),
(19, '2025_09_04_201751_create_hero_sections_table', 12),
(20, '2025_09_04_211700_create_feature_cards_table', 13),
(21, '2025_09_04_214154_create_club_intros_table', 14),
(22, '2025_09_04_214203_create_president_messages_table', 14),
(23, '2025_09_04_222201_create_faqs_table', 15),
(24, '2025_09_04_223409_create_partners_table', 16),
(25, '2025_09_07_044931_create_newsletter_subscribers_table', 17),
(26, '2025_09_07_054019_create_notices_table', 18),
(27, '2025_09_07_100243_create_categories_table', 19),
(28, '2025_09_07_100251_create_posts_table', 19),
(29, '2025_09_07_100259_create_category_post_table', 19),
(30, '2025_09_08_105948_create_comments_table', 20),
(31, '2025_09_08_111524_create_testimonials_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verify_token` varchar(64) DEFAULT NULL,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `verified_at`, `verify_token`, `unsubscribed_at`, `created_at`, `updated_at`) VALUES
(2, 'hadijaman@gmail.com', '2025-09-06 23:17:57', NULL, NULL, '2025-09-06 23:17:38', '2025-09-06 23:17:57'),
(3, 'rofy@gmail.com', '2025-09-07 02:31:59', NULL, NULL, '2025-09-07 02:31:05', '2025-09-07 02:31:59'),
(4, 'admin@gmail.com', NULL, 'gkWQ2yKaoKWU3yeUiu2EiUKEoAgErdN4naDxLigW', NULL, '2025-09-08 03:26:12', '2025-09-08 03:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(3, 'Tenetur qui perferen', 'Enim vero delectus', '2025-09-06 23:45:09', '2025-09-06 23:45:09'),
(4, 'Sed voluptas exercit', 'Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore Quis enim inventore', '2025-09-06 23:48:08', '2025-09-06 23:48:08'),
(5, 'Enim consectetur ea', 'Eum aliquip voluptas', '2025-09-06 23:49:59', '2025-09-06 23:49:59'),
(6, 'Sequi voluptas sunt', 'Quo culpa veniam di', '2025-09-06 23:50:11', '2025-09-06 23:50:11'),
(7, 'Ipsa et et reprehen', 'Unde natus non a cum', '2025-09-06 23:50:18', '2025-09-06 23:50:18'),
(8, 'Sit natus quas bland', 'Inventore impedit f', '2025-09-06 23:50:37', '2025-09-06 23:50:37'),
(9, 'Molestiae reiciendis', 'Doloribus incididunt', '2025-09-06 23:50:46', '2025-09-06 23:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `featured_image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `featured_image`, `meta_title`, `meta_description`, `meta_keywords`, `published_at`, `created_at`, `updated_at`) VALUES
(2, 'update', 'In incidunt et quo', NULL, 'published', 'uploads/pages/page_1756643493.png', 'Obcaecati aut ullamc', 'Omnis perspiciatis', 'Cum magni consectetu', '2000-09-22 09:55:00', '2025-08-31 06:31:33', '2025-08-31 06:35:04'),
(3, 'Alias et suscipit te', 'Autem quisquam dolor', 'Sed porro pariatur', 'draft', NULL, 'Ut nesciunt volupta', 'Et voluptatibus blan', 'Harum architecto do', '1988-12-01 11:24:00', '2025-08-31 06:40:10', '2025-08-31 06:40:10'),
(4, 'Ut pariatur Omnis o', 'Autem quia accusanti', 'Veniam laborum repr', 'draft', 'uploads/pages/page_1756644025.png', 'Adipisci molestiae e', 'Similique aut qui no', 'Est sed repellendus', '1996-12-22 09:19:00', '2025-08-31 06:40:25', '2025-08-31 06:40:25'),
(5, 'Quos nisi necessitat', 'Qui est perspiciatis', '<p><br></p>', 'draft', 'uploads/pages/page_1756882585.jpeg', NULL, NULL, NULL, '1971-11-20 19:21:00', '2025-09-03 00:56:25', '2025-09-03 00:56:25'),
(6, 'Voluptatemিআপডেট', 'Suscipit voluptatem', NULL, 'published', 'uploads/pages/page_1756883865.JPG', NULL, NULL, NULL, '2020-09-05 08:37:00', '2025-09-03 01:17:45', '2025-09-03 01:27:57'),
(7, 'টুট', 'টডুট', '<ol><li>আমার সোনার বাংলা আমি তোমায় ভালবাসি</li><li>আমার সোনার বাংলা আমি তোমায় ভালবাসি</li></ol>', 'published', 'uploads/pages/page_1756962063.JPG', NULL, NULL, NULL, NULL, '2025-09-03 22:55:16', '2025-09-03 23:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `website_url`, `logo`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 'Jin Cotton', 'https://www.lagumesorowe.org.uk', 'logo_1757228214.jpeg', 62, 1, '2025-09-07 00:56:54', '2025-09-07 01:01:28');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(500) DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` enum('draft','published','scheduled') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `excerpt`, `featured_image`, `content`, `status`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 9, 'Proident quia quis', 'Eius soluta nulla de', 'Nihil tempor aut qui', NULL, 'ddddddddddddd', 'draft', '1985-09-03 18:00:00', '2025-09-08 02:56:24', '2025-09-08 03:59:51', '2025-09-08 03:59:51'),
(7, 9, 'িআপডেট', 'Commodo mollitia occ', 'Laboriosam esse id', 'featured_image_1757321925.png', 'আপডেট', 'published', '2007-01-26 08:11:00', '2025-09-08 02:58:45', '2025-09-08 03:53:59', NULL),
(8, 9, 'Eos recusandae Aut', 'Molestias aut sit d', 'In illo quidem nihil', 'featured_image_1757322879.jpg', 'dddddddddddddddddddddddddddddddddddddddd', 'published', '1978-12-10 17:53:00', '2025-09-08 03:14:39', '2025-09-08 03:49:28', '2025-09-08 03:49:28'),
(9, 9, 'Quasi a delectus en', 'Quibusdam dolorum si', 'Velit numquam qui a', 'featured_image_1757325420.png', 'ৃিৃুািৃুািুািুাি', 'published', '2008-11-02 10:04:00', '2025-09-08 03:57:00', '2025-09-08 03:57:00', NULL),
(10, 9, 'Unde est qui non ex', 'Neque mollit omnis i', 'Et sed cumque non co', 'featured_image_1757325606.png', 'dddddddddddddddd', 'scheduled', '2011-11-01 11:06:00', '2025-09-08 04:00:06', '2025-09-08 04:00:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `president_messages`
--

CREATE TABLE `president_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL DEFAULT 'President Message',
  `person_name` varchar(255) NOT NULL,
  `person_title` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `quote` text NOT NULL,
  `badge_text` varchar(255) DEFAULT NULL,
  `read_more_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(86, 'APPTITLE', 'mamrujorit', '2025-08-31 00:48:16', '2025-08-31 00:48:16'),
(87, 'URL', 'https://mamurjor.com/', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(88, 'EMAIL', 'JAMAN@gmail.com', '2025-08-31 00:48:17', '2025-08-31 00:55:51'),
(89, 'CELL', '017466876868', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(90, 'ADDRESS', 'Cum et similique ess', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(91, 'FACEBOOK', 'http://facebook.com/hadijaman', '2025-08-31 00:48:17', '2025-08-31 01:39:17'),
(92, 'TWITTER', 'http://facebook.com/hadijaman', '2025-08-31 00:48:17', '2025-08-31 01:39:17'),
(93, 'INSTAGRAM', 'http://facebook.com/hadijaman', '2025-08-31 00:48:17', '2025-08-31 01:39:17'),
(94, 'LINKEDIN', 'http://facebook.com/hadijaman', '2025-08-31 00:48:17', '2025-08-31 01:39:17'),
(95, 'META_TITLE', 'Exercitation cupidat', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(96, 'META_KEYWORDS', 'In quis facere id a', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(97, 'META_DESCRIPTION', 'Molestiae eos repreh', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(98, 'MAIL_HOST', 'sandbox.smtp.mailtrap.io', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(99, 'MAIL_PORT', '2525', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(100, 'MAIL_USERNAME', '7b4d71dbe6b3c9', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(101, 'MAIL_PASSWORD', '548790113c2271', '2025-08-31 00:48:17', '2025-08-31 03:59:11'),
(102, 'MAIL_ENCRYPTION', 'tls', '2025-08-31 00:48:17', '2025-08-31 03:59:11'),
(103, 'MAIL_FROM', 'hadijaman@gmail.com', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(104, 'DB_CONNECTION', 'mysql', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(105, 'DB_HOST', '127.0.0.1', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(106, 'DB_PORT', '3306', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(107, 'DB_DATABASE', 'software', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(108, 'DB_USERNAME', 'root', '2025-08-31 00:48:17', '2025-08-31 00:48:17'),
(109, 'DB_PASSWORD', NULL, '2025-08-31 00:48:18', '2025-08-31 00:48:18'),
(110, 'PUSHER_APP_ID', 'TEST', '2025-08-31 00:48:18', '2025-08-31 00:50:19'),
(111, 'PUSHER_APP_KEY', NULL, '2025-08-31 00:48:18', '2025-08-31 00:55:51'),
(112, 'PUSHER_APP_SECRET', NULL, '2025-08-31 00:48:18', '2025-08-31 00:49:35'),
(113, 'PUSHER_HOST', NULL, '2025-08-31 00:48:18', '2025-08-31 00:49:35'),
(114, 'PUSHER_PORT', '443', '2025-08-31 00:48:18', '2025-08-31 00:48:18'),
(115, 'PUSHER_SCHEME', 'https', '2025-08-31 00:48:18', '2025-08-31 00:48:18'),
(116, 'PUSHER_APP_CLUSTER', 'mt1', '2025-08-31 00:48:18', '2025-08-31 00:48:18'),
(118, 'MAIL_MAILER', 'smtp', '2025-08-31 00:59:24', '2025-08-31 00:59:34'),
(119, 'APP_URL', 'http://127.0.0.1:8000', '2025-08-31 01:03:03', '2025-08-31 04:19:16'),
(120, 'ADMIN_MAIL', 'admin@gmail.com', '2025-08-31 01:03:03', '2025-08-31 01:03:03'),
(121, 'APP_DEBUG', 'false', '2025-08-31 01:06:37', '2025-08-31 01:06:37'),
(123, 'LOGO', 'banner_1756626869.jpg', '2025-08-31 01:33:56', '2025-08-31 01:54:29'),
(124, 'FAVICON', 'favicon_1756625869.jpeg', '2025-08-31 01:33:56', '2025-08-31 01:37:49'),
(125, 'YOUTUBE', 'http://facebook.com/hadijaman', '2025-08-31 01:41:05', '2025-08-31 01:41:34'),
(126, 'PINTEREST', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(127, 'SNAPCHAT', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(128, 'TIKTOK', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(129, 'REDDIT', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(130, 'TUMBLR', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(131, 'GITHUB', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(132, 'DRIBBBLE', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(133, 'BEHANCE', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(134, 'WHATSAPP', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:34'),
(135, 'TELEGRAM', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:35'),
(136, 'DISCORD', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:35'),
(137, 'SLACK', 'http://facebook.com/hadijaman', '2025-08-31 01:41:06', '2025-08-31 01:41:06'),
(138, 'SITE_NAME', 'Bangladesh Doctor Club LTd', '2025-08-31 01:47:33', '2025-08-31 01:47:33'),
(139, 'TAGLINE', 'best', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(140, 'SUPPORT_MAIL', 'support@gmail.com', '2025-08-31 01:47:34', '2025-08-31 02:20:56'),
(141, 'SALES_MAIL', 'sales@gmail.com', '2025-08-31 01:47:34', '2025-08-31 02:20:56'),
(142, 'MAP_EMBED', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(143, 'PRIMARY_COLOR', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(144, 'SECONDARY_COLOR', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(145, 'COMPANY_NAME', 'Strickland and Rich Inc', '2025-08-31 01:47:34', '2025-08-31 02:12:52'),
(146, 'COMPANY_REG_NO', '0222', '2025-08-31 01:47:34', '2025-08-31 02:20:57'),
(147, 'TAX_ID', '25555', '2025-08-31 01:47:34', '2025-08-31 02:20:57'),
(148, 'TIMEZONE', 'UTC', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(149, 'LOCALE', 'en', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(150, 'CURRENCY', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(151, 'DATE_FORMAT', 'Y-m-d', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(152, 'TIME_FORMAT', 'H:i', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(153, 'GA_MEASUREMENT_ID', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(154, 'FB_PIXEL_ID', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(155, 'MAINTENANCE_MODE', 'OFF', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(156, 'COPYRIGHT_TEXT', '© 2025 Your Company', '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(157, 'COOKIE_CONSENT_TEXT', NULL, '2025-08-31 01:47:34', '2025-08-31 01:47:34'),
(158, 'BANNER', 'banner_1756626920.jpg', '2025-08-31 01:50:06', '2025-08-31 01:55:20'),
(159, 'CONTACT_EMAIL', 'kogonodyk@mailinator.com', '2025-08-31 02:12:52', '2025-08-31 02:12:52'),
(160, 'CONTACT_PHONE_1', '+1 (576) 507-8473', '2025-08-31 02:12:52', '2025-08-31 02:12:52'),
(161, 'CONTACT_PHONE_2', '+1 (716) 544-6971', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(162, 'CONTACT_FAX', '+1 (299) 287-9942', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(163, 'CONTACT_WHATSAPP', 'Ut ullamco pariatur', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(164, 'CONTACT_TELEGRAM', 'Modi aut eum sunt e', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(165, 'CONTACT_MESSENGER', 'Quia vel libero qui', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(166, 'CONTACT_ADDRESS', 'Laborum ex deserunt', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(167, 'CONTACT_MAP', 'Ipsum molestiae qua', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(168, 'CONTACT_HEADING', 'In beatae non aliqua', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(169, 'CONTACT_HOURS', 'Sed nostrum similiqu', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(170, 'CONTACT_DESC', 'Aliquam elit et aut', '2025-08-31 02:12:53', '2025-08-31 02:12:53'),
(171, 'ABOUT_HEADING', 'Possimus qui conseq', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(172, 'ABOUT_SUBHEADING', 'Qui Nam quia rem in', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(173, 'ABOUT_DESC', 'Iusto dolor velit qu', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(174, 'ABOUT_MISSION', 'Laborum perspiciatis', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(175, 'ABOUT_VISION', 'Optio enim quasi no', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(176, 'ABOUT_VALUES', 'Ab reiciendis sapien', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(177, 'ABOUT_VIDEO', 'Vel eos maxime cupid', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(178, 'ABOUT_TEAM_HEADING', 'Occaecat labore even', '2025-08-31 02:18:23', '2025-08-31 02:18:23'),
(179, 'ABOUT_TEAM_DESC', 'Voluptate eos est n', '2025-08-31 02:18:24', '2025-08-31 02:18:24'),
(180, 'ABOUT_AWARDS', 'Optio anim dolor ve', '2025-08-31 02:18:24', '2025-08-31 02:18:24'),
(181, 'ABOUT_HISTORY', 'Tempore praesentium', '2025-08-31 02:18:24', '2025-08-31 02:18:24'),
(182, 'ABOUT_IMAGE', 'banner_1756628364.png', '2025-08-31 02:18:24', '2025-08-31 02:19:24'),
(183, 'RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI', '2025-08-31 06:13:33', '2025-08-31 06:13:33'),
(184, 'RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe', '2025-08-31 06:13:33', '2025-08-31 06:13:33'),
(185, 'RECAPTCHA_VERSION', 'v3', '2025-08-31 06:13:33', '2025-08-31 06:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `quote` text NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `avatar_path` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `role`, `quote`, `rating`, `avatar_path`, `avatar_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(4, 'Yuli Lopez', 'Eiusmod sit volupta', 'Dolor unde reiciendi', 5, NULL, 'https://www.hojo.biz', 1, 55, '2025-09-08 05:36:48', '2025-09-08 05:36:48'),
(5, 'Garrison Griffith', 'Sed quisquam et cumq', 'Exercitationem place', 4, NULL, 'https://www.zuwamy.net', 1, 8, '2025-09-08 05:40:14', '2025-09-08 05:40:20');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','manager','agent','member','user') NOT NULL DEFAULT 'member',
  `full_name_en` varchar(255) DEFAULT NULL,
  `full_name_bn` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `cover_banner` varchar(255) DEFAULT NULL,
  `medical_registration_number` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `current_designation` varchar(255) DEFAULT NULL,
  `institution_name` varchar(255) DEFAULT NULL,
  `image_gallery` varchar(255) DEFAULT NULL,
  `notification_preferences` varchar(255) DEFAULT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `educational_background` varchar(255) DEFAULT NULL,
  `certifications_and_fellowships` text DEFAULT NULL,
  `areas_of_interest` text DEFAULT NULL,
  `languages_spoken` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `short_bio` text DEFAULT NULL,
  `personal_website` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `researchgate` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `social_links` varchar(255) DEFAULT NULL,
  `membership_id` varchar(255) DEFAULT NULL,
  `membership_level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `full_name_en`, `full_name_bn`, `profile_photo`, `cover_banner`, `medical_registration_number`, `specialization`, `current_designation`, `institution_name`, `image_gallery`, `notification_preferences`, `years_of_experience`, `educational_background`, `certifications_and_fellowships`, `areas_of_interest`, `languages_spoken`, `phone`, `location`, `short_bio`, `personal_website`, `linkedin`, `researchgate`, `cv`, `social_links`, `membership_id`, `membership_level`) VALUES
(1, 'Admin', 'stoltenberg.jordon@example.net', '2025-09-07 04:31:47', '$2y$12$DtO7qVCy5F2j2ed79ER//uvZiaApGIXyv7FSm0u4lihIc3vMvIgEi', 'scnQeG3ZqB', '2025-09-07 04:31:47', '2025-09-07 04:31:47', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'admin', 'admin@gmail.com', NULL, '$2y$12$u6ap6wqG.hXycLp2VKasJ.aTkZbYlbJNM8.Oex8RKCoAsvsgiHNRy', NULL, '2025-08-24 01:34:56', '2025-08-24 01:34:56', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'manager', 'manager@gmail.com', '2025-08-24 07:33:58', '$2y$12$8nR6WQ5jJQ/.BIy/FpDrYelSnwXhu8KBFSi3Q0OwL/m7rUeE6fNp.', NULL, '2025-08-24 01:34:56', '2025-08-24 07:33:58', 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'agent', 'agent@gmail.com', NULL, '$2y$12$tdqniWPOFltx2mSiRLZb3.xJ9gb1g1ktdtIQ7cMq2NKqrxfHPS0lu', NULL, '2025-08-24 01:34:57', '2025-08-24 01:34:57', 'agent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'user', 'user@gmail.com', NULL, '$2y$12$wnd60LojQuF2Y5gIes4nGOA/ry.5tAofYnJcufhhAVbMdJQTWJj2a', NULL, '2025-08-24 01:34:57', '2025-08-24 01:34:57', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'member', 'member@gmail.com', NULL, '$2y$12$NNBcSmYoetLO/ufVPM4Y6e8ytvffBk1I06LSKZLduWEfo55ZcHimW', NULL, '2025-08-24 01:34:57', '2025-08-24 01:34:57', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Nicole Sweeney', 'sexehop@mailinator.com', NULL, '$2y$12$RyhQ6GZHvh/nSi4Kfj763e1.YTcEgU7u0hX2Ll6KLkPvyY1Lt4xo2', 'u7IoKcLCgvw1f3VXgb4MOPfMvRRk7AQvM4dDObhEzGEY33EwOJZLzpvdc2Sw', '2025-08-24 07:02:26', '2025-08-24 07:02:26', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Tasha Hardy', 'murem@mailinator.com', NULL, '$2y$12$RADnQ8n8tGM2TjuhjjQB4u9XJRcgBnCceOjw4X5ELpgH0A6O87pm2', NULL, '2025-08-24 07:05:45', '2025-08-24 07:05:45', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Rhea Carver', 'falycejy@mailinator.com', '2025-08-24 07:11:28', '$2y$12$B6jnZAtmxTnA5lk1j80HEepC.S37iuKElugsRn7b4SEWiuGhuJGHC', NULL, '2025-08-24 07:10:24', '2025-08-24 07:11:28', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Richard Mendez', 'sulan@mailinator.com', '2025-08-24 07:12:32', '$2y$12$Bwkzfcr3NtszponKCZkIyOYU7JQHG4NsqWAF7ySQa2G63dV.DmBSi', NULL, '2025-08-24 07:12:00', '2025-08-24 07:12:32', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Quamar Gomez', 'soxa@mailinator.com', '2025-08-24 07:40:27', '$2y$12$H1IgsI1p0ndjKELM0..RlO8rFT.lDIEkBCBHZYbn5IJq5maQgwsTW', NULL, '2025-08-24 07:40:02', '2025-08-24 07:40:27', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Jaquelyn Farmer', 'paho@mailinator.com', NULL, '$2y$12$Ly3GKkeuDNUgeciX2zMJ/.8EADJQqnA1IAwryV0orLvIOYAjAaCPW', NULL, '2025-08-25 22:07:58', '2025-08-25 22:07:58', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Hanae Oneil', 'xelokav@mailinator.com', NULL, '$2y$12$57GnLSZTES0.YzVBBye2vu9ZuU91kahS3YIxiIkBLa/QokmoRQu8y', NULL, '2025-08-25 22:09:15', '2025-08-25 22:09:15', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Acton Phillips', 'nokeli@mailinator.com', NULL, '$2y$12$gR5LC6CjujmtkfPjT9Sce.hBvZChkpaEtzY0YaFJGenEkqoZXH0ia', NULL, '2025-08-25 22:14:29', '2025-08-25 22:14:29', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Pamela Yang', 'test@gamil.com', '2025-08-25 22:28:59', '$2y$12$mePvlIi63bcGbqUcGrs6uO8P.4qSxi9LKMtiz2QXCsik63z3yWfm6', NULL, '2025-08-25 22:16:15', '2025-08-25 22:28:59', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Mari Bryan', 'jedutoqddddef@mailinator.com', '2025-08-25 22:42:00', '$2y$12$CL/UPMAZn6QdbZFEAxa9JuUKaNsA2I2.I2MFmDEubMvXSvpIEXthS', NULL, '2025-08-25 22:29:14', '2025-08-25 22:42:00', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Fleur Murray', 'xakemigddddo@mailinator.com', NULL, '$2y$12$EFgVhxvtf9K78z93D1u6Ce9bNExvrFUDajS7WiGBVeK7hjVdKF.6i', NULL, '2025-08-25 22:42:22', '2025-08-25 22:42:22', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Penelope Odonnell', 'riqobevypi@mailinator.com', '2025-08-26 02:49:04', '$2y$12$rqxhh/ZSAHpndzWgThJFYeWD.y9GZvOYk0guYCQqpnGkgZOMXK2y2', NULL, '2025-08-26 02:43:25', '2025-08-26 02:49:04', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'hadijaman', 'hadijaman@gmail.com', NULL, '$2y$12$d2zHUFc999es0SPMfLXXFuhVSDkRXKkJ0qji1xTXfcu3tXcv/l0yu', NULL, '2025-09-01 05:19:02', '2025-09-01 05:19:02', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Tanner Rush', 'xuwuhyv@mailinator.com', '2025-09-01 05:21:15', '$2y$12$4HPLtj4dmxF/wmFFLYTzC.U7RpgHSxicV6FoW0BwbGJsFNVI.HN6S', NULL, '2025-09-01 05:20:26', '2025-09-01 05:21:15', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Lucy Hester', 'bibutame@mailinator.com', '2025-09-01 05:26:17', '$2y$12$fvPMm6OouOrX0JS30HuHtuborHLPNY5Oe3pVsEcH6VI4bnHC16UUm', NULL, '2025-09-01 05:25:36', '2025-09-01 05:26:17', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Dante Turner', 'fysa@mailinator.com', NULL, '$2y$12$Egl4GhFQC1eblSM4hYfUfO9fWh/chLbHaaoHZn4mI/kzyW5dvaew6', NULL, '2025-09-06 03:32:46', '2025-09-06 03:32:46', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Nadine Oneil', 'lefybaty@mailinator.com', '2025-09-06 03:36:12', '$2y$12$iZJEr7PpnSi.YqDZeF1WOO/aFySYsuP/KRlFKtysLqs5/ep5z3Ky6', NULL, '2025-09-06 03:35:55', '2025-09-06 03:36:12', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_post_post_id_category_id_unique` (`post_id`,`category_id`),
  ADD KEY `category_post_category_id_foreign` (`category_id`);

--
-- Indexes for table `club_intros`
--
ALTER TABLE `club_intros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_email_unique` (`email`),
  ADD KEY `doctors_membership_level_id_foreign` (`membership_level_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_cards`
--
ALTER TABLE `feature_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `membership_assignments`
--
ALTER TABLE `membership_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_assignments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `membership_assignments_membership_level_id_foreign` (`membership_level_id`),
  ADD KEY `membership_assignments_assigned_by_foreign` (`assigned_by`);

--
-- Indexes for table `membership_levels`
--
ALTER TABLE `membership_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `membership_levels_slug_unique` (`slug`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_subscribers_email_unique` (`email`),
  ADD UNIQUE KEY `newsletter_subscribers_verify_token_unique` (`verify_token`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `president_messages`
--
ALTER TABLE `president_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `club_intros`
--
ALTER TABLE `club_intros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feature_cards`
--
ALTER TABLE `feature_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `membership_assignments`
--
ALTER TABLE `membership_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `membership_levels`
--
ALTER TABLE `membership_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `president_messages`
--
ALTER TABLE `president_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `category_post`
--
ALTER TABLE `category_post`
  ADD CONSTRAINT `category_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_membership_level_id_foreign` FOREIGN KEY (`membership_level_id`) REFERENCES `membership_levels` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `membership_assignments`
--
ALTER TABLE `membership_assignments`
  ADD CONSTRAINT `membership_assignments_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `membership_assignments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membership_assignments_membership_level_id_foreign` FOREIGN KEY (`membership_level_id`) REFERENCES `membership_levels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
