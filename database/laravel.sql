-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 27, 2025 at 10:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_category_id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `cover_img` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `company_category_id`, `logo`, `title`, `description`, `website`, `cover_img`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'images/logo/gp.png', 'Grameenphone Ltd.', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(2, 2, 8, 'images/logo/bkash.png', 'bKash Limited', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(3, 3, 6, 'images/logo/square.png', 'Square Group', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(4, 4, 4, 'images/logo/pranrfl.png', 'PRAN-RFL Group', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(5, 5, 2, 'images/logo/brac.png', 'BRAC', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(6, 6, 18, 'images/logo/aci.png', 'ACI Limited', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(7, 7, 15, 'images/logo/robi.png', 'Robi Axiata Limited', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(8, 8, 14, 'images/logo/walton.png', 'Walton Group', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(9, 9, 8, 'images/logo/unilever.png', 'Unilever Bangladesh', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(10, 10, 3, 'images/logo/banglalink.png', 'Banglalink', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(11, 11, 9, 'images/logo/citybank.png', 'City Bank', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(12, 12, 17, 'images/logo/ific.png', 'IFIC Bank', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(13, 13, 7, 'images/logo/lankabangla.png', 'LankaBangla Finance', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(14, 14, 19, 'images/logo/pathao.png', 'Pathao', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(15, 15, 15, 'images/logo/daraz.png', 'Daraz', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(16, 16, 9, 'images/logo/foodpanda.png', 'Foodpanda', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(17, 17, 8, 'images/logo/uber.png', 'Uber Bangladesh', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(18, 18, 8, 'images/logo/shwapno.png', 'Shwapno', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(19, 19, 8, 'images/logo/beximco.png', 'Beximco', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(20, 20, 18, 'images/logo/akij.png', 'Akij Group', 'This is a sample company description for demo purposes.', 'https://www.example.com', 'nocover', '2025-11-15 18:23:53', '2025-11-15 18:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `company_categories`
--

CREATE TABLE `company_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_categories`
--

INSERT INTO `company_categories` (`id`, `category_name`) VALUES
(1, 'IT & Telecommunication'),
(2, 'Marketing / Advertising'),
(3, 'General Mgmt'),
(4, 'Banking / Insurance /Financial Services'),
(5, 'Construction / Engineering / Architects '),
(6, 'Creative / Graphics / Designing'),
(7, 'Social work'),
(8, 'hospitality'),
(9, 'journalism-editor-media'),
(10, 'Agriculture + Livestock'),
(11, 'Teaching profession'),
(12, 'Engineer'),
(13, 'Sales'),
(14, 'Leadership'),
(15, 'Web development'),
(16, 'Mobile App'),
(17, 'Sales'),
(18, 'E-Commerce'),
(19, 'Others');

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
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 22, 1, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(2, 22, 2, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(3, 22, 3, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(4, 22, 4, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(5, 22, 5, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(6, 22, 6, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(7, 22, 7, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(8, 22, 8, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(9, 22, 9, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(10, 22, 10, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(11, 22, 11, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(12, 22, 12, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(13, 22, 13, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(14, 22, 14, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(15, 22, 15, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(16, 22, 16, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(17, 22, 17, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(18, 22, 18, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(19, 22, 19, '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(20, 22, 20, '2025-11-15 18:23:53', '2025-11-15 18:23:53');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_10_09_104919_create_permission_tables', 1),
(6, '2020_10_09_144234_create_company_categories_table', 1),
(7, '2020_10_09_145555_create_companies_table', 1),
(8, '2020_10_11_024354_create_posts_table', 1),
(9, '2020_10_12_133736_create_post_user_table', 1),
(10, '2020_10_13_111952_create_job_applications_table', 1),
(11, '2025_09_25_081117_create_user_profiles_table', 1),
(12, '2025_09_27_000001_add_profile_pic_to_user_profiles_table', 1),
(13, '2025_09_27_113955_add_profile_pic_to_user_profiles_table', 1),
(14, '2025_10_02_000001_add_cv_to_user_profiles_table', 1),
(15, '2025_10_02_100000_expand_user_profiles_for_cv_sections', 1),
(16, '2025_12_24_000001_add_first_name_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 22);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view-dashboard', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(2, 'create-post', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(3, 'edit-post', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(4, 'delete-post', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(5, 'manage-authors', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(6, 'author-section', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(7, 'create-category', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(8, 'edit-category', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(9, 'delete-category', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(10, 'create-company', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(11, 'edit-company', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(12, 'delete-company', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_level` varchar(20) NOT NULL,
  `vacancy_count` smallint(5) UNSIGNED NOT NULL,
  `employment_type` varchar(255) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `education_level` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `specifications` text NOT NULL,
  `views` mediumint(8) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `company_id`, `job_title`, `job_level`, `vacancy_count`, `employment_type`, `salary`, `job_location`, `deadline`, `education_level`, `experience`, `skills`, `specifications`, `views`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sales Executive', 'Mid level', 9, 'Full time', '43k - 85k', 'Dhaka', '2025-12-24 00:03:45', 'Bachelors', '2 years', 'Mobile Development, Android, iOS', '<p></p>', 6, '2025-11-15 18:23:51', '2025-12-23 18:03:45'),
(2, 2, 'Accountant', 'Entry level', 4, 'Full time', '32k - 141k', 'Mymensingh', '2025-12-23 22:50:27', 'Bachelors', '6 years', 'Public Speaking, Presentation, Training', '<p></p>', 1, '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(3, 3, 'Operations Manager', 'Mid level', 10, 'Full time', '16k - 81k', 'Sylhet', '2025-12-23 22:50:27', 'Bachelors', '1 years', 'Mobile Development, Android, iOS', '<p></p>', 1, '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(4, 4, 'Software Engineer', 'Mid level', 7, 'Full time', '56k - 81k', 'Rajshahi', '2025-12-23 22:50:27', 'Bachelors', '6 years', 'Accounting, Bookkeeping, Taxation', '<p></p>', 1, '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(5, 5, 'Content Writer', 'Senior level', 6, 'Full time', '28k - 87k', 'Rangpur', '2025-12-23 23:22:54', 'Bachelors', '3 years', 'Python, Machine Learning, AI', '<p></p>', 2, '2025-11-15 18:23:51', '2025-12-23 17:22:54'),
(6, 6, 'Operations Manager', 'Manager', 3, 'Full time', '42k - 95k', 'Sylhet', '2025-12-23 22:50:27', 'Bachelors', '6 years', 'Communication, Teamwork, Problem Solving', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(7, 7, 'Customer Support', 'Senior level', 8, 'Full time', '25k - 147k', 'Rajshahi', '2025-12-27 21:07:42', 'Bachelors', '2 years', 'Sales, Negotiation, CRM', '<p></p>', 18, '2025-11-15 18:23:52', '2025-12-27 15:07:42'),
(8, 8, 'Data Analyst', 'Lead', 6, 'Full time', '31k - 100k', 'Dhaka', '2025-12-23 22:50:27', 'Bachelors', '1 years', 'Sales, Negotiation, CRM', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(9, 9, 'Product Manager', 'Entry level', 10, 'Full time', '38k - 113k', 'Dhaka', '2025-12-23 22:50:27', 'Bachelors', '3 years', 'Copywriting, Editing, Research', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(10, 10, 'Data Analyst', 'Mid level', 9, 'Full time', '61k - 82k', 'Rajshahi', '2025-12-23 22:55:02', 'Bachelors', '1 years', 'PHP, Laravel, MySQL', '<p></p>', 5, '2025-11-15 18:23:52', '2025-12-23 16:55:02'),
(11, 11, 'Accountant', 'Lead', 7, 'Full time', '78k - 82k', 'Khulna', '2025-12-23 22:50:27', 'Bachelors', '5 years', 'Marketing, SEO, Content Writing', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(12, 12, 'Business Analyst', 'Mid level', 6, 'Full time', '71k - 118k', 'Barisal', '2025-12-24 01:26:19', 'Bachelors', '5 years', 'Communication, Teamwork, Problem Solving', '<p></p>', 2, '2025-11-15 18:23:52', '2025-12-23 19:26:19'),
(13, 13, 'Project Manager', 'Senior level', 4, 'Full time', '72k - 132k', 'Barisal', '2025-12-23 22:50:27', 'Bachelors', '4 years', 'Data Analysis, Excel, Reporting', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(14, 14, 'Graphic Designer', 'Mid level', 8, 'Full time', '53k - 86k', 'Rajshahi', '2025-12-23 22:50:27', 'Bachelors', '5 years', 'Marketing, SEO, Content Writing', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(15, 15, 'Marketing Manager', 'Manager', 4, 'Full time', '65k - 125k', 'Rangpur', '2025-12-27 21:08:19', 'Bachelors', '1 years', 'Project Management, Leadership, Agile', '<p></p>', 4, '2025-11-15 18:23:52', '2025-12-27 15:08:19'),
(16, 16, 'Content Writer', 'Lead', 6, 'Full time', '62k - 83k', 'Sylhet', '2025-12-23 22:50:27', 'Bachelors', '4 years', 'Accounting, Bookkeeping, Taxation', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(17, 17, 'Operations Manager', 'Senior level', 4, 'Full time', '27k - 127k', 'Barisal', '2025-12-23 22:50:27', 'Bachelors', '1 years', 'Copywriting, Editing, Research', '<p></p>', 1, '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(18, 18, 'Product Manager', 'Lead', 10, 'Full time', '31k - 139k', 'Rajshahi', '2025-12-27 21:06:55', 'Bachelors', '2 years', 'Accounting, Bookkeeping, Taxation', '<p></p>', 24, '2025-11-15 18:23:53', '2025-12-27 15:06:55'),
(19, 19, 'Sales Executive', 'Mid level', 8, 'Full time', '76k - 81k', 'Rangpur', '2025-12-27 21:07:15', 'Bachelors', '6 years', 'Mobile Development, Android, iOS', '<p></p>', 3, '2025-11-15 18:23:53', '2025-12-27 15:07:15'),
(20, 20, 'Mobile App Developer', 'Lead', 6, 'Full time', '69k - 91k', 'Khulna', '2025-12-23 23:21:45', 'Bachelors', '5 years', 'Mobile Development, Android, iOS', '<p></p>', 6, '2025-11-15 18:23:53', '2025-12-23 17:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_user`
--

CREATE TABLE `post_user` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_user`
--

INSERT INTO `post_user` (`post_id`, `user_id`) VALUES
(18, 22);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(2, 'author', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(3, 'user', 'web', '2025-11-15 18:23:51', '2025-11-15 18:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Grameenphone1', NULL, 'grameenphone1@example.com', '2025-11-15 18:23:51', '$2y$10$Yw8zt0aXTO0lU.7ACmu9leA2N6DgPqaDqKik24/lbhjTCHdtMCcX6', NULL, NULL, 'O17Pf2TRGoA67QgR0xK9TFF81WxcDRHI9ILjY3rHTzfIRFbYX48MHOijWmHf', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(2, 'Bkash1', NULL, 'bkash1@example.com', '2025-11-15 18:23:51', '$2y$10$46mEeCdJotHgMF/EkuJLE.tj4kzcHMDqgRrR/MCrxMgXuqduhYvPW', NULL, NULL, 'ff0Sy7Kqlk', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(3, 'Square1', NULL, 'square1@example.com', '2025-11-15 18:23:51', '$2y$10$WsEZwyCKc6EjGpF7dbH4FOuYEI1yHMu4e6/fZMJwlMs3OAADtdhva', NULL, NULL, 'O5fbfrZI4k', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(4, 'Pranrfl1', NULL, 'pranrfl1@example.com', '2025-11-15 18:23:51', '$2y$10$ARkJsDcNYsRrZmWS.uOU5uRuQ1xG7O0Pa2haVN12YM0ennVmaIQIW', NULL, NULL, '80SwQSg3bnshWaeYotqLWWOFCgTC9O7zMxvhbTQq9Wznze808vgx3ILGZeAm', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(5, 'Brac1', NULL, 'brac1@example.com', '2025-11-15 18:23:51', '$2y$10$OehaWJ5W0113.usyW7rbNudqvvVfaB1QtZqsGw2P1f.jWnLQMAvpO', NULL, NULL, 'v6S6IQsnGj', '2025-11-15 18:23:51', '2025-11-15 18:23:51'),
(6, 'Aci1', NULL, 'aci1@example.com', '2025-11-15 18:23:52', '$2y$10$cWi/b0bh68Rbnv1tNqYxrOWBJz9F7gWmjoOPPMjx81NMNbwi.dfMq', NULL, NULL, 'hrGz6mPrxF', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(7, 'Robi1', NULL, 'robi1@example.com', '2025-11-15 18:23:52', '$2y$10$zvHSI7NUfyDeaKBpg5/RF.9eX6bGXMaIHfJ3pAJW6a9EZLOphLM7S', NULL, NULL, '3mTQUV8exFqXLSOlrwBmpUKNtdEARC7u98qP5nIzeCwiUkoBkVz0vBBFfeam', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(8, 'Walton1', NULL, 'walton1@example.com', '2025-11-15 18:23:52', '$2y$10$NeRxn0OFXFxwOrIfqy2/4.hqjshVNp2wAS0BXr6WWddanldBTB3qK', NULL, NULL, 'deYqR1SDDW', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(9, 'Unilever1', NULL, 'unilever1@example.com', '2025-11-15 18:23:52', '$2y$10$gNf7JIOhs3WivxZ2gvlTS.C/9FxM8N3EmXQ5J.Q4QdLT75Zx/PHpO', NULL, NULL, 'Ea3vAE0qVG', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(10, 'Banglalink1', NULL, 'banglalink1@example.com', '2025-11-15 18:23:52', '$2y$10$k6NWAA4JguV07R/3.QDFVOOVzAXBDmRx9tVVMZsFhSOh/4xgnYqtq', NULL, NULL, 'ZWejneGvr4', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(11, 'City1', NULL, 'city1@example.com', '2025-11-15 18:23:52', '$2y$10$CAA.wAnT/vKCjxwMOcIuv.tQ2eMhmu/XBq0.zHOQwC6BFiSZ79yFS', NULL, NULL, '2sMJBp59sD', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(12, 'Ific1', NULL, 'ific1@example.com', '2025-11-15 18:23:52', '$2y$10$FmZNmOsBk0RsPqhuUjDT0.DCI.wvDjGzRl.q5.bG8IpxGz9w0zsse', NULL, NULL, 'gS1xIwotdy', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(13, 'Lankabangla1', NULL, 'lankabangla1@example.com', '2025-11-15 18:23:52', '$2y$10$5qzENNdO3.iYJ8qwM/Gp4e1/y3THtKcR9j59B.lSnIGbRGb3Xk0xe', NULL, NULL, 'qfkQ5U645k', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(14, 'Pathao1', NULL, 'pathao1@example.com', '2025-11-15 18:23:52', '$2y$10$OhPFifbTx1.jIxS6W4iGO.ruu3vVGsWcBInKmoUvcoLpDiv4V3MoC', NULL, NULL, 'zmVxdqvK3g', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(15, 'Daraz1', NULL, 'daraz1@example.com', '2025-11-15 18:23:52', '$2y$10$YuAh1pKK1.sk0cXD62FWeOcC.Ee377B9l9lCSlofgtctccTAGYY0G', NULL, NULL, 'wbfTUGwtDo', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(16, 'Foodpanda1', NULL, 'foodpanda1@example.com', '2025-11-15 18:23:52', '$2y$10$yVmm6dFb3wA14Aor/cWfguMdoRqod/4vXYL3ItzfRn4sxP14jbdWa', NULL, NULL, 'qL9Js8zB4w', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(17, 'Uber1', NULL, 'uber1@example.com', '2025-11-15 18:23:52', '$2y$10$NAbe8QNAObKul8bCgDy/ku83eTuoQQiO0f6wC4m8P8XvUCiiTvJxu', NULL, NULL, 'PhgxwU9gyx', '2025-11-15 18:23:52', '2025-11-15 18:23:52'),
(18, 'Shwapno1', NULL, 'shwapno1@example.com', '2025-11-15 18:23:53', '$2y$10$ogCaGOyCYMFWu8ylBAWlXe9DoXtKkVl19DDM42VXFVmcEGzzs.gbe', NULL, NULL, 'EWInmpHmqn', '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(19, 'Beximco1', NULL, 'beximco1@example.com', '2025-11-15 18:23:53', '$2y$10$aycvT.SwQJXQY05cpSzpqetKUrSHHkZxs55/xvl1UzD5pf9Afc4rq', NULL, NULL, 'uqz4wlhwLL', '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(20, 'Akij1', NULL, 'akij1@example.com', '2025-11-15 18:23:53', '$2y$10$ijIcoiUKWHXEZ3flfvOS1OsSNQM/tXWOPUKa1LbW8g12xG5A8w4pm', NULL, NULL, 'tUKD9m7GeH', '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(21, 'admin user', NULL, 'admin@admin.com', '2025-11-15 18:23:53', '$2y$10$CBdFl56en56Rir5yFqn4wu1F0eFoF8i18Ptxi4CqAg4zY7WWeLo/y', NULL, NULL, 'XmwCjQzLMju5erzMZMtKxEugEByyYhngbhDi36nUZgLB04ENrWmdkoRjX9EJ', '2025-11-15 18:23:53', '2025-11-15 18:23:53'),
(22, 'simple user', NULL, 'user@user.com', '2025-11-15 18:23:53', '$2y$10$362GgoDqtt7G5T8iRedGS.NF1cEszakBT4gFxw3y6LgyDgim8./j2', NULL, NULL, 'umhaf0CfKfCFzDTDwqfQCXCgB0GtlRpO1yTlhFGuk8xxW09bdKza28GZHde0', '2025-11-15 18:23:53', '2025-11-15 18:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `education` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `references` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `full_name`, `address`, `phone`, `dob`, `gender`, `nationality`, `about`, `profile_pic`, `cv`, `education`, `experience`, `skills`, `references`, `created_at`, `updated_at`) VALUES
(1, 22, 'az', 'd', '3', '2025-12-17', 'Male', 'wdsw', 'ede', 'storage/profile_pics/profile_22_1766533300.jpg', 'storage/cvs/cv_22_1766533371.pdf', 'wdw', 'wdew', 'dwed', 'de', '2025-12-23 15:34:15', '2025-12-23 17:42:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_categories`
--
ALTER TABLE `company_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_user`
--
ALTER TABLE `post_user`
  ADD PRIMARY KEY (`post_id`,`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
