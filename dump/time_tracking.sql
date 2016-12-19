-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 19 2016 г., 14:12
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `time_tracking`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Clients`
--

CREATE TABLE IF NOT EXISTS `Clients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `Clients`
--

INSERT INTO `Clients` (`id`, `company_name`, `company_address`, `website`, `contact_person`, `email`, `phone_number`, `updated_at`, `created_at`) VALUES
(6, 'Mss12', 'sads sadsad', 'https://laravel.com/docs/5.3/queries#selects', 'Petro', 'petro@gmail.com', '3434', '2016-12-10', '2016-12-10'),
(7, 'dsfds', 'dsdsf', 'https://github.com/', 'dsdsf', 'petro@gmail.com', '2343243', '2016-12-14', '2016-12-14');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Project`
--

CREATE TABLE IF NOT EXISTS `Project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `client_id` int(10) NOT NULL,
  `lead_id` int(10) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `hourly_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `notes` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `Project`
--

INSERT INTO `Project` (`id`, `client_id`, `lead_id`, `project_name`, `hourly_rate`, `notes`, `updated_at`, `created_at`) VALUES
(19, 6, 49, 'project1', '50.00', 'sdsdsa', '2016-12-14 09:04:41', '2016-12-10 00:00:00'),
(20, 6, 49, 'testing', '50.00', 'dsfd', '2016-12-10 00:00:00', '2016-12-10 00:00:00'),
(21, 6, 49, 'test12', '50.00', 'sad sad sd sd ', '2016-12-14 07:24:14', '2016-12-14 07:24:14');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `task_type` varchar(255) NOT NULL,
  `task_titly` varchar(255) NOT NULL,
  `alloceted_hours` decimal(5,2) NOT NULL,
  `assign_to` int(16) DEFAULT NULL,
  `task_description` text NOT NULL,
  `billable` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`,`project_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `company_id`, `project_id`, `task_type`, `task_titly`, `alloceted_hours`, `assign_to`, `task_description`, `billable`, `created_at`, `updated_at`) VALUES
(10, 6, 19, 'Bug Fixing', 'ewrerw', '50.00', 27, 'AAAA', 1, '2016-12-10 00:00:00', '2016-12-14 09:10:44'),
(11, 6, 20, 'Quality Assurance', 'sas', '100.00', 49, 'dsd', 1, '2016-12-10 00:00:00', '2016-12-10 00:00:00'),
(12, 6, 20, 'Bug Fixing', 'sdasd', '50.00', 49, 'asdasd', 0, '2016-12-12 00:00:00', '2016-12-14 09:16:01'),
(13, 6, 20, 'Bug Fixing', 'sadasdasd', '50.00', 49, 'asdasd', 0, '2016-12-12 00:00:00', '2016-12-12 00:00:00'),
(14, 6, 20, 'New Feature', 'we', '0.00', 49, ' wwqe ', 0, '2016-12-14 00:00:00', '2016-12-14 00:00:00'),
(15, 6, 19, 'Bug Fixing', 'asdasd', '10.00', 49, 'sdsa', 0, '2016-12-15 12:48:59', '2016-12-15 12:48:59'),
(16, 6, 20, 'Bug Fixing', 'aaaaAAAAAA', '10.00', 49, 'asd', 0, '2016-12-15 12:49:17', '2016-12-15 12:49:17');

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teams_lead_id` int(10) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `teams_lead_id`, `team_name`) VALUES
(8, 49, 'php');

-- --------------------------------------------------------

--
-- Структура таблицы `time_log`
--

CREATE TABLE IF NOT EXISTS `time_log` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `project_id` int(16) NOT NULL,
  `task_id` int(16) NOT NULL,
  `track_id` int(16) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `time_log`
--

INSERT INTO `time_log` (`id`, `project_id`, `task_id`, `track_id`, `start`, `finish`, `updated_at`, `created_at`) VALUES
(1, 19, 10, 1, '2016-12-12 14:30:29', '2016-12-12 16:20:30', '2016-12-12', '2016-12-12');

-- --------------------------------------------------------

--
-- Структура таблицы `time_track`
--

CREATE TABLE IF NOT EXISTS `time_track` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `project_id` int(16) NOT NULL,
  `task_id` int(16) NOT NULL,
  `track_date` date DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  `duration` int(16) DEFAULT NULL,
  `billable_time` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `additional_cost` int(16) DEFAULT NULL,
  `total_time` int(16) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `time_track`
--

