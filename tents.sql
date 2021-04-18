-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 09 2021 г., 08:10
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tents`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `PK_Brand` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`PK_Brand`, `name`) VALUES
(1, 'Higashi'),
(2, 'Tramp'),
(3, 'Canadian'),
(4, 'Husky'),
(5, 'Normal');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `PK_Category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`PK_Category`, `name`) VALUES
(1, 'зима'),
(2, 'лето'),
(3, 'весна-осень'),
(4, 'ультралёгкая'),
(5, 'комфорт');

-- --------------------------------------------------------

--
-- Структура таблицы `tent`
--

CREATE TABLE `tent` (
  `PK_Tent` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `weight` decimal(3,2) NOT NULL DEFAULT 0.00,
  `places` int(2) NOT NULL DEFAULT 2,
  `doors` int(10) NOT NULL DEFAULT 0,
  `windows` int(2) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `PK_Category` int(11) NOT NULL,
  `PK_Brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tent`
--

INSERT INTO `tent` (`PK_Tent`, `name`, `price`, `weight`, `places`, `doors`, `windows`, `description`, `image_path`, `PK_Category`, `PK_Brand`) VALUES
(1, 'Tramp Peak 3 v2', '13900.00', '3.90', 3, 2, 1, 'Это описание палатки Trapm Peak 3 v2 aaaaaaaaa', '', 5, 2),
(2, 'Canadian Camper Rino 2', '8970.00', '4.20', 2, 3, 0, 'Canadian Camper Rino 2 bbbbbbbbb', '', 3, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`PK_Brand`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`PK_Category`);

--
-- Индексы таблицы `tent`
--
ALTER TABLE `tent`
  ADD PRIMARY KEY (`PK_Tent`),
  ADD KEY `PK_Category` (`PK_Category`),
  ADD KEY `PK_Brand` (`PK_Brand`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `PK_Brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `PK_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tent`
--
ALTER TABLE `tent`
  MODIFY `PK_Tent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tent`
--
ALTER TABLE `tent`
  ADD CONSTRAINT `tent_ibfk_1` FOREIGN KEY (`PK_Category`) REFERENCES `category` (`PK_Category`),
  ADD CONSTRAINT `tent_ibfk_2` FOREIGN KEY (`PK_Brand`) REFERENCES `brand` (`PK_Brand`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
