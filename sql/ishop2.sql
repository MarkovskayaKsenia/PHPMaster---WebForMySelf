-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 10 2020 г., 13:01
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ishop2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_group`
--

CREATE TABLE `attribute_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attribute_group`
--

INSERT INTO `attribute_group` (`id`, `title`) VALUES
(1, 'Механизм'),
(2, 'Стекло'),
(3, 'Ремешок'),
(4, 'Корпус'),
(5, 'Индикация');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_product`
--

CREATE TABLE `attribute_product` (
  `attr_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attribute_product`
--

INSERT INTO `attribute_product` (`attr_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 75),
(1, 76),
(1, 78),
(2, 4),
(2, 77),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 75),
(5, 76),
(5, 78),
(6, 77),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 78),
(9, 75),
(9, 76),
(11, 77),
(12, 1),
(12, 2),
(12, 78),
(13, 75),
(13, 76),
(17, 77),
(18, 1),
(18, 2),
(18, 4),
(18, 75),
(18, 76),
(19, 77),
(19, 78);

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `attr_group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attr_group_id`) VALUES
(1, 'Механизм с автоподзаводом', 1),
(2, 'Механизм с ручным заводом', 1),
(3, 'Кварцевый от батарейки', 1),
(4, 'Кварцевый от солнечного аккумулятора', 1),
(5, 'Сапфировое', 2),
(6, 'Минеральное', 2),
(7, 'Полимерное', 2),
(8, 'Стальной', 3),
(9, 'Кожаный', 3),
(10, 'Каучуковый', 3),
(11, 'Полимерный', 3),
(12, 'Нержавеющая сталь', 4),
(13, 'Титановый сплав', 4),
(14, 'Латунь', 4),
(15, 'Полимер', 4),
(16, 'Керамика', 4),
(17, 'Алюминий', 4),
(18, 'Аналоговые', 5),
(19, 'Цифровые', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'brand-no-img.jpg',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `title`, `alias`, `img`, `description`) VALUES
(1, 'Casio', 'casio', 'abt-1.jpg', 'Описание бренда Casio'),
(2, 'Citizen', 'citizen', 'abt-2.jpg', 'Описание бренда Citizen'),
(3, 'Rolyal London', 'royal-london', 'abt-3.jpg', 'Описание бренда Royal London'),
(4, 'Seiko', 'seiko', 'brand-seiko.jpg', 'Описание бренда Seiko'),
(5, 'Diesel', 'diesel', 'brand-diesel.jpg', 'Описание бренда Diesel');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `alias`, `parent_id`, `keywords`, `description`) VALUES
(1, 'Men', 'men', 0, 'Men', 'Men'),
(2, 'Women', 'women', 0, 'Women', 'Women'),
(3, 'Kids', 'kids', 0, 'Kids', 'Kids'),
(4, 'Электронные', 'electronical', 1, 'Электронные', 'Электронные'),
(5, 'Механические', 'mechanical', 1, 'Механические', 'Механические'),
(6, 'Casio', 'casio', 4, 'Casio', 'Casio'),
(7, 'Citizen', 'citizen', 4, 'Citizen', 'Citizen'),
(8, 'Royal London', 'royal-london', 5, 'Royal London', 'Royal London'),
(9, 'Seiko', 'seiko', 5, 'Seiko', 'Seiko'),
(10, 'Epos', 'epos', 5, 'Epos', 'Epos'),
(11, 'Электронные', 'electronical-11', 2, 'Электронные 2', 'Электронные'),
(12, 'Механические', 'mechanical-12', 2, 'Механические 2', 'Механические'),
(21, 'Тестовая категория', 'testovaya-kategoriya', 3, '1231', '12121'),
(22, 'Еще тест', 'esche-test', 3, '222', '2222'),
(24, 'Я меняю категорию', 'ya-menyayu-kategoriyu', 3, '33333', '4444');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `symbol_left` varchar(10) DEFAULT NULL,
  `symbol_right` varchar(10) DEFAULT NULL,
  `value` float NOT NULL,
  `base` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `code`, `symbol_left`, `symbol_right`, `value`, `base`) VALUES
(1, 'Гривна', 'UAH', NULL, ' грн.', 25.8, '0'),
(2, 'Доллар', 'USD', '$ ', NULL, 1, '1'),
(3, 'Евро', 'EUR', '€ ', NULL, 0.88, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `product_id`, `img`) VALUES
(1, 2, 's-1.jpg'),
(2, 2, 's-2.jpg'),
(3, 2, 's-3.jpg'),
(4, 1, 's-4.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `modification`
--

CREATE TABLE `modification` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modification`
--

INSERT INTO `modification` (`id`, `product_id`, `title`, `price`) VALUES
(1, 1, 'Silver', 300),
(2, 1, 'Black', 300),
(3, 1, 'Dark Black', 305),
(4, 1, 'Red', 310),
(5, 2, 'Silver', 80),
(6, 2, 'Red', 70);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Создан','Завершен') NOT NULL DEFAULT 'Создан',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `status`, `date`, `update_at`, `currency`, `note`) VALUES
(38, 13, 'Завершен', '2020-04-05 12:00:57', '2020-04-23 13:09:25', 'UAH', 'Это рассылка на почту,... '),
(40, 13, 'Завершен', '2020-04-05 12:17:58', '2020-05-10 07:34:12', 'UAH', 'нплпдл'),
(41, 13, 'Создан', '2020-04-05 14:59:50', NULL, 'UAH', 'нплпдл'),
(42, 13, 'Создан', '2020-04-05 15:01:54', NULL, 'UAH', 'нплпдл'),
(43, 13, 'Создан', '2020-04-05 15:03:27', NULL, 'UAH', '1234567'),
(44, 13, 'Завершен', '2020-04-05 15:05:56', '2020-05-10 07:33:45', 'USD', 'ehhf'),
(45, 13, 'Создан', '2020-04-05 15:16:01', NULL, 'USD', 'hhfghfgh'),
(46, 13, 'Создан', '2020-04-05 15:22:04', NULL, 'USD', 'rtwtwt'),
(47, 13, 'Создан', '2020-04-05 15:24:30', NULL, 'USD', 'fghfhh'),
(48, 13, 'Создан', '2020-04-05 15:42:07', NULL, 'USD', 'jkhkhk');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `qty`, `title`, `price`) VALUES
(8, 38, 1, 1, 'Casio G-SHOCK GMW-B5000D-1E', 8488.2),
(9, 38, 2, 1, 'Casio G-SHOCK GST-B200-1AER', 7224),
(10, 38, 4, 1, 'Royal London RL-21462-01-007', 4386),
(13, 40, 1, 1, 'Casio G-SHOCK GMW-B5000D-1E', 8488.2),
(14, 41, 1, 1, 'Casio G-SHOCK GMW-B5000D-1E', 8488.2),
(15, 42, 1, 1, 'Casio G-SHOCK GMW-B5000D-1E', 8488.2),
(16, 43, 1, 1, 'Casio G-SHOCK GMW-B5000D-1E', 8488.2),
(17, 44, 1, 1, 'Casio G-SHOCK GMW-B5000D-1E', 329),
(18, 44, 2, 1, 'Casio G-SHOCK GST-B200-1AER', 280),
(19, 45, 5, 1, 'Royal London RL-41475-02', 230),
(20, 46, 6, 1, 'Royal London RL-41146-04', 350),
(21, 47, 4, 1, 'Royal London RL-21462-01-007', 170),
(22, 48, 5, 1, 'Royal London RL-41475-02', 230);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `content` text,
  `price` float NOT NULL DEFAULT '0',
  `old_price` float NOT NULL DEFAULT '0',
  `status` enum('unactive','active') NOT NULL DEFAULT 'active',
  `keywords` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no_image.jpg',
  `hit` enum('common','hit') NOT NULL DEFAULT 'common'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `alias`, `content`, `price`, `old_price`, `status`, `keywords`, `description`, `img`, `hit`) VALUES
