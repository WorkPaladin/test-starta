-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 07 2019 г., 22:31
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user_date`
--

CREATE TABLE `user_date` (
  `id` int(11) NOT NULL,
  `user_phone` text NOT NULL,
  `user_day` int(11) NOT NULL,
  `reserved_day` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_date`
--

INSERT INTO `user_date` (`id`, `user_phone`, `user_day`, `reserved_day`) VALUES
(89, ' 7 (222) 222-22-22', 189, 'Mon Jul 08 2019 00:00:00 GMT 0700 (Красноярск, стандартное время)'),
(90, ' 7 (566) 666-66-66', 290, 'Thu Oct 17 2019 00:00:00 GMT 0700 (Красноярск, стандартное время)');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user_date`
--
ALTER TABLE `user_date`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user_date`
--
ALTER TABLE `user_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
