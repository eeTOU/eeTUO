-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Ara 2020, 07:12:23
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dokuz_eylul_dks_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `code`, `name`, `parentcode`, `type`, `created_at`, `updated_at`) VALUES
(23, 'L01', 'Kat-1', '', '0', '2020-12-26 20:42:41', '2020-12-26 20:42:41'),
(24, 'L02', 'Kat-2', '', '0', '2020-12-26 20:42:56', '2020-12-26 20:42:56'),
(25, 'S01', 'Sınıf 1A', 'L01', '1', '2020-12-26 20:43:32', '2020-12-26 20:43:32'),
(26, 'S02', 'Sınıf 1B', 'L01', '1', '2020-12-26 20:43:59', '2020-12-26 20:43:59'),
(27, 'S03', 'Sınıf 2A', 'L02', '1', '2020-12-26 20:44:18', '2020-12-26 20:44:18'),
(28, 'S04', 'Sınıf 2B', 'L02', '1', '2020-12-26 20:44:30', '2020-12-26 20:44:30'),
(32, '1234', 'Kat-3', '', '0', '2020-12-28 03:57:31', '2020-12-28 03:58:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `course_regs`
--

CREATE TABLE `course_regs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facultymembercode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classroomcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lecturecode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `course_regs`
--

INSERT INTO `course_regs` (`id`, `code`, `facultymembercode`, `studentcode`, `classroomcode`, `lecturecode`, `created_at`, `updated_at`) VALUES
(114, 'ZD5', '', '1', '', '201', '2020-12-27 20:24:38', '2020-12-27 20:24:38'),
(116, 'ZD8', '', '1', '', '105', '2020-12-27 20:25:45', '2020-12-27 20:25:45'),
(117, 'SD11', '', '1', '', 'S301', '2020-12-27 20:26:50', '2020-12-27 20:26:50'),
(120, 'SD12', '', '1', '', 'S105', '2020-12-28 04:09:59', '2020-12-28 04:09:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `faculty_members`
--

CREATE TABLE `faculty_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `faculty_members`
--

INSERT INTO `faculty_members` (`id`, `code`, `name`, `surname`, `email`, `startdate`, `created_at`, `updated_at`) VALUES
(1, '1001', 'Kökten Ulaş', 'Birant', 'koktenulas@deu.edu.com', '2020-07-01', '2020-12-26 00:45:00', '2020-12-26 00:45:00'),
(2, '1002', 'Derya', 'Pakalın', 'deryapakalin@deu.edu.tr', '2020-07-14', '2020-12-26 00:45:42', '2020-12-26 00:45:42'),
(3, '1003', 'Özlem', 'Aktaş', 'ozlemaktas@deu.edu.tr', '2020-12-26', '2020-12-26 00:46:45', '2020-12-26 00:46:45'),
(4, '1004', 'Mehmet Hilal', 'Özcanhan', 'mehmethilalozcanhan@deu.edu.tr', '2020-07-14', '2020-12-26 00:47:24', '2020-12-26 20:09:34');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lectures`
--

CREATE TABLE `lectures` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ismandatory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `lectures`
--

INSERT INTO `lectures` (`id`, `code`, `name`, `ismandatory`, `day`, `hour`, `created_at`, `updated_at`) VALUES
(1, '101', 'Data Structures', '0', '1', '10:00', '2020-12-26 01:38:40', '2020-12-26 15:56:03'),
(5, '201', 'Computer Architecture', '1', '2', '14:35', '2020-12-26 20:04:52', '2020-12-26 20:04:52'),
(6, '301', 'Computer Networks', '1', '4', '09:30', '2020-12-26 20:05:24', '2020-12-26 20:05:24'),
(7, '104', 'Calculus', '1', '5', '10:05', '2020-12-26 20:05:49', '2020-12-26 20:05:49'),
(8, '105', 'Algorithm', '1', '3', '13:00', '2020-12-26 20:06:22', '2020-12-26 20:06:22'),
(9, 'S101', 'Artifical Engineering', '0', '2', '14:14', '2020-12-26 20:07:21', '2020-12-26 20:07:21'),
(10, 'S201', 'Human Computer Interaction', '0', '1', '11:30', '2020-12-26 20:07:53', '2020-12-26 20:07:53'),
(11, 'S301', 'Web Technologies', '0', '5', '15:45', '2020-12-26 20:08:24', '2020-12-26 20:08:24'),
(12, 'S105', 'Data Mining', '0', '2', '14:53', '2020-12-26 20:09:03', '2020-12-28 01:48:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_12_26_020530_create_pro_users_table', 1),
(2, '2020_12_26_021433_create_students_table', 2),
(3, '2020_12_26_021803_create_faculty_members_table', 3),
(4, '2020_12_26_030144_create_lectures_table', 4),
(5, '2020_12_26_180129_create_class_rooms_table', 5),
(6, '2020_12_26_225230_create_course_regs_table', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pro_users`
--

CREATE TABLE `pro_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `prouser_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prouser_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `prouser_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_pro` int(10) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `pro_users`
--

INSERT INTO `pro_users` (`id`, `prouser_name`, `prouser_email`, `email_verified_at`, `prouser_password`, `check_pro`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Uzman Kullanıcı', 'uzmankullanici@deu.com', NULL, '1234', 1, NULL, '2020-12-26 00:43:17', '2020-12-26 00:43:17'),
(5, 'Uzman 2', 'uzmankullanici2@deu.edu.tr', NULL, '12345', 1, NULL, '2020-12-27 22:21:11', '2020-12-27 22:21:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`id`, `code`, `name`, `surname`, `email`, `created_at`, `updated_at`) VALUES
(1, '2005510014', 'Makbule', 'Demirel', 'makbule.demirel@deu.edu.tr', '2020-12-26 20:46:41', '2020-12-27 02:08:39');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `course_regs`
--
ALTER TABLE `course_regs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `faculty_members`
--
ALTER TABLE `faculty_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculty_members_code_unique` (`code`);

--
-- Tablo için indeksler `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lectures_code_unique` (`code`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pro_users`
--
ALTER TABLE `pro_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pro_users_prouser_email_unique` (`prouser_email`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Tablo için AUTO_INCREMENT değeri `course_regs`
--
ALTER TABLE `course_regs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Tablo için AUTO_INCREMENT değeri `faculty_members`
--
ALTER TABLE `faculty_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `pro_users`
--
ALTER TABLE `pro_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
