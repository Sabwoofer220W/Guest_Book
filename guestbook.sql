-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 27 2022 г., 11:45
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `username` char(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `username`, `date`, `text`) VALUES
(1, 'TestName', '2022-03-26 15:45:49', 'Test Test Test Test Test'),
(2, 'TestName2', '2022-03-26 15:45:51', '123213213'),
(3, 'Кузов Максим Аресович', '2022-03-22 21:38:06', '123213213'),
(160, 'Anonymous', '2022-03-26 18:43:06', '1'),
(161, 'Anonymous', '2022-03-26 18:43:09', '2'),
(162, 'Anonymous', '2022-03-26 18:43:11', '3'),
(163, 'Anonymous', '2022-03-26 18:43:14', '4'),
(164, 'Anonymous', '2022-03-26 18:43:16', '5'),
(165, 'Anonymous', '2022-03-26 18:43:18', '6'),
(166, 'Anonymous', '2022-03-26 18:43:20', '7'),
(167, 'Anonymous', '2022-03-26 18:43:22', '8'),
(168, 'Anonymous', '2022-03-26 18:43:24', '9'),
(169, 'Anonymous', '2022-03-26 18:43:29', '10'),
(171, 'Anonymous', '2022-03-26 21:36:18', '11'),
(172, 'Anonymous', '2022-03-26 21:36:21', '12'),
(173, 'Anonymous', '2022-03-26 21:36:25', '13'),
(174, 'Anonymous', '2022-03-26 21:36:28', '14'),
(175, 'Anonymous', '2022-03-26 21:36:31', '15'),
(176, 'Anonymous', '2022-03-26 21:36:33', '16'),
(177, 'Anonymous', '2022-03-26 21:36:37', '17'),
(178, 'Anonymous', '2022-03-26 21:36:40', '18'),
(179, 'Anonymous', '2022-03-26 21:36:44', '19'),
(180, 'Anonymous', '2022-03-26 21:36:46', '20'),
(181, 'TestEm5', '2022-03-27 10:42:22', 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `rank`
--

CREATE TABLE `rank` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rank`
--

INSERT INTO `rank` (`id`, `login`, `password`, `mail`, `role`) VALUES
(4, 'TestEm5', '9368894d6cff4304a09f463e40bbbcbb', '1@mail.ru', ''),
(5, 'TestEm5 2', '9368894d6cff4304a09f463e40bbbcbb', 'gachimuchisound@bk.ru', ''),
(6, 'Admin', '9368894d6cff4304a09f463e40bbbcbb', '1@mail.ru', ''),
(7, 'Anonymous', '9368894d6cff4304a09f463e40bbbcbb', '1@mail.ru', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT для таблицы `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
