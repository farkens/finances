-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 05 2018 г., 22:48
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `money`
--

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `date` date NOT NULL,
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `account`
--

INSERT INTO `account` (`id`, `name`, `price`, `date`, `userID`, `groupID`) VALUES
(1, 'Наличка', '10000.0000', '2018-02-23', 2, 1),
(2, 'Наличка(Олег)', '3000.0000', '2018-02-23', 1, 1),
(3, 'Карта сбера', '4500.0000', '2018-02-23', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `accountGroup`
--

CREATE TABLE `accountGroup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accountGroup`
--

INSERT INTO `accountGroup` (`id`, `name`) VALUES
(1, 'Кошельки'),
(2, 'Карты');

-- --------------------------------------------------------

--
-- Структура таблицы `costs`
--

CREATE TABLE `costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `sum` decimal(19,4) NOT NULL,
  `date` date NOT NULL,
  `userID` int(11) NOT NULL,
  `accountID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `costs`
--

INSERT INTO `costs` (`id`, `name`, `comment`, `sum`, `date`, `userID`, `accountID`) VALUES
(2, 'Проезд', 'От аэропорта до метро и от метро до дома 40 + 90', '130.0000', '2018-04-07', 1, 1),
(3, 'Магазин', 'Дикси ', '241.0000', '2018-04-07', 1, 1),
(4, 'Магазин', 'Продукты в дикси (2 чека )', '620.0000', '2018-04-07', 1, 1),
(5, 'За квартиру', '1 взнос за квартиру с залогом 14 + 7', '21000.0000', '2018-04-07', 1, 1),
(6, 'Проезд', 'До Ильи и обрато', '205.0000', '2018-04-08', 1, 1),
(7, 'Лента', 'для брата и вещи 1 необходимости', '2000.0000', '2018-04-08', 1, 1),
(8, 'Продукты дикси', 'маслок, колбаса, хлеб', '222.0000', '2018-04-09', 1, 1),
(9, 'Продукты дикси', 'к обеду на день', '295.0000', '2018-04-17', 1, 1),
(10, 'проезд с братом', 'на весь день сразу', '225.0000', '2018-04-15', 1, 1),
(11, 'продукты дикси', 'на обед на завтра', '464.0000', '2018-04-17', 1, 1),
(12, 'Продукты пятерочка', 'покупадли с братом', '938.0000', '2018-04-15', 1, 1),
(13, 'Продукты пятерочка', 'На неделю и встречать брата', '886.0000', '2018-04-12', 1, 1),
(14, 'продукты перекресток', 'дезик', '375.0000', '2018-04-14', 1, 1),
(15, 'Гламарт', 'себе для быта и брату', '701.0000', '2018-04-15', 1, 1),
(16, 'дикси', 'перец морожка майонез', '97.0000', '2018-04-14', 1, 1),
(17, 'Дикси', 'Приправки', '75.0000', '2018-04-14', 1, 1),
(18, 'Дикси', 'К чаю', '353.0000', '2018-04-14', 1, 1),
(19, 'Лента', 'Доска разделачная и продукты', '433.0000', '2018-04-19', 1, 1),
(20, 'Шаурма', 'Кафе 24 часа в подвале на 3,5 балов', '160.0000', '2018-04-21', 1, 2),
(21, 'Перекресток', 'Кетчуп', '99.0000', '2018-04-21', 1, 2),
(22, 'Бытовуха', 'лампочка и выключатель', '77.0000', '2018-04-22', 1, 2),
(23, 'Дикси', 'на суп', '50.0000', '2018-04-23', 1, 2),
(24, 'Пятерочка', 'продукты', '228.0000', '2018-04-26', 1, 2),
(25, 'Дикси', 'молоко, рулет', '178.0000', '2018-04-25', 1, 2),
(26, 'Пернкресток продукты', 'продукты', '262.0000', '2018-04-27', 1, 2),
(27, 'Лента', 'Сладости', '490.0000', '2018-04-22', 1, 2),
(28, 'Интернет', 'за 2 месяца', '500.0000', '2018-05-04', 1, 2),
(29, 'Кино', 'за себя и брата', '500.0000', '2018-04-22', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `finance`
--

CREATE TABLE `finance` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `sum` decimal(19,4) NOT NULL,
  `date` date NOT NULL,
  `userID` int(11) NOT NULL,
  `accountID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `finance`
--

INSERT INTO `finance` (`id`, `name`, `comment`, `sum`, `date`, `userID`, `accountID`) VALUES
(1, 'получил от мамы', 'налоичка', '10000.0000', '2018-04-06', 1, 1),
(2, 'Дала бабушка', 'в дорогу', '1000.0000', '2018-04-06', 1, 1),
(3, 'Давал папа', 'Отложенные', '20000.0000', '2018-04-06', 1, 1),
(4, 'Доход', 'перепрадажа', '1000.0000', '2018-04-05', 1, 1),
(5, 'Доход', 'перепрадажа', '1000.0000', '2018-04-05', 2, 1),
(6, 'на карту', 'от мамы', '4800.0000', '2018-04-23', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `status` int(11) NOT NULL,
  `auth_key` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `secret_key` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `status`, `auth_key`, `created_at`, `updated_at`, `secret_key`) VALUES
(1, 'Oleg', 'lassgel@gmail.com', '$2y$13$ccnZXFXzg6kUxC3UuR8c2.sviv6SsbsIZpipUCsWkS30dK3sywRDy', 10, 'pwVClPGsyje7p2Jyr07oOrFnj9rnFbfo', 1518696347, 1518696347, NULL),
(2, 'farkens', 'bulkov_olegandre@mail.ru', '$2y$13$dYG/gg3glfnuaBEItWFQUekfF77FLCnCBme7KQQdjHNKSqQxHC09i', 10, 'fHyvl15nohsbKId8qvX1UGudUyBolcHq', 1524381529, 1524381529, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `accountGroup`
--
ALTER TABLE `accountGroup`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `accountGroup`
--
ALTER TABLE `accountGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
