-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2025 at 05:12 PM
-- Server version: 8.0.43
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `up_latest_techguru`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_app_translations`
--

CREATE TABLE `app_app_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `locale` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `namespace` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `key` text COLLATE utf8mb4_bin NOT NULL,
  `value` text COLLATE utf8mb4_bin,
  `object_type` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `object_key` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `app_attributes`
--

CREATE TABLE `app_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_attribute_values`
--

CREATE TABLE `app_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `value` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_chatbot_configurations`
--

CREATE TABLE `app_chatbot_configurations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `config` json DEFAULT NULL,
  `capabilities` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `last_tested_at` timestamp NULL DEFAULT NULL,
  `last_error` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_chatbot_logs`
--

CREATE TABLE `app_chatbot_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `provider` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` json DEFAULT NULL,
  `context` json DEFAULT NULL,
  `user_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_comments`
--

CREATE TABLE `app_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` bigint UNSIGNED NOT NULL COMMENT 'Post type ID',
  `object_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Post type',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_comments`
--

INSERT INTO `app_comments` (`id`, `user_id`, `email`, `name`, `website`, `content`, `object_id`, `object_type`, `status`, `created_at`, `updated_at`, `json_metas`) VALUES
(26, 52, NULL, NULL, NULL, 'This product is good', 256, 'products', 'approved', '2025-08-14 17:04:34', '2025-08-14 17:04:57', '{\"rating\":\"3\"}'),
(27, 15, NULL, NULL, NULL, 'Loved this read! I wasn’t expecting to get so many useful tips in one post—definitely bookmarking this for later', 191, 'posts', 'approved', '2025-08-15 09:07:11', '2025-08-15 09:07:51', NULL),
(28, 15, NULL, NULL, NULL, 'Honestly, I came here just to skim, but ended up reading every word. Great job keeping it engaging!', 191, 'posts', 'approved', '2025-08-15 09:08:12', '2025-08-15 09:08:23', NULL),
(29, 15, NULL, NULL, NULL, 'This topic has been on my mind for weeks, and you just explained it way better than any YouTube video I’ve watched.', 195, 'posts', 'approved', '2025-08-15 09:08:52', '2025-08-15 09:11:40', NULL),
(30, 15, NULL, NULL, NULL, 'Not gonna lie, I had my doubts before clicking—but wow, this was actually helpful. Props to the writer!', 195, 'posts', 'approved', '2025-08-15 09:09:09', '2025-08-15 09:11:41', NULL),
(31, 15, NULL, NULL, NULL, 'Clear, concise, and straight to the point. Wish more blog posts were written like this.', 198, 'posts', 'approved', '2025-08-15 09:09:30', '2025-08-15 09:11:41', NULL),
(32, 15, NULL, NULL, NULL, 'The way you broke this down makes it so much less intimidating. Thanks for making it simple for beginners like me.', 198, 'posts', 'approved', '2025-08-15 09:09:41', '2025-08-15 09:11:41', NULL),
(33, 15, NULL, NULL, NULL, 'I’ve read a lot about this, but your example in section three really clicked for me. Nicely done!', 199, 'posts', 'approved', '2025-08-15 09:10:16', '2025-08-15 09:11:41', NULL),
(34, 15, NULL, NULL, NULL, 'Okay… but why isn’t this post ranking #1 on Google? This is gold compared to the fluff out there.', 199, 'posts', 'approved', '2025-08-15 09:10:25', '2025-08-15 09:11:41', NULL),
(35, 15, NULL, NULL, NULL, 'I’m definitely sharing this with a few friends who’ve been struggling with the same thing.', 200, 'posts', 'approved', '2025-08-15 09:10:49', '2025-08-15 09:11:41', NULL),
(36, 15, NULL, NULL, NULL, 'Great post! Although I’d love to see you dive deeper into Top It Trends In 2025. What Businesses Need To Know in a future article.', 200, 'posts', 'approved', '2025-08-15 09:11:09', '2025-08-15 09:11:41', NULL),
(37, 15, NULL, NULL, NULL, 'Way better than I expected. Setup took 5 minutes and it just works.', 268, 'products', 'approved', '2025-08-15 09:14:55', '2025-08-15 09:15:15', '{\"rating\":\"5\"}'),
(38, 15, NULL, NULL, NULL, 'Solid quality for the price. Shipping was a day late, but the product’s great.', 268, 'products', 'pending', '2025-08-15 09:16:17', '2025-08-15 09:16:17', '{\"rating\":\"1\"}'),
(39, 15, NULL, NULL, NULL, 'Love the clean design. Feels premium without the premium price tag.', 257, 'products', 'pending', '2025-08-15 09:16:51', '2025-08-15 09:16:51', '{\"rating\":\"4\"}'),
(40, 15, NULL, NULL, NULL, 'Does the job, but the instructions were a bit confusing. Could be clearer.', 257, 'products', 'pending', '2025-08-15 09:16:59', '2025-08-15 09:16:59', '{\"rating\":\"5\"}'),
(41, 15, NULL, NULL, NULL, 'Customer support answered in under 10 minutes. Very impressed.', 258, 'products', 'pending', '2025-08-15 09:17:23', '2025-08-15 09:17:23', '{\"rating\":\"3\"}'),
(42, 15, NULL, NULL, NULL, 'Works as advertised. I wish the cable was a little longer though.', 258, 'products', 'approved', '2025-08-15 09:17:34', '2025-08-15 09:20:01', '{\"rating\":\"4\"}'),
(43, 15, NULL, NULL, NULL, 'Bought it for my studio—already recommended to two friends.', 260, 'products', 'approved', '2025-08-15 09:17:55', '2025-08-15 09:20:01', '{\"rating\":\"2\"}'),
(44, 15, NULL, NULL, NULL, 'Good build, nice finish. Packaging had a small dent but no damage inside.', 260, 'products', 'approved', '2025-08-15 09:18:06', '2025-08-15 09:20:01', '{\"rating\":\"4\"}'),
(45, 15, NULL, NULL, NULL, 'Exactly what I needed. Plugged in and it started right away—no hassle.', 266, 'products', 'approved', '2025-08-15 09:18:29', '2025-08-15 09:20:01', '{\"rating\":\"5\"}'),
(46, 15, NULL, NULL, NULL, 'Works, but not great for heavy use. Gets warm after an hour.', 266, 'products', 'approved', '2025-08-15 09:18:39', '2025-08-15 09:20:01', '{\"rating\":\"2\"}'),
(47, 15, NULL, NULL, NULL, 'Super easy to use. The quick start guide is actually helpful (rare!).', 255, 'products', 'approved', '2025-08-15 09:19:02', '2025-08-15 09:20:01', '{\"rating\":\"5\"}'),
(48, 15, NULL, NULL, NULL, 'Performance is smooth. Please add dark mode in the next update.', 255, 'products', 'approved', '2025-08-15 09:19:11', '2025-08-15 09:20:01', '{\"rating\":\"2\"}'),
(49, 15, NULL, NULL, NULL, 'Five stars. Looks sleek on my desk and feels sturdy.', 264, 'products', 'approved', '2025-08-15 09:19:34', '2025-08-15 09:20:01', '{\"rating\":\"5\"}'),
(50, 15, NULL, NULL, NULL, 'It’s okay—doesn’t match the color in the photos exactly, but still fine.', 264, 'products', 'approved', '2025-08-15 09:19:43', '2025-08-15 09:20:01', '{\"rating\":\"4\"}'),
(51, 15, NULL, NULL, NULL, 'Honestly, this made my workflow faster. Worth every taka/dollar.', 264, 'products', 'approved', '2025-08-15 09:19:52', '2025-08-15 09:20:01', '{\"rating\":\"3\"}');

-- --------------------------------------------------------

--
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_configs`
--

INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES
(1, 'title', 'Mojar - Laravel CMS for Your Project'),
(2, 'description', 'Mojar is a Content Management System (CMS) and web platform whose sole purpose is to make your development workflow simple again.'),
(3, 'author_name', 'Mojar Team'),
(4, 'user_registration', '1'),
(5, 'user_verification', '1'),
(6, 'logo', '2025/08/10/logo-1.png'),
(7, 'icon', '2025/08/10/android-chrome-192x192.png'),
(8, 'sitename', 'Mojar'),
(9, 'google_analytics', NULL),
(10, 'timezone', 'UTC'),
(11, 'date_format', 'F j, Y'),
(12, 'date_format_custom', 'F j, Y'),
(13, 'time_format', 'g:i a'),
(14, 'time_format_custom', 'g:i a'),
(15, 'fb_app_id', NULL),
(16, 'captcha', NULL),
(17, 'plugin_statuses', '{\"juzaweb\\/movie\":\"juzaweb\\/movie\",\"mojar\\/example\":\"mojar\\/example\",\"mojarsoft\\/dev-tool\":\"mojarsoft\\/dev-tool\",\"mojahid\\/edufax-helper\":\"mojahid\\/edufax-helper\",\"mojahid\\/contact-form\":\"mojahid\\/contact-form\",\"mojahid\\/agenico-companion\":\"mojahid\\/agenico-companion\",\"mojahid\\/techguru-companion\":\"mojahid\\/techguru-companion\",\"mojahid\\/newsletters\":\"mojahid\\/newsletters\",\"mojahid\\/ecommerce\":\"mojahid\\/ecommerce\",\"mojahid\\/chatbot-integration\":\"mojahid\\/chatbot-integration\",\"mojahid\\/cookie-settings\":\"mojahid\\/cookie-settings\",\"mojahid\\/pos-system\":\"mojahid\\/pos-system\",\"mojahid\\/support-ticket\":\"mojahid\\/support-ticket\",\"mojahid\\/pwa-manager\":\"mojahid\\/pwa-manager\"}'),
(18, 'ecom_store_address1', '{\"type\":\"text\",\"label\":\"Store Address 1\"}'),
(19, 'ecom_store_address2', '{\"type\":\"text\",\"label\":\"Store Address 2\"}'),
(20, 'ecom_city', '{\"type\":\"text\",\"label\":\"City\"}'),
(21, 'ecom_country', '{\"type\":\"text\",\"label\":\"Country\"}'),
(22, 'ecom_zipcode', '{\"type\":\"text\",\"label\":\"Zip Code\"}'),
(23, 'app_enable_sitemap', '0'),
(24, 'app_enable_post_feed', '0'),
(25, 'app_enable_taxonomy_feed', '1'),
(26, 'app_auto_ping_google_sitemap', '1'),
(27, 'app_auto_submit_url_google', '0'),
(28, 'app_auto_submit_url_bing', '1'),
(29, 'app_bing_api_key', NULL),
(30, 'app_auto_add_tags_to_posts', '0'),
(31, 'bing_verify_key', NULL),
(32, 'google_verify_key', NULL),
(34, 'app_backup_enable', '0'),
(35, 'app_backup_time', 'daily'),
(36, 'theme_statuses', '{\"name\":\"techguru\",\"namespace\":\"Theme\\\\\",\"path\":\"\\/home\\/mojarsof\\/techguru-laravel\\/modules\\/..\\/themes\\/techguru\"}'),
(37, 'backend_messages', '[]'),
(38, 'email', '{\"host\":\"sandbox.smtp.mailtrap.io\",\"port\":\"2525\",\"encryption\":\"tls\",\"username\":\"8274485a2f435a\",\"password\":\"58e43f671f64c5\",\"from_address\":\"raofahmedmojahid@gmail.com\",\"from_name\":\"Raof\"}'),
(39, '_checkout_page', '17'),
(40, '_thanks_page', '18'),
(41, 'ecom_enable_multi_currency', '0'),
(42, 'ecom_allow_currency_switcher', '1'),
(43, 'ecom_force_checkout_currency', 'USD'),
(44, 'ecom_exchange_rate_api', NULL),
(45, 'ecom_exchange_rate_api_key', NULL),
(46, 'ecom_auto_update_exchange', '0'),
(47, 'ecomm_enable_multi_currency', '0'),
(48, 'ecomm_allow_currency_switcher', '1'),
(49, 'ecomm_force_checkout_currency', NULL),
(50, 'ecomm_exchange_rate_api', NULL),
(51, 'ecomm_exchange_rate_api_key', NULL),
(52, 'ecomm_auto_update_exchange', '0'),
(53, 'auth_layout', 'with_cover'),
(54, 'socialites', '{\"facebook\":{\"enable\":\"1\",\"client_id\":\"2187966388334794\",\"client_secret\":\"4180558cae3dc87a023e4be0f1fb1a8e\"},\"google\":{\"client_id\":\"863203378823-5e5a0i8tsb3nf7jqb0jdpritj9flibio.apps.googleusercontent.com\",\"client_secret\":\"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\",\"enable\":\"1\"},\"twitter\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"0\"},\"linkedin\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"0\"},\"github\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"0\"}}'),
(55, 'auto_resize_thumbnail', '{\"pages\":\"1\",\"posts\":\"0\",\"theme\":\"0\",\"plugin\":\"0\",\"products\":\"0\",\"events\":\"0\"}'),
(56, 'thumbnail_defaults', '{\"pages\":null,\"posts\":null,\"theme\":null,\"plugin\":null,\"products\":null,\"events\":null}'),
(57, 'evman_store_address1', NULL),
(58, 'evman_store_address2', NULL),
(59, 'evman_city', NULL),
(60, 'evman_country', NULL),
(61, 'evman_zipcode', NULL),
(62, 'evman_event_default_status', 'active'),
(63, 'evman_ticket_default_status', 'active'),
(64, 'evman_ticket_prefix', 'EVT-'),
(65, 'evman_email_notification', '1'),
(66, 'evman_booking_expiry_time', '30'),
(67, 'evman_date_format', 'Y-m-d'),
(68, 'evman_time_format', 'H:i'),
(69, 'evman_checkout_page', NULL),
(70, 'evman_thanks_page', NULL),
(71, '_store_address1', NULL),
(72, '_store_address2', NULL),
(73, '_city', NULL),
(74, '_country', NULL),
(75, '_zipcode', NULL),
(76, 'lms_default_course_status', 'draft'),
(77, 'lms_course_permalink_base', 'course'),
(78, 'lms_course_access_mode', 'open'),
(79, 'lms_course_display_mode', 'all'),
(80, 'lms_student_registration', '0'),
(81, 'lms_student_role', 'subscriber'),
(82, 'lms_progress_tracking', '0'),
(83, 'lms_auto_complete_lesson', '0'),
(84, 'lms_enable_reviews', '0'),
(85, 'lms_instructor_application', '0'),
(86, 'lms_instructor_commission', '70'),
(87, 'lms_auto_approve_instructor', '0'),
(88, 'lms_enable_certificates', '0'),
(89, 'lms_certificate_logo', NULL),
(90, 'lms_certificate_signature', NULL),
(91, 'lms_certificate_template', 'default'),
(92, 'lms_email_new_course', '0'),
(93, 'lms_email_course_completion', '0'),
(94, 'lms_email_enrollment', '0'),
(95, 'lms_courses_page', NULL),
(96, 'lms_my_courses_page', NULL),
(97, 'lms_checkout_page', NULL),
(98, 'lms_thank_you_page', NULL),
(99, 'lms_instructor_page', NULL),
(100, 'show_on_front', 'page'),
(101, 'home_page', '250'),
(102, 'posts_per_page', '6'),
(103, 'posts_per_rss', '10'),
(104, 'post_page', '133'),
(105, 'ecomm_auto_detect_currency', '0'),
(106, 'support_email', 'support2@example.com'),
(107, 'support_phone', '123321341'),
(108, 'support_working_hours', 'Monday - Friday, 9:00 AM - 6:00 PM'),
(109, 'support_welcome_message', 'Welcome to our support system. How can we help you today?'),
(110, 'tickets_per_page', '10'),
(111, 'enable_attachments', '1'),
(112, 'max_attachment_size', '10'),
(113, 'allowed_attachment_types', 'jpg,jpeg,png,gif,pdf,doc,docx,txt'),
(114, 'enable_auto_close', '0'),
(115, 'auto_close_days', '30'),
(116, 'notify_before_close', '0'),
(117, 'notify_days_before', '3'),
(118, 'enable_escalation', '0'),
(119, 'escalation_hours', '24'),
(120, 'escalation_level', 'supervisor'),
(121, 'enable_auto_assignment', '0'),
(122, 'assignment_method', 'round_robin'),
(123, 'auto_assignment_rules', NULL),
(124, 'notify_new_ticket', '0'),
(125, 'notify_ticket_reply', '0'),
(126, 'notify_status_change', '0'),
(127, 'notify_assignment', '0'),
(128, 'notify_escalation', '0'),
(129, 'notify_staff_dashboard', '0'),
(130, 'notify_staff_email', '0'),
(131, 'notify_staff_sms', '0'),
(132, 'notification_interval', '15'),
(133, 'new_ticket_template', 'New ticket #{ticket_id} has been created by {customer_name}. Subject: {ticket_subject}'),
(134, 'ticket_reply_template', 'Ticket #{ticket_id} has received a new reply from {replier_name}.'),
(135, 'ticket_closed_template', 'Ticket #{ticket_id} has been closed by {closed_by}.'),
(136, 'enable_rating', '0'),
(137, 'rating_scale', '5'),
(138, 'require_rating', '0'),
(139, 'rating_reminder_days', '1'),
(140, 'rate_response_time', '1'),
(141, 'rate_solution_quality', '0'),
(142, 'rate_staff_courtesy', '0'),
(143, 'rate_overall_satisfaction', '0'),
(144, 'enable_feedback', '0'),
(145, 'rating_thank_you_message', 'Thank you for your feedback! Your rating helps us improve our support service.'),
(146, 'low_rating_message', 'We apologize for not meeting your expectations. Please let us know how we can improve.'),
(147, 'editor_type', 'ckeditor'),
(148, 'enable_rich_editor', '1'),
(149, 'enable_file_upload', '1'),
(150, 'enable_image_upload', '1'),
(151, 'enable_bold_italic', '0'),
(152, 'enable_lists', '0'),
(153, 'enable_links', '0'),
(154, 'enable_code_blocks', '0'),
(155, 'editor_toolbar_buttons', 'bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink,|,image,|,undo,redo'),
(156, 'editor_height', '300'),
(157, 'editor_custom_css', NULL),
(158, 'support_timezone', 'UTC'),
(159, 'enable_sla', '1'),
(160, 'sla_response_time', '4'),
(161, 'sla_resolution_time', '24'),
(162, 'sla_escalation_time', '8'),
(163, 'sla_working_hours', 'Monday-Friday 9:00-18:00'),
(164, 'enable_api', '0'),
(165, 'api_rate_limit', '100'),
(166, 'enable_webhook', '0'),
(167, 'webhook_url', NULL),
(168, 'webhook_secret', NULL),
(169, 'notify_sla_breach', '0'),
(170, 'enable_sms_notifications', '0'),
(171, 'sms_provider', 'twilio'),
(172, 'sms_api_key', NULL),
(173, 'sms_api_secret', NULL),
(174, 'sms_from_number', NULL),
(175, 'enable_reports', '0'),
(176, 'report_retention_days', '365'),
(177, 'auto_generate_reports', '0'),
(178, 'report_frequency', 'weekly'),
(179, 'report_recipients', NULL),
(180, 'ticket_assigned_template', 'Ticket #{ticket_id} has been assigned to you. Subject: {ticket_subject}'),
(181, 'sla_breach_template', 'SLA breach alert: Ticket #{ticket_id} has exceeded the response time limit.'),
(182, 'cookie_enabled', '1'),
(183, 'cookie_position', 'bottom'),
(184, 'cookie_theme', 'light'),
(185, 'cookie_auto_hide', '0'),
(186, 'cookie_hide_delay', '15'),
(187, 'cookie_remember_days', '30'),
(188, 'cookie_force_consent', '0'),
(189, 'cookie_title', 'We use cookies'),
(190, 'cookie_message', 'This website uses cookies to improve your experience. By continuing to use this site, you consent to our use of cookies.'),
(191, 'cookie_accept_text', 'Accept'),
(192, 'cookie_decline_text', 'Decline'),
(193, 'cookie_settings_text', 'Cookie Settings'),
(194, 'cookie_policy_link', 'http://up-latest-techguru.test/policy'),
(195, 'cookie_policy_text', 'Privacy Policy'),
(196, 'cookie_essential_enabled', '1'),
(197, 'cookie_analytics_enabled', '1'),
(198, 'cookie_marketing_enabled', '1'),
(199, 'cookie_preferences_enabled', '1'),
(200, 'cookie_banner_bg_color', '#0a0e27'),
(201, 'cookie_banner_text_color', '#ffffff'),
(202, 'cookie_button_bg_color', '#3377ff'),
(203, 'cookie_button_text_color', '#ffffff'),
(204, 'cookie_border_radius', '8px'),
(205, 'cookie_box_shadow', '0 4px 15px rgba(0,0,0,0.2)'),
(206, 'cookie_domain', NULL),
(207, 'cookie_path', '/'),
(208, 'cookie_secure', '0'),
(209, 'cookie_same_site', 'Lax'),
(210, 'cookie_custom_css', NULL),
(211, 'cover', '2025/09/21/showing-cart-trolley-shopping-online-sign-graphic.jpg'),
(212, 'different_auth_logo', '2025/09/21/logo.png'),
(213, 'chatbot_enabled', '1'),
(214, 'chatbot_providers', '{\"crisp\":{\"website_id\":\"ccf790ac-fa35-4b4d-a5c7-11cede54cebc\",\"position\":\"left\",\"locale\":\"auto\",\"color\":\"#a1129c\",\"enabled\":\"0\"},\"tidio\":{\"public_key\":\"noinokxpp2batndagnergw5aqzt7sprx\",\"position\":\"left\",\"primary_color\":\"#0799b6\",\"enabled\":\"0\",\"hide_when_offline\":\"0\"},\"whatsapp\":{\"phone_number\":\"01773362695\",\"default_message\":\"Hello! How can I help you? 21\",\"enabled\":\"1\",\"position\":\"bottom-left\",\"auto_show_delay\":\"1\"},\"messenger\":{\"page_id\":\"61575929876987\",\"app_id\":\"2343418709407657\",\"theme_color\":\"#7f1fb2\",\"logged_in_greeting\":\"Hi! How can we help you?\",\"logged_out_greeting\":\"Hi! How can we help you? Please log in to continue.\",\"enabled\":\"0\"},\"livechat\":{\"license_id\":\"19282697\",\"group_id\":\"1\",\"position\":\"right\",\"theme_color\":\"#0078d4\",\"auto_show_delay\":\"4\",\"enabled\":\"0\",\"hide_when_offline\":\"1\"},\"zendesk\":{\"account_key\":\"f25b20eb-1131-43e9-9561-9507c62e5044\",\"position\":\"bottom-right\",\"theme_color\":\"#39bc15\",\"auto_show_delay\":\"1\",\"department\":null,\"enabled\":\"0\",\"widget_key\":\"f25b20eb-1131-43e9-9561-9507c62e5044\"},\"tawkto\":{\"property_id\":\"6802972fd84fea190d7eed9f\",\"widget_id\":\"1ip51t4gs\",\"position\":\"bl\",\"theme_color\":\"#00a78f\",\"auto_show_delay\":\"1\",\"enabled\":\"0\",\"hide_when_offline\":\"1\",\"invisible_mode\":\"0\"},\"intercom\":{\"enabled\":\"1\",\"app_id\":null,\"position\":\"bottom-right\",\"theme_color\":\"#1f73f1\",\"auto_show_delay\":\"0\",\"hide_launcher\":\"0\"},\"hubspot\":{\"enabled\":\"1\",\"portal_id\":\"243721716\",\"region\":\"eu1\",\"theme_color\":\"#ce5d40\",\"auto_show_delay\":\"0\",\"disable_mobile\":\"0\"},\"drift\":{\"enabled\":\"0\",\"drift_id\":null,\"theme_color\":\"#7c3aed\",\"auto_show_delay\":\"0\"},\"freshchat\":{\"enabled\":\"1\",\"app_id\":\"c3ac93b9d0b672d17564517\",\"token\":\"eyJraWQiOiJjdXN0b20tb2F1dGgta2V5aWQiLCJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJmcmVzaGNoYXQiLCJhdWQiOiJmcmVzaGNoYXQiLCJpYXQiOjE3NTY0MDQ1MzEsInNjb3BlIjoiYWdlbnQ6cmVhZCBhZ2VudDpjcmVhdGUgYWdlbnQ6dXBkYXRlIGFnZW50OmRlbGV0ZSBjb252ZXJzYXRpb246Y3JlYXRlIGNvbnZlcnNhdGlvbjpyZWFkIGNvbnZlcnNhdGlvbjp1cGRhdGUgbWVzc2FnZTpjcmVhdGUgbWVzc2FnZTpnZXQgYmlsbGluZzp1cGRhdGUgcmVwb3J0czpmZXRjaCByZXBvcnRzOmV4dHJhY3QgcmVwb3J0czpyZWFkIHJlcG9ydHM6ZXh0cmFjdDpyZWFkIGFjY291bnQ6cmVhZCBkYXNoYm9hcmQ6cmVhZCB1c2VyOnJlYWQgdXNlcjpjcmVhdGUgdXNlcjp1cGRhdGUgdXNlcjpkZWxldGUgb3V0Ym91bmRtZXNzYWdlOnNlbmQgb3V0Ym91bmRtZXNzYWdlOmdldCBtZXNzYWdpbmctY2hhbm5lbHM6bWVzc2FnZTpzZW5kIG1lc3NhZ2luZy1jaGFubmVsczptZXNzYWdlOmdldCBtZXNzYWdpbmctY2hhbm5lbHM6dGVtcGxhdGU6Y3JlYXRlIG1lc3NhZ2luZy1jaGFubmVsczp0ZW1wbGF0ZTpnZXQgZmlsdGVyaW5ib3g6cmVhZCBmaWx0ZXJpbmJveDpjb3VudDpyZWFkIHJvbGU6cmVhZCBpbWFnZTp1cGxvYWQiLCJ0eXAiOiJCZWFyZXIiLCJjbGllbnRJZCI6ImZjLTEwMjFlMmU5LWVhNTQtNDFkNy1hNGVhLTRlNzI0NTk3ZTNmZiIsInN1YiI6ImE1MmI5ZmMzLTM3NmEtNDllMi1iNTZlLTYwZGJhMDAxZjAwNSIsImp0aSI6IjkxNWY3MTMzLWE4ZjItNGMzZS04ZjExLWJkYzgwMGRmZWUzOSIsImV4cCI6MjA3MTkzNzMzMX0.rC-vNzN_nM0vvRvrqJ_J7IKGaEXQdQigEM2kJeAPiFY\",\"theme_color\":\"#0066cc\",\"auto_show_delay\":\"0\"},\"chatra\":{\"enabled\":\"1\",\"chatra_id\":\"HgmYumqXBNgPtmWpR\",\"theme_color\":\"#2196f3\",\"auto_show_delay\":\"1\"},\"smartsupp\":{\"enabled\":\"0\",\"smartsupp_key\":null,\"theme_color\":\"#4caf50\",\"auto_show_delay\":\"0\"},\"userlike\":{\"enabled\":\"0\",\"userlike_widget_id\":null,\"theme_color\":\"#4285f4\",\"auto_show_delay\":\"0\"}}'),
(215, 'chatbot_logging_enabled', '1'),
(216, 'pwa_enabled', '1'),
(217, 'pwa_app_name', 'Mojar - Laravel CMS for Your Project'),
(218, 'pwa_short_name', 'App'),
(219, 'pwa_description', 'Mojar is a Content Management System (CMS) and web platform whose sole purpose is to make your development workflow simple again.'),
(220, 'pwa_theme_color', '#6777ef'),
(221, 'pwa_background_color', '#961d1d'),
(222, 'pwa_display', 'standalone'),
(223, 'pwa_start_url', '/'),
(224, 'pwa_show_install_button', '0'),
(225, 'pwa_init_delay', '1000'),
(226, 'pwa_logo', '2025/08/29/8d57eac4b78e83e49793fb8503c6b82d.png'),
(227, 'pwa_orientation', 'any'),
(228, 'pwa_scope', '/'),
(229, 'pwa_cache_strategy', 'network_first');

-- --------------------------------------------------------

--
-- Table structure for table `app_contact_form_contacts`
--

CREATE TABLE `app_contact_form_contacts` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_contact_form_contacts`
--

INSERT INTO `app_contact_form_contacts` (`id`, `name`, `email`, `subject`, `message`, `metas`, `site_id`, `created_at`, `updated_at`) VALUES
('2fdd9e3c-de99-4ca2-b1f4-10c414df613e', 'Maria Gomez', 'maria.gomez@example.com', 'Need a quotation', 'Could you send me a quote for 200 custom-printed bags?', NULL, 0, '2025-08-15 09:28:02', '2025-08-15 09:28:02'),
('472b0a77-603a-4bf5-9781-c7a0f0312c8e', 'Hasan Chowdhury', 'hasan.c@example.net', 'Service request', 'The device I bought last month isn’t turning on. Please advise next steps.', NULL, 0, '2025-08-15 09:28:23', '2025-08-15 09:28:23'),
('627edb8f-f3bc-4454-b766-91336ff8de94', 'Priya Kapoor', 'priya.kapoor@example.org', 'Feedback on recent order', 'Just wanted to say the delivery was super fast! Very happy with my purchase.', NULL, 0, '2025-08-15 09:27:20', '2025-08-15 09:27:20'),
('6fc8575c-d303-4a99-998a-ff74be859e54', 'Sarah Mitchell', 'sarah.m@example.com', 'Inquiry about bulk order', 'Hi, I’m interested in ordering 50 units. Could you share the bulk pricing details?', NULL, 0, '2025-08-15 09:26:03', '2025-08-15 09:26:03'),
('943644be-548e-4be6-8bcf-33dbb94c0ea9', 'Ahmed Rahman', 'ahmed.rahman@example.net', 'Website issue', 'I tried submitting my payment but the checkout page froze. Can you help?', NULL, 0, '2025-08-15 09:26:21', '2025-08-15 09:26:21'),
('c5752a65-bad7-46b7-a12b-e11daa450561', 'Kevin Adams', 'kevin.adams@example.net', 'Shipping delay', 'My order #2541 hasn’t arrived yet. Could you check the tracking?', NULL, 0, '2025-08-15 09:27:44', '2025-08-15 09:27:44'),
('d966738c-3666-4c9c-9c73-c9a7665b5d8a', 'Michael Torres', 'm.torres@example.com', 'Product availability', 'Is the model X300 still in stock? I need two units before the 15th.', NULL, 0, '2025-08-15 09:27:03', '2025-08-15 09:27:03'),
('ebfc5805-56d5-4452-bfdf-fd50b0d43f1e', 'Laura Chen', 'laura.chen@example.org', 'Request for collaboration', 'I run a small marketing agency and would love to discuss a possible partnership.', NULL, 0, '2025-08-15 09:26:39', '2025-08-15 09:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_addons`
--

CREATE TABLE `app_ecomm_addons` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_url` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `is_premium` tinyint(1) NOT NULL DEFAULT '0',
  `license_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_backorder_requests`
--

CREATE TABLE `app_ecomm_backorder_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `requested_quantity` int NOT NULL,
  `available_quantity` int NOT NULL DEFAULT '0',
  `status` enum('pending','approved','rejected','fulfilled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `processed_by` bigint UNSIGNED DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_carts`
--

CREATE TABLE `app_ecomm_carts` (
  `id` bigint UNSIGNED NOT NULL,
  `code` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_codes` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_target_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_ecomm_carts`
--

INSERT INTO `app_ecomm_carts` (`id`, `code`, `items`, `user_id`, `discount`, `discount_codes`, `discount_target_type`, `site_id`, `created_at`, `updated_at`) VALUES
(239, 'aa5746db-2106-4300-87dc-ae47f93ac47d', '\"{\\\"products_258\\\":{\\\"post_id\\\":258,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":540,\\\"title\\\":\\\"robot gesturing\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/08\\\\\\/14\\\\\\/shop-product-1-2.png\\\",\\\"sku_code\\\":\\\"13213\\\",\\\"barcode\\\":\\\"132312\\\",\\\"compare_price\\\":430,\\\"line_price\\\":540}}\"', 15, 0.00, NULL, NULL, 0, '2025-08-14 16:31:07', '2025-08-14 16:31:07'),
(241, '79290dbf-e07b-4f28-918e-387e99540ba8', '\"{\\\"products_260\\\":{\\\"post_id\\\":260,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":760,\\\"title\\\":\\\"snowboard boot\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/08\\\\\\/14\\\\\\/shop-product-1-6.png\\\",\\\"sku_code\\\":\\\"123123\\\",\\\"barcode\\\":\\\"qweqwe\\\",\\\"compare_price\\\":500,\\\"line_price\\\":760}}\"', 52, 0.00, NULL, NULL, 0, '2025-08-14 17:06:08', '2025-08-14 17:06:08'),
(264, 'd98c4b77-4db7-47fd-ba5c-9a4684c7847d', '\"{\\\"products_259\\\":{\\\"post_id\\\":259,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":460,\\\"title\\\":\\\"ski helmet with visor\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/08\\\\\\/14\\\\\\/shop-product-1-5.png\\\",\\\"sku_code\\\":\\\"13131\\\",\\\"barcode\\\":\\\"2312312\\\",\\\"compare_price\\\":332,\\\"line_price\\\":460},\\\"products_268\\\":{\\\"post_id\\\":268,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":300,\\\"title\\\":\\\"snowboard boot William\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/08\\\\\\/14\\\\\\/shop-product-1-2-1.png\\\",\\\"sku_code\\\":\\\"123123\\\",\\\"barcode\\\":\\\"122321\\\",\\\"compare_price\\\":340,\\\"line_price\\\":300}}\"', NULL, 0.00, NULL, NULL, 0, '2025-09-21 00:10:11', '2025-09-21 00:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_currencies`
--

CREATE TABLE `app_ecomm_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` double(8,2) NOT NULL DEFAULT '1.00',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_position` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thousand_separator` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_separator` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_place` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_point` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_format` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_price_format` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_ecomm_currencies`
--

INSERT INTO `app_ecomm_currencies` (`id`, `code`, `symbol`, `exchange_rate`, `is_default`, `is_enabled`, `name`, `symbol_position`, `thousand_separator`, `decimal_separator`, `decimal_place`, `decimal_point`, `currency_format`, `custom_price_format`, `created_at`, `updated_at`) VALUES
(1, 'BD', '৳', 120.00, 0, 1, 'Taka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 22:38:01', '2025-04-09 19:17:49'),
(2, 'IN', '₹', 90.00, 0, 1, 'Rupy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 22:44:02', '2025-08-04 21:07:18'),
(3, 'PK', 'Rs', 140.00, 0, 1, 'Rupy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-02 09:24:12', '2025-04-09 19:17:49'),
(4, 'Dollar', '$', 1.00, 0, 1, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 11:21:31', '2025-08-09 18:01:19'),
(5, 'new car', '^', 10.00, 0, 1, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-04 21:05:00', '2025-08-04 21:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_discounts`
--

CREATE TABLE `app_ecomm_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `value` decimal(10,2) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maximum_discount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `usage_limit_per_customer` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `free_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `applicable_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `applicable_categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `excluded_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `excluded_categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `app_ecomm_discounts`
--

INSERT INTO `app_ecomm_discounts` (`id`, `title`, `code`, `description`, `type`, `value`, `minimum_amount`, `maximum_discount`, `usage_limit`, `usage_limit_per_customer`, `used_count`, `is_active`, `free_shipping`, `start_date`, `end_date`, `applicable_products`, `applicable_categories`, `excluded_products`, `excluded_categories`, `site_id`, `created_at`, `updated_at`) VALUES
(1, 'Summer Sale Special', 'SUMMER25', 'Save $25 on your order of $100 or more this summer season.', 'percentage', 25.00, 100.00, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-08-15 09:41:20', '2025-08-15 09:41:20'),
(2, 'Welcome Gift', 'WELCOME10', 'A little welcome gift—get $10 off when you spend $50+.', 'percentage', 10.00, 50.00, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-08-15 09:41:57', '2025-08-15 09:41:57'),
(3, 'Back to School Bonus', 'BTS15', 'Perfect for students! $15 off on orders above $75.', 'percentage', 15.00, 75.00, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-08-15 09:42:34', '2025-08-15 09:42:34'),
(4, 'Weekend Treat', 'WKND20', 'Enjoy $20 off when you shop over $120 this weekend only.', 'percentage', 20.00, 120.00, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-08-15 09:43:18', '2025-08-15 09:43:18'),
(5, 'VIP Exclusive', 'VIP50', 'Our VIPs get $50 off any order over $200.', 'percentage', 50.00, 200.00, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-08-15 09:45:00', '2025-08-15 09:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_wishlists`
--

CREATE TABLE `app_ecomm_wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `code` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `app_ecomm_wishlists`
--

INSERT INTO `app_ecomm_wishlists` (`id`, `code`, `items`, `user_id`, `site_id`, `created_at`, `updated_at`) VALUES
(21, '4cff2027-d69f-4864-a358-e3c57d66676b', '\"{\\\"products_257\\\":{\\\"post_id\\\":257,\\\"type\\\":\\\"products\\\",\\\"price\\\":33,\\\"title\\\":\\\"motorcycle helme\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/08\\\\\\/14\\\\\\/shop-product-1-1.png\\\",\\\"sku_code\\\":\\\"1312312312\\\",\\\"barcode\\\":\\\"1231212321\\\",\\\"compare_price\\\":32,\\\"added_at\\\":\\\"2025-08-14 17:06:02\\\"},\\\"products_256\\\":{\\\"post_id\\\":256,\\\"type\\\":\\\"products\\\",\\\"price\\\":320,\\\"title\\\":\\\"3d render robo\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/08\\\\\\/14\\\\\\/shop-product-1-4.png\\\",\\\"sku_code\\\":\\\"1221\\\",\\\"barcode\\\":\\\"1321\\\",\\\"compare_price\\\":340,\\\"added_at\\\":\\\"2025-08-14 17:06:06\\\"}}\"', 52, 0, '2025-08-14 17:06:02', '2025-08-14 17:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecom_download_links`
--

CREATE TABLE `app_ecom_download_links` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_email_lists`
--

CREATE TABLE `app_email_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `params` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending => processing => (success || error)',
  `priority` int NOT NULL DEFAULT '1',
  `error` text COLLATE utf8mb4_unicode_ci,
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `template_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_email_lists`
--

INSERT INTO `app_email_lists` (`id`, `email`, `template_id`, `params`, `status`, `priority`, `error`, `data`, `created_at`, `updated_at`, `template_code`) VALUES
(1, 'raad@adsfda.com', NULL, '{\"name\":\"Admin\"}', 'success', 1, NULL, '{\"subject\":\"Send email for Admin\",\"body\":\"Hello Admin, If you receive this email, it means that your config email on Mojar is active.\"}', '2025-04-02 12:10:58', '2025-04-02 12:11:06', 'test_email'),
(2, 'student2@gmail.com', 3, '{\"name\":\"Student 2\",\"email\":\"student2@gmail.com\",\"verifyToken\":\"qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\",\"verifyUrl\":\"http:\\/\\/mojar-cms.test\\/verification\\/student2@gmail.com\\/qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Student 2,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/mojar-cms.test\\/verification\\/student2@gmail.com\\/qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-04-02 12:24:39', '2025-04-02 12:24:44', 'verification'),
(3, 'raofahmedmojahid@gmail.com', NULL, '{\"name\":\"admin@gmail.com\"}', 'success', 1, NULL, '{\"subject\":\"Send email for admin@gmail.com\",\"body\":\"Hello admin@gmail.com, If you receive this email, it means that your config email on Mojar is active.\"}', '2025-08-01 22:01:51', '2025-08-01 22:01:59', 'test_email'),
(4, 'vytezu@mailinator.com', 3, '{\"name\":\"Zeus Mcintosh\",\"email\":\"vytezu@mailinator.com\",\"verifyToken\":\"BZ7a8qYwNU5odnRJqF1J21Qffq2tIzR7\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/vytezu@mailinator.com\\/BZ7a8qYwNU5odnRJqF1J21Qffq2tIzR7\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Zeus Mcintosh,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/vytezu@mailinator.com\\/BZ7a8qYwNU5odnRJqF1J21Qffq2tIzR7\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-01 22:04:20', '2025-08-01 22:04:27', 'verification'),
(5, 'peqi@mailinator.com', 3, '{\"name\":\"Hamish York\",\"email\":\"peqi@mailinator.com\",\"verifyToken\":\"I46H9mVgwWCTac5MQOlcWbP6OtRfAKzR\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/peqi@mailinator.com\\/I46H9mVgwWCTac5MQOlcWbP6OtRfAKzR\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Hamish York,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/peqi@mailinator.com\\/I46H9mVgwWCTac5MQOlcWbP6OtRfAKzR\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-01 22:33:12', '2025-08-01 22:33:19', 'verification'),
(6, 'kuxoka@mailinator.com', 3, '{\"name\":\"Lydia Cantrell\",\"email\":\"kuxoka@mailinator.com\",\"verifyToken\":\"oQOOmg3x0bVdF3xzSYXtDW5YPJqATF41\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/kuxoka@mailinator.com\\/oQOOmg3x0bVdF3xzSYXtDW5YPJqATF41\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Lydia Cantrell,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/kuxoka@mailinator.com\\/oQOOmg3x0bVdF3xzSYXtDW5YPJqATF41\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 01:09:58', '2025-08-02 01:10:02', 'verification'),
(7, 'tycypyleq@mailinator.com', 3, '{\"name\":\"Kay Bailey\",\"email\":\"tycypyleq@mailinator.com\",\"verifyToken\":\"oTFWVcAezOxRFX4JMs9CRXYz208nKJCF\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/tycypyleq@mailinator.com\\/oTFWVcAezOxRFX4JMs9CRXYz208nKJCF\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Kay Bailey,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/tycypyleq@mailinator.com\\/oTFWVcAezOxRFX4JMs9CRXYz208nKJCF\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 01:16:51', '2025-08-02 01:16:56', 'verification'),
(8, 'raleseh@mailinator.com', 3, '{\"name\":\"Xaviera Clarke\",\"email\":\"raleseh@mailinator.com\",\"verifyToken\":\"QOeQPByFFHHzAjI5yf7525fqOkJ8pRDQ\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/raleseh@mailinator.com\\/QOeQPByFFHHzAjI5yf7525fqOkJ8pRDQ\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Xaviera Clarke,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/raleseh@mailinator.com\\/QOeQPByFFHHzAjI5yf7525fqOkJ8pRDQ\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 01:58:40', '2025-08-02 01:58:46', 'verification'),
(9, 'zoludi@mailinator.com', 3, '{\"name\":\"Tasha Leonard\",\"email\":\"zoludi@mailinator.com\",\"verifyToken\":\"PnHj4IwYlloXw1E77qapCD8PhYYTpe7q\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/zoludi@mailinator.com\\/PnHj4IwYlloXw1E77qapCD8PhYYTpe7q\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Tasha Leonard,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/zoludi@mailinator.com\\/PnHj4IwYlloXw1E77qapCD8PhYYTpe7q\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 03:13:41', '2025-08-02 03:13:45', 'verification'),
(10, 'myxiqune@mailinator.com', 3, '{\"name\":\"Dominic Daugherty\",\"email\":\"myxiqune@mailinator.com\",\"verifyToken\":\"6L7fvfWcIq1MbbdpMN21M6ZbwrZib7Ma\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/myxiqune@mailinator.com\\/6L7fvfWcIq1MbbdpMN21M6ZbwrZib7Ma\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Dominic Daugherty,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/myxiqune@mailinator.com\\/6L7fvfWcIq1MbbdpMN21M6ZbwrZib7Ma\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 03:31:06', '2025-08-02 03:31:11', 'verification'),
(11, 'diduhutiji@mailinator.com', 3, '{\"name\":\"Cameron Goodwin\",\"email\":\"diduhutiji@mailinator.com\",\"verifyToken\":\"CWDQj1oPSsVKLhB6KwK1AcG6om4tmg4F\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/diduhutiji@mailinator.com\\/CWDQj1oPSsVKLhB6KwK1AcG6om4tmg4F\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Cameron Goodwin,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/diduhutiji@mailinator.com\\/CWDQj1oPSsVKLhB6KwK1AcG6om4tmg4F\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 03:37:28', '2025-08-02 03:37:33', 'verification'),
(12, 'zavo@mailinator.com', 3, '{\"name\":\"Maile Miller\",\"email\":\"zavo@mailinator.com\",\"verifyToken\":\"Z68k5o4sYNlRU4HxE2mWHFYya6M66x2f\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/zavo@mailinator.com\\/Z68k5o4sYNlRU4HxE2mWHFYya6M66x2f\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Maile Miller,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/zavo@mailinator.com\\/Z68k5o4sYNlRU4HxE2mWHFYya6M66x2f\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 03:41:22', '2025-08-02 03:41:28', 'verification'),
(13, 'pupubola@mailinator.com', 3, '{\"name\":\"Margaret Hunt\",\"email\":\"pupubola@mailinator.com\",\"verifyToken\":\"FOe7v4zrjNnwTS5JxTWm9ymjkngiqPFm\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/pupubola@mailinator.com\\/FOe7v4zrjNnwTS5JxTWm9ymjkngiqPFm\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Margaret Hunt,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/pupubola@mailinator.com\\/FOe7v4zrjNnwTS5JxTWm9ymjkngiqPFm\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 03:45:28', '2025-08-02 03:45:33', 'verification'),
(14, 'hizocedok@mailinator.com', 3, '{\"name\":\"Declan Gill\",\"email\":\"hizocedok@mailinator.com\",\"verifyToken\":\"g2JtdctrIOfGY2PHZkTPfqrQykFhl5Hl\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/hizocedok@mailinator.com\\/g2JtdctrIOfGY2PHZkTPfqrQykFhl5Hl\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Declan Gill,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/hizocedok@mailinator.com\\/g2JtdctrIOfGY2PHZkTPfqrQykFhl5Hl\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 03:48:45', '2025-08-02 03:48:46', 'verification'),
(15, 'wiboxun@mailinator.com', 3, '{\"name\":\"Zephania Armstrong\",\"email\":\"wiboxun@mailinator.com\",\"verifyToken\":\"ufuUJR9J9cAJx2aQkLNVYPKe8zfqTY41\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/wiboxun@mailinator.com\\/ufuUJR9J9cAJx2aQkLNVYPKe8zfqTY41\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Zephania Armstrong,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/wiboxun@mailinator.com\\/ufuUJR9J9cAJx2aQkLNVYPKe8zfqTY41\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 04:30:30', '2025-08-02 04:30:32', 'verification'),
(16, 'larohobyno@mailinator.com', 3, '{\"name\":\"Jordan Combs\",\"email\":\"larohobyno@mailinator.com\",\"verifyToken\":\"4vRjHNkGkb54UA150ooBRnGGxEEyphZN\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/larohobyno@mailinator.com\\/4vRjHNkGkb54UA150ooBRnGGxEEyphZN\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Jordan Combs,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/larohobyno@mailinator.com\\/4vRjHNkGkb54UA150ooBRnGGxEEyphZN\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 04:45:54', '2025-08-02 04:45:56', 'verification'),
(17, 'doxanaca@mailinator.com', 3, '{\"name\":\"Beatrice Decker\",\"email\":\"doxanaca@mailinator.com\",\"verifyToken\":\"gEAGSOL2lZbfRHZCd6AcVHH0sSb8RgIm\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/doxanaca@mailinator.com\\/gEAGSOL2lZbfRHZCd6AcVHH0sSb8RgIm\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Beatrice Decker,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/doxanaca@mailinator.com\\/gEAGSOL2lZbfRHZCd6AcVHH0sSb8RgIm\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 05:52:33', '2025-08-02 05:52:35', 'verification'),
(18, 'dyquvy@mailinator.com', 3, '{\"name\":\"Constance Murray\",\"email\":\"dyquvy@mailinator.com\",\"verifyToken\":\"x2lueyN6vX3dbkc9KeIuj1TOlyGuypXL\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/dyquvy@mailinator.com\\/x2lueyN6vX3dbkc9KeIuj1TOlyGuypXL\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Constance Murray,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/dyquvy@mailinator.com\\/x2lueyN6vX3dbkc9KeIuj1TOlyGuypXL\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 06:23:21', '2025-08-02 06:23:23', 'verification'),
(19, 'cyxofisodo@mailinator.com', 3, '{\"name\":\"Lavinia Castillo\",\"email\":\"cyxofisodo@mailinator.com\",\"verifyToken\":\"4gDyJvQxkjeGd7cAxo2Lu4FVET1uOqLK\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/cyxofisodo@mailinator.com\\/4gDyJvQxkjeGd7cAxo2Lu4FVET1uOqLK\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Lavinia Castillo,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/cyxofisodo@mailinator.com\\/4gDyJvQxkjeGd7cAxo2Lu4FVET1uOqLK\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 06:28:27', '2025-08-02 06:28:29', 'verification'),
(20, 'pixyfeq@mailinator.com', 3, '{\"name\":\"Hope Levy\",\"email\":\"pixyfeq@mailinator.com\",\"verifyToken\":\"zWdpCJa13melaTG6ENqqfvT4xCL2FOc2\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/pixyfeq@mailinator.com\\/zWdpCJa13melaTG6ENqqfvT4xCL2FOc2\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Hope Levy,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/pixyfeq@mailinator.com\\/zWdpCJa13melaTG6ENqqfvT4xCL2FOc2\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 06:30:51', '2025-08-02 06:30:52', 'verification'),
(21, 'mahod@mailinator.com', 3, '{\"name\":\"Leilani Pugh\",\"email\":\"mahod@mailinator.com\",\"verifyToken\":\"C3DCxqeiihl3dge6hFmT7m30FOxOD9EY\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/mahod@mailinator.com\\/C3DCxqeiihl3dge6hFmT7m30FOxOD9EY\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Leilani Pugh,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/mahod@mailinator.com\\/C3DCxqeiihl3dge6hFmT7m30FOxOD9EY\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 06:34:05', '2025-08-02 06:34:06', 'verification'),
(22, 'pory@mailinator.com', 3, '{\"name\":\"Lila Good\",\"email\":\"pory@mailinator.com\",\"verifyToken\":\"Zj2aJeKdemYEsiSHbHWJe0BTTUcHvFK6\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/pory@mailinator.com\\/Zj2aJeKdemYEsiSHbHWJe0BTTUcHvFK6\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Lila Good,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/pory@mailinator.com\\/Zj2aJeKdemYEsiSHbHWJe0BTTUcHvFK6\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 06:46:33', '2025-08-02 06:46:34', 'verification'),
(23, 'lizykisy@mailinator.com', 3, '{\"name\":\"Dorian Blackwell\",\"email\":\"lizykisy@mailinator.com\",\"verifyToken\":\"apGsboQWo7gGDQ3D9je1h9qzM7UTRPOt\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/lizykisy@mailinator.com\\/apGsboQWo7gGDQ3D9je1h9qzM7UTRPOt\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Dorian Blackwell,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/lizykisy@mailinator.com\\/apGsboQWo7gGDQ3D9je1h9qzM7UTRPOt\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 07:05:36', '2025-08-02 07:05:37', 'verification'),
(24, 'jolesy@mailinator.com', 3, '{\"name\":\"Amena Williamson\",\"email\":\"jolesy@mailinator.com\",\"verifyToken\":\"cpzt3HgIYl7wzm5p9xQQrbszGwow3dXR\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/jolesy@mailinator.com\\/cpzt3HgIYl7wzm5p9xQQrbszGwow3dXR\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Amena Williamson,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/jolesy@mailinator.com\\/cpzt3HgIYl7wzm5p9xQQrbszGwow3dXR\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 07:47:26', '2025-08-02 07:47:27', 'verification'),
(25, 'byqyxenu@mailinator.com', 3, '{\"name\":\"Taylor Morris\",\"email\":\"byqyxenu@mailinator.com\",\"verifyToken\":\"FwqpHbHkAxh3A2H3LuaSBktd6bROjby5\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/byqyxenu@mailinator.com\\/FwqpHbHkAxh3A2H3LuaSBktd6bROjby5\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Taylor Morris,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/byqyxenu@mailinator.com\\/FwqpHbHkAxh3A2H3LuaSBktd6bROjby5\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 08:23:43', '2025-08-02 08:23:45', 'verification'),
(26, 'leger@mailinator.com', 3, '{\"name\":\"Constance Pugh\",\"email\":\"leger@mailinator.com\",\"verifyToken\":\"06UKQm3KFGGptU86o7ooYRvYqgmSokb6\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/leger@mailinator.com\\/06UKQm3KFGGptU86o7ooYRvYqgmSokb6\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Constance Pugh,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/leger@mailinator.com\\/06UKQm3KFGGptU86o7ooYRvYqgmSokb6\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 08:24:13', '2025-08-02 08:24:15', 'verification'),
(27, 'bowini@mailinator.com', 3, '{\"name\":\"Rooney Sweeney\",\"email\":\"bowini@mailinator.com\",\"verifyToken\":\"PiTl7yqMUku3FhqReGu78aIp0m5XLcx0\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/bowini@mailinator.com\\/PiTl7yqMUku3FhqReGu78aIp0m5XLcx0\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Rooney Sweeney,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/bowini@mailinator.com\\/PiTl7yqMUku3FhqReGu78aIp0m5XLcx0\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 09:32:11', '2025-08-02 09:32:13', 'verification'),
(28, 'vendor2@gmail.com', 3, '{\"name\":\"vendor\",\"email\":\"vendor2@gmail.com\",\"verifyToken\":\"64RIRBJukHqtq8EL8mLTxYSuSTpFJ2fN\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/vendor2@gmail.com\\/64RIRBJukHqtq8EL8mLTxYSuSTpFJ2fN\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello vendor,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/vendor2@gmail.com\\/64RIRBJukHqtq8EL8mLTxYSuSTpFJ2fN\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-02 10:13:01', '2025-08-02 10:13:03', 'verification'),
(29, 'vendor3@gmail.com', 3, '{\"name\":\"Vendor 3\",\"email\":\"vendor3@gmail.com\",\"verifyToken\":\"EL5y7k3dyzyNAnlOAi5rGdKiGqZgb6ol\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/vendor3@gmail.com\\/EL5y7k3dyzyNAnlOAi5rGdKiGqZgb6ol\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Vendor 3,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/vendor3@gmail.com\\/EL5y7k3dyzyNAnlOAi5rGdKiGqZgb6ol\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-04 09:17:30', '2025-08-04 09:17:32', 'verification'),
(30, 'bilufavaqu@mailinator.com', 3, '{\"name\":\"Quentin Sampson\",\"email\":\"bilufavaqu@mailinator.com\",\"verifyToken\":\"iAuM9bDIrmMw8gAh1i7NPWLEt11ALoSG\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/bilufavaqu@mailinator.com\\/iAuM9bDIrmMw8gAh1i7NPWLEt11ALoSG\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Quentin Sampson,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/bilufavaqu@mailinator.com\\/iAuM9bDIrmMw8gAh1i7NPWLEt11ALoSG\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-07 12:08:15', '2025-08-07 12:08:21', 'verification'),
(31, 'customer@gmail.com', 3, '{\"name\":\"Customer\",\"email\":\"customer@gmail.com\",\"verifyToken\":\"yMKeBMWEfUrQBaxYigux2QMFxYsLBOuU\",\"verifyUrl\":\"http:\\/\\/techguru.test\\/verification\\/customer@gmail.com\\/yMKeBMWEfUrQBaxYigux2QMFxYsLBOuU\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Customer,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/techguru.test\\/verification\\/customer@gmail.com\\/yMKeBMWEfUrQBaxYigux2QMFxYsLBOuU\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-08 09:00:11', '2025-08-08 09:00:18', 'verification'),
(32, 'raofahmedmojahid@gmail.com', NULL, '{\"name\":\"Thomas Alison\"}', 'success', 1, NULL, '{\"subject\":\"Send email for Thomas Alison\",\"body\":\"Hello Thomas Alison, If you receive this email, it means that your config email on Mojar is active.\"}', '2025-08-14 16:58:46', '2025-08-14 16:58:49', 'test_email'),
(33, 'vendor@gmail.com', 3, '{\"name\":\"Vendor William\",\"email\":\"vendor@gmail.com\",\"verifyToken\":\"PbM3Nw5j47R2HvSSoH7n2H54ybPnNoaa\",\"verifyUrl\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/verification\\/vendor@gmail.com\\/PbM3Nw5j47R2HvSSoH7n2H54ybPnNoaa\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Vendor William,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"https:\\/\\/techguru-laravel.mojarsoft.com\\/verification\\/vendor@gmail.com\\/PbM3Nw5j47R2HvSSoH7n2H54ybPnNoaa\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-14 17:10:22', '2025-08-14 17:10:23', 'verification'),
(34, 'education.mojahid@gmail.com', 3, '{\"name\":\"Mojahid islam\",\"email\":\"education.mojahid@gmail.com\",\"verifyToken\":\"WV5tNojXeTMTHFIURj8JfASBIwaAI2ge\",\"verifyUrl\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/verification\\/education.mojahid@gmail.com\\/WV5tNojXeTMTHFIURj8JfASBIwaAI2ge\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Mojahid islam,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"https:\\/\\/techguru-laravel.mojarsoft.com\\/verification\\/education.mojahid@gmail.com\\/WV5tNojXeTMTHFIURj8JfASBIwaAI2ge\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-08-16 13:54:10', '2025-08-16 13:54:14', 'verification');

-- --------------------------------------------------------

--
-- Table structure for table `app_email_templates`
--

CREATE TABLE `app_email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `layout` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_hook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `to_sender` tinyint(1) NOT NULL DEFAULT '1',
  `to_emails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_email_templates`
--

INSERT INTO `app_email_templates` (`id`, `code`, `subject`, `body`, `params`, `layout`, `created_at`, `updated_at`, `email_hook`, `uuid`, `active`, `to_sender`, `to_emails`) VALUES
(1, 'forgot_password', 'Password Reset for you account', '<p>Someone has requested a password reset for the following account:</p>\r\n<p>Email: {{ email }}</p>\r\n<p>If this was a mistake, just ignore this email and nothing will happen.To reset your password, visit the following address:</p>\r\n<p><a href=\"{{ url }}\" target=\"_blank\">{{ url }}</a></p>', '{\"name\":\"Full Name\",\"email\":\"Email\",\"url\":\"Url reset password\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, '886836c2-c751-4448-9bf4-b7590babf14b', 1, 1, NULL),
(2, 'notification', '{{ subject }}', '{{ body }}', '{\"subject\":\"Subject notify\",\"body\":\"Body notify\",\"name\":\"User name\",\"email\":\"User Email address\",\"url\":\"Url notify\",\"image\":\"Image notify\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, 'fa2b1445-6726-4b94-aee7-17be8282131d', 1, 1, NULL),
(3, 'verification', 'Verify your account', '<p>Hello {{ name }},</p>\r\n<p>Thank you for register. Please click the link below to Verify your account</p>\r\n<p><a href=\"{{ verifyUrl }}\" target=\"_blank\">Verify account</a></p>', '{\"name\":\"Your Name\",\"verifyUrl\":\"Url verify account\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, '395c245c-5353-475b-b7cb-6a24641a4599', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_email_template_users`
--

CREATE TABLE `app_email_template_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `email_template_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_failed_jobs`
--

CREATE TABLE `app_failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_jobs`
--

CREATE TABLE `app_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_languages`
--

CREATE TABLE `app_languages` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_languages`
--

INSERT INTO `app_languages` (`id`, `code`, `name`, `default`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, '2025-02-28 06:41:01', '2025-02-28 06:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `app_language_lines`
--

CREATE TABLE `app_language_lines` (
  `id` bigint UNSIGNED NOT NULL,
  `namespace` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `object_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_key` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_manual_notifications`
--

CREATE TABLE `app_manual_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `method` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `error` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_media_files`
--

CREATE TABLE `app_media_files` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `mime_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint NOT NULL DEFAULT '0',
  `folder_id` bigint DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_media_files`
--

INSERT INTO `app_media_files` (`id`, `name`, `type`, `mime_type`, `path`, `extension`, `size`, `folder_id`, `user_id`, `created_at`, `updated_at`, `disk`, `metadata`) VALUES
(316, 'blog-1-1.jpg', 'image', 'image/jpeg', '2025/08/10/blog-1-1.jpg', 'jpg', 42850, 27, 15, '2025-08-10 06:54:31', '2025-08-10 06:54:31', 'public', NULL),
(317, 'sidebar-client-img-1.jpg', 'image', 'image/jpeg', '2025/08/10/sidebar-client-img-1.jpg', 'jpg', 10914, 27, 15, '2025-08-10 13:26:25', '2025-08-10 13:26:25', 'public', NULL),
(318, 'page-header-bg.jpg', 'image', 'image/jpeg', '2025/08/10/page-header-bg.jpg', 'jpg', 152780, NULL, 15, '2025-08-10 13:28:49', '2025-08-10 13:28:49', 'public', NULL),
(319, 'logo-1.png', 'image', 'image/png', '2025/08/10/logo-1.png', 'png', 4264, NULL, 15, '2025-08-10 13:30:38', '2025-08-10 13:30:38', 'public', NULL),
(320, 'android-chrome-192x192.png', 'image', 'image/png', '2025/08/10/android-chrome-192x192.png', 'png', 50811, NULL, 15, '2025-08-10 13:31:06', '2025-08-10 13:31:06', 'public', NULL),
(321, 'blog-details-img-box-img-2.jpg', 'file', 'image/jpeg', '2025/08/10/blog-details-img-box-img-2.jpg', 'jpg', 49058, 27, 15, '2025-08-10 13:42:11', '2025-08-10 13:42:11', 'public', NULL),
(322, 'blog-details-img-box-img-1.jpg', 'file', 'image/jpeg', '2025/08/10/blog-details-img-box-img-1.jpg', 'jpg', 60742, 27, 15, '2025-08-10 13:42:29', '2025-08-10 13:42:29', 'public', NULL),
(323, 'quote.png', 'file', 'image/png', '2025/08/10/quote.png', 'png', 13002, 27, 15, '2025-08-10 13:43:32', '2025-08-10 13:43:32', 'public', NULL),
(324, 'blog-details-points-img.jpg', 'file', 'image/jpeg', '2025/08/10/blog-details-points-img.jpg', 'jpg', 34078, 27, 15, '2025-08-10 13:44:14', '2025-08-10 13:44:14', 'public', NULL),
(325, 'blog-1-2.jpg', 'image', 'image/jpeg', '2025/08/12/blog-1-2.jpg', 'jpg', 43888, 27, 15, '2025-08-12 13:39:28', '2025-08-12 13:39:28', 'public', NULL),
(326, 'blog-1-3.jpg', 'image', 'image/jpeg', '2025/08/12/blog-1-3.jpg', 'jpg', 33472, 27, 15, '2025-08-12 13:41:13', '2025-08-12 13:41:13', 'public', NULL),
(327, 'blog-1-4.jpg', 'image', 'image/jpeg', '2025/08/12/blog-1-4.jpg', 'jpg', 33353, 27, 15, '2025-08-12 13:41:35', '2025-08-12 13:41:35', 'public', NULL),
(328, 'blog-1-5.jpg', 'image', 'image/jpeg', '2025/08/12/blog-1-5.jpg', 'jpg', 44977, 27, 15, '2025-08-12 13:42:25', '2025-08-12 13:42:25', 'public', NULL),
(329, 'blog-list-1-1.jpg', 'image', 'image/jpeg', '2025/08/12/blog-list-1-1.jpg', 'jpg', 117367, 27, 15, '2025-08-12 14:20:18', '2025-08-12 14:20:18', 'public', NULL),
(330, 'blog-list-1-2.jpg', 'image', 'image/jpeg', '2025/08/12/blog-list-1-2.jpg', 'jpg', 125746, 27, 15, '2025-08-12 14:20:40', '2025-08-12 14:20:40', 'public', NULL),
(331, 'blog-list-1-3.jpg', 'image', 'image/jpeg', '2025/08/12/blog-list-1-3.jpg', 'jpg', 97924, 27, 15, '2025-08-12 14:20:57', '2025-08-12 14:20:57', 'public', NULL),
(332, 'contact-one-bg-shape.png', 'image', 'image/png', '2025/08/12/contact-one-bg-shape.png', 'png', 271020, NULL, 15, '2025-08-12 14:36:07', '2025-08-12 14:36:07', 'public', NULL),
(333, 'faq-two-shape-1.png', 'image', 'image/png', '2025/08/12/faq-two-shape-1.png', 'png', 82232, NULL, 15, '2025-08-12 14:44:53', '2025-08-12 14:44:53', 'public', NULL),
(334, 'faq-two-shape-2.png', 'image', 'image/png', '2025/08/12/faq-two-shape-2.png', 'png', 83296, NULL, 15, '2025-08-12 14:45:06', '2025-08-12 14:45:06', 'public', NULL),
(335, 'section-title-img.jpg', 'image', 'image/jpeg', '2025/08/12/section-title-img.jpg', 'jpg', 4985, 28, 15, '2025-08-12 14:57:51', '2025-08-12 14:57:51', 'public', NULL),
(336, 'services-two-round-icon.png', 'image', 'image/png', '2025/08/12/services-two-round-icon.png', 'png', 1722, 28, 15, '2025-08-12 14:59:36', '2025-08-12 14:59:36', 'public', NULL),
(337, 'process-one-shape-1.png', 'image', 'image/png', '2025/08/12/process-one-shape-1.png', 'png', 3036, 28, 15, '2025-08-12 15:15:31', '2025-08-12 15:15:31', 'public', NULL),
(338, 'process-one-bg-shape.png', 'image', 'image/png', '2025/08/12/process-one-bg-shape.png', 'png', 87321, 28, 15, '2025-08-12 15:15:42', '2025-08-12 15:15:42', 'public', NULL),
(339, 'services-2-1.jpg', 'image', 'image/jpeg', '2025/08/12/services-2-1.jpg', 'jpg', 42736, 28, 15, '2025-08-12 15:59:17', '2025-08-12 15:59:17', 'public', NULL),
(340, 'services-details-img-5.jpg', 'file', 'image/jpeg', '2025/08/12/services-details-img-5.jpg', 'jpg', 68252, 28, 15, '2025-08-12 16:03:10', '2025-08-12 16:03:10', 'public', NULL),
(341, 'services-details-img-box-img-1.jpg', 'file', 'image/jpeg', '2025/08/12/services-details-img-box-img-1.jpg', 'jpg', 60413, 28, 15, '2025-08-12 16:04:09', '2025-08-12 16:04:09', 'public', NULL),
(342, 'services-details-img-box-img-2.jpg', 'file', 'image/jpeg', '2025/08/12/services-details-img-box-img-2.jpg', 'jpg', 78650, 28, 15, '2025-08-12 16:04:14', '2025-08-12 16:04:14', 'public', NULL),
(343, 'services-details-bottom-img.jpg', 'file', 'image/jpeg', '2025/08/12/services-details-bottom-img.jpg', 'jpg', 75578, 28, 15, '2025-08-12 16:05:19', '2025-08-12 16:05:19', 'public', NULL),
(344, 'testimonial-2-2.jpg', 'image', 'image/jpeg', '2025/08/12/testimonial-2-2.jpg', 'jpg', 3600, NULL, 15, '2025-08-12 16:30:09', '2025-08-12 16:30:09', 'public', NULL),
(345, 'testimonial-2-3.jpg', 'image', 'image/jpeg', '2025/08/12/testimonial-2-3.jpg', 'jpg', 3610, NULL, 15, '2025-08-12 16:31:48', '2025-08-12 16:31:48', 'public', NULL),
(346, 'testimonial-2-1.jpg', 'image', 'image/jpeg', '2025/08/12/testimonial-2-1.jpg', 'jpg', 2976, NULL, 15, '2025-08-12 16:32:37', '2025-08-12 16:32:37', 'public', NULL),
(347, 'services-2-2.jpg', 'image', 'image/jpeg', '2025/08/12/services-2-2.jpg', 'jpg', 39252, 28, 15, '2025-08-12 16:41:45', '2025-08-12 16:41:45', 'public', NULL),
(348, 'services-2-3.jpg', 'image', 'image/jpeg', '2025/08/12/services-2-3.jpg', 'jpg', 48718, 28, 15, '2025-08-12 16:43:37', '2025-08-12 16:43:37', 'public', NULL),
(349, 'services-2-4.jpg', 'image', 'image/jpeg', '2025/08/12/services-2-4.jpg', 'jpg', 32056, 28, 15, '2025-08-12 16:44:44', '2025-08-12 16:44:44', 'public', NULL),
(350, 'team-1-1.jpg', 'image', 'image/jpeg', '2025/08/13/team-1-1.jpg', 'jpg', 38441, 29, 15, '2025-08-13 03:04:19', '2025-08-13 03:04:19', 'public', NULL),
(351, 'skill-one-img-1.jpg', 'image', 'image/jpeg', '2025/08/13/skill-one-img-1.jpg', 'jpg', 235894, 29, 15, '2025-08-13 03:07:00', '2025-08-13 03:07:00', 'public', NULL),
(352, 'pricing-icon-1.png', 'image', 'image/png', '2025/08/14/pricing-icon-1.png', 'png', 1171, NULL, 15, '2025-08-14 05:36:43', '2025-08-14 05:36:43', 'public', NULL),
(353, 'portfolio-1-1.jpg', 'image', 'image/jpeg', '2025/08/14/portfolio-1-1.jpg', 'jpg', 45962, 30, 15, '2025-08-14 05:59:46', '2025-08-14 05:59:46', 'public', NULL),
(354, 'portfolio-details-img-1.jpg', 'file', 'image/jpeg', '2025/08/14/portfolio-details-img-1.jpg', 'jpg', 146504, 30, 15, '2025-08-14 06:15:37', '2025-08-14 06:15:37', 'public', NULL),
(355, 'portfolio-details-img-box-img-1.jpg', 'file', 'image/jpeg', '2025/08/14/portfolio-details-img-box-img-1.jpg', 'jpg', 76696, 30, 15, '2025-08-14 06:17:15', '2025-08-14 06:17:15', 'public', NULL),
(356, 'portfolio-details-img-box-img-2.jpg', 'file', 'image/jpeg', '2025/08/14/portfolio-details-img-box-img-2.jpg', 'jpg', 70254, 30, 15, '2025-08-14 06:17:37', '2025-08-14 06:17:37', 'public', NULL),
(357, 'portfolio-details-img-box-img-3.jpg', 'file', 'image/jpeg', '2025/08/14/portfolio-details-img-box-img-3.jpg', 'jpg', 170277, 30, 15, '2025-08-14 06:17:56', '2025-08-14 06:17:56', 'public', NULL),
(358, 'portfolio-details-img-box-2-img.jpg', 'file', 'image/jpeg', '2025/08/14/portfolio-details-img-box-2-img.jpg', 'jpg', 55457, 30, 15, '2025-08-14 06:18:23', '2025-08-14 06:18:23', 'public', NULL),
(359, 'portfolio-1-2.jpg', 'image', 'image/jpeg', '2025/08/14/portfolio-1-2.jpg', 'jpg', 43066, 30, 15, '2025-08-14 06:38:16', '2025-08-14 06:38:16', 'public', NULL),
(360, 'portfolio-1-3.jpg', 'image', 'image/jpeg', '2025/08/14/portfolio-1-3.jpg', 'jpg', 67025, 30, 15, '2025-08-14 06:39:07', '2025-08-14 06:39:07', 'public', NULL),
(361, 'portfolio-1-4.jpg', 'image', 'image/jpeg', '2025/08/14/portfolio-1-4.jpg', 'jpg', 58747, 30, 15, '2025-08-14 06:40:33', '2025-08-14 06:40:33', 'public', NULL),
(362, 'portfolio-1-5.jpg', 'image', 'image/jpeg', '2025/08/14/portfolio-1-5.jpg', 'jpg', 63317, 30, 15, '2025-08-14 06:41:38', '2025-08-14 06:41:38', 'public', NULL),
(363, 'portfolio-1-6.jpg', 'image', 'image/jpeg', '2025/08/14/portfolio-1-6.jpg', 'jpg', 64847, 30, 15, '2025-08-14 06:41:58', '2025-08-14 06:41:58', 'public', NULL),
(364, 'team-1-2.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-2.jpg', 'jpg', 34928, 29, 15, '2025-08-14 07:04:34', '2025-08-14 07:04:34', 'public', NULL),
(365, 'team-1-3.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-3.jpg', 'jpg', 40531, 29, 15, '2025-08-14 07:05:43', '2025-08-14 07:05:43', 'public', NULL),
(366, 'team-1-4.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-4.jpg', 'jpg', 39798, 29, 15, '2025-08-14 07:06:32', '2025-08-14 07:06:32', 'public', NULL),
(367, 'team-1-5.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-5.jpg', 'jpg', 31949, 29, 15, '2025-08-14 07:07:06', '2025-08-14 07:07:06', 'public', NULL),
(368, 'team-1-6.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-6.jpg', 'jpg', 40300, 29, 15, '2025-08-14 07:07:36', '2025-08-14 07:07:36', 'public', NULL),
(369, 'team-1-6.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-6-1.jpg', 'jpg', 40300, 29, 15, '2025-08-14 07:08:11', '2025-08-14 07:08:11', 'public', NULL),
(370, 'team-1-7.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-7.jpg', 'jpg', 35530, 29, 15, '2025-08-14 07:08:15', '2025-08-14 07:08:15', 'public', NULL),
(371, 'team-1-8.jpg', 'image', 'image/jpeg', '2025/08/14/team-1-8.jpg', 'jpg', 35840, 29, 15, '2025-08-14 07:08:48', '2025-08-14 07:08:48', 'public', NULL),
(372, 'about-four-client-img-1-2.jpg', 'image', 'image/jpeg', '2025/08/14/about-four-client-img-1-2.jpg', 'jpg', 2074, NULL, 15, '2025-08-14 08:42:21', '2025-08-14 08:42:21', 'public', NULL),
(373, 'about-four-client-img-1-3.jpg', 'image', 'image/jpeg', '2025/08/14/about-four-client-img-1-3.jpg', 'jpg', 1700, NULL, 15, '2025-08-14 08:42:32', '2025-08-14 08:42:32', 'public', NULL),
(374, 'about-four-client-img-1-1.jpg', 'image', 'image/jpeg', '2025/08/14/about-four-client-img-1-1.jpg', 'jpg', 1600, NULL, 15, '2025-08-14 08:42:40', '2025-08-14 08:42:40', 'public', NULL),
(375, 'why-choose-three-img.jpg', 'image', 'image/jpeg', '2025/08/14/why-choose-three-img.jpg', 'jpg', 33128, NULL, 15, '2025-08-14 08:44:35', '2025-08-14 08:44:35', 'public', NULL),
(376, 'team-two-bg-shape.png', 'image', 'image/png', '2025/08/14/team-two-bg-shape.png', 'png', 81300, NULL, 15, '2025-08-14 08:58:00', '2025-08-14 08:58:00', 'public', NULL),
(377, 'team-2-1.png', 'image', 'image/png', '2025/08/14/team-2-1.png', 'png', 60378, 29, 15, '2025-08-14 08:58:57', '2025-08-14 08:58:57', 'public', NULL),
(378, 'team-2-1.jpg', 'image', 'image/png', '2025/08/14/team-2-1.jpg', 'jpg', 239877, 29, 15, '2025-08-14 09:00:32', '2025-08-14 09:00:32', 'public', NULL),
(379, 'team-2-2.jpg', 'image', 'image/jpeg', '2025/08/14/team-2-2.jpg', 'jpg', 10779, 29, 15, '2025-08-14 09:02:21', '2025-08-14 09:02:21', 'public', NULL),
(380, 'team-2-3.jpg', 'image', 'image/png', '2025/08/14/team-2-3.jpg', 'jpg', 199412, 29, 15, '2025-08-14 09:03:19', '2025-08-14 09:03:19', 'public', NULL),
(381, 'slider-2-1.jpg', 'image', 'image/jpeg', '2025/08/14/slider-2-1.jpg', 'jpg', 159894, NULL, 15, '2025-08-14 09:09:01', '2025-08-14 09:09:01', 'public', NULL),
(382, 'main-slider-shield-check-icon.png', 'image', 'image/png', '2025/08/14/main-slider-shield-check-icon.png', 'png', 463, NULL, 15, '2025-08-14 09:11:53', '2025-08-14 09:11:53', 'public', NULL),
(383, 'main-slider-sub-title-icon.png', 'image', 'image/png', '2025/08/14/main-slider-sub-title-icon.png', 'png', 844, NULL, 15, '2025-08-14 09:12:02', '2025-08-14 09:12:02', 'public', NULL),
(384, 'main-slider-two-shape-2.png', 'image', 'image/png', '2025/08/14/main-slider-two-shape-2.png', 'png', 14645, NULL, 15, '2025-08-14 09:13:38', '2025-08-14 09:13:38', 'public', NULL),
(385, 'main-slider-two-shape-3.png', 'image', 'image/png', '2025/08/14/main-slider-two-shape-3.png', 'png', 12708, NULL, 15, '2025-08-14 09:13:48', '2025-08-14 09:13:48', 'public', NULL),
(386, 'brand-1-1.png', 'image', 'image/png', '2025/08/14/brand-1-1.png', 'png', 1432, NULL, 15, '2025-08-14 09:15:45', '2025-08-14 09:15:45', 'public', NULL),
(387, 'brand-1-2.png', 'image', 'image/png', '2025/08/14/brand-1-2.png', 'png', 1210, NULL, 15, '2025-08-14 09:15:53', '2025-08-14 09:15:53', 'public', NULL),
(388, 'brand-1-3.png', 'image', 'image/png', '2025/08/14/brand-1-3.png', 'png', 1546, NULL, 15, '2025-08-14 09:16:00', '2025-08-14 09:16:00', 'public', NULL),
(389, 'brand-1-4.png', 'image', 'image/png', '2025/08/14/brand-1-4.png', 'png', 1143, NULL, 15, '2025-08-14 09:16:11', '2025-08-14 09:16:11', 'public', NULL),
(390, 'brand-1-5.png', 'image', 'image/png', '2025/08/14/brand-1-5.png', 'png', 1576, NULL, 15, '2025-08-14 09:16:18', '2025-08-14 09:16:18', 'public', NULL),
(391, 'main-slider-trustpilot-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/main-slider-trustpilot-img-1.jpg', 'jpg', 2063, NULL, 15, '2025-08-14 09:17:44', '2025-08-14 09:17:44', 'public', NULL),
(392, 'main-slider-trustpilot-img-2.jpg', 'image', 'image/jpeg', '2025/08/14/main-slider-trustpilot-img-2.jpg', 'jpg', 2597, NULL, 15, '2025-08-14 09:17:50', '2025-08-14 09:17:50', 'public', NULL),
(393, 'main-slider-trustpilot-logo.png', 'image', 'image/png', '2025/08/14/main-slider-trustpilot-logo.png', 'png', 1126, NULL, 15, '2025-08-14 09:17:59', '2025-08-14 09:17:59', 'public', NULL),
(394, 'slider-2-2.jpg', 'image', 'image/jpeg', '2025/08/14/slider-2-2.jpg', 'jpg', 151714, NULL, 15, '2025-08-14 09:21:54', '2025-08-14 09:21:54', 'public', NULL),
(395, 'slider-2-3.jpg', 'image', 'image/jpeg', '2025/08/14/slider-2-3.jpg', 'jpg', 203480, NULL, 15, '2025-08-14 09:21:59', '2025-08-14 09:21:59', 'public', NULL),
(396, 'about-two-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/about-two-img-1.jpg', 'jpg', 54902, NULL, 15, '2025-08-14 09:42:25', '2025-08-14 09:42:25', 'public', NULL),
(397, 'about-two-img-2.jpg', 'image', 'image/jpeg', '2025/08/14/about-two-img-2.jpg', 'jpg', 76484, NULL, 15, '2025-08-14 09:42:32', '2025-08-14 09:42:32', 'public', NULL),
(398, 'about-two-shape-3.png', 'image', 'image/png', '2025/08/14/about-two-shape-3.png', 'png', 21539, NULL, 15, '2025-08-14 09:43:18', '2025-08-14 09:43:18', 'public', NULL),
(399, 'why-choose-one-client-img.jpg', 'image', 'image/jpeg', '2025/08/14/why-choose-one-client-img.jpg', 'jpg', 2022, NULL, 15, '2025-08-14 09:53:20', '2025-08-14 09:53:20', 'public', NULL),
(400, 'why-choose-one-img-1.png', 'image', 'image/png', '2025/08/14/why-choose-one-img-1.png', 'png', 188778, NULL, 15, '2025-08-14 09:53:47', '2025-08-14 09:53:47', 'public', NULL),
(401, 'process-two-bg.jpg', 'image', 'image/jpeg', '2025/08/14/process-two-bg.jpg', 'jpg', 165137, NULL, 15, '2025-08-14 09:58:08', '2025-08-14 09:58:08', 'public', NULL),
(402, 'contact-two-bg.jpg', 'image', 'image/jpeg', '2025/08/14/contact-two-bg.jpg', 'jpg', 29394, NULL, 15, '2025-08-14 10:15:02', '2025-08-14 10:15:02', 'public', NULL),
(403, 'event-one-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/event-one-img-1.jpg', 'jpg', 54919, NULL, 15, '2025-08-14 10:20:14', '2025-08-14 10:20:14', 'public', NULL),
(404, 'main-slider-trustpilot-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/main-slider-trustpilot-img-1-1.jpg', 'jpg', 2063, NULL, 15, '2025-08-14 10:41:56', '2025-08-14 10:41:56', 'public', NULL),
(405, 'main-slider-trustpilot-img-2.jpg', 'image', 'image/jpeg', '2025/08/14/main-slider-trustpilot-img-2-1.jpg', 'jpg', 2597, NULL, 15, '2025-08-14 10:42:02', '2025-08-14 10:42:02', 'public', NULL),
(406, 'main-slider-shape-1.png', 'image', 'image/png', '2025/08/14/main-slider-shape-1.png', 'png', 76778, NULL, 15, '2025-08-14 10:44:32', '2025-08-14 10:44:32', 'public', NULL),
(407, 'main-slider-shape-3.png', 'image', 'image/png', '2025/08/14/main-slider-shape-3.png', 'png', 206511, NULL, 15, '2025-08-14 10:45:04', '2025-08-14 10:45:04', 'public', NULL),
(408, 'main-slider-shape-4.png', 'image', 'image/png', '2025/08/14/main-slider-shape-4.png', 'png', 136369, NULL, 15, '2025-08-14 10:45:18', '2025-08-14 10:45:18', 'public', NULL),
(409, 'main-slider-shape-5.png', 'image', 'image/png', '2025/08/14/main-slider-shape-5.png', 'png', 117540, NULL, 15, '2025-08-14 10:45:36', '2025-08-14 10:45:36', 'public', NULL),
(410, 'main-slider-shield-check-icon.png', 'image', 'image/png', '2025/08/14/main-slider-shield-check-icon-1.png', 'png', 463, NULL, 15, '2025-08-14 10:46:10', '2025-08-14 10:46:10', 'public', NULL),
(411, 'main-slider-img-1.png', 'image', 'image/png', '2025/08/14/main-slider-img-1.png', 'png', 98104, NULL, 15, '2025-08-14 10:48:39', '2025-08-14 10:48:39', 'public', NULL),
(412, 'main-slider-img-2.png', 'image', 'image/png', '2025/08/14/main-slider-img-2.png', 'png', 97167, NULL, 15, '2025-08-14 10:52:00', '2025-08-14 10:52:00', 'public', NULL),
(413, 'servces-one-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/servces-one-img-1.jpg', 'jpg', 55572, NULL, 15, '2025-08-14 10:59:40', '2025-08-14 10:59:40', 'public', NULL),
(414, 'servces-one-img-1.png', 'image', 'image/jpeg', '2025/08/14/servces-one-img-1.png', 'png', 128961, NULL, 15, '2025-08-14 10:59:49', '2025-08-14 10:59:49', 'public', NULL),
(415, 'about-one-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/about-one-img-1.jpg', 'jpg', 151988, NULL, 15, '2025-08-14 11:29:10', '2025-08-14 11:29:10', 'public', NULL),
(416, 'testimonial-one-bg-1.jpg', 'image', 'image/jpeg', '2025/08/14/testimonial-one-bg-1.jpg', 'jpg', 51278, NULL, 15, '2025-08-14 12:24:24', '2025-08-14 12:24:24', 'public', NULL),
(417, 'testimonial-1-1.jpg', 'image', 'image/jpeg', '2025/08/14/testimonial-1-1.jpg', 'jpg', 36870, NULL, 15, '2025-08-14 12:25:39', '2025-08-14 12:25:39', 'public', NULL),
(418, 'trustpilot-logo.png', 'image', 'image/png', '2025/08/14/trustpilot-logo.png', 'png', 2184, NULL, 15, '2025-08-14 12:27:40', '2025-08-14 12:27:40', 'public', NULL),
(419, 'brand-one-img-1-1.jpg', 'image', 'image/jpeg', '2025/08/14/brand-one-img-1-1.jpg', 'jpg', 4353, NULL, 15, '2025-08-14 12:30:40', '2025-08-14 12:30:40', 'public', NULL),
(420, 'brand-one-img-1-2.jpg', 'image', 'image/jpeg', '2025/08/14/brand-one-img-1-2.jpg', 'jpg', 5669, NULL, 15, '2025-08-14 12:30:50', '2025-08-14 12:30:50', 'public', NULL),
(421, 'testimonial-1-2.jpg', 'image', 'image/jpeg', '2025/08/14/testimonial-1-2.jpg', 'jpg', 23130, NULL, 15, '2025-08-14 12:32:49', '2025-08-14 12:32:49', 'public', NULL),
(422, 'testimonial-1-3.jpg', 'image', 'image/jpeg', '2025/08/14/testimonial-1-3.jpg', 'jpg', 24219, NULL, 15, '2025-08-14 12:34:26', '2025-08-14 12:34:26', 'public', NULL),
(423, 'site-footer-top-bg.jpg', 'image', 'image/jpeg', '2025/08/14/site-footer-top-bg.jpg', 'jpg', 167583, NULL, 15, '2025-08-14 13:00:48', '2025-08-14 13:00:48', 'public', NULL),
(424, 'footer-logo.png', 'image', 'image/png', '2025/08/14/footer-logo.png', 'png', 4217, NULL, 15, '2025-08-14 13:01:11', '2025-08-14 13:01:11', 'public', NULL),
(425, 'banner-one-bg.jpg', 'image', 'image/jpeg', '2025/08/14/banner-one-bg.jpg', 'jpg', 383626, NULL, 15, '2025-08-14 13:22:22', '2025-08-14 13:22:22', 'public', NULL),
(426, 'banner-one-shape-bg.png', 'image', 'image/png', '2025/08/14/banner-one-shape-bg.png', 'png', 36917, NULL, 15, '2025-08-14 13:22:47', '2025-08-14 13:22:47', 'public', NULL),
(427, 'banner-one-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/banner-one-img-1.jpg', 'jpg', 190562, NULL, 15, '2025-08-14 13:23:32', '2025-08-14 13:23:32', 'public', NULL),
(428, 'about-three-img-1.png', 'image', 'image/png', '2025/08/14/about-three-img-1.png', 'png', 141382, NULL, 15, '2025-08-14 13:28:02', '2025-08-14 13:28:02', 'public', NULL),
(429, 'why-choose-two-img-1.png', 'image', 'image/png', '2025/08/14/why-choose-two-img-1.png', 'png', 126680, NULL, 15, '2025-08-14 13:33:59', '2025-08-14 13:33:59', 'public', NULL),
(430, 'cta-one-shape-bg.png', 'image', 'image/png', '2025/08/14/cta-one-shape-bg.png', 'png', 129194, NULL, 15, '2025-08-14 13:38:29', '2025-08-14 13:38:29', 'public', NULL),
(431, 'faq-one-img-1.jpg', 'image', 'image/jpeg', '2025/08/14/faq-one-img-1.jpg', 'jpg', 55291, NULL, 15, '2025-08-14 13:49:53', '2025-08-14 13:49:53', 'public', NULL),
(432, 'shop-product-1-1.png', 'image', 'image/png', '2025/08/14/shop-product-1-1.png', 'png', 30615, NULL, 15, '2025-08-14 14:24:59', '2025-08-14 14:24:59', 'public', NULL),
(433, 'product-details-img-1.png', 'image', 'image/png', '2025/08/14/product-details-img-1.png', 'png', 87657, NULL, 15, '2025-08-14 14:26:06', '2025-08-14 14:26:06', 'public', NULL),
(434, 'product-details-img-2.png', 'image', 'image/png', '2025/08/14/product-details-img-2.png', 'png', 64339, NULL, 15, '2025-08-14 14:26:21', '2025-08-14 14:26:21', 'public', NULL),
(435, 'product-details-img-3.png', 'image', 'image/png', '2025/08/14/product-details-img-3.png', 'png', 59393, NULL, 15, '2025-08-14 14:26:34', '2025-08-14 14:26:34', 'public', NULL),
(436, 'shop-product-1-6.png', 'image', 'image/png', '2025/08/14/shop-product-1-6.png', 'png', 93090, NULL, 15, '2025-08-14 16:13:43', '2025-08-14 16:13:43', 'public', NULL),
(437, 'shop-product-1-5.png', 'image', 'image/png', '2025/08/14/shop-product-1-5.png', 'png', 50267, NULL, 15, '2025-08-14 16:16:10', '2025-08-14 16:16:10', 'public', NULL),
(438, 'shop-product-1-4.png', 'image', 'image/png', '2025/08/14/shop-product-1-4.png', 'png', 23977, NULL, 15, '2025-08-14 16:16:59', '2025-08-14 16:16:59', 'public', NULL),
(439, 'shop-product-1-2.png', 'image', 'image/png', '2025/08/14/shop-product-1-2.png', 'png', 29548, NULL, 15, '2025-08-14 16:19:52', '2025-08-14 16:19:52', 'public', NULL),
(440, 'shop-product-1-3.png', 'image', 'image/png', '2025/08/14/shop-product-1-3.png', 'png', 24221, NULL, 15, '2025-08-14 16:21:22', '2025-08-14 16:21:22', 'public', NULL),
(441, '78d4a434a59fcf62565f0452e83180f3.png', 'image', 'image/png', '2025/08/14/78d4a434a59fcf62565f0452e83180f3.png', 'png', 51877, NULL, 15, '2025-08-14 16:33:03', '2025-08-14 16:33:03', 'public', NULL),
(442, '9420097cf13df8dfb7bcb7b5db3607dd.png', 'image', 'image/png', '2025/08/14/9420097cf13df8dfb7bcb7b5db3607dd.png', 'png', 23401, NULL, 15, '2025-08-14 16:34:13', '2025-08-14 16:34:13', 'public', NULL),
(443, '5cecf2c1ee40676bcef484efe1853bff.png', 'image', 'image/png', '2025/08/14/5cecf2c1ee40676bcef484efe1853bff.png', 'png', 28865, NULL, 15, '2025-08-14 16:37:28', '2025-08-14 16:37:28', 'public', NULL),
(444, '8d57eac4b78e83e49793fb8503c6b82d.png', 'image', 'image/png', '2025/08/14/8d57eac4b78e83e49793fb8503c6b82d.png', 'png', 47289, NULL, 15, '2025-08-14 16:44:11', '2025-08-14 16:44:11', 'public', NULL),
(445, '62fce6527cb686bf263764e7.png', 'image', 'image/png', '2025/08/14/62fce6527cb686bf263764e7.png', 'png', 4633, NULL, 15, '2025-08-14 16:48:10', '2025-08-14 16:48:10', 'public', NULL),
(446, 'cash-on-delivery.png', 'image', 'image/png', '2025/08/14/cash-on-delivery.png', 'png', 27156, NULL, 15, '2025-08-14 16:52:16', '2025-08-14 16:52:16', 'public', NULL),
(447, 'shop-product-1-2.png', 'image', 'image/png', '2025/08/14/shop-product-1-2-1.png', 'png', 29548, NULL, 54, '2025-08-14 17:16:13', '2025-08-14 17:16:13', 'public', NULL),
(448, 'product-details-img-1.png', 'image', 'image/png', '2025/08/14/product-details-img-1-1.png', 'png', 87657, NULL, 54, '2025-08-14 17:17:28', '2025-08-14 17:17:28', 'public', NULL),
(449, 'product-details-img-2.png', 'image', 'image/png', '2025/08/14/product-details-img-2-1.png', 'png', 64339, NULL, 54, '2025-08-14 17:17:31', '2025-08-14 17:17:31', 'public', NULL),
(450, 'product-details-img-3.png', 'image', 'image/png', '2025/08/14/product-details-img-3-1.png', 'png', 59393, NULL, 54, '2025-08-14 17:17:36', '2025-08-14 17:17:36', 'public', NULL),
(451, 'footer-logo.png', 'image', 'image/png', '2025/08/15/footer-logo.png', 'png', 4217, NULL, 15, '2025-08-15 08:46:54', '2025-08-15 08:46:54', 'public', NULL),
(452, '10.png', 'file', 'image/png', '2025/08/15/10.png', 'png', 553504, 31, 15, '2025-08-15 18:43:36', '2025-08-15 18:43:36', 'public', NULL),
(453, '01.jpg', 'file', 'image/jpeg', '2025/08/15/01.jpg', 'jpg', 388434, 31, 15, '2025-08-15 18:44:50', '2025-08-15 18:44:50', 'public', NULL),
(454, '01.png', 'file', 'image/png', '2025/08/15/01.png', 'png', 345319, 31, 15, '2025-08-15 18:45:22', '2025-08-15 18:45:22', 'public', NULL),
(455, '02.png', 'file', 'image/png', '2025/08/15/02.png', 'png', 323833, 31, 15, '2025-08-15 18:45:46', '2025-08-15 18:45:46', 'public', NULL),
(456, '02.png', 'file', 'image/png', '2025/08/15/02-1.png', 'png', 323833, 31, 15, '2025-08-15 18:45:56', '2025-08-15 18:45:56', 'public', NULL),
(457, '03.png', 'file', 'image/png', '2025/08/15/03.png', 'png', 347869, 31, 15, '2025-08-15 18:46:45', '2025-08-15 18:46:45', 'public', NULL),
(458, '04.png', 'file', 'image/png', '2025/08/15/04.png', 'png', 277055, 31, 15, '2025-08-15 18:47:12', '2025-08-15 18:47:12', 'public', NULL),
(459, '05.png', 'file', 'image/png', '2025/08/15/05.png', 'png', 359322, 31, 15, '2025-08-15 18:47:44', '2025-08-15 18:47:44', 'public', NULL),
(460, '06.png', 'file', 'image/png', '2025/08/15/06.png', 'png', 317813, 31, 15, '2025-08-15 18:47:53', '2025-08-15 18:47:53', 'public', NULL),
(461, '07.png', 'file', 'image/png', '2025/08/15/07.png', 'png', 359902, 31, 15, '2025-08-15 18:48:00', '2025-08-15 18:48:00', 'public', NULL),
(462, '08.png', 'file', 'image/png', '2025/08/15/08.png', 'png', 424958, 31, 15, '2025-08-15 18:48:08', '2025-08-15 18:48:08', 'public', NULL),
(463, '08.png', 'file', 'image/png', '2025/08/15/08-1.png', 'png', 424958, 31, 15, '2025-08-15 18:48:21', '2025-08-15 18:48:21', 'public', NULL),
(464, '09.png', 'file', 'image/png', '2025/08/15/09.png', 'png', 350180, 31, 15, '2025-08-15 18:48:30', '2025-08-15 18:48:30', 'public', NULL),
(465, 'razorpay-icon.svg', 'image', 'image/svg+xml', '2025/09/21/razorpay-icon.svg', 'svg', 4422, NULL, 15, '2025-09-20 21:52:26', '2025-09-20 21:52:26', 'public', NULL),
(466, 'flutterwave-seeklogo.svg', 'image', 'image/svg+xml', '2025/09/21/flutterwave-seeklogo.svg', 'svg', 4704, NULL, 15, '2025-09-20 22:00:05', '2025-09-20 22:00:05', 'public', NULL),
(467, 'flutterwave-seeklogo.png', 'image', 'image/png', '2025/09/21/flutterwave-seeklogo.png', 'png', 28709, NULL, 15, '2025-09-20 22:02:50', '2025-09-20 22:02:50', 'public', NULL),
(468, 'paystack-seeklogo.png', 'image', 'image/png', '2025/09/21/paystack-seeklogo.png', 'png', 25705, NULL, 15, '2025-09-20 22:03:30', '2025-09-20 22:03:30', 'public', NULL),
(469, 'idIF2ChcBH_1758427566090.png', 'image', 'image/png', '2025/09/21/idif2chcbh-1758427566090.png', 'png', 3260, NULL, 15, '2025-09-20 22:06:20', '2025-09-20 22:06:20', 'public', NULL),
(470, '2checkout-seeklogo.png', 'image', 'image/png', '2025/09/21/2checkout-seeklogo.png', 'png', 29022, NULL, 15, '2025-09-20 22:10:41', '2025-09-20 22:10:41', 'public', NULL),
(471, 'blog-page-1-5.jpg', 'image', 'image/jpeg', '2025/09/21/blog-page-1-5.jpg', 'jpg', 117896, NULL, 15, '2025-09-21 00:59:06', '2025-09-21 00:59:06', 'public', NULL),
(472, 'generated_flux_1_0_2025-08-17_22-00-24_2.png', 'image', 'image/jpeg', '2025/09/21/generated-flux-1-0-2025-08-17-22-00-24-2.png', 'png', 319538, NULL, 15, '2025-09-21 01:17:21', '2025-09-21 01:17:21', 'public', NULL),
(473, 'cropped-image-woman-inputting-card-information-key-phone-laptop-while-shopping-online.jpg', 'image', 'image/jpeg', '2025/09/21/cropped-image-woman-inputting-card-information-key-phone-laptop-while-shopping-online.jpg', 'jpg', 1058155, NULL, 15, '2025-09-21 01:18:20', '2025-09-21 01:18:20', 'public', NULL),
(474, 'showing-cart-trolley-shopping-online-sign-graphic.jpg', 'image', 'image/jpeg', '2025/09/21/showing-cart-trolley-shopping-online-sign-graphic.jpg', 'jpg', 1249667, NULL, 15, '2025-09-21 01:18:43', '2025-09-21 01:18:43', 'public', NULL),
(475, 'logo.png', 'image', 'image/png', '2025/09/21/logo.png', 'png', 3663, NULL, 15, '2025-09-21 01:20:20', '2025-09-21 01:20:20', 'public', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_media_folders`
--

CREATE TABLE `app_media_folders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `folder_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_media_folders`
--

INSERT INTO `app_media_folders` (`id`, `name`, `type`, `folder_id`, `created_at`, `updated_at`, `disk`) VALUES
(27, 'blog', 'image', NULL, '2025-08-10 06:54:02', '2025-08-10 06:54:02', 'public'),
(28, 'Services', 'image', NULL, '2025-08-12 14:57:41', '2025-08-12 14:57:41', 'public'),
(29, 'team', 'image', NULL, '2025-08-13 03:04:03', '2025-08-13 03:04:03', 'public'),
(30, 'projects', 'image', NULL, '2025-08-14 05:59:30', '2025-08-14 05:59:30', 'public'),
(31, 'preview', 'file', NULL, '2025-08-15 18:37:52', '2025-08-15 18:37:52', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `app_menus`
--

CREATE TABLE `app_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_menus`
--

INSERT INTO `app_menus` (`id`, `name`, `description`, `created_at`, `updated_at`, `uuid`) VALUES
(19, 'Main Menu', NULL, '2025-08-12 14:28:44', '2025-08-12 14:28:44', 'bffafcdc-6622-4171-8fad-2bd51df74bfd'),
(20, 'Footer 2 Menu', NULL, '2025-08-14 14:03:54', '2025-08-14 14:03:54', '3cdad76f-96a8-40d8-81c0-fca45ae827ee'),
(21, 'Footer 3 Menu', NULL, '2025-08-14 14:07:14', '2025-08-14 14:07:14', 'cadd8c22-b2ba-4034-ad1f-8424011b0fde'),
(22, 'Footer 4', NULL, '2025-08-15 08:48:38', '2025-08-15 08:48:38', 'c6b164ad-bbce-4f9b-8bd3-0dc2304d3981'),
(23, 'Top Bar', NULL, '2025-08-15 08:53:56', '2025-08-15 08:53:56', '1b2adba3-149e-4d99-858d-c42319bd48ff');

-- --------------------------------------------------------

--
-- Table structure for table `app_menu_items`
--

CREATE TABLE `app_menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `box_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint DEFAULT NULL,
  `link` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `num_order` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_menu_items`
--

INSERT INTO `app_menu_items` (`id`, `menu_id`, `parent_id`, `box_key`, `label`, `model_class`, `model_id`, `link`, `icon`, `target`, `num_order`) VALUES
(69, 19, NULL, 'custom_url', 'Blogs', NULL, NULL, '#', NULL, '_self', 31),
(70, 19, 69, 'post_type_pages', 'Blogs', 'MojarCMS\\Backend\\Models\\Post', 133, NULL, NULL, '_self', 32),
(71, 19, 69, 'post_type_pages', 'Blog Carousel', 'MojarCMS\\Backend\\Models\\Post', 204, NULL, NULL, '_self', 33),
(72, 19, 69, 'post_type_pages', 'Blog List', 'MojarCMS\\Backend\\Models\\Post', 205, NULL, NULL, '_self', 34),
(73, 19, 69, 'post_type_pages', 'Blog Grid', 'MojarCMS\\Backend\\Models\\Post', 203, NULL, NULL, '_self', 35),
(74, 19, 69, 'post_type_posts', 'Blog Details', 'MojarCMS\\Backend\\Models\\Post', 202, NULL, NULL, '_self', 36),
(75, 19, NULL, 'post_type_pages', 'Contact', 'MojarCMS\\Backend\\Models\\Post', 22, NULL, NULL, '_self', 37),
(77, 19, NULL, 'custom_url', 'Shop', NULL, NULL, '#', NULL, '_self', 25),
(78, 19, 77, 'custom_url', 'Cart', NULL, NULL, '/cart', NULL, '_self', 27),
(79, 19, 77, 'custom_url', 'Wishlist', NULL, NULL, '/wishlist', NULL, '_self', 28),
(80, 19, 77, 'custom_url', 'Login', NULL, NULL, '/login', NULL, '_self', 29),
(81, 19, 77, 'custom_url', 'Register', NULL, NULL, '/register', NULL, '_self', 30),
(82, 19, NULL, 'custom_url', 'Services', NULL, NULL, '#', NULL, '_self', 18),
(83, 19, 82, 'post_type_pages', 'Services', 'MojarCMS\\Backend\\Models\\Post', 206, NULL, NULL, '_self', 19),
(84, 19, 82, 'post_type_pages', 'Services Carousel', 'MojarCMS\\Backend\\Models\\Post', 218, NULL, NULL, '_self', 20),
(85, 19, 82, 'post_type_services', 'Cybersecurity Risk', 'MojarCMS\\Backend\\Models\\Post', 219, NULL, NULL, '_self', 21),
(86, 19, 82, 'post_type_services', 'Cloud Solutions Provider', 'MojarCMS\\Backend\\Models\\Post', 220, NULL, NULL, '_self', 22),
(87, 19, 82, 'post_type_services', 'Data Analytics Consulting', 'MojarCMS\\Backend\\Models\\Post', 221, NULL, NULL, '_self', 23),
(88, 19, 82, 'post_type_services', 'Software Development', 'MojarCMS\\Backend\\Models\\Post', 210, NULL, NULL, '_self', 24),
(89, 19, NULL, 'custom_url', 'Pages', NULL, NULL, '#', NULL, '_self', 6),
(90, 19, 89, 'post_type_pages', 'Teams', 'MojarCMS\\Backend\\Models\\Post', 170, NULL, NULL, '_self', 7),
(91, 19, 89, 'post_type_pages', 'Team Carousel', 'MojarCMS\\Backend\\Models\\Post', 246, NULL, NULL, '_self', 8),
(92, 19, 89, 'post_type_teams', 'Team Details', 'MojarCMS\\Backend\\Models\\Post', 245, NULL, NULL, '_self', 9),
(93, 19, 89, 'post_type_pages', 'Portfolios', 'MojarCMS\\Backend\\Models\\Post', 238, NULL, NULL, '_self', 10),
(94, 19, 89, 'post_type_portfolios', 'Portfolio Details', 'MojarCMS\\Backend\\Models\\Post', 233, NULL, NULL, '_self', 11),
(95, 19, 89, 'post_type_pages', 'Testimonials', 'MojarCMS\\Backend\\Models\\Post', 226, NULL, NULL, '_self', 12),
(96, 19, 89, 'post_type_pages', 'Testimonials Carousel', 'MojarCMS\\Backend\\Models\\Post', 227, NULL, NULL, '_self', 13),
(97, 19, 89, 'post_type_pages', 'Pricings', 'MojarCMS\\Backend\\Models\\Post', 223, NULL, NULL, '_self', 14),
(98, 19, 89, 'post_type_pages', 'Gallery', 'MojarCMS\\Backend\\Models\\Post', 224, NULL, NULL, '_self', 15),
(99, 19, 89, 'post_type_pages', 'FAQ’s', 'MojarCMS\\Backend\\Models\\Post', 225, NULL, NULL, '_self', 16),
(100, 19, 89, 'custom_url', '404 Error', NULL, NULL, '/error-page', NULL, '_self', 17),
(101, 19, NULL, 'custom_url', 'Home', NULL, NULL, '#', NULL, '_self', 1),
(102, 19, 101, 'post_type_pages', 'Home Page 01', 'MojarCMS\\Backend\\Models\\Post', 250, NULL, NULL, '_self', 2),
(103, 19, 101, 'post_type_pages', 'Home Page 02', 'MojarCMS\\Backend\\Models\\Post', 252, NULL, NULL, '_self', 3),
(104, 19, 101, 'post_type_pages', 'Home Page 03', 'MojarCMS\\Backend\\Models\\Post', 253, NULL, NULL, '_self', 4),
(105, 19, NULL, 'post_type_pages', 'About', 'MojarCMS\\Backend\\Models\\Post', 151, NULL, NULL, '_self', 5),
(106, 20, NULL, 'post_type_pages', 'Home', 'MojarCMS\\Backend\\Models\\Post', 250, NULL, NULL, '_self', 1),
(107, 20, NULL, 'post_type_pages', 'About Us', 'MojarCMS\\Backend\\Models\\Post', 151, NULL, NULL, '_self', 2),
(108, 20, NULL, 'post_type_pages', 'Pricing', 'MojarCMS\\Backend\\Models\\Post', 223, NULL, NULL, '_self', 3),
(109, 20, NULL, 'post_type_pages', 'Portfolio', 'MojarCMS\\Backend\\Models\\Post', 238, NULL, NULL, '_self', 4),
(111, 20, NULL, 'post_type_pages', 'Teams', 'MojarCMS\\Backend\\Models\\Post', 170, NULL, NULL, '_self', 5),
(112, 21, NULL, 'post_type_pages', 'FAQ’s', 'MojarCMS\\Backend\\Models\\Post', 225, NULL, NULL, '_self', 1),
(113, 21, NULL, 'post_type_pages', 'Contact Us', 'MojarCMS\\Backend\\Models\\Post', 22, NULL, NULL, '_self', 2),
(114, 21, NULL, 'custom_url', '404 Page', NULL, NULL, '/error-page', NULL, '_self', 3),
(115, 21, NULL, 'post_type_pages', 'Our Services', 'MojarCMS\\Backend\\Models\\Post', 206, NULL, NULL, '_self', 4),
(116, 21, NULL, 'post_type_pages', 'Testimonials', 'MojarCMS\\Backend\\Models\\Post', 226, NULL, NULL, '_self', 5),
(117, 19, 77, 'post_type_pages', 'Products', 'MojarCMS\\Backend\\Models\\Post', 254, NULL, NULL, '_self', 26),
(118, 22, NULL, 'post_type_services', 'Software', 'MojarCMS\\Backend\\Models\\Post', 210, NULL, NULL, '_self', 2),
(119, 22, NULL, 'post_type_services', 'Cybersecurity', 'MojarCMS\\Backend\\Models\\Post', 219, NULL, NULL, '_self', 3),
(120, 22, NULL, 'post_type_services', 'Cloud Solutions', 'MojarCMS\\Backend\\Models\\Post', 220, NULL, NULL, '_self', 4),
(121, 22, NULL, 'post_type_services', 'Data Analytics', 'MojarCMS\\Backend\\Models\\Post', 221, NULL, NULL, '_self', 5),
(122, 22, NULL, 'post_type_pages', 'Services', 'MojarCMS\\Backend\\Models\\Post', 206, NULL, NULL, '_self', 1),
(123, 23, NULL, 'post_type_pages', 'Help', 'MojarCMS\\Backend\\Models\\Post', 151, NULL, NULL, '_self', 1),
(124, 23, NULL, 'post_type_pages', 'Support', 'MojarCMS\\Backend\\Models\\Post', 22, NULL, NULL, '_self', 2),
(125, 23, NULL, 'post_type_pages', 'Faqs', 'MojarCMS\\Backend\\Models\\Post', 225, NULL, NULL, '_self', 3);

-- --------------------------------------------------------

--
-- Table structure for table `app_migrations`
--

CREATE TABLE `app_migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_migrations`
--

INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_04_02_193005_create_translations_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2018_08_08_100000_create_telescope_entries_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2020_06_17_141252_create_pages_table', 1),
(13, '2020_06_17_141314_create_posts_table', 1),
(14, '2020_06_17_141546_create_configs_table', 1),
(15, '2020_07_13_101632_create_media_files_table', 1),
(16, '2020_07_13_101706_create_media_folders_table', 1),
(17, '2020_07_19_093715_create_theme_configs_table', 1),
(18, '2020_08_05_145156_create_comments_table', 1),
(19, '2021_01_08_103537_add_columns_to_users_table', 1),
(20, '2021_01_08_143358_create_taxonomies_table', 1),
(21, '2021_01_08_143537_create_user_metas_table', 1),
(22, '2021_01_09_154753_create_email_lists_table', 1),
(23, '2021_02_09_091923_create_email_templates_table', 1),
(24, '2021_03_10_031508_create_term_taxonomies_table', 1),
(25, '2021_04_18_072732_update_notifications_table', 1),
(26, '2021_04_18_093643_create_manual_notifications_table', 1),
(27, '2021_08_12_053735_create_menus_table', 1),
(28, '2021_09_12_142856_update_database_v106', 1),
(29, '2021_09_21_055918_add_level_column_to_taxonomies_table', 1),
(30, '2021_09_21_074810_create_search_table', 1),
(31, '2021_09_26_053902_add_description_column_to_pages_table', 1),
(32, '2021_10_19_153921_create_language_lines_table', 1),
(33, '2021_10_19_162424_create_resources_table', 1),
(34, '2021_10_19_163450_create_single_taxonomies_table', 1),
(35, '2021_10_24_061612_add_type_to_posts_table', 1),
(36, '2021_10_25_063534_add_data_to_users_table', 1),
(37, '2021_11_06_044329_create_jobs_table', 1),
(38, '2021_11_06_123423_add_metas_column_to_posts_table', 1),
(39, '2021_11_06_164602_create_languages_table', 1),
(40, '2021_11_13_112150_add_json_taxonomies_column_to_posts_table', 1),
(41, '2021_11_23_053012_add_display_order_column_to_resources_table', 1),
(42, '2021_11_26_100137_create_post_views_table', 1),
(43, '2021_11_26_150252_create_post_ratings_table', 1),
(44, '2021_11_26_172822_add_rating_column_to_posts_table', 1),
(45, '2021_11_27_074456_add_object_key_to_translations_table', 1),
(46, '2021_12_14_142948_create_permission_groups_table', 1),
(47, '2021_12_15_083034_create_social_tokens_table', 1),
(48, '2021_12_15_141831_create_permission_tables', 1),
(49, '2021_12_16_070521_add_columns_to_roles_table', 1),
(50, '2021_12_18_051140_create_seo_metas_table', 1),
(51, '2021_12_18_140504_add_foreign_to_comments_table', 1),
(52, '2022_02_12_105437_add_total_comment_column_to_posts_table', 1),
(53, '2022_03_12_080104_add_index_code_column_configs_table', 1),
(54, '2022_03_31_083337_add_description_column_to_permission_groups_table', 1),
(55, '2022_08_06_045723_update_version_v325', 1),
(56, '2022_09_04_191144_create_table_groups_table', 1),
(57, '2022_11_12_032456_create_post_likes_table', 1),
(58, '2022_11_26_070653_add_object_columns_to_language_lines_table', 1),
(59, '2022_12_03_044603_add_template_code_column_to_email_lists_table', 1),
(60, '2022_12_18_141652_add_slug_column_to_resources_table', 1),
(61, '2023_02_05_033908_add_index_to_media_table', 1),
(62, '2023_02_17_024906_add_uuid_column_to_exports_tables', 1),
(63, '2023_04_17_063702_add_is_fake_column_to_users_table', 1),
(64, '2023_05_02_200212_add_locale_column_to_posts_table', 1),
(65, '2023_06_29_232141_add_active_column_to_email_templates_table', 1),
(66, '2023_07_01_132207_create_email_templates_to_users_table', 1),
(67, '2023_08_20_080039_add_disk_column_to_media_files_table', 1),
(70, '2025_02_06_014758_create_payment_methods_table', 4),
(71, '2025_02_06_024758_create_payment_histories_table', 5),
(79, '2025_02_11_084836_create_currencies_table', 7),
(80, '2025_02_11_104949_create_orders_table', 7),
(81, '2025_02_11_105900_create_order_items_table', 7),
(82, '2025_02_11_111124_create_carts_table', 7),
(83, '2025_02_11_120001_create_product_variants_table', 8),
(84, '2025_02_11_120002_create_attributes_table', 8),
(85, '2025_02_11_120003_create_attribute_values_table', 8),
(86, '2025_02_11_120004_create_variants_attributes_table', 8),
(87, '2025_02_11_120005_create_product_variants_attribute_values_table', 8),
(89, '2025_02_11_120007_create_download_links_table', 8),
(90, '2025_02_11_120008_create_shipping_address_table', 8),
(91, '2025_02_11_120010_create_shipping_methods_table', 8),
(92, '2025_02_11_1393743_create_addons_table', 8),
(101, '2025_02_08_051102_create_event_tickets_table', 9),
(102, '2025_02_08_112400_create_event_bookings_table', 9),
(104, '2025_02_06_014758_create_contacts_table', 10),
(107, '2025_03_08_082922_test_eomm_plugin', 11),
(112, '2025_03_21_105437_add_json_metas_column_to_comments_table', 13),
(113, '2025_03_21_095307_add_json_metas_to_comments_table', 14),
(114, '2025_03_09_120001_create_course_topics_table', 15),
(115, '2025_03_09_120002_create_course_lessons_table', 15),
(119, '2025_08_07_000001_create_dev_tool_cms_versions_table', 16),
(120, '2025_08_07_000002_create_dev_tool_package_versions_table', 16),
(123, '2025_09_23_000001_create_marketplace_themes_table', 17),
(124, '2025_09_23_000002_create_marketplace_plugins_table', 17),
(125, '2025_06_06_014758_create_newsletters_subscribers_table', 18),
(126, '2025_02_11_111125_create_wishlists_table', 19),
(127, '2025_08_04_071411_create_vendor_earnings_table', 20),
(128, '2025_08_04_071456_create_vendor_withdrawals_table', 20),
(129, '2025_08_04_071533_create_vendor_balances_table', 20),
(130, '2023_08_15_add_vendor_id_to_product_variants', 21),
(131, '2025_08_04_072223_CreateVendorEarningsTable', 22),
(132, '2025_08_04_072238_CreateWithdrawalRequestsTable', 22),
(133, '2025_08_04_112607_VendorEarnings', 23),
(134, '2025_08_04_112621_VendorWithdrawals', 23),
(135, '2025_08_04_122300_VendorBalance', 24),
(136, '2025_08_04_122312_VendorEarnings', 24),
(137, '2025_08_04_122321_VendorWithdrawals', 24),
(138, '2025_08_05_035920_InventoryManagement', 25),
(155, '2023_06_18_120059_create_ticket_support_types_table', 26),
(156, '2023_06_18_120115_create_ticket_supports_table', 26),
(157, '2023_06_18_125528_create_ticket_support_comments_table', 26),
(158, '2024_02_21_222849_create_ticket_support_attachments_table', 26),
(159, '2024_02_25_171302_add_column_comment_id_on_sticket_ticket_support_attachments', 26),
(160, '2024_03_31_032840_make_default_types_data', 26),
(161, '2024_08_05_140000_add_enhanced_fields_to_ticket_supports_table', 27),
(162, '2025_02_11_120006_create_discounts_table', 28),
(163, '2024_01_01_000001_create_chatbot_configurations_table', 29),
(164, '2024_01_01_000002_create_chatbot_logs_table', 29),
(165, '2025_01_16_120000_create_pos_sessions_table', 30),
(166, '2025_01_16_120001_create_pos_orders_table', 30),
(167, '2025_01_16_120002_create_pos_order_items_table', 30),
(168, '2025_01_16_120003_create_pos_carts_table', 30);

-- --------------------------------------------------------

--
-- Table structure for table `app_model_has_permissions`
--

CREATE TABLE `app_model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_model_has_roles`
--

CREATE TABLE `app_model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_model_has_roles`
--

INSERT INTO `app_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(12, 'MojarCMS\\CMS\\Models\\User', 49),
(11, 'MojarCMS\\CMS\\Models\\User', 52),
(12, 'MojarCMS\\CMS\\Models\\User', 54);

-- --------------------------------------------------------

--
-- Table structure for table `app_newsletters_subscribers`
--

CREATE TABLE `app_newsletters_subscribers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_subscribed` tinyint(1) DEFAULT '1',
  `metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_newsletters_subscribers`
--

INSERT INTO `app_newsletters_subscribers` (`id`, `email`, `is_subscribed`, `metas`, `site_id`, `created_at`, `updated_at`) VALUES
('4426fc5f-145b-4894-87dd-23c68a99db4a', 'puwara@mailinator.com', 1, NULL, 0, '2025-08-09 17:50:35', '2025-08-09 17:50:35'),
('4cbe52ff-32a5-4f4d-bb1c-4eaae1f2243b', 'noquric@mailinator.com', 1, NULL, 0, '2025-08-14 16:30:09', '2025-08-14 16:30:09'),
('538c3bd4-b342-4276-a1bb-f44e560213a1', 'asds@gmail.com', 1, NULL, 0, '2025-06-17 11:42:59', '2025-06-17 11:42:59'),
('91d7fceb-35d6-4f99-9131-c448158eaa26', 'tewones@mailinator.com', 1, NULL, 0, '2025-08-14 16:30:21', '2025-08-14 16:30:21'),
('e93d9079-3be3-42f5-b5aa-d8221b1df69f', 'sfds@qadsas.com', 1, NULL, 0, '2025-08-14 17:20:06', '2025-08-14 17:20:06'),
('ed3d4950-9736-4ab1-9219-14633f51d37b', 'pateqyleh@mailinator.com', 1, NULL, 0, '2025-06-30 15:34:23', '2025-06-30 15:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `app_notifications`
--

CREATE TABLE `app_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `notifiable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_access_tokens`
--

CREATE TABLE `app_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_auth_codes`
--

CREATE TABLE `app_oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_clients`
--

CREATE TABLE `app_oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_personal_access_clients`
--

CREATE TABLE `app_oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_refresh_tokens`
--

CREATE TABLE `app_oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_orders`
--

CREATE TABLE `app_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `token` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ecommerce',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_codes` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `site_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_orders`
--

INSERT INTO `app_orders` (`id`, `token`, `code`, `title`, `type`, `status`, `payment_status`, `delivery_status`, `name`, `email`, `phone`, `address`, `country_code`, `quantity`, `total_price`, `total`, `discount`, `discount_codes`, `payment_method_id`, `payment_method_name`, `notes`, `user_id`, `site_id`, `created_at`, `updated_at`) VALUES
(246, 'e904229b-6fe0-40ec-8c6b-0cbae5d916c1', '202508141702001', 'Order #202508141702001', 'products', 'completed', 'completed', 'delivered', 'Customer', 'customer@gmail.com', NULL, NULL, NULL, 2, 353.00, 353.00, 0.00, NULL, 3, 'Stripe', NULL, 52, NULL, '2025-08-14 17:02:00', '2025-08-15 09:54:04'),
(247, '57fe8a3b-6ff2-4911-8e26-54cab51f5954', '202508150949361', 'Order #202508150949361', 'products', 'completed', 'completed', 'delivered', 'Customer', 'customer@gmail.com', NULL, NULL, NULL, 3, 653.00, 587.70, 65.30, '[\"WELCOME10\"]', 3, 'Stripe', NULL, 52, NULL, '2025-08-15 09:49:36', '2025-08-15 09:53:08'),
(248, '17fb79c2-679d-412f-a712-31fea8ab33b0', '202508150950171', 'Order #202508150950171', 'products', 'completed', 'completed', 'delivered', 'Customer', 'customer@gmail.com', NULL, NULL, NULL, 3, 1760.00, 1760.00, 0.00, NULL, 3, 'Stripe', NULL, 52, NULL, '2025-08-15 09:50:17', '2025-08-15 09:52:55'),
(249, '6ad6696e-b659-4133-95ba-4e8badec3ac0', '202508150950451', 'Order #202508150950451', 'products', 'processing', 'completed', 'shipped', 'Customer', 'customer@gmail.com', NULL, NULL, NULL, 2, 143.00, 143.00, 0.00, NULL, 3, 'Stripe', NULL, 52, NULL, '2025-08-15 09:50:45', '2025-08-15 13:09:04'),
(250, 'f0ed3339-1bd9-4110-8b09-f522dade9a20', '202508150951381', 'Order #202508150951381', 'products', 'completed', 'completed', 'delivered', 'Customer', 'customer@gmail.com', NULL, NULL, NULL, 3, 670.00, 335.00, 335.00, '[\"VIP50\"]', 3, 'Stripe', NULL, 52, NULL, '2025-08-15 09:51:38', '2025-08-15 09:58:46'),
(251, 'ced1ea00-9b95-4a2a-a045-30bebee57be8', '202508150954551', 'Order #202508150954551', 'products', 'completed', 'completed', 'delivered', 'Thomas Alison', 'admin@gmail.com', NULL, NULL, NULL, 3, 653.00, 653.00, 0.00, NULL, 3, 'Stripe', NULL, 15, NULL, '2025-08-15 09:54:55', '2025-08-15 10:05:13'),
(252, 'ea8e3470-4b85-4d24-9cf5-dd99feade264', '202508151002311', 'Order #202508151002311', 'products', 'completed', 'completed', 'pending', 'Vendor William', 'vendor@gmail.com', NULL, NULL, NULL, 3, 460.00, 460.00, 0.00, NULL, 3, 'Stripe', NULL, 54, NULL, '2025-08-15 10:02:31', '2025-08-15 10:04:27'),
(253, '65f41eda-89fb-4715-8803-356b482be91f', '202509210328001', 'Order #202509210328001', 'products', 'pending', 'completed', 'pending', 'Thomas Alison', 'admin@gmail.com', NULL, NULL, NULL, 1, 320.00, 320.00, 0.00, NULL, 3, 'Stripe', NULL, 15, NULL, '2025-09-20 21:28:00', '2025-09-20 21:28:17'),
(254, 'a8625134-d5fc-4eb4-9b15-761e803bf496', '202509210350331', 'Order #202509210350331', 'products', 'pending', 'pending', 'pending', 'Mojahidul Islam', 'mojarsoft@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 6, 'Razorpay', NULL, 56, NULL, '2025-09-20 21:50:33', '2025-09-20 21:50:33'),
(255, '427d5f1b-39b2-4d0c-b2c6-67b6bc01dbc0', '202509210411151', 'Order #202509210411151', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'mojahidgenius48@gmail.com', NULL, NULL, NULL, 1, 320.00, 320.00, 0.00, NULL, 10, 'twocheckout', NULL, 57, NULL, '2025-09-20 22:11:15', '2025-09-20 22:11:15'),
(256, '13f04e8d-733e-4898-b0f5-c8256a2f037a', '202509210412111', 'Order #202509210412111', 'products', 'pending', 'pending', 'pending', 'Mojahidul Islam', 'mojarsoft@gmail.com', NULL, NULL, NULL, 2, 640.00, 640.00, 0.00, NULL, 9, 'Instamojo', NULL, 56, NULL, '2025-09-20 22:12:11', '2025-09-20 22:12:11'),
(257, 'b69297ff-7a37-4109-8540-d675a48681c8', '202509210413011', 'Order #202509210413011', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:13:01', '2025-09-20 22:13:01'),
(258, '2827c5c9-1037-4845-b921-b6f7e93685ce', '202509210413371', 'Order #202509210413371', 'products', 'pending', 'pending', 'pending', 'Mojahidul Islam', 'mojarsoft@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 8, 'Paystack', NULL, 56, NULL, '2025-09-20 22:13:37', '2025-09-20 22:13:37'),
(259, '01924d9d-f099-4592-ac26-9d59911e821e', '202509210416091', 'Order #202509210416091', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:16:09', '2025-09-20 22:16:09'),
(260, '2f46084c-a658-49fc-8fde-f514aa9ea903', '202509210421341', 'Order #202509210421341', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:21:34', '2025-09-20 22:21:34'),
(261, '26566c0b-07ee-4f25-a561-aee8459bbe1b', '202509210424491', 'Order #202509210424491', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:24:49', '2025-09-20 22:24:49'),
(262, '86070ffe-f237-4848-bc05-156a2046b7a3', '202509210428281', 'Order #202509210428281', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:28:28', '2025-09-20 22:28:28'),
(263, '51d593e3-8b8d-457b-9708-eba74eff099b', '202509210435141', 'Order #202509210435141', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 300.00, 300.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:35:14', '2025-09-20 22:35:14'),
(264, '6a4e6863-5447-4b42-909f-7f1fd69e2eaa', '202509210438471', 'Order #202509210438471', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 300.00, 300.00, 0.00, NULL, 8, 'Paystack', NULL, 58, NULL, '2025-09-20 22:38:47', '2025-09-20 22:38:47'),
(265, '93fbf90d-575b-4e4d-88cf-0ecb098b3c85', '202509210603531', 'Order #202509210603531', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 300.00, 300.00, 0.00, NULL, 9, 'Instamojo', NULL, 58, NULL, '2025-09-21 00:03:53', '2025-09-21 00:03:53'),
(266, '666233af-9c8f-4a4d-a76a-fc554c43e137', '202509210604561', 'Order #202509210604561', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 4, 'Mollie', NULL, 58, NULL, '2025-09-21 00:04:56', '2025-09-21 00:04:56'),
(267, '44035fe6-6b28-44ef-a660-0c77fb98f3a9', '202509210608591', 'Order #202509210608591', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 33.00, 33.00, 0.00, NULL, 1, 'Paypal', NULL, 58, NULL, '2025-09-21 00:08:59', '2025-09-21 00:08:59'),
(268, 'a17395b9-c5f6-4bdb-b10a-133ddd2094bf', '202509210609551', 'Order #202509210609551', 'products', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, 540.00, 540.00, 0.00, NULL, 4, 'Mollie', NULL, 58, NULL, '2025-09-21 00:09:55', '2025-09-21 00:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `app_order_items`
--

CREATE TABLE `app_order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `thumbnail` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `line_price` decimal(15,2) NOT NULL,
  `quantity` int NOT NULL,
  `compare_price` decimal(15,2) DEFAULT NULL,
  `sku_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_order_items`
--

INSERT INTO `app_order_items` (`id`, `title`, `type`, `thumbnail`, `price`, `line_price`, `quantity`, `compare_price`, `sku_code`, `barcode`, `post_id`, `order_id`, `created_at`, `updated_at`) VALUES
(258, '3d render robo', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 320.00, 1, 340.00, '1221', '1321', 256, 246, '2025-08-14 17:02:00', '2025-08-14 17:02:00'),
(259, 'motorcycle helme', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 257, 246, '2025-08-14 17:02:00', '2025-08-14 17:02:00'),
(260, 'snowboard boot William', 'products', '2025/08/14/shop-product-1-2-1.png', 300.00, 300.00, 1, 340.00, '123123', '122321', 268, 247, '2025-08-15 09:49:36', '2025-08-15 09:49:36'),
(261, '3d render robo', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 320.00, 1, 340.00, '1221', '1321', 256, 247, '2025-08-15 09:49:36', '2025-08-15 09:49:36'),
(262, 'motorcycle helme', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 257, 247, '2025-08-15 09:49:36', '2025-08-15 09:49:36'),
(263, 'robot gesturing', 'products', '2025/08/14/shop-product-1-2.png', 540.00, 540.00, 1, 430.00, '13213', '132312', 258, 248, '2025-08-15 09:50:17', '2025-08-15 09:50:17'),
(264, 'ski helmet with visor', 'products', '2025/08/14/shop-product-1-5.png', 460.00, 460.00, 1, 332.00, '13131', '2312312', 259, 248, '2025-08-15 09:50:17', '2025-08-15 09:50:17'),
(265, 'snowboard boot', 'products', '2025/08/14/shop-product-1-6.png', 760.00, 760.00, 1, 500.00, '123123', 'qweqwe', 260, 248, '2025-08-15 09:50:17', '2025-08-15 09:50:17'),
(266, 'rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 261, 249, '2025-08-15 09:50:45', '2025-08-15 09:50:45'),
(267, '3d render robot', 'products', '2025/08/14/shop-product-1-2.png', 110.00, 110.00, 1, 213.00, '123123', '123123', 262, 249, '2025-08-15 09:50:45', '2025-08-15 09:50:45'),
(268, 'robot gesturing', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 320.00, 1, 430.00, '1312312', '123123', 265, 250, '2025-08-15 09:51:38', '2025-08-15 09:51:38'),
(269, 'ski helmet with visor', 'products', '2025/08/14/shop-product-1-5.png', 300.00, 300.00, 1, 340.00, '312312', '12312', 266, 250, '2025-08-15 09:51:38', '2025-08-15 09:51:38'),
(270, 'snowboard boot', 'products', '2025/08/14/shop-product-1-6.png', 50.00, 50.00, 1, 40.00, '132312', '12312', 267, 250, '2025-08-15 09:51:38', '2025-08-15 09:51:38'),
(271, 'snowboard boot William', 'products', '2025/08/14/shop-product-1-2-1.png', 300.00, 300.00, 1, 340.00, '123123', '122321', 268, 251, '2025-08-15 09:54:55', '2025-08-15 09:54:55'),
(272, '3d render robo', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 320.00, 1, 340.00, '1221', '1321', 256, 251, '2025-08-15 09:54:55', '2025-08-15 09:54:55'),
(273, 'motorcycle helme', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 257, 251, '2025-08-15 09:54:55', '2025-08-15 09:54:55'),
(274, '3d render robot', 'products', '2025/08/14/shop-product-1-2.png', 110.00, 110.00, 1, 213.00, '123123', '123123', 262, 252, '2025-08-15 10:02:31', '2025-08-15 10:02:31'),
(275, 'snowboard boot William', 'products', '2025/08/14/shop-product-1-2-1.png', 300.00, 300.00, 1, 340.00, '123123', '122321', 268, 252, '2025-08-15 10:02:31', '2025-08-15 10:02:31'),
(276, 'snowboard boot', 'products', '2025/08/14/shop-product-1-6.png', 50.00, 50.00, 1, 40.00, '132312', '12312', 267, 252, '2025-08-15 10:02:31', '2025-08-15 10:02:31'),
(277, '3d render robo', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 320.00, 1, 340.00, '1221', '1321', 256, 253, '2025-09-20 21:28:00', '2025-09-20 21:28:00'),
(278, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 254, '2025-09-20 21:50:33', '2025-09-20 21:50:33'),
(279, '3d render robo', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 320.00, 1, 340.00, '1221', '1321', 256, 255, '2025-09-20 22:11:15', '2025-09-20 22:11:15'),
(280, '3d render robo', 'products', '2025/08/14/shop-product-1-4.png', 320.00, 640.00, 2, 340.00, '1221', '1321', 256, 256, '2025-09-20 22:12:11', '2025-09-20 22:12:11'),
(281, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 257, '2025-09-20 22:13:01', '2025-09-20 22:13:01'),
(282, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 258, '2025-09-20 22:13:37', '2025-09-20 22:13:37'),
(283, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 259, '2025-09-20 22:16:09', '2025-09-20 22:16:09'),
(284, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 260, '2025-09-20 22:21:34', '2025-09-20 22:21:34'),
(285, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 261, '2025-09-20 22:24:49', '2025-09-20 22:24:49'),
(286, 'Rendering metallic ai', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 255, 262, '2025-09-20 22:28:28', '2025-09-20 22:28:28'),
(287, 'snowboard boot William', 'products', '2025/08/14/shop-product-1-2-1.png', 300.00, 300.00, 1, 340.00, '123123', '122321', 268, 263, '2025-09-20 22:35:14', '2025-09-20 22:35:14'),
(288, 'snowboard boot William', 'products', '2025/08/14/shop-product-1-2-1.png', 300.00, 300.00, 1, 340.00, '123123', '122321', 268, 264, '2025-09-20 22:38:47', '2025-09-20 22:38:47'),
(289, 'snowboard boot William', 'products', '2025/08/14/shop-product-1-2-1.png', 300.00, 300.00, 1, 340.00, '123123', '122321', 268, 265, '2025-09-21 00:03:53', '2025-09-21 00:03:53'),
(290, 'motorcycle helme', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 257, 266, '2025-09-21 00:04:56', '2025-09-21 00:04:56'),
(291, 'motorcycle helme', 'products', '2025/08/14/shop-product-1-1.png', 33.00, 33.00, 1, 32.00, '1312312312', '1231212321', 257, 267, '2025-09-21 00:08:59', '2025-09-21 00:08:59'),
(292, 'robot gesturing', 'products', '2025/08/14/shop-product-1-2.png', 540.00, 540.00, 1, 430.00, '13213', '132312', 258, 268, '2025-09-21 00:09:55', '2025-09-21 00:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `app_order_item_metas`
--

CREATE TABLE `app_order_item_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_order_metas`
--

CREATE TABLE `app_order_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_pages`
--

CREATE TABLE `app_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `template_data` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_page_metas`
--

CREATE TABLE `app_page_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `page_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_password_resets`
--

CREATE TABLE `app_password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_payment_histories`
--

CREATE TABLE `app_payment_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_reference` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreement_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `processed_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `payment_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_message` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_payment_methods`
--

CREATE TABLE `app_payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_payment_methods`
--

INSERT INTO `app_payment_methods` (`id`, `type`, `name`, `description`, `image`, `data`, `active`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Paypal', 'make payment via paypal', '2025/08/14/5cecf2c1ee40676bcef484efe1853bff.png', '{\"mode\":\"sandbox\",\"sandbox_client_id\":\"Ae_EqULnkWwIRsubEs8n6FTVc48VpD5X8a_6Npk23zIhn81Aw7W6QH7hyOqSE443aUoc0FRrxa8IZiGs\",\"sandbox_secret\":\"ECCkJXVtmmMgy_ai5i_1AuUJtbO7e6P_gQISQzwctaApGyJD2h1LPi2reSt5ac_FPGESoprR3i1eIaFC\",\"live_client_id\":null,\"live_secret\":null}', 1, '2025-02-06 08:39:41', '2025-08-14 16:37:32'),
(3, 'stripe', 'Stripe', 'make payment via Stripe', '2025/08/14/8d57eac4b78e83e49793fb8503c6b82d.png', '{\"mode\":\"test\",\"test_publishable_key\":\"pk_test_51N4eDoFNqndPjg2XgA6h2UbpIysYQmjOdVh8SaFxsYCPcwNxY5BnIWyuCSYKgxPqK3QhiCOZt6vCmf5rfmgsWPho00GyRSimvC\",\"test_secret_key\":\"sk_test_51N4eDoFNqndPjg2XrvImm40p6LoRjrJimWykVbpQnzVvUSDyEbA140iXLFsrPeh4wv0i5q3I3SM8aBuUX5ZBE7YD00AE1LVUKN\",\"live_publishable_key\":null,\"live_secret_key\":null}', 1, '2025-02-23 20:10:37', '2025-08-14 16:53:12'),
(4, 'mollie', 'Mollie', 'make payment via Mollie', '2025/08/14/62fce6527cb686bf263764e7.png', '{\"mode\":\"sandbox\",\"sandbox_api_key\":\"test_eRJJ8VxNMm2Jg5RsgehpEQPWRseqbG\",\"live_api_key\":null}', 1, '2025-03-03 22:21:58', '2025-09-21 00:08:34'),
(5, 'cod', 'Cash On Delivery', NULL, '2025/08/14/cash-on-delivery.png', NULL, 1, '2025-03-04 03:21:53', '2025-08-14 16:52:20'),
(6, 'razorpay', 'Razorpay', 'Make payment via Razorpay', '2025/09/21/razorpay-icon.svg', '{\"mode\":\"test\",\"test_key_id\":\"rzp_test_K7CipNQYyyMPiS\",\"test_key_secret\":\"zSBmNMorJrirOrnDrbOd1ALO\",\"live_key_id\":null,\"live_key_secret\":null}', 1, '2025-09-20 21:49:38', '2025-09-20 21:52:45'),
(7, 'flutterwave', 'Flutterwave', 'Make payment via Flutterwave', '2025/09/21/flutterwave-seeklogo.png', '{\"mode\":\"test\",\"test_public_key\":\"FLWPUBK_TEST-fb44624408737bc1234009c035840c76-X\",\"test_secret_key\":\"FLWSECK_TEST-cccdc68a53742e1e9e5ae6d9ed6047f9-X\",\"test_encryption_key\":\"FLWSECK_TEST78946aebf434\",\"live_public_key\":null,\"live_secret_key\":null,\"live_encryption_key\":null}', 1, '2025-09-20 22:00:17', '2025-09-20 22:02:56'),
(8, 'paystack', 'Paystack', 'Make payment via Paystack', '2025/09/21/paystack-seeklogo.png', '{\"mode\":\"test\",\"test_public_key\":\"pk_test_7aa8e027f05fdd082ef57922c50e1283fd5855c7\",\"test_secret_key\":\"sk_test_7f44936818aae79abd8b8e10dabff8c5b09090a5\",\"live_public_key\":null,\"live_secret_key\":null}', 0, '2025-09-20 22:03:34', '2025-09-21 00:10:43'),
(9, 'instamojo', 'Instamojo', 'Make payment via Instamojo', '2025/09/21/idif2chcbh-1758427566090.png', '{\"mode\":\"test\",\"test_api_key\":\"test_5f4a2c9a58ef216f8a1a688910f\",\"test_auth_token\":\"test_994252ada69ce7b3d282b9941c2\",\"live_api_key\":null,\"live_auth_token\":null}', 1, '2025-09-20 22:06:27', '2025-09-20 22:06:27'),
(10, 'twocheckout', 'twocheckout', 'Make payment via twocheckout', '2025/09/21/2checkout-seeklogo.png', '{\"mode\":\"test\",\"test_account_number\":\"255666652246\",\"test_secret_word\":\"WBS2@B!Za$bCr4KM5DpUyHmp9NnA56yJm3-$RxJ&4DY?AuhJP#D$34jnQBn5RcwP\",\"live_account_number\":null,\"live_secret_word\":null}', 1, '2025-09-20 22:10:48', '2025-09-20 22:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `app_permissions`
--

CREATE TABLE `app_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_permissions`
--

INSERT INTO `app_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'post-type.pages.index', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'View List Pages'),
(2, 'post-type.pages.create', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Create Pages'),
(3, 'post-type.pages.edit', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Edit Pages'),
(4, 'post-type.pages.delete', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Delete Pages'),
(5, 'post-type.posts.index', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'View List Posts'),
(6, 'post-type.posts.create', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Create Posts'),
(7, 'post-type.posts.edit', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Edit Posts'),
(8, 'post-type.posts.delete', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Delete Posts'),
(9, 'users.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Users'),
(10, 'users.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Users'),
(11, 'users.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Users'),
(12, 'users.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Users'),
(13, 'users.view', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View User Details'),
(14, 'roles.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Roles'),
(15, 'roles.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Roles'),
(16, 'roles.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Roles'),
(17, 'roles.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Roles'),
(18, 'roles.view', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Role Details'),
(19, 'taxonomy.product.categories.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Categories'),
(20, 'taxonomy.product.categories.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Product Categories'),
(21, 'taxonomy.product.categories.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Product Categories'),
(22, 'taxonomy.product.categories.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Product Categories'),
(23, 'taxonomy.product.categories.view', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Category Details'),
(24, 'taxonomy.product.tags.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Tags'),
(25, 'taxonomy.product.tags.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Product Tags'),
(26, 'taxonomy.product.tags.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Product Tags'),
(27, 'taxonomy.product.tags.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Product Tags'),
(28, 'taxonomy.product.brands.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Brands'),
(29, 'taxonomy.product.brands.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Product Brands'),
(30, 'taxonomy.product.brands.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Product Brands'),
(31, 'taxonomy.product.brands.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Product Brands'),
(32, 'taxonomy.product.brands.view', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Brand Details'),
(33, 'taxonomy.product.vendors.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Vendors'),
(34, 'taxonomy.product.vendors.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Product Vendors'),
(35, 'taxonomy.product.vendors.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Product Vendors'),
(36, 'taxonomy.product.vendors.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Product Vendors'),
(37, 'taxonomy.product.vendors.view', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Vendor Details'),
(38, 'post-type.product.comments.index', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Comments'),
(39, 'post-type.product.comments.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Product Comments'),
(40, 'post-type.product.comments.edit', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Product Comments'),
(41, 'post-type.product.comments.delete', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Delete Product Comments'),
(42, 'post-type.product.comments.view', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Product Comment Details'),
(43, 'orders.view_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Own Orders'),
(44, 'orders.edit_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Own Orders'),
(45, 'reviews.create', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Product Reviews'),
(46, 'reviews.edit_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Edit Own Reviews'),
(47, 'transactions.view_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Own Transactions'),
(48, 'downloads.access', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Access Downloads'),
(49, 'payment_methods.manage', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Manage Payment Methods'),
(50, 'products.manage_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Manage Own Products'),
(51, 'products.view_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Own Products'),
(52, 'orders.manage_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Manage Own Orders'),
(53, 'customers.view_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Own Customers'),
(54, 'revenue.export', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Export Revenue Data'),
(55, 'inventory.manage', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Manage Inventory'),
(56, 'shipping.manage', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Manage Shipping'),
(57, 'discounts.create_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'Create Own Discounts'),
(58, 'analytics.view_own', 'web', '2025-07-30 09:23:24', '2025-07-30 09:23:24', 'View Own Analytics'),
(59, 'post-type.products.index', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'View Products'),
(60, 'post-type.products.create', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Create Products'),
(61, 'post-type.products.edit', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Edit Products'),
(62, 'post-type.products.delete', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Delete Products'),
(63, 'post-type.products.view', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'View Product Details'),
(64, 'post-type.products.view_own', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'View Own Products'),
(65, 'post-type.products.edit_own', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Edit Own Products'),
(66, 'post-type.products.delete_own', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Delete Own Products'),
(67, 'post-type.products.create_own', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Create Own Products'),
(68, 'post-type.products.manage_own', 'web', '2025-08-02 10:22:26', '2025-08-02 10:22:26', 'Manage Own Products'),
(69, 'email_templates.index', 'web', '2025-08-03 10:46:14', '2025-08-03 10:46:14', 'View List Email Template'),
(70, 'email_templates.create', 'web', '2025-08-03 10:46:14', '2025-08-03 10:46:14', 'Create Email Template'),
(71, 'email_templates.edit', 'web', '2025-08-03 10:46:14', '2025-08-03 10:46:14', 'Edit Email Template'),
(72, 'email_templates.delete', 'web', '2025-08-03 10:46:14', '2025-08-03 10:46:14', 'Delete Email Template'),
(81, 'orders.index', 'web', '2025-08-03 12:15:43', '2025-08-03 12:15:43', 'View List cms::app.orders'),
(82, 'orders.create', 'web', '2025-08-03 12:15:43', '2025-08-03 12:15:43', 'Create cms::app.orders'),
(83, 'orders.edit', 'web', '2025-08-03 12:15:43', '2025-08-03 12:15:43', 'Edit cms::app.orders'),
(84, 'orders.delete', 'web', '2025-08-03 12:15:43', '2025-08-03 12:15:43', 'Delete cms::app.orders'),
(85, 'withdrawals.request', 'web', '2025-08-04 06:37:47', '2025-08-04 06:37:47', 'Request Withdrawals'),
(86, 'earnings.view_own', 'web', '2025-08-04 06:37:47', '2025-08-04 06:37:47', 'View Own Earnings'),
(87, 'vendor_balances.index', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'View List Vendor Balances'),
(88, 'vendor_balances.create', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Create Vendor Balances'),
(89, 'vendor_balances.edit', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Edit Vendor Balances'),
(90, 'vendor_balances.delete', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Delete Vendor Balances'),
(91, 'vendor_earnings.index', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'View List Vendor Earnings'),
(92, 'vendor_earnings.create', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Create Vendor Earnings'),
(93, 'vendor_earnings.edit', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Edit Vendor Earnings'),
(94, 'vendor_earnings.delete', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Delete Vendor Earnings'),
(95, 'vendor_withdrawals.index', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'View List Vendor Withdrawals'),
(96, 'vendor_withdrawals.create', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Create Vendor Withdrawals'),
(97, 'vendor_withdrawals.edit', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Edit Vendor Withdrawals'),
(98, 'vendor_withdrawals.delete', 'web', '2025-08-04 09:00:55', '2025-08-04 09:00:55', 'Delete Vendor Withdrawals'),
(99, 'order_items.index', 'web', '2025-08-04 11:14:33', '2025-08-04 11:14:33', 'View List Order Items'),
(100, 'order_items.create', 'web', '2025-08-04 11:14:33', '2025-08-04 11:14:33', 'Create Order Items'),
(101, 'order_items.edit', 'web', '2025-08-04 11:14:33', '2025-08-04 11:14:33', 'Edit Order Items'),
(102, 'order_items.delete', 'web', '2025-08-04 11:14:33', '2025-08-04 11:14:33', 'Delete Order Items'),
(103, 'ticket-supports.index', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'View List Ticket Supports'),
(104, 'ticket-supports.create', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Create Ticket Supports'),
(105, 'ticket-supports.edit', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Edit Ticket Supports'),
(106, 'ticket-supports.delete', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Delete Ticket Supports'),
(107, 'ticket-supports-types.index', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'View List Ticket Supports Types'),
(108, 'ticket-supports-types.create', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Create Ticket Supports Types'),
(109, 'ticket-supports-types.edit', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Edit Ticket Supports Types'),
(110, 'ticket-supports-types.delete', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Delete Ticket Supports Types'),
(111, 'ticket-supports-settings.index', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'View List Ticket Supports Settings'),
(112, 'ticket-supports-settings.create', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Create Ticket Supports Settings'),
(113, 'ticket-supports-settings.edit', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Edit Ticket Supports Settings'),
(114, 'ticket-supports-settings.delete', 'web', '2025-08-05 10:11:17', '2025-08-05 10:11:17', 'Delete Ticket Supports Settings'),
(115, 'customer.my_orders', 'web', '2025-08-08 08:58:31', '2025-08-08 08:58:31', 'View Own Orders'),
(116, 'customer.my_cart', 'web', '2025-08-08 08:58:31', '2025-08-08 08:58:31', 'View Own Cart'),
(117, 'customer.my_wishlist', 'web', '2025-08-08 08:58:31', '2025-08-08 08:58:31', 'View Own Wishlist'),
(118, 'customer.my_downloads', 'web', '2025-08-08 08:58:31', '2025-08-08 08:58:31', 'View Own Downloads'),
(119, 'customer.my_reviews', 'web', '2025-08-08 08:58:31', '2025-08-08 08:58:31', 'View Own Reviews');

-- --------------------------------------------------------

--
-- Table structure for table `app_permission_groups`
--

CREATE TABLE `app_permission_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plugin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_personal_access_tokens`
--

CREATE TABLE `app_personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_posts`
--

CREATE TABLE `app_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'posts',
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `json_taxonomies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `rating` double(8,2) NOT NULL DEFAULT '0.00',
  `total_rating` int NOT NULL DEFAULT '0',
  `total_comment` bigint NOT NULL DEFAULT '0',
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_posts`
--

INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(17, 'Checkout', NULL, 'checkout', '', NULL, 'publish', 101, '2025-02-14 04:41:49', '2025-02-14 04:41:50', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, 'b551bb7a-2db0-4586-b05f-6640cfa93aa1', 'vi'),
(18, 'Thank You', NULL, 'thank-you', '', NULL, 'publish', 65, '2025-02-23 20:16:52', '2025-02-23 20:16:53', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, '1abe8021-b6ad-4008-b95c-a8d5218f52b9', 'vi'),
(22, 'Contact', NULL, 'contact', '', NULL, 'publish', 30, '2025-03-05 01:18:38', '2025-08-14 12:12:46', 1, 1, 'pages', '{\"template\":\"contact\",\"block_content\":{\"content\":[{\"form_title\":\"How Can We Help You?\",\"name_label\":\"Full Name\",\"name_placeholder\":\"Thomas Alison\",\"email_label\":\"Email Address\",\"email_placeholder\":\"thomas@domain.com\",\"phone_label\":\"Phone Number\",\"phone_placeholder\":\"+12 (00) 123 4567 890\",\"subject_label\":\"Subject\",\"message_label\":\"Inquiry about\",\"message_placeholder\":\"Write your message\",\"submit_button_text\":\"Submit Now\",\"section_tagline\":\"Get In Touch\",\"section_title_line1\":\"Start the Conversation\",\"section_title_line2\":\"Reach Out Anytime\",\"section_description\":\"We\'re here to listen! Whether you have questions, \\/\\/ feedback, or just want to say hello, feel free to reach out.\",\"location_title\":\"Location\",\"location_address\":\"1629 N. Dixie Avenue, \\/\\/ Kentucky, 42701\",\"email_title\":\"Email Us\",\"email_address1\":\"info@domain.com\",\"email_address2\":\"support@domain.com\",\"contact_title\":\"Contact\",\"tel_number\":\"+12 (00) 456 7890 00\",\"mobile_number\":\"+99 (00) 567 780\",\"bg_shape\":\"2025\\/08\\/12\\/contact-one-bg-shape.png\",\"enable_animation\":\"1\",\"block\":\"contact_form\"},{\"section_tagline\":\"FAQS\",\"section_title\":\"Frequently Asked\",\"section_title_span\":\"Questions\",\"section_description\":\"Get answers to the most common questions \\\\\\\\\\r\\nabout our products, services, and policies.\",\"support_label\":\"Get Support\",\"support_phone\":\"99 (00) 567 780\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"faq_items\":[{\"question\":\"What services does your IT consultancy agency provide?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"0\"},{\"question\":\"How can IT consulting benefit my business?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"1\"},{\"question\":\"Do you offer customized IT solutions?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"0\"},{\"question\":\"How do you ensure data security and compliance?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"0\"}],\"shape_1\":\"2025\\/08\\/12\\/faq-two-shape-1.png\",\"shape_2\":\"2025\\/08\\/12\\/faq-two-shape-2.png\",\"enable_animation\":\"1\",\"block\":\"faq_contact\"},{\"map_url\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3651.227879477866!2d90.34898411538501!3d23.774898293755943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1e1938cc90b%3A0xbcfacb6b89117685!2sZakirsoft%20-%20Innovative%20Software%20%26%20Web%20Development%20Solutions!5e0!3m2!1sen!2sbd!4v1641634410288!5m2!1sen!2sbd\",\"map_width\":null,\"map_height\":null,\"map_class\":null,\"map_allowfullscreen\":\"1\",\"map_border\":\"1\",\"map_border_width\":null,\"map_border_color\":null,\"map_border_style\":null,\"block\":\"google_map_contact\"}]},\"header_white\":\"0\",\"header_style\":\"header-1\",\"footer_style\":\"footer-1\"}', '[]', 0.00, 0, 0, 'b4e3c4af-e1d9-4a5a-bf38-375f02cba23d', 'vi'),
(133, 'Blogs', NULL, 'blogs', '', NULL, 'publish', 6, '2025-04-08 11:44:34', '2025-04-08 11:44:34', 1, 1, 'pages', '{\"template\":null}', '[]', 0.00, 0, 0, 'fe5b153c-9e1a-4caa-b6d3-9e29fe7b7728', 'vi'),
(151, 'About Us', NULL, 'about-us', '', NULL, 'publish', 20, '2025-04-08 17:02:49', '2025-08-14 09:03:55', 1, 1, 'pages', '{\"template\":\"about\",\"block_content\":{\"content\":[{\"bg_shape\":null,\"bg_shape_2\":null,\"main_image\":null,\"secondary_image\":null,\"experience_years\":null,\"experience_text\":null,\"client_images\":[{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-2.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-3.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-1.jpg\",\"alt\":null}],\"client_count\":null,\"client_suffix\":null,\"client_text\":null,\"client_more_url\":null,\"section_tagline\":\"About Us\",\"title_part_1\":\"Supercharge\",\"title_part_2\":\"Your Business\",\"title_part_3\":\"Growth with Our\",\"title_part_4\":\"Cutting-Edge IT\",\"title_part_5\":\"Solutions\",\"description\":\"Transform your business with our innovative IT solutions, tailored to address your unique challenges and drive growth in today\\u2019s digital landscape.\",\"features_left\":[{\"icon\":\"icon-tick-inside-circle\",\"text\":\"Innovative IT Solutions Expert \\\\\\\\\\r\\nSupport & Consulting\"},{\"icon\":\"icon-tick-inside-circle\",\"text\":\"Cloud Solutions for Modern \\\\\\\\\\r\\nEnterprises\"}],\"features_right\":[{\"icon\":\"icon-tick-inside-circle\",\"text\":\"Seamless Digital \\\\\\\\\\r\\nTransformation AI-Driven \\\\\\\\\\r\\nBusiness Automation\"}],\"founder_image\":null,\"founder_name\":null,\"founder_position\":null,\"bottom_features\":[{\"icon\":\"icon-technical-support\",\"title\":\"Innovative IT Solutions\",\"text\":\"Stay ahead with cutting-edge technology tailored to \\\\\\\\ \\r\\nyour business needs.\"},{\"icon\":\"icon-real-estate-agency\",\"title\":\"Cloud Solutions\",\"text\":\"Secure, scalable, and efficient cloud services to power \\\\\\\\\\r\\nyour growth. Cloud Solutions for Modern Enterprises\"}],\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"about_area_aboutus\"},{\"bg_shape\":null,\"section_tagline\":\"Why Choose Us\",\"title_part_1\":\"Your Business with\",\"title_part_2\":\"Reliable &\",\"title_part_3\":\"Future-Ready\",\"title_part_4\":\"IT Solutions\",\"main_image\":\"2025\\/08\\/14\\/why-choose-three-img.jpg\",\"left_features\":[{\"icon\":\"icon-quality\",\"title\":\"Unmatched Quality\",\"text\":\"We deliver exceptional products and services that  exceed  expectations every time.\"},{\"icon\":\"icon-team\",\"title\":\"Trusted Expertise\",\"text\":\"Backed by years of experience and a proven track record, we are your reliable partner for success.\"}],\"right_features\":[{\"icon\":\"icon-customer-centricity\",\"title\":\"User-Centric Approach\",\"text\":\"Your satisfaction is our priority, and we tailor solutions to meet your unique needs. Your happiness comes first.\"},{\"icon\":\"icon-support\",\"title\":\"Trusted by Many\",\"text\":\"We have built a strong reputation over the years by consistently delivering excellent results.\"}],\"enable_animation\":\"1\",\"left_animation_delay\":null,\"center_animation_delay\":null,\"right_animation_delay\":null,\"block\":\"why_choose_aboutus\"},{\"bg_shape\":null,\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"Creative Plus award\"},{\"icon\":\"icon-user\",\"count\":\"300\",\"suffix\":\"+\",\"text\":\"Expert Team Members\"},{\"icon\":\"icon-chat\",\"count\":\"20\",\"suffix\":\"M\",\"text\":\"Happy Clients Review\"},{\"icon\":\"icon-folder\",\"count\":\"1.5\",\"suffix\":\"k\",\"text\":\"Project Completed\"}],\"enable_animation\":\"1\",\"block\":\"counter_area_home1\"},{\"section_tagline\":\"Our Members\",\"section_title_1\":\"Meet Our Team.\",\"section_title_2\":\"Get to\",\"section_title_3\":\"Know the Talented\",\"section_title_4\":\"Minds Behind Our Team\",\"description\":\"Our dedicated team combines expertise, \\\\\\\\\\r\\ncreativity, and passion to deliver exceptional \\\\\\\\\\r\\nresults and ensure your satisfaction every step \\\\\\\\\\r\\nof the way.\",\"background_shape\":\"2025\\/08\\/14\\/team-two-bg-shape.png\",\"use_teams_post_type\":\"0\",\"items_limit\":null,\"team_members_ids\":null,\"team_members\":[{\"image\":\"2025\\/08\\/14\\/team-2-1.jpg\",\"name\":\"Sophia Bennett\",\"position\":\"CEO & Founder\",\"url\":\"\\/team\\/mitchell-marsh\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"dribbble\":\"https:\\/\\/dribbble.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\"},{\"image\":\"2025\\/08\\/14\\/team-2-2.jpg\",\"name\":\"Liam Johnson\",\"position\":\"Operations Manager\",\"url\":\"\\/team\\/mitchell-marsh\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"dribbble\":\"https:\\/\\/dribbble.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\"},{\"image\":\"2025\\/08\\/14\\/team-2-3.jpg\",\"name\":\"Ethan Miller\",\"position\":\"Lead Designer\",\"url\":\"\\/team\\/mitchell-marsh\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"dribbble\":\"https:\\/\\/dribbble.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\"}],\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"block\":\"teams_about\"},{\"shape_1\":\"2025\\/08\\/12\\/process-one-shape-1.png\",\"bg_shape\":null,\"section_tagline\":\"Working Process\",\"title_part_1\":\"How We\'ve\",\"title_part_2\":\"Empowered\",\"title_part_3\":\"Businesses with Innovative\",\"title_part_4\":\"Tech Solutions\",\"description\":\"From personalized solutions to expert \\\\\\\\ execution, we prioritize\\r\\n                                quality, reliability, and \\\\\\\\ customer satisfaction\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"process_steps\":[{\"title\":\"Discovery & Strategy\",\"text\":\"We analyze your business needs, \\\\\\\\ identify challenges, and craft a \\\\\\\\ strategic roadmap for the best IT \\\\\\\\ solutions.\",\"count_left\":\"1\"},{\"title\":\"Development\",\"text\":\"Our expert team designs, develops, \\\\\\\\ and integrates cutting-edge \\\\\\\\ technology tailored to your goals.\",\"count_left\":\"0\"},{\"title\":\"Optimization & Support\",\"text\":\"We ensure seamless performance with \\\\\\\\ continuous improvements, \\\\\\\\ maintenance, and dedicated support.\",\"count_left\":\"1\"}],\"block\":\"process_area_home2\"},{\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_class\":null,\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"testimonials_carousel\"}]},\"header_white\":\"0\",\"header_style\":\"header-1\",\"footer_style\":\"footer-1\"}', '[]', 0.00, 0, 0, 'ebe58c32-8a11-449e-9d0a-99bdfbe3911e', 'vi'),
(152, 'Terms And Condition', NULL, 'terms-and-condition', '\r Legal Disclaimer\r Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit...', '<div class=\"tf__trems_condition_text\">\r\n<h3>Legal Disclaimer</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit ation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt atem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n<p>Adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea in commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proidentktl sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium totamrem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt</p>\r\n<h3>Credit Reporting Terms Of Service</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<h3>Ownership Of Site Agreement To Terms Of Use</h3>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>\r\n<h3>Provision Of Services</h3>\r\n<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>\r\n<h3>Accounts, Passwords And Security</h3>\r\n<p>In certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>\r\n</div>', 'publish', 2, '2025-04-08 17:20:07', '2025-04-08 17:20:07', 1, 1, 'pages', '{\"template\":null}', '[]', 0.00, 0, 0, '9816fa33-e8c0-46af-b5c3-ed2ce56815fa', 'vi'),
(170, 'Teams', NULL, 'teams', '', NULL, 'publish', 11, '2025-06-04 11:27:13', '2025-06-04 11:28:52', 1, 1, 'pages', '{\"template\":\"team\",\"block_content\":{\"content\":[{\"subtitle\":\"Team Member\",\"title\":\"Meet Our Great Team\",\"background_image\":null,\"use_team_post_type\":\"1\",\"team_limit\":null,\"default_image\":null,\"column_lg\":null,\"column_sm\":null,\"column_xs\":null,\"enable_animation\":\"0\",\"title_animation\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"team_about\"}]}}', '[]', 0.00, 0, 0, '6df65695-aa47-46de-b3f6-93baa4254019', 'vi'),
(191, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-list-1-1.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 12, '2025-08-13 06:52:56', '2025-08-15 09:08:23', 15, 15, 'posts', NULL, '[{\"id\":44,\"name\":\"Web Design & Development\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"web-design-development\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/web-design-development\"},{\"id\":45,\"name\":\"Development\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"development\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/development\"},{\"id\":46,\"name\":\"Innovation\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"innovation\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/innovation\"}]', 0.00, 0, 2, '17f3fc72-45e5-43f0-b617-3fec4726972a', 'vi'),
(195, 'Why Cybersecurity Should Be Your Top Priority in 2025', '2025/08/12/blog-list-1-2.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-1', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 11, '2025-08-10 06:52:56', '2025-08-15 09:11:41', 15, 15, 'posts', NULL, '[{\"id\":47,\"name\":\"Products Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"products-design\",\"level\":\"0\",\"total_post\":\"6\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/products-design\"},{\"id\":48,\"name\":\"Innovation\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"innovation-1\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/innovation-1\"}]', 0.00, 0, 2, '17f3fc72-45e5-43f0-b617-3fec4726972b', 'vi'),
(196, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-list-1-3.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-2', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 8, '2025-08-10 06:52:56', '2025-08-12 14:21:00', 15, 15, 'posts', NULL, '[{\"id\":49,\"name\":\"Artificial Intelligence\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"artificial-intelligence\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/artificial-intelligence\"},{\"id\":50,\"name\":\"Analytics\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"analytics\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/analytics\"}]', 0.00, 0, 0, '17f3fc72-45e5-43f0-b617-3fec4726972c', 'vi'),
(197, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-1-4.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-4', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 8, '2025-08-10 06:52:56', '2025-08-12 13:42:08', 15, 15, 'posts', NULL, '[{\"id\":47,\"name\":\"Products Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"products-design\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/products-design\"},{\"id\":50,\"name\":\"Analytics\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"analytics\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/analytics\"},{\"id\":51,\"name\":\"Technology\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"technology\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/technology\"},{\"id\":52,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing\"}]', 0.00, 0, 0, '17f3fc72-45e5-43f0-b617-3fec4726972d', 'vi'),
(198, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-1-5.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-5', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 9, '2025-08-10 06:52:56', '2025-08-15 09:11:41', 15, 15, 'posts', NULL, '[{\"id\":47,\"name\":\"Products Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"products-design\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/products-design\"},{\"id\":49,\"name\":\"Artificial Intelligence\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"artificial-intelligence\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/artificial-intelligence\"},{\"id\":50,\"name\":\"Analytics\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"analytics\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/analytics\"},{\"id\":53,\"name\":\"Technology\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"technology-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/technology-1\"}]', 0.00, 0, 2, '17f3fc72-45e5-43f0-b617-3fec4726972e', 'vi'),
(199, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-1-4.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-6', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 10, '2025-08-10 06:52:56', '2025-08-15 09:11:41', 15, 15, 'posts', NULL, '[{\"id\":44,\"name\":\"Web Design & Development\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"web-design-development\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/web-design-development\"},{\"id\":47,\"name\":\"Products Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"products-design\",\"level\":\"0\",\"total_post\":\"6\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/products-design\"},{\"id\":50,\"name\":\"Analytics\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"analytics\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/analytics\"}]', 0.00, 0, 2, '17f3fc72-45e5-43f0-b617-3fec4726972f', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(200, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-1-3.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-7', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 9, '2025-08-10 06:52:56', '2025-08-15 09:11:41', 15, 15, 'posts', NULL, '[{\"id\":47,\"name\":\"Products Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"products-design\",\"level\":\"0\",\"total_post\":\"5\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/products-design\"},{\"id\":49,\"name\":\"Artificial Intelligence\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"artificial-intelligence\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/artificial-intelligence\"},{\"id\":52,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing\"}]', 0.00, 0, 2, '17f3fc72-45e5-43f0-b617-3fec4726972g', 'vi'),
(201, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/12/blog-1-2.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-8', 'Key Trends in AI & Automation:\r Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 8, '2025-08-10 06:52:56', '2025-08-12 14:19:07', 15, 15, 'posts', NULL, '[{\"id\":47,\"name\":\"Products Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"products-design\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/products-design\"},{\"id\":48,\"name\":\"Innovation\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"innovation-1\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/innovation-1\"},{\"id\":49,\"name\":\"Artificial Intelligence\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"artificial-intelligence\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/artificial-intelligence\"},{\"id\":53,\"name\":\"Technology\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"technology-1\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/technology-1\"}]', 0.00, 0, 0, '17f3fc72-45e5-43f0-b617-3fec4726972h', 'vi'),
(202, 'Top IT Trends in 2025. What Businesses Need to Know', '2025/08/10/blog-1-1.jpg', 'top-it-trends-in-2025-what-businesses-need-to-know-9', 'Key Trends in AI & Automation:\r\n Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we’ll explore key strategies.\r\n...', '<h3 class=\"blog-details__title-1\">Key Trends in AI &amp; Automation:</h3>\r\n<p class=\"blog-details__text-1\">Creating a user-friendly website is crucial for engaging visitors and ensuring a positive user experience. In this blog post, we&rsquo;ll explore key strategies.</p>\r\n<ul class=\"blog-details__points list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>AI-Powered Business Automation:</strong> From chatbots handling<br />customer support to AI managing supply chains, businesses are<br />leveraging automation to streamline operations and reduce human<br />intervention.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p><strong>Generative AI in Marketing &amp; Content Creation:</strong> AI tools like TextCpg<br />and ImageJourney are transforming content production, enabling<br />businesses to generate high-quality marketing copy, images, and <br />videos faster.</p>\r\n</li>\r\n</ul>\r\n<div class=\"blog-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"blog-details__img-box-img\"><img src=\"2025/08/10/blog-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h3 class=\"blog-details__title-2\">Cloud Computing &amp; Edge Computing</h3>\r\n<p class=\"blog-details__text-2\">Shift from traditional cloud to hybrid and multi-cloud strategies. Edge computing gaining momentum for faster processing and reduced latency. The role of serverless computing in optimizing IT operations.</p>\r\n<div class=\"blog-details__author-box\">\r\n<div class=\"blog-details__author-quote\"><img src=\"2025/08/10/quote.png\" alt=\"\" /></div>\r\n<div class=\"blog-details__author-name-box\">\r\n<p>&nbsp;</p>\r\n<h4 class=\"blog-details__author-name\">Jhon Smith</h4>\r\n</div>\r\n<p class=\"blog-details__author-text\">&ldquo;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />&ldquo;</p>\r\n</div>\r\n<h3 class=\"blog-details__title-3\">Quantum Computing Breakthroughs</h3>\r\n<p class=\"blog-details__text-3\">ow quantum computing is shaping industries like finance, healthcare, and logistics. Businesses exploring quantum-safe encryption methods. Major players investing in quantum technology. Faster networks powering real-time applications, IoT, and smart cities.</p>\r\n<div class=\"blog-details__points-and-img\">\r\n<div class=\"blog-details__points-2\">\r\n<ul class=\"blog-details__points-list-2 list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Demand for eco-friendly and carbon-<br />neutral IT solutions.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>Rise of energy-efficient data centers and<br />sustainable cloud computing.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle icon-item\">&nbsp;</p>\r\n</div>\r\n<p>How businesses can implement green IT <br />practices.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"blog-details__points-img\">\r\n<div class=\"blog-details__points-img\"><img src=\"2025/08/10/blog-details-points-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>', 'publish', 11, '2025-08-10 06:52:56', '2025-08-11 14:36:54', 15, 15, 'posts', NULL, '[{\"id\":44,\"name\":\"Web Design & Development\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"web-design-development\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/web-design-development\"},{\"id\":45,\"name\":\"Development\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"development\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/development\"},{\"id\":46,\"name\":\"Innovation\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"innovation\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/innovation\"}]', 0.00, 0, 0, '17f3fc72-45e5-43f0-b617-3fec4726972i', 'vi'),
(203, 'Blog Grid', NULL, 'blog-grid', '', NULL, 'publish', 2, '2025-08-12 14:25:29', '2025-08-12 14:27:33', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"blog_style\":\"blog_grid\",\"section_title\":\"News & Blog\",\"section_subtitle_1\":\"How We\'ve\",\"section_subtitle_2\":\"Empowered Businesses\",\"section_subtitle_3\":\"with Innovative\",\"section_subtitle_4\":\"Tech Solutions\",\"block\":\"blogs_page\"}]}}', '[]', 0.00, 0, 0, '2e383fe8-668c-46d0-9772-ff086245e67b', 'vi'),
(204, 'Blog Carousel', NULL, 'blog-carousel', '', NULL, 'publish', 2, '2025-08-12 14:26:33', '2025-08-12 14:26:33', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"blog_style\":\"blog_carousel\",\"section_title\":null,\"section_subtitle_1\":null,\"section_subtitle_2\":null,\"section_subtitle_3\":null,\"section_subtitle_4\":null,\"block\":\"blogs_page\"}]}}', '[]', 0.00, 0, 0, 'f0c97689-5cc1-4e66-af35-0aaa48274b7c', 'vi'),
(205, 'Blog List', NULL, 'blog-list', '', NULL, 'publish', 2, '2025-08-12 14:27:11', '2025-08-12 14:27:42', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"blog_style\":\"blog_list_two\",\"section_title\":null,\"section_subtitle_1\":null,\"section_subtitle_2\":null,\"section_subtitle_3\":null,\"section_subtitle_4\":null,\"block\":\"blogs_page\"}]}}', '[]', 0.00, 0, 0, '5e593a31-e8df-4d33-9147-9bbe7a4382d4', 'vi'),
(206, 'Services', NULL, 'services', '', NULL, 'publish', 3, '2025-08-12 14:55:31', '2025-08-15 08:59:43', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Your Business with Cutting-Edge IT\",\"section_title_2\":\"Solutions\",\"section_title_image\":\"2025\\/08\\/12\\/section-title-img.jpg\",\"section_title_3\":\"Innovative IT Services\",\"section_title_4\":\"Tailored for Your Success\",\"round_text\":\"View All Services View All Project\",\"round_icon\":\"2025\\/08\\/12\\/services-two-round-icon.png\",\"use_services_post_type\":\"1\",\"items_limit\":\"4\",\"service_ids\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"services_two_list\"},{\"form_title\":\"How Can We Help You?\",\"name_label\":\"Full Name\",\"name_placeholder\":\"Thomas Alison\",\"email_label\":\"Email Address\",\"email_placeholder\":\"thomas@domain.com\",\"phone_label\":\"Phone Number\",\"phone_placeholder\":\"+12 (00) 123 4567 890\",\"subject_label\":\"Subject\",\"message_label\":\"Inquiry about\",\"message_placeholder\":\"Write your message\",\"submit_button_text\":\"Submit Now\",\"section_tagline\":\"Get In Touch\",\"section_title_line1\":\"Start the Conversation\",\"section_title_line2\":\"Reach Out Anytime\",\"section_description\":\"We\'re here to listen! Whether you have questions, \\\\\\\\ feedback, or just want to say hello, feel free to reach out.\",\"location_title\":\"Location\",\"location_address\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"email_title\":\"Email Us\",\"email_address1\":\"info@domain.com\",\"email_address2\":\"support@domain.com\",\"contact_title\":\"Contact\",\"tel_number\":\"+12 (00) 456 7890 00\",\"mobile_number\":\"+99 (00) 567 780\",\"bg_shape\":\"2025\\/08\\/12\\/contact-one-bg-shape.png\",\"enable_animation\":\"1\",\"block\":\"contact_form\"},{\"shape_1\":\"2025\\/08\\/12\\/process-one-shape-1.png\",\"bg_shape\":\"2025\\/08\\/12\\/process-one-bg-shape.png\",\"section_tagline\":\"Working Process\",\"title_part_1\":\"How We\'ve\",\"title_part_2\":\"Empowered\",\"title_part_3\":\"Businesses with Innovative\",\"title_part_4\":\"Tech Solutions\",\"description\":\"From personalized solutions to expert \\\\\\\\ execution, we prioritize\\r\\n                                quality, reliability, and \\\\\\\\ customer satisfaction\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"process_steps\":[{\"title\":\"Discovery & Strategy\",\"text\":\"We analyze your business needs, \\\\\\\\ identify challenges, and craft a \\\\\\\\ strategic roadmap for the best IT \\\\\\\\ solutions.\",\"count_left\":\"1\"},{\"title\":\"Development\",\"text\":\"Our expert team designs, develops, \\\\\\\\ and integrates cutting-edge \\\\\\\\ technology tailored to your goals.\",\"count_left\":\"0\"},{\"title\":\"Optimization & Support\",\"text\":\"We ensure seamless performance with \\\\\\\\ continuous improvements, \\\\\\\\ maintenance, and dedicated support.\",\"count_left\":\"1\"}],\"block\":\"process_area_home2\"},{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"Select the Perfect\",\"section_title_2\":\"Plan for Your\",\"section_title_3\":\"Needs That Fits You\",\"tab_1_title\":\"Monthly\",\"tab_2_title\":\"Yearly\",\"tab_3_title\":\"Packages\",\"default_active_tab\":\"yearly\",\"monthly_items_limit\":null,\"monthly_pricing_ids\":null,\"yearly_items_limit\":null,\"yearly_pricing_ids\":null,\"packages_items_limit\":null,\"packages_pricing_ids\":null,\"unlimited_offer_text\":\"\\u26a1 Unlimited Offer\",\"features_title\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_two\"}]}}', '[]', 0.00, 0, 0, '103b6e06-690a-4ef3-b08c-ec70e7e0018a', 'vi'),
(207, 'PERSONAL', '2025/08/14/pricing-icon-1.png', 'personal', 'Will get free 3 months solutions support', '<p>Will get free 3 months solutions support</p>', 'publish', 1, '2025-08-12 15:23:10', '2025-08-14 05:37:24', 15, 15, 'pricing', '{\"price\":\"$5.60\",\"annual_price\":\"$50.30\",\"annual_price_description\":\"Will get free 5 months solutions support\",\"price_button_text\":\"Choose Plan\",\"price_button_url\":\"\\/contact\",\"is_populer\":\"0\",\"features_list\":[{\"features_title\":\"Custom Website Design\",\"features_active\":\"1\"},{\"features_title\":\"website Design & Development\",\"features_active\":\"1\"},{\"features_title\":\"Social Media Graphics\",\"features_active\":\"0\"},{\"features_title\":\"Brand Color Palette\",\"features_active\":\"0\"}]}', '[]', 0.00, 0, 0, '6aa3a2ed-f68a-4228-a63a-c5834e66214b', 'vi'),
(208, 'Premium', '2025/08/14/pricing-icon-1.png', 'premium', 'Will get free 5 months solutions support', '<p>Will get free 5 months solutions support</p>', 'publish', 0, '2025-08-12 15:26:54', '2025-08-14 05:37:10', 15, 15, 'pricing', '{\"price\":\"$25.60\",\"annual_price\":\"$240.70\",\"annual_price_description\":\"Will get free 5 months solutions support\",\"price_button_text\":\"Choose Plan\",\"price_button_url\":\"\\/contact\",\"is_populer\":\"1\",\"features_list\":[{\"features_title\":\"Custom Website Design\",\"features_active\":\"1\"},{\"features_title\":\"website Design & Development\",\"features_active\":\"1\"},{\"features_title\":\"Basic & Technical SEO\",\"features_active\":\"1\"},{\"features_title\":\"Social Media Graphics\",\"features_active\":\"0\"},{\"features_title\":\"Brand Color Palette\",\"features_active\":\"0\"}]}', '[]', 0.00, 0, 0, '72cafa6a-db25-4c37-921c-60639ef58f58', 'vi'),
(209, 'Business', '2025/08/14/pricing-icon-1.png', 'business', 'Will get free lifetime solutions support', '<p class=\"pricing-two__text\">Will get free lifetime solutions support</p>', 'publish', 0, '2025-08-12 15:54:43', '2025-08-14 05:36:51', 15, 15, 'pricing', '{\"price\":\"$120\",\"annual_price\":\"$1200\",\"annual_price_description\":\"Will get free lifetime solutions support\",\"price_button_text\":\"Choose Plan\",\"price_button_url\":\"\\/contact\",\"is_populer\":\"0\",\"features_list\":[{\"features_title\":\"Custom Website Design\",\"features_active\":\"1\"},{\"features_title\":\"website Design & Development\",\"features_active\":\"1\"},{\"features_title\":\"Social Media Graphics\",\"features_active\":\"0\"},{\"features_title\":\"Brand Color Palette\",\"features_active\":\"0\"}]}', '[]', 0.00, 0, 0, 'ef4bd161-bf45-4d07-9d03-373aa7ed033c', 'vi'),
(210, 'Software Development Map', '2025/08/12/services-2-1.jpg', 'software-development-solutions', ' \r This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.\r A full...', '<div class=\"services-details__bdr\">&nbsp;</div>\r\n<p class=\"services-details__text-1\">This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.</p>\r\n<p class=\"services-details__text-2\">A full suite of services designed to enhance online campaigns, boost audience engagement, and implement creative strategies tailored to meet the unique needs of your brand.</p>\r\n<div class=\"services-details__img-1\"><img src=\"2025/08/12/services-details-img-5.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-2\">Services Core Features</h4>\r\n<p class=\"services-details__text-3\">Tailored marketing strategies aligned with your business goals. Competitor analysis and market research for actionable insights. Roadmaps for short-term campaigns and long-term growth. content creation and scheduling for maximum engagement. Community management to interact with your audience.</p>\r\n<div class=\"services-details__points-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>On-page and off-page optimization for better search rankings.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Targeted ad campaigns on platforms like Google Ads, Facebook, and Instagram</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Development of a unique tone of voice for your brand. Brand Identity Creation</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list services-details__points-list--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Regular performance audits to stay ahead of competitors.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Detailed reports on campaign performance and user engagement.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Insights-driven recommendations for continuous improvement.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h4 class=\"services-details__title-3\">Your Partner in Digital Success</h4>\r\n<p class=\"services-details__text-4\">Our services go beyond traditional marketing&mdash;offering innovative, data-driven, and tailored strategies to help your business thrive in the digital landscape. With a team of experts committed to creativity, precision, and measurable results, we deliver solutions that elevate your brand, engage your audience</p>\r\n<div class=\"services-details__points-box-2\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-idea\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Tailored Strategies</h5>\r\n<p>Customized marketing plans designed specifically for your business goals and target audience.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-strategy\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>End-to-End Solutions</h5>\r\n<p>From brand identity to advertising and content creation, we cover all aspects of digital marketing.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two services-details__points-two--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-target\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Data-Driven Decisions</h5>\r\n<p>Comprehensive analytics and insights to optimize campaigns and ensure measurable results.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-transparency\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Transparent Reporting</h5>\r\n<p>Regular performance updates and easy-to-understand reports to keep you informed every step of the way.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__bottom-img\"><img src=\"2025/08/12/services-details-bottom-img.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-4\">Get Started</h4>\r\n<p class=\"services-details__text-5\">Bring your vision to life with our tailored solutions, creative strategies, and professional support. Whether you\'re launching a new brand, enhancing your online presence, or driving growth, we provide the tools, expertise, and guidance you need to achieve success. Let&rsquo;s turn your ideas into reality today!</p>', 'publish', 1, '2025-08-12 15:59:35', '2025-08-12 16:51:44', 15, 15, 'services', '{\"features_list\":[{\"features_title_1\":\"UI\\/UX Design\",\"features_title_2\":\"Mobile Application\"},{\"features_title_1\":\"Mobile Application\",\"features_title_2\":\"Research\"},{\"features_title_1\":\"Research\",\"features_title_2\":\"UI\\/UX Design\"}]}', '[{\"id\":54,\"name\":\"Software\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"software\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/software\"}]', 0.00, 0, 0, 'cc0c7b71-28f7-4fbd-9b93-c25c32cb004f', 'vi'),
(211, 'What services does your IT consultancy agency provide?', NULL, 'what-services-does-your-it-consultancy-agency-provide', 'We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation...', '<p>We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.</p>\r\n<p>Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.</p>', 'publish', 0, '2025-08-12 16:22:30', '2025-08-12 16:25:01', 15, 15, 'faqs', '{\"is_active\":\"false\"}', '[{\"id\":55,\"name\":\"agency\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"agency\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/agency\"}]', 0.00, 0, 0, 'de5754e9-edaf-47f5-bab7-79f544d11235', 'vi'),
(212, 'How can IT consulting benefit my business?', NULL, 'how-can-it-consulting-benefit-my-business', 'We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation...', '<p>We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.</p>\r\n<p>Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.</p>', 'publish', 0, '2025-08-12 16:24:52', '2025-08-12 16:25:09', 15, 15, 'faqs', '{\"is_active\":\"true\"}', '[{\"id\":56,\"name\":\"software\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"software-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/software-1\"}]', 0.00, 0, 0, '5bbb777a-a108-4015-b8ca-2be25f608f8f', 'vi'),
(213, 'Do you offer customized IT solutions?', NULL, 'do-you-offer-customized-it-solutions', 'We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation...', '<p>We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.</p>\r\n<p>Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.</p>', 'publish', 0, '2025-08-12 16:26:00', '2025-08-12 16:26:00', 15, 15, 'faqs', '{\"is_active\":\"false\"}', '[{\"id\":57,\"name\":\"consulting\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"consulting\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/consulting\"}]', 0.00, 0, 0, 'f858bd0a-9ae5-4637-84da-99b961509a5a', 'vi'),
(214, 'How do you ensure data security and compliance?', NULL, 'how-do-you-ensure-data-security-and-compliance', 'We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation...', '<p>We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.</p>\r\n<p>Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.</p>', 'publish', 0, '2025-08-12 16:28:54', '2025-08-12 16:28:54', 15, 15, 'faqs', '{\"is_active\":\"false\"}', '[{\"id\":57,\"name\":\"consulting\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"consulting\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/consulting\"}]', 0.00, 0, 0, 'b6e74bfa-9ab2-4a48-9e54-d71b21951002', 'vi'),
(215, 'Sarah Williams', '2025/08/12/testimonial-2-2.jpg', 'sarah-williams', 'Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.', '<p>Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.</p>', 'publish', 0, '2025-08-12 16:30:43', '2025-08-12 16:30:43', 15, 15, 'testimonials', '{\"name\":\"Sarah Williams\",\"position\":\"Marketing Manger\",\"rating\":\"5\"}', '[]', 0.00, 0, 0, 'b1c411ee-28d0-4d0a-a105-d5542735a1bc', 'vi'),
(216, 'Thomas Alison', '2025/08/12/testimonial-2-3.jpg', 'thomas-alison', 'Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.', '<p>Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.</p>', 'publish', 0, '2025-08-12 16:32:21', '2025-08-12 16:32:21', 15, 15, 'testimonials', '{\"name\":\"Thomas Alison\",\"position\":\"UI\\/UX Designer\",\"rating\":\"4\"}', '[]', 0.00, 0, 0, '60e1a87e-407b-47eb-afd4-a146d900304b', 'vi'),
(217, 'James Anderson', '2025/08/12/testimonial-2-1.jpg', 'james-anderson', 'Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.', '<p>Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.</p>', 'publish', 0, '2025-08-12 16:33:11', '2025-08-12 16:33:11', 15, 15, 'testimonials', '{\"name\":\"James Anderson\",\"position\":\"Product Designer\",\"rating\":\"5\"}', '[]', 0.00, 0, 0, '31d9ac2b-ad19-4475-861b-12d4db7d9982', 'vi'),
(218, 'Services Carousel', NULL, 'services-carousel', '', NULL, 'publish', 2, '2025-08-12 16:36:51', '2025-08-12 16:51:03', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"section_tagline\":null,\"section_title_1\":null,\"section_title_2\":null,\"section_title_3\":null,\"section_title_4\":null,\"use_services_post_type\":\"1\",\"items_limit\":\"5\",\"service_ids\":null,\"enable_animation\":\"1\",\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_margin\":null,\"block\":\"service_slider_home3\"}]}}', '[]', 0.00, 0, 0, 'e89877e7-2b2f-4cb6-8ab4-38bf64491975', 'vi'),
(219, 'Cybersecurity Risk Atra', '2025/08/12/services-2-2.jpg', 'cybersecurity-risk-management', ' \r This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.\r A full...', '<div class=\"services-details__bdr\">&nbsp;</div>\r\n<p class=\"services-details__text-1\">This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.</p>\r\n<p class=\"services-details__text-2\">A full suite of services designed to enhance online campaigns, boost audience engagement, and implement creative strategies tailored to meet the unique needs of your brand.</p>\r\n<div class=\"services-details__img-1\"><img src=\"2025/08/12/services-details-img-5.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-2\">Services Core Features</h4>\r\n<p class=\"services-details__text-3\">Tailored marketing strategies aligned with your business goals. Competitor analysis and market research for actionable insights. Roadmaps for short-term campaigns and long-term growth. content creation and scheduling for maximum engagement. Community management to interact with your audience.</p>\r\n<div class=\"services-details__points-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>On-page and off-page optimization for better search rankings.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Targeted ad campaigns on platforms like Google Ads, Facebook, and Instagram</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Development of a unique tone of voice for your brand. Brand Identity Creation</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list services-details__points-list--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Regular performance audits to stay ahead of competitors.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Detailed reports on campaign performance and user engagement.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Insights-driven recommendations for continuous improvement.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h4 class=\"services-details__title-3\">Your Partner in Digital Success</h4>\r\n<p class=\"services-details__text-4\">Our services go beyond traditional marketing&mdash;offering innovative, data-driven, and tailored strategies to help your business thrive in the digital landscape. With a team of experts committed to creativity, precision, and measurable results, we deliver solutions that elevate your brand, engage your audience</p>\r\n<div class=\"services-details__points-box-2\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-idea\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Tailored Strategies</h5>\r\n<p>Customized marketing plans designed specifically for your business goals and target audience.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-strategy\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>End-to-End Solutions</h5>\r\n<p>From brand identity to advertising and content creation, we cover all aspects of digital marketing.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two services-details__points-two--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-target\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Data-Driven Decisions</h5>\r\n<p>Comprehensive analytics and insights to optimize campaigns and ensure measurable results.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-transparency\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Transparent Reporting</h5>\r\n<p>Regular performance updates and easy-to-understand reports to keep you informed every step of the way.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__bottom-img\"><img src=\"2025/08/12/services-details-bottom-img.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-4\">Get Started</h4>\r\n<p class=\"services-details__text-5\">Bring your vision to life with our tailored solutions, creative strategies, and professional support. Whether you\'re launching a new brand, enhancing your online presence, or driving growth, we provide the tools, expertise, and guidance you need to achieve success. Let&rsquo;s turn your ideas into reality today!</p>', 'publish', 1, '2025-08-12 16:42:16', '2025-08-12 16:51:30', 15, 15, 'services', '{\"features_list\":[{\"features_title_1\":\"Security\",\"features_title_2\":\"Performance\"},{\"features_title_1\":\"Scalability\",\"features_title_2\":\"Reliability\"},{\"features_title_1\":\"Innovation\",\"features_title_2\":\"Efficiency\"}]}', '[{\"id\":58,\"name\":\"Cybersecurity\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"cybersecurity\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/cybersecurity\"}]', 0.00, 0, 0, '61b09417-9303-4f12-94bc-7cd983d3aa0f', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(220, 'Cloud Solutions Provider', '2025/08/12/services-2-3.jpg', 'cloud-solutions-provider', ' \r This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.\r A full...', '<div class=\"services-details__bdr\">&nbsp;</div>\r\n<p class=\"services-details__text-1\">This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.</p>\r\n<p class=\"services-details__text-2\">A full suite of services designed to enhance online campaigns, boost audience engagement, and implement creative strategies tailored to meet the unique needs of your brand.</p>\r\n<div class=\"services-details__img-1\"><img src=\"2025/08/12/services-details-img-5.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-2\">Services Core Features</h4>\r\n<p class=\"services-details__text-3\">Tailored marketing strategies aligned with your business goals. Competitor analysis and market research for actionable insights. Roadmaps for short-term campaigns and long-term growth. content creation and scheduling for maximum engagement. Community management to interact with your audience.</p>\r\n<div class=\"services-details__points-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>On-page and off-page optimization for better search rankings.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Targeted ad campaigns on platforms like Google Ads, Facebook, and Instagram</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Development of a unique tone of voice for your brand. Brand Identity Creation</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list services-details__points-list--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Regular performance audits to stay ahead of competitors.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Detailed reports on campaign performance and user engagement.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Insights-driven recommendations for continuous improvement.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h4 class=\"services-details__title-3\">Your Partner in Digital Success</h4>\r\n<p class=\"services-details__text-4\">Our services go beyond traditional marketing&mdash;offering innovative, data-driven, and tailored strategies to help your business thrive in the digital landscape. With a team of experts committed to creativity, precision, and measurable results, we deliver solutions that elevate your brand, engage your audience</p>\r\n<div class=\"services-details__points-box-2\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-idea\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Tailored Strategies</h5>\r\n<p>Customized marketing plans designed specifically for your business goals and target audience.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-strategy\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>End-to-End Solutions</h5>\r\n<p>From brand identity to advertising and content creation, we cover all aspects of digital marketing.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two services-details__points-two--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-target\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Data-Driven Decisions</h5>\r\n<p>Comprehensive analytics and insights to optimize campaigns and ensure measurable results.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-transparency\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Transparent Reporting</h5>\r\n<p>Regular performance updates and easy-to-understand reports to keep you informed every step of the way.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__bottom-img\"><img src=\"2025/08/12/services-details-bottom-img.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-4\">Get Started</h4>\r\n<p class=\"services-details__text-5\">Bring your vision to life with our tailored solutions, creative strategies, and professional support. Whether you\'re launching a new brand, enhancing your online presence, or driving growth, we provide the tools, expertise, and guidance you need to achieve success. Let&rsquo;s turn your ideas into reality today!</p>', 'publish', 0, '2025-08-12 16:43:42', '2025-08-12 16:43:42', 15, 15, 'services', '{\"features_list\":[{\"features_title_1\":\"Cloud Security\",\"features_title_2\":\"Cloud Scalability\"},{\"features_title_1\":\"Cloud Integration\",\"features_title_2\":\"Cloud Performance\"},{\"features_title_1\":\"Cloud Backup\",\"features_title_2\":\"Cloud Optimization\"}]}', '[{\"id\":59,\"name\":\"Cloud\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"cloud\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/cloud\"}]', 0.00, 0, 0, '57e2d217-8e5b-4c4b-b0bd-3ab5693e03fa', 'vi'),
(221, 'Data Analytics Consulting', '2025/08/12/services-2-4.jpg', 'data-analytics-consulting', ' \r This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.\r A full...', '<div class=\"services-details__bdr\">&nbsp;</div>\r\n<p class=\"services-details__text-1\">This approach encompasses online branding, content marketing, and SEO, offering customized solutions to drive impactful results and long-term success in the digital landscape.</p>\r\n<p class=\"services-details__text-2\">A full suite of services designed to enhance online campaigns, boost audience engagement, and implement creative strategies tailored to meet the unique needs of your brand.</p>\r\n<div class=\"services-details__img-1\"><img src=\"2025/08/12/services-details-img-5.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-2\">Services Core Features</h4>\r\n<p class=\"services-details__text-3\">Tailored marketing strategies aligned with your business goals. Competitor analysis and market research for actionable insights. Roadmaps for short-term campaigns and long-term growth. content creation and scheduling for maximum engagement. Community management to interact with your audience.</p>\r\n<div class=\"services-details__points-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>On-page and off-page optimization for better search rankings.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Targeted ad campaigns on platforms like Google Ads, Facebook, and Instagram</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Development of a unique tone of voice for your brand. Brand Identity Creation</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-list services-details__points-list--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Regular performance audits to stay ahead of competitors.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Detailed reports on campaign performance and user engagement.</p>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Insights-driven recommendations for continuous improvement.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"services-details__img-box-img\"><img src=\"2025/08/12/services-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<h4 class=\"services-details__title-3\">Your Partner in Digital Success</h4>\r\n<p class=\"services-details__text-4\">Our services go beyond traditional marketing&mdash;offering innovative, data-driven, and tailored strategies to help your business thrive in the digital landscape. With a team of experts committed to creativity, precision, and measurable results, we deliver solutions that elevate your brand, engage your audience</p>\r\n<div class=\"services-details__points-box-2\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-idea\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Tailored Strategies</h5>\r\n<p>Customized marketing plans designed specifically for your business goals and target audience.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-strategy\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>End-to-End Solutions</h5>\r\n<p>From brand identity to advertising and content creation, we cover all aspects of digital marketing.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<ul class=\"services-details__points-two services-details__points-two--two list-unstyled\">\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-target\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Data-Driven Decisions</h5>\r\n<p>Comprehensive analytics and insights to optimize campaigns and ensure measurable results.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"icon\">\r\n<p class=\"icon-transparency\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Transparent Reporting</h5>\r\n<p>Regular performance updates and easy-to-understand reports to keep you informed every step of the way.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"services-details__bottom-img\"><img src=\"2025/08/12/services-details-bottom-img.jpg\" alt=\"\" /></div>\r\n<h4 class=\"services-details__title-4\">Get Started</h4>\r\n<p class=\"services-details__text-5\">Bring your vision to life with our tailored solutions, creative strategies, and professional support. Whether you\'re launching a new brand, enhancing your online presence, or driving growth, we provide the tools, expertise, and guidance you need to achieve success. Let&rsquo;s turn your ideas into reality today!</p>', 'publish', 0, '2025-08-12 16:44:56', '2025-08-12 16:44:56', 15, 15, 'services', '{\"features_list\":[{\"features_title_1\":\"Data Insights\",\"features_title_2\":\"Predictive Analytics\"},{\"features_title_1\":\"Big Data\",\"features_title_2\":\"Business Intelligence\"},{\"features_title_1\":\"Data Visualization\",\"features_title_2\":\"Data Strategy\"}]}', '[{\"id\":60,\"name\":\"Analytics\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"analytics-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/analytics-1\"}]', 0.00, 0, 0, '8968c685-f59a-45a3-8c82-79edcb576f0f', 'vi'),
(222, 'David Smith', '2025/08/13/team-1-1.jpg', 'david-smith', 'David Smith is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes...', '<p class=\"team-details__text\">David Smith is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 2, '2025-08-13 03:13:04', '2025-08-14 06:57:38', 15, 15, 'teams', '{\"position\":\"Professional UI\\/UX Design\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Professional UI\\/UX Design\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e606', 'vi'),
(223, 'Pricings', NULL, 'pricings', '', NULL, 'publish', 2, '2025-08-14 05:33:17', '2025-08-14 05:36:04', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered Businesses\",\"section_title_3\":\"with Innovative\",\"section_title_4\":\"Tech Solutions\",\"use_pricing_post_type\":\"1\",\"items_limit\":null,\"pricing_ids\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_page\"}]}}', '[]', 0.00, 0, 0, 'be691afc-54fe-495f-afec-aeebe76605b5', 'vi'),
(224, 'Gallery', NULL, 'gallery', '', NULL, 'publish', 2, '2025-08-14 05:38:43', '2025-08-14 05:48:32', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"enable_lightbox\":\"1\",\"enable_masonry\":\"1\",\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"gallery_page\"}]}}', '[]', 0.00, 0, 0, 'c07a93a0-1673-4f70-b845-48c206b0a6d3', 'vi'),
(225, 'FAQ’s', NULL, 'faqs', '', NULL, 'publish', 2, '2025-08-14 05:49:55', '2025-08-14 05:52:24', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"section_tagline\":\"FAQS\",\"section_title\":\"Get answers to the most common \\\\\\\\\\r\\nquestions about our products, services, \\\\\\\\\\r\\nand policies.\",\"use_faqs_post_type\":\"1\",\"items_limit\":null,\"faq_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"show_cta_section\":\"1\",\"cta_tagline\":\"Get In Touch\",\"cta_title\":\"If you have any questions, \\\\\\\\ please contact us.\",\"cta_button_text\":\"Get in Touch\",\"cta_button_url\":\"\\/contact\",\"cta_shape_1\":null,\"cta_shape_2\":null,\"quick_support_title\":null,\"quick_support_text\":null,\"email_title\":null,\"email_1\":null,\"email_2\":null,\"contact_title\":null,\"phone_tel\":null,\"phone_mob\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"faq_page\"}]}}', '[]', 0.00, 0, 0, '0c6875fd-6386-47b4-9fe8-3c32f665d071', 'vi'),
(226, 'Testimonials', NULL, 'testimonials', '', NULL, 'publish', 1, '2025-08-14 05:54:55', '2025-08-14 05:55:18', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"use_testimonials_post_type\":\"1\",\"items_limit\":\"6\",\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"grid_columns\":\"3\",\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"testimonials_grid_list\"}]}}', '[]', 0.00, 0, 0, 'cfcf200a-1c13-42ea-b7d3-59d8eab11f72', 'vi'),
(227, 'Testimonials Carousel', NULL, 'testimonials-carousel', '', NULL, 'publish', 2, '2025-08-14 05:56:40', '2025-08-14 05:56:40', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_class\":null,\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"testimonials_carousel\"}]}}', '[]', 0.00, 0, 0, 'cbb3a1f8-eb48-4b09-b0ee-3aefdf184ce9', 'vi'),
(228, 'Innovative Digital Solutions for a Smarter Future', '2025/08/14/portfolio-1-1.jpg', 'innovative-digital-solutions-for-a-smarter-future', '\r \r  \r \r Project Overviews\r In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology...', '<ul class=\"portfolio-details__portfolio-page list-unstyled\">\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-1\">Project Overviews</h4>\r\n<p class=\"portfolio-details__text-1\">In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology tailored for various industries, ensuring seamless operations, enhanced security, and optimal performance. From cloud computing and AI-driven automation to cybersecurity and enterprise software, we provide future-proof solutions that empower businesses to thrive in a competitive world. Whether you\'re in healthcare, finance, retail, or manufacturing, our IT expertise helps you drive efficiency, innovation, and growth.</p>\r\n<div class=\"portfolio-details__img-1\"><img src=\"2025/08/14/portfolio-details-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-2\">Future-Ready IT Solutions for Every Industry</h4>\r\n<p class=\"portfolio-details__text-2\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__points-box-two\">\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cloud Solu tions &ndash; Scalable and secure<br />cloud infrastructures for seamless<br />operations.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cybersecurity &ndash; Advanced security<br />solutions to protect against cyber threats</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>IT Consulting &amp; Support &ndash; Expert guidance<br />to optimize IT infrastructure and<br />workflows.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>AI &amp; Automation &ndash; Smart automation tools<br />that enhance productivity and decision-<br />making.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Custom Software Development &ndash; Tailor-<br />made software solutions for industry-<br />specific needs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-12\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-3.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-3\">Case Study:</h4>\r\n<p class=\"portfolio-details__text-3\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__portfolio-list-three\">\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Real-time stock updates across all stores and online platforms.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Optimized stock replenishment based on purchasing trends.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box-2\"><img src=\"2025/08/14/portfolio-details-img-box-2-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<p class=\"portfolio-details__text-4\">By integrating future-ready technologies, we ensure businesses remain agile, efficient, and secure in an ever-changing digital world. Whether you&rsquo;re a startup, SME, or enterprise, our end-to-end IT solutions will help you achieve sustainable growth and innovation.</p>\r\n<p class=\"portfolio-details__text-5\">By integrating AI and cloud computing, we helped the retailer streamline operations, reduce costs, and enhance customer experiences. This transformation positioned them for long-term growth in an increasingly digital market.</p>\r\n<p class=\"portfolio-details__text-6\">🚀 Empower your business with the technology of tomorrow&mdash;today!</p>\r\n</div>\r\n</li>\r\n</ul>', 'publish', 1, '2025-08-14 06:03:41', '2025-08-14 06:25:06', 15, 15, 'portfolios', '{\"excerpt\":\"Pioneering next-gen IT solutions that enhance efficiency and innovation.\",\"portfolio_link_title\":\"Get in touch\",\"portfolio_link\":\"\\/contact\",\"meta_list\":[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]}', '[{\"id\":61,\"name\":\"Web Development\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"web-development\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/web-development\"},{\"id\":62,\"name\":\"Branding\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"branding\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/branding\"}]', 0.00, 0, 0, '52b01927-0127-4600-9c26-04abc6a92b07', 'vi'),
(229, 'Empowering Businesses with Cutting-Edge Technology', '2025/08/14/portfolio-1-2.jpg', 'innovative-digital-solutions-for-a-smarter-future-1', '\r \r  \r \r Project Overviews\r In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology...', '<ul class=\"portfolio-details__portfolio-page list-unstyled\">\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-1\">Project Overviews</h4>\r\n<p class=\"portfolio-details__text-1\">In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology tailored for various industries, ensuring seamless operations, enhanced security, and optimal performance. From cloud computing and AI-driven automation to cybersecurity and enterprise software, we provide future-proof solutions that empower businesses to thrive in a competitive world. Whether you\'re in healthcare, finance, retail, or manufacturing, our IT expertise helps you drive efficiency, innovation, and growth.</p>\r\n<div class=\"portfolio-details__img-1\"><img src=\"2025/08/14/portfolio-details-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-2\">Future-Ready IT Solutions for Every Industry</h4>\r\n<p class=\"portfolio-details__text-2\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__points-box-two\">\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cloud Solu tions &ndash; Scalable and secure<br />cloud infrastructures for seamless<br />operations.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cybersecurity &ndash; Advanced security<br />solutions to protect against cyber threats</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>IT Consulting &amp; Support &ndash; Expert guidance<br />to optimize IT infrastructure and<br />workflows.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>AI &amp; Automation &ndash; Smart automation tools<br />that enhance productivity and decision-<br />making.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Custom Software Development &ndash; Tailor-<br />made software solutions for industry-<br />specific needs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-12\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-3.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-3\">Case Study:</h4>\r\n<p class=\"portfolio-details__text-3\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__portfolio-list-three\">\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Real-time stock updates across all stores and online platforms.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Optimized stock replenishment based on purchasing trends.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box-2\"><img src=\"2025/08/14/portfolio-details-img-box-2-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<p class=\"portfolio-details__text-4\">By integrating future-ready technologies, we ensure businesses remain agile, efficient, and secure in an ever-changing digital world. Whether you&rsquo;re a startup, SME, or enterprise, our end-to-end IT solutions will help you achieve sustainable growth and innovation.</p>\r\n<p class=\"portfolio-details__text-5\">By integrating AI and cloud computing, we helped the retailer streamline operations, reduce costs, and enhance customer experiences. This transformation positioned them for long-term growth in an increasingly digital market.</p>\r\n<p class=\"portfolio-details__text-6\">🚀 Empower your business with the technology of tomorrow&mdash;today!</p>\r\n</div>\r\n</li>\r\n</ul>', 'publish', 2, '2025-08-14 06:03:41', '2025-08-14 06:38:20', 15, 15, 'portfolios', '{\"excerpt\":\"Delivering smart, scalable, and future-proof tech solutions for growth.\",\"portfolio_link_title\":\"Get in touch\",\"portfolio_link\":\"\\/contact\",\"meta_list\":[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]}', '[{\"id\":63,\"name\":\"UI\\/UX Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"uiux-design\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/uiux-design\"},{\"id\":64,\"name\":\"Product Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"product-design\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/product-design\"}]', 0.00, 0, 0, '52b01927-0127-4600-9c26-04abc6a92b08', 'vi'),
(230, 'Innovative Digital Solutions for a Smarter Future', '2025/08/14/portfolio-1-6.jpg', 'innovative-digital-solutions-for-a-smarter-future-2', '\r \r  \r \r Project Overviews\r In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology...', '<ul class=\"portfolio-details__portfolio-page list-unstyled\">\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-1\">Project Overviews</h4>\r\n<p class=\"portfolio-details__text-1\">In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology tailored for various industries, ensuring seamless operations, enhanced security, and optimal performance. From cloud computing and AI-driven automation to cybersecurity and enterprise software, we provide future-proof solutions that empower businesses to thrive in a competitive world. Whether you\'re in healthcare, finance, retail, or manufacturing, our IT expertise helps you drive efficiency, innovation, and growth.</p>\r\n<div class=\"portfolio-details__img-1\"><img src=\"2025/08/14/portfolio-details-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-2\">Future-Ready IT Solutions for Every Industry</h4>\r\n<p class=\"portfolio-details__text-2\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__points-box-two\">\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cloud Solu tions &ndash; Scalable and secure<br />cloud infrastructures for seamless<br />operations.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cybersecurity &ndash; Advanced security<br />solutions to protect against cyber threats</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>IT Consulting &amp; Support &ndash; Expert guidance<br />to optimize IT infrastructure and<br />workflows.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>AI &amp; Automation &ndash; Smart automation tools<br />that enhance productivity and decision-<br />making.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Custom Software Development &ndash; Tailor-<br />made software solutions for industry-<br />specific needs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-12\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-3.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-3\">Case Study:</h4>\r\n<p class=\"portfolio-details__text-3\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__portfolio-list-three\">\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Real-time stock updates across all stores and online platforms.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Optimized stock replenishment based on purchasing trends.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box-2\"><img src=\"2025/08/14/portfolio-details-img-box-2-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<p class=\"portfolio-details__text-4\">By integrating future-ready technologies, we ensure businesses remain agile, efficient, and secure in an ever-changing digital world. Whether you&rsquo;re a startup, SME, or enterprise, our end-to-end IT solutions will help you achieve sustainable growth and innovation.</p>\r\n<p class=\"portfolio-details__text-5\">By integrating AI and cloud computing, we helped the retailer streamline operations, reduce costs, and enhance customer experiences. This transformation positioned them for long-term growth in an increasingly digital market.</p>\r\n<p class=\"portfolio-details__text-6\">🚀 Empower your business with the technology of tomorrow&mdash;today!</p>\r\n</div>\r\n</li>\r\n</ul>', 'publish', 1, '2025-08-14 06:03:41', '2025-08-14 06:42:04', 15, 15, 'portfolios', '{\"excerpt\":\"Pioneering next-gen IT solutions that enhance efficiency and innovation.\",\"portfolio_link_title\":\"Get in touch\",\"portfolio_link\":\"\\/contact\",\"meta_list\":[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]}', '[{\"id\":61,\"name\":\"Web Development\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"web-development\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/web-development\"},{\"id\":64,\"name\":\"Product Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"product-design\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/product-design\"}]', 0.00, 0, 0, '52b01927-0127-4600-9c26-04abc6a92b09', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(231, 'Seamless Tech Innovations for Business Growth', '2025/08/14/portfolio-1-5.jpg', 'innovative-digital-solutions-for-a-smarter-future-3', '\r \r  \r \r Project Overviews\r In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology...', '<ul class=\"portfolio-details__portfolio-page list-unstyled\">\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-1\">Project Overviews</h4>\r\n<p class=\"portfolio-details__text-1\">In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology tailored for various industries, ensuring seamless operations, enhanced security, and optimal performance. From cloud computing and AI-driven automation to cybersecurity and enterprise software, we provide future-proof solutions that empower businesses to thrive in a competitive world. Whether you\'re in healthcare, finance, retail, or manufacturing, our IT expertise helps you drive efficiency, innovation, and growth.</p>\r\n<div class=\"portfolio-details__img-1\"><img src=\"2025/08/14/portfolio-details-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-2\">Future-Ready IT Solutions for Every Industry</h4>\r\n<p class=\"portfolio-details__text-2\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__points-box-two\">\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cloud Solu tions &ndash; Scalable and secure<br />cloud infrastructures for seamless<br />operations.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cybersecurity &ndash; Advanced security<br />solutions to protect against cyber threats</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>IT Consulting &amp; Support &ndash; Expert guidance<br />to optimize IT infrastructure and<br />workflows.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>AI &amp; Automation &ndash; Smart automation tools<br />that enhance productivity and decision-<br />making.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Custom Software Development &ndash; Tailor-<br />made software solutions for industry-<br />specific needs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-12\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-3.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-3\">Case Study:</h4>\r\n<p class=\"portfolio-details__text-3\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__portfolio-list-three\">\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Real-time stock updates across all stores and online platforms.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Optimized stock replenishment based on purchasing trends.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box-2\"><img src=\"2025/08/14/portfolio-details-img-box-2-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<p class=\"portfolio-details__text-4\">By integrating future-ready technologies, we ensure businesses remain agile, efficient, and secure in an ever-changing digital world. Whether you&rsquo;re a startup, SME, or enterprise, our end-to-end IT solutions will help you achieve sustainable growth and innovation.</p>\r\n<p class=\"portfolio-details__text-5\">By integrating AI and cloud computing, we helped the retailer streamline operations, reduce costs, and enhance customer experiences. This transformation positioned them for long-term growth in an increasingly digital market.</p>\r\n<p class=\"portfolio-details__text-6\">🚀 Empower your business with the technology of tomorrow&mdash;today!</p>\r\n</div>\r\n</li>\r\n</ul>', 'publish', 1, '2025-08-14 06:03:41', '2025-08-14 06:41:41', 15, 15, 'portfolios', '{\"excerpt\":\"Pioneering next-gen IT solutions that enhance efficiency and innovation.\",\"portfolio_link_title\":\"Get in touch\",\"portfolio_link\":\"\\/contact\",\"meta_list\":[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]}', '[{\"id\":63,\"name\":\"UI\\/UX Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"uiux-design\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/uiux-design\"},{\"id\":64,\"name\":\"Product Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"product-design\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/product-design\"}]', 0.00, 0, 0, '52b01927-0127-4600-9c26-04abc6a92b10', 'vi'),
(232, 'Innovative Digital Solutions for a Smarter Future', '2025/08/14/portfolio-1-4.jpg', 'innovative-digital-solutions-for-a-smarter-future-4', '\r \r  \r \r Project Overviews\r In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology...', '<ul class=\"portfolio-details__portfolio-page list-unstyled\">\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-1\">Project Overviews</h4>\r\n<p class=\"portfolio-details__text-1\">In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology tailored for various industries, ensuring seamless operations, enhanced security, and optimal performance. From cloud computing and AI-driven automation to cybersecurity and enterprise software, we provide future-proof solutions that empower businesses to thrive in a competitive world. Whether you\'re in healthcare, finance, retail, or manufacturing, our IT expertise helps you drive efficiency, innovation, and growth.</p>\r\n<div class=\"portfolio-details__img-1\"><img src=\"2025/08/14/portfolio-details-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-2\">Future-Ready IT Solutions for Every Industry</h4>\r\n<p class=\"portfolio-details__text-2\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__points-box-two\">\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cloud Solu tions &ndash; Scalable and secure<br />cloud infrastructures for seamless<br />operations.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cybersecurity &ndash; Advanced security<br />solutions to protect against cyber threats</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>IT Consulting &amp; Support &ndash; Expert guidance<br />to optimize IT infrastructure and<br />workflows.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>AI &amp; Automation &ndash; Smart automation tools<br />that enhance productivity and decision-<br />making.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Custom Software Development &ndash; Tailor-<br />made software solutions for industry-<br />specific needs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-12\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-3.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-3\">Case Study:</h4>\r\n<p class=\"portfolio-details__text-3\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__portfolio-list-three\">\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Real-time stock updates across all stores and online platforms.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Optimized stock replenishment based on purchasing trends.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box-2\"><img src=\"2025/08/14/portfolio-details-img-box-2-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<p class=\"portfolio-details__text-4\">By integrating future-ready technologies, we ensure businesses remain agile, efficient, and secure in an ever-changing digital world. Whether you&rsquo;re a startup, SME, or enterprise, our end-to-end IT solutions will help you achieve sustainable growth and innovation.</p>\r\n<p class=\"portfolio-details__text-5\">By integrating AI and cloud computing, we helped the retailer streamline operations, reduce costs, and enhance customer experiences. This transformation positioned them for long-term growth in an increasingly digital market.</p>\r\n<p class=\"portfolio-details__text-6\">🚀 Empower your business with the technology of tomorrow&mdash;today!</p>\r\n</div>\r\n</li>\r\n</ul>', 'publish', 2, '2025-08-14 06:03:41', '2025-08-14 06:41:01', 15, 15, 'portfolios', '{\"excerpt\":\"Pioneering next-gen IT solutions that enhance efficiency and innovation.\",\"portfolio_link_title\":\"Get in touch\",\"portfolio_link\":\"\\/contact\",\"meta_list\":[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]}', '[{\"id\":62,\"name\":\"Branding\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"branding\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/branding\"},{\"id\":64,\"name\":\"Product Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"product-design\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/product-design\"}]', 0.00, 0, 0, '52b01927-0127-4600-9c26-04abc6a92b11', 'vi'),
(233, 'Transforming Ideas into Scalable IT Solutions', '2025/08/14/portfolio-1-3.jpg', 'innovative-digital-solutions-for-a-smarter-future-5', '\r \r  \r \r Project Overviews\r In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology...', '<ul class=\"portfolio-details__portfolio-page list-unstyled\">\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-1\">Project Overviews</h4>\r\n<p class=\"portfolio-details__text-1\">In today\'s fast-evolving digital landscape, businesses need innovative and scalable IT solutions to stay ahead. Our project delivers cutting-edge technology tailored for various industries, ensuring seamless operations, enhanced security, and optimal performance. From cloud computing and AI-driven automation to cybersecurity and enterprise software, we provide future-proof solutions that empower businesses to thrive in a competitive world. Whether you\'re in healthcare, finance, retail, or manufacturing, our IT expertise helps you drive efficiency, innovation, and growth.</p>\r\n<div class=\"portfolio-details__img-1\"><img src=\"2025/08/14/portfolio-details-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-2\">Future-Ready IT Solutions for Every Industry</h4>\r\n<p class=\"portfolio-details__text-2\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__points-box-two\">\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cloud Solu tions &ndash; Scalable and secure<br />cloud infrastructures for seamless<br />operations.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Cybersecurity &ndash; Advanced security<br />solutions to protect against cyber threats</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>IT Consulting &amp; Support &ndash; Expert guidance<br />to optimize IT infrastructure and<br />workflows.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__points-two\">\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>AI &amp; Automation &ndash; Smart automation tools<br />that enhance productivity and decision-<br />making.</p>\r\n</div>\r\n<div class=\"portfolio-details__points-two-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<p>Custom Software Development &ndash; Tailor-<br />made software solutions for industry-<br />specific needs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-1.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-6\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-2.jpg\" alt=\"\" /></div>\r\n</div>\r\n<div class=\"col-xl-12\">\r\n<div class=\"portfolio-details__img-box-img\"><img src=\"2025/08/14/portfolio-details-img-box-img-3.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<h4 class=\"portfolio-details__title-3\">Case Study:</h4>\r\n<p class=\"portfolio-details__text-3\">In an era where digital transformation is essential for business success, our project focuses on delivering scalable, secure, and cutting-edge IT solutions tailored to diverse industries. We help businesses harness the power of cloud computing, artificial intelligence (AI), automation, cybersecurity, and enterprise software to stay ahead of the competition.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__portfolio-list-three\">\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Real-time stock updates across all stores and online platforms.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Cloud-Based Inventory System</h5>\r\n<p>Optimized stock replenishment based on purchasing trends.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n<div class=\"portfolio-details__portfolio-list-three-single\">\r\n<div class=\"icon\">\r\n<p class=\"icon-tick-inside-circle\">&nbsp;</p>\r\n</div>\r\n<div class=\"content\">\r\n<h5>Personalized Customer Engagement</h5>\r\n<p>AI-driven product recommendations and loyalty programs.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<div class=\"portfolio-details__img-box-2\"><img src=\"2025/08/14/portfolio-details-img-box-2-img.jpg\" alt=\"\" /></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"portfolio-details__count\">&nbsp;</div>\r\n<div class=\"portfolio-details__portfolio-content\">\r\n<p class=\"portfolio-details__text-4\">By integrating future-ready technologies, we ensure businesses remain agile, efficient, and secure in an ever-changing digital world. Whether you&rsquo;re a startup, SME, or enterprise, our end-to-end IT solutions will help you achieve sustainable growth and innovation.</p>\r\n<p class=\"portfolio-details__text-5\">By integrating AI and cloud computing, we helped the retailer streamline operations, reduce costs, and enhance customer experiences. This transformation positioned them for long-term growth in an increasingly digital market.</p>\r\n<p class=\"portfolio-details__text-6\">🚀 Empower your business with the technology of tomorrow&mdash;today!</p>\r\n</div>\r\n</li>\r\n</ul>', 'publish', 2, '2025-08-14 06:03:41', '2025-08-14 06:40:18', 15, 15, 'portfolios', '{\"excerpt\":\"Turning complex challenges into streamlined, high-performance systems.\",\"portfolio_link_title\":\"Get in touch\",\"portfolio_link\":\"\\/contact\",\"meta_list\":[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]}', '[{\"id\":63,\"name\":\"UI\\/UX Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"uiux-design\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/uiux-design\"},{\"id\":65,\"name\":\"Cyber Security\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"cyber-security\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/cyber-security\"}]', 0.00, 0, 0, '52b01927-0127-4600-9c26-04abc6a92b12', 'vi'),
(238, 'Portfolios', NULL, 'portfolios', '', NULL, 'publish', 2, '2025-08-14 06:36:43', '2025-08-14 06:36:43', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"portfolio\"}', '[]', 0.00, 0, 0, '6d38af2e-ecca-444e-8ce7-e86e466b9a38', 'vi'),
(239, 'Sophia Reynolds', '2025/08/14/team-1-2.jpg', 'sophia-reynolds', 'Sophia Reynolds is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he...', '<p class=\"team-details__text\">Sophia Reynolds is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 2, '2025-08-13 03:13:04', '2025-08-14 07:05:00', 15, 15, 'teams', '{\"position\":\"Chief Technology Office\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Chief Technology Office\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e607', 'vi'),
(240, 'Michael Hayes', '2025/08/14/team-1-3.jpg', 'michael-hayes', 'Michael Hayes is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he...', '<p class=\"team-details__text\">Michael Hayes is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 2, '2025-08-13 03:13:04', '2025-08-14 07:05:46', 15, 15, 'teams', '{\"position\":\"Lead Software Engineer\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Lead Software Engineer\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e608', 'vi'),
(241, 'Emma Brooks', '2025/08/14/team-1-4.jpg', 'emma-brooks', 'Emma Brooks is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes...', '<p class=\"team-details__text\">Emma Brooks is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 3, '2025-08-13 03:13:04', '2025-08-14 07:06:35', 15, 15, 'teams', '{\"position\":\"UI\\/UX Designer\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"UI\\/UX Designer\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e609', 'vi'),
(242, 'Sarah Johnson', '2025/08/14/team-1-5.jpg', 'sarah-johnson', 'Sarah Johnson is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he...', '<p class=\"team-details__text\">Sarah Johnson is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 2, '2025-08-13 03:13:04', '2025-08-14 07:07:08', 15, 15, 'teams', '{\"position\":\"Marketing Manager\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Marketing Manager\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e610', 'vi'),
(243, 'David Matthews', '2025/08/14/team-1-6.jpg', 'david-matthews', 'David Matthews is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he...', '<p class=\"team-details__text\">David Matthews is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 2, '2025-08-13 03:13:04', '2025-08-14 07:07:42', 15, 15, 'teams', '{\"position\":\"Product Designer\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Product Designer\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e611', 'vi'),
(244, 'Olivia Grace', '2025/08/14/team-1-7.jpg', 'olivia-grace', 'Olivia Grace is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he...', '<p class=\"team-details__text\">Olivia Grace is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 2, '2025-08-13 03:13:04', '2025-08-14 07:08:18', 15, 15, 'teams', '{\"position\":\"Sales Director\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Sales Director\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e612', 'vi'),
(245, 'Mitchell Marsh', '2025/08/14/team-1-8.jpg', 'mitchell-marsh', 'Mitchell Marsh is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he...', '<p class=\"team-details__text\">Mitchell Marsh is a seasoned UI/UX designer with a keen eye for detail and a passion for crafting seamless digital experiences. With years of experience in user-centered design, he specializes in creating intuitive interfaces that enhance usability and engagement.</p>', 'publish', 4, '2025-08-13 03:13:04', '2025-08-14 07:08:55', 15, 15, 'teams', '{\"position\":\"Operations Lead\",\"department\":\"UI\\/UX Design\",\"subtitle\":\"Operations Lead\",\"skill_image\":\"2025\\/08\\/13\\/skill-one-img-1.jpg\",\"employment_type\":\"Full-time\",\"location\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"phone\":\"+12 (00) 456 7890 00\",\"mobile\":\"+99 (00) 567 780\",\"office_hours\":\"Sunday - Friday  \\r\\n10:00 AM - 5:00 PM\",\"years_experience\":\"12\",\"experience_title\":\"crafting intuitive\",\"experience_description\":\"Experience Description\",\"expertise_image\":null,\"expertise\":\"User research:95, Product Design:80, Prototype & Launch:85\",\"skills_title\":\"Design Skills Hub\",\"skills_description\":\"Design Expertise \\u2013 Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement\",\"show_social_links\":\"0\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\",\"dribbble\":\"http:\\/\\/dribbble.com\\/\"}', '[]', 0.00, 0, 0, '243ae2ed-a0a5-47be-a27f-7427b2a5e613', 'vi'),
(246, 'Team Carousel', NULL, 'team-carousel', '', NULL, 'publish', 2, '2025-08-14 07:10:27', '2025-08-14 07:11:28', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"default\",\"block_content\":{\"content\":[{\"section_title\":null,\"section_subtitle\":null,\"show_section_title\":\"0\",\"use_teams_post_type\":\"1\",\"items_per_page\":null,\"carousel_class\":null,\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_margin\":null,\"block\":\"teams_carousel\"}]}}', '[]', 0.00, 0, 0, 'acca0be8-1d67-4673-a145-e7d79dd30c62', 'vi'),
(247, 'Thomas Alisons', '2025/08/12/testimonial-2-3.jpg', 'thomas-alison-1', 'Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.', '<p>Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.</p>', 'publish', 0, '2025-08-12 16:32:21', '2025-08-14 07:28:32', 15, 15, 'testimonials', '{\"name\":\"Thomas Alisons\",\"position\":\"UI\\/UX Designers\",\"rating\":\"5\"}', '[]', 0.00, 0, 0, '60e1a87e-407b-47eb-afd4-a146d900304c', 'vi'),
(248, 'James Andersons', '2025/08/12/testimonial-2-1.jpg', 'james-anderson-1', 'Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.', '<p>Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.</p>', 'publish', 0, '2025-08-12 16:33:11', '2025-08-14 07:28:16', 15, 15, 'testimonials', '{\"name\":\"James Andersons\",\"position\":\"Product Designere\",\"rating\":\"4\"}', '[]', 0.00, 0, 0, '31d9ac2b-ad19-4475-861b-12d4db7d9983', 'vi'),
(249, 'Sarah William', '2025/08/12/testimonial-2-2.jpg', 'sarah-williams-1', 'Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.', '<p>Absolutely fantastic experience! The team exceeded our expectations and delivered a solution that perfectly met our needs. Their attention to detail and commitment to quality is unmatched.</p>', 'publish', 0, '2025-08-12 16:30:43', '2025-08-14 07:28:00', 15, 15, 'testimonials', '{\"name\":\"Sarah William\",\"position\":\"Marketing Mangere\",\"rating\":\"4\"}', '[]', 0.00, 0, 0, 'b1c411ee-28d0-4d0a-a105-d5542735a1bd', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(250, 'Home Page 01', NULL, 'home-page-01', '', NULL, 'publish', 38, '2025-08-14 09:06:35', '2025-08-14 13:59:24', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"home\",\"block_content\":{\"content\":[{\"slides\":[{\"background_image\":\"2025\\/08\\/14\\/slider-2-1.jpg\",\"subtitle\":\"IT Solutions Designed for Your Success\",\"title_part_1\":\"Techguru - Smart\",\"title_part_2\":\"Solutions for a\",\"title_part_3\":\"Connected world\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_1_text\":\"Get Started\",\"button_1_url\":\"\\/contact\",\"button_2_text\":\"Read More\",\"button_2_url\":\"\\/about-us\"},{\"background_image\":\"2025\\/08\\/14\\/slider-2-2.jpg\",\"subtitle\":\"IT Solutions Designed for Your Success\",\"title_part_1\":\"Techguru - Empowering\",\"title_part_2\":\"Solutions for a\",\"title_part_3\":\"Connected world\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_1_text\":\"Get Started\",\"button_1_url\":\"\\/contact\",\"button_2_text\":\"Read More\",\"button_2_url\":\"\\/about-us\"},{\"background_image\":\"2025\\/08\\/14\\/slider-2-3.jpg\",\"subtitle\":\"IT Solutions Designed for Your Success\",\"title_part_1\":\"Techguru - Grow\",\"title_part_2\":\"Solutions for a\",\"title_part_3\":\"Connected world\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_1_text\":\"Get Started\",\"button_1_url\":\"\\/contact\",\"button_2_text\":\"Read More\",\"button_2_url\":\"\\/about-us\"}],\"menu_items\":[{\"text\":\"Help\",\"url\":\"\\/about-us\"},{\"text\":\"Support\",\"url\":\"\\/contact\"},{\"text\":\"Faqs\",\"url\":\"\\/faqs\"}],\"social_title\":\"Follow Us:\",\"social_links\":[{\"icon\":\"icon-facebook\",\"url\":\"https:\\/\\/www.facebook.com\\/\"},{\"icon\":\"icon-dribble\",\"url\":\"https:\\/\\/dribbble.com\\/\"},{\"icon\":\"icon-linkedin\",\"url\":\"http:\\/\\/linkedin.com\\/\"}],\"show_trustpilot\":\"1\",\"trustpilot_image_1\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-1.jpg\",\"trustpilot_image_2\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-2.jpg\",\"trustpilot_logo\":\"2025\\/08\\/14\\/main-slider-trustpilot-logo.png\",\"trustpilot_rating\":\"5.0 Excellent\",\"trustpilot_review_text\":\"Reviews\",\"trustpilot_review_count\":\"4170\",\"show_brands\":\"1\",\"brand_logos\":[{\"image\":\"2025\\/08\\/14\\/brand-1-1.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-2.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-3.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-4.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-5.png\",\"alt\":null}],\"subtitle_icon\":\"2025\\/08\\/14\\/main-slider-sub-title-icon.png\",\"shield_check_icon\":\"2025\\/08\\/14\\/main-slider-shield-check-icon.png\",\"shape_2\":\"2025\\/08\\/14\\/main-slider-two-shape-2.png\",\"shape_3\":\"2025\\/08\\/14\\/main-slider-two-shape-3.png\",\"slider_autoplay\":\"1\",\"slider_autoplay_delay\":null,\"slider_loop\":\"1\",\"slider_pagination\":\"1\",\"slider_navigation\":\"1\",\"block\":\"hero_slider_home1\"},{\"shape_3\":\"2025\\/08\\/14\\/about-two-shape-3.png\",\"main_image\":\"2025\\/08\\/14\\/about-two-img-1.jpg\",\"secondary_image\":\"2025\\/08\\/14\\/about-two-img-2.jpg\",\"client_images\":[{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-1.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-3.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-2.jpg\",\"alt\":null}],\"client_count\":\"120\",\"client_suffix\":\"k\",\"client_text\":\"Satisfied Client\",\"section_tagline\":\"About Us\",\"title_part_1\":\"Unlock Your Business\",\"title_part_2\":\"Potential\",\"title_part_3\":\"with Our best Cutting-Edge\",\"title_part_4\":\"IT\",\"title_part_5\":\"Solutions to grow\",\"description\":\"Transform your business with our innovative IT solutions, tailored to address your unique challenges and drive growth in today\\u2019s digital landscape.\",\"features\":[{\"icon\":null,\"text\":\"Customized Solutions for \\\\\\\\ Every Business\"},{\"icon\":null,\"text\":\"Scalable Infrastructure for \\\\\\\\ Growth\"},{\"icon\":null,\"text\":\"Enhanced Security and Data \\\\\\\\ Protection\"},{\"icon\":null,\"text\":\"Continuous system \\\\\\\\ monitoring and expert \\\\\\\\ support\"}],\"experience_years\":\"25\",\"experience_text\":\"Years of \\\\\\\\ Experience\",\"call_text\":\"call us for inquiry\",\"phone_number\":\"00123456767\",\"phone_number_display\":\"+00 (123) 456767\",\"button_text\":\"Learn More\",\"button_url\":\"\\/about-us\",\"client_more_url\":\"\\/contact\",\"block\":\"about_area_home1\"},{\"bg_shape\":null,\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"Creative Plus award\"},{\"icon\":\"icon-user\",\"count\":\"300\",\"suffix\":\"+\",\"text\":\"Expert Team Members\"},{\"icon\":\"icon-chat\",\"count\":\"20\",\"suffix\":\"M\",\"text\":\"Happy Clients Review\"},{\"icon\":\"icon-folder\",\"count\":\"1.5\",\"suffix\":\"k\",\"text\":\"Project Completed\"}],\"enable_animation\":\"1\",\"block\":\"counter_area_home1\"},{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Your Business with Cutting-Edge IT\",\"section_title_2\":\"Solutions\",\"section_title_image\":\"2025\\/08\\/12\\/section-title-img.jpg\",\"section_title_3\":\"Innovative IT Services\",\"section_title_4\":\"Tailored for Your Success\",\"round_text\":\"View All Services View All Project\",\"round_icon\":\"2025\\/08\\/12\\/services-two-round-icon.png\",\"use_services_post_type\":\"1\",\"items_limit\":\"4\",\"service_ids\":null,\"enable_animation\":\"0\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"services_two_list\"},{\"shape_3\":null,\"shape_1\":null,\"shape_2\":null,\"section_tagline\":null,\"title_part_1\":null,\"title_part_2\":null,\"title_part_3\":null,\"title_part_4\":null,\"description\":null,\"progress_bars\":[{\"title\":\"Camping Launches\",\"percent\":\"86\"},{\"title\":\"Innovation Design\",\"percent\":\"76\"}],\"button_text\":\"About Us\",\"button_url\":\"\\/about-us\",\"client_image\":\"2025\\/08\\/14\\/why-choose-one-client-img.jpg\",\"client_name\":\"Thomas Alison\",\"client_position\":\"Founder & CEO\",\"main_image\":\"2025\\/08\\/14\\/why-choose-one-img-1.png\",\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"why_choose_home1\"},{\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"sliding_items\":[{\"text\":\"UI\\/UX Design\",\"hover_text\":\"UI\\/UX Design\",\"icon\":\"icon-star\"},{\"text\":\"BRANDING\",\"hover_text\":\"BRANDING\",\"icon\":\"icon-star\"},{\"text\":\"Cyber Security\",\"hover_text\":\"Cyber Security\",\"icon\":\"icon-star\"},{\"text\":\"Web Development\",\"hover_text\":\"Web Development\",\"icon\":\"icon-star\"},{\"text\":\"Product Design\",\"hover_text\":\"Product Design\",\"icon\":\"icon-star\"},{\"text\":\"Website design\",\"hover_text\":\"Website design\",\"icon\":\"icon-star\"},{\"text\":\"Digital Marketing\",\"hover_text\":\"Digital Marketing\",\"icon\":\"icon-star\"}],\"block\":\"sliding_text_home1\"},{\"bg_image\":\"2025\\/08\\/14\\/process-two-bg.jpg\",\"bg_shape\":null,\"section_tagline\":\"Working Process\",\"title_part_1\":\"Our Seamless Process\",\"title_part_2\":\"From Concept to Creation\",\"process_steps\":[{\"title\":\"Research & Discovery\",\"text\":\"We begin by understanding your needs,\\\\\\\\ goals, and vision. Through brainstorming\\\\\\\\ sessions and strategic planning,\",\"show_shape_1\":\"0\",\"shape_1\":null,\"show_shape_2\":\"0\",\"shape_2\":null},{\"title\":\"Design and Development\",\"text\":\"Once the strategy is in place, we move to \\\\\\\\\\r\\ndesigning and developing your vision. Our \\\\\\\\\\r\\nteam collaborates closely to bring your \\\\\\\\\\r\\nideas\",\"show_shape_1\":\"1\",\"shape_1\":null,\"show_shape_2\":\"1\",\"shape_2\":null},{\"title\":\"Testing and Launch\",\"text\":\"Before going live, we rigorously test to \\\\\\\\\\r\\nensure optimal functionality. After \\\\\\\\\\r\\nthorough quality checks, we launch your \\\\\\\\\\r\\nproject\",\"show_shape_1\":\"0\",\"shape_1\":null,\"show_shape_2\":\"0\",\"shape_2\":null}],\"block\":\"process_area_home1\"},{\"section_tagline\":\"Portfolio\",\"section_title_1\":\"Explore Our Creative\",\"section_title_2\":\"Journey\",\"section_title_3\":\"Crafting Success Through\",\"shape_1\":null,\"use_portfolio_post_type\":\"1\",\"items_limit\":null,\"portfolio_ids\":\"233,232,230,229\",\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"1\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items\":null,\"enable_animation\":\"1\",\"enable_magnific_popup\":\"1\",\"block\":\"portfolio_home1\"},{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"Select the Perfect\",\"section_title_2\":\"Plan for Your\",\"section_title_3\":\"Needs That Fits You\",\"tab_1_title\":\"Monthly\",\"tab_2_title\":\"Yearly\",\"tab_3_title\":\"Packages\",\"default_active_tab\":\"yearly\",\"monthly_items_limit\":null,\"monthly_pricing_ids\":null,\"yearly_items_limit\":null,\"yearly_pricing_ids\":null,\"packages_items_limit\":null,\"packages_pricing_ids\":null,\"unlimited_offer_text\":\"\\u26a1 Unlimited Offer\",\"features_title\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_two\"},{\"sliding_text_items\":[{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"},{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"}],\"bg_image\":\"2025\\/08\\/14\\/contact-two-bg.jpg\",\"shape_1\":null,\"section_tagline\":\"Get In Touch\",\"title_part_1\":\"Conversation\",\"title_part_2\":\"Reach\",\"title_part_3\":\"Out Anytime\",\"description\":\"We\'re here to listen! Whether you have\\\\\\\\ questions, feedback,   or just want to say hello, \\\\\\\\ feel free to reach out.\",\"email_title\":\"Email Us\",\"email_address\":\"info@domain.com\",\"contact_title\":\"Contact US\",\"phone_number\":\"+99 (00) 567 780\",\"address_title\":\"Our Address\",\"address\":\"629 N. Dixie Avenue, Kentucky, 42701\",\"form_name_label\":null,\"form_name_placeholder\":null,\"form_email_label\":null,\"form_email_placeholder\":null,\"form_phone_label\":null,\"form_phone_placeholder\":null,\"form_subject_label\":null,\"form_message_label\":null,\"form_message_placeholder\":null,\"submit_button_text\":null,\"enable_animation\":\"1\",\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"block\":\"contact_form_home1\"},{\"section_tagline\":\"Upcoming Events\",\"section_title_1\":\"Exciting Events\",\"section_title_2\":\"on the Horizon\",\"section_title_3\":null,\"contact_btn_text\":\"Contact Us\",\"contact_btn_url\":\"\\/contact\",\"shape_1\":null,\"shape_2\":null,\"event_image\":\"2025\\/08\\/14\\/event-one-img-1.jpg\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=qcTG5NXzuR0\",\"events\":[{\"title\":\"Innovation Meets\",\"description\":\"It is a long established fact that a reader will\",\"countdown_date\":\"2026\\/05\\/28\",\"location\":\"1629 N. Dixie Avenue\",\"date\":\"March 18, 2025\",\"book_btn_text\":\"Book Seat\",\"book_btn_url\":\"\\/contact\",\"animation_delay\":null,\"animation_direction\":\"fadeInLeft\"},{\"title\":\"Unlock Your Potential\",\"description\":\"It is a long established fact that a reader will\",\"countdown_date\":\"2026\\/08\\/28\",\"location\":\"1629 N. Dixie Avenue\",\"date\":\"March 25, 2025\",\"book_btn_text\":\"Book Seat\",\"book_btn_url\":\"\\/contact\",\"animation_delay\":null,\"animation_direction\":\"fadeInLeft\"},{\"title\":\"Tech Talks Live\",\"description\":\"It is a long established fact that a reader will\",\"countdown_date\":\"2026\\/02\\/28\",\"location\":\"1629 N. Dixie Avenue\",\"date\":\"March 30, 2025\",\"book_btn_text\":\"Book Seat\",\"book_btn_url\":\"\\/contact\",\"animation_delay\":null,\"animation_direction\":\"fadeInLeft\"}],\"enable_animation\":\"1\",\"enable_video_popup\":\"1\",\"block\":\"event_home1\"},{\"section_tagline\":\"Testimonials\",\"section_title_1\":\"Customer Experiences\",\"section_title_2\":\"That\",\"section_title_3\":\"Speak Volumes\",\"shape_1\":null,\"shape_2\":null,\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"1\",\"block\":\"testimonials_slider_home1\"},{\"section_tagline\":\"Our Blogs\",\"section_title_1\":\"Explore Our Latest\",\"section_title_2\":\"Blogs for Expert Insights\",\"section_description\":\"Dive into our collection of blogs where we share expert insights, helpful tips, and the latest trends in the industry\",\"view_all_text\":\"View All Blogs\",\"view_all_url\":\"\\/blogs\",\"read_more_text\":null,\"show_featured_post\":\"1\",\"featured_post_id\":null,\"posts_limit\":null,\"category_ids\":null,\"tag_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"block\":\"blogs_area_home1\"}]}}', '[]', 0.00, 0, 0, '8b48583d-6408-4682-8fd6-c7631736c73b', 'vi'),
(252, 'Home Page 02', NULL, 'home-page-02', '', NULL, 'publish', 5, '2025-08-14 10:35:42', '2025-08-15 08:56:11', 15, 15, 'pages', '{\"header_style\":\"header-2\",\"footer_style\":\"footer-2\",\"template\":\"home\",\"block_content\":{\"content\":[{\"slides\":[{\"subtitle\":\"IT Solutions That Work for You\",\"title_part_1\":\"Expert\",\"title_part_2\":\"IT Solutions\",\"title_part_3\":\"to Elevate\",\"title_part_4\":\"Your \\\\\\\\ Enterprise\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"slider_image\":\"2025\\/08\\/14\\/main-slider-img-1.png\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=NMC2ijeJkVQ\"},{\"subtitle\":\"IT Solutions That Work for You\",\"title_part_1\":\"Expert\",\"title_part_2\":\"IT Solutions\",\"title_part_3\":\"to Elevate\",\"title_part_4\":\"Your \\\\\\\\ Enterprise\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"slider_image\":\"2025\\/08\\/14\\/main-slider-img-2.png\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=NMC2ijeJkVQ\"},{\"subtitle\":\"IT Solutions That Work for You\",\"title_part_1\":\"Expert\",\"title_part_2\":\"IT Solutions\",\"title_part_3\":\"to Elevate\",\"title_part_4\":\"Your \\\\\\\\ Enterprise\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"slider_image\":\"2025\\/08\\/14\\/main-slider-img-1.png\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=NMC2ijeJkVQ\"}],\"shape_1\":\"2025\\/08\\/14\\/main-slider-shape-1.png\",\"shape_3\":\"2025\\/08\\/14\\/main-slider-shape-3.png\",\"shape_4\":\"2025\\/08\\/14\\/main-slider-shape-4.png\",\"shape_5\":\"2025\\/08\\/14\\/main-slider-shape-5.png\",\"subtitle_icon\":\"2025\\/08\\/14\\/main-slider-sub-title-icon.png\",\"shield_check_icon\":\"2025\\/08\\/14\\/main-slider-shield-check-icon-1.png\",\"show_trustpilot\":\"1\",\"trustpilot_image_1\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-1-1.jpg\",\"trustpilot_image_2\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-2-1.jpg\",\"trustpilot_logo\":\"2025\\/08\\/14\\/main-slider-trustpilot-logo.png\",\"trustpilot_rating\":\"5.0 Excellent\",\"trustpilot_review_text\":\"Reviews\",\"trustpilot_review_count\":\"4170\",\"slider_autoplay\":\"1\",\"slider_autoplay_delay\":null,\"slider_loop\":\"1\",\"slider_pagination\":\"1\",\"slider_navigation\":\"0\",\"block\":\"hero_slider_home2\"},{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Comprehensive, Reliable\",\"section_title_2\":\"Services\",\"section_title_3\":\"Crafted to Exceed\",\"section_title_4\":\"Your \\\\\\\\ Expectations\",\"description\":\"From personalized solutions to expert execution, we prioritize quality, reliability, and customer satisfaction in everything we do. Let us be your trusted partner in achieving success.\",\"main_image_1\":\"2025\\/08\\/14\\/servces-one-img-1.png\",\"main_image_2\":null,\"shape_1\":null,\"shape_3\":null,\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"service_area_home2\"},{\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"sliding_items\":[{\"text\":\"Digital Marketing\",\"hover_text\":\"Digital Marketing\"},{\"text\":\"Website Design\",\"hover_text\":\"Website Design\"},{\"text\":\"APP Development\",\"hover_text\":\"APP Development\"},{\"text\":\"Front end Development\",\"hover_text\":\"Front end Development\"},{\"text\":\"UI\\/UX Design\",\"hover_text\":\"UI\\/UX Design\"},{\"text\":\"Product Design\",\"hover_text\":\"Product Design\"}],\"block\":\"sliding_text_home2\"},{\"section_tagline\":\"About Us\",\"title_part_1\":\"Boost Business\",\"title_part_2\":\"with Our\",\"title_part_3\":\"Innovative IT Solutions\",\"title_part_4\":\"for Success story\",\"description\":\"Innovating and empowering businesses with tailored solutions for success and growth.\",\"features\":[{\"icon\":null,\"title\":\"Shaping Tomorrow, Transforming Today\",\"text\":\"Empowering businesses to create meaningful change, driving innovation\"},{\"icon\":null,\"title\":\"Innovating Today, Empowering Tomorrow\",\"text\":\"Partner with us to unlock new possibilities, drive progress, and shape a future filled with success\"}],\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"call_text\":\"Call Any Time\",\"phone_number\":\"1234567 8900\",\"phone_number_display\":\"(123) 4567 8900\",\"main_image\":\"2025\\/08\\/14\\/about-one-img-1.jpg\",\"block\":\"about_area_home2\"},{\"bg_shape\":null,\"section_tagline\":\"The Numbers Speak\",\"title_part_1\":\"Exploring Business Growth\",\"title_part_2\":\"In IT\",\"title_part_3\":\"Consulting Solutions\",\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"award Winning\",\"animation_delay\":null},{\"icon\":\"icon-user\",\"count\":\"99\",\"suffix\":\"%\",\"text\":\"Satisfied client\",\"animation_delay\":null},{\"icon\":\"icon-chat\",\"count\":\"10\",\"suffix\":\"M\",\"text\":\"worldwide reviews\",\"animation_delay\":null},{\"icon\":\"icon-laughing\",\"count\":\"200\",\"suffix\":\"+\",\"text\":\"Happy Clients\",\"animation_delay\":null}],\"enable_animation\":\"1\",\"block\":\"counter_area_home2\"},{\"section_tagline\":\"See Our Works\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered\",\"section_title_3\":\"Businesses with Innovative\",\"section_title_4\":\"Tech Solutions\",\"big_text\":\"portfolio\",\"shape_1\":null,\"shape_2\":null,\"round_text\":\"View All Project View All Project\",\"round_icon\":null,\"all_projects_url\":\"\\/portfolios\",\"use_portfolio_post_type\":\"1\",\"items_limit\":null,\"portfolio_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":\"4\",\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"1\",\"enable_magnific_popup\":\"1\",\"block\":\"portfolio_home2\"},{\"shape_1\":\"2025\\/08\\/12\\/process-one-shape-1.png\",\"bg_shape\":null,\"section_tagline\":\"Working Process\",\"title_part_1\":\"How We\'ve\",\"title_part_2\":\"Empowered\",\"title_part_3\":\"Businesses with Innovative\",\"title_part_4\":\"Tech Solutions\",\"description\":\"From personalized solutions to expert \\\\\\\\ execution, we prioritize quality, reliability, and \\\\\\\\ customer satisfaction\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"process_steps\":[{\"title\":\"Discovery & Strategy\",\"text\":\"We analyze your business needs, \\\\\\\\ identify challenges, and craft a \\\\\\\\ strategic roadmap for the best IT \\\\\\\\ solutions.\",\"count_left\":\"1\"},{\"title\":\"Development\",\"text\":\"Our expert team designs, develops, \\\\\\\\ and integrates cutting-edge \\\\\\\\ technology tailored to your goals.\",\"count_left\":\"0\"},{\"title\":\"Optimization & Support\",\"text\":\"We ensure seamless performance with \\\\\\\\ continuous improvements, \\\\\\\\ maintenance, and dedicated support.\",\"count_left\":\"1\"}],\"block\":\"process_area_home2\"},{\"form_title\":\"How Can We Help You?\",\"name_label\":\"Full Name\",\"name_placeholder\":\"Thomas Alison\",\"email_label\":\"Email Address\",\"email_placeholder\":\"thomas@domain.com\",\"phone_label\":\"Phone Number\",\"phone_placeholder\":\"+12 (00) 123 4567 890\",\"subject_label\":\"Subject\",\"message_label\":\"Inquiry about\",\"message_placeholder\":\"Write your message\",\"submit_button_text\":\"Submit Now\",\"section_tagline\":\"Get In Touch\",\"section_title_line1\":\"Start the Conversation\",\"section_title_line2\":\"Reach Out Anytime\",\"section_description\":\"We\'re here to listen! Whether you have questions, \\\\\\\\ feedback, or just want to say hello, feel free to reach out.\",\"location_title\":\"Location\",\"location_address\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"email_title\":\"Email Us\",\"email_address1\":\"info@domain.com\",\"email_address2\":\"support@domain.com\",\"contact_title\":\"Contact\",\"tel_number\":\"+12 (00) 456 7890 00\",\"mobile_number\":\"+99 (00) 567 780\",\"bg_shape\":\"2025\\/08\\/12\\/contact-one-bg-shape.png\",\"enable_animation\":\"1\",\"block\":\"contact_form\"},{\"section_title\":\"Innovative Tech Solutions\",\"section_subtitle\":\"Our Team Member\",\"show_section_title\":\"1\",\"use_teams_post_type\":\"1\",\"items_per_page\":null,\"carousel_class\":null,\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_margin\":null,\"block\":\"teams_carousel\"},{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered Businesses\",\"section_title_3\":\"with Innovative\",\"section_title_4\":\"Tech Solutions\",\"use_pricing_post_type\":\"1\",\"items_limit\":null,\"pricing_ids\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_page\"},{\"background_image\":\"2025\\/08\\/14\\/testimonial-one-bg-1.jpg\",\"shape_1\":null,\"shape_2\":null,\"section_tagline\":\"Client Testimonial\",\"section_title_1\":\"What Our Clients\",\"section_title_2\":\"\\u2013 Say\",\"section_title_3\":\"About Us\",\"use_testimonials_post_type\":\"0\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"custom_testimonials\":[{\"client_image\":\"2025\\/08\\/14\\/testimonial-1-1.jpg\",\"title\":\"!Great Agency It Agency\",\"testimonial_text\":\"\\u201cFrom the initial consultation to the final product, every step was handled with professionalism and care. The final\\r\\n result exceeded our expectations and has significantly improved our  operations\\\"\",\"client_position\":\"Marketing Manager\",\"client_name\":\"Sarah James\",\"testimonial_url\":\"\\/contact\",\"trustpilot_logo\":\"2025\\/08\\/14\\/trustpilot-logo.png\",\"trustpilot_text\":\"5.0 Excellent\",\"star_icon\":null,\"star_count\":\"4\"},{\"client_image\":\"2025\\/08\\/14\\/testimonial-1-2.jpg\",\"title\":\"!Great Agency It Agency\",\"testimonial_text\":\"\\u201cFrom the initial consultation to the final product, every step was handled with professionalism and care. The final\\r\\n result exceeded our expectations and has significantly improved our  operations\\\"\",\"client_position\":\"Marketing Manager\",\"client_name\":\"Sarah James\",\"testimonial_url\":\"\\/contact\",\"trustpilot_logo\":\"2025\\/08\\/14\\/trustpilot-logo.png\",\"trustpilot_text\":\"5.0 Excellent\",\"star_icon\":null,\"star_count\":\"5\"},{\"client_image\":\"2025\\/08\\/14\\/testimonial-1-3.jpg\",\"title\":\"!Great Agency It Agency\",\"testimonial_text\":\"\\u201cFrom the initial consultation to the final product, every step was handled with professionalism and care. The final\\r\\n result exceeded our expectations and has significantly improved our  operations\\\"\",\"client_position\":\"Marketing Manager\",\"client_name\":\"Sarah James\",\"testimonial_url\":\"\\/contact\",\"trustpilot_logo\":\"2025\\/08\\/14\\/trustpilot-logo.png\",\"trustpilot_text\":\"5.0 Excellent\",\"star_icon\":null,\"star_count\":\"3\"}],\"clients_count_text\":\"12K Trusted by clients worldwide\",\"client_images\":[{\"image\":\"2025\\/08\\/14\\/brand-one-img-1-1.jpg\",\"alt_text\":null},{\"image\":\"2025\\/08\\/14\\/brand-one-img-1-2.jpg\",\"alt_text\":null}],\"brand_logos\":[{\"logo\":\"2025\\/08\\/14\\/brand-1-1.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-2.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-3.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-4.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-5.png\",\"alt_text\":null}],\"testimonial_carousel_loop\":\"1\",\"testimonial_carousel_nav\":\"0\",\"testimonial_carousel_dots\":\"1\",\"testimonial_carousel_autoplay\":\"1\",\"testimonial_carousel_autoplay_timeout\":null,\"testimonial_carousel_items\":null,\"brand_carousel_loop\":\"1\",\"brand_carousel_nav\":\"1\",\"brand_carousel_dots\":\"1\",\"brand_carousel_autoplay\":\"1\",\"brand_carousel_autoplay_timeout\":null,\"brand_carousel_items\":null,\"brand_carousel_items_tablet\":null,\"brand_carousel_items_mobile\":null,\"enable_animation\":\"1\",\"block\":\"testimonials_slider_home2\"},{\"shape_bg\":null,\"shape_1\":null,\"newsletter_image\":null,\"title_part1\":\"Subscribe\",\"title_part2\":\"Newsletter\",\"description_line1\":\"From personalized solutions to expert execution, we prioritize quality,\",\"description_line2\":\"reliability, and customer satisfaction\",\"placeholder\":\"Enter email address\",\"button_text\":\"Subscribe Now\",\"show_success_message\":\"1\",\"show_error_message\":\"1\",\"block\":\"newsletter_home2\"},{\"section_tagline\":null,\"section_title_1\":null,\"section_title_2\":null,\"section_title_3\":null,\"section_title_4\":null,\"read_more_text\":null,\"posts_limit\":\"6\",\"category_ids\":null,\"tag_ids\":null,\"orderby\":\"date\",\"order\":\"ASC\",\"enable_animation\":\"1\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"1\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":\"3\",\"carousel_items_large\":\"3\",\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"block\":\"blogs_area_home2\"}]}}', '[]', 0.00, 0, 0, 'be9f3fdb-1c79-412b-9ca1-f8de9be605b8', 'vi'),
(253, 'Home Page 03', NULL, 'home-page-03', '', NULL, 'publish', 2, '2025-08-14 13:21:22', '2025-08-14 13:59:29', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"home\",\"block_content\":{\"content\":[{\"background_image\":\"2025\\/08\\/14\\/banner-one-bg.jpg\",\"shape_bg\":\"2025\\/08\\/14\\/banner-one-shape-bg.png\",\"title_part_1\":\"Expert IT Solutions to Elevate\",\"title_part_2\":\"Your Enterprise\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"banner_image\":\"2025\\/08\\/14\\/banner-one-img-1.jpg\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=VEQd-jmVs44\",\"show_video_button\":\"1\",\"block\":\"hero_banner_home3\"},{\"main_image\":\"2025\\/08\\/14\\/about-three-img-1.png\",\"section_tagline\":\"About Us\",\"title_part_1\":\"Any IT Problem Solutions And\",\"title_part_2\":\"Grow Your Business\",\"description\":\"Transform your business with our innovative IT solutions, tailored to address your unique challenges and drive growth.\",\"progress_bars\":[{\"title\":\"Business Problem Solving\",\"percent\":\"70\"},{\"title\":\"Camping Launches\",\"percent\":\"80\"}],\"features\":[{\"icon\":null,\"title\":\"Shaping Tomorrow, Transforming Today\"},{\"icon\":null,\"title\":\"Innovating Today, Empowering Tomorrow\"}],\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"call_text\":\"Call Any Time\",\"phone_number\":\"1234567 8900\",\"phone_number_display\":\"(123) 4567 8900\",\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"about_area_home3\"},{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Reliable Services\",\"section_title_2\":\"Crafted\",\"section_title_3\":\"to Exceed\",\"section_title_4\":\"Your Expectations\",\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"enable_animation\":\"1\",\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_margin\":null,\"block\":\"service_slider_home3\"},{\"shape_1\":null,\"section_tagline\":\"Why Chooses Us\",\"title_part_1\":\"Elevate Growth with Our IT Solutions\",\"title_part_2\":\"for Success\",\"description\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\",\"main_image\":\"2025\\/08\\/14\\/why-choose-two-img-1.png\",\"features\":[{\"icon\":\"icon-earning\",\"title\":\"Industry Experience\",\"text\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\"},{\"icon\":\"icon-customer-service-headset\",\"title\":\"24\\/7 Customer Support\",\"text\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\"},{\"icon\":\"icon-quality\",\"title\":\"Trust & Reliability\",\"text\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\"}],\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"why_choose_home3\"},{\"shape_1\":null,\"shape_2\":null,\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"block\":\"service_features_part1_home3\"},{\"background_shape\":\"2025\\/08\\/14\\/cta-one-shape-bg.png\",\"title_line1\":\"To make requests for further\",\"title_line2\":\"information, contact us\",\"contact_text\":\"Call Us For Any inquiry\",\"phone_number\":\"+99 (00) 567 780\",\"phone_number_clean\":\"+9900567780\",\"block\":\"cta_home3\"},{\"section_tagline\":\"Testimonials\",\"section_title_1\":\"Customer Experiences\",\"section_title_2\":\"That\",\"section_title_3\":\"Speak Volumes\",\"shape_1\":null,\"shape_2\":null,\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"0\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"0\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"0\",\"block\":\"testimonials_slider_home1\"},{\"bg_shape\":null,\"section_tagline\":\"The Numbers Speak\",\"title_part_1\":\"Exploring Business Growth\",\"title_part_2\":\"In IT\",\"title_part_3\":\"Consulting Solutions\",\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"award Winning\",\"animation_delay\":null},{\"icon\":\"icon-user\",\"count\":\"99\",\"suffix\":\"%\",\"text\":\"Satisfied client\",\"animation_delay\":null},{\"icon\":\"icon-chat\",\"count\":\"10\",\"suffix\":\"M\",\"text\":\"worldwide reviews\",\"animation_delay\":null},{\"icon\":\"icon-laughing\",\"count\":\"200\",\"suffix\":\"+\",\"text\":\"Happy Clients\",\"animation_delay\":null}],\"enable_animation\":\"1\",\"block\":\"counter_area_home2\"},{\"section_tagline\":\"See Our Works\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered\",\"section_title_3\":\"Businesses with Innovative\",\"section_title_4\":\"Tech Solutions\",\"big_text\":\"portfolio\",\"shape_1\":null,\"shape_2\":null,\"round_text\":\"View All Project View All Project\",\"round_icon\":null,\"all_projects_url\":\"\\/portfolios\",\"use_portfolio_post_type\":\"1\",\"items_limit\":null,\"portfolio_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":\"4\",\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"1\",\"enable_magnific_popup\":\"1\",\"block\":\"portfolio_home2\"},{\"section_tagline\":\"Our Faqs\",\"section_title_1\":\"Your Questions Answered\",\"section_title_2\":\"Explore Our FAQs\",\"faq_image\":\"2025\\/08\\/14\\/faq-one-img-1.jpg\",\"experience_count\":\"55\",\"experience_text_line1\":\"Year of\",\"experience_text_line2\":\"experience\",\"use_faqs_post_type\":\"1\",\"items_limit\":null,\"faq_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"enable_odometer\":\"1\",\"block\":\"faq_home3\"},{\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"enable_animation\":\"1\",\"block\":\"service_features_home3\"},{\"section_tagline\":\"Our Blogs\",\"section_title_1\":\"Explore Our Latest\",\"section_title_2\":\"Blogs for Expert Insights\",\"section_description\":\"Dive into our collection of blogs where we share expert insights, helpful tips, and the latest trends in the industry\",\"view_all_text\":\"View All Blogs\",\"view_all_url\":\"\\/blogs\",\"read_more_text\":null,\"show_featured_post\":\"1\",\"featured_post_id\":null,\"posts_limit\":null,\"category_ids\":null,\"tag_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"block\":\"blogs_area_home1\"},{\"sliding_text_items\":[{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"},{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"}],\"bg_image\":\"2025\\/08\\/14\\/contact-two-bg.jpg\",\"shape_1\":null,\"section_tagline\":\"Get In Touch\",\"title_part_1\":\"Conversation\",\"title_part_2\":\"Reach\",\"title_part_3\":\"Out Anytime\",\"description\":\"We\'re here to listen! Whether you have\\\\\\\\ questions, feedback,   or just want to say hello, \\\\\\\\ feel free to reach out.\",\"email_title\":\"Email Us\",\"email_address\":\"info@domain.com\",\"contact_title\":\"Contact US\",\"phone_number\":\"+99 (00) 567 780\",\"address_title\":\"Our Address\",\"address\":\"629 N. Dixie Avenue, Kentucky, 42701\",\"form_name_label\":null,\"form_name_placeholder\":null,\"form_email_label\":null,\"form_email_placeholder\":null,\"form_phone_label\":null,\"form_phone_placeholder\":null,\"form_subject_label\":null,\"form_message_label\":null,\"form_message_placeholder\":null,\"submit_button_text\":null,\"enable_animation\":\"1\",\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"block\":\"contact_form_home1\"}]}}', '[]', 0.00, 0, 0, 'b518b560-5b87-4b44-8179-97e2af42ba87', 'vi'),
(254, 'Products', NULL, 'products', '', NULL, 'publish', 6, '2025-08-14 14:15:31', '2025-08-14 14:15:31', 15, 15, 'pages', '{\"header_style\":\"header-1\",\"footer_style\":\"footer-1\",\"template\":\"products\"}', '[]', 0.00, 0, 0, '9e504e71-dc43-4d27-80bd-1b0aa6bee12b', 'vi'),
(255, 'Rendering metallic ai', '2025/08/14/shop-product-1-1.png', 'rendering-metallic-ai', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 5, '2025-08-14 14:26:41', '2025-08-15 09:20:01', 15, 15, 'products', '{\"price\":33,\"sku_code\":\"1312312312\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":32,\"barcode\":\"1231212321\",\"disable_out_of_stock\":\"1\",\"badge\":\"new\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":66,\"name\":\"A Tradition of Healing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"a-tradition-of-healing\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/a-tradition-of-healing\"},{\"id\":67,\"name\":\"Development\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"development-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/development-1\"}]', 0.00, 0, 2, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84a', 'vi'),
(256, '3d render robo', '2025/08/14/shop-product-1-4.png', 'rendering-metallic-ai-1', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 4, '2025-08-14 14:26:41', '2025-08-14 17:04:57', 15, 15, 'products', '{\"price\":320,\"sku_code\":\"1221\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":340,\"barcode\":\"1321\",\"disable_out_of_stock\":\"1\",\"badge\":\"new\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":72,\"name\":\"Where Health Matters\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"where-health-matters\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/where-health-matters\"},{\"id\":73,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 1, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84b', 'vi'),
(257, 'motorcycle helme', '2025/08/14/shop-product-1-1.png', 'rendering-metallic-ai-2', ' I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 5, '2025-08-14 14:26:41', '2025-08-15 09:16:59', 15, 15, 'products', '{\"price\":33,\"sku_code\":\"1312312312\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":32,\"barcode\":\"1231212321\",\"disable_out_of_stock\":\"1\",\"badge\":\"new\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":66,\"name\":\"A Tradition of Healing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"a-tradition-of-healing\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/a-tradition-of-healing\"},{\"id\":67,\"name\":\"Development\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"development-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/development-1\"}]', 0.00, 0, 0, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84c', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(258, 'robot gesturing', '2025/08/14/shop-product-1-2.png', 'rendering-metallic-ai-3', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 5, '2025-08-14 14:26:41', '2025-08-15 09:20:01', 15, 15, 'products', '{\"price\":540,\"sku_code\":\"13213\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":430,\"barcode\":\"132312\",\"disable_out_of_stock\":\"1\",\"badge\":\"best\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":74,\"name\":\"Environtment Recyle\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"environtment-recyle\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/environtment-recyle\"},{\"id\":75,\"name\":\"Innovation\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"innovation-3\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/innovation-3\"}]', 0.00, 0, 1, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84d', 'vi'),
(259, 'ski helmet with visor', '2025/08/14/shop-product-1-5.png', 'rendering-metallic-ai-4', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 4, '2025-08-14 14:26:41', '2025-08-14 16:21:43', 15, 15, 'products', '{\"price\":460,\"sku_code\":\"13131\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":332,\"barcode\":\"2312312\",\"disable_out_of_stock\":\"1\",\"badge\":\"hot\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":73,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing-1\"},{\"id\":74,\"name\":\"Environtment Recyle\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"environtment-recyle\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/environtment-recyle\"}]', 0.00, 0, 0, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84e', 'vi'),
(260, 'snowboard boot', '2025/08/14/shop-product-1-6.png', 'rendering-metallic-ai-5', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 5, '2025-08-14 14:26:41', '2025-08-15 09:20:01', 15, 15, 'products', '{\"price\":760,\"sku_code\":\"123123\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":500,\"barcode\":\"qweqwe\",\"disable_out_of_stock\":\"1\",\"badge\":\"top\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":69,\"name\":\"Compassionate Care\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"compassionate-care\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/compassionate-care\"},{\"id\":73,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 2, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84f', 'vi'),
(261, 'rendering metallic ai', '2025/08/14/shop-product-1-1.png', 'rendering-metallic-ai-6', ' I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 4, '2025-08-14 14:26:41', '2025-08-14 15:09:27', 15, 15, 'products', '{\"price\":33,\"sku_code\":\"1312312312\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":32,\"barcode\":\"1231212321\",\"disable_out_of_stock\":\"1\",\"badge\":\"new\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":66,\"name\":\"A Tradition of Healing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"a-tradition-of-healing\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/a-tradition-of-healing\"},{\"id\":67,\"name\":\"Development\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"development-1\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/development-1\"}]', 0.00, 0, 0, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84g', 'vi'),
(262, '3d render robot', '2025/08/14/shop-product-1-2.png', 'rendering-metallic-ai-7', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 4, '2025-08-14 14:26:41', '2025-08-14 16:24:39', 15, 15, 'products', '{\"price\":110,\"sku_code\":\"123123\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":213,\"barcode\":\"123123\",\"disable_out_of_stock\":\"1\",\"badge\":\"sale\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":66,\"name\":\"A Tradition of Healing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"a-tradition-of-healing\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/a-tradition-of-healing\"},{\"id\":73,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 0, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84h', 'vi'),
(264, 'motorcycle helmet', '2025/08/14/shop-product-1-3.png', 'rendering-metallic-ai-8', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 5, '2025-08-14 14:26:41', '2025-08-15 09:20:01', 15, 15, 'products', '{\"price\":213,\"sku_code\":\"123123\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":234,\"barcode\":\"21312\",\"disable_out_of_stock\":\"1\",\"badge\":\"new\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":70,\"name\":\"Caring for You, Always\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"caring-for-you-always\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/caring-for-you-always\"},{\"id\":73,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":\"0\",\"total_post\":\"5\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 3, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84i', 'vi'),
(265, 'robot gesturing', '2025/08/14/shop-product-1-4.png', 'rendering-metallic-ai-9', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 4, '2025-08-14 14:26:41', '2025-08-14 16:26:17', 15, 15, 'products', '{\"price\":320,\"sku_code\":\"1312312\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":430,\"barcode\":\"123123\",\"disable_out_of_stock\":\"1\",\"badge\":\"top\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":66,\"name\":\"A Tradition of Healing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"a-tradition-of-healing\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/a-tradition-of-healing\"},{\"id\":69,\"name\":\"Compassionate Care\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"compassionate-care\",\"level\":\"0\",\"total_post\":\"3\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/compassionate-care\"},{\"id\":73,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":\"0\",\"total_post\":\"6\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 0, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84j', 'vi'),
(266, 'ski helmet with visor', '2025/08/14/shop-product-1-5.png', 'rendering-metallic-ai-10', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 5, '2025-08-14 14:26:41', '2025-08-15 09:20:01', 15, 15, 'products', '{\"price\":300,\"sku_code\":\"312312\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":340,\"barcode\":\"12312\",\"disable_out_of_stock\":\"1\",\"badge\":\"sale\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":70,\"name\":\"Caring for You, Always\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"caring-for-you-always\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/caring-for-you-always\"},{\"id\":71,\"name\":\"Analytics\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"analytics-2\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/analytics-2\"}]', 0.00, 0, 2, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84k', 'vi'),
(267, 'snowboard boot', '2025/08/14/shop-product-1-6.png', 'rendering-metallic-ai-11', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 4, '2025-08-14 14:26:41', '2025-08-14 16:14:28', 15, 15, 'products', '{\"price\":50,\"sku_code\":\"132312\",\"inventory_management\":\"1\",\"quantity\":300,\"compare_price\":40,\"barcode\":\"12312\",\"disable_out_of_stock\":\"1\",\"badge\":\"new\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"],\"downloadable\":0}', '[{\"id\":68,\"name\":\"Innovation\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"innovation-2\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/innovation-2\"},{\"id\":69,\"name\":\"Compassionate Care\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"compassionate-care\",\"level\":\"0\",\"total_post\":\"1\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/compassionate-care\"}]', 0.00, 0, 0, '82dd34a4-b1ca-4361-ad6e-0d2908bfc84l', 'vi'),
(268, 'snowboard boot William', '2025/08/14/shop-product-1-2-1.png', 'snowboard-boot-william', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings...', '<div class=\"product-details__description-content\">\r\n<p class=\"product-details__description-text-1\">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>\r\n<div class=\"product-description__list\">\r\n<ul class=\"list-unstyled\">\r\n<li>\r\n<p class=\"icon-right-arrow\">Nam at elit nec neque suscipit gravida.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Aenean egestas orci eu maximus tincidunt.</p>\r\n</li>\r\n<li>\r\n<p class=\"icon-right-arrow\">Curabitur vel turpis id tellus cursus laoreet.</p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p class=\"product-details__description-text-2\">Quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo&nbsp;</p>\r\n</div>', 'publish', 2, '2025-08-14 17:17:56', '2025-08-15 09:16:17', 54, 54, 'products', '{\"price\":300,\"sku_code\":\"123123\",\"inventory_management\":\"1\",\"quantity\":345,\"compare_price\":340,\"barcode\":\"122321\",\"disable_out_of_stock\":\"1\",\"badge\":\"hot\",\"additional_information\":\"Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\\r\\n\\r\\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo\",\"short_description\":\"The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.\",\"images\":[\"2025\\/08\\/14\\/product-details-img-1-1.png\",\"2025\\/08\\/14\\/product-details-img-2-1.png\",\"2025\\/08\\/14\\/product-details-img-3-1.png\"],\"downloadable\":0,\"vendor_id\":54}', '[{\"id\":66,\"name\":\"A Tradition of Healing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"a-tradition-of-healing\",\"level\":\"0\",\"total_post\":\"4\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/category\\/a-tradition-of-healing\"},{\"id\":71,\"name\":\"Analytics\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"analytics-2\",\"level\":\"0\",\"total_post\":\"2\",\"thumbnail\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/mc-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/techguru-laravel.mojarsoft.com\\/tag\\/analytics-2\"}]', 0.00, 0, 1, '3cdef5b6-5033-4349-89a7-fb24987f6556', 'vi');

-- --------------------------------------------------------

--
-- Table structure for table `app_post_likes`
--

CREATE TABLE `app_post_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_post_metas`
--

CREATE TABLE `app_post_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_post_metas`
--

INSERT INTO `app_post_metas` (`id`, `post_id`, `meta_key`, `meta_value`) VALUES
(38, 17, 'template', NULL),
(39, 18, 'template', NULL),
(91, 22, 'template', 'contact'),
(92, 22, 'block_content', '{\"content\":[{\"form_title\":\"How Can We Help You?\",\"name_label\":\"Full Name\",\"name_placeholder\":\"Thomas Alison\",\"email_label\":\"Email Address\",\"email_placeholder\":\"thomas@domain.com\",\"phone_label\":\"Phone Number\",\"phone_placeholder\":\"+12 (00) 123 4567 890\",\"subject_label\":\"Subject\",\"message_label\":\"Inquiry about\",\"message_placeholder\":\"Write your message\",\"submit_button_text\":\"Submit Now\",\"section_tagline\":\"Get In Touch\",\"section_title_line1\":\"Start the Conversation\",\"section_title_line2\":\"Reach Out Anytime\",\"section_description\":\"We\'re here to listen! Whether you have questions, \\/\\/ feedback, or just want to say hello, feel free to reach out.\",\"location_title\":\"Location\",\"location_address\":\"1629 N. Dixie Avenue, \\/\\/ Kentucky, 42701\",\"email_title\":\"Email Us\",\"email_address1\":\"info@domain.com\",\"email_address2\":\"support@domain.com\",\"contact_title\":\"Contact\",\"tel_number\":\"+12 (00) 456 7890 00\",\"mobile_number\":\"+99 (00) 567 780\",\"bg_shape\":\"2025\\/08\\/12\\/contact-one-bg-shape.png\",\"enable_animation\":\"1\",\"block\":\"contact_form\"},{\"section_tagline\":\"FAQS\",\"section_title\":\"Frequently Asked\",\"section_title_span\":\"Questions\",\"section_description\":\"Get answers to the most common questions \\\\\\\\\\r\\nabout our products, services, and policies.\",\"support_label\":\"Get Support\",\"support_phone\":\"99 (00) 567 780\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"faq_items\":[{\"question\":\"What services does your IT consultancy agency provide?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"0\"},{\"question\":\"How can IT consulting benefit my business?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"1\"},{\"question\":\"Do you offer customized IT solutions?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"0\"},{\"question\":\"How do you ensure data security and compliance?\",\"answer_part1\":\"We offer a wide range of IT consulting services, including software development, cloud computing solutions, cybersecurity, IT infrastructure management, and digital transformation strategies tailored to your business needs.\",\"answer_part2\":\"Our IT consulting services help businesses improve efficiency, enhance security, reduce operational costs, and stay ahead of technology trends. We provide expert guidance to optimize your IT infrastructure and implement innovative solutions.\",\"is_active\":\"0\"}],\"shape_1\":\"2025\\/08\\/12\\/faq-two-shape-1.png\",\"shape_2\":\"2025\\/08\\/12\\/faq-two-shape-2.png\",\"enable_animation\":\"1\",\"block\":\"faq_contact\"},{\"map_url\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3651.227879477866!2d90.34898411538501!3d23.774898293755943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1e1938cc90b%3A0xbcfacb6b89117685!2sZakirsoft%20-%20Innovative%20Software%20%26%20Web%20Development%20Solutions!5e0!3m2!1sen!2sbd!4v1641634410288!5m2!1sen!2sbd\",\"map_width\":null,\"map_height\":null,\"map_class\":null,\"map_allowfullscreen\":\"1\",\"map_border\":\"1\",\"map_border_width\":null,\"map_border_color\":null,\"map_border_style\":null,\"block\":\"google_map_contact\"}]}'),
(294, 133, 'template', NULL),
(431, 151, 'template', 'about'),
(432, 151, 'block_content', '{\"content\":[{\"bg_shape\":null,\"bg_shape_2\":null,\"main_image\":null,\"secondary_image\":null,\"experience_years\":null,\"experience_text\":null,\"client_images\":[{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-2.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-3.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-1.jpg\",\"alt\":null}],\"client_count\":null,\"client_suffix\":null,\"client_text\":null,\"client_more_url\":null,\"section_tagline\":\"About Us\",\"title_part_1\":\"Supercharge\",\"title_part_2\":\"Your Business\",\"title_part_3\":\"Growth with Our\",\"title_part_4\":\"Cutting-Edge IT\",\"title_part_5\":\"Solutions\",\"description\":\"Transform your business with our innovative IT solutions, tailored to address your unique challenges and drive growth in today\\u2019s digital landscape.\",\"features_left\":[{\"icon\":\"icon-tick-inside-circle\",\"text\":\"Innovative IT Solutions Expert \\\\\\\\\\r\\nSupport & Consulting\"},{\"icon\":\"icon-tick-inside-circle\",\"text\":\"Cloud Solutions for Modern \\\\\\\\\\r\\nEnterprises\"}],\"features_right\":[{\"icon\":\"icon-tick-inside-circle\",\"text\":\"Seamless Digital \\\\\\\\\\r\\nTransformation AI-Driven \\\\\\\\\\r\\nBusiness Automation\"}],\"founder_image\":null,\"founder_name\":null,\"founder_position\":null,\"bottom_features\":[{\"icon\":\"icon-technical-support\",\"title\":\"Innovative IT Solutions\",\"text\":\"Stay ahead with cutting-edge technology tailored to \\\\\\\\ \\r\\nyour business needs.\"},{\"icon\":\"icon-real-estate-agency\",\"title\":\"Cloud Solutions\",\"text\":\"Secure, scalable, and efficient cloud services to power \\\\\\\\\\r\\nyour growth. Cloud Solutions for Modern Enterprises\"}],\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"about_area_aboutus\"},{\"bg_shape\":null,\"section_tagline\":\"Why Choose Us\",\"title_part_1\":\"Your Business with\",\"title_part_2\":\"Reliable &\",\"title_part_3\":\"Future-Ready\",\"title_part_4\":\"IT Solutions\",\"main_image\":\"2025\\/08\\/14\\/why-choose-three-img.jpg\",\"left_features\":[{\"icon\":\"icon-quality\",\"title\":\"Unmatched Quality\",\"text\":\"We deliver exceptional products and services that  exceed  expectations every time.\"},{\"icon\":\"icon-team\",\"title\":\"Trusted Expertise\",\"text\":\"Backed by years of experience and a proven track record, we are your reliable partner for success.\"}],\"right_features\":[{\"icon\":\"icon-customer-centricity\",\"title\":\"User-Centric Approach\",\"text\":\"Your satisfaction is our priority, and we tailor solutions to meet your unique needs. Your happiness comes first.\"},{\"icon\":\"icon-support\",\"title\":\"Trusted by Many\",\"text\":\"We have built a strong reputation over the years by consistently delivering excellent results.\"}],\"enable_animation\":\"1\",\"left_animation_delay\":null,\"center_animation_delay\":null,\"right_animation_delay\":null,\"block\":\"why_choose_aboutus\"},{\"bg_shape\":null,\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"Creative Plus award\"},{\"icon\":\"icon-user\",\"count\":\"300\",\"suffix\":\"+\",\"text\":\"Expert Team Members\"},{\"icon\":\"icon-chat\",\"count\":\"20\",\"suffix\":\"M\",\"text\":\"Happy Clients Review\"},{\"icon\":\"icon-folder\",\"count\":\"1.5\",\"suffix\":\"k\",\"text\":\"Project Completed\"}],\"enable_animation\":\"1\",\"block\":\"counter_area_home1\"},{\"section_tagline\":\"Our Members\",\"section_title_1\":\"Meet Our Team.\",\"section_title_2\":\"Get to\",\"section_title_3\":\"Know the Talented\",\"section_title_4\":\"Minds Behind Our Team\",\"description\":\"Our dedicated team combines expertise, \\\\\\\\\\r\\ncreativity, and passion to deliver exceptional \\\\\\\\\\r\\nresults and ensure your satisfaction every step \\\\\\\\\\r\\nof the way.\",\"background_shape\":\"2025\\/08\\/14\\/team-two-bg-shape.png\",\"use_teams_post_type\":\"0\",\"items_limit\":null,\"team_members_ids\":null,\"team_members\":[{\"image\":\"2025\\/08\\/14\\/team-2-1.jpg\",\"name\":\"Sophia Bennett\",\"position\":\"CEO & Founder\",\"url\":\"\\/team\\/mitchell-marsh\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"dribbble\":\"https:\\/\\/dribbble.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\"},{\"image\":\"2025\\/08\\/14\\/team-2-2.jpg\",\"name\":\"Liam Johnson\",\"position\":\"Operations Manager\",\"url\":\"\\/team\\/mitchell-marsh\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"dribbble\":\"https:\\/\\/dribbble.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\"},{\"image\":\"2025\\/08\\/14\\/team-2-3.jpg\",\"name\":\"Ethan Miller\",\"position\":\"Lead Designer\",\"url\":\"\\/team\\/mitchell-marsh\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"dribbble\":\"https:\\/\\/dribbble.com\\/\",\"linkedin\":\"http:\\/\\/linkedin.com\\/\"}],\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"block\":\"teams_about\"},{\"shape_1\":\"2025\\/08\\/12\\/process-one-shape-1.png\",\"bg_shape\":null,\"section_tagline\":\"Working Process\",\"title_part_1\":\"How We\'ve\",\"title_part_2\":\"Empowered\",\"title_part_3\":\"Businesses with Innovative\",\"title_part_4\":\"Tech Solutions\",\"description\":\"From personalized solutions to expert \\\\\\\\ execution, we prioritize\\r\\n                                quality, reliability, and \\\\\\\\ customer satisfaction\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"process_steps\":[{\"title\":\"Discovery & Strategy\",\"text\":\"We analyze your business needs, \\\\\\\\ identify challenges, and craft a \\\\\\\\ strategic roadmap for the best IT \\\\\\\\ solutions.\",\"count_left\":\"1\"},{\"title\":\"Development\",\"text\":\"Our expert team designs, develops, \\\\\\\\ and integrates cutting-edge \\\\\\\\ technology tailored to your goals.\",\"count_left\":\"0\"},{\"title\":\"Optimization & Support\",\"text\":\"We ensure seamless performance with \\\\\\\\ continuous improvements, \\\\\\\\ maintenance, and dedicated support.\",\"count_left\":\"1\"}],\"block\":\"process_area_home2\"},{\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_class\":null,\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"testimonials_carousel\"}]}'),
(433, 152, 'template', NULL),
(531, 170, 'template', 'team'),
(532, 170, 'block_content', '{\"content\":[{\"subtitle\":\"Team Member\",\"title\":\"Meet Our Great Team\",\"background_image\":null,\"use_team_post_type\":\"1\",\"team_limit\":null,\"default_image\":null,\"column_lg\":null,\"column_sm\":null,\"column_xs\":null,\"enable_animation\":\"0\",\"title_animation\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"team_about\"}]}'),
(807, 22, 'header_white', '0'),
(808, 151, 'header_white', '0'),
(833, 203, 'header_style', 'header-1'),
(834, 203, 'footer_style', 'footer-1'),
(835, 203, 'template', 'default'),
(836, 203, 'block_content', '{\"content\":[{\"blog_style\":\"blog_grid\",\"section_title\":\"News & Blog\",\"section_subtitle_1\":\"How We\'ve\",\"section_subtitle_2\":\"Empowered Businesses\",\"section_subtitle_3\":\"with Innovative\",\"section_subtitle_4\":\"Tech Solutions\",\"block\":\"blogs_page\"}]}'),
(837, 204, 'header_style', 'header-1'),
(838, 204, 'footer_style', 'footer-1'),
(839, 204, 'template', 'default'),
(840, 204, 'block_content', '{\"content\":[{\"blog_style\":\"blog_carousel\",\"section_title\":null,\"section_subtitle_1\":null,\"section_subtitle_2\":null,\"section_subtitle_3\":null,\"section_subtitle_4\":null,\"block\":\"blogs_page\"}]}'),
(841, 205, 'header_style', 'header-1'),
(842, 205, 'footer_style', 'footer-1'),
(843, 205, 'template', 'default'),
(844, 205, 'block_content', '{\"content\":[{\"blog_style\":\"blog_list_two\",\"section_title\":null,\"section_subtitle_1\":null,\"section_subtitle_2\":null,\"section_subtitle_3\":null,\"section_subtitle_4\":null,\"block\":\"blogs_page\"}]}'),
(845, 22, 'header_style', 'header-1'),
(846, 22, 'footer_style', 'footer-1'),
(847, 206, 'header_style', 'header-1'),
(848, 206, 'footer_style', 'footer-1'),
(849, 206, 'template', 'default'),
(850, 206, 'block_content', '{\"content\":[{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Your Business with Cutting-Edge IT\",\"section_title_2\":\"Solutions\",\"section_title_image\":\"2025\\/08\\/12\\/section-title-img.jpg\",\"section_title_3\":\"Innovative IT Services\",\"section_title_4\":\"Tailored for Your Success\",\"round_text\":\"View All Services View All Project\",\"round_icon\":\"2025\\/08\\/12\\/services-two-round-icon.png\",\"use_services_post_type\":\"1\",\"items_limit\":\"4\",\"service_ids\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"services_two_list\"},{\"form_title\":\"How Can We Help You?\",\"name_label\":\"Full Name\",\"name_placeholder\":\"Thomas Alison\",\"email_label\":\"Email Address\",\"email_placeholder\":\"thomas@domain.com\",\"phone_label\":\"Phone Number\",\"phone_placeholder\":\"+12 (00) 123 4567 890\",\"subject_label\":\"Subject\",\"message_label\":\"Inquiry about\",\"message_placeholder\":\"Write your message\",\"submit_button_text\":\"Submit Now\",\"section_tagline\":\"Get In Touch\",\"section_title_line1\":\"Start the Conversation\",\"section_title_line2\":\"Reach Out Anytime\",\"section_description\":\"We\'re here to listen! Whether you have questions, \\\\\\\\ feedback, or just want to say hello, feel free to reach out.\",\"location_title\":\"Location\",\"location_address\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"email_title\":\"Email Us\",\"email_address1\":\"info@domain.com\",\"email_address2\":\"support@domain.com\",\"contact_title\":\"Contact\",\"tel_number\":\"+12 (00) 456 7890 00\",\"mobile_number\":\"+99 (00) 567 780\",\"bg_shape\":\"2025\\/08\\/12\\/contact-one-bg-shape.png\",\"enable_animation\":\"1\",\"block\":\"contact_form\"},{\"shape_1\":\"2025\\/08\\/12\\/process-one-shape-1.png\",\"bg_shape\":\"2025\\/08\\/12\\/process-one-bg-shape.png\",\"section_tagline\":\"Working Process\",\"title_part_1\":\"How We\'ve\",\"title_part_2\":\"Empowered\",\"title_part_3\":\"Businesses with Innovative\",\"title_part_4\":\"Tech Solutions\",\"description\":\"From personalized solutions to expert \\\\\\\\ execution, we prioritize\\r\\n                                quality, reliability, and \\\\\\\\ customer satisfaction\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"process_steps\":[{\"title\":\"Discovery & Strategy\",\"text\":\"We analyze your business needs, \\\\\\\\ identify challenges, and craft a \\\\\\\\ strategic roadmap for the best IT \\\\\\\\ solutions.\",\"count_left\":\"1\"},{\"title\":\"Development\",\"text\":\"Our expert team designs, develops, \\\\\\\\ and integrates cutting-edge \\\\\\\\ technology tailored to your goals.\",\"count_left\":\"0\"},{\"title\":\"Optimization & Support\",\"text\":\"We ensure seamless performance with \\\\\\\\ continuous improvements, \\\\\\\\ maintenance, and dedicated support.\",\"count_left\":\"1\"}],\"block\":\"process_area_home2\"},{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"Select the Perfect\",\"section_title_2\":\"Plan for Your\",\"section_title_3\":\"Needs That Fits You\",\"tab_1_title\":\"Monthly\",\"tab_2_title\":\"Yearly\",\"tab_3_title\":\"Packages\",\"default_active_tab\":\"yearly\",\"monthly_items_limit\":null,\"monthly_pricing_ids\":null,\"yearly_items_limit\":null,\"yearly_pricing_ids\":null,\"packages_items_limit\":null,\"packages_pricing_ids\":null,\"unlimited_offer_text\":\"\\u26a1 Unlimited Offer\",\"features_title\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_two\"}]}'),
(851, 207, 'price', '$5.60'),
(852, 207, 'annual_price', '$50.30'),
(853, 207, 'annual_price_description', 'Will get free 5 months solutions support'),
(854, 207, 'price_button_text', 'Choose Plan'),
(855, 207, 'price_button_url', '/contact'),
(856, 207, 'is_populer', '0'),
(857, 207, 'features_list', '[{\"features_title\":\"Custom Website Design\",\"features_active\":\"1\"},{\"features_title\":\"website Design & Development\",\"features_active\":\"1\"},{\"features_title\":\"Social Media Graphics\",\"features_active\":\"0\"},{\"features_title\":\"Brand Color Palette\",\"features_active\":\"0\"}]'),
(858, 208, 'price', '$25.60'),
(859, 208, 'annual_price', '$240.70'),
(860, 208, 'annual_price_description', 'Will get free 5 months solutions support'),
(861, 208, 'price_button_text', 'Choose Plan'),
(862, 208, 'price_button_url', '/contact'),
(863, 208, 'is_populer', '1'),
(864, 208, 'features_list', '[{\"features_title\":\"Custom Website Design\",\"features_active\":\"1\"},{\"features_title\":\"website Design & Development\",\"features_active\":\"1\"},{\"features_title\":\"Basic & Technical SEO\",\"features_active\":\"1\"},{\"features_title\":\"Social Media Graphics\",\"features_active\":\"0\"},{\"features_title\":\"Brand Color Palette\",\"features_active\":\"0\"}]'),
(865, 209, 'price', '$120'),
(866, 209, 'annual_price', '$1200'),
(867, 209, 'annual_price_description', 'Will get free lifetime solutions support'),
(868, 209, 'price_button_text', 'Choose Plan'),
(869, 209, 'price_button_url', '/contact'),
(870, 209, 'is_populer', '0'),
(871, 209, 'features_list', '[{\"features_title\":\"Custom Website Design\",\"features_active\":\"1\"},{\"features_title\":\"website Design & Development\",\"features_active\":\"1\"},{\"features_title\":\"Social Media Graphics\",\"features_active\":\"0\"},{\"features_title\":\"Brand Color Palette\",\"features_active\":\"0\"}]'),
(872, 210, 'features_list', '[{\"features_title_1\":\"UI\\/UX Design\",\"features_title_2\":\"Mobile Application\"},{\"features_title_1\":\"Mobile Application\",\"features_title_2\":\"Research\"},{\"features_title_1\":\"Research\",\"features_title_2\":\"UI\\/UX Design\"}]'),
(873, 211, 'is_active', 'false'),
(874, 212, 'is_active', 'true'),
(875, 213, 'is_active', 'false'),
(876, 214, 'is_active', 'false'),
(877, 215, 'name', 'Sarah Williams'),
(878, 215, 'position', 'Marketing Manger'),
(879, 215, 'rating', '5'),
(880, 216, 'name', 'Thomas Alison'),
(881, 216, 'position', 'UI/UX Designer'),
(882, 216, 'rating', '4'),
(883, 217, 'name', 'James Anderson'),
(884, 217, 'position', 'Product Designer'),
(885, 217, 'rating', '5'),
(886, 218, 'header_style', 'header-1'),
(887, 218, 'footer_style', 'footer-1'),
(888, 218, 'template', 'default'),
(889, 218, 'block_content', '{\"content\":[{\"section_tagline\":null,\"section_title_1\":null,\"section_title_2\":null,\"section_title_3\":null,\"section_title_4\":null,\"use_services_post_type\":\"1\",\"items_limit\":\"5\",\"service_ids\":null,\"enable_animation\":\"1\",\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_margin\":null,\"block\":\"service_slider_home3\"}]}'),
(890, 219, 'features_list', '[{\"features_title_1\":\"Security\",\"features_title_2\":\"Performance\"},{\"features_title_1\":\"Scalability\",\"features_title_2\":\"Reliability\"},{\"features_title_1\":\"Innovation\",\"features_title_2\":\"Efficiency\"}]'),
(891, 220, 'features_list', '[{\"features_title_1\":\"Cloud Security\",\"features_title_2\":\"Cloud Scalability\"},{\"features_title_1\":\"Cloud Integration\",\"features_title_2\":\"Cloud Performance\"},{\"features_title_1\":\"Cloud Backup\",\"features_title_2\":\"Cloud Optimization\"}]'),
(892, 221, 'features_list', '[{\"features_title_1\":\"Data Insights\",\"features_title_2\":\"Predictive Analytics\"},{\"features_title_1\":\"Big Data\",\"features_title_2\":\"Business Intelligence\"},{\"features_title_1\":\"Data Visualization\",\"features_title_2\":\"Data Strategy\"}]'),
(893, 222, 'position', 'Professional UI/UX Design'),
(894, 222, 'department', 'UI/UX Design'),
(895, 222, 'subtitle', 'Professional UI/UX Design'),
(896, 222, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(897, 222, 'employment_type', 'Full-time'),
(898, 222, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(899, 222, 'phone', '+12 (00) 456 7890 00'),
(900, 222, 'mobile', '+99 (00) 567 780'),
(901, 222, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(902, 222, 'years_experience', '12'),
(903, 222, 'experience_title', 'crafting intuitive'),
(904, 222, 'experience_description', 'Experience Description'),
(905, 222, 'expertise_image', NULL),
(906, 222, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(907, 222, 'skills_title', 'Design Skills Hub'),
(908, 222, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(909, 222, 'show_social_links', '0'),
(910, 222, 'facebook', 'https://www.facebook.com/'),
(911, 222, 'linkedin', 'http://linkedin.com/'),
(912, 222, 'dribbble', 'http://dribbble.com/'),
(913, 223, 'header_style', 'header-1'),
(914, 223, 'footer_style', 'footer-1'),
(915, 223, 'template', 'default'),
(916, 223, 'block_content', '{\"content\":[{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered Businesses\",\"section_title_3\":\"with Innovative\",\"section_title_4\":\"Tech Solutions\",\"use_pricing_post_type\":\"1\",\"items_limit\":null,\"pricing_ids\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_page\"}]}'),
(917, 224, 'header_style', 'header-1'),
(918, 224, 'footer_style', 'footer-1'),
(919, 224, 'template', 'default'),
(920, 224, 'block_content', '{\"content\":[{\"enable_lightbox\":\"1\",\"enable_masonry\":\"1\",\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"gallery_page\"}]}'),
(921, 225, 'header_style', 'header-1'),
(922, 225, 'footer_style', 'footer-1'),
(923, 225, 'template', 'default'),
(924, 225, 'block_content', '{\"content\":[{\"section_tagline\":\"FAQS\",\"section_title\":\"Get answers to the most common \\\\\\\\\\r\\nquestions about our products, services, \\\\\\\\\\r\\nand policies.\",\"use_faqs_post_type\":\"1\",\"items_limit\":null,\"faq_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"show_cta_section\":\"1\",\"cta_tagline\":\"Get In Touch\",\"cta_title\":\"If you have any questions, \\\\\\\\ please contact us.\",\"cta_button_text\":\"Get in Touch\",\"cta_button_url\":\"\\/contact\",\"cta_shape_1\":null,\"cta_shape_2\":null,\"quick_support_title\":null,\"quick_support_text\":null,\"email_title\":null,\"email_1\":null,\"email_2\":null,\"contact_title\":null,\"phone_tel\":null,\"phone_mob\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"faq_page\"}]}'),
(925, 226, 'header_style', 'header-1'),
(926, 226, 'footer_style', 'footer-1'),
(927, 226, 'template', 'default'),
(928, 226, 'block_content', '{\"content\":[{\"use_testimonials_post_type\":\"1\",\"items_limit\":\"6\",\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"grid_columns\":\"3\",\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"testimonials_grid_list\"}]}'),
(929, 227, 'header_style', 'header-1'),
(930, 227, 'footer_style', 'footer-1'),
(931, 227, 'template', 'default'),
(932, 227, 'block_content', '{\"content\":[{\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_class\":null,\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"testimonials_carousel\"}]}'),
(933, 228, 'excerpt', 'Pioneering next-gen IT solutions that enhance efficiency and innovation.'),
(934, 228, 'portfolio_link_title', 'Get in touch'),
(935, 228, 'portfolio_link', '/contact'),
(936, 228, 'meta_list', '[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]'),
(942, 238, 'header_style', 'header-1'),
(943, 238, 'footer_style', 'footer-1'),
(944, 238, 'template', 'portfolio'),
(945, 229, 'excerpt', 'Delivering smart, scalable, and future-proof tech solutions for growth.'),
(946, 229, 'portfolio_link_title', 'Get in touch'),
(947, 229, 'portfolio_link', '/contact'),
(948, 229, 'meta_list', '[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]'),
(949, 233, 'excerpt', 'Turning complex challenges into streamlined, high-performance systems.'),
(950, 233, 'portfolio_link_title', 'Get in touch'),
(951, 233, 'portfolio_link', '/contact'),
(952, 233, 'meta_list', '[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]'),
(953, 232, 'excerpt', 'Pioneering next-gen IT solutions that enhance efficiency and innovation.'),
(954, 232, 'portfolio_link_title', 'Get in touch'),
(955, 232, 'portfolio_link', '/contact'),
(956, 232, 'meta_list', '[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]'),
(957, 231, 'excerpt', 'Pioneering next-gen IT solutions that enhance efficiency and innovation.'),
(958, 231, 'portfolio_link_title', 'Get in touch'),
(959, 231, 'portfolio_link', '/contact'),
(960, 231, 'meta_list', '[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]'),
(961, 230, 'excerpt', 'Pioneering next-gen IT solutions that enhance efficiency and innovation.'),
(962, 230, 'portfolio_link_title', 'Get in touch'),
(963, 230, 'portfolio_link', '/contact'),
(964, 230, 'meta_list', '[{\"content_icon\":\"icon-add-friend\",\"content_title\":\"Clients\",\"content_value\":\"Innovate Interiors group\"},{\"content_icon\":\"icon-earning\",\"content_title\":\"Budget\",\"content_value\":\"$10,000.00 USD\"},{\"content_icon\":\"icon-pin\",\"content_title\":\"Locations\",\"content_value\":\"1234 Innovation Street\"},{\"content_icon\":\"icon-real-estate-agency\",\"content_title\":\"Industries\",\"content_value\":\"real Estate Agency\"},{\"content_icon\":\"icon-calendar\",\"content_title\":\"Projects End\",\"content_value\":\"September 21, 2025\"}]'),
(965, 239, 'position', 'Chief Technology Office'),
(966, 239, 'department', 'UI/UX Design'),
(967, 239, 'subtitle', 'Chief Technology Office'),
(968, 239, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(969, 239, 'employment_type', 'Full-time'),
(970, 239, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(971, 239, 'phone', '+12 (00) 456 7890 00'),
(972, 239, 'mobile', '+99 (00) 567 780'),
(973, 239, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(974, 239, 'years_experience', '12'),
(975, 239, 'experience_title', 'crafting intuitive'),
(976, 239, 'experience_description', 'Experience Description'),
(977, 239, 'expertise_image', NULL),
(978, 239, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(979, 239, 'skills_title', 'Design Skills Hub'),
(980, 239, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(981, 239, 'show_social_links', '0'),
(982, 239, 'facebook', 'https://www.facebook.com/'),
(983, 239, 'linkedin', 'http://linkedin.com/'),
(984, 239, 'dribbble', 'http://dribbble.com/'),
(985, 240, 'position', 'Lead Software Engineer'),
(986, 240, 'department', 'UI/UX Design'),
(987, 240, 'subtitle', 'Lead Software Engineer'),
(988, 240, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(989, 240, 'employment_type', 'Full-time'),
(990, 240, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(991, 240, 'phone', '+12 (00) 456 7890 00'),
(992, 240, 'mobile', '+99 (00) 567 780'),
(993, 240, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(994, 240, 'years_experience', '12'),
(995, 240, 'experience_title', 'crafting intuitive'),
(996, 240, 'experience_description', 'Experience Description'),
(997, 240, 'expertise_image', NULL),
(998, 240, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(999, 240, 'skills_title', 'Design Skills Hub'),
(1000, 240, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(1001, 240, 'show_social_links', '0'),
(1002, 240, 'facebook', 'https://www.facebook.com/'),
(1003, 240, 'linkedin', 'http://linkedin.com/'),
(1004, 240, 'dribbble', 'http://dribbble.com/'),
(1005, 241, 'position', 'UI/UX Designer'),
(1006, 241, 'department', 'UI/UX Design'),
(1007, 241, 'subtitle', 'UI/UX Designer'),
(1008, 241, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(1009, 241, 'employment_type', 'Full-time'),
(1010, 241, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(1011, 241, 'phone', '+12 (00) 456 7890 00'),
(1012, 241, 'mobile', '+99 (00) 567 780'),
(1013, 241, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(1014, 241, 'years_experience', '12'),
(1015, 241, 'experience_title', 'crafting intuitive'),
(1016, 241, 'experience_description', 'Experience Description'),
(1017, 241, 'expertise_image', NULL),
(1018, 241, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(1019, 241, 'skills_title', 'Design Skills Hub'),
(1020, 241, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(1021, 241, 'show_social_links', '0'),
(1022, 241, 'facebook', 'https://www.facebook.com/'),
(1023, 241, 'linkedin', 'http://linkedin.com/'),
(1024, 241, 'dribbble', 'http://dribbble.com/'),
(1025, 242, 'position', 'Marketing Manager'),
(1026, 242, 'department', 'UI/UX Design'),
(1027, 242, 'subtitle', 'Marketing Manager'),
(1028, 242, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(1029, 242, 'employment_type', 'Full-time'),
(1030, 242, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(1031, 242, 'phone', '+12 (00) 456 7890 00'),
(1032, 242, 'mobile', '+99 (00) 567 780'),
(1033, 242, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(1034, 242, 'years_experience', '12'),
(1035, 242, 'experience_title', 'crafting intuitive'),
(1036, 242, 'experience_description', 'Experience Description'),
(1037, 242, 'expertise_image', NULL),
(1038, 242, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(1039, 242, 'skills_title', 'Design Skills Hub'),
(1040, 242, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(1041, 242, 'show_social_links', '0'),
(1042, 242, 'facebook', 'https://www.facebook.com/'),
(1043, 242, 'linkedin', 'http://linkedin.com/'),
(1044, 242, 'dribbble', 'http://dribbble.com/'),
(1045, 243, 'position', 'Product Designer'),
(1046, 243, 'department', 'UI/UX Design'),
(1047, 243, 'subtitle', 'Product Designer'),
(1048, 243, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(1049, 243, 'employment_type', 'Full-time'),
(1050, 243, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(1051, 243, 'phone', '+12 (00) 456 7890 00'),
(1052, 243, 'mobile', '+99 (00) 567 780'),
(1053, 243, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(1054, 243, 'years_experience', '12'),
(1055, 243, 'experience_title', 'crafting intuitive'),
(1056, 243, 'experience_description', 'Experience Description'),
(1057, 243, 'expertise_image', NULL),
(1058, 243, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(1059, 243, 'skills_title', 'Design Skills Hub'),
(1060, 243, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(1061, 243, 'show_social_links', '0'),
(1062, 243, 'facebook', 'https://www.facebook.com/'),
(1063, 243, 'linkedin', 'http://linkedin.com/'),
(1064, 243, 'dribbble', 'http://dribbble.com/'),
(1065, 244, 'position', 'Sales Director'),
(1066, 244, 'department', 'UI/UX Design'),
(1067, 244, 'subtitle', 'Sales Director'),
(1068, 244, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(1069, 244, 'employment_type', 'Full-time'),
(1070, 244, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(1071, 244, 'phone', '+12 (00) 456 7890 00'),
(1072, 244, 'mobile', '+99 (00) 567 780'),
(1073, 244, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(1074, 244, 'years_experience', '12'),
(1075, 244, 'experience_title', 'crafting intuitive'),
(1076, 244, 'experience_description', 'Experience Description'),
(1077, 244, 'expertise_image', NULL),
(1078, 244, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(1079, 244, 'skills_title', 'Design Skills Hub'),
(1080, 244, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(1081, 244, 'show_social_links', '0'),
(1082, 244, 'facebook', 'https://www.facebook.com/'),
(1083, 244, 'linkedin', 'http://linkedin.com/'),
(1084, 244, 'dribbble', 'http://dribbble.com/'),
(1085, 245, 'position', 'Operations Lead'),
(1086, 245, 'department', 'UI/UX Design'),
(1087, 245, 'subtitle', 'Operations Lead'),
(1088, 245, 'skill_image', '2025/08/13/skill-one-img-1.jpg'),
(1089, 245, 'employment_type', 'Full-time'),
(1090, 245, 'location', '1629 N. Dixie Avenue, \\\\ Kentucky, 42701'),
(1091, 245, 'phone', '+12 (00) 456 7890 00'),
(1092, 245, 'mobile', '+99 (00) 567 780'),
(1093, 245, 'office_hours', 'Sunday - Friday  \r\n10:00 AM - 5:00 PM'),
(1094, 245, 'years_experience', '12'),
(1095, 245, 'experience_title', 'crafting intuitive'),
(1096, 245, 'experience_description', 'Experience Description'),
(1097, 245, 'expertise_image', NULL),
(1098, 245, 'expertise', 'User research:95, Product Design:80, Prototype & Launch:85'),
(1099, 245, 'skills_title', 'Design Skills Hub'),
(1100, 245, 'skills_description', 'Design Expertise – Proficient in crafting user-friendly, visually appealing, and highly functional digital experiences. With a strong focus on usability, accessibility, and modern design trends, David ensures seamless interactions that enhance user engagement'),
(1101, 245, 'show_social_links', '0'),
(1102, 245, 'facebook', 'https://www.facebook.com/'),
(1103, 245, 'linkedin', 'http://linkedin.com/'),
(1104, 245, 'dribbble', 'http://dribbble.com/'),
(1105, 246, 'header_style', 'header-1'),
(1106, 246, 'footer_style', 'footer-1'),
(1107, 246, 'template', 'default'),
(1108, 246, 'block_content', '{\"content\":[{\"section_title\":null,\"section_subtitle\":null,\"show_section_title\":\"0\",\"use_teams_post_type\":\"1\",\"items_per_page\":null,\"carousel_class\":null,\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_margin\":null,\"block\":\"teams_carousel\"}]}'),
(1109, 249, 'name', 'Sarah William'),
(1110, 249, 'position', 'Marketing Mangere'),
(1111, 249, 'rating', '4'),
(1112, 248, 'name', 'James Andersons'),
(1113, 248, 'position', 'Product Designere'),
(1114, 248, 'rating', '4'),
(1115, 247, 'name', 'Thomas Alisons'),
(1116, 247, 'position', 'UI/UX Designers'),
(1117, 247, 'rating', '5'),
(1118, 151, 'header_style', 'header-1'),
(1119, 151, 'footer_style', 'footer-1'),
(1120, 250, 'header_style', 'header-1'),
(1121, 250, 'footer_style', 'footer-1'),
(1122, 250, 'template', 'home');
INSERT INTO `app_post_metas` (`id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1123, 250, 'block_content', '{\"content\":[{\"slides\":[{\"background_image\":\"2025\\/08\\/14\\/slider-2-1.jpg\",\"subtitle\":\"IT Solutions Designed for Your Success\",\"title_part_1\":\"Techguru - Smart\",\"title_part_2\":\"Solutions for a\",\"title_part_3\":\"Connected world\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_1_text\":\"Get Started\",\"button_1_url\":\"\\/contact\",\"button_2_text\":\"Read More\",\"button_2_url\":\"\\/about-us\"},{\"background_image\":\"2025\\/08\\/14\\/slider-2-2.jpg\",\"subtitle\":\"IT Solutions Designed for Your Success\",\"title_part_1\":\"Techguru - Empowering\",\"title_part_2\":\"Solutions for a\",\"title_part_3\":\"Connected world\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_1_text\":\"Get Started\",\"button_1_url\":\"\\/contact\",\"button_2_text\":\"Read More\",\"button_2_url\":\"\\/about-us\"},{\"background_image\":\"2025\\/08\\/14\\/slider-2-3.jpg\",\"subtitle\":\"IT Solutions Designed for Your Success\",\"title_part_1\":\"Techguru - Grow\",\"title_part_2\":\"Solutions for a\",\"title_part_3\":\"Connected world\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_1_text\":\"Get Started\",\"button_1_url\":\"\\/contact\",\"button_2_text\":\"Read More\",\"button_2_url\":\"\\/about-us\"}],\"menu_items\":[{\"text\":\"Help\",\"url\":\"\\/about-us\"},{\"text\":\"Support\",\"url\":\"\\/contact\"},{\"text\":\"Faqs\",\"url\":\"\\/faqs\"}],\"social_title\":\"Follow Us:\",\"social_links\":[{\"icon\":\"icon-facebook\",\"url\":\"https:\\/\\/www.facebook.com\\/\"},{\"icon\":\"icon-dribble\",\"url\":\"https:\\/\\/dribbble.com\\/\"},{\"icon\":\"icon-linkedin\",\"url\":\"http:\\/\\/linkedin.com\\/\"}],\"show_trustpilot\":\"1\",\"trustpilot_image_1\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-1.jpg\",\"trustpilot_image_2\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-2.jpg\",\"trustpilot_logo\":\"2025\\/08\\/14\\/main-slider-trustpilot-logo.png\",\"trustpilot_rating\":\"5.0 Excellent\",\"trustpilot_review_text\":\"Reviews\",\"trustpilot_review_count\":\"4170\",\"show_brands\":\"1\",\"brand_logos\":[{\"image\":\"2025\\/08\\/14\\/brand-1-1.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-2.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-3.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-4.png\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/brand-1-5.png\",\"alt\":null}],\"subtitle_icon\":\"2025\\/08\\/14\\/main-slider-sub-title-icon.png\",\"shield_check_icon\":\"2025\\/08\\/14\\/main-slider-shield-check-icon.png\",\"shape_2\":\"2025\\/08\\/14\\/main-slider-two-shape-2.png\",\"shape_3\":\"2025\\/08\\/14\\/main-slider-two-shape-3.png\",\"slider_autoplay\":\"1\",\"slider_autoplay_delay\":null,\"slider_loop\":\"1\",\"slider_pagination\":\"1\",\"slider_navigation\":\"1\",\"block\":\"hero_slider_home1\"},{\"shape_3\":\"2025\\/08\\/14\\/about-two-shape-3.png\",\"main_image\":\"2025\\/08\\/14\\/about-two-img-1.jpg\",\"secondary_image\":\"2025\\/08\\/14\\/about-two-img-2.jpg\",\"client_images\":[{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-1.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-3.jpg\",\"alt\":null},{\"image\":\"2025\\/08\\/14\\/about-four-client-img-1-2.jpg\",\"alt\":null}],\"client_count\":\"120\",\"client_suffix\":\"k\",\"client_text\":\"Satisfied Client\",\"section_tagline\":\"About Us\",\"title_part_1\":\"Unlock Your Business\",\"title_part_2\":\"Potential\",\"title_part_3\":\"with Our best Cutting-Edge\",\"title_part_4\":\"IT\",\"title_part_5\":\"Solutions to grow\",\"description\":\"Transform your business with our innovative IT solutions, tailored to address your unique challenges and drive growth in today\\u2019s digital landscape.\",\"features\":[{\"icon\":null,\"text\":\"Customized Solutions for \\\\\\\\ Every Business\"},{\"icon\":null,\"text\":\"Scalable Infrastructure for \\\\\\\\ Growth\"},{\"icon\":null,\"text\":\"Enhanced Security and Data \\\\\\\\ Protection\"},{\"icon\":null,\"text\":\"Continuous system \\\\\\\\ monitoring and expert \\\\\\\\ support\"}],\"experience_years\":\"25\",\"experience_text\":\"Years of \\\\\\\\ Experience\",\"call_text\":\"call us for inquiry\",\"phone_number\":\"00123456767\",\"phone_number_display\":\"+00 (123) 456767\",\"button_text\":\"Learn More\",\"button_url\":\"\\/about-us\",\"client_more_url\":\"\\/contact\",\"block\":\"about_area_home1\"},{\"bg_shape\":null,\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"Creative Plus award\"},{\"icon\":\"icon-user\",\"count\":\"300\",\"suffix\":\"+\",\"text\":\"Expert Team Members\"},{\"icon\":\"icon-chat\",\"count\":\"20\",\"suffix\":\"M\",\"text\":\"Happy Clients Review\"},{\"icon\":\"icon-folder\",\"count\":\"1.5\",\"suffix\":\"k\",\"text\":\"Project Completed\"}],\"enable_animation\":\"1\",\"block\":\"counter_area_home1\"},{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Your Business with Cutting-Edge IT\",\"section_title_2\":\"Solutions\",\"section_title_image\":\"2025\\/08\\/12\\/section-title-img.jpg\",\"section_title_3\":\"Innovative IT Services\",\"section_title_4\":\"Tailored for Your Success\",\"round_text\":\"View All Services View All Project\",\"round_icon\":\"2025\\/08\\/12\\/services-two-round-icon.png\",\"use_services_post_type\":\"1\",\"items_limit\":\"4\",\"service_ids\":null,\"enable_animation\":\"0\",\"animation_type\":\"fadeInUp\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"services_two_list\"},{\"shape_3\":null,\"shape_1\":null,\"shape_2\":null,\"section_tagline\":null,\"title_part_1\":null,\"title_part_2\":null,\"title_part_3\":null,\"title_part_4\":null,\"description\":null,\"progress_bars\":[{\"title\":\"Camping Launches\",\"percent\":\"86\"},{\"title\":\"Innovation Design\",\"percent\":\"76\"}],\"button_text\":\"About Us\",\"button_url\":\"\\/about-us\",\"client_image\":\"2025\\/08\\/14\\/why-choose-one-client-img.jpg\",\"client_name\":\"Thomas Alison\",\"client_position\":\"Founder & CEO\",\"main_image\":\"2025\\/08\\/14\\/why-choose-one-img-1.png\",\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"why_choose_home1\"},{\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"sliding_items\":[{\"text\":\"UI\\/UX Design\",\"hover_text\":\"UI\\/UX Design\",\"icon\":\"icon-star\"},{\"text\":\"BRANDING\",\"hover_text\":\"BRANDING\",\"icon\":\"icon-star\"},{\"text\":\"Cyber Security\",\"hover_text\":\"Cyber Security\",\"icon\":\"icon-star\"},{\"text\":\"Web Development\",\"hover_text\":\"Web Development\",\"icon\":\"icon-star\"},{\"text\":\"Product Design\",\"hover_text\":\"Product Design\",\"icon\":\"icon-star\"},{\"text\":\"Website design\",\"hover_text\":\"Website design\",\"icon\":\"icon-star\"},{\"text\":\"Digital Marketing\",\"hover_text\":\"Digital Marketing\",\"icon\":\"icon-star\"}],\"block\":\"sliding_text_home1\"},{\"bg_image\":\"2025\\/08\\/14\\/process-two-bg.jpg\",\"bg_shape\":null,\"section_tagline\":\"Working Process\",\"title_part_1\":\"Our Seamless Process\",\"title_part_2\":\"From Concept to Creation\",\"process_steps\":[{\"title\":\"Research & Discovery\",\"text\":\"We begin by understanding your needs,\\\\\\\\ goals, and vision. Through brainstorming\\\\\\\\ sessions and strategic planning,\",\"show_shape_1\":\"0\",\"shape_1\":null,\"show_shape_2\":\"0\",\"shape_2\":null},{\"title\":\"Design and Development\",\"text\":\"Once the strategy is in place, we move to \\\\\\\\\\r\\ndesigning and developing your vision. Our \\\\\\\\\\r\\nteam collaborates closely to bring your \\\\\\\\\\r\\nideas\",\"show_shape_1\":\"1\",\"shape_1\":null,\"show_shape_2\":\"1\",\"shape_2\":null},{\"title\":\"Testing and Launch\",\"text\":\"Before going live, we rigorously test to \\\\\\\\\\r\\nensure optimal functionality. After \\\\\\\\\\r\\nthorough quality checks, we launch your \\\\\\\\\\r\\nproject\",\"show_shape_1\":\"0\",\"shape_1\":null,\"show_shape_2\":\"0\",\"shape_2\":null}],\"block\":\"process_area_home1\"},{\"section_tagline\":\"Portfolio\",\"section_title_1\":\"Explore Our Creative\",\"section_title_2\":\"Journey\",\"section_title_3\":\"Crafting Success Through\",\"shape_1\":null,\"use_portfolio_post_type\":\"1\",\"items_limit\":null,\"portfolio_ids\":\"233,232,230,229\",\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"1\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items\":null,\"enable_animation\":\"1\",\"enable_magnific_popup\":\"1\",\"block\":\"portfolio_home1\"},{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"Select the Perfect\",\"section_title_2\":\"Plan for Your\",\"section_title_3\":\"Needs That Fits You\",\"tab_1_title\":\"Monthly\",\"tab_2_title\":\"Yearly\",\"tab_3_title\":\"Packages\",\"default_active_tab\":\"yearly\",\"monthly_items_limit\":null,\"monthly_pricing_ids\":null,\"yearly_items_limit\":null,\"yearly_pricing_ids\":null,\"packages_items_limit\":null,\"packages_pricing_ids\":null,\"unlimited_offer_text\":\"\\u26a1 Unlimited Offer\",\"features_title\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_two\"},{\"sliding_text_items\":[{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"},{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"}],\"bg_image\":\"2025\\/08\\/14\\/contact-two-bg.jpg\",\"shape_1\":null,\"section_tagline\":\"Get In Touch\",\"title_part_1\":\"Conversation\",\"title_part_2\":\"Reach\",\"title_part_3\":\"Out Anytime\",\"description\":\"We\'re here to listen! Whether you have\\\\\\\\ questions, feedback,   or just want to say hello, \\\\\\\\ feel free to reach out.\",\"email_title\":\"Email Us\",\"email_address\":\"info@domain.com\",\"contact_title\":\"Contact US\",\"phone_number\":\"+99 (00) 567 780\",\"address_title\":\"Our Address\",\"address\":\"629 N. Dixie Avenue, Kentucky, 42701\",\"form_name_label\":null,\"form_name_placeholder\":null,\"form_email_label\":null,\"form_email_placeholder\":null,\"form_phone_label\":null,\"form_phone_placeholder\":null,\"form_subject_label\":null,\"form_message_label\":null,\"form_message_placeholder\":null,\"submit_button_text\":null,\"enable_animation\":\"1\",\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"block\":\"contact_form_home1\"},{\"section_tagline\":\"Upcoming Events\",\"section_title_1\":\"Exciting Events\",\"section_title_2\":\"on the Horizon\",\"section_title_3\":null,\"contact_btn_text\":\"Contact Us\",\"contact_btn_url\":\"\\/contact\",\"shape_1\":null,\"shape_2\":null,\"event_image\":\"2025\\/08\\/14\\/event-one-img-1.jpg\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=qcTG5NXzuR0\",\"events\":[{\"title\":\"Innovation Meets\",\"description\":\"It is a long established fact that a reader will\",\"countdown_date\":\"2026\\/05\\/28\",\"location\":\"1629 N. Dixie Avenue\",\"date\":\"March 18, 2025\",\"book_btn_text\":\"Book Seat\",\"book_btn_url\":\"\\/contact\",\"animation_delay\":null,\"animation_direction\":\"fadeInLeft\"},{\"title\":\"Unlock Your Potential\",\"description\":\"It is a long established fact that a reader will\",\"countdown_date\":\"2026\\/08\\/28\",\"location\":\"1629 N. Dixie Avenue\",\"date\":\"March 25, 2025\",\"book_btn_text\":\"Book Seat\",\"book_btn_url\":\"\\/contact\",\"animation_delay\":null,\"animation_direction\":\"fadeInLeft\"},{\"title\":\"Tech Talks Live\",\"description\":\"It is a long established fact that a reader will\",\"countdown_date\":\"2026\\/02\\/28\",\"location\":\"1629 N. Dixie Avenue\",\"date\":\"March 30, 2025\",\"book_btn_text\":\"Book Seat\",\"book_btn_url\":\"\\/contact\",\"animation_delay\":null,\"animation_direction\":\"fadeInLeft\"}],\"enable_animation\":\"1\",\"enable_video_popup\":\"1\",\"block\":\"event_home1\"},{\"section_tagline\":\"Testimonials\",\"section_title_1\":\"Customer Experiences\",\"section_title_2\":\"That\",\"section_title_3\":\"Speak Volumes\",\"shape_1\":null,\"shape_2\":null,\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"1\",\"block\":\"testimonials_slider_home1\"},{\"section_tagline\":\"Our Blogs\",\"section_title_1\":\"Explore Our Latest\",\"section_title_2\":\"Blogs for Expert Insights\",\"section_description\":\"Dive into our collection of blogs where we share expert insights, helpful tips, and the latest trends in the industry\",\"view_all_text\":\"View All Blogs\",\"view_all_url\":\"\\/blogs\",\"read_more_text\":null,\"show_featured_post\":\"1\",\"featured_post_id\":null,\"posts_limit\":null,\"category_ids\":null,\"tag_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"block\":\"blogs_area_home1\"}]}'),
(1127, 252, 'header_style', 'header-2'),
(1128, 252, 'footer_style', 'footer-2'),
(1129, 252, 'template', 'home'),
(1130, 252, 'block_content', '{\"content\":[{\"slides\":[{\"subtitle\":\"IT Solutions That Work for You\",\"title_part_1\":\"Expert\",\"title_part_2\":\"IT Solutions\",\"title_part_3\":\"to Elevate\",\"title_part_4\":\"Your \\\\\\\\ Enterprise\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"slider_image\":\"2025\\/08\\/14\\/main-slider-img-1.png\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=NMC2ijeJkVQ\"},{\"subtitle\":\"IT Solutions That Work for You\",\"title_part_1\":\"Expert\",\"title_part_2\":\"IT Solutions\",\"title_part_3\":\"to Elevate\",\"title_part_4\":\"Your \\\\\\\\ Enterprise\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"slider_image\":\"2025\\/08\\/14\\/main-slider-img-2.png\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=NMC2ijeJkVQ\"},{\"subtitle\":\"IT Solutions That Work for You\",\"title_part_1\":\"Expert\",\"title_part_2\":\"IT Solutions\",\"title_part_3\":\"to Elevate\",\"title_part_4\":\"Your \\\\\\\\ Enterprise\",\"description\":\"From strategic IT consulting to seamless \\\\\\\\ implementation, we deliver tailored solutions \\\\\\\\ that drive efficiency\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"slider_image\":\"2025\\/08\\/14\\/main-slider-img-1.png\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=NMC2ijeJkVQ\"}],\"shape_1\":\"2025\\/08\\/14\\/main-slider-shape-1.png\",\"shape_3\":\"2025\\/08\\/14\\/main-slider-shape-3.png\",\"shape_4\":\"2025\\/08\\/14\\/main-slider-shape-4.png\",\"shape_5\":\"2025\\/08\\/14\\/main-slider-shape-5.png\",\"subtitle_icon\":\"2025\\/08\\/14\\/main-slider-sub-title-icon.png\",\"shield_check_icon\":\"2025\\/08\\/14\\/main-slider-shield-check-icon-1.png\",\"show_trustpilot\":\"1\",\"trustpilot_image_1\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-1-1.jpg\",\"trustpilot_image_2\":\"2025\\/08\\/14\\/main-slider-trustpilot-img-2-1.jpg\",\"trustpilot_logo\":\"2025\\/08\\/14\\/main-slider-trustpilot-logo.png\",\"trustpilot_rating\":\"5.0 Excellent\",\"trustpilot_review_text\":\"Reviews\",\"trustpilot_review_count\":\"4170\",\"slider_autoplay\":\"1\",\"slider_autoplay_delay\":null,\"slider_loop\":\"1\",\"slider_pagination\":\"1\",\"slider_navigation\":\"0\",\"block\":\"hero_slider_home2\"},{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Comprehensive, Reliable\",\"section_title_2\":\"Services\",\"section_title_3\":\"Crafted to Exceed\",\"section_title_4\":\"Your \\\\\\\\ Expectations\",\"description\":\"From personalized solutions to expert execution, we prioritize quality, reliability, and customer satisfaction in everything we do. Let us be your trusted partner in achieving success.\",\"main_image_1\":\"2025\\/08\\/14\\/servces-one-img-1.png\",\"main_image_2\":null,\"shape_1\":null,\"shape_3\":null,\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"service_area_home2\"},{\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"sliding_items\":[{\"text\":\"Digital Marketing\",\"hover_text\":\"Digital Marketing\"},{\"text\":\"Website Design\",\"hover_text\":\"Website Design\"},{\"text\":\"APP Development\",\"hover_text\":\"APP Development\"},{\"text\":\"Front end Development\",\"hover_text\":\"Front end Development\"},{\"text\":\"UI\\/UX Design\",\"hover_text\":\"UI\\/UX Design\"},{\"text\":\"Product Design\",\"hover_text\":\"Product Design\"}],\"block\":\"sliding_text_home2\"},{\"section_tagline\":\"About Us\",\"title_part_1\":\"Boost Business\",\"title_part_2\":\"with Our\",\"title_part_3\":\"Innovative IT Solutions\",\"title_part_4\":\"for Success story\",\"description\":\"Innovating and empowering businesses with tailored solutions for success and growth.\",\"features\":[{\"icon\":null,\"title\":\"Shaping Tomorrow, Transforming Today\",\"text\":\"Empowering businesses to create meaningful change, driving innovation\"},{\"icon\":null,\"title\":\"Innovating Today, Empowering Tomorrow\",\"text\":\"Partner with us to unlock new possibilities, drive progress, and shape a future filled with success\"}],\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"call_text\":\"Call Any Time\",\"phone_number\":\"1234567 8900\",\"phone_number_display\":\"(123) 4567 8900\",\"main_image\":\"2025\\/08\\/14\\/about-one-img-1.jpg\",\"block\":\"about_area_home2\"},{\"bg_shape\":null,\"section_tagline\":\"The Numbers Speak\",\"title_part_1\":\"Exploring Business Growth\",\"title_part_2\":\"In IT\",\"title_part_3\":\"Consulting Solutions\",\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"award Winning\",\"animation_delay\":null},{\"icon\":\"icon-user\",\"count\":\"99\",\"suffix\":\"%\",\"text\":\"Satisfied client\",\"animation_delay\":null},{\"icon\":\"icon-chat\",\"count\":\"10\",\"suffix\":\"M\",\"text\":\"worldwide reviews\",\"animation_delay\":null},{\"icon\":\"icon-laughing\",\"count\":\"200\",\"suffix\":\"+\",\"text\":\"Happy Clients\",\"animation_delay\":null}],\"enable_animation\":\"1\",\"block\":\"counter_area_home2\"},{\"section_tagline\":\"See Our Works\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered\",\"section_title_3\":\"Businesses with Innovative\",\"section_title_4\":\"Tech Solutions\",\"big_text\":\"portfolio\",\"shape_1\":null,\"shape_2\":null,\"round_text\":\"View All Project View All Project\",\"round_icon\":null,\"all_projects_url\":\"\\/portfolios\",\"use_portfolio_post_type\":\"1\",\"items_limit\":null,\"portfolio_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":\"4\",\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"1\",\"enable_magnific_popup\":\"1\",\"block\":\"portfolio_home2\"},{\"shape_1\":\"2025\\/08\\/12\\/process-one-shape-1.png\",\"bg_shape\":null,\"section_tagline\":\"Working Process\",\"title_part_1\":\"How We\'ve\",\"title_part_2\":\"Empowered\",\"title_part_3\":\"Businesses with Innovative\",\"title_part_4\":\"Tech Solutions\",\"description\":\"From personalized solutions to expert \\\\\\\\ execution, we prioritize quality, reliability, and \\\\\\\\ customer satisfaction\",\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"process_steps\":[{\"title\":\"Discovery & Strategy\",\"text\":\"We analyze your business needs, \\\\\\\\ identify challenges, and craft a \\\\\\\\ strategic roadmap for the best IT \\\\\\\\ solutions.\",\"count_left\":\"1\"},{\"title\":\"Development\",\"text\":\"Our expert team designs, develops, \\\\\\\\ and integrates cutting-edge \\\\\\\\ technology tailored to your goals.\",\"count_left\":\"0\"},{\"title\":\"Optimization & Support\",\"text\":\"We ensure seamless performance with \\\\\\\\ continuous improvements, \\\\\\\\ maintenance, and dedicated support.\",\"count_left\":\"1\"}],\"block\":\"process_area_home2\"},{\"form_title\":\"How Can We Help You?\",\"name_label\":\"Full Name\",\"name_placeholder\":\"Thomas Alison\",\"email_label\":\"Email Address\",\"email_placeholder\":\"thomas@domain.com\",\"phone_label\":\"Phone Number\",\"phone_placeholder\":\"+12 (00) 123 4567 890\",\"subject_label\":\"Subject\",\"message_label\":\"Inquiry about\",\"message_placeholder\":\"Write your message\",\"submit_button_text\":\"Submit Now\",\"section_tagline\":\"Get In Touch\",\"section_title_line1\":\"Start the Conversation\",\"section_title_line2\":\"Reach Out Anytime\",\"section_description\":\"We\'re here to listen! Whether you have questions, \\\\\\\\ feedback, or just want to say hello, feel free to reach out.\",\"location_title\":\"Location\",\"location_address\":\"1629 N. Dixie Avenue, \\\\\\\\ Kentucky, 42701\",\"email_title\":\"Email Us\",\"email_address1\":\"info@domain.com\",\"email_address2\":\"support@domain.com\",\"contact_title\":\"Contact\",\"tel_number\":\"+12 (00) 456 7890 00\",\"mobile_number\":\"+99 (00) 567 780\",\"bg_shape\":\"2025\\/08\\/12\\/contact-one-bg-shape.png\",\"enable_animation\":\"1\",\"block\":\"contact_form\"},{\"section_title\":\"Innovative Tech Solutions\",\"section_subtitle\":\"Our Team Member\",\"show_section_title\":\"1\",\"use_teams_post_type\":\"1\",\"items_per_page\":null,\"carousel_class\":null,\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"1\",\"carousel_margin\":null,\"block\":\"teams_carousel\"},{\"section_tagline\":\"Pricing & Plan\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered Businesses\",\"section_title_3\":\"with Innovative\",\"section_title_4\":\"Tech Solutions\",\"use_pricing_post_type\":\"1\",\"items_limit\":null,\"pricing_ids\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"animation_type\":\"fadeInUp\",\"block\":\"pricing_page\"},{\"background_image\":\"2025\\/08\\/14\\/testimonial-one-bg-1.jpg\",\"shape_1\":null,\"shape_2\":null,\"section_tagline\":\"Client Testimonial\",\"section_title_1\":\"What Our Clients\",\"section_title_2\":\"\\u2013 Say\",\"section_title_3\":\"About Us\",\"use_testimonials_post_type\":\"0\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"custom_testimonials\":[{\"client_image\":\"2025\\/08\\/14\\/testimonial-1-1.jpg\",\"title\":\"!Great Agency It Agency\",\"testimonial_text\":\"\\u201cFrom the initial consultation to the final product, every step was handled with professionalism and care. The final\\r\\n result exceeded our expectations and has significantly improved our  operations\\\"\",\"client_position\":\"Marketing Manager\",\"client_name\":\"Sarah James\",\"testimonial_url\":\"\\/contact\",\"trustpilot_logo\":\"2025\\/08\\/14\\/trustpilot-logo.png\",\"trustpilot_text\":\"5.0 Excellent\",\"star_icon\":null,\"star_count\":\"4\"},{\"client_image\":\"2025\\/08\\/14\\/testimonial-1-2.jpg\",\"title\":\"!Great Agency It Agency\",\"testimonial_text\":\"\\u201cFrom the initial consultation to the final product, every step was handled with professionalism and care. The final\\r\\n result exceeded our expectations and has significantly improved our  operations\\\"\",\"client_position\":\"Marketing Manager\",\"client_name\":\"Sarah James\",\"testimonial_url\":\"\\/contact\",\"trustpilot_logo\":\"2025\\/08\\/14\\/trustpilot-logo.png\",\"trustpilot_text\":\"5.0 Excellent\",\"star_icon\":null,\"star_count\":\"5\"},{\"client_image\":\"2025\\/08\\/14\\/testimonial-1-3.jpg\",\"title\":\"!Great Agency It Agency\",\"testimonial_text\":\"\\u201cFrom the initial consultation to the final product, every step was handled with professionalism and care. The final\\r\\n result exceeded our expectations and has significantly improved our  operations\\\"\",\"client_position\":\"Marketing Manager\",\"client_name\":\"Sarah James\",\"testimonial_url\":\"\\/contact\",\"trustpilot_logo\":\"2025\\/08\\/14\\/trustpilot-logo.png\",\"trustpilot_text\":\"5.0 Excellent\",\"star_icon\":null,\"star_count\":\"3\"}],\"clients_count_text\":\"12K Trusted by clients worldwide\",\"client_images\":[{\"image\":\"2025\\/08\\/14\\/brand-one-img-1-1.jpg\",\"alt_text\":null},{\"image\":\"2025\\/08\\/14\\/brand-one-img-1-2.jpg\",\"alt_text\":null}],\"brand_logos\":[{\"logo\":\"2025\\/08\\/14\\/brand-1-1.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-2.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-3.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-4.png\",\"alt_text\":null},{\"logo\":\"2025\\/08\\/14\\/brand-1-5.png\",\"alt_text\":null}],\"testimonial_carousel_loop\":\"1\",\"testimonial_carousel_nav\":\"0\",\"testimonial_carousel_dots\":\"1\",\"testimonial_carousel_autoplay\":\"1\",\"testimonial_carousel_autoplay_timeout\":null,\"testimonial_carousel_items\":null,\"brand_carousel_loop\":\"1\",\"brand_carousel_nav\":\"1\",\"brand_carousel_dots\":\"1\",\"brand_carousel_autoplay\":\"1\",\"brand_carousel_autoplay_timeout\":null,\"brand_carousel_items\":null,\"brand_carousel_items_tablet\":null,\"brand_carousel_items_mobile\":null,\"enable_animation\":\"1\",\"block\":\"testimonials_slider_home2\"},{\"shape_bg\":null,\"shape_1\":null,\"newsletter_image\":null,\"title_part1\":\"Subscribe\",\"title_part2\":\"Newsletter\",\"description_line1\":\"From personalized solutions to expert execution, we prioritize quality,\",\"description_line2\":\"reliability, and customer satisfaction\",\"placeholder\":\"Enter email address\",\"button_text\":\"Subscribe Now\",\"show_success_message\":\"1\",\"show_error_message\":\"1\",\"block\":\"newsletter_home2\"},{\"section_tagline\":null,\"section_title_1\":null,\"section_title_2\":null,\"section_title_3\":null,\"section_title_4\":null,\"read_more_text\":null,\"posts_limit\":\"6\",\"category_ids\":null,\"tag_ids\":null,\"orderby\":\"date\",\"order\":\"ASC\",\"enable_animation\":\"1\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"1\",\"carousel_dots\":\"1\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":\"3\",\"carousel_items_large\":\"3\",\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"block\":\"blogs_area_home2\"}]}'),
(1131, 253, 'header_style', 'header-1'),
(1132, 253, 'footer_style', 'footer-1'),
(1133, 253, 'template', 'home'),
(1134, 253, 'block_content', '{\"content\":[{\"background_image\":\"2025\\/08\\/14\\/banner-one-bg.jpg\",\"shape_bg\":\"2025\\/08\\/14\\/banner-one-shape-bg.png\",\"title_part_1\":\"Expert IT Solutions to Elevate\",\"title_part_2\":\"Your Enterprise\",\"button_text\":\"Get Started\",\"button_url\":\"\\/contact\",\"banner_image\":\"2025\\/08\\/14\\/banner-one-img-1.jpg\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=VEQd-jmVs44\",\"show_video_button\":\"1\",\"block\":\"hero_banner_home3\"},{\"main_image\":\"2025\\/08\\/14\\/about-three-img-1.png\",\"section_tagline\":\"About Us\",\"title_part_1\":\"Any IT Problem Solutions And\",\"title_part_2\":\"Grow Your Business\",\"description\":\"Transform your business with our innovative IT solutions, tailored to address your unique challenges and drive growth.\",\"progress_bars\":[{\"title\":\"Business Problem Solving\",\"percent\":\"70\"},{\"title\":\"Camping Launches\",\"percent\":\"80\"}],\"features\":[{\"icon\":null,\"title\":\"Shaping Tomorrow, Transforming Today\"},{\"icon\":null,\"title\":\"Innovating Today, Empowering Tomorrow\"}],\"button_text\":\"Get in Touch\",\"button_url\":\"\\/contact\",\"call_text\":\"Call Any Time\",\"phone_number\":\"1234567 8900\",\"phone_number_display\":\"(123) 4567 8900\",\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"about_area_home3\"},{\"section_tagline\":\"Our Services\",\"section_title_1\":\"Reliable Services\",\"section_title_2\":\"Crafted\",\"section_title_3\":\"to Exceed\",\"section_title_4\":\"Your Expectations\",\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"enable_animation\":\"1\",\"carousel_items\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_loop\":\"1\",\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_margin\":null,\"block\":\"service_slider_home3\"},{\"shape_1\":null,\"section_tagline\":\"Why Chooses Us\",\"title_part_1\":\"Elevate Growth with Our IT Solutions\",\"title_part_2\":\"for Success\",\"description\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\",\"main_image\":\"2025\\/08\\/14\\/why-choose-two-img-1.png\",\"features\":[{\"icon\":\"icon-earning\",\"title\":\"Industry Experience\",\"text\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\"},{\"icon\":\"icon-customer-service-headset\",\"title\":\"24\\/7 Customer Support\",\"text\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\"},{\"icon\":\"icon-quality\",\"title\":\"Trust & Reliability\",\"text\":\"Innovating and empowering businesses with tailored solutions for success and growth. Innovating and empowering\"}],\"enable_animation\":\"1\",\"animation_delay\":null,\"animation_duration\":null,\"block\":\"why_choose_home3\"},{\"shape_1\":null,\"shape_2\":null,\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"block\":\"service_features_part1_home3\"},{\"background_shape\":\"2025\\/08\\/14\\/cta-one-shape-bg.png\",\"title_line1\":\"To make requests for further\",\"title_line2\":\"information, contact us\",\"contact_text\":\"Call Us For Any inquiry\",\"phone_number\":\"+99 (00) 567 780\",\"phone_number_clean\":\"+9900567780\",\"block\":\"cta_home3\"},{\"section_tagline\":\"Testimonials\",\"section_title_1\":\"Customer Experiences\",\"section_title_2\":\"That\",\"section_title_3\":\"Speak Volumes\",\"shape_1\":null,\"shape_2\":null,\"use_testimonials_post_type\":\"1\",\"items_limit\":null,\"testimonial_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"0\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"0\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":null,\"carousel_items_large\":null,\"carousel_items_medium\":null,\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"0\",\"block\":\"testimonials_slider_home1\"},{\"bg_shape\":null,\"section_tagline\":\"The Numbers Speak\",\"title_part_1\":\"Exploring Business Growth\",\"title_part_2\":\"In IT\",\"title_part_3\":\"Consulting Solutions\",\"counters\":[{\"icon\":\"icon-trophy\",\"count\":\"120\",\"suffix\":\"+\",\"text\":\"award Winning\",\"animation_delay\":null},{\"icon\":\"icon-user\",\"count\":\"99\",\"suffix\":\"%\",\"text\":\"Satisfied client\",\"animation_delay\":null},{\"icon\":\"icon-chat\",\"count\":\"10\",\"suffix\":\"M\",\"text\":\"worldwide reviews\",\"animation_delay\":null},{\"icon\":\"icon-laughing\",\"count\":\"200\",\"suffix\":\"+\",\"text\":\"Happy Clients\",\"animation_delay\":null}],\"enable_animation\":\"1\",\"block\":\"counter_area_home2\"},{\"section_tagline\":\"See Our Works\",\"section_title_1\":\"How We\'ve\",\"section_title_2\":\"Empowered\",\"section_title_3\":\"Businesses with Innovative\",\"section_title_4\":\"Tech Solutions\",\"big_text\":\"portfolio\",\"shape_1\":null,\"shape_2\":null,\"round_text\":\"View All Project View All Project\",\"round_icon\":null,\"all_projects_url\":\"\\/portfolios\",\"use_portfolio_post_type\":\"1\",\"items_limit\":null,\"portfolio_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"carousel_loop\":\"1\",\"carousel_margin\":null,\"carousel_nav\":\"0\",\"carousel_dots\":\"0\",\"carousel_smart_speed\":null,\"carousel_autoplay\":\"1\",\"carousel_autoplay_timeout\":null,\"carousel_items_desktop\":\"4\",\"carousel_items_tablet\":null,\"carousel_items_mobile\":null,\"enable_animation\":\"1\",\"enable_magnific_popup\":\"1\",\"block\":\"portfolio_home2\"},{\"section_tagline\":\"Our Faqs\",\"section_title_1\":\"Your Questions Answered\",\"section_title_2\":\"Explore Our FAQs\",\"faq_image\":\"2025\\/08\\/14\\/faq-one-img-1.jpg\",\"experience_count\":\"55\",\"experience_text_line1\":\"Year of\",\"experience_text_line2\":\"experience\",\"use_faqs_post_type\":\"1\",\"items_limit\":null,\"faq_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"enable_odometer\":\"1\",\"block\":\"faq_home3\"},{\"use_services_post_type\":\"1\",\"items_limit\":null,\"service_ids\":null,\"enable_animation\":\"1\",\"block\":\"service_features_home3\"},{\"section_tagline\":\"Our Blogs\",\"section_title_1\":\"Explore Our Latest\",\"section_title_2\":\"Blogs for Expert Insights\",\"section_description\":\"Dive into our collection of blogs where we share expert insights, helpful tips, and the latest trends in the industry\",\"view_all_text\":\"View All Blogs\",\"view_all_url\":\"\\/blogs\",\"read_more_text\":null,\"show_featured_post\":\"1\",\"featured_post_id\":null,\"posts_limit\":null,\"category_ids\":null,\"tag_ids\":null,\"orderby\":\"date\",\"order\":\"DESC\",\"enable_animation\":\"1\",\"block\":\"blogs_area_home1\"},{\"sliding_text_items\":[{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"},{\"text\":\"GET IN TOUCH\",\"hover_text\":\"GET IN TOUCH\"}],\"bg_image\":\"2025\\/08\\/14\\/contact-two-bg.jpg\",\"shape_1\":null,\"section_tagline\":\"Get In Touch\",\"title_part_1\":\"Conversation\",\"title_part_2\":\"Reach\",\"title_part_3\":\"Out Anytime\",\"description\":\"We\'re here to listen! Whether you have\\\\\\\\ questions, feedback,   or just want to say hello, \\\\\\\\ feel free to reach out.\",\"email_title\":\"Email Us\",\"email_address\":\"info@domain.com\",\"contact_title\":\"Contact US\",\"phone_number\":\"+99 (00) 567 780\",\"address_title\":\"Our Address\",\"address\":\"629 N. Dixie Avenue, Kentucky, 42701\",\"form_name_label\":null,\"form_name_placeholder\":null,\"form_email_label\":null,\"form_email_placeholder\":null,\"form_phone_label\":null,\"form_phone_placeholder\":null,\"form_subject_label\":null,\"form_message_label\":null,\"form_message_placeholder\":null,\"submit_button_text\":null,\"enable_animation\":\"1\",\"marquee_class\":null,\"scroll_speed\":null,\"pause_on_hover\":\"1\",\"block\":\"contact_form_home1\"}]}'),
(1135, 254, 'header_style', 'header-1'),
(1136, 254, 'footer_style', 'footer-1'),
(1137, 254, 'template', 'products'),
(1138, 255, 'price', '33'),
(1139, 255, 'sku_code', '1312312312'),
(1140, 255, 'inventory_management', '1'),
(1141, 255, 'quantity', '300'),
(1142, 255, 'compare_price', '32'),
(1143, 255, 'barcode', '1231212321'),
(1144, 255, 'disable_out_of_stock', '1'),
(1145, 255, 'badge', 'new'),
(1146, 255, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1147, 255, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1148, 255, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1149, 255, 'downloadable', '0'),
(1150, 267, 'price', '50'),
(1151, 267, 'sku_code', '132312'),
(1152, 267, 'inventory_management', '1'),
(1153, 267, 'quantity', '300'),
(1154, 267, 'compare_price', '40'),
(1155, 267, 'barcode', '12312'),
(1156, 267, 'disable_out_of_stock', '1'),
(1157, 267, 'badge', 'new'),
(1158, 267, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1159, 267, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1160, 267, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1161, 267, 'downloadable', '0'),
(1162, 266, 'price', '300'),
(1163, 266, 'sku_code', '312312'),
(1164, 266, 'inventory_management', '1'),
(1165, 266, 'quantity', '300'),
(1166, 266, 'compare_price', '340'),
(1167, 266, 'barcode', '12312'),
(1168, 266, 'disable_out_of_stock', '1'),
(1169, 266, 'badge', 'sale'),
(1170, 266, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1171, 266, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1172, 266, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1173, 266, 'downloadable', '0'),
(1174, 256, 'price', '320'),
(1175, 256, 'sku_code', '1221'),
(1176, 256, 'inventory_management', '1'),
(1177, 256, 'quantity', '300'),
(1178, 256, 'compare_price', '340'),
(1179, 256, 'barcode', '1321'),
(1180, 256, 'disable_out_of_stock', '1'),
(1181, 256, 'badge', 'new'),
(1182, 256, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1183, 256, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1184, 256, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1185, 256, 'downloadable', '0'),
(1186, 258, 'price', '540'),
(1187, 258, 'sku_code', '13213'),
(1188, 258, 'inventory_management', '1'),
(1189, 258, 'quantity', '300'),
(1190, 258, 'compare_price', '430'),
(1191, 258, 'barcode', '132312'),
(1192, 258, 'disable_out_of_stock', '1'),
(1193, 258, 'badge', 'best'),
(1194, 258, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1195, 258, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1196, 258, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1197, 258, 'downloadable', '0'),
(1198, 259, 'price', '460'),
(1199, 259, 'sku_code', '13131'),
(1200, 259, 'inventory_management', '1'),
(1201, 259, 'quantity', '300'),
(1202, 259, 'compare_price', '332'),
(1203, 259, 'barcode', '2312312'),
(1204, 259, 'disable_out_of_stock', '1'),
(1205, 259, 'badge', 'hot'),
(1206, 259, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1207, 259, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1208, 259, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1209, 259, 'downloadable', '0'),
(1210, 260, 'price', '760'),
(1211, 260, 'sku_code', '123123'),
(1212, 260, 'inventory_management', '1'),
(1213, 260, 'quantity', '300'),
(1214, 260, 'compare_price', '500'),
(1215, 260, 'barcode', 'qweqwe'),
(1216, 260, 'disable_out_of_stock', '1'),
(1217, 260, 'badge', 'top'),
(1218, 260, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1219, 260, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1220, 260, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1221, 260, 'downloadable', '0'),
(1222, 262, 'price', '110'),
(1223, 262, 'sku_code', '123123'),
(1224, 262, 'inventory_management', '1'),
(1225, 262, 'quantity', '300'),
(1226, 262, 'compare_price', '213'),
(1227, 262, 'barcode', '123123'),
(1228, 262, 'disable_out_of_stock', '1'),
(1229, 262, 'badge', 'sale'),
(1230, 262, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1231, 262, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1232, 262, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1233, 262, 'downloadable', '0'),
(1234, 264, 'price', '213'),
(1235, 264, 'sku_code', '123123'),
(1236, 264, 'inventory_management', '1'),
(1237, 264, 'quantity', '300'),
(1238, 264, 'compare_price', '234'),
(1239, 264, 'barcode', '21312'),
(1240, 264, 'disable_out_of_stock', '1'),
(1241, 264, 'badge', 'new'),
(1242, 264, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1243, 264, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1244, 264, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1245, 264, 'downloadable', '0'),
(1246, 265, 'price', '320'),
(1247, 265, 'sku_code', '1312312');
INSERT INTO `app_post_metas` (`id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1248, 265, 'inventory_management', '1'),
(1249, 265, 'quantity', '300'),
(1250, 265, 'compare_price', '430'),
(1251, 265, 'barcode', '123123'),
(1252, 265, 'disable_out_of_stock', '1'),
(1253, 265, 'badge', 'top'),
(1254, 265, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1255, 265, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1256, 265, 'images', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]'),
(1257, 265, 'downloadable', '0'),
(1258, 268, 'price', '300'),
(1259, 268, 'sku_code', '123123'),
(1260, 268, 'inventory_management', '1'),
(1261, 268, 'quantity', '345'),
(1262, 268, 'compare_price', '340'),
(1263, 268, 'barcode', '122321'),
(1264, 268, 'disable_out_of_stock', '1'),
(1265, 268, 'badge', 'hot'),
(1266, 268, 'additional_information', 'Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci phaedrum. There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some injected or words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrang hidden in the middle of text.\r\n\r\nQuas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo'),
(1267, 268, 'short_description', 'The power to be found between the pages of a book is formidable, indeed. And these 80 inspiring quotes about books and importance of reading are here to remind you of that. From beloved bestsellers to iconic celebrities, these quotes exemplify the benefits of reading and of a good books to comfort, challenge, and inspire you.'),
(1268, 268, 'images', '[\"2025\\/08\\/14\\/product-details-img-1-1.png\",\"2025\\/08\\/14\\/product-details-img-2-1.png\",\"2025\\/08\\/14\\/product-details-img-3-1.png\"]'),
(1269, 268, 'downloadable', '0'),
(1270, 268, 'vendor_id', '54');

-- --------------------------------------------------------

--
-- Table structure for table `app_post_ratings`
--

CREATE TABLE `app_post_ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `client_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_post_views`
--

CREATE TABLE `app_post_views` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `views` bigint NOT NULL DEFAULT '0',
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_post_views`
--

INSERT INTO `app_post_views` (`id`, `post_id`, `views`, `day`) VALUES
(14, 17, 2, '2025-02-14'),
(15, 17, 3, '2025-02-15'),
(18, 17, 1, '2025-02-16'),
(21, 17, 1, '2025-02-19'),
(22, 17, 34, '2025-02-21'),
(24, 17, 2, '2025-02-22'),
(26, 17, 4, '2025-02-23'),
(29, 17, 6, '2025-02-24'),
(30, 18, 1, '2025-02-24'),
(33, 17, 3, '2025-02-27'),
(36, 18, 1, '2025-02-27'),
(39, 17, 1, '2025-02-28'),
(40, 18, 1, '2025-02-28'),
(46, 17, 4, '2025-03-01'),
(47, 18, 2, '2025-03-01'),
(51, 17, 2, '2025-03-02'),
(60, 18, 1, '2025-03-02'),
(61, 17, 5, '2025-03-03'),
(62, 17, 1, '2025-03-03'),
(65, 18, 8, '2025-03-03'),
(67, 17, 8, '2025-03-04'),
(70, 18, 12, '2025-03-04'),
(73, 17, 1, '2025-03-05'),
(74, 22, 2, '2025-03-05'),
(80, 17, 2, '2025-03-06'),
(81, 17, 6, '2025-03-07'),
(86, 18, 20, '2025-03-07'),
(88, 17, 1, '2025-03-08'),
(90, 18, 1, '2025-03-08'),
(96, 17, 2, '2025-03-09'),
(99, 17, 1, '2025-03-19'),
(105, 17, 4, '2025-03-21'),
(106, 18, 3, '2025-03-21'),
(116, 22, 1, '2025-04-02'),
(119, 17, 1, '2025-04-02'),
(120, 18, 1, '2025-04-02'),
(121, 17, 2, '2025-04-03'),
(129, 133, 1, '2025-04-08'),
(136, 22, 1, '2025-04-08'),
(137, 151, 1, '2025-04-08'),
(140, 17, 1, '2025-04-08'),
(147, 151, 1, '2025-04-09'),
(152, 133, 1, '2025-04-09'),
(158, 17, 1, '2025-04-09'),
(159, 18, 1, '2025-04-09'),
(160, 151, 1, '2025-04-11'),
(162, 133, 1, '2025-04-11'),
(164, 17, 1, '2025-04-11'),
(165, 18, 1, '2025-04-11'),
(166, 22, 1, '2025-04-11'),
(170, 152, 1, '2025-04-12'),
(173, 133, 1, '2025-04-12'),
(174, 22, 1, '2025-04-12'),
(175, 133, 1, '2025-04-13'),
(176, 22, 1, '2025-04-13'),
(181, 17, 1, '2025-04-17'),
(183, 133, 1, '2025-04-17'),
(184, 151, 1, '2025-04-17'),
(185, 22, 1, '2025-04-17'),
(199, 151, 1, '2025-04-19'),
(204, 151, 1, '2025-04-21'),
(207, 22, 1, '2025-04-21'),
(229, 151, 1, '2025-06-04'),
(233, 22, 2, '2025-06-04'),
(236, 170, 1, '2025-06-04'),
(240, 22, 1, '2025-06-05'),
(244, 152, 1, '2025-06-06'),
(245, 22, 1, '2025-06-06'),
(246, 151, 1, '2025-06-06'),
(254, 151, 3, '2025-06-08'),
(256, 22, 3, '2025-06-08'),
(264, 151, 1, '2025-06-09'),
(266, 22, 1, '2025-06-09'),
(271, 22, 1, '2025-06-14'),
(282, 22, 3, '2025-06-17'),
(286, 170, 1, '2025-06-17'),
(295, 151, 1, '2025-06-17'),
(301, 151, 4, '2025-06-20'),
(310, 170, 4, '2025-06-20'),
(311, 22, 4, '2025-06-20'),
(329, 151, 1, '2025-06-30'),
(331, 170, 1, '2025-06-30'),
(332, 22, 1, '2025-06-30'),
(340, 18, 2, '2025-08-04'),
(344, 18, 1, '2025-08-06'),
(349, 18, 1, '2025-08-07'),
(352, 18, 1, '2025-08-08'),
(355, 18, 2, '2025-08-09'),
(358, 191, 2, '2025-08-10'),
(360, 191, 6, '2025-08-11'),
(362, 195, 2, '2025-08-12'),
(363, 203, 1, '2025-08-12'),
(364, 204, 1, '2025-08-12'),
(365, 205, 1, '2025-08-12'),
(366, 202, 1, '2025-08-12'),
(367, 22, 1, '2025-08-12'),
(369, 206, 1, '2025-08-12'),
(370, 207, 1, '2025-08-12'),
(371, 210, 1, '2025-08-12'),
(372, 218, 1, '2025-08-12'),
(374, 206, 1, '2025-08-13'),
(375, 170, 1, '2025-08-13'),
(376, 222, 1, '2025-08-13'),
(378, 170, 1, '2025-08-14'),
(379, 222, 1, '2025-08-14'),
(380, 223, 1, '2025-08-14'),
(381, 224, 1, '2025-08-14'),
(382, 225, 1, '2025-08-14'),
(383, 226, 1, '2025-08-14'),
(384, 227, 1, '2025-08-14'),
(385, 228, 1, '2025-08-14'),
(388, 238, 1, '2025-08-14'),
(389, 229, 1, '2025-08-14'),
(390, 232, 1, '2025-08-14'),
(391, 245, 1, '2025-08-14'),
(392, 246, 1, '2025-08-14'),
(393, 241, 1, '2025-08-14'),
(394, 233, 1, '2025-08-14'),
(395, 151, 1, '2025-08-14'),
(396, 250, 9, '2025-08-14'),
(397, 191, 1, '2025-08-14'),
(398, 252, 2, '2025-08-14'),
(399, 199, 1, '2025-08-14'),
(400, 253, 1, '2025-08-14'),
(401, 254, 2, '2025-08-14'),
(402, 255, 4, '2025-08-14'),
(403, 18, 1, '2025-08-14'),
(404, 22, 1, '2025-08-14'),
(405, 252, 2, '2025-08-15'),
(406, 170, 2, '2025-08-15'),
(407, 250, 6, '2025-08-15'),
(408, 253, 1, '2025-08-15'),
(409, 151, 1, '2025-08-15'),
(410, 246, 1, '2025-08-15'),
(411, 245, 1, '2025-08-15'),
(412, 238, 1, '2025-08-15'),
(413, 227, 1, '2025-08-15'),
(414, 223, 1, '2025-08-15'),
(415, 224, 1, '2025-08-15'),
(416, 225, 1, '2025-08-15'),
(417, 206, 1, '2025-08-15'),
(418, 218, 1, '2025-08-15'),
(419, 219, 1, '2025-08-15'),
(420, 254, 2, '2025-08-15'),
(421, 204, 1, '2025-08-15'),
(422, 205, 1, '2025-08-15'),
(423, 203, 1, '2025-08-15'),
(424, 202, 2, '2025-08-15'),
(425, 191, 2, '2025-08-15'),
(426, 195, 1, '2025-08-15'),
(427, 198, 1, '2025-08-15'),
(428, 199, 1, '2025-08-15'),
(429, 200, 1, '2025-08-15'),
(430, 268, 2, '2025-08-15'),
(431, 257, 1, '2025-08-15'),
(432, 258, 1, '2025-08-15'),
(433, 260, 1, '2025-08-15'),
(434, 266, 1, '2025-08-15'),
(435, 255, 1, '2025-08-15'),
(436, 264, 1, '2025-08-15'),
(437, 22, 2, '2025-08-15'),
(438, 18, 2, '2025-08-15'),
(439, 250, 4, '2025-08-16'),
(440, 250, 1, '2025-09-19'),
(441, 250, 1, '2025-09-20'),
(442, 250, 16, '2025-09-21'),
(443, 254, 2, '2025-09-21'),
(444, 18, 2, '2025-09-21'),
(445, 252, 1, '2025-09-21'),
(446, 191, 1, '2025-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `app_pos_carts`
--

CREATE TABLE `app_pos_carts` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pos_session_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Walk-in Customer',
  `customer_phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `items` json DEFAULT NULL,
  `discounts` json DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','converted','abandoned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_pos_carts`
--

INSERT INTO `app_pos_carts` (`id`, `cart_token`, `user_id`, `pos_session_id`, `customer_name`, `customer_phone`, `customer_email`, `items`, `discounts`, `subtotal`, `tax_amount`, `discount_amount`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(10, 'pos_cart_68ced29fd1004_1758384799', 15, 2, 'Walk-in Customer', NULL, NULL, '{\"259_40cd750bba9870f18aada2478b24840a\": {\"name\": \"ski helmet with visor\", \"price\": 460, \"total\": 460, \"options\": [], \"post_id\": 259, \"quantity\": 1, \"subtotal\": 460, \"thumbnail\": \"/storage/2025/08/14/shop-product-1-5.png\"}}', '[]', 460.00, 0.00, 0.00, 460.00, 'active', '2025-09-20 10:13:19', '2025-09-20 11:47:12'),
(11, 'pos_cart_68cf57d7970f2_1758418903', 15, 2, 'Walk-in Customer', NULL, NULL, '{\"268_40cd750bba9870f18aada2478b24840a\": {\"name\": \"snowboard boot William\", \"price\": 300, \"total\": 300, \"options\": [], \"post_id\": 268, \"quantity\": 1, \"subtotal\": 300, \"thumbnail\": \"/storage/2025/08/14/shop-product-1-2-1.png\"}}', '[]', 300.00, 0.00, 0.00, 300.00, 'active', '2025-09-20 19:41:43', '2025-09-20 19:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `app_pos_orders`
--

CREATE TABLE `app_pos_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pos_session_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Walk-in Customer',
  `customer_phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL,
  `paid_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `change_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `payment_method` enum('cash','card','digital') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status` enum('pending','completed','hold','cancelled','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `order_data` json DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_pos_orders`
--

INSERT INTO `app_pos_orders` (`id`, `order_number`, `user_id`, `pos_session_id`, `customer_name`, `customer_phone`, `customer_email`, `subtotal`, `tax_amount`, `discount_amount`, `total_amount`, `paid_amount`, `change_amount`, `payment_method`, `status`, `notes`, `order_data`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 'POS-20250920091622-511', 15, NULL, 'Walk-in Customer', '0609482502', 'raofahmedmojahid@gmail.com', 40.00, 2.00, 2.00, 50.00, 20.00, 0.00, 'cash', 'pending', 'Notes', NULL, NULL, '2025-09-20 03:16:49', '2025-09-20 03:16:49'),
(3, 'POS-20250920142227-272', 15, NULL, 'Walk-in Customer', NULL, NULL, 333.00, 0.00, 0.00, 333.00, 0.00, 0.00, 'cash', 'hold', NULL, '{\"items\": [{\"id\": \"268\", \"sku\": null, \"name\": \"snowboard boot William\", \"price\": \"300\", \"quantity\": \"1\"}, {\"id\": \"255\", \"sku\": null, \"name\": \"Rendering metallic ai\", \"price\": \"33\", \"quantity\": \"1\"}], \"held_at\": \"2025-09-20T14:22:27.037137Z\", \"discounts\": []}', NULL, '2025-09-20 08:22:27', '2025-09-20 08:22:27'),
(5, 'POS-20250920155858-941', 15, 2, 'Walk-in Customer', '3213213', 'mojarsoft@gmail.com', 66.00, 0.00, 0.00, 66.00, 30.00, 0.00, 'card', 'completed', NULL, NULL, '2025-09-20 09:58:58', '2025-09-20 09:58:58', '2025-09-20 09:58:58'),
(7, 'POS-20250920163820-507', 15, 2, 'Walk-in Customer', NULL, NULL, 33.00, 0.00, 0.00, 33.00, 30.00, 0.00, 'card', 'completed', NULL, NULL, '2025-09-20 10:38:20', '2025-09-20 10:38:20', '2025-09-20 10:38:20'),
(8, 'POS-20250920170015-361', 15, 2, 'Walk-in Customer', NULL, NULL, 320.00, 0.00, 0.00, 320.00, 20.00, 0.00, 'card', 'completed', NULL, NULL, '2025-09-20 11:00:15', '2025-09-20 11:00:15', '2025-09-20 11:00:15'),
(9, 'POS-20250920170748-673', 15, 2, 'Walk-in Customer', NULL, NULL, 860.00, 0.00, 0.00, 860.00, 130.00, 0.00, 'cash', 'completed', NULL, NULL, '2025-09-20 11:07:48', '2025-09-20 11:07:48', '2025-09-20 11:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `app_pos_order_items`
--

CREATE TABLE `app_pos_order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `pos_order_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` decimal(15,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL,
  `product_data` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_pos_order_items`
--

INSERT INTO `app_pos_order_items` (`id`, `pos_order_id`, `post_id`, `product_name`, `product_sku`, `product_price`, `quantity`, `subtotal`, `discount_amount`, `tax_amount`, `total_amount`, `product_data`, `notes`, `created_at`, `updated_at`) VALUES
(1, 5, 255, 'Rendering metallic ai', NULL, 33.00, 2, 66.00, 0.00, 0.00, 66.00, '{\"name\": \"Rendering metallic ai\", \"price\": 33, \"total\": 66, \"options\": [], \"post_id\": 255, \"quantity\": 2, \"subtotal\": 66}', NULL, '2025-09-20 09:58:58', '2025-09-20 09:58:58'),
(2, 7, 255, 'Rendering metallic ai', NULL, 33.00, 1, 33.00, 0.00, 0.00, 33.00, '{\"name\": \"Rendering metallic ai\", \"price\": 33, \"total\": 33, \"options\": [], \"post_id\": 255, \"quantity\": 1, \"subtotal\": 33, \"thumbnail\": \"/storage/2025/08/14/shop-product-1-1.png\"}', NULL, '2025-09-20 10:38:21', '2025-09-20 10:38:21'),
(3, 8, 256, '3d render robo', NULL, 320.00, 1, 320.00, 0.00, 0.00, 320.00, '{\"name\": \"3d render robo\", \"price\": 320, \"total\": 320, \"options\": [], \"post_id\": 256, \"quantity\": 1, \"subtotal\": 320, \"thumbnail\": \"/storage/2025/08/14/shop-product-1-4.png\"}', NULL, '2025-09-20 11:00:17', '2025-09-20 11:00:17'),
(4, 9, 256, '3d render robo', NULL, 320.00, 1, 320.00, 0.00, 0.00, 320.00, '{\"name\": \"3d render robo\", \"price\": 320, \"total\": 320, \"options\": [], \"post_id\": 256, \"quantity\": 1, \"subtotal\": 320, \"thumbnail\": \"/storage/2025/08/14/shop-product-1-4.png\"}', NULL, '2025-09-20 11:07:50', '2025-09-20 11:07:50'),
(5, 9, 258, 'robot gesturing', NULL, 540.00, 1, 540.00, 0.00, 0.00, 540.00, '{\"name\": \"robot gesturing\", \"price\": 540, \"total\": 540, \"options\": [], \"post_id\": 258, \"quantity\": 1, \"subtotal\": 540, \"thumbnail\": \"/storage/2025/08/14/shop-product-1-2.png\"}', NULL, '2025-09-20 11:07:50', '2025-09-20 11:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `app_pos_sessions`
--

CREATE TABLE `app_pos_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `session_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `closing_balance` decimal(15,2) DEFAULT NULL,
  `expected_balance` decimal(15,2) DEFAULT NULL,
  `total_cash_sales` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_card_sales` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_digital_sales` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_transactions` int NOT NULL DEFAULT '0',
  `status` enum('active','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `opened_at` timestamp NOT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `session_data` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_pos_sessions`
--

INSERT INTO `app_pos_sessions` (`id`, `user_id`, `session_name`, `opening_balance`, `closing_balance`, `expected_balance`, `total_cash_sales`, `total_card_sales`, `total_digital_sales`, `total_transactions`, `status`, `opened_at`, `closed_at`, `session_data`, `notes`, `created_at`, `updated_at`) VALUES
(2, 15, 'Session 2025-09-20 15:55', 2100.00, NULL, 2300.00, 860.00, 419.00, 0.00, 4, 'active', '2025-09-20 09:56:25', NULL, NULL, 'Notes', '2025-09-20 09:56:25', '2025-09-20 11:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `app_product_variants`
--

CREATE TABLE `app_product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `sku_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `names` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `price` decimal(15,2) DEFAULT NULL,
  `compare_price` decimal(15,2) DEFAULT NULL,
  `stock_quantity` int NOT NULL DEFAULT '0',
  `reserved_quantity` int NOT NULL DEFAULT '0',
  `track_stock` tinyint(1) NOT NULL DEFAULT '1',
  `allow_backorder` tinyint(1) NOT NULL DEFAULT '0',
  `low_stock_threshold` int NOT NULL DEFAULT '10',
  `stock_status` enum('in_stock','low_stock','out_of_stock','backorder') NOT NULL DEFAULT 'in_stock',
  `type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `post_id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_product_variants`
--

INSERT INTO `app_product_variants` (`id`, `sku_code`, `barcode`, `title`, `thumbnail`, `description`, `names`, `images`, `price`, `compare_price`, `stock_quantity`, `reserved_quantity`, `track_stock`, `allow_backorder`, `low_stock_threshold`, `stock_status`, `type`, `post_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(3, '1312312312', '1231212321', 'Default', '2025/08/14/shop-product-1-1.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 33.00, 32.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 255, NULL, '2025-08-14 14:26:41', '2025-08-14 15:09:27'),
(4, '132312', '12312', 'Default', '2025/08/14/shop-product-1-6.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 50.00, 40.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 267, NULL, '2025-08-14 16:14:28', '2025-08-14 16:14:28'),
(5, '312312', '12312', 'Default', '2025/08/14/shop-product-1-5.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 300.00, 340.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 266, NULL, '2025-08-14 16:15:22', '2025-08-14 16:16:15'),
(6, '1221', '1321', 'Default', '2025/08/14/shop-product-1-4.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 320.00, 340.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 256, NULL, '2025-08-14 16:17:54', '2025-08-14 16:17:54'),
(7, '13213', '132312', 'Default', '2025/08/14/shop-product-1-2.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 540.00, 430.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 258, NULL, '2025-08-14 16:20:12', '2025-08-14 16:20:12'),
(8, '13131', '2312312', 'Default', '2025/08/14/shop-product-1-5.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 460.00, 332.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 259, NULL, '2025-08-14 16:21:43', '2025-08-14 16:21:43'),
(9, '123123', 'qweqwe', 'Default', '2025/08/14/shop-product-1-6.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 760.00, 500.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 260, NULL, '2025-08-14 16:23:17', '2025-08-14 16:23:17'),
(10, '123123', '123123', 'Default', '2025/08/14/shop-product-1-2.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 110.00, 213.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 262, NULL, '2025-08-14 16:24:39', '2025-08-14 16:24:39'),
(11, '123123', '21312', 'Default', '2025/08/14/shop-product-1-3.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 213.00, 234.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 264, NULL, '2025-08-14 16:25:43', '2025-08-14 16:25:43'),
(12, '1312312', '123123', 'Default', '2025/08/14/shop-product-1-4.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1.png\",\"2025\\/08\\/14\\/product-details-img-2.png\",\"2025\\/08\\/14\\/product-details-img-3.png\"]', 320.00, 430.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 265, NULL, '2025-08-14 16:26:17', '2025-08-14 16:26:17'),
(13, '123123', '122321', 'Default', '2025/08/14/shop-product-1-2-1.png', '\r I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,...', '[\"Default\"]', '[\"2025\\/08\\/14\\/product-details-img-1-1.png\",\"2025\\/08\\/14\\/product-details-img-2-1.png\",\"2025\\/08\\/14\\/product-details-img-3-1.png\"]', 300.00, 340.00, 0, 0, 1, 0, 10, 'in_stock', 'default', 268, 54, '2025-08-14 17:17:57', '2025-08-14 17:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `app_product_variants_attribute_values`
--

CREATE TABLE `app_product_variants_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_resources`
--

CREATE TABLE `app_resources` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT '1',
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_resources`
--

INSERT INTO `app_resources` (`id`, `name`, `type`, `thumbnail`, `description`, `json_metas`, `status`, `post_id`, `parent_id`, `created_at`, `updated_at`, `display_order`, `slug`, `uuid`) VALUES
(1, 'name', 'contact-forms', NULL, NULL, NULL, 'publish', NULL, NULL, '2025-03-05 00:46:42', '2025-03-05 00:46:42', 1, 'name', 'bf93479b-78db-442b-9629-4093d546e441');

-- --------------------------------------------------------

--
-- Table structure for table `app_resource_metas`
--

CREATE TABLE `app_resource_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `resource_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_roles`
--

CREATE TABLE `app_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_roles`
--

INSERT INTO `app_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(11, 'customer', 'web', '2025-08-08 11:38:34', '2025-08-08 11:38:34', 'Ecommerce customer role with order and profile management'),
(12, 'vendor', 'web', '2025-08-08 11:38:34', '2025-08-08 11:38:34', 'Ecommerce vendor role with product and order management');

-- --------------------------------------------------------

--
-- Table structure for table `app_role_has_permissions`
--

CREATE TABLE `app_role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_role_has_permissions`
--

INSERT INTO `app_role_has_permissions` (`permission_id`, `role_id`) VALUES
(115, 11),
(116, 11),
(117, 11),
(118, 11),
(119, 11),
(59, 12),
(60, 12),
(61, 12),
(62, 12),
(87, 12),
(91, 12),
(95, 12),
(96, 12),
(97, 12),
(99, 12),
(101, 12),
(102, 12),
(103, 12),
(104, 12),
(105, 12),
(106, 12),
(115, 12),
(116, 12),
(117, 12),
(118, 12),
(119, 12);

-- --------------------------------------------------------

--
-- Table structure for table `app_search`
--

CREATE TABLE `app_search` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `post_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_seo_metas`
--

CREATE TABLE `app_seo_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `object_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` bigint UNSIGNED NOT NULL,
  `meta_title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(320) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_seo_metas`
--

INSERT INTO `app_seo_metas` (`id`, `object_type`, `object_id`, `meta_title`, `meta_description`) VALUES
(1, 'posts', 12, 'sdsad', NULL),
(2, 'posts', 148, '12 Things Successful Mompreneurs', 'Description Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit...');

-- --------------------------------------------------------

--
-- Table structure for table `app_shipping_address`
--

CREATE TABLE `app_shipping_address` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `province` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_id` bigint DEFAULT NULL,
  `order_id` bigint NOT NULL,
  `shop_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_shipping_methods`
--

CREATE TABLE `app_shipping_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `province_id` bigint NOT NULL,
  `country_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `shop_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_single_taxonomies`
--

CREATE TABLE `app_single_taxonomies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `taxonomy` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_post` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_single_taxonomy_metas`
--

CREATE TABLE `app_single_taxonomy_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `taxonomy_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_social_tokens`
--

CREATE TABLE `app_social_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `social_provider` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_refresh_token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_social_tokens`
--

INSERT INTO `app_social_tokens` (`id`, `user_id`, `social_provider`, `social_id`, `social_token`, `social_refresh_token`) VALUES
(1, 55, 'google', '116916839043523606999', 'ya29.A0AS3H6NxbD_RYRLJdGWhhRB17dO0gFEdXIxS2_LfWiS77nbRUkwyOOgRDVKQh3fuXgqJcIEY6wq8cUHS7tdh-PwG6eovBR-k0LWtswCLl6LZCEz-Dr53K4pLGFpOA4qFZ09S3P9JRBP74dA6EjPNptRlM589g3hL_5JgMCHXpUgzUX8ZeRJcaoyY3SZ8EiNihV5r16dMaCgYKAWASARMSFQHGX2MidvTe2GCREFxA3FLsz3z7Pw0206', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_sticket_ticket_supports`
--

CREATE TABLE `app_sticket_ticket_supports` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_type_id` bigint UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `priority` enum('low','medium','high','urgent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `rating` int DEFAULT NULL,
  `rating_feedback` text COLLATE utf8mb4_unicode_ci,
  `rated_at` timestamp NULL DEFAULT NULL,
  `auto_close_at` timestamp NULL DEFAULT NULL,
  `last_activity_at` timestamp NULL DEFAULT NULL,
  `escalated_at` timestamp NULL DEFAULT NULL,
  `escalated_to` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` bigint UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `first_response_at` timestamp NULL DEFAULT NULL,
  `response_time_minutes` int DEFAULT NULL,
  `customer_satisfaction_score` int DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `category` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `sla_deadline` timestamp NULL DEFAULT NULL,
  `sla_breached` tinyint(1) NOT NULL DEFAULT '0',
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `app_sticket_ticket_supports`
--

INSERT INTO `app_sticket_ticket_supports` (`id`, `support_type_id`, `title`, `content`, `status`, `priority`, `rating`, `rating_feedback`, `rated_at`, `auto_close_at`, `last_activity_at`, `escalated_at`, `escalated_to`, `assigned_to`, `assigned_at`, `first_response_at`, `response_time_minutes`, `customer_satisfaction_score`, `tags`, `category`, `external_id`, `source`, `sla_deadline`, `sla_breached`, `product_id`, `created_by`, `created_at`, `updated_at`) VALUES
('70731e56-8a1a-4480-89c4-e712d5ecae3a', 2, 'Payment not reflecting', 'I made a payment yesterday but it’s still not showing in my account. Can you check?', 'pending', 'high', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, 0, NULL, 15, '2025-08-15 12:16:08', '2025-08-15 12:16:08'),
('91cd5536-854e-4747-9f57-535020a45d4b', 3, 'Website down for my account', 'I’m getting a “server error” whenever I try to log in.', 'pending', 'medium', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, 0, NULL, 15, '2025-08-15 12:16:40', '2025-08-15 12:16:40'),
('af1347d6-9acf-4044-8331-037969e5ec75', 1, 'Ticket Subject', 'Ticket Description', 'closed', 'medium', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, 0, NULL, NULL, '2025-08-05 10:37:03', '2025-08-05 10:38:21'),
('e1a93688-abe1-4d2c-8243-c680a4aef229', 1, 'Ticket Subject', 'Ticket Description', 'replied', 'medium', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, 0, NULL, 15, '2025-08-05 02:28:30', '2025-08-05 07:27:50'),
('e596058d-83de-4f0e-b06d-076c07e679ab', 3, 'Incidunt sunt dist', 'Reprehenderit inven', 'replied', 'medium', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, 0, NULL, 15, '2025-08-05 00:28:32', '2025-08-05 00:28:44'),
('fb208616-b684-4f76-b3ad-756114bb34e6', 5, 'Porro exercitation a', 'Distinctio Velit n', 'closed', 'urgent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, 0, NULL, 15, '2025-08-05 08:08:35', '2025-08-05 08:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `app_sticket_ticket_support_attachments`
--

CREATE TABLE `app_sticket_ticket_support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_support_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minetype` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_sticket_ticket_support_comments`
--

CREATE TABLE `app_sticket_ticket_support_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_support_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_sticket_ticket_support_types`
--

CREATE TABLE `app_sticket_ticket_support_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_sticket_ticket_support_types`
--

INSERT INTO `app_sticket_ticket_support_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sales', NULL, NULL),
(2, 'Billing', NULL, NULL),
(3, 'Technical Support', NULL, NULL),
(4, 'Other', NULL, NULL),
(5, 'sfdsf', '2025-08-05 00:24:07', '2025-08-05 00:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `app_table_groups`
--

CREATE TABLE `app_table_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_rows` bigint NOT NULL DEFAULT '0',
  `migrations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_table_group_datas`
--

CREATE TABLE `app_table_group_datas` (
  `id` bigint UNSIGNED NOT NULL,
  `table_group_id` bigint UNSIGNED NOT NULL,
  `table_group_table_id` bigint UNSIGNED NOT NULL,
  `table` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_table` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_table_group_tables`
--

CREATE TABLE `app_table_group_tables` (
  `id` bigint UNSIGNED NOT NULL,
  `table` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_table` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_group_id` bigint UNSIGNED NOT NULL,
  `total_rows` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_taxonomies`
--

CREATE TABLE `app_taxonomies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxonomy` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `total_post` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int NOT NULL DEFAULT '0',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_taxonomies`
--

INSERT INTO `app_taxonomies` (`id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `taxonomy`, `parent_id`, `total_post`, `created_at`, `updated_at`, `level`, `uuid`) VALUES
(44, 'Web Design & Development', NULL, NULL, 'web-design-development', 'posts', 'categories', NULL, 2, '2025-08-10 06:47:16', '2025-08-12 14:19:46', 0, 'f199564d-47a8-4a81-939d-084ea83c02e8'),
(45, 'Development', NULL, NULL, 'development', 'posts', 'tags', NULL, 1, '2025-08-10 06:47:33', '2025-08-10 06:52:56', 0, '29011839-7925-4b35-b0ec-b794800b5af4'),
(46, 'Innovation', NULL, NULL, 'innovation', 'posts', 'tags', NULL, 1, '2025-08-10 06:47:44', '2025-08-10 06:52:56', 0, '2e366a86-5bf4-4f42-8d9a-9e4fc40903e1'),
(47, 'Products Design', NULL, NULL, 'products-design', 'posts', 'categories', NULL, 6, '2025-08-12 13:32:59', '2025-08-12 14:19:46', 0, '7213ef27-a7ae-4f40-88b5-0b032db68544'),
(48, 'Innovation', NULL, NULL, 'innovation-1', 'posts', 'tags', NULL, 2, '2025-08-12 13:33:30', '2025-08-12 14:19:07', 0, '14eb8900-11f8-4b96-803d-3981f659e90e'),
(49, 'Artificial Intelligence', NULL, NULL, 'artificial-intelligence', 'posts', 'categories', NULL, 4, '2025-08-12 13:40:51', '2025-08-12 14:19:26', 0, '6e2bf947-dc35-4d00-a2f5-ddcf32856896'),
(50, 'Analytics', NULL, NULL, 'analytics', 'posts', 'tags', NULL, 4, '2025-08-12 13:41:03', '2025-08-12 14:19:46', 0, '3e2bffd6-bfc3-4ead-b141-69322a3564de'),
(51, 'Technology', NULL, NULL, 'technology', 'posts', 'categories', NULL, 1, '2025-08-12 13:41:50', '2025-08-12 13:42:08', 0, 'c456a5ee-d0bd-48fa-98cf-62379df03d82'),
(52, 'Marketing', NULL, NULL, 'marketing', 'posts', 'tags', NULL, 2, '2025-08-12 13:42:07', '2025-08-12 14:19:26', 0, '6f83eed4-1134-4bf3-acbd-6f2bc8dd94d6'),
(53, 'Technology', NULL, NULL, 'technology-1', 'posts', 'tags', NULL, 2, '2025-08-12 13:42:43', '2025-08-12 14:19:07', 0, '0cbf4889-e277-48b7-b766-fd4f9ab8093a'),
(54, 'Software', NULL, NULL, 'software', 'services', 'categories', NULL, 1, '2025-08-12 15:59:32', '2025-08-12 15:59:35', 0, '00dbb490-ea4e-4559-ad68-9e27b2999352'),
(55, 'agency', NULL, NULL, 'agency', 'faqs', 'categories', NULL, 1, '2025-08-12 16:22:23', '2025-08-12 16:22:30', 0, '190e49da-4690-4471-9a10-46f4c0c476c6'),
(56, 'software', NULL, NULL, 'software-1', 'faqs', 'categories', NULL, 1, '2025-08-12 16:24:47', '2025-08-12 16:24:52', 0, 'fa0bfef4-ebfc-4c9e-a106-d45082efdf2c'),
(57, 'consulting', NULL, NULL, 'consulting', 'faqs', 'categories', NULL, 2, '2025-08-12 16:25:29', '2025-08-12 16:28:54', 0, '729a4b31-b057-44cd-9061-b7b1f8d3ab2d'),
(58, 'Cybersecurity', NULL, NULL, 'cybersecurity', 'services', 'categories', NULL, 1, '2025-08-12 16:40:41', '2025-08-12 16:42:16', 0, '736d56a1-c4fb-4213-8f23-4bbfc99be392'),
(59, 'Cloud', NULL, NULL, 'cloud', 'services', 'categories', NULL, 1, '2025-08-12 16:43:19', '2025-08-12 16:43:42', 0, '8cabf2ff-6154-43e6-b84d-3217f3b5ae04'),
(60, 'Analytics', NULL, NULL, 'analytics-1', 'services', 'categories', NULL, 1, '2025-08-12 16:44:32', '2025-08-12 16:44:56', 0, '74c1416f-1337-40e7-8f6e-63316eab5fd3'),
(61, 'Web Development', NULL, NULL, 'web-development', 'portfolios', 'categories', NULL, 2, '2025-08-14 05:58:55', '2025-08-14 06:42:04', 0, '8f0cf184-c333-42cc-a572-d6bc85d1da9c'),
(62, 'Branding', NULL, NULL, 'branding', 'portfolios', 'categories', NULL, 2, '2025-08-14 05:59:01', '2025-08-14 06:41:01', 0, '20baf031-607a-4627-9be9-a2783536370e'),
(63, 'UI/UX Design', NULL, NULL, 'uiux-design', 'portfolios', 'categories', NULL, 3, '2025-08-14 06:37:54', '2025-08-14 10:08:22', 0, 'd702584a-731f-4061-9d62-c8a38ed8b330'),
(64, 'Product Design', NULL, NULL, 'product-design', 'portfolios', 'categories', NULL, 4, '2025-08-14 06:38:01', '2025-08-14 06:42:04', 0, '9c0ac23b-546f-4f59-9672-65aeb6062455'),
(65, 'Cyber Security', NULL, NULL, 'cyber-security', 'portfolios', 'categories', NULL, 1, '2025-08-14 06:39:50', '2025-08-14 06:39:55', 0, '4440f5a8-9833-48b3-920d-3bb1c3d1df4c'),
(66, 'A Tradition of Healing', NULL, NULL, 'a-tradition-of-healing', 'products', 'categories', NULL, 4, '2025-08-14 14:24:06', '2025-08-14 17:17:56', 0, 'f18e9ae2-eba0-4676-bff2-a989e287b927'),
(67, 'Development', NULL, NULL, 'development-1', 'products', 'tags', NULL, 1, '2025-08-14 14:24:16', '2025-08-14 14:26:41', 0, 'e8e63430-20e2-4821-b7bb-d5f7cc955afa'),
(68, 'Innovation', NULL, NULL, 'innovation-2', 'products', 'tags', NULL, 1, '2025-08-14 16:14:16', '2025-08-14 16:14:28', 0, 'ceca0366-c015-4833-a98b-75a4df511355'),
(69, 'Compassionate Care', NULL, NULL, 'compassionate-care', 'products', 'categories', NULL, 3, '2025-08-14 16:14:26', '2025-08-14 16:26:17', 0, '6344d44e-b7e8-46fb-b6f7-9b4b143953fc'),
(70, 'Caring for You, Always', NULL, NULL, 'caring-for-you-always', 'products', 'categories', NULL, 2, '2025-08-14 16:15:07', '2025-08-14 16:25:43', 0, '7a942fbe-374b-4b81-89b3-83a9a6bb8ac5'),
(71, 'Analytics', NULL, NULL, 'analytics-2', 'products', 'tags', NULL, 2, '2025-08-14 16:15:16', '2025-08-14 17:17:56', 0, '6479dba7-4aac-4c46-9723-6f69ded5d6f4'),
(72, 'Where Health Matters', NULL, NULL, 'where-health-matters', 'products', 'categories', NULL, 1, '2025-08-14 16:17:22', '2025-08-14 16:17:54', 0, '987b497b-e2e0-4808-948c-3285578c3abe'),
(73, 'Marketing', NULL, NULL, 'marketing-1', 'products', 'tags', NULL, 6, '2025-08-14 16:17:34', '2025-08-14 16:26:17', 0, '09c62bc6-51ac-4b22-93c7-59dcb1103b83'),
(74, 'Environtment Recyle', NULL, NULL, 'environtment-recyle', 'products', 'categories', NULL, 2, '2025-08-14 16:19:23', '2025-08-14 16:21:43', 0, '502352a2-a9b7-4dce-84ea-ac61eb4739b4'),
(75, 'Innovation', NULL, NULL, 'innovation-3', 'products', 'tags', NULL, 1, '2025-08-14 16:19:35', '2025-08-14 16:20:12', 0, '7f41b546-a627-4a1e-bc71-82e274b16f1c');

-- --------------------------------------------------------

--
-- Table structure for table `app_taxonomy_metas`
--

CREATE TABLE `app_taxonomy_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `taxonomy_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_telescope_entries`
--

CREATE TABLE `app_telescope_entries` (
  `sequence` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_telescope_entries_tags`
--

CREATE TABLE `app_telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_telescope_monitoring`
--

CREATE TABLE `app_telescope_monitoring` (
  `tag` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_term_taxonomies`
--

CREATE TABLE `app_term_taxonomies` (
  `term_id` bigint NOT NULL,
  `taxonomy_id` bigint NOT NULL,
  `term_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_term_taxonomies`
--

INSERT INTO `app_term_taxonomies` (`term_id`, `taxonomy_id`, `term_type`) VALUES
(1, 2, 'posts'),
(20, 5, 'events'),
(21, 5, 'events'),
(80, 6, 'courses'),
(82, 6, 'courses'),
(132, 5, 'events'),
(134, 7, 'posts'),
(134, 8, 'posts'),
(134, 9, 'posts'),
(134, 10, 'posts'),
(135, 7, 'posts'),
(135, 8, 'posts'),
(135, 9, 'posts'),
(135, 10, 'posts'),
(136, 7, 'posts'),
(136, 9, 'posts'),
(136, 11, 'posts'),
(136, 12, 'posts'),
(137, 9, 'posts'),
(137, 10, 'posts'),
(137, 11, 'posts'),
(138, 7, 'posts'),
(138, 9, 'posts'),
(138, 10, 'posts'),
(138, 11, 'posts'),
(139, 9, 'posts'),
(139, 12, 'posts'),
(140, 7, 'posts'),
(140, 9, 'posts'),
(140, 12, 'posts'),
(141, 8, 'posts'),
(141, 11, 'posts'),
(141, 12, 'posts'),
(142, 7, 'posts'),
(142, 10, 'posts'),
(142, 11, 'posts'),
(142, 12, 'posts'),
(143, 13, 'events'),
(143, 14, 'events'),
(143, 15, 'events'),
(143, 16, 'events'),
(144, 13, 'events'),
(144, 14, 'events'),
(144, 15, 'events'),
(144, 16, 'events'),
(145, 17, 'events'),
(145, 18, 'events'),
(145, 19, 'events'),
(146, 14, 'events'),
(146, 17, 'events'),
(146, 18, 'events'),
(147, 20, 'events'),
(147, 21, 'events'),
(147, 22, 'events'),
(148, 13, 'events'),
(148, 16, 'events'),
(148, 22, 'events'),
(149, 15, 'events'),
(149, 17, 'events'),
(149, 21, 'events'),
(150, 5, 'events'),
(150, 14, 'events'),
(150, 16, 'events'),
(153, 23, 'courses'),
(153, 24, 'courses'),
(155, 24, 'courses'),
(155, 26, 'courses'),
(155, 27, 'courses'),
(156, 25, 'courses'),
(156, 28, 'courses'),
(156, 29, 'courses'),
(157, 25, 'courses'),
(157, 30, 'courses'),
(157, 31, 'courses'),
(158, 26, 'courses'),
(158, 27, 'courses'),
(158, 29, 'courses'),
(159, 32, 'courses'),
(159, 33, 'courses'),
(160, 23, 'courses'),
(160, 24, 'courses'),
(160, 33, 'courses'),
(161, 28, 'courses'),
(161, 29, 'courses'),
(162, 29, 'courses'),
(162, 30, 'courses'),
(162, 31, 'courses'),
(177, 38, 'portfolios'),
(179, 39, 'portfolios'),
(180, 40, 'portfolios'),
(181, 39, 'portfolios'),
(181, 41, 'portfolios'),
(182, 39, 'portfolios'),
(182, 42, 'portfolios'),
(190, 33, 'products'),
(191, 44, 'posts'),
(191, 45, 'posts'),
(191, 46, 'posts'),
(195, 47, 'posts'),
(195, 48, 'posts'),
(196, 49, 'posts'),
(196, 50, 'posts'),
(197, 47, 'posts'),
(197, 50, 'posts'),
(197, 51, 'posts'),
(197, 52, 'posts'),
(198, 47, 'posts'),
(198, 49, 'posts'),
(198, 50, 'posts'),
(198, 53, 'posts'),
(199, 44, 'posts'),
(199, 47, 'posts'),
(199, 50, 'posts'),
(200, 47, 'posts'),
(200, 49, 'posts'),
(200, 52, 'posts'),
(201, 47, 'posts'),
(201, 48, 'posts'),
(201, 49, 'posts'),
(201, 53, 'posts'),
(210, 54, 'services'),
(211, 55, 'faqs'),
(212, 56, 'faqs'),
(213, 57, 'faqs'),
(214, 57, 'faqs'),
(219, 58, 'services'),
(220, 59, 'services'),
(221, 60, 'services'),
(228, 61, 'portfolios'),
(228, 62, 'portfolios'),
(229, 63, 'portfolios'),
(229, 64, 'portfolios'),
(230, 61, 'portfolios'),
(230, 64, 'portfolios'),
(231, 63, 'portfolios'),
(231, 64, 'portfolios'),
(232, 62, 'portfolios'),
(232, 64, 'portfolios'),
(233, 63, 'portfolios'),
(233, 65, 'portfolios'),
(251, 63, 'portfolios'),
(255, 66, 'products'),
(255, 67, 'products'),
(256, 72, 'products'),
(256, 73, 'products'),
(258, 74, 'products'),
(258, 75, 'products'),
(259, 73, 'products'),
(259, 74, 'products'),
(260, 69, 'products'),
(260, 73, 'products'),
(262, 66, 'products'),
(262, 73, 'products'),
(264, 70, 'products'),
(264, 73, 'products'),
(265, 66, 'products'),
(265, 69, 'products'),
(265, 73, 'products'),
(266, 70, 'products'),
(266, 71, 'products'),
(267, 68, 'products'),
(267, 69, 'products'),
(268, 66, 'products'),
(268, 71, 'products');

-- --------------------------------------------------------

--
-- Table structure for table `app_test_eomm_plugin`
--

CREATE TABLE `app_test_eomm_plugin` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_theme_configs`
--

CREATE TABLE `app_theme_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_theme_configs`
--

INSERT INTO `app_theme_configs` (`id`, `code`, `theme`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sidebar_sidebar', 'gamxo', '{\"uYdEqfrntd\":{\"title\":null,\"widget\":\"categories\",\"key\":\"uYdEqfrntd\"}}', '2025-01-28 10:57:41', '2025-01-28 10:57:41'),
(2, 'footer_bg_image', 'edufax', '2025/04/08/footer-bg.png', '2025-02-01 10:33:45', '2025-04-08 11:58:33'),
(3, 'sidebar_sidebar', 'edufax', '{\"IAyBP33RoN\":{\"title\":\"Search Here\",\"widget\":\"search_area\",\"key\":\"IAyBP33RoN\"},\"fuWc2TaLeM\":{\"title\":\"Categories\",\"custom_menu\":\"11\",\"widget\":\"categories_list\",\"key\":\"fuWc2TaLeM\"},\"JWqfyRRH5w\":{\"title\":\"Popular Posts\",\"post_type\":\"posts\",\"sort_by\":\"views\",\"widget\":\"popular_posts\",\"key\":\"JWqfyRRH5w\"}}', '2025-02-01 10:47:56', '2025-04-21 11:44:42'),
(4, 'nav_location', 'edufax', '{\"primary\":11,\"footer_2\":13,\"footer_bottom\":14}', '2025-02-01 12:47:07', '2025-04-21 11:42:40'),
(5, 'thumbnail_sizes', 'edufax', '{\"pages\":{\"width\":\"241\",\"height\":\"241\"},\"posts\":{\"width\":\"241\",\"height\":\"241\"},\"theme\":{\"width\":\"241\",\"height\":\"241\"},\"plugin\":{\"width\":\"241\",\"height\":\"241\"},\"products\":{\"width\":\"241\",\"height\":\"241\"},\"events\":{\"width\":\"241\",\"height\":\"241\"}}', '2025-03-07 09:51:39', '2025-03-07 09:51:39'),
(6, 'breadcrumb_bg_image', 'edufax', '2025/04/08/breadcrumb-bg.jpg', '2025-04-08 11:58:33', '2025-04-08 11:58:33'),
(7, 'sidebar_footer_1', 'edufax', '{\"lMxRisfdhg\":{\"logo\":\"2025\\/04\\/08\\/footer-logo.png\",\"logo_alt\":\"Logo\",\"description\":\"You made it so simple. My new site is so much faster and easier to work with than my old site. I just choose the page, make the change.\",\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-linkedin-in\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"},{\"icon\":\"fab fa-pinterest-p\",\"url\":\"#\"}],\"widget\":\"footer_1\",\"key\":\"lMxRisfdhg\"}}', '2025-04-08 17:26:22', '2025-04-08 17:27:30'),
(8, 'sidebar_footer_3', 'edufax', '{\"BprSfRLv27\":{\"title\":\"Get in touch\",\"address\":\"4543 Washington. Manchester,mukly 545322 USA\",\"phones\":[{\"number\":\"+088 (246) 642-27\"},{\"number\":\"+088 (246) 342-28\"}],\"email\":\"mail@example.com\",\"widget\":\"footer_3\",\"key\":\"BprSfRLv27\"}}', '2025-04-08 17:28:26', '2025-04-08 17:28:59'),
(9, 'sidebar_footer_4', 'edufax', '{\"gY1mb1R9oq\":{\"title\":\"Subscribe\",\"description\":\"You made it so simple. My new site is so much faster and easier to work with than my old site. I just choose the page, make the change.\",\"placeholder\":\"Subscribe\",\"button_text\":\"Subscribe\",\"widget\":\"footer_4\",\"key\":\"gY1mb1R9oq\"}}', '2025-04-08 17:30:15', '2025-04-08 17:30:15'),
(10, 'copy_right_text', 'edufax', 'EduFax © 2025, All Rights Reserved', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(11, 'enable_top_bar', 'edufax', '1', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(12, 'top_bar_text', 'edufax', 'Enroll now and get 40% off any course. Courses from $5.99.', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(13, 'enable_logout_button', 'edufax', '1', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(14, 'sidebar_sidebar', 'agenico', '{\"XzAqRp9cc5\":{\"title\":\"Search Anything\",\"widget\":\"search_area\",\"key\":\"XzAqRp9cc5\"},\"3sYy09yCpf\":{\"title\":\"Recent Post\",\"post_type\":\"posts\",\"sort_by\":\"created_at\",\"widget\":\"recent_post\",\"key\":\"3sYy09yCpf\"},\"NYs8MCZVfD\":{\"title\":\"Categories\",\"taxonomies\":[\"10\",\"12\"],\"widget\":\"categories\",\"key\":\"NYs8MCZVfD\"},\"oJ9fOIKZMs\":{\"title\":\"Tags\",\"type\":null,\"widget\":\"tags\",\"key\":\"oJ9fOIKZMs\"}}', '2025-06-04 00:48:22', '2025-06-30 15:35:49'),
(15, 'footer_bg_image', 'agenico', NULL, '2025-06-04 12:16:58', '2025-06-04 12:16:58'),
(16, 'breadcrumb_bg_image', 'agenico', NULL, '2025-06-04 12:16:58', '2025-06-04 12:16:58'),
(17, 'copy_right_text', 'agenico', '© 2025 Agenico. Powered by agenico', '2025-06-04 12:16:58', '2025-06-30 15:57:06'),
(18, 'enable_top_bar', 'agenico', '1', '2025-06-04 12:16:58', '2025-06-15 08:10:55'),
(19, 'top_bar_text', 'agenico', NULL, '2025-06-04 12:16:58', '2025-06-04 12:16:58'),
(20, 'enable_logout_button', 'agenico', '0', '2025-06-04 12:16:58', '2025-06-04 12:16:58'),
(21, 'is_footer_style_2', 'agenico', '1', '2025-06-04 12:16:58', '2025-06-15 08:10:55'),
(22, 'nav_location', 'agenico', '{\"primary\":15,\"footer_2\":16,\"footer_3\":17}', '2025-06-05 10:05:02', '2025-06-06 17:32:21'),
(23, 'sidebar_footer_1', 'agenico', '{\"wRzzQ2HPxv\":{\"logo\":\"2025\\/06\\/17\\/logo.png\",\"logo_alt\":\"agenico Logo\",\"description\":\"In today\\u2019s rapidly evolving tech landscape, businesses and leaders alike realize the importance of innovation and agility. By embracing change, organizations can stay ahead of the curve and drive sustainable success in an ever-shifting environment.\",\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-dribbble\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"},{\"icon\":\"fab fa-github\",\"url\":\"#\"}],\"widget\":\"footer_1\",\"key\":\"wRzzQ2HPxv\"}}', '2025-06-06 17:23:26', '2025-06-17 08:18:41'),
(24, 'sidebar_footer_4', 'agenico', '{\"TG2TlCMexS\":{\"title\":\"Newsletter\",\"description\":\"Sign up and receive the latest tips via email.\",\"placeholder\":\"Enter your mail address\",\"button_text\":\"Subscribe Now\",\"widget\":\"footer_4\",\"key\":\"TG2TlCMexS\"}}', '2025-06-06 17:26:16', '2025-06-06 17:26:16'),
(25, 'facebook_url', 'agenico', '#', '2025-06-06 17:32:53', '2025-06-15 08:10:55'),
(26, 'dribbble_url', 'agenico', '#', '2025-06-06 17:32:53', '2025-06-15 08:10:55'),
(27, 'github_url', 'agenico', '#', '2025-06-06 17:32:53', '2025-06-15 08:10:55'),
(28, 'twitter_url', 'agenico', '#', '2025-06-06 17:32:53', '2025-06-15 08:10:55'),
(29, 'email', 'agenico', NULL, '2025-06-06 17:32:53', '2025-06-06 17:32:53'),
(30, 'sidebar_footer_address', 'agenico', '{\"PxbBWfZRAJ\":{\"title\":\"Get In Touch\",\"hours\":\"Sun-Fri: 9:00-5:00\",\"email\":\"info@agenico.com\",\"phone\":\"1334 3849 9200\",\"address\":\"16\\/A New York, USA\",\"widget\":\"footer_address\",\"key\":\"PxbBWfZRAJ\"}}', '2025-06-06 17:36:21', '2025-06-06 17:36:21'),
(31, 'contact_button_url', 'agenico', '/contact', '2025-06-15 08:10:55', '2025-06-15 08:10:55'),
(32, 'contact_button_text', 'agenico', 'Get In Touch', '2025-06-15 08:10:55', '2025-06-15 08:11:12'),
(33, 'nav_location', 'techguru', '{\"primary\":19,\"footer_2\":20,\"footer_3\":21,\"footer_4\":22,\"top_bar_menu\":23}', '2025-08-08 10:22:47', '2025-08-15 08:55:09'),
(34, 'sidebar_sidebar', 'techguru', '{\"ZNZWu32XNn\":{\"title\":\"Search\",\"description\":\"Search blogs to discover a vast world of online content on countless topics.\",\"widget\":\"search_area\",\"key\":\"ZNZWu32XNn\"},\"u0aDygyzEV\":{\"title\":\"Category\",\"widget\":\"categories\",\"key\":\"u0aDygyzEV\"},\"i2nfSbP14c\":{\"title\":\"Recent Post\",\"post_type\":\"posts\",\"sort_by\":\"created_at\",\"widget\":\"recent_post\",\"key\":\"i2nfSbP14c\"},\"eGV46Zy11h\":{\"title\":\"Keywords\",\"type\":null,\"widget\":\"tags\",\"key\":\"eGV46Zy11h\"},\"mBrsV4vXV0\":{\"title\":\"Subscribe\",\"description\":\"Subscribe our newsletter to get everyday update about our blogs\",\"placeholder\":\"Email\",\"button_text\":\"Subcribe Now\",\"widget\":\"sidebar_newsletter\",\"key\":\"mBrsV4vXV0\"},\"Pq5j2VCzY1\":{\"client_image\":\"2025\\/08\\/10\\/sidebar-client-img-1.jpg\",\"client_name\":\"Jordan M. Walk\",\"client_role\":\"Digital Marketer\",\"client_description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\",\"social_title\":\"Follow Me\",\"social_links\":[{\"icon\":\"icon-facebook\",\"url\":\"https:\\/\\/www.facebook.com\\/\"},{\"icon\":\"icon-dribble\",\"url\":\"http:\\/\\/dribbble.com\\/\"},{\"icon\":\"icon-linkedin\",\"url\":\"http:\\/\\/linkedin.com\\/\"}],\"widget\":\"client_info_box\",\"key\":\"Pq5j2VCzY1\"}}', '2025-08-10 13:22:24', '2025-08-10 13:27:26'),
(35, 'footer_bg_image', 'techguru', NULL, '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(36, 'breadcrumb_bg_image', 'techguru', '2025/08/10/page-header-bg.jpg', '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(37, 'copy_right_text', 'techguru', 'ⓒ Copyright 2025 techguru All rights reserved', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(38, 'enable_top_bar', 'techguru', '1', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(39, 'top_bar_text', 'techguru', 'techguru That Ensures Your IT Runs Seamlessly, Anytime and Every Time', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(40, 'enable_logout_button', 'techguru', '1', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(41, 'is_footer_style_2', 'techguru', '0', '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(42, 'facebook_url', 'techguru', 'https://www.facebook.com/', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(43, 'dribble_url', 'techguru', 'http://dribbble.com/', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(44, 'github_url', 'techguru', NULL, '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(45, 'twitter_url', 'techguru', NULL, '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(46, 'linkedin_url', 'techguru', 'http://linkedin.com/', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(47, 'instagram_url', 'techguru', NULL, '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(48, 'youtube_url', 'techguru', NULL, '2025-08-10 13:30:19', '2025-08-10 13:30:19'),
(49, 'email', 'techguru', 'example@domain.com', '2025-08-10 13:30:19', '2025-08-10 13:33:47'),
(50, 'contact_button_url', 'techguru', '/contact', '2025-08-10 13:30:20', '2025-08-12 16:53:31'),
(51, 'contact_button_text', 'techguru', 'Get in Touch', '2025-08-10 13:30:20', '2025-08-12 16:53:31'),
(52, 'offcanvas_about_us_title', 'techguru', 'About Us', '2025-08-10 13:30:20', '2025-08-10 13:33:47'),
(53, 'offcanvas_about_us_description', 'techguru', 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et magna aliqua. Ut enim ad minim veniam laboris.', '2025-08-10 13:30:20', '2025-08-10 13:33:47'),
(54, 'offcanvas_get_a_free_quote_title', 'techguru', 'Get a free quote', '2025-08-10 13:30:20', '2025-08-10 13:33:47'),
(55, 'offcanvas_submit_button_text', 'techguru', 'Submit Now', '2025-08-10 13:30:20', '2025-08-10 13:33:47'),
(56, 'address', 'techguru', '1629 N. Dixie Avenue, Kentucky, 42701', '2025-08-10 13:30:20', '2025-08-10 13:33:47'),
(57, 'phone', 'techguru', '+12 (123) 456 78900', '2025-08-10 13:30:20', '2025-08-10 13:33:47'),
(58, 'sidebar_post_single', 'techguru', '{\"4B3IaU7HUA\":{\"subscribe_text_1\":\"Subscribe\",\"subscribe_text_2\":\"Newsletter\",\"description_1\":\"From personalized solutions to expert execution, we prioritize quality,\",\"description_2\":\"reliability, and customer satisfaction\",\"placeholder\":\"Enter email address\",\"button_text\":\"Subscribe Now\",\"widget\":\"postsingle_newsletter\",\"key\":\"4B3IaU7HUA\"}}', '2025-08-10 13:36:34', '2025-08-11 14:40:36'),
(59, 'sidebar_footer_top_cta', 'techguru', '{\"HHpI5qv3gx\":{\"background_image\":\"2025\\/08\\/14\\/site-footer-top-bg.jpg\",\"logo\":\"2025\\/08\\/14\\/footer-logo.png\",\"cta_text\":\"We are the best creative agency \\\\\\\\ worldwide to brands grow\",\"button_text\":\"Get In Touch\",\"button_url\":\"\\/contact\",\"widget\":\"footer_top_cta\",\"key\":\"HHpI5qv3gx\"}}', '2025-08-14 13:01:18', '2025-08-14 13:01:18'),
(60, 'sidebar_footer_1', 'techguru', '{\"xPz4C6hiJc\":{\"location_title\":\"Location\",\"location_text\":\"123 Main Street, Apt 4BNew \\r\\nYork, NY 10001USA\",\"working_title\":\"Working Time\",\"working_text\":\"Sunday - Monday (Fri - Closed)\\r\\n10:00 AM - 5:00 PM\",\"contact_title\":\"Contact Us\",\"email\":\"support@domain.com\",\"phone\":\"+12 (00) 456 7890\",\"widget\":\"footer_address\",\"key\":\"xPz4C6hiJc\"}}', '2025-08-14 17:24:59', '2025-08-14 17:24:59'),
(61, 'sidebar_footer_4', 'techguru', '{\"ADKkcYIxUi\":{\"title\":\"Newsletter\",\"description\":\"Get the latest SEO tips and software insights straight to your inbox.\",\"placeholder\":\"Enter email address\",\"privacy_text\":\"by Subscribing. Your Accept Privacy policy\",\"social_title\":\"Follow Us:\",\"social_links\":[{\"icon\":\"icon-facebook\",\"url\":\"https:\\/\\/www.facebook.com\\/\"},{\"icon\":\"icon-dribble\",\"url\":\"https:\\/\\/dribbble.com\\/\"},{\"icon\":\"icon-linkedin\",\"url\":\"http:\\/\\/linkedin.com\\/\"}],\"widget\":\"footer_newsletter\",\"key\":\"ADKkcYIxUi\"}}', '2025-08-14 17:27:56', '2025-08-14 17:28:59'),
(62, 'sidebar_footer_1_first', 'techguru', '{\"Pea8HglgNj\":{\"logo\":\"2025\\/08\\/15\\/footer-logo.png\",\"contact_title\":\"Contact Info\",\"email\":\"info@domain.com\",\"phone\":\"+99 (00) 567 780\",\"location_title\":\"Location\",\"location_text\":\"123 Main Street, Apt 4BNew\\r\\nYork, NY 10001USA\",\"widget\":\"footer_info\",\"key\":\"Pea8HglgNj\"}}', '2025-08-15 08:46:05', '2025-08-15 08:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'unconfimred, banned, active',
  `language` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `verification_token` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `is_fake` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`, `json_metas`, `is_fake`) VALUES
(54, 'Vendor William', 'vendor@gmail.com', NULL, '$2y$10$Cd2BKLBPglaF4orR9r4cGOrdjdRx5Qod7TMui2yEyslx/XFkUcIum', '3KwO1V3cEsJ4wwtKhYx5FUxePMK5RXMB4gE0IfPHhIyewAQvobNNcr3hdLdi', '2025-08-14 17:10:18', '2025-08-14 17:11:20', NULL, 0, 'active', 'en', 'PbM3Nw5j47R2HvSSoH7n2H54ybPnNoaa', NULL, '{\"user_type\":\"vendor\",\"user_status\":\"approved\",\"shop_name\":\"William Shop\",\"business_phone\":\"1826311803\",\"business_address\":\"1209 MOUNTAIN ROAD PL NE, STE R\"}', 0),
(55, 'Mojahid islam', 'education.mojahid@gmail.com', NULL, '$2y$10$C3JKybnWZQynT.Yvr01UM.3dJLo6M5u7QvVmjpMABlheSKy.9kqxq', 'zH0JJOdOfagiN5dBLTha9IOsy3LDzbg4PF6YLE8KPY2yyIjrx9YlTMEnGpf0', '2025-08-16 13:54:10', '2025-08-16 13:54:10', NULL, 0, 'verification', 'en', 'WV5tNojXeTMTHFIURj8JfASBIwaAI2ge', NULL, NULL, 0),
(56, 'Mojahidul Islam', 'mojarsoft@gmail.com', NULL, '$2y$10$4oi0lWD3AuLUNKm.0P2X8ecCwA1CPTDghRsJCf72brkIIpvOQD4Qy', NULL, '2025-09-20 21:50:33', '2025-09-20 21:50:33', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(57, 'mojahid islam', 'mojahidgenius48@gmail.com', NULL, '$2y$10$pwcA3RIYh1xueXaqyUJu/ui/7grEAARn4QEvoNYCBSVdtRS2rUoH6', NULL, '2025-09-20 22:11:15', '2025-09-20 22:11:15', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(58, 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, '$2y$10$1fH4TJDt5m3qaWV8N/aP8O19Rfe1YeWDxZTZxcVt0DsXWDcZeHoGC', NULL, '2025-09-20 22:13:01', '2025-09-20 22:13:01', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_user_metas`
--

CREATE TABLE `app_user_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_user_metas`
--

INSERT INTO `app_user_metas` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(13, 21, 'user_type', 'vendor'),
(14, 21, 'shop_name', 'Vendor1'),
(15, 21, 'business_phone', '12321'),
(16, 21, 'business_address', 'asdsa'),
(147, 52, 'user_type', 'customer'),
(150, 15, 'birthday', NULL),
(151, 15, 'country', NULL),
(152, 54, 'user_type', 'vendor'),
(153, 54, 'user_status', 'approved'),
(154, 54, 'shop_name', 'William Shop'),
(155, 54, 'business_phone', '1826311803'),
(156, 54, 'business_address', '1209 MOUNTAIN ROAD PL NE, STE R');

-- --------------------------------------------------------

--
-- Table structure for table `app_variants_attributes`
--

CREATE TABLE `app_variants_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_vendor_balances`
--

CREATE TABLE `app_vendor_balances` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_earnings` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_withdrawals` decimal(15,2) NOT NULL DEFAULT '0.00',
  `pending_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `currency_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_vendor_balances`
--

INSERT INTO `app_vendor_balances` (`id`, `vendor_id`, `balance`, `total_earnings`, `total_withdrawals`, `pending_balance`, `currency_code`, `created_at`, `updated_at`) VALUES
(3, 54, 0.00, 0.00, 0.00, 810.00, 'USD', '2025-08-14 17:11:58', '2025-08-15 10:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `app_vendor_earnings`
--

CREATE TABLE `app_vendor_earnings` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `order_amount` decimal(15,2) NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL,
  `commission_amount` decimal(15,2) NOT NULL,
  `vendor_amount` decimal(15,2) NOT NULL,
  `currency_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_vendor_earnings`
--

INSERT INTO `app_vendor_earnings` (`id`, `vendor_id`, `order_id`, `order_item_id`, `order_amount`, `commission_rate`, `commission_amount`, `vendor_amount`, `currency_code`, `status`, `paid_at`, `created_at`, `updated_at`) VALUES
(6, 54, 247, 260, 300.00, 10.00, 30.00, 270.00, 'USD', 'pending', NULL, '2025-08-15 09:49:50', '2025-08-15 09:49:50'),
(7, 54, 251, 271, 300.00, 10.00, 30.00, 270.00, 'USD', 'pending', NULL, '2025-08-15 09:55:08', '2025-08-15 09:55:08'),
(8, 54, 252, 275, 300.00, 10.00, 30.00, 270.00, 'USD', 'pending', NULL, '2025-08-15 10:02:43', '2025-08-15 10:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `app_vendor_withdrawals`
--

CREATE TABLE `app_vendor_withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `status` enum('pending','approved','rejected','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_details` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `processed_at` timestamp NULL DEFAULT NULL,
  `processed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_app_translations`
--
ALTER TABLE `app_app_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_app_translations_status_index` (`status`),
  ADD KEY `app_app_translations_locale_index` (`locale`),
  ADD KEY `app_app_translations_group_index` (`group`),
  ADD KEY `app_app_translations_namespace_index` (`namespace`),
  ADD KEY `app_app_translations_object_type_index` (`object_type`),
  ADD KEY `app_app_translations_object_key_index` (`object_key`);

--
-- Indexes for table `app_attributes`
--
ALTER TABLE `app_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_attribute_values`
--
ALTER TABLE `app_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `app_chatbot_configurations`
--
ALTER TABLE `app_chatbot_configurations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_chatbot_configurations_name_unique` (`name`),
  ADD KEY `app_chatbot_configurations_is_active_sort_order_index` (`is_active`,`sort_order`),
  ADD KEY `app_chatbot_configurations_status_index` (`status`);

--
-- Indexes for table `app_chatbot_logs`
--
ALTER TABLE `app_chatbot_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_chatbot_logs_provider_event_type_index` (`provider`,`event_type`),
  ADD KEY `app_chatbot_logs_level_created_at_index` (`level`,`created_at`),
  ADD KEY `app_chatbot_logs_created_at_index` (`created_at`);

--
-- Indexes for table `app_comments`
--
ALTER TABLE `app_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_comments_user_id_index` (`user_id`),
  ADD KEY `app_comments_email_index` (`email`),
  ADD KEY `app_comments_object_id_index` (`object_id`),
  ADD KEY `app_comments_object_type_index` (`object_type`);

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_configs_code_unique` (`code`),
  ADD KEY `app_configs_code_index` (`code`);

--
-- Indexes for table `app_contact_form_contacts`
--
ALTER TABLE `app_contact_form_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_contact_form_contacts_created_at_index` (`created_at`),
  ADD KEY `app_contact_form_contacts_email_index` (`email`),
  ADD KEY `app_contact_form_contacts_site_id_index` (`site_id`);

--
-- Indexes for table `app_ecomm_addons`
--
ALTER TABLE `app_ecomm_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_ecomm_backorder_requests`
--
ALTER TABLE `app_ecomm_backorder_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_ecomm_backorder_requests_post_id_index` (`post_id`),
  ADD KEY `app_ecomm_backorder_requests_variant_id_index` (`variant_id`),
  ADD KEY `app_ecomm_backorder_requests_order_id_index` (`order_id`),
  ADD KEY `app_ecomm_backorder_requests_order_item_id_index` (`order_item_id`),
  ADD KEY `app_ecomm_backorder_requests_processed_by_index` (`processed_by`);

--
-- Indexes for table `app_ecomm_carts`
--
ALTER TABLE `app_ecomm_carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_ecomm_carts_code_site_id_unique` (`code`,`site_id`),
  ADD KEY `app_ecomm_carts_user_id_foreign` (`user_id`),
  ADD KEY `app_ecomm_carts_site_id_index` (`site_id`);

--
-- Indexes for table `app_ecomm_currencies`
--
ALTER TABLE `app_ecomm_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_ecomm_discounts`
--
ALTER TABLE `app_ecomm_discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_ecomm_discounts_code_unique` (`code`),
  ADD KEY `app_ecomm_discounts_site_id_index` (`site_id`);

--
-- Indexes for table `app_ecomm_wishlists`
--
ALTER TABLE `app_ecomm_wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_ecomm_wishlists_code_site_id_unique` (`code`,`site_id`),
  ADD KEY `app_ecomm_wishlists_user_id_foreign` (`user_id`),
  ADD KEY `app_ecomm_wishlists_site_id_index` (`site_id`);

--
-- Indexes for table `app_ecom_download_links`
--
ALTER TABLE `app_ecom_download_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_ecom_download_links_uuid_unique` (`uuid`),
  ADD KEY `app_ecom_download_links_product_id_foreign` (`product_id`),
  ADD KEY `app_ecom_download_links_variant_id_foreign` (`variant_id`),
  ADD KEY `app_ecom_download_links_site_id_index` (`site_id`);

--
-- Indexes for table `app_email_lists`
--
ALTER TABLE `app_email_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_email_lists_email_index` (`email`),
  ADD KEY `app_email_lists_template_id_index` (`template_id`),
  ADD KEY `app_email_lists_status_index` (`status`),
  ADD KEY `app_email_lists_template_code_index` (`template_code`);

--
-- Indexes for table `app_email_templates`
--
ALTER TABLE `app_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_email_templates_code_unique` (`code`),
  ADD UNIQUE KEY `email_templates_uuid_unique` (`uuid`),
  ADD KEY `app_email_templates_active_index` (`active`);

--
-- Indexes for table `app_email_template_users`
--
ALTER TABLE `app_email_template_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_email_template_users_user_id_foreign` (`user_id`),
  ADD KEY `app_email_template_users_email_template_id_foreign` (`email_template_id`);

--
-- Indexes for table `app_failed_jobs`
--
ALTER TABLE `app_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `app_jobs`
--
ALTER TABLE `app_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_jobs_queue_index` (`queue`);

--
-- Indexes for table `app_languages`
--
ALTER TABLE `app_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_languages_code_unique` (`code`),
  ADD KEY `app_languages_code_index` (`code`);

--
-- Indexes for table `app_language_lines`
--
ALTER TABLE `app_language_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_language_lines_namespace_index` (`namespace`),
  ADD KEY `app_language_lines_group_index` (`group`),
  ADD KEY `app_language_lines_key_index` (`key`),
  ADD KEY `app_language_lines_object_type_index` (`object_type`),
  ADD KEY `app_language_lines_object_key_index` (`object_key`);

--
-- Indexes for table `app_manual_notifications`
--
ALTER TABLE `app_manual_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_manual_notifications_method_index` (`method`);

--
-- Indexes for table `app_media_files`
--
ALTER TABLE `app_media_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_media_files_folder_id_index` (`folder_id`),
  ADD KEY `app_media_files_user_id_index` (`user_id`),
  ADD KEY `app_media_files_type_index` (`type`),
  ADD KEY `app_media_files_mime_type_index` (`mime_type`),
  ADD KEY `app_media_files_path_index` (`path`),
  ADD KEY `app_media_files_extension_index` (`extension`),
  ADD KEY `app_media_files_size_index` (`size`),
  ADD KEY `app_media_files_disk_index` (`disk`);

--
-- Indexes for table `app_media_folders`
--
ALTER TABLE `app_media_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_media_folders_folder_id_index` (`folder_id`),
  ADD KEY `app_media_folders_type_index` (`type`),
  ADD KEY `app_media_folders_disk_index` (`disk`);

--
-- Indexes for table `app_menus`
--
ALTER TABLE `app_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_uuid_unique` (`uuid`);

--
-- Indexes for table `app_menu_items`
--
ALTER TABLE `app_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `app_menu_items_parent_id_foreign` (`parent_id`),
  ADD KEY `app_menu_items_model_class_index` (`model_class`),
  ADD KEY `app_menu_items_model_id_index` (`model_id`),
  ADD KEY `app_menu_items_num_order_index` (`num_order`);

--
-- Indexes for table `app_migrations`
--
ALTER TABLE `app_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_model_has_permissions`
--
ALTER TABLE `app_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `app_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `app_model_has_roles`
--
ALTER TABLE `app_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `app_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `app_newsletters_subscribers`
--
ALTER TABLE `app_newsletters_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_newsletters_subscribers_email_unique` (`email`),
  ADD KEY `app_newsletters_subscribers_created_at_index` (`created_at`),
  ADD KEY `app_newsletters_subscribers_site_id_index` (`site_id`);

--
-- Indexes for table `app_notifications`
--
ALTER TABLE `app_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `app_oauth_access_tokens`
--
ALTER TABLE `app_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `app_oauth_auth_codes`
--
ALTER TABLE `app_oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `app_oauth_clients`
--
ALTER TABLE `app_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `app_oauth_personal_access_clients`
--
ALTER TABLE `app_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_oauth_refresh_tokens`
--
ALTER TABLE `app_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `app_orders`
--
ALTER TABLE `app_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_orders_token_unique` (`token`),
  ADD KEY `app_orders_type_index` (`type`),
  ADD KEY `app_orders_status_index` (`status`),
  ADD KEY `app_orders_payment_method_id_index` (`payment_method_id`),
  ADD KEY `app_orders_user_id_index` (`user_id`),
  ADD KEY `app_orders_site_id_index` (`site_id`);

--
-- Indexes for table `app_order_items`
--
ALTER TABLE `app_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_order_items_type_index` (`type`),
  ADD KEY `app_order_items_sku_code_index` (`sku_code`),
  ADD KEY `app_order_items_barcode_index` (`barcode`),
  ADD KEY `app_order_items_post_id_index` (`post_id`),
  ADD KEY `app_order_items_order_id_index` (`order_id`);

--
-- Indexes for table `app_order_item_metas`
--
ALTER TABLE `app_order_item_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_order_item_metas_order_item_id_meta_key_unique` (`order_item_id`,`meta_key`),
  ADD KEY `app_order_item_metas_order_item_id_index` (`order_item_id`),
  ADD KEY `app_order_item_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_order_metas`
--
ALTER TABLE `app_order_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_order_metas_order_id_meta_key_unique` (`order_id`,`meta_key`),
  ADD KEY `app_order_metas_order_id_index` (`order_id`),
  ADD KEY `app_order_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_pages`
--
ALTER TABLE `app_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_pages_slug_unique` (`slug`),
  ADD KEY `app_pages_template_index` (`template`),
  ADD KEY `app_pages_status_index` (`status`);

--
-- Indexes for table `app_page_metas`
--
ALTER TABLE `app_page_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_page_metas_page_id_meta_key_unique` (`page_id`,`meta_key`),
  ADD KEY `app_page_metas_page_id_index` (`page_id`),
  ADD KEY `app_page_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_password_resets`
--
ALTER TABLE `app_password_resets`
  ADD KEY `app_password_resets_email_index` (`email`);

--
-- Indexes for table `app_payment_histories`
--
ALTER TABLE `app_payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_payment_histories_transaction_id_unique` (`transaction_id`),
  ADD KEY `app_payment_histories_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `app_payment_methods`
--
ALTER TABLE `app_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_payment_methods_type_index` (`type`);

--
-- Indexes for table `app_permissions`
--
ALTER TABLE `app_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_permissions_name_guard_unique` (`name`,`guard_name`);

--
-- Indexes for table `app_permission_groups`
--
ALTER TABLE `app_permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_permission_groups_plugin_index` (`plugin`);

--
-- Indexes for table `app_personal_access_tokens`
--
ALTER TABLE `app_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_personal_access_tokens_token_unique` (`token`),
  ADD KEY `app_personal_access_tokens_tokenable_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `app_posts`
--
ALTER TABLE `app_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_posts_slug_unique` (`slug`),
  ADD UNIQUE KEY `posts_uuid_unique` (`uuid`),
  ADD KEY `app_posts_status_index` (`status`),
  ADD KEY `app_posts_created_by_index` (`created_by`),
  ADD KEY `app_posts_updated_by_index` (`updated_by`),
  ADD KEY `app_posts_type_index` (`type`),
  ADD KEY `app_posts_locale_index` (`locale`);

--
-- Indexes for table `app_post_likes`
--
ALTER TABLE `app_post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_post_likes_post_id_foreign` (`post_id`),
  ADD KEY `app_post_likes_user_id_index` (`user_id`),
  ADD KEY `app_post_likes_client_ip_index` (`client_ip`);

--
-- Indexes for table `app_post_metas`
--
ALTER TABLE `app_post_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_post_metas_post_id_meta_key_unique` (`post_id`,`meta_key`),
  ADD KEY `app_post_metas_post_id_index` (`post_id`),
  ADD KEY `app_post_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_post_ratings`
--
ALTER TABLE `app_post_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_post_ratings_post_id_index` (`post_id`),
  ADD KEY `app_post_ratings_client_ip_index` (`client_ip`);

--
-- Indexes for table `app_post_views`
--
ALTER TABLE `app_post_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_post_views_post_id_index` (`post_id`),
  ADD KEY `app_post_views_day_index` (`day`);

--
-- Indexes for table `app_pos_carts`
--
ALTER TABLE `app_pos_carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_pos_carts_cart_token_unique` (`cart_token`),
  ADD KEY `app_pos_carts_pos_session_id_foreign` (`pos_session_id`),
  ADD KEY `app_pos_carts_user_id_status_index` (`user_id`,`status`),
  ADD KEY `app_pos_carts_cart_token_index` (`cart_token`),
  ADD KEY `app_pos_carts_created_at_index` (`created_at`);

--
-- Indexes for table `app_pos_orders`
--
ALTER TABLE `app_pos_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_pos_orders_order_number_unique` (`order_number`),
  ADD KEY `app_pos_orders_user_id_status_index` (`user_id`,`status`),
  ADD KEY `app_pos_orders_pos_session_id_status_index` (`pos_session_id`,`status`),
  ADD KEY `app_pos_orders_order_number_index` (`order_number`),
  ADD KEY `app_pos_orders_created_at_index` (`created_at`);

--
-- Indexes for table `app_pos_order_items`
--
ALTER TABLE `app_pos_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_pos_order_items_pos_order_id_index` (`pos_order_id`),
  ADD KEY `app_pos_order_items_post_id_index` (`post_id`);

--
-- Indexes for table `app_pos_sessions`
--
ALTER TABLE `app_pos_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_pos_sessions_user_id_status_index` (`user_id`,`status`),
  ADD KEY `app_pos_sessions_opened_at_index` (`opened_at`);

--
-- Indexes for table `app_product_variants`
--
ALTER TABLE `app_product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_product_variants_sku_code_index` (`sku_code`),
  ADD KEY `app_product_variants_barcode_index` (`barcode`),
  ADD KEY `app_product_variants_post_id_index` (`post_id`),
  ADD KEY `app_product_variants_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `app_product_variants_attribute_values`
--
ALTER TABLE `app_product_variants_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id_pivot_foreign` (`product_variant_id`),
  ADD KEY `attribute_id_pivot_foreign` (`attribute_id`),
  ADD KEY `attribute_value_id_pivot_foreign` (`attribute_value_id`);

--
-- Indexes for table `app_resources`
--
ALTER TABLE `app_resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_resources_slug_unique` (`slug`),
  ADD UNIQUE KEY `resources_uuid_unique` (`uuid`),
  ADD KEY `app_resources_post_id_foreign` (`post_id`),
  ADD KEY `app_resources_parent_id_foreign` (`parent_id`),
  ADD KEY `app_resources_type_index` (`type`),
  ADD KEY `app_resources_status_index` (`status`);

--
-- Indexes for table `app_resource_metas`
--
ALTER TABLE `app_resource_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_resource_metas_resource_id_meta_key_unique` (`resource_id`,`meta_key`),
  ADD KEY `app_resource_metas_resource_id_index` (`resource_id`),
  ADD KEY `app_resource_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_roles`
--
ALTER TABLE `app_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_roles_name_guard_unique` (`name`,`guard_name`);

--
-- Indexes for table `app_role_has_permissions`
--
ALTER TABLE `app_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `app_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `app_search`
--
ALTER TABLE `app_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_search_post_id_post_type_unique` (`post_id`,`post_type`),
  ADD KEY `app_search_title_index` (`title`),
  ADD KEY `app_search_slug_index` (`slug`),
  ADD KEY `app_search_post_id_index` (`post_id`),
  ADD KEY `app_search_post_type_index` (`post_type`),
  ADD KEY `app_search_status_index` (`status`);

--
-- Indexes for table `app_seo_metas`
--
ALTER TABLE `app_seo_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_seo_metas_object_type_index` (`object_type`),
  ADD KEY `app_seo_metas_object_id_index` (`object_id`);

--
-- Indexes for table `app_shipping_address`
--
ALTER TABLE `app_shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_shipping_address_order_id_index` (`order_id`),
  ADD KEY `app_shipping_address_shop_id_index` (`shop_id`);

--
-- Indexes for table `app_shipping_methods`
--
ALTER TABLE `app_shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_shipping_methods_province_id_index` (`province_id`),
  ADD KEY `app_shipping_methods_shop_id_index` (`shop_id`);

--
-- Indexes for table `app_single_taxonomies`
--
ALTER TABLE `app_single_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_single_taxonomies_post_type_post_id_unique` (`post_type`,`post_id`),
  ADD UNIQUE KEY `app_single_taxonomies_slug_unique` (`slug`),
  ADD KEY `app_single_taxonomies_post_type_index` (`post_type`),
  ADD KEY `app_single_taxonomies_post_id_index` (`post_id`),
  ADD KEY `app_single_taxonomies_taxonomy_index` (`taxonomy`);

--
-- Indexes for table `app_single_taxonomy_metas`
--
ALTER TABLE `app_single_taxonomy_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_single_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  ADD KEY `app_single_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `app_single_taxonomy_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_social_tokens`
--
ALTER TABLE `app_social_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_social_tokens_user_id_social_provider_unique` (`user_id`,`social_provider`),
  ADD KEY `app_social_tokens_user_id_index` (`user_id`),
  ADD KEY `app_social_tokens_social_provider_index` (`social_provider`),
  ADD KEY `app_social_tokens_social_id_index` (`social_id`);

--
-- Indexes for table `app_sticket_ticket_supports`
--
ALTER TABLE `app_sticket_ticket_supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_sticket_ticket_supports_support_type_id_foreign` (`support_type_id`),
  ADD KEY `app_sticket_ticket_supports_created_at_updated_at_index` (`created_at`,`updated_at`),
  ADD KEY `app_sticket_ticket_supports_status_index` (`status`),
  ADD KEY `app_sticket_ticket_supports_product_id_index` (`product_id`),
  ADD KEY `app_sticket_ticket_supports_created_by_index` (`created_by`),
  ADD KEY `app_sticket_ticket_supports_status_priority_index` (`status`,`priority`),
  ADD KEY `app_sticket_ticket_supports_assigned_to_index` (`assigned_to`),
  ADD KEY `app_sticket_ticket_supports_created_at_index` (`created_at`),
  ADD KEY `app_sticket_ticket_supports_last_activity_at_index` (`last_activity_at`),
  ADD KEY `app_sticket_ticket_supports_auto_close_at_index` (`auto_close_at`);

--
-- Indexes for table `app_sticket_ticket_support_attachments`
--
ALTER TABLE `app_sticket_ticket_support_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_sticket_ticket_support_attachments_ticket_support_id_foreign` (`ticket_support_id`),
  ADD KEY `app_sticket_ticket_support_attachments_comment_id_index` (`comment_id`);

--
-- Indexes for table `app_sticket_ticket_support_comments`
--
ALTER TABLE `app_sticket_ticket_support_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_sticket_ticket_support_comments_ticket_support_id_index` (`ticket_support_id`),
  ADD KEY `app_sticket_ticket_support_comments_created_by_index` (`created_by`);

--
-- Indexes for table `app_sticket_ticket_support_types`
--
ALTER TABLE `app_sticket_ticket_support_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_table_groups`
--
ALTER TABLE `app_table_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table_groups_table_unique` (`table`),
  ADD KEY `app_table_groups_total_rows_index` (`total_rows`);

--
-- Indexes for table `app_table_group_datas`
--
ALTER TABLE `app_table_group_datas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table_group_datas_real_table_table_key_unique` (`real_table`,`table_key`),
  ADD KEY `app_table_group_datas_table_group_id_foreign` (`table_group_id`),
  ADD KEY `app_table_group_datas_table_group_table_id_foreign` (`table_group_table_id`),
  ADD KEY `app_table_group_datas_table_index` (`table`),
  ADD KEY `app_table_group_datas_real_table_index` (`real_table`),
  ADD KEY `app_table_group_datas_table_key_index` (`table_key`);

--
-- Indexes for table `app_table_group_tables`
--
ALTER TABLE `app_table_group_tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table_group_tables_real_table_unique` (`real_table`),
  ADD KEY `app_table_group_tables_table_group_id_foreign` (`table_group_id`),
  ADD KEY `app_table_group_tables_table_index` (`table`),
  ADD KEY `app_table_group_tables_total_rows_index` (`total_rows`);

--
-- Indexes for table `app_taxonomies`
--
ALTER TABLE `app_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_taxonomies_slug_unique` (`slug`),
  ADD UNIQUE KEY `taxonomies_uuid_unique` (`uuid`),
  ADD KEY `app_taxonomies_post_type_index` (`post_type`),
  ADD KEY `app_taxonomies_taxonomy_index` (`taxonomy`),
  ADD KEY `app_taxonomies_parent_id_index` (`parent_id`);

--
-- Indexes for table `app_taxonomy_metas`
--
ALTER TABLE `app_taxonomy_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  ADD KEY `app_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `app_taxonomy_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_telescope_entries`
--
ALTER TABLE `app_telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `app_telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `app_telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `app_telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `app_telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_should_display_on_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `app_telescope_entries_tags`
--
ALTER TABLE `app_telescope_entries_tags`
  ADD KEY `app_telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `app_telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `app_term_taxonomies`
--
ALTER TABLE `app_term_taxonomies`
  ADD PRIMARY KEY (`term_id`,`term_type`,`taxonomy_id`),
  ADD KEY `app_term_taxonomies_term_id_index` (`term_id`),
  ADD KEY `app_term_taxonomies_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `app_term_taxonomies_term_type_index` (`term_type`);

--
-- Indexes for table `app_test_eomm_plugin`
--
ALTER TABLE `app_test_eomm_plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_theme_configs`
--
ALTER TABLE `app_theme_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_theme_configs_code_theme_unique` (`code`,`theme`),
  ADD KEY `app_theme_configs_code_index` (`code`),
  ADD KEY `app_theme_configs_theme_index` (`theme`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_users_email_unique` (`email`);

--
-- Indexes for table `app_user_metas`
--
ALTER TABLE `app_user_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_user_metas_user_id_meta_key_unique` (`user_id`,`meta_key`),
  ADD KEY `app_user_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_variants_attributes`
--
ALTER TABLE `app_variants_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `app_vendor_balances`
--
ALTER TABLE `app_vendor_balances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_vendor_balances_vendor_id_currency_code_unique` (`vendor_id`,`currency_code`),
  ADD KEY `app_vendor_balances_vendor_id_index` (`vendor_id`);

--
-- Indexes for table `app_vendor_earnings`
--
ALTER TABLE `app_vendor_earnings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_vendor_earnings_order_item_id_unique` (`order_item_id`),
  ADD KEY `app_vendor_earnings_vendor_id_index` (`vendor_id`),
  ADD KEY `app_vendor_earnings_order_id_index` (`order_id`),
  ADD KEY `app_vendor_earnings_order_item_id_index` (`order_item_id`);

--
-- Indexes for table `app_vendor_withdrawals`
--
ALTER TABLE `app_vendor_withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_vendor_withdrawals_processed_by_foreign` (`processed_by`),
  ADD KEY `app_vendor_withdrawals_vendor_id_index` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_app_translations`
--
ALTER TABLE `app_app_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_attributes`
--
ALTER TABLE `app_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_attribute_values`
--
ALTER TABLE `app_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_chatbot_configurations`
--
ALTER TABLE `app_chatbot_configurations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_chatbot_logs`
--
ALTER TABLE `app_chatbot_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_comments`
--
ALTER TABLE `app_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `app_ecomm_addons`
--
ALTER TABLE `app_ecomm_addons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ecomm_backorder_requests`
--
ALTER TABLE `app_ecomm_backorder_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ecomm_carts`
--
ALTER TABLE `app_ecomm_carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `app_ecomm_currencies`
--
ALTER TABLE `app_ecomm_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_ecomm_discounts`
--
ALTER TABLE `app_ecomm_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ecomm_wishlists`
--
ALTER TABLE `app_ecomm_wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ecom_download_links`
--
ALTER TABLE `app_ecom_download_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_email_lists`
--
ALTER TABLE `app_email_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `app_email_templates`
--
ALTER TABLE `app_email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_email_template_users`
--
ALTER TABLE `app_email_template_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_failed_jobs`
--
ALTER TABLE `app_failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_jobs`
--
ALTER TABLE `app_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_languages`
--
ALTER TABLE `app_languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_language_lines`
--
ALTER TABLE `app_language_lines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_manual_notifications`
--
ALTER TABLE `app_manual_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `app_media_files`
--
ALTER TABLE `app_media_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT for table `app_media_folders`
--
ALTER TABLE `app_media_folders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `app_menus`
--
ALTER TABLE `app_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `app_menu_items`
--
ALTER TABLE `app_menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `app_migrations`
--
ALTER TABLE `app_migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `app_oauth_clients`
--
ALTER TABLE `app_oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_oauth_personal_access_clients`
--
ALTER TABLE `app_oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_orders`
--
ALTER TABLE `app_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `app_order_items`
--
ALTER TABLE `app_order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `app_order_item_metas`
--
ALTER TABLE `app_order_item_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_order_metas`
--
ALTER TABLE `app_order_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_pages`
--
ALTER TABLE `app_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_page_metas`
--
ALTER TABLE `app_page_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_payment_histories`
--
ALTER TABLE `app_payment_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_payment_methods`
--
ALTER TABLE `app_payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `app_permissions`
--
ALTER TABLE `app_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `app_permission_groups`
--
ALTER TABLE `app_permission_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_personal_access_tokens`
--
ALTER TABLE `app_personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_posts`
--
ALTER TABLE `app_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `app_post_likes`
--
ALTER TABLE `app_post_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_post_metas`
--
ALTER TABLE `app_post_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1271;

--
-- AUTO_INCREMENT for table `app_post_ratings`
--
ALTER TABLE `app_post_ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_post_views`
--
ALTER TABLE `app_post_views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT for table `app_pos_carts`
--
ALTER TABLE `app_pos_carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `app_pos_orders`
--
ALTER TABLE `app_pos_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `app_pos_order_items`
--
ALTER TABLE `app_pos_order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_pos_sessions`
--
ALTER TABLE `app_pos_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_product_variants`
--
ALTER TABLE `app_product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `app_product_variants_attribute_values`
--
ALTER TABLE `app_product_variants_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_resources`
--
ALTER TABLE `app_resources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_resource_metas`
--
ALTER TABLE `app_resource_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_roles`
--
ALTER TABLE `app_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `app_search`
--
ALTER TABLE `app_search`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_seo_metas`
--
ALTER TABLE `app_seo_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_shipping_address`
--
ALTER TABLE `app_shipping_address`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_shipping_methods`
--
ALTER TABLE `app_shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_single_taxonomies`
--
ALTER TABLE `app_single_taxonomies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_single_taxonomy_metas`
--
ALTER TABLE `app_single_taxonomy_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_social_tokens`
--
ALTER TABLE `app_social_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_sticket_ticket_support_attachments`
--
ALTER TABLE `app_sticket_ticket_support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_sticket_ticket_support_comments`
--
ALTER TABLE `app_sticket_ticket_support_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_sticket_ticket_support_types`
--
ALTER TABLE `app_sticket_ticket_support_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_table_groups`
--
ALTER TABLE `app_table_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_table_group_datas`
--
ALTER TABLE `app_table_group_datas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_table_group_tables`
--
ALTER TABLE `app_table_group_tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_taxonomies`
--
ALTER TABLE `app_taxonomies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `app_taxonomy_metas`
--
ALTER TABLE `app_taxonomy_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_telescope_entries`
--
ALTER TABLE `app_telescope_entries`
  MODIFY `sequence` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=455156;

--
-- AUTO_INCREMENT for table `app_test_eomm_plugin`
--
ALTER TABLE `app_test_eomm_plugin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_theme_configs`
--
ALTER TABLE `app_theme_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `app_user_metas`
--
ALTER TABLE `app_user_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `app_variants_attributes`
--
ALTER TABLE `app_variants_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_vendor_balances`
--
ALTER TABLE `app_vendor_balances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_vendor_earnings`
--
ALTER TABLE `app_vendor_earnings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `app_vendor_withdrawals`
--
ALTER TABLE `app_vendor_withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_attribute_values`
--
ALTER TABLE `app_attribute_values`
  ADD CONSTRAINT `app_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `app_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_comments`
--
ALTER TABLE `app_comments`
  ADD CONSTRAINT `app_comments_object_id_foreign` FOREIGN KEY (`object_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_ecomm_backorder_requests`
--
ALTER TABLE `app_ecomm_backorder_requests`
  ADD CONSTRAINT `app_ecomm_backorder_requests_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_ecomm_backorder_requests_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `app_order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_ecomm_backorder_requests_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_ecomm_backorder_requests_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `app_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_ecomm_backorder_requests_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_ecomm_carts`
--
ALTER TABLE `app_ecomm_carts`
  ADD CONSTRAINT `app_ecomm_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_ecomm_wishlists`
--
ALTER TABLE `app_ecomm_wishlists`
  ADD CONSTRAINT `app_ecomm_wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_ecom_download_links`
--
ALTER TABLE `app_ecom_download_links`
  ADD CONSTRAINT `app_ecom_download_links_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_ecom_download_links_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_email_template_users`
--
ALTER TABLE `app_email_template_users`
  ADD CONSTRAINT `app_email_template_users_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `app_email_templates` (`id`),
  ADD CONSTRAINT `app_email_template_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`);

--
-- Constraints for table `app_menu_items`
--
ALTER TABLE `app_menu_items`
  ADD CONSTRAINT `app_menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `app_menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `app_menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_model_has_permissions`
--
ALTER TABLE `app_model_has_permissions`
  ADD CONSTRAINT `app_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_model_has_roles`
--
ALTER TABLE `app_model_has_roles`
  ADD CONSTRAINT `app_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_orders`
--
ALTER TABLE `app_orders`
  ADD CONSTRAINT `app_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `app_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_order_items`
--
ALTER TABLE `app_order_items`
  ADD CONSTRAINT `app_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_order_items_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_order_item_metas`
--
ALTER TABLE `app_order_item_metas`
  ADD CONSTRAINT `app_order_item_metas_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `app_order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_order_metas`
--
ALTER TABLE `app_order_metas`
  ADD CONSTRAINT `app_order_metas_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_page_metas`
--
ALTER TABLE `app_page_metas`
  ADD CONSTRAINT `app_page_metas_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `app_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_payment_histories`
--
ALTER TABLE `app_payment_histories`
  ADD CONSTRAINT `app_payment_histories_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `app_payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_likes`
--
ALTER TABLE `app_post_likes`
  ADD CONSTRAINT `app_post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_metas`
--
ALTER TABLE `app_post_metas`
  ADD CONSTRAINT `app_post_metas_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_ratings`
--
ALTER TABLE `app_post_ratings`
  ADD CONSTRAINT `app_post_ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_views`
--
ALTER TABLE `app_post_views`
  ADD CONSTRAINT `app_post_views_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_pos_carts`
--
ALTER TABLE `app_pos_carts`
  ADD CONSTRAINT `app_pos_carts_pos_session_id_foreign` FOREIGN KEY (`pos_session_id`) REFERENCES `app_pos_sessions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_pos_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_pos_orders`
--
ALTER TABLE `app_pos_orders`
  ADD CONSTRAINT `app_pos_orders_pos_session_id_foreign` FOREIGN KEY (`pos_session_id`) REFERENCES `app_pos_sessions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_pos_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_pos_order_items`
--
ALTER TABLE `app_pos_order_items`
  ADD CONSTRAINT `app_pos_order_items_pos_order_id_foreign` FOREIGN KEY (`pos_order_id`) REFERENCES `app_pos_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_pos_order_items_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_pos_sessions`
--
ALTER TABLE `app_pos_sessions`
  ADD CONSTRAINT `app_pos_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_product_variants`
--
ALTER TABLE `app_product_variants`
  ADD CONSTRAINT `app_product_variants_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_product_variants_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_product_variants_attribute_values`
--
ALTER TABLE `app_product_variants_attribute_values`
  ADD CONSTRAINT `attribute_id_pivot_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `app_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_value_id_pivot_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `app_attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_id_pivot_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_resources`
--
ALTER TABLE `app_resources`
  ADD CONSTRAINT `app_resources_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `app_resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_resources_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_resource_metas`
--
ALTER TABLE `app_resource_metas`
  ADD CONSTRAINT `app_resource_metas_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `app_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_role_has_permissions`
--
ALTER TABLE `app_role_has_permissions`
  ADD CONSTRAINT `app_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_single_taxonomies`
--
ALTER TABLE `app_single_taxonomies`
  ADD CONSTRAINT `app_single_taxonomies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_single_taxonomy_metas`
--
ALTER TABLE `app_single_taxonomy_metas`
  ADD CONSTRAINT `app_single_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `app_single_taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_social_tokens`
--
ALTER TABLE `app_social_tokens`
  ADD CONSTRAINT `app_social_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_sticket_ticket_supports`
--
ALTER TABLE `app_sticket_ticket_supports`
  ADD CONSTRAINT `app_sticket_ticket_supports_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `app_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_sticket_ticket_supports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_sticket_ticket_supports_support_type_id_foreign` FOREIGN KEY (`support_type_id`) REFERENCES `app_sticket_ticket_support_types` (`id`);

--
-- Constraints for table `app_sticket_ticket_support_attachments`
--
ALTER TABLE `app_sticket_ticket_support_attachments`
  ADD CONSTRAINT `app_sticket_ticket_support_attachments_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `app_sticket_ticket_support_comments` (`id`),
  ADD CONSTRAINT `app_sticket_ticket_support_attachments_ticket_support_id_foreign` FOREIGN KEY (`ticket_support_id`) REFERENCES `app_sticket_ticket_supports` (`id`);

--
-- Constraints for table `app_sticket_ticket_support_comments`
--
ALTER TABLE `app_sticket_ticket_support_comments`
  ADD CONSTRAINT `app_sticket_ticket_support_comments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `app_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_sticket_ticket_support_comments_ticket_support_id_foreign` FOREIGN KEY (`ticket_support_id`) REFERENCES `app_sticket_ticket_supports` (`id`);

--
-- Constraints for table `app_table_group_datas`
--
ALTER TABLE `app_table_group_datas`
  ADD CONSTRAINT `app_table_group_datas_table_group_id_foreign` FOREIGN KEY (`table_group_id`) REFERENCES `app_table_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_table_group_datas_table_group_table_id_foreign` FOREIGN KEY (`table_group_table_id`) REFERENCES `app_table_group_tables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_table_group_tables`
--
ALTER TABLE `app_table_group_tables`
  ADD CONSTRAINT `app_table_group_tables_table_group_id_foreign` FOREIGN KEY (`table_group_id`) REFERENCES `app_table_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_taxonomy_metas`
--
ALTER TABLE `app_taxonomy_metas`
  ADD CONSTRAINT `app_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `app_taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_telescope_entries_tags`
--
ALTER TABLE `app_telescope_entries_tags`
  ADD CONSTRAINT `app_telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `app_telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `app_user_metas`
--
ALTER TABLE `app_user_metas`
  ADD CONSTRAINT `app_user_metas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_variants_attributes`
--
ALTER TABLE `app_variants_attributes`
  ADD CONSTRAINT `attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `app_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_vendor_balances`
--
ALTER TABLE `app_vendor_balances`
  ADD CONSTRAINT `app_vendor_balances_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_vendor_earnings`
--
ALTER TABLE `app_vendor_earnings`
  ADD CONSTRAINT `app_vendor_earnings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_vendor_earnings_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `app_order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_vendor_earnings_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_vendor_withdrawals`
--
ALTER TABLE `app_vendor_withdrawals`
  ADD CONSTRAINT `app_vendor_withdrawals_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `app_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_vendor_withdrawals_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
