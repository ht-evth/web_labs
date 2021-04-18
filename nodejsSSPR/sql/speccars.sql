-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 01 2021 г., 20:01
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `speccars`
--

-- --------------------------------------------------------

--
-- Структура таблицы `avtocategory`
--

CREATE TABLE `avtocategory` (
  `PK_Category` int(11) NOT NULL,
  `nameCategory` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `avtocategory`
--

INSERT INTO `avtocategory` (`PK_Category`, `nameCategory`) VALUES
(1, 'Автокран'),
(2, 'Комбайн'),
(3, 'Погрузчик'),
(4, 'Бетономеситель');

-- --------------------------------------------------------

--
-- Структура таблицы `avtofirm`
--

CREATE TABLE `avtofirm` (
  `PK_AvtoFirm` int(11) NOT NULL,
  `firmName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `avtofirm`
--

INSERT INTO `avtofirm` (`PK_AvtoFirm`, `firmName`) VALUES
(1, 'МАЗ'),
(2, 'КАМАЗ'),
(3, 'Урал'),
(4, 'Scania');

-- --------------------------------------------------------

--
-- Структура таблицы `baseavto`
--

CREATE TABLE `baseavto` (
  `PK_BaseAvto` int(11) NOT NULL,
  `modelName` varchar(200) NOT NULL,
  `PK_AvtoFirm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `baseavto`
--

INSERT INTO `baseavto` (`PK_BaseAvto`, `modelName`, `PK_AvtoFirm`) VALUES
(1, '5340С-2', 1),
(2, 'S500', 4),
(3, '43118', 2),
(4, '53605', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `PK_Car` int(11) NOT NULL,
  `yearIssue` year(4) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `imagePath` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `PK_BaseAvto` int(11) NOT NULL,
  `PK_Superstructure` int(11) NOT NULL,
  `PK_Category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`PK_Car`, `yearIssue`, `price`, `imagePath`, `description`, `PK_BaseAvto`, `PK_Superstructure`, `PK_Category`) VALUES
(1, 2019, '5500000.00', NULL, 'akjdlhjash djkashd jksahdjk ashdj рфыаолрфылвр ыфвр олыфрв олфырв олфырв олрягшчср ячср ншяпеа чсобм ояраш вап рлчяс сп гвпанваля мчсм чсм аыв а', 3, 1, 1),
(2, 2017, '6500000.00', NULL, 'Ну это типа сканиа', 2, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `superstructure`
--

CREATE TABLE `superstructure` (
  `PK_Superstructure` int(11) NOT NULL,
  `supestructureName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `superstructure`
--

INSERT INTO `superstructure` (`PK_Superstructure`, `supestructureName`) VALUES
(1, 'Кран MH-55'),
(3, 'Цистерна'),
(4, 'Бетономеситель BHS Sonthofen');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `avtocategory`
--
ALTER TABLE `avtocategory`
  ADD PRIMARY KEY (`PK_Category`);

--
-- Индексы таблицы `avtofirm`
--
ALTER TABLE `avtofirm`
  ADD PRIMARY KEY (`PK_AvtoFirm`);

--
-- Индексы таблицы `baseavto`
--
ALTER TABLE `baseavto`
  ADD PRIMARY KEY (`PK_BaseAvto`),
  ADD KEY `IX_Relationship3` (`PK_AvtoFirm`);

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`PK_Car`,`PK_BaseAvto`,`PK_Superstructure`),
  ADD KEY `IX_Relationship6` (`PK_Category`),
  ADD KEY `Relationship4` (`PK_BaseAvto`),
  ADD KEY `Relationship5` (`PK_Superstructure`);

--
-- Индексы таблицы `superstructure`
--
ALTER TABLE `superstructure`
  ADD PRIMARY KEY (`PK_Superstructure`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `avtocategory`
--
ALTER TABLE `avtocategory`
  MODIFY `PK_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `avtofirm`
--
ALTER TABLE `avtofirm`
  MODIFY `PK_AvtoFirm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `baseavto`
--
ALTER TABLE `baseavto`
  MODIFY `PK_BaseAvto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `PK_Car` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `superstructure`
--
ALTER TABLE `superstructure`
  MODIFY `PK_Superstructure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `baseavto`
--
ALTER TABLE `baseavto`
  ADD CONSTRAINT `Relationship3` FOREIGN KEY (`PK_AvtoFirm`) REFERENCES `avtofirm` (`PK_AvtoFirm`);

--
-- Ограничения внешнего ключа таблицы `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `Relationship4` FOREIGN KEY (`PK_BaseAvto`) REFERENCES `baseavto` (`PK_BaseAvto`),
  ADD CONSTRAINT `Relationship5` FOREIGN KEY (`PK_Superstructure`) REFERENCES `superstructure` (`PK_Superstructure`),
  ADD CONSTRAINT `Relationship6` FOREIGN KEY (`PK_Category`) REFERENCES `avtocategory` (`PK_Category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