(1, 6, 'Casio G-SHOCK GMW-B5000D-1E', 'gmw-b5000d-1e', 'Перед вами, наделавший много шума, релиз Baselworld 2018 от Casio. Впервые за свою историю легендарный олдскульный корпус GMW-B5000 облачили в сталь.', 329, 370, 'active', 'casio men', 'Японские наручные часы Casio G-SHOCK GMW-B5000D-1E с хронографом', 'p-1.png', 'hit'),
(2, 6, 'Casio G-SHOCK GST-B200-1AER', 'gst-b200-1aer', 'Точность этих противоударных часов оценят пунктуальные мужчины, которые живут активной жизнью.', 280, 300, 'active', 'casio men', 'Японские наручные часы Casio G-SHOCK GST-B200-1AER с хронографом', 'p-2.png', 'hit'),
(3, 6, 'Casio G-SHOCK GMW-B5000TCM-1ER', 'gmw-b5000tcm-1er', 'Практичная и функциональная модель часов от Casio станет верным помощником в жизни активного молодого человека.\r\n', 369, 0, 'active', 'casio men', 'Японские титановые наручные часы Casio G-SHOCK GMW-B5000TCM-1ER с хронографом', 'no_image.jpg', 'hit'),
(4, 6, 'Royal London RL-21462-01-007', 'rl-21462-01', 'Точные часы с аккуратным дизайном - тот аксессуар, который просто необходим на каждый день.', 170, 0, 'active', NULL, NULL, 'p-3.png', 'hit'),
(5, 8, 'Royal London RL-41475-02', 'rl-41475-02', 'Доступный взору механизм и элегантный дизайн этих часов притягивает взгляды. Ничто не подчеркнет ваш стиль лучше.', 230, 0, 'active', NULL, NULL, 'p-4.png', 'hit'),
(6, 9, 'Royal London RL-41146-04', 'rl-41146-04', 'Эти великолепные элегантные часы позволят Вам чувствовать себя уверенно в любой обстановке.\r\nAutomatic. Сквозь прозрачное окошко на циферблате можно наблюдать за работой механизма часов', 350, 360, 'active', NULL, NULL, 'p-5.png', 'hit'),
(7, 7, 'Citizen BM7430-89L-WE456732', 'bm7430-89l', 'Стильные часы – единственный аксессуар, который всегда должен присутствовать в образе мужчины.', 250, 290, 'active', NULL, NULL, 'p-6.png', 'hit'),
(8, 6, 'Citizen BM7360-82M-35648', 'bm7360-82m', 'Классические часы с минимальным набором функций станут верным помощником в вашей повседневной жизни.', 300, 0, 'active', NULL, NULL, 'p-7.png', 'hit'),
(9, 9, 'CITIZEN AT8124-91L', 'at8124-91l', 'Оригинальные и бескомпромиссные функциональные часы для спортивных и смелых детей.', 99, 120, 'active', 'kids citizen', 'Японские наручные часы Citizen AT8124-91L с хронографом', 'no_image.jpg', 'hit'),
(10, 6, 'Добавляем товар Casio 1', 'dobavl-nov-tovar', 'Лучше этих часов ничего и быть не может.!', 145, 100, 'active', 'Casio, мужские, часы', 'Крутые водонепромокаемые мужские часы от Касио', 'no_image.jpg', 'hit'),
(75, 1, 'Самая последняя попытка 222', 'samaya-poslednyaya-popytka-222', '<p>Самая последняя попытка 222</p>\r\n', 333, 222, 'active', 'Самая последняя попытка 222', 'Самая последняя попытка 222', 'no_image.jpg', 'common'),
(76, 1, 'Это просто чудо какое-то', 'eto-prosto-chudo-kakoe-to', '<p>Это просто чудо какое-то</p>\r\n', 222, 3333, 'active', 'Это просто чудо какое-то', 'Это просто чудо какое-то', 'no_image.jpg', 'hit'),
(77, 1, 'Косяки', 'kosyaki', '<p>куйцкуйк</p>\r\n', 444, 444, 'active', 'выаыва', 'выаыавыа', 'no_image.jpg', 'common'),
(78, 8, 'новый товар - часы 1 Royal', 'novyy-tovar---chasy-1-royal', '<p>новый товар - часы <strong>1 Royal</strong></p>\r\n', 222, 111, 'active', 'часы Royal', 'новый товар - часы 1 Royal', 'no_image.jpg', 'hit');

