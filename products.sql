-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 23 2020 г., 17:05
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `products`
--

-- --------------------------------------------------------

--
-- Структура таблицы `otdel`
--

CREATE TABLE IF NOT EXISTS `otdel` (
  `ido` smallint(6) NOT NULL AUTO_INCREMENT,
  `otdel` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ido`),
  UNIQUE KEY `otdel` (`otdel`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `otdel`
--

INSERT INTO `otdel` (`ido`, `otdel`) VALUES
(1, 'Мясной отдел'),
(2, 'Рыбный отдел'),
(3, 'Хлебо-булочные изделия'),
(5, 'Молочный отдел'),
(6, 'Кондитерский отдел'),
(7, 'Бакалея'),
(8, 'Напитки');

-- --------------------------------------------------------

--
-- Структура таблицы `post_pokup`
--

CREATE TABLE IF NOT EXISTS `post_pokup` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ido` smallint(6) NOT NULL DEFAULT '0',
  `fio` varchar(255) NOT NULL DEFAULT '',
  `pasp` varchar(255) NOT NULL DEFAULT '',
  `skidka` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `post_pokup`
--

INSERT INTO `post_pokup` (`id`, `ido`, `fio`, `pasp`, `skidka`) VALUES
(1, 1, 'Иванов Иван Иванович', '1402 875336', '5'),
(2, 6, 'Иванов Иван Иванович', '1402 875336', '15');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idp` smallint(6) NOT NULL AUTO_INCREMENT,
  `idpr` smallint(6) NOT NULL DEFAULT '0',
  `nazv` varchar(255) NOT NULL DEFAULT '',
  `srok` varchar(255) NOT NULL DEFAULT '',
  `price` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`idp`, `idpr`, `nazv`, `srok`, `price`) VALUES
(1, 1, 'Колбаса Венская', '3 недели', '130'),
(2, 2, 'Колбаса Сервелад', '4 недели', '325'),
(4, 3, 'Сахар', '12 месяцев', '25'),
(5, 4, 'Спагетти', '12 месяцев', '20'),
(8, 7, 'Хлеб белый', '2 дня', '9'),
(9, 7, 'Хлеб черный', '2 дня', '9'),
(10, 7, 'Батон', '2 дня', '10');

-- --------------------------------------------------------

--
-- Структура таблицы `proizv`
--

CREATE TABLE IF NOT EXISTS `proizv` (
  `idpr` smallint(6) NOT NULL AUTO_INCREMENT,
  `ido` smallint(6) NOT NULL DEFAULT '0',
  `nazv` varchar(255) NOT NULL DEFAULT '',
  `sity` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idpr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `proizv`
--

INSERT INTO `proizv` (`idpr`, `ido`, `nazv`, `sity`) VALUES
(1, 1, 'ОАО Чернянский мясо-комбинат', 'пос. Чернянка'),
(2, 1, 'ОАО Алексевский мясо-комбинат', 'г. Алексеевка'),
(3, 7, 'ЗАО Чернянский сахарный завод', 'пос. Чернянка'),
(4, 7, 'ЗАО Шебекинская макаронная фабрика', 'г. Шебекино'),
(7, 3, 'ОАО Белгородский хлебо-завод', 'г. Белгород');

-- --------------------------------------------------------

--
-- Структура таблицы `rabotn`
--

CREATE TABLE IF NOT EXISTS `rabotn` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) NOT NULL DEFAULT '',
  `prof` varchar(255) NOT NULL DEFAULT '',
  `stag` varchar(25) NOT NULL DEFAULT '',
  `oklad` mediumint(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `rabotn`
--

INSERT INTO `rabotn` (`id`, `fio`, `prof`, `stag`, `oklad`) VALUES
(1, 'Петров Петр Петрович', 'Начальник охраны', '4 года', 5000),
(2, 'Сидорова Мария Ивановна', 'Продавец', '5', 4500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
