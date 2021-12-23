-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2021 г., 22:06
-- Версия сервера: 10.3.29-MariaDB
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `codelearn`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_number` int(11) NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_to_image` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chapters`
--

INSERT INTO `chapters` (`chapter_id`, `title`, `chapter_number`, `language`, `path_to_image`, `created_at`, `updated_at`) VALUES
(1, 'Основы HTML', 1, 'HTML', '/image/1_1198632617_1640276635.jpg', '2021-12-23 16:23:55', '2021-12-23 13:23:55'),
(2, 'Тестовые задания', 2, 'HTML', '/image/1_299722335_1640285984.jpg', '2021-12-23 18:59:44', '2021-12-23 15:59:44');

-- --------------------------------------------------------

--
-- Структура таблицы `languages_users`
--

CREATE TABLE `languages_users` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `partners`
--

CREATE TABLE `partners` (
  `partner_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `programming_languages`
--

CREATE TABLE `programming_languages` (
  `language_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_creation` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `programming_languages`
--

INSERT INTO `programming_languages` (`language_id`, `name`, `creator`, `year_creation`, `created_at`, `updated_at`) VALUES
(2, 'HTML', 'Тим Бернерс-Ли', '1991-08-06', '2021-12-21 16:22:07', '2021-12-21 13:22:07'),
(9, 'CSS', 'CSS Working Group', '1996-12-17', '2021-12-21 17:44:15', '2021-12-21 14:44:15');

-- --------------------------------------------------------

--
-- Структура таблицы `recordings`
--

CREATE TABLE `recordings` (
  `recording_id` int(11) NOT NULL,
  `record_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapters` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_to_image` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_text` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `recordings`
--

INSERT INTO `recordings` (`recording_id`, `record_number`, `language`, `chapters`, `title`, `path_to_image`, `learning_text`, `created_at`, `updated_at`) VALUES
(5, '2', 'HTML', 'Основы HTML', 'asadadsadssad', '/image/1_731538458_1640276834.jpg', 'dssaddasadsads', '2021-12-23 16:27:14', '2021-12-23 13:27:14'),
(6, '2', 'HTML', 'Основы HTML', 'Запись 2', '/image/1_1004931053_1640285205.jpg', 'фвывфыфвыфвы', '2021-12-23 18:46:45', '2021-12-23 15:46:45'),
(7, '3', 'HTML', 'Тестовые задания', '3333', '/image/1_2006018286_1640286063.jpg', 'фывфыыфвыфвфы', '2021-12-23 19:01:03', '2021-12-23 16:01:03');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_course` int(11) DEFAULT NULL,
  `path_to_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `surname`, `password`, `completed_course`, `path_to_image`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(9, 'admin', 'Иван', 'Размыслов', '$2y$10$TGd8OQdheNdouO8EzkPRzO/LTYsy5V1014SHwcT.Cn73pWDzGiWe.', NULL, '/image/1_1125914270_1639988924.jpg', 'jAfpox8jDT5iB2Ww3WoaJHGdkmGmd1HfnL1RikZ1K4ihxnMtdut2yMplI9NQ', '2', '2021-12-20 08:28:44', '2021-12-21 17:09:30');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Индексы таблицы `languages_users`
--
ALTER TABLE `languages_users`
  ADD PRIMARY KEY (`course_id`);

--
-- Индексы таблицы `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Индексы таблицы `programming_languages`
--
ALTER TABLE `programming_languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Индексы таблицы `recordings`
--
ALTER TABLE `recordings`
  ADD PRIMARY KEY (`recording_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `languages_users`
--
ALTER TABLE `languages_users`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `programming_languages`
--
ALTER TABLE `programming_languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `recordings`
--
ALTER TABLE `recordings`
  MODIFY `recording_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
