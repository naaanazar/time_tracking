-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 10 2016 г., 12:01
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `Clients`
--

INSERT INTO `Clients` (`id`, `company_name`, `company_address`, `website`, `contact_person`, `email`, `phone_number`, `updated_at`, `created_at`) VALUES
(2, 'test', 'fdsfdsf', 'https://laravel.com', 'dasdasdds', 'asdasd@dfggfd.com', '34545435', '2016-12-08', '2016-12-08'),
(3, 'tuzik', 'dee', 'https://laracasts.com', 'sadas', 'sad@gmail.com', '2344234', '2016-12-09', '2016-12-09'),
(5, 'Pusir', 'fdfd dfdsfds', 'https://laracasts.com/skills/php', 'dsffdsg!', 'rtret@dfdfs.com', '324234', '2016-12-10', '2016-12-10');

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
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `Project`
--

INSERT INTO `Project` (`id`, `client_id`, `lead_id`, `project_name`, `hourly_rate`, `notes`, `updated_at`, `created_at`) VALUES
(3, 2, 0, 'qweqwe', '10.00', 'qwewqeqwe', '2016-12-08', '2016-12-08'),
(4, 2, 42, 'tester', '10.00', 'dasddasdasdds', '2016-12-08', '2016-12-08'),
(5, 2, 0, 'testin', '10.00', 'dasdasdsdasd', '2016-12-09', '2016-12-08'),
(6, 2, 0, 'testing', '11.00', 'dasdasd', '2016-12-09', '2016-12-09'),
(7, 3, 0, 'tttop', '0.00', 'dsdsada', '2016-12-09', '2016-12-09'),
(8, 2, 0, 'asdasd', '0.00', 'sadasd', '2016-12-09', '2016-12-09'),
(9, 2, 42, 'testing', '10.00', 'sdsdsdsd sdasdsa asdsdasd', '2016-12-09', '2016-12-09'),
(10, 2, 42, 'testing', '10.00', 'sdsdsdsd sdasdsa asdsdasd', '2016-12-09', '2016-12-09'),
(11, 2, 0, 'testing', '10.00', 'sdsdsdsd sdasdsa asdsdasd', '2016-12-09', '2016-12-09'),
(12, 2, 0, 'testin', '10.00', 'sdsdsdsd sdasdsa asdsdasd', '2016-12-09', '2016-12-09'),
(13, 2, 0, 'testing', '10.00', 'sdsdsdsd sdasdsa asdsdasd', '2016-12-09', '2016-12-09'),
(14, 2, 0, 'testin', '10.00', 'sdsdsdsd ', '2016-12-09', '2016-12-09'),
(15, 2, 0, 'testin', '10.00', '', '2016-12-09', '2016-12-09'),
(16, 2, 42, 'asdas', '50.00', 'asdas', '2016-12-09', '2016-12-09');

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
  `assign_to` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `billable` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`,`project_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `company_id`, `project_id`, `task_type`, `task_titly`, `alloceted_hours`, `assign_to`, `task_description`, `billable`, `created_at`, `updated_at`) VALUES
(3, 2, 4, 'Bug Fixing', 'dsfdsf', '50.00', '42', 'dsfdsdf', 1, '2016-12-09', '2016-12-09'),
(4, 2, 4, 'Bug Fixing', 'sdsda', '50.00', '27', 'asasds', 1, '2016-12-09', '2016-12-09');

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teams_lead_id` int(10) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `teams_lead_id`, `team_name`) VALUES
(1, 26, 'php'),
(2, 42, 'js'),
(3, 0, 'ruby');

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
  `team_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no team',
  `hourly_rate` float(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `employe`, `users_team_id`, `team_name`, `hourly_rate`) VALUES