-- --------------------------------------------------------

--
-- Структура таблицы `related_product`
--

CREATE TABLE `related_product` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `related_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `related_product`
--

INSERT INTO `related_product` (`product_id`, `related_id`) VALUES
(1, 2),
(1, 5),
(2, 5),
(2, 10),
(5, 1),
(5, 7),
(5, 8),
(78, 4),
(78, 5),
(78, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `name`, `address`, `role`) VALUES
(1, 'SuperUser', '$2y$10$5gpk10Q.1/G6y08D9YqOtePMwn5T7yvjFGEyUOVSEegAgdhNBrx76', 'triumph.86@mail.ru', 'Ksenia', 'Tomsk', 'admin'),
(2, 'BatUser', '$2y$10$xvcGk5kpVks9994OCDLABelx5dHIHkk2wcBdhy9MKfe3uyft25jyG', 'triumph.76@mail.ru', 'Xena1111', 'Tomsk23344', 'admin'),
(6, 'SuperUser1', '$2y$10$N6wgWFWDhQ0dNXyxoC2.eOigrmf.fug6Df15rVE2KhgpP4cwV055a', 'qweqewqwe@mail.ru', 'qweqeqwe', 'dfgdgd', 'user'),
(7, 'User22', '$2y$10$7FeZffm3sDZrf8h8MjGHUO1sw3Y0NwDXmdXrhvlfkNksbldLPVABO', 'triumph22@mail.ru', 'User22', 'Zona', 'user'),
(8, 'User55', '$2y$10$uPh.GP9nVlmtr7kB2UvAJeBOA.5fYkOZt8sM5UVr8IUw5yBd0Xa2u', '55@mail.ru', 'User55', '555', 'user'),
(9, 'User56', '$2y$10$IE8ppB9dsawKr9JywaW3lOBgTdZZk7F19.OPT6Tt07BuU6qqXR.4m', '556@mail.ru', 'User56', '555', 'user'),
(10, 'User57', '$2y$10$9aAvpNVJMvOrLglMYJiDT.xXUl5qWUYebTGuz/KTDUkxosZp9LO7.', '557@mail.ru', 'User57', 'qwedsa', 'user'),
(11, 'User58', '$2y$10$Ueh6maumFoWQYksr6rUvEurz8s/qz6bts6XroiRHRBT2NIYVkjZXq', '558@mail.ru', 'User58', 'qwedsa', 'user'),
(12, 'User60', '$2y$10$JnhvUm/DhSVGpJBBiPIwEOCEbN9kLxSQfWL9oEaW81.HS5nKhgPlW', '560@mail.ru', 'User60', 'qwedsa', 'user'),
(13, 'User100', '$2y$10$QxmPg1Wrwl6UQgGibepUqeAeTqnFvrgMwWLYOht9RYt8R8FNhB55m', '100@mail.ru', 'User100', '1000', 'admin'),
(14, 'SuperDuperUser', '$2y$10$Low2Z4TquX/FZTKq/Q7OKOfGJm.rDBNFhaXg5S3auxGg1y0AnnUMy', 'Triumph99999@mail.ru', 'NewUser', 'sfsfsfsf', 'admin'),
(15, 'Vanga', '$2y$10$gJB1DxL075o7.BMVpMgUqOrjxDqllyhGnJT4/VDUCeAwjC0nOOQdS', 'triumo@email.ru', 'vanga', 'asdad', 'user'),
(16, 'erwrqwr', '$2y$10$9dt7ZtR4GgTyFSRrTJPZkON4NgRYpg.w6k.0h3VjqTj66F3F1LGtC', 'qwer@mail.ru', 'hgdhdfh', 'fdgghfhggfdh', 'admin'),
(17, 'twetwtwet', '$2y$10$idALlZZOl5DJvPDP3Oxe6ef59ERR3VCBO0.EJdWqkaqljjaB7AabG', 'qweeqwr@mail.ru', 'rtwtwt', 'gfdsgsdg', 'user'),
(18, 'sdfsafasf', '$2y$10$g3kZjtdxFO/RUhFpm15ynOnejeyLtmnRf0XekPzyuU6RHYWS5FX5K', 'qqq@mail.ru', 'dfsfasfasfds', 'sfsfsf', 'user'),
(19, 'fdsdfgsdgs', '$2y$10$fAdqZRnKbOGvIS5yec/mSeT5WcHVXk5rACX/cV2akxkZLjbttRqEi', 'qqqq@mail.ru', 'dfgsdfgsdg', 'dsfsf', 'user'),
(20, 'gfsgs', '$2y$10$3LUdC5mig/uC9rOfxCXYae6t.TTQdJMWAPVb3LS1THSABfzjgNhWa', 'sdfgsdfg@mail.ru', 'afasfasf', 'afasfasf', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attribute_group`
--
ALTER TABLE `attribute_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`attr_id`,`product_id`);

--
-- Индексы таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `modification`
--
ALTER TABLE `modification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `related_product`
--
ALTER TABLE `related_product`
  ADD PRIMARY KEY (`product_id`,`related_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attribute_group`
--
ALTER TABLE `attribute_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `modification`
--
ALTER TABLE `modification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
