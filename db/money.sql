-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 22 2018 г., 22:40
-- Версия сервера: 5.7.21-0ubuntu0.16.04.1
-- Версия PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'За квартиру', 'наличкой хозяйке', '10000.0000', '2018-03-02', 1, 1);

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
(1, 'Зарплата', 'за 2 сайта (редактированное)', '65000.0000', '2018-03-03', 1, 1),
(2, 'Подарок на ДР', 'от бабушки', '2000.0000', '2017-05-07', 1, 1),
(3, 'Продал ноутбук', 'Hp dv6', '25000.0000', '2018-03-07', 1, 2),
(4, 'Начислили бонусы', '1% от карты', '100.0000', '2018-02-28', 1, 2),
(6, 'Тестовый', 'с сайта', '60.0000', '2018-04-23', 1, 2),
(9, 'crud', 'с мадального окна тестовый', '225.0000', '2018-03-17', 1, 2),
(10, 'Зарплата', 'Верста адаптивности', '25000.0000', '2018-03-02', 1, 1),
(11, 'Вернули долг', 'Александр', '2000.0000', '2018-03-20', 1, 2);

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
(1, 'Oleg', 'lassgel@gmail.com', '$2y$13$ccnZXFXzg6kUxC3UuR8c2.sviv6SsbsIZpipUCsWkS30dK3sywRDy', 10, 'pwVClPGsyje7p2Jyr07oOrFnj9rnFbfo', 1518696347, 1518696347, NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
