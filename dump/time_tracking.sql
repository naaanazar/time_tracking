-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 07 2016 г., 13:44
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
  `project_name` varchar(255) NOT NULL,
  `hourly_rate` decimal(5,2) NOT NULL,
  `notes` text NOT NULL,
  `company` varchar(255) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `task_type` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`,`project_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `team_name`) VALUES
(1, 'php'),
(2, 'js'),
(3, 'ruby');

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
  `team_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no team',
  `hourly_rate` float(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `employe`, `team_name`, `hourly_rate`) VALUES
(2, NULL, '  terr ', 'terr@gmail.coms', '$2y$10$oHZj9FU1lHC3hctB90asLuGaSmqRk2ZYWzNd0jqZjpZ7tlW48RAFK', 'UzpDLGbrN2d6sa6x3Z9UKhzKhbo2oszSoYP6wAjcf56BOMS8IGVSuTtO9bi0', '2016-12-02 07:13:16', '2016-12-06 13:38:55', 'Admin', 'php', 9.11),
(21, NULL, 'Dimon', 'terr83@gmail.com', '$2y$10$riKLtYoevHmMIqrtlcVU9.V03FhA.P86EDPxMUG1RIeNLi6toC4XO', 'ZeLXfUJX2kn2zdiq8XeQa1YJkv77C6SKPzq3wePYJQOHghAjDIiJnBiuCSur', '2016-12-05 12:18:52', '2016-12-06 13:18:46', 'Admin', 'js', 0.04),
(22, NULL, ' terri', 'terri@gmail.com', '$2y$10$9ShoW/vNKAX245w1IU.vD.fyscR.ZdQiGzADrXcWFsoT8zmFyDMqO', 'R4wASBj002TNY6EFM7mnNWBezYfummvLfGkuWUFG', '2016-12-05 13:03:10', '2016-12-06 13:04:39', 'Admin', 'php', 10.10),
(23, NULL, 'Masik', 'asdas@dsfdfs.com', '$2y$10$rvJvGqoTiyLOtuwwBZWuBuVEd61l92/8l1nLjuG1Ah6TYi./hKps2', NULL, '2016-12-06 07:32:45', '2016-12-06 13:13:23', 'Developer', 'js', 0.06),
(24, NULL, 'Anton', 'anton@gmail.com', '$2y$10$jmK4Kf09EyHZaKUHGLC.luCzQnB30bppQfrdgay6pdXFQngp9zb16', NULL, '2016-12-06 11:01:52', '2016-12-06 12:56:39', 'Developer', 'php', 8.65),
(25, NULL, ' Nazal', 'nazar@gmail.com', '$2y$10$SBqmNY8Lfpyk7yJhoyQPE.2cW5wcwiAOdODV7jmGwa9dOFAWPA0gG', NULL, '2016-12-06 11:02:48', '2016-12-06 12:50:37', 'Developer', 'js', 10.10),
(26, NULL, ' Voldemort', 'vold@gmail.com', '$2y$10$KokVdfiMx7dSpXZZr/E7BezipXq4lBmNz0rNE4FxzRYj.XGux3rIG', NULL, '2016-12-06 11:03:15', '2016-12-06 13:05:18', 'Developer', 'js', 8.00),
(27, NULL, '  Anton', 'an@gmail.com', '$2y$10$mEzQ.b0mX8H9qTSR27vrN.uq64KQF9O0jW4mdVBFEPY4N8gXIpiu6', NULL, '2016-12-06 13:40:59', '2016-12-06 13:42:29', 'Admin', 'php', 10.00),
(30, NULL, 'Terrorist', 'anton.soft.gr@gmail.com', '$2y$10$jA9MMTGxmCbRwiEpMWsm1OaoFArIkKnyB4C612K7ANUS9sdkkJWy.', NULL, '2016-12-07 05:23:32', '2016-12-07 05:23:32', 'Admin', 'no team', 0.00),
(31, NULL, 'New Admin', 'new@gmail.com', '$2y$10$dhHa2OHYFDIUSjuEk73UhuMIDpjEeUnv7bw4/flzTAdJhA/0kLndi', NULL, '2016-12-07 05:42:39', '2016-12-07 05:42:39', 'Admin', '', NULL),
(32, NULL, ' Toxic', 'tex@gmail.com', '$2y$10$zwihoNnJcMOr0BDad.xAB.6woYxhQhnDL531OVT1QCaaL2XpQc2k.', NULL, '2016-12-07 05:43:46', '2016-12-07 05:44:13', 'Developer', 'php', 10.10);

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