INSERT INTO `time_track` (`id`, `project_id`, `task_id`, `track_date`, `date_start`, `date_finish`, `duration`, `billable_time`, `description`, `additional_cost`, `total_time`, `updated_at`, `created_at`) VALUES
(1, 19, 10, NULL, '2016-12-12 14:19:20', '2016-12-12 15:19:20', 0, 0, '', 5, 3600, '2016-12-12 00:00:00', '2016-12-12 00:00:00'),
(5, 19, 10, NULL, '2016-12-14 08:00:00', '2016-12-14 18:00:00', 36000, 0, 'tertr retr etret r', 50, NULL, '2016-12-14 15:11:28', '2016-12-14 15:11:28'),
(6, 19, 10, NULL, '2016-12-14 18:00:00', '2016-12-14 20:00:00', 7200, 0, 'sasds sad asdas d', 50, NULL, '2016-12-14 15:12:37', '2016-12-14 15:12:37'),
(7, 19, 10, NULL, '2016-12-14 08:00:00', '2016-12-14 10:00:00', 7200, 1, 'sdsad ', 50, NULL, '2016-12-14 15:17:07', '2016-12-14 15:17:07'),
(16, 19, 10, '2016-12-19', '2016-12-18 23:00:00', '2016-12-19 00:00:00', NULL, 0, 'asdasd', 12, NULL, '2016-12-19 10:52:05', '2016-12-19 10:52:05'),
(17, 20, 11, '2016-12-19', '2016-12-18 23:00:00', '2016-12-19 00:00:00', NULL, 0, 'sdasda', 12, NULL, '2016-12-19 10:52:15', '2016-12-19 10:52:15'),
(18, 20, 11, '2016-12-19', '2016-12-19 10:00:00', '2016-12-19 11:00:00', 60, 0, 'assdsadasd', 12, NULL, '2016-12-19 10:57:04', '2016-12-19 10:57:04'),
(19, 19, 10, '2016-12-19', '2016-12-18 23:00:00', '2016-12-19 00:00:00', 60, 0, 'dasasdd', 12, NULL, '2016-12-19 10:57:15', '2016-12-19 10:57:15'),
(20, 19, 15, '2016-12-19', '2016-12-19 10:00:00', '2016-12-19 12:00:00', 120, 0, 'asdsad ', 12, NULL, '2016-12-19 10:57:52', '2016-12-19 10:57:52'),
(21, 19, 10, '2016-12-19', '2016-12-19 10:00:00', '2016-12-19 09:00:00', NULL, 0, 'dfdsfd', 123, NULL, '2016-12-19 10:58:44', '2016-12-19 10:58:44');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `google_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `users_team_id` int(10) NOT NULL DEFAULT '0',
  `hourly_rate` float(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `employe`, `users_team_id`, `hourly_rate`) VALUES
(27, NULL, 'Anton', 'an@gmail.com', '$2y$10$mEzQ.b0mX8H9qTSR27vrN.uq64KQF9O0jW4mdVBFEPY4N8gXIpiu6', 'Iioy39etellz78RbPCBlN2r7UjsVK6wK17CTclDA7pOrUuk0Ar9B1bXt5cN9', '2016-12-06 13:40:59', '2016-12-19 08:00:14', 'Admin', 8, 10.00),
(44, NULL, 'add', 'admin@admin.com', '$2y$10$098xVr3AdbpptAkhtYtUCOWYUEqiaVD/RBEL86W8W0qWDl6cd4DRC', 'GL1JQJlh6PiluMr1rrzhX6u42t7ydvcXT8lfuFih66cMNW9EA2p8OFf27ooE', '2016-12-09 06:43:22', '2016-12-09 06:44:11', 'Admin', 0, 0.00),
(49, NULL, 'Masik', 'sdasd@wddew.com', '$2y$10$f5uWksp/edR9G5Yuatwuk.MZuZtBFUDplTbZW9dJa/dcqm3b0ICT6', NULL, '2016-12-10 14:07:09', '2016-12-10 14:07:49', 'Lead', 8, 50.00),
(51, NULL, 'Asas', 'asdasd@dfggfd.comss', '$2y$10$3NCNznkJeQpCXOqc18bHR.pB8cLDW2EXzSvuh6XX/L98rE1y5DbiK', NULL, '2016-12-10 14:43:18', '2016-12-10 14:43:18', 'Developer', 8, 50.00),
(52, NULL, 'Dev', 'sad@gmail.com1', '$2y$10$Wy8rO31Xp1iI8a.ZmVz9ceh.xBO9THdptcKD897hB2w7vk05xMaGK', NULL, '2016-12-12 05:32:05', '2016-12-12 05:32:17', 'Admin', 0, 0.00),
(53, NULL, 'test', 'sdasd@wddew.comd', '$2y$10$b3H7jTbkN.87eUnxJo775.rPFjYfBVG/p2.Z9lcxtnhY.kAgI3Xbq', NULL, '2016-12-14 15:08:56', '2016-12-14 15:08:56', 'QA Engineer', 0, 0.00);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Project`
--
ALTER TABLE `Project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `time_log`
--
ALTER TABLE `time_log`
  ADD CONSTRAINT `time_log_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `time_track` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `time_track`
--
ALTER TABLE `time_track`
  ADD CONSTRAINT `time_track_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
