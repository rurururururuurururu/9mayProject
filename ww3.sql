-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 03 2025 г., 18:17
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
-- База данных: `ww3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(200) DEFAULT NULL,
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author_id`, `created_at`, `updated_at`, `image`, `views`) VALUES
(10, 'Воевавший пра-дед одного из создателей сайта', 'Уразаев Жулкарнай Искакович (20.11.1924 г. — 1987 г.)\r\n\r\nПризван 1942 г. Ленинским РВК. Встал на учет 1946 г. в Бишкульском РВК. Проходил службу: Участник войны с Японией, Дальневосточный фронт, порт. «Артур», старшина роты. Старшина. Награды: ордена Отечественной войны I и II ст., медали «За победу над Германией», «За победу над Японией», «За освоение целинных земель», «За доблестный труд. В ознаменование 100-летия со дня рождения В.И. Ленина», юбилейные медали. Умер в 1987 г. Похоронен в с. Толмачевка Бишкульского р-на.', 11, '2025-06-23 13:35:15', '2025-06-24 09:58:27', 'article_10_1750757739.jpg', 0),
(14, 'Григорьев Виктор Андреевич (Воевавший родственник одного из создателей сайта)', 'Воинское звание: старший лейтенант.', 11, '2025-06-24 09:46:15', '2025-06-24 09:58:00', 'article_14_1750759062.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `battle`
--

CREATE TABLE `battle` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `result` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `battle`
--

INSERT INTO `battle` (`id`, `name`, `description`, `result`, `start_date`, `end_date`, `latitude`, `longitude`, `slug`) VALUES
(1, 'Битва за Москву', 'Крупнейшее сражение начального периода войны, в ходе которого Красная Армия остановила наступление группы армий «Центр» и перешла в контрнаступление.', 'Стратегическая победа СССР', '1941-09-30', '1942-04-20', 55.75580000, 37.61730000, 'bitva-za-moskvu'),
(2, 'Сталинградская битва', 'Коренной перелом в ходе Великой Отечественной войны. Окружение и разгром 6-й армии вермахта под Сталинградом.', 'Стратегическая победа СССР, коренной перелом в войне', '1942-07-17', '1943-02-02', 48.70800000, 44.51330000, 'stalingradskaya-bitva'),
(3, 'Блокада Ленинграда', 'Трагическая и героическая осада города, продолжавшаяся 872 дня. Полностью снята в ходе Ленинградско-Новгородской операции.', 'Прорыв и полное снятие блокады', '1941-09-08', '1944-01-27', 59.93430000, 30.33510000, 'blokada-leningrada'),
(4, 'Курская битва', 'Одно из ключевых сражений Второй мировой войны. Крупнейшее танковое сражение в истории. Окончательно закрепило стратегическую инициативу за Красной Армией.', 'Стратегическая победа СССР', '1943-07-05', '1943-08-23', 51.73430000, 36.18540000, 'kurskaya-bitva'),
(5, 'Штурм Берлина', 'Завершающая стратегическая наступательная операция советских войск на европейском театре военных действий, в ходе которой был взят Берлин.', 'Безоговорочная капитуляция Германии', '1945-04-16', '1945-05-02', 52.52000000, 13.40500000, 'shturm-berlina');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `content` text NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `frontline`
--

CREATE TABLE `frontline` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `ussr_territory_coords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ussr_territory_coords`)),
  `axis_territory_coords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`axis_territory_coords`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `frontline`
--

INSERT INTO `frontline` (`id`, `event_date`, `ussr_territory_coords`, `axis_territory_coords`) VALUES
(1, '1941-11-30', '[[62, 33], [56, 36], [53, 38], [47, 38], [47, 55], [62, 55], [62, 33]]', '[[62, 33], [56, 36], [53, 38], [47, 38], [47, 13], [52, 13], [62, 33]]'),
(2, '1942-11-18', '[[62, 38], [55, 39], [50, 43], [48, 44], [44, 48], [44, 55], [62, 55], [62, 38]]', '[[62, 38], [55, 39], [50, 43], [48, 44], [44, 48], [44, 13], [52, 13], [62, 38]]'),
(3, '1943-12-01', '[[62, 30], [51, 31], [47, 33], [47, 55], [62, 55], [62, 30]]', '[[62, 30], [51, 31], [47, 33], [47, 13], [52, 13], [62, 30]]'),
(4, '1945-01-15', '[[58, 22], [52, 18], [48, 20], [48, 55], [58, 55], [58, 22]]', '[[58, 22], [52, 18], [48, 20], [48, 13], [54, 13], [58, 22]]');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, 'Abdul', '$2y$13$S3ufLRw8TahH1EAKXQ6SXu5nGk.ebU3t9EYLGan5GtcHifb8bBSpa', '-oV3lBIj1RdC-y0X0KKXC2T3v3lD8cix', 0),
(11, 'admin', '$2y$13$xBbbeAhuoKp6miwbUxQN3Obop5WjOEIN6eqVaNdCKl1dO2dg1f6Ti', 'O2Bs2GOfWiqlk2hmv3Td8jzU51jexxaE', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `veteran_stories`
--

CREATE TABLE `veteran_stories` (
  `id` int(11) NOT NULL,
  `veteran_name` varchar(100) NOT NULL,
  `story` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `battle`
--
ALTER TABLE `battle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `frontline`
--
ALTER TABLE `frontline`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploader_id` (`uploader_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `veteran_stories`
--
ALTER TABLE `veteran_stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `battle`
--
ALTER TABLE `battle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `frontline`
--
ALTER TABLE `frontline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `veteran_stories`
--
ALTER TABLE `veteran_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_author` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photos_uploader` FOREIGN KEY (`uploader_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `veteran_stories`
--
ALTER TABLE `veteran_stories`
  ADD CONSTRAINT `fk_veteran_added_by` FOREIGN KEY (`added_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
