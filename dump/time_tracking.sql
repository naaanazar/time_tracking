-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 06 2016 г., 16:39
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

--
-- Дамп данных таблицы `Clients`
--

INSERT INTO `Clients` (`id`, `company_name`, `company_address`, `website`, `contact_person`, `email`, `phone_number`, `updated_at`, `created_at`) VALUES
(1, 'compane', 'address', 'www.comashka.com', 'Losos', 'los@gmsil.com', '12-12-12', '2016-12-06', '2016-12-06');

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
  `hourly_rate` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `team_name`) VALUES
(1, 'php'),
(2, 'js'),
(3, 'ruby'),
(5, 'js_test');

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
  `team_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hourly_rate` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `employe`, `team_name`, `hourly_rate`) VALUES
(2, NULL, '     terr ', 'terr@gmail.coms', '$2y$10$oHZj9FU1lHC3hctB90asLuGaSmqRk2ZYWzNd0jqZjpZ7tlW48RAFK', 'ne9kCi10JEKFS1RITjQwRXfCKPjbBA2rUV93R8r7ysyASTH3v3l57vVl5oxg', '2016-12-02 07:13:16', '2016-12-06 06:27:19', 'Admin', 'php', NULL),
(21, NULL, 'Dimon', 'terr83@gmail.com', '$2y$10$riKLtYoevHmMIqrtlcVU9.V03FhA.P86EDPxMUG1RIeNLi6toC4XO', 'ZeLXfUJX2kn2zdiq8XeQa1YJkv77C6SKPzq3wePYJQOHghAjDIiJnBiuCSur', '2016-12-05 12:18:52', '2016-12-05 12:24:34', 'Admin', 'js', NULL),
(22, NULL, 'terri', 'terri@gmail.com', '$2y$10$9ShoW/vNKAX245w1IU.vD.fyscR.ZdQiGzADrXcWFsoT8zmFyDMqO', 'R4wASBj002TNY6EFM7mnNWBezYfummvLfGkuWUFG', '2016-12-05 13:03:10', '2016-12-05 13:03:10', 'Admin', 'php', NULL),
(23, NULL, 'asdasd', 'asdas@dsfdfs.com', '$2y$10$rvJvGqoTiyLOtuwwBZWuBuVEd61l92/8l1nLjuG1Ah6TYi./hKps2', NULL, '2016-12-06 07:32:45', '2016-12-06 07:32:45', 'Admin', '', NULL),
(24, NULL, 'Anton', 'anton@gmail.com', '$2y$10$jmK4Kf09EyHZaKUHGLC.luCzQnB30bppQfrdgay6pdXFQngp9zb16', NULL, '2016-12-06 11:01:52', '2016-12-06 11:01:52', 'Developer', 'js', NULL),
(25, NULL, 'Nazal', 'nazar@gmail.com', '$2y$10$SBqmNY8Lfpyk7yJhoyQPE.2cW5wcwiAOdODV7jmGwa9dOFAWPA0gG', NULL, '2016-12-06 11:02:48', '2016-12-06 11:02:48', 'Developer', 'php', NULL),
(26, NULL, 'Voldemort', 'vold@gmail.com', '$2y$10$KokVdfiMx7dSpXZZr/E7BezipXq4lBmNz0rNE4FxzRYj.XGux3rIG', NULL, '2016-12-06 11:03:15', '2016-12-06 11:03:15', 'HR Manager', '', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
