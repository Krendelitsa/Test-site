-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 06 2021 г., 16:52
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
-- База данных: `telehlam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat_access`
--

CREATE TABLE `chat_access` (
  `id` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `read_status` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chat_access`
--

INSERT INTO `chat_access` (`id`, `id_theme`, `id_user`, `read_status`, `status`) VALUES
(8, 25, 3, 0, 2),
(14, 31, 3, 0, 3),
(21, 25, 1, 0, 2),
(22, 31, 1, 0, 2),
(23, 31, 4, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `chat_thems`
--

CREATE TABLE `chat_thems` (
  `id` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci DEFAULT '/pic/big/0435ad76732c9883d2e395351b521089.png',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chat_thems`
--

INSERT INTO `chat_thems` (`id`, `id_creator`, `name`, `img`, `status`) VALUES
(25, 3, '1245', '/pic/big/33c16425072807b4f51d6f1b6f66db95.png', 2),
(31, 3, 'Ну, привет мир!', '/pic/big/1f9d901cf50a5c9c3f62767cd1bd8d11.png', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `hash`
--

CREATE TABLE `hash` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hash` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hash`
--

INSERT INTO `hash` (`id`, `id_user`, `hash`) VALUES
(1, 3, '418870ae4f75b771c09462758244d125'),
(2, 1, '2d6668fd834cee88ed4ad3c06071e221'),
(3, 4, '69dc613c3ac56f17d9d636cd8376a010');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `textik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `id_user`, `id_theme`, `textik`, `status`, `data`) VALUES
(4, 3, 25, 'Тест            ', 1, 1617537178),
(5, 3, 25, 'Второй тест        ', 1, 1617541444),
(6, 3, 31, 'Начинаю общения, на старт, внимание, марш!', 1, 1617553509),
(7, 1, 25, 'Так-так, это чат', 1, 1617716631),
(8, 1, 25, 'Привет', 1, 1617716906),
(9, 3, 25, 'Йоу, общение', 1, 1617716976),
(10, 1, 31, 'Всем хай в этом чатике', 1, 1617717092),
(11, 4, 31, 'Ого, я в телевизоре', 1, 1617717108);

-- --------------------------------------------------------

--
-- Структура таблицы `users_chat`
--

CREATE TABLE `users_chat` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci DEFAULT '/pic/big/48a081a5914d7f7bd97d2ec48409a773.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_chat`
--

INSERT INTO `users_chat` (`id`, `login`, `password`, `email`, `img`) VALUES
(1, 'loloshka', '12345', 'popka@durak.ru', '/pic/big/48a081a5914d7f7bd97d2ec48409a773.png'),
(3, 'MyMan2', 'poop123', 'popka@durak.ru', '/pic/big/0435ad76732c9883d2e395351b521089.png'),
(4, 'testfulluser', 'test', 'testfulluser.ru', '/pic/big/48a081a5914d7f7bd97d2ec48409a773.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat_access`
--
ALTER TABLE `chat_access`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_thems`
--
ALTER TABLE `chat_thems`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hash`
--
ALTER TABLE `hash`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat_access`
--
ALTER TABLE `chat_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `chat_thems`
--
ALTER TABLE `chat_thems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `hash`
--
ALTER TABLE `hash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users_chat`
--
ALTER TABLE `users_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