(2, NULL, '  terr ', 'terr@gmail.coms', '$2y$10$oHZj9FU1lHC3hctB90asLuGaSmqRk2ZYWzNd0jqZjpZ7tlW48RAFK', 'UzpDLGbrN2d6sa6x3Z9UKhzKhbo2oszSoYP6wAjcf56BOMS8IGVSuTtO9bi0', '2016-12-02 07:13:16', '2016-12-06 13:38:55', 'Admin', 1, 'php', 9.11),
(25, NULL, ' Nazal', 'nazar@gmail.com', '$2y$10$SBqmNY8Lfpyk7yJhoyQPE.2cW5wcwiAOdODV7jmGwa9dOFAWPA0gG', NULL, '2016-12-06 11:02:48', '2016-12-06 12:50:37', 'Developer', 2, 'js', 10.10),
(26, NULL, ' Voldemort', 'vold@gmail.com', '$2y$10$KokVdfiMx7dSpXZZr/E7BezipXq4lBmNz0rNE4FxzRYj.XGux3rIG', NULL, '2016-12-06 11:03:15', '2016-12-06 13:05:18', 'Lead', 2, 'js', 8.00),
(27, NULL, ' Anton', 'an@gmail.com', '$2y$10$mEzQ.b0mX8H9qTSR27vrN.uq64KQF9O0jW4mdVBFEPY4N8gXIpiu6', 'OcZMjjPCMn7fQrJPrQ7b3qdqKzblx7v0jGUZXDiogG0EOOiyWkr1jOtiyOTJ', '2016-12-06 13:40:59', '2016-12-09 10:17:56', 'Admin', 1, 'php', 10.00),
(31, NULL, '  New Admins', 'new@gmail.com', '$2y$10$dhHa2OHYFDIUSjuEk73UhuMIDpjEeUnv7bw4/flzTAdJhA/0kLndi', NULL, '2016-12-07 05:42:39', '2016-12-07 08:51:43', 'QA Engineer', 1, 'php', 0.00),
(32, NULL, ' Toxic', 'tex@gmail.com', '$2y$10$zwihoNnJcMOr0BDad.xAB.6woYxhQhnDL531OVT1QCaaL2XpQc2k.', NULL, '2016-12-07 05:43:46', '2016-12-07 05:44:13', 'Developer', 1, 'php', 10.10),
(35, NULL, 'sadddas', 'ssdd@sdad.com', '$2y$10$Yusihul3N5glb2usRRbRMusGltwqscHjLrR914e43JKOUIla8ymX.', NULL, '2016-12-08 10:27:47', '2016-12-08 10:27:47', 'Admin', 0, '', 0.00),
(36, NULL, 'xzcxzc', 'dsadsasd@sad.com', '$2y$10$svOm7vbbIAsVFI7WcFL8MeJgkRerTRrWD3HHa.4.ddZJbingkz9g6', NULL, '2016-12-08 10:28:05', '2016-12-08 10:28:05', 'Admin', 0, '', 0.00),
(37, NULL, 'sdasff', 'dfdas@df.com', '$2y$10$yNuZhWV81ZEbhWwMhpZe3eEPLV9vxAnZj9NDD9ovj7g1c/E42sCf2', NULL, '2016-12-08 10:28:18', '2016-12-08 10:28:18', 'Admin', 0, '', 0.00),
(39, NULL, 'Anton', 'tester@gmail.com', '$2y$10$SznzVfJCuXIlE6hW3qE2Suw0YZib0Xo1yVRF7AaRHna/EgJjUfdAq', 'cCi2ghSlQUb9AYUG7CkWo1J4MFuWRBHJAWiXt3jtcAmWTleITEP4PGgU24iF', '2016-12-08 10:31:45', '2016-12-08 12:00:36', 'Admin', 0, 'no team', 0.00),
(40, NULL, 'Testing', 'testin@gmail.com', '$2y$10$oGSqALqndFdiLBqMleXXvOiX8aZ7Ck8kGjujJcDfk6C42eMAxhckq', NULL, '2016-12-09 05:23:42', '2016-12-09 05:23:42', 'Admin', 0, '', 0.00),
(42, NULL, '  AAAa', 'asdasdd@erewr.com', '$2y$10$TrQSU.RpCZwCne.yoEYES.iyp8vRFcDVDQTvVrxNH6r88xvZJ47V.', NULL, '2016-12-09 05:25:02', '2016-12-09 06:28:54', 'Lead', 1, 'php', 10.00),
(43, NULL, 'Tyzik', 'tyz@gmail.com', '$2y$10$57jm6RTHxfSUKG7otDggruIqXHUK7RWOp/YgjwaLh/aXCUqPHyI9i', NULL, '2016-12-09 06:33:11', '2016-12-09 06:33:11', 'Admin', 0, '', 0.00),
(44, NULL, 'add', 'admin@admin.com', '$2y$10$098xVr3AdbpptAkhtYtUCOWYUEqiaVD/RBEL86W8W0qWDl6cd4DRC', 'GL1JQJlh6PiluMr1rrzhX6u42t7ydvcXT8lfuFih66cMNW9EA2p8OFf27ooE', '2016-12-09 06:43:22', '2016-12-09 06:44:11', 'Admin', 0, 'no team', 0.00);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
