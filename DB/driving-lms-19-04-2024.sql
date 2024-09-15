-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 01:36 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `driving_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_correct` tinyint(4) NOT NULL DEFAULT 0,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `title`, `is_correct`, `question_id`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Est eaque et quam do', 1, 1, 2, NULL, NULL, NULL),
(2, 'Officia consequat S', 0, 1, 2, NULL, NULL, NULL),
(3, 'Velit sint laborum v', 0, 1, 2, NULL, NULL, NULL),
(4, 'Dolore quod commodo', 0, 1, 2, NULL, NULL, NULL),
(5, 'Alias possimus nisi', 1, 2, 2, NULL, NULL, NULL),
(6, 'Ut pariatur Ex aute', 0, 2, 2, NULL, NULL, NULL),
(7, 'Esse enim pariatur', 0, 2, 2, NULL, NULL, NULL),
(8, 'Voluptatum est liber', 0, 2, 2, NULL, NULL, NULL),
(9, 'Ad cupidatat aute ve', 1, 3, 2, NULL, NULL, '2024-04-18 07:46:38'),
(10, 'Reprehenderit mollit', 0, 3, 2, NULL, NULL, '2024-04-18 07:46:38'),
(11, 'Sunt ad eligendi del', 0, 3, 2, NULL, NULL, '2024-04-18 07:46:38'),
(12, 'Et culpa qui consequ', 0, 3, 2, NULL, NULL, '2024-04-18 07:46:38'),
(13, 'Veniam proident in', 1, 4, 2, NULL, NULL, NULL),
(14, 'Ut quibusdam possimu', 0, 4, 2, NULL, NULL, NULL),
(15, 'Omnis laudantium id', 0, 4, 2, NULL, NULL, NULL),
(16, 'Sunt cupiditate vol', 0, 4, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passing_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '40',
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `course_id`, `title`, `total_marks`, `time_duration`, `passing_percentage`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Recusandae Ducimus', '30', '20', '70', 2, '2024-04-19 05:00:48', NULL, '2024-04-19 05:00:48'),
(2, 1, 'Perferendis commodo', '100', '99', '51', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assessment_attempts`
--

CREATE TABLE `assessment_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_attempts`
--

INSERT INTO `assessment_attempts` (`id`, `assessment_id`, `course_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-04-19 05:00:26', '2024-04-19 05:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_results`
--

CREATE TABLE `assessment_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_questions` int(11) NOT NULL DEFAULT 0,
  `total_correct` int(11) NOT NULL DEFAULT 0,
  `total_wrong` int(11) NOT NULL DEFAULT 0,
  `total_unanswered` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pass',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_results`
--

INSERT INTO `assessment_results` (`id`, `assessment_id`, `course_id`, `user_id`, `total_questions`, `total_correct`, `total_wrong`, `total_unanswered`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, 3, 0, 0, 'Pass', NULL, '2024-04-18 07:47:23', '2024-04-18 07:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_result_details`
--

CREATE TABLE `assessment_result_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_result_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_id` int(11) NOT NULL DEFAULT 0,
  `is_correct` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_result_details`
--

INSERT INTO `assessment_result_details` (`id`, `assessment_result_id`, `question_id`, `answer_id`, `is_correct`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, '2024-04-18 07:47:23', '2024-04-18 07:47:23'),
(2, 1, 2, 5, 1, NULL, '2024-04-18 07:47:23', '2024-04-18 07:47:23'),
(3, 1, 3, 9, 1, NULL, '2024-04-18 07:47:23', '2024-04-18 07:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `top`, `category_description`, `image`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'LTV', 'ltv', '0', 'For Computer Sceince Students', 'public/upload/RtuxZjNUfvrnfOjS7u8bi2yhwQizwCwvmuVXyVi1.webp', 2, NULL, NULL, NULL),
(2, 'HTV', 'htv', '0', 'For Computer Sceince Students Also', NULL, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chapter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vimeo_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `chapter_name`, `course_id`, `lesson_id`, `slug`, `description`, `upload_type`, `file`, `duration`, `vimeo_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Driving A Car With No Experience', 1, 1, 'driving-a-car-with-no-experience', 'A car, or an automobile, is a motor vehicle with wheels. Most definitions of cars state that they run primarily on roads, seat one to eight people, have four wheels, and mainly transport people, not cargo.[1][2]\r\n\r\nFrench inventor Nicolas-Joseph Cugnot built the first steam-powered road vehicle in 1769, while French-born Swiss inventor François Isaac de Rivaz designed and constructed the first internal combustion-powered automobile in 1808. The modern car—a practical, marketable automobile for everyday use—was invented in 1886, when German inventor Carl Benz patented his Benz Patent-Motorwagen. Commercial cars became widely available during the 20th century. One of the first cars affordable by the masses was the 1908 Model T, an American car manufactured by the Ford Motor Company. Cars were rapidly adopted in the US, where they replaced horse-drawn carriages.[3] In Europe and other parts of the world, demand for automobiles did not increase until after World War II.[4] The car is considered an essential part of the developed economy.', 'video', 'storage/courses/video/The First Driving Class/Jx0zu8elKZUxSbyR2AAdsfyQKOI7SIgfPeE4wQW8.mp4', '136.97444661458', NULL, NULL, NULL, NULL),
(2, 'Pdf course 1', 1, 1, 'pdf-course-1', 'Molestiae perspiciat', 'pdf', 'storage/courses/pdf/The First Driving Class/6rbAoZghaqxPMGzd7OdbI6rcduhAvNpoubPwu8wa.pdf', '0', NULL, NULL, NULL, '2024-04-19 06:15:59'),
(3, 'Lesson 1', 2, 2, 'lesson-1', 'Do Do excepturi nobis v Do excepturi nobis v Do excepturi nobis v Do excepturi nobis v Do excepturi nobis v \r\n Do excepturi nobis v Do excepturi nobis v Do excepturi nobis v Do excepturi nobis v excepturi nobis v', 'pdf', 'storage/courses/pdf/Destiny Rollins/KKSjk8JHstpKqdIKuJxsZY1o8XbeB9T1VWIORTxB.pdf', '0', NULL, NULL, NULL, '2024-04-19 06:26:52'),
(4, 'Lesson 2', 2, 2, 'lesson-2', 'As drivers in the non-emergency medical transportation (NEMT) industry, embodying professionalism is paramount. Beyond merely operating vehicles, your role extends to ensuring the safety, comfort, and well-being of passengers. Here are key characteristics that define a true professional in the NEMT sector:\r\n\r\n1. **Reliability and Punctuality**: Consistently arriving on time for pick-ups and drop-offs is crucial. Reliability builds trust with passengers and healthcare providers alike. Remember, your punctuality impacts someone else\'s schedule and possibly their health care appointments.\r\n\r\n2. **Empathy and Compassion**: Understanding the unique needs of passengers, many of whom may be elderly, disabled, or medically fragile, is essential. Compassion drives you to provide assistance with dignity and respect, recognizing that each passenger\'s journey is significant.\r\n\r\n3. **Attention to Detail**: From vehicle cleanliness to adhering to specific passenger instructions, paying attention to detail ensures a smooth and comfortable ride. Small gestures like adjusting the temperature or assisting with seatbelts can make a significant difference to passengers.\r\n\r\n4. **Adaptability and Problem-Solving Skills**: Navigating traffic, road closures, and unexpected circumstances requires adaptability and quick thinking. Being able to handle challenges calmly and efficiently demonstrates your professionalism and commitment to passenger safety.\r\n\r\n5. **Effective Communication**: Clear communication with passengers, dispatchers, and healthcare professionals is essential for a successful trip. Listen actively, speak clearly, and provide updates as needed to ensure everyone is informed and comfortable throughout the journey.\r\n\r\n6. **Maintaining Professionalism Under Pressure**: Stressful situations may arise, but maintaining a calm and composed demeanor is vital. Your professionalism shines brightest during challenging moments, reassuring passengers and colleagues alike.\r\n\r\n7. **Commitment to Continuous Improvement**: Embrace opportunities for training and development to enhance your skills and knowledge. Stay updated on best practices, regulations, and advancements in the NEMT industry to provide the highest standard of service.\r\n\r\nBy embodying these characteristics of professionalism, you not only enhance the reputation of your NEMT business but also contribute to the well-being and safety of those you serve. Remember, each trip is an opportunity to make a positive impact on someone\'s life.', 'pdf', 'storage/courses/pdf/Pdf course 1/2JPxtJVd0lkEfkbuo5fenpDGiyOZWVyVBBGc03KI.pdf', '0', NULL, NULL, NULL, '2024-04-19 06:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accredition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviews` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `featured_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `slug`, `accredition`, `short_detail`, `long_detail`, `certification`, `course_duration`, `reviews`, `language`, `price`, `featured_img`, `featured_video`, `is_featured`, `cat_id`, `instructor_id`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'The First Driving Class', 'the-first-driving-class', 'Minima ipsum esse i', 'A car, or an automobile, is a motor vehicle with wheels. Most definitions of cars state that they run primarily on roads, seat one to eight people, have four wheels, and mainly transport people, not cargo.[1][2]', 'A car, or an automobile, is a motor vehicle with wheels. Most definitions of cars state that they run primarily on roads, seat one to eight people, have four wheels, and mainly transport people, not cargo.[1][2]\r\n\r\nFrench inventor Nicolas-Joseph Cugnot built the first steam-powered road vehicle in 1769, while French-born Swiss inventor François Isaac de Rivaz designed and constructed the first internal combustion-powered automobile in 1808. The modern car—a practical, marketable automobile for everyday use—was invented in 1886, when German inventor Carl Benz patented his Benz Patent-Motorwagen. Commercial cars became widely available during the 20th century. One of the first cars affordable by the masses was the 1908 Model T, an American car manufactured by the Ford Motor Company. Cars were rapidly adopted in the US, where they replaced horse-drawn carriages.[3] In Europe and other parts of the world, demand for automobiles did not increase until after World War II.[4] The car is considered an essential part of the developed economy.', 'storage/certificate/HsT0yahU13J1lAbng58VBLErby5dvBANNXJZQehi.png', '136.97444661458', NULL, 'english', 925.00, 'tVATgftsTs52VltXOjmEaRZnOb5WpPygoqFUST85.png', 'storage/video/uAn0bohJwx0NHhlmtdUwyp0YSkmwNwhjNXadI04F.mp4', 'no', 1, 2, 2, NULL, NULL, '2024-04-18 07:10:42'),
(2, 'Course 1', 'course-1', 'Id voluptates adipis', 'Ut facilis a laborum', 'Dolores sint qui omn', 'storage/certificate/jBsXvMn2jQbnlSZPBGRCm9pxJRFrlYRMglSIIHx9.png', NULL, NULL, 'english', 846.00, 'jHjZbgXHETGpuM505ZgWCe0ZLmdvLbvQJVnXCziF.png', 'storage/video/MSApGA2PnfU6U74EuaFMUN2yTYyrcdwWkgfq42oh.mp4', 'yes', 2, 2, 2, NULL, NULL, '2024-04-19 06:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_progress`
--

CREATE TABLE `course_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `watch_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent_watched` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_progress`
--

INSERT INTO `course_progress` (`id`, `course_id`, `user_id`, `chapter_id`, `watch_time`, `percent_watched`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '132.68383', '96.867578792523', '2024-04-18 07:16:01', '2024-04-18 07:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `lesson_name`, `course_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'How to drive', 1, NULL, NULL, NULL),
(2, 'Chapter 1', 2, NULL, NULL, '2024-04-19 06:26:42');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_11_06_110415_create_assessments_table', 1),
(5, '2023_11_07_003447_create_categories_table', 1),
(6, '2023_11_07_073447_create_courses_table', 1),
(7, '2023_11_07_075727_create_questions_table', 1),
(8, '2023_11_07_075814_create_answers_table', 1),
(9, '2023_11_07_080332_create_assessment_results_table', 1),
(10, '2023_11_07_192242_create_orders_table', 1),
(11, '2023_11_07_192259_create_order_items_table', 1),
(12, '2023_12_12_122805_create_services_table', 1),
(13, '2023_12_18_122805_create_lessons_table', 1),
(14, '2023_12_18_151516_create_chapters_table', 1),
(15, '2024_03_29_054420_create_wishlists_table', 1),
(16, '2024_04_01_101309_create_course_progress_table', 1),
(17, '2024_04_08_071638_create_assessment_result_details_table', 1),
(18, '2024_04_08_072335_create_fuck_table', 1),
(19, '2024_04_08_072456_chawal', 1),
(20, '2024_04_09_064346_create_assessment_attempts_table', 1),
(21, '2024_04_09_113034_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `subtotal` double(8,2) DEFAULT NULL,
  `discount_amount` double(8,2) DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `discount`, `subtotal`, `discount_amount`, `amount`, `currency`, `payment_id`, `payment_status`, `payment_type`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 925.00, NULL, 925.00, 'usd', 'pi_3P6tsHEeycRryfGb01ZGrtAG', 'paid', 'card', 1, NULL, '2024-04-18 07:15:49', '2024-04-18 07:15:49'),
(2, NULL, 846.00, NULL, 846.00, 'usd', 'pi_3P7F5KEeycRryfGb0WyHfI6G', 'paid', 'card', 1, NULL, '2024-04-19 05:54:43', '2024-04-19 05:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `course_id`, `order_id`, `amount`, `discount`, `progress`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 925.00, NULL, 100, 1, NULL, '2024-04-18 07:15:49', '2024-04-18 07:16:11'),
(2, 2, 2, 846.00, NULL, 0, 1, NULL, '2024-04-19 05:54:43', '2024-04-19 05:54:43');

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int(11) NOT NULL DEFAULT 1,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `marks`, `assessment_id`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Minim est et excepte', 10, 1, 2, NULL, NULL, NULL),
(2, 'Assumenda dolores co', 10, 1, 2, NULL, NULL, NULL),
(3, 'Dolorem ullamco sed', 10, 1, 2, NULL, NULL, NULL),
(4, 'Quia dolores enim ea', 93, 2, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `description`, `rating`, `created_by`, `course_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'great Experrience', '5', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highest_degree` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_degree` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `image`, `highest_degree`, `gender`, `instructor_degree`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Raze Abbas', 'user@user.com', '2131231231', 'fda dre ase', 'DvzNqX0uBDic46GIzSGvSJgGNfD4B7UVAUCfLRpv.webp', NULL, 'Male', NULL, NULL, '$2y$10$Jd5j8w15/0VG7Zj0gl/cdeUFDp0JDC0QKlQJdh1zaE50Bk6MnIMN6', '3', NULL, '2024-04-18 07:00:22', '2024-04-18 09:21:35'),
(2, 'Admin', 'admin@admin.com', NULL, NULL, '3RMo6FtjEoRmw11xXVROwjweZpUCetFVXJglRTNI.png', NULL, 'Male', NULL, NULL, '$2y$10$cJLw5N5UZjkc4SqzvZiQ9.zUZsvc5zRZ86YTA3G4bxT1mq3YzzZ.C', '1', NULL, '2024-04-18 07:04:33', '2024-04-18 07:14:10'),
(3, 'Tester', 'test@tester.com', NULL, NULL, 'AWhhvsiMEODN09blF4Hl3GhyvUaFHBtdGJkzEyvs.webp', NULL, 'Male', NULL, NULL, '$2y$10$R9xKUEPBKic7yxmwNV/3oOJtEerBHUXtGVwiXK.FTIipJIwfxydH2', '3', NULL, '2024-04-18 09:28:24', '2024-04-18 09:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`),
  ADD KEY `answers_created_by_foreign` (`created_by`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment_attempts`
--
ALTER TABLE `assessment_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_attempts_assessment_id_foreign` (`assessment_id`),
  ADD KEY `assessment_attempts_course_id_foreign` (`course_id`),
  ADD KEY `assessment_attempts_user_id_foreign` (`user_id`);

--
-- Indexes for table `assessment_results`
--
ALTER TABLE `assessment_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_results_assessment_id_foreign` (`assessment_id`),
  ADD KEY `assessment_results_course_id_foreign` (`course_id`),
  ADD KEY `assessment_results_user_id_foreign` (`user_id`);

--
-- Indexes for table `assessment_result_details`
--
ALTER TABLE `assessment_result_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_result_details_assessment_result_id_foreign` (`assessment_result_id`),
  ADD KEY `assessment_result_details_question_id_foreign` (`question_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_cat_id_foreign` (`cat_id`),
  ADD KEY `courses_instructor_id_foreign` (`instructor_id`),
  ADD KEY `courses_created_by_foreign` (`created_by`);

--
-- Indexes for table `course_progress`
--
ALTER TABLE `course_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_progress_course_id_foreign` (`course_id`),
  ADD KEY `course_progress_user_id_foreign` (`user_id`),
  ADD KEY `course_progress_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
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
  ADD KEY `orders_created_by_foreign` (`created_by`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_course_id_foreign` (`course_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_created_by_foreign` (`created_by`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_assessment_id_foreign` (`assessment_id`),
  ADD KEY `questions_created_by_foreign` (`created_by`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_created_by_foreign` (`created_by`),
  ADD KEY `reviews_course_id_foreign` (`course_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_course_id_foreign` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assessment_attempts`
--
ALTER TABLE `assessment_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assessment_results`
--
ALTER TABLE `assessment_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assessment_result_details`
--
ALTER TABLE `assessment_result_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_progress`
--
ALTER TABLE `course_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assessment_attempts`
--
ALTER TABLE `assessment_attempts`
  ADD CONSTRAINT `assessment_attempts_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assessment_attempts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assessment_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assessment_results`
--
ALTER TABLE `assessment_results`
  ADD CONSTRAINT `assessment_results_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assessment_results_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assessment_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assessment_result_details`
--
ALTER TABLE `assessment_result_details`
  ADD CONSTRAINT `assessment_result_details_assessment_result_id_foreign` FOREIGN KEY (`assessment_result_id`) REFERENCES `assessment_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assessment_result_details_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_progress`
--
ALTER TABLE `course_progress`
  ADD CONSTRAINT `course_progress_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_progress_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
