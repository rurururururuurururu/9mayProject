-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 19 2025 г., 05:49
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gfw`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(1, 'Начало Великой Отечественной войны', '22 июня 1941 года войска нацистской Германии пересекли границу СССР. Это событие стало началом самой кровопролитной войны в истории нашей страны. Первые дни войны были особенно тяжелыми для Красной Армии...', NULL, '2025-06-18 03:21:25'),
(2, 'Битва за Москву', 'Крупнейшее сражение осени 1941 года, в котором советские войска остановили продвижение немецкой группы армий \"Центр\". Контрнаступление под Москвой началось 5 декабря 1941 года и стало первым стратегическим поражением вермахта...', NULL, '2025-06-18 03:21:25'),
(3, 'Блокада Ленинграда', 'Одна из самых трагических страниц войны. Город находился в осаде 872 дня - с 8 сентября 1941 по 27 января 1944 года. За время блокады от голода и бомбежек погибло около 1 миллиона ленинградцев...', NULL, '2025-06-18 03:21:25'),
(4, 'Сталинградская битва', 'Переломное сражение Великой Отечественной войны (17 июля 1942 - 2 февраля 1943). Ожесточенные бои в городских кварталах Сталинграда завершились окружением и капитуляцией 6-й армии Паулюса...', NULL, '2025-06-18 03:21:25'),
(5, 'Курская битва', 'Крупнейшее танковое сражение в истории (5 июля - 23 августа 1943). Операция \"Цитадель\" стала последним крупным наступлением вермахта на Восточном фронте. Под Прохоровкой сошлись 1200 танков...', NULL, '2025-06-18 03:21:25'),
(6, 'Операция \"Багратион\"', 'Крупнейшая наступательная операция лета 1944 года в Белоруссии. В результате была полностью освобождена территория БССР и разгромлена группа армий \"Центр\". Советские войска продвинулись на 600 км...', NULL, '2025-06-18 03:21:25'),
(7, 'Берлинская операция', 'Завершающая стратегическая операция (16 апреля - 8 мая 1945). Штурм столицы Третьего рейха продолжался две недели. Знамя Победы было водружено над Рейхстагом 1 мая 1945 года...', NULL, '2025-06-18 03:21:25'),
(8, 'Подвиг тружеников тыла', 'В годы войны советский тыл показал невиданную стойкость и производительность. На эвакуированных заводах женщины и подростки работали по 14-16 часов в сутки, обеспечивая фронт техникой и боеприпасами...', NULL, '2025-06-18 03:21:25'),
(9, 'Партизанское движение', 'Крупнейшее сопротивление на оккупированных территориях. К 1943 году в партизанских отрядах сражалось более 1 миллиона человек. Особенно массовым было партизанское движение в Белоруссии и Брянской области...', NULL, '2025-06-18 03:21:25'),
(11, 'ЕК', '1212', NULL, '0000-00-00 00:00:00'),
(12, '123', '123', NULL, '2025-06-19 03:36:05'),
(13, '3eqwda', 'dsafdsfds', 'article_13_1750286770.jpg', '2025-06-19 03:36:25');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `auth_key`, `is_admin`) VALUES
(1, 'Abdul', '$2y$13$S3ufLRw8TahH1EAKXQ6SXu5nGk.ebU3t9EYLGan5GtcHifb8bBSpa', '-oV3lBIj1RdC-y0X0KKXC2T3v3lD8cix', 1),
(3, 'mai', '$2y$13$znHd95hq7vqgggPtnp7oEuGxAgDE5Wg9LOc.ezmrpsL4blgST/xU6', 'lh3bxyQoP6gJk_3edxxerrYQ_rJYC2mB', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
